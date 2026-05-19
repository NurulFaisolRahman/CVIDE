<?php
// ============================================================
// FILE: smb_dashboard_data.php
// MENU DATA - Portal Satu Data Banyuwangi
// ============================================================

if (!$this->session->userdata('smb_logged_in')) {
    redirect('IDE/SmbLoginPage');
    exit();
}

// Ambil data user dari session
$user_id = $this->session->userdata('user_id');
$username = $this->session->userdata('username');
$nama_lengkap = $this->session->userdata('nama_lengkap');
$level = $this->session->userdata('level');

$display_name = !empty($nama_lengkap) ? $nama_lengkap : $username;

$role_name = '';
if ($level == 1) $role_name = 'Super Admin';
elseif ($level == 2) $role_name = 'Kepala Bappeda';
elseif ($level == 3) $role_name = 'Kepala Bidang';
elseif ($level == 4) $role_name = 'Staff';
else $role_name = 'User';

$initial = strtoupper(substr($display_name, 0, 2));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SMB Bappeda — Data Indikator</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<style>
:root {
  --sidebar-w: 230px;
  --topbar-h: 56px;
  --navy-700: #1a2d6b;
  --blue-600: #2f52c4;
  --blue-500: #3b65d4;
  --surface: #ffffff;
  --page-bg: #f0f3fa;
  --border: rgba(0,0,0,0.07);
  --text-1: #0f172a;
  --text-2: #475569;
  --text-3: #94a3b8;
  --green: #16a34a;
  --green-bg: #dcfce7;
  --red: #dc2626;
  --amber: #d97706;
  --radius: 10px;
  --radius-lg: 14px;
  --radius-xl: 18px;
  --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
  --font-main: 'Plus Jakarta Sans', sans-serif;
  --font-body: 'DM Sans', sans-serif;
  --transition: all 0.18s cubic-bezier(0.4,0,0.2,1);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { font-size: 14px; }
body {
  font-family: var(--font-body);
  background: var(--page-bg);
  color: var(--text-1);
  line-height: 1.5;
  overflow: hidden;
  height: 100vh;
}
button { cursor: pointer; font-family: inherit; }
input, select, textarea { font-family: inherit; }
a { text-decoration: none; color: inherit; }

::-webkit-scrollbar { width: 5px; height: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.15); border-radius: 99px; }

.app-layout { display: flex; height: 100vh; overflow: hidden; }

/* SIDEBAR */
.sidebar {
  width: var(--sidebar-w);
  background: var(--navy-700);
  display: flex;
  flex-direction: column;
  flex-shrink: 0;
  overflow: hidden;
  z-index: 100;
}
.sidebar-brand {
  padding: 18px 16px 14px;
  border-bottom: 1px solid rgba(255,255,255,0.07);
  display: flex;
  align-items: center;
  gap: 10px;
}
.brand-logo {
  width: 34px; height: 34px;
  background: rgba(255,255,255,0.12);
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.brand-logo svg { width: 18px; height: 18px; }
.brand-name {
  font-family: var(--font-main);
  font-size: 13px;
  font-weight: 700;
  color: #fff;
}
.brand-sub {
  font-size: 10.5px;
  color: rgba(255,255,255,0.45);
}
.sidebar-nav {
  flex: 1;
  overflow-y: auto;
  padding: 8px 0;
}
.nav-section {
  font-size: 9.5px;
  font-weight: 600;
  letter-spacing: 0.09em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.3);
  padding: 12px 16px 4px;
}
.nav-item {
  display: flex;
  align-items: center;
  gap: 9px;
  padding: 7px 10px 7px 14px;
  font-size: 12.5px;
  color: rgba(255,255,255,0.72);
  cursor: pointer;
  border-radius: 6px;
  margin: 1px 8px;
  transition: var(--transition);
}
.nav-item:hover { background: rgba(255,255,255,0.08); color: #fff; }
.nav-item.active {
  background: rgba(47,82,196,0.7);
  color: #fff;
  box-shadow: 0 2px 8px rgba(47,82,196,0.35);
}
.sub-menu { display: none; }
.sub-menu.open { display: block; }
.sub-item {
  display: flex;
  align-items: center;
  gap: 7px;
  font-size: 12px;
  color: rgba(255,255,255,0.55);
  padding: 5px 10px 5px 16px;
  margin: 1px 8px 1px 24px;
  cursor: pointer;
  border-radius: 6px;
}
.sub-item:hover { background: rgba(255,255,255,0.07); color: rgba(255,255,255,0.85); }
.sub-item.active { color: #7eb3ff; }
.sidebar-footer {
  padding: 10px 8px 14px;
  border-top: 1px solid rgba(255,255,255,0.07);
}
.user-mini {
  display: flex;
  align-items: center;
  gap: 9px;
  padding: 8px 10px;
  border-radius: 6px;
  cursor: pointer;
}
.user-mini:hover { background: rgba(255,255,255,0.07); }
.avatar-sm {
  width: 30px; height: 30px;
  border-radius: 50%;
  background: var(--blue-500);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 600;
  color: #fff;
}
.user-mini-name { font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.9); }
.user-mini-role { font-size: 10px; color: rgba(255,255,255,0.4); }
.logout-btn {
  display: flex;
  align-items: center;
  gap: 9px;
  padding: 7px 10px;
  font-size: 12.5px;
  color: #f87171;
  cursor: pointer;
  border-radius: 6px;
  margin-top: 2px;
}
.logout-btn:hover { background: rgba(248,113,113,0.1); }

/* MAIN AREA */
.main-area { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
.topbar {
  height: 56px;
  background: var(--surface);
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  padding: 0 22px;
  gap: 12px;
  flex-shrink: 0;
}
.search-wrap {
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--page-bg);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 0 12px;
  height: 34px;
}
.search-wrap:focus-within { border-color: var(--blue-500); background: #fff; }
.search-wrap svg { width: 14px; height: 14px; color: var(--text-3); }
.search-wrap input {
  border: none;
  background: transparent;
  font-size: 12.5px;
  outline: none;
  width: 190px;
}
.topbar-spacer { flex: 1; }
.topbar-actions { display: flex; align-items: center; gap: 6px; }
.topbar-user {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 0 4px 0 6px;
  height: 34px;
  border-radius: 8px;
  cursor: pointer;
}
.topbar-user:hover { background: var(--page-bg); }
.topbar-avatar {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: var(--blue-600);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 10.5px;
  font-weight: 700;
  color: #fff;
}
.topbar-uname { font-size: 12.5px; font-weight: 500; }
.topbar-urole { font-size: 10.5px; color: var(--text-3); }

.page-content { flex: 1; overflow-y: auto; padding: 22px 24px 30px; }
.panel { display: none; animation: fadeIn 0.2s ease; }
.panel.active { display: block; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(4px); } to { opacity: 1; transform: none; } }

.page-hdr {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 18px;
}
.page-hdr-left { display: flex; align-items: center; gap: 12px; }
.page-hdr-icon {
  width: 38px; height: 38px;
  background: var(--blue-50);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.page-hdr-icon svg { width: 18px; height: 18px; color: var(--blue-600); }
.page-hdr-title { font-family: var(--font-main); font-size: 17px; font-weight: 700; }
.page-hdr-sub { font-size: 12px; color: var(--text-2); margin-top: 1px; }
.badge-role {
  background: #eff4ff;
  color: var(--blue-600);
  font-size: 11px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 20px;
}

.stat-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
  margin-bottom: 20px;
}
.stat-card {
  background: var(--surface);
  border-radius: var(--radius-lg);
  padding: 16px 18px;
  border: 1px solid var(--border);
  box-shadow: var(--shadow-sm);
  transition: var(--transition);
}
.stat-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.07); transform: translateY(-1px); }
.stat-row { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 10px; }
.stat-label { font-size: 11.5px; color: var(--text-2); font-weight: 500; margin-bottom: 5px; }
.stat-val {
  font-family: var(--font-main);
  font-size: 26px;
  font-weight: 700;
  color: var(--text-1);
}
.stat-icon {
  width: 40px; height: 40px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.stat-divider { height: 1px; background: var(--border); margin-bottom: 10px; }
.stat-trend { font-size: 11.5px; display: flex; align-items: center; gap: 5px; }
.trend-up { color: var(--green); }
.trend-down { color: var(--red); }

.card {
  background: var(--surface);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  box-shadow: var(--shadow-sm);
  overflow: hidden;
}
.card-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 18px;
  border-bottom: 1px solid var(--border);
}
.card-title { font-size: 13.5px; font-weight: 600; font-family: var(--font-main); }
.card-action { font-size: 11.5px; color: var(--blue-600); cursor: pointer; font-weight: 500; }
.card-body { padding: 12px 18px; }

