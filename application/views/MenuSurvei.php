<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes" name="viewport">
  <title><?= $title ?? 'Portal Layanan Survei | IDE Consultant' ?></title>
  <meta content="Layanan instrumen survei terpadu dan riset kebijakan profesional oleh CV Inti Desain Ekonomi Consultant" name="description">
  <meta content="survei, ikm, riset kebijakan, kepuasan masyarakat, pelayanan publik, evaluasi daerah, ide consultant" name="keywords">
  
  <!-- Favicons (Logo IDE - Google Search & Multi-Device Compliant) -->
  <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets/img/android-chrome-192x192.png') ?>">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets/img/favicon-96x96.png') ?>">
  <link rel="icon" type="image/png" sizes="48x48" href="<?= base_url('assets/img/favicon-48x48.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/img/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/img/favicon-16x16.png') ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/img/apple-touch-icon.png') ?>">
  <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
  <link rel="manifest" href="<?= base_url('site.webmanifest') ?>">

  <!-- Google Fonts: Poppins (Lugx signature font) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- jQuery & SweetAlert2 -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- Leaflet.js & OpenStreetMap CSS/JS for Interactive GIS Geospasial Infographics -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- QRCode.js & html2canvas for Automatic QR Code & Publication Banner Generation -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <!-- RTKD Multi-Instrument Dynamic Survey Stylesheet & Engine -->
  <link rel="stylesheet" href="<?= base_url('assets/css/survei_rtkd.css') ?>?v=<?= time() ?>">
  <script src="<?= base_url('assets/js/survei_rtkd_engine.js') ?>?v=<?= time() ?>"></script>

  <style>
    /* ==========================================================================
       LUGX GAMING DESIGN SYSTEM TEMPLATE (Adapted for IDE Consultant)
       Page: Menu Survei IKM
       ========================================================================== */
    :root {
      --lugx-blue: #043168ff;
      --lugx-blue-dark: #0b3977ff;
      --lugx-red: #b40814ff;
      --lugx-red-hover: #b00a15ff;
      --lugx-dark: #1e1e1e;
      --lugx-dark-card: #27292a;
      --lugx-gray: #7a7a7a;
      --lugx-light-gray: #f7f7f7;
      --lugx-border: #e7e7e7;
      --lugx-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);
      --lugx-radius: 25px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
      line-height: 1.6;
      color: #1e1e1e;
      background: #ffffff;
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
      transition: all 0.3s ease;
    }

    /* ==========================================================================
       HEADER & NAVIGATION (Lugx Curved Top Bar & Sticky Nav)
       ========================================================================== */
    .header-area {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      background-color: var(--lugx-blue);
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
      border-bottom-left-radius: 30px;
      border-bottom-right-radius: 30px;
      transition: all 0.3s ease-in-out;
    }

    .main-nav {
      max-width: 100%;
      margin: 0 auto;
      padding: 15px 45px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 90px;
    }

    .logo {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      height: 40px;
    }

    .logo img {
      height: 40px;
      width: auto;
      max-height: 40px;
      object-fit: contain;
      box-shadow: none;
      border: none;
      padding: 0;
      display: block;
      transition: transform 0.3s ease;
    }

    .logo img:hover {
      transform: scale(1.04);
    }

    .logo-text {
      font-size: 20px;
      font-weight: 800;
      color: #ffffff;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      line-height: 1;
      display: inline-flex;
      align-items: center;
      margin: 0;
      transform: translateY(5px);
    }

    .logo-text span {
      color: var(--lugx-red);
      margin-left: 4px;
    }

    /* Navigation Links */
    .nav-menu {
      display: flex;
      align-items: center;
      list-style: none;
      gap: 30px;
      margin-left: auto;
    }

    .nav-menu li {
      position: relative;
    }

    .nav-menu a.nav-item-link {
      color: #ffffff;
      font-size: 15px;
      font-weight: 500;
      padding: 10px 15px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .nav-menu a.nav-item-link:hover,
    .nav-menu a.nav-item-link.active {
      background-color: rgba(255, 255, 255, 0.15);
      color: #ffffff;
    }

    /* Red Action Button for Sign In (Lugx Signature) */
    .main-button a {
      display: inline-block;
      background-color: var(--lugx-red);
      color: #ffffff !important;
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      padding: 12px 30px !important;
      border-radius: 25px;
      letter-spacing: 0.5px;
      box-shadow: 0px 5px 15px rgba(238, 98, 107, 0.4);
      transition: all 0.3s ease;
    }

    .main-button a:hover {
      background-color: var(--lugx-red-hover) !important;
      transform: translateY(-2px);
      box-shadow: 0px 8px 20px rgba(238, 98, 107, 0.6);
    }

    /* Mega Dropdown */
    .dropdown {
      position: relative;
    }

    .dropdown-content.mega-dropdown {
      position: absolute;
      top: 100%;
      left: 50%;
      transform: translateX(-50%) translateY(8px);
      background: #ffffff;
      min-width: 340px;
      max-width: 500px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.18);
      border-radius: 20px;
      margin-top: 12px;
      z-index: 1000;
      padding: 24px;
      border-top: 4px solid var(--lugx-red);
      
      visibility: hidden;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s ease;
      transition-delay: 0.15s;
    }

    .dropdown-content.mega-dropdown::before {
      content: '';
      position: absolute;
      top: -18px;
      left: 0;
      width: 100%;
      height: 18px;
      background: transparent;
    }

    .dropdown:hover .dropdown-content.mega-dropdown,
    .dropdown-content.mega-dropdown:hover {
      visibility: visible;
      opacity: 1;
      pointer-events: auto;
      transform: translateX(-50%) translateY(0);
      transition-delay: 0s;
    }

    .mega-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 16px;
    }

    .mega-heading {
      font-size: 16px;
      font-weight: 700;
      color: var(--lugx-blue);
      margin-bottom: 8px;
      border-bottom: 2px solid var(--lugx-light-gray);
      padding-bottom: 6px;
    }

    .mega-column a {
      display: block;
      color: var(--lugx-dark);
      font-weight: 600;
      font-size: 14px;
      padding: 6px 0;
      transition: color 0.2s ease;
    }

    .mega-column a:hover {
      color: var(--lugx-red);
      padding-left: 5px;
    }

    .mega-desc {
      font-size: 12px;
      color: var(--lugx-gray);
      margin-bottom: 12px;
      line-height: 1.4;
    }

    /* Mobile Toggle */
    .menu-toggle {
      display: none;
      width: 44px;
      height: 44px;
      border: none;
      background: rgba(255, 255, 255, 0.2);
      color: #ffffff;
      font-size: 22px;
      cursor: pointer;
      border-radius: 50%;
      align-items: center;
      justify-content: center;
    }

    /* Mobile Nav Overlay */
    .mobile-nav-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.6);
      backdrop-filter: blur(4px);
      z-index: 1001;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .mobile-nav-overlay.active {
      display: block;
      opacity: 1;
    }

    .mobile-nav {
      position: fixed;
      top: 0;
      right: -100%;
      width: 85%;
      max-width: 360px;
      height: 100vh;
      background: #ffffff;
      z-index: 1002;
      padding: 80px 24px 30px;
      overflow-y: auto;
      transition: right 0.3s ease;
      box-shadow: -5px 0 25px rgba(0,0,0,0.2);
    }

    .mobile-nav.active {
      right: 0;
    }

    .mobile-nav .dropbtn {
      width: 100%;
      text-align: left;
      background: none;
      border: none;
      font-size: 16px;
      font-weight: 600;
      color: var(--lugx-dark);
      padding: 12px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      border-bottom: 1px solid var(--lugx-border);
    }

    .mobile-nav .dropdown-content {
      display: none;
      background: var(--lugx-light-gray);
      border-radius: 12px;
      padding: 16px;
      margin-top: 8px;
    }

    .mobile-nav .dropdown-content.show-dropdown {
      display: block;
    }

    .mobile-nav .dropdown-content a {
      display: block;
      color: var(--lugx-dark);
      font-weight: 600;
      font-size: 14px;
      padding: 8px 0;
    }

    .mobile-nav .dropdown-content a:hover {
      color: var(--lugx-red);
      padding-left: 5px;
    }

    /* ==========================================================================
       SUBPAGE HERO BANNER (Lugx Curved Red-Navy Gradient & Animated Doodles)
       ========================================================================== */
    .subpage-banner {
      background: linear-gradient(135deg, rgba(180, 8, 20, 0.95) 0%, rgba(4, 49, 104, 0.96) 50%, rgba(8, 35, 75, 0.98) 100%);
      border-bottom-right-radius: 60px;
      border-bottom-left-radius: 60px;
      padding: 135px 0 65px 0;
      position: relative;
      overflow: hidden;
      box-shadow: 0 15px 35px rgba(4, 49, 104, 0.28);
      text-align: center;
    }

    .subpage-banner::before {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      width: 100%;
      height: 100%;
      background: url('<?= base_url("assets/img/background/IDE 2.0.webp") ?>') no-repeat center center/cover;
      opacity: 0.14;
      pointer-events: none;
      z-index: 0;
    }

    .subpage-banner::after {
      content: '';
      position: absolute;
      top: -20%;
      left: -10%;
      width: 550px;
      height: 550px;
      background: radial-gradient(circle, rgba(238, 98, 107, 0.45) 0%, rgba(180, 8, 20, 0.25) 45%, transparent 75%);
      filter: blur(50px);
      animation: pulseRedGlow 6s ease-in-out infinite alternate;
      pointer-events: none;
      z-index: 1;
    }

    @keyframes pulseRedGlow {
      0% { transform: scale(1) translate(0, 0); opacity: 0.7; }
      100% { transform: scale(1.15) translate(25px, 20px); opacity: 1; }
    }

    .cta-doodle {
      position: absolute;
      color: rgba(255, 255, 255, 0.16);
      pointer-events: none;
      z-index: 1;
      animation: floatDoodleIcon 5s ease-in-out infinite alternate;
      filter: drop-shadow(0 4px 10px rgba(0,0,0,0.25));
    }

    .cta-doodle.doodle-1 { top: 50px; left: 60px; font-size: 44px; animation-delay: 0s; }
    .cta-doodle.doodle-2 { bottom: 40px; left: 100px; font-size: 38px; animation-delay: 1.2s; }
    .cta-doodle.doodle-3 { top: 60px; right: 80px; font-size: 42px; animation-delay: 2.4s; }
    .cta-doodle.doodle-4 { bottom: 45px; right: 90px; font-size: 46px; animation-delay: 0.8s; }
    .cta-doodle.doodle-5 { top: 140px; left: 200px; font-size: 32px; animation-delay: 2s; }
    .cta-doodle.doodle-6 { top: 150px; right: 210px; font-size: 34px; animation-delay: 1.5s; }

    @keyframes floatDoodleIcon {
      0% { transform: translateY(0px) rotate(0deg) scale(1); opacity: 0.15; }
      50% { transform: translateY(-12px) rotate(8deg) scale(1.08); opacity: 0.28; }
      100% { transform: translateY(-20px) rotate(-6deg) scale(1.15); opacity: 0.38; }
    }

    .banner-container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 30px;
      position: relative;
      z-index: 2;
    }

    .subpage-banner h1 {
      font-size: 36px;
      font-weight: 800;
      color: #ffffff;
      text-transform: uppercase;
      line-height: 1.25;
      margin-bottom: 12px;
      text-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }

    .subpage-banner h1 span {
      color: #ff6b75;
      text-shadow: 0 0 25px rgba(255, 107, 117, 0.6);
    }

    .subpage-banner p.lead-text {
      color: rgba(255, 255, 255, 0.92);
      font-size: 15px;
      max-width: 720px;
      margin: 0 auto 30px;
      line-height: 1.65;
    }

    /* Stats strip */
    .hero-stats-strip {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      max-width: 760px;
      margin: 0 auto;
    }

    .hero-stat-box {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.25);
      border-radius: 16px;
      padding: 14px 12px;
      transition: all 0.3s ease;
    }

    .hero-stat-box:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-4px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .hero-stat-val {
      font-size: 24px;
      font-weight: 800;
      color: #ffffff;
      display: block;
      line-height: 1.1;
      margin-bottom: 4px;
    }

    .hero-stat-lbl {
      font-size: 11px;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.85);
      font-weight: 600;
    }

    /* ==========================================================================
       SECTION HEADINGS (Lugx Subtitle Tag + Big Title)
       ========================================================================== */
    .section-heading {
      text-align: center;
      margin-bottom: 45px;
    }

    .section-heading .subtitle {
      color: var(--lugx-red);
      font-size: 15px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      display: block;
      margin-bottom: 10px;
    }

    .section-heading h2 {
      font-size: 36px;
      font-weight: 800;
      color: var(--lugx-dark);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .section-heading p {
      color: var(--lugx-gray);
      font-size: 15px;
      max-width: 680px;
      margin: 12px auto 0;
      line-height: 1.6;
    }

    /* ==========================================================================
       SURVEY CONTENT & FILTER SECTION
       ========================================================================== */
    .survey-content {
      padding: 40px 0 75px 0;
      background-color: #ffffff;
    }

    .survey-content-inner {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 30px;
    }

    /* Modern Filter Card */
    .filter-section-lugx {
      background: var(--lugx-light-gray);
      border-radius: var(--lugx-radius);
      border: 1px solid #e2e8f0;
      padding: 30px;
      margin-bottom: 45px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }

    .filter-section-lugx h4 {
      font-size: 15px;
      font-weight: 800;
      color: var(--lugx-blue);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .filter-grid-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .filter-group-lugx {
      display: flex;
      flex-direction: column;
    }

    .filter-group-lugx label {
      font-size: 12px;
      font-weight: 700;
      color: var(--lugx-dark);
      text-transform: uppercase;
      letter-spacing: 0.4px;
      margin-bottom: 8px;
    }

    .filter-select-custom {
      width: 100%;
      height: 48px;
      border-radius: 24px;
      border: 2px solid #cbd5e1;
      padding: 0 20px;
      font-size: 13.5px;
      font-weight: 600;
      color: var(--lugx-dark);
      font-family: inherit;
      background-color: #ffffff;
      outline: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .filter-select-custom:focus {
      border-color: var(--lugx-blue);
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.15);
    }

    /* ==========================================================================
       SURVEY CONTENT & FILTER SECTION
       ========================================================================== */
    .survey-content {
      padding: 90px 0 60px 0;
      background-color: #ffffff;
    }

    .survey-content-inner {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 30px;
    }

    /* Modern Filter Card */
    .filter-section-lugx {
      background: var(--lugx-light-gray);
      border-radius: var(--lugx-radius);
      border: 1px solid #e2e8f0;
      padding: 30px;
      margin-bottom: 45px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }

    .filter-section-lugx h4 {
      font-size: 15px;
      font-weight: 800;
      color: var(--lugx-blue);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .filter-grid-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .filter-group-lugx {
      display: flex;
      flex-direction: column;
    }

    .filter-group-lugx label {
      font-size: 12px;
      font-weight: 700;
      color: var(--lugx-dark);
      text-transform: uppercase;
      letter-spacing: 0.4px;
      margin-bottom: 8px;
    }

    .filter-select-custom {
      width: 100%;
      height: 48px;
      border-radius: 24px;
      border: 2px solid #cbd5e1;
      padding: 0 20px;
      font-size: 13.5px;
      font-weight: 600;
      color: var(--lugx-dark);
      font-family: inherit;
      background-color: #ffffff;
      outline: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .filter-select-custom:focus {
      border-color: var(--lugx-blue);
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.15);
    }

    /* Survey Grid & Cards - Enterprise Proportion */
    .survey-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
      gap: 24px;
    }

    .survey-card {
      background-color: #ffffff;
      border-radius: 20px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 8px 24px rgba(4, 49, 104, 0.06);
      padding: 24px 22px;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow: hidden;
      transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .survey-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -120%;
      width: 60%;
      height: 100%;
      background: linear-gradient(to right, transparent, rgba(4, 49, 104, 0.05), transparent);
      transform: skewX(-25deg);
      transition: all 0.75s ease;
      z-index: 1;
      pointer-events: none;
    }

    .survey-card:hover::before {
      left: 160%;
    }

    .survey-card:hover {
      transform: translateY(-6px);
      border-color: var(--lugx-red);
      box-shadow: 0 16px 36px rgba(4, 49, 104, 0.14);
    }

    .card-header-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 14px;
      position: relative;
      z-index: 2;
    }

    .card-icon {
      width: 46px;
      height: 46px;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--lugx-blue) 0%, #0d4f9b 100%);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 19px;
      box-shadow: 0 5px 14px rgba(4, 49, 104, 0.22);
      transition: all 0.35s ease;
    }

    .card-icon svg {
      width: 22px;
      height: 22px;
      color: #ffffff;
      stroke-width: 2;
    }

    .survey-card:hover .card-icon {
      background: var(--lugx-red);
      transform: scale(1.06) rotate(3deg);
      box-shadow: 0 6px 18px rgba(180, 8, 20, 0.35);
    }

    .card-status {
      font-size: 11px;
      font-weight: 800;
      padding: 5px 12px;
      border-radius: 20px;
      letter-spacing: 0.4px;
      text-transform: uppercase;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .status-active {
      background-color: rgba(16, 185, 129, 0.1);
      color: #059669;
      border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-inactive {
      background-color: rgba(220, 38, 38, 0.08);
      color: #dc2626;
      border: 1px solid rgba(220, 38, 38, 0.2);
    }

    .badge-multi-instrumen {
      background: linear-gradient(135deg, rgba(4, 49, 104, 0.08), rgba(180, 8, 20, 0.08));
      color: var(--lugx-blue);
      border: 1px solid rgba(4, 49, 104, 0.22);
      font-size: 10px;
      font-weight: 800;
      padding: 3px 8px;
      border-radius: 8px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      margin-left: 6px;
    }

    .card-title {
      font-size: 16.5px;
      font-weight: 800;
      color: var(--lugx-dark);
      margin-bottom: 14px;
      line-height: 1.38;
      text-transform: uppercase;
      transition: color 0.3s ease;
      position: relative;
      z-index: 2;
    }

    .survey-card:hover .card-title {
      color: var(--lugx-red);
    }

    .card-meta {
      background: var(--lugx-light-gray);
      border: 1px solid #edf2f7;
      border-radius: 14px;
      padding: 12px 16px;
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-bottom: 18px;
      position: relative;
      z-index: 2;
    }

    .meta-row {
      display: grid;
      grid-template-columns: 110px 12px 1fr;
      align-items: baseline;
      font-size: 12px;
    }

    .meta-label {
      font-size: 11px;
      font-weight: 700;
      color: var(--lugx-blue);
      text-transform: uppercase;
      letter-spacing: 0.4px;
    }

    .meta-colon {
      color: #94a3b8;
      font-weight: 700;
      text-align: center;
    }

    .meta-value {
      font-size: 12.5px;
      font-weight: 600;
      color: var(--lugx-dark);
      word-break: break-word;
    }

    .card-actions {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr 1fr;
      gap: 8px;
      margin-top: auto;
      position: relative;
      z-index: 2;
    }

    .btn-action-fill {
      height: 42px;
      border-radius: 21px;
      background: linear-gradient(135deg, #b40814 0%, #e11d48 55%, #b40814 100%);
      background-size: 200% auto;
      color: #ffffff;
      font-size: 12.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      border: none;
      cursor: pointer;
      box-shadow: 0 4px 15px rgba(180, 8, 20, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.25);
      transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    .btn-action-fill:hover {
      background-position: right center;
      transform: translateY(-2px);
      box-shadow: 0 8px 22px rgba(180, 8, 20, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.35);
    }

    .btn-action-fill:active {
      transform: translateY(0);
      box-shadow: 0 3px 10px rgba(180, 8, 20, 0.4);
    }

    .btn-action-demo {
      height: 42px;
      border-radius: 21px;
      background: #ffffff;
      color: var(--lugx-blue);
      border: 2px solid var(--lugx-blue);
      font-size: 12.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(4, 49, 104, 0.08);
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    .btn-action-demo:hover {
      background: linear-gradient(135deg, var(--lugx-blue) 0%, #0d4f9b 100%);
      color: #ffffff;
      border-color: transparent;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(4, 49, 104, 0.3);
    }

    .btn-action-demo:active {
      transform: translateY(0);
    }

    /* BUTTON QR CODE BER-CSS MENAWAN & MODERN */
    .btn-action-qr {
      height: 42px;
      border-radius: 21px;
      background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
      color: #047857;
      border: 2px solid #6ee7b7;
      font-size: 12.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(4, 120, 87, 0.08);
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    .btn-action-qr i {
      color: #059669;
      font-size: 14px;
      transition: transform 0.25s ease;
    }

    .btn-action-qr:hover {
      background: linear-gradient(135deg, #059669 0%, #047857 100%);
      color: #ffffff;
      border-color: transparent;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(4, 120, 87, 0.35);
    }

    .btn-action-qr:hover i {
      color: #ffffff;
      transform: scale(1.18);
    }

    .btn-action-qr:active {
      transform: translateY(0);
    }

    /* Login Status Badge Fixed on Top */
    .login-status-badge {
      position: fixed;
      top: 105px;
      right: 30px;
      z-index: 999;
      background: linear-gradient(135deg, #043168 0%, #0d4f9b 100%);
      color: #ffffff;
      padding: 8px 20px;
      border-radius: 30px;
      font-size: 13px;
      font-weight: 600;
      box-shadow: 0 8px 24px rgba(4, 49, 104, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.2);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .level-badge {
      background: var(--lugx-red);
      color: #ffffff;
      padding: 3px 10px;
      border-radius: 12px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
    }

    .logout-link {
      color: rgba(255, 255, 255, 0.85);
      margin-left: 6px;
      transition: color 0.2s ease;
      font-size: 14px;
    }

    .logout-link:hover {
      color: #ff6b75;
    }

    /* Login Prompt Modal */
    .login-prompt-modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.7);
      backdrop-filter: blur(6px);
      z-index: 2001;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-prompt-modal.active {
      display: flex;
    }

    .login-prompt-content {
      background: #ffffff;
      border-radius: 28px;
      width: 100%;
      max-width: 420px;
      padding: 40px 32px;
      text-align: center;
      box-shadow: 0 25px 60px rgba(0,0,0,0.35);
      border: 1px solid #e2e8f0;
      animation: popIn 0.3s ease;
    }

    @keyframes popIn {
      0% { transform: scale(0.9); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }

    .prompt-icon-wrap {
      width: 65px;
      height: 65px;
      border-radius: 50%;
      background: rgba(180, 8, 20, 0.1);
      color: var(--lugx-red);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      margin: 0 auto 20px auto;
    }

    .login-prompt-content h3 {
      font-size: 22px;
      font-weight: 800;
      color: var(--lugx-dark);
      margin-bottom: 10px;
      text-transform: uppercase;
    }

    .login-prompt-content p {
      color: var(--lugx-gray);
      font-size: 14px;
      line-height: 1.6;
      margin-bottom: 28px;
    }

    .login-prompt-actions {
      display: flex;
      gap: 12px;
      justify-content: center;
    }

    .login-prompt-btn {
      flex: 1;
      height: 48px;
      border-radius: 24px;
      font-size: 13.5px;
      font-weight: 700;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .login-prompt-btn.primary {
      background-color: var(--lugx-red);
      color: #ffffff;
      box-shadow: 0 6px 16px rgba(180, 8, 20, 0.35);
    }

    .login-prompt-btn.primary:hover {
      background-color: var(--lugx-red-hover);
      transform: translateY(-2px);
    }

    .login-prompt-btn.secondary {
      background: var(--lugx-light-gray);
      color: var(--lugx-dark);
      border: 1px solid #cbd5e1;
    }

    .login-prompt-btn.secondary:hover {
      background: #e2e8f0;
      transform: translateY(-2px);
    }

    /* ==========================================================================
       FOOTER & CONTACT SECTION (Lugx Navy Gradient Footer)
       ========================================================================== */
    .footer-area {
      background: linear-gradient(135deg, #043168 0%, #0a3d7c 50%, #082852 100%);
      color: #ffffff;
      padding: 90px 0 30px 0;
      border-top-left-radius: 120px;
      border-top-right-radius: 120px;
      position: relative;
      box-shadow: 0 -10px 30px rgba(4, 49, 104, 0.3);
    }

    .footer-container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 0 30px;
    }

    .footer-grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr;
      gap: 50px;
      margin-bottom: 60px;
    }

    .footer-about h3,
    .footer-col h3 {
      font-size: 20px;
      font-weight: 700;
      color: #ffffff;
      text-transform: uppercase;
      margin-bottom: 25px;
      position: relative;
    }

    .footer-about h3::after,
    .footer-col h3::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 40px;
      height: 3px;
      background-color: var(--lugx-red);
    }

    .footer-about p {
      color: #ffffff;
      font-size: 14px;
      line-height: 1.8;
      margin-bottom: 20px;
      opacity: 0.95;
    }

    .social-icons {
      display: flex;
      gap: 12px;
    }

    .social-icon-btn {
      width: 40px;
      height: 40px;
      background-color: rgba(255,255,255,0.15);
      color: #ffffff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .social-icon-btn:hover {
      background-color: var(--lugx-red);
      transform: translateY(-3px);
      color: #ffffff;
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 12px;
    }

    .footer-links a {
      color: #ffffff;
      font-size: 14px;
      opacity: 0.95;
      transition: all 0.3s ease;
    }

    .footer-links a:hover {
      color: #ff6b75;
      opacity: 1;
      padding-left: 5px;
    }

    .copyright {
      border-top: 1px solid rgba(255,255,255,0.2);
      padding-top: 30px;
      text-align: center;
      font-size: 14px;
      color: #ffffff;
      opacity: 0.9;
    }

    /* Floating WhatsApp Button */
    .whatsapp-float {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 60px;
      height: 60px;
      background-color: #25d366;
      color: #ffffff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 32px;
      box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
      z-index: 999;
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      text-decoration: none;
    }

    .whatsapp-float:hover {
      transform: scale(1.1) translateY(-4px);
      box-shadow: 0 15px 30px rgba(37, 211, 102, 0.6);
      color: #ffffff;
      background-color: #128c7e;
    }

    /* ==========================================================================
       SIGN IN MODAL (Lugx 2-Column Split Modal)
       ========================================================================== */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(5px);
      z-index: 2000;
      align-items: center;
      justify-content: center;
      padding: 20px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .modal.active {
      display: flex;
      opacity: 1;
    }

    .modal-content-split {
      background-color: #ffffff;
      max-width: 940px !important;
      width: 100%;
      border-radius: 28px !important;
      padding: 0 !important;
      overflow: hidden !important;
      box-shadow: 0 35px 80px rgba(4, 49, 104, 0.5) !important;
      border: 1px solid rgba(255, 255, 255, 0.2);
      transform: scale(0.9);
      transition: transform 0.3s ease;
    }

    .modal.active .modal-content-split {
      transform: scale(1);
    }

    .login-modal-grid {
      display: grid;
      grid-template-columns: 1.1fr 1fr;
      min-height: 520px;
    }

    .login-banner-side {
      background: linear-gradient(135deg, rgba(4, 49, 104, 0.90) 0%, rgba(10, 61, 124, 0.85) 60%, rgba(180, 8, 20, 0.82) 100%), url('<?= base_url("assets/img/background/IDE 2.0.webp") ?>') right center / cover no-repeat;
      padding: 45px 35px;
      color: #ffffff;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
      overflow: hidden;
    }

    .login-banner-side::before {
      content: '';
      position: absolute;
      top: -30%;
      right: -20%;
      width: 350px;
      height: 350px;
      background: radial-gradient(circle, rgba(238, 98, 107, 0.45) 0%, transparent 70%);
      filter: blur(35px);
      pointer-events: none;
    }

    .login-doodle {
      position: absolute;
      color: rgba(255, 255, 255, 0.18);
      pointer-events: none;
      z-index: 1;
      animation: floatLoginDoodle 5s ease-in-out infinite alternate;
      filter: drop-shadow(0 4px 10px rgba(0,0,0,0.25));
    }

    .login-doodle.doodle-1 { top: 25px; left: 35px; font-size: 38px; animation-delay: 0s; }
    .login-doodle.doodle-2 { bottom: 30px; left: 45px; font-size: 34px; animation-delay: 1.2s; }
    .login-doodle.doodle-3 { top: 30px; right: 40px; font-size: 36px; animation-delay: 2.4s; }
    .login-doodle.doodle-4 { bottom: 25px; right: 35px; font-size: 40px; animation-delay: 0.8s; }
    .login-doodle.doodle-5 { top: 120px; left: 160px; font-size: 28px; animation-delay: 2s; }
    .login-doodle.doodle-6 { bottom: 90px; right: 150px; font-size: 30px; animation-delay: 3.2s; }

    @keyframes floatLoginDoodle {
      0% { transform: translateY(0px) rotate(0deg) scale(1); opacity: 0.15; }
      50% { transform: translateY(-10px) rotate(8deg) scale(1.08); opacity: 0.28; }
      100% { transform: translateY(-18px) rotate(-6deg) scale(1.15); opacity: 0.38; }
    }

    .login-brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .login-brand img {
      height: 42px;
      width: auto;
      object-fit: contain;
    }

    .login-brand-text {
      font-size: 16px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #ffffff;
      line-height: 1;
      display: inline-flex;
      align-items: center;
      transform: translateY(4px);
    }

    .login-brand-text span {
      color: var(--lugx-red);
      margin-left: 4px;
    }

    .login-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.25);
      color: #ffffff;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      padding: 5px 14px;
      border-radius: 15px;
      margin-bottom: 18px;
    }

    .login-banner-center h2 {
      font-size: 28px;
      font-weight: 800;
      color: #ffffff;
      line-height: 1.3;
      margin-bottom: 14px;
      text-transform: uppercase;
    }

    .login-banner-center p {
      font-size: 14px;
      color: rgba(255, 255, 255, 0.88);
      line-height: 1.7;
      margin: 0;
    }

    .login-form-side {
      background: #ffffff;
      padding: 40px 40px 35px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      position: relative;
    }

    .modal-close-dark {
      position: absolute;
      top: 20px;
      right: 20px;
      background: #f1f5f9;
      border: none;
      color: var(--lugx-dark);
      font-size: 22px;
      cursor: pointer;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
      line-height: 1;
      z-index: 10;
    }

    .modal-close-dark:hover {
      background-color: var(--lugx-red);
      color: #ffffff;
    }

    .login-form-header {
      margin-bottom: 24px;
      padding-right: 35px;
    }

    .login-form-header h3 {
      font-size: 24px;
      font-weight: 800;
      color: var(--lugx-dark);
      margin-bottom: 6px;
      text-transform: uppercase;
    }

    .login-subtext {
      font-size: 13px;
      color: var(--lugx-gray);
      margin: 0;
    }

    .form-group-custom {
      margin-bottom: 22px;
    }

    .form-label-custom {
      display: block;
      font-size: 13px;
      font-weight: 700;
      color: var(--lugx-dark);
      margin-bottom: 8px;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .input-icon-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-icon {
      position: absolute;
      left: 18px;
      color: #94a3b8;
      font-size: 15px;
      transition: color 0.3s ease;
    }

    .form-input-custom {
      width: 100%;
      height: 50px;
      border-radius: 25px;
      border: 2px solid #e2e8f0;
      padding: 0 20px 0 48px;
      font-size: 14px;
      font-family: inherit;
      outline: none;
      transition: all 0.3s ease;
      background-color: #f8fafc;
    }

    .form-input-custom:focus {
      border-color: var(--lugx-blue);
      background-color: #ffffff;
      box-shadow: 0 0 0 4px rgba(4, 49, 104, 0.1);
    }

    .input-icon-wrapper:focus-within .input-icon {
      color: var(--lugx-blue);
    }

    .btn-login-large {
      width: 100%;
      height: 52px;
      border-radius: 26px;
      background-color: var(--lugx-red);
      color: #ffffff;
      font-size: 15px;
      font-weight: 700;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      box-shadow: 0 10px 25px rgba(180, 8, 20, 0.35);
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-top: 10px;
    }

    .btn-login-large:hover {
      background-color: var(--lugx-red-hover);
      transform: translateY(-2px);
      box-shadow: 0 15px 30px rgba(180, 8, 20, 0.5);
    }

    /* ==========================================================================
       RESPONSIVE BREAKPOINTS
       ========================================================================== */
    @media (max-width: 992px) {
      .filter-grid-row {
        grid-template-columns: 1fr;
      }
      .footer-grid {
        grid-template-columns: 1fr;
        gap: 40px;
      }
      .subpage-banner h1 {
        font-size: 36px;
      }
      .hero-stats-strip {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .main-nav {
        padding: 15px 25px;
      }
      .nav-menu {
        display: none;
      }
      .menu-toggle {
        display: flex;
      }
      .survey-grid {
        grid-template-columns: 1fr;
      }
      .hero-stats-strip {
        grid-template-columns: 1fr;
        max-width: 380px;
        gap: 10px;
      }
      .hero-stat-box {
        padding: 12px 14px;
        border-radius: 14px;
      }
      .hero-stat-val {
        font-size: 20px;
      }
      .subpage-banner {
        border-bottom-right-radius: 80px;
        border-bottom-left-radius: 80px;
        padding: 140px 0 90px 0;
      }
      .subpage-banner h1 {
        font-size: 28px;
      }
      .login-modal-grid {
        grid-template-columns: 1fr;
      }
      .login-banner-side {
        display: none;
      }
      .login-form-side {
        padding: 30px 20px;
      }
      .footer-area {
        border-top-left-radius: 60px;
        border-top-right-radius: 60px;
      }
      .login-status-badge {
        top: 90px;
        right: 15px;
        left: 15px;
        justify-content: center;
      }
      .whatsapp-float {
        width: 50px;
        height: 50px;
        bottom: 20px;
        right: 20px;
        font-size: 26px;
      }
    }

    /* ==========================================================================
       SURVEYOR CONTROL BAR & TABS (Surveiyor Level 4 & Admin Portal)
       ========================================================================== */
    .surveyor-control-bar-wrap {
      max-width: 1280px;
      margin: -35px auto 35px auto;
      padding: 0 30px;
      position: relative;
      z-index: 20;
    }

    .surveyor-control-bar {
      background: linear-gradient(135deg, var(--lugx-blue) 0%, #0d3d7c 100%);
      border-radius: 24px;
      padding: 16px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      box-shadow: 0 15px 35px rgba(4, 49, 104, 0.25);
      border: 1px solid rgba(255, 255, 255, 0.15);
      flex-wrap: wrap;
    }

    .surveyor-bar-left {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .surveyor-avatar {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      background: rgba(255, 255, 255, 0.15);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      border: 1px solid rgba(255, 255, 255, 0.25);
    }

    .surveyor-bar-badge {
      font-size: 11px;
      font-weight: 700;
      color: #6ee7b7;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .surveyor-bar-name {
      font-size: 17px;
      font-weight: 800;
      color: #ffffff;
      margin: 0;
      line-height: 1.2;
    }

    .surveyor-bar-tabs {
      display: flex;
      align-items: center;
      gap: 8px;
      background: rgba(0, 0, 0, 0.2);
      padding: 6px;
      border-radius: 18px;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .surveyor-tab-btn {
      background: transparent;
      border: none;
      color: rgba(255, 255, 255, 0.8);
      font-size: 13.5px;
      font-weight: 700;
      font-family: inherit;
      padding: 10px 18px;
      border-radius: 12px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.25s ease;
      outline: none;
    }

    .surveyor-tab-btn:hover {
      color: #ffffff;
      background: rgba(255, 255, 255, 0.1);
    }

    .surveyor-tab-btn.active {
      background: #ffffff;
      color: var(--lugx-blue);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .tab-badge-pill {
      background: var(--lugx-red);
      color: #ffffff;
      font-size: 10px;
      font-weight: 800;
      padding: 2px 7px;
      border-radius: 10px;
      letter-spacing: 0.3px;
    }

    .surveyor-bar-right {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .btn-create-survey {
      background: var(--lugx-red);
      color: #ffffff;
      font-size: 13.5px;
      font-weight: 800;
      font-family: inherit;
      padding: 12px 24px;
      border-radius: 20px;
      border: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 6px 18px rgba(180, 8, 20, 0.4);
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .btn-create-survey:hover {
      transform: translateY(-2px) scale(1.03);
      background: #9b0711;
      box-shadow: 0 10px 24px rgba(180, 8, 20, 0.5);
    }

    /* Keterangan Daerah Survei Badge on Cards */
    .badge-daerah-survei {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      font-weight: 700;
      color: #0369a1;
      background: #e0f2fe;
      border: 1px solid #bae6fd;
      padding: 4px 10px;
      border-radius: 12px;
      max-width: 100%;
      word-break: break-word;
    }

    /* Survey Card Extra Actions for Surveyor */
    .card-surveyor-actions {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
      margin-top: 10px;
      padding-top: 12px;
      border-top: 1px dashed #e2e8f0;
    }

    .btn-action-edit, .btn-action-rekap, .btn-action-del {
      border: none;
      font-size: 12px;
      font-weight: 700;
      font-family: inherit;
      padding: 8px 12px;
      border-radius: 12px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      transition: all 0.2s ease;
    }

    .btn-action-edit {
      background: #f1f5f9;
      color: var(--lugx-blue);
      border: 1px solid #cbd5e1;
    }
    .btn-action-edit:hover {
      background: var(--lugx-blue);
      color: #ffffff;
    }

    .btn-action-rekap {
      background: #ecfdf5;
      color: #059669;
      border: 1px solid #a7f3d0;
    }
    .btn-action-rekap:hover {
      background: #059669;
      color: #ffffff;
    }

    .btn-action-del {
      grid-column: 1 / -1;
      background: #fff1f2;
      color: #e11d48;
      border: 1px solid #fecdd3;
    }
    .btn-action-del:hover {
      background: #e11d48;
      color: #ffffff;
    }

    /* ==========================================================================
       ENTERPRISE DYNAMIC SURVEY BUILDER STUDIO (MODERN PROGRESSIVE SCROLL)
       ========================================================================== */
    .gform-studio-section {
      display: none;
      padding: 36px 0 120px 0;
      background: #f8fafc;
      min-height: 90vh;
    }

    .gform-studio-section.active {
      display: block;
    }

    .gform-container {
      max-width: 1140px;
      width: 100%;
      margin: 0 auto;
      padding: 0 24px;
      display: flex;
      flex-direction: column;
      gap: 28px;
    }

    /* Enterprise Studio Header Bar */
    .builder-studio-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
      padding: 16px 24px;
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 18px;
      box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);
    }

    .builder-studio-left {
      display: flex;
      align-items: center;
      gap: 14px;
      flex-wrap: wrap;
    }

    .gform-back-btn {
      background: #f1f5f9;
      border: 1px solid #cbd5e1;
      color: #334155;
      font-size: 13px;
      font-weight: 700;
      font-family: inherit;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 16px;
      border-radius: 12px;
      transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .gform-back-btn:hover {
      background: #e2e8f0;
      color: #0f172a;
      transform: translateX(-2px);
    }

    .gform-header-badge {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: #eff6ff;
      color: var(--lugx-blue);
      font-size: 12px;
      font-weight: 800;
      padding: 6px 14px;
      border-radius: 12px;
      border: 1px solid #bfdbfe;
      letter-spacing: 0.3px;
    }

    .builder-nav-stepper {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .stepper-chip {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      color: #64748b;
      font-size: 11.5px;
      font-weight: 700;
      padding: 5px 12px;
      border-radius: 20px;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s;
      cursor: pointer;
    }

    .stepper-chip:hover {
      background: #eff6ff;
      color: var(--lugx-blue);
      border-color: #bfdbfe;
    }

    .stepper-chip span.num {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: #e2e8f0;
      color: #475569;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      font-weight: 800;
    }

    .stepper-chip:hover span.num {
      background: var(--lugx-blue);
      color: #ffffff;
    }

    /* Enterprise Studio Form Cards */
    .enterprise-builder-card {
      background: #ffffff;
      border-radius: 22px;
      border: 1.5px solid #cbd5e1;
      padding: 38px 46px;
      box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
      position: relative;
      transition: box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .enterprise-builder-card:hover {
      box-shadow: 0 8px 30px -4px rgba(15, 23, 42, 0.08);
      border-color: #cbd5e1;
    }

    .card-step-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 24px;
      padding-bottom: 18px;
      border-bottom: 1px solid #f1f5f9;
      flex-wrap: wrap;
    }

    .card-step-info {
      display: flex;
      align-items: flex-start;
      gap: 14px;
    }

    .card-step-pill {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 12px;
      background: linear-gradient(135deg, var(--lugx-blue) 0%, #1e40af 100%);
      color: #ffffff;
      font-size: 14px;
      font-weight: 800;
      box-shadow: 0 4px 10px rgba(4, 49, 104, 0.2);
      flex-shrink: 0;
    }

    .card-step-text h3 {
      font-size: 18px;
      font-weight: 800;
      color: #0f172a;
      margin: 0 0 4px 0;
      line-height: 1.3;
    }

    .card-step-text p {
      font-size: 13px;
      color: #64748b;
      margin: 0;
      font-weight: 500;
    }

    /* Enterprise Inputs & Form Controls */
    .gform-field-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-bottom: 20px;
    }

    .gform-field-group:last-child {
      margin-bottom: 0;
    }

    .gform-field-label {
      font-size: 12px;
      font-weight: 800;
      color: #475569;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .gform-field-label i {
      color: var(--lugx-blue);
      font-size: 13px;
    }

    .gform-field-label span.req {
      color: #ef4444;
      font-weight: 800;
    }

    .gform-title-input {
      width: 100%;
      border: 1.5px solid #cbd5e1;
      border-radius: 14px;
      font-size: 22px;
      font-weight: 700;
      color: #0f172a;
      font-family: inherit;
      padding: 14px 20px;
      height: 56px;
      outline: none;
      background: #ffffff;
      transition: all 0.2s ease;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    }

    .gform-title-input:focus {
      border-color: var(--lugx-blue);
      box-shadow: 0 0 0 4px rgba(4, 49, 104, 0.1);
      background: #ffffff;
    }

    .gform-desc-input {
      width: 100%;
      border: 1.5px solid #cbd5e1;
      border-radius: 14px;
      font-size: 15px;
      color: #334155;
      font-family: inherit;
      padding: 16px 20px;
      outline: none;
      background: #ffffff;
      resize: vertical;
      min-height: 100px;
      line-height: 1.6;
      transition: all 0.2s ease;
    }

    .gform-desc-input:focus {
      border-color: var(--lugx-blue);
      box-shadow: 0 0 0 4px rgba(4, 49, 104, 0.1);
    }

    .gform-meta-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
      margin-top: 10px;
    }

    .gform-meta-field {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .gform-meta-field label {
      font-size: 11px;
      font-weight: 800;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .gform-meta-field label i {
      color: var(--lugx-blue);
      font-size: 12px;
    }

    .gform-meta-field input,
    .gform-meta-field select {
      height: 48px;
      border-radius: 12px;
      border: 1.5px solid #cbd5e1;
      padding: 0 16px;
      font-size: 14px;
      font-weight: 600;
      font-family: inherit;
      color: #0f172a;
      outline: none;
      background: #ffffff;
      transition: all 0.2s ease;
    }

    .gform-meta-field input:focus,
    .gform-meta-field select:focus {
      border-color: var(--lugx-blue);
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.1);
    }

    /* Geographic Coverage Card */
    .gform-daerah-grid {
      display: grid;
      grid-template-columns: 1fr 1fr 2fr;
      gap: 16px;
    }

    .enterprise-alert-box {
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      border-radius: 14px;
      padding: 12px 18px;
      display: flex;
      align-items: center;
      gap: 12px;
      color: #1e40af;
      font-size: 13px;
      font-weight: 600;
      margin-top: 16px;
    }

    .enterprise-alert-box i {
      font-size: 16px;
      color: var(--lugx-blue);
    }

    /* Banner Design Card */
    .gform-banner-preview {
      position: relative;
      border-radius: 16px;
      min-height: 150px;
      padding: 24px 28px;
      color: #ffffff;
      overflow: hidden;
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: flex-end;
      box-shadow: 0 8px 24px -2px rgba(15, 23, 42, 0.15);
      transition: all 0.3s ease;
      margin-bottom: 20px;
    }

    .banner-preview-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(180deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.7) 100%);
      z-index: 1;
    }

    .banner-preview-content {
      position: relative;
      z-index: 2;
      width: 100%;
    }

    .banner-preview-badge {
      font-size: 11px;
      font-weight: 800;
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      padding: 4px 12px;
      border-radius: 10px;
      display: inline-block;
      margin-bottom: 8px;
      letter-spacing: 0.5px;
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .banner-preview-content h3 {
      font-size: 22px;
      font-weight: 800;
      margin: 0 0 4px 0;
      color: #ffffff;
      line-height: 1.3;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
    }

    .banner-preview-content p {
      font-size: 13.5px;
      margin: 0;
      color: rgba(255, 255, 255, 0.95);
      font-weight: 600;
    }

    .gform-banner-controls {
      display: grid;
      grid-template-columns: 1fr 1.6fr;
      gap: 18px;
    }

    .banner-color-swatches {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 6px;
      flex-wrap: wrap;
    }

    .swatch-btn {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      border: 2.5px solid #ffffff;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      cursor: pointer;
      transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .swatch-btn:hover {
      transform: scale(1.15);
    }

    .swatch-btn.active {
      outline: 3px solid var(--lugx-blue);
      outline-offset: 2px;
      transform: scale(1.15);
    }

    .swatch-picker {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      border: 1.5px solid #cbd5e1;
      padding: 2px;
      cursor: pointer;
      background: #ffffff;
    }

    /* Enterprise Questions Section */
    .btn-enterprise-add-q {
      background: #eff6ff;
      border: 1.5px solid #bfdbfe;
      color: var(--lugx-blue);
      font-size: 13px;
      font-weight: 800;
      font-family: inherit;
      padding: 8px 18px;
      border-radius: 12px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.2s ease;
    }

    .btn-enterprise-add-q:hover {
      background: var(--lugx-blue);
      color: #ffffff;
      border-color: var(--lugx-blue);
      transform: translateY(-1px);
    }

    .gform-cards-list {
      display: flex;
      flex-direction: column;
      gap: 22px;
      margin-top: 14px;
    }

    /* Individual Dynamic Question Card */
    .gform-card {
      background: #ffffff;
      border-radius: 20px;
      border: 1.5px solid #cbd5e1;
      padding: 28px 34px;
      box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);
      position: relative;
      transition: all 0.25s ease;
    }

    .gform-card:hover {
      box-shadow: 0 10px 28px -4px rgba(4, 49, 104, 0.08);
      border-color: #cbd5e1;
    }

    .gform-card.active, .gform-card:focus-within {
      border-left: 6px solid var(--lugx-blue);
      box-shadow: 0 12px 32px -4px rgba(4, 49, 104, 0.12);
    }

    .gform-card-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 16px;
      flex-wrap: wrap;
    }

    .gform-q-number {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      background: #eff6ff;
      color: var(--lugx-blue);
      font-weight: 800;
      font-size: 13px;
      border-radius: 10px;
      border: 1px solid #bfdbfe;
    }

    .gform-q-type-select {
      height: 42px;
      border-radius: 12px;
      border: 1.5px solid #cbd5e1;
      padding: 0 14px;
      font-size: 13px;
      font-weight: 700;
      font-family: inherit;
      color: #0f172a;
      background: #ffffff;
      outline: none;
      cursor: pointer;
      transition: border-color 0.2s;
    }

    .gform-q-type-select:focus {
      border-color: var(--lugx-blue);
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.1);
    }

    .gform-q-title-input {
      width: 100%;
      height: 52px;
      border: 1.5px solid #cbd5e1;
      border-radius: 12px;
      padding: 12px 18px;
      font-size: 16px;
      font-weight: 700;
      font-family: inherit;
      color: #0f172a;
      outline: none;
      transition: all 0.2s ease;
      margin-bottom: 12px;
      background: #ffffff;
    }

    .gform-q-title-input:focus {
      border-color: var(--lugx-blue);
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.1);
      background: #ffffff;
    }

    .gform-q-desc-input {
      width: 100%;
      height: 44px;
      border: 1.5px solid #e2e8f0;
      border-radius: 10px;
      padding: 10px 16px;
      font-size: 14px;
      font-family: inherit;
      color: #475569;
      outline: none;
      margin-bottom: 18px;
      background: #f8fafc;
      transition: border-color 0.2s;
    }

    .gform-q-desc-input:focus {
      border-color: var(--lugx-blue);
      border-style: solid;
    }

    /* Options List with Dynamic Score/Value Inputs */
    .gform-options-container {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 16px;
    }

    .gform-option-row {
      display: flex;
      align-items: center;
      gap: 14px;
      background: #f8fafc;
      padding: 10px 16px;
      border-radius: 12px;
      border: 1.5px solid #e2e8f0;
      transition: all 0.2s ease;
    }

    .gform-option-row:hover {
      background: #ffffff;
      border-color: #cbd5e1;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .gform-opt-icon {
      color: #94a3b8;
      font-size: 15px;
      width: 20px;
      text-align: center;
    }

    .gform-opt-input {
      flex: 1;
      height: 44px;
      border: 1.5px solid #cbd5e1;
      border-radius: 10px;
      padding: 8px 16px;
      font-size: 14.5px;
      font-weight: 600;
      font-family: inherit;
      color: #0f172a;
      outline: none;
      background: #ffffff;
      transition: border-color 0.2s;
    }

    .gform-opt-input:focus {
      border-color: var(--lugx-blue);
    }

    .gform-val-box {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      height: 44px;
      background: #ecfdf5;
      border: 1.5px solid #a7f3d0;
      border-radius: 10px;
      padding: 0 14px;
    }

    .gform-val-lbl {
      font-size: 11px;
      font-weight: 800;
      color: #065f46;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .gform-val-input {
      width: 52px;
      border: none;
      background: transparent;
      font-size: 13.5px;
      font-weight: 800;
      color: #065f46;
      text-align: center;
      outline: none;
    }

    .btn-remove-opt {
      background: transparent;
      border: none;
      color: var(--lugx-blue);
      font-size: 16px;
      cursor: pointer;
      padding: 4px 6px;
      border-radius: 6px;
      transition: all 0.2s;
    }

    .btn-remove-opt:hover {
      color: var(--lugx-blue-dark);
      background: rgba(4, 49, 104, 0.08);
    }

    /* Seragam Icon Navy Studio Pembuat Survei */
    .gform-studio-section i,
    .gform-card i,
    .gform-opt-icon,
    .gform-opt-icon i,
    .gform-val-box i,
    .btn-q-ctrl i,
    .btn-remove-opt i,
    .btn-add-opt i,
    .btn-preset i,
    .gform-scale-settings i,
    .gform-card-footer i {
      color: var(--lugx-blue) !important;
    }

    /* Add Option & Presets Bar */
    .gform-opt-actions-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
      margin-top: 6px;
    }

    .btn-add-opt {
      background: transparent;
      border: 1.5px dashed var(--lugx-blue);
      color: var(--lugx-blue);
      font-size: 12.5px;
      font-weight: 700;
      font-family: inherit;
      padding: 7px 16px;
      border-radius: 10px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s;
    }

    .btn-add-opt:hover {
      background: #eff6ff;
    }

    .gform-preset-wrap {
      display: flex;
      align-items: center;
      gap: 6px;
      flex-wrap: wrap;
    }

    .gform-preset-lbl {
      font-size: 11px;
      font-weight: 700;
      color: #64748b;
    }

    .btn-preset {
      background: #f1f5f9;
      border: 1px solid #cbd5e1;
      color: #334155;
      font-size: 11px;
      font-weight: 700;
      font-family: inherit;
      padding: 5px 10px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .btn-preset:hover {
      background: #e2e8f0;
      color: #0f172a;
    }

    /* Linear Scale Settings in Builder */
    .gform-scale-settings {
      display: flex;
      align-items: center;
      gap: 16px;
      background: #f8fafc;
      padding: 14px 18px;
      border-radius: 12px;
      border: 1px solid #e2e8f0;
      margin-bottom: 18px;
      flex-wrap: wrap;
    }

    .gform-scale-group {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .gform-scale-group label {
      font-size: 12px;
      font-weight: 700;
      color: #64748b;
    }

    .gform-scale-group input,
    .gform-scale-group select {
      height: 38px;
      border-radius: 8px;
      border: 1px solid #cbd5e1;
      padding: 0 10px;
      font-size: 12.5px;
      font-family: inherit;
      outline: none;
    }

    /* Card Footer Controls */
    .gform-card-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding-top: 16px;
      margin-top: 14px;
      border-top: 1px solid #f1f5f9;
      flex-wrap: wrap;
      gap: 12px;
    }

    .gform-card-ctrls {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-q-ctrl {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      border: 1.5px solid #cbd5e1;
      background: #ffffff;
      color: var(--lugx-blue);
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      transition: all 0.2s;
    }

    .btn-q-ctrl:hover {
      background: #eff6ff;
      color: var(--lugx-blue);
      border-color: var(--lugx-blue);
    }

    .btn-q-ctrl.del:hover {
      background: rgba(4, 49, 104, 0.08);
      color: var(--lugx-blue);
      border-color: var(--lugx-blue);
    }

    /* Custom Toggle Switch for Required */
    .gform-switch-lbl {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      font-weight: 700;
      color: #475569;
      cursor: pointer;
    }

    .gform-switch {
      position: relative;
      display: inline-block;
      width: 42px;
      height: 24px;
    }

    .gform-switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .gform-slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #cbd5e1;
      transition: .3s;
      border-radius: 24px;
    }

    .gform-slider:before {
      position: absolute;
      content: "";
      height: 18px;
      width: 18px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      transition: .3s;
      border-radius: 50%;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
    }

    .gform-switch input:checked + .gform-slider {
      background-color: var(--lugx-blue);
    }

    .gform-switch input:checked + .gform-slider:before {
      transform: translateX(18px);
    }

    /* Big Dropzone Add Button at Question Cards Bottom */
    .enterprise-add-q-card-bottom {
      background: #ffffff;
      border: 2px dashed #93c5fd;
      border-radius: 18px;
      padding: 22px;
      text-align: center;
      cursor: pointer;
      color: var(--lugx-blue);
      font-weight: 800;
      font-size: 14.5px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
      box-shadow: 0 2px 10px rgba(4, 49, 104, 0.03);
    }

    .enterprise-add-q-card-bottom:hover {
      background: #eff6ff;
      border-color: var(--lugx-blue);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(4, 49, 104, 0.08);
    }

    /* Enterprise Sticky Bottom Bar */
    .gform-bottom-bar {
      position: sticky;
      bottom: 24px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-radius: 20px;
      padding: 16px 28px;
      box-shadow: 0 12px 35px rgba(15, 23, 42, 0.12), 0 2px 6px rgba(15, 23, 42, 0.06);
      border: 1px solid rgba(226, 232, 240, 0.9);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      z-index: 100;
    }

    .builder-bottom-status {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 13px;
      font-weight: 700;
      color: #475569;
    }

    .builder-bottom-status i {
      color: #059669;
      font-size: 15px;
    }

    .btn-add-q-card {
      background: #eff6ff;
      color: var(--lugx-blue);
      border: 1.5px solid #bfdbfe;
      font-size: 13.5px;
      font-weight: 800;
      font-family: inherit;
      padding: 11px 22px;
      border-radius: 14px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.25s;
    }

    .btn-add-q-card:hover {
      background: var(--lugx-blue);
      color: #ffffff;
      border-color: var(--lugx-blue);
    }

    .btn-save-gform {
      background: linear-gradient(135deg, var(--lugx-red) 0%, #991b1b 100%);
      color: #ffffff;
      border: none;
      font-size: 14px;
      font-weight: 800;
      font-family: inherit;
      padding: 12px 28px;
      border-radius: 14px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 6px 20px rgba(180, 8, 20, 0.35);
      transition: all 0.25s;
    }

    .btn-save-gform:hover {
      background: linear-gradient(135deg, #9b0711 0%, #7f1d1d 100%);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(180, 8, 20, 0.45);
    }

    @media (max-width: 991px) {
      .gform-meta-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .gform-daerah-grid {
        grid-template-columns: 1fr;
      }
      .gform-banner-controls {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 768px) {
      .gform-container {
        padding: 0 16px;
      }
      .enterprise-builder-card {
        padding: 24px 20px;
      }
      .gform-meta-grid {
        grid-template-columns: 1fr;
      }
      .gform-bottom-bar {
        flex-direction: column;
        align-items: stretch;
        padding: 16px;
      }
      .builder-studio-bar {
        flex-direction: column;
        align-items: flex-start;
      }
    }

    /* ==========================================================================
       MODAL PENGISIAN KUESIONER RESPONDEN (DENGAN KETERANGAN DAERAH SURVEI)
       ========================================================================== */
    .survey-respondent-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(4, 49, 104, 0.75);
      backdrop-filter: blur(8px);
      z-index: 2200;
      align-items: center;
      justify-content: center;
      padding: 20px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .survey-respondent-overlay.active {
      display: flex;
      opacity: 1;
    }

    .survey-respondent-box {
      background: #f1f5f9;
      width: 100%;
      max-width: 960px;
      max-height: 94vh;
      border-radius: 20px;
      overflow-y: auto;
      box-shadow: 0 24px 60px rgba(15, 23, 42, 0.22);
      border: 1px solid #cbd5e1;
      position: relative;
      display: flex;
      flex-direction: column;
      padding-bottom: 24px;
    }

    /* ==========================================================================
       GOOGLE FORMS / ENTERPRISE FORM HEADER BANNER & TITLE CARD
       (Persis seperti Gambar Contoh Referensi Pengguna)
       ========================================================================== */
    /* 1. Header Image Banner Landscape di Atas */
    .gform-banner-img-wrap {
      padding: 18px 24px 0 24px;
      position: relative;
      width: 100%;
    }

    .gform-banner-img {
      width: 100%;
      height: 200px;
      border-radius: 12px;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      box-shadow: 0 2px 10px rgba(15, 23, 42, 0.08);
      border: 1px solid rgba(203, 213, 225, 0.7);
      transition: all 0.3s ease;
      background-color: #043168;
    }

    /* 2. Kartu Judul Formulir (Form Title Card) */
    .gform-title-card {
      margin: 16px 24px 8px 24px;
      background: #ffffff;
      border-radius: 0 12px 12px 12px;
      border: 1px solid #cbd5e1;
      box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
      position: relative;
    }

    /* Section Tab di Kiri Atas Kartu (Seperti 'Section 1 of 3' di Contoh) */
    .gform-card-top-bar {
      position: relative;
      width: 100%;
    }

    .gform-section-badge {
      position: absolute;
      bottom: 100%;
      left: -1px;
      background: #475569;
      color: #ffffff;
      font-size: 13px;
      font-weight: 700;
      padding: 7px 18px;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
      letter-spacing: 0.3px;
      box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.04);
      display: inline-flex;
      align-items: center;
      gap: 7px;
    }

    .gform-card-accent-line {
      height: 8px;
      background: #475569;
      border-top-right-radius: 11px;
      width: 100%;
    }

    /* Badan Kartu Judul */
    .gform-card-body {
      padding: 24px 28px 22px 28px;
    }

    .gform-title-row {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 16px;
      margin-bottom: 14px;
    }

    .gform-main-title {
      font-size: 26px;
      font-weight: 700;
      color: #1e293b;
      margin: 0;
      line-height: 1.35;
      letter-spacing: -0.2px;
      flex: 1;
    }

    .gform-title-icons {
      display: flex;
      align-items: center;
      gap: 6px;
      color: #64748b;
      padding-top: 4px;
    }

    .gform-icon-btn {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: #64748b;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .gform-icon-btn:hover {
      background: #f1f5f9;
      color: #0f172a;
    }

    /* Deskripsi & Bullet Points (Google Forms Clean Style) */
    .gform-desc-wrap {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .gform-desc-lead {
      font-size: 13.5px;
      color: #334155;
      line-height: 1.65;
      margin: 0;
    }

    .gform-meta-bullets {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-top: 4px;
      padding-top: 12px;
      border-top: 1px dashed #e2e8f0;
    }

    .gform-bullet-item {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 13px;
      color: #475569;
      line-height: 1.5;
    }

    .gform-bullet-item i {
      color: #0284c7;
      font-size: 13px;
      width: 16px;
      text-align: center;
      flex-shrink: 0;
    }

    .gform-bullet-item strong {
      color: #0f172a;
    }


    /* Floating Close Modal Button */
    .btn-close-resp-modal {
      position: absolute;
      top: 12px;
      right: 16px;
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: rgba(15, 23, 42, 0.7);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1.5px solid rgba(255, 255, 255, 0.45);
      color: #ffffff;
      font-size: 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      z-index: 50;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
    }

    .btn-close-resp-modal:hover {
      background: #b40814;
      border-color: #ff6b75;
      transform: scale(1.08) rotate(90deg);
      box-shadow: 0 6px 18px rgba(180, 8, 20, 0.45);
    }

    /* STICKY MULTI-STEP PROGRESS & NAVIGATION BAR */
    .survey-sticky-progress {
      position: sticky;
      top: 0;
      background: #ffffff;
      padding: 12px 28px;
      z-index: 10;
      border-bottom: 1px solid #e2e8f0;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .survey-steps-nav {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }

    .step-label-short,
    .btn-txt-short {
      display: none;
    }

    .survey-step-tab {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      font-weight: 700;
      color: #94a3b8;
      cursor: pointer;
      transition: color 0.2s;
    }

    .survey-step-tab .step-num {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: #f1f5f9;
      color: #64748b;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 800;
      transition: all 0.2s;
    }

    .survey-step-tab.active {
      color: var(--lugx-blue);
    }

    .survey-step-tab.active .step-num {
      background: var(--lugx-blue);
      color: #ffffff;
    }

    .survey-step-tab.completed {
      color: #059669;
    }

    .survey-step-tab.completed .step-num {
      background: #10b981;
      color: #ffffff;
    }

    .survey-step-divider {
      color: #cbd5e1;
      font-size: 12px;
    }

    .survey-progress-info {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .survey-progress-track {
      flex: 1;
      height: 7px;
      background: #e2e8f0;
      border-radius: 10px;
      overflow: hidden;
    }

    .survey-progress-fill {
      height: 100%;
      background: linear-gradient(90deg, var(--lugx-blue), #059669);
      width: 0%;
      transition: width 0.35s ease;
      border-radius: 10px;
    }

    .survey-progress-text {
      font-size: 11.5px;
      font-weight: 700;
      color: #64748b;
      white-space: nowrap;
    }

    /* MULTI-STEP SURVEY PAGES */
    .survey-step-page {
      padding: 28px 32px 42px 32px;
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .resp-step-intro {
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      border-radius: 16px;
      padding: 18px 24px;
      margin-bottom: 8px;
      box-shadow: 0 2px 10px rgba(4, 49, 104, 0.03);
    }

    .resp-step-intro h4 {
      font-size: 15px;
      font-weight: 800;
      color: var(--lugx-blue);
      margin: 0 0 6px 0;
      display: flex;
      align-items: center;
      gap: 8px;
      text-transform: uppercase;
      letter-spacing: 0.4px;
    }

    .resp-step-intro p {
      font-size: 13.5px;
      color: #475569;
      margin: 0;
      line-height: 1.55;
    }

    /* VERTICAL CARDS (BERGULIR KE BAWAH, BERSIH & NORMAL) */
    .resp-vertical-card {
      background: #ffffff;
      border: 1.5px solid #e2e8f0;
      border-radius: 18px;
      padding: 24px 26px;
      box-shadow: 0 4px 16px rgba(4, 49, 104, 0.04);
      display: flex;
      flex-direction: column;
      gap: 16px;
      margin-bottom: 6px;
    }

    .resp-card-title {
      font-size: 14px;
      font-weight: 800;
      color: var(--lugx-dark);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 10px;
      padding-bottom: 12px;
      border-bottom: 1.5px solid #f1f5f9;
    }

    .resp-grid-2col {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
    }

    .resp-field {
      display: flex;
      flex-direction: column;
    }

    .resp-field label {
      font-size: 12px;
      font-weight: 700;
      color: #475569;
      margin-bottom: 6px;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .resp-field input,
    .resp-field select,
    .resp-field textarea {
      height: 46px;
      border-radius: 12px;
      border: 1.5px solid #cbd5e1;
      padding: 0 16px;
      font-size: 13.5px;
      font-family: inherit;
      color: var(--lugx-dark);
      outline: none;
      background: #ffffff;
      transition: all 0.25s ease;
    }

    .resp-field textarea {
      height: auto;
      padding: 12px 16px;
      line-height: 1.5;
    }

    .resp-field input:focus,
    .resp-field select:focus,
    .resp-field textarea:focus {
      border-color: var(--lugx-blue);
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.12);
      background: #ffffff;
    }

    /* RESPONDENT QUESTION CARDS IN STEP 2 */
    .resp-q-card {
      background: #ffffff;
      border: 1.5px solid #e2e8f0;
      border-radius: 18px;
      padding: 22px 26px;
      margin-bottom: 20px;
      box-shadow: 0 4px 14px rgba(4, 49, 104, 0.03);
      transition: all 0.25s ease;
    }

    .resp-q-card:hover {
      border-color: #93c5fd;
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(4, 49, 104, 0.08);
    }

    .resp-q-card.answered {
      border-color: #10b981;
      background: #fafdfc;
    }

    .resp-q-header {
      display: flex;
      align-items: baseline;
      gap: 10px;
      margin-bottom: 8px;
    }

    .resp-q-badge {
      font-size: 11.5px;
      font-weight: 800;
      color: var(--lugx-blue);
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      padding: 3px 10px;
      border-radius: 8px;
    }

    .resp-q-title {
      font-size: 15px;
      font-weight: 700;
      color: var(--lugx-dark);
      line-height: 1.45;
    }

    .resp-q-required {
      color: var(--lugx-red);
      font-weight: 800;
      margin-left: 4px;
    }

    .resp-q-desc {
      font-size: 13px;
      color: #64748b;
      margin-bottom: 16px;
      line-height: 1.55;
    }

    /* Radio / Checkbox Interactive Options */
    .resp-options-list {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .resp-opt-label {
      display: flex;
      align-items: center;
      gap: 14px;
      background: #ffffff;
      border: 1.5px solid #e2e8f0;
      border-radius: 12px;
      padding: 12px 18px;
      cursor: pointer;
      transition: all 0.2s ease;
      user-select: none;
    }

    .resp-opt-label:hover {
      border-color: var(--lugx-blue);
      background: #f8fafc;
      transform: translateX(2px);
    }

    .resp-opt-label.selected {
      border-color: var(--lugx-blue);
      background: #eff6ff;
      box-shadow: 0 2px 8px rgba(4, 49, 104, 0.08);
    }

    .resp-opt-radio,
    .resp-opt-checkbox {
      width: 17px;
      height: 17px;
      accent-color: var(--lugx-blue);
      cursor: pointer;
    }

    .resp-opt-text {
      flex: 1;
      font-size: 13.5px;
      font-weight: 600;
      color: var(--lugx-dark);
    }

    /* Linear Scale Rating */
    .resp-scale-box {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-top: 8px;
    }

    .resp-scale-buttons {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .btn-scale-choice {
      flex: 1;
      min-width: 44px;
      height: 42px;
      border-radius: 10px;
      border: 1.5px solid #cbd5e1;
      background: #ffffff;
      font-size: 14px;
      font-weight: 800;
      color: var(--lugx-dark);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
    }

    .btn-scale-choice:hover {
      border-color: var(--lugx-blue);
      background: #eff6ff;
    }

    .btn-scale-choice.selected {
      background: var(--lugx-blue);
      color: #ffffff;
      border-color: var(--lugx-blue);
    }

    .resp-scale-labels {
      display: flex;
      justify-content: space-between;
      font-size: 11.5px;
      font-weight: 700;
      color: #64748b;
      padding: 0 4px;
    }

    /* MULTI-STEP ACTION FOOTER */
    .survey-step-actions {
      padding: 18px 28px 24px 28px;
      background: #ffffff;
      border-top: 1px solid #e2e8f0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 14px;
    }

    .btn-step-primary {
      background: var(--lugx-blue);
      color: #ffffff;
      font-size: 14px;
      font-weight: 800;
      font-family: inherit;
      padding: 12px 26px;
      border-radius: 12px;
      border: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.25s ease;
    }

    .btn-step-primary:hover {
      background: #062b59;
      transform: translateY(-2px);
    }

    .btn-step-secondary {
      background: #f1f5f9;
      color: #475569;
      font-size: 13.5px;
      font-weight: 700;
      font-family: inherit;
      padding: 11px 20px;
      border-radius: 12px;
      border: 1px solid #cbd5e1;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.2s;
    }

    .btn-step-secondary:hover {
      background: #e2e8f0;
      color: var(--lugx-dark);
    }

    .btn-submit-survey {
      background: var(--lugx-red);
      color: #ffffff;
      font-size: 14px;
      font-weight: 800;
      font-family: inherit;
      padding: 12px 30px;
      border-radius: 12px;
      border: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 6px 18px rgba(180, 8, 20, 0.35);
      transition: all 0.25s ease;
    }

    .btn-submit-survey:hover {
      background: #9b0711;
      transform: translateY(-2px);
    }

    .btn-submit-survey:hover {
      background: #9b0711;
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(180, 8, 20, 0.45);
    }

    /* ==========================================================================
       REKAPITULASI RESPON & DAERAH SURVEI SECTION
       ========================================================================== */
    .rekap-section {
      display: none;
      padding: 30px 0 80px 0;
      background: #ffffff;
    }

    .rekap-section.active {
      display: block;
    }

    .rekap-header-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }

    .rekap-kpi-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      margin-bottom: 30px;
    }

    .rekap-kpi-card {
      background: var(--lugx-light-gray);
      border-radius: 20px;
      padding: 22px;
      border: 1px solid #e2e8f0;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .rekap-kpi-icon {
      width: 50px;
      height: 50px;
      border-radius: 14px;
      background: var(--lugx-blue);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
    }

    .rekap-kpi-val {
      font-size: 26px;
      font-weight: 800;
      color: var(--lugx-dark);
      line-height: 1;
    }

    .rekap-kpi-lbl {
      font-size: 12px;
      font-weight: 700;
      color: var(--lugx-gray);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-top: 4px;
    }

    .rekap-table-card {
      background: #ffffff;
      border-radius: 20px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
      padding: 24px;
      overflow-x: auto;
    }

    .rekap-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13.5px;
    }

    .rekap-table th {
      background: #f8fafc;
      padding: 12px 14px;
      font-weight: 800;
      color: var(--lugx-blue);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border-bottom: 2px solid #e2e8f0;
      text-align: left;
    }

    .rekap-table td {
      padding: 14px;
      border-bottom: 1px solid #f1f5f9;
      color: var(--lugx-dark);
    }

    .rekap-table tr:hover td {
      background: #f8fafc;
    }

    /* ==========================================================================
       RESPONSIVE DESIGN SYSTEM UNTUK FORM ISI SURVEI USER UMUM (TABLET & SMARTPHONE)
       ========================================================================== */
    @media (max-width: 991.98px) {
      .surveyor-control-bar {
        flex-direction: column;
        align-items: flex-start;
      }
      .surveyor-bar-tabs {
        width: 100%;
        overflow-x: auto;
      }
      .gform-meta-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .gform-daerah-inputs {
        grid-template-columns: 1fr;
      }
      .resp-grid-2col,
      .resp-grid-4col {
        grid-template-columns: 1fr;
      }
      .rekap-kpi-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      /* Tablet Specific Modal & Form Sizing */
      .survey-respondent-overlay {
        padding: 16px;
      }
      .survey-respondent-box {
        max-width: 780px;
        max-height: 94vh;
        border-radius: 18px;
      }
      .survey-custom-banner {
        min-height: 150px;
        padding: 24px 28px 20px 28px;
      }
      .survey-custom-banner h2 {
        font-size: 20px;
        max-width: calc(100% - 60px);
      }
      .survey-sticky-progress {
        padding: 12px 24px;
      }
      .survey-step-page {
        padding: 24px 26px 36px 26px;
        gap: 20px;
      }
      .resp-vertical-card,
      .resp-q-card {
        padding: 20px 22px;
      }
      .btn-scale-choice {
        min-width: 40px;
        height: 44px;
        font-size: 15px;
      }
      #respFormMiniMap {
        height: 200px;
      }
      .survey-step-actions {
        padding: 16px 22px;
      }
    }

    /* Smartphone Breakpoint (< 768px) */
    @media (max-width: 767.98px) {
      .survey-respondent-overlay {
        padding: 0 !important;
        align-items: flex-end;
      }

      .survey-respondent-box {
        width: 100% !important;
        max-width: 100% !important;
        height: 100% !important;
        max-height: 100vh !important;
        border-radius: 0 !important;
        border: none !important;
        box-shadow: none !important;
        -webkit-overflow-scrolling: touch !important;
      }

      .gform-banner-img-wrap {
        padding: 14px 14px 0 14px !important;
      }

      .gform-banner-img {
        height: 140px !important;
        border-radius: 10px !important;
      }

      .gform-title-card {
        margin: 14px 14px 8px 14px !important;
        border-radius: 0 10px 10px 10px !important;
      }

      .gform-card-body {
        padding: 18px 16px !important;
      }

      .gform-main-title {
        font-size: 20px !important;
        line-height: 1.35 !important;
      }

      .gform-section-badge {
        font-size: 11px !important;
        padding: 5px 12px !important;
      }

      .gform-desc-lead {
        font-size: 12.5px !important;
        line-height: 1.55 !important;
      }

      .gform-bullet-item {
        font-size: 12px !important;
      }


      .btn-close-resp-modal {
        top: 8px !important;
        right: 8px !important;
        width: 32px !important;
        height: 32px !important;
        font-size: 13px !important;
      }

      /* Sticky Top Progress Header */
      .survey-sticky-progress {
        position: sticky !important;
        top: 0 !important;
        padding: 8px 14px !important;
        gap: 6px !important;
        z-index: 25 !important;
        background: #ffffff !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06) !important;
      }

      .survey-steps-nav {
        gap: 6px !important;
      }

      .survey-step-tab {
        font-size: 12px !important;
        gap: 6px !important;
      }

      .survey-step-tab .step-num {
        width: 22px !important;
        height: 22px !important;
        font-size: 10px !important;
      }

      .survey-step-divider {
        font-size: 9px !important;
      }

      .survey-progress-track {
        height: 5px !important;
      }

      .survey-progress-text {
        font-size: 10.5px !important;
      }

      /* Multi-Step Pages - Extra bottom padding for comfortable thumb reach */
      .survey-step-page {
        padding: 14px 14px 90px 14px !important;
        gap: 12px !important;
      }

      .resp-step-intro {
        padding: 12px 14px !important;
        border-radius: 12px !important;
        margin-bottom: 2px !important;
      }

      .resp-step-intro h4 {
        font-size: 13.5px !important;
        gap: 6px !important;
        margin-bottom: 3px !important;
      }

      .resp-step-intro p {
        font-size: 11.5px !important;
        line-height: 1.45 !important;
      }

      .resp-vertical-card {
        padding: 14px 14px !important;
        border-radius: 14px !important;
        gap: 12px !important;
      }

      .resp-card-title {
        font-size: 12.5px !important;
        padding-bottom: 8px !important;
        gap: 6px !important;
      }

      /* Form Input Fields - Font size 16px to prevent iOS auto-zoom */
      .resp-field label {
        font-size: 11.5px !important;
        margin-bottom: 5px !important;
      }

      .resp-field input,
      .resp-field select,
      .resp-field textarea {
        height: 48px !important;
        font-size: 16px !important;
        border-radius: 10px !important;
        padding: 0 14px !important;
      }

      .resp-field textarea {
        height: auto !important;
        min-height: 85px !important;
        padding: 10px 14px !important;
      }

      /* Step 2: Question Cards */
      .resp-q-card {
        padding: 16px 14px !important;
        border-radius: 14px !important;
      }

      .resp-q-card.answered {
        border-color: #10b981 !important;
        background: #f0fdf4 !important;
        box-shadow: 0 2px 10px rgba(16, 185, 129, 0.08) !important;
      }

      .resp-q-card.answered .resp-q-badge {
        background: #dcfce7 !important;
        color: #15803d !important;
      }

      .resp-q-header {
        gap: 6px !important;
        margin-bottom: 6px !important;
      }

      .resp-q-badge {
        font-size: 10.5px !important;
        padding: 2px 7px !important;
      }

      .resp-q-title {
        font-size: 14px !important;
        line-height: 1.45 !important;
      }

      .resp-q-desc {
        font-size: 11.5px !important;
        margin-bottom: 10px !important;
      }

      /* Radio / Checkbox Large Tap Target */
      .resp-options-list {
        gap: 8px !important;
      }

      .resp-opt-label {
        padding: 12px 14px !important;
        min-height: 48px !important;
        border-radius: 12px !important;
        gap: 10px !important;
        -webkit-tap-highlight-color: transparent !important;
      }

      .resp-opt-text {
        font-size: 13.5px !important;
        line-height: 1.35 !important;
      }

      .resp-opt-radio,
      .resp-opt-checkbox {
        width: 18px !important;
        height: 18px !important;
      }

      /* Likert Scale Responsive Rating Buttons */
      .resp-scale-buttons {
        display: flex !important;
        gap: 6px !important;
        width: 100% !important;
      }

      .btn-scale-choice {
        flex: 1 !important;
        min-width: 0 !important;
        height: 46px !important;
        font-size: 16px !important;
        font-weight: 800 !important;
        border-radius: 10px !important;
        -webkit-tap-highlight-color: transparent !important;
      }

      .resp-scale-labels {
        font-size: 10px !important;
        margin-top: 4px !important;
      }

      /* GPS & Mini-Map Responsiveness */
      #respFormMiniMap {
        height: 180px !important;
        border-radius: 10px !important;
      }

      .resp-gps-header {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 8px !important;
      }

      .btn-geo-detect {
        width: 100% !important;
        justify-content: center !important;
        height: 38px !important;
        font-size: 12px !important;
      }

      .resp-gps-coords-display {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 6px !important;
        padding: 8px 10px !important;
        border-radius: 10px !important;
      }

      .resp-gps-field span.lbl {
        font-size: 9.5px !important;
      }

      .resp-gps-field span.val {
        font-size: 11.5px !important;
      }

      /* Floating / Sticky Mobile Action Bar */
      .survey-step-actions {
        position: sticky !important;
        bottom: 0 !important;
        left: 0 !important;
        right: 0 !important;
        background: rgba(255, 255, 255, 0.96) !important;
        backdrop-filter: blur(10px) !important;
        padding: 10px 14px calc(10px + env(safe-area-inset-bottom, 0px)) 14px !important;
        border-top: 1px solid #e2e8f0 !important;
        box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.06) !important;
        z-index: 30 !important;
        gap: 10px !important;
      }

      .btn-step-primary,
      .btn-submit-survey {
        flex: 1 !important;
        height: 46px !important;
        padding: 0 16px !important;
        font-size: 13.5px !important;
        border-radius: 12px !important;
        justify-content: center !important;
      }

      .btn-step-secondary {
        height: 46px !important;
        padding: 0 16px !important;
        font-size: 13px !important;
        border-radius: 12px !important;
        justify-content: center !important;
      }
    }

    /* Extra Small Screen (< 576px) */
    @media (max-width: 576px) {
      .step-label-full,
      .btn-txt-full {
        display: none !important;
      }
      .step-label-short,
      .btn-txt-short {
        display: inline !important;
      }
      .gform-meta-grid {
        grid-template-columns: 1fr;
      }
      .rekap-kpi-grid {
        grid-template-columns: 1fr;
      }
      .survey-resp-header,
      .survey-resp-body,
      .survey-resp-footer {
        padding-left: 16px;
        padding-right: 16px;
      }
    }
    /* ==========================================================================
       QUICK FILTER PILLS / CHIPS FOR SURVEY TYPES (IKM, SOSIAL, DLL)
       ========================================================================== */
    .survey-type-pills-wrap {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 20px;
      padding-bottom: 16px;
      border-bottom: 1px dashed #e2e8f0;
      flex-wrap: wrap;
    }

    .type-pills-label {
      font-size: 13px;
      font-weight: 700;
      color: var(--lugx-dark);
      display: inline-flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
    }

    .type-pills-label i {
      color: var(--lugx-red);
    }

    .type-pills-scroller {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }

    .type-pill-btn {
      background: #ffffff;
      border: 1.5px solid #cbd5e1;
      border-radius: 20px;
      padding: 7px 16px;
      font-size: 13px;
      font-weight: 600;
      color: #334155;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.25s ease;
      font-family: inherit;
    }

    .type-pill-btn:hover {
      border-color: var(--lugx-blue);
      color: var(--lugx-blue);
      transform: translateY(-1px);
    }

    .type-pill-btn.active {
      background: linear-gradient(135deg, var(--lugx-blue) 0%, #0d3d7c 100%);
      color: #ffffff;
      border-color: transparent;
      box-shadow: 0 4px 12px rgba(4, 49, 104, 0.25);
    }

    .type-pill-btn.active .pill-badge {
      background: var(--lugx-red);
      color: #ffffff;
      box-shadow: 0 2px 6px rgba(180, 8, 20, 0.4);
    }

    .pill-badge {
      background: #f1f5f9;
      color: #475569;
      padding: 2px 8px;
      border-radius: 12px;
      font-size: 11px;
      font-weight: 800;
      transition: all 0.25s ease;
    }

    /* ==========================================================================
       SURVEYOR CONTROLS & EXCEL EXPORT BUTTONS
       ========================================================================== */
    .card-surveyor-actions {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 6px;
      margin-top: 10px;
      padding-top: 10px;
      border-top: 1px dashed #e2e8f0;
    }

    .btn-action-edit,
    .btn-action-rekap,
    .btn-action-excel,
    .btn-action-del {
      height: 34px;
      border-radius: 8px;
      font-size: 11.5px;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .btn-action-edit {
      background: #eff6ff;
      color: #0369a1;
      border: 1px solid #bfdbfe;
    }

    .btn-action-edit:hover {
      background: #0284c7;
      color: #ffffff;
      border-color: #0284c7;
      transform: translateY(-1px);
    }

    .btn-action-rekap {
      background: #f8fafc;
      color: #475569;
      border: 1px solid #cbd5e1;
    }

    .btn-action-rekap:hover {
      background: var(--lugx-dark);
      color: #ffffff;
      border-color: var(--lugx-dark);
      transform: translateY(-1px);
    }

    .btn-action-excel {
      background: #ecfdf5;
      color: #047857;
      border: 1px solid #a7f3d0;
    }

    .btn-action-excel:hover {
      background: #059669;
      color: #ffffff;
      border-color: #059669;
      transform: translateY(-1px);
    }

    .btn-action-del {
      background: #fef2f2;
      color: #b91c1c;
      border: 1px solid #fecaca;
    }

    .btn-action-del:hover {
      background: #dc2626;
      color: #ffffff;
      border-color: #dc2626;
      transform: translateY(-1px);
    }

    .btn-export-excel {
      background: linear-gradient(135deg, #059669 0%, #047857 100%);
      color: #ffffff;
      border: none;
      padding: 10px 22px;
      border-radius: 12px;
      font-size: 13.5px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.25s ease;
      box-shadow: 0 4px 14px rgba(5, 150, 105, 0.25);
      text-decoration: none;
      font-family: inherit;
    }

    .btn-export-excel:hover {
      background: linear-gradient(135deg, #047857 0%, #065f46 100%);
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(5, 150, 105, 0.4);
      color: #ffffff;
    }

    /* ==========================================================================
       MODAL QR CODE (BERSIH, MINIMALIS, HANYA MUNCUL QR CODE SAJA)
       ========================================================================== */
    .qr-modal-dialog {
      background: #ffffff;
      width: 100%;
      max-width: 380px;
      border-radius: 24px;
      box-shadow: 0 25px 60px rgba(4, 49, 104, 0.3);
      border: 1px solid #e2e8f0;
      overflow: hidden;
      animation: modalFadeIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      position: relative;
    }

    .qr-modal-header {
      background: #ffffff;
      color: var(--lugx-dark);
      padding: 18px 22px 14px 22px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid #f1f5f9;
      position: relative;
    }

    .qr-modal-header h3 {
      font-size: 16px;
      font-weight: 800;
      margin: 0;
      color: var(--lugx-blue);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-close-qr-modal {
      background: #f1f5f9;
      border: none;
      color: #64748b;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
      font-size: 14px;
    }

    .btn-close-qr-modal:hover {
      background: var(--lugx-red);
      color: #ffffff;
      transform: rotate(90deg);
    }

    .qr-modal-body {
      padding: 24px 22px;
      text-align: center;
      background: #ffffff;
    }

    /* White Crisp Frame untuk QR Code */
    .qr-clean-card {
      background: #ffffff;
      border: 1.5px solid #e2e8f0;
      border-radius: 18px;
      padding: 18px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 24px rgba(4, 49, 104, 0.06);
      margin-bottom: 18px;
    }

    .qr-clean-card img,
    .qr-clean-card canvas {
      display: block;
      margin: 0 auto;
      border-radius: 8px;
    }

    .qr-url-input-wrap {
      display: flex;
      align-items: center;
      background: #f8fafc;
      border: 1.5px solid #e2e8f0;
      border-radius: 12px;
      padding: 4px 6px 4px 12px;
      margin-bottom: 16px;
      transition: all 0.2s ease;
    }

    .qr-url-input-wrap:focus-within {
      border-color: var(--lugx-blue);
      background: #ffffff;
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.1);
    }

    .qr-url-icon {
      color: #94a3b8;
      font-size: 13px;
      margin-right: 8px;
    }

    .qr-url-input {
      border: none;
      background: transparent;
      font-size: 12px;
      color: #1e293b;
      font-weight: 600;
      width: 100%;
      outline: none;
      font-family: inherit;
    }

    .btn-copy-link-premium {
      background: var(--lugx-blue);
      color: #ffffff;
      border: none;
      padding: 7px 14px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      transition: all 0.2s ease;
      white-space: nowrap;
      font-family: inherit;
    }

    .btn-copy-link-premium:hover {
      background: var(--lugx-red);
      transform: translateY(-1px);
    }

    .btn-download-qr {
      width: 100%;
      height: 46px;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--lugx-blue) 0%, #0d3d7c 100%);
      color: #ffffff;
      font-size: 13.5px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.25s ease;
      box-shadow: 0 6px 18px rgba(4, 49, 104, 0.25);
      font-family: inherit;
    }

    .btn-download-qr:hover {
      background: linear-gradient(135deg, #02234c 0%, #043168 100%);
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(4, 49, 104, 0.35);
    }

    /* ==========================================================================
       MODAL & FLYER BANNER PUBLIKASI SURVEI (SIAP SEBAR & CETAK)
       ========================================================================== */
    .flyer-modal-dialog {
      background: #ffffff;
      width: 100%;
      max-width: 580px;
      border-radius: 24px;
      box-shadow: 0 30px 70px rgba(0, 0, 0, 0.4);
      border: 1px solid #e2e8f0;
      overflow-y: auto;
      max-height: 94vh;
      animation: modalFadeIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .flyer-modal-header {
      background: linear-gradient(135deg, var(--lugx-blue) 0%, #0d3d7c 100%);
      color: #ffffff;
      padding: 18px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .flyer-modal-header h3 {
      font-size: 17px;
      font-weight: 800;
      margin: 0;
      color: #ffffff;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .flyer-modal-body {
      padding: 24px;
      background: #f1f5f9;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* KARTU BANNER PUBLIKASI VISUAL (Yang di-capture ke PNG) */
    .pub-banner-card {
      width: 100%;
      max-width: 480px;
      background: linear-gradient(150deg, #043168 0%, #0a254a 55%, #0b3977 100%);
      color: #ffffff;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 15px 35px rgba(4, 49, 104, 0.35);
      position: relative;
      border: 2px solid rgba(255, 255, 255, 0.15);
    }

    /* Decorative Vector Accents on Flyer */
    .pub-banner-card::before {
      content: '';
      position: absolute;
      top: -60px;
      right: -60px;
      width: 200px;
      height: 200px;
      background: radial-gradient(circle, rgba(180, 8, 20, 0.35) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }

    .pub-banner-card::after {
      content: '';
      position: absolute;
      bottom: 40px;
      left: -40px;
      width: 180px;
      height: 180px;
      background: radial-gradient(circle, rgba(4, 49, 104, 0.45) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }

    .pub-banner-top {
      padding: 22px 24px 16px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid rgba(255, 255, 255, 0.12);
      position: relative;
      z-index: 2;
    }

    .pub-brand-box {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .pub-brand-logo {
      height: 38px;
      width: auto;
      object-fit: contain;
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
    }

    .pub-brand-text {
      font-size: 13px;
      font-weight: 800;
      letter-spacing: 0.5px;
      color: #ffffff;
      line-height: 1.2;
      text-transform: uppercase;
    }

    .pub-brand-text span {
      color: #f87171;
    }

    .pub-badge-verified {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.25);
      color: #ffffff;
      font-size: 11px;
      font-weight: 700;
      padding: 4px 10px;
      border-radius: 12px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .pub-banner-content {
      padding: 24px 24px 20px;
      position: relative;
      z-index: 2;
      text-align: center;
    }

    .pub-type-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--lugx-red);
      color: #ffffff;
      font-size: 11px;
      font-weight: 800;
      padding: 5px 14px;
      border-radius: 20px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 14px;
      box-shadow: 0 4px 12px rgba(180, 8, 20, 0.4);
    }

    .pub-banner-title {
      font-size: 20px;
      font-weight: 800;
      color: #ffffff;
      line-height: 1.35;
      margin-bottom: 12px;
      text-shadow: 0 2px 6px rgba(0,0,0,0.3);
    }

    .pub-banner-instansi {
      font-size: 13.5px;
      color: #e2e8f0;
      font-weight: 600;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    .pub-banner-daerah {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: #f1f5f9;
      font-size: 12px;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 14px;
      margin-bottom: 16px;
    }

    .pub-banner-cta-text {
      font-size: 12.5px;
      color: #cbd5e1;
      line-height: 1.5;
      margin-bottom: 20px;
      max-width: 90%;
      margin-left: auto;
      margin-right: auto;
    }

    /* Centered White QR Card on Flyer */
    .pub-banner-qr-box {
      background: #ffffff;
      border-radius: 22px;
      padding: 20px 22px 18px;
      margin: 0 auto 18px;
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.3);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      max-width: 290px;
      position: relative;
      border: 2px solid rgba(4, 49, 104, 0.08);
    }

    .pub-qr-header {
      font-size: 11.5px;
      font-weight: 800;
      color: var(--lugx-blue);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .pub-qr-pill-tag {
      background: #b40814;
      color: #ffffff;
      font-size: 10px;
      font-weight: 800;
      padding: 2px 8px;
      border-radius: 8px;
      letter-spacing: 0.5px;
    }

    #pubBannerQrCanvas {
      background: #ffffff;
      padding: 8px;
      border-radius: 12px;
      margin-bottom: 10px;
      border: 1.5px dashed #cbd5e1;
    }

    #pubBannerQrCanvas img,
    #pubBannerQrCanvas canvas {
      display: block;
      margin: 0 auto;
    }

    .pub-short-url-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      padding: 4px 12px;
      border-radius: 10px;
      font-size: 11.5px;
      font-weight: 700;
      color: var(--lugx-red);
      word-break: break-all;
      line-height: 1.3;
      margin-bottom: 8px;
    }

    .pub-qr-hint {
      font-size: 10.5px;
      color: #64748b;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .pub-banner-footer {
      background: rgba(0, 0, 0, 0.25);
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      padding: 12px 20px;
      font-size: 11px;
      color: #cbd5e1;
      text-align: center;
      position: relative;
      z-index: 2;
    }

    .pub-banner-footer b {
      color: #ffffff;
    }

    /* Action bar under flyer preview */
    .flyer-control-bar {
      margin-top: 20px;
      width: 100%;
      max-width: 480px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .btn-flyer-dl {
      background: linear-gradient(135deg, #b40814 0%, #e11d48 50%, #b40814 100%);
      background-size: 200% auto;
      color: #ffffff;
      border: none;
      height: 50px;
      border-radius: 25px;
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 0.5px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: all 0.35s ease;
      box-shadow: 0 6px 20px rgba(180, 8, 20, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.25);
      font-family: inherit;
    }

    .btn-flyer-dl:hover {
      background-position: right center;
      transform: translateY(-2px);
      box-shadow: 0 10px 28px rgba(180, 8, 20, 0.55);
    }

    .flyer-secondary-actions {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    .btn-flyer-wa {
      background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
      color: #ffffff;
      border: none;
      height: 44px;
      border-radius: 22px;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 7px;
      transition: all 0.3s ease;
      font-family: inherit;
      text-decoration: none;
      box-shadow: 0 4px 14px rgba(37, 211, 102, 0.35);
    }

    .btn-flyer-wa:hover {
      background: linear-gradient(135deg, #1eb855 0%, #0d7367 100%);
      transform: translateY(-2px);
      box-shadow: 0 8px 22px rgba(37, 211, 102, 0.5);
      color: #ffffff;
    }

    .btn-flyer-copy {
      background: #ffffff;
      color: var(--lugx-blue);
      border: 2px solid var(--lugx-blue);
      height: 44px;
      border-radius: 22px;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 7px;
      transition: all 0.3s ease;
      font-family: inherit;
      box-shadow: 0 2px 8px rgba(4, 49, 104, 0.08);
    }

    .btn-flyer-copy:hover {
      background: var(--lugx-blue);
      color: #ffffff;
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(4, 49, 104, 0.25);
    }
  
    /* ==========================================================================
       GIS GEOSPASIAL & OPENSTREETMAP INFOGRAFIS STYLES
       ========================================================================== */
    .btn-action-map {
      background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
      color: #ffffff;
      border: 1px solid #4338ca;
      font-size: 13px;
      font-weight: 700;
      font-family: inherit;
      padding: 9px 16px;
      border-radius: 12px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 7px;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
      transition: all 0.25s ease;
      text-decoration: none;
    }

    .btn-action-map:hover {
      background: linear-gradient(135deg, #4338ca 0%, #312e81 100%);
      color: #ffffff;
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(79, 70, 229, 0.35);
    }

    .btn-public-gis-map {
      background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
      color: #ffffff;
      border: none;
      font-size: 13px;
      font-weight: 800;
      font-family: inherit;
      padding: 10px 20px;
      border-radius: 14px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 4px 14px rgba(2, 132, 199, 0.28);
      transition: all 0.25s ease;
    }

    .btn-public-gis-map:hover {
      background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(2, 132, 199, 0.4);
    }

    .geo-infografis-section {
      display: none;
      padding: 40px 0 90px 0;
      background: #f8fafc;
      min-height: 85vh;
    }

    .geo-infografis-section.active {
      display: block;
    }

    .geo-header-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 22px;
      padding: 30px 36px;
      box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
      flex-wrap: wrap;
      margin-bottom: 24px;
    }

    .geo-header-left {
      max-width: 650px;
    }

    .geo-badge-tag {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: #eff6ff;
      color: #2563eb;
      font-size: 11.5px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 5px 14px;
      border-radius: 20px;
      border: 1px solid #bfdbfe;
      margin-bottom: 10px;
    }

    .geo-title {
      font-size: 26px;
      font-weight: 800;
      color: #0f172a;
      margin: 0 0 6px 0;
      line-height: 1.25;
    }

    .geo-subtitle {
      font-size: 13.5px;
      color: #64748b;
      margin: 0;
      line-height: 1.5;
    }

    .geo-header-right {
      display: flex;
      flex-direction: column;
      gap: 12px;
      min-width: 280px;
    }

    .geo-survey-selector-wrap {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .geo-survey-selector-wrap label {
      font-size: 11.5px;
      font-weight: 800;
      color: #475569;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .geo-select-custom {
      height: 44px;
      border-radius: 12px;
      border: 1.5px solid #cbd5e1;
      padding: 0 14px;
      font-size: 13px;
      font-weight: 700;
      font-family: inherit;
      color: #0f172a;
      background: #ffffff;
      outline: none;
    }

    .geo-select-custom:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .btn-geo-refresh, .btn-geo-excel {
      padding: 9px 16px;
      font-size: 12.5px;
      font-weight: 700;
      font-family: inherit;
      border-radius: 10px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s;
    }

    .btn-geo-refresh {
      background: #f1f5f9;
      border: 1px solid #cbd5e1;
      color: #334155;
    }

    .btn-geo-refresh:hover {
      background: #e2e8f0;
      color: #0f172a;
    }

    .btn-geo-excel {
      background: #ecfdf5;
      border: 1.5px solid #a7f3d0;
      color: #065f46;
    }

    .btn-geo-excel:hover {
      background: #059669;
      color: #ffffff;
      border-color: #059669;
    }

    /* KPI Grid */
    .geo-kpi-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px;
      margin-bottom: 24px;
    }

    .geo-kpi-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 18px;
      padding: 20px 24px;
      box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
      display: flex;
      align-items: center;
      gap: 16px;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .geo-kpi-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px -2px rgba(15, 23, 42, 0.08);
    }

    .geo-kpi-icon {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }

    .geo-kpi-data {
      display: flex;
      flex-direction: column;
    }

    .geo-kpi-val {
      font-size: 24px;
      font-weight: 800;
      color: #0f172a;
      line-height: 1.2;
    }

    .geo-kpi-lbl {
      font-size: 12px;
      font-weight: 600;
      color: #64748b;
      margin-top: 2px;
    }

    /* GIS Main Workspace */
    .geo-workspace-grid {
      display: grid;
      grid-template-columns: 2.5fr 1fr;
      gap: 24px;
      align-items: start;
    }

    .geo-map-wrapper {
      background: #ffffff;
      border: 1px solid #cbd5e1;
      border-radius: 22px;
      overflow: hidden;
      box-shadow: 0 6px 25px -4px rgba(15, 23, 42, 0.08);
      position: relative;
    }

    .geo-map-toolbar {
      padding: 14px 20px;
      background: #ffffff;
      border-bottom: 1px solid #e2e8f0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 14px;
      flex-wrap: wrap;
    }

    .geo-filter-item {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .geo-filter-item label {
      font-size: 12px;
      font-weight: 800;
      color: #475569;
      white-space: nowrap;
    }

    .geo-toolbar-select {
      height: 38px;
      border-radius: 10px;
      border: 1.5px solid #cbd5e1;
      padding: 0 12px;
      font-size: 12.5px;
      font-weight: 600;
      font-family: inherit;
      color: #0f172a;
      outline: none;
      background: #f8fafc;
    }

    .geo-layer-toggles {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .geo-chk-lbl {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      font-weight: 700;
      color: #475569;
      cursor: pointer;
    }

    .geo-chk-lbl input {
      accent-color: #2563eb;
      width: 15px;
      height: 15px;
    }

    .btn-geo-reset-view {
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      color: #2563eb;
      font-size: 12px;
      font-weight: 700;
      font-family: inherit;
      padding: 7px 14px;
      border-radius: 8px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s;
    }

    .btn-geo-reset-view:hover {
      background: #2563eb;
      color: #ffffff;
    }

    .leaflet-map-canvas {
      width: 100%;
      height: 600px;
      z-index: 10;
    }

    .geo-map-legend {
      position: absolute;
      bottom: 24px;
      left: 24px;
      background: rgba(255, 255, 255, 0.94);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(226, 232, 240, 0.9);
      border-radius: 14px;
      padding: 12px 16px;
      box-shadow: 0 8px 24px rgba(15, 23, 42, 0.15);
      z-index: 1000;
      font-size: 11.5px;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .legend-title {
      font-weight: 800;
      color: #0f172a;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      margin-bottom: 2px;
    }

    .legend-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: 600;
      color: #334155;
    }

    .legend-pin {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      border: 2px solid #ffffff;
      box-shadow: 0 1px 3px rgba(0,0,0,0.3);
      display: inline-block;
    }

    .legend-pin.green { background: #10b981; }
    .legend-pin.blue { background: #2563eb; }
    .legend-pin.yellow { background: #f59e0b; }
    .legend-pin.red { background: #ef4444; }

    /* GIS Sidebar */
    .geo-sidebar {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .geo-focus-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      padding: 24px;
      box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);
    }

    .focus-header {
      margin-bottom: 16px;
      padding-bottom: 12px;
      border-bottom: 1px solid #f1f5f9;
    }

    .focus-badge {
      font-size: 11px;
      font-weight: 800;
      color: #2563eb;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 4px;
    }

    .focus-header h3 {
      font-size: 18px;
      font-weight: 800;
      color: #0f172a;
      margin: 0;
    }

    .focus-meta-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    .focus-stat {
      background: #f8fafc;
      border: 1px solid #edf2f7;
      border-radius: 12px;
      padding: 10px 12px;
      display: flex;
      flex-direction: column;
    }

    .focus-stat span.lbl {
      font-size: 10.5px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
    }

    .focus-stat span.val {
      font-size: 14.5px;
      font-weight: 800;
      color: #0f172a;
      margin-top: 2px;
    }

    .text-green { color: #16a34a !important; }

    /* Feed List of Respondents */
    .geo-feed-wrap {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04);
    }

    .geo-feed-header {
      padding: 16px 20px;
      background: #f8fafc;
      border-bottom: 1px solid #e2e8f0;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .geo-feed-header h4 {
      font-size: 13.5px;
      font-weight: 800;
      color: #0f172a;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .feed-count-pill {
      font-size: 11px;
      font-weight: 800;
      background: #e2e8f0;
      color: #334155;
      padding: 3px 10px;
      border-radius: 12px;
    }

    .geo-feed-list {
      max-height: 400px;
      overflow-y: auto;
      padding: 12px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .geo-feed-item {
      background: #f8fafc;
      border: 1.5px solid #edf2f7;
      border-radius: 14px;
      padding: 12px 14px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .geo-feed-item:hover {
      background: #ffffff;
      border-color: #2563eb;
      transform: translateX(4px);
      box-shadow: 0 4px 14px rgba(37, 99, 235, 0.08);
    }

    .feed-item-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 6px;
    }

    .feed-item-name {
      font-size: 13.5px;
      font-weight: 800;
      color: #0f172a;
    }

    .feed-item-score {
      font-size: 11px;
      font-weight: 800;
      padding: 2px 8px;
      border-radius: 8px;
    }

    .feed-item-score.mutu-a { background: #dcfce7; color: #15803d; }
    .feed-item-score.mutu-b { background: #dbeafe; color: #1d4ed8; }
    .feed-item-score.mutu-c { background: #fef9c3; color: #a16207; }

    .feed-item-meta {
      font-size: 11.5px;
      color: #64748b;
      display: flex;
      flex-direction: column;
      gap: 3px;
    }

    .feed-item-meta i {
      width: 14px;
      color: #94a3b8;
    }

    /* GOOGLE MAPS STYLE POPUP CARD IN LEAFLET */
    .leaflet-popup-content-wrapper {
      padding: 0 !important;
      border-radius: 18px !important;
      overflow: hidden !important;
      box-shadow: 0 16px 38px rgba(15, 23, 42, 0.2) !important;
      border: 1px solid #cbd5e1 !important;
    }

    .leaflet-popup-content {
      margin: 0 !important;
      width: 320px !important;
      line-height: 1.4 !important;
    }

    .gmaps-popup-card {
      font-family: inherit;
    }

    .gmaps-popup-header {
      background: linear-gradient(135deg, #043168 0%, #0d3d7c 100%);
      color: #ffffff;
      padding: 12px 16px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .gmaps-popup-instansi {
      font-size: 11px;
      font-weight: 700;
      color: rgba(255, 255, 255, 0.9);
      display: flex;
      align-items: center;
      gap: 6px;
      letter-spacing: 0.3px;
    }

    .gmaps-popup-badge {
      font-size: 10px;
      font-weight: 800;
      padding: 2px 8px;
      border-radius: 8px;
      text-transform: uppercase;
    }

    .gmaps-popup-badge.badge-green { background: #10b981; color: #ffffff; }
    .gmaps-popup-badge.badge-blue { background: #3b82f6; color: #ffffff; }
    .gmaps-popup-badge.badge-yellow { background: #f59e0b; color: #ffffff; }

    .gmaps-popup-body {
      padding: 16px;
      background: #ffffff;
    }

    .gmaps-popup-user {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 12px;
      padding-bottom: 10px;
      border-bottom: 1px solid #f1f5f9;
    }

    .gmaps-popup-avatar {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: #eff6ff;
      color: #2563eb;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 15px;
      font-weight: 800;
      border: 1.5px solid #bfdbfe;
      flex-shrink: 0;
    }

    .gmaps-popup-name {
      font-size: 14px;
      font-weight: 800;
      color: #0f172a;
      margin: 0;
    }

    .gmaps-popup-time {
      font-size: 11px;
      color: #64748b;
      margin-top: 2px;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .gmaps-popup-geo {
      display: flex;
      flex-direction: column;
      gap: 6px;
      font-size: 12px;
      color: #334155;
      background: #f8fafc;
      padding: 10px 12px;
      border-radius: 10px;
      border: 1px solid #edf2f7;
      margin-bottom: 12px;
    }

    .geo-coord-row, .geo-admin-row, .geo-device-row {
      display: flex;
      align-items: center;
      gap: 7px;
    }

    .text-blue { color: #2563eb; }
    .text-red { color: #ef4444; }
    .text-slate { color: #64748b; }

    .acc-tag {
      font-size: 10px;
      background: #e2e8f0;
      color: #475569;
      padding: 1px 6px;
      border-radius: 6px;
      font-weight: 700;
    }

    .gmaps-popup-score {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 6px 10px;
      background: #ecfdf5;
      border: 1px solid #a7f3d0;
      border-radius: 8px;
    }

    .score-lbl {
      font-size: 11px;
      font-weight: 700;
      color: #065f46;
    }

    .score-val {
      font-size: 12px;
      font-weight: 800;
      color: #065f46;
    }

    .gmaps-popup-footer {
      padding: 10px 16px 14px 16px;
      background: #ffffff;
      border-top: 1px solid #f1f5f9;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-popup-gmaps, .btn-popup-osm, .btn-popup-detail {
      flex: 1;
      padding: 6px 8px;
      font-size: 11px;
      font-weight: 700;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 4px;
      cursor: pointer;
      border: 1px solid #cbd5e1;
      background: #ffffff;
      color: #334155;
      transition: all 0.2s;
    }

    .btn-popup-gmaps:hover { background: #ea4335; color: #ffffff; border-color: #ea4335; }
    .btn-popup-osm:hover { background: #0284c7; color: #ffffff; border-color: #0284c7; }
    .btn-popup-detail:hover { background: #043168; color: #ffffff; border-color: #043168; }

    /* Custom Leaflet Pin Markers */
    .custom-svg-pin {
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .custom-svg-pin:hover {
      transform: scale(1.3) translateY(-4px);
      z-index: 9999 !important;
    }

    .pin-inner {
      width: 26px;
      height: 26px;
      border-radius: 50% 50% 50% 0;
      transform: rotate(-45deg);
      display: flex;
      align-items: center;
      justify-content: center;
      border: 2px solid #ffffff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.35);
    }

    .pin-inner i {
      transform: rotate(45deg);
      color: #ffffff;
      font-size: 11px;
    }

    .pin-inner.pin-a { background: #10b981; }
    .pin-inner.pin-b { background: #2563eb; }
    .pin-inner.pin-c { background: #f59e0b; }
    .pin-inner.pin-d { background: #ef4444; }

    /* Geolocation Tracker Box in Respondent Form */
    .resp-gps-tracker-card {
      background: #f0fdf4;
      border: 1.5px solid #bbf7d0;
      border-radius: 16px;
      padding: 18px 22px;
      margin-bottom: 20px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .resp-gps-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }

    .resp-gps-title {
      font-size: 13.5px;
      font-weight: 800;
      color: #166534;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .resp-gps-status-badge {
      font-size: 11px;
      font-weight: 800;
      background: #dcfce7;
      color: #15803d;
      padding: 3px 10px;
      border-radius: 10px;
      border: 1px solid #86efac;
    }

    .resp-gps-coords-display {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
      background: #ffffff;
      border: 1px solid #dcfce7;
      border-radius: 12px;
      padding: 10px 14px;
    }

    .resp-gps-field {
      display: flex;
      flex-direction: column;
    }

    .resp-gps-field span.lbl {
      font-size: 10.5px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
    }

    .resp-gps-field span.val {
      font-size: 13px;
      font-weight: 800;
      color: #0f172a;
      margin-top: 2px;
    }

    @media (max-width: 991px) {
      .geo-workspace-grid {
        grid-template-columns: 1fr;
      }
      .geo-kpi-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .resp-gps-coords-display {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 576px) {
      .geo-kpi-grid {
        grid-template-columns: 1fr;
      }
      .geo-header-card {
        padding: 20px;
      }
    }

    /* Enterprise Responsive Styling (Tablet & Mobile UI Polish) */
    @media (max-width: 768px) {
      .survey-grid {
        grid-template-columns: 1fr;
        gap: 16px;
      }

      .survey-card {
        padding: 18px 16px;
        border-radius: 16px;
      }

      .card-header-row {
        margin-bottom: 12px;
      }

      .card-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
        border-radius: 12px;
      }

      .card-icon svg {
        width: 18px;
        height: 18px;
      }

      .card-title {
        font-size: 15px;
        margin-bottom: 12px;
      }

      .card-meta {
        padding: 10px 12px;
        margin-bottom: 14px;
        border-radius: 12px;
        gap: 6px;
      }

      .meta-row {
        grid-template-columns: 100px 10px 1fr;
        font-size: 11.5px;
      }

      .card-actions {
        grid-template-columns: 1fr 1fr;
        gap: 8px;
      }

      .btn-action-fill,
      .btn-action-demo,
      .btn-action-qr,
      .btn-action-map {
        height: 38px;
        font-size: 11.5px;
        border-radius: 19px;
      }

      /* Banner Header Mobile Optimization */
      .survey-custom-banner {
        min-height: 130px;
        padding: 20px 18px 16px 18px;
      }

      .survey-custom-banner h2 {
        font-size: 17.5px;
        line-height: 1.35;
        margin-bottom: 6px;
        max-width: calc(100% - 48px);
      }

      .survey-custom-banner p {
        font-size: 12.5px;
        line-height: 1.5;
        margin-bottom: 8px;
      }

      .survey-resp-header-meta {
        gap: 6px;
        margin-bottom: 10px;
      }

      .survey-resp-pill {
        font-size: 10px;
        padding: 3px 9px;
        border-radius: 999px;
      }

      .btn-close-resp-modal {
        top: 16px;
        right: 16px;
        width: 36px;
        height: 36px;
        font-size: 15px;
      }

      .survey-resp-modal-dialog {
        max-width: 96%;
        margin: 12px auto;
        border-radius: 16px;
      }

      .survey-resp-modal-body {
        padding: 14px 16px 20px 16px;
      }

      /* Hero Subpage Banner Mobile */
      .subpage-banner {
        padding: 100px 16px 36px 16px;
      }

      .subpage-banner h1 {
        font-size: 24px;
      }

      .subpage-banner .lead-text {
        font-size: 13px;
        line-height: 1.55;
      }

      .hero-stats-strip {
        grid-template-columns: 1fr;
        gap: 10px;
        margin-top: 20px;
      }

      .cta-doodle {
        display: none !important;
      }
    }
    /* Public Notice Bar & Auth-Locked Styles */
    .public-survey-notice-wrap {
      max-width: 1200px;
      margin: -25px auto 30px auto;
      padding: 0 20px;
      position: relative;
      z-index: 10;
    }

    .public-survey-notice {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-left: 5px solid #0284c7;
      border-radius: 14px;
      padding: 14px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.06);
    }

    .notice-left {
      display: flex;
      align-items: center;
      gap: 14px;
      color: #334155;
      font-size: 13.5px;
      line-height: 1.5;
    }

    .notice-shield-icon {
      font-size: 24px;
      color: #0284c7;
      flex-shrink: 0;
    }

    .btn-notice-login {
      background: linear-gradient(135deg, var(--lugx-blue), #1e40af);
      color: #ffffff;
      border: none;
      padding: 8px 18px;
      font-size: 13px;
      font-weight: 700;
      border-radius: 10px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      white-space: nowrap;
      transition: all 0.25s ease;
      box-shadow: 0 4px 10px rgba(2, 132, 199, 0.25);
    }

    .btn-notice-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 14px rgba(2, 132, 199, 0.35);
      background: #0369a1;
    }

    .btn-public-gis-map-locked {
      background: #f1f5f9 !important;
      color: #64748b !important;
      border: 1.5px dashed #cbd5e1 !important;
      box-shadow: none !important;
    }

    .btn-public-gis-map-locked:hover {
      background: #e2e8f0 !important;
      color: #334155 !important;
      border-color: #94a3b8 !important;
      transform: none !important;
    }

    .gis-locked-tag {
      font-size: 11px;
      background: #e2e8f0;
      color: #475569;
      padding: 2px 8px;
      border-radius: 8px;
      margin-left: 6px;
      font-weight: 700;
    }

    .btn-action-map-locked {
      background: #f1f5f9 !important;
      color: #94a3b8 !important;
      border: 1px dashed #cbd5e1 !important;
    }

    .btn-action-map-locked:hover {
      background: #fee2e2 !important;
      color: #dc2626 !important;
      border-color: #fca5a5 !important;
    }

    /* Auth-locked Screen in Tab Sections */
    .auth-locked-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      padding: 60px 30px;
      text-align: center;
      max-width: 680px;
      margin: 40px auto;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .auth-locked-icon {
      width: 72px;
      height: 72px;
      background: #fef2f2;
      color: #ef4444;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 30px;
      margin-bottom: 20px;
      box-shadow: 0 4px 14px rgba(239, 68, 68, 0.15);
    }

    .auth-locked-card h3 {
      font-size: 22px;
      font-weight: 800;
      color: #0f172a;
      margin-bottom: 12px;
    }

    .auth-locked-card p {
      font-size: 14.5px;
      color: #64748b;
      line-height: 1.6;
      max-width: 540px;
      margin: 0 auto 24px auto;
    }

    .btn-auth-unlock {
      background: linear-gradient(135deg, #b40814, #88040d);
      color: #ffffff;
      border: none;
      padding: 12px 28px;
      font-size: 14px;
      font-weight: 800;
      border-radius: 12px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 6px 18px rgba(180, 8, 20, 0.3);
      transition: all 0.25s ease;
    }

    .btn-auth-unlock:hover {
      background: #88040d;
      transform: translateY(-2px);
      box-shadow: 0 8px 22px rgba(180, 8, 20, 0.4);
    }

</style>

</head>

<body>
<?php
// Session user check
$isLoggedIn = isset($isLoggedIn) ? $isLoggedIn : false;
$userLevel = isset($userLevel) ? $userLevel : 0;
$userName = isset($userName) ? $userName : 'User';
$isSurveiyor = isset($isSurveiyor) ? $isSurveiyor : ($userLevel == 4 || $userLevel == 1 || $userLevel == 2);
?>


<!-- Login Status Badge (Active Session) -->
<?php if ($isLoggedIn): ?>
<div class="login-status-badge">
    <i class="fa-solid fa-circle-user" style="font-size: 16px;"></i> 
    <span><?= $userName ?></span>
    <span class="level-badge">
        <?php 
            if($userLevel == 1) echo 'Superadmin';
            elseif($userLevel == 2) echo 'Admin';
            elseif($userLevel == 3) echo 'Staf';
            elseif($userLevel == 4) echo 'Surveiyor';
            else echo 'Pengunjung';
        ?>
    </span>
    <a href="#" onclick="logout(); return false;" class="logout-link" title="Logout">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
    </a>
</div>
<?php endif; ?>

  <!-- HEADER & NAVIGATION -->
  <header class="header-area">
    <nav class="main-nav">
      <a href="<?= base_url() ?>" class="logo">
        <img src="<?= base_url('assets/img/logo-white-solid.webp') ?>" alt="IDE Consultant Logo">
        <div class="logo-text">Inti Desain Ekonomi <span> Consultant</span></div>
      </a>

      <!-- Desktop Navigation Menu -->
      <ul class="nav-menu">
        <li class="dropdown">
          <a href="<?= base_url('#about') ?>" class="nav-item-link">Tentang <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
          <div class="dropdown-content mega-dropdown">
            <div class="mega-grid">
              <div class="mega-column">
                <h4 class="mega-heading">Profil Perusahaan</h4>
                <a href="<?= base_url('#about') ?>">Sejarah & Visi Misi</a>
                <p class="mega-desc">Inti Desain Ekonomi Consultant berdiri sejak 2015 dengan fokus pada solusi ekonomi berkelanjutan.</p>
                <h4 class="mega-heading">Legal & Sertifikasi</h4>
                <a href="<?= base_url('legalitas') ?>">Sertifikasi & Izin Usaha</a>
                <p class="mega-desc">Terdaftar resmi dan bekerja sama dengan lembaga terkemuka di Indonesia.</p>
              </div>
              <div class="mega-column">
                <h4 class="mega-heading">Lokasi & Kontak</h4>
                <a href="https://www.google.com/maps/search/?api=1&query=-7.929581,112.640292" target="_blank">Kantor Malang</a>
                <p class="mega-desc">Berbasis di Malang, siap melayani seluruh Indonesia.</p>
              </div>
            </div>
          </div>
        </li>

        <li class="dropdown">
          <a href="<?= base_url('#services') ?>" class="nav-item-link active">Layanan <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
          <div class="dropdown-content mega-dropdown">
            <div class="mega-grid">
              <div class="mega-column">
                <h4 class="mega-heading">Konsultasi</h4>
                <a href="<?= base_url('#services') ?>">Konsultasi Ekonomi</a>
                <p class="mega-desc">Pendampingan strategis berbasis data ekonomi.</p>
                <h4 class="mega-heading">Survei & Penelitian</h4>
                <a href="<?= base_url('MenuSurvei') ?>">Survei Kepuasan Masyarakat</a>
                <p class="mega-desc">Metode ilmiah dengan analisis mendalam.</p>
                <h4 class="mega-heading">MasterData</h4>
                <a href="<?= base_url('MasterData') ?>">Repositori Data</a>
                <a href="<?= base_url('KomparasiData') ?>">Komparasi Data Wilayah</a>
              </div>
            </div>
          </div>
        </li>

        <li class="dropdown">
          <a href="<?= base_url('#portfolio') ?>" class="nav-item-link">Portfolio <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
          <div class="dropdown-content mega-dropdown">
            <div class="mega-grid">
              <div class="mega-column">
                <h4 class="mega-heading">Proyek Pemerintahan</h4>
                <a href="<?= base_url('MenuPortofolio') ?>">Portofolio Proyek Selesai</a>
                <p class="mega-desc">Kerjasama dengan berbagai Pemda di Jawa Timur & luar pulau.</p>
              </div>
            </div>
          </div>
        </li>

        <li class="dropdown">
          <a href="<?= base_url('#team') ?>" class="nav-item-link">Tim <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
          <div class="dropdown-content mega-dropdown">
            <div class="mega-grid">
              <div class="mega-column">
                <h4 class="mega-heading">Tim Riset</h4>
                <a href="<?= base_url('#team') ?>">Profil Riset & Analis</a>
                <h4 class="mega-heading">Tim Ahli</h4>
                <a href="<?= base_url('#team') ?>">Peneliti & Advisor</a>
              </div>
            </div>
          </div>
        </li>

        <!-- Lugx Red Action Button -->
        <li class="main-button">
          <a href="#" onclick="openModal('signInModal'); return false;"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
        </li>
      </ul>

      <!-- Mobile Menu Toggle -->
      <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
        <i class="fas fa-bars"></i>
      </button>
    </nav>
  </header>

  <!-- Mobile Offcanvas Nav -->
  <div class="mobile-nav" id="mobileNav">
    <div class="dropbtn" onclick="toggleMobileDropdown(this)">Tentang <i class="fa-solid fa-chevron-down"></i></div>
    <div class="dropdown-content">
      <a href="<?= base_url('#about') ?>" onclick="closeMobileMenu()">Sejarah & Visi Misi</a>
      <a href="<?= base_url('legalitas') ?>">Legalitas & Sertifikasi</a>
    </div>

    <div class="dropbtn" onclick="toggleMobileDropdown(this)">Layanan <i class="fa-solid fa-chevron-down"></i></div>
    <div class="dropdown-content">
      <a href="<?= base_url('#services') ?>" onclick="closeMobileMenu()">Konsultasi Ekonomi</a>
      <a href="<?= base_url('MenuSurvei') ?>" style="color: var(--lugx-red); font-weight: 700;">Survei Kepuasan SKM</a>
      <a href="<?= base_url('MasterData') ?>">Repositori MasterData</a>
      <a href="<?= base_url('KomparasiData') ?>">Komparasi Data Wilayah</a>
    </div>

    <div class="dropbtn" onclick="toggleMobileDropdown(this)">Portfolio <i class="fa-solid fa-chevron-down"></i></div>
    <div class="dropdown-content">
      <a href="<?= base_url('MenuPortofolio') ?>">Proyek Selesai</a>
    </div>

    <div class="dropbtn" onclick="toggleMobileDropdown(this)">Tim <i class="fa-solid fa-chevron-down"></i></div>
    <div class="dropdown-content">
      <a href="<?= base_url('#team') ?>" onclick="closeMobileMenu()">Tim Riset & Ahli</a>
    </div>

    <div style="margin-top: 25px;" class="main-button">
      <a href="#" onclick="openModal('signInModal'); closeMobileMenu(); return false;"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
    </div>
  </div>
  <div class="mobile-nav-overlay" id="menuOverlay" onclick="closeMobileMenu()"></div>

  <!-- SUBPAGE HERO BANNER -->
  <section class="subpage-banner">
    <!-- Floating Vector Doodle Accents -->
    <i class="fa-solid fa-square-poll-vertical cta-doodle doodle-1"></i>
    <i class="fa-solid fa-clipboard-check cta-doodle doodle-2"></i>
    <i class="fa-solid fa-users cta-doodle doodle-3"></i>
    <i class="fa-solid fa-chart-line cta-doodle doodle-4"></i>
    <i class="fa-solid fa-star cta-doodle doodle-5"></i>
    <i class="fa-solid fa-award cta-doodle doodle-6"></i>

    <div class="banner-container">
      <h1>Portal Layanan <span>Survei</span></h1>
      <p class="lead-text">
        Platform instrumen survei terpadu untuk pengumpulan data lapangan, evaluasi kebijakan daerah, indeks kepuasan publik, dan riset strategis berbasis data ilmiah yang objektif, transparan, dan terpercaya.
      </p>

      <!-- Stats Summary Strip (Ukuran proporsional 3 pilar) -->
      <div class="hero-stats-strip">
        <div class="hero-stat-box">
          <span class="hero-stat-val">100%</span>
          <span class="hero-stat-lbl">Objektif &amp; Terukur</span>
        </div>
        <div class="hero-stat-box">
          <span class="hero-stat-val">Analisis</span>
          <span class="hero-stat-lbl">Berbasis Data Ilmiah</span>
        </div>
        <div class="hero-stat-box">
          <span class="hero-stat-val">Rekomendasi</span>
          <span class="hero-stat-lbl">Kebijakan Strategis</span>
        </div>
      </div>
    </div>
  </section>

  <!-- SURVEYOR PORTAL CONTROL BAR (Surveiyor Level 4 / Admin / Staf) -->
  <?php if ($isSurveiyor): ?>
  <div class="surveyor-control-bar-wrap">
    <div class="surveyor-control-bar">
      <div class="surveyor-bar-left">
        <div class="surveyor-avatar"><i class="fa-solid fa-clipboard-user"></i></div>
        <div>
          <div class="surveyor-bar-badge"><i class="fa-solid fa-circle-check"></i> Sesi Aktif: <?= ($userLevel == 5 ? 'Petugas Survei' : ($userLevel == 4 ? 'Surveiyor' : ($userLevel == 3 ? 'Staf' : ($userLevel == 1 ? 'SuperAdmin' : 'Admin')))) ?></div>
          <h3 class="surveyor-bar-name"><?= htmlspecialchars($userName) ?></h3>
        </div>
      </div>
      <div class="surveyor-bar-tabs">
        <button type="button" class="surveyor-tab-btn active" id="tabBtnKatalog" onclick="switchSurveyorTab('katalog')">
          <i class="fa-solid fa-table-cells-large"></i> Katalog Survei
        </button>
        <button type="button" class="surveyor-tab-btn" id="tabBtnBuilder" onclick="switchSurveyorTab('builder')">
          <i class="fa-solid fa-pen-ruler"></i> Studio Survei Dinamis <span class="tab-badge-pill">Google Form</span>
        </button>
        <button type="button" class="surveyor-tab-btn" id="tabBtnRekap" onclick="switchSurveyorTab('rekap')">
          <i class="fa-solid fa-chart-pie"></i> Rekapitulasi &amp; Daerah
        </button>
        <button type="button" class="surveyor-tab-btn" id="tabBtnPeta" onclick="switchSurveyorTab('peta')">
          <i class="fa-solid fa-map-location-dot"></i> Peta Sebaran &amp; GIS
        </button>
      </div>
      <div class="surveyor-bar-right">
        <button type="button" class="btn-create-survey" onclick="openCreateSurveyBuilder()">
          <i class="fa-solid fa-plus"></i> Buat Survei Baru
        </button>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- VIEW 1: KATALOG SURVEI PUBLIK -->
  <section class="survey-content" id="tabKatalogSection">
    <div class="survey-content-inner">

      <div class="section-heading">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; margin-bottom: 8px;">
          <h2 style="margin: 0;">Katalog Formulir Survei</h2>
          <?php if ($isLoggedIn): ?>
          <button type="button" class="btn-public-gis-map" onclick="openSurveyGeoMap(3)" title="Buka Peta Sebaran Geospasial Google Maps Responden Banyuwangi">
            <i class="fa-solid fa-map-location-dot"></i> Peta Sebaran GIS Responden
          </button>
          <?php else: ?>
          <button type="button" class="btn-public-gis-map btn-public-gis-map-locked" onclick="promptSurveyAuth('peta')" title="Peta Sebaran GIS Responden (Memerlukan Login Petugas / Surveyor)">
            <i class="fa-solid fa-lock"></i> Peta Sebaran GIS Responden <span class="gis-locked-tag">Khusus Petugas</span>
          </button>
          <?php endif; ?>
        </div>
        <p>Jelajahi dan berpartisipasi dalam berbagai survei penelitian, indeks kepuasan masyarakat (IKM), evaluasi program, dan pelayanan publik secara transparan dan terukur.</p>
      </div>

      <!-- Offline Outbox Status Banner (Muncul otomatis saat ada respon survei tertunda di memori HP) -->
      <div id="offlineSyncBanner" class="offline-sync-banner" style="display: none;">
        <div class="banner-left">
          <i class="fa-solid fa-cloud-arrow-up banner-icon"></i>
          <div>
            <div class="banner-title"><span id="offlineQueueBadgeCount">0</span> Respon Survei Tersimpan di Antrean Offline (Perangkat)</div>
            <div class="banner-subtitle">Data aman di memori HP Anda dan otomatis disinkronkan ke server saat internet kembali terhubung.</div>
          </div>
        </div>
        <div class="banner-right" style="display: flex; gap: 8px; align-items: center;">
          <button type="button" class="btn-sync-now" style="background: rgba(255, 255, 255, 0.2); border: 1.5px solid rgba(255, 255, 255, 0.4);" onclick="window.SurveiOfflineManager && window.SurveiOfflineManager.showQueueModal()">
            <i class="fa-solid fa-table-list"></i> Lihat Antrean
          </button>
          <button type="button" class="btn-sync-now" onclick="window.SurveiOfflineManager && window.SurveiOfflineManager.syncQueue(true)">
            <i class="fa-solid fa-cloud-arrow-up"></i> Sinkronkan Semua Sekarang
          </button>
        </div>
      </div>

      <!-- Modern Filter Section -->
      <div class="filter-section-lugx">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; flex-wrap: wrap; gap: 10px;">
          <h4 style="margin: 0;"><i class="fa-solid fa-filter"></i> Filter &amp; Pencarian Survei</h4>
          <span style="font-size: 13px; font-weight: 700; color: var(--lugx-blue);" id="surveiTotalCounter">Memuat survei...</span>
        </div>

        <!-- Quick Filter Pills: Jenis Survei (IKM & Kategori Lainnya) -->
        <div class="survey-type-pills-wrap">
          <div class="type-pills-label">
            <i class="fa-solid fa-layer-group"></i> <span>Kategori Jenis Survei:</span>
          </div>
          <div class="type-pills-scroller" id="surveyTypePillsContainer">
            <button type="button" class="type-pill-btn active" data-jenis="" onclick="selectJenisPill('')">
              <i class="fa-solid fa-border-all"></i> Semua Jenis
              <span class="pill-badge" id="pillCountAll">0</span>
            </button>
            <button type="button" class="type-pill-btn" data-jenis="IKM" onclick="selectJenisPill('IKM')">
              <i class="fa-solid fa-clipboard-check"></i> IKM (Kepuasan Masyarakat)
              <span class="pill-badge" id="pillCountIKM">0</span>
            </button>
          </div>
        </div>

        <div class="filter-grid-row" style="grid-template-columns: 2fr 1fr 1fr 1fr;">
          <div class="filter-group-lugx">
            <label for="searchKeyword"><i class="fa-solid fa-magnifying-glass"></i> Cari Survei / Daerah</label>
            <input type="text" id="searchKeyword" class="filter-select-custom" placeholder="Ketik judul, instansi, atau nama daerah..." oninput="filterSurvei()">
          </div>
          <div class="filter-group-lugx">
            <label for="jenis">Jenis Survei</label>
            <select id="jenis" class="filter-select-custom" onchange="filterSurvei()">
              <option value="">Semua Jenis</option>
            </select>
          </div>
          <div class="filter-group-lugx">
            <label for="tahun">Tahun Pelaksanaan</label>
            <select id="tahun" class="filter-select-custom" onchange="filterSurvei()">
              <option value="">Semua Tahun</option>
            </select>
          </div>
          <div class="filter-group-lugx">
            <label for="status">Status Survei</label>
            <select id="status" class="filter-select-custom" onchange="filterSurvei()">
              <option value="">Semua Status</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Grid Survei Dinamis -->
      <div class="survey-grid" id="surveyGrid">
        <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: var(--lugx-gray);">
          <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 32px; color: var(--lugx-blue); margin-bottom: 12px; display: block;"></i>
          Memuat daftar survei dinamis...
        </div>
      </div>

    </div>
  </section>

  <!-- VIEW 2: ENTERPRISE DYNAMIC SURVEY BUILDER (SURVEIYOR STUDIO) -->
  <section class="gform-studio-section" id="tabBuilderSection">
    <div class="gform-container">
      
      <!-- Studio Header / App Navigation Bar -->
      <div class="builder-studio-bar">
        <div class="builder-studio-left">
          <button type="button" class="gform-back-btn" onclick="switchSurveyorTab('katalog')">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog
          </button>
          <span class="gform-header-badge" id="builderModeBadge">
            <i class="fa-solid fa-wand-magic-sparkles"></i> Mode Pembuat Kuesioner Baru
          </span>
        </div>
        <div class="builder-nav-stepper">
          <a href="#builderStepIdentitas" class="stepper-chip" onclick="$('html, body').animate({ scrollTop: $('#builderStepIdentitas').offset().top - 90 }, 300); return false;">
            <span class="num">1</span> Identitas
          </a>
          <a href="#builderStepWilayah" class="stepper-chip" onclick="$('html, body').animate({ scrollTop: $('#builderStepWilayah').offset().top - 90 }, 300); return false;">
            <span class="num">2</span> Wilayah
          </a>
          <a href="#builderStepVisual" class="stepper-chip" onclick="$('html, body').animate({ scrollTop: $('#builderStepVisual').offset().top - 90 }, 300); return false;">
            <span class="num">3</span> Visual
          </a>
          <a href="#builderStepPertanyaan" class="stepper-chip" onclick="$('html, body').animate({ scrollTop: $('#builderStepPertanyaan').offset().top - 90 }, 300); return false;">
            <span class="num">4</span> Pertanyaan
          </a>
        </div>
      </div>

      <input type="hidden" id="builderSurveyId" value="0">

      <!-- STEP 1: IDENTITAS & INFORMASI KUESIONER -->
      <div class="enterprise-builder-card" id="builderStepIdentitas">
        <div class="card-step-header">
          <div class="card-step-info">
            <div class="card-step-pill">01</div>
            <div class="card-step-text">
              <h3>Identitas &amp; Pengaturan Kuesioner</h3>
              <p>Tentukan judul resmi formulir survei, penjelasan instruksi bagi responden, serta lembaga pelaksana.</p>
            </div>
          </div>
          <span class="gform-header-badge" style="background: #f1f5f9; color: #475569; border-color: #e2e8f0;">
            <i class="fa-solid fa-file-lines"></i> Konfigurasi Dasar
          </span>
        </div>

        <div class="gform-field-group">
          <label class="gform-field-label" for="builderJudul">
            <i class="fa-solid fa-heading"></i> Judul Formulir Survei <span class="req">*</span>
          </label>
          <input type="text" id="builderJudul" class="gform-title-input" placeholder="Masukkan judul formulir survei baru di sini..." value="">
        </div>

        <div class="gform-field-group">
          <label class="gform-field-label" for="builderDeskripsi">
            <i class="fa-solid fa-align-left"></i> Deskripsi &amp; Petunjuk Pengisian Bagi Responden
          </label>
          <textarea id="builderDeskripsi" class="gform-desc-input" placeholder="Tuliskan tujuan evaluasi, dasar hukum survei, petunjuk pengisian, atau jaminan kerahasiaan data bagi responden..."></textarea>
        </div>

        <div class="gform-meta-grid">
          <div class="gform-meta-field">
            <label for="builderLembaga"><i class="fa-solid fa-building-columns"></i> Instansi Pelaksana</label>
            <input type="text" id="builderLembaga" placeholder="Nama Instansi / Lembaga Pelaksana" value="">
          </div>
          <div class="gform-meta-field">
            <label for="builderTipeSurvei"><i class="fa-solid fa-diagram-project"></i> Model Instrumen</label>
            <select id="builderTipeSurvei" onchange="onBuilderTipeSurveiChange(this.value)">
              <option value="standar" selected>Standar (Instrumen Tunggal / IKM)</option>
              <option value="multi">Multi-Instrumen Dinamis (RTKD: A, B, C, D)</option>
            </select>
          </div>
          <div class="gform-meta-field">
            <label for="builderJenis"><i class="fa-solid fa-layer-group"></i> Kategori Survei</label>
            <select id="builderJenis">
              <option value="IKM" selected>IKM (Kepuasan Masyarakat)</option>
              <option value="SKM">SKM (Standar Kepuasan)</option>
              <option value="Ketenagakerjaan">Ketenagakerjaan</option>
              <option value="Evaluasi">Evaluasi Program Daerah</option>
              <option value="Riset">Riset &amp; Kebijakan Ekonomi</option>
            </select>
          </div>
          <div class="gform-meta-field">
            <label for="builderTahun"><i class="fa-solid fa-calendar-days"></i> Tahun Pelaksanaan</label>
            <input type="text" id="builderTahun" placeholder="Tahun" value="<?= date('Y') ?>">
          </div>
          <div class="gform-meta-field">
            <label for="builderStatus"><i class="fa-solid fa-shield-halved"></i> Status Akses</label>
            <select id="builderStatus">
              <option value="Aktif" selected>Aktif (Dapat Diisi Publik)</option>
              <option value="Tidak Aktif">Tidak Aktif (Draft / Ditutup)</option>
            </select>
          </div>
        </div>
      </div>

      <!-- STEP 2: CAKUPAN & WILAYAH SURVEI -->
      <div class="enterprise-builder-card" id="builderStepWilayah">
        <div class="card-step-header">
          <div class="card-step-info">
            <div class="card-step-pill">02</div>
            <div class="card-step-text">
              <h3>Cakupan Wilayah &amp; Sasaran Geografis</h3>
              <p>Tentukan daerah lokus survei agar sistem secara otomatis memetakan responden ke wilayah target.</p>
            </div>
          </div>
          <span class="gform-header-badge" style="background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe;">
            <i class="fa-solid fa-map-location-dot"></i> Geografis
          </span>
        </div>

        <div class="gform-daerah-grid">
          <div class="gform-meta-field">
            <label for="builderProvinsi"><i class="fa-solid fa-earth-asia"></i> Provinsi Target</label>
            <select id="builderProvinsi" onchange="loadKabupatenBuilder(this.value)">
              <option value="">-- Pilih Provinsi --</option>
              <?php if (!empty($provinsi)): ?>
                <?php foreach ($provinsi as $pv): ?>
                  <option value="<?= htmlspecialchars($pv['Kode']) ?>"><?= htmlspecialchars($pv['Nama']) ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
          <div class="gform-meta-field">
            <label for="builderKabupaten"><i class="fa-solid fa-city"></i> Kabupaten / Kota</label>
            <select id="builderKabupaten" onchange="syncDaerahSurveiText()">
              <option value="">-- Pilih Kab/Kota --</option>
            </select>
          </div>
          <div class="gform-meta-field">
            <label for="builderDaerahText"><i class="fa-solid fa-location-dot"></i> Keterangan Lokus / Unit Layanan</label>
            <input type="text" id="builderDaerahText" placeholder="Contoh: Kabupaten Banyuwangi - Seluruh Unit Layanan" value="">
          </div>
        </div>

        <div class="enterprise-alert-box">
          <i class="fa-solid fa-circle-info"></i>
          <span>Responden yang mengisi formulir ini akan otomatis terhubung ke wilayah administratif tersebut pada laporan rekapitulasi &amp; ekspor Excel.</span>
        </div>
      </div>

      <!-- STEP 3: KUSTOMISASI VISUAL & BANNER FORM -->
      <div class="enterprise-builder-card" id="builderStepVisual">
        <div class="card-step-header">
          <div class="card-step-info">
            <div class="card-step-pill">03</div>
            <div class="card-step-text">
              <h3>Desain Visual &amp; Banner Header</h3>
              <p>Personalisasi tema warna dan latar belakang header kuesioner yang akan dilihat oleh responden.</p>
            </div>
          </div>
          <span class="gform-header-badge" style="background: #fdf2f8; color: #be185d; border-color: #fbcfe8;">
            <i class="fa-solid fa-paintbrush"></i> Branding Visual
          </span>
        </div>

        <!-- Live Preview Banner Header -->
        <div class="gform-banner-preview" id="builderBannerPreview" style="background: linear-gradient(135deg, #043168 0%, #0d3d7c 100%);">
          <div class="banner-preview-overlay"></div>
          <div class="banner-preview-content">
            <span class="banner-preview-badge" id="previewBannerBadge"><i class="fa-solid fa-clipboard-check"></i> IKM &bull; <?= date('Y') ?></span>
            <h3 id="previewBannerJudul">Judul Formulir Kuesioner Baru</h3>
            <p id="previewBannerLembaga"><i class="fa-solid fa-building-columns"></i> Instansi / Lembaga Pelaksana</p>
          </div>
        </div>

        <div class="gform-banner-controls">
          <div class="gform-meta-field">
            <label><i class="fa-solid fa-palette"></i> Pilihan Palet Warna Aksen</label>
            <div class="banner-color-swatches">
              <button type="button" class="swatch-btn active" data-color="#043168" style="background: #043168;" title="Navy Lugx" onclick="setBuilderBannerColor('#043168')"></button>
              <button type="button" class="swatch-btn" data-color="#b40814" style="background: #b40814;" title="Crimson Red" onclick="setBuilderBannerColor('#b40814')"></button>
              <button type="button" class="swatch-btn" data-color="#059669" style="background: #059669;" title="Emerald Green" onclick="setBuilderBannerColor('#059669')"></button>
              <button type="button" class="swatch-btn" data-color="#4f46e5" style="background: #4f46e5;" title="Indigo Modern" onclick="setBuilderBannerColor('#4f46e5')"></button>
              <button type="button" class="swatch-btn" data-color="#0891b2" style="background: #0891b2;" title="Teal Cyan" onclick="setBuilderBannerColor('#0891b2')"></button>
              <button type="button" class="swatch-btn" data-color="#1e293b" style="background: #1e293b;" title="Slate Dark" onclick="setBuilderBannerColor('#1e293b')"></button>
              <input type="color" id="builderBannerColorPicker" value="#043168" class="swatch-picker" onchange="setBuilderBannerColor(this.value)" title="Pilih Warna Kustom">
            </div>
            <input type="hidden" id="builderBannerColor" value="#043168">
          </div>

          <div class="gform-meta-field">
            <label for="builderBannerPreset"><i class="fa-solid fa-image"></i> Gambar Latar Header</label>
            <select id="builderBannerPreset" onchange="handleBannerPresetChange(this.value)">
              <option value="">Gradien Bersih Elegan (Default)</option>
              <option value="<?= base_url('assets/img/background/IDE 2.0.webp') ?>">Preset 1: IDE Consultant Modern Vector</option>
              <option value="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80">Preset 2: Gedung Pemerintahan &amp; Publik</option>
              <option value="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1200&q=80">Preset 3: Riset Kebijakan &amp; Data</option>
              <option value="custom">Gunakan URL Gambar Kustom Sendiri...</option>
            </select>
            <input type="text" id="builderBannerImage" placeholder="Tempel URL Gambar Banner di sini..." style="display: none; margin-top: 8px;" oninput="updateBannerPreviewImage(this.value)">
          </div>
        </div>
      </div>

      <!-- STEP 4: INSTRUMEN BUTIR PERTANYAAN KUESIONER -->
      <div class="enterprise-builder-card" id="builderStepPertanyaan">
        <div class="card-step-header">
          <div class="card-step-info">
            <div class="card-step-pill">04</div>
            <div class="card-step-text">
              <h3>Instrumen Butir Pertanyaan Kuesioner</h3>
              <p>Susun butir pertanyaan berbobot nilai numerik, skala rating kepuasan, maupun isian terbuka.</p>
            </div>
          </div>
          <div style="display: flex; align-items: center; gap: 10px;">
            <span class="gform-header-badge" id="builderHeaderCount" style="background: #ecfdf5; color: #065f46; border-color: #a7f3d0;">
              <i class="fa-solid fa-list-check"></i> <span id="builderQuestionsCount">0</span> Pertanyaan
            </span>
            <button type="button" class="btn-enterprise-add-q" onclick="addNewQuestionCard()">
              <i class="fa-solid fa-circle-plus"></i> Tambah Pertanyaan
            </button>
          </div>
        </div>

        <!-- Question Cards List Container -->
        <div class="gform-cards-list" id="gformCardsContainer">
          <!-- Question cards injected dynamically by JavaScript -->
        </div>

        <!-- Big Bottom Add Question Action Dropzone -->
        <div class="enterprise-add-q-card-bottom" onclick="addNewQuestionCard()" style="margin-top: 24px;">
          <i class="fa-solid fa-circle-plus fa-lg"></i>
          <span>Tambah Butir Pertanyaan Baru Berikutnya</span>
        </div>
      </div>

      <!-- Sticky Floating Enterprise Bottom Toolbar -->
      <div class="gform-bottom-bar">
        <div class="builder-bottom-status">
          <i class="fa-solid fa-circle-check"></i>
          <span>Studio Pembuat Survei Aktif &bull; <b id="builderBottomCount">0</b> Butir Pertanyaan</span>
        </div>
        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
          <button type="button" class="btn-add-q-card" onclick="addNewQuestionCard()">
            <i class="fa-solid fa-plus"></i> Tambah Pertanyaan
          </button>
          <button type="button" class="gform-back-btn" onclick="switchSurveyorTab('katalog')">
            <i class="fa-solid fa-xmark"></i> Batal
          </button>
          <button type="button" class="btn-save-gform" id="btnSaveBuilder" onclick="saveSurveyBuilderData()">
            <i class="fa-solid fa-cloud-arrow-up"></i> Simpan Formulir Survei
          </button>
        </div>
      </div>

    </div>
  </section>

  <!-- VIEW 3: REKAPITULASI RESPON & DAERAH SURVEI SECTION -->
  <section class="rekap-section" id="tabRekapSection">
    <div class="survey-content-inner">

      <?php if (!$isLoggedIn): ?>
      <div class="auth-locked-card">
        <div class="auth-locked-icon"><i class="fa-solid fa-shield-halved"></i></div>
        <h3>Rincian Data Responden Terproteksi</h3>
        <p>Demi keamanan data dan privasi responden (termasuk identitas, kontak, dan rincian hasil survei), rekapitulasi data responden hanya dapat diakses oleh petugas, staf, atau surveyor resmi yang telah login ke dalam sistem.</p>
        <button type="button" class="btn-auth-unlock" onclick="openModal('signInModal')">
          <i class="fa-solid fa-right-to-bracket"></i> Masuk Sebagai Petugas / Surveyor
        </button>
      </div>
      <?php else: ?>

      <div class="rekap-header-row">
        <div>
          <span class="subtitle" style="color: var(--lugx-red); font-size: 14px; font-weight: 700; text-transform: uppercase;">Laporan Statistik</span>
          <h2 style="font-size: 28px; font-weight: 800; color: var(--lugx-dark); margin: 4px 0 0 0;">Rekapitulasi Respon Survei &amp; Daerah</h2>
        </div>
        <div style="display: flex; align-items: flex-end; gap: 14px; flex-wrap: wrap;">
          <div style="min-width: 260px;">
            <label style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">Pilih Survei untuk Dianalisis:</label>
            <select id="rekapSurveySelector" class="filter-select-custom" onchange="loadRekapitulasi(this.value)">
              <!-- Options injected by JS -->
            </select>
          </div>
          <button type="button" class="btn-export-excel" onclick="downloadRekapExcel()" title="Unduh data responder survei ini ke format spreadsheet / Excel">
            <i class="fa-solid fa-file-excel"></i> Unduh Data Responden (Excel)
          </button>
        </div>
      </div>

      <!-- KPI Widgets -->
      <div class="rekap-kpi-grid">
        <div class="rekap-kpi-card">
          <div class="rekap-kpi-icon" style="background: linear-gradient(135deg, #0284c7, #0369a1);"><i class="fa-solid fa-users"></i></div>
          <div>
            <div class="rekap-kpi-val" id="kpiTotalResponden">0</div>
            <div class="rekap-kpi-lbl">Total Responden Masuk</div>
          </div>
        </div>
        <div class="rekap-kpi-card">
          <div class="rekap-kpi-icon" style="background: linear-gradient(135deg, #10b981, #059669);"><i class="fa-solid fa-star-half-stroke"></i></div>
          <div>
            <div class="rekap-kpi-val" id="kpiRataRataSkor">0.00</div>
            <div class="rekap-kpi-lbl" id="lblKpiRataRataSkor">Rata-Rata Skor Survei</div>
          </div>
        </div>
        <div class="rekap-kpi-card">
          <div class="rekap-kpi-icon" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9);"><i class="fa-solid fa-award"></i></div>
          <div>
            <div class="rekap-kpi-val" id="kpiMutuPelayanan" style="font-size: 22px;">-</div>
            <div class="rekap-kpi-lbl">Predikat Mutu Pelayanan</div>
          </div>
        </div>
        <div class="rekap-kpi-card">
          <div class="rekap-kpi-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);"><i class="fa-solid fa-map-location-dot"></i></div>
          <div>
            <div class="rekap-kpi-val" id="kpiTotalDaerah">0</div>
            <div class="rekap-kpi-lbl">Sebaran Daerah Survei</div>
          </div>
        </div>
      </div>

      <!-- Sebaran Daerah Survei Pills -->
      <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 20px; margin-bottom: 26px;">
        <h4 style="font-size: 13px; font-weight: 800; color: var(--lugx-blue); text-transform: uppercase; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
          <i class="fa-solid fa-location-crosshairs"></i> Distribusi Responden Berdasarkan Keterangan Daerah Survei:
        </h4>
        <div id="rekapDaerahPills" style="display: flex; gap: 10px; flex-wrap: wrap;">
          <span style="font-size: 13px; color: #64748b;">Belum ada data responden.</span>
        </div>
      </div>

      <!-- Tabel Data Responden -->
      <div class="rekap-table-card">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 16px;">
          <h4 style="font-size: 16px; font-weight: 800; color: var(--lugx-dark); margin: 0;">
            <i class="fa-solid fa-table-list" style="color: var(--lugx-red); margin-right: 8px;"></i> Daftar Responden &amp; Isian Data Survei
          </h4>
          <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 700; padding: 7px 14px; border-radius: 10px; font-size: 12.5px;" id="publicRekapCountBadge">
            <i class="fa-solid fa-users"></i> Menampilkan 0 Responden
          </span>
        </div>

        <!-- Filter & Search Toolbar Rekap Responden -->
        <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 16px 18px; margin-bottom: 20px;">
          <!-- Baris 1: Search Box -->
          <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin-bottom: 12px;">
            <div style="flex: 1; min-width: 260px; position: relative;">
              <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: 13.5px;"></i>
              <input type="text" id="publicRekapSearchInput" placeholder="Cari responden, NIK, kontak, instansi, alamat, kecamatan..." style="width: 100%; height: 42px; border-radius: 10px; border: 1.5px solid #cbd5e1; padding: 0 38px 0 38px; font-size: 13px; outline: none; background: #ffffff;" oninput="applyPublicRekapFilters()">
              <button type="button" id="publicRekapSearchClearBtn" onclick="clearPublicRekapSearch()" style="display: none; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; background: transparent; color: #94a3b8; font-size: 15px; cursor: pointer;" title="Bersihkan pencarian">
                <i class="fa-solid fa-circle-xmark"></i>
              </button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary" style="border-radius: 10px; font-weight: 700; height: 42px; padding: 0 16px; border: 1.5px solid #cbd5e1; background: #ffffff;" onclick="resetPublicRekapFilters()" title="Reset semua filter">
              <i class="fa-solid fa-rotate-left"></i> Reset Filter
            </button>
          </div>

          <!-- Baris 2: Dropdown Filter -->
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px;">
            <div id="publicFilterColInstrumen">
              <label style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; margin-bottom: 4px; display: block;">
                <i class="fa-solid fa-layer-group" style="color: var(--lugx-blue);"></i> Instrumen
              </label>
              <select id="publicRekapFilterInstrumen" style="width: 100%; height: 36px; border-radius: 8px; border: 1.5px solid #cbd5e1; font-size: 12px; font-weight: 600; padding: 0 8px; background: #ffffff;" onchange="applyPublicRekapFilters()">
                <option value="">Semua Instrumen</option>
                <option value="A">Instrumen A - Perusahaan</option>
                <option value="B">Instrumen B - Pencari Kerja</option>
                <option value="C">Instrumen C - Stakeholder</option>
                <option value="E">Instrumen C2 / E - AHP</option>
                <option value="D">Instrumen D - Siswa Kelas 12</option>
              </select>
            </div>
            <div>
              <label style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; margin-bottom: 4px; display: block;">
                <i class="fa-solid fa-location-dot" style="color: var(--lugx-red);"></i> Wilayah / Kecamatan
              </label>
              <select id="publicRekapFilterKecamatan" style="width: 100%; height: 36px; border-radius: 8px; border: 1.5px solid #cbd5e1; font-size: 12px; font-weight: 600; padding: 0 8px; background: #ffffff;" onchange="applyPublicRekapFilters()">
                <option value="">Semua Wilayah</option>
              </select>
            </div>
            <div>
              <label style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; margin-bottom: 4px; display: block;">
                <i class="fa-solid fa-award" style="color: #10b981;"></i> Mutu Pelayanan
              </label>
              <select id="publicRekapFilterMutu" style="width: 100%; height: 36px; border-radius: 8px; border: 1.5px solid #cbd5e1; font-size: 12px; font-weight: 600; padding: 0 8px; background: #ffffff;" onchange="applyPublicRekapFilters()">
                <option value="">Semua Mutu</option>
                <option value="Sangat Baik">Sangat Baik (A)</option>
                <option value="Baik">Baik (B)</option>
                <option value="Kurang Baik">Kurang Baik (C)</option>
                <option value="Tidak Baik">Tidak Baik (D)</option>
              </select>
            </div>
            <div>
              <label style="font-size: 11px; font-weight: 800; color: #475569; text-transform: uppercase; margin-bottom: 4px; display: block;">
                <i class="fa-solid fa-arrow-down-wide-short" style="color: #0284c7;"></i> Urutkan
              </label>
              <select id="publicRekapSortOrder" style="width: 100%; height: 36px; border-radius: 8px; border: 1.5px solid #cbd5e1; font-size: 12px; font-weight: 600; padding: 0 8px; background: #ffffff;" onchange="applyPublicRekapFilters()">
                <option value="newest">Waktu Terbaru</option>
                <option value="oldest">Waktu Terlama</option>
                <option value="name_asc">Nama (A - Z)</option>
                <option value="name_desc">Nama (Z - A)</option>
                <option value="score_desc">Skor Tertinggi</option>
                <option value="score_asc">Skor Terendah</option>
              </select>
            </div>
          </div>
        </div>

        <div style="overflow-x: auto;">
          <table class="rekap-table" id="tableRekapResponden">
            <thead>
              <tr>
                <th style="width: 45px; text-align: center;">No</th>
                <th style="width: 140px;">Waktu Pengisian</th>
                <th>Nama Responden &amp; Profil</th>
                <th>Keterangan Daerah Survei</th>
                <th>Demografi</th>
                <th style="text-align: center; width: 95px;">Rata-Rata Skor</th>
                <th style="text-align: center; width: 100px;">Mutu</th>
                <th style="text-align: center; width: 110px;">Aksi</th>
              </tr>
            </thead>
            <tbody id="tableRekapRespondenBody">
              <tr>
                <td colspan="8" style="text-align: center; color: var(--lugx-gray); padding: 40px;">
                  Pilih survei untuk melihat data responden.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <?php endif; ?>

    </div>
  </section>

  <!-- VIEW 4: PETA GEOSPASIAL & INFOGRAFIS SEBARAN RESPONDEN (OPENSTREETMAP + LEAFLET) -->
  <section class="geo-infografis-section" id="tabPetaSection">
    <div class="survey-content-inner">

      <?php if (!$isLoggedIn): ?>
      <div class="auth-locked-card">
        <div class="auth-locked-icon"><i class="fa-solid fa-map-location-dot"></i></div>
        <h3>Peta Geospasial Responden Terproteksi</h3>
        <p>Visualisasi sebaran koordinat GPS responden bersifat sensitif dan hanya dapat diakses melalui session login petugas/surveyor resmi demi kepatuhan perlindungan privasi dan keamanan data spasial.</p>
        <button type="button" class="btn-auth-unlock" onclick="openModal('signInModal')">
          <i class="fa-solid fa-right-to-bracket"></i> Masuk Sebagai Petugas / Surveyor
        </button>
      </div>
      <?php else: ?>

      <!-- Header Infografis Spasial -->
      <div class="geo-header-card">
        <div class="geo-header-left">
          <div class="geo-badge-tag"><i class="fa-solid fa-satellite-dish"></i> Pemetaan Spasial Real-Time Google Maps</div>
          <h2 class="geo-title">Peta Geospasial &amp; Infografis Sebaran Responden</h2>
          <p class="geo-subtitle">Visualisasi sebaran geolokasi responden berdasarkan tracking koordinat GPS perangkat pengisi survei dan poligon batas wilayah administratif kecamatan Kabupaten Banyuwangi.</p>
        </div>
        <div class="geo-header-right">
          <div class="geo-survey-selector-wrap">
            <label for="geoSurveySelect"><i class="fa-solid fa-layer-group"></i> Pilih Data Survei:</label>
            <select id="geoSurveySelect" class="geo-select-custom" onchange="loadSurveyGeoMap(this.value)">
              <!-- Options populated dynamically -->
            </select>
          </div>
          <div style="display: flex; gap: 8px;">
            <button type="button" class="btn-geo-refresh" onclick="reloadCurrentGeoMap()" title="Muat Ulang Titik Geospasial">
              <i class="fa-solid fa-rotate"></i> Refresh Peta
            </button>
            <button type="button" class="btn-geo-excel" onclick="downloadCurrentGeoExcel()" title="Unduh Data Koordinat ke Excel">
              <i class="fa-solid fa-file-excel"></i> Ekspor Excel
            </button>
          </div>
        </div>
      </div>

      <!-- KPI Metrics Infografis Row -->
      <div class="geo-kpi-grid">
        <div class="geo-kpi-card">
          <div class="geo-kpi-icon" style="background: #eff6ff; color: #2563eb;"><i class="fa-solid fa-map-pin"></i></div>
          <div class="geo-kpi-data">
            <span class="geo-kpi-val" id="geoKpiTotal">0</span>
            <span class="geo-kpi-lbl">Titik Terpetakan (GPS)</span>
          </div>
        </div>
        <div class="geo-kpi-card">
          <div class="geo-kpi-icon" style="background: #f0fdf4; color: #16a34a;"><i class="fa-solid fa-mountain-city"></i></div>
          <div class="geo-kpi-data">
            <span class="geo-kpi-val" id="geoKpiKecamatan">0</span>
            <span class="geo-kpi-lbl">Kecamatan Terjangkau</span>
          </div>
        </div>
        <div class="geo-kpi-card">
          <div class="geo-kpi-icon" style="background: #fefce8; color: #ca8a04;"><i class="fa-solid fa-star"></i></div>
          <div class="geo-kpi-data">
            <span class="geo-kpi-val" id="geoKpiSkor">0.00</span>
            <span class="geo-kpi-lbl" id="geoKpiMutu">Rata-Rata Kepuasan</span>
          </div>
        </div>
        <div class="geo-kpi-card">
          <div class="geo-kpi-icon" style="background: #faf5ff; color: #9333ea;"><i class="fa-solid fa-mobile-screen-button"></i></div>
          <div class="geo-kpi-data">
            <span class="geo-kpi-val" id="geoKpiDevice">-</span>
            <span class="geo-kpi-lbl">Perangkat Dominan</span>
          </div>
        </div>
      </div>

      <!-- Main GIS Canvas Row (Map + Sidebar) -->
      <div class="geo-workspace-grid">
        
        <!-- Left: Map Area with Leaflet -->
        <div class="geo-map-wrapper">
          
          <!-- Map Controls / Filter Bar -->
          <div class="geo-map-toolbar">
            <div class="geo-filter-item">
              <label for="geoKecamatanFilter"><i class="fa-solid fa-filter"></i> Filter Kecamatan:</label>
              <select id="geoKecamatanFilter" class="geo-toolbar-select" onchange="filterMapKecamatan(this.value)">
                <option value="">Semua Wilayah Kecamatan</option>
              </select>
            </div>
            <div class="geo-filter-item">
              <label for="geoMutuFilter"><i class="fa-solid fa-award"></i> Filter Mutu:</label>
              <select id="geoMutuFilter" class="geo-toolbar-select" onchange="filterMapMutu(this.value)">
                <option value="">Semua Mutu Pelayanan</option>
                <option value="Sangat Baik">Sangat Baik (A)</option>
                <option value="Baik">Baik (B)</option>
                <option value="Kurang">Kurang Baik (C)</option>
              </select>
            </div>
            <div class="geo-layer-toggles">
              <label class="geo-chk-lbl">
                <input type="checkbox" id="togglePolygonsChk" checked onchange="toggleKecamatanPolygons(this.checked)">
                <span>Batas Wilayah</span>
              </label>
              <label class="geo-chk-lbl">
                <input type="checkbox" id="toggleMarkersChk" checked onchange="toggleRespondentMarkers(this.checked)">
                <span>Titik Responden</span>
              </label>
            </div>
            <button type="button" class="btn-geo-reset-view" onclick="resetMapToBanyuwangi()" title="Pusatkan Peta ke Banyuwangi">
              <i class="fa-solid fa-expand"></i> Reset View
            </button>
          </div>

          <!-- Leaflet Map Canvas -->
          <div id="leafletSurveiMap" class="leaflet-map-canvas"></div>

          <!-- Floating Legend Map Overlay -->
          <div class="geo-map-legend">
            <div class="legend-title"><i class="fa-solid fa-circle-info"></i> Legenda Mutu Skor</div>
            <div class="legend-item"><span class="legend-pin green"></span> Sangat Baik (A &ge; 3.50)</div>
            <div class="legend-item"><span class="legend-pin blue"></span> Baik (B: 2.75 - 3.49)</div>
            <div class="legend-item"><span class="legend-pin yellow"></span> Kurang Baik (C: 2.00 - 2.74)</div>
            <div class="legend-item"><span class="legend-pin red"></span> Tidak Baik (D &lt; 2.00)</div>
          </div>
        </div>

        <!-- Right: Interactive Sidebar (Kecamatan Info & Responden Feed) -->
        <div class="geo-sidebar">
          
          <!-- Kecamatan Active Focus Card -->
          <div class="geo-focus-card" id="geoFocusCard">
            <div class="focus-header">
              <div class="focus-badge" id="focusKecBadge"><i class="fa-solid fa-map"></i> Kabupaten Banyuwangi</div>
              <h3 id="focusKecTitle">Seluruh Wilayah</h3>
            </div>
            <div class="focus-meta-grid">
              <div class="focus-stat">
                <span class="lbl">Total Respon</span>
                <span class="val" id="focusKecTotal">0</span>
              </div>
              <div class="focus-stat">
                <span class="lbl">Rata-Rata Skor</span>
                <span class="val" id="focusKecSkor">0.00</span>
              </div>
              <div class="focus-stat">
                <span class="lbl">Predikat Mutu</span>
                <span class="val text-green" id="focusKecMutu">-</span>
              </div>
              <div class="focus-stat">
                <span class="lbl">Submit Terakhir</span>
                <span class="val" id="focusKecLastSubmit">-</span>
              </div>
            </div>
          </div>

          <!-- Feed Titik Responden List -->
          <div class="geo-feed-wrap">
            <div class="geo-feed-header">
              <h4><i class="fa-solid fa-location-dot"></i> Daftar Titik Responden</h4>
              <span class="feed-count-pill" id="feedCountPill">0 Responden</span>
            </div>
            <div class="geo-feed-list" id="geoFeedList">
              <!-- Rendered dynamically -->
            </div>
          </div>

        </div>

      </div>

      <?php endif; ?>

    </div>
  </section>

  <!-- ==========================================================================
       MODAL PENGISIAN KUESIONER SURVEI (DENGAN BANNER KUSTOMISASI & MULTI-STEP)
       ========================================================================== -->
  <div class="survey-respondent-overlay" id="surveyRespondentModal">
    <div class="survey-respondent-box">
      
      <!-- Floating Close Button on Modal -->
      <button type="button" class="btn-close-resp-modal" onclick="closeSurveyRespondentModal()" aria-label="Tutup Formulir" title="Tutup Formulir">
        <i class="fa-solid fa-xmark"></i>
      </button>

      <!-- 1. Google Forms Style Header Banner Image -->
      <div class="gform-banner-img-wrap" id="modalRespBannerContainer">
        <div class="gform-banner-img" id="modalRespBannerImg" style="background-image: url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=1200&q=80');"></div>
      </div>

      <!-- 2. Google Forms Style Title & Information Card -->
      <div class="gform-title-card" id="modalRespTitleCard">
        <!-- Section Tab (Seperti 'Section 1 of 3' di gambar contoh) & Accent Line -->
        <div class="gform-card-top-bar" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
          <div class="gform-section-badge" id="modalGformSectionBadge">
            <span id="modalGformSectionText">Bagian 1 dari 4: Instrumen A &bull; Perusahaan</span>
          </div>
          <div class="rtkd-draft-save-status" id="rtkdDraftSaveStatus">
            <i class="fa-solid fa-cloud"></i> <span id="rtkdDraftSaveText">Draft otomatis aktif</span>
          </div>
          <div class="gform-card-accent-line" id="modalGformAccentLine" style="width: 100%;"></div>
        </div>

        <!-- Card Body Content -->
        <div class="gform-card-body">
          <div class="gform-title-row">
            <h1 class="gform-main-title" id="modalRespJudul">Survei Ketenagakerjaan Banyuwangi (RTKD)</h1>
            <div class="gform-title-icons">
              <span class="gform-icon-btn" title="Simulasi Survei"><i class="fa-solid fa-up-right-and-down-left-from-center"></i></span>
              <span class="gform-icon-btn" title="Opsi Formulir"><i class="fa-solid fa-ellipsis-vertical"></i></span>
            </div>
          </div>

          <!-- Description & Bullet Points persis seperti di gambar contoh -->
          <div class="gform-desc-wrap">
            <p class="gform-desc-lead" id="modalRespDeskripsi">
              Survei Primer Ketenagakerjaan Kabupaten Banyuwangi dalam rangka Penyusunan <strong>Rencana Tenaga Kerja Daerah (RTKD) 2026</strong>. Instrumen komprehensif mengacu pada desain survei resmi untuk memetakan penyerapan tenaga kerja industri, profil dan kesiapan pencari kerja/alumni, keselarasan kurikulum vokasi, standar pengupahan &amp; jaminan sosial, serta serapan siswa kelas 12 sekolah menengah.
            </p>

            <div class="gform-meta-bullets">
              <div class="gform-bullet-item" id="bulletItemLembaga">
                <i class="fa-solid fa-building-columns"></i>
                <span>Penyelenggara: <strong id="modalRespLembagaText">Dinas Tenaga Kerja, Transmigrasi dan Perindustrian Kab. Banyuwangi</strong></span>
              </div>
              <div class="gform-bullet-item" id="bulletItemWaktu">
                <i class="fa-solid fa-clock"></i>
                <span>Estimasi pengisian formulir sekitar <strong id="modalRespWaktuText">5 - 10 menit</strong>.</span>
              </div>
              <div class="gform-bullet-item" id="bulletItemKerahasiaan">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Seluruh jawaban responden dijaga <strong>kerahasiaannya (confidential)</strong> dan disajikan secara agregat.</span>
              </div>
              <div class="gform-bullet-item" id="bulletItemDaerah">
                <i class="fa-solid fa-location-dot"></i>
                <span>Wilayah cakupan survei: <strong id="modalRespDaerahText">Kabupaten Banyuwangi</strong></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Sticky Multi-Step Progress & Navigation Bar -->
      <div class="survey-sticky-progress">
        <div class="survey-steps-nav">
          <div class="survey-step-tab active" id="stepTabIndicator1" onclick="goToSurveyStep(1)">
            <span class="step-num"><i class="fa-solid fa-user-check"></i></span>
            <span class="step-label">
              <span class="step-label-full">Bagian 1: Data Responden &amp; Daerah</span>
              <span class="step-label-short">1. Identitas &amp; Wilayah</span>
            </span>
          </div>
          <div class="survey-step-divider"><i class="fa-solid fa-chevron-right"></i></div>
          <div class="survey-step-tab" id="stepTabIndicator2" onclick="goToSurveyStep(2)">
            <span class="step-num"><i class="fa-solid fa-list-check"></i></span>
            <span class="step-label">
              <span class="step-label-full">Bagian 2: Kuesioner Survei</span>
              <span class="step-label-short">2. Kuesioner Penilaian</span>
            </span>
          </div>
        </div>
        <div class="survey-progress-info">
          <div class="survey-progress-track">
            <div class="survey-progress-fill" id="surveyProgressFill" style="width: 0%;"></div>
          </div>
          <div class="survey-progress-text" id="surveyProgressText">Langkah 1 dari 2: Data Responden &amp; Daerah Survei</div>
        </div>
      </div>

      <!-- Modal Body (Questions & Form) -->
      <form id="formSurveyRespondent" onsubmit="handleSurveyRespondentSubmit(event)">
        <input type="hidden" id="respSurveiId" name="SurveiId" value="0">

        <!-- ====================================================================
             HALAMAN RTKD: SURVEI KETENAGAKERJAAN BANYUWANGI (DINAMIS 4 INSTRUMEN)
             ==================================================================== -->
        <div class="survey-step-page" id="surveyStepRtkd" style="display: none;">
          <!-- Instrument Switcher Tabs -->
          <nav class="rtkd-tabs" role="tablist" aria-label="Instrumen survei">
            <button type="button" class="rtkd-tab-btn active" id="modalRtkdTab-A" data-tab="A" aria-selected="true" onclick="switchModalRtkdTab('A')">
              <span class="rtkd-tag">A</span>Perusahaan
            </button>
            <button type="button" class="rtkd-tab-btn" id="modalRtkdTab-B" data-tab="B" aria-selected="false" onclick="switchModalRtkdTab('B')">
              <span class="rtkd-tag">B</span>Pencari kerja &amp; lulusan
            </button>
            <button type="button" class="rtkd-tab-btn" id="modalRtkdTab-C" data-tab="C" aria-selected="false" onclick="switchModalRtkdTab('C')">
              <span class="rtkd-tag">C</span>Pemangku kepentingan
            </button>
            <button type="button" class="rtkd-tab-btn" id="modalRtkdTab-E" data-tab="E" aria-selected="false" onclick="switchModalRtkdTab('E')">
              <span class="rtkd-tag">C2</span>AHP
            </button>
            <button type="button" class="rtkd-tab-btn" id="modalRtkdTab-D" data-tab="D" aria-selected="false" onclick="switchModalRtkdTab('D')">
              <span class="rtkd-tag">D</span>Siswa kelas 12
            </button>
          </nav>

          <input type="hidden" id="modalRtkdActiveInstrument" name="RtkdInstrument" value="A">

          <!-- GPS & Device Tracking Info Bar (Otomatis & Transparan) -->
          <div class="rtkd-device-gps-bar" id="rtkdDeviceGpsBar">
            <div class="track-item">
              <span class="track-icon gps"><i class="fa-solid fa-location-crosshairs"></i></span>
              <div class="track-info">
                <span class="track-label">Koordinat Lokasi Pengisian (GPS)</span>
                <span class="track-val" id="rtkdDispGps"><i class="fa-solid fa-spinner fa-spin"></i> Mendeteksi GPS satelit...</span>
              </div>
              <button type="button" class="btn-refresh-gps" onclick="detectRespondentDeviceLocation(true)" title="Deteksi Ulang GPS">
                <i class="fa-solid fa-rotate"></i>
              </button>
            </div>
            <div class="track-item">
              <span class="track-icon device"><i class="fa-solid fa-mobile-screen-button"></i></span>
              <div class="track-info">
                <span class="track-label">Perangkat Pengisi Terdeteksi</span>
                <span class="track-val" id="rtkdDispDevice">Mendeteksi perangkat...</span>
              </div>
            </div>
          </div>

          <!-- Meta Row Enumerator -->
          <div class="rtkd-meta-row">
            <label class="rtkd-meta-label" for="respEnumerator">
              <i class="fa-solid fa-user-pen"></i> Nama enumerator / Petugas pencatat <span style="color: #dc2626;">*</span>
            </label>
            <input type="text" id="respEnumerator" name="Enumerator" class="rtkd-input" placeholder="Nama petugas yang mendampingi pengisian formulir" autocomplete="name" value="Petugas Survei RTKD">
          </div>

          <!-- Mode Offline & Antrean Switch -->
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 8px;">
            <label class="offline-mode-toggle" id="toggleOfflineModeWrap" title="Aktifkan untuk menyimpan langsung ke memori HP tanpa menunggu sinyal internet">
              <input type="checkbox" id="chkForceOfflineMode" onchange="window.toggleForceOfflineMode && window.toggleForceOfflineMode(this)">
              <i class="fa-solid fa-plane-slash"></i> <span>Mode Lapangan (Simpan Offline Cepat)</span>
            </label>
            <span style="font-size: 12px; color: #64748b;" id="offlineModeNote">
              <i class="fa-solid fa-shield-halved text-success"></i> Antrean offline aktif &bull; Mendukung banyak responden
            </span>
          </div>

          <!-- Consent Checkbox -->
          <label class="rtkd-consent" for="modalRespConsent">
            <input type="checkbox" id="modalRespConsent" checked>
            <span id="modalConsentText">Responden sudah menerima penjelasan tujuan survei, menyetujui pengisian, dan mengetahui bahwa jawaban hanya disajikan secara agregat.</span>
          </label>

          <!-- Dynamic Questions Sheet -->
          <div class="rtkd-sheet" id="modalRtkdSheet"></div>

          <!-- DOKUMENTASI FOTO SURVEI (KAMERA HP / UPLOAD FOTO) -->
          <div class="rtkd-photo-section" id="rtkdPhotoSection">
            <div class="rtkd-photo-card">
              <div class="rtkd-photo-header">
                <div class="rtkd-photo-title">
                  <i class="fa-solid fa-camera" style="color: #043168;"></i>
                  <span>Foto Dokumentasi Survei Lapangan</span>
                </div>
                <span class="rtkd-photo-tag"><i class="fa-solid fa-camera-rotate"></i> Kamera HP Surveiyor</span>
              </div>
              <p class="rtkd-photo-subtitle">
                Ambil foto kegiatan wawancara, responden, atau unit usaha melalui kamera HP surveiyor sebagai bukti dokumentasi kunjungan lapangan. Geotag lokasi GPS &amp; waktu akan disematkan otomatis pada foto.
              </p>

              <!-- Hidden file inputs -->
              <input type="file" id="rtkdCameraInput" accept="image/*" capture="environment" style="display:none;" onchange="handleRtkdPhotoCaptured(this)">
              <input type="file" id="rtkdGalleryInput" accept="image/*" style="display:none;" onchange="handleRtkdPhotoCaptured(this)">
              <input type="hidden" id="respFotoDokumentasi" name="FotoDokumentasi" value="">

              <!-- Upload / Camera Buttons Bar -->
              <div class="rtkd-photo-btn-bar" id="rtkdPhotoBtnBar">
                <button type="button" class="rtkd-cam-btn primary" onclick="$('#rtkdCameraInput').trigger('click')" title="Buka Kamera HP Langsung">
                  <i class="fa-solid fa-camera"></i>
                  <span>Ambil Foto Kamera HP</span>
                </button>
                <button type="button" class="rtkd-cam-btn secondary" onclick="$('#rtkdGalleryInput').trigger('click')" title="Pilih foto dari galeri / berkas">
                  <i class="fa-solid fa-image"></i>
                  <span>Pilih dari Galeri</span>
                </button>
              </div>

              <!-- Live Photo Preview Box (Hidden by default, shown when photo captured) -->
              <div class="rtkd-photo-preview-wrap" id="rtkdPhotoPreviewWrap" style="display:none;">
                <div class="rtkd-photo-thumb-box" onclick="previewRtkdPhotoFull()" title="Klik untuk melihat foto ukuran penuh">
                  <img id="rtkdPhotoPreviewImg" src="" alt="Preview Foto Dokumentasi">
                  <div class="rtkd-photo-badge"><i class="fa-solid fa-circle-check"></i> Foto Siap Terkirim</div>
                </div>
                <div class="rtkd-photo-meta-info">
                  <div class="meta-row"><i class="fa-solid fa-file-image"></i> <span id="rtkdPhotoSizeInfo">-</span></div>
                  <div class="meta-row"><i class="fa-solid fa-clock"></i> <span id="rtkdPhotoTimeInfo">-</span></div>
                  <div class="meta-row" id="rtkdPhotoGeoRow"><i class="fa-solid fa-location-dot"></i> <span id="rtkdPhotoGeoInfo">Koordinat GPS disematkan</span></div>
                  <div class="rtkd-photo-actions-row">
                    <button type="button" class="btn-photo-action preview" onclick="previewRtkdPhotoFull()"><i class="fa-solid fa-magnifying-glass-plus"></i> Lihat Penuh</button>
                    <button type="button" class="btn-photo-action retake" onclick="$('#rtkdCameraInput').trigger('click')"><i class="fa-solid fa-camera-rotate"></i> Foto Ulang</button>
                    <button type="button" class="btn-photo-action remove" onclick="clearRtkdPhoto()"><i class="fa-solid fa-trash-can"></i> Hapus Foto</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Action Footer -->
          <div class="rtkd-actions">
            <button type="button" class="rtkd-btn ghost" onclick="closeSurveyRespondentModal()">
              <i class="fa-solid fa-xmark"></i> Batal
            </button>
            <button type="button" class="rtkd-btn ghost" onclick="resetModalRtkdForm()">
              <i class="fa-solid fa-rotate-left"></i> Kosongkan Formulir
            </button>
            <button type="button" class="rtkd-btn ghost" id="btnDemoAhpModal" style="display:none; color:#0284c7; border-color:#0284c7;" onclick="if(window.RTKDEngine){window.RTKDEngine.fillSampleAHP('formSurveyRespondent', true); Swal.fire('Isi AHP Otomatis', '75 pasangan perbandingan AHP telah terisi dengan konsisten (CR &le; 0.05). Silakan tinjau dan klik Simpan Jawaban Survei.', 'info');}">
              <i class="fa-solid fa-wand-magic-sparkles"></i> Contoh AHP Konsisten
            </button>
            <button type="button" class="rtkd-btn secondary" id="btnSaveOfflineModal" onclick="window.saveSurveyOfflineDirect()" title="Simpan langsung ke antrean perangkat tanpa menunggu internet">
              <i class="fa-solid fa-cloud-arrow-down"></i> Simpan ke Antrean Offline
            </button>
            <button type="submit" class="rtkd-btn" id="btnSubmitModalRtkd">
              <i class="fa-solid fa-paper-plane"></i> Simpan Jawaban Survei
            </button>
            <span class="rtkd-status" id="modalRtkdStatus"></span>
          </div>
        </div>

        <!-- ====================================================================
             HALAMAN 1: IDENTITAS RESPONDEN & KETERANGAN DAERAH SURVEI
             (Disusun bergulir ke bawah, rapi, simpel, ukuran normal)
             ==================================================================== -->
        <div class="survey-step-page" id="surveyStep1">
          
          <div class="resp-step-intro">
            <h4><i class="fa-solid fa-id-card-clip"></i> Bagian 1: Identitas &amp; Keterangan Daerah Survei</h4>
            <p>Silakan lengkapi identitas responden dan keterangan lokasi unit pelayanan publik yang disurvei. Seluruh data dijaga kerahasiaannya.</p>
          </div>

          <!-- Card 1. Identitas Responden -->
          <div class="resp-vertical-card">
            <div class="resp-card-title">
              <i class="fa-solid fa-user" style="color: var(--lugx-blue);"></i> 1. Identitas Responden
            </div>
            <div class="resp-grid-2col">
              <div class="resp-field">
                <label for="respNama">Nama Lengkap (Boleh Anonim)</label>
                <input type="text" id="respNama" name="RespondenNama" placeholder="Contoh: Masyarakat / Nama Lengkap" value="Masyarakat / Anonim">
              </div>
              <div class="resp-field">
                <label for="respKontak">No. WhatsApp / HP (Opsional)</label>
                <input type="text" id="respKontak" name="RespondenKontak" placeholder="08xxxxxxxxxx">
              </div>
            </div>
          </div>

          <!-- Card 2. Karakteristik & Demografi -->
          <div class="resp-vertical-card">
            <div class="resp-card-title">
              <i class="fa-solid fa-address-book" style="color: var(--lugx-blue);"></i> 2. Karakteristik &amp; Demografi Responden
            </div>
            <div class="resp-grid-2col">
              <div class="resp-field">
                <label for="respGender">Jenis Kelamin</label>
                <select id="respGender" name="RespondenGender">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="resp-field">
                <label for="respUsia">Kelompok Usia</label>
                <select id="respUsia" name="RespondenUsia">
                  <option value="15 - 19 Tahun">15 - 19 Tahun</option>
                  <option value="20 - 24 Tahun" selected>20 - 24 Tahun</option>
                  <option value="25 - 29 Tahun">25 - 29 Tahun</option>
                  <option value="30 - 39 Tahun">30 - 39 Tahun</option>
                  <option value="40 Tahun ke Atas">&ge; 40 Tahun</option>
                </select>
              </div>
              <div class="resp-field">
                <label for="respPendidikan">Pendidikan Terakhir</label>
                <select id="respPendidikan" name="RespondenPendidikan">
                  <option value="SMK Vokasi" selected>SMK Vokasi</option>
                  <option value="SMA Sederajat">SMA Sederajat</option>
                  <option value="Diploma / D3">Diploma / D3</option>
                  <option value="Sarjana (S1 / S2)">Sarjana (S1 / S2 / S3)</option>
                  <option value="SD / SMP">SD / SMP</option>
                </select>
              </div>
              <div class="resp-field">
                <label for="respPekerjaan">Kategori / Status Responden</label>
                <select id="respPekerjaan" name="RespondenPekerjaan">
                  <option value="Pencari Kerja / Fresh Graduate" selected>Pencari Kerja / Fresh Graduate (Instrumen B)</option>
                  <option value="Pemberi Kerja / Pelaku Usaha (Perusahaan)">Pemberi Kerja / Pelaku Usaha (Instrumen A)</option>
                  <option value="Siswa Kelas 12 (SMK / SMA / MA)">Siswa Kelas 12 (Instrumen D)</option>
                  <option value="Karyawan Swasta / Buruh Industri">Karyawan Swasta / Buruh Industri</option>
                  <option value="Pemangku Kepentingan / Stakeholder">Pemangku Kepentingan / Stakeholder (Instrumen C)</option>
                  <option value="Wiraswasta / Usaha Mandiri">Wiraswasta / Usaha Mandiri</option>
                  <option value="ASN / TNI / POLRI">ASN / TNI / POLRI</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Card 3. Keterangan Daerah Survei (Cascading Dropdown kodewilayah) & Live Mini-Map Geospasial -->
          <div class="resp-vertical-card">
            <div class="resp-card-title">
              <i class="fa-solid fa-map-location-dot" style="color: #0369a1;"></i> 3. Keterangan Daerah &amp; Wilayah Pelaksanaan Survei
            </div>
            
            <div class="resp-grid-2col">
              <div class="resp-field">
                <label for="respProvinsi">Provinsi</label>
                <select id="respProvinsi" name="Provinsi" onchange="handleWilayahChange('provinsi', this.value)">
                  <option value="">-- Pilih Provinsi --</option>
                  <?php if (!empty($provinsi)): ?>
                    <?php foreach ($provinsi as $pv): ?>
                      <option value="<?= htmlspecialchars($pv['Kode']) ?>"><?= htmlspecialchars($pv['Nama']) ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
              <div class="resp-field">
                <label for="respKabupaten">Kabupaten / Kota</label>
                <select id="respKabupaten" name="Kabupaten" onchange="handleWilayahChange('kabupaten', this.value)">
                  <option value="">-- Pilih Kab/Kota --</option>
                </select>
              </div>
              <div class="resp-field">
                <label for="respKecamatan">Kecamatan</label>
                <select id="respKecamatan" name="Kecamatan" onchange="handleWilayahChange('kecamatan', this.value)">
                  <option value="">-- Pilih Kecamatan --</option>
                </select>
              </div>
              <div class="resp-field">
                <label for="respDesa">Desa / Kelurahan</label>
                <select id="respDesa" name="Desa">
                  <option value="">-- Pilih Desa/Kel --</option>
                </select>
              </div>
            </div>

            <div class="resp-field" style="margin-top: 4px;">
              <label for="respAlamatDetail">Detail Lokasi / Unit Layanan Publik yang Disurvei</label>
              <input type="text" id="respAlamatDetail" name="AlamatDetail" placeholder="Contoh: Kantor Pelayanan BAPPEDA / Mal Pelayanan Publik (MPP) / Kantor Kecamatan Banyuwangi">
            </div>

            <!-- GPS & Live Geospasial Mini-Map Responden -->
            <div class="resp-gps-tracker-card" id="respGpsCard" style="margin-top: 10px; margin-bottom: 0;">
              <div class="resp-gps-header">
                <div class="resp-gps-title">
                  <i class="fa-solid fa-satellite-dish" style="color: #0284c7;"></i>
                  <span>Peta Geospasial &amp; Posisi Titik Responden</span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                  <button type="button" class="btn-geo-detect" id="btnDetectGps" onclick="detectRespondentDeviceLocation(true)">
                    <i class="fa-solid fa-location-crosshairs"></i> Deteksi GPS Saya
                  </button>
                  <span class="resp-gps-status-badge" id="respGpsBadgeStatus"><i class="fa-solid fa-location-dot"></i> Koordinat Siap</span>
                </div>
              </div>

              <!-- Canvas Mini Map Leaflet Interaktif di Form Survei -->
              <div id="respFormMiniMap" style="height: 220px; width: 100%; border-radius: 12px; border: 1.5px solid #cbd5e1; z-index: 10; margin: 4px 0; background: #e2e8f0;"></div>

              <!-- Tampilan Koordinat Real & Device Sensor -->
              <div class="resp-gps-coords-display">
                <div class="resp-gps-field">
                  <span class="lbl"><i class="fa-solid fa-arrows-up-down"></i> Latitude</span>
                  <span class="val" id="dispGpsLat">-8.219234</span>
                </div>
                <div class="resp-gps-field">
                  <span class="lbl"><i class="fa-solid fa-arrows-left-right"></i> Longitude</span>
                  <span class="val" id="dispGpsLng">114.369120</span>
                </div>
                <div class="resp-gps-field">
                  <span class="lbl"><i class="fa-solid fa-circle-nodes"></i> Akurasi GPS</span>
                  <span class="val" id="dispGpsAcc">&plusmn; 8.5 m</span>
                </div>
                <div class="resp-gps-field">
                  <span class="lbl"><i class="fa-solid fa-mobile-screen"></i> Perangkat</span>
                  <span class="val" id="dispGpsDevice" style="font-size: 11.5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Mobile / Desktop</span>
                </div>
              </div>

              <div style="font-size: 11.5px; color: #64748b; line-height: 1.4; display: flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-circle-info" style="color: #0284c7;"></i>
                <span>Peta otomatis menyorot batas wilayah kecamatan yang dipilih. Anda dapat menggeser (drag) pin atau mengklik langsung pada peta untuk memposisikan titik survei secara presisi.</span>
              </div>
            </div>

            <!-- Hidden Inputs Koordinat Geospasial -->
            <input type="hidden" id="respLatitude" name="Latitude" value="-8.219234">
            <input type="hidden" id="respLongitude" name="Longitude" value="114.369120">
            <input type="hidden" id="respLokasiAccuracy" name="LokasiAccuracy" value="8.5">
            <input type="hidden" id="respDevicePlatform" name="DevicePlatform" value="Desktop Browser">
            <input type="hidden" id="respRealKecamatan" name="RealKecamatan" value="">
            <input type="hidden" id="respRealKabupaten" name="RealKabupaten" value="">
          </div>

          <!-- Action Bar Halaman 1 -->
          <div class="survey-step-actions">
            <button type="button" class="btn-step-secondary" onclick="closeSurveyRespondentModal()">
              <i class="fa-solid fa-xmark"></i> Batal
            </button>
            <button type="button" class="btn-step-primary" onclick="goToSurveyStep(2)">
              <span class="btn-txt-full">Lanjutkan ke Kuesioner Survei</span>
              <span class="btn-txt-short">Lanjut</span>
              <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>

        </div>

        <!-- ====================================================================
             HALAMAN 2: INSTRUMEN PERTANYAAN KUESIONER PENILAIAN
             (Tampil di halaman terpisah saat tombol diklik agar tidak campur)
             ==================================================================== -->
        <div class="survey-step-page" id="surveyStep2" style="display: none;">
          
          <div class="resp-step-intro">
            <h4><i class="fa-solid fa-clipboard-question"></i> Bagian 2: Instrumen Pertanyaan Penilaian</h4>
            <p>Berikan penilaian objektif pada setiap butir pertanyaan kuesioner berikut. Tanda (<span style="color: var(--lugx-red); font-weight: 800;">*</span>) adalah pertanyaan wajib diisi.</p>
          </div>

          <!-- List Pertanyaan Dinamis Injected Here (Bergulir ke Bawah) -->
          <div id="respQuestionsList" style="display: flex; flex-direction: column; gap: 14px;">
            <!-- Dynamic Questions List -->
          </div>

          <!-- Action Bar Halaman 2 -->
          <div class="survey-step-actions">
            <button type="button" class="btn-step-secondary" onclick="goToSurveyStep(1)">
              <i class="fa-solid fa-arrow-left"></i>
              <span class="btn-txt-full">Kembali ke Data Daerah</span>
              <span class="btn-txt-short">Kembali</span>
            </button>
            <button type="submit" class="btn-submit-survey" id="btnSubmitSurvey">
              <i class="fa-solid fa-paper-plane"></i>
              <span class="btn-txt-full">Kirim Jawaban Survei</span>
              <span class="btn-txt-short">Kirim</span>
            </button>
          </div>

        </div>

      </form>

    </div>
  </div>

  <!-- ==========================================================================
       MODAL RINCIAN JAWABAN RESPONDEN (DETAIL VIEW)
       ========================================================================== -->
  <div class="survey-respondent-overlay" id="responseDetailModal">
    <div class="survey-respondent-box" style="max-width: 800px;">
      <div class="survey-resp-header" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
        <button type="button" class="btn-close-resp-modal" onclick="closeResponseDetailModal()" aria-label="Tutup">
          <i class="fa-solid fa-xmark"></i>
        </button>
        <h2><i class="fa-solid fa-file-lines"></i> Rincian Lembar Jawaban Responden</h2>
        <p id="detailModalSubtitle">Data isian lengkap kuesioner dan perolehan skor nilai</p>
      </div>

      <div class="survey-resp-body" style="padding: 24px 30px;">
        <!-- Profil Singkat Responden -->
        <div id="detailRespondentProfile" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 20px; margin-bottom: 20px;">
          <!-- Loaded via JS -->
        </div>

        <!-- Rincian Jawaban per Pertanyaan -->
        <h4 style="font-size: 15px; font-weight: 800; color: var(--lugx-dark); margin-bottom: 14px;">
          <i class="fa-solid fa-list-check" style="color: var(--lugx-blue); margin-right: 6px;"></i> Rekap Butir Pertanyaan &amp; Jawaban:
        </h4>
        <div id="detailAnswersContainer" style="display: flex; flex-direction: column; gap: 14px;">
          <!-- Loaded via JS -->
        </div>
      </div>

      <div class="survey-resp-footer" style="padding: 16px 30px;">
        <button type="button" class="btn-action-edit" onclick="closeResponseDetailModal()">
          <i class="fa-solid fa-check"></i> Tutup Rincian
        </button>
      </div>
    </div>
  </div>

    <!-- ==========================================================================
       MODAL: QR CODE AKSES SURVEI (BERSIH & HANYA MUNCUL QR CODE SAJA)
       ========================================================================== -->
  <div class="survey-respondent-overlay" id="surveyQrModal">
    <div class="qr-modal-dialog">
      <div class="qr-modal-header">
        <h3 id="qrModalSurveyJudul"><i class="fa-solid fa-qrcode"></i> QR Code Survei</h3>
        <button type="button" class="btn-close-qr-modal" onclick="closeSurveyQrModal()" aria-label="Tutup">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <div class="qr-modal-body">
        <!-- Clean QR Card Display -->
        <div class="qr-clean-card">
          <div id="qrCodeBox">
            <!-- Rendered by QRCode.js -->
          </div>
        </div>

        <!-- URL Input with Copy Button -->
        <div class="qr-url-input-wrap">
          <div class="qr-url-icon"><i class="fa-solid fa-link"></i></div>
          <input type="text" id="qrModalSurveyUrl" class="qr-url-input" readonly>
          <button type="button" class="btn-copy-link-premium" onclick="copySurveyLink()" id="btnCopyQrLink" title="Salin Tautan">
            <i class="fa-solid fa-copy"></i> <span>Salin</span>
          </button>
        </div>

        <!-- Action: Download QR Code (PNG) -->
        <button type="button" class="btn-download-qr" onclick="downloadQrCodePng()" title="Unduh gambar QR Code resolusi tinggi">
          <i class="fa-solid fa-arrow-down-to-bracket"></i> <span>Unduh QR Code (PNG)</span>
        </button>
      </div>
    </div>
  </div>

  <!-- FOOTER & CONTACT SECTION -->
  <footer id="contact" class="footer-area">
    <div class="footer-container">
      <div class="footer-grid">
        <div class="footer-about">
          <h3>Kantor IDE Consultant</h3>
          <p><i class="fa-solid fa-location-dot" style="color: var(--lugx-red); margin-right: 8px;"></i> Perum Nila Residence B6, Kecamatan Blimbing, Kota Malang</p>
          <p><i class="fa-solid fa-envelope" style="color: var(--lugx-red); margin-right: 8px;"></i> cvideconsultan@gmail.com</p>
          
          <div class="social-icons" style="margin-top: 20px;">
            <a href="https://www.tiktok.com/@intidesainekonomi" class="social-icon-btn" target="_blank" aria-label="TikTok">
              <i class="fa-brands fa-tiktok"></i>
            </a>
            <a href="https://www.instagram.com/intidesainekonomi" class="social-icon-btn" target="_blank" aria-label="Instagram">
              <i class="fa-brands fa-instagram"></i>
            </a>
          </div>
        </div>

        <div class="footer-col">
          <h3>Layanan Kami</h3>
          <ul class="footer-links">
            <li><a href="<?= base_url('#services') ?>">Ekonomi Pembangunan</a></li>
            <li><a href="<?= base_url('#services') ?>">Fiskal &amp; Kebijakan Publik</a></li>
            <li><a href="<?= base_url('#services') ?>">Perencanaan Regional</a></li>
            <li><a href="<?= base_url('#services') ?>">Manajemen</a></li>
            <li><a href="<?= base_url('#services') ?>">Pembuatan Website &amp; Aplikasi</a></li>
            <li><a href="<?= base_url('MenuSurvei') ?>">Survei Kepuasan SKM</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h3>Tautan Cepat</h3>
          <ul class="footer-links">
            <li><a href="<?= base_url('#about') ?>">Visi &amp; Misi</a></li>
            <li><a href="<?= base_url('#team') ?>">Tim Ahli</a></li>
            <li><a href="<?= base_url('MenuPortofolio') ?>">Portofolio Proyek</a></li>
            <li><a href="<?= base_url('legalitas') ?>">Legalitas Usaha</a></li>
            <li><a href="<?= base_url('MasterData') ?>">Repositori Data</a></li>
            <li><a href="<?= base_url('KomparasiData') ?>">Komparasi Data Wilayah</a></li>
          </ul>
        </div>
      </div>

      <div class="copyright">
        <p>Copyright © <span id="current-year"></span> CV Inti Desain Ekonomi Consultant. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp Button -->
  <a href="https://wa.me/6282227666283?text=Halo%20Admin%20IDE%20Consultant,%20saya%20ingin%20bertanya%20mengenai%20survei%20dan%20layanan..." 
     class="whatsapp-float" 
     target="_blank" 
     rel="noopener noreferrer"
     aria-label="Chat via WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
  </a>

  <!-- LOGIN PROMPT MODAL (Lugx Modal Style) -->
  <div id="loginPromptModal" class="login-prompt-modal">
    <div class="login-prompt-content">
      <div class="prompt-icon-wrap">
        <i class="fa-solid fa-triangle-exclamation"></i>
      </div>
      <h3>Perlu Masuk Akun</h3>
      <p>Anda perlu masuk ke akun terlebih dahulu untuk mengisi formulir survei resmi, atau Anda dapat melihat tampilan simulasi demo.</p>
      <div class="login-prompt-actions">
        <button class="login-prompt-btn primary" onclick="handleLoginPromptLogin()">
          <i class="fa-solid fa-right-to-bracket"></i> Masuk
        </button>
        <button class="login-prompt-btn secondary" onclick="handleLoginPromptDemo()">
          <i class="fa-solid fa-eye"></i> Demo
        </button>
      </div>
    </div>
  </div>

  <!-- SIGN IN MODAL (Enlarged 2-Column Split Modal Matching IDE.php) -->
  <div id="signInModal" class="modal">
    <div class="modal-content modal-content-split">
      <div class="login-modal-grid">
        <!-- Left Side: Animated Doodle Vector Banner -->
        <div class="login-banner-side">
          <i class="fa-solid fa-chart-line login-doodle doodle-1"></i>
          <i class="fa-solid fa-briefcase login-doodle doodle-2"></i>
          <i class="fa-solid fa-file-signature login-doodle doodle-3"></i>
          <i class="fa-solid fa-scale-balanced login-doodle doodle-4"></i>
          <i class="fa-solid fa-chess login-doodle doodle-5"></i>
          <i class="fa-solid fa-building-columns login-doodle doodle-6"></i>

          <div class="login-banner-top" style="position: relative; z-index: 2;">
            <div class="login-brand">
              <img src="<?= base_url('assets/img/logo-white-solid.webp') ?>" alt="IDE Consultant Logo">
              <div class="login-brand-text">Inti Desain Ekonomi <span>Consultant</span></div>
            </div>
          </div>
          <div class="login-banner-center" style="position: relative; z-index: 2;">
            <span class="login-pill" id="adminGreetingPill"><i class="fa-solid fa-sun"></i> Selamat Datang, Admin IDE</span>
            <h2>Professional Research &amp; Consulting Portal</h2>
            <p>Solusi riset &amp; konsultasi kebijakan ekonomi berbasis data tepercaya dan terintegrasi.</p>
          </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="login-form-side">
          <button class="modal-close-dark" onclick="closeModal('signInModal')" title="Tutup">&times;</button>
          <div class="login-form-header">
            <h3>Masuk</h3>
            <p class="login-subtext">Masukkan kredensial akun Anda untuk mengakses portal.</p>
          </div>

          <div class="login-form-body">
            <div class="form-group-custom">
              <label class="form-label-custom">Username / ID Akun</label>
              <div class="input-icon-wrapper">
                <i class="fa-solid fa-user input-icon"></i>
                <input type="text" class="form-input-custom" id="Username" placeholder="Masukkan username Anda">
              </div>
            </div>

            <div class="form-group-custom">
              <label class="form-label-custom">Kata Sandi / Password</label>
              <div class="input-icon-wrapper">
                <i class="fa-solid fa-lock input-icon"></i>
                <input type="password" class="form-input-custom" id="Password" placeholder="Masukkan password Anda">
              </div>
            </div>

            <button class="btn-login-large" id="Masuk">
              <i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JQUERY, SWEETALERT2 & SCRIPTS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    var BaseURL = '<?= base_url() ?>';
    var currentSelectedSurvey = null;
    var isLoggedIn = <?= $isLoggedIn ? 'true' : 'false' ?>;
    var userLevel = <?= $userLevel ?>;
    var initialKodeSurvei = '<?= !empty($kodeSurvei) ? htmlspecialchars($kodeSurvei, ENT_QUOTES) : '' ?>';
    var currentQrSurvey = null;

    // Dynamic Admin Time Greeting
    function updateAdminGreeting() {
      var greetingPill = document.getElementById('adminGreetingPill');
      if (!greetingPill) return;

      var hour = new Date().getHours();
      var greetingText = '';
      var iconClass = '';

      if (hour >= 4 && hour < 11) {
        greetingText = 'Selamat Pagi, Admin IDE';
        iconClass = 'fa-solid fa-sun';
      } else if (hour >= 11 && hour < 15) {
        greetingText = 'Selamat Siang, Admin IDE';
        iconClass = 'fa-solid fa-sun-plant-wilt';
      } else if (hour >= 15 && hour < 18.5) {
        greetingText = 'Selamat Sore, Admin IDE';
        iconClass = 'fa-solid fa-cloud-sun';
      } else {
        greetingText = 'Selamat Malam, Admin IDE';
        iconClass = 'fa-solid fa-moon';
      }

      greetingPill.innerHTML = '<i class="' + iconClass + '"></i> ' + greetingText;
    }

    // Modal functions
    function openModal(modalId) {
      var targetModal = document.getElementById(modalId);
      if (targetModal) {
        targetModal.classList.add('active');
        if (modalId === 'signInModal') updateAdminGreeting();
      }
    }

    function closeModal(modalId) {
      var targetModal = document.getElementById(modalId);
      if (targetModal) targetModal.classList.remove('active');
    }

    // Login Prompt Modal functions
    function openLoginPrompt() {
      var prompt = document.getElementById('loginPromptModal');
      if (prompt) prompt.classList.add('active');
    }

    function closeLoginPrompt() {
      var prompt = document.getElementById('loginPromptModal');
      if (prompt) prompt.classList.remove('active');
    }

    function handleLoginPromptLogin() {
      closeLoginPrompt();
      openModal('signInModal');
    }

    function handleLoginPromptDemo() {
      closeLoginPrompt();
      if (currentSelectedSurvey) {
        window.location.href = currentSelectedSurvey.url + '?demo=true';
      }
    }

    // Logout Function
    function logout() {
      Swal.fire({
        title: 'Konfirmasi Logout',
        text: "Apakah Anda yakin ingin keluar dari sesi ini?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#b40814',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Keluar',
        cancelButtonText: 'Batal'
      }).then(function(result) {
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

    // Mobile Navigation Toggle
    var menuToggle = document.getElementById('menuToggle');
    var mobileNav = document.getElementById('mobileNav');
    var menuOverlay = document.getElementById('menuOverlay');

    function openMobileMenu() {
      if (mobileNav && menuOverlay) {
        mobileNav.classList.add('active');
        menuOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    }

    function closeMobileMenu() {
      if (mobileNav && menuOverlay) {
        mobileNav.classList.remove('active');
        menuOverlay.classList.remove('active');
        document.body.style.overflow = '';
      }
    }

    if (menuToggle) {
      menuToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        if (mobileNav.classList.contains('active')) {
          closeMobileMenu();
        } else {
          openMobileMenu();
        }
      });
    }

    window.toggleMobileDropdown = function(btn) {
      var content = btn.nextElementSibling;
      if (content) {
        content.classList.toggle('show-dropdown');
      }
    };

    // Login Form AJAX Handler
    jQuery(document).ready(function($) {
      "use strict";

      $('#Username, #Password').keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
          event.preventDefault();
          $("#Masuk").click();
        }
      });

      $("#Masuk").click(function(e) {
        e.preventDefault();

        var username = $.trim($("#Username").val());
        var password = $.trim($("#Password").val());

        if (!username || !password) {
          Swal.fire('Perhatian', 'Mohon isi username dan password dengan lengkap.', 'warning');
          return;
        }

        var Akun = { 
          Username: username, 
          Password: password 
        };

        var $btn = $(this);
        var originalText = $btn.html();

        $btn.prop("disabled", true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memproses...');

        $.post(BaseURL + "IDE/SignIn", Akun).done(function(Respon) {
          var trimmedRespon = $.trim(Respon);
          if (trimmedRespon == '1') {
            window.location = BaseURL + "SuperAdmin";
          } else if (trimmedRespon == '2') {
            window.location = BaseURL + "Admin";
          } else if (trimmedRespon == '3') {
            window.location = BaseURL + "Staf";
          } else if (trimmedRespon == '4' || trimmedRespon == '5') {
            window.location.reload();
          } else if (trimmedRespon == '0') {
            window.location = BaseURL + "Econk";
          } else {
            Swal.fire('Gagal', trimmedRespon || "Username atau password salah. Silakan coba lagi.", 'error');
            $btn.prop("disabled", false).html(originalText);
          }
        }).fail(function() {
          Swal.fire('Error', 'Gagal terhubung ke server. Periksa koneksi Anda.', 'error');
          $btn.prop("disabled", false).html(originalText);
        });
      });
    });

    // =========================================================================
    // SISTEM FORMULIR & SURVEI DINAMIS (GOOGLE FORM STYLE ENGINE)
    // =========================================================================
    var allSurveys = [];
    var currentBuilderQuestions = [];
    var currentRespondentSurvey = null;
    var currentRespondentQuestions = [];
    var isSurveiyorUser = <?= $isSurveiyor ? 'true' : 'false' ?>;
    var currentSelectedSurvey = null;
    var rekapCache = {};

    function isUserLoggedIn() {
      return <?= $isLoggedIn ? 'true' : 'false' ?>;
    }

    // Modal Peringatan Privasi & Akses Terbatas untuk Pengguna Umum (Belum Login)
    window.promptSurveyAuth = function(type) {
      var featureName = (type === 'peta') ? 'Peta Sebaran Spasial GIS Responden' : (type === 'rekap' ? 'Rincian Rekapitulasi Data Responden' : 'Studio Pembuat Survei Dinamis');
      Swal.fire({
        title: 'Akses Terbatas',
        html: '<div style="text-align: left; font-size: 13.5px; line-height: 1.6; color: #475569;">' +
              '<p style="margin-bottom: 12px;">Untuk melindungi <b>keamanan data</b> dan <b>privasi responden</b> (koordinat geospasial tempat tinggal, demografi, dan isian survei), fitur <b>' + featureName + '</b> hanya dapat diakses oleh <b>Petugas / Surveyor / Staf</b> yang telah login ke dalam sistem.</p>' +
              '<div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #16a34a; padding: 12px; border-radius: 8px; font-size: 13px; color: #166534; margin-bottom: 6px;">' +
              '<i class="fa-solid fa-circle-check" style="margin-right: 6px;"></i> <b>Pengguna umum</b> dapat berpartisipasi mengisi kuesioner survei secara mandiri melalui tombol <b>Isi Survei</b> pada katalog.' +
              '</div>' +
              '</div>',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-right-to-bracket"></i> Masuk (Login Petugas)',
        cancelButtonText: 'Tutup',
        confirmButtonColor: '#b40814',
        cancelButtonColor: '#64748b'
      }).then(function(result) {
        if (result.isConfirmed) {
          openModal('signInModal');
        }
      });
    };

    // --- Tab Switcher untuk Surveiyor / Admin / Staf ---
    window.switchSurveyorTab = function(tabName) {
      if (!isLoggedIn && (tabName === 'builder' || tabName === 'rekap' || tabName === 'peta')) {
        promptSurveyAuth(tabName);
        return;
      }

      $('.surveyor-tab-btn').removeClass('active');
      $('#tabKatalogSection, #tabBuilderSection, #tabRekapSection, #tabPetaSection').removeClass('active');

      if (tabName === 'builder') {
        $('#tabBtnBuilder').addClass('active');
        $('#tabBuilderSection').addClass('active');
        $('html, body').animate({ scrollTop: $('#tabBuilderSection').offset().top - 90 }, 400);
      } else if (tabName === 'rekap') {
        $('#tabBtnRekap').addClass('active');
        $('#tabRekapSection').addClass('active');
        var selectedId = $('#rekapSurveySelector').val();
        if (selectedId) {
          loadRekapitulasi(selectedId);
        }
        $('html, body').animate({ scrollTop: $('#tabRekapSection').offset().top - 90 }, 400);
      } else if (tabName === 'peta') {
        $('#tabBtnPeta').addClass('active');
        $('#tabPetaSection').addClass('active');
        var curGeoId = $('#geoSurveySelect').val() || 3;
        loadSurveyGeoMap(curGeoId);
        $('html, body').animate({ scrollTop: $('#tabPetaSection').offset().top - 90 }, 400);
      } else {
        $('#tabBtnKatalog').addClass('active');
        $('#tabKatalogSection').addClass('active');
        $('html, body').animate({ scrollTop: $('#tabKatalogSection').offset().top - 90 }, 400);
      }
    };

    // --- Ambil Data Seluruh Survei Dinamis dari Database ---
    function loadAllSurveys(autoSelectId, targetTab) {
      $.ajax({
        url: BaseURL + 'IDE/get_survei_dinamis',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
          if (res && res.status && Array.isArray(res.data)) {
            allSurveys = res.data;
            populateFilterOptions(allSurveys);
            renderTypePills(allSurveys);
            populateRekapSurveySelector(allSurveys, autoSelectId);
            filterSurvei();

            // Auto-open modal jika kuesioner diakses melalui link langsung (slug / QR code)
            if (initialKodeSurvei) {
              var matched = allSurveys.find(function(s) {
                return (s.KodeSurvei && s.KodeSurvei.toLowerCase() === initialKodeSurvei.toLowerCase()) || String(s.Id) === initialKodeSurvei;
              });
              if (matched) {
                setTimeout(function() {
                  openRespondentForm(matched.Id, false);
                }, 350);
              }
            }

            if (autoSelectId && targetTab) {
              if (targetTab === 'builder') {
                openEditSurveyBuilder(autoSelectId);
              } else if (targetTab === 'rekap') {
                $('#rekapSurveySelector').val(autoSelectId);
                switchSurveyorTab('rekap');
                loadRekapitulasi(autoSelectId);
              }
            }
          }
        },
        error: function() {
          $('#surveyGrid').html('<div style="grid-column: 1 / -1; text-align:center; padding: 40px; color: var(--lugx-gray);">Gagal memuat survei dari server. Silakan refresh halaman.</div>');
        }
      });
    }

    // Populate filter dropdowns & sync with pills
    function populateFilterOptions(surveys) {
      var jenisSet = new Set();
      var tahunSet = new Set();
      var statusSet = new Set();

      surveys.forEach(function(s) {
        if (s.Jenis) jenisSet.add(s.Jenis);
        if (s.Tahun) tahunSet.add(s.Tahun);
        if (s.Status) statusSet.add(s.Status);
      });

      var currentJenis = $('#jenis').val();
      var currentTahun = $('#tahun').val();
      var currentStatus = $('#status').val();

      $('#jenis').html('<option value="">Semua Jenis</option>');
      jenisSet.forEach(function(j) {
        $('#jenis').append('<option value="' + j + '" ' + (currentJenis === j ? 'selected' : '') + '>' + j + '</option>');
      });

      $('#tahun').html('<option value="">Semua Tahun</option>');
      tahunSet.forEach(function(t) {
        $('#tahun').append('<option value="' + t + '" ' + (currentTahun === t ? 'selected' : '') + '>' + t + '</option>');
      });

      $('#status').html('<option value="">Semua Status</option>');
      statusSet.forEach(function(st) {
        $('#status').append('<option value="' + st + '" ' + (currentStatus === st ? 'selected' : '') + '>' + st + '</option>');
      });
    }

    // Dynamic Render Quick Filter Pills for Survey Types
    function renderTypePills(surveys) {
      var $container = $('#surveyTypePillsContainer');
      if (!$container.length) return;

      var typeCounts = {};
      var total = surveys.length;
      surveys.forEach(function(s) {
        var j = s.Jenis || 'IKM';
        typeCounts[j] = (typeCounts[j] || 0) + 1;
      });

      var currentJenis = $('#jenis').val() || '';

      var html = '<button type="button" class="type-pill-btn ' + (!currentJenis ? 'active' : '') + '" data-jenis="" onclick="selectJenisPill(\'\')">' +
        '<i class="fa-solid fa-border-all"></i> Semua Survei <span class="pill-badge" id="pillCountAll">' + total + '</span>' +
      '</button>';

      var keys = Object.keys(typeCounts);
      // Urutkan dengan IKM di paling depan jika ada
      keys.sort(function(a, b) {
        if (a === 'IKM') return -1;
        if (b === 'IKM') return 1;
        return a.localeCompare(b);
      });

      keys.forEach(function(j) {
        var isAct = (currentJenis === j);
        var icon = (j.toUpperCase() === 'IKM' ? 'fa-clipboard-check' : 'fa-chart-pie');
        html += '<button type="button" class="type-pill-btn ' + (isAct ? 'active' : '') + '" data-jenis="' + j + '" onclick="selectJenisPill(\'' + j.replace(/'/g, "\\'") + '\')">' +
          '<i class="fa-solid ' + icon + '"></i> ' + j + ' <span class="pill-badge">' + typeCounts[j] + '</span>' +
        '</button>';
      });

      $container.html(html);
    }

    window.selectJenisPill = function(jenis) {
      $('#jenis').val(jenis);
      $('.type-pill-btn').removeClass('active');
      $('.type-pill-btn[data-jenis="' + jenis + '"]').addClass('active');
      filterSurvei();
    };

    $(document).on('change', '#jenis', function() {
      var val = $(this).val();
      $('.type-pill-btn').removeClass('active');
      $('.type-pill-btn[data-jenis="' + val + '"]').addClass('active');
    });

    // Populate Rekap survey selector
    function populateRekapSurveySelector(surveys, selectedId) {
      var $sel = $('#rekapSurveySelector');
      $sel.empty();
      if (!surveys || surveys.length === 0) {
        $sel.append('<option value="">Belum ada survei</option>');
        return;
      }

      surveys.forEach(function(s, idx) {
        var isSel = selectedId ? (s.Id == selectedId) : (idx === 0);
        $sel.append('<option value="' + s.Id + '" ' + (isSel ? 'selected' : '') + '>' + s.Judul + ' (' + (s.Tahun || '-') + ')</option>');
      });
    }

    // --- Filter & Render Katalog Survei Dinamis ---
    window.filterSurvei = function() {
      var keyword = $.trim($('#searchKeyword').val() || '').toLowerCase();
      var jenis = $('#jenis').val();
      var tahun = $('#tahun').val();
      var status = $('#status').val();

      var filtered = allSurveys.filter(function(item) {
        var matchKeyword = true;
        if (keyword) {
          var title = (item.Judul || '').toLowerCase();
          var lembaga = (item.Lembaga || '').toLowerCase();
          var daerah = (item.DaerahSurvei || '').toLowerCase();
          matchKeyword = title.indexOf(keyword) !== -1 || lembaga.indexOf(keyword) !== -1 || daerah.indexOf(keyword) !== -1;
        }

        var matchJenis = !jenis || item.Jenis === jenis;
        var matchTahun = !tahun || item.Tahun === tahun;
        var matchStatus = !status || item.Status === status;

        return matchKeyword && matchJenis && matchTahun && matchStatus;
      });

      $('#surveiTotalCounter').text(filtered.length + ' dari ' + allSurveys.length + ' Formulir Survei Tersedia');
      renderSurveiCards(filtered);
    };

    function renderSurveiCards(data) {
      var grid = document.getElementById('surveyGrid');
      if (!grid) return;
      grid.innerHTML = '';

      if (data.length === 0) {
        grid.innerHTML = '<div style="text-align:center; color: var(--lugx-gray); grid-column: 1 / -1; padding: 60px 20px; background: var(--lugx-light-gray); border-radius: var(--lugx-radius);"><i class="fa-solid fa-clipboard-question" style="font-size: 42px; margin-bottom: 12px; color: #cbd5e1; display: block;"></i><h4 style="font-size: 16px; font-weight: 700; color: var(--lugx-dark);">Belum Ada Formulir Survei</h4><p style="font-size: 14px; margin: 0;">Tidak ada survei yang sesuai dengan kriteria filter saat ini.</p></div>';
        return;
      }

      data.forEach(function(item) {
        var card = document.createElement('div');
        card.className = 'survey-card';

        var daerahSurveiText = item.DaerahSurvei ? item.DaerahSurvei : 'Seluruh Wilayah / Terbuka';
        var isActive = (item.Status === 'Aktif');

        var surveyorControlsHtml = '';
        if (isSurveiyorUser) {
          surveyorControlsHtml = 
            '<div class="card-surveyor-actions">' +
              '<button type="button" class="btn-action-edit" onclick="openEditSurveyBuilder(' + item.Id + ')" title="Kelola Formulir Studio">' +
                '<i class="fa-solid fa-pen-ruler"></i> Edit' +
              '</button>' +
              '<button type="button" class="btn-action-rekap" onclick="openRekapForSurvey(' + item.Id + ')" title="Lihat Rekapitulasi Respon">' +
                '<i class="fa-solid fa-chart-pie"></i> Rekap (' + (item.TotalResponden || 0) + ')' +
              '</button>' +
              '<a href="' + BaseURL + 'IDE/export_responden_excel/' + item.Id + '" class="btn-action-excel" title="Unduh Spreadsheet / Excel Data Responden">' +
                '<i class="fa-solid fa-file-excel"></i> Excel' +
              '</a>' +
              (userLevel !== 5 ? (
              '<button type="button" class="btn-action-del" onclick="handleDeleteSurvey(' + item.Id + ', \'' + item.Judul.replace(/'/g, "\\'") + '\')" title="Hapus Survei">' +
                '<i class="fa-solid fa-trash-can"></i> Hapus' +
              '</button>'
              ) : '') +
            '</div>';
        }

        var isMulti = (item.TipeSurvei === 'multi') || (item.InstrumenList && item.InstrumenList.indexOf(',') !== -1) || (item.Id == 4) || (item.Judul && item.Judul.toLowerCase().indexOf('rtkd') !== -1);
        var multiBadgeHtml = isMulti ? '<span class="badge-multi-instrumen"><i class="fa-solid fa-layer-group"></i> Multi-Instrumen</span>' : '';

        card.innerHTML = 
          '<div class="card-header-row">' +
            '<div class="card-icon">' +
              '<i class="fa-solid fa-square-poll-vertical"></i>' +
            '</div>' +
            '<div style="display: flex; align-items: center; gap: 6px; flex-wrap: wrap; justify-content: flex-end;">' +
              multiBadgeHtml +
              '<span class="card-status ' + (isActive ? 'status-active' : 'status-inactive') + '">' +
                '<i class="fa-solid ' + (isActive ? 'fa-circle-check' : 'fa-circle-xmark') + '"></i> ' + item.Status +
              '</span>' +
            '</div>' +
          '</div>' +
          '<h3 class="card-title">' + item.Judul + '</h3>' +
          '<div class="card-meta">' +
            '<div class="meta-row">' +
              '<span class="meta-label">Instansi</span>' +
              '<span class="meta-colon">:</span>' +
              '<span class="meta-value">' + (item.Lembaga || 'IDE Consultant') + '</span>' +
            '</div>' +
            '<div class="meta-row">' +
              '<span class="meta-label">Jenis &amp; Tahun</span>' +
              '<span class="meta-colon">:</span>' +
              '<span class="meta-value">' + (item.Jenis || 'IKM') + ' &bull; ' + (item.Tahun || date('Y')) + '</span>' +
            '</div>' +
            '<div class="meta-row">' +
              '<span class="meta-label">Daerah Survei</span>' +
              '<span class="meta-colon">:</span>' +
              '<span class="meta-value">' +
                '<span class="badge-daerah-survei"><i class="fa-solid fa-location-dot"></i> ' + daerahSurveiText + '</span>' +
              '</span>' +
            '</div>' +
            '<div class="meta-row">' +
              '<span class="meta-label">Kuesioner</span>' +
              '<span class="meta-colon">:</span>' +
              '<span class="meta-value"><b>' + (item.TotalPertanyaan || 0) + '</b> Butir Pertanyaan &bull; ' + (item.EstimasiWaktu || '3 - 5 Menit') + '</span>' +
            '</div>' +
            (item.TotalResponden > 0 ? 
            '<div class="meta-row">' +
              '<span class="meta-label">' + ((item.Jenis === 'IKM') ? 'Skor IKM' : 'Skor Survei') + '</span>' +
              '<span class="meta-colon">:</span>' +
              '<span class="meta-value" style="color: #059669; font-weight: 800;">' + item.RataRataSkor + ' (' + item.TotalResponden + ' Responden)</span>' +
            '</div>' : '') +
          '</div>' +
          '<div class="card-actions">' +
            '<button class="btn-action-fill" onclick="openRespondentForm(' + item.Id + ', false)" title="Buka lembar isian kuesioner">' +
              '<i class="fa-solid fa-pen-to-square"></i> Isi Survei' +
            '</button>' +
            '<button class="btn-action-demo" onclick="openRespondentForm(' + item.Id + ', true)" title="Lihat simulasi demo survei">' +
              '<i class="fa-solid fa-eye"></i> Demo' +
            '</button>' +
            '<button type="button" class="btn-action-qr" onclick="openSurveyQrModal(' + item.Id + ')" title="Tampilkan QR Code Kuesioner">' +
              '<i class="fa-solid fa-qrcode"></i> QR Code' +
            '</button>' +
            (isLoggedIn ? 
              '<button type="button" class="btn-action-map" onclick="openSurveyGeoMap(' + item.Id + ')" title="Buka Peta Sebaran Geospasial Google Maps Responden">' +
                '<i class="fa-solid fa-map-location-dot"></i> Peta' +
              '</button>' : 
              '<button type="button" class="btn-action-map btn-action-map-locked" onclick="promptSurveyAuth(\'peta\')" title="Peta Sebaran Responden Terkunci (Khusus Petugas / Surveyor)">' +
                '<i class="fa-solid fa-lock"></i> Peta' +
              '</button>'
            ) +
          '</div>' +
          surveyorControlsHtml;

        grid.appendChild(card);
      });
    }

    // =========================================================================
    // QR CODE GENERATOR & BANNER PUBLIKASI ENGINE
    // =========================================================================
    function getSurveyPublicUrl(survey) {
      var slug = survey.KodeSurvei || ('survei-' + survey.Id);
      return BaseURL + 'MenuSurvei/' + encodeURIComponent(slug);
    }

    function triggerDownload(dataUrl, filename) {
      var a = document.createElement('a');
      a.href = dataUrl;
      a.download = filename;
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    }

    window.openSurveyQrModal = function(surveyId) {
      var survey = allSurveys.find(function(s) { return s.Id == surveyId; });
      if (!survey) return;
      currentQrSurvey = survey;

      var url = getSurveyPublicUrl(survey);

      $('#qrModalSurveyJudul').html('<i class="fa-solid fa-qrcode"></i> ' + (survey.Judul || 'QR Code Survei'));
      $('#qrModalSurveyUrl').val(url);

      var qrBox = document.getElementById('qrCodeBox');
      qrBox.innerHTML = '';

      try {
        new QRCode(qrBox, {
          text: url,
          width: 220,
          height: 220,
          colorDark: '#043168',
          colorLight: '#ffffff',
          correctLevel: QRCode.CorrectLevel.H
        });
      } catch (err) {
        qrBox.innerHTML = '<img src="https://api.qrserver.com/v1/create-qr-code/?data=' + encodeURIComponent(url) + '&size=220x220&color=043168" alt="QR Code" style="width:220px; height:220px; display:block;" crossorigin="anonymous">';
      }

      $('#surveyQrModal').addClass('active');
    };

    window.closeSurveyQrModal = function() {
      $('#surveyQrModal').removeClass('active');
    };

    window.copySurveyLink = function() {
      var input = document.getElementById('qrModalSurveyUrl');
      var $btn = $('#btnCopyQrLink');
      if (input) {
        input.select();
        input.setSelectionRange(0, 99999);
        var originalBtnHtml = $btn.html();

        var showSuccess = function() {
          $btn.html('<i class="fa-solid fa-check"></i> <span>Tersalin!</span>').css({
            'background': 'linear-gradient(135deg, #059669 0%, #10b981 100%)'
          });
          setTimeout(function() {
            $btn.html(originalBtnHtml).css('background', '');
          }, 2000);

          Swal.fire({
            icon: 'success',
            title: 'Tautan Tersalin!',
            text: 'Tautan formulir survei berhasil disalin ke clipboard.',
            timer: 1800,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
          });
        };

        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(input.value).then(showSuccess).catch(function() {
            document.execCommand('copy');
            showSuccess();
          });
        } else {
          document.execCommand('copy');
          showSuccess();
        }
      }
    };

    window.downloadQrCodePng = function() {
      if (!currentQrSurvey) return;
      var qrBox = document.getElementById('qrCodeBox');
      var canvas = qrBox.querySelector('canvas');
      var img = qrBox.querySelector('img');

      var filename = 'QR-Survei-' + (currentQrSurvey.KodeSurvei || currentQrSurvey.Id) + '.png';

      if (canvas) {
        var dataUrl = canvas.toDataURL('image/png');
        triggerDownload(dataUrl, filename);
        Swal.fire({
          icon: 'success',
          title: 'QR Code Diunduh!',
          text: 'File ' + filename + ' berhasil disimpan.',
          timer: 2000,
          showConfirmButton: false
        });
      } else if (img && img.src) {
        triggerDownload(img.src, filename);
      } else {
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'QR code belum siap diunduh.' });
      }
    };

    // Fungsi Unduh Data Responder ke Format Spreadsheet / Excel
    window.downloadRekapExcel = function(surveyId) {
      if (!isLoggedIn) {
        promptSurveyAuth('rekap');
        return;
      }
      var sId = surveyId || $('#rekapSurveySelector').val();
      if (!sId) {
        window.location.href = BaseURL + 'IDE/export_responden_excel';
        return;
      }
      window.location.href = BaseURL + 'IDE/export_responden_excel/' + sId;
    };

    // =========================================================================
    // GOOGLE FORM STYLE SURVEY BUILDER ENGINE (STUDIO SURVEI DINAMIS)
    // =========================================================================
    // Banner Customizer Helpers
    window.setBuilderBannerColor = function(color) {
      $('#builderBannerColor').val(color);
      $('#builderBannerColorPicker').val(color);
      $('.swatch-btn').removeClass('active');
      $('.swatch-btn[data-color="' + color + '"]').addClass('active');
      updateBannerPreviewStyle();
    };

    window.handleBannerPresetChange = function(val) {
      if (val === 'custom') {
        $('#builderBannerImage').show().focus();
      } else {
        $('#builderBannerImage').hide().val(val);
      }
      updateBannerPreviewStyle();
    };

    window.updateBannerPreviewImage = function(url) {
      updateBannerPreviewStyle();
    };

    function updateBannerPreviewStyle() {
      var color = $('#builderBannerColor').val() || '#043168';
      var imgUrl = $('#builderBannerImage').val();
      var $preview = $('#builderBannerPreview');
      if (imgUrl) {
        $preview.css({
          'background-image': 'url(' + imgUrl + ')',
          'background-color': color
        });
      } else {
        $preview.css({
          'background-image': 'none',
          'background': 'linear-gradient(135deg, ' + color + ' 0%, #0d3d7c 100%)'
        });
      }
      $('#previewBannerJudul').text($('#builderJudul').val() || 'Judul Formulir Kuesioner Baru');
      $('#previewBannerLembaga').html('<i class="fa-solid fa-building-columns"></i> ' + ($('#builderLembaga').val() || 'Instansi / Lembaga Pelaksana'));
    }

    // Attach listeners for live preview title
    $(document).on('input', '#builderJudul', function() {
      $('#previewBannerJudul').text($(this).val() || 'Judul Formulir Kuesioner Baru');
    });
    $(document).on('input', '#builderLembaga', function() {
      $('#previewBannerLembaga').html('<i class="fa-solid fa-building-columns"></i> ' + ($(this).val() || 'Instansi / Lembaga Pelaksana'));
    });

    window.openCreateSurveyBuilder = function() {
      $('#builderSurveyId').val('0');
      $('#builderModeBadge').html('<i class="fa-solid fa-wand-magic-sparkles"></i> Mode Pembuat Kuesioner Baru');
      // Kosongkan seluruh isian formulir agar siap diisi baru
      $('#builderJudul').val('');
      $('#builderDeskripsi').val('');
      $('#builderLembaga').val('');
      $('#builderJenis').val('IKM');
      $('#builderTahun').val(new Date().getFullYear());
      $('#builderStatus').val('Aktif');
      $('#builderDaerahText').val('');
      $('#builderProvinsi').val('');
      $('#builderKabupaten').html('<option value="">-- Pilih Kab/Kota --</option>');

      // Reset banner customizer
      $('#builderBannerPreset').val('');
      $('#builderBannerImage').hide().val('');
      setBuilderBannerColor('#043168');
      $('#previewBannerJudul').text('Judul Formulir Kuesioner Baru');
      $('#previewBannerLembaga').html('<i class="fa-solid fa-building-columns"></i> Instansi Pelaksana');

      // Inisialisasi 1 butir pertanyaan kosong siap diisi
      currentBuilderQuestions = [
        {
          Pertanyaan: '',
          Deskripsi: '',
          Tipe: 'radio',
          IsRequired: 1,
          OpsiPilihan: [
            { label: '', nilai: 4 },
            { label: '', nilai: 3 },
            { label: '', nilai: 2 },
            { label: '', nilai: 1 }
          ]
        }
      ];

      renderBuilderQuestions();
      switchSurveyorTab('builder');
    };

    window.openEditSurveyBuilder = function(surveyId) {
      Swal.fire({
        title: 'Memuat Studio Survei...',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
      });

      $.ajax({
        url: BaseURL + 'IDE/get_survei_detail/' + surveyId,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
          Swal.close();
          if (res && res.status && res.survei) {
            var s = res.survei;
            $('#builderSurveyId').val(s.Id);
            $('#builderModeBadge').html('<i class="fa-solid fa-pen-to-square"></i> Mengedit Kuesioner: #' + s.Id);
            $('#builderJudul').val(s.Judul);
            $('#builderDeskripsi').val(s.Deskripsi || '');
            $('#builderLembaga').val(s.Lembaga || '');
            $('#builderJenis').val(s.Jenis || 'IKM');
            $('#builderTahun').val(s.Tahun || new Date().getFullYear());
            $('#builderStatus').val(s.Status || 'Aktif');
            $('#builderDaerahText').val(s.DaerahSurvei || '');
            var sTipe = s.TipeSurvei || ((s.Id == 4 || (s.Judul && s.Judul.toLowerCase().indexOf('rtkd') !== -1)) ? 'multi' : 'standar');
            $('#builderTipeSurvei').val(sTipe);

            // Populate Banner Settings
            var bColor = s.BannerColor || '#043168';
            var bImg = s.BannerImage || '';
            $('#builderBannerImage').val(bImg);
            if (bImg) {
              $('#builderBannerPreset').val('custom');
              $('#builderBannerImage').show();
            } else {
              $('#builderBannerPreset').val('');
              $('#builderBannerImage').hide();
            }
            setBuilderBannerColor(bColor);

            currentBuilderQuestions = [];
            if (res.pertanyaan && res.pertanyaan.length > 0) {
              res.pertanyaan.forEach(function(p) {
                currentBuilderQuestions.push({
                  Pertanyaan: p.Pertanyaan,
                  Deskripsi: p.Deskripsi || '',
                  Tipe: p.Tipe || 'radio',
                  IsRequired: parseInt(p.IsRequired) === 1 ? 1 : 0,
                  Section: p.Section || '',
                  Instrumen: p.Instrumen || 'Semua',
                  ScaleMin: parseInt(p.ScaleMin) || 1,
                  ScaleMax: parseInt(p.ScaleMax) || 5,
                  ScaleMinLabel: p.ScaleMinLabel || 'Sangat Tidak Baik',
                  ScaleMaxLabel: p.ScaleMaxLabel || 'Sangat Baik',
                  OpsiPilihan: p.OpsiPilihanList || []
                });
              });
            }

            renderBuilderQuestions();
            switchSurveyorTab('builder');
          } else {
            Swal.fire('Error', res.message || 'Gagal memuat detail survei.', 'error');
          }
        },
        error: function() {
          Swal.close();
          Swal.fire('Error', 'Gagal terhubung ke server studio survei.', 'error');
        }
      });
    };

    // Render Question Cards in Builder (Enterprise Studio)
    function renderBuilderQuestions() {
      var $container = $('#gformCardsContainer');
      $container.empty();

      var qCount = currentBuilderQuestions.length;
      $('#builderQuestionsCount, #builderBottomCount').text(qCount);
      $('#builderHeaderCount').html('<i class="fa-solid fa-list-check"></i> ' + qCount + ' Pertanyaan');

      if (qCount === 0) {
        $container.html('<div style="text-align:center; padding: 48px 24px; background: #ffffff; border-radius: 18px; border: 2px dashed #cbd5e1; color: #64748b;"><i class="fa-solid fa-layer-group fa-2x" style="color: #94a3b8; margin-bottom: 12px; display: block;"></i>Belum ada butir pertanyaan dalam kuesioner ini.<br>Klik tombol <b>"Tambah Pertanyaan Baru"</b> di atas atau di bawah untuk mulai menyusun kuesioner.</div>');
        return;
      }

      currentBuilderQuestions.forEach(function(q, qIdx) {
        var card = document.createElement('div');
        card.className = 'gform-card';
        card.id = 'gformCard_' + qIdx;

        // Type Select Options
        var typeOptionsHtml = 
          '<option value="radio" ' + (q.Tipe === 'radio' ? 'selected' : '') + '>⚪ Pilihan Ganda (Radio & Bobot Nilai)</option>' +
          '<option value="checkbox" ' + (q.Tipe === 'checkbox' ? 'selected' : '') + '>☑️ Kotak Centang (Checkboxes)</option>' +
          '<option value="dropdown" ' + (q.Tipe === 'dropdown' ? 'selected' : '') + '>🔻 Menu Dropdown (Pilihan Tunggal)</option>' +
          '<option value="scale" ' + (q.Tipe === 'scale' ? 'selected' : '') + '>📶 Skala Linear (Rating / Kepuasan)</option>' +
          '<option value="text" ' + (q.Tipe === 'text' ? 'selected' : '') + '>✏️ Jawaban Singkat (Text)</option>' +
          '<option value="textarea" ' + (q.Tipe === 'textarea' ? 'selected' : '') + '>📝 Paragraf / Uraian Bebas</option>' +
          '<option value="number" ' + (q.Tipe === 'number' ? 'selected' : '') + '>🔢 Angka / Numerik</option>';

        // Options or Scale section depending on type
        var typeSpecificHtml = '';
        if (q.Tipe === 'radio' || q.Tipe === 'checkbox' || q.Tipe === 'dropdown') {
          var optionsRowsHtml = '';
          var iconClass = (q.Tipe === 'radio' ? 'fa-regular fa-circle-dot' : (q.Tipe === 'checkbox' ? 'fa-regular fa-square-check' : 'fa-solid fa-caret-down'));
          
          if (!q.OpsiPilihan || q.OpsiPilihan.length === 0) {
            q.OpsiPilihan = [
              { label: 'Sangat Puas / Sangat Baik', nilai: 4 },
              { label: 'Puas / Baik', nilai: 3 },
              { label: 'Kurang Puas / Kurang Baik', nilai: 2 },
              { label: 'Tidak Puas / Tidak Baik', nilai: 1 }
            ];
          }

          q.OpsiPilihan.forEach(function(opt, optIdx) {
            optionsRowsHtml += 
              '<div class="gform-option-row">' +
                '<span class="gform-opt-icon"><i class="' + iconClass + '"></i></span>' +
                '<input type="text" class="gform-opt-input" placeholder="Teks Pilihan ' + (optIdx + 1) + '" value="' + (opt.label ? opt.label.replace(/"/g, '&quot;') : '') + '" oninput="syncOptionLabel(' + qIdx + ', ' + optIdx + ', this.value)">' +
                '<div class="gform-val-box" title="Bobot nilai skor angka untuk opsi ini">' +
                  '<span class="gform-val-lbl"><i class="fa-solid fa-award"></i> Nilai:</span>' +
                  '<input type="number" step="any" class="gform-val-input" value="' + (opt.nilai !== undefined ? opt.nilai : 0) + '" oninput="syncOptionValue(' + qIdx + ', ' + optIdx + ', this.value)">' +
                '</div>' +
                '<button type="button" class="btn-remove-opt" onclick="removeOptionFromQuestion(' + qIdx + ', ' + optIdx + ')" title="Hapus Opsi"><i class="fa-solid fa-xmark"></i></button>' +
              '</div>';
          });

          typeSpecificHtml = 
            '<div class="gform-options-container" id="optionsContainer_' + qIdx + '">' +
              optionsRowsHtml +
            '</div>' +
            '<div class="gform-opt-actions-bar">' +
              '<button type="button" class="btn-add-opt" onclick="addOptionToQuestion(' + qIdx + ')">' +
                '<i class="fa-solid fa-plus"></i> Tambah Pilihan Opsi' +
              '</button>' +
              '<div class="gform-preset-wrap">' +
                '<span class="gform-preset-lbl"><i class="fa-solid fa-sliders"></i> Preset Skala:</span>' +
                '<button type="button" class="btn-preset" onclick="applyPresetToQuestion(' + qIdx + ', \'ikm\')">IKM (4-3-2-1)</button>' +
                '<button type="button" class="btn-preset" onclick="applyPresetToQuestion(' + qIdx + ', \'likert\')">Likert (5-1)</button>' +
                '<button type="button" class="btn-preset" onclick="applyPresetToQuestion(' + qIdx + ', \'binary\')">Biner (Ya/Tidak)</button>' +
              '</div>' +
            '</div>';

        } else if (q.Tipe === 'scale') {
          typeSpecificHtml = 
            '<div class="gform-scale-settings">' +
              '<div class="gform-scale-group">' +
                '<label><i class="fa-solid fa-arrows-left-right"></i> Rentang Skala:</label>' +
                '<select onchange="syncScaleConfig(' + qIdx + ', \'min\', this.value)">' +
                  '<option value="1" ' + (q.ScaleMin == 1 ? 'selected' : '') + '>1</option>' +
                  '<option value="0" ' + (q.ScaleMin == 0 ? 'selected' : '') + '>0</option>' +
                '</select>' +
                '<span style="font-size: 13px; font-weight: 700; color: #64748b;">s.d.</span>' +
                '<select onchange="syncScaleConfig(' + qIdx + ', \'max\', this.value)">' +
                  '<option value="3" ' + (q.ScaleMax == 3 ? 'selected' : '') + '>3</option>' +
                  '<option value="4" ' + (q.ScaleMax == 4 ? 'selected' : '') + '>4</option>' +
                  '<option value="5" ' + (q.ScaleMax == 5 ? 'selected' : '') + '>5</option>' +
                  '<option value="10" ' + (q.ScaleMax == 10 ? 'selected' : '') + '>10</option>' +
                '</select>' +
              '</div>' +
              '<div class="gform-scale-group">' +
                '<label>Label Terendah:</label>' +
                '<input type="text" placeholder="Contoh: Sangat Buruk" value="' + (q.ScaleMinLabel || 'Sangat Tidak Baik') + '" oninput="syncScaleConfig(' + qIdx + ', \'minLabel\', this.value)">' +
              '</div>' +
              '<div class="gform-scale-group">' +
                '<label>Label Tertinggi:</label>' +
                '<input type="text" placeholder="Contoh: Sangat Baik" value="' + (q.ScaleMaxLabel || 'Sangat Baik') + '" oninput="syncScaleConfig(' + qIdx + ', \'maxLabel\', this.value)">' +
              '</div>' +
            '</div>';
        } else {
          typeSpecificHtml = 
            '<div style="background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 12px; padding: 14px 18px; color: #64748b; font-size: 13px; font-style: italic; margin-bottom: 14px;">' +
              '<i class="fa-solid fa-align-left" style="margin-right: 6px;"></i> Area isian bebas responden (akan dirender sesuai input ' + q.Tipe + ' pada lembar kuesioner).' +
            '</div>';
        }

        card.innerHTML = 
          '<div class="gform-card-top">' +
            '<div style="display: flex; align-items: center; gap: 10px;">' +
              '<span class="gform-q-number">#' + (qIdx + 1) + '</span>' +
              '<span style="font-size: 13.5px; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 0.3px;">Butir Pertanyaan ' + (qIdx + 1) + '</span>' +
            '</div>' +
            '<div style="display: flex; align-items: center; gap: 10px;">' +
              '<select class="gform-q-type-select" onchange="changeQuestionType(' + qIdx + ', this.value)">' +
                typeOptionsHtml +
              '</select>' +
              '<div class="gform-card-ctrls">' +
                '<button type="button" class="btn-q-ctrl" onclick="moveQuestion(' + qIdx + ', -1)" title="Pindah ke Atas" ' + (qIdx === 0 ? 'disabled style="opacity: 0.3;"' : '') + '><i class="fa-solid fa-arrow-up"></i></button>' +
                '<button type="button" class="btn-q-ctrl" onclick="moveQuestion(' + qIdx + ', 1)" title="Pindah ke Bawah" ' + (qIdx === currentBuilderQuestions.length - 1 ? 'disabled style="opacity: 0.3;"' : '') + '><i class="fa-solid fa-arrow-down"></i></button>' +
                '<button type="button" class="btn-q-ctrl" onclick="duplicateQuestion(' + qIdx + ')" title="Duplikasi Pertanyaan"><i class="fa-solid fa-copy"></i></button>' +
                '<button type="button" class="btn-q-ctrl del" onclick="deleteQuestion(' + qIdx + ')" title="Hapus Pertanyaan"><i class="fa-solid fa-trash-can"></i></button>' +
              '</div>' +
            '</div>';

        var isMultiModel = ($('#builderTipeSurvei').val() === 'multi');
        var multiFieldsHtml = '';
        if (isMultiModel) {
          multiFieldsHtml = 
            '<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px; background: #eff6ff; padding: 10px 14px; border-radius: 10px; border: 1px solid #bfdbfe;">' +
              '<div>' +
                '<label style="font-size: 11px; font-weight: 800; color: #1d4ed8; text-transform: uppercase; margin-bottom: 4px; display: block;"><i class="fa-solid fa-layer-group"></i> Bagian / Section:</label>' +
                '<input type="text" style="width: 100%; border: 1px solid #93c5fd; border-radius: 8px; padding: 6px 10px; font-size: 12.5px;" placeholder="Contoh: 1. Profil Responden" value="' + (q.Section ? q.Section.replace(/"/g, '&quot;') : '') + '" oninput="syncQuestionSection(' + qIdx + ', this.value)">' +
              '</div>' +
              '<div>' +
                '<label style="font-size: 11px; font-weight: 800; color: #1d4ed8; text-transform: uppercase; margin-bottom: 4px; display: block;"><i class="fa-solid fa-users-viewfinder"></i> Target Pengisi (Instrumen):</label>' +
                '<select style="width: 100%; border: 1px solid #93c5fd; border-radius: 8px; padding: 6px 10px; font-size: 12.5px;" onchange="syncQuestionInstrument(' + qIdx + ', this.value)">' +
                  '<option value="Semua" ' + (q.Instrumen === 'Semua' ? 'selected' : '') + '>Semua Responden (A, B, C, D)</option>' +
                  '<option value="A" ' + (q.Instrumen === 'A' ? 'selected' : '') + '>Instrumen A (Perusahaan / Pemberi Kerja)</option>' +
                  '<option value="B" ' + (q.Instrumen === 'B' ? 'selected' : '') + '>Instrumen B (Pencari Kerja & Lulusan)</option>' +
                  '<option value="C" ' + (q.Instrumen === 'C' ? 'selected' : '') + '>Instrumen C (Pemangku Kepentingan)</option>' +
                  '<option value="D" ' + (q.Instrumen === 'D' ? 'selected' : '') + '>Instrumen D (Siswa Kelas 12)</option>' +
                '</select>' +
              '</div>' +
            '</div>';
        }

        card.innerHTML += 
          multiFieldsHtml +
          '<input type="text" class="gform-q-title-input" placeholder="Tuliskan rumusan pertanyaan survei di sini..." value="' + (q.Pertanyaan ? q.Pertanyaan.replace(/"/g, '&quot;') : '') + '" oninput="syncQuestionTitle(' + qIdx + ', this.value)">' +
          '<input type="text" class="gform-q-desc-input" placeholder="Penjelasan / petunjuk pengisian bagi responden (opsional)..." value="' + (q.Deskripsi ? q.Deskripsi.replace(/"/g, '&quot;') : '') + '" oninput="syncQuestionDesc(' + qIdx + ', this.value)">' +
          typeSpecificHtml +
          '<div class="gform-card-footer">' +
            '<label class="gform-switch-lbl">' +
              '<span class="gform-switch">' +
                '<input type="checkbox" ' + (q.IsRequired ? 'checked' : '') + ' onchange="syncQuestionRequired(' + qIdx + ', this.checked)">' +
                '<span class="gform-slider"></span>' +
              '</span>' +
              '<span>Wajib Diisi (Required)</span>' +
            '</label>' +
            '<div style="font-size: 12px; color: #64748b; font-weight: 600;">' +
              '<i class="fa-solid fa-shield-halved"></i> Instrumen validasi otomatis' +
            '</div>' +
          '</div>';

        $container.append(card);
      });
    }

    // Builder sync functions
    window.syncQuestionSection = function(qIdx, val) {
      if (currentBuilderQuestions[qIdx]) currentBuilderQuestions[qIdx].Section = val;
    };
    window.syncQuestionInstrument = function(qIdx, val) {
      if (currentBuilderQuestions[qIdx]) currentBuilderQuestions[qIdx].Instrumen = val;
    };
    window.onBuilderTipeSurveiChange = function(val) {
      renderBuilderQuestions();
    };

    window.addNewQuestionCard = function() {
      currentBuilderQuestions.push({
        Pertanyaan: '',
        Deskripsi: '',
        Tipe: 'radio',
        IsRequired: 1,
        Section: '',
        Instrumen: 'Semua',
        OpsiPilihan: [
          { label: '', nilai: 4 },
          { label: '', nilai: 3 },
          { label: '', nilai: 2 },
          { label: '', nilai: 1 }
        ]
      });
      renderBuilderQuestions();
      $('html, body').animate({ scrollTop: $('#gformCard_' + (currentBuilderQuestions.length - 1)).offset().top - 90 }, 300);
    };

    window.changeQuestionType = function(qIdx, newType) {
      if (currentBuilderQuestions[qIdx]) {
        currentBuilderQuestions[qIdx].Tipe = newType;
        if ((newType === 'radio' || newType === 'checkbox' || newType === 'dropdown') && (!currentBuilderQuestions[qIdx].OpsiPilihan || currentBuilderQuestions[qIdx].OpsiPilihan.length === 0)) {
          currentBuilderQuestions[qIdx].OpsiPilihan = [
            { label: 'Sangat Baik', nilai: 4 },
            { label: 'Baik', nilai: 3 },
            { label: 'Kurang Baik', nilai: 2 },
            { label: 'Tidak Baik', nilai: 1 }
          ];
        }
        renderBuilderQuestions();
      }
    };

    window.syncQuestionTitle = function(qIdx, val) {
      if (currentBuilderQuestions[qIdx]) currentBuilderQuestions[qIdx].Pertanyaan = val;
    };

    window.syncQuestionDesc = function(qIdx, val) {
      if (currentBuilderQuestions[qIdx]) currentBuilderQuestions[qIdx].Deskripsi = val;
    };

    window.syncQuestionRequired = function(qIdx, isChecked) {
      if (currentBuilderQuestions[qIdx]) currentBuilderQuestions[qIdx].IsRequired = isChecked ? 1 : 0;
    };

    window.syncOptionLabel = function(qIdx, optIdx, val) {
      if (currentBuilderQuestions[qIdx] && currentBuilderQuestions[qIdx].OpsiPilihan[optIdx]) {
        currentBuilderQuestions[qIdx].OpsiPilihan[optIdx].label = val;
      }
    };

    window.syncOptionValue = function(qIdx, optIdx, val) {
      if (currentBuilderQuestions[qIdx] && currentBuilderQuestions[qIdx].OpsiPilihan[optIdx]) {
        currentBuilderQuestions[qIdx].OpsiPilihan[optIdx].nilai = parseFloat(val) || 0;
      }
    };

    window.addOptionToQuestion = function(qIdx) {
      if (currentBuilderQuestions[qIdx]) {
        if (!currentBuilderQuestions[qIdx].OpsiPilihan) currentBuilderQuestions[qIdx].OpsiPilihan = [];
        var nextNum = currentBuilderQuestions[qIdx].OpsiPilihan.length + 1;
        currentBuilderQuestions[qIdx].OpsiPilihan.push({
          label: 'Pilihan ' + nextNum,
          nilai: 1
        });
        renderBuilderQuestions();
      }
    };

    window.removeOptionFromQuestion = function(qIdx, optIdx) {
      if (currentBuilderQuestions[qIdx] && currentBuilderQuestions[qIdx].OpsiPilihan) {
        currentBuilderQuestions[qIdx].OpsiPilihan.splice(optIdx, 1);
        renderBuilderQuestions();
      }
    };

    window.applyPresetToQuestion = function(qIdx, presetName) {
      if (!currentBuilderQuestions[qIdx]) return;
      if (presetName === 'ikm') {
        currentBuilderQuestions[qIdx].OpsiPilihan = [
          { label: 'Sangat Baik / Sangat Puas', nilai: 4 },
          { label: 'Baik / Puas', nilai: 3 },
          { label: 'Kurang Baik / Kurang Puas', nilai: 2 },
          { label: 'Tidak Baik / Tidak Puas', nilai: 1 }
        ];
      } else if (presetName === 'likert') {
        currentBuilderQuestions[qIdx].OpsiPilihan = [
          { label: 'Sangat Setuju', nilai: 5 },
          { label: 'Setuju', nilai: 4 },
          { label: 'Ragu-ragu / Netral', nilai: 3 },
          { label: 'Tidak Setuju', nilai: 2 },
          { label: 'Sangat Tidak Setuju', nilai: 1 }
        ];
      } else if (presetName === 'binary') {
        currentBuilderQuestions[qIdx].OpsiPilihan = [
          { label: 'Ya / Sesuai', nilai: 100 },
          { label: 'Tidak / Belum Sesuai', nilai: 0 }
        ];
      }
      renderBuilderQuestions();
    };

    window.syncScaleConfig = function(qIdx, key, val) {
      if (!currentBuilderQuestions[qIdx]) return;
      if (key === 'min') currentBuilderQuestions[qIdx].ScaleMin = parseInt(val) || 1;
      if (key === 'max') currentBuilderQuestions[qIdx].ScaleMax = parseInt(val) || 5;
      if (key === 'minLabel') currentBuilderQuestions[qIdx].ScaleMinLabel = val;
      if (key === 'maxLabel') currentBuilderQuestions[qIdx].ScaleMaxLabel = val;
    };

    window.moveQuestion = function(qIdx, direction) {
      var targetIdx = qIdx + direction;
      if (targetIdx < 0 || targetIdx >= currentBuilderQuestions.length) return;
      var temp = currentBuilderQuestions[qIdx];
      currentBuilderQuestions[qIdx] = currentBuilderQuestions[targetIdx];
      currentBuilderQuestions[targetIdx] = temp;
      renderBuilderQuestions();
    };

    window.duplicateQuestion = function(qIdx) {
      var cloned = JSON.parse(JSON.stringify(currentBuilderQuestions[qIdx]));
      cloned.Pertanyaan += ' (Salinan)';
      currentBuilderQuestions.splice(qIdx + 1, 0, cloned);
      renderBuilderQuestions();
    };

    window.deleteQuestion = function(qIdx) {
      currentBuilderQuestions.splice(qIdx, 1);
      renderBuilderQuestions();
    };

    // Wilayah helper in Builder
    window.loadKabupatenBuilder = function(provKode) {
      var $kab = $('#builderKabupaten');
      $kab.html('<option value="">-- Memuat Kab/Kota... --</option>');
      if (!provKode) {
        $kab.html('<option value="">-- Pilih Kab/Kota --</option>');
        return;
      }

      $.get(BaseURL + 'IDE/get_wilayah_child', { parent: provKode, level: 'kabupaten' }, function(res) {
        $kab.html('<option value="">-- Pilih Kab/Kota --</option>');
        if (res && res.data) {
          res.data.forEach(function(row) {
            $kab.append('<option value="' + row.Kode + '" data-nama="' + row.Nama + '">' + row.Nama + '</option>');
          });
        }
      }, 'json');
    };

    window.syncDaerahSurveiText = function() {
      var $selectedKab = $('#builderKabupaten option:selected');
      if ($selectedKab.val()) {
        $('#builderDaerahText').val($selectedKab.data('nama') || $selectedKab.text());
      }
    };

    // Save Survey & Batch Questions
    window.saveSurveyBuilderData = function() {
      var judul = $.trim($('#builderJudul').val());
      if (!judul) {
        Swal.fire('Perhatian', 'Judul formulir survei wajib diisi.', 'warning');
        return;
      }

      if (currentBuilderQuestions.length === 0) {
        Swal.fire('Perhatian', 'Harap tambahkan minimal 1 butir pertanyaan.', 'warning');
        return;
      }

      var tipeSurvei = $('#builderTipeSurvei').val() || 'standar';
      var surveyData = {
        Id: parseInt($('#builderSurveyId').val()) || 0,
        Judul: judul,
        Deskripsi: $.trim($('#builderDeskripsi').val()),
        Lembaga: $.trim($('#builderLembaga').val()),
        TipeSurvei: tipeSurvei,
        InstrumenList: tipeSurvei === 'multi' ? 'A,B,C,D' : 'A',
        Jenis: $('#builderJenis').val(),
        Tahun: $('#builderTahun').val(),
        Status: $('#builderStatus').val(),
        DaerahSurvei: $.trim($('#builderDaerahText').val()),
        KodeWilayah: $('#builderKabupaten').val() || $('#builderProvinsi').val() || '',
        BannerImage: $('#builderBannerImage').val() || '',
        BannerColor: $('#builderBannerColor').val() || '#043168',
        EstimasiWaktu: '3 - 5 Menit'
      };

      var $btn = $('#btnSaveBuilder');
      var originalHtml = $btn.html();
      $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...');

      // Step 1: Save Survey Header
      $.ajax({
        url: BaseURL + 'IDE/save_survei_dinamis',
        type: 'POST',
        data: JSON.stringify(surveyData),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function(respSurvey) {
          if (respSurvey && respSurvey.status && respSurvey.survei_id) {
            var savedSurveiId = respSurvey.survei_id;

            // Step 2: Save Questions Batch
            var payloadQuestions = {
              SurveiId: savedSurveiId,
              Pertanyaan: currentBuilderQuestions
            };

            $.ajax({
              url: BaseURL + 'IDE/save_survei_pertanyaan_batch',
              type: 'POST',
              data: JSON.stringify(payloadQuestions),
              contentType: 'application/json; charset=utf-8',
              dataType: 'json',
              success: function(respQ) {
                $btn.prop('disabled', false).html(originalHtml);
                Swal.fire({
                  icon: 'success',
                  title: 'Formulir Survei Disimpan!',
                  text: 'Survei dan ' + currentBuilderQuestions.length + ' butir pertanyaan berhasil diperbarui.',
                  confirmButtonColor: '#043168'
                }).then(function() {
                  loadAllSurveys(savedSurveiId, 'katalog');
                  switchSurveyorTab('katalog');
                });
              },
              error: function() {
                $btn.prop('disabled', false).html(originalHtml);
                Swal.fire('Error', 'Gagal menyimpan butir pertanyaan survei.', 'error');
              }
            });

          } else {
            $btn.prop('disabled', false).html(originalHtml);
            Swal.fire('Gagal', respSurvey.message || 'Gagal menyimpan data induk survei.', 'error');
          }
        },
        error: function() {
          $btn.prop('disabled', false).html(originalHtml);
          Swal.fire('Error', 'Gagal terhubung ke server saat menyimpan survei.', 'error');
        }
      });
    };

    // Delete Survey
    window.handleDeleteSurvey = function(surveyId, surveyTitle) {
      if (userLevel === 5) {
        Swal.fire('Akses Ditolak', 'User role survei tidak memiliki hak akses untuk menghapus data.', 'error');
        return;
      }
      Swal.fire({
        title: 'Hapus Survei Ini?',
        text: 'Survei "' + surveyTitle + '" beserta seluruh pertanyaan dan data jawaban responden akan dihapus permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="fa-solid fa-trash-can"></i> Ya, Hapus Permanen',
        cancelButtonText: 'Batal'
      }).then(function(result) {
        if (result.isConfirmed) {
          $.ajax({
            url: BaseURL + 'IDE/delete_survei_dinamis/' + surveyId,
            type: 'POST',
            dataType: 'json',
            success: function(res) {
              if (res && res.status) {
                Swal.fire('Terhapus', 'Survei telah berhasil dihapus.', 'success');
                loadAllSurveys();
              } else {
                Swal.fire('Gagal', res.message || 'Gagal menghapus survei.', 'error');
              }
            },
            error: function() {
              Swal.fire('Error', 'Gagal terhubung ke server.', 'error');
            }
          });
        }
      });
    };

    // =========================================================================
    // MULTI-STEP SURVEY RESPONDENT ENGINE & CUSTOM BANNER
    // =========================================================================
    window.currentSurveyStep = 1;
    window.goToSurveyStep = function(step) {
      if (step === 2) {
        $('#surveyStep1').hide();
        $('#surveyStep2').show();
        $('#stepTabIndicator1').removeClass('active').addClass('completed');
        $('#stepTabIndicator2').addClass('active');
        $('.survey-respondent-box').animate({ scrollTop: 0 }, 150);
        window.currentSurveyStep = 2;
        updateRespondentProgress();
      } else {
        $('#surveyStep2').hide();
        $('#surveyStep1').show();
        $('#stepTabIndicator2').removeClass('active');
        $('#stepTabIndicator1').addClass('active');
        $('.survey-respondent-box').animate({ scrollTop: 0 }, 150);
        window.currentSurveyStep = 1;
        $('#surveyProgressText').text('Langkah 1 dari 2: Data Responden & Daerah Survei');
        $('#surveyProgressFill').css('width', '50%');
      }
    };

    window.openRespondentForm = function(surveyId, isDemo) {
      Swal.fire({
        title: 'Memuat Kuesioner...',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
      });

      $.ajax({
        url: BaseURL + 'IDE/get_survei_detail/' + surveyId,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
          Swal.close();
          if (res && res.status && res.survei) {
            currentRespondentSurvey = res.survei;
            currentRespondentQuestions = res.pertanyaan || [];

            // Reset isian responden menjadi kosong sebelum diisi
            if ($('#formRespondentSurvey').length && $('#formRespondentSurvey')[0].reset) {
              $('#formRespondentSurvey')[0].reset();
            }
            $('#respNamaResponden, #respKontak, #respUsia, #respGender, #respPendidikan, #respPekerjaan').val('');
            $('#respProvinsi').val('');
            $('#respKabupaten').html('<option value="">-- Pilih Kab/Kota --</option>');
            $('#respKecamatan').html('<option value="">-- Pilih Kecamatan --</option>');
            $('#respKelurahan').html('<option value="">-- Pilih Kelurahan/Desa --</option>');
            $('#respAlamatDetail').val('');

            // Deteksi apakah survei adalah RTKD Multi-Instrumen Dinamis (ID 4, multi, atau judul RTKD)
            var isMulti = (res.survei.TipeSurvei === 'multi') || (res.survei.InstrumenList && res.survei.InstrumenList.indexOf(',') !== -1) || (surveyId == 4) || (res.survei.Judul && res.survei.Judul.toLowerCase().indexOf('rtkd') !== -1);
            window.isCurrentRtkd = isMulti;

            // Inisialisasi Peta Geospasial Mini & Deteksi Koordinat GPS Responden (Hanya jika survei standar)
            if (!isMulti) {
              setTimeout(function() {
                if (typeof initRespondentMiniMap === 'function') {
                  initRespondentMiniMap(res.survei);
                }
              }, 150);
            }

            // Reset Step to Step 1
            goToSurveyStep(1);

            // Apply Google Forms Style Header Banner Image & Title Card (Sesuai Contoh)
            var bColor = res.survei.BannerColor || '#043168';
            var bImg = res.survei.BannerImage || 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=1200&q=80';
            if (bImg) {
              $('#modalRespBannerImg').css('background-image', 'url(' + bImg + ')').show();
              $('#modalRespBannerContainer').show();
            } else {
              $('#modalRespBannerImg').css('background-image', 'none').hide();
              $('#modalRespBannerContainer').hide();
            }

            // Header info & Meta Bullets (Google Forms Style)
            $('#respSurveiId').val(res.survei.Id);
            $('#modalRespJudul').text(res.survei.Judul + (isDemo ? ' [SIMULASI DEMO]' : ''));
            var deskripsiText = res.survei.Deskripsi || 'Silakan isi formulir ini secara jujur dan objektif.';
            $('#modalRespDeskripsi').text(deskripsiText);
            $('#modalRespLembagaText').text(res.survei.Lembaga || 'Dinas Tenaga Kerja, Transmigrasi dan Perindustrian Kab. Banyuwangi');
            $('#modalRespWaktuText').text(res.survei.EstimasiWaktu || '5 - 10 Menit');
            var daerahHeader = res.survei.DaerahSurvei || 'Kabupaten Banyuwangi';
            $('#modalRespDaerahText').text(daerahHeader);

            if (isMulti) {
              $('#modalGformSectionText').html('<i class="fa-solid fa-list-check"></i> Bagian 1 dari 4: Instrumen A &bull; Perusahaan');
            } else {
              $('#modalGformSectionText').html('<i class="fa-solid fa-id-card"></i> Bagian 1 dari 2: Identitas &amp; Daerah Survei');
            }

            // Pre-fill daerah spesifik
            $('#respAlamatDetail').val(res.survei.DaerahSurvei ? 'Unit Layanan ' + res.survei.DaerahSurvei : '');

            if (isMulti) {
              $('.survey-sticky-progress').hide();
              $('#surveyStep1, #surveyStep2').hide();
              $('#surveyStepRtkd').show();
              // Hanya load skema dari DB jika survei multi baru selain RTKD master (ID 4)
              if (surveyId != 4 && window.RTKDEngine && res.pertanyaan && res.pertanyaan.length > 0) {
                var hasInstruments = res.pertanyaan.some(function(q) { return q.Instrumen && q.Instrumen !== 'Semua'; });
                if (hasInstruments) {
                  window.RTKDEngine.loadSchemaFromDb(res.pertanyaan);
                }
              }
              switchModalRtkdTab('A');
            } else {
              $('#surveyStepRtkd').hide();
              $('.survey-sticky-progress').show();
              goToSurveyStep(1);
              // Render questions in respondent form
              renderRespondentQuestions(currentRespondentQuestions);
              updateRespondentProgress();
            }

            // Open modal
            $('#surveyRespondentModal').addClass('active');
            $('body').css('overflow', 'hidden');

            // Jalankan deteksi perangkat dan koordinat lokasi GPS secara otomatis
            setTimeout(function() {
              if (typeof detectRespondentDeviceLocation === 'function') {
                detectRespondentDeviceLocation(false);
              }
            }, 100);
          } else {
            Swal.fire('Error', res.message || 'Kuesioner tidak ditemukan.', 'error');
          }
        },
        error: function() {
          Swal.close();
          Swal.fire('Error', 'Gagal memuat kuesioner survei.', 'error');
        }
      });
    };

    window.closeSurveyRespondentModal = function() {
      $('#surveyRespondentModal').removeClass('active');
      $('body').css('overflow', '');
      if (typeof clearRtkdPhoto === 'function') {
        clearRtkdPhoto();
      }
    };

    window.toggleSurveyDescription = function() {
      var box = $('#surveyRespDescBox');
      var btn = $('#btnToggleDesc');
      if (box.hasClass('collapsed')) {
        box.removeClass('collapsed').addClass('expanded');
        btn.attr('aria-expanded', 'true');
        btn.find('.btn-toggle-txt').text('Tampilkan Ringkas');
      } else {
        box.removeClass('expanded').addClass('collapsed');
        btn.attr('aria-expanded', 'false');
        btn.find('.btn-toggle-txt').text('Selengkapnya');
      }
    };

    // =========================================================================
    // RTKD DYNAMIC MULTI-INSTRUMENT HELPERS (MODAL PUBLIK)
    // =========================================================================
    window.modalRtkdActiveInstrument = 'A';
    window.switchModalRtkdTab = function(tabKey) {
      window.modalRtkdActiveInstrument = tabKey;
      $('#modalRtkdActiveInstrument').val(tabKey);
      $('.rtkd-tabs .rtkd-tab-btn').removeClass('active').attr('aria-selected', 'false');
      $('#modalRtkdTab-' + tabKey).addClass('active').attr('aria-selected', 'true');


      // Sync Section Badge (Persis seperti 'Section 1 of 3' di contoh)
      var sectionLabels = {
        'A': '<i class="fa-solid fa-industry"></i> Bagian 1 dari 5: Instrumen A &bull; Perusahaan &amp; Industri',
        'B': '<i class="fa-solid fa-user-graduate"></i> Bagian 2 dari 5: Instrumen B &bull; Pencari Kerja &amp; Alumni',
        'C': '<i class="fa-solid fa-handshake-angle"></i> Bagian 3 dari 5: Instrumen C &bull; Stakeholder Vokasi',
        'E': '<i class="fa-solid fa-scale-balanced"></i> Bagian 4 dari 5: Instrumen C2 &bull; Prioritas Isu Strategis (AHP)',
        'D': '<i class="fa-solid fa-graduation-cap"></i> Bagian 5 dari 5: Instrumen D &bull; Siswa Kelas 12'
      };
      if (sectionLabels[tabKey]) {
        $('#modalGformSectionText').html(sectionLabels[tabKey]);
      }

      window.ahpAckCr = false;
      if (tabKey === 'E') {
        $('#btnDemoAhpModal').show();
      } else {
        $('#btnDemoAhpModal').hide();
      }

      if (window.RTKDEngine) {
        window.RTKDEngine.render('modalRtkdSheet', tabKey);
      }

      // Pulihkan draft jika ada yang tersimpan di memori perangkat untuk instrumen ini
      if (window.SurveiOfflineManager) {
        window.SurveiOfflineManager.restoreDraft(parseInt($('#respSurveiId').val()) || 4, tabKey);
      }
    };

    window.resetModalRtkdForm = function() {
      Swal.fire({
        title: 'Kosongkan Formulir?',
        text: 'Seluruh isian instrumen aktif dan foto dokumentasi akan dibersihkan.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#043168',
        confirmButtonText: 'Ya, Kosongkan',
        cancelButtonText: 'Batal'
      }).then(function(result) {
        if (result.isConfirmed) {
          if (typeof clearRtkdPhoto === 'function') {
            clearRtkdPhoto();
          }
          if (window.RTKDEngine) {
            window.RTKDEngine.render('modalRtkdSheet', window.modalRtkdActiveInstrument || 'A');
          }
          if (window.SurveiOfflineManager) {
            window.SurveiOfflineManager.clearDraft(parseInt($('#respSurveiId').val()) || 4, window.modalRtkdActiveInstrument || 'A');
          }
        }
      });
    };

    window.saveSurveyOfflineDirect = function() {
      $('#chkForceOfflineMode').prop('checked', true).trigger('change');
      var form = document.getElementById('formSurveyRespondent');
      if (form) {
        if (typeof form.requestSubmit === 'function') {
          form.requestSubmit();
        } else {
          $('#formSurveyRespondent').trigger('submit');
        }
      }
    };

    window.toggleForceOfflineMode = function(el) {
      var isChecked = $(el).is(':checked');
      if (isChecked) {
        $('#toggleOfflineModeWrap').addClass('active');
        $('#offlineModeNote').html('<i class="fa-solid fa-plane-slash text-warning"></i> Mode Lapangan aktif: Data langsung disimpan ke antrean offline');
      } else {
        $('#toggleOfflineModeWrap').removeClass('active');
        $('#offlineModeNote').html('<i class="fa-solid fa-shield-halved text-success"></i> Antrean offline aktif &bull; Mendukung banyak data');
      }
    };

    // =========================================================================
    // DOKUMENTASI FOTO SURVEI RTKD (KAMERA HP SURVEIYOR & UPLOAD)
    // =========================================================================
    window.handleRtkdPhotoCaptured = function(inputEl) {
      if (!inputEl.files || !inputEl.files[0]) return;
      var file = inputEl.files[0];

      // Tampilkan indikator proses
      Swal.fire({
        title: 'Memproses Foto Kamera...',
        html: '<div style="font-size:13px; color:#475569; padding: 6px 0;"><i class="fa-solid fa-spinner fa-spin mr-2"></i> Mengoptimalkan foto dan menyematkan geotag survei lapangan...</div>',
        allowOutsideClick: false,
        didOpen: function() {
          Swal.showLoading();
        }
      });

      var reader = new FileReader();
      reader.onload = function(e) {
        var img = new Image();
        img.onload = function() {
          try {
            var canvas = document.createElement('canvas');
            var maxDim = 1280;
            var width = img.width;
            var height = img.height;

            if (width > height) {
              if (width > maxDim) {
                height = Math.round(height * (maxDim / width));
                width = maxDim;
              }
            } else {
              if (height > maxDim) {
                width = Math.round(width * (maxDim / height));
                height = maxDim;
              }
            }

            canvas.width = width;
            canvas.height = height;
            var ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, width, height);

            // Watermark Banner profesional di bagian bawah foto
            var bannerHeight = Math.max(56, Math.round(height * 0.11));
            ctx.fillStyle = 'rgba(4, 49, 104, 0.88)'; // Deep Navy IDE
            ctx.fillRect(0, height - bannerHeight, width, bannerHeight);

            // Aksen garis merah di batas kiri watermark
            ctx.fillStyle = '#b40814'; // Lugx Red
            ctx.fillRect(0, height - bannerHeight, 8, bannerHeight);

            // Informasi Metadata Watermark
            var surveyor = $.trim($('#respEnumerator').val()) || 'Surveiyor Lapangan';
            var inst = window.modalRtkdActiveInstrument || $('#modalRtkdActiveInstrument').val() || 'A';
            var instNames = {
              'A': 'Instrumen A - Perusahaan / Pemberi Kerja',
              'B': 'Instrumen B - Pencari Kerja & Lulusan',
              'C': 'Instrumen C - Pemangku Kepentingan',
              'E': 'Instrumen E - AHP Isu Strategis',
              'D': 'Instrumen D - Siswa Kelas 12'
            };
            var instLabel = instNames[inst] || ('Instrumen ' + inst);

            var now = new Date();
            var dateStr = now.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
            var timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) + ' WIB';

            var lat = $('#respLatitude').val();
            var lng = $('#respLongitude').val();
            var realKec = $('#respRealKecamatan').val();
            var locStr = realKec ? ('Kec. ' + realKec) : 'Kabupaten Banyuwangi';
            if (lat && lng) {
              locStr += ' (' + parseFloat(lat).toFixed(5) + ', ' + parseFloat(lng).toFixed(5) + ')';
            }

            var fontSizeTitle = Math.max(12, Math.round(bannerHeight * 0.28));
            var fontSizeSub = Math.max(10, Math.round(bannerHeight * 0.22));

            ctx.font = 'bold ' + fontSizeTitle + 'px sans-serif';
            ctx.fillStyle = '#ffffff';
            ctx.fillText('SURVEI RTKD BANYUWANGI 2026 • ' + instLabel, 18, height - (bannerHeight * 0.55));

            ctx.font = fontSizeSub + 'px sans-serif';
            ctx.fillStyle = '#cbd5e1';
            ctx.fillText('Petugas: ' + surveyor + ' | ' + locStr + ' | ' + dateStr + ' ' + timeStr, 18, height - (bannerHeight * 0.2));

            // Kompresi kualitas JPEG 0.82
            var dataUrl = canvas.toDataURL('image/jpeg', 0.82);
            var sizeKb = Math.round((dataUrl.length * 3 / 4) / 1024);

            $('#respFotoDokumentasi').val(dataUrl);
            $('#rtkdPhotoPreviewImg').attr('src', dataUrl);
            $('#rtkdPhotoSizeInfo').text(width + ' × ' + height + ' px • ' + sizeKb + ' KB (Terkompresi Cepat)');
            $('#rtkdPhotoTimeInfo').text(dateStr + ' ' + timeStr);
            $('#rtkdPhotoGeoInfo').text(locStr);

            $('#rtkdPhotoPreviewWrap').show();
            $('#rtkdPhotoBtnBar').hide();

            Swal.close();
          } catch (err) {
            console.error('Error watermarking image:', err);
            $('#respFotoDokumentasi').val(e.target.result);
            $('#rtkdPhotoPreviewImg').attr('src', e.target.result);
            $('#rtkdPhotoPreviewWrap').show();
            $('#rtkdPhotoBtnBar').hide();
            Swal.close();
          }
        };
        img.src = e.target.result;
      };
      reader.readAsDataURL(file);
    };

    window.clearRtkdPhoto = function() {
      $('#respFotoDokumentasi').val('');
      $('#rtkdPhotoPreviewImg').attr('src', '');
      $('#rtkdCameraInput').val('');
      $('#rtkdGalleryInput').val('');
      $('#rtkdPhotoPreviewWrap').hide();
      $('#rtkdPhotoBtnBar').show();
    };

    window.previewRtkdPhotoFull = function() {
      var photoSrc = $('#respFotoDokumentasi').val() || $('#rtkdPhotoPreviewImg').attr('src');
      if (!photoSrc) return;

      Swal.fire({
        title: 'Foto Dokumentasi Survei',
        html: '<div style="text-align:center; padding: 10px 0;"><img src="' + photoSrc + '" style="max-width:100%; max-height:70vh; border-radius:12px; box-shadow: 0 4px 20px rgba(0,0,0,0.15);"></div>',
        width: 'auto',
        showCloseButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> Tutup',
        confirmButtonColor: '#043168'
      });
    };

    // Real-time conditional show/hide dan update konsistensi AHP untuk RTKD Modal
    $(document).on('input change', '#modalRtkdSheet input, #modalRtkdSheet select, #modalRtkdSheet textarea', function() {
      if (window.isCurrentRtkd && window.RTKDEngine) {
        var activeInst = window.modalRtkdActiveInstrument || 'A';
        window.RTKDEngine.applyShow('modalRtkdSheet', activeInst);
        if (activeInst === 'E') {
          window.RTKDEngine.updateCR('modalRtkdSheet', 'E');
        }
      }
    });

    // Render questions inside respondent form
    function renderRespondentQuestions(questions) {
      var $container = $('#respQuestionsList');
      $container.empty();

      if (questions.length === 0) {
        $container.html('<div style="text-align:center; padding: 30px; color: #64748b;">Belum ada butir pertanyaan untuk kuesioner ini.</div>');
        return;
      }

      var lastSection = null;
      questions.forEach(function(q, qIdx) {
        // Render Section Card Header jika berganti bagian (Section)
        if (q.Section && q.Section !== lastSection) {
          lastSection = q.Section;
          var secBadge = q.Section.indexOf('.') !== -1 ? q.Section.split('.')[0] : 'BAGIAN';
          var secCard = document.createElement('div');
          secCard.className = 'survey-section-break-card';
          secCard.style = 'background: linear-gradient(135deg, #043168 0%, #0d3d7c 100%); color: #ffffff; border-radius: 14px; padding: 18px 22px; margin: 24px 0 14px 0; box-shadow: 0 4px 14px rgba(4,49,104,0.18); display: flex; align-items: center; justify-content: space-between;';
          secCard.innerHTML = 
            '<div>' +
              '<div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: rgba(255,255,255,0.7); font-weight: 700; margin-bottom: 2px;"><i class="fa-solid fa-layer-group"></i> Bagian Kuesioner</div>' +
              '<h3 style="margin: 0; font-size: 17px; font-weight: 800; color: #ffffff;">' + q.Section + '</h3>' +
            '</div>' +
            '<span style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25); color: #fff; font-size: 11.5px; font-weight: 700; padding: 4px 12px; border-radius: 20px;">' + secBadge + '</span>';
          $container.append(secCard);
        }

        var card = document.createElement('div');
        card.className = 'resp-q-card';
        card.id = 'respQCard_' + q.Id;

        var requiredStar = parseInt(q.IsRequired) === 1 ? '<span class="resp-q-required" title="Wajib Diisi">*</span>' : '';
        var descHtml = q.Deskripsi ? '<div class="resp-q-desc">' + q.Deskripsi + '</div>' : '';

        var inputBodyHtml = '';

        if (q.Tipe === 'radio') {
          var optionsHtml = '';
          var optList = q.OpsiPilihanList || [];
          optList.forEach(function(opt, oIdx) {
            var optValSafe = opt.label ? opt.label.replace(/"/g, '&quot;') : '';
            optionsHtml += 
              '<label class="resp-opt-label" onclick="selectRadioOption(' + q.Id + ', this)">' +
                '<input type="radio" class="resp-opt-radio" name="Jawaban[' + q.Id + ']" value="' + optValSafe + '" onchange="updateRespondentProgress()">' +
                '<span class="resp-opt-text">' + optValSafe + '</span>' +
              '</label>';
          });
          inputBodyHtml = '<div class="resp-options-list">' + optionsHtml + '</div>';

        } else if (q.Tipe === 'checkbox') {
          var optionsHtml = '';
          var optList = q.OpsiPilihanList || [];
          optList.forEach(function(opt, oIdx) {
            var optValSafe = opt.label ? opt.label.replace(/"/g, '&quot;') : '';
            optionsHtml += 
              '<label class="resp-opt-label" onclick="toggleCheckboxOption(this)">' +
                '<input type="checkbox" class="resp-opt-checkbox" name="Jawaban[' + q.Id + '][]" value="' + optValSafe + '" onchange="updateRespondentProgress()">' +
                '<span class="resp-opt-text">' + optValSafe + '</span>' +
              '</label>';
          });
          inputBodyHtml = '<div class="resp-options-list">' + optionsHtml + '</div>';

        } else if (q.Tipe === 'dropdown') {
          var optionsHtml = '<option value="">-- Pilih Jawaban Anda --</option>';
          var optList = q.OpsiPilihanList || [];
          optList.forEach(function(opt) {
            var optValSafe = opt.label ? opt.label.replace(/"/g, '&quot;') : '';
            optionsHtml += '<option value="' + optValSafe + '">' + optValSafe + '</option>';
          });
          inputBodyHtml = 
            '<select name="Jawaban[' + q.Id + ']" class="resp-field" style="width: 100%; height: 44px; border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0 14px; font-size: 14px;" onchange="updateRespondentProgress()">' +
              optionsHtml +
            '</select>';

        } else if (q.Tipe === 'scale') {
          var minVal = parseInt(q.ScaleMin) || 1;
          var maxVal = parseInt(q.ScaleMax) || 5;
          var scaleButtonsHtml = '';

          for (var i = minVal; i <= maxVal; i++) {
            scaleButtonsHtml += 
              '<button type="button" class="btn-scale-choice" onclick="selectScaleChoice(' + q.Id + ', ' + i + ', this)">' +
                i +
              '</button>';
          }

          inputBodyHtml = 
            '<div class="resp-scale-box">' +
              '<input type="hidden" name="Jawaban[' + q.Id + ']" id="respScaleInput_' + q.Id + '" value="">' +
              '<div class="resp-scale-buttons">' + scaleButtonsHtml + '</div>' +
              '<div class="resp-scale-labels">' +
                '<span>' + (q.ScaleMinLabel || 'Sangat Tidak Baik') + '</span>' +
                '<span>' + (q.ScaleMaxLabel || 'Sangat Baik') + '</span>' +
              '</div>' +
            '</div>';

        } else if (q.Tipe === 'textarea') {
          inputBodyHtml = 
            '<textarea name="Jawaban[' + q.Id + ']" rows="3" class="resp-field" style="width: 100%; border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 12px 14px; font-size: 14px; font-family: inherit; resize: vertical;" placeholder="Tuliskan ulasan, pendapat, atau masukan Anda secara jelas..." oninput="updateRespondentProgress()"></textarea>';
        } else {
          // text or number
          var inputType = (q.Tipe === 'number' ? 'number' : 'text');
          inputBodyHtml = 
            '<input type="' + inputType + '" name="Jawaban[' + q.Id + ']" class="resp-field" style="width: 100%; height: 44px; border-radius: 12px; border: 1.5px solid #cbd5e1; padding: 0 14px; font-size: 14px; font-family: inherit;" placeholder="Tuliskan jawaban Anda di sini..." oninput="updateRespondentProgress()">';
        }

        card.innerHTML = 
          '<div class="resp-q-header">' +
            '<span class="resp-q-badge">Pertanyaan ' + (qIdx + 1) + '</span>' +
            '<div class="resp-q-title">' + q.Pertanyaan + requiredStar + '</div>' +
          '</div>' +
          descHtml +
          inputBodyHtml;

        $container.append(card);
      });
    }

    // Respondent interactive selection helpers
    window.selectRadioOption = function(qId, labelElem) {
      $('#respQCard_' + qId + ' .resp-opt-label').removeClass('selected');
      $(labelElem).addClass('selected');
      $(labelElem).find('input[type="radio"]').prop('checked', true);
      $('#respQCard_' + qId).addClass('answered');
      updateRespondentProgress();
    };

    window.toggleCheckboxOption = function(labelElem) {
      setTimeout(function() {
        var $chk = $(labelElem).find('input[type="checkbox"]');
        if ($chk.is(':checked')) {
          $(labelElem).addClass('selected');
        } else {
          $(labelElem).removeClass('selected');
        }
        updateRespondentProgress();
      }, 50);
    };

    window.selectScaleChoice = function(qId, val, btnElem) {
      $('#respQCard_' + qId + ' .btn-scale-choice').removeClass('selected');
      $(btnElem).addClass('selected');
      $('#respScaleInput_' + qId).val(val);
      $('#respQCard_' + qId).addClass('answered');
      updateRespondentProgress();
    };

    // Cascading dropdown wilayah untuk Keterangan Daerah Survei
    window.handleWilayahChange = function(level, code) {
      if (level === 'provinsi') {
        $('#respKabupaten').html('<option value="">-- Memuat Kab/Kota... --</option>');
        $('#respKecamatan').html('<option value="">-- Pilih Kecamatan --</option>');
        $('#respDesa').html('<option value="">-- Pilih Desa/Kel --</option>');

        if (!code) {
          $('#respKabupaten').html('<option value="">-- Pilih Kab/Kota --</option>');
          return;
        }

        $.get(BaseURL + 'IDE/get_wilayah_child', { parent: code, level: 'kabupaten' }, function(res) {
          $('#respKabupaten').html('<option value="">-- Pilih Kab/Kota --</option>');
          if (res && res.data) {
            res.data.forEach(function(row) {
              $('#respKabupaten').append('<option value="' + row.Nama + '" data-kode="' + row.Kode + '">' + row.Nama + '</option>');
            });
          }
        }, 'json');

      } else if (level === 'kabupaten') {
        var selectedKode = $('#respKabupaten option:selected').data('kode');
        $('#respKecamatan').html('<option value="">-- Memuat Kecamatan... --</option>');
        $('#respDesa').html('<option value="">-- Pilih Desa/Kel --</option>');

        if (!selectedKode) {
          $('#respKecamatan').html('<option value="">-- Pilih Kecamatan --</option>');
          return;
        }

        $.get(BaseURL + 'IDE/get_wilayah_child', { parent: selectedKode, level: 'kecamatan' }, function(res) {
          $('#respKecamatan').html('<option value="">-- Pilih Kecamatan --</option>');
          if (res && res.data) {
            res.data.forEach(function(row) {
              $('#respKecamatan').append('<option value="' + row.Nama + '" data-kode="' + row.Kode + '">' + row.Nama + '</option>');
            });
          }
        }, 'json');

      } else if (level === 'kecamatan') {
        var selectedKode = $('#respKecamatan option:selected').data('kode');
        $('#respDesa').html('<option value="">-- Memuat Desa... --</option>');

        if (!selectedKode) {
          $('#respDesa').html('<option value="">-- Pilih Desa/Kel --</option>');
          return;
        }

        $.get(BaseURL + 'IDE/get_wilayah_child', { parent: selectedKode, level: 'desa' }, function(res) {
          $('#respDesa').html('<option value="">-- Pilih Desa/Kel --</option>');
          if (res && res.data) {
            res.data.forEach(function(row) {
              $('#respDesa').append('<option value="' + row.Nama + '">' + row.Nama + '</option>');
            });
          }
        }, 'json');
      }
    };

    // Calculate real-time questionnaire progress
    function updateRespondentProgress() {
      if (!currentRespondentQuestions || currentRespondentQuestions.length === 0) return;
      var totalQ = currentRespondentQuestions.length;
      var answeredCount = 0;

      currentRespondentQuestions.forEach(function(q) {
        var answered = false;
        if (q.Tipe === 'radio') {
          answered = $('input[name="Jawaban[' + q.Id + ']"]:checked').length > 0;
        } else if (q.Tipe === 'checkbox') {
          answered = $('input[name="Jawaban[' + q.Id + '][]"]:checked').length > 0;
        } else if (q.Tipe === 'scale') {
          var v = $('#respScaleInput_' + q.Id).val();
          answered = (v !== '' && v !== undefined && v !== null);
        } else {
          var v = $.trim($('[name="Jawaban[' + q.Id + ']"]').val());
          answered = (v !== '');
        }

        if (answered) {
          answeredCount++;
          $('#respQCard_' + q.Id).addClass('answered');
        } else {
          $('#respQCard_' + q.Id).removeClass('answered');
        }
      });

      var pct = Math.round((answeredCount / totalQ) * 100);
      if (window.currentSurveyStep === 2) {
        var overallPct = Math.max(50, Math.round(50 + (pct / 2)));
        $('#surveyProgressFill').css('width', overallPct + '%');
        $('#surveyProgressText').text('Langkah 2/2: ' + answeredCount + ' dari ' + totalQ + ' Terjawab (' + pct + '%)');
      } else {
        $('#surveyProgressFill').css('width', '50%');
        $('#surveyProgressText').text('Langkah 1 dari 2: Data Responden & Daerah Survei');
      }
    }

    // Submit Respondent Form
    window.handleSurveyRespondentSubmit = function(e) {
      e.preventDefault();

      // =======================================================================
      // CABANG KHUSUS: SURVEI RTKD DINAMIS 4 INSTRUMEN
      // =======================================================================
      if (window.isCurrentRtkd) {
        if (!$('#modalRespConsent').is(':checked')) {
          Swal.fire('Persetujuan Responden', 'Harap centang persetujuan responden terlebih dahulu.', 'warning');
          $('#modalRespConsent').focus();
          return;
        }

        var enumerator = $.trim($('#respEnumerator').val());
        if (!enumerator) {
          Swal.fire('Nama Enumerator', 'Harap isi nama enumerator petugas pencatat terlebih dahulu.', 'warning');
          $('#respEnumerator').focus();
          return;
        }

        var inst = window.modalRtkdActiveInstrument || $('#modalRtkdActiveInstrument').val() || 'A';
        var answers = window.RTKDEngine ? window.RTKDEngine.collect('formSurveyRespondent', inst) : {};

        // Validasi kriteria penyaring Instrumen B
        if (inst === 'B' && Array.isArray(answers.SC)) {
          if (answers.SC.indexOf('Tidak satu pun') !== -1 && answers.SC.length > 1) {
            Swal.fire('Kriteria Penyaring (SC)', 'Pada butir SC, "Tidak satu pun" tidak bisa dipilih bersama kriteria lain. Silakan perbaiki jawaban Anda.', 'warning');
            return;
          }
        }

        // Validasi pertanyaan wajib dan beri highlight visual pada butir yang kosong
        if (window.RTKDEngine && !window.bypassValidationForOffline) {
          var valRes = window.RTKDEngine.validateAndHighlight('modalRtkdSheet', inst, '', answers);
          if (!valRes.isValid) {
            var isForceOffline = $('#chkForceOfflineMode').is(':checked');
            if (isForceOffline || !navigator.onLine) {
              Swal.fire({
                icon: 'question',
                title: 'Simpan ke Antrean Offline?',
                html: 'Terdapat <b>' + valRes.count + ' butir pertanyaan</b> yang belum terisi.<br><br>Apakah Anda ingin <b>tetap menyimpan ke antrean offline</b> sekarang atau melengkapi butir pertanyaan terlebih dahulu?',
                showCancelButton: true,
                confirmButtonColor: '#043168',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="fa-solid fa-cloud-arrow-down"></i> Tetap Simpan ke Antrean Offline',
                cancelButtonText: '<i class="fa-solid fa-pen-to-square"></i> Lengkapi Sekarang'
              }).then(function(result) {
                if (result.isConfirmed) {
                  window.bypassValidationForOffline = true;
                  $('#formSurveyRespondent').trigger('submit');
                } else {
                  window.RTKDEngine.scrollToFirstUnanswered(valRes.firstElement, '#surveyRespondentModal .modal-body');
                }
              });
              return;
            }

            $('#modalRtkdStatus').html('<span style="color:#dc2626; font-weight:700;"><i class="fa-solid fa-triangle-exclamation"></i> ' + valRes.count + ' butir pertanyaan belum terisi</span>');
            Swal.fire({
              icon: 'warning',
              title: 'Ada Jawaban Belum Terisi (' + valRes.count + ' Butir) ⚠️',
              html: 
                '<div style="text-align: left; padding: 4px 0;">' +
                  '<div style="background: #fef2f2; border: 1.5px solid #fecaca; border-radius: 12px; padding: 12px 14px; margin-bottom: 14px; color: #991b1b; font-size: 13.5px; line-height: 1.5;">' +
                    '<i class="fa-solid fa-triangle-exclamation" style="font-size: 16px; margin-right: 6px; color: #dc2626;"></i>' +
                    'Terdapat <b>' + valRes.count + ' pertanyaan wajib</b> yang belum Anda jawab. Setiap butir pertanyaan yang belum diisi telah <b>ditandai dengan bingkai merah</b> pada formulir di bawah.' +
                  '</div>' +
                  '<div style="font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 8px;"><i class="fa-solid fa-list-ul mr-1"></i> Rincian butir yang belum terisi:</div>' +
                  '<ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #475569; max-height: 180px; overflow-y: auto; line-height: 1.6;">' +
                    valRes.missingList.slice(0, 10).map(function(m) { return '<li style="margin-bottom: 4px;"><span style="color:#b91c1c; font-weight:800;">' + m.code + '</span>: ' + m.label + '</li>'; }).join('') +
                    (valRes.missingList.length > 10 ? '<li style="color: #dc2626; font-weight: 700; margin-top: 4px;">...dan ' + (valRes.missingList.length - 10) + ' butir pertanyaan lainnya</li>' : '') +
                  '</ul>' +
                '</div>',
              confirmButtonText: '<i class="fa-solid fa-arrow-down-long"></i> Tunjukkan &amp; Lengkapi Sekarang',
              confirmButtonColor: '#043168'
            }).then(function() {
              window.RTKDEngine.scrollToFirstUnanswered(valRes.firstElement, '#surveyRespondentModal .modal-body');
            });
            return;
          }
        }
        window.bypassValidationForOffline = false;

        // Update skor prioritas AHP untuk Instrumen E
        if (inst === 'E' && window.RTKDEngine) {
          window.RTKDEngine.updateCR('modalRtkdSheet', 'E');
        }

        var respNama = (inst === 'E' ? (answers.S2 || answers.S1 || 'Narasumber AHP') : (answers.P1 || answers.S2 || answers.K2 || (inst === 'B' ? 'Pencari Kerja / Lulusan' : 'Responden ' + inst)));
        var realKec = $('#respRealKecamatan').val();
        var realKab = $('#respRealKabupaten').val();
        var kec = realKec || answers.P2 || answers.L3 || answers.K3 || answers.K7 || 'Banyuwangi';
        var kab = realKab || 'Kabupaten Banyuwangi';

        var payload = {
          SurveiId: parseInt($('#respSurveiId').val()) || 4,
          Instrumen: inst,
          Enumerator: enumerator,
          RespondenNama: respNama,
          RespondenGender: answers.L2 || answers.K6 || 'Lainnya',
          RespondenUsia: answers.L1 || answers.K5 || (inst === 'E' ? 'Dewasa / Ahli' : ''),
          RespondenPendidikan: answers.L4 || (inst === 'D' ? 'Kelas 12' : (inst === 'E' ? 'Sarjana / Ahli' : '')),
          RespondenPekerjaan: (inst === 'A' ? 'Pemberi Kerja / Pelaku Usaha' : (inst === 'B' ? (answers.L7 || 'Pencari Kerja') : (inst === 'C' ? 'Pemangku Kepentingan' : (inst === 'E' ? (answers.S1 || 'Pakar / Stakeholder AHP') : 'Siswa Kelas 12')))),
          Provinsi: 'Jawa Timur',
          Kabupaten: kab,
          Kecamatan: kec,
          RealKecamatan: realKec || '',
          RealKabupaten: realKab || '',
          Desa: '',
          AlamatDetail: 'Lokasi: ' + (answers.SR2 || kec),
          Latitude: $('#respLatitude').val() || null,
          Longitude: $('#respLongitude').val() || null,
          LokasiAccuracy: $('#respLokasiAccuracy').val() || null,
          DevicePlatform: $('#respDevicePlatform').val() || 'Desktop Browser',
          FotoDokumentasi: $('#respFotoDokumentasi').val() || null,
          CreatedAt: new Date().toISOString(),
          waktu_pengisian: new Date().toISOString(),
          Jawaban: answers
        };

        var $btn = $('#btnSubmitModalRtkd');
        var origHtml = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan Jawaban...');

        // Jika perangkat sedang offline / tanpa sinyal internet, ATAU mode offline lapangan aktif
        var isForceOffline = $('#chkForceOfflineMode').is(':checked');
        if (!navigator.onLine || isForceOffline) {
          $btn.prop('disabled', false).html(origHtml);
          if (window.SurveiOfflineManager) {
            window.SurveiOfflineManager.enqueueOffline(payload, inst, 'formSurveyRespondent');
          } else {
            Swal.fire('Offline', 'Tidak ada koneksi internet. Silakan coba kembali saat terhubung.', 'warning');
          }
          return;
        }

        $.ajax({
          url: BaseURL + 'IDE/submit_jawaban_survei',
          type: 'POST',
          data: JSON.stringify(payload),
          contentType: 'application/json; charset=utf-8',
          dataType: 'json',
          timeout: 12000,
          success: function(res) {
            $btn.prop('disabled', false).html(origHtml);
            if (res && res.status) {
              if (window.SurveiOfflineManager) {
                window.SurveiOfflineManager.clearDraft(payload.SurveiId, inst);
              }
              closeSurveyRespondentModal();
              Swal.fire({
                icon: 'success',
                title: 'Jawaban Survei Disimpan!',
                html: 
                  '<div style="text-align: center; padding: 10px 0;">' +
                    '<p style="font-size: 14px; color: #475569; margin-bottom: 14px;">Terima kasih atas partisipasi pengisian formulir Survei Ketenagakerjaan Banyuwangi (Instrumen ' + inst + ').</p>' +
                    '<div style="background: #f0fdf4; border: 1.5px solid #a7f3d0; border-radius: 14px; padding: 14px; margin-bottom: 12px;">' +
                      '<div style="font-size: 11.5px; font-weight: 800; color: #059669; text-transform: uppercase;">Instrumen Tersimpan:</div>' +
                      '<div style="font-size: 24px; font-weight: 800; color: #047857; margin: 3px 0;">Instrumen ' + inst + '</div>' +
                      '<div style="font-size: 13px; font-weight: 700; color: #065f46;">Mutu Layanan: <b>' + (res.mutu_pelayanan || 'Baik') + '</b> (Skor: ' + (res.rata_rata_skor || '-') + ')</div>' +
                    '</div>' +
                    '<div style="font-size: 12.5px; color: #64748b;"><i class="fa-solid fa-location-dot" style="color: var(--lugx-red);"></i> Wilayah Tercatat: <b>' + (res.daerah_survei || kec) + '</b></div>' +
                  '</div>',
                confirmButtonText: '<i class="fa-solid fa-check"></i> Selesai',
                confirmButtonColor: '#043168'
              });
              loadAllSurveys();
            } else {
              Swal.fire('Gagal', res.message || 'Gagal menyimpan survei.', 'error');
            }
          },
          error: function(xhr, status, error) {
            $btn.prop('disabled', false).html(origHtml);
            // Jika request gagal akibat jaringan terputus / timeout di tengah jalan
            if (!navigator.onLine || status === 'timeout' || xhr.status === 0 || status === 'error') {
              if (window.SurveiOfflineManager) {
                window.SurveiOfflineManager.enqueueOffline(payload, inst, 'formSurveyRespondent');
                return;
              }
            }
            Swal.fire('Error', 'Gagal mengirim survei. Periksa koneksi internet Anda.', 'error');
          }
        });
        return;
      }

      // Check required questions
      var missingQuestions = [];
      currentRespondentQuestions.forEach(function(q, idx) {
        if (parseInt(q.IsRequired) === 1) {
          var answered = false;
          if (q.Tipe === 'radio') {
            answered = $('input[name="Jawaban[' + q.Id + ']"]:checked').length > 0;
          } else if (q.Tipe === 'checkbox') {
            answered = $('input[name="Jawaban[' + q.Id + '][]"]:checked').length > 0;
          } else if (q.Tipe === 'scale') {
            var v = $('#respScaleInput_' + q.Id).val();
            answered = (v !== '' && v !== undefined && v !== null);
          } else {
            var v = $.trim($('[name="Jawaban[' + q.Id + ']"]').val());
            answered = (v !== '');
          }

          if (!answered) {
            missingQuestions.push({
              idx: (idx + 1),
              id: q.Id,
              text: q.Pertanyaan
            });
          }
        }
      });

      if (missingQuestions.length > 0) {
        goToSurveyStep(2);

        // Highlight kartu pertanyaan yang belum dijawab
        $('.resp-q-card').removeClass('rtkd-unanswered');
        $('.resp-q-card .rtkd-unanswered-alert-badge').remove();
        var firstMissingCard = null;

        missingQuestions.forEach(function(mq) {
          var card = document.getElementById('respQCard_' + mq.id);
          if (card) {
            card.classList.add('rtkd-unanswered');
            var badge = document.createElement('div');
            badge.className = 'rtkd-unanswered-alert-badge';
            badge.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i> Pertanyaan Wajib &bull; Belum Terisi';
            card.insertBefore(badge, card.firstChild);
            if (!firstMissingCard) firstMissingCard = card;

            // Bersihkan highlight saat ada input
            $(card).one('input change', function() {
              card.classList.remove('rtkd-unanswered');
              var b = card.querySelector('.rtkd-unanswered-alert-badge');
              if (b) b.remove();
            });
          }
        });

        Swal.fire({
          icon: 'warning',
          title: 'Ada Jawaban Belum Terisi (' + missingQuestions.length + ' Butir) ⚠️',
          html: 
            '<div style="text-align: left; padding: 4px 0;">' +
              '<div style="background: #fef2f2; border: 1.5px solid #fecaca; border-radius: 12px; padding: 12px 14px; margin-bottom: 14px; color: #991b1b; font-size: 13.5px; line-height: 1.5;">' +
                '<i class="fa-solid fa-triangle-exclamation" style="font-size: 16px; margin-right: 6px; color: #dc2626;"></i>' +
                'Terdapat <b>' + missingQuestions.length + ' butir pertanyaan wajib</b> yang belum Anda jawab. Kartu pertanyaan yang belum terisi telah <b>ditandai dengan bingkai merah berdenyut</b>.' +
              '</div>' +
              '<div style="font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 8px;"><i class="fa-solid fa-list-ul mr-1"></i> Rincian butir yang perlu diisi:</div>' +
              '<ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #475569; max-height: 180px; overflow-y: auto; line-height: 1.6;">' +
                missingQuestions.slice(0, 8).map(function(m) { return '<li style="margin-bottom: 4px;"><b>Butir #' + m.idx + '</b>: ' + m.text + '</li>'; }).join('') +
                (missingQuestions.length > 8 ? '<li style="color: #dc2626; font-weight: 700; margin-top: 4px;">...dan ' + (missingQuestions.length - 8) + ' pertanyaan lainnya</li>' : '') +
              '</ul>' +
            '</div>',
          confirmButtonText: '<i class="fa-solid fa-arrow-down-long"></i> Tunjukkan &amp; Lengkapi Sekarang',
          confirmButtonColor: '#043168'
        }).then(function() {
          if (firstMissingCard) {
            firstMissingCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
            var input = firstMissingCard.querySelector('input, select, textarea');
            if (input) {
              setTimeout(function() { try { input.focus(); } catch(e) {} }, 450);
            }
          }
        });
        return;
      }

      // Collect data
      var formArray = $('#formSurveyRespondent').serializeArray();
      var payload = {
        SurveiId: parseInt($('#respSurveiId').val()),
        RespondenNama: $('#respNama').val(),
        RespondenKontak: $('#respKontak').val(),
        RespondenGender: $('#respGender').val(),
        RespondenUsia: $('#respUsia').val(),
        RespondenPendidikan: $('#respPendidikan').val(),
        RespondenPekerjaan: $('#respPekerjaan').val(),
        Provinsi: $('#respProvinsi option:selected').text() || '',
        Kabupaten: $('#respRealKabupaten').val() || $('#respKabupaten').val() || '',
        Kecamatan: $('#respRealKecamatan').val() || $('#respKecamatan').val() || '',
        RealKecamatan: $('#respRealKecamatan').val() || '',
        RealKabupaten: $('#respRealKabupaten').val() || '',
        Desa: $('#respDesa').val() || '',
        AlamatDetail: $('#respAlamatDetail').val(),
        Latitude: $('#respLatitude').val() || null,
        Longitude: $('#respLongitude').val() || null,
        LokasiAccuracy: $('#respLokasiAccuracy').val() || null,
        DevicePlatform: $('#respDevicePlatform').val() || 'Desktop Browser',
        FotoDokumentasi: $('#respFotoDokumentasi').val() || null,
        CreatedAt: new Date().toISOString(),
        waktu_pengisian: new Date().toISOString(),
        Jawaban: {}
      };

      formArray.forEach(function(item) {
        var match = item.name.match(/^Jawaban\[(\d+)\](\[\])?$/);
        if (match) {
          var qId = match[1];
          var isArray = match[2] === '[]';
          if (isArray) {
            if (!payload.Jawaban[qId]) payload.Jawaban[qId] = [];
            payload.Jawaban[qId].push(item.value);
          } else {
            payload.Jawaban[qId] = item.value;
          }
        }
      });

      var $btn = $('#btnSubmitSurvey');
      var originalHtml = $btn.html();
      $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Mengirim Jawaban...');

      $.ajax({
        url: BaseURL + 'IDE/submit_jawaban_survei',
        type: 'POST',
        data: JSON.stringify(payload),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function(res) {
          $btn.prop('disabled', false).html(originalHtml);
          if (res && res.status) {
            closeSurveyRespondentModal();
            Swal.fire({
              icon: 'success',
              title: 'Kuesioner Berhasil Terkirim!',
              html: 
                '<div style="text-align: center; padding: 10px 0;">' +
                  '<p style="font-size: 14px; color: #475569; margin-bottom: 16px;">Terima kasih atas partisipasi aktif Anda dalam survei penilaian kepuasan ini.</p>' +
                  '<div style="background: #f0fdf4; border: 1.5px solid #a7f3d0; border-radius: 16px; padding: 16px; margin-bottom: 14px;">' +
                    '<div style="font-size: 12px; font-weight: 800; color: #059669; text-transform: uppercase;">Perolehan Skor Evaluasi:</div>' +
                    '<div style="font-size: 32px; font-weight: 800; color: #047857; margin: 4px 0;">' + res.rata_rata_skor + '</div>' +
                    '<div style="font-size: 13.5px; font-weight: 700; color: #065f46;">Mutu Pelayanan: <b>' + res.mutu_pelayanan + '</b></div>' +
                  '</div>' +
                  '<div style="font-size: 12.5px; color: #64748b;"><i class="fa-solid fa-location-dot" style="color: var(--lugx-red);"></i> Wilayah Survei Tercatat: <b>' + (res.daerah_survei || '-') + '</b></div>' +
                '</div>',
              confirmButtonText: '<i class="fa-solid fa-check"></i> Selesai',
              confirmButtonColor: '#043168'
            });
            loadAllSurveys();
          } else {
            Swal.fire('Gagal', res.message || 'Gagal mengirim survei.', 'error');
          }
        },
        error: function() {
          $btn.prop('disabled', false).html(originalHtml);
          Swal.fire('Error', 'Gagal terhubung ke server saat mengirim survei.', 'error');
        }
      });
    };

    // =========================================================================
    // REKAPITULASI RESPON & DAERAH SURVEI ENGINE
    // =========================================================================
    window.openRekapForSurvey = function(surveyId) {
      $('#rekapSurveySelector').val(surveyId);
      switchSurveyorTab('rekap');
      loadRekapitulasi(surveyId);
    };

    // =========================================================================
    // PUBLIC REKAPITULASI STATE & FILTER ENGINE
    // =========================================================================
    window.currentPublicRekapList = [];
    window.currentPublicRekapSurveyId = null;

    window.clearPublicRekapSearch = function() {
      $('#publicRekapSearchInput').val('');
      window.applyPublicRekapFilters();
    };

    window.resetPublicRekapFilters = function() {
      $('#publicRekapSearchInput').val('');
      $('#publicRekapFilterInstrumen').val('');
      $('#publicRekapFilterKecamatan').val('');
      $('#publicRekapFilterMutu').val('');
      $('#publicRekapSortOrder').val('newest');
      window.applyPublicRekapFilters();
    };

    window.applyPublicRekapFilters = function() {
      var $tbody = $('#tableRekapRespondenBody');
      var list = window.currentPublicRekapList || [];
      var surveyId = window.currentPublicRekapSurveyId;

      var searchKeyword = ($('#publicRekapSearchInput').val() || '').trim().toLowerCase();
      var filterInst = ($('#publicRekapFilterInstrumen').val() || '').trim().toUpperCase();
      var filterKec = ($('#publicRekapFilterKecamatan').val() || '').trim().toLowerCase();
      var filterMutu = ($('#publicRekapFilterMutu').val() || '').trim();
      var sortOrder = $('#publicRekapSortOrder').val() || 'newest';

      $('#publicRekapSearchClearBtn').toggle(searchKeyword.length > 0);

      var filtered = list.filter(function(r) {
        if (filterInst) {
          var rInst = (r.Instrumen || '').trim().toUpperCase();
          if (filterInst === 'C' && (rInst === 'C' || rInst === 'E')) {
            // C or E
          } else if (rInst !== filterInst) {
            return false;
          }
        }

        if (filterKec) {
          var rKec = (r.Kecamatan || '').toLowerCase();
          if (rKec.indexOf(filterKec) === -1) {
            return false;
          }
        }

        if (filterMutu) {
          var rMutu = (r.MutuPelayanan || '');
          if (rMutu.indexOf(filterMutu) === -1) {
            return false;
          }
        }

        if (searchKeyword) {
          var blob = [
            r.RespondenNama,
            r.RespondenNIK,
            r.RespondenKontak,
            r.RespondenPekerjaan,
            r.RespondenPendidikan,
            r.Kecamatan,
            r.Desa,
            r.Kabupaten,
            r.AlamatDetail,
            r.MutuPelayanan,
            r.Instrumen,
            r.CreatedAt
          ].filter(Boolean).join(' ').toLowerCase();

          var terms = searchKeyword.split(/\s+/);
          for (var i = 0; i < terms.length; i++) {
            if (terms[i] && blob.indexOf(terms[i]) === -1) {
              return false;
            }
          }
        }

        return true;
      });

      // Sorting
      if (sortOrder === 'newest') {
        filtered.sort(function(a, b) { return (b.Id || 0) - (a.Id || 0); });
      } else if (sortOrder === 'oldest') {
        filtered.sort(function(a, b) { return (a.Id || 0) - (b.Id || 0); });
      } else if (sortOrder === 'name_asc') {
        filtered.sort(function(a, b) { return (a.RespondenNama || '').localeCompare(b.RespondenNama || ''); });
      } else if (sortOrder === 'name_desc') {
        filtered.sort(function(a, b) { return (b.RespondenNama || '').localeCompare(a.RespondenNama || ''); });
      } else if (sortOrder === 'score_desc') {
        filtered.sort(function(a, b) { return (parseFloat(b.RataRataSkor) || 0) - (parseFloat(a.RataRataSkor) || 0); });
      } else if (sortOrder === 'score_asc') {
        filtered.sort(function(a, b) { return (parseFloat(a.RataRataSkor) || 0) - (parseFloat(b.RataRataSkor) || 0); });
      }

      $('#publicRekapCountBadge').html('<i class="fa-solid fa-users"></i> Menampilkan ' + filtered.length + ' dari ' + list.length + ' Responden');

      $tbody.empty();

      if (filtered.length === 0) {
        if (list.length === 0) {
          $tbody.html('<tr><td colspan="8" style="text-align: center; padding: 40px; color: var(--lugx-gray);"><i class="fa-solid fa-clipboard-question" style="font-size: 26px; color: #cbd5e1; display: block; margin-bottom: 8px;"></i> Belum ada data responden yang mengisi survei ini.</td></tr>');
        } else {
          $tbody.html('<tr><td colspan="8" style="text-align: center; padding: 40px; color: #64748b;"><i class="fa-solid fa-magnifying-glass" style="font-size: 26px; color: #cbd5e1; display: block; margin-bottom: 8px;"></i> Tidak ditemukan data responden yang sesuai filter.<br><button type="button" class="btn btn-sm btn-outline-primary" style="margin-top: 10px; border-radius: 8px; font-weight: 700;" onclick="resetPublicRekapFilters()"><i class="fa-solid fa-rotate-left"></i> Reset Filter</button></td></tr>');
        }
        return;
      }

      filtered.forEach(function(r, idx) {
        var daerahFormatted = [];
        if (r.Kabupaten) daerahFormatted.push(r.Kabupaten);
        if (r.Kecamatan) daerahFormatted.push('Kec. ' + r.Kecamatan);
        if (r.Desa) daerahFormatted.push('Desa ' + r.Desa);
        var daerahString = daerahFormatted.length > 0 ? daerahFormatted.join(', ') : (r.AlamatDetail || '-');

        var demografiString = (r.RespondenGender || '-') + ' &bull; ' + (r.RespondenUsia || '-');
        if (r.RespondenPekerjaan) {
          demografiString += '<br><span style="font-size: 11px; color: #64748b;">' + r.RespondenPekerjaan + '</span>';
        }

        var instBadge = '';
        var inst = (r.Instrumen || '').toUpperCase();
        if (inst === 'A') {
          instBadge = '<span class="badge" style="background: #e0f2fe; color: #0369a1; font-size: 10.5px; font-weight: 700; padding: 2px 7px; border-radius: 6px; margin-top: 3px; display: inline-block;"><i class="fa-solid fa-building mr-1"></i> Inst. A &bull; Perusahaan</span>';
        } else if (inst === 'B') {
          instBadge = '<span class="badge" style="background: #fef3c7; color: #92400e; font-size: 10.5px; font-weight: 700; padding: 2px 7px; border-radius: 6px; margin-top: 3px; display: inline-block;"><i class="fa-solid fa-graduation-cap mr-1"></i> Inst. B &bull; Pencari Kerja</span>';
        } else if (inst === 'C') {
          instBadge = '<span class="badge" style="background: #f3e8ff; color: #6b21a8; font-size: 10.5px; font-weight: 700; padding: 2px 7px; border-radius: 6px; margin-top: 3px; display: inline-block;"><i class="fa-solid fa-comments mr-1"></i> Inst. C &bull; Stakeholder</span>';
        } else if (inst === 'E') {
          instBadge = '<span class="badge" style="background: #ecfdf5; color: #065f46; font-size: 10.5px; font-weight: 700; padding: 2px 7px; border-radius: 6px; margin-top: 3px; display: inline-block;"><i class="fa-solid fa-calculator mr-1"></i> Inst. E &bull; AHP</span>';
        } else if (inst === 'D') {
          instBadge = '<span class="badge" style="background: #fee2e2; color: #991b1b; font-size: 10.5px; font-weight: 700; padding: 2px 7px; border-radius: 6px; margin-top: 3px; display: inline-block;"><i class="fa-solid fa-school mr-1"></i> Inst. D &bull; Siswa Kelas 12</span>';
        }

        var nikInfo = r.RespondenNIK ? '<div style="font-size: 11px; color: #94a3b8; font-weight: normal;">NIK: ' + r.RespondenNIK + '</div>' : '';

        $tbody.append(
          '<tr>' +
            '<td style="text-align: center; font-weight: 700; color: #64748b;">' + (idx + 1) + '</td>' +
            '<td><span style="font-size: 12px; font-weight: 700; color: #64748b;">' + (r.CreatedAt ? r.CreatedAt.substring(0, 16) : '-') + '</span></td>' +
            '<td><b>' + (r.RespondenNama || 'Anonim') + '</b>' + nikInfo + (instBadge ? '<br>' + instBadge : '') + '</td>' +
            '<td><span class="badge-daerah-survei"><i class="fa-solid fa-location-dot"></i> ' + daerahString + '</span></td>' +
            '<td><span style="font-size: 12px; color: #475569;">' + demografiString + '</span></td>' +
            '<td style="text-align: center;"><b style="color: #059669; font-size: 14px;">' + (r.RataRataSkor || '0.00') + '</b></td>' +
            '<td style="text-align: center;"><span class="card-status status-active" style="padding: 3px 8px; font-size: 11px;">' + (r.MutuPelayanan || 'Baik') + '</span></td>' +
            '<td style="text-align: center;">' +
              '<button type="button" class="btn-action-edit" onclick="viewRespondentAnswers(' + surveyId + ', ' + r.Id + ')">' +
                '<i class="fa-solid fa-eye"></i> Rincian' +
              '</button>' +
            '</td>' +
          '</tr>'
        );
      });
    };

    window.loadRekapitulasi = function(surveyId) {
      if (!surveyId) return;

      $('#tableRekapRespondenBody').html('<tr><td colspan="8" style="text-align: center; padding: 40px; color: var(--lugx-gray);"><i class="fa-solid fa-spinner fa-spin"></i> Memuat data rekapitulasi...</td></tr>');

      $.ajax({
        url: BaseURL + 'IDE/get_survei_rekap_data/' + surveyId,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
          if (res && res.login_required) {
            $('#tableRekapRespondenBody').html('<tr><td colspan="8" style="text-align: center; padding: 40px; color: #b40814;"><i class="fa-solid fa-lock" style="font-size: 28px; margin-bottom: 10px; display: block;"></i> ' + (res.message || 'Akses Terbatas: Diperlukan login petugas.') + '<br><button type="button" class="btn-auth-unlock" style="margin-top: 14px;" onclick="openModal(\'signInModal\')"><i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang</button></td></tr>');
            promptSurveyAuth('rekap');
            return;
          }
          if (res && res.status) {
            rekapCache[surveyId] = res;

            $('#kpiTotalResponden').text(res.totalResponden || 0);
            $('#kpiRataRataSkor').text(res.rataRataSkor || '0.00');
            
            var skorTitle = (res.survei && res.survei.Jenis === 'IKM') ? 'Rata-Rata Skor IKM' : 'Rata-Rata Skor Survei';
            $('#lblKpiRataRataSkor').text(skorTitle);

            var mutuText = '-';
            var avg = parseFloat(res.rataRataSkor) || 0;
            if (avg >= 3.50) mutuText = 'A (Sangat Baik)';
            else if (avg >= 2.75) mutuText = 'B (Baik)';
            else if (avg >= 2.00) mutuText = 'C (Kurang)';
            else if (avg > 0) mutuText = 'D (Tidak Baik)';
            $('#kpiMutuPelayanan').text(mutuText);

            $('#kpiTotalDaerah').text(res.sebaranDaerah ? res.sebaranDaerah.length : 0);

            // Render Sebaran Daerah Pills
            var $pills = $('#rekapDaerahPills');
            $pills.empty();
            if (res.sebaranDaerah && res.sebaranDaerah.length > 0) {
              res.sebaranDaerah.forEach(function(d) {
                $pills.append(
                  '<span class="badge-daerah-survei" style="font-size: 13px; padding: 6px 14px;">' +
                    '<i class="fa-solid fa-location-dot"></i> ' + d.Daerah + ' &bull; <b>' + d.Total + ' Responden</b>' +
                  '</span>'
                );
              });
            } else {
              $pills.html('<span style="font-size: 13px; color: #64748b;">Belum ada sebaran wilayah responden.</span>');
            }

            window.currentPublicRekapSurveyId = surveyId;
            window.currentPublicRekapList = Array.isArray(res.responden) ? res.responden : [];

            // Populate Filter Kecamatan dinamis
            var uniqueKec = [];
            window.currentPublicRekapList.forEach(function(r) {
              var k = (r.Kecamatan || '').trim();
              if (k && uniqueKec.indexOf(k) === -1) {
                uniqueKec.push(k);
              }
            });
            uniqueKec.sort();
            var $kecSelect = $('#publicRekapFilterKecamatan');
            var prevKecVal = $kecSelect.val();
            $kecSelect.find('option:not(:first)').remove();
            uniqueKec.forEach(function(k) {
              $kecSelect.append('<option value="' + k.toLowerCase() + '">' + k + '</option>');
            });
            if (prevKecVal) $kecSelect.val(prevKecVal);

            // Deteksi multi-instrumen (RTKD)
            var isMultiInst = (surveyId == 4) || (res.survei && res.survei.TipeSurvei === 'multi') || window.currentPublicRekapList.some(function(r) { return r.Instrumen && r.Instrumen !== ''; });
            if (isMultiInst) {
              $('#publicFilterColInstrumen').show();
            } else {
              $('#publicFilterColInstrumen').hide();
            }

            window.applyPublicRekapFilters();
          }
        },
        error: function() {
          $('#tableRekapRespondenBody').html('<tr><td colspan="8" style="text-align: center; padding: 40px; color: #ef4444;">Gagal mengambil data rekapitulasi dari server.</td></tr>');
        }
      });
    };

    // View specific respondent's detailed answer sheet
    window.viewRespondentAnswers = function(surveyId, respId) {
      var cached = rekapCache[surveyId];
      if (!cached || !cached.responden) return;

      var respObj = cached.responden.find(r => r.Id == respId);
      if (!respObj) return;

      // Populate respondent profile
      var daerahSummary = [respObj.Provinsi, respObj.Kabupaten, respObj.Kecamatan, respObj.Desa].filter(Boolean).join(' &bull; ');
      if (respObj.AlamatDetail) daerahSummary += ' (' + respObj.AlamatDetail + ')';

      $('#detailRespondentProfile').html(
        '<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; font-size: 13.5px;">' +
          '<div><b>Nama Responden:</b> ' + (respObj.RespondenNama || 'Anonim') + '</div>' +
          '<div><b>Waktu Pengisian:</b> ' + (respObj.CreatedAt || '-') + '</div>' +
          '<div><b>Demografi:</b> ' + (respObj.RespondenGender || '-') + ' &bull; ' + (respObj.RespondenUsia || '-') + ' &bull; ' + (respObj.RespondenPekerjaan || '-') + '</div>' +
          '<div><b>Rata-Rata Skor:</b> <b style="color: #059669; font-size: 15px;">' + respObj.RataRataSkor + '</b> (' + (respObj.MutuPelayanan || 'Baik') + ')</div>' +
          '<div style="grid-column: 1 / -1;"><b>Keterangan Daerah Survei:</b> <span class="badge-daerah-survei"><i class="fa-solid fa-location-dot"></i> ' + (daerahSummary || 'Tidak dicantumkan') + '</span></div>' +
        '</div>'
      );

      // Populate answers
      var $answersContainer = $('#detailAnswersContainer');
      $answersContainer.html('<div style="text-align:center; padding: 20px;"><i class="fa-solid fa-spinner fa-spin"></i> Memuat rincian butir...</div>');

      // Fetch questions list from cached
      var questions = cached.pertanyaan || [];
      if (questions.length === 0) {
        $answersContainer.html('<div style="color: #64748b;">Data butir pertanyaan tidak tersedia.</div>');
      } else {
        var html = '';
        questions.forEach(function(q, idx) {
          html += 
            '<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 14px 18px;">' +
              '<div style="font-size: 12px; font-weight: 800; color: var(--lugx-blue); margin-bottom: 4px;">#' + (idx + 1) + ' ' + q.Pertanyaan + '</div>' +
              '<div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-top: 6px;">' +
                '<span style="font-size: 13.5px; font-weight: 700; color: var(--lugx-dark);"><i class="fa-solid fa-circle-check" style="color: #059669; margin-right: 6px;"></i> Terisi Lengkap</span>' +
                '<span style="font-size: 12px; background: #ecfdf5; color: #065f46; font-weight: 800; padding: 2px 8px; border-radius: 8px;">Tipe: ' + q.Tipe.toUpperCase() + '</span>' +
              '</div>' +
            '</div>';
        });
        $answersContainer.html(html);
      }

      $('#responseDetailModal').addClass('active');
    };

    window.closeResponseDetailModal = function() {
      $('#responseDetailModal').removeClass('active');
    };

    // Document Ready Initialization
    document.addEventListener('DOMContentLoaded', function() {
      loadAllSurveys();
      var yearElem = document.getElementById('current-year');
      if (yearElem) yearElem.textContent = new Date().getFullYear();
      if (typeof updateAdminGreeting === 'function') updateAdminGreeting();
      <?php if (!empty($loginRequiredAlert)): ?>
      setTimeout(function() {
        if (typeof promptSurveyAuth === 'function') {
          promptSurveyAuth('peta');
        }
      }, 500);
      <?php endif; ?>
    });
  
    // =========================================================================
    // OPENSTREETMAP & LEAFLET GIS GEOSPASIAL ENGINE KABUPATEN BANYUWANGI
    // =========================================================================
    var leafletMapInstance = null;
    var polygonLayerGroup = null;
    var markerLayerGroup = null;
    var currentGeoData = null;
    var allGeoPoints = [];
    var markersMap = {};
    var polygonLayersMap = {};

    // Cache Data Geospasial Riil 25 Kecamatan Banyuwangi (HDX-BPS 2020)
    var banyuwangiRealGeoJson = null;
    var banyuwangiDistrictsMeta = null;
    var isGeoJsonLoading = false;
    var geoJsonCallbacks = [];

    // Form Responden Mini-Map Instances
    var respFormMiniMapInstance = null;
    var respMiniPolygonGroup = null;
    var respMiniMarkerGroup = null;
    var respCurrentMarker = null;
    var respAccuracyCircle = null;

    // Fungsi Pengambil Data Batas Riil 25 Kecamatan Banyuwangi
    function getBanyuwangiRealGeoJson(callback) {
      if (banyuwangiRealGeoJson && banyuwangiDistrictsMeta) {
        if (callback) callback(banyuwangiRealGeoJson, banyuwangiDistrictsMeta);
        return;
      }
      if (callback) geoJsonCallbacks.push(callback);
      if (isGeoJsonLoading) return;
      isGeoJsonLoading = true;

      $.getJSON(BaseURL + 'assets/geojson/banyuwangi_kecamatan_real_smooth.geojson', function(geoData) {
        banyuwangiRealGeoJson = geoData;
        $.getJSON(BaseURL + 'assets/geojson/banyuwangi_districts_meta.json', function(metaData) {
          banyuwangiDistrictsMeta = metaData;
          isGeoJsonLoading = false;
          while (geoJsonCallbacks.length > 0) {
            var cb = geoJsonCallbacks.shift();
            try { cb(banyuwangiRealGeoJson, banyuwangiDistrictsMeta); } catch(err) { console.error(err); }
          }
        });
      }).fail(function() {
        isGeoJsonLoading = false;
        console.error('Gagal memuat file GeoJSON real Banyuwangi.');
      });
    }

    // Preload GeoJSON data saat halaman selesai dimuat
    $(document).ready(function() {
      getBanyuwangiRealGeoJson();
    });

    // Fallback Centroid Koordinat 25 Kecamatan Banyuwangi
    var fallbackKecamatanCoords = {
      'bangorejo': [-8.480000, 114.170000],
      'banyuwangi': [-8.219234, 114.369120],
      'blimbingsari': [-8.315000, 114.350000],
      'cluring': [-8.436120, 114.238940],
      'gambiran': [-8.396140, 114.150020],
      'genteng': [-8.363910, 114.152840],
      'giri': [-8.205000, 114.340000],
      'glagah': [-8.235000, 114.320000],
      'glenmore': [-8.305710, 114.053120],
      'kabat': [-8.269430, 114.334710],
      'kalibaru': [-8.290000, 113.960000],
      'kalipuro': [-8.148120, 114.372510],
      'licin': [-8.210000, 114.260000],
      'muncar': [-8.435820, 114.331420],
      'pesanggaran': [-8.548910, 114.076720],
      'purwoharjo': [-8.490000, 114.250000],
      'rogojampi': [-8.303120, 114.296540],
      'sempu': [-8.310000, 114.165000],
      'siliragung': [-8.520000, 114.110000],
      'singojuruh': [-8.324210, 114.238920],
      'songgon': [-8.232540, 114.218930],
      'srono': [-8.398640, 114.262510],
      'tegaldlimo': [-8.560000, 114.340000],
      'tegalsari': [-8.440000, 114.135000],
      'wongsorejo': [-7.954720, 114.408910]
    };

    window.openSurveyGeoMap = function(surveyId) {
      if (!isLoggedIn) {
        promptSurveyAuth('peta');
        return;
      }
      surveyId = surveyId || 3;
      switchSurveyorTab('peta');
      $('#geoSurveySelect').val(surveyId);
      loadSurveyGeoMap(surveyId);
    };

    window.reloadCurrentGeoMap = function() {
      if (!isLoggedIn) {
        promptSurveyAuth('peta');
        return;
      }
      var sid = $('#geoSurveySelect').val() || 3;
      loadSurveyGeoMap(sid);
    };

    window.downloadCurrentGeoExcel = function() {
      if (!isLoggedIn) {
        promptSurveyAuth('rekap');
        return;
      }
      var sid = $('#geoSurveySelect').val() || 3;
      downloadRekapExcel(sid);
    };

    // Load Peta Geospasial & Responden Sesuai Survei yang Dipilih
    window.loadSurveyGeoMap = function(surveyId) {
      if (!isLoggedIn) {
        promptSurveyAuth('peta');
        return;
      }

      surveyId = surveyId || 3;
      
      // Init Map Instance jika belum dibuat
      if (!leafletMapInstance) {
        leafletMapInstance = L.map('leafletSurveiMap', {
          center: [-8.32, 114.25],
          zoom: 10,
          scrollWheelZoom: true
        });

        // OpenStreetMap Layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &bull; IDE Consultant GIS'
        }).addTo(leafletMapInstance);

        polygonLayerGroup = L.layerGroup().addTo(leafletMapInstance);
        markerLayerGroup = L.layerGroup().addTo(leafletMapInstance);
      }

      // Reset layer
      polygonLayerGroup.clearLayers();
      markerLayerGroup.clearLayers();
      markersMap = {};
      polygonLayersMap = {};

      $.ajax({
        url: BaseURL + 'IDE/get_survei_geo_data/' + surveyId,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
          if (res && res.login_required) {
            promptSurveyAuth('peta');
            return;
          }
          if (res && res.status) {
            currentGeoData = res;
            allGeoPoints = res.points || [];

            // Update KPI Card
            $('#geoKpiTotal').text(res.totalMapped + ' / ' + res.totalResponden);
            $('#geoKpiKecamatan').text((res.kecamatanSummary ? res.kecamatanSummary.length : 0) + ' / 25');
            $('#geoKpiSkor').text(Number(res.rataRataSkor || 0).toFixed(2));
            
            var predikat = (res.survei && res.survei.MutuPelayanan) ? res.survei.MutuPelayanan : 'Mutu B (Baik)';
            $('#geoKpiMutu').text(predikat);

            // Perangkat dominan
            var devCount = {};
            allGeoPoints.forEach(function(p) {
              var d = p.device || 'Android Mobile';
              devCount[d] = (devCount[d] || 0) + 1;
            });
            var topDev = 'Mobile Android';
            var maxD = 0;
            for (var dk in devCount) {
              if (devCount[dk] > maxD) {
                maxD = devCount[dk];
                topDev = dk.replace(/Mobile/g, '').replace(/[()]/g, '').trim();
              }
            }
            $('#geoKpiDevice').text(topDev || 'Android');

            // Populate Survey Selector
            var $sel = $('#geoSurveySelect');
            if (res.surveiList && res.surveiList.length > 0) {
              $sel.empty();
              res.surveiList.forEach(function(s) {
                var isSel = (s.Id == res.survei.Id) ? 'selected' : '';
                $sel.append('<option value="' + s.Id + '" ' + isSel + '>' + s.Judul + ' (' + (s.Tahun || 2026) + ')</option>');
              });
              $sel.val(res.survei.Id);
            }

            // Memuat Batas Poligon Riil 25 Kecamatan Banyuwangi dari GeoJSON
            getBanyuwangiRealGeoJson(function(geoData, metaData) {
              renderKecamatanPolygons(res.kecamatanSummary, geoData, metaData);

              // Populate Filter Kecamatan Selector dengan 25 Kecamatan Lengkap
              var $kecSel = $('#geoKecamatanFilter');
              $kecSel.empty();
              $kecSel.append('<option value="">Semua Wilayah Kecamatan (' + allGeoPoints.length + ' Titik Responden)</option>');

              var distKeys = Object.keys(metaData || {}).sort();
              var sumLookup = {};
              (res.kecamatanSummary || []).forEach(function(ks) {
                sumLookup[ks.kecamatan.toLowerCase()] = ks;
              });

              distKeys.forEach(function(kName) {
                var stat = sumLookup[kName.toLowerCase()];
                var tot = stat ? stat.total : 0;
                var sk = stat ? (' - Skor ' + stat.avgSkor) : '';
                $kecSel.append('<option value="' + kName + '">' + kName + ' (' + tot + ' Responden' + sk + ')</option>');
              });
            });

            // Render Titik Markers Responden & Feed
            renderRespondentMarkers(allGeoPoints);
            renderSidebarFeed(allGeoPoints);
            updateFocusKecamatanCard(null);

            // Invalidate Map Size agar Leaflet menghitung ukuran container setelah tab tampil
            setTimeout(function() {
              if (leafletMapInstance) {
                leafletMapInstance.invalidateSize();
                resetMapToBanyuwangi();
              }
            }, 300);

          } else {
            Swal.fire('Info', res.message || 'Gagal memuat data geospasial.', 'info');
          }
        },
        error: function() {
          Swal.fire('Error', 'Gagal menghubungi server data spasial survei.', 'error');
        }
      });
    };

    // Render Batas Wilayah Poligon Riil 25 Kecamatan Banyuwangi (HDX-BPS 2020)
    function renderKecamatanPolygons(kecSummary, geoData, metaData) {
      if (!polygonLayerGroup) return;
      polygonLayerGroup.clearLayers();
      polygonLayersMap = {};

      var sumMap = {};
      if (kecSummary) {
        kecSummary.forEach(function(ks) {
          sumMap[ks.kecamatan.toLowerCase()] = ks;
        });
      }

      var targetGeo = geoData || banyuwangiRealGeoJson;
      if (!targetGeo) return;

      L.geoJSON(targetGeo, {
        style: function(feature) {
          var color = feature.properties.color || '#2563eb';
          return {
            color: color,
            weight: 2,
            opacity: 0.9,
            fillColor: color,
            fillOpacity: 0.22,
            dashArray: '3, 5'
          };
        },
        onEachFeature: function(feature, layer) {
          var distName = feature.properties.district || feature.properties.nama;
          var kKey = (distName || '').toLowerCase();
          polygonLayersMap[kKey] = layer;

          var stat = sumMap[kKey];
          var totalRes = stat ? stat.total : 0;
          var avgSkor = stat ? stat.avgSkor : '-';
          var totalDesa = feature.properties.total_desa || (feature.properties.villages ? feature.properties.villages.length : 0);

          // Tooltip informatif modern
          var tooltipContent = 
            '<div style="font-family: inherit; line-height: 1.4;">' +
              '<div style="font-size: 13px; font-weight: 800; color: #043168; margin-bottom: 2px;">' +
                '<i class="fa-solid fa-map-pin" style="color: ' + (feature.properties.color || '#2563eb') + ';"></i> Kec. ' + distName +
              '</div>' +
              '<div style="font-size: 11.5px; color: #334155;">' +
                '<b>' + totalRes + '</b> Responden Terdata &bull; Skor: <b>' + avgSkor + '</b>' +
              '</div>' +
              '<div style="font-size: 10.5px; color: #64748b; margin-top: 2px;">' +
                '<i class="fa-solid fa-tree-city"></i> ' + totalDesa + ' Desa / Kelurahan' +
              '</div>' +
            '</div>';

          layer.bindTooltip(tooltipContent, {
            sticky: true,
            className: 'geo-polygon-tooltip'
          });

          layer.on({
            mouseover: function(e) {
              var l = e.target;
              l.setStyle({
                weight: 4.5,
                fillOpacity: 0.55,
                dashArray: ''
              });
            },
            mouseout: function(e) {
              var l = e.target;
              var curFilter = ($('#geoKecamatanFilter').val() || '').toLowerCase();
              if (curFilter !== kKey) {
                l.setStyle({
                  weight: 2,
                  fillOpacity: 0.22,
                  dashArray: '3, 5'
                });
              }
            },
            click: function(e) {
              $('#geoKecamatanFilter').val(distName).trigger('change');
            }
          });
        }
      }).addTo(polygonLayerGroup);
    }

    // Render Titik Markers Responden dengan Pin Unik
    function renderRespondentMarkers(points) {
      if (!markerLayerGroup) return;
      markerLayerGroup.clearLayers();
      markersMap = {};

      points.forEach(function(item) {
        if (!item.lat || !item.lng) return;

        // Tentukan kelas pin sesuai skor/mutu
        var pinClass = 'pin-b';
        var badgeClass = 'badge-blue';
        if (item.skor >= 3.50) {
          pinClass = 'pin-a';
          badgeClass = 'badge-green';
        } else if (item.skor >= 2.75) {
          pinClass = 'pin-b';
          badgeClass = 'badge-blue';
        } else if (item.skor >= 2.00) {
          pinClass = 'pin-c';
          badgeClass = 'badge-yellow';
        } else {
          pinClass = 'pin-d';
          badgeClass = 'badge-yellow';
        }

        // Custom HTML Pin Icon
        var customIcon = L.divIcon({
          className: 'custom-svg-pin',
          iconSize: [28, 28],
          iconAnchor: [14, 28],
          popupAnchor: [0, -28],
          html: '<div class="pin-inner ' + pinClass + '"><i class="fa-solid fa-person-circle-check"></i></div>'
        });

        var avatarInitial = (item.nama && item.nama.length > 0) ? item.nama.charAt(0).toUpperCase() : 'R';
        var namaSurveiInstansi = (currentGeoData && currentGeoData.survei && currentGeoData.survei.Lembaga) ? currentGeoData.survei.Lembaga : 'Pemerintah Kab. Banyuwangi';

        // Google Maps Style Popup
        var popupHtml = 
          '<div class="gmaps-popup-card">' +
            '<div class="gmaps-popup-header">' +
              '<div class="gmaps-popup-instansi"><i class="fa-solid fa-building-columns"></i> ' + namaSurveiInstansi + '</div>' +
              '<span class="gmaps-popup-badge ' + badgeClass + '">' + item.mutu + '</span>' +
            '</div>' +
            '<div class="gmaps-popup-body">' +
              '<div class="gmaps-popup-user">' +
                '<div class="gmaps-popup-avatar">' + avatarInitial + '</div>' +
                '<div>' +
                  '<h4 class="gmaps-popup-name">' + item.nama + '</h4>' +
                  '<div class="gmaps-popup-time"><i class="fa-regular fa-clock"></i> Submit: ' + item.waktuFormatted + '</div>' +
                '</div>' +
              '</div>' +
              '<div class="gmaps-popup-geo">' +
                '<div class="geo-coord-row">' +
                  '<i class="fa-solid fa-location-crosshairs text-blue"></i>' +
                  '<span><b>' + Number(item.lat).toFixed(6) + '</b>, <b>' + Number(item.lng).toFixed(6) + '</b></span>' +
                  '<span class="acc-tag">&plusmn;' + (item.accuracy || 8.5) + 'm</span>' +
                '</div>' +
                '<div class="geo-admin-row">' +
                  '<i class="fa-solid fa-map-pin text-red"></i>' +
                  '<span>Kec. <b>' + item.kecamatan + '</b>, Desa <b>' + (item.desa || '-') + '</b></span>' +
                '</div>' +
                '<div class="geo-device-row">' +
                  '<i class="fa-solid fa-mobile-screen text-slate"></i>' +
                  '<span>' + item.device + '</span>' +
                '</div>' +
              '</div>' +
              '<div class="gmaps-popup-score">' +
                '<span class="score-lbl">Indeks Nilai Kepuasan:</span>' +
                '<span class="score-val">★ ' + Number(item.skor).toFixed(2) + ' / 4.00</span>' +
              '</div>' +
            '</div>' +
            '<div class="gmaps-popup-footer">' +
              '<a href="https://www.google.com/maps?q=' + item.lat + ',' + item.lng + '" target="_blank" class="btn-popup-gmaps">' +
                '<i class="fa-brands fa-google"></i> Google Maps' +
              '</a>' +
              '<a href="https://www.openstreetmap.org/?mlat=' + item.lat + '&mlon=' + item.lng + '#map=16/' + item.lat + '/' + item.lng + '" target="_blank" class="btn-popup-osm">' +
                '<i class="fa-solid fa-earth-asia"></i> OSM' +
              '</a>' +
              '<button type="button" class="btn-popup-detail" onclick="openResponseDetailModal(' + item.id + ')">' +
                '<i class="fa-solid fa-circle-info"></i> Detail' +
              '</button>' +
            '</div>' +
          '</div>';

        var marker = L.marker([item.lat, item.lng], { icon: customIcon }).bindPopup(popupHtml);
        marker.addTo(markerLayerGroup);
        markersMap[item.id] = marker;
      });
    }

    // Filter Peta Berdasarkan Kecamatan
    window.filterMapKecamatan = function(kecName) {
      var filtered = allGeoPoints;
      var curMutu = $('#geoMutuFilter').val();

      if (kecName) {
        filtered = filtered.filter(function(p) {
          return (p.kecamatan && p.kecamatan.toLowerCase() === kecName.toLowerCase());
        });
      }
      if (curMutu) {
        filtered = filtered.filter(function(p) {
          return (p.mutu && p.mutu.indexOf(curMutu) !== -1);
        });
      }

      renderRespondentMarkers(filtered);
      renderSidebarFeed(filtered);
      updateFocusKecamatanCard(kecName);

      // Reset and highlight polygon
      var kecKey = kecName ? kecName.toLowerCase() : '';
      for (var k in polygonLayersMap) {
        if (kecKey && k === kecKey) {
          polygonLayersMap[k].setStyle({ weight: 4.5, fillOpacity: 0.55, dashArray: '' });
          var b = polygonLayersMap[k].getBounds();
          leafletMapInstance.fitBounds(b, { padding: [50, 50], maxZoom: 13, animate: true });
        } else {
          polygonLayersMap[k].setStyle({ weight: 2, fillOpacity: 0.22, dashArray: '3, 5' });
        }
      }

      if (!kecName) {
        resetMapToBanyuwangi();
      }
    };

    // Filter Peta Berdasarkan Mutu
    window.filterMapMutu = function(mutuVal) {
      var kecName = $('#geoKecamatanFilter').val();
      window.filterMapKecamatan(kecName);
    };

    // Toggle Poligon Batas Wilayah
    window.toggleKecamatanPolygons = function(show) {
      if (!polygonLayerGroup) return;
      if (show) {
        if (!leafletMapInstance.hasLayer(polygonLayerGroup)) {
          leafletMapInstance.addLayer(polygonLayerGroup);
        }
      } else {
        if (leafletMapInstance.hasLayer(polygonLayerGroup)) {
          leafletMapInstance.removeLayer(polygonLayerGroup);
        }
      }
    };

    // Toggle Marker Responden
    window.toggleRespondentMarkers = function(show) {
      if (!markerLayerGroup) return;
      if (show) {
        if (!leafletMapInstance.hasLayer(markerLayerGroup)) {
          leafletMapInstance.addLayer(markerLayerGroup);
        }
      } else {
        if (leafletMapInstance.hasLayer(markerLayerGroup)) {
          leafletMapInstance.removeLayer(markerLayerGroup);
        }
      }
    };

    // Pusatkan Peta ke Seluruh Wilayah Banyuwangi
    window.resetMapToBanyuwangi = function() {
      if (leafletMapInstance) {
        leafletMapInstance.setView([-8.33, 114.28], 10, { animate: true });
      }
    };

    // Update Kartu Fokus Kecamatan di Sidebar
    function updateFocusKecamatanCard(kecName) {
      if (!kecName) {
        $('#focusKecBadge').html('<i class="fa-solid fa-map"></i> Kabupaten Banyuwangi');
        $('#focusKecTitle').text('Seluruh Wilayah');
        $('#focusKecTotal').text(allGeoPoints.length + ' Responden');
        
        var totalSkorAll = allGeoPoints.reduce(function(acc, cur){ return acc + (cur.skor || 0); }, 0);
        var avgAll = allGeoPoints.length > 0 ? (totalSkorAll / allGeoPoints.length).toFixed(2) : '0.00';
        $('#focusKecSkor').text(avgAll);
        $('#focusKecMutu').text(avgAll >= 3.50 ? 'Sangat Baik (A)' : (avgAll >= 2.75 ? 'Baik (B)' : 'Kurang (C)'));
        $('#focusKecLastSubmit').text('18 Okt 2026');
        return;
      }

      var stat = (currentGeoData && currentGeoData.kecamatanSummary) ? currentGeoData.kecamatanSummary.find(function(s){ return s.kecamatan.toLowerCase() === kecName.toLowerCase(); }) : null;
      var meta = (banyuwangiDistrictsMeta && banyuwangiDistrictsMeta[kecName]) ? banyuwangiDistrictsMeta[kecName] : null;

      if (stat) {
        $('#focusKecBadge').html('<i class="fa-solid fa-location-crosshairs"></i> Wilayah Terfokus');
        $('#focusKecTitle').text('Kecamatan ' + stat.kecamatan);
        $('#focusKecTotal').text(stat.total + ' Responden' + (meta ? ' (' + meta.total_desa + ' Desa)' : ''));
        $('#focusKecSkor').text(stat.avgSkor);
        $('#focusKecMutu').text(stat.mutu);
        $('#focusKecLastSubmit').text(stat.lastSubmit ? stat.lastSubmit.split(' ')[0] : 'Terkini');
      } else {
        $('#focusKecBadge').html('<i class="fa-solid fa-location-crosshairs"></i> Wilayah Terfokus');
        $('#focusKecTitle').text('Kecamatan ' + kecName);
        $('#focusKecTotal').text('0 Responden' + (meta ? ' (' + meta.total_desa + ' Desa)' : ''));
        $('#focusKecSkor').text('-');
        $('#focusKecMutu').text('Belum Terdata');
        $('#focusKecLastSubmit').text('-');
      }
    }

    // Render Feed Titik Responden di Sidebar
    function renderSidebarFeed(points) {
      var $list = $('#geoFeedList');
      $list.empty();
      $('#feedCountPill').text(points.length + ' Responden');

      if (points.length === 0) {
        $list.html('<div style="text-align:center; padding: 24px; color: #64748b; font-size: 13px;">Tidak ada titik responden yang cocok dengan filter saat ini.</div>');
        return;
      }

      points.forEach(function(p) {
        var scoreClass = p.skor >= 3.50 ? 'mutu-a' : (p.skor >= 2.75 ? 'mutu-b' : 'mutu-c');
        var itemHtml = 
          '<div class="geo-feed-item" onclick="focusRespondentMarker(' + p.id + ')">' +
            '<div class="feed-item-top">' +
              '<span class="feed-item-name">' + p.nama + '</span>' +
              '<span class="feed-item-score ' + scoreClass + '">★ ' + Number(p.skor).toFixed(2) + '</span>' +
            '</div>' +
            '<div class="feed-item-meta">' +
              '<span><i class="fa-solid fa-map-pin"></i> Kec. ' + p.kecamatan + ', ' + (p.desa || '-') + '</span>' +
              '<span><i class="fa-regular fa-clock"></i> ' + p.waktuFormatted + '</span>' +
              '<span><i class="fa-solid fa-mobile-screen"></i> ' + p.device + '</span>' +
            '</div>' +
          '</div>';

        $list.append(itemHtml);
      });
    }

    // Klik item feed langsung fokus ke titik di Leaflet dan buka InfoWindow
    window.focusRespondentMarker = function(respId) {
      var m = markersMap[respId];
      if (m && leafletMapInstance) {
        var latLng = m.getLatLng();
        leafletMapInstance.flyTo(latLng, 15, { duration: 1 });
        setTimeout(function() {
          m.openPopup();
        }, 800);
      }
    };

    // =========================================================================
    // MINI-MAP INTERAKTIF & GPS TRACKER DI FORM SURVEI RESPONDEN
    // =========================================================================
    window.initRespondentMiniMap = function(surveiObj) {
      if (window.isCurrentRtkd) return;
      var $container = $('#respFormMiniMap');
      if (!$container.length || !$container.is(':visible') || $container.width() === 0) {
        return;
      }

      // Inisialisasi Canvas Leaflet jika belum ada
      if (!respFormMiniMapInstance) {
        respFormMiniMapInstance = L.map('respFormMiniMap', {
          center: [-8.219234, 114.369120],
          zoom: 11,
          scrollWheelZoom: false
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; OpenStreetMap &bull; IDE Consultant'
        }).addTo(respFormMiniMapInstance);

        respMiniPolygonGroup = L.layerGroup().addTo(respFormMiniMapInstance);
        respMiniMarkerGroup = L.layerGroup().addTo(respFormMiniMapInstance);

        // Klik pada mini map untuk menempatkan pin responden secara manual
        respFormMiniMapInstance.on('click', function(e) {
          updateRespondentPinPosition(e.latlng.lat, e.latlng.lng, 8.0, 'Manual Klik Peta');
        });
      }

      // Pastikan Leaflet menghitung ulang ukuran kontainer setelah modal terbuka
      setTimeout(function() {
        if (respFormMiniMapInstance && $('#respFormMiniMap').is(':visible')) {
          respFormMiniMapInstance.invalidateSize();
        }
      }, 350);

      // Pre-populate dropdown kecamatan Banyuwangi jika survei adalah Banyuwangi
      var daerah = (surveiObj && surveiObj.DaerahSurvei) ? surveiObj.DaerahSurvei.toLowerCase() : 'banyuwangi';
      getBanyuwangiRealGeoJson(function(geoData, metaData) {
        if (daerah.indexOf('banyuwangi') !== -1 || daerah.indexOf('kab') !== -1 || daerah === '') {
          var $kecSel = $('#respKecamatan');
          $kecSel.empty().append('<option value="">-- Pilih Kecamatan Banyuwangi --</option>');
          Object.keys(metaData).sort().forEach(function(k) {
            $kecSel.append('<option value="' + k + '">' + k + '</option>');
          });

          // Tampilkan poligon seluruh wilayah Banyuwangi sebagai baseline
          respMiniPolygonGroup.clearLayers();
          L.geoJSON(geoData, {
            style: {
              color: '#3b82f6',
              weight: 1.5,
              opacity: 0.7,
              fillColor: '#60a5fa',
              fillOpacity: 0.12,
              dashArray: '3, 4'
            }
          }).addTo(respMiniPolygonGroup);
          if (respFormMiniMapInstance) {
            respFormMiniMapInstance.setView([-8.32, 114.25], 10);
          }
        }
      });

      // Deteksi platform perangkat dan set koordinat default
      detectRespondentDeviceLocation(false);
    };

    // Update Posisi Pin Marker di Mini-Map Form
    window.updateRespondentPinPosition = function(lat, lng, accuracy, sourceNote) {
      if (window.isCurrentRtkd) return;
      if (!respMiniMarkerGroup) return;

      lat = parseFloat(lat);
      lng = parseFloat(lng);
      if (isNaN(lat) || isNaN(lng) || !isFinite(lat) || !isFinite(lng)) {
        lat = -8.219234;
        lng = 114.369120;
      }
      accuracy = parseFloat(accuracy || 8.5);
      if (isNaN(accuracy) || !isFinite(accuracy)) {
        accuracy = 8.5;
      }

      lat = Number(lat.toFixed(6));
      lng = Number(lng.toFixed(6));
      accuracy = Number(accuracy.toFixed(1));

      respMiniMarkerGroup.clearLayers();

      var customPin = L.divIcon({
        className: 'resp-marker-custom',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
        html: '<div style="background: #ef4444; color: #ffffff; width: 32px; height: 32px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4); border: 2.5px solid #ffffff;"><i class="fa-solid fa-location-dot" style="transform: rotate(45deg); font-size: 13px;"></i></div>'
      });

      respCurrentMarker = L.marker([lat, lng], {
        icon: customPin,
        draggable: true,
        title: 'Geser pin untuk memposisikan titik lokasi survei Anda'
      }).addTo(respMiniMarkerGroup);

      respAccuracyCircle = L.circle([lat, lng], {
        radius: accuracy,
        color: '#2563eb',
        fillColor: '#3b82f6',
        fillOpacity: 0.2,
        weight: 1.5
      }).addTo(respMiniMarkerGroup);

      // Event saat pin digeser oleh responden
      respCurrentMarker.on('dragend', function(e) {
        var pos = e.target.getLatLng();
        updateRespondentPinPosition(pos.lat, pos.lng, 5.0, 'Manual Geser Pin');
      });

      // Update nilai input form & display UI
      $('#respLatitude').val(lat);
      $('#respLongitude').val(lng);
      $('#respLokasiAccuracy').val(accuracy);

      $('#dispGpsLat').text(lat);
      $('#dispGpsLng').text(lng);
      $('#dispGpsAcc').html('&plusmn; ' + accuracy + ' m');

      var statusTxt = sourceNote || 'Koordinat Terkunci';
      $('#respGpsBadgeStatus').html('<i class="fa-solid fa-circle-check"></i> ' + statusTxt);
    };

    // Zoom Mini-Map ke Poligon Batas Riil Kecamatan Terpilih
    window.focusMiniMapToKecamatan = function(kecName) {
      if (!kecName) return;
      getBanyuwangiRealGeoJson(function(geoData, metaData) {
        var meta = metaData ? metaData[kecName] : null;
        if (meta && meta.villages) {
          // Isi otomatis dropdown desa/kelurahan
          var $desaSel = $('#respDesa');
          $desaSel.empty().append('<option value="">-- Pilih Desa / Kelurahan --</option>');
          meta.villages.forEach(function(v) {
            $desaSel.append('<option value="' + v + '">' + v + '</option>');
          });
        }

        // Cari fitur poligon batas riil kecamatan
        if (respMiniPolygonGroup && geoData) {
          respMiniPolygonGroup.clearLayers();
          var matchedFeature = geoData.features.find(function(f) {
            var fName = f.properties.district || f.properties.nama;
            return fName && fName.toLowerCase() === kecName.toLowerCase();
          });

          if (matchedFeature) {
            var color = matchedFeature.properties.color || '#2563eb';
            var polyLayer = L.geoJSON(matchedFeature, {
              style: {
                color: color,
                weight: 3.5,
                opacity: 0.95,
                fillColor: color,
                fillOpacity: 0.28
              }
            }).addTo(respMiniPolygonGroup);

            if (respFormMiniMapInstance) {
              respFormMiniMapInstance.fitBounds(polyLayer.getBounds(), { padding: [15, 15], maxZoom: 13, animate: true });
            }

            // Jika belum ada koordinat GPS responden, posisikan pin di tengah kecamatan
            var center = matchedFeature.properties.center || (meta ? meta.center : [-8.219234, 114.369120]);
            var jLat = Number((center[0] + (Math.random() - 0.5) * 0.005).toFixed(6));
            var jLng = Number((center[1] + (Math.random() - 0.5) * 0.005).toFixed(6));
            updateRespondentPinPosition(jLat, jLng, 12.0, 'Wilayah Kec. ' + kecName);
          }
        }
      });
    };

    // Helper: Deteksi Rinci Perangkat (Brand, Model HP, OS, dan Browser)
    window.getDetailedDeviceInfo = function() {
      var ua = navigator.userAgent || '';
      var os = 'Unknown OS';
      var brand = 'Perangkat';
      var browser = 'Browser';

      // 1. Deteksi Sistem Operasi
      if (/Android/i.test(ua)) {
        var vMatch = ua.match(/Android\s([0-9\.]+)/i);
        os = 'Android' + (vMatch ? ' ' + vMatch[1] : '');
      } else if (/iPhone/i.test(ua)) {
        var iosMatch = ua.match(/OS\s([0-9_]+)/i);
        os = 'iOS' + (iosMatch ? ' ' + iosMatch[1].replace(/_/g, '.') : '');
      } else if (/iPad/i.test(ua)) {
        var ipadMatch = ua.match(/OS\s([0-9_]+)/i);
        os = 'iPadOS' + (ipadMatch ? ' ' + ipadMatch[1].replace(/_/g, '.') : '');
      } else if (/Windows NT 10\.0/i.test(ua)) {
        os = 'Windows 10/11';
      } else if (/Windows NT 6\.3/i.test(ua)) {
        os = 'Windows 8.1';
      } else if (/Windows NT 6\.1/i.test(ua)) {
        os = 'Windows 7';
      } else if (/Macintosh|Mac OS X/i.test(ua)) {
        os = 'macOS';
      } else if (/Linux/i.test(ua)) {
        os = 'Linux';
      }

      // 2. Deteksi Merek & Seri Smartphone
      if (/iPhone/i.test(ua)) {
        brand = 'Apple iPhone';
      } else if (/iPad/i.test(ua)) {
        brand = 'Apple iPad';
      } else if (/SM-[A-Za-z0-9]+/i.test(ua)) {
        var smMatch = ua.match(/SM-([A-Za-z0-9]+)/i);
        brand = 'Samsung Galaxy (SM-' + (smMatch ? smMatch[1] : 'Series') + ')';
      } else if (/SAMSUNG/i.test(ua)) {
        brand = 'Samsung Mobile';
      } else if (/Redmi|POCO|Mi\s[0-9A-Za-z]+|2[0-9]{7}[A-Z]+/i.test(ua)) {
        var miMatch = ua.match(/(Redmi[^\;\)]*|POCO[^\;\)]*|Mi\s[0-9A-Za-z]+)/i);
        brand = 'Xiaomi ' + (miMatch ? miMatch[0] : 'Redmi');
      } else if (/CPH[0-9]+|OPPO/i.test(ua)) {
        var oppoMatch = ua.match(/CPH[0-9]+/i);
        brand = 'OPPO ' + (oppoMatch ? oppoMatch[0] : 'Mobile');
      } else if (/V[0-9]{4}[A-Z]*|vivo/i.test(ua)) {
        var vivoMatch = ua.match(/V[0-9]{4}[A-Z]*/i);
        brand = 'vivo ' + (vivoMatch ? vivoMatch[0] : 'Mobile');
      } else if (/RMX[0-9]+|Realme/i.test(ua)) {
        var rmxMatch = ua.match(/RMX[0-9]+/i);
        brand = 'Realme ' + (rmxMatch ? rmxMatch[0] : 'Mobile');
      } else if (/Infinix/i.test(ua)) {
        brand = 'Infinix Mobile';
      } else if (/TECNO/i.test(ua)) {
        brand = 'Tecno Mobile';
      } else if (/;\s([^;]+)\sBuild\//i.test(ua)) {
        var bMatch = ua.match(/;\s([^;]+)\sBuild\//i);
        brand = bMatch ? bMatch[1] : 'Android Smartphone';
      } else if (/Windows/i.test(ua)) {
        brand = 'PC / Laptop Desktop';
      } else if (/Macintosh/i.test(ua)) {
        brand = 'Apple Mac';
      }

      // 3. Deteksi Peramban / Browser
      if (/SamsungBrowser\/([0-9\.]+)/i.test(ua)) {
        browser = 'Samsung Internet';
      } else if (/Edg\/([0-9\.]+)/i.test(ua)) {
        browser = 'MS Edge';
      } else if (/Chrome\/([0-9\.]+)/i.test(ua) && !/Edg/i.test(ua)) {
        browser = 'Chrome';
      } else if (/Safari\/([0-9\.]+)/i.test(ua) && !/Chrome/i.test(ua)) {
        browser = 'Safari';
      } else if (/Firefox\/([0-9\.]+)/i.test(ua)) {
        browser = 'Firefox';
      }

      var fullInfo = brand + ' (' + os + ') · ' + browser;

      // Update Client Hints jika browser modern mendukung query model presisi
      if (navigator.userAgentData && navigator.userAgentData.getHighEntropyValues) {
        navigator.userAgentData.getHighEntropyValues(['model', 'platform', 'platformVersion'])
          .then(function(hints) {
            if (hints.model) {
              var refined = hints.model + ' (' + (hints.platform || os) + ') · ' + browser;
              $('#respDevicePlatform').val(refined);
              $('#rtkdDispDevice, #dispGpsDevice').text(refined);
            }
          }).catch(function() {});
      }

      return fullInfo;
    };

    // Helper: Resolusi Cepat Kecamatan Lokal (Offline Fallback)
    window.resolveLocalKecamatan = function(lat, lng) {
      lat = parseFloat(lat);
      lng = parseFloat(lng);
      if (isNaN(lat) || isNaN(lng)) return 'Banyuwangi';

      // Centroid 25 Kecamatan Banyuwangi
      var bwiCentroids = {
        'Banyuwangi': [-8.2192, 114.3692], 'Blimbingsari': [-8.3150, 114.3410],
        'Bangorejo': [-8.4891, 114.1878], 'Cluring': [-8.4412, 114.2389],
        'Gambiran': [-8.4023, 114.1489], 'Genteng': [-8.3689, 114.1523],
        'Giri': [-8.1923, 114.3512], 'Glagah': [-8.2056, 114.3289],
        'Glenmore': [-8.3089, 114.0489], 'Kabat': [-8.2789, 114.3312],
        'Kalibaru': [-8.2912, 113.9856], 'Kalipuro': [-8.1389, 114.3723],
        'Licin': [-8.2089, 114.2689], 'Muncar': [-8.4356, 114.3389],
        'Pesanggaran': [-8.5689, 114.0789], 'Purwoharjo': [-8.5023, 114.2312],
        'Rogojampi': [-8.3089, 114.2989], 'Sempu': [-8.3389, 114.1812],
        'Siliragung': [-8.5412, 114.1389], 'Singojuruh': [-8.3189, 114.2389],
        'Songgon': [-8.2389, 114.2089], 'Srono': [-8.3989, 114.2689],
        'Tegaldlimo': [-8.5389, 114.3989], 'Tegalsari': [-8.4389, 114.1189],
        'Wongsorejo': [-7.9889, 114.4089]
      };

      if (lat >= -8.85 && lat <= -7.80 && lng >= 113.80 && lng <= 114.65) {
        var minD = 999999, cKec = 'Banyuwangi';
        for (var k in bwiCentroids) {
          var d = Math.pow(lat - bwiCentroids[k][0], 2) + Math.pow(lng - bwiCentroids[k][1], 2);
          if (d < minD) { minD = d; cKec = k; }
        }
        return cKec;
      }

      // Centroid Malang Raya
      if (lat >= -8.15 && lat <= -7.85 && lng >= 112.50 && lng <= 112.75) {
        var mlgCentroids = {
          'Blimbing': [-7.9390, 112.6450],
          'Lowokwaru': [-7.9337, 112.6180],
          'Klojen': [-7.9780, 112.6310],
          'Sukun': [-7.9950, 112.6150],
          'Kedungkandang': [-7.9980, 112.6650]
        };
        var minD = 999999, cKec = 'Lowokwaru';
        for (var k in mlgCentroids) {
          var d = Math.pow(lat - mlgCentroids[k][0], 2) + Math.pow(lng - mlgCentroids[k][1], 2);
          if (d < minD) { minD = d; cKec = k; }
        }
        return cKec;
      }

      return 'Banyuwangi';
    };

    // Deteksi Sensor GPS Device & Pelacakan Perangkat Responden
    window.detectRespondentDeviceLocation = function(forcePrompt) {
      var $status = $('#respGpsBadgeStatus');
      var $dispDev = $('#dispGpsDevice');
      var $rtkdGps = $('#rtkdDispGps');
      var $rtkdDev = $('#rtkdDispDevice');
      var $rtkdBar = $('#rtkdDeviceGpsBar');

      // 1. Eksekusi Pelacakan Identitas Device
      var platformName = window.getDetailedDeviceInfo();
      $dispDev.text(platformName);
      $rtkdDev.text(platformName);
      $('#respDevicePlatform').val(platformName);

      // 2. Eksekusi Pengambilan Koordinat GPS Geolocation
      if ("geolocation" in navigator) {
        $status.html('<i class="fa-solid fa-spinner fa-spin"></i> Mendeteksi GPS...');
        $rtkdGps.html('<i class="fa-solid fa-spinner fa-spin"></i> Mendeteksi GPS satelit...');

        var options = {
          enableHighAccuracy: true,
          timeout: 10000,
          maximumAge: 0
        };

        navigator.geolocation.getCurrentPosition(
          function(position) {
            var lat = parseFloat(position.coords.latitude);
            var lng = parseFloat(position.coords.longitude);
            var acc = parseFloat(position.coords.accuracy || 6.5);
            if (isNaN(lat) || isNaN(lng) || !isFinite(lat) || !isFinite(lng)) {
              lat = -8.219234;
              lng = 114.369120;
            }
            if (isNaN(acc) || !isFinite(acc)) {
              acc = 6.5;
            }

            lat = Number(lat.toFixed(6));
            lng = Number(lng.toFixed(6));
            acc = Number(acc.toFixed(1));

            // Simpan ke input tersembunyi
            $('#respLatitude').val(lat);
            $('#respLongitude').val(lng);
            $('#respLokasiAccuracy').val(acc);

            // Update UI RTKD Bar Awal
            $rtkdBar.addClass('gps-locked');
            $rtkdGps.html('<span style="color: #16a34a; font-weight: 700;"><i class="fa-solid fa-spinner fa-spin"></i> Memetakan wilayah real...</span>');

            // Resolusi Real-time Nama Kecamatan dari Koordinat GPS Real
            $.ajax({
              url: BaseURL + 'IDE/resolve_coordinates',
              type: 'GET',
              data: { lat: lat, lng: lng },
              dataType: 'json',
              timeout: 4000,
              success: function(geoRes) {
                var kecReal = (geoRes && geoRes.kecamatan) ? geoRes.kecamatan : 'Banyuwangi';
                var kabReal = (geoRes && geoRes.kabupaten) ? geoRes.kabupaten : 'Kabupaten Banyuwangi';
                $('#respRealKecamatan').val(kecReal);
                $('#respRealKabupaten').val(kabReal);
                $('#respKecamatan').val(kecReal);

                var labelKec = kecReal.toLowerCase().startsWith('kec') ? kecReal : 'Kec. ' + kecReal;
                if (kabReal && kabReal.toLowerCase().indexOf('banyuwangi') === -1) {
                  labelKec += ' (' + kabReal + ')';
                }

                $rtkdGps.html('<span style="color: #16a34a; font-weight: 700;"><i class="fa-solid fa-location-dot"></i> ' + labelKec + '</span> <span style="font-size: 11px; color: #15803d; font-weight: 700;">(' + lat + ', ' + lng + ') (±' + acc + 'm)</span>');
              },
              error: function() {
                var localKec = window.resolveLocalKecamatan(lat, lng);
                $('#respRealKecamatan').val(localKec);
                $rtkdGps.html('<span style="color: #16a34a; font-weight: 700;"><i class="fa-solid fa-location-dot"></i> Kec. ' + localKec + '</span> <span style="font-size: 11px; color: #15803d; font-weight: 700;">(' + lat + ', ' + lng + ') (±' + acc + 'm)</span>');
              }
            });

            // Update UI Standar
            updateRespondentPinPosition(lat, lng, acc, 'GPS Terkunci Presisi (±' + acc + 'm)');
            $('#respGpsCard').css({ 'background': '#f0fdf4', 'border-color': '#86efac' });

            if (respFormMiniMapInstance && $('#respFormMiniMap').is(':visible') && $('#respFormMiniMap').width() > 0) {
              try {
                respFormMiniMapInstance.flyTo([lat, lng], 14, { duration: 1 });
              } catch(e) {}
            }
          },
          function(err) {
            var curKec = $('#respKecamatan').val() || 'Banyuwangi';
            var errMessage = 'Izin lokasi belum aktif';
            if (err.code === 1) errMessage = 'Akses GPS ditolak';
            else if (err.code === 2) errMessage = 'Sinyal GPS lemah';
            else if (err.code === 3) errMessage = 'Waktu GPS habis';

            $rtkdBar.removeClass('gps-locked');
            $rtkdGps.html('<span style="color: #d97706; font-weight: 700;"><i class="fa-solid fa-location-dot"></i> Kec. ' + curKec + '</span> <span style="font-size: 11px; color: #b45309;">(' + errMessage + ')</span>');

            if ($('#respKecamatan').val()) {
              focusMiniMapToKecamatan($('#respKecamatan').val());
            } else {
              updateRespondentPinPosition(-8.219234, 114.369120, 15.0, 'Pusat Kab. Banyuwangi');
            }

            if (forcePrompt) {
              Swal.fire({
                icon: 'info',
                title: 'Izin Lokasi (GPS)',
                html: '<p style="font-size: 13.5px; color: #475569; margin: 0;">Silakan izinkan akses lokasi pada browser/HP Anda agar koordinat tempat pengisian survei tercatat secara otomatis dan presisi di peta GIS Banyuwangi.</p>',
                confirmButtonColor: '#043168'
              });
            }
          },
          options
        );
      } else {
        var curKec = $('#respKecamatan').val() || 'Banyuwangi';
        $rtkdBar.removeClass('gps-locked');
        $rtkdGps.html('<span style="color: #64748b;"><i class="fa-solid fa-location-dot"></i> Kec. ' + curKec + ' (GPS Browser Non-Aktif)</span>');
        updateRespondentPinPosition(-8.219234, 114.369120, 15.0, 'Pusat Kab. Banyuwangi');
      }
    };

    // Sinkronisasi Pemilihan Kecamatan di Form Responden dengan Peta Mini
    $(document).on('change', '#respKecamatan', function() {
      var selKec = $(this).val();
      if (selKec) {
        focusMiniMapToKecamatan(selKec);
      }
    });


  </script>
  <script src="<?= base_url('assets/js/survei_offline_manager.js') ?>"></script>
</body>
</html>
