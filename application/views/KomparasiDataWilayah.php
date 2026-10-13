<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes" name="viewport">
  <title><?= $title ?? 'Komparasi Data Wilayah | IDE Consultant' ?></title>
  <meta content="Portal publik perbandingan dan komparasi indikator pembangunan antar daerah yang telah terverifikasi resmi oleh CV Inti Desain Ekonomi Consultant." name="description">
  <meta content="komparasi data wilayah, perbandingan indikator pembangunan, data terverifikasi daerah, ide consultant" name="keywords">

  <!-- Favicons -->
  <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets/img/android-chrome-192x192.png') ?>">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets/img/favicon-96x96.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/img/favicon-32x32.png') ?>">
  <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">

  <!-- Google Fonts: Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

  <!-- Bootstrap 4.6 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- Font Awesome Icons 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    :root {
      --lugx-blue: #043168;
      --lugx-blue-dark: #03254c;
      --lugx-red: #b40814;
      --lugx-red-hover: #960610;
      --lugx-dark: #1e293b;
      --lugx-gray: #64748b;
      --lugx-light-gray: #f8fafc;
      --lugx-border: #e2e8f0;
      --lugx-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      --lugx-radius: 20px;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
      line-height: 1.6;
      color: #1e293b;
      background: #f1f5f9;
      overflow-x: hidden;
      padding-top: 0;
    }

    a {
      text-decoration: none !important;
      transition: all 0.25s ease;
    }

    /* ================= HEADER & NAVIGATION (LUGX STANDARD) ================= */
    .header-area {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      background-color: var(--lugx-blue);
      box-shadow: 0 5px 20px rgba(4, 49, 104, 0.25);
      border-bottom-left-radius: 25px;
      border-bottom-right-radius: 25px;
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
      margin-bottom: 0;
      padding-left: 0;
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

    @media (max-width: 992px) {
      .main-nav {
        padding: 15px 25px;
        height: 80px;
      }
      .nav-menu {
        display: none;
      }
      .menu-toggle {
        display: flex;
      }
    }

    /* ==========================================================================
       SUBPAGE HERO BANNER (Lugx Curved Red-Navy Gradient & Animated Doodles)
       ========================================================================== */
    .subpage-banner {
      background: linear-gradient(135deg, rgba(180, 8, 20, 0.95) 0%, rgba(4, 49, 104, 0.96) 50%, rgba(8, 35, 75, 0.98) 100%);
      border-bottom-right-radius: 150px;
      border-bottom-left-radius: 150px;
      padding: 175px 0 120px 0;
      position: relative;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(4, 49, 104, 0.35);
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
      font-size: 46px;
      font-weight: 800;
      color: #ffffff;
      text-transform: uppercase;
      line-height: 1.25;
      margin-bottom: 16px;
      text-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }

    .subpage-banner h1 span {
      color: #ff6b75;
      text-shadow: 0 0 25px rgba(255, 107, 117, 0.6);
    }

    .subpage-banner p.lead-text {
      color: rgba(255, 255, 255, 0.92);
      font-size: 16px;
      max-width: 760px;
      margin: 0 auto 40px;
      line-height: 1.7;
    }

    /* Stats strip */
    .hero-stats-strip {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      max-width: 860px;
      margin: 0 auto;
    }

    .hero-stat-box {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.25);
      border-radius: 20px;
      padding: 18px 14px;
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

    @media (max-width: 992px) {
      .subpage-banner h1 {
        font-size: 36px;
      }
      .hero-stats-strip {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .subpage-banner {
        border-bottom-right-radius: 80px;
        border-bottom-left-radius: 80px;
        padding: 140px 0 90px 0;
      }
      .subpage-banner h1 {
        font-size: 28px;
      }
      .hero-stats-strip {
        grid-template-columns: 1fr 1fr;
      }
    }

    /* ================= SLOT CARD & TABLES ================= */
    .card-komparasi-box {
      border: none;
      border-radius: 20px;
      background: #ffffff;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04);
      transition: all 0.25s ease;
    }

    .slot-daerah-box {
      border-radius: 14px;
      padding: 16px;
      border: 1.5px solid transparent;
      transition: all 0.2s;
    }
    .slot-daerah-box.slot-1 { background: #f0f9ff; border-color: #bae6fd; border-left: 5px solid #0284c7; }
    .slot-daerah-box.slot-2 { background: #f0fdf4; border-color: #bbf7d0; border-left: 5px solid #10b981; }
    .slot-daerah-box.slot-3 { background: #fffbeb; border-color: #fde68a; border-left: 5px solid #f59e0b; }

    /* Override Autofill Browser pada Input Pencarian */
    #searchKomparasiIndikator:-webkit-autofill,
    #searchKomparasiIndikator:-webkit-autofill:hover, 
    #searchKomparasiIndikator:-webkit-autofill:focus {
      -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
      -webkit-text-fill-color: #1e293b !important;
      transition: background-color 5000s ease-in-out 0s;
    }

    /* Styling Tabel Komparasi */
    .table-komparasi {
      border-collapse: separate;
      border-spacing: 0;
      width: 100%;
      font-size: 12.5px;
    }
    .table-komparasi th {
      background-color: #f8fafc;
      color: #1e293b;
      font-weight: 700;
      text-align: center;
      vertical-align: middle !important;
      border: 1px solid #e2e8f0;
      padding: 10px 8px;
    }
    .table-komparasi th.th-daerah-1 { background-color: #e0f2fe; color: #0369a1; border-top: 3px solid #0284c7; }
    .table-komparasi th.th-daerah-2 { background-color: #dcfce7; color: #15803d; border-top: 3px solid #10b981; }
    .table-komparasi th.th-daerah-3 { background-color: #fef3c7; color: #b45309; border-top: 3px solid #f59e0b; }

    .table-komparasi td {
      border: 1px solid #e2e8f0;
      vertical-align: middle !important;
      padding: 8px 10px;
    }
    .table-komparasi td.cell-kategori-merged {
      background-color: #f8fafc !important;
      font-weight: 800;
      color: #043168;
      vertical-align: middle !important;
      border-right: 2px solid #cbd5e1 !important;
    }
    .table-komparasi tr.tr-category-start td {
      border-top: 2px solid #94a3b8 !important;
    }
    .table-komparasi tr:hover td {
      background-color: #f8fafc;
    }

    /* ==========================================================================
       FOOTER & CONTACT SECTION (Lugx Navy Gradient Footer Standard)
       ========================================================================== */
    .footer-area {
      background: linear-gradient(135deg, #043168 0%, #0a3d7c 50%, #082852 100%);
      color: #ffffff;
      padding: 90px 0 30px 0;
      border-top-left-radius: 120px;
      border-top-right-radius: 120px;
      position: relative;
      box-shadow: 0 -10px 30px rgba(4, 49, 104, 0.3);
      margin-top: 80px;
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
      padding-left: 0;
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
      box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
      z-index: 999;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .whatsapp-float:hover {
      background-color: #1ebc57;
      transform: scale(1.1);
      box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
      color: #ffffff;
    }

    @media (max-width: 992px) {
      .footer-grid {
        grid-template-columns: 1fr;
        gap: 40px;
      }
    }

    @media (max-width: 768px) {
      .footer-area {
        border-top-left-radius: 60px;
        border-top-right-radius: 60px;
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

    @media (max-width: 768px) {
      .login-modal-grid {
        grid-template-columns: 1fr;
      }
      .login-banner-side {
        display: none;
      }
      .login-form-side {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

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
          <a href="<?= base_url('#services') ?>" class="nav-item-link">Layanan <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
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

        <!-- Red Action Button -->
        <li class="main-button">
          <?php if (!empty($isLoggedIn)): ?>
            <a href="<?= base_url('Staf') ?>"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
          <?php else: ?>
            <a href="#" onclick="openModal('signInModal'); return false;"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
          <?php endif; ?>
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
      <a href="<?= base_url('MenuSurvei') ?>">Survei Kepuasan SKM</a>
      <a href="<?= base_url('MasterData') ?>">Repositori Data</a>
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
      <?php if (!empty($isLoggedIn)): ?>
        <a href="<?= base_url('Staf') ?>"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
      <?php else: ?>
        <a href="#" onclick="openModal('signInModal'); closeMobileMenu(); return false;"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
      <?php endif; ?>
    </div>
  </div>
  <div class="mobile-nav-overlay" id="menuOverlay" onclick="closeMobileMenu()"></div>

  <!-- SUBPAGE HERO BANNER (LUGX SIGNATURE) -->
  <section class="subpage-banner">
    <!-- Floating Vector Doodle Accents -->
    <i class="fa-solid fa-code-compare cta-doodle doodle-1"></i>
    <i class="fa-solid fa-chart-line cta-doodle doodle-2"></i>
    <i class="fa-solid fa-building-columns cta-doodle doodle-3"></i>
    <i class="fa-solid fa-chart-pie cta-doodle doodle-4"></i>
    <i class="fa-solid fa-star cta-doodle doodle-5"></i>
    <i class="fa-solid fa-shield-halved cta-doodle doodle-6"></i>

    <div class="banner-container">
      <h1>Komparasi Data <span>Wilayah</span></h1>
      <p class="lead-text">
        Silakan bandingkan indikator pembangunan makro daerah berdampingan secara objektif, transparan, dan terukur berdasarkan data resmi yang telah divalidasi dan diverifikasi.
      </p>

      <!-- Stats Summary Strip -->
      <div class="hero-stats-strip">
        <div class="hero-stat-box">
          <span class="hero-stat-val">3 Daerah</span>
          <span class="hero-stat-lbl">Komparasi Berdampingan</span>
        </div>
        <div class="hero-stat-box">
          <span class="hero-stat-val">100%</span>
          <span class="hero-stat-lbl">Objektif &amp; Terverifikasi</span>
        </div>
        <div class="hero-stat-box">
          <span class="hero-stat-val">Analisis</span>
          <span class="hero-stat-lbl">Multi-Indikator Makro</span>
        </div>
        <div class="hero-stat-box">
          <span class="hero-stat-val">Visual</span>
          <span class="hero-stat-lbl">Grafik &amp; Matriks Tabel</span>
        </div>
      </div>
    </div>
  </section>

  <!-- MAIN CONTAINER (FULL-WIDTH) -->
  <main class="container-fluid px-3 px-md-4 px-xl-5 py-4" style="margin-top: 35px; position: relative; z-index: 10;">

    <!-- CARD 1: PILIH DAERAH KOMPARASI (SLOT 1, SLOT 2, SLOT 3) -->
    <div class="card card-komparasi-box mb-4">
      <div class="card-body p-4">
        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap" style="gap: 8px;">
          <div>
            <h5 class="font-weight-bold text-dark mb-0" style="font-size: 15px;">
              <i class="fa-solid fa-code-compare text-primary mr-1"></i> Pilih Daerah yang Dikomparasikan (Maksimal 3 Daerah):
            </h5>
            <small class="text-muted">Pilih 2 atau 3 daerah pada slot di bawah untuk memulai komparasi data terverifikasi.</small>
          </div>
          <span class="badge badge-light border text-muted px-2.5 py-1.5" style="font-size: 11px;">
            <i class="fa-solid fa-circle-info text-info mr-1"></i> Hanya data terverifikasi yang ditampilkan
          </span>
        </div>

        <div class="row">
          <!-- Slot 1 (Biru) -->
          <div class="col-md-4 mb-3 mb-md-0">
            <div class="slot-daerah-box slot-1">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold" style="font-size: 11.5px; color: #0369a1; text-transform: uppercase;">
                  <i class="fa-solid fa-location-dot mr-1"></i> Daerah 1 (Utama)
                </span>
                <span class="badge badge-primary px-2 py-0.5" style="font-size: 10px; background: #0284c7;">Slot 1</span>
              </div>
              <select class="form-control form-control-sm font-weight-bold" id="slotDaerah1" style="border-radius: 8px; height: 38px; font-size: 13px;">
                <option value="" selected>-- Pilih Daerah 1 --</option>
                <?php if (!empty($daerah_list)): ?>
                  <?php foreach ($daerah_list as $dl): ?>
                    <option value="<?= $dl['Id'] ?>">
                      <?= htmlspecialchars($dl['NamaDaerah']) ?>
                    </option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
          </div>

          <!-- Slot 2 (Hijau) -->
          <div class="col-md-4 mb-3 mb-md-0">
            <div class="slot-daerah-box slot-2">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold" style="font-size: 11.5px; color: #047857; text-transform: uppercase;">
                  <i class="fa-solid fa-location-dot mr-1"></i> Daerah 2
                </span>
                <span class="badge badge-success px-2 py-0.5" style="font-size: 10px; background: #10b981;">Slot 2</span>
              </div>
              <select class="form-control form-control-sm font-weight-bold" id="slotDaerah2" style="border-radius: 8px; height: 38px; font-size: 13px;">
                <option value="" selected>-- Pilih Daerah 2 --</option>
                <?php if (!empty($daerah_list)): ?>
                  <?php foreach ($daerah_list as $dl): ?>
                    <option value="<?= $dl['Id'] ?>">
                      <?= htmlspecialchars($dl['NamaDaerah']) ?>
                    </option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
          </div>

          <!-- Slot 3 (Oranye) -->
          <div class="col-md-4">
            <div class="slot-daerah-box slot-3">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold" style="font-size: 11.5px; color: #b45309; text-transform: uppercase;">
                  <i class="fa-solid fa-location-dot mr-1"></i> Daerah 3 (Opsional)
                </span>
                <span class="badge badge-warning text-dark px-2 py-0.5" style="font-size: 10px; background: #fde68a;">Slot 3</span>
              </div>
              <select class="form-control form-control-sm font-weight-bold" id="slotDaerah3" style="border-radius: 8px; height: 38px; font-size: 13px;">
                <option value="" selected>-- Kosong / Pilih Daerah 3 --</option>
                <?php if (!empty($daerah_list)): ?>
                  <?php foreach ($daerah_list as $dl): ?>
                    <option value="<?= $dl['Id'] ?>"><?= htmlspecialchars($dl['NamaDaerah']) ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top flex-wrap" style="gap: 10px;">
          <span id="compareMetaNotice" class="text-muted font-italic" style="font-size: 12px;">
            <i class="fa-solid fa-circle-info mr-1 text-primary"></i> Data komparasi otomatis dimuat saat daerah dipilih pada slot di atas.
          </span>
        </div>
      </div>
    </div>

    <!-- CARD 2: FILTER & PENCARIAN INDIKATOR -->
    <div class="card card-komparasi-box mb-4">
      <div class="card-body p-4">
        <div class="row align-items-center">
          <div class="col-md-3 mb-2 mb-md-0">
            <label class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Filter Kategori:</label>
            <select class="form-control" id="filterKomparasiKategori" style="border-radius: 8px; height: 38px; font-size: 12.5px;">
              <option value="ALL">Semua Kategori (Pilar 1 - 5)</option>
              <option value="GEOGRAFI DAN DEMOGRAFI (KEPENDUDUKAN)">1. GEOGRAFI & DEMOGRAFI</option>
              <option value="KESEJAHTERAAN MASYARAKAT (SOSIAL)">2. KESEJAHTERAAN MASYARAKAT</option>
              <option value="INFRASTRUKTUR DAN PELAYANAN UMUM">3. INFRASTRUKTUR & PELAYANAN UMUM</option>
              <option value="EKONOMI DAN DAYA SAING DAERAH">4. EKONOMI & DAYA SAING</option>
              <option value="KAPASITAS KEUANGAN DAERAH">5. KAPASITAS KEUANGAN DAERAH</option>
            </select>
          </div>

          <div class="col-md-3 mb-2 mb-md-0">
            <label class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Filter Sub-Kategori:</label>
            <select class="form-control" id="filterKomparasiSub" style="border-radius: 8px; height: 38px; font-size: 12.5px;">
              <option value="ALL">Semua Sub-Kategori</option>
            </select>
          </div>

          <div class="col-md-3 mb-2 mb-md-0">
            <label class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Tampilan Kolom Tahun:</label>
            <select class="form-control" id="filterKomparasiTahun" style="border-radius: 8px; height: 38px; font-size: 12.5px;">
              <option value="ALL">Semua Kolom Tahun</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Cari Indikator:</label>
            <div class="input-group">
              <input type="search" class="form-control" id="searchKomparasiIndikator" name="filter_cari_indikator_query" placeholder="Ketik nama indikator..." autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" value="" style="border-radius: 8px 0 0 8px; height: 38px; font-size: 12.5px;">
              <div class="input-group-append">
                <button type="button" class="btn btn-outline-light border text-muted" id="btnClearSearchIndikator" title="Hapus pencarian" style="border-radius: 0 8px 8px 0; background: #ffffff; display: none;">
                  <i class="fa-solid fa-xmark"></i>
                </button>
                <span class="input-group-text bg-white" id="iconSearchIndikator" style="border-radius: 0 8px 8px 0;">
                  <i class="fa-solid fa-magnifying-glass text-muted"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- NOTICE KETIKA BELUM ADA DAERAH DIPILIH -->
    <div id="initialPickNotice" class="card card-komparasi-box mb-4 text-center p-5 shadow-sm">
      <div class="mx-auto mb-3" style="width: 68px; height: 68px; border-radius: 50%; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 28px;">
        <i class="fa-solid fa-map-location-dot"></i>
      </div>
      <h5 class="font-weight-bold text-dark mb-1" style="font-size: 18px;">Pilih Daerah yang Dikomparasikan</h5>
      <p class="text-muted mx-auto mb-0" style="font-size: 13.5px; max-width: 600px; line-height: 1.6;">
        Silakan pilih minimal 1 daerah (maksimal 3 daerah) pada slot pilihan di atas, kemudian klik tombol <b>Terapkan Komparasi Daerah</b> untuk menampilkan grafik visualisasi dan tabel komparasi indikator terverifikasi.
      </p>
    </div>

    <!-- LOADING INDICATOR -->
    <div id="loadingKomparasi" class="text-center py-5 card card-komparasi-box mb-4" style="display: none;">
      <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="sr-only">Memuat...</span>
      </div>
      <p class="font-weight-bold text-dark mt-3 mb-0" style="font-size: 14px;">Memuat Matriks Komparasi Indikator Terverifikasi...</p>
    </div>

    <!-- EMPTY NOTICE JIKA BELUM ADA DATA -->
    <div id="emptyKomparasiNotice" class="card card-komparasi-box mb-4 text-center p-5" style="display: none;">
      <div class="mx-auto mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 26px;">
        <i class="fa-solid fa-circle-exclamation"></i>
      </div>
      <h5 class="font-weight-bold text-dark mb-1">Belum Ada Data Terverifikasi</h5>
      <p class="text-muted mb-0" style="font-size: 13.5px;" id="msgEmptyNotice">
        Indikator untuk daerah yang dipilih belum memiliki data berstatus terverifikasi.
      </p>
    </div>

    <!-- RESULT CONTAINER (GRAFIK & TABEL) -->
    <div id="containerKomparasiResult" style="display: none;">

      <!-- CARD 3: GRAFIK VISUALISASI (LINE, BAR, PIE DENGAN ANGKA LANGSUNG) -->
      <div class="card card-komparasi-box mb-4" id="cardKomparasiGrafik">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between flex-wrap pb-3 mb-3 border-bottom" style="gap: 12px;">
            <div class="d-flex align-items-center" style="gap: 10px;">
              <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(2, 132, 199, 0.1); color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                <i class="fa-solid fa-chart-line"></i>
              </div>
              <div>
                <h5 class="font-weight-bold text-dark mb-0" style="font-size: 16px;">
                  Grafik Visualisasi Komparasi Indikator Daerah
                </h5>
                <small class="text-muted" id="lblKomparasiInfoRingkasChart">Perbandingan indikator pembangunan resmi antar daerah.</small>
              </div>
            </div>

            <!-- Kontrol Tipe Chart & Satuan -->
            <div class="d-flex align-items-center flex-wrap" style="gap: 10px;">
              <span class="badge badge-light border p-2" id="badgeSatuanChart" style="font-size: 12px; border-radius: 8px;">
                Satuan: <b class="text-primary" id="lblSatuanChart">-</b>
              </span>
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-sm btn-primary active btn-toggle-chart-type" data-type="line" id="btnTypeLine" style="border-radius: 8px 0 0 8px; font-weight: 700; padding: 6px 14px;">
                  <i class="fa-solid fa-chart-line mr-1"></i> Line (Garis)
                </button>
                <button type="button" class="btn btn-sm btn-outline-primary btn-toggle-chart-type" data-type="bar" id="btnTypeBar" style="border-radius: 0; font-weight: 700; padding: 6px 14px;">
                  <i class="fa-solid fa-chart-column mr-1"></i> Bar (Batang)
                </button>
                <button type="button" class="btn btn-sm btn-outline-primary btn-toggle-chart-type" data-type="pie" id="btnTypePie" style="border-radius: 0 8px 8px 0; font-weight: 700; padding: 6px 14px;">
                  <i class="fa-solid fa-chart-pie mr-1"></i> Pie (Bulat)
                </button>
              </div>
            </div>
          </div>

          <!-- Selector Indikator Terpilih -->
          <div class="p-3 mb-3 rounded" style="background: #f8fafc; border: 1.5px solid #e2e8f0;">
            <label class="font-weight-bold text-dark mb-1" style="font-size: 12px;">
              <i class="fa-solid fa-chart-simple text-primary mr-1"></i> Pilih Indikator yang Ditampilkan dalam Grafik:
            </label>
            <select class="form-control font-weight-bold" id="selectChartIndikator" style="border-radius: 8px; font-size: 13px; height: 38px;">
              <!-- Diisi via JS -->
            </select>
          </div>

          <!-- Stat Cards Indikator Terpilih -->
          <div class="row mb-3" id="containerStatCardsChart"></div>

          <!-- Canvas Grafik Utama Tren & Komparasi -->
          <div class="card border p-4 shadow-sm" style="border-radius: 16px; background: #ffffff; padding: 22px 24px 28px 24px;">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div>
                <h6 class="font-weight-bold text-dark mb-0" style="font-size: 15px;" id="titleMainChart">
                  Grafik Tren Waktu Antar Daerah
                </h6>
                <small class="text-muted font-italic" id="subTitleMainChart">Pergerakan angka per tahun dari masing-masing daerah.</small>
              </div>
            </div>
            <div style="position: relative; height: 380px; width: 100%; margin-bottom: 12px;">
              <canvas id="canvasKomparasiChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- CARD 4: TABEL MATRIKS KOMPARASI INDIKATOR -->
      <div class="card card-komparasi-box mb-4" id="cardKomparasiTabel">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between flex-wrap pb-3 mb-3 border-bottom" style="gap: 12px;">
            <div class="d-flex align-items-center" style="gap: 10px;">
              <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                <i class="fa-solid fa-table-cells"></i>
              </div>
              <div>
                <div class="d-flex align-items-center" style="gap: 8px;">
                  <h5 class="font-weight-bold text-dark mb-0" style="font-size: 16px;">
                    Matriks Perbandingan Indikator Lengkap
                  </h5>
                  <span class="badge badge-light border text-muted" id="badgeTotalRowsKomparasi" style="font-size: 12px; padding: 4px 10px;">0 Baris</span>
                  <span class="badge" id="badgeTahunKomparasiAktif" style="font-size: 12px; padding: 4px 10px; background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; font-weight: 700; display: none;">Semua Tahun</span>
                </div>
                <small class="text-muted" id="lblKomparasiInfoRingkas">Data terverifikasi berdampingan antar daerah.</small>
              </div>
            </div>

            <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
              <div class="d-flex align-items-center border rounded px-2" style="background: #f8fafc; height: 34px;">
                <label for="filterTabelTahunKomparasi" class="font-weight-bold text-dark mb-0" style="font-size: 12px; white-space: nowrap;">
                  <i class="fa-regular fa-calendar mr-1 text-primary"></i> Tahun Tabel:
                </label>
                <select class="form-control form-control-sm border-0 font-weight-bold" id="filterTabelTahunKomparasi" style="height: 30px; font-size: 12.5px; min-width: 150px; background: transparent; cursor: pointer; color: #0f172a; padding: 0 4px;">
                  <option value="ALL">Semua Kolom Tahun</option>
                </select>
              </div>

              <button type="button" class="btn btn-sm btn-outline-secondary" id="btnExportCsvKomparasi" style="border-radius: 8px; font-weight: 600; font-size: 12px; padding: 7px 14px;">
                <i class="fa-solid fa-file-csv mr-1 text-success"></i> Unduh CSV
              </button>
              <button type="button" class="btn btn-sm btn-outline-primary" id="btnPrintKomparasi" style="border-radius: 8px; font-weight: 600; font-size: 12px; padding: 7px 14px;">
                <i class="fa-solid fa-print mr-1"></i> Cetak Laporan
              </button>
            </div>
          </div>

          <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
            <table class="table table-hover table-bordered table-sm mb-0 table-komparasi" id="tabelKomparasiData">
              <thead id="theadKomparasi"></thead>
              <tbody id="tbodyKomparasi"></tbody>
            </table>
          </div>
        </div>
      </div>

    </div> <!-- /containerKomparasiResult -->

  </main>

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
        <p>Copyright © <?= date('Y') ?> CV Inti Desain Ekonomi Consultant. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp Button -->
  <a href="https://wa.me/6282227666283?text=Halo%20Admin%20IDE%20Consultant,%20saya%20ingin%20bertanya%20mengenai%20komparasi%20data..." 
     class="whatsapp-float" 
     target="_blank" 
     rel="noopener noreferrer"
     aria-label="Chat via WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
  </a>

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

          <form class="login-form-body" id="formSignInModal" autocomplete="on" onsubmit="return false;">
            <div class="form-group-custom">
              <label class="form-label-custom">Username / ID Akun</label>
              <div class="input-icon-wrapper">
                <i class="fa-solid fa-user input-icon"></i>
                <input type="text" class="form-input-custom" id="Username" name="username" autocomplete="username" placeholder="Masukkan username Anda">
              </div>
            </div>

            <div class="form-group-custom">
              <label class="form-label-custom">Kata Sandi / Password</label>
              <div class="input-icon-wrapper">
                <i class="fa-solid fa-lock input-icon"></i>
                <input type="password" class="form-input-custom" id="Password" name="password" autocomplete="current-password" placeholder="Masukkan password Anda">
              </div>
            </div>

            <button type="button" class="btn-login-large" id="Masuk">
              <i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
  var BaseURL = '<?= base_url() ?>';

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

  // Modal Helpers
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

  window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
      closeModal(event.target.id);
    }
  };

  $(document).ready(function() {

    // Login Form Handlers (#Masuk)
    $('#Username, #Password').keypress(function(event) {
      if (event.which === 13) {
        event.preventDefault();
        $("#Masuk").click();
      }
    });

    $("#Masuk").click(function(e) {
      e.preventDefault();

      var username = $.trim($("#Username").val());
      var password = $.trim($("#Password").val());

      if (!username || !password) {
        Swal.fire({
          title: 'Form Belum Lengkap',
          text: 'Silakan isi Username dan Password akun Anda terlebih dahulu.',
          icon: 'warning',
          confirmButtonColor: '#b40814'
        });
        return;
      }

      var $btn = $(this);
      var originalText = $btn.html();
      $btn.prop("disabled", true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memvalidasi Akses...');

      $.post(BaseURL + "IDE/SignIn", { Username: username, Password: password })
        .done(function(response) {
          var trimmed = $.trim(response);
          if (trimmed === '1') {
            window.location = BaseURL + "SuperAdmin";
          } else if (trimmed === '2') {
            window.location = BaseURL + "Admin";
          } else if (trimmed === '3') {
            window.location = BaseURL + "Staf";
          } else if (trimmed === '4') {
            window.location = BaseURL + "Surveiyor";
          } else if (trimmed === '0') {
            window.location = BaseURL + "Econk";
          } else {
            Swal.fire({
              title: 'Autentikasi Gagal',
              text: trimmed || 'Username atau Kata Sandi salah. Silakan periksa kembali.',
              icon: 'error',
              confirmButtonColor: '#b40814'
            });
            $btn.prop("disabled", false).html(originalText);
          }
        })
        .fail(function() {
          Swal.fire({
            title: 'Koneksi Terputus',
            text: 'Gagal terhubung ke server. Silakan coba kembali sesaat lagi.',
            icon: 'error',
            confirmButtonColor: '#b40814'
          });
          $btn.prop("disabled", false).html(originalText);
        });
    });

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

    window.closeMobileMenu = function() {
      if (mobileNav && menuOverlay) {
        mobileNav.classList.remove('active');
        menuOverlay.classList.remove('active');
        document.body.style.overflow = '';
      }
    };

    if (menuToggle) {
      menuToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        if (mobileNav && mobileNav.classList.contains('active')) {
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

    // =========================================================================
    // PLUGIN CHART DATA LABELS (MENAMPILKAN ANGKA DI DALAM DIAGRAM)
    // =========================================================================
    var cvideDataLabelsPlugin = {
      id: 'cvideDataLabels',
      afterDatasetsDraw: function(chart) {
        var ctx = chart.ctx;
        var chartType = chart.config.type;

        if (chartType === 'pie' || chartType === 'doughnut') {
          var dataset = chart.data.datasets[0];
          if (!dataset || !dataset.data) return;
          var meta = chart.getDatasetMeta(0);
          if (!meta || !meta.data) return;

          var total = dataset.data.reduce(function(a, b) {
            return a + (typeof b === 'number' && !isNaN(b) && b > 0 ? b : 0);
          }, 0);

          meta.data.forEach(function(element, index) {
            var val = dataset.data[index];
            if (val === null || val === undefined || isNaN(val) || val <= 0) return;

            var startAngle = element.startAngle;
            var endAngle = element.endAngle;
            var angleDiff = endAngle - startAngle;
            if (angleDiff < 0.16) return; // Irisan terlalu kecil

            var innerRadius = element.innerRadius || 0;
            var outerRadius = element.outerRadius;
            var midAngle = (startAngle + endAngle) / 2;
            var midRadius = innerRadius + (outerRadius - innerRadius) * 0.55;
            var posX = element.x + Math.cos(midAngle) * midRadius;
            var posY = element.y + Math.sin(midAngle) * midRadius;

            var pct = total > 0 ? ((val / total) * 100).toFixed(1) + '%' : '';
            var formattedVal = (Math.round(val) === val) ? String(val) : String(parseFloat(val.toFixed(2)));

            ctx.save();
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.shadowColor = 'rgba(0, 0, 0, 0.8)';
            ctx.shadowBlur = 6;
            ctx.fillStyle = '#ffffff';

            if (angleDiff > 0.42) {
              ctx.font = 'bold 13px system-ui, -apple-system, sans-serif';
              ctx.fillText(formattedVal, posX, posY - 7);
              ctx.font = 'bold 11px system-ui, -apple-system, sans-serif';
              ctx.fillText('(' + pct + ')', posX, posY + 8);
            } else {
              ctx.font = 'bold 12px system-ui, -apple-system, sans-serif';
              ctx.fillText(formattedVal, posX, posY);
            }
            ctx.restore();
          });
        } else if (chartType === 'bar') {
          chart.data.datasets.forEach(function(ds, dsIdx) {
            var meta = chart.getDatasetMeta(dsIdx);
            if (!meta || !meta.data || meta.hidden) return;

            meta.data.forEach(function(bar, idx) {
              var val = ds.data[idx];
              if (val === null || val === undefined || isNaN(val)) return;

              if (bar.width && bar.width < 14) return;

              var formattedVal = (Math.round(val) === val) ? String(val) : String(parseFloat(val.toFixed(2)));
              var posX = bar.x;
              var isNearTop = chart.chartArea && (bar.y - 14 < chart.chartArea.top);
              var posY = isNearTop ? (bar.y + 14) : (bar.y - 5);

              ctx.save();
              ctx.textAlign = 'center';
              ctx.textBaseline = isNearTop ? 'top' : 'bottom';
              ctx.font = 'bold 11px system-ui, -apple-system, sans-serif';
              if (isNearTop) {
                ctx.fillStyle = '#ffffff';
                ctx.shadowColor = 'rgba(0, 0, 0, 0.7)';
                ctx.shadowBlur = 4;
              } else {
                ctx.fillStyle = '#1e293b';
                ctx.shadowColor = 'rgba(255, 255, 255, 0.95)';
                ctx.shadowBlur = 3;
              }
              ctx.fillText(formattedVal, posX, posY);
              ctx.restore();
            });
          });
        } else if (chartType === 'line') {
          chart.data.datasets.forEach(function(ds, dsIdx) {
            var meta = chart.getDatasetMeta(dsIdx);
            if (!meta || !meta.data || meta.hidden) return;

            meta.data.forEach(function(point, idx) {
              var val = ds.data[idx];
              if (val === null || val === undefined || isNaN(val)) return;

              var formattedVal = (Math.round(val) === val) ? String(val) : String(parseFloat(val.toFixed(2)));
              var posX = point.x;
              var posY = point.y - 8;

              ctx.save();
              ctx.textAlign = 'center';
              ctx.textBaseline = 'bottom';
              ctx.font = 'bold 11px system-ui, -apple-system, sans-serif';
              ctx.fillStyle = ds.borderColor || '#0f172a';
              ctx.shadowColor = 'rgba(255, 255, 255, 0.95)';
              ctx.shadowBlur = 4;
              ctx.fillText(formattedVal, posX, posY);
              ctx.restore();
            });
          });
        }
      }
    };

    // =========================================================================
    // STATE & VARIABLES KOMPARASI
    // =========================================================================
    var _komparasiData = null;
    var _chartInstanceTrend = null;
    var _currentChartType = 'line';

    function escapeHtml(text) {
      if (!text) return '';
      return String(text)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    }

    // Toggle tipe chart Line vs Bar vs Pie
    $(document).on('click', '.btn-toggle-chart-type', function() {
      var type = $(this).data('type');
      _currentChartType = type;
      $('.btn-toggle-chart-type').removeClass('btn-primary active').addClass('btn-outline-primary');
      $(this).removeClass('btn-outline-primary').addClass('btn-primary active');
      renderKomparasiCharts();
    });

    function updateCompareMetaNotice() {
      var s1 = $('#slotDaerah1').val();
      var s2 = $('#slotDaerah2').val();
      var s3 = $('#slotDaerah3').val();
      var picked = [s1, s2, s3].filter(function(v) { return v && v !== ''; });
      var unique = [];
      picked.forEach(function(id) {
        if (unique.indexOf(id) === -1) unique.push(id);
      });

      if (unique.length === 0) {
        $('#compareMetaNotice').html('<i class="fa-solid fa-circle-info mr-1 text-primary"></i> Data komparasi otomatis dimuat saat daerah dipilih pada slot di atas.');
      } else {
        $('#compareMetaNotice').html('<b class="text-primary">' + unique.length + ' daerah dipilih.</b> Data komparasi otomatis diperbarui.');
      }
    }

    $('#slotDaerah1, #slotDaerah2, #slotDaerah3').on('change', function() {
      updateCompareMetaNotice();
      var s1 = $('#slotDaerah1').val();
      var s2 = $('#slotDaerah2').val();
      var s3 = $('#slotDaerah3').val();
      var picked = [s1, s2, s3].filter(function(v) { return v && v !== ''; });
      if (picked.length > 0) {
        loadKomparasiData();
      } else {
        $('#initialPickNotice').show();
        $('#loadingKomparasi').hide();
        $('#emptyKomparasiNotice').hide();
        $('#containerKomparasiResult').hide();
      }
    });

    // Otomatis load saat halaman pertama dibuka jika ada slot terpilih
    if ($('#slotDaerah1').val() || $('#slotDaerah2').val()) {
      $('#initialPickNotice').hide();
      loadKomparasiData();
    } else {
      $('#initialPickNotice').show();
    }

    function loadKomparasiData() {
      var s1 = $('#slotDaerah1').val();
      var s2 = $('#slotDaerah2').val();
      var s3 = $('#slotDaerah3').val();

      var picked = [s1, s2, s3].filter(function(v) { return v && v !== ''; });
      var unique = [];
      picked.forEach(function(id) {
        if (unique.indexOf(id) === -1) unique.push(id);
      });

      if (unique.length === 0) {
        $('#initialPickNotice').show();
        $('#loadingKomparasi').hide();
        $('#emptyKomparasiNotice').hide();
        $('#containerKomparasiResult').hide();
        return;
      }

      $('#initialPickNotice').hide();
      $('#loadingKomparasi').show();
      $('#emptyKomparasiNotice').hide();
      $('#containerKomparasiResult').hide();

      $.ajax({
        url: '<?= base_url("IDE/GetKomparasiDataPublik") ?>',
        type: 'POST',
        data: { daerah_ids: unique.join(',') },
        dataType: 'json',
        success: function(res) {
          $('#loadingKomparasi').hide();
          if (res && res.status === 'success') {
            _komparasiData = res;

            if (!res.rows || res.rows.length === 0) {
              $('#emptyKomparasiNotice').show();
              var daerahNames = (res.regions && res.regions.length > 0)
                ? res.regions.map(function(r){ return r.NamaDaerah; }).join(', ')
                : 'daerah yang dipilih';
              $('#msgEmptyNotice').html('Daerah yang dipilih (<b>' + escapeHtml(daerahNames) + '</b>) saat ini belum memiliki data indikator yang berstatus <b>Terverifikasi</b> (masih berstatus Diproses atau Belum Sesuai). Hanya indikator yang sudah terverifikasi resmi yang ditampilkan pada portal publik.');
              return;
            }

            $('#containerKomparasiResult').show();
            initKomparasiFilters();
            renderKomparasiCharts();
            renderKomparasiTable();
          } else {
            $('#emptyKomparasiNotice').show();
            $('#msgEmptyNotice').text(res.message || 'Gagal memuat data komparasi.');
          }
        },
        error: function(xhr, status, error) {
          $('#loadingKomparasi').hide();
          $('#emptyKomparasiNotice').show();
          $('#msgEmptyNotice').text('Terjadi kendala saat memuat data dari server. Silakan periksa koneksi atau coba kembali.');
          console.error(error);
        }
      });
    }

    function initKomparasiFilters() {
      if (!_komparasiData) return;

      var master = _komparasiData.master_kategori || {};
      var allYears = _komparasiData.all_years || [];

      // 1. Tahun
      var thnHtml = '<option value="ALL">Semua Kolom Tahun</option>';
      allYears.forEach(function(y) {
        thnHtml += '<option value="' + y + '">Tahun ' + y + '</option>';
      });
      $('#filterKomparasiTahun').html(thnHtml);
      $('#filterTabelTahunKomparasi').html(thnHtml);

      // 2. Sub-Kategori
      updateSubKategoriOptions();
      updateChartIndikatorOptions();
    }

    function updateSubKategoriOptions() {
      if (!_komparasiData) return;
      var katVal = $('#filterKomparasiKategori').val();
      var subSel = $('#filterKomparasiSub');
      subSel.empty();
      subSel.append('<option value="ALL">Semua Sub-Kategori</option>');

      var subList = [];
      if (_komparasiData.rows) {
        _komparasiData.rows.forEach(function(r) {
          if ((katVal === 'ALL' || r.Kategori === katVal) && r.SubKategori) {
            if (subList.indexOf(r.SubKategori) === -1) {
              subList.push(r.SubKategori);
            }
          }
        });
      }

      subList.forEach(function(s) {
        subSel.append('<option value="' + escapeHtml(s) + '">' + escapeHtml(s) + '</option>');
      });
    }

    $('#filterKomparasiKategori').on('change', function() {
      updateSubKategoriOptions();
      updateChartIndikatorOptions();
      renderKomparasiCharts();
      renderKomparasiTable();
    });

    $('#filterKomparasiSub').on('change', function() {
      updateChartIndikatorOptions();
      renderKomparasiCharts();
      renderKomparasiTable();
    });

    $('#filterKomparasiTahun').on('change', function() {
      renderKomparasiCharts();
    });

    $('#filterTabelTahunKomparasi').on('change', function() {
      renderKomparasiTable();
    });

    // Cegah dan bersihkan autofill browser pada input pencarian indikator
    function cleanSearchAutofill() {
      var $search = $('#searchKomparasiIndikator');
      // Jika browser mengisi dengan username seperti 'admin' secara otomatis
      if ($search.val() === 'admin') {
        $search.val('');
        $('#btnClearSearchIndikator').hide();
        $('#iconSearchIndikator').show();
        if (_komparasiData && typeof renderKomparasiTable === 'function') {
          renderKomparasiTable();
        }
      }
    }

    // Jalankan pembersihan saat DOM siap dan setelah jeda autofill browser
    $('#searchKomparasiIndikator').val('');
    setTimeout(cleanSearchAutofill, 50);
    setTimeout(cleanSearchAutofill, 250);
    setTimeout(cleanSearchAutofill, 600);

    $('#searchKomparasiIndikator').on('input change', function() {
      var val = $(this).val();
      if (val && val.length > 0) {
        $('#btnClearSearchIndikator').show();
        $('#iconSearchIndikator').hide();
      } else {
        $('#btnClearSearchIndikator').hide();
        $('#iconSearchIndikator').show();
      }
      renderKomparasiTable();
    });

    $('#btnClearSearchIndikator').on('click', function() {
      $('#searchKomparasiIndikator').val('').focus();
      $(this).hide();
      $('#iconSearchIndikator').show();
      renderKomparasiTable();
    });

    $('#selectChartIndikator').on('change', function() {
      renderKomparasiCharts();
    });

    function updateChartIndikatorOptions(selectedNama) {
      if (!_komparasiData || !_komparasiData.rows) return;
      var sel = $('#selectChartIndikator');
      var curVal = selectedNama || sel.val();
      sel.empty();

      var selectedKat = $('#filterKomparasiKategori').val();
      var selectedSub = $('#filterKomparasiSub').val();

      var availableRows = _komparasiData.rows.filter(function(r) {
        if (selectedKat !== 'ALL' && r.Kategori !== selectedKat) return false;
        if (selectedSub !== 'ALL' && r.SubKategori !== selectedSub) return false;
        return true;
      });

      if (availableRows.length === 0) availableRows = _komparasiData.rows;

      availableRows.forEach(function(r) {
        var opt = $('<option></option>').attr('value', r.NamaIndikator).text(r.NamaIndikator + ' (' + (r.SubKategori || '-') + ')');
        sel.append(opt);
      });

      if (curVal && sel.find('option[value="' + curVal + '"]').length) {
        sel.val(curVal);
      } else if (availableRows.length > 0) {
        sel.val(availableRows[0].NamaIndikator);
      }
    }

    // Klik tombol grafik di baris tabel langsung loncat ke visualisasi indikator tersebut
    $(document).on('click', '.btn-lihat-chart-row', function(e) {
      e.preventDefault();
      var namaInd = $(this).data('nama');
      if (namaInd) {
        $('#selectChartIndikator').val(namaInd);
        renderKomparasiCharts();
        if ($('#cardKomparasiGrafik').length) {
          $('html, body').animate({ scrollTop: $('#cardKomparasiGrafik').offset().top - 100 }, 300);
        }
      }
    });

    // =========================================================================
    // RENDER GRAFIK KOMPARASI (LINE, BAR, PIE)
    // =========================================================================
    function renderKomparasiCharts() {
      if (typeof Chart === 'undefined') return;
      if (!_komparasiData || !_komparasiData.rows || !_komparasiData.regions) return;

      var targetName = $('#selectChartIndikator').val();
      var targetRow = null;
      for (var i = 0; i < _komparasiData.rows.length; i++) {
        if (_komparasiData.rows[i].NamaIndikator === targetName) {
          targetRow = _komparasiData.rows[i];
          break;
        }
      }
      if (!targetRow && _komparasiData.rows.length > 0) {
        targetRow = _komparasiData.rows[0];
      }
      if (!targetRow) return;

      $('#lblSatuanChart').text(targetRow.Satuan || '-');

      var regions = _komparasiData.regions;
      var allYears = _komparasiData.all_years || [];

      var colorSchemes = [
        { border: '#0284c7', bg: 'rgba(2, 132, 199, 0.25)', badge: 'background: #0284c7; color: #fff;' },
        { border: '#10b981', bg: 'rgba(16, 185, 129, 0.25)', badge: 'background: #10b981; color: #fff;' },
        { border: '#f59e0b', bg: 'rgba(245, 158, 11, 0.25)', badge: 'background: #f59e0b; color: #fff;' }
      ];

      // 1. Stat Cards
      var statCardsHtml = '';
      var chartYearVal = $('#filterKomparasiTahun').val();
      var activeChartYear = (chartYearVal && chartYearVal !== 'ALL') ? chartYearVal : (allYears.length > 0 ? allYears[allYears.length - 1] : null);

      regions.forEach(function(r, idx) {
        var c = colorSchemes[idx % colorSchemes.length];
        var valLatest = (activeChartYear && targetRow.Values && targetRow.Values[r.Id] && targetRow.Values[r.Id][activeChartYear] !== undefined) ? targetRow.Values[r.Id][activeChartYear] : '-';

        statCardsHtml += 
          '<div class="col-md-' + (12 / regions.length) + ' mb-2">' +
            '<div class="p-3 rounded shadow-sm border" style="background: #ffffff; border-top: 4px solid ' + c.border + ' !important;">' +
              '<div class="d-flex align-items-center justify-content-between mb-1">' +
                '<span class="badge px-2 py-1 font-weight-bold" style="' + c.badge + '; font-size: 11px; border-radius: 6px;">' + escapeHtml(r.NamaDaerah) + '</span>' +
                '<small class="text-muted font-weight-bold">Tahun ' + (activeChartYear || '-') + '</small>' +
              '</div>' +
              '<div class="d-flex align-items-baseline justify-content-between mt-2">' +
                '<div style="font-size: 22px; font-weight: 800; color: #1e293b;">' + (valLatest !== '-' ? valLatest : '<span class="text-muted font-italic">-</span>') + '</div>' +
                '<div class="text-muted" style="font-size: 12px; font-weight: 600;">' + escapeHtml(targetRow.Satuan || '') + '</div>' +
              '</div>' +
            '</div>' +
          '</div>';
      });

      $('#containerStatCardsChart').html(statCardsHtml);

      // 2. Render Main Chart (canvasKomparasiChart)
      if (_chartInstanceTrend) {
        _chartInstanceTrend.destroy();
        _chartInstanceTrend = null;
      }

      var ctxTrend = document.getElementById('canvasKomparasiChart');
      if (ctxTrend) {
        if (_currentChartType === 'pie') {
          var pieLabels = [];
          var pieData = [];
          var pieColors = [];

          regions.forEach(function(r, idx) {
            var c = colorSchemes[idx % colorSchemes.length];
            pieLabels.push(r.NamaDaerah);

            var raw = (activeChartYear && targetRow.Values && targetRow.Values[r.Id] && targetRow.Values[r.Id][activeChartYear] !== undefined) ? targetRow.Values[r.Id][activeChartYear] : null;
            if (raw !== null && raw !== '') {
              var parsed = parseFloat(String(raw).replace(',', '.'));
              pieData.push(!isNaN(parsed) ? parsed : 0);
            } else {
              pieData.push(0);
            }
            pieColors.push(c.border);
          });

          var pieYearText = activeChartYear ? 'Tahun ' + activeChartYear : 'Data Terbaru';
          var yearBadgePie = ' <span class="badge badge-info ml-2 px-2 py-1" style="font-size: 11px; background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; font-weight: 700;">' + pieYearText + '</span>';
          $('#titleMainChart').html('<i class="fa-solid fa-chart-pie text-primary mr-1"></i> Perbandingan Daerah (Diagram Bulat): ' + escapeHtml(targetRow.NamaIndikator) + (targetRow.Satuan ? ' (' + escapeHtml(targetRow.Satuan) + ')' : '') + yearBadgePie);
          $('#subTitleMainChart').html('Proporsi komparasi indikator antar daerah pada <b>' + pieYearText + '</b>.');

          _chartInstanceTrend = new Chart(ctxTrend.getContext('2d'), {
            type: 'pie',
            data: {
              labels: pieLabels,
              datasets: [{
                label: targetRow.NamaIndikator,
                data: pieData,
                backgroundColor: pieColors,
                borderColor: '#ffffff',
                borderWidth: 2,
                hoverOffset: 8
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  position: 'top',
                  labels: { font: { weight: 'bold', size: 12 }, padding: 15 }
                },
                tooltip: {
                  backgroundColor: 'rgba(15, 23, 42, 0.9)',
                  padding: 12,
                  titleFont: { size: 13, weight: 'bold' },
                  bodyFont: { size: 12 },
                  callbacks: {
                    label: function(context) {
                      var val = context.raw;
                      var total = context.dataset.data.reduce(function(a, b) {
                        return a + (typeof b === 'number' && !isNaN(b) ? b : 0);
                      }, 0);
                      var pct = '';
                      if (total > 0 && typeof val === 'number' && val > 0) {
                        pct = ' (' + ((val / total) * 100).toFixed(1) + '%)';
                      }
                      return ' ' + context.label + ': ' + (val !== null && val !== undefined ? val : '-') + (targetRow.Satuan ? ' ' + targetRow.Satuan : '') + pct;
                    }
                  }
                }
              }
            },
            plugins: [cvideDataLabelsPlugin]
          });
        } else {
          // Line or Bar
          var datasetsTrend = [];
          regions.forEach(function(r, idx) {
            var c = colorSchemes[idx % colorSchemes.length];
            var dataPoints = [];
            var pointRadii = [];
            var pointHoverRadii = [];

            allYears.forEach(function(y) {
              var raw = (targetRow.Values && targetRow.Values[r.Id] && targetRow.Values[r.Id][y] !== undefined) ? targetRow.Values[r.Id][y] : null;
              if (raw !== null && raw !== '') {
                var parsed = parseFloat(String(raw).replace(',', '.'));
                dataPoints.push(!isNaN(parsed) ? parsed : null);
              } else {
                dataPoints.push(null);
              }

              if (chartYearVal && chartYearVal !== 'ALL' && String(y) === String(chartYearVal)) {
                pointRadii.push(9);
                pointHoverRadii.push(12);
              } else {
                pointRadii.push(5);
                pointHoverRadii.push(8);
              }
            });

            datasetsTrend.push({
              label: r.NamaDaerah,
              data: dataPoints,
              borderColor: c.border,
              backgroundColor: c.bg,
              borderWidth: 3,
              tension: 0,
              fill: (_currentChartType === 'line' ? false : true),
              pointRadius: pointRadii,
              pointHoverRadius: pointHoverRadii,
              spanGaps: true
            });
          });

          var allNums = [];
          datasetsTrend.forEach(function(ds) {
            ds.data.forEach(function(val) {
              if (val !== null && !isNaN(val)) allNums.push(val);
            });
          });

          var minVal = allNums.length > 0 ? Math.min.apply(null, allNums) : 0;
          var maxVal = allNums.length > 0 ? Math.max.apply(null, allNums) : 100;

          var yMin = 0;
          var yMax = undefined;
          var stepSize = undefined;
          var isTruncatedZero = false;

          if (minVal > 15) {
            var span = maxVal - minVal;
            stepSize = span <= 15 ? 5 : 10;
            var roundedFloor = Math.floor(minVal / stepSize) * stepSize;
            yMin = roundedFloor - stepSize;
            yMax = Math.ceil((maxVal + 2) / stepSize) * stepSize;
            isTruncatedZero = true;
          } else {
            yMin = 0;
          }

          var chartIcon = (_currentChartType === 'bar' ? 'fa-chart-column' : 'fa-chart-line');
          var focusBadge = (chartYearVal && chartYearVal !== 'ALL') ? ' <span class="badge badge-info ml-2 px-2 py-1" style="font-size: 11px; background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; font-weight: 700;">Tahun ' + chartYearVal + '</span>' : '';
          $('#titleMainChart').html('<i class="fa-solid ' + chartIcon + ' text-primary mr-1"></i> Tren Komparasi: ' + escapeHtml(targetRow.NamaIndikator) + (targetRow.Satuan ? ' (' + escapeHtml(targetRow.Satuan) + ')' : '') + focusBadge);
          $('#subTitleMainChart').html('Pergerakan angka per tahun dari masing-masing daerah.');

          _chartInstanceTrend = new Chart(ctxTrend.getContext('2d'), {
            type: _currentChartType,
            data: {
              labels: allYears,
              datasets: datasetsTrend
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              interaction: { mode: 'index', intersect: false },
              plugins: {
                legend: {
                  position: 'top',
                  labels: { font: { weight: 'bold', size: 12 }, padding: 15 }
                },
                tooltip: {
                  backgroundColor: 'rgba(15, 23, 42, 0.9)',
                  padding: 12,
                  titleFont: { size: 13, weight: 'bold' },
                  bodyFont: { size: 12 },
                  callbacks: {
                    label: function(context) {
                      var val = context.parsed.y !== null ? context.parsed.y : '-';
                      return ' ' + context.dataset.label + ': ' + val + (targetRow.Satuan ? ' ' + targetRow.Satuan : '');
                    }
                  }
                }
              },
              scales: {
                y: {
                  min: yMin,
                  max: yMax,
                  grace: '8%',
                  grid: { color: '#f1f5f9' },
                  ticks: {
                    stepSize: stepSize,
                    font: { weight: '600' },
                    callback: function(value) {
                      if (isTruncatedZero && value === yMin) {
                        return '0';
                      }
                      return value;
                    }
                  }
                },
                x: {
                  grid: { display: false },
                  ticks: { font: { weight: '700' } }
                }
              }
            },
            plugins: [cvideDataLabelsPlugin]
          });
        }
      }
    }

    // =========================================================================
    // RENDER TABEL MATRIKS KOMPARASI
    // =========================================================================
    function renderKomparasiTable() {
      if (!_komparasiData || !_komparasiData.rows || !_komparasiData.regions) return;

      var regions = _komparasiData.regions;
      var allYears = _komparasiData.all_years || [];

      var selKat = $('#filterKomparasiKategori').val();
      var selSub = $('#filterKomparasiSub').val();
      var selThn = $('#filterTabelTahunKomparasi').val();
      var search = ($('#searchKomparasiIndikator').val() || '').trim().toLowerCase();

      var displayYears = (selThn && selThn !== 'ALL') ? [selThn] : allYears;

      if (selThn && selThn !== 'ALL') {
        $('#badgeTahunKomparasiAktif').text('Tahun ' + selThn).show();
      } else {
        $('#badgeTahunKomparasiAktif').hide();
      }

      // Saring baris data
      var filteredRows = _komparasiData.rows.filter(function(r) {
        if (selKat !== 'ALL' && r.Kategori !== selKat) return false;
        if (selSub !== 'ALL' && r.SubKategori !== selSub) return false;
        if (search) {
          var textMatch = (r.NamaIndikator + ' ' + (r.SubKategori || '') + ' ' + (r.Kategori || '')).toLowerCase();
          if (textMatch.indexOf(search) === -1) return false;
        }
        return true;
      });

      $('#badgeTotalRowsKomparasi').text(filteredRows.length + ' Baris');

      // 1. Bangun THEAD
      var theadHtml = '<tr>';
      theadHtml += '<th rowspan="2" style="width: 45px; text-align: center;">No</th>';
      theadHtml += '<th rowspan="2" style="min-width: 170px;">Kategori</th>';
      theadHtml += '<th rowspan="2" style="min-width: 150px;">Sub-Kategori</th>';
      theadHtml += '<th rowspan="2" style="min-width: 260px;">Nama Indikator</th>';
      theadHtml += '<th rowspan="2" style="width: 90px; text-align: center;">Satuan</th>';

      regions.forEach(function(r, idx) {
        var thClass = 'th-daerah-' + (idx + 1);
        theadHtml += '<th colspan="' + displayYears.length + '" class="' + thClass + '" style="text-align: center;">' + escapeHtml(r.NamaDaerah) + '</th>';
      });

      theadHtml += '<th rowspan="2" style="width: 70px; text-align: center;">Grafik</th>';
      theadHtml += '</tr>';

      // Baris kedua Thead: Kolom Tahun
      theadHtml += '<tr>';
      regions.forEach(function(r, idx) {
        var thClass = 'th-daerah-' + (idx + 1);
        displayYears.forEach(function(y) {
          theadHtml += '<th class="' + thClass + '" style="min-width: 65px; font-size: 11px; text-align: center;">' + y + '</th>';
        });
      });
      theadHtml += '</tr>';

      $('#theadKomparasi').html(theadHtml);

      // 2. Bangun TBODY
      if (filteredRows.length === 0) {
        var colSpanTotal = 5 + (regions.length * displayYears.length) + 1;
        $('#tbodyKomparasi').html('<tr><td colspan="' + colSpanTotal + '" class="text-center py-4 text-muted font-italic">Tidak ada indikator yang sesuai dengan filter.</td></tr>');
        return;
      }

      // Hitung rowSpan kategori & subkategori
      var katCounts = {};
      var subCounts = {};
      filteredRows.forEach(function(r) {
        katCounts[r.Kategori] = (katCounts[r.Kategori] || 0) + 1;
        var subKey = r.Kategori + '|||' + r.SubKategori;
        subCounts[subKey] = (subCounts[subKey] || 0) + 1;
      });

      var seenKat = {};
      var seenSub = {};
      var tbodyHtml = '';

      filteredRows.forEach(function(r, idx) {
        var subKey = r.Kategori + '|||' + r.SubKategori;
        var isNewKat = !seenKat[r.Kategori];
        var isNewSub = !seenSub[subKey];

        var rowClass = isNewKat ? 'tr-category-start' : '';
        tbodyHtml += '<tr class="' + rowClass + '">';

        // Kolom No
        tbodyHtml += '<td class="text-center font-weight-bold" style="color: #64748b;">' + (idx + 1) + '</td>';

        // Kolom Kategori (Merged)
        if (isNewKat) {
          tbodyHtml += '<td class="cell-kategori-merged" rowspan="' + katCounts[r.Kategori] + '">' + escapeHtml(r.Kategori) + '</td>';
          seenKat[r.Kategori] = true;
        }

        // Kolom Sub-Kategori (Merged)
        if (isNewSub) {
          tbodyHtml += '<td rowspan="' + subCounts[subKey] + '" style="font-weight: 600; color: #334155; vertical-align: middle;">' + escapeHtml(r.SubKategori) + '</td>';
          seenSub[subKey] = true;
        }

        // Nama Indikator
        tbodyHtml += '<td style="font-weight: 500; color: #0f172a;">' + escapeHtml(r.NamaIndikator) + '</td>';

        // Satuan
        tbodyHtml += '<td class="text-center text-muted" style="font-size: 11.5px;">' + escapeHtml(r.Satuan || '-') + '</td>';

        // Kolom Nilai per Daerah
        regions.forEach(function(reg, rIdx) {
          displayYears.forEach(function(y) {
            var val = (r.Values && r.Values[reg.Id] && r.Values[reg.Id][y] !== undefined && r.Values[reg.Id][y] !== '') ? r.Values[reg.Id][y] : '-';
            var cellStyle = (val !== '-') ? 'font-weight: 700; color: #0f172a;' : 'color: #94a3b8; font-style: italic;';
            tbodyHtml += '<td class="text-center" style="' + cellStyle + '">' + escapeHtml(val) + '</td>';
          });
        });

        // Tombol Lihat Grafik Indikator
        tbodyHtml += 
          '<td class="text-center">' +
            '<button type="button" class="btn btn-xs btn-outline-primary btn-lihat-chart-row py-1 px-2" data-nama="' + escapeHtml(r.NamaIndikator) + '" title="Tampilkan indikator ini di grafik" style="border-radius: 6px; font-size: 11px;">' +
              '<i class="fa-solid fa-chart-line"></i>' +
            '</button>' +
          '</td>';

        tbodyHtml += '</tr>';
      });

      $('#tbodyKomparasi').html(tbodyHtml);
    }

    // Export CSV Komparasi
    $('#btnExportCsvKomparasi').on('click', function() {
      var table = document.getElementById('tabelKomparasiData');
      if (!table) return;

      var csv = [];
      for (var i = 0; i < table.rows.length; i++) {
        var row = [];
        var cols = table.rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
          var cleanText = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, ' ').replace(/"/g, '""').trim();
          row.push('"' + cleanText + '"');
        }
        csv.push(row.join(','));
      }

      var csvString = '\uFEFF' + csv.join('\n');
      var blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
      var link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.setAttribute('download', 'komparasi_wilayah_terverifikasi.csv');
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    });

    // =========================================================================
    // CETAK LAPORAN KOMPARASI
    // =========================================================================
    $('#btnPrintKomparasi').on('click', function() {
      if (!_komparasiData || !_komparasiData.regions) {
        alert('Data komparasi belum tersedia untuk dicetak.');
        return;
      }

      var d1 = $('#slotDaerah1 option:selected').text();
      var d2 = $('#slotDaerah2 option:selected').text();
      var d3 = $('#slotDaerah3').val() ? $('#slotDaerah3 option:selected').text() : '';
      var indikatorAktif = $('#selectChartIndikator option:selected').text() || 'Seluruh Indikator';
      var tahunFilter = $('#filterTabelTahunKomparasi option:selected').text() || 'Semua Tahun';

      var daerahListStr = [d1, d2, d3].filter(function(v) { 
        return v && v !== '' && v.indexOf('--') === -1; 
      }).join(' vs ');

      var canvas1 = document.getElementById('canvasKomparasiChart');
      var imgChart1 = '';
      if (canvas1) {
        try {
          imgChart1 = canvas1.toDataURL('image/png');
        } catch(e) { console.error('Gagal mengambil gambar canvas 1:', e); }
      }

      var tabelHtml = '';
      if ($('#tabelKomparasiData').length) {
        var $tabelClone = $('#tabelKomparasiData').clone();
        $tabelClone.find('.btn-lihat-chart-row, button, .btn').remove();
        tabelHtml = $tabelClone.prop('outerHTML');
      }

      var now = new Date();
      var tglStr = now.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }) + ', ' +
                   now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' WIB';

      var printDoc = 
        '<!DOCTYPE html>' +
        '<html>' +
        '<head>' +
          '<meta charset="utf-8">' +
          '<title>Komparasi Indikator Daerah</title>' +
          '<style>' +
            '@page { size: landscape; margin: 12mm 15mm; }' +
            '* { box-sizing: border-box; }' +
            'body { font-family: "Segoe UI", Arial, sans-serif; font-size: 11px; color: #1e293b; margin: 0; padding: 15px; background: #ffffff; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }' +
            '.header-print { border-bottom: 2.5px solid #043168; padding-bottom: 10px; margin-bottom: 14px; display: flex; justify-content: space-between; align-items: flex-end; }' +
            '.header-print h2 { margin: 0 0 4px 0; font-size: 18px; color: #043168; font-weight: 800; letter-spacing: 0.3px; }' +
            '.header-print .sub-info { font-size: 13px; font-weight: 700; color: #334155; margin-top: 2px; }' +
            '.header-print .meta-desc { font-size: 11px; color: #64748b; margin-top: 3px; }' +
            '.header-right { text-align: right; font-size: 10.5px; color: #475569; line-height: 1.45; }' +
            '.section-title { font-size: 13px; font-weight: 700; color: #043168; margin: 16px 0 8px 0; padding-bottom: 4px; border-bottom: 1.5px solid #e2e8f0; }' +
            '.chart-box { text-align: center; margin-bottom: 16px; page-break-inside: avoid; }' +
            '.chart-img { max-width: 100%; height: auto; max-height: 350px; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px; background: #fff; }' +
            'table { width: 100%; border-collapse: collapse; font-size: 10px; margin-top: 6px; page-break-inside: auto; }' +
            'tr { page-break-inside: avoid; page-break-after: auto; }' +
            'th, td { border: 1px solid #cbd5e1; padding: 5px 6px; vertical-align: middle; }' +
            'thead th { background-color: #043168 !important; color: #ffffff !important; font-weight: 700; text-align: center; font-size: 10.5px; }' +
            'tbody tr:nth-child(even) { background-color: #f8fafc !important; }' +
            '.cell-kategori-merged { background-color: #f1f5f9 !important; font-weight: 800; color: #043168; vertical-align: middle !important; border: 1.5px solid #94a3b8 !important; border-right: 2px solid #64748b !important; }' +
            'tr.tr-category-start td { border-top: 2.5px solid #043168 !important; }' +
            '.text-center { text-align: center; }' +
            '.footer-print { margin-top: 14px; border-top: 1px solid #e2e8f0; padding-top: 6px; display: flex; justify-content: space-between; align-items: center; font-size: 9.5px; color: #94a3b8; }' +
          '</style>' +
        '</head>' +
        '<body>' +
          '<div class="header-print">' +
            '<div>' +
              '<h2>Laporan Komparasi Indikator Daerah (Terverifikasi)</h2>' +
              '<div class="sub-info">Perbandingan: ' + daerahListStr + '</div>' +
              '<div class="meta-desc">Indikator Dianalisis: <b>' + indikatorAktif + '</b> &nbsp;|&nbsp; Filter: ' + tahunFilter + '</div>' +
            '</div>' +
            '<div class="header-right">' +
              '<div><b>Sistem CVIDE - IDE Consultant</b></div>' +
              '<div>Dicetak: ' + tglStr + '</div>' +
            '</div>' +
          '</div>';

      if (imgChart1) {
        printDoc += 
          '<div class="section-title">1. Grafik Visualisasi Indikator</div>' +
          '<div class="chart-box">' +
            '<img class="chart-img" src="' + imgChart1 + '" alt="Grafik Komparasi Indikator">' +
          '</div>';
      }

      if (tabelHtml) {
        printDoc += 
          '<div class="section-title" style="margin-top: 20px;">' + (imgChart1 ? '2.' : '1.') + ' Matriks Perbandingan Data Indikator Lengkap</div>' +
          tabelHtml;
      }

      printDoc += 
          '<div class="footer-print">' +
            '<div>Dokumen Resmi Komparasi Indikator Pembangunan Daerah - CVIDE</div>' +
            '<div>Portal Publik - Data Terverifikasi</div>' +
          '</div>' +
        '</body>' +
        '</html>';

      var printWin = window.open('', '_blank', 'width=1100,height=750,top=50,left=50');
      if (printWin) {
        printWin.document.open();
        printWin.document.write(printDoc);
        printWin.document.close();
        printWin.focus();
        setTimeout(function() {
          printWin.print();
        }, 600);
      }
    });

  });
  </script>
</body>
</html>
