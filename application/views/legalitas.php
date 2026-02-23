<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    /* ── CSS Global (tidak diubah) ─────────────────────────── */
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

    /* ── Header (tidak diubah) ─────────────────────────────── */
    .header {
      position: fixed; top: 0; width: 100%;
      background: rgba(255,255,255,0.8);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
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

    /* ── Navbar dropdown (tidak diubah) ────────────────────── */
    .nav-menu { display: flex; align-items: center; gap: 1.8rem; }
    .nav-menu > a, .dropbtn, .mega-column a, .mega-heading, .mega-desc {
      font-family: inherit; font-size: 1rem; font-weight: 500; line-height: 1.5;
    }
    .dropbtn { font-weight: 600; }
    .mega-heading {
      font-size: 1.05rem; font-weight: 700; margin: 0 0 10px 0;
      padding-bottom: 8px; border-bottom: 1px solid #eee;
    }
    .mega-column a, .mega-desc { font-size: 0.94rem; color: #444; }
    .mega-desc { font-size: 0.875rem; font-weight: 400; color: #666; margin: 4px 0 20px 0; line-height: 1.45; }
    .dropdown { position: relative; }
    .dropdown-content.mega-dropdown {
      display: none; position: absolute; top: 100%; left: 50%; transform: translateX(-50%);
      background: #fff; min-width: 580px; max-width: 85vw;
      box-shadow: 0 12px 32px rgba(0,0,0,0.12); border-radius: 10px;
      margin-top: 4px; z-index: 999; padding: 24px 32px;
    }
    .dropdown:hover .dropdown-content.mega-dropdown { display: block; }
    .mega-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 36px; }
    .mega-column a { display: block; padding: 8px 0; transition: all 0.2s; }
    .mega-column a:hover { color: #0a58ca; padding-left: 6px; }
    .arrow-down { font-size: 0.75rem; margin-left: 5px; opacity: 0.8; }
    @media (max-width: 992px) {
      .mega-dropdown { min-width: 320px; padding: 20px; left: 0; transform: none; }
      .mega-grid { grid-template-columns: 1fr; gap: 28px; }
    }

    /* ══════════════════════════════════════════════════════════
       ENTERPRISE HERO — dimodifikasi
    ══════════════════════════════════════════════════════════ */
    .legal-hero {
      position: relative;
      background: #001428;
      padding: 160px 0 100px;
      overflow: hidden;
    }

    /* Geometric grid lines background */
    .legal-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(0,122,255,0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,122,255,0.06) 1px, transparent 1px);
      background-size: 60px 60px;
    }

    /* Accent glow */
    .legal-hero::after {
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
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

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

    /* Stats strip */
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

    /* ══════════════════════════════════════════════════════════
       LEGAL CONTENT SECTION — dimodifikasi
    ══════════════════════════════════════════════════════════ */
    .legal-content {
      background: #F7F8FA;
      padding: 80px 24px;
    }

    .legal-content-inner {
      max-width: 960px;
      margin: 0 auto;
    }

    /* Section header */
    .section-eyebrow {
      text-align: center;
      margin-bottom: 56px;
    }
    .section-eyebrow .tag {
      display: inline-block;
      font-size: 0.65rem;
      font-weight: 600;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      color: #007AFF;
      background: rgba(0,122,255,0.08);
      border: 1px solid rgba(0,122,255,0.2);
      padding: 5px 14px;
      border-radius: 4px;
      margin-bottom: 16px;
    }
    .section-eyebrow h2 {
      font-size: clamp(1.6rem, 3vw, 2.2rem);
      font-weight: 700;
      color: #001428;
      letter-spacing: -0.02em;
      margin-bottom: 12px;
    }
    .section-eyebrow p {
      font-size: 0.95rem;
      color: #6B7280;
      max-width: 500px;
      margin: 0 auto;
    }

    /* Legal cards grid */
    .legal-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }

    .legal-card {
      background: #fff;
      border: 1px solid #E5E7EB;
      border-radius: 12px;
      padding: 36px 32px;
      position: relative;
      overflow: hidden;
      transition: box-shadow 0.25s ease, transform 0.25s ease, border-color 0.25s ease;
    }
    .legal-card:hover {
      box-shadow: 0 20px 50px rgba(0,20,50,0.1);
      transform: translateY(-4px);
      border-color: rgba(0,122,255,0.2);
    }

    /* Left accent bar */
    .legal-card::before {
      content: '';
      position: absolute;
      left: 0; top: 24px; bottom: 24px;
      width: 3px;
      background: linear-gradient(180deg, #007AFF, #001F3F);
      border-radius: 0 2px 2px 0;
      opacity: 0;
      transition: opacity 0.25s ease;
    }
    .legal-card:hover::before { opacity: 1; }

    .card-header-row {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .card-icon {
      width: 44px; height: 44px;
      background: linear-gradient(135deg, #001F3F 0%, #0056b3 100%);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .card-icon svg { width: 22px; height: 22px; color: white; }

    .card-status {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.6rem;
      font-weight: 600;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      padding: 4px 10px;
      border-radius: 3px;
    }
    .status-active {
      color: #059669;
      background: rgba(5,150,105,0.08);
      border: 1px solid rgba(5,150,105,0.2);
    }
    .status-active::before {
      content: '';
      width: 5px; height: 5px;
      border-radius: 50%;
      background: #059669;
    }
    .status-process {
      color: #D97706;
      background: rgba(217,119,6,0.08);
      border: 1px solid rgba(217,119,6,0.2);
    }
    .status-process::before {
      content: '';
      width: 5px; height: 5px;
      border-radius: 50%;
      background: #D97706;
    }

    .legal-card h2 {
      font-size: 1.05rem;
      font-weight: 700;
      color: #001428;
      margin-bottom: 12px;
      line-height: 1.3;
    }
    .legal-card p {
      font-size: 0.875rem;
      color: #6B7280;
      line-height: 1.75;
    }

    /* Meta info row */
    .card-meta {
      display: flex;
      gap: 20px;
      margin-top: 20px;
      padding-top: 20px;
      border-top: 1px solid #F3F4F6;
    }
    .meta-item { display: flex; flex-direction: column; gap: 2px; }
    .meta-key {
      font-size: 0.6rem;
      font-weight: 600;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: #9CA3AF;
    }
    .meta-val {
      font-size: 0.78rem;
      font-weight: 600;
      color: #374151;
    }

    /* ── Bottom CTA strip ──────────────────────────────────── */
    .legal-footer-strip {
      background: #001428;
      padding: 64px 24px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .legal-footer-strip::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(0,122,255,0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,122,255,0.05) 1px, transparent 1px);
      background-size: 48px 48px;
    }
    .footer-strip-inner {
      position: relative;
      z-index: 1;
      max-width: 560px;
      margin: 0 auto;
    }
    .footer-strip-inner h3 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 12px;
    }
    .footer-strip-inner p {
      font-size: 0.9rem;
      color: rgba(255,255,255,0.55);
      margin-bottom: 32px;
      line-height: 1.7;
    }
    .btn-enterprise {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 32px;
      background: #007AFF;
      color: #fff;
      font-size: 0.8rem;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-decoration: none;
      border-radius: 8px;
      transition: all 0.25s ease;
      border: none;
      cursor: pointer;
    }
    .btn-enterprise:hover {
      background: #0056CC;
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(0,122,255,0.35);
      color: #fff;
    }
    .btn-back-ghost {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 32px;
      background: transparent;
      color: rgba(255,255,255,0.6);
      font-size: 0.8rem;
      font-weight: 500;
      text-decoration: none;
      border-radius: 8px;
      border: 1px solid rgba(255,255,255,0.15);
      transition: all 0.25s ease;
      margin-left: 12px;
    }
    .btn-back-ghost:hover {
      color: #fff;
      border-color: rgba(255,255,255,0.35);
    }

    /* ── Responsive ────────────────────────────────────────── */
    @media (max-width: 768px) {
      .legal-grid { grid-template-columns: 1fr; }
      .hero-stats { flex-direction: column; }
      .hero-stat { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.08); }
      .hero-stat:last-child { border-bottom: none; }
      .nav-menu { display: none; }
    }
    @media (max-width: 992px) {
      .mega-dropdown { min-width: 320px; padding: 20px; left: 0; transform: none; }
      .mega-grid { grid-template-columns: 1fr; gap: 28px; }
    }
     /* Contact Section */
    .ide-contact {
      background: #001F3F;
      padding: 80px 24px;
      position: relative;
      overflow: hidden;
      color: white;
    }

    .contact-container {
      max-width: 1200px;
      margin: 0 auto;
      position: relative;
      z-index: 2;
    }

    .contact-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .contact-header h2 {
      font-size: 1.8rem;
      margin-bottom: 12px;
      color: white;
    }

    .contact-header p {
      color: rgba(255, 255, 255, 0.85);
      max-width: 600px;
      margin: 0 auto;
      font-size: 15px;
    }

    .contact-content {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 32px;
      margin-top: 24px;
    }

    .contact-info {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }

    .office-info h3,
    .services h3,
    .links-column h3 {
      font-size: 1rem;
      color: white;
      margin-bottom: 12px;
      padding-bottom: 8px;
      border-bottom: 2px solid #007AFF;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .office-info p {
      color: rgba(255, 255, 255, 0.85);
      line-height: 1.7;
      margin-bottom: 12px;
      display: flex;
      align-items: flex-start;
      gap: 8px;
      font-size: 14px;
    }

    .office-info .icon {
      font-size: 1rem;
      margin-top: 0.15rem;
    }

    .services ul,
    .links-column ul {
      list-style: none;
      padding: 0;
    }

    .services li,
    .links-column li {
      color: rgba(255, 255, 255, 0.85);
      margin-bottom: 8px;
      padding-left: 1rem;
      position: relative;
      transition: all 0.3s ease;
      font-size: 14px;
    }

    .services li::before,
    .links-column li::before {
      content: "•";
      color: #007AFF;
      position: absolute;
      left: 0;
      font-weight: bold;
    }

    .services li:hover,
    .links-column li:hover {
      color: white;
      transform: translateX(5px);
    }

    .company-links {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }

    .copyright {
      text-align: center;
      margin-top: 32px;
      padding-top: 16px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: rgba(255, 255, 255, 0.6);
      font-size: 13px;
    }

    #current-year {
      font-weight: 500;
    }

    .social-links {
  margin-top: 24px;
}

.social-links h3 {
  font-size: 1rem;
  color: white;
  margin-bottom: 12px;
  padding-bottom: 8px;
  border-bottom: 2px solid var(--apple-blue);
  font-weight: 600;
  letter-spacing: 0.5px;
}

.social-links-container {
  display: flex;
  justify-content: center;
  gap: 16px;
  flex-wrap: wrap;
}

.social-link {
  display: inline-block;
  transition: transform 0.3s ease;
}

.social-link img {
  width: 32px;
  height: 32px;
  object-fit: contain;
  filter: brightness(100%);
  transition: filter 0.3s ease;
}

.social-link:hover {
  transform: translateY(-3px);
}

.social-link:hover img {
  filter: brightness(120%);
}

/* Responsive Design */
@media (max-width: 768px) {
  .social-links-container {
    gap: 12px;
  }

  .social-link img {
    width: 28px;
    height: 28px;
  }
}
    </style>
</head>
<body>

    <!-- ── Header & Navbar (tidak diubah) ─────────────────── -->
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <a><img src="assets/img/logo.png" alt="LogoIDE"></a>
                <span class="logo-text">Inti Desain Ekonomi Consultant</span>
            </div>
            <nav class="nav-menu">
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
                      <a href="IDE/SurveiIKMYogyakarta">Survei Kepuasan Masyarakat</a>
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

    <!-- ══════════════════════════════════════════════════════
         HERO — Enterprise Level
    ══════════════════════════════════════════════════════ -->
    <section class="legal-hero">
        <div class="hero-inner">
            <h1>Legalitas &amp; <span>Sertifikasi</span></h1>
            <p class="lead">
                Kami beroperasi secara sah, transparan, dan sesuai regulasi
                tertinggi di Indonesia — dengan dokumentasi penuh yang dapat diverifikasi.
            </p>
            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="val">2015</span>
                    <span class="lbl">Tahun Berdiri</span>
                </div>
                <div class="hero-stat">
                    <span class="val">4</span>
                    <span class="lbl">Dokumen Legal</span>
                </div>
                <div class="hero-stat">
                    <span class="val">ISO</span>
                    <span class="lbl">Dalam Proses</span>
                </div>
                <div class="hero-stat">
                    <span class="val">100%</span>
                    <span class="lbl">Terverifikasi</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════════════════════
         LEGAL CONTENT — Enterprise Card Grid
    ══════════════════════════════════════════════════════ -->
    <section class="legal-content">
        <div class="legal-content-inner">

            <div class="section-eyebrow">
                <span class="tag">Legalitas Usaha</span>
                <h2>Dokumen & Perizinan Resmi</h2>
                <p>Seluruh dokumen berikut dapat diverifikasi langsung melalui lembaga penerbit terkait.</p>
            </div>

            <div class="legal-grid">

                <!-- Card 1 -->
                <div class="legal-card">
                    <div class="card-header-row">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                        </div>
                        <span class="card-status status-active">Aktif</span>
                    </div>
                    <h2>Akta Pendirian CV</h2>
                    <p>CV Inti Desain Ekonomi Consultant didirikan secara resmi melalui Akta Notaris dan telah disahkan oleh Kementerian Hukum dan HAM Republik Indonesia. Status badan hukum ini menjamin bahwa seluruh operasional perusahaan berjalan sesuai ketentuan yang berlaku.</p>
                    <div class="card-meta">
                        <div class="meta-item">
                            <span class="meta-key">Nomor Akta</span>
                            <span class="meta-val">Akta No. XX / 2015</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-key">Tanggal</span>
                            <span class="meta-val">15 Maret 2015</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-key">Penerbit</span>
                            <span class="meta-val">Kemenkumham RI</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="legal-card">
                    <div class="card-header-row">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                            </svg>
                        </div>
                        <span class="card-status status-active">Aktif</span>
                    </div>
                    <h2>Nomor Induk Berusaha (NIB)</h2>
                    <p>Diterbitkan melalui sistem Online Single Submission (OSS) oleh Kementerian Investasi/BKPM. KBLI utama 70209 mencakup seluruh kegiatan konsultasi ekonomi, riset, dan pelatihan yang kami jalankan secara sah di seluruh wilayah Indonesia.</p>
                    <div class="card-meta">
                        <div class="meta-item">
                            <span class="meta-key">NIB</span>
                            <span class="meta-val">9120207742544</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-key">KBLI</span>
                            <span class="meta-val">70209</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-key">Sistem</span>
                            <span class="meta-val">OSS / BKPM</span>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="legal-card">
                    <div class="card-header-row">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <span class="card-status status-active">Aktif</span>
                    </div>
                    <h2>Terdaftar di Kamar Dagang Indonesia</h2>
                    <p>Sebagai anggota resmi KADIN Indonesia, kami berkomitmen untuk menjunjung tinggi integritas bisnis dan profesionalisme dalam setiap layanan. Dengan pendekatan yang berbasis data dan analisis mendalam, kami hadir sebagai mitra terpercaya bagi sektor publik maupun swasta dalam mewujudkan pertumbuhan ekonomi yang berkelanjutan dan terukur.</p>
                    <div class="card-meta">
                        <div class="meta-item">
                            <span class="meta-key">No KTA</span>
                            <span class="meta-val">24293573</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-key">Cakupan</span>
                            <span class="meta-val">Nasional</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-key">Status</span>
                            <span class="meta-val">Berlaku</span>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="legal-card">
                    <div class="card-header-row">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>
                            </svg>
                        </div>
                        <span class="card-status status-active">Aktif</span>
                    </div>
                    <h2>Sertifikat Badan Usaha</h2>
                    <p>Dalam menjalankan operasionalnya, CV Inti Desain Ekonomi Consultant senantiasa mengedepankan legalitas dan kualifikasi profesional. Perusahaan kami tercatat sebagai anggota aktif INKINDO dengan Nomor Akreditasi 03/009/310707 yang diterbitkan pada tahun 2025.
                        <br>Sub Layanan :<br><br>Studi Makro (1.SI.01)<br>Studi Kelayakan & Studi Mikro Lainnya (1.SI.02)<br>Studi Perencanaan Umum (1.SI.03)<br>Jasa Penelitian (1.SI.04)<br>
                    </p>
                    <div class="card-meta">
                        <div class="meta-item">
                            <span class="meta-key">No Sertifikat</span>
                            <span class="meta-val">1.SI-35.73-25-0719</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-key">Lembaga</span>
                            <span class="meta-val">IKATAN NASIONAL KONSULTAN INDONESIA</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-key">Jenis</span>
                            <span class="meta-val">Jasa Konsultan Non Konstruksi</span>
                        </div>
                    </div>
                </div>

                <div class="legal-card">
                    <div class="card-header-row">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>
                            </svg>
                        </div>
                        <span class="card-status status-process">Dalam Proses</span>
                    </div>
                    <h2>Sertifikasi Kompetensi ISO 9001:2015</h2>
                    <p>Dalam tahap akhir sertifikasi ISO 9001:2015 untuk Sistem Manajemen Mutu, serta sertifikasi kompetensi BNSP untuk bidang riset dan konsultasi. Komitmen ini merupakan bagian dari upaya berkelanjutan kami untuk memberikan layanan dengan standar internasional.</p>
                    <div class="card-meta">
                        <div class="meta-item">
                            <span class="meta-key">Standar</span>
                            <span class="meta-val">ISO 9001:2015</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-key">Lembaga</span>
                            <span class="meta-val">BNSP</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-key">Target</span>
                            <span class="meta-val">2025</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
<section id="contact" class="ide-contact">
    <div class="contact-container">
      <div class="contact-header">
        <h2>Hubungi Kami</h2>
        <p>CV Inti Desain Ekonomi (IDE) Consultant siap membantu Anda dengan solusi penelitian dan konsultasi kebijakan ekonomi profesional.</p>
      <br>
        <div class="social-links">
  <h3>Ikuti Sosial Media Kami</h3>
  <div class="social-links-container">
    <a href="https://www.tiktok.com/@intidesainekonomi?_t=ZS-8yox13fLDlf&_r=1" class="social-link" target="_blank">
      <img src="assets/img/TT.png" alt="TikTok">
    </a>
    <a href="https://www.instagram.com/intidesainekonomi?igsh=Zmx2bjk2NjNnNmllt" class="social-link" target="_blank">
      <img src="assets/img/instagram.png" alt="Instagram">
    </a>
    <!-- <a href="https://www.youtube.com/@ideconsultant" class="social-link" target="_blank">
      <img src="assets/img/youtube.png" alt="YouTube">
    </a> -->
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
   

    <!-- Script (tidak diubah) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    var BaseURL = '<?= base_url() ?>';

    function openModal(modalId) {
      document.getElementById(modalId).classList.add('active');
    }
    function closeModal(modalId) {
      document.getElementById(modalId).classList.remove('active');
    }
    window.onclick = function(event) {
      if (event.target.classList.contains('modal')) {
        event.target.classList.remove('active');
      }
    }

    window.addEventListener('scroll', function() {
      const header = document.querySelector('.header');
      if (window.scrollY > 100) {
        header.style.background = 'rgba(255, 255, 255, 0.95)';
      } else {
        header.style.background = 'rgba(255, 255, 255, 0.8)';
      }
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
    </script>
</body>
</html>