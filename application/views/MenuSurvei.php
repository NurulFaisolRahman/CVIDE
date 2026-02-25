<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Menu Survei IKM - Inti Desain Ekonomi Consultant' ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    :root {
        --primary: #007AFF;
        --primary-dark: #0056B3;
        --primary-light: #60A5FA;
        --success: #006600;
        --success-bg: #E6FFE6;
        --success-border: #B3E6B3;
        --danger: #DC2626;
        --danger-bg: #FEF2F2;
        --danger-border: #FCA5A5;
        --text-dark: #001428;
        --text-muted: #6B7280;
        --bg-light: #F7F8FA;
        --bg-white: #FFFFFF;
        --border: #E5E7EB;
        --border-light: #D2D2D7;
    }

    * { margin:0; padding:0; box-sizing:border-box; }
    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        line-height: 1.6;
        color: var(--text-dark);
        background: var(--bg-white);
        overflow-x: hidden;
    }

    /* Header – persis seperti versi awal Anda */
    .header {
        position: fixed; top: 0; width: 100%;
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid var(--border-light);
        z-index: 1000; transition: all 0.3s ease;
    }
    .header-content {
        max-width: 1200px; margin: 0 auto; padding: 0 24px;
        display: flex; align-items: center; justify-content: space-between; height: 64px;
    }
    .logo { display: flex; align-items: center; gap: 12px; }
    .logo img { width: 36px; height: 36px; border-radius: 8px; }
    .logo-text { font-size: 20px; font-weight: 600; color: var(--text-dark); }
    .nav-menu { 
        display: flex; list-style: none; gap: 32px; margin-left: auto; align-items: center; 
    }
    .nav-menu a {
        text-decoration: none; color: var(--text-dark);
        font-weight: 400; font-size: 15px; transition: color 0.3s ease; position: relative;
    }
    .nav-menu a:hover { color: #001F3F; }
    .nav-menu a::after {
        content: ''; position: absolute; bottom: -4px; left: 0;
        width: 0; height: 2px; background: #001F3F; transition: width 0.3s ease;
    }
    .nav-menu a:hover::after { width: 100%; }

    /* Dropdown Mega Menu – persis seperti awal */
    .dropdown { position: relative; }
    .dropbtn { font-weight: 600; cursor: pointer; padding: 8px 0; }
    .dropdown-content.mega-dropdown {
        display: none; position: absolute; top: 100%; left: 50%; transform: translateX(-50%);
        background: #fff; min-width: 580px; max-width: 85vw;
        box-shadow: 0 12px 32px rgba(0,0,0,0.12); border-radius: 10px;
        margin-top: 4px; z-index: 999; padding: 24px 32px;
    }
    .dropdown:hover .dropdown-content.mega-dropdown { display: block; }
    .mega-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 36px; }
    .mega-heading {
        font-size: 1.05rem; font-weight: 700; margin: 0 0 10px 0;
        padding-bottom: 8px; border-bottom: 1px solid #eee;
    }
    .mega-column a { display: block; padding: 8px 0; color: #444; transition: all 0.2s; }
    .mega-column a:hover { color: #0a58ca; padding-left: 6px; }
    .mega-desc { font-size: 0.875rem; color: #666; margin: 4px 0 20px 0; }
    .arrow-down { font-size: 0.75rem; margin-left: 5px; opacity: 0.8; }

    /* ENTERPRISE HERO — diterapkan ke survei */
    .survey-hero {
        position: relative;
        background: #001428;
        padding: 160px 0 100px;
        overflow: hidden;
    }

    .survey-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(0,122,255,0.06) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0,122,255,0.06) 1px, transparent 1px);
        background-size: 60px 60px;
    }

    .survey-hero::after {
        content: '';
        position: absolute;
        top: -200px; left: 50%; transform: translateX(-50%);
        width: 900px; height: 600px;
        background: radial-gradient(ellipse, rgba(0,122,255,0.15) 0%, transparent 65%);
        pointer-events: none;
    }

    .hero-inner {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin: 0 auto;
        padding: 0 24px;
        text-align: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(0,122,255,0.12);
        border: 1px solid rgba(0,122,255,0.3);
        color: #60A5FA;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        padding: 6px 16px;
        border-radius: 4px;
        margin-bottom: 32px;
    }

    .hero-badge::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #60A5FA;
        box-shadow: 0 0 8px #60A5FA;
        animation: blink 2s infinite;
    }

    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    .hero-inner h1 {
        font-size: clamp(2.4rem, 5vw, 3.8rem);
        font-weight: 700;
        color: #fff;
        line-height: 1.1;
        letter-spacing: -0.02em;
        margin-bottom: 20px;
    }

    .hero-inner h1 span {
        background: linear-gradient(135deg, #60A5FA, #007AFF);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-inner .lead {
        font-size: 1.05rem;
        color: rgba(255,255,255,0.6);
        max-width: 580px;
        margin: 0 auto 48px;
        line-height: 1.7;
        font-weight: 400;
    }

    /* Stats strip (opsional – bisa dihapus jika tidak perlu) */
    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 0;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        overflow: hidden;
        background: rgba(255,255,255,0.03);
        backdrop-filter: blur(12px);
        max-width: 640px;
        margin: 0 auto;
    }
    .hero-stat {
        flex: 1;
        padding: 20px 24px;
        text-align: center;
        border-right: 1px solid rgba(255,255,255,0.08);
    }
    .hero-stat:last-child { border-right: none; }
    .hero-stat .val {
        font-size: 1.6rem;
        font-weight: 700;
        color: #fff;
        display: block;
        line-height: 1;
        margin-bottom: 4px;
    }
    .hero-stat .lbl {
        font-size: 0.65rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.4);
    }

    /* Survey Content (filter + grid) */
    .survey-content {
        background: var(--bg-light);
        padding: 70px 16px 90px;
    }

    .survey-content-inner {
        max-width: 1080px;
        margin: 0 auto;
    }

    .section-eyebrow {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-eyebrow .tag {
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--primary);
        background: rgba(0,122,255,0.06);
        border: 1px solid rgba(0,122,255,0.15);
        padding: 4px 12px;
        border-radius: 4px;
    }

    .section-eyebrow h2 {
        font-size: 1.9rem;
        font-weight: 700;
        margin: 10px 0 6px;
    }

    .section-eyebrow p {
        font-size: 0.95rem;
        color: var(--text-muted);
        max-width: 540px;
        margin: 0 auto;
    }

    .filter-section {
        background: white;
        border-radius: 10px;
        padding: 20px 24px;
        margin-bottom: 32px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        border: 1px solid var(--border);
    }

    .filter-section h4 {
        font-size: 1.05rem;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .filter-row {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-group label {
        font-size: 0.88rem;
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
        color: #4B5563;
    }

    .filter-group select {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.92rem;
        background: white;
        cursor: pointer;
    }

    .filter-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0,122,255,0.1);
    }

    .survey-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 24px;
    }

    .survey-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 24px 20px;
        transition: all 0.26s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        display: flex;
        flex-direction: column;
    }

    .survey-card.hidden {
        display: none;
    }

    .survey-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(0,32,80,0.09);
        border-color: var(--primary-light);
    }

    .card-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .card-icon {
        width: 28px;
        height: 28px;
        color: var(--primary);
    }

    .card-status {
        font-size: 0.76rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 999px;
        min-width: 70px;
        text-align: center;
    }

    .status-active {
        background-color: var(--success-bg);
        color: var(--success);
        border: 1px solid var(--success-border);
    }

    .status-inactive {
        background-color: var(--danger-bg);
        color: var(--danger);
        border: 1px solid var(--danger-border);
    }

    .card-title {
        font-size: 1.08rem;
        font-weight: 700;
        margin: 0 0 10px 0;
        line-height: 1.3;
    }

    .card-divider {
        height: 1px;
        background: var(--border);
        margin: 10px 0 12px;
        opacity: 0.6;
    }

    .card-meta {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 20px;
        font-size: 0.86rem;
    }

    .meta-row {
        display: grid;
        grid-template-columns: 110px 16px 1fr;
        align-items: baseline;
    }

    .meta-label {
        font-weight: 600;
        color: #4B5563;
        white-space: nowrap;
    }

    .meta-colon {
        text-align: center;
        color: #6B7280;
        font-weight: 500;
    }

    .meta-value {
        font-weight: 400;
        color: var(--text-dark);
        text-align: left;
    }

    .card-actions {
        display: flex;
        gap: 12px;
        margin-top: auto;
    }

    .btn-primary, .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 0.90rem;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.28s ease;
        flex: 1;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        box-shadow: 0 3px 10px rgba(0,122,255,0.16);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,122,255,0.24);
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
    }

    .btn-secondary {
        background: white;
        color: var(--primary);
        border: 1px solid var(--primary);
    }

    .btn-secondary:hover {
        background: rgba(0,122,255,0.05);
        transform: translateY(-2px);
    }

    /* Login Prompt Modal */
    .login-prompt-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        z-index: 2001;
        align-items: center;
        justify-content: center;
    }
    .login-prompt-modal.active { display: flex; }
    .login-prompt-content {
        background: white;
        border-radius: 16px;
        width: 90%;
        max-width: 380px;
        padding: 32px 24px;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    }
    .login-prompt-content h3 {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--text-dark);
    }
    .login-prompt-content p {
        color: var(--text-muted);
        margin-bottom: 24px;
        line-height: 1.5;
    }
    .login-prompt-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
    }
    .login-prompt-btn {
        padding: 10px 24px;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .login-prompt-btn.primary {
        background: var(--primary);
        color: white;
    }
    .login-prompt-btn.primary:hover {
        background: var(--primary-dark);
    }
    .login-prompt-btn.secondary {
        background: #f0f0f0;
        color: var(--text-dark);
    }
    .login-prompt-btn.secondary:hover {
        background: #e0e0e0;
    }

    /* Login Status Badge */
    .login-status-badge {
        position: fixed;
        top: 80px;
        right: 20px;
        z-index: 9999;
        background: #28a745;
        color: white;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .login-status-badge a {
        color: white;
        text-decoration: none;
        margin-left: 10px;
    }
    .login-status-badge a:hover {
        opacity: 0.8;
    }
    .level-badge {
        background: rgba(255,255,255,0.2);
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 12px;
    }

    /* Contact Section */
    .ide-contact {
        background: #001F3F;
        padding: 80px 24px;
        color: white;
    }
    .contact-container { max-width: 1200px; margin: 0 auto; position: relative; z-index: 2; }
    .contact-header { text-align: center; margin-bottom: 40px; }
    .contact-header h2 { font-size: 1.8rem; margin-bottom: 12px; color: white; }
    .contact-header p { color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto; font-size: 15px; }
    .contact-content { display: grid; grid-template-columns: 2fr 1fr; gap: 32px; margin-top: 24px; }
    .contact-info { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    .office-info h3, .services h3, .links-column h3 {
        font-size: 1rem; color: white; margin-bottom: 12px; padding-bottom: 8px;
        border-bottom: 2px solid var(--primary); font-weight: 600;
    }
    .office-info p { color: rgba(255,255,255,0.85); line-height: 1.7; margin-bottom: 12px; display: flex; align-items: flex-start; gap: 8px; font-size: 14px; }
    .services ul, .links-column ul { list-style: none; padding: 0; }
    .services li, .links-column li {
        color: rgba(255,255,255,0.85); margin-bottom: 8px; padding-left: 1rem; position: relative; font-size: 14px;
    }
    .services li::before, .links-column li::before {
        content: "•"; color: var(--primary); position: absolute; left: 0; font-weight: bold;
    }
    .company-links { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    .copyright {
        text-align: center; margin-top: 32px; padding-top: 16px;
        border-top: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); font-size: 13px;
    }
    .social-links { margin-top: 24px; }
    .social-links h3 { font-size: 1rem; color: white; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 2px solid var(--primary); font-weight: 600; }
    .social-links-container { display: flex; justify-content: center; gap: 16px; flex-wrap: wrap; }
    .social-link img { width: 32px; height: 32px; object-fit: contain; filter: brightness(100%); transition: filter 0.3s ease; }
    .social-link:hover img { filter: brightness(120%); }

    @media (max-width: 992px) {
        .survey-grid { grid-template-columns: repeat(2, 1fr); }
        .contact-content { grid-template-columns: 1fr; }
        .contact-info { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .survey-grid { grid-template-columns: 1fr; }
        .nav-menu { display: none; }
        .survey-card { padding: 18px 16px; }
        .card-title { font-size: 1.04rem; }
        .card-meta { font-size: 0.84rem; }
        .meta-row { grid-template-columns: 100px 14px 1fr; }
        .card-actions { flex-direction: column; }
        .login-status-badge {
            top: 70px;
            right: 10px;
            left: 10px;
            max-width: none;
            font-size: 12px;
        }
    }

    /* =============================================
       MODAL LOGIN (sama persis seperti halaman utama)
    ============================================= */
    .modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        z-index: 2000;
        align-items: center;
        justify-content: center;
    }
    .modal.active { display: flex; }
    .modal-content {
        background: white;
        border-radius: 16px;
        width: 90%;
        max-width: 420px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    }
    .modal-header {
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border);
    }
    .modal-title { font-size: 1.4rem; font-weight: 600; }
    .modal-close {
        background: none;
        border: none;
        font-size: 1.8rem;
        cursor: pointer;
        color: #6b7280;
    }
    .modal-body { padding: 24px; }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; margin-bottom: 6px; font-weight: 500; }
    .form-input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.2s;
    }
    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0,122,255,0.1);
    }
    .btn-primary {
        width: 100%;
        padding: 12px;
        background: #001428;
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }
    .btn-primary:hover { background: var(--primary-dark); }
    </style>
