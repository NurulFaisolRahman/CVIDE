<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Survei Kepuasan Masyarakat - BAPPEDA Situbondo</title>
    <!-- Favicons -->
    <link href="../assets/img/favicon.ico" rel="icon">
    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
      /* ===== CSS VARIABLES ===== */
      :root {
        /* Primary Colors */
        --primary-blue: #0056b3;
        --secondary-blue: #007bff;
        --light-blue: #e7f1ff;
        --dark-blue: #003366;
        --accent-blue: #4a90e2;
        
        /* Neutral Colors */
        --white: #ffffff;
        --light-gray: #f8f9fa;
        --medium-gray: #e0e0e0;
        --dark-gray: #495057;
        
        /* Status Colors */
        --success-green: #28a745;
        --primary-red: #d32f2f;
        
        /* Typography */
        --font-family: 'Montserrat', sans-serif;
        --line-height: 1.7;
        
        /* Spacing */
        --border-radius: 8px;
        --border-radius-lg: 12px;
        --spacing-sm: 8px;
        --spacing-md: 15px;
        --spacing-lg: 20px;
        --spacing-xl: 30px;
        
        /* Shadows */
        --shadow-sm: 0 3px 15px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 6px 30px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.15);
        --shadow-button: 0 4px 15px rgba(0, 86, 179, 0.3);
        --shadow-button-hover: 0 8px 25px rgba(0, 86, 179, 0.4);
      }

      /* ===== BASE STYLES ===== */
      body {
        font-family: var(--font-family);
        background-color: var(--light-gray);
        color: var(--dark-gray);
        line-height: var(--line-height);
        margin: 0;
        padding: 0;
      }

      /* ===== HEADER SECTION ===== */
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

      /* ===== CARD COMPONENTS ===== */
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

      /* ===== IDENTITY CARD ===== */
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

      /* Identity form styling */
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

      /* Ensure consistent input group sizing */
      .identity-card .input-group .form-control,
      .identity-card .input-group .custom-select {
        flex-grow: 1;
      }

      /* ===== BUTTONS ===== */
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

      .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
      }

      .btn-primary:hover::before {
        left: 100%;
      }

      .btn-primary:hover {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--primary-blue) 100%);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 86, 179, 0.4);
      }

      .btn-primary:active {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 86, 179, 0.3);
      }

      .btn-submit {
        font-size: 1.1rem;
        padding: 15px 45px;
        border-radius: 12px;
      }

      /* ===== FORM ELEMENTS ===== */
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

      .form-control::placeholder {
        color: var(--medium-gray);
        font-weight: 400;
        font-style: italic;
      }

      .input-group {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
      }

      .input-group:focus-within {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
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

      .form-check-input {
        width: 1.3em;
        height: 1.3em;
        margin-top: 0.1em;
        border: 2px solid var(--medium-gray);
        border-radius: 4px;
        transition: all 0.2s ease;
      }

      .form-check-input:checked {
        background-color: var(--primary-blue);
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.2);
      }

      .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.15);
      }

      .form-check-label {
        font-weight: 500;
        color: var(--dark-gray);
        margin-left: 8px;
        cursor: pointer;
      }

      textarea.form-control {
        min-height: 130px;
        resize: vertical;
        line-height: 1.6;
      }

      /* Form group styling */
      .form-group {
        margin-bottom: 24px;
      }

      .form-label {
        font-weight: 600;
        color: var(--dark-blue);
        margin-bottom: 8px;
        font-size: 14px;
        display: block;
      }

      /* ===== QUESTION COMPONENTS ===== */
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
        border-color: var(--secondary-blue);
      }

      .radio-option label {
        font-weight: 500;
        margin-left: var(--spacing-sm);
        cursor: pointer;
        color: var(--white);
        transition: color 0.2s ease;
      }

      .radio-option:hover label {
        color: var(--white);
      }

      /* ===== SECTION TITLES ===== */
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
        align-items: center;
      }

      .importance-title {
        color: var(--success-green);
        font-weight: 600;
        font-size: 1rem;
        display: flex;
        align-items: center;
      }

      .performance-title i,
      .importance-title i {
        margin-right: var(--spacing-sm);
        font-size: 1.1rem;
      }

      /* ===== SERVICE OPTIONS ===== */
      .layanan-options {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
      }

      .layanan-option {
        background-color: var(--light-blue);
        border-radius: 6px;
        padding: var(--spacing-sm) var(--spacing-md);
        display: flex;
        align-items: center;
        transition: all 0.2s ease;
        cursor: pointer;
      }

      .layanan-option:hover {
        background-color: var(--secondary-blue);
        color: var(--white);
      }

      .layanan-option input {
        margin-right: var(--spacing-sm);
      }

      /* ===== UTILITY CLASSES ===== */
      .bg-primary {
        background-color: var(--primary-blue);
      }

      .bg-danger {
        background-color: var(--primary-red);
        border-radius: var(--border-radius);
      }

      .info-text {
        font-size: 13px;
        color: var(--dark-gray);
        margin-top: 5px;
        font-style: italic;
      }

      /* ===== FLOATING ACTION BUTTON ===== */
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

      /* ===== ANIMATIONS ===== */
      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .fade-in {
        animation: fadeIn 0.6s ease-out forwards;
      }

      /* ===== SCROLLBAR CUSTOMIZATION ===== */
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

      ::-webkit-scrollbar-thumb:hover {
        background: var(--dark-blue);
      }

      /* ===== RESPONSIVE DESIGN ===== */
      @media (max-width: 768px) {
        .question-container {
          max-width: 100%;
          padding: var(--spacing-md);
        }
        
        .options-container {
          padding: var(--spacing-md);
        }
        
        .radio-options {
          flex-direction: column;
          gap: var(--spacing-sm);
        }
        
        .radio-option {
          padding: 6px 12px;
        }
        
        .input-group-text {
          min-width: 100px;
          font-size: 14px;
        }
        
        .section-title {
          font-size: 1.1rem;
        }
        
        .fab {
          bottom: var(--spacing-lg);
          right: var(--spacing-lg);
          width: 50px;
          height: 50px;
          font-size: 20px;
        }
      }

      @media (max-width: 576px) {
        .header-section {
          padding: var(--spacing-md) 0;
          margin-bottom: var(--spacing-lg);
        }
        
        .card-body {
          padding: var(--spacing-md);
        }
        
        .question-container {
          padding: var(--spacing-md);
        }
        
        .options-container {
          padding: var(--spacing-md);
        }
        
        .radio-options {
          flex-direction: column;
          gap: var(--spacing-sm);
        }
        
        .layanan-options {
          flex-direction: column;
          gap: var(--spacing-sm);
        }
      }
    </style>
  </head>

  <body>  
    <!-- Header Section -->
    <div class="header-section text-center">
      <div class="container">
        <h2 class="header-title mb-2">SURVEI KEPUASAN MASYARAKAT</h2>
        <h5 class="header-subtitle">BAPPEDA Kabupaten Situbondo</h5>
      </div>
    </div>

    <div class="container">
      <!-- Informasi Survei -->
      <div class="card mb-4">
        <div class="card-body">
          <p class="text-justify mb-0">
            Dalam rangka peningkatan kualitas pelayanan publik secara berkelanjutan dan memenuhi amanat PERMENPAN RB Nomor 14 Tahun 2017 tentang Pedoman Penyusunan Survei Kepuasan Masyarakat Unit Penyelenggara Pelayanan Publik, bahwa penyelenggara pelayanan publik wajib melaksanakan Survei Kepuasan Masyarakat (SKM) secara berkala minimal 1 (satu) kali setahun.
            <br><br>
            Atas dasar tersebut, dengan ini BAPPEDA Kabupaten Situbondo bermaksud melakukan Survei Kepuasan Masyarakat (SKM) tentang Penyelenggaraan Pelayanan BAPPEDA Kabupaten Situbondo. Kami berharap Bapak/Ibu/Saudara/Saudari berkenan untuk menjawab kuesioner di bawah ini.
            <br><br>
            <b>Pilih jawaban sesuai dengan pendapat anda tentang Kinerja (Performa) dan Kepentingan (Importance) pelayanan pada BAPPEDA Kabupaten Situbondo.</b>
            <span class="text-danger">*) Unit layanan adalah Bidang dan Fungsional Perencana pada Bappeda.</span>
          </p>
        </div>
      </div>

      <!-- Identitas Responden -->
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
                  <?php $Pendidikan = array('SD/SEDERAJAT','SMP/SEDERAJAT','SMA/SEDERAJAT','D3/D4','S1','S2','S3'); 
                  foreach ($Pendidikan as $key => $value) { ?>
                    <option value="<?=$value?>"><?=$value?></option>
                  <?php }?>
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
                  <?php $Pekerjaan = array('PNS','TNI/POLRI','PEGAWAI SWASTA','WIRAUSAHA','LAINNYA'); 
                  foreach ($Pekerjaan as $key => $value) { ?>
                    <option value="<?=$value?>"><?=$value?></option>
                  <?php }?>
                </select>
                <input class="form-control" type="text" id="PekerjaanLainnya" placeholder="Sebutkan pekerjaan" disabled>
              </div>
            </div>
          </div>
          
          <h5 class="identity-section-title mt-4"><i class="fas fa-building mr-2"></i> Data Instansi</h5>
          <div class="row">
            <div class="col-12 mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-university mr-1"></i> Instansi</span>
                </div>
                <select class="custom-select" id="Instansi">    
                  <option value="Instansi">Pilih Instansi</option>                   
                  <?php $Instansi = array('DINAS PENDIDIKAN DAN KEBUDAYAAN','DINAS KESEHATAN','RUMAH SAKIT UMUM DAERAH (RSUD) ASEMBAGUS','RUMAH SAKIT UMUM DAERAH (RSUD) BESUKI','RUMAH SAKIT UMUM DAERAH (RSUD) DR. ABDOER RAHEM','DINAS PEKERJAAN UMUM DAN PERUMAHAN PERMUKIMAN','SATUAN POLISI PAMONG PRAJA','BADAN PENANGGULANGAN BENCANA DAERAH','DINAS SOSIAL','DINAS KETENAGAKERJAAN','DINAS PEMBERDAYAAN PEREMPUAN',' PERLINDUNGAN ANAK',' PENGENDALIAN PENDUDUK DAN KELUARGA BERENCANA','DINAS PERTANIAN DAN KETAHANAN PANGAN','DINAS LINGKUNGAN HIDUP','DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL','DINAS PEMBERDAYAAN MASYARAKAT DAN DESA','DINAS PERHUBUNGAN','DINAS KOMUNIKASI DAN INFORMATIKA','DINAS KOPERASI PERINDUSTRIAN DAN PERDAGANGAN','DINAS PENANAMAN MODAL PELAYANAN TERPADU SATU PINTU','DINAS PARIWISATA PEMUDA DAN OLAHRAGA','DINAS PERPUSTAKAAN DAN KEARSIPAN','DINAS PETERNAKAN DAN PERIKANAN','SEKRETARIAT DAERAH','SEKRETARIAT DPRD','BADAN PERENCANAAN PEMBANGUNAN DAERAH','BADAN KEUANGAN DAN ASET DAERAH','BADAN PENDAPATAN DAERAH','BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA','INSPEKTORAT','BADAN KESATUAN BANGSA DAN POLITIK','KECAMATAN BANYUGLUGUR','KECAMATAN JATIBANTENG','KECAMATAN SUMBERMALANG','KECAMATAN BESUKI','KECAMATAN SUBOH','KECAMATAN MLANDINGAN','KECAMATAN BUNGATAN','KECAMATAN KENDIT','KECAMATAN PANARUKAN','KECAMATAN SITUBONDO','KECAMATAN PANJI','KECAMATAN MANGARAN','KECAMATAN KAPONGAN','KECAMATAN ARJASA','KECAMATAN ASEMBAGUS','KECAMATAN JANGKAR','KECAMATAN BANYUPUTIH','LAINNYA'); 
                  foreach ($Instansi as $key => $value) { ?>
                    <option value="<?=$value?>"><?=$value?></option>
                  <?php }?>
                </select>
                <input class="form-control" type="text" id="InstansiLainnya" placeholder="Sebutkan instansi" disabled>
              </div>
            </div>
            <div class="col-12 mb-3" id="OpsiKecamatan" style="display: none;">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-map-marker-alt mr-1"></i> Kecamatan</span>
                </div>
                <select class="custom-select" id="Kecamatan">  
                  <?php foreach ($Kecamatan as $key) { ?>
                    <option value="<?=$key['Kode']?>"><?=$key['Nama']?></option>
                  <?php } ?>                  
                </select>
              </div>
            </div>
            <div class="col-12 mb-3" id="OpsiDesa" style="display: none;">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-map-marked-alt mr-1"></i> Desa/Kel.</span>
                </div>
                <select class="custom-select" id="Desa">                    
                  <?php foreach ($Desa as $key) { ?>
                    <option value="<?=$key['Nama']?>"><?=$key['Nama']?></option>
                  <?php } ?>                  
                </select>
              </div>
            </div>
          </div>
          
          <h5 class="identity-section-title mt-4"><i class="fas fa-concierge-bell mr-2"></i> Jenis Layanan</h5>
          <div class="layanan-options mb-3">
            <?php $Layanan = array('Penyusunan Dokumen Perencanaan Tahunan / 5 Tahunan','Musrenbang','LKPJ','SIPD','Inovasi Daerah','LAINNYA'); ?>
            <?php for ($j=0; $j < 5; $j++) { ?>
              <div class="layanan-option">
                <input class="form-check-input" type="checkbox" value="<?=$Layanan[$j]?>" name="Layanan" id="Layanan<?=$j?>">
                <label class="form-check-label mb-0" for="Layanan<?=$j?>"><?=$Layanan[$j]?></label>
              </div>
            <?php } ?>
          </div>
          <div class="col-12 mb-3">
            <input class="form-control" type="text" id="LayananLainnya" placeholder="Sebutkan layanan lainnya">
            <small class="info-text">Bisa memilih lebih dari 1 jenis layanan</small>
          </div>
        </div>
      </div>
    </div>

      <!-- Form Survei -->
    <div class="container">
      <div class="card">
        <div class="card-header text-white">
          <i class="fas fa-clipboard-list mr-2"></i> KUESIONER SURVEI KEPUASAN MASYARAKAT
        </div>
        <div class="card-body">
          <?php 
            $Tanya = array('1. Bagaimana pendapat saudara tentang kesesuaian persyaratan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) dengan peraturan perundang-undangan di unit pelayanan Bappeda Kab. Situbondo?',
                           '2. Bagaimana kepentingan/harapan saudara tentang kesesuaian persyaratan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) dengan peraturan perundang-undangan di unit pelayanan Bappeda Kab. Situbondo?',
                           '3. Bagaimana pemahaman Saudara tentang kejelasan dan kemudahan SOP/prosedur layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                           '4. Bagaimana kepentingan/harapan Saudara tentang kejelasan dan kemudahan SOP/prosedur layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                           '5. Bagaimana pendapat Saudara tentang kecepatan dan ketepatan waktu dalam memberikan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                           '6. Bagaimana kepentingan/harapan Saudara tentang kecepatan dan ketepatan waktu dalam memberikan layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                           '7. Bagaimana pendapat saudara tentang biaya/tarif layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di BAPPEDA telah sesuai dengan peraturan yang berlaku?',
                           '8. Bagaimana kepentingan/harapan saudara tentang biaya/tarif layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di BAPPEDA telah sesuai dengan peraturan yang berlaku?',
                           '9. Bagaimana pendapat saudara tentang kewajaran biaya/tarif dalam layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di BAPPEDA Kab Situbondo?',
                           '10. Bagaimana kepentingan/harapan saudara tentang kewajaran biaya/tarif dalam layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di BAPPEDA Kab Situbondo?',
                           '11. Bagaimana pendapat anda tentang kesesuaian produk layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) substansi dan arahan antara yang tercantum dalam standar regulasi dengan hasil yang diberikan di unit pelayanan Bappeda Kab. Situbondo?',
                           '12. Bagaimana kepentingan/harapan anda tentang kesesuaian produk layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) substansi dan arahan antara yang tercantum dalam standar regulasi dengan hasil yang diberikan di unit pelayanan Bappeda Kab. Situbondo?',
                           '13. Bagaimana pendapat Saudara tentang kompetensi/ kemampuan SDM (Kabid dan Perencana) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                           '14. Bagaimana kepentingan/harapan Saudara tentang kompetensi/ kemampuan SDM (Kabid dan Perencana) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                           '15. Bagaimana pendapat saudara perilaku petugas dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) terkait kesopanan dan keramahan di unit pelayanan Bappeda Kab. Situbondo?',
                           '16. Bagaimana kepentingan/harapan saudara perilaku petugas dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) terkait kesopanan dan keramahan di unit pelayanan Bappeda Kab. Situbondo?',
                           '17. Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana (Wifi, Proyektor, AC, dll) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                           '18. Bagaimana kepentingan/harapan Saudara tentang kualitas sarana dan prasarana (Wifi, Proyektor, AC, dll) dalam pelayanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                           '19. Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                           '20. Bagaimana kepentingan/harapan Saudara tentang penanganan pengaduan pengguna layanan konsultasi, evaluasi dan monitoring penyusunan dokumen perencanaan dan evaluasi (RPJMD / RENSTRA / RKPD / RENJA / LKPJ / Inovasi / Lainnya) di unit pelayanan Bappeda Kab. Situbondo?',
                           '21. Bagaimana pendapat Saudara tentang transparansi pelayanan yang diberikan?',
                           '22. Bagaimana kepentingan/harapan Saudara tentang transparansi pelayanan yang diberikan?',
                           '23. Bagaimana integritas petugas pelayanan dalam memberikan pelayanan?',
                           '24. Bagaimana kepentingan/harapan Saudara tentang integritas petugas pelayanan dalam memberikan pelayanan?'
                          ); 
            $Opsi = array('1. Tidak Sesuai, 2. Kurang Sesuai, 3. Sesuai, 4. Sangat Sesuai',
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
                          '1. Tidak Penting, 2. Kurang Penting, 3. Penting, 4. Sangat Penting'); 
            $Poin = array('A. Persyaratan Layanan','B. SOP / Prosedur Layanan','C. Kecepatan & Ketepatan Layanan','D. Kesesuaian Biaya/Tarif Layanan','E. Kewajaran Biaya/Tarif Layanan',
                          'F. Kesesuaian Produk Layanan','G. Kompetensi SDM Layanan','H. Kesopanan & Keramahan Layanan','I. Sarana & Prasarana Layanan','J. Penanganan Pengaduan Layanan','K. Transparansi Layanan','L. Integritas Layanan');
          ?> 
          <?php for ($j=0; $j < 24; $j++) { ?>
            <?php if ($j%2==0) { ?>
              <div class="section-title"><?=$Poin[$j/2]?></div>
              <div class="performance-title"><i class="fas fa-chart-line"></i> KINERJA / PERFORMA</div>
            <?php } else { ?>
              <div class="importance-title"><i class="fas fa-star"></i> KEPENTINGAN / HARAPAN</div>
            <?php } ?> 
            <div class="question-container fade-in">
              <div class="question-text"><?=$Tanya[$j]?></div>
              <div class="options-container">
                <div class="font-weight-bold text-white mb-3">
                  <?=$Opsi[$j]?>
                </div>
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
          
          <!-- Saran dan Kritik -->
          <div class="question-container fade-in">
            <div class="question-text">Silakan memberikan masukan berupa saran atau kritik terhadap layanan BAPPEDA Kab. Situbondo :</div>
            <div class="options-container">
              <textarea class="form-control" rows="4" id="Saran" placeholder="Tulis saran/kritik Anda di sini..."></textarea>
            </div>
          </div>
          
          <!-- Tombol Submit -->
          <div class="text-center mt-5">
            <button type="button" class="btn btn-primary btn-submit" id="Kirim">
              <i class="fas fa-paper-plane mr-2"></i><b>KIRIM SURVEI</b> 
              <div id="LoadingInput" class="spinner-border spinner-border-sm text-white ml-2" style="display: none;" role="status"></div>
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Floating Action Button -->
    <div class="fab" id="scrollTopBtn" title="Kembali ke Atas">
      <i class="fas fa-arrow-up"></i>
    </div>

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script>
      $(document).ready(function(){
          
        var BaseURL = '<?=base_url()?>';  

        // Input mask for phone number
        $('#HP').inputmask('9999-9999-9999');

        $("#Kecamatan").change(function (){
          var Desa = { Kode: $("#Kecamatan").val() };
          $.post(BaseURL+"IDE/ListDesa", Desa).done(function(Respon) {
            $('#Desa').html(Respon);
          });    
        });

        $("#Pekerjaan").change(function (){
          if ($("#Pekerjaan").val() == 'LAINNYA') {
            $("#PekerjaanLainnya").prop('disabled', false);
            $("#PekerjaanLainnya").attr("placeholder", "Sebutkan");
            $("#PekerjaanLainnya").focus();
          } else {
            $("#PekerjaanLainnya").prop('disabled', true);
            $("#PekerjaanLainnya").val("");
            $("#PekerjaanLainnya").attr("placeholder", "Lainnya");
          }
        });

        $("#Instansi").change(function (){
          if ($("#Instansi").val() == 'LAINNYA') {
            $("#InstansiLainnya").prop('disabled', false);
            $("#InstansiLainnya").attr("placeholder", "Sebutkan");
            $("#InstansiLainnya").focus();
          } else {
            $("#InstansiLainnya").prop('disabled', true);
            $("#InstansiLainnya").val("");
            $("#InstansiLainnya").attr("placeholder", "Lainnya");
          }
          
          if ($("#Instansi").val().startsWith('KECAMATAN')) {
            $("#OpsiKecamatan").show();
            $("#OpsiDesa").show();
          } else {
            $("#OpsiKecamatan").hide();
            $("#OpsiDesa").hide();
          }
        });

        // Scroll to top button
        $(window).scroll(function() {
          if ($(this).scrollTop() > 300) {
            $('#scrollTopBtn').fadeIn();
          } else {
            $('#scrollTopBtn').fadeOut();
          }
          
          // Add animation when scrolling
          $('.fade-in').each(function() {
            var position = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            
            if (scroll + windowHeight > position + 100) {
              $(this).addClass('fade-in');
            }
          });
        });

        $('#scrollTopBtn').click(function() {
          $('html, body').animate({scrollTop: 0}, 500);
          return false;
        });

        // Smooth scroll to questions
        $('html, body').animate({
          scrollTop: $('.section-title:first').offset().top - 20
        }, 800);

        $("#Kirim").click(function() {
          if ($("#Nama").val() === "") {
            alert('Mohon isi nama lengkap Anda!');
            $("#Nama").focus();
            return false;
          } else if ($("#Gender").val() === "Gender") {
            alert('Mohon pilih gender Anda!');
            $("#Gender").focus();
            return false;
          } else if ($("#Usia").val() === "" || isNaN($("#Usia").val())) {
            alert('Mohon isi usia Anda dengan angka!');
            $("#Usia").focus();
            return false;
          } else if (isNaN($("#HP").val().replace(/-/g, '')) || $("#HP").val() === "") {
            alert('Mohon isi nomor HP yang valid!');
            $("#HP").focus();
            return false;
          } else if ($("#Pendidikan").val() === "Pendidikan") {
            alert('Mohon pilih pendidikan terakhir Anda!');
            $("#Pendidikan").focus();
            return false;
          } else if ($("#Pekerjaan").val() === "Pekerjaan") {
            alert('Mohon pilih pekerjaan Anda!');
            $("#Pekerjaan").focus();
            return false;
          } else if ($("#Pekerjaan").val() === "LAINNYA" && $("#PekerjaanLainnya").val() === "") {
            alert('Mohon sebutkan pekerjaan Anda!');
            $("#PekerjaanLainnya").focus();
            return false;
          } else if ($("#Instansi").val() === "Instansi") {
            alert('Mohon pilih instansi Anda!');
            $("#Instansi").focus();
            return false;
          } else if ($("#Instansi").val() === "LAINNYA" && $("#InstansiLainnya").val() === "") {
            alert('Mohon sebutkan instansi Anda!');
            $("#InstansiLainnya").focus();
            return false;
          } else if (!$("#Layanan0").is(':checked') && !$("#Layanan1").is(':checked') && !$("#Layanan2").is(':checked') && !$("#Layanan3").is(':checked') && !$("#Layanan4").is(':checked') && $("#LayananLainnya").val() === "") {
            alert('Mohon pilih minimal satu jenis layanan!');
            return false;
          } else {
            var Cek = false;
            var Tanya = 0;
            for (let i = 1; i <= 24; i++) {
              if ($("input[name='Input"+i+"']:checked").val() == undefined) {
                Cek = true;
                Tanya = i;
                break;
              }
            }
            if (Cek) {
              alert('Pertanyaan nomer '+Tanya+' wajib diisi!');
              $('html, body').animate({
                scrollTop: $("#I"+Tanya+"1").closest('.question-container').offset().top - 20
              }, 800);
              return false;
            } 
            else {
              var Poin = [];
              for (let i = 1; i <= 24; i++) {
                Poin.push($("input[name='Input"+i+"']:checked").val());
              }
              var R = [];
              for (let i = 1; i <= 24; i++) {
                R.push($("#Alasan"+i).val());
              }
              var Pendidikan = $("#Pendidikan").val();
              var Pekerjaan = $("#Pekerjaan").val() == 'LAINNYA' ? $("#PekerjaanLainnya").val() : $("#Pekerjaan").val();
              var Instansi = $("#Instansi").val() == 'LAINNYA' ? $("#InstansiLainnya").val() : $("#Instansi").val();
              var A = [];
              $.each($("input[name='Layanan']:checked"), function(){
                A.push($(this).val());
              });
              if ($("#LayananLainnya").val() !== "") {
                A.push($("#LayananLainnya").val());
              }
              var IKM = { 
                Nama: $("#Nama").val(),
                Gender: $("#Gender").val(),
                Usia: $("#Usia").val(),
                HP: $("#HP").val(),
                Pendidikan: Pendidikan,
                Pekerjaan: Pekerjaan,
                Instansi: Instansi,
                Layanan: A.join("|"),
                Kecamatan: $("#Kecamatan").val(),
                Desa: $("#Desa").val(),
                Saran: $("#Saran").val(),
                Poin: Poin.join("|"),
                Alasan: R.join("|") 
              };
              
              if (confirm('Apakah Anda yakin dengan semua jawaban yang telah diisi?')) {
                $("#Kirim").attr("disabled", true);                              
                $("#LoadingInput").show();
                $.post(BaseURL+"IDE/InputIKMSitubondo", IKM).done(function(Respon) {
                  if (Respon == '1') {
                    alert('Terima kasih telah mengisi survei kepuasan masyarakat!');
                    window.location = BaseURL + "IDE/SurveiIKMSitubondo";
                  } else {
                    alert('Terjadi kesalahan: ' + Respon);
                    $("#LoadingInput").hide();
                    $("#Kirim").attr("disabled", false);   
                  }
                }).fail(function() {
                  alert('Terjadi kesalahan saat mengirim data. Silakan coba lagi.');
                  $("#LoadingInput").hide();
                  $("#Kirim").attr("disabled", false);
                });
              }
            } 
          }
        });
      });
    </script>
  </body>
</html>