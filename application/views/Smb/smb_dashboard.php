<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php

// Di file smb_dashboard.php - PASTIKAN INI DI AWAL
if (!$this->session->userdata('smb_logged_in')) {
    redirect('IDE/SmbLoginPage');
    exit();
}

// Ambil data user dari session
$user_id = $this->session->userdata('user_id');
$username = $this->session->userdata('username');
$nama_lengkap = $this->session->userdata('nama_lengkap');
$level = $this->session->userdata('level');

// Jika nama_lengkap kosong, gunakan username
$display_name = !empty($nama_lengkap) ? $nama_lengkap : $username;

// Tentukan role berdasarkan level
$role_name = '';
if ($level == 1) {
    $role_name = 'Super Admin';
} elseif ($level == 2) {
    $role_name = 'Kepala Bappeda'; 
} elseif ($level == 3) {
    $role_name = 'Kepala Bidang';
} elseif ($level == 4) {
    $role_name = 'Staff';
} else {
    $role_name = 'User';
}

// Inisial untuk avatar (2 huruf pertama)
$initial = strtoupper(substr($display_name, 0, 2));
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SMB Bappeda — Sistem Manajemen Kantor</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
/* ============================================================
   RESET & BASE
   ============================================================ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --sidebar-w: 230px;
  --topbar-h: 56px;
  --navy-900: #0d1b4b;
  --navy-800: #162060;
  --navy-700: #1a2d6b;
  --navy-600: #1e3580;
  --navy-500: #2340a0;
  --blue-600: #2f52c4;
  --blue-500: #3b65d4;
  --blue-400: #5580e0;
  --blue-100: #dce8ff;
  --blue-50:  #eff4ff;
  --surface:  #ffffff;
  --page-bg:  #f0f3fa;
  --border:   rgba(0,0,0,0.07);
  --border-md:rgba(0,0,0,0.11);
  --text-1:   #0f172a;
  --text-2:   #475569;
  --text-3:   #94a3b8;
  --green:    #16a34a;
  --green-bg: #dcfce7;
  --green-text:#15803d;
  --amber:    #d97706;
  --amber-bg: #fef3c7;
  --amber-text:#92400e;
  --red:      #dc2626;
  --red-bg:   #fee2e2;
  --red-text: #991b1b;
  --sky-bg:   #dbeafe;
  --sky-text: #1d4ed8;
  --radius-sm: 6px;
  --radius:   10px;
  --radius-lg: 14px;
  --radius-xl: 18px;
  --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
  --shadow:    0 4px 12px rgba(0,0,0,0.07), 0 2px 4px rgba(0,0,0,0.04);
  --shadow-lg: 0 10px 30px rgba(0,0,0,0.1), 0 4px 8px rgba(0,0,0,0.05);
  --font-main: 'Plus Jakarta Sans', sans-serif;
  --font-body: 'DM Sans', sans-serif;
  --transition: all 0.18s cubic-bezier(0.4,0,0.2,1);
}
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

/* ============================================================
   SCROLLBAR
   ============================================================ */
::-webkit-scrollbar { width: 5px; height: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.15); border-radius: 99px; }

/* ============================================================
   LAYOUT
   ============================================================ */
.app-layout { display: flex; height: 100vh; overflow: hidden; }

/* ============================================================
   SIDEBAR
   ============================================================ */
.sidebar {
  width: var(--sidebar-w);
  background: var(--navy-700);
  display: flex;
  flex-direction: column;
  flex-shrink: 0;
  overflow: hidden;
  position: relative;
  z-index: 100;
}
.sidebar::before {
  content: '';
  position: absolute;
  top: -80px; right: -80px;
  width: 200px; height: 200px;
  background: radial-gradient(circle, rgba(63,100,200,0.35) 0%, transparent 70%);
  pointer-events: none;
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
  border-radius: var(--radius-sm);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.brand-logo svg { width: 18px; height: 18px; }
.brand-text { min-width: 0; }
.brand-name {
  font-family: var(--font-main);
  font-size: 13px;
  font-weight: 700;
  color: #fff;
  white-space: nowrap;
  letter-spacing: -0.01em;
}
.brand-sub {
  font-size: 10.5px;
  color: rgba(255,255,255,0.45);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* NAV */
.sidebar-nav {
  flex: 1;
  overflow-y: auto;
  padding: 8px 0 8px;
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
  border-radius: var(--radius-sm);
  margin: 1px 8px;
  transition: var(--transition);
  position: relative;
  user-select: none;
}
.nav-item:hover { background: rgba(255,255,255,0.08); color: #fff; }
.nav-item.active {
  background: rgba(47,82,196,0.7);
  color: #fff;
  box-shadow: 0 2px 8px rgba(47,82,196,0.35);
}
.nav-item.active::before {
  content: '';
  position: absolute;
  left: 0; top: 50%;
  transform: translateY(-50%);
  width: 3px; height: 60%;
  background: #7eb3ff;
  border-radius: 0 3px 3px 0;
}
.nav-item svg.nav-icon { width: 15px; height: 15px; flex-shrink: 0; opacity: 0.85; }
.nav-item .nav-chevron {
  margin-left: auto;
  width: 12px; height: 12px;
  opacity: 0.45;
  transition: transform 0.2s ease;
  flex-shrink: 0;
}
.nav-item.open .nav-chevron { transform: rotate(90deg); opacity: 0.7; }

/* SUB-MENU */
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
  border-radius: var(--radius-sm);
  transition: var(--transition);
}
.sub-item:hover { background: rgba(255,255,255,0.07); color: rgba(255,255,255,0.85); }
.sub-item.active { color: #7eb3ff; }
.sub-item svg { width: 12px; height: 12px; flex-shrink: 0; }

/* SIDEBAR FOOTER */
.sidebar-footer {
  padding: 10px 8px 14px;
  border-top: 1px solid rgba(255,255,255,0.07);
}
.user-mini {
  display: flex; align-items: center; gap: 9px;
  padding: 8px 10px;
  border-radius: var(--radius-sm);
  cursor: pointer;
  transition: var(--transition);
}
.user-mini:hover { background: rgba(255,255,255,0.07); }
.avatar-sm {
  width: 30px; height: 30px;
  border-radius: 50%;
  background: var(--blue-500);
  display: flex; align-items: center; justify-content: center;
  font-size: 11px; font-weight: 600; color: #fff;
  flex-shrink: 0;
}
.user-mini-info { min-width: 0; flex: 1; }
.user-mini-name { font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.9); }
.user-mini-role { font-size: 10px; color: rgba(255,255,255,0.4); }
.logout-btn {
  display: flex; align-items: center; gap: 9px;
  padding: 7px 10px;
  font-size: 12.5px; color: #f87171;
  cursor: pointer;
  border-radius: var(--radius-sm);
  transition: var(--transition);
  margin-top: 2px;
}
.logout-btn:hover { background: rgba(248,113,113,0.1); }
.logout-btn svg { width: 14px; height: 14px; }

/* ============================================================
   MAIN AREA
   ============================================================ */
.main-area { flex: 1; display: flex; flex-direction: column; overflow: hidden; }

/* TOPBAR */
.topbar {
  height: var(--topbar-h);
  background: var(--surface);
  border-bottom: 1px solid var(--border);
  display: flex; align-items: center;
  padding: 0 22px;
  gap: 12px;
  flex-shrink: 0;
  position: relative; z-index: 10;
}
.search-wrap {
  display: flex; align-items: center; gap: 8px;
  background: var(--page-bg);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 0 12px;
  height: 34px;
  transition: var(--transition);
}
.search-wrap:focus-within { border-color: var(--blue-400); background: #fff; box-shadow: 0 0 0 3px rgba(47,82,196,0.08); }
.search-wrap svg { width: 14px; height: 14px; color: var(--text-3); flex-shrink: 0; }
.search-wrap input {
  border: none; background: transparent;
  font-size: 12.5px; color: var(--text-1);
  outline: none; width: 190px;
}
.search-wrap input::placeholder { color: var(--text-3); }
.topbar-spacer { flex: 1; }
.topbar-actions { display: flex; align-items: center; gap: 6px; }
.icon-btn {
  width: 34px; height: 34px;
  display: flex; align-items: center; justify-content: center;
  border-radius: 8px;
  cursor: pointer;
  transition: var(--transition);
  position: relative;
  border: none; background: transparent;
}
.icon-btn:hover { background: var(--page-bg); }
.icon-btn svg { width: 17px; height: 17px; color: var(--text-2); }
.notif-badge {
  position: absolute; top: 6px; right: 6px;
  width: 7px; height: 7px;
  background: var(--red);
  border-radius: 50%;
  border: 1.5px solid #fff;
}
.divider-v { width: 1px; height: 22px; background: var(--border); margin: 0 4px; }
.lang-btn {
  display: flex; align-items: center; gap: 6px;
  padding: 0 10px; height: 34px;
  border-radius: 8px;
  font-size: 12px; color: var(--text-2);
  cursor: pointer; border: 1px solid var(--border);
  background: transparent; transition: var(--transition);
}
.lang-btn:hover { background: var(--page-bg); }
.flag { font-size: 13px; }
.lang-btn svg { width: 9px; height: 9px; }
.topbar-user {
  display: flex; align-items: center; gap: 8px;
  padding: 0 4px 0 6px; height: 34px;
  border-radius: 8px;
  cursor: pointer;
  transition: var(--transition);
  border: 1px solid transparent;
}
.topbar-user:hover { background: var(--page-bg); border-color: var(--border); }
.topbar-avatar {
  width: 28px; height: 28px;
  border-radius: 50%; background: var(--blue-600);
  display: flex; align-items: center; justify-content: center;
  font-size: 10.5px; font-weight: 700; color: #fff;
}
.topbar-uname { font-size: 12.5px; font-weight: 500; }
.topbar-urole { font-size: 10.5px; color: var(--text-3); }

/* ============================================================
   PAGE CONTENT
   ============================================================ */
.page-content { flex: 1; overflow-y: auto; padding: 22px 24px 30px; }

/* ============================================================
   PAGE PANELS
   ============================================================ */
.panel { display: none; animation: fadeIn 0.2s ease; }
.panel.active { display: block; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(4px); } to { opacity: 1; transform: none; } }

/* PAGE HEADER */
.page-hdr {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 18px;
}
.page-hdr-left { display: flex; align-items: center; gap: 12px; }
.page-hdr-icon {
  width: 38px; height: 38px;
  background: var(--blue-50);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
}
.page-hdr-icon svg { width: 18px; height: 18px; color: var(--blue-600); }
.page-hdr-title { font-family: var(--font-main); font-size: 17px; font-weight: 700; letter-spacing: -0.02em; }
.page-hdr-sub { font-size: 12px; color: var(--text-2); margin-top: 1px; }
.badge-role {
  background: var(--blue-50);
  color: var(--blue-600);
  font-size: 11px; font-weight: 600;
  padding: 4px 10px; border-radius: 20px;
  border: 1px solid var(--blue-100);
}

/* ============================================================
   HERO BANNER
   ============================================================ */
.hero-banner {
  background: var(--navy-700);
  border-radius: var(--radius-xl);
  padding: 26px 28px;
  margin-bottom: 20px;
  display: flex; align-items: center; justify-content: space-between;
  gap: 20px;
  position: relative; overflow: hidden;
}
.hero-banner::before {
  content: '';
  position: absolute; top: -60px; right: 160px;
  width: 220px; height: 220px;
  background: radial-gradient(circle, rgba(59,101,212,0.5) 0%, transparent 65%);
  pointer-events: none;
}
.hero-banner::after {
  content: '';
  position: absolute; bottom: -40px; right: 40px;
  width: 160px; height: 160px;
  background: radial-gradient(circle, rgba(100,140,255,0.2) 0%, transparent 65%);
  pointer-events: none;
}
.hero-left { position: relative; z-index: 1; }
.hero-eyebrow {
  font-size: 11px; font-weight: 600;
  color: rgba(255,255,255,0.5);
  letter-spacing: 0.06em;
  text-transform: uppercase;
  margin-bottom: 8px;
  display: flex; align-items: center; gap: 7px;
}
.hero-eyebrow::before {
  content: ''; width: 18px; height: 1px;
  background: rgba(255,255,255,0.35);
}
.hero-title {
  font-family: var(--font-main);
  font-size: 20px; font-weight: 700;
  color: #fff; line-height: 1.25;
  letter-spacing: -0.02em;
  margin-bottom: 6px;
}
.hero-sub { font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 18px; }
.hero-btn {
  display: inline-flex; align-items: center; gap: 7px;
  background: rgba(255,255,255,0.14);
  border: 1px solid rgba(255,255,255,0.22);
  color: #fff; font-size: 12.5px; font-weight: 500;
  padding: 8px 18px; border-radius: 8px;
  cursor: pointer; transition: var(--transition);
  font-family: inherit;
}
.hero-btn:hover { background: rgba(255,255,255,0.22); }
.hero-btn svg { width: 13px; height: 13px; }
.hero-right {
  display: flex; gap: 10px;
  position: relative; z-index: 1; flex-shrink: 0;
}
.hero-card {
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: var(--radius);
  padding: 14px 16px;
  min-width: 110px;
  text-align: center;
}
.hero-card-icon {
  width: 34px; height: 34px;
  background: rgba(255,255,255,0.12);
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 8px;
}
.hero-card-icon svg { width: 16px; height: 16px; color: rgba(255,255,255,0.8); }
.hero-card-num { font-size: 18px; font-weight: 700; color: #fff; font-family: var(--font-main); }
.hero-card-label { font-size: 10px; color: rgba(255,255,255,0.5); margin-top: 2px; }

/* ============================================================
   STAT CARDS
   ============================================================ */
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
.stat-card:hover { box-shadow: var(--shadow); transform: translateY(-1px); }
.stat-row { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 10px; }
.stat-label { font-size: 11.5px; color: var(--text-2); font-weight: 500; margin-bottom: 5px; }
.stat-val {
  font-family: var(--font-main);
  font-size: 26px; font-weight: 700;
  letter-spacing: -0.03em; color: var(--text-1);
}
.stat-icon {
  width: 40px; height: 40px;
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.stat-icon svg { width: 19px; height: 19px; }
.stat-divider { height: 1px; background: var(--border); margin-bottom: 10px; }
.stat-trend { font-size: 11.5px; display: flex; align-items: center; gap: 5px; }
.trend-up { color: var(--green); }
.trend-down { color: var(--red); }
.trend-dot { font-size: 13px; }

/* ============================================================
   CONTENT GRID
   ============================================================ */
.content-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}
.span-full { grid-column: 1 / -1; }

/* CARDS */
.card {
  background: var(--surface);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  box-shadow: var(--shadow-sm);
  overflow: hidden;
}
.card-head {
  display: flex; align-items: center; justify-content: space-between;
  padding: 14px 18px;
  border-bottom: 1px solid var(--border);
}
.card-title { font-size: 13.5px; font-weight: 600; font-family: var(--font-main); }
.card-action { font-size: 11.5px; color: var(--blue-600); cursor: pointer; font-weight: 500; }
.card-action:hover { text-decoration: underline; }
.card-body { padding: 12px 18px; }
.card-body-flush { padding: 0; }

/* ACTIVITY */
.act-list { padding: 4px 0; }
.act-item {
  display: flex; align-items: center; gap: 11px;
  padding: 10px 18px;
  border-bottom: 1px solid var(--border);
  transition: var(--transition);
}
.act-item:last-child { border-bottom: none; }
.act-item:hover { background: #fafbff; }
.act-icon {
  width: 32px; height: 32px;
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.act-icon svg { width: 14px; height: 14px; }
.act-text { flex: 1; min-width: 0; }
.act-title { font-size: 12.5px; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.act-sub { font-size: 11px; color: var(--text-2); margin-top: 1px; }
.act-time { font-size: 11px; color: var(--text-3); flex-shrink: 0; }

/* PRINTER */
.printer-list { }
.printer-item {
  display: flex; align-items: center;
  padding: 10px 18px;
  border-bottom: 1px solid var(--border);
  gap: 10px;
  transition: var(--transition);
}
.printer-item:last-child { border-bottom: none; }
.printer-item:hover { background: #fafbff; }
.status-dot {
  width: 8px; height: 8px;
  border-radius: 50%; flex-shrink: 0;
}
.dot-online  { background: var(--green); box-shadow: 0 0 0 3px rgba(22,163,74,0.15); }
.dot-idle    { background: var(--amber); box-shadow: 0 0 0 3px rgba(217,119,6,0.15); }
.dot-offline { background: var(--red);   box-shadow: 0 0 0 3px rgba(220,38,38,0.12); }
.printer-info { flex: 1; min-width: 0; }
.printer-name { font-size: 12.5px; font-weight: 500; }
.printer-loc { font-size: 11px; color: var(--text-2); }
.printer-badge {
  font-size: 10.5px; font-weight: 600;
  padding: 2px 8px; border-radius: 99px;
}
.p-online  { background: var(--green-bg); color: var(--green-text); }
.p-idle    { background: var(--amber-bg); color: var(--amber-text); }
.p-offline { background: var(--red-bg); color: var(--red-text); }

/* ============================================================
   TABLES
   ============================================================ */
.table-toolbar {
  display: flex; align-items: center; justify-content: space-between;
  padding: 12px 18px;
  border-bottom: 1px solid var(--border);
  gap: 10px;
}
.table-toolbar-left { display: flex; align-items: center; gap: 8px; }
.table-toolbar-right { display: flex; align-items: center; gap: 8px; }
.mini-search {
  display: flex; align-items: center; gap: 7px;
  background: var(--page-bg);
  border: 1px solid var(--border);
  border-radius: 7px; padding: 0 10px; height: 30px;
  transition: var(--transition);
}
.mini-search:focus-within { border-color: var(--blue-400); background: #fff; }
.mini-search svg { width: 12px; height: 12px; color: var(--text-3); }
.mini-search input {
  border: none; background: transparent;
  font-size: 12px; outline: none; width: 140px;
  color: var(--text-1);
}
.mini-search input::placeholder { color: var(--text-3); }
.sel-filter {
  height: 30px; padding: 0 10px;
  border: 1px solid var(--border);
  border-radius: 7px;
  font-size: 12px; font-family: inherit;
  background: var(--page-bg); color: var(--text-1);
  outline: none; cursor: pointer;
}
.sel-filter:focus { border-color: var(--blue-400); }

/* ============================================================
   IMPROVED TABLE STYLES
   ============================================================ */
.tbl {
  width: 100%;
  border-collapse: collapse;
  font-size: 12.5px;
  border-radius: var(--radius-lg);
  overflow: hidden;
}

.tbl th {
  text-align: left;
  padding: 12px 16px;
  font-size: 11px;
  font-weight: 600;
  color: var(--text-2);
  background: #f8f9fd;
  border-bottom: 1px solid var(--border);
  white-space: nowrap;
  letter-spacing: 0.05em;
  text-transform: uppercase;
}

.tbl td {
  padding: 14px 16px;
  border-bottom: 1px solid var(--border);
  vertical-align: middle;
}

.tbl tr:last-child td {
  border-bottom: none;
}

.tbl tbody tr {
  transition: var(--transition);
}

.tbl tbody tr:hover {
  background: #f8f9fd;
}

/* Responsive table wrapper */
.table-responsive {
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

/* Column width optimization */
.tbl th:first-child,
.tbl td:first-child {
  width: 50px;
  text-align: center;
}

.tbl th:nth-child(2),
.tbl td:nth-child(2) {
  width: 70px;
  text-align: center;
}

.tbl th:nth-child(4),
.tbl td:nth-child(4) {
  width: 130px;
}

.tbl th:nth-child(5),
.tbl td:nth-child(5) {
  width: 110px;
}

.tbl th:nth-child(6),
.tbl td:nth-child(6) {
  width: 120px;
}

.tbl th:nth-child(7),
.tbl td:nth-child(7) {
  width: 100px;
}

.tbl th:last-child,
.tbl td:last-child {
  width: 100px;
  text-align: center;
}

/* Badge styles */
.badge-kategori {
  display: inline-block;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 500;
  white-space: nowrap;
}

.badge-sk {
  background: #e0e7ff;
  color: #4338ca;
}

.badge-laporan {
  background: #dcfce7;
  color: #166534;
}

.badge-nota {
  background: #fed7aa;
  color: #9a3412;
}

/* Action buttons */
.action-buttons {
  display: flex;
  gap: 8px;
  justify-content: center;
}

.link-act, .link-danger {
  font-size: 13px;
  padding: 4px 8px;
  border-radius: 6px;
  transition: all 0.2s;
}

.link-act {
  color: #2563eb;
}

.link-act:hover {
  background: #eff4ff;
  text-decoration: none;
}

.link-danger {
  color: #dc2626;
}

.link-danger:hover {
  background: #fee2e2;
  text-decoration: none;
}

/* File icon and thumbnail */
.doc-thumbnail {
  width: 45px;
  height: 45px;
  object-fit: cover;
  border-radius: 8px;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.2s;
  border: 1px solid #e2e8f0;
}

.doc-thumbnail:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.file-icon {
  width: 45px;
  height: 45px;
  background: var(--blue-50);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  color: var(--blue-600);
  cursor: pointer;
  transition: all 0.2s;
  margin: 0 auto;
}

.file-icon:hover {
  background: var(--blue-100);
  transform: scale(1.05);
}

/* Empty state */
.empty-state-table {
  text-align: center;
  padding: 60px 20px;
  color: var(--text-3);
}

.empty-state-table .icon {
  font-size: 48px;
  margin-bottom: 15px;
}

/* Toolbar */
.table-toolbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 20px;
  border-bottom: 1px solid var(--border);
  flex-wrap: wrap;
  gap: 10px;
  background: #ffffff;
}

.table-toolbar-right {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}

.mini-search {
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--page-bg);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 0 12px;
  height: 34px;
  transition: var(--transition);
}

.mini-search:focus-within {
  border-color: var(--blue-400);
  background: #fff;
  box-shadow: 0 0 0 3px rgba(47,82,196,0.08);
}

.mini-search svg {
  width: 14px;
  height: 14px;
  color: var(--text-3);
}

.mini-search input {
  border: none;
  background: transparent;
  font-size: 12.5px;
  color: var(--text-1);
  outline: none;
  width: 180px;
}

.mini-search input::placeholder {
  color: var(--text-3);
}

.sel-filter {
  height: 34px;
  padding: 0 12px;
  border: 1px solid var(--border);
  border-radius: 8px;
  font-size: 12px;
  font-family: inherit;
  background: var(--page-bg);
  color: var(--text-1);
  outline: none;
  cursor: pointer;
}

.sel-filter:focus {
  border-color: var(--blue-400);
}
/* ============================================================
   PILLS / BADGES
   ============================================================ */
.pill {
  font-size: 10.5px; font-weight: 600;
  padding: 2px 9px; border-radius: 99px;
  display: inline-block; white-space: nowrap;
}
.pill-done     { background: var(--green-bg); color: var(--green-text); }
.pill-progress { background: var(--amber-bg); color: var(--amber-text); }
.pill-review   { background: var(--sky-bg); color: var(--sky-text); }
.pill-danger   { background: var(--red-bg); color: var(--red-text); }
.pill-upload   { background: #ede9fe; color: #5b21b6; }
.pill-print    { background: var(--green-bg); color: var(--green-text); }
.pill-login    { background: #e0f2fe; color: #0369a1; }

/* ============================================================
   BUTTONS
   ============================================================ */
.btn {
  display: inline-flex; align-items: center; gap: 6px;
  font-family: inherit; font-size: 12.5px; font-weight: 500;
  padding: 7px 14px; border-radius: 8px;
  border: 1px solid var(--border);
  background: var(--surface); color: var(--text-1);
  cursor: pointer; transition: var(--transition); white-space: nowrap;
}
.btn:hover { background: var(--page-bg); }
.btn svg { width: 13px; height: 13px; }
.btn-primary {
  background: var(--blue-600); color: #fff;
  border-color: var(--blue-600);
}
.btn-primary:hover { background: var(--blue-500); border-color: var(--blue-500); }
.btn-sm { padding: 5px 11px; font-size: 12px; }

/* ============================================================
   LINK ACTION
   ============================================================ */
.link-act { color: var(--blue-600); cursor: pointer; font-size: 12px; font-weight: 500; }
.link-act:hover { text-decoration: underline; }
.link-danger { color: var(--red); cursor: pointer; font-size: 12px; font-weight: 500; }

/* ============================================================
   DOC CATEGORY CARDS
   ============================================================ */
.doc-cat-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 12px;
  margin-bottom: 18px;
}
.doc-cat-card {
  background: var(--surface);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  padding: 16px;
  cursor: pointer;
  transition: var(--transition);
  box-shadow: var(--shadow-sm);
}
.doc-cat-card:hover { border-color: var(--blue-400); box-shadow: var(--shadow); transform: translateY(-1px); }
.doc-cat-icon {
  width: 36px; height: 36px;
  border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 10px;
}
.doc-cat-icon svg { width: 17px; height: 17px; }
.doc-cat-name { font-size: 12.5px; font-weight: 600; margin-bottom: 3px; }
.doc-cat-count { font-size: 11px; color: var(--text-2); }

/* ============================================================
   LAPORAN FORM
   ============================================================ */
.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
  margin-bottom: 16px;
}
.form-group { display: flex; flex-direction: column; gap: 5px; }
.form-label { font-size: 11.5px; font-weight: 600; color: var(--text-2); }
.form-control {
  height: 36px; padding: 0 11px;
  border: 1px solid var(--border);
  border-radius: 8px;
  font-size: 12.5px; font-family: inherit;
  background: var(--surface); color: var(--text-1);
  outline: none; transition: var(--transition);
}
.form-control:focus { border-color: var(--blue-400); box-shadow: 0 0 0 3px rgba(47,82,196,0.08); }
.form-actions { display: flex; gap: 8px; padding-top: 4px; }

/* ============================================================
   EMPTY STATE
   ============================================================ */
.empty-state {
  padding: 48px 20px;
  text-align: center;
  color: var(--text-3);
}
.empty-state svg { width: 40px; height: 40px; margin: 0 auto 12px; opacity: 0.3; display: block; }
.empty-state p { font-size: 13px; color: var(--text-2); }

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 900px) {
  .stat-grid { grid-template-columns: repeat(2, 1fr); }
  .content-grid { grid-template-columns: 1fr; }
  .hero-right { display: none; }
  .hero-title { font-size: 16px; }
  .doc-cat-grid { grid-template-columns: 1fr 1fr; }
  .form-grid { grid-template-columns: 1fr; }
}
@media (max-width: 640px) {
  .stat-grid { grid-template-columns: 1fr 1fr; }
  .sidebar { width: 200px; }
  .main-area { overflow: hidden; }
}

.sidebar-nav {
  flex: 1;
  overflow-y: auto;
  padding: 8px 0 8px;
  max-height: calc(100vh - 180px);
}

/* Modal styles */
.modal {
  animation: fadeIn 0.2s ease;
}

/* Thumbnail styles */
.doc-thumbnail {
  width: 60px;
  height: 60px;
  object-fit: cover;
  border-radius: 8px;
  cursor: pointer;
  transition: transform 0.2s;
}
.doc-thumbnail:hover {
  transform: scale(1.05);
}

/* File icon for non-image */
.file-icon {
  width: 60px;
  height: 60px;
  background: var(--blue-50);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  color: var(--blue-600);
  cursor: pointer;
}
.file-icon:hover {
  background: var(--blue-100);
}

/* ============================================================
   PDF EXPORT STYLES
   ============================================================ */
@media print {
  body * {
    visibility: hidden;
  }
  #pdf-export-content, #pdf-export-content * {
    visibility: visible;
  }
  #pdf-export-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    padding: 20px;
  }
  .no-print {
    display: none !important;
  }
}

/* Style untuk konten PDF yang akan diexport */
.pdf-export-wrapper {
  font-family: 'Plus Jakarta Sans', 'DM Sans', sans-serif;
  padding: 20px;
  background: white;
}

.pdf-header {
  text-align: center;
  margin-bottom: 30px;
  padding-bottom: 20px;
  border-bottom: 2px solid #1a2d6b;
}

.pdf-header h2 {
  color: #1a2d6b;
  margin-bottom: 5px;
  font-size: 20px;
}

.pdf-header p {
  color: #666;
  font-size: 12px;
  margin: 5px 0;
}

.pdf-date {
  text-align: right;
  margin-bottom: 20px;
  font-size: 11px;
  color: #666;
}

.pdf-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 11px;
}

.pdf-table th {
  background: #1a2d6b;
  color: white;
  padding: 10px 8px;
  text-align: left;
  font-weight: 600;
}

.pdf-table td {
  padding: 8px;
  border-bottom: 1px solid #ddd;
}

.pdf-table tr:hover {
  background: #f5f5f5;
}

.pdf-footer {
  margin-top: 30px;
  text-align: center;
  font-size: 10px;
  color: #999;
  padding-top: 20px;
  border-top: 1px solid #ddd;
}

/* PDF Export Styles */
@media print {
  body * {
    visibility: hidden;
  }
  #pdf-export-content, #pdf-export-content * {
    visibility: visible;
  }
  #pdf-export-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
  }
}

.pdf-export-wrapper {
  font-family: 'Plus Jakarta Sans', 'DM Sans', sans-serif;
  padding: 20px;
  background: white;
}

.pdf-header {
  text-align: center;
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 2px solid #1a2d6b;
}

.pdf-header h2 {
  color: #1a2d6b;
  margin-bottom: 5px;
  font-size: 18px;
}

.pdf-header h3 {
  color: #1a2d6b;
  margin-bottom: 5px;
  font-size: 14px;
}

.pdf-header p {
  color: #666;
  font-size: 11px;
}

.pdf-date {
  margin-bottom: 15px;
  font-size: 10px;
  color: #666;
  text-align: right;
}

.pdf-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 10px;
}