.tbl {
  width: 100%;
  border-collapse: collapse;
  font-size: 12.5px;
}
.tbl th {
  text-align: left;
  padding: 12px 16px;
  font-size: 11px;
  font-weight: 600;
  color: var(--text-2);
  background: #f8f9fd;
  border-bottom: 1px solid var(--border);
  text-transform: uppercase;
}
.tbl td {
  padding: 14px 16px;
  border-bottom: 1px solid var(--border);
  vertical-align: middle;
}
.tbl tr:last-child td { border-bottom: none; }
.tbl tbody tr:hover { background: #f8f9fd; }

.table-responsive { overflow-x: auto; }

.btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-family: inherit;
  font-size: 12.5px;
  font-weight: 500;
  padding: 7px 14px;
  border-radius: 8px;
  border: 1px solid var(--border);
  background: var(--surface);
  color: var(--text-1);
  cursor: pointer;
  transition: var(--transition);
}
.btn:hover { background: var(--page-bg); }
.btn-primary {
  background: var(--blue-600);
  color: #fff;
  border-color: var(--blue-600);
}
.btn-primary:hover { background: var(--blue-500); }
.btn-sm { padding: 5px 11px; font-size: 12px; }

.pill {
  font-size: 10.5px;
  font-weight: 600;
  padding: 2px 9px;
  border-radius: 99px;
  display: inline-block;
}
.pill-review { background: #dbeafe; color: #1d4ed8; }

.form-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 15px; }
.form-label { font-size: 11.5px; font-weight: 600; color: var(--text-2); }
.form-control {
  height: 36px;
  padding: 0 11px;
  border: 1px solid var(--border);
  border-radius: 8px;
  font-size: 12.5px;
  background: var(--surface);
  outline: none;
}
.form-control:focus { border-color: var(--blue-500); box-shadow: 0 0 0 3px rgba(47,82,196,0.08); }
.form-actions { display: flex; gap: 8px; margin-top: 15px; }

.modern-spinner {
  width: 30px;
  height: 30px;
  border: 3px solid #e2e8f0;
  border-top-color: #3b82f6;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
  margin: 0 auto 10px;
}
@keyframes spin { to { transform: rotate(360deg); } }

.empty-state {
  padding: 48px 20px;
  text-align: center;
  color: var(--text-3);
}
.empty-state p { font-size: 13px; color: var(--text-2); }

@media (max-width: 900px) {
  .stat-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
  .sidebar { width: 200px; }
}
</style>
</head>
<body>