</head>
<body>
<?php
// Ambil data session dari controller
$isLoggedIn = isset($isLoggedIn) ? $isLoggedIn : false;
$userLevel = isset($userLevel) ? $userLevel : 0;
$userName = isset($userName) ? $userName : 'User';
?>

<!-- Login Status Badge - Tampil jika user sudah login -->
<?php if ($isLoggedIn): ?>
<div class="login-status-badge">
    <i class="fas fa-user-circle"></i> 
    <span style="font-weight: 600;"><?= $userName ?></span>
    <span class="level-badge">
        <?php 
            if($userLevel == 1) echo 'Superadmin';
            elseif($userLevel == 2) echo 'Admin';
            elseif($userLevel == 3) echo 'Staf';
            elseif($userLevel == 4) echo 'Surveiyor';
            else echo 'Pengunjung';
        ?>
    </span>
    <a href="#" onclick="logout()" title="Logout">
        <i class="fas fa-sign-out-alt"></i>
    </a>
</div>
<?php endif; ?>

<!-- Sign In Modal -->
<div id="signInModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Masuk</h3>
        <button class="modal-close" onclick="closeModal('signInModal')">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Username</label>
          <input type="text" class="form-input" id="Username" placeholder="Enter your username">
        </div>
        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" class="form-input" id="Password" placeholder="Enter your password">
        </div>
        <button class="btn-primary" id="Masuk">Masuk</button>
      </div>
    </div>
  </div>

