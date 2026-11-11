<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

$userLevel = (int)$this->session->userdata('level');
if (empty($userLevel)) {
    if (!empty($this->session->userdata('SuperAdmin'))) $userLevel = 1;
    elseif (!empty($this->session->userdata('Admin'))) $userLevel = 2;
    elseif (!empty($this->session->userdata('Staf'))) $userLevel = 3;
    elseif (!empty($this->session->userdata('Surveyor')) || !empty($this->session->userdata('Surveiyor'))) $userLevel = 4;
}
$userName = $this->session->userdata('nama_lengkap') 
         ?: ($this->session->userdata('Nama') 
         ?: ($this->session->userdata('Username') 
         ?: ($userLevel == 5 ? 'Petugas Survei' : ($userLevel == 4 ? 'Surveiyor' : ($userLevel == 3 ? 'Staf' : ($userLevel == 1 ? 'SuperAdmin' : 'Admin'))))));

$currentUri = uri_string();
$isProfilActive = (stripos($currentUri, 'Surveyor') !== false && stripos($currentUri, 'Survei') === false && stripos($currentUri, 'PKPM') === false && stripos($currentUri, 'BankPenyalur') === false && stripos($currentUri, 'PendampingBPNT') === false && stripos($currentUri, 'EWarung') === false && stripos($currentUri, 'DesaBBM') === false && stripos($currentUri, 'DampakBBM') === false);
$isLayananSurveiActive = (stripos($currentUri, 'MenuSurvei') !== false);
$isSurveiDesaActive = (stripos($currentUri, 'SurveiBPD') !== false || stripos($currentUri, 'SurveiKinerjaPemDes') !== false || stripos($currentUri, 'SurveiKinerjaAparatur') !== false || stripos($currentUri, 'SurveiIPM') !== false);
$isSurveiNTPActive = (stripos($currentUri, 'SurveiHargaKonsumenPerdesaan') !== false || stripos($currentUri, 'SurveiHargaProdusenPerdesaan') !== false);
$isSurveiBPNTActive = (stripos($currentUri, 'PKPM') !== false || stripos($currentUri, 'BankPenyalur') !== false || stripos($currentUri, 'PendampingBPNT') !== false || stripos($currentUri, 'EWarung') !== false);
$isSurveiBBMActive = (stripos($currentUri, 'DesaBBM') !== false || stripos($currentUri, 'DampakBBM') !== false);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>IDE Consultant - Portal Survei</title>
		<link href="<?=base_url('assets/img/favicon.ico')?>" rel="icon">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS Vendor Frameworks -->
    <link href="<?=base_url('vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('vendors/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="<?=base_url('build/css/custom.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/datatables-bs4/css/dataTables.bootstrap4.css')?>" rel="stylesheet">

    <style>
      :root {
        --ide-navy: #043168;
        --ide-navy-dark: #021c3b;
        --ide-navy-light: #0b3977;
        --ide-red: #b40814;
        --ide-red-coral: #ee626b;
        --ide-gold: #f59e0b;
        --ide-bg: #f4f6f9;
        --ide-card-bg: #ffffff;
        --ide-text-dark: #1e293b;
        --ide-text-muted: #64748b;
        --ide-border: #e2e8f0;
      }

      body {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
        background: var(--ide-bg) !important;
        color: var(--ide-text-dark);
        overflow-x: hidden;
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

      /* Sidebar Left Column (Navy Gradient) - Sepanjang Isi, Tidak Terputus */
      .col-md-3.left_col,
      .left_col {
        background: linear-gradient(180deg, var(--ide-navy) 0%, var(--ide-navy-dark) 100%) !important;
        box-shadow: 4px 0 25px rgba(0, 0, 0, 0.15);
        position: absolute !important;
        top: 0 !important;
        bottom: auto !important;
        left: 0 !important;
        min-height: 100% !important;
        height: auto !important;
        z-index: 100 !important;
      }

      .left_col.scroll-view {
        width: 100% !important;
        min-height: 100% !important;
        height: auto !important;
        overflow: visible !important;
        padding-bottom: 80px !important;
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
        cursor: pointer;
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
      .nav.child_menu li.current-page a,
      .nav.child_menu li.active a {
        color: var(--ide-red-coral) !important;
        background: rgba(255, 255, 255, 0.05);
        font-weight: 700;
      }

      /* Top Navbar */
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
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

      .admin-top-greeting i {
        color: #ffffff !important;
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
        color: #ffffff !important;
      }

      /* Main Right Content Area */
      .main_container .right_col,
      .right_col {
        background-color: var(--ide-bg) !important;
        padding: 24px 28px 45px 28px !important;
        min-height: calc(100vh - 70px);
        margin-left: 230px !important;
        clear: both !important;
        position: relative !important;
      }

      /* Collapsed State Smooth Adjustments */
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
      }

      /* DataTables Styling */
      .dataTables_wrapper .dataTables_info {
        float: left;
        padding-top: 14px;
        font-size: 13px;
        font-weight: 500;
        color: #64748b;
      }

      .dataTables_wrapper .dataTables_paginate {
        float: right;
        padding: 4px !important;
        margin-top: 8px !important;
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 2px !important;
      }

      .dataTables_wrapper .dataTables_paginate .paginate_button {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 32px !important;
        height: 32px !important;
        padding: 0 10px !important;
        margin: 0 !important;
        border-radius: 8px !important;
        border: none !important;
        background: transparent !important;
        color: #475569 !important;
        font-size: 12.5px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: none !important;
        cursor: pointer !important;
        line-height: 1 !important;
      }

      .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: rgba(4, 49, 104, 0.08) !important;
        color: #043168 !important;
        border: none !important;
        box-shadow: none !important;
        transform: translateY(-1px) !important;
      }

      .dataTables_wrapper .dataTables_paginate .paginate_button.current,
      .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
      .page-item.active .page-link {
        background: linear-gradient(135deg, #043168 0%, #0b3977 100%) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 12px rgba(4, 49, 104, 0.3) !important;
        font-weight: 700 !important;
        transform: scale(1.02) !important;
      }

      .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
      .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        opacity: 0.35 !important;
        background: transparent !important;
        color: #94a3b8 !important;
        border: none !important;
        box-shadow: none !important;
        transform: none !important;
        cursor: not-allowed !important;
      }

      /* Unified Bootstrap Pagination */
      .pagination {
        display: inline-flex !important;
        align-items: center !important;
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        padding: 4px !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
        gap: 2px !important;
        list-style: none !important;
        margin: 0 !important;
      }

      .pagination .page-item {
        margin: 0 !important;
      }

      .pagination .page-item .page-link {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 32px !important;
        height: 32px !important;
        padding: 0 10px !important;
        border-radius: 8px !important;
        border: none !important;
        background: transparent !important;
        color: #475569 !important;
        font-size: 12.5px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        line-height: 1 !important;
      }

      .pagination .page-item:not(.disabled):not(.active) .page-link:hover {
        background: rgba(4, 49, 104, 0.08) !important;
        color: #043168 !important;
        transform: translateY(-1px) !important;
      }

      .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #043168 0%, #0b3977 100%) !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 12px rgba(4, 49, 104, 0.3) !important;
      }

      .pagination .page-item.disabled .page-link {
        opacity: 0.35 !important;
        background: transparent !important;
        color: #94a3b8 !important;
        cursor: not-allowed !important;
      }

      .dataTables_wrapper .dataTables_paginate .ellipsis,
      .dataTables_wrapper .dataTables_paginate span.ellipsis,
      .dataTables_wrapper .dataTables_paginate .paginate_button.disabled.ellipsis,
      .pagination .page-item.disabled span.page-link,
      .pagination .page-item.disabled:not(:first-child):not(:last-child) .page-link {
        opacity: 1 !important;
        color: #1e293b !important;
        font-weight: 700 !important;
        background: transparent !important;
        cursor: default !important;
        box-shadow: none !important;
        transform: none !important;
        letter-spacing: 1px !important;
      }

      .dataTables_wrapper .dataTables_paginate ul.pagination,
      .dataTables_wrapper .dataTables_paginate .pagination {
        background: transparent !important;
        border: none !important;
        border-radius: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
        box-shadow: none !important;
      }

      .dataTables_wrapper .dataTables_paginate .page-link,
      .dataTables_wrapper .dataTables_paginate .page-item,
      .pagination .page-link {
        border: none !important;
        outline: none !important;
      }

      /* =========================================================================
         SURVEI DESA & FORM KUESIONER ENTERPRISE THEME (MODERN CONCEPT)
         ========================================================================= */
      .dash-survey-header {
        background: linear-gradient(135deg, var(--ide-navy) 0%, var(--ide-navy-light) 100%);
        border-radius: 16px;
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
        color: #ffffff;
        display: flex;
        align-items: center;
        gap: 12px;
      }

      .dash-header-title i {
        color: var(--ide-red-coral);
      }

      .dash-header-subtitle {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.85);
        margin: 0;
        line-height: 1.5;
      }

      /* Card Container Standardisasi */
      .card {
        border-radius: 14px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05) !important;
        background: #ffffff !important;
        overflow: hidden !important;
        margin-bottom: 22px !important;
      }

      .card-header {
        background: linear-gradient(135deg, var(--ide-navy) 0%, var(--ide-navy-light) 100%) !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 14px !important;
        padding: 14px 20px !important;
        border-bottom: none !important;
        letter-spacing: 0.3px !important;
      }

      .card-header b {
        font-weight: 700 !important;
      }

      /* Hilangkan warna kuning legacy dan ganti dengan putih bersih */
      div[style*="background-color: yellow"],
      div[style*="background-color:yellow"],
      .card-body[style*="yellow"] {
        background-color: #ffffff !important;
        padding: 22px 24px !important;
      }

      .border-primary {
        border-color: #e2e8f0 !important;
      }

      /* Form controls & filter labels */
      .custom-select,
      .form-control {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        font-size: 13px !important;
        color: var(--ide-text-dark) !important;
        transition: all 0.2s ease !important;
      }

      .custom-select:focus,
      .form-control:focus {
        border-color: var(--ide-navy) !important;
        box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.15) !important;
      }

      /* Seamless input group connection */
      .input-group > .form-control:not(:last-child),
      .input-group > .custom-select:not(:last-child) {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
      }

      .input-group > .form-control:not(:first-child),
      .input-group > .custom-select:not(:first-child) {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
      }

      .input-group-prepend .input-group-text {
        border-radius: 8px 0 0 8px !important;
        border: 1px solid #cbd5e1 !important;
        font-size: 12.5px !important;
      }

      .input-group-append .input-group-text {
        border-radius: 0 8px 8px 0 !important;
        border: 1px solid #cbd5e1 !important;
        font-size: 12.5px !important;
      }

      .input-group-text.bg-danger {
        background: #f1f5f9 !important;
        color: var(--ide-navy) !important;
        border: 1px solid #cbd5e1 !important;
        font-weight: 700 !important;
        font-size: 12.5px !important;
      }

      /* =========================================================================
         QUESTION BOX (PERTANYAAN MENYATU DENGAN JAWABAN)
         ========================================================================= */
      .question-box {
        background: #ffffff !important;
        border: 1.5px solid #e2e8f0 !important;
        border-left: 5px solid var(--ide-navy) !important;
        border-radius: 14px !important;
        padding: 20px 24px !important;
        margin-bottom: 16px !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03) !important;
        transition: all 0.25s ease !important;
        width: 100% !important;
      }

      .question-box:hover {
        border-color: #cbd5e1 !important;
        border-left-color: var(--ide-navy-light) !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06) !important;
      }

      .question-box.is-answered {
        border-left-color: #10b981 !important;
        background: #fcfdfd !important;
      }

      .q-number-pill {
        font-size: 11.5px !important;
        font-weight: 800 !important;
        background: rgba(4, 49, 104, 0.08) !important;
        color: var(--ide-navy) !important;
        padding: 4px 12px !important;
        border-radius: 6px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        display: inline-block !important;
        margin-bottom: 10px !important;
      }

      .question-box.is-answered .q-number-pill {
        background: rgba(16, 185, 129, 0.12) !important;
        color: #047857 !important;
      }

      .q-text {
        font-size: 15px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        line-height: 1.55 !important;
        margin-bottom: 16px !important;
      }

      .q-answers-container {
        margin-top: 12px !important;
      }

      /* Radio Options Grid (Responsif 1-4 Kolom Menyesuaikan Layar) */
      .q-radio-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)) !important;
        gap: 12px !important;
      }

      .q-radio-card {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        background: #f8fafc !important;
        border: 1.5px solid #e2e8f0 !important;
        border-radius: 10px !important;
        padding: 12px 16px !important;
        cursor: pointer !important;
        margin: 0 !important;
        transition: all 0.2s ease !important;
        user-select: none !important;
      }

      .q-radio-card:hover {
        background: rgba(4, 49, 104, 0.04) !important;
        border-color: rgba(4, 49, 104, 0.3) !important;
        transform: translateY(-1px) !important;
      }

      .q-radio-card.selected,
      .q-radio-card:has(input:checked) {
        background: #f0f7ff !important;
        border-color: var(--ide-navy) !important;
        box-shadow: 0 2px 8px rgba(4, 49, 104, 0.12) !important;
      }

      .q-radio-input {
        width: 18px !important;
        height: 18px !important;
        margin: 0 !important;
        cursor: pointer !important;
        accent-color: var(--ide-navy) !important;
        flex-shrink: 0 !important;
      }

      .q-radio-label {
        font-size: 13.5px !important;
        font-weight: 600 !important;
        color: #334155 !important;
        cursor: pointer !important;
        line-height: 1.4 !important;
        margin: 0 !important;
      }

      .q-radio-card.selected .q-radio-label,
      .q-radio-card:has(input:checked) .q-radio-label {
        color: var(--ide-navy) !important;
        font-weight: 700 !important;
      }

      /* Numeric Inputs Grid */
      .q-inputs-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
        gap: 14px !important;
      }

      .q-input-item {
        background: #f8fafc !important;
        border: 1.5px solid #e2e8f0 !important;
        border-radius: 10px !important;
        padding: 12px 16px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 6px !important;
      }

      .q-input-item label {
        font-size: 12px !important;
        font-weight: 700 !important;
        color: #475569 !important;
        margin-bottom: 2px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.3px !important;
      }

      .q-input-item .form-control {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        height: 38px !important;
        background: #ffffff !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        color: var(--ide-navy) !important;
      }

      /* Fallback Opsi Jawaban Legacy */
      .col-sm-7.bg-primary,
      .col-sm-6.bg-primary {
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 10px !important;
        padding: 12px 18px !important;
        color: var(--ide-text-dark) !important;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.02) !important;
      }

      .col-sm-7.bg-primary .form-check-label,
      .col-sm-6.bg-primary .form-check-label {
        color: #334155 !important;
        font-weight: 600 !important;
        font-size: 13px !important;
        cursor: pointer;
      }

      .col-sm-5.my-1 .input-group-text,
      .col-sm-6.my-1 .input-group-text {
        border-radius: 10px !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        color: var(--ide-navy) !important;
        font-size: 13px !important;
        line-height: 1.5 !important;
        padding: 12px 16px !important;
        width: 100% !important;
        text-align: left !important;
      }

      /* Tabel Kuesioner (Aparatur & IPM) */
      thead.bg-danger,
      .table thead.bg-danger {
        background: linear-gradient(135deg, var(--ide-navy) 0%, var(--ide-navy-dark) 100%) !important;
      }

      thead.bg-danger tr th,
      .table thead.bg-danger tr th {
        background: transparent !important;
        color: #ffffff !important;
        border-color: rgba(255, 255, 255, 0.15) !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        padding: 10px 8px !important;
      }

      tbody.bg-primary,
      .table tbody.bg-primary {
        background-color: #ffffff !important;
      }

      tbody.bg-primary tr,
      .table tbody.bg-primary tr {
        background-color: #ffffff !important;
        color: var(--ide-text-dark) !important;
        transition: background-color 0.2s ease !important;
      }

      tbody.bg-primary tr:hover,
      .table tbody.bg-primary tr:hover {
        background-color: #f1f5f9 !important;
      }

      tbody.bg-primary tr td,
      tbody.bg-primary tr th,
      .table tbody.bg-primary tr td,
      .table tbody.bg-primary tr th {
        background-color: transparent !important;
        color: var(--ide-text-dark) !important;
        border-color: #e2e8f0 !important;
        vertical-align: middle !important;
      }

      tbody.bg-primary .form-check-label {
        color: #1e293b !important;
      }

      /* Badge Posisi / Jabatan pada Survei Kinerja Aparatur */
      .btn.btn-sm.btn-primary.text-white.font-weight-bold {
        background: linear-gradient(135deg, var(--ide-navy) 0%, var(--ide-navy-light) 100%) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 8px 16px !important;
        font-size: 13px !important;
        letter-spacing: 0.5px !important;
        text-transform: uppercase !important;
        box-shadow: 0 4px 10px rgba(4, 49, 104, 0.2) !important;
        margin-top: 15px !important;
        margin-bottom: 10px !important;
      }

      /* Tombol Simpan Kuesioner */
      .btn-primary#Simpan,
      #Simpan.btn-primary {
        background: linear-gradient(135deg, var(--ide-navy) 0%, var(--ide-navy-dark) 100%) !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 12px 36px !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 16px rgba(4, 49, 104, 0.3) !important;
        transition: all 0.3s ease !important;
      }

      .btn-primary#Simpan:hover,
      #Simpan.btn-primary:hover {
        background: linear-gradient(135deg, #021c3b 0%, #043168 100%) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(4, 49, 104, 0.45) !important;
      }

      /* Mobile Responsive Overrides */
      @media (max-width: 991.98px) {
        .main_container .top_nav,
        .top_nav,
        body.nav-sm .top_nav {
          margin-left: 0 !important;
          width: 100% !important;
        }

        .main_container .right_col,
        .right_col,
        body.nav-sm .right_col {
          margin-left: 0 !important;
          width: 100% !important;
          padding: 15px 12px 30px 12px !important;
        }

        .col-md-3.left_col,
        .left_col,
        body.nav-sm .col-md-3.left_col,
        body.nav-sm .left_col {
          position: fixed !important;
          top: 0 !important;
          bottom: 0 !important;
          left: 0 !important;
          width: 260px !important;
          max-width: 85vw !important;
          height: 100vh !important;
          z-index: 1060 !important;
          transform: translateX(-105%) !important;
          transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
          overflow-y: auto !important;
          display: block !important;
        }

        body.mobile-nav-open .col-md-3.left_col,
        body.mobile-nav-open .left_col,
        body.nav-sm.mobile-nav-open .col-md-3.left_col,
        body.nav-sm.mobile-nav-open .left_col {
          transform: translateX(0) !important;
          box-shadow: 10px 0 35px rgba(0, 0, 0, 0.5) !important;
        }

        .sidebar-mobile-backdrop {
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background: rgba(0, 0, 0, 0.6);
          backdrop-filter: blur(3px);
          z-index: 1055;
          display: none;
        }

        body.mobile-nav-open .sidebar-mobile-backdrop {
          display: block;
        }

        body.mobile-nav-open {
          overflow: hidden !important;
        }

        .btn-sidebar-close {
          position: absolute;
          top: 15px;
          right: 15px;
          width: 32px;
          height: 32px;
          border-radius: 50%;
          border: none;
          background: rgba(255, 255, 255, 0.2);
          color: #ffffff;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 18px;
          cursor: pointer;
          z-index: 10;
        }
      }

      @media (min-width: 992px) {
        .sidebar-mobile-backdrop,
        .btn-sidebar-close {
          display: none !important;
        }
      }
    </style>

    <script>
      // Sidebar Height Synchronization - Memastikan Sidebar Sepanjang Isinya & Tidak Terputus
      function syncSidebarHeight() {
        if (window.innerWidth < 992) {
          var leftCol = document.querySelector('.col-md-3.left_col');
          var rightCol = document.querySelector('.right_col');
          var mainCont = document.querySelector('.main_container');
          if (leftCol) { leftCol.style.minHeight = ''; leftCol.style.height = ''; }
          if (rightCol) { rightCol.style.minHeight = ''; }
          if (mainCont) { mainCont.style.minHeight = ''; }
          return;
        }

        var header = document.querySelector('.sidebar-brand-header');
        var sidebarMenu = document.getElementById('sidebar-menu');
        var leftCol = document.querySelector('.col-md-3.left_col');
        var rightCol = document.querySelector('.right_col');
        var mainCont = document.querySelector('.main_container');
        var topNav = document.querySelector('.top_nav');

        if (!leftCol) return;

        // Hitung total tinggi alami sidebar termasuk header, menu, dan margin bawah agar tidak terputus
        var sidebarContentH = 0;
        if (header) sidebarContentH += header.offsetHeight || 0;
        if (sidebarMenu) sidebarContentH += sidebarMenu.offsetHeight || 0;
        sidebarContentH += 80; // Safe bottom breathing space

        var windowH = window.innerHeight || document.documentElement.clientHeight || 0;

        // Hitung tinggi alami konten sebelah kanan (right_col)
        var rightColNaturalH = 0;
        if (rightCol) {
          var children = rightCol.children;
          if (children && children.length > 0) {
            for (var i = 0; i < children.length; i++) {
              var c = children[i];
              var b = (c.offsetTop || 0) + (c.offsetHeight || 0);
              if (b > rightColNaturalH) rightColNaturalH = b;
            }
            rightColNaturalH += 40;
          } else {
            rightColNaturalH = rightCol.scrollHeight || rightCol.offsetHeight || 0;
          }
        }
        var topNavH = topNav ? (topNav.offsetHeight || 0) : 0;
        var totalRightH = rightColNaturalH + topNavH;

        // Ambil nilai maksimal agar sidebar membentang penuh sepanjang isi atau viewport
        var targetH = Math.max(sidebarContentH, totalRightH, windowH);

        if (mainCont) {
          mainCont.style.minHeight = targetH + 'px';
        }
        leftCol.style.minHeight = targetH + 'px';
        leftCol.style.height = targetH + 'px';

        if (rightCol) {
          var contentMinH = Math.max(targetH - topNavH, 0);
          rightCol.style.minHeight = contentMinH + 'px';
        }
      }

      document.addEventListener('DOMContentLoaded', function() {
        var menuToggle = document.getElementById('menu_toggle');
        var backdrop = document.getElementById('sidebarMobileBackdrop');
        var btnClose = document.getElementById('btnSidebarClose');
        
        function isMobile() { return window.innerWidth < 992; }
        
        if (menuToggle) {
          menuToggle.addEventListener('click', function(e) {
            if (isMobile()) {
              e.preventDefault();
              e.stopPropagation();
              document.body.classList.toggle('mobile-nav-open');
            } else {
              setTimeout(syncSidebarHeight, 100);
              setTimeout(syncSidebarHeight, 300);
            }
          });
        }
        
        if (backdrop) {
          backdrop.addEventListener('click', function() {
            document.body.classList.remove('mobile-nav-open');
          });
        }
        
        if (btnClose) {
          btnClose.addEventListener('click', function() {
            document.body.classList.remove('mobile-nav-open');
          });
        }

        // Jalankan sinkronisasi tinggi saat halaman pertama kali siap
        syncSidebarHeight();
        window.addEventListener('resize', syncSidebarHeight);
        window.addEventListener('load', syncSidebarHeight);

        // Pantau ekspansi/kolaps menu accordion sidebar
        var sidebarMenu = document.getElementById('sidebar-menu');
        if (sidebarMenu) {
          sidebarMenu.addEventListener('click', function(e) {
            if (e.target.closest('a')) {
              setTimeout(syncSidebarHeight, 50);
              setTimeout(syncSidebarHeight, 200);
              setTimeout(syncSidebarHeight, 400);
            }
          });

          if (window.ResizeObserver) {
            var ro = new ResizeObserver(function() {
              syncSidebarHeight();
            });
            ro.observe(sidebarMenu);
          }
        }

        // Interaktivitas Pertanyaan & Pilihan Kuesioner (Menyatu dalam 1 Kotak)
        document.addEventListener('change', function(e) {
          if (e.target && e.target.matches('.question-box input[type="radio"]')) {
            var box = e.target.closest('.question-box');
            if (box) {
              box.classList.add('is-answered');
              var allCards = box.querySelectorAll('.q-radio-card');
              allCards.forEach(function(card) { card.classList.remove('selected'); });
              var parentCard = e.target.closest('.q-radio-card');
              if (parentCard) parentCard.classList.add('selected');
            }
          }
        });

        document.addEventListener('input', function(e) {
          if (e.target && e.target.matches('.question-box input[type="text"]')) {
            var box = e.target.closest('.question-box');
            if (box) {
              var inputs = box.querySelectorAll('input[type="text"]');
              var hasVal = false;
              inputs.forEach(function(inp) { if (inp.value.trim().length > 0) hasVal = true; });
              if (hasVal) box.classList.add('is-answered');
              else box.classList.remove('is-answered');
            }
          }
        });

        setTimeout(syncSidebarHeight, 150);
        setTimeout(syncSidebarHeight, 500);
        setTimeout(syncSidebarHeight, 1200);
      });
    </script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- Mobile Drawer Backdrop -->
        <div id="sidebarMobileBackdrop" class="sidebar-mobile-backdrop"></div>

        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <!-- Sidebar Brand Header (Logo IDE Saja & Tombol Tutup Mobile - Seragam dengan Dashboard Utama) -->
            <div class="sidebar-brand-header text-center">
              <a href="<?php
                if ($userLevel == 1) echo base_url('SuperAdmin');
                elseif ($userLevel == 2) echo base_url('Admin');
                elseif ($userLevel == 3) echo base_url('Staf');
                elseif ($userLevel == 4) echo base_url('Surveyor');
                elseif ($userLevel == 5) echo base_url('IDE/MenuSurvei');
                else echo base_url();
              ?>">
                <img src="<?=base_url('assets/img/logo-white-solid.webp')?>" alt="IDE Logo">
              </a>
              <button type="button" class="btn-sidebar-close d-lg-none" id="btnSidebarClose" title="Tutup Menu">
                <i class="fa-solid fa-xmark"></i>
              </button>
            </div>

            <!-- Sidebar Navigation Menu: Terintegrasi dengan Sidebar Utama Sesuai Role -->
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
                  <li class="<?=$isLayananSurveiActive ? 'active' : ''?>"><a href="<?=base_url('IDE/MenuSurvei')?>"><i class="fa-solid fa-square-poll-vertical"></i> <b>Layanan Survei</b></a></li>
                </ul>

                <div class="sidebar-menu-title">Katalog Survei</div>
                <ul class="nav side-menu">
                  <li class="<?=$isSurveiDesaActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei Desa</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiDesaActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'SurveiBPD') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiBPD')?>"><b>Kinerja Badan Permusyawaratan Desa</b></a></li>           
                      <li class="<?=stripos($currentUri, 'SurveiKinerjaPemDes') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiKinerjaPemDes')?>"><b>Kinerja Penyelenggaraan Pemerintahan Desa</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiKinerjaAparatur') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiKinerjaAparatur')?>"><b>Kinerja Aparatur Desa</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiIPM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiIPM')?>"><b>Indikator Kesejahteraan Masyarakat</b></a></li>   
                    </ul>
                  </li>
                  <li class="<?=$isSurveiNTPActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei NTP</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiNTPActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'SurveiHargaKonsumenPerdesaan') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiHargaKonsumenPerdesaan')?>"><b>Harga Konsumen Perdesaan</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiHargaProdusenPerdesaan') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiHargaProdusenPerdesaan')?>"><b>Harga Produsen Perdesaan</b></a></li>   
                    </ul>
                  </li>
                  <li class="<?=$isSurveiBPNTActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei BPNT</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiBPNTActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'PKPM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/PKPM')?>"><b>Keluarga Penerima Manfaat</b></a></li>   
                      <li class="<?=stripos($currentUri, 'BankPenyalur') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/BankPenyalur')?>"><b>Bank Penyalur</b></a></li>   
                      <li class="<?=stripos($currentUri, 'PendampingBPNT') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/PendampingBPNT')?>"><b>Pendamping BPNT</b></a></li>   
                      <li class="<?=stripos($currentUri, 'EWarung') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/EWarung')?>"><b>E-Warung</b></a></li> 
                    </ul>
                  </li>
                  <li class="<?=$isSurveiBBMActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei BBM</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiBBMActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'DesaBBM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/DesaBBM')?>"><b>Pemerintah Desa</b></a></li> 
                      <li class="<?=stripos($currentUri, 'DampakBBM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/DampakBBM')?>"><b>Dampak BBM</b></a></li> 
                    </ul>
                  </li>
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
                  <li class="<?=$isLayananSurveiActive ? 'active' : ''?>"><a href="<?=base_url('IDE/MenuSurvei')?>"><i class="fa-solid fa-square-poll-vertical"></i> <b>Layanan Survei</b></a></li>
                </ul>

                <div class="sidebar-menu-title">Katalog Survei</div>
                <ul class="nav side-menu">
                  <li class="<?=$isSurveiDesaActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei Desa</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiDesaActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'SurveiBPD') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiBPD')?>"><b>Kinerja Badan Permusyawaratan Desa</b></a></li>           
                      <li class="<?=stripos($currentUri, 'SurveiKinerjaPemDes') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiKinerjaPemDes')?>"><b>Kinerja Penyelenggaraan Pemerintahan Desa</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiKinerjaAparatur') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiKinerjaAparatur')?>"><b>Kinerja Aparatur Desa</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiIPM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiIPM')?>"><b>Indikator Kesejahteraan Masyarakat</b></a></li>   
                    </ul>
                  </li>
                  <li class="<?=$isSurveiNTPActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei NTP</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiNTPActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'SurveiHargaKonsumenPerdesaan') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiHargaKonsumenPerdesaan')?>"><b>Harga Konsumen Perdesaan</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiHargaProdusenPerdesaan') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiHargaProdusenPerdesaan')?>"><b>Harga Produsen Perdesaan</b></a></li>   
                    </ul>
                  </li>
                  <li class="<?=$isSurveiBPNTActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei BPNT</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiBPNTActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'PKPM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/PKPM')?>"><b>Keluarga Penerima Manfaat</b></a></li>   
                      <li class="<?=stripos($currentUri, 'BankPenyalur') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/BankPenyalur')?>"><b>Bank Penyalur</b></a></li>   
                      <li class="<?=stripos($currentUri, 'PendampingBPNT') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/PendampingBPNT')?>"><b>Pendamping BPNT</b></a></li>   
                      <li class="<?=stripos($currentUri, 'EWarung') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/EWarung')?>"><b>E-Warung</b></a></li> 
                    </ul>
                  </li>
                  <li class="<?=$isSurveiBBMActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei BBM</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiBBMActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'DesaBBM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/DesaBBM')?>"><b>Pemerintah Desa</b></a></li> 
                      <li class="<?=stripos($currentUri, 'DampakBBM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/DampakBBM')?>"><b>Dampak BBM</b></a></li> 
                    </ul>
                  </li>
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
                  <li class="<?=$isLayananSurveiActive ? 'active' : ''?>"><a href="<?=base_url('IDE/MenuSurvei')?>"><i class="fa-solid fa-square-poll-vertical"></i> <b>Layanan Survei</b></a></li>
                </ul>

                <div class="sidebar-menu-title">Katalog Survei</div>
                <ul class="nav side-menu">
                  <li class="<?=$isSurveiDesaActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei Desa</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiDesaActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'SurveiBPD') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiBPD')?>"><b>Kinerja Badan Permusyawaratan Desa</b></a></li>           
                      <li class="<?=stripos($currentUri, 'SurveiKinerjaPemDes') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiKinerjaPemDes')?>"><b>Kinerja Penyelenggaraan Pemerintahan Desa</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiKinerjaAparatur') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiKinerjaAparatur')?>"><b>Kinerja Aparatur Desa</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiIPM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiIPM')?>"><b>Indikator Kesejahteraan Masyarakat</b></a></li>   
                    </ul>
                  </li>
                  <li class="<?=$isSurveiNTPActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei NTP</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiNTPActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'SurveiHargaKonsumenPerdesaan') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiHargaKonsumenPerdesaan')?>"><b>Harga Konsumen Perdesaan</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiHargaProdusenPerdesaan') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiHargaProdusenPerdesaan')?>"><b>Harga Produsen Perdesaan</b></a></li>   
                    </ul>
                  </li>
                  <li class="<?=$isSurveiBPNTActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei BPNT</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiBPNTActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'PKPM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/PKPM')?>"><b>Keluarga Penerima Manfaat</b></a></li>   
                      <li class="<?=stripos($currentUri, 'BankPenyalur') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/BankPenyalur')?>"><b>Bank Penyalur</b></a></li>   
                      <li class="<?=stripos($currentUri, 'PendampingBPNT') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/PendampingBPNT')?>"><b>Pendamping BPNT</b></a></li>   
                      <li class="<?=stripos($currentUri, 'EWarung') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/EWarung')?>"><b>E-Warung</b></a></li> 
                    </ul>
                  </li>
                  <li class="<?=$isSurveiBBMActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei BBM</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiBBMActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'DesaBBM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/DesaBBM')?>"><b>Pemerintah Desa</b></a></li> 
                      <li class="<?=stripos($currentUri, 'DampakBBM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/DampakBBM')?>"><b>Dampak BBM</b></a></li> 
                    </ul>
                  </li>
                </ul>

                <div class="sidebar-menu-title">Sistem</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('IDE/SignOut')?>"><i class="fa-solid fa-right-from-bracket"></i> <b>Keluar (Sign Out)</b> </a></li>
                </ul>

              <?php else: /* ================= SURVEYOR (LEVEL 4) & ROLE 5 (SURVEI) ================= */ ?>
                <div class="sidebar-menu-title">Main Control</div>
                <ul class="nav side-menu">
                  <li class="<?=$isProfilActive ? 'active' : ''?>"><a href="<?=base_url('Surveyor')?>"><i class="fa-solid fa-user"></i> <b>Profil</b> </a></li>
                </ul>

                <div class="sidebar-menu-title">Instrumen Survei</div>
                <ul class="nav side-menu">
                  <li class="<?=$isLayananSurveiActive ? 'active' : ''?>"><a href="<?=base_url('IDE/MenuSurvei')?>"><i class="fa-solid fa-square-poll-vertical"></i> <b>Layanan Survei</b></a></li>
                </ul>

                <div class="sidebar-menu-title">Katalog Survei</div>
                <ul class="nav side-menu">
                  <li class="<?=$isSurveiDesaActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei Desa</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiDesaActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'SurveiBPD') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiBPD')?>"><b>Kinerja Badan Permusyawaratan Desa</b></a></li>           
                      <li class="<?=stripos($currentUri, 'SurveiKinerjaPemDes') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiKinerjaPemDes')?>"><b>Kinerja Penyelenggaraan Pemerintahan Desa</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiKinerjaAparatur') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiKinerjaAparatur')?>"><b>Kinerja Aparatur Desa</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiIPM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiIPM')?>"><b>Indikator Kesejahteraan Masyarakat</b></a></li>   
                    </ul>
                  </li>
                  <li class="<?=$isSurveiNTPActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei NTP</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiNTPActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'SurveiHargaKonsumenPerdesaan') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiHargaKonsumenPerdesaan')?>"><b>Harga Konsumen Perdesaan</b></a></li>   
                      <li class="<?=stripos($currentUri, 'SurveiHargaProdusenPerdesaan') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/SurveiHargaProdusenPerdesaan')?>"><b>Harga Produsen Perdesaan</b></a></li>   
                    </ul>
                  </li>
                  <li class="<?=$isSurveiBPNTActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei BPNT</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiBPNTActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'PKPM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/PKPM')?>"><b>Keluarga Penerima Manfaat</b></a></li>   
                      <li class="<?=stripos($currentUri, 'BankPenyalur') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/BankPenyalur')?>"><b>Bank Penyalur</b></a></li>   
                      <li class="<?=stripos($currentUri, 'PendampingBPNT') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/PendampingBPNT')?>"><b>Pendamping BPNT</b></a></li>   
                      <li class="<?=stripos($currentUri, 'EWarung') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/EWarung')?>"><b>E-Warung</b></a></li> 
                    </ul>
                  </li>
                  <li class="<?=$isSurveiBBMActive ? 'active' : ''?>">
                    <a><i class="fa fa-tasks"></i> <b>Survei BBM</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="<?=$isSurveiBBMActive ? 'display: block;' : ''?>">
                      <li class="<?=stripos($currentUri, 'DesaBBM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/DesaBBM')?>"><b>Pemerintah Desa</b></a></li> 
                      <li class="<?=stripos($currentUri, 'DampakBBM') !== false ? 'current-page active' : ''?>"><a href="<?=base_url('Surveyor/DampakBBM')?>"><b>Dampak BBM</b></a></li> 
                    </ul>
                  </li>
                </ul>

                <div class="sidebar-menu-title">Sistem</div>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('IDE/SignOut')?>"><i class="fa-solid fa-right-from-bracket"></i> <b>Keluar (Sign Out)</b> </a></li>
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
                <i class="fa-solid fa-circle-user" style="color: #ffffff; font-size: 16px;"></i>
                <span>Halo, <strong><?=htmlspecialchars($userName)?></strong></span>
              </div>
              <a href="<?=base_url('IDE/SignOut')?>" class="btn-header-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
              </a>
            </div>
          </div>
        </div>
        <!-- /top navigation -->