<div class="app-layout">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="brand-logo">
        <svg viewBox="0 0 20 20" fill="none">
          <rect x="2" y="2" width="7" height="7" rx="1.5" fill="rgba(255,255,255,0.9)"/>
          <rect x="11" y="2" width="7" height="7" rx="1.5" fill="rgba(255,255,255,0.55)"/>
          <rect x="2" y="11" width="7" height="7" rx="1.5" fill="rgba(255,255,255,0.55)"/>
          <rect x="11" y="11" width="7" height="7" rx="1.5" fill="rgba(255,255,255,0.3)"/>
        </svg>
      </div>
      <div class="brand-text">
        <div class="brand-name">SMB Bappeda</div>
        <div class="brand-sub">Sistem Manajemen Kantor</div>
      </div>
    </div>

    <nav class="sidebar-nav">
      <div class="nav-section">Menu Utama</div>
      <div class="nav-item" data-panel="dashboard" onclick="navigate(this)">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor"><path d="M2 11h7V2H2v9zm0 7h7v-5H2v5zm9 0h7v-9h-7v9zm0-16v5h7V2h-7z"/></svg>
        Dashboard
      </div>

      <div class="nav-section">Menu Bidang</div>

      <!-- Bidang Litbang -->
      <div class="nav-item" id="nav-ba" onclick="toggleBidang('a')">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
        </svg>
        Bidang Litbang
        <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
      </div>
      <div class="sub-menu" id="sub-ba">
        <div class="sub-item" onclick="navigateDok('a')">Dokumen</div>
        <div class="sub-item" onclick="navigateToData()">📊 Data</div>
        <div class="sub-item" onclick="navigateComingSoon()">E-Perencanaan</div>
        <div class="sub-item" onclick="navigateComingSoon()">E-Monev</div>
      </div>

      <!-- Bidang Perencanaan -->
      <div class="nav-item" id="nav-bb" onclick="toggleBidang('b')">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
        Bidang Perencanaan
        <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
      </div>
      <div class="sub-menu" id="sub-bb">
        <div class="sub-item" onclick="navigateDok('b')">Dokumen</div>
      </div>

      <!-- Bidang Ekonomi -->
      <div class="nav-item" id="nav-bc" onclick="toggleBidang('c')">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
        Bidang Ekonomi
        <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
      </div>
      <div class="sub-menu" id="sub-bc">
        <div class="sub-item" onclick="navigateDok('c')">Dokumen</div>
      </div>

      <!-- Bidang Kesra -->
      <div class="nav-item" id="nav-bd" onclick="toggleBidang('d')">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
        Bidang Kesra
        <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
      </div>
      <div class="sub-menu" id="sub-bd">
        <div class="sub-item" onclick="navigateDok('d')">Dokumen</div>
      </div>

      <!-- Bidang Sarpras -->
      <div class="nav-item" id="nav-be" onclick="toggleBidang('e')">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
        Bidang Sarpras
        <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
      </div>
      <div class="sub-menu" id="sub-be">
        <div class="sub-item" onclick="navigateDok('e')">Dokumen</div>
      </div>

      <!-- Bidang Sekretariat -->
      <div class="nav-item" id="nav-bf" onclick="toggleBidang('f')">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
        Bidang Sekretariat
        <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
      </div>
      <div class="sub-menu" id="sub-bf">
        <div class="sub-item" onclick="navigateDok('f')">Dokumen</div>
      </div>

      <div class="nav-section">Aktivitas</div>
      <div class="nav-item" data-panel="log" onclick="navigate(this)">Log Aktivitas</div>
      <div class="nav-item" data-panel="laporan" onclick="navigate(this)">Print Laporan</div>

      <div class="nav-section">App Lainnya</div>
      <div class="nav-item" data-panel="satu-data" onclick="navigate(this)">Satu Data</div>
      <div class="nav-item" data-panel="eklpi" onclick="navigate(this)">E-SAKIP</div>
      <div class="nav-item" data-panel="sipd" onclick="navigate(this)">SIPD</div>

      <div class="nav-section">Sistem</div>
      <div class="nav-item" data-panel="settings" onclick="navigate(this)">Settings</div>
    </nav>

    <div class="sidebar-footer">
      <div class="user-mini">
        <div class="avatar-sm"><?= $initial ?></div>
        <div class="user-mini-info">
          <div class="user-mini-name"><?= htmlspecialchars($display_name) ?></div>
          <div class="user-mini-role"><?= $role_name ?></div>
        </div>
      </div>
      <div class="logout-btn">
        <svg viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"/>
        </svg>
        Logout
      </div>
    </div>
  </aside>

  <!-- MAIN AREA -->
  <div class="main-area">

    <!-- TOPBAR -->
    <header class="topbar">
      <div class="search-wrap">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6">
          <circle cx="6.5" cy="6.5" r="4.5"/>
          <path d="M11 11l3 3"/>
        </svg>
        <input type="text" placeholder="Cari...">
      </div>
      <div class="topbar-spacer"></div>
      <div class="topbar-actions">
        <div class="topbar-user">
          <div class="topbar-avatar"><?= $initial ?></div>
          <div>
            <div class="topbar-uname"><?= htmlspecialchars($display_name) ?></div>
            <div class="topbar-urole"><?= $role_name ?></div>
          </div>
        </div>
      </div>
    </header>

    <!-- PAGE CONTENT -->
    <main class="page-content">

      <!-- DASHBOARD PANEL (minimal) -->
      <section id="panel-dashboard" class="panel active">
        <div class="page-hdr">
          <div>
            <div style="font-size:12px; color:var(--text-2);" id="greeting-date"></div>
            <div style="font-family:var(--font-main); font-size:18px; font-weight:700;">
              Selamat Datang, <span style="color:var(--blue-600);"><?= htmlspecialchars($display_name) ?></span>!
            </div>
          </div>
          <span class="badge-role"><?= $role_name ?></span>
        </div>
        <div class="hero-banner" style="background: var(--navy-700); border-radius: var(--radius-xl); padding: 26px 28px;">
          <div class="hero-left">
            <div class="hero-eyebrow" style="font-size:11px; color:rgba(255,255,255,0.5);">Sistem Manajemen Kantor</div>
            <div class="hero-title" style="font-size:20px; font-weight:700; color:#fff;">Bappeda Kabupaten Banyuwangi</div>
            <div class="hero-sub" style="font-size:13px; color:rgba(255,255,255,0.6);">Selamat bekerja!</div>
          </div>
        </div>
      </section>

      <!-- BIDANG PANEL (dokumen) -->
      <section id="panel-bidang" class="panel">
        <div class="page-hdr">
          <div class="page-hdr-left">
            <div class="page-hdr-icon">
              <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
            </div>
            <div>
              <div class="page-hdr-title" id="bidang-title">Bidang</div>
              <div class="page-hdr-sub" id="bidang-subtitle">Manajemen Dokumen</div>
            </div>
          </div>
          <button class="btn btn-primary" onclick="openUploadModal()">Upload Dokumen</button>
        </div>
        <div class="card">
          <div class="table-responsive">
            <table class="tbl">
              <thead><tr><th>No</th><th>Preview</th><th>Nama Dokumen</th><th>Kategori</th><th>Tanggal</th><th>Uploader</th><th>Status</th><th>Aksi</th></tr></thead>
              <tbody id="bidang-tbody"><tr><td colspan="8" class="empty-state-table">Pilih bidang dari menu sidebar</td></tr></tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ==================== DATA PANEL ==================== -->
      <section id="panel-data" class="panel">
        <div class="page-hdr">
          <div class="page-hdr-left">
            <div class="page-hdr-icon">
              <svg viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
              </svg>
            </div>
            <div>
              <div class="page-hdr-title" id="data-title">Data Indikator</div>
              <div class="page-hdr-sub" id="data-subtitle">Portal Satu Data Banyuwangi</div>
            </div>
          </div>
          <div>
            <button class="btn btn-sm" onclick="loadDataFromAPI()" style="margin-right:8px;">
              <i class="fas fa-sync-alt"></i> Refresh
            </button>
          </div>
        </div>

        <!-- Informasi Sumber Data -->
        <div class="card mb-4">
          <div class="card-body" style="background: linear-gradient(135deg, #e8f0fe 0%, #d4e2fc 100%);">
            <div class="row align-items-center">
              <div class="col-md-8">
                <div class="d-flex align-items-center gap-3">
                  <div style="font-size: 36px;">📊</div>
                  <div>
                    <h5 class="mb-1" id="data-indikator-name">Hibah</h5>
                    <p class="mb-0 text-muted small">Sumber: <span id="produsen-data">Badan Pendapatan Daerah</span> | Urusan: <span id="urusan-data">Pendapatan Daerah</span></p>
                    <p class="mb-0 text-muted small">Satuan: <span id="satuan-data">Rp Milyar</span></p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 text-end">
                <a href="https://satudata.banyuwangikab.go.id/" target="_blank" class="btn btn-outline-primary btn-sm">
                  <i class="bi bi-box-arrow-up-right"></i> Portal Satu Data
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Statistik Ringkas -->
        <div class="stat-grid mb-4">
          <div class="stat-card">
            <div class="stat-label">Total Data</div>
            <div class="stat-row">
              <div class="stat-val" id="stat-total-data">0</div>
              <div class="stat-icon" style="background:#eff4ff;">
                <svg viewBox="0 0 20 20" fill="#2f52c4"><path d="M3 3h14v14H3z"/></svg>
              </div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend">Tahun tersedia</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Nilai Tertinggi</div>
            <div class="stat-row">
              <div class="stat-val" id="stat-nilai-tertinggi">0</div>
              <div class="stat-icon" style="background:#fffbeb;">
                <svg viewBox="0 0 20 20" fill="#d97706"><path d="M10 2l3 5 5 1-4 4 1 5-5-2-5 2 1-5-4-4 5-1 3-5z"/></svg>
              </div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend trend-up" id="stat-tahun-tertinggi">-</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Nilai Terendah</div>
            <div class="stat-row">
              <div class="stat-val" id="stat-nilai-terendah">0</div>
              <div class="stat-icon" style="background:#dcfce7;">
                <svg viewBox="0 0 20 20" fill="#16a34a"><path d="M10 2l3 5 5 1-4 4 1 5-5-2-5 2 1-5-4-4 5-1 3-5z"/></svg>
              </div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend trend-down" id="stat-tahun-terendah">-</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Rata-rata</div>
            <div class="stat-row">
              <div class="stat-val" id="stat-rata-rata">0</div>
              <div class="stat-icon" style="background:#dbeafe;">
                <svg viewBox="0 0 20 20" fill="#2f52c4"><path d="M10 2v16M4 6l6-4 6 4M4 14l6 4 6-4"/></svg>
              </div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend">periode 2019-2024</div>
          </div>
        </div>

        <!-- Tabel Data -->
        <div class="card mb-4">
          <div class="card-head">
            <div class="card-title"><i class="fas fa-table"></i> Data Per Tahun</div>
            <div class="table-toolbar-right">
              <div class="mini-search">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" width="12" height="12">
                  <circle cx="5.5" cy="5.5" r="4"/><path d="M9 9l2.5 2.5"/>
                </svg>
                <input type="text" id="data-search" placeholder="Cari tahun..." oninput="filterDataTable()" style="width: 130px;">
              </div>
              <button class="btn btn-sm" onclick="exportDataToExcel()"><i class="fas fa-file-excel"></i> Excel</button>
              <button class="btn btn-sm" onclick="exportDataToPDF()"><i class="fas fa-file-pdf"></i> PDF</button>
            </div>
          </div>
          <div class="table-responsive">
            <table class="tbl" id="data-table">
              <thead><tr><th>Tahun</th><th>Nilai (Rp Milyar)</th><th>Trend</th><th>Aksi</th></tr></thead>
              <tbody id="data-tbody"><tr><td colspan="4" class="text-center"><div class="modern-spinner"></div><p>Memuat data...</p></td></tr></tbody>
            </table>
          </div>
        </div>

        <!-- Grafik Data -->
        <div class="card mb-4">
          <div class="card-head">
            <div class="card-title"><i class="fas fa-chart-line"></i> Grafik Tren Data</div>
            <select id="chart-type" class="sel-filter" onchange="renderChart()" style="width: 120px;">
              <option value="line">📈 Line Chart</option>
              <option value="bar">📊 Bar Chart</option>
            </select>
          </div>
          <div class="card-body">
            <canvas id="data-chart" style="width:100%; height:350px;"></canvas>
          </div>
        </div>

        <!-- Analisis Proyeksi -->
        <div class="card">
          <div class="card-head">
            <div class="card-title"><i class="fas fa-chart-simple"></i> Analisis & Proyeksi 2025-2030</div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Metode Proyeksi</label>
                  <select id="proyeksi-metode" class="form-control" onchange="updateProyeksi()">
                    <option value="linear">Linear (Trend Linear)</option>
                    <option value="moving-average">Moving Average</option>
                    <option value="exponential">Exponential Smoothing</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Parameter</label>
                  <input type="number" id="proyeksi-param" class="form-control" step="0.1" value="0.3" onchange="updateProyeksi()">
                  <small class="text-muted">Alpha untuk Exponential (0-1)</small>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Tahun Proyeksi</label>
                  <input type="text" class="form-control" value="2025 - 2030" disabled>
                </div>
              </div>
            </div>

            <div class="table-responsive mt-3">
              <table class="tbl">
                <thead><tr><th>Tahun</th><th>Nilai Proyeksi (Rp Milyar)</th><th>Keterangan</th></tr></thead>
                <tbody id="proyeksi-tbody"><tr><td colspan="3" class="text-center">Pilih metode proyeksi</td></tr></tbody>
              </table>
            </div>

            <div class="form-actions">
              <button class="btn btn-primary" onclick="simpanAnalisis()"><i class="fas fa-save"></i> Simpan Analisis</button>
              <button class="btn" onclick="updateProyeksi()"><i class="fas fa-calculator"></i> Hitung Ulang</button>
              <button class="btn" onclick="exportAnalisisToPDF()"><i class="fas fa-file-pdf"></i> Export PDF</button>
            </div>

            <!-- Riwayat Analisis -->
            <div class="mt-4">
              <div class="card-head" style="border-top: 1px solid var(--border); padding-top: 15px;">
                <div class="card-title"><i class="fas fa-history"></i> Riwayat Analisis Tersimpan</div>
                <span class="card-action" onclick="loadRiwayatAnalisis()">Refresh</span>
              </div>
              <div id="riwayat-analisis-list" style="padding: 15px;">
                <div class="empty-state"><p>Belum ada analisis tersimpan</p></div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- PANEL LAINNYA (minimal) -->
      <section id="panel-log" class="panel"><div class="page-hdr"><div class="page-hdr-left"><div class="page-hdr-icon"><svg viewBox="0 0 20 20" fill="currentColor"><path d="M10 18a8 8 0 100-16 8 8 0 000 16z"/></svg></div><div><div class="page-hdr-title">Log Aktivitas</div></div></div></div></section>
      <section id="panel-laporan" class="panel"><div class="page-hdr"><div class="page-hdr-left"><div class="page-hdr-icon"><svg viewBox="0 0 20 20" fill="currentColor"><path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6z"/></svg></div><div><div class="page-hdr-title">Print Laporan</div></div></div></div></section>
      <section id="panel-satu-data" class="panel"><div class="card"><div class="card-body"><div class="empty-state"><p>Modul Satu Data</p></div></div></div></section>
      <section id="panel-eklpi" class="panel"><div class="card"><div class="card-body"><div class="empty-state"><p>E-SAKIP</p></div></div></div></section>
      <section id="panel-sipd" class="panel"><div class="card"><div class="card-body"><div class="empty-state"><p>SIPD</p></div></div></div></section>
      <section id="panel-settings" class="panel"><div class="card"><div class="card-head"><div class="card-title">Pengaturan</div></div><div class="card-body"><p>Halaman pengaturan</p></div></div></section>

    </main>
  </div>
