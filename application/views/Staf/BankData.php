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

// Helper untuk mengurai daftar berkas dokumen fisik yang diunggah
function getBankDataFiles($fileField) {
  if (empty($fileField)) return array();
  $decoded = json_decode($fileField, true);
  if (is_array($decoded)) {
    return array_values(array_filter($decoded));
  }
  return array();
}

// Helper untuk metadata ekstensi berkas dokumen (ikon & warna)
function getDocFileMeta($ext) {
  $ext = strtolower(trim($ext ?? ''));
  switch ($ext) {
    case 'pdf':
      return array('icon' => 'fa-solid fa-file-pdf', 'color' => '#dc2626', 'bg' => '#fef2f2', 'border' => '#fca5a5', 'label' => 'PDF');
    case 'doc':
    case 'docx':
      return array('icon' => 'fa-solid fa-file-word', 'color' => '#2563eb', 'bg' => '#eff6ff', 'border' => '#bfdbfe', 'label' => 'Word');
    case 'xls':
    case 'xlsx':
    case 'csv':
      return array('icon' => 'fa-solid fa-file-excel', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'border' => '#bbf7d0', 'label' => 'Excel');
    case 'ppt':
    case 'pptx':
      return array('icon' => 'fa-solid fa-file-powerpoint', 'color' => '#ea580c', 'bg' => '#fff7ed', 'border' => '#fed7aa', 'label' => 'PPT');
    case 'zip':
    case 'rar':
    case '7z':
    case 'tar':
    case 'gz':
      return array('icon' => 'fa-solid fa-file-zipper', 'color' => '#d97706', 'bg' => '#fffbeb', 'border' => '#fde68a', 'label' => 'ZIP/RAR');
    case 'jpg':
    case 'jpeg':
    case 'png':
      return array('icon' => 'fa-solid fa-file-image', 'color' => '#7c3aed', 'bg' => '#f5f3ff', 'border' => '#ddd6fe', 'label' => 'Gambar');
    default:
      return array('icon' => 'fa-solid fa-file-lines', 'color' => '#475569', 'bg' => '#f8fafc', 'border' => '#cbd5e1', 'label' => strtoupper($ext ?: 'DOC'));
  }
}

