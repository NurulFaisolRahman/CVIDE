<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

  
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
/* ── Dropdown – Lebar fleksibel menyesuaikan isi ────────────────────── */
.dropdown {
  position: relative;
}

.dropdown-content.mega-dropdown {
  display: none;
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  background: #fff;
  width: max-content;                /* Lebar otomatis menyesuaikan konten */
  min-width: 320px;                   /* Batas minimum agar tidak terlalu sempit */
  max-width: 90vw;                    /* Batas maksimum agar tidak keluar layar */
  box-shadow: 0 12px 32px rgba(0,0,0,0.12);
  border-radius: 10px;
  margin-top: 4px;
  z-index: 999;
  padding: 24px 28px;                 /* Padding sedikit lebih kecil & simetris */
}

.dropdown:hover .dropdown-content.mega-dropdown {
  display: block;
}

.mega-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Kolom otomatis menyesuaikan */
  gap: 32px;                          /* Jarak antar kolom lebih fleksibel */
}

.mega-heading {
  font-size: 1.05rem;
  font-weight: 700;
  margin: 0 0 10px 0;
  padding-bottom: 8px;
  border-bottom: 1px solid #eee;
  white-space: nowrap;                /* Hindari wrap pada heading panjang */
}

.mega-column a {
  display: block;
  padding: 8px 0;
  transition: all 0.2s;
  white-space: nowrap;                /* Teks link tidak wrap */
}

.mega-column a:hover {
  color: #0a58ca;
  padding-left: 6px;
}

.mega-desc {
  font-size: 0.875rem;
  font-weight: 400;
  color: #666;
  margin: 4px 0 20px 0;
  line-height: 1.45;
  max-width: 320px;                   /* Batasi lebar deskripsi agar rapi */
}

