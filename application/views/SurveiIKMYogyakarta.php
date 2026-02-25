<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Survei Kepuasan Masyarakat Kinerja Walikota & Wakil Walikota Kota Yogyakarta</title>
  <!-- Favicons -->
  <link href="../assets/img/favicon.ico" rel="icon">
  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/fontawesome/css/all.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    /* ===== CSS VARIABLES ===== */
    :root {
      --primary-blue: #0056b3;
      --secondary-blue: #007bff;
      --light-blue: #e7f1ff;
      --dark-blue: #003366;
      --accent-blue: #4a90e2;
      --white: #ffffff;
      --light-gray: #f8f9fa;
      --medium-gray: #e0e0e0;
      --dark-gray: #495057;
      --success-green: #28a745;
      --primary-red: #d32f2f;
      --font-family: 'Montserrat', sans-serif;
      --line-height: 1.7;
      --border-radius: 8px;
      --border-radius-lg: 12px;
      --spacing-sm: 8px;
      --spacing-md: 15px;
      --spacing-lg: 20px;
      --spacing-xl: 30px;
      --shadow-sm: 0 3px 15px rgba(0, 0, 0, 0.05);
      --shadow-md: 0 6px 30px rgba(0, 0, 0, 0.08);
      --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.15);
      --shadow-button: 0 4px 15px rgba(0, 86, 179, 0.3);
      --shadow-button-hover: 0 8px 25px rgba(0, 86, 179, 0.4);
    }

    body {
      font-family: var(--font-family);
      background-color: var(--light-gray);
      color: var(--dark-gray);
      line-height: var(--line-height);
      margin: 0;
      padding: 0;
    }

    .header-section {
      background: linear-gradient(135deg, var(--dark-blue), var(--primary-blue));
      color: var(--white);
      padding: var(--spacing-lg) 0;
      border-radius: 0 0 var(--spacing-lg) var(--spacing-lg);
      box-shadow: var(--shadow-md);
      margin-bottom: var(--spacing-xl);
    }

    .header-title {
      font-weight: 700;
      letter-spacing: 0.5px;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
      margin: 0;
    }

    .header-subtitle {
      font-weight: 400;
      opacity: 0.9;
      margin: 0;
    }

    .card {
      border-radius: var(--border-radius-lg);
      box-shadow: var(--shadow-md);
      border: none;
      overflow: hidden;
      margin-bottom: var(--spacing-xl);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background-color: var(--white);
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }

    .card-header {
      background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
      border-bottom: none;
      padding: 18px 25px;
      font-weight: 600;
      letter-spacing: 0.5px;
      font-size: 1.1rem;
      color: var(--white);
    }

    .card-body {
      padding: 25px;
    }

    .identity-card {
      border: none;
      border-radius: var(--border-radius-lg);
      background: linear-gradient(135deg, var(--white) 0%, var(--light-blue) 100%);
      box-shadow: 0 8px 32px rgba(0, 86, 179, 0.12);
      overflow: hidden;
      position: relative;
      transition: all 0.3s ease;
    }

    .identity-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 6px;
      height: 100%;
      background: linear-gradient(180deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
    }

    .identity-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 40px rgba(0, 86, 179, 0.18);
    }

    .identity-card .card-body {
      padding: var(--spacing-xl);
      position: relative;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
    }

    .identity-section-title {
      color: var(--primary-blue);
      font-weight: 700;
      font-size: 1.2rem;
      border-bottom: 3px solid transparent;
      border-image: linear-gradient(90deg, var(--primary-blue) 0%, var(--accent-blue) 100%) 1;
      padding-bottom: 12px;
      margin-bottom: 24px;
      position: relative;
      letter-spacing: 0.3px;
      text-transform: uppercase;
    }

    .identity-section-title::after {
      content: '';
      position: absolute;
      bottom: -3px;
      left: 0;
      width: 40px;
      height: 3px;
      background: linear-gradient(90deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
      border-radius: 2px;
    }

    .identity-card .form-group {
      margin-bottom: 20px;
      position: relative;
    }

    .identity-card .form-label {
      font-weight: 600;
      color: var(--dark-blue);
      margin-bottom: 8px;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .identity-card .form-control,
    .identity-card .custom-select {
      border: 2px solid var(--medium-gray);
      border-radius: 10px;
      padding: 12px 18px;
      font-size: 15px;
      background-color: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(5px);
      transition: all 0.3s ease;
      width: 100%;
      box-sizing: border-box;
    }

    .identity-card .form-control:focus,
    .identity-card .custom-select:focus {
      border-color: var(--primary-blue);
      box-shadow: 0 0 0 4px rgba(0, 86, 179, 0.1);
      background-color: var(--white);
      transform: translateY(-1px);
    }

    .identity-card .input-group {
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      border-radius: var(--border-radius);
      overflow: hidden;
      width: 100%;
    }

    .identity-card .input-group-text {
      background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
      color: var(--white);
      border: none;
      font-weight: 600;
      min-width: 140px;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
      border: none;
      color: var(--white);
      padding: 12px var(--spacing-xl);
      font-weight: 700;
      border-radius: 10px;
      transition: all 0.3s ease;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      box-shadow: 0 6px 20px rgba(0, 86, 179, 0.3);
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, var(--dark-blue) 0%, var(--primary-blue) 100%);
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(0, 86, 179, 0.4);
    }

    .btn-primary:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }

    .btn-primary:disabled:hover {
      transform: none;
      box-shadow: none;
    }

    .btn-submit {
      font-size: 1.1rem;
      padding: 15px 45px;
      border-radius: 12px;
    }

    .form-control,
    .custom-select {
      border-radius: 10px;
      border: 2px solid var(--medium-gray);
      padding: 12px var(--spacing-md);
      font-size: 15px;
      transition: all 0.3s ease;
      height: calc(2.5rem + 8px);
      background-color: var(--white);
      font-weight: 500;
    }

    .form-control:focus,
    .custom-select:focus {
      border-color: var(--primary-blue);
      box-shadow: 0 0 0 4px rgba(0, 86, 179, 0.1);
      outline: none;
      transform: translateY(-1px);
      background-color: rgba(255, 255, 255, 0.98);
    }

    .input-group-text {
      background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
      color: var(--white);
      border: none;
      font-weight: 600;
      min-width: 130px;
      justify-content: center;
      display: flex;
      align-items: center;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .question-container {
      margin-bottom: 25px;
      background-color: var(--light-blue);
      border-radius: var(--border-radius);
      padding: var(--spacing-lg);
      box-shadow: var(--shadow-sm);
      border-left: 4px solid var(--primary-blue);
      border: 1px solid var(--accent-blue);
      max-width: 100%;
      margin-left: auto;
      margin-right: auto;
    }

    .question-text {
      font-weight: 500;
      color: var(--dark-blue);
      margin-bottom: var(--spacing-md);
      font-size: 15px;
      line-height: 1.6;
    }

    .options-container {
      background-color: var(--primary-blue);
      padding: 18px;
      border-radius: var(--border-radius);
      margin-top: var(--spacing-md);
      border: 1px solid var(--accent-blue);
      max-width: 100%;
    }

    .radio-options {
      display: flex;
      flex-wrap: wrap;
      gap: var(--spacing-md);
      margin-bottom: var(--spacing-md);
      justify-content: center;
    }

    .radio-option {
      display: flex;
      align-items: center;
      background-color: transparent;
      padding: var(--spacing-sm) var(--spacing-md);
      border-radius: 6px;
      transition: all 0.2s ease;
      cursor: pointer;
      border: none;
    }

    .radio-option:hover {
      background-color: var(--secondary-blue);
      color: var(--white);
      transform: translateY(-2px);
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .radio-option label {
      font-weight: 500;
      margin-left: var(--spacing-sm);
      cursor: pointer;
      color: var(--white);
    }

    .section-title {
      color: var(--primary-blue);
      font-weight: 700;
      margin-top: var(--spacing-xl);
      margin-bottom: var(--spacing-md);
      padding-bottom: var(--spacing-sm);
      border-bottom: 2px solid var(--medium-gray);
      font-size: 1.2rem;
      letter-spacing: 0.5px;
    }

    .performance-title {
      color: var(--primary-red);
      font-weight: 600;
      font-size: 1rem;
      display: flex;
      margin-bottom: 10px;
      align-items: center;
    }

    .fab {
      position: fixed;
      bottom: var(--spacing-xl);
      right: var(--spacing-xl);
      width: 60px;
      height: 60px;
      background-color: var(--primary-red);
      color: var(--white);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      box-shadow: 0 6px 20px rgba(211, 47, 47, 0.3);
      cursor: pointer;
      z-index: 1000;
      transition: all 0.3s ease;
      border: none;
    }

    .fab:hover {
      transform: scale(1.1);
      box-shadow: 0 8px 25px rgba(211, 47, 47, 0.4);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadeIn 0.6s ease-out forwards;
    }

    ::-webkit-scrollbar {
      width: 10px;
    }

    ::-webkit-scrollbar-track {
      background: var(--light-gray);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--primary-blue);
      border-radius: 5px;
    }

    .reason-notification {
      font-size: 14px;
      color: rgb(255, 255, 255);
      margin-top: 4px;
      font-style: italic;
      animation: fadeIn 0.3s ease-out;
    }

    .is-invalid {
      border-color: #d32f2f !important;
      box-shadow: 0 0 0 0.2rem rgba(211, 47, 47, 0.25) !important;
    }

    .login-badge {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
    }

    .session-warning {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
      max-width: 400px;
      animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
      from {
        transform: translateX(100%);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @media (max-width: 768px) {
      .question-container { padding: var(--spacing-md); }
      .radio-options { flex-direction: column; gap: var(--spacing-sm); }
      .session-warning {
        top: 10px;
        right: 10px;
        left: 10px;
        max-width: none;
      }
    }

    /* Style untuk teks Unsur */
    .unsur-title {
      font-size: 1.4rem;
      font-weight: 700;
      color: var(--primary-blue);
      text-align: center;
      margin: 25px 0 20px;
      padding: 15px;
      background: var(--light-blue);
      border-radius: 10px;
      border-left: 6px solid var(--primary-blue);
      box-shadow: var(--shadow-sm);
    }
  </style>
</head>

<body>
<?php
// Inisialisasi variabel session
$isLoggedIn = isset($isLoggedIn) ? $isLoggedIn : false;
$userLevel = isset($userLevel) ? $userLevel : 0;
$userName = $this->session->userdata('nama_lengkap') ?? 'User';
?>

<!-- Login Status Badge -->
<div class="login-badge">
  <?php if ($isLoggedIn): ?>
    <div class="dropdown">
      <button class="btn btn-success dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle mr-1"></i> 
        <?= $userName ?> 
        <span class="badge badge-light ml-1">
          <?php 
            if($userLevel == 1) echo 'Superadmin';
            elseif($userLevel == 2) echo 'Admin';
            elseif($userLevel == 3) echo 'Staf';
            elseif($userLevel == 4) echo 'Surveiyor';
            else echo 'Pengunjung';
          ?>
        </span>
      </button>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#" onclick="logout()">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
      </div>
    </div>
  <?php else: ?>
    <button class="btn btn-warning" onclick="openModal('signInModal')">
      <i class="fas fa-sign-in-alt mr-1"></i> Login sebagai Surveiyor
    </button>
  <?php endif; ?>
</div>

<!-- Session Warning untuk Non-Surveiyor -->
<?php if (!$isLoggedIn || $userLevel != 4): ?>
<div class="session-warning alert alert-warning alert-dismissible fade show" role="alert">
  <i class="fas fa-exclamation-triangle mr-2"></i>
  <strong>Perhatian!</strong> 
  <?php if (!$isLoggedIn): ?>
    Anda belum login. Hanya <strong>Surveiyor (Level 4)</strong> yang dapat mengirim survei.
    <a href="#" onclick="openModal('signInModal')" class="alert-link">Login di sini</a>
  <?php elseif ($userLevel != 4): ?>
    Anda login sebagai Level <?= $userLevel ?> (<?php 
      if($userLevel == 1) echo 'Superadmin';
      elseif($userLevel == 2) echo 'Admin';
      elseif($userLevel == 3) echo 'Staf';
    ?>). Hanya <strong>Surveiyor (Level 4)</strong> yang dapat mengirim survei.
    <a href="#" onclick="logout()" class="alert-link">Logout</a> dan login sebagai Surveiyor.
  <?php endif; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<!-- Sign In Modal -->
<div id="signInModal" class="modal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(10px); z-index: 10000; align-items: center; justify-content: center;">
  <div class="modal-content" style="background: white; border-radius: 16px; width: 90%; max-width: 420px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.25);">
    <div class="modal-header" style="padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #E5E7EB;">
      <h3 class="modal-title" style="font-size: 1.4rem; font-weight: 600;">Masuk sebagai Surveiyor</h3>
      <button class="modal-close" onclick="closeModal('signInModal')" style="background: none; border: none; font-size: 1.8rem; cursor: pointer; color: #6b7280;">&times;</button>
    </div>
    <div class="modal-body" style="padding: 24px;">
      <div class="form-group" style="margin-bottom: 20px;">
        <label class="form-label" style="display: block; margin-bottom: 6px; font-weight: 500;">Username</label>
        <input type="text" class="form-input" id="Username" placeholder="Masukkan username" style="width: 100%; padding: 10px 14px; border: 1px solid #E5E7EB; border-radius: 8px; font-size: 1rem;">
      </div>
      <div class="form-group" style="margin-bottom: 20px;">
        <label class="form-label" style="display: block; margin-bottom: 6px; font-weight: 500;">Password</label>
        <input type="password" class="form-input" id="Password" placeholder="Masukkan password" style="width: 100%; padding: 10px 14px; border: 1px solid #E5E7EB; border-radius: 8px; font-size: 1rem;">
      </div>
      <button class="btn-primary" id="Masuk" style="width: 100%; padding: 12px; background: #001428; color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer;">Masuk</button>
    </div>
  </div>
</div>

  <div class="header-section text-center">
    <div class="container">
      <h2 class="header-title mb-2">Survei Kepuasan Masyarakat 
        <br>Kinerja Walikota & Wakil Walikota Kota Yogyakarta</h2>
      <h5 class="header-subtitle">Badan Kesatuan Bangsa dan Politik Kota Yogyakarta</h5>
    </div>
  </div>

  <div class="container">
    <div class="card mb-4">
      <div class="card-body">
        <p class="text-justify mb-0">
          Dalam rangka peningkatan kualitas pelayanan publik secara berkelanjutan dan memenuhi amanat PERMENPAN RB Nomor 14 Tahun 2017 tentang Pedoman Penyusunan Survei Kepuasan Masyarakat Unit Penyelenggara Pelayanan Publik, bahwa penyelenggara pelayanan publik wajib melaksanakan Survei Kepuasan Masyarakat (SKM) secara berkala minimal 1 (satu) kali setahun.
          <br><br>
          Atas dasar tersebut, dengan ini BAKESBANGPOL Kota Yogyakarta bekerja sama dengan CV IDE Consultant bermaksud melakukan Survei Kepuasan Masyarakat (SKM) tentang Kinerja Walikota dan Wakil Walikota Kota Yogyakarta Periode Tahun 2025. Kami berharap Bapak/Ibu/Saudara/Saudari berkenan untuk menjawab kuesioner di bawah ini.
          <br><br>
          <b>Pilih jawaban sesuai dengan pendapat anda tentang Kinerja (Performa) pelayanan pada Walikota dan Wakil Walikota.</b>
          <br><br>
          <span class="text-danger"><b>Data dan informasi dari responden yang terhimpun akan dijamin kerahasiaannya oleh lembaga konsultan.</b></span>
        </p>
      </div>
    </div>

    <div class="card identity-card mb-4">
      <div class="card-header text-white">
        <i class="fas fa-user-circle mr-2"></i> IDENTITAS RESPONDEN
      </div>
      <div class="card-body">
        <h5 class="identity-section-title"><i class="fas fa-id-card mr-2"></i> Data Pribadi</h5>
        <div class="row">
          <div class="col-12 mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user mr-1"></i> Nama</span>
              </div>
              <input class="form-control" type="text" id="Nama" placeholder="Nama Lengkap">
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-venus-mars mr-1"></i> Gender</span>
              </div>
              <select class="custom-select" id="Gender">                    
                <option value="Gender">Pilih Gender</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-birthday-cake mr-1"></i> Usia</span>
              </div>
              <input class="form-control" type="number" id="Usia" placeholder="Usia">
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone-alt mr-1"></i> No. HP</span>
              </div>
              <input class="form-control" type="tel" id="HP" placeholder="0812-3456-7890">
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-graduation-cap mr-1"></i> Pendidikan</span>
              </div>
              <select class="custom-select" id="Pendidikan">  
                <option value="Pendidikan">Pilih Pendidikan</option>                  
                <?php 
                $Pendidikan = array('SD/SEDERAJAT','SMP/SEDERAJAT','SMA/SEDERAJAT','D3/D4','S1','S2','S3'); 
                foreach ($Pendidikan as $value) { ?>
                  <option value="<?=$value?>"><?=$value?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-briefcase mr-1"></i> Pekerjaan</span>
              </div>
              <select class="custom-select" id="Pekerjaan">      
                <option value="Pekerjaan">Pilih Pekerjaan</option>                 
                <?php 
                $Pekerjaan = array('PNS','TNI/POLRI','PEGAWAI SWASTA','WIRAUSAHA','LAINNYA'); 
                foreach ($Pekerjaan as $value) { ?>
                  <option value="<?=$value?>"><?=$value?></option>
                <?php } ?>
              </select>
              <input class="form-control" type="text" id="PekerjaanLainnya" placeholder="Sebutkan pekerjaan" disabled>
            </div>
          </div>
        </div>
        
        <h5 class="identity-section-title mt-4"><i class="fas fa-building mr-2"></i> Data Kualifikasi Responden</h5>
        <div class="row">
          <div class="col-12 mb-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-university mr-1"></i> Responden</span>
              </div>
              <select class="custom-select" id="Kualifikasi">   
                <option value="Kualifikasi">Pilih Kualifikasi</option>                   
                <?php 
                $Kualifikasi = array(
                  'Unsur Politik (Pengurus Partai Politik tingkat Kota)',
                  'Unsur Sosial (Organisasi Kemasyarakatan/Ormas)',
                  'Tokoh Masyarakat (Ketua RT/RW/PKK/LPMK/Ketua Kampung)',
                  'Unsur Ekonomi (Pelaku Usaha/Perusahaan/UMKM)',
                  'Unsur Kesejahteraan (Keluarga Penerima Manfaat/KPM)','LAINNYA'
                ); 
                foreach ($Kualifikasi as $value) { ?>
                  <option value="<?=$value?>"><?=$value?></option>
                <?php } ?>
              </select>
              <input class="form-control" type="text" id="KualifikasiLainnya" placeholder="Sebutkan Kualifikasi" disabled>
            </div>
          </div>
        </div>
        
        <h5 class="identity-section-title mt-4"><i class="fas fa-concierge-bell mr-2"></i> Layanan</h5>
        <div class="row">
          <div class="col-12 mb-4">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-list mr-1"></i> Layanan</span>
              </div>
              <select class="custom-select" id="Layanan" name="Layanan">
                <option value="">-- Pilih Layanan --</option>
                <option value="Infrastruktur">Infrastruktur</option>
                <option value="Kebudayaan">Kebudayaan</option>
                <option value="Tata Kelola Lingkungan">Tata Kelola Lingkungan</option>
                <option value="Komunikasi Publik">Komunikasi Publik</option>
                <option value="Sosial">Sosial</option>
                <option value="Pelayanan Publik">Pelayanan Publik</option>
                <option value="Pendidikan">Pendidikan</option>
                <option value="Tata Kelola Pemerintah">Tata Kelola Pemerintah</option>
                <option value="Kesehatan">Kesehatan</option>
                <option value="Keamanan">Keamanan</option>
                <option value="Penegakan Hukum">Penegakan Hukum</option>
                <option value="Pemberantasan Korupsi">Pemberantasan Korupsi</option>
                <option value="Transportasi">Transportasi</option>
                <option value="Ketenagakerjaan">Ketenagakerjaan</option>
                <option value="Ekonomi">Ekonomi</option>
                <option value="Pertanian">Pertanian</option>
              </select>
            </div>
            <small class="form-text text-muted mt-2">
              Pilih satu jenis layanan yang paling sesuai dengan pengalaman Anda.
            </small>
          </div>
          <div class="col-12 mb-4">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-edit mr-1"></i> Jenis Layanan</span>
              </div>
              <input class="form-control" type="text" id="JenisLayanan" placeholder="Sebutkan jenis layanan secara spesifik">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header text-white">
        <i class="fas fa-clipboard-list mr-2"></i> KUESIONER SURVEI KEPUASAN MASYARAKAT
      </div>
      <div class="card-body">
        <div id="kuesionerContainer">
          <p class="text-center text-muted py-5">
            Silakan pilih jenis layanan di atas untuk menampilkan pertanyaan yang sesuai.
          </p>
        </div>
        
        <!-- Tombol Submit dengan Session Check -->
        <div class="text-center mt-5">
          <?php if ($isLoggedIn && $userLevel == 4): ?>
            <!-- Tampilkan button submit aktif untuk surveiyor level 4 -->
            <button type="button" class="btn btn-primary btn-submit" id="Kirim">
              <i class="fas fa-paper-plane mr-2"></i><b>KIRIM SURVEI</b> 
              <div id="LoadingInput" class="spinner-border spinner-border-sm text-white ml-2" style="display: none;" role="status"></div>
            </button>
          <?php else: ?>
            <!-- Tampilkan button disabled untuk non-surveiyor -->
            <button type="button" class="btn btn-secondary btn-submit" disabled style="cursor: not-allowed; opacity: 0.6;" 
                    title="<?= !$isLoggedIn ? 'Anda harus login sebagai Surveiyor (Level 4)' : 'Anda harus login sebagai Surveiyor (Level 4)' ?>">
              <i class="fas fa-lock mr-2"></i><b>KIRIM SURVEI (TIDAK AKTIF)</b>
            </button>
            <p class="text-danger mt-3">
              <i class="fas fa-exclamation-circle"></i> 
              <?php if (!$isLoggedIn): ?>
                Anda belum login. Silakan <a href="#" onclick="openModal('signInModal')" class="text-primary">login sebagai Surveiyor (Level 4)</a> untuk mengirim survei.
              <?php elseif ($userLevel != 4): ?>
                Anda login sebagai Level <?= $userLevel ?> (<?php 
                  if($userLevel == 1) echo 'Superadmin';
                  elseif($userLevel == 2) echo 'Admin';
                  elseif($userLevel == 3) echo 'Staf';
                ?>). Hanya <strong>Surveiyor (Level 4)</strong> yang dapat mengirim survei.
                <a href="#" onclick="logout()" class="text-primary">Logout</a> dan login sebagai Surveiyor.
              <?php endif; ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  
  <div class="fab" id="scrollTopBtn" title="Kembali ke Atas">
    <i class="fas fa-arrow-up"></i>
  </div>
  
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  
  <script>
    var totalPertanyaan = 0;
    var BaseURL = '<?= base_url() ?>';
    var isLoggedIn = <?= $isLoggedIn ? 'true' : 'false' ?>;
    var userLevel = <?= $userLevel ?>;

    // Data pertanyaan – hanya performa/kinerja (harapan sudah dihapus semua)
    const pertanyaanLayanan = {
      "Infrastruktur": [
        {performa: "Bagaimana kesesuaian persyaratan dalam memperoleh informasi dan layanan infrastruktur di Kota Yogyakarta (misalnya perizinan pembangunan, permohonan sambungan utilitas, atau layanan teknis lainnya)?", opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai"},
        {performa: "Bagaimana kemudahan sistem, alur, dan prosedur pelayanan infrastruktur yang berlaku (termasuk layanan langsung maupun berbasis digital/online)?", opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah"},
        {performa: "Bagaimana kecepatan dan ketepatan waktu dalam penyelesaian layanan atau pelaksanaan pekerjaan infrastruktur sesuai dengan jadwal yang telah ditetapkan?", opsi: "1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat"},
        {performa: "Bagaimana kewajaran, keterjangkauan, serta transparansi biaya dalam pelayanan infrastruktur? (Apabila layanan tidak dipungut biaya, tetap dinilai dari aspek keterbukaan informasi biaya.)", opsi: "1. Sangat Mahal, 2. Cukup Mahal, 3. Murah, 4. Gratis"},
        {performa: "Bagaimana kesesuaian hasil pembangunan atau layanan infrastruktur dengan standar teknis yang ditetapkan (misalnya kualitas jalan, drainase, trotoar, penerangan jalan umum, dan fasilitas publik lainnya)?", opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai"},
        {performa: "Bagaimana kompetensi/kemampuan, keahlian teknis, serta profesionalisme petugas/tenaga teknis dalam memberikan pelayanan atau menangani permasalahan infrastruktur?", opsi: "1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten"},
        {performa: "Bagaimana sikap, keramahan, kesopanan, serta responsivitas petugas dalam memberikan pelayanan kepada masyarakat?", opsi: "1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah"},
        {performa: "Bagaimana kemudahan dalam menyampaikan pengaduan atau laporan terkait infrastruktur (misalnya kerusakan jalan, genangan air, lampu jalan mati) serta kecepatan dan ketepatan tindak lanjutnya?", opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah"},
        {performa: "Bagaimana kondisi fisik dan kebermanfaatan infrastruktur di Kota Yogyakarta dalam mendukung aktivitas masyarakat (jalan kota, trotoar ramah pejalan kaki, drainase, fasilitas umum, ruang publik, aksesibilitas bagi penyandang disabilitas, dll.)?", opsi: "1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik"}
      ],
      "Kebudayaan": [
        {performa: "Bagaimana kemudahan masyarakat dalam memperoleh informasi dan mengikuti program kebudayaan (misalnya pameran seni, pertunjukan tradisional, workshop budaya, atau festival lokal)?", opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai"},
        {performa: "Bagaimana kemudahan prosedur pendaftaran dan partisipasi dalam kegiatan kebudayaan (baik secara langsung maupun online)?", opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah"},
        {performa: "Bagaimana kecepatan dan ketepatan pelaksanaan program kebudayaan sesuai jadwal yang diumumkan?", opsi: "1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat"},
        {performa: "Bagaimana keterjangkauan biaya atau transparansi biaya dalam kegiatan kebudayaan (misalnya tiket pertunjukan, workshop, pameran; jika gratis tetap dinilai keterbukaan informasinya)?", opsi: "1. Sangat Mahal, 2. Cukup Mahal, 3. Murah, 4. Gratis"},
        {performa: "Bagaimana kualitas program dan kegiatan kebudayaan yang diselenggarakan (misalnya kesesuaian pertunjukan dengan standar seni tradisional, kelengkapan fasilitas, penyajian informasi budaya)?", opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai"},
        {performa: "Bagaimana kompetensi, kemampuan, dan profesionalisme tenaga kebudayaan (misalnya seniman, kurator, pengelola museum, atau petugas budaya) dalam menyelenggarakan kegiatan atau memberikan layanan kepada masyarakat?", opsi: "1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten"},
        {performa: "Bagaimana sikap, keramahan, dan responsivitas tenaga kebudayaan dalam melayani masyarakat (misalnya saat mengikuti workshop, pameran, atau program budaya)?", opsi: "1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah"},
        {performa: "Bagaimana kemudahan masyarakat dalam menyampaikan masukan, kritik, atau keluhan terkait kegiatan kebudayaan dan bagaimana kecepatan tindak lanjutnya?", opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah"},
        {performa: "Bagaimana kondisi fisik dan kebermanfaatan fasilitas kebudayaan di Yogyakarta (misalnya museum, galeri seni, panggung pertunjukan, ruang publik budaya, perpustakaan, akses bagi penyandang disabilitas) dalam mendukung partisipasi masyarakat?", opsi: "1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik"}
      ],
      "Tata Kelola Lingkungan": [
        {performa: "Bagaimana kemudahan masyarakat dalam memperoleh informasi dan mengikuti program lingkungan (misalnya sosialisasi pengelolaan sampah, pelatihan konservasi, kegiatan penghijauan, atau festival lingkungan)?", opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai"},
        {performa: "Bagaimana kemudahan prosedur pendaftaran dan partisipasi dalam kegiatan lingkungan (baik secara langsung maupun online)?", opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah"},
        {performa: "Bagaimana kecepatan dan ketepatan pelaksanaan program lingkungan sesuai jadwal yang diumumkan?", opsi: "1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat"},
        {performa: "Bagaimana keterjangkauan biaya atau transparansi biaya dalam kegiatan lingkungan (misalnya partisipasi dalam pelatihan, workshop, atau pengelolaan sampah; jika gratis tetap dinilai keterbukaan informasinya)?", opsi: "1. Sangat Mahal, 2. Cukup Mahal, 3. Murah, 4. Gratis"},
        {performa: "Bagaimana kualitas program dan kegiatan lingkungan yang diselenggarakan (misalnya kesesuaian kegiatan dengan standar pengelolaan lingkungan, kelengkapan fasilitas, penyajian informasi terkait lingkungan)?", opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai"},
        {performa: "Bagaimana kompetensi, kemampuan, dan profesionalisme tenaga lingkungan (misalnya petugas Dinas Lingkungan Hidup, fasilitator program konservasi, pengelola taman kota) dalam menyelenggarakan kegiatan atau memberikan layanan kepada masyarakat?", opsi: "1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten"},
        {performa: "Bagaimana sikap, keramahan, dan responsivitas tenaga lingkungan dalam melayani masyarakat (misalnya saat mengikuti sosialisasi, workshop, atau program lingkungan)?", opsi: "1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah"},
        {performa: "Bagaimana kemudahan masyarakat dalam menyampaikan masukan, kritik, atau keluhan terkait kegiatan lingkungan dan bagaimana kecepatan tindak lanjutnya?", opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah"},
        {performa: "Bagaimana kondisi fisik dan kebermanfaatan fasilitas lingkungan di Yogyakarta (misalnya taman kota, taman edukasi, tempat pengelolaan sampah, ruang terbuka hijau, dan akses bagi penyandang disabilitas) dalam mendukung partisipasi masyarakat?", opsi: "1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik"}
      ],
      "Komunikasi Publik": [
        {performa: "Bagaimana kemudahan masyarakat dalam memperoleh informasi dan mengikuti program publik (misalnya pengumuman layanan masyarakat, sosialisasi peraturan, seminar publik, atau program partisipatif warga)", opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai"},
        {performa: "Bagaimana kemudahan prosedur pendaftaran dan partisipasi dalam kegiatan publik (baik secara langsung maupun online, misalnya mendaftar seminar, pelatihan, atau program masyarakat)", opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah"},
        {performa: "Bagaimana kecepatan dan ketepatan penyampaian informasi sesuai jadwal yang diumumkan (misalnya jadwal layanan publik, pengumuman program, atau informasi kegiatan masyarakat)", opsi: "1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat"},
        {performa: "Bagaimana keterbukaan dan transparansi informasi terkait biaya atau prosedur layanan publik (misalnya biaya administrasi, persyaratan dokumen; jika gratis tetap dinilai kejelasan informasinya)", opsi: "1. Sangat Tidak Transparan, 2. Kurang Transparan, 3. Transparan, 4. Sangat Transparan"},
        {performa: "Bagaimana kualitas program dan kegiatan komunikasi publik yang diselenggarakan (misalnya kelengkapan informasi, kesesuaian materi dengan kebutuhan masyarakat, kemudahan dipahami)", opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai"},
        {performa: "Bagaimana kompetensi, kemampuan, dan profesionalisme tenaga komunikasi publik (misalnya petugas humas, staf layanan informasi, atau fasilitator kegiatan publik)", opsi: "1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten"},
        {performa: "Bagaimana sikap, keramahan, dan responsivitas tenaga komunikasi publik dalam melayani masyarakat (misalnya saat menanggapi pertanyaan, keluhan, atau konsultasi layanan publik)", opsi: "1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah"},
        {performa: "Bagaimana kemudahan masyarakat dalam menyampaikan masukan, kritik, atau saran terkait layanan publik (misalnya melalui kotak saran, media sosial resmi, email, atau layanan langsung)", opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah"},
        {performa: "Bagaimana kondisi sarana komunikasi publik di Yogyakarta (misalnya website resmi, media sosial, papan pengumuman, pusat informasi publik, atau fasilitas pelayanan)", opsi: "1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik"}
      ],
      "Sosial": [
        {performa: "Bagaimana kemudahan masyarakat dalam memperoleh informasi dan mengikuti kegiatan sosial (misalnya kegiatan komunitas, sosialisasi program sosial, kegiatan gotong royong, atau kegiatan kemasyarakatan lainnya)", opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai"},
        {performa: "Bagaimana kemudahan prosedur pendaftaran dan partisipasi dalam kegiatan sosial (baik secara langsung maupun online, misalnya mendaftar acara komunitas, pelatihan sosial, atau kegiatan sukarela)", opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah"},
        {performa: "Bagaimana kecepatan dan ketepatan pelaksanaan kegiatan sosial sesuai jadwal yang diumumkan (misalnya jadwal kegiatan komunitas, pelatihan sosial, atau program kemasyarakatan)", opsi: "1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat"},
        {performa: "Bagaimana keterbukaan dan transparansi informasi terkait biaya atau prosedur kegiatan sosial (misalnya biaya partisipasi, persyaratan mengikuti kegiatan; jika gratis tetap dinilai kejelasan informasinya)", opsi: "1. Sangat Tidak Transparan, 2. Kurang Transparan, 3. Transparan, 4. Sangat Transparan"},
        {performa: "Bagaimana kualitas program dan kegiatan sosial yang diselenggarakan (misalnya kesesuaian kegiatan dengan kebutuhan masyarakat, kelengkapan fasilitas, dan manfaat sosial bagi warga)", opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai"},
        {performa: "Bagaimana kompetensi, kemampuan, dan profesionalisme tenaga penyelenggara kegiatan sosial (misalnya pengurus komunitas, fasilitator kegiatan sosial, atau petugas lapangan program kemasyarakatan)", opsi: "1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten"},
        {performa: "Bagaimana sikap, keramahan, dan responsivitas tenaga penyelenggara kegiatan sosial dalam melayani masyarakat (misalnya saat memberikan arahan, mendampingi peserta, atau menanggapi pertanyaan)", opsi: "1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah"},
        {performa: "Bagaimana kemudahan masyarakat dalam menyampaikan masukan, kritik, atau saran terkait kegiatan sosial (misalnya melalui pertemuan komunitas, kotak saran, media sosial, atau layanan langsung)", opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah"},
        {performa: "Bagaimana kondisi sarana dan fasilitas sosial di Yogyakarta dalam mendukung partisipasi masyarakat (misalnya balai desa, ruang komunitas, taman warga, atau fasilitas kegiatan sukarela)", opsi: "1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik"}
      ],
      "Pelayanan Publik": [
        {performa: "Bagaimana kejelasan dan kemudahan persyaratan dalam memperoleh pelayanan publik di Kota Yogyakarta?", opsi: "1. Tidak Jelas 2. Kurang Jelas 3. Jelas 4. Sangat Jelas"},
        {performa: "Bagaimana kemudahan sistem dan prosedur dalam mengakses pelayanan publik di Kota Yogyakarta?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana kecepatan waktu penyelesaian pelayanan publik di Kota Yogyakarta?", opsi: "1. Tidak Cepat 2. Kurang Cepat 3. Cepat 4. Sangat Cepat"},
        {performa: "Bagaimana transparansi dan kewajaran biaya dalam pelayanan publik di Kota Yogyakarta?", opsi: "1. Tidak Wajar 2. Kurang Wajar 3. Wajar 4. Sangat Wajar"},
        {performa: "Bagaimana kesesuaian hasil pelayanan publik (dokumen/izin/layanan administratif) dengan standar yang ditetapkan di Kota Yogyakarta?", opsi: "1. Tidak Sesuai 2. Kurang Sesuai 3. Sesuai 4. Sangat Sesuai"},
        {performa: "Bagaimana kemampuan dan profesionalisme petugas dalam memberikan pelayanan publik di Kota Yogyakarta?", opsi: "1. Tidak Baik 2. Kurang Baik 3. Baik 4. Sangat Baik"},
        {performa: "Bagaimana sikap, keramahan, dan integritas petugas dalam memberikan pelayanan publik di Kota Yogyakarta?", opsi: "1. Tidak Baik 2. Kurang Baik 3. Baik 4. Sangat Baik"},
        {performa: "Bagaimana kemudahan menyampaikan pengaduan serta tindak lanjutnya terhadap pelayanan publik di Kota Yogyakarta?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana kondisi fasilitas pendukung pelayanan publik (ruang layanan, sistem online, akses informasi) di Kota Yogyakarta?", opsi: "1. Tidak mendukung 2. Kurang mendukung 3. mendukung 4. Sangat Mendukung"}
      ],
      "Pendidikan": [
        {performa: "Bagaimana kejelasan dan kemudahan persyaratan dalam memperoleh layanan pendidikan di Kota Yogyakarta (misalnya pendaftaran sekolah, beasiswa, administrasi)?", opsi: "1. Tidak Jelas 2. Kurang Jelas 3. Jelas 4. Sangat Jelas"},
        {performa: "Bagaimana kemudahan sistem dan prosedur pelayanan pendidikan yang berlaku di Kota Yogyakarta?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana ketepatan waktu dalam penyelesaian layanan pendidikan di Kota Yogyakarta?", opsi: "1. Tidak Tepat 2. Kurang Tepat 3. Tepat 4. Sangat Tepat"},
        {performa: "Bagaimana kewajaran dan keterjangkauan biaya dalam pelayanan pendidikan di Kota Yogyakarta? (Jika layanan gratis, tetap dinilai dari aspek transparansi biaya.)", opsi: "1. Tidak Terjangkau 2. Kurang terjangkau 3. Terjangkau 4. Sangat Terjangkau"},
        {performa: "Bagaimana kesesuaian layanan pendidikan yang diberikan dengan standar yang ditetapkan (mutu pembelajaran, kurikulum, dan lain-lain) di Kota Yogyakarta?", opsi: "1. Tidak Sesuai 2. Kurang Sesuai 3. Sesuai 4. Sangat Sesuai"},
        {performa: "Bagaimana kemampuan dan profesionalisme tenaga pendidik serta tenaga administrasi dalam memberikan pelayanan di Kota Yogyakarta?", opsi: "1. Tidak Baik 2. Kurang Baik 3. Baik 4. Sangat Baik"},
        {performa: "Bagaimana sikap, keramahan, dan kesopanan petugas/tenaga pendidik dalam memberikan pelayanan di Kota Yogyakarta?", opsi: "1. Tidak Baik 2. Kurang Baik 3. Baik 4. Sangat Baik"},
        {performa: "Bagaimana kemudahan menyampaikan pengaduan serta kecepatan tindak lanjutnya terhadap layanan pendidikan di Kota Yogyakarta?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana kondisi sarana dan prasarana pendukung pelayanan pendidikan (ruang kelas, fasilitas belajar, akses informasi) di Kota Yogyakarta?", opsi: "1. Tidak mendukung 2. Kurang mendukung 3. mendukung 4. Sangat Mendukung"}
      ],
      "Tata Kelola Pemerintahan": [
        {performa: "Bagaimana kejelasan persyaratan dalam mengurus administrasi pemerintahan di Kota Yogyakarta (misalnya perizinan, surat menyurat, dan layanan publik lainnya)?", opsi: "1. Tidak Jelas 2. Kurang Jelas 3. Jelas 4. Sangat Jelas"},
        {performa: "Bagaimana kemudahan prosedur dalam mengakses layanan pemerintahan di Kota Yogyakarta?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana ketepatan waktu dalam penyelesaian pelayanan administrasi pemerintahan di Kota Yogyakarta?", opsi: "1. Tidak Tepat 2. Kurang Tepat 3. Tepat 4. Sangat Tepat"},
        {performa: "Bagaimana transparansi dan kewajaran biaya dalam pelayanan pemerintahan di Kota Yogyakarta?", opsi: "1. Tidak Wajar 2. Kurang Wajar 3. Wajar 4. Sangat Wajar"},
        {performa: "Bagaimana kesesuaian hasil pelayanan (dokumen/izin/surat) dengan standar yang ditetapkan di Kota Yogyakarta?", opsi: "1. Tidak Sesuai 2. Kurang Sesuai 3. Sesuai 4. Sangat Sesuai"},
        {performa: "Bagaimana kemampuan dan profesionalisme aparatur pemerintah dalam memberikan pelayanan di Kota Yogyakarta?", opsi: "1. Tidak Baik 2. Kurang Baik 3. Baik 4. Sangat Baik"},
        {performa: "Bagaimana sikap, keramahan, dan integritas aparatur dalam memberikan pelayanan di Kota Yogyakarta?", opsi: "1. Tidak Baik 2. Kurang Baik 3. Baik 4. Sangat Baik"},
        {performa: "Bagaimana kemudahan menyampaikan pengaduan serta tindak lanjutnya terhadap layanan pemerintahan di Kota Yogyakarta?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana kondisi fasilitas pelayanan pemerintahan (ruang layanan, sistem online, akses informasi) di Kota Yogyakarta?", opsi: "1. Tidak mendukung 2. Kurang mendukung 3. mendukung 4. Sangat Mendukung"}
      ],
      "Kesehatan": [
        {performa: "Bagaimana kejelasan dan kemudahan persyaratan dalam memperoleh layanan kesehatan di Kota Yogyakarta (misalnya pendaftaran, BPJS, rujukan)?", opsi: "1. Tidak Jelas 2. Kurang Jelas 3. Jelas 4. Sangat Jelas"},
        {performa: "Bagaimana kemudahan prosedur pelayanan kesehatan di Kota Yogyakarta (alur pendaftaran, pemeriksaan, pengambilan obat)?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana ketepatan waktu pelayanan kesehatan yang Anda terima di Kota Yogyakarta?", opsi: "1. Tidak Tepat 2. Kurang Tepat 3. Tepat 4. Sangat Tepat"},
        {performa: "Bagaimana transparansi dan kewajaran biaya pelayanan kesehatan di Kota Yogyakarta?", opsi: "1. Tidak Wajar 2. Kurang Wajar 3. Wajar 4. Sangat Wajar"},
        {performa: "Bagaimana kesesuaian layanan kesehatan yang diberikan dengan kebutuhan dan standar medis di Kota Yogyakarta?", opsi: "1. Tidak Sesuai 2. Kurang Sesuai 3. Sesuai 4. Sangat Sesuai"},
        {performa: "Bagaimana kompetensi tenaga kesehatan (dokter, perawat, petugas medis) dalam memberikan pelayanan di Kota Yogyakarta?", opsi: "1. Tidak Baik 2. Kurang Baik 3. Baik 4. Sangat Baik"},
        {performa: "Bagaimana sikap, keramahan, dan empati tenaga kesehatan dalam melayani pasien di Kota Yogyakarta?", opsi: "1. Tidak Baik 2. Kurang Baik 3. Baik 4. Sangat Baik"},
        {performa: "Bagaimana kemudahan dalam menyampaikan keluhan serta tindak lanjut atas pengaduan layanan kesehatan di Kota Yogyakarta?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana kondisi fasilitas pelayanan Kesehatan (ruang Kesehatan, sistem online, akses informasi) di Kota Yogyakarta?", opsi: "1. Tidak mendukung 2. Kurang mendukung 3. mendukung 4. Sangat Mendukung"}
      ],
      "Keamanan": [
        {performa: "Bagaimana kejelasan persyaratan dalam memperoleh layanan keamanan di Kota Yogyakarta (misalnya pelaporan gangguan ketertiban atau kejadian keamanan)?", opsi: "1. Tidak Jelas 2. Kurang Jelas 3. Jelas 4. Sangat Jelas"},
        {performa: "Bagaimana kemudahan prosedur dalam menyampaikan laporan atau permohonan bantuan keamanan kepada aparat di Kota Yogyakarta?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana kecepatan respons aparat keamanan Kota Yogyakarta dalam menangani laporan masyarakat?", opsi: "1. Tidak Cepat 2. Kurang Cepat 3. Cepat 4. Sangat Cepat"},
        {performa: "Bagaimana transparansi dan kepastian bahwa pelayanan keamanan di Kota Yogyakarta tidak dipungut biaya di luar ketentuan?", opsi: "1. Tidak Transparan 2. Kurang Transparan 3. Transparan 4. Sangat Transparan"},
        {performa: "Bagaimana efektivitas hasil penanganan masalah keamanan yang Anda laporkan di Kota Yogyakarta?", opsi: "1. Tidak Efektif 2. Kurang Efektif 3. Efektif 4. Sangat Efektif"},
        {performa: "Bagaimana kemampuan dan profesionalisme aparat keamanan Kota Yogyakarta dalam menjalankan tugasnya?", opsi: "1. Tidak Baik 2. Kurang Baik 3. Baik 4. Sangat Baik"},
        {performa: "Bagaimana sikap, ketegasan, dan keramahan aparat keamanan dalam menjaga ketertiban di Kota Yogyakarta?", opsi: "1. Tidak Baik 2. Kurang Baik 3. Baik 4. Sangat Baik"},
        {performa: "Bagaimana kemudahan dalam menyampaikan pengaduan terkait keamanan serta tindak lanjutnya di Kota Yogyakarta?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana ketersediaan fasilitas pendukung keamanan di Kota Yogyakarta (pos keamanan, patroli, hotline, dll.)?", opsi: "1. Tidak mendukung 2. Kurang mendukung 3. mendukung 4. Sangat Mendukung"}
      ],
      "Penegakan Hukum": [
        {performa: "Bagaimana kejelasan persyaratan dalam proses pelayanan penegakan hukum di Kota Yogyakarta (misalnya pelaporan pelanggaran, pengajuan aduan)?", opsi: "1. Tidak Jelas 2. Kurang Jelas 3. Jelas 4. Sangat Jelas"},
        {performa: "Bagaimana kemudahan prosedur dalam proses pelaporan dan penanganan kasus hukum di Kota Yogyakarta?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana Kecepatan/ketepatan waktu dalam penanganan laporan atau pelanggaran hukum oleh aparat terkait?", opsi: "1. Tidak Cepat 2. Kurang Cepat 3. Cepat 4. Sangat Cepat"},
        {performa: "Bagaimana transparansi dan kepastian tidak adanya pungutan di luar ketentuan dalam proses penegakan hukum?", opsi: "1. Tidak Transparan 2. Kurang Transparan 3. Transparan 4. Sangat Transparan"},
        {performa: "Bagaimana kejelasan dan kepastian hasil penyelesaian kasus atau penindakan pelanggaran hukum?", opsi: "1. Tidak Jelas 2. Kurang Jelas 3. Jelas 4. Sangat Jelas"},
        {performa: "Bagaimana kompetensi dan profesionalisme aparat dalam menjalankan tugas penegakan hukum?", opsi: "1. Tidak kompeten 2. Kurang kompeten 3. kompeten 4. Sangat kompeten"},
        {performa: "Bagaimana sikap, integritas, dan keadilan aparat dalam menangani pelanggaran hukum?", opsi: "1. Tidak Baik 2. Kurang Baik 3. Baik 4. Sangat Baik"},
        {performa: "Bagaimana kemudahan dalam menyampaikan pengaduan terkait proses hukum serta tindak lanjutnya?", opsi: "1. Tidak Mudah 2. Kurang Mudah 3. Mudah 4. Sangat Mudah"},
        {performa: "Bagaimana ketersediaan fasilitas pendukung penegakan hukum di Kota Yogyakarta?", opsi: "1. Tidak Mendukung 2. Kurang mendukung 3. mendukung 4. Sangat mendukung"}
      ],
      "Pemberantasan Korupsi": [
      { 
        performa: "Bagaimana kesesuaian persyaratan pelayanan dalam upaya pemberantasan korupsi (misalnya persyaratan administrasi, kelengkapan laporan, atau dokumen pendukung) dengan jenis layanan yang diberikan?", 
        opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai" 
      },
      { 
        performa: "Bagaimana kemudahan prosedur pelayanan dalam upaya pemberantasan korupsi (seperti tata cara pelaporan, pengaduan, atau akses layanan pengawasan)?", 
        opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah" 
      },
      { 
        performa: "Bagaimana kecepatan atau ketepatan waktu pelayanan dalam penanganan laporan, pengaduan, atau layanan terkait pemberantasan korupsi?", 
        opsi: "1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat" 
      },
      { 
        performa: "Bagaimana kewajaran biaya atau tarif dalam pelayanan yang berkaitan dengan upaya pemberantasan korupsi?", 
        opsi: "1. Sangat Mahal, 2. Cukup Mahal, 3. Murah, 4. Gratis" 
      },
      { 
        performa: "Bagaimana kesesuaian hasil pelayanan dalam upaya pemberantasan korupsi (misalnya tindak lanjut laporan, rekomendasi, atau informasi yang diberikan) dengan standar pelayanan yang telah ditetapkan?", 
        opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai" 
      },
      { 
        performa: "Bagaimana kompetensi atau kemampuan petugas dalam memberikan pelayanan terkait pemberantasan korupsi (pemahaman aturan, integritas, dan ketepatan penanganan)?", 
        opsi: "1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten" 
      },
      { 
        performa: "Bagaimana perilaku petugas dalam memberikan pelayanan terkait pemberantasan korupsi, khususnya kesopanan, profesionalitas, dan sikap berintegritas?", 
        opsi: "1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah" 
      },
      { 
        performa: "Bagaimana kualitas sarana dan prasarana pendukung pelayanan pemberantasan korupsi (media pelaporan, ruang layanan, sistem informasi, fasilitas pendukung lainnya)?", 
        opsi: "1. Tidak Baik, 2. Kurang Baik, 3. Baik, 4. Sangat Baik" 
      },
      { 
        performa: "Bagaimana penanganan pengaduan, laporan, saran, dan masukan dari masyarakat terkait pemberantasan korupsi?", 
        opsi: "1. Tidak Ada, 2. Ada tetapi Tidak Berfungsi, 3. Berfungsi Kurang Maksimal, 4. Dikelola dengan Baik" 
      }
    ],

    "Transportasi": [
      { 
        performa: "Bagaimana kesesuaian persyaratan pelayanan transportasi (misalnya persyaratan administrasi, teknis, atau kelengkapan) dengan jenis layanan transportasi yang digunakan atau diajukan?", 
        opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai" 
      },
      { 
        performa: "Bagaimana kemudahan prosedur pelayanan transportasi (seperti alur pengajuan, pengurusan administrasi, atau proses pelayanan lainnya)?", 
        opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah" 
      },
      { 
        performa: "Bagaimana kecepatan atau ketepatan waktu dalam pemberian pelayanan transportasi (misalnya administrasi, perizinan, atau layanan operasional)?", 
        opsi: "1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat" 
      },
      { 
        performa: "Bagaimana kewajaran biaya atau tarif yang dikenakan dalam pelayanan transportasi?", 
        opsi: "1. Sangat Mahal, 2. Cukup Mahal, 3. Murah, 4. Gratis" 
      },
      { 
        performa: "Bagaimana kesesuaian hasil pelayanan transportasi (dokumen, izin, atau hasil layanan lainnya) dengan standar pelayanan yang telah ditetapkan?", 
        opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai" 
      },
      { 
        performa: "Bagaimana kompetensi atau kemampuan petugas transportasi dalam memberikan pelayanan (pemahaman aturan, ketepatan informasi, kemampuan melayani)?", 
        opsi: "1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten" 
      },
      { 
        performa: "Bagaimana perilaku petugas transportasi dalam memberikan pelayanan, khususnya kesopanan dan keramahan kepada pengguna jasa?", 
        opsi: "1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah" 
      },
      { 
        performa: "Bagaimana kualitas sarana dan prasarana pelayanan transportasi (ruang tunggu, loket, rambu, fasilitas pendukung, sistem layanan)?", 
        opsi: "1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik" 
      },
      { 
        performa: "Bagaimana penanganan pengaduan, saran, dan masukan dari pengguna layanan transportasi?", 
        opsi: "1. Tidak Ada, 2. Ada tetapi Tidak Berfungsi, 3. Berfungsi Kurang Maksimal, 4. Dikelola dengan Baik" 
      }
    ],
      "Ketenagakerjaan": [
        { 
          performa: "Bagaimana kesesuaian persyaratan pelayanan di bidang ketenagakerjaan (misalnya persyaratan administrasi, teknis, atau dokumen pendukung) dengan jenis layanan yang diterima?", 
          opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai" 
        },
        { 
          performa: "Bagaimana kemudahan prosedur atau tahapan pelayanan di bidang ketenagakerjaan (seperti pendaftaran, verifikasi, dan penyelesaian layanan)?", 
          opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah" 
        },
        { 
          performa: "Bagaimana kecepatan atau ketepatan waktu pelayanan di bidang ketenagakerjaan (misalnya layanan pencari kerja, pelatihan, penempatan, atau administrasi lainnya)?", 
          opsi: "1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat" 
        },
        { 
          performa: "Bagaimana kewajaran biaya atau tarif dalam pelayanan di bidang ketenagakerjaan?", 
          opsi: "1. Sangat Mahal, 2. Cukup Mahal, 3. Murah, 4. Gratis" 
        },
        { 
          performa: "Bagaimana kesesuaian hasil pelayanan di bidang ketenagakerjaan (produk layanan, dokumen, atau fasilitas) dengan standar pelayanan yang telah ditetapkan?", 
          opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai" 
        },
        { 
          performa: "Bagaimana kompetensi atau kemampuan petugas dalam memberikan pelayanan di bidang ketenagakerjaan (pemahaman regulasi, ketepatan informasi, kemampuan teknis)?", 
          opsi: "1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten" 
        },
        { 
          performa: "Bagaimana perilaku petugas dalam memberikan pelayanan di bidang ketenagakerjaan, khususnya kesopanan dan keramahan?", 
          opsi: "1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah" 
        },
        { 
          performa: "Bagaimana kualitas sarana dan prasarana pendukung pelayanan di bidang ketenagakerjaan (ruang layanan, peralatan, sistem informasi)?", 
          opsi: "1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik" 
        },
        { 
          performa: "Bagaimana penanganan pengaduan, saran, dan masukan dari pengguna layanan di bidang ketenagakerjaan?", 
          opsi: "1. Tidak Ada, 2. Ada tetapi Tidak Berfungsi, 3. Berfungsi Kurang Maksimal, 4. Dikelola dengan Baik" 
        }
      ],

      "Ekonomi": [
        { 
          performa: "Bagaimana kesesuaian persyaratan pelayanan di bidang ekonomi (misalnya persyaratan administrasi, teknis, atau dokumen usaha) dengan jenis layanan yang diterima?", 
          opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai" 
        },
        { 
          performa: "Bagaimana kemudahan prosedur atau tahapan pelayanan di bidang ekonomi (seperti pengajuan permohonan, verifikasi, dan penyelesaian layanan)?", 
          opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah" 
        },
        { 
          performa: "Bagaimana kecepatan atau ketepatan waktu pelayanan di bidang ekonomi (misalnya perizinan usaha, fasilitasi UMKM, atau administrasi lainnya)?", 
          opsi: "1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat" 
        },
        { 
          performa: "Bagaimana kewajaran biaya atau tarif dalam pelayanan di bidang ekonomi?", 
          opsi: "1. Sangat Mahal, 2. Cukup Mahal, 3. Murah, 4. Gratis" 
        },
        { 
          performa: "Bagaimana kesesuaian hasil pelayanan di bidang ekonomi (produk layanan, dokumen, atau fasilitasi usaha) dengan standar pelayanan yang telah ditetapkan?", 
          opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai" 
        },
        { 
          performa: "Bagaimana kompetensi atau kemampuan petugas dalam memberikan pelayanan di bidang ekonomi (pemahaman regulasi, ketepatan informasi, kemampuan teknis)?", 
          opsi: "1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten" 
        },
        { 
          performa: "Bagaimana perilaku petugas dalam memberikan pelayanan di bidang ekonomi, khususnya kesopanan dan keramahan?", 
          opsi: "1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah" 
        },
        { 
          performa: "Bagaimana kualitas sarana dan prasarana pendukung pelayanan di bidang ekonomi (ruang layanan, sistem informasi, fasilitas pendukung lainnya)?", 
          opsi: "1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik" 
        },
        { 
          performa: "Bagaimana penanganan pengaduan, saran, dan masukan dari pengguna layanan di bidang ekonomi?", 
          opsi: "1. Tidak Ada, 2. Ada tetapi Tidak Berfungsi, 3. Berfungsi Kurang Maksimal, 4. Dikelola dengan Baik" 
        }
      ],

      "Pertanian": [
        { 
          performa: "Bagaimana kesesuaian persyaratan pelayanan di bidang pertanian (misalnya persyaratan administrasi, teknis, atau dokumen pendukung) dengan jenis layanan yang diterima?", 
          opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai" 
        },
        { 
          performa: "Bagaimana kemudahan prosedur atau tahapan pelayanan di bidang pertanian (seperti pengajuan permohonan, verifikasi, dan penerbitan hasil layanan)?", 
          opsi: "1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah" 
        },
        { 
          performa: "Bagaimana kecepatan atau ketepatan waktu pelayanan di bidang pertanian (misalnya penyuluhan, rekomendasi, bantuan, atau administrasi)?", 
          opsi: "1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat" 
        },
        { 
          performa: "Bagaimana kewajaran biaya atau tarif dalam pelayanan di bidang pertanian?", 
          opsi: "1. Sangat Mahal, 2. Cukup Mahal, 3. Murah, 4. Gratis" 
        },
        { 
          performa: "Bagaimana kesesuaian hasil pelayanan di bidang pertanian (produk layanan, rekomendasi, bantuan, atau dokumen) dengan standar pelayanan yang telah ditetapkan?", 
          opsi: "1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai" 
        },
        { 
          performa: "Bagaimana kompetensi atau kemampuan petugas dalam memberikan pelayanan di bidang pertanian (pengetahuan teknis, keterampilan, ketepatan informasi)?", 
          opsi: "1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten" 
        },
        { 
          performa: "Bagaimana perilaku petugas dalam memberikan pelayanan di bidang pertanian, khususnya kesopanan dan keramahan?", 
          opsi: "1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah" 
        },
        { 
          performa: "Bagaimana kualitas sarana dan prasarana pendukung pelayanan di bidang pertanian (ruang layanan, peralatan, media informasi, fasilitas pendukung lainnya)?", 
          opsi: "1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik" 
        },
        { 
          performa: "Bagaimana penanganan pengaduan, saran, dan masukan dari pengguna layanan di bidang pertanian?", 
          opsi: "1. Tidak Ada, 2. Ada tetapi Tidak Berfungsi, 3. Berfungsi Kurang Maksimal, 4. Dikelola dengan Baik" 
        }
      ],
      "default": []
    };

    const poinLabels = [
      "A. Persyaratan Layanan",
      "B. Prosedur/Alur Layanan",
      "C. Kecepatan & Ketepatan Waktu",
      "D. Biaya/Tarif & Transparansi Layanan",
      "E. Kesesuaian Produk/Hasil Layanan",
      "F. Kompetensi Petugas",
      "G. Sikap & Keramahan Petugas",
      "H. Penanganan Pengaduan/Masukan",
      "I. Sarana & Prasarana"
    ];

    // Fungsi untuk modal
    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'flex';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target.classList && event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    };

    // Fungsi logout
    function logout() {
        Swal.fire({
            title: 'Logout',
            text: "Apakah Anda yakin ingin keluar?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = BaseURL + "IDE/logout";
            }
        });
    }

    function generateKuesioner(layanan) {
      if (!layanan) {
        $("#kuesionerContainer").html('<p class="text-center text-muted py-5">Silakan pilih jenis layanan di atas untuk menampilkan pertanyaan yang sesuai.</p>');
        totalPertanyaan = 0;
        return;
      }

      let questions = pertanyaanLayanan[layanan] || pertanyaanLayanan["default"];

      let html = `
        <div class="unsur-title">
          Jenis Layanan : ${layanan}
        </div>
      `;

      let poinIndex = 0;

      questions.forEach((q, idx) => {
        const qNum = idx + 1;

        html += `
          <div class="section-title">${poinLabels[poinIndex] || `J. Lainnya ${poinIndex + 1}`}</div>
          <div class="performance-title"><i class="fas fa-chart-line"></i> KINERJA / PERFORMA</div>
        `;
        poinIndex++;

        html += `
          <div class="question-container fade-in">
            <div class="question-text">${q.performa}</div>
            <div class="options-container">
              <div class="font-weight-bold text-white mb-3">${q.opsi}</div>
              <div class="radio-options">
                ${[1,2,3,4].map(i => `
                  <div class="radio-option">
                    <input class="form-check-input" type="radio" name="Input${qNum}" id="I${qNum}${i}" value="${i}">
                    <label class="form-check-label" for="I${qNum}${i}">${i}</label>
                  </div>
                `).join('')}
              </div>
              <input class="form-control mt-3" type="text" id="Alasan${qNum}" placeholder="Alasan Anda memilih opsi di atas (wajib diisi jika memilih 1 atau 2)">
            </div>
          </div>
        `;
      });

      html += `
        <div class="question-container fade-in">
          <div class="question-text">Silakan memberikan masukan berupa saran atau kritik terhadap layanan BAKESBANGPOL Kota Yogyakarta :</div>
          <div class="options-container">
            <textarea class="form-control" rows="4" id="Saran" placeholder="Tulis saran/kritik Anda di sini..."></textarea>
          </div>
        </div>
      `;

      $("#kuesionerContainer").html(html);
      totalPertanyaan = questions.length;

      // Validasi alasan wajib jika nilai 1 atau 2
      $('input[type="radio"]').off('change').on('change', function() {
        const qid = $(this).attr('name').replace('Input', '');
        const val = parseInt($(this).val());
        const $alasan = $('#Alasan' + qid);
        if (val === 1 || val === 2) {
          if (!$alasan.next('.reason-notification').length) {
            $alasan.after('<div class="reason-notification">Harap isi alasan dengan jelas karena Anda memilih nilai rendah</div>');
          }
        } else {
          $alasan.next('.reason-notification').remove();
        }
      });
    }

    $(document).ready(function(){
      $('#HP').inputmask('9999-9999-9999');

      $("#Pekerjaan").change(function(){
        if ($(this).val() === 'LAINNYA') {
          $("#PekerjaanLainnya").prop('disabled', false).focus();
        } else {
          $("#PekerjaanLainnya").prop('disabled', true).val("");
        }
      });

      $("#Kualifikasi").change(function(){
        if ($(this).val() === 'LAINNYA') {
          $("#KualifikasiLainnya").prop('disabled', false).focus();
        } else {
          $("#KualifikasiLainnya").prop('disabled', true).val("");
        }
      });

      $("#Layanan").change(function(){
        const layanan = $(this).val().trim();
        generateKuesioner(layanan);
      });

      $(window).scroll(function(){
        if ($(this).scrollTop() > 300) $('#scrollTopBtn').fadeIn();
        else $('#scrollTopBtn').fadeOut();
      });

      $('#scrollTopBtn').click(function(){
        $('html, body').animate({scrollTop: 0}, 500);
        return false;
      });

      // Login handler
      $("#Masuk").click(function() {
        const username = $("#Username").val().trim();
        const password = $("#Password").val().trim();

        if (!username || !password) {
            Swal.fire('Perhatian', 'Mohon isi username dan password dengan lengkap.', 'warning');
            return;
        }

        const data = { Username: username, Password: password };

        $("#Masuk").prop("disabled", true).text("Memproses...");

        $.post(BaseURL + "IDE/SignIn", data)
            .done(function(response) {
                $("#Masuk").prop("disabled", false).text("Masuk");

                if (response === '1') {
                    window.location = BaseURL + "SuperAdmin";
                } else if (response === '2') {
                    window.location = BaseURL + "Admin";
                } else if (response === '3') {
                    window.location = BaseURL + "Staf"; // Redirect Staf ke halaman staf
                } else if (response === '4') {
                    window.location.reload(); // Surveiyor reload halaman survei
                } else {
                    Swal.fire('Gagal', response || "Username atau password salah. Silakan coba lagi.", 'error');
                }
            })
            .fail(function() {
                $("#Masuk").prop("disabled", false).text("Masuk");
                Swal.fire('Error', 'Gagal terhubung ke server. Periksa koneksi Anda.', 'error');
            });
      });

      // Enter key support untuk login
      $('#Username, #Password').on('keypress', function(e) {
          if (e.which === 13) {
              e.preventDefault();
              $('#Masuk').click();
          }
      });

      // Tombol Kirim dengan session check
      $("#Kirim").click(function(){
          // Cek session dari PHP (via variabel JavaScript)
          <?php if (!$isLoggedIn || $userLevel != 4): ?>
              Swal.fire({
                  title: 'Akses Ditolak',
                  text: '<?= !$isLoggedIn ? 'Anda harus login sebagai Surveiyor (Level 4) untuk mengirim survei' : 'Anda harus login sebagai Surveiyor (Level 4) untuk mengirim survei. Level Anda saat ini: ' . $userLevel ?>',
                  icon: 'error',
                  confirmButtonText: 'OK'
              }).then(() => {
                  if (!isLoggedIn) {
                      openModal('signInModal');
                  }
              });
              return false;
          <?php endif; ?>
          
          // Validasi radio wajib diisi
          var valid = true;
          var firstInvalid = null;

          for (let i = 1; i <= totalPertanyaan; i++) {
            const $radio = $(`input[name='Input${i}']:checked`);
            if ($radio.length === 0) {
              Swal.fire('Perhatian', 'Pertanyaan nomor ' + i + ' wajib diisi!', 'warning');
              $(`input[name='Input${i}']`)[0].scrollIntoView({behavior:'smooth', block:'center'});
              return false;
            }

            const val = parseInt($radio.val());
            const alasan = $(`#Alasan${i}`).val().trim();
            if ((val === 1 || val === 2) && alasan === "") {
              $(`#Alasan${i}`).addClass('is-invalid');
              valid = false;
              if (!firstInvalid) firstInvalid = i;
            } else {
              $(`#Alasan${i}`).removeClass('is-invalid');
            }
          }

          if (!valid) {
            Swal.fire({
              title: 'Perhatian',
              text: 'Harap isi alasan untuk semua pilihan bernilai 1 atau 2',
              icon: 'warning'
            });
            if (firstInvalid) $(`#Alasan${firstInvalid}`)[0].scrollIntoView({behavior:'smooth', block:'center'});
            return false;
          }

          // Validasi identitas responden
          if (!$("#Nama").val().trim()) {
            Swal.fire('Perhatian', 'Mohon isi nama lengkap!', 'warning');
            $("#Nama").focus();
            return false;
          }
          if ($("#Gender").val() === "Gender") {
            Swal.fire('Perhatian', 'Mohon pilih gender!', 'warning');
            $("#Gender").focus();
            return false;
          }
          if (!$("#Usia").val() || isNaN($("#Usia").val()) || $("#Usia").val() < 17) {
            Swal.fire('Perhatian', 'Mohon isi usia dengan angka yang valid (minimal 17 tahun)!', 'warning');
            $("#Usia").focus();
            return false;
          }
          if (!$("#HP").val() || $("#HP").val().replace(/-/g,'').length < 10) {
            Swal.fire('Perhatian', 'Mohon isi nomor HP yang valid!', 'warning');
            $("#HP").focus();
            return false;
          }
          if ($("#Pendidikan").val() === "Pendidikan") {
            Swal.fire('Perhatian', 'Mohon pilih pendidikan!', 'warning');
            $("#Pendidikan").focus();
            return false;
          }
          if ($("#Pekerjaan").val() === "Pekerjaan") {
            Swal.fire('Perhatian', 'Mohon pilih pekerjaan!', 'warning');
            $("#Pekerjaan").focus();
            return false;
          }
          if ($("#Pekerjaan").val() === "LAINNYA" && !$("#PekerjaanLainnya").val().trim()) {
            Swal.fire('Perhatian', 'Mohon sebutkan pekerjaan lainnya!', 'warning');
            $("#PekerjaanLainnya").focus();
            return false;
          }
          if ($("#Kualifikasi").val() === "Kualifikasi") {
            Swal.fire('Perhatian', 'Mohon pilih kualifikasi responden!', 'warning');
            $("#Kualifikasi").focus();
            return false;
          }
          if ($("#Kualifikasi").val() === "LAINNYA" && !$("#KualifikasiLainnya").val().trim()) {
            Swal.fire('Perhatian', 'Mohon sebutkan kualifikasi lainnya!', 'warning');
            $("#KualifikasiLainnya").focus();
            return false;
          }
          if (!$("#Layanan").val()) {
            Swal.fire('Perhatian', 'Mohon pilih jenis layanan!', 'warning');
            $("#Layanan").focus();
            return false;
          }

          // Kumpulkan data
          var Poin = [], Alasan = [];
          for (let i = 1; i <= totalPertanyaan; i++) {
            Poin.push($(`input[name='Input${i}']:checked`).val() || "");
            Alasan.push($(`#Alasan${i}`).val().trim());
          }

          var data = {
            Nama: $("#Nama").val().trim(),
            Gender: $("#Gender").val(),
            Usia: $("#Usia").val(),
            HP: $("#HP").val(),
            Pendidikan: $("#Pendidikan").val(),
            Pekerjaan: $("#Pekerjaan").val() === 'LAINNYA' ? $("#PekerjaanLainnya").val().trim() : $("#Pekerjaan").val(),
            Kualifikasi: $("#Kualifikasi").val() === 'LAINNYA' ? $("#KualifikasiLainnya").val().trim() : $("#Kualifikasi").val(),
            Layanan: $("#Layanan").val(),
            JenisLayanan: $("#JenisLayanan").val().trim() || "",
            Saran: $("#Saran").val().trim(),
            Poin: Poin.join("|"),
            Alasan: Alasan.join("|")
          };

          Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah data sudah benar dan ingin dikirim?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kirim!',
            cancelButtonText: 'Periksa lagi'
          }).then((result) => {
            if (!result.isConfirmed) return;

            $("#Kirim").prop("disabled", true);
            $("#LoadingInput").show();

            $.post(BaseURL + "IDE/InputIKMYogyakarta", data, function(res) {
              $("#Kirim").prop("disabled", false);
              $("#LoadingInput").hide();

              if (res === '1') {
                Swal.fire({
                  title: 'Berhasil!',
                  text: 'Data survei sudah tersimpan. Terima kasih atas partisipasinya.',
                  icon: 'success',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#6c757d',
                  confirmButtonText: 'Ya, isi survei lagi',
                  cancelButtonText: 'Tidak, selesai saja'
              }).then((result) => {
                  if (result.isConfirmed) {
                      $("#Layanan").val("").trigger("change");          
                      $("#JenisLayanan").val("");

                      $("#Kualifikasi").val("Kualifikasi");              
                      $("#KualifikasiLainnya")
                        .val("")                                       
                        .prop('disabled', true);                        
                      $("#Saran").val("");                               
      
                      $('input[type="radio"]').prop('checked', false);
                      $('input[type="text"][id^="Alasan"], textarea#Saran')
                          .val('')
                          .removeClass('is-invalid');

                      $('.reason-notification').remove();

                      $('html, body').animate({ scrollTop: $(".identity-card").offset().top - 100 }, 600);

                      $("#Layanan").focus();

                  } else {
                      window.location = BaseURL + "IDE/SurveiIKMYogyakarta";
                  }
              });
              } else {
                Swal.fire({
                  title: 'Gagal',
                  text: 'Gagal menyimpan: ' + (res || 'Unknown error'),
                  icon: 'error'
                });
              }
            }).fail(function() {
              $("#Kirim").prop("disabled", false);
              $("#LoadingInput").hide();
              Swal.fire({
                title: 'Error',
                text: 'Terjadi kesalahan koneksi. Silakan coba lagi.',
                icon: 'error'
              });
            });
          });
        });
    });

    // Session timeout handling (opsional)
    <?php if ($isLoggedIn): ?>
    let sessionTimeout = 30 * 60 * 1000; // 30 menit
    let timeoutTimer;

    function resetSessionTimer() {
        clearTimeout(timeoutTimer);
        timeoutTimer = setTimeout(function() {
            Swal.fire({
                title: 'Session Expired',
                text: 'Sesi Anda telah berakhir. Silakan login kembali.',
                icon: 'info',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = BaseURL + "IDE/logout";
            });
        }, sessionTimeout);
    }

    // Reset timer saat ada aktivitas user
    $(document).on('mousemove keypress click', function() {
        resetSessionTimer();
    });

    // Inisialisasi timer
    resetSessionTimer();
    <?php endif; ?>
  </script>
</body>
</html>