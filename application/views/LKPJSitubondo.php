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
            --btn-bg: rgba(255, 255, 255, 0.9);
            --btn-text: #333333;
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.2);
            --wa-color: #25d366;
        }
      
      * {
        font-family: 'Inter', sans-serif;
        box-sizing: border-box;
      }
      
      body {
        min-height: 100vh;
        margin: 0;
        padding: 0;
        color: white;
        position: relative;
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
          background: linear-gradient(
              45deg, 
              rgba(10, 25, 47, 0.85), 
              rgba(28, 70, 145, 0.6), 
              rgba(60, 20, 80, 0.5),
              rgba(10, 25, 47, 0.85)
          );
          background-size: 400% 400%;
          animation: gradientBG 15s ease infinite;
          z-index: -1;
          backdrop-filter: blur(2px);
      }

      @keyframes gradientBG {
          0% { background-position: 0% 50%; }
          50% { background-position: 100% 50%; }
          100% { background-position: 0% 50%; }
      }
      
      /* Container */
      .app-container {
        max-width: 480px;
        margin: 20px auto;
        padding: 40px 25px;
        min-height: calc(100vh - 40px);
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 1;
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-radius: 24px;
        border: 1px solid var(--glass-border);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2), 
                    inset 0 0 20px rgba(255,255,255,0.05);
      }
      
      /* Header */
      .header-section {
        text-align: center;
        margin-bottom: 30px;
        position: relative;
      }
      
      .logo-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
      }

      .profile-image {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.8);
        object-fit: contain;
        background-color: white;
        padding: 5px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        animation: floatIcon 6s ease-in-out infinite;
      }

      @keyframes floatIcon {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
      }

      .logo-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 160px;
        height: 160px;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        z-index: -1;
        filter: blur(10px);
      }
      
      .site-title {
        font-size: 26px;
        font-weight: 800;
        margin: 0 0 8px 0;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        letter-spacing: 0.5px;
        background: linear-gradient(to right, #ffffff, #a0c4ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      
      .site-desc {
        font-size: 15px;
        opacity: 0.9;
        margin: 0;
        font-weight: 400;
        color: #e0e0e0;
        letter-spacing: 0.3px;
      }

      /* Countdown */
      .countdown-wrapper {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 18px;
        padding: 18px;
        margin: 20px 0 30px 0;
        display: flex;
        justify-content: center;
        gap: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      }

      .countdown-item {
        text-align: center;
        min-width: 55px;
      }

      .countdown-number {
        display: block;
        font-size: 24px;
        font-weight: 800;
        line-height: 1;
        color: #fff;
        text-shadow: 0 2px 5px rgba(0,0,0,0.3);
      }

      .countdown-label {
        font-size: 11px;
        text-transform: uppercase;
        opacity: 0.8;
        margin-top: 6px;
        display: block;
        letter-spacing: 1px;
        font-weight: 600;
      }

      /* Search Box */
      .search-container {
        position: relative;
        margin-bottom: 25px;
      }
      
      .search-input {
        width: 100%;
        padding: 16px 20px 16px 50px;
        border-radius: 50px;
        border: 2px solid transparent;
        background: rgba(255, 255, 255, 0.9);
        outline: none;
        font-size: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
        color: #333;
      }

      .search-input:focus {
        background: white;
        border-color: var(--primary-blue);
        box-shadow: 0 8px 25px rgba(26, 115, 232, 0.2);
      }

      .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-blue);
        font-size: 18px;
        z-index: 2;
      }

      /* Button List */
      .link-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
      }
      
      .bio-btn {
        display: flex;
        align-items: center;
        width: 100%;
        background-color: var(--btn-bg);
        color: var(--btn-text);
        padding: 18px 22px;
        border-radius: 50px;
        text-decoration: none !important;
        font-weight: 600;
        font-size: 14px; /* Sedikit diperkecil agar nama dinas panjang muat */
        line-height: 1.4;
        box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        border: none;
        cursor: pointer;
      }
      
      .bio-btn:hover {
        transform: translateY(-3px) scale(1.01);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15), 0 0 15px rgba(255, 255, 255, 0.3);
        background-color: white;
      }
      
      .bio-btn i {
        font-size: 20px;
        width: 38px;
        text-align: center;
        margin-right: 8px;
        color: var(--primary-blue);
        transition: 0.3s;
        flex-shrink: 0; /* Agar icon tidak mengecil/gepeng */
      }
      
      .bio-btn span {
        flex: 1;
        text-align: left;
        /* Hapus white-space: nowrap agar teks panjang bisa turun ke bawah (multiline) */
        /* white-space: nowrap; */ 
      }
      
      .bio-btn::after {
        content: '\f054'; 
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 14px;
        opacity: 0.4;
        transition: 0.3s;
        color: var(--primary-blue);
        margin-left: 10px;
      }

      .bio-btn:hover::after {
        opacity: 1;
        transform: translateX(5px);
      }

      /* Group Header */
      .group-header {
        font-size: 12px;
        font-weight: 700;
        color: #a0c4ff;
        margin-top: 15px;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding-left: 10px;
      }

      /* Floating WA */
      .float-wa {
          position: fixed;
          width: 60px;
          height: 60px;
          bottom: 30px;
          right: 30px;
          background-color: var(--wa-color);
          color: #FFF;
          border-radius: 50px;
          text-align: center;
          font-size: 32px;
          box-shadow: 0 4px 10px rgba(0,0,0,0.3);
          z-index: 1000;
          display: flex;
          align-items: center;
          justify-content: center;
          text-decoration: none !important;
          transition: all 0.3s ease;
          animation: pulse-wa 2s infinite;
      }

      .float-wa:hover {
          background-color: #128c7e;
          transform: scale(1.1);
          color: white;
      }

      .wa-tooltip {
          position: absolute;
          right: 70px;
          background: rgba(255, 255, 255, 0.9);
          color: #333;
          padding: 5px 12px;
          border-radius: 8px;
          font-size: 12px;
          font-weight: 600;
          white-space: nowrap;
          box-shadow: 0 2px 5px rgba(0,0,0,0.2);
          opacity: 0;
          transition: opacity 0.3s;
          pointer-events: none;
      }

      .float-wa:hover .wa-tooltip {
          opacity: 1;
      }

      @keyframes pulse-wa {
          0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
          70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
          100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
      }

      .no-result {
        text-align: center;
        padding: 30px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        display: none;
        color: white;
        border: 1px dashed rgba(255,255,255,0.3);
      }
      
      .no-result i {
        font-size: 40px;
        margin-bottom: 15px;
        opacity: 0.8;
        color: #a0c4ff;
      }

      .footer {
        text-align: center;
        margin-top: auto;
        padding-top: 50px;
        font-size: 13px;
        opacity: 0.8;
        font-weight: 500;
        letter-spacing: 1px;
      }
    </style>
  </head>
  <body>

    <div class="app-container">
      
      <div class="header-section">
        <div class="logo-wrapper">
            <div class="logo-glow"></div>
            <img class="profile-image" src="https://situbondo.info/wp-content/uploads/2024/04/logo-kabupaten-situbondo-png-3-2.png" alt="Logo Situbondo">
        </div>
        <h1 class="site-title">LKPJ BUPATI 2025</h1>
        <p class="site-desc">Laporan Keterangan Pertanggungjawaban Bupati Situbondo Tahun 2025</p>
        <p class="site-desc" style="font-size: 12px; color: #fbff00; margin-top: 5px;">*Dimohon untuk mengisi data sesuai masing masing OPD</p>
      </div>

      <div class="countdown-wrapper" id="countdown">
        <div class="countdown-item">
          <span class="countdown-number" id="days">00</span>
          <span class="countdown-label">HARI</span>
        </div>
        <div class="countdown-item">
          <span class="countdown-number" id="hours">00</span>
          <span class="countdown-label">JAM</span>
        </div>
        <div class="countdown-item">
          <span class="countdown-number" id="minutes">00</span>
          <span class="countdown-label">MENIT</span>
        </div>
        <div class="countdown-item">
          <span class="countdown-number" id="seconds">00</span>
          <span class="countdown-label">DETIK</span>
        </div>
      </div>

      <div class="search-container">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="search-input" id="searchInput" onkeyup="filterFunction()" placeholder="Cari Dinas, Bagian, atau Kecamatan...">
      </div>

      <div class="link-list" id="linkList">
        
        <a class="bio-btn" style="background: linear-gradient(to right, #ffffff, #e6f0ff); border: 1px solid #1a73e8;" onclick="konfirmasiBuka('Panduan Pengisian', 'https://docs.google.com/document/d/1qxnO8zH-h4S4v8UUTe6KCu1P2SmOd7qh/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
            <i class="fas fa-book-open"></i><span><b>Panduan Pengisian Link</b></span>
        </a>

        <div class="group-header">Sekretariat Daerah</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Tata Pemerintahan', 'https://docs.google.com/spreadsheets/d/1-BFAZ39UB71AsKSkx0Tt3dq2Pk-BO9Hu/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-handshake"></i><span>1.A. Bagian Tata Pemerintahan dan Kerja Sama</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Hukum', 'https://docs.google.com/spreadsheets/d/1GBH8vxSFM4FN6xFE4f1yUi9U2iuEDDLH/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-scale-balanced"></i><span>1.B. Bagian Hukum</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Prokopim', 'https://docs.google.com/spreadsheets/d/1hDZpCaSVT_LVTsPPl-Rd3mWZxO7y1oJS/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-microphone"></i><span>1.C. Bagian Protokol dan Komunikasi Pimpinan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Kesra', 'https://docs.google.com/spreadsheets/d/1K_fl0luUQBZ8jANtcXlTRFqopL4xRs_-/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-users"></i><span>1.D. Bagian Kesejahteraan Masyarakat</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Perekonomian', 'https://docs.google.com/spreadsheets/d/1cJsTFMXQD-HAdPxDN4xi8T3zOph1XXiA/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-chart-pie"></i><span>1.E. Bagian Perekonomian, Pembangunan, SDA</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - PBJ', 'https://docs.google.com/spreadsheets/d/1Z5q0zYCYwBJHd1A46NUx7k3haTPkytpH/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-boxes-packing"></i><span>1.F. Bagian Pengadaan Barang dan Jasa</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Organisasi', 'https://docs.google.com/spreadsheets/d/1ri7_RLnpXqoL3w_CQ1d4FHlfF9OaJdmc/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-sitemap"></i><span>1.G. Bagian Organisasi</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Umum', 'https://docs.google.com/spreadsheets/d/1HJg-ae2PEZIGc4vQbQDEHXUiTlN_a6Lt/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-building"></i><span>1.H. Bagian Umum</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Perencanaan', 'https://docs.google.com/spreadsheets/d/1TUh36HUecUUmjRsLtIWccSZtJhon5Zpr/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-file-invoice-dollar"></i><span>1.I. Bagian Perencanaan dan Keuangan</span></a>

        <div class="group-header">Badan & Lembaga</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Sekretariat DPRD', 'https://docs.google.com/spreadsheets/d/1cLjtMzWSbpqaMf3zfz7shgHnbtf_Hmsm/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-gavel"></i><span>2. Sekretariat DPRD</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Inspektorat Daerah', 'https://docs.google.com/spreadsheets/d/1YPHe5MxsNLOcgjlixXa-PbP0OUtgNqK-/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-magnifying-glass"></i><span>3. Inspektorat Daerah</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('BAPPERIDA', 'https://docs.google.com/spreadsheets/d/1HgWErPCd_XFtnQ94jpJlKOeEy4ZXTZ3X/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-lightbulb"></i><span>4. Badan Perencanaan Pembangunan, Riset & Inovasi</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Bapenda', 'https://docs.google.com/spreadsheets/d/16vJQ8kgc8jULV3O8l7JEj10QSxFRbxWK/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-wallet"></i><span>5. Badan Pendapatan Daerah</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('BKAD', 'https://docs.google.com/spreadsheets/d/1TOjW7F83r2XkhF1Kfm2Xs-PPieVWDt_3/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-money-bill-wave"></i><span>6. Badan Keuangan dan Aset Daerah</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('BKPSDM', 'https://docs.google.com/spreadsheets/d/19V2CHYgEg8DvlihnzW0qEI_WnYm8go59/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-user-tie"></i><span>7. BKPSDM</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('BPBD', 'https://docs.google.com/spreadsheets/d/10Md0oUepKSa--JIeZ5SfeQOZ2Grn91sn/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-triangle-exclamation"></i><span>8. Badan Penanggulangan Bencana Daerah</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Bakesbangpol', 'https://docs.google.com/spreadsheets/d/1hBU-sNavQmf9iPQ_kOUQZ1E4aY-SNZdv/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-flag"></i><span>9. Badan Kesatuan Bangsa dan Politik</span></a>

        <div class="group-header">Dinas - Dinas</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas Pendidikan', 'https://docs.google.com/spreadsheets/d/1T2iRbA8ZuBtxNghfFmKJzAEGnhcamyqC/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-graduation-cap"></i><span>10. Dinas Pendidikan dan Kebudayaan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas Kesehatan', 'https://docs.google.com/spreadsheets/d/1j-J__5hnvZ62zwri7M7XqvHHYrqoLasX/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-heartbeat"></i><span>11. Dinas Kesehatan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas PUPP', 'https://docs.google.com/spreadsheets/d/1IWAOqE5vQEK2RlzrVbRsxRldD8Xi1E6l/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-trowel-bricks"></i><span>12. Dinas PU dan Perumahan Permukiman</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Satpol PP', 'https://docs.google.com/spreadsheets/d/1AvOj1ZvsLmehDMRnsHYEHe0U2EAHlop7/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-shield-halved"></i><span>13. Satuan Polisi Pamong Praja</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas Sosial', 'https://docs.google.com/spreadsheets/d/1Z37EN8A3ufbsAeF5nFoJvIXabkflFNU3/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-hands-helping"></i><span>14. Dinas Sosial</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Disnaker', 'https://docs.google.com/spreadsheets/d/1pMjHZj1dC02gF9aZzu3Dt6PZ-CoB6JGJ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-briefcase"></i><span>15. Dinas Ketenagakerjaan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('DP3A', 'https://docs.google.com/spreadsheets/d/1zNegwkwaGfZWhClFx49QbYjF1vZg-QxH/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-children"></i><span>16. Dinas Pemberdayaan Perempuan & Perlindungan Anak</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas Pertanian', 'https://docs.google.com/spreadsheets/d/1kmLqcQxCGdXjNJa9qxVXfb5wD0Bnnk5K/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-wheat"></i><span>17. Dinas Pertanian dan Ketahanan Pangan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('DLH', 'https://docs.google.com/spreadsheets/d/19IUUTt_21Mc-En7ekOe4DN4an0uikwSq/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-tree"></i><span>18. Dinas Lingkungan Hidup</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dukcapil', 'https://docs.google.com/spreadsheets/d/1aiqkx_ahknt8Kh-_vjCCfx2euIWvdHUQ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-id-card"></i><span>19. Dinas Kependudukan dan Pencatatan Sipil</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas PMD', 'https://docs.google.com/spreadsheets/d/1S7UesKfOkcfR7IiTyEpx1zr2o6pwXRl2/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-house-user"></i><span>20. Dinas Pemberdayaan Masyarakat dan Desa</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dishub', 'https://docs.google.com/spreadsheets/d/1BxiwYKq9jwDo95iHPbJrbxPu3dIObFQ0/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-bus"></i><span>21. Dinas Perhubungan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kominfo', 'https://docs.google.com/spreadsheets/d/1hRNqFfPP89z1ns-jxKiVu8PKPOEcjQOM/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-wifi"></i><span>22. Dinas Komunikasi dan Informatika</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Diskoperindag', 'https://docs.google.com/spreadsheets/d/1UMNFqjLbkHqxkVFdniXmXbiV6Xpjaydy/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-store"></i><span>23. Dinas Koperasi, Perindustrian, dan Perdagangan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('DPMPTSP', 'https://docs.google.com/spreadsheets/d/16iXox4BvuAzCkAJ6oO1yblqDHI0ZVTQZ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-file-signature"></i><span>24. DPMPTSP (Penanaman Modal & PTSP)</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Disparpora', 'https://docs.google.com/spreadsheets/d/1tYPAK-c0W2dkQ7FF8QD24z8jk-Fjfx-i/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-person-running"></i><span>25. Dinas Pariwisata, Pemuda dan Olahraga</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Perpusip', 'https://docs.google.com/spreadsheets/d/1rBe2ALt9uGiZCthSLkfYh6WfmxXqzaPl/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-book"></i><span>26. Dinas Perpustakaan dan Kearsipan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas Peternakan', 'https://docs.google.com/spreadsheets/d/1vNXQ0jTRJ318XtpJ4zEb8VQU6RwbHbmU/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-cow"></i><span>27. Dinas Peternakan dan Perikanan</span></a>

        <div class="group-header">Rumah Sakit Daerah</div>
        <a class="bio-btn" onclick="konfirmasiBuka('RSUD Abdoer Rahem', 'https://docs.google.com/spreadsheets/d/1m4LdqwrGSE5T0Qol_1B2J7IY5J_DF7MH/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-hospital"></i><span>28. RSUD dr. Abdoer Rahem</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('RSUD Besuki', 'https://docs.google.com/spreadsheets/d/1Qq77tf8Fv4RzytLuE0VHg5ybvOwEgfQn/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-hospital-user"></i><span>29. RSUD Besuki</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('RSUD Asembagus', 'https://docs.google.com/spreadsheets/d/1J4IGWzf_hDgxz9wXF1UBjTcxsSdNt0TA/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-square-h"></i><span>30. RSUD Asembagus</span></a>

        <div class="group-header">Kecamatan</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Arjasa', 'https://docs.google.com/spreadsheets/d/1WYTHT4W71Js6X4UmihxsmtUser438iB6/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>31. Kecamatan Arjasa</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Asembagus', 'https://docs.google.com/spreadsheets/d/17n5a5JyrZx5nqc8gEc2tdpn0LZjGpBln/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>32. Kecamatan Asembagus</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Banyuglugur', 'https://docs.google.com/spreadsheets/d/1uJ7zVAHkuVIu0S2HU9T2DNqI6ZCjugyz/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>33. Kecamatan Banyuglugur</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Banyuputih', 'https://docs.google.com/spreadsheets/d/1N8U37FqOjTO-IZbK96rghovh-UzMzpjn/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>34. Kecamatan Banyuputih</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Bungatan', 'https://docs.google.com/spreadsheets/d/1DWU0lr5J7L6s32v2-_35_pYqxvUUJyrD/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>35. Kecamatan Bungatan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Besuki', 'https://docs.google.com/spreadsheets/d/1FKWh6fRPeI4MxVcPORrTcgOg_bkQxhyE/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>36. Kecamatan Besuki</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Jangkar', 'https://docs.google.com/spreadsheets/d/1t9r8C5MxgdYxsxSNxriw2m6GUSfLVlBn/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>37. Kecamatan Jangkar</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Jatibanteng', 'https://docs.google.com/spreadsheets/d/1uecMB_rZ9Xw7WufMASfEg3GPV5Gw-6oJ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>38. Kecamatan Jatibanteng</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Kapongan', 'https://docs.google.com/spreadsheets/d/1Pg1XSkp-LzRV9ikLSJE9BFGFIl9myvtF/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>39. Kecamatan Kapongan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Kendit', 'https://docs.google.com/spreadsheets/d/1Zkh1LjfwhSpu95pe9m6KL8-aOFeofeLC/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>40. Kecamatan Kendit</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Mangaran', 'https://docs.google.com/spreadsheets/d/1uRim2LLPgxPbWaIFPvLN_PhLs8U9axRu/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>41. Kecamatan Mangaran</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Mlandingan', 'https://docs.google.com/spreadsheets/d/1x5peKR1vUMZ4QBoUIfgSt3lWObrh62pJ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>42. Kecamatan Mlandingan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Panarukan', 'https://docs.google.com/spreadsheets/d/1hY7VyukaoxLj34Z69SHhztxCLBdcFeNm/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>43. Kecamatan Panarukan</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Panji', 'https://docs.google.com/spreadsheets/d/1akedXgIk5_Xf8fs2Z8uWSNMCAd9iIrxP/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>44. Kecamatan Panji</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Situbondo', 'https://docs.google.com/spreadsheets/d/1dkqCQOvtHIhVTydBE0SH7JZ3hyi3QHIE/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>45. Kecamatan Situbondo</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Suboh', 'https://docs.google.com/spreadsheets/d/1fFcrt7Djru5aqVZbC-lJ_D2azLh75joc/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>46. Kecamatan Suboh</span></a>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Sumbermalang', 'https://docs.google.com/spreadsheets/d/1qcjn35APcoqYsL0HIKLDaUwYAPIT30Zd/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')"><i class="fas fa-map-location-dot"></i><span>47. Kecamatan Sumbermalang</span></a>

        <div id="noResult" class="no-result">
          <i class="fas fa-search-minus"></i>
          <p>Maaf, perangkat daerah yang Anda cari tidak ditemukan.</p>
        </div>

      </div>

    </div>

    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20LKPJ,%20saya%20butuh%20bantuan." class="float-wa" target="_blank">
        <i class="fab fa-whatsapp my-float"></i>
        <div class="wa-tooltip">Butuh Bantuan?</div>
    </a>

    <div class="footer">
      <p>SITUBONDO NAIK KELAS  <br> &copy; 2025 Tim Penyusun LKPJ</p>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      // 1. Fungsi Countdown
      var countDownDate = new Date("Dec 31, 2025 23:59:59").getTime();

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
          // Skip tombol WA agar tidak ikut terfilter
          if (a[i].classList.contains("float-wa")) continue;

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
        if (url === '#' || url === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Link Belum Tersedia',
                text: 'Mohon maaf, link untuk ' + namaDinas + ' belum diinput oleh admin.',
                confirmButtonColor: '#1a73e8'
            });
            return; 
        }

        Swal.fire({
          title: 'Buka Tautan?',
          html: "Anda akan diarahkan ke halaman upload data untuk:<br><b>" + namaDinas + "</b>",
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#1a73e8',
          cancelButtonColor: '#ff4757',
          confirmButtonText: 'Ya, Lanjutkan',
          cancelButtonText: 'Batal',
          background: '#fff',
          borderRadius: '20px',
          customClass: {
            popup: 'animated fadeInDown faster'
          }
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Sedang Mengalihkan...',
              html: 'Mohon tunggu sebentar.',
              timer: 800,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
              },
              willClose: () => {
                window.open(url, '_blank'); 
              }
            })
          }
        })
      }
    </script>
  </body>
</html>