// Helper untuk menampilkan badge tipe lampiran
function renderBankTipeBadge($tipe, $hasFiles, $hasLinks) {
  if ($hasFiles && $hasLinks) {
    return '
      <span class="badge px-2 py-1" style="background: #fdf2f8; color: #9d174d; border: 1px solid #fbcfe8; font-size: 11px; font-weight: 600; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
        <i class="fa-solid fa-layer-group text-danger"></i> Dokumen & GDrive
      </span>';
  } else if ($hasFiles) {
    return '
      <span class="badge px-2 py-1" style="background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; font-size: 11px; font-weight: 600; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
        <i class="fa-solid fa-file-arrow-up text-primary"></i> Berkas Dokumen
      </span>';
  } else if ($hasLinks) {
    return '
      <span class="badge px-2 py-1" style="background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; font-size: 11px; font-weight: 600; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
        <i class="fa-brands fa-google-drive text-success"></i> Google Drive
      </span>';
  }
  return '<span class="text-muted" style="font-size: 11px;">-</span>';
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

$ci =& get_instance();
$userLevel = (int)($ci->session->userdata('level') ?? 3);
$isRole4 = ($userLevel === 4);
?>

<!-- Extra Styling for Bank Data (Harmonized with Project Style) -->
<style>
  /* Button Link Google Drive */
  .gdrive-link-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 6px 14px;
    border-radius: 12px;
    background: #ffffff;
    border: 1.5px solid #cbd5e1;
    color: #043168;
    font-size: 12px;
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
    font-size: 14px;
    color: #0f9d58;
  }

  /* Button Unduh Dokumen File */
  .bank-doc-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 14px;
    border-radius: 12px;
    background: #ffffff;
    border: 1.5px solid #cbd5e1;
    color: #043168;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none !important;
    transition: all 0.25s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
  }
  .bank-doc-btn:hover {
    background: #eff6ff;
    border-color: #3b82f6;
    color: #1d4ed8;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
  }

  /* =========================================================================
     HARMONIZED COMPACT STYLE FOR MODAL UPLOAD ENTRY FORM (SAME AS PROJECT)
     ========================================================================= */
  .upload-file-entry-row {
    background: #ffffff;
    border: 1px solid #e2e8f0 !important;
    border-radius: 12px;
    padding: 8px 10px;
    margin-bottom: 8px;
  }
  .upload-file-entry-row label {
    font-size: 10px !important;
    font-weight: 700 !important;
    color: #334155 !important;
    margin-bottom: 3px !important;
    letter-spacing: 0.3px;
    display: block;
    white-space: nowrap;
    text-transform: uppercase;
  }
  .upload-file-entry-row select.form-control,
  .upload-file-entry-row input[type="text"].form-control,
  .upload-file-entry-row input[type="url"].form-control,
  .upload-file-entry-row input[type="file"].form-control {
    height: 33px !important;
    min-height: 33px !important;
    font-size: 11.5px !important;
    border-radius: 20px !important;
    border: 1.5px solid #cbd5e1 !important;
    background-color: #ffffff !important;
    box-shadow: none !important;
    line-height: 1.4 !important;
    color: #1e293b !important;
    box-sizing: border-box !important;
  }
  .upload-file-entry-row select.form-control {
    padding: 3px 10px !important;
    font-weight: 600;
  }
  .upload-file-entry-row input[type="text"].form-control,
  .upload-file-entry-row input[type="url"].form-control {
    padding: 4px 12px !important;
  }
  .upload-file-entry-row input[type="file"].form-control {
    padding: 0 8px !important;
    font-size: 11px !important;
    display: flex !important;
    align-items: center !important;
    height: 33px !important;
    line-height: 31px !important;
  }
  .upload-file-entry-row input[type="file"]::file-selector-button,
  .upload-file-entry-row input[type="file"]::-webkit-file-upload-button {
    font-size: 9.5px !important;
    padding: 1px 9px !important;
    height: 22px !important;
    line-height: 20px !important;
    border-radius: 12px !important;
    border: 1px solid #cbd5e1 !important;
    background-color: #f1f5f9 !important;
    color: #334155 !important;
    font-weight: 600 !important;
    margin-right: 8px !important;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    cursor: pointer !important;
    vertical-align: middle !important;
    align-self: center !important;
    transition: all 0.2s ease;
  }
  .upload-file-entry-row input[type="file"]::file-selector-button:hover,
  .upload-file-entry-row input[type="file"]::-webkit-file-upload-button:hover {
    background-color: #e2e8f0 !important;
    color: #0f172a !important;
  }
  .upload-file-entry-row .btn-remove-upload-entry-row {
    height: 31px !important;
    width: 31px !important;
    min-width: 31px !important;
    padding: 0 !important;
    border-radius: 8px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 0 !important;
    font-size: 11px !important;
    border-color: #fca5a5 !important;
    color: #ef4444 !important;
    transition: all 0.2s ease;
  }
  .upload-file-entry-row .btn-remove-upload-entry-row:hover {
    background-color: #fef2f2 !important;
    border-color: #ef4444 !important;
    color: #dc2626 !important;
  }

  /* Existing Item Cards in Edit Modal */
  .existing-item-row-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 9px 14px;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    transition: all 0.2s ease;
  }
  .existing-item-row-card:hover {
    border-color: #93c5fd;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
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
              Bank Data & Dokumen Terintegrasi
            </h4>
            <span class="badge badge-primary px-2 py-1" style="background: var(--ide-navy); font-size: 11px; font-weight: 600; border-radius: 6px;">Portal Bank Data</span>
          </div>
          <p class="text-muted mb-0 mt-1" style="font-size: 12.5px;">
            Kelola arsip dokumen perusahaan melalui unggah berkas fisik dokumen atau tautan Google Drive berlabel (persis seperti manajemen dokumen Project).
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
        <!-- Tombol Tambah Bank Data Baru -->
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
                <th style="width: 28%;" class="align-middle">Nama Dokumen / Data</th>
                <th style="width: 40%;" class="align-middle">Dokumen / Tautan Lampiran</th>
                <th style="width: 15%;" class="text-center align-middle">Indikator</th>
                <th style="width: 12%;" class="text-center align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $No = 1; 
              foreach ($BankData as $key) { 
                $links = getBankDataLinks($key['LinkGDrive'] ?? '');
                $files = getBankDataFiles($key['FileDokumen'] ?? '');
                $hasLinks = !empty($links);
                $hasFiles = !empty($files);
                $tipe = $key['Tipe'] ?? 'gdrive';

                $linksJsonAttr = htmlspecialchars(json_encode($links), ENT_QUOTES, 'UTF-8');
                $filesJsonAttr = htmlspecialchars(json_encode($files), ENT_QUOTES, 'UTF-8');
              ?>
                <tr>
                  <td class="text-center align-middle font-weight-bold"><?=$No++?></td>
                  <td class="align-middle">
                    <div class="d-flex align-items-center mb-1" style="gap: 8px;">
                      <i class="fa-solid fa-file-shield text-primary" style="font-size: 15px;"></i>
                      <span class="font-weight-bold text-dark" style="font-size: 13.5px;"><?=htmlspecialchars($key['NamaDokumen'])?></span>
                    </div>
                    <div>
                      <?=renderBankTipeBadge($tipe, $hasFiles, $hasLinks)?>
                    </div>
                  </td>
                  <td class="align-middle">
                    <?php if (!$hasFiles && !$hasLinks) { ?>
                      <span class="text-muted" style="font-size: 12px;">Tidak ada berkas/link terlampir.</span>
                    <?php } else { ?>
                      <div class="d-flex flex-column" style="gap: 8px;">
                        <!-- Bagian Berkas Dokumen Diunggah -->
                        <?php if ($hasFiles) { ?>
                          <div>
                            <?php if ($hasLinks) { ?>
                              <div class="text-muted font-weight-bold mb-1" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.4px;">
                                <i class="fa-solid fa-file-arrow-up text-primary mr-1"></i> Berkas Dokumen:
                              </div>
                            <?php } ?>
                            <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                              <?php foreach ($files as $fItem) { 
                                $fJudul = !empty($fItem['judul']) ? $fItem['judul'] : ($fItem['nama_asli'] ?? 'Dokumen');
                                $fPath = $fItem['file'] ?? '';
                                $fExt = $fItem['ekstensi'] ?? pathinfo($fPath, PATHINFO_EXTENSION);
                                $fSize = $fItem['ukuran'] ?? '';
                                $meta = getDocFileMeta($fExt);
                              ?>
                                <a href="<?=base_url($fPath)?>" target="_blank" download class="bank-doc-btn" title="Klik untuk mengunduh: <?=htmlspecialchars($fItem['nama_asli'] ?? $fJudul)?>">
                                  <i class="<?=$meta['icon']?>" style="color: <?=$meta['color']?>; font-size: 14px;"></i>
                                  <span><?=htmlspecialchars($fJudul)?></span>
                                  <span class="badge" style="background: <?=$meta['bg']?>; color: <?=$meta['color']?>; border: 1px solid <?=$meta['border']?>; font-size: 10px; font-weight: 600; padding: 2px 6px; border-radius: 5px;"><?=$meta['label']?></span>
                                  <?php if (!empty($fSize)) { ?>
                                    <span class="text-muted" style="font-size: 11px;">(<?=$fSize?>)</span>
                                  <?php } ?>
                                  <i class="fa-solid fa-download text-muted" style="font-size: 10px; margin-left: 2px;"></i>
                                </a>
                              <?php } ?>
                            </div>
                          </div>
                        <?php } ?>

                        <!-- Bagian Tautan Google Drive -->
                        <?php if ($hasLinks) { ?>
                          <div>
                            <?php if ($hasFiles) { ?>
                              <div class="text-muted font-weight-bold mb-1 mt-1" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.4px;">
                                <i class="fa-brands fa-google-drive text-success mr-1"></i> Tautan Google Drive:
                              </div>
                            <?php } ?>
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
                          </div>
                        <?php } ?>
                      </div>
                    <?php } ?>
                  </td>
                  <!-- Kolom Indikator -->
                  <td class="text-center align-middle">
                    <?=renderBankIndikator($key['Indikator'] ?? '')?>
                  </td>
                  <!-- Kolom Aksi -->
                  <td class="text-center align-middle text-nowrap">
                    <button type="button" 
                      class="btn btn-sm btn-warning text-white EditBankData" 
                      title="Edit Data" 
                      data-id="<?=$key['Id']?>"
                      data-nama="<?=htmlspecialchars($key['NamaDokumen'], ENT_QUOTES)?>"
                      data-indikator="<?=htmlspecialchars($key['Indikator'] ?? '', ENT_QUOTES)?>"
                      data-links="<?=$linksJsonAttr?>"
                      data-files="<?=$filesJsonAttr?>"
                      style="border-radius: 8px; padding: 6px 10px; font-weight: 600;">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button type="button" 
                      data-id="<?=$key['Id']?>"
                      data-nama="<?=htmlspecialchars($key['NamaDokumen'], ENT_QUOTES)?>"
                      class="btn btn-sm btn-danger HapusBankData" 
                      title="Hapus Data" 
                      style="border-radius: 8px; padding: 6px 10px; font-weight: 600;">
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

<!-- ======================================================================== -->
<!-- MODAL INPUT BANK DATA (SAMA SEPERTI PADA PROJECT)                        -->
<!-- ======================================================================== -->
<div class="modal fade" id="ModalInputBankData" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff; padding: 12px 20px;">
        <h5 class="modal-title font-weight-bold" style="font-size: 15px;">
          <i class="fa-solid fa-database mr-2"></i> Tambah Bank Data Baru
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4" style="background-color: #f8fafc;">
        <!-- Form Nama Dokumen -->
        <div class="form-group mb-3">
          <label for="NamaDokumen" class="font-weight-bold text-dark" style="font-size: 13px;">
            Nama Dokumen / Data <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" id="NamaDokumen" placeholder="Contoh: Master Kuesioner IKM & Laporan Survei 2026..." style="border-radius: 8px;">
        </div>

        <!-- Form Indikator -->
        <div class="form-group mb-3">
          <label for="Indikator" class="font-weight-bold text-dark" style="font-size: 13px;">Indikator Dokumen</label>
          <input type="text" class="form-control" id="Indikator" placeholder="Contoh: Dokumen Acuan, Data Valid, Update Rutin, Selesai..." style="border-radius: 8px;">
          <small class="form-text text-muted mt-1">
            <i class="fa-solid fa-circle-info mr-1"></i> Label atau status indikator untuk dokumen data ini.
          </small>
        </div>

        <!-- Area Upload Dokumen / Link GDrive (Format Persis Seperti Project) -->
        <div class="card p-3 mb-2 border" style="border-radius: 12px; background: #ffffff; border-color: #cbd5e1 !important; box-shadow: 0 1px 4px rgba(0,0,0,0.03);">
          <div class="d-flex flex-wrap align-items-center justify-content-between mb-2" style="gap: 6px;">
            <span class="font-weight-bold text-dark" style="font-size: 12px;">
              <i class="fa-solid fa-cloud-arrow-up text-primary mr-1"></i> Unggah Berkas Dokumen atau Tautan Google Drive
            </span>
            <button type="button" class="btn btn-sm btn-outline-primary font-weight-bold" id="BtnAddUploadRowInput" style="border-radius: 6px; font-size: 11px; padding: 3px 9px;">
              <i class="fa-solid fa-plus mr-1"></i> Tambah Dokumen
            </button>
          </div>

          <!-- Container Baris Upload (Sama Seperti Project) -->
          <div id="InputUploadRowsContainer" class="upload-rows-container">
            <!-- Dynamic rows generated by JS -->
          </div>

          <div class="d-flex flex-wrap align-items-center justify-content-between mt-2 pt-2 border-top" style="gap: 8px;">
            <small class="text-muted" style="font-size: 10.5px;">
              <i class="fa-solid fa-circle-info mr-1"></i> Format: <strong>PDF, Word, Excel, ZIP, RAR, atau Tautan Google Drive</strong>.
            </small>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="background: #ffffff; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
        <button type="button" class="btn btn-primary" id="SubmitInputBankData" style="border-radius: 8px; font-weight: 700; background: var(--ide-navy); border: none; padding: 8px 20px;">
          <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Data
        </button>
        <div id="LoadingInputBank" class="spinner-border text-danger ml-2" role="status" style="display: none; width: 1.5rem; height: 1.5rem;"></div>
      </div>
    </div>
  </div>
</div>

<!-- ======================================================================== -->
<!-- MODAL EDIT BANK DATA (SAMA SEPERTI PADA PROJECT)                         -->
<!-- ======================================================================== -->
<div class="modal fade" id="ModalEditBankData" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff; padding: 12px 20px;">
        <h5 class="modal-title font-weight-bold" style="font-size: 15px;">
          <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Bank Data
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4" style="background-color: #f8fafc;">
        <input type="hidden" id="EditBankId">

        <!-- Form Nama Dokumen -->
        <div class="form-group mb-3">
          <label for="EditNamaDokumen" class="font-weight-bold text-dark" style="font-size: 13px;">
            Nama Dokumen / Data <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" id="EditNamaDokumen" placeholder="Contoh: Master Kuesioner IKM & Laporan Survei 2026..." style="border-radius: 8px;">
        </div>

        <!-- Form Indikator -->
        <div class="form-group mb-3">
          <label for="EditIndikator" class="font-weight-bold text-dark" style="font-size: 13px;">Indikator Dokumen</label>
          <input type="text" class="form-control" id="EditIndikator" placeholder="Contoh: Dokumen Acuan, Data Valid, Update Rutin, Selesai..." style="border-radius: 8px;">
          <small class="form-text text-muted mt-1">
            <i class="fa-solid fa-circle-info mr-1"></i> Label atau status indikator untuk dokumen data ini.
          </small>
        </div>

        <!-- Daftar Berkas & Tautan Terlampir Sebelumnya -->
        <div id="EditExistingItemsWrapper" class="mb-3" style="display: none;">
          <label class="font-weight-bold text-dark mb-2" style="font-size: 12.5px;">
            <i class="fa-solid fa-folder-open text-primary mr-1"></i> Berkas & Tautan yang Tersimpan:
          </label>
          <div id="EditExistingItemsContainer">
            <!-- Rendered via JS -->
          </div>
        </div>

        <!-- Area Tambah Dokumen / Link Baru (Format Persis Seperti Project) -->
        <div class="card p-3 mb-2 border" style="border-radius: 12px; background: #ffffff; border-color: #cbd5e1 !important; box-shadow: 0 1px 4px rgba(0,0,0,0.03);">
          <div class="d-flex flex-wrap align-items-center justify-content-between mb-2" style="gap: 6px;">
            <span class="font-weight-bold text-dark" style="font-size: 12px;">
              <i class="fa-solid fa-cloud-arrow-up text-primary mr-1"></i> Tambah Berkas Dokumen atau Tautan Google Drive Baru
            </span>
            <button type="button" class="btn btn-sm btn-outline-primary font-weight-bold" id="BtnAddUploadRowEdit" style="border-radius: 6px; font-size: 11px; padding: 3px 9px;">
              <i class="fa-solid fa-plus mr-1"></i> Tambah Dokumen
            </button>
          </div>

          <!-- Container Baris Upload Edit -->
          <div id="EditUploadRowsContainer" class="upload-rows-container">
            <!-- Dynamic rows generated by JS -->
          </div>

          <div class="d-flex flex-wrap align-items-center justify-content-between mt-2 pt-2 border-top" style="gap: 8px;">
            <small class="text-muted" style="font-size: 10.5px;">
              <i class="fa-solid fa-circle-info mr-1"></i> Format: <strong>PDF, Word, Excel, ZIP, RAR, atau Tautan Google Drive</strong>.
            </small>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="background: #ffffff; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
        <button type="button" class="btn btn-primary" id="SubmitEditBankData" style="border-radius: 8px; font-weight: 700; background: var(--ide-navy); border: none; padding: 8px 20px;">
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

    // State penyimpan berkas & link eksisting yang dipertahankan pada modal edit
    var currentEditFiles = [];
    var currentEditLinks = [];
    
    // Inisialisasi DataTable
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

    // =========================================================================
    // HELPER BUAT BARIS BARU UPLOAD BERKAS / LINK GDRIVE (PERSIS SEPERTI PROJECT)
    // =========================================================================
    function createUploadEntryRow(typeDefault, customNameDefault, urlDefault) {
      var isDrive = (typeDefault === 'drive');
      var nameVal = customNameDefault || '';
      var urlVal = urlDefault || '';

      return $(
        '<div class="upload-file-entry-row mb-2">' +
          '<div class="row align-items-center" style="margin-left: -4px; margin-right: -4px;">' +
            '<div class="col-md-3" style="padding-left: 4px; padding-right: 4px;">' +
              '<label><i class="fa-solid fa-layer-group mr-1 text-primary"></i> Tipe Sumber:</label>' +
              '<select class="form-control file-entry-type-select font-weight-bold">' +
                '<option value="file"' + (!isDrive ? ' selected' : '') + '>📁 File Berkas</option>' +
                '<option value="drive"' + (isDrive ? ' selected' : '') + '>🔗 Link GDrive</option>' +
              '</select>' +
            '</div>' +
            '<div class="col-md-4" style="padding-left: 4px; padding-right: 4px;">' +
              '<label><i class="fa-solid fa-pen-nib mr-1 text-primary"></i> Nama / Judul Dokumen:</label>' +
              '<input type="text" class="form-control file-entry-custom-name" placeholder="' + (isDrive ? 'Judul Dokumen...' : 'Ketik judul/nama...') + '" value="' + $('<div>').text(nameVal).html() + '">' +
            '</div>' +
            '<div class="col-md-4 file-input-col" style="padding-left: 4px; padding-right: 4px;' + (isDrive ? ' display:none;' : '') + '">' +
              '<label><i class="fa-solid fa-paperclip mr-1 text-primary"></i> Pilih Berkas:</label>' +
              '<input type="file" class="form-control file-entry-input" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.zip,.rar,.7z,.jpg,.jpeg,.png">' +
            '</div>' +
            '<div class="col-md-4 drive-input-col" style="padding-left: 4px; padding-right: 4px;' + (!isDrive ? ' display:none;' : '') + '">' +
              '<label><i class="fa-brands fa-google-drive text-success mr-1"></i> Link Google Drive:</label>' +
              '<input type="url" class="form-control file-entry-drive-url" placeholder="https://drive.google.com/..." value="' + $('<div>').text(urlVal).html() + '">' +
            '</div>' +
            '<div class="col-md-1 d-flex flex-column align-items-center justify-content-end" style="padding-left: 4px; padding-right: 4px;">' +
              '<label class="d-none d-md-block" style="visibility: hidden; font-size: 10px; margin-bottom: 3px; user-select: none;">&nbsp;</label>' +
              '<button type="button" class="btn btn-outline-danger btn-remove-upload-entry-row" title="Hapus Baris Ini">' +
                '<i class="fa-solid fa-trash-can"></i>' +
              '</button>' +
            '</div>' +
          '</div>' +
        '</div>'
      );
    }

    // Toggle dropdown Tipe Sumber pada baris upload (Sama seperti Project)
    $(document).on('change', '.file-entry-type-select', function() {
      var val = $(this).val();
      var $row = $(this).closest('.upload-file-entry-row');
      if (val === 'drive') {
        $row.find('.file-input-col').hide();
        $row.find('.drive-input-col').show();
        $row.find('.file-entry-custom-name').attr('placeholder', 'Judul Dokumen...');
      } else {
        $row.find('.drive-input-col').hide();
        $row.find('.file-input-col').show();
        $row.find('.file-entry-custom-name').attr('placeholder', 'Ketik judul/nama...');
      }
    });

    // Auto-fill nama dokumen manual saat file dipilih (Sama seperti Project)
    $(document).on('change', '.file-entry-input', function() {
      var file = this.files && this.files[0];
      if (file) {
        var $row = $(this).closest('.upload-file-entry-row');
        var $nameInput = $row.find('.file-entry-custom-name');
        if ($nameInput.val().trim() === '') {
          var nameWithoutExt = file.name.replace(/\.[^/.]+$/, "");
          $nameInput.val(nameWithoutExt);
        }
      }
    });

    // Hapus baris upload (Sama seperti Project)
    $(document).on('click', '.btn-remove-upload-entry-row', function(e) {
      e.preventDefault();
      var $container = $(this).closest('.upload-rows-container');
      if ($container.find('.upload-file-entry-row').length > 1) {
        $(this).closest('.upload-file-entry-row').remove();
      } else {
        var $row = $(this).closest('.upload-file-entry-row');
        $row.find('.file-entry-input').val('');
        $row.find('.file-entry-drive-url').val('');
        $row.find('.file-entry-custom-name').val('');
      }
    });

    // Tambah baris baru di Modal Input
    $('#BtnAddUploadRowInput').click(function(e) {
      e.preventDefault();
      $('#InputUploadRowsContainer').append(createUploadEntryRow('file'));
    });

    // Tambah baris baru di Modal Edit
    $('#BtnAddUploadRowEdit').click(function(e) {
      e.preventDefault();
      $('#EditUploadRowsContainer').append(createUploadEntryRow('file'));
    });

    // Reset saat Modal Input dibuka
    $('#ModalInputBankData').on('show.bs.modal', function() {
      $('#NamaDokumen').val('');
      $('#Indikator').val('');
      $('#InputUploadRowsContainer').empty().append(createUploadEntryRow('file'));
    });

    // =========================================================================
    // RENDER BERKAS & LINK EKSISTING DI MODAL EDIT
    // =========================================================================
    function renderEditExistingItemsList() {
      var $container = $('#EditExistingItemsContainer');
      $container.empty();

      var hasItems = (currentEditFiles.length > 0 || currentEditLinks.length > 0);
      if (!hasItems) {
        $('#EditExistingItemsWrapper').hide();
        return;
      }

      $('#EditExistingItemsWrapper').show();

      // Render Files
      $.each(currentEditFiles, function(idx, f) {
        var judul = f.judul || f.nama_asli || 'Dokumen';
        var namaAsli = f.nama_asli || '';
        var ukuran = f.ukuran || '';
        var filePath = f.file || '';
        var ext = (f.ekstensi || '').toLowerCase();

        var iconClass = 'fa-file-lines';
        var iconColor = '#475569';
        if (ext === 'pdf') { iconClass = 'fa-file-pdf'; iconColor = '#dc2626'; }
        else if (ext === 'doc' || ext === 'docx') { iconClass = 'fa-file-word'; iconColor = '#2563eb'; }
        else if (ext === 'xls' || ext === 'xlsx' || ext === 'csv') { iconClass = 'fa-file-excel'; iconColor = '#16a34a'; }
        else if (ext === 'zip' || ext === 'rar' || ext === '7z') { iconClass = 'fa-file-zipper'; iconColor = '#d97706'; }

        var html = 
          '<div class="existing-item-row-card">' +
            '<div class="d-flex align-items-center" style="gap: 12px; overflow: hidden; min-width: 0;">' +
              '<div style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; display: flex; align-items: center; justify-content: center; font-size: 16px; color: ' + iconColor + '; flex-shrink: 0;">' +
                '<i class="fa-solid ' + iconClass + '"></i>' +
              '</div>' +
              '<div style="min-width: 0;">' +
                '<div class="font-weight-bold text-dark text-truncate" style="font-size: 12.5px;">' + $('<div>').text(judul).html() + '</div>' +
                '<div class="text-muted" style="font-size: 11px;">' +
                  '<span class="badge mr-1" style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; border-radius: 4px; font-size: 9.5px; padding: 1px 5px;">File Berkas</span>' +
                  $('<div>').text(namaAsli).html() + (ukuran ? ' &bull; ' + $('<div>').text(ukuran).html() : '') +
                '</div>' +
              '</div>' +
            '</div>' +
            '<div class="d-flex align-items-center" style="gap: 6px; flex-shrink: 0;">' +
              '<a href="' + BaseURL + filePath + '" target="_blank" download class="btn btn-xs btn-outline-primary" style="border-radius: 6px; font-weight: 600; font-size: 11px; padding: 4px 8px;">' +
                '<i class="fa-solid fa-download mr-1"></i> Unduh' +
              '</a>' +
              '<button type="button" class="btn btn-xs btn-outline-danger btn-remove-existing-file" data-index="' + idx + '" style="border-radius: 6px; font-weight: 600; font-size: 11px; padding: 4px 8px;" title="Hapus Berkas Ini">' +
                '<i class="fa-solid fa-trash-can"></i>' +
              '</button>' +
            '</div>' +
          '</div>';

        $container.append(html);
      });

      // Render Google Drive Links
      $.each(currentEditLinks, function(idx, l) {
        var judul = l.judul || 'Link Google Drive';
        var url = l.url || '#';

        var html = 
          '<div class="existing-item-row-card">' +
            '<div class="d-flex align-items-center" style="gap: 12px; overflow: hidden; min-width: 0;">' +
              '<div style="width: 32px; height: 32px; border-radius: 8px; background: #f0fdf4; display: flex; align-items: center; justify-content: center; font-size: 16px; color: #16a34a; flex-shrink: 0;">' +
                '<i class="fa-brands fa-google-drive"></i>' +
              '</div>' +
              '<div style="min-width: 0;">' +
                '<div class="font-weight-bold text-dark text-truncate" style="font-size: 12.5px;">' + $('<div>').text(judul).html() + '</div>' +
                '<div class="text-muted text-truncate" style="font-size: 11px;">' +
                  '<span class="badge mr-1" style="background-color: #dcfce7; color: #15803d; border: 1px solid #86efac; border-radius: 4px; font-size: 9.5px; padding: 1px 5px;">Google Drive</span>' +
                  $('<div>').text(url).html() +
                '</div>' +
              '</div>' +
            '</div>' +
            '<div class="d-flex align-items-center" style="gap: 6px; flex-shrink: 0;">' +
              '<a href="' + url + '" target="_blank" rel="noopener noreferrer" class="btn btn-xs btn-outline-success" style="border-radius: 6px; font-weight: 600; font-size: 11px; padding: 4px 8px;">' +
                '<i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> Buka' +
              '</a>' +
              '<button type="button" class="btn btn-xs btn-outline-danger btn-remove-existing-link" data-index="' + idx + '" style="border-radius: 6px; font-weight: 600; font-size: 11px; padding: 4px 8px;" title="Hapus Tautan Ini">' +
                '<i class="fa-solid fa-trash-can"></i>' +
              '</button>' +
            '</div>' +
          '</div>';

        $container.append(html);
      });
    }

    // Hapus berkas eksisting
    $(document).on('click', '.btn-remove-existing-file', function(e) {
      e.preventDefault();
      var idx = parseInt($(this).data('index'), 10);
      if (confirm('Hapus berkas ini dari Bank Data? Berkas akan terhapus saat Anda menekan tombol Update Data.')) {
        currentEditFiles.splice(idx, 1);
        renderEditExistingItemsList();
      }
    });

    // Hapus tautan link eksisting
    $(document).on('click', '.btn-remove-existing-link', function(e) {
      e.preventDefault();
      var idx = parseInt($(this).data('index'), 10);
      if (confirm('Hapus tautan link ini dari Bank Data?')) {
        currentEditLinks.splice(idx, 1);
        renderEditExistingItemsList();
      }
    });

    // =========================================================================
    // SUBMIT INPUT BANK DATA (SAMA SEPERTI PROJECT)
    // =========================================================================
    $('#SubmitInputBankData').click(function() {
      var namaDokumen = $("#NamaDokumen").val().trim();
      if (namaDokumen === "") {
        alert("Nama Dokumen / Data tidak boleh kosong!");
        $("#NamaDokumen").focus();
        return;
      }

      var indikator = $("#Indikator").val().trim();
      var fd = new FormData();
      fd.append('NamaDokumen', namaDokumen);
      fd.append('Indikator', indikator);

      var validCount = 0;
      $('#InputUploadRowsContainer .upload-file-entry-row').each(function() {
        var sourceType = $(this).find('.file-entry-type-select').val();
        var customName = $(this).find('.file-entry-custom-name').val().trim();

        if (sourceType === 'drive') {
          var driveUrl = $(this).find('.file-entry-drive-url').val().trim();
          if (driveUrl !== '') {
            fd.append('DriveLinks[]', driveUrl);
            fd.append('DriveNames[]', customName);
            validCount++;
          }
        } else {
          var fileInput = $(this).find('.file-entry-input')[0];
          if (fileInput && fileInput.files && fileInput.files.length > 0) {
            fd.append('Files[]', fileInput.files[0]);
            fd.append('CustomNames[]', customName);
            validCount++;
          }
        }
      });

      if (validCount === 0) {
        alert("Silakan pilih minimal 1 berkas dokumen atau masukkan tautan Google Drive!");
        return;
      }

      $.ajax({
        url: BaseURL + 'Staf/InputBankData',
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        beforeSend: function(){
          $("#LoadingInputBank").show();
          $("#SubmitInputBankData").prop('disabled', true);
        },
        success: function(Respon){
          var res = $.trim(Respon);
          if (res == '1') {
            window.location = BaseURL + "Staf/BankData";
          } else {
            alert(res);
            $("#LoadingInputBank").hide();
            $("#SubmitInputBankData").prop('disabled', false);
          }
        },
        error: function() {
          alert("Terjadi kesalahan sistem saat menyimpan data dokumen!");
          $("#LoadingInputBank").hide();
          $("#SubmitInputBankData").prop('disabled', false);
        }
      });
    });

    // =========================================================================
    // EDIT CLICK & MODAL POPULATION
    // =========================================================================
    $(document).on("click", ".EditBankData", function(){
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var indikator = $(this).data('indikator');
      var linksData = $(this).data('links');
      var filesData = $(this).data('files');

      var links = [];
      if (Array.isArray(linksData)) {
        links = linksData;
      } else if (typeof linksData === 'string' && linksData !== '') {
        try {
          var parsed = JSON.parse(linksData);
          if (Array.isArray(parsed)) links = parsed;
        } catch(e){}
      }

      var files = [];
      if (Array.isArray(filesData)) {
        files = filesData;
      } else if (typeof filesData === 'string' && filesData !== '') {
        try {
          var parsedF = JSON.parse(filesData);
          if (Array.isArray(parsedF)) files = parsedF;
        } catch(e){}
      }

      $("#EditBankId").val(id || '');
      $("#EditNamaDokumen").val(nama || '');
      $("#EditIndikator").val(indikator || '');

      currentEditFiles = files.slice(0);
      currentEditLinks = links.slice(0);

      renderEditExistingItemsList();

      // Reset form upload baru dengan 1 baris
      $('#EditUploadRowsContainer').empty().append(createUploadEntryRow('file'));

      $('#ModalEditBankData').modal("show");
    });

    // =========================================================================
    // SUBMIT EDIT BANK DATA (SAMA SEPERTI PROJECT)
    // =========================================================================
    $('#SubmitEditBankData').click(function() {
      var id = $("#EditBankId").val();
      if (!id) {
        alert("ID Bank Data tidak valid!");
        return;
      }

      var namaDokumen = $("#EditNamaDokumen").val().trim();
      if (namaDokumen === "") {
        alert("Nama Dokumen / Data tidak boleh kosong!");
        $("#EditNamaDokumen").focus();
        return;
      }

      var indikator = $("#EditIndikator").val().trim();
      var fd = new FormData();
      fd.append('Id', id);
      fd.append('NamaDokumen', namaDokumen);
      fd.append('Indikator', indikator);

      // Berkas & Link Eksisting yang Dipertahankan
      fd.append('ExistingFiles', JSON.stringify(currentEditFiles));
      fd.append('ExistingLinks', JSON.stringify(currentEditLinks));

      // Berkas & Link Baru
      var newCount = 0;
      $('#EditUploadRowsContainer .upload-file-entry-row').each(function() {
        var sourceType = $(this).find('.file-entry-type-select').val();
        var customName = $(this).find('.file-entry-custom-name').val().trim();

        if (sourceType === 'drive') {
          var driveUrl = $(this).find('.file-entry-drive-url').val().trim();
          if (driveUrl !== '') {
            fd.append('DriveLinks[]', driveUrl);
            fd.append('DriveNames[]', customName);
            newCount++;
          }
        } else {
          var fileInput = $(this).find('.file-entry-input')[0];
          if (fileInput && fileInput.files && fileInput.files.length > 0) {
            fd.append('Files[]', fileInput.files[0]);
            fd.append('CustomNames[]', customName);
            newCount++;
          }
        }
      });

      var totalCount = currentEditFiles.length + currentEditLinks.length + newCount;
      if (totalCount === 0) {
        alert("Silakan lampirkan minimal 1 berkas dokumen atau tautan Google Drive!");
        return;
      }

      $.ajax({
        url: BaseURL + 'Staf/EditBankData',
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        beforeSend: function(){
          $("#LoadingEditBank").show();
          $("#SubmitEditBankData").prop('disabled', true);
        },
        success: function(Respon){
          var res = $.trim(Respon);
          if (res == '1') {
            window.location = BaseURL + "Staf/BankData";
          } else {
            alert(res);
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

    // =========================================================================
    // HAPUS BANK DATA
    // =========================================================================
    $(document).on("click", ".HapusBankData", function(){
      var id = $(this).data('id');
      var nama = $(this).data('nama') || 'dokumen ini';

      if (!confirm("Apakah Anda yakin ingin menghapus data '" + nama + "' beserta seluruh berkas/tautannya?")) {
        return;
      }

      $.post(BaseURL + "Staf/HapusBankData", { Id: id }).done(function(Respon) {
        var res = $.trim(Respon);
        if (res == '1') {
          window.location = BaseURL + "Staf/BankData";
        } else {
          alert(res);
        }
      }).fail(function() {
        alert("Terjadi kesalahan sistem saat menghapus data!");
      });
    });
  });
</script>
</body>
</html>
