<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>IDE Consultant</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="<?=base_url('assets/img/favicon.ico')?>" rel="icon">
	<link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/vendor/fontawesome/css/all.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/surveyor.css')?>" rel="stylesheet">
	<link href="<?=base_url('assets/css/font-awesome.css')?>" rel="stylesheet">
	</head>
	<body>	
		<div class="page-container">	
			<div class="sidebar-menu">
				<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></a></div>		  
				<div class="menu">
					<ul id="menu" >
						<li id="menu-home"><a href="<?=base_url('Desa')?>"><i class="fa fa-user"></i><span>Dashboard</span></a></li>
						<li><a href="#"><i class="fa fa-list"></i><span>Desa</span><span class="fa fa-angle-right" style="float: right"></span></a>
							<ul>
								<li><a href="<?=base_url('Desa/IKM')?>">Kepuasan Pelayanan Desa</a></li>           
								<li><a href="<?=base_url('Desa/BPD')?>">Kinerja Badan Permusyawaratan Desa</a></li>    
								<li><a href="<?=base_url('Desa/KinerjaPemDes')?>">Kinerja Penyelenggaraan Pemerintahan Desa</a></li>   
								<li><a href="<?=base_url('Desa/KinerjaAparatur')?>">Kinerja Aparatur Desa</a></li>   
							</ul>
            </li>
            <li id="menu-home"><a href="<?=base_url('IDE/DesaSignOut')?>"><i class="fa fa-lock"></i><span>Keluar</span></a></li>
					</ul>
				</div>
			</div>