<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Portal Layanan & Instrumen Survei - IDE Consultant</title>

  <!-- Favicon & Fonts -->
  <link rel="icon" type="image/png" sizes="192x192" href="<?=base_url('assets/img/android-chrome-192x192.png')?>">
  <link rel="icon" type="image/png" sizes="96x96" href="<?=base_url('assets/img/favicon-96x96.png')?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/img/favicon-32x32.png')?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/img/apple-touch-icon.png')?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Core CSS & Icons -->
  <link href="<?=base_url('vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="<?=base_url('build/css/custom.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/datatables-bs4/css/dataTables.bootstrap4.css')?>" rel="stylesheet">

  <!-- Leaflet CSS & JS for Watermark-Free Google Maps & OpenStreetMap Tiles -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <!-- Chart.js for Auto-Generated Data Visualizations (Donat, Batang, Lingkaran) -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- RTKD Multi-Instrument Dynamic Survey Stylesheet & Engine -->
  <link rel="stylesheet" href="<?= base_url('assets/css/survei_rtkd.css') ?>?v=<?= time() ?>">
  <script src="<?= base_url('assets/js/survei_rtkd_engine.js') ?>?v=<?= time() ?>"></script>
  <script src="<?= base_url('assets/js/survei_offline_manager.js') ?>?v=<?= time() ?>"></script>

  <!-- Enterprise Theme Styling (Selaras Dashboard Admin) -->
  <style>
    :root {
      --ide-navy: #043168;
      --ide-navy-dark: #021e42;
      --ide-navy-light: #0a3d7c;
      --ide-red: #b40814;
      --ide-red-coral: #ee626b;
      --ide-dark: #151d2a;
      --ide-bg: #f4f6fa;
      --ide-card-bg: #ffffff;
      --ide-border: #e2e8f0;
      --ide-radius: 16px;
      --ide-shadow: 0 10px 30px rgba(4, 49, 104, 0.08);
      --lugx-blue: #0284c7;
      --lugx-dark: #0f172a;
    }

    body.nav-md {
      font-family: 'Poppins', sans-serif;
      background-color: var(--ide-bg);
      color: #334155;
    }

    .container.body {
      width: 100% !important;
      padding: 0 !important;
      margin: 0 !important;
      max-width: 100% !important;
    }

    .main_container {
      background-color: var(--ide-bg) !important;
      min-height: 100vh !important;
      position: relative !important;
    }

    /* Sidebar Left Column (Navy Gradient) */
    .col-md-3.left_col,
    .left_col {
      background: linear-gradient(180deg, var(--ide-navy) 0%, var(--ide-navy-dark) 100%) !important;
      box-shadow: 4px 0 25px rgba(0, 0, 0, 0.15);
      position: absolute !important;
      top: 0 !important;
      bottom: 0 !important;
      left: 0 !important;
      height: 100% !important;
      min-height: 100% !important;
      z-index: 100 !important;
    }

    .left_col.scroll-view {
      width: 100% !important;
      min-height: 100% !important;
      height: 100% !important;
    }

    /* Sidebar Brand Header */
    .sidebar-brand-header {
      padding: 20px 15px 12px 15px;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .sidebar-brand-header img {
      height: 48px;
      max-height: 48px;
      width: auto;
      object-fit: contain;
      filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
    }

    /* Sidebar Navigation Links */
    .sidebar-menu-title {
      color: rgba(255, 255, 255, 0.5);
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      padding: 15px 25px 5px 25px;
    }

    .nav.side-menu > li > a {
      color: rgba(255, 255, 255, 0.85) !important;
      font-weight: 500;
      font-size: 14px;
      padding: 13px 20px;
      border-left: 4px solid transparent;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .nav.side-menu > li > a i {
      font-size: 16px;
      width: 24px;
      text-align: center;
      color: var(--ide-red-coral);
      transition: transform 0.3s ease;
    }

    .nav.side-menu > li:hover > a,
    .nav.side-menu > li.active > a {
      background: rgba(255, 255, 255, 0.12) !important;
      color: #ffffff !important;
      border-left-color: var(--ide-red);
    }

    .nav.side-menu > li:hover > a i {
      transform: scale(1.15);
    }

    .nav.child_menu {
      background: rgba(0, 0, 0, 0.2) !important;
      padding: 5px 0;
    }

    .nav.child_menu li a {
      color: rgba(255, 255, 255, 0.75) !important;
      font-size: 13px;
      font-weight: 500;
      padding: 10px 20px 10px 55px;
      transition: all 0.25s ease;
    }

    .nav.child_menu li a:hover,
    .nav.child_menu li.current-page a {
      color: var(--ide-red-coral) !important;
      background: rgba(255, 255, 255, 0.05);
    }

    /* Top Navbar: Seragam dengan Dashboard Utama */
    .main_container .top_nav,
    .top_nav {
      margin-left: 230px !important;
      position: relative !important;
      display: block !important;
      height: 70px !important;
      min-height: 70px !important;
      clear: both !important;
      z-index: 100 !important;
      margin-bottom: 0 !important;
    }

    .main_container .top_nav .nav_menu,
    .top_nav .nav_menu {
      background: linear-gradient(135deg, var(--ide-navy) 0%, var(--ide-navy-light) 100%) !important;
      border-bottom: none !important;
      padding: 0 25px !important;
      height: 70px !important;
      min-height: 70px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      box-shadow: 0 4px 20px rgba(4, 49, 104, 0.15) !important;
      float: none !important;
      clear: both !important;
      width: 100% !important;
    }

    .top-nav-left {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    #menu_toggle {
      color: #ffffff;
      font-size: 20px;
      cursor: pointer;
      padding: 8px 12px;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.1);
      transition: all 0.3s ease;
    }

    #menu_toggle:hover {
      background: var(--ide-red);
      color: #ffffff;
    }

    .top-nav-right {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .admin-top-greeting {
      color: #ffffff;
      font-size: 13px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .btn-header-logout {
      background-color: var(--ide-red);
      color: #ffffff !important;
      font-size: 13px;
      font-weight: 600;
      padding: 8px 20px;
      border-radius: 20px;
      box-shadow: 0 4px 12px rgba(180, 8, 20, 0.4);
      transition: all 0.3s ease;
      text-decoration: none !important;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-header-logout:hover {
      background-color: #d10916;
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(180, 8, 20, 0.6);
    }

    /* Main Right Content Area */
    .main_container .right_col,
    .right_col {
      background-color: var(--ide-bg) !important;
      padding: 28px 30px 50px 30px !important;
      min-height: calc(100vh - 70px) !important;
      margin-left: 230px !important;
      clear: both !important;
      position: relative !important;
    }

    /* Collapsed State Smooth Adjustments (Show Only Logo Icon & Menu Icons) */
    body.nav-sm .col-md-3.left_col,
    body.nav-sm .left_col {
      width: 75px !important;
      min-width: 75px !important;
      opacity: 1 !important;
      visibility: visible !important;
      overflow: visible !important;
    }

    body.nav-sm .top_nav {
      margin-left: 75px !important;
    }

    body.nav-sm .right_col {
      margin-left: 75px !important;
    }

    body.nav-sm .sidebar-brand-header {
      justify-content: center;
      padding: 15px 5px;
    }

    body.nav-sm .sidebar-brand-header img {
      display: block !important;
      opacity: 1 !important;
      visibility: visible !important;
      max-height: 34px !important;
      width: auto !important;
      margin: 0 auto;
    }

    body.nav-sm .sidebar-menu-title,
    body.nav-sm .nav.side-menu > li > a b,
    body.nav-sm .nav.side-menu > li > a span {
      display: none !important;
      opacity: 0 !important;
      visibility: hidden !important;
    }

    body.nav-sm .nav.side-menu > li > a {
      text-align: center;
      padding: 15px 5px;
      justify-content: center;
    }

    body.nav-sm .nav.side-menu > li > a i {
      display: inline-block !important;
      opacity: 1 !important;
      visibility: visible !important;
      font-size: 18px !important;
      margin: 0 auto;
      width: auto !important;
    }

    /* Mobile Drawer Off-Canvas System */
    .sidebar-mobile-backdrop {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(4, 30, 66, 0.6);
      backdrop-filter: blur(4px);
      z-index: 1040;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .btn-sidebar-close {
      display: none;
      position: absolute;
      right: 15px;
      top: 15px;
      background: rgba(255, 255, 255, 0.15);
      border: none;
      color: #ffffff;
      width: 32px;
      height: 32px;
      border-radius: 8px;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      cursor: pointer;
    }

    @media (max-width: 991.98px) {
      .main_container .top_nav,
      .top_nav,
      body.nav-sm .top_nav {
        margin-left: 0 !important;
        width: 100% !important;
        height: 60px !important;
        min-height: 60px !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 1030 !important;
      }

      .main_container .top_nav .nav_menu,
      .top_nav .nav_menu {
        height: 60px !important;
        min-height: 60px !important;
        padding: 0 16px !important;
      }

      .main_container .right_col,
      .right_col,
      body.nav-sm .right_col {
        margin-left: 0 !important;
        width: 100% !important;
        padding: 20px 14px 40px 14px !important;
        min-height: calc(100vh - 60px) !important;
      }

      .col-md-3.left_col,
      .left_col,
      body.nav-sm .col-md-3.left_col,
      body.nav-sm .left_col {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        bottom: 0 !important;
        height: 100vh !important;
        width: 270px !important;
        max-width: 85vw !important;
        z-index: 1050 !important;
        transform: translateX(-100%) !important;
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
      }

      body.mobile-nav-open .col-md-3.left_col,
      body.mobile-nav-open .left_col,
      body.nav-sm.mobile-nav-open .col-md-3.left_col,
      body.nav-sm.mobile-nav-open .left_col {
        transform: translateX(0) !important;
        box-shadow: 14px 0 45px rgba(0, 0, 0, 0.5) !important;
      }

      body.mobile-nav-open .sidebar-mobile-backdrop {
        display: block !important;
        opacity: 1 !important;
      }

      .btn-sidebar-close {
        display: flex !important;
      }

      .dash-survey-header {
        margin-top: 14px !important;
        margin-bottom: 22px !important;
        padding: 20px 20px !important;
        border-radius: 16px !important;
      }
    }

    /* =========================================================================
       PAGE HEADER STRIP - ENTERPRISE PROPORTIONAL BANNER
       ========================================================================= */
    .dash-survey-header {
      background: linear-gradient(135deg, var(--ide-navy) 0%, var(--ide-navy-light) 100%);
      border-radius: 18px;
      padding: 22px 28px;
      color: #ffffff;
      box-shadow: 0 8px 24px rgba(4, 49, 104, 0.14);
      margin-top: 10px !important;
      margin-bottom: 22px !important;
      position: relative;
      overflow: hidden;
      clear: both;
      border: 1px solid rgba(255, 255, 255, 0.12);
    }

    .dash-survey-header::after {
      content: '';
      position: absolute;
      top: -40px;
      right: -40px;
      width: 190px;
      height: 190px;
      background: radial-gradient(circle, rgba(238, 98, 107, 0.28) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }

    .dash-header-title {
      font-size: 20px;
      font-weight: 800;
      margin: 0 0 6px 0;
      display: flex;
      align-items: center;
      gap: 10px;
      line-height: 1.3;
      letter-spacing: -0.2px;
    }

    .dash-header-subtitle {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.88);
      margin: 0;
      max-width: 850px;
      line-height: 1.55;
    }

    /* =========================================================================
       DYNAMIC SURVEY SELECTOR CARD (Anti-Collision Responsive Controls)
       ========================================================================= */
    .survey-selector-card {
      background: #ffffff;
      border-radius: 16px;
      border: 1px solid var(--ide-border);
      padding: 18px 22px;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
      margin-bottom: 22px;
    }

    .selector-top-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 14px;
      margin-bottom: 14px;
    }

    .selector-label {
      font-size: 13px;
      font-weight: 800;
      color: var(--ide-navy);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 8px;
      flex-shrink: 0;
    }

    .selector-controls-group {
      display: flex;
      gap: 10px;
      align-items: center;
      flex-wrap: wrap;
      flex: 1 1 500px;
      justify-content: flex-end;
    }

    .select-survey-custom {
      background: #f8fafc;
      border: 1.5px solid var(--ide-border);
      color: #0f172a;
      font-size: 13.5px;
      font-weight: 700;
      border-radius: 10px;
      padding: 0 16px;
      height: 44px;
      flex: 1 1 260px;
      min-width: 220px;
      max-width: 480px;
      outline: none;
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .select-survey-custom:focus {
      border-color: var(--ide-navy);
      background: #ffffff;
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.1);
    }

    .btn-selector-action {
      height: 44px;
      border-radius: 10px;
      padding: 0 16px;
      font-weight: 700;
      font-size: 13px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .btn-selector-action:hover {
      transform: translateY(-1px);
    }

    .survey-pills-bar {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
      padding-top: 14px;
      border-top: 1px dashed #e2e8f0;
    }

    .survey-pill-btn {
      background: #f1f5f9;
      color: #475569;
      border: 1px solid #cbd5e1;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .survey-pill-btn:hover {
      background: #e2e8f0;
      color: #0f172a;
    }

    .survey-pill-btn.active {
      background: linear-gradient(135deg, var(--ide-navy), var(--ide-navy-light));
      color: #ffffff;
      border-color: var(--ide-navy);
      box-shadow: 0 4px 12px rgba(4, 49, 104, 0.22);
    }

    .pill-counter {
      background: rgba(0, 0, 0, 0.12);
      padding: 2px 8px;
      border-radius: 10px;
      font-size: 11px;
    }

    .survey-pill-btn.active .pill-counter {
      background: rgba(255, 255, 255, 0.25);
      color: #ffffff;
    }

    /* Selected Survey Metric Strip - Proportional & Anti-Collision Cards */
    .survey-stat-strip {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 12px;
      margin-top: 16px;
      align-items: stretch;
    }

    .survey-stat-card {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 12px 16px;
      display: flex;
      align-items: center;
      gap: 12px;
      height: 100%;
      min-width: 0;
      transition: all 0.2s ease;
    }

    .survey-stat-card:hover {
      background: #ffffff;
      border-color: #cbd5e1;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      transform: translateY(-2px);
    }

    .stat-card-icon {
      width: 42px;
      height: 42px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      flex-shrink: 0;
    }

    .stat-card-body {
      min-width: 0;
      flex: 1;
    }

    .stat-val {
      font-size: 16px;
      font-weight: 800;
      color: var(--ide-dark);
      line-height: 1.25;
      word-break: break-word;
    }

    .stat-lbl {
      font-size: 11px;
      color: #64748b;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      margin-top: 2px;
    }

    /* Segmented Navigation Tab Switcher */
    .dash-nav-tabs { display: none !important;

      background: #ffffff;
      border-radius: 16px;
      border: 1px solid var(--ide-border);
      padding: 6px;
      display: flex;
      gap: 6px;
      margin-bottom: 24px;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
    }

    .dash-tab-btn {
      flex: 1;
      background: transparent;
      border: none;
      color: #64748b;
      font-size: 13.5px;
      font-weight: 700;
      padding: 12px 18px;
      border-radius: 12px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: all 0.25s ease;
      font-family: inherit;
    }

    .dash-tab-btn:hover {
      background: #f8fafc;
      color: var(--ide-navy);
    }

    .dash-tab-btn.active {
      background: linear-gradient(135deg, var(--ide-red), #88040d);
      color: #ffffff;
      box-shadow: 0 6px 18px rgba(180, 8, 20, 0.25);
    }

    /* Tab Sections Viewports */
    .dash-tab-content {
      display: none;
    }

    .dash-tab-content.active {
      display: block;
      animation: fadeInTab 0.3s ease forwards;
    }

    @keyframes fadeInTab {
      from { opacity: 0; transform: translateY(6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* =========================================================================
       FORM ISIAN LEMBAR KUESIONER (Enterprise Proportional & Anti-Collision)
       ========================================================================= */
    .survey-form-card {
      background: #ffffff;
      border-radius: 18px;
      border: 1px solid var(--ide-border);
      box-shadow: 0 6px 24px rgba(0, 0, 0, 0.04);
      overflow: hidden;
      margin-bottom: 28px;
    }

    .survey-form-banner {
      background: linear-gradient(135deg, var(--ide-navy), var(--ide-navy-dark));
      padding: 24px 28px;
      color: #ffffff;
      border-bottom: 4px solid var(--ide-red);
      position: relative;
    }

    .form-banner-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 12px;
    }

    .form-badge-jenis {
      background: rgba(255, 255, 255, 0.2);
      color: #ffffff;
      padding: 6px 12px;
      font-size: 12px;
      font-weight: 700;
      border-radius: 8px;
      letter-spacing: 0.3px;
    }

    .form-banner-actions {
      display: flex;
      gap: 10px;
      align-items: center;
      flex-wrap: wrap;
    }

    .btn-banner-qr {
      font-weight: 700;
      border-radius: 8px;
      font-size: 12px;
      padding: 6px 14px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
      background: #ffffff;
      color: #0f172a;
      border: none;
      transition: all 0.2s ease;
      cursor: pointer;
    }

    .btn-banner-qr:hover {
      background: #f1f5f9;
      transform: translateY(-1px);
    }

    .form-banner-estimasi {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.9);
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .form-banner-title {
      font-size: 20px;
      font-weight: 800;
      margin: 0 0 6px 0;
      line-height: 1.35;
    }

    .form-banner-desc {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.88);
      margin: 0;
      line-height: 1.55;
      max-width: 860px;
    }

    .survey-form-body {
      padding: 26px 30px;
    }

    .form-section-title {
      font-size: 14px;
      font-weight: 800;
      color: var(--ide-navy);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 18px;
      padding-bottom: 8px;
      border-bottom: 2px solid #f1f5f9;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .form-group-custom {
      margin-bottom: 18px;
    }

    .form-label-custom {
      font-size: 12.5px;
      font-weight: 700;
      color: #334155;
      margin-bottom: 6px;
      display: block;
    }

    .form-label-custom span.req {
      color: var(--ide-red);
    }

    .form-input-custom {
      width: 100%;
      height: 44px;
      background: #f8fafc;
      border: 1.5px solid #cbd5e1;
      border-radius: 10px;
      padding: 0 14px;
      font-size: 13.5px;
      color: #0f172a;
      outline: none;
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .form-input-custom:focus {
      border-color: var(--ide-navy);
      background: #ffffff;
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.1);
    }

    .form-textarea-custom {
      width: 100%;
      min-height: 90px;
      background: #f8fafc;
      border: 1.5px solid #cbd5e1;
      border-radius: 10px;
      padding: 12px 14px;
      font-size: 13.5px;
      color: #0f172a;
      outline: none;
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .form-textarea-custom:focus {
      border-color: var(--ide-navy);
      background: #ffffff;
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.1);
    }

    /* GPS Box & Mini-Map */
    .gps-capture-panel {
      background: #f0fdf4;
      border: 1.5px solid #bbf7d0;
      border-radius: 14px;
      padding: 18px 20px;
      margin-bottom: 24px;
    }

    .gps-panel-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 14px;
      flex-wrap: wrap;
      gap: 12px;
    }

    .btn-capture-gps {
      background: #15803d;
      color: #ffffff;
      border: none;
      padding: 9px 18px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.2s ease;
      box-shadow: 0 3px 10px rgba(21, 128, 61, 0.2);
    }

    .btn-capture-gps:hover {
      background: #166534;
      transform: translateY(-1px);
      box-shadow: 0 5px 14px rgba(21, 128, 61, 0.3);
    }

    .google-mini-map {
      height: 220px;
      width: 100%;
      border-radius: 12px;
      border: 1.5px solid #cbd5e1;
      background: #e2e8f0;
      margin-top: 14px;
    }

    /* Enterprise Question Cards */
    .question-box {
      background: #ffffff;
      border: 1.5px solid #e2e8f0;
      border-left: 5px solid var(--ide-navy);
      border-radius: 14px;
      padding: 18px 22px;
      margin-bottom: 16px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
      transition: all 0.25s ease;
    }

    .question-box:hover {
      border-color: #cbd5e1;
      border-left-color: var(--ide-navy-light);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    }

    .question-box.is-answered {
      border-left-color: #10b981;
      background: #fafdfc;
    }

    .q-number-pill {
      font-size: 11px;
      font-weight: 800;
      background: rgba(4, 49, 104, 0.08);
      color: var(--ide-navy);
      padding: 3px 10px;
      border-radius: 6px;
      text-transform: uppercase;
      display: inline-block;
      margin-bottom: 8px;
    }

    .question-box.is-answered .q-number-pill {
      background: rgba(16, 185, 129, 0.12);
      color: #047857;
    }

    .q-text {
      font-size: 14.5px;
      font-weight: 700;
      color: #0f172a;
      line-height: 1.5;
      margin-bottom: 14px;
    }

    /* Likert Rating Scale Options - Dynamic Grid with Controlled Widths */
    .likert-rating-row {
      display: grid;
      grid-template-columns: repeat(var(--likert-cols, 5), 1fr);
      gap: 10px;
    }

    .likert-radio-label {
      background: #f8fafc;
      border: 1.5px solid #e2e8f0;
      border-radius: 12px;
      padding: 14px 10px;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin: 0;
      position: relative;
      user-select: none;
    }

    .likert-radio-label:hover {
      background: #f0f7ff;
      border-color: #93c5fd;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(4, 49, 104, 0.08);
    }

    .likert-radio-label input[type="radio"] {
      cursor: pointer;
      margin: 0;
    }

    .likert-radio-label.selected,
    .likert-radio-label:has(input[type="radio"]:checked) {
      background: #e0f2fe;
      border-color: #0284c7;
      box-shadow: 0 4px 14px rgba(2, 132, 199, 0.2);
      transform: translateY(-2px);
    }

    .likert-score {
      font-size: 18px;
      font-weight: 800;
      color: var(--ide-navy);
      line-height: 1;
    }

    .likert-text {
      font-size: 11.5px;
      color: #64748b;
      font-weight: 600;
      line-height: 1.35;
      min-height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .likert-radio-label.selected .likert-text,
    .likert-radio-label:has(input[type="radio"]:checked) .likert-text {
      color: var(--ide-navy);
      font-weight: 800;
    }

    /* Option Label for Radio & Checkbox */
    .form-check-label {
      transition: all 0.2s ease;
    }

    .form-check-label:hover {
      background: #f0f7ff !important;
      border-color: #93c5fd !important;
    }

    .form-check-label:has(input:checked) {
      background: #e0f2fe !important;
      border-color: #0284c7 !important;
      font-weight: 700 !important;
    }

    /* Form Action Bar */
    .form-actions-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 14px;
      padding-top: 22px;
      border-top: 1px solid #e2e8f0;
      flex-wrap: wrap;
    }

    .btn-submit-survey-data {
      background: linear-gradient(135deg, var(--ide-red), #88040d);
      color: #ffffff;
      border: none;
      font-size: 14.5px;
      font-weight: 800;
      padding: 12px 30px;
      border-radius: 12px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 6px 20px rgba(180, 8, 20, 0.28);
      transition: all 0.25s ease;
    }

    .btn-submit-survey-data:hover {
      background: #88040d;
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(180, 8, 20, 0.38);
    }

    /* Google Maps Canvas Workspace */
    .google-gis-card {
      background: #ffffff;
      border-radius: 20px;
      border: 1px solid var(--ide-border);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      margin-bottom: 30px;
    }

    .gis-top-bar {
      padding: 18px 24px;
      border-bottom: 1px solid #e2e8f0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
      background: #f8fafc;
    }

    .gis-grid-layout {
      display: grid;
      grid-template-columns: 1fr 340px;
      min-height: 640px;
    }

    .google-map-canvas {
      height: 640px;
      width: 100%;
      background: #e2e8f0;
    }

    .gis-sidebar-panel {
      border-left: 1px solid #e2e8f0;
      background: #ffffff;
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 16px;
      height: 640px;
      overflow-y: auto;
    }

    .gis-focus-card {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      padding: 16px;
    }

    .gis-feed-item {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 12px 14px;
      margin-bottom: 10px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .gis-feed-item:hover {
      border-color: var(--ide-navy);
      background: #f0f7ff;
      transform: translateX(3px);
    }

    /* Watermark-Free Map Styling & Info Cards */
    .leaflet-container {
      font-family: 'Poppins', sans-serif !important;
    }

    .google-map-canvas, .leaflet-map-canvas {
      height: 640px;
      width: 100%;
      background: #f1f5f9;
      border-radius: 0 0 0 16px;
    }

    .gmap-popup-card {
      font-family: 'Poppins', sans-serif;
      padding: 4px;
      min-width: 250px;
    }

    .gmap-popup-header {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 8px;
      padding-bottom: 6px;
      border-bottom: 1px solid #f1f5f9;
    }

    .gmap-popup-avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: var(--ide-navy);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 15px;
      flex-shrink: 0;
    }

    .gmap-popup-name {
      font-size: 14.5px;
      font-weight: 800;
      color: var(--ide-dark);
      margin: 0;
      line-height: 1.2;
    }

    .gmap-popup-time {
      font-size: 11px;
      color: #64748b;
      margin-top: 2px;
    }

    .gmap-popup-info-grid {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 10px;
      padding: 8px 12px;
      font-size: 12px;
      margin-bottom: 8px;
      line-height: 1.5;
    }

    .gmap-popup-info-row {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin-bottom: 2px;
    }

    .gmap-popup-info-lbl {
      color: #64748b;
      font-weight: 600;
    }

    .gmap-popup-info-val {
      color: #0f172a;
      font-weight: 700;
      text-align: right;
    }

    .gmap-badge-mutu {
      font-size: 11.5px;
      font-weight: 800;
      padding: 3px 10px;
      border-radius: 12px;
      display: inline-block;
    }

    .mutu-a { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
    .mutu-b { background: #e0f2fe; color: #0369a1; border: 1px solid #7dd3fc; }
    .mutu-c { background: #fef9c3; color: #854d0e; border: 1px solid #fde047; }
    .mutu-d { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

    /* Custom Marker Pin Icons */
    .dash-map-pin {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      border: 2.5px solid #ffffff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.4);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #ffffff;
      font-size: 10px;
      transition: transform 0.2s ease;
    }

    .dash-map-pin:hover {
      transform: scale(1.3);
      z-index: 1000 !important;
    }

    .pin-green { background: #10b981; }
    .pin-blue { background: #0284c7; }
    .pin-yellow { background: #f59e0b; }
    .pin-red { background: #ef4444; }

    /* Layer Switcher Buttons in Toolbar */
    .btn-map-layer-switch {
      background: #ffffff;
      border: 1.5px solid #cbd5e1;
      color: #475569;
      font-size: 12px;
      font-weight: 700;
      padding: 5px 12px;
      border-radius: 8px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s ease;
    }

    .btn-map-layer-switch:hover {
      background: #f1f5f9;
      color: #0f172a;
    }

    .btn-map-layer-switch.active {
      background: var(--ide-navy);
      color: #ffffff;
      border-color: var(--ide-navy);
      box-shadow: 0 2px 8px rgba(4, 49, 104, 0.25);
    }

    /* Rekap Table Styling */
    .rekap-card {
      background: #ffffff;
      border-radius: 20px;
      border: 1px solid var(--ide-border);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
      padding: 24px 28px;
      margin-bottom: 30px;
    }

    /* Auto-Generated Visual Analytics Cards */
    .rekap-chart-card {
      background: #ffffff;
      border: 1px solid var(--ide-border);
      border-radius: 16px;
      padding: 18px 20px 14px 20px;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
      height: 100%;
      display: flex;
      flex-direction: column;
      transition: all 0.25s ease;
    }

    .rekap-chart-card:hover {
      box-shadow: 0 8px 25px rgba(4, 49, 104, 0.08);
      border-color: #cbd5e1;
    }

    .chart-card-header {
      margin-bottom: 12px;
    }

    .chart-card-title {
      font-size: 14px;
      font-weight: 800;
      color: var(--ide-navy);
      display: flex;
      align-items: center;
      gap: 7px;
    }

    .chart-card-subtitle {
      font-size: 11.5px;
      color: #64748b;
      display: block;
      margin-top: 2px;
    }

    .chart-card-body {
      flex: 1 1 auto;
      position: relative;
      height: 260px;
      min-height: 260px;
      width: 100%;
      display: block;
    }

    .chart-empty-state {
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 8px;
      color: #94a3b8;
      font-size: 13px;
      font-weight: 600;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 12px;
    }

    .chart-empty-state i {
      font-size: 36px;
      color: #cbd5e1;
    }

    .btn-demo-filter {
      font-size: 11px !important;
      font-weight: 700 !important;
      padding: 3px 8px !important;
      border-radius: 6px !important;
    }

    .btn-demo-filter.active {
      background-color: var(--ide-navy) !important;
      border-color: var(--ide-navy) !important;
      color: #ffffff !important;
    }

    /* =========================================================================
       GOOGLE FORM STUDIO DYNAMIC QUESTION & ASSESSMENT BUILDER STYLING
       Uniform Navy Color System (#043168)
       ========================================================================= */
    .navy-icon,
    #tabContentStudio i,
    .gform-builder-card i {
      color: var(--ide-navy) !important;
    }

    .gform-builder-card {
      background: #ffffff;
      border: 1.5px solid #e2e8f0;
      border-left: 5px solid var(--ide-navy);
      border-radius: 16px;
      padding: 22px 24px;
      margin-bottom: 20px;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
      transition: all 0.25s ease;
      position: relative;
    }

    .gform-builder-card:hover {
      box-shadow: 0 8px 25px rgba(4, 49, 104, 0.08);
      border-color: #cbd5e1;
      border-left-color: var(--ide-navy);
    }

    .gform-card-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 14px;
      padding-bottom: 12px;
      border-bottom: 1px solid #f1f5f9;
    }

    .gform-q-number {
      font-size: 11.5px;
      font-weight: 800;
      background: rgba(4, 49, 104, 0.08);
      color: var(--ide-navy);
      padding: 4px 10px;
      border-radius: 8px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .gform-q-type-select {
      background: #f8fafc;
      border: 1.5px solid #cbd5e1;
      color: var(--ide-navy);
      font-size: 13px;
      font-weight: 700;
      border-radius: 10px;
      padding: 8px 14px;
      outline: none;
      transition: all 0.2s ease;
      cursor: pointer;
      font-family: inherit;
    }

    .gform-q-type-select:focus {
      border-color: var(--ide-navy);
      background: #ffffff;
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.1);
    }

    .gform-card-ctrls {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .btn-q-ctrl {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      border: 1.5px solid #e2e8f0;
      background: #ffffff;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      transition: all 0.2s ease;
    }

    .btn-q-ctrl:hover {
      background: #f0f7ff;
      border-color: var(--ide-navy);
      transform: translateY(-1px);
    }

    .btn-q-ctrl.del:hover {
      background: #fef2f2;
      border-color: #ef4444;
    }

    .btn-q-ctrl.del:hover i {
      color: #ef4444 !important;
    }

    .gform-q-title-input {
      width: 100%;
      border: 1.5px solid #cbd5e1;
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 14.5px;
      font-weight: 700;
      color: #0f172a;
      background: #ffffff;
      outline: none;
      margin-bottom: 8px;
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .gform-q-title-input:focus {
      border-color: var(--ide-navy);
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.1);
    }

    .gform-q-desc-input {
      width: 100%;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      padding: 8px 14px;
      font-size: 12.5px;
      color: #475569;
      background: #f8fafc;
      outline: none;
      margin-bottom: 16px;
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .gform-q-desc-input:focus {
      border-color: var(--ide-navy);
      background: #ffffff;
    }

    .gform-options-container {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 14px;
    }

    .gform-option-row {
      display: flex;
      align-items: center;
      gap: 10px;
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 10px;
      padding: 8px 12px;
      transition: all 0.2s ease;
    }

    .gform-option-row:hover {
      border-color: #cbd5e1;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    .gform-opt-icon {
      font-size: 16px;
      width: 22px;
      text-align: center;
      flex-shrink: 0;
    }

    .gform-opt-input {
      flex: 1;
      border: none;
      background: transparent;
      font-size: 13.5px;
      font-weight: 600;
      color: #1e293b;
      outline: none;
      padding: 4px 6px;
      font-family: inherit;
    }

    .gform-val-box {
      display: flex;
      align-items: center;
      gap: 6px;
      background: rgba(4, 49, 104, 0.05);
      border: 1px solid rgba(4, 49, 104, 0.15);
      border-radius: 8px;
      padding: 4px 10px;
      flex-shrink: 0;
    }

    .gform-val-lbl {
      font-size: 11.5px;
      font-weight: 700;
      color: var(--ide-navy);
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .gform-val-input {
      width: 58px;
      border: 1px solid #cbd5e1;
      border-radius: 6px;
      background: #ffffff;
      font-size: 13px;
      font-weight: 800;
      color: var(--ide-navy);
      text-align: center;
      padding: 3px 4px;
      outline: none;
      font-family: inherit;
    }

    .btn-remove-opt {
      background: transparent;
      border: none;
      width: 30px;
      height: 30px;
      border-radius: 6px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      transition: all 0.2s ease;
    }

    .btn-remove-opt:hover {
      background: #fee2e2;
    }

    .btn-remove-opt:hover i {
      color: #dc2626 !important;
    }

    .gform-opt-actions-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 10px;
      padding-top: 10px;
      border-top: 1px dashed #e2e8f0;
    }

    .btn-add-opt {
      background: #f8fafc;
      border: 1.5px dashed #cbd5e1;
      border-radius: 8px;
      color: var(--ide-navy);
      font-size: 12.5px;
      font-weight: 700;
      padding: 8px 16px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      transition: all 0.2s ease;
    }

    .btn-add-opt:hover {
      background: #f0f7ff;
      border-color: var(--ide-navy);
      transform: translateY(-1px);
    }

    .gform-preset-wrap {
      display: flex;
      align-items: center;
      gap: 6px;
      flex-wrap: wrap;
    }

    .gform-preset-lbl {
      font-size: 11.5px;
      font-weight: 700;
      color: var(--ide-navy);
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .btn-preset {
      background: #f1f5f9;
      border: 1px solid #cbd5e1;
      border-radius: 14px;
      padding: 4px 10px;
      font-size: 11px;
      font-weight: 700;
      color: var(--ide-navy);
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn-preset:hover {
      background: var(--ide-navy);
      color: #ffffff;
      border-color: var(--ide-navy);
    }

    .gform-scale-settings {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 14px 16px;
      margin-bottom: 14px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .gform-scale-group {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .gform-scale-group label {
      font-size: 12px;
      font-weight: 700;
      color: var(--ide-navy);
      margin: 0;
      min-width: 130px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .gform-scale-group select,
    .gform-scale-group input {
      height: 38px;
      border-radius: 8px;
      border: 1px solid #cbd5e1;
      padding: 0 12px;
      font-size: 12.5px;
      font-weight: 600;
      outline: none;
      background: #ffffff;
      font-family: inherit;
    }

    .gform-card-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
      padding-top: 14px;
      border-top: 1px solid #f1f5f9;
      margin-top: 10px;
    }

    .gform-switch-lbl {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 12.5px;
      font-weight: 700;
      color: #334155;
      cursor: pointer;
      margin: 0;
    }

    @media (max-width: 991.98px) {
      .gis-grid-layout {
        grid-template-columns: 1fr;
      }
      .survey-stat-strip {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 10px !important;
      }
      .selector-controls-group {
        width: 100%;
        justify-content: flex-start;
      }
      .select-survey-custom {
        min-width: 0 !important;
        width: 100% !important;
      }
      .likert-rating-row {
        grid-template-columns: repeat(var(--likert-cols, 5), 1fr) !important;
        gap: 8px;
      }
      .dash-nav-tabs { display: none !important;

        overflow-x: auto;
        flex-wrap: nowrap;
        -webkit-overflow-scrolling: touch;
        padding: 5px;
        gap: 6px;
      }
      .dash-tab-btn {
        flex: 0 0 auto;
        white-space: nowrap;
        padding: 10px 16px;
        font-size: 13px;
      }
      .survey-form-banner {
        padding: 18px 20px;
      }
      .form-banner-title {
        font-size: 19px;
      }
      .survey-form-body {
        padding: 20px 18px;
      }
    }

    @media (max-width: 767.98px) {
      .dash-survey-header {
        padding: 16px 16px !important;
        border-radius: 14px !important;
        margin-top: 8px !important;
        margin-bottom: 16px !important;
      }
      .dash-header-title {
        font-size: 16px !important;
        line-height: 1.35 !important;
      }
      .dash-header-subtitle {
        font-size: 11.5px !important;
        line-height: 1.45 !important;
      }
      .survey-selector-card {
        padding: 14px 14px !important;
        border-radius: 14px !important;
        margin-bottom: 16px !important;
      }
      .selector-top-row {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 10px !important;
      }
      .selector-controls-group {
        width: 100% !important;
        flex-direction: column !important;
        gap: 8px !important;
      }
      .selector-controls-group .btn,
      .btn-selector-action {
        width: 100% !important;
        justify-content: center !important;
        height: 44px !important;
      }
      .survey-pills-bar {
        overflow-x: auto !important;
        flex-wrap: nowrap !important;
        -webkit-overflow-scrolling: touch !important;
        padding-bottom: 8px !important;
        gap: 8px !important;
      }
      .survey-pill-btn {
        flex: 0 0 auto !important;
        font-size: 12px !important;
        padding: 6px 12px !important;
      }
      .survey-stat-strip {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 8px !important;
      }
      .survey-stat-card {
        padding: 10px 12px !important;
        gap: 10px !important;
        border-radius: 12px !important;
      }
      .stat-card-icon {
        width: 36px !important;
        height: 36px !important;
        font-size: 14px !important;
        border-radius: 8px !important;
      }
      .stat-val {
        font-size: 13.5px !important;
      }
      .stat-lbl {
        font-size: 10px !important;
      }
      .dash-nav-tabs { display: none !important;

        overflow-x: auto;
        flex-wrap: nowrap;
        -webkit-overflow-scrolling: touch;
        padding: 4px;
        gap: 4px;
      }
      .dash-tab-btn {
        flex: 0 0 auto;
        white-space: nowrap;
        padding: 8px 12px;
        font-size: 12px;
        gap: 6px;
      }
      .survey-form-banner {
        padding: 16px 16px !important;
      }
      .form-banner-top {
        gap: 8px !important;
        margin-bottom: 8px !important;
      }
      .form-banner-title {
        font-size: 16px !important;
        line-height: 1.35 !important;
      }
      .form-banner-desc {
        font-size: 12px !important;
        line-height: 1.45 !important;
      }
      .survey-form-body {
        padding: 16px 14px !important;
      }
      .form-section-title {
        font-size: 13px !important;
        margin-bottom: 14px !important;
        gap: 6px;
      }
      .form-label-custom {
        font-size: 11.5px;
      }
      .form-input-custom,
      .select-survey-custom {
        height: 46px;
        font-size: 16px !important;
        padding: 0 14px;
      }
      .form-textarea-custom {
        font-size: 16px !important;
        padding: 10px 14px;
      }
      .question-box {
        padding: 14px 14px !important;
        border-radius: 12px !important;
        margin-bottom: 14px !important;
      }
      .q-text {
        font-size: 13.5px !important;
        margin-bottom: 12px !important;
        line-height: 1.45;
      }
      .likert-rating-row {
        grid-template-columns: 1fr !important;
        gap: 8px !important;
      }
      .likert-radio-label {
        flex-direction: row !important;
        justify-content: flex-start !important;
        align-items: center !important;
        padding: 12px 14px !important;
        gap: 12px !important;
        border-radius: 10px !important;
        text-align: left !important;
      }
      .likert-score {
        width: 32px !important;
        height: 32px !important;
        min-width: 32px !important;
        border-radius: 8px !important;
        background: rgba(4, 49, 104, 0.08) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 14px !important;
        font-weight: 800 !important;
      }
      .likert-text {
        font-size: 12px !important;
        text-align: left !important;
        min-height: auto !important;
        flex: 1 !important;
        justify-content: flex-start !important;
      }
      .gps-capture-panel {
        padding: 14px 14px !important;
      }
      .google-mini-map {
        height: 180px !important;
      }
      .form-actions-footer {
        flex-direction: column-reverse !important;
        align-items: stretch !important;
        gap: 10px !important;
        padding-top: 16px !important;
      }
      .form-actions-footer > div {
        width: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 8px !important;
      }
      .btn-submit-survey-data {
        width: 100% !important;
        justify-content: center !important;
        height: 48px !important;
        font-size: 14.5px !important;
      }
    }

    @media (max-width: 480px) {
      .survey-stat-strip {
        grid-template-columns: 1fr 1fr !important;
        gap: 6px !important;
      }
      .stat-val {
        font-size: 12.5px !important;
      }
      .stat-lbl {
        font-size: 9.5px !important;
      }
    }

    /* ==========================================================================
       RUMAH SURVEI CATALOG & CARDS STYLING (Identik dengan Menu Survei Umum)
       ========================================================================== */
    .katalog-filter-card {
      background: #ffffff;
      border-radius: 16px;
      border: 1px solid var(--ide-border);
      padding: 18px 22px;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
      margin-bottom: 22px;
    }

    .katalog-filter-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 14px;
    }

    .katalog-search-wrap {
      position: relative;
      flex: 1 1 280px;
      min-width: 240px;
    }

    .katalog-search-wrap i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 14px;
      pointer-events: none;
    }

    .katalog-search-input {
      width: 100%;
      height: 44px;
      background: #f8fafc;
      border: 1.5px solid #cbd5e1;
      border-radius: 12px;
      padding: 0 16px 0 40px;
      font-size: 13.5px;
      color: #0f172a;
      outline: none;
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .katalog-search-input:focus {
      border-color: var(--ide-navy);
      background: #ffffff;
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.1);
    }

    .katalog-filter-select {
      height: 44px;
      background: #f8fafc;
      border: 1.5px solid #cbd5e1;
      border-radius: 12px;
      padding: 0 14px;
      font-size: 13px;
      font-weight: 600;
      color: #334155;
      outline: none;
      transition: all 0.2s ease;
      cursor: pointer;
      font-family: inherit;
    }

    .katalog-filter-select:focus {
      border-color: var(--ide-navy);
      background: #ffffff;
    }

    .katalog-stats-strip {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px;
      margin-bottom: 24px;
    }

    .katalog-stat-box {
      background: #ffffff;
      border: 1px solid var(--ide-border);
      border-radius: 14px;
      padding: 16px 18px;
      display: flex;
      align-items: center;
      gap: 14px;
      box-shadow: 0 4px 12px rgba(4, 49, 104, 0.04);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .katalog-stat-box:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(4, 49, 104, 0.08);
    }

    .katalog-stat-icon {
      width: 46px;
      height: 46px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      flex-shrink: 0;
    }

    .katalog-stat-body {
      min-width: 0;
      flex: 1;
    }

    .katalog-stat-val {
      font-size: 20px;
      font-weight: 800;
      color: var(--ide-dark);
      line-height: 1.2;
    }

    .katalog-stat-lbl {
      font-size: 11.5px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      margin-top: 2px;
    }

    /* Grid Rumah Survei Cards */
    .survey-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
      gap: 24px;
      margin-bottom: 30px;
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
      border-color: var(--ide-red);
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
      width: 48px;
      height: 48px;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--ide-navy) 0%, #0d4f9b 100%);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      box-shadow: 0 5px 14px rgba(4, 49, 104, 0.22);
      transition: all 0.35s ease;
    }

    .survey-card:hover .card-icon {
      background: var(--ide-red);
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
      color: var(--ide-navy);
      border: 1px solid rgba(4, 49, 104, 0.22);
      font-size: 10px;
      font-weight: 800;
      padding: 3px 8px;
      border-radius: 8px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .card-title {
      font-size: 16px;
      font-weight: 800;
      color: var(--ide-dark);
      margin-bottom: 14px;
      line-height: 1.38;
      transition: color 0.3s ease;
      position: relative;
      z-index: 2;
    }

    .survey-card:hover .card-title {
      color: var(--ide-red);
    }

    .card-meta {
      background: #f8fafc;
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
      color: var(--ide-navy);
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
      color: #1e293b;
      word-break: break-word;
    }

    .badge-daerah-survei {
      background: #e0f2fe;
      color: #0369a1;
      padding: 2px 8px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    /* Primary Card Actions (Isi Survei, Peta, QR Code) */
    .card-actions {
      display: grid;
      grid-template-columns: 1.15fr 0.85fr 0.95fr;
      gap: 8px;
      margin-top: auto;
      position: relative;
      z-index: 2;
    }

    .btn-action-fill {
      height: 40px;
      border-radius: 20px;
      background: linear-gradient(135deg, #b40814 0%, #e11d48 55%, #b40814 100%);
      background-size: 200% auto;
      color: #ffffff;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      border: none;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(180, 8, 20, 0.32);
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      font-family: inherit;
    }

    .btn-action-fill:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(180, 8, 20, 0.45);
      color: #ffffff;
    }

    .btn-action-map {
      height: 40px;
      border-radius: 20px;
      background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
      color: #ffffff;
      border: none;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
      transition: all 0.25s ease;
      text-decoration: none;
      font-family: inherit;
    }

    .btn-action-map:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(79, 70, 229, 0.35);
      color: #ffffff;
    }

    .btn-action-qr {
      height: 40px;
      border-radius: 20px;
      background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
      color: #047857;
      border: 1.5px solid #6ee7b7;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.3px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      box-shadow: 0 2px 8px rgba(4, 120, 87, 0.08);
      transition: all 0.25s ease;
      font-family: inherit;
    }

    .btn-action-qr:hover {
      background: #ecfdf5;
      border-color: #059669;
      transform: translateY(-2px);
      box-shadow: 0 5px 14px rgba(4, 120, 87, 0.2);
    }

    /* Surveyor & Admin Controls Row (Edit Studio, Rekap, Excel, Hapus) */
    .card-surveyor-actions {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 6px;
      margin-top: 12px;
      padding-top: 12px;
      border-top: 1px dashed #e2e8f0;
      position: relative;
      z-index: 2;
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
      text-decoration: none !important;
      transition: all 0.2s ease;
      font-family: inherit;
      border: none;
    }

    .btn-action-edit {
      background: #eff6ff;
      color: #0369a1;
      border: 1px solid #bfdbfe;
    }

    .btn-action-edit:hover {
      background: var(--ide-navy);
      color: #ffffff;
      border-color: var(--ide-navy);
      transform: translateY(-1px);
    }

    .btn-action-rekap {
      background: #f8fafc;
      color: #475569;
      border: 1px solid #cbd5e1;
    }

    .btn-action-rekap:hover {
      background: var(--ide-dark);
      color: #ffffff;
      border-color: var(--ide-dark);
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

    /* Subview Top Navigation Context Bar */
    .dash-subview-context-bar {
      background: #ffffff;
      border: 1px solid var(--ide-border);
      border-radius: 14px;
      padding: 12px 18px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
      box-shadow: 0 3px 12px rgba(4, 49, 104, 0.04);
    }

    .btn-back-katalog {
      font-weight: 700;
      border-radius: 10px;
      padding: 7px 16px;
      font-size: 12.5px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #ffffff;
      border: 1.5px solid #cbd5e1;
      color: #334155;
      transition: all 0.2s ease;
    }

    .btn-back-katalog:hover {
      background: #f1f5f9;
      color: var(--ide-navy);
      border-color: var(--ide-navy);
      transform: translateX(-2px);
    }

    .subview-context-details {
      display: flex;
      align-items: center;
      gap: 8px;
      flex: 1 1 auto;
      min-width: 200px;
    }

    .subview-badge-context {
      font-size: 11px;
      font-weight: 800;
      background: rgba(4, 49, 104, 0.08);
      color: var(--ide-navy);
      padding: 4px 10px;
      border-radius: 8px;
      text-transform: uppercase;
      letter-spacing: 0.4px;
    }

    @media (max-width: 991.98px) {
      .katalog-stats-strip {
        grid-template-columns: 1fr 1fr;
      }
      .survey-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 576px) {
      .katalog-stats-strip {
        grid-template-columns: 1fr;
      }
      .card-actions {
        grid-template-columns: 1fr;
      }
      .card-surveyor-actions {
        grid-template-columns: 1fr 1fr;
      }
    }

  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <!-- Mobile Drawer Backdrop (Selaras Dashboard Utama) -->
      <div id="sidebarMobileBackdrop" class="sidebar-mobile-backdrop"></div>

      <!-- =====================================================================
           SIDEBAR DI SISI KIRI (SELARAS DENGAN DASHBOARD ADMIN)
           ===================================================================== -->
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <!-- Sidebar Brand Header (Logo IDE Saja & Tombol Tutup Mobile - Seragam dengan Dashboard Utama) -->
          <div class="sidebar-brand-header text-center" style="padding: 20px 15px 12px 15px; display: flex; justify-content: center; align-items: center; position: relative;">
            <a href="<?php
              if ($userLevel == 1) echo base_url('SuperAdmin');
              elseif ($userLevel == 2) echo base_url('Admin');
              elseif ($userLevel == 3) echo base_url('Staf');
              elseif ($userLevel == 4) echo base_url('Surveyor');
              elseif ($userLevel == 5) echo base_url('IDE/MenuSurvei');
              else echo base_url();
            ?>">
              <img src="<?=base_url('assets/img/logo-white-solid.webp')?>" alt="IDE Logo" style="max-height: 48px; width: auto; object-fit: contain;">
            </a>
            <button type="button" class="btn-sidebar-close d-lg-none" id="btnSidebarClose" title="Tutup Menu">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>

          <!-- Sidebar Navigation Menu: Terintegrasi dengan Sidebar Utama Dashboard Sesuai Role -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <?php if ($userLevel == 2): /* ================= ADMIN ================= */ ?>
                <div class="sidebar-menu-title">Main Control</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('Admin')?>"><i class="fa-solid fa-gauge-high"></i> <b>Dashboard</b> </a></li>
                </ul>

                <div class="sidebar-menu-title">Manajemen Keuangan</div>
                <ul class="nav side-menu">
                  <li><a><i class="fa-solid fa-wallet"></i> <b>Pendapatan</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Admin/PendapatanKas')?>"><b>Kas In</b></a></li>
                      <li><a href="<?=base_url('Admin/PendapatanKegiatan')?>"><b>Pendapatan Kegiatan</b></a></li>
                    </ul>
                  </li>
                </ul>

                <ul class="nav side-menu">
                  <li><a><i class="fa-solid fa-receipt"></i> <b>Pengeluaran</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Admin/PengeluaranUmum')?>"><b>Pengeluaran Umum</b></a></li>
                      <li><a href="<?=base_url('Admin/PengeluaranKegiatan')?>"><b>Pengeluaran Kegiatan</b></a></li>
                    </ul>
                  </li>
                </ul>

                <div class="sidebar-menu-title">Laporan & Rekap</div>
                <ul class="nav side-menu">
                  <li><a><i class="fa-solid fa-book-bookmark"></i> <b>Jurnal Akuntansi</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Admin/JurnalUmum')?>"><b>Jurnal Umum</b></a></li>
                      <li><a href="<?=base_url('Admin/JurnalKegiatan')?>"><b>Jurnal Kegiatan</b></a></li>
                      <li><a href="<?=base_url('Admin/JurnalTotal')?>"><b>Laporan Jurnal Total</b></a></li>
                    </ul>
                  </li>
                </ul>

                <div class="sidebar-menu-title">Instrumen Survei</div>
                <ul class="nav side-menu">
                  <li class="active"><a href="<?=base_url('IDE/MenuSurvei')?>"><i class="fa-solid fa-square-poll-vertical"></i> <b>Layanan Survei</b></a></li>
                </ul>

                <div class="sidebar-menu-title">Tools</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('Admin/Komparasi')?>"><i class="fa-solid fa-code-compare"></i> <b>Komparasi</b> </a></li>
                </ul>

                <div class="sidebar-menu-title">Sistem</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('IDE/SignOut')?>"><i class="fa-solid fa-right-from-bracket"></i> <b>Keluar (Sign Out)</b> </a></li>
                </ul>

              <?php elseif ($userLevel == 3): /* ================= STAF ================= */ ?>
                <div class="sidebar-menu-title">Main Control</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('Staf')?>"><i class="fa-solid fa-gauge-high"></i> <b>Dashboard</b> </a></li>
                </ul>

                <div class="sidebar-menu-title">Manajemen Kerja</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('Staf/Project')?>"><i class="fa-solid fa-diagram-project"></i> <b>Project</b> </a></li>
                  <li><a href="<?=base_url('Staf/BankData')?>"><i class="fa-solid fa-database"></i> <b>Bank Data</b> </a></li>
                  <li><a href="<?=base_url('Staf/Microsite')?>"><i class="fa-solid fa-globe"></i> <b>Microsite Hub</b> </a></li>
                  <li><a href="<?=base_url('Staf/OlahData')?>"><i class="fa-solid fa-chart-pie"></i> <b>Olah Data</b> </a></li>
                </ul>

                <div class="sidebar-menu-title">Instrumen Survei</div>
                <ul class="nav side-menu">
                  <li class="active"><a href="<?=base_url('IDE/MenuSurvei')?>"><i class="fa-solid fa-square-poll-vertical"></i> <b>Layanan Survei</b></a></li>
                </ul>

                <div class="sidebar-menu-title">Sistem</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('IDE/SignOut')?>"><i class="fa-solid fa-right-from-bracket"></i> <b>Keluar (Sign Out)</b> </a></li>
                </ul>

              <?php elseif ($userLevel == 1): /* ================= SUPERADMIN ================= */ ?>
                <div class="sidebar-menu-title">Main Control</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('SuperAdmin')?>"><i class="fa-solid fa-gauge-high"></i> <b>Dashboard</b> </a></li>
                </ul>

                <div class="sidebar-menu-title">Manajemen Keuangan</div>
                <ul class="nav side-menu">
                  <li><a><i class="fa-solid fa-wallet"></i> <b>Pendapatan</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('SuperAdmin/PendapatanKas')?>"><b>Kas In</b></a></li>
                      <li><a href="<?=base_url('SuperAdmin/PendapatanKegiatan')?>"><b>Pendapatan Kegiatan</b></a></li>
                    </ul>
                  </li>
                </ul>

                <ul class="nav side-menu">
                  <li><a><i class="fa-solid fa-receipt"></i> <b>Pengeluaran</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('SuperAdmin/PengeluaranUmum')?>"><b>Pengeluaran Umum</b></a></li>
                      <li><a href="<?=base_url('SuperAdmin/PengeluaranKegiatan')?>"><b>Pengeluaran Kegiatan</b></a></li>
                    </ul>
                  </li>
                </ul>

                <div class="sidebar-menu-title">Laporan & Rekap</div>
                <ul class="nav side-menu">
                  <li><a><i class="fa-solid fa-book-bookmark"></i> <b>Jurnal Akuntansi</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('SuperAdmin/JurnalUmum')?>"><b>Jurnal Umum</b></a></li>
                      <li><a href="<?=base_url('SuperAdmin/JurnalKegiatan')?>"><b>Jurnal Kegiatan</b></a></li>
                      <li><a href="<?=base_url('SuperAdmin/JurnalTotal')?>"><b>Laporan Jurnal Total</b></a></li>
                    </ul>
                  </li>
                </ul>

                <div class="sidebar-menu-title">Instrumen Survei</div>
                <ul class="nav side-menu">
                  <li class="active"><a href="<?=base_url('IDE/MenuSurvei')?>"><i class="fa-solid fa-square-poll-vertical"></i> <b>Layanan Survei</b></a></li>
                </ul>

                <div class="sidebar-menu-title">Sistem</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('IDE/SignOut')?>"><i class="fa-solid fa-right-from-bracket"></i> <b>Keluar (Sign Out)</b> </a></li>
                </ul>

              <?php elseif ($userLevel == 4): /* ================= SURVEYOR ================= */ ?>
                <div class="sidebar-menu-title">Main Control</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('Surveyor')?>"><i class="fa fa-user"></i> <b>Profil</b> </a></li>
                </ul>

                <div class="sidebar-menu-title">Instrumen Survei</div>
                <ul class="nav side-menu">
                  <li class="active"><a href="<?=base_url('IDE/MenuSurvei')?>"><i class="fa-solid fa-square-poll-vertical"></i> <b>Layanan Survei</b></a></li>
                </ul>

                <div class="sidebar-menu-title">Katalog Survei</div>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-tasks"></i> <b>Survei Desa</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Surveyor/SurveiBPD')?>"><b>Kinerja Badan Permusyawaratan Desa</b></a></li>           
                      <li><a href="<?=base_url('Surveyor/SurveiKinerjaPemDes')?>"><b>Kinerja Penyelenggaraan Pemerintahan Desa</b></a></li>   
                      <li><a href="<?=base_url('Surveyor/SurveiKinerjaAparatur')?>"><b>Kinerja Aparatur Desa</b></a></li>   
                      <li><a href="<?=base_url('Surveyor/SurveiIPM')?>"><b>Indikator Kesejahteraan Masyarakat</b></a></li>   
                    </ul>
                  </li>
                  <li><a><i class="fa fa-tasks"></i> <b>Survei NTP</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Surveyor/SurveiHargaKonsumenPerdesaan')?>"><b>Harga Konsumen Perdesaan</b></a></li>   
                      <li><a href="<?=base_url('Surveyor/SurveiHargaProdusenPerdesaan')?>"><b>Harga Produsen Perdesaan</b></a></li>   
                    </ul>
                  </li>
                  <li><a><i class="fa fa-tasks"></i> <b>Survei BPNT</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Surveyor/PKPM')?>"><b>Keluarga Penerima Manfaat</b></a></li>   
                      <li><a href="<?=base_url('Surveyor/BankPenyalur')?>"><b>Bank Penyalur</b></a></li>   
                      <li><a href="<?=base_url('Surveyor/PendampingBPNT')?>"><b>Pendamping BPNT</b></a></li>   
                      <li><a href="<?=base_url('Surveyor/EWarung')?>"><b>E-Warung</b></a></li> 
                    </ul>
                  </li>
                  <li><a><i class="fa fa-tasks"></i> <b>Survei BBM</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Surveyor/DesaBBM')?>"><b>Pemerintah Desa</b></a></li> 
                      <li><a href="<?=base_url('Surveyor/DampakBBM')?>"><b>Dampak BBM</b></a></li> 
                    </ul>
                  </li>
                </ul>

                <div class="sidebar-menu-title">Sistem</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('IDE/SignOut')?>"><i class="fa-solid fa-right-from-bracket"></i> <b>Keluar (Sign Out)</b> </a></li>
                </ul>

              <?php elseif ($userLevel == 5): /* ================= USER ROLE 5 (SURVEI) ================= */ ?>
                <div class="sidebar-menu-title">Instrumen Survei</div>
                <ul class="nav side-menu">
                  <li class="active"><a href="<?=base_url('IDE/MenuSurvei')?>"><i class="fa-solid fa-square-poll-vertical"></i> <b>Layanan Survei</b></a></li>
                </ul>

                <div class="sidebar-menu-title">Sistem</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('IDE/SignOut')?>"><i class="fa-solid fa-right-from-bracket"></i> <b>Keluar (Sign Out)</b> </a></li>
                </ul>

              <?php else: /* ================= GUEST / UMUM ================= */ ?>
                <div class="sidebar-menu-title">Navigasi Utama</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url()?>"><i class="fa-solid fa-house"></i> <b>Beranda</b> </a></li>
                </ul>

                <div class="sidebar-menu-title">Instrumen Survei</div>
                <ul class="nav side-menu">
                  <li class="active"><a href="<?=base_url('MenuSurvei')?>"><i class="fa-solid fa-square-poll-vertical"></i> <b>Layanan Survei</b></a></li>
                </ul>

                <div class="sidebar-menu-title">Sistem</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('IDE/Masuk')?>"><i class="fa-solid fa-right-to-bracket"></i> <b>Masuk (Sign In)</b> </a></li>
                </ul>
              <?php endif; ?>
            </div>
          </div>
          <!-- /sidebar menu -->

        </div>
      </div>

      <!-- =====================================================================
           TOP NAVIGATION BAR
           ===================================================================== -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="top-nav-left">
            <a id="menu_toggle" title="Toggle Sidebar"><i class="fa-solid fa-bars"></i></a>
          </div>

          <div class="top-nav-right">
            <div class="admin-top-greeting">
              <i class="fa-solid fa-circle-user" style="color: var(--ide-navy);"></i>
              <span>Halo, <strong><?=htmlspecialchars($userName)?></strong></span>
            </div>
            <a href="<?=base_url('IDE/SignOut')?>" class="btn-header-logout">
              <i class="fa-solid fa-right-from-bracket"></i> Keluar
            </a>
          </div>
        </div>
      </div>

      <!-- =====================================================================
           PAGE MAIN CONTENT AREA (RIGHT_COL)
           ===================================================================== -->
      <div class="right_col" role="main">
        <div class="clearfix"></div>

        <!-- Top Header Banner -->
        <div class="dash-survey-header">
          <h2 class="dash-header-title">
            <i class="fa-solid fa-square-poll-vertical"></i> Portal Instrumen &amp; Layanan Survei Dinamis
          </h2>
          <p class="dash-header-subtitle">
            Kelola instrumen survei daerah, isi kuesioner responden lapangan secara mandiri, pantau sebaran geospasial real-time Google Maps, serta analisis indeks kepuasan publik secara transparan dan terukur.
          </p>
        </div>

        <!-- Hidden input to maintain JS compatibility -->
        <input type="hidden" id="dashSurveySelect" value="<?= !empty($surveiList[0]['Id']) ? $surveiList[0]['Id'] : 0 ?>">

        <!-- ===================================================================
             TAB 0: KATALOG RUMAH SURVEI DINAMIS (KARTU AKSES TERINTEGRASI)
             =================================================================== -->
        <div class="dash-tab-content active" id="tabContentKatalog">
          
          <!-- Filter & Search Bar Rumah Survei -->
          <div class="katalog-filter-card">
            <div class="katalog-filter-row">
              <div class="katalog-search-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="katalogSearchInput" class="katalog-search-input" placeholder="Cari judul survei, instansi, atau wilayah..." oninput="filterKatalogCards()">
              </div>
              <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <select id="katalogFilterJenis" class="katalog-filter-select" onchange="filterKatalogCards()">
                  <option value="">Semua Jenis Survei</option>
                  <option value="IKM">IKM (Indeks Kepuasan)</option>
                  <option value="SKM">SKM</option>
                  <option value="Ketenagakerjaan">Ketenagakerjaan</option>
                  <option value="Kesehatan">Kesehatan</option>
                  <option value="Pendidikan">Pendidikan</option>
                  <option value="Sosial Ekonomi">Sosial Ekonomi</option>
                </select>
                <select id="katalogFilterStatus" class="katalog-filter-select" onchange="filterKatalogCards()">
                  <option value="">Semua Status</option>
                  <option value="Aktif">Aktif</option>
                  <option value="Selesai">Selesai</option>
                  <option value="Non-Aktif">Non-Aktif</option>
                </select>
                <button type="button" class="btn btn-sm btn-primary" style="background: var(--ide-navy); font-weight: 700; height: 44px; border-radius: 12px; padding: 0 18px; display: inline-flex; align-items: center; gap: 8px;" onclick="initNewSurveyBuilder()">
                  <i class="fa-solid fa-plus"></i> Buat Survei Baru
                </button>
              </div>
            </div>
          </div>

          <!-- Statistik Rangkuman Rumah Survei -->
          <?php
            $katalogTotalSurvei = count($surveiList);
            $katalogTotalResp = 0;
            $katalogTotalSkor = 0;
            $katalogSurveiAktif = 0;
            foreach ($surveiList as $ks) {
              $katalogTotalResp += (int)($ks['TotalResponden'] ?? 0);
              $katalogTotalSkor += (float)($ks['RataRataSkor'] ?? 0);
              if (($ks['Status'] ?? '') === 'Aktif') $katalogSurveiAktif++;
            }
            $katalogAvgSkor = ($katalogTotalSurvei > 0) ? round($katalogTotalSkor / $katalogTotalSurvei, 2) : 0;
          ?>
          <div class="katalog-stats-strip">
            <div class="katalog-stat-box">
              <div class="katalog-stat-icon" style="background: rgba(4, 49, 104, 0.1); color: var(--ide-navy);">
                <i class="fa-solid fa-house-chimney-window"></i>
              </div>
              <div class="katalog-stat-body">
                <div class="katalog-stat-val"><?=$katalogTotalSurvei?></div>
                <div class="katalog-stat-lbl">Total Rumah Survei</div>
              </div>
            </div>
            <div class="katalog-stat-box">
              <div class="katalog-stat-icon" style="background: rgba(16, 185, 129, 0.1); color: #059669;">
                <i class="fa-solid fa-users"></i>
              </div>
              <div class="katalog-stat-body">
                <div class="katalog-stat-val"><?=$katalogTotalResp?></div>
                <div class="katalog-stat-lbl">Total Responden Masuk</div>
              </div>
            </div>
            <div class="katalog-stat-box">
              <div class="katalog-stat-icon" style="background: rgba(2, 132, 199, 0.1); color: #0284c7;">
                <i class="fa-solid fa-star-half-stroke"></i>
              </div>
              <div class="katalog-stat-body">
                <div class="katalog-stat-val"><?=number_format($katalogAvgSkor, 2)?></div>
                <div class="katalog-stat-lbl">Rata-Rata Indeks Survei</div>
              </div>
            </div>
            <div class="katalog-stat-box">
              <div class="katalog-stat-icon" style="background: rgba(180, 8, 20, 0.1); color: var(--ide-red);">
                <i class="fa-solid fa-circle-check"></i>
              </div>
              <div class="katalog-stat-body">
                <div class="katalog-stat-val"><?=$katalogSurveiAktif?></div>
                <div class="katalog-stat-lbl">Survei Aktif Lapangan</div>
              </div>
            </div>
          </div>

          <!-- Grid Card Masing-Masing Rumah Survei -->
          <div class="survey-grid" id="katalogSurveyGrid">
            <?php if (!empty($surveiList)): ?>
              <?php foreach ($surveiList as $idx => $s): 
                $isMulti = ($s['TipeSurvei'] === 'multi') || (strpos($s['InstrumenList'] ?? '', ',') !== false) || ($s['Id'] == 4) || (stripos($s['Judul'], 'rtkd') !== false);
                $isActive = (($s['Status'] ?? 'Aktif') === 'Aktif');
                $daerahText = !empty($s['DaerahSurvei']) ? $s['DaerahSurvei'] : 'Kabupaten Banyuwangi';
                $totalQ = !empty($s['TotalPertanyaan']) ? (int)$s['TotalPertanyaan'] : 0;
                $estimasi = !empty($s['EstimasiWaktu']) ? $s['EstimasiWaktu'] : '3 - 5 Menit';
                $totalResp = !empty($s['TotalResponden']) ? (int)$s['TotalResponden'] : 0;
                $skorIkm = !empty($s['RataRataSkor']) ? (float)$s['RataRataSkor'] : 0;
              ?>
              <div class="survey-card katalog-survey-card-item" 
                   data-id="<?=$s['Id']?>" 
                   data-title="<?=htmlspecialchars(strtolower($s['Judul']))?>" 
                   data-lembaga="<?=htmlspecialchars(strtolower($s['Lembaga'] ?? ''))?>" 
                   data-daerah="<?=htmlspecialchars(strtolower($daerahText))?>" 
                   data-jenis="<?=htmlspecialchars($s['Jenis'] ?? 'IKM')?>" 
                   data-status="<?=htmlspecialchars($s['Status'] ?? 'Aktif')?>">
                
                <div class="card-header-row">
                  <div class="card-icon">
                    <i class="fa-solid fa-square-poll-vertical"></i>
                  </div>
                  <div style="display: flex; align-items: center; gap: 6px; flex-wrap: wrap; justify-content: flex-end;">
                    <?php if ($isMulti): ?>
                    <span class="badge-multi-instrumen"><i class="fa-solid fa-layer-group"></i> Multi-Instrumen</span>
                    <?php endif; ?>
                    <span class="card-status <?= $isActive ? 'status-active' : 'status-inactive' ?>">
                      <i class="fa-solid <?= $isActive ? 'fa-circle-check' : 'fa-circle-xmark' ?>"></i> <?= htmlspecialchars($s['Status'] ?? 'Aktif') ?>
                    </span>
                  </div>
                </div>

                <h3 class="card-title"><?= htmlspecialchars($s['Judul']) ?></h3>

                <div class="card-meta">
                  <div class="meta-row">
                    <span class="meta-label">Instansi</span>
                    <span class="meta-colon">:</span>
                    <span class="meta-value"><?= htmlspecialchars(!empty($s['Lembaga']) ? $s['Lembaga'] : 'IDE Consultant') ?></span>
                  </div>
                  <div class="meta-row">
                    <span class="meta-label">Jenis &amp; Tahun</span>
                    <span class="meta-colon">:</span>
                    <span class="meta-value">
                      <span class="badge badge-info" style="font-size: 11px; padding: 3px 7px;"><?= htmlspecialchars($s['Jenis'] ?? 'IKM') ?></span>
                      &bull; <?= htmlspecialchars($s['Tahun'] ?? date('Y')) ?>
                    </span>
                  </div>
                  <div class="meta-row">
                    <span class="meta-label">Daerah Survei</span>
                    <span class="meta-colon">:</span>
                    <span class="meta-value">
                      <span class="badge-daerah-survei"><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($daerahText) ?></span>
                    </span>
                  </div>
                  <div class="meta-row">
                    <span class="meta-label">Kuesioner</span>
                    <span class="meta-colon">:</span>
                    <span class="meta-value"><b><?= $totalQ ?></b> Butir Pertanyaan &bull; <?= htmlspecialchars($estimasi) ?></span>
                  </div>
                  <?php if ($totalResp > 0): ?>
                  <div class="meta-row">
                    <span class="meta-label"><?= ($s['Jenis'] ?? '') === 'IKM' ? 'Skor IKM' : 'Skor Survei' ?></span>
                    <span class="meta-colon">:</span>
                    <span class="meta-value" style="color: #059669; font-weight: 800;">
                      <?= number_format($skorIkm, 2) ?> (<?= $totalResp ?> Responden)
                    </span>
                  </div>
                  <?php else: ?>
                  <div class="meta-row">
                    <span class="meta-label">Responden</span>
                    <span class="meta-colon">:</span>
                    <span class="meta-value text-muted" style="font-weight: 500;">
                      0 Responden (Belum ada respon)
                    </span>
                  </div>
                  <?php endif; ?>
                </div>

                <!-- Primary Card Actions (Isi Survei, Peta, QR Code) -->
                <div class="card-actions">
                  <button type="button" class="btn-action-fill" onclick="selectSurveyAndGo(<?=$s['Id']?>, 'isian')" title="Buka lembar isian kuesioner survei ini">
                    <i class="fa-solid fa-pen-to-square"></i> Isi Survei
                  </button>
                  <button type="button" class="btn-action-map" onclick="selectSurveyAndGo(<?=$s['Id']?>, 'peta')" title="Buka Peta Sebaran Responden Google Maps">
                    <i class="fa-solid fa-map-location-dot"></i> Peta
                  </button>
                  <button type="button" class="btn-action-qr" onclick="showSurveyQRCode(<?=$s['Id']?>)" title="Tampilkan QR Code Kuesioner Survei">
                    <i class="fa-solid fa-qrcode"></i> QR Code
                  </button>
                </div>

                <!-- Surveyor & Admin Controls (Edit Studio, Rekap, Excel, Hapus) -->
                <div class="card-surveyor-actions">
                  <button type="button" class="btn-action-edit" onclick="selectSurveyAndGo(<?=$s['Id']?>, 'studio', true)" title="Kelola Formulir &amp; Pertanyaan di Studio">
                    <i class="fa-solid fa-pen-ruler"></i> Edit Studio
                  </button>
                  <button type="button" class="btn-action-rekap" onclick="selectSurveyAndGo(<?=$s['Id']?>, 'rekap')" title="Lihat Rekapitulasi Respon Responden">
                    <i class="fa-solid fa-chart-pie"></i> Rekap (<?= $totalResp ?>)
                  </button>
                  <a href="<?=base_url('IDE/export_responden_excel/' . $s['Id'])?>" class="btn-action-excel" title="Unduh Spreadsheet / Excel Data Responden">
                    <i class="fa-solid fa-file-excel"></i> Excel
                  </a>
                  <?php if ($userLevel != 5): ?>
                  <button type="button" class="btn-action-del" onclick="deleteSurveyTemplate(<?=$s['Id']?>, '<?=addslashes(htmlspecialchars($s['Judul']))?>')" title="Hapus Survei">
                    <i class="fa-solid fa-trash-can"></i> Hapus
                  </button>
                  <?php endif; ?>
                </div>
              </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>

          <!-- Empty State (Jika hasil filter kosong) -->
          <div id="katalogEmptyState" style="display: none; text-align: center; padding: 60px 20px; background: #ffffff; border: 1.5px dashed #cbd5e1; border-radius: 20px; margin-bottom: 30px;">
            <i class="fa-solid fa-clipboard-question" style="font-size: 46px; color: #94a3b8; margin-bottom: 14px; display: block;"></i>
            <h4 style="font-size: 17px; font-weight: 800; color: var(--ide-dark); margin-bottom: 6px;">Rumah Survei Tidak Ditemukan</h4>
            <p style="font-size: 13.5px; color: #64748b; margin: 0 0 16px 0;">Tidak ada instrumen survei yang cocok dengan kriteria pencarian atau filter yang dipilih.</p>
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="$('#katalogSearchInput').val(''); $('#katalogFilterJenis').val(''); $('#katalogFilterStatus').val(''); filterKatalogCards();" style="border-radius: 10px; font-weight: 700;">
              <i class="fa-solid fa-rotate-left"></i> Reset Filter Pencarian
            </button>
          </div>

        </div>

        <!-- ===================================================================
             TAB 1: ISIAN LEMBAR KUESIONER SURVEI (DINAMIS PER SURVEI TERPILIH)
             =================================================================== -->
        <div class="dash-tab-content" id="tabContentIsian">
          <!-- Bar Navigasi Cepat Kembali ke Rumah Survei -->
          <div class="dash-subview-context-bar">
            <button type="button" class="btn btn-sm btn-outline-secondary btn-back-katalog" onclick="switchDashTab('katalog')">
              <i class="fa-solid fa-arrow-left"></i> Kembali ke Rumah Survei
            </button>
            <div class="subview-context-details">
              <span class="subview-badge-context"><i class="fa-solid fa-house-chimney-window"></i> Rumah Survei:</span>
              <span class="active-context-survey-title font-weight-bold" style="color: var(--ide-navy); font-size: 13.5px;">
                <?= !empty($surveiList[0]['Judul']) ? htmlspecialchars($surveiList[0]['Judul']) : 'Survei Terpilih' ?>
              </span>
            </div>
            <div style="display: flex; gap: 8px; align-items: center;">
              <button type="button" class="btn btn-sm btn-light" style="border: 1px solid #cbd5e1; font-weight: 700; border-radius: 8px;" onclick="showSurveyQRCode(currentSurveyId)" title="Tampilkan QR Code Kuesioner">
                <i class="fa-solid fa-qrcode" style="color: var(--ide-red);"></i> QR Code
              </button>
              <a href="#" class="btn btn-sm btn-success" style="font-weight: 700; border-radius: 8px;" onclick="window.location.href=BaseURL+'IDE/export_responden_excel/'+currentSurveyId; return false;" title="Unduh Spreadsheet Excel">
                <i class="fa-solid fa-file-excel"></i> Excel
              </a>
            </div>
          </div>
          <div class="survey-form-card">
            <div class="survey-form-banner" id="formBannerHeader">
              <div class="form-banner-top">
                <span class="badge form-badge-jenis" id="formBadgeJenis">
                  Survei Ketenagakerjaan (RTKD)
                </span>
                <div class="form-banner-actions">
                  <button type="button" class="btn btn-sm btn-light btn-banner-qr" onclick="showSurveyQRCode()">
                    <i class="fa-solid fa-qrcode" style="color: var(--ide-red);"></i> Bagikan QR Code
                  </button>
                  <span class="form-banner-estimasi" id="formEstimasiWaktu">
                    <i class="fa-regular fa-clock"></i> Estimasi: 3 - 5 Menit
                  </span>
                </div>
              </div>
              <h3 class="form-banner-title" id="formSurveyTitle">
                Memuat Formulir Survei...
              </h3>
              <p class="form-banner-desc" id="formSurveyDesc">
                Memuat petunjuk pengisian survei...
              </p>
            </div>

            <form id="dashRespondentForm" onsubmit="submitDashRespondentForm(event)" class="survey-form-body">
              <input type="hidden" id="dashFormSurveyId" name="SurveiId" value="">

              <!-- Bagian 1: Identitas Responden -->
              <div class="form-section-title">
                <i class="fa-solid fa-user-check" style="color: var(--ide-red);"></i> Bagian 1: Identitas Responden
              </div>
              <div class="row">
                <div class="col-md-6 form-group-custom">
                  <label class="form-label-custom">Nama Lengkap Responden <span class="req">*</span></label>
                  <input type="text" class="form-input-custom" name="RespondenNama" id="dashRespNama" required placeholder="Contoh: Budi Santoso">
                </div>
                <div class="col-md-6 form-group-custom">
                  <label class="form-label-custom">NIK / No. KTP (16 Digit)</label>
                  <input type="text" class="form-input-custom" name="RespondenNIK" id="dashRespNIK" maxlength="16" placeholder="Contoh: 3510123456780001">
                </div>
                <div class="col-md-4 form-group-custom">
                  <label class="form-label-custom">No. Telepon / WhatsApp</label>
                  <input type="text" class="form-input-custom" name="RespondenKontak" id="dashRespKontak" placeholder="Contoh: 081234567890">
                </div>
                <div class="col-md-4 form-group-custom">
                  <label class="form-label-custom">Kelompok Usia</label>
                  <select class="form-input-custom" name="RespondenUsia" id="dashRespUsia">
                    <option value="15 - 19 Tahun">15 - 19 Tahun</option>
                    <option value="20 - 24 Tahun" selected>20 - 24 Tahun</option>
                    <option value="25 - 29 Tahun">25 - 29 Tahun</option>
                    <option value="30 - 39 Tahun">30 - 39 Tahun</option>
                    <option value="40 Tahun ke Atas">&ge; 40 Tahun</option>
                  </select>
                </div>
                <div class="col-md-4 form-group-custom">
                  <label class="form-label-custom">Jenis Kelamin</label>
                  <select class="form-input-custom" name="RespondenGender" id="dashRespGender">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="col-md-6 form-group-custom">
                  <label class="form-label-custom">Pendidikan Terakhir</label>
                  <select class="form-input-custom" name="RespondenPendidikan" id="dashRespPendidikan">
                    <option value="SMK Vokasi" selected>SMK Vokasi</option>
                    <option value="SMA Sederajat">SMA Sederajat</option>
                    <option value="Diploma (D3)">Diploma (D3)</option>
                    <option value="Sarjana (S1 / D4)">Sarjana (S1 / D4)</option>
                    <option value="Magister (S2)">Magister (S2)</option>
                    <option value="SMP Sederajat">SMP Sederajat</option>
                    <option value="SD / Lainnya">SD / Lainnya</option>
                  </select>
                </div>
                <div class="col-md-6 form-group-custom">
                  <label class="form-label-custom">Kategori / Status Responden <span class="req">*</span></label>
                  <select class="form-input-custom" name="RespondenPekerjaan" id="dashRespPekerjaan">
                    <option value="Pencari Kerja / Fresh Graduate" selected>Pencari Kerja / Fresh Graduate (Instrumen B)</option>
                    <option value="Pemberi Kerja / Pelaku Usaha (Perusahaan)">Pemberi Kerja / Pelaku Usaha (Instrumen A)</option>
                    <option value="Siswa Kelas 12 (SMK / SMA / MA)">Siswa Kelas 12 (Instrumen D)</option>
                    <option value="Karyawan Swasta / Buruh Industri">Karyawan Swasta / Buruh Industri</option>
                    <option value="Pemangku Kepentingan / Stakeholder">Pemangku Kepentingan / Stakeholder (Instrumen C)</option>
                    <option value="Wirausaha Mandiri / Pekerja Lepas">Wirausaha Mandiri / Pekerja Lepas</option>
                    <option value="Aparatur Pemerintah / ASN">Aparatur Pemerintah / ASN</option>
                  </select>
                </div>
              </div>

              <!-- Bagian 2: Wilayah & Lokasi Geospasial Google Maps -->
              <div class="form-section-title" style="margin-top: 15px;">
                <i class="fa-solid fa-map-location-dot" style="color: var(--ide-red);"></i> Bagian 2: Keterangan Wilayah &amp; Lokasi Geospasial Google Maps
              </div>
              <div class="row">
                <div class="col-md-4 form-group-custom">
                  <label class="form-label-custom">Provinsi</label>
                  <input type="text" class="form-input-custom" name="Provinsi" id="dashProvinsi" value="Jawa Timur" readonly>
                </div>
                <div class="col-md-4 form-group-custom">
                  <label class="form-label-custom">Kabupaten / Kota</label>
                  <input type="text" class="form-input-custom" name="Kabupaten" id="dashKabupaten" value="Kabupaten Banyuwangi">
                </div>
                <div class="col-md-4 form-group-custom">
                  <label class="form-label-custom">Kecamatan <span class="req">*</span></label>
                  <select class="form-input-custom" name="Kecamatan" id="dashKecamatan" onchange="onDashKecamatanChange(this.value)">
                    <option value="Bangorejo">Bangorejo</option>
                    <option value="Banyuwangi">Banyuwangi</option>
                    <option value="Blimbingsari">Blimbingsari</option>
                    <option value="Cluring">Cluring</option>
                    <option value="Gambiran">Gambiran</option>
                    <option value="Genteng">Genteng</option>
                    <option value="Giri">Giri</option>
                    <option value="Glagah">Glagah</option>
                    <option value="Glenmore">Glenmore</option>
                    <option value="Kabat">Kabat</option>
                    <option value="Kalibaru">Kalibaru</option>
                    <option value="Kalipuro">Kalipuro</option>
                    <option value="Licin">Licin</option>
                    <option value="Muncar">Muncar</option>
                    <option value="Pesanggaran">Pesanggaran</option>
                    <option value="Purwoharjo">Purwoharjo</option>
                    <option value="Rogojampi">Rogojampi</option>
                    <option value="Sempu">Sempu</option>
                    <option value="Siliragung">Siliragung</option>
                    <option value="Singojuruh">Singojuruh</option>
                    <option value="Songgon">Songgon</option>
                    <option value="Srono">Srono</option>
                    <option value="Tegaldlimo">Tegaldlimo</option>
                    <option value="Tegalsari">Tegalsari</option>
                    <option value="Wongsorejo">Wongsorejo</option>
                  </select>
                </div>
                <div class="col-md-6 form-group-custom">
                  <label class="form-label-custom">Desa / Kelurahan</label>
                  <input type="text" class="form-input-custom" name="Desa" id="dashDesa" placeholder="Contoh: Desa Temenggungan">
                </div>
                <div class="col-md-6 form-group-custom">
                  <label class="form-label-custom">Alamat Lengkap</label>
                  <input type="text" class="form-input-custom" name="AlamatDetail" id="dashAlamat" placeholder="Nama jalan, RT/RW, nomor rumah">
                </div>
              </div>

              <!-- Geotagging GPS & Mini Google Map -->
              <div class="gps-capture-panel">
                <div class="gps-panel-header">
                  <div>
                    <strong style="color: #166534; font-size: 13.5px;"><i class="fa-solid fa-satellite-dish"></i> Geotagging Lokasi GPS Google Maps</strong>
                    <div style="font-size: 11.5px; color: #64748b;">Titik koordinat otomatis terdeteksi atau geser pin pada peta Google Maps untuk penyesuaian presisi.</div>
                  </div>
                  <button type="button" class="btn-capture-gps" onclick="captureDashGPS()">
                    <i class="fa-solid fa-crosshairs"></i> Deteksi GPS Saya
                  </button>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6 form-group-custom">
                    <label class="form-label-custom" style="font-size: 11.5px; margin-bottom: 4px;">Latitude</label>
                    <input type="text" class="form-input-custom" name="Latitude" id="dashLatitude" value="-8.219200">
                  </div>
                  <div class="col-xs-12 col-sm-6 form-group-custom">
                    <label class="form-label-custom" style="font-size: 11.5px; margin-bottom: 4px;">Longitude</label>
                    <input type="text" class="form-input-custom" name="Longitude" id="dashLongitude" value="114.369200">
                  </div>
                </div>
                <!-- Interactive Mini Google Map -->
                <div id="dashFormMiniGoogleMap" class="google-mini-map"></div>
              </div>

              <!-- Bagian 3: Butir-Butir Pertanyaan Kuesioner Survei -->
              <div class="form-section-title" style="margin-top: 25px;">
                <i class="fa-solid fa-list-check" style="color: var(--ide-red);"></i> Bagian 3: Butir Pertanyaan Penilaian Kuesioner
              </div>
              <div id="dashQuestionsContainer">
                <div style="text-align: center; padding: 40px; color: #64748b;">
                  <i class="fa-solid fa-spinner fa-spin" style="font-size: 28px; margin-bottom: 12px; color: var(--ide-navy);"></i>
                  <div>Memuat butir pertanyaan survei...</div>
                </div>
              </div>

              <!-- Form Action Buttons -->
              <div class="form-actions-footer">
                <div>
                  <button type="reset" class="btn btn-light" style="border-radius: 12px; font-weight: 700; padding: 12px 20px;">
                    <i class="fa-solid fa-rotate-left"></i> Reset Isian
                  </button>
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                  <button type="button" class="btn btn-outline-secondary" style="border-radius: 12px; font-weight: 700; padding: 12px 18px;" onclick="window.saveDashSurveyOfflineDirect && window.saveDashSurveyOfflineDirect()">
                    <i class="fa-solid fa-cloud-arrow-down"></i> Simpan ke Antrean Offline
                  </button>
                  <button type="button" class="btn btn-outline-primary" style="border-radius: 12px; font-weight: 700; padding: 12px 18px;" onclick="previewPublicSurvey()">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Tampilan Publik
                  </button>
                  <button type="submit" class="btn-submit-survey-data" id="btnSubmitSurvey">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Simpan Isian Responden
                  </button>
                </div>
              </div>

            </form>
          </div>
        </div>

        <!-- ===================================================================
             TAB 2: PETA SEBARAN SPASIAL GOOGLE MAPS
             =================================================================== -->
        <div class="dash-tab-content" id="tabContentPeta">
          <!-- Bar Navigasi Cepat Kembali ke Rumah Survei -->
          <div class="dash-subview-context-bar">
            <button type="button" class="btn btn-sm btn-outline-secondary btn-back-katalog" onclick="switchDashTab('katalog')">
              <i class="fa-solid fa-arrow-left"></i> Kembali ke Rumah Survei
            </button>
            <div class="subview-context-details">
              <span class="subview-badge-context"><i class="fa-solid fa-house-chimney-window"></i> Rumah Survei:</span>
              <span class="active-context-survey-title font-weight-bold" style="color: var(--ide-navy); font-size: 13.5px;">
                <?= !empty($surveiList[0]['Judul']) ? htmlspecialchars($surveiList[0]['Judul']) : 'Survei Terpilih' ?>
              </span>
            </div>
            <div style="display: flex; gap: 8px; align-items: center;">
              <button type="button" class="btn btn-sm btn-light" style="border: 1px solid #cbd5e1; font-weight: 700; border-radius: 8px;" onclick="showSurveyQRCode(currentSurveyId)" title="Tampilkan QR Code Kuesioner">
                <i class="fa-solid fa-qrcode" style="color: var(--ide-red);"></i> QR Code
              </button>
              <a href="#" class="btn btn-sm btn-success" style="font-weight: 700; border-radius: 8px;" onclick="window.location.href=BaseURL+'IDE/export_responden_excel/'+currentSurveyId; return false;" title="Unduh Spreadsheet Excel">
                <i class="fa-solid fa-file-excel"></i> Excel
              </a>
            </div>
          </div>
          <div class="google-gis-card">
            <div class="gis-top-bar">
              <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <span class="badge" style="background: #e0f2fe; color: #0369a1; padding: 6px 12px; font-size: 12px; font-weight: 700; border-radius: 8px;">
                  <i class="fa-solid fa-map-location-dot"></i> Pemetaan Spasial GIS
                </span>
                <strong style="color: var(--ide-navy); font-size: 15px;" id="gisSurveyTitleText">Peta Sebaran Responden</strong>
                <!-- Watermark-Free Layer Switcher -->
                <div style="display: flex; gap: 6px; margin-left: 10px;">
                  <button type="button" class="btn-map-layer-switch active" id="btnLayerGoogle" onclick="switchMapBaseLayer('google')">
                    <i class="fa-solid fa-map"></i> Google Maps
                  </button>
                  <button type="button" class="btn-map-layer-switch" id="btnLayerSatelit" onclick="switchMapBaseLayer('satelit')">
                    <i class="fa-solid fa-satellite"></i> Satelit
                  </button>
                  <button type="button" class="btn-map-layer-switch" id="btnLayerOSM" onclick="switchMapBaseLayer('osm')">
                    <i class="fa-solid fa-globe"></i> OpenStreetMap
                  </button>
                </div>
              </div>
              <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <select id="gisKecamatanFilter" class="form-control form-control-sm" style="width: 200px; border-radius: 8px; font-weight: 700;" onchange="filterGoogleMapKecamatan(this.value)">
                  <option value="">Semua Kecamatan (25)</option>
                </select>
                <button type="button" class="btn btn-sm btn-outline-dark" style="border-radius: 8px; font-weight: 700; background: #fff;" onclick="showSurveyQRCode()" title="QR Code Kuesioner">
                  <i class="fa-solid fa-qrcode" style="color: var(--ide-red);"></i> QR Code
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="reloadGoogleMapData()" title="Muat Ulang Titik">
                  <i class="fa-solid fa-rotate"></i> Refresh
                </button>
                <button type="button" class="btn btn-sm btn-success" onclick="exportCurrentSurveyExcel()" title="Unduh Excel">
                  <i class="fa-solid fa-file-excel"></i> Ekspor Excel
                </button>
              </div>
            </div>

            <!-- Workspace: Google Maps Canvas + Sidebar -->
            <div class="gis-grid-layout">
              <div id="dashGoogleSurveiMap" class="google-map-canvas"></div>
              
              <!-- Sidebar Info Kecamatan & Responden Feed -->
              <div class="gis-sidebar-panel">
                <div class="gis-focus-card">
                  <div style="font-size: 11px; font-weight: 800; color: #0369a1; text-transform: uppercase;">Wilayah Aktif</div>
                  <h4 id="focusKecName" style="font-size: 16px; font-weight: 800; color: var(--ide-dark); margin: 4px 0 10px 0;">Kabupaten Banyuwangi</h4>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 12px;">
                    <div><span style="color: #64748b;">Total Respon:</span> <strong id="focusKecTotal">0</strong></div>
                    <div><span style="color: #64748b;">Rata-Rata:</span> <strong id="focusKecSkor" style="color: #059669;">0.00</strong></div>
                    <div><span style="color: #64748b;">Mutu:</span> <strong id="focusKecMutu">-</strong></div>
                    <div><span style="color: #64748b;">Terakhir:</span> <strong id="focusKecTime">-</strong></div>
                  </div>
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between;">
                  <strong style="font-size: 13px; color: var(--ide-dark);"><i class="fa-solid fa-location-dot" style="color: var(--ide-red);"></i> Titik Responden Terbaru</strong>
                  <span class="badge badge-secondary" id="gisTotalPointsBadge">0 Titik</span>
                </div>

                <div id="gisRespondentFeedList" style="flex: 1; overflow-y: auto;">
                  <!-- Rendered dynamically -->
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- ===================================================================
             TAB 3: REKAPITULASI DATA RESPONDEN & HASIL SURVEI
             =================================================================== -->
        <div class="dash-tab-content" id="tabContentRekap">
          <!-- Bar Navigasi Cepat Kembali ke Rumah Survei -->
          <div class="dash-subview-context-bar">
            <button type="button" class="btn btn-sm btn-outline-secondary btn-back-katalog" onclick="switchDashTab('katalog')">
              <i class="fa-solid fa-arrow-left"></i> Kembali ke Rumah Survei
            </button>
            <div class="subview-context-details">
              <span class="subview-badge-context"><i class="fa-solid fa-house-chimney-window"></i> Rumah Survei:</span>
              <span class="active-context-survey-title font-weight-bold" style="color: var(--ide-navy); font-size: 13.5px;">
                <?= !empty($surveiList[0]['Judul']) ? htmlspecialchars($surveiList[0]['Judul']) : 'Survei Terpilih' ?>
              </span>
            </div>
            <div style="display: flex; gap: 8px; align-items: center;">
              <button type="button" class="btn btn-sm btn-light" style="border: 1px solid #cbd5e1; font-weight: 700; border-radius: 8px;" onclick="showSurveyQRCode(currentSurveyId)" title="Tampilkan QR Code Kuesioner">
                <i class="fa-solid fa-qrcode" style="color: var(--ide-red);"></i> QR Code
              </button>
              <a href="#" class="btn btn-sm btn-success" style="font-weight: 700; border-radius: 8px;" onclick="window.location.href=BaseURL+'IDE/export_responden_excel/'+currentSurveyId; return false;" title="Unduh Spreadsheet Excel">
                <i class="fa-solid fa-file-excel"></i> Excel
              </a>
            </div>
          </div>
          <div class="rekap-card">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; margin-bottom: 20px;">
              <div>
                <h3 style="font-size: 20px; font-weight: 800; color: var(--ide-dark); margin: 0 0 4px 0;">
                  <i class="fa-solid fa-table-list" style="color: var(--ide-red);"></i> Rekapitulasi Data Responden
                </h3>
                <p style="font-size: 13.5px; color: #64748b; margin: 0;">Daftar respon dan isian kuesioner yang telah disubmit untuk survei terpilih.</p>
              </div>
              <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <button type="button" class="btn btn-outline-primary" style="border-radius: 12px; font-weight: 700; padding: 10px 18px;" onclick="showSurveyQRCode()">
                  <i class="fa-solid fa-qrcode"></i> QR Code Kuesioner
                </button>
                <button type="button" class="btn btn-success" style="border-radius: 12px; font-weight: 700; padding: 10px 20px;" onclick="exportCurrentSurveyExcel()">
                  <i class="fa-solid fa-file-excel"></i> Unduh Data Responden (Excel)
                </button>
              </div>
            </div>

            <!-- ===================================================================
                 VISUALISASI DATA ANALITIK SURVEI OTOMATIS (DONAT, BATANG, LINGKARAN)
                 =================================================================== -->
            <div class="rekap-charts-section" style="margin-bottom: 28px; padding-bottom: 24px; border-bottom: 2px dashed #e2e8f0;">
              <!-- Section Title & Status Badge -->
              <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; flex-wrap: wrap; gap: 10px;">
                <div>
                  <h4 style="font-size: 16px; font-weight: 800; color: var(--ide-navy); margin: 0; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-chart-line" style="color: var(--ide-red);"></i> Visualisasi Data &amp; Analitik Parameter Survei
                  </h4>
                  <p style="font-size: 13px; color: #64748b; margin: 3px 0 0 0;">
                    Grafik tergenerate otomatis secara real-time berdasarkan data responden yang terhimpun dan parameter butir pertanyaan.
                  </p>
                </div>
                <div id="chartBadgeInfo" style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                  <span class="badge" style="background: rgba(4, 49, 104, 0.08); color: var(--ide-navy); font-weight: 700; padding: 6px 12px; border-radius: 8px; font-size: 12px;" id="chartSurveyTitleBadge">
                    Memuat survei...
                  </span>
                  <span class="badge badge-success" style="padding: 6px 12px; border-radius: 8px; font-size: 12px;" id="chartTotalRespBadge">
                    0 Responden
                  </span>
                </div>
              </div>

              <!-- Grid 3 Bagan: Donat, Batang, Lingkaran -->
              <div class="row">
                <!-- 1. Bagan Donat: Distribusi Mutu Pelayanan & Indeks Kepuasan -->
                <div class="col-xl-4 col-lg-6 col-md-12 mb-4">
                  <div class="rekap-chart-card">
                    <div class="chart-card-header">
                      <div class="chart-card-title">
                        <i class="fa-solid fa-circle-dot" style="color: #10b981;"></i> Bagan Donat: Mutu Pelayanan
                      </div>
                      <span class="chart-card-subtitle" id="donutMutuSubtitle">Distribusi Kategori Mutu Responden</span>
                    </div>
                    <div class="chart-card-body" style="position: relative; height: 260px; width: 100%;">
                      <canvas id="dashRekapDonutMutu" style="display: block; width: 100% !important; height: 260px !important;"></canvas>
                      <div id="donutEmptyState" class="chart-empty-state" style="display: none;">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Belum ada data responden</span>
                      </div>
                    </div>
                    <div class="chart-card-footer" id="donutMutuLegend" style="display: flex; justify-content: space-around; font-size: 11.5px; border-top: 1px solid #f1f5f9; padding-top: 10px; margin-top: 5px;">
                      <!-- Legend auto updated -->
                    </div>
                  </div>
                </div>

                <!-- 2. Bagan Batang: Rata-rata Skor per Parameter / Butir Pertanyaan -->
                <div class="col-xl-4 col-lg-6 col-md-12 mb-4">
                  <div class="rekap-chart-card">
                    <div class="chart-card-header">
                      <div class="chart-card-title">
                        <i class="fa-solid fa-chart-column" style="color: var(--ide-navy);"></i> Bagan Batang: Parameter Survei
                      </div>
                      <span class="chart-card-subtitle">Rata-Rata Skor per Butir Pertanyaan (Skala 1 - 5)</span>
                    </div>
                    <div class="chart-card-body" style="position: relative; height: 260px; width: 100%;">
                      <canvas id="dashRekapBarParameter" style="display: block; width: 100% !important; height: 260px !important;"></canvas>
                      <div id="barEmptyState" class="chart-empty-state" style="display: none;">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span>Belum ada data parameter pertanyaan</span>
                      </div>
                    </div>
                    <div class="chart-card-footer" style="font-size: 11px; color: #64748b; border-top: 1px solid #f1f5f9; padding-top: 10px; margin-top: 5px; text-align: center;">
                      <span style="display: inline-block; margin: 0 4px;"><i class="fa-solid fa-square" style="color: #10b981;"></i> &ge;4.0 Sangat Baik</span>
                      <span style="display: inline-block; margin: 0 4px;"><i class="fa-solid fa-square" style="color: #0284c7;"></i> 3.5-3.9 Baik</span>
                      <span style="display: inline-block; margin: 0 4px;"><i class="fa-solid fa-square" style="color: #f59e0b;"></i> 3.0-3.4 Cukup</span>
                      <span style="display: inline-block; margin: 0 4px;"><i class="fa-solid fa-square" style="color: #ef4444;"></i> &lt;3.0 Kurang</span>
                    </div>
                  </div>
                </div>

                <!-- 3. Diagram Lingkaran: Demografi Responden (Gender, Usia, Wilayah) -->
                <div class="col-xl-4 col-lg-12 col-md-12 mb-4">
                  <div class="rekap-chart-card">
                    <div class="chart-card-header" style="display: flex; justify-content: space-between; align-items: center;">
                      <div>
                        <div class="chart-card-title">
                          <i class="fa-solid fa-chart-pie" style="color: var(--ide-red);"></i> Diagram Lingkaran: Demografi
                        </div>
                        <span class="chart-card-subtitle">Sebaran Profil Responden Terhimpun</span>
                      </div>
                      <!-- Demographic Switcher Pills -->
                      <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-secondary active btn-demo-filter" id="btnDemoGender" onclick="switchDemographicPie('gender')" title="Jenis Kelamin">
                          Gender
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-demo-filter" id="btnDemoUsia" onclick="switchDemographicPie('usia')" title="Kelompok Usia">
                          Usia
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-demo-filter" id="btnDemoKec" onclick="switchDemographicPie('kecamatan')" title="Sebaran Kecamatan">
                          Wilayah
                        </button>
                      </div>
                    </div>
                    <div class="chart-card-body" style="position: relative; height: 260px; width: 100%;">
                      <canvas id="dashRekapPieDemografi" style="display: block; width: 100% !important; height: 260px !important;"></canvas>
                      <div id="pieEmptyState" class="chart-empty-state" style="display: none;">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Belum ada data demografi</span>
                      </div>
                    </div>
                    <div class="chart-card-footer" id="pieDemografiLegend" style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 6px; font-size: 11px; border-top: 1px solid #f1f5f9; padding-top: 10px; margin-top: 5px;">
                      <!-- Legend auto updated -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- ===============================================================
                 TOOLBAR FILTER & PENCARIAN REKAPITULASI DATA RESPONDEN
                 =============================================================== -->
            <div class="rekap-filter-toolbar" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 18px 20px; margin-bottom: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.02);">
              <!-- Baris 1: Kolom Search Input & Status Counter -->
              <div class="row align-items-center mb-3">
                <div class="col-lg-6 col-md-12 mb-2 mb-lg-0">
                  <div class="rekap-search-wrap" style="position: relative;">
                    <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #64748b; font-size: 14px;"></i>
                    <input type="text" id="rekapSearchInput" class="form-control" placeholder="Cari data responden (Nama, NIK, kontak, instansi, alamat, kecamatan)..." style="padding-left: 42px; padding-right: 40px; height: 44px; border-radius: 12px; border: 1.5px solid #cbd5e1; font-size: 13.5px; box-shadow: 0 1px 4px rgba(0,0,0,0.02);" oninput="applyDashboardRekapFilters()">
                    <button type="button" id="rekapSearchClearBtn" onclick="clearRekapSearch()" style="display: none; position: absolute; right: 12px; top: 50%; transform: translateY(-50%); border: none; background: transparent; color: #94a3b8; font-size: 16px; cursor: pointer; padding: 4px;" title="Bersihkan pencarian">
                      <i class="fa-solid fa-circle-xmark"></i>
                    </button>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 text-lg-right text-left">
                  <div style="display: flex; gap: 8px; justify-content: flex-end; align-items: center; flex-wrap: wrap;">
                    <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 700; padding: 8px 14px; border-radius: 10px; font-size: 12.5px;" id="rekapFilterCountBadge">
                      <i class="fa-solid fa-users"></i> Menampilkan 0 Responden
                    </span>
                    <button type="button" class="btn btn-sm btn-outline-secondary" style="border-radius: 10px; font-weight: 700; height: 38px; padding: 0 14px; border: 1.5px solid #cbd5e1;" onclick="resetDashboardRekapFilters()" title="Reset semua filter dan pencarian">
                      <i class="fa-solid fa-rotate-left"></i> Reset Filter
                    </button>
                  </div>
                </div>
              </div>

              <!-- Baris 2: Filter Dropdown (Instrumen, Wilayah, Mutu, Sort Order) -->
              <div class="row" style="row-gap: 10px;">
                <div class="col-lg-3 col-md-6 col-12" id="filterColInstrumen">
                  <label style="font-size: 11.5px; font-weight: 800; color: #475569; text-transform: uppercase; margin-bottom: 5px; display: flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-layer-group" style="color: var(--ide-navy);"></i> Instrumen Survei
                  </label>
                  <select id="rekapFilterInstrumen" class="form-control form-control-sm" style="border-radius: 10px; height: 38px; border: 1.5px solid #cbd5e1; font-weight: 600; font-size: 12.5px;" onchange="applyDashboardRekapFilters()">
                    <option value="">Semua Instrumen</option>
                    <option value="A">Instrumen A - Perusahaan / Pemberi Kerja</option>
                    <option value="B">Instrumen B - Pencari Kerja &amp; Lulusan</option>
                    <option value="C">Instrumen C - Pemangku Kepentingan</option>
                    <option value="E">Instrumen C2 / E - AHP Isu Strategis</option>
                    <option value="D">Instrumen D - Siswa Kelas 12</option>
                  </select>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                  <label style="font-size: 11.5px; font-weight: 800; color: #475569; text-transform: uppercase; margin-bottom: 5px; display: flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-location-dot" style="color: var(--ide-red);"></i> Wilayah / Kecamatan
                  </label>
                  <select id="rekapFilterKecamatan" class="form-control form-control-sm" style="border-radius: 10px; height: 38px; border: 1.5px solid #cbd5e1; font-weight: 600; font-size: 12.5px;" onchange="applyDashboardRekapFilters()">
                    <option value="">Semua Wilayah</option>
                  </select>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                  <label style="font-size: 11.5px; font-weight: 800; color: #475569; text-transform: uppercase; margin-bottom: 5px; display: flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-award" style="color: #10b981;"></i> Mutu Pelayanan
                  </label>
                  <select id="rekapFilterMutu" class="form-control form-control-sm" style="border-radius: 10px; height: 38px; border: 1.5px solid #cbd5e1; font-weight: 600; font-size: 12.5px;" onchange="applyDashboardRekapFilters()">
                    <option value="">Semua Mutu</option>
                    <option value="Sangat Baik">Sangat Baik (A)</option>
                    <option value="Baik">Baik (B)</option>
                    <option value="Kurang Baik">Kurang Baik (C)</option>
                    <option value="Tidak Baik">Tidak Baik (D)</option>
                  </select>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                  <label style="font-size: 11.5px; font-weight: 800; color: #475569; text-transform: uppercase; margin-bottom: 5px; display: flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-arrow-down-wide-short" style="color: #0284c7;"></i> Urutkan Data
                  </label>
                  <select id="rekapSortOrder" class="form-control form-control-sm" style="border-radius: 10px; height: 38px; border: 1.5px solid #cbd5e1; font-weight: 600; font-size: 12.5px;" onchange="applyDashboardRekapFilters()">
                    <option value="newest">Waktu Terbaru</option>
                    <option value="oldest">Waktu Terlama</option>
                    <option value="name_asc">Nama Responden (A - Z)</option>
                    <option value="name_desc">Nama Responden (Z - A)</option>
                    <option value="score_desc">Skor Tertinggi</option>
                    <option value="score_asc">Skor Terendah</option>
                    <option value="with_photo">Khusus Ada Foto Lapangan</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Tabel Data Responden -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dashRekapTable" style="width: 100%;">
                <thead class="thead-light">
                  <tr>
                    <th style="width: 45px; text-align: center;">No</th>
                    <th style="width: 155px;"><i class="fa-regular fa-clock" style="color: var(--ide-red); margin-right: 4px;"></i>Waktu Pengisian (WIB)</th>
                    <th>Nama Responden &amp; Profil</th>
                    <th>Wilayah (Kecamatan / Desa)</th>
                    <th>Demografi</th>
                    <th style="text-align: center; width: 110px;">Foto Lapangan</th>
                    <th style="text-align: center; width: 95px;">Rata-Rata Skor</th>
                    <th style="text-align: center; width: 105px;">Mutu</th>
                    <th style="text-align: center; width: 125px;">Aksi</th>
                  </tr>
                </thead>
                <tbody id="dashRekapTableBody">
                  <tr>
                    <td colspan="9" style="text-align: center; padding: 30px; color: #64748b;">
                      Memuat data responden...
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- ===================================================================
             TAB 4: STUDIO PEMBUAT SURVEI DINAMIS (GOOGLE FORM BUILDER)
             =================================================================== -->
        <div class="dash-tab-content" id="tabContentStudio">
          <!-- Bar Navigasi Cepat Kembali ke Rumah Survei -->
          <div class="dash-subview-context-bar">
            <button type="button" class="btn btn-sm btn-outline-secondary btn-back-katalog" onclick="switchDashTab('katalog')">
              <i class="fa-solid fa-arrow-left"></i> Kembali ke Rumah Survei
            </button>
            <div class="subview-context-details">
              <span class="subview-badge-context"><i class="fa-solid fa-house-chimney-window"></i> Rumah Survei:</span>
              <span class="active-context-survey-title font-weight-bold" style="color: var(--ide-navy); font-size: 13.5px;">
                <?= !empty($surveiList[0]['Judul']) ? htmlspecialchars($surveiList[0]['Judul']) : 'Survei Terpilih' ?>
              </span>
            </div>
            <div style="display: flex; gap: 8px; align-items: center;">
              <button type="button" class="btn btn-sm btn-light" style="border: 1px solid #cbd5e1; font-weight: 700; border-radius: 8px;" onclick="showSurveyQRCode(currentSurveyId)" title="Tampilkan QR Code Kuesioner">
                <i class="fa-solid fa-qrcode" style="color: var(--ide-red);"></i> QR Code
              </button>
              <a href="#" class="btn btn-sm btn-success" style="font-weight: 700; border-radius: 8px;" onclick="window.location.href=BaseURL+'IDE/export_responden_excel/'+currentSurveyId; return false;" title="Unduh Spreadsheet Excel">
                <i class="fa-solid fa-file-excel"></i> Excel
              </a>
            </div>
          </div>
          <div class="survey-form-card">
            <input type="hidden" id="builderSurveyId" value="">
            <div class="survey-form-banner">
                            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                <h3 class="form-banner-title" id="builderStudioTitle" style="margin: 0;"><i class="fa-solid fa-pen-ruler navy-icon"></i> Studio Pembuat Survei Dinamis</h3>
                <button type="button" class="btn btn-sm btn-light" style="border-radius: 8px; font-weight: 700; color: var(--ide-navy);" onclick="initNewSurveyBuilder()">
                  <i class="fa-solid fa-plus-circle"></i> Buat Survei Baru
                </button>
              </div>
              <p class="form-banner-desc">Buat dan atur instrumen survei baru, rumuskan butir-butir pertanyaan dengan variasi model jawaban dan penilaian seperti Google Form, serta kustomisasi bobot nilai terstandar.</p>
            </div>
            <div class="survey-form-body">
              <div class="row">
                <div class="col-md-6 form-group-custom">
                  <label class="form-label-custom">Judul Survei <span class="req">*</span></label>
                  <input type="text" class="form-input-custom" id="builderJudul" placeholder="Contoh: Survei Kepuasan Layanan Publik 2026">
                </div>
                <div class="col-md-6 form-group-custom">
                  <label class="form-label-custom">Instansi / Lembaga Pelaksana <span class="req">*</span></label>
                  <input type="text" class="form-input-custom" id="builderLembaga" placeholder="Contoh: Dinas Tenaga Kerja dan Perindustrian">
                </div>
                <div class="col-md-4 form-group-custom">
                  <label class="form-label-custom">Jenis Survei</label>
                  <select class="form-input-custom" id="builderJenis">
                    <option value="IKM" selected>IKM (Indeks Kepuasan Masyarakat)</option>
                    <option value="SKM">SKM (Survei Kepuasan Masyarakat)</option>
                    <option value="Ketenagakerjaan">Ketenagakerjaan</option>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Infrastruktur">Infrastruktur</option>
                    <option value="Sosial Ekonomi">Sosial Ekonomi</option>
                  </select>
                </div>
                <div class="col-md-4 form-group-custom">
                  <label class="form-label-custom">Tahun Pelaksanaan</label>
                  <input type="number" class="form-input-custom" id="builderTahun" value="<?=date('Y')?>">
                </div>
                <div class="col-md-4 form-group-custom">
                  <label class="form-label-custom">Cakupan Daerah</label>
                  <input type="text" class="form-input-custom" id="builderDaerah" value="Kabupaten Banyuwangi">
                </div>
                <div class="col-md-12 form-group-custom">
                  <label class="form-label-custom">Deskripsi &amp; Petunjuk Pengisian Bagi Responden</label>
                  <textarea class="form-textarea-custom" id="builderDeskripsi" placeholder="Jelaskan tujuan survei, landasan hukum/kebijakan, dan cara pengisian kuesioner..."></textarea>
                </div>
              </div>

              <!-- Question Cards Builder Area (Google Form Model) -->
              <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-top: 25px; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 2px solid #f1f5f9;">
                <div class="form-section-title" style="margin: 0; padding: 0; border: none;">
                  <i class="fa-solid fa-list-ol navy-icon"></i> Daftar Butir Pertanyaan &amp; Penilaian Jawaban Dinamis
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                  <span id="dashBuilderQuestionsCounter" class="badge" style="background: rgba(4, 49, 104, 0.08); color: var(--ide-navy); padding: 7px 14px; font-size: 12px; font-weight: 800; border-radius: 8px;">
                    <i class="fa-solid fa-list-check navy-icon"></i> 0 Pertanyaan
                  </span>
                  <button type="button" class="btn btn-sm btn-outline-primary" style="border-radius: 10px; font-weight: 700; font-size: 12px; padding: 7px 14px; border-color: var(--ide-navy); color: var(--ide-navy);" onclick="addDashBuilderQuestion('radio')" title="Tambah Butir Baru">
                    <i class="fa-solid fa-plus navy-icon"></i> Tambah Pertanyaan
                  </button>
                </div>
              </div>

              <!-- Container Pertanyaan Dinamis -->
              <div id="builderQuestionsList">
                <!-- Rendered dynamically by JS -->
              </div>

              <!-- Action Bar Tambah Cepat Pertanyaan & Preset -->
              <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 25px; background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 14px; padding: 14px 18px;">
                <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
                  <span style="font-size: 12px; font-weight: 800; color: var(--ide-navy); text-transform: uppercase; margin-right: 4px;">
                    <i class="fa-solid fa-plus-circle navy-icon"></i> Tambah Cepat:
                  </span>
                  <button type="button" class="btn btn-sm btn-outline-primary" style="border-radius: 10px; font-weight: 700; padding: 6px 14px; border-color: var(--ide-navy); color: var(--ide-navy); background: #ffffff;" onclick="addDashBuilderQuestion('radio')">
                    <i class="fa-solid fa-circle-dot navy-icon"></i> Pilihan Ganda
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-primary" style="border-radius: 10px; font-weight: 700; padding: 6px 14px; border-color: var(--ide-navy); color: var(--ide-navy); background: #ffffff;" onclick="addDashBuilderQuestion('scale')">
                    <i class="fa-solid fa-sliders navy-icon"></i> Skala Rating
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-primary" style="border-radius: 10px; font-weight: 700; padding: 6px 14px; border-color: var(--ide-navy); color: var(--ide-navy); background: #ffffff;" onclick="addDashBuilderQuestion('checkbox')">
                    <i class="fa-solid fa-square-check navy-icon"></i> Kotak Centang
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-primary" style="border-radius: 10px; font-weight: 700; padding: 6px 14px; border-color: var(--ide-navy); color: var(--ide-navy); background: #ffffff;" onclick="addDashBuilderQuestion('textarea')">
                    <i class="fa-solid fa-align-left navy-icon"></i> Uraian / Saran
                  </button>
                </div>
                <div>
                  <button type="button" class="btn btn-sm btn-light" style="border-radius: 10px; font-weight: 700; padding: 7px 14px; border: 1.5px solid #cbd5e1; color: var(--ide-navy); background: #ffffff;" onclick="applyDefaultIKMQuestionsPreset()">
                    <i class="fa-solid fa-wand-magic-sparkles navy-icon"></i> Muat 9 Unsur Standar IKM
                  </button>
                </div>
              </div>

              <div class="form-actions-footer">
                <div style="font-size: 12.5px; color: #64748b;">
                  <i class="fa-solid fa-circle-info navy-icon"></i> Seluruh instrumen kuesioner akan terhubung otomatis dengan lembar survei lapangan dan rekapitulasi data.
                </div>
                <button type="button" class="btn-submit-survey-data" onclick="saveNewSurveyData()">
                  <i class="fa-solid fa-floppy-disk" style="color: #ffffff !important;"></i> Simpan &amp; Publikasikan Survei
                </button>
              </div>

            </div>
          </div>

          <!-- Daftar Seluruh Survei & Akses Manajemen Staff / Admin -->
          <div class="rekap-card" style="margin-top: 25px;">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 16px;">
              <div>
                <h4 style="font-size: 17px; font-weight: 800; color: var(--ide-navy); margin: 0;">
                  <i class="fa-solid fa-folder-open navy-icon"></i> Katalog &amp; Manajemen Seluruh Survei
                </h4>
                <p style="font-size: 12.5px; color: #64748b; margin: 2px 0 0 0;">Petugas staf dan admin dapat mengelola, membagikan QR Code, maupun menghapus instrumen survei.</p>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-hover" style="font-size: 13px;">
                <thead class="thead-light">
                  <tr>
                    <th style="width: 40px;">No</th>
                    <th>Judul Survei</th>
                    <th>Instansi / Wilayah</th>
                    <th>Tipe &amp; Tahun</th>
                    <th>Responden</th>
                    <th style="text-align: center; width: 220px;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($surveiList)): ?>
                    <?php foreach ($surveiList as $idx => $sv): ?>
                    <tr>
                      <td><?=$idx + 1?></td>
                      <td><b><?=htmlspecialchars($sv['Judul'] ?? '')?></b></td>
                      <td><?=htmlspecialchars(!empty($sv['Lembaga']) ? $sv['Lembaga'] : '-')?><br><small class="text-muted"><i class="fa-solid fa-location-dot navy-icon"></i> <?=htmlspecialchars(!empty($sv['DaerahSurvei']) ? $sv['DaerahSurvei'] : 'Banyuwangi')?></small></td>
                      <td><span class="badge badge-info"><?=htmlspecialchars(!empty($sv['Jenis']) ? $sv['Jenis'] : 'IKM')?></span> <?=htmlspecialchars(!empty($sv['Tahun']) ? $sv['Tahun'] : date('Y'))?></td>
                      <td><span class="badge badge-success"><?=($sv['TotalResponden'] ?? 0)?> Responden</span></td>
                      <td style="text-align: center;">
                        <div style="display: flex; gap: 6px; justify-content: center;">
                          <button type="button" class="btn btn-sm btn-outline-dark" style="border-radius: 8px; font-weight: 700;" onclick="showSurveyQRCode(<?=$sv['Id']?>)" title="Lihat QR Code">
                            <i class="fa-solid fa-qrcode navy-icon"></i> QR
                          </button>
                          <button type="button" class="btn btn-sm btn-outline-primary" style="border-radius: 8px; font-weight: 700;" onclick="selectSurveyPill(<?=$sv['Id']?>)" title="Buka Survei Ini">
                            <i class="fa-solid fa-arrow-right navy-icon"></i> Buka
                          </button>
                          <?php if ($userLevel != 5): ?>
                          <button type="button" class="btn btn-sm btn-outline-danger" style="border-radius: 8px; font-weight: 700;" onclick="deleteSurveyTemplate(<?=$sv['Id']?>, '<?=addslashes(htmlspecialchars($sv['Judul']))?>')" title="Hapus Survei">
                            <i class="fa-solid fa-trash-can"></i>
                          </button>
                          <?php endif; ?>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr><td colspan="6" class="text-center text-muted">Belum ada survei tersedia.</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /page content -->

    </div>
  </div>

  <!-- Modal Rincian Jawaban Responden -->
  <div class="modal fade" id="modalRincianJawaban" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none;">
        <div class="modal-header" style="background: var(--ide-navy); color: #ffffff;">
          <h5 class="modal-title font-weight-bold"><i class="fa-solid fa-clipboard-user"></i> Rincian Jawaban Responden</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 24px;">
          <div id="rincianRespondenInfo" style="margin-bottom: 20px;"></div>
          <div id="rincianJawabanContainer"></div>
        </div>
        <div class="modal-footer" style="background: #f8fafc;">
          <button type="button" class="btn btn-secondary" style="border-radius: 10px; font-weight: 700;" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal QR Code Kuesioner Survei -->
  <div class="modal fade" id="modalSurveyQRCode" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 480px;">
      <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.25);">
        <div class="modal-header" style="background: var(--ide-navy); color: #ffffff; padding: 18px 24px;">
          <h5 class="modal-title font-weight-bold" style="font-size: 16px; display: flex; align-items: center; gap: 8px; margin: 0;">
            <i class="fa-solid fa-qrcode" style="color: var(--ide-red);"></i> QR Code Kuesioner Publik
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 24px; text-align: center;">
          <div style="background: #f1f5f9; border-radius: 12px; padding: 10px 14px; margin-bottom: 16px; text-align: left;">
            <div style="font-size: 11px; font-weight: 800; color: #0284c7; text-transform: uppercase;">Survei Terpilih</div>
            <div id="qrModalSurveyTitle" style="font-size: 15px; font-weight: 800; color: var(--ide-navy); line-height: 1.3; margin-top: 2px;">-</div>
            <div id="qrModalSurveyLembaga" style="font-size: 12px; color: #64748b; margin-top: 3px;">-</div>
          </div>

          <!-- Container Gambar QR Navy & White Clean Matching Reference -->
          <div style="background: #043168; border-radius: 24px; padding: 22px; display: inline-block; box-shadow: 0 12px 30px rgba(4, 49, 104, 0.25); margin-bottom: 14px; position: relative;">
            <div style="background: #ffffff; padding: 14px; border-radius: 18px; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
              <img id="qrCodeImageDisplay" src="" alt="QR Code Survei" style="width: 200px; height: 200px; display: block; border-radius: 10px;">
            </div>
            <div style="color: #ffffff; font-size: 11px; font-weight: 800; letter-spacing: 1.5px; margin-top: 12px; text-transform: uppercase;">
              SCAN THE QR CODE
            </div>
          </div>
          <div style="font-size: 12px; color: #64748b; line-height: 1.5; margin-bottom: 16px;">
            Pindai QR Code di atas menggunakan kamera smartphone untuk langsung membuka kuesioner survei secara mandiri.
          </div>

          <!-- Tautan Survei & Copy Button -->
          <div class="input-group" style="margin-bottom: 14px;">
            <input type="text" id="qrSurveyUrlInput" class="form-control" readonly style="font-size: 12px; background: #f8fafc; font-weight: 600; border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button" onclick="copySurveyLinkUrl()" style="background: var(--ide-navy); font-weight: 700; border-radius: 0 10px 10px 0; font-size: 12px; border-color: var(--ide-navy);">
                <i class="fa-regular fa-copy"></i> Salin Link
              </button>
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px;">
            <button type="button" class="btn btn-outline-dark" style="border-radius: 10px; font-weight: 700; font-size: 12.5px; padding: 9px;" onclick="downloadQrCodeImage()">
              <i class="fa-solid fa-download"></i> Unduh PNG
            </button>
            <button type="button" class="btn btn-outline-primary" style="border-radius: 10px; font-weight: 700; font-size: 12.5px; padding: 9px;" onclick="printSurveyPoster()">
              <i class="fa-solid fa-print"></i> Cetak Poster
            </button>
          </div>
        </div>
        <div class="modal-footer" style="background: #f8fafc; padding: 12px 24px; justify-content: space-between;">
          <a id="qrSurveyOpenLink" href="#" target="_blank" class="btn btn-sm btn-link" style="font-weight: 700; color: var(--ide-navy); padding: 0;">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Kuesioner
          </a>
          <button type="button" class="btn btn-secondary btn-sm" style="border-radius: 8px; font-weight: 700; padding: 6px 16px;" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="<?=base_url('vendors/jquery/dist/jquery.min.js')?>"></script>
  <script src="<?=base_url('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?=base_url('build/js/custom.min.js')?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?= base_url('assets/js/survei_rtkd_engine.js') ?>?v=<?= time() ?>"></script>

  <script>
    var BaseURL = '<?=base_url()?>';
    var userLevel = <?= (int)$userLevel ?>;
    var allSurveysData = <?= json_encode($surveiList) ?>;
    var currentSurveyId = allSurveysData.length > 0 ? allSurveysData[0].Id : 0;
    var currentSurveyObj = allSurveysData.length > 0 ? allSurveysData[0] : null;

    // Map Instances & State (100% Watermark-Free OpenStreetMap & Google Tiles)
    var dashMapInstance = null;
    var dashMiniMapInstance = null;
    var dashMiniMarkerInstance = null;
    var currentBaseTileLayer = null;
    var currentBaseLayerType = 'osm'; // 'osm' (OpenStreetMap), 'google' (Google Maps), 'satelit' (Google Satellite)
    var kecamatanGeoJsonLayer = null;
    var respondentMarkersLayer = null;
    var respondentPointsData = [];
    var markersList = [];
    var currentKecamatanGeoJson = null;

    // District Coordinates Banyuwangi
    var districtCoords = {
      'bangorejo': { lat: -8.514720, lng: 114.178910 },
      'banyuwangi': { lat: -8.219200, lng: 114.369200 },
      'blimbingsari': { lat: -8.315000, lng: 114.350000 },
      'cluring': { lat: -8.452310, lng: 114.248910 },
      'gambiran': { lat: -8.432540, lng: 114.148920 },
      'genteng': { lat: -8.362140, lng: 114.152340 },
      'giri': { lat: -8.189540, lng: 114.348910 },
      'glagah': { lat: -8.232140, lng: 114.318920 },
      'glenmore': { lat: -8.304720, lng: 114.048910 },
      'kabat': { lat: -8.284720, lng: 114.328910 },
      'kalibaru': { lat: -8.294720, lng: 113.988910 },
      'kalipuro': { lat: -8.124720, lng: 114.358910 },
      'licin': { lat: -8.214720, lng: 114.258910 },
      'muncar': { lat: -8.434720, lng: 114.338910 },
      'pesanggaran': { lat: -8.554720, lng: 114.088910 },
      'purwoharjo': { lat: -8.494720, lng: 114.288910 },
      'rogojampi': { lat: -8.314720, lng: 114.298910 },
      'sempu': { lat: -8.310000, lng: 114.165000 },
      'siliragung': { lat: -8.520000, lng: 114.110000 },
      'singojuruh': { lat: -8.324210, lng: 114.238920 },
      'songgon': { lat: -8.232540, lng: 114.218930 },
      'srono': { lat: -8.398640, lng: 114.262510 },
      'tegaldlimo': { lat: -8.560000, lng: 114.340000 },
      'tegalsari': { lat: -8.440000, lng: 114.135000 },
      'wongsorejo': { lat: -7.954720, lng: 114.408910 }
    };

    // Color Palette per Kecamatan
    var districtColors = [
      '#ef4444', '#f97316', '#f59e0b', '#84cc16', '#10b981', 
      '#06b6d4', '#0284c7', '#3b82f6', '#6366f1', '#8b5cf6', 
      '#d946ef', '#ec4899', '#f43f5e', '#14b8a6', '#0ea5e9'
    ];

    function getDistrictColor(idx) {
      return districtColors[idx % districtColors.length];
    }

    // =========================================================================
    // DYNAMIC SURVEY FILTER SWITCHER (PISAHKAN PER MASING-MASING SURVEI)
    // =========================================================================
    function onSurveyFilterChange(surveyId) {
      currentSurveyId = surveyId;
      $('.survey-pill-btn').removeClass('active');
      $('.survey-pill-btn[data-id="' + surveyId + '"]').addClass('active');
      $('#dashSurveySelect').val(surveyId);

      currentSurveyObj = allSurveysData.find(function(s) { return String(s.Id) === String(surveyId); });
      if (currentSurveyObj) {
        $('.active-context-survey-title').text(currentSurveyObj.Judul);
      }
      updateSurveyMetricStrip();
      loadSurveyQuestionsForForm(surveyId);
      loadDashboardRekapData(surveyId);
      loadMapSurveyData(surveyId);
    }

    function selectSurveyPill(surveyId) {
      onSurveyFilterChange(surveyId);
    }

    function updateSurveyMetricStrip() {
      if (!currentSurveyObj) return;

      $('#statLembaga').text(currentSurveyObj.Lembaga || '-');
      $('#statTotalResponden').text(currentSurveyObj.TotalResponden || 0);
      $('#statRataRataSkor').text(Number(currentSurveyObj.RataRataSkor || 0).toFixed(2));
      $('#statDaerah').text(currentSurveyObj.DaerahSurvei || 'Kabupaten Banyuwangi');

      // Update Form Banner
      var jenisLabel = currentSurveyObj.Jenis || 'Survei';
      if (currentSurveyObj.Id == 4 || (currentSurveyObj.Judul && currentSurveyObj.Judul.toLowerCase().indexOf('rtkd') !== -1)) {
        jenisLabel = 'Survei Ketenagakerjaan (RTKD)';
      }
      $('#formBadgeJenis').text(jenisLabel);
      $('#formEstimasiWaktu').html('<i class="fa-regular fa-clock"></i> Estimasi: ' + (currentSurveyObj.EstimasiWaktu || '3 - 5 Menit'));
      $('#formSurveyTitle').text(currentSurveyObj.Judul || 'Formulir Survei');
      $('#formSurveyDesc').text(currentSurveyObj.Deskripsi || 'Silakan lengkapi seluruh isian kuesioner dengan objektif.');
      $('#dashFormSurveyId').val(currentSurveyObj.Id);

      if (currentSurveyObj.BannerColor) {
        $('#formBannerHeader').css('background', 'linear-gradient(135deg, ' + currentSurveyObj.BannerColor + ', #021e42)');
      }

      if (currentSurveyObj.Id == 4 || (currentSurveyObj.Judul && currentSurveyObj.Judul.toLowerCase().indexOf('rtkd') !== -1) || currentSurveyObj.Jenis !== 'IKM') {
        $('#donutMutuSubtitle').text('Distribusi Kategori Mutu Responden Survei Ketenagakerjaan');
      } else {
        $('#donutMutuSubtitle').text('Distribusi Kategori Mutu Skor IKM Responden');
      }

      $('#gisSurveyTitleText').text('Peta Sebaran: ' + currentSurveyObj.Judul);
    }

    // =========================================================================
    // TAB SWITCHER
    // =========================================================================
    function switchDashTab(tabName) {
      $('.dash-tab-btn').removeClass('active');
      $('.dash-tab-content').removeClass('active');

      if (tabName === 'katalog') {
        $('#tabBtnKatalog').addClass('active');
        $('#tabContentKatalog').addClass('active');
      } else if (tabName === 'peta') {
        $('#tabBtnPeta').addClass('active');
        $('#tabContentPeta').addClass('active');
        setTimeout(function() {
          if (dashMapInstance) {
            dashMapInstance.invalidateSize();
            dashMapInstance.setView([-8.32, 114.25], 10);
          } else {
            initDashMap();
          }
        }, 200);
      } else if (tabName === 'rekap') {
        $('#tabBtnRekap').addClass('active');
        $('#tabContentRekap').addClass('active');
        if (currentRekapData) {
          setTimeout(function() {
            renderRekapCharts(currentRekapData);
          }, 40);
        }
        loadDashboardRekapData(currentSurveyId);
      } else if (tabName === 'studio') {
        $('#tabBtnStudio').addClass('active');
        $('#tabContentStudio').addClass('active');
      } else if (tabName === 'isian') {
        $('#tabBtnIsian').addClass('active');
        $('#tabContentIsian').addClass('active');
        setTimeout(function() {
          if (dashMiniMapInstance) {
            dashMiniMapInstance.invalidateSize();
          } else {
            initDashMiniMap();
          }
        }, 200);
      } else {
        $('#tabBtnKatalog').addClass('active');
        $('#tabContentKatalog').addClass('active');
      }
    }

    // =========================================================================
    // NAVIGASI DARI CARD RUMAH SURVEI KE SUB-TAB TERKAIT
    // =========================================================================
    function selectSurveyAndGo(surveyId, tabName, isEdit) {
      onSurveyFilterChange(surveyId);

      if (isEdit) {
        openEditSurveyBuilder(surveyId);
      } else {
        switchDashTab(tabName);
      }
    }

    // =========================================================================
    // FILTER INTERAKTIF KATALOG RUMAH SURVEI (SEARCH, JENIS, STATUS)
    // =========================================================================
    function filterKatalogCards() {
      var q = $.trim($('#katalogSearchInput').val()).toLowerCase();
      var jenis = $('#katalogFilterJenis').val();
      var status = $('#katalogFilterStatus').val();

      var visibleCount = 0;
      $('.katalog-survey-card-item').each(function() {
        var $card = $(this);
        var title = ($card.data('title') || '').toString();
        var lembaga = ($card.data('lembaga') || '').toString();
        var daerah = ($card.data('daerah') || '').toString();
        var cardJenis = ($card.data('jenis') || '').toString();
        var cardStatus = ($card.data('status') || '').toString();

        var matchQ = !q || title.indexOf(q) !== -1 || lembaga.indexOf(q) !== -1 || daerah.indexOf(q) !== -1;
        var matchJenis = !jenis || cardJenis === jenis;
        var matchStatus = !status || cardStatus === status;

        if (matchQ && matchJenis && matchStatus) {
          $card.show();
          visibleCount++;
        } else {
          $card.hide();
        }
      });

      if (visibleCount === 0) {
        $('#katalogEmptyState').show();
      } else {
        $('#katalogEmptyState').hide();
      }
    }

    // =========================================================================
    // EDIT SURVEI DI STUDIO BUILDER
    // =========================================================================
    function openEditSurveyBuilder(surveyId) {
      if (userLevel === 5) {
        Swal.fire('Akses Ditolak', 'User role survei hanya memiliki akses untuk mengisi survei.', 'warning');
        return;
      }
      Swal.fire({
        title: 'Memuat Studio Survei...',
        allowOutsideClick: false,
        didOpen: function() { Swal.showLoading(); }
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
            $('#builderJudul').val(s.Judul);
            $('#builderDeskripsi').val(s.Deskripsi || '');
            $('#builderLembaga').val(s.Lembaga || '');
            $('#builderJenis').val(s.Jenis || 'IKM');
            $('#builderTahun').val(s.Tahun || new Date().getFullYear());
            $('#builderDaerah').val(s.DaerahSurvei || '');
            $('#builderStudioTitle').html('<i class="fa-solid fa-pen-ruler navy-icon"></i> Mengedit Rumah Survei: #' + s.Id + ' - ' + s.Judul);

            dashBuilderQuestions = [];
            if (res.pertanyaan && res.pertanyaan.length > 0) {
              res.pertanyaan.forEach(function(p) {
                dashBuilderQuestions.push({
                  Pertanyaan: p.Pertanyaan,
                  Deskripsi: p.Deskripsi || '',
                  Tipe: p.Tipe || 'radio',
                  IsRequired: parseInt(p.IsRequired) === 1 ? 1 : 0,
                  ScaleMin: parseInt(p.ScaleMin) || 1,
                  ScaleMax: parseInt(p.ScaleMax) || 5,
                  ScaleMinLabel: p.ScaleMinLabel || 'Sangat Tidak Baik',
                  ScaleMaxLabel: p.ScaleMaxLabel || 'Sangat Baik',
                  OpsiPilihan: p.OpsiPilihanList || []
                });
              });
            }
            renderDashBuilderQuestions();
            switchDashTab('studio');
          } else {
            Swal.fire('Error', res.message || 'Gagal memuat detail survei.', 'error');
          }
        },
        error: function() {
          Swal.close();
          Swal.fire('Error', 'Gagal terhubung ke server studio survei.', 'error');
        }
      });
    }

    // =========================================================================
    // INISIALISASI BUAT SURVEI BARU DARI NOL
    // =========================================================================
    function initNewSurveyBuilder() {
      $('#builderSurveyId').val('');
      $('#builderJudul').val('');
      $('#builderDeskripsi').val('');
      $('#builderLembaga').val('IDE Consultant');
      $('#builderJenis').val('IKM');
      $('#builderTahun').val(new Date().getFullYear());
      $('#builderDaerah').val('Kabupaten Banyuwangi');
      $('#builderStudioTitle').html('<i class="fa-solid fa-pen-ruler navy-icon"></i> Studio Pembuat Survei Dinamis Baru');

      applyDefaultIKMQuestionsPreset();
      switchDashTab('studio');
    }

    // =========================================================================
    // LOAD QUESTIONS FOR FORM (ISIAN PER SURVEI TERPILIH)
    // =========================================================================
    function loadSurveyQuestionsForForm(surveyId) {
      $('#dashQuestionsContainer').html('<div style="text-align: center; padding: 40px; color: #64748b;"><i class="fa-solid fa-spinner fa-spin" style="font-size: 28px; margin-bottom: 12px; color: var(--ide-navy);"></i><div>Memuat butir pertanyaan survei...</div></div>');

      // Deteksi Survei Multi-Instrumen Dinamis (RTKD / TipeSurvei multi / ID 4)
      var isMulti = (surveyId == 4) || (currentSurveyObj && ((currentSurveyObj.TipeSurvei === 'multi') || (currentSurveyObj.InstrumenList && currentSurveyObj.InstrumenList.indexOf(',') !== -1) || (currentSurveyObj.Judul && currentSurveyObj.Judul.toLowerCase().indexOf('rtkd') !== -1)));
      window.isDashRtkd = isMulti;

      if (isMulti) {
        var rtkdHtml = 
          '<nav class="rtkd-tabs" role="tablist" aria-label="Instrumen survei">' +
            '<button type="button" class="rtkd-tab-btn active" id="dashRtkdTab-A" data-tab="A" aria-selected="true" onclick="switchDashRtkdTab(\'A\')">' +
              '<span class="rtkd-tag">A</span>Perusahaan / Pemberi Kerja' +
            '</button>' +
            '<button type="button" class="rtkd-tab-btn" id="dashRtkdTab-B" data-tab="B" aria-selected="false" onclick="switchDashRtkdTab(\'B\')">' +
              '<span class="rtkd-tag">B</span>Pencari Kerja &amp; Lulusan' +
            '</button>' +
            '<button type="button" class="rtkd-tab-btn" id="dashRtkdTab-C" data-tab="C" aria-selected="false" onclick="switchDashRtkdTab(\'C\')">' +
              '<span class="rtkd-tag">C</span>Pemangku Kepentingan' +
            '</button>' +
            '<button type="button" class="rtkd-tab-btn" id="dashRtkdTab-E" data-tab="E" aria-selected="false" onclick="switchDashRtkdTab(\'E\')">' +
              '<span class="rtkd-tag">C2</span>AHP' +
            '</button>' +
            '<button type="button" class="rtkd-tab-btn" id="dashRtkdTab-D" data-tab="D" aria-selected="false" onclick="switchDashRtkdTab(\'D\')">' +
              '<span class="rtkd-tag">D</span>Siswa Kelas 12' +
            '</button>' +
          '</nav>' +
          '<input type="hidden" id="dashRtkdActiveInstrument" name="RtkdInstrument" value="A">' +
          '<label class="rtkd-consent" for="dashRespConsent" style="margin-bottom: 16px;">' +
            '<input type="checkbox" id="dashRespConsent" checked>' +
            '<span id="dashConsentText">Responden sudah menerima penjelasan tujuan survei, menyetujui pengisian, dan mengetahui bahwa jawaban hanya disajikan secara agregat.</span>' +
          '</label>' +
          '<div id="dashAhpDemoBar" style="display:none; margin-bottom:12px; text-align:right;">' +
            '<button type="button" class="btn btn-xs btn-outline-info" style="font-size:12px; padding:4px 10px; border-radius:8px;" onclick="if(window.RTKDEngine){window.RTKDEngine.fillSampleAHP(\'dashRespondentForm\', true); Swal.fire(\'Isi AHP Otomatis\', \'75 pasangan perbandingan AHP telah terisi dengan konsisten (CR &le; 0.05). Silakan tinjau dan simpan isian.\', \'info\');}">' +
              '<i class="fa-solid fa-wand-magic-sparkles"></i> Contoh AHP Konsisten' +
            '</button>' +
          '</div>' +
          '<div class="rtkd-sheet" id="dashRtkdSheet"></div>';

        $('#dashQuestionsContainer').html(rtkdHtml);
        switchDashRtkdTab(window.dashRtkdActiveInstrument || 'A');

        // Sinkronkan skema butir pertanyaan dinamis langsung dari database
        $.ajax({
          url: BaseURL + 'IDE/get_survei_pertanyaan/' + surveyId,
          type: 'GET',
          dataType: 'json',
          success: function(resQ) {
            var qList = (resQ && resQ.pertanyaan) ? resQ.pertanyaan : ((resQ && resQ.data) ? resQ.data : []);
            if (surveyId != 4 && window.RTKDEngine && typeof window.RTKDEngine.loadSchemaFromDb === 'function' && Array.isArray(qList) && qList.length > 0) {
              var hasInstruments = qList.some(function(q) { return q.Instrumen && q.Instrumen !== 'Semua'; });
              if (hasInstruments) {
                window.RTKDEngine.loadSchemaFromDb(qList);
              }
            }
            switchDashRtkdTab(window.dashRtkdActiveInstrument || 'A');
          }
        });
        return;
      }

      $.ajax({
        url: BaseURL + 'IDE/get_survei_pertanyaan/' + surveyId,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
          var questions = (res && res.data) ? res.data : (res && res.pertanyaan ? res.pertanyaan : []);
          if (res && res.status && Array.isArray(questions) && questions.length > 0) {
            var html = '';
            var lastSection = null;
            questions.forEach(function(q, idx) {
              var isReq = (q.IsRequired == 1 || q.IsRequired === '1');
              var reqMark = isReq ? ' <span style="color: var(--ide-red);">*</span>' : '';
              var reqAttr = isReq ? ' required' : '';

              // Render Section Card Header jika berganti bagian (Section)
              if (q.Section && q.Section !== lastSection) {
                lastSection = q.Section;
                var secBadge = q.Section.indexOf('.') !== -1 ? q.Section.split('.')[0] : 'BAGIAN';
                html += '<div class="survey-section-card" style="background: linear-gradient(135deg, #043168 0%, #0d3d7c 100%); color: #ffffff; border-radius: 12px; padding: 16px 20px; margin: 24px 0 14px 0; box-shadow: 0 4px 12px rgba(4,49,104,0.15); display: flex; align-items: center; justify-content: space-between;">';
                html += '  <div>';
                html += '    <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: rgba(255,255,255,0.7); font-weight: 700; margin-bottom: 2px;"><i class="fa-solid fa-layer-group"></i> Bagian Instrumen</div>';
                html += '    <h4 style="margin: 0; font-size: 16.5px; font-weight: 800; color: #ffffff;">' + q.Section + '</h4>';
                html += '  </div>';
                html += '  <span style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.25); color: #fff; font-size: 11.5px; font-weight: 700; padding: 4px 10px; border-radius: 20px;">' + secBadge + '</span>';
                html += '</div>';
              }

              html += '<div class="question-box" id="dashQBox_' + q.Id + '">';
              html += '  <div class="q-number-pill">Butir #' + (idx + 1) + '</div>';
              html += '  <div class="q-text">' + q.Pertanyaan + reqMark + '</div>';
              if (q.Deskripsi) {
                html += '  <div style="font-size: 12.5px; color: #64748b; margin-top: -8px; margin-bottom: 14px;">' + q.Deskripsi + '</div>';
              }

              // Parse Opsi Pilihan jika ada
              var opsiList = q.OpsiPilihanList || [];
              if ((!opsiList || opsiList.length === 0) && q.OpsiPilihan) {
                try {
                  opsiList = typeof q.OpsiPilihan === 'string' ? JSON.parse(q.OpsiPilihan) : q.OpsiPilihan;
                } catch(e) {
                  opsiList = [];
                }
              }

              if (q.Tipe === 'radio') {
                html += '  <div style="display: flex; flex-direction: column; gap: 8px;">';
                if (Array.isArray(opsiList) && opsiList.length > 0) {
                  opsiList.forEach(function(opt) {
                    var optVal = typeof opt === 'object' ? (opt.label || opt.nilai) : opt;
                    var optLbl = typeof opt === 'object' ? (opt.label || opt.nilai) : opt;
                    html += '    <label class="form-check-label" style="display: flex; align-items: center; gap: 10px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; cursor: pointer; margin: 0; font-size: 13.5px; font-weight: 500;">';
                    html += '      <input type="radio" name="jawaban_' + q.Id + '" value="' + optVal + '"' + reqAttr + ' style="margin: 0; width: 17px; height: 17px;">';
                    html += '      <span>' + optLbl + '</span>';
                    html += '    </label>';
                  });
                } else {
                  var defaultOpts = ['Sangat Baik', 'Baik', 'Cukup', 'Kurang Baik'];
                  defaultOpts.forEach(function(optLbl) {
                    html += '    <label class="form-check-label" style="display: flex; align-items: center; gap: 10px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; cursor: pointer; margin: 0; font-size: 13.5px;">';
                    html += '      <input type="radio" name="jawaban_' + q.Id + '" value="' + optLbl + '"' + reqAttr + ' style="margin: 0; width: 17px; height: 17px;">';
                    html += '      <span>' + optLbl + '</span>';
                    html += '    </label>';
                  });
                }
                html += '  </div>';

              } else if (q.Tipe === 'checkbox') {
                html += '  <div style="display: flex; flex-direction: column; gap: 8px;">';
                if (Array.isArray(opsiList) && opsiList.length > 0) {
                  opsiList.forEach(function(opt) {
                    var optVal = typeof opt === 'object' ? (opt.label || opt.nilai) : opt;
                    var optLbl = typeof opt === 'object' ? (opt.label || opt.nilai) : opt;
                    html += '    <label class="form-check-label" style="display: flex; align-items: center; gap: 10px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; cursor: pointer; margin: 0; font-size: 13.5px; font-weight: 500;">';
                    html += '      <input type="checkbox" name="jawaban_' + q.Id + '[]" value="' + optVal + '" style="margin: 0; width: 17px; height: 17px;">';
                    html += '      <span>' + optLbl + '</span>';
                    html += '    </label>';
                  });
                }
                html += '  </div>';

              } else if (q.Tipe === 'dropdown') {
                html += '  <select class="form-input-custom" name="jawaban_' + q.Id + '"' + reqAttr + '>';
                html += '    <option value="">-- Pilih Salah Satu Jawaban --</option>';
                if (Array.isArray(opsiList) && opsiList.length > 0) {
                  opsiList.forEach(function(opt) {
                    var optVal = typeof opt === 'object' ? (opt.label || opt.nilai) : opt;
                    var optLbl = typeof opt === 'object' ? (opt.label || opt.nilai) : opt;
                    html += '    <option value="' + optVal + '">' + optLbl + '</option>';
                  });
                }
                html += '  </select>';

              } else if (q.Tipe === 'scale' || q.Tipe === 'likert') {
                var minVal = parseInt(q.ScaleMin) || 1;
                var maxVal = parseInt(q.ScaleMax) || 5;
                var colCount = maxVal - minVal + 1;
                html += '  <div class="likert-rating-row" style="--likert-cols: ' + colCount + ';">';
                var scaleLabels = {
                  1: 'Sangat Tidak Setuju / Buruk',
                  2: 'Tidak Setuju / Kurang',
                  3: 'Ragu-Ragu / Cukup',
                  4: 'Setuju / Baik',
                  5: 'Sangat Setuju / Sangat Baik'
                };
                for (var v = minVal; v <= maxVal; v++) {
                  var lblText = scaleLabels[v] || ('Nilai ' + v);
                  html += '    <label class="likert-radio-label">';
                  html += '      <input type="radio" name="jawaban_' + q.Id + '" value="' + v + '"' + reqAttr + ' onchange="onLikertOptionSelected(this)">';
                  html += '      <span class="likert-score">' + v + '</span>';
                  html += '      <span class="likert-text">' + lblText + '</span>';
                  html += '    </label>';
                }
                html += '  </div>';

              } else if (q.Tipe === 'textarea') {
                html += '  <textarea class="form-textarea-custom" name="jawaban_' + q.Id + '" placeholder="Ketik jawaban, saran, atau masukan Anda di sini..."' + reqAttr + '></textarea>';
              } else if (q.Tipe === 'number') {
                html += '  <input type="number" class="form-input-custom" name="jawaban_' + q.Id + '" placeholder="Ketik angka..."' + reqAttr + '>';
              } else {
                html += '  <input type="text" class="form-input-custom" name="jawaban_' + q.Id + '" placeholder="Ketik jawaban Anda..."' + reqAttr + '>';
              }

              html += '</div>';
            });
            $('#dashQuestionsContainer').html(html);
          } else {
            $('#dashQuestionsContainer').html('<div style="text-align: center; padding: 40px; color: #94a3b8;"><i class="fa-solid fa-clipboard-question" style="font-size: 36px; margin-bottom: 12px; display: block;"></i>Belum ada butir pertanyaan untuk survei ini.<br><button type="button" class="btn btn-sm btn-primary mt-2" onclick="switchDashTab(\'studio\')">Tambah Butir di Studio</button></div>');
          }
        },
        error: function(xhr, status, err) {
          console.error('AJAX Error get_survei_pertanyaan:', status, err);
          $('#dashQuestionsContainer').html('<div class="alert alert-danger" style="border-radius: 12px; font-size: 13.5px;"><i class="fa-solid fa-triangle-exclamation"></i> Gagal mengambil butir pertanyaan. Periksa koneksi server.</div>');
        }
      });
    }

    function onLikertOptionSelected(radio) {
      var $radio = $(radio);
      var $box = $radio.closest('.question-box');
      $box.addClass('is-answered');
      $box.find('.likert-radio-label').removeClass('selected');
      $radio.closest('.likert-radio-label').addClass('selected');
    }

    $(document).on('change', '#dashQuestionsContainer input, #dashQuestionsContainer textarea', function() {
      var val = $(this).val();
      var $box = $(this).closest('.question-box');
      if (val && String(val).trim().length > 0) {
        $box.addClass('is-answered');
      }
    });

    // =========================================================================
    // RTKD DYNAMIC MULTI-INSTRUMENT HELPERS (DASHBOARD)
    // =========================================================================
    window.dashRtkdActiveInstrument = 'A';
    window.switchDashRtkdTab = function(tabKey) {
      window.dashRtkdActiveInstrument = tabKey;
      window.dashAhpAckCr = false;
      if (tabKey === 'E') {
        $('#dashAhpDemoBar').show();
      } else {
        $('#dashAhpDemoBar').hide();
      }
      $('#dashRtkdActiveInstrument').val(tabKey);
      $('.rtkd-tabs .rtkd-tab-btn').removeClass('active').attr('aria-selected', 'false');
      $('#dashRtkdTab-' + tabKey).addClass('active').attr('aria-selected', 'true');
      
      var renderQuestions = function() {
        if (window.RTKDEngine) {
          window.RTKDEngine.render('dashRtkdSheet', tabKey, 'dash_');
        } else {
          $('#dashRtkdSheet').html('<div style="text-align:center; padding: 25px; color: #64748b;"><i class="fa-solid fa-spinner fa-spin"></i> Menyiapkan butir kuesioner...</div>');
          setTimeout(function() {
            if (window.RTKDEngine) {
              window.RTKDEngine.render('dashRtkdSheet', tabKey, 'dash_');
            }
          }, 200);
        }
      };
      renderQuestions();

      // Pulihkan draft jika ada yang tersimpan di memori perangkat untuk instrumen ini
      if (window.SurveiOfflineManager) {
        window.SurveiOfflineManager.restoreDraft(parseInt($('#dashFormSurveyId').val()) || 4, tabKey, true);
      }

      // Sync dengan pilihan kategori responden
      if (tabKey === 'A') {
        $('#dashRespPekerjaan').val('Pemberi Kerja / Pelaku Usaha (Perusahaan)');
      } else if (tabKey === 'B') {
        $('#dashRespPekerjaan').val('Pencari Kerja / Fresh Graduate');
      } else if (tabKey === 'C') {
        $('#dashRespPekerjaan').val('Pemangku Kepentingan / Stakeholder');
      } else if (tabKey === 'D') {
        $('#dashRespPekerjaan').val('Siswa Kelas 12 (SMK / SMA / MA)');
      }
    };

    // Sinkronisasi bolak-balik: ganti kategori responden -> ganti instrumen aktif
    $(document).on('change', '#dashRespPekerjaan', function() {
      if (window.isDashRtkd) {
        var val = $(this).val();
        if (val.indexOf('Instrumen A') !== -1 || val.indexOf('Pemberi Kerja') !== -1) {
          switchDashRtkdTab('A');
        } else if (val.indexOf('Instrumen B') !== -1 || val.indexOf('Pencari Kerja') !== -1) {
          switchDashRtkdTab('B');
        } else if (val.indexOf('Instrumen C') !== -1 || val.indexOf('Pemangku Kepentingan') !== -1) {
          switchDashRtkdTab('C');
        } else if (val.indexOf('Instrumen D') !== -1 || val.indexOf('Siswa') !== -1) {
          switchDashRtkdTab('D');
        }
      }
    });

    window.saveDashSurveyOfflineDirect = function() {
      window.dashForceOffline = true;
      var form = document.getElementById('dashRespondentForm');
      if (form) {
        if (typeof form.requestSubmit === 'function') {
          form.requestSubmit();
        } else {
          $('#dashRespondentForm').trigger('submit');
        }
      }
    };

    // Real-time conditional show/hide dan CR check untuk RTKD Dashboard
    $(document).on('input change', '#dashRtkdSheet input, #dashRtkdSheet select, #dashRtkdSheet textarea', function() {
      if (window.isDashRtkd && window.RTKDEngine) {
        var activeInst = window.dashRtkdActiveInstrument || 'A';
        window.RTKDEngine.applyShow('dashRtkdSheet', activeInst, 'dash_');
        if (activeInst === 'E') {
          window.RTKDEngine.updateCR('dashRtkdSheet', 'E', 'dash_');
        }
      }
    });

    // Submit Respondent Form from Dashboard
    function submitDashRespondentForm(e) {
      e.preventDefault();

      // =======================================================================
      // CABANG KHUSUS: SUBMIT SURVEI RTKD DARI DASHBOARD
      // =======================================================================
      if (window.isDashRtkd) {
        if (!$('#dashRespConsent').is(':checked')) {
          Swal.fire('Persetujuan Responden', 'Harap centang persetujuan responden terlebih dahulu.', 'warning');
          $('#dashRespConsent').focus();
          return;
        }

        var inst = window.dashRtkdActiveInstrument || $('#dashRtkdActiveInstrument').val() || 'A';
        var answers = window.RTKDEngine ? window.RTKDEngine.collect('dashRespondentForm', inst, 'dash_') : {};

        // Validasi kriteria penyaring Instrumen B
        if (inst === 'B' && Array.isArray(answers.SC)) {
          if (answers.SC.indexOf('Tidak satu pun') !== -1 && answers.SC.length > 1) {
            Swal.fire('Kriteria Penyaring (SC)', 'Pada butir SC, "Tidak satu pun" tidak bisa dipilih bersama kriteria lain. Silakan perbaiki jawaban Anda.', 'warning');
            return;
          }
        }

        // Validasi pertanyaan wajib dan beri highlight visual pada butir yang kosong
        if (window.RTKDEngine && !window.dashBypassValidationForOffline) {
          var valRes = window.RTKDEngine.validateAndHighlight('dashRtkdSheet', inst, 'dash_', answers);
          if (!valRes.isValid) {
            if (window.dashForceOffline || !navigator.onLine) {
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
                  window.dashBypassValidationForOffline = true;
                  $('#dashRespondentForm').trigger('submit');
                } else {
                  window.RTKDEngine.scrollToFirstUnanswered(valRes.firstElement);
                }
              });
              return;
            }

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
              window.RTKDEngine.scrollToFirstUnanswered(valRes.firstElement);
            });
            return;
          }
        }
        window.dashBypassValidationForOffline = false;

        // Update skor prioritas AHP untuk Instrumen E
        if (inst === 'E' && window.RTKDEngine) {
          window.RTKDEngine.updateCR('dashRtkdSheet', 'E', 'dash_');
        }

        var respNama = (inst === 'E' ? (answers.S2 || answers.S1 || $('#dashRespNama').val() || 'Narasumber AHP') : ($('#dashRespNama').val() || answers.P1 || answers.S2 || answers.K2 || (inst === 'B' ? 'Pencari Kerja / Lulusan' : 'Responden ' + inst)));
        var kec = answers.P2 || answers.L3 || answers.K3 || answers.K7 || $('#dashKecamatan').val() || 'Banyuwangi';

        var payload = {
          SurveiId: parseInt($('#dashFormSurveyId').val()) || 4,
          Instrumen: inst,
          Enumerator: 'Petugas Surveyor',
          RespondenNama: respNama,
          RespondenNIK: $('#dashRespNIK').val() || '',
          RespondenKontak: $('#dashRespKontak').val() || '',
          RespondenGender: $('#dashRespGender').val() || answers.L2 || answers.K6 || 'Lainnya',
          RespondenUsia: answers.L1 || answers.K5 || $('#dashRespUsia').val() || '',
          RespondenPendidikan: answers.L4 || (inst === 'D' ? 'Kelas 12' : $('#dashRespPendidikan').val()),
          RespondenPekerjaan: $('#dashRespPekerjaan').val(),
          Provinsi: $('#dashProvinsi').val() || 'Jawa Timur',
          Kabupaten: $('#dashKabupaten').val() || 'Kabupaten Banyuwangi',
          Kecamatan: kec,
          Desa: $('#dashDesa').val() || '',
          AlamatDetail: $('#dashAlamat').val() || ('Lokasi: ' + (answers.SR2 || kec)),
          Latitude: $('#dashLatitude').val() || null,
          Longitude: $('#dashLongitude').val() || null,
          CreatedAt: new Date().toISOString(),
          waktu_pengisian: new Date().toISOString(),
          Jawaban: answers
        };

        var $btn = $('#btnSubmitSurvey');
        var origText = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan Isian...');

        // Jika offline atau simpan offline manual aktif
        if (!navigator.onLine || window.dashForceOffline) {
          window.dashForceOffline = false;
          $btn.prop('disabled', false).html(origText);
          if (window.SurveiOfflineManager) {
            window.SurveiOfflineManager.enqueueOffline(payload, inst, 'dashRespondentForm');
          } else {
            Swal.fire('Offline', 'Data tersimpan lokal. Silakan coba kembali saat terhubung.', 'info');
          }
          return;
        }

        $.ajax({
          url: BaseURL + 'IDE/submit_survei_responden',
          type: 'POST',
          data: JSON.stringify(payload),
          contentType: 'application/json; charset=utf-8',
          dataType: 'json',
          timeout: 15000,
          success: function(res) {
            $btn.prop('disabled', false).html(origText);
            if (res && res.status) {
              Swal.fire({
                icon: 'success',
                title: 'Isian Survei Berhasil Disimpan!',
                html: 'Data responden atas nama <b>' + respNama + '</b> (Instrumen ' + inst + ') berhasil disimpan ke dalam sistem database dan titik koordinat telah terpetakan di Google Maps.',
                confirmButtonColor: '#043168'
              });

              // Re-render fresh sheet
              window.RTKDEngine.render('dashRtkdSheet', inst, 'dash_');

              // Update stats & maps
              loadDashboardRekapData(currentSurveyId);
              loadGoogleMapSurveyData(currentSurveyId);
            } else {
              Swal.fire('Gagal Menyimpan', (res ? res.message : 'Terjadi kesalahan pada server.'), 'error');
            }
          },
          error: function(xhr, status, error) {
            $btn.prop('disabled', false).html(origText);
            if (!navigator.onLine || status === 'timeout' || xhr.status === 0 || status === 'error') {
              if (window.SurveiOfflineManager) {
                window.SurveiOfflineManager.enqueueOffline(payload, inst, 'dashRespondentForm');
                return;
              }
            }
            Swal.fire('Error', 'Gagal menghubungi server.', 'error');
          }
        });
        return;
      }

      var $btn = $('#btnSubmitSurvey');
      var origText = $btn.html();
      $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan Isian...');

      var formData = $('#dashRespondentForm').serialize();

      $.ajax({
        url: BaseURL + 'IDE/submit_survei_responden',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(res) {
          $btn.prop('disabled', false).html(origText);
          if (res && res.status) {
            Swal.fire({
              icon: 'success',
              title: 'Isian Survei Berhasil Disimpan!',
              html: 'Data responden atas nama <b>' + ($('#dashRespNama').val() || '') + '</b> berhasil tercatat ke dalam sistem database dan titik koordinat telah terpetakan di Google Maps.',
              confirmButtonColor: '#043168'
            });

            // Reset form
            $('#dashRespNama, #dashRespNIK, #dashRespKontak, #dashRespPekerjaan, #dashAlamat').val('');
            $('input[type="radio"]').prop('checked', false);

            // Update stats & maps
            loadDashboardRekapData(currentSurveyId);
            loadGoogleMapSurveyData(currentSurveyId);
          } else {
            Swal.fire('Gagal Menyimpan', (res ? res.message : 'Terjadi kesalahan pada server.'), 'error');
          }
        },
        error: function() {
          $btn.prop('disabled', false).html(origText);
          Swal.fire('Error', 'Gagal menghubungi server.', 'error');
        }
      });
    }

    // =========================================================================
    // MAP INTEGRATION ENGINE (WATERMARK-FREE OPENSTREETMAP & GOOGLE TILES)
    // =========================================================================

    // Factory fungsi pembuat tile layer (100% Bebas Watermark)
    function createTileLayer(type) {
      if (type === 'google') {
        // Direct Google Roadmap tiles - 100% Watermark-Free & responsif
        return L.tileLayer('https://mt{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
          maxZoom: 20,
          subdomains: ['0', '1', '2', '3'],
          attribution: '&copy; Google Maps &bull; IDE Consultant GIS'
        });
      } else if (type === 'satelit') {
        // Direct Google Satellite + Hybrid tiles - 100% Watermark-Free
        return L.tileLayer('https://mt{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
          maxZoom: 20,
          subdomains: ['0', '1', '2', '3'],
          attribution: '&copy; Google Satellite &bull; IDE Consultant GIS'
        });
      } else {
        // Standard OpenStreetMap - 100% Watermark-Free & Open
        return L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> contributors &bull; IDE Consultant GIS'
        });
      }
    }

    // Switch Base Map Layer (OpenStreetMap / Google Maps / Satelit)
    function switchMapBaseLayer(layerType) {
      currentBaseLayerType = layerType;
      $('.btn-map-layer-switch').removeClass('active');
      if (layerType === 'google') $('#btnLayerGoogle').addClass('active');
      else if (layerType === 'satelit') $('#btnLayerSatelit').addClass('active');
      else $('#btnLayerOSM').addClass('active');

      if (dashMapInstance) {
        if (currentBaseTileLayer) {
          dashMapInstance.removeLayer(currentBaseTileLayer);
        }
        currentBaseTileLayer = createTileLayer(layerType);
        currentBaseTileLayer.addTo(dashMapInstance);
        if (kecamatanGeoJsonLayer) {
          kecamatanGeoJsonLayer.bringToBack();
        }
      }
    }

    // Inisialisasi Peta Utama Spasial
    function initDashMap() {
      var mapElem = document.getElementById('dashGoogleSurveiMap');
      if (!mapElem) return;

      if (dashMapInstance) {
        dashMapInstance.invalidateSize();
        return;
      }

      var centerBanyuwangi = [-8.32, 114.25];

      dashMapInstance = L.map('dashGoogleSurveiMap', {
        center: centerBanyuwangi,
        zoom: 10,
        scrollWheelZoom: true,
        zoomControl: true
      });

      // Default Base Tile Layer
      currentBaseTileLayer = createTileLayer(currentBaseLayerType);
      currentBaseTileLayer.addTo(dashMapInstance);

      // Layer group untuk pin marker responden
      respondentMarkersLayer = L.layerGroup().addTo(dashMapInstance);

      // Muat Poligon Batas Riil 25 Kecamatan Banyuwangi
      loadBanyuwangiPolygonsToMap();

      // Muat Sebaran Titik Responden untuk Survei Terpilih
      loadMapSurveyData(currentSurveyId);
    }

    // Memuat Batas Riil 25 Kecamatan Banyuwangi dari GeoJSON
    function loadBanyuwangiPolygonsToMap() {
      if (!dashMapInstance) return;

      $.getJSON(BaseURL + 'assets/geojson/banyuwangi_kecamatan_real_smooth.geojson', function(geoJsonData) {
        currentKecamatanGeoJson = geoJsonData;

        var kecDropdown = $('#gisKecamatanFilter');
        kecDropdown.empty().append('<option value="">Semua Wilayah Kecamatan (25)</option>');

        var kecNames = [];
        if (geoJsonData.features) {
          geoJsonData.features.forEach(function(feat, idx) {
            var name = feat.properties.kecamatan || feat.properties.district || feat.properties.nama || ('Kecamatan ' + (idx + 1));
            if (kecNames.indexOf(name) === -1) {
              kecNames.push(name);
            }
          });
        }
        kecNames.sort().forEach(function(k) {
          kecDropdown.append('<option value="' + k + '">Kec. ' + k + '</option>');
        });

        if (kecamatanGeoJsonLayer) {
          dashMapInstance.removeLayer(kecamatanGeoJsonLayer);
        }

        kecamatanGeoJsonLayer = L.geoJSON(geoJsonData, {
          style: function(feature) {
            var kec = feature.properties.kecamatan || feature.properties.district || feature.properties.nama || '';
            var color = '#0284c7';
            for (var i = 0; i < kecNames.length; i++) {
              if (kecNames[i].toLowerCase() === kec.toLowerCase()) {
                color = getDistrictColor(i);
                break;
              }
            }

            return {
              fillColor: color,
              fillOpacity: 0.18,
              color: color,
              weight: 2,
              opacity: 0.85
            };
          },
          onEachFeature: function(feature, layer) {
            var kec = feature.properties.kecamatan || feature.properties.district || feature.properties.nama || 'Banyuwangi';

            // Tooltip hover informatif
            layer.bindTooltip('<b>Kecamatan ' + kec + '</b>', {
              sticky: true,
              direction: 'auto',
              className: 'kec-leaflet-tooltip'
            });

            // Hover highlight
            layer.on('mouseover', function() {
              layer.setStyle({
                fillOpacity: 0.45,
                weight: 3.5
              });
            });

            layer.on('mouseout', function() {
              kecamatanGeoJsonLayer.resetStyle(layer);
            });

            // Klik poligon: filter responden & zoom ke batas kecamatan
            layer.on('click', function() {
              $('#gisKecamatanFilter').val(kec);
              filterMapKecamatan(kec);
              dashMapInstance.fitBounds(layer.getBounds(), { padding: [25, 25] });
            });
          }
        }).addTo(dashMapInstance);

        kecamatanGeoJsonLayer.bringToBack();
      });
    }

    // Memuat Data Titik Koordinat & Keterangan Sebaran Responden
    function loadMapSurveyData(surveyId) {
      if (!dashMapInstance) {
        initDashMap();
        return;
      }

      if (respondentMarkersLayer) {
        respondentMarkersLayer.clearLayers();
      }
      markersList = [];
      respondentPointsData = [];

      var $feed = $('#gisRespondentFeedList');
      $feed.html('<div style="text-align: center; padding: 25px; color: #64748b;"><i class="fa-solid fa-spinner fa-spin"></i> Memuat titik sebaran responden...</div>');

      $.ajax({
        url: BaseURL + 'IDE/get_survei_geo_data/' + surveyId,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
          if (res && res.status && Array.isArray(res.points)) {
            respondentPointsData = res.points;
            $('#gisTotalPointsBadge').text(res.points.length + ' Titik');

            renderRespondentMarkersAndFeed(res.points);
            updateFocusKecamatanStats(null, res.points);
          } else {
            $feed.html('<div style="text-align: center; padding: 30px; color: #94a3b8;"><i class="fa-solid fa-map-pin" style="font-size: 28px; margin-bottom: 8px; display: block;"></i>Belum ada data titik responden untuk survei ini.</div>');
            $('#gisTotalPointsBadge').text('0 Titik');
            updateFocusKecamatanStats(null, []);
          }
        },
        error: function() {
          $feed.html('<div class="alert alert-danger" style="margin: 15px; font-size: 12px;">Gagal mengambil data sebaran spasial.</div>');
        }
      });
    }

    // Render Markers Responden & Daftar Feed Samping
    function renderRespondentMarkersAndFeed(points) {
      if (respondentMarkersLayer) {
        respondentMarkersLayer.clearLayers();
      }
      markersList = [];

      var $feed = $('#gisRespondentFeedList');
      $feed.empty();

      if (!points || points.length === 0) {
        $feed.html('<div style="text-align: center; padding: 30px; color: #94a3b8;"><i class="fa-solid fa-map-pin" style="font-size: 28px; margin-bottom: 8px; display: block;"></i>Belum ada responden pada filter ini.</div>');
        return;
      }

      var bounds = L.latLngBounds();

      points.forEach(function(p, idx) {
        var lat = parseFloat(p.lat);
        var lng = parseFloat(p.lng);
        if (isNaN(lat) || isNaN(lng)) return;

        bounds.extend([lat, lng]);

        // Warna pin & badge mutu berdasarkan skor IKM
        var pinClass = 'pin-green';
        var mutuClass = 'mutu-b';
        if (p.skor >= 3.50) {
          pinClass = 'pin-green';
          mutuClass = 'mutu-a';
        } else if (p.skor >= 2.75) {
          pinClass = 'pin-blue';
          mutuClass = 'mutu-b';
        } else if (p.skor >= 2.00) {
          pinClass = 'pin-yellow';
          mutuClass = 'mutu-c';
        } else {
          pinClass = 'pin-red';
          mutuClass = 'mutu-d';
        }

        var customIcon = L.divIcon({
          className: 'custom-div-icon',
          html: '<div class="dash-map-pin ' + pinClass + '"><i class="fa-solid fa-user" style="font-size: 9px;"></i></div>',
          iconSize: [22, 22],
          iconAnchor: [11, 11],
          popupAnchor: [0, -12]
        });

        var marker = L.marker([lat, lng], { icon: customIcon });

        // Popup Lengkap: Keterangan Sebaran Responden
        var dispKec = p.kecamatan || '-';
        if (dispKec !== '-' && !dispKec.toLowerCase().startsWith('kec')) {
          dispKec = 'Kec. ' + dispKec;
        }
        if (p.kabupaten && p.kabupaten.toLowerCase().indexOf('banyuwangi') === -1) {
          dispKec += ', ' + p.kabupaten;
        }

        var popupContent = 
          '<div class="gmap-popup-card">' +
            '<div class="gmap-popup-header">' +
              '<div class="gmap-popup-avatar"><i class="fa-solid fa-user-check"></i></div>' +
              '<div>' +
                '<h4 class="gmap-popup-name">' + (p.nama || 'Responden Anonim') + '</h4>' +
                '<div class="gmap-popup-time"><i class="fa-regular fa-clock"></i> Submit: ' + (p.time || p.waktuFormatted || p.waktuSubmit || '-') + '</div>' +
              '</div>' +
            '</div>' +
            '<div class="gmap-popup-info-grid">' +
              '<div class="gmap-popup-info-row">' +
                '<span class="gmap-popup-info-lbl"><i class="fa-solid fa-location-dot" style="color: var(--ide-red);"></i> Wilayah:</span>' +
                '<span class="gmap-popup-info-val">' + dispKec + (p.desa ? ', Desa ' + p.desa : '') + '</span>' +
              '</div>' +
              '<div class="gmap-popup-info-row">' +
                '<span class="gmap-popup-info-lbl"><i class="fa-solid fa-crosshairs"></i> Koordinat:</span>' +
                '<span class="gmap-popup-info-val">' + lat.toFixed(6) + ', ' + lng.toFixed(6) + '</span>' +
              '</div>' +
              '<div class="gmap-popup-info-row">' +
                '<span class="gmap-popup-info-lbl"><i class="fa-solid fa-mobile-screen"></i> Perangkat:</span>' +
                '<span class="gmap-popup-info-val">' + (p.device || 'Mobile Browser') + '</span>' +
              '</div>' +
            '</div>' +
            '<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 6px;">' +
              '<div>' +
                '<span style="font-size: 11px; color: #64748b;">' + ((currentSurveyObj && currentSurveyObj.Jenis === 'IKM') ? 'Skor IKM:' : 'Skor:') + '</span> ' +
                '<strong style="font-size: 14px; color: #043168;">' + Number(p.skor || 0).toFixed(2) + '</strong>' +
              '</div>' +
              '<span class="gmap-badge-mutu ' + mutuClass + '">' + (p.mutu || 'Baik') + '</span>' +
            '</div>' +
            (p.id ? 
              '<div style="margin-top: 10px; text-align: center;">' +
                '<button type="button" class="btn btn-sm btn-outline-primary btn-block" style="border-radius: 8px; font-size: 11.5px; font-weight: 700; padding: 4px 8px;" onclick="viewRespondenDetailAnswers(' + currentSurveyId + ', ' + p.id + ')">' +
                  '<i class="fa-solid fa-eye"></i> Rincian Jawaban' +
                '</button>' +
              '</div>' : '') +
          '</div>';

        marker.bindPopup(popupContent, { maxWidth: 300, minWidth: 240 });
        respondentMarkersLayer.addLayer(marker);
        markersList.push(marker);

        // Feed Item Samping
        var feedKec = p.kecamatan || '-';
        if (feedKec !== '-' && !feedKec.toLowerCase().startsWith('kec')) {
          feedKec = 'Kec. ' + feedKec;
        }
        if (p.kabupaten && p.kabupaten.toLowerCase().indexOf('banyuwangi') === -1) {
          feedKec += ', ' + p.kabupaten;
        }

        var feedItemHtml = 
          '<div class="gis-feed-item" id="feedItem_' + idx + '" onclick="focusMapPoint(' + lat + ', ' + lng + ', ' + idx + ')">' +
            '<div style="display:flex; justify-content:space-between; align-items:center;">' +
              '<strong style="font-size: 12.5px; color: #0f172a;">' + (p.nama || 'Responden Anonim') + '</strong>' +
              '<span style="font-size: 11px; background:#ecfdf5; color:#065f46; font-weight:700; padding:1px 6px; border-radius:6px;">' + Number(p.skor || 0).toFixed(2) + '</span>' +
            '</div>' +
            '<div style="font-size: 11px; color:#64748b; margin-top: 3px;">' +
              '<i class="fa-solid fa-location-dot" style="color:var(--ide-red);"></i> ' + feedKec + ' &bull; <i class="fa-regular fa-clock"></i> ' + (p.time ? p.time.substring(0, 16) : '-') +
            '</div>' +
          '</div>';
        $feed.append(feedItemHtml);
      });

      if (bounds.isValid() && dashMapInstance) {
        dashMapInstance.fitBounds(bounds, { padding: [35, 35], maxZoom: 13 });
      }
    }

    // Sorot titik responden tertentu dari feed
    function focusMapPoint(lat, lng, idx) {
      if (!dashMapInstance) return;
      dashMapInstance.flyTo([lat, lng], 15, { duration: 0.8 });
      $('.gis-feed-item').removeClass('active');
      $('#feedItem_' + idx).addClass('active');

      if (markersList[idx]) {
        setTimeout(function() {
          markersList[idx].openPopup();
        }, 500);
      }
    }

    // Filter Peta Berdasarkan Kecamatan
    function filterMapKecamatan(kecName) {
      if (!kecName) {
        $('#focusKecName').text('Kabupaten Banyuwangi');
        renderRespondentMarkersAndFeed(respondentPointsData);
        updateFocusKecamatanStats(null, respondentPointsData);
        if (dashMapInstance) {
          dashMapInstance.setView([-8.32, 114.25], 10);
        }
        return;
      }

      $('#focusKecName').text('Kecamatan ' + kecName);

      var filtered = respondentPointsData.filter(function(p) {
        var k = (p.kecamatan || '').toLowerCase();
        return k === kecName.toLowerCase() || k.indexOf(kecName.toLowerCase()) !== -1;
      });

      renderRespondentMarkersAndFeed(filtered);
      updateFocusKecamatanStats(kecName, filtered);

      var key = kecName.toLowerCase().replace(/[^a-z]/g, '');
      if (districtCoords[key] && dashMapInstance) {
        dashMapInstance.flyTo([districtCoords[key].lat, districtCoords[key].lng], 13);
      }
    }

    // Hitung ringkasan statistik wilayah fokus
    function updateFocusKecamatanStats(kecName, points) {
      var total = points.length;
      var sum = 0;
      var lastTime = '-';

      points.forEach(function(p) {
        sum += parseFloat(p.skor || 0);
        if (p.time) lastTime = p.time.substring(0, 16);
      });

      var avg = total > 0 ? (sum / total).toFixed(2) : '0.00';
      var mutu = '-';
      if (total > 0) {
        if (avg >= 3.50) mutu = 'Sangat Baik (A)';
        else if (avg >= 2.75) mutu = 'Baik (B)';
        else if (avg >= 2.00) mutu = 'Kurang Baik (C)';
        else mutu = 'Tidak Baik (D)';
      }

      $('#focusKecTotal').text(total);
      $('#focusKecSkor').text(avg);
      $('#focusKecMutu').text(mutu);
      $('#focusKecTime').text(lastTime);
    }

    function reloadMapData() {
      loadMapSurveyData(currentSurveyId);
    }

    // Alias kompatibilitas
    var loadGoogleMapSurveyData = loadMapSurveyData;
    var reloadGoogleMapData = reloadMapData;
    var filterGoogleMapKecamatan = filterMapKecamatan;
    var initDashGoogleMap = initDashMap;
    var focusGoogleMapPoint = focusMapPoint;

    // =========================================================================
    // RESPONDENT FORM MINI-MAP & GEOTAGGING (100% WATERMARK-FREE)
    // =========================================================================
    function initDashMiniMap() {
      var miniMapElem = document.getElementById('dashFormMiniGoogleMap');
      if (!miniMapElem) return;

      var initialLat = parseFloat($('#dashLatitude').val()) || -8.219200;
      var initialLng = parseFloat($('#dashLongitude').val()) || 114.369200;

      if (dashMiniMapInstance) {
        dashMiniMapInstance.invalidateSize();
        return;
      }

      dashMiniMapInstance = L.map('dashFormMiniGoogleMap', {
        center: [initialLat, initialLng],
        zoom: 13,
        scrollWheelZoom: false,
        attributionControl: false
      });

      // OpenStreetMap tile layer (Bebas Watermark)
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
      }).addTo(dashMiniMapInstance);

      var pinIcon = L.divIcon({
        className: 'custom-div-icon',
        html: '<div class="dash-map-pin pin-red" style="width:26px;height:26px;"><i class="fa-solid fa-location-dot" style="font-size:12px;"></i></div>',
        iconSize: [26, 26],
        iconAnchor: [13, 13]
      });

      dashMiniMarkerInstance = L.marker([initialLat, initialLng], {
        draggable: true,
        icon: pinIcon
      }).addTo(dashMiniMapInstance);

      dashMiniMarkerInstance.on('dragend', function() {
        var pos = dashMiniMarkerInstance.getLatLng();
        $('#dashLatitude').val(pos.lat.toFixed(6));
        $('#dashLongitude').val(pos.lng.toFixed(6));
      });

      dashMiniMapInstance.on('click', function(e) {
        dashMiniMarkerInstance.setLatLng(e.latlng);
        $('#dashLatitude').val(e.latlng.lat.toFixed(6));
        $('#dashLongitude').val(e.latlng.lng.toFixed(6));
      });
    }

    function captureDashGPS() {
      if (navigator.geolocation) {
        Swal.fire({
          title: 'Mendeteksi Lokasi GPS...',
          text: 'Mohon izinkan akses lokasi pada browser Anda.',
          allowOutsideClick: false,
          didOpen: function() { Swal.showLoading(); }
        });

        navigator.geolocation.getCurrentPosition(function(pos) {
          Swal.close();
          var lat = pos.coords.latitude;
          var lng = pos.coords.longitude;

          $('#dashLatitude').val(lat.toFixed(6));
          $('#dashLongitude').val(lng.toFixed(6));

          if (dashMiniMapInstance && dashMiniMarkerInstance) {
            dashMiniMapInstance.setView([lat, lng], 15);
            dashMiniMarkerInstance.setLatLng([lat, lng]);
          }

          Swal.fire({
            icon: 'success',
            title: 'Lokasi Terdeteksi!',
            text: 'Koordinat GPS Anda: ' + lat.toFixed(6) + ', ' + lng.toFixed(6),
            timer: 2000,
            showConfirmButton: false
          });
        }, function(err) {
          Swal.fire('GPS Gagal', 'Tidak dapat mengambil lokasi: ' + err.message, 'warning');
        }, { enableHighAccuracy: true, timeout: 8000 });
      } else {
        Swal.fire('Tidak Didukung', 'Browser Anda tidak mendukung Geolocation GPS.', 'error');
      }
    }

    function onDashKecamatanChange(kecName) {
      var key = kecName.toLowerCase().replace(/[^a-z]/g, '');
      if (districtCoords[key]) {
        var c = districtCoords[key];
        $('#dashLatitude').val(c.lat.toFixed(6));
        $('#dashLongitude').val(c.lng.toFixed(6));

        if (dashMiniMapInstance && dashMiniMarkerInstance) {
          dashMiniMapInstance.setView([c.lat, c.lng], 13);
          dashMiniMarkerInstance.setLatLng([c.lat, c.lng]);
        }
      }
    }

    // =========================================================================
    // VISUALISASI DATA ANALITIK SURVEI (DONAT, BATANG, LINGKARAN) & REKAP ENGINE
    // =========================================================================
    var rekapDonutChart = null;
    var rekapBarChart = null;
    var rekapPieChart = null;
    var currentRekapData = null;
    var currentDemoDimension = 'gender';

    function renderRekapCharts(res) {
      currentRekapData = res;
      var totalResp = (res && res.totalResponden !== undefined) ? res.totalResponden : (res && res.responden ? res.responden.length : 0);
      
      // Update badge header
      if (res && res.survei && res.survei.Judul) {
        $('#chartSurveyTitleBadge').text(res.survei.Judul);
      }
      $('#chartTotalRespBadge').text(totalResp + ' Responden');

      // 1. Render Bagan Donat: Mutu Pelayanan
      renderRekapDonutMutu(res.distribusiMutu, res.rataRataSkor, totalResp);

      // 2. Render Bagan Batang: Parameter Butir Pertanyaan
      renderRekapBarParameter(res.parameterStats);

      // 3. Render Diagram Lingkaran: Demografi Responden
      renderRekapPieDemografi(currentDemoDimension);
    }

    function renderRekapDonutMutu(dist, avgSkor, totalResp) {
      var ctx = document.getElementById('dashRekapDonutMutu');
      if (!ctx) return;

      if (rekapDonutChart) {
        rekapDonutChart.destroy();
        rekapDonutChart = null;
      }

      dist = dist || { 'Sangat Baik': 0, 'Baik': 0, 'Kurang Baik': 0, 'Tidak Baik': 0 };
      var vals = [
        dist['Sangat Baik'] || 0,
        dist['Baik'] || 0,
        dist['Kurang Baik'] || 0,
        dist['Tidak Baik'] || 0
      ];
      var total = vals.reduce(function(a, b) { return a + b; }, 0);

      if (total === 0) {
        $('#donutEmptyState').show();
        $('#donutMutuLegend').empty();
        return;
      }
      $('#donutEmptyState').hide();

      var labels = ['Sangat Baik', 'Baik', 'Kurang Baik', 'Tidak Baik'];
      var bgColors = ['#10b981', '#0284c7', '#f59e0b', '#ef4444'];
      var hoverColors = ['#059669', '#0369a1', '#d97706', '#dc2626'];

      // Render Legend with count & %
      var legendHtml = '';
      labels.forEach(function(lbl, i) {
        var count = vals[i];
        var pct = total > 0 ? ((count / total) * 100).toFixed(1) : 0;
        legendHtml += 
          '<div style="text-align: center; padding: 2px 4px;">' +
            '<div style="display: flex; align-items: center; justify-content: center; gap: 4px; font-weight: 700; color: #475569;">' +
              '<span style="width: 8px; height: 8px; border-radius: 50%; background: ' + bgColors[i] + '; display: inline-block;"></span> ' + lbl +
            '</div>' +
            '<div style="font-weight: 800; color: #0f172a; margin-top: 2px;">' + count + ' <span style="font-size: 10px; color: #64748b;">(' + pct + '%)</span></div>' +
          '</div>';
      });
      $('#donutMutuLegend').html(legendHtml);

      rekapDonutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: labels,
          datasets: [{
            data: vals,
            backgroundColor: bgColors,
            hoverBackgroundColor: hoverColors,
            borderWidth: 2,
            borderColor: '#ffffff'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '68%',
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              callbacks: {
                label: function(item) {
                  var c = item.raw;
                  var p = total > 0 ? ((c / total) * 100).toFixed(1) : 0;
                  return ' ' + item.label + ': ' + c + ' responden (' + p + '%)';
                }
              }
            }
          }
        }
      });
    }

    function renderRekapBarParameter(parameterStats) {
      var ctx = document.getElementById('dashRekapBarParameter');
      if (!ctx) return;

      if (rekapBarChart) {
        try { rekapBarChart.destroy(); } catch(e) {}
        rekapBarChart = null;
      }

      if (!parameterStats || !Array.isArray(parameterStats) || parameterStats.length === 0) {
        $('#barEmptyState').show();
        return;
      }

      // Filter questions that are scale / likert / radio or have scores
      var activeParams = parameterStats.filter(function(p) {
        var t = String(p.Tipe || p.tipe || '').toLowerCase();
        return t !== 'textarea';
      });
      if (activeParams.length === 0) {
        activeParams = parameterStats;
      }

      var labels = activeParams.map(function(p, idx) { 
        return p.label || ('P' + (p.no || p.Urutan || (idx + 1))); 
      });
      var dataVals = activeParams.map(function(p) { 
        var val = (p.avg !== undefined && p.avg !== null) ? p.avg : ((p.AvgScore !== undefined && p.AvgScore !== null) ? p.AvgScore : 0);
        return parseFloat(val) || 0;
      });

      var bgColors = dataVals.map(function(score) {
        if (score >= 4.0) return '#10b981';
        if (score >= 3.5) return '#0284c7';
        if (score >= 3.0) return '#f59e0b';
        return '#ef4444';
      });

      $('#barEmptyState').hide();

      try {
        rekapBarChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: 'Rata-rata Skor',
              data: dataVals,
              backgroundColor: bgColors,
              borderRadius: 6,
              maxBarThickness: 42
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
              duration: 400
            },
            scales: {
              y: {
                min: 0,
                max: 5,
                ticks: {
                  stepSize: 1,
                  font: { size: 11, weight: '600' }
                },
                grid: {
                  color: '#f1f5f9'
                }
              },
              x: {
                ticks: {
                  font: { size: 11, weight: '700' }
                },
                grid: {
                  display: false
                }
              }
            },
            plugins: {
              legend: {
                display: false
              },
              tooltip: {
                callbacks: {
                  title: function(items) {
                    if (!items || items.length === 0) return '';
                    var idx = items[0].dataIndex;
                    var p = activeParams[idx];
                    var qLabel = p.label || ('P' + (p.no || p.Urutan || (idx + 1)));
                    var qText = p.pertanyaan || p.Pertanyaan || '';
                    return qLabel + ': ' + qText;
                  },
                  label: function(item) {
                    var p = activeParams[item.dataIndex];
                    var count = p.count || p.TotalJwb || 0;
                    return ' Skor Rata-rata: ' + item.raw + ' / 5.00 (' + count + ' jawaban)';
                  }
                }
              }
            }
          }
        });
      } catch (err) {
        console.error('Error rendering bar chart:', err);
      }
    }

    function renderRekapPieDemografi(dimension) {
      var ctx = document.getElementById('dashRekapPieDemografi');
      if (!ctx) return;

      if (rekapPieChart) {
        rekapPieChart.destroy();
        rekapPieChart = null;
      }

      if (!currentRekapData) {
        $('#pieEmptyState').show();
        $('#pieDemografiLegend').empty();
        return;
      }

      var labels = [];
      var vals = [];
      var bgColors = [];

      if (dimension === 'gender') {
        var gDist = currentRekapData.distribusiGender || { 'Laki-laki': 0, 'Perempuan': 0 };
        labels = ['Laki-laki', 'Perempuan'];
        vals = [gDist['Laki-laki'] || 0, gDist['Perempuan'] || 0];
        bgColors = ['#0284c7', '#ec4899'];
      } else if (dimension === 'usia') {
        var uDist = currentRekapData.distribusiUsia || {};
        labels = Object.keys(uDist);
        vals = Object.values(uDist);
        bgColors = ['#06b6d4', '#3b82f6', '#6366f1', '#8b5cf6', '#d946ef'];
      } else if (dimension === 'kecamatan') {
        var kDist = currentRekapData.distribusiKecamatan || {};
        var kList = [];
        for (var k in kDist) {
          kList.push({ name: k, count: kDist[k] });
        }
        kList.sort(function(a, b) { return b.count - a.count; });
        var top = kList.slice(0, 5);
        var remainder = kList.slice(5).reduce(function(sum, cur) { return sum + cur.count; }, 0);
        labels = top.map(function(item) { return item.name; });
        vals = top.map(function(item) { return item.count; });
        if (remainder > 0) {
          labels.push('Lainnya');
          vals.push(remainder);
        }
        bgColors = ['#ef4444', '#f97316', '#f59e0b', '#10b981', '#06b6d4', '#8b5cf6'];
      }

      var total = vals.reduce(function(a, b) { return a + b; }, 0);
      if (total === 0) {
        $('#pieEmptyState').show();
        $('#pieDemografiLegend').empty();
        return;
      }
      $('#pieEmptyState').hide();

      // Render legend
      var legendHtml = '';
      labels.forEach(function(lbl, i) {
        var c = vals[i];
        var p = total > 0 ? ((c / total) * 100).toFixed(1) : 0;
        legendHtml += 
          '<div style="display: flex; align-items: center; gap: 4px; font-size: 11px; color: #475569;">' +
            '<span style="width: 8px; height: 8px; border-radius: 50%; background: ' + bgColors[i % bgColors.length] + '; display: inline-block;"></span> ' +
            '<strong>' + lbl + ':</strong> ' + c + ' (' + p + '%)' +
          '</div>';
      });
      $('#pieDemografiLegend').html(legendHtml);

      rekapPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: vals,
            backgroundColor: bgColors,
            borderWidth: 2,
            borderColor: '#ffffff'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              callbacks: {
                label: function(item) {
                  var count = item.raw;
                  var pct = total > 0 ? ((count / total) * 100).toFixed(1) : 0;
                  return ' ' + item.label + ': ' + count + ' (' + pct + '%)';
                }
              }
            }
          }
        }
      });
    }

    function switchDemographicPie(dimension) {
      currentDemoDimension = dimension;
      $('.btn-demo-filter').removeClass('active');
      if (dimension === 'gender') $('#btnDemoGender').addClass('active');
      else if (dimension === 'usia') $('#btnDemoUsia').addClass('active');
      else if (dimension === 'kecamatan') $('#btnDemoKec').addClass('active');

      renderRekapPieDemografi(dimension);
    }

    // =========================================================================
    // REKAPITULASI RESPONDEN STATE & REAL-TIME FILTER ENGINE
    // =========================================================================
    window.currentRekapRespondenList = [];
    window.currentRekapSurveyId = null;

    function clearRekapSearch() {
      $('#rekapSearchInput').val('');
      applyDashboardRekapFilters();
    }

    function resetDashboardRekapFilters() {
      $('#rekapSearchInput').val('');
      $('#rekapFilterInstrumen').val('');
      $('#rekapFilterKecamatan').val('');
      $('#rekapFilterMutu').val('');
      $('#rekapSortOrder').val('newest');
      applyDashboardRekapFilters();
    }

    function applyDashboardRekapFilters() {
      var $tbody = $('#dashRekapTableBody');
      var list = window.currentRekapRespondenList || [];
      var surveyId = window.currentRekapSurveyId || currentSurveyId;

      var searchKeyword = ($('#rekapSearchInput').val() || '').trim().toLowerCase();
      var filterInst = ($('#rekapFilterInstrumen').val() || '').trim().toUpperCase();
      var filterKec = ($('#rekapFilterKecamatan').val() || '').trim().toLowerCase();
      var filterMutu = ($('#rekapFilterMutu').val() || '').trim();
      var sortOrder = $('#rekapSortOrder').val() || 'newest';

      $('#rekapSearchClearBtn').toggle(searchKeyword.length > 0);

      var filtered = list.filter(function(r) {
        // Filter Instrumen
        if (filterInst) {
          var rInst = (r.Instrumen || '').trim().toUpperCase();
          if (filterInst === 'C' && (rInst === 'C' || rInst === 'E')) {
            // Instrumen C / E
          } else if (rInst !== filterInst) {
            return false;
          }
        }

        // Filter Kecamatan
        if (filterKec) {
          var rKec = (r.Kecamatan || '').toLowerCase();
          if (rKec.indexOf(filterKec) === -1) {
            return false;
          }
        }

        // Filter Mutu
        if (filterMutu) {
          var rMutu = (r.MutuPelayanan || '');
          if (rMutu.indexOf(filterMutu) === -1) {
            return false;
          }
        }

        // Filter Search Keyword across all relevant respondent fields
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
      } else if (sortOrder === 'with_photo') {
        filtered.sort(function(a, b) {
          var hasA = a.FotoDokumentasi ? 1 : 0;
          var hasB = b.FotoDokumentasi ? 1 : 0;
          if (hasA !== hasB) return hasB - hasA;
          return (b.Id || 0) - (a.Id || 0);
        });
      }

      // Update Counter Badge
      $('#rekapFilterCountBadge').html('<i class="fa-solid fa-users"></i> Menampilkan ' + filtered.length + ' dari ' + list.length + ' Responden');

      $tbody.empty();

      if (filtered.length === 0) {
        if (list.length === 0) {
          $tbody.html('<tr><td colspan="9" style="text-align: center; padding: 40px; color: #94a3b8;"><i class="fa-solid fa-clipboard-question" style="font-size: 28px; color: #cbd5e1; display: block; margin-bottom: 8px;"></i> Belum ada data responden untuk survei ini.</td></tr>');
        } else {
          $tbody.html('<tr><td colspan="9" style="text-align: center; padding: 40px; color: #64748b;"><i class="fa-solid fa-magnifying-glass" style="font-size: 28px; color: #cbd5e1; display: block; margin-bottom: 8px;"></i> Tidak ditemukan data responden yang sesuai dengan filter atau kata kunci pencarian.<br><button type="button" class="btn btn-sm btn-outline-primary" style="margin-top: 10px; border-radius: 8px; font-weight: 700;" onclick="resetDashboardRekapFilters()"><i class="fa-solid fa-rotate-left"></i> Reset Filter &amp; Pencarian</button></td></tr>');
        }
        return;
      }

      filtered.forEach(function(r, idx) {
        var rKec = r.Kecamatan || '';
        if (rKec && !rKec.toLowerCase().startsWith('kec')) {
          rKec = 'Kec. ' + rKec;
        }
        if (r.Kabupaten && r.Kabupaten.toLowerCase().indexOf('banyuwangi') === -1) {
          rKec += ', ' + r.Kabupaten;
        }
        var wilayah = (rKec ? rKec : '') + (r.Desa ? ', Desa ' + r.Desa : '');
        if (!wilayah) wilayah = r.AlamatDetail || '-';

        var demografi = (r.RespondenGender || '-') + ' &bull; ' + (r.RespondenUsia || '-');
        if (r.RespondenPekerjaan) {
          demografi += '<br><span style="font-size: 11px; color: #64748b;">' + r.RespondenPekerjaan + '</span>';
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

        var fotoCell = '<span class="text-muted" style="font-size: 11.5px;">-</span>';
        if (r.FotoDokumentasi) {
          var safeNama = r.RespondenNama ? r.RespondenNama.replace(/'/g, "\\'") : 'Responden';
          fotoCell = 
            '<button type="button" class="btn btn-sm btn-outline-info" style="border-radius: 8px; font-size: 11px; font-weight: 700; padding: 3px 8px; display: inline-flex; align-items: center; gap: 4px;" onclick="previewDashboardPhoto(\'' + BaseURL + r.FotoDokumentasi + '\', \'' + safeNama + '\')" title="Lihat Foto Dokumentasi">' +
              '<i class="fa-solid fa-camera"></i> Foto' +
            '</button>';
        }

        $tbody.append(
          '<tr>' +
            '<td style="text-align: center; font-weight: 700; color: #64748b;">' + (idx + 1) + '</td>' +
            '<td><span style="font-size: 12px; font-weight: 700; color: #1e293b;"><i class="fa-regular fa-clock" style="color: var(--ide-red); margin-right: 4px;"></i>' + (r.CreatedAt ? r.CreatedAt.substring(0, 16) + ' WIB' : '-') + '</span></td>' +
            '<td><b>' + (r.RespondenNama || 'Anonim') + '</b>' + nikInfo + (instBadge ? '<br>' + instBadge : '') + '</td>' +
            '<td><span class="badge badge-light" style="font-size: 12px;"><i class="fa-solid fa-location-dot" style="color: var(--ide-red);"></i> ' + wilayah + '</span></td>' +
            '<td><span style="font-size: 12px; color: #475569;">' + demografi + '</span></td>' +
            '<td style="text-align: center;">' + fotoCell + '</td>' +
            '<td style="text-align: center;"><strong style="color: #059669; font-size: 14px;">' + (r.RataRataSkor || '0.00') + '</strong></td>' +
            '<td style="text-align: center;"><span class="badge badge-success" style="padding: 4px 8px;">' + (r.MutuPelayanan || 'Baik') + '</span></td>' +
            '<td style="text-align: center;">' +
              '<div style="display: flex; gap: 6px; justify-content: center;">' +
                '<button type="button" class="btn btn-sm btn-outline-primary" style="border-radius: 8px; font-weight: 700;" onclick="viewRespondenDetailAnswers(' + surveyId + ', ' + r.Id + ')" title="Lihat Rincian Jawaban">' +
                  '<i class="fa-solid fa-eye"></i> Rincian' +
                '</button>' +
                (userLevel !== 5 ? (
                '<button type="button" class="btn btn-sm btn-outline-danger" style="border-radius: 8px; font-weight: 700;" onclick="deleteRespondenData(' + surveyId + ', ' + r.Id + ', \'' + (r.RespondenNama ? r.RespondenNama.replace(/'/g, "\\'") : 'Responden') + '\')" title="Hapus Data Responden">' +
                  '<i class="fa-solid fa-trash-can"></i> Hapus' +
                '</button>'
                ) : '') +
              '</div>' +
            '</td>' +
          '</tr>'
        );
      });
    }

    function loadDashboardRekapData(surveyId) {
      $('#dashRekapTableBody').html('<tr><td colspan="9" style="text-align: center; padding: 30px; color: #64748b;"><i class="fa-solid fa-spinner fa-spin"></i> Memuat data rekapitulasi...</td></tr>');

      $.ajax({
        url: BaseURL + 'IDE/get_survei_rekap_data/' + surveyId,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
          if (res && res.status) {
            // Render Visualisasi Data Otomatis (Donat, Batang, Lingkaran)
            renderRekapCharts(res);

            window.currentRekapSurveyId = surveyId;
            window.currentRekapRespondenList = Array.isArray(res.responden) ? res.responden : [];

            // Populate Filter Kecamatan secara dinamis dari sebaran wilayah responden aktual
            var uniqueKec = [];
            window.currentRekapRespondenList.forEach(function(r) {
              var k = (r.Kecamatan || '').trim();
              if (k && uniqueKec.indexOf(k) === -1) {
                uniqueKec.push(k);
              }
            });
            uniqueKec.sort();
            var $kecSelect = $('#rekapFilterKecamatan');
            var prevKecVal = $kecSelect.val();
            $kecSelect.find('option:not(:first)').remove();
            uniqueKec.forEach(function(k) {
              $kecSelect.append('<option value="' + k.toLowerCase() + '">' + k + '</option>');
            });
            if (prevKecVal) $kecSelect.val(prevKecVal);

            // Deteksi apakah survei multi-instrumen (misal RTKD)
            var isMultiInst = (surveyId == 4) || (res.survei && res.survei.TipeSurvei === 'multi') || window.currentRekapRespondenList.some(function(r) { return r.Instrumen && r.Instrumen !== ''; });
            if (isMultiInst) {
              $('#filterColInstrumen').show();
            } else {
              $('#filterColInstrumen').hide();
            }

            // Jalankan filter & render tabel
            applyDashboardRekapFilters();
          }
        }
      });
    }

    function previewDashboardPhoto(url, nama) {
      if (!url) return;
      Swal.fire({
        title: 'Foto Dokumentasi: ' + (nama || 'Responden'),
        html: 
          '<div style="text-align:center; padding: 10px 0;">' +
            '<img src="' + url + '" style="max-width:100%; max-height:68vh; border-radius:12px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); border: 2px solid #e2e8f0;">' +
            '<div style="margin-top:14px;">' +
              '<a href="' + url + '" target="_blank" download class="btn btn-sm btn-primary" style="font-size:12px; font-weight:700; border-radius:8px; padding: 6px 14px;">' +
                '<i class="fa-solid fa-download mr-1"></i> Unduh Foto Penuh' +
              '</a>' +
            '</div>' +
          '</div>',
        width: 'auto',
        showCloseButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> Tutup',
        confirmButtonColor: '#043168'
      });
    }

    function viewRespondenDetailAnswers(surveyId, respondenId) {
      $('#rincianRespondenInfo').html('<i class="fa-solid fa-spinner fa-spin"></i> Memuat...');
      $('#rincianJawabanContainer').empty();
      $('#modalRincianJawaban').modal('show');

      $.ajax({
        url: BaseURL + 'IDE/get_responden_detail/' + respondenId,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
          if (res && res.status && res.data) {
            var r = res.data;
            var rKec = r.Kecamatan || '-';
            if (rKec !== '-' && !rKec.toLowerCase().startsWith('kec')) {
              rKec = 'Kec. ' + rKec;
            }
            if (r.Kabupaten && r.Kabupaten.toLowerCase().indexOf('banyuwangi') === -1) {
              rKec += ', ' + r.Kabupaten;
            }
            var rDesa = r.Desa ? ', Desa ' + r.Desa : '';

            var fotoSection = r.FotoDokumentasi ? (
              '<div style="margin-top: 12px; display: flex; align-items: center; gap: 14px; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 12px; padding: 12px 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">' +
                '<img src="' + BaseURL + r.FotoDokumentasi + '" style="width: 75px; height: 60px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 2px solid #043168; box-shadow: 0 2px 6px rgba(0,0,0,0.1);" onclick="previewDashboardPhoto(\'' + BaseURL + r.FotoDokumentasi + '\', \'' + (r.RespondenNama ? r.RespondenNama.replace(/'/g, "\\'") : 'Responden') + '\')" title="Klik untuk melihat foto penuh">' +
                '<div style="flex: 1;">' +
                  '<div style="font-size: 12.5px; font-weight: 800; color: #043168;"><i class="fa-solid fa-camera mr-1"></i> Foto Dokumentasi Survei Lapangan</div>' +
                  '<div style="font-size: 11px; color: #64748b; margin-top: 2px;">Tercatat dari kamera HP surveiyor saat submit jawaban</div>' +
                  '<button type="button" class="btn btn-sm btn-outline-primary mt-1" style="font-size: 11px; padding: 2px 10px; font-weight: 700; border-radius: 6px;" onclick="previewDashboardPhoto(\'' + BaseURL + r.FotoDokumentasi + '\', \'' + (r.RespondenNama ? r.RespondenNama.replace(/'/g, "\\'") : 'Responden') + '\')"><i class="fa-solid fa-magnifying-glass-plus"></i> Lihat Foto Penuh</button>' +
                '</div>' +
              '</div>'
            ) : '';

            var modalSkorLabel = (currentSurveyObj && currentSurveyObj.Jenis === 'IKM') ? 'Skor IKM: ' : 'Skor: ';
            $('#rincianRespondenInfo').html(
              '<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 18px;">' +
                '<div style="font-size: 16px; font-weight: 800; color: var(--ide-navy);">' + (r.RespondenNama || 'Anonim') + '</div>' +
                '<div style="font-size: 12.5px; color: #64748b; margin-top: 4px;">NIK: ' + (r.RespondenNIK || '-') + ' &bull; Kontak: ' + (r.RespondenKontak || '-') + ' &bull; Wilayah: ' + rKec + rDesa + '</div>' +
                '<div style="margin-top: 6px; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">' +
                  '<span class="badge badge-success">' + modalSkorLabel + (r.RataRataSkor || '0.00') + ' (' + (r.MutuPelayanan || 'Baik') + ')</span>' +
                  (r.CreatedAt ? '<span class="badge badge-light" style="font-size: 11.5px; border: 1px solid #cbd5e1; color: #334155;"><i class="fa-regular fa-clock" style="color: var(--ide-red); margin-right: 4px;"></i>' + r.CreatedAt + ' WIB</span>' : '') +
                '</div>' +
                fotoSection +
              '</div>'
            );

            if (res.answers && Array.isArray(res.answers)) {
              var html = '';
              res.answers.forEach(function(ans, i) {
                var secBadge = ans.Section ? ' <span style="font-size: 10.5px; background: #e0f2fe; color: #0369a1; padding: 2px 8px; border-radius: 6px; font-weight: 700; margin-left: 6px;">' + ans.Section.split('.')[0] + '</span>' : '';
                html += 
                  '<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 16px; margin-bottom: 10px;">' +
                    '<div style="display: flex; align-items: center; justify-content: space-between;">' +
                      '<div style="font-size: 12px; font-weight: 800; color: #0369a1;">#' + (i + 1) + ' ' + (ans.Pertanyaan || 'Pertanyaan') + '</div>' +
                      secBadge +
                    '</div>' +
                    '<div style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-top: 4px;"><i class="fa-solid fa-circle-check" style="color: #059669;"></i> Jawaban: ' + (ans.JawabanTeks || ans.Jawaban || '-') + '</div>' +
                  '</div>';
              });
              $('#rincianJawabanContainer').html(html);
            }
          }
        }
      });
    }

    function exportCurrentSurveyExcel() {
      window.location.href = BaseURL + 'IDE/export_responden_excel/' + currentSurveyId;
    }

    function previewPublicSurvey() {
      window.open(getSurveyPublicUrl(currentSurveyId), '_blank');
    }

    // =========================================================================
    // HAPUS DATA RESPONDEN & HAPUS SURVEI (AKSES STAF & ADMIN)
    // =========================================================================
    function deleteRespondenData(surveyId, respondenId, respondenNama) {
      if (userLevel === 5) {
        Swal.fire('Akses Ditolak', 'User role survei tidak memiliki hak akses untuk menghapus data responden.', 'error');
        return;
      }
      Swal.fire({
        title: 'Hapus Data Responden?',
        html: 'Anda yakin ingin menghapus data responden <b>' + (respondenNama || 'ini') + '</b>?<br><span style="font-size:12.5px; color:#ef4444;">Seluruh jawaban survei terkait akan dihapus permanen.</span>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#b40814',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="fa-solid fa-trash-can"></i> Ya, Hapus Data',
        cancelButtonText: 'Batal'
      }).then(function(result) {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Menghapus data...',
            allowOutsideClick: false,
            didOpen: function() { Swal.showLoading(); }
          });
          $.ajax({
            url: BaseURL + 'IDE/delete_survei_responden/' + respondenId,
            type: 'POST',
            dataType: 'json',
            success: function(res) {
              if (res && res.status) {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil Dihapus',
                  text: res.message || 'Data responden berhasil dihapus.',
                  timer: 1600,
                  showConfirmButton: false
                });
                loadDashboardRekapData(surveyId);
                loadMapSurveyData(surveyId);
              } else {
                Swal.fire('Gagal', (res && res.message) ? res.message : 'Terjadi kendala saat menghapus data.', 'error');
              }
            },
            error: function(xhr, status, err) {
              Swal.fire('Gagal', 'Terjadi kesalahan pada server: ' + err, 'error');
            }
          });
        }
      });
    }

    function deleteSurveyTemplate(surveyId, surveyTitle) {
      if (userLevel === 5) {
        Swal.fire('Akses Ditolak', 'User role survei tidak memiliki hak akses untuk menghapus instrumen survei.', 'error');
        return;
      }
      Swal.fire({
        title: 'Hapus Instrumen Survei?',
        html: 'Anda yakin ingin menghapus survei <b>' + (surveyTitle || '') + '</b>?<br><span style="font-size:12px; color:#ef4444;">Semua butir pertanyaan dan seluruh rekap jawaban responden terkait akan dihapus permanen.</span>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#b40814',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="fa-solid fa-trash-can"></i> Ya, Hapus Survei',
        cancelButtonText: 'Batal'
      }).then(function(result) {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Menghapus instrumen survei...',
            allowOutsideClick: false,
            didOpen: function() { Swal.showLoading(); }
          });
          $.ajax({
            url: BaseURL + 'IDE/delete_survei_dinamis/' + surveyId,
            type: 'POST',
            dataType: 'json',
            success: function(res) {
              if (res && res.status) {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil Dihapus',
                  text: res.message || 'Survei berhasil dihapus.',
                  timer: 1600,
                  showConfirmButton: false
                }).then(function() {
                  window.location.reload();
                });
              } else {
                Swal.fire('Gagal', (res && res.message) ? res.message : 'Terjadi kendala saat menghapus survei.', 'error');
              }
            },
            error: function(xhr, status, err) {
              Swal.fire('Gagal', 'Terjadi kesalahan pada server: ' + err, 'error');
            }
          });
        }
      });
    }

    // =========================================================================
    // FITUR QR CODE KUESIONER PUBLIK (VIEW, COPY LINK, UNDUH PNG, CETAK POSTER)
    // =========================================================================
    function getSurveyPublicUrl(surveyId) {
      var s = allSurveysData.find(function(item) { return item.Id == surveyId; }) || currentSurveyObj;
      var targetUrl = BaseURL + 'MenuSurvei';
      if (s && s.KodeSurvei) {
        targetUrl += '/' + encodeURIComponent(s.KodeSurvei);
      } else if (s && s.Id) {
        targetUrl += '/' + encodeURIComponent(s.Id);
      }
      return targetUrl;
    }

    function showSurveyQRCode(surveyId) {
      var sId = surveyId || currentSurveyId;
      var s = allSurveysData.find(function(item) { return item.Id == sId; }) || currentSurveyObj;
      if (!s) return;

      var pubUrl = getSurveyPublicUrl(sId);
      var qrApiUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&margin=10&data=' + encodeURIComponent(pubUrl);

      var safeModalLembaga = (s.Lembaga && s.Lembaga.toLowerCase().indexOf('tenaga kerja') === -1) ? s.Lembaga : 'Pemerintah Kabupaten Banyuwangi';
      $('#qrModalSurveyTitle').text(s.Judul || 'Kuesioner Survei');
      $('#qrModalSurveyLembaga').text(safeModalLembaga + ' • ' + (s.DaerahSurvei || 'Kabupaten Banyuwangi'));
      $('#qrCodeImageDisplay').attr('src', qrApiUrl);
      $('#qrSurveyUrlInput').val(pubUrl);
      $('#qrSurveyOpenLink').attr('href', pubUrl);

      $('#modalSurveyQRCode').modal('show');
    }

    function copySurveyLinkUrl() {
      var copyText = document.getElementById('qrSurveyUrlInput');
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(copyText.value).then(function() {
          Swal.fire({
            icon: 'success',
            title: 'Tautan Tersalin!',
            text: 'Link survei berhasil disalin ke clipboard.',
            timer: 1500,
            showConfirmButton: false
          });
        }).catch(function() {
          fallbackCopyText(copyText.value);
        });
      } else {
        fallbackCopyText(copyText.value);
      }
    }

    function fallbackCopyText(text) {
      var tempInput = document.createElement('input');
      tempInput.value = text;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand('copy');
      document.body.removeChild(tempInput);
      Swal.fire({
        icon: 'success',
        title: 'Tautan Tersalin!',
        timer: 1500,
        showConfirmButton: false
      });
    }

    function downloadQrCodeImage() {
      var qrImg = document.getElementById('qrCodeImageDisplay');
      if (!qrImg || !qrImg.src) return;

      var link = document.createElement('a');
      link.href = qrImg.src;
      link.download = 'QRCode-Survei-' + (currentSurveyObj ? (currentSurveyObj.KodeSurvei || currentSurveyObj.Id) : 'IDE') + '.png';
      link.target = '_blank';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }

    function printSurveyPoster() {
      var s = currentSurveyObj || {};
      var pubUrl = $('#qrSurveyUrlInput').val();
      var qrImgSrc = $('#qrCodeImageDisplay').attr('src');

      var printWin = window.open('', '_blank', 'width=880,height=1050');
      printWin.document.write(
        '<!DOCTYPE html>' +
        '<html><head><title>Poster Standee QR Code - ' + (s.Judul || 'Survei') + '</title>' +
        '<meta name="viewport" content="width=device-width, initial-scale=1.0">' +
        '<link rel="preconnect" href="https://fonts.googleapis.com">' +
        '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' +
        '<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800;900&display=swap" rel="stylesheet">' +
        '<style>' +
        '  * { box-sizing: border-box; margin: 0; padding: 0; }' +
        '  body {' +
        '    font-family: "Plus Jakarta Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;' +
        '    background-color: #0b1f3a;' +
        '    min-height: 100vh;' +
        '    display: flex;' +
        '    flex-direction: column;' +
        '    align-items: center;' +
        '    justify-content: center;' +
        '    padding: 30px 15px;' +
        '    color: #0f172a;' +
        '    -webkit-print-color-adjust: exact;' +
        '    print-color-adjust: exact;' +
        '  }' +
        '  .screen-toolbar {' +
        '    display: flex;' +
        '    gap: 12px;' +
        '    margin-bottom: 20px;' +
        '  }' +
        '  .btn-tool {' +
        '    display: inline-flex;' +
        '    align-items: center;' +
        '    gap: 8px;' +
        '    padding: 10px 24px;' +
        '    border-radius: 12px;' +
        '    font-size: 13px;' +
        '    font-weight: 700;' +
        '    font-family: inherit;' +
        '    cursor: pointer;' +
        '    border: none;' +
        '    box-shadow: 0 4px 15px rgba(0,0,0,0.3);' +
        '  }' +
        '  .btn-print {' +
        '    background: #043168;' +
        '    color: #ffffff;' +
        '  }' +
        '  .btn-close {' +
        '    background: rgba(255, 255, 255, 0.15);' +
        '    color: #ffffff;' +
        '    border: 1px solid rgba(255, 255, 255, 0.25);' +
        '  }' +
        '  /* Poster Canvas container matching the reference layout */' +
        '  .poster-card {' +
        '    width: 100%;' +
        '    max-width: 580px;' +
        '    background: #ffffff;' +
        '    border-radius: 36px;' +
        '    overflow: hidden;' +
        '    box-shadow: 0 25px 65px rgba(0, 0, 0, 0.45);' +
        '    position: relative;' +
        '    display: flex;' +
        '    flex-direction: column;' +
        '  }' +
        '  /* Top Zone: Navy Blue palette (Hanya Judul) */' +
        '  .poster-top-section {' +
        '    background: #043168;' +
        '    color: #ffffff;' +
        '    padding: 48px 36px 95px 36px;' +
        '    text-align: center;' +
        '    position: relative;' +
        '  }' +
        '  .poster-title-text {' +
        '    font-size: 28px;' +
        '    font-weight: 900;' +
        '    letter-spacing: 0.8px;' +
        '    color: #ffffff;' +
        '    text-transform: uppercase;' +
        '    line-height: 1.3;' +
        '    margin-bottom: 22px;' +
        '    max-width: 500px;' +
        '    margin-left: auto;' +
        '    margin-right: auto;' +
        '  }' +
        '  .scan-outline-pill {' +
        '    display: inline-block;' +
        '    border: 2.5px solid #ffffff;' +
        '    border-radius: 12px;' +
        '    padding: 8px 32px;' +
        '    font-size: 14.5px;' +
        '    font-weight: 800;' +
        '    letter-spacing: 2px;' +
        '    text-transform: uppercase;' +
        '    color: #ffffff;' +
        '    background: transparent;' +
        '  }' +
        '  .poster-wave-transition {' +
        '    display: block;' +
        '    width: 100%;' +
        '    height: 48px;' +
        '    margin-top: -1px;' +
        '    background: #043168;' +
        '  }' +
        '  .poster-wave-transition svg {' +
        '    display: block;' +
        '    width: 100%;' +
        '    height: 100%;' +
        '  }' +
        '  .poster-body-section {' +
        '    background: #ffffff;' +
        '    padding: 8px 32px 28px 32px;' +
        '    display: flex;' +
        '    flex-direction: column;' +
        '    align-items: center;' +
        '    position: relative;' +
        '  }' +
        '  /* Clean QR Code Box: Tidak menumpuk, rapi & berjarak proporsional */' +
        '  .qr-clean-box {' +
        '    background: #ffffff;' +
        '    border-radius: 28px;' +
        '    padding: 18px;' +
        '    box-shadow: 0 10px 30px rgba(4, 49, 104, 0.08);' +
        '    border: 2px solid #e2e8f0;' +
        '    margin: 8px 0 24px 0;' +
        '    display: inline-block;' +
        '  }' +
        '  .qr-clean-box img {' +
        '    width: 250px;' +
        '    height: 250px;' +
        '    display: block;' +
        '    border-radius: 14px;' +
        '  }' +
        '  /* Subtitle text below QR code */' +
        '  .poster-info-text {' +
        '    margin: 0 0 24px 0;' +
        '    text-align: center;' +
        '    max-width: 480px;' +
        '  }' +
        '  .poster-callout-title {' +
        '    font-size: 18px;' +
        '    font-weight: 900;' +
        '    color: #043168;' +
        '    letter-spacing: 0.5px;' +
        '    text-transform: uppercase;' +
        '    margin-bottom: 8px;' +
        '  }' +
        '  .poster-callout-desc {' +
        '    font-size: 13px;' +
        '    color: #64748b;' +
        '    line-height: 1.55;' +
        '    margin-bottom: 14px;' +
        '    font-weight: 500;' +
        '  }' +
        '  .poster-url-pill {' +
        '    font-size: 11.5px;' +
        '    font-weight: 600;' +
        '    color: #0369a1;' +
        '    background: #f1f5f9;' +
        '    padding: 8px 18px;' +
        '    border-radius: 12px;' +
        '    word-break: break-all;' +
        '    display: inline-block;' +
        '    border: 1px solid #e2e8f0;' +
        '  }' +
        '  /* Footer bar (Logo tanpa border, tanpa Portal Mandiri) */' +
        '  .poster-footer-row {' +
        '    display: flex;' +
        '    align-items: center;' +
        '    border-top: 1.5px solid #f1f5f9;' +
        '    padding: 16px 28px;' +
        '    background: #ffffff;' +
        '    width: 100%;' +
        '    gap: 18px;' +
        '  }' +
        '  .footer-logo-wrapper {' +
        '    display: flex;' +
        '    align-items: center;' +
        '    flex-shrink: 0;' +
        '  }' +
        '  .footer-logo-wrapper img {' +
        '    height: 38px;' +
        '    max-width: 140px;' +
        '    object-fit: contain;' +
        '    display: block;' +
        '  }' +
        '  .footer-divider {' +
        '    width: 1.5px;' +
        '    height: 30px;' +
        '    background: #e2e8f0;' +
        '    flex-shrink: 0;' +
        '  }' +
        '  .footer-loc-text {' +
        '    font-size: 11px;' +
        '    font-weight: 700;' +
        '    color: #475569;' +
        '    line-height: 1.35;' +
        '    text-align: left;' +
        '  }' +
        '  @media print {' +
        '    body { background: transparent !important; padding: 0 !important; }' +
        '    .screen-toolbar { display: none !important; }' +
        '    .poster-card { box-shadow: none !important; max-width: 100% !important; border-radius: 0 !important; }' +
        '  }' +
        '</style>' +
        '</head><body>' +
        '<div class="screen-toolbar">' +
        '  <button type="button" class="btn-tool btn-print" onclick="window.print()">' +
        '    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/><path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/></svg> Cetak Standee Poster' +
        '  </button>' +
        '  <button type="button" class="btn-tool btn-close" onclick="window.close()">' +
        '    ✕ Tutup' +
        '  </button>' +
        '</div>' +
        '<div class="poster-card">' +
        '  <!-- Top Navy Section (Hanya Judul Saja) -->' +
        '  <div class="poster-top-section">' +
        '    <div class="poster-title-text">' + (s.Judul || 'KUESIONER SURVEI') + '</div>' +
        '    <div class="scan-outline-pill">SCAN THE QR CODE</div>' +
        '  </div>' +
        '  <!-- Wave Transition Curve -->' +
        '  <div class="poster-wave-transition">' +
        '    <svg viewBox="0 0 580 48" preserveAspectRatio="none">' +
        '      <path d="M0,0 C190,48 390,48 580,0 L580,48 L0,48 Z" fill="#ffffff"/>' +
        '    </svg>' +
        '  </div>' +
        '  <!-- Clean Body Section: QR Code completely unstacked & clean -->' +
        '  <div class="poster-body-section">' +
        '    <div class="qr-clean-box">' +
        '      <img src="' + qrImgSrc + '" alt="QR Code Survei">' +
        '    </div>' +
        '    <div class="poster-info-text">' +
        '      <div class="poster-callout-title">SCAN QR CODE UNTUK MENGISI SURVEI</div>' +
        '      <div class="poster-callout-desc">Arahkan kamera smartphone Anda ke QR Code untuk mengakses lembar kuesioner secara langsung dan mandiri.</div>' +
        '      <div class="poster-url-pill">' + (pubUrl ? pubUrl.replace(/^https?:\/\//i, '') : '') + '</div>' +
        '    </div>' +
        '    <!-- Bottom Footer Bar (Logo tanpa border, tanpa Portal Mandiri) -->' +
        '    <div class="poster-footer-row">' +
        '      <div class="footer-logo-wrapper">' +
        '        <img src="' + BaseURL + 'assets/img/logo.png" alt="Logo">' +
        '      </div>' +
        '      <div class="footer-divider"></div>' +
        '      <div class="footer-loc-text">' +
        '        <div>' + (s.DaerahSurvei || 'Kabupaten Banyuwangi') + '</div>' +
        '        <div style="color: #94a3b8; font-weight: 600;">Jawa Timur, Indonesia</div>' +
        '      </div>' +
        '    </div>' +
        '  </div>' +
        '</div>' +
        '</body></html>'
      );
      printWin.document.close();
    }

    // =========================================================================
    // STUDIO PEMBUAT SURVEI DINAMIS ENGINE (GOOGLE FORM MODEL & UNIFORM NAVY ICONS)
    // =========================================================================
    var dashBuilderQuestions = [];

    function renderDashBuilderQuestions() {
      var $container = $('#builderQuestionsList');
      $container.empty();

      var qCount = dashBuilderQuestions.length;
      $('#dashBuilderQuestionsCounter').html('<i class="fa-solid fa-list-check navy-icon"></i> ' + qCount + ' Pertanyaan');

      if (qCount === 0) {
        $container.html(
          '<div style="text-align: center; padding: 48px 24px; background: #ffffff; border-radius: 18px; border: 2px dashed #cbd5e1; color: #64748b; margin-bottom: 20px;">' +
            '<i class="fa-solid fa-layer-group navy-icon" style="font-size: 36px; margin-bottom: 12px; display: block;"></i>' +
            '<div style="font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 6px;">Belum Ada Butir Pertanyaan</div>' +
            '<div style="font-size: 13px; color: #64748b; margin-bottom: 16px;">Klik tombol <b>"Tambah Pertanyaan"</b> atau tombol Tambah Cepat di bawah untuk mulai menyusun kuesioner.</div>' +
            '<button type="button" class="btn btn-sm btn-primary" style="background: var(--ide-navy); border-color: var(--ide-navy); border-radius: 10px; font-weight: 700; padding: 8px 18px;" onclick="addDashBuilderQuestion(\'radio\')">' +
              '<i class="fa-solid fa-plus navy-icon" style="color:#ffffff !important;"></i> Tambah Butir Pertama' +
            '</button>' +
          '</div>'
        );
        return;
      }

      dashBuilderQuestions.forEach(function(q, qIdx) {
        var card = document.createElement('div');
        card.className = 'gform-builder-card';
        card.id = 'dashGformCard_' + qIdx;

        // Type Select Options
        var typeOptionsHtml = 
          '<option value="radio" ' + (q.Tipe === 'radio' ? 'selected' : '') + '>Pilihan Ganda (Bobot Skor Dinamis)</option>' +
          '<option value="checkbox" ' + (q.Tipe === 'checkbox' ? 'selected' : '') + '>Kotak Centang (Multi-Pilihan)</option>' +
          '<option value="dropdown" ' + (q.Tipe === 'dropdown' ? 'selected' : '') + '>Menu Dropdown (Pilihan Tunggal)</option>' +
          '<option value="scale" ' + (q.Tipe === 'scale' ? 'selected' : '') + '>Skala Linear (Rating / Kepuasan)</option>' +
          '<option value="text" ' + (q.Tipe === 'text' ? 'selected' : '') + '>Jawaban Singkat (Text)</option>' +
          '<option value="textarea" ' + (q.Tipe === 'textarea' ? 'selected' : '') + '>Paragraf / Uraian Bebas</option>' +
          '<option value="number" ' + (q.Tipe === 'number' ? 'selected' : '') + '>Angka / Numerik</option>';

        // Options or Scale section depending on type
        var typeSpecificHtml = '';
        if (q.Tipe === 'radio' || q.Tipe === 'checkbox' || q.Tipe === 'dropdown') {
          var optionsRowsHtml = '';
          var iconClass = (q.Tipe === 'radio' ? 'fa-regular fa-circle-dot' : (q.Tipe === 'checkbox' ? 'fa-regular fa-square-check' : 'fa-solid fa-caret-down'));

          if (!q.OpsiPilihan || q.OpsiPilihan.length === 0) {
            q.OpsiPilihan = [
              { label: 'Sangat Baik / Sangat Puas', nilai: 4 },
              { label: 'Baik / Puas', nilai: 3 },
              { label: 'Kurang Baik / Kurang Puas', nilai: 2 },
              { label: 'Tidak Baik / Tidak Puas', nilai: 1 }
            ];
          }

          q.OpsiPilihan.forEach(function(opt, optIdx) {
            optionsRowsHtml += 
              '<div class="gform-option-row">' +
                '<span class="gform-opt-icon"><i class="' + iconClass + ' navy-icon"></i></span>' +
                '<input type="text" class="gform-opt-input" placeholder="Teks Pilihan ' + (optIdx + 1) + '" value="' + (opt.label ? String(opt.label).replace(/"/g, '&quot;') : '') + '" oninput="syncDashBuilderOptionLabel(' + qIdx + ', ' + optIdx + ', this.value)">' +
                '<div class="gform-val-box" title="Bobot nilai skor angka untuk opsi ini">' +
                  '<span class="gform-val-lbl"><i class="fa-solid fa-award navy-icon"></i> Nilai:</span>' +
                  '<input type="number" step="any" class="gform-val-input" value="' + (opt.nilai !== undefined ? opt.nilai : 0) + '" oninput="syncDashBuilderOptionValue(' + qIdx + ', ' + optIdx + ', this.value)">' +
                '</div>' +
                '<button type="button" class="btn-remove-opt" onclick="removeDashBuilderOption(' + qIdx + ', ' + optIdx + ')" title="Hapus Opsi"><i class="fa-solid fa-xmark navy-icon"></i></button>' +
              '</div>';
          });

          typeSpecificHtml = 
            '<div class="gform-options-container" id="dashOptionsContainer_' + qIdx + '">' +
              optionsRowsHtml +
            '</div>' +
            '<div class="gform-opt-actions-bar">' +
              '<button type="button" class="btn-add-opt" onclick="addDashBuilderOption(' + qIdx + ')">' +
                '<i class="fa-solid fa-plus navy-icon"></i> Tambah Pilihan Opsi' +
              '</button>' +
              '<div class="gform-preset-wrap">' +
                '<span class="gform-preset-lbl"><i class="fa-solid fa-sliders navy-icon"></i> Preset Penilaian:</span>' +
                '<button type="button" class="btn-preset" onclick="applyDashBuilderPreset(' + qIdx + ', \'ikm\')"><i class="fa-solid fa-wand-magic-sparkles navy-icon" style="font-size:10px;"></i> IKM (4-3-2-1)</button>' +
                '<button type="button" class="btn-preset" onclick="applyDashBuilderPreset(' + qIdx + ', \'likert\')"><i class="fa-solid fa-wand-magic-sparkles navy-icon" style="font-size:10px;"></i> Likert (5-1)</button>' +
                '<button type="button" class="btn-preset" onclick="applyDashBuilderPreset(' + qIdx + ', \'binary\')"><i class="fa-solid fa-wand-magic-sparkles navy-icon" style="font-size:10px;"></i> Biner (100/0)</button>' +
                '<button type="button" class="btn-preset" onclick="applyDashBuilderPreset(' + qIdx + ', \'kepuasan\')"><i class="fa-solid fa-wand-magic-sparkles navy-icon" style="font-size:10px;"></i> Sangat Puas (4-1)</button>' +
              '</div>' +
            '</div>';

        } else if (q.Tipe === 'scale') {
          typeSpecificHtml = 
            '<div class="gform-scale-settings">' +
              '<div class="gform-scale-group">' +
                '<label><i class="fa-solid fa-arrows-left-right navy-icon"></i> Rentang Skala:</label>' +
                '<select onchange="syncDashBuilderScale(' + qIdx + ', \'min\', this.value)">' +
                  '<option value="1" ' + (q.ScaleMin == 1 ? 'selected' : '') + '>1</option>' +
                  '<option value="0" ' + (q.ScaleMin == 0 ? 'selected' : '') + '>0</option>' +
                '</select>' +
                '<span style="font-size: 13px; font-weight: 700; color: #64748b;">s.d.</span>' +
                '<select onchange="syncDashBuilderScale(' + qIdx + ', \'max\', this.value)">' +
                  '<option value="3" ' + (q.ScaleMax == 3 ? 'selected' : '') + '>3</option>' +
                  '<option value="4" ' + (q.ScaleMax == 4 ? 'selected' : '') + '>4</option>' +
                  '<option value="5" ' + (q.ScaleMax == 5 ? 'selected' : '') + '>5</option>' +
                  '<option value="10" ' + (q.ScaleMax == 10 ? 'selected' : '') + '>10</option>' +
                '</select>' +
              '</div>' +
              '<div class="gform-scale-group">' +
                '<label>Label Terendah:</label>' +
                '<input type="text" placeholder="Contoh: Sangat Buruk / Tidak Puas" value="' + (q.ScaleMinLabel ? String(q.ScaleMinLabel).replace(/"/g, '&quot;') : 'Sangat Tidak Baik') + '" oninput="syncDashBuilderScale(' + qIdx + ', \'minLabel\', this.value)">' +
              '</div>' +
              '<div class="gform-scale-group">' +
                '<label>Label Tertinggi:</label>' +
                '<input type="text" placeholder="Contoh: Sangat Baik / Sangat Puas" value="' + (q.ScaleMaxLabel ? String(q.ScaleMaxLabel).replace(/"/g, '&quot;') : 'Sangat Baik') + '" oninput="syncDashBuilderScale(' + qIdx + ', \'maxLabel\', this.value)">' +
              '</div>' +
            '</div>';
        } else {
          var typeName = (q.Tipe === 'textarea' ? 'Paragraf / Uraian Bebas' : (q.Tipe === 'number' ? 'Angka / Numerik' : 'Teks Singkat'));
          var iconType = (q.Tipe === 'textarea' ? 'fa-align-left' : (q.Tipe === 'number' ? 'fa-calculator' : 'fa-font'));
          typeSpecificHtml = 
            '<div style="background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 12px; padding: 14px 18px; color: #64748b; font-size: 13px; font-style: italic; margin-bottom: 14px;">' +
              '<i class="fa-solid ' + iconType + ' navy-icon" style="margin-right: 6px;"></i> Area isian bebas responden (' + typeName + '). Responden akan mengisi jawaban secara langsung pada form survei.' +
            '</div>';
        }

        card.innerHTML = 
          '<div class="gform-card-top">' +
            '<div style="display: flex; align-items: center; gap: 10px;">' +
              '<span class="gform-q-number"><i class="fa-solid fa-hashtag navy-icon" style="font-size: 11px;"></i> ' + (qIdx + 1) + '</span>' +
              '<span style="font-size: 13.5px; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 0.3px;">Butir Pertanyaan ' + (qIdx + 1) + '</span>' +
            '</div>' +
            '<div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">' +
              '<select class="gform-q-type-select" onchange="changeDashBuilderType(' + qIdx + ', this.value)">' +
                typeOptionsHtml +
              '</select>' +
              '<div class="gform-card-ctrls">' +
                '<button type="button" class="btn-q-ctrl" onclick="moveDashBuilderQuestion(' + qIdx + ', -1)" title="Pindah ke Atas" ' + (qIdx === 0 ? 'disabled style="opacity: 0.35;"' : '') + '><i class="fa-solid fa-arrow-up navy-icon"></i></button>' +
                '<button type="button" class="btn-q-ctrl" onclick="moveDashBuilderQuestion(' + qIdx + ', 1)" title="Pindah ke Bawah" ' + (qIdx === dashBuilderQuestions.length - 1 ? 'disabled style="opacity: 0.35;"' : '') + '><i class="fa-solid fa-arrow-down navy-icon"></i></button>' +
                '<button type="button" class="btn-q-ctrl" onclick="duplicateDashBuilderQuestion(' + qIdx + ')" title="Duplikasi Pertanyaan"><i class="fa-solid fa-copy navy-icon"></i></button>' +
                '<button type="button" class="btn-q-ctrl del" onclick="deleteDashBuilderQuestion(' + qIdx + ')" title="Hapus Pertanyaan"><i class="fa-solid fa-trash-can navy-icon"></i></button>' +
              '</div>' +
            '</div>' +
          '</div>' +
          '<input type="text" class="gform-q-title-input" placeholder="Tuliskan rumusan pertanyaan survei di sini..." value="' + (q.Pertanyaan ? String(q.Pertanyaan).replace(/"/g, '&quot;') : '') + '" oninput="syncDashBuilderTitle(' + qIdx + ', this.value)">' +
          '<input type="text" class="gform-q-desc-input" placeholder="Penjelasan / petunjuk pengisian bagi responden (opsional)..." value="' + (q.Deskripsi ? String(q.Deskripsi).replace(/"/g, '&quot;') : '') + '" oninput="syncDashBuilderDesc(' + qIdx + ', this.value)">' +
          typeSpecificHtml +
          '<div class="gform-card-footer">' +
            '<label class="gform-switch-lbl">' +
              '<span class="gform-switch">' +
                '<input type="checkbox" ' + (q.IsRequired ? 'checked' : '') + ' onchange="syncDashBuilderRequired(' + qIdx + ', this.checked)">' +
                '<span class="gform-slider"></span>' +
              '</span>' +
              '<span>Wajib Diisi (Required)</span>' +
            '</label>' +
            '<div style="font-size: 12px; color: #64748b; font-weight: 600;">' +
              '<i class="fa-solid fa-shield-halved navy-icon"></i> Instrumen validasi terstandar' +
            '</div>' +
          '</div>';

        $container.append(card);
      });
    }

    // Helper Action Functions
    function addDashBuilderQuestion(type, text) {
      type = type || 'radio';
      text = text || '';
      dashBuilderQuestions.push({
        Pertanyaan: text,
        Deskripsi: '',
        Tipe: type,
        IsRequired: 1,
        ScaleMin: 1,
        ScaleMax: 5,
        ScaleMinLabel: 'Sangat Tidak Baik',
        ScaleMaxLabel: 'Sangat Baik',
        OpsiPilihan: (type === 'radio' || type === 'checkbox' || type === 'dropdown') ? [
          { label: 'Sangat Baik / Sangat Puas', nilai: 4 },
          { label: 'Baik / Puas', nilai: 3 },
          { label: 'Kurang Baik / Kurang Puas', nilai: 2 },
          { label: 'Tidak Baik / Tidak Puas', nilai: 1 }
        ] : []
      });
      renderDashBuilderQuestions();
      $('html, body').animate({ scrollTop: $('#dashGformCard_' + (dashBuilderQuestions.length - 1)).offset().top - 90 }, 300);
    }

    // Backward compatibility alias
    function addBuilderQuestionItem(text, type) {
      addDashBuilderQuestion(type || 'radio', text || '');
    }

    function changeDashBuilderType(qIdx, newType) {
      if (dashBuilderQuestions[qIdx]) {
        dashBuilderQuestions[qIdx].Tipe = newType;
        if ((newType === 'radio' || newType === 'checkbox' || newType === 'dropdown') && (!dashBuilderQuestions[qIdx].OpsiPilihan || dashBuilderQuestions[qIdx].OpsiPilihan.length === 0)) {
          dashBuilderQuestions[qIdx].OpsiPilihan = [
            { label: 'Sangat Baik', nilai: 4 },
            { label: 'Baik', nilai: 3 },
            { label: 'Kurang Baik', nilai: 2 },
            { label: 'Tidak Baik', nilai: 1 }
          ];
        }
        renderDashBuilderQuestions();
      }
    }

    function syncDashBuilderTitle(qIdx, val) {
      if (dashBuilderQuestions[qIdx]) dashBuilderQuestions[qIdx].Pertanyaan = val;
    }

    function syncDashBuilderDesc(qIdx, val) {
      if (dashBuilderQuestions[qIdx]) dashBuilderQuestions[qIdx].Deskripsi = val;
    }

    function syncDashBuilderRequired(qIdx, isChecked) {
      if (dashBuilderQuestions[qIdx]) dashBuilderQuestions[qIdx].IsRequired = isChecked ? 1 : 0;
    }

    function syncDashBuilderOptionLabel(qIdx, optIdx, val) {
      if (dashBuilderQuestions[qIdx] && dashBuilderQuestions[qIdx].OpsiPilihan && dashBuilderQuestions[qIdx].OpsiPilihan[optIdx]) {
        dashBuilderQuestions[qIdx].OpsiPilihan[optIdx].label = val;
      }
    }

    function syncDashBuilderOptionValue(qIdx, optIdx, val) {
      if (dashBuilderQuestions[qIdx] && dashBuilderQuestions[qIdx].OpsiPilihan && dashBuilderQuestions[qIdx].OpsiPilihan[optIdx]) {
        dashBuilderQuestions[qIdx].OpsiPilihan[optIdx].nilai = parseFloat(val) || 0;
      }
    }

    function addDashBuilderOption(qIdx) {
      if (dashBuilderQuestions[qIdx]) {
        if (!dashBuilderQuestions[qIdx].OpsiPilihan) dashBuilderQuestions[qIdx].OpsiPilihan = [];
        var nextNum = dashBuilderQuestions[qIdx].OpsiPilihan.length + 1;
        dashBuilderQuestions[qIdx].OpsiPilihan.push({
          label: 'Pilihan ' + nextNum,
          nilai: 1
        });
        renderDashBuilderQuestions();
      }
    }

    function removeDashBuilderOption(qIdx, optIdx) {
      if (dashBuilderQuestions[qIdx] && dashBuilderQuestions[qIdx].OpsiPilihan) {
        dashBuilderQuestions[qIdx].OpsiPilihan.splice(optIdx, 1);
        renderDashBuilderQuestions();
      }
    }

    function applyDashBuilderPreset(qIdx, presetName) {
      if (!dashBuilderQuestions[qIdx]) return;
      if (presetName === 'ikm') {
        dashBuilderQuestions[qIdx].OpsiPilihan = [
          { label: 'Sangat Baik / Sangat Puas', nilai: 4 },
          { label: 'Baik / Puas', nilai: 3 },
          { label: 'Kurang Baik / Kurang Puas', nilai: 2 },
          { label: 'Tidak Baik / Tidak Puas', nilai: 1 }
        ];
      } else if (presetName === 'likert') {
        dashBuilderQuestions[qIdx].OpsiPilihan = [
          { label: 'Sangat Setuju', nilai: 5 },
          { label: 'Setuju', nilai: 4 },
          { label: 'Ragu-ragu / Netral', nilai: 3 },
          { label: 'Tidak Setuju', nilai: 2 },
          { label: 'Sangat Tidak Setuju', nilai: 1 }
        ];
      } else if (presetName === 'binary') {
        dashBuilderQuestions[qIdx].OpsiPilihan = [
          { label: 'Ya / Sesuai', nilai: 100 },
          { label: 'Tidak / Belum Sesuai', nilai: 0 }
        ];
      } else if (presetName === 'kepuasan') {
        dashBuilderQuestions[qIdx].OpsiPilihan = [
          { label: 'Sangat Puas', nilai: 4 },
          { label: 'Puas', nilai: 3 },
          { label: 'Kurang Puas', nilai: 2 },
          { label: 'Tidak Puas', nilai: 1 }
        ];
      }
      renderDashBuilderQuestions();
    }

    function syncDashBuilderScale(qIdx, key, val) {
      if (!dashBuilderQuestions[qIdx]) return;
      if (key === 'min') dashBuilderQuestions[qIdx].ScaleMin = parseInt(val) || 1;
      if (key === 'max') dashBuilderQuestions[qIdx].ScaleMax = parseInt(val) || 5;
      if (key === 'minLabel') dashBuilderQuestions[qIdx].ScaleMinLabel = val;
      if (key === 'maxLabel') dashBuilderQuestions[qIdx].ScaleMaxLabel = val;
    }

    function moveDashBuilderQuestion(qIdx, direction) {
      var targetIdx = qIdx + direction;
      if (targetIdx < 0 || targetIdx >= dashBuilderQuestions.length) return;
      var temp = dashBuilderQuestions[qIdx];
      dashBuilderQuestions[qIdx] = dashBuilderQuestions[targetIdx];
      dashBuilderQuestions[targetIdx] = temp;
      renderDashBuilderQuestions();
    }

    function duplicateDashBuilderQuestion(qIdx) {
      var cloned = JSON.parse(JSON.stringify(dashBuilderQuestions[qIdx]));
      cloned.Pertanyaan = (cloned.Pertanyaan || '') + ' (Salinan)';
      dashBuilderQuestions.splice(qIdx + 1, 0, cloned);
      renderDashBuilderQuestions();
    }

    function deleteDashBuilderQuestion(qIdx) {
      dashBuilderQuestions.splice(qIdx, 1);
      renderDashBuilderQuestions();
    }

    // Preset 9 Unsur Standar IKM (Kepmenpan RB)
    function applyDefaultIKMQuestionsPreset() {
      dashBuilderQuestions = [
        {
          Pertanyaan: 'Bagaimana kesesuaian persyaratan pelayanan dengan jenis pelayanannya?',
          Deskripsi: 'Unsur 1: Persyaratan teknis dan administratif yang diperlukan untuk mendapatkan pelayanan.',
          Tipe: 'radio',
          IsRequired: 1,
          OpsiPilihan: [
            { label: 'Sangat Sesuai', nilai: 4 },
            { label: 'Sesuai', nilai: 3 },
            { label: 'Kurang Sesuai', nilai: 2 },
            { label: 'Tidak Sesuai', nilai: 1 }
          ]
        },
        {
          Pertanyaan: 'Bagaimana kemudahan prosedur pelayanan di unit layanan ini?',
          Deskripsi: 'Unsur 2: Kemudahan tahapan pelayanan yang diberikan kepada masyarakat.',
          Tipe: 'radio',
          IsRequired: 1,
          OpsiPilihan: [
            { label: 'Sangat Mudah', nilai: 4 },
            { label: 'Mudah', nilai: 3 },
            { label: 'Kurang Mudah', nilai: 2 },
            { label: 'Tidak Mudah', nilai: 1 }
          ]
        },
        {
          Pertanyaan: 'Bagaimana kecepatan waktu respon dan penyelesaian pelayanan oleh petugas?',
          Deskripsi: 'Unsur 3: Jangka waktu yang diperlukan untuk menyelesaikan seluruh proses pelayanan.',
          Tipe: 'radio',
          IsRequired: 1,
          OpsiPilihan: [
            { label: 'Sangat Cepat', nilai: 4 },
            { label: 'Cepat', nilai: 3 },
            { label: 'Kurang Cepat', nilai: 2 },
            { label: 'Tidak Cepat', nilai: 1 }
          ]
        },
        {
          Pertanyaan: 'Bagaimana kewajaran biaya / tarif dalam mendapatkan pelayanan?',
          Deskripsi: 'Unsur 4: Kesesuaian biaya yang dibayarkan dengan ketentuan yang telah ditetapkan (atau gratis).',
          Tipe: 'radio',
          IsRequired: 1,
          OpsiPilihan: [
            { label: 'Gratis / Sangat Wajar', nilai: 4 },
            { label: 'Wajar', nilai: 3 },
            { label: 'Kurang Wajar', nilai: 2 },
            { label: 'Sangat Mahal / Tidak Wajar', nilai: 1 }
          ]
        },
        {
          Pertanyaan: 'Bagaimana kesesuaian produk pelayanan antara yang tercantum dalam standar dengan hasil yang diberikan?',
          Deskripsi: 'Unsur 5: Hasil pelayanan yang diterima sesuai dengan ketentuan yang telah ditetapkan.',
          Tipe: 'radio',
          IsRequired: 1,
          OpsiPilihan: [
            { label: 'Sangat Sesuai', nilai: 4 },
            { label: 'Sesuai', nilai: 3 },
            { label: 'Kurang Sesuai', nilai: 2 },
            { label: 'Tidak Sesuai', nilai: 1 }
          ]
        },
        {
          Pertanyaan: 'Bagaimana kompetensi, kecakapan, dan keahlian petugas dalam memberikan pelayanan?',
          Deskripsi: 'Unsur 6: Kemampuan dan keterampilan petugas dalam melayani kebutuhan pemohon.',
          Tipe: 'radio',
          IsRequired: 1,
          OpsiPilihan: [
            { label: 'Sangat Kompeten', nilai: 4 },
            { label: 'Kompeten', nilai: 3 },
            { label: 'Kurang Kompeten', nilai: 2 },
            { label: 'Tidak Kompeten', nilai: 1 }
          ]
        },
        {
          Pertanyaan: 'Bagaimana perilaku petugas terkait kesopanan dan keramahan saat memberikan pelayanan?',
          Deskripsi: 'Unsur 7: Sikap dan etika petugas dalam melayani responden/masyarakat.',
          Tipe: 'radio',
          IsRequired: 1,
          OpsiPilihan: [
            { label: 'Sangat Sopan & Ramah', nilai: 4 },
            { label: 'Sopan & Ramah', nilai: 3 },
            { label: 'Kurang Sopan & Ramah', nilai: 2 },
            { label: 'Tidak Sopan & Ramah', nilai: 1 }
          ]
        },
        {
          Pertanyaan: 'Bagaimana kualitas sarana dan prasarana pendukung pelayanan?',
          Deskripsi: 'Unsur 8: Kenyamanan ruang tunggu, fasilitas, kebersihan, dan teknologi pendukung.',
          Tipe: 'radio',
          IsRequired: 1,
          OpsiPilihan: [
            { label: 'Sangat Baik & Nyaman', nilai: 4 },
            { label: 'Baik', nilai: 3 },
            { label: 'Kurang Baik', nilai: 2 },
            { label: 'Buruk / Rusak', nilai: 1 }
          ]
        },
        {
          Pertanyaan: 'Bagaimana penanganan pengaduan, saran, dan masukan pengguna layanan?',
          Deskripsi: 'Unsur 9: Responsivitas unit layanan dalam menerima dan menindaklanjuti keluhan masyarakat.',
          Tipe: 'radio',
          IsRequired: 1,
          OpsiPilihan: [
            { label: 'Dikelola Sangat Baik', nilai: 4 },
            { label: 'Dikelola Baik', nilai: 3 },
            { label: 'Kurang Ditanggapi', nilai: 2 },
            { label: 'Tidak Ditanggapi', nilai: 1 }
          ]
        },
        {
          Pertanyaan: 'Berikan kritik, saran, atau masukan membangun untuk peningkatan kualitas pelayanan ke depan:',
          Deskripsi: 'Isian terbuka responden untuk evaluasi kualitatif dan inovasi layanan.',
          Tipe: 'textarea',
          IsRequired: 0
        }
      ];
      renderDashBuilderQuestions();
      Swal.fire({
        icon: 'success',
        title: 'Preset Standar IKM Dimuat',
        text: '9 Unsur Standar Kepmenpan RB dan 1 butir saran telah dimuat ke dalam studio.',
        timer: 1800,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
      });
    }

    function saveNewSurveyData() {
      var judul = $.trim($('#builderJudul').val());
      var lembaga = $.trim($('#builderLembaga').val());
      if (!judul || !lembaga) {
        Swal.fire('Perhatian', 'Mohon lengkapi Judul dan Lembaga pelaksana survei.', 'warning');
        return;
      }

      if (dashBuilderQuestions.length === 0) {
        Swal.fire('Perhatian', 'Tambahkan minimal 1 butir pertanyaan survei.', 'warning');
        return;
      }

      var editId = $('#builderSurveyId').val();
      var payload = {
        Judul: judul,
        Lembaga: lembaga,
        Jenis: $('#builderJenis').val(),
        Tahun: $('#builderTahun').val(),
        DaerahSurvei: $('#builderDaerah').val(),
        Deskripsi: $('#builderDeskripsi').val(),
        questions: JSON.stringify(dashBuilderQuestions)
      };
      if (editId && parseInt(editId) > 0) {
        payload.Id = parseInt(editId);
      }

      Swal.fire({
        title: 'Menyimpan Survei Baru...',
        html: 'Menyimpan konfigurasi instrumen dan ' + dashBuilderQuestions.length + ' butir pertanyaan dinamis...',
        allowOutsideClick: false,
        didOpen: function() { Swal.showLoading(); }
      });

      var targetSaveUrl = (payload.Id && payload.Id > 0) ? (BaseURL + 'IDE/save_survei_dinamis') : (BaseURL + 'IDE/save_survei_builder');
      $.post(targetSaveUrl, payload).done(function(res) {
        Swal.close();
        try {
          var data = typeof res === 'object' ? res : JSON.parse(res);
          if (data && data.status) {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil Dipublikasikan!',
              text: 'Instrumen survei baru beserta seluruh model pertanyaan dan penilaian jawaban telah aktif.',
              confirmButtonColor: '#043168'
            }).then(function() {
              window.location.reload();
            });
          } else {
            Swal.fire('Gagal Menyimpan', data.message || 'Gagal menyimpan instrumen survei.', 'error');
          }
        } catch(e) {
          window.location.reload();
        }
      }).fail(function() {
        Swal.fire('Error', 'Gagal menghubungi server.', 'error');
      });
    }

    // Document Ready
    $(document).ready(function() {
      // Sidebar Mobile & Desktop Toggle Handlers (Selaras Dashboard Utama)
      function isMobileScreen() {
        return $(window).width() < 992;
      }

      $(document).on('click', '#menu_toggle', function(e) {
        if (isMobileScreen()) {
          e.preventDefault();
          e.stopPropagation();
          $('body').toggleClass('mobile-nav-open');
        }
      });

      $(document).on('click', '#sidebarMobileBackdrop, #btnSidebarClose', function(e) {
        e.preventDefault();
        $('body').removeClass('mobile-nav-open');
      });

      $(document).on('click', '#sidebar-menu a:not([href^="#"]):not([data-toggle])', function() {
        if (isMobileScreen()) {
          $('body').removeClass('mobile-nav-open');
        }
      });

      $(window).on('resize', function() {
        if (!isMobileScreen()) {
          $('body').removeClass('mobile-nav-open');
        }
      });

      updateSurveyMetricStrip();
      if (typeof currentSurveyId !== 'undefined' && currentSurveyId) {
        loadSurveyQuestionsForForm(currentSurveyId);
        loadDashboardRekapData(currentSurveyId);
      }

      // Initialize Studio Builder with default questions
      if (dashBuilderQuestions.length === 0) {
        dashBuilderQuestions = [
          {
            Pertanyaan: 'Bagaimana kemudahan prosedur layanan yang Anda terima di unit ini?',
            Deskripsi: 'Kemudahan tahapan pelayanan mulai dari pendaftaran hingga penyelesaian.',
            Tipe: 'radio',
            IsRequired: 1,
            OpsiPilihan: [
              { label: 'Sangat Mudah', nilai: 4 },
              { label: 'Mudah', nilai: 3 },
              { label: 'Kurang Mudah', nilai: 2 },
              { label: 'Tidak Mudah', nilai: 1 }
            ]
          },
          {
            Pertanyaan: 'Bagaimana tingkat kepuasan Anda terhadap kecepatan respon petugas dalam melayani?',
            Deskripsi: 'Skala rating kepuasan pelayanan dari 1 s.d. 5.',
            Tipe: 'scale',
            IsRequired: 1,
            ScaleMin: 1,
            ScaleMax: 5,
            ScaleMinLabel: 'Sangat Tidak Puas',
            ScaleMaxLabel: 'Sangat Puas'
          },
          {
            Pertanyaan: 'Fasilitas sarana apa saja yang menurut Anda perlu ditingkatkan?',
            Deskripsi: 'Pilih semua fasilitas yang relevan.',
            Tipe: 'checkbox',
            IsRequired: 0,
            OpsiPilihan: [
              { label: 'Ruang Tunggu Ber-AC & Nyaman', nilai: 1 },
              { label: 'Akses Antrean Digital / Online', nilai: 1 },
              { label: 'Fasilitas Ramah Disabilitas & Lansia', nilai: 1 },
              { label: 'Kebersihan Toilet & Area Publik', nilai: 1 }
            ]
          },
          {
            Pertanyaan: 'Berikan kritik, saran, atau masukan untuk peningkatan kualitas layanan:',
            Deskripsi: 'Uraian bebas pengalaman Anda saat mendapatkan pelayanan.',
            Tipe: 'textarea',
            IsRequired: 0
          }
        ];
        renderDashBuilderQuestions();
      }

      // Initialize Google Mini Map
      setTimeout(function() {
        initDashMiniMap();
      }, 500);
    });
  </script>
</body>
</html>