</div>

<!-- MODAL UPLOAD DOKUMEN -->
<div id="modalUpload" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000; align-items:center; justify-content:center;">
  <div style="background:#fff; border-radius:16px; width:500px; max-width:90%; padding:24px;">
    <div style="display:flex; justify-content:space-between; margin-bottom:20px;"><h3>Upload Dokumen</h3><span onclick="closeUploadModal()" style="cursor:pointer;">&times;</span></div>
    <form id="formUploadDokumen" enctype="multipart/form-data">
      <input type="hidden" name="id_bidang" id="upload_id_bidang">
      <div class="form-group"><label class="form-label">Nama Dokumen</label><input type="text" name="nama_dokumen" class="form-control" required></div>
      <div class="form-group"><label class="form-label">Kategori</label><select name="kategori" class="form-control"><option>Surat Keputusan</option><option>Laporan</option><option>Nota Dinas</option></select></div>
      <div class="form-group"><label class="form-label">Status</label><select name="status" class="form-control"><option>Selesai</option><option>Review</option><option>On Going</option></select></div>
      <div class="form-group"><label class="form-label">File</label><input type="file" name="file_dokumen" class="form-control" required></div>
      <div style="display:flex; gap:10px;"><button type="submit" class="btn btn-primary">Upload</button><button type="button" class="btn" onclick="closeUploadModal()">Batal</button></div>
    </form>
  </div>
