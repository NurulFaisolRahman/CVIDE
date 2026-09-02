<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enterprise Portal Admin - IDE Consultant</title>
    
    <!-- Favicon & Fonts -->
    <link href="<?=base_url('assets/img/favicon.ico')?>" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Core CSS & Icons -->
    <link href="<?=base_url('vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('vendors/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="<?=base_url('build/css/custom.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/datatables-bs4/css/dataTables.bootstrap4.css')?>" rel="stylesheet">

    <!-- Enterprise IDE Theme System (Lugx & Modern Corporate Palette) -->
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
      }

      body.nav-md {
        font-family: 'Poppins', sans-serif;
        background-color: var(--ide-bg);
        color: #334155;
      }

      /* Sidebar Left Column Styling */
      .col-md-3.left_col,
      .left_col {
        background: linear-gradient(180deg, var(--ide-navy) 0%, var(--ide-navy-dark) 100%) !important;
        box-shadow: 4px 0 25px rgba(0, 0, 0, 0.15);
      }

      /* Sidebar Brand Header */
      .sidebar-brand-header {
        padding: 25px 20px 20px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      .sidebar-brand-header img {
        height: 42px;
        width: auto;
        object-fit: contain;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
      }

      .sidebar-brand-text {
        font-size: 15px;
        font-weight: 800;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.2;
      }

      .sidebar-brand-text span {
        color: var(--ide-red-coral);
      }

      /* Sidebar Profile Quick Info */
      .profile.clearfix {
        padding: 20px;
        background: rgba(255, 255, 255, 0.05);
        margin: 15px 15px 20px 15px;
        border-radius: var(--ide-radius);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
      }

      .profile_pic img.profile_img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 2px solid var(--ide-red-coral);
        box-shadow: 0 4px 12px rgba(180, 8, 20, 0.4);
      }

      .profile_info {
        padding-left: 12px;
      }

      .profile_info span {
        color: rgba(255, 255, 255, 0.7);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .profile_info h2 {
        color: #ffffff;
        font-size: 15px;
        font-weight: 700;
        margin-top: 2px;
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

      /* Top Navbar */
      .top_nav {
        margin-left: 230px;
      }

      .top_nav .nav_menu {
        background: linear-gradient(135deg, var(--ide-navy) 0%, var(--ide-navy-light) 100%) !important;
        border-bottom: none;
        padding: 0 25px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 20px rgba(4, 49, 104, 0.15);
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

      .top-page-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 16px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: inline-flex;
        align-items: center;
        gap: 8px;
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
      .right_col {
        background-color: var(--ide-bg) !important;
        padding: 30px !important;
        min-height: calc(100vh - 70px) !important;
      }

      /* DataTables Wrapper Custom Styling */
      .dataTables_wrapper .dataTables_length select,
      .dataTables_wrapper .dataTables_filter input {
        border-radius: 20px;
        border: 2px solid var(--ide-border);
        padding: 5px 15px;
        outline: none;
      }

      .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--ide-navy);
      }

      .page-item.active .page-link {
        background-color: var(--ide-navy);
        border-color: var(--ide-navy);
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        <!-- Sidebar Navigation -->
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
            <!-- Sidebar Brand Header -->
            <div class="sidebar-brand-header">
              <a href="<?=base_url('Admin')?>">
                <img src="<?=base_url('assets/img/LOGO IDE.webp')?>" alt="IDE Logo">
              </a>
              <div class="sidebar-brand-text">
                Inti Desain Ekonomi <span>Consultant</span>
              </div>
            </div>

            <!-- Profile Quick Info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?=base_url('assets/img/Profil.jpg')?>" alt="Admin Profile" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Administrator</span>
                <h2><?=$this->session->userdata('Username') ? $this->session->userdata('Username') : 'Admin IDE'?></h2>
              </div>
            </div>

            <!-- Sidebar Menu Items -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
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

                <div class="sidebar-menu-title">Sistem</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('IDE/SignOut')?>"><i class="fa-solid fa-right-from-bracket"></i> <b>Keluar (Sign Out)</b> </a></li>
                </ul>
              </div>
            </div>

          </div>
        </div>

        <!-- Top Navigation Bar -->
        <div class="top_nav">
          <div class="nav_menu">
            <div class="top-nav-left">
              <a id="menu_toggle" title="Toggle Sidebar"><i class="fa-solid fa-bars"></i></a>
              <span class="top-page-badge"><i class="fa-solid fa-building-columns"></i> Enterprise Admin Portal</span>
            </div>

            <div class="top-nav-right">
              <div class="admin-top-greeting" id="topAdminGreeting">
                <i class="fa-solid fa-circle-user" style="color: var(--ide-red-coral); font-size: 16px;"></i>
                <span>Halo, <strong><?=$this->session->userdata('Username') ? $this->session->userdata('Username') : 'Admin'?></strong></span>
              </div>
              <a href="<?=base_url('IDE/SignOut')?>" class="btn-header-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
              </a>
            </div>
          </div>
        </div>

        <!-- Page Main Content Area -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>