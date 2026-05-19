<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">


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
<title>Bappeda Smart Office Management</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>

  /* ============================================================
   PAGINATION STYLES
   ============================================================ */
.pagination-container {
    padding: 16px 20px;
    border-top: 1px solid var(--border);
    background: #ffffff;
    border-radius: 0 0 var(--radius-lg) var(--radius-lg);
}

.pagination {
    margin: 0;
    gap: 5px;
}

.pagination .page-item .page-link {
    color: var(--text-1);
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 500;
    transition: var(--transition);
}

.pagination .page-item .page-link:hover {
    background: var(--blue-50);
    border-color: var(--blue-400);
    color: var(--blue-600);
}

.pagination .page-item.active .page-link {
    background: var(--blue-600);
    border-color: var(--blue-600);
    color: #ffffff;
}

.pagination .page-item.disabled .page-link {
    color: var(--text-3);
    background: var(--page-bg);
    cursor: not-allowed;
    opacity: 0.6;
}

.pagination-info {
    display: flex;
    align-items: center;
    gap: 15px;
    font-size: 12px;
    color: var(--text-2);
}

.pagination-info select {
    height: 32px;
    padding: 0 10px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 12px;
    font-family: inherit;
    background: var(--surface);
    color: var(--text-1);
    outline: none;
    cursor: pointer;
}

.pagination-info select:focus {
    border-color: var(--blue-400);
}

/* Responsive pagination */
@media (max-width: 768px) {
    .pagination .page-item .page-link {
        padding: 4px 8px;
        font-size: 11px;
    }
    
    .pagination-info span {
        font-size: 11px;
    }
}

/* Empty State dengan pesan informatif */
.empty-state-table {
    text-align: center;
    padding: 80px 20px !important;
    background: #fafbff;
}

.empty-state-icon {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-state-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-1);
    margin-bottom: 8px;
}

.empty-state-message {
    font-size: 13px;
    color: var(--text-2);
    margin-bottom: 5px;
}

.empty-state-suggestion {
    font-size: 12px;
    color: var(--text-3);
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid var(--border);
    display: inline-block;
}

.empty-state-filter {
    background: #f0f4ff;
    border-radius: 12px;
    padding: 15px 20px;
    margin-top: 20px;
    text-align: left;
    display: inline-block;
}

.empty-state-filter p {
    margin: 5px 0;
    font-size: 12px;
}

.empty-state-filter i {
    margin-right: 8px;
    color: var(--blue-600);
}

/* Loading spinner */
.modern-spinner {
    width: 40px;
    height: 40px;
    border: 3px solid #e2e8f0;
    border-top-color: #3b82f6;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin: 0 auto 15px;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

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
   STAT KERTAS CARDS
   ============================================================ */
.stat-kertas-card {
    background: var(--surface);
    border-radius: var(--radius-lg);
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 15px;
    border: 1px solid var(--border);
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.stat-kertas-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.stat-kertas-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.bg-primary-light {
    background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
    color: #4338ca;
}

.bg-success-light {
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    color: #166534;
}

.bg-warning-light {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
}

.bg-info-light {
    background: linear-gradient(135deg, #cffafe, #a5f3fc);
    color: #0e7490;
}

.stat-kertas-info {
    flex: 1;
}

.stat-kertas-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-2);
    margin-bottom: 4px;
}

.stat-kertas-value {
    font-size: 28px;
    font-weight: 800;
    color: var(--text-1);
    line-height: 1.2;
    font-family: var(--font-main);
}

.stat-kertas-unit {
    font-size: 10px;
    color: var(--text-3);
    margin-left: 4px;
}

.total-kertas-container {
    background: linear-gradient(135deg, #1a2d6b 0%, #162060 100%);
    border-radius: var(--radius);
    padding: 15px 20px;
    margin-top: 15px;
}

.total-kertas-label {
    font-size: 13px;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.7);
    letter-spacing: 0.5px;
}

.total-kertas-label i {
    margin-right: 8px;
}

.total-kertas-value {
    font-size: 32px;
    font-weight: 800;
    color: #ffffff;
    font-family: var(--font-main);
}

.total-kertas-unit {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.6);
    margin-left: 5px;
}

/* Responsive */
@media (max-width: 768px) {
    .stat-kertas-card {
        padding: 12px;
    }
    
    .stat-kertas-icon {
        width: 40px;
        height: 40px;
    }
    
    .stat-kertas-icon i {
        font-size: 18px;
    }
    
    .stat-kertas-value {
        font-size: 20px;
    }
    
    .total-kertas-value {
        font-size: 24px;
    }
}

/* Modal Detail Rekap Print User */
.modal-user-rekap {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1002;
    align-items: center;
    justify-content: center;
}

.modal-user-rekap-content {
    background: white;
    border-radius: 20px;
    width: 750px;
    max-width: 90%;
    max-height: 85vh;
    overflow: auto;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    animation: modalSlideIn 0.3s ease;
}

.modal-user-rekap-header {
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #1a2d6b 0%, #162060 100%);
    color: white;
    border-radius: 20px 20px 0 0;
}

.modal-user-rekap-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.modal-user-rekap-close {
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.modal-user-rekap-close:hover {
    background: rgba(255,255,255,0.3);
    transform: scale(1.1);
}

.modal-user-rekap-body {
    padding: 24px;
}

.user-rekap-summary {
    background: linear-gradient(135deg, #f0f4ff 0%, #e8edf8 100%);
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 24px;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
}

.user-rekap-item {
    text-align: center;
    flex: 1;
    min-width: 100px;
}

.user-rekap-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    color: var(--text-2);
    margin-bottom: 8px;
    letter-spacing: 0.5px;
}

.user-rekap-value {
    font-size: 28px;
    font-weight: 800;
    color: var(--navy-700);
}

.user-rekap-unit {
    font-size: 10px;
    color: black;
    margin-top: 4px;
}

.user-detail-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
    margin-top: 15px;
}

.user-detail-table th {
    background: #f8f9fd;
    padding: 12px;
    text-align: left;
    font-weight: 600;
    color: var(--text-1);
    border-bottom: 2px solid var(--border);
}

.user-detail-table td {
    padding: 10px 12px;
    border-bottom: 1px solid var(--border);
}

.user-detail-table tr:hover {
    background: #f8f9fd;
}

.rekap-badge-user {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 500;
    background: var(--blue-50);
    color: var(--blue-600);
}

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

/* Badge Bidang di Log Aktivitas */
.log-bidang-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 10.5px;
    font-weight: 500;
    text-align: center;
    white-space: nowrap;
}

.log-bidang-litbang {
    background: #e0e7ff;
    color: #4338ca;
}

.log-bidang-perencanaan {
    background: #dcfce7;
    color: #166534;
}

.log-bidang-ekonomi {
    background: #fed7aa;
    color: #9a3412;
}

.log-bidang-kesra {
    background: #fbcfe8;
    color: #be185d;
}

.log-bidang-sarpras {
    background: #cffafe;
    color: #0e7490;
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

   /* Modal Detail Rekap Login */
.modal-user-rekap {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    z-index: 1002;
    align-items: center;
    justify-content: center;
}

.modal-user-rekap-content {
    background: white;
    border-radius: 20px;
    max-width: 900px;
    width: 90%;
    max-height: 85vh;
    overflow: auto;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    animation: modalSlideIn 0.3s ease;
}

.modal-user-rekap-header {
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #1a2d6b 0%, #162060 100%);
    color: white;
    border-radius: 20px 20px 0 0;
    position: sticky;
    top: 0;
    z-index: 10;
}

.modal-user-rekap-close {
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.modal-user-rekap-close:hover {
    background: rgba(255,255,255,0.3);
    transform: scale(1.1);
}

.modal-user-rekap-body {
    padding: 24px;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

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
   PDF EXPORT STYLES - LENGKAP DENGAN STATISTIK KERTAS
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

.pdf-filter-info {
    background: #f0f4ff;
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 10px;
    border-left: 3px solid #1a2d6b;
}

.pdf-filter-info p {
    margin: 3px 0;
}

.pdf-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 25px;
    page-break-inside: avoid;
}

.pdf-stat-card {
    background: #f8f9fd;
    border-radius: 10px;
    padding: 12px;
    text-align: center;
    border: 1px solid #e2e8f0;
}

.pdf-stat-label {
    font-size: 9px;
    font-weight: 600;
    text-transform: uppercase;
    color: #666;
    margin-bottom: 5px;
}

.pdf-stat-value {
    font-size: 22px;
    font-weight: 800;
    color: #1a2d6b;
}

.pdf-stat-unit {
    font-size: 8px;
    color: #999;
}

.pdf-total-card {
    background: linear-gradient(135deg, #1a2d6b 0%, #162060 100%);
    border-radius: 10px;
    padding: 12px 20px;
    margin-bottom: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    page-break-inside: avoid;
}

.pdf-total-label {
    font-size: 11px;
    font-weight: 600;
}

.pdf-total-value {
    font-size: 24px;
    font-weight: 800;
}

.pdf-total-unit {
    font-size: 10px;
    margin-left: 5px;
}

.pdf-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 9px;
    page-break-inside: avoid;
}

.pdf-table th {
    background: #1a2d6b;
    color: white;
    padding: 8px 6px;
    text-align: left;
    font-weight: 600;
}

.pdf-table td {
    padding: 6px;
    border-bottom: 1px solid #ddd;
}

.pdf-footer {
    margin-top: 20px;
    text-align: center;
    font-size: 8px;
    color: #999;
    padding-top: 10px;
    border-top: 1px solid #ddd;
    page-break-inside: avoid;
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

/* Modal Detail Rekap dari Log Aktivitas */
.modal-log-rekap {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1002;
    align-items: center;
    justify-content: center;
}

.modal-log-rekap-content {
    background: white;
    border-radius: 20px;
    width: 700px;
    max-width: 90%;
    max-height: 85vh;
    overflow: auto;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
}

.modal-log-rekap-header {
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #1a2d6b 0%, #162060 100%);
    color: white;
    border-radius: 20px 20px 0 0;
}

.modal-log-rekap-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.modal-log-rekap-close {
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-log-rekap-close:hover {
    background: rgba(255,255,255,0.3);
    transform: scale(1.1);
}

.modal-log-rekap-body {
    padding: 24px;
}

.log-rekap-summary {
    background: #f0f4ff;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 15px;
}

.log-rekap-item {
    text-align: center;
    flex: 1;
    min-width: 100px;
}

.log-rekap-label {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-2);
    margin-bottom: 5px;
}

.log-rekap-value {
    font-size: 24px;
    font-weight: 700;
    color: var(--navy-700);
}

.log-rekap-unit {
    font-size: 10px;
    color: var(--text-3);
}

.log-user-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
    margin-top: 15px;
}

.log-user-table th {
    background: #f8f9fd;
    padding: 10px 12px;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid var(--border);
}

.log-user-table td {
    padding: 8px 12px;
    border-bottom: 1px solid var(--border);
}

.log-user-table tr:hover {
    background: #f8f9fd;
}

.user-print-click {
    cursor: pointer;
    color: var(--blue-600);
    font-weight: 500;
    text-decoration: underline;
}

.user-print-click:hover {
    color: var(--blue-800);
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

/* Animasi untuk chart */
.chart-container canvas {
    transition: all 0.3s ease;
}

/* Hover effect untuk card chart */
.chart-card:hover {
    box-shadow: var(--shadow);
    transition: var(--transition);
}

/* Styling untuk select chart type */
#chart-type {
    cursor: pointer;
    transition: var(--transition);
}

#chart-type:hover {
    border-color: var(--blue-400);
    background: var(--blue-50);
}

/* Tooltip custom untuk chart */
.chartjs-tooltip {
    background: #1e293b !important;
    color: white !important;
    border-radius: 8px !important;
    padding: 6px 12px !important;
    font-size: 11px !important;
}

/* ============================================================
   EXPORT LAPORAN PDF STYLES - PROFESSIONAL & PRESISI
   ============================================================ */
@media print {
    body * {
        visibility: hidden;
    }
    #report-export-content, #report-export-content * {
        visibility: visible;
    }
    #report-export-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        padding: 40px;
        background: white;
        font-family: 'Times New Roman', 'Times New Roman', Times, serif;
    }
}

.report-export-wrapper {
    font-family: 'Times New Roman', 'Times New Roman', Times, serif;
    padding: 40px;
    background: white;
    max-width: 1000px;
    margin: 0 auto;
    line-height: 1.5;
}

/* Header Laporan */
.report-header {
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid #000000;
}

.report-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    margin-bottom: 15px;
}

.report-logo-img {
    height: 65px;
    width: auto;
}

.report-title {
    font-size: 20px;
    font-weight: bold;
    color: #000000;
    margin: 0;
    letter-spacing: 1px;
}

.report-subtitle {
    font-size: 14px;
    color: #333333;
    margin-top: 5px;
}

.report-meta {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
    padding-top: 8px;
    border-top: 1px solid #cccccc;
    font-size: 10px;
    color: #555555;
}

/* Section Styles */
.report-section {
    margin-bottom: 25px;
    page-break-inside: avoid;
}

.report-section-title {
    font-size: 16px;
    font-weight: bold;
    color: #000000;
    padding-bottom: 6px;
    border-bottom: 1px solid #999999;
    margin-bottom: 15px;
}

/* Info Cards Grid */
.report-info-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.report-info-card {
    background: #f9f9f9;
    border-radius: 8px;
    padding: 12px;
    text-align: center;
    border: 1px solid #dddddd;
}

.report-info-label {
    font-size: 10px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #555555;
    margin-bottom: 6px;
}

.report-info-value {
    font-size: 22px;
    font-weight: bold;
    color: #000000;
}

.report-info-unit {
    font-size: 9px;
    color: #777777;
}

/* Data Source Card */
.report-source-card {
    background: #f5f5f5;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 20px;
    border-left: 3px solid #1a2d6b;
}

.report-source-item {
    display: inline-block;
    margin-right: 25px;
    margin-bottom: 5px;
    font-size: 11px;
}

.report-source-label {
    font-weight: 600;
    color: #444444;
}

.report-source-value {
    color: #000000;
}

/* Data Table */
.report-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
    margin-bottom: 20px;
}

.report-table th {
    background: #e8e8e8;
    color: #000000;
    padding: 8px 10px;
    text-align: center;
    border: 1px solid #cccccc;
    font-weight: bold;
}

.report-table td {
    padding: 6px 10px;
    border: 1px solid #dddddd;
    text-align: center;
}

.report-table td:first-child {
    text-align: center;
    font-weight: bold;
}

.report-table td:nth-child(2) {
    text-align: right;
}

/* Trend styling - tanpa simbol */
.report-trend-up {
    color: #2e7d32;
}

.report-trend-down {
    color: #c62828;
}

.report-trend-neutral {
    color: #757575;
}

/* Analysis Section */
.report-analysis {
    background: #fafafa;
    border-radius: 8px;
    padding: 16px;
    margin-top: 20px;
    border: 1px solid #e0e0e0;
}

.report-analysis-title {
    font-size: 13px;
    font-weight: bold;
    color: #000000;
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px solid #dddddd;
}

.report-analysis-content {
    font-size: 11px;
    line-height: 1.5;
    color: #333333;
    text-align: justify;
}

.report-recommendation {
    background: #f5f5f0;
    border-radius: 8px;
    padding: 16px;
    margin-top: 15px;
    border: 1px solid #e0e0e0;
}

.report-recommendation-title {
    font-size: 13px;
    font-weight: bold;
    color: #000000;
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px solid #dddddd;
}

/* Tren container */
.report-trend-container {
    background: #f9f9f9;
    border-radius: 8px;
    padding: 12px;
    border: 1px solid #eeeeee;
}

.report-trend-item {
    margin: 4px 0;
    font-size: 11px;
    color: #444444;
}