/* Responsif mobile */
@media (max-width: 992px) {
  .dropdown-content.mega-dropdown {
    left: 0;
    transform: none;
    width: 90vw;
    max-width: 420px;
    padding: 20px;
  }

  .mega-grid {
    grid-template-columns: 1fr;
    gap: 28px;
  }
}

    .portfolio-hero {
      position: relative;
      background: #001428;
      padding: 160px 0 100px;
      overflow: hidden;
    }
    .portfolio-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(0,122,255,0.06) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,122,255,0.06) 1px, transparent 1px);
      background-size: 60px 60px;
    }
    .portfolio-hero::after {
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
    }
    .hero-inner .lead {
      font-size: 1.05rem;
      color: rgba(255,255,255,0.6);
      max-width: 580px;
      margin: 0 auto 48px;
      line-height: 1.7;
      font-weight: 400;
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
      color: rgba(255,255,255,0.4);
    }

    .portfolio-content {
      background: #F7F8FA;
      padding: 80px 24px;
    }
    .portfolio-content-inner {
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

    /* Filter Container - Versi lebih presisi & enterprise */
.filter-container {
  display: flex;
  justify-content: flex-start;           /* rata kiri */
  align-items: center;
  margin: 0 auto 48px auto;
  max-width: 960px;                      /* selaras dengan konten utama */
  padding: 0 24px;
}

.filter-select {
  min-width: 160px;
  max-width: 220px;
  padding: 8px 32px 8px 12px;            /* ruang untuk arrow custom */
  font-size: 0.875rem;
  line-height: 1.25rem;
  border: 1px solid #CBD5E1;
  border-radius: 6px;
  background: #FFFFFF;
  color: #1E293B;
  cursor: pointer;
  transition: all 0.2s ease;
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236B7280' d='M2 4l4 4 4-4H2z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 12px center;
  box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}

.filter-select:focus {
  outline: none;
  border-color: #3B82F6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  background-color: #F8FAFC;
}

/* Responsive */
@media (max-width: 640px) {
  .filter-container {
    padding: 0 16px;
    justify-content: center;
  }
  .filter-select {
    width: 100%;
    max-width: none;
  }
}

    .portfolio-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }
    .portfolio-card {
      background: #fff;
      border: 1px solid #E5E7EB;
      border-radius: 12px;
      padding: 36px 32px;
      position: relative;
      overflow: hidden;
      transition: box-shadow 0.25s ease, transform 0.25s ease, border-color 0.25s ease;
    }
    .portfolio-card:hover {
      box-shadow: 0 20px 50px rgba(0,20,50,0.1);
      transform: translateY(-4px);
      border-color: rgba(0,122,255,0.2);
    }
    .portfolio-card::before {
      content: '';
      position: absolute;
      left: 0; top: 24px; bottom: 24px;
      width: 3px;
      background: linear-gradient(180deg, #007AFF, #001F3F);
      border-radius: 0 2px 2px 0;
      opacity: 0;
      transition: opacity 0.25s ease;
    }
    .portfolio-card:hover::before { opacity: 1; }

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
    .status-completed {
      color: #059669;
      background: rgba(5,150,105,0.08);
      border: 1px solid rgba(5,150,105,0.2);
    }
    .status-completed::before {
      content: '';
      width: 5px; height: 5px;
      border-radius: 50%;
      background: #059669;
    }

    .portfolio-card h2 {
      font-size: 1.05rem;
      font-weight: 700;
      color: #001428;
      margin-bottom: 12px;
      line-height: 1.3;
    }
    .portfolio-card p {
      font-size: 0.875rem;
      color: #6B7280;
      line-height: 1.75;
    }

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

    .no-results {
      text-align: center;
      font-size: 1.2rem;
      color: #6B7280;
      padding: 60px 20px;
      display: none;
    }

    .portfolio-footer-strip {
      background: #001428;
      padding: 64px 24px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .portfolio-footer-strip::before {
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
    }
    .btn-enterprise:hover {
      background: #0056CC;
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(0,122,255,0.35);
      color: #fff;
    }

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

    .modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.6);
      backdrop-filter: blur(10px);
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
      border-bottom: 1px solid #e5e7eb;
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
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.2s;
    }
    .form-input:focus {
      outline: none;
      border-color: #007AFF;
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
    .btn-primary:hover { background: #003366; }

    @media (max-width: 992px) {
      .mega-dropdown { min-width: 320px; padding: 20px; left: 0; transform: none; }
      .mega-grid { grid-template-columns: 1fr; gap: 28px; }
    }
    @media (max-width: 768px) {
      .portfolio-grid { grid-template-columns: 1fr; }
      .hero-stats { flex-direction: column; }
      .hero-stat { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.08); }
      .hero-stat:last-child { border-bottom: none; }
      .nav-menu { display: none; }
      .contact-content { grid-template-columns: 1fr; }
      .contact-info { grid-template-columns: 1fr; }
    }

    .whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 30px;
    right: 30px;
    background-color: #25D366;
    color: #fff;
    border-radius: 50%;
    z-index: 1000;
    
    /* Memastikan konten di tengah sempurna */
    display: flex;
    align-items: center;
    justify-content: center;
    
    /* Efek visual */
    text-decoration: none; /* Penting agar tidak ada garis bawah link */
    box-shadow: 0 10px 25px rgba(37, 211, 102, 0.3); /* Shadow mengikuti warna hijau agar soft */
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Transisi agak membal (bouncy) */
}

.whatsapp-float:hover {
    transform: scale(1.1) translateY(-5px); /* Sedikit bergeser ke atas saat hover */
    background-color: #128C7E; /* Hijau WhatsApp yang lebih gelap untuk kontras hover */
    color: #fff;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
}

.whatsapp-float i {
    font-size: 32px; /* Ukuran disesuaikan agar proporsional di dalam lingkaran 60px */
    line-height: 0; /* Menghilangkan gap ekstra dari font-awesome */
}

/* Responsif untuk mobile */
@media (max-width: 768px) {
    .whatsapp-float {
        width: 50px;
        height: 50px;
        bottom: 20px;
        right: 20px;
    }
    
    .whatsapp-float i {
        font-size: 28px;
    }
}
    </style>
</head>
<body>

<!-- Sign In Modal -->
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

<a href="https://wa.me/6282227666283?text=Halo%20Admin%20IDE%20Consultant,%20saya%20ingin%20bertanya..." 
   class="whatsapp-float" 
   target="_blank" 
   rel="noopener noreferrer"
   aria-label="Chat via WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<!-- Header & Navbar -->
