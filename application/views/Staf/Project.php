<?php
// Helper untuk mengurai daftar file yang tersimpan
function getProjectFileList($fileField) {
  if (empty($fileField)) return array();
  if (is_array($fileField)) return $fileField;
  $decoded = json_decode($fileField, true);
  if (is_array($decoded)) {
    return array_values(array_filter($decoded));
  }
  if (strpos($fileField, '|') !== false) {
    return array_values(array_filter(explode('|', $fileField)));
  }
  return array($fileField);
}

// Ekstrak daftar tahun unik dari seluruh data project yang telah diinput
$listTahun = array();
foreach ($Project as $p) {
  $dl = !empty($p['Deadline']) ? trim($p['Deadline']) : '';
  if (!empty($dl)) {
    if (strpos($dl, '|') !== false) {
      $parts = explode('|', $dl);
      $y1 = explode('-', $parts[0] ?? '')[0] ?? '';
      $y2 = explode('-', $parts[1] ?? '')[0] ?? '';
      if (!empty($y1) && is_numeric($y1)) $listTahun[] = $y1;
      if (!empty($y2) && is_numeric($y2)) $listTahun[] = $y2;
    } else {
      if (preg_match_all('/\b\d{4}\b/', $dl, $matches)) {
        foreach ($matches[0] as $m) {
          $listTahun[] = $m;
        }
      } else {
        $listTahun[] = $dl;
      }
    }
  }
}
$listTahun = array_values(array_unique(array_filter($listTahun)));
rsort($listTahun);
?>

