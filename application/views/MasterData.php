<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Master Data Proyek | IDE Consultant' ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    :root {
      --apple-blue: #007AFF;
      --apple-gray: #F2F2F7;
      --apple-dark: #1D1D1F;
      --apple-text: #1D1D1F;
      --apple-secondary: rgba(61, 61, 196, 1);
      --apple-white: #FFFFFF;
      --apple-light-gray: #F5F5F7;
      --apple-border: #D2D2D7;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      line-height: 1.6;
      color: var(--apple-text);
      background: var(--apple-white);
      overflow-x: hidden;
    }

    /* Header & Navbar */
    .header {
      position: fixed; top: 0; width: 100%;
      background: rgba(255,255,255,0.8);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--apple-border);
      z-index: 1000; transition: all 0.3s ease;
    }
    .header-content {
      max-width: 1200px; margin: 0 auto; padding: 0 24px;
      display: flex; align-items: center; justify-content: space-between; height: 64px;
    }
    .logo { display: flex; align-items: center; gap: 12px; }
    .logo img { width: 36px; height: 36px; border-radius: 8px; }
    .logo-text { font-size: 20px; font-weight: 600; color: var(--apple-text); }

    .nav-menu { display: flex; list-style: none; gap: 32px; margin-left: auto; }
    .nav-menu a {
      text-decoration: none; color: var(--apple-text);
      font-weight: 400; font-size: 15px; transition: color 0.3s ease; position: relative;
    }
    .nav-menu a:hover { color: #001F3F; }
    .nav-menu a::after {
      content: ''; position: absolute; bottom: -4px; left: 0;
      width: 0; height: 2px; background: #001F3F; transition: width 0.3s ease;
    }
    .nav-menu a:hover::after { width: 100%; }

    .dropdown { position: relative; }
    .dropdown-content.mega-dropdown {
      display: none; position: absolute; top: 100%; left: 50%; transform: translateX(-50%);
      background: #fff; min-width: 580px; max-width: 85vw;
      box-shadow: 0 12px 32px rgba(0,0,0,0.12); border-radius: 10px;
      margin-top: 4px; z-index: 999; padding: 24px 32px;
    }
    .dropdown:hover .dropdown-content.mega-dropdown { display: block; }
    .mega-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 36px; }
    .mega-heading { font-size: 1.05rem; font-weight: 700; margin: 0 0 10px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; }
    .mega-column a { display: block; padding: 8px 0; transition: all 0.2s; }
    .mega-column a:hover { color: #0a58ca; padding-left: 6px; }
    .mega-desc { font-size: 0.875rem; font-weight: 400; color: #666; margin: 4px 0 20px 0; line-height: 1.45; }

    /* Hero */
    .master-hero {
      position: relative; background: #001428; padding: 160px 0 100px; overflow: hidden; color: white;
    }
    .master-hero::before {
      content: ''; position: absolute; inset: 0;
      background-image: linear-gradient(rgba(0,122,255,0.06) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(0,122,255,0.06) 1px, transparent 1px);
      background-size: 60px 60px;
    }
    .hero-inner {
      position: relative; z-index: 2; max-width: 900px; margin: 0 auto; padding: 0 24px; text-align: center;
    }
    .hero-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(0,122,255,0.12); border: 1px solid rgba(0,122,255,0.3);
      color: #60A5FA; font-size: 0.72rem; font-weight: 600;
      letter-spacing: 0.2em; text-transform: uppercase;
      padding: 6px 16px; border-radius: 4px; margin-bottom: 32px;
    }
    .hero-inner h1 {
      font-size: clamp(2.4rem, 5vw, 3.8rem); font-weight: 700; color: #fff;
      line-height: 1.1; letter-spacing: -0.02em; margin-bottom: 20px;
    }
    .hero-inner .lead {
      font-size: 1.05rem; color: rgba(255,255,255,0.7); max-width: 620px; margin: 0 auto 48px; line-height: 1.7;
    }

    /* Filter */
    .filter-bar {
      background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.06);
      border-radius: 12px; padding: 1.6rem 2rem;
      margin: -80px auto 60px; max-width: 1200px; position: relative; z-index: 10;
    }
    .filter-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;
    }
    .filter-grid select, .filter-grid input {
      padding: 10px 12px; border: 1px solid #D2D2D7; border-radius: 8px; font-size: 0.95rem;
    }

    /* Project Card */
    .project-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px; max-width: 1200px; margin: 0 auto; padding: 0 24px;
    }
    .project-card {
      background: #fff; border: 1px solid #E5E7EB; border-radius: 10px;
      padding: 20px; transition: all 0.25s ease; height: 100%; display: flex; flex-direction: column;
    }
    .project-card:hover {
      box-shadow: 0 15px 35px rgba(0,0,0,0.08); transform: translateY(-4px); border-color: #007AFF;
    }

    .card-header { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
    .pemda-logo {
      width: 48px; height: 48px; border-radius: 8px; overflow: hidden; flex-shrink: 0;
      border: 1px solid #E5E7EB;
    }
    .pemda-logo img { width: 100%; height: 100%; object-fit: contain; }

    .project-meta { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px; }
    .badge {
      font-size: 0.73rem; padding: 5px 12px; border-radius: 6px; font-weight: 600;
      background: white; color: #007AFF; border: 1px solid #007AFF;
    }

    .project-card h3 {
      font-size: 1.08rem; font-weight: 700; color: #001428; margin-bottom: 12px; line-height: 1.35;
    }

    .microsite-btn {
      margin-top: auto; padding: 11px 20px; background: #007AFF; color: white;
      font-weight: 600; font-size: 0.9rem; border-radius: 8px; text-decoration: none;
      display: flex; align-items: center; justify-content: center; gap: 8px;
      transition: all 0.25s ease;
    }
    .microsite-btn:hover { background: #0056CC; transform: translateY(-2px); }

    /* Modal Login */
    .modal {
      display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6);
      backdrop-filter: blur(10px); z-index: 2000; align-items: center; justify-content: center;
    }
    .modal.active { display: flex; }
    .modal-content {
      background: white; border-radius: 16px; width: 90%; max-width: 420px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    }
    .modal-header {
      padding: 20px 24px; display: flex; justify-content: space-between; align-items: center;
      border-bottom: 1px solid #e5e7eb;
    }
    .modal-title { font-size: 1.4rem; font-weight: 600; }
    .modal-close {
      background: none; border: none; font-size: 1.8rem; cursor: pointer; color: #6b7280;
    }
    .modal-body { padding: 24px; }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; margin-bottom: 6px; font-weight: 500; }
    .form-input {
      width: 100%; padding: 10px 14px; border: 1px solid #d1d5db;
      border-radius: 8px; font-size: 1rem; transition: all 0.2s;
    }
    .form-input:focus {
      outline: none; border-color: #007AFF; box-shadow: 0 0 0 3px rgba(0,122,255,0.1);
    }
    .btn-primary {
      width: 100%; padding: 12px; background: #001428; color: white;
      border: none; border-radius: 10px; font-weight: 600; cursor: pointer;
    }
    .btn-primary:hover { background: #003366; }

    @media (max-width: 992px) {
      .project-grid { grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); }
    }
    @media (max-width: 576px) {
      .project-grid { grid-template-columns: 1fr; }
    }
    </style>
