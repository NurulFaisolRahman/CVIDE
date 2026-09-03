<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enterprise Portal SuperAdmin - IDE Consultant</title>
    
    <!-- Favicon & Fonts -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/img/favicon-32x32.png')?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/img/favicon-16x16.png')?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/img/apple-touch-icon.png')?>">
    <link rel="shortcut icon" href="<?=base_url('assets/img/favicon.ico')?>">
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

      /* Full Height Responsive Layout System */
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

      /* Sidebar Left Column Styling (Full Height Extension) */
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
        padding: 20px 20px 25px 20px !important;
        min-height: calc(100vh - 70px) !important;
      }

      /* Smooth Transitions for Sidebar Toggle (Hide/Show Animation) */
      .col-md-3.left_col,
      .left_col,
      .top_nav,
      .right_col,
      .sidebar-brand-header,
      .sidebar-brand-text,
      .profile,
      .profile_info,
      .profile_pic,
      .nav.side-menu > li > a,
      .sidebar-menu-title {
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
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

      /* Keep IDE Logo Image visible in collapsed mode */
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

      /* Hide text labels */
      body.nav-sm .sidebar-brand-text,
      body.nav-sm .profile_info,
      body.nav-sm .sidebar-menu-title,
      body.nav-sm .nav.side-menu > li > a b,
      body.nav-sm .nav.side-menu > li > a span {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
      }

      /* Profile picture in collapsed mode */
      body.nav-sm .profile {
        padding: 10px 5px;
        margin: 10px 5px;
        justify-content: center;
      }

      body.nav-sm .profile_pic {
        display: flex !important;
        justify-content: center;
        width: 100%;
        opacity: 1 !important;
        visibility: visible !important;
      }

      body.nav-sm .profile_pic img {
        width: 38px !important;
        height: 38px !important;
      }

      /* Keep Menu Icons visible & centered */
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

      /* ==========================================================================
         ENTERPRISE DATATABLES DESIGN SYSTEM (Clean & Modern Theme)
         ========================================================================== */
      /* Outer Container Cards */
      .card, 
      .x_panel {
        background: #ffffff !important;
        border-radius: 16px !important;
        box-shadow: 0 8px 24px rgba(4, 49, 104, 0.05) !important;
        border: 1px solid #e2e8f0 !important;
        padding: 16px 20px !important;
        margin-bottom: 16px !important;
      }

      /* DataTables Wrapper (Seamless Inside Card - No Card in Card) */
      .dataTables_wrapper {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        margin-bottom: 0 !important;
      }

      /* Remove inner box/card borders inside any parent card */
      .card .card,
      .x_panel .card,
      .card .x_panel,
      .card .well,
      .card .box,
      .dataTables_wrapper .card {
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
        padding: 0 !important;
        margin: 0 !important;
      }

      .x_title {
        border-bottom: 2px solid #f1f5f9 !important;
        padding-bottom: 10px !important;
        margin-bottom: 12px !important;
      }

      .x_title h2 {
        font-size: 16px !important;
        font-weight: 800 !important;
        color: var(--ide-dark) !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin: 0 !important;
      }

      /* DataTables Search & Filter Controls */
      .dataTables_wrapper .dataTables_length {
        float: left;
        margin-bottom: 10px !important;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
      }

      .dataTables_wrapper .dataTables_length select {
        border-radius: 20px !important;
        border: 2px solid #e2e8f0 !important;
        padding: 4px 14px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        outline: none !important;
        background-color: #f8fafc !important;
        color: var(--ide-dark) !important;
        transition: all 0.3s ease !important;
        cursor: pointer;
        margin: 0 6px;
      }

      .dataTables_wrapper .dataTables_length select:focus {
        border-color: var(--ide-navy) !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.1) !important;
      }

      .dataTables_wrapper .dataTables_filter {
        float: right;
        margin-bottom: 10px !important;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
      }

      .dataTables_wrapper .dataTables_filter label {
        font-weight: 700;
        color: var(--ide-dark);
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .dataTables_wrapper .dataTables_filter input {
        border-radius: 22px !important;
        border: 2px solid #e2e8f0 !important;
        padding: 6px 16px !important;
        font-size: 13px !important;
        outline: none !important;
        background-color: #f8fafc !important;
        color: var(--ide-dark) !important;
        transition: all 0.3s ease !important;
        width: 220px !important;
      }

      .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--ide-navy) !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 4px rgba(4, 49, 104, 0.1) !important;
        width: 250px !important;
      }

      /* Clean DataTables Grid Structure */
      table.dataTable, 
      table.table {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        margin-top: 8px !important;
        margin-bottom: 10px !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 14px !important;
        overflow: hidden !important;
      }

      /* Header Table Styling (Clean Navy Gradient) */
      table.dataTable thead th, 
      table.table thead th {
        background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%) !important;
        color: #ffffff !important;
        font-size: 12.5px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        padding: 10px 14px !important;
        border: none !important;
        vertical-align: middle !important;
      }

      /* Body Table Cells & Hover */
      table.dataTable tbody td, 
      table.table tbody td {
        padding: 8px 14px !important;
        font-size: 13px !important;
        color: #334155 !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
        border-top: none !important;
        transition: background-color 0.2s ease !important;
      }

      table.dataTable tbody tr:last-child td,
      table.table tbody tr:last-child td {
        border-bottom: none !important;
      }

      table.dataTable tbody tr {
        background-color: #ffffff !important;
        transition: all 0.2s ease !important;
      }

      table.dataTable tbody tr:nth-child(even) {
        background-color: #f8fafc !important;
      }

      table.dataTable tbody tr:hover {
        background-color: #eff6ff !important;
      }

      /* Buttons & Actions inside Tables */
      .btn-xs, .btn-sm {
        border-radius: 12px !important;
        font-weight: 600 !important;
        font-size: 12px !important;
        padding: 6px 14px !important;
        transition: all 0.25s ease !important;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08) !important;
      }

      .btn-primary {
        background-color: var(--ide-navy) !important;
        border-color: var(--ide-navy) !important;
      }

      .btn-primary:hover {
        background-color: #03244d !important;
        transform: translateY(-2px) !important;
      }

      .btn-danger {
        background-color: var(--ide-red) !important;
        border-color: var(--ide-red) !important;
      }

      .btn-danger:hover {
        background-color: #d10916 !important;
        transform: translateY(-2px) !important;
      }

      .btn-warning {
        background-color: #f59e0b !important;
        border-color: #f59e0b !important;
        color: #ffffff !important;
      }

      .btn-warning:hover {
        background-color: #d97706 !important;
        color: #ffffff !important;
        transform: translateY(-2px) !important;
      }

      .btn-success {
        background-color: #10b981 !important;
        border-color: #10b981 !important;
      }

      .btn-success:hover {
        background-color: #059669 !important;
        transform: translateY(-2px) !important;
      }

      /* ==========================================================================
         ENTERPRISE CONNECTED & SEGMENTED PAGINATION (Modern, Sleek, Berdepetan)
         ========================================================================== */
      .dataTables_wrapper .dataTables_info {
        float: left;
        padding-top: 14px;
        font-size: 13px;
        font-weight: 500;
        color: #64748b;
        background: transparent !important;
        border: none !important;
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
        color: var(--ide-navy) !important;
        border: none !important;
        box-shadow: none !important;
        transform: translateY(-1px) !important;
      }

      .dataTables_wrapper .dataTables_paginate .paginate_button.current,
      .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
      .page-item.active .page-link {
        background: linear-gradient(135deg, var(--ide-navy) 0%, #0b3977 100%) !important;
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

      /* Unified Bootstrap Pagination (Berdepetan & Modern Pill Group) */
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
        color: var(--ide-navy) !important;
        transform: translateY(-1px) !important;
      }

      .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--ide-navy) 0%, #0b3977 100%) !important;
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

      /* Ellipsis (...) Styling: Clear and Black/Dark like the numbers */
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

      /* Hapus garis/border dalam agar hanya menyisakan card luar */
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

      /* ==========================================================================
         ENTERPRISE UNIFIED MODAL & FORM DESIGN SYSTEM
         ========================================================================== */
      .modal-dialog {
        margin-top: 50px !important;
        width: 94% !important;
        max-width: 760px !important;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
      }

      /* Harmonized modal sizing (prevent any cramped 300px dialogs) */
      .modal-dialog.modal-sm {
        max-width: 680px !important;
      }

      .modal-dialog.modal-md {
        max-width: 760px !important;
      }

      .modal-dialog.modal-lg {
        max-width: 880px !important;
      }

      .modal-dialog.modal-xl {
        max-width: 1100px !important;
      }

      /* Compact confirmation dialogs only */
      #modalEnterpriseDelete .modal-dialog {
        max-width: 440px !important;
      }

      .modal-content {
        border-radius: 24px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 25px 60px rgba(4, 49, 104, 0.35) !important;
        overflow: hidden !important;
        background: #ffffff !important;
      }

      /* Modal Header */
      .modal-header {
        background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%) !important;
        color: #ffffff !important;
        padding: 20px 28px !important;
        border-bottom: none !important;
        align-items: center !important;
      }

      .modal-header .modal-title,
      .modal-header h4, 
      .modal-header h5 {
        color: #ffffff !important;
        font-size: 17px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
      }

      .modal-header .close {
        color: #ffffff !important;
        opacity: 0.8 !important;
        font-size: 24px !important;
        font-weight: 300 !important;
        transition: all 0.25s ease !important;
        background: rgba(255, 255, 255, 0.15) !important;
        border-radius: 50% !important;
        width: 32px !important;
        height: 32px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 0 !important;
        margin: -5px -5px -5px auto !important;
        text-shadow: none !important;
      }

      .modal-header .close:hover {
        opacity: 1 !important;
        background: var(--ide-red) !important;
        transform: rotate(90deg) !important;
      }

      /* Modal Body & Forms */
      .modal-body {
        padding: 30px 28px !important;
        background-color: #ffffff !important;
      }

      .modal-body label,
      .form-group label {
        font-size: 12.5px !important;
        font-weight: 700 !important;
        color: #1e293b !important;
        text-transform: uppercase !important;
        letter-spacing: 0.4px !important;
        margin-bottom: 8px !important;
        display: block !important;
      }

      .modal-body .form-control,
      .modal-body select,
      .modal-body input[type="text"],
      .modal-body input[type="number"],
      .modal-body input[type="date"],
      .modal-body input[type="password"],
      .modal-body textarea,
      .form-group .form-control {
        border-radius: 20px !important;
        border: 2px solid #e2e8f0 !important;
        padding: 10px 18px !important;
        font-size: 13.5px !important;
        outline: none !important;
        background-color: #f8fafc !important;
        color: var(--ide-dark) !important;
        transition: all 0.3s ease !important;
        height: auto !important;
      }

      .modal-body select.form-control {
        padding-right: 35px !important;
        cursor: pointer;
      }

      .modal-body .form-control:focus,
      .form-group .form-control:focus {
        border-color: var(--ide-navy) !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 4px rgba(4, 49, 104, 0.1) !important;
      }

      /* Input Group Append / Prepend */
      .modal-body .input-group-text {
        border-radius: 18px !important;
        border: 2px solid #e2e8f0 !important;
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        padding: 8px 16px !important;
      }

      /* Modal Footer & Action Buttons */
      .modal-footer {
        padding: 18px 28px 24px 28px !important;
        border-top: 1px solid #f1f5f9 !important;
        background-color: #f8fafc !important;
        gap: 12px !important;
        border-bottom-left-radius: 24px !important;
        border-bottom-right-radius: 24px !important;
      }

      .modal-footer .btn,
      .modal-body .btn-submit {
        border-radius: 22px !important;
        padding: 10px 26px !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1) !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
      }

      .modal-footer .btn-primary,
      .modal-footer .btn-success {
        background-color: var(--ide-red) !important;
        border: none !important;
        color: #ffffff !important;
        box-shadow: 0 8px 20px rgba(180, 8, 20, 0.35) !important;
      }

      .modal-footer .btn-primary:hover,
      .modal-footer .btn-success:hover {
        background-color: #d10916 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 12px 25px rgba(180, 8, 20, 0.5) !important;
      }

      .modal-footer .btn-secondary,
      .modal-footer .btn-default {
        background-color: #e2e8f0 !important;
        border: none !important;
        color: #475569 !important;
      }

      .modal-footer .btn-secondary:hover,
      .modal-footer .btn-default:hover {
        background-color: #cbd5e1 !important;
        color: #1e293b !important;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        <!-- Sidebar Navigation -->
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
            <!-- Sidebar Brand Header (Logo IDE Saja) -->
            <div class="sidebar-brand-header text-center" style="padding: 20px 15px 10px 15px; display: flex; justify-content: center; align-items: center;">
              <a href="<?=base_url('SuperAdmin')?>">
                <img src="<?=base_url('assets/img/LOGO IDE.webp')?>" alt="IDE Logo" style="max-height: 48px; width: auto; object-fit: contain;">
              </a>
            </div>

            <!-- Sidebar Menu Items -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
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
            </div>

            <div class="top-nav-right">
              <div class="admin-top-greeting" id="topAdminGreeting">
                <i class="fa-solid fa-circle-user" style="color: var(--ide-navy); font-size: 16px;"></i>
                <span>Halo, <strong><?=$this->session->userdata('Username') ? $this->session->userdata('Username') : 'Super Admin'?></strong></span>
              </div>
              <a href="<?=base_url('IDE/SignOut')?>" class="btn-header-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
              </a>
            </div>
          </div>
        </div>

        <!-- Global Enterprise Delete Confirmation Modal -->
        <div class="modal fade" id="modalEnterpriseDelete" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1060;">
          <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 440px;">
            <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 25px 60px rgba(0,0,0,0.35); overflow: hidden;">
              <div class="modal-header" style="background: linear-gradient(135deg, #b40814 0%, #ee626b 100%); color: #ffffff; padding: 18px 24px; border: none;">
                <h5 class="modal-title" style="font-weight: 800; font-size: 16px; letter-spacing: 0.5px; text-transform: uppercase;">
                  <i class="fa-solid fa-triangle-exclamation mr-2"></i> Konfirmasi Hapus Data
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center p-4">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 72px; height: 72px; background: rgba(180, 8, 20, 0.1); color: var(--ide-red); margin: 0 auto;">
                  <i class="fa-solid fa-trash-can" style="font-size: 32px;"></i>
                </div>
                <h4 style="font-weight: 800; color: #1e293b; font-size: 18px; margin-bottom: 8px;">Yakin Ingin Menghapus?</h4>
                <p style="font-size: 13.5px; color: #64748b; margin: 0; line-height: 1.5;" id="deleteConfirmMessageText">
                  Data yang telah dihapus tidak dapat dikembalikan lagi.
                </p>
              </div>
              <div class="modal-footer justify-content-center p-3" style="background-color: #f8fafc; border-top: 1px solid #f1f5f9; gap: 10px;">
                <button type="button" class="btn btn-secondary px-4 py-2" data-dismiss="modal" style="border-radius: 20px; font-weight: 700; background: #e2e8f0; color: #475569; border: none;">
                  Batal
                </button>
                <button type="button" class="btn btn-danger px-4 py-2" id="btnExecuteEnterpriseDelete" style="border-radius: 20px; font-weight: 700; background: var(--ide-red); border: none; box-shadow: 0 6px 18px rgba(180, 8, 20, 0.35);">
                  <i class="fa-solid fa-trash-can mr-1"></i> Ya, Hapus Data
                </button>
              </div>
            </div>
          </div>
        </div>

        <script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
        <script>
          $(document).ready(function() {
            var pendingDeleteTarget = null;

            $(document).on('click', '.Hapus, .hapus, [Hapus], .btn-delete, .btn-hapus, .btn-delete-kegiatan', function(e) {
              if ($(this).data('confirmed')) {
                return true;
              }

              e.preventDefault();
              e.stopPropagation();
              e.stopImmediatePropagation();

              pendingDeleteTarget = this;
              var customMsg = $(this).attr('data-msg') || 'Apakah Anda yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.';
              $('#deleteConfirmMessageText').text(customMsg);
              $('#modalEnterpriseDelete').modal('show');
              return false;
            });

            $('#btnExecuteEnterpriseDelete').on('click', function() {
              if (pendingDeleteTarget) {
                var $el = $(pendingDeleteTarget);
                $('#modalEnterpriseDelete').modal('hide');

                $el.data('confirmed', true);
                
                // Dispatch click event
                var elObj = pendingDeleteTarget;
                pendingDeleteTarget = null;
                
                setTimeout(function() {
                  elObj.click();
                  $(elObj).data('confirmed', false);
                }, 200);
              }
            });
          });
        </script>

        <!-- Page Main Content Area -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>