.pdf-table th {
  background: #1a2d6b;
  color: white;
  padding: 8px 6px;
  text-align: left;
}

.pdf-table td {
  padding: 6px;
  border-bottom: 1px solid #ddd;
}

.pdf-footer {
  margin-top: 20px;
  text-align: center;
  font-size: 9px;
  color: #999;
  padding-top: 10px;
  border-top: 1px solid #ddd;
}

/* ============================================================
   LOG TABLE STYLES - PRESISI & RAPI
   ============================================================ */
.log-table-wrapper {
  overflow-x: auto;
  border-radius: var(--radius-lg);
}

.log-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 12.5px;
  min-width: 800px;
}

.log-table th {
  text-align: left;
  padding: 12px 16px;
  font-size: 11.5px;
  font-weight: 600;
  color: var(--text-2);
  background: #f8f9fd;
  border-bottom: 2px solid var(--border);
  white-space: nowrap;
}

.log-table th i {
  margin-right: 6px;
  font-size: 12px;
}

.log-table td {
  padding: 12px 16px;
  border-bottom: 1px solid var(--border);
  vertical-align: middle;
}

.log-table tr:last-child td {
  border-bottom: none;
}

.log-table tbody tr {
  transition: all 0.2s ease;
}

.log-table tbody tr:hover {
  background: #f8f9fd;
}

/* Kolom spesifik */
.log-table th:nth-child(1),
.log-table td:nth-child(1) {
  width: 150px;
  white-space: nowrap;
  font-family: monospace;
  font-size: 11px;
  color: var(--text-2);
}

.log-table th:nth-child(2),
.log-table td:nth-child(2) {
  width: 120px;
  font-weight: 500;
}

.log-table th:nth-child(3),
.log-table td:nth-child(3) {
  width: 90px;
  text-align: center;
}

.log-table th:nth-child(4),
.log-table td:nth-child(4) {
  width: 120px;
}

.log-table th:nth-child(5),
.log-table td:nth-child(5) {
  min-width: 250px;
  word-break: break-word;
}

.log-table th:nth-child(6),
.log-table td:nth-child(6) {
  width: 120px;
  font-family: monospace;
  font-size: 11px;
}

/* Badge pill untuk aksi */
.log-aksi-badge {
  display: inline-block;
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 10.5px;
  font-weight: 600;
  text-align: center;
  min-width: 65px;
}

.log-aksi-upload {
  background: #ede9fe;
  color: #5b21b6;
}

.log-aksi-print {
  background: #dcfce7;
  color: #166534;
}

.log-aksi-review {
  background: #dbeafe;
  color: #1d4ed8;
}

.log-aksi-login {
  background: #e0f2fe;
  color: #0369a1;
}

.log-aksi-update {
  background: #dcfce7;
  color: #15803d;
}

.log-aksi-hapus {
  background: #fee2e2;
  color: #991b1b;
}

/* IP Address styling */
.ip-address {
  font-family: 'Courier New', monospace;
  font-size: 11px;
  background: #f1f5f9;
  padding: 4px 8px;
  border-radius: 6px;
  display: inline-block;
  letter-spacing: 0.5px;
}

/* Username styling */
.username-cell {
  font-weight: 600;
  color: var(--text-1);
}

.username-cell i {
  font-size: 12px;
  margin-right: 6px;
  color: var(--blue-500);
}

/* Detail text */
.detail-cell {
  max-width: 300px;
  white-space: normal;
  word-break: break-word;
  line-height: 1.4;
  color: var(--text-2);
}

/* Waktu styling */
.waktu-cell {
  font-family: 'Courier New', monospace;
  font-size: 11px;
  color: var(--text-2);
}

/* ============================================================
   PRINTER CARD STYLES (TAMBAHKAN)
   ============================================================ */
.printer-card {
    border: 2px solid var(--border);
    border-radius: var(--radius);
    padding: 12px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: all 0.2s;
    background: var(--surface);
}

.printer-card:hover {
    border-color: var(--blue-400);
    background: var(--blue-50);
    transform: translateY(-1px);
}

.printer-card.selected {
    border-color: var(--blue-600);
    background: var(--blue-50);
    box-shadow: 0 0 0 2px rgba(47,82,196,0.2);
}

.printer-status {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 6px;
}

.printer-status.online { background: var(--green); box-shadow: 0 0 0 2px rgba(22,163,74,0.2); }
.printer-status.idle { background: var(--amber); box-shadow: 0 0 0 2px rgba(217,119,6,0.2); }
.printer-status.offline { background: var(--red); box-shadow: 0 0 0 2px rgba(220,38,38,0.2); }
.printer-status.error { background: var(--red); box-shadow: 0 0 0 2px rgba(220,38,38,0.2); }

.status-text {
    font-size: 11px;
    font-weight: 600;
}

.stock-bar {
    background: #e2e8f0;
    border-radius: 4px;
    overflow: hidden;
}

.stock-fill {
    height: 6px;
    border-radius: 3px;
    transition: width 0.3s ease;
}

.print-summary {
    background: var(--page-bg);
    padding: 12px;
    border-radius: var(--radius);
    margin-top: 10px;
}

.print-summary-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid var(--border);
    font-size: 12px;
}

.print-summary-item:last-child {
    border-bottom: none;
}

.stock-warning {
    background: #fef3c7;
    border-left: 3px solid var(--amber);
    padding: 10px;
    border-radius: 6px;
    margin-top: 10px;
    font-size: 12px;
}

.stock-warning a {
    color: var(--blue-600);
    text-decoration: underline;
    cursor: pointer;
}

</style>
</head>
<body>

<div class="app-layout">

  <!-- ============================================================
       SIDEBAR
       ============================================================ -->
  <aside class="sidebar">
    <div class="sidebar-brand" style="flex-direction: column; text-align: center; gap: 12px; padding: 20px 12px;">
  <div class="brand-logo">
    <img src="<?= base_url('assets/img/bappeda.png') ?>" 
         alt="Logo Bappeda Banyuwangi" 
         width="120" 
         height="60"
         style="display: block; margin: 0 auto;">
  </div>
  <div class="brand-text">
    <div class="brand-name" style="font-size: 14px; font-weight: 700;">SMB Bappeda</div>
    <div class="brand-sub" style="font-size: 9px; line-height: 1.4; color: rgba(255,255,255,0.5);">
      Sistem Manajemen Kantor<br>Bappeda Banyuwangi
    </div>
  </div>
</div>

    <nav class="sidebar-nav">
      <div class="nav-section">Menu Utama</div>
      <div class="nav-item active" data-panel="dashboard" onclick="navigate(this)">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
          <path d="M2 11h7V2H2v9zm0 7h7v-5H2v5zm9 0h7v-9h-7v9zm0-16v5h7V2h-7z"/>
        </svg>
        Dashboard
      </div>

      <!-- ============================================================
     MENU BIDANG SESUAI STRUKTUR ORGANISASI
     ============================================================ -->
<div class="nav-section">Menu Bidang</div>

<!-- Kepala Badan -->
<div class="nav-item" id="nav-bkepala" onclick="toggleBidang('kepala','Kepala Badan')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
  </svg>
  Kepala Badan
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-bkepala">
  <div class="sub-item" onclick="navigateDok('kepala','Kepala Badan')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>

<!-- Sekretariat -->
<div class="nav-item" id="nav-bsekretariat" onclick="toggleBidang('sekretariat','Sekretariat')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
    <path d="M8 7h4M8 10h4M8 13h2"/>
  </svg>
  Sekretariat
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-bsekretariat">
  <div class="sub-item" onclick="navigateDok('sekretariat','Sekretariat')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>

<!-- Bidang Perencanaan Pembangunan -->
<div class="nav-item" id="nav-bperencanaan" onclick="toggleBidang('perencanaan','Bidang Perencanaan Pembangunan')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 010 2H7a1 1 0 01-1-1zm1 3a1 1 0 000 2h4a1 1 0 000-2H7z" clip-rule="evenodd"/>
  </svg>
  Bidang Perencanaan Pembangunan
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-bperencanaan">
  <div class="sub-item" onclick="navigateDok('perencanaan','Perencanaan Pembangunan')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>

<!-- Bidang Ekonomi -->
<div class="nav-item" id="nav-bekonomi" onclick="toggleBidang('ekonomi','Bidang Ekonomi')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path d="M4 4h12v2H4V4zM4 8h12v2H4V8zM4 12h8v2H4v-2z"/>
    <path d="M16 12l-4 4-2-2-2 2-4-4"/>
  </svg>
  Bidang Ekonomi
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-bekonomi">
  <div class="sub-item" onclick="navigateDok('ekonomi','Ekonomi')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>

<!-- Bidang Sarana, Prasarana Wilayah dan Lingkungan -->
<div class="nav-item" id="nav-bsarpras" onclick="toggleBidang('sarpras','Bidang Sarana, Prasarana Wilayah dan Lingkungan')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path d="M3 12h14v5H3zM6 7h8v3H6z"/>
    <rect x="5" y="3" width="10" height="4" rx="1"/>
  </svg>
  Bidang Sarpras Wilayah & Lingkungan
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-bsarpras">
  <div class="sub-item" onclick="navigateDok('sarpras','Sarpras')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>

<!-- Bidang Kesejahteraan Rakyat dan Pemerintahan -->
<div class="nav-item" id="nav-bkesra" onclick="toggleBidang('kesra','Bidang Kesejahteraan Rakyat dan Pemerintahan')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path d="M10 2l1.5 4.5L16 5l-2.5 4L16 13l-4.5-1.5L10 16l-1.5-4.5L4 13l2.5-4L4 5l4.5 1.5L10 2z"/>
  </svg>
  Bidang Kesra & Pemerintahan
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-bkesra">
  <div class="sub-item" onclick="navigateDok('kesra','Kesra')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>

<!-- Bidang Penelitian, Pengembangan dan Pengendalian Evaluasi -->
<div class="nav-item" id="nav-blitbang" onclick="toggleBidang('litbang','Bidang Penelitian, Pengembangan dan Pengendalian Evaluasi')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path d="M12 4l1.5 2L16 5l-2 3 2 3-2.5-1L12 12l-1-3.5L9 10l1-3-1-3 2.5 1L12 4z"/>
    <circle cx="7" cy="7" r="3"/>
  </svg>
  Bidang Litbang & Evaluasi
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-blitbang">
  <div class="sub-item" onclick="navigateDok('litbang','Litbang')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>

<!-- Kelompok Jabatan Fungsional -->
<div class="nav-item" id="nav-bfungsional" onclick="toggleBidang('fungsional','Kelompok Jabatan Fungsional')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path d="M7 3a2 2 0 00-2 2v2a2 2 0 002 2h6a2 2 0 002-2V5a2 2 0 00-2-2H7zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h10a2 2 0 002-2v-2a2 2 0 00-2-2H5z"/>
  </svg>
  Kelompok Jabatan Fungsional
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-bfungsional">
  <div class="sub-item" onclick="navigateDok('fungsional','Fungsional')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>

      <div class="nav-section">Aktivitas</div>
      <div class="nav-item" data-panel="log" onclick="navigate(this)">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
        </svg>
        Log Aktivitas
      </div>
      <div class="nav-item" data-panel="printer" onclick="navigate(this)">
    <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
        <path d="M6 9V3H18V9M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 13h12v6H6z"/>
        <rect x="8" y="15" width="4" height="2" fill="white"/>
    </svg>
    Manajemen Printer