<!-- Login Prompt Modal -->
<div id="loginPromptModal" class="login-prompt-modal">
    <div class="login-prompt-content">
        <h3>⚠️ Perlu Login</h3>
        <p>Anda harus masuk terlebih dahulu untuk mengisi survei. Silakan login atau lanjutkan dengan demo.</p>
        <div class="login-prompt-actions">
            <button class="login-prompt-btn primary" onclick="handleLoginPromptLogin()">Login</button>
            <button class="login-prompt-btn secondary" onclick="handleLoginPromptDemo()">Demo</button>
        </div>
    </div>
</div>

    <!-- Header – persis seperti versi awal -->
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <a href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="LogoIDE">
                </a>
                <span class="logo-text">Inti Desain Ekonomi Consultant</span>
            </div>
            <nav class="nav-menu">
                <!-- Dropdown Tentang -->
                <div class="dropdown">
                    <a href="#about" class="dropbtn">Tentang <span class="arrow-down"></span></a>
                    <div class="dropdown-content mega-dropdown">
                        <div class="mega-grid">
                            <div class="mega-column">
                                <h4 class="mega-heading">Profil Perusahaan</h4>
                                <a href="#sejarah">Sejarah & Visi Misi</a>
                                <p class="mega-desc">Inti Desain Ekonomi Consultant berdiri sejak 2015 dengan fokus pada solusi ekonomi berkelanjutan.</p>
                                <h4 class="mega-heading">Legal & Sertifikasi</h4>
                                <a href="<?= base_url('legalitas') ?>">Sertifikasi & Izin Usaha</a>
                                <p class="mega-desc">Terdaftar resmi dan bekerja sama dengan lembaga terkemuka di Indonesia.</p>
                            </div>
                            <div class="mega-column">
                                <h4 class="mega-heading">Lokasi & Kontak</h4>
                                <a href="https://www.google.com/maps/search/?api=1&query=-7.929581,112.640292">Kantor Malang</a>
                                <p class="mega-desc">Berbasis di Malang, siap melayani seluruh Indonesia dan regional.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Layanan -->
                <div class="dropdown">
                    <a href="#services" class="dropbtn">Layanan <span class="arrow-down"></span></a>
                    <div class="dropdown-content mega-dropdown">
                        <div class="mega-grid">
                            <div class="mega-column">
                                <h4 class="mega-heading">Konsultasi</h4>
                                <a href="#konsultasi-ekonomi">Konsultasi Ekonomi</a>
                                <a href="#konsultasi-kebijakan">Analisis Kebijakan Publik</a>
                                <p class="mega-desc">Pendampingan strategis berbasis data ekonomi.</p>
                                <h4 class="mega-heading">Survei & Penelitian</h4>
                                <a href="<?= base_url('MenuSurvei') ?>">Survei Kepuasan Masyarakat</a>
                                <p class="mega-desc">Metode ilmiah dengan analisis mendalam.</p>
                            </div>
                            <div class="mega-column">
                                <h4 class="mega-heading">Penyusunan Dokumen</h4>
                                <a href="#laporan-studi">Laporan & Studi Kelayakan</a>
                                <p class="mega-desc">Dokumen siap pakai untuk proposal & perencanaan.</p>
                                <h4 class="mega-heading">Pelatihan</h4>
                                <a href="#workshop-ekonomi">Workshop Ekonomi & Keuangan</a>
                                <p class="mega-desc">Pelatihan praktis untuk meningkatkan kompetensi.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portfolio -->
                <div class="dropdown">
                    <a href="#portfolio" class="dropbtn">Portfolio <span class="arrow-down"></span></a>
                    <div class="dropdown-content mega-dropdown">
                        <div class="mega-grid">
                            <div class="mega-column">
                                <h4 class="mega-heading">Proyek Pemerintahan</h4>
                                <a href="#proyek-pemda">Survei Ekonomi Daerah</a>
                                <a href="#studi-kelayakan">Studi Kelayakan Infrastruktur</a>
                                <p class="mega-desc">Kerjasama dengan berbagai Pemda di Jawa Timur & luar pulau.</p>
                            </div>
                            <div class="mega-column">
                                <h4 class="mega-heading">Proyek Swasta</h4>
                                <a href="#klien-korporasi">Analisis Pasar & Investasi</a>
                                <a href="#umkm">Pendampingan UMKM</a>
                                <p class="mega-desc">Lebih dari 50 klien swasta dengan hasil terukur.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tim -->
                <div class="dropdown">
                    <a href="#team" class="dropbtn">Tim <span class="arrow-down"></span></a>
                    <div class="dropdown-content mega-dropdown">
                        <div class="mega-grid">
                            <div class="mega-column">
                                <h4 class="mega-heading">Pendiri & Direktur</h4>
                                <a href="#direktur">Profil Direktur Utama</a>
                                <p class="mega-desc">Ahli ekonomi dengan pengalaman 15+ tahun.</p>
                                <h4 class="mega-heading">Tim Ahli</h4>
                                <a href="#peneliti">Peneliti & Analis</a>
                                <a href="#konsultan">Konsultan Senior</a>
                            </div>
                            <div class="mega-column">
                                <h4 class="mega-heading">Struktur Organisasi</h4>
                                <a href="#divisi">Divisi & Departemen</a>
                                <p class="mega-desc">Tim multidisiplin: ekonomi, statistik, manajemen, & informatika.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Masuk -->
                <div class="dropdown">
                <a href="#" class="dropbtn" onclick="openModal('signInModal')">
                    <i class="fas fa-user-circle" style="margin-right:6px; font-size:1.1rem;"></i>
                    Masuk
                </a>
            </div>
            </nav>
        </div>
    </header>

    <!-- Hero – Menggunakan style ENTERPRISE HERO -->
    <section class="survey-hero">
        <div class="hero-inner">
            <div class="hero-badge">
                <span>SURVEI </span>
            </div>
            <h1>Layanan Survei Indeks Kepuasan </h1>
            <p class="lead">
                Silakan berpartisipasi dalam Survei  
                dengan mengisi kuesioner sesuai layanan yang Anda gunakan.
            </p>

            <!-- Opsional: Stats strip (bisa dihapus jika tidak diperlukan) -->
            <div class="hero-stats">
                
                <div class="hero-stat">
                    <span class="val">2 Daerah</span>
                    <span class="lbl">Lokasi</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Survei dengan Filter -->
    <section class="survey-content">
        <div class="survey-content-inner">
            <div class="section-eyebrow">
                <span class="tag">DAFTAR SURVEI AKTIF</span>
                <h2>Formulir Survei</h2>
                <p>Klik pada kartu di bawah ini untuk mengisi survei sesuai layanan yang Anda akses.</p>
            </div>

            <!-- Filter -->
            <div class="filter-section">
                <h4>Filter Survei</h4>
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="jenis">Jenis Survei</label>
                        <select id="jenis" onchange="filterSurvei()">
                            <option value="">Semua Jenis</option>
                            <option value="IKM">Survei IKM</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="tahun">Tahun</label>
                        <select id="tahun" onchange="filterSurvei()">
                            <option value="">Semua Tahun</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="status">Status</label>
                        <select id="status" onchange="filterSurvei()">
                            <option value="">Semua Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Grid Survei -->
            <div class="survey-grid" id="surveyGrid"></div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="ide-contact">
        <div class="contact-container">
            <div class="contact-header">
                <h2>Hubungi Kami</h2>
                <p>CV Inti Desain Ekonomi (IDE) Consultant siap membantu Anda dengan solusi penelitian dan konsultasi kebijakan ekonomi profesional.</p>
                <br>
                <div class="social-links">
                    <h3>Ikuti Sosial Media Kami</h3>
                    <div class="social-links-container">
                        <a href="https://www.tiktok.com/@intidesainekonomi" class="social-link" target="_blank">
                            <img src="<?= base_url('assets/img/TT.png') ?>" alt="TikTok">
                        </a>
                        <a href="https://www.instagram.com/intidesainekonomi" class="social-link" target="_blank">
                            <img src="<?= base_url('assets/img/instagram.png') ?>" alt="Instagram">
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-content">
                <div class="contact-info">
                    <div class="office-info">
                        <h3>Kantor IDE Consultant</h3>
                        <p><i class="icon">📍</i> Perum Nila Residence B6<br>Kecamatan Blimbing<br>Kota Malang</p>
                        <p><i class="icon">✉️</i> cvideconsultan@gmail.com</p>
                    </div>

                    <div class="services">
                        <h3>Layanan Kami</h3>
                        <ul>
                            <li>Economic Development</li>
                            <li>Fiscal & Public Policy</li>
                            <li>Regional Planning</li>
                            <li>Manajemen Kebijakan</li>
                            <li>Penelitian Ekonomi</li>
                            <li>Konsultasi Kebijakan</li>
                        </ul>
                    </div>
                </div>

                <div class="company-links">
                    <div class="links-column">
                        <h3>Tentang Kami</h3>
                        <ul>
                            <li>Visi & Misi</li>
                            <li>Tim Ahli</li>
                            <li>Portofolio</li>
                        </ul>
                    </div>

                    <div class="links-column">
                        <h3>Informasi</h3>
                        <ul>
                            <li>Kerjasama</li>
                            <li>Lowongan</li>
                            <li>Artikel</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="copyright">
                <p>Copyright © <span id="current-year"></span> CV Inti Desain Ekonomi Consultant. All Rights Reserved.</p>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
      var BaseURL = '<?= base_url() ?>';
      var currentSelectedSurvey = null; // Menyimpan survei yang dipilih
      var isLoggedIn = <?= $isLoggedIn ? 'true' : 'false' ?>; // Status login dari PHP
      var userLevel = <?= $userLevel ?>; // Level user dari PHP

