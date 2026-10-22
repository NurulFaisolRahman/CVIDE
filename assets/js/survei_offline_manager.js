/**
 * survei_offline_manager.js
 * Engine Pengelolaan Draft Otomatis & Sinkronisasi Offline (Auto-Sync Queue)
 * Mengadopsi Pola Google Forms & ODK Collect untuk Daerah Tanpa Sinyal (Blank Spot)
 * 
 * Fitur:
 * 1. Auto-save Draft per-ketukan (Recovery saat browser/HP tertutup mendadak)
 * 2. Antrean Pengiriman Offline (Outbox Queue saat tidak ada sinyal internet)
 * 3. Auto-Sync otomatis ke server saat perangkat kembali terhubung internet
 */

(function(window, $) {
  'use strict';

  var QUEUE_KEY = 'CVIDE_OFFLINE_SURVEY_QUEUE';
  var DRAFT_PREFIX = 'CVIDE_SURVEY_DRAFT_';
  var isSyncing = false;
  var draftDebounceTimer = null;

  var SurveiOfflineManager = {

    /**
     * Inisialisasi Event Listener Jaringan & Auto-Sync
     */
    init: function() {
      var self = this;

      // Pantau status online / offline browser HP
      window.addEventListener('online', function() {
        console.log('[OfflineManager] Koneksi internet kembali online. Memulai auto-sync...');
        self.updateOnlineStatusUI(true);
        self.syncQueue(false);
      });

      window.addEventListener('offline', function() {
        console.log('[OfflineManager] Perangkat masuk ke mode offline / hilang sinyal.');
        self.updateOnlineStatusUI(false);
      });

      // Update tampilan banner antrean awal
      this.updateSyncBannerUI();

      // Cek antrean tertunda jika saat awal buka halaman dalam kondisi online
      if (navigator.onLine && this.getQueue().length > 0) {
        setTimeout(function() {
          self.syncQueue(false);
        }, 3000);
      }

      // Interval pengecekan berkala (setiap 30 detik jika ada antrean tertunda)
      setInterval(function() {
        if (navigator.onLine && self.getQueue().length > 0 && !isSyncing) {
          self.syncQueue(false);
        }
      }, 30000);

      // Pasang auto-save listener pada form
      this.bindAutoSaveListener();
    },

    /**
     * Bind auto-save ke semua input di form responden (debounced 350ms)
     */
    bindAutoSaveListener: function() {
      var self = this;
      $(document).on('input change', '#formSurveyRespondent input, #formSurveyRespondent select, #formSurveyRespondent textarea', function(e) {
        // Jangan auto-save jika target adalah input pencarian kuesioner luar
        if ($(this).closest('#formSurveyRespondent').length === 0) return;

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
      this.updateSyncBannerUI();
    },

    /**
     * Masukkan respon survei ke Antrean Offline (Outbox) saat koneksi terputus
     */
    enqueueOffline: function(payload, inst) {
      var queue = this.getQueue();
      var item = {
        id: 'OFFLINE_' + Date.now() + '_' + Math.random().toString(36).substr(2, 6),
        payload: payload,
        instrumen: inst,
        createdAt: new Date().toISOString(),
        respondenNama: payload.RespondenNama || 'Responden ' + inst,
        kecamatan: payload.Kecamatan || 'Banyuwangi'
      };

      queue.push(item);
      this.saveQueue(queue);

      // Hapus draft berjalan karena sudah masuk antrean selesai
      this.clearDraft(payload.SurveiId, inst);

      // Tutup modal responden jika terbuka
      if (typeof closeSurveyRespondentModal === 'function') {
        closeSurveyRespondentModal();
      }

      // Tampilkan SweetAlert konfirmasi offline yang menenangkan enumerator
      Swal.fire({
        icon: 'info',
        title: 'Disimpan di Antrean Offline! 📶',
        html: 
          '<div style="text-align: center; padding: 6px 0;">' +
            '<div style="background: #fef3c7; border: 1.5px solid #fde047; border-radius: 12px; padding: 12px; margin-bottom: 14px; color: #92400e; font-size: 13.5px; text-align: left; line-height: 1.5;">' +
              '<i class="fa-solid fa-triangle-exclamation" style="font-size: 16px; margin-right: 6px; color: #d97706;"></i>' +
              'Koneksi internet sedang terputus / offline. Jawaban responden <b>' + (item.respondenNama) + '</b> (Kec. ' + item.kecamatan + ') telah <b>berhasil diamankan di memori perangkat</b>.' +
            '</div>' +
            '<p style="font-size: 13px; color: #475569; margin: 0; line-height: 1.5;">' +
              'Total antrean tertunda saat ini: <b>' + queue.length + ' responden</b>.<br>' +
              'Data akan <b>otomatis terunggah ke database</b> begitu perangkat Anda mendapatkan sinyal internet / WiFi kembali.' +
            '</p>' +
          '</div>',
        confirmButtonText: '<i class="fa-solid fa-user-plus"></i> Siap, Lanjut Input Berikutnya',
        confirmButtonColor: '#043168'
      });

      this.updateSyncBannerUI();
    },

    /**
     * Proses Sinkronisasi Antrean ke Server Database
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
            title: 'Masih Offline',
            text: 'Perangkat belum terhubung ke internet. Antrean akan disinkronkan otomatis saat sinyal kembali aktif.',
            confirmButtonColor: '#043168'
          });
        }
        return;
      }

      if (isSyncing) return;
      isSyncing = true;

      // Update status tombol sinkronisasi
      var $btnSync = $('.btn-sync-now');
      var origBtnHtml = $btnSync.html();
      $btnSync.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Mengunggah (' + queue.length + ')...');

      if (isManual) {
        Swal.fire({
          title: 'Menyinkronkan Data...',
          html: 'Sedang mengunggah <b>' + queue.length + ' respon survei</b> offline ke server database...',
          allowOutsideClick: false,
          didOpen: function() { Swal.showLoading(); }
        });
      }

      var successCount = 0;
      var failCount = 0;
      var remainingQueue = [];

      // Fungsi rekursif untuk upload satu per satu secara berurutan
      function uploadNext(index) {
        if (index >= queue.length) {
          // Selesai seluruh antrean
          self.saveQueue(remainingQueue);
          isSyncing = false;
          $btnSync.prop('disabled', false).html(origBtnHtml);

          if (isManual) Swal.close();

          if (successCount > 0) {
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'success',
              title: 'Sinkronisasi Berhasil!',
              text: successCount + ' respon survei offline berhasil masuk ke server & peta GIS.',
              timer: 4500,
              showConfirmButton: false
            });

            // Reload data survei jika fungsi tersedia
            if (typeof loadAllSurveys === 'function') {
              loadAllSurveys();
            }
          }

          if (failCount > 0 && isManual) {
            Swal.fire({
              icon: 'warning',
              title: 'Sebagian Gagal',
              text: failCount + ' data survei gagal diunggah dan tetap disimpan di antrean offline untuk dicoba kembali.',
              confirmButtonColor: '#043168'
            });
          }

          return;
        }

        var item = queue[index];
        var payload = item.payload;

        $.ajax({
          url: BaseURL + 'IDE/submit_jawaban_survei',
          type: 'POST',
          data: JSON.stringify(payload),
          contentType: 'application/json; charset=utf-8',
          dataType: 'json',
          timeout: 15000,
          success: function(res) {
            if (res && res.status) {
              successCount++;
            } else {
              // Jika server menolak bukan karena koneksi, tetap log dan simpan di sisa
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
      var surveyId = parseInt($('#respSurveiId').val()) || 4;
      var inst = window.modalRtkdActiveInstrument || $('#modalRtkdActiveInstrument').val() || 'A';
      var answers = window.RTKDEngine ? window.RTKDEngine.collect('formSurveyRespondent', inst) : {};

      var draftData = {
        surveyId: surveyId,
        instrumen: inst,
        enumerator: $('#respEnumerator').val(),
        latitude: $('#respLatitude').val(),
        longitude: $('#respLongitude').val(),
        lokasiAccuracy: $('#respLokasiAccuracy').val(),
        devicePlatform: $('#respDevicePlatform').val(),
        answers: answers,
        savedAt: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' })
      };

      try {
        var key = DRAFT_PREFIX + surveyId + '_' + inst;
        localStorage.setItem(key, JSON.stringify(draftData));
        $('#rtkdDraftSaveText').html('<i class="fa-solid fa-cloud-check" style="color: #10b981;"></i> Draft tersimpan (' + draftData.savedAt + ')');
        $('#rtkdDraftIndicator').addClass('saved');
      } catch (e) {
        console.warn('[OfflineManager] Gagal simpan draft:', e);
      }
    },

    /**
     * Pulihkan Draft ke Form saat Kuesioner Dibuka
     */
    restoreDraft: function(surveyId, inst) {
      surveyId = surveyId || parseInt($('#respSurveiId').val()) || 4;
      inst = inst || window.modalRtkdActiveInstrument || 'A';
      var key = DRAFT_PREFIX + surveyId + '_' + inst;

      try {
        var raw = localStorage.getItem(key);
        if (!raw) {
          $('#rtkdDraftSaveText').html('<i class="fa-solid fa-cloud"></i> Draft otomatis aktif');
          return false;
        }

        var draft = JSON.parse(raw);
        if (!draft || !draft.answers || Object.keys(draft.answers).length === 0) return false;

        // Pulihkan Enumerator jika ada
        if (draft.enumerator && $('#respEnumerator').length) {
          $('#respEnumerator').val(draft.enumerator);
        }

        var form = document.getElementById('formSurveyRespondent');
        if (!form) return false;

        var answers = draft.answers;
        for (var qKey in answers) {
          if (!answers.hasOwnProperty(qKey)) continue;
          var val = answers[qKey];

          // Text / number / textarea / select
          var el = form.querySelector('#' + qKey) || form.querySelector('[name="' + qKey + '"]');
          if (el && (el.tagName === 'INPUT' || el.tagName === 'SELECT' || el.tagName === 'TEXTAREA') && el.type !== 'radio' && el.type !== 'checkbox') {
            el.value = val;
            $(el).trigger('change');
          }

          // Radio
          if (typeof val === 'string' || typeof val === 'number') {
            var elRadio = form.querySelector('input[type="radio"][name="' + qKey + '"][value="' + val + '"]');
            if (elRadio) {
              elRadio.checked = true;
              $(elRadio).trigger('change');
            }
          }

          // Checkbox array
          if (Array.isArray(val)) {
            val.forEach(function(itemVal) {
              var elCb = form.querySelector('input[type="checkbox"][name="' + qKey + '[]"][value="' + itemVal + '"]') ||
                         form.querySelector('input[type="checkbox"][name="' + qKey + '"][value="' + itemVal + '"]');
              if (elCb) {
                elCb.checked = true;
                $(elCb).trigger('change');
              }
            });
          }

          // Grid field object
          if (typeof val === 'object' && !Array.isArray(val)) {
            for (var subKey in val) {
              var gridInp = form.querySelector('input[name="' + qKey + '[' + subKey + ']"]') ||
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

          // Reason field
          if (qKey.indexOf('_alasan') !== -1) {
            var rawCode = qKey.replace('_alasan', '');
            var whyEl = form.querySelector('#' + rawCode + '__why');
            if (whyEl) {
              whyEl.value = val;
              $(whyEl).trigger('change');
            }
          }
        }

        // Terapkan aturan kondisional show/hide & update CR AHP
        if (window.RTKDEngine) {
          window.RTKDEngine.applyShow('modalRtkdSheet', inst);
          if (inst === 'E') {
            window.RTKDEngine.updateCR('modalRtkdSheet', 'E');
          }
        }

        $('#rtkdDraftSaveText').html('<i class="fa-solid fa-cloud-arrow-down" style="color: #0284c7;"></i> Draft dipulihkan (' + (draft.savedAt || 'tersimpan') + ')');
        return true;
      } catch (e) {
        console.warn('[OfflineManager] Gagal restore draft:', e);
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
     * Perbarui Tampilan Banner Antrean Offline di MenuSurvei
     */
    updateSyncBannerUI: function() {
      var queue = this.getQueue();
      var count = queue.length;
      var $banner = $('#offlineSyncBanner');
      var $countBadge = $('#offlineQueueBadgeCount');

      if (count > 0) {
        $countBadge.text(count);
        $banner.slideDown(250);
      } else {
        $banner.slideUp(250);
      }
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
    }
  };

  // Export ke window global
  window.SurveiOfflineManager = SurveiOfflineManager;

  // Inisialisasi saat DOM siap
  $(document).ready(function() {
    SurveiOfflineManager.init();
  });

})(window, jQuery);