</div>
      <div class="nav-item" data-panel="laporan" onclick="navigate(this)">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
        </svg>
        Print Laporan
      </div>


      <div class="nav-section">App Lainnya</div>
      <div class="nav-item" data-panel="satu-data" onclick="navigate(this)">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
          <path d="M10 2C6.686 2 4 3.343 4 5s2.686 3 6 3 6-1.343 6-3-2.686-3-6-3zM4 7v3c0 1.657 2.686 3 6 3s6-1.343 6-3V7c0 1.657-2.686 3-6 3S4 8.657 4 7zm0 5v3c0 1.657 2.686 3 6 3s6-1.343 6-3v-3c0 1.657-2.686 3-6 3S4 13.657 4 12z"/>
        </svg>
        Satu Data
      </div>
      <div class="nav-item" data-panel="eklpi" onclick="navigate(this)">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd"/>
          <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 01-2-2v-2z"/>
        </svg>
        E-SAKIP
      </div>
      <div class="nav-item" data-panel="sipd" onclick="navigate(this)">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
          <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5 8.118V12c0 .414.168.789.44 1.06A8.06 8.06 0 0010 15a8.06 8.06 0 004.56-1.94A1.5 1.5 0 0015 12V8.118l2.394-1.198a1 1 0 000-1.84l-7-3z"/>
        </svg>
        SIPD
      </div>

      <div class="nav-section">Sistem</div>
      <div class="nav-item" data-panel="settings" onclick="navigate(this)">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
        </svg>
        Settings
      </div>
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
      <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
    </svg>
    Logout
  </div>
</div>
  </aside>

  <!-- ============================================================
       MAIN AREA
       ============================================================ -->
  <div class="main-area">

    <!-- TOPBAR -->
    <header class="topbar">
      <div class="search-wrap">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6">
          <circle cx="6.5" cy="6.5" r="4.5"/>
          <path d="M11 11l3 3"/>
        </svg>
        <input type="text" placeholder="Search dokumen, bidang...">
      </div>
      <div class="topbar-spacer"></div>
      <div class="topbar-actions">
        <button class="icon-btn" title="Notifikasi">
          <svg viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
          </svg>
          <span class="notif-badge"></span>
        </button>
        <div class="divider-v"></div>
        <button class="lang-btn">
          <span class="flag">🇬🇧</span>
          English
          <svg viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M2 3.5l3 3 3-3"/>
          </svg>
        </button>
        <div class="divider-v"></div>
        <div class="topbar-user">
  <div class="topbar-avatar"><?= $initial ?></div>
  <div>
    <div class="topbar-uname"><?= htmlspecialchars($display_name) ?></div>
    <div class="topbar-urole"><?= $role_name ?></div>
  </div>
</div>
      </div>
    </header>

    <!-- ============================================================
         PAGE CONTENT
         ============================================================ -->
    <main class="page-content">

      <!-- ======== DASHBOARD PANEL ======== -->
      <section id="panel-dashboard" class="panel active">

        <div class="page-hdr">
  <div>
    <div style="font-size:12px; color:var(--text-2); margin-bottom:2px;" id="greeting-date"></div>
    <div style="font-family:var(--font-main); font-size:18px; font-weight:700; letter-spacing:-0.02em;">
      Selamat Datang, <span style="color:var(--blue-600);"><?= htmlspecialchars($display_name) ?></span>!
    </div>
  </div>
  <span class="badge-role"><?= $role_name ?></span>
</div>
<!-- HERO BANNER -->
<div class="hero-banner">
  <div class="hero-left">
    <div class="hero-eyebrow" id="hero-date-text"></div>
    <div class="hero-title">Sistem Manajemen Kantor<br>dan Perencanaan</div>
    <div class="hero-sub">Bappeda Kabupaten Banyuwangi</div>
    <button class="hero-btn">
      Get Started
      <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8">
        <path d="M2 7h10M8 3l4 4-4 4"/>
      </svg>
    </button>
  </div>
  <div class="hero-right">
    <div class="hero-card">
      <div class="hero-card-icon">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M6 2h9l4 4v13H6V2z"/><path d="M14 2v5h5"/><path d="M9 12h6M9 15h4"/>
        </svg>
      </div>
      <div class="hero-card-num">0</div>
      <div class="hero-card-label">Total Dokumen</div>
    </div>
    <div class="hero-card">
      <div class="hero-card-icon">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M6 9V3H18V9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="13" width="12" height="6"/>
        </svg>
      </div>
      <div class="hero-card-num">4</div>
      <div class="hero-card-label">Printer Aktif</div>
    </div>
    <div class="hero-card">
      <div class="hero-card-icon">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="10" cy="10" r="8"/><path d="M10 6v4l3 2"/>
        </svg>
      </div>
      <div class="hero-card-num">0</div>
      <div class="hero-card-label">Total User</div>
    </div>
  </div>
</div>
<!-- STATS -->
<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-label">Total User</div>
    <div class="stat-row">
      <div class="stat-val">0</div>
      <div class="stat-icon" style="background:#eff4ff;">
        <svg viewBox="0 0 20 20" fill="var(--blue-600)">
          <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
        </svg>
      </div>
    </div>
    <div class="stat-divider"></div>
    <div class="stat-trend trend-up">
      <span class="trend-dot">↑</span> 8.5% dari kemarin
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-label">Total Dokumen</div>
    <div class="stat-row">
      <div class="stat-val">0</div>
      <div class="stat-icon" style="background:#fffbeb;">
        <svg viewBox="0 0 20 20" fill="var(--amber)">
          <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
        </svg>
      </div>
    </div>
    <div class="stat-divider"></div>
    <div class="stat-trend trend-up">
      <span class="trend-dot">↑</span> 1.3% dari minggu lalu
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-label">Dokumen Selesai</div>
    <div class="stat-row">
      <div class="stat-val">0</div>
      <div class="stat-icon" style="background:var(--green-bg);">
        <svg viewBox="0 0 20 20" fill="var(--green)">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
      </div>
    </div>
    <div class="stat-divider"></div>
    <div class="stat-trend trend-down">
      <span class="trend-dot">↓</span> 4.3% dari kemarin
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-label">Dokumen On Going</div>
    <div class="stat-row">
      <div class="stat-val">0</div>
      <div class="stat-icon" style="background:#eff4ff;">
        <svg viewBox="0 0 20 20" fill="var(--blue-600)">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
        </svg>
      </div>
    </div>
    <div class="stat-divider"></div>
    <div class="stat-trend trend-up">
      <span class="trend-dot">↑</span> 1.8% dari kemarin
    </div>
  </div>
</div>
        <!-- CONTENT GRID -->
        <div class="content-grid">

          <!-- Log Aktivitas -->
          <div class="card">
            <div class="card-head">
              <div class="card-title">Log Aktivitas Terbaru</div>
              <span class="card-action" onclick="navigateToPanel('log')">Lihat semua →</span>
            </div>
            <div class="act-list">
              <div class="act-item">
                <div class="act-icon" style="background:#eff4ff;">
                  <svg viewBox="0 0 16 16" fill="var(--blue-600)"><path d="M4 2a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H4zm1 3h6v1H5V5zm0 3h6v1H5V8zm0 3h4v1H5v-1z"/></svg>
                </div>
                <div class="act-text">
                  <div class="act-title">Upload dokumen baru</div>
                  <div class="act-sub">Bidang A — SK Kepala Dinas No.12</div>
                </div>
                <div class="act-time">09:14</div>
              </div>
              <div class="act-item">
                <div class="act-icon" style="background:var(--green-bg);">
                  <svg viewBox="0 0 16 16" fill="var(--green)"><path d="M2 4a2 2 0 012-2h5l2 2h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V4z"/><path fill="white" d="M7 9.5l-1.5-1.5-.7.7 2.2 2.2 3.2-3.2-.7-.7L7 9.5z"/></svg>
                </div>
                <div class="act-text">
                  <div class="act-title">Print selesai</div>
                  <div class="act-sub">Printer Canon G3010 — 3 halaman</div>
                </div>
                <div class="act-time">08:52</div>
              </div>
              <div class="act-item">
                <div class="act-icon" style="background:var(--amber-bg);">
                  <svg viewBox="0 0 16 16" fill="var(--amber)"><path d="M8 1a7 7 0 100 14A7 7 0 008 1zm0 3a1 1 0 011 1v3a1 1 0 01-2 0V5a1 1 0 011-1zm0 8a1 1 0 100-2 1 1 0 000 2z"/></svg>
                </div>
                <div class="act-text">
                  <div class="act-title">Review dokumen</div>
                  <div class="act-sub">Bidang C — Proposal Anggaran Q2</div>
                </div>
                <div class="act-time">08:30</div>
              </div>
              <div class="act-item">
                <div class="act-icon" style="background:#eff4ff;">
                  <svg viewBox="0 0 16 16" fill="var(--blue-600)"><path d="M8 8a3 3 0 100-6 3 3 0 000 6zm-4 5a4 4 0 018 0H4z"/></svg>
                </div>
                <div class="act-text">
                  <div class="act-title">User baru login</div>
                  <div class="act-sub">Rini Marlina — Bidang B</div>
                </div>
                <div class="act-time">08:01</div>
              </div>
            </div>
          </div>

          <!-- Status Printer -->
          <div class="card">
            <div class="card-head">
              <div class="card-title">Status Printer</div>
              <span class="card-action">Kelola →</span>
            </div>
            <div class="printer-list">
              <div class="printer-item">
                <div class="status-dot dot-online"></div>
                <div class="printer-info">
                  <div class="printer-name">Canon G3010</div>
                  <div class="printer-loc">Lantai 1 — Bidang A · 12 antrian</div>
                </div>
                <span class="printer-badge p-online">Online</span>
              </div>
              <div class="printer-item">
                <div class="status-dot dot-online"></div>
                <div class="printer-info">
                  <div class="printer-name">Epson L3110</div>
                  <div class="printer-loc">Lantai 2 — Bidang B · 5 antrian</div>
                </div>
                <span class="printer-badge p-online">Online</span>
              </div>
              <div class="printer-item">
                <div class="status-dot dot-idle"></div>
                <div class="printer-info">
                  <div class="printer-name">HP LaserJet Pro</div>
                  <div class="printer-loc">Lantai 2 — Bidang C · 0 antrian</div>
                </div>
                <span class="printer-badge p-idle">Idle</span>
              </div>
              <div class="printer-item">
                <div class="status-dot dot-offline"></div>
                <div class="printer-info">
                  <div class="printer-name">Brother HL-2370</div>
                  <div class="printer-loc">Lantai 3 — Bidang D</div>
                </div>
                <span class="printer-badge p-offline">Offline</span>
              </div>
            </div>
          </div>

          <!-- Dokumen Terkini -->
          <div class="card span-full">
            <div class="table-toolbar">
              <div class="card-title">Dokumen Terkini</div>
              <div class="table-toolbar-right">
                <select class="sel-filter">
                  <option>Semua Bidang</option>
                  <option>Bidang A</option>
                  <option>Bidang B</option>
                  <option>Bidang C</option>
                  <option>Bidang D</option>
                </select>
                <div class="mini-search">
                  <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="5.5" cy="5.5" r="4"/><path d="M9 9l2.5 2.5"/>
                  </svg>
                  <input type="text" placeholder="Cari dokumen...">
                </div>
              </div>
            </div>
            <table class="tbl">
              <thead>
                <tr>
                  <th style="width:40px;">No</th>
                  <th>Nama Dokumen</th>
                  <th>Bidang</th>
                  <th>Tanggal</th>
                  <th>Status</th>
                  <th style="width:50px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr><td>1</td><td>SK Kepala Dinas No.12/2026</td><td>Bidang A</td><td>20 Apr 2026</td><td><span class="pill pill-done">Selesai</span></td><td><span class="link-act">Lihat</span></td></tr>
                <tr><td>2</td><td>Proposal Anggaran Q2 2026</td><td>Bidang C</td><td>19 Apr 2026</td><td><span class="pill pill-review">Review</span></td><td><span class="link-act">Lihat</span></td></tr>
                <tr><td>3</td><td>Laporan Monitoring Bulanan</td><td>Bidang B</td><td>18 Apr 2026</td><td><span class="pill pill-progress">On Going</span></td><td><span class="link-act">Lihat</span></td></tr>
                <tr><td>4</td><td>Nota Dinas Koordinasi Lintas</td><td>Bidang D</td><td>17 Apr 2026</td><td><span class="pill pill-done">Selesai</span></td><td><span class="link-act">Lihat</span></td></tr>
                <tr><td>5</td><td>Rencana Kerja Tahunan 2026</td><td>Bidang A</td><td>16 Apr 2026</td><td><span class="pill pill-progress">On Going</span></td><td><span class="link-act">Lihat</span></td></tr>
              </tbody>
            </table>
          </div>

        </div>
      </section>

     <!-- ======== BIDANG / DOKUMEN PANEL ======== -->
<section id="panel-bidang" class="panel">
  <div class="page-hdr">
    <div class="page-hdr-left">
      <div class="page-hdr-icon">
        <svg viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 010 2H7a1 1 0 01-1-1zm1 3a1 1 0 000 2h4a1 1 0 000-2H7z" clip-rule="evenodd"/>
        </svg>
      </div>
      <div>
        <div class="page-hdr-title" id="bidang-title">Bidang Penelitian, Pengembangan dan Pengendalian Evaluasi</div>
        <div class="page-hdr-sub" id="bidang-subtitle">Manajemen Dokumen Litbang</div>
      </div>
    </div>
    <button class="btn btn-primary" onclick="openUploadModal(currentBidangId)">
  <svg viewBox="0 0 16 16" fill="currentColor" width="14" height="14" style="margin-right:6px;">
    <path d="M8 2a1 1 0 011 1v4h4a1 1 0 010 2H9v4a1 1 0 01-2 0V9H3a1 1 0 010-2h4V3a1 1 0 011-1z"/>
  </svg>
  Upload Dokumen
</button>
  </div>
<!-- Category Cards -->
<div class="doc-cat-grid">
  <!-- Card Surat Keputusan -->
  <div class="doc-cat-card">
    <div class="doc-cat-icon" style="background:#eff4ff;">
      <svg viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <polyline points="14 2 14 8 20 8"/>
        <line x1="16" y1="13" x2="8" y2="13"/>
        <line x1="16" y1="17" x2="8" y2="17"/>
        <polyline points="10 9 9 9 8 9"/>
      </svg>
    </div>
    <div class="doc-cat-name">Surat Keputusan</div>
    <div class="doc-cat-count" id="count-sk-bidang">0 dokumen</div>
  </div>

  <!-- Card Laporan -->
  <div class="doc-cat-card">
    <div class="doc-cat-icon" style="background:#fffbeb;">
      <svg viewBox="0 0 24 24" fill="none" stroke="var(--amber)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 12v3a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-3"/>
        <path d="M12 2v8l3-3-3-3z"/>
        <path d="M12 10V2"/>
        <path d="M12 10l-3-3 3-3z"/>
        <line x1="5" y1="15" x2="19" y2="15"/>
      </svg>
    </div>
    <div class="doc-cat-name">Laporan</div>
    <div class="doc-cat-count" id="count-laporan-bidang">0 dokumen</div>
  </div>

  <!-- Card Nota Dinas -->
  <div class="doc-cat-card">
    <div class="doc-cat-icon" style="background:var(--green-bg);">
      <svg viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 4h16v16H4z"/>
        <line x1="8" y1="8" x2="16" y2="8"/>
        <line x1="8" y1="12" x2="16" y2="12"/>
        <line x1="8" y1="16" x2="12" y2="16"/>
        <path d="M18 4L14 8"/>
        <path d="M6 20L10 16"/>
      </svg>
    </div>
    <div class="doc-cat-name">Nota Dinas</div>
    <div class="doc-cat-count" id="count-nota-bidang">0 dokumen</div>
  </div>
</div>

  <!-- Table -->
<div class="card">
  <div class="table-toolbar">
    <div class="card-title" id="bidang-doc-title">Daftar Dokumen — Bidang Penelitian, Pengembangan dan Pengendalian Evaluasi</div>
    <div class="table-toolbar-right">
      <div class="mini-search">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="5.5" cy="5.5" r="4"/><path d="M9 9l2.5 2.5"/>
        </svg>
        <input type="text" id="bidang-search" placeholder="Cari dokumen..." oninput="filterBidangTable()">
      </div>
      <select class="sel-filter" id="bidang-status-filter" onchange="filterBidangTable()">
        <option value="">Semua Status</option>
        <option value="Selesai">Selesai</option>
        <option value="Review">Review</option>
        <option value="On Going">On Going</option>
      </select>
      
    </div>
  </div>
  <div class="table-responsive">
    <table class="tbl">
      <thead>
        <tr>
          <th>No</th>
          <th>Preview</th>
          <th>Nama Dokumen</th>
          <th>Kategori</th>
          <th>Tanggal Upload</th>
          <th>Diupload Oleh</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="bidang-tbody">
        <tr>
          <td colspan="8" class="empty-state-table">
            <div class="icon">📂</div>
            <p>Pilih bidang dari menu sidebar untuk melihat dokumen</p>
           </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</section>

      <!-- ======== LOG AKTIVITAS ======== -->
<section id="panel-log" class="panel">
  <div class="page-hdr">
    <div class="page-hdr-left">
      <div class="page-hdr-icon">
        <svg viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
        </svg>
      </div>
      <div>
        <div class="page-hdr-title">Log Aktivitas</div>
        <div class="page-hdr-sub">Riwayat seluruh aktivitas sistem</div>
      </div>
    </div>
    <button class="btn" onclick="exportLogToPDF()">
      <svg viewBox="0 0 14 14" fill="currentColor" width="14" height="14" style="margin-right:6px;">
        <path d="M7 1a6 6 0 100 12A6 6 0 007 1zm1 9H6V6h2v4zm0-5H6V3h2v2z"/>
      </svg>
      Export PDF
    </button>
  </div>
  <div class="card">
  <div class="table-toolbar">
    <div class="card-title">
      <i class="fas fa-history"></i> Riwayat Aktivitas
    </div>
    <div class="table-toolbar-right">
      <!-- FILTER TANGGAL -->
      <div class="date-range-filter" style="display: flex; gap: 8px; align-items: center;">
        <div class="mini-search">
          <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect x="1" y="2" width="12" height="11" rx="1" stroke="currentColor"/>
            <line x1="4" y1="1" x2="4" y2="4" stroke="currentColor"/>
            <line x1="10" y1="1" x2="10" y2="4" stroke="currentColor"/>
            <line x1="1" y1="6" x2="13" y2="6" stroke="currentColor"/>
          </svg>
          <input type="date" id="log-date-start" placeholder="Dari Tanggal" style="width: 130px;">
        </div>
        <span style="color: var(--text-3);">s.d.</span>
        <div class="mini-search">
          <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect x="1" y="2" width="12" height="11" rx="1" stroke="currentColor"/>
            <line x1="4" y1="1" x2="4" y2="4" stroke="currentColor"/>
            <line x1="10" y1="1" x2="10" y2="4" stroke="currentColor"/>
            <line x1="1" y1="6" x2="13" y2="6" stroke="currentColor"/>
          </svg>
          <input type="date" id="log-date-end" placeholder="Sampai Tanggal" style="width: 130px;">
        </div>
        <button class="btn btn-sm" onclick="filterLogByDate()" style="background: var(--blue-600); color: white;">
          <svg viewBox="0 0 14 14" fill="currentColor" width="12" height="12">
            <path d="M12 8a4 4 0 0 1-8 0M4 6a4 4 0 0 1 8 0M7 2v4M5 2h4"/>
          </svg>
          Tampilkan
        </button>
      </div>
      <select class="sel-filter" id="log-aksi-filter" onchange="filterLogTable()">
        <option value="">Semua Aksi</option>
        <option value="Upload"> Upload</option>
        <option value="Print"> Print</option>
        <option value="Review"> Review</option>
        <option value="Login"> Login</option>
        <option value="Update"> Update</option>
        <option value="Hapus"> Hapus</option>
      </select>
      <div class="mini-search">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="5.5" cy="5.5" r="4"/><path d="M9 9l2.5 2.5"/>
        </svg>
        <input type="text" id="log-search" placeholder="Cari user, detail, atau IP..." oninput="filterLogTable()">
      </div>
      <button class="btn btn-sm" onclick="refreshLogData()">
        <svg viewBox="0 0 14 14" fill="currentColor" width="12" height="12">
          <path d="M12 8a4 4 0 0 1-8 0M4 6a4 4 0 0 1 8 0M7 2v4M5 2h4"/>
        </svg>
        Refresh
      </button>
    </div>
  </div>
  <div class="log-table-wrapper">
    <table class="log-table">
      <thead>
        <tr>
          <th><i class="fas fa-clock"></i> Waktu</th>
          <th><i class="fas fa-user"></i> User</th>
          <th><i class="fas fa-tag"></i> Aksi</th>
          <th><i class="fas fa-cube"></i> Modul</th>
          <th><i class="fas fa-info-circle"></i> Detail</th>
          <th><i class="fas fa-network-wired"></i> IP Address</th>
        </tr>
      </thead>
      <tbody id="log-tbody">
        <tr><td colspan="6" style="text-align:center;padding:60px;">
          <div class="modern-spinner"></div>
          <p style="margin-top: 10px;">Memuat data log...</p>
        </td></tr>
      </tbody>
    </table>
  </div>
