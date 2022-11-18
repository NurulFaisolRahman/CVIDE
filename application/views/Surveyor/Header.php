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
                      <li><a href="<?=base_url('Surveyor/Ewarung')?>"><b>E-Warung</b></a></li> 
                      <li><a href="<?=base_url('Surveyor/PendampingBPNT')?>"><b>Pendamping BPNT</b></a></li>   
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