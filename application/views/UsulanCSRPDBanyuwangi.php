<?php
// UsulanCSRPD.php
// Halaman Pusat Tautan Usulan CSR Perangkat Daerah Kabupaten Banyuwangi
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
  <title>Usulan CSR PD - Banyuwangi</title>

  <!-- Bootstrap 3 + Font Awesome 6 + Google Fonts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
      -webkit-tap-highlight-color: transparent;
    }

    :root {
      --primary-blue: #1a73e8;
      --btn-bg: rgba(255, 255, 255, 0.96);
      --btn-text: #1f2937;
      --glass-bg: rgba(255, 255, 255, 0.1);
      --glass-border: rgba(255, 255, 255, 0.25);
      --wa-color: #25d366;
    }

    body {
      min-height: 100vh;
      background-color: #0a1128;
      position: relative;
      overflow-x: hidden;
    }

    /* Background image + overlay */
    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=1932&auto=format&fit=crop') center/cover no-repeat;
      filter: brightness(0.55) saturate(1.05);
      z-index: -2;
    }

    body::after {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(6, 20, 40, 0.88), rgba(21, 65, 110, 0.8));
      backdrop-filter: blur(2px);
      z-index: -1;
    }

    /* Container utama */
    .app-container {
      max-width: 560px;
      width: 92%;
      margin: 24px auto;
      background: var(--glass-bg);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border-radius: 48px;
      border: 1px solid var(--glass-border);
      padding: 28px 20px 40px;
      box-shadow: 0 25px 40px rgba(0, 0, 0, 0.3);
    }

    /* Header */
    .header-section {
      text-align: center;
      margin-bottom: 18px;
    }

    .profile-image {
      width: 110px;
      height: 110px;
      object-fit: contain;
      background: white;
      border-radius: 50%;
      padding: 8px;
      border: 3px solid white;
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
      animation: gentleFloat 5s infinite ease-in-out;
    }

    @keyframes gentleFloat {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-6px); }
    }

    .site-title {
      font-size: 1.9rem;
      font-weight: 800;
      margin: 14px 0 5px;
      background: linear-gradient(135deg, #FFFFFF, #BFDBFE);
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: -0.5px;
    }

    .site-desc {
      font-size: 0.85rem;
      color: #e2e8f0;
      font-weight: 500;
    }

    .csr-badge {
      background: rgba(255,215,0,0.2);
      display: inline-block;
      padding: 4px 14px;
      border-radius: 40px;
      font-size: 0.7rem;
      font-weight: 600;
      color: #facc15;
      margin-top: 8px;
    }

    /* WA Contact */
    .wa-top-container {
      text-align: center;
      margin: 8px 0 12px;
    }

    .float-wa-single {
      width: 70px;
      height: 70px;
      background: linear-gradient(145deg, #25d366, #128C7E);
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 34px;
      color: white;
      box-shadow: 0 8px 18px rgba(0,0,0,0.3);
      border: 3px solid white;
      cursor: pointer;
      transition: 0.2s;
    }
    .float-wa-single:active { transform: scale(0.95); }
    .wa-label { font-size: 0.7rem; font-weight: 700; margin-top: 6px; color: #b9f6ca; text-shadow: 0 1px 2px black; }

    /* Search */
    .search-container {
      position: relative;
      margin: 18px 0 22px;
    }
    .search-input {
      width: 100%;
      padding: 14px 20px 14px 45px;
      border: none;
      border-radius: 60px;
      background: rgba(255, 255, 255, 0.96);
      font-size: 0.9rem;
      font-weight: 500;
      outline: none;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .search-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--primary-blue);
    }

    /* Daftar tombol */
    .link-list {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .bio-btn {
      display: flex;
      align-items: center;
      background: var(--btn-bg);
      padding: 14px 18px;
      border-radius: 24px;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.85rem;
      color: var(--btn-text);
      gap: 12px;
      box-shadow: 0 5px 12px rgba(0, 0, 0, 0.08);
      transition: all 0.2s;
      cursor: pointer;
      border: none;
      width: 100%;
    }
    .bio-btn i {
      font-size: 1.3rem;
      width: 32px;
      color: var(--primary-blue);
      text-align: center;
    }
    .bio-btn span { flex: 1; text-align: left; font-weight: 600; }
    .bio-btn::after {
      content: '\f054';
      font-family: 'Font Awesome 6 Free';
      font-weight: 900;
      font-size: 0.7rem;
      opacity: 0.5;
      color: #4b5563;
    }
    .bio-btn:active { transform: scale(0.98); background: #eef2ff; }

    .group-header {
      font-size: 0.7rem;
      font-weight: 800;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      display: inline-block;
      padding: 5px 16px;
      border-radius: 30px;
      color: white;
      letter-spacing: 0.5px;
      margin: 12px 0 4px;
      text-transform: uppercase;
    }

    .no-result {
      text-align: center;
      background: rgba(0, 0, 0, 0.6);
      padding: 24px;
      border-radius: 30px;
      color: white;
      display: none;
      margin-top: 16px;
    }
    .footer {
      text-align: center;
      margin-top: 35px;
      font-size: 0.7rem;
      opacity: 0.8;
      color: #cbd5e6;
    }

    @media (max-width: 480px) {
      .app-container { padding: 20px 16px 30px; }
      .site-title { font-size: 1.6rem; }
      .bio-btn { padding: 12px 14px; }
    }
  </style>
</head>
<body>

<div class="app-container">
  <div class="header-section">
    <img class="profile-image" src="https://in.pinterest.com/pin/banyuwangi-kabupaten-logo-kabupaten-banyuwangi-hd-png-download-transparent-png-image-pngitem--306455949656381045/" alt="Logo Banyuwangi" onerror="this.src='https://via.placeholder.com/110?text=Banyuwangi'">
    <h1 class="site-title"> USULAN CSR PERANGKAT DAERAH </h1>
    <p class="site-desc"> Perangkat Daerah Kabupaten Banyuwangi</p>
    <div class="csr-badge"><i class="fas fa-hand-holding-heart"></i> Portal Tautan Resmi</div>
  </div>

  <!-- Tombol WhatsApp -->
  <div class="wa-top-container">
    <div class="float-wa-single" id="waButton">
      <i class="fab fa-whatsapp"></i>
    </div>
    <div class="wa-label"><i class="fas fa-headset"></i> Kontak Admin CSR</div>
  </div>

  <!-- Search -->
  <div class="search-container">
    <i class="fas fa-search search-icon"></i>
    <input type="text" class="search-input" id="searchInput" placeholder="Cari OPD / Kecamatan / Dinas..." autocomplete="off">
  </div>

  <div class="link-list" id="linkList">
    <!-- SEMUA TAUTAN DINAMIS berdasarkan data yang diberikan -->
    <!-- Grup: Sekretariat & Pendukung -->
    <div class="group-header">🏛️ SEKRETARIAT & PENDUKUNG</div>
    <div class="bio-btn" data-nama="Sekretariat DPRD" data-url="https://docs.google.com/spreadsheets/d/1svQKJm9zf1QMD7DXqLGaBcMTO4u-ytryFDy6fPuyL48/edit?usp=drive_link"><i class="fas fa-gavel"></i><span>Sekretariat DPRD</span></div>
    <div class="bio-btn" data-nama="Sekretariat Daerah" data-url="https://docs.google.com/spreadsheets/d/1sKN5uAcK0y8958KNngz0E8bW3WxjHJvJxqhYUglCq5k/edit?usp=drive_link"><i class="fas fa-landmark"></i><span>Sekretariat Daerah</span></div>
    <div class="bio-btn" data-nama="Satuan Polisi Pamong Praja" data-url="https://docs.google.com/spreadsheets/d/1TVAaxkF2zItxamBBpJkJhaVYyQuiqrfTwjNvLrKejcM/edit?usp=drive_link"><i class="fas fa-shield"></i><span>Satuan Polisi Pamong Praja</span></div>
    <div class="bio-btn" data-nama="Inspektorat" data-url="https://docs.google.com/spreadsheets/d/1OMsP-nxt9aT_zSGAtRspFiAiGhz2li20NWrDP7WFtrs/edit?usp=drive_link"><i class="fas fa-clipboard-list"></i><span>Inspektorat</span></div>

    <div class="group-header">🏫 DINAS-DINAS</div>
    <div class="bio-btn" data-nama="Dinas Tenaga Kerja, Transmigrasi dan Perindustrian" data-url="https://docs.google.com/spreadsheets/d/1akltCwdWzIRrCO9OWa6N2oz7ZFsBlfMqinYeci6YY0o/edit?usp=drive_link"><i class="fas fa-industry"></i><span>Dinas Tenaga Kerja, Transmigrasi & Perindustrian</span></div>
    <div class="bio-btn" data-nama="Dinas Sosial, Pemberdayaan Perempuan dan Keluarga Berencana" data-url="https://docs.google.com/spreadsheets/d/15CHjz1KD8BpijKpgH_Vs2pw_4dZLBT_coyDWx6J1TQg/edit?usp=drive_link"><i class="fas fa-female"></i><span>Dinas Sosial, Pemberdayaan Perempuan & KB</span></div>
    <div class="bio-btn" data-nama="Dinas Pertanian dan Pangan" data-url="https://docs.google.com/spreadsheets/d/1rPuTATemLoEm-LeAD6BxYWwB5o_3XMOTz7Bxu_UJL8A/edit?usp=drive_link"><i class="fas fa-seedling"></i><span>Dinas Pertanian dan Pangan</span></div>
    <div class="bio-btn" data-nama="Dinas Perpustakaan dan Kearsipan" data-url="https://docs.google.com/spreadsheets/d/1aVvKe4VTRWhXIFw2ySew5y1Iy4MHijNQ_mYtOROB9qw/edit?usp=drive_link"><i class="fas fa-book"></i><span>Dinas Perpustakaan dan Kearsipan</span></div>
    <div class="bio-btn" data-nama="Dinas Perikanan" data-url="https://docs.google.com/spreadsheets/d/1Utj-HR-BMczPfXz1kXqbZOyD9aW1gP3pYHKroR85Vyg/edit?usp=drive_link"><i class="fas fa-fish"></i><span>Dinas Perikanan</span></div>
    <div class="bio-btn" data-nama="Dinas Perhubungan" data-url="https://docs.google.com/spreadsheets/d/1Y8JsWaW6_BKCPd3mDCtmGgct1DlTroGEKK3s_pXaCUg/edit?usp=drive_link"><i class="fas fa-bus"></i><span>Dinas Perhubungan</span></div>
    <div class="bio-btn" data-nama="Dinas Pendidikan" data-url="https://docs.google.com/spreadsheets/d/1trwPHGBrStDw4Aa-tujkXhA9bxfsSXkY7PBlUBFm_ow/edit?usp=drive_link"><i class="fas fa-graduation-cap"></i><span>Dinas Pendidikan</span></div>
    <div class="bio-btn" data-nama="Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu" data-url="https://docs.google.com/spreadsheets/d/1-neJ6p7ViSC8vzo_TJEZ2e763yUtTqvw_ViQezHaa5w/edit?usp=drive_link"><i class="fas fa-file-signature"></i><span>Dinas Penanaman Modal & PTSP</span></div>
    <div class="bio-btn" data-nama="Dinas Pemuda dan Olahraga" data-url="https://docs.google.com/spreadsheets/d/1UNhA1IjL84P9mxPR9h5paXKUlO53qroHZcjL7-yRxcw/edit?usp=drive_link"><i class="fas fa-futbol"></i><span>Dinas Pemuda dan Olahraga</span></div>
    <div class="bio-btn" data-nama="Dinas Pemberdayaan Masyarakat dan Desa" data-url="https://docs.google.com/spreadsheets/d/1MSEW-VUsx_AINCnqzf6gDwC8Bs58qGGlaclQ97kg-Ik/edit?usp=drive_link"><i class="fas fa-users"></i><span>Dinas Pemberdayaan Masyarakat dan Desa</span></div>
    <div class="bio-btn" data-nama="Dinas Pemadam Kebakaran dan Penyelamatan" data-url="https://drive.google.com/open?id=1AlB589hJzFB5VeZFKxwka_DOJA-nPGpXZI4NPT5lcXs&usp=drive_copy"><i class="fas fa-fire-extinguisher"></i><span>Dinas Pemadam Kebakaran & Penyelamatan</span></div>
    <div class="bio-btn" data-nama="Dinas Pekerjaan Umum Pengairan" data-url="https://docs.google.com/spreadsheets/d/1LaLHeDIGKfzWb3nPs5YNV4umRlNpp4VKfavegWkrwNQ/edit?usp=drive_link"><i class="fas fa-water"></i><span>Dinas PU Pengairan</span></div>
    <div class="bio-btn" data-nama="Dinas Pekerjaan Umum Cipta karya, Perumahan Dan Permukiman" data-url="https://docs.google.com/spreadsheets/d/16rjJ9DsafCsMkbMTbs4O5EV1QQ73OrhSWLTJ6HjUqpQ/edit?usp=drive_link"><i class="fas fa-hard-hat"></i><span>Dinas PU Cipta Karya & Perumahan</span></div>
    <div class="bio-btn" data-nama="Dinas Lingkungan Hidup" data-url="https://docs.google.com/spreadsheets/d/1JFVQ6GX4ZDZHWQMJJmcVg9TfUifR3TEFrGgjTwMwdE4/edit?usp=drive_link"><i class="fas fa-leaf"></i><span>Dinas Lingkungan Hidup</span></div>
    <div class="bio-btn" data-nama="Dinas Koperasi, Usaha Mikro dan Perdagangan" data-url="https://docs.google.com/spreadsheets/d/1rbQPgjVKB7hDwHOA8xOKQvt7J69Cpsgh7TD35NySw2c/edit?usp=drive_link"><i class="fas fa-store"></i><span>Dinas Koperasi, UM & Perdagangan</span></div>
    <div class="bio-btn" data-nama="Dinas Komunikasi, Informatika dan Persandian" data-url="https://docs.google.com/spreadsheets/d/1NxpHHJ0cp4KTAHMgVwOwUaDZ9h31QOrY0Gv9vE_Zvb8/edit?usp=drive_link"><i class="fas fa-laptop-code"></i><span>Dinas Kominfo & Persandian</span></div>
    <div class="bio-btn" data-nama="Dinas Kesehatan" data-url="https://docs.google.com/spreadsheets/d/1hhpAUbptBNn5YWEU4nK5Mg84w3leuUDMlJVvWphhJV4/edit?usp=drive_link"><i class="fas fa-hospital-user"></i><span>Dinas Kesehatan</span></div>
    <div class="bio-btn" data-nama="Dinas Kependudukan dan Pencatatan Sipil" data-url="https://docs.google.com/spreadsheets/d/11rr_zypcmDJPlohMWQcNuOaKnsQ_RxxQyzNkwj2ROE0/edit?usp=drive_link"><i class="fas fa-id-card"></i><span>Dinas Kependudukan & Catatan Sipil</span></div>
    <div class="bio-btn" data-nama="Dinas Kebudayaan dan Pariwisata" data-url="https://docs.google.com/spreadsheets/d/1IX5SxPRfuWthh55omEgiJ6unt1ytxcS3A2KArkGTdbM/edit?usp=drive_link"><i class="fas fa-umbrella-beach"></i><span>Dinas Kebudayaan dan Pariwisata</span></div>

    <div class="group-header">🏢 BADAN-BADAN</div>
    <div class="bio-btn" data-nama="Badan Perencanaan Pembangunan Daerah" data-url="https://docs.google.com/spreadsheets/d/1GIWLVKHkTtXXMdFgV6n_iJ4pmrwqDE4PZgDKC8uSIlQ/edit?usp=drive_link"><i class="fas fa-chart-line"></i><span>Bappeda</span></div>
    <div class="bio-btn" data-nama="Badan Pengelolaan Keuangan dan Aset Daerah" data-url="https://docs.google.com/spreadsheets/d/1W41kFK6U3RQUtnx_B8CFYPQZvmHJ3ezjP1AzzKzfkf0/edit?usp=drive_link"><i class="fas fa-coins"></i><span>BPKAD</span></div>
    <div class="bio-btn" data-nama="Badan Pendapatan Daerah" data-url="https://docs.google.com/spreadsheets/d/1EV45IwQfiw75XSpAalqjsbOQa-7G1u8iauqaNiX4Bzg/edit?usp=drive_link"><i class="fas fa-receipt"></i><span>Bapenda</span></div>
    <div class="bio-btn" data-nama="Badan Penangulangan Bencana Daerah" data-url="https://docs.google.com/spreadsheets/d/1nUTcZxNmAf1jNJl0tBALq74vxwRKJVfaMgn5wbQx6BE/edit?usp=drive_link"><i class="fas fa-tornado"></i><span>BPBD</span></div>
    <div class="bio-btn" data-nama="Badan Kesatuan Bangsa dan Politik" data-url="https://docs.google.com/spreadsheets/d/142iKSYVhYsIKPtjwmFJhlNFYFZPpK9zwbUjnxvkr6Pk/edit?usp=drive_link"><i class="fas fa-flag-checkered"></i><span>Bakesbangpol</span></div>
    <div class="bio-btn" data-nama="Badan Kepegawaian, Pendidikan dan Pelatihan" data-url="https://docs.google.com/spreadsheets/d/11RAy7FCNzYAGixRyvyK7QnFchyEl9-kQuxi3Gpzb7zQ/edit?usp=drive_link"><i class="fas fa-user-graduate"></i><span>BKPSDM (Badan Kepegawaian)</span></div>

    <div class="group-header">🗺️ KECAMATAN</div>
    <!-- 25+ kecamatan sesuai list -->
    <div class="bio-btn" data-nama="Kecamatan Wongsorejo" data-url="https://docs.google.com/spreadsheets/d/1Y84ti-qefEbb_ghhFjEHiWgUJ6zsZ1HfigLOW5Cr-ZM/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Wongsorejo</span></div>
    <div class="bio-btn" data-nama="Kecamatan Tegalsari" data-url="https://docs.google.com/spreadsheets/d/1RjW-kncjQ_8PqLAn0TiNiUSa1br9ePwVDSJOGxArKOI/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Tegalsari</span></div>
    <div class="bio-btn" data-nama="Kecamatan TegalDlimo" data-url="https://docs.google.com/spreadsheets/d/1TTz6dKOsuKHwNRsB9Zcklrn9Mb_Z2_BKvGrBVof90kI/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan TegalDlimo</span></div>
    <div class="bio-btn" data-nama="Kecamatan Srono" data-url="https://docs.google.com/spreadsheets/d/1i7QaDJ8DhUGLexncK7k_moHl47IGKbAbgRzlF7LJB0k/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Srono</span></div>
    <div class="bio-btn" data-nama="Kecamatan Songgon" data-url="https://docs.google.com/spreadsheets/d/193dqkI_CQqUXDsBI_CCEWQK4eKZ65c43Gkdjo0BjrVY/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Songgon</span></div>
    <div class="bio-btn" data-nama="Kecamatan Singojuruh" data-url="https://docs.google.com/spreadsheets/d/1TV0X4U2edlUsqEZsLoJGgqYi4NpsF4Gcya0g7E9N-Cc/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Singojuruh</span></div>
    <div class="bio-btn" data-nama="Kecamatan Siliragung" data-url="https://docs.google.com/spreadsheets/d/1SxTtRSRP6QrBiv12scN0oRaQFEY-iMSAiQkUTRfavdY/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Siliragung</span></div>
    <div class="bio-btn" data-nama="Kecamatan Sempu" data-url="https://docs.google.com/spreadsheets/d/1ut7xxIBXJK3xHDYqyYgVTpCx7m0GTyOTTGD1lCDehSk/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Sempu</span></div>
    <div class="bio-btn" data-nama="Kecamatan Rogojampi" data-url="https://docs.google.com/spreadsheets/d/1U2nZFaHcllplPv6-cmiYruuBtcjb2eAOWA00UNqdTVA/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Rogojampi</span></div>
    <div class="bio-btn" data-nama="Kecamatan Purwoharjo" data-url="https://docs.google.com/spreadsheets/d/1lRSzRXvPVmYYg5UVYEnufXKA9kObSsilBmeYzjSpfXc/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Purwoharjo</span></div>
    <div class="bio-btn" data-nama="Kecamatan Pesanggaran" data-url="https://docs.google.com/spreadsheets/d/1yKVf9m4beiKMS4sjdk6--37bIHMZPHY3I07WQfJ8rvw/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Pesanggaran</span></div>
    <div class="bio-btn" data-nama="Kecamatan Muncar" data-url="https://docs.google.com/spreadsheets/d/1lJ16TedD0cXQZbw8tR3pjmOLWe1QKiDjvbxjuWDtc0A/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Muncar</span></div>
    <div class="bio-btn" data-nama="Kecamatan Licin" data-url="https://docs.google.com/spreadsheets/d/123OrnLrudEezPsJvHsd3-wYLHaIji2qU96gjYp6PwL8/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Licin</span></div>
    <div class="bio-btn" data-nama="Kecamatan Kalipuro" data-url="https://docs.google.com/spreadsheets/d/1a31tEA00q0XCnhv6LTtoinx5JZaUqHbIqde3GseZEpo/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Kalipuro</span></div>
    <div class="bio-btn" data-nama="Kecamatan Kalibaru" data-url="https://docs.google.com/spreadsheets/d/1QnephVC7mu-sbs1JAYoHRjq_GgLumVLjv4lQwQgVTsg/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Kalibaru</span></div>
    <div class="bio-btn" data-nama="Kecamatan Kabat" data-url="https://docs.google.com/spreadsheets/d/1YmG1DbEQRvlQABmnJNS6GkUowcD126UiY2Mb_1STzwY/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Kabat</span></div>
    <div class="bio-btn" data-nama="Kecamatan Glenmore" data-url="https://docs.google.com/spreadsheets/d/1dPZcJsTnWVXc2s0_UCS5EA2zxs47iVotjyDc88MdcuY/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Glenmore</span></div>
    <div class="bio-btn" data-nama="Kecamatan Glagah" data-url="https://docs.google.com/spreadsheets/d/1DzQy7_xTVVWC5iz4Narqtue-ijQ_fmHKwAY1Z6UwOAQ/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Glagah</span></div>
    <div class="bio-btn" data-nama="Kecamatan Giri" data-url="https://docs.google.com/spreadsheets/d/1GOVVaXkF3y05G8nNXUrqb88cEan1jARCHjOXFhc-f_o/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Giri</span></div>
    <div class="bio-btn" data-nama="Kecamatan Genteng" data-url="https://docs.google.com/spreadsheets/d/1dOGLmfIg6oNppqq7a_GRrtOPcgU93vGvRLUIN58rNA8/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Genteng</span></div>
    <div class="bio-btn" data-nama="Kecamatan Gambiran" data-url="https://docs.google.com/spreadsheets/d/1kAbOHjjpSQTADp6bKbInwm0yMLHvKu3oFI52mCdZops/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Gambiran</span></div>
    <div class="bio-btn" data-nama="Kecamatan Cluring" data-url="https://docs.google.com/spreadsheets/d/1TnmPRpdF4SA0kSiwCm8T8MaBOvq7C8mIiGx1vV7sA_Q/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Cluring</span></div>
    <div class="bio-btn" data-nama="Kecamatan Blimbingsari" data-url="https://docs.google.com/spreadsheets/d/1_5K3iIKN6-Kd3_AR-icwPuAw3N7JV7YrZYoBZkQaEsk/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Blimbingsari</span></div>
    <div class="bio-btn" data-nama="Kecamatan Banyuwangi" data-url="https://docs.google.com/spreadsheets/d/1E9G9Jr2AyyD3a7CNqWgd5ke5iQetnWe-12j7hTGgg4U/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Banyuwangi</span></div>
    <div class="bio-btn" data-nama="Kecamatan Bangorejo" data-url="https://docs.google.com/spreadsheets/d/1gK7OWu9xGIBW_NUo8_vV__Y7x8vAMsji0bxCvrtxdTs/edit?usp=drive_link"><i class="fas fa-map-marker-alt"></i><span>Kecamatan Bangorejo</span></div>

    <!-- No result message -->
    <div id="noResult" class="no-result">
      <i class="fas fa-search-minus fa-2x"></i>
      <p>Perangkat daerah atau kecamatan tidak ditemukan.</p>
    </div>
  </div>

  <div class="footer">
    <p><i class="fas fa-handshake"></i> Portal Usulan CSR Perangkat Daerah <br> BANYUWANGI BERKOLABORASI | © 2025 Tim CSR</p>
  </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Fungsi buka link dengan SweetAlert konfirmasi
  function bukaLink(namaOpd, url) {
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
      html: `Anda akan diarahkan ke Google Sheets <br> <strong>${namaOpd}</strong>`,
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

  // Pasang event listener ke semua .bio-btn
  document.querySelectorAll('.bio-btn').forEach(btn => {
    const nama = btn.getAttribute('data-nama') || btn.innerText.trim();
    const url = btn.getAttribute('data-url') || '';
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      bukaLink(nama, url);
    });
  });

  // Fungsi Pencarian
  function filterList() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toUpperCase().trim();
    const btns = document.querySelectorAll('.bio-btn');
    const headers = document.querySelectorAll('.group-header');
    let visibleCount = 0;

    btns.forEach(btn => {
      const text = btn.innerText.toUpperCase();
      if (filter === "" || text.indexOf(filter) > -1) {
        btn.style.display = "flex";
        visibleCount++;
      } else {
        btn.style.display = "none";
      }
    });

    // Sembunyikan header saat mencari
    headers.forEach(h => {
      if (filter !== "") h.style.display = "none";
      else h.style.display = "inline-block";
    });

    const noResultDiv = document.getElementById('noResult');
    if (visibleCount === 0 && filter !== "") {
      noResultDiv.style.display = "block";
    } else {
      noResultDiv.style.display = "none";
    }
  }

  const searchInput = document.getElementById('searchInput');
  searchInput.addEventListener('keyup', filterList);

  // WA Multi Admin (sama seperti style sebelumnya)
  const waBtn = document.getElementById('waButton');
  if (waBtn) {
    waBtn.addEventListener('click', () => {
      Swal.fire({
        title: 'Pilih Admin CSR',
        html: `<div style="text-align:left">
          <div class="wa-opt" data-nomor="6282131187041" data-nama="Admin 1" style="display:flex;align-items:center;gap:12px;background:#f1f5f9;padding:10px;border-radius:16px;margin-bottom:12px;cursor:pointer">
            <i class="fab fa-whatsapp fa-2x" style="color:#25d366"></i><div><strong>Admin 1</strong><span style="background:#25d366;margin-left:8px;padding:2px 8px;border-radius:20px;color:white;font-size:10px">CSR</span><div style="font-size:12px">+62 821-3118-7041</div></div><i class="fas fa-chevron-right"></i>
          </div>
        </div>`,
        showConfirmButton: false,
        showCloseButton: true,
        background: '#fff',
        borderRadius: '20px'
      });
      setTimeout(() => {
        document.querySelectorAll('.wa-opt').forEach(el => {
          el.addEventListener('click', (e) => {
            const nomor = el.getAttribute('data-nomor');
            const namaAdmin = el.getAttribute('data-nama');
            Swal.close();
            Swal.fire({
              title: `Hubungi ${namaAdmin}?`,
              text: `Kirim pesan via WhatsApp terkait usulan CSR.`,
              icon: 'question',
              showCancelButton: true,
              confirmButtonColor: '#25d366',
              confirmButtonText: 'Ya, Buka WA'
            }).then(res => {
              if (res.isConfirmed) {
                const msg = "Halo Admin, saya ingin konsultasi mengenai usulan CSR Perangkat Daerah Banyuwangi.";
                window.open(`https://wa.me/${nomor}?text=${encodeURIComponent(msg)}`, '_blank');
              }
            });
          });
        });
      }, 100);
    });
  }
</script>
</body>
</html>