</div>
</section>

      <!-- ======== PRINT LAPORAN ======== -->
      <section id="panel-laporan" class="panel">
        <div class="page-hdr">
          <div class="page-hdr-left">
            <div class="page-hdr-icon">
              <svg viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div>
              <div class="page-hdr-title">Print Laporan</div>
              <div class="page-hdr-sub">Cetak laporan dan dokumen</div>
            </div>
          </div>
          <button class="btn btn-primary">+ Laporan Baru</button>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
          <div class="card span-full" style="grid-column:1/-1;">
            <div class="card-head"><div class="card-title">Konfigurasi Print</div></div>
            <div class="card-body">
              <div class="form-grid">
                <div class="form-group">
                  <label class="form-label">Pilih Printer</label>
                  <select class="form-control">
                    <option>Canon G3010 — Lantai 1 (Online)</option>
                    <option>Epson L3110 — Lantai 2 (Online)</option>
                    <option>HP LaserJet Pro — Lantai 2 (Idle)</option>
                    <option disabled>Brother HL-2370 — Offline</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Jenis Laporan</label>
                  <select class="form-control">
                    <option>Laporan Bulanan</option>
                    <option>Laporan Tahunan</option>
                    <option>Rekap Dokumen Per Bidang</option>
                    <option>Log Aktivitas</option>
                    <option>Rekap Penggunaan Printer</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Pilih Bidang</label>
                  <select class="form-control">
                    <option>Semua Bidang</option>
                    <option>Bidang A</option>
                    <option>Bidang B</option>
                    <option>Bidang C</option>
                    <option>Bidang D</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Format Kertas</label>
                  <select class="form-control">
                    <option>A4 — Portrait</option>
                    <option>A4 — Landscape</option>
                    <option>F4 / Folio</option>
                    <option>Letter</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Periode Dari</label>
                  <input type="date" class="form-control" value="2026-04-01">
                </div>
                <div class="form-group">
                  <label class="form-label">Periode Sampai</label>
                  <input type="date" class="form-control" value="2026-04-20">
                </div>
              </div>
              <div class="form-actions">
                <button class="btn btn-primary">
                  <svg viewBox="0 0 14 14" fill="currentColor"><path d="M2 4a2 2 0 012-2h5l2 2h1.5A1.5 1.5 0 0114 5.5v5A1.5 1.5 0 0112.5 12H10a2 2 0 01-2 2H5a2 2 0 01-2-2H1.5A1.5 1.5 0 010 10.5v-5A1.5 1.5 0 011.5 4H2z"/></svg>
                  Print Sekarang
                </button>
                <button class="btn">
                  <svg viewBox="0 0 14 14" fill="currentColor"><path d="M1 2a1 1 0 011-1h10a1 1 0 011 1v10a1 1 0 01-1 1H2a1 1 0 01-1-1V2z"/></svg>
                  Preview
                </button>
                <button class="btn">
                  <svg viewBox="0 0 14 14" fill="currentColor"><path d="M7 1a6 6 0 100 12A6 6 0 007 1zm1 9H6V6h2v4zm0-5H6V3h2v2z"/></svg>
                  Simpan PDF
                </button>
              </div>
            </div>
          </div>
          <!-- Print History -->
          <div class="card" style="grid-column:1/-1;">
            <div class="card-head"><div class="card-title">Riwayat Print</div></div>
            <table class="tbl">
              <thead>
                <tr><th>Waktu</th><th>Jenis Laporan</th><th>Printer</th><th>Halaman</th><th>User</th><th>Status</th></tr>
              </thead>
              <tbody>
                <tr><td>20/04 08:52</td><td>Laporan Bulanan</td><td>Canon G3010</td><td>3</td><td>Operator</td><td><span class="pill pill-done">Selesai</span></td></tr>
                <tr><td>19/04 11:30</td><td>Rekap Dokumen</td><td>Epson L3110</td><td>8</td><td>Admin</td><td><span class="pill pill-done">Selesai</span></td></tr>
                <tr><td>18/04 14:10</td><td>Log Aktivitas</td><td>HP LaserJet</td><td>12</td><td>Admin</td><td><span class="pill pill-done">Selesai</span></td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ======== SATU DATA ======== -->
      <section id="panel-satu-data" class="panel">
  <div class="page-hdr">
    <div class="page-hdr-left">
      <div class="page-hdr-icon">
        <svg viewBox="0 0 20 20" fill="currentColor"><path d="M10 2C6.686 2 4 3.343 4 5s2.686 3 6 3 6-1.343 6-3-2.686-3-6-3zM4 7v3c0 1.657 2.686 3 6 3s6-1.343 6-3V7c0 1.657-2.686 3-6 3S4 8.657 4 7zm0 5v3c0 1.657 2.686 3 6 3s6-1.343 6-3v-3c0 1.657-2.686 3-6 3S4 13.657 4 12z"/></svg>
      </div>
      <div>
        <div class="page-hdr-title">Satu Data</div>
        <div class="page-hdr-sub">Portal data terintegrasi Bappeda</div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="empty-state">
        <img src="<?= base_url('assets/img/bappeda.png') ?>" 
     alt="Logo Bappeda Banyuwangi" 
     width="40" 
     height="40"
     style="object-fit: contain;">
        <p>Modul Satu Data terintegrasi dengan portal data Bappeda Banyuwangi.<br>Klik tombol di bawah untuk mengakses.</p>
        <br>
        <!-- Tombol dengan link eksternal - MEMBUKA TAB BARU -->
        <a href="https://satudata.banyuwangikab.go.id/pppa" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="btn btn-primary">
          
          Buka Portal Satu Data PPPA
        </a>
      </div>
    </div>
  </div>
</section>

      <section id="panel-eklpi" class="panel">
  <div class="page-hdr">
    <div class="page-hdr-left">
      <div class="page-hdr-icon">
        <img src="<?= base_url('assets/img/bappeda.png') ?>" 
             alt="Logo Bappeda Banyuwangi" 
             width="24" 
             height="24"
             style="object-fit: contain;">
      </div>
      <div>
        <div class="page-hdr-title">E-SAKIP</div>
        <div class="page-hdr-sub">Sistem Akuntabilitas Kinerja Instansi Pemerintah</div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="empty-state">
        <img src="<?= base_url('assets/img/bappeda.png') ?>" 
             alt="Logo Bappeda Banyuwangi" 
             width="80" 
             height="80"
             style="object-fit: contain; margin-bottom: 16px; opacity: 0.7;">
        <p>Sistem E-SAKIP untuk pencatatan, evaluasi, dan pelaporan kinerja pegawai serta akuntabilitas instansi pemerintah Kabupaten Banyuwangi.</p>
        <br>
        <a href="https://e-sakip.banyuwangikab.go.id/" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="btn btn-primary">
          
          Akses E-SAKIP
        </a>
      </div>
    </div>
  </div>
</section>

      <!-- ======== SIPD ======== -->
      <section id="panel-sipd" class="panel">
        <div class="page-hdr">
          <div class="page-hdr-left">
            <div class="page-hdr-icon">
              <svg viewBox="0 0 20 20" fill="currentColor"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5 8.118V12c0 .414.168.789.44 1.06A8.06 8.06 0 0010 15a8.06 8.06 0 004.56-1.94A1.5 1.5 0 0015 12V8.118l2.394-1.198a1 1 0 000-1.84l-7-3z"/></svg>
            </div>
            <div>
              <div class="page-hdr-title">SIPD</div>
              <div class="page-hdr-sub">Sistem Informasi Pemerintah Daerah</div>
            </div>
          </div>
        </div>
        <div class="card"><div class="card-body"><div class="empty-state"><svg viewBox="0 0 20 20" fill="currentColor"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5 8.118V12c0 .414.168.789.44 1.06A8.06 8.06 0 0010 15a8.06 8.06 0 004.56-1.94A1.5 1.5 0 0015 12V8.118l2.394-1.198a1 1 0 000-1.84l-7-3z"/></svg><p>Sistem Informasi Pemerintah Daerah (SIPD) Kabupaten Banyuwangi.</p><br><button class="btn btn-primary">Akses SIPD</button></div></div></div>
      </section>
      <!-- ======== MANAJEMEN PRINTER ======== -->
<section id="panel-printer" class="panel">
    <div class="page-hdr">
        <div class="page-hdr-left">
            <div class="page-hdr-icon">
                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path d="M6 9V3H18V9M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 13h12v6H6z"/>
                </svg>
            </div>
            <div>
                <div class="page-hdr-title">Manajemen Printer</div>
                <div class="page-hdr-sub">Kelola printer, stock kertas, dan pengaturan</div>
            </div>
        </div>
        <button class="btn btn-primary" onclick="showAddPrinterModal()">
            <svg viewBox="0 0 16 16" fill="currentColor" width="14" height="14">
                <path d="M8 2a1 1 0 011 1v4h4a1 1 0 010 2H9v4a1 1 0 01-2 0V9H3a1 1 0 010-2h4V3a1 1 0 011-1z"/>
            </svg>
            Tambah Printer
        </button>
    </div>

    <!-- Statistik Ringkas -->
    <div class="stat-grid" style="margin-bottom:20px;">
        <div class="stat-card">
            <div class="stat-label">Total Printer</div>
            <div class="stat-row">
                <div class="stat-val" id="printer-total-count">0</div>
                <div class="stat-icon" style="background:#eff4ff;">
                    <svg viewBox="0 0 20 20" fill="var(--blue-600)"><path d="M6 9V3H18V9M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/></svg>
                </div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend" id="printer-total-trend">Total semua printer</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Printer Online</div>
            <div class="stat-row">
                <div class="stat-val" id="printer-online-count">0</div>
                <div class="stat-icon" style="background:var(--green-bg);">
                    <svg viewBox="0 0 20 20" fill="var(--green)"><circle cx="10" cy="10" r="8"/></svg>
                </div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend trend-up" id="printer-online-trend">Siap digunakan</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Kertas</div>
            <div class="stat-row">
                <div class="stat-val" id="printer-paper-total">0</div>
                <div class="stat-icon" style="background:#fffbeb;">
                    <svg viewBox="0 0 20 20" fill="var(--amber)"><path d="M4 4h12v12H4z"/></svg>
                </div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend" id="printer-paper-trend">Total stock kertas</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Print</div>
            <div class="stat-row">
                <div class="stat-val" id="printer-print-total">0</div>
                <div class="stat-icon" style="background:#dbeafe;">
                    <svg viewBox="0 0 20 20" fill="var(--blue-600)"><path d="M6 9V3H18V9M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/></svg>
                </div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend" id="printer-print-trend">Total dokumen tercetak</div>
        </div>
    </div>

    <!-- Daftar Printer -->
    <div class="card">
        <div class="card-head">
            <div class="card-title">
                <i class="fas fa-print"></i> Daftar Printer
            </div>
            <div class="table-toolbar-right">
                <div class="mini-search">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor">
                        <circle cx="5.5" cy="5.5" r="4"/><path d="M9 9l2.5 2.5"/>
                    </svg>
                    <input type="text" id="printer-search" placeholder="Cari printer..." oninput="filterPrinterList()">
                </div>
                <button class="btn btn-sm" onclick="refreshPrinterList()">
                    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M12 8a4 4 0 0 1-8 0M4 6a4 4 0 0 1 8 0M7 2v4M5 2h4"/></svg>
                    Refresh
                </button>
            </div>
        </div>
        <div id="printer-list-manager" style="padding:16px;">
            <div class="empty-state">
                <div class="modern-spinner"></div>
                <p>Memuat daftar printer...</p>
            </div>
        </div>
    </div>
</section>

      <!-- ======== SETTINGS ======== -->
      <section id="panel-settings" class="panel">
        <div class="page-hdr">
          <div class="page-hdr-left">
            <div class="page-hdr-icon">
              <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/></svg>
            </div>
            <div>
              <div class="page-hdr-title">Settings</div>
              <div class="page-hdr-sub">Konfigurasi dan pengaturan sistem</div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-head"><div class="card-title">Pengaturan Umum</div></div>
          <div class="card-body">
            <div class="form-grid">
              <div class="form-group">
                <label class="form-label">Nama Instansi</label>
                <input type="text" class="form-control" value="Bappeda Kabupaten Banyuwangi">
              </div>
              <div class="form-group">
                <label class="form-label">Tahun Anggaran</label>
                <input type="text" class="form-control" value="2026">
              </div>
              <div class="form-group">
                <label class="form-label">Zona Waktu</label>
                <select class="form-control">
                  <option>WIB (UTC+7)</option>
                  <option>WITA (UTC+8)</option>
                  <option>WIT (UTC+9)</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Bahasa</label>
                <select class="form-control">
                  <option>Bahasa Indonesia</option>
                  <option>English</option>
                </select>
              </div>
            </div>
            <div class="form-actions">
              <button class="btn btn-primary">Simpan Pengaturan</button>
              <button class="btn">Reset Default</button>
            </div>
          </div>
        </div>
      </section>
<!-- Modal Upload Dokumen -->
<div id="modalUpload" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000; align-items:center; justify-content:center;">
  <div style="background:#fff; border-radius:16px; width:500px; max-width:90%; padding:24px;">
    <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
      <h3 style="font-size:18px;">Upload Dokumen</h3>
      <span onclick="closeUploadModal()" style="cursor:pointer; font-size:24px;">&times;</span>
    </div>
    <form id="formUploadDokumen" enctype="multipart/form-data">
      <input type="hidden" name="id_bidang" id="upload_id_bidang">
      <div class="form-group" style="margin-bottom:15px;">
        <label class="form-label">Nama Dokumen</label>
        <input type="text" name="nama_dokumen" class="form-control" required>
      </div>
      <div class="form-group" style="margin-bottom:15px;">
        <label class="form-label">Kategori</label>
        <select name="kategori" class="form-control" required>
  <option value="Surat Keputusan">Surat Keputusan</option>
  <option value="Laporan">Laporan</option>
  <option value="Nota Dinas">Nota Dinas</option>
</select>
      </div>
      <div class="form-group" style="margin-bottom:15px;">
        <label class="form-label">Status</label>
        <select name="status" class="form-control">
          <option value="Selesai">Selesai</option>
          <option value="Review">Review</option>
          <option value="On Going">On Going</option>
        </select>
      </div>
      <div class="form-group" style="margin-bottom:15px;">
        <label class="form-label">File Dokumen</label>
        <input type="file" name="file_dokumen" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png" required>
      </div>
      <div style="display:flex; gap:10px; margin-top:20px;">
        <button type="submit" class="btn btn-primary">Upload</button>
        <button type="button" class="btn" onclick="closeUploadModal()">Batal</button>
      </div>
    </form>
  </div>
</div>
<!-- Modal Preview Dokumen -->
<div id="modalPreview" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:1001; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:16px; width:850px; max-width:90%; max-height:90%; overflow:auto; padding:20px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h3 id="previewTitle" style="font-size:18px;">Preview Dokumen</h3>
            <div>
                <button class="btn btn-primary btn-sm" id="printFromPreviewBtn" style="margin-right:10px; background:#16a34a; color:white;">
                    <i class="fas fa-print"></i> Print Dokumen
                </button>
                <button class="btn btn-danger btn-sm" onclick="closePreviewModal()" style="background:#dc2626; color:white;">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
        <div id="previewContent" style="text-align:center;"></div>
    </div>
</div>

<!-- Modal Print Dokumen - VERSI LANGSUNG PRINT -->
<div id="modalPrint" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1002; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:16px; width:450px; max-width:90%; padding:24px;">
        <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
            <h3 style="font-size:18px;">
                <i class="fas fa-print"></i> Print Dokumen
            </h3>
            <span onclick="closePrintModal()" style="cursor:pointer; font-size:24px;">&times;</span>
        </div>
        
        <div id="print-dokumen-info" style="margin-bottom:20px; padding:12px; background:#e0e7ff; border-radius:8px;">
            <strong>📄 Dokumen:</strong> <span id="print-dokumen-nama"></span><br>
            <strong>📏 Estimasi Halaman:</strong> <span id="print-estimasi-halaman">1</span> halaman
        </div>
        
        <!-- Informasi Printer Default -->
        <div id="default-printer-info" style="margin-bottom:15px; padding:12px; background:var(--page-bg); border-radius:8px;">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <span style="font-size:12px; color:var(--text-2);">🖨️ Printer Default:</span>
                    <strong id="default-printer-name">Memuat...</strong>
                </div>
                <button class="btn btn-sm" onclick="openPrinterManager()" style="padding:4px 8px; font-size:11px;">
                    <i class="fas fa-cog"></i> Ganti
                </button>
            </div>
            <div id="default-printer-stock" style="font-size:11px; color:var(--text-3); margin-top:5px;"></div>
        </div>
        
        <!-- Jumlah Copy -->
        <div class="form-group" style="margin-bottom:15px;">
            <label class="form-label">Jumlah Copy</label>
            <input type="number" id="print-jumlah-copy" class="form-control" value="1" min="1" max="10" onchange="updatePrintSummarySimple()">
        </div>
        
        <!-- Ringkasan -->
        <div id="print-summary-simple" class="print-summary" style="margin-bottom:15px;"></div>
        
        <!-- Actions -->
        <div style="display:flex; gap:10px; margin-top:20px;">
            <button class="btn btn-primary" onclick="executePrintSimple()" style="flex:1;">
                <i class="fas fa-print"></i> Print Sekarang
            </button>
            <button class="btn" onclick="closePrintModal()">Batal</button>
        </div>
    </div>
</div>
<!-- Library untuk generate PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  let currentPreviewDokumen = null;
// ================= LOGOUT FUNCTION =================
// ================= LOGOUT FUNCTION (PERBAIKAN) =================
function handleLogout() {
  Swal.fire({
    title: 'Yakin ingin keluar?',
    text: 'Anda akan keluar dari sistem',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#dc2626',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Keluar',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {

      // Loading
      Swal.fire({
        title: 'Logout...',
        text: 'Menghapus session',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });

      // REQUEST KE SERVER
      fetch('<?= base_url('IDE/SmbLogout') ?>', {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
      .then(data => {
        console.log('Logout response:', data);
        
        // Hapus session frontend
        localStorage.clear();
        sessionStorage.clear();
        
        // Hapus semua cookie
        document.cookie.split(";").forEach(function(c) {
          document.cookie = c.replace(/^ +/, "")
            .replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
        });
        
        // Redirect ke halaman login
        Swal.fire({
          title: 'Berhasil Logout!',
          text: 'Anda telah keluar dari sistem',
          icon: 'success',
          timer: 1500,
          showConfirmButton: false
        }).then(() => {
          // Gunakan base_url untuk redirect
          window.location.href = '<?= base_url('IDE/SmbLoginPage') ?>';
        });
        
      })
      .catch(error => {
        console.error('Logout error:', error);
        
        // Fallback: tetap redirect ke login meskipun ada error
        localStorage.clear();
        sessionStorage.clear();
        
        Swal.fire({
          title: 'Logout Berhasil',
          text: 'Mengalihkan ke halaman login...',
          icon: 'success',
          timer: 1000,
          showConfirmButton: false
        }).then(() => {
          window.location.href = '<?= base_url('IDE/SmbLoginPage') ?>';
        });
      });
    }
  });
}

// ================= PASANG EVENT LISTENER KE TOMBOL LOGOUT =================
// Pastikan DOM sudah siap
document.addEventListener('DOMContentLoaded', function() {
  // Cari tombol logout
  const logoutBtn = document.querySelector('.logout-btn');
  
  if (logoutBtn) {
    console.log('Tombol logout ditemukan, memasang event listener...');
    
    // Hapus event listener lama jika ada (untuk menghindari duplikasi)
    logoutBtn.removeEventListener('click', handleLogout);
    
    // Pasang event listener baru
    logoutBtn.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      handleLogout();
    });
    
    // Tambahkan style cursor pointer (sudah ada di CSS, tapi dipastikan)
    logoutBtn.style.cursor = 'pointer';
    
  } else {
    console.error('Tombol logout TIDAK ditemukan!');
    
    // Alternatif: cari berdasarkan class lain atau teks
    const possibleLogout = document.querySelector('.sidebar-footer div:last-child');
    if (possibleLogout && possibleLogout.textContent.includes('Logout')) {
      console.log('Alternatif logout ditemukan');
      possibleLogout.addEventListener('click', handleLogout);
      possibleLogout.style.cursor = 'pointer';
    }
  }
});