/* Footer */
.report-footer {
    margin-top: 30px;
    padding-top: 12px;
    border-top: 1px solid #cccccc;
    text-align: center;
    font-size: 9px;
    color: #777777;
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
    <div class="brand-name" style="font-size: 14px; font-weight: 700;">Smart Office<br>Bappeda Banyuwangi</div>
    <div class="brand-sub" style="font-size: 9px; line-height: 1.4; color: rgba(255,255,255,0.5);">
     
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
  <div class="sub-item" onclick="navigateToData()">
    <svg viewBox="0 0 14 14" fill="currentColor">
        <path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/>
        <path d="M12 10l-2-2-2 2 2 2 2-2z"/>
    </svg>
    Data 
</div>
  <div class="sub-item" onclick="navigateComingSoon('a', 'e-perencanaan')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Perencanaan
  </div>
  <div class="sub-item" onclick="navigateComingSoon('a', 'e-monev')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Monev
  </div>
  <div class="sub-item" onclick="navigateComingSoon('a', 'e-lkpj')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-LKPJ
  </div>
  <div class="sub-item" onclick="navigateComingSoon('a', 'e-ippd')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-IPPD
  </div>
  <div class="sub-item" onclick="navigateComingSoon('a', 'e-perjanjian-kinerja')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Perjanjian Kinerja
  </div>
  <div class="sub-item" onclick="navigateComingSoon('a', 'sistem-inventarisasi')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Sistem Inventarisasi Permasalahan/Isu Strategis Daerah
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
  <div class="sub-item" onclick="navigateComingSoon('b', 'e-perencanaan')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Perencanaan
  </div>
  <div class="sub-item" onclick="navigateComingSoon('b', 'e-budgeting')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Budgeting
  </div>
  <div class="sub-item" onclick="navigateComingSoon('b', 'e-monev')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Monev
  </div>
  <div class="sub-item" onclick="navigateComingSoon('b', 'e-ippd')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-IPPD
  </div>
  <div class="sub-item" onclick="navigateComingSoon('b', 'e-perjanjian-kinerja')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Perjanjian Kinerja
  </div>
  <div class="sub-item" onclick="navigateComingSoon('b', 'sistem-inventarisasi')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Sistem Inventarisasi Permasalahan/Isu Strategis Daerah
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
  <div class="sub-item" onclick="navigateComingSoon('c', 'e-monev')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Monev
  </div>
  <div class="sub-item" onclick="navigateComingSoon('c', 'sistem-inventarisasi')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Sistem Inventarisasi Permasalahan/Isu Strategis Daerah
  </div>
  <div class="sub-item" onclick="navigateComingSoon('c', 'sistem-analisa-ekonomi')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Sistem Analisa Ekonomi Makro Daerah
  </div>
  <div class="sub-item" onclick="navigateComingSoon('c', 'sistem-csr')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Sistem Pelaporan Online CSR
  </div>
  <div class="sub-item" onclick="navigateComingSoon('c', 'e-perjanjian-kinerja')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Perjanjian Kinerja
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
  <div class="sub-item" onclick="navigateComingSoon('d', 'sistem-penanggulangan-kemiskinan')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Sistem Manajemen Penanggulangan Kemiskinan Daerah
  </div>
  <div class="sub-item" onclick="navigateComingSoon('d', 'e-monev')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Monev
  </div>
  <div class="sub-item" onclick="navigateComingSoon('d', 'e-perjanjian-kinerja')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Perjanjian Kinerja
  </div>
  <div class="sub-item" onclick="navigateComingSoon('d', 'sistem-inventarisasi')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Sistem Inventarisasi Permasalahan/Isu Strategis Daerah
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
  <div class="sub-item" onclick="navigateComingSoon('e', 'e-monev')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Monev
  </div>
  <div class="sub-item" onclick="navigateComingSoon('e', 'sistem-inventarisasi')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Sistem Inventarisasi Permasalahan/Isu Strategis Daerah
  </div>
  <div class="sub-item" onclick="navigateComingSoon('e', 'e-perjanjian-kinerja')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Perjanjian Kinerja
  </div>
</div>

<!-- Bidang Sekretariat -->
<div class="nav-item" id="nav-bf" onclick="toggleBidang('f','Bidang Sekretariat')">
  <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 010 2H7a1 1 0 01-1-1zm1 3a1 1 0 000 2h4a1 1 0 000-2H7z" clip-rule="evenodd"/>
  </svg>
  Bidang Sekretariat
  <svg class="nav-chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 2.5l3 3-3 3"/></svg>
</div>
<div class="sub-menu" id="sub-bf">
  <div class="sub-item" onclick="navigateDok('f','Sekretariat')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Dokumen
  </div>
  <div class="sub-item" onclick="navigateComingSoon('f', 'e-kinerja')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Kinerja
  </div>
  <div class="sub-item" onclick="navigateComingSoon('f', 'e-sop')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-SOP
  </div>
  <div class="sub-item" onclick="navigateComingSoon('f', 'sistem-arsip')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    Sistem Manajemen Arsip & Persuratan
  </div>
  <div class="sub-item" onclick="navigateComingSoon('f', 'e-perjanjian-kinerja')">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M3 2a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h8a1 1 0 000-2H3zm0 4a1 1 0 000 2h5a1 1 0 000-2H3z"/></svg>
    E-Perjanjian Kinerja
  </div>
</div>



      <div class="nav-section">Aktivitas</div>
      <div class="nav-item" data-panel="log" onclick="navigate(this)">
        <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
        </svg>
        Log Aktivitas
      </div>

      <!-- Di dalam sidebar-nav, setelah menu Log Aktivitas -->
<div class="nav-item" data-panel="loginlog" onclick="navigate(this)">
    <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.586l-2.707 2.707a1 1 0 01-1.414 0L5.586 15H5a2 2 0 01-2-2V5zm3 4a1 1 0 100 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
    </svg>
    Log Login
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

    <!-- ======== LOG LOGIN PANEL ======== -->
    <section id="panel-loginlog" class="panel">
        <div class="page-hdr">
            <div class="page-hdr-left">
                <div class="page-hdr-icon">
                    <svg viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.586l-2.707 2.707a1 1 0 01-1.414 0L5.586 15H5a2 2 0 01-2-2V5zm3 4a1 1 0 100 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <div class="page-hdr-title">Log Login</div>
                    <div class="page-hdr-sub">Riwayat login dan logout pengguna sistem</div>
                </div>
            </div>
            <button class="btn" onclick="exportLoginLogToPDF()">
                <svg viewBox="0 0 14 14" fill="currentColor" width="14" height="14" style="margin-right:6px;">
                    <path d="M7 1a6 6 0 100 12A6 6 0 007 1zm1 9H6V6h2v4zm0-5H6V3h2v2z"/>
                </svg>
                Export PDF
            </button>
        </div>

        <!-- Filter Toolbar -->
        <div class="card">
            <div class="table-toolbar">
                <div class="card-title">
                    <i class="fas fa-history"></i> Riwayat Login/Logout
                </div>
                <div class="table-toolbar-right">
                    <select class="sel-filter" id="loginlog-bidang-pilih" onchange="onLoginLogBidangChange()" style="min-width: 160px;">
                        <option value="">-- Semua Bidang --</option>
                        <option value="Litbang"> Bidang Litbang</option>
                        <option value="Perencanaan"> Bidang Perencanaan</option>
                        <option value="Ekonomi"> Bidang Ekonomi</option>
                        <option value="Kesra"> Bidang Kesra</option>
                        <option value="Sarpras"> Bidang Sarpras</option>
                        <option value="Sekretariat"> Bidang Sekretariat</option>
                    </select>
                    
                    <select class="sel-filter" id="loginlog-akun-pilih" onchange="loadLoginLog()" style="min-width: 160px;">
                        <option value="">-- Semua Akun --</option>
                    </select>

                    <div class="date-range-filter" style="display: flex; gap: 8px; align-items: center;">
                        <div class="mini-search">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="1" y="2" width="12" height="11" rx="1"/>
                                <line x1="4" y1="1" x2="4" y2="4"/>
                                <line x1="10" y1="1" x2="10" y2="4"/>
                                <line x1="1" y1="6" x2="13" y2="6"/>
                            </svg>
                            <input type="date" id="loginlog-date-start" placeholder="Dari Tanggal">
                        </div>
                        <span style="color: var(--text-3);">s.d.</span>
                        <div class="mini-search">
                            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="1" y="2" width="12" height="11" rx="1"/>
                                <line x1="4" y1="1" x2="4" y2="4"/>
                                <line x1="10" y1="1" x2="10" y2="4"/>
                                <line x1="1" y1="6" x2="13" y2="6"/>
                            </svg>
                            <input type="date" id="loginlog-date-end" placeholder="Sampai Tanggal">
                        </div>
                        <button class="btn btn-sm" onclick="filterLoginLogByDate()" style="background: var(--blue-600); color: white;">
                            <svg viewBox="0 0 14 14" fill="currentColor" width="12" height="12">
                                <path d="M12 8a4 4 0 0 1-8 0M4 6a4 4 0 0 1 8 0M7 2v4M5 2h4"/>
                            </svg>
                            Tampilkan
                        </button>
                    </div>
                    
                    <select class="sel-filter" id="loginlog-periode-filter" onchange="loadLoginStats()">
                        <option value="hari">Hari Ini</option>
                        <option value="minggu" selected>7 Hari</option>
                        <option value="bulan">30 Hari</option>
                        <option value="tahun">Tahun Ini</option>
                    </select>

                    <div class="mini-search">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="5.5" cy="5.5" r="4"/>
                            <path d="M9 9l2.5 2.5"/>
                        </svg>
                        <input type="text" id="loginlog-search" placeholder="Cari user atau IP..." oninput="filterLoginLogTable()">
                    </div>
                    
                    <button class="btn btn-sm" onclick="refreshLoginLog()">
                        <svg viewBox="0 0 14 14" fill="currentColor" width="12" height="12">
                            <path d="M12 8a4 4 0 0 1-8 0M4 6a4 4 0 0 1 8 0M7 2v4M5 2h4"/>
                        </svg>
                        Refresh
                    </button>
                </div>
            </div>

            <!-- Tabel Log Login -->
            <div class="log-table-wrapper">
                <table class="log-table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-clock"></i> Login Time</th>
                            <th><i class="fas fa-sign-out-alt"></i> Logout Time</th>
                            <th><i class="fas fa-user"></i> User</th>
                            <th><i class="fas fa-building"></i> Bidang</th>
                            <th><i class="fas fa-hourglass-half"></i> Durasi</th>
                            <th><i class="fas fa-network-wired"></i> IP Address</th>
                            <th><i class="fas fa-circle"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody id="loginlog-tbody">
                        <tr><td colspan="7" style="text-align:center;padding:60px;">
                            <div class="modern-spinner"></div>
                            <p>Memuat data login log...</p>
                         </div></td>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-2 mb-md-0">
                        <div class="pagination-info">
                            <span id="loginlog-info-text">Menampilkan 0 dari 0 data</span>
                            <select id="loginlog-per-page" class="form-select form-select-sm" style="width: auto;" onchange="changeLoginLogPerPage()">
                                <option value="10">10 per halaman</option>
                                <option value="25" selected>25 per halaman</option>
                                <option value="50">50 per halaman</option>
                                <option value="100">100 per halaman</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="Login log pagination">
                            <ul class="pagination justify-content-end" id="loginlog-pagination"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rekap per Akun -->
        <div class="card mt-4">
            <div class="card-head">
                <div class="card-title">
                    <i class="fas fa-chart-bar"></i> Rekap Login per Akun
                </div>
                <div class="card-actions" style="display: flex; gap: 10px;">
                    <div class="mini-search" style="height: 32px;">
                        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="5.5" cy="5.5" r="4"/>
                            <path d="M9 9l2.5 2.5"/>
                        </svg>
                        <input type="text" id="rekap-search" placeholder="Cari user..." style="width: 150px;" onkeyup="searchRekapUser()">
                    </div>
                    <span class="card-action" onclick="loadLoginRekapPerAkun()">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Username</th>
                            <th>Bidang</th>
                            <th>Total Login</th>
                            <th>Total Durasi</th>
                            <th>Rata-rata Durasi</th>
                            <th>Login Terakhir</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="loginlog-rekap-tbody">
                        <tr><td colspan="8" style="text-align:center;padding:40px;">
                            <div class="modern-spinner"></div>
                            <p>Memuat data...</p>
                         </div></td>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination untuk Rekap Login -->
            <div class="pagination-container" id="rekap-pagination-container">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-2 mb-md-0">
                        <div class="pagination-info">
                            <span id="rekap-info-text">Menampilkan 0 dari 0 data</span>
                            <select id="rekap-per-page" class="form-select form-select-sm" style="width: auto;" onchange="changeRekapPerPage()">
                                <option value="5">5 per halaman</option>
                                <option value="10" selected>10 per halaman</option>
                                <option value="25">25 per halaman</option>
                                <option value="50">50 per halaman</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="Rekap login pagination">
                            <ul class="pagination justify-content-end" id="rekap-pagination"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- ==================== DATA INDIKATOR PANEL ==================== -->
<section id="panel-data" class="panel">
    <div class="page-hdr">
        <div class="page-hdr-left">
            <div class="page-hdr-icon">
                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                </svg>
            </div>
            <div>
                <div class="page-hdr-title">Portal Satu Data</div>
                <div class="page-hdr-sub">Manajemen Data Indikator Banyuwangi</div>
            </div>
        </div>
        <div style="display: flex; gap: 10px;">
            <!-- Tombol Tambah Data -->
            <button class="btn btn-primary" onclick="openApiModal()">
                <i class="fas fa-plus"></i> Tambah Data API
            </button>
            <button class="btn btn-sm" onclick="loadAllDataCards()">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>

    <!-- Grid Card Data (Daftar API) -->
    <div class="row g-4" id="data-cards-container" style="margin-bottom: 24px;">
        <!-- Card akan di-generate oleh JavaScript -->
        <div class="col-12 text-center py-5">
            <div class="modern-spinner"></div>
            <p>Memuat daftar data...</p>
        </div>
    </div>

   <!-- Detail Data yang Dipilih (akan tampil saat card diklik) -->
<div id="selected-data-container" style="display: none;">
    <!-- Informasi Sumber Data -->
    <div class="card mb-4" id="data-source-card">
        <div class="card-body" style="background: linear-gradient(135deg, #e8f0fe 0%, #d4e2fc 100%);">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center gap-3">
                        <div>
                            <h5 class="mb-1" id="selected-indikator">-</h5>
                            <p class="mb-0 text-muted small">
                                <i class="fas fa-database"></i> Sumber: <span id="selected-produsen">-</span> 
                                | <i class="fas fa-folder"></i> Urusan: <span id="selected-urusan">-</span>
                            </p>
                            <p class="mb-0 text-muted small">
                                <i class="fas fa-ruler"></i> Satuan: <span id="selected-satuan">-</span>
                            </p>
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
    <div class="stat-grid mb-4" id="selected-stats">
        <!-- Statistik akan diisi oleh JavaScript -->
        <div class="col-12 text-center py-4">
            <p class="text-muted">Pilih data indikator terlebih dahulu</p>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="card mb-4">
        <div class="card-head">
            <div class="card-title"><i class="fas fa-table"></i> Data Per Tahun</div>
            <div class="table-toolbar-right">
                <div class="mini-search">
                    <svg viewBox="0 0 14 14" fill="none" stroke="currentColor"><circle cx="5.5" cy="5.5" r="4"/><path d="M9 9l2.5 2.5"/></svg>
                    <input type="text" id="selected-search" placeholder="Cari tahun..." style="width:130px;">
                </div>
                <button class="btn btn-sm" onclick="exportSelectedDataToExcel()"><i class="fas fa-file-excel"></i> Excel</button>
                <button class="btn btn-sm" onclick="exportSelectedDataToPDF()"><i class="fas fa-file-pdf"></i> PDF</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="tbl">
                <thead>
                    <tr>
                        <th style="width:20%">Tahun</th>
                        <th style="width:40%">Nilai</th>
                        <th style="width:40%">Trend</th>
                    </tr>
                </thead>
                <tbody id="selected-data-tbody">
                    <tr>
                        <td colspan="3" class="text-center py-5">
                            <div class="modern-spinner"></div>
                            <p>Pilih data dari card di atas</p>
                         </div>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination untuk tabel -->
        <div class="pagination-container" style="border-top: 1px solid var(--border);">
            <div class="row align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <div class="pagination-info">
                        <span id="selected-data-info">Menampilkan 0 dari 0 data</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="card mb-4 chart-card">
        <div class="card-head">
            <div class="card-title"><i class="fas fa-chart-line"></i> Grafik Tren Data</div>
            <select id="selected-chart-type" class="sel-filter" onchange="renderSelectedChart()" style="width:120px;">
                <option value="line">Line Chart</option>
                <option value="bar">Bar Chart</option>
            </select>
        </div>
        <div class="card-body">
            <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                <canvas id="selected-data-chart" style="max-height: 400px; width: 100%;"></canvas>
            </div>
        </div>
    </div>

    <!-- Analisis Manual -->
    <div class="card">
        <div class="card-head">
            <div class="card-title"><i class="fas fa-edit"></i> Analisis Data</div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Judul Analisis</label>
                <input type="text" id="analisis-judul-input" class="form-control" placeholder="Contoh: Analisis Data...">
            </div>
            <div class="form-group mt-3">
                <label class="form-label">Analisis / Kesimpulan</label>
                <textarea id="analisis-kesimpulan-input" class="form-control" rows="5" placeholder="Tuliskan analisis dan kesimpulan Anda..."></textarea>
            </div>
            <div class="form-group mt-3">
                <label class="form-label">Rekomendasi (Opsional)</label>
                <textarea id="analisis-rekomendasi-input" class="form-control" rows="3" placeholder="Tuliskan rekomendasi..."></textarea>
            </div>
            <div class="form-actions mt-3">
                <button class="btn btn-primary" onclick="simpanAnalisisManual()">
                    <i class="fas fa-save"></i> Simpan Analisis
                </button>
            </div>
        </div>
    </div>

    <!-- Riwayat Analisis -->
    <div class="card mt-4">
        <div class="card-head">
            <div class="card-title"><i class="fas fa-history"></i> Riwayat Analisis Tersimpan</div>
            <span class="card-action" onclick="loadRiwayatAnalisis()">Refresh</span>
        </div>
        <div id="riwayat-analisis-list" style="padding:15px;">
            <div class="empty-state">
                <i class="fas fa-archive"></i>
                <p>Belum ada analisis tersimpan</p>
                <p style="font-size:12px;">Klik tombol "Simpan Analisis" untuk menyimpan analisis Anda</p>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Modal Tambah/Edit API -->
<div id="modalApiConfig" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1002; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:20px; width:700px; max-width:90%; max-height:85vh; overflow:auto; padding:24px;">
        <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
            <h3 id="modalApiTitle" style="font-size:18px;">Tambah Konfigurasi API</h3>
            <span onclick="closeApiModal()" style="cursor:pointer; font-size:24px;">&times;</span>
        </div>
        <form id="formApiConfig">
            <input type="hidden" name="id_api" id="api_id">
<!-- Di dalam modalApiConfig, setelah Kode API, tambahkan: -->
<div class="form-group" style="margin-bottom:15px;">
    <label class="form-label">ID Indikator <span style="color:red;">*</span></label>
    <input type="text" name="indikator_id" id="indikator_id" class="form-control" required placeholder="Contoh: 1062, 1, 2, 5, 47">
    <small class="text-muted">ID indikator dari Portal Satu Data (contoh: Hibah=1062, PDRB=1, Inflasi=2, Kemiskinan=5, Indeks Keparahan Kemiskinan=47)</small>
</div>
            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label">Nama Data <span style="color:red;">*</span></label>
                <input type="text" name="nama_data" id="nama_data" class="form-control" required placeholder="Contoh: Hibah, PDRB, Inflasi">
            </div>
            
            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label">Kode API <span style="color:red;">*</span></label>
                <input type="text" name="kode_api" id="kode_api" class="form-control" required placeholder="Contoh: hibah, pdrb, inflasi">
                <small class="text-muted">Kode unik untuk mengidentifikasi API ini</small>
            </div>
            
            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label">URL API <span style="color:red;">*</span></label>
                <input type="url" name="url_api" id="url_api" class="form-control" required placeholder="https://satudata.banyuwangikab.go.id/api/indikator?id=...">
            </div>
            
            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label">API Key (Opsional)</label>
                <input type="text" name="api_key" id="api_key" class="form-control" placeholder="data_bwi2023">
            </div>
            
            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label">Metode</label>
                <select name="metode" id="metode" class="form-control">
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                </select>
            </div>
            
            <hr>
            <h5 style="font-size:14px; margin:15px 0;">Mapping Field JSON</h5>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom:15px;">
                        <label class="form-label">Indikator Field</label>
                        <input type="text" name="indikator_field" id="indikator_field" class="form-control" value="result.Indikator">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom:15px;">
                        <label class="form-label">Produsen Field</label>
                        <input type="text" name="produsen_field" id="produsen_field" class="form-control" value="result.Produsen Data">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom:15px;">
                        <label class="form-label">Urusan Field</label>
                        <input type="text" name="urusan_field" id="urusan_field" class="form-control" value="result.Urusan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom:15px;">
                        <label class="form-label">Satuan Field</label>
                        <input type="text" name="satuan_field" id="satuan_field" class="form-control" value="result.Satuan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom:15px;">
                        <label class="form-label">Data Field</label>
                        <input type="text" name="data_field" id="data_field" class="form-control" value="result.data">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom:15px;">
                        <label class="form-label">Tahun Field</label>
                        <input type="text" name="tahun_field" id="tahun_field" class="form-control" value="tahun">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="margin-bottom:15px;">
                        <label class="form-label">Nilai Field</label>
                        <input type="text" name="nilai_field" id="nilai_field" class="form-control" value="nilai">
                    </div>
                </div>
            </div>
            
            <div style="display:flex; gap:10px; margin-top:20px;">
                <button type="submit" class="btn btn-primary">Simpan Konfigurasi</button>
                <button type="button" class="btn" onclick="closeApiModal()">Batal</button>
            </div>
        </form>
    </div>
</div>    

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
    <div class="hero-title">Smart Office Management</div>
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
        <div class="page-hdr-sub">Riwayat seluruh aktivitas sistem per bidang</div>
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
        <!-- PILIH BIDANG -->
        <select class="sel-filter" id="log-bidang-pilih" onchange="onBidangChange()" style="min-width: 160px;">
            <option value="">-- Semua Bidang --</option>
            <option value="Litbang"> Bidang Litbang</option>
            <option value="Perencanaan"> Bidang Perencanaan</option>
            <option value="Ekonomi"> Bidang Ekonomi</option>
            <option value="Kesra"> Bidang Kesra</option>
            <option value="Sarpras"> Bidang Sarpras</option>
            <option value="Sekretariat"> Bidang Sekretariat</option>
        </select>
        
        <!-- PILIH AKUN (dinamis berdasarkan bidang yang dipilih) -->
        <select class="sel-filter" id="log-akun-pilih" onchange="loadLogAktivitas()" style="min-width: 160px;">
            <option value="">-- Semua Akun --</option>
        </select>
        
        <!-- FILTER TANGGAL -->
        <div class="date-range-filter" style="display: flex; gap: 8px; align-items: center;">
            <div class="mini-search">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="1" y="2" width="12" height="11" rx="1"/>
                    <line x1="4" y1="1" x2="4" y2="4"/>
                    <line x1="10" y1="1" x2="10" y2="4"/>
                    <line x1="1" y1="6" x2="13" y2="6"/>
                </svg>
                <input type="date" id="log-date-start" placeholder="Dari Tanggal">
            </div>
            <span style="color: var(--text-3);">s.d.</span>
            <div class="mini-search">
                <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="1" y="2" width="12" height="11" rx="1"/>
                    <line x1="4" y1="1" x2="4" y2="4"/>
                    <line x1="10" y1="1" x2="10" y2="4"/>
                    <line x1="1" y1="6" x2="13" y2="6"/>
                </svg>
                <input type="date" id="log-date-end" placeholder="Sampai Tanggal">
            </div>
            <button class="btn btn-sm" onclick="filterLogByDate()" style="background: var(--blue-600); color: white;">
                <svg viewBox="0 0 14 14" fill="currentColor" width="12" height="12">
                    <path d="M12 8a4 4 0 0 1-8 0M4 6a4 4 0 0 1 8 0M7 2v4M5 2h4"/>
                </svg>
                Tampilkan
            </button>
        </div>
        
        <!-- FILTER AKSI -->
        <select class="sel-filter" id="log-aksi-filter" onchange="filterLogTable()">
            <option value="">Semua Aksi</option>
            <option value="Upload">📤 Upload</option>
            <option value="Print (via Preview)">🖱️ Print Preview</option>
            <option value="Print">🖨️ Print</option>
            <option value="Preview">👁️ Preview</option>

        </select>
        
        <!-- PENCARIAN -->
        <div class="mini-search">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="5.5" cy="5.5" r="4"/>
                <path d="M9 9l2.5 2.5"/>
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

    <!-- ======== CARD TOTAL KERTAS TERPAKAI ======== -->
<div class="card mb-4" id="kertas-terpakai-card">
    <div class="card-head">
        <div class="card-title">
            <i class="bi bi-printer-fill"></i> Total Kertas Terpakai
        </div>
        <span class="card-action" onclick="refreshKertasTerpakai()">
            <i class="bi bi-arrow-repeat"></i> Refresh
        </span>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <!-- Stat Hari Ini -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-kertas-card" id="stat-hari">
                    <div class="stat-kertas-icon bg-primary-light">
                        <i class="bi bi-calendar-day fs-4"></i>
                    </div>
                    <div class="stat-kertas-info">
                        <div class="stat-kertas-label">HARI INI</div>
                        <div class="stat-kertas-value" id="total-kertas-hari">0</div>
                        <div class="stat-kertas-unit">lembar kertas</div>
                    </div>
                </div>
            </div>
            
            <!-- Stat 7 Hari -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-kertas-card" id="stat-minggu">
                    <div class="stat-kertas-icon bg-success-light">
                        <i class="bi bi-calendar-week fs-4"></i>
                    </div>
                    <div class="stat-kertas-info">
                        <div class="stat-kertas-label">7 HARI</div>
                        <div class="stat-kertas-value" id="total-kertas-minggu">0</div>
                        <div class="stat-kertas-unit">lembar kertas</div>
                    </div>
                </div>
            </div>
            
            <!-- Stat 30 Hari -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-kertas-card" id="stat-bulan">
                    <div class="stat-kertas-icon bg-warning-light">
                        <i class="bi bi-calendar-month fs-4"></i>
                    </div>
                    <div class="stat-kertas-info">
                        <div class="stat-kertas-label">30 HARI</div>
                        <div class="stat-kertas-value" id="total-kertas-bulan">0</div>
                        <div class="stat-kertas-unit">lembar kertas</div>
                    </div>
                </div>
            </div>
            
            <!-- Stat Tahun Ini -->
            <div class="col-md-3 col-sm-6">
                <div class="stat-kertas-card" id="stat-tahun">
                    <div class="stat-kertas-icon bg-info-light">
                        <i class="bi bi-calendar-year fs-4"></i>
                    </div>
                    <div class="stat-kertas-info">
                        <div class="stat-kertas-label">TAHUN INI</div>
                        <div class="stat-kertas-value" id="total-kertas-tahun">0</div>
                        <div class="stat-kertas-unit">lembar kertas</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Keseluruhan -->
        <div class="total-kertas-container mt-3 pt-2 border-top">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="total-kertas-label">
                        <i class="bi bi-printer"></i> TOTAL KESELURUHAN
                    </span>
                </div>
                <div>
                    <span class="total-kertas-value" id="total-kertas-semua">0</span>
                    <span class="total-kertas-unit">lembar</span>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <!-- INFO BIDANG YANG DIPILIH -->
    <div id="bidang-info" style="padding: 12px 20px; background: #f0f4ff; border-bottom: 1px solid var(--border); display: none;">
      <i class="fas fa-building"></i> Menampilkan log untuk bidang: 
      <strong id="bidang-terpilih-label"></strong>
    </div>
    
    <div class="log-table-wrapper">
      <table class="log-table">
        <thead>
          <tr>
            <th><i class="fas fa-clock"></i> Waktu</th>
            <th><i class="fas fa-user"></i> User</th>
            <th><i class="fas fa-tag"></i> Aksi</th>
            <th><i class="fas fa-building"></i> Bidang</th>
            <th><i class="fas fa-cube"></i> Modul</th>
            <th><i class="fas fa-info-circle"></i> Detail</th>
            <th><i class="fas fa-network-wired"></i> IP Address</th>
          </tr>
        </thead>
        <tbody id="log-tbody">
          <tr><td colspan="7" style="text-align:center;padding:60px;">
            <div class="modern-spinner"></div>
            <p style="margin-top: 10px;">Silakan pilih bidang terlebih dahulu</p>
           </div></td>
        </tbody>
      </table>
    </div>
    
    <!-- PAGINATION SECTION - TAMBAHKAN INI -->
    <div class="pagination-container">
      <div class="row align-items-center">
        <div class="col-md-6 mb-2 mb-md-0">
          <div class="pagination-info">
            <span id="log-info-text">Menampilkan 0 dari 0 data</span>
            <select id="log-per-page" class="form-select form-select-sm" style="width: auto;" onchange="changePerPage()">
              <option value="10">10 per halaman</option>
              <option value="25" selected>25 per halaman</option>
              <option value="50">50 per halaman</option>
              <option value="100">100 per halaman</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <nav aria-label="Log pagination">
            <ul class="pagination justify-content-end" id="log-pagination">
              <!-- Pagination akan di-generate oleh JavaScript -->
            </ul>
          </nav>
        </div>
      </div>
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

<!-- Modal Detail Rekap Login per Akun -->
<div id="modalLoginDetail" class="modal-user-rekap" style="display:none;">
    <div class="modal-user-rekap-content" style="max-width: 900px; width: 90%;">
        <div class="modal-user-rekap-header" style="background: linear-gradient(135deg, #1a2d6b 0%, #162060 100%);">
            <h3 id="modalLoginDetailTitle" style="margin: 0; color: white;">Detail Rekap Login</h3>
            <button class="modal-user-rekap-close" onclick="closeModalLoginDetail()" style="background: rgba(255,255,255,0.2); color: white;">&times;</button>
        </div>
        <div class="modal-user-rekap-body" id="modalLoginDetailBody" style="padding: 24px;">
            <div style="text-align:center;padding:40px;">
                <div class="modern-spinner"></div>
                <p>Memuat data...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Dokumen -->
<div id="modalPreview" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:1001; align-items:center; justify-content:center;">
  <div style="background:#fff; border-radius:16px; width:800px; max-width:90%; max-height:90%; overflow:auto; padding:20px;">
    <div style="display:flex; justify-content:space-between; margin-bottom:15px;">
      <h3 id="previewTitle" style="font-size:18px;">Preview Dokumen</h3>
      <span onclick="closePreviewModal()" style="cursor:pointer; font-size:24px;">&times;</span>
    </div>
    
    <!-- TAMBAHKAN HIDDEN INPUT UNTUK MENYIMPAN DATA DOKUMEN -->
    <input type="hidden" id="preview-dokumen-id" value="">
    <input type="hidden" id="preview-dokumen-nama" value="">
    <input type="hidden" id="preview-dokumen-path" value="">
    
    <!-- TAMBAHKAN FORM PRINT SETTINGS -->
    <div style="background: #f0f4ff; padding: 12px; border-radius: 8px; margin-bottom: 15px;">
      <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
        <div>
          <label style="font-size: 12px; font-weight: 600;">Jumlah Lembar:</label>
          <input type="number" id="print-jumlah-lembar" value="1" min="1" max="100" style="width: 80px; padding: 5px; border-radius: 6px; border: 1px solid #ccc;">
        </div>
        <div>
          <label style="font-size: 12px; font-weight: 600;">Range Halaman:</label>
          <input type="text" id="print-range-halaman" placeholder="Semua" style="width: 120px; padding: 5px; border-radius: 6px; border: 1px solid #ccc;">
        </div>
        <button id="btn-print-preview" class="btn btn-primary" style="background: #2563eb;">
          <i class="fas fa-print"></i> Print Dokumen
        </button>
      </div>
    </div>
    
    <div id="previewContent" style="text-align:center;"></div>
  </div>
</div>
    </main>
  </div>
</div>
<!-- Library untuk generate PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- TAMBAHKAN INI - Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
  e: 'Bidang Sarana Prasarana Wilayah dan Lingkungan',
  f: 'Bidang Sekretariat'  
};

