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
          <i class="fa fa-arrow-right text-muted" style="font-size: 9px;"></i>
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
          <i class="fa fa-arrow-right text-muted" style="font-size: 9px;"></i>
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

// Helper render Status Pill Button Dropdown (Single clean card)
function renderSuperStatusBadge($id, $status) {
  $status = trim($status ?? '');
  if (empty($status) || !in_array($status, ['Belum Mulai', 'Sedang Proses', 'Selesai'])) {
    if (in_array(strtolower($status), ['sedang berjalan', 'berjalan', 'proses'])) {
      $status = 'Sedang Proses';
    } else if (strtolower($status) === 'selesai') {
      $status = 'Selesai';
    } else {
      $status = 'Belum Mulai';
    }
  }

  $cls = 'status-belum-mulai';
  $icon = '<i class="fa fa-hourglass-start" style="font-size: 11px;"></i>';
  if ($status === 'Selesai') {
    $cls = 'status-selesai';
    $icon = '<i class="fa fa-check-circle" style="font-size: 11.5px;"></i>';
  } else if ($status === 'Sedang Proses') {
    $cls = 'status-sedang-proses';
    $icon = '<i class="fa fa-refresh fa-spin" style="font-size: 11px;"></i>';
  }

  return '
    <div class="dropdown d-inline-block position-relative">
      <button type="button" class="status-pill-btn ' . $cls . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk mengubah status project">
        ' . $icon . '
        <span>' . htmlspecialchars($status) . '</span>
        <i class="fa fa-chevron-down status-chevron"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-right shadow-lg border-0" style="border-radius: 12px; font-size: 12px; min-width: 165px; padding: 6px; margin-top: 4px;">
        <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 9.5px; padding: 4px 10px; text-transform: uppercase; letter-spacing: 0.5px;">Ubah Status Project</h6>
        <a class="dropdown-item d-flex align-items-center btn-change-status ' . ($status == 'Belum Mulai' ? 'active font-weight-bold' : '') . '" href="javascript:void(0)" data-id="' . $id . '" data-status="Belum Mulai" style="gap: 8px; border-radius: 6px; padding: 7px 10px;">
          <i class="fa fa-hourglass-start text-secondary" style="width: 14px;"></i> Belum Mulai
        </a>
        <a class="dropdown-item d-flex align-items-center btn-change-status ' . ($status == 'Sedang Proses' ? 'active font-weight-bold' : '') . '" href="javascript:void(0)" data-id="' . $id . '" data-status="Sedang Proses" style="gap: 8px; border-radius: 6px; padding: 7px 10px;">
          <i class="fa fa-refresh text-primary" style="width: 14px;"></i> Sedang Proses
        </a>
        <a class="dropdown-item d-flex align-items-center btn-change-status ' . ($status == 'Selesai' ? 'active font-weight-bold' : '') . '" href="javascript:void(0)" data-id="' . $id . '" data-status="Selesai" style="gap: 8px; border-radius: 6px; padding: 7px 10px;">
          <i class="fa fa-check-circle text-success" style="width: 14px;"></i> Selesai
        </a>
      </div>
    </div>';
}