<!-- Header -->
  <header class="header">
    <div class="header-content">
      <div class="logo">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="LogoIDE">
        <span class="logo-text">Inti Desain Ekonomi Consultant</span>
      </div>
      <nav class="nav-menu">
  <!-- Tentang -->
  <div class="dropdown">
    <a href="#about" class="dropbtn">
      Tentang <span class="arrow-down"></span>
    </a>
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

  <!-- Layanan – sudah dihapus Penyusunan Dokumen & Pelatihan -->
  <div class="dropdown">
    <a href="#services" class="dropbtn">
      Layanan <span class="arrow-down"></span>
    </a>
    <div class="dropdown-content mega-dropdown">
      <div class="mega-grid">
        <div class="mega-column">
          <h4 class="mega-heading">Konsultasi</h4>
          <a href="#konsultasi-ekonomi">Konsultasi Ekonomi</a>
          <p class="mega-desc">Pendampingan strategis berbasis data ekonomi.</p>
          <h4 class="mega-heading">Survei & Penelitian</h4>
          <a href="MenuSurvei">Survei Kepuasan Masyarakat</a>
          <p class="mega-desc">Metode ilmiah dengan analisis mendalam.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio – sudah dihapus Proyek Swasta -->
  <div class="dropdown">
    <a href="#portfolio" class="dropbtn">
      Portfolio <span class="arrow-down"></span>
    </a>
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

  <!-- Tim -->
  <div class="dropdown">
    <a href="#team" class="dropbtn">
      Tim <span class="arrow-down"></span>
    </a>
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
      Masuk <span class="arrow-down"></span>
    </a>
  </div>
</nav>
  </header>
<!-- Hero -->
<section class="portfolio-hero">
  <div class="hero-inner">
    <div class="hero-badge">PORTFOLIO</div>
    <h1>Portofolio <span>Proyek</span></h1>
    <p class="lead">
      Lebih dari 41 proyek nyata telah kami selesaikan bersama pemerintah daerah dan Instansi terkait
      menghasilkan kebijakan berbasis bukti dan dampak ekonomi yang terukur.
    </p>
    <div class="hero-stats">
      <div class="hero-stat">
        <span class="val">7+ Tahun </span>
        <span class="lbl">Berpengalaman Sejak 2019</span>
      </div>
      <div class="hero-stat">
        <span class="val">41+</span>
        <span class="lbl">Proyek Selesai</span>
      </div>
    </div>
  </div>
</section>

<!-- Portfolio Content dengan Filter -->
<section class="portfolio-content">
  <div class="portfolio-content-inner">
   <div class="section-eyebrow">
  <h2>Portofolio Proyek </h2>
  <p>Daftar proyek yang telah berhasil kami laksanakan hingga tuntas bersama entitas pemerintah — menciptakan fondasi kebijakan yang kokoh, optimalisasi sumber daya, serta kontribusi terukur terhadap pertumbuhan ekonomi berkelanjutan.</p>
</div>

    <div class="filter-container">
  <select id="yearFilter" class="filter-select">
    <option value="all">Semua Tahun</option>
  </select>
</div>

    <div id="noResults" class="no-results">Tidak ada proyek untuk tahun yang dipilih.</div>

    <div class="portfolio-grid" id="portfolioGrid">

      <!-- Proyek 1 -->
      <div class="portfolio-card" data-year="2019">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <span class="card-status status-completed">2019</span>
        </div>
        <h2>Penyusunan Profil Dinas Tenaga Kerja & Transmigrasi</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">050/4810/429.107/2019</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Dinas Tenaga Kerja dan Transmigrasi Kab. Banyuwangi</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">30 Hari</span>
          </div>
        </div>
      </div>

      <!-- Proyek 2 -->
      <div class="portfolio-card" data-year="2019">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2019</span>
        </div>
        <h2>Analisa Potensi dan Strategi Pengembangan Pariwisata WPP III Sukamade</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/1127/429.201/2019</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Badan Perencanaan
Pembangunan Daerah
(Bappeda) Kabupaten
Banyuwangi
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">45 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2019">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2019</span>
        </div>
        <h2>Roadmap Optimalisasi Ekonomi Lokal
