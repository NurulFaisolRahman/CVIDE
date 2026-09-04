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

// Helper untuk format tanggal Indonesia
function formatIndoDate($dateStr) {
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
function renderTimelineCell($deadline) {
  if (empty($deadline) || $deadline === '-') {
    return '<span class="text-muted" style="font-size: 12px;">-</span>';
  }

  // Jika mengandung pemisah pipe (|)
  if (strpos($deadline, '|') !== false) {
    $parts = explode('|', $deadline);
    $start = trim($parts[0] ?? '');
    $end = trim($parts[1] ?? '');

    $startFmt = formatIndoDate($start);
    $endFmt = formatIndoDate($end);

    return '
      <div class="timeline-pill-wrapper">
        <div class="timeline-node" title="Mulai: ' . htmlspecialchars($startFmt) . '">
          <span class="timeline-marker start"></span>
          <span class="timeline-text">' . htmlspecialchars($startFmt) . '</span>
        </div>
        <div class="timeline-line">
          <i class="fa-solid fa-arrow-right text-muted" style="font-size: 9px;"></i>
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
          <i class="fa-solid fa-arrow-right text-muted" style="font-size: 9px;"></i>
        </div>
        <div class="timeline-node">
          <span class="timeline-marker end"></span>
          <span class="timeline-text">' . htmlspecialchars(trim($parts[1])) . '</span>
        </div>
      </div>';
  }

  // Single date / single year
  $fmt = formatIndoDate($deadline);
  return '
    <div class="timeline-pill-wrapper single" title="Pelaksanaan: ' . htmlspecialchars($fmt) . '">
      <div class="timeline-node">
        <span class="timeline-marker single"></span>
        <span class="timeline-text">' . htmlspecialchars($fmt) . '</span>
      </div>
    </div>';
}

// Helper render Status Pill Button Dropdown (Single clean card)
function renderStatusBadge($id, $status) {
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
  $icon = '<i class="fa-solid fa-hourglass-start" style="font-size: 11px;"></i>';
  if ($status === 'Selesai') {
    $cls = 'status-selesai';
    $icon = '<i class="fa-solid fa-circle-check" style="font-size: 11.5px;"></i>';
  } else if ($status === 'Sedang Proses') {
    $cls = 'status-sedang-proses';
    $icon = '<i class="fa-solid fa-arrows-rotate fa-spin" style="font-size: 11px;"></i>';
  }

  return '
    <div class="dropdown d-inline-block position-relative">
      <button type="button" class="status-pill-btn ' . $cls . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk mengubah status project">
        ' . $icon . '
        <span>' . htmlspecialchars($status) . '</span>
        <i class="fa-solid fa-chevron-down status-chevron"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-right shadow-lg border-0" style="border-radius: 12px; font-size: 12px; min-width: 165px; padding: 6px; margin-top: 4px;">
        <h6 class="dropdown-header text-muted font-weight-bold" style="font-size: 9.5px; padding: 4px 10px; text-transform: uppercase; letter-spacing: 0.5px;">Ubah Status Project</h6>
        <a class="dropdown-item d-flex align-items-center btn-change-status ' . ($status == 'Belum Mulai' ? 'active font-weight-bold' : '') . '" href="javascript:void(0)" data-id="' . $id . '" data-status="Belum Mulai" style="gap: 8px; border-radius: 6px; padding: 7px 10px;">
          <i class="fa-solid fa-hourglass-start text-secondary" style="width: 14px;"></i> Belum Mulai
        </a>
        <a class="dropdown-item d-flex align-items-center btn-change-status ' . ($status == 'Sedang Proses' ? 'active font-weight-bold' : '') . '" href="javascript:void(0)" data-id="' . $id . '" data-status="Sedang Proses" style="gap: 8px; border-radius: 6px; padding: 7px 10px;">
          <i class="fa-solid fa-arrows-rotate text-primary" style="width: 14px;"></i> Sedang Proses
        </a>
        <a class="dropdown-item d-flex align-items-center btn-change-status ' . ($status == 'Selesai' ? 'active font-weight-bold' : '') . '" href="javascript:void(0)" data-id="' . $id . '" data-status="Selesai" style="gap: 8px; border-radius: 6px; padding: 7px 10px;">
          <i class="fa-solid fa-circle-check text-success" style="width: 14px;"></i> Selesai
        </a>
      </div>
    </div>';
}

// Helper untuk mendapatkan tahun selesai project
function getProjectEndYear($deadline) {
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

<!-- Extra Styling for Project Table, Timeline & In-Browser Document Viewer -->
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
    font-size: 8px;
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

  /* ==========================================================================
     TIMELINE DESIGN SYSTEM (Table & Form)
     ========================================================================== */
  .timeline-pill-wrapper {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 4px 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
    transition: all 0.2s ease;
  }
  .timeline-pill-wrapper:hover {
    border-color: #cbd5e1;
    box-shadow: 0 4px 10px rgba(4, 49, 104, 0.08);
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
    background-color: var(--ide-red);
    box-shadow: 0 0 0 2px rgba(180, 8, 20, 0.2);
  }
  .timeline-marker.single {
    background-color: var(--ide-navy);
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

  /* Modal Timeline Input Container */
  .timeline-input-card {
    background: #f8fafc;
    border: 1.5px dashed #cbd5e1;
    border-radius: 14px;
    padding: 14px 16px;
  }
  .timeline-input-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    font-size: 12.5px;
    font-weight: 700;
    color: #043168;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Tag label badge style under project title */
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
    transition: all 0.2s ease;
  }
  .tag-label-badge:hover {
    background: #e2e8f0;
    color: #0f172a;
  }

  /* In-Browser Document Viewer Paper Styles */
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
</style>

<!-- Enterprise Page Header Card -->
<div class="row mb-3" style="margin-top: 22px;">
  <div class="col-12">
    <div class="card border-0" style="background: #ffffff; border-radius: 20px; border: 1px solid var(--ide-border) !important; box-shadow: 0 8px 24px rgba(4, 49, 104, 0.05); padding: 18px 24px;">
      <div class="d-flex align-items-center" style="gap: 16px;">
        <div style="width: 50px; height: 50px; border-radius: 14px; background: linear-gradient(135deg, rgba(4, 49, 104, 0.1) 0%, rgba(180, 8, 20, 0.1) 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <i class="fa-solid fa-diagram-project" style="color: var(--ide-red); font-size: 24px;"></i>
        </div>
        <div>
          <div class="d-flex align-items-center" style="gap: 10px;">
            <h4 class="font-weight-bold text-dark mb-0" style="font-size: 18px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
              Manajemen Project / Kegiatan
            </h4>
            <span class="badge badge-primary px-2 py-1" style="background: var(--ide-navy); font-size: 11px; font-weight: 600; border-radius: 6px;">Staf Portal</span>
          </div>
          <p class="text-muted mb-0 mt-1" style="font-size: 12.5px;">
            Kelola data nama project, tag/kegiatan, instansi, jenis pengadaan, nominal, PIC, timeline, output, serta berkas Dokumen Admin & Dokumen Project.
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
        
        <!-- Tombol Tambah Project di Atas 'Tampilkan [10] data' -->
        <div class="mb-3">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalInput" style="border-radius: 10px; font-weight: 700; padding: 9px 20px; font-size: 13px; background: var(--ide-red); border: none; box-shadow: 0 4px 14px rgba(180, 8, 20, 0.3); transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-plus"></i> Tambah Project Baru
          </button>
        </div>

        <div class="table-responsive">
          <table id="TabelProject" class="table table-hover table-striped w-100" style="border-radius: 12px; overflow: hidden;">
            <thead>
              <tr style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff;">
                <th style="width: 4%;" class="text-center align-middle">No</th>
                <th style="width: 28%;" class="align-middle">Nama project/Kegiatan</th>
                <th style="width: 14%;" class="text-center align-middle">Jenis Pengadaan</th>
                <th style="width: 16%;" class="text-center align-middle">Timeline</th>
                <th style="width: 10%;" class="text-center align-middle">Status</th>
                <th style="width: 11%;" class="text-center align-middle">Dokumen Admin</th>
                <th style="width: 11%;" class="text-center align-middle">Dokumen Project</th>
                <th style="width: 6%;" class="text-center align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody id="RekapSurvei">
              <?php 
              $No = 1; 
              foreach ($Project as $key) { 
                $rawDl = !empty($key['Deadline']) ? $key['Deadline'] : '-';
                
                // Dokumen Admin
                $fileAdminList = getProjectFileList($key['DokumenAdmin'] ?? '');
                $fileAdminJsonAttr = htmlspecialchars(json_encode($fileAdminList), ENT_QUOTES, 'UTF-8');
                $totalAdminDocs = count($fileAdminList);

                // Dokumen Project (dengan fallback data lama 'File')
                $docProjectRaw = !empty($key['DokumenProject']) ? $key['DokumenProject'] : ($key['File'] ?? '');
                $fileProjectList = getProjectFileList($docProjectRaw);
                $fileProjectJsonAttr = htmlspecialchars(json_encode($fileProjectList), ENT_QUOTES, 'UTF-8');
                $totalProjectDocs = count($fileProjectList);

                // Tag List
                $tagStr = trim($key['Tag'] ?? '');
                $tags = !empty($tagStr) ? array_filter(array_map('trim', explode(',', $tagStr))) : array();

                // Jenis Pengadaan fallback ke Kategori jika belum ada
                $jenisPengadaan = !empty($key['JenisPengadaan']) ? $key['JenisPengadaan'] : (!empty($key['Kategori']) ? $key['Kategori'] : '-');
                $statusVal = !empty($key['Status']) ? $key['Status'] : 'Sedang Berjalan';
              ?>
                <tr>
                  <td class="text-center align-middle font-weight-bold"><?=$No++?></td>
                  
                  <!-- Kolom 1: Nama project/Kegiatan dengan Tahun Selesai & Tag Label di Bawahnya -->
                  <td class="align-middle">
                    <div class="font-weight-bold text-dark" style="font-size: 13.5px; line-height: 1.4;">
                      <i class="fa-solid fa-file-lines mr-1 text-primary"></i> <?=htmlspecialchars($key['NamaProject'])?>
                    </div>

                    <?php 
                    $endYear = getProjectEndYear($rawDl);
                    if (!empty($endYear)) { 
                    ?>
                      <div class="mt-1" style="font-size: 11.5px; font-weight: 700; color: #043168;">
                        <i class="fa-regular fa-calendar-check mr-1 text-danger"></i> Tahun <?=$endYear?>
                      </div>
                    <?php } ?>

                    <?php if (!empty($tags)) { ?>
                      <div class="mt-1 d-flex flex-wrap align-items-center" style="gap: 4px;">
                        <?php foreach ($tags as $t) { 
                          $cleanTag = ltrim($t, '#');
                        ?>
                          <span class="tag-label-badge">
                            <i class="fa-solid fa-hashtag text-primary mr-1" style="font-size: 9px;"></i><?=htmlspecialchars($cleanTag)?>
                          </span>
                        <?php } ?>
                      </div>
                    <?php } ?>
                  </td>

                  <!-- Kolom 2: Jenis Pengadaan -->
                  <td class="text-center align-middle">
                    <?php if ($jenisPengadaan !== '-') { ?>
                      <span class="badge px-2 py-1" style="background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 11px; font-weight: 600;">
                        <i class="fa-solid fa-layer-group text-secondary mr-1"></i> <?=htmlspecialchars($jenisPengadaan)?>
                      </span>
                    <?php } else { ?>
                      <span class="text-muted" style="font-size: 12px;">-</span>
                    <?php } ?>
                  </td>

                  <!-- Kolom 3: Timeline -->
                  <td class="text-center align-middle">
                    <?=renderTimelineCell($rawDl)?>
                  </td>

                  <!-- Kolom 4: Status (Single Clean Pill Card) -->
                  <td class="text-center align-middle text-nowrap">
                    <?=renderStatusBadge($key['Id'], $statusVal)?>
                  </td>

                  <!-- Kolom 5: Dokumen Admin (CRUD Terpisah Per Kolom) -->
                  <td class="text-center align-middle text-nowrap" id="CellDocAdmin-<?=$key['Id']?>">
                    <?php if ($totalAdminDocs > 0) { ?>
                      <button type="button" 
                        class="btn btn-sm text-white btn-manage-project-docs" 
                        data-type="Admin"
                        data-id="<?=$key['Id']?>"
                        data-project="<?=htmlspecialchars($key['NamaProject'], ENT_QUOTES)?>"
                        title="Kelola <?=$totalAdminDocs?> Dokumen Admin" 
                        style="border-radius: 8px; padding: 4px 10px; font-weight: 600; font-size: 11.5px; background: #0284c7; border: none; box-shadow: 0 2px 6px rgba(2, 132, 199, 0.2);">
                        <i class="fa-solid fa-folder-open mr-1"></i> <span class="doc-label"><?=$totalAdminDocs?> Berkas</span>
                      </button>
                    <?php } else { ?>
                      <button type="button" 
                        class="btn btn-sm btn-outline-primary btn-manage-project-docs" 
                        data-type="Admin"
                        data-id="<?=$key['Id']?>"
                        data-project="<?=htmlspecialchars($key['NamaProject'], ENT_QUOTES)?>"
                        title="Unggah Dokumen Admin" 
                        style="border-radius: 8px; font-size: 11px; padding: 3px 9px; font-weight: 600;">
                        <i class="fa-solid fa-plus mr-1"></i> Upload
                      </button>
                    <?php } ?>
                  </td>

                  <!-- Kolom 6: Dokumen Project (CRUD Terpisah Per Kolom) -->
                  <td class="text-center align-middle text-nowrap" id="CellDocProject-<?=$key['Id']?>">
                    <?php if ($totalProjectDocs > 0) { ?>
                      <button type="button" 
                        class="btn btn-sm text-white btn-manage-project-docs" 
                        data-type="Project"
                        data-id="<?=$key['Id']?>"
                        data-project="<?=htmlspecialchars($key['NamaProject'], ENT_QUOTES)?>"
                        title="Kelola <?=$totalProjectDocs?> Dokumen Project" 
                        style="border-radius: 8px; padding: 4px 10px; font-weight: 600; font-size: 11.5px; background: #059669; border: none; box-shadow: 0 2px 6px rgba(5, 150, 105, 0.2);">
                        <i class="fa-solid fa-folder-tree mr-1"></i> <span class="doc-label"><?=$totalProjectDocs?> Berkas</span>
                      </button>
                    <?php } else { ?>
                      <button type="button" 
                        class="btn btn-sm btn-outline-success btn-manage-project-docs" 
                        data-type="Project"
                        data-id="<?=$key['Id']?>"
                        data-project="<?=htmlspecialchars($key['NamaProject'], ENT_QUOTES)?>"
                        title="Unggah Dokumen Project" 
                        style="border-radius: 8px; font-size: 11px; padding: 3px 9px; font-weight: 600;">
                        <i class="fa-solid fa-plus mr-1"></i> Upload
                      </button>
                    <?php } ?>
                  </td>

                  <!-- Kolom 7: Aksi -->
                  <td class="text-center align-middle text-nowrap">
                    <button type="button" 
                      class="btn btn-sm btn-warning text-white Edit" 
                      title="Edit Data Project" 
                      data-id="<?=$key['Id']?>"
                      data-nama="<?=htmlspecialchars($key['NamaProject'], ENT_QUOTES)?>"
                      data-tag="<?=htmlspecialchars($key['Tag'] ?? '', ENT_QUOTES)?>"
                      data-instansi="<?=htmlspecialchars($key['Instansi'] ?? '', ENT_QUOTES)?>"
                      data-jenispengadaan="<?=htmlspecialchars($key['JenisPengadaan'] ?? ($key['Kategori'] ?? ''), ENT_QUOTES)?>"
                      data-nominal="<?=htmlspecialchars($key['Nominal'] ?? '', ENT_QUOTES)?>"
                      data-pic="<?=htmlspecialchars($key['PJ'] ?? '', ENT_QUOTES)?>"
                      data-deadline="<?=htmlspecialchars($key['Deadline'] ?? '', ENT_QUOTES)?>"
                      data-outputkegiatan="<?=htmlspecialchars($key['OutputKegiatan'] ?? '', ENT_QUOTES)?>"
                      data-catatan="<?=htmlspecialchars($key['Catatan'] ?? '', ENT_QUOTES)?>"
                      data-filesadmin="<?=$fileAdminJsonAttr?>"
                      data-filesproject="<?=$fileProjectJsonAttr?>"
                      style="border-radius: 8px; padding: 4px 8px;">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button type="button" 
                      data-id="<?=$key['Id']?>"
                      data-fileadmin="<?=$fileAdminJsonAttr?>"
                      data-fileproject="<?=$fileProjectJsonAttr?>"
                      class="btn btn-sm btn-danger Hapus" 
                      title="Hapus Data Project" 
                      style="border-radius: 8px; padding: 4px 8px;">
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

<!-- =========================================================================
     MODAL INPUT PROJECT (Form Input Tanpa Field Status - Otomatis Belum Mulai)
     ========================================================================= -->
<div class="modal fade" id="ModalInput" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
      
      <div class="modal-header" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff; padding: 14px 22px;">
        <h5 class="modal-title font-weight-bold mb-0 text-white" style="font-size: 16px;">
          <i class="fa-solid fa-folder-plus mr-2 text-warning"></i> Tambah Data Project / Kegiatan Baru
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body p-4" style="background-color: #f8fafc;">
        
        <!-- Row 1: Nama Project & PIC -->
        <div class="row">
          <div class="col-md-8 mb-3">
            <label for="NamaProject" class="font-weight-bold text-dark" style="font-size: 13px;">
              Nama Project / Kegiatan <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" id="NamaProject" placeholder="Masukkan nama project atau judul kegiatan..." style="border-radius: 8px;">
          </div>
          <div class="col-md-4 mb-3">
            <label for="PIC" class="font-weight-bold text-dark" style="font-size: 13px;">
              PIC / Penanggung Jawab
            </label>
            <input type="text" class="form-control" id="PIC" value="<?=$this->session->userdata('Username') ?: ($this->session->userdata('username') ?: '')?>" placeholder="Nama PIC..." style="border-radius: 8px;">
          </div>
        </div>

        <!-- Row 2: Tag & Instansi -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="Tag" class="font-weight-bold text-dark" style="font-size: 13px;">
              Tag / Kegiatan <small class="text-muted font-weight-normal">(Pisahkan dengan koma ",")</small>
            </label>
            <input type="text" class="form-control" id="Tag" placeholder="Contoh: Riset, IT & Software, Publikasi, Survei" style="border-radius: 8px;">
          </div>
          <div class="col-md-6 mb-3">
            <label for="Instansi" class="font-weight-bold text-dark" style="font-size: 13px;">
              Instansi / Klien
            </label>
            <input type="text" class="form-control" id="Instansi" placeholder="Contoh: Bappeda, Dinas Kominfo, PUDAM Banyuwangi" style="border-radius: 8px;">
          </div>
        </div>

        <!-- Row 3: Jenis Pengadaan & Nominal -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="JenisPengadaan" class="font-weight-bold text-dark" style="font-size: 13px;">
              Jenis Pengadaan
            </label>
            <input type="text" class="form-control" id="JenisPengadaan" placeholder="Contoh: Pengadaan Langsung, Tender, Swakelola..." style="border-radius: 8px;">
          </div>
          <div class="col-md-6 mb-3">
            <label for="Nominal" class="font-weight-bold text-dark" style="font-size: 13px;">
              Nominal Project / Kegiatan (Rp)
            </label>
            <input type="text" class="form-control input-currency" id="Nominal" placeholder="Contoh: Rp. 50.000.000" style="border-radius: 8px;">
          </div>
        </div>

        <!-- Row 4: Timeline Card Input -->
        <div class="form-group mb-3">
          <div class="timeline-input-card">
            <div class="timeline-input-header">
              <i class="fa-solid fa-timeline text-danger"></i> Timeline / Garis Waktu Pelaksanaan Kegiatan <span class="text-danger">*</span>
            </div>
            <div class="row" style="gap: 0;">
              <div class="col-md-6 mb-2 mb-md-0">
                <label for="TimelineMulai" class="text-muted" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">
                  <i class="fa-solid fa-circle-dot text-success mr-1"></i> Tanggal Mulai
                </label>
                <input type="date" class="form-control" id="TimelineMulai" value="<?=date('Y-m-01')?>" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
              </div>
              <div class="col-md-6">
                <label for="TimelineSelesai" class="text-muted" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">
                  <i class="fa-solid fa-circle-dot text-danger mr-1"></i> Tanggal Selesai
                </label>
                <input type="date" class="form-control" id="TimelineSelesai" value="<?=date('Y-m-t')?>" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
              </div>
            </div>
            <small class="form-text text-muted mt-2">
              <i class="fa-solid fa-circle-info mr-1"></i> Tentukan garis waktu pelaksanaan kegiatan project (Mulai s/d Selesai).
            </small>
          </div>
        </div>

        <!-- Row 5: Output Kegiatan (Full width) -->
        <div class="row">
          <div class="col-12 mb-2">
            <label for="OutputKegiatan" class="font-weight-bold text-dark" style="font-size: 13px;">
              Output Kegiatan
            </label>
            <input type="text" class="form-control" id="OutputKegiatan" placeholder="Contoh: Dokumen Laporan Akhir & Executive Summary" style="border-radius: 8px;">
          </div>
        </div>

      </div>

      <div class="modal-footer bg-white py-2 justify-content-between">
        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
        <div class="d-flex align-items-center">
          <button type="button" class="btn btn-primary px-4 font-weight-bold" id="Input" style="border-radius: 8px; background: var(--ide-red); border: none;">
            <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Data Project
          </button>
          <div id="LoadingInput" class="spinner-border text-danger ml-2" role="status" style="display: none; width: 1.5rem; height: 1.5rem;"></div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL EDIT PROJECT (Form Edit Tanpa Field Status)
     ========================================================================= -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
      
      <div class="modal-header" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff; padding: 14px 22px;">
        <h5 class="modal-title font-weight-bold mb-0 text-white" style="font-size: 16px;">
          <i class="fa-solid fa-pen-to-square mr-2 text-warning"></i> Edit Data Project / Kegiatan
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body p-4" style="background-color: #f8fafc;">
        <input type="hidden" id="Id">

        <!-- Row 1: Nama Project & PIC -->
        <div class="row">
          <div class="col-md-8 mb-3">
            <label for="EditNamaProject" class="font-weight-bold text-dark" style="font-size: 13px;">
              Nama Project / Kegiatan <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" id="EditNamaProject" placeholder="Masukkan nama project..." style="border-radius: 8px;">
          </div>
          <div class="col-md-4 mb-3">
            <label for="EditPIC" class="font-weight-bold text-dark" style="font-size: 13px;">
              PIC (Person in Charge) / Penanggung Jawab
            </label>
            <input type="text" class="form-control" id="EditPIC" placeholder="Nama PIC..." style="border-radius: 8px;">
          </div>
        </div>

        <!-- Row 2: Tag & Instansi -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="EditTag" class="font-weight-bold text-dark" style="font-size: 13px;">
              Tag / Kegiatan <small class="text-muted font-weight-normal">(Pisahkan dengan koma ",")</small>
            </label>
            <input type="text" class="form-control" id="EditTag" placeholder="Contoh: Riset, IT, Survei" style="border-radius: 8px;">
          </div>
          <div class="col-md-6 mb-3">
            <label for="EditInstansi" class="font-weight-bold text-dark" style="font-size: 13px;">
              Instansi / Klien
            </label>
            <input type="text" class="form-control" id="EditInstansi" placeholder="Contoh: Bappeda, Dinas Kominfo" style="border-radius: 8px;">
          </div>
        </div>

        <!-- Row 3: Jenis Pengadaan & Nominal -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="EditJenisPengadaan" class="font-weight-bold text-dark" style="font-size: 13px;">
              Jenis Pengadaan
            </label>
            <input type="text" class="form-control" id="EditJenisPengadaan" placeholder="Contoh: Pengadaan Langsung, Tender, Swakelola..." style="border-radius: 8px;">
          </div>
          <div class="col-md-6 mb-3">
            <label for="EditNominal" class="font-weight-bold text-dark" style="font-size: 13px;">
              Nominal Project / Kegiatan (Rp)
            </label>
            <input type="text" class="form-control input-currency" id="EditNominal" placeholder="Contoh: Rp. 50.000.000" style="border-radius: 8px;">
          </div>
        </div>

        <!-- Row 4: Timeline Card Input -->
        <div class="form-group mb-3">
          <div class="timeline-input-card">
            <div class="timeline-input-header">
              <i class="fa-solid fa-timeline text-danger"></i> Timeline / Garis Waktu Pelaksanaan Kegiatan <span class="text-danger">*</span>
            </div>
            <div class="row" style="gap: 0;">
              <div class="col-md-6 mb-2 mb-md-0">
                <label for="EditTimelineMulai" class="text-muted" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">
                  <i class="fa-solid fa-circle-dot text-success mr-1"></i> Tanggal Mulai
                </label>
                <input type="date" class="form-control" id="EditTimelineMulai" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
              </div>
              <div class="col-md-6">
                <label for="EditTimelineSelesai" class="text-muted" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">
                  <i class="fa-solid fa-circle-dot text-danger mr-1"></i> Tanggal Selesai
                </label>
                <input type="date" class="form-control" id="EditTimelineSelesai" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
              </div>
            </div>
          </div>
        </div>

        <!-- Row 5: Output Kegiatan (Full width) -->
        <div class="row">
          <div class="col-12 mb-2">
            <label for="EditOutputKegiatan" class="font-weight-bold text-dark" style="font-size: 13px;">
              Output Kegiatan
            </label>
            <input type="text" class="form-control" id="EditOutputKegiatan" placeholder="Uraian output target kegiatan..." style="border-radius: 8px;">
          </div>
        </div>

      </div>

      <div class="modal-footer bg-white py-2 justify-content-between">
        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
        <div class="d-flex align-items-center">
          <button type="button" class="btn btn-primary px-4 font-weight-bold" id="Edit" style="border-radius: 8px; background: var(--ide-navy); border: none;">
            <i class="fa-solid fa-floppy-disk mr-1"></i> Update Data Project
          </button>
          <div id="LoadingEdit" class="spinner-border text-danger ml-2" role="status" style="display: none; width: 1.5rem; height: 1.5rem;"></div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL KELOLA DOKUMEN (CRUD DOKUMEN PER KOLOM: ADMIN / PROJECT)
     ========================================================================= -->
<div class="modal fade" id="ModalKelolaDokumen" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
      
      <!-- Modal Header -->
      <div class="modal-header d-flex align-items-center justify-content-between" id="ModalKelolaDocHeader" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff; padding: 14px 22px;">
        <div class="d-flex align-items-center" style="gap: 12px;">
          <div id="ModalKelolaDocHeaderIcon" style="width: 40px; height: 40px; border-radius: 10px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-folder-open text-white" style="font-size: 18px;"></i>
          </div>
          <div>
            <div class="d-flex align-items-center" style="gap: 8px;">
              <h5 class="modal-title font-weight-bold mb-0 text-white" style="font-size: 16px;" id="ModalKelolaDocTitle">
                Kelola Dokumen
              </h5>
              <span class="badge badge-light" id="ModalKelolaDocTypeBadge" style="font-size: 11px; font-weight: 700;">Admin</span>
            </div>
            <p class="text-white-50 mb-0 mt-1" style="font-size: 12px;" id="ModalKelolaDocProjectName">
              Project: -
            </p>
          </div>
        </div>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-4" style="background-color: #f8fafc;">
        <input type="hidden" id="ManageDocProjectId">
        <input type="hidden" id="ManageDocType">

        <!-- Area 1: Upload Dokumen Baru dengan Penamaan Manual Per Berkas -->
        <div class="card p-3 mb-4 border" style="border-radius: 12px; background: #ffffff; border-color: #cbd5e1 !important; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <span class="font-weight-bold text-dark" style="font-size: 13px;">
              <i class="fa-solid fa-cloud-arrow-up text-primary mr-1"></i> Unggah Berkas Dokumen (Bisa Lebih Dari 1 & Dinamai Manual)
            </span>
            <button type="button" class="btn btn-sm btn-outline-primary font-weight-bold" id="BtnAddUploadRow" style="border-radius: 8px; font-size: 11.5px; padding: 4px 10px;">
              <i class="fa-solid fa-plus mr-1"></i> Tambah Baris Berkas
            </button>
          </div>

          <!-- Container Baris Upload -->
          <div id="UploadRowsContainer">
            <!-- Dynamic upload rows generated by JS -->
          </div>

          <div class="d-flex flex-wrap align-items-center justify-content-between mt-2 pt-2 border-top" style="gap: 10px;">
            <small class="text-muted">
              <i class="fa-solid fa-circle-info mr-1"></i> Format: <strong>PDF, Word, Excel, ZIP, RAR</strong>. Jika nama dokumen dikosongkan, nama asli file akan otomatis digunakan.
            </small>
            <button type="button" class="btn btn-primary font-weight-bold px-4" id="BtnSubmitUploadDoc" style="border-radius: 8px; height: 36px; display: inline-flex; align-items: center; gap: 6px;">
              <i class="fa-solid fa-upload"></i> Unggah Semua Berkas
            </button>
          </div>

          <div id="UploadDocProgress" class="mt-2 text-primary font-weight-bold" style="display: none; font-size: 12px;">
            <i class="fa-solid fa-spinner fa-spin mr-1"></i> Mengunggah berkas... Mohon tunggu...
          </div>
        </div>

        <!-- Area 2: Daftar Dokumen Terlampir -->
        <div>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="font-weight-bold text-dark mb-0" style="font-size: 13.5px;">
              <i class="fa-solid fa-list-check text-secondary mr-1"></i> Berkas Dokumen Terlampir (<span id="ManageDocCount">0</span>)
            </h6>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="BtnPreviewAllDocs" style="border-radius: 8px; font-size: 11.5px; padding: 3px 10px;">
              <i class="fa-solid fa-desktop mr-1 text-primary"></i> Buka In-Browser Viewer
            </button>
          </div>

          <div id="ManageDocListContainer" style="min-height: 120px;">
            <!-- Rendered list of files -->
          </div>
        </div>

      </div>

      <div class="modal-footer bg-white py-2">
        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 8px;">Tutup</button>
      </div>

    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL EDIT BERKAS DOKUMEN (UBAH NAMA & GANTI FILE)
     ========================================================================= -->
<div class="modal fade" id="ModalEditDokumenItem" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1060;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
      
      <div class="modal-header d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff; padding: 14px 20px;">
        <div class="d-flex align-items-center" style="gap: 10px;">
          <i class="fa-solid fa-file-pen text-warning" style="font-size: 18px;"></i>
          <h5 class="modal-title font-weight-bold mb-0 text-white" style="font-size: 15px;">
            Edit Berkas Dokumen
          </h5>
        </div>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body p-4" style="background: #f8fafc;">
        <input type="hidden" id="EditDocOldFileName">

        <!-- Info Berkas Saat Ini -->
        <div class="mb-3 p-3 border rounded bg-white" style="border-color: #e2e8f0 !important;">
          <small class="text-muted d-block font-weight-bold" style="font-size: 11px;">Berkas Saat Ini:</small>
          <div class="d-flex align-items-center mt-1" style="gap: 8px;">
            <span id="EditDocCurrentIcon"></span>
            <span id="EditDocCurrentName" class="font-weight-bold text-dark text-truncate" style="font-size: 13px;"></span>
          </div>
        </div>

        <!-- Input Ubah Nama / Judul Dokumen -->
        <div class="form-group mb-3">
          <label for="EditDocNewNameInput" class="font-weight-bold text-dark" style="font-size: 12.5px;">
            <i class="fa-solid fa-signature text-primary mr-1"></i> Nama / Judul Dokumen Baru
          </label>
          <input type="text" class="form-control" id="EditDocNewNameInput" placeholder="Masukkan nama/judul dokumen baru..." style="border-radius: 8px; font-size: 13px;">
          <small class="text-muted"><i class="fa-solid fa-circle-info mr-1"></i> Ekstensi file otomatis dipertahankan oleh sistem.</small>
        </div>

        <!-- Ganti File / Replace File (Opsional) -->
        <div class="form-group mb-2">
          <label for="EditDocReplaceFileInput" class="font-weight-bold text-dark" style="font-size: 12.5px;">
            <i class="fa-solid fa-arrow-right-arrow-left text-success mr-1"></i> Ganti Berkas File (Opsional)
          </label>
          <input type="file" class="form-control" id="EditDocReplaceFileInput" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.zip,.rar,.7z" style="border-radius: 8px; padding: 5px; font-size: 12px;">
          <small class="text-muted"><i class="fa-solid fa-circle-info mr-1"></i> Kosongkan jika hanya ingin mengganti nama/judul dokumen saja.</small>
        </div>

        <div id="EditDocProgress" class="mt-2 text-primary font-weight-bold" style="display: none; font-size: 12px;">
          <i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan perubahan dokumen...
        </div>
      </div>

      <div class="modal-footer bg-white py-2 justify-content-between">
        <button type="button" class="btn btn-secondary px-3" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
        <button type="button" class="btn btn-primary px-4 font-weight-bold" id="BtnSaveEditDocItem" style="border-radius: 8px; background: #043168; border: none;">
          <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Perubahan
        </button>
      </div>

    </div>
  </div>
</div>

<!-- =========================================================================
     UNIVERSAL IN-BROWSER MULTI-DOCUMENT SLIDE VIEWER MODAL
     ========================================================================= -->
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
              Pratinjau Dokumen
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
          <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" id="FallbackIconWrapper" style="width: 76px; height: 76px; background: rgba(4, 49, 104, 0.1); color: var(--ide-navy); margin: 0 auto;">
            <i class="fa-solid fa-file-zipper" id="FallbackIcon" style="font-size: 34px;"></i>
          </div>
          <h5 class="font-weight-bold text-dark mb-2" id="FallbackFileName">Dokumen Project</h5>
          <p class="text-muted" style="font-size: 13.5px;" id="FallbackFileDesc">Berkas arsip (ZIP / RAR) dapat diunduh dan diekstrak langsung pada komputer Anda.</p>
          <a href="#" id="BtnFallbackDownload" target="_blank" download class="btn btn-primary px-4 py-2" style="border-radius: 20px; font-weight: 700; background: var(--ide-red); border: none; box-shadow: 0 4px 14px rgba(180, 8, 20, 0.35);">
            <i class="fa-solid fa-download mr-1"></i> Unduh Berkas
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
    
    // Rupiah Auto-formatter Helper
    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
          split   = number_string.split(','),
          sisa    = split[0].length % 3,
          rupiah  = split[0].substr(0, sisa),
          ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? (prefix + ' ' + rupiah) : '');
    }

    $(document).on('keyup', '.input-currency', function() {
      $(this).val(formatRupiah($(this).val(), 'Rp.'));
    });

    // DataTable Initialization
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

    // Event listener untuk memfilter tabel berdasarkan Tahun (Kolom index 3 - Timeline)
    $('#SelectFilterTahun').on('change', function() {
      var selectedYear = $(this).val();
      table.column(3).search(selectedYear ? selectedYear : '', true, false).draw();
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
      // 4. ZIP / RAR / 7Z Archive Handler
      else if (ext === 'zip' || ext === 'rar' || ext === '7z') {
        $('#ViewerLoadingSpinner').hide();
        $('#FallbackIcon').attr('class', 'fa-solid fa-file-zipper');
        $('#FallbackIconWrapper').css({ 'background': 'rgba(234, 88, 12, 0.1)', 'color': '#ea580c' });
        $('#FallbackFileDesc').text('Berkas arsip terkompresi (' + ext.toUpperCase() + ') dapat diunduh langsung untuk diekstrak pada komputer Anda.');
        $('#BtnFallbackDownload').html('<i class="fa-solid fa-download mr-1"></i> Unduh Berkas ' + ext.toUpperCase());
        $('#FallbackViewerContainer').show();
      }
      // 5. Other formats fallback
      else {
        $('#ViewerLoadingSpinner').hide();
        $('#FallbackIcon').attr('class', 'fa-solid fa-file-arrow-down');
        $('#FallbackIconWrapper').css({ 'background': 'rgba(4, 49, 104, 0.1)', 'color': 'var(--ide-navy)' });
        $('#FallbackFileDesc').text('Format berkas ini dapat dibuka langsung melalui aplikasi atau diunduh ke perangkat Anda.');
        $('#BtnFallbackDownload').html('<i class="fa-solid fa-download mr-1"></i> Buka / Unduh Berkas');
        $('#FallbackViewerContainer').show();
      }
    }

    // Open Multi-Doc Slide Modal (Supports both Dokumen Admin and Dokumen Project)
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
    
    // 1. DOKUMEN ADMIN ROWS
    $(document).on('click', '.btn-add-admin-file-row', function(e) {
      e.preventDefault();
      var rowHtml = 
        '<div class="input-file-row d-flex align-items-center mb-2" style="gap: 8px;">' +
          '<input class="form-control file-admin-item" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.zip,.rar,.7z">' +
          '<button type="button" class="btn btn-danger btn-remove-file-row" style="border-radius: 8px; padding: 7px 12px; flex-shrink: 0;" title="Hapus Baris Ini">' +
            '<i class="fa-solid fa-trash-can"></i>' +
          '</button>' +
        '</div>';
      $('#InputAdminFilesContainer').append(rowHtml);
    });

    $(document).on('click', '.btn-add-edit-admin-file-row', function(e) {
      e.preventDefault();
      var rowHtml = 
        '<div class="input-file-row d-flex align-items-center mb-2" style="gap: 8px;">' +
          '<input class="form-control file-admin-item" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.zip,.rar,.7z">' +
          '<button type="button" class="btn btn-danger btn-remove-file-row" style="border-radius: 8px; padding: 7px 12px; flex-shrink: 0;" title="Hapus Baris Ini">' +
            '<i class="fa-solid fa-trash-can"></i>' +
          '</button>' +
        '</div>';
      $('#EditAdminFilesContainer').append(rowHtml);
    });

    // =========================================================================
    // MODAL KELOLA DOKUMEN (CRUD PER KOLOM DOKUMEN ADMIN / PROJECT)
    // =========================================================================
    var activeManageProjectId = null;
    var activeManageDocType = 'Admin';
    var activeManageProjectName = '';
    var activeManageFiles = [];

    // Helper render icon berdasarkan ekstensi
    function getFileExtensionIcon(fileName) {
      var ext = fileName.split('.').pop().toLowerCase();
      if (ext === 'pdf') {
        return '<i class="fa-solid fa-file-pdf text-danger" style="font-size: 16px;"></i>';
      } else if (ext === 'doc' || ext === 'docx') {
        return '<i class="fa-solid fa-file-word text-primary" style="font-size: 16px;"></i>';
      } else if (ext === 'xls' || ext === 'xlsx' || ext === 'csv') {
        return '<i class="fa-solid fa-file-excel text-success" style="font-size: 16px;"></i>';
      } else if (ext === 'zip' || ext === 'rar' || ext === '7z') {
        return '<i class="fa-solid fa-file-zipper" style="color: #ea580c; font-size: 16px;"></i>';
      }
      return '<i class="fa-solid fa-file-lines text-secondary" style="font-size: 16px;"></i>';
    }

    // Render daftar berkas di dalam Modal Kelola Dokumen
    function renderManageDocList() {
      var $container = $('#ManageDocListContainer');
      $container.empty();
      $('#ManageDocCount').text(activeManageFiles.length);

      if (activeManageFiles.length === 0) {
        $container.html(
          '<div class="text-center p-4 bg-white border rounded" style="border-radius: 12px; border-color: #cbd5e1 !important;">' +
            '<i class="fa-regular fa-folder-open text-muted mb-2" style="font-size: 32px;"></i>' +
            '<p class="text-muted mb-0 font-weight-bold" style="font-size: 13px;">Belum ada dokumen ' + (activeManageDocType === 'Admin' ? 'Admin' : 'Project') + ' terlampir.</p>' +
            '<small class="text-muted">Gunakan form di atas untuk mengunggah berkas baru.</small>' +
          '</div>'
        );
        $('#BtnPreviewAllDocs').hide();
        return;
      }

      $('#BtnPreviewAllDocs').show();
      var listHtml = '<div class="list-group shadow-sm" style="border-radius: 12px; overflow: hidden;">';

      $.each(activeManageFiles, function(i, f) {
        var iconHtml = getFileExtensionIcon(f);
        var fileUrl = BaseURL + 'Project/' + encodeURIComponent(f);
        var displayName = f.length > 40 ? f.substring(0, 37) + '...' : f;

        listHtml += 
          '<div class="list-group-item d-flex align-items-center justify-content-between p-3" style="border-color: #e2e8f0; gap: 12px;">' +
            '<div class="d-flex align-items-center" style="gap: 12px; min-width: 0;">' +
              '<div style="width: 36px; height: 36px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">' +
                iconHtml +
              '</div>' +
              '<div style="min-width: 0;">' +
                '<a href="' + fileUrl + '" target="_blank" class="font-weight-bold text-dark text-truncate d-block mb-0" style="font-size: 13px; text-decoration: none;" title="' + f + '">' +
                  displayName +
                '</a>' +
                '<small class="text-muted">Berkas ' + (i + 1) + ' dari ' + activeManageFiles.length + '</small>' +
              '</div>' +
            '</div>' +
            '<div class="d-flex align-items-center" style="gap: 6px; flex-shrink: 0;">' +
              '<button type="button" class="btn btn-sm btn-outline-primary btn-preview-single-doc" data-index="' + i + '" title="Pratinjau Dokumen" style="border-radius: 6px; padding: 4px 9px; font-size: 11.5px;">' +
                '<i class="fa-solid fa-eye mr-1"></i> Lihat' +
              '</button>' +
              '<button type="button" class="btn btn-sm btn-outline-warning text-dark btn-edit-doc-item" data-file="' + encodeURIComponent(f) + '" title="Edit Berkas (Ubah Nama / Ganti File)" style="border-radius: 6px; padding: 4px 9px; font-size: 11.5px; font-weight: 600;">' +
                '<i class="fa-solid fa-pen-to-square mr-1 text-warning"></i> Edit' +
              '</button>' +
              '<a href="' + fileUrl + '" download target="_blank" class="btn btn-sm btn-outline-secondary" title="Unduh Berkas" style="border-radius: 6px; padding: 4px 9px; font-size: 11.5px;">' +
                '<i class="fa-solid fa-download"></i>' +
              '</a>' +
              '<button type="button" class="btn btn-sm btn-outline-danger btn-delete-doc-file" data-file="' + encodeURIComponent(f) + '" title="Hapus Berkas Ini" style="border-radius: 6px; padding: 4px 9px; font-size: 11.5px;">' +
                '<i class="fa-solid fa-trash-can"></i>' +
              '</button>' +
            '</div>' +
          '</div>';
      });

      listHtml += '</div>';
      $container.html(listHtml);
    }

    // Update tampilan tombol di kolom tabel setelah upload / hapus berkas
    function updateTableCellButton(projectId, docType, total) {
      var cellId = docType === 'Admin' ? '#CellDocAdmin-' + projectId : '#CellDocProject-' + projectId;
      var $cell = $(cellId);
      if ($cell.length === 0) return;

      if (total > 0) {
        var bgClass = docType === 'Admin' ? '#0284c7' : '#059669';
        var iconClass = docType === 'Admin' ? 'fa-folder-open' : 'fa-folder-tree';
        var shadowClass = docType === 'Admin' ? 'rgba(2, 132, 199, 0.2)' : 'rgba(5, 150, 105, 0.2)';

        $cell.html(
          '<button type="button" class="btn btn-sm text-white btn-manage-project-docs" ' +
            'data-type="' + docType + '" ' +
            'data-id="' + projectId + '" ' +
            'data-project="' + activeManageProjectName.replace(/"/g, '&quot;') + '" ' +
            'title="Kelola ' + total + ' Dokumen ' + docType + '" ' +
            'style="border-radius: 8px; padding: 4px 10px; font-weight: 600; font-size: 11.5px; background: ' + bgClass + '; border: none; box-shadow: 0 2px 6px ' + shadowClass + ';">' +
            '<i class="fa-solid ' + iconClass + ' mr-1"></i> <span class="doc-label">' + total + ' Berkas</span>' +
          '</button>'
        );
      } else {
        var btnOutline = docType === 'Admin' ? 'btn-outline-primary' : 'btn-outline-success';
        $cell.html(
          '<button type="button" class="btn btn-sm ' + btnOutline + ' btn-manage-project-docs" ' +
            'data-type="' + docType + '" ' +
            'data-id="' + projectId + '" ' +
            'data-project="' + activeManageProjectName.replace(/"/g, '&quot;') + '" ' +
            'title="Unggah Dokumen ' + docType + '" ' +
            'style="border-radius: 8px; font-size: 11px; padding: 3px 9px; font-weight: 600;">' +
            '<i class="fa-solid fa-plus mr-1"></i> Upload' +
          '</button>'
        );
      }
    }

    // Helper buat baris baru upload berkas
    function createUploadEntryRow() {
      return $(
        '<div class="upload-file-entry-row mb-2 p-2 border rounded" style="background: #f8fafc; border-color: #e2e8f0 !important; border-radius: 8px;">' +
          '<div class="row align-items-center" style="gap: 6px 0;">' +
            '<div class="col-md-5">' +
              '<label class="text-muted font-weight-bold mb-1" style="font-size: 11px;"><i class="fa-solid fa-paperclip mr-1"></i> Pilih Berkas:</label>' +
              '<input type="file" class="form-control file-entry-input" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.zip,.rar,.7z" style="border-radius: 6px; padding: 4px 6px; font-size: 11.5px;">' +
            '</div>' +
            '<div class="col-md-6">' +
              '<label class="text-muted font-weight-bold mb-1" style="font-size: 11px;"><i class="fa-solid fa-pen-nib mr-1"></i> Nama Dokumen (Manual / Bebas):</label>' +
              '<input type="text" class="form-control file-entry-custom-name" placeholder="Ketik judul/nama dokumen..." style="border-radius: 6px; font-size: 12px; height: 33px;">' +
            '</div>' +
            '<div class="col-md-1 d-flex align-items-end justify-content-center">' +
              '<button type="button" class="btn btn-sm btn-outline-danger btn-remove-upload-entry-row" style="border-radius: 6px; padding: 5px 9px; margin-top: 20px;" title="Hapus Baris Ini">' +
                '<i class="fa-solid fa-trash-can"></i>' +
              '</button>' +
            '</div>' +
          '</div>' +
        '</div>'
      );
    }

    // Tambah baris berkas baru
    $('#BtnAddUploadRow').click(function() {
      $('#UploadRowsContainer').append(createUploadEntryRow());
    });

    // Hapus baris berkas
    $(document).on('click', '.btn-remove-upload-entry-row', function(e) {
      e.preventDefault();
      if ($('.upload-file-entry-row').length > 1) {
        $(this).closest('.upload-file-entry-row').remove();
      } else {
        // Jika baris terakhir, cukup kosongkan nilainya
        var $row = $(this).closest('.upload-file-entry-row');
        $row.find('.file-entry-input').val('');
        $row.find('.file-entry-custom-name').val('');
      }
    });

    // Auto-fill nama dokumen manual saat file dipilih
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

    // Klik tombol Kelola / Upload Dokumen dari tabel
    $(document).on('click', '.btn-manage-project-docs', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      var type = $(this).data('type') || 'Admin';
      var projectName = $(this).data('project') || 'Project';

      activeManageProjectId = id;
      activeManageDocType = type;
      activeManageProjectName = projectName;
      activeManageFiles = [];

      $('#ManageDocProjectId').val(id);
      $('#ManageDocType').val(type);
      $('#UploadDocProgress').hide();

      // Reset form upload dengan 1 baris bersih
      $('#UploadRowsContainer').empty().append(createUploadEntryRow());

      // Set Header
      $('#ModalKelolaDocTitle').text('Kelola Dokumen ' + (type === 'Admin' ? 'Admin' : 'Project'));
      $('#ModalKelolaDocTypeBadge').text(type === 'Admin' ? 'Admin' : 'Project');
      $('#ModalKelolaDocProjectName').text('Project: ' + projectName);

      if (type === 'Admin') {
        $('#ModalKelolaDocHeader').css('background', 'linear-gradient(135deg, #043168 0%, #0284c7 100%)');
        $('#ModalKelolaDocHeaderIcon').html('<i class="fa-solid fa-folder-open text-white" style="font-size: 18px;"></i>');
        $('#BtnSubmitUploadDoc').removeClass('btn-success').addClass('btn-primary');
        $('#BtnAddUploadRow').removeClass('btn-outline-success').addClass('btn-outline-primary');
      } else {
        $('#ModalKelolaDocHeader').css('background', 'linear-gradient(135deg, #064e3b 0%, #059669 100%)');
        $('#ModalKelolaDocHeaderIcon').html('<i class="fa-solid fa-folder-tree text-white" style="font-size: 18px;"></i>');
        $('#BtnSubmitUploadDoc').removeClass('btn-primary').addClass('btn-success');
        $('#BtnAddUploadRow').removeClass('btn-outline-primary').addClass('btn-outline-success');
      }

      $('#ManageDocListContainer').html(
        '<div class="text-center p-4"><i class="fa-solid fa-spinner fa-spin text-primary mr-2"></i> Memuat berkas dokumen...</div>'
      );

      $('#ModalKelolaDokumen').modal('show');

      // Fetch file list via AJAX
      $.post(BaseURL + 'Staf/GetDokumen', { Id: id, Type: type }, function(res) {
        try {
          var data = typeof res === 'object' ? res : JSON.parse(res);
          if (data.status === 'success') {
            activeManageFiles = data.files || [];
            renderManageDocList();
          } else {
            alert(data.message || 'Gagal memuat dokumen');
          }
        } catch(e) {
          console.error(e);
        }
      });
    });

    // Upload berkas baru (bisa multi-row & nama manual per berkas)
    $('#BtnSubmitUploadDoc').click(function() {
      var fd = new FormData();
      fd.append('Id', activeManageProjectId);
      fd.append('Type', activeManageDocType);

      var validFileCount = 0;

      $('.upload-file-entry-row').each(function() {
        var fileInput = $(this).find('.file-entry-input')[0];
        var customName = $(this).find('.file-entry-custom-name').val().trim();

        if (fileInput && fileInput.files && fileInput.files.length > 0) {
          fd.append('Files[]', fileInput.files[0]);
          fd.append('CustomNames[]', customName);
          validFileCount++;
        }
      });

      if (validFileCount === 0) {
        alert('Silakan pilih minimal 1 berkas dokumen yang akan diunggah!');
        return;
      }

      $('#BtnSubmitUploadDoc').prop('disabled', true);
      $('#UploadDocProgress').show();

      $.ajax({
        url: BaseURL + 'Staf/UploadDokumen',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(res) {
          $('#BtnSubmitUploadDoc').prop('disabled', false);
          $('#UploadDocProgress').hide();
          $('#UploadRowsContainer').empty().append(createUploadEntryRow());

          try {
            var data = typeof res === 'object' ? res : JSON.parse(res);
            if (data.status === 'success') {
              activeManageFiles = data.files || [];
              renderManageDocList();
              updateTableCellButton(activeManageProjectId, activeManageDocType, activeManageFiles.length);
            } else {
              alert(data.message || 'Gagal mengunggah dokumen!');
            }
          } catch(e) {
            alert('Respon server tidak valid');
          }
        },
        error: function() {
          $('#BtnSubmitUploadDoc').prop('disabled', false);
          $('#UploadDocProgress').hide();
          alert('Terjadi kesalahan sistem saat mengunggah berkas!');
        }
      });
    });

    // Hapus berkas dari dalam Modal Kelola Dokumen
    $(document).on('click', '.btn-delete-doc-file', function(e) {
      e.preventDefault();
      var fileName = decodeURIComponent($(this).data('file'));
      if (!confirm('Apakah Anda yakin ingin menghapus berkas "' + fileName + '"?')) {
        return;
      }

      var $btn = $(this);
      $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');

      $.post(BaseURL + 'Staf/HapusDokumenItem', {
        Id: activeManageProjectId,
        Type: activeManageDocType,
        FileName: fileName
      }, function(res) {
        try {
          var data = typeof res === 'object' ? res : JSON.parse(res);
          if (data.status === 'success') {
            activeManageFiles = data.files || [];
            renderManageDocList();
            updateTableCellButton(activeManageProjectId, activeManageDocType, activeManageFiles.length);
          } else {
            alert(data.message || 'Gagal menghapus berkas!');
            $btn.prop('disabled', false).html('<i class="fa-solid fa-trash-can"></i>');
          }
        } catch(e) {
          alert('Terjadi kesalahan saat menghapus berkas');
          $btn.prop('disabled', false).html('<i class="fa-solid fa-trash-can"></i>');
        }
      });
    });

    // Klik tombol Edit pada item berkas (Buka Modal Edit Berkas)
    $(document).on('click', '.btn-edit-doc-item', function(e) {
      e.preventDefault();
      var fileName = decodeURIComponent($(this).data('file'));
      var nameWithoutExt = fileName.replace(/\.[^/.]+$/, "");
      var iconHtml = getFileExtensionIcon(fileName);

      $('#EditDocOldFileName').val(fileName);
      $('#EditDocCurrentName').text(fileName).attr('title', fileName);
      $('#EditDocCurrentIcon').html(iconHtml);
      $('#EditDocNewNameInput').val(nameWithoutExt);
      $('#EditDocReplaceFileInput').val('');
      $('#EditDocProgress').hide();
      $('#BtnSaveEditDocItem').prop('disabled', false);

      $('#ModalEditDokumenItem').modal('show');
    });

    // Submit simpan edit berkas
    $('#BtnSaveEditDocItem').click(function() {
      var oldFileName = $('#EditDocOldFileName').val();
      var newName = $('#EditDocNewNameInput').val().trim();
      var replaceFileInput = document.getElementById('EditDocReplaceFileInput');
      var hasReplaceFile = replaceFileInput && replaceFileInput.files && replaceFileInput.files.length > 0;

      if (newName === '' && !hasReplaceFile) {
        alert('Silakan masukkan nama dokumen baru atau pilih file pengganti!');
        return;
      }

      var fd = new FormData();
      fd.append('Id', activeManageProjectId);
      fd.append('Type', activeManageDocType);
      fd.append('OldFileName', oldFileName);
      fd.append('NewFileName', newName);

      if (hasReplaceFile) {
        fd.append('ReplaceFile', replaceFileInput.files[0]);
      }

      $('#BtnSaveEditDocItem').prop('disabled', true);
      $('#EditDocProgress').show();

      $.ajax({
        url: BaseURL + 'Staf/EditDokumenItem',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(res) {
          $('#BtnSaveEditDocItem').prop('disabled', false);
          $('#EditDocProgress').hide();

          try {
            var data = typeof res === 'object' ? res : JSON.parse(res);
            if (data.status === 'success') {
              $('#ModalEditDokumenItem').modal('hide');
              activeManageFiles = data.files || [];
              renderManageDocList();
              updateTableCellButton(activeManageProjectId, activeManageDocType, activeManageFiles.length);
            } else {
              alert(data.message || 'Gagal memperbarui berkas!');
            }
          } catch(e) {
            alert('Respon server tidak valid');
          }
        },
        error: function() {
          $('#BtnSaveEditDocItem').prop('disabled', false);
          $('#EditDocProgress').hide();
          alert('Terjadi kesalahan sistem saat menyimpan perubahan berkas!');
        }
      });
    });

    // Pratinjau single dokumen atau all dokumen dari Modal Kelola Dokumen
    $(document).on('click', '.btn-preview-single-doc', function() {
      var idx = parseInt($(this).data('index'), 10);
      openViewerWithFiles(activeManageFiles, idx, activeManageProjectName, activeManageDocType);
    });

    $('#BtnPreviewAllDocs').click(function() {
      openViewerWithFiles(activeManageFiles, 0, activeManageProjectName, activeManageDocType);
    });

    function openViewerWithFiles(files, startIdx, projectName, docType) {
      if (!files || files.length === 0) return;
      activeProjectFiles = files;

      $('#ModalViewerProjectName').html(
        '<span class="badge badge-warning text-dark mr-1" style="font-size: 11px;">' + (docType === 'Admin' ? 'Dokumen Admin' : 'Dokumen Project') + '</span> ' +
        projectName
      );

      var tabsHtml = '';
      $.each(activeProjectFiles, function(i, f) {
        var iconHtml = getFileExtensionIcon(f);
        var displayName = f.length > 32 ? f.substring(0, 29) + '...' : f;

        tabsHtml += 
          '<button type="button" class="doc-slide-tab ' + (i === startIdx ? 'active' : '') + '" data-index="' + i + '" title="' + f + '">' +
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
      loadDocumentAtIndex(startIdx);
    }
     
    // =========================================================================
    // INPUT DATA SUBMIT AJAX (Hanya Data Pokok Project, Tanpa Berkas)
    // =========================================================================
    $("#Input").click(function() {
      if ($("#NamaProject").val().trim() === "") {
        alert("Nama Project / Kegiatan tidak boleh kosong!");
        return;
      }
      
      var tMulai = $("#TimelineMulai").val().trim();
      var tSelesai = $("#TimelineSelesai").val().trim();

      if (tMulai === "" && tSelesai === "") {
        alert("Timeline Project (Tanggal Mulai / Selesai) tidak boleh kosong!");
        return;
      }

      var deadlineVal = tMulai;
      if (tSelesai !== "") {
        deadlineVal = tMulai !== "" ? tMulai + "|" + tSelesai : tSelesai;
      }

      var dataInput = {
        NamaProject: $("#NamaProject").val(),
        Tag: $("#Tag").val(),
        Instansi: $("#Instansi").val(),
        JenisPengadaan: $("#JenisPengadaan").val(),
        Nominal: $("#Nominal").val(),
        PIC: $("#PIC").val(),
        Deadline: deadlineVal,
        OutputKegiatan: $("#OutputKegiatan").val()
      };

      $.ajax({
        url: BaseURL + 'Staf/Input',
        type: 'post',
        data: dataInput,
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

    // =========================================================================
    // EDIT CLICK HANDLER
    // =========================================================================
    $(document).on("click", ".Edit", function(){
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var tag = $(this).data('tag');
      var instansi = $(this).data('instansi');
      var jenispengadaan = $(this).data('jenispengadaan');
      var nominal = $(this).data('nominal');
      var pic = $(this).data('pic');
      var deadline = $(this).data('deadline');
      var outputkegiatan = $(this).data('outputkegiatan');

      // Format & Populate Timeline Form in Edit Modal
      var startVal = '';
      var endVal = '';

      if (deadline && typeof deadline === 'string') {
        if (deadline.indexOf('|') !== -1) {
          var parts = deadline.split('|');
          startVal = parts[0] || '';
          endVal = parts[1] || '';
        } else if (deadline.indexOf(' - ') !== -1) {
          var parts = deadline.split(' - ');
          startVal = parts[0] || '';
          endVal = parts[1] || '';
        } else {
          startVal = deadline;
          endVal = deadline;
        }
      }

      $("#Id").val(id || '');
      $("#EditNamaProject").val(nama || '');
      $("#EditTag").val(tag || '');
      $("#EditInstansi").val(instansi || '');
      $("#EditJenisPengadaan").val(jenispengadaan || '');
      $("#EditNominal").val(nominal || '');
      $("#EditPIC").val(pic || '');
      $("#EditTimelineMulai").val(startVal);
      $("#EditTimelineSelesai").val(endVal);
      $("#EditOutputKegiatan").val(outputkegiatan || '');

      $('#ModalEdit').modal("show");
    });

    // =========================================================================
    // SUBMIT EDIT AJAX (Hanya Data Pokok Project, Tanpa Berkas)
    // =========================================================================
    $("#Edit").click(function() {
      if ($("#EditNamaProject").val().trim() === "") {
        alert("Nama Project / Kegiatan tidak boleh kosong!");
        return;
      }
      
      var tMulai = $("#EditTimelineMulai").val().trim();
      var tSelesai = $("#EditTimelineSelesai").val().trim();

      if (tMulai === "" && tSelesai === "") {
        alert("Timeline Project (Tanggal Mulai / Selesai) tidak boleh kosong!");
        return;
      }

      var deadlineVal = tMulai;
      if (tSelesai !== "") {
        deadlineVal = tMulai !== "" ? tMulai + "|" + tSelesai : tSelesai;
      }

      var dataEdit = {
        Id: $("#Id").val(),
        NamaProject: $("#EditNamaProject").val(),
        Tag: $("#EditTag").val(),
        Instansi: $("#EditInstansi").val(),
        JenisPengadaan: $("#EditJenisPengadaan").val(),
        Nominal: $("#EditNominal").val(),
        PIC: $("#EditPIC").val(),
        Deadline: deadlineVal,
        OutputKegiatan: $("#EditOutputKegiatan").val()
      };

      $.ajax({
        url: BaseURL + 'Staf/Edit',
        type: 'post',
        data: dataEdit,
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

    // =========================================================================
    // UBAH STATUS PROJECT LANGSUNG DARI KOLOM TABEL
    // =========================================================================
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
            window.location = BaseURL + "Staf/Project";
          } else {
            alert(res);
          }
        },
        error: function() {
          alert("Gagal mengubah status project!");
        }
      });
    });

    // =========================================================================
    // HAPUS ACTION AJAX
    // =========================================================================
    $(document).on("click", ".Hapus", function(){
      if (!confirm("Apakah Anda yakin ingin menghapus data project ini beserta seluruh berkasnya?")) {
        return;
      }

      var id = $(this).data('id');
      var fileAdmin = $(this).data('fileadmin');
      var fileProject = $(this).data('fileproject');

      var Hapus = { 
        Id: id,
        FileAdmin: typeof fileAdmin === 'object' ? JSON.stringify(fileAdmin) : fileAdmin,
        FileProject: typeof fileProject === 'object' ? JSON.stringify(fileProject) : fileProject
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