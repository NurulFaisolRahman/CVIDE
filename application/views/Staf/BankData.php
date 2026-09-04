<?php
// Helper untuk mengurai daftar link Google Drive
function getBankDataLinks($linkField) {
  if (empty($linkField)) return array();
  $decoded = json_decode($linkField, true);
  if (is_array($decoded)) {
    return array_values(array_filter($decoded));
  }
  return array();
}

// Helper untuk menampilkan lencana Indikator
function renderBankIndikator($indikator) {
  if (empty($indikator)) {
    return '<span class="text-muted" style="font-size: 12px;">-</span>';
  }
  return '
    <span class="badge px-3 py-2" style="background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; border-radius: 8px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
      <i class="fa-solid fa-circle-check text-success" style="font-size: 11px;"></i> ' . htmlspecialchars($indikator) . '
    </span>';
}

$userLevel = (int)($this->session->userdata('level') ?? 3);
$isRole4 = ($userLevel === 4);
?>

<!-- Extra Styling for Bank Data GDrive Link Hub -->
<style>
  .gdrive-link-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 6px 14px;
    border-radius: 12px;
    background: #ffffff;
    border: 1.5px solid #cbd5e1;
    color: #043168;
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none !important;
    transition: all 0.25s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
  }
  .gdrive-link-btn:hover {
    background: #f0fdf4;
    border-color: #22c55e;
    color: #15803d;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.2);
  }
  .gdrive-link-btn i.fa-google-drive {
    font-size: 15px;
    color: #0f9d58;
  }
  .gdrive-link-row-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 12px 14px;
    margin-bottom: 10px;
    transition: all 0.2s ease;
  }
  .gdrive-link-row-card:hover {
    background: #ffffff;
    border-color: #cbd5e1;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  }

  /* Perfect Horizontal Alignment for Bank Data DataTable */
  #TabelBankData_wrapper > .row:first-child {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    margin-bottom: 14px !important;
    flex-wrap: wrap !important;
    gap: 10px 0 !important;
  }
  #TabelBankData_wrapper .dataTables_length {
    margin-bottom: 0 !important;
    display: flex !important;
    align-items: center !important;
  }
  #TabelBankData_wrapper .dataTables_length label {
    margin-bottom: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #334155 !important;
  }
  #TabelBankData_wrapper .dataTables_length select {
    height: 35px !important;
    border-radius: 8px !important;
    border: 1px solid #cbd5e1 !important;
    padding: 3px 8px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #043168 !important;
    background-color: #ffffff !important;
  }
  #TabelBankData_wrapper .dataTables_filter {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    margin-bottom: 0 !important;
  }
  #TabelBankData_wrapper .dataTables_filter label {
    margin-bottom: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #334155 !important;
  }
  #TabelBankData_wrapper .dataTables_filter input {
    height: 35px !important;
    border-radius: 8px !important;
    border: 1px solid #cbd5e1 !important;
    padding: 4px 12px !important;
    font-size: 13px !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
  }
</style>