Melalui Potensi Desa</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/4328/429.201/2019 </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Badan Perencanaan
Pembangunan Daerah
(Bappeda) Kabupaten
Banyuwangi
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2019">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2019</span>
        </div>
        <h2>Kajian Pengembangan Kawasan
Kampung Kreatif Opak Gambir
dan Triple Organik Terintegrasi
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/08/SP/410.300.3/2019  </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Kecamatan Sananwetan

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2020">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2020</span>
        </div>
        <h2>Capaian Perangkat Daerah
Kabupaten Banyuwangi
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/945/KONTRAK/429.201/2020 </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Badan Perencanaan
Pembangunan Daerah
(Bappeda) Kabupaten
Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2020">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2020</span>
        </div>
        <h2>Strategi Penanggulangan
Kemiskinan Daerah Kabupaten
Banyuwangi Tahun 2020
-2024 
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/1440/429.201/2020  </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Badan Perencanaan
Pembangunan Daerah
(Bappeda) Kabupaten
Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2020">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2020</span>
        </div>
        <h2>Analisa Proyeksi Makro Ekonomi
Kabupaten Banyuwangi 
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/1298/429.201/2020 </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Badan Perencanaan
Pembangunan Daerah
(Bappeda) Kabupaten
Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">90 Hari</span>
          </div>
        </div>
      </div>

      
      <div class="portfolio-card" data-year="2020">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2020</span>
        </div>
        <h2>Penyusunan Profil Dinas Sosial,
Pemberdayaan Perempuan Dan
Keluarga Berencana Kabupaten
Banyuwang
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">050/1443/429.109/2020 </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Dinas Sosial,
Pemberdayaan
Perempuan Dan Keluarga
Berencana
Kabupaten Banyuwangi


</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

       <div class="portfolio-card" data-year="2020">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2020</span>
        </div>
        <h2>Pemutakhiran dan Penyempurnaan
Dokumen Rancangan Pengembangan
Industri Kabupaten (RPIK)
Kabupaten Banyuwangi Tahun
2020
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">050/6014/429.106/2020 </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Dinas Tenaga Kerja
Transmigrasi dan
Perindustrian Kabupaten
Banyuwangi



</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">45 Hari</span>
          </div>
        </div>
      </div>
        
      <div class="portfolio-card" data-year="2020">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2020</span>
        </div>
        <h2>Penyusunan Analisa dan Kajian
Pembangunan Perindustrian Koperasi
Usaha Mikro Tenaga Kerja dan
Penanaman Modal (Penyusunan
Kajian Toko
Modern)
2020
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/4846/429.201/2020</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Badan Perencanaan
Pembangunan Daerah
(Bappeda) Kabupaten
Banyuwangi
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2020">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2020</span>
        </div>
        <h2>Pengukuran Indeks Kepuasan
Masyarakat Terhadap Layanan
Pemerintah Desa

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/1229/429.013/2020</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Sekretariat Daerah
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2021">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2021</span>
        </div>
        <h2>Penyusunan Laporan Keterangan
Pertanggungjawaban Bupati


</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/0466/KONTRAK/429
.201/2021</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Badan Perencanaan
Pembangunan Daerah
Kab Banyuwangi
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2021">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2021</span>
        </div>
        <h2>Analisis Pemekaran Desa
Kabupaten Banyuwangi Tahun
2021
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/328/429.031/2021 </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Sekretariat Daerah
Kabupaten Banyuwangi
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2021">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2021</span>
        </div>
        <h2>Penyusunan Dokumen Rencana
Penanggulangan Kemiskinan
Daerah (RKPD) Kabupaten
Banyuwangi Tahun
2021 - 2026
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/4196/429.201/2021 </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Badan Perencanaan
Pembangunan Daerah
Kab Banyuwangi
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">45 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2021">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2021</span>
        </div>
        <h2>Penyusunan Dokumen RPKP
Kawasan Pedesaan Selingkar
Sukomade

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/1296/429.201/2021  </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Badan Perencanaan
Pembangunan Daerah
Kab Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">90 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2021">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2021</span>
        </div>
        <h2>Indeks Kepuasan Masyarakat