// ================= MAPPING BIDANG SESUAI STRUKTUR =================
const bidangFullName = {
  kepala: 'Kepala Badan',
  sekretariat: 'Sekretariat',
  perencanaan: 'Bidang Perencanaan Pembangunan',
  ekonomi: 'Bidang Ekonomi',
  sarpras: 'Bidang Sarana, Prasarana Wilayah dan Lingkungan',
  kesra: 'Bidang Kesejahteraan Rakyat dan Pemerintahan',
  litbang: 'Bidang Penelitian, Pengembangan dan Pengendalian Evaluasi',
  fungsional: 'Kelompok Jabatan Fungsional'
};

const bidangShortName = {
  kepala: 'Kepala Badan',
  sekretariat: 'Sekretariat',
  perencanaan: 'Perencanaan',
  ekonomi: 'Ekonomi',
  sarpras: 'Sarpras',
  kesra: 'Kesra',
  litbang: 'Litbang',
  fungsional: 'Fungsional'
};

// Data dokumen per bidang (contoh awal)
const bidangData = {
  kepala: { name: 'Kepala Badan', docs: [] },
  sekretariat: { name: 'Sekretariat', docs: [] },
  perencanaan: { name: 'Bidang Perencanaan Pembangunan', docs: [] },
  ekonomi: { name: 'Bidang Ekonomi', docs: [] },
  sarpras: { name: 'Bidang Sarana, Prasarana Wilayah dan Lingkungan', docs: [] },
  kesra: { name: 'Bidang Kesejahteraan Rakyat dan Pemerintahan', docs: [] },
  litbang: { name: 'Bidang Penelitian, Pengembangan dan Pengendalian Evaluasi', docs: [] },
  fungsional: { name: 'Kelompok Jabatan Fungsional', docs: [] }
};

/* ---- NAVIGATION ---- */
function navigate(el) {
  const panel = el.dataset.panel;
  if (!panel) return;
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  el.classList.add('active');
  showPanel(panel);
}

function navigateToPanel(panel) {
  const el = document.querySelector(`.nav-item[data-panel="${panel}"]`);
  if (el) navigate(el);
}

function showPanel(id) {
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
  const target = document.getElementById('panel-' + id);
  if (target) target.classList.add('active');
  document.querySelector('.page-content').scrollTop = 0;
}

function toggleBidang(id, name) {
  const navEl = document.getElementById('nav-b' + id);
  const subEl = document.getElementById('sub-b' + id);
  const isOpen = subEl.classList.contains('open');

  // close all - tambahkan semua id bidang baru
  const allBidang = ['kepala', 'sekretariat', 'perencanaan', 'ekonomi', 'sarpras', 'kesra', 'litbang', 'fungsional'];
  allBidang.forEach(x => {
    const sub = document.getElementById('sub-b' + x);
    const nav = document.getElementById('nav-b' + x);
    if (sub) sub.classList.remove('open');
    if (nav) nav.classList.remove('open', 'active');
  });

  if (!isOpen) {
    subEl.classList.add('open');
    navEl.classList.add('open', 'active');
  }
}

function navigateDok(id) {
  currentBidang = id;
  currentBidangId = id;

  const bidangNama = {
    a: 'Bidang Penelitian, Pengembangan dan Pengendalian Evaluasi',
    b: 'Bidang Perencanaan Pembangunan',
    c: 'Bidang Ekonomi',
    d: 'Bidang Kesejahteraan Rakyat dan Pemerintahan',
    e: 'Bidang Sarana Prasarana Wilayah dan Lingkungan'
  };

  const bidangShort = {
    a: 'Litbang',
    b: 'Perencanaan',
    c: 'Ekonomi',
    d: 'Kesra',
    e: 'Sarpras'
  };

  const fullName = bidangNama[id] || 'Bidang';
  const short = bidangShort[id] || '';

  document.getElementById('bidang-title').textContent = fullName;
  document.getElementById('bidang-doc-title').textContent = `Daftar Dokumen — ${fullName}`;

  const bidangSubtitle = document.querySelector('#panel-bidang .page-hdr-sub');
  if (bidangSubtitle) {
    bidangSubtitle.textContent = `Manajemen Dokumen ${short}`;
  }

  // reset filter
  document.getElementById('bidang-search').value = '';
  document.getElementById('bidang-status-filter').value = '';

  // 🔥 INI WAJIB
  loadDokumenFromDB(id);

  showPanel('bidang');

  document.querySelectorAll('.nav-item[data-panel]').forEach(n => n.classList.remove('active'));

  document.querySelectorAll('.sub-item').forEach(s => s.classList.remove('active'));
  const subItems = document.querySelectorAll('#sub-b' + id + ' .sub-item');
  if (subItems.length) subItems[0].classList.add('active');
}


// ================= UPLOAD DOKUMEN =================
let currentBidangId = null;

function openUploadModal() {
  console.log('currentBidang:', currentBidang);

  // pakai currentBidang, bukan parameter
  if (!currentBidang) {
    Swal.fire({
      icon: 'warning',
      title: 'Pilih bidang dulu!',
      text: 'Silakan pilih bidang sebelum upload dokumen'
    });
    return;
  }

  currentBidangId = currentBidang;

  document.getElementById('upload_id_bidang').value = currentBidang;

  document.getElementById('modalUpload').style.display = 'flex';
}

function closeUploadModal() {
  document.getElementById('modalUpload').style.display = 'none';
  document.getElementById('formUploadDokumen').reset();
}

// Submit upload form
$(document).ready(function() {
  $('#formUploadDokumen').off('submit').on('submit', function(e) {
    e.preventDefault();
    
    // Validasi file
    const fileInput = document.querySelector('input[name="file_dokumen"]');
    if (!fileInput.files || fileInput.files.length === 0) {
      Swal.fire('Error!', 'Pilih file terlebih dahulu', 'error');
      return;
    }
    
    const formData = new FormData(this);
    
    Swal.fire({
      title: 'Uploading...',
      text: 'Mohon tunggu, sedang mengupload dokumen',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });
    
    $.ajax({
      url: '<?= base_url('IDE/upload_dokumen') ?>',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      timeout: 30000,
      success: function(response) {
        Swal.close();
        
        if (response.status === 'success') {
          Swal.fire('Berhasil!', response.message, 'success');
          closeUploadModal();
          // Refresh tabel dokumen
          if (currentBidangId) {
            loadDokumenFromDB(currentBidangId);
          }
          // Refresh dashboard stats
          if (typeof loadDashboardStats === 'function') {
            loadDashboardStats();
          }
        } else {
          Swal.fire('Error!', response.message || 'Gagal upload dokumen', 'error');
        }
      },
      error: function(xhr, status, error) {
        Swal.close();
        let errorMsg = 'Terjadi kesalahan saat upload';
        if (xhr.responseJSON && xhr.responseJSON.message) {
          errorMsg = xhr.responseJSON.message;
        } else if (status === 'timeout') {
          errorMsg = 'Timeout, file terlalu besar atau koneksi lambat';
        }
        Swal.fire('Error!', errorMsg, 'error');
        console.error('Upload error:', error);
      }
    });
  });
});

// ================= LOAD DOKUMEN FROM DATABASE =================
function loadDokumenFromDB(bidangId) {
  if (!bidangId) return;

  console.log('Ambil data dari DB:', bidangId);

  $('#bidang-tbody').html(`
    <tr><td colspan="8" style="text-align:center;padding:40px;">
      <div class="modern-spinner"></div>
      <p>Memuat data...</p>
    </td></tr>
  `);

  $.ajax({
    url: '<?= base_url('IDE/get_dokumen_by_bidang') ?>',
    type: 'POST',
    data: { id_bidang: bidangId },
    dataType: 'json',
    success: function(res) {
      console.log('Response:', res);
      if (res.status === 'success') {
        renderDokumenTable(res.data);
        
        // ========== UPDATE CATEGORY CARDS PER BIDANG ==========
        // Hitung jumlah dokumen per kategori untuk bidang ini
        let countSK = 0;
        let countLaporan = 0;
        let countNota = 0;
        
        res.data.forEach(function(doc) {
          if (doc.kategori === 'Surat Keputusan') countSK++;
          else if (doc.kategori === 'Laporan') countLaporan++;
          else if (doc.kategori === 'Nota Dinas') countNota++;
        });
        
        // Update tampilan category cards di panel bidang
        $('#count-sk-bidang').text(countSK + ' dokumen');
        $('#count-laporan-bidang').text(countLaporan + ' dokumen');
        $('#count-nota-bidang').text(countNota + ' dokumen');
        
        console.log('Kategori counts - SK:', countSK, 'Laporan:', countLaporan, 'Nota:', countNota);
      } else {
        $('#bidang-tbody').html(`<td><td colspan="8">Gagal load数据</td></tr>`);
      }
    },
    error: function() {
      $('#bidang-tbody').html(`<td><td colspan="8">Server error</td></tr>`);
    }
  });
}

// ================= RENDER TABEL DOKUMEN (LENGKAP DENGAN TOMBOL PRINT) =================
function renderDokumenTable(dokumen) {
    const tbody = document.getElementById('bidang-tbody');
    
    // Jika tidak ada dokumen
    if (!dokumen || dokumen.length === 0) {
        tbody.innerHTML = `<tr><td colspan="8" style="text-align:center;padding:60px 20px;color:var(--text-3);">
            <div style="font-size:48px; margin-bottom:15px;">📄</div>
            Belum ada dokumen. Klik tombol "Upload Dokumen" untuk menambahkan.
        </td></tr>`;
        return;
    }
    
    tbody.innerHTML = dokumen.map((doc, index) => {
        // Tentukan thumbnail berdasarkan tipe file
        let thumbnailHtml = '';
        const baseUrl = '<?= base_url() ?>';
        
        if (doc.file_type && doc.file_type.startsWith('image/')) {
            const thumbUrl = doc.thumbnail ? baseUrl + doc.thumbnail : baseUrl + doc.file_path;
            thumbnailHtml = `<img src="${thumbUrl}" class="doc-thumbnail" onclick="previewDokumen('${doc.file_path}', '${doc.file_type}', '${escapeHtml(doc.nama_dokumen)}')" 
                style="width:50px; height:50px; object-fit:cover; border-radius:8px; cursor:pointer; border:1px solid #e2e8f0;" 
                onerror="this.src='${baseUrl}assets/img/no-image.png'">`;
        } else if (doc.file_type === 'application/pdf') {
            thumbnailHtml = `<div onclick="previewDokumen('${doc.file_path}', '${doc.file_type}', '${escapeHtml(doc.nama_dokumen)}')" 
                style="width:50px; height:50px; background:#fee2e2; border-radius:8px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:24px;">
                📄
            </div>`;
        } else {
            thumbnailHtml = `<div onclick="previewDokumen('${doc.file_path}', '${doc.file_type}', '${escapeHtml(doc.nama_dokumen)}')" 
                style="width:50px; height:50px; background:#dbeafe; border-radius:8px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:24px;">
                📎
            </div>`;
        }
        
        const statusClass = doc.status === 'Selesai' ? 'pill-done' : (doc.status === 'Review' ? 'pill-review' : 'pill-progress');
        const uploadDate = doc.upload_date_formatted || (doc.upload_date ? new Date(doc.upload_date).toLocaleDateString('id-ID') : '-');
        const fileSize = doc.file_size_formatted || (doc.file_size ? Math.round(doc.file_size / 1024) + ' KB' : '-');
        const kategori = doc.kategori || 'Tidak ada kategori';
        
        return `
            <tr style="border-bottom:1px solid var(--border);">
                <td style="padding:12px 8px; text-align:center;">${index + 1}</td>
                <td style="padding:12px 8px; text-align:center;">${thumbnailHtml}</td>
                <td style="padding:12px 8px;">
                    <strong>${escapeHtml(doc.nama_dokumen)}</strong>
                    <br><span style="font-size:10px; color:var(--text-3);">${fileSize}</span>
                </td>
                <td style="padding:12px 8px;">
                    <span class="badge-kategori" style="
                        display:inline-block;
                        padding:4px 10px;
                        border-radius:20px;
                        font-size:11px;
                        font-weight:500;
                        background:${kategori === 'Surat Keputusan' ? '#e0e7ff' : (kategori === 'Laporan' ? '#dcfce7' : '#fed7aa')};
                        color:${kategori === 'Surat Keputusan' ? '#4338ca' : (kategori === 'Laporan' ? '#166534' : '#9a3412')};
                    ">
                        ${escapeHtml(kategori)}
                    </span>
                </td>
                <td style="padding:12px 8px;">${uploadDate}</td>
                <td style="padding:12px 8px;">${escapeHtml(doc.uploaded_by)}</td>
                <td style="padding:12px 8px;"><span class="pill ${statusClass}">${doc.status}</span></td>
                <td style="padding:12px 8px; white-space:nowrap;">
                    <span class="link-act" onclick="previewDokumen('${doc.file_path}', '${doc.file_type}', '${escapeHtml(doc.nama_dokumen)}', ${doc.id_dokumen})" style="margin-right:8px;">
    <i class="fas fa-eye"></i> Lihat
</span>
                    <span class="link-act" onclick="openPrintModal(${doc.id_dokumen}, '${escapeHtml(doc.nama_dokumen)}')" style="margin-right:8px; color:#16a34a;">
                        <i class="fas fa-print"></i> Print
                    </span>
                    <span class="link-danger" onclick="deleteDokumen(${doc.id_dokumen})">
                        <i class="fas fa-trash"></i> Hapus
                    </span>
                </td>
            </tr>
        `;
    }).join('');
}

// Helper escape HTML
function escapeHtml(text) {
  if (!text) return '';
  const div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}

function getPillClass(status) {
  const map = {
    'Selesai': 'pill-done',
    'Review': 'pill-review',
    'On Going': 'pill-progress'
  };
  return map[status] || '';
}

// ================= DASHBOARD STATS (LENGKAP DARI DATABASE) =================
function loadDashboardStats() {
  $.ajax({
    url: '<?= base_url('IDE/get_dashboard_stats') ?>',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
      if (response.status === 'success') {
        // ========== HERO CARDS ==========
        // Total Dokumen (Card ke-1)
        $('.hero-card-num').eq(0).text(formatNumber(response.total_dokumen || 0));
        
        // Printer Aktif (Card ke-2)
        $('.hero-card-num').eq(1).text(formatNumber(response.total_printer_aktif || 4));
        
        // Total User (Card ke-3)
        $('.hero-card-num').eq(2).text(formatNumber(response.total_user || 0));
        
        // ========== STAT CARDS ==========
        // Total User (Stat Card ke-1)
        $('.stat-val').eq(0).text(formatNumber(response.total_user || 0));
        
        // Total Dokumen (Stat Card ke-2)
        $('.stat-val').eq(1).text(formatNumber(response.total_dokumen || 0));
        
        // Dokumen Selesai (Stat Card ke-3)
        $('.stat-val').eq(2).text(formatNumber(response.dokumen_selesai || 0));
        
        // Dokumen On Going (Stat Card ke-4)
        $('.stat-val').eq(3).text(formatNumber(response.dokumen_ongoing || 0));
        
        // ========== UPDATE CATEGORY CARDS (Jenis Dokumen) ==========
        // Update menggunakan ID
        $('#count-sk').text((response.dokumen_sk || 0) + ' dokumen');
        $('#count-laporan').text((response.dokumen_laporan || 0) + ' dokumen');
        $('#count-nota').text((response.dokumen_nota || 0) + ' dokumen');
        
        // ========== UPDATE TREND ==========
        if (response.trend_data) {
          $('.stat-trend').eq(0).html(`<span class="trend-dot">${response.trend_data.user_trend === '+8.5%' ? '↑' : '↓'}</span> ${response.trend_data.user_trend} dari kemarin`);
          $('.stat-trend').eq(1).html(`<span class="trend-dot">${response.trend_data.dokumen_trend === '+1.3%' ? '↑' : '↓'}</span> ${response.trend_data.dokumen_trend} dari minggu lalu`);
          $('.stat-trend').eq(2).html(`<span class="trend-dot">${response.trend_data.selesai_trend === '-4.3%' ? '↓' : '↑'}</span> ${response.trend_data.selesai_trend} dari kemarin`);
          $('.stat-trend').eq(3).html(`<span class="trend-dot">${response.trend_data.ongoing_trend === '+1.8%' ? '↑' : '↓'}</span> ${response.trend_data.ongoing_trend} dari kemarin`);
        }
        
        // ========== UPDATE PER BIDANG (untuk category cards bidang) ==========
        if (response.dokumen_per_bidang) {
          const bidangMap = { a: 0, b: 1, c: 2, d: 3, e: 4 };
          for (const [kode, data] of Object.entries(response.dokumen_per_bidang)) {
            const index = bidangMap[kode];
            if (index !== undefined) {
              $('.doc-cat-count').eq(index).text(`${data.total} dokumen`);
            }
          }
        }
        
        console.log('Dashboard stats updated:', response);
      } else {
        console.error('Failed to load stats:', response);
        setDefaultStats();
      }
    },
    error: function(xhr, status, error) {
      console.error('Error loading dashboard stats:', error);
      setDefaultStats();
    }
  });
}

// Helper function untuk format angka
function formatNumber(num) {
  if (num >= 1000 && num < 1000000) {
    return (num / 1000).toFixed(1) + 'K';
  } else if (num >= 1000000) {
    return (num / 1000000).toFixed(1) + 'M';
  }
  return num.toString();
}

// Set default stats jika error
function setDefaultStats() {
  $('.hero-card-num').eq(0).text('0');
  $('.hero-card-num').eq(1).text('4');
  $('.hero-card-num').eq(2).text('0');
  $('.stat-val').eq(0).text('0');
  $('.stat-val').eq(1).text('0');
  $('.stat-val').eq(2).text('0');
  $('.stat-val').eq(3).text('0');
  $('.doc-cat-count').eq(0).text('0 dokumen');
  $('.doc-cat-count').eq(1).text('0 dokumen');
  $('.doc-cat-count').eq(2).text('0 dokumen');
}

let printLogSent = false; // Flag untuk mencegah duplikasi log

function previewDokumen(filePath, fileType, fileName, id_dokumen) {
    // Simpan data dokumen
    currentPreviewDokumen = {
        id: id_dokumen,
        nama: fileName,
        path: filePath,
        type: fileType
    };
    
    // LOG PREVIEW ke server
    $.ajax({
        url: '<?= base_url('IDE/log_preview') ?>',
        type: 'POST',
        data: { id_dokumen: id_dokumen },
        dataType: 'json',
        async: false
    });
    
    // Tampilkan preview
    document.getElementById('previewTitle').textContent = fileName || 'Preview Dokumen';
    const previewDiv = document.getElementById('previewContent');
    const baseUrl = '<?= base_url() ?>';
    const fullUrl = baseUrl + filePath;
    
    let contentHtml = '';
    
    if (fileType && fileType.startsWith('image/')) {
        contentHtml = `
            <img src="${fullUrl}" style="max-width:100%; max-height:70vh;" alt="${escapeHtml(fileName)}">
            <div style="margin-top:10px; font-size:12px; color:var(--text-3);">
                <i class="fas fa-print"></i> Klik tombol "Print Dokumen" di atas untuk mencetak
            </div>
        `;
    } 
    else if (fileType === 'application/pdf') {
        // Gunakan embed untuk PDF yang lebih stabil
        contentHtml = `
            <embed id="pdf-embed"
                   src="${fullUrl}#toolbar=1&navpanes=1&scrollbar=1"
                   type="application/pdf"
                   style="width:100%; height:70vh;"
                   onerror="handlePDFError('${fullUrl}')">
            </embed>
            <div style="margin-top:10px; font-size:12px; color:var(--text-3); text-align:center;">
                <i class="fas fa-info-circle"></i> Jika PDF tidak muncul, 
                <a href="${fullUrl}" target="_blank">klik di sini</a> untuk membuka di tab baru
            </div>
        `;
    }
    else {
        contentHtml = `
            <div style="padding:60px 20px; text-align:center;">
                <div style="font-size:64px; margin-bottom:20px;">📄</div>
                <p>File tidak dapat dipreview langsung</p>
                <a href="${fullUrl}" class="btn btn-primary" download target="_blank">⬇️ Download File</a>
            </div>
        `;
    }
    
    previewDiv.innerHTML = contentHtml;
    document.getElementById('modalPreview').style.display = 'flex';
}

