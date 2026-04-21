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

.tbl {
  width: 100%;
  border-collapse: collapse;
  font-size: 12.5px;
}
.tbl th {
  text-align: left;
  padding: 9px 14px;
  font-size: 11px; font-weight: 600;
  color: var(--text-2);
  background: #f8f9fd;
  border-bottom: 1px solid var(--border);
  white-space: nowrap;
  letter-spacing: 0.02em;
  text-transform: uppercase;
}
.tbl td {
  padding: 10px 14px;
  border-bottom: 1px solid var(--border);
  vertical-align: middle;
}
.tbl tr:last-child td { border-bottom: none; }
.tbl tbody tr { transition: var(--transition); }
.tbl tbody tr:hover { background: #f8f9fd; }

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

      <div class="nav-section">Menu Bidang</div>

<!-- Bidang Litbang -->
<div class="nav-item" id="nav-ba" onclick="toggleBidang('a','Bidang Penelitian, Pengembangan dan Pengendalian Evaluasi')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 010 2H7a1 1 0 01-1-1zm1 3a1 1 0 000 2h4a1 1 0 000-2H7z" clip-rule="evenodd"/>
  </svg>
  Bidang Litbang
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-ba">
  <div class="sub-item" onclick="navigateDok('a','Litbang')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>

<!-- Bidang Perencanaan -->
<div class="nav-item" id="nav-bb" onclick="toggleBidang('b','Bidang Perencanaan Pembangunan')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 010 2H7a1 1 0 01-1-1zm1 3a1 1 0 000 2h4a1 1 0 000-2H7z" clip-rule="evenodd"/>
  </svg>
  Bidang Perencanaan
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-bb">
  <div class="sub-item" onclick="navigateDok('b','Perencanaan')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>

<!-- Bidang Ekonomi -->
<div class="nav-item" id="nav-bc" onclick="toggleBidang('c','Bidang Ekonomi')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 010 2H7a1 1 0 01-1-1zm1 3a1 1 0 000 2h4a1 1 0 000-2H7z" clip-rule="evenodd"/>
  </svg>
  Bidang Ekonomi
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-bc">
  <div class="sub-item" onclick="navigateDok('c','Ekonomi')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>

<!-- Bidang Kesra -->
<div class="nav-item" id="nav-bd" onclick="toggleBidang('d','Bidang Kesejahteraan Rakyat dan Pemerintahan')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 010 2H7a1 1 0 01-1-1zm1 3a1 1 0 000 2h4a1 1 0 000-2H7z" clip-rule="evenodd"/>
  </svg>
  Bidang Kesra
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-bd">
  <div class="sub-item" onclick="navigateDok('d','Kesra')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
</div>
<!-- Bidang Sarpras -->
<div class="nav-item" id="nav-be" onclick="toggleBidang('e','Bidang Sarana Prasarana Wilayah dan Lingkungan')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 010 2H7a1 1 0 01-1-1zm1 3a1 1 0 000 2h4a1 1 0 000-2H7z" clip-rule="evenodd"/>
  </svg>
  Bidang Sarpras
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-be">
  <div class="sub-item" onclick="navigateDok('e','Sarpras')">
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

        <!-- HERO -->
        <div class="hero-banner">
          <div class="hero-left">
            <div class="hero-eyebrow" id="hero-date-text"></div>
            <div class="hero-title">Sistem Manajemen Printer<br>dan Arsip Dokumen</div>
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
              <div class="hero-card-num">150</div>
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
              <div class="hero-card-num">60</div>
              <div class="hero-card-label">Total User</div>
            </div>
          </div>
        </div>

        <!-- STATS -->
        <div class="stat-grid">
          <div class="stat-card">
            <div class="stat-label">Total User</div>
            <div class="stat-row">
              <div class="stat-val">60</div>
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
              <div class="stat-val">150</div>
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
              <div class="stat-val">89</div>
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
              <div class="stat-val">2,040</div>
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
                  <th style="width:80px;">Aksi</th>
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
  <svg viewBox="0 0 16 16" fill="currentColor"><path d="M8 2a1 1 0 011 1v4h4a1 1 0 010 2H9v4a1 1 0 01-2 0V9H3a1 1 0 010-2h4V3a1 1 0 011-1z"/></svg>
  Upload Dokumen
</button>
  </div>

  <!-- Category Cards -->
  <div class="doc-cat-grid">
    <div class="doc-cat-card">
      <div class="doc-cat-icon" style="background:#eff4ff;">
        <svg viewBox="0 0 18 18" fill="var(--blue-600)"><path fill-rule="evenodd" d="M3 3a2 2 0 012-2h5.586A2 2 0 0112 1.586L15.414 5A2 2 0 0116 6.414V15a2 2 0 01-2 2H5a2 2 0 01-2-2V3zm9 0v3h3L12 3z" clip-rule="evenodd"/></svg>
      </div>
      <div class="doc-cat-name">Surat Keputusan</div>
      <div class="doc-cat-count">12 dokumen</div>
    </div>
    <div class="doc-cat-card">
      <div class="doc-cat-icon" style="background:#fffbeb;">
        <svg viewBox="0 0 18 18" fill="var(--amber)"><path d="M2 4a2 2 0 012-2h5l2 2h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V4z"/></svg>
      </div>
      <div class="doc-cat-name">Laporan</div>
      <div class="doc-cat-count">8 dokumen</div>
    </div>
    <div class="doc-cat-card">
      <div class="doc-cat-icon" style="background:var(--green-bg);">
        <svg viewBox="0 0 18 18" fill="var(--green)"><path d="M3 3a1 1 0 011-1h10a1 1 0 010 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h10a1 1 0 010 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h6a1 1 0 010 2H4a1 1 0 01-1-1z"/></svg>
      </div>
      <div class="doc-cat-name">Nota Dinas</div>
      <div class="doc-cat-count">5 dokumen</div>
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
        <button class="btn btn-sm">
          <svg viewBox="0 0 14 14" fill="currentColor"><path d="M2 2h10l-4 5v5l-2-1V7L2 2z"/></svg>
          Export
        </button>
        <button class="btn btn-sm btn-primary">+ Tambah</button>
      </div>
    </div>
    <table class="tbl">
      <thead>
        <tr>
          <th style="width:40px;">No</th>
          <th>Nama Dokumen</th>
          <th>Kategori</th>
          <th>Tanggal Upload</th>
          <th>Diupload Oleh</th>
          <th>Status</th>
          <th style="width:100px;">Aksi</th>
        </tr>
      </thead>
      <tbody id="bidang-tbody">
        <tr>
          <td colspan="7" style="text-align:center;padding:30px;color:var(--text-3);">Pilih bidang dari menu sidebar untuk melihat dokumen</td>
        </tr>
      </tbody>
    </table>
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
          <button class="btn">
            <svg viewBox="0 0 14 14" fill="currentColor"><path d="M7 1a6 6 0 100 12A6 6 0 007 1zm1 9H6V6h2v4zm0-5H6V3h2v2z"/></svg>
            Export Log
          </button>
        </div>
        <div class="card">
          <div class="table-toolbar">
            <div class="card-title">Riwayat Aktivitas</div>
            <div class="table-toolbar-right">
              <select class="sel-filter">
                <option>Semua Aksi</option>
                <option>Upload</option>
                <option>Print</option>
                <option>Review</option>
                <option>Login</option>
                <option>Update</option>
              </select>
              <div class="mini-search">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="5.5" cy="5.5" r="4"/><path d="M9 9l2.5 2.5"/></svg>
                <input type="text" placeholder="Cari aktivitas...">
              </div>
            </div>
          </div>
          <table class="tbl">
            <thead>
              <tr>
                <th>Waktu</th>
                <th>User</th>
                <th>Aksi</th>
                <th>Modul</th>
                <th>Detail</th>
                <th>IP</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>20/04 09:14</td><td>Admin</td><td><span class="pill pill-upload">Upload</span></td><td>Bidang A</td><td>SK Kepala Dinas No.12</td><td style="color:var(--text-3);">192.168.1.10</td></tr>
              <tr><td>20/04 08:52</td><td>Operator</td><td><span class="pill pill-print">Print</span></td><td>Printer</td><td>Canon G3010 — 3 halaman</td><td style="color:var(--text-3);">192.168.1.14</td></tr>
              <tr><td>20/04 08:30</td><td>Reviewer</td><td><span class="pill pill-review">Review</span></td><td>Bidang C</td><td>Proposal Anggaran Q2</td><td style="color:var(--text-3);">192.168.1.22</td></tr>
              <tr><td>20/04 08:01</td><td>System</td><td><span class="pill pill-login">Login</span></td><td>Auth</td><td>Rini Marlina berhasil masuk</td><td style="color:var(--text-3);">192.168.1.30</td></tr>
              <tr><td>19/04 16:45</td><td>Admin</td><td><span class="pill pill-done">Update</span></td><td>Bidang B</td><td>Status dokumen diperbarui</td><td style="color:var(--text-3);">192.168.1.10</td></tr>
              <tr><td>19/04 15:20</td><td>Operator</td><td><span class="pill pill-upload">Upload</span></td><td>Bidang D</td><td>Nota Dinas Koordinasi</td><td style="color:var(--text-3);">192.168.1.14</td></tr>
              <tr><td>19/04 14:05</td><td>Kepala</td><td><span class="pill pill-review">Review</span></td><td>Bidang A</td><td>Rencana Kerja Q2 disetujui</td><td style="color:var(--text-3);">192.168.1.5</td></tr>
              <tr><td>19/04 11:30</td><td>Admin</td><td><span class="pill pill-print">Print</span></td><td>Printer</td><td>Epson L3110 — 8 halaman</td><td style="color:var(--text-3);">192.168.1.10</td></tr>
            </tbody>
          </table>
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
  <div style="background:#fff; border-radius:16px; width:800px; max-width:90%; max-height:90%; overflow:auto; padding:20px;">
    <div style="display:flex; justify-content:space-between; margin-bottom:15px;">
      <h3 id="previewTitle" style="font-size:18px;">Preview Dokumen</h3>
      <span onclick="closePreviewModal()" style="cursor:pointer; font-size:24px;">&times;</span>
    </div>
    <div id="previewContent" style="text-align:center;"></div>
  </div>
</div>
    </main>
  </div>
</div>

<!-- ============================================================
     JAVASCRIPT
     ============================================================ -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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

// Mapping ID bidang ke nama lengkap
// Mapping ID bidang ke nama lengkap
const bidangFullName = {
  a: 'Bidang Penelitian, Pengembangan dan Pengendalian Evaluasi',
  b: 'Bidang Perencanaan Pembangunan',
  c: 'Bidang Ekonomi',
  d: 'Bidang Kesejahteraan Rakyat dan Pemerintahan',
  e: 'Bidang Sarana Prasarana Wilayah dan Lingkungan'
};

// Mapping ID bidang ke nama pendek untuk navigasi
const bidangShortName = {
  a: 'Litbang',
  b: 'Perencanaan',
  c: 'Ekonomi',
  d: 'Kesra',
  e: 'Sarpras'
};

const bidangData = {
  a: { 
    name: 'Bidang Penelitian, Pengembangan dan Pengendalian Evaluasi',
    shortName: 'Litbang',
    docs: [
      { no:1, nama:'SK No.001/2026', kategori:'Surat Keputusan', tgl:'15 Apr 2026', user:'Admin Bidang', status:'Selesai' },
      { no:2, nama:'Laporan Bulanan Februari', kategori:'Laporan', tgl:'12 Apr 2026', user:'Staf A1', status:'Review' },
      { no:3, nama:'Nota Dinas 03/IV/2026', kategori:'Nota Dinas', tgl:'10 Apr 2026', user:'Kepala Bidang', status:'On Going' },
      { no:4, nama:'Rencana Kerja Q2 2026', kategori:'Laporan', tgl:'08 Apr 2026', user:'Staf A2', status:'Selesai' },
      { no:5, nama:'SK Penunjukan Tim', kategori:'Surat Keputusan', tgl:'05 Apr 2026', user:'Admin Bidang', status:'Selesai' },
    ]
  },
  b: { 
    name: 'Bidang Perencanaan Pembangunan',
    shortName: 'Perencanaan',
    docs: [
      { no:1, nama:'Laporan Kinerja Q1', kategori:'Laporan', tgl:'17 Apr 2026', user:'Staf B1', status:'Selesai' },
      { no:2, nama:'SK Pengangkatan Pejabat', kategori:'Surat Keputusan', tgl:'14 Apr 2026', user:'Kepala Bidang', status:'Review' },
      { no:3, nama:'Nota Dinas Rapat Koordinasi', kategori:'Nota Dinas', tgl:'11 Apr 2026', user:'Admin Bidang', status:'On Going' },
      { no:4, nama:'Rekap Kehadiran April', kategori:'Laporan', tgl:'09 Apr 2026', user:'Staf B2', status:'On Going' },
    ]
  },
  c: { 
    name: 'Bidang Ekonomi',
    shortName: 'Ekonomi',
    docs: [
      { no:1, nama:'Proposal Anggaran Q2', kategori:'Laporan', tgl:'19 Apr 2026', user:'Staf C1', status:'Review' },
      { no:2, nama:'SK Penyesuaian Tarif', kategori:'Surat Keputusan', tgl:'13 Apr 2026', user:'Kepala Bidang', status:'Selesai' },
      { no:3, nama:'Rekapitulasi Dana Kegiatan', kategori:'Laporan', tgl:'09 Apr 2026', user:'Admin Bidang', status:'On Going' },
    ]
  },
  d: { 
    name: 'Bidang Kesejahteraan Rakyat dan Pemerintahan',
    shortName: 'Kesra',
    docs: [
      { no:1, nama:'Nota Dinas Koordinasi Lintas', kategori:'Nota Dinas', tgl:'17 Apr 2026', user:'Admin Bidang', status:'Selesai' },
      { no:2, nama:'SK Bidang D No.05/2026', kategori:'Surat Keputusan', tgl:'10 Apr 2026', user:'Kepala Bidang', status:'Selesai' },
      { no:3, nama:'Laporan Evaluasi Semester', kategori:'Laporan', tgl:'07 Apr 2026', user:'Staf D1', status:'On Going' },
      { no:4, nama:'Nota Kebutuhan Anggaran', kategori:'Nota Dinas', tgl:'04 Apr 2026', user:'Staf D2', status:'Review' },
    ]
  },
  e: { 
    name: 'Bidang Sarana Prasarana Wilayah dan Lingkungan',
    shortName: 'Sarpras',
    docs: [
      { no:1, nama:'Perencanaan Infrastruktur Jalan', kategori:'Laporan', tgl:'20 Apr 2026', user:'Staf E1', status:'Selesai' },
      { no:2, nama:'SK Pembangunan Pasar', kategori:'Surat Keputusan', tgl:'18 Apr 2026', user:'Kepala Bidang', status:'Review' },
      { no:3, nama:'Nota Dinas Pengadaan Alat Berat', kategori:'Nota Dinas', tgl:'15 Apr 2026', user:'Admin Bidang', status:'On Going' },
      { no:4, nama:'Rencana Tata Ruang Wilayah', kategori:'Laporan', tgl:'12 Apr 2026', user:'Staf E2', status:'Selesai' },
      { no:5, nama:'SK Penataan Lingkungan', kategori:'Surat Keputusan', tgl:'10 Apr 2026', user:'Kepala Bidang', status:'On Going' },
      { no:6, nama:'Laporan Pengelolaan Sampah', kategori:'Laporan', tgl:'08 Apr 2026', user:'Staf E3', status:'Review' },
    ]
  },
};

let currentBidang = null;

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

/* ---- BIDANG ACCORDION ---- */
function toggleBidang(id, name) {
  const navEl = document.getElementById('nav-b' + id);
  const subEl = document.getElementById('sub-b' + id);
  const isOpen = subEl.classList.contains('open');

  // close all (tambah 'e')
  ['a','b','c','d','e'].forEach(x => {
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

function navigateDok(id, shortName) {
  currentBidang = id;
  const data = bidangData[id];
  
  // Gunakan nama lengkap dari data
  const fullName = data.name;
  const short = data.shortName;
  
  // Set judul halaman dengan nama lengkap
  document.getElementById('bidang-title').textContent = fullName;
  document.getElementById('bidang-doc-title').textContent = `Daftar Dokumen — ${fullName}`;
  
  // Set subtitle dengan nama pendek
  const bidangSubtitle = document.querySelector('#panel-bidang .page-hdr-sub');
  if (bidangSubtitle) {
    bidangSubtitle.textContent = `Manajemen Dokumen ${short}`;
  }

  // clear filters
  const searchInput = document.getElementById('bidang-search');
  const filterSelect = document.getElementById('bidang-status-filter');
  if (searchInput) searchInput.value = '';
  if (filterSelect) filterSelect.value = '';

  renderBidangTable(data.docs);
  showPanel('bidang');

  // deactivate other nav items
  document.querySelectorAll('.nav-item[data-panel]').forEach(n => n.classList.remove('active'));

  // mark sub-item active
  document.querySelectorAll('.sub-item').forEach(s => s.classList.remove('active'));
  const subItems = document.querySelectorAll('#sub-b' + id + ' .sub-item');
  if (subItems.length) subItems[0].classList.add('active');
}

/* ---- TABLE RENDER ---- */
const pillMap = {
  'Selesai':  'pill-done',
  'Review':   'pill-review',
  'On Going': 'pill-progress',
};

function renderBidangTable(docs) {
  const tbody = document.getElementById('bidang-tbody');
  if (!docs || docs.length === 0) {
    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:30px;color:var(--text-3);">Tidak ada dokumen ditemukan.</td></tr>`;
    return;
  }
  tbody.innerHTML = docs.map(d => `
    <tr>
      <td>${d.no}</td>
      <td>${d.nama}</td>
      <td>${d.kategori}</td>
      <td>${d.tgl}</td>
      <td>${d.user}</td>
      <td><span class="pill ${pillMap[d.status] || ''}">${d.status}</span></td>
      <td>
        <span class="link-act" style="margin-right:8px;">Lihat</span>
        <span class="link-danger">Hapus</span>
      </td>
    </tr>
  `).join('');
}

function filterBidangTable() {
  if (!currentBidang) return;
  const q = document.getElementById('bidang-search').value.toLowerCase();
  const st = document.getElementById('bidang-status-filter').value;
  const docs = bidangData[currentBidang].docs.filter(d => {
    const matchQ = !q || d.nama.toLowerCase().includes(q) || d.kategori.toLowerCase().includes(q);
    const matchSt = !st || d.status === st;
    return matchQ && matchSt;
  });
  renderBidangTable(docs);
}

// ================= UPLOAD DOKUMEN =================
let currentBidangId = null;

function openUploadModal(bidangId) {
  currentBidangId = bidangId;
  document.getElementById('upload_id_bidang').value = bidangId;
  document.getElementById('modalUpload').style.display = 'flex';
}

function closeUploadModal() {
  document.getElementById('modalUpload').style.display = 'none';
  document.getElementById('formUploadDokumen').reset();
}

// Submit upload form
$('#formUploadDokumen').on('submit', function(e) {
  e.preventDefault();
  
  const formData = new FormData(this);
  
  Swal.fire({
    title: 'Uploading...',
    text: 'Mohon tunggu',
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
    success: function(response) {
      const res = JSON.parse(response);
      Swal.close();
      
      if (res.status === 'success') {
        Swal.fire('Berhasil!', 'Dokumen berhasil diupload', 'success');
        closeUploadModal();
        // Refresh tabel dokumen
        if (currentBidangId) {
          loadDokumenFromDB(currentBidangId);
        }
      } else {
        Swal.fire('Error!', res.message, 'error');
      }
    },
    error: function() {
      Swal.close();
      Swal.fire('Error!', 'Terjadi kesalahan saat upload', 'error');
    }
  });
});

// ================= LOAD DOKUMEN FROM DATABASE =================
function loadDokumenFromDB(bidangId) {
  $.ajax({
    url: '<?= base_url('IDE/get_dokumen_by_bidang') ?>',
    type: 'POST',
    data: { id_bidang: bidangId },
    dataType: 'json',
    success: function(response) {
      if (response.status === 'success') {
        renderDokumenTable(response.data);
      }
    },
    error: function() {
      console.error('Gagal memuat dokumen');
    }
  });
}

// Render tabel dengan thumbnail
function renderDokumenTable(dokumen) {
  const tbody = document.getElementById('bidang-tbody');
  if (!dokumen || dokumen.length === 0) {
    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:30px;">Tidak ada dokumen</td></tr>`;
    return;
  }
  
  tbody.innerHTML = dokumen.map((doc, index) => {
    const isImage = doc.file_type.startsWith('image/');
    const thumbnailHtml = isImage && doc.thumbnail ? 
      `<img src="<?= base_url() ?>${doc.thumbnail}" class="doc-thumbnail" onclick="previewDokumen('${doc.file_path}', '${doc.file_type}', '${doc.nama_dokumen}')">` :
      `<div class="file-icon" onclick="previewDokumen('${doc.file_path}', '${doc.file_type}', '${doc.nama_dokumen}')">
         <i class="fas fa-file-pdf"></i>
       </div>`;
    
    return `
      <tr>
        <td>${index + 1}</td>
        <td>${thumbnailHtml}</td>
        <td>${doc.nama_dokumen}</td>
        <td>${doc.kategori}</td>
        <td>${doc.upload_date}</td>
        <td>${doc.uploaded_by}</td>
        <td><span class="pill ${getPillClass(doc.status)}">${doc.status}</span></td>
        <td>
          <span class="link-act" onclick="previewDokumen('${doc.file_path}', '${doc.file_type}', '${doc.nama_dokumen}')">Lihat</span>
          <span class="link-danger" onclick="deleteDokumen(${doc.id_dokumen})">Hapus</span>
        </td>
      </tr>
    `;
  }).join('');
}

function getPillClass(status) {
  const map = {
    'Selesai': 'pill-done',
    'Review': 'pill-review',
    'On Going': 'pill-progress'
  };
  return map[status] || '';
}

// ================= PREVIEW DOKUMEN =================
function previewDokumen(filePath, fileType, fileName) {
  document.getElementById('previewTitle').textContent = fileName;
  const previewDiv = document.getElementById('previewContent');
  
  if (fileType.startsWith('image/')) {
    previewDiv.innerHTML = `<img src="<?= base_url() ?>${filePath}" style="max-width:100%; max-height:70vh;">`;
  } else if (fileType === 'application/pdf') {
    previewDiv.innerHTML = `<iframe src="<?= base_url() ?>${filePath}" style="width:100%; height:70vh;" frameborder="0"></iframe>`;
  } else {
    previewDiv.innerHTML = `
      <div style="padding:40px; text-align:center;">
        <i class="fas fa-file" style="font-size:64px; color:var(--blue-600);"></i>
        <p style="margin-top:20px;">File tidak dapat dipreview langsung</p>
        <a href="<?= base_url() ?>${filePath}" class="btn btn-primary" download style="margin-top:15px;">
          Download File
        </a>
      </div>
    `;
  }
  
  document.getElementById('modalPreview').style.display = 'flex';
}

function closePreviewModal() {
  document.getElementById('modalPreview').style.display = 'none';
  document.getElementById('previewContent').innerHTML = '';
}

// ================= DELETE DOKUMEN =================
function deleteDokumen(idDokumen) {
  Swal.fire({
    title: 'Yakin hapus?',
    text: 'Dokumen akan dihapus permanen',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc2626',
    confirmButtonText: 'Ya, Hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '<?= base_url('IDE/delete_dokumen') ?>',
        type: 'POST',
        data: { id_dokumen: idDokumen },
        dataType: 'json',
        success: function(response) {
          if (response.status === 'success') {
            Swal.fire('Terhapus!', response.message, 'success');
            if (currentBidangId) {
              loadDokumenFromDB(currentBidangId);
            }
          } else {
            Swal.fire('Error!', response.message, 'error');
          }
        },
        error: function() {
          Swal.fire('Error!', 'Gagal menghapus dokumen', 'error');
        }
      });
    }
  });
}

// Update navigateDok untuk memuat dari database
const originalNavigateDok = navigateDok;
navigateDok = function(id, shortName) {
  currentBidangId = id;
  originalNavigateDok(id, shortName);
  loadDokumenFromDB(id);
};

/* ---- DATE ---- */
const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
const now = new Date();
const dateStr = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
document.getElementById('greeting-date').textContent = dateStr;
document.getElementById('hero-date-text').textContent = dateStr;
</script>
</body>
</html>