// Mapping ID bidang ke nama pendek untuk navigasi
const bidangShortName = {
  a: 'Litbang',
  b: 'Perencanaan',
  c: 'Ekonomi',
  d: 'Kesra',
  e: 'Sarpras',
  f: 'Sekretariat' 
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

  // close all (tambah 'f')
  ['a','b','c','d','e','f'].forEach(x => {
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
    e: 'Bidang Sarana Prasarana Wilayah dan Lingkungan',
    f: 'Bidang Sekretariat'  // ← TAMBAHKAN INI
  };

  const bidangShort = {
    a: 'Litbang',
    b: 'Perencanaan',
    c: 'Ekonomi',
    d: 'Kesra',
    e: 'Sarpras',
    f: 'Sekretariat'  // ← TAMBAHKAN INI
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

  // load dokumen dari DB
  loadDokumenFromDB(id);

  showPanel('bidang');

  document.querySelectorAll('.nav-item[data-panel]').forEach(n => n.classList.remove('active'));

  document.querySelectorAll('.sub-item').forEach(s => s.classList.remove('active'));
  const subItems = document.querySelectorAll('#sub-b' + id + ' .sub-item');
  if (subItems.length) subItems[0].classList.add('active');
}

// ================= FUNGSI UNTUK MENU COMING SOON =================
function navigateComingSoon(bidangId, menuName) {
  // Sembunyikan panel bidang yang aktif
  document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
  
  // Buat atau ambil panel coming-soon
  let comingSoonPanel = document.getElementById('panel-comingsoon');
  if (!comingSoonPanel) {
    comingSoonPanel = document.createElement('section');
    comingSoonPanel.id = 'panel-comingsoon';
    comingSoonPanel.className = 'panel';
    comingSoonPanel.innerHTML = `
      <div class="page-hdr">
        <div class="page-hdr-left">
          <div class="page-hdr-icon">
            <svg viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
            </svg>
          </div>
          <div>
            <div class="page-hdr-title" id="comingsoon-title">Menu</div>
            <div class="page-hdr-sub" id="comingsoon-subtitle">Fitur sedang dalam pengembangan</div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="empty-state" style="padding: 80px 20px;">
            <div style="font-size: 80px; margin-bottom: 20px;">🚧</div>
            <h3 style="margin-bottom: 10px; color: var(--text-1);">Coming Soon</h3>
            <p style="color: var(--text-2); margin-bottom: 8px;">Fitur ini sedang dalam tahap pengembangan</p>
            <p style="color: var(--text-3); font-size: 12px;" id="comingsoon-detail">Mohon maaf atas ketidaknyamanannya</p>
            <div style="margin-top: 30px; padding: 20px; background: #f8f9fd; border-radius: 12px; text-align: left; max-width: 400px; margin-left: auto; margin-right: auto;">
              <div id="comingsoon-apps-list" style="font-size: 13px; color: var(--text-2);"></div>
            </div>
          </div>
        </div>
      </div>
    `;
    document.querySelector('.page-content').appendChild(comingSoonPanel);
  }
  
  // Update judul berdasarkan menu yang dipilih
  const menuTitles = {
    // Sekretariat
    'e-kinerja': { title: 'E-Kinerja', subtitle: 'Sistem Informasi Kinerja Pegawai', apps: ['E-Kinerja'] },
    'e-sop': { title: 'E-SOP', subtitle: 'Sistem Informasi Standar Operasional Prosedur', apps: ['E-SOP'] },
    'sistem-arsip': { title: 'Sistem Manajemen Arsip & Persuratan', subtitle: 'Manajemen Arsip dan Persuratan Digital', apps: ['Sistem Manajemen Arsip dan Persuratan'] },
    'e-perjanjian-kinerja': { title: 'E-Perjanjian Kinerja', subtitle: 'Sistem Perjanjian Kinerja', apps: ['E-Perjanjian Kinerja'] },
    
    // Ekonomi
    'e-monev': { title: 'E-Monev', subtitle: 'Sistem Monitoring dan Evaluasi', apps: ['E-Monev'] },
    'sistem-inventarisasi': { title: 'Sistem Inventarisasi Permasalahan', subtitle: 'Inventarisasi Isu Strategis Daerah', apps: ['Sistem Inventarisasi Permasalahan/Isu Strategis Daerah'] },
    'sistem-analisa-ekonomi': { title: 'Sistem Analisa Ekonomi Makro', subtitle: 'Analisis Ekonomi Makro Daerah', apps: ['Sistem Analisa Ekonomi Makro Daerah'] },
    'sistem-csr': { title: 'Sistem Pelaporan CSR', subtitle: 'Pelaporan Corporate Social Responsibility Online', apps: ['Sistem Pelaporan Online CSR'] },
    
    // Litbang
    'e-perencanaan': { title: 'E-Perencanaan', subtitle: 'Sistem Perencanaan Pembangunan', apps: ['E-Perencanaan'] },
    'e-lkpj': { title: 'E-LKPJ', subtitle: 'Laporan Keterangan Pertanggungjawaban', apps: ['E-LKPJ'] },
    'e-ippd': { title: 'E-IPPD', subtitle: 'Informasi Penyelenggaraan Pemerintah Daerah', apps: ['E-IPPD'] }
  };
  
  const menu = menuTitles[menuName] || { 
    title: menuName.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase()), 
    subtitle: 'Fitur sedang dalam pengembangan',
    apps: [menuName.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase())]
  };
  
  document.getElementById('comingsoon-title').textContent = menu.title;
  document.getElementById('comingsoon-subtitle').textContent = menu.subtitle;
  
  // Tampilkan daftar aplikasi yang terkait
  const appsListHtml = `
    <strong style="display: block; margin-bottom: 12px; color: var(--text-1);">📋 Aplikasi yang Digunakan:</strong>
    <ul style="margin: 0; padding-left: 20px;">
      ${menu.apps.map(app => `<li style="margin-bottom: 8px;">${app}</li>`).join('')}
    </ul>
  `;
  document.getElementById('comingsoon-apps-list').innerHTML = appsListHtml;
  
  comingSoonPanel.classList.add('active');
  
  // Scroll ke atas
  document.querySelector('.page-content').scrollTop = 0;
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

// ==================== LOAD REKAP LOGIN PER AKUN ====================
function loadLoginRekapPerAkun() {
    console.log('Loading rekap login per akun...');
    
    $('#loginlog-rekap-tbody').html(`
        <tr><td colspan="7" style="text-align:center;padding:40px;">
            <div class="modern-spinner"></div>
            <p>Memuat data rekap...</p>
        </div></td>
    `);
    
    const bidang = $('#loginlog-bidang-pilih').val();
    const periode = $('#loginlog-periode-filter').val();
    
    $.ajax({
        url: '<?= base_url('IDE/get_login_rekap_per_akun') ?>',
        type: 'GET',
        data: { bidang: bidang, periode: periode },
        dataType: 'json',
        timeout: 10000,
        success: function(response) {
            if (response.status === 'success') {
                renderLoginRekapPerAkun(response.data);
                console.log('Rekap login loaded:', response.data.length, 'records');
            } else {
                $('#loginlog-rekap-tbody').html(`<tr><td colspan="7" class="empty-state-table">
                    <div class="icon">⚠️</div>
                    <p>Gagal memuat data rekap</p>
                </div></table>`);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading rekap:', error);
            $('#loginlog-rekap-tbody').html(`<tr><td colspan="7" class="empty-state-table">
                <div class="icon">❌</div>
                <p>Error: ${error}</p>
                <p style="font-size:12px;">Silakan refresh halaman dan coba lagi</p>
            </div></td>`);
        }
    });
}

// Load Top Users
function loadTopUsers() {
    const periode = $('#loginlog-periode-filter').val();
    const bidang = $('#loginlog-bidang-pilih').val();
    
    $('#top-user-tbody').html(`
        <tr><td colspan="5" style="text-align:center;padding:40px;">
            <div class="modern-spinner"></div>
            <p>Memuat data...</p>
         </div></td>
    `);
    
    $.ajax({
        url: '<?= base_url('IDE/get_login_top_users') ?>',
        type: 'GET',
        data: { bidang: bidang, periode: periode, limit: 10 },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success' && response.data.length > 0) {
                let html = '';
                response.data.forEach((user, index) => {
                    html += `
                        <tr>
                            <td style="text-align:center;">${index + 1}</td>
                            <td><strong>${escapeHtml(user.username)}</strong></td>
                            <td>${escapeHtml(user.bidang || '-')}</td>
                            <td style="text-align:center;"><span class="pill pill-done" style="background:#e0e7ff; color:#4338ca;">${user.login_count} kali</span></td>
                            <td><span class="pill pill-print">${user.duration_formatted}</span></td>
                        </tr>
                    `;
                });
                $('#top-user-tbody').html(html);
            } else {
                $('#top-user-tbody').html(`<tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-3);">
                    <div style="font-size:48px; margin-bottom:15px;">📭</div>
                    Belum ada data login
                 </div></td>`);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading top users:', error);
            $('#top-user-tbody').html(`<table><td colspan="5" style="text-align:center;padding:40px;color:red;">
                Gagal memuat data: ${error}
             </div></td>`);
        }
    });
}

// Load Login Stats (rekap periode)
function loadLoginStats() {
    const bidang = $('#loginlog-bidang-pilih').val();
    const username = $('#loginlog-akun-pilih').val();
    const periode = $('#loginlog-periode-filter').val();
    
    // Update tampilan rekap berdasarkan periode yang dipilih
    loadLoginRekapPerAkun();
    loadTopUsers();
}

// Function untuk onLoginLogBidangChange (event handler)
function onLoginLogBidangChange() {
    const bidang = $('#loginlog-bidang-pilih').val();
    
    // Load akun berdasarkan bidang
    if (bidang) {
        $.ajax({
            url: '<?= base_url('IDE/get_akun_by_bidang') ?>',
            type: 'GET',
            data: { bidang: bidang },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    let options = '<option value="">-- Semua Akun --</option>';
                    response.data.forEach(function(akun) {
                        options += `<option value="${escapeHtml(akun.Username)}">👤 ${escapeHtml(akun.Username)}</option>`;
                    });
                    $('#loginlog-akun-pilih').html(options);
                }
            }
        });
    } else {
        $('#loginlog-akun-pilih').html('<option value="">-- Semua Akun --</option>');
    }
    
    // Refresh semua data
    loginLogCurrentPage = 1;
    loadLoginLog();
    loadLoginRekapPerAkun();
    loadTopUsers();
}

// Inisialisasi saat halaman loginlog panel aktif
$(document).ready(function() {
    // Observer untuk panel loginlog
    const loginLogPanelObserver = new MutationObserver(function() {
        const activePanel = document.querySelector('.panel.active');
        if (activePanel && activePanel.id === 'panel-loginlog') {
            console.log('Panel loginlog aktif, memuat data rekap...');
            loadLoginRekapPerAkun();
            loadTopUsers();
            loginLogPanelObserver.disconnect();
        }
    });
    
    loginLogPanelObserver.observe(document.body, {
        attributes: true,
        attributeFilter: ['class'],
        subtree: true
    });
    
    // Jika panel loginlog sudah aktif saat halaman dimuat
    if (document.querySelector('#panel-loginlog.active')) {
        loadLoginRekapPerAkun();
        loadTopUsers();
    }
    
    // Event listener untuk perubahan filter
    $('#loginlog-periode-filter').on('change', function() {
        loadLoginRekapPerAkun();
        loadTopUsers();
    });
    
    $('#loginlog-bidang-pilih').on('change', function() {
        onLoginLogBidangChange();
    });
});

// ================= RENDER TABEL DOKUMEN (LENGKAP) =================
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
  
  // Debug: lihat data yang diterima
  console.log('Data dokumen:', dokumen);
  console.log('Kategori dari dokumen pertama:', dokumen[0]?.kategori);
  
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
    
    // Pastikan kategori tidak undefined/null
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
          <span class="link-act" onclick="previewDokumen('${doc.file_path}', '${doc.file_type}', '${escapeHtml(doc.nama_dokumen)}')" style="margin-right:12px; cursor:pointer; color:#2563eb;"> Lihat</span>
          <span class="link-danger" onclick="deleteDokumen(${doc.id_dokumen})" style="cursor:pointer; color:#dc2626;">Hapus</span>
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

// ==================== PAGINATION REKAP LOGIN PER AKUN ====================
let rekapCurrentPage = 1;
let rekapPerPage = 10;
let rekapTotalData = 0;
let rekapTotalPages = 0;
let rekapSearchKeyword = '';