function handlePDFError(fullUrl) {
    console.log('PDF gagal dimuat:', fullUrl);
    const previewDiv = document.getElementById('previewContent');
    previewDiv.innerHTML += `
        <div style="color:red; margin-top:10px; padding:10px; background:#fee2e2; border-radius:8px;">
            ⚠️ Gagal memuat PDF. 
            <a href="${fullUrl}" target="_blank" style="color:#2563eb;">Klik di sini untuk membuka file di tab baru</a>
        </div>
    `;
}
/**
 * Pasang event listener global untuk deteksi print (Ctrl+P)
 * Ini akan menangkap print dari halaman manapun
 */
function attachGlobalPrintListener(id_dokumen, nama_dokumen) {
    let hasLogged = false;
    
    const printHandler = function() {
        if (!hasLogged && currentPreviewDokumen && currentPreviewDokumen.id === id_dokumen) {
            hasLogged = true;
            
            // Kirim log print ke server
            $.ajax({
                url: '<?= base_url('IDE/log_print_from_preview') ?>',
                type: 'POST',
                data: {
                    id_dokumen: id_dokumen,
                    nama_dokumen: nama_dokumen,
                    jumlah_kertas: 1,
                    source: 'ctrl_p'
                },
                dataType: 'json',
                async: true,
                success: function(response) {
                    console.log('Print log recorded:', response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Print Tercatat',
                        text: `Aktivitas print untuk "${nama_dokumen}" telah tercatat`,
                        timer: 1500,
                        showConfirmButton: false,
                        position: 'top-end',
                        toast: true
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Failed to record print log:', error);
                }
            });
        }
    };
    
    // Hapus event listener lama jika ada
    window.removeEventListener('beforeprint', printHandler);
    // Pasang event listener baru
    window.addEventListener('beforeprint', printHandler);
    
    // Hapus setelah 5 menit
    setTimeout(() => {
        window.removeEventListener('beforeprint', printHandler);
    }, 300000);
}
/**
 * Pasang event listener untuk deteksi print pada PDF iframe
 */
function attachPrintListenerToPDF(id_dokumen, nama_dokumen) {
    const iframe = document.getElementById('pdf-iframe');
    
    if (!iframe) return;
    
    // Coba akses iframe contentWindow
    iframe.onload = function() {
        try {
            const iframeWindow = iframe.contentWindow;
            
            // Pasang event listener untuk beforeprint
            iframeWindow.addEventListener('beforeprint', function() {
                logPrintFromPreview(id_dokumen, nama_dokumen, 1);
            });
            
            // Alternatif: untuk PDF.js atau browser tertentu
            iframeWindow.addEventListener('afterprint', function() {
                console.log('Print process completed');
            });
            
            console.log('Print listener attached to PDF iframe');
        } catch(e) {
            console.log('Cannot access iframe - cross-origin restriction:', e);
            // Fallback: gunakan metode polling
            fallbackPrintDetection(id_dokumen, nama_dokumen);
        }
    };
}

/**
 * Fallback untuk deteksi print (polling)
 */
function fallbackPrintDetection(id_dokumen, nama_dokumen) {
    let lastPrintCheck = 0;
    const checkInterval = setInterval(() => {
        const now = Date.now();
        // Jika sudah di atas 5 menit, hentikan polling
        if (now - lastPrintCheck > 300000) {
            clearInterval(checkInterval);
            return;
        }
        
        // Tidak bisa deteksi secara akurat, 
        // tapi kita asumsikan user akan print dari tab terpisah
    }, 5000);
}

/**
 * Pasang event listener untuk deteksi print pada gambar
 */
function attachPrintListenerToImage(id_dokumen, nama_dokumen) {
    // Tangkap event print dari window (Ctrl+P)
    const printHandler = function() {
        logPrintFromPreview(id_dokumen, nama_dokumen, 1);
        window.removeEventListener('beforeprint', printHandler);
    };
    
    window.addEventListener('beforeprint', printHandler);
    
    // Hapus setelah 5 menit jika tidak digunakan
    setTimeout(() => {
        window.removeEventListener('beforeprint', printHandler);
    }, 300000);
}

/**
 * Kirim log print ke server
 */
function logPrintFromPreview(id_dokumen, nama_dokumen, jumlah_kertas = 1) {
    // Cegah duplikasi log
    if (printLogSent) return;
    printLogSent = true;
    
    $.ajax({
        url: '<?= base_url('IDE/log_print_from_preview') ?>',
        type: 'POST',
        data: {
            id_dokumen: id_dokumen,
            nama_dokumen: nama_dokumen,
            jumlah_kertas: jumlah_kertas,
            source: 'pdf_viewer'
        },
        dataType: 'json',
        success: function(response) {
            console.log('Print log recorded:', response);
            
            // Tampilkan notifikasi kecil (opsional)
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Print Tercatat',
                    text: `Aktivitas print untuk "${nama_dokumen}" telah tercatat`,
                    timer: 1500,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Failed to record print log:', error);
            printLogSent = false; // Reset agar bisa dicoba lagi
        }
    });
}

function printFromPreview() {
    if (!currentPreviewDokumen) {
        Swal.fire('Error', 'Tidak ada dokumen yang dipreview', 'error');
        return;
    }
    
    // Tampilkan dialog dengan jumlah copy
    Swal.fire({
        title: 'Print Dokumen',
        html: `
            <div style="text-align:left;">
                <p><strong>📄 Dokumen:</strong> ${escapeHtml(currentPreviewDokumen.nama)}</p>
                <p><strong>📁 Tipe:</strong> ${currentPreviewDokumen.type || 'Unknown'}</p>
                <div class="form-group" style="margin-top:15px;">
                    <label class="form-label">Jumlah Copy:</label>
                    <input type="number" id="print_copies" class="form-control" value="1" min="1" max="10" style="width:100%; padding:8px;">
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: '🖨️ Print Sekarang',
        cancelButtonText: 'Batal',
        width: '450px',
        preConfirm: () => {
            const copies = parseInt(document.getElementById('print_copies').value);
            if (isNaN(copies) || copies < 1) {
                Swal.showValidationMessage('Jumlah copy minimal 1');
                return false;
            }
            return { copies: copies };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const jumlahCopy = result.value.copies;
            const totalKertas = jumlahCopy;
            
            // Loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Mencatat aktivitas print...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
            
            // Kirim log print ke server
            $.ajax({
                url: '<?= base_url('IDE/log_print_from_preview') ?>',
                type: 'POST',
                data: {
                    id_dokumen: currentPreviewDokumen.id,
                    nama_dokumen: currentPreviewDokumen.nama,
                    jumlah_kertas: totalKertas,
                    source: 'print_button'
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Print log recorded:', response);
                    Swal.close();
                    
                    if (response.status === 'success') {
                        // NOTIFIKASI SUKSES LOG
                        Swal.fire({
                            icon: 'success',
                            title: 'Print Tercatat!',
                            html: `${response.detail || `Print dokumen: ${currentPreviewDokumen.nama} - ${totalKertas} lembar`}`,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        // EKSEKUSI PRINT
                        executePrintFromPreview();
                    } else {
                        Swal.fire('Error', response.message || 'Gagal mencatat log print', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to record print log:', error);
                    Swal.close();
                    
                    // TETAP LANJUTKAN PRINT
                    Swal.fire({
                        icon: 'warning',
                        title: 'Log Gagal Tercatat',
                        text: 'Print tetap dilanjutkan, tetapi log tidak tersimpan',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    executePrintFromPreview();
                }
            });
        }
    });
}

function executePrintFromPreview() {
    const fileType = currentPreviewDokumen.type;
    const baseUrl = '<?= base_url() ?>';
    const fileUrl = baseUrl + currentPreviewDokumen.path;
    
    if (fileType === 'application/pdf') {
        // Method 1: Coba print dari embed
        const embed = document.getElementById('pdf-embed');
        if (embed) {
            try {
                embed.print();
                return;
            } catch(e) {
                console.log('Embed print failed:', e);
            }
        }
        
        // Method 2: Buka di tab baru lalu print
        const printWindow = window.open(fileUrl, '_blank');
        if (printWindow) {
            printWindow.onload = function() {
                printWindow.print();
            };
        } else {
            // Method 3: Popup terblokir, kasih link
            Swal.fire({
                icon: 'info',
                title: 'Popup Terblokir',
                html: `Silakan <a href="${fileUrl}" target="_blank">klik di sini</a> untuk membuka file, lalu tekan Ctrl+P untuk print.`,
                confirmButtonText: 'OK'
            });
        }
    } else {
        // Untuk gambar dan file lain, buka di tab baru
        const printWindow = window.open(fileUrl, '_blank');
        if (printWindow) {
            printWindow.onload = function() {
                printWindow.print();
            };
        }
    }
}

function closePreviewModal() {
    document.getElementById('modalPreview').style.display = 'none';
    const previewDiv = document.getElementById('previewContent');
    if (previewDiv) {
        previewDiv.innerHTML = '';
    }
    currentPreviewDokumen = null;
}

// ================= DELETE DOKUMEN =================
function deleteDokumen(idDokumen) {
  Swal.fire({
    title: 'Yakin hapus?',
    text: 'Dokumen akan dihapus permanen!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc2626',
    cancelButtonColor: '#64748b',
    confirmButtonText: 'Ya, Hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'Menghapus...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
      });
      
      $.ajax({
        url: '<?= base_url('IDE/delete_dokumen') ?>',
        type: 'POST',
        data: { id_dokumen: idDokumen },
        dataType: 'json',
        timeout: 10000,
        success: function(response) {
          Swal.close();
          if (response.status === 'success') {
            Swal.fire('Terhapus!', response.message, 'success');
            if (currentBidangId) {
              loadDokumenFromDB(currentBidangId);
            }
            // Refresh dashboard stats
            if (typeof loadDashboardStats === 'function') {
              loadDashboardStats();
            }
          } else {
            Swal.fire('Error!', response.message || 'Gagal menghapus dokumen', 'error');
          }
        },
        error: function(xhr, status, error) {
          Swal.close();
          Swal.fire('Error!', 'Gagal menghubungi server', 'error');
          console.error('Delete error:', error);
        }
      });
    }
  });
}

// ================= FILTER DOKUMEN =================
function filterBidangTable() {
  const searchText = $('#bidang-search').val().toLowerCase();
  const statusFilter = $('#bidang-status-filter').val();
  
  $('#bidang-tbody tr').each(function() {
    const namaDokumen = $(this).find('td:eq(2)').text().toLowerCase();
    const status = $(this).find('td:eq(6) .pill').text();
    let show = true;
    
    if (searchText && !namaDokumen.includes(searchText)) show = false;
    if (statusFilter && status !== statusFilter) show = false;
    
    $(this).toggle(show);
  });
}

// ================= SPINNER ANIMATION CSS =================
// Tambahkan CSS untuk spinner jika belum ada
if (!document.querySelector('#spinner-style')) {
  const style = document.createElement('style');
  style.id = 'spinner-style';
  style.textContent = `
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .modern-spinner {
      width: 30px;
      height: 30px;
      border: 3px solid #e2e8f0;
      border-top-color: #3b82f6;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
      margin: 0 auto 10px;
    }
    .doc-thumbnail {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .doc-thumbnail:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
  `;
  document.head.appendChild(style);
}



// ================= EXPORT DOKUMEN TABLE TO PDF =================
// ================= EXPORT DOKUMEN TO PDF (DENGAN LOGO) =================
function exportDokumenToPDF() {
  const dokumenData = [];
  
  $('#bidang-tbody tr').each(function() {
    const row = $(this);
    const namaDokumen = row.find('td:eq(2) strong').text();
    const kategori = row.find('td:eq(3) .badge-kategori').text();
    const uploadDate = row.find('td:eq(4)').text();
    const uploadedBy = row.find('td:eq(5)').text();
    const status = row.find('td:eq(6) .pill').text();
    
    if (namaDokumen) {
      dokumenData.push({
        nama: namaDokumen,
        kategori: kategori,
        tanggal: uploadDate,
        user: uploadedBy,
        status: status
      });
    }
  });
  
  if (dokumenData.length === 0) {
    Swal.fire('Info', 'Tidak ada data dokumen untuk diexport', 'info');
    return;
  }
  
  const now = new Date();
  const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  const dateStr = `${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
  const bidangTitle = document.getElementById('bidang-title').textContent;
  const logoUrl = '<?= base_url('assets/img/bappeda.png') ?>';
  
  let htmlContent = `
    <div class="pdf-export-wrapper">
      <div class="pdf-header">
        <div style="display: flex; align-items: center; justify-content: center; gap: 15px; margin-bottom: 10px; flex-wrap: wrap;">
          <img src="${logoUrl}" alt="Logo Bappeda Banyuwangi" style="height: 60px; width: auto; object-fit: contain;">
          <div style="text-align: center;">
            <h2 style="margin: 0; color: #1a2d6b;">SISTEM MANAJEMEN KANTOR (SMB)</h2>
            <h3 style="margin: 5px 0 0 0; color: #1a2d6b;">BAPPEDA KABUPATEN BANYUWANGI</h3>
          </div>
        </div>
        <p>Laporan Dokumen - ${escapeHtml(bidangTitle)}</p>
      </div>
      <div class="pdf-date">
        <strong>Tanggal Export:</strong> ${dateStr}<br>
        <strong>User:</strong> ${escapeHtml('<?= $display_name ?>')} (${escapeHtml('<?= $role_name ?>')})
      </div>
      <table class="pdf-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Dokumen</th>
            <th>Kategori</th>
            <th>Tanggal Upload</th>
            <th>Diupload Oleh</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
  `;
  
  dokumenData.forEach((item, index) => {
    htmlContent += `
      <tr>
        <td>${index + 1}</td>
        <td>${escapeHtml(item.nama)}</td>
        <td>${escapeHtml(item.kategori)}</td>
        <td>${escapeHtml(item.tanggal)}</td>
        <td>${escapeHtml(item.user)}</td>
        <td>${escapeHtml(item.status)}</td>
      </tr>
    `;
  });
  
  htmlContent += `
        </tbody>
      </table>
      <div class="pdf-footer">
        <p>Dokumen ini dibuat secara otomatis oleh sistem SMB Bappeda Banyuwangi</p>
        <p>Total Dokumen: ${dokumenData.length}</p>
      </div>
    </div>
  `;
  
  Swal.fire({
    title: 'Membuat PDF...',
    text: 'Mohon tunggu',
    allowOutsideClick: false,
    didOpen: () => Swal.showLoading()
  });
  
  const element = document.createElement('div');
  element.innerHTML = htmlContent;
  document.body.appendChild(element);
  
  const opt = {
    margin: [0.5, 0.5, 0.5, 0.5],
    filename: `Dokumen_${bidangTitle.replace(/\s/g, '_')}_${dateStr.replace(/\s/g, '_')}.pdf`,
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2, letterRendering: true },
    jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
  };
  
  html2pdf().set(opt).from(element).save().then(() => {
    document.body.removeChild(element);
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: 'File PDF telah berhasil di-download',
      timer: 2000,
      showConfirmButton: false
    });
  }).catch(error => {
    document.body.removeChild(element);
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: 'Terjadi kesalahan saat membuat PDF'
    });
  });
}

// ================= LOG AKTIVITAS FUNCTIONS =================
let allLogData = [];
let currentDateStart = '';
let currentDateEnd = '';

function loadLogAktivitas() {
  console.log('Loading log aktivitas...');
  
  $('#log-tbody').html(`
    <tr><td colspan="6" style="text-align:center;padding:40px;">
      <div class="modern-spinner"></div>
      <p>Memuat data log...</p>
    </td></tr>
  `);
  
  $.ajax({
    url: '<?= base_url('IDE/get_log_aktivitas') ?>',
    type: 'GET',
    dataType: 'json',
    timeout: 10000,
    success: function(response) {
      if (response.status === 'success') {
        allLogData = response.data;
        renderLogTable(allLogData);
        console.log('Log data loaded:', allLogData.length, 'records');
      } else {
        $('#log-tbody').html(`<tr><td colspan="6" class="empty-state-table">
          <div class="icon">⚠️</div>
          <p>Gagal memuat data log</p>
        </td></tr>`);
      }
    },
    error: function(xhr, status, error) {
      console.error('Error loading log:', error);
      $('#log-tbody').html(`<tr><td colspan="6" class="empty-state-table">
        <div class="icon">❌</div>
        <p>Error memuat data dari server</p>
       </td></tr>`);
    }
  });
}

function renderLogTable(logs) {
  const tbody = document.getElementById('log-tbody');
  
  if (!logs || logs.length === 0) {
    tbody.innerHTML = `<tr><td colspan="6" class="empty-state-table">
      <div class="icon"></div>
      <p>Belum ada aktivitas tercatat</p>
      <p style="font-size: 12px; margin-top: 8px;">Lakukan aktivitas seperti upload, print, atau login untuk mencatat log</p>
    </td></tr>`;
    return;
  }
  
  const getAksiClass = (aksi) => {
    const map = {
        'Upload': 'log-aksi-upload',
        'Print': 'log-aksi-print',
        'Print (via Preview)': 'log-aksi-print',  // TAMBAHKAN INI
        'Preview': 'log-aksi-review',
        'Review': 'log-aksi-review',
        'Login': 'log-aksi-login',
        'Update': 'log-aksi-update',
        'Hapus': 'log-aksi-hapus',
        'Delete': 'log-aksi-hapus'
    };
    return map[aksi] || 'log-aksi-upload';
};
  
  const getAksiIcon = (aksi) => {
    const map = {
      'Upload': '',
      'Print': '',
      'Review': '',
      'Login': '',
      'Update': '',
      'Hapus': '',
      'Delete': ''
    };
    return map[aksi] || '';
  };
  
  tbody.innerHTML = logs.map((log, index) => {
    const waktu = log.waktu || '-';
    const username = log.username || '-';
    const aksi = log.aksi || '-';
    const modul = log.modul || '-';
    const detail = log.detail || '-';
    let ip = log.ip_address || '-';
    
    // Format IP agar lebih rapi
    if (ip === '::1') ip = '127.0.0.1';
    
    const aksiClass = getAksiClass(aksi);
    const aksiIcon = getAksiIcon(aksi);
    
    return `
      <tr>
        <td class="waktu-cell">${escapeHtml(waktu)}</td>
        <td class="username-cell">
          <i class=""></i> ${escapeHtml(username)}
        </td>
        <td>
          <span class="log-aksi-badge ${aksiClass}">
            ${aksiIcon} ${escapeHtml(aksi)}
          </span>
        </td>
        <td>
          <i class=""></i> ${escapeHtml(modul)}
        </td>
        <td class="detail-cell">
          <i class="" style="opacity: 0.6; margin-right: 6px;"></i>
          ${escapeHtml(detail)}
        </td>
        <td>
          <code class="ip-address">
            <i class=""></i> ${escapeHtml(ip)}
          </code>
        </td>
      </tr>
    `;
  }).join('');
}

function filterLogTable() {
  const searchText = $('#log-search').val().toLowerCase();
  const aksiFilter = $('#log-aksi-filter').val();
  const dateStart = $('#log-date-start').val();
  const dateEnd = $('#log-date-end').val();
  
  let filtered = [...allLogData];
  
  // Filter berdasarkan teks pencarian
  if (searchText) {
    filtered = filtered.filter(log => 
      (log.username || '').toLowerCase().includes(searchText) ||
      (log.detail || '').toLowerCase().includes(searchText) ||
      (log.modul || '').toLowerCase().includes(searchText)
    );
  }
  
  // Filter berdasarkan aksi
  if (aksiFilter) {
    filtered = filtered.filter(log => log.aksi === aksiFilter);
  }
  
  // Filter berdasarkan rentang tanggal
  if (dateStart) {
    const startDate = new Date(dateStart);
    filtered = filtered.filter(log => {
      const logDate = new Date(log.waktu.split(' ')[0].split('/').reverse().join('-'));
      return logDate >= startDate;
    });
  }
  
  if (dateEnd) {
    const endDate = new Date(dateEnd);
    endDate.setHours(23, 59, 59);
    filtered = filtered.filter(log => {
      const logDate = new Date(log.waktu.split(' ')[0].split('/').reverse().join('-'));
      return logDate <= endDate;
    });
  }
  
  renderLogTable(filtered);
  console.log('Filtered logs:', filtered.length);
}

function filterLogByDate() {
  filterLogTable();
}

function refreshLogData() {
  $('#log-date-start').val('');
  $('#log-date-end').val('');
  $('#log-aksi-filter').val('');
  $('#log-search').val('');
  loadLogAktivitas();
}

// ==================== PRINTER MANAGEMENT FUNCTIONS ====================

let currentPrintDokumen = null;
let selectedPrinter = null;
let printersData = [];

