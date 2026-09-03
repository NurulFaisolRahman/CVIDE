<div class="row align-items-center justify-content-between mb-3" style="margin-top: 10px;">
  <div class="col-auto">
    <h4 class="font-weight-bold text-dark mb-1" style="font-size: 18px; text-transform: uppercase; letter-spacing: 0.5px;">
      <i class="fa-solid fa-diagram-project mr-2" style="color: var(--ide-red);"></i> Manajemen Project
    </h4>
    <p class="text-muted mb-0" style="font-size: 12.5px;">Kelola data berkas kegiatan, kategori, tahun pelaksanaan, serta catatan proyek IDE Consultant.</p>
  </div>
  <div class="col-auto">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalInput" style="border-radius: 20px; font-weight: 700; padding: 9px 20px; font-size: 13px; background: var(--ide-red); border: none; box-shadow: 0 4px 12px rgba(180, 8, 20, 0.35);">
      <i class="fa-solid fa-plus mr-1"></i> Tambah Project Baru
    </button>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card shadow-sm border-0" style="border-radius: 16px;">
      <div class="card-body p-3">
        <div class="table-responsive">
          <table id="TabelProject" class="table table-hover table-striped w-100" style="border-radius: 12px; overflow: hidden;">
            <thead>
              <tr style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff;">
                <th style="width: 5%;" class="text-center align-middle">No</th>
                <th style="width: 25%;" class="align-middle">Nama Project</th>
                <th style="width: 15%;" class="text-center align-middle">Kategori</th>
                <th style="width: 15%;" class="text-center align-middle">Tahun Project</th>
                <th style="width: 26%;" class="align-middle">Catatan</th>
                <th style="width: 14%;" class="text-center align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody id="RekapSurvei">
              <?php 
              $No = 1; 
              foreach ($Project as $key) { 
                $dl = !empty($key['Deadline']) ? $key['Deadline'] : '-';
                // Jika data lama berformat YYYY-MM-DD|YYYY-MM-DD, ubah tampilan menjadi Tahun
                if (strpos($dl, '|') !== false) {
                  $parts = explode('|', $dl);
                  $f = explode('-', $parts[0] ?? '');
                  $t = explode('-', $parts[1] ?? '');
                  $yF = $f[0] ?? '';
                  $yT = $t[0] ?? '';
                  if (!empty($yF) && !empty($yT) && $yF === $yT) {
                    $dl = $yF;
                  } else if (!empty($yF) && !empty($yT)) {
                    $dl = $yF . ' - ' . $yT;
                  }
                }
              ?>
                <tr>
                  <td class="text-center align-middle font-weight-bold"><?=$No++?></td>
                  <td class="align-middle font-weight-bold text-dark">
                    <i class="fa-solid fa-file-lines mr-1 text-primary"></i> <?=$key['NamaProject']?>
                  </td>
                  <td class="text-center align-middle">
                    <?php if (!empty($key['Kategori'])) { ?>
                      <span class="badge px-2 py-1" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; border-radius: 8px; font-size: 11.5px; font-weight: 600;">
                        <i class="fa-solid fa-tag mr-1"></i> <?=htmlspecialchars($key['Kategori'])?>
                      </span>
                    <?php } else { ?>
                      <span class="text-muted" style="font-size: 12px;">-</span>
                    <?php } ?>
                  </td>
                  <td class="text-center align-middle">
                    <span class="badge badge-light px-2 py-1" style="border: 1px solid #cbd5e1; border-radius: 8px; font-size: 12px; font-weight: 600; color: #334155;">
                      <i class="fa-regular fa-calendar mr-1 text-danger"></i> <?=htmlspecialchars($dl)?>
                    </span>
                  </td>
                  <td class="align-middle text-muted" style="font-size: 13px;">
                    <?=!empty($key['Catatan']) ? nl2br($key['Catatan']) : '-'?>
                  </td>
                  <td class="text-center align-middle text-nowrap">
                    <?php if (!empty($key['File'])) { ?>
                      <button type="button" LihatProject="<?=base_url('Project/'.$key['File'])?>" class="btn btn-sm btn-danger LihatProject" title="Lihat Berkas PDF" style="border-radius: 8px; padding: 5px 9px;">
                        <i class="fa-solid fa-file-pdf"></i>
                      </button>
                    <?php } ?>
                    <button type="button" 
                      class="btn btn-sm btn-warning text-white Edit" 
                      title="Edit Data" 
                      data-id="<?=$key['Id']?>"
                      data-nama="<?=htmlspecialchars($key['NamaProject'], ENT_QUOTES)?>"
                      data-kategori="<?=htmlspecialchars($key['Kategori'] ?? '', ENT_QUOTES)?>"
                      data-deadline="<?=htmlspecialchars($key['Deadline'] ?? '', ENT_QUOTES)?>"
                      data-catatan="<?=htmlspecialchars($key['Catatan'] ?? '', ENT_QUOTES)?>"
                      data-file="<?=$key['File'] ?? ''?>"
                      style="border-radius: 8px; padding: 5px 9px;">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button type="button" Hapus="<?=$key['Id']."$".$key['File']?>" class="btn btn-sm btn-danger Hapus" title="Hapus Data" style="border-radius: 8px; padding: 5px 9px;">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </td>
                </tr>
              <?php } ?>  
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
</div> 
</div>
<!-- /page content -->
</div>
</div>

