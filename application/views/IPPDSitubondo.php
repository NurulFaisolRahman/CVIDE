<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>IPPD SITUBONDO</title>

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
    </style>
  </head>
  <body>
    <div class="app-container">
      <div class="header-section">
        <div class="logo-container">
          <img class="main-logo" src="https://awsimages.detik.net.id/community/media/visual/2020/11/25/pemkab-situbondo-1_169.jpeg?w=600&q=90" alt="IPPD Situbondo">
          <img class="badge-logo" src="https://situbondo.info/wp-content/uploads/2024/04/logo-kabupaten-situbondo-png-3-2.png" alt="Lambang Situbondo">
        </div>
      </div>
      
      <div class="title-section">
        <h1>IPPD SITUBONDO</h1>
        <p>Microsite Dokumen IPPD Kabupaten Situbondo</p>
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
                <a class="btn btn-primary btn-block" onclick="window.open('https://docs.google.com/spreadsheets/d/1KzmsHp01fRFLaCwCFJcoASnykfOFpezgh_5ytXyEnZI/edit?usp=drive_link')" role="button">Kertas Kerja</a>
                <a class="btn btn-primary btn-block" onclick="window.open('')" role="button">BAB I</a>
                <a class="btn btn-primary btn-block" onclick="window.open('')" role="button">BAB II</a>
                <a class="btn btn-primary btn-block" onclick="window.open('')" role="button">BAB III</a>
                <a class="btn btn-primary btn-block" onclick="window.open('')" role="button">BAB IV</a>
                <a class="btn btn-primary btn-block" onclick="window.open('')" role="button">BAB V</a>
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
                <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1No92_NbtN_5DOGIXqowFexAHAOL9aAee?usp=drive_link')" role="button">P RENJA 2025</a>
                <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/186IY8jPfHb2yMvpHwXod_yLIUqA--wbR?usp=drive_link')" role="button">RENSTRA 2025 - 2026</a>
                <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1KMFCTjJtioU80v4nXF-1ndemGCA2R-EH?usp=drive_link')" role="button">RPJMD 2025 - 2029</a>
                <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1cpfFRZfoT05q-XG-sOnxY_T7CJShRe8D?usp=drive_link')" role="button">RKPD 2026</a>
                <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/18BaH26rpe_xs8nq2bI7xalDDX2TuefGl?usp=drive_link')" role="button">P-RKPD 2025</a>
                <a class="btn btn-primary btn-block" onclick="window.open('https://drive.google.com/drive/folders/1gLa2GzKXgsrN3KcDaJas3bsjt9GTutCn?usp=drive_link')" role="button">Rincian APBD 2025 & 2026</a>
                <a class="btn btn-primary btn-block" onclick="window.open('')" role="button">RKA 2025 & 2026</a>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>

    <div class="footer">
      <p>&copy; 2025 IPPD Situbondo | <a href="#">Kebijakan Privasi</a></p>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  </body>
</html>