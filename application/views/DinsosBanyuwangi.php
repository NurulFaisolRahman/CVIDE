<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>DINAS SOSIAL KAB. BANYUWANGI</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
      :root {
        --primary-color: #1a73e8;
        --secondary-color: #4285f4;
        --accent-color: #2114ac;
        --light-color: #e8f0fe;
        --dark-color: #0d47a1;
        --coastal-color: #2b7bba;
        --shadow-light: rgba(0, 0, 0, 0.1);
        --shadow-medium: rgba(0, 0, 0, 0.15);
        --shadow-dark: rgba(0, 0, 0, 0.2);
        --success-color: #28a745;
        --warning-color: #ffc107;
      }
      
      * {
        font-family: 'Poppins', sans-serif;
      }
      
      body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
        padding-bottom: 30px;
      }
      
      /* Animated gradient background */
      body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -2;
        background: linear-gradient(-45deg, #1a73e8, #4285f4, #2b7bba, #0d47a1);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
      }
      
      /* Floating shapes for aesthetic effect */
      body::after {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        background-image: 
          radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
          radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
          radial-gradient(circle at 40% 80%, rgba(255, 255, 255, 0.06) 0%, transparent 50%);
        animation: floatShapes 20s ease-in-out infinite;
      }
      
      @keyframes gradientShift {
        0% {
          background-position: 0% 50%;
        }
        50% {
          background-position: 100% 50%;
        }
        100% {
          background-position: 0% 50%;
        }
      }
      
      @keyframes floatShapes {
        0%, 100% {
          transform: translateY(0) scale(1);
        }
        50% {
          transform: translateY(-20px) scale(1.05);
        }
      }
      
      /* Decorative elements */
      .bg-decoration {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;
        overflow: hidden;
        pointer-events: none;
      }
      
      .bg-decoration .circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        animation: float 20s infinite ease-in-out;
      }
      
      .bg-decoration .circle:nth-child(1) {
        width: 300px;
        height: 300px;
        top: -100px;
        left: -100px;
        animation-delay: 0s;
      }
      
      .bg-decoration .circle:nth-child(2) {
        width: 200px;
        height: 200px;
        top: 50%;
        right: -50px;
        animation-delay: 5s;
      }
      
      .bg-decoration .circle:nth-child(3) {
        width: 150px;
        height: 150px;
        bottom: 100px;
        left: 10%;
        animation-delay: 10s;
      }
      
      .bg-decoration .circle:nth-child(4) {
        width: 250px;
        height: 250px;
        bottom: -50px;
        right: 20%;
        animation-delay: 15s;
      }
      
      @keyframes float {
        0%, 100% {
          transform: translateY(0) translateX(0) rotate(0deg);
        }
        33% {
          transform: translateY(-30px) translateX(20px) rotate(120deg);
        }
        66% {
          transform: translateY(20px) translateX(-20px) rotate(240deg);
        }
      }
      
      .app-container {
        max-width: 450px;
        margin: 0 auto;
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        margin-top: 20px;
        margin-bottom: 20px;
        position: relative;
      }
      
      .header-section {
        position: relative;
        padding: 20px 0;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        text-align: center;
        border-bottom: 5px solid var(--light-color);
      }
      
      .logo-container {
        position: relative;
        padding-top: 10px;
      }
      
      .main-logo {
        width: 100%;
        max-width: 300px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        border: 3px solid white;
      }
      
      .badge-logo {
        position: absolute;
        top: 150px;
        left: 50%;
        transform: translateX(-50%);
        width: 150px;
        height: 120px;
        background-color: white;
        border-radius: 50%;
        padding: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        border: 5px solid var(--light-color);
        object-fit: contain;
      }
      
      .title-section {
        padding: 90px 20px 20px;
        text-align: center;
        background-color: white;
      }
      
      .title-section h1 {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 24px;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
      }
      
      .title-section p {
        color: #666;
        font-size: 14px;
        margin-top: 5px;
      }
      
      .content-section {
        padding: 10px 20px 30px;
      }
      
      /* Panel Styling */
      .panel-group {
        margin-bottom: 0;
      }
      
      .panel {
        border-radius: 12px !important;
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 15px;
      }
      
      .panel-heading {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
        border-radius: 12px 12px 0 0 !important;
        padding: 0;
        border: none;
      }
      
      .panel-title {
        padding: 0;
      }
      
      .panel-title a {
        display: block;
        padding: 15px 20px;
        color: white !important;
        font-weight: 600;
        text-decoration: none !important;
        position: relative;
        transition: all 0.3s;
      }
      
      .panel-title a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 12px 12px 0 0;
      }
      
      .panel-title a.collapsed {
        border-radius: 12px;
      }
      
      .panel-title a:after {
        content: "\f078";
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        transition: all 0.3s;
      }
      
      .panel-title a.collapsed:after {
        transform: translateY(-50%) rotate(-90deg);
      }
      
      .panel-body {
        border-radius: 0 0 12px 12px;
        padding: 15px;
      }
      
      .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top: none;
      }
      
      /* Button Styling */
      .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        border-radius: 8px;
        padding: 12px 15px;
        margin-bottom: 10px;
        font-weight: 500;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
        text-align: left;
        position: relative;
        font-size: 13px;
        line-height: 1.4;
        min-height: 48px;
        display: flex;
        align-items: center;
        color: white !important;
      }
      
      .btn-primary:hover {
        background: linear-gradient(135deg, var(--dark-color), var(--primary-color));
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
      }
      
      .btn-primary:after {
        content: "\f35d";
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
      }
      
      .btn-text {
        flex: 1;
        padding-right: 20px;
      }
      
      /* Footer */
      .footer {
        text-align: center;
        padding: 20px;
        color: white;
        font-size: 12px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
      }
      
      .footer a {
        color: var(--light-color);
        text-decoration: none;
      }

      @media (max-width: 500px) {
        .badge-logo {
          top: 120px;
          width: 120px;
          height: 120px;
        }
        .title-section {
          padding-top: 60px;
        }
      }
    </style>
  </head>
  <body>
    <!-- Decorative background elements -->
    <div class="bg-decoration">
      <div class="circle"></div>
      <div class="circle"></div>
      <div class="circle"></div>
      <div class="circle"></div>
    </div>

    <div class="app-container">
      <div class="header-section">
        <div class="logo-container">
          <img class="main-logo" src="https://asset-2.tstatic.net/surabaya/foto/bank/images/kantor-pemkab-banyuwangi-kantor-pemkab-banyuwangi.jpg" alt="Kantor Pemkab Banyuwangi">
          <img class="badge-logo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Banyuwangi_Regency_coat_of_arms.svg/779px-Banyuwangi_Regency_coat_of_arms.svg.png" alt="Lambang Kabupaten Banyuwangi">
        </div>
      </div>
      
      <div class="title-section">
        <h1>DINAS SOSIAL</h1>
        <p>Kabupaten Banyuwangi</p>
      </div>
      
      <div class="content-section">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

          <!-- RENCANA STRATEGIS -->
          <div class="panel panel-default">
            <div class="panel-heading" role="tab">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#RenstraDinsos" aria-expanded="true" aria-controls="RenstraDinsos">
                  <i class="fas fa-file-alt"></i> RENCANA STRATEGIS
                </a>
              </h4>
            </div>
            <div id="RenstraDinsos" class="panel-collapse collapse " role="tabpanel">
              <div class="panel-body">
                <div class="panel-group" id="accordionDinsos" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionDinsos" href="#RenstraDinsosInmendagri" aria-expanded="false" aria-controls="RenstraDinsosInmendagri">
                          <i class="fas fa-file-alt"></i> VERSI INMENDAGRI
                        </a>
                      </h4>
                    </div>
                    <div id="RenstraDinsosInmendagri" class="panel-collapse collapse" role="tabpanel">
                      <div class="panel-body">
                        <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1lJANC_9GEyln88UUK0c9UBkEoYSEHik7?usp=drive_link')" role="button"><span class="btn-text"><b>KUMPULAN DATA</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/spreadsheets/d/1LAlh2NSaYfoxc-szvtvi_YpingSb-t93fd2eHazaL38/edit?usp=drive_link')" role="button"><span class="btn-text"><b>KEBUTUHAN BAB II</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/spreadsheets/d/1RGJkEdyN6kVzkj6zU4qriIYomLbAx45DAlDCsfs3Yxs/edit?usp=drive_link')" role="button"><span class="btn-text"><b>KEBUTUHAN BAB III</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/spreadsheets/d/1r5NuyymaPcXlPtAEWrqCkOPsPEqVWvjSbfFMRmYH9S0/edit?usp=drive_link')" role="button"><span class="btn-text"><b>KEBUTUHAN BAB IV</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/file/d/1_EmHbIrQL3URC1JxNvT_JsWg3pcnYLmY/view?usp=drive_link')" role="button"><span class="btn-text"><b>RANWAL RENSTRA</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/file/d/1K1gIpgPDk0KdLepmJtq2DVEl_c9Ezn-k/view?usp=drive_link')" role="button"><span class="btn-text"><b>RANKHIR RENSTRA</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1Kp6MZxS-lwFX6yyWYJbVy8s3O22CVpXn/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>DAFTAR ISI</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1XKBKjz1i9f10XaKXOHwLv1ka74ejkqfZ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>DAFTAR TABEL</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1O1Lx3fmJfjU3ssWHNSxvBcNOLVG9WZWt/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>DAFTAR GAMBAR</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1DX_CgfuGRwQrERmJlcQ_EsS6CY9GXznR/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB I PENDAHULUAN</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1ANgpaY0AoG3hhP0qTAd5yflHmTWnTlTI/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB II GAMBARAN PELAYANAN <br> PERANGKAT DAERAH</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1pzmUdA5DtBOul5oY3If6eNkuFTILTp62/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB III TUJUAN, SASARAN, <br> STRATEGI DAN ARAH KEBIJAKAN</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1YY7rNL8yMb42ke7BuR52t1q1VJbd1KSi/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB IV PROGRAM, KEGIATAN, <br> SUB KEGIATAN, DAN KINERJA</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1WaKpGVKE4naxM6Xo_kp4UM0jPmajdpXJ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB V PENUTUP</b></span></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- RENCANA KERJA 2026 -->
          <div class="panel panel-default">
            <div class="panel-heading" role="tab">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#Dinsos" aria-expanded="false" aria-controls="Dinsos">
                  <i class="fas fa-file-alt"></i> RENCANA KERJA 2026
                </a>
              </h4>
            </div>
            <div id="Dinsos" class="panel-collapse collapse" role="tabpanel">
              <div class="panel-body">
                <div class="panel-group" id="accordionDinsos" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionDinsos" href="#RenjaDinsosPERMENDAGRI" aria-expanded="true" aria-controls="RenjaDinsosPERMENDAGRI">
                          <i class="fas fa-file-alt"></i> VERSI PERMENDAGRI
                        </a>
                      </h4>
                    </div>
                    <div id="RenjaDinsosPERMENDAGRI" class="panel-collapse collapse" role="tabpanel">
                      <div class="panel-body">
                        <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1lXgIZDk4Dv70UZt0rsLUxPpFT303m9Ha?usp=drive_link')" role="button"><span class="btn-text"><b>KUMPULAN DATA</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/spreadsheets/d/1daVkM8c1GcbpVFLQuBeaq1wsFz69v0B-ZGJJb0wYnMA/edit?usp=drive_link')" role="button"><span class="btn-text"><b>KEBUTUHAN BAB II</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/spreadsheets/d/1NXp8UvgtOfersAsbzbPDvCobFJ63P_GLu-ysjeQ5z4U/edit?usp=drive_link')" role="button"><span class="btn-text"><b>KEBUTUHAN BAB III</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1BSptQkE8FNZTXJ0hvSgyIAqsNQVtIVP9/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>DAFTAR ISI</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1Cp_G5kPOIAAgy2jtznA6AM9JhbmhhSYX/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>DAFTAR TABEL</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1iO-zvqogr8LB7V4iAHkFqF24qxf_taXz/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>DAFTAR GAMBAR</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/19kmEeXTOfnOsicbelQ7nUyK2_38bYpmM/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB I PENDAHULUAN</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1z8xZbZiHq50bCO7uqVeCMT-sP9ZYNygq/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB II HASIL EVALUASI RENJA <br> PERANGKAT DAERAH TAHUN LALU</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1NxeOTkTLjJHm7uBoLsBQIePeNPMJiGB_/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB III TUJUAN DAN SASARAN <br> PERANGKAT DAERAH</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1ToWkjo14l6zb6uiix4S_PT09DmzP2-Y8/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB IV RENCANA KERJA DAN <br> PENDANAAN PERANGKA DAERAH</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1GwackUv1sPRbkWZIgDTIT4BJc7nfoNlU/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB V PENUTUP</b></span></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- RENCANA KERJA 2027 -->
          <div class="panel panel-default">
            <div class="panel-heading" role="tab">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#Renja2027" aria-expanded="false" aria-controls="Renja2027">
                  <i class="fas fa-file-alt"></i> RENCANA KERJA 2027
                </a>
              </h4>
            </div>
            <div id="Renja2027" class="panel-collapse collapse" role="tabpanel">
              <div class="panel-body">
                <div class="panel-group" id="accordionRenja2027" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionRenja2027" href="#Renja2027Permendagri" aria-expanded="true" aria-controls="Renja2027Permendagri">
                          <i class="fas fa-file-alt"></i> VERSI PERMENDAGRI
                        </a>
                      </h4>
                    </div>
                    <div id="Renja2027Permendagri" class="panel-collapse collapse" role="tabpanel">
                      <div class="panel-body">
                        <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1FSwIB4V3rY_k91jaKex0nWHeIga-_8Z5?usp=drive_link')" role="button"><span class="btn-text"><b>KUMPULAN DATA</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/spreadsheets/d/1qSD4XQlZm06bcCm1y0eeLy0QC9mFaLzQ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>KEBUTUHAN BAB II</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/spreadsheets/d/1nUsSfcB4ou-SO_xk0Gsl30lptoyBLRKJ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>KEBUTUHAN BAB III</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1WbXkJ2PLp7G-HofhCt5F0Y0vRQTEBFmb/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>DAFTAR ISI</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1FEoTILfK5ZVuLzvfCy8gldYsrXFoFDlg/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>DAFTAR TABEL</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/17SHZoZyOzOk9LuBRA1lzejcI9GXLj92P/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>DAFTAR GAMBAR</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1BMvOpjRXi7duitYgKvfthYF90j-NDELn/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB I PENDAHULUAN</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1nfSb1Q2y8qrTeY9BvTKjzaNtSk9XR6iV/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB II HASIL EVALUASI RENJA</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1fZpigAUmYs7DL6rRYy1JlTCREXixsJPm/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB III TUJUAN DAN SASARAN</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/18fHj0q0JP5I_TR0iZRiRwQB2M253Wpw2/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB IV RENCANA KERJA DAN PENDANAAN</b></span></a>
                        <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/document/d/1QqL_ecN3MCmID4_4e8qdaERuvbg0zf2K/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')" role="button"><span class="btn-text"><b>BAB V PENUTUP</b></span></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="footer">
      <p>&copy; 2026 Dinas Sosial Kab. Banyuwangi</p>
    </div>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  </body>
</html>