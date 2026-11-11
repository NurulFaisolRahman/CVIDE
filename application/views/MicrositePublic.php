<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?=htmlspecialchars($Microsite['Judul'] ?? 'Microsite')?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
      :root {
        --primary-color: #043168;
        --secondary-color: #0a3d7c;
        --accent-color: #ee626b;
        --light-color: #e8f0fe;
        --dark-color: #021e42;
        --card-bg: #ffffff;
      }
      
      * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
      }
      
      body {
        background-color: #030712;
        background-image: 
          radial-gradient(at 10% 15%, rgba(14, 165, 233, 0.16) 0px, transparent 48%),
          radial-gradient(at 90% 25%, rgba(124, 58, 237, 0.18) 0px, transparent 50%),
          radial-gradient(at 50% 90%, rgba(37, 99, 235, 0.22) 0px, transparent 55%),
          linear-gradient(180deg, #030712 0%, #08152e 50%, #030712 100%);
        background-attachment: fixed;
        min-height: 100vh;
        padding-bottom: 40px;
        color: #334155;
        position: relative;
        overflow-x: hidden;
      }
      
      /* Interactive Cyber Wallpaper System */
      .wallpaper-stage {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        overflow: hidden;
      }

      /* Glowing Nebulas with breathing floating physics */
      .wallpaper-nebula {
        position: absolute;
        border-radius: 50%;
        filter: blur(110px);
        opacity: 0.65;
        animation: pulseNebula 18s ease-in-out infinite alternate;
        will-change: transform;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      }
      
      .nebula-cyan {
        top: -80px;
        left: -80px;
        width: 440px;
        height: 440px;
        background: radial-gradient(circle, rgba(14, 165, 233, 0.75), rgba(2, 132, 199, 0.15));
        transform: translate(calc(var(--mouse-px, 0px) * -0.45), calc(var(--mouse-py, 0px) * -0.45));
      }
      
      .nebula-purple {
        top: 30%;
        right: -100px;
        width: 480px;
        height: 480px;
        background: radial-gradient(circle, rgba(124, 58, 237, 0.7), rgba(67, 56, 202, 0.15));
        animation-delay: -6s;
        animation-duration: 22s;
        transform: translate(calc(var(--mouse-px, 0px) * 0.4), calc(var(--mouse-py, 0px) * 0.4));
      }

      .nebula-blue {
        bottom: -70px;
        left: 20%;
        width: 450px;
        height: 450px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.65), rgba(29, 78, 216, 0.15));
        animation-delay: -11s;
        animation-duration: 20s;
        transform: translate(calc(var(--mouse-px, 0px) * -0.3), calc(var(--mouse-py, 0px) * 0.5));
      }

      @keyframes pulseNebula {
        0% { transform: scale(1) translate(0, 0); }
        50% { transform: scale(1.08) translate(30px, 20px); }
        100% { transform: scale(0.96) translate(-20px, 30px); }
      }

      /* Grid Arsitektur Cyber yang Menyala Terang Saat Di-Hover */
      .wallpaper-cyber-grid {
        position: absolute;
        inset: 0;
        background-size: 40px 40px;
        background-image: 
          linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
          linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        mask-image: radial-gradient(
          650px circle at var(--cursor-x, 50vw) var(--cursor-y, 50vh),
          rgba(0, 0, 0, 1) 0%,
          rgba(0, 0, 0, 0.45) 45%,
          rgba(0, 0, 0, 0.08) 75%,
          transparent 100%
        );
        -webkit-mask-image: radial-gradient(
          650px circle at var(--cursor-x, 50vw) var(--cursor-y, 50vh),
          rgba(0, 0, 0, 1) 0%,
          rgba(0, 0, 0, 0.45) 45%,
          rgba(0, 0, 0, 0.08) 75%,
          transparent 100%
        );
        opacity: var(--spotlight-opacity, 1);
        transition: opacity 0.4s ease;
      }

      /* Inti Cahaya Sorot Kursor (Cyan Spotlight Core) */
      .cursor-glow-core {
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: radial-gradient(
          480px circle at var(--cursor-x, 50vw) var(--cursor-y, 50vh),
          rgba(56, 189, 248, 0.32) 0%,
          rgba(14, 165, 233, 0.18) 35%,
          transparent 70%
        );
        mix-blend-mode: screen;
        opacity: var(--spotlight-opacity, 1);
        transition: opacity 0.4s ease;
      }

      /* Pendaran Nebula Ekor (Lagging Violet Aura) */
      .cursor-glow-nebula {
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: radial-gradient(
          850px circle at var(--cursor-lag-x, 50vw) var(--cursor-lag-y, 50vh),
          rgba(139, 92, 246, 0.22) 0%,
          rgba(99, 102, 241, 0.1) 40%,
          transparent 75%
        );
        mix-blend-mode: screen;
        opacity: var(--spotlight-opacity, 1);
        transition: opacity 0.4s ease;
      }

      /* Kartu Utama Statis & Kokoh (Tidak Bergerak) */
      .app-container {
        position: relative;
        z-index: 1;
        max-width: 500px;
        margin: 30px auto;
        background-color: white;
        border-radius: 26px;
        box-shadow: 
          0 30px 70px -15px rgba(0, 0, 0, 0.6),
          0 0 0 1px rgba(255, 255, 255, 0.2),
          0 10px 30px rgba(4, 49, 104, 0.25);
        overflow: hidden;
        transition: box-shadow 0.3s ease;
      }

      .app-container:hover {
        box-shadow: 
          0 35px 75px -18px rgba(0, 0, 0, 0.65),
          0 0 0 1px rgba(255, 255, 255, 0.3),
          0 12px 32px rgba(4, 49, 104, 0.28);
      }
      
      .header-section {
        position: relative;
        z-index: 10;
        text-align: center;
        border-bottom: 4px solid var(--light-color);
        padding-bottom: 0;
        background-color: transparent;
        overflow: visible;
      }
      
      .banner-wrapper {
        width: 100%;
        height: 200px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
      }
      .banner-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
        transition: transform 0.65s cubic-bezier(0.16, 1, 0.3, 1);
      }
      .banner-wrapper:hover .banner-img {
        transform: scale(1.06);
      }
      .banner-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.03) 0%, rgba(0, 0, 0, 0.22) 100%);
        pointer-events: none;
      }
      
      .badge-logo-container {
        position: absolute;
        bottom: -46px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 5;
        width: 94px;
        height: 94px;
        background-color: #ffffff;
        border-radius: 50%;
        padding: 6px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.22);
        border: 4px solid #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease;
        cursor: pointer;
      }

      .badge-logo-container:hover {
        transform: translateX(-50%) translateY(-6px) scale(1.08);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.28), 0 0 0 5px rgba(255, 255, 255, 0.85);
      }
      
      .badge-logo {
        width: 100%;
        height: 100%;
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        object-position: center;
        display: block;
        transform: scale(1.08);
        transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      .badge-logo-container:hover .badge-logo {
        transform: scale(1.16);
      }
      
      .title-section {
        padding: 56px 20px 20px;
        text-align: center;
        background-color: white;
      }
      
      .title-section h1 {
        color: var(--primary-color);
        font-weight: 800;
        font-size: 22px;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        word-break: break-word;
        overflow-wrap: anywhere;
      }
      
      .title-section p {
        color: #64748b;
        font-size: 13.5px;
        margin-top: 6px;
        margin-bottom: 0;
        line-height: 1.4;
        word-break: break-word;
        overflow-wrap: anywhere;
      }
      
      .content-section {
        padding: 10px 20px 30px;
      }
      
      /* Accordion Panel Styling */
      .panel-group {
        margin-bottom: 0;
      }
      
      .panel-default {
        border: none;
        box-shadow: 0 4px 14px rgba(4, 49, 104, 0.08);
        border-radius: 14px !important;
        margin-bottom: 14px;
        overflow: hidden;
        transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.28s ease;
      }

      .panel-default:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(4, 49, 104, 0.16);
      }
      
      .panel-heading {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
        padding: 0;
        border: none !important;
        border-radius: 14px !important;
      }
      
      .panel-title {
        margin: 0;
        width: 100%;
      }

      .panel-title a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        color: white !important;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none !important;
        transition: all 0.25s ease;
        white-space: normal !important;
        word-break: break-word;
        overflow-wrap: anywhere;
      }
      
      .panel-title a:hover {
        background-color: rgba(255, 255, 255, 0.15);
      }
      
      .panel-title a.collapsed {
        border-radius: 14px;
      }

      .panel-title a span,
      .panel-title a .panel-title-text {
        flex: 1;
        min-width: 0;
        word-wrap: break-word;
        overflow-wrap: anywhere;
        word-break: break-word;
        line-height: 1.4;
        padding-right: 12px;
        text-align: left;
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      .panel-title a:hover .panel-title-text {
        transform: translateX(4px);
      }
      
      .panel-title a:after {
        content: "\f078";
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 12px;
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        flex-shrink: 0;
        margin-left: 6px;
      }

      .panel-title a:hover:after {
        transform: scale(1.22);
      }
      
      .panel-title a.collapsed:after {
        transform: rotate(-90deg);
      }

      .panel-title a.collapsed:hover:after {
        transform: rotate(-90deg) scale(1.22);
      }
      
      .panel-body {
        background-color: #ffffff;
        border-radius: 0 0 14px 14px;
        padding: 16px;
        border-top: none !important;
        word-break: break-word;
        overflow-wrap: anywhere;
      }
      
      /* Nested Accordion Sub-Bab Level 2, 3, 4+ (Warna sama dengan Header Bab Utama) */
      .nested-panel-group .panel-default {
        box-shadow: 0 3px 10px rgba(4, 49, 104, 0.08);
        margin-bottom: 12px;
        border: none !important;
        border-radius: 12px !important;
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease;
      }

      .nested-panel-group .panel-default:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(4, 49, 104, 0.14);
      }
      
      .nested-panel-group .panel-heading {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
        border: none !important;
        border-radius: 12px !important;
      }
      
      .nested-panel-group .panel-title a {
        color: #ffffff !important;
        font-size: 13px;
        font-weight: 700;
        padding: 12px 16px;
        white-space: normal !important;
        word-break: break-word;
        overflow-wrap: anywhere;
        transition: all 0.25s ease;
      }

      .nested-panel-group .panel-title a:hover {
        background-color: rgba(255, 255, 255, 0.15);
      }

      .nested-panel-group .panel-title a span,
      .nested-panel-group .panel-title a .panel-title-text {
        flex: 1;
        min-width: 0;
        word-wrap: break-word;
        overflow-wrap: anywhere;
        word-break: break-word;
        line-height: 1.4;
        padding-right: 10px;
        text-align: left;
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      .nested-panel-group .panel-title a:hover .panel-title-text {
        transform: translateX(4px);
      }

      .nested-panel-group .panel-title a:after {
        color: rgba(255, 255, 255, 0.85) !important;
        flex-shrink: 0;
        margin-left: 6px;
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      .nested-panel-group .panel-title a:hover:after {
        transform: scale(1.2);
      }

      .nested-panel-group .panel-title a.collapsed:hover:after {
        transform: rotate(-90deg) scale(1.2);
      }
      
      .nested-panel-group .panel-body {
        background-color: #ffffff;
        padding: 14px;
        border-radius: 0 0 12px 12px;
        word-break: break-word;
        overflow-wrap: anywhere;
      }
      
      /* Button Item Styling (Isi Dokumen Berwarna Putih) */
      .btn-primary.btn-microsite-item {
        background: #ffffff !important;
        border: 1.5px solid #e2e8f0 !important;
        border-radius: 12px;
        padding: 12px 16px;
        margin-bottom: 10px;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(4, 49, 104, 0.05);
        transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-align: left;
        position: relative;
        font-size: 13.5px;
        line-height: 1.4;
        min-height: 48px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #1e293b !important;
        white-space: normal !important;
        word-break: break-word;
        overflow-wrap: anywhere;
        cursor: pointer;
      }
      
      .btn-primary.btn-microsite-item:hover {
        background: #f0f7ff !important;
        border-color: var(--primary-color) !important;
        box-shadow: 0 8px 24px rgba(4, 49, 104, 0.16);
        transform: translateY(-3px) scale(1.01);
        color: var(--primary-color) !important;
      }
      
      .btn-primary.btn-microsite-item:after {
        content: "\f35d";
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 13px;
        color: #043168;
        flex-shrink: 0;
        margin-left: 6px;
        transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), color 0.25s ease;
      }

      .btn-primary.btn-microsite-item:hover:after {
        transform: translateX(4px) scale(1.18);
        color: #0284c7;
      }

      .btn-primary.btn-microsite-item.is-locked-doc:after {
        content: "\f023";
        color: #d97706;
      }

      .btn-primary.btn-microsite-item.is-locked-doc:hover:after {
        color: #b45309;
        transform: scale(1.2);
      }
      
      .btn-text {
        flex: 1;
        min-width: 0;
        word-wrap: break-word;
        overflow-wrap: anywhere;
        word-break: break-word;
        padding-right: 10px;
        line-height: 1.4;
        text-align: left;
        transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
      }

      .btn-primary.btn-microsite-item:hover .btn-text {
        transform: translateX(4px);
      }
      
      /* Styling Khusus Modal Akses Dokumen */
      #ModalAksesDokumen .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
        overflow: hidden;
        background: #ffffff;
      }

      #ModalAksesDokumen .modal-header {
        background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%);
        color: #ffffff;
        padding: 18px 22px;
        border: none;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
      }

      #ModalAksesDokumen .modal-header:before,
      #ModalAksesDokumen .modal-header:after {
        display: none !important;
      }

      .btn-modal-close {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.16);
        border: none !important;
        color: #ffffff !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        outline: none !important;
        padding: 0;
        margin: 0 0 0 14px;
        box-shadow: none !important;
        flex-shrink: 0;
      }

      .btn-modal-close i {
        font-size: 15px;
        color: #ffffff !important;
        line-height: 1;
      }

      .btn-modal-close:hover,
      .btn-modal-close:focus {
        background: rgba(255, 255, 255, 0.32) !important;
        color: #ffffff !important;
        transform: scale(1.08);
      }

      /* Footer */
      .footer {
        position: relative;
        z-index: 1;
        text-align: center;
        padding: 24px 20px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 12.5px;
        letter-spacing: 0.2px;
      }
      
      .footer p {
        margin: 0;
      }

      .footer a {
        color: #38bdf8;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s ease;
      }

      .footer a:hover {
        color: #bae6fd;
        text-decoration: underline;
      }

      @media (max-width: 480px) {
        .app-container {
          margin: 0 auto;
          border-radius: 0;
          min-height: 100vh;
          box-shadow: none;
          transform: none !important;
        }
        .banner-wrapper {
          height: 175px;
        }
        .badge-logo-container {
          width: 86px;
          height: 86px;
          bottom: -43px;
        }
        .title-section {
          padding: 50px 16px 18px;
        }
        .wallpaper-stage {
          display: none;
        }
      }
    </style>
  </head>
  <body>
    <!-- Interactive Cyber Aurora Wallpaper Stage -->
    <div class="wallpaper-stage">
      <div class="wallpaper-nebula nebula-cyan"></div>
      <div class="wallpaper-nebula nebula-purple"></div>
      <div class="wallpaper-nebula nebula-blue"></div>
      <div class="wallpaper-cyber-grid"></div>
      <div class="cursor-glow-core"></div>
      <div class="cursor-glow-nebula"></div>
    </div>

    <?php
    $hasBanner = !empty($Microsite['BannerImg']);
    $hasLogo = !empty($Microsite['LogoImg']);
    $bannerUrl = $hasBanner ? $Microsite['BannerImg'] : '';
    $logoUrl = $hasLogo ? $Microsite['LogoImg'] : '';
    ?>

    <div class="app-container">
      <!-- Header Section -->
      <?php if ($hasBanner || $hasLogo): ?>
      <div class="header-section">
        <div class="banner-wrapper" <?php if (!$hasBanner): ?>style="height: 110px;"<?php endif; ?>>
          <?php if ($hasBanner): ?>
            <img class="banner-img" src="<?=htmlspecialchars($bannerUrl, ENT_QUOTES, 'UTF-8')?>" alt="Banner">
          <?php endif; ?>
          <div class="banner-overlay"></div>
        </div>
        <?php if ($hasLogo): ?>
          <div class="badge-logo-container">
            <img class="badge-logo" src="<?=htmlspecialchars($logoUrl, ENT_QUOTES, 'UTF-8')?>" alt="Logo">
          </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      
      <!-- Title Section -->
      <div class="title-section" <?php if (!$hasLogo): ?>style="padding-top: 22px;"<?php endif; ?>>
        <h1><?=htmlspecialchars($Microsite['Judul'] ?? 'MICROSITE')?></h1>
        <p><?=htmlspecialchars($Microsite['Subjudul'] ?? '')?></p>
      </div>
      
      <!-- Accordion Content Section -->
      <div class="content-section">
        <div class="panel-group" id="mainAccordion" role="tablist" aria-multiselectable="true">
          <?php
          // Helper rekursif untuk merender multi-level nested accordion
          function renderPublicTree($items, $parentId = 'mainAccordion', $level = 1) {
            if (empty($items)) return '';

            // Pisahkan dokumen langsung (link) dan sub-bab accordion (grup)
            // Dokumen langsung akan tampil di atas sub-bab accordion
            $links = array();
            $groups = array();
            foreach ($items as $it) {
              if ($it['Tipe'] === 'link') {
                $links[] = $it;
              } else {
                $groups[] = $it;
              }
            }

            $html = '';

            // 1. Render tombol dokumen langsung terlebih dahulu
            foreach ($links as $item) {
              $url = trim($item['Url'] ?? '');
              $hasUrl = !empty($url);
              $hasPassword = !empty(trim($item['Password'] ?? ''));

              $html .= '<a class="btn btn-primary btn-block btn-microsite-item ' . ($hasPassword ? 'is-locked-doc' : '') . '" ';
              if ($hasPassword) {
                // Dokumen berpassword -> minta password sebelum direct ke dokumen
                $html .= ' data-id="' . $item['Id'] . '" data-judul="' . htmlspecialchars($item['Judul'], ENT_QUOTES, 'UTF-8') . '" ';
                $html .= ' onclick="bukaDokumenProtected(this)" ';
              } else if ($hasUrl) {
                // Dokumen tanpa password -> langsung masuk / direct ke dokumen
                $html .= ' onclick="window.open(\'' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '\', \'_blank\')" ';
              } else {
                $html .= ' onclick="alert(\'Dokumen ' . htmlspecialchars($item['Judul'], ENT_QUOTES, 'UTF-8') . ' belum tersedia.\')" ';
              }
              $html .= ' role="button">';
              $html .= '  <span class="btn-text d-flex align-items-center flex-wrap">';
              if ($hasPassword) {
                $html .= '    <i class="fa-solid fa-lock text-warning" style="font-size: 13px; margin-right: 8px;" title="Dokumen Dilindungi Password"></i>';
              }
              $html .=        htmlspecialchars($item['Judul']);
              if ($hasPassword) {
                $html .= '    <span class="badge" style="background: rgba(245, 158, 11, 0.15); color: #d97706; font-size: 10px; font-weight: 700; padding: 2px 7px; border-radius: 6px; margin-left: 8px; border: 1px solid rgba(245, 158, 11, 0.3);">Terkunci</span>';
              }
              $html .= '  </span>';
              $html .= '</a>';
            }

            // 2. Render Sub-Bab Accordion setelah dokumen langsung
            foreach ($groups as $item) {
              $hasChildren = !empty($item['children']) && count($item['children']) > 0;
              $itemId = 'node_' . $item['Id'] . '_' . md5($item['Judul']);
              $panelClass = ($level === 1) ? 'panel-root' : 'panel-nested level-' . $level;

              $html .= '<div class="panel panel-default ' . $panelClass . '">';
              $html .= '  <div class="panel-heading" role="tab">';
              $html .= '    <h4 class="panel-title">';
              $html .= '      <a role="button" data-toggle="collapse" data-parent="#' . $parentId . '" href="#' . $itemId . '" aria-expanded="false" class="collapsed">';
              $html .= '        <span class="panel-title-text">' . htmlspecialchars($item['Judul']) . '</span>';
              $html .= '      </a>';
              $html .= '    </h4>';
              $html .= '  </div>';
              $html .= '  <div id="' . $itemId . '" class="panel-collapse collapse" role="tabpanel">';
              $html .= '    <div class="panel-body">';
              if ($hasChildren) {
                $html .= '      <div class="panel-group nested-panel-group" id="sub_' . $itemId . '">';
                $html .=          renderPublicTree($item['children'], 'sub_' . $itemId, $level + 1);
                $html .= '      </div>';
              } else {
                $html .= '      <p class="text-muted text-center py-2" style="font-size: 12.5px; margin: 0;"><em>Belum ada dokumen di dalam bab ini.</em></p>';
              }
              $html .= '    </div>';
              $html .= '  </div>';
              $html .= '</div>';
            }

            return $html;
          }

          if (!empty($Tree) && count($Tree) > 0) {
            echo renderPublicTree($Tree, 'mainAccordion', 1);
          } else {
            echo '<div class="text-center py-4 text-muted"><p>Belum ada dokumen yang dipublikasikan.</p></div>';
          }
          ?>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p><?=htmlspecialchars(!empty($Microsite['FooterText']) ? $Microsite['FooterText'] : ('© ' . date('Y') . ' ' . ($Microsite['Judul'] ?? '') . ' | Kebijakan Privasi'))?></p>
    </div>

    <!-- =========================================================================
         MODAL AKSES DOKUMEN TERPROTEKSI PASSWORD
         ========================================================================= -->
    <div class="modal fade" id="ModalAksesDokumen" tabindex="-1" role="dialog" aria-hidden="true" style="backdrop-filter: blur(8px);">
      <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 420px; margin: 80px auto;">
        <div class="modal-content">
          <div class="modal-header">
            <div style="display: flex; align-items: center; margin: 0; padding: 0;">
              <div style="width: 38px; height: 38px; min-width: 38px; background: rgba(255,255,255,0.15); border-radius: 11px; display: flex; align-items: center; justify-content: center; font-size: 16px; color: #fbbf24; margin-right: 13px; flex-shrink: 0; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                <i class="fa-solid fa-lock"></i>
              </div>
              <div style="display: flex; flex-direction: column; justify-content: center; margin: 0; padding: 0; text-align: left;">
                <div style="font-size: 15px; font-weight: 700; color: #ffffff; line-height: 1.25; margin: 0; padding: 0; letter-spacing: 0.2px;">Dokumen Terproteksi</div>
                <div style="font-size: 11.5px; color: #cbd5e1; line-height: 1.25; margin: 3px 0 0 0; padding: 0;">Masukkan password untuk membuka tautan</div>
              </div>
            </div>
            <button type="button" class="btn-modal-close" data-dismiss="modal" aria-label="Close" title="Tutup">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>
          <form id="formAksesDokumen" onsubmit="event.preventDefault(); submitAksesDokumen();">
            <input type="hidden" id="akses_doc_id">
            <div class="modal-body" style="padding: 18px 20px;">
              <!-- Info Dokumen (Simple & Compact) -->
              <div style="background: #f8fafc; border-radius: 8px; padding: 10px 12px; border-left: 3px solid #043168; border-top: 1px solid #edf2f7; border-right: 1px solid #edf2f7; border-bottom: 1px solid #edf2f7; margin-bottom: 15px;">
                <div style="font-size: 10.5px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 3px;">Nama Dokumen</div>
                <div id="akses_doc_judul" style="font-size: 13px; font-weight: 700; color: #1e293b; line-height: 1.4; word-break: break-word; margin: 0;"></div>
              </div>
              
              <!-- Input Password -->
              <div class="form-group mb-2">
                <label style="font-weight: 700; font-size: 12px; color: #334155; margin-bottom: 5px; display: block;">Password Dokumen</label>
                <div style="position: relative; width: 100%;">
                  <input type="password" id="akses_doc_password" class="form-control" placeholder="Ketik password di sini..." required style="height: 42px; border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 9px 40px 9px 12px; font-size: 13.5px; width: 100%; box-shadow: none;">
                  <span onclick="toggleAksesPass()" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #64748b; z-index: 10; display: inline-flex; align-items: center; justify-content: center; width: 22px; height: 22px;">
                    <i class="fa-solid fa-eye" id="iconToggleAksesPass" style="font-size: 14px;"></i>
                  </span>
                </div>
              </div>

              <div id="alertAksesError" class="alert alert-danger d-none mt-2 mb-0" style="font-size: 12px; border-radius: 8px; padding: 8px 12px;">
                <i class="fa-solid fa-circle-exclamation mr-1"></i> <span id="textAksesError">Password salah! Silakan coba lagi.</span>
              </div>
            </div>
            <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center;">
              <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; font-weight: 600; padding: 8px 18px; font-size: 13px; border: 1px solid #cbd5e1; background: #ffffff;">Batal</button>
              <button type="submit" class="btn btn-primary" id="btnSubmitAkses" style="border-radius: 8px; font-weight: 700; padding: 8px 20px; font-size: 13px; background: #043168; border: none;">
                <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> Buka Dokumen
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- jQuery & Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <!-- Script Akses Dokumen Terproteksi Password -->
    <script>
      var BaseURL = '<?=base_url()?>';

      function bukaDokumenProtected(param1, param2) {
        var id, judul;
        if (typeof param1 === 'object') {
          id = $(param1).data('id');
          judul = $(param1).data('judul');
        } else {
          id = param1;
          judul = param2 || '';
        }
        $('#akses_doc_id').val(id);
        $('#akses_doc_judul').text(judul);
        $('#akses_doc_password').val('').attr('type', 'password');
        $('#iconToggleAksesPass').removeClass('fa-eye-slash').addClass('fa-eye');
        $('#alertAksesError').addClass('d-none');
        $('#ModalAksesDokumen').modal('show');
        setTimeout(function() {
          $('#akses_doc_password').focus();
        }, 500);
      }

      function toggleAksesPass() {
        var input = $('#akses_doc_password');
        var icon = $('#iconToggleAksesPass');
        if (input.attr('type') === 'password') {
          input.attr('type', 'text');
          icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          input.attr('type', 'password');
          icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
      }

      function submitAksesDokumen() {
        var id = $('#akses_doc_id').val();
        var password = $('#akses_doc_password').val();
        var btn = $('#btnSubmitAkses');
        var origHtml = btn.html();

        if (!password) {
          $('#alertAksesError').removeClass('d-none alert-warning').addClass('alert-danger');
          $('#textAksesError').text('Silakan masukkan password dokumen!');
          return;
        }

        btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memeriksa...');
        $('#alertAksesError').addClass('d-none');

        $.ajax({
          url: BaseURL + 'IDE/AksesDokumen',
          type: 'POST',
          data: { Id: id, Password: password },
          dataType: 'json',
          success: function(resp) {
            btn.prop('disabled', false).html(origHtml);
            if (resp && resp.status === 'success') {
              var targetUrl = (resp.url || '').trim();
              if (targetUrl) {
                $('#ModalAksesDokumen').modal('hide');
                if (!/^https?:\/\//i.test(targetUrl) && !targetUrl.startsWith('/') && !targetUrl.startsWith('#')) {
                  targetUrl = 'https://' + targetUrl;
                }
                var newWin = window.open(targetUrl, '_blank');
                if (!newWin || newWin.closed || typeof newWin.closed == 'undefined') {
                  window.location.href = targetUrl;
                }
              } else {
                $('#alertAksesError').removeClass('d-none alert-danger').addClass('alert-warning');
                $('#textAksesError').html('<i class="fa-solid fa-circle-check mr-1 text-success"></i> <b>Password benar!</b> Namun tautan link dokumen ini belum disematkan oleh pengelola.');
              }
            } else {
              $('#alertAksesError').removeClass('d-none alert-warning').addClass('alert-danger');
              $('#textAksesError').text(resp && resp.message ? resp.message : 'Password salah! Silakan coba lagi.');
              $('#akses_doc_password').select().focus();
            }
          },
          error: function() {
            btn.prop('disabled', false).html(origHtml);
            $('#alertAksesError').removeClass('d-none alert-warning').addClass('alert-danger');
            $('#textAksesError').text('Terjadi kesalahan koneksi ke server.');
          }
        });
      }
    </script>

    <!-- Script Interaktif Cyber Aurora Background Spotlight & Cursor Tracker -->
    <script>
      (function() {
        let mouseX = window.innerWidth / 2;
        let mouseY = window.innerHeight / 2;
        let coreX = mouseX;
        let coreY = mouseY;
        let lagX = mouseX;
        let lagY = mouseY;
        let isRunning = false;

        function onMouseMove(e) {
          mouseX = e.clientX;
          mouseY = e.clientY;

          if (!isRunning) {
            requestAnimationFrame(animateFrame);
            isRunning = true;
          }
        }

        function animateFrame() {
          // 1. Smooth lerp untuk inti kursor (cepat & presisi)
          coreX += (mouseX - coreX) * 0.18;
          coreY += (mouseY - coreY) * 0.18;

          // 2. Fluid lerp untuk ekor nebula (lambat & mengalir elegan)
          lagX += (mouseX - lagX) * 0.08;
          lagY += (mouseY - lagY) * 0.08;

          const root = document.documentElement;
          root.style.setProperty('--cursor-x', coreX.toFixed(1) + 'px');
          root.style.setProperty('--cursor-y', coreY.toFixed(1) + 'px');
          root.style.setProperty('--cursor-lag-x', lagX.toFixed(1) + 'px');
          root.style.setProperty('--cursor-lag-y', lagY.toFixed(1) + 'px');

          // Parallax offset orba nebula di sudut layar
          const centerX = window.innerWidth / 2;
          const centerY = window.innerHeight / 2;
          const px = ((coreX - centerX) / (centerX || 1)) * 48;
          const py = ((coreY - centerY) / (centerY || 1)) * 48;
          root.style.setProperty('--mouse-px', px.toFixed(1) + 'px');
          root.style.setProperty('--mouse-py', py.toFixed(1) + 'px');

          if (
            Math.abs(mouseX - coreX) > 0.2 ||
            Math.abs(mouseY - coreY) > 0.2 ||
            Math.abs(mouseX - lagX) > 0.3
          ) {
            requestAnimationFrame(animateFrame);
          } else {
            isRunning = false;
          }
        }

        window.addEventListener('mousemove', onMouseMove, { passive: true });

        // Efek kelembutan saat mouse keluar / masuk layar
        document.addEventListener('mouseleave', function() {
          document.documentElement.style.setProperty('--spotlight-opacity', '0.3');
        });

        document.addEventListener('mouseenter', function() {
          document.documentElement.style.setProperty('--spotlight-opacity', '1');
        });
      })();
    </script>
  </body>
</html>