</div>

<script>
// ==================== GLOBAL VARIABLES ====================
let currentBidang = null;
let currentBidangId = null;
let dataIndikator = null;
let dataSeries = [];
let chartInstance = null;
const DATA_API_URL = 'https://satudata.banyuwangikab.go.id/api/indikator?id=63&api-key=data_bwi2023';
const baseUrl = '<?= base_url() ?>';

// ==================== NAVIGATION ====================
function navigate(el) {
  const panel = el.dataset.panel;
  if (!panel) return;
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  el.classList.add('active');
  showPanel(panel);
}
function showPanel(id) {
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
  const target = document.getElementById('panel-' + id);
  if (target) target.classList.add('active');
  document.querySelector('.page-content').scrollTop = 0;
}

// ==================== BIDANG FUNCTIONS ====================
function toggleBidang(id) {
  const navEl = document.getElementById('nav-b' + id);
  const subEl = document.getElementById('sub-b' + id);
  const isOpen = subEl.classList.contains('open');
  ['a','b','c','d','e','f'].forEach(x => {
    const sub = document.getElementById('sub-b' + x);
    const nav = document.getElementById('nav-b' + x);
    if (sub) sub.classList.remove('open');
    if (nav) nav.classList.remove('open', 'active');
  });
  if (!isOpen) { subEl.classList.add('open'); navEl.classList.add('open', 'active'); }
}
function navigateDok(id) {
  currentBidang = id; currentBidangId = id;
  document.getElementById('bidang-title').textContent = 'Bidang';
  document.getElementById('bidang-doc-title').textContent = 'Daftar Dokumen';
  loadDokumenFromDB(id);
  showPanel('bidang');
  document.querySelectorAll('.nav-item[data-panel]').forEach(n => n.classList.remove('active'));
  document.querySelectorAll('.sub-item').forEach(s => s.classList.remove('active'));
  const subItems = document.querySelectorAll('#sub-b' + id + ' .sub-item');
  if (subItems.length) subItems[0].classList.add('active');
}
function navigateToData() {
  showPanel('data');
  loadDataFromAPI();
  loadRiwayatAnalisis();
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  document.querySelectorAll('.sub-item').forEach(s => s.classList.remove('active'));
  const dataMenuItem = document.querySelector('.sub-item[onclick*="navigateToData"]');
  if (dataMenuItem) dataMenuItem.classList.add('active');
}
function navigateComingSoon() {
  Swal.fire({ icon: 'info', title: 'Coming Soon', text: 'Fitur sedang dalam pengembangan', timer: 2000, showConfirmButton: false });
}
function openUploadModal() {
  if (!currentBidang) { Swal.fire({ icon: 'warning', title: 'Pilih bidang dulu!' }); return; }
  document.getElementById('upload_id_bidang').value = currentBidang;
  document.getElementById('modalUpload').style.display = 'flex';
}
function closeUploadModal() { document.getElementById('modalUpload').style.display = 'none'; }
function loadDokumenFromDB(bidangId) {
  $('#bidang-tbody').html('<tr><td colspan="8"><div class="modern-spinner"></div><p>Memuat...</p></td></tr>');
  $.ajax({ url: baseUrl + 'IDE/get_dokumen_by_bidang', type: 'POST', data: { id_bidang: bidangId }, dataType: 'json', success: function(res) { if(res.status==='success') renderDokumenTable(res.data); else $('#bidang-tbody').html('<tr><td colspan="8">Gagal load</td></tr>'); }, error: function(){ $('#bidang-tbody').html('<tr><td colspan="8">Error server</td></tr>'); } });
}
function renderDokumenTable(dokumen) {
  if(!dokumen || dokumen.length===0){ $('#bidang-tbody').html('<tr><td colspan="8">Belum ada dokumen</td></tr>'); return; }
  $('#bidang-tbody').html(dokumen.map((doc,i)=>`<tr><td>${i+1}</td><td><div style="width:50px;height:50px;background:#dbeafe;border-radius:8px;display:flex;align-items:center;justify-content:center;">📄</div></td><td><strong>${escapeHtml(doc.nama_dokumen)}</strong></td><td>${doc.kategori||'-'}</td><td>${doc.upload_date_formatted||'-'}</td><td>${doc.uploaded_by||'-'}</td><td><span class="pill">${doc.status||'-'}</span></td><td><span class="link-act" style="cursor:pointer;" onclick="previewDokumen(\'${doc.file_path}\',\'${doc.file_type}\',\'${escapeHtml(doc.nama_dokumen)}\')">Lihat</span> <span class="link-danger" style="cursor:pointer;" onclick="deleteDokumen(${doc.id_dokumen})">Hapus</span></td></tr>`).join(''));
}
function previewDokumen(filePath, fileType, fileName) {
  Swal.fire({ title: fileName || 'Preview', html: `<iframe src="${baseUrl}${filePath}" style="width:100%; height:400px;" frameborder="0"></iframe>`, width: '800px', showCloseButton: true });
}
function deleteDokumen(id) {
  Swal.fire({ title: 'Yakin hapus?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#dc2626', confirmButtonText: 'Ya' }).then(result => { if(result.isConfirmed){ $.ajax({ url: baseUrl+'IDE/delete_dokumen', type:'POST', data:{id_dokumen:id}, dataType:'json', success:function(res){ if(res.status==='success'){ Swal.fire('Terhapus!','','success'); loadDokumenFromDB(currentBidangId); } else Swal.fire('Gagal',res.message,'error'); } }); } });
}
function escapeHtml(text) { if(!text) return ''; return text.replace(/[&<>]/g, function(m){ if(m==='&') return '&amp;'; if(m==='<') return '&lt;'; if(m==='>') return '&gt;'; return m; }); }