Terhadap Layanan Pemerintahan
Desa Kab
Banyuwangi 2021
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/1569/429.031/2021</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Sekretariat Daerah
Kabupaten Banyuwangi
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2022">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2022</span>
        </div>
        <h2>Analisa Indeks Pembangunan
Manusia Kabupaten Banyuwangi
2022
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/0782/429.201/2022</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Badan Perencanaan
Pembangunan Daerah
Kab Banyuwangi
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">75 Hari</span>
          </div>
        </div>
      </div>   
      
      <div class="portfolio-card" data-year="2022">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2022</span>
        </div>
        <h2>Evaluasi Efektivitas dan Evisiensi
Pelaksanaan Program BPNT
Kabupaten
Banyuwangi

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">050/4164/429.109/2022 </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Dinsos Kab Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">45 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2022">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2022</span>
        </div>
        <h2>Indeks Kepuasan Masyarakat Terhadap Layanan Pemerintah Desa
Kabupaten Banyuwangi
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/4849/429.114/2022 </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Dinas Pemberdayaan Masyarakat dan Desa
Kabupaten Banyuwangi
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2022">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2022</span>
        </div>
        <h2>Kajian Penyusunan Analisis Jabatan
Dan Beban Kerja Di Lingkungan
Pemkab
Banyuwangi
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">050/1244/429.034.2022 </span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Sekretariat Daerah
Kabupaten Banyuwangi
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">45 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2022">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2022</span>
        </div>
        <h2>Kajian Kelayakan Feasibility Study
Pembangunan UPT. PLUT 
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/3267/417.513.4/2022
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Dinas Koperasi, Usaha
Kecil Menengah,
Perindustrian dan
Perdagangan Kota
Mojokerto
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">30 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2022">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2022</span>
        </div>
        <h2>Survey IKM Dinas KOMINFO
Kabupaten Banyuwangi 
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/7628/429.116/2022
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Dinas KOMINFO Kab
Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">30 Hari</span>
          </div>
        </div>
      </div> 

 <div class="portfolio-card" data-year="2023">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2023</span>
        </div>
        <h2>Penyusunan Laporan Keterangan
Pertanggungjawaban Bupati
Banyuwangi Tahun 2022
 
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/552/KONTRAK/429.
201/2023
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">BAPPEDA Kabupaten
Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2023">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2023</span>
        </div>
        <h2>Analisis Pengelolaan Parkir
Berlangganan di Kabupaten
Banyuwani Tahun 2023
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/1054/428.109/2023 
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Dinas Perhubungan
Kabupaten Banyuwangi
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2023">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2023</span>
        </div>
        <h2>Pengadaan Konsultasi Penyusunan
Laporan Kinerja DPRD
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/121/416-
050/PPK/III/2023  
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">Sekretariat DPRD
Kabupaten Mojokerto
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2023">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2023</span>
        </div>
        <h2>Kajian Monitoring dan Evaluasi
Inovasi Kanggo Riko dan Warung
Naik Kelas (Wenak)
Kabupaten Banyuwangi

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">050/757/429.034/2023
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Sekretariat Daerah
Kabupaten Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2023">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2023</span>
        </div>
        <h2>Survey IKM KOMINFO Kabupaten
Banyuwangi 2023

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/7376/429.116/2023
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
KOMINFO Kab
Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2023">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2023</span>
        </div>
        <h2>Indeks Perencanaan
Pembangunan Daerah
Kabupaten Situbondo

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/886.2/PPK/431.401.
1/2023

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Badan Perencanaan
Pembangunan Daerah
Kabupaten Situbondo

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">30 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2023">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2023</span>
        </div>
        <h2>Analisis Terhadap Rencana Bisnis
Perusahaan Air Minum Kabupaten
Banyuwangi Tahun
2020-2024

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/1967/429.021/2023

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Bagian Perekonomian
Sekretariat daerah Kab
Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">30 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2023">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2023</span>
        </div>
        <h2>Masterplan RSUD
Pesanggaran tipe D


</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/25951/429.112/2023
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Dinas Kesehatan
Kabupaten Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">25 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2023">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2023</span>
        </div>
        <h2>Masterplan RSUD
