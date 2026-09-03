<?php
function getSuperProjectFileList($fileField) {
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

// Helper untuk format tanggal Indonesia
function formatIndoDateSuper($dateStr) {
  if (empty($dateStr)) return '';
  $months = array(
    '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
    '05' => 'Mei', '06' => 'Jun', '07' => 'Jul', '08' => 'Agu',
    '09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des'
  );
  $parts = explode('-', trim($dateStr));
  if (count($parts) === 3) {
    $y = $parts[0];
    $m = $months[$parts[1]] ?? $parts[1];
    $d = $parts[2];
    return $d . ' ' . $m . ' ' . $y;
  }
  return $dateStr;
}

// Helper render sel Timeline Project
function renderSuperTimelineCell($deadline) {
  if (empty($deadline) || $deadline === '-') {
    return '<span class="text-muted" style="font-size: 12px;">-</span>';
  }

  // Jika mengandung pemisah pipe (|)
  if (strpos($deadline, '|') !== false) {
    $parts = explode('|', $deadline);
    $start = trim($parts[0] ?? '');
    $end = trim($parts[1] ?? '');

    $startFmt = formatIndoDateSuper($start);
    $endFmt = formatIndoDateSuper($end);

    return '
      <div class="timeline-pill-wrapper">
        <div class="timeline-node" title="Mulai: ' . htmlspecialchars($startFmt) . '">
          <span class="timeline-marker start"></span>
          <span class="timeline-text">' . htmlspecialchars($startFmt) . '</span>
        </div>
        <div class="timeline-line">
          <i class="fa fa-arrow-right text-muted" style="font-size: 9.5px;"></i>
        </div>
        <div class="timeline-node" title="Selesai: ' . htmlspecialchars($endFmt) . '">
          <span class="timeline-marker end"></span>
          <span class="timeline-text">' . htmlspecialchars($endFmt) . '</span>
        </div>
      </div>';
  }

  // Jika rentang tahun dengan dash (2025 - 2026)
  if (strpos($deadline, ' - ') !== false) {
    $parts = explode(' - ', $deadline);
    return '
      <div class="timeline-pill-wrapper">
        <div class="timeline-node">
          <span class="timeline-marker start"></span>
          <span class="timeline-text">' . htmlspecialchars(trim($parts[0])) . '</span>
        </div>
        <div class="timeline-line">
          <i class="fa fa-arrow-right text-muted" style="font-size: 9.5px;"></i>
        </div>
        <div class="timeline-node">
          <span class="timeline-marker end"></span>
          <span class="timeline-text">' . htmlspecialchars(trim($parts[1])) . '</span>
        </div>
      </div>';
  }

  // Single date / single year
  $fmt = formatIndoDateSuper($deadline);
  return '
    <div class="timeline-pill-wrapper single" title="Pelaksanaan: ' . htmlspecialchars($fmt) . '">
      <div class="timeline-node">
        <span class="timeline-marker single"></span>
        <span class="timeline-text">' . htmlspecialchars($fmt) . '</span>
      </div>
    </div>';
}

// Helper render multiple Tags badges
function renderSuperTagBadges($tagsStr) {
  if (empty($tagsStr)) return '<span class="text-muted" style="font-size: 12px;">-</span>';
  $tags = array_map('trim', explode(',', $tagsStr));
  $tags = array_filter($tags);
  if (empty($tags)) return '<span class="text-muted" style="font-size: 12px;">-</span>';
  
  $html = '<div class="d-flex flex-wrap align-items-center justify-content-center" style="gap: 4px;">';
  foreach ($tags as $t) {
    $cleanTag = ltrim($t, '#');
    $html .= '<span class="badge px-2 py-1" style="background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11px; font-weight: 600;">' .
      '<i class="fa fa-hashtag text-primary mr-1" style="font-size: 10px;"></i>' . htmlspecialchars($cleanTag) . 
    '</span>';
  }
  $html .= '</div>';
  return $html;
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

<!-- Extra Styling for In-Browser Document Viewer & Timeline -->
<style>
  /* Timeline Badge in Project Table */
  .timeline-pill-wrapper {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 5px 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
  }
  .timeline-pill-wrapper.single {
    padding: 5px 14px;
  }
  .timeline-node {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .timeline-marker {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
  }
  .timeline-marker.start {
    background-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
  }
  .timeline-marker.end {
    background-color: #b40814;
    box-shadow: 0 0 0 3px rgba(180, 8, 20, 0.2);
  }
  .timeline-marker.single {
    background-color: #043168;
    box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.2);
  }
  .timeline-text {
    font-size: 12px;
    font-weight: 600;
    color: #1e293b;
    white-space: nowrap;
  }
  .timeline-line {
    display: inline-flex;
    align-items: center;
    padding: 0 2px;
  }

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

  /* Hapus/Sembunyikan Ikon Panah Sorting (↑↓) pada Header Tabel */
  table.dataTable thead .sorting:before,
  table.dataTable thead .sorting:after,
  table.dataTable thead .sorting_asc:before,
  table.dataTable thead .sorting_asc:after,
  table.dataTable thead .sorting_desc:before,
  table.dataTable thead .sorting_desc:after,
  table.dataTable thead > tr > th.sorting:before,
  table.dataTable thead > tr > th.sorting:after,
  table.dataTable thead > tr > th.sorting_asc:before,
  table.dataTable thead > tr > th.sorting_asc:after,
  table.dataTable thead > tr > th.sorting_desc:before,
  table.dataTable thead > tr > th.sorting_desc:after,
  table.dataTable thead > tr > td.sorting:before,
  table.dataTable thead > tr > td.sorting:after,
  table.dataTable thead > tr > td.sorting_asc:before,
  table.dataTable thead > tr > td.sorting_asc:after,
  table.dataTable thead > tr > td.sorting_desc:before,
  table.dataTable thead > tr > td.sorting_desc:after {
    display: none !important;
    content: "" !important;
    opacity: 0 !important;
  }
</style>

<br>
<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive">
			<table id="TabelProject" class="table table-sm table-bordered bg-light">
				<thead>
					<tr style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
						<th scope="col" style="width: 4%;" class="text-center align-middle">No</th>
						<th scope="col" class="align-middle">PJ Project</th>
						<th scope="col" class="align-middle">Nama Project</th>
						<th scope="col" style="width: 12%;" class="text-center align-middle">Kategori</th>
						<th scope="col" style="width: 14%;" class="text-center align-middle">Tag / Label</th>
						<th scope="col" style="width: 16%;" class="text-center align-middle">Timeline Project</th>
						<th scope="col" style="width: 20%;" class="align-middle">Catatan</th>
						<th scope="col" style="width: 14%;" class="text-center align-middle">Dokumen</th>
					</tr>
				</thead>
				<tbody id="RekapSurvei">
					<?php 
					$No = 1; 
					foreach ($Project as $key) { 
						$rawDl = !empty($key['Deadline']) ? $key['Deadline'] : '-';
						$PisahPJ = explode("|", $key['PJ']); 
						$Pj = ""; 
						for ($i=0; $i < count($PisahPJ); $i++) { 
							$Pj .= (ucfirst($PisahPJ[$i]).' '); 
						}
						$fileList = getSuperProjectFileList($key['File'] ?? ''); 
						$fileJsonAttr = htmlspecialchars(json_encode($fileList), ENT_QUOTES, 'UTF-8');
						$totalDocs = count($fileList);
					?>
						<tr>
							<th scope="row" class="text-center align-middle"><?=$No++?></th>
							<th scope="row" class="align-middle"><?=$key['PJ']?></th>
							<th scope="row" class="align-middle"><?=$key['NamaProject']?></th>
							<th scope="row" class="text-center align-middle"><?=!empty($key['Kategori']) ? htmlspecialchars($key['Kategori']) : '-'?></th>
							<!-- Tag / Label Column in SuperAdmin -->
							<th scope="row" class="text-center align-middle">
								<?=renderSuperTagBadges($key['Tag'] ?? '')?>
							</th>
							<!-- Timeline Garis Waktu Project SuperAdmin -->
							<th scope="row" class="text-center align-middle">
								<?=renderSuperTimelineCell($rawDl)?>
							</th>
							<th scope="row" class="align-middle"><?=$key['Catatan']?></th>
							<th scope="row" class="text-center align-middle text-nowrap">
								<?php if ($totalDocs > 0) { ?>
									<button type="button" 
										class="btn btn-sm btn-info text-white btn-open-project-docs" 
										data-project="<?=htmlspecialchars($key['NamaProject'], ENT_QUOTES)?>"
										data-files="<?=$fileJsonAttr?>"
										title="Buka <?=$totalDocs?> Dokumen Project" 
										style="border-radius: 6px; padding: 4px 10px; font-weight: 600; font-size: 11.5px; background: #0284c7; border: none;">
										<i class="fa fa-folder-open mr-1"></i> <?=$totalDocs?> Dokumen
									</button>
								<?php } else { ?>
									<span class="text-muted">-</span>
								<?php } ?>
							</th>
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
<!-- /page content -->
</div>
</div>

<!-- Universal In-Browser Multi-Document Slide Viewer Modal (PDF, Word, Excel, ZIP, RAR) -->
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

        <!-- Fallback Download Card Container (ZIP, RAR & Other Files) -->
        <div id="FallbackViewerContainer" class="text-center py-5" style="display: none;">
          <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" id="FallbackIconWrapper" style="width: 76px; height: 76px; background: rgba(4, 49, 104, 0.1); color: #043168; margin: 0 auto;">
            <i class="fa-solid fa-file-zipper" id="FallbackIcon" style="font-size: 34px;"></i>
          </div>
          <h5 class="font-weight-bold text-dark mb-2" id="FallbackFileName">Dokumen Project</h5>
          <p class="text-muted" style="font-size: 13.5px;" id="FallbackFileDesc">Berkas arsip (ZIP / RAR) dapat diunduh dan diekstrak langsung pada komputer Anda.</p>
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
					'previous': '<i class="fa-solid fa-chevron-left"></i>',
					'next': '<i class="fa-solid fa-chevron-right"></i>'
				}
			}
		});

    // Pasang Dropdown Filter Tahun tepat di sebelah 'Cari Project:'
    var filterTahunHtml = 
      '<div class="d-inline-flex align-items-center mr-2" id="WrapperFilterTahun" style="gap: 6px;">' +
        '<label class="mb-0 text-dark font-weight-bold" style="font-size: 13px; white-space: nowrap;"><i class="fa fa-calendar mr-1 text-danger"></i> Filter Tahun:</label>' +
        '<select class="form-control form-control-sm" id="SelectFilterTahun" style="border-radius: 8px; border: 1px solid #cbd5e1; height: 35px; min-width: 135px; font-weight: 600; font-size: 13px; color: #043168; background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">' +
          '<option value="">Semua Tahun</option>' +
          <?php foreach ($listTahun as $th) { ?>
            '<option value="<?=htmlspecialchars($th, ENT_QUOTES)?>"><?=htmlspecialchars($th, ENT_QUOTES)?></option>' +
          <?php } ?>
        '</select>' +
      '</div>';

    $('#TabelProject_wrapper .dataTables_filter').prepend(filterTahunHtml);

    $('#SelectFilterTahun').on('change', function() {
      var selectedYear = $(this).val();
      table.column(5).search(selectedYear ? selectedYear : '', true, false).draw();
    });

    // =========================================================================
    // IN-BROWSER MULTI-DOCUMENT SLIDE VIEWER (PDF, WORD, EXCEL, ZIP, RAR)
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

      $('.doc-slide-tab').removeClass('active');
      $('.doc-slide-tab[data-index="' + index + '"]').addClass('active');

      $('#ModalViewerDocCounter').text('Dokumen ' + (index + 1) + ' dari ' + activeProjectFiles.length + ' (' + fileName + ')');
      $('#ModalViewerFooterInfo').html('<i class="fa fa-file-text-o mr-1"></i> ' + fileName + ' &bull; Dokumen ' + (index + 1) + ' / ' + activeProjectFiles.length);
      $('#BtnDownloadDoc').attr('href', fileUrl);
      $('#BtnFallbackDownload').attr('href', fileUrl);
      $('#FallbackFileName').text(fileName);

      $('#ViewerLoadingSpinner').show();
      $('#PdfViewerContainer').hide();
      $('#WordViewerContainer').hide();
      $('#ExcelViewerContainer').hide();
      $('#FallbackViewerContainer').hide();

      if (ext === 'pdf') {
        $('#PathProject').attr('src', fileUrl);
        $('#ViewerLoadingSpinner').hide();
        $('#PdfViewerContainer').show();
      } 
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
                tabsHtml += '<button type="button" class="sheet-tab-btn ' + (i === 0 ? 'active' : '') + '" data-sheet="' + name + '"><i class="fa fa-table mr-1"></i> ' + name + '</button>';
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
      else if (ext === 'zip' || ext === 'rar' || ext === '7z') {
        $('#ViewerLoadingSpinner').hide();
        $('#FallbackIcon').attr('class', 'fa-solid fa-file-zipper');
        $('#FallbackIconWrapper').css({ 'background': 'rgba(234, 88, 12, 0.1)', 'color': '#ea580c' });
        $('#FallbackFileDesc').text('Berkas arsip terkompresi (' + ext.toUpperCase() + ') dapat diunduh langsung untuk diekstrak pada komputer Anda.');
        $('#BtnFallbackDownload').html('<i class="fa-solid fa-download mr-1"></i> Unduh Berkas ' + ext.toUpperCase());
        $('#FallbackViewerContainer').show();
      }
      else {
        $('#ViewerLoadingSpinner').hide();
        $('#FallbackIcon').attr('class', 'fa fa-download');
        $('#FallbackIconWrapper').css({ 'background': 'rgba(4, 49, 104, 0.1)', 'color': '#043168' });
        $('#FallbackFileDesc').text('Format berkas ini dapat dibuka langsung melalui aplikasi atau diunduh ke perangkat Anda.');
        $('#BtnFallbackDownload').html('<i class="fa-solid fa-download mr-1"></i> Buka / Unduh Berkas');
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

      var tabsHtml = '';
      $.each(activeProjectFiles, function(i, f) {
        var ext = f.split('.').pop().toLowerCase();
        var iconHtml = '<i class="fa fa-file-text-o mr-1"></i>';

        if (ext === 'pdf') {
          iconHtml = '<i class="fa-file-pdf-o mr-1 text-danger"></i>';
        } else if (ext === 'doc' || ext === 'docx') {
          iconHtml = '<i class="fa-file-word-o mr-1 text-primary"></i>';
        } else if (ext === 'xls' || ext === 'xlsx' || ext === 'csv') {
          iconHtml = '<i class="fa-file-excel-o mr-1 text-success"></i>';
        } else if (ext === 'zip' || ext === 'rar' || ext === '7z') {
          iconHtml = '<i class="fa-solid fa-file-zipper mr-1" style="color: #ea580c;"></i>';
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

    $(document).on('click', '.doc-slide-tab', function() {
      var idx = parseInt($(this).data('index'), 10);
      loadDocumentAtIndex(idx);
    });

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

    $(document).on('click', '.sheet-tab-btn', function() {
      var sheetName = $(this).data('sheet');
      renderExcelSheet(sheetName);
    });
	});
</script>
</body>
</html>