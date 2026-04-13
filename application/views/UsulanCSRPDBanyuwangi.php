<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Usulan CSR PD - Banyuwangi</title>

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
        -webkit-tap-highlight-color: transparent;
      }
      
      body {
        min-height: 100vh;
        margin: 0;
        padding: 0;
        color: white;
        background-color: #0f172a; 
        overflow-x: hidden;
      }

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

      body::after {
          content: "";
          position: fixed;
          top: 0; left: 0; width: 100%; height: 100%;
          background: linear-gradient(45deg, rgba(10, 25, 47, 0.85), rgba(28, 70, 145, 0.65));
          z-index: -1;
          backdrop-filter: blur(2px);
      }
      
      .app-container {
        max-width: 480px;
        width: 100%;
        margin: 0 auto;
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

      .link-list { display: flex; flex-direction: column; gap: 12px; }
      
      .bio-btn {
        display: flex;
        align-items: center;
        width: 100%;
        background-color: var(--btn-bg);
        color: var(--btn-text);
        padding: 16px 20px;
        border-radius: 16px;
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

      /* Tombol WA yang dipindah ke atas (versi non-floating) */
      .wa-top-container {
        text-align: center;
        margin: 0 auto 10px auto;
      }

      .float-wa-single {
          width: 65px;
          height: 65px;
          background: linear-gradient(135deg, #25d366, #128c7e);
          color: white;
          border-radius: 50%;
          font-size: 30px;
          box-shadow: 0 6px 20px rgba(37, 211, 102, 0.5);
          display: inline-flex;
          align-items: center;
          justify-content: center;
          text-decoration: none !important;
          cursor: pointer;
          border: 3px solid white;
          position: relative;
          transition: all 0.3s;
      }
      
      .float-wa-single:hover {
          transform: scale(1.08);
          box-shadow: 0 10px 30px rgba(37, 211, 102, 0.6);
      }
      
      .float-wa-single:active {
          transform: scale(0.96);
      }
      
      .wa-label {
        margin-top: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #25d366;
        text-shadow: 0 1px 4px rgba(0,0,0,0.4);
        letter-spacing: 0.5px;
      }

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

      @media (max-width: 400px) {
        .app-container { padding: 30px 15px; }
        .site-title { font-size: 22px; }
        .bio-btn { padding: 14px 16px; font-size: 13px; }
        .search-input { font-size: 13px; }
        .float-wa-single { width: 58px; height: 58px; font-size: 26px; }
      }
    </style>
  </head>
  <body>

    <div class="app-container">
      
      <div class="header-section">
        <div class="logo-wrapper">
            <img class="profile-image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Banyuwangi_Regency_coat_of_arms.svg/250px-Banyuwangi_Regency_coat_of_arms.svg.png" alt="Logo Banyuwangi">
        </div>
        <h1 class="site-title">USULAN CSR PERANGKAT DAERAH</h1>
        <p class="site-desc">Perangkat Daerah Kabupaten Banyuwangi</p>
        <p class="site-desc" style="font-size: 11px; color: #fbff00; margin-top: 5px;">*Silakan klik tautan untuk mengakses form usulan CSR masing-masing OPD/Kecamatan</p>
      </div>

    <div class="wa-top-container">
      <div class="float-wa-single" id="waButton">
        <i class="fab fa-whatsapp"></i>
      </div>
      <div class="wa-label">Kontak Admin CSR</div>
    </div>

      <div class="search-container">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="search-input" id="searchInput" onkeyup="filterFunction()" placeholder="Cari OPD / Kecamatan / Dinas...">
      </div>

      <div class="link-list" id="linkList">
        
        <div class="group-header">🏛️ SEKRETARIAT & PENDUKUNG</div>
        
        <div class="bio-btn" data-nama="Sekretariat DPRD" data-url="https://docs.google.com/spreadsheets/d/1svQKJm9zf1QMD7DXqLGaBcMTO4u-ytryFDy6fPuyL48/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-gavel"></i><span>Sekretariat DPRD</span>
        </div>
        <div class="bio-btn" data-nama="Sekretariat Daerah" data-url="https://docs.google.com/spreadsheets/d/1sKN5uAcK0y8958KNngz0E8bW3WxjHJvJxqhYUglCq5k/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-landmark"></i><span>Sekretariat Daerah</span>
        </div>
        <div class="bio-btn" data-nama="Satuan Polisi Pamong Praja" data-url="https://docs.google.com/spreadsheets/d/1TVAaxkF2zItxamBBpJkJhaVYyQuiqrfTwjNvLrKejcM/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-shield"></i><span>Satuan Polisi Pamong Praja</span>
        </div>
        <div class="bio-btn" data-nama="Inspektorat" data-url="https://docs.google.com/spreadsheets/d/1OMsP-nxt9aT_zSGAtRspFiAiGhz2li20NWrDP7WFtrs/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-clipboard-list"></i><span>Inspektorat</span>
        </div>

        <div class="group-header">🏫 DINAS-DINAS</div>
        
        <div class="bio-btn" data-nama="Dinas Tenaga Kerja, Transmigrasi dan Perindustrian" data-url="https://docs.google.com/spreadsheets/d/1akltCwdWzIRrCO9OWa6N2oz7ZFsBlfMqinYeci6YY0o/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-industry"></i><span>Dinas Tenaga Kerja, Transmigrasi & Perindustrian</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Sosial, Pemberdayaan Perempuan dan Keluarga Berencana" data-url="https://docs.google.com/spreadsheets/d/15CHjz1KD8BpijKpgH_Vs2pw_4dZLBT_coyDWx6J1TQg/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-female"></i><span>Dinas Sosial, Pemberdayaan Perempuan & KB</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Pertanian dan Pangan" data-url="https://docs.google.com/spreadsheets/d/1rPuTATemLoEm-LeAD6BxYWwB5o_3XMOTz7Bxu_UJL8A/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-seedling"></i><span>Dinas Pertanian dan Pangan</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Perpustakaan dan Kearsipan" data-url="https://docs.google.com/spreadsheets/d/1aVvKe4VTRWhXIFw2ySew5y1Iy4MHijNQ_mYtOROB9qw/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-book"></i><span>Dinas Perpustakaan dan Kearsipan</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Perikanan" data-url="https://docs.google.com/spreadsheets/d/1Utj-HR-BMczPfXz1kXqbZOyD9aW1gP3pYHKroR85Vyg/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-fish"></i><span>Dinas Perikanan</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Perhubungan" data-url="https://docs.google.com/spreadsheets/d/1Y8JsWaW6_BKCPd3mDCtmGgct1DlTroGEKK3s_pXaCUg/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-bus"></i><span>Dinas Perhubungan</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Pendidikan" data-url="https://docs.google.com/spreadsheets/d/1trwPHGBrStDw4Aa-tujkXhA9bxfsSXkY7PBlUBFm_ow/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-graduation-cap"></i><span>Dinas Pendidikan</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu" data-url="https://docs.google.com/spreadsheets/d/1-neJ6p7ViSC8vzo_TJEZ2e763yUtTqvw_ViQezHaa5w/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-file-signature"></i><span>Dinas Penanaman Modal & PTSP</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Pemuda dan Olahraga" data-url="https://docs.google.com/spreadsheets/d/1UNhA1IjL84P9mxPR9h5paXKUlO53qroHZcjL7-yRxcw/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-futbol"></i><span>Dinas Pemuda dan Olahraga</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Pemberdayaan Masyarakat dan Desa" data-url="https://docs.google.com/spreadsheets/d/1MSEW-VUsx_AINCnqzf6gDwC8Bs58qGGlaclQ97kg-Ik/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-users"></i><span>Dinas Pemberdayaan Masyarakat dan Desa</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Pemadam Kebakaran dan Penyelamatan" data-url="https://drive.google.com/open?id=1AlB589hJzFB5VeZFKxwka_DOJA-nPGpXZI4NPT5lcXs&usp=drive_copy" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-fire-extinguisher"></i><span>Dinas Pemadam Kebakaran & Penyelamatan</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Pekerjaan Umum Pengairan" data-url="https://docs.google.com/spreadsheets/d/1LaLHeDIGKfzWb3nPs5YNV4umRlNpp4VKfavegWkrwNQ/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-water"></i><span>Dinas PU Pengairan</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Pekerjaan Umum Cipta karya, Perumahan Dan Permukiman" data-url="https://docs.google.com/spreadsheets/d/16rjJ9DsafCsMkbMTbs4O5EV1QQ73OrhSWLTJ6HjUqpQ/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-hard-hat"></i><span>Dinas PU Cipta Karya & Perumahan</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Lingkungan Hidup" data-url="https://docs.google.com/spreadsheets/d/1JFVQ6GX4ZDZHWQMJJmcVg9TfUifR3TEFrGgjTwMwdE4/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-leaf"></i><span>Dinas Lingkungan Hidup</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Koperasi, Usaha Mikro dan Perdagangan" data-url="https://docs.google.com/spreadsheets/d/1rbQPgjVKB7hDwHOA8xOKQvt7J69Cpsgh7TD35NySw2c/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-store"></i><span>Dinas Koperasi, UM & Perdagangan</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Komunikasi, Informatika dan Persandian" data-url="https://docs.google.com/spreadsheets/d/1NxpHHJ0cp4KTAHMgVwOwUaDZ9h31QOrY0Gv9vE_Zvb8/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-laptop-code"></i><span>Dinas Kominfo & Persandian</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Kesehatan" data-url="https://docs.google.com/spreadsheets/d/1hhpAUbptBNn5YWEU4nK5Mg84w3leuUDMlJVvWphhJV4/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-hospital-user"></i><span>Dinas Kesehatan</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Kependudukan dan Pencatatan Sipil" data-url="https://docs.google.com/spreadsheets/d/11rr_zypcmDJPlohMWQcNuOaKnsQ_RxxQyzNkwj2ROE0/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-id-card"></i><span>Dinas Kependudukan & Catatan Sipil</span>
        </div>
        <div class="bio-btn" data-nama="Dinas Kebudayaan dan Pariwisata" data-url="https://docs.google.com/spreadsheets/d/1IX5SxPRfuWthh55omEgiJ6unt1ytxcS3A2KArkGTdbM/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-umbrella-beach"></i><span>Dinas Kebudayaan dan Pariwisata</span>
        </div>

        <div class="group-header">🏢 BADAN-BADAN</div>
        
        <div class="bio-btn" data-nama="Badan Perencanaan Pembangunan Daerah" data-url="https://docs.google.com/spreadsheets/d/1GIWLVKHkTtXXMdFgV6n_iJ4pmrwqDE4PZgDKC8uSIlQ/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-chart-line"></i><span>Bappeda</span>
        </div>
        <div class="bio-btn" data-nama="Badan Pengelolaan Keuangan dan Aset Daerah" data-url="https://docs.google.com/spreadsheets/d/1W41kFK6U3RQUtnx_B8CFYPQZvmHJ3ezjP1AzzKzfkf0/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-coins"></i><span>BPKAD</span>
        </div>
        <div class="bio-btn" data-nama="Badan Pendapatan Daerah" data-url="https://docs.google.com/spreadsheets/d/1EV45IwQfiw75XSpAalqjsbOQa-7G1u8iauqaNiX4Bzg/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-receipt"></i><span>Bapenda</span>
        </div>
        <div class="bio-btn" data-nama="Badan Penangulangan Bencana Daerah" data-url="https://docs.google.com/spreadsheets/d/1nUTcZxNmAf1jNJl0tBALq74vxwRKJVfaMgn5wbQx6BE/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-tornado"></i><span>BPBD</span>
        </div>
        <div class="bio-btn" data-nama="Badan Kesatuan Bangsa dan Politik" data-url="https://docs.google.com/spreadsheets/d/142iKSYVhYsIKPtjwmFJhlNFYFZPpK9zwbUjnxvkr6Pk/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-flag-checkered"></i><span>Bakesbangpol</span>
        </div>
        <div class="bio-btn" data-nama="Badan Kepegawaian, Pendidikan dan Pelatihan" data-url="https://docs.google.com/spreadsheets/d/11RAy7FCNzYAGixRyvyK7QnFchyEl9-kQuxi3Gpzb7zQ/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-user-graduate"></i><span>BKPSDM (Badan Kepegawaian)</span>
        </div>

        <div class="group-header">🗺️ KECAMATAN</div>
        
        <div class="bio-btn" data-nama="Kecamatan Wongsorejo" data-url="https://docs.google.com/spreadsheets/d/1Y84ti-qefEbb_ghhFjEHiWgUJ6zsZ1HfigLOW5Cr-ZM/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Wongsorejo</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Tegalsari" data-url="https://docs.google.com/spreadsheets/d/1RjW-kncjQ_8PqLAn0TiNiUSa1br9ePwVDSJOGxArKOI/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Tegalsari</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan TegalDlimo" data-url="https://docs.google.com/spreadsheets/d/1TTz6dKOsuKHwNRsB9Zcklrn9Mb_Z2_BKvGrBVof90kI/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan TegalDlimo</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Srono" data-url="https://docs.google.com/spreadsheets/d/1i7QaDJ8DhUGLexncK7k_moHl47IGKbAbgRzlF7LJB0k/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Srono</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Songgon" data-url="https://docs.google.com/spreadsheets/d/193dqkI_CQqUXDsBI_CCEWQK4eKZ65c43Gkdjo0BjrVY/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Songgon</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Singojuruh" data-url="https://docs.google.com/spreadsheets/d/1TV0X4U2edlUsqEZsLoJGgqYi4NpsF4Gcya0g7E9N-Cc/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Singojuruh</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Siliragung" data-url="https://docs.google.com/spreadsheets/d/1SxTtRSRP6QrBiv12scN0oRaQFEY-iMSAiQkUTRfavdY/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Siliragung</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Sempu" data-url="https://docs.google.com/spreadsheets/d/1ut7xxIBXJK3xHDYqyYgVTpCx7m0GTyOTTGD1lCDehSk/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Sempu</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Rogojampi" data-url="https://docs.google.com/spreadsheets/d/1U2nZFaHcllplPv6-cmiYruuBtcjb2eAOWA00UNqdTVA/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Rogojampi</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Purwoharjo" data-url="https://docs.google.com/spreadsheets/d/1lRSzRXvPVmYYg5UVYEnufXKA9kObSsilBmeYzjSpfXc/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Purwoharjo</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Pesanggaran" data-url="https://docs.google.com/spreadsheets/d/1yKVf9m4beiKMS4sjdk6--37bIHMZPHY3I07WQfJ8rvw/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Pesanggaran</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Muncar" data-url="https://docs.google.com/spreadsheets/d/1lJ16TedD0cXQZbw8tR3pjmOLWe1QKiDjvbxjuWDtc0A/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Muncar</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Licin" data-url="https://docs.google.com/spreadsheets/d/123OrnLrudEezPsJvHsd3-wYLHaIji2qU96gjYp6PwL8/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Licin</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Kalipuro" data-url="https://docs.google.com/spreadsheets/d/1a31tEA00q0XCnhv6LTtoinx5JZaUqHbIqde3GseZEpo/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Kalipuro</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Kalibaru" data-url="https://docs.google.com/spreadsheets/d/1QnephVC7mu-sbs1JAYoHRjq_GgLumVLjv4lQwQgVTsg/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Kalibaru</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Kabat" data-url="https://docs.google.com/spreadsheets/d/1YmG1DbEQRvlQABmnJNS6GkUowcD126UiY2Mb_1STzwY/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Kabat</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Glenmore" data-url="https://docs.google.com/spreadsheets/d/1dPZcJsTnWVXc2s0_UCS5EA2zxs47iVotjyDc88MdcuY/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Glenmore</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Glagah" data-url="https://docs.google.com/spreadsheets/d/1DzQy7_xTVVWC5iz4Narqtue-ijQ_fmHKwAY1Z6UwOAQ/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Glagah</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Giri" data-url="https://docs.google.com/spreadsheets/d/1GOVVaXkF3y05G8nNXUrqb88cEan1jARCHjOXFhc-f_o/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Giri</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Genteng" data-url="https://docs.google.com/spreadsheets/d/1dOGLmfIg6oNppqq7a_GRrtOPcgU93vGvRLUIN58rNA8/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Genteng</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Gambiran" data-url="https://docs.google.com/spreadsheets/d/1kAbOHjjpSQTADp6bKbInwm0yMLHvKu3oFI52mCdZops/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Gambiran</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Cluring" data-url="https://docs.google.com/spreadsheets/d/1TnmPRpdF4SA0kSiwCm8T8MaBOvq7C8mIiGx1vV7sA_Q/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Cluring</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Blimbingsari" data-url="https://docs.google.com/spreadsheets/d/1_5K3iIKN6-Kd3_AR-icwPuAw3N7JV7YrZYoBZkQaEsk/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Blimbingsari</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Banyuwangi" data-url="https://docs.google.com/spreadsheets/d/1E9G9Jr2AyyD3a7CNqWgd5ke5iQetnWe-12j7hTGgg4U/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Banyuwangi</span>
        </div>
        <div class="bio-btn" data-nama="Kecamatan Bangorejo" data-url="https://docs.google.com/spreadsheets/d/1gK7OWu9xGIBW_NUo8_vV__Y7x8vAMsji0bxCvrtxdTs/edit?usp=drive_link" onclick="konfirmasiBuka(this.getAttribute('data-nama'), this.getAttribute('data-url'))">
            <i class="fas fa-map-marker-alt"></i><span>Kecamatan Bangorejo</span>
        </div>
        
        <div id="noResult" class="no-result">
          <i class="fas fa-search-minus"></i>
          <p>Perangkat daerah atau kecamatan yang Anda cari tidak ditemukan.</p>
        </div>

      </div>

    </div>

    <div class="footer">
      <p><i class="fas fa-handshake"></i> Portal Usulan CSR Perangkat Daerah © 2026 <br> Kabupaten Banyuwangi</p>
    </div>
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      function filterFunction() {
        var input, filter, div, btn, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("linkList");
        btn = div.getElementsByClassName("bio-btn");
        
        var visibleCount = 0;

        for (i = 0; i < btn.length; i++) {
          txtValue = btn[i].textContent || btn[i].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            btn[i].style.display = "flex";
            visibleCount++;
          } else {
            btn[i].style.display = "none";
          }
        }

        var headers = document.getElementsByClassName("group-header");
        for (var k = 0; k < headers.length; k++) {
            if (filter !== "") {
                headers[k].style.display = "none";
            } else {
                headers[k].style.display = "inline-block";
            }
        }

        var noResultDiv = document.getElementById("noResult");
        if (visibleCount === 0 && filter !== "") {
            noResultDiv.style.display = "block";
        } else {
            noResultDiv.style.display = "none";
        }
      }

      function konfirmasiBuka(namaOpd, url) {
        if (!url || url.trim() === "") {
          Swal.fire({
            icon: 'info',
            title: 'Tautan Belum Tersedia',
            text: `Maaf, tautan usulan CSR untuk ${namaOpd} belum diinput.`,
            confirmButtonColor: '#1a73e8'
          });
          return;
        }
        
        Swal.fire({
          title: `Buka Form Usulan ${namaOpd}?`,
          html: `Anda akan diarahkan ke Google Sheets<br><strong>${namaOpd}</strong>`,
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#25d366',
          cancelButtonColor: '#6c757d',
          confirmButtonText: '<i class="fas fa-external-link-alt"></i> Buka Link',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.open(url, '_blank');
          }
        });
      }
      
      document.getElementById('waButton').addEventListener('click', function() {
        Swal.fire({
          title: 'Pilih Admin CSR',
          html: `<div style="text-align:left; margin-top:15px;">
                   <p style="margin-bottom:15px; color:#666; font-size:14px;">Pilih admin yang ingin Anda hubungi:</p>
                   
                   <div class="wa-option" onclick="pilihAdmin('Admin 1', '6282131187041')">
                     <i class="fab fa-whatsapp"></i>
                     <div class="wa-option-info">
                       <div class="wa-option-name">Admin 1 <span class="wa-option-tag">CSR</span></div>
                       <div class="wa-option-number">+62 821-3118-7041</div>
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
          width: '400px'
        });
      });

      function pilihAdmin(namaAdmin, nomor) {
        Swal.close();
        
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
            const message = `Halo Admin, saya ingin konsultasi mengenai usulan CSR Perangkat Daerah Kabupaten Banyuwangi.`;
            const waUrl = `https://wa.me/${nomor}?text=${encodeURIComponent(message)}`;
            window.open(waUrl, '_blank');
          }
        });
      }

      function formatNomor(nomor) {
        return nomor.replace(/(\d{2})(\d{3})(\d{4})(\d{4})/, '+$1 $2-$3-$4');
      }
    </script>
  </body>
</html>