Pesanggaran tipe D


</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/25951/429.112/2023
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Dinas Kesehatan
Kabupaten Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">25 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2024">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2024</span>
        </div>
        <h2>Penyusunan Laporan
Pertanggungjawaban
Bupati Tahun 2023


</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/003-
LITBANGDALEV/429.201/2
024
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Badan Perencanaan
Pembangunan Daerah
Kabupaten Situbondo

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div> 

      <div class="portfolio-card" data-year="2024">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2024</span>
        </div>
        <h2>Belanja Jasa Konsultansi
Kajian Pelaksanaan
Manajemen Risiko, KPI
(Key Performance
Indikator) dan GCG
(GoodCorporate
Governance) Terhadap
Kinerja PUDAM
Kabupaten Banyuwangi
Tahun Anggaran 2024
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/003-
027/ 391 /429.021/2024 
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Bagian Perekonomian
Setda. Kabupaten
Banyuwangi


</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2024">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2024</span>
        </div>
        <h2>Penyusunan Informasi dan Analisis
Pasar IKM Berorientasi Ekspor di
Jawa Timur
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">000.3.2/676/125.3/2024
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Dinas Perindustrian Dan
Perdagangan Provinsi Jawa
Timur Bidang Pemberdayaan
Industri
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2025">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2025</span>
        </div>
        <h2>Penyusunan Laporan Keterangan
Pertanggungjawaban Bupati
Banyuwangi Akhir Tahun
Anggaran 2024

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">050/022-
LITBANGDALEV/429.201/20025

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Badan Perencanaan
Pembangunan Daerah
Kabupaten Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2025">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2025</span>
        </div>
        <h2>Penyusunan Laporan Keterangan
Pertanggungjawaban Bupati
Banyuwangi Akhir Tahun
Anggaran 2024

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">050/022-
LITBANGDALEV/429.201/20025

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Badan Perencanaan
Pembangunan Daerah
Kabupaten Banyuwangi


</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2025">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2025</span>
        </div>
        <h2>Penyusunan Dokumen
Perencanaan Pembangunan Daerah
Bidang Perekonomian Kabupaten
Banyuwangi

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">050/2715.1/429.201/2025
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Badan Perencanaan
Pembangunan Daerah
Kabupaten Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2025">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2025</span>
        </div>
        <h2>Penyusunan Dokumen Rencana
Strategis Dinas Sosial,
Pemberdayaan Perempuan dan
Keluarga Berencana Kabupaten
Banyuwangi Tahun 2025-2029
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">000.3.2/1997/429.109/2025 
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Dinas Sosial, Pemberdayaan
Perempuan dan Keluarga
Berencana Kabupaten
Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">60 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2025">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2025</span>
        </div>
        <h2>Penyusunan Dokumen Rencana
Strategis Dinas Koperasi, Usaha
Mikro, dan Perdagangan
Kabupaten Banyuwangi Tahun
2025-2029 

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">000.3.2/1289/429.107/2025
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Dinas Koperasi, Usaha Mikro,
dan Perdagangan Kabupaten
Banyuwangi

</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">90 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2025">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2025</span>
        </div>
        <h2>Penyusunan Dokumen Rencana
Strategis Dinas Tenaga Kerja
Transmigrasi dan Perindustrian
Kabupaten Banyuwangi Tahun
2025-2029

</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">027/334/429.106/2025
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Dinas Tenaga Kerja
Transmigrasi dan Perindustrian
Kabupaten Banyuwangi


</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">90 Hari</span>
          </div>
        </div>
      </div>

      <div class="portfolio-card" data-year="2025">
        <div class="card-header-row">
          <div class="card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <span class="card-status status-completed">2025</span>
        </div>
        <h2>Kajian Identifikasi Standar dan
Penyedia Bahan Baku Sentra IKM
Sepatu dan Sandal Kabupaten
Mojokerto
</h2>
        <div class="card-meta">
          <div class="meta-item">
            <span class="meta-key">Nomor</span>
            <span class="meta-val">000.3.2/1153/SPK/125.3/2025
</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Lembaga</span>
            <span class="meta-val">
