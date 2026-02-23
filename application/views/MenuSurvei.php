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

    /* Header */
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
    .nav-menu { display: flex; list-style: none; gap: 32px; margin-left: auto; align-items: center; }
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

    /* Dropdown Mega Menu */
    .dropdown { position: relative; }
    .dropbtn { font-weight: 600; cursor: pointer; }
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

    /* Hero - Survei */
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
      -webkit-text-fill-color: transparent;
    }
    .hero-inner .lead {
      font-size: 1.05rem;
      color: rgba(255,255,255,0.7);
      max-width: 620px;
      margin: 0 auto 48px;
      line-height: 1.7;
    }
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
      color: rgba(255,255,255,0.5);
    }

    /* Survey Content */
    .survey-content {
      background: #F7F8FA;
      padding: 80px 24px;
    }
    .survey-content-inner {
      max-width: 960px;
      margin: 0 auto;
    }
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

    .survey-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
      gap: 28px;
    }

    .survey-card {
      background: #fff;
      border: 1px solid #E5E7EB;
      border-radius: 12px;
      padding: 36px 32px;
      position: relative;
      overflow: hidden;
      transition: all 0.28s ease;
      text-decoration: none;
      color: inherit;
      display: block;
    }
    .survey-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 50px rgba(0,20,50,0.12);
      border-color: #60A5FA;
    }
    .survey-card::before {
      content: '';
      position: absolute;
      left: 0; top: 0; bottom: 0;
      width: 4px;
      background: linear-gradient(180deg, #007AFF, #0056b3);
      opacity: 0.4;
      transition: opacity 0.3s ease;
    }
    .survey-card:hover::before { opacity: 1; }

    .survey-card h2 {
      font-size: 1.28rem;
      font-weight: 700;
      color: #001428;
      margin-bottom: 16px;
      line-height: 1.3;
    }
    .survey-card p {
      font-size: 0.94rem;
      color: #4B5563;
      line-height: 1.7;
      margin-bottom: 24px;
    }
    .survey-card .btn-view {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: #007AFF;
      font-weight: 600;
      font-size: 0.92rem;
    }
    .survey-card:hover .btn-view {
      color: #0056b3;
    }
    .survey-card .btn-view::after {
      content: '→';
      transition: transform 0.3s ease;
    }
    .survey-card:hover .btn-view::after {
      transform: translateX(4px);
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
    }
    .social-links-container {
      display: flex;
      justify-content: center;
      gap: 16px;
      flex-wrap: wrap;
    }
    .social-link img {
      width: 32px;
      height: 32px;
      object-fit: contain;
      filter: brightness(100%);
      transition: filter 0.3s ease;
    }
    .social-link:hover img {
      filter: brightness(120%);
    }

    @media (max-width: 992px) {
      .mega-dropdown { min-width: 320px; padding: 20px; left: 0; transform: none; }
      .mega-grid { grid-template-columns: 1fr; gap: 28px; }
      .survey-grid { grid-template-columns: 1fr; }
      .contact-content { grid-template-columns: 1fr; }
      .contact-info { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
      .nav-menu { display: none; }
      .hero-stats { flex-direction: column; }
      .hero-stat { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.08); }
      .hero-stat:last-child { border-bottom: none; }
    }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <a href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="LogoIDE">
                </a>
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
                      <a href="<?= base_url('IDE/MenuSurvei') ?>">Survei Kepuasan Masyarakat</a>
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
                  <!-- isi sesuai kebutuhan -->
                </div>
              </div>

              <div class="dropdown">
                <a href="#team" class="dropbtn">Tim <span class="arrow-down"></span></a>
                <div class="dropdown-content mega-dropdown">
                  <!-- isi sesuai kebutuhan -->
                </div>
              </div>

              <a href="#" class="dropbtn" onclick="openModal('signInModal')">Masuk</a>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="survey-hero">
        <div class="hero-inner">
            <div class="hero-badge">SURVEI IKM</div>
            <h1>Survei Indeks Kepuasan Masyarakat</h1>
           <p class="lead">
                Silakan berpartisipasi dalam Survei Indeks Kepuasan Masyarakat (IKM) 
                dengan mengisi kuesioner sesuai daerah layanan yang Anda gunakan.
            </p>
        </div>
    </section>

    <!-- Daftar Survei -->
    <section class="survey-content">
        <div class="survey-content-inner">

            <div class="section-eyebrow">
                <span class="tag">DAFTAR SURVEI AKTIF</span>
                <h2>Formulir Survei Indeks Kepuasan Masyarakat</h2>
                <p>Klik pada kartu di bawah ini untuk mengisi Survei Indeks Kepuasan Masyarakat sesuai dengan daerah layanan yang Anda akses.</p>
            </div>

            <div class="survey-grid">

                <a href="<?= base_url('IDE/SurveiIKMSitubondo') ?>" class="survey-card">
                    <h2>Survei IKM Situbondo</h2>
                    <div class="btn-view">Lihat Laporan Lengkap </div>
                </a>

                <a href="<?= base_url('IDE/SurveiIKMYogyakarta') ?>" class="survey-card">
                    <h2>Survei IKM Yogyakarta</h2>
                    <div class="btn-view">Lihat Laporan Lengkap </div>
                </a>

            </div>
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
    <script>
        document.getElementById('current-year').textContent = new Date().getFullYear();

        function openModal(modalId) {
            // Jika ada modal sign in, bisa ditambahkan logika di sini
            console.log('Open modal: ' + modalId);
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