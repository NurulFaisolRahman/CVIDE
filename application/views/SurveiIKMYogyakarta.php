<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Survei Kepuasan Masyarakat - BAPPEDA Yogyakarta</title>
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

    .importance-title {
      color: var(--success-green);
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

    @media (max-width: 768px) {
      .question-container { padding: var(--spacing-md); }
      .radio-options { flex-direction: column; gap: var(--spacing-sm); }
    }
  </style>
</head>

<body>  
  <div class="header-section text-center">
    <div class="container">
      <h2 class="header-title mb-2">SURVEI KEPUASAN MASYARAKAT</h2>
      <h5 class="header-subtitle">BAPPEDA Kota Yogyakarta</h5>
    </div>
  </div>

  <div class="container">
    <div class="card mb-4">
      <div class="card-body">
        <p class="text-justify mb-0">
          Dalam rangka peningkatan kualitas pelayanan publik secara berkelanjutan dan memenuhi amanat PERMENPAN RB Nomor 14 Tahun 2017 tentang Pedoman Penyusunan Survei Kepuasan Masyarakat Unit Penyelenggara Pelayanan Publik, bahwa penyelenggara pelayanan publik wajib melaksanakan Survei Kepuasan Masyarakat (SKM) secara berkala minimal 1 (satu) kali setahun.
          <br><br>
          Atas dasar tersebut, dengan ini BAPPEDA Kota Yogyakarta bermaksud melakukan Survei Kepuasan Masyarakat (SKM) tentang Penyelenggaraan Pelayanan BAPPEDA Kota Yogyakarta. Kami berharap Bapak/Ibu/Saudara/Saudari berkenan untuk menjawab kuesioner di bawah ini.
          <br><br>
          <b>Pilih jawaban sesuai dengan pendapat anda tentang Kinerja (Performa) dan Kepentingan (Importance) pelayanan pada BAPPEDA Kota Yogyakarta.</b>
          <span class="text-danger">*) Unit layanan adalah Bidang dan Fungsional Perencana pada Bappeda.</span>
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
                  'Unsur Politik','Unsur Politik (Pengurus Partai Politik tingkat Kota)',
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
        
        <h5 class="identity-section-title mt-4"><i class="fas fa-concierge-bell mr-2"></i> Jenis Layanan</h5>
        <div class="row">
        <div class="col-12 mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-list mr-1"></i> Layanan</span>
            </div>
            <select class="custom-select" id="Layanan" name="Layanan">
              <option value="">-- Pilih Jenis Layanan --</option>
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
              <option value="Ketenagakejaan">Ketenagakerjaan</option>
              <option value="Ekonomi">Ekonomi</option>
              <option value="Pertanian">Pertanian</option>
            </select>
          </div>
          <small class="form-text text-muted mt-2">
            Pilih satu jenis layanan yang paling sesuai dengan pengalaman Anda di BAPPEDA Kota Yogyakarta.
          </small>
        </div>
      </div>
    </div>
    </div>

    <div class="card">
      <div class="card-header text-white">
        <i class="fas fa-clipboard-list mr-2"></i> KUESIONER SURVEI KEPUASAN MASYARAKAT
      </div>
      <div class="card-body">
        <?php 
          $Tanya = array(
            '1. Bagaimana pendapat saudara tentang kesesuaian persyaratan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) dengan peraturan perundang-undangan di unit pelayanan Bappeda Kota Yogyakarta?',
            '2. Bagaimana kepentingan/harapan saudara tentang kesesuaian persyaratan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) dengan peraturan perundang-undangan di unit pelayanan Bappeda Kota Yogyakarta?',
            '3. Bagaimana pemahaman Saudara tentang kejelasan dan kemudahan SOP/prosedur layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kota Yogyakarta?',
            '4. Bagaimana kepentingan/harapan Saudara tentang kejelasan dan kemudahan SOP/prosedur layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kota Yogyakarta?',
            '5. Bagaimana pendapat Saudara tentang kecepatan dan ketepatan waktu dalam memberikan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kota Yogyakarta?',
            '6. Bagaimana kepentingan/harapan Saudara tentang kecepatan dan ketepatan waktu dalam memberikan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kota Yogyakarta?',
            '7. Bagaimana pendapat saudara tentang biaya/tarif layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di BAPPEDA telah sesuai dengan peraturan yang berlaku?',
            '8. Bagaimana kepentingan/harapan saudara tentang biaya/tarif layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di BAPPEDA telah sesuai dengan peraturan yang berlaku?',
            '9. <strong>Pelayanan di BAPPEDA Kota Yogyakarta 100% GRATIS</strong> dan tidak dipungut biaya/tarif untuk mendapatkan pelayanan.</p>
                 <p>Biaya/tarif yang dimaksud adalah biaya jasa setelah memperoleh pelayanan konsultasi, evaluasi, dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya), bukan biaya transportasi atau cetak dokumen.</p>
                 <p>Jika pelayanan diterima secara gratis, pilih opsi <strong>nomor 4 (Gratis)</strong>. Jika terdapat biaya setelah pelayanan, pilih opsi selain Gratis dan <strong>wajib menuliskan alasan serta rincian biaya</strong>.</p>',
            '10. Bagaimana kepentingan/harapan saudara tentang kewajaran biaya/tarif dalam layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di BAPPEDA Kota Yogyakarta?',
            '11. Bagaimana pendapat anda tentang kesesuaian produk layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) substansi dan arahan antara yang tercantum dalam standar regulasi dengan hasil yang diberikan di unit pelayanan Bappeda Kota Yogyakarta?',
            '12. Bagaimana kepentingan/harapan anda tentang kesesuaian produk layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) substansi dan arahan antara yang tercantum dalam standar regulasi dengan hasil yang diberikan di unit pelayanan Bappeda Kota Yogyakarta?',
            '13. Bagaimana pendapat Saudara tentang kompetensi/ kemampuan SDM (Kabid dan Perencana) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kota Yogyakarta?',
            '14. Bagaimana kepentingan/harapan Saudara tentang kompetensi/ kemampuan SDM (Kabid dan Perencana) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kota Yogyakarta?',
            '15. Bagaimana pendapat saudara perilaku petugas dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) terkait kesopanan dan keramahan di unit pelayanan Bappeda Kota Yogyakarta?',
            '16. Bagaimana kepentingan/harapan saudara perilaku petugas dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) terkait kesopanan dan keramahan di unit pelayanan Bappeda Kota Yogyakarta?',
            '17. Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana (Wifi, Proyektor, AC, dll) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kota Yogyakarta?',
            '18. Bagaimana kepentingan/harapan Saudara tentang kualitas sarana dan prasarana (Wifi, Proyektor, AC, dll) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kota Yogyakarta?',
            '19. Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kota Yogyakarta?',
            '20. Bagaimana kepentingan/harapan Saudara tentang penanganan pengaduan pengguna layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kota Yogyakarta?',
            '21. Bagaimana pendapat Saudara tentang transparansi pelayanan yang diberikan?',
            '22. Bagaimana kepentingan/harapan Saudara tentang transparansi pelayanan yang diberikan?',
            '23. Bagaimana integritas petugas pelayanan dalam memberikan pelayanan?',
            '24. Bagaimana kepentingan/harapan Saudara tentang integritas petugas pelayanan dalam memberikan pelayanan?'
          ); 

          $Opsi = array(
            '1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
            '1. Tidak Mudah, 2. Kurang Mudah, 3. Mudah, 4. Sangat Mudah',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
            '1. Tidak Cepat, 2. Kurang Cepat, 3. Cepat, 4. Sangat Cepat',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
            '1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
            '1. Sangat Mahal, 2. Cukup Mahal, 3. Murah, 4. Gratis',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
            '1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
            '1. Tidak Kompeten, 2. Kurang Kompeten, 3. Kompeten, 4. Sangat Kompeten',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
            '1. Tidak Sopan dan Ramah, 2. Kurang Sopan dan Ramah, 3. Sopan dan Ramah, 4. Sangat Sopan dan Ramah',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
            '1. Buruk, 2. Cukup, 3. Baik, 4. Sangat Baik',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
            '1. Tidak Ada, 2. Ada Tapi Tidak Berfungsi, 3. Berfungsi Kurang Maksimal, 4. Dikelola Dengan Baik',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
            '1. Standar pelayanan tidak dipublikasikan, 2. Standar pelayanan dipublikasikan sebagian, 3. Standar pelayanan dipublikasikan seluruhnya, 4. Standar pelayanan dipublikasikan seluruhnya dan jelas',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting',
            '1. Petugas pelayanan memberikan pelayanan yang tidak sesuai dengan standar pelayanan yang telah ditetapkan. 2. Petugas pelayanan memberikan pelayanan dengan cepat, namun disertai permintaan imbalan yang tidak sesuai dengan etika dan integritas profesi. 3. Petugas pelayanan memberikan pelayanan yang sesuai dengan standar pelayanan yang telah ditetapkan, menunjukkan kepatuhan terhadap prosedur dan prinsip integritas. 4. Petugas pelayanan memberikan pelayanan yang sesuai dengan standar pelayanan, serta melaksanakannya dengan cepat dan efisien, tanpa melanggar integritas atau etika kerja',
            '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting'
          ); 

          $Poin = array(
            'A. Persyaratan Layanan','B. SOP / Prosedur Layanan','C. Kecepatan & Ketepatan Layanan',
            'D. Kesesuaian Biaya/Tarif Layanan','E. Kewajaran Biaya/Tarif Layanan','F. Kesesuaian Produk Layanan',
            'G. Kompetensi SDM Layanan','H. Kesopanan & Keramahan Layanan','I. Sarana & Prasarana Layanan',
            'J. Penanganan Pengaduan Layanan','K. Transparansi Layanan','L. Integritas Layanan'
          );
        ?> 
        <?php $totalPertanyaan = count($Tanya); ?>
        <?php for ($j = 0; $j < $totalPertanyaan; $j++) { ?>
          <?php if ($j%2==0) { ?>
            <div class="section-title"><?=$Poin[$j/2]?></div>
            <div class="performance-title"><i class="fas fa-chart-line"></i> KINERJA / PERFORMA</div>
          <?php } else { ?>
            <div class="importance-title"><i class="fas fa-star"></i> KEPENTINGAN / HARAPAN</div>
          <?php } ?> 
          <div class="question-container fade-in">
            <div class="question-text"><?=$Tanya[$j]?></div>
            <div class="options-container">
              <div class="font-weight-bold text-white mb-3"><?=$Opsi[$j]?></div>
              <div class="radio-options">
                <?php for ($i=1; $i <= 4; $i++) { ?>
                  <div class="radio-option">
                    <input class="form-check-input" type="radio" name="Input<?=($j+1)?>" id="I<?=($j+1).$i?>" value="<?=$i?>">
                    <label class="form-check-label" for="I<?=($j+1).$i?>"><?=$i?></label>
                  </div>
                <?php } ?>
              </div>
              <input class="form-control" type="text" id="Alasan<?=($j+1)?>" placeholder="Alasan Anda memilih opsi di atas">
            </div>
          </div>
        <?php } ?>
        
        <div class="question-container fade-in">
          <div class="question-text">Silakan memberikan masukan berupa saran atau kritik terhadap layanan BAPPEDA Kota Yogyakarta :</div>
          <div class="options-container">
            <textarea class="form-control" rows="4" id="Saran" placeholder="Tulis saran/kritik Anda di sini..."></textarea>
          </div>
        </div>
        
        <div class="text-center mt-5">
          <button type="button" class="btn btn-primary btn-submit" id="Kirim">
            <i class="fas fa-paper-plane mr-2"></i><b>KIRIM SURVEI</b> 
            <div id="LoadingInput" class="spinner-border spinner-border-sm text-white ml-2" style="display: none;" role="status"></div>
          </button>
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
    var totalPertanyaan = <?= $totalPertanyaan ?>;
    var BaseURL = '<?= base_url() ?>';

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

      // Validasi alasan saat memilih 1 atau 2
      $('input[type="radio"]').on('change', function() {
        var qid = $(this).attr('name').replace('Input', '');
        var val = $(this).val();
        var $alasan = $('#Alasan' + qid);
        if (val == 1 || val == 2) {
          if (!$alasan.next('.reason-notification').length) {
            $alasan.after('<div class="reason-notification">Harap isi alasan dengan jelas</div>');
          }
        } else {
          $alasan.next('.reason-notification').remove();
        }
      });

      // Scroll to top
      $(window).scroll(function(){
        if ($(this).scrollTop() > 300) $('#scrollTopBtn').fadeIn();
        else $('#scrollTopBtn').fadeOut();
      });

      $('#scrollTopBtn').click(function(){
        $('html, body').animate({scrollTop: 0}, 500);
        return false;
      });

      $("#Kirim").click(function(){
        var valid = true;
        var firstInvalid = null;

        // Cek alasan untuk nilai 1 & 2
        $('input[type="radio"]:checked').each(function(){
          var qid = $(this).attr('name').replace('Input','');
          var val = $(this).val();
          var alasan = $('#Alasan'+qid).val().trim();
          if ((val == 1 || val == 2) && alasan === "") {
            $('#Alasan'+qid).addClass('is-invalid');
            valid = false;
            if (!firstInvalid) firstInvalid = qid;
          } else {
            $('#Alasan'+qid).removeClass('is-invalid');
          }
        });

        if (!valid) {
          Swal.fire({
            title: 'Perhatian',
            text: 'Harap isi alasan untuk semua pilihan bernilai 1 atau 2',
            icon: 'warning'
          });
          if (firstInvalid) $('#Alasan'+firstInvalid)[0].scrollIntoView({behavior:'smooth', block:'center'});
          return false;
        }

        // Validasi identitas
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
        if (!$("#Usia").val() || isNaN($("#Usia").val())) {
          Swal.fire('Perhatian', 'Mohon isi usia dengan angka!', 'warning');
          $("#Usia").focus();
          return false;
        }
        if (!$("#HP").val() || isNaN($("#HP").val().replace(/-/g,''))) {
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
          Swal.fire('Perhatian', 'Mohon sebutkan pekerjaan!', 'warning');
          $("#PekerjaanLainnya").focus();
          return false;
        }
        if ($("#Kualifikasi").val() === "Kualifikasi") {
          Swal.fire('Perhatian', 'Mohon pilih kualifikasi responden!', 'warning');
          $("#Kualifikasi").focus();
          return false;
        }
        if ($("#Kualifikasi").val() === "LAINNYA" && !$("#KualifikasiLainnya").val().trim()) {
          Swal.fire('Perhatian', 'Mohon sebutkan kualifikasi!', 'warning');
          $("#KualifikasiLainnya").focus();
          return false;
        }

        // Validasi Jenis Layanan
        var layanan = $("#Layanan").val().trim();
        if (!layanan) {
          Swal.fire('Perhatian', 'Mohon pilih jenis layanan!', 'warning');
          $("#Layanan").focus();
          return false;
        }

        // Cek semua radio terisi
        for (let i = 1; i <= totalPertanyaan; i++) {
          if (!$("input[name='Input"+i+"']:checked").val()) {
            Swal.fire('Perhatian', 'Pertanyaan nomor '+i+' wajib diisi!', 'warning');
            $("input[name='Input"+i+"']")[0].scrollIntoView({behavior:'smooth', block:'center'});
            return false;
          }
        }

        // Kumpulkan data
        var Poin = [], Alasan = [];
        for (let i = 1; i <= totalPertanyaan; i++) {
          Poin.push($("input[name='Input"+i+"']:checked").val());
          Alasan.push($("#Alasan"+i).val().trim());
        }

        var data = {
          Nama: $("#Nama").val().trim(),
          Gender: $("#Gender").val(),
          Usia: $("#Usia").val(),
          HP: $("#HP").val(),
          Pendidikan: $("#Pendidikan").val(),
          Pekerjaan: $("#Pekerjaan").val() === 'LAINNYA' ? $("#PekerjaanLainnya").val().trim() : $("#Pekerjaan").val(),
          Kualifikasi: $("#Kualifikasi").val() === 'LAINNYA' ? $("#KualifikasiLainnya").val().trim() : $("#Kualifikasi").val(),
          Layanan: layanan,
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
                  // Reset hanya bagian survei (kuesioner + layanan + saran)
                  $("#Layanan").val("").trigger('change');
                  $("#Saran").val("");
                  for (let i = 1; i <= totalPertanyaan; i++) {
                    $('input[name="Input'+i+'"]').prop('checked', false);
                    $('#Alasan'+i).val("").removeClass('is-invalid');
                    if ($('#Alasan'+i).next('.reason-notification').length) {
                      $('#Alasan'+i).next('.reason-notification').remove();
                    }
                  }
                  // Scroll ke bagian kuesioner
                  $('html, body').animate({
                    scrollTop: $(".card-header:contains('KUESIONER')").offset().top - 100
                  }, 800);
                } else {
                  // Redirect ke halaman survei (atau reload)
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
  </script>
</body>
</html>