</head>
<body>

<!-- Modal Login -->
<div id="signInModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title">Masuk</h3>
      <button class="modal-close" onclick="closeModal('signInModal')">×</button>
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

<!-- Header & Navbar -->
<header class="header">
  <div class="header-content">
    <div class="logo">
      <img src="<?= base_url('assets/img/logo.png') ?>" alt="LogoIDE">
      <span class="logo-text">Inti Desain Ekonomi Consultant</span>
    </div>
    <nav class="nav-menu">
      <!-- Navbar Anda yang lengkap (sama persis) -->
      <div class="dropdown">
        <a href="#about" class="dropbtn">Tentang <span class="arrow-down"></span></a>
        <div class="dropdown-content mega-dropdown">
          <div class="mega-grid">
            <div class="mega-column">
              <h4 class="mega-heading">Profil Perusahaan</h4>
              <a href="#sejarah">Sejarah & Visi Misi</a>
              <p class="mega-desc">Inti Desain Ekonomi Consultant berdiri sejak 2019 dengan fokus pada solusi ekonomi berkelanjutan.</p>
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

      <div class="dropdown">
        <a href="#services" class="dropbtn">Layanan <span class="arrow-down"></span></a>
        <div class="dropdown-content mega-dropdown">
          <div class="mega-grid">
            <div class="mega-column">
              <h4 class="mega-heading">Konsultasi</h4>
              <a href="#konsultasi-ekonomi">Konsultasi Ekonomi</a>
              <p class="mega-desc">Pendampingan strategis berbasis data ekonomi.</p>
              <h4 class="mega-heading">Survei & Penelitian</h4>
              <a href="MenuSurvei">Survei Kepuasan Masyarakat</a>
              <p class="mega-desc">Metode ilmiah dengan analisis mendalam.</p>
              <h4 class="mega-heading">MasterData</h4>
              <a href="MasterData">Repositori Data</a>
            </div>
          </div>
        </div>
      </div>

      <div class="dropdown">
        <a href="#portfolio" class="dropbtn">Portfolio <span class="arrow-down"></span></a>
        <div class="dropdown-content mega-dropdown">
          <div class="mega-grid">
            <div class="mega-column">
              <h4 class="mega-heading">Proyek Pemerintahan</h4>
              <a href="MenuPortofolio">Portofolio Proyek Selesai</a>
              <p class="mega-desc">Kerjasama dengan berbagai Pemerintah daerah di berbagai wilayah</p>
            </div>
          </div>
        </div>
      </div>

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

      <div class="dropdown">
        <a href="#" class="dropbtn" onclick="openModal('signInModal')">Masuk <span class="arrow-down"></span></a>
      </div>
    </nav>
  </div>