// Modal functions
function openModal(modalId) {
    document.getElementById(modalId).classList.add('active');
}
function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
}

// Login Prompt Modal functions
function openLoginPrompt() {
    document.getElementById('loginPromptModal').classList.add('active');
}
function closeLoginPrompt() {
    document.getElementById('loginPromptModal').classList.remove('active');
}

function handleLoginPromptLogin() {
    closeLoginPrompt();
    openModal('signInModal');
}

function handleLoginPromptDemo() {
    closeLoginPrompt();
    if (currentSelectedSurvey) {
        // Redirect ke halaman demo dengan parameter ?demo=true
        window.location.href = currentSelectedSurvey.url + '?demo=true';
    }
}

// Fungsi logout
function logout() {
    Swal.fire({
        title: 'Logout',
        text: "Apakah Anda yakin ingin keluar?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = BaseURL + "IDE/logout";
        }
    });
}

window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        closeModal(event.target.id);
    }
    if (event.target.classList.contains('login-prompt-modal')) {
        closeLoginPrompt();
    }
};

// Login handler
jQuery(document).ready(function($) {
    "use strict";

    // Enter key support
    $('#Username, #Password').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#Masuk').click();
        }
    });

    // Tombol Masuk
    $("#Masuk").click(function() {
        const username = $("#Username").val().trim();
        const password = $("#Password").val().trim();

        if (!username || !password) {
            Swal.fire('Perhatian', 'Mohon isi username dan password dengan lengkap.', 'warning');
            return;
        }

        const data = { Username: username, Password: password };

        $("#Masuk").prop("disabled", true).text("Memproses...");

        $.post(BaseURL + "IDE/SignIn", data)
            .done(function(response) {
                $("#Masuk").prop("disabled", false).text("Masuk");

                if (response === '1') {
                    window.location = BaseURL + "SuperAdmin";
                } else if (response === '2') {
                    window.location = BaseURL + "Admin";
                } else if (response === '3') {
                    window.location = BaseURL + "Staf";
                } else if (response === '4') {
                    // Surveiyor login - reload halaman untuk memperbarui status login
                    window.location.reload();
                } else if (response === '0') {
                    window.location = BaseURL + "Econk";
                } else {
                    Swal.fire('Gagal', response || "Username atau password salah. Silakan coba lagi.", 'error');
                }
            })
            .fail(function() {
                $("#Masuk").prop("disabled", false).text("Masuk");
                Swal.fire('Error', 'Gagal terhubung ke server. Periksa koneksi Anda.', 'error');
            });
    });
});

        // Data survei dummy (dengan lembaga terkait)
        const surveiData = [
            { id: 1, title: "Survei IKM Kinerja Bupati & Wakil Bupati Kab. Situbondo", jenis: "IKM", tahun: "2024", status: "Tidak Aktif", lembaga: "BAPPERIDA Kab. Situbondo", url: "<?= base_url('IDE/SurveiIKMSitubondo') ?>" },
            { id: 2, title: "Survei IKM Kinerja Bupati & Wakil Bupati Kab. Situbondo", jenis: "IKM", tahun: "2025", status: "Tidak Aktif", lembaga: "BAPPERIDA Kab. Situbondo", url: "<?= base_url('IDE/SurveiIKMSitubondo') ?>" },
            { id: 3, title: "Survei IKM Kinerja Walikota & Wakil Walikota Kota Yogyakarta", jenis: "IKM", tahun: "2026", status: "Aktif", lembaga: "BAKESBANGPOL Kota Yogyakarta", url: "<?= base_url('IDE/SurveiIKMYogyakarta') ?>" }
        ];

        // Fungsi untuk mengecek apakah user sudah login (dari session PHP)
        function isUserLoggedIn() {
            return isLoggedIn; // Mengambil dari variabel PHP di atas
        }

        function handleSurveyClick(survey, action) {
            if (action === 'isi') {
                if (isUserLoggedIn()) {
                    // Jika sudah login, langsung redirect ke halaman survei
                    window.location.href = survey.url;
                } else {
                    // Jika belum login, simpan survei yang dipilih dan tampilkan modal login prompt
                    currentSelectedSurvey = survey;
                    openLoginPrompt();
                }
            } else if (action === 'demo') {
                // Demo langsung redirect dengan parameter demo
                window.location.href = survey.url + '?demo=true';
            }
        }

        function renderSurvei(data) {
            const grid = document.getElementById('surveyGrid');
            grid.innerHTML = '';

            if (data.length === 0) {
                grid.innerHTML = '<p style="text-align:center; color:#6B7280; grid-column: 1 / -1; padding: 40px 0;">Tidak ada survei yang sesuai dengan filter.</p>';
                return;
            }

            data.forEach(item => {
                const card = document.createElement('div');
                card.className = 'survey-card';
                card.innerHTML = `
                    <div class="card-header-row">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="8" r="6"/>
                                <path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>
                            </svg>
                        </div>
                        <span class="card-status ${item.status === 'Aktif' ? 'status-active' : 'status-inactive'}">
                            ${item.status}
                        </span>
                    </div>
                    <h3 class="card-title">${item.title}</h3>
                    <div class="card-divider"></div>
                    <div class="card-meta">
                        <div class="meta-row">
                            <span class="meta-label">Lembaga Terkait</span>
                            <span class="meta-colon">:</span>
                            <span class="meta-value">${item.lembaga}</span>
                        </div>
                        <div class="meta-row">
                            <span class="meta-label">Jenis</span>
                            <span class="meta-colon">:</span>
                            <span class="meta-value">${item.jenis}</span>
                        </div>
                        <div class="meta-row">
                            <span class="meta-label">Tahun</span>
                            <span class="meta-colon">:</span>
                            <span class="meta-value">${item.tahun}</span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <button class="btn-primary" onclick="handleSurveyClick(${JSON.stringify(item).replace(/"/g, '&quot;')}, 'isi')">
                            Isi Survei
                        </button>
                        <button class="btn-secondary" onclick="handleSurveyClick(${JSON.stringify(item).replace(/"/g, '&quot;')}, 'demo')">
                            Demo
                        </button>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        function filterSurvei() {
            const jenis = document.getElementById('jenis').value;
            const tahun = document.getElementById('tahun').value;
            const status = document.getElementById('status').value;

            let filtered = surveiData;

            if (jenis) filtered = filtered.filter(item => item.jenis === jenis);
            if (tahun) filtered = filtered.filter(item => item.tahun === tahun);
            if (status) filtered = filtered.filter(item => item.status === status);

            renderSurvei(filtered);
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderSurvei(surveiData);
        });

        document.getElementById('current-year').textContent = new Date().getFullYear();

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>