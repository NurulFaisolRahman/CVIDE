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
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        min-height: 100vh;
        padding-bottom: 30px;
        color: #334155;
      }
      
      .app-container {
        max-width: 500px;
        margin: 20px auto;
        background-color: white;
        border-radius: 24px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        overflow: hidden;
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
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        background-color: var(--primary-color);
      }
      .banner-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.25) 100%);
      }
      
      .badge-logo-container {
        position: absolute;
        bottom: -45px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 5;
      }
      
      .badge-logo {
        width: 90px;
        height: 90px;
        background-color: white;
        border-radius: 50%;
        padding: 5px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.22);
        border: 4px solid #ffffff;
        object-fit: contain;
      }
      
      .title-section {
        padding: 55px 20px 20px;
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
      }
      
      .title-section p {
        color: #64748b;
        font-size: 13.5px;
        margin-top: 6px;
        margin-bottom: 0;
        line-height: 1.4;
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
        box-shadow: 0 4px 12px rgba(4, 49, 104, 0.06);
        border-radius: 14px !important;
        margin-bottom: 14px;
        overflow: hidden;
      }
      
      .panel-heading {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
        padding: 0;
        border: none !important;
        border-radius: 14px !important;
      }
      
      .panel-title a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 20px;
        color: white !important;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none !important;
        transition: all 0.25s ease;
      }
      
      .panel-title a:hover {
        background-color: rgba(255, 255, 255, 0.12);
      }
      
      .panel-title a.collapsed {
        border-radius: 14px;
      }
      
      .panel-title a:after {
        content: "\f078";
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 12px;
        transition: transform 0.3s ease;
      }
      
      .panel-title a.collapsed:after {
        transform: rotate(-90deg);
      }
      
      .panel-body {
        background-color: #ffffff;
        border-radius: 0 0 14px 14px;
        padding: 16px;
        border-top: none !important;
      }
      
      /* Nested Accordion Sub-Bab Level 2, 3, 4+ (Warna sama dengan Header Bab Utama) */
      .nested-panel-group .panel-default {
        box-shadow: 0 3px 10px rgba(4, 49, 104, 0.08);
        margin-bottom: 12px;
        border: none !important;
        border-radius: 12px !important;
      }
      
      .nested-panel-group .panel-heading {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
        border: none !important;
        border-radius: 12px !important;
      }
      
      .nested-panel-group .panel-title a {
        color: #ffffff !important;
        font-size: 13.5px;
        font-weight: 700;
        padding: 12px 18px;
      }

      .nested-panel-group .panel-title a:after {
        color: rgba(255, 255, 255, 0.85) !important;
      }
      
      .nested-panel-group .panel-title a:hover {
        background-color: rgba(255, 255, 255, 0.12);
      }
      
      .nested-panel-group .panel-body {
        background-color: #ffffff;
        padding: 14px;
        border-radius: 0 0 12px 12px;
      }
      
      /* Button Item Styling (Isi Dokumen Berwarna Putih) */
      .btn-primary.btn-microsite-item {
        background: #ffffff !important;
        border: 1.5px solid #e2e8f0 !important;
        border-radius: 12px;
        padding: 12px 18px;
        margin-bottom: 10px;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(4, 49, 104, 0.05);
        transition: all 0.25s ease;
        text-align: left;
        position: relative;
        font-size: 13.5px;
        line-height: 1.4;
        min-height: 48px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #1e293b !important;
      }
      
      .btn-primary.btn-microsite-item:hover {
        background: #f8fafc !important;
        border-color: #043168 !important;
        box-shadow: 0 6px 16px rgba(4, 49, 104, 0.12);
        transform: translateY(-2px);
        color: #043168 !important;
      }
      
      .btn-primary.btn-microsite-item:after {
        content: "\f35d";
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 13px;
        color: #043168;
      }
      
      .btn-text {
        flex: 1;
        padding-right: 12px;
      }
      
      /* Footer */
      .footer {
        text-align: center;
        padding: 20px;
        color: rgba(255, 255, 255, 0.9);
        font-size: 12px;
      }
      
      .footer a {
        color: #ffffff;
        font-weight: 600;
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
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
        <div class="banner-wrapper" style="<?php if ($hasBanner): ?>background-image: url('<?=htmlspecialchars($bannerUrl, ENT_QUOTES, 'UTF-8')?>');<?php else: ?>height: 120px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);<?php endif; ?>">
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
              $html .= '<a class="btn btn-primary btn-block btn-microsite-item" ';
              if ($hasUrl) {
                $html .= ' onclick="window.open(\'' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '\')" ';
              } else {
                $html .= ' onclick="alert(\'Dokumen ' . htmlspecialchars($item['Judul'], ENT_QUOTES, 'UTF-8') . ' belum tersedia.\')" ';
              }
              $html .= ' role="button">';
              $html .= '  <span class="btn-text">' . htmlspecialchars($item['Judul']) . '</span>';
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
              $html .= '        <span>' . htmlspecialchars($item['Judul']) . '</span>';
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

    <!-- jQuery & Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  </body>
</html>