</header>

<!-- Hero -->
<section class="master-hero">
  <div class="hero-inner">
    <div class="hero-badge">MASTER DATA</div>
    <h1>Master Data <span>Proyek</span></h1>
    <p class="lead">Portal terintegrasi proyek riset dan konsultasi IDE Consultant</p>
  </div>
</section>

<!-- Filter -->
<div class="filter-bar">
  <div class="filter-grid">
    <div>
      <label style="font-size:0.85rem;color:#6B7280;margin-bottom:6px;display:block;">Tahun</label>
      <select id="filterTahun" class="form-select">
        <option value="">Semua Tahun</option>
      </select>
    </div>
    <div>
      <label style="font-size:0.85rem;color:#6B7280;margin-bottom:6px;display:block;">Kota / Kabupaten</label>
      <select id="filterWilayah" class="form-select">
        <option value="">Semua Daerah</option>
      </select>
    </div>
    <div>
      <label style="font-size:0.85rem;color:#6B7280;margin-bottom:6px;display:block;">Nama Dinas</label>
      <select id="filterDinas" class="form-select">
        <option value="">Semua Dinas</option>
      </select>
    </div>
    <div>
      <label style="font-size:0.85rem;color:#6B7280;margin-bottom:6px;display:block;">Cari Proyek</label>
      <input type="text" id="searchInput" class="form-control" placeholder="Ketik judul proyek...">
    </div>
  </div>
</div>