<!-- Modal Input Project -->
<div class="modal fade" id="ModalInput" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fa-solid fa-folder-plus mr-2"></i> Tambah Data Project Baru
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-3">
          <label for="NamaProject">Nama Project / Kegiatan <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="NamaProject" placeholder="Masukkan nama project...">
        </div>

        <div class="form-group mb-3">
          <label for="Kategori">Kategori Project (Isi Manual)</label>
          <input type="text" class="form-control" id="Kategori" placeholder="Contoh: Riset, IT & Software, Pelatihan, Konsultansi, dll...">
        </div>

        <div class="form-group mb-3">
          <label for="Deadline">Tahun Project / Deadline <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="Deadline" placeholder="Contoh: 2026 atau 2025 - 2026" value="<?=date('Y')?>">
          <small class="form-text text-muted mt-1">Masukkan tahun pelaksanaan project (isi manual).</small>
        </div>

        <div class="form-group mb-3">
          <label for="Catatan">Catatan / Deskripsi Kerja</label>
          <textarea class="form-control" id="Catatan" rows="3" placeholder="Masukkan catatan atau keterangan proyek..."></textarea>
        </div>

        <div class="form-group mb-2">
          <label for="File">Unggah Berkas PDF (Opsional)</label>
          <input class="form-control" type="file" id="File" accept=".pdf">
          <small class="form-text text-muted mt-1">Format file didukung: PDF (Maksimal 10MB)</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="Input">
          <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Data
        </button>
        <div id="LoadingInput" class="spinner-border text-danger ml-2" role="status" style="display: none; width: 1.5rem; height: 1.5rem;"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Project -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Data Project
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="Id">
        <input type="hidden" id="FileLama">

        <div class="form-group mb-3">
          <label for="EditNamaProject">Nama Project / Kegiatan <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="EditNamaProject" placeholder="Masukkan nama project...">
        </div>

        <div class="form-group mb-3">
          <label for="EditKategori">Kategori Project (Isi Manual)</label>
          <input type="text" class="form-control" id="EditKategori" placeholder="Contoh: Riset, IT & Software, Pelatihan, Konsultansi, dll...">
        </div>

        <div class="form-group mb-3">
          <label for="EditDeadline">Tahun Project / Deadline <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="EditDeadline" placeholder="Contoh: 2026 atau 2025 - 2026">
          <small class="form-text text-muted mt-1">Masukkan tahun pelaksanaan project (isi manual).</small>
        </div>

        <div class="form-group mb-3">
          <label for="EditCatatan">Catatan / Deskripsi Kerja</label>
          <textarea class="form-control" id="EditCatatan" rows="3" placeholder="Masukkan catatan atau keterangan proyek..."></textarea>
        </div>

        <div class="form-group mb-2">
          <label for="EditFile">Ganti Berkas PDF (Kosongkan jika tidak diganti)</label>
          <input class="form-control" type="file" id="EditFile" accept=".pdf">
          <small class="form-text text-muted mt-1">Format file didukung: PDF</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="Edit">
          <i class="fa-solid fa-floppy-disk mr-1"></i> Update Data
        </button>
        <div id="LoadingEdit" class="spinner-border text-danger ml-2" role="status" style="display: none; width: 1.5rem; height: 1.5rem;"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Preview Project PDF -->
<div class="modal fade" id="ModalProject" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fa-solid fa-file-pdf mr-2"></i> Pratinjau Dokumen Project
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <embed id="PathProject" src="" type="application/pdf" width="100%" height="600" style="border: none;"/>
      </div>
      <div class="modal-footer py-2">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
