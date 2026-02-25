<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Dinas Sosial Kab. Banyuwangi</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --navy: #0c2340;
      --blue: #1a56db;
      --sky: #3b82f6;
      --teal: #0d7a6e;
      --teal-light: #10b9a8;
      --gold: #d4a017;
      --gold-light: #f5d060;
      --white: #ffffff;
      --off-white: #f4f6fb;
      --text: #1e293b;
      --muted: #64748b;
      --border: #e2e8f0;
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

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background:
        radial-gradient(ellipse 60% 50% at 15% 10%, rgba(26,86,219,0.3) 0%, transparent 65%),
        radial-gradient(ellipse 50% 50% at 85% 85%, rgba(13,122,110,0.2) 0%, transparent 65%),
        radial-gradient(ellipse 40% 40% at 50% 50%, rgba(212,160,23,0.06) 0%, transparent 70%);
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
      box-shadow: 0 32px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.06);
      animation: riseUp 0.7s cubic-bezier(0.22,1,0.36,1) both;
    }

    @keyframes riseUp {
      from { opacity:0; transform: translateY(32px); }
      to   { opacity:1; transform: translateY(0); }
    }

    /* ─── HERO ─── */
    .hero {
      position: relative;
      background: linear-gradient(160deg, #0c2340 0%, #0f3460 55%, #1a56db 100%);
      padding: 40px 28px 38px;
      text-align: center;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url("https://asset-2.tstatic.net/surabaya/foto/bank/images/kantor-pemkab-banyuwangi-kantor-pemkab-banyuwangi.jpg") center/cover;
      opacity: 0.1;
    }

    .hero::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0; right: 0;
      height: 4px;
      background: linear-gradient(90deg, transparent, var(--teal-light), var(--gold-light), var(--teal-light), transparent);
    }

    .hero-inner { position: relative; z-index: 1; }

    .logo-ring {
      width: 92px; height: 92px;
      margin: 0 auto 18px;
      border-radius: 50%;
      background: rgba(255,255,255,0.97);
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 0 0 4px rgba(13,122,110,0.5), 0 8px 28px rgba(0,0,0,0.35);
      padding: 7px;
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
      color: var(--teal-light);
      margin-bottom: 8px;
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: 24px;
      font-weight: 800;
      color: var(--white);
      line-height: 1.2;
      letter-spacing: -0.3px;
    }

    .hero-title span {
      display: block;
      font-size: 13.5px;
      font-family: 'DM Sans', sans-serif;
      font-weight: 400;
      color: rgba(255,255,255,0.6);
      letter-spacing: 0.5px;
      margin-top: 6px;
    }

    /* ─── ACCORDION WRAPPER ─── */
    .accordion-wrap {
      padding: 20px 20px 24px;
    }

    .sec-label {
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 2px;
      color: var(--muted);
      margin-bottom: 12px;
      padding: 0 2px;
    }

    /* ─── LEVEL 1 PANEL ─── */
    .l1-panel {
      border: 1px solid var(--border);
      border-radius: 14px;
      overflow: hidden;
      margin-bottom: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    .l1-trigger {
      display: flex;
      align-items: center;
      gap: 12px;
      width: 100%;
      padding: 15px 18px;
      background: linear-gradient(135deg, #0c2340, #1a3a7a);
      border: none;
      cursor: pointer;
      text-align: left;
      font-family: 'DM Sans', sans-serif;
      font-weight: 600;
      font-size: 13.5px;
      color: white;
      transition: all 0.25s ease;
    }

    .l1-trigger:hover { filter: brightness(1.15); }

    .l1-trigger.open {
      background: linear-gradient(135deg, #0c2340, #1a56db);
      border-radius: 14px 14px 0 0;
    }

    .l1-trigger .l1-icon {
      width: 36px; height: 36px;
      background: rgba(255,255,255,0.12);
      border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      border: 1px solid rgba(255,255,255,0.2);
    }

    .l1-trigger .l1-icon i { color: var(--gold-light); font-size: 14px; }

    .l1-trigger .chevron {
      margin-left: auto;
      color: rgba(255,255,255,0.5);
      transition: transform 0.3s;
      font-size: 11px;
    }

    .l1-trigger.open .chevron { transform: rotate(180deg); color: var(--gold-light); }

    .l1-body {
      display: none;
      background: var(--off-white);
      padding: 12px;
      border-top: 2px solid rgba(26,86,219,0.15);
    }

    .l1-body.open { display: block; animation: fadeSlide 0.25s ease; }

    @keyframes fadeSlide {
      from { opacity:0; transform: translateY(-6px); }
      to   { opacity:1; transform: translateY(0); }
    }

    /* ─── LEVEL 2 PANEL ─── */
    .l2-panel {
      border: 1px solid var(--border);
      border-radius: 11px;
      overflow: hidden;
      margin-bottom: 8px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }

    .l2-trigger {
      display: flex;
      align-items: center;
      gap: 10px;
      width: 100%;
      padding: 12px 14px;
      background: white;
      border: none;
      cursor: pointer;
      text-align: left;
      font-family: 'DM Sans', sans-serif;
      font-weight: 600;
      font-size: 12.5px;
      color: var(--navy);
      transition: all 0.2s;
    }

    .l2-trigger:hover { background: #eff6ff; }

    .l2-trigger.open { background: #dbeafe; color: var(--blue); }

    .l2-trigger .l2-icon {
      width: 30px; height: 30px;
      background: #dbeafe;
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      border: 1px solid #bfdbfe;
    }

    .l2-trigger .l2-icon i { color: var(--blue); font-size: 12px; }
    .l2-trigger.open .l2-icon { background: var(--blue); border-color: var(--blue); }
    .l2-trigger.open .l2-icon i { color: white; }

    .l2-trigger .chevron {
      margin-left: auto;
      color: #94a3b8;
      font-size: 11px;
      transition: transform 0.25s;
    }

    .l2-trigger.open .chevron { transform: rotate(180deg); color: var(--blue); }

    .l2-body {
      display: none;
      padding: 10px;
      background: #f8fafc;
      border-top: 1px solid var(--border);
    }

    .l2-body.open { display: block; }

    /* ─── DOC ITEMS ─── */
    .doc-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 11px 13px;
      border-radius: 9px;
      background: white;
      border: 1px solid var(--border);
      font-size: 12.5px;
      color: var(--text);
      text-decoration: none;
      margin-bottom: 6px;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      font-weight: 500;
      transition: all 0.2s;
      line-height: 1.4;
    }

    .doc-item:last-child { margin-bottom: 0; }

    .doc-item .di-icon {
      width: 28px; height: 28px;
      border-radius: 7px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      font-size: 11px;
    }

    .di-blue   { background: #dbeafe; color: #1d4ed8; }
    .di-teal   { background: #ccfbf1; color: #0f766e; }
    .di-gold   { background: #fef3c7; color: #92400e; }
    .di-green  { background: #d1fae5; color: #065f46; }
    .di-purple { background: #ede9fe; color: #5b21b6; }
    .di-red    { background: #fee2e2; color: #991b1b; }
    .di-slate  { background: #f1f5f9; color: #475569; }

    .doc-item:hover {
      background: #eff6ff;
      border-color: #93c5fd;
      color: var(--blue);
      text-decoration: none;
      transform: translateX(3px);
    }

    .doc-item .di-label { flex: 1; }
    .doc-item .di-arrow { color: #cbd5e1; font-size: 10px; flex-shrink: 0; }
    .doc-item:hover .di-arrow { color: var(--sky); }

    /* ─── FOOTER ─── */
    .footer {
      background: var(--navy);
      padding: 16px 22px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .footer-text { font-size: 11px; color: rgba(255,255,255,0.38); }

    .footer-badge {
      font-size: 10px;
      color: var(--teal-light);
      background: rgba(13,122,110,0.15);
      border: 1px solid rgba(13,122,110,0.3);
      padding: 4px 10px;
      border-radius: 20px;
      font-weight: 600;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    /* icon color variants for each section */
    .icon-renstra { background: rgba(212,160,23,0.15); border-color: rgba(212,160,23,0.3); }
    .icon-renstra i { color: var(--gold-light); }
    .icon-renja26 { background: rgba(13,122,110,0.15); border-color: rgba(13,122,110,0.3); }
    .icon-renja26 i { color: var(--teal-light); }
    .icon-renja27 { background: rgba(59,130,246,0.15); border-color: rgba(59,130,246,0.3); }
    .icon-renja27 i { color: #93c5fd; }
  </style>
</head>
<body>

<div class="card">

  <!-- HERO -->
  <div class="hero">
    <div class="hero-inner">
      <div class="logo-ring">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Banyuwangi_Regency_coat_of_arms.svg/779px-Banyuwangi_Regency_coat_of_arms.svg.png" alt="Logo Banyuwangi">
      </div>
      <div class="hero-eyebrow">Kabupaten Banyuwangi</div>
      <div class="hero-title">
        Dinas Sosial
        <span>Dokumen Perencanaan Strategis</span>
      </div>
    </div>
  </div>

  <!-- ACCORDION -->
  <div class="accordion-wrap">
    <div class="sec-label">Dokumen Perencanaan</div>

    <!-- ═══ RENSTRA ═══ -->
    <div class="l1-panel">
      <button class="l1-trigger" onclick="toggleL1(this)">
        <div class="l1-icon icon-renstra"><i class="fas fa-folder-open"></i></div>
        <span>Rencana Strategis</span>
        <i class="fas fa-chevron-down chevron"></i>
      </button>
      <div class="l1-body">
        <div class="l2-panel">
          <button class="l2-trigger" onclick="toggleL2(this)">
            <div class="l2-icon"><i class="fas fa-file-lines"></i></div>
            <span>Versi Inmendagri</span>
            <i class="fas fa-chevron-down chevron"></i>
          </button>
          <div class="l2-body">
            <a class="doc-item" onclick="window.open('https://drive.google.com/drive/folders/1lJANC_9GEyln88UUK0c9UBkEoYSEHik7?usp=drive_link')">
              <div class="di-icon di-slate"><i class="fas fa-folder-open"></i></div>
              <div class="di-label">Kumpulan Data</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/spreadsheets/d/1LAlh2NSaYfoxc-szvtvi_YpingSb-t93fd2eHazaL38/edit?usp=drive_link')">
              <div class="di-icon di-green"><i class="fas fa-table"></i></div>
              <div class="di-label">Kebutuhan BAB II</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/spreadsheets/d/1RGJkEdyN6kVzkj6zU4qriIYomLbAx45DAlDCsfs3Yxs/edit?usp=drive_link')">
              <div class="di-icon di-green"><i class="fas fa-table"></i></div>
              <div class="di-label">Kebutuhan BAB III</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/spreadsheets/d/1r5NuyymaPcXlPtAEWrqCkOPsPEqVWvjSbfFMRmYH9S0/edit?usp=drive_link')">
              <div class="di-icon di-green"><i class="fas fa-table"></i></div>
              <div class="di-label">Kebutuhan BAB IV</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://drive.google.com/file/d/1_EmHbIrQL3URC1JxNvT_JsWg3pcnYLmY/view?usp=drive_link')">
              <div class="di-icon di-gold"><i class="fas fa-file-pdf"></i></div>
              <div class="di-label">Ranwal Renstra</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://drive.google.com/file/d/1K1gIpgPDk0KdLepmJtq2DVEl_c9Ezn-k/view?usp=drive_link')">
              <div class="di-icon di-gold"><i class="fas fa-file-pdf"></i></div>
              <div class="di-label">Rankhir Renstra</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1Kp6MZxS-lwFX6yyWYJbVy8s3O22CVpXn/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-blue"><i class="fas fa-list-ul"></i></div>
              <div class="di-label">Daftar Isi</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1XKBKjz1i9f10XaKXOHwLv1ka74ejkqfZ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-blue"><i class="fas fa-table-list"></i></div>
              <div class="di-label">Daftar Tabel</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1O1Lx3fmJfjU3ssWHNSxvBcNOLVG9WZWt/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-blue"><i class="fas fa-images"></i></div>
              <div class="di-label">Daftar Gambar</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1DX_CgfuGRwQrERmJlcQ_EsS6CY9GXznR/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-purple"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB I — Pendahuluan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1ANgpaY0AoG3hhP0qTAd5yflHmTWnTlTI/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-purple"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB II — Gambaran Pelayanan Perangkat Daerah</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1pzmUdA5DtBOul5oY3If6eNkuFTILTp62/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-purple"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB III — Tujuan, Sasaran, Strategi & Arah Kebijakan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1YY7rNL8yMb42ke7BuR52t1q1VJbd1KSi/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-purple"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB IV — Program, Kegiatan, Sub Kegiatan & Kinerja</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1WaKpGVKE4naxM6Xo_kp4UM0jPmajdpXJ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-red"><i class="fas fa-flag-checkered"></i></div>
              <div class="di-label">BAB V — Penutup</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- ═══ RENJA 2026 ═══ -->
    <div class="l1-panel">
      <button class="l1-trigger" onclick="toggleL1(this)">
        <div class="l1-icon icon-renja26"><i class="fas fa-calendar-check"></i></div>
        <span>Rencana Kerja 2026</span>
        <i class="fas fa-chevron-down chevron"></i>
      </button>
      <div class="l1-body">
        <div class="l2-panel">
          <button class="l2-trigger" onclick="toggleL2(this)">
            <div class="l2-icon"><i class="fas fa-file-lines"></i></div>
            <span>Versi Permendagri</span>
            <i class="fas fa-chevron-down chevron"></i>
          </button>
          <div class="l2-body">
            <a class="doc-item" onclick="window.open('https://drive.google.com/drive/folders/1lXgIZDk4Dv70UZt0rsLUxPpFT303m9Ha?usp=drive_link')">
              <div class="di-icon di-slate"><i class="fas fa-folder-open"></i></div>
              <div class="di-label">Kumpulan Data</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/spreadsheets/d/1daVkM8c1GcbpVFLQuBeaq1wsFz69v0B-ZGJJb0wYnMA/edit?usp=drive_link')">
              <div class="di-icon di-green"><i class="fas fa-table"></i></div>
              <div class="di-label">Kebutuhan BAB II</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/spreadsheets/d/1NXp8UvgtOfersAsbzbPDvCobFJ63P_GLu-ysjeQ5z4U/edit?usp=drive_link')">
              <div class="di-icon di-green"><i class="fas fa-table"></i></div>
              <div class="di-label">Kebutuhan BAB III</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1BSptQkE8FNZTXJ0hvSgyIAqsNQVtIVP9/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-blue"><i class="fas fa-list-ul"></i></div>
              <div class="di-label">Daftar Isi</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1Cp_G5kPOIAAgy2jtznA6AM9JhbmhhSYX/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-blue"><i class="fas fa-table-list"></i></div>
              <div class="di-label">Daftar Tabel</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1iO-zvqogr8LB7V4iAHkFqF24qxf_taXz/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-blue"><i class="fas fa-images"></i></div>
              <div class="di-label">Daftar Gambar</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/19kmEeXTOfnOsicbelQ7nUyK2_38bYpmM/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-teal"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB I — Pendahuluan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1z8xZbZiHq50bCO7uqVeCMT-sP9ZYNygq/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-teal"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB II — Hasil Evaluasi Renja Perangkat Daerah Tahun Lalu</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1NxeOTkTLjJHm7uBoLsBQIePeNPMJiGB_/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-teal"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB III — Tujuan dan Sasaran Perangkat Daerah</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1ToWkjo14l6zb6uiix4S_PT09DmzP2-Y8/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-teal"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB IV — Rencana Kerja dan Pendanaan Perangkat Daerah</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1GwackUv1sPRbkWZIgDTIT4BJc7nfoNlU/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-red"><i class="fas fa-flag-checkered"></i></div>
              <div class="di-label">BAB V — Penutup</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- ═══ RENJA 2027 ═══ -->
    <div class="l1-panel">
      <button class="l1-trigger" onclick="toggleL1(this)">
        <div class="l1-icon icon-renja27"><i class="fas fa-calendar-days"></i></div>
        <span>Rencana Kerja 2027</span>
        <i class="fas fa-chevron-down chevron"></i>
      </button>
      <div class="l1-body">
        <div class="l2-panel">
          <button class="l2-trigger" onclick="toggleL2(this)">
            <div class="l2-icon"><i class="fas fa-file-lines"></i></div>
            <span>Versi Permendagri</span>
            <i class="fas fa-chevron-down chevron"></i>
          </button>
          <div class="l2-body">
            <a class="doc-item" onclick="window.open('https://drive.google.com/drive/folders/1FSwIB4V3rY_k91jaKex0nWHeIga-_8Z5?usp=drive_link')">
              <div class="di-icon di-slate"><i class="fas fa-folder-open"></i></div>
              <div class="di-label">Kumpulan Data</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/spreadsheets/d/1qSD4XQlZm06bcCm1y0eeLy0QC9mFaLzQ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-green"><i class="fas fa-table"></i></div>
              <div class="di-label">Kebutuhan BAB II</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/spreadsheets/d/1nUsSfcB4ou-SO_xk0Gsl30lptoyBLRKJ/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-green"><i class="fas fa-table"></i></div>
              <div class="di-label">Kebutuhan BAB III</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1WbXkJ2PLp7G-HofhCt5F0Y0vRQTEBFmb/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-blue"><i class="fas fa-list-ul"></i></div>
              <div class="di-label">Daftar Isi</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1FEoTILfK5ZVuLzvfCy8gldYsrXFoFDlg/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-blue"><i class="fas fa-table-list"></i></div>
              <div class="di-label">Daftar Tabel</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/17SHZoZyOzOk9LuBRA1lzejcI9GXLj92P/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-blue"><i class="fas fa-images"></i></div>
              <div class="di-label">Daftar Gambar</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1BMvOpjRXi7duitYgKvfthYF90j-NDELn/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-sky"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB I — Pendahuluan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1nfSb1Q2y8qrTeY9BvTKjzaNtSk9XR6iV/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-sky"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB II — Hasil Evaluasi Renja</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1fZpigAUmYs7DL6rRYy1JlTCREXixsJPm/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-sky"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB III — Tujuan dan Sasaran</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/18fHj0q0JP5I_TR0iZRiRwQB2M253Wpw2/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-sky"><i class="fas fa-book-open"></i></div>
              <div class="di-label">BAB IV — Rencana Kerja dan Pendanaan</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
            <a class="doc-item" onclick="window.open('https://docs.google.com/document/d/1QqL_ecN3MCmID4_4e8qdaERuvbg0zf2K/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true')">
              <div class="di-icon di-red"><i class="fas fa-flag-checkered"></i></div>
              <div class="di-label">BAB V — Penutup</div>
              <i class="fas fa-chevron-right di-arrow"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- FOOTER -->
  <div class="footer">
    <div class="footer-text">© 2025 Dinas Sosial Kab. Banyuwangi</div>
    <div class="footer-badge">RENSTRA · RENJA</div>
  </div>

</div>

<style>
  /* sky color not defined above */
  .di-sky { background: #dbeafe; color: #1d4ed8; }
</style>

<script>
  function toggleL1(trigger) {
    const isOpen = trigger.classList.contains('open');
    // Close all L1
    document.querySelectorAll('.l1-trigger').forEach(t => {
      t.classList.remove('open');
      t.nextElementSibling.classList.remove('open');
    });
    if (!isOpen) {
      trigger.classList.add('open');
      trigger.nextElementSibling.classList.add('open');
    }
  }

  function toggleL2(trigger) {
    const isOpen = trigger.classList.contains('open');
    trigger.classList.toggle('open', !isOpen);
    trigger.nextElementSibling.classList.toggle('open', !isOpen);
  }
</script>
</body>
</html>