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
                <img src="<?=base_url('assets/img/SuperAdmin.png')?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span class="font-weight-bold">Welcome,</span>
                <h2 class="font-weight-bold">Super Admin</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
									<li><a href="<?=base_url('SuperAdmin')?>"><i class="fa fa-user"></i> <b>Profil</b> </a></li>
                </ul>
								<ul class="nav side-menu">
                  <li><a><i class="fa fa-tasks"></i> <b>Data</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('SuperAdmin/IKM')?>"><b>Kepuasan Pelayanan Desa</b></a></li>           
											<li><a href="<?=base_url('SuperAdmin/BPD')?>"><b>Kinerja Badan Permusyawaratan Desa</b></a></li>    
											<li><a href="<?=base_url('SuperAdmin/KinerjaPemDes')?>"><b>Kinerja Penyelenggaraan Pemerintahan Desa</b></a></li>   
                      <li><a href="<?=base_url('SuperAdmin/KinerjaAparatur')?>"><b>Kinerja Aparatur Desa</b></a></li>   
                      <li><a href="<?=base_url('SuperAdmin/Pendidikan')?>"><b>Pendidikan</b> </a></li>
                      <li><a href="<?=base_url('SuperAdmin/GarisKemiskinan')?>"><b>Garis Kemiskinan</b> </a></li>
                      <li><a href="<?=base_url('SuperAdmin/Pengangguran')?>"><b>Pengangguran</b> </a></li>
                    </ul>
									</li>
                </ul>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-tasks"></i> <b>IPM</b> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('SuperAdmin/IPMKesehatan')?>"><b>ALH & AMH</b></a></li>
                      <li><a href="<?=base_url('SuperAdmin/IPMPendidikan')?>"><b>Pendidikan</b></a></li>
                      <li><a href="<?=base_url('SuperAdmin/IPMPengeluaran')?>"><b>Pengeluaran</b></a></li>
                    </ul>
									</li>
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
          <div class="nav_menu">
            <div class="nav toggle ml-1">
              <a id="menu_toggle"><i class="fa fa-bars text-primary"></i></a>
            </div>
          </div>
        </div>
        <!-- /top navigation -->
      <div class="right_col bg-success" role="main" style="overflow-x: hidden;">