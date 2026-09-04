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

  /* Harmonized Compact Style for Modal Upload Entry Form */
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
                  <td class="text-center align-middle font-weight-bold"><?=$No++?></td>
                  
                  <!-- Kolom 1: Nama project/Kegiatan dengan PIC, Tahun Selesai & Tag Label di Bawahnya -->
                  <td class="align-middle">
                    <div class="font-weight-bold text-dark" style="font-size: 12px; line-height: 1.35;">
                      <?=htmlspecialchars($key['NamaProject'])?>
                    </div>

                    <div class="mt-1 d-flex flex-wrap align-items-center" style="gap: 5px;">
                      <?php if (!empty($key['PJ'])) { ?>
                        <span class="badge" style="background-color: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; border-radius: 4px; font-size: 10px; font-weight: 600; padding: 2px 6px;">
                          <i class="fa-solid fa-user-tie text-success mr-1"></i> PIC: <?=htmlspecialchars($key['PJ'])?>
                        </span>
                      <?php } ?>

                      <?php 
                      $endYear = getProjectEndYear($rawDl);
                      if (!empty($endYear)) { 
                      ?>
                        <span class="badge" style="background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; border-radius: 4px; font-size: 10px; font-weight: 600; padding: 2px 6px;">
                          <i class="fa-regular fa-calendar-check mr-1 text-danger"></i> Tahun <?=$endYear?>
                        </span>
                      <?php } ?>

                      <?php if (!empty($tags)) { ?>
                        <?php foreach ($tags as $t) { 
                          $cleanTag = ltrim($t, '#');
                        ?>
                          <span class="tag-label-badge" style="font-size: 9.5px; padding: 2px 6px;">
                            <i class="fa-solid fa-hashtag text-primary mr-1" style="font-size: 8.5px;"></i><?=htmlspecialchars($cleanTag)?>
                          </span>
                        <?php } ?>
                      <?php } ?>
                    </div>
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

                  <!-- Kolom 4: Status (Single Clean Pill Card with DataTables data-filter/search) -->
                  <td class="text-center align-middle text-nowrap" data-filter="<?=$normStatus?>" data-search="<?=$normStatus?>">
                    <?=renderStatusBadge($key['Id'], $normStatus)?>
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
                      data-status="<?=htmlspecialchars($normStatus, ENT_QUOTES)?>"
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
     MODAL INPUT PROJECT
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
            <input type="text" class="form-control" id="PIC" placeholder="Nama PIC..." style="border-radius: 8px;">
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

        <!-- Row 3: Jenis Pengadaan, Nominal & Status -->
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="JenisPengadaan" class="font-weight-bold text-dark" style="font-size: 13px;">
              Jenis Pengadaan
            </label>
            <input type="text" class="form-control" id="JenisPengadaan" placeholder="Contoh: Pengadaan Langsung, Tender, Swakelola..." style="border-radius: 8px;">
          </div>
          <div class="col-md-4 mb-3">
            <label for="Nominal" class="font-weight-bold text-dark" style="font-size: 13px;">
              Nominal Project / Kegiatan (Rp)
            </label>
            <input type="text" class="form-control input-currency" id="Nominal" placeholder="Contoh: Rp. 50.000.000" style="border-radius: 8px;">
          </div>
          <div class="col-md-4 mb-3">
            <label for="Status" class="font-weight-bold text-dark" style="font-size: 13px;">
              Status Project <span class="text-danger">*</span>
            </label>
            <select class="form-control" id="Status" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
              <option value="Belum Mulai" selected>Belum Mulai</option>
              <option value="Sedang Proses">Sedang Proses</option>
              <option value="Selesai">Selesai</option>
            </select>
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
     MODAL EDIT PROJECT
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
              PIC / Penanggung Jawab
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

        <!-- Row 3: Jenis Pengadaan, Nominal & Status -->
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="EditJenisPengadaan" class="font-weight-bold text-dark" style="font-size: 13px;">
              Jenis Pengadaan
            </label>
            <input type="text" class="form-control" id="EditJenisPengadaan" placeholder="Contoh: Pengadaan Langsung, Tender, Swakelola..." style="border-radius: 8px;">
          </div>
          <div class="col-md-4 mb-3">
            <label for="EditNominal" class="font-weight-bold text-dark" style="font-size: 13px;">
              Nominal Project / Kegiatan (Rp)
            </label>
            <input type="text" class="form-control input-currency" id="EditNominal" placeholder="Contoh: Rp. 50.000.000" style="border-radius: 8px;">
          </div>
          <div class="col-md-4 mb-3">
            <label for="EditStatus" class="font-weight-bold text-dark" style="font-size: 13px;">
              Status Project <span class="text-danger">*</span>
            </label>
            <select class="form-control" id="EditStatus" style="border-radius: 8px; font-weight: 600; font-size: 13px;">
              <option value="Belum Mulai">Belum Mulai</option>
              <option value="Sedang Proses">Sedang Proses</option>
              <option value="Selesai">Selesai</option>
            </select>
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
      <div class="modal-header d-flex align-items-center justify-content-between" id="ModalKelolaDocHeader" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff; padding: 10px 18px;">
        <div class="d-flex align-items-center" style="gap: 10px;">
          <div id="ModalKelolaDocHeaderIcon" style="width: 32px; height: 32px; border-radius: 8px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-folder-open text-white" style="font-size: 15px;"></i>
          </div>
          <div>
            <div class="d-flex align-items-center" style="gap: 6px;">
              <h5 class="modal-title font-weight-bold mb-0 text-white" style="font-size: 14.5px;" id="ModalKelolaDocTitle">
                Kelola Dokumen
              </h5>
              <span class="badge badge-light" id="ModalKelolaDocTypeBadge" style="font-size: 10px; font-weight: 700; padding: 2px 6px;">Admin</span>
            </div>
            <p class="text-white-50 mb-0 mt-0" style="font-size: 11px;" id="ModalKelolaDocProjectName">
              Project: -
            </p>
          </div>
        </div>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; font-size: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body p-3" style="background-color: #f8fafc;">
        <input type="hidden" id="ManageDocProjectId">
        <input type="hidden" id="ManageDocType">

        <!-- Area 1: Upload Dokumen Baru / Link Google Drive -->
        <div class="card p-3 mb-3 border" style="border-radius: 10px; background: #ffffff; border-color: #cbd5e1 !important; box-shadow: 0 1px 4px rgba(0,0,0,0.03);">
          <div class="d-flex flex-wrap align-items-center justify-content-between mb-2" style="gap: 6px;">
            <span class="font-weight-bold text-dark" style="font-size: 12px;">
              <i class="fa-solid fa-cloud-arrow-up text-primary mr-1"></i> Unggah Berkas Dokumen atau Tautan Google Drive
            </span>
            <button type="button" class="btn btn-sm btn-outline-primary font-weight-bold" id="BtnAddUploadRow" style="border-radius: 6px; font-size: 11px; padding: 3px 9px;">
              <i class="fa-solid fa-plus mr-1"></i> Tambah Dokumen
            </button>
          </div>

          <!-- Container Baris Upload -->
          <div id="UploadRowsContainer">
            <!-- Dynamic upload rows generated by JS -->
          </div>

          <div class="d-flex flex-wrap align-items-center justify-content-between mt-2 pt-2 border-top" style="gap: 8px;">
            <small class="text-muted" style="font-size: 10.5px;">
              <i class="fa-solid fa-circle-info mr-1"></i> Format: <strong>PDF, Word, Excel, ZIP, RAR, atau Tautan Google Drive</strong>.
            </small>
            <button type="button" class="btn btn-primary font-weight-bold px-3" id="BtnSubmitUploadDoc" style="border-radius: 6px; height: 32px; font-size: 11.5px; display: inline-flex; align-items: center; gap: 5px;">
              <i class="fa-solid fa-floppy-disk"></i> Simpan Semua Dokumen
            </button>
          </div>

          <div id="UploadDocProgress" class="mt-2 text-primary font-weight-bold" style="display: none; font-size: 11.5px;">
            <i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan dokumen... Mohon tunggu...
          </div>
        </div>

        <!-- Area 2: Daftar Dokumen Terlampir -->
        <div>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="font-weight-bold text-dark mb-0" style="font-size: 12px;">
              <i class="fa-solid fa-list-check text-secondary mr-1"></i> Berkas Dokumen Terlampir (<span id="ManageDocCount">0</span>)
            </h6>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="BtnPreviewAllDocs" style="border-radius: 6px; font-size: 10.5px; padding: 2px 8px;">
              <i class="fa-solid fa-desktop mr-1 text-primary"></i> Buka In-Browser Viewer
            </button>
          </div>

          <div id="ManageDocListContainer" style="min-height: 100px;">
            <!-- Rendered list of files -->
          </div>
        </div>

      </div>

      <div class="modal-footer bg-white py-2">
        <button type="button" class="btn btn-sm btn-secondary px-3" data-dismiss="modal" style="border-radius: 6px; font-size: 11.5px;">Tutup</button>
      </div>

    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL EDIT BERKAS DOKUMEN / TAUTAN GOOGLE DRIVE
     ========================================================================= -->