// ==================== DATA API & ANALISIS ====================
async function loadDataFromAPI() {
  $('#data-tbody').html('<tr><td colspan="4"><div class="modern-spinner"></div><p>Memuat data...</p></td></tr>');
  try {
    const response = await fetch(DATA_API_URL);
    const result = await response.json();
    if (result.result && result.result.status === 200) {
      dataIndikator = result.result;
      $('#data-indikator-name').text(dataIndikator.Indikator || 'Hibah');
      $('#produsen-data').text(dataIndikator['Produsen Data'] || 'Badan Pendapatan Daerah');
      $('#urusan-data').text(dataIndikator.Urusan || 'Pendapatan Daerah');
      $('#satuan-data').text(dataIndikator.Satuan || 'Rp Milyar');
      $('#data-subtitle').text(`${dataIndikator.Indikator} - ${dataIndikator.Satuan}`);
      const rawData = dataIndikator.data[0] || {};
      dataSeries = [];
      for (const [tahun, nilai] of Object.entries(rawData)) {
        if (nilai !== '' && nilai !== null) dataSeries.push({ tahun: parseInt(tahun), nilai: parseFloat(nilai) });
      }
      dataSeries.sort((a, b) => a.tahun - b.tahun);
      renderDataTable();
      updateDataStats();
      renderChart();
      updateProyeksi();
    } else throw new Error('Invalid response');
  } catch (error) {
    $('#data-tbody').html(`<tr><td colspan="4" style="text-align:center;padding:40px;">⚠️ Gagal memuat data<br><button class="btn btn-sm mt-2" onclick="loadDataFromAPI()">Coba Lagi</button></td></tr>`);
  }
}
function renderDataTable() {
  if (!dataSeries || dataSeries.length === 0) { $('#data-tbody').html('<tr><td colspan="4">Tidak ada data</td></tr>'); return; }
  $('#data-tbody').html(dataSeries.map((item, index) => {
    let trendHtml = '-';
    if (index > 0) { const diff = item.nilai - dataSeries[index-1].nilai; const percent = dataSeries[index-1].nilai !== 0 ? (diff / dataSeries[index-1].nilai * 100).toFixed(1) : 0; trendHtml = diff > 0 ? `<span style="color:var(--green);">↑ +${diff.toFixed(2)} (${percent}%)</span>` : diff < 0 ? `<span style="color:var(--red);">↓ ${diff.toFixed(2)} (${percent}%)</span>` : '<span style="color:var(--text-3);">→ 0 (0%)</span>'; }
    return `<tr><td><strong>${item.tahun}</strong></td><td>${formatNumber(item.nilai)}</td><td>${trendHtml}</td><td><button class="btn btn-sm" onclick="editDataTahun(${item.tahun}, ${item.nilai})"><i class="fas fa-edit"></i></button></td></tr>`;
  }).join(''));
}
function updateDataStats() {
  if (!dataSeries || dataSeries.length === 0) return;
  const values = dataSeries.map(d => d.nilai);
  const maxValue = Math.max(...values), minValue = Math.min(...values), avgValue = values.reduce((a,b)=>a+b,0)/values.length;
  const maxYear = dataSeries.find(d=>d.nilai===maxValue)?.tahun || '-';
  const minYear = dataSeries.find(d=>d.nilai===minValue)?.tahun || '-';
  $('#stat-total-data').text(dataSeries.length);
  $('#stat-nilai-tertinggi').text(formatNumber(maxValue));
  $('#stat-tahun-tertinggi').text(maxYear);
  $('#stat-nilai-terendah').text(formatNumber(minValue));
  $('#stat-tahun-terendah').text(minYear);
  $('#stat-rata-rata').text(formatNumber(avgValue));
}
function renderChart() {
  if (!dataSeries || dataSeries.length === 0) return;
  const ctx = document.getElementById('data-chart').getContext('2d');
  const chartType = $('#chart-type').val();
  if (chartInstance) chartInstance.destroy();
  chartInstance = new Chart(ctx, {
    type: chartType,
    data: { labels: dataSeries.map(d=>d.tahun.toString()), datasets: [{ label: dataIndikator?.Indikator || 'Hibah', data: dataSeries.map(d=>d.nilai), backgroundColor: chartType==='line' ? 'rgba(47,82,196,0.1)' : 'rgba(47,82,196,0.7)', borderColor: '#2f52c4', borderWidth: 2, fill: chartType==='line', tension: 0.3, pointBackgroundColor: '#2f52c4', pointBorderColor: '#fff', pointRadius: 4 }] },
    options: { responsive: true, maintainAspectRatio: true, plugins: { tooltip: { callbacks: { label: (ctx) => `${ctx.dataset.label}: ${formatNumber(ctx.raw)} ${dataIndikator?.Satuan || 'Rp Milyar'}` } } }, scales: { y: { beginAtZero: true, title: { display: true, text: dataIndikator?.Satuan || 'Rp Milyar' } }, x: { title: { display: true, text: 'Tahun' } } } }
  });
}
function formatNumber(num) { if (num === undefined || num === null) return '0'; return num.toLocaleString('id-ID'); }
function filterDataTable() {
  const search = $('#data-search').val().toLowerCase();
  if (!search) { renderDataTable(); return; }
  const filtered = dataSeries.filter(d => d.tahun.toString().includes(search));
  if (filtered.length===0) $('#data-tbody').html('<tr><td colspan="4">Tidak ditemukan</td></tr>');
  else $('#data-tbody').html(filtered.map((item,i)=>{ let trend='-'; if(i>0&&dataSeries.findIndex(d=>d.tahun===item.tahun)>0){ const prev=dataSeries[dataSeries.findIndex(d=>d.tahun===item.tahun)-1]; if(prev){ const diff=item.nilai-prev.nilai; trend=diff>0?`↑ +${diff.toFixed(2)}`:diff<0?`↓ ${diff.toFixed(2)}`:'→ 0'; } } return `<tr><td><strong>${item.tahun}</strong></td><td>${formatNumber(item.nilai)}</td><td>${trend}</td><td><button class="btn btn-sm" onclick="editDataTahun(${item.tahun}, ${item.nilai})"><i class="fas fa-edit"></i></button></td></tr>`; }).join(''));
}
function editDataTahun(tahun, nilai) {
  Swal.fire({ title: `Edit Data ${tahun}`, html: `<input type="number" id="edit-nilai" class="form-control" value="${nilai}" step="0.01">`, showCancelButton: true, confirmButtonText: 'Simpan', preConfirm: () => { const newVal = parseFloat(document.getElementById('edit-nilai').value); if(isNaN(newVal)) Swal.showValidationMessage('Masukkan angka valid'); return { tahun, nilai: newVal }; } }).then(result => { if(result.isConfirmed){ const idx = dataSeries.findIndex(d=>d.tahun===result.value.tahun); if(idx!==-1){ dataSeries[idx].nilai = result.value.nilai; renderDataTable(); updateDataStats(); renderChart(); updateProyeksi(); Swal.fire('Berhasil!','Data diperbarui','success'); } } });
}
function updateProyeksi() {
  if (!dataSeries || dataSeries.length < 2) { $('#proyeksi-tbody').html('<tr><td colspan="3">Data tidak cukup</td></tr>'); return; }
  const metode = $('#proyeksi-metode').val();
  const param = parseFloat($('#proyeksi-param').val()) || 0.3;
  let proyeksi = [];
  const dataNilai = dataSeries.map(d=>d.nilai);
  const tahunList = dataSeries.map(d=>d.tahun);
  if (metode === 'linear') {
    const n = dataNilai.length;
    let sumX=0,sumY=0,sumXY=0,sumX2=0;
    for(let i=0;i<n;i++){ sumX+=tahunList[i]; sumY+=dataNilai[i]; sumXY+=tahunList[i]*dataNilai[i]; sumX2+=tahunList[i]*tahunList[i]; }
    const slope = (n*sumXY - sumX*sumY) / (n*sumX2 - sumX*sumX);
    const intercept = (sumY - slope*sumX) / n;
    for(let tahun=2025; tahun<=2030; tahun++) proyeksi.push({ tahun, nilai: intercept + slope*tahun, metode: 'Linear' });
  } else if (metode === 'moving-average') {
    const windowSize = 3;
    const recentValues = dataNilai.slice(-windowSize);
    const avg = recentValues.reduce((a,b)=>a+b,0)/recentValues.length;
    for(let tahun=2025; tahun<=2030; tahun++) proyeksi.push({ tahun, nilai: avg, metode: 'Moving Average' });
  } else {
    let smoothed = dataNilai[0];
    for(let i=1;i<dataNilai.length;i++) smoothed = param * dataNilai[i] + (1-param) * smoothed;
    for(let tahun=2025; tahun<=2030; tahun++) proyeksi.push({ tahun, nilai: smoothed, metode: `Exponential (α=${param})` });
  }
  $('#proyeksi-tbody').html(proyeksi.map(p=>`<tr><td><strong>${p.tahun}</strong></td><td>${formatNumber(p.nilai)}</td><td><span class="pill pill-review">${p.metode}</span></td></tr>`).join(''));
}
function simpanAnalisis() {
  const proyeksiData = [];
  $('#proyeksi-tbody tr').each(function(){ const tahun = $(this).find('td:first strong').text(); const nilai = $(this).find('td:eq(1)').text().replace(/\./g,'').replace(',','.'); if(tahun&&nilai) proyeksiData.push({ tahun: parseInt(tahun), nilai: parseFloat(nilai) }); });
  if(proyeksiData.length===0){ Swal.fire('Error','Tidak ada data proyeksi','error'); return; }
  Swal.fire({ title: 'Simpan Analisis', html: `<div class="form-group"><label>Judul</label><input id="analisis-judul" class="form-control" value="Proyeksi ${dataIndikator?.Indikator||'Hibah'} ${new Date().getFullYear()}"></div><div class="form-group mt-3"><label>Kesimpulan</label><textarea id="analisis-kesimpulan" class="form-control" rows="4"></textarea></div>`, showCancelButton: true, confirmButtonText: 'Simpan', preConfirm: () => { const judul=document.getElementById('analisis-judul').value; if(!judul) Swal.showValidationMessage('Judul harus diisi'); return { judul, kesimpulan: document.getElementById('analisis-kesimpulan').value }; } }).then(result=>{ if(result.isConfirmed){ $.ajax({ url: baseUrl + 'IDE/simpan_analisis_data', type:'POST', data: { judul: result.value.judul, indikator: dataIndikator?.Indikator||'Hibah', metode: $('#proyeksi-metode').val(), parameter: $('#proyeksi-param').val(), proyeksi: JSON.stringify(proyeksiData), kesimpulan: result.value.kesimpulan, data_aktual: JSON.stringify(dataSeries) }, dataType:'json', success:function(res){ if(res.status==='success'){ Swal.fire('Berhasil!','Analisis tersimpan','success'); loadRiwayatAnalisis(); } else Swal.fire('Error',res.message||'Gagal','error'); }, error:()=>Swal.fire('Error','Gagal koneksi','error') }); } });
}
function loadRiwayatAnalisis() {
  $('#riwayat-analisis-list').html('<div class="modern-spinner"></div><p>Memuat...</p>');
  $.ajax({ url: baseUrl + 'IDE/get_riwayat_analisis', type:'GET', dataType:'json', success:function(res){ if(res.status==='success' && res.data.length>0){ let html='<div style="max-height:300px;overflow-y:auto;">'; res.data.forEach(a=>{ html+=`<div style="padding:12px;border-bottom:1px solid var(--border);cursor:pointer;" onclick="viewAnalisisDetail(${a.id_analisis})"><div><strong>📊 ${escapeHtml(a.judul)}</strong><br><small>${a.indikator} | ${a.metode} | ${a.tanggal}</small></div><div style="font-size:12px;margin-top:5px;">${escapeHtml((a.kesimpulan||'').substring(0,100))}...</div></div>`; }); html+='</div>'; $('#riwayat-analisis-list').html(html); } else $('#riwayat-analisis-list').html('<div class="empty-state"><p>Belum ada analisis</p></div>'); }, error:()=>$('#riwayat-analisis-list').html('<div class="empty-state"><p>Gagal memuat</p></div>') });
}
function viewAnalisisDetail(id) {
  $.ajax({ url: baseUrl + 'IDE/get_analisis_detail', type:'POST', data:{id_analisis:id}, dataType:'json', success:function(res){ if(res.status==='success'){ const d=res.data; Swal.fire({ title: d.judul, html: `<div style="text-align:left;"><p><strong>📊 Indikator:</strong> ${escapeHtml(d.indikator)}</p><p><strong>📈 Metode:</strong> ${escapeHtml(d.metode)}</p><p><strong>📅 Dibuat:</strong> ${d.tanggal}</p><div class="mt-3"><strong>Kesimpulan:</strong><p class="mt-2">${escapeHtml(d.kesimpulan||'-')}</p></div><div class="mt-3"><strong>Proyeksi:</strong><pre style="background:#f0f4ff;padding:10px;border-radius:8px;font-size:12px;">${JSON.stringify(JSON.parse(d.proyeksi||'[]'),null,2)}</pre></div></div>`, width: '600px' }); } }, error:()=>Swal.fire('Error','Gagal','error') });
}
function exportDataToExcel() {
  const wsData = [['Tahun', 'Nilai (Rp Milyar)', 'Keterangan']];
  dataSeries.forEach(d => wsData.push([d.tahun, d.nilai, 'Data Aktual']));
  const proyeksi = []; $('#proyeksi-tbody tr').each(function(){ const t=$(this).find('td:first strong').text(); const n=$(this).find('td:eq(1)').text(); if(t&&n) proyeksi.push([t, parseFloat(n.replace(/\./g,'').replace(',','.')), 'Proyeksi']); });
  proyeksi.forEach(p => wsData.push(p));
  const ws = XLSX.utils.aoa_to_sheet(wsData);
  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, 'Data Indikator');
  XLSX.writeFile(wb, `Data_Indikator_${new Date().toISOString().slice(0,10)}.xlsx`);
}
async function exportDataToPDF() {
  Swal.fire({ title: 'Membuat PDF...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
  const logoUrl = baseUrl + 'assets/img/bappeda.png';
  const htmlContent = `<div style="padding:20px;"><div style="text-align:center;"><img src="${logoUrl}" style="height:50px;"><h3>SISTEM MANAJEMEN KANTOR</h3><h4>BAPPEDA KABUPATEN BANYUWANGI</h4></div><div style="margin-top:20px;"><p><strong>Indikator:</strong> ${dataIndikator?.Indikator||'Hibah'}</p><p><strong>Satuan:</strong> ${dataIndikator?.Satuan||'Rp Milyar'}</p><p><strong>Tanggal Export:</strong> ${new Date().toLocaleDateString('id-ID')}</p></div><h4>Data Aktual</h4><table border="1" cellpadding="5" style="width:100%;border-collapse:collapse;">${dataSeries.map(d=>`<tr><td>${d.tahun}</td><td>${formatNumber(d.nilai)}</td></tr>`).join('')}</table><h4>Proyeksi 2025-2030</h4><table border="1" cellpadding="5" style="width:100%;border-collapse:collapse;">${(()=>{ let rows=''; $('#proyeksi-tbody tr').each(function(){ rows+=`<tr>${$(this).html()}</tr>`; }); return rows; })()}</table></div>`;
  const element = document.createElement('div'); element.innerHTML = htmlContent; document.body.appendChild(element);
  const opt = { margin: 0.5, filename: `Analisis_Data_${new Date().toISOString().slice(0,10)}.pdf`, image: { type: 'jpeg', quality: 0.98 }, html2canvas: { scale: 2 }, jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' } };
  await html2pdf().set(opt).from(element).save(); document.body.removeChild(element); Swal.fire('Berhasil!','PDF terdownload','success');
}
async function exportAnalisisToPDF() { await exportDataToPDF(); }

// ==================== LOGOUT ====================
function handleLogout() {
  Swal.fire({ title: 'Yakin keluar?', icon: 'question', showCancelButton: true, confirmButtonColor: '#dc2626', confirmButtonText: 'Ya' }).then(result => {
    if(result.isConfirmed){ localStorage.clear(); sessionStorage.clear(); window.location.href = baseUrl + 'IDE/SmbLoginPage'; }
  });
}
document.querySelector('.logout-btn')?.addEventListener('click', handleLogout);

// ==================== INIT ====================
$(document).ready(function() {
  const now = new Date(); const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
  const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  document.getElementById('greeting-date').textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
  $('#formUploadDokumen').on('submit', function(e){ e.preventDefault();
    const fd = new FormData(this);
    Swal.fire({ title: 'Uploading...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
    $.ajax({ url: baseUrl+'IDE/upload_dokumen', type:'POST', data: fd, processData: false, contentType: false, dataType:'json', success: function(res){ Swal.close(); if(res.status==='success'){ Swal.fire('Berhasil!','','success'); closeUploadModal(); if(currentBidangId) loadDokumenFromDB(currentBidangId); } else Swal.fire('Error',res.message,'error'); }, error: function(){ Swal.close(); Swal.fire('Error','Upload gagal','error'); } });
  });
});
</script>
</body>
</html>