<!-- Project Grid -->
<section style="padding-bottom: 100px;">
  <div class="project-grid" id="projectGrid">
     <!-- === PROYEK 1 === -->
    <div class="project-card" data-tahun="2026" data-wilayah="Kab. Situbondo" data-dinas="Bappeda">
      <div class="card-header">
        <div class="pemda-logo">
          <img src="<?= base_url('assets/img/partner/kab.situbondo.jpg') ?>" alt="Kab Situbondo">
        </div>
      </div>
      <div class="project-meta">
        <span class="badge">2026</span>
        <span class="badge">Kab. Situbondo</span>
        <span class="badge">Bappeda</span>
      </div>
      <h3>LKPJ Bupati Kabupaten Situbondo Tahun 2025</h3>
      <a href="<?= base_url('IDE/LKPJSitubondo') ?>" class="microsite-btn" target="_blank">
        <i class="fa-solid fa-arrow-right"></i> Buka Microsite
      </a>
    </div>

    <!-- === PROYEK 2 === -->
    <div class="project-card" data-tahun="2026" data-wilayah="Kab. Banyuwangi" data-dinas="Bappeda">
      <div class="card-header">
        <div class="pemda-logo">
          <img src="<?= base_url('assets/img/partner/kab.banyuwangi.jpg') ?>" alt="Kab Banyuwangi">
        </div>
      </div>
      <div class="project-meta">
        <span class="badge">2026</span>
        <span class="badge">Kab. Banyuwangi</span>
        <span class="badge">Bappeda</span>
      </div>
      <h3>LKPJ Bupati Kabupaten Banyuwangi Tahun 2025</h3>
      <a href="<?= base_url('IDE/LKPJBanyuwangi') ?>" class="microsite-btn" target="_blank">
        <i class="fa-solid fa-arrow-right"></i> Buka Microsite
      </a>
    </div>

    <!-- === PROYEK 3 === -->
    <div class="project-card" data-tahun="2026" data-wilayah="Kab. Situbondo" data-dinas="Bappeda">
      <div class="card-header">
        <div class="pemda-logo">
          <img src="<?= base_url('assets/img/partner/kab.situbondo.jpg') ?>" alt="Kab Situbondo">
        </div>
      </div>
      <div class="project-meta">
        <span class="badge">2026</span>
        <span class="badge">Kab. Situbondo</span>
        <span class="badge">Bappeda</span>
      </div>
      <h3>Rencana Strategis Situbondo</h3>
      <a href="<?= base_url('IDE/RenstraSitubondo') ?>" class="microsite-btn" target="_blank">
        <i class="fa-solid fa-arrow-right"></i> Buka Microsite
      </a>
    </div>

    <!-- === PROYEK 4 === -->
    <div class="project-card" data-tahun="2026" data-wilayah="Kab. Banyuwangi" data-dinas="Bappeda">
      <div class="card-header">
        <div class="pemda-logo">
          <img src="<?= base_url('assets/img/partner/kab.banyuwangi.jpg') ?>" alt="Kab Banyuwangi">
        </div>
      </div>
      <div class="project-meta">
        <span class="badge">2026</span>
        <span class="badge">Kab. Banyuwangi</span>
        <span class="badge">Bappeda</span>
      </div>
      <h3>Rencana Strategis Banyuwangi</h3>
      <a href="<?= base_url('IDE/RenstraBanyuwangi') ?>" class="microsite-btn" target="_blank">
        <i class="fa-solid fa-arrow-right"></i> Buka Microsite
      </a>
    </div>

    <!-- === PROYEK 5 === -->
    <div class="project-card" data-tahun="2025" data-wilayah="Kab. Situbondo" data-dinas="Seluruh OPD">
      <div class="card-header">
        <div class="pemda-logo">
          <img src="<?= base_url('assets/img/partner/kab.situbondo.jpg') ?>" alt="Kab Situbondo">
        </div>
      </div>
      <div class="project-meta">
        <span class="badge">2025</span>
        <span class="badge">Kab. Situbondo</span>
        <span class="badge">OPD</span>
      </div>
      <h3>Survei IKM Situbondo</h3>
      <a href="<?= base_url('IDE/SurveiIKMSitubondo') ?>" class="microsite-btn" target="_blank">
        <i class="fa-solid fa-arrow-right"></i> Buka Microsite
      </a>
    </div>

    <!-- === PROYEK 6 === -->
    <div class="project-card" data-tahun="2025" data-wilayah="Kab. Situbondo" data-dinas="Bappeda">
      <div class="card-header">
        <div class="pemda-logo">
          <img src="<?= base_url('assets/img/partner/kab.situbondo.jpg') ?>" alt="Kab Situbondo">
        </div>
      </div>
      <div class="project-meta">
        <span class="badge">2025</span>
        <span class="badge">Kab. Situbondo</span>
        <span class="badge">Bappeda</span>
      </div>
      <h3>IPPD Kabupaten Situbondo</h3>
      <a href="<?= base_url('IDE/IPPDSitubondo') ?>" class="microsite-btn" target="_blank">
        <i class="fa-solid fa-arrow-right"></i> Buka Microsite
      </a>
    </div>

    <!-- === PROYEK 7 === -->
    <div class="project-card" data-tahun="2025" data-wilayah="Kab. Banyuwangi" data-dinas="Bappeda">
      <div class="card-header">
        <div class="pemda-logo">
          <img src="<?= base_url('assets/img/partner/kab.banyuwangi.jpg') ?>" alt="Kab Banyuwangi">
        </div>
      </div>
      <div class="project-meta">
        <span class="badge">2025</span>
        <span class="badge">Kab. Banyuwangi</span>
        <span class="badge">Bappeda</span>
      </div>
      <h3>IPPD Kabupaten Banyuwangi</h3>
      <a href="<?= base_url('IDE/IPPDBanyuwangi') ?>" class="microsite-btn" target="_blank">
        <i class="fa-solid fa-arrow-right"></i> Buka Microsite
      </a>
    </div>

    <div class="project-card" data-tahun="2025" data-wilayah="Kab. Banyuwangi" data-dinas="Dinas Sosial">
      <div class="card-header">
        <div class="pemda-logo">
          <img src="<?= base_url('assets/img/partner/kab.banyuwangi.jpg') ?>" alt="Kab Banyuwangi">
        </div>
      </div>
      <div class="project-meta">
        <span class="badge">2025</span>
        <span class="badge">Kab. Banyuwangi</span>
        <span class="badge">Dinas Sosial</span>
      </div>
      <h3>Renja - Renstra Kab Banyuwangi</h3>
      <a href="<?= base_url('IDE/DinasSosialBanyuwangi') ?>" class="microsite-btn" target="_blank">
        <i class="fa-solid fa-arrow-right"></i> Buka Microsite
      </a>
    </div>

    <div class="project-card" data-tahun="2025" data-wilayah="Kab. Ponorogo" data-dinas="Bappeda">
      <div class="card-header">
        <div class="pemda-logo">
          <img src="<?= base_url('assets/img/partner/kab.ponorogo.png') ?>" alt="Kab Ponorogo">
        </div>
      </div>
      <div class="project-meta">
        <span class="badge">2025</span>
        <span class="badge">Kab. Ponorogo</span>
        <span class="badge">Bappeda</span>
      </div>
      <h3>BPR Ponorogo</h3>
      <a href="<?= base_url('IDE/KabupatenPonorogo') ?>" class="microsite-btn" target="_blank">
        <i class="fa-solid fa-arrow-right"></i> Buka Microsite
      </a>
    </div>
  </div>
