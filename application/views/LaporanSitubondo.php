<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laporan Kabupaten Situbondo</title>

  <!-- Bootstrap 3 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --primary:#0d47a1;
      --secondary:#1565c0;
      --glass:rgba(255,255,255,.15);
      --border:rgba(255,255,255,.35);
      --text:#2c2c2c;
    }

    *{font-family:'Poppins',sans-serif}

    body{
      background:linear-gradient(135deg,#0d47a1,#1a73e8);
      min-height:100vh;
    }

    .app-container{
      max-width:480px;
      margin:20px auto;
      background:#fff;
      border-radius:16px;
      box-shadow:0 12px 35px rgba(0,0,0,.18);
      overflow:hidden;
    }

    /* ===== HEADER GLASS ===== */
    .header-section{
      position:relative;
      padding:25px 20px 30px;
      background:
        linear-gradient(
          to bottom,
          rgba(13,71,161,.85),
          rgba(21,101,192,.85)
        ),
        url("https://images.unsplash.com/photo-1523731407965-2430cd12f5e4?auto=format&fit=crop&w=800&q=60");
      background-size:cover;
      background-position:center;
      text-align:center;
      color:#fff;
    }

    .header-glass{
      background:var(--glass);
      backdrop-filter:blur(10px);
      -webkit-backdrop-filter:blur(10px);
      border-radius:14px;
      padding:18px;
      border:1px solid var(--border);
    }

    .main-logo{
      max-width:260px;
      border-radius:10px;
      border:2px solid rgba(255,255,255,.8);
      background:#fff;
      padding:6px;
    }

    .badge-logo{
      width:90px;
      margin-top:12px;
      background:rgba(255,255,255,.95);
      padding:8px;
      border-radius:12px;
      border:1px solid #e0e0e0;
    }

    /* TITLE */
    .title-section{
      padding:16px 15px;
      text-align:center;
      border-bottom:1px solid #e0e0e0;
    }

    .title-section h1{
      font-size:17px;
      font-weight:700;
      color:#0d47a1;
      margin:0;
      letter-spacing:.4px;
    }

    /* CONTENT */
    .content-section{
      padding:18px;
    }

    /* PANEL */
    .panel{
      border:none;
      border-radius:12px;
      box-shadow:0 4px 12px rgba(0,0,0,.1);
    }

    .panel-heading{
      background:#fff!important;
      border-bottom:1px solid #e0e0e0;
      border-radius:12px 12px 0 0;
    }

    .panel-title a{
      display:block;
      padding:14px 16px;
      color:#0d47a1!important;
      font-weight:600;
      text-decoration:none;
      position:relative;
    }

    .panel-title a:after{
      content:"\f107";
      font-family:"Font Awesome 6 Free";
      font-weight:900;
      position:absolute;
      right:16px;
      top:50%;
      transform:translateY(-50%);
    }

    .panel-title a.collapsed:after{
      transform:translateY(-50%) rotate(-90deg);
    }

    .panel-body{
      padding:15px;
    }

    /* DOCUMENT ITEM */
    .doc-item{
      display:flex;
      align-items:center;
      padding:12px 14px;
      border:1px solid #e0e0e0;
      border-radius:6px;
      margin-bottom:10px;
      font-size:13px;
      color:#2c2c2c;
      background:#fff;
      text-decoration:none;
    }

    .doc-item i{
      margin-right:10px;
      color:#0d47a1;
      width:18px;
    }

    .doc-item:hover{
      background:#f0f5ff;
      color:#0d47a1;
      text-decoration:none;
    }

    /* SUB BAB */
    .sub-bab{
      margin-left:14px;
      padding-left:14px;
      border-left:3px solid #d0d7e2;
    }

    .sub-bab .doc-item{
      font-size:12.5px;
      background:#f9fbff;
    }

    /* FOOTER */
    .footer{
      text-align:center;
      font-size:11px;
      color:blue;
      padding:16px;
    }
  </style>
</head>

<body>

<div class="app-container">

  <!-- HEADER -->
  <div class="header-section">
    <div class="header-glass">
      <img src="https://awsimages.detik.net.id/community/media/visual/2020/11/25/pemkab-situbondo-1_169.jpeg?w=600&q=90" class="main-logo">
      <br>
      <img src="https://situbondo.info/wp-content/uploads/2024/04/logo-kabupaten-situbondo-png-3-2.png" class="badge-logo">
    </div>
  </div>

  <!-- TITLE -->
  <div class="title-section">
    <h1>LAPORAN KABUPATEN SITUBONDO</h1>
  </div>

  <!-- CONTENT -->
  <div class="content-section">
  <div class="panel-group" id="accordion">

    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#laporan" class="collapsed">
            <i class="fas fa-folder"></i> Dokumen Laporan
          </a>
        </h4>
      </div>

      <div id="laporan" class="panel-collapse collapse">
        <div class="panel-body">

          <a class="doc-item" href="https://drive.google.com/file/d/COVER_ID/view" target="_blank">
            <i class="fas fa-file"></i> Cover
          </a>

          <a class="doc-item" href="https://drive.google.com/file/d/KATA_PENGANTAR_ID/view" target="_blank">
            <i class="fas fa-file-alt"></i> Kata Pengantar
          </a>

          <a class="doc-item" href="https://drive.google.com/file/d/DAFTAR_ISI_ID/view" target="_blank">
            <i class="fas fa-list"></i> Daftar Isi
          </a>

          <a class="doc-item" href="https://docs.google.com/document/d/1ilGNUOPiuR5m6leFVsX1vpWhPfsaTc1MaDETRXnt-pY/edit?usp=drive_link" target="_blank">
            <i class="fas fa-book"></i> BAB I PENDAHULUAN
          </a>

          <a class="doc-item" href="https://docs.google.com/document/d/1_5YSxjt2homwJgSdiF52XjBGhaUUHToRIk-VQiMa3XI/edit?usp=drive_link" target="_blank">
            <i class="fas fa-book"></i> BAB II PERUBAHAN PENJABARAN ANGGARAN PENDAPATAN BELANJA DAERAH
          </a>

                    
            <a class="doc-item" data-toggle="collapse" href="#bab3Sub">
            <i class="fas fa-folder-open"></i> BAB III HASIL PENYELENGGARAAN URUSAN PEMERINTAHAN YANG MENJADI KEWENANGAN DAERAH
            </a>

            <div id="bab3Sub" class="collapse sub-bab">

            <!-- BAB 3.1 -->
            <a class="doc-item" data-toggle="collapse" href="#bab31Sub">
                <i class="fas fa-angle-right"></i> 3.1 HASIL PENYELENGGARAAN URUSAN PEMERINTAHAN YANG MENJADI KEWENANGAN DAERAH
            </a>

            <!-- SUB BAB 3.1 -->
            <div id="bab31Sub" class="collapse sub-bab">

                <a class="doc-item" href="https://docs.google.com/document/d/1vwdHJAU6HwTGgb3UeABr4SYB6_YQM0-LsvP_Y3jey1s/edit?usp=drive_link" target="_blank">
                <i class="fas fa-circle"></i> 3.1-1 
                </a>

                <a class="doc-item" href="https://docs.google.com/document/d/1HzY3r8633tx7ML6ZZuz5a6Y8XjLZiT1FL8PFaaucYhs/edit?usp=drive_link" target="_blank">
                <i class="fas fa-circle"></i> 3.1-2 
                </a>

                <a class="doc-item" href="https://docs.google.com/document/d/1IssUVei6Shhi8sajUb69Kw_Bf9BGefD252rDLyUNz2Y/edit?usp=drive_link" target="_blank">
                <i class="fas fa-circle"></i> 3.1-3 
                </a>

                <a class="doc-item" href="https://docs.google.com/document/d/16hrXNcdP78zHbCG6-MdQaiGM95H2jksRFXL7JkbB6Ck/edit?usp=drive_link" target="_blank">
                <i class="fas fa-circle"></i> 3.1-4 
                </a>

                <a class="doc-item" href="https://docs.google.com/document/d/1VlHoHNHke02wb6dbJUeAFBl2Rz-vjiChWXt9pjEe-os/edit?usp=drive_link" target="_blank">
                <i class="fas fa-circle"></i> 3.1-5 
                </a>

                <a class="doc-item" href="https://docs.google.com/document/d/17T_z6lrQhJ9n4FK8usMFPOpvxe_8SRM9c6-sYMszVMQ/edit?usp=drive_link" target="_blank">
                <i class="fas fa-circle"></i> 3.1-6 
                </a>

                <a class="doc-item" href="https://docs.google.com/document/d/15P30lqWfZt42Z4JwFJlARyrb2KPXVTvmzGGCds-h4ak/edit?usp=drive_link" target="_blank">
                <i class="fas fa-circle"></i> 3.1-7 
                </a>

                <a class="doc-item" href="https://docs.google.com/document/d/15J15_1pdCNbIu_eYNrcrPChedjQC5ebGvxOFPdaeZ2I/edit?usp=drive_link" target="_blank">
                <i class="fas fa-circle"></i> 3.1-8 
                </a>

            </div>

            <!-- BAB 3.2 -->
            <a class="doc-item" href="https://docs.google.com/document/d/1haU0rvg5wHxpt8cA7Jk0qFcOzwolybMIZbQJwY6NDds/edit?usp=drive_link" target="_blank">
                <i class="fas fa-angle-right"></i> 3.2 KEBIJAKAN STRATEGIS YANG DITETAPKAN
            </a>

            <!-- BAB 3.3 -->
            <a class="doc-item" href="https://docs.google.com/document/d/1U50V22w-xWIx31D1AqnEtK-9EI9TJEbINGaQFxBPKxE/edit?usp=drive_link" target="_blank">
                <i class="fas fa-angle-right"></i> 3.3 TINDAK LANJUT REKOMENDASI DPRD TAHUN SEBELUMNYA
            </a>

            <a class="doc-item" href="https://docs.google.com/document/d/1CZVbVR88yB4SJ-yXfZzma-PYNl_bBoKAvBPrAe7aIoU/edit?usp=drive_link" target="_blank">
                <i class="fas fa-angle-right"></i> 3.4 CAPAIAN INDIKATOR KINERJA DAERAH
            </a>

            <a class="doc-item" href="https://docs.google.com/document/d/1aQ7ByLiTfU3gzqE3vontyz7S1O4Kgzri8HQgl2Af9j0/edit?usp=drive_link" target="_blank">
                <i class="fas fa-angle-right"></i> 3.5 PRESTASI DAN PENGHARGAAN KABUPATEN SITUBONDO TAHUN 2025
            </a>

            </div>


                    <a class="doc-item" href="https://docs.google.com/document/d/1edDBHek5sb_Omlc7I5kh-EdYJqj9a8UlIOT1Nv-8syE/edit?usp=drive_link" target="_blank">
                        <i class="fas fa-book"></i> BAB IV CAPAIAN KINERJA PELAKSANAAN TUGAS PEMBANTUAN DAN PENUGASAN

                    </a>

                    <a class="doc-item" href="https://docs.google.com/document/d/1W1e0uJ0z2fxsZ4DjYiVYUOh1eCjAL8KC6QjlcRSH3fA/edit?usp=drive_link" target="_blank">
                        <i class="fas fa-book"></i> BAB V PENUTUP
                    </a>

                    </div>
                </div>
                </div>

            </div>
            </div>


<div class="footer">
  © 2026 Pemerintah Kabupaten Situbondo
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

</body>
</html>