<div class="modal fade" id="ModalEditDokumenItem" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1060;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
      
      <div class="modal-header d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff; padding: 10px 18px;">
        <div class="d-flex align-items-center" style="gap: 8px;">
          <i class="fa-solid fa-file-pen text-warning" style="font-size: 15px;"></i>
          <h5 class="modal-title font-weight-bold mb-0 text-white" style="font-size: 14px;">
            Edit Dokumen / Tautan
          </h5>
        </div>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; font-size: 20px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body p-3" style="background: #f8fafc;">
        <input type="hidden" id="EditDocOldFileName">
        <input type="hidden" id="EditDocIsDrive">

        <!-- Info Berkas Saat Ini -->
        <div class="mb-2 p-2 border rounded bg-white" style="border-color: #e2e8f0 !important;">
          <small class="text-muted d-block font-weight-bold" style="font-size: 10px;">Dokumen / Tautan Saat Ini:</small>
          <div class="d-flex align-items-center mt-1" style="gap: 6px;">
            <span id="EditDocCurrentIcon"></span>
            <span id="EditDocCurrentName" class="font-weight-bold text-dark text-truncate" style="font-size: 12px;"></span>
          </div>
        </div>

        <!-- Input Ubah Nama / Judul Dokumen -->
        <div class="form-group mb-2">
          <label for="EditDocNewNameInput" class="font-weight-bold text-dark mb-1" style="font-size: 11px;">
            <i class="fa-solid fa-signature text-primary mr-1"></i> Nama / Judul Dokumen
          </label>
          <input type="text" class="form-control" id="EditDocNewNameInput" placeholder="Masukkan nama/judul dokumen..." style="border-radius: 6px; font-size: 11.5px; height: 32px;">
          <small class="text-muted" style="font-size: 10px;"><i class="fa-solid fa-circle-info mr-1"></i> Judul tampilan dokumen pada tabel dan viewer.</small>
        </div>

        <!-- Input URL Google Drive (Khusus Tautan GDrive) -->
        <div class="form-group mb-2" id="EditDocDriveUrlContainer" style="display: none;">
          <label for="EditDocDriveUrlInput" class="font-weight-bold text-dark mb-1" style="font-size: 11px;">
            <i class="fa-brands fa-google-drive text-success mr-1"></i> Tautan / Link Google Drive
          </label>
          <input type="url" class="form-control" id="EditDocDriveUrlInput" placeholder="https://drive.google.com/..." style="border-radius: 6px; font-size: 11.5px; height: 32px;">
        </div>

        <!-- Ganti File / Replace File (Khusus Berkas Lokal) -->
        <div class="form-group mb-2" id="EditDocReplaceFileContainer">
          <label for="EditDocReplaceFileInput" class="font-weight-bold text-dark mb-1" style="font-size: 11px;">
            <i class="fa-solid fa-arrow-right-arrow-left text-success mr-1"></i> Ganti Berkas File (Opsional)
          </label>
          <input type="file" class="form-control" id="EditDocReplaceFileInput" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.zip,.rar,.7z" style="border-radius: 6px; padding: 3px 6px; font-size: 11px; height: 32px;">
          <small class="text-muted" style="font-size: 10px;"><i class="fa-solid fa-circle-info mr-1"></i> Kosongkan jika hanya ingin mengganti nama/judul dokumen saja.</small>
        </div>

        <div id="EditDocProgress" class="mt-2 text-primary font-weight-bold" style="display: none; font-size: 11px;">
          <i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan perubahan dokumen...
        </div>
      </div>

      <div class="modal-footer bg-white py-2 justify-content-between">
        <button type="button" class="btn btn-sm btn-secondary px-3" data-dismiss="modal" style="border-radius: 6px; font-size: 11.5px;">Batal</button>
        <button type="button" class="btn btn-sm btn-primary px-3 font-weight-bold" id="BtnSaveEditDocItem" style="border-radius: 6px; background: #043168; border: none; font-size: 11.5px;">
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
          "previous": '<i class="fa-solid fa-chevron-left"></i>',
          "next": '<i class="fa-solid fa-chevron-right"></i>'
        }
      }
    });

    // Pasang 1 Grup Filter Terpadu (Tahun & Status) tepat di sebelah 'Cari Project:'
    var unifiedFilterHtml = 
      '<div id="WrapperUnifiedFilter">' +
        '<div class="filter-label">' +
          '<i class="fa-solid fa-filter text-danger"></i>' +
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
          '<i class="fa-solid fa-rotate-left"></i>' +
        '</button>' +
      '</div>';

    // Sisipkan 1 grup filter terpadu sebelum kolom input pencarian
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

    // Event listener untuk memfilter tabel berdasarkan Tahun (Kolom index 3 - Timeline)
    $('#SelectFilterTahun').on('change', function() {
      var selectedYear = $(this).val();
      table.column(3).search(selectedYear ? selectedYear : '', true, false).draw();
      checkFilterResetBtn();
    });

    // Event listener untuk memfilter tabel berdasarkan Status (Kolom index 4 - Status)
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

    // Reset Semua Filter Sekaligus
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

    // Helper untuk membedah data dokumen (berkas lokal vs tautan Google Drive/Web)
    function parseDocItem(raw) {
      if (!raw) return { isLink: false, isDrive: false, url: '', name: '', raw: '' };
      if (typeof raw === 'object' && raw !== null) {
        var u = raw.url || '';
        var n = raw.name || u;
        var d = /drive\.google\.com|docs\.google\.com/i.test(u);
        return { isLink: true, isDrive: d, url: u, name: n, raw: JSON.stringify(raw) };
      }

      var str = String(raw).trim();
      if (str.startsWith('http://') || str.startsWith('https://')) {
        var parts = str.split('::');
        var u = parts[0].trim();
        var n = parts.length > 1 ? parts.slice(1).join('::').trim() : '';
        var d = /drive\.google\.com|docs\.google\.com/i.test(u);
        if (!n) {
          n = d ? 'Google Drive Document' : 'Tautan Dokumen Eksternal';
        }
        return { isLink: true, isDrive: d, url: u, name: n, raw: str };
      }

      return { isLink: false, isDrive: false, url: BaseURL + 'Project/' + encodeURIComponent(str), name: str, raw: str };
    }

    function loadDocumentAtIndex(index) {
      if (!activeProjectFiles || activeProjectFiles.length === 0 || index < 0 || index >= activeProjectFiles.length) {
        return;
      }
      activeDocIndex = index;
      var rawItem = activeProjectFiles[index];
      var doc = parseDocItem(rawItem);

      // Update Tabs styling
      $('.doc-slide-tab').removeClass('active');
      $('.doc-slide-tab[data-index="' + index + '"]').addClass('active');

      // Reset viewer containers
      $('#ViewerLoadingSpinner').show();
      $('#PdfViewerContainer').hide();
      $('#WordViewerContainer').hide();
      $('#ExcelViewerContainer').hide();
      $('#FallbackViewerContainer').hide();

      // ==========================================
      // KASUS 1: TAUTAN GOOGLE DRIVE / LINK WEB
      // ==========================================
      if (doc.isLink) {
        var previewEmbedUrl = '';

        if (doc.isDrive) {
          var fileMatch = doc.url.match(/\/file\/d\/([a-zA-Z0-9_-]+)/i) || doc.url.match(/[?&]id=([a-zA-Z0-9_-]+)/i);
          var docMatch = doc.url.match(/\/document\/d\/([a-zA-Z0-9_-]+)/i);
          var sheetMatch = doc.url.match(/\/spreadsheets\/d\/([a-zA-Z0-9_-]+)/i);
          var slideMatch = doc.url.match(/\/presentation\/d\/([a-zA-Z0-9_-]+)/i);
          var folderMatch = doc.url.match(/\/drive\/folders\/([a-zA-Z0-9_-]+)/i);

          if (fileMatch) {
            previewEmbedUrl = 'https://drive.google.com/file/d/' + fileMatch[1] + '/preview';
          } else if (docMatch) {
            previewEmbedUrl = 'https://docs.google.com/document/d/' + docMatch[1] + '/preview';
          } else if (sheetMatch) {
            previewEmbedUrl = 'https://docs.google.com/spreadsheets/d/' + sheetMatch[1] + '/preview';
          } else if (slideMatch) {
            previewEmbedUrl = 'https://docs.google.com/presentation/d/' + slideMatch[1] + '/preview';
          } else if (folderMatch) {
            previewEmbedUrl = 'https://drive.google.com/embeddedfolderview?id=' + folderMatch[1] + '#list';
          }
        }

        $('#ModalViewerDocCounter').text('Dokumen ' + (index + 1) + ' dari ' + activeProjectFiles.length + ' (' + doc.name + ')');
        $('#ModalViewerFooterInfo').html('<i class="fa-brands fa-google-drive text-success mr-1"></i> ' + doc.name + ' &bull; Tautan Google Drive');
        $('#BtnDownloadDoc').attr('href', doc.url).attr('target', '_blank').removeAttr('download').html('<i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> Buka di Google Drive');

        $('#ViewerLoadingSpinner').hide();

        if (previewEmbedUrl) {
          $('#PdfViewerContainer').html('<iframe src="' + previewEmbedUrl + '" width="100%" height="600" style="border: none; border-radius: 8px;" allow="autoplay"></iframe>').show();
        } else {
          $('#FallbackIcon').attr('class', 'fa-brands fa-google-drive');
          $('#FallbackIconWrapper').css({ 'background': 'rgba(15, 157, 88, 0.1)', 'color': '#0f9d58' });
          $('#FallbackFileName').text(doc.name);
          $('#FallbackFileDesc').html('Tautan dokumen tersimpan di Google Drive:<br><a href="' + doc.url + '" target="_blank" class="text-primary font-weight-bold" style="word-break: break-all;">' + doc.url + '</a>');
          $('#BtnFallbackDownload').attr('href', doc.url).attr('target', '_blank').removeAttr('download').html('<i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> Buka Tautan Google Drive');
          $('#FallbackViewerContainer').show();
        }
        return;
      }

      // ==========================================
      // KASUS 2: BERKAS FISIK LOKAL
      // ==========================================
      var fileName = doc.name;
      var fileUrl = doc.url;
      var ext = fileName.split('.').pop().toLowerCase();

      // Update counters & headers
      $('#ModalViewerDocCounter').text('Dokumen ' + (index + 1) + ' dari ' + activeProjectFiles.length + ' (' + fileName + ')');
      $('#ModalViewerFooterInfo').html('<i class="fa-solid fa-file mr-1"></i> ' + fileName + ' &bull; Dokumen ' + (index + 1) + ' / ' + activeProjectFiles.length);
      $('#BtnDownloadDoc').attr('href', fileUrl).attr('target', '_blank').attr('download', fileName).html('<i class="fa-solid fa-download mr-1"></i> Unduh File Aktif');
      $('#BtnFallbackDownload').attr('href', fileUrl).attr('target', '_blank').attr('download', fileName);
      $('#FallbackFileName').text(fileName);

      // 1. PDF
      if (ext === 'pdf') {
        $('#PdfViewerContainer').html('<embed id="PathProject" src="' + fileUrl + '" type="application/pdf" width="100%" height="600" style="border: none; border-radius: 8px;"/>');
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
        var doc = parseDocItem(f);
        var iconHtml = getFileExtensionIcon(f);
        var displayName = doc.name.length > 32 ? doc.name.substring(0, 29) + '...' : doc.name;

        tabsHtml += 
          '<button type="button" class="doc-slide-tab ' + (i === 0 ? 'active' : '') + '" data-index="' + i + '" title="' + doc.name + '">' +
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

    // Helper render icon berdasarkan ekstensi atau tautan Google Drive
    function getFileExtensionIcon(raw) {
      var doc = parseDocItem(raw);
      if (doc.isLink) {
        if (doc.isDrive) {
          return '<i class="fa-brands fa-google-drive" style="color: #0f9d58; font-size: 16px;"></i>';
        }
        return '<i class="fa-solid fa-arrow-up-right-from-square text-primary" style="font-size: 15px;"></i>';
      }
      var ext = doc.name.split('.').pop().toLowerCase();
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
          '<div class="text-center p-3 bg-white border rounded" style="border-radius: 8px; border-color: #cbd5e1 !important;">' +
            '<i class="fa-regular fa-folder-open text-muted mb-1" style="font-size: 24px;"></i>' +
            '<p class="text-muted mb-0 font-weight-bold" style="font-size: 11.5px;">Belum ada dokumen ' + (activeManageDocType === 'Admin' ? 'Admin' : 'Project') + ' terlampir.</p>' +
            '<small class="text-muted" style="font-size: 10.5px;">Gunakan form di atas untuk menambahkan berkas atau tautan Google Drive.</small>' +
          '</div>'
        );
        $('#BtnPreviewAllDocs').hide();
        return;
      }

      $('#BtnPreviewAllDocs').show();
      var listHtml = '<div class="list-group shadow-sm" style="border-radius: 8px; overflow: hidden;">';

      $.each(activeManageFiles, function(i, f) {
        var doc = parseDocItem(f);
        var iconHtml = getFileExtensionIcon(f);
        var displayName = doc.name.length > 40 ? doc.name.substring(0, 37) + '...' : doc.name;
        var subText = doc.isLink 
          ? (doc.isDrive 
              ? '<span class="badge" style="background-color: #dcfce7; color: #15803d; border: 1px solid #86efac; border-radius: 6px; font-size: 10.5px; font-weight: 600; padding: 3px 10px; display: inline-flex; align-items: center; gap: 5px; line-height: 1.4;"><i class="fa-brands fa-google-drive" style="font-size: 11px; color: #0f9d58;"></i> Google Drive</span>' 
              : '<span class="badge" style="background-color: #e0f2fe; color: #0369a1; border: 1px solid #7dd3fc; border-radius: 6px; font-size: 10.5px; font-weight: 600; padding: 3px 10px; display: inline-flex; align-items: center; gap: 5px; line-height: 1.4;"><i class="fa-solid fa-link" style="font-size: 10.5px;"></i> Tautan Web</span>') 
          : '<small class="text-muted" style="font-size: 10.5px;">Berkas ' + (i + 1) + ' dari ' + activeManageFiles.length + '</small>';

        listHtml += 
          '<div class="list-group-item d-flex align-items-center justify-content-between p-2" style="border-color: #e2e8f0; gap: 8px;">' +
            '<div class="d-flex align-items-center" style="gap: 8px; min-width: 0;">' +
              '<div style="width: 28px; height: 28px; border-radius: 6px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">' +
                iconHtml +
              '</div>' +
              '<div style="min-width: 0;">' +
                '<a href="' + doc.url + '" target="_blank" class="font-weight-bold text-dark text-truncate d-block mb-1" style="font-size: 12px; text-decoration: none;" title="' + doc.name + '">' +
                  displayName +
                '</a>' +
                subText +
              '</div>' +
            '</div>' +
            '<div class="d-flex align-items-center" style="gap: 4px; flex-shrink: 0;">' +
              '<button type="button" class="btn btn-sm btn-outline-primary btn-preview-single-doc" data-index="' + i + '" title="Pratinjau Dokumen" style="border-radius: 5px; height: 25px; padding: 0 7px; font-size: 10.5px; display: inline-flex; align-items: center; justify-content: center;">' +
                '<i class="fa-solid fa-eye mr-1"></i> Lihat' +
              '</button>' +
              '<button type="button" class="btn btn-sm btn-outline-warning btn-edit-doc-item" data-raw="' + encodeURIComponent(f) + '" title="Edit Dokumen / Tautan" style="border-radius: 5px; width: 25px; height: 25px; padding: 0; font-size: 10.5px; display: inline-flex; align-items: center; justify-content: center;">' +
                '<i class="fa-solid fa-pen-to-square text-warning"></i>' +
              '</button>' +
              '<a href="' + doc.url + '" ' + (doc.isLink ? 'target="_blank"' : 'download target="_blank"') + ' class="btn btn-sm btn-outline-secondary" title="' + (doc.isLink ? 'Buka Tautan' : 'Unduh Berkas') + '" style="border-radius: 5px; width: 25px; height: 25px; padding: 0; font-size: 10.5px; display: inline-flex; align-items: center; justify-content: center;">' +
                '<i class="fa-solid ' + (doc.isLink ? 'fa-arrow-up-right-from-square' : 'fa-download') + '"></i>' +
              '</a>' +
              '<button type="button" class="btn btn-sm btn-outline-danger btn-delete-doc-file" data-raw="' + encodeURIComponent(f) + '" title="Hapus Dokumen Ini" style="border-radius: 5px; width: 25px; height: 25px; padding: 0; font-size: 10.5px; display: inline-flex; align-items: center; justify-content: center;">' +
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
            '<i class="fa-solid ' + iconClass + ' mr-1"></i> <span class="doc-label">' + total + ' Dokumen</span>' +
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

    // Helper buat baris baru upload berkas / link Google Drive (Urutan: Tipe Sumber -> Nama Dokumen -> Pilih Berkas / Link GDrive)
    function createUploadEntryRow(typeDefault) {
      var isDrive = (typeDefault === 'drive');
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
              '<input type="text" class="form-control file-entry-custom-name" placeholder="' + (isDrive ? 'Judul Dokumen...' : 'Ketik judul/nama...') + '">' +
            '</div>' +
            '<div class="col-md-4 file-input-col" style="padding-left: 4px; padding-right: 4px;' + (isDrive ? ' display:none;' : '') + '">' +
              '<label><i class="fa-solid fa-paperclip mr-1 text-primary"></i> Pilih Berkas:</label>' +
              '<input type="file" class="form-control file-entry-input" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.zip,.rar,.7z">' +
            '</div>' +
            '<div class="col-md-4 drive-input-col" style="padding-left: 4px; padding-right: 4px;' + (!isDrive ? ' display:none;' : '') + '">' +
              '<label><i class="fa-brands fa-google-drive text-success mr-1"></i> Link Google Drive:</label>' +
              '<input type="url" class="form-control file-entry-drive-url" placeholder="https://drive.google.com/...">' +
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

    // Toggle dropdown Tipe Sumber pada baris upload
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

    // Tambah baris dokumen baru (1 tombol)
    $('#BtnAddUploadRow').click(function() {
      $('#UploadRowsContainer').append(createUploadEntryRow('file'));
    });

    // Hapus baris berkas
    $(document).on('click', '.btn-remove-upload-entry-row', function(e) {
      e.preventDefault();
      if ($('.upload-file-entry-row').length > 1) {
        $(this).closest('.upload-file-entry-row').remove();
      } else {
        var $row = $(this).closest('.upload-file-entry-row');
        $row.find('.file-entry-input').val('');
        $row.find('.file-entry-drive-url').val('');
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
      $('#UploadRowsContainer').empty().append(createUploadEntryRow('file'));

      // Set Header
      $('#ModalKelolaDocTitle').text('Kelola Dokumen ' + (type === 'Admin' ? 'Admin' : 'Project'));
      $('#ModalKelolaDocTypeBadge').text(type === 'Admin' ? 'Admin' : 'Project');
      $('#ModalKelolaDocProjectName').text('Project: ' + projectName);

      if (type === 'Admin') {
        $('#ModalKelolaDocHeader').css('background', 'linear-gradient(135deg, #043168 0%, #0284c7 100%)');
        $('#ModalKelolaDocHeaderIcon').html('<i class="fa-solid fa-folder-open text-white" style="font-size: 18px;"></i>');
        $('#BtnSubmitUploadDoc').removeClass('btn-success').addClass('btn-primary');
      } else {
        $('#ModalKelolaDocHeader').css('background', 'linear-gradient(135deg, #064e3b 0%, #059669 100%)');
        $('#ModalKelolaDocHeaderIcon').html('<i class="fa-solid fa-folder-tree text-white" style="font-size: 18px;"></i>');
        $('#BtnSubmitUploadDoc').removeClass('btn-primary').addClass('btn-success');
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

    // Upload berkas baru / Tautan Google Drive
    $('#BtnSubmitUploadDoc').click(function() {
      var fd = new FormData();
      fd.append('Id', activeManageProjectId);
      fd.append('Type', activeManageDocType);

      var validCount = 0;

      $('.upload-file-entry-row').each(function() {
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
        alert('Silakan pilih minimal 1 berkas file atau tempel tautan Google Drive!');
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
          $('#UploadRowsContainer').empty().append(createUploadEntryRow('file'));

          try {
            var data = typeof res === 'object' ? res : JSON.parse(res);
            if (data.status === 'success') {
              activeManageFiles = data.files || [];
              renderManageDocList();
              updateTableCellButton(activeManageProjectId, activeManageDocType, activeManageFiles.length);
            } else {
              alert(data.message || 'Gagal menyimpan dokumen!');
            }
          } catch(e) {
            alert('Respon server tidak valid');
          }
        },
        error: function() {
          $('#BtnSubmitUploadDoc').prop('disabled', false);
          $('#UploadDocProgress').hide();
          alert('Terjadi kesalahan sistem saat mengunggah dokumen!');
        }
      });
    });

    // Hapus berkas dari dalam Modal Kelola Dokumen
    $(document).on('click', '.btn-delete-doc-file', function(e) {
      e.preventDefault();
      var rawItem = decodeURIComponent($(this).data('raw'));
      var doc = parseDocItem(rawItem);
      if (!confirm('Apakah Anda yakin ingin menghapus dokumen "' + doc.name + '"?')) {
        return;
      }

      var $btn = $(this);
      $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');

      $.post(BaseURL + 'Staf/HapusDokumenItem', {
        Id: activeManageProjectId,
        Type: activeManageDocType,
        FileName: rawItem
      }, function(res) {
        try {
          var data = typeof res === 'object' ? res : JSON.parse(res);
          if (data.status === 'success') {
            activeManageFiles = data.files || [];
            renderManageDocList();
            updateTableCellButton(activeManageProjectId, activeManageDocType, activeManageFiles.length);
          } else {
            alert(data.message || 'Gagal menghapus dokumen!');
            $btn.prop('disabled', false).html('<i class="fa-solid fa-trash-can"></i>');
          }
        } catch(e) {
          alert('Terjadi kesalahan saat menghapus dokumen');
          $btn.prop('disabled', false).html('<i class="fa-solid fa-trash-can"></i>');
        }
      });
    });

    // Klik tombol Edit pada item berkas / tautan Google Drive
    $(document).on('click', '.btn-edit-doc-item', function(e) {
      e.preventDefault();
      var rawItem = decodeURIComponent($(this).data('raw'));
      var doc = parseDocItem(rawItem);
      var iconHtml = getFileExtensionIcon(rawItem);

      $('#EditDocOldFileName').val(rawItem);
      $('#EditDocIsDrive').val(doc.isLink ? '1' : '0');
      $('#EditDocCurrentName').text(doc.name).attr('title', doc.name);
      $('#EditDocCurrentIcon').html(iconHtml);
      $('#EditDocNewNameInput').val(doc.name);

      if (doc.isLink) {
        $('#EditDocDriveUrlContainer').show();
        $('#EditDocDriveUrlInput').val(doc.url);
        $('#EditDocReplaceFileContainer').hide();
      } else {
        $('#EditDocDriveUrlContainer').hide();
        $('#EditDocReplaceFileContainer').show();
        $('#EditDocReplaceFileInput').val('');
      }

      $('#EditDocProgress').hide();
      $('#BtnSaveEditDocItem').prop('disabled', false);

      $('#ModalEditDokumenItem').modal('show');
    });

    // Submit simpan edit berkas / tautan
    $('#BtnSaveEditDocItem').click(function() {
      var oldRawItem = $('#EditDocOldFileName').val();
      var isDrive = $('#EditDocIsDrive').val() === '1';
      var newName = $('#EditDocNewNameInput').val().trim();
      var newDriveUrl = $('#EditDocDriveUrlInput').val().trim();
      var replaceFileInput = document.getElementById('EditDocReplaceFileInput');
      var hasReplaceFile = replaceFileInput && replaceFileInput.files && replaceFileInput.files.length > 0;

      if (isDrive && newDriveUrl === '') {
        alert('Silakan masukkan link Google Drive yang valid!');
        return;
      }

      if (!isDrive && newName === '' && !hasReplaceFile) {
        alert('Silakan masukkan nama dokumen baru atau pilih file pengganti!');
        return;
      }

      var fd = new FormData();
      fd.append('Id', activeManageProjectId);
      fd.append('Type', activeManageDocType);
      fd.append('OldFileName', oldRawItem);
      fd.append('NewFileName', newName);

      if (isDrive) {
        fd.append('NewDriveUrl', newDriveUrl);
      } else if (hasReplaceFile) {
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
              alert(data.message || 'Gagal memperbarui dokumen!');
            }
          } catch(e) {
            alert('Respon server tidak valid');
          }
        },
        error: function() {
          $('#BtnSaveEditDocItem').prop('disabled', false);
          $('#EditDocProgress').hide();
          alert('Terjadi kesalahan sistem saat menyimpan perubahan dokumen!');
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
        var doc = parseDocItem(f);
        var iconHtml = getFileExtensionIcon(f);
        var displayName = doc.name.length > 32 ? doc.name.substring(0, 29) + '...' : doc.name;

        tabsHtml += 
          '<button type="button" class="doc-slide-tab ' + (i === startIdx ? 'active' : '') + '" data-index="' + i + '" title="' + doc.name + '">' +
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
     
    // Reset Modal Input saat dibuka agar PIC dan field lainnya bersih
    $('#ModalInput').on('show.bs.modal', function() {
      $('#NamaProject').val('');
      $('#PIC').val('');
      $('#Tag').val('');
      $('#Instansi').val('');
      $('#JenisPengadaan').val('');
      $('#Nominal').val('');
      $('#Status').val('Belum Mulai');
      $('#OutputKegiatan').val('');
      $('#LoadingInput').hide();
      $('#Input').prop('disabled', false);
    });

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
        Status: $("#Status").val() || 'Belum Mulai',
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
      var status = $(this).data('status');
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
      $("#EditStatus").val(status || 'Belum Mulai');
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
        Status: $("#EditStatus").val() || 'Belum Mulai',
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
    // HAPUS ACTION AJAX (SOFT DELETE)
    // =========================================================================
    $(document).on("click", ".Hapus", function(){
      if (!confirm("Apakah Anda yakin ingin menghapus data project ini?")) {
        return;
      }

      var id = $(this).data('id');
      var Hapus = { Id: id };
      
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