</section>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
var BaseURL = '<?= base_url() ?>';

// Modal Functions
function openModal(modalId) {
  document.getElementById(modalId).classList.add('active');
}
function closeModal(modalId) {
  document.getElementById(modalId).classList.remove('active');
}
window.onclick = function(event) {
  if (event.target.classList.contains('modal')) {
    closeModal(event.target.id);
  }
};

// ==================== FUNGSI LOGIN (Diperbaiki & Lebih Stabil) ====================
jQuery(document).ready(function($) {
  "use strict";

  // Enter key support
  $('#Username, #Password').on('keypress', function(e) {
    if (e.which === 13) {
      e.preventDefault();
      $('#Masuk').click();
    }
  });

  // Login Handler
  $("#Masuk").click(function() {
    var username = $("#Username").val().trim();
    var password = $("#Password").val().trim();

    if (!username || !password) {
      alert("Mohon isi username dan password.");
      return;
    }

    $("#Masuk").prop("disabled", true).text("Memproses...");

    $.post(BaseURL + "IDE/SignIn", { Username: username, Password: password })
      .done(function(response) {
        $("#Masuk").prop("disabled", false).text("Masuk");

        if (response === '1') {
          window.location = BaseURL + "SuperAdmin";
        } else if (response === '2') {
          window.location = BaseURL + "Admin";
        } else if (response === '3') {
          window.location = BaseURL + "Staf";
        } else if (response === '0') {
          window.location = BaseURL + "Econk";
        } else {
          alert(response || "Username atau password salah.");
        }
      })
      .fail(function() {
        $("#Masuk").prop("disabled", false).text("Masuk");
        alert("Gagal terhubung ke server. Silakan coba lagi.");
      });
  });
});

