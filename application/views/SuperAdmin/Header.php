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

<style>/* Layout utama */
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
              padding-top: 8px;
          }

          .dataTables_wrapper .dataTables_paginate {
              float: right;
              margin-top: 0;
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
                <span class="font-weight-bold">Super Admin,</span>
                <h2 class="font-weight-bold"><?=ucfirst($this->session->userdata('Username'))?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
									<li><a href="<?=base_url('SuperAdmin')?>"><i class="fa fa-user"></i> <b>Dashboard</b> </a></li>
                </ul>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-usd"></i> <b>Pendapatan</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
											<li><a href="<?=base_url('SuperAdmin/PendapatanKas')?>"><b>Kas</b></a></li>
                      <li><a href="<?=base_url('SuperAdmin/PendapatanKegiatan')?>"><b>Kegiatan</b></a></li>
                    </ul>
									</li>
								</ul>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-usd"></i> <b>Pengeluaran</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
											<li><a href="<?=base_url('SuperAdmin/PengeluaranUmum')?>"><b>Umum</b></a></li>
                      <li><a href="<?=base_url('SuperAdmin/PengeluaranKegiatan')?>"><b>Kegiatan</b></a></li>
                    </ul>
									</li>
								</ul>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-book"></i> <b>Jurnal</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
											<li><a href="<?=base_url('SuperAdmin/JurnalUmum')?>"><b>Umum</b></a></li>
                      <li><a href="<?=base_url('SuperAdmin/JurnalKegiatan')?>"><b>Kegiatan</b></a></li>
                      <li><a href="<?=base_url('SuperAdmin/JurnalTotal')?>"><b>Total</b></a></li>
                    </ul>
									</li>
								</ul>
                <!-- <ul class="nav side-menu">
									<li><a href="<?=base_url('SuperAdmin/Project')?>"><i class="fa fa-book"></i> <b>Project</b> </a></li>
                </ul> -->
                <!-- <ul class="nav side-menu">
									<li><a href="<?=base_url('SuperAdmin/Matrikulasi')?>"><i class="fa fa-book"></i> <b>Matrikulasi</b> </a></li>
                </ul> -->
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
				<div class="right_col " role="main" style="overflow-x: hidden;">
					<div class="">
            <div class="clearfix"></div>