// Helper untuk mendapatkan tahun selesai project
function getSuperProjectEndYear($deadline) {
  if (empty($deadline) || $deadline === '-') return '';
  if (strpos($deadline, '|') !== false) {
    $parts = explode('|', $deadline);
    $end = trim($parts[1] ?? ($parts[0] ?? ''));
    if (!empty($end)) {
      $dateParts = explode('-', $end);
      if (count($dateParts) >= 1 && is_numeric($dateParts[0])) {
        return $dateParts[0];
      }
    }
  }
  if (strpos($deadline, ' - ') !== false) {
    $parts = explode(' - ', $deadline);
    $end = trim($parts[1] ?? ($parts[0] ?? ''));
    if (preg_match('/\b\d{4}\b/', $end, $m)) {
      return $m[0];
    }
  }
  if (preg_match('/\b\d{4}\b/', $deadline, $m)) {
    return $m[0];
  }
  return '';
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
  /* Single Clean Status Pill Button */
  .status-pill-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    border: 1px solid transparent;
    text-decoration: none !important;
    outline: none !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    line-height: 1.3;
  }
  .status-pill-btn::after {
    display: none !important;
  }
  .status-pill-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
  }
  .status-pill-btn .status-chevron {
    font-size: 8.5px;
    opacity: 0.65;
    margin-left: 2px;
    transition: transform 0.2s ease;
  }
  .dropdown.show .status-pill-btn .status-chevron {
    transform: rotate(180deg);
  }
  .status-pill-btn.status-belum-mulai {
    background-color: #f1f5f9;
    color: #475569;
    border-color: #cbd5e1;
  }
  .status-pill-btn.status-belum-mulai:hover {
    background-color: #e2e8f0;
    color: #334155;
  }
  .status-pill-btn.status-sedang-proses {
    background-color: #e0f2fe;
    color: #0369a1;
    border-color: #bae6fd;
  }
  .status-pill-btn.status-sedang-proses:hover {
    background-color: #bae6fd;
    color: #0284c7;
  }
  .status-pill-btn.status-selesai {
    background-color: #dcfce7;
    color: #15803d;
    border-color: #bbf7d0;
  }
  .status-pill-btn.status-selesai:hover {
    background-color: #bbf7d0;
    color: #16a34a;
  }
  /* Timeline Badge in Project Table */
  .timeline-pill-wrapper {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 4px 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
  }
  .timeline-pill-wrapper.single {
    padding: 4px 12px;
  }
  .timeline-node {
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .timeline-marker {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
  }
  .timeline-marker.start {
    background-color: #10b981;
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
  }
  .timeline-marker.end {
    background-color: #b40814;
    box-shadow: 0 0 0 2px rgba(180, 8, 20, 0.2);
  }
  .timeline-marker.single {
    background-color: #043168;
    box-shadow: 0 0 0 2px rgba(4, 49, 104, 0.2);
  }
  .timeline-text {
    font-size: 11.5px;
    font-weight: 600;
    color: #1e293b;
    white-space: nowrap;
  }
  .timeline-line {
    display: inline-flex;
    align-items: center;
    padding: 0 1px;
  }

  .tag-label-badge {
    display: inline-flex;
    align-items: center;
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #cbd5e1;
    border-radius: 5px;
    padding: 2px 7px;
    font-size: 10.5px;
    font-weight: 600;
    line-height: 1.2;
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

  /* Perfect Horizontal Alignment: Tampilkan Data, Filter Tahun, dan Cari Project */
  #TabelProject_wrapper > .row:first-child {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    margin-bottom: 14px !important;
    flex-wrap: wrap !important;
    gap: 10px 0 !important;
  }
  #TabelProject_wrapper > .row:first-child > div:first-child {
    display: flex !important;
    align-items: center !important;
  }
  #TabelProject_wrapper > .row:first-child > div:last-child {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
  }
  #TabelProject_wrapper .dataTables_length {
    margin-bottom: 0 !important;
    display: flex !important;
    align-items: center !important;
  }
  #TabelProject_wrapper .dataTables_length label {
    margin-bottom: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #334155 !important;
  }
  #TabelProject_wrapper .dataTables_length select {
    height: 35px !important;
    border-radius: 8px !important;
    border: 1px solid #cbd5e1 !important;
    padding: 3px 8px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #043168 !important;
    background-color: #ffffff !important;
  }
  #TabelProject_wrapper .dataTables_filter {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    flex-wrap: nowrap !important;
    gap: 12px !important;
    margin-bottom: 0 !important;
  }
  #TabelProject_wrapper .dataTables_filter label {
    margin-bottom: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #334155 !important;
  }
  #TabelProject_wrapper .dataTables_filter input {
    height: 35px !important;
    border-radius: 8px !important;
    border: 1px solid #cbd5e1 !important;
    padding: 4px 12px !important;
    font-size: 13px !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
  }
  #WrapperUnifiedFilter {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    background: #f8fafc !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 10px !important;
    padding: 3px 6px !important;
    height: 38px !important;
    box-sizing: border-box !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03) !important;
  }
  #WrapperUnifiedFilter .filter-label {
    display: inline-flex !important;
    align-items: center !important;
    gap: 5px !important;
    color: #043168 !important;
    font-weight: 700 !important;
    font-size: 12.5px !important;
    white-space: nowrap !important;
    margin: 0 !important;
    padding: 0 4px !important;
  }
  #WrapperUnifiedFilter select {
    height: 30px !important;
    border-radius: 6px !important;
    border: 1px solid #cbd5e1 !important;
    font-weight: 600 !important;
    font-size: 12px !important;
    color: #043168 !important;
    background: #ffffff !important;
    padding: 2px 8px !important;
    margin: 0 !important;
    vertical-align: middle !important;
  }
  #BtnResetFilters {
    height: 30px !important;
    width: 30px !important;
    min-width: 30px !important;
    max-width: 30px !important;
    border-radius: 6px !important;
    padding: 0 !important;
    font-size: 12px !important;
    align-items: center !important;
    justify-content: center !important;
    flex-shrink: 0 !important;
    margin: 0 !important;
    border: 1px solid #fca5a5 !important;
    background: #fff5f5 !important;
    color: #dc2626 !important;
    line-height: 1 !important;
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
						<th scope="col" style="width: 32%;" class="align-middle">Nama project/Kegiatan</th>
						<th scope="col" style="width: 16%;" class="text-center align-middle">Jenis Pengadaan</th>
						<th scope="col" style="width: 18%;" class="text-center align-middle">Timeline</th>
						<th scope="col" style="width: 12%;" class="text-center align-middle">Status</th>
						<th scope="col" style="width: 9%;" class="text-center align-middle">Dokumen Admin</th>
						<th scope="col" style="width: 9%;" class="text-center align-middle">Dokumen Project</th>
					</tr>
				</thead>
				<tbody id="RekapSurvei">
					<?php 
					$No = 1; 
					foreach ($Project as $key) { 
						$rawDl = !empty($key['Deadline']) ? $key['Deadline'] : '-';
						
						// Dokumen Admin
						$fileAdminList = getSuperProjectFileList($key['DokumenAdmin'] ?? '');
						$fileAdminJsonAttr = htmlspecialchars(json_encode($fileAdminList), ENT_QUOTES, 'UTF-8');
						$totalAdminDocs = count($fileAdminList);

						// Dokumen Project (dengan fallback data lama 'File')
						$docProjectRaw = !empty($key['DokumenProject']) ? $key['DokumenProject'] : ($key['File'] ?? '');
						$fileProjectList = getSuperProjectFileList($docProjectRaw);
						$fileProjectJsonAttr = htmlspecialchars(json_encode($fileProjectList), ENT_QUOTES, 'UTF-8');
						$totalProjectDocs = count($fileProjectList);

						// Tag List
						$tagStr = trim($key['Tag'] ?? '');
						$tags = !empty($tagStr) ? array_filter(array_map('trim', explode(',', $tagStr))) : array();

						// Jenis Pengadaan fallback
						$jenisPengadaan = !empty($key['JenisPengadaan']) ? $key['JenisPengadaan'] : (!empty($key['Kategori']) ? $key['Kategori'] : '-');
						$rawStatus = !empty($key['Status']) ? trim($key['Status']) : 'Belum Mulai';
						if (in_array(strtolower($rawStatus), ['sedang berjalan', 'berjalan', 'proses', 'sedang dikerjakan', 'sedang proses'])) {
							$normStatus = 'Sedang Proses';
						} else if (strtolower($rawStatus) === 'selesai') {
							$normStatus = 'Selesai';
						} else {
							$normStatus = 'Belum Mulai';
						}
					?>
						<tr>
							<th scope="row" class="text-center align-middle font-weight-bold"><?=$No++?></th>
							
							<!-- Kolom 1: Nama project/Kegiatan dengan PIC, Tahun Selesai & Tag Label di Bawahnya -->
							<td class="align-middle">
								<div class="font-weight-bold text-dark" style="font-size: 12px; line-height: 1.35;">
									<?=htmlspecialchars($key['NamaProject'])?>
								</div>

								<div class="mt-1 d-flex flex-wrap align-items-center" style="gap: 5px;">
									<?php if (!empty($key['PJ'])) { ?>
										<span class="badge" style="background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; border-radius: 4px; font-size: 10px; font-weight: 600; padding: 2px 6px;">
											<i class="fa fa-user text-success mr-1"></i> PIC: <?=htmlspecialchars($key['PJ'])?>
										</span>
									<?php } ?>

									<?php 
									$endYear = getSuperProjectEndYear($rawDl);
									if (!empty($endYear)) { 
									?>
										<span class="badge" style="background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; border-radius: 4px; font-size: 10px; font-weight: 600; padding: 2px 6px;">
											<i class="fa fa-calendar-check-o mr-1 text-danger"></i> Tahun <?=$endYear?>
										</span>
									<?php } ?>

									<?php if (!empty($tags)) { ?>
										<?php foreach ($tags as $t) { 
											$cleanTag = ltrim($t, '#');
										?>
											<span class="tag-label-badge" style="font-size: 9.5px; padding: 2px 6px;">
												<i class="fa fa-hashtag text-primary mr-1" style="font-size: 8.5px;"></i><?=htmlspecialchars($cleanTag)?>
											</span>
										<?php } ?>
									<?php } ?>
								</div>
							</td>

							<!-- Kolom 2: Jenis Pengadaan -->
							<td class="text-center align-middle">
								<?php if ($jenisPengadaan !== '-') { ?>
									<span class="badge px-2 py-1" style="background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11px; font-weight: 600;">
										<i class="fa fa-tag text-secondary mr-1"></i> <?=htmlspecialchars($jenisPengadaan)?>
									</span>
								<?php } else { ?>
									<span class="text-muted" style="font-size: 12px;">-</span>
								<?php } ?>
							</td>

							<!-- Kolom 3: Timeline -->
							<td class="text-center align-middle">
								<?=renderSuperTimelineCell($rawDl)?>
							</td>

							<!-- Kolom 4: Status (Single Clean Pill Card with DataTables data-filter/search) -->
							<td class="text-center align-middle text-nowrap" data-filter="<?=$normStatus?>" data-search="<?=$normStatus?>">
								<?=renderSuperStatusBadge($key['Id'], $normStatus)?>
							</td>

							<!-- Kolom 5: Dokumen Admin -->
							<td class="text-center align-middle text-nowrap">
								<?php if ($totalAdminDocs > 0) { ?>
									<button type="button" 
										class="btn btn-sm btn-info text-white btn-open-project-docs" 
										data-type="Admin"
										data-project="<?=htmlspecialchars($key['NamaProject'], ENT_QUOTES)?>"
										data-files="<?=$fileAdminJsonAttr?>"
										title="Buka <?=$totalAdminDocs?> Dokumen Admin" 
										style="border-radius: 6px; padding: 4px 9px; font-weight: 600; font-size: 11px; background: #0284c7; border: none;">
										<i class="fa fa-folder-open mr-1"></i> <?=$totalAdminDocs?> Berkas
									</button>
								<?php } else { ?>
									<span class="text-muted" style="font-size: 12px;">-</span>
								<?php } ?>
							</td>

							<!-- Kolom 6: Dokumen Project -->
							<td class="text-center align-middle text-nowrap">
								<?php if ($totalProjectDocs > 0) { ?>
									<button type="button" 
										class="btn btn-sm btn-success text-white btn-open-project-docs" 
										data-type="Project"
										data-project="<?=htmlspecialchars($key['NamaProject'], ENT_QUOTES)?>"
										data-files="<?=$fileProjectJsonAttr?>"
										title="Buka <?=$totalProjectDocs?> Dokumen Project" 
										style="border-radius: 6px; padding: 4px 9px; font-weight: 600; font-size: 11px; background: #059669; border: none;">
										<i class="fa fa-folder-open mr-1"></i> <?=$totalProjectDocs?> Berkas
									</button>
								<?php } else { ?>
									<span class="text-muted" style="font-size: 12px;">-</span>
								<?php } ?>
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
            <i class="fa fa-folder-open text-white" style="font-size: 18px;"></i>
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
            <i class="fa fa-download mr-1 text-primary"></i> Unduh File Aktif
          </a>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="margin: 0; padding: 0; opacity: 0.9;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>

      <!-- Document Slide Navigation Bar (Slide Tabs & Arrows) -->
      <div class="px-3 py-2 border-bottom d-flex align-items-center justify-content-between" id="DocSlideNavBar" style="background: #f1f5f9; gap: 10px;">
        <button type="button" class="btn btn-sm btn-outline-secondary" id="BtnPrevDocSlide" style="border-radius: 8px; padding: 5px 12px;" title="Dokumen Sebelumnya">
          <i class="fa fa-chevron-left"></i>
        </button>
        
        <div class="d-flex align-items-center flex-nowrap" id="DocSlideTabsList" style="gap: 8px; overflow-x: auto; scroll-behavior: smooth; max-width: calc(100% - 110px); padding: 4px 2px;">
          <!-- Dynamic Tabs Rendered by JS -->
        </div>

        <button type="button" class="btn btn-sm btn-outline-secondary" id="BtnNextDocSlide" style="border-radius: 8px; padding: 5px 12px;" title="Dokumen Selanjutnya">
          <i class="fa fa-chevron-right"></i>
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
            <i class="fa fa-file-archive-o" id="FallbackIcon" style="font-size: 34px;"></i>
          </div>
          <h5 class="font-weight-bold text-dark mb-2" id="FallbackFileName">Dokumen Project</h5>
          <p class="text-muted" style="font-size: 13.5px;" id="FallbackFileDesc">Berkas arsip (ZIP / RAR) dapat diunduh dan diekstrak langsung pada komputer Anda.</p>
          <a href="#" id="BtnFallbackDownload" target="_blank" download class="btn btn-primary px-4 py-2" style="border-radius: 20px; font-weight: 700;">
            <i class="fa fa-download mr-1"></i> Buka / Unduh Berkas
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
			"order": [], // Mempertahankan urutan prioritas server (Tahun terbaru & Status aktif di atas)
			"pageLength": 10,
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
			"language": {
				"search": "Cari Project:",
				"lengthMenu": "Tampilkan _MENU_ data",
				"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
				"infoEmpty": "Data tidak tersedia",
				"zeroRecords": "Tidak ada data yang sesuai",
				"paginate": {
					'previous': '<i class="fa fa-chevron-left"></i>',
					'next': '<i class="fa fa-chevron-right"></i>'
				}
			}
		});

    // Pasang 1 Grup Filter Terpadu (Tahun & Status) tepat di sebelah 'Cari Project:'
    var unifiedFilterHtml = 
      '<div id="WrapperUnifiedFilter">' +
        '<div class="filter-label">' +
          '<i class="fa fa-filter text-danger"></i>' +
          '<span>Filter:</span>' +
        '</div>' +
        '<select class="form-control form-control-sm" id="SelectFilterTahun" style="min-width: 120px;">' +
          '<option value="">Semua Tahun</option>' +
          <?php foreach ($listTahun as $th) { ?>
            '<option value="<?=htmlspecialchars($th, ENT_QUOTES)?>">Tahun <?=htmlspecialchars($th, ENT_QUOTES)?></option>' +
          <?php } ?>
        '</select>' +
        '<select class="form-control form-control-sm" id="SelectFilterStatus" style="min-width: 140px;">' +
          '<option value="">Semua Status</option>' +
          '<option value="Belum Mulai">Belum Mulai</option>' +
          '<option value="Sedang Proses">Sedang Dikerjakan / Proses</option>' +
          '<option value="Selesai">Selesai</option>' +
        '</select>' +
        '<button type="button" class="btn btn-sm" id="BtnResetFilters" title="Reset Semua Filter" style="display: none;">' +
          '<i class="fa fa-refresh"></i>' +
        '</button>' +
      '</div>';

    $('#TabelProject_wrapper .dataTables_filter').prepend(unifiedFilterHtml);

    function checkFilterResetBtn() {
      var y = $('#SelectFilterTahun').val();
      var s = $('#SelectFilterStatus').val();
      if (y !== '' || s !== '') {
        $('#BtnResetFilters').css('display', 'inline-flex');
      } else {
        $('#BtnResetFilters').hide();
      }
    }

    $('#SelectFilterTahun').on('change', function() {
      var selectedYear = $(this).val();
      table.column(3).search(selectedYear ? selectedYear : '', true, false).draw();
      checkFilterResetBtn();
    });

    $('#SelectFilterStatus').on('change', function() {
      var selectedStatus = $(this).val();
      if (selectedStatus === 'Belum Mulai') {
        table.column(4).search('^Belum Mulai$', true, false).draw();
      } else if (selectedStatus === 'Sedang Proses') {
        table.column(4).search('^Sedang Proses$', true, false).draw();
      } else if (selectedStatus === 'Selesai') {
        table.column(4).search('^Selesai$', true, false).draw();
      } else {
        table.column(4).search('', true, false).draw();
      }
      checkFilterResetBtn();
    });

    $(document).on('click', '#BtnResetFilters', function() {
      $('#SelectFilterTahun').val('');
      $('#SelectFilterStatus').val('');
      table.column(3).search('').column(4).search('').draw();
      $(this).hide();
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
        $('#FallbackIcon').attr('class', 'fa fa-file-archive-o');
        $('#FallbackIconWrapper').css({ 'background': 'rgba(234, 88, 12, 0.1)', 'color': '#ea580c' });
        $('#FallbackFileDesc').text('Berkas arsip terkompresi (' + ext.toUpperCase() + ') dapat diunduh langsung untuk diekstrak pada komputer Anda.');
        $('#BtnFallbackDownload').html('<i class="fa fa-download mr-1"></i> Unduh Berkas ' + ext.toUpperCase());
        $('#FallbackViewerContainer').show();
      }
      else {
        $('#ViewerLoadingSpinner').hide();
        $('#FallbackIcon').attr('class', 'fa fa-download');
        $('#FallbackIconWrapper').css({ 'background': 'rgba(4, 49, 104, 0.1)', 'color': '#043168' });
        $('#FallbackFileDesc').text('Format berkas ini dapat dibuka langsung melalui aplikasi atau diunduh ke perangkat Anda.');
        $('#BtnFallbackDownload').html('<i class="fa fa-download mr-1"></i> Buka / Unduh Berkas');
        $('#FallbackViewerContainer').show();
      }
    }

    // Open Multi-Doc Slide Modal
    $(document).on('click', '.btn-open-project-docs', function(){
      var docType = $(this).data('type') || 'Dokumen';
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
        alert('Tidak ada ' + docType + ' terlampir pada project ini.');
        return;
      }

      $('#ModalViewerProjectName').html(
        '<span class="badge badge-warning text-dark mr-1" style="font-size: 11px;">' + (docType === 'Admin' ? 'Dokumen Admin' : 'Dokumen Project') + '</span> ' +
        projectName
      );

      var tabsHtml = '';
      $.each(activeProjectFiles, function(i, f) {
        var ext = f.split('.').pop().toLowerCase();
        var iconHtml = '<i class="fa fa-file-text-o mr-1"></i>';

        if (ext === 'pdf') {
          iconHtml = '<i class="fa fa-file-pdf-o mr-1 text-danger"></i>';
        } else if (ext === 'doc' || ext === 'docx') {
          iconHtml = '<i class="fa fa-file-word-o mr-1 text-primary"></i>';
        } else if (ext === 'xls' || ext === 'xlsx' || ext === 'csv') {
          iconHtml = '<i class="fa fa-file-excel-o mr-1 text-success"></i>';
        } else if (ext === 'zip' || ext === 'rar' || ext === '7z') {
          iconHtml = '<i class="fa fa-file-archive-o mr-1" style="color: #ea580c;"></i>';
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

    // Ubah status project langsung dari kolom tabel
    $(document).on("click", ".btn-change-status", function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      var newStatus = $(this).data('status');
      
      $.ajax({
        url: BaseURL + 'Staf/UpdateStatus',
        type: 'post',
        data: {
          Id: id,
          Status: newStatus
        },
        success: function(res) {
          if (res == '1') {
            window.location.reload();
          } else {
            alert(res);
          }
        },
        error: function() {
          alert("Gagal mengubah status project!");
        }
      });
    });
	});
</script>
</body>
</html>