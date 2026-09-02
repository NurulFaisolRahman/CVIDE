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
    <link href="<?=base_url('assets/summernote/summernote-bs4.min.css')?>" rel="stylesheet">

    <style>
      /* Layout utama DataTables */
      .dataTables_wrapper .dataTables_length {
          float: left;
          margin-right: 20px;
      }

      .dataTables_wrapper .dataTables_filter {
          float: right;
          text-align: right;
      }

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

      /* Ellipsis (...) styling in Pagination - Berwarna Hitam */
      .dataTables_wrapper .dataTables_paginate span.ellipsis,
      .dataTables_wrapper .dataTables_paginate .ellipsis,
      .dataTables_wrapper .dataTables_paginate .paginate_button.disabled.ellipsis,
      .pagination .page-item.disabled span.page-link,
      .pagination .page-item.disabled .page-link-ellipsis,
      .pagination span.page-link,
      .pagination .ellipsis {
          color: #1e293b !important;
          opacity: 1 !important;
          font-weight: 700 !important;
          letter-spacing: 1px !important;
          cursor: default !important;
          background: transparent !important;
          border: none !important;
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

      /* Responsive untuk mobile */
      @media (max-width: 767px) {
          .dataTables_wrapper .dataTables_length,
          .dataTables_wrapper .dataTables_filter,
          .dataTables_wrapper .dataTables_info,
          .dataTables_wrapper .dataTables_paginate {
              float: none;
              text-align: center;
              width: 100%;
              margin-bottom: 10px;
          }
          
          .dataTables_wrapper .dataTables_filter input {
              width: 100% !important;
          }
          
          .dataTables_wrapper .dataTables_length select {
              width: 100% !important;
          }
      }
    </style>

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?=base_url('assets/img/Profil.jpg')?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span class="font-weight-bold">Super,</span>
                <h2 class="font-weight-bold"><?=ucfirst($this->session->userdata('Username'))?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
									<li><a href="<?=base_url('Econk')?>"><i class="fa fa-user"></i> <b>Dashboard</b> </a></li>
                </ul>
                <ul class="nav side-menu">
									<li><a href="<?=base_url('Econk/Portfolio')?>"><i class="fa fa-usd"></i> <b>Portfolio</b> </a></li>
                </ul>
								<ul class="nav side-menu">
									<li><a href="<?=base_url('IDE/SignOut')?>"><i class="fa fa-sign-out"></i> <b>Keluar</b> </a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu bg-primary">
            <div class="nav toggle ml-1">
              &nbsp;&nbsp;<a id="menu_toggle"><i class="fa fa-bars text-white"></i></a>
            </div>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
				<div class="right_col" role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>