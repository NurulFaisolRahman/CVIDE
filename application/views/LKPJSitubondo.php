<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>LKPJ SITUBONDO - Tautan Perangkat Daerah</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
      :root {
            --primary-blue: #1a73e8;
            --btn-bg: rgba(255, 255, 255, 0.95);
            --btn-text: #333333;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.25);
            --wa-color: #25d366;
        }
      
      * {
        font-family: 'Inter', sans-serif;
        box-sizing: border-box;
        -webkit-tap-highlight-color: transparent; /* Hilangkan highlight biru default pada tap */
      }
      
      body {
        min-height: 100vh;
        margin: 0;
        padding: 0;
        color: white;
        background-color: #0f172a; 
        overflow-x: hidden;
      }

      /* Background Image */
      body::before {
          content: "";
          position: fixed;
          top: 0; left: 0; width: 100%; height: 100%;
          background: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=1932&auto=format&fit=crop');
          background-size: cover;
          background-position: center;
          filter: brightness(0.6) saturate(1.1); 
          z-index: -2;
      }

      /* Gradient Overlay */
      body::after {
          content: "";
          position: fixed;
          top: 0; left: 0; width: 100%; height: 100%;
          background: linear-gradient(45deg, rgba(10, 25, 47, 0.85), rgba(28, 70, 145, 0.65));
          z-index: -1;
          backdrop-filter: blur(2px);
      }
      
      /* Container - Responsif Max Width */
      .app-container {
        max-width: 480px;
        width: 100%;
        margin: 0 auto; /* Margin 0 agar full di mobile */
        padding: 40px 20px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 1;
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-left: 1px solid var(--glass-border);
        border-right: 1px solid var(--glass-border);
      }
      
      /* Header */
      .header-section {
        text-align: center;
        margin-bottom: 25px;
        position: relative;
      }
      
      .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.9);
        object-fit: contain;
        background-color: white;
        padding: 5px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        animation: floatIcon 6s ease-in-out infinite;
      }

      @keyframes floatIcon {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
      }
      
      .site-title {
        font-size: 24px;
        font-weight: 800;
        margin: 15px 0 5px 0;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        letter-spacing: 0.5px;
        background: linear-gradient(to right, #ffffff, #dbeafe);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      
      .site-desc {
        font-size: 14px;
        opacity: 0.95;
        margin: 0;
        font-weight: 400;
        color: #f1f5f9;
        line-height: 1.5;
      }

      /* Countdown Compact */
      .countdown-wrapper {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        padding: 15px;
        margin: 20px 0;
        display: flex;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      }

      .countdown-item { text-align: center; flex: 1; }
      .countdown-number { display: block; font-size: 22px; font-weight: 800; line-height: 1; }
      .countdown-label { font-size: 10px; opacity: 0.9; margin-top: 4px; display: block; letter-spacing: 0.5px; }

      /* Search Box */
      .search-container { position: relative; margin-bottom: 20px; }
      
      .search-input {
        width: 100%;
        padding: 14px 20px 14px 45px;
        border-radius: 30px;
        border: none;
        background: rgba(255, 255, 255, 0.95);
        outline: none;
        font-size: 14px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        color: #333;
      }

      .search-icon {
        position: absolute; left: 18px; top: 50%; transform: translateY(-50%);
        color: var(--primary-blue); font-size: 16px; z-index: 2;
      }

      /* Button List */
      .link-list { display: flex; flex-direction: column; gap: 12px; }
      
      .bio-btn {
        display: flex;
        align-items: center;
        width: 100%;
        background-color: var(--btn-bg);
        color: var(--btn-text);
        padding: 16px 20px;
        border-radius: 16px; /* Lebih modern */
        text-decoration: none !important;
        font-weight: 600;
        font-size: 14px;
        line-height: 1.4;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        position: relative;
        border: none;
        cursor: pointer;
        transition: transform 0.1s, background-color 0.2s;
      }
      
      /* Active state untuk responsivitas sentuhan */
      .bio-btn:active {
        transform: scale(0.98);
        background-color: #e2e8f0;
      }
      
      .bio-btn i {
        font-size: 18px;
        width: 30px;
        text-align: center;
        margin-right: 10px;
        color: var(--primary-blue);
        flex-shrink: 0;
      }
      
      .bio-btn span { flex: 1; text-align: left; }
      
      .bio-btn::after {
        content: '\f054'; 
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 12px;
        opacity: 0.3;
        color: #64748b;
        margin-left: 8px;
      }

      /* Group Header */
      .group-header {
        font-size: 11px;
        font-weight: 800;
        color: #ffffff;
        background: rgba(255,255,255,0.2);
        padding: 6px 12px;
        border-radius: 6px;
        margin-top: 15px;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        align-self: flex-start;
      }

      /* Floating WA Single Button */
      .float-wa-single {
          position: fixed;
          width: 60px;
          height: 60px;
          bottom: 25px;
          right: 25px;
          background: linear-gradient(135deg, #25d366, #128c7e);
          color: white;
          border-radius: 50%;
          text-align: center;
          font-size: 28px;
          box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
          z-index: 1000;
          display: flex;
          align-items: center;
          justify-content: center;
          text-decoration: none !important;
          cursor: pointer;
          border: 2px solid white;
          transition: all 0.3s;
      }
      
      .float-wa-single:hover {
          transform: scale(1.1);
          box-shadow: 0 8px 25px rgba(37, 211, 102, 0.6);
      }
      
      .float-wa-single:active {
          transform: scale(0.95);
      }
      
      .wa-badge {
          position: absolute;
          top: -5px;
          right: -5px;
          background: #ff4757;
          color: white;
          font-size: 10px;
          font-weight: 800;
          width: 20px;
          height: 20px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          border: 2px solid white;
      }

      /* WA Admin Option Styling */
      .wa-option {
          display: flex;
          align-items: center;
          padding: 12px;
          margin: 8px 0;
          border-radius: 10px;
          border: 1px solid #e0e0e0;
          background: #f8f9fa;
          cursor: pointer;
          transition: all 0.3s;
      }
      
      .wa-option:hover {
          background: #e3f2fd;
          border-color: var(--primary-blue);
      }
      
      .wa-option i {
          font-size: 24px;
          color: #25d366;
          margin-right: 12px;
          width: 40px;
          text-align: center;
      }
      
      .wa-option-info {
          flex: 1;
      }
      
      .wa-option-name {
          font-weight: 700;
          color: #333;
          margin-bottom: 3px;
          font-size: 14px;
      }
      
      .wa-option-number {
          font-size: 11px;
          color: #666;
      }
      
      .wa-option-tag {
          display: inline-block;
          padding: 2px 8px;
          background: #25d366;
          color: white;
          border-radius: 10px;
          font-size: 9px;
          font-weight: 700;
          margin-left: 8px;
      }

      .no-result {
        text-align: center; padding: 20px; background: rgba(0,0,0,0.3);
        border-radius: 12px; display: none; color: white; margin-top: 10px;
      }

      .footer {
        text-align: center; margin-top: 40px; padding-bottom: 20px;
        font-size: 12px; opacity: 0.8; font-weight: 500;
      }

      /* MEDIA QUERIES untuk Layar Kecil (HP) */
      @media (max-width: 400px) {
        .app-container { padding: 30px 15px; }
        .site-title { font-size: 22px; }
        .bio-btn { padding: 14px 16px; font-size: 13px; }
        .countdown-number { font-size: 18px; }
        .search-input { font-size: 13px; }
        .float-wa-single { width: 55px; height: 55px; font-size: 24px; }
      }
    </style>
  </head>
  <body>

    <div class="app-container">
      
      <div class="header-section">
        <div class="logo-wrapper">
            <img class="profile-image" src="https://situbondo.info/wp-content/uploads/2024/04/logo-kabupaten-situbondo-png-3-2.png" alt="Logo Situbondo">
        </div>
        <h1 class="site-title">LKPJ BUPATI 2025</h1>
        <p class="site-desc">Laporan Keterangan Pertanggungjawaban Bupati Situbondo Tahun 2025</p>
        <p class="site-desc" style="font-size: 11px; color: #fbff00; margin-top: 5px;">*Dimohon untuk mengisi data sesuai masing masing OPD</p>
      </div>

      <div class="countdown-wrapper" id="countdown">
        <div class="countdown-item"><span class="countdown-number" id="days">00</span><span class="countdown-label">HARI</span></div>
        <div class="countdown-item"><span class="countdown-number" id="hours">00</span><span class="countdown-label">JAM</span></div>
        <div class="countdown-item"><span class="countdown-number" id="minutes">00</span><span class="countdown-label">MENIT</span></div>
        <div class="countdown-item"><span class="countdown-number" id="seconds">00</span><span class="countdown-label">DETIK</span></div>
      </div>

      <div class="search-container">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="search-input" id="searchInput" onkeyup="filterFunction()" placeholder="Cari Dinas / Kecamatan...">
      </div>

      <div class="link-list" id="linkList">
        
        <a class="bio-btn" style="background: linear-gradient(to right, #ffffff, #e6f0ff); border: 1px solid #1a73e8;" onclick="konfirmasiBuka('Panduan Pengisian', 'https://docs.google.com/document/d/1qxnO8zH-h4S4v8UUTe6KCu1P2SmOd7qh/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
            <i class="fas fa-book-open" style="color: #1a73e8;"></i><span><b>Panduan Pengisian Link</b></span>
        </a>

        <div class="group-header">Sekretariat Daerah</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Tata Pemerintahan', 'https://docs.google.com/spreadsheets/d/1NbR8yyAWUw-7PzMO3BZ79zh0CDFKVt2KB5G7s3jq2pA/edit?usp=drive_link')"><i class="fas fa-handshake"></i><span>1.A. Bagian Tata Pemerintahan dan Kerja Sama</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Hukum', 'https://docs.google.com/spreadsheets/d/1B2EH8GHHtpT5B_M2nWqdky5S5392TxqGSI8lHOIS0is/edit?usp=drive_link')"><i class="fas fa-scale-balanced"></i><span>1.B. Bagian Hukum</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Prokopim', 'https://docs.google.com/spreadsheets/d/1dALuNM2hqPMc88EkqMMAw0TtjWLGrEMxGQjCZZa09GE/edit?usp=drive_link')"><i class="fas fa-microphone"></i><span>1.C. Bagian Protokol dan Komunikasi Pimpinan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Kesra', 'https://docs.google.com/spreadsheets/d/1AugN_IiyEVehHiM1MKiVNkN8Kef4OY42Q6wRHlX5nmw/edit?usp=drive_link')"><i class="fas fa-users"></i><span>1.D. Bagian Kesejahteraan Masyarakat</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Perekonomian','https://docs.google.com/spreadsheets/d/1ln1ea0WJtI7GIqGanyLugEDjOhnpNLcvPxsE4kCcFsQ/edit?usp=drive_link')"><i class="fas fa-chart-pie"></i><span>1.E. Bagian Perekonomian, Pembangunan, SDA</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - PBJ', 'https://docs.google.com/spreadsheets/d/1pkBm-zH6UWz9eKqqfAoKXc0bxTm9TEIsCWfL6iegwVU/edit?usp=drive_link')"><i class="fas fa-boxes-packing"></i><span>1.F. Bagian Pengadaan Barang dan Jasa</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Organisasi', 'https://docs.google.com/spreadsheets/d/1aqgi7tv5kLXKNv1V-nirWwJxzqDS2w3aHkDHpHXxunQ/edit?usp=drive_link')"><i class="fas fa-sitemap"></i><span>1.G. Bagian Organisasi</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Umum', 'https://docs.google.com/spreadsheets/d/1kOVnFIkrvPJ0P2hrZF3tT-4Gk5v4KOvp7TTZBcXPBxM/edit?usp=drive_link')"><i class="fas fa-building"></i><span>1.H. Bagian Umum</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Perencanaan','https://docs.google.com/spreadsheets/d/1ulLlq0HIbF6S1H4ghGQOaSJ4o7VGbdMR0IhRhH7m2uM/edit?usp=drive_link')"><i class="fas fa-file-invoice-dollar"></i><span>1.I. Bagian Perencanaan dan Keuangan</span></a>

        <div class="group-header">Badan & Lembaga</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Sekretariat DPRD', 'https://docs.google.com/spreadsheets/d/15SL5ijXqu_9ucBX3boYTiKYeV1rLODSsgP7dm-j_Rvw/edit?usp=drive_link')"><i class="fas fa-gavel"></i><span>2. Sekretariat DPRD</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Inspektorat Daerah', 'https://docs.google.com/spreadsheets/d/133OFaTrQU4UZXsSZ02UUHtUp8E0JIfxeoScWPNIiKb4/edit?usp=drive_link')"><i class="fas fa-magnifying-glass"></i><span>3. Inspektorat Daerah</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('BAPPERIDA', 'https://docs.google.com/spreadsheets/d/1rOuVGVjbNHeLYaGrnaY0Ie19zAG5oZAzZ91aCbMJ5yA/edit?usp=drive_link')"><i class="fas fa-lightbulb"></i><span>4. Badan Perencanaan Pembangunan, Riset & Inovasi</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Bapenda', 'https://docs.google.com/spreadsheets/d/1cPomouTYvBC4nw3uQictWOyg_ATOdc7owk6KZOXHnXo/edit?usp=drive_link')"><i class="fas fa-wallet"></i><span>5. Badan Pendapatan Daerah</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('BKAD', 'https://docs.google.com/spreadsheets/d/1ns-avLJkAGytOXa7ja7jr7z_utMJmwkTAfIehaIg8Gg/edit?usp=drive_link')"><i class="fas fa-money-bill-wave"></i><span>6. Badan Keuangan dan Aset Daerah</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('BKPSDM', 'https://docs.google.com/spreadsheets/d/17x_5tBxIbL6BNNO-_ncHHROg4fdDOq5qGOtNB_pUm3c/edit?usp=drive_link')"><i class="fas fa-user-tie"></i><span>7. BKPSDM</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('BPBD', 'https://docs.google.com/spreadsheets/d/1Wrp2u7A-n-zlE6nUUzagpM25eHludtv8TNZOcBjLMUw/edit?usp=drive_link')"><i class="fas fa-triangle-exclamation"></i><span>8. Badan Penanggulangan Bencana Daerah</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Bakesbangpol', 'https://docs.google.com/spreadsheets/d/1OMseGCDU0lhubZMuAAeK2d4khRSPVnqYxJQ8LPm4JBA/edit?usp=drive_link')"><i class="fas fa-flag"></i><span>9. Badan Kesatuan Bangsa dan Politik</span></a>
        
        <div class="group-header">Dinas - Dinas</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas Pendidikan', 'https://docs.google.com/spreadsheets/d/1LjY4xHYk_Nb0U8j7n9QDH3U3oD0sxCwpdPnPf_WQToM/edit?usp=drive_link')"><i class="fas fa-graduation-cap"></i><span>10. Dinas Pendidikan dan Kebudayaan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas Kesehatan', 'https://docs.google.com/spreadsheets/d/1vo9HAWzJRU2OWbPHcmLJnLpRZL2gqXOGZ-mthcQpPSE/edit?usp=drive_link')"><i class="fas fa-heartbeat"></i><span>11. Dinas Kesehatan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas PUPP', 'https://docs.google.com/spreadsheets/d/1goXZPybhW-RAHZgEvNpp4LWqiu18TCXPbP7iSGHZacs/edit?usp=drive_link')"><i class="fas fa-trowel-bricks"></i><span>12. Dinas PU dan Perumahan Permukiman</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Satpol PP', 'https://docs.google.com/spreadsheets/d/1NlSifU6aCLkBlcSp0zfQl8Lb4iHuyXy68bWf1SZfioA/edit?usp=drive_link')"><i class="fas fa-shield-halved"></i><span>13. Satuan Polisi Pamong Praja</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas Sosial', 'https://docs.google.com/spreadsheets/d/1adZbpIbLbPevKXOdYOAOvUEeFttT1_z2gnU3aj1I39Q/edit?usp=drive_link')"><i class="fas fa-hands-helping"></i><span>14. Dinas Sosial</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Disnaker', 'https://docs.google.com/spreadsheets/d/1IfqVEngnP1PXEwlKAEyMRdpuPxdDpQ8vCSchvIdFC4w/edit?usp=drive_link')"><i class="fas fa-briefcase"></i><span>15. Dinas Ketenagakerjaan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('DP3A', 'https://docs.google.com/spreadsheets/d/1SRe_iqZRVEXEV44x59ts3nZ__BEMIOssKxr7hCzLZxI/edit?usp=drive_link')"><i class="fas fa-children"></i><span>16. Dinas Pemberdayaan Perempuan & Perlindungan Anak</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas Pertanian', 'https://docs.google.com/spreadsheets/d/1Gq6g0RjYLs-7wAbLx0gs9K4D5qMAyJmpYa53Q3HLKEI/edit?usp=drive_link')"><i class="fas fa-seedling"></i><span>17. Dinas Pertanian dan Ketahanan Pangan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('DLH', 'https://docs.google.com/spreadsheets/d/16Gz2daTvv4finSH-9e6uV3ULgSJy55_PsW91OSjiv5M/edit?usp=drive_link')"><i class="fas fa-tree"></i><span>18. Dinas Lingkungan Hidup</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dukcapil', 'https://docs.google.com/spreadsheets/d/1x_ufbA_fmTWTLbQTK2B2aAnuIhJrULO8B7V7cGMI8ww/edit?usp=drive_link')"><i class="fas fa-id-card"></i><span>19. Dinas Kependudukan dan Pencatatan Sipil</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas PMD', 'https://docs.google.com/spreadsheets/d/1qLG1u6yY-OqkiEukyvTzeLrsRzeZsYvZRxwXGNydifE/edit?usp=drive_link')"><i class="fas fa-house-user"></i><span>20. Dinas Pemberdayaan Masyarakat dan Desa</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dishub', 'https://docs.google.com/spreadsheets/d/1NnwunbZXk8eGc1FYOB-Fxam2eFXgVEEnoPbetbP0QcI/edit?usp=drive_link')"><i class="fas fa-bus"></i><span>21. Dinas Perhubungan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kominfo', 'https://docs.google.com/spreadsheets/d/1Jjm4lqkBRI69tlnt8wj9g5-3P-VZXDMMFT-YrmZjrvg/edit?usp=drive_link')"><i class="fas fa-wifi"></i><span>22. Dinas Komunikasi dan Informatika</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Diskoperindag', 'https://docs.google.com/spreadsheets/d/1T_t5HCjdUf-QHl4_I2wRQ5gecpOGEh5uxQdHqqpFWYg/edit?usp=drive_link')"><i class="fas fa-store"></i><span>23. Dinas Koperasi, Perindustrian, dan Perdagangan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('DPMPTSP', 'https://docs.google.com/spreadsheets/d/164vnWeQQZnd6TUmkaFvbxUlAzjnNhnTRAxXM6GmBHg0/edit?usp=drive_link')"><i class="fas fa-file-signature"></i><span>24. DPMPTSP (Penanaman Modal & PTSP)</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Disparpora', 'https://docs.google.com/spreadsheets/d/1TP6LbqgrhUbDY7HLboF5led_9erA78WI70tBHKeHIrk/edit?usp=drive_link')"><i class="fas fa-person-running"></i><span>25. Dinas Pariwisata, Pemuda dan Olahraga</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Perpusip', 'https://docs.google.com/spreadsheets/d/14UtUJRoSzbZim_kbxFNW_1o0S-1nA6VpV30UwpvYq_M/edit?usp=drive_link')"><i class="fas fa-book"></i><span>26. Dinas Perpustakaan dan Kearsipan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas Peternakan', 'https://docs.google.com/spreadsheets/d/1dgsQAhV8HYJzwJIAVjcT_Fr4zKrvbHUQXTV5X4Bjs2Y/edit?usp=drive_link')"><i class="fas fa-cow"></i><span>27. Dinas Peternakan dan Perikanan</span></a>

        <div class="group-header">Rumah Sakit Daerah</div>
        <a class="bio-btn" onclick="konfirmasiBuka('RSUD Abdoer Rahem', 'https://docs.google.com/spreadsheets/d/1v8rWtp1vFqnP_B8ityXoWFgTLmDLBSTgomEsiQE9GLA/edit?usp=drive_link')"><i class="fas fa-hospital"></i><span>28. RSUD dr. Abdoer Rahem</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('RSUD Besuki', 'https://docs.google.com/spreadsheets/d/1hmTxT7RS7r8hBklkkr-Ks6DL1mKExZZ4bMwxaAZEzV4/edit?usp=drive_link')"><i class="fas fa-hospital-user"></i><span>29. RSUD Besuki</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('RSUD Asembagus', 'https://docs.google.com/spreadsheets/d/1w9_s9QeFxSKRYTI6uebGR2LAyiZeUrqRJFHrJbZs5LA/edit?usp=drive_link')"><i class="fas fa-square-h"></i><span>30. RSUD Asembagus</span></a>

        <div class="group-header">Kecamatan</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Arjasa', 'https://docs.google.com/spreadsheets/d/1-vht-Bi821t-iWAXBkEONW2iiO0D-2KHwOCRqF3Dy68/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>31. Kecamatan Arjasa</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Asembagus', 'https://docs.google.com/spreadsheets/d/1LYAHSAsBUXl5I_4XbJaesDOwJ55Vqr2Z9JtNTK4wxi4/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>32. Kecamatan Asembagus</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Banyuglugur', 'https://docs.google.com/spreadsheets/d/1t7fc6xygO9Txs3ichXO9wfBPEFVwftZJ2eOakyHPqrU/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>33. Kecamatan Banyuglugur</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Banyuputih', 'https://docs.google.com/spreadsheets/d/12fpdLtPYuaDzqQGCVyHTaKdiEBHmy0jX-mCasHyQMns/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>34. Kecamatan Banyuputih</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Bungatan', 'https://docs.google.com/spreadsheets/d/1NB28LHaugxzyIMZ6kbD99G5pqgKQYw03OPTxLK9Y2gw/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>35. Kecamatan Bungatan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Besuki', 'https://docs.google.com/spreadsheets/d/18OOb3G6EbTWiMl51Bb-gV3M6A300GJyIkoyXlFc-6hw/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>36. Kecamatan Besuki</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Jangkar', 'https://docs.google.com/spreadsheets/d/1_bLo-2mT5JyoyfQ64EmnnaJEqP56PyxsEQuII2B3M3k/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>37. Kecamatan Jangkar</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Jatibanteng', 'https://docs.google.com/spreadsheets/d/11E-FdEb0UTZPFWI26mcCROhNa2r-01SUQy-dlj68FWQ/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>38. Kecamatan Jatibanteng</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Kapongan', 'https://docs.google.com/spreadsheets/d/1pSA6uHkcvdm6gI1ZqUak-jaTxAqI9znFV480555Sc1w/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>39. Kecamatan Kapongan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Kendit', 'https://docs.google.com/spreadsheets/d/1HGOxKodIwnfNMVkkYwXM26QF6_Nx3rVV3giFwbROJmo/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>40. Kecamatan Kendit</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Mangaran', 'https://docs.google.com/spreadsheets/d/1xmjrBdvFURFOG_HQqggrwINNymcHteC2SLIQVgAydF8/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>41. Kecamatan Mangaran</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Mlandingan', 'https://docs.google.com/spreadsheets/d/1WdyTjQR9ewMFWKn3eVfrkSgjqbKvFO77AhtiFkCp_1c/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>42. Kecamatan Mlandingan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Panarukan', 'https://docs.google.com/spreadsheets/d/1TriFWzrZoqFav34ElteWbbxOV_6a0byQ_iaFsFgEDFE/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>43. Kecamatan Panarukan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Panji', 'https://docs.google.com/spreadsheets/d/1NRD5nJ6vrsBk1fdNwYogkGK56bC0TT4tRYnDwB2smv4/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>44. Kecamatan Panji</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Situbondo', 'https://docs.google.com/spreadsheets/d/1ltgDia0scbzZkWwpiVvA79pJrEwlOw8s2C15uKu7J04/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>45. Kecamatan Situbondo</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Suboh', 'https://docs.google.com/spreadsheets/d/11h1YG9Ini7Kp2kaheDKHeen-N39RZltFCkSUyCkKw28/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>46. Kecamatan Suboh</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Sumbermalang', 'https://docs.google.com/spreadsheets/d/1-rusccfOjriNI9_q7B-PA41V3FdpIcNgQRRfxme6fqQ/edit?usp=drive_link')"><i class="fas fa-map-location-dot"></i><span>47. Kecamatan Sumbermalang</span></a>
        
        <div id="noResult" class="no-result">
          <i class="fas fa-search-minus"></i>
          <p>Maaf, perangkat daerah yang Anda cari tidak ditemukan.</p>
        </div>

      </div>

    </div>

    <!-- Single WhatsApp Button -->
    <div class="float-wa-single" id="waButton">
      <i class="fab fa-whatsapp"></i>
      <div class="wa-badge">2</div>
    </div>

    <div class="footer">
      <p>SITUBONDO NAIK KELAS  <br> &copy; 2025 Tim Penyusun LKPJ</p>
    </div>
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      var countDownDate = new Date("Jan 13, 2026 23:59:59").getTime();
      var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("days").innerHTML = String(days).padStart(2, '0');
        document.getElementById("hours").innerHTML = String(hours).padStart(2, '0');
        document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0');
        document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0');

        if (distance < 0) {
          clearInterval(x);
          document.getElementById("countdown").innerHTML = "<span style='font-weight:800; letter-spacing:1px;'>WAKTU PELAPORAN BERAKHIR</span>";
        }
      }, 1000);

      // 2. Fungsi Filter Pencarian (Search)
      function filterFunction() {
        var input, filter, div, a, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("linkList");
        a = div.getElementsByTagName("a");
        
        var visibleCount = 0;

        for (i = 0; i < a.length; i++) {
          txtValue = a[i].textContent || a[i].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "flex";
            visibleCount++;
          } else {
            a[i].style.display = "none";
          }
        }

        // Menyembunyikan judul grup (header) jika sedang mencari sesuatu
        var headers = document.getElementsByClassName("group-header");
        for (var k = 0; k < headers.length; k++) {
            if (filter !== "") {
                headers[k].style.display = "none";
            } else {
                headers[k].style.display = "block";
            }
        }

        var noResultDiv = document.getElementById("noResult");
        if (visibleCount === 0 && filter !== "") {
            noResultDiv.style.display = "block";
            noResultDiv.style.animation = "fadeInDown 0.3s ease-out";
        } else {
            noResultDiv.style.display = "none";
        }
      }

      // 3. Fungsi Alert Keren (SweetAlert2)
      function konfirmasiBuka(namaDinas, url) {
    if (url === '#' || url === '' || !url) {
        alert('Mohon maaf, link untuk ' + namaDinas + ' belum diinput oleh admin.');
        return; 
    }
    
    window.open(url, '_blank'); 
}
      
      // 4. Fungsi WhatsApp Admin Selection
      document.getElementById('waButton').addEventListener('click', function() {
        Swal.fire({
          title: 'Pilih Admin WhatsApp',
          html: `<div style="text-align:left; margin-top:15px;">
                   <p style="margin-bottom:15px; color:#666; font-size:14px;">Pilih admin yang ingin Anda hubungi:</p>
                   
                   <div class="wa-option" onclick="pilihAdmin('Admin 1', '6282131187041')">
                     <i class="fab fa-whatsapp"></i>
                     <div class="wa-option-info">
                       <div class="wa-option-name">Admin 1 <span class="wa-option-tag">Admin Web</span></div>
                       <div class="wa-option-number">+62 821-3118-7041</div>
                     </div>
                     <i class="fas fa-chevron-right" style="color:#999;"></i>
                   </div>

                   <div class="wa-option" onclick="pilihAdmin('Admin 2', '6282141225949')">
                     <i class="fab fa-whatsapp"></i>
                     <div class="wa-option-info">
                       <div class="wa-option-name">Admin 2 <span class="wa-option-tag">UTAMA</span></div>
                       <div class="wa-option-number">+62 821-4122-5949</div>
                     </div>
                     <i class="fas fa-chevron-right" style="color:#999;"></i>
                   </div>
                   
                   <div class="wa-option" onclick="pilihAdmin('Admin 3', '6281336059797')">
                     <i class="fab fa-whatsapp"></i>
                     <div class="wa-option-info">
                       <div class="wa-option-name">Admin 3 <span class="wa-option-tag" style="background:#ffa726;">CADANGAN</span></div>
                       <div class="wa-option-number">+62 813-3605-9797</div>
                     </div>
                     <i class="fas fa-chevron-right" style="color:#999;"></i>
                   </div>
                   
                   <p style="font-size:12px; color:#999; margin-top:15px; text-align:center;">
                     <i class="fas fa-clock"></i> Respon dalam 1x24 jam
                   </p>
                 </div>`,
          showConfirmButton: false,
          showCloseButton: true,
          background: '#ffffff',
          borderRadius: '16px',
          width: '400px',
          customClass: {
            popup: 'animated fadeInUp'
          }
        });
      });

      function pilihAdmin(namaAdmin, nomor) {
        // Tutup modal pilihan admin
        Swal.close();
        
        // Tampilkan konfirmasi
        Swal.fire({
          title: `Hubungi ${namaAdmin}?`,
          html: `<div style="text-align:center;">
                   <i class="fab fa-whatsapp" style="font-size:48px;color:#25d366;margin-bottom:15px;"></i>
                   <p>Anda akan membuka WhatsApp untuk menghubungi:</p>
                   <div style="background:#f1f8e9; padding:10px; border-radius:8px; margin:15px 0;">
                     <strong>${namaAdmin}</strong><br>
                     <span style="font-size:12px; color:#666;">${formatNomor(nomor)}</span>
                   </div>
                 </div>`,
          showCancelButton: true,
          confirmButtonColor: '#25d366',
          cancelButtonColor: '#6c757d',
          confirmButtonText: '<i class="fab fa-whatsapp"></i> Buka WhatsApp',
          cancelButtonText: '<i class="fas fa-times"></i> Batal',
          background: '#ffffff',
          borderRadius: '16px'
        }).then((result) => {
          if (result.isConfirmed) {
            const message = `Halo Admin, saya butuh bantuan terkait pengisian LKPJ Bupati Situbondo 2025.`;
            const waUrl = `https://wa.me/${nomor}?text=${encodeURIComponent(message)}`;
            window.open(waUrl, '_blank');
          }
        });
      }

      function formatNomor(nomor) {
        // Format: +62 821 4122 5949
        return nomor.replace(/(\d{2})(\d{3})(\d{4})(\d{4})/, '+$1 $2-$3-$4');
      }
    </script>
  </body>
</html>