// Load rekap login per akun dengan pagination
function loadLoginRekapPerAkun() {
    console.log('Loading rekap login per akun...');
    
    $('#loginlog-rekap-tbody').html(`
        <tr><td colspan="8" style="text-align:center;padding:40px;">
            <div class="modern-spinner"></div>
            <p>Memuat data rekap...</p>
        </div></tr>
    `);
    
    const bidang = $('#loginlog-bidang-pilih').val();
    const periode = $('#loginlog-periode-filter').val();
    
    $.ajax({
        url: '<?= base_url('IDE/get_login_rekap_per_akun') ?>',
        type: 'GET',
        data: { 
            bidang: bidang, 
            periode: periode,
            page: rekapCurrentPage,
            limit: rekapPerPage,
            search: rekapSearchKeyword
        },
        dataType: 'json',
        timeout: 10000,
        success: function(response) {
            if (response.status === 'success') {
                rekapTotalData = response.total || 0;
                rekapTotalPages = response.total_pages || 0;
                
                renderLoginRekapPerAkun(response.data);
                updateRekapPagination();
                
                console.log('Rekap login loaded:', response.data.length, 'of', rekapTotalData, 'records');
            } else {
                $('#loginlog-rekap-tbody').html(`<tr><td colspan="8" class="empty-state-table">
                    <div class="icon">⚠️</div>
                    <p>Gagal memuat data rekap</p>
                </div></tr>`);
                updateRekapPagination();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading rekap:', error);
            $('#loginlog-rekap-tbody').html(`<tr><td colspan="8" class="empty-state-table">
                <div class="icon">❌</div>
                <p>Error: ${error}</p>
                <p style="font-size:12px;">Silakan refresh halaman dan coba lagi</p>
            </div></tr>`);
            updateRekapPagination();
        }
    });
}

// Render tabel rekap login per akun
function renderLoginRekapPerAkun(users) {
    const tbody = document.getElementById('loginlog-rekap-tbody');
    
    if (!users || users.length === 0) {
        const noDataMessage = rekapSearchKeyword ? 
            `Tidak ditemukan user dengan keyword "${escapeHtml(rekapSearchKeyword)}"` : 
            'Belum ada data login yang tercatat';
        
        tbody.innerHTML = `<tr><td colspan="9" class="empty-state-table" style="padding: 60px 20px;">
            <div class="empty-state-icon" style="font-size: 64px; margin-bottom: 20px; opacity: 0.5;"></div>
            <div class="empty-state-title">${rekapSearchKeyword ? 'Tidak Ditemukan' : 'Belum Ada Data'}</div>
            <div class="empty-state-message">${noDataMessage}</div>
            ${rekapSearchKeyword ? `
                <div class="empty-state-suggestion">
                    <i class="fas fa-lightbulb"></i> Tips: Coba gunakan keyword lain atau hapus filter pencarian
                </div>
            ` : `
                <div class="empty-state-suggestion">
                    <i class="fas fa-lightbulb"></i> Tips: Pengguna akan tercatat setelah melakukan login ke sistem
                </div>
            `}
        </div></td>`;
        return;
    }
    
    const startNumber = (rekapCurrentPage - 1) * rekapPerPage;
    
    let html = '';
    users.forEach((user, index) => {
        // Tentukan badge warna berdasarkan jumlah login
        let loginBadge = '';
        let loginBadgeClass = '';
        if (user.total_login >= 10) {
            loginBadge = '🔥 Sangat Aktif';
            loginBadgeClass = 'pill-done';
        } else if (user.total_login >= 5) {
            loginBadge = '✅ Aktif';
            loginBadgeClass = 'pill-progress';
        } else if (user.total_login >= 1) {
            loginBadge = '📱 Kurang Aktif';
            loginBadgeClass = 'pill-review';
        } else {
            loginBadge = '⚪ Tidak Aktif';
            loginBadgeClass = 'pill-danger';
        }
        
        // Status session aktif
        let sessionBadge = '';
        if (user.active_sessions > 0) {
            sessionBadge = '<span class="pill" style="background:#dcfce7; color:#166534; margin-left: 5px;"><i class="fas fa-circle" style="font-size: 8px;"></i> Online</span>';
        }

        // TOMBOL DETAIL
        let detailButton = `
            <button class="btn btn-sm" style="background: #3b82f6; color: white; padding: 4px 12px; font-size: 11px; border: none; border-radius: 6px;" 
                    onclick="showLoginDetailRekap('${escapeHtml(user.username)}')">
                <i class="fas fa-chart-line"></i> Detail
            </button>
        `;
        
        html += `
            <tr>
                <td style="text-align:center;">${startNumber + index + 1}</td>
                <td class="username-cell">
                    <i class="fas fa-user"></i> <strong>${escapeHtml(user.username)}</strong>
                    ${sessionBadge}
                 </div></td>
                <td><span class="pill" style="background:#e0e7ff; color:#4338ca;">${escapeHtml(user.bidang)}</span></div></td>
                <td style="text-align:center;"><span class="pill ${loginBadgeClass}" style="font-weight:600;">${user.total_login} kali</span></div></td>
                <td style="text-align:center;"><span class="pill pill-print">${user.total_duration_formatted}</span></div></td>
                <td style="text-align:center;"><span class="pill pill-review">${user.avg_duration_formatted}</span></div></div></td>
                <td style="text-align:center;"><span class="pill" style="background:#f0f4ff;">${user.last_login_formatted}</span></div></td>
                <td style="text-align:center;"><span class="pill ${loginBadgeClass}">${loginBadge}</span></div></td>
                <td style="text-align:center;">${detailButton}</div> <!-- KOLOM AKSI -->
            </tr>
        `;
    });
    
    tbody.innerHTML = html;
}

// Update pagination untuk rekap login
function updateRekapPagination() {
    const startIndex = (rekapCurrentPage - 1) * rekapPerPage;
    const endIndex = Math.min(startIndex + rekapPerPage, rekapTotalData);
    
    if (rekapTotalData === 0) {
        $('#rekap-info-text').text('Menampilkan 0 dari 0 data');
        $('#rekap-pagination').empty();
        return;
    }
    
    $('#rekap-info-text').text(`Menampilkan ${startIndex + 1} - ${endIndex} dari ${rekapTotalData} data`);
    
    let paginationHtml = '';
    
    // Previous button
    paginationHtml += `<li class="page-item ${rekapCurrentPage === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="goToRekapPage(${rekapCurrentPage - 1}); return false;">
            <i class="bi bi-chevron-left"></i>
        </a>
    </li>`;
    
    // Page numbers
    let startPage = Math.max(1, rekapCurrentPage - 2);
    let endPage = Math.min(rekapTotalPages, startPage + 4);
    
    if (endPage - startPage < 4 && startPage > 1) {
        startPage = Math.max(1, endPage - 4);
    }
    
    if (startPage > 1) {
        paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToRekapPage(1); return false;">1</a></li>`;
        if (startPage > 2) paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }
    
    for (let i = startPage; i <= endPage; i++) {
        paginationHtml += `<li class="page-item ${rekapCurrentPage === i ? 'active' : ''}">
            <a class="page-link" href="#" onclick="goToRekapPage(${i}); return false;">${i}</a>
        </li>`;
    }
    
    if (endPage < rekapTotalPages) {
        if (endPage < rekapTotalPages - 1) paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToRekapPage(${rekapTotalPages}); return false;">${rekapTotalPages}</a></li>`;
    }
    
    // Next button
    paginationHtml += `<li class="page-item ${rekapCurrentPage === rekapTotalPages ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="goToRekapPage(${rekapCurrentPage + 1}); return false;">
            <i class="bi bi-chevron-right"></i>
        </a>
    </li>`;
    
    $('#rekap-pagination').html(paginationHtml);
}

// Go to specific page on rekap
function goToRekapPage(page) {
    if (page < 1 || page > rekapTotalPages) return;
    rekapCurrentPage = page;
    loadLoginRekapPerAkun();
}

// Change per page on rekap
function changeRekapPerPage() {
    rekapPerPage = parseInt($('#rekap-per-page').val());
    rekapCurrentPage = 1;
    loadLoginRekapPerAkun();
}

// Search user on rekap
function searchRekapUser() {
    rekapSearchKeyword = $('#rekap-search').val().trim();
    rekapCurrentPage = 1;
    loadLoginRekapPerAkun();
}

// Reset rekap search
function resetRekapSearch() {
    $('#rekap-search').val('');
    rekapSearchKeyword = '';
    rekapCurrentPage = 1;
    loadLoginRekapPerAkun();
}

// Override onLoginLogBidangChange untuk reset rekap pagination
const originalOnLoginLogBidangChange = onLoginLogBidangChange;
onLoginLogBidangChange = function() {
    rekapCurrentPage = 1;
    rekapSearchKeyword = '';
    $('#rekap-search').val('');
    if (originalOnLoginLogBidangChange) originalOnLoginLogBidangChange();
    loadLoginRekapPerAkun();
};

// Override onLoginLogPeriodeChange
$('#loginlog-periode-filter').off('change').on('change', function() {
    rekapCurrentPage = 1;
    loadLoginRekapPerAkun();
    loadTopUsers();
});

// ==================== DETAIL REKAP LOGIN PER AKUN ====================

// ==================== DETAIL REKAP LOGIN PER AKUN ====================

/**
 * Menampilkan modal detail rekap login untuk user tertentu
 * @param {string} username - Username yang akan dilihat detailnya
 */
function showLoginDetailRekap(username) {
    // Tampilkan modal loading
    $('#modalLoginDetail').css('display', 'flex');
    $('#modalLoginDetailTitle').html(` Detail Rekap Login - ${escapeHtml(username)}`);
    
    $('#modalLoginDetailBody').html(`
        <div style="text-align:center;padding:40px;">
            <div class="modern-spinner"></div>
            <p>Memuat data rekap login untuk <strong>${escapeHtml(username)}</strong>...</p>
        </div>
    `);
    
    $.ajax({
        url: '<?= base_url('IDE/get_login_detail_rekap_by_akun') ?>',
        type: 'GET',
        data: { username: username },
        dataType: 'json',
        timeout: 15000,
        success: function(response) {
            if (response.status === 'success') {
                renderLoginDetailRekap(response);
            } else {
                $('#modalLoginDetailBody').html(`
                    <div style="text-align:center;padding:40px;color:red;">
                        <p>❌ Gagal memuat data</p>
                        <p>${response.message || 'Silakan coba lagi'}</p>
                    </div>
                `);
            }
        },
        error: function(xhr, status, error) {
            $('#modalLoginDetailBody').html(`
                <div style="text-align:center;padding:40px;color:red;">
                    <p>❌ Error: ${error}</p>
                    <p>Silakan refresh halaman dan coba lagi</p>
                </div>
            `);
        }
    });
}

/**
 * Render tampilan detail rekap login
 */
function renderLoginDetailRekap(data) {
    const periods = ['hari', 'minggu', 'bulan', 'tahun', 'semua'];
    const periodIcons = {
        'hari': '',
        'minggu': '',
        'bulan': '',
        'tahun': '',
        'semua': ''
    };
    
    let html = `
        <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <div>
                <span class="rekap-badge-user" style="background: #1a2d6b; color: white; padding: 8px 16px;">
                    👤 ${escapeHtml(data.username)}
                </span>
                <span class="rekap-badge-user" style="background: #e0e7ff; color: #4338ca; margin-left: 8px;">
                    🏢 ${escapeHtml(data.bidang)}
                </span>
            </div>
        </div>
    `;
    
    // Card per periode
    html += `
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 25px;">
    `;
    
    for (const period of periods) {
        const p = data.periods[period];
        if (!p) continue;
        
        // Warna background berbeda per periode
        let bgColor = '#f8f9fd';
        let borderColor = '#e2e8f0';
        if (period === 'hari') { bgColor = '#e8f0fe'; borderColor = '#3b82f6'; }
        if (period === 'minggu') { bgColor = '#e6f7e6'; borderColor = '#22c55e'; }
        if (period === 'bulan') { bgColor = '#fef3e6'; borderColor = '#f59e0b'; }
        if (period === 'tahun') { bgColor = '#f0e6fe'; borderColor = '#8b5cf6'; }
        if (period === 'semua') { bgColor = '#fee2e2'; borderColor = '#ef4444'; }
        
        html += `
            <div style="background: ${bgColor}; border-radius: 16px; padding: 16px; border-left: 4px solid ${borderColor};">
                <div style="font-size: 24px; margin-bottom: 8px;">${periodIcons[period]}</div>
                <div style="font-weight: 600; font-size: 14px; color: #1e293b;">${p.label}</div>
                <div style="font-size: 28px; font-weight: 800; color: #0f172a; margin: 8px 0;">
                    ${p.total_duration_formatted}
                </div>
                <div style="font-size: 11px; color: #64748b; margin-top: 8px; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 8px;">
                    <div> ${p.login_count} kali login</div>
                    <div> Rata-rata: ${p.avg_duration_formatted}</div>
                    ${period !== 'semua' ? `<div> Rata-rata: ${p.avg_per_day} login/hari</div>` : ''}
                </div>
            </div>
        `;
    }
    
    html += `</div>`;
    
    // Ringkasan statistik tambahan
    const semua = data.periods.semua;
    html += `
        <div style="background: linear-gradient(135deg, #1a2d6b 0%, #162060 100%); border-radius: 16px; padding: 20px; margin-bottom: 25px; color: white;">
            <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                <div>
                    <div style="font-size: 12px; opacity: 0.7;">Total Waktu Login</div>
                    <div style="font-size: 36px; font-weight: 800;">${semua.total_duration_formatted}</div>
                </div>
                <div>
                    <div style="font-size: 12px; opacity: 0.7;">Total Login</div>
                    <div style="font-size: 36px; font-weight: 800;">${semua.login_count} kali</div>
                </div>
                <div>
                    <div style="font-size: 12px; opacity: 0.7;">Rata-rata per Login</div>
                    <div style="font-size: 24px; font-weight: 700;">${semua.avg_duration_formatted}</div>
                </div>
                <div>
                    <div style="font-size: 12px; opacity: 0.7;">Periode Aktivitas</div>
                    <div style="font-size: 18px; font-weight: 600;">${semua.range_days} hari</div>
                </div>
            </div>
        </div>
    `;
    
    // Tabel aktivitas login per hari (30 hari terakhir)
    if (data.daily_logs && data.daily_logs.length > 0) {
        html += `
            <h4 style="margin: 20px 0 10px 0; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-chart-line"></i> Aktivitas Login 30 Hari Terakhir
            </h4>
            <div style="overflow-x: auto;">
                <table class="user-detail-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jumlah Login</th>
                            <th>Total Durasi</th>
                            <th>Rata-rata per Login</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        for (const daily of data.daily_logs) {
            let avgPerLogin = daily.count > 0 ? Math.round(daily.total_seconds / daily.count / 60) : 0;
            let avgText = avgPerLogin > 0 ? `${avgPerLogin} menit` : '< 1 menit';
            
            html += `
                <tr>
                    <td>${escapeHtml(daily.date_formatted)}</div></td>
                    <td style="text-align: center;"><span class="pill pill-done">${daily.count} kali</span></div></td>
                    <td><strong>${daily.total_formatted}</strong></div></td>
                    <td>${avgText}</div></td>
                </tr>
            `;
        }
        
        html += `
                    </tbody>
                </table>
            </div>
        `;
    } else {
        html += `
            <div style="text-align:center;padding:30px; background: #f8f9fd; border-radius: 12px;">
                <p>📭 Belum ada aktivitas login dalam 30 hari terakhir</p>
            </div>
        `;
    }
    
    // Tips interpretasi
    html += `
        <div style="margin-top: 20px; padding: 15px; background: #f0f4ff; border-radius: 12px; font-size: 11px; color: #475569;">
            <i class="fas fa-info-circle"></i> <strong>Informasi:</strong>
            Durasi dihitung dari waktu login hingga logout. Jika session masih aktif, dihitung sampai waktu saat ini.
            ${data.periods.semua.login_count > 0 ? `<br>📌 User ini aktif selama ${Math.round(data.periods.semua.total_duration_seconds / 3600)} jam total dari ${data.periods.semua.range_days} hari masa aktif.` : ''}
        </div>
    `;
    
    $('#modalLoginDetailBody').html(html);
}

/**
 * Tutup modal detail rekap login
 */
function closeModalLoginDetail() {
    $('#modalLoginDetail').css('display', 'none');
    $('#modalLoginDetailBody').html(`
        <div style="text-align:center;padding:40px;">
            <div class="modern-spinner"></div>
            <p>Memuat data...</p>
        </div>
    `);
}

// ==================== LOGIN LOG FUNCTIONS ====================

let allLoginLogData = [];
let loginLogCurrentPage = 1;
let loginLogPerPage = 25;

// Load login log dari server
function loadLoginLog() {
    console.log('Loading login log...');
    
    $('#loginlog-tbody').html(`
        <tr><td colspan="7" style="text-align:center;padding:40px;">
            <div class="modern-spinner"></div>
            <p>Memuat data login log...</p>
        </td></tr>
    `);
    
    const bidang = $('#loginlog-bidang-pilih').val();
    const username = $('#loginlog-akun-pilih').val();
    const startDate = $('#loginlog-date-start').val();
    const endDate = $('#loginlog-date-end').val();
    
    $.ajax({
        url: '<?= base_url('IDE/get_login_log') ?>',
        type: 'GET',
        data: {
            bidang: bidang,
            username: username,
            start_date: startDate,
            end_date: endDate,
            limit: loginLogPerPage,
            offset: (loginLogCurrentPage - 1) * loginLogPerPage
        },
        dataType: 'json',
        timeout: 10000,
        success: function(response) {
            if (response.status === 'success') {
                allLoginLogData = response.data;
                const total = response.total;
                const totalPages = Math.ceil(total / loginLogPerPage);
                
                renderLoginLogTable(allLoginLogData);
                updateLoginLogPagination(totalPages, total);
                
                console.log('Login log loaded:', allLoginLogData.length, 'records');
            } else {
                $('#loginlog-tbody').html(`<tr><td colspan="7" class="empty-state-table">
                    <div class="icon">⚠️</div>
                    <p>Gagal memuat data login log</p>
                </td></tr>`);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading login log:', error);
            $('#loginlog-tbody').html(`<tr><td colspan="7" class="empty-state-table">
                <div class="icon">❌</div>
                <p>Error memuat data dari server</p>
            </td></tr>`);
        }
    });
    
    // Load rekap data juga
    loadLoginRekap();
}

// Load rekap login (statistik)
function loadLoginRekap() {
    const bidang = $('#loginlog-bidang-pilih').val();
    const username = $('#loginlog-akun-pilih').val();
    
    $.ajax({
        url: '<?= base_url('IDE/get_login_rekap') ?>',
        type: 'GET',
        data: { bidang: bidang, username: username },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                const data = response.data;
                
                $('#login-count-hari').text(data.hari.login_count);
                $('#login-duration-hari').text(data.hari.duration_formatted);
                
                $('#login-count-minggu').text(data.minggu.login_count);
                $('#login-duration-minggu').text(data.minggu.duration_formatted);
                
                $('#login-count-bulan').text(data.bulan.login_count);
                $('#login-duration-bulan').text(data.bulan.duration_formatted);
                
                $('#login-count-tahun').text(data.tahun.login_count);
                $('#login-duration-tahun').text(data.tahun.duration_formatted);
            }
        },
        error: function() {
            console.error('Error loading login rekap');
        }
    });
}

// Load top users
function loadTopUsers() {
    const periode = $('#top-user-periode').val();
    const bidang = $('#loginlog-bidang-pilih').val();
    
    $('#top-user-tbody').html(`
        <tr><td colspan="5" style="text-align:center;padding:40px;">
            <div class="modern-spinner"></div>
            <p>Memuat data...</p>
        </td></tr>
    `);
    
    $.ajax({
        url: '<?= base_url('IDE/get_login_top_users') ?>',
        type: 'GET',
        data: { bidang: bidang, periode: periode, limit: 10 },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success' && response.data.length > 0) {
                let html = '';
                response.data.forEach((user, index) => {
                    html += `
                        <tr>
                            <td style="text-align:center;">${index + 1}</td>
                            <td><strong>${escapeHtml(user.username)}</strong></td>
                            <td>${escapeHtml(user.bidang || '-')}</td>
                            <td style="text-align:center;"><span class="pill pill-done">${user.login_count} kali</span></td>
                            <td>${user.duration_formatted}</td>
                        </tr>
                    `;
                });
                $('#top-user-tbody').html(html);
            } else {
                $('#top-user-tbody').html(`<tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-3);">
                    <div style="font-size:48px; margin-bottom:15px;">📭</div>
                    Belum ada data login
                </td></td></tr>`);
            }
        },
        error: function() {
            $('#top-user-tbody').html(`<tr><td colspan="5" style="text-align:center;padding:40px;color:red;">
                Gagal memuat data
            <tr></td></tr>`);
        }
    });
}

// Render tabel login log
function renderLoginLogTable(logs) {
    const tbody = document.getElementById('loginlog-tbody');
    
    if (!logs || logs.length === 0) {
        tbody.innerHTML = `<tr><td colspan="7" class="empty-state-table" style="padding: 60px 20px;">
            <div class="empty-state-icon" style="font-size: 64px; margin-bottom: 20px; opacity: 0.5;">📭</div>
            <div class="empty-state-title">Belum Ada Data Login</div>
            <div class="empty-state-message">Tidak ada riwayat login yang ditemukan</div>
        </div></td>`;
        return;
    }
    
    tbody.innerHTML = logs.map((log, index) => {
        let ip = log.ip_address || '-';
        if (ip === '::1') ip = '127.0.0.1';
        
        return `
            <tr>
                <td class="waktu-cell">${escapeHtml(log.login_time_formatted)}</td>
                <td class="waktu-cell">${escapeHtml(log.logout_time_formatted)}</td>
                <td class="waktu-cell">${escapeHtml(log.duration_formatted)}</td>
                <td class="username-cell"><i class="fas fa-user"></i> ${escapeHtml(log.username)}</td>
                <td>${escapeHtml(log.bidang || '-')}</td>
                <td><code class="ip-address">${escapeHtml(ip)}</code></td>
                <td>${log.status_badge}</td>
            </tr>
        `;
    }).join('');
}

// Update pagination login log
function updateLoginLogPagination(totalPages, totalItems) {
    const startIndex = (loginLogCurrentPage - 1) * loginLogPerPage;
    const endIndex = Math.min(startIndex + loginLogPerPage, totalItems);
    
    $('#loginlog-info-text').text(`Menampilkan ${startIndex + 1} - ${endIndex} dari ${totalItems} data`);
    
    let paginationHtml = '';
    
    paginationHtml += `<li class="page-item ${loginLogCurrentPage === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="goToLoginLogPage(${loginLogCurrentPage - 1}); return false;">
            <i class="bi bi-chevron-left"></i>
        </a>
    </li>`;
    
    let startPage = Math.max(1, loginLogCurrentPage - 2);
    let endPage = Math.min(totalPages, startPage + 4);
    
    if (endPage - startPage < 4 && startPage > 1) {
        startPage = Math.max(1, endPage - 4);
    }
    
    if (startPage > 1) {
        paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToLoginLogPage(1); return false;">1</a></li>`;
        if (startPage > 2) paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }
    
    for (let i = startPage; i <= endPage; i++) {
        paginationHtml += `<li class="page-item ${loginLogCurrentPage === i ? 'active' : ''}">
            <a class="page-link" href="#" onclick="goToLoginLogPage(${i}); return false;">${i}</a>
        </li>`;
    }
    
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToLoginLogPage(${totalPages}); return false;">${totalPages}</a></li>`;
    }
    
    paginationHtml += `<li class="page-item ${loginLogCurrentPage === totalPages ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="goToLoginLogPage(${loginLogCurrentPage + 1}); return false;">
            <i class="bi bi-chevron-right"></i>
        </a>
    </li>`;
    
    $('#loginlog-pagination').html(paginationHtml);
}

// Go to page
function goToLoginLogPage(page) {
    if (page < 1) return;
    loginLogCurrentPage = page;
    loadLoginLog();
}

// Change per page
function changeLoginLogPerPage() {
    loginLogPerPage = parseInt($('#loginlog-per-page').val());
    loginLogCurrentPage = 1;
    loadLoginLog();
}

// Filter by date
function filterLoginLogByDate() {
    loginLogCurrentPage = 1;
    loadLoginLog();
}

// Filter table (client-side)
function filterLoginLogTable() {
    const searchText = $('#loginlog-search').val().toLowerCase();
    
    if (!searchText) {
        // Reload from server with current filters
        loginLogCurrentPage = 1;
        loadLoginLog();
        return;
    }
    
    // Client-side filtering for search only
    const bidang = $('#loginlog-bidang-pilih').val();
    const username = $('#loginlog-akun-pilih').val();
    const startDate = $('#loginlog-date-start').val();
    const endDate = $('#loginlog-date-end').val();
    
    $.ajax({
        url: '<?= base_url('IDE/get_login_log') ?>',
        type: 'GET',
        data: {
            bidang: bidang,
            username: username,
            start_date: startDate,
            end_date: endDate,
            limit: 1000,
            offset: 0
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                let filtered = response.data;
                
                if (searchText) {
                    filtered = filtered.filter(log => 
                        (log.username || '').toLowerCase().includes(searchText) ||
                        (log.ip_address || '').toLowerCase().includes(searchText)
                    );
                }
                
                renderLoginLogTable(filtered);
                $('#loginlog-pagination').empty();
                $('#loginlog-info-text').text(`Menampilkan ${filtered.length} dari ${filtered.length} data (hasil filter)`);
            }
        }
    });
}

// Refresh login log
function refreshLoginLog() {
    $('#loginlog-date-start').val('');
    $('#loginlog-date-end').val('');
    $('#loginlog-search').val('');
    loginLogCurrentPage = 1;
    loadLoginLog();
    loadTopUsers();
}

// Load akun untuk filter login log
$('#loginlog-bidang-pilih').on('change', function() {
    const bidang = $(this).val();
    if (bidang) {
        $.ajax({
            url: '<?= base_url('IDE/get_akun_by_bidang') ?>',
            type: 'GET',
            data: { bidang: bidang },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    let options = '<option value="">-- Semua Akun --</option>';
                    response.data.forEach(function(akun) {
                        options += `<option value="${escapeHtml(akun.Username)}">👤 ${escapeHtml(akun.Username)}</option>`;
                    });
                    $('#loginlog-akun-pilih').html(options);
                }
            }
        });
    } else {
        $('#loginlog-akun-pilih').html('<option value="">-- Semua Akun --</option>');
    }
    loadLoginLog();
});

$('#loginlog-akun-pilih').on('change', function() {
    loginLogCurrentPage = 1;
    loadLoginLog();
});