/**
 * Open print modal (VERSI SIMPLE LANGSUNG PRINT)
 */
function openPrintModal(id_dokumen, nama_dokumen) {
    currentPrintDokumen = { id_dokumen, nama_dokumen };
    
    document.getElementById('print-dokumen-nama').textContent = nama_dokumen;
    document.getElementById('print-jumlah-copy').value = '1';
    
    // Load default printer
    loadDefaultPrinter();
    updatePrintSummarySimple();
    
    document.getElementById('modalPrint').style.display = 'flex';
}

/**
 * Close print modal
 */
function closePrintModal() {
    document.getElementById('modalPrint').style.display = 'none';
    currentPrintDokumen = null;
}

/**
 * Load printers real dari database
 */
function loadRealPrinters() {
    const container = document.getElementById('printer-list-container');
    container.innerHTML = '<div class="empty-state"><div class="modern-spinner"></div><p>Memuat daftar printer...</p></div>';
    
    $.ajax({
        url: '<?= base_url('IDE/get_printers') ?>',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                printersData = response.data;
                renderPrinterListReal(printersData);
            } else {
                container.innerHTML = '<div class="empty-state">❌ Gagal memuat daftar printer</div>';
            }
        },
        error: function() {
            container.innerHTML = '<div class="empty-state">⚠️ Error koneksi ke server</div>';
        }
    });
}

/**
 * Render printer list dengan status real-time
 */
function renderPrinterListReal(printers) {
    const container = document.getElementById('printer-list-container');
    
    if (!printers || printers.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <div style="font-size:48px;">🖨️</div>
                <p>Belum ada printer terdaftar</p>
                <button class="btn btn-sm" onclick="showAddPrinterModal()" style="margin-top:10px;">
                    + Tambah Printer
                </button>
            </div>`;
        return;
    }
    
    container.innerHTML = printers.map(printer => `
        <div class="printer-card" onclick="selectPrinterReal(${printer.id_printer})" data-printer-id="${printer.id_printer}">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <strong>${escapeHtml(printer.nama_printer)}</strong>
                    <br>
                    <small style="color:var(--text-2);">
                        <i class="fas fa-map-marker-alt"></i> ${escapeHtml(printer.lokasi)}
                    </small>
                    <br>
                    <small style="color:var(--text-3);">
                        <i class="fas fa-plug"></i> ${printer.connection_display}
                    </small>
                </div>
                <div style="text-align:right;">
                    <span class="printer-status ${printer.status}"></span>
                    <span style="font-size:11px; font-weight:600;">${printer.status.toUpperCase()}</span>
                    ${printer.current_queue > 0 ? `<div><small>📋 Antrian: ${printer.current_queue}</small></div>` : ''}
                </div>
            </div>
            <div style="margin-top:8px; font-size:12px;">
                <div style="display:flex; justify-content:space-between;">
                    <span>📄 Stock Kertas:</span>
                    <strong style="color: ${printer.is_low_stock ? 'var(--red)' : 'var(--green)'}">
                        ${printer.stock_kertas} / ${printer.kapasitas_kertas} lembar
                    </strong>
                </div>
                <div class="stock-bar" style="margin-top:4px;">
                    <div class="stock-fill" style="width: ${printer.stock_percentage}%; 
                         background: ${printer.is_low_stock ? 'var(--red)' : 'var(--green)'}; 
                         height:4px; border-radius:2px;"></div>
                </div>
                ${printer.is_low_stock ? '<div style="color:var(--red); margin-top:4px;">⚠️ Stok menipis!</div>' : ''}
            </div>
            <div style="margin-top:8px; font-size:11px; color:var(--text-3);">
                <i class="fas fa-chart-line"></i> Total print: ${printer.total_print_count || 0}
            </div>
        </div>
    `).join('');
}

/**
 * Select printer real
 */
function selectPrinterReal(printerId) {
    selectedPrinter = printersData.find(p => p.id_printer === printerId);
    
    if (!selectedPrinter) return;
    
    // Update UI
    document.querySelectorAll('.printer-card').forEach(card => {
        card.classList.remove('selected');
        if (card.dataset.printerId == printerId) {
            card.classList.add('selected');
        }
    });
    
    updatePrintSummaryReal();
}

/**
 * Update print summary based on selected printer
 */
function updatePrintSummaryReal() {
    const jumlahCopy = parseInt(document.getElementById('print-jumlah-copy').value) || 1;
    const estimasiHalaman = 1; // Bisa dihitung dari file
    const totalKertas = jumlahCopy * estimasiHalaman;
    
    const summaryDiv = document.getElementById('print-summary');
    
    if (!selectedPrinter) {
        summaryDiv.innerHTML = '<div class="empty-state">Pilih printer terlebih dahulu</div>';
        return;
    }
    
    const stockAfter = selectedPrinter.stock_kertas - totalKertas;
    const isStockEnough = stockAfter >= 0;
    
    summaryDiv.innerHTML = `
        <div class="print-summary-item">
            <span>🖨️ Printer:</span>
            <strong>${escapeHtml(selectedPrinter.nama_printer)}</strong>
        </div>
        <div class="print-summary-item">
            <span>📄 Dokumen:</span>
            <strong>${escapeHtml(currentPrintDokumen.nama_dokumen)}</strong>
        </div>
        <div class="print-summary-item">
            <span>📋 Jumlah Copy:</span>
            <strong>${jumlahCopy} x</strong>
        </div>
        <div class="print-summary-item">
            <span>📄 Total Kertas:</span>
            <strong>${totalKertas} lembar</strong>
        </div>
        <div class="print-summary-item">
            <span>📊 Stock Saat Ini:</span>
            <strong>${selectedPrinter.stock_kertas} lembar</strong>
        </div>
        <div class="print-summary-item">
            <span>📈 Stock Setelah Print:</span>
            <strong style="color: ${isStockEnough ? 'var(--green)' : 'var(--red)'}">
                ${stockAfter} lembar
                ${!isStockEnough ? ' ❌ TIDAK CUKUP!' : ''}
            </strong>
        </div>
        <div class="print-summary-item">
            <span>🔌 Tipe Koneksi:</span>
            <strong>${selectedPrinter.connection_type.toUpperCase()}</strong>
        </div>
    `;
    
    if (selectedPrinter.is_low_stock) {
        summaryDiv.innerHTML += `
            <div class="stock-warning">
                ⚠️ <strong>Peringatan:</strong> Stock kertas menipis (${selectedPrinter.stock_kertas} lembar). 
                <a href="#" onclick="showAddPaperModal(${selectedPrinter.id_printer})">Isi ulang</a>
            </div>
        `;
    }
}

/**
 * Execute print to real printer
 */
function executePrintReal() {
    if (!selectedPrinter) {
        Swal.fire('Peringatan', 'Pilih printer terlebih dahulu', 'warning');
        return;
    }
    
    if (selectedPrinter.status !== 'online') {
        Swal.fire('Error', `Printer sedang ${selectedPrinter.status}. Tidak dapat melakukan print.`, 'error');
        return;
    }
    
    const jumlahCopy = parseInt(document.getElementById('print-jumlah-copy').value) || 1;
    const totalKertas = jumlahCopy; // 1 halaman per copy
    
    if (selectedPrinter.stock_kertas < totalKertas) {
        Swal.fire('Error', `Stock kertas tidak mencukupi! Sisa: ${selectedPrinter.stock_kertas} lembar`, 'error');
        return;
    }
    
    // Show loading
    Swal.fire({
        title: 'Memproses Print...',
        text: `Mengirim ke printer ${selectedPrinter.nama_printer}`,
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    
    $.ajax({
        url: '<?= base_url('IDE/print_dokumen') ?>',
        type: 'POST',
        data: {
            id_dokumen: currentPrintDokumen.id_dokumen,
            id_printer: selectedPrinter.id_printer,
            jumlah_halaman: 1,
            jumlah_kertas: totalKertas,
            jumlah_copy: jumlahCopy
        },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            closePrintModal();
            
            if (response.status === 'success') {
                showPrintResultReal('success', '✅ Print Berhasil!', response.message, response.data);
                
                // Refresh data
                if (currentBidangId) loadDokumenFromDB(currentBidangId);
                loadDashboardStats();
                
                // Refresh log if active
                if (document.querySelector('.panel.active')?.id === 'panel-log') {
                    loadLogAktivitas();
                }
            } else {
                showPrintResultReal('error', '❌ Print Gagal!', response.message, null);
            }
        },
        error: function(xhr, status, error) {
            Swal.close();
            closePrintModal();
            showPrintResultReal('error', '⚠️ Error!', 'Terjadi kesalahan: ' + error, null);
            console.error('Print error:', error);
        }
    });
}

/**
 * Test printer connection
 */
function testPrinterConnection(printerId) {
    Swal.fire({
        title: 'Testing Koneksi Printer...',
        text: 'Mohon tunggu',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    
    $.ajax({
        url: '<?= base_url('IDE/test_printer_connection') ?>',
        type: 'POST',
        data: { id_printer: printerId },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Koneksi Berhasil',
                    html: `
                        ✅ Printer dapat dijangkau<br>
                        ⚡ Response time: ${response.response_time_ms} ms<br>
                        📡 Status: ${response.printer_status.toUpperCase()}
                    `,
                    timer: 3000
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Koneksi Gagal',
                    html: `
                        ❌ ${response.message}<br>
                        💡 Periksa kabel/koneksi printer
                    `
                });
            }
            
            // Refresh printer list
            loadRealPrinters();
        },
        error: function() {
            Swal.close();
            Swal.fire('Error', 'Gagal melakukan test koneksi', 'error');
        }
    });
}

/**
 * Show add paper modal
 */
function showAddPaperModal(printerId) {
    Swal.fire({
        title: 'Tambah Stock Kertas',
        html: `
            <input type="number" id="jumlah_kertas" class="swal2-input" placeholder="Jumlah lembar" min="1" max="500">
        `,
        showCancelButton: true,
        confirmButtonText: 'Tambah',
        cancelButtonText: 'Batal',
        preConfirm: () => {
            const jumlah = document.getElementById('jumlah_kertas').value;
            if (!jumlah || jumlah <= 0) {
                Swal.showValidationMessage('Jumlah tidak valid');
                return false;
            }
            return { jumlah: parseInt(jumlah) };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            addPaperStock(printerId, result.value.jumlah);
        }
    });
}

/**
 * Add paper stock to printer
 */
function addPaperStock(printerId, jumlah) {
    Swal.fire({
        title: 'Menambah Stock...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    
    $.ajax({
        url: '<?= base_url('IDE/add_paper_stock') ?>',
        type: 'POST',
        data: {
            id_printer: printerId,
            jumlah_tambah: jumlah
        },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    html: `Stock kertas bertambah ${jumlah} lembar.<br>Total sekarang: ${response.new_stock} lembar`,
                    timer: 2000
                });
                loadRealPrinters();
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function() {
            Swal.close();
            Swal.fire('Error', 'Gagal menambah stock', 'error');
        }
    });
}

/**
 * Show add printer modal
 */
function showAddPrinterModal() {
    Swal.fire({
        title: 'Tambah Printer Baru',
        html: `
            <form id="formAddPrinter" style="text-align:left;">
                <div class="form-group">
                    <label>Nama Printer:</label>
                    <input type="text" id="nama_printer" class="swal2-input" placeholder="Contoh: Canon G3010" required>
                </div>
                <div class="form-group">
                    <label>Lokasi:</label>
                    <input type="text" id="lokasi" class="swal2-input" placeholder="Contoh: Lantai 1 - Ruang Litbang" required>
                </div>
                <div class="form-group">
                    <label>Tipe Koneksi:</label>
                    <select id="connection_type" class="swal2-select" onchange="togglePrinterFields()">
                        <option value="network">Network (TCP/IP)</option>
                        <option value="shared">Shared Printer (Windows)</option>
                        <option value="usb">USB Local</option>
                    </select>
                </div>
                <div id="network-fields">
                    <div class="form-group">
                        <label>IP Address:</label>
                        <input type="text" id="ip_address" class="swal2-input" placeholder="192.168.1.100">
                    </div>
                    <div class="form-group">
                        <label>Port:</label>
                        <input type="number" id="port" class="swal2-input" value="9100">
                    </div>
                </div>
                <div id="shared-fields" style="display:none;">
                    <div class="form-group">
                        <label>Share Path:</label>
                        <input type="text" id="share_path" class="swal2-input" placeholder="\\\\server\\printer">
                    </div>
                </div>
                <div id="usb-fields" style="display:none;">
                    <div class="form-group">
                        <label>USB Port:</label>
                        <input type="text" id="usb_port" class="swal2-input" placeholder="USB001">
                    </div>
                </div>
                <div class="form-group">
                    <label>Stock Kertas Awal:</label>
                    <input type="number" id="stock_kertas" class="swal2-input" value="500">
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Simpan & Test',
        cancelButtonText: 'Batal',
        width: '600px',
        preConfirm: () => {
            const connectionType = document.getElementById('connection_type').value;
            const data = {
                nama_printer: document.getElementById('nama_printer').value,
                lokasi: document.getElementById('lokasi').value,
                connection_type: connectionType,
                stock_kertas: document.getElementById('stock_kertas').value
            };
            
            if (connectionType === 'network') {
                data.ip_address = document.getElementById('ip_address').value;
                data.port = document.getElementById('port').value;
                if (!data.ip_address) {
                    Swal.showValidationMessage('IP Address wajib diisi untuk printer jaringan');
                    return false;
                }
            } else if (connectionType === 'shared') {
                data.share_path = document.getElementById('share_path').value;
                if (!data.share_path) {
                    Swal.showValidationMessage('Share path wajib diisi untuk shared printer');
                    return false;
                }
            } else if (connectionType === 'usb') {
                data.usb_port = document.getElementById('usb_port').value;
                if (!data.usb_port) {
                    Swal.showValidationMessage('USB Port wajib diisi untuk USB printer');
                    return false;
                }
            }
            
            return data;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            saveNewPrinter(result.value);
        }
    });
}

/**
 * Toggle printer fields based on connection type
 */
function togglePrinterFields() {
    const type = document.getElementById('connection_type').value;
    document.getElementById('network-fields').style.display = type === 'network' ? 'block' : 'none';
    document.getElementById('shared-fields').style.display = type === 'shared' ? 'block' : 'none';
    document.getElementById('usb-fields').style.display = type === 'usb' ? 'block' : 'none';
}

/**
 * Save new printer
 */
function saveNewPrinter(printerData) {
    Swal.fire({
        title: 'Menyimpan & Testing...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    
    $.ajax({
        url: '<?= base_url('IDE/add_printer') ?>',
        type: 'POST',
        data: printerData,
        dataType: 'json',
        success: function(response) {
            Swal.close();
            
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Printer Ditambahkan!',
                    html: `
                        ✅ Printer berhasil ditambahkan<br>
                        🔌 Test koneksi: ${response.test_result.success ? 'BERHASIL' : 'GAGAL'}<br>
                        📡 Pesan: ${response.test_result.message}
                    `
                });
                loadRealPrinters();
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function() {
            Swal.close();
            Swal.fire('Error', 'Gagal menambahkan printer', 'error');
        }
    });
}

/**
 * Show print result
 */
function showPrintResultReal(type, title, message, data) {
    const iconMap = { success: '✅', error: '❌', warning: '⚠️' };
    
    let detailsHtml = '';
    if (data && type === 'success') {
        detailsHtml = `
            <div style="margin-top:15px; text-align:left; background:var(--page-bg); padding:12px; border-radius:8px;">
                <strong>📊 Detail Print:</strong><br>
                🖨️ Printer: ${escapeHtml(data.printer)}<br>
                📄 Dokumen: ${escapeHtml(data.dokumen)}<br>
                📋 Jumlah Kertas: ${data.jumlah_kertas} lembar<br>
                📈 Sisa Kertas: ${data.sisa_kertas} lembar<br>
                ⚡ Waktu Proses: ${data.processing_time || 'N/A'}
            </div>
        `;
    }
    
    Swal.fire({
        icon: type === 'success' ? 'success' : 'error',
        title: title,
        html: `<p>${message}</p>${detailsHtml}`,
        timer: type === 'success' ? 4000 : undefined,
        showConfirmButton: true
    });
}

/**
 * Close print modal
 */
function closePrintModal() {
    document.getElementById('modalPrint').style.display = 'none';
    selectedPrinter = null;
    currentPrintDokumen = null;
}


// ================= EXPORT LOG TO PDF (DENGAN LOGO) =================
function exportLogToPDF() {
  // Ambil data yang sedang ditampilkan (setelah filter)
  const logData = [];
  $('#log-tbody tr').each(function() {
    const row = $(this);
    const waktu = row.find('td:eq(0)').text();
    const user = row.find('td:eq(1)').text();
    const aksi = row.find('td:eq(2) .pill').text();
    const modul = row.find('td:eq(3)').text();
    const detail = row.find('td:eq(4)').text();
    const ip = row.find('td:eq(5) code').text() || row.find('td:eq(5)').text();
    
    if (waktu && !waktu.includes('Memuat') && !waktu.includes('Belum')) {
      logData.push({ waktu, user, aksi, modul, detail, ip });
    }
  });
  
  if (logData.length === 0) {
    Swal.fire('Info', 'Tidak ada data log untuk diexport', 'info');
    return;
  }
  
  const now = new Date();
  const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
  const dateStr = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
  const timeStr = `${now.getHours().toString().padStart(2,'0')}:${now.getMinutes().toString().padStart(2,'0')}:${now.getSeconds().toString().padStart(2,'0')}`;
  
  // Filter info untuk PDF
  const startDate = $('#log-date-start').val();
  const endDate = $('#log-date-end').val();
  const aksiFilter = $('#log-aksi-filter').val();
  const searchText = $('#log-search').val();
  
  let filterInfo = '';
  if (startDate || endDate) filterInfo += `Periode: ${startDate || 'Awal'} s.d. ${endDate || 'Sekarang'} | `;
  if (aksiFilter) filterInfo += `Aksi: ${aksiFilter} | `;
  if (searchText) filterInfo += `Pencarian: ${searchText} | `;
  
  // Logo Bappeda dari asset lokal
  const logoUrl = '<?= base_url('assets/img/bappeda.png') ?>';
  
  let htmlContent = `
    <div class="pdf-export-wrapper">
      <div class="pdf-header">
        <div style="display: flex; align-items: center; justify-content: center; gap: 15px; margin-bottom: 10px; flex-wrap: wrap;">
          <img src="${logoUrl}" alt="Logo Bappeda Banyuwangi" style="height: 60px; width: auto; object-fit: contain;">
          <div style="text-align: center;">
            <h2 style="margin: 0; color: #1a2d6b;">SISTEM MANAJEMEN KANTOR (SMB)</h2>
            <h3 style="margin: 5px 0 0 0; color: #1a2d6b;">BAPPEDA KABUPATEN BANYUWANGI</h3>
          </div>
        </div>
        <p style="margin-top: 10px;">Laporan Log Aktivitas Sistem</p>
      </div>
      <div class="pdf-date">
        <strong>Tanggal Export:</strong> ${dateStr} ${timeStr}<br>
        <strong>User:</strong> ${escapeHtml('<?= $display_name ?>')} (${escapeHtml('<?= $role_name ?>')})<br>
        <strong>Total Data:</strong> ${logData.length} aktivitas<br>
        ${filterInfo ? `<strong>Filter:</strong> ${filterInfo}<br>` : ''}
      </div>
      <table class="pdf-table">
        <thead>
          <tr>
            <th style="width:15%">Waktu</th>
            <th style="width:10%">User</th>
            <th style="width:8%">Aksi</th>
            <th style="width:10%">Modul</th>
            <th style="width:40%">Detail</th>
            <th style="width:12%">IP Address</th>
          </tr>
        </thead>
        <tbody>
  `;
  
  logData.forEach((item, index) => {
    htmlContent += `
      <tr>
        <td>${escapeHtml(item.waktu)}</td>
        <td>${escapeHtml(item.user)}</td>
        <td>${escapeHtml(item.aksi)}</td>
        <td>${escapeHtml(item.modul)}</td>
        <td>${escapeHtml(item.detail)}</td>
        <td>${escapeHtml(item.ip)}</td>
      </tr>
    `;
  });
  
  htmlContent += `
        </tbody>
      </table>
      <div class="pdf-footer">
        <p>Dokumen ini dibuat secara otomatis oleh sistem SMB Bappeda Banyuwangi</p>
        <p>* Laporan ini merupakan bukti sah aktivitas sistem</p>
      </div>
    </div>
  `;
  
  Swal.fire({
    title: 'Membuat PDF...',
    text: 'Mohon tunggu, sedang memproses export data',
    allowOutsideClick: false,
    didOpen: () => Swal.showLoading()
  });
  
  const element = document.createElement('div');
  element.innerHTML = htmlContent;
  document.body.appendChild(element);
  
  const opt = {
    margin: [0.5, 0.5, 0.5, 0.5],
    filename: `Log_Aktivitas_SMB_${now.getFullYear()}-${(now.getMonth()+1).toString().padStart(2,'0')}-${now.getDate().toString().padStart(2,'0')}.pdf`,
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2, letterRendering: true, useCORS: true },
    jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
  };
  
  html2pdf().set(opt).from(element).save().then(() => {
    document.body.removeChild(element);
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: 'File PDF telah berhasil di-download',
      timer: 2000,
      showConfirmButton: false
    });
  }).catch(error => {
    document.body.removeChild(element);
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: 'Terjadi kesalahan saat membuat PDF'
    });
  });
}