Dinas Perindustrian dan
Perdagangan Provinsi Jawa
Timur


</span>
          </div>
          <div class="meta-item">
            <span class="meta-key">Waktu</span>
            <span class="meta-val">45 Hari</span>
          </div>
        </div>
      </div>


    </div>
  </div>
</section>

<!-- CTA Strip -->
<section class="portfolio-footer-strip">
  <div class="footer-strip-inner">
    <h3>Mari Wujudkan Pembangunan Berbasis Data Bersama</h3>
    <p>Kami siap menjadi mitra strategis Anda dalam menyusun kebijakan, melakukan penelitian, atau melaksanakan survei yang akurat dan berdampak nyata.</p>
    <a href="#contact" class="btn-enterprise">Hubungi Tim Kami</a>
  </div>
</section>

<!-- Contact Section -->
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

  // Modal functions
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

  // Login handler
  jQuery(document).ready(function($) {
    "use strict";

    $('#Username, #Password').on('keypress', function(e) {
      if (e.which === 13) {
        e.preventDefault();
        $('#Masuk').click();
      }
    });

    $("#Masuk").click(function() {
      const username = $("#Username").val().trim();
      const password = $("#Password").val().trim();

      if (!username || !password) {
        alert("Mohon isi username/email dan password dengan lengkap.");
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
          } else if (response === '0') {
            window.location = BaseURL + "Econk";
          } else {
            alert(response || "Username atau password salah. Silakan coba lagi.");
          }
        })
        .fail(function() {
          $("#Masuk").prop("disabled", false).text("Masuk");
          alert("Gagal terhubung ke server. Periksa koneksi Anda.");
        });
    });
  });

  // Filter & Sorting Portofolio (versi diperbaiki & otomatis apply)
  document.addEventListener('DOMContentLoaded', function() {
    const grid = document.getElementById('portfolioGrid');
    const yearFilter = document.getElementById('yearFilter');
    const noResults = document.getElementById('noResults');

    if (!grid || !yearFilter) return; // hindari error jika elemen tidak ada

    const cards = Array.from(grid.querySelectorAll('.portfolio-card'));

    // Kumpulkan tahun unik dan urutkan terbaru ke terlama
    const years = [...new Set(
      cards
        .map(card => card.dataset.year)
        .filter(y => y && !isNaN(parseInt(y)))
    )].sort((a, b) => parseInt(b) - parseInt(a));

    // Isi dropdown dengan tahun yang tersedia
    years.forEach(year => {
      const option = document.createElement('option');
      option.value = year;
      option.textContent = year;
      yearFilter.appendChild(option);
    });

    // Fungsi untuk filter kartu berdasarkan tahun yang dipilih
    function filterCards(selectedYear) {
      let visibleCount = 0;

      cards.forEach(card => {
        const cardYear = card.dataset.year;
        if (selectedYear === 'all' || cardYear === selectedYear) {
          card.style.display = '';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });

      // Tampilkan pesan jika tidak ada hasil
      noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    // Fungsi sorting kartu dari tahun terbaru ke terlama
    function sortCards() {
      const sortedCards = cards.sort((a, b) => {
        const yearA = parseInt(a.dataset.year) || 0;
        const yearB = parseInt(b.dataset.year) || 0;
        return yearB - yearA;
      });

      // Susun ulang DOM sesuai urutan terbaru
      sortedCards.forEach(card => grid.appendChild(card));
    }

    // Jalankan sorting dan tampilkan semua kartu saat halaman dimuat
    sortCards();
    filterCards('all'); // default: semua tahun

    // AUTO-APPLY filter saat dropdown berubah (tanpa tombol)
    yearFilter.addEventListener('change', function() {
      filterCards(this.value);
    });
  });

  // Tahun copyright
  document.getElementById("current-year").textContent = new Date().getFullYear();

  // Header scroll effect
  window.addEventListener('scroll', function() {
    const header = document.querySelector('.header');
    if (window.scrollY > 100) {
      header.style.background = 'rgba(255, 255, 255, 0.95)';
    } else {
      header.style.background = 'rgba(255, 255, 255, 0.8)';
    }
  });

  // Smooth scroll untuk anchor link
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