// Export login log to PDF
async function exportLoginLogToPDF() {
    const bidang = $('#loginlog-bidang-pilih').val();
    const username = $('#loginlog-akun-pilih').val();
    const startDate = $('#loginlog-date-start').val();
    const endDate = $('#loginlog-date-end').val();
    
    Swal.fire({
        title: 'Membuat PDF...',
        text: 'Mohon tunggu, sedang memproses data',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    
    try {
        // Ambil semua data
        const response = await $.ajax({
            url: '<?= base_url('IDE/get_login_log') ?>',
            type: 'GET',
            data: { bidang: bidang, username: username, start_date: startDate, end_date: endDate, limit: 5000, offset: 0 },
            dataType: 'json'
        });
        
        if (response.status !== 'success') {
            throw new Error('Gagal mengambil data');
        }
        
        const logs = response.data;
        const logoUrl = '<?= base_url('assets/img/bappeda.png') ?>';
        const now = new Date();
        const dateStr = now.toLocaleDateString('id-ID');
        
        let htmlContent = `
            <div class="pdf-export-wrapper">
                <div class="pdf-header">
                    <div style="display: flex; align-items: center; justify-content: center; gap: 15px;">
                        <img src="${logoUrl}" alt="Logo" style="height: 50px;">
                        <div>
                            <h2>Smart Office Management</h2>
                            <h3>BAPPEDA KABUPATEN BANYUWANGI</h3>
                        </div>
                    </div>
                    <p>Laporan Log Login Pengguna</p>
                </div>
                <div class="pdf-date">
                    <strong>Tanggal Export:</strong> ${dateStr}<br>
                    <strong>Total Data:</strong> ${logs.length} login records
                </div>
                <table class="pdf-table">
                    <thead>
                        <tr>
                            <th>Waktu Login</th>
                            <th>Waktu Logout</th>
                            <th>Durasi</th>
                            <th>User</th>
                            <th>Bidang</th>
                            <th>IP Address</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        logs.forEach(log => {
            htmlContent += `
                <tr>
                    <td>${log.login_time_formatted}</td>
                    <td>${log.logout_time_formatted}</td>
                    <td>${log.duration_formatted}</td>
                    <td>${escapeHtml(log.username)}</td>
                    <td>${escapeHtml(log.bidang || '-')}</td>
                    <td>${log.ip_address || '-'}</td>
                    <td>${log.status}</td>
                </tr>
            `;
        });
        
        htmlContent += `
                    </tbody>
                </table>
                <div class="pdf-footer">
                    <p>Dokumen ini dibuat secara otomatis oleh sistem Smart Office Management Bappeda</p>
                </div>
            </div>
        `;
        
        const element = document.createElement('div');
        element.innerHTML = htmlContent;
        document.body.appendChild(element);
        
        const opt = {
            margin: [0.5, 0.5, 0.5, 0.5],
            filename: `Login_Log_${dateStr.replace(/\//g, '-')}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
        };
        
        await html2pdf().set(opt).from(element).save();
        document.body.removeChild(element);
        
        Swal.fire('Berhasil!', 'File PDF telah di-download', 'success');
    } catch (error) {
        Swal.fire('Error!', 'Gagal membuat PDF: ' + error.message, 'error');
    }
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

// ================= PREVIEW DOKUMEN DENGAN LOG PRINT =================
function previewDokumen(filePath, fileType, fileName) {
    // AMBIL ID DOKUMEN dari atribut data atau dari baris tabel
    let idDokumen = null;
    
    // Cari ID dokumen dari tombol hapus di baris yang sama
    const clickSource = event ? event.target : null;
    if (clickSource) {
        const row = $(clickSource).closest('tr');
        if (row.length) {
            const deleteBtn = row.find('.link-danger');
            if (deleteBtn.length && deleteBtn.attr('onclick')) {
                const match = deleteBtn.attr('onclick').match(/deleteDokumen\((\d+)\)/);
                if (match) idDokumen = match[1];
            }
        }
    }
    
    // Jika masih null, coba cari dari elemen lain
    if (!idDokumen) {
        // Coba dari atribut data-id
        const dataId = $(clickSource).closest('[data-id-dokumen]').attr('data-id-dokumen');
        if (dataId) idDokumen = dataId;
    }
    
    console.log('Preview dokumen - ID:', idDokumen, 'Nama:', fileName);
    
    // SIMPAN ke hidden input untuk digunakan saat print
    if (idDokumen) {
        document.getElementById('preview-dokumen-id').value = idDokumen;
        document.getElementById('preview-dokumen-nama').value = fileName;
        document.getElementById('preview-dokumen-path').value = filePath;
    }
    
    // Tampilkan preview
    document.getElementById('previewTitle').textContent = fileName || 'Preview Dokumen';
    const previewDiv = document.getElementById('previewContent');
    const baseUrl = '<?= base_url() ?>';
    const fullUrl = baseUrl + filePath;
    
    // LOG PREVIEW (tanpa print)
    if (idDokumen) {
        $.ajax({
            url: '<?= base_url('IDE/log_preview') ?>',
            type: 'POST',
            data: { id_dokumen: idDokumen },
            dataType: 'json',
            success: function(response) {
                console.log('Preview logged:', response);
            },
            error: function(xhr, status, error) {
                console.error('Failed to log preview:', error);
            }
        });
    }
    
    // Tampilkan konten preview
    if (fileType && fileType.startsWith('image/')) {
        previewDiv.innerHTML = `<img src="${fullUrl}" style="max-width:100%; max-height:60vh; border-radius:8px;" alt="${escapeHtml(fileName)}">`;
    } else if (fileType === 'application/pdf') {
        previewDiv.innerHTML = `<iframe src="${fullUrl}" style="width:100%; height:60vh;" frameborder="0"></iframe>`;
    } else {
        previewDiv.innerHTML = `
            <div style="padding:60px 20px; text-align:center;">
                <div style="font-size:64px; margin-bottom:20px;">📄</div>
                <p style="margin-bottom:20px; color:var(--text-2);">File tidak dapat dipreview langsung</p>
                <a href="${fullUrl}" class="btn btn-primary" download target="_blank">⬇️ Download File</a>
            </div>
        `;
    }
    
    // Tampilkan modal
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
            <h2 style="margin: 0; color: #1a2d6b;">Smart Office Management</h2>
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
        <p>Dokumen ini dibuat secara otomatis oleh sistem Smart Office Management</p>
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
// ================= PAGINATION GLOBAL VARIABLES =================
let currentPage = 1;
let perPage = 10;
let filteredData = [];

// ================= UPDATE PAGINATION =================
function updatePagination() {
    if (!filteredData || filteredData.length === 0) {
        $('#log-pagination').empty();
        $('#log-info-text').text('Menampilkan 0 dari 0 data');
        return;
    }
    
    const totalItems = filteredData.length;
    const totalPages = Math.ceil(totalItems / perPage);
    const startIndex = (currentPage - 1) * perPage;
    const endIndex = Math.min(startIndex + perPage, totalItems);
    const currentData = filteredData.slice(startIndex, endIndex);
    
    // Update info text
    $('#log-info-text').text(`Menampilkan ${startIndex + 1} - ${endIndex} dari ${totalItems} data`);
    
    // Generate pagination buttons
    let paginationHtml = '';
    
    // Previous button
    paginationHtml += `
        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="goToPage(${currentPage - 1}); return false;">
                <i class="bi bi-chevron-left"></i>
            </a>
        </li>
    `;
    
    // Calculate page range to show (max 5 pages)
    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(totalPages, startPage + 4);
    
    if (endPage - startPage < 4 && startPage > 1) {
        startPage = Math.max(1, endPage - 4);
    }
    
    // First page button if needed
    if (startPage > 1) {
        paginationHtml += `
            <li class="page-item"><a class="page-link" href="#" onclick="goToPage(1); return false;">1</a></li>
            ${startPage > 2 ? '<li class="page-item disabled"><span class="page-link">...</span></li>' : ''}
        `;
    }
    
    // Page buttons
    for (let i = startPage; i <= endPage; i++) {
        paginationHtml += `
            <li class="page-item ${currentPage === i ? 'active' : ''}">
                <a class="page-link" href="#" onclick="goToPage(${i}); return false;">${i}</a>
            </li>
        `;
    }
    
    // Last page button if needed
    if (endPage < totalPages) {
        paginationHtml += `
            ${endPage < totalPages - 1 ? '<li class="page-item disabled"><span class="page-link">...</span></li>' : ''}
            <li class="page-item"><a class="page-link" href="#" onclick="goToPage(${totalPages}); return false;">${totalPages}</a></li>
        `;
    }
    
    // Next button
    paginationHtml += `
        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="goToPage(${currentPage + 1}); return false;">
                <i class="bi bi-chevron-right"></i>
            </a>
        </li>
    `;
    
    $('#log-pagination').html(paginationHtml);
    
    // Render current page data
    renderLogTable(currentData);
}

// ================= TOTAL KERTAS TERPAKAI FUNCTIONS =================
let currentBidangFilterKertas = '';

// Load total kertas terpakai
function loadTotalKertasTerpakai(bidang = '') {
    currentBidangFilterKertas = bidang;
    
    // Update info bidang yang difilter
    if (bidang && bidang !== '') {
        $('#bidang-filter-info').show();
        $('#bidang-filter-nama').text(bidang);
    } else {
        $('#bidang-filter-info').hide();
    }
    
    // Load per periode
    const periods = ['hari', 'minggu', 'bulan', 'tahun'];
    
    periods.forEach(period => {
        $.ajax({
            url: '<?= base_url('IDE/get_total_kertas_terpakai') ?>',
            type: 'GET',
            data: { bidang: bidang, periode: period },
            dataType: 'json',
            async: true,
            success: function(response) {
                if (response.status === 'success') {
                    let elementId = '';
                    switch(period) {
                        case 'hari': elementId = 'total-kertas-hari'; break;
                        case 'minggu': elementId = 'total-kertas-minggu'; break;
                        case 'bulan': elementId = 'total-kertas-bulan'; break;
                        case 'tahun': elementId = 'total-kertas-tahun'; break;
                    }
                    $('#' + elementId).text(formatNumberRibuan(response.total_kertas));
                    
                    // Update tooltip dengan detail print
                    $(`#${elementId}`).attr('title', `${response.total_print} kali print (${response.success_count} berhasil, ${response.failed_count} gagal)`);
                }
            },
            error: function() {
                console.error('Error loading kertas untuk periode:', period);
            }
        });
    });
    
    // Load total keseluruhan
    $.ajax({
        url: '<?= base_url('IDE/get_total_kertas_terpakai') ?>',
        type: 'GET',
        data: { bidang: bidang },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#total-kertas-semua').text(formatNumberRibuan(response.total_kertas));
                $('#total-kertas-semua').attr('title', `${response.total_print} total print (${response.success_count} sukses, ${response.failed_count} gagal)`);
            }
        },
        error: function() {
            console.error('Error loading total kertas keseluruhan');
        }
    });
}

// Refresh kertas terpakai (dengan filter bidang saat ini)
function refreshKertasTerpakai() {
    const currentBidang = $('#log-bidang-pilih').val();
    loadTotalKertasTerpakai(currentBidang);
}

// Format angka dengan pemisah ribuan
function formatNumberRibuan(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Modified loadLogByBidang - update total kertas juga
function loadLogByBidang() {
    const bidang = $('#log-bidang-pilih').val();
    loadTotalKertasTerpakai(bidang);  // ← Update total kertas berdasarkan bidang
    loadLogAktivitas();                // Load log aktivitas
}

// Modified refreshLogData - reset total kertas
function refreshLogData() {
    $('#log-date-start').val('');
    $('#log-date-end').val('');
    $('#log-aksi-filter').val('');
    $('#log-search').val('');
    $('#log-per-page').val('25');
    perPage = 25;
    
    const selectedBidang = $('#log-bidang-pilih').val();
    if (selectedBidang !== '') {
        $('#log-bidang-pilih').val('');
        loadTotalKertasTerpakai('');   // Reset total kertas ke semua bidang
        loadLogAktivitas();
    } else {
        loadTotalKertasTerpakai('');
        loadLogAktivitas();
    }
}

// ================= GO TO PAGE =================
function goToPage(page) {
    if (page < 1 || page > Math.ceil(filteredData.length / perPage)) return;
    currentPage = page;
    updatePagination();
}

// ================= CHANGE ITEMS PER PAGE =================
function changePerPage() {
    perPage = parseInt($('#log-per-page').val());
    currentPage = 1;
    
    // Apply current filters to get filteredData
    applyFiltersAndPagination();
}

// ================= APPLY FILTERS AND UPDATE PAGINATION =================
function applyFiltersAndPagination() {
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
            if (!log.waktu) return false;
            const parts = log.waktu.split(' ');
            const dateParts = parts[0].split('/');
            const logDate = new Date(`${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`);
            return logDate >= startDate;
        });
    }
    
    if (dateEnd) {
        const endDate = new Date(dateEnd);
        endDate.setHours(23, 59, 59);
        filtered = filtered.filter(log => {
            if (!log.waktu) return false;
            const parts = log.waktu.split(' ');
            const dateParts = parts[0].split('/');
            const logDate = new Date(`${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`);
            return logDate <= endDate;
        });
    }
    
    filteredData = filtered;
    currentPage = 1;
    updatePagination();
}

// ================= MODIFIED FILTER LOG TABLE =================
function filterLogTable() {
    applyFiltersAndPagination();
}

// ================= VARIABEL GLOBAL =================
let currentBidangFilter = '';
let currentAkunFilter = '';

// ================= LOAD AKUN BERDASARKAN BIDANG =================
function loadAkunByBidang(bidang) {
    if (!bidang || bidang === '') {
        $('#log-akun-pilih').html('<option value="">-- Semua Akun --</option>');
        return;
    }
    
    $.ajax({
        url: '<?= base_url('IDE/get_akun_by_bidang') ?>',
        type: 'GET',
        data: { bidang: bidang },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success' && response.data.length > 0) {
                let options = '<option value="">-- Semua Akun --</option>';
                response.data.forEach(function(akun) {
                    options += `<option value="${escapeHtml(akun.Username)}">👤 ${escapeHtml(akun.Username)}</option>`;
                });
                $('#log-akun-pilih').html(options);
                
                // Reset pilihan akun
                $('#log-akun-pilih').val('');
                currentAkunFilter = '';
            } else {
                $('#log-akun-pilih').html('<option value="">-- Tidak ada akun --</option>');
            }
        },
        error: function() {
            console.error('Error loading akun for bidang:', bidang);
            $('#log-akun-pilih').html('<option value="">-- Gagal memuat akun --</option>');
        }
    });
}

// ================= EVENT HANDLER SAAT BIDANG BERUBAH =================
function onBidangChange() {
    const selectedBidang = $('#log-bidang-pilih').val();
    currentBidangFilter = selectedBidang || '';
    
    // Load akun berdasarkan bidang yang dipilih
    loadAkunByBidang(selectedBidang);
    
    // Reset pilihan akun
    $('#log-akun-pilih').val('');
    currentAkunFilter = '';
    
    // Load log aktivitas
    loadLogAktivitas();
    
    // Load total kertas terpakai
    loadTotalKertasTerpakai(selectedBidang);
}

// ================= MODIFIED LOAD LOG AKTIVITAS (dengan filter akun) =================
function loadLogAktivitas() {
    console.log('Loading log aktivitas...');
    
    $('#log-tbody').html(`
        <tr><td colspan="7" style="text-align:center;padding:40px;">
            <div class="modern-spinner"></div>
            <p>Memuat data log...</p>
        </div></td>
    `);
    
    const bidangFilter = $('#log-bidang-pilih').val();
    const akunFilter = $('#log-akun-pilih').val();
    currentBidangFilter = bidangFilter || '';
    currentAkunFilter = akunFilter || '';
    
    // Update info panel
    if (akunFilter) {
        $('#bidang-info').show();
        $('#bidang-terpilih-label').html(`Akun: ${escapeHtml(akunFilter)} ${bidangFilter ? `(Bidang: ${bidangFilter})` : ''}`);
    } else if (bidangFilter) {
        $('#bidang-info').show();
        $('#bidang-terpilih-label').text(`Bidang: ${bidangFilter}`);
    } else {
        $('#bidang-info').hide();
    }
    
    // Gunakan endpoint yang berbeda berdasarkan apakah ada filter akun
    let endpoint = '<?= base_url('IDE/get_log_aktivitas') ?>';
    let params = {};
    
    if (akunFilter) {
        endpoint = '<?= base_url('IDE/get_log_aktivitas_by_akun') ?>';
        params.username = akunFilter;
    } else if (bidangFilter) {
        params.bidang = bidangFilter;
    }
    
    $.ajax({
        url: endpoint,
        type: 'GET',
        data: params,
        dataType: 'json',
        timeout: 10000,
        success: function(response) {
            if (response.status === 'success') {
                allLogData = response.data;
                
                // ========== TAMBAHKAN: CEK DATA KOSONG ==========
                if (!allLogData || allLogData.length === 0) {
                    let emptyMessage = '';
                    if (akunFilter) {
                        emptyMessage = `Belum ada aktivitas tercatat untuk akun <strong>${escapeHtml(akunFilter)}</strong>`;
                    } else if (bidangFilter) {
                        emptyMessage = `Belum ada aktivitas tercatat untuk bidang <strong>${escapeHtml(bidangFilter)}</strong>`;
                    } else {
                        emptyMessage = 'Belum ada aktivitas tercatat di sistem';
                    }
                    
                    $('#log-tbody').html(`
                        <tr><td colspan="7" class="empty-state-table" style="padding: 60px 20px;">
                            <div class="empty-state-icon" style="font-size: 64px; margin-bottom: 20px; opacity: 0.5;">${akunFilter ? '👤' : '📭'}</div>
                            <div class="empty-state-title" style="font-size: 18px; font-weight: 600; color: var(--text-1); margin-bottom: 8px;">Data Tidak Tersedia</div>
                            <div class="empty-state-message" style="font-size: 13px; color: var(--text-2); margin-bottom: 5px;">${emptyMessage}</div>
                            <div class="empty-state-suggestion" style="font-size: 12px; color: var(--text-3); margin-top: 15px; padding-top: 15px; border-top: 1px solid var(--border); display: inline-block;">
                                <i class="fas fa-lightbulb"></i> Tips: Coba pilih bidang atau akun lain, atau lakukan aktivitas terlebih dahulu
                            </div>
                            ${akunFilter ? `
                            
                            ` : ''}
                        </div></td>
                    `);
                    $('#log-pagination').empty();
                    $('#log-info-text').text('Menampilkan 0 dari 0 data');
                    filteredData = [];
                    return;  // ← TAMBAHKAN: HENTIKAN PROSES
                }
                // ========== END TAMBAHKAN ==========
                
                filteredData = [...allLogData];
                currentPage = 1;
                updatePagination();
                console.log('Log data loaded:', allLogData.length, 'records');
                
                // Update statistik akun jika ada
                if (akunFilter) {
                    loadAkunStats(akunFilter);
                }
            } else {
                $('#log-tbody').html(`<tr><td colspan="7" class="empty-state-table">
                    <div class="icon">⚠️</div>
                    <p>Gagal memuat data log</p>
                 </div></td>`);
                $('#log-pagination').empty();
                $('#log-info-text').text('Menampilkan 0 dari 0 data');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading log:', error);
            $('#log-tbody').html(`<tr><td colspan="7" class="empty-state-table">
                <div class="icon">❌</div>
                <p>Error memuat data dari server</p>
              </div></td>`);
            $('#log-pagination').empty();
            $('#log-info-text').text('Menampilkan 0 dari 0 data');
        }
    });
}

// ================= LOAD STATISTIK AKUN (kertas terpakai) =================
function loadAkunStats(username) {
    const periods = ['hari', 'minggu', 'bulan', 'tahun'];
    
    // Reset tampilan
    $('#total-kertas-hari').text('0');
    $('#total-kertas-minggu').text('0');
    $('#total-kertas-bulan').text('0');
    $('#total-kertas-tahun').text('0');
    $('#total-kertas-semua').text('0');
    
    periods.forEach(period => {
        $.ajax({
            url: '<?= base_url('IDE/get_kertas_rekap_by_akun') ?>',
            type: 'GET',
            data: { username: username, periode: period },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    let elementId = '';
                    switch(period) {
                        case 'hari': elementId = 'total-kertas-hari'; break;
                        case 'minggu': elementId = 'total-kertas-minggu'; break;
                        case 'bulan': elementId = 'total-kertas-bulan'; break;
                        case 'tahun': elementId = 'total-kertas-tahun'; break;
                    }
                    const totalKertas = response.total_kertas;
                    $('#' + elementId).text(formatNumberRibuan(totalKertas));
                    
                    if (totalKertas === 0) {
                        $(`#${elementId}`).attr('title', 'Belum ada aktivitas print untuk periode ini');
                    } else {
                        $(`#${elementId}`).attr('title', `${response.total_print} kali print untuk akun ini`);
                    }
                }
            },
            error: function() {
                console.error('Error loading akun stats for period:', period);
            }
        });
    });
    
    // Load total keseluruhan untuk akun
    $.ajax({
        url: '<?= base_url('IDE/get_kertas_rekap_by_akun') ?>',
        type: 'GET',
        data: { username: username },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                const totalKertas = response.total_kertas;
                $('#total-kertas-semua').text(formatNumberRibuan(totalKertas));
                
                if (totalKertas === 0) {
                    $('#total-kertas-semua').attr('title', 'Akun ini belum pernah melakukan print');
                } else {
                    $('#total-kertas-semua').attr('title', `${response.total_print} total print untuk akun ini`);
                }
            }
        }
    });
}

// ================= MODIFIED REFRESH LOG DATA =================
function refreshLogData() {
    $('#log-date-start').val('');
    $('#log-date-end').val('');
    $('#log-aksi-filter').val('');
    $('#log-search').val('');
    $('#log-per-page').val('25');
    perPage = 25;
    
    // Reset filter bidang
    if ($('#log-bidang-pilih').val() !== '') {
        $('#log-bidang-pilih').val('');
        loadAkunByBidang('');
        $('#log-akun-pilih').val('');
        loadTotalKertasTerpakai('');
        loadLogAktivitas();
    } else if ($('#log-akun-pilih').val() !== '') {
        $('#log-akun-pilih').val('');
        loadTotalKertasTerpakai('');
        loadLogAktivitas();
    } else {
        loadLogAktivitas();
    }
}