<script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
<script src="<?=base_url("build/js/custom.min.js")?>"></script>
<script src="<?=base_url("assets/datatables/jquery.dataTables.js")?>"></script>
<script src="<?=base_url("assets/datatables-bs4/js/dataTables.bootstrap4.js")?>"></script>
<script>
  $(document).ready(function(){
    var BaseURL = '<?=base_url()?>';
    
    $('#TabelProject').DataTable({
      "ordering": true,
      "pageLength": 10,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
      "language": {
        "search": "Cari Project:",
        "lengthMenu": "Tampilkan _MENU_ data",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        "infoEmpty": "Data tidak tersedia",
        "zeroRecords": "Tidak ada data yang sesuai",
        "paginate": {
          "previous": '<i class="fa-solid fa-chevron-left"></i>',
          "next": '<i class="fa-solid fa-chevron-right"></i>'
        }
      }
    });

    // Preview PDF
    $(document).on("click", ".LihatProject", function(){
      var Path = $(this).attr('LihatProject');
      $('#PathProject').attr('src', Path);		
      $('#ModalProject').modal("show");
    }); 
     
    // Input Data
    $("#Input").click(function() {
      if ($("#NamaProject").val().trim() === "") {
        alert("Nama Project tidak boleh kosong!");
        return;
      }
      if ($("#Deadline").val().trim() === "") {
        alert("Tahun Project tidak boleh kosong!");
        return;
      }

      var fd = new FormData();
      if ($('#File')[0].files && $('#File')[0].files[0]) {
        fd.append("File", $('#File')[0].files[0]);	
      }
      fd.append('NamaProject', $("#NamaProject").val());
      fd.append('Kategori', $("#Kategori").val());
      fd.append('Deadline', $("#Deadline").val());
      fd.append('Catatan', $("#Catatan").val());

      $.ajax({
        url: BaseURL + 'Staf/Input',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $("#LoadingInput").show();
          $("#Input").prop('disabled', true);
        },
        success: function(Respon){
          if (Respon == '1') {
            window.location = BaseURL + "Staf/Project";
          } else {
            alert(Respon);
            $("#LoadingInput").hide();
            $("#Input").prop('disabled', false);
          }
        },
        error: function() {
          alert("Terjadi kesalahan sistem saat menyimpan data!");
          $("#LoadingInput").hide();
          $("#Input").prop('disabled', false);
        }
      });
    });

    // Edit Click
    $(document).on("click", ".Edit", function(){
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var kategori = $(this).data('kategori');
      var deadline = $(this).data('deadline');
      var catatan = $(this).data('catatan');
      var file = $(this).data('file');

      // Fallback for legacy format if data attributes aren't present
      if (!id && $(this).attr('Edit')) {
        var Data = $(this).attr('Edit');
        var Pisah = Data.split("$");
        id = Pisah[0] || '';
        nama = Pisah[1] || '';
        deadline = Pisah[2] || '';
        catatan = Pisah[3] || '';
        file = Pisah[4] || '';
      }

      // Jika format lama YYYY-MM-DD|YYYY-MM-DD
      if (deadline && typeof deadline === 'string' && deadline.indexOf('|') !== -1) {
        var parts = deadline.split('|');
        var yF = (parts[0] || '').split('-')[0] || '';
        var yT = (parts[1] || '').split('-')[0] || '';
        if (yF && yT && yF === yT) {
          deadline = yF;
        } else if (yF && yT) {
          deadline = yF + ' - ' + yT;
        }
      }

      $("#Id").val(id || '');
      $("#EditNamaProject").val(nama || '');
      $("#EditKategori").val(kategori || '');
      $("#EditDeadline").val(deadline || '');
      $("#EditCatatan").val(catatan || '');
      $("#EditFile").val('');
      $("#FileLama").val(file || '');
      $('#ModalEdit').modal("show");
    });

    // Submit Edit
    $("#Edit").click(function() {
      if ($("#EditNamaProject").val().trim() === "") {
        alert("Nama Project tidak boleh kosong!");
        return;
      }
      if ($("#EditDeadline").val().trim() === "") {
        alert("Tahun Project tidak boleh kosong!");
        return;
      }

      var fd = new FormData();
      fd.append('Id', $("#Id").val());
      fd.append('FileLama', $("#FileLama").val());
      if ($('#EditFile')[0].files && $('#EditFile')[0].files[0]) {
        fd.append("File", $('#EditFile')[0].files[0]);	
      }
      fd.append('NamaProject', $("#EditNamaProject").val());
      fd.append('Kategori', $("#EditKategori").val());
      fd.append('Deadline', $("#EditDeadline").val());
      fd.append('Catatan', $("#EditCatatan").val());

      $.ajax({
        url: BaseURL + 'Staf/Edit',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $("#LoadingEdit").show();
          $("#Edit").prop('disabled', true);
        },
        success: function(Respon){
          if (Respon == '1') {
            window.location = BaseURL + "Staf/Project";
          } else {
            alert(Respon);
            $("#LoadingEdit").hide();
            $("#Edit").prop('disabled', false);
          }
        },
        error: function() {
          alert("Terjadi kesalahan sistem saat mengupdate data!");
          $("#LoadingEdit").hide();
          $("#Edit").prop('disabled', false);
        }
      });
    });

    // Hapus Action
    $(document).on("click", ".Hapus", function(){
      var Data = $(this).attr('Hapus').split("$");
      var Hapus = { 
        Id: Data[0],
        File: Data[1] 
      };
      
      $.post(BaseURL + "Staf/Hapus", Hapus).done(function(Respon) {
        if (Respon == '1') {
          window.location = BaseURL + "Staf/Project";
        } else {
          alert(Respon);
        }
      }).fail(function() {
        alert("Terjadi kesalahan saat menghapus data!");
      });
    });
  });
</script>
</body>
</html>