<!-- Enterprise Page Header Card -->
<div class="row mb-3" style="margin-top: 22px;">
  <div class="col-12">
    <div class="card border-0" style="background: #ffffff; border-radius: 20px; border: 1px solid var(--ide-border) !important; box-shadow: 0 8px 24px rgba(4, 49, 104, 0.05); padding: 18px 24px;">
      <div class="d-flex align-items-center" style="gap: 16px;">
        <div style="width: 50px; height: 50px; border-radius: 14px; background: linear-gradient(135deg, rgba(4, 49, 104, 0.1) 0%, rgba(180, 8, 20, 0.1) 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <i class="fa-solid fa-database" style="color: var(--ide-navy); font-size: 24px;"></i>
        </div>
        <div>
          <div class="d-flex align-items-center" style="gap: 10px;">
            <h4 class="font-weight-bold text-dark mb-0" style="font-size: 18px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
              Bank Data & Dokumen Google Drive
            </h4>
            <span class="badge badge-primary px-2 py-1" style="background: var(--ide-navy); font-size: 11px; font-weight: 600; border-radius: 6px;">Portal Bank Data</span>
          </div>
          <p class="text-muted mb-0 mt-1" style="font-size: 12.5px;">
            Kelola daftar data dokumen, tautan Google Drive berlabel, dan indikator status untuk keteraturan arsip.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card shadow-sm border-0" style="border-radius: 16px;">
      <div class="card-body p-3">
        <!-- Tombol Tambah Bank Data di Atas 'Tampilkan [10] data' -->
        <div class="mb-3">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalInputBankData" style="border-radius: 10px; font-weight: 700; padding: 9px 20px; font-size: 13px; background: var(--ide-navy); border: none; box-shadow: 0 4px 14px rgba(4, 49, 104, 0.3); transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-plus"></i> Tambah Bank Data Baru
          </button>
        </div>
        <div class="table-responsive">
          <table id="TabelBankData" class="table table-hover table-striped w-100" style="border-radius: 12px; overflow: hidden;">
            <thead>
              <tr style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff;">
                <th style="width: 5%;" class="text-center align-middle">No</th>
                <th style="width: 32%;" class="align-middle">Nama Dokumen / Data</th>
                <th style="width: 36%;" class="align-middle">Tautan Link Google Drive</th>
                <th style="width: 15%;" class="text-center align-middle">Indikator</th>
                <th style="width: 12%;" class="text-center align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $No = 1; 
              foreach ($BankData as $key) { 
                $links = getBankDataLinks($key['LinkGDrive'] ?? '');
                $linksJsonAttr = htmlspecialchars(json_encode($links), ENT_QUOTES, 'UTF-8');
              ?>
                <tr>
                  <td class="text-center align-middle font-weight-bold"><?=$No++?></td>
                  <td class="align-middle font-weight-bold text-dark" style="font-size: 13.5px;">
                    <i class="fa-solid fa-file-shield mr-2 text-primary"></i> <?=htmlspecialchars($key['NamaDokumen'])?>
                  </td>
                  <td class="align-middle">
                    <?php if (!empty($links) && count($links) > 0) { ?>
                      <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                        <?php foreach ($links as $linkItem) { 
                          $judul = !empty($linkItem['judul']) ? $linkItem['judul'] : 'Buka Google Drive';
                          $url = !empty($linkItem['url']) ? $linkItem['url'] : '#';
                        ?>
                          <a href="<?=htmlspecialchars($url)?>" target="_blank" rel="noopener noreferrer" class="gdrive-link-btn" title="Buka Link Google Drive">
                            <i class="fa-brands fa-google-drive"></i>
                            <span><?=htmlspecialchars($judul)?></span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-muted" style="font-size: 10px; margin-left: 2px;"></i>
                          </a>
                        <?php } ?>
                      </div>
                    <?php } else { ?>
                      <span class="text-muted" style="font-size: 12.5px;">Tidak ada link terlampir.</span>
                    <?php } ?>
                  </td>
                  <!-- Kolom Indikator Sebelum Aksi -->
                  <td class="text-center align-middle">
                    <?=renderBankIndikator($key['Indikator'] ?? '')?>
                  </td>
                  <td class="text-center align-middle text-nowrap">
                    <button type="button" 
                      class="btn btn-sm btn-warning text-white EditBankData" 
                      title="Edit Data" 
                      data-id="<?=$key['Id']?>"
                      data-nama="<?=htmlspecialchars($key['NamaDokumen'], ENT_QUOTES)?>"
                      data-indikator="<?=htmlspecialchars($key['Indikator'] ?? '', ENT_QUOTES)?>"
                      data-links="<?=$linksJsonAttr?>"
                      style="border-radius: 8px; padding: 6px 10px; font-weight: 600;">
                      <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                    </button>
                    <button type="button" 
                      data-id="<?=$key['Id']?>"
                      class="btn btn-sm btn-danger HapusBankData" 
                      title="Hapus Data" 
                      style="border-radius: 8px; padding: 6px 10px; font-weight: 600;">
                      <i class="fa-solid fa-trash-can mr-1"></i> Hapus
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

<!-- Modal Input Bank Data -->
<div class="modal fade" id="ModalInputBankData" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fa-solid fa-database mr-2"></i> Tambah Bank Data Baru
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-3">
          <label for="NamaDokumen">Nama Dokumen / Data <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="NamaDokumen" placeholder="Contoh: Master Kuesioner IKM & Laporan Survei 2026...">
        </div>

        <div class="form-group mb-3">
          <label for="Indikator">Indikator Dokumen</label>
          <input type="text" class="form-control" id="Indikator" placeholder="Contoh: Dokumen Acuan, Data Valid, Update Rutin, Selesai...">
          <small class="form-text text-muted mt-1">
            <i class="fa-solid fa-circle-info mr-1"></i> Label atau status indikator untuk dokumen data ini.
          </small>
        </div>

        <!-- Dynamic Multi-Link GDrive Container -->
        <div class="form-group mb-2">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <label class="mb-0 text-dark font-weight-bold">
              <i class="fa-brands fa-google-drive text-success mr-1"></i> Tautan Link Google Drive (Bisa Lebih Dari Satu)
            </label>
            <button type="button" class="btn btn-sm btn-success btn-add-gdrive-row" style="border-radius: 12px; font-weight: 600; font-size: 12px; padding: 5px 12px;">
              <i class="fa-solid fa-plus mr-1"></i> Tambah Link
            </button>
          </div>
          
          <div id="InputGDriveLinksContainer">
            <!-- Initial Row -->
            <div class="gdrive-link-row-card">
              <div class="row align-items-center" style="gap: 0;">
                <div class="col-md-5 mb-2 mb-md-0">
                  <input type="text" class="form-control form-control-sm gdrive-judul-input" placeholder="Judul Link (misal: Folder Master)">
                </div>
                <div class="col-md-6 mb-2 mb-md-0">
                  <input type="url" class="form-control form-control-sm gdrive-url-input" placeholder="https://drive.google.com/...">
                </div>
                <div class="col-md-1 text-center">
                  <button type="button" class="btn btn-sm btn-danger btn-remove-gdrive-row" style="border-radius: 8px; padding: 5px 9px;" title="Hapus Baris Ini">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <small class="form-text text-muted mt-2">
            <i class="fa-solid fa-circle-info mr-1"></i> Berikan judul pada masing-masing tautan (contoh: <em>Folder Raw Data, File Spreadsheet, Dokumentasi Kegiatan</em>) dan tempel tautan URL Google Drive.
          </small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="SubmitInputBankData">
          <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Data
        </button>
        <div id="LoadingInputBank" class="spinner-border text-danger ml-2" role="status" style="display: none; width: 1.5rem; height: 1.5rem;"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Bank Data -->
<div class="modal fade" id="ModalEditBankData" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Bank Data
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="EditBankId">

        <div class="form-group mb-3">
          <label for="EditNamaDokumen">Nama Dokumen / Data <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="EditNamaDokumen" placeholder="Contoh: Master Kuesioner IKM & Laporan Survei 2026...">
        </div>

        <div class="form-group mb-3">
          <label for="EditIndikator">Indikator Dokumen</label>
          <input type="text" class="form-control" id="EditIndikator" placeholder="Contoh: Dokumen Acuan, Data Valid, Update Rutin, Selesai...">
          <small class="form-text text-muted mt-1">
            <i class="fa-solid fa-circle-info mr-1"></i> Label atau status indikator untuk dokumen data ini.
          </small>
        </div>

        <!-- Dynamic Multi-Link GDrive Container in Edit -->
        <div class="form-group mb-2">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <label class="mb-0 text-dark font-weight-bold">
              <i class="fa-brands fa-google-drive text-success mr-1"></i> Tautan Link Google Drive (Bisa Lebih Dari Satu)
            </label>
            <button type="button" class="btn btn-sm btn-success btn-add-edit-gdrive-row" style="border-radius: 12px; font-weight: 600; font-size: 12px; padding: 5px 12px;">
              <i class="fa-solid fa-plus mr-1"></i> Tambah Link
            </button>
          </div>
          
          <div id="EditGDriveLinksContainer">
            <!-- Dynamic rows populated via JS -->
          </div>

          <small class="form-text text-muted mt-2">
            <i class="fa-solid fa-circle-info mr-1"></i> Tambahkan atau sesuaikan judul tautan beserta link Google Drive.
          </small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="SubmitEditBankData">
          <i class="fa-solid fa-floppy-disk mr-1"></i> Update Data
        </button>
        <div id="LoadingEditBank" class="spinner-border text-danger ml-2" role="status" style="display: none; width: 1.5rem; height: 1.5rem;"></div>
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
    
    var table = $('#TabelBankData').DataTable({
      "ordering": true,
      "pageLength": 10,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
      "language": {
        "search": "Cari Bank Data:",
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

    // Helper membuat template baris Link GDrive
    function createGDriveRowHtml(judul, url) {
      judul = judul || '';
      url = url || '';
      return (
        '<div class="gdrive-link-row-card">' +
          '<div class="row align-items-center" style="gap: 0;">' +
            '<div class="col-md-5 mb-2 mb-md-0">' +
              '<input type="text" class="form-control form-control-sm gdrive-judul-input" placeholder="Judul Link (misal: Folder Master)" value="' + $('<div>').text(judul).html() + '">' +
            '</div>' +
            '<div class="col-md-6 mb-2 mb-md-0">' +
              '<input type="url" class="form-control form-control-sm gdrive-url-input" placeholder="https://drive.google.com/..." value="' + $('<div>').text(url).html() + '">' +
            '</div>' +
            '<div class="col-md-1 text-center">' +
              '<button type="button" class="btn btn-sm btn-danger btn-remove-gdrive-row" style="border-radius: 8px; padding: 5px 9px;" title="Hapus Baris Ini">' +
                '<i class="fa-solid fa-trash-can"></i>' +
              '</button>' +
            '</div>' +
          '</div>' +
        '</div>'
      );
    }

    // Tambah baris link di Modal Input
    $(document).on('click', '.btn-add-gdrive-row', function(e) {
      e.preventDefault();
      $('#InputGDriveLinksContainer').append(createGDriveRowHtml('', ''));
    });

    // Tambah baris link di Modal Edit
    $(document).on('click', '.btn-add-edit-gdrive-row', function(e) {
      e.preventDefault();
      $('#EditGDriveLinksContainer').append(createGDriveRowHtml('', ''));
    });

    // Hapus baris link
    $(document).on('click', '.btn-remove-gdrive-row', function(e) {
      e.preventDefault();
      var $container = $(this).closest('#InputGDriveLinksContainer, #EditGDriveLinksContainer');
      if ($container.find('.gdrive-link-row-card').length > 1) {
        $(this).closest('.gdrive-link-row-card').remove();
      } else {
        $(this).closest('.gdrive-link-row-card').find('input').val('');
      }
    });

    // Reset baris saat Modal Input dibuka
    $('#ModalInputBankData').on('show.bs.modal', function() {
      $('#NamaDokumen').val('');
      $('#Indikator').val('');
      $('#InputGDriveLinksContainer').html(createGDriveRowHtml('', ''));
    });

    // Helper mengumpulkan list link dari container
    function collectGDriveLinks($container) {
      var links = [];
      $container.find('.gdrive-link-row-card').each(function() {
        var j = $(this).find('.gdrive-judul-input').val().trim();
        var u = $(this).find('.gdrive-url-input').val().trim();
        if (u !== '') {
          links.push({
            judul: j !== '' ? j : 'Link Google Drive',
            url: u
          });
        }
      });
      return links;
    }

    // Submit Input Bank Data
    $('#SubmitInputBankData').click(function() {
      var namaDokumen = $("#NamaDokumen").val().trim();
      if (namaDokumen === "") {
        alert("Nama Dokumen tidak boleh kosong!");
        return;
      }

      var links = collectGDriveLinks($('#InputGDriveLinksContainer'));

      $.ajax({
        url: BaseURL + 'Staf/InputBankData',
        type: 'post',
        data: {
          NamaDokumen: namaDokumen,
          Indikator: $("#Indikator").val().trim(),
          LinkGDrive: JSON.stringify(links)
        },
        beforeSend: function(){
          $("#LoadingInputBank").show();
          $("#SubmitInputBankData").prop('disabled', true);
        },
        success: function(Respon){
          if (Respon == '1') {
            window.location = BaseURL + "Staf/BankData";
          } else {
            alert(Respon);
            $("#LoadingInputBank").hide();
            $("#SubmitInputBankData").prop('disabled', false);
          }
        },
        error: function() {
          alert("Terjadi kesalahan sistem saat menyimpan data!");
          $("#LoadingInputBank").hide();
          $("#SubmitInputBankData").prop('disabled', false);
        }
      });
    });

    // Edit Click
    $(document).on("click", ".EditBankData", function(){
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var indikator = $(this).data('indikator');
      var linksData = $(this).data('links');

      var links = [];
      if (Array.isArray(linksData)) {
        links = linksData;
      } else if (typeof linksData === 'string' && linksData !== '') {
        try {
          var parsed = JSON.parse(linksData);
          if (Array.isArray(parsed)) links = parsed;
        } catch(e){}
      }

      $("#EditBankId").val(id || '');
      $("#EditNamaDokumen").val(nama || '');
      $("#EditIndikator").val(indikator || '');

      var $editContainer = $('#EditGDriveLinksContainer');
      $editContainer.empty();

      if (links.length > 0) {
        $.each(links, function(i, item) {
          $editContainer.append(createGDriveRowHtml(item.judul, item.url));
        });
      } else {
        $editContainer.append(createGDriveRowHtml('', ''));
      }

      $('#ModalEditBankData').modal("show");
    });

    // Submit Edit Bank Data
    $('#SubmitEditBankData').click(function() {
      var namaDokumen = $("#EditNamaDokumen").val().trim();
      if (namaDokumen === "") {
        alert("Nama Dokumen tidak boleh kosong!");
        return;
      }

      var links = collectGDriveLinks($('#EditGDriveLinksContainer'));

      $.ajax({
        url: BaseURL + 'Staf/EditBankData',
        type: 'post',
        data: {
          Id: $("#EditBankId").val(),
          NamaDokumen: namaDokumen,
          Indikator: $("#EditIndikator").val().trim(),
          LinkGDrive: JSON.stringify(links)
        },
        beforeSend: function(){
          $("#LoadingEditBank").show();
          $("#SubmitEditBankData").prop('disabled', true);
        },
        success: function(Respon){
          if (Respon == '1') {
            window.location = BaseURL + "Staf/BankData";
          } else {
            alert(Respon);
            $("#LoadingEditBank").hide();
            $("#SubmitEditBankData").prop('disabled', false);
          }
        },
        error: function() {
          alert("Terjadi kesalahan sistem saat mengupdate data!");
          $("#LoadingEditBank").hide();
          $("#SubmitEditBankData").prop('disabled', false);
        }
      });
    });

    // Hapus Bank Data
    $(document).on("click", ".HapusBankData", function(){
      var id = $(this).data('id');

      $.post(BaseURL + "Staf/HapusBankData", { Id: id }).done(function(Respon) {
        if (Respon == '1') {
          window.location = BaseURL + "Staf/BankData";
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