// ================= MODIFIED FILTER LOG TABLE (dengan filter akun) =================
function filterLogTable() {
    const searchText = $('#log-search').val().toLowerCase();
    const aksiFilter = $('#log-aksi-filter').val();
    const dateStart = $('#log-date-start').val();
    const dateEnd = $('#log-date-end').val();
    const akunFilter = $('#log-akun-pilih').val();
    
    let filtered = [...allLogData];
    
    // Filter berdasarkan akun
    if (akunFilter) {
        filtered = filtered.filter(log => log.username === akunFilter);
    }
    
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
            if (!log.waktu) return false;
            const parts = log.waktu.split(' ');
            const dateParts = parts[0].split('/');
            const logDate = new Date(`${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`);
            return logDate >= startDate;
        });
    }
    
    if (dateEnd) {
        const endDate = new Date(dateEnd);
        endDate.setHours(23, 59, 59);
        filtered = filtered.filter(log => {
            if (!log.waktu) return false;
            const parts = log.waktu.split(' ');
            const dateParts = parts[0].split('/');
            const logDate = new Date(`${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`);
            return logDate <= endDate;
        });
    }
    
    filteredData = filtered;
    currentPage = 1;
    updatePagination();
}

// ================= MODIFIED TOTAL KERTAS TERPAKAI (support akun filter) =================
function loadTotalKertasTerpakai(bidang = '') {
    const akun = $('#log-akun-pilih').val();
    currentBidangFilterKertas = bidang;
    
    // Update info bidang/akun yang difilter
    if (akun) {
        $('#bidang-filter-info').show();
        $('#bidang-filter-nama').html(`Akun: ${escapeHtml(akun)} ${bidang ? `(Bidang: ${bidang})` : ''}`);
    } else if (bidang && bidang !== '') {
        $('#bidang-filter-info').show();
        $('#bidang-filter-nama').text(bidang);
    } else {
        $('#bidang-filter-info').hide();
    }
    
    // Jika ada filter akun, gunakan endpoint khusus
    if (akun) {
        loadAkunStats(akun);
        return;
    }
    
    // Load berdasarkan bidang
    const periods = ['hari', 'minggu', 'bulan', 'tahun'];
    
    periods.forEach(period => {
        $.ajax({
            url: '<?= base_url('IDE/get_total_kertas_terpakai') ?>',
            type: 'GET',
            data: { bidang: bidang, periode: period },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    let elementId = '';
                    switch(period) {
                        case 'hari': elementId = 'total-kertas-hari'; break;
                        case 'minggu': elementId = 'total-kertas-minggu'; break;
                        case 'bulan': elementId = 'total-kertas-bulan'; break;
                        case 'tahun': elementId = 'total-kertas-tahun'; break;
                    }
                    $('#' + elementId).text(formatNumberRibuan(response.total_kertas));
                }
            },
            error: function() {
                console.error('Error loading kertas untuk periode:', period);
            }
        });
    });
    
    // Load total keseluruhan
    $.ajax({
        url: '<?= base_url('IDE/get_total_kertas_terpakai') ?>',
        type: 'GET',
        data: { bidang: bidang },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#total-kertas-semua').text(formatNumberRibuan(response.total_kertas));
            }
        }
    });
}

// ================= FILTER BY AKUN (klik username) =================
function filterByAkun(username) {
    // Set dropdown akun ke username yang dipilih
    $('#log-akun-pilih').val(username);
    currentAkunFilter = username;
    
    // Reset filter bidang
    $('#log-bidang-pilih').val('');
    currentBidangFilter = '';
    
    // Load log untuk akun tersebut
    loadLogAktivitas();
    
    // Update tampilan
    Swal.fire({
        icon: 'info',
        title: 'Filter Akun',
        text: `Menampilkan aktivitas untuk akun: ${username}`,
        timer: 1500,
        showConfirmButton: false
    });
}

// ================= UPDATE PAGINATION (perbaikan) =================
function updatePagination() {
    if (!filteredData || filteredData.length === 0) {
        $('#log-pagination').empty();
        $('#log-info-text').text('Menampilkan 0 dari 0 data');
        return;
    }
    
    const totalItems = filteredData.length;
    const totalPages = Math.ceil(totalItems / perPage);
    const startIndex = (currentPage - 1) * perPage;
    const endIndex = Math.min(startIndex + perPage, totalItems);
    const currentData = filteredData.slice(startIndex, endIndex);
    
    $('#log-info-text').text(`Menampilkan ${startIndex + 1} - ${endIndex} dari ${totalItems} data`);
    
    let paginationHtml = '';
    
    paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="goToPage(${currentPage - 1}); return false;">
            <i class="bi bi-chevron-left"></i>
        </a>
    </li>`;
    
    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(totalPages, startPage + 4);
    
    if (endPage - startPage < 4 && startPage > 1) {
        startPage = Math.max(1, endPage - 4);
    }
    
    if (startPage > 1) {
        paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(1); return false;">1</a></li>`;
        if (startPage > 2) paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }
    
    for (let i = startPage; i <= endPage; i++) {
        paginationHtml += `<li class="page-item ${currentPage === i ? 'active' : ''}">
            <a class="page-link" href="#" onclick="goToPage(${i}); return false;">${i}</a>
        </li>`;
    }
    
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(${totalPages}); return false;">${totalPages}</a></li>`;
    }
    
    paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="goToPage(${currentPage + 1}); return false;">
            <i class="bi bi-chevron-right"></i>
        </a>
    </li>`;
    
    $('#log-pagination').html(paginationHtml);
    renderLogTable(currentData);
}

// ================= INISIALISASI ULANG =================
$(document).ready(function() {
    // Load akun default saat halaman dimuat
    loadAkunByBidang('');
    
    // Event listener untuk filter akun
    $('#log-akun-pilih').on('change', function() {
        loadLogAktivitas();
        loadTotalKertasTerpakai($('#log-bidang-pilih').val());
    });
});

// ================= MODIFIED FILTER LOG BY DATE =================
function filterLogByDate() {
    applyFiltersAndPagination();
}

// ================= MODIFIED RENDER LOG TABLE =================
function renderLogTable(logs) {
    const tbody = document.getElementById('log-tbody');
    
    if (!logs || logs.length === 0) {
        // ========== TAMBAHKAN: PESAN LEBIH INFORMATIF ==========
        let emptyIcon = '📭';
        let emptyMessage = '';
        
        if (currentAkunFilter) {
            emptyIcon = '👤';
            emptyMessage = `Belum ada aktivitas tercatat untuk akun <strong>${escapeHtml(currentAkunFilter)}</strong>`;
        } else if (currentBidangFilter) {
            emptyIcon = '📂';
            emptyMessage = `Belum ada aktivitas tercatat untuk bidang <strong>${escapeHtml(currentBidangFilter)}</strong>`;
        } else {
            emptyMessage = 'Belum ada aktivitas tercatat di sistem';
        }
        
        tbody.innerHTML = `
            <tr><td colspan="7" class="empty-state-table" style="padding: 60px 20px;">
                <div class="empty-state-icon" style="font-size: 64px; margin-bottom: 20px; opacity: 0.5;">${emptyIcon}</div>
                <div class="empty-state-title" style="font-size: 18px; font-weight: 600; color: var(--text-1); margin-bottom: 8px;">Data Tidak Tersedia</div>
                <div class="empty-state-message" style="font-size: 13px; color: var(--text-2); margin-bottom: 5px;">${emptyMessage}</div>
                <div class="empty-state-suggestion" style="font-size: 12px; color: var(--text-3); margin-top: 15px; padding-top: 15px; border-top: 1px solid var(--border); display: inline-block;">
                    <i class="fas fa-lightbulb"></i> Tips: Coba pilih bidang atau akun lain
                </div>
            </div></td>
        `;
        // ========== END TAMBAHKAN ==========
        return;
    }
    
    const getAksiClass = (aksi) => {
        const map = {
            'Upload': 'log-aksi-upload',
            'Print': 'log-aksi-print',
            'Print (via Preview)': 'log-aksi-print',
            'Review': 'log-aksi-review',
            'Login': 'log-aksi-login',
            'Update': 'log-aksi-update',
            'Hapus': 'log-aksi-hapus',
            'Delete': 'log-aksi-hapus'
        };
        return map[aksi] || 'log-aksi-upload';
    };
    
    const getBidangBadge = (bidang) => {
  if (!bidang || bidang === '-') return '<span class="pill" style="background:#e2e8f0; color:#475569;">-</span>';
  
  const warna = {
    'Litbang': '#e0e7ff',
    'Perencanaan': '#dcfce7',
    'Ekonomi': '#fed7aa',
    'Kesra': '#fbcfe8',
    'Sarpras': '#cffafe',
    'Sekretariat': '#e9d5ff'   // ← TAMBAHKAN INI
  };
  const warnaText = {
    'Litbang': '#4338ca',
    'Perencanaan': '#166534',
    'Ekonomi': '#9a3412',
    'Kesra': '#be185d',
    'Sarpras': '#0e7490',
    'Sekretariat': '#6b21a5'   // ← TAMBAHKAN INI (ungu tua)
  };
  
  return `<span class="pill" style="background:${warna[bidang] || '#e2e8f0'}; color:${warnaText[bidang] || '#475569'};">${escapeHtml(bidang)}</span>`;
};
    
    tbody.innerHTML = logs.map((log, index) => {
        const waktu = log.waktu || '-';
        const username = log.username || '-';
        const aksi = log.aksi || '-';
        const modul = log.modul || '-';
        const detail = log.detail || '-';
        const bidang = log.bidang || '-';
        let ip = log.ip_address || '-';
        
        if (ip === '::1') ip = '127.0.0.1';
        const aksiClass = getAksiClass(aksi);
        
        let detailHtml = '';
        if (aksi === 'Print' || aksi === 'Print (via Preview)') {
            const escapedDetail = escapeHtml(detail);
            detailHtml = `<span style="cursor:pointer; color:var(--blue-600); text-decoration:underline; font-weight:500;" 
                              onclick="showPrintRekapFromLog('${escapeHtml(username)}', '${escapedDetail.replace(/'/g, "\\'")}')">
                              ${escapedDetail}
                          </span>`;
        } else {
            detailHtml = escapeHtml(detail);
        }
        
        let aksiDisplay = aksi;
        if (aksi === 'Print (via Preview)') {
            aksiDisplay = 'Print Preview';
        } else if (aksi === 'Print') {
            aksiDisplay = 'Print';
        }
        
        return `
            <tr>
                <td class="waktu-cell">${escapeHtml(waktu)}</td>
                <td class="username-cell">
                    <i class="fas fa-user"></i> ${escapeHtml(username)}
                </td>
                <td>
                    <span class="log-aksi-badge ${aksiClass}">
                        ${escapeHtml(aksiDisplay)}
                    </span>
                </td>
                <td>${getBidangBadge(bidang)}</td>
                <td>${escapeHtml(modul)}</td>
                <td class="detail-cell">${detailHtml}</td>
                <td><code class="ip-address">${escapeHtml(ip)}</code></td>
            </tr>
        `;
    }).join('');
}

// ================= FILTER LOG TABLE =================
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
            if (!log.waktu) return false;
            const parts = log.waktu.split(' ');
            const dateParts = parts[0].split('/');
            const logDate = new Date(`${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`);
            return logDate >= startDate;
        });
    }
    
    if (dateEnd) {
        const endDate = new Date(dateEnd);
        endDate.setHours(23, 59, 59);
        filtered = filtered.filter(log => {
            if (!log.waktu) return false;
            const parts = log.waktu.split(' ');
            const dateParts = parts[0].split('/');
            const logDate = new Date(`${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`);
            return logDate <= endDate;
        });
    }
    
    renderLogTable(filtered);
    console.log('Filtered logs:', filtered.length);
}

// ================= LOAD LOG BERDASARKAN BIDANG =================
function loadLogByBidang() {
    loadLogAktivitas();  // Reload dengan parameter bidang baru
}

// ================= FILTER LOG BY DATE =================
function filterLogByDate() {
    filterLogTable();
}

// ================= REFRESH LOG DATA =================
function refreshLogData() {
    $('#log-date-start').val('');
    $('#log-date-end').val('');
    $('#log-aksi-filter').val('');
    $('#log-search').val('');
    
    // Reset filter bidang ke default
    if ($('#log-bidang-pilih').val() !== '') {
        $('#log-bidang-pilih').val('');
        loadLogAktivitas();
    } else {
        loadLogAktivitas();
    }
}

// ==================== REKAP PRINT DARI LOG AKTIVITAS ====================

// ==================== REKAP PRINT DARI LOG AKTIVITAS ====================
function showPrintRekapFromLog(username, detailLog) {
    $('#modalPrintRekap').css('display', 'flex');
    $('#modalPrintRekapTitle').html(` Rekap Print - ${escapeHtml(username)}`);
    
    $('#modalPrintRekapBody').html(`
        <div style="text-align:center;padding:40px;">
            <div class="modern-spinner"></div>
            <p>Memuat data rekap untuk user <strong>${escapeHtml(username)}</strong>...</p>
        </div>
    `);
    
    $.ajax({
        url: '<?= base_url('IDE/get_user_print_rekap') ?>',
        type: 'POST',
        data: { username: username },
        dataType: 'json',
        timeout: 10000,
        success: function(response) {
            if (response.status === 'success') {
                // ========== TAMBAHKAN: CEK DATA KOSONG ==========
                if (response.total_lembar === 0 && response.print_details.length === 0) {
                    $('#modalPrintRekapBody').html(`
                        <div style="text-align:center;padding:60px 20px;">
                            <div style="font-size: 64px; margin-bottom: 20px; opacity: 0.5;">🖨️</div>
                            <div style="font-size: 18px; font-weight: 600; color: var(--text-1); margin-bottom: 8px;">Tidak Ada Data Print</div>
                            <div style="font-size: 13px; color: var(--text-2); margin-bottom: 15px;">
                                Akun <strong>${escapeHtml(username)}</strong> belum pernah melakukan aktivitas print
                            </div>
                            <div style="background: #f0f4ff; border-radius: 12px; padding: 15px 20px; margin-top: 20px; text-align: left; max-width: 300px; margin: 20px auto 0;">
                                <p style="margin: 0 0 5px 0;"><i class="fas fa-info-circle"></i> Informasi Akun:</p>
                                <p style="margin: 0; font-size: 12px;">Username: <strong>${escapeHtml(username)}</strong></p>
                                <p style="margin: 5px 0 0 0; font-size: 12px;">Status: Belum pernah melakukan print</p>
                            </div>
                        </div>
                    `);
                } else {
                    renderPrintRekapFromLog(response);
                }
                // ========== END TAMBAHKAN ==========
            } else {
                $('#modalPrintRekapBody').html(`
                    <div style="text-align:center;padding:40px;color:red;">
                        <p>❌ Gagal memuat data</p>
                        <p>${response.message || 'Silakan coba lagi'}</p>
                    </div>
                `);
            }
        },
        error: function(xhr, status, error) {
            $('#modalPrintRekapBody').html(`
                <div style="text-align:center;padding:40px;color:red;">
                    <p>❌ Error: ${error}</p>
                    <p>Silakan refresh halaman dan coba lagi</p>
                </div>
            `);
        }
    });
}

function renderPrintRekapFromLog(data) {
    let html = '';
    
    html += `
        <div style="margin-bottom: 20px;">
            <span class="rekap-badge-user">👤 ${escapeHtml(data.username)}</span>
            <span style="margin-left: 10px; font-size: 11px; color: var(--text-3);">
                 Total print: ${data.total_print} kali | Total lembar: ${formatNumber(data.total_lembar)}
            </span>
        </div>
    `;
    
    // ========== TAMBAHKAN: CEK NILAI 0 UNTUK TAMPILAN LEBIH BAIK ==========
    const getStatusText = (sukses, lembar) => {
        if (lembar === 0) return 'Tidak ada print';
        if (sukses > 0) return `✓ ${sukses} berhasil`;
        return 'Semua gagal';
    };
    // ========== END TAMBAHKAN ==========
    
    html += `
        <div class="user-rekap-summary" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px;">
            <div class="user-rekap-item" style="background: #e8f0fe; border-radius: 12px; padding: 12px;">
                <div class="user-rekap-label"> HARI INI</div>
                <div class="user-rekap-value" style="font-size: 24px;">${formatNumber(data.hari.lembar)}</div>
                <div class="user-rekap-unit">kertas</div>
                <!-- ========== TAMBAHKAN: TEXT DINAMIS ========== -->
                <div style="font-size: 10px; color: ${data.hari.lembar > 0 ? 'green' : '#999'}; margin-top: 5px;">
                    ${getStatusText(data.hari.sukses, data.hari.lembar)}
                </div>
                <!-- ========== END TAMBAHKAN ========== -->
            </div>
            <div class="user-rekap-item" style="background: #e6f7e6; border-radius: 12px; padding: 12px;">
                <div class="user-rekap-label"> 7 HARI</div>
                <div class="user-rekap-value" style="font-size: 24px;">${formatNumber(data.minggu.lembar)}</div>
                <div class="user-rekap-unit">kertas</div>
                <div style="font-size: 10px; color: ${data.minggu.lembar > 0 ? 'green' : '#999'}; margin-top: 5px;">
                    ${getStatusText(data.minggu.sukses, data.minggu.lembar)}
                </div>
            </div>
            <div class="user-rekap-item" style="background: #fef3e6; border-radius: 12px; padding: 12px;">
                <div class="user-rekap-label"> 30 HARI</div>
                <div class="user-rekap-value" style="font-size: 24px;">${formatNumber(data.bulan.lembar)}</div>
                <div class="user-rekap-unit">kertas</div>
                <div style="font-size: 10px; color: ${data.bulan.lembar > 0 ? 'green' : '#999'}; margin-top: 5px;">
                    ${getStatusText(data.bulan.sukses, data.bulan.lembar)}
                </div>
            </div>
            <div class="user-rekap-item" style="background: #f0e6fe; border-radius: 12px; padding: 12px;">
                <div class="user-rekap-label"> TAHUN ${new Date().getFullYear()}</div>
                <div class="user-rekap-value" style="font-size: 24px;">${formatNumber(data.tahun.lembar)}</div>
                <div class="user-rekap-unit">kertas</div>
                <div style="font-size: 10px; color: ${data.tahun.lembar > 0 ? 'green' : '#999'}; margin-top: 5px;">
                    ${getStatusText(data.tahun.sukses, data.tahun.lembar)}
                </div>
            </div>
        </div>
    `;
    
    
    // Tabel Rincian Print (dari smb_print_log)
    if (data.print_details && data.print_details.length > 0) {
        html += `
            <h4 style="margin: 20px 0 10px 0;"> Rincian Print Terbaru</h4>
            <div style="overflow-x: auto;">
                <table class="user-detail-table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Nama Dokumen</th>
                            <th>Jumlah Lembar</th>
                            <th>Printer</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        data.print_details.forEach(print => {
            let statusBadge = print.status === 'success' 
                ? '<span style="background:#dcfce7; color:#166534; padding:4px 10px; border-radius:20px; font-size:11px;">✓ Berhasil</span>'
                : '<span style="background:#fee2e2; color:#991b1b; padding:4px 10px; border-radius:20px; font-size:11px;">✗ Gagal</span>';
            
            html += `
                <tr>
                    <td style="white-space: nowrap;">${escapeHtml(print.waktu)}</td>
                    <td style="max-width: 250px; word-break: break-word;"><strong>${escapeHtml(print.nama_dokumen)}</strong></td>
                    <td style="text-align: center;">${print.jumlah_kertas} lembar</td>
                    <td>${escapeHtml(print.nama_printer)}</td>
                    <td style="text-align: center;">${statusBadge}</td>
                </tr>
            `;
        });
        
        html += `</tbody></table></div>`;
    }
    
    // Jika tidak ada data
    if (data.total_lembar === 0) {
        html += `
            <div style="text-align:center;padding:40px;">
                <p>📭 User <strong>${escapeHtml(data.username)}</strong> belum melakukan aktivitas print</p>
                <p style="font-size:12px; color:var(--text-3);">Belum ada riwayat print untuk user ini</p>
            </div>
        `;
    }
    
    $('#modalPrintRekapBody').html(html);
}

function closeModalPrintRekap() {
    $('#modalPrintRekap').css('display', 'none');
    $('#modalPrintRekapBody').html('<div style="text-align:center;padding:40px;"><div class="modern-spinner"></div><p>Memuat data...</p></div>');
}

