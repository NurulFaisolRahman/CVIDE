<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
  <title>Usulan CSR PD - Banyuwangi | Dropdown Kompak</title>
  
  <!-- Google Fonts & Font Awesome -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      -webkit-tap-highlight-color: transparent;
    }

    body {
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      background: #0a0f1c;
      position: relative;
      overflow-x: hidden;
    }

    /* Background elegan, tidak terlalu ramai */
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=1932&auto=format&fit=crop') center/cover no-repeat;
      filter: brightness(0.4) saturate(1.1);
      z-index: -2;
    }

    body::after {
      content: "";
      position: fixed;
      inset: 0;
      background: linear-gradient(125deg, rgba(12, 27, 54, 0.85), rgba(26, 55, 96, 0.7));
      backdrop-filter: blur(2px);
      z-index: -1;
    }

    /* CONTAINER – ukuran tidak terlalu lebar (maks 520px, nyaman di HP & desktop) */
    .app-container {
      max-width: 520px;
      width: 92%;
      margin: 1.5rem auto;
      padding: 1.5rem 1.2rem 2.2rem;
      background: rgba(15, 25, 45, 0.6);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-radius: 2rem;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.4);
      transition: all 0.2s;
    }

    /* Header lebih padat dan proporsional */
    .header-section {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .profile-image {
      width: 85px;
      height: 85px;
      object-fit: contain;
      background: #ffffff;
      padding: 6px;
      border-radius: 60px;
      border: 2px solid rgba(255, 215, 150, 0.8);
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2);
    }

    .site-title {
      font-size: 1.45rem;
      font-weight: 800;
      margin: 12px 0 4px;
      letter-spacing: -0.2px;
      background: linear-gradient(135deg, #FFFFFF, #BFDBFE);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .site-desc {
      font-size: 0.74rem;
      line-height: 1.4;
      color: #e2edff;
      opacity: 0.9;
      max-width: 95%;
      margin: 0 auto;
    }

    .badge-note {
      background: rgba(255, 200, 80, 0.18);
      display: inline-block;
      padding: 3px 12px;
      border-radius: 40px;
      font-size: 0.65rem;
      margin-top: 10px;
      color: #FFE6A3;
      font-weight: 500;
    }

    /* Search — tidak melebar, rapi */
    .search-container {
      position: relative;
      margin: 18px 0 22px;
    }

    .search-input {
      width: 100%;
      padding: 12px 16px 12px 44px;
      border: none;
      border-radius: 40px;
      background: rgba(255, 255, 255, 0.97);
      font-size: 0.85rem;
      font-weight: 500;
      color: #0e293b;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: 0.2s;
    }

    .search-input:focus {
      outline: none;
      background: white;
      box-shadow: 0 6px 14px rgba(0, 100, 200, 0.2);
    }

    .search-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #1e6fdf;
      font-size: 1rem;
    }

    /* DROPDOWN – compact, rapi, tidak berdempetan */
    .dropdown-group {
      margin-bottom: 12px;
      border-radius: 24px;
      background: transparent;
    }

    .dropdown-header {
      background: rgba(255, 255, 255, 0.96);
      border-radius: 28px;
      padding: 10px 18px;
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      transition: all 0.18s ease;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.6);
    }

    .dropdown-header:hover {
      background: white;
      transform: translateY(-1px);
      box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
    }

    .dropdown-header:active {
      transform: scale(0.98);
    }

    .dropdown-header i:first-child {
      font-size: 1.15rem;
      width: 28px;
      text-align: center;
      color: #1a66c9;
    }

    .dropdown-header .group-title {
      flex: 1;
      font-weight: 700;
      font-size: 0.88rem;
      letter-spacing: -0.2px;
      color: #122b3c;
    }

    .dropdown-header .group-badge {
      font-size: 0.7rem;
      background: #eef3ff;
      padding: 2px 8px;
      border-radius: 30px;
      color: #1e5ea8;
      font-weight: 600;
      margin-left: 8px;
    }

    .dropdown-header .toggle-icon {
      font-size: 0.75rem;
      color: #5f6f8c;
      transition: transform 0.25s;
    }

    .dropdown-header.active .toggle-icon {
      transform: rotate(180deg);
    }

    /* SUBMENU — padding proporsional, tidak mepet */
    .submenu-list {
      background: rgba(255, 255, 255, 0.96);
      backdrop-filter: blur(8px);
      border-radius: 22px;
      margin-top: 8px;
      padding: 8px 6px;
      display: none;
      flex-direction: column;
      gap: 6px;
      border: 1px solid rgba(255, 255, 255, 0.7);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .submenu-list.show {
      display: flex;
    }

    /* tombol sub-item lebih padat tetapi tetap nyaman disentuh */
    .sub-item {
      display: flex;
      align-items: center;
      gap: 10px;
      background: #ffffff;
      padding: 10px 14px;
      border-radius: 20px;
      cursor: pointer;
      transition: all 0.12s linear;
      border: 1px solid #edf2f9;
    }

    .sub-item:hover {
      background: #f1f9ff;
      border-color: #cde0fe;
      transform: translateX(3px);
    }

    .sub-item:active {
      transform: scale(0.98);
      background: #e6f0fe;
    }

    .sub-item i {
      width: 26px;
      font-size: 0.9rem;
      text-align: center;
      color: #1e6fdf;
    }

    .sub-item span {
      flex: 1;
      font-size: 0.8rem;
      font-weight: 500;
      color: #1f384b;
      line-height: 1.3;
    }

    .sub-item .arrow-hint {
      font-size: 0.65rem;
      color: #8aa0bc;
      opacity: 0.6;
    }

    /* no result & footer rapi */
    .no-result {
      text-align: center;
      background: rgba(0, 0, 0, 0.55);
      backdrop-filter: blur(8px);
      padding: 20px 12px;
      border-radius: 32px;
      margin: 14px 0;
      display: none;
      font-size: 0.8rem;
      color: #ffe3b3;
    }

    .footer {
      text-align: center;
      margin-top: 28px;
      font-size: 0.65rem;
      opacity: 0.75;
      font-weight: 500;
      color: #cddef5;
      border-top: 0.5px solid rgba(255,255,255,0.2);
      padding-top: 16px;
    }

    /* untuk layar sangat kecil (HP kecil) */
    @media (max-width: 460px) {
      .app-container {
        width: 95%;
        padding: 1.2rem 0.9rem 1.8rem;
        margin: 1rem auto;
      }
      .sub-item {
        padding: 8px 12px;
      }
      .dropdown-header {
        padding: 8px 16px;
      }
      .group-title {
        font-size: 0.82rem;
      }
      .site-title {
        font-size: 1.3rem;
      }
      .profile-image {
        width: 72px;
        height: 72px;
      }
    }

    /* tidak ada efek lebar berlebih */
    ::-webkit-scrollbar {
      width: 4px;
    }
  </style>
</head>
<body>
<div class="app-container">
  
  <div class="header-section">
    <img class="profile-image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Banyuwangi_Regency_coat_of_arms.svg/250px-Banyuwangi_Regency_coat_of_arms.svg.png" alt="Lambang Banyuwangi">
    <h1 class="site-title">USULAN PERANGKAT DAERAH</h1>
    <p class="site-desc">
      Usulan ini berupa kegiatan/aktivitas yang menunjang pencapaian tujuan dan sasaran pembangunan daerah yang nantinya dapat dikolaborasikan pendanaannya dengan pihak ketiga baik csr, KPBU, Kerjasama Antar Daerah (KAD), Pembiayaan Kreatif (Creative Financing), Program Sinergi Pusat-Daerah, Kemitraan dengan Sektor Swasta dan Masyarakat (Public-Private Partnership), dll.
    </p>
    <div class="badge-note">
      <i class="fas fa-chevron-circle-down"></i> Klik grup → Pilih OPD/Kecamatan
    </div>
  </div>


  <div id="dynamicMenuContainer"></div>
  

  <div class="footer">
    <i class=""></i> Portal Usulan Perangkat Daerah • Banyuwangi 2027
  </div>
</div>

<script>
  // ========================= DATA MENU ==========================
  // struktur grup dengan data lengkap, ukuran dropdown compact
  const menuGroups = [
    {
      groupLabel: "SEKRETARIAT & PENDUKUNG",
      icon: "fa-landmark",
      items: [
        { name: "Sekretariat DPRD", url: "https://docs.google.com/spreadsheets/d/1svQKJm9zf1QMD7DXqLGaBcMTO4u-ytryFDy6fPuyL48/edit?usp=drive_link", icon: "fa-gavel" },
        { name: "Sekretariat Daerah", url: "https://docs.google.com/spreadsheets/d/1sKN5uAcK0y8958KNngz0E8bW3WxjHJvJxqhYUglCq5k/edit?usp=drive_link", icon: "fa-building" },
        { name: "Inspektorat", url: "https://docs.google.com/spreadsheets/d/1OMsP-nxt9aT_zSGAtRspFiAiGhz2li20NWrDP7WFtrs/edit?usp=drive_link", icon: "fa-clipboard-list" },
        { name: "Satuan Polisi Pamong Praja", url: "https://docs.google.com/spreadsheets/d/1TVAaxkF2zItxamBBpJkJhaVYyQuiqrfTwjNvLrKejcM/edit?usp=drive_link", icon: "fa-shield-alt" }
      ]
    },
    {
      groupLabel: " DINAS DINAS",
      icon: "fa-building",
      items: [
        { name: "Dinas Tenaga Kerja, Transmigrasi & Perindustrian", url: "https://docs.google.com/spreadsheets/d/1akltCwdWzIRrCO9OWa6N2oz7ZFsBlfMqinYeci6YY0o/edit?usp=drive_link", icon: "fa-industry" },
        { name: "Dinas Sosial, Pemberdayaan Perempuan & KB", url: "https://docs.google.com/spreadsheets/d/15CHjz1KD8BpijKpgH_Vs2pw_4dZLBT_coyDWx6J1TQg/edit?usp=drive_link", icon: "fa-female" },
        { name: "Dinas Pertanian dan Pangan", url: "https://docs.google.com/spreadsheets/d/1rPuTATemLoEm-LeAD6BxYWwB5o_3XMOTz7Bxu_UJL8A/edit?usp=drive_link", icon: "fa-seedling" },
        { name: "Dinas Perpustakaan dan Kearsipan", url: "https://docs.google.com/spreadsheets/d/1aVvKe4VTRWhXIFw2ySew5y1Iy4MHijNQ_mYtOROB9qw/edit?usp=drive_link", icon: "fa-book" },
        { name: "Dinas Perikanan", url: "https://docs.google.com/spreadsheets/d/1Utj-HR-BMczPfXz1kXqbZOyD9aW1gP3pYHKroR85Vyg/edit?usp=drive_link", icon: "fa-fish" },
        { name: "Dinas Perhubungan", url: "https://docs.google.com/spreadsheets/d/1Y8JsWaW6_BKCPd3mDCtmGgct1DlTroGEKK3s_pXaCUg/edit?usp=drive_link", icon: "fa-bus" },
        { name: "Dinas Pendidikan", url: "https://docs.google.com/spreadsheets/d/1trwPHGBrStDw4Aa-tujkXhA9bxfsSXkY7PBlUBFm_ow/edit?usp=drive_link", icon: "fa-graduation-cap" },
        { name: "Dinas Penanaman Modal & PTSP", url: "https://docs.google.com/spreadsheets/d/1-neJ6p7ViSC8vzo_TJEZ2e763yUtTqvw_ViQezHaa5w/edit?usp=drive_link", icon: "fa-file-signature" },
        { name: "Dinas Pemuda dan Olahraga", url: "https://docs.google.com/spreadsheets/d/1UNhA1IjL84P9mxPR9h5paXKUlO53qroHZcjL7-yRxcw/edit?usp=drive_link", icon: "fa-futbol" },
        { name: "Dinas Pemberdayaan Masyarakat dan Desa", url: "https://docs.google.com/spreadsheets/d/1MSEW-VUsx_AINCnqzf6gDwC8Bs58qGGlaclQ97kg-Ik/edit?usp=drive_link", icon: "fa-users" },
        { name: "Dinas Pemadam Kebakaran & Penyelamatan", url: "https://drive.google.com/open?id=1AlB589hJzFB5VeZFKxwka_DOJA-nPGpXZI4NPT5lcXs&usp=drive_copy", icon: "fa-fire-extinguisher" },
        { name: "Dinas PU Pengairan", url: "https://docs.google.com/spreadsheets/d/1LaLHeDIGKfzWb3nPs5YNV4umRlNpp4VKfavegWkrwNQ/edit?usp=drive_link", icon: "fa-water" },
        { name: "Dinas PU Cipta Karya & Perumahan", url: "https://docs.google.com/spreadsheets/d/16rjJ9DsafCsMkbMTbs4O5EV1QQ73OrhSWLTJ6HjUqpQ/edit?usp=drive_link", icon: "fa-hard-hat" },
        { name: "Dinas Lingkungan Hidup", url: "https://docs.google.com/spreadsheets/d/1JFVQ6GX4ZDZHWQMJJmcVg9TfUifR3TEFrGgjTwMwdE4/edit?usp=drive_link", icon: "fa-leaf" },
        { name: "Dinas Koperasi, UM & Perdagangan", url: "https://docs.google.com/spreadsheets/d/1rbQPgjVKB7hDwHOA8xOKQvt7J69Cpsgh7TD35NySw2c/edit?usp=drive_link", icon: "fa-store" },
        { name: "Dinas Kominfo & Persandian", url: "https://docs.google.com/spreadsheets/d/1NxpHHJ0cp4KTAHMgVwOwUaDZ9h31QOrY0Gv9vE_Zvb8/edit?usp=drive_link", icon: "fa-laptop-code" },
        { name: "Dinas Kesehatan", url: "https://docs.google.com/spreadsheets/d/1hhpAUbptBNn5YWEU4nK5Mg84w3leuUDMlJVvWphhJV4/edit?usp=drive_link", icon: "fa-hospital-user" },
        { name: "Dinas Kependudukan & Catatan Sipil", url: "https://docs.google.com/spreadsheets/d/11rr_zypcmDJPlohMWQcNuOaKnsQ_RxxQyzNkwj2ROE0/edit?usp=drive_link", icon: "fa-id-card" },
        { name: "Dinas Kebudayaan dan Pariwisata", url: "https://docs.google.com/spreadsheets/d/1IX5SxPRfuWthh55omEgiJ6unt1ytxcS3A2KArkGTdbM/edit?usp=drive_link", icon: "fa-umbrella-beach" }
      ]
    },
    {
      groupLabel: " BADAN DAERAH",
      icon: "fa-chart-line",
      items: [
        { name: "Bappeda", url: "https://docs.google.com/spreadsheets/d/1GIWLVKHkTtXXMdFgV6n_iJ4pmrwqDE4PZgDKC8uSIlQ/edit?usp=drive_link", icon: "fa-chart-line" },
        { name: "BPKAD", url: "https://docs.google.com/spreadsheets/d/1W41kFK6U3RQUtnx_B8CFYPQZvmHJ3ezjP1AzzKzfkf0/edit?usp=drive_link", icon: "fa-coins" },
        { name: "Bapenda", url: "https://docs.google.com/spreadsheets/d/1EV45IwQfiw75XSpAalqjsbOQa-7G1u8iauqaNiX4Bzg/edit?usp=drive_link", icon: "fa-receipt" },
        { name: "BPBD", url: "https://docs.google.com/spreadsheets/d/1nUTcZxNmAf1jNJl0tBALq74vxwRKJVfaMgn5wbQx6BE/edit?usp=drive_link", icon: "fa-tornado" },
        { name: "Bakesbangpol", url: "https://docs.google.com/spreadsheets/d/142iKSYVhYsIKPtjwmFJhlNFYFZPpK9zwbUjnxvkr6Pk/edit?usp=drive_link", icon: "fa-flag-checkered" },
        { name: "BKPSDM (Badan Kepegawaian)", url: "https://docs.google.com/spreadsheets/d/11RAy7FCNzYAGixRyvyK7QnFchyEl9-kQuxi3Gpzb7zQ/edit?usp=drive_link", icon: "fa-user-graduate" }
      ]
    },
    {
      groupLabel: " KECAMATAN",
      icon: "fa-map-marker-alt",
      items: [
        { name: "Kecamatan Wongsorejo", url: "https://docs.google.com/spreadsheets/d/1Y84ti-qefEbb_ghhFjEHiWgUJ6zsZ1HfigLOW5Cr-ZM/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Tegalsari", url: "https://docs.google.com/spreadsheets/d/1RjW-kncjQ_8PqLAn0TiNiUSa1br9ePwVDSJOGxArKOI/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan TegalDlimo", url: "https://docs.google.com/spreadsheets/d/1TTz6dKOsuKHwNRsB9Zcklrn9Mb_Z2_BKvGrBVof90kI/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Srono", url: "https://docs.google.com/spreadsheets/d/1i7QaDJ8DhUGLexncK7k_moHl47IGKbAbgRzlF7LJB0k/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Songgon", url: "https://docs.google.com/spreadsheets/d/193dqkI_CQqUXDsBI_CCEWQK4eKZ65c43Gkdjo0BjrVY/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Singojuruh", url: "https://docs.google.com/spreadsheets/d/1TV0X4U2edlUsqEZsLoJGgqYi4NpsF4Gcya0g7E9N-Cc/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Siliragung", url: "https://docs.google.com/spreadsheets/d/1SxTtRSRP6QrBiv12scN0oRaQFEY-iMSAiQkUTRfavdY/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Sempu", url: "https://docs.google.com/spreadsheets/d/1ut7xxIBXJK3xHDYqyYgVTpCx7m0GTyOTTGD1lCDehSk/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Rogojampi", url: "https://docs.google.com/spreadsheets/d/1U2nZFaHcllplPv6-cmiYruuBtcjb2eAOWA00UNqdTVA/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Purwoharjo", url: "https://docs.google.com/spreadsheets/d/1lRSzRXvPVmYYg5UVYEnufXKA9kObSsilBmeYzjSpfXc/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Pesanggaran", url: "https://docs.google.com/spreadsheets/d/1yKVf9m4beiKMS4sjdk6--37bIHMZPHY3I07WQfJ8rvw/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Muncar", url: "https://docs.google.com/spreadsheets/d/1lJ16TedD0cXQZbw8tR3pjmOLWe1QKiDjvbxjuWDtc0A/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Licin", url: "https://docs.google.com/spreadsheets/d/123OrnLrudEezPsJvHsd3-wYLHaIji2qU96gjYp6PwL8/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Kalipuro", url: "https://docs.google.com/spreadsheets/d/1a31tEA00q0XCnhv6LTtoinx5JZaUqHbIqde3GseZEpo/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Kalibaru", url: "https://docs.google.com/spreadsheets/d/1QnephVC7mu-sbs1JAYoHRjq_GgLumVLjv4lQwQgVTsg/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Kabat", url: "https://docs.google.com/spreadsheets/d/1YmG1DbEQRvlQABmnJNS6GkUowcD126UiY2Mb_1STzwY/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Glenmore", url: "https://docs.google.com/spreadsheets/d/1dPZcJsTnWVXc2s0_UCS5EA2zxs47iVotjyDc88MdcuY/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Glagah", url: "https://docs.google.com/spreadsheets/d/1DzQy7_xTVVWC5iz4Narqtue-ijQ_fmHKwAY1Z6UwOAQ/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Giri", url: "https://docs.google.com/spreadsheets/d/1GOVVaXkF3y05G8nNXUrqb88cEan1jARCHjOXFhc-f_o/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Genteng", url: "https://docs.google.com/spreadsheets/d/1dOGLmfIg6oNppqq7a_GRrtOPcgU93vGvRLUIN58rNA8/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Gambiran", url: "https://docs.google.com/spreadsheets/d/1kAbOHjjpSQTADp6bKbInwm0yMLHvKu3oFI52mCdZops/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Cluring", url: "https://docs.google.com/spreadsheets/d/1TnmPRpdF4SA0kSiwCm8T8MaBOvq7C8mIiGx1vV7sA_Q/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Blimbingsari", url: "https://docs.google.com/spreadsheets/d/1_5K3iIKN6-Kd3_AR-icwPuAw3N7JV7YrZYoBZkQaEsk/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Banyuwangi", url: "https://docs.google.com/spreadsheets/d/1E9G9Jr2AyyD3a7CNqWgd5ke5iQetnWe-12j7hTGgg4U/edit?usp=drive_link", icon: "fa-map-marker-alt" },
        { name: "Kecamatan Bangorejo", url: "https://docs.google.com/spreadsheets/d/1gK7OWu9xGIBW_NUo8_vV__Y7x8vAMsji0bxCvrtxdTs/edit?usp=drive_link", icon: "fa-map-marker-alt" }
      ]
    }
  ];

  // ========== FUNGSI KONFIRMASI ==========
  function confirmOpenSheet(nama, url) {
    if (!url || url.trim() === "") {
      Swal.fire({
        icon: 'info',
        title: 'Tautan belum tersedia',
        text: `Form usulan CSR untuk ${nama} masih dalam persiapan.`,
        confirmButtonColor: '#1e6fdf',
        background: '#ffffff',
        borderRadius: '1rem'
      });
      return;
    }
    Swal.fire({
      title: `Buka form ${nama}?`,
      html: `<span style="font-size:0.85rem;">Anda akan menuju Google Spreadsheet</span><br><b style="font-size:0.9rem;">${nama}</b>`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#25d366',
      cancelButtonColor: '#6c757d',
      confirmButtonText: '<i class="fas fa-external-link-alt"></i> Buka Link',
      cancelButtonText: 'Batal',
      background: '#fff',
      borderRadius: '20px'
    }).then((res) => {
      if (res.isConfirmed) window.open(url, '_blank');
    });
  }

  // ========== RENDER DROPDOWN ==========
  function renderDropdowns(searchKeyword = '') {
    const container = document.getElementById('dynamicMenuContainer');
    container.innerHTML = '';
    const filter = searchKeyword.trim().toUpperCase();
    let totalVisibleItems = 0;

    for (let group of menuGroups) {
      let filteredItems = [];
      if (filter === '') {
        filteredItems = group.items;
      } else {
        filteredItems = group.items.filter(it => it.name.toUpperCase().includes(filter));
      }
      if (filteredItems.length === 0) continue;

      totalVisibleItems += filteredItems.length;

      // elemen grup
      const groupDiv = document.createElement('div');
      groupDiv.className = 'dropdown-group';

      const header = document.createElement('div');
      header.className = 'dropdown-header';
      header.innerHTML = `
        <i class="fas ${group.icon}"></i>
        <span class="group-title">${group.groupLabel} <span class="group-badge">${filteredItems.length}</span></span>
        <i class="fas fa-chevron-down toggle-icon"></i>
      `;

      const sublist = document.createElement('div');
      sublist.className = 'submenu-list';

      filteredItems.forEach(item => {
        const subEl = document.createElement('div');
        subEl.className = 'sub-item';
        subEl.innerHTML = `
          <i class="fas ${item.icon}"></i>
          <span>${item.name}</span>
          <i class="fas fa-chevron-right arrow-hint"></i>
        `;
        subEl.addEventListener('click', (e) => {
          e.stopPropagation();
          confirmOpenSheet(item.name, item.url);
        });
        sublist.appendChild(subEl);
      });

      header.addEventListener('click', (e) => {
        e.stopPropagation();
        const isActive = header.classList.contains('active');
        if (isActive) {
          header.classList.remove('active');
          sublist.classList.remove('show');
        } else {
          header.classList.add('active');
          sublist.classList.add('show');
        }
      });

      groupDiv.appendChild(header);
      groupDiv.appendChild(sublist);
      container.appendChild(groupDiv);
    }

    const noResultDiv = document.getElementById('noResult');
    if (filter !== '' && totalVisibleItems === 0) {
      noResultDiv.style.display = 'block';
    } else {
      noResultDiv.style.display = 'none';
    }
  }

  // debounce search
  let debounce;
  function handleSearchInput() {
    clearTimeout(debounce);
    debounce = setTimeout(() => {
      const val = document.getElementById('searchInput').value;
      renderDropdowns(val);
    }, 200);
  }

  // INIT
  document.addEventListener('DOMContentLoaded', () => {
    renderDropdowns('');
    const searchBox = document.getElementById('searchInput');
    searchBox.addEventListener('input', handleSearchInput);
  });
</script>
</body>
</html>