// ==================== AUTO FILTER ====================
document.addEventListener('DOMContentLoaded', function() {
  const cards = document.querySelectorAll('.project-card');

  const tahunSet = new Set();
  const wilayahSet = new Set();
  const dinasSet = new Set();

  cards.forEach(card => {
    const tahun = card.getAttribute('data-tahun');
    const wilayah = card.getAttribute('data-wilayah');
    const dinas = card.getAttribute('data-dinas');

    if (tahun) tahunSet.add(tahun);
    if (wilayah) wilayahSet.add(wilayah);
    if (dinas) dinasSet.add(dinas);
  });

  // Isi dropdown secara otomatis
  const filterTahun = document.getElementById('filterTahun');
  Array.from(tahunSet).sort((a,b) => b-a).forEach(tahun => {
    const opt = document.createElement('option');
    opt.value = tahun;
    opt.textContent = tahun;
    filterTahun.appendChild(opt);
  });

  const filterWilayah = document.getElementById('filterWilayah');
  Array.from(wilayahSet).sort().forEach(wilayah => {
    const opt = document.createElement('option');
    opt.value = wilayah.toLowerCase();
    opt.textContent = wilayah;
    filterWilayah.appendChild(opt);
  });

  const filterDinas = document.getElementById('filterDinas');
  Array.from(dinasSet).sort().forEach(dinas => {
    const opt = document.createElement('option');
    opt.value = dinas.toLowerCase();
    opt.textContent = dinas;
    filterDinas.appendChild(opt);
  });

  function filterProjects() {
    const search   = document.getElementById('searchInput').value.toLowerCase().trim();
    const tahun    = document.getElementById('filterTahun').value;
    const wilayah  = document.getElementById('filterWilayah').value.toLowerCase();
    const dinas    = document.getElementById('filterDinas').value.toLowerCase();

    cards.forEach(card => {
      const cTahun   = card.getAttribute('data-tahun');
      const cWilayah = card.getAttribute('data-wilayah').toLowerCase();
      const cDinas   = card.getAttribute('data-dinas').toLowerCase();
      const title    = card.querySelector('h3').textContent.toLowerCase();

      const matchSearch = !search || title.includes(search);
      const matchTahun  = !tahun || cTahun === tahun;
      const matchWilayah= !wilayah || cWilayah.includes(wilayah);
      const matchDinas  = !dinas || cDinas.includes(dinas);

      card.style.display = (matchSearch && matchTahun && matchWilayah && matchDinas) ? 'flex' : 'none';
    });
  }

  document.getElementById('searchInput').addEventListener('input', filterProjects);
  document.getElementById('filterTahun').addEventListener('change', filterProjects);
  document.getElementById('filterWilayah').addEventListener('change', filterProjects);
  document.getElementById('filterDinas').addEventListener('change', filterProjects);
});
</script>

</body>
</html>