// ================= EXPORT LOG TO PDF (SEMUA HALAMAN DENGAN PAGINATION) =================
async function exportLogToPDF() {
    // Tampilkan loading
    Swal.fire({
        title: 'Membuat PDF...',
        text: 'Mohon tunggu, sedang memproses semua data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    try {
        // 1. Ambil SEMUA data log (bukan hanya halaman aktif)
        // Gunakan data asli yang sudah difilter (filteredData), bukan hanya current page
        const allFilteredData = filteredData; // Ini sudah berisi semua data setelah filter
        
        if (!allFilteredData || allFilteredData.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Tidak Ada Data',
                text: 'Tidak ada data log untuk diexport'
            });
            return;
        }
        
        // 2. Ambil data total kertas terpakai (sesuai filter yang dipilih)
        const bidangFilter = $('#log-bidang-pilih').val();
        const akunFilter = $('#log-akun-pilih').val();
        
        // Panggil API untuk mendapatkan total kertas
        let kertasData = {
            hari: 0,
            minggu: 0,
            bulan: 0,
            tahun: 0,
            total: 0
        };
        
        try {
            if (akunFilter) {
                // Jika filter akun aktif, ambil data per akun
                const response = await $.ajax({
                    url: '<?= base_url('IDE/get_kertas_rekap_by_akun') ?>',
                    type: 'GET',
                    data: { username: akunFilter },
                    dataType: 'json',
                    async: false
                });
                if (response.status === 'success') {
                    kertasData.total = response.total_kertas;
                }
                
                // Ambil per periode
                const periods = ['hari', 'minggu', 'bulan', 'tahun'];
                for (const period of periods) {
                    const resp = await $.ajax({
                        url: '<?= base_url('IDE/get_kertas_rekap_by_akun') ?>',
                        type: 'GET',
                        data: { username: akunFilter, periode: period },
                        dataType: 'json',
                        async: false
                    });
                    if (resp.status === 'success') {
                        kertasData[period] = resp.total_kertas;
                    }
                }
            } else {
                // Jika filter bidang atau semua data
                const response = await $.ajax({
                    url: '<?= base_url('IDE/get_total_kertas_terpakai') ?>',
                    type: 'GET',
                    data: { bidang: bidangFilter },
                    dataType: 'json',
                    async: false
                });
                if (response.status === 'success') {
                    kertasData.total = response.total_kertas;
                }
                
                // Ambil per periode
                const periods = ['hari', 'minggu', 'bulan', 'tahun'];
                for (const period of periods) {
                    const resp = await $.ajax({
                        url: '<?= base_url('IDE/get_total_kertas_terpakai') ?>',
                        type: 'GET',
                        data: { bidang: bidangFilter, periode: period },
                        dataType: 'json',
                        async: false
                    });
                    if (resp.status === 'success') {
                        kertasData[period] = resp.total_kertas;
                    }
                }
            }
        } catch(e) {
            console.error('Error fetching kertas data:', e);
        }
        
        // 3. Siapkan info filter untuk ditampilkan di PDF
        const now = new Date();
        const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const dateStr = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
        const timeStr = `${now.getHours().toString().padStart(2,'0')}:${now.getMinutes().toString().padStart(2,'0')}:${now.getSeconds().toString().padStart(2,'0')}`;
        
        // Filter info yang diterapkan
        const startDate = $('#log-date-start').val();
        const endDate = $('#log-date-end').val();
        const aksiFilterVal = $('#log-aksi-filter').val();
        const searchText = $('#log-search').val();
        
        let filterLines = [];
        if (akunFilter) filterLines.push(`Akun: ${akunFilter}`);
        else if (bidangFilter) filterLines.push(`Bidang: ${bidangFilter}`);
        else filterLines.push(`Semua Bidang`);
        
        if (startDate || endDate) filterLines.push(`Periode: ${startDate || 'Awal'} s.d. ${endDate || 'Sekarang'}`);
        if (aksiFilterVal) filterLines.push(`Aksi: ${aksiFilterVal}`);
        if (searchText) filterLines.push(`Pencarian: ${searchText}`);
        
        // 4. Konversi data log ke format yang mudah digunakan
        const logData = [];
        for (const log of allFilteredData) {
            logData.push({
                waktu: log.waktu || '-',
                user: log.username || '-',
                aksi: log.aksi || '-',
                bidang: log.bidang || '-',
                modul: log.modul || '-',
                detail: log.detail || '-',
                ip: log.ip_address || '-'
            });
        }
        
        // 5. Hitung jumlah halaman yang dibutuhkan (misal 25 baris per halaman)
        const ROWS_PER_PAGE = 25;
        const totalPages = Math.ceil(logData.length / ROWS_PER_PAGE);
        
        // 6. Buat HTML untuk SEMUA HALAMAN PDF
        const logoUrl = '<?= base_url('assets/img/bappeda.png') ?>';
        
        // Header untuk setiap halaman (akan diulang)
        const getPageHeader = (pageNum) => `
            <div style="page-break-before: ${pageNum === 1 ? 'avoid' : 'always'};">
            <div class="pdf-header">
                <div style="display: flex; align-items: center; justify-content: center; gap: 15px; margin-bottom: 10px; flex-wrap: wrap;">
                    <img src="${logoUrl}" alt="Logo Bappeda Banyuwangi" style="height: 50px; width: auto; object-fit: contain;">
                    <div style="text-align: center;">
                        <h2 style="margin: 0;">Smart Office Management</h2>
                        <h3 style="margin: 5px 0 0 0;">BAPPEDA KABUPATEN BANYUWANGI</h3>
                    </div>
                </div>
                <p>Laporan Log Aktivitas Sistem</p>
            </div>
            
            <div class="pdf-date">
                <strong>Tanggal Export:</strong> ${dateStr} ${timeStr}<br>
                <strong>User:</strong> ${escapeHtml('<?= $display_name ?>')} (${escapeHtml('<?= $role_name ?>')})<br>
                <strong>Total Data:</strong> ${logData.length} aktivitas<br>
                <strong>Halaman:</strong> ${pageNum} dari ${totalPages}
            </div>
        `;
        
        // Header statistik (hanya di halaman pertama)
        const statsSection = `
            <div class="pdf-filter-info">
                <strong><i class="fas fa-filter"></i> Filter yang Diterapkan:</strong>
                ${filterLines.map(line => `<p>📌 ${line}</p>`).join('')}
            </div>
            
            <div class="pdf-stats-grid">
                <div class="pdf-stat-card">
                    <div class="pdf-stat-label">HARI INI</div>
                    <div class="pdf-stat-value">${formatNumberRibuan(kertasData.hari)}</div>
                    <div class="pdf-stat-unit">lembar kertas</div>
                </div>
                <div class="pdf-stat-card">
                    <div class="pdf-stat-label">7 HARI</div>
                    <div class="pdf-stat-value">${formatNumberRibuan(kertasData.minggu)}</div>
                    <div class="pdf-stat-unit">lembar kertas</div>
                </div>
                <div class="pdf-stat-card">
                    <div class="pdf-stat-label">30 HARI</div>
                    <div class="pdf-stat-value">${formatNumberRibuan(kertasData.bulan)}</div>
                    <div class="pdf-stat-unit">lembar kertas</div>
                </div>
                <div class="pdf-stat-card">
                    <div class="pdf-stat-label">TAHUN INI</div>
                    <div class="pdf-stat-value">${formatNumberRibuan(kertasData.tahun)}</div>
                    <div class="pdf-stat-unit">lembar kertas</div>
                </div>
            </div>
            
            <div class="pdf-total-card">
                <span class="pdf-total-label"><i class="bi bi-printer"></i> TOTAL KESELURUHAN</span>
                <span>
                    <span class="pdf-total-value">${formatNumberRibuan(kertasData.total)}</span>
                    <span class="pdf-total-unit">lembar</span>
                </span>
            </div>
        `;
        
        // Footer untuk setiap halaman
        const getPageFooter = (pageNum) => `
            <div class="pdf-footer">
                <p>Dokumen ini dibuat secara otomatis oleh sistem Smart Office Management</p>
                <p>Halaman ${pageNum} dari ${totalPages} | Total Data: ${logData.length} aktivitas</p>
            </div>
            </div>
        `;
        
        // Tabel header
        const tableHeader = `
            <table class="pdf-table" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="width:12%;">Waktu</th>
                        <th style="width:10%;">User</th>
                        <th style="width:8%;">Aksi</th>
                        <th style="width:10%;">Bidang</th>
                        <th style="width:10%;">Modul</th>
                        <th style="width:35%;">Detail</th>
                        <th style="width:15%;">IP Address</th>
                    </tr>
                </thead>
                <tbody>
        `;
        
        const tableFooter = `
                </tbody>
            </table>
        `;
        
        // 7. Bangun HTML untuk semua halaman
        let htmlContent = '';
        
        for (let page = 1; page <= totalPages; page++) {
            const startIndex = (page - 1) * ROWS_PER_PAGE;
            const endIndex = Math.min(startIndex + ROWS_PER_PAGE, logData.length);
            const pageData = logData.slice(startIndex, endIndex);
            
            // Tambahkan header halaman
            htmlContent += getPageHeader(page);
            
            // Tambahkan statistik hanya di halaman pertama
            if (page === 1) {
                htmlContent += statsSection;
            }
            
            // Tambahkan tabel
            htmlContent += tableHeader;
            
            // Isi data
            for (const item of pageData) {
                // Potong detail jika terlalu panjang
                let detailText = item.detail;
                if (detailText && detailText.length > 150) {
                    detailText = detailText.substring(0, 150) + '...';
                }
                
                htmlContent += `
                    <tr>
                        <td>${escapeHtml(item.waktu)}</td>
                        <td>${escapeHtml(item.user)}</td>
                        <td>${escapeHtml(item.aksi)}</td>
                        <td>${escapeHtml(item.bidang)}</td>
                        <td>${escapeHtml(item.modul)}</td>
                        <td>${escapeHtml(detailText)}</td>
                        <td>${escapeHtml(item.ip)}</td>
                    </tr>
                `;
            }
            
            // Tambahkan footer tabel dan footer halaman
            htmlContent += tableFooter;
            htmlContent += getPageFooter(page);
        }
        
        // 8. Bungkus dengan wrapper utama
        const finalHtml = `
            <div class="pdf-export-wrapper" style="font-family: 'Plus Jakarta Sans', 'DM Sans', sans-serif; padding: 20px; background: white;">
                ${htmlContent}
            </div>
        `;
        
        // 9. Generate PDF
        const element = document.createElement('div');
        element.innerHTML = finalHtml;
        document.body.appendChild(element);
        
        const opt = {
            margin: [0.5, 0.5, 0.5, 0.5],
            filename: `Log_Aktivitas_SMB_${now.getFullYear()}-${(now.getMonth()+1).toString().padStart(2,'0')}-${now.getDate().toString().padStart(2,'0')}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, letterRendering: true, useCORS: true },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
        };
        
        await html2pdf().set(opt).from(element).save();
        document.body.removeChild(element);
        
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: `File PDF dengan ${totalPages} halaman telah berhasil di-download`,
            timer: 2000,
            showConfirmButton: false
        });
        
    } catch(error) {
        console.error('PDF Export error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat membuat PDF: ' + error.message
        });
    }
}
function addPrintViaPreviewFilter() {
    const filterSelect = $('#log-aksi-filter');
    if (filterSelect.length && !filterSelect.find('option[value="Print (via Preview)"]').length) {
        filterSelect.append('<option value="Print (via Preview)"> Print (via Preview)</option>');
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
  
  // ========== 8. DISPLAY DATE & TIME ==========
  const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                  'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
  const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  const now = new Date();
  const dateStr = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
  
  const greetingDate = document.getElementById('greeting-date');
  const heroDateText = document.getElementById('hero-date-text');
  
  if (greetingDate) greetingDate.textContent = dateStr;
  if (heroDateText) heroDateText.textContent = dateStr;
  
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

// ========== INITIALIZE TOTAL KERTAS TERPAKAI ==========
// Load total kertas saat panel log pertama kali dibuka
const logPanelObserver = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        const activePanel = document.querySelector('.panel.active');
        if (activePanel && activePanel.id === 'panel-log') {
            console.log('Panel log aktif, load total kertas...');
            loadTotalKertasTerpakai($('#log-bidang-pilih').val());
            logPanelObserver.disconnect(); // Hentikan observer setelah pertama kali
        }
    });
});

logPanelObserver.observe(document.body, {
    attributes: true,
    attributeFilter: ['class'],
    subtree: true
});

// Load total kertas jika panel log sudah aktif saat halaman dimuat
if (document.querySelector('#panel-log.active')) {
    loadTotalKertasTerpakai($('#log-bidang-pilih').val());
}

// Event listener untuk perubahan filter bidang
$('#log-bidang-pilih').on('change', function() {
    loadTotalKertasTerpakai($(this).val());
});

// ==================== DATA INDIKATOR PANEL (FINAL - GENERATE OTOMATIS) ====================

// Definisikan baseUrl
const baseUrlData = '<?= base_url() ?>';

// Variabel global
let allApiConfigs = [];
let currentSelectedKode = null;
let currentDataSeries = [];
let currentDataIndikator = null;
let selectedChartInstance = null;

// ==================== HELPERS ====================
function formatNumberRibuan(num) {
    if (num === undefined || num === null || isNaN(num)) return '0';
    return parseFloat(num).toLocaleString('id-ID');
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ==================== LOAD ALL DATA CARDS ====================
function loadAllDataCards() {
    console.log('Refresh data cards...');
    loadApiConfigs();
}

function navigateToData() {
    showPanel('data');
    loadApiConfigs();
    
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    document.querySelectorAll('.sub-item').forEach(s => s.classList.remove('active'));
    const dataMenuItem = document.querySelector('.sub-item[onclick*="navigateToData"]');
    if (dataMenuItem) dataMenuItem.classList.add('active');
}

// ==================== LOAD KONFIGURASI API DARI DATABASE ====================
function loadApiConfigs() {
    console.log('Loading API configs from database...');
    
    $('#data-cards-container').html(`
        <div class="col-12 text-center py-5">
            <div class="modern-spinner"></div>
            <p>Memuat konfigurasi API...</p>
        </div>
    `);
    
    $.ajax({
        url: baseUrlData + 'IDE/get_api_configs',
        type: 'GET',
        dataType: 'json',
        timeout: 10000,
        success: function(response) {
            if (response.status === 'success') {
                allApiConfigs = response.data;
                renderDataCards();
                console.log('API configs loaded:', allApiConfigs.length);
            } else {
                $('#data-cards-container').html(`
                    <div class="col-12 text-center py-5">
                        <div style="font-size:48px;">⚠️</div>
                        <p>Gagal memuat konfigurasi API: ${response.message || 'Unknown error'}</p>
                        <button class="btn btn-primary mt-3" onclick="loadApiConfigs()">
                            <i class="fas fa-sync-alt"></i> Coba Lagi
                        </button>
                    </div>
                `);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading API configs:', error);
            $('#data-cards-container').html(`
                <div class="col-12 text-center py-5">
                    <div style="font-size:48px;">❌</div>
                    <p>Gagal menghubungi server: ${error}</p>
                    <button class="btn btn-primary mt-3" onclick="loadApiConfigs()">
                        <i class="fas fa-sync-alt"></i> Coba Lagi
                    </button>
                </div>
            `);
        }
    });
}

// ==================== RENDER CARD DATA ====================
function renderDataCards() {
    if (!allApiConfigs || allApiConfigs.length === 0) {
        $('#data-cards-container').html(`
            <div class="col-12 text-center py-5">
                <div style="font-size:64px; margin-bottom:20px;">📊</div>
                <h5>Belum Ada Data Indikator</h5>
                <p class="text-muted">Klik tombol "Tambah Data API" untuk menambahkan konfigurasi API</p>
                <button class="btn btn-primary mt-3" onclick="openApiModal()">
                    <i class="fas fa-plus"></i> Tambah Data API
                </button>
            </div>
        `);
        return;
    }
    
    let html = '<div class="row g-4">';
    allApiConfigs.forEach(config => {
        html += `
            <div class="col-md-4 col-lg-3">
                <div class="card data-card" data-kode="${config.kode_api}" style="cursor:pointer; transition:all 0.2s; height:100%;">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-chart-line fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="card-title text-center">${escapeHtml(config.nama_data)}</h5>
                        <p class="card-text text-center text-muted small">ID: ${escapeHtml(config.indikator_id || '-')}</p>
                        <div class="d-flex justify-content-end gap-2 mt-3 border-top pt-2">
                            <button class="btn btn-sm btn-outline-primary" onclick="event.stopPropagation(); editApiConfig(${config.id_api})">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-outline-danger" onclick="event.stopPropagation(); deleteApiConfig(${config.id_api}, '${escapeHtml(config.nama_data)}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
    html += '</div>';
    $('#data-cards-container').html(html);
    
    // Pasang event listener untuk card
    $('.data-card').off('click').on('click', function() {
        const kode = $(this).data('kode');
        if (kode) selectDataByKode(kode);
    });
}

// ==================== FETCH DATA LANGSUNG DARI API SATU DATA ====================
async function fetchDataFromSatuDataAPI(kode) {
    try {
        // Cari konfigurasi dari database
        const config = allApiConfigs.find(c => c.kode_api === kode);
        
        if (!config) {
            throw new Error(`Konfigurasi untuk kode "${kode}" tidak ditemukan`);
        }
        
        // Ambil indikator_id dari database
        const indikatorId = config.indikator_id;
        
        if (!indikatorId) {
            throw new Error(`ID Indikator untuk "${config.nama_data}" belum diisi`);
        }
        
        // ========== UBANI URL INI MENJADI ==========
        // Gunakan CORS proxy untuk menghindari blokiran
        const originalUrl = `https://satudata.banyuwangikab.go.id/api/indikator?id=${indikatorId}&api-key=data_bwi2023`;
        const url = `https://cors-anywhere.herokuapp.com/${originalUrl}`;
        // ========== SAMPAI SINI ==========
        
        console.log(`Fetching ${config.nama_data} (ID: ${indikatorId}) via CORS proxy:`, url);
        
        const response = await fetch(url, {
            method: 'GET',
            headers: { 
                'Accept': 'application/json',
                'Origin': window.location.origin
            }
        });
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        const data = await response.json();
        
        if (!data?.result || data.result.status !== 200) {
            throw new Error('Struktur response API tidak valid');
        }
        
        // Parse series data
        const series = [];
        if (data.result.data && data.result.data[0]) {
            for (const [tahun, nilai] of Object.entries(data.result.data[0])) {
                if (nilai !== '' && nilai !== null && !isNaN(parseFloat(nilai))) {
                    series.push({
                        tahun: tahun,
                        nilai: parseFloat(nilai)
                    });
                }
            }
            series.sort((a, b) => parseInt(a.tahun) - parseInt(b.tahun));
        }
        
        if (series.length === 0) {
            throw new Error('Tidak ada data series yang ditemukan');
        }
        
        return {
            status: 'success',
            data: {
                indikator: data.result.Indikator || config.nama_data,
                produsen: data.result['Produsen Data'] || '-',
                urusan: data.result.Urusan || '-',
                satuan: data.result.Satuan || '-',
                series: series,
                indikator_id: indikatorId
            }
        };
        
    } catch (error) {
        console.error(`Error fetching ${kode}:`, error);
        return {
            status: 'error',
            message: error.message
        };
    }
}

// ==================== FUNGSI SELECT DATA (VIA BACKEND) ====================
async function selectDataByKode(kode) {
    console.log('Selecting data by kode:', kode);
    currentSelectedKode = kode;
    
    // Validasi elemen penting
    const container = document.getElementById('selected-data-container');
    const indikatorEl = document.getElementById('selected-indikator');
    const produsenEl = document.getElementById('selected-produsen');
    const urusanEl = document.getElementById('selected-urusan');
    const satuanEl = document.getElementById('selected-satuan');
    const tbodyEl = document.getElementById('selected-data-tbody');
    
    if (!container || !indikatorEl || !produsenEl || !urusanEl || !satuanEl || !tbodyEl) {
        console.error('Element penting tidak ditemukan!');
        Swal.fire('Error', 'Elemen halaman tidak lengkap, refresh halaman', 'error');
        return;
    }
    
    // Tampilkan container detail
    container.style.display = 'block';
    
    // Tampilkan loading
    indikatorEl.textContent = 'Memuat dari server...';
    produsenEl.textContent = '-';
    urusanEl.textContent = '-';
    satuanEl.textContent = '-';
    tbodyEl.innerHTML = `
        <tr>
            <td colspan="3" class="text-center py-5">
                <div class="modern-spinner"></div>
                <p>Mengambil data dari Portal Satu Data...</p>
             </div>
        </tr>
    `;
    
    // Panggil API via backend
    $.ajax({
        url: baseUrlData + 'IDE/load_data_from_api',
        type: 'GET',
        data: { kode: kode },
        dataType: 'json',
        timeout: 30000,
        success: function(response) {
            console.log('API Response:', response);
            
            if (response.status === 'success' && response.data && response.data.series && response.data.series.length > 0) {
                currentDataIndikator = response.data;
                currentDataSeries = response.data.series;
                
                // Update header
                $('#selected-indikator').text(currentDataIndikator.indikator || '-');
                $('#selected-produsen').text(currentDataIndikator.produsen || '-');
                $('#selected-urusan').text(currentDataIndikator.urusan || '-');
                $('#selected-satuan').text(currentDataIndikator.satuan || '-');
                
                // Update statistik
                updateSelectedStats();
                
                // Render tabel
                renderSelectedDataTable();
                
                // Render chart
                renderSelectedChart();
                
                // Load riwayat analisis
                if (currentDataIndikator.indikator) {
                    loadRiwayatAnalisisByIndikator(currentDataIndikator.indikator);
                }
                
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Dimuat',
                    text: `${currentDataSeries.length} tahun data - Satuan: ${currentDataIndikator.satuan || '-'}`,
                    timer: 2000,
                    showConfirmButton: false
                });
                
                container.scrollIntoView({ behavior: 'smooth', block: 'start' });
                
            } else {
                tbodyEl.innerHTML = `
                    <tr>
                        <td colspan="3" class="text-center py-5" style="color:red;">
                            <div style="font-size:48px; margin-bottom:15px;">⚠️</div>
                            <p>❌ ${response.message || 'Gagal memuat data dari API'}</p>
                            <div class="mt-3">
                                <button class="btn btn-primary btn-sm" onclick="selectDataByKode('${kode}')">
                                    <i class="fas fa-sync-alt"></i> Coba Lagi
                                </button>
                            </div>
                         </div>
                    </table>
                `;
                
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memuat Data',
                    text: response.message || 'Tidak dapat mengambil data dari API'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            tbodyEl.innerHTML = `
                <tr>
                    <td colspan="3" class="text-center py-5" style="color:red;">
                        <p>❌ Error: ${error}</p>
                        <button class="btn btn-sm mt-2" onclick="selectDataByKode('${kode}')">
                            <i class="fas fa-sync-alt"></i> Coba Lagi
                        </button>
                     </div>
                </tr>
            `;
        }
    });
}

function updateSelectedStats() {
    const statsContainer = document.getElementById('selected-stats');
    if (!statsContainer) {
        console.error('Element selected-stats tidak ditemukan');
        return;
    }
    
    if (!currentDataSeries || currentDataSeries.length === 0) {
        statsContainer.innerHTML = `
            <div class="col-12 text-center py-4">
                <p class="text-muted">Tidak ada data untuk ditampilkan</p>
            </div>
        `;
        return;
    }
    
    const values = currentDataSeries.map(d => parseFloat(d.nilai) || 0);
    const maxValue = Math.max(...values);
    const minValue = Math.min(...values);
    const avgValue = values.reduce((a, b) => a + b, 0) / values.length;
    const maxYear = currentDataSeries.find(d => parseFloat(d.nilai) === maxValue)?.tahun || '-';
    const minYear = currentDataSeries.find(d => parseFloat(d.nilai) === minValue)?.tahun || '-';
    const satuan = currentDataIndikator?.satuan || '';
    
    statsContainer.innerHTML = `
        <div class="stat-card">
            <div class="stat-label">Total Data</div>
            <div class="stat-row">
                <div class="stat-val">${currentDataSeries.length}</div>
                <div class="stat-icon" style="background:#eff4ff;"><svg viewBox="0 0 20 20" fill="#2f52c4"><path d="M3 3h14v14H3z"/></svg></div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend">Tahun tersedia</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Nilai Tertinggi</div>
            <div class="stat-row">
                <div class="stat-val">${formatNumberRibuan(maxValue)}</div>
                <div class="stat-icon" style="background:#fffbeb;"><svg viewBox="0 0 20 20" fill="#d97706"><path d="M10 2l3 5 5 1-4 4 1 5-5-2-5 2 1-5-4-4 5-1 3-5z"/></svg></div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend trend-up">Tahun ${maxYear}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Nilai Terendah</div>
            <div class="stat-row">
                <div class="stat-val">${formatNumberRibuan(minValue)}</div>
                <div class="stat-icon" style="background:#dcfce7;"><svg viewBox="0 0 20 20" fill="#16a34a"><path d="M10 2l3 5 5 1-4 4 1 5-5-2-5 2 1-5-4-4 5-1 3-5z"/></svg></div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend trend-down">Tahun ${minYear}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Rata-rata</div>
            <div class="stat-row">
                <div class="stat-val">${formatNumberRibuan(avgValue)}</div>
                <div class="stat-icon" style="background:#dbeafe;"><svg viewBox="0 0 20 20" fill="#2f52c4"><path d="M10 2v16M4 6l6-4 6 4M4 14l6 4 6-4"/></svg></div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-trend">${satuan}</div>
        </div>
    `;
}

function renderSelectedDataTable() {
    const tbody = document.getElementById('selected-data-tbody');
    if (!tbody) {
        console.error('Element selected-data-tbody tidak ditemukan');
        return;
    }
    
    if (!currentDataSeries || currentDataSeries.length === 0) {
        tbody.innerHTML = `<tr><td colspan="3" class="text-center py-5">Tidak ada数据</div></td>`;
        return;
    }
    
    tbody.innerHTML = currentDataSeries.map((item, index) => {
        let trendHtml = '';
        if (index > 0) {
            const prevValue = parseFloat(currentDataSeries[index - 1].nilai) || 0;
            const currValue = parseFloat(item.nilai) || 0;
            const diff = currValue - prevValue;
            const percent = prevValue !== 0 ? (diff / prevValue * 100).toFixed(1) : 0;
            if (diff > 0) {
                trendHtml = `<span style="color: var(--green);">↑ +${diff.toFixed(2)} (${percent}%)</span>`;
            } else if (diff < 0) {
                trendHtml = `<span style="color: var(--red);">↓ ${diff.toFixed(2)} (${percent}%)</span>`;
            } else {
                trendHtml = `<span style="color: var(--text-3);">→ 0 (0%)</span>`;
            }
        } else {
            trendHtml = `<span style="color: var(--text-3);">-</span>`;
        }
        
        return `
            <tr>
                <td><strong>${item.tahun}</strong></td>
                <td>${formatNumberRibuan(item.nilai)} ${currentDataIndikator?.satuan || ''}</td>
                <td>${trendHtml}</td>
            </tr>
        `;
    }).join('');
}

// ==================== RENDER CHART ====================
function renderSelectedChart() {
    if (!currentDataSeries || currentDataSeries.length === 0) return;
    
    const canvas = document.getElementById('selected-data-chart');
    if (!canvas) {
        console.error('Canvas element not found');
        return;
    }
    
    const ctx = canvas.getContext('2d');
    const chartType = $('#selected-chart-type').val();
    
    if (selectedChartInstance) selectedChartInstance.destroy();
    
    selectedChartInstance = new Chart(ctx, {
        type: chartType,
        data: {
            labels: currentDataSeries.map(d => d.tahun.toString()),
            datasets: [{
                label: currentDataIndikator?.indikator || 'Data Indikator',
                data: currentDataSeries.map(d => parseFloat(d.nilai) || 0),
                backgroundColor: chartType === 'line' ? 'rgba(47,82,196,0.1)' : 'rgba(47,82,196,0.7)',
                borderColor: '#2f52c4',
                borderWidth: 2,
                fill: chartType === 'line',
                tension: 0.3,
                pointBackgroundColor: '#2f52c4',
                pointBorderColor: '#fff',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: (ctx) => `${ctx.dataset.label}: ${formatNumberRibuan(ctx.raw)} ${currentDataIndikator?.satuan || ''}`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: currentDataIndikator?.satuan || 'Nilai' }
                },
                x: { title: { display: true, text: 'Tahun' } }
            }
        }
    });
}

