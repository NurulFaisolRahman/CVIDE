<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LKPJ Kabupaten Situbondo </title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --navy: #0a1f44;
      --blue: #1a56db;
      --sky: #3b82f6;
      --gold: #d4a017;
      --gold-light: #f5d060;
      --white: #ffffff;
      --off-white: #f4f6fb;
      --text: #1e293b;
      --muted: #64748b;
      --border: #e2e8f0;
      --glass: rgba(255,255,255,0.07);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--navy);
      min-height: 100vh;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 32px 16px;
    }

    /* Background decorative */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background:
        radial-gradient(ellipse 60% 50% at 20% 10%, rgba(26,86,219,0.25) 0%, transparent 70%),
        radial-gradient(ellipse 50% 60% at 80% 90%, rgba(212,160,23,0.12) 0%, transparent 70%);
      pointer-events: none;
      z-index: 0;
    }

    .card {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 520px;
      background: var(--white);
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 32px 80px rgba(0,0,0,0.45), 0 0 0 1px rgba(255,255,255,0.06);
      animation: riseUp 0.7s cubic-bezier(0.22,1,0.36,1) both;
    }

    @keyframes riseUp {
      from { opacity:0; transform: translateY(32px); }
      to   { opacity:1; transform: translateY(0); }
    }

    /* ─── HERO ─── */
    .hero {
      position: relative;
      background: linear-gradient(160deg, #0a1f44 0%, #1a3a7a 60%, #1a56db 100%);
      padding: 40px 28px 36px;
      text-align: center;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url("https://images.unsplash.com/photo-1523731407965-2430cd12f5e4?auto=format&fit=crop&w=800&q=60") center/cover;
      opacity: 0.08;
    }

    /* Diagonal gold line */
    .hero::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 4px;
      background: linear-gradient(90deg, transparent, var(--gold), var(--gold-light), var(--gold), transparent);
    }

    .hero-inner { position: relative; z-index: 1; }

    .logo-ring {
      width: 90px; height: 90px;
      margin: 0 auto 18px;
      border-radius: 50%;
      background: rgba(255,255,255,0.97);
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 0 0 4px rgba(212,160,23,0.5), 0 8px 24px rgba(0,0,0,0.3);
      padding: 6px;
    }

    .logo-ring img {
      width: 100%; height: 100%;
      object-fit: contain;
      border-radius: 50%;
    }

    .hero-eyebrow {
      font-size: 10.5px;
      font-weight: 600;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: var(--gold-light);
      margin-bottom: 8px;
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      font-weight: 800;
      color: var(--white);
      line-height: 1.25;
      letter-spacing: -0.3px;
    }

    .hero-title span {
      display: block;
      font-size: 14px;
      font-family: 'DM Sans', sans-serif;
      font-weight: 400;
      color: rgba(255,255,255,0.65);
      letter-spacing: 0.5px;
      margin-top: 6px;
    }

    .hero-banner {
      display: block;
      margin: 20px auto 0;
      max-width: 100%;
      border-radius: 10px;
      border: 2px solid rgba(255,255,255,0.2);
      opacity: 0.92;
    }

    /* ─── SECTION ─── */
    .section {
      padding: 22px 22px 4px;
    }

    /* ─── BUTTON PANDUAN ─── */
    .btn-panduan {
      display: flex;
      align-items: center;
      gap: 12px;
      width: 100%;
      padding: 16px 20px;
      background: linear-gradient(135deg, #0a1f44, #1a56db);
      border-radius: 14px;
      text-decoration: none;
      color: white;
      font-weight: 600;
      font-size: 14.5px;
      border: 1px solid rgba(255,255,255,0.12);
      box-shadow: 0 6px 20px rgba(26,86,219,0.35);
      transition: all 0.25s ease;
      position: relative;
      overflow: hidden;
    }

    .btn-panduan::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(212,160,23,0.15), transparent);
      opacity: 0;
      transition: opacity 0.25s;
    }

    .btn-panduan:hover { transform: translateY(-2px); box-shadow: 0 12px 30px rgba(26,86,219,0.45); color: white; text-decoration: none; }
    .btn-panduan:hover::before { opacity: 1; }

    .btn-panduan .icon-wrap {
      width: 38px; height: 38px;
      background: rgba(212,160,23,0.2);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      border: 1px solid rgba(212,160,23,0.4);
    }

    .btn-panduan .icon-wrap i {
      color: var(--gold-light);
      font-size: 16px;
    }

    .btn-panduan .text { text-align: left; line-height: 1.3; }
    .btn-panduan .text small {
      display: block;
      font-size: 11px;
      font-weight: 400;
      color: rgba(255,255,255,0.55);
      margin-top: 2px;
    }

    .btn-panduan .arrow {
      margin-left: auto;
      color: rgba(255,255,255,0.35);
      transition: transform 0.25s;
    }

    .btn-panduan:hover .arrow { transform: translateX(4px); color: var(--gold-light); }

    /* ─── ACCORDION ─── */
    .accordion-wrap { padding: 16px 22px 22px; }

    .acc-panel {
      border: 1px solid var(--border);
      border-radius: 14px;
      overflow: hidden;
      margin-bottom: 0;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .acc-trigger {
      display: flex;
      align-items: center;
      gap: 12px;
      width: 100%;
      padding: 16px 18px;
      background: var(--white);
      border: none;
      cursor: pointer;
      text-align: left;
      font-family: 'DM Sans', sans-serif;
      font-weight: 600;
      font-size: 14px;
      color: var(--navy);
      transition: background 0.2s;
    }

    .acc-trigger:hover { background: var(--off-white); }

    .acc-trigger .folder-icon {
      width: 36px; height: 36px;
      background: linear-gradient(135deg, #dbeafe, #eff6ff);
      border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      border: 1px solid #bfdbfe;
    }

    .acc-trigger .folder-icon i { color: var(--blue); font-size: 14px; }

    .acc-trigger .chevron {
      margin-left: auto;
      color: var(--muted);
      transition: transform 0.3s;
      font-size: 12px;
    }

    .acc-trigger.open .chevron { transform: rotate(180deg); }
    .acc-trigger.open { background: #eff6ff; }

    .acc-body {
      display: none;
      border-top: 1px solid var(--border);
      background: var(--off-white);
      padding: 12px;
    }

    .acc-body.open { display: block; animation: fadeSlide 0.25s ease; }

    @keyframes fadeSlide {
      from { opacity:0; transform: translateY(-6px); }
      to   { opacity:1; transform: translateY(0); }
    }

    /* ─── DOC ITEMS ─── */
    .doc-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 11px 14px;
      border-radius: 10px;
      background: white;
      border: 1px solid var(--border);
      font-size: 13px;
      color: var(--text);
      text-decoration: none;
      margin-bottom: 7px;
      transition: all 0.2s;
      cursor: pointer;
    }

    .doc-item:last-child { margin-bottom: 0; }

    .doc-item .di-icon {
      width: 30px; height: 30px;
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      font-size: 12px;
    }

    .doc-item .di-icon.blue { background: #dbeafe; color: var(--blue); }
    .doc-item .di-icon.gold { background: #fef3c7; color: #92400e; }
    .doc-item .di-icon.green { background: #d1fae5; color: #065f46; }
    .doc-item .di-icon.purple { background: #ede9fe; color: #5b21b6; }
    .doc-item .di-icon.red { background: #fee2e2; color: #991b1b; }

    .doc-item:hover {
      background: #eff6ff;
      border-color: #93c5fd;
      color: var(--blue);
      text-decoration: none;
      transform: translateX(3px);
    }

    .doc-item .di-label { flex: 1; font-weight: 500; line-height: 1.35; }
    .doc-item .di-arrow { color: #cbd5e1; font-size: 11px; }
    .doc-item:hover .di-arrow { color: var(--sky); }

    /* Sub accordion inside body */
    .sub-trigger {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 11px 14px;
      border-radius: 10px;
      background: white;
      border: 1px solid var(--border);
      font-size: 13px;
      color: var(--text);
      width: 100%;
      text-align: left;
      font-family: 'DM Sans', sans-serif;
      font-weight: 500;
      cursor: pointer;
      margin-bottom: 7px;
      transition: all 0.2s;
    }

    .sub-trigger:hover { background: #eff6ff; }
    .sub-trigger.open { background: #dbeafe; border-color: #93c5fd; color: var(--blue); }

    .sub-trigger .di-icon { flex-shrink: 0; }
    .sub-trigger .chevron { margin-left: auto; font-size: 11px; color: #94a3b8; transition: transform 0.25s; }
    .sub-trigger.open .chevron { transform: rotate(180deg); color: var(--blue); }

    .sub-body {
      display: none;
      padding: 6px 0 8px 14px;
      border-left: 2px solid #bfdbfe;
      margin: 0 0 8px 14px;
    }

    .sub-body.open { display: block; }

    .sub-body .doc-item {
      font-size: 12.5px;
      background: #f8fafc;
    }

    /* ─── FOOTER ─── */
    .footer {
      background: var(--navy);
      padding: 18px 22px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }

    .footer-text {
      font-size: 11px;
      color: rgba(255,255,255,0.4);
    }

    .footer-badge {
      font-size: 10px;
      color: var(--gold-light);
      background: rgba(212,160,23,0.12);
      border: 1px solid rgba(212,160,23,0.25);
      padding: 4px 10px;
      border-radius: 20px;
      font-weight: 600;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    /* Divider */
    .divider {
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--border), transparent);
      margin: 4px 22px;
    }

    /* Section label */
    .sec-label {
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 2px;
      color: var(--muted);
      margin-bottom: 12px;
      padding: 0 2px;
    }
  </style>
</head>
<body>

<div class="card">

  <!-- HERO -->
  <div class="hero">
    <div class="hero-inner">
      <div class="logo-ring">
        <img src="https://situbondo.info/wp-content/uploads/2024/04/logo-kabupaten-situbondo-png-3-2.png" alt="Logo Situbondo">
      </div>
      <div class="hero-eyebrow">Pemerintah Kabupaten Situbondo</div>
      <div class="hero-title">
        LKPJ Kabupaten Situbondo
      </div>
    </div>
  </div>
 
  <!-- PANDUAN -->
  <div class="section">
    <div class="sec-label">Panduan Utama</div>
    <a href="https://docs.google.com/spreadsheets/d/1tW9dtlpuX0F2Kn-FpmTqbY7ixtL3AzV02sUMKCgJJjk/edit?usp=drive_link" target="_blank" class="btn-panduan">
      <div class="icon-wrap"><i class="fas fa-book-open-reader"></i></div>
      <div class="text">
        Panduan Pencermatan OPD
        <small>Buka di Google Spreadsheet</small>
      </div>
      <i class="fas fa-arrow-right arrow"></i>
    </a>
  </div>

  <div class="divider"></div>

  <!-- DOKUMEN -->
  <div class="accordion-wrap">
    <div class="sec-label">Dokumen Laporan</div>

    <div class="acc-panel">
      <button class="acc-trigger" onclick="toggleAcc(this)">
        <div class="folder-icon"><i class="fas fa-folder-open"></i></div>
        <span>Dokumen LKPJ Tahun 2025</span>
        <i class="fas fa-chevron-down chevron"></i>
      </button>

      <div class="acc-body">

        <a class="doc-item" href="https://drive.google.com/file/d/1W35vDhVHOt88d9ZC4bRRkSyzAPgOjTlc/view?usp=drive_link" target="_blank">
          <div class="di-icon blue"><i class="fas fa-file"></i></div>
          <div class="di-label">Cover</div>
          <i class="fas fa-chevron-right di-arrow"></i>
        </a>

        <a class="doc-item" href="https://drive.google.com/file/d/1W35vDhVHOt88d9ZC4bRRkSyzAPgOjTlc/view?usp=drive_link" target="_blank">
          <div class="di-icon blue"><i class="fas fa-file-alt"></i></div>
          <div class="di-label">Kata Pengantar</div>
          <i class="fas fa-chevron-right di-arrow"></i>
        </a>

        <a class="doc-item" href="https://docs.google.com/document/d/1iN9i5qQAwL44a355HhVgDckXqjBxE8P99ve4_E6Gmo4/edit?tab=t.0" target="_blank">
          <div class="di-icon blue"><i class="fas fa-list-ul"></i></div>
          <div class="di-label">Daftar Isi</div>
          <i class="fas fa-chevron-right di-arrow"></i>
        </a>

        <a class="doc-item" href="https://docs.google.com/document/d/1ilGNUOPiuR5m6leFVsX1vpWhPfsaTc1MaDETRXnt-pY/edit?usp=drive_link" target="_blank">
          <div class="di-icon gold"><i class="fas fa-book"></i></div>
          <div class="di-label">BAB I — Pendahuluan</div>
          <i class="fas fa-chevron-right di-arrow"></i>
        </a>

        <a class="doc-item" href="https://docs.google.com/document/d/1_5YSxjt2homwJgSdiF52XjBGhaUUHToRIk-VQiMa3XI/edit?usp=drive_link" target="_blank">
          <div class="di-icon gold"><i class="fas fa-book"></i></div>
          <div class="di-label">BAB II — Perubahan Penjabaran APBD</div>
          <i class="fas fa-chevron-right di-arrow"></i>
        </a>

        <!-- SUB ACCORDION BAB III -->
        <button class="sub-trigger" onclick="toggleSub(this, 'bab3')">
          <div class="di-icon gold" style="width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:#fef3c7;color:#92400e;font-size:12px;"><i class="fas fa-book"></i></div>
          <span style="flex:1;font-size:13px;">BAB III — Hasil Penyelenggaraan Urusan Pemerintahan</span>
          <i class="fas fa-chevron-down chevron"></i>
        </button>

        <div class="sub-body" id="bab3">

          <!-- Sub-sub: 3.1 -->
          <button class="sub-trigger" onclick="toggleSub(this, 'bab31')" style="background:#f8fafc;font-size:12.5px;">
            <div class="di-icon purple" style="width:28px;height:28px;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:#ede9fe;color:#5b21b6;font-size:11px;"><i class="fas fa-layer-group"></i></div>
            <span style="flex:1;">3.1 Penyelenggaraan Urusan Pemerintahan</span>
            <i class="fas fa-chevron-down chevron"></i>
          </button>

          <div class="sub-body" id="bab31" style="margin-left:10px;border-color:#c4b5fd;">
            <a class="doc-item" href="https://docs.google.com/document/d/1vwdHJAU6HwTGgb3UeABr4SYB6_YQM0-LsvP_Y3jey1s/edit?usp=drive_link" target="_blank">
              <div class="di-icon purple"><i class="fas fa-circle" style="font-size:8px;"></i></div>
              <div class="di-label">3.1-1 Dokumen Urusan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" href="https://docs.google.com/document/d/1HzY3r8633tx7ML6ZZuz5a6Y8XjLZiT1FL8PFaaucYhs/edit?usp=drive_link" target="_blank">
              <div class="di-icon purple"><i class="fas fa-circle" style="font-size:8px;"></i></div>
              <div class="di-label">3.1-2 Dokumen Urusan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" href="https://docs.google.com/document/d/1IssUVei6Shhi8sajUb69Kw_Bf9BGefD252rDLyUNz2Y/edit?usp=drive_link" target="_blank">
              <div class="di-icon purple"><i class="fas fa-circle" style="font-size:8px;"></i></div>
              <div class="di-label">3.1-3 Dokumen Urusan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" href="https://docs.google.com/document/d/16hrXNcdP78zHbCG6-MdQaiGM95H2jksRFXL7JkbB6Ck/edit?usp=drive_link" target="_blank">
              <div class="di-icon purple"><i class="fas fa-circle" style="font-size:8px;"></i></div>
              <div class="di-label">3.1-4 Dokumen Urusan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" href="https://docs.google.com/document/d/1VlHoHNHke02wb6dbJUeAFBl2Rz-vjiChWXt9pjEe-os/edit?usp=drive_link" target="_blank">
              <div class="di-icon purple"><i class="fas fa-circle" style="font-size:8px;"></i></div>
              <div class="di-label">3.1-5 Dokumen Urusan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" href="https://docs.google.com/document/d/17T_z6lrQhJ9n4FK8usMFPOpvxe_8SRM9c6-sYMszVMQ/edit?usp=drive_link" target="_blank">
              <div class="di-icon purple"><i class="fas fa-circle" style="font-size:8px;"></i></div>
              <div class="di-label">3.1-6 Dokumen Urusan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" href="https://docs.google.com/document/d/15P30lqWfZt42Z4JwFJlARyrb2KPXVTvmzGGCds-h4ak/edit?usp=drive_link" target="_blank">
              <div class="di-icon purple"><i class="fas fa-circle" style="font-size:8px;"></i></div>
              <div class="di-label">3.1-7 Dokumen Urusan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" href="https://docs.google.com/document/d/15J15_1pdCNbIu_eYNrcrPChedjQC5ebGvxOFPdaeZ2I/edit?usp=drive_link" target="_blank">
              <div class="di-icon purple"><i class="fas fa-circle" style="font-size:8px;"></i></div>
              <div class="di-label">3.1-8 Dokumen Urusan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
          </div>

          <a class="doc-item" href="https://docs.google.com/document/d/1haU0rvg5wHxpt8cA7Jk0qFcOzwolybMIZbQJwY6NDds/edit?usp=drive_link" target="_blank">
            <div class="di-icon green"><i class="fas fa-chess-king"></i></div>
            <div class="di-label">3.2 Kebijakan Strategis yang Ditetapkan</div>
            <i class="fas fa-chevron-right di-arrow"></i>
          </a>

          <a class="doc-item" href="https://docs.google.com/document/d/1U50V22w-xWIx31D1AqnEtK-9EI9TJEbINGaQFxBPKxE/edit?usp=drive_link" target="_blank">
            <div class="di-icon green"><i class="fas fa-reply-all"></i></div>
            <div class="di-label">3.3 Tindak Lanjut Rekomendasi DPRD</div>
            <i class="fas fa-chevron-right di-arrow"></i>
          </a>

          <a class="doc-item" href="https://docs.google.com/document/d/1CZVbVR88yB4SJ-yXfZzma-PYNl_bBoKAvBPrAe7aIoU/edit?usp=drive_link" target="_blank">
            <div class="di-icon green"><i class="fas fa-chart-bar"></i></div>
            <div class="di-label">3.4 Capaian Indikator Kinerja Daerah</div>
            <i class="fas fa-chevron-right di-arrow"></i>
          </a>

          <a class="doc-item" href="https://docs.google.com/document/d/1aQ7ByLiTfU3gzqE3vontyz7S1O4Kgzri8HQgl2Af9j0/edit?usp=drive_link" target="_blank">
            <div class="di-icon green"><i class="fas fa-trophy"></i></div>
            <div class="di-label">3.5 Prestasi & Penghargaan Tahun 2025</div>
            <i class="fas fa-chevron-right di-arrow"></i>
          </a>

        </div>

        <a class="doc-item" href="https://docs.google.com/document/d/1edDBHek5sb_Omlc7I5kh-EdYJqj9a8UlIOT1Nv-8syE/edit?usp=drive_link" target="_blank">
          <div class="di-icon red"><i class="fas fa-book"></i></div>
          <div class="di-label">BAB IV — Capaian Kinerja Tugas Pembantuan</div>
          <i class="fas fa-chevron-right di-arrow"></i>
        </a>

        <a class="doc-item" href="https://drive.google.com/file/d/1OMzMq5lCubEsp9upE4HZnsGaKb5KkEWB/view?usp=drive_link" target="_blank">
          <div class="di-icon red"><i class="fas fa-flag-checkered"></i></div>
          <div class="di-label">BAB V — Penutup</div>
          <i class="fas fa-chevron-right di-arrow"></i>
        </a>

      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <div class="footer">
    <div class="footer-text">© 2025 Pemerintah Kabupaten Situbondo</div>
  </div>

</div>

<script>
  function toggleAcc(trigger) {
    const isOpen = trigger.classList.contains('open');
    trigger.classList.toggle('open', !isOpen);
    const body = trigger.nextElementSibling;
    body.classList.toggle('open', !isOpen);
  }

  function toggleSub(trigger, id) {
    const isOpen = trigger.classList.contains('open');
    trigger.classList.toggle('open', !isOpen);
    const body = document.getElementById(id);
    body.classList.toggle('open', !isOpen);
  }
</script>
</body>
</html>