<!-- Extra Styling for In-Browser Document Viewer (Word, Excel, PDF & Slide Tabs) -->
<style>
  .word-document-paper {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    padding: 35px 40px;
    max-width: 900px;
    margin: 0 auto;
    font-family: 'Poppins', Calibri, Arial, sans-serif;
    line-height: 1.7;
    color: #1e293b;
    min-height: 400px;
  }
  .word-document-paper table {
    width: 100% !important;
    border-collapse: collapse !important;
    margin: 15px 0 !important;
  }
  .word-document-paper table, 
  .word-document-paper th, 
  .word-document-paper td {
    border: 1px solid #cbd5e1 !important;
    padding: 8px 12px !important;
  }
  .word-document-paper th {
    background-color: #f1f5f9 !important;
    font-weight: 700;
  }
  .excel-table-wrapper {
    overflow-x: auto;
    max-height: 540px;
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    padding: 10px;
  }
  .excel-sheet-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
    color: #334155;
  }
  .excel-sheet-table th, 
  .excel-sheet-table td {
    border: 1px solid #cbd5e1 !important;
    padding: 6px 12px !important;
    white-space: nowrap;
  }
  .excel-sheet-table th {
    background-color: #f8fafc !important;
    font-weight: 700 !important;
    color: #043168 !important;
    text-align: center;
    position: sticky;
    top: 0;
    z-index: 2;
  }
  .excel-sheet-table tr:hover {
    background-color: #f0fdf4 !important;
  }
  .sheet-tabs-container {
    display: flex;
    gap: 6px;
    padding: 10px 0 0 0;
    overflow-x: auto;
    border-top: 1px solid #e2e8f0;
    margin-top: 10px;
  }
  .sheet-tab-btn {
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    background: #f8fafc;
    color: #475569;
    padding: 5px 14px;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .sheet-tab-btn.active, 
  .sheet-tab-btn:hover {
    background: #16a34a;
    color: #ffffff;
    border-color: #16a34a;
  }

  /* Document Slide Tab Navigation */
  .doc-slide-tab {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 12.5px;
    font-weight: 600;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    color: #475569;
    white-space: nowrap;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .doc-slide-tab:hover {
    background: #e2e8f0;
    color: #0f172a;
  }
  .doc-slide-tab.active {
    background: #043168;
    color: #ffffff;
    border-color: #043168;
    box-shadow: 0 2px 8px rgba(4, 49, 104, 0.25);
  }

  /* Style Year Filter Dropdown next to dataTables_filter */
  .dataTables_wrapper .dataTables_filter {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    flex-wrap: wrap !important;
    gap: 12px !important;
  }
  .dataTables_wrapper .dataTables_filter label {
    margin-bottom: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
  }
</style>

<!-- Enterprise Page Header Card -->
<div class="row mb-4" style="margin-top: 22px;">
  <div class="col-12">
    <div class="card border-0" style="background: #ffffff; border-radius: 20px; border: 1px solid var(--ide-border) !important; box-shadow: 0 8px 24px rgba(4, 49, 104, 0.05); padding: 20px 24px;">
      <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 15px;">
        <div class="d-flex align-items-center" style="gap: 16px;">
          <div style="width: 52px; height: 52px; border-radius: 14px; background: linear-gradient(135deg, rgba(4, 49, 104, 0.1) 0%, rgba(180, 8, 20, 0.1) 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <i class="fa-solid fa-diagram-project" style="color: var(--ide-red); font-size: 24px;"></i>
          </div>
          <div>
            <div class="d-flex align-items-center" style="gap: 10px;">
              <h4 class="font-weight-bold text-dark mb-0" style="font-size: 18px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                Manajemen Project
              </h4>
              <span class="badge badge-primary px-2 py-1" style="background: var(--ide-navy); font-size: 11px; font-weight: 600; border-radius: 6px;">Staf Portal</span>
            </div>
            <p class="text-muted mb-0 mt-1" style="font-size: 12.5px;">
              Kelola data berkas kegiatan, kategori, tahun pelaksanaan, serta dokumen project (PDF, Word, Excel).
            </p>
          </div>
        </div>
        <div>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalInput" style="border-radius: 22px; font-weight: 700; padding: 11px 24px; font-size: 13.5px; background: var(--ide-red); border: none; box-shadow: 0 6px 18px rgba(180, 8, 20, 0.35); transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-plus"></i> Tambah Project Baru
          </button>
        </div>
      </div>
    </div>
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
                <th style="width: 4%;" class="text-center align-middle">No</th>
                <th style="width: 25%;" class="align-middle">Nama Project</th>
                <th style="width: 14%;" class="text-center align-middle">Kategori</th>
                <th style="width: 12%;" class="text-center align-middle">Tahun Project</th>
                <th style="width: 25%;" class="align-middle">Catatan</th>
                <th style="width: 20%;" class="text-center align-middle">Dokumen & Aksi</th>
              </tr>
            </thead>
            <tbody id="RekapSurvei">
              <?php 
              $No = 1; 
              foreach ($Project as $key) { 
                $dl = !empty($key['Deadline']) ? $key['Deadline'] : '-';
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
                $fileList = getProjectFileList($key['File'] ?? '');
                $fileJsonAttr = htmlspecialchars(json_encode($fileList), ENT_QUOTES, 'UTF-8');
                $totalDocs = count($fileList);
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
                    <!-- Single Clean Document Button (Opens Multi-Doc Slide Modal) -->
                    <?php if ($totalDocs > 0) { ?>
                      <button type="button" 
                        class="btn btn-sm btn-info text-white mr-1 btn-open-project-docs" 
                        data-project="<?=htmlspecialchars($key['NamaProject'], ENT_QUOTES)?>"
                        data-files="<?=$fileJsonAttr?>"
                        title="Buka <?=$totalDocs?> Dokumen Project" 
                        style="border-radius: 8px; padding: 5px 12px; font-weight: 600; font-size: 12px; background: #0284c7; border: none; box-shadow: 0 2px 6px rgba(2, 132, 199, 0.25);">
                        <i class="fa-solid fa-folder-open mr-1"></i> <?=$totalDocs?> Dokumen
                      </button>
                    <?php } else { ?>
                      <span class="text-muted mr-2" style="font-size: 12px;" title="Tidak ada dokumen terlampir">
                        <i class="fa-regular fa-file text-muted mr-1"></i> -
                      </span>
                    <?php } ?>

                    <!-- Action Edit & Delete Buttons -->
                    <button type="button" 
                      class="btn btn-sm btn-warning text-white Edit" 
                      title="Edit Data" 
                      data-id="<?=$key['Id']?>"
                      data-nama="<?=htmlspecialchars($key['NamaProject'], ENT_QUOTES)?>"
                      data-kategori="<?=htmlspecialchars($key['Kategori'] ?? '', ENT_QUOTES)?>"
                      data-deadline="<?=htmlspecialchars($key['Deadline'] ?? '', ENT_QUOTES)?>"
                      data-catatan="<?=htmlspecialchars($key['Catatan'] ?? '', ENT_QUOTES)?>"
                      data-files="<?=$fileJsonAttr?>"
                      data-file="<?=$key['File'] ?? ''?>"
                      style="border-radius: 8px; padding: 5px 8px;">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button type="button" 
                      Hapus="<?=$key['Id']."$".htmlspecialchars($key['File'] ?? '')?>" 
                      data-id="<?=$key['Id']?>"
                      data-file="<?=htmlspecialchars($key['File'] ?? '')?>"
                      class="btn btn-sm btn-danger Hapus" 
                      title="Hapus Data" 
                      style="border-radius: 8px; padding: 5px 8px;">
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

        <!-- Dynamic File Upload Container with [+] and Delete Button -->
        <div class="form-group mb-2">
          <label>Unggah Berkas Dokumen (PDF, Word, Excel)</label>
          <div id="InputFilesContainer">
            <div class="input-file-row d-flex align-items-center mb-2" style="gap: 8px;">
              <input class="form-control file-input-item" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv">
              <button type="button" class="btn btn-success btn-add-file-row" style="border-radius: 12px; padding: 9px 15px; flex-shrink: 0;" title="Tambah Baris Berkas Baru">
                <i class="fa-solid fa-plus"></i>
              </button>
            </div>
          </div>
          <small class="form-text text-muted mt-1">
            <i class="fa-solid fa-circle-info mr-1"></i> Mendukung format <strong>PDF, Word (.doc, .docx), Excel (.xls, .xlsx, .csv)</strong>. Klik tombol <strong class="text-success"><i class="fa-solid fa-plus"></i></strong> di samping untuk menambah berkas lainnya.
          </small>
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

        <!-- Existing Files List in Edit Modal -->
        <div class="form-group mb-3" id="GroupExistingFiles">
          <label>Berkas Terlampir Saat Ini</label>
          <div id="EditExistingFilesContainer" class="d-flex flex-wrap" style="gap: 8px;"></div>
        </div>

        <!-- Dynamic New File Upload Container in Edit Modal -->
        <div class="form-group mb-2">
          <label>Tambah Berkas Baru (PDF, Word, Excel)</label>
          <div id="EditFilesContainer">
            <div class="input-file-row d-flex align-items-center mb-2" style="gap: 8px;">
              <input class="form-control file-input-item" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv">
              <button type="button" class="btn btn-success btn-add-edit-file-row" style="border-radius: 12px; padding: 9px 15px; flex-shrink: 0;" title="Tambah Baris Berkas Baru">
                <i class="fa-solid fa-plus"></i>
              </button>
            </div>
          </div>
          <small class="form-text text-muted mt-1">
            <i class="fa-solid fa-circle-info mr-1"></i> Mendukung <strong>PDF, Word (.doc, .docx), Excel (.xls, .xlsx, .csv)</strong>. Klik tombol <strong class="text-success"><i class="fa-solid fa-plus"></i></strong> di samping untuk menambah baris berkas lainnya.
          </small>
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

<!-- Universal In-Browser Multi-Document Slide Viewer Modal (PDF, Word, Excel) -->
<div class="modal fade" id="ModalProject" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
      
      <!-- Modal Header -->
      <div class="modal-header d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff; padding: 14px 22px;">
        <div class="d-flex align-items-center" style="gap: 12px;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-folder-open text-white" style="font-size: 18px;"></i>
          </div>
          <div>
            <h5 class="modal-title font-weight-bold mb-0 text-white" style="font-size: 16px;" id="ModalViewerProjectName">
              Pratinjau Dokumen Project
            </h5>
            <small class="text-white-50" id="ModalViewerDocCounter" style="font-size: 11.5px;">Memuat berkas...</small>
          </div>
        </div>
        <div class="d-flex align-items-center" style="gap: 12px;">
          <a href="#" id="BtnDownloadDoc" target="_blank" download class="btn btn-sm btn-light font-weight-bold px-3 py-1" style="border-radius: 14px; font-size: 12px; color: #043168;">
            <i class="fa-solid fa-download mr-1 text-primary"></i> Unduh File Aktif
          </a>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="margin: 0; padding: 0; opacity: 0.9;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>

      <!-- Document Slide Navigation Bar (Slide Tabs & Arrows) -->
      <div class="px-3 py-2 border-bottom d-flex align-items-center justify-content-between" id="DocSlideNavBar" style="background: #f1f5f9; gap: 10px;">
        <button type="button" class="btn btn-sm btn-outline-secondary" id="BtnPrevDocSlide" style="border-radius: 8px; padding: 5px 12px;" title="Dokumen Sebelumnya">
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        
        <div class="d-flex align-items-center flex-nowrap" id="DocSlideTabsList" style="gap: 8px; overflow-x: auto; scroll-behavior: smooth; max-width: calc(100% - 110px); padding: 4px 2px;">
          <!-- Dynamic Tabs Rendered by JS -->
        </div>

        <button type="button" class="btn btn-sm btn-outline-secondary" id="BtnNextDocSlide" style="border-radius: 8px; padding: 5px 12px;" title="Dokumen Selanjutnya">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>

      <!-- Modal Body for Active Document -->
      <div class="modal-body p-3" style="background-color: #f8fafc; min-height: 480px;">
        
        <!-- Loading Spinner -->
        <div id="ViewerLoadingSpinner" class="text-center py-5" style="display: none;">
          <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
          <p class="mt-3 font-weight-bold text-muted" style="font-size: 14px;">Memuat dokumen...</p>
        </div>

        <!-- PDF Viewer Container -->
        <div id="PdfViewerContainer" style="display: none;">
          <embed id="PathProject" src="" type="application/pdf" width="100%" height="600" style="border: none; border-radius: 8px;"/>
        </div>

        <!-- Word Document Viewer Container -->
        <div id="WordViewerContainer" style="display: none; max-height: 600px; overflow-y: auto;">
          <div class="word-document-paper" id="WordViewerContent"></div>
        </div>

        <!-- Excel Spreadsheet Viewer Container -->
        <div id="ExcelViewerContainer" style="display: none;">
          <div class="excel-table-wrapper" id="ExcelTableContainer"></div>
          <div class="sheet-tabs-container" id="ExcelSheetTabs"></div>
        </div>

        <!-- Fallback Download Card Container -->
        <div id="FallbackViewerContainer" class="text-center py-5" style="display: none;">
          <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 70px; height: 70px; background: rgba(4, 49, 104, 0.1); color: var(--ide-navy);">
            <i class="fa-solid fa-file-arrow-down" style="font-size: 30px;"></i>
          </div>
          <h5 class="font-weight-bold text-dark mb-2" id="FallbackFileName">Dokumen Project</h5>
          <p class="text-muted" style="font-size: 13px;">Format berkas ini dapat dibuka langsung melalui aplikasi atau diunduh ke perangkat Anda.</p>
          <a href="#" id="BtnFallbackDownload" target="_blank" download class="btn btn-primary px-4 py-2" style="border-radius: 20px; font-weight: 700;">
            <i class="fa-solid fa-download mr-1"></i> Buka / Unduh Berkas
          </a>
        </div>

      </div>
      
      <!-- Modal Footer -->
      <div class="modal-footer py-2 justify-content-between" style="background: #ffffff;">
        <span class="text-muted font-weight-bold" id="ModalViewerFooterInfo" style="font-size: 12.5px;"></span>
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

<!-- In-Browser Document Rendering Libraries (SheetJS for Excel & Mammoth for Word) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.6.0/mammoth.browser.min.js"></script>

<script>
  $(document).ready(function(){
    var BaseURL = '<?=base_url()?>';
    
    var table = $('#TabelProject').DataTable({
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

    // Pasang Dropdown Filter Tahun tepat di sebelah 'Cari Project:'
    var filterTahunHtml = 
      '<div class="d-inline-flex align-items-center mr-2" id="WrapperFilterTahun" style="gap: 6px;">' +
        '<label class="mb-0 text-dark font-weight-bold" style="font-size: 13px; white-space: nowrap;"><i class="fa-regular fa-calendar-days mr-1 text-danger"></i> Filter Tahun:</label>' +
        '<select class="form-control form-control-sm" id="SelectFilterTahun" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 35px; min-width: 135px; font-weight: 600; font-size: 13px; color: #043168; background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">' +
          '<option value="">Semua Tahun</option>' +
          <?php foreach ($listTahun as $th) { ?>
            '<option value="<?=htmlspecialchars($th, ENT_QUOTES)?>"><?=htmlspecialchars($th, ENT_QUOTES)?></option>' +
          <?php } ?>
        '</select>' +
      '</div>';

    // Sisipkan sebelum kolom input pencarian di container .dataTables_filter
    $('#TabelProject_wrapper .dataTables_filter').prepend(filterTahunHtml);

    // Event listener untuk memfilter tabel berdasarkan Tahun (Kolom index 3)
    $('#SelectFilterTahun').on('change', function() {
      var selectedYear = $(this).val();
      table.column(3).search(selectedYear ? selectedYear : '', true, false).draw();
    });

    // =========================================================================
    // IN-BROWSER MULTI-DOCUMENT SLIDE VIEWER (PDF, WORD, EXCEL)
    // =========================================================================
    var activeProjectFiles = [];
    var activeDocIndex = 0;
    var currentWorkbook = null;

    function renderExcelSheet(sheetName) {
      if (!currentWorkbook || !currentWorkbook.Sheets[sheetName]) return;
      var sheet = currentWorkbook.Sheets[sheetName];
      var htmlTable = XLSX.utils.sheet_to_html(sheet, { id: 'ExcelTableRender', editable: false });
      
      $('#ExcelTableContainer').html(htmlTable);
      $('#ExcelTableContainer table').addClass('excel-sheet-table');

      $('#ExcelSheetTabs .sheet-tab-btn').removeClass('active');
      $('#ExcelSheetTabs .sheet-tab-btn[data-sheet="' + sheetName + '"]').addClass('active');
    }

    function loadDocumentAtIndex(index) {
      if (!activeProjectFiles || activeProjectFiles.length === 0 || index < 0 || index >= activeProjectFiles.length) {
        return;
      }
      activeDocIndex = index;
      var fileName = activeProjectFiles[index];
      var fileUrl = BaseURL + 'Project/' + fileName;
      var ext = fileName.split('.').pop().toLowerCase();

      // Update Tabs styling
      $('.doc-slide-tab').removeClass('active');
      $('.doc-slide-tab[data-index="' + index + '"]').addClass('active');

      // Update counters & headers
      $('#ModalViewerDocCounter').text('Dokumen ' + (index + 1) + ' dari ' + activeProjectFiles.length + ' (' + fileName + ')');
      $('#ModalViewerFooterInfo').html('<i class="fa-solid fa-file mr-1"></i> ' + fileName + ' &bull; Dokumen ' + (index + 1) + ' / ' + activeProjectFiles.length);
      $('#BtnDownloadDoc').attr('href', fileUrl);
      $('#BtnFallbackDownload').attr('href', fileUrl);
      $('#FallbackFileName').text(fileName);

      // Reset viewer containers
      $('#ViewerLoadingSpinner').show();
      $('#PdfViewerContainer').hide();
      $('#WordViewerContainer').hide();
      $('#ExcelViewerContainer').hide();
      $('#FallbackViewerContainer').hide();

      // 1. PDF
      if (ext === 'pdf') {
        $('#PathProject').attr('src', fileUrl);
        $('#ViewerLoadingSpinner').hide();
        $('#PdfViewerContainer').show();
      } 
      // 2. Word (.docx)
      else if (ext === 'docx') {
        fetch(fileUrl)
          .then(function(res) {
            if (!res.ok) throw new Error('Gagal mengunduh berkas Word.');
            return res.arrayBuffer();
          })
          .then(function(arrayBuffer) {
            if (typeof mammoth !== 'undefined') {
              return mammoth.convertToHtml({ arrayBuffer: arrayBuffer });
            } else {
              throw new Error('Library Mammoth.js belum siap.');
            }
          })
          .then(function(result) {
            $('#ViewerLoadingSpinner').hide();
            $('#WordViewerContent').html(result.value || '<p class="text-muted">Dokumen kosong.</p>');
            $('#WordViewerContainer').show();
          })
          .catch(function(err) {
            $('#ViewerLoadingSpinner').hide();
            $('#FallbackViewerContainer').show();
          });
      }
      // 3. Excel (.xlsx, .xls, .csv)
      else if (ext === 'xlsx' || ext === 'xls' || ext === 'csv') {
        fetch(fileUrl)
          .then(function(res) {
            if (!res.ok) throw new Error('Gagal mengunduh berkas Excel.');
            return res.arrayBuffer();
          })
          .then(function(arrayBuffer) {
            if (typeof XLSX !== 'undefined') {
              currentWorkbook = XLSX.read(arrayBuffer, { type: 'array' });
              var sheetNames = currentWorkbook.SheetNames;
              
              var tabsHtml = '';
              $.each(sheetNames, function(i, name) {
                tabsHtml += '<button type="button" class="sheet-tab-btn ' + (i === 0 ? 'active' : '') + '" data-sheet="' + name + '"><i class="fa-solid fa-table mr-1"></i> ' + name + '</button>';
              });
              $('#ExcelSheetTabs').html(tabsHtml);

              if (sheetNames.length > 0) {
                renderExcelSheet(sheetNames[0]);
              }
              
              $('#ViewerLoadingSpinner').hide();
              $('#ExcelViewerContainer').show();
            } else {
              throw new Error('Library SheetJS belum siap.');
            }
          })
          .catch(function(err) {
            $('#ViewerLoadingSpinner').hide();
            $('#FallbackViewerContainer').show();
          });
      }
      // 4. Other formats fallback
      else {
        $('#ViewerLoadingSpinner').hide();
        $('#FallbackViewerContainer').show();
      }
    }

    // Open Multi-Doc Slide Modal
    $(document).on('click', '.btn-open-project-docs', function(){
      var projectName = $(this).data('project') || 'Project';
      var filesData = $(this).data('files');

      activeProjectFiles = [];
      if (Array.isArray(filesData)) {
        activeProjectFiles = filesData.slice();
      } else if (typeof filesData === 'string' && filesData !== '') {
        try {
          var parsed = JSON.parse(filesData);
          if (Array.isArray(parsed)) {
            activeProjectFiles = parsed;
          } else {
            activeProjectFiles = [filesData];
          }
        } catch(e) {
          activeProjectFiles = filesData.indexOf('|') !== -1 ? filesData.split('|') : [filesData];
        }
      }

      if (activeProjectFiles.length === 0) {
        alert('Tidak ada dokumen terlampir pada project ini.');
        return;
      }

      $('#ModalViewerProjectName').text('Pratinjau Dokumen — ' + projectName);

      // Build Slide Tabs
      var tabsHtml = '';
      $.each(activeProjectFiles, function(i, f) {
        var ext = f.split('.').pop().toLowerCase();
        var iconHtml = '<i class="fa-solid fa-file mr-1"></i>';

        if (ext === 'pdf') {
          iconHtml = '<i class="fa-solid fa-file-pdf mr-1 text-danger"></i>';
        } else if (ext === 'doc' || ext === 'docx') {
          iconHtml = '<i class="fa-solid fa-file-word mr-1 text-primary"></i>';
        } else if (ext === 'xls' || ext === 'xlsx' || ext === 'csv') {
          iconHtml = '<i class="fa-solid fa-file-excel mr-1 text-success"></i>';
        }

        var displayName = f.length > 32 ? f.substring(0, 29) + '...' : f;

        tabsHtml += 
          '<button type="button" class="doc-slide-tab ' + (i === 0 ? 'active' : '') + '" data-index="' + i + '" title="' + f + '">' +
            iconHtml + '<span>' + displayName + '</span>' +
          '</button>';
      });
      $('#DocSlideTabsList').html(tabsHtml);

      if (activeProjectFiles.length <= 1) {
        $('#BtnPrevDocSlide, #BtnNextDocSlide').hide();
      } else {
        $('#BtnPrevDocSlide, #BtnNextDocSlide').show();
      }

      $('#ModalProject').modal("show");
      loadDocumentAtIndex(0);
    });

    // Click Document Tab
    $(document).on('click', '.doc-slide-tab', function() {
      var idx = parseInt($(this).data('index'), 10);
      loadDocumentAtIndex(idx);
    });

    // Prev / Next Document Slide Buttons
    $('#BtnPrevDocSlide').click(function() {
      if (activeProjectFiles.length > 1) {
        var nextIdx = (activeDocIndex - 1 + activeProjectFiles.length) % activeProjectFiles.length;
        loadDocumentAtIndex(nextIdx);
      }
    });

    $('#BtnNextDocSlide').click(function() {
      if (activeProjectFiles.length > 1) {
        var nextIdx = (activeDocIndex + 1) % activeProjectFiles.length;
        loadDocumentAtIndex(nextIdx);
      }
    });

    // Switch Excel Sheets inside modal
    $(document).on('click', '.sheet-tab-btn', function() {
      var sheetName = $(this).data('sheet');
      renderExcelSheet(sheetName);
    });

    // ==========================================
    // DYNAMIC FILE UPLOAD ROWS (INPUT & EDIT)
    // ==========================================
    
    // Tambah Baris File di Modal Input
    $(document).on('click', '.btn-add-file-row', function(e) {
      e.preventDefault();
      var rowHtml = 
        '<div class="input-file-row d-flex align-items-center mb-2" style="gap: 8px;">' +
          '<input class="form-control file-input-item" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv">' +
          '<button type="button" class="btn btn-danger btn-remove-file-row" style="border-radius: 12px; padding: 9px 15px; flex-shrink: 0;" title="Hapus Baris Ini">' +
            '<i class="fa-solid fa-trash-can"></i>' +
          '</button>' +
        '</div>';
      $('#InputFilesContainer').append(rowHtml);
    });

    // Hapus Baris File di Modal Input
    $(document).on('click', '.btn-remove-file-row', function(e) {
      e.preventDefault();
      $(this).closest('.input-file-row').remove();
    });

    // Tambah Baris File di Modal Edit
    $(document).on('click', '.btn-add-edit-file-row', function(e) {
      e.preventDefault();
      var rowHtml = 
        '<div class="input-file-row d-flex align-items-center mb-2" style="gap: 8px;">' +
          '<input class="form-control file-input-item" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv">' +
          '<button type="button" class="btn btn-danger btn-remove-edit-file-row" style="border-radius: 12px; padding: 9px 15px; flex-shrink: 0;" title="Hapus Baris Ini">' +
            '<i class="fa-solid fa-trash-can"></i>' +
          '</button>' +
        '</div>';
      $('#EditFilesContainer').append(rowHtml);
    });

    // Hapus Baris File di Modal Edit
    $(document).on('click', '.btn-remove-edit-file-row', function(e) {
      e.preventDefault();
      $(this).closest('.input-file-row').remove();
    });

    // Reset baris input saat modal input dibuka
    $('#ModalInput').on('show.bs.modal', function() {
      $('#InputFilesContainer').html(
        '<div class="input-file-row d-flex align-items-center mb-2" style="gap: 8px;">' +
          '<input class="form-control file-input-item" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv">' +
          '<button type="button" class="btn btn-success btn-add-file-row" style="border-radius: 12px; padding: 9px 15px; flex-shrink: 0;" title="Tambah Baris Berkas Baru">' +
            '<i class="fa-solid fa-plus"></i>' +
          '</button>' +
        '</div>'
      );
    });
     
    // Input Data Submit
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

      $('#InputFilesContainer .file-input-item').each(function() {
        if (this.files && this.files[0]) {
          fd.append("Files[]", this.files[0]);
        }
      });

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

    // State for existing files in Edit modal
    var editExistingFiles = [];
    var editDeletedFiles = [];

    function renderEditExistingFiles() {
      var $container = $('#EditExistingFilesContainer');
      $container.empty();
      if (editExistingFiles.length === 0) {
        $container.html('<span class="text-muted" style="font-size: 12.5px;">Tidak ada berkas terlampir sebelumnya.</span>');
        return;
      }

      $.each(editExistingFiles, function(index, f) {
        var ext = f.split('.').pop().toLowerCase();
        var iconHtml = '<i class="fa-solid fa-file mr-1"></i>';

        if (ext === 'pdf') {
          iconHtml = '<i class="fa-solid fa-file-pdf mr-1 text-danger"></i>';
        } else if (ext === 'doc' || ext === 'docx') {
          iconHtml = '<i class="fa-solid fa-file-word mr-1 text-primary"></i>';
        } else if (ext === 'xls' || ext === 'xlsx' || ext === 'csv') {
          iconHtml = '<i class="fa-solid fa-file-excel mr-1 text-success"></i>';
        }

        var $badge = $(
          '<div class="badge badge-light border d-inline-flex align-items-center px-2 py-1" style="font-size: 12px; gap: 8px; border-radius: 8px; background: #f8fafc;">' +
            iconHtml + '<span style="color: #334155; font-weight: 600;">' + f + '</span>' +
            '<button type="button" class="btn btn-sm btn-outline-danger p-0 d-inline-flex align-items-center justify-content-center btn-remove-existing-file" data-index="' + index + '" style="width: 18px; height: 18px; border-radius: 50%; font-size: 11px; line-height: 1;" title="Hapus Berkas Ini">' +
              '<i class="fa-solid fa-xmark"></i>' +
            '</button>' +
          '</div>'
        );
        $container.append($badge);
      });
    }

    $(document).on('click', '.btn-remove-existing-file', function(e) {
      e.preventDefault();
      var idx = $(this).data('index');
      var removed = editExistingFiles.splice(idx, 1);
      if (removed && removed[0]) {
        editDeletedFiles.push(removed[0]);
      }
      renderEditExistingFiles();
    });

    // Edit Click
    $(document).on("click", ".Edit", function(){
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var kategori = $(this).data('kategori');
      var deadline = $(this).data('deadline');
      var catatan = $(this).data('catatan');
      var filesAttr = $(this).data('files');

      editExistingFiles = [];
      editDeletedFiles = [];

      if (Array.isArray(filesAttr)) {
        editExistingFiles = filesAttr.slice();
      } else if (typeof filesAttr === 'string' && filesAttr !== '') {
        try {
          var parsed = JSON.parse(filesAttr);
          if (Array.isArray(parsed)) {
            editExistingFiles = parsed;
          } else {
            editExistingFiles = [filesAttr];
          }
        } catch(e) {
          if (filesAttr.indexOf('|') !== -1) {
            editExistingFiles = filesAttr.split('|');
          } else {
            editExistingFiles = [filesAttr];
          }
        }
      }

      // Format deadline tahun
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

      // Reset file input row di edit modal
      $('#EditFilesContainer').html(
        '<div class="input-file-row d-flex align-items-center mb-2" style="gap: 8px;">' +
          '<input class="form-control file-input-item" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv">' +
          '<button type="button" class="btn btn-success btn-add-edit-file-row" style="border-radius: 12px; padding: 9px 15px; flex-shrink: 0;" title="Tambah Baris Berkas Baru">' +
            '<i class="fa-solid fa-plus"></i>' +
          '</button>' +
        '</div>'
      );

      renderEditExistingFiles();
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
      fd.append('NamaProject', $("#EditNamaProject").val());
      fd.append('Kategori', $("#EditKategori").val());
      fd.append('Deadline', $("#EditDeadline").val());
      fd.append('Catatan', $("#EditCatatan").val());
      fd.append('FileLama', JSON.stringify(editExistingFiles));
      fd.append('FileHapus', JSON.stringify(editDeletedFiles));

      $('#EditFilesContainer .file-input-item').each(function() {
        if (this.files && this.files[0]) {
          fd.append("Files[]", this.files[0]);
        }
      });

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
      var id = $(this).data('id');
      var file = $(this).data('file');

      if (!id && $(this).attr('Hapus')) {
        var Data = $(this).attr('Hapus').split("$");
        id = Data[0];
        file = Data[1];
      }

      var Hapus = { 
        Id: id,
        File: file 
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