// ==================== MANAJEMEN PRINTER (SEPERTI WPS OFFICE) ====================

let printersList = [];
let selectedPrinterId = null;
let defaultPrinter = null;

/**
 * Load daftar printer untuk manajemen
 */
function loadPrinterManagement() {
    const container = document.getElementById('printer-list-manager');
    container.innerHTML = '<div class="empty-state"><div class="modern-spinner"></div><p>Memuat daftar printer...</p></div>';
    
    $.ajax({
        url: '<?= base_url('IDE/get_printers') ?>',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                printersList = response.data;
                renderPrinterManagementList(printersList);
                updatePrinterStats(printersList);
                
                // Set default printer (yang pertama atau yang status online)
                const onlinePrinters = printersList.filter(p => p.status === 'online');
                if (onlinePrinters.length > 0) {
                    defaultPrinter = onlinePrinters[0];
                } else if (printersList.length > 0) {
                    defaultPrinter = printersList[0];
                }
                
                // Simpan default printer ke localStorage
                if (defaultPrinter) {
                    localStorage.setItem('default_printer_id', defaultPrinter.id_printer);
                }
            } else {
                container.innerHTML = '<div class="empty-state">❌ Gagal memuat daftar printer</div>';
            }
        },
        error: function() {
            container.innerHTML = '<div class="empty-state">⚠️ Error koneksi ke server</div>';
        }
    });
}

/**
 * Render daftar printer untuk manajemen (seperti WPS Office)
 */
function renderPrinterManagementList(printers) {
    const container = document.getElementById('printer-list-manager');
    
    if (!printers || printers.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <div style="font-size:48px;">🖨️</div>
                <p>Belum ada printer terdaftar</p>
                <button class="btn btn-primary" onclick="showAddPrinterModal()" style="margin-top:15px;">
                    + Tambah Printer
                </button>
            </div>`;
        return;
    }
    
    container.innerHTML = `
        <div style="display:flex; flex-direction:column; gap:12px;">
            ${printers.map(printer => `
                <div class="printer-manager-card" data-printer-id="${printer.id_printer}" style="
                    border: 2px solid ${selectedPrinterId === printer.id_printer ? 'var(--blue-600)' : 'var(--border)'};
                    border-radius: var(--radius);
                    padding: 16px;
                    background: ${selectedPrinterId === printer.id_printer ? 'var(--blue-50)' : 'var(--surface)'};
                    transition: all 0.2s;
                ">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                        <div style="flex:1;">
                            <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                                <span class="printer-status ${printer.status}" style="width:12px; height:12px;"></span>
                                <strong style="font-size:14px;">${escapeHtml(printer.nama_printer)}</strong>
                                ${printer.status === 'online' ? '<span class="pill pill-done" style="font-size:9px;">Online</span>' : '<span class="pill pill-danger" style="font-size:9px;">Offline</span>'}
                                ${selectedPrinterId === printer.id_printer ? '<span class="pill pill-print" style="background:#2563eb; color:white;">Default</span>' : ''}
                            </div>
                            <div style="font-size:12px; color:var(--text-2); margin-bottom:4px;">
                                <i class="fas fa-map-marker-alt"></i> ${escapeHtml(printer.lokasi)}
                            </div>
                            <div style="font-size:11px; color:var(--text-3); margin-bottom:8px;">
                                <i class="fas fa-plug"></i> ${printer.connection_display}
                            </div>
                            <div style="display:flex; gap:15px; font-size:12px;">
                                <span>📄 Stock: <strong>${printer.stock_kertas}</strong> / ${printer.kapasitas_kertas}</span>
                                <span>📊 Total print: <strong>${printer.total_print_count || 0}</strong></span>
                            </div>
                            ${printer.is_low_stock ? '<div style="color:var(--red); font-size:11px; margin-top:5px;">⚠️ Stock menipis! Segera isi ulang.</div>' : ''}
                        </div>
                        <div style="display:flex; gap:8px;">
                            <button class="btn btn-sm" onclick="setAsDefaultPrinter(${printer.id_printer})" style="padding:4px 10px;" title="Jadikan default">
                                <i class="fas fa-star"></i> Default
                            </button>
                            <button class="btn btn-sm" onclick="testPrinterConnectionManager(${printer.id_printer})" style="padding:4px 10px;" title="Test koneksi">
                                <i class="fas fa-plug"></i> Test
                            </button>
                            <button class="btn btn-sm" onclick="addPaperStockManager(${printer.id_printer})" style="padding:4px 10px;" title="Tambah kertas">
                                <i class="fas fa-plus"></i> Kertas
                            </button>
                            <button class="btn btn-sm" onclick="deletePrinterManager(${printer.id_printer})" style="padding:4px 10px; color:var(--red);" title="Hapus printer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `).join('')}
        </div>
        <div style="margin-top:15px; text-align:center;">
            <button class="btn" onclick="showAddPrinterModal()" style="border:1px dashed var(--blue-600); color:var(--blue-600);">
                <i class="fas fa-plus"></i> Tambah Printer Baru
            </button>
        </div>
    `;
}

/**
 * Set printer sebagai default
 */
function setAsDefaultPrinter(printerId) {
    const printer = printersList.find(p => p.id_printer === printerId);
    if (printer) {
        defaultPrinter = printer;
        selectedPrinterId = printerId;
        localStorage.setItem('default_printer_id', printerId);
        
        // Update tampilan
        renderPrinterManagementList(printersList);
        
        Swal.fire({
            icon: 'success',
            title: 'Printer Default',
            text: `${printer.nama_printer} sekarang menjadi printer default`,
            timer: 1500,
            showConfirmButton: false
        });
    }
}

/**
 * Test koneksi printer dari manajemen
 */
function testPrinterConnectionManager(printerId) {
    Swal.fire({
        title: 'Testing Koneksi...',
        text: 'Mohon tunggu',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    
    $.ajax({
        url: '<?= base_url('IDE/test_printer_connection') ?>',
        type: 'POST',
        data: { id_printer: printerId },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Koneksi Berhasil',
                    html: `✅ ${response.message}<br>⚡ Response: ${response.response_time_ms} ms`,
                    timer: 2000
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Koneksi Gagal',
                    html: `❌ ${response.message}<br><br>💡 Periksa kabel/koneksi printer`
                });
            }
            refreshPrinterList();
        },
        error: function() {
            Swal.close();
            Swal.fire('Error', 'Gagal melakukan test koneksi', 'error');
        }
    });
}

/**
 * Tambah stock kertas dari manajemen
 */
function addPaperStockManager(printerId) {
    Swal.fire({
        title: 'Tambah Stock Kertas',
        input: 'number',
        inputLabel: 'Jumlah lembar',
        inputValue: 500,
        inputAttributes: {
            min: 1,
            max: 500,
            step: 1
        },
        showCancelButton: true,
        confirmButtonText: 'Tambah',
        cancelButtonText: 'Batal',
        preConfirm: (jumlah) => {
            if (!jumlah || jumlah <= 0) {
                Swal.showValidationMessage('Jumlah tidak valid');
                return false;
            }
            return parseInt(jumlah);
        }
    }).then((result) => {
        if (result.isConfirmed) {
            addPaperStock(printerId, result.value);
        }
    });
}

/**
 * Hapus printer dari manajemen
 */
function deletePrinterManager(printerId) {
    const printer = printersList.find(p => p.id_printer === printerId);
    
    Swal.fire({
        title: 'Hapus Printer?',
        text: `Apakah Anda yakin ingin menghapus "${printer?.nama_printer}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('IDE/delete_printer') ?>',
                type: 'POST',
                data: { id_printer: printerId },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Terhapus!', response.message, 'success');
                        refreshPrinterList();
                        if (defaultPrinter?.id_printer === printerId) {
                            defaultPrinter = null;
                            localStorage.removeItem('default_printer_id');
                        }
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Gagal menghapus printer', 'error');
                }
            });
        }
    });
}

/**
 * Refresh daftar printer
 */
function refreshPrinterList() {
    loadPrinterManagement();
    loadRealPrinters(); // Untuk modal print
}

/**
 * Update statistik printer
 */
function updatePrinterStats(printers) {
    const total = printers.length;
    const online = printers.filter(p => p.status === 'online').length;
    const totalPaper = printers.reduce((sum, p) => sum + (p.stock_kertas || 0), 0);
    const totalPrint = printers.reduce((sum, p) => sum + (p.total_print_count || 0), 0);
    
    document.getElementById('printer-total-count').textContent = total;
    document.getElementById('printer-online-count').textContent = online;
    document.getElementById('printer-paper-total').textContent = totalPaper.toLocaleString();
    document.getElementById('printer-print-total').textContent = totalPrint.toLocaleString();
}

/**
 * Filter printer list
 */
function filterPrinterList() {
    const search = document.getElementById('printer-search')?.value.toLowerCase() || '';
    const filtered = printersList.filter(p => 
        p.nama_printer.toLowerCase().includes(search) || 
        p.lokasi.toLowerCase().includes(search)
    );
    renderPrinterManagementList(filtered);
}

/**
 * Buka manajemen printer dari modal print
 */
function openPrinterManager() {
    closePrintModal();
    navigateToPanel('printer');
}

/**
 * Print sederhana (langsung ke default printer)
 */
function executePrintSimple() {
    if (!defaultPrinter) {
        Swal.fire({
            icon: 'warning',
            title: 'Tidak Ada Printer',
            text: 'Silakan tambah dan set default printer terlebih dahulu',
            showConfirmButton: true
        }).then(() => {
            navigateToPanel('printer');
        });
        return;
    }
    
    if (defaultPrinter.status !== 'online') {
        Swal.fire({
            icon: 'error',
            title: 'Printer Offline',
            text: `Printer ${defaultPrinter.nama_printer} sedang offline. Periksa koneksi printer.`,
            showConfirmButton: true
        });
        return;
    }
    
    const jumlahCopy = parseInt(document.getElementById('print-jumlah-copy').value) || 1;
    const totalKertas = jumlahCopy;
    
    if (defaultPrinter.stock_kertas < totalKertas) {
        Swal.fire({
            icon: 'error',
            title: 'Stock Tidak Cukup',
            text: `Stock kertas: ${defaultPrinter.stock_kertas} lembar`,
            footer: '<a href="#" onclick="openPrinterManager()">Kelola printer</a>'
        });
        return;
    }
    
    Swal.fire({
        title: 'Memproses Print...',
        text: `Mengirim ke ${defaultPrinter.nama_printer}`,
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    
    $.ajax({
        url: '<?= base_url('IDE/print_dokumen') ?>',
        type: 'POST',
        data: {
            id_dokumen: currentPrintDokumen.id_dokumen,
            id_printer: defaultPrinter.id_printer,
            jumlah_halaman: 1,
            jumlah_kertas: totalKertas,
            jumlah_copy: jumlahCopy
        },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            closePrintModal();
            
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '✅ Print Berhasil!',
                    html: `
                        Printer: ${response.data.printer}<br>
                        Jumlah Kertas: ${response.data.jumlah_kertas} lembar<br>
                        Sisa Kertas: ${response.data.sisa_kertas} lembar
                    `,
                    timer: 3000
                });
                
                if (currentBidangId) loadDokumenFromDB(currentBidangId);
                loadDashboardStats();
                if (document.querySelector('.panel.active')?.id === 'panel-log') {
                    loadLogAktivitas();
                }
            } else {
                Swal.fire('❌ Print Gagal!', response.message, 'error');
            }
        },
        error: function() {
            Swal.close();
            Swal.fire('Error!', 'Terjadi kesalahan saat print', 'error');
        }
    });
}

/**
 * Update ringkasan print sederhana
 */
function updatePrintSummarySimple() {
    const jumlahCopy = parseInt(document.getElementById('print-jumlah-copy').value) || 1;
    const totalKertas = jumlahCopy;
    
    const summaryDiv = document.getElementById('print-summary-simple');
    
    if (!defaultPrinter) {
        summaryDiv.innerHTML = '<div class="empty-state">⚠️ Belum ada printer default. <a href="#" onclick="openPrinterManager()">Tambahkan printer</a></div>';
        return;
    }
    
    const stockAfter = defaultPrinter.stock_kertas - totalKertas;
    const isStockEnough = stockAfter >= 0;
    
    summaryDiv.innerHTML = `
        <div class="print-summary-item">
            <span>📄 Dokumen:</span>
            <strong>${escapeHtml(currentPrintDokumen?.nama_dokumen || '-')}</strong>
        </div>
        <div class="print-summary-item">
            <span>📋 Jumlah Copy:</span>
            <strong>${jumlahCopy} x</strong>
        </div>
        <div class="print-summary-item">
            <span>📄 Total Kertas:</span>
            <strong>${totalKertas} lembar</strong>
        </div>
        <div class="print-summary-item">
            <span>📊 Stock Setelah Print:</span>
            <strong style="color: ${isStockEnough ? 'green' : 'red'}">
                ${stockAfter} lembar
            </strong>
        </div>
    `;
}

/**
 * Load default printer dari localStorage
 */
function loadDefaultPrinter() {
    const savedId = localStorage.getItem('default_printer_id');
    if (savedId && printersList.length > 0) {
        const found = printersList.find(p => p.id_printer == savedId);
        if (found) {
            defaultPrinter = found;
            selectedPrinterId = found.id_printer;
        } else if (printersList.length > 0) {
            defaultPrinter = printersList[0];
            selectedPrinterId = printersList[0].id_printer;
        }
    } else if (printersList.length > 0) {
        defaultPrinter = printersList[0];
        selectedPrinterId = printersList[0].id_printer;
    }
    
    // Update tampilan default printer di modal
    if (defaultPrinter) {
        document.getElementById('default-printer-name').textContent = defaultPrinter.nama_printer;
        document.getElementById('default-printer-stock').innerHTML = `Stock: ${defaultPrinter.stock_kertas} lembar | Status: ${defaultPrinter.status.toUpperCase()}`;
    } else {
        document.getElementById('default-printer-name').textContent = 'Belum ada printer';
        document.getElementById('default-printer-stock').innerHTML = 'Silakan tambah printer terlebih dahulu';
    }
}

// ================= INISIALISASI SAAT HALAMAN SIAP =================
$(document).ready(function() {
  console.log('Document Ready - Inisialisasi SMB Bappeda');
  
  // ========== 1. INISIALISASI VARIABEL GLOBAL ==========
  if (typeof currentBidangId === 'undefined') {
    currentBidangId = 'a';
  }
  if (typeof currentBidang === 'undefined') {
    currentBidang = 'a';
  }
  
  // ========== 2. CEK AKTIFKAN BIDANG PERTAMA ==========
  const activeNav = document.querySelector('.nav-item.open');
  if (activeNav && activeNav.id) {
    const match = activeNav.id.match(/nav-b([a-e])/);
    if (match) {
      currentBidangId = match[1];
      currentBidang = match[1];
      console.log('Bidang aktif ditemukan:', currentBidangId);
    }
  }

  $(document).on('click', '#printFromPreviewBtn', function() {
    printFromPreview();
});
  
  
  // ========== 3. LOAD DASHBOARD STATS ==========
  loadDashboardStats();
  
  // ========== 4. EVENT LISTENER FORM UPLOAD ==========
  $('#formUploadDokumen').off('submit').on('submit', function(e) {
    e.preventDefault();
    
    const fileInput = document.querySelector('input[name="file_dokumen"]');
    if (!fileInput.files || fileInput.files.length === 0) {
      Swal.fire('Error!', 'Pilih file terlebih dahulu', 'error');
      return;
    }
    
    const formData = new FormData(this);
    
    Swal.fire({
      title: 'Uploading...',
      text: 'Mohon tunggu, sedang mengupload dokumen',
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading()
    });
    
    $.ajax({
      url: '<?= base_url('IDE/upload_dokumen') ?>',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      timeout: 30000,
      success: function(response) {
        Swal.close();
        if (response.status === 'success') {
          Swal.fire('Berhasil!', response.message, 'success');
          closeUploadModal();
          if (currentBidangId) loadDokumenFromDB(currentBidangId);
          loadDashboardStats();
        } else {
          Swal.fire('Error!', response.message || 'Gagal upload dokumen', 'error');
        }
      },
      error: function(xhr, status, error) {
        Swal.close();
        let errorMsg = 'Terjadi kesalahan saat upload';
        if (xhr.responseJSON && xhr.responseJSON.message) errorMsg = xhr.responseJSON.message;
        else if (status === 'timeout') errorMsg = 'Timeout, file terlalu besar atau koneksi lambat';
        Swal.fire('Error!', errorMsg, 'error');
        console.error('Upload error:', error);
      }
    });
    // ========== LOAD PANEL PRINTER SAAT AKTIF ==========
const printerObserver = new MutationObserver(function() {
    const activePanel = document.querySelector('.panel.active');
    if (activePanel && activePanel.id === 'panel-printer') {
        console.log('Panel printer aktif, memuat data...');
        loadPrinterManagement();
    }
});

printerObserver.observe(document.body, {
    attributes: true,
    attributeFilter: ['class'],
    subtree: true
});
  });
  
  // ========== 5. DETEKSI PERUBAHAN PANEL UNTUK LOAD LOG ==========
  const logObserver = new MutationObserver(function() {
    const activePanel = document.querySelector('.panel.active');
    if (activePanel && activePanel.id === 'panel-log') {
      console.log('Panel log aktif, memuat data...');
      loadLogAktivitas();
    }
  });
  
  logObserver.observe(document.body, {
    attributes: true,
    attributeFilter: ['class'],
    subtree: true
  });
  
  // ========== 6. EVENT LISTENER SEARCH & FILTER ==========
  $('#bidang-search').on('input', function() {
    filterBidangTable();
  });
  
  $('#bidang-status-filter').on('change', function() {
    filterBidangTable();
  });
  
  // ========== 7. EVENT LISTENER UNTUK FILTER LOG ==========
  $('#log-search').on('input', function() {
    filterLogTable();
  });
  
  $('#log-aksi-filter').on('change', function() {
    filterLogTable();
  });
  
  // ========== DISPLAY DATE & TIME WIB - REKOMENDASI ==========
function updateDateTimeWIB() {
    const now = new Date();
    
    // Format tanggal
    const dateOptions = {
        timeZone: 'Asia/Jakarta',
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    
    // Format jam
    const timeOptions = {
        timeZone: 'Asia/Jakarta',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    };
    
    const dateStr = now.toLocaleDateString('id-ID', dateOptions);
    const timeStr = now.toLocaleTimeString('id-ID', timeOptions);
    
    const greetingDate = document.getElementById('greeting-date');
    const heroDateText = document.getElementById('hero-date-text');
    
    if (greetingDate) greetingDate.textContent = `${dateStr} | ${timeStr} WIB`;
    if (heroDateText) heroDateText.textContent = dateStr;
}

// Panggil pertama kali
updateDateTimeWIB();

// Update setiap detik (biar jam berjalan)
setInterval(updateDateTimeWIB, 1000);
  
  // ========== 9. EVENT LISTENER UNTUK TOMBOL LOGOUT ==========
  const logoutBtn = document.querySelector('.logout-btn');
  if (logoutBtn) {
    logoutBtn.removeEventListener('click', handleLogout);
    logoutBtn.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      handleLogout();
    });
    logoutBtn.style.cursor = 'pointer';
  }
  
  // ========== 10. AUTO REFRESH DOKUMEN ==========
  const observer = new MutationObserver(function() {
    const activePanel = document.querySelector('.panel.active');
    if (activePanel && activePanel.id === 'panel-bidang' && currentBidangId) {
      loadDokumenFromDB(currentBidangId);
    }
  });
  
  observer.observe(document.body, {
    attributes: true,
    attributeFilter: ['class'],
    subtree: true
  });
  
  console.log('Inisialisasi selesai. Current bidang:', currentBidangId);
});


</script>
</body>
</html>