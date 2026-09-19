<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>IDE Consultant</title>
		<link href="<?=base_url('assets/img/favicon.ico')?>" rel="icon">
    <link href="<?=base_url('vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('vendors/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('build/css/custom.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/datatables-bs4/css/dataTables.bootstrap4.css')?>" rel="stylesheet">
    <style>
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

      /* Mobile Responsive Overrides - Desktop (> 991px) remains 100% untouched */
      @media (max-width: 991.98px) {
        .top_nav,
        body.nav-sm .top_nav {
          margin-left: 0 !important;
          width: 100% !important;
        }

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

        body.nav-sm .profile,
        body.nav-sm .nav.side-menu > li > a b,
        body.nav-sm .nav.side-menu > li > a span {
          display: inline-block !important;
          opacity: 1 !important;
          visibility: visible !important;
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
      });
    </script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- Mobile Drawer Backdrop -->
        <div id="sidebarMobileBackdrop" class="sidebar-mobile-backdrop"></div>

        <div class="col-md-3 left_col">
          <div class="left_col scroll-view" style="position: relative;">
            <button type="button" class="btn-sidebar-close" id="btnSidebarClose" title="Tutup Menu">&times;</button>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?=base_url('assets/img/Profil.jpg')?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span class="font-weight-bold">Welcome,</span>
                <h2 class="font-weight-bold">Surveyor</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
									<li><a href="<?=base_url('Surveyor')?>"><i class="fa fa-user"></i> <b>Profil</b> </a></li>
								</ul>
								<ul class="nav side-menu">
                  <li><a><i class="fa fa-tasks"></i> <b>Survei Desa</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
											<li><a href="<?=base_url('Surveyor/SurveiBPD')?>"><b>Kinerja Badan Permusyawaratan Desa</b></a></li>           
											<li><a href="<?=base_url('Surveyor/SurveiKinerjaPemDes')?>"><b>Kinerja Penyelenggaraan Pemerintahan Desa</b></a></li>   
											<li><a href="<?=base_url('Surveyor/SurveiKinerjaAparatur')?>"><b>Kinerja Aparatur Desa</b></a></li>   
											<li><a href="<?=base_url('Surveyor/SurveiIPM')?>"><b>Indikator Kesejahteraan Masyarakat</b></a></li>   
                    </ul>
									</li>
								</ul>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-tasks"></i> <b>Survei NTP</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Surveyor/SurveiHargaKonsumenPerdesaan')?>"><b>Harga Konsumen Perdesaan</b></a></li>   
                      <li><a href="<?=base_url('Surveyor/SurveiHargaProdusenPerdesaan')?>"><b>Harga Produsen Perdesaan</b></a></li>   
                      <!-- <li><a href="<?=base_url('Surveyor/NTPProdusen')?>"><b>NTP Produsen HTD Januari</b></a></li> -->
                      <!-- <li><a href="<?=base_url('Surveyor/NTPProdusenHTD')?>"><b>NTP Produsen HTD 2018</b></a></li>    -->
                    </ul>
									</li>
								</ul>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-tasks"></i> <b>Survei BPNT</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Surveyor/PKPM')?>"><b>Keluarga Penerima Manfaat</b></a></li>   
                      <li><a href="<?=base_url('Surveyor/BankPenyalur')?>"><b>Bank Penyalur</b></a></li>   
                      <li><a href="<?=base_url('Surveyor/PendampingBPNT')?>"><b>Pendamping BPNT</b></a></li>   
                      <li><a href="<?=base_url('Surveyor/EWarung')?>"><b>E-Warung</b></a></li> 
                    </ul>
									</li>
                </ul>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-tasks"></i> <b>Survei BBM</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('Surveyor/DesaBBM')?>"><b>Pemerintah Desa</b></a></li> 
                      <li><a href="<?=base_url('Surveyor/DampakBBM')?>"><b>Dampak BBM</b></a></li> 
                    </ul>
									</li>
								</ul>
								<ul class="nav side-menu">
									<li><a href="<?=base_url('IDE/LogOut')?>"><i class="fa fa-sign-out"></i> <b>Keluar</b> </a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu bg-danger">
            <div class="nav toggle ml-1">
              &nbsp;&nbsp;<a id="menu_toggle"><i class="fa fa-bars text-white"></i></a>
            </div>
          </div>
        </div>
        <!-- /top navigation -->