function filterSelectedDataTable() {
    const search = $('#selected-search').val().toLowerCase();
    if (!search || !currentDataSeries) {
        renderSelectedDataTable();
        return;
    }
    
    const filtered = currentDataSeries.filter(d => d.tahun.toString().includes(search));
    const tbody = document.getElementById('selected-data-tbody');
    
    if (filtered.length === 0) {
        tbody.innerHTML = `<table><td colspan="3" class="text-center py-5">Tidak ditemukan</div></tr>`;
        $('#selected-data-info').text(`Menampilkan 0 dari 0 data`);
    } else {
        tbody.innerHTML = filtered.map((item, index) => {
            let trend = '-';
            if (index > 0) {
                const diff = parseFloat(item.nilai) - parseFloat(filtered[index-1].nilai);
                trend = diff > 0 ? `↑ +${diff.toFixed(2)}` : diff < 0 ? `↓ ${diff.toFixed(2)}` : '→ 0';
            }
            return `<tr><td style="font-weight:bold">${item.tahun}</td><td>${formatNumberRibuan(item.nilai)}</div></td><td>${trend}</div><tr>`;
        }).join('');
        $('#selected-data-info').text(`Menampilkan ${filtered.length} dari ${filtered.length} data`);
    }
}

function loadRiwayatAnalisisByIndikator(indikator) {
    if (!indikator) {
        $('#riwayat-analisis-list').html(`
            <div class="empty-state">
                <i class="fas fa-archive"></i>
                <p>Belum ada analisis tersimpan</p>
            </div>
        `);
        return;
    }
    
    $('#riwayat-analisis-list').html(`
        <div class="text-center py-5">
            <div class="modern-spinner"></div>
            <p>Memuat riwayat analisis...</p>
        </div>
    `);
    
    $.ajax({
        url: baseUrlData + 'IDE/get_riwayat_analisis_by_indikator',
        type: 'POST',
        data: { indikator: indikator },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success' && response.data && response.data.length > 0) {
                let html = '<div style="max-height:300px;overflow-y:auto;">';
                response.data.forEach(a => {
                    // Format tanggal jika ada
                    let tanggal = a.created_at ? new Date(a.created_at).toLocaleDateString('id-ID') : '-';
                    html += `
                        <div style="padding:12px;border-bottom:1px solid var(--border);cursor:pointer;" onclick="viewAnalisisDetail(${a.id_analisis})">
                            <div style="display:flex;justify-content:space-between;align-items:center;">
                                <div>
                                    <strong>${escapeHtml(a.judul)}</strong>
                                    <br><small style="color:var(--text-3);">${escapeHtml(a.indikator)} | ${tanggal}</small>
                                </div>
                                <button class="btn btn-sm" onclick="event.stopPropagation();deleteAnalisis(${a.id_analisis})" style="color:var(--red);">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <div style="font-size:12px;margin-top:5px;color:var(--text-2);">
                                ${escapeHtml((a.kesimpulan || '').substring(0, 100))}${(a.kesimpulan || '').length > 100 ? '...' : ''}
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                $('#riwayat-analisis-list').html(html);
            } else {
                $('#riwayat-analisis-list').html(`
                    <div class="empty-state">
                        <i class="fas fa-archive"></i>
                        <p>Belum ada analisis tersimpan untuk indikator ini</p>
                        <p style="font-size:12px;">Klik tombol "Simpan Analisis" untuk menyimpan analisis Anda</p>
                    </div>
                `);
            }
        },
        error: function() {
            $('#riwayat-analisis-list').html(`
                <div class="empty-state">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>Gagal memuat riwayat analisis</p>
                </div>
            `);
        }
    });
}

// ==================== SIMPAN ANALISIS ====================
function simpanAnalisisManual() {
    const judul = $('#analisis-judul-input').val().trim();
    const kesimpulan = $('#analisis-kesimpulan-input').val().trim();
    const rekomendasi = $('#analisis-rekomendasi-input').val().trim();
    
    if (!judul) {
        Swal.fire('Error', 'Judul analisis harus diisi', 'error');
        return;
    }
    
    if (!currentDataIndikator) {
        Swal.fire('Error', 'Pilih data indikator terlebih dahulu', 'error');
        return;
    }
    
    Swal.fire({
        title: 'Menyimpan...',
        text: 'Mohon tunggu',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    
    $.ajax({
        url: baseUrlData + 'IDE/simpan_analisis_data',
        type: 'POST',
        data: {
            judul: judul,
            indikator: currentDataIndikator.indikator,
            data_aktual: JSON.stringify(currentDataSeries),
            kesimpulan: kesimpulan,
            rekomendasi: rekomendasi
        },
        dataType: 'json',
        success: function(response) {
            Swal.close();
            if (response.status === 'success') {
                $('#analisis-judul-input').val('');
                $('#analisis-kesimpulan-input').val('');
                $('#analisis-rekomendasi-input').val('');
                
                Swal.fire('Berhasil!', 'Analisis tersimpan', 'success');
                loadRiwayatAnalisisByIndikator(currentDataIndikator.indikator);
            } else {
                Swal.fire('Error', response.message || 'Gagal menyimpan', 'error');
            }
        },
        error: function() {
            Swal.close();
            Swal.fire('Error', 'Gagal menyimpan analisis', 'error');
        }
    });
}

// ==================== VIEW DETAIL ANALISIS ====================
function viewAnalisisDetail(id) {
    $.ajax({
        url: baseUrlData + 'IDE/get_analisis_detail',
        type: 'POST',
        data: { id_analisis: id },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                const d = response.data;
                Swal.fire({
                    title: d.judul,
                    html: `
                        <div style="text-align:left;">
                            <p><strong>Indikator:</strong> ${escapeHtml(d.indikator)}</p>
                            <p><strong>Tanggal:</strong> ${d.tanggal}</p>
                            <div class="mt-3"><strong>Analisis/Kesimpulan:</strong><p class="mt-2">${escapeHtml(d.kesimpulan || '-')}</p></div>
                            ${d.rekomendasi ? `<div class="mt-3"><strong>Rekomendasi:</strong><p class="mt-2">${escapeHtml(d.rekomendasi)}</p></div>` : ''}
                        </div>
                    `,
                    width: '650px'
                });
            }
        }
    });
}

// ==================== DELETE ANALISIS ====================
function deleteAnalisis(id) {
    Swal.fire({
        title: 'Hapus analisis?',
        text: 'Data tidak dapat dikembalikan',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        confirmButtonText: 'Ya, Hapus'
    }).then(result => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseUrlData + 'IDE/delete_analisis_data',
                type: 'POST',
                data: { id_analisis: id },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Terhapus!', '', 'success');
                        if (currentDataIndikator) {
                            loadRiwayatAnalisisByIndikator(currentDataIndikator.indikator);
                        }
                    }
                }
            });
        }
    });
}

// ==================== EXPORT KE EXCEL ====================
function exportSelectedDataToExcel() {
    if (!currentDataSeries || currentDataSeries.length === 0) {
        Swal.fire('Info', 'Tidak ada data untuk diexport', 'info');
        return;
    }
    
    const wsData = [['Tahun', `Nilai (${currentDataIndikator?.satuan || ''})`, 'Keterangan']];
    currentDataSeries.forEach(d => wsData.push([d.tahun, d.nilai, 'Data Aktual']));
    
    const ws = XLSX.utils.aoa_to_sheet(wsData);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, currentDataIndikator?.indikator || 'Data');
    XLSX.writeFile(wb, `${currentDataIndikator?.indikator || 'Data'}_${new Date().toISOString().slice(0,10)}.xlsx`);
    
    Swal.fire('Berhasil!', 'File Excel telah di-download', 'success');
}

// ==================== EXPORT KE PDF ====================
async function exportSelectedDataToPDF() {
    if (!currentDataSeries || currentDataSeries.length === 0) {
        Swal.fire('Info', 'Tidak ada data untuk diexport', 'info');
        return;
    }
    
    Swal.fire({
        title: 'Membuat PDF...',
        text: 'Mohon tunggu',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    
    try {
        const logoUrl = baseUrlData + 'assets/img/bappeda.png';
        const now = new Date();
        const dateStr = now.toLocaleDateString('id-ID');
        
        const htmlContent = `
            <div class="pdf-export-wrapper">
                <div class="pdf-header">
                    <div style="display: flex; align-items: center; justify-content: center; gap: 15px;">
                        <img src="${logoUrl}" alt="Logo" style="height: 50px;">
                        <div>
                            <h2>Smart Office Management</h2>
                            <h3>BAPPEDA KABUPATEN BANYUWANGI</h3>
                        </div>
                    </div>
                    <p>Laporan Data ${escapeHtml(currentDataIndikator?.indikator || 'Indikator')}</p>
                </div>
                <div class="pdf-date">
                    <strong>Tanggal Export:</strong> ${dateStr}<br>
                    <strong>Sumber:</strong> ${escapeHtml(currentDataIndikator?.produsen || '-')}<br>
                    <strong>Satuan:</strong> ${escapeHtml(currentDataIndikator?.satuan || '-')}
                </div>
                <table class="pdf-table">
                    <thead>
                        <tr><th>Tahun</th><th>Nilai</th></tr>
                    </thead>
                    <tbody>
                        ${currentDataSeries.map(d => `<tr><td style="text-align:center">${d.tahun}</td><td style="text-align:right">${formatNumberRibuan(d.nilai)}</div></td>`).join('')}
                    </tbody>
                </table>
                <div class="pdf-footer">
                    <p>Dokumen ini dibuat secara otomatis oleh sistem Smart Office Management Bappeda</p>
                </div>
            </div>
        `;
        
        const element = document.createElement('div');
        element.innerHTML = htmlContent;
        document.body.appendChild(element);
        
        const opt = {
            margin: [0.5, 0.5, 0.5, 0.5],
            filename: `${currentDataIndikator?.indikator || 'Data'}_${dateStr.replace(/\//g, '-')}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
        };
        
        await html2pdf().set(opt).from(element).save();
        document.body.removeChild(element);
        
        Swal.fire('Berhasil!', 'File PDF telah di-download', 'success');
    } catch (error) {
        console.error('PDF Error:', error);
        Swal.fire('Error!', 'Gagal membuat PDF', 'error');
    }
}

function openApiModal(id = null) {
    if (id) {
        const config = allApiConfigs.find(c => c.id_api == id);
        if (config) {
            $('#modalApiTitle').text('Edit Konfigurasi API');
            $('#api_id').val(config.id_api);
            $('#nama_data').val(config.nama_data);
            $('#kode_api').val(config.kode_api);
            $('#indikator_id').val(config.indikator_id);  // ← TAMBAHKAN INI
            $('#url_api').val(config.url_api);
            $('#api_key').val(config.api_key || '');
            $('#metode').val(config.metode || 'GET');
            $('#indikator_field').val(config.indikator_field || 'result.Indikator');
            $('#produsen_field').val(config.produsen_field || 'result.Produsen Data');
            $('#urusan_field').val(config.urusan_field || 'result.Urusan');
            $('#satuan_field').val(config.satuan_field || 'result.Satuan');
            $('#data_field').val(config.data_field || 'result.data');
            $('#tahun_field').val(config.tahun_field || 'tahun');
            $('#nilai_field').val(config.nilai_field || 'nilai');
        }
    } else {
        $('#modalApiTitle').text('Tambah Konfigurasi API');
        $('#formApiConfig')[0].reset();
        $('#api_id').val('');
        $('#indikator_id').val('');  // ← TAMBAHKAN INI
        $('#indikator_field').val('result.Indikator');
        $('#produsen_field').val('result.Produsen Data');
        $('#urusan_field').val('result.Urusan');
        $('#satuan_field').val('result.Satuan');
        $('#data_field').val('result.data');
        $('#tahun_field').val('tahun');
        $('#nilai_field').val('nilai');
    }
    
    $('#modalApiConfig').css('display', 'flex');
}

function closeApiModal() {
    $('#modalApiConfig').css('display', 'none');
}

// Submit form API config
$(document).ready(function() {
    $('#formApiConfig').off('submit').on('submit', function(e) {
        e.preventDefault();
        
        const id_api = $('#api_id').val();
        const url = id_api ? baseUrlData + 'IDE/update_api_config' : baseUrlData + 'IDE/save_api_config';
        
        // Validasi ID Indikator
        const indikatorId = $('#indikator_id').val().trim();
        if (!indikatorId) {
            Swal.fire('Error!', 'ID Indikator wajib diisi', 'error');
            return;
        }
        
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                Swal.close();
                if (response.status === 'success') {
                    Swal.fire('Berhasil!', response.message, 'success');
                    closeApiModal();
                    loadApiConfigs(); // Refresh daftar
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            },
            error: function(xhr) {
                Swal.close();
                let msg = 'Gagal menyimpan konfigurasi';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                Swal.fire('Error!', msg, 'error');
            }
        });
    });
});

function editApiConfig(id) {
    openApiModal(id);
}

function deleteApiConfig(id, nama) {
    Swal.fire({
        title: 'Hapus Konfigurasi?',
        text: `Anda yakin ingin menghapus "${nama}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseUrlData + 'IDE/delete_api_config',
                type: 'POST',
                data: { id_api: id },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Terhapus!', response.message, 'success');
                        loadApiConfigs();
                        if (currentSelectedKode) {
                            const deleted = allApiConfigs.find(c => c.id_api == id);
                            if (deleted && deleted.kode_api === currentSelectedKode) {
                                $('#selected-data-container').hide();
                                currentSelectedKode = null;
                            }
                        }
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Gagal menghapus konfigurasi', 'error');
                }
            });
        }
    });
}

// ==================== INISIALISASI PANEL DATA ====================
// Hentikan observer lama jika ada
if (window.dataPanelObserver) {
    window.dataPanelObserver.disconnect();
}

// Buat observer baru
window.dataPanelObserver = new MutationObserver(function() {
    const activePanel = document.querySelector('.panel.active');
    if (activePanel && activePanel.id === 'panel-data') {
        console.log('Panel data aktif, memuat konfigurasi API...');
        if (allApiConfigs.length === 0) {
            loadApiConfigs();
        } else {
            renderDataCards();
        }
    }
});

window.dataPanelObserver.observe(document.body, {
    attributes: true,
    attributeFilter: ['class'],
    subtree: true
});

// Jika panel data sudah aktif saat halaman dimuat
if (document.querySelector('#panel-data.active')) {
    loadApiConfigs();
}

console.log('Data panel API manager initialized - FINAL VERSION');

// Load riwayat analisis untuk indikator yang dipilih
function loadRiwayatAnalisis() {
    if (!currentDataIndikator || !currentDataIndikator.indikator) {
        $('#riwayat-analisis-list').html(`
            <div class="empty-state">
                <i class="fas fa-archive"></i>
                <p>Belum ada analisis tersimpan</p>
                <p style="font-size:12px;">Pilih data indikator terlebih dahulu</p>
            </div>
        `);
        return;
    }
    
    loadRiwayatAnalisisByIndikator(currentDataIndikator.indikator);
}

</script>

<!-- Modal Detail Rekap dari Log Aktivitas -->
<div id="modalLogRekap" class="modal-log-rekap">
    <div class="modal-log-rekap-content">
        <div class="modal-log-rekap-header">
            <h3 id="modalLogRekapTitle">Rekap Print</h3>
            <button class="modal-log-rekap-close" onclick="closeModalLogRekap()">&times;</button>
        </div>
        <div class="modal-log-rekap-body" id="modalLogRekapBody">
            <div style="text-align:center;padding:40px;">
                <div class="modern-spinner"></div>
                <p>Memuat data...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Print Per User -->
<div id="modalUserPrintDetail" class="modal-log-rekap">
    <div class="modal-log-rekap-content">
        <div class="modal-log-rekap-header">
            <h3 id="modalUserPrintTitle">Detail Print User</h3>
            <button class="modal-log-rekap-close" onclick="closeModalUserPrintDetail()">&times;</button>
        </div>
        <div class="modal-log-rekap-body" id="modalUserPrintBody">
            <div style="text-align:center;padding:40px;">
                <div class="modern-spinner"></div>
                <p>Memuat data...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Rekap Print dari Log Aktivitas -->
<div id="modalPrintRekap" class="modal-user-rekap">
    <div class="modal-user-rekap-content">
        <div class="modal-user-rekap-header">
            <h3 id="modalPrintRekapTitle">Detail Rekap Print</h3>
            <button class="modal-user-rekap-close" onclick="closeModalPrintRekap()">&times;</button>
        </div>
        <div class="modal-user-rekap-body" id="modalPrintRekapBody">
            <div style="text-align:center;padding:40px;">
                <div class="modern-spinner"></div>
                <p>Memuat data...</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>