/**
 * survei_offline_manager.js
 * Engine Pengelolaan Antrean Offline Multi-Data & Sinkronisasi Massal
 * Fitur:
 * 1. Simpan respon survei tanpa batas ke Antrean Offline (Outbox) saat tidak ada internet
 * 2. Langsung lanjut menginput responden berikutnya tanpa menunggu sinyal
 * 3. Modal Penampil Antrean (Daftar responden offline, hapus, ekspor JSON cadangan)
 * 4. Floating Badge indikator antrean tertunda di layar
 * 5. Sinkronisasi berurutan (Batch Sync) dengan progress bar langsung ke server database
 */

(function(window, $) {
  'use strict';

  var QUEUE_KEY = 'CVIDE_OFFLINE_SURVEY_QUEUE';
  var DRAFT_PREFIX = 'CVIDE_SURVEY_DRAFT_';
  var isSyncing = false;
  var draftDebounceTimer = null;

  var SurveiOfflineManager = {

    /**
     * Inisialisasi Event Listener Jaringan, Auto-Sync & Injeksi Elemen UI
     */
    init: function() {
      var self = this;

      // Injeksi elemen UI floating badge & modal antrean jika belum ada di DOM
      this.injectUIElements();

      // Pantau status online / offline browser
      window.addEventListener('online', function() {
        console.log('[OfflineManager] Koneksi internet terhubung kembali.');
        self.updateOnlineStatusUI(true);
        // Jika ada antrean, tawarkan sinkronisasi otomatis
        if (self.getQueue().length > 0) {
          self.syncQueue(false);
        }
      });

      window.addEventListener('offline', function() {
        console.log('[OfflineManager] Perangkat masuk ke mode offline.');
        self.updateOnlineStatusUI(false);
      });

      // Update tampilan badge awal
      this.updateAllQueueUI();

      // Interval auto-sync berkala jika online dan ada antrean
      setInterval(function() {
        if (navigator.onLine && self.getQueue().length > 0 && !isSyncing) {
          self.syncQueue(false);
        }
      }, 30000);

      // Pasang auto-save listener pada form
      this.bindAutoSaveListener();
    },

    /**
     * Injeksi Floating Badge & Modal Antrean Offline ke DOM
     */
    injectUIElements: function() {
      // 1. Injeksi Floating Badge Antrean
      if ($('#offlineQueueFloatBadge').length === 0) {
        var floatHtml = 
          '<div id="offlineQueueFloatBadge" class="offline-float-pill" style="display: none;" onclick="window.SurveiOfflineManager && window.SurveiOfflineManager.showQueueModal()" title="Klik untuk melihat dan menyinkronkan data survei offline">' +
            '<span class="pulse-dot"></span>' +
            '<i class="fa-solid fa-cloud-arrow-up"></i>' +
            '<span><span id="floatQueueBadgeCount">0</span> Survei Offline</span>' +
            '<span class="q-count" id="floatQueueBadgeCountMini">0</span>' +
          '</div>';
        $('body').append(floatHtml);
      }

      // 2. Injeksi Modal Antrean Offline
      if ($('#modalOfflineQueueManager').length === 0) {
        var modalHtml = 
          '<div class="modal fade modal-offline-queue" id="modalOfflineQueueManager" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 10500;">' +
            '<div class="modal-dialog modal-lg modal-dialog-centered" role="document">' +
              '<div class="modal-content">' +
                '<div class="modal-header d-flex justify-content-between align-items-center">' +
                  '<h5 class="modal-title font-weight-bold" style="color: #ffffff; font-size: 16px; margin: 0;">' +
                    '<i class="fa-solid fa-cloud-arrow-up mr-2"></i> Antrean Survei Offline (<span id="modalQueueHeaderCount">0</span> Responden)' +
                  '</h5>' +
                  '<button type="button" class="close text-white" onclick="window.SurveiOfflineManager.closeQueueModal()" aria-label="Close" style="opacity: 1; border: none; background: transparent; font-size: 24px; cursor: pointer;">' +
                    '<span aria-hidden="true">&times;</span>' +
                  '</button>' +
                '</div>' +
                '<div class="modal-body" style="padding: 20px;">' +
                  '<div class="queue-stats-grid">' +
                    '<div class="queue-stat-card">' +
                      '<div class="val" id="statQueueTotal">0</div>' +
                      '<div class="lbl">Total Responden Tersimpan</div>' +
                    '</div>' +
                    '<div class="queue-stat-card">' +
                      '<div class="val" id="statQueueConn" style="font-size: 16px; color: #059669;"><i class="fa-solid fa-wifi"></i> Online</div>' +
                      '<div class="lbl">Status Koneksi Internet</div>' +
                    '</div>' +
                  '</div>' +
                  '<div style="margin-bottom: 12px; font-size: 13px; color: #64748b; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">' +
                    '<span><i class="fa-solid fa-circle-info text-info"></i> Data di bawah tersimpan di memori perangkat dan siap disinkronkan saat terhubung internet.</span>' +
                    '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.SurveiOfflineManager.exportQueueJson()" style="font-size: 12px; border-radius: 8px;">' +
                      '<i class="fa-solid fa-download"></i> Ekspor Cadangan (JSON)' +
                    '</button>' +
                  '</div>' +
                  '<div class="queue-table-wrap">' +
                    '<table class="table table-hover table-striped mb-0" style="font-size: 13px;">' +
                      '<thead class="thead-light">' +
                        '<tr>' +
                          '<th style="width: 45px;">No</th>' +
                          '<th>Nama Responden</th>' +
                          '<th>Instrumen</th>' +
                          '<th>Kecamatan</th>' +
                          '<th>Waktu Pengisian</th>' +
                          '<th>Jawaban</th>' +
                          '<th style="text-align: center; width: 60px;">Aksi</th>' +
                        '</tr>' +
                      '</thead>' +
                      '<tbody id="offlineQueueTableBody">' +
                        '<tr><td colspan="7" class="text-center py-4 text-muted">Belum ada antrean data offline.</td></tr>' +
                      '</tbody>' +
                    '</table>' +
                  '</div>' +
                '</div>' +
                '<div class="modal-footer d-flex justify-content-between" style="background: #f8fafc; border-top: 1.5px solid #e2e8f0; padding: 14px 20px;">' +
                  '<button type="button" class="btn btn-outline-danger btn-sm" onclick="window.SurveiOfflineManager.clearAllQueue()" id="btnClearAllQueue">' +
                    '<i class="fa-solid fa-trash-can"></i> Kosongkan Antrean' +
                  '</button>' +
                  '<div class="d-flex gap-2" style="gap: 10px;">' +
                    '<button type="button" class="btn btn-secondary btn-sm" onclick="window.SurveiOfflineManager.closeQueueModal()">' +
                      'Tutup' +
                    '</button>' +
                    '<button type="button" class="btn btn-primary btn-sm btn-sync-now" onclick="window.SurveiOfflineManager.syncQueue(true)">' +
                      '<i class="fa-solid fa-cloud-arrow-up"></i> Sinkronkan Semua Sekarang (<span id="btnModalSyncCount">0</span>)' +
                    '</button>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</div>' +
          '</div>';
        $('body').append(modalHtml);
      }
    },

    /**
     * Bind auto-save ke input kuesioner
     */
    bindAutoSaveListener: function() {
      var self = this;
      $(document).on('input change', '#formSurveyRespondent input, #formSurveyRespondent select, #formSurveyRespondent textarea, #dashRespondentForm input, #dashRespondentForm select, #dashRespondentForm textarea', function(e) {
        if ($(this).closest('#formSurveyRespondent, #dashRespondentForm').length === 0) return;

        clearTimeout(draftDebounceTimer);
        $('#rtkdDraftSaveText').html('<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan draft...');
        
        draftDebounceTimer = setTimeout(function() {
          self.saveCurrentDraft();
        }, 350);
      });
    },

    /**
     * Ambil data antrean offline dari LocalStorage
     */
    getQueue: function() {
      try {
        var raw = localStorage.getItem(QUEUE_KEY);
        return raw ? JSON.parse(raw) : [];
      } catch (e) {
        return [];
      }
    },

    /**
     * Simpan data antrean offline ke LocalStorage
     */
    saveQueue: function(queue) {
      try {
        localStorage.setItem(QUEUE_KEY, JSON.stringify(queue));
      } catch (e) {
        console.error('[OfflineManager] Gagal menyimpan antrean:', e);
      }
      this.updateAllQueueUI();
    },

    /**
     * Masukkan respon survei ke Antrean Offline (Bisa banyak responden tanpa koneksi internet)
     */
    enqueueOffline: function(payload, inst, sourceFormId) {
      var queue = this.getQueue();
      var now = new Date();
      var countJawaban = Object.keys(payload.Jawaban || {}).length;

      var nowIso = now.toISOString();
      payload.CreatedAt = nowIso;
      payload.waktu_pengisian = nowIso;

      var item = {
        id: 'OFFLINE_' + now.getTime() + '_' + Math.random().toString(36).substr(2, 6),
        surveiId: payload.SurveiId || 4,
        judulSurvei: $('#respModalSurveyTitle').text() || 'Survei Ketenagakerjaan Banyuwangi (RTKD)',
        instrumen: inst,
        respondenNama: payload.RespondenNama || 'Responden ' + inst,
        kecamatan: payload.Kecamatan || payload.RealKecamatan || 'Banyuwangi',
        kabupaten: payload.Kabupaten || 'Kabupaten Banyuwangi',
        jumlahJawaban: countJawaban,
        createdAt: nowIso,
        waktuFormat: now.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' }) + ' ' + now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB',
        payload: payload
      };

      queue.push(item);
      this.saveQueue(queue);

      // Hapus draft aktif survei ini karena sudah selesai diantrekan
      this.clearDraft(payload.SurveiId, inst);

      // SweetAlert interaktif: Enumerator bisa langsung lanjut ke responden berikutnya!
      Swal.fire({
        icon: 'success',
        title: 'Tersimpan di Antrean Offline! 📶',
        html: 
          '<div style="text-align: center; padding: 6px 0;">' +
            '<div style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 12px; padding: 12px; margin-bottom: 14px; color: #166534; font-size: 13.5px; text-align: left; line-height: 1.5;">' +
              '<i class="fa-solid fa-circle-check" style="font-size: 16px; margin-right: 6px; color: #16a34a;"></i>' +
              'Data responden <b>' + (item.respondenNama) + '</b> (Instrumen ' + inst + ') telah <b>berhasil diamankan ke memori perangkat</b>.' +
            '</div>' +
            '<div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 10px; margin-bottom: 12px; font-size: 13px; color: #475569;">' +
              'Total Antrean Siap Sinkron: <b style="color: #043168; font-size: 16px;">' + queue.length + ' Responden</b>' +
            '</div>' +
            '<p style="font-size: 12.5px; color: #64748b; margin: 0; line-height: 1.4;">' +
              'Anda dapat <b>langsung melanjutkan wawancara responden berikutnya</b> tanpa koneksi internet. Semua data akan diunggah bersamaan saat terhubung sinyal.' +
            '</p>' +
          '</div>',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-user-plus"></i> Lanjut Isi Responden Berikutnya',
        confirmButtonColor: '#043168',
        denyButtonText: '<i class="fa-solid fa-table-list"></i> Lihat Antrean (' + queue.length + ')',
        denyButtonColor: '#0284c7',
        cancelButtonText: 'Selesai & Tutup',
        cancelButtonColor: '#64748b'
      }).then(function(result) {
        if (result.isConfirmed) {
          // KOSONGKAN FORMULIR & SIAPKAN UNTUK RESPONDEN BERIKUTNYA
          SurveiOfflineManager.prepareFormForNextRespondent(inst, sourceFormId);
        } else if (result.isDenied) {
          // Buka modal daftar antrean offline
          SurveiOfflineManager.showQueueModal();
        } else {
          // Tutup modal
          if (typeof closeSurveyRespondentModal === 'function') {
            closeSurveyRespondentModal();
          }
        }
      });
    },

    /**
     * Kosongkan form dan siapkan lembar baru untuk responden berikutnya
     */
    prepareFormForNextRespondent: function(inst, sourceFormId) {
      // 1. Kosongkan field identitas responden dasar
      $('#respEnumerator').val($('#respEnumerator').val() || 'Petugas Lapangan');
      $('#dashRespNama, #dashRespNIK, #dashRespKontak, #dashRespUsia, #dashAlamat').val('');

      // 2. Render ulang lembar butir pertanyaan kosong
      if (sourceFormId === 'dashRespondentForm' || $('#dashRtkdSheet').length) {
        if (window.RTKDEngine) {
          window.RTKDEngine.render('dashRtkdSheet', inst, 'dash_');
        }
      } else {
        if (window.RTKDEngine) {
          window.RTKDEngine.render('modalRtkdSheet', inst);
        }
      }

      // 3. Reset scroll ke atas form dengan animasi mulus
      var $scrollTarget = $('#surveyRespondentModal .modal-body, #modalSurveyRespondent, html, body');
      $scrollTarget.animate({ scrollTop: 0 }, 300);

      // 4. Beri notifikasi toast siap
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'info',
        title: 'Formulir Siap',
        text: 'Formulir telah dikosongkan untuk responden berikutnya (Instrumen ' + inst + ').',
        timer: 2500,
        showConfirmButton: false
      });
    },

    /**
     * Buka Modal Penampil Antrean Offline
     */
    showQueueModal: function() {
      var self = this;
      var queue = this.getQueue();
      var $tbody = $('#offlineQueueTableBody');

      // Update status koneksi
      if (navigator.onLine) {
        $('#statQueueConn').html('<i class="fa-solid fa-wifi" style="color: #059669;"></i> Online (Siap Sinkron)');
      } else {
        $('#statQueueConn').html('<i class="fa-solid fa-plane-slash" style="color: #dc2626;"></i> Mode Offline');
      }

      $('#statQueueTotal, #modalQueueHeaderCount, #btnModalSyncCount').text(queue.length);

      if (queue.length === 0) {
        $tbody.html('<tr><td colspan="7" class="text-center py-4 text-muted"><i class="fa-solid fa-folder-open mb-2" style="font-size: 24px; display: block;"></i>Belum ada antrean data survei offline. Semua data telah disinkronkan.</td></tr>');
        $('#btnClearAllQueue').prop('disabled', true);
      } else {
        $('#btnClearAllQueue').prop('disabled', false);
        var rowsHtml = '';
        queue.forEach(function(item, idx) {
          rowsHtml += 
            '<tr>' +
              '<td><b>' + (idx + 1) + '</b></td>' +
              '<td><b>' + (item.respondenNama || '-') + '</b></td>' +
              '<td><span class="badge badge-primary px-2 py-1" style="border-radius: 6px; font-weight: 700; background: #043168; color: #fff;">Instrumen ' + item.instrumen + '</span></td>' +
              '<td>' + (item.kecamatan || '-') + '</td>' +
              '<td><small class="text-muted">' + (item.waktuFormat || item.createdAt.slice(0, 16)) + '</small></td>' +
              '<td><span class="badge badge-light border">' + (item.jumlahJawaban || 0) + ' butir</span></td>' +
              '<td style="text-align: center;">' +
                '<button type="button" class="btn btn-xs btn-outline-danger" title="Hapus dari antrean" onclick="window.SurveiOfflineManager.removeItem(\'' + item.id + '\')" style="padding: 2px 7px; font-size: 11px; border-radius: 6px;">' +
                  '<i class="fa-solid fa-trash"></i>' +
                '</button>' +
              '</td>' +
            '</tr>';
        });
        $tbody.html(rowsHtml);
      }

      // Tampilkan Modal
      if (typeof $.fn.modal !== 'undefined') {
        $('#modalOfflineQueueManager').modal('show');
      } else {
        $('#modalOfflineQueueManager').fadeIn(200);
      }
    },

    /**
     * Tutup Modal Antrean Offline
     */
    closeQueueModal: function() {
      if (typeof $.fn.modal !== 'undefined') {
        $('#modalOfflineQueueManager').modal('hide');
      } else {
        $('#modalOfflineQueueManager').fadeOut(200);
      }
    },

    /**
     * Hapus satu item dari antrean
     */
    removeItem: function(id) {
      var self = this;
      var queue = this.getQueue();
      var filtered = queue.filter(function(item) { return item.id !== id; });

      Swal.fire({
        title: 'Hapus Responden ini?',
        text: 'Data responden yang dihapus tidak akan dikirimkan ke server.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
      }).then(function(result) {
        if (result.isConfirmed) {
          self.saveQueue(filtered);
          self.showQueueModal();
        }
      });
    },

    /**
     * Kosongkan semua antrean
     */
    clearAllQueue: function() {
      var self = this;
      var queue = this.getQueue();
      if (queue.length === 0) return;

      Swal.fire({
        title: 'Kosongkan Seluruh Antrean?',
        text: 'Semua ' + queue.length + ' data responden offline yang belum tersinkronisasi akan dihapus permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        confirmButtonText: 'Ya, Kosongkan Semua',
        cancelButtonText: 'Batal'
      }).then(function(result) {
        if (result.isConfirmed) {
          self.saveQueue([]);
          self.showQueueModal();
          Swal.fire('Antrean Dikosongkan', 'Seluruh data offline telah dibersihkan.', 'success');
        }
      });
    },

    /**
     * Ekspor Antrean ke Berkas Cadangan JSON
     */
    exportQueueJson: function() {
      var queue = this.getQueue();
      if (queue.length === 0) {
        Swal.fire('Kosong', 'Tidak ada antrean data untuk diekspor.', 'info');
        return;
      }

      var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(queue, null, 2));
      var downloadAnchor = document.createElement('a');
      downloadAnchor.setAttribute("href", dataStr);
      downloadAnchor.setAttribute("download", "cadangan_survei_offline_rtkd_" + new Date().toISOString().slice(0, 10) + ".json");
      document.body.appendChild(downloadAnchor);
      downloadAnchor.click();
      downloadAnchor.remove();
    },

    /**
     * Proses Sinkronisasi Massal Semua Antrean ke Server Database
     */
    syncQueue: function(isManual) {
      var self = this;
      var queue = this.getQueue();

      if (queue.length === 0) {
        if (isManual) {
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'info',
            title: 'Tidak Ada Antrean',
            text: 'Semua jawaban survei telah tersinkronisasi ke server.',
            timer: 3000,
            showConfirmButton: false
          });
        }
        return;
      }

      if (!navigator.onLine) {
        if (isManual) {
          Swal.fire({
            icon: 'warning',
            title: 'Perangkat Masih Offline 📶',
            text: 'Perangkat belum terhubung ke internet. Data tersimpan aman di antrean dan siap dikirim saat sinyal aktif.',
            confirmButtonColor: '#043168'
          });
        }
        return;
      }

      if (isSyncing) return;
      isSyncing = true;

      var totalToSync = queue.length;
      var successCount = 0;
      var failCount = 0;
      var remainingQueue = [];

      // Tampilkan SweetAlert progress sinkronisasi
      if (isManual) {
        Swal.fire({
          title: 'Menyinkronkan Antrean...',
          html: 
            '<div style="text-align: center; padding: 10px 0;">' +
              '<div class="progress mb-3" style="height: 16px; border-radius: 8px; background: #e2e8f0; overflow: hidden;">' +
                '<div id="syncProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%; transition: width 0.3s ease;"></div>' +
              '</div>' +
              '<div id="syncProgressText" style="font-size: 13.5px; color: #475569;">Mengunggah 0 dari ' + totalToSync + ' responden...</div>' +
            '</div>',
          allowOutsideClick: false,
          showConfirmButton: false
        });
      }

      function uploadNext(index) {
        if (index >= queue.length) {
          // Selesai seluruh antrean
          self.saveQueue(remainingQueue);
          isSyncing = false;

          if (isManual) {
            Swal.close();
            self.showQueueModal();
          }

          if (successCount > 0) {
            Swal.fire({
              icon: 'success',
              title: 'Sinkronisasi Berhasil!',
              html: 'Sebanyak <b>' + successCount + ' responden survei offline</b> berhasil diunggah ke server database & peta wilayah GIS.',
              confirmButtonColor: '#043168'
            });

            // Reload data survei jika fungsi tersedia
            if (typeof loadAllSurveys === 'function') {
              loadAllSurveys();
            }
            if (typeof loadDashboardRekapData === 'function') {
              loadDashboardRekapData(window.currentSurveyId || 4);
            }
            if (typeof loadGoogleMapSurveyData === 'function') {
              loadGoogleMapSurveyData(window.currentSurveyId || 4);
            }
          }

          if (failCount > 0 && isManual) {
            Swal.fire({
              icon: 'warning',
              title: 'Sebagian Tertunda',
              text: failCount + ' data survei belum berhasil diunggah karena kendala jaringan dan tetap disimpan di antrean untuk dicoba kembali.',
              confirmButtonColor: '#043168'
            });
          }

          return;
        }

        var item = queue[index];
        var payload = item.payload;

        // Update progress bar UI
        var pct = Math.round(((index + 1) / totalToSync) * 100);
        $('#syncProgressBar').css('width', pct + '%');
        $('#syncProgressText').html('Mengunggah ' + (index + 1) + ' dari ' + totalToSync + ': <b>' + (item.respondenNama || 'Responden') + '</b>...');

        var bUrl = (typeof BaseURL !== 'undefined' && BaseURL) ? BaseURL : (window.location.origin + '/');
        if (bUrl.slice(-1) !== '/') bUrl += '/';
        var targetUrl = bUrl + 'IDE/submit_jawaban_survei';

        $.ajax({
          url: targetUrl,
          type: 'POST',
          data: JSON.stringify(payload),
          contentType: 'application/json; charset=utf-8',
          dataType: 'json',
          timeout: 20000,
          success: function(res) {
            if (res && res.status) {
              successCount++;
            } else {
              console.warn('[OfflineManager] Gagal upload item:', item.id, res ? res.message : 'Unknown');
              remainingQueue.push(item);
              failCount++;
            }
            uploadNext(index + 1);
          },
          error: function(xhr, status, err) {
            console.error('[OfflineManager] Error upload item:', item.id, status);
            remainingQueue.push(item);
            failCount++;
            uploadNext(index + 1);
          }
        });
      }

      uploadNext(0);
    },

    /**
     * Simpan Draft Form Responden Berjalan ke LocalStorage
     */
    saveCurrentDraft: function() {
      var isDash = $('#dashRespondentForm').is(':visible') || ($('#dashRtkdSheet').length > 0 && !$('#surveyRespondentModal').hasClass('show'));
      var formId = isDash ? 'dashRespondentForm' : 'formSurveyRespondent';
      var prefix = isDash ? 'dash_' : '';
      var surveyId = parseInt($('#respSurveiId').val() || $('#dashFormSurveyId').val()) || 4;
      var inst = isDash
        ? (window.dashRtkdActiveInstrument || $('#dashRtkdActiveInstrument').val() || 'A')
        : (window.modalRtkdActiveInstrument || $('#modalRtkdActiveInstrument').val() || 'A');
      var answers = window.RTKDEngine ? window.RTKDEngine.collect(formId, inst, prefix) : {};
      var enumerator = $('#respEnumerator').val() || $('#dashRespPetugas').val() || $('#dashRespEnumerator').val() || 'Petugas Lapangan';

      var draftData = {
        surveyId: surveyId,
        instrumen: inst,
        enumerator: enumerator,
        answers: answers,
        savedAt: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' })
      };

      try {
        var key = DRAFT_PREFIX + surveyId + '_' + inst;
        localStorage.setItem(key, JSON.stringify(draftData));
        $('#rtkdDraftSaveText, #dashDraftSaveText').html('<i class="fa-solid fa-cloud-check" style="color: #10b981;"></i> Draft tersimpan (' + draftData.savedAt + ')');
        $('#rtkdDraftIndicator, #dashDraftIndicator').addClass('saved');
      } catch (e) {}
    },

    /**
     * Pulihkan Draft ke Form saat Kuesioner Dibuka
     */
    restoreDraft: function(surveyId, inst, isDash) {
      if (typeof isDash === 'undefined') {
        isDash = $('#dashRespondentForm').is(':visible') || ($('#dashRtkdSheet').length > 0 && !$('#surveyRespondentModal').hasClass('show'));
      }
      var formId = isDash ? 'dashRespondentForm' : 'formSurveyRespondent';
      var prefix = isDash ? 'dash_' : '';
      surveyId = surveyId || parseInt($('#respSurveiId').val() || $('#dashFormSurveyId').val()) || 4;
      inst = inst || (isDash ? (window.dashRtkdActiveInstrument || 'A') : (window.modalRtkdActiveInstrument || 'A'));
      var key = DRAFT_PREFIX + surveyId + '_' + inst;

      try {
        var raw = localStorage.getItem(key);
        if (!raw) {
          $('#rtkdDraftSaveText, #dashDraftSaveText').html('<i class="fa-solid fa-cloud"></i> Draft otomatis aktif');
          return false;
        }

        var draft = JSON.parse(raw);
        if (!draft || !draft.answers || Object.keys(draft.answers).length === 0) return false;

        if (draft.enumerator) {
          if ($('#respEnumerator').length) $('#respEnumerator').val(draft.enumerator);
          if ($('#dashRespPetugas').length) $('#dashRespPetugas').val(draft.enumerator);
          if ($('#dashRespEnumerator').length) $('#dashRespEnumerator').val(draft.enumerator);
        }

        var form = document.getElementById(formId);
        if (!form) return false;

        var answers = draft.answers;
        for (var qKey in answers) {
          if (!answers.hasOwnProperty(qKey)) continue;
          var val = answers[qKey];

          var el = form.querySelector('#' + prefix + qKey) || form.querySelector('#' + qKey) || form.querySelector('[name="' + qKey + '"]');
          if (el && (el.tagName === 'INPUT' || el.tagName === 'SELECT' || el.tagName === 'TEXTAREA') && el.type !== 'radio' && el.type !== 'checkbox') {
            el.value = val;
            $(el).trigger('change');
          }

          if (typeof val === 'string' || typeof val === 'number') {
            var $radios = $(form).find('input[type="radio"][name="' + qKey + '"], input[type="radio"][name="' + prefix + qKey + '"]');
            var matched = $radios.filter(function() { return this.value === String(val); });
            if (matched.length) {
              matched.prop('checked', true).trigger('change');
            }
          }

          if (Array.isArray(val)) {
            val.forEach(function(itemVal) {
              var elCb = form.querySelector('input[type="checkbox"][name="' + qKey + '[]"][value="' + itemVal + '"]') ||
                         form.querySelector('input[type="checkbox"][name="' + prefix + qKey + '[]"][value="' + itemVal + '"]') ||
                         form.querySelector('input[type="checkbox"][name="' + qKey + '"][value="' + itemVal + '"]');
              if (elCb) {
                elCb.checked = true;
                $(elCb).trigger('change');
              }
            });
          }

          if (typeof val === 'object' && !Array.isArray(val)) {
            for (var subKey in val) {
              var gridInp = form.querySelector('input[name="' + qKey + '[' + subKey + ']"]') ||
                            form.querySelector('input[name="' + prefix + qKey + '[' + subKey + ']"]') ||
                            form.querySelector('input[data-field="' + subKey + '"][data-q="' + qKey + '"]');
              if (gridInp) {
                if (gridInp.type === 'radio') {
                  var gridRadio = form.querySelector('input[data-q="' + qKey + '"][data-field="' + subKey + '"][value="' + val[subKey] + '"]');
                  if (gridRadio) {
                    gridRadio.checked = true;
                    $(gridRadio).trigger('change');
                  }
                } else {
                  gridInp.value = val[subKey];
                  $(gridInp).trigger('change');
                }
              }
            }
          }
        }

        if (window.RTKDEngine) {
          var targetSheet = isDash ? 'dashRtkdSheet' : 'modalRtkdSheet';
          window.RTKDEngine.applyShow(targetSheet, inst, prefix);
          if (inst === 'E') {
            window.RTKDEngine.updateCR(targetSheet, 'E', prefix);
          }
        }

        $('#rtkdDraftSaveText, #dashDraftSaveText').html('<i class="fa-solid fa-cloud-arrow-down" style="color: #0284c7;"></i> Draft dipulihkan (' + (draft.savedAt || 'tersimpan') + ')');
        return true;
      } catch (e) {
        return false;
      }
    },

    /**
     * Hapus Draft setelah form berhasil disubmit atau dikosongkan manual
     */
    clearDraft: function(surveyId, inst) {
      surveyId = surveyId || parseInt($('#respSurveiId').val()) || 4;
      inst = inst || window.modalRtkdActiveInstrument || 'A';
      var key = DRAFT_PREFIX + surveyId + '_' + inst;
      try {
        localStorage.removeItem(key);
        $('#rtkdDraftSaveText').html('<i class="fa-solid fa-cloud"></i> Draft otomatis aktif');
      } catch (e) {}
    },

    /**
     * Perbarui Tampilan Seluruh Badge & Banner Antrean Offline di UI
     */
    updateAllQueueUI: function() {
      var queue = this.getQueue();
      var count = queue.length;

      // Banner di MenuSurvei
      var $banner = $('#offlineSyncBanner');
      var $countBadge = $('#offlineQueueBadgeCount');
      if (count > 0) {
        $countBadge.text(count);
        $banner.slideDown(250);
      } else {
        $banner.slideUp(250);
      }

      // Floating Badge
      var $float = $('#offlineQueueFloatBadge');
      if (count > 0) {
        $('#floatQueueBadgeCount').text(count);
        $('#floatQueueBadgeCountMini').text(count);
        $float.fadeIn(250);
      } else {
        $float.fadeOut(250);
      }

      $('#btnModalSyncCount, #modalQueueHeaderCount').text(count);
    },

    /**
     * Update Status Indikator Koneksi Online / Offline di UI
     */
    updateOnlineStatusUI: function(isOnline) {
      var $badge = $('#onlineStatusIndicator');
      if ($badge.length) {
        if (isOnline) {
          $badge.removeClass('offline').addClass('online').html('<i class="fa-solid fa-wifi"></i> Online');
        } else {
          $badge.removeClass('online').addClass('offline').html('<i class="fa-solid fa-plane-slash"></i> Mode Offline');
        }
      }
      this.updateAllQueueUI();
    }
  };

  // Export ke window global
  window.SurveiOfflineManager = SurveiOfflineManager;

  // Inisialisasi saat DOM siap
  $(document).ready(function() {
    SurveiOfflineManager.init();
  });

})(window, typeof jQuery !== 'undefined' ? jQuery : (typeof window.$ !== 'undefined' ? window.$ : null));
