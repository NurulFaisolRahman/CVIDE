<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
  <title>Banyuwangi | Roadmap Hilirisasi 2026</title>
  
  <!-- Google Fonts: Inter (clean & profesional) -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      -webkit-tap-highlight-color: transparent;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #FFFFFF;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }

    /* === SILUET BATIK BANYUWANGI WARNA COKLAT === */
    .batik-siluet {
      position: fixed;
      inset: 0;
      background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" opacity="0.12"><path fill="none" stroke="%238B5A2B" stroke-width="1.2" d="M20 20 L220 20 M20 48 L220 48 M20 76 L220 76 M20 104 L220 104 M20 132 L220 132 M20 160 L220 160 M20 188 L220 188 M20 216 L220 216 M48 20 L48 220 M76 20 L76 220 M104 20 L104 220 M132 20 L132 220 M160 20 L160 220 M188 20 L188 220 M216 20 L216 220"/><path d="M64 64 L88 64 L88 88 L64 88 Z M152 152 L176 152 L176 176 L152 176 Z" fill="%238B5A2B" opacity="0.2"/><circle cx="120" cy="120" r="18" stroke="%238B5A2B" stroke-width="1.1" fill="none"/><circle cx="60" cy="180" r="9" stroke="%238B5A2B" stroke-width="0.9" fill="none"/><circle cx="180" cy="60" r="9" stroke="%238B5A2B" stroke-width="0.9" fill="none"/><path d="M15 15 L35 35 M205 205 L225 225" stroke="%238B5A2B" stroke-width="1" fill="none"/></svg>');
      background-repeat: repeat;
      background-size: 65px;
      pointer-events: none;
      z-index: 0;
    }

    @keyframes batikSlowDrift {
      0% { background-position: 0 0; }
      100% { background-position: 84px 84px; }
    }
    .batik-siluet {
      animation: batikSlowDrift 110s infinite linear;
    }

    .bg-soft-warm {
      position: fixed;
      inset: 0;
      background: radial-gradient(circle at 0% 20%, rgba(245, 235, 215, 0.2), rgba(255, 250, 240, 0.05));
      pointer-events: none;
      z-index: 0;
    }

    /* Container lebih kompak - lebar maksimal 560px */
    .app-container {
      max-width: 560px;
      width: 92%;
      margin: 1.5rem auto;
      padding: 1.5rem 1.3rem 2rem;
      background: #FFFFFF;
      border-radius: 1.75rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04), 0 0 0 1px #F0E6D4;
      position: relative;
      z-index: 2;
    }

    /* Header */
    .header-section {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .logo-img {
      width: 80px;
      height: 80px;
      object-fit: contain;
      background: #FFFFFF;
      padding: 6px;
      border-radius: 100px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
      border: 1px solid #EADBBF;
    }

    .site-title {
      font-size: 1.55rem;
      font-weight: 800;
      margin-top: 0.85rem;
      margin-bottom: 0.2rem;
      letter-spacing: -0.3px;
      color: #2C2416;
    }

    .site-title .gold-accent {
      background: linear-gradient(135deg, #A6752E, #C28A3E);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .site-desc {
      font-size: 0.7rem;
      font-weight: 500;
      color: #8A734C;
      background: #FEF9F1;
      display: inline-block;
      padding: 4px 14px;
      border-radius: 40px;
      margin-top: 8px;
      border: 0.5px solid #EDE0C8;
    }

    /* Search bar compact */
    .search-container {
      margin: 20px 0 22px;
      position: relative;
    }

    .search-input {
      width: 100%;
      padding: 12px 18px 12px 46px;
      border: 1px solid #E8DDC7;
      border-radius: 50px;
      font-size: 0.8rem;
      font-weight: 500;
      background: #FFFFFF;
      color: #2F2A1F;
      transition: 0.2s;
    }

    .search-input:focus {
      outline: none;
      border-color: #CFA959;
      box-shadow: 0 0 0 3px rgba(207, 169, 89, 0.12);
    }

    .search-icon {
      position: absolute;
      left: 20px;
      top: 50%;
      transform: translateY(-50%);
      color: #C28A3E;
      font-size: 0.9rem;
    }

    /* Section header (bab) - langsung list item tanpa dropdown */
    .section-group {
      margin-bottom: 1.75rem;
    }

    .section-title {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 0 10px 0;
      margin-bottom: 8px;
      border-bottom: 2px solid #F0E6D4;
    }

    .section-title i {
      font-size: 1rem;
      width: 28px;
      color: #C28A3E;
    }

    .section-title span {
      font-weight: 700;
      font-size: 0.9rem;
      letter-spacing: -0.2px;
      color: #3E311C;
    }

    .section-badge {
      background: #F4EAD9;
      font-size: 0.6rem;
      padding: 2px 8px;
      border-radius: 30px;
      font-weight: 600;
      color: #AA7A37;
      margin-left: 8px;
    }

    /* Cards langsung - tanpa dropdown, lebih compact */
    .direct-items {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .direct-card {
      display: flex;
      align-items: center;
      gap: 12px;
      background: #FEFCF8;
      padding: 10px 14px;
      border-radius: 18px;
      cursor: pointer;
      transition: all 0.2s ease;
      border: 1px solid #F2EADB;
    }

    .direct-card:hover {
      background: #FFFBF3;
      border-left: 3px solid #D4AF37;
      border-color: #E0CFAF;
      transform: translateX(4px);
    }

    .direct-card i {
      width: 26px;
      font-size: 0.85rem;
      text-align: center;
      color: #BC883E;
    }

    .direct-card .card-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .card-title {
      font-size: 0.8rem;
      font-weight: 600;
      color: #312A1D;
      line-height: 1.3;
    }

    .card-arrow {
      font-size: 0.6rem;
      color: #D7B570;
      opacity: 0.7;
    }

    /* No result */
    .no-result {
      text-align: center;
      background: #FEFCF6;
      border-radius: 32px;
      padding: 24px 16px;
      margin: 16px 0;
      display: none;
      font-weight: 500;
      font-size: 0.75rem;
      color: #B58439;
      border: 1px dashed #E8DCBE;
    }

    .footer {
      text-align: center;
      margin-top: 28px;
      font-size: 0.6rem;
      font-weight: 500;
      color: #BA9862;
      border-top: 1px solid #EFE6D6;
      padding-top: 16px;
    }

    @media (max-width: 480px) {
      .app-container {
        width: 94%;
        padding: 1.2rem 1rem 1.6rem;
        margin: 1rem auto;
      }
      .site-title {
        font-size: 1.35rem;
      }
      .direct-card {
        padding: 8px 12px;
      }
      .card-title {
        font-size: 0.75rem;
      }
      .section-title span {
        font-size: 0.85rem;
      }
    }
  </style>
</head>
<body>
<div class="batik-siluet"></div>
<div class="bg-soft-warm"></div>

<div class="app-container">
  <div class="header-section">
    <img class="logo-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Banyuwangi_Regency_coat_of_arms.svg/250px-Banyuwangi_Regency_coat_of_arms.svg.png" alt="Lambang Banyuwangi">
    <h1 class="site-title">Roadmap Hilirisasi <span class="gold-accent">Banyuwangi 2026</span></h1>
  </div>

  <div class="search-container">
    <i class="fas fa-search search-icon"></i>
    <input type="text" id="searchInput" class="search-input" placeholder="Cari dokumen, bab, atau rencana aksi ...">
  </div>
  
  <div id="dynamicMenuContainer"></div>
  <div id="noResult" class="no-result">
    <i class="fas fa-map-pin"></i> Belum ditemukan · Coba kata kunci lain
  </div>

  <div class="footer">
    <i class="fas fa-light fa-file"></i> Roadmap Hilirisasi Banyuwangi | 2026
  </div>
</div>

<script>
  // ========= DATA BAB 1 – BAB 5 =========
  const menuGroups = [
    {
      groupLabel: "DOKUMEN",
      icon: "fa-book-open",
      items: [
        { name: "DATA", url: "https://docs.google.com/spreadsheets/d/1dTwwtAGaqIKpgCT1pIOG7KmkeQwIDpxy/edit?usp=sharing&ouid=111910061241978135081&rtpof=true&sd=true", icon: "fa-light fa-file-excel" },
        { name: "BAB 1 PENDAHULUAN ", url: "https://docs.google.com/document/d/1CS9U0wZsocBC5lMOi-bvg5It782uwPef/edit?usp=drive_link&ouid=111910061241978135081&rtpof=true&sd=true", icon: "fa-light fa-file" },
        { name: "BAB 2 METODE PENELITIAN", url: "https://docs.google.com/document/d/1z4AX491mpf_chyshcMRkMUzYLPiNM5lUkmgpWnW8uNI/edit?usp=drive_link", icon: "fa-light fa-file" },
        { name: "BAB 3 GAMBARAN UMUM", url: "https://docs.google.com/document/d/1I34Db67PfTaVCGpORnlvAUUMLPrSNo3POuU7L8ZVhL0/edit?usp=drive_link", icon: "fa-light fa-file" },
        { name: "BAB 4 ", url: "https://docs.google.com/document/d/1nFjASYr7xbZRIx-neGCpoNrHEMV2kTgz6zWQVvdn8r0/edit?usp=drive_link", icon: "fa-light fa-file" },
        { name: "BAB 5 PENUTUP", url: "https://docs.google.com/document/d/1UpX1ppizP_SLJX6pR2CpXlKEFhcrzB8lGQUaeLuo86k/edit?usp=drive_link", icon: "fa-light fa-file" }  
    ]
    },
    // {
    //   groupLabel: "BAB 2 · DATA & POTENSI UNGGULAN",
    //   icon: "fa-chart-pie",
    //   items: [
    //     { name: "2.1 Demografi & Profil Wilayah", url: "https://docs.google.com/spreadsheets/d/2-demografi_bwi/edit?usp=drive_link", icon: "fa-users" },
    //     { name: "2.2 Potensi Investasi & Sektor Pariwisata", url: "https://docs.google.com/spreadsheets/d/2-potensi_investasi/edit?usp=drive_link", icon: "fa-chart-simple" },
    //     { name: "2.3 Infrastruktur Digital & Konektivitas", url: "https://docs.google.com/spreadsheets/d/2-infrastruktur_digital/edit?usp=drive_link", icon: "fa-microchip" },
    //     { name: "2.4 Pemetaan CSR & Skema Filantropi", url: "https://docs.google.com/spreadsheets/d/2-pemetaan_csr/edit?usp=drive_link", icon: "fa-hand-holding-heart" }
    //   ]
    // },
    // {
    //   groupLabel: "BAB 3 · ANALISIS ISU & TANTANGAN",
    //   icon: "fa-chart-simple",
    //   items: [
    //     { name: "3.1 Isu Prioritas Daerah & Kesenjangan", url: "https://docs.google.com/spreadsheets/d/3-isu_prioritas/edit?usp=drive_link", icon: "fa-exclamation-triangle" },
    //     { name: "3.2 Peluang Kolaborasi Lintas Sektor", url: "https://docs.google.com/spreadsheets/d/3-kolaborasi_lintas/edit?usp=drive_link", icon: "fa-people-arrows" },
    //     { name: "3.3 Skema KPBU, KAD & Creative Financing", url: "https://docs.google.com/spreadsheets/d/3-skema_pendanaan/edit?usp=drive_link", icon: "fa-coins" }
    //   ]
    // },
    // {
    //   groupLabel: "BAB 4 · RENCANA AKSI & PROGRAM PRIORITAS",
    //   icon: "fa-list-check",
    //   items: [
    //     { name: "4.1 Matriks Rencana Aksi Daerah (RAD)", url: "https://docs.google.com/spreadsheets/d/4-matrik_rencana/edit?usp=drive_link", icon: "fa-table-list" },
    //     { name: "4.2 Program Unggulan Kolaborasi CSR", url: "https://docs.google.com/spreadsheets/d/4-program_csr/edit?usp=drive_link", icon: "fa-seedling" },
    //     { name: "4.3 Target Outcome & Indikator Keberhasilan", url: "https://docs.google.com/spreadsheets/d/4-target_outcome/edit?usp=drive_link", icon: "fa-calendar-week" },
    //     { name: "4.4 Rencana Kolaborasi Pentahelix", url: "https://docs.google.com/spreadsheets/d/4-pentahelix/edit?usp=drive_link", icon: "fa-handshake" }
    //   ]
    // },
    // {
    //   groupLabel: "BAB 5 · MONITORING & KEBERLANJUTAN",
    //   icon: "fa-clipboard-list",
    //   items: [
    //     { name: "5.1 Sistem Monitoring & Evaluasi", url: "https://docs.google.com/spreadsheets/d/5-monev/edit?usp=drive_link", icon: "fa-light fa-file" },
    //     { name: "5.2 Indikator Transparansi & Akuntabilitas", url: "https://docs.google.com/spreadsheets/d/5-transparansi/edit?usp=drive_link", icon: "fa-file-contract" },
    //     { name: "5.3 Rekomendasi Kebijakan Jangka Panjang", url: "https://docs.google.com/spreadsheets/d/5-rekomendasi/edit?usp=drive_link", icon: "fa-lightbulb" }
    //   ]
    // }
  ];

  // Fungsi konfirmasi sweet alert
  function openDocument(itemName, targetUrl) {
    if (!targetUrl || targetUrl.trim() === "") {
      Swal.fire({
        icon: 'info',
        title: 'Dokumen dalam penyusunan',
        text: `"${itemName}" akan segera tersedia. Terima kasih telah berkontribusi mendukung Banyuwangi.`,
        confirmButtonColor: '#C28A3E',
        background: '#FFFFFF',
        iconColor: '#A6752E'
      });
      return;
    }
    Swal.fire({
      title: `<span style="font-weight: 700; font-size:1rem;">📄 ${itemName}</span>`,
      html: `<div style="color:#8A734C; font-size:0.75rem;">Dokumen strategis roadmaps & kolaborasi daerah</div>`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#C28A3E',
      cancelButtonColor: '#B58F4F',
      confirmButtonText: '<i class="fas fa-external-link-alt"></i> Buka Dokumen',
      cancelButtonText: 'Kembali',
      background: '#FFFFFF',
      customClass: {
        popup: 'rounded-2xl border border-[#ECDDBF]',
        confirmButton: 'rounded-full px-5 py-2 text-sm',
        cancelButton: 'rounded-full px-5'
      }
    }).then((res) => {
      if (res.isConfirmed) window.open(targetUrl, '_blank');
    });
  }

  // Render langsung semua item sebagai card (tanpa dropdown)
  let debounceSearch;
  function renderDirectNavigation(searchVal = '') {
    const container = document.getElementById('dynamicMenuContainer');
    if (!container) return;
    container.innerHTML = '';
    const keyword = searchVal.trim().toLowerCase();
    let anyVisible = false;

    for (let group of menuGroups) {
      let filteredItems = [];
      if (keyword === '') {
        filteredItems = group.items;
      } else {
        filteredItems = group.items.filter(item => item.name.toLowerCase().includes(keyword));
      }
      if (filteredItems.length === 0) continue;
      anyVisible = true;

      const sectionDiv = document.createElement('div');
      sectionDiv.className = 'section-group';

      // Header section (judul bab)
      const sectionHeader = document.createElement('div');
      sectionHeader.className = 'section-title';
      sectionHeader.innerHTML = `
        <i class="fas ${group.icon}"></i>
        <span>${group.groupLabel} <span class="section-badge">${filteredItems.length}</span></span>
      `;
      sectionDiv.appendChild(sectionHeader);

      // Items container (card langsung)
      const itemsContainer = document.createElement('div');
      itemsContainer.className = 'direct-items';

      filteredItems.forEach(item => {
        const card = document.createElement('div');
        card.className = 'direct-card';
        card.innerHTML = `
          <i class="fas ${item.icon}"></i>
          <div class="card-content">
            <span class="card-title">${item.name}</span>
            <i class="fas fa-chevron-right card-arrow"></i>
          </div>
        `;
        card.addEventListener('click', () => {
          openDocument(item.name, item.url);
        });
        itemsContainer.appendChild(card);
      });

      sectionDiv.appendChild(itemsContainer);
      container.appendChild(sectionDiv);
    }

    const noResultDiv = document.getElementById('noResult');
    if (keyword !== '' && !anyVisible) {
      noResultDiv.style.display = 'block';
    } else {
      noResultDiv.style.display = 'none';
    }
  }

  function handleSearch() {
    clearTimeout(debounceSearch);
    debounceSearch = setTimeout(() => {
      const inputEl = document.getElementById('searchInput');
      if (inputEl) renderDirectNavigation(inputEl.value);
    }, 200);
  }

  // init
  document.addEventListener('DOMContentLoaded', () => {
    renderDirectNavigation('');
    const searchBox = document.getElementById('searchInput');
    if (searchBox) searchBox.addEventListener('input', handleSearch);
  });
</script>
</body>
</html>