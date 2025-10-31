<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>IPPD Banyuwangi</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
      :root {
        --primary-color: #0a5c36;
        --secondary-color: #1e8449;
        --accent-color: #27ae60;
        --light-color: #eafaf1;
        --dark-color: #064e2a;
      }
      
      * {
        font-family: 'Poppins', sans-serif;
      }
      
      body {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        min-height: 100vh;
        padding-bottom: 30px;
      }
      
      .app-container {
        max-width: 450px;
        margin: 0 auto;
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        margin-top: 20px;
        margin-bottom: 20px;
      }
      
      .header-section {
        position: relative;
        padding: 20px 0;
        background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
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
      }
      
      .title-section {
        padding: 70px 15px 20px;
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
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color)) !important;
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
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
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
      }
      
      .btn-primary:hover {
        background: linear-gradient(to right, var(--dark-color), var(--primary-color));
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
      }
      
      .footer a {
        color: var(--light-color);
        text-decoration: none;
      }

      .btn-justify {
        text-align: justify;
        text-justify: inter-word;
        white-space: normal; /* Agar teks bisa turun ke baris berikutnya */
      }

      .btn-justify {
  word-break: break-word;
}



    </style>
  </head>
  <body>
    <div class="app-container">
      <div class="header-section">
        <div class="logo-container">
          <img class="main-logo" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZk60T9ljRKayq88gckmZWpC2PjxD_SzFA7Q&s" alt="IPPD Banyuwangi">
          <img class="badge-logo" src="https://pengairan.banyuwangikab.go.id/images/banyuwangi.png" alt="Lambang Banyuwangi">
        </div>
      </div>
      
      <div class="title-section">
        <h1>IPPD BANYUWANGI</h1>
        <p>Microsite Dokumen IPPD Kabupaten Banyuwangi </p>
      </div>
      
      <div class="content-section">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          
          <!-- Laporan Menu -->
          <div class="panel panel-default">
            <div class="panel-heading" role="tab">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#laporan" aria-expanded="true" aria-controls="laporan">
                  <i class="fas fa-file-alt"></i> Laporan
                </a>
              </h4>
            </div>
            <div id="laporan" class="panel-collapse collapse" role="tabpanel">
              <div class="panel-body">
                <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/spreadsheets/d/16eVJkVTVVFNyDAmr54tVqHyPrHkVZlHl-U5lcxv8MXs/edit?usp=drive_link')" role="button">Kertas Kerja</a>
                <a class="btn btn-primary btn-block" onclick="window.open('')" role="button">BAB I</a>
                <a class="btn btn-primary btn-block" onclick="window.open('')" role="button">BAB II</a>
                <a class="btn btn-primary btn-block" onclick="window.open('')" role="button">BAB III</a>
                <a class="btn btn-primary btn-block" onclick="window.open('')" role="button">BAB IV</a>
                <a class="btn btn-primary btn-block" onclick="window.open('')" role="button">BAB V</a>
              </div>
            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading" role="tab">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#Justifikasi" aria-expanded="true" aria-controls="Justifikasi">
                  <i class="fas fa-clipboard-check"></i> Justifikasi Penilaian
                </a>
              </h4>
            </div>
            <div id="Justifikasi" class="panel-collapse collapse" role="tabpanel">
              <div class="panel-body">
                <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/spreadsheets/d/1pTxeLhUEJVpj5_hZPVkYaAwA-uo0YTd38QRuev-aHOA/edit?usp=drive_link')" role="button">Lembar Kerja - Sinergi</a>
                <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/spreadsheets/d/1IJd37K7wsCEstzq9nou_HiNMbtzFeLnFCZYBBHpy0p4/edit?usp=drive_link')" role="button">Kertas Kerja - Kualitas Perencanaan</a>
                <a class="btn btn-primary btn-block btn-justify" onclick="window.open('https://docs.google.com/spreadsheets/d/16LwtXtpCH6Ri_LdRihJLeXL8JLCrbLkfe45kPX-t6VY/edit?usp=drive_link')" role="button">
                  Lembar Kerja - Keterhubungan Perencanaan Pembangunan dengan Perencanaan Kinerja
                </a>
              </div>
            </div>
          </div>
          <!-- Upload Menu -->
          <div class="panel panel-default">
            <div class="panel-heading" role="tab">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#upload" aria-expanded="true" aria-controls="upload">
                  <i class="fas fa-upload"></i> Upload Dokumen
                </a>
              </h4>
            </div>
            <div id="upload" class="panel-collapse collapse" role="tabpanel">
              <div class="panel-body">
                <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1m1YNSLMOjSrzbW-A2BYFWFaYyhy6346x?usp=drive_link')" role="button">RENJA SKPD Tahun 2025</a>
                <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1DRSnxisnDcgYntUdFD09yX52gG9LQUdm?usp=drive_link')" role="button">RENSTRA SKPD Tahun 2025-2029</a>
                <!-- <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1il8lCI6NAG_-e_WYeQfCkjfBOjXy3NOP?usp=drive_link')" role="button">Rincian APBD Tahun 2024 & 2025</a> -->
                <!-- <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1y4KyuOfkC28pTFr-TxEJlPKldJvdC0vF?usp=drive_link')" role="button">RKA SKPD Tahun 2024 & 2025</a> -->
                <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1YvE1K3nEX1r7mSqr_LobewTEPstZSFuY?usp=drive_link')" role="button">RKPD Tahun 2024 & 2025 (Murni dan Perubahan)</a>
                <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1jOc37e73VFJWYfGzkPxJC38xXaM41RUL?usp=drive_link')" role="button">RPJMD Tahun 2025-2029</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer">
      <p>&copy; 2025 IPPD Banyuwangi | <a href="#">Kebijakan Privasi</a></p>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  </body>
</html>