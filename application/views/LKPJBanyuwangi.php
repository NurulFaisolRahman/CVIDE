<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>LKPJ Banyuwangi - Tautan Perangkat Daerah</title>

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

      .countdown-wrapper {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        padding: 15px;
        margin: 20px 0;
        display: flex;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      }

      .countdown-item { text-align: center; flex: 1; }
      .countdown-number { display: block; font-size: 22px; font-weight: 800; line-height: 1; }
      .countdown-label { font-size: 10px; opacity: 0.9; margin-top: 4px; display: block; letter-spacing: 0.5px; }

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
        .countdown-number { font-size: 18px; }
        .search-input { font-size: 13px; }
        .float-wa-single { width: 58px; height: 58px; font-size: 26px; }
      }
    </style>
  </head>
  <body>

    <div class="app-container">
      
      <div class="header-section">
        <div class="logo-wrapper">
            <img class="profile-image" src="https://Banyuwangi.info/wp-content/uploads/2024/04/logo-kabupaten-Banyuwangi-png-3-2.png" alt="Logo Banyuwangi">
        </div>
        <h1 class="site-title">LKPJ BUPATI 2025</h1>
        <p class="site-desc">Laporan Keterangan Pertanggungjawaban Bupati Banyuwangi Tahun 2025</p>
        <p class="site-desc" style="font-size: 11px; color: #fbff00; margin-top: 5px;">*Dimohon untuk mengisi data sesuai masing masing OPD</p>
      </div>

    <div class="wa-top-container">
      <div class="float-wa-single" id="waButton">
        <i class="fab fa-whatsapp"></i>
      </div>
      <div class="wa-label">Contact Person</div>
    </div>

      <div class="countdown-wrapper" id="countdown">
        <div class="countdown-item"><span class="countdown-number" id="days">00</span><span class="countdown-label">HARI</span></div>
        <div class="countdown-item"><span class="countdown-number" id="hours">00</span><span class="countdown-label">JAM</span></div>
        <div class="countdown-item"><span class="countdown-number" id="minutes">00</span><span class="countdown-label">MENIT</span></div>
        <div class="countdown-item"><span class="countdown-number" id="seconds">00</span><span class="countdown-label">DETIK</span></div>
      </div>

      <div class="search-container">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="search-input" id="searchInput" onkeyup="filterFunction()" placeholder="Cari Dinas / Kecamatan...">
      </div>

      <div class="link-list" id="linkList">
        
        <a class="bio-btn" style="background: linear-gradient(to right, #ffffff, #e6f0ff); border: 1px solid #1a73e8;" onclick="konfirmasiBuka('Panduan Pengisian', 'https://docs.google.com/document/d/1qxnO8zH-h4S4v8UUTe6KCu1P2SmOd7qh/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
            <i class="fas fa-book-open" style="color: #1a73e8;"></i><span><b>Panduan Pengisian Link</b></span>
        </a>

        <div class="group-header">Sekretariat Daerah</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Setda - Tata Pemerintahan', '')"><i class="fas fa-handshake"></i><span>1.A. Bagian Tata Pemerintahan dan Kerja Sama</span></a>

        <div class="group-header">Badan & Lembaga</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Sekretariat DPRD', '')"><i class="fas fa-gavel"></i><span>2. Sekretariat DPRD</span></a>
        
        <div class="group-header">Dinas - Dinas</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Dinas Pendidikan', '')"><i class="fas fa-graduation-cap"></i><span>10. Dinas Pendidikan dan Kebudayaan</span></a>

        <div class="group-header">Rumah Sakit Daerah</div>
        <a class="bio-btn" onclick="konfirmasiBuka('RSUD Abdoer Rahem', '')"><i class="fas fa-hospital"></i><span>28. RSUD Banyuwangi</span></a>
        
        <div class="group-header">Kecamatan</div>
        <a class="bio-btn" onclick="konfirmasiBuka('Kecamatan Arjasa', '')"><i class="fas fa-map-location-dot"></i><span>31. Kecamatan Banyuwangi</span></a>
        
        <div id="noResult" class="no-result">
          <i class="fas fa-search-minus"></i>
          <p>Maaf, perangkat daerah yang Anda cari tidak ditemukan.</p>
        </div>

      </div>

    </div>

    <div class="footer">
      <p>BANYUWANGI BERBUDAYA  <br> © 2026 Tim Penyusun LKPJ</p>
    </div>
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      var countDownDate = new Date("Jan 13, 2026 23:59:59").getTime();
      var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("days").innerHTML = String(days).padStart(2, '0');
        document.getElementById("hours").innerHTML = String(hours).padStart(2, '0');
        document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0');
        document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0');

        if (distance < 0) {
          clearInterval(x);
          document.getElementById("countdown").innerHTML = "<span style='font-weight:800; letter-spacing:1px;'>WAKTU PELAPORAN BERAKHIR</span>";
        }
      }, 1000);

      function filterFunction() {
        var input, filter, div, a, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("linkList");
        a = div.getElementsByTagName("a");
        
        var visibleCount = 0;

        for (i = 0; i < a.length; i++) {
          txtValue = a[i].textContent || a[i].innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "flex";
            visibleCount++;
          } else {
            a[i].style.display = "none";
          }
        }

        var headers = document.getElementsByClassName("group-header");
        for (var k = 0; k < headers.length; k++) {
            if (filter !== "") {
                headers[k].style.display = "none";
            } else {
                headers[k].style.display = "block";
            }
        }

        var noResultDiv = document.getElementById("noResult");
        if (visibleCount === 0 && filter !== "") {
            noResultDiv.style.display = "block";
            noResultDiv.style.animation = "fadeInDown 0.3s ease-out";
        } else {
            noResultDiv.style.display = "none";
        }
      }

      function konfirmasiBuka(namaDinas, url) {
        if (url === '#' || url === '' || !url) {
            alert('Mohon maaf, link untuk ' + namaDinas + ' belum diinput oleh admin.');
            return; 
        }
        window.open(url, '_blank'); 
      }
      
      document.getElementById('waButton').addEventListener('click', function() {
        Swal.fire({
          title: 'Pilih Admin WhatsApp',
          html: `<div style="text-align:left; margin-top:15px;">
                   <p style="margin-bottom:15px; color:#666; font-size:14px;">Pilih admin yang ingin Anda hubungi:</p>
                   
                   <div class="wa-option" onclick="pilihAdmin('Admin 1', '6282131187041')">
                     <i class="fab fa-whatsapp"></i>
                     <div class="wa-option-info">
                       <div class="wa-option-name">Admin 1 <span class="wa-option-tag">Admin Web</span></div>
                       <div class="wa-option-number">+62 821-3118-7041</div>
                     </div>
                     <i class="fas fa-chevron-right" style="color:#999;"></i>
                   </div>

                   <div class="wa-option" onclick="pilihAdmin('Admin 2', '6282141225949')">
                     <i class="fab fa-whatsapp"></i>
                     <div class="wa-option-info">
                       <div class="wa-option-name">Admin 2 <span class="wa-option-tag">UTAMA</span></div>
                       <div class="wa-option-number">+62 821-4122-5949</div>
                     </div>
                     <i class="fas fa-chevron-right" style="color:#999;"></i>
                   </div>
                   
                   <div class="wa-option" onclick="pilihAdmin('Admin 3', '6281336059797')">
                     <i class="fab fa-whatsapp"></i>
                     <div class="wa-option-info">
                       <div class="wa-option-name">Admin 3 <span class="wa-option-tag" style="background:#ffa726;">CADANGAN</span></div>
                       <div class="wa-option-number">+62 813-3605-9797</div>
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
          width: '400px',
          customClass: {
            popup: 'animated fadeInUp'
          }
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
            const message = `Halo Admin, saya butuh bantuan terkait pengisian LKPJ Bupati Banyuwangi 2025.`;
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