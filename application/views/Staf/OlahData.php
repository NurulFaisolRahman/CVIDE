<?php
$userLevel = (int)($this->session->userdata('level') ?? 3);
$hasActiveDaerah = !empty($ActiveDaerah);
$activeId = $hasActiveDaerah ? (int)$ActiveDaerah['Id'] : 0;
$masterKategori = $MasterKategori ?? array();
$selectedKategori = $SelectedKategori ?? '';
$selectedSubKategori = $SelectedSubKategori ?? '';
$kategoriStats = $KategoriStats ?? array();
?>

<style>
  /* Modal Overlay & Z-Index Protection */
  .modal {
    z-index: 1055 !important;
  }
  .modal-backdrop {
    z-index: 1050 !important;
  }

  /* Header Card */
  .olah-header-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid var(--ide-border) !important;
    box-shadow: 0 8px 24px rgba(4, 49, 104, 0.05);
    padding: 20px 24px;
    margin-bottom: 22px;
  }

  /* Breadcrumb Navigation */
  .olah-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 12px;
  }
  .olah-breadcrumb a {
    color: var(--ide-navy);
    text-decoration: none;
    transition: color 0.2s ease;
  }
  .olah-breadcrumb a:hover {
    color: #0369a1;
    text-decoration: underline;
  }
  
  /* Katalog Daerah Cards */
  .daerah-card {
    background: #ffffff;
    border-radius: 18px;
    border: 1.5px solid #e2e8f0;
    box-shadow: 0 4px 16px rgba(4, 49, 104, 0.04);
    transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
  }
  .daerah-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(4, 49, 104, 0.1);
    border-color: #93c5fd;
  }
  .daerah-card-header {
    background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%);
    padding: 20px;
    color: #ffffff;
    position: relative;
  }
  .daerah-card-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-bottom: 12px;
    color: #ffffff;
  }
  .daerah-card-title {
    font-size: 17px;
    font-weight: 800;
    margin-bottom: 4px;
    letter-spacing: 0.3px;
    color: #ffffff;
  }
  .daerah-card-body {
    padding: 18px 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .daerah-meta-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 10px;
    font-size: 11.5px;
    font-weight: 700;
    background: #f8fafc;
    color: #334155;
    border: 1px solid #e2e8f0;
    margin-right: 6px;
    margin-bottom: 8px;
  }
  .btn-buka-daerah {
    border-radius: 12px;
    font-weight: 700;
    padding: 9px 18px;
    font-size: 13px;
    background: var(--ide-navy);
    color: #ffffff !important;
    border: none;
    box-shadow: 0 4px 12px rgba(4, 49, 104, 0.25);
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none !important;
  }
  .btn-buka-daerah:hover {
    background: #064796;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(4, 49, 104, 0.35);
  }

  /* 5 Card Kategori Pilihan */
  .category-card {
    background: #ffffff;
    border-radius: 18px;
    border: 1.5px solid #e2e8f0;
    box-shadow: 0 4px 18px rgba(4, 49, 104, 0.05);
    transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
    position: relative;
    cursor: pointer;
  }
  .category-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 36px rgba(4, 49, 104, 0.12);
    border-color: #38bdf8;
  }
  .category-card-header {
    padding: 22px 20px;
    color: #ffffff;
    position: relative;
  }
  .category-badge-pill {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(4px);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.5px;
    color: #ffffff;
    text-transform: uppercase;
  }
  .category-icon-box {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: rgba(255, 255, 255, 0.22);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #ffffff;
    margin-bottom: 14px;
  }
  .category-title {
    font-size: 16px;
    font-weight: 800;
    color: #ffffff;
    line-height: 1.35;
    margin-bottom: 6px;
  }
  .category-card-body {
    padding: 18px 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .subkat-chip {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 7px 12px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 6px;
    transition: background 0.2s;
  }
  .subkat-chip:hover {
    background: #f1f5f9;
  }
  .subkat-chip .badge-code {
    width: 22px;
    height: 22px;
    border-radius: 6px;
    background: var(--ide-navy);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 800;
    flex-shrink: 0;
  }

  /* Navigasi Kategori Aktif (Pill Bar) */
  .kategori-nav-wrapper {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    padding: 12px 16px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
    margin-bottom: 20px;
  }
  .kategori-nav-btn {
    border-radius: 12px;
    font-weight: 700;
    font-size: 12.5px;
    padding: 9px 16px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: 1.5px solid #e2e8f0;
    background: #ffffff;
    color: #475569;
    text-decoration: none !important;
    transition: all 0.2s ease;
    white-space: nowrap;
  }
  .kategori-nav-btn:hover {
    border-color: #94a3b8;
    background: #f8fafc;
    color: #1e293b;
  }
  .kategori-nav-btn.active {
    background: var(--ide-navy);
    border-color: var(--ide-navy);
    color: #ffffff !important;
    box-shadow: 0 4px 14px rgba(4, 49, 104, 0.25);
  }

  /* Sub Kategori Pills Nav */
  .subkat-nav-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
  }
  .subkat-nav-item {
    cursor: pointer;
    border-radius: 12px;
    font-weight: 700;
    font-size: 13px;
    padding: 10px 18px;
    background: #ffffff;
    border: 1.5px solid #cbd5e1;
    color: #334155;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none !important;
  }
  .subkat-nav-item:hover {
    background: #f8fafc;
    border-color: #94a3b8;
  }
  .subkat-nav-item.active {
    background: #0284c7;
    border-color: #0284c7;
    color: #ffffff !important;
    box-shadow: 0 4px 14px rgba(2, 132, 199, 0.28);
  }
  .subkat-nav-item .badge-count {
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 800;
    background: rgba(0, 0, 0, 0.08);
  }
  .subkat-nav-item.active .badge-count {
    background: rgba(255, 255, 255, 0.25);
    color: #ffffff;
  }

  /* Indikator Table & Badges */
  .tahun-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    background: #f1f5f9;
    color: #1e293b;
    border: 1px solid #cbd5e1;
    transition: all 0.2s ease;
  }
  .tahun-pill:hover {
    background: #e2e8f0;
  }
  .tahun-pill .btn-del-tahun {
    cursor: pointer;
    color: #94a3b8;
    transition: color 0.2s ease;
    padding-left: 3px;
  }
  .tahun-pill .btn-del-tahun:hover {
    color: #dc2626;
  }
  .badge-gender {
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.3px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .badge-gender-total {
    background: #f1f5f9;
    color: #334155;
    border: 1px solid #cbd5e1;
  }
  .badge-gender-laki {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
  }
  .badge-gender-perempuan {
    background: #fdf2f8;
    color: #be185d;
    border: 1px solid #fbcfe8;
  }
  .badge-gender-lp {
    background: #fefce8;
    color: #a16207;
    border: 1px solid #fef08a;
  }
  .satuan-badge {
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    background: #f8fafc;
    color: #475569;
    border: 1px solid #e2e8f0;
    display: inline-block;
  }
  .val-cell {
    font-family: 'Consolas', 'Courier New', monospace;
    font-weight: 700;
    font-size: 13px;
    color: #0f172a;
    text-align: center;
    cursor: pointer;
    position: relative;
    transition: background 0.2s ease;
    min-width: 90px;
  }
  .val-cell:hover {
    background: #f0fdf4 !important;
  }
  .val-cell:hover::after {
    content: '\f304';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    right: 4px;
    top: 4px;
    font-size: 9px;
    color: #16a34a;
    opacity: 0.7;
  }
  .val-empty {
    color: #cbd5e1;
    font-style: italic;
    font-size: 12px;
  }
  .btn-action-table {
    width: 32px;
    height: 32px;
    border-radius: 8px !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    font-size: 13px;
    transition: all 0.2s ease;
    border: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
  }
  .btn-action-table:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.16);
  }
  .inline-edit-input {
    width: 100%;
    padding: 2px 6px;
    font-size: 12.5px;
    font-weight: 700;
    border: 2px solid #0284c7;
    border-radius: 6px;
    text-align: center;
    background: #ffffff;
  }
  .cell-saved-flash {
    animation: flashGreen 1.2s ease;
  }
  @keyframes flashGreen {
    0% { background-color: #86efac; }
    100% { background-color: transparent; }
  }

  /* Komparasi Daerah Styles */
  .btn-tab-main-view {
    color: #64748b;
    background: transparent;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .btn-tab-main-view:hover {
    color: var(--ide-navy);
  }
  .btn-tab-main-view.active {
    background: #ffffff !important;
    color: var(--ide-navy) !important;
    box-shadow: 0 4px 12px rgba(4, 49, 104, 0.12) !important;
  }
  .custom-checkbox-compare .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #38bdf8;
    border-color: #38bdf8;
  }
  .custom-checkbox-compare .custom-control-label::before {
    border-radius: 6px;
    border: 2px solid rgba(255, 255, 255, 0.85);
    background: rgba(255, 255, 255, 0.25);
    width: 20px;
    height: 20px;
  }
  .custom-checkbox-compare .custom-control-label::after {
    width: 20px;
    height: 20px;
  }
  .daerah-card.selected-for-compare {
    border: 2.5px solid #0284c7 !important;
    box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.2), 0 16px 36px rgba(4, 49, 104, 0.16) !important;
  }
  .floating-compare-bar {
    position: fixed;
    bottom: 24px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1050;
    background: #0f172a;
    color: #ffffff;
    border-radius: 18px;
    padding: 12px 20px;
    min-width: 320px;
    max-width: 90vw;
    width: 780px;
    border: 1.5px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.45);
    animation: slideUpFloating 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
  }
  @keyframes slideUpFloating {
    from { transform: translate(-50%, 60px); opacity: 0; }
    to { transform: translate(-50%, 0); opacity: 1; }
  }
  .floating-badge-counter {
    background: rgba(255, 255, 255, 0.15);
    padding: 6px 12px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 800;
    color: #38bdf8;
    letter-spacing: 0.3px;
  }
  .compare-chip {
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 8px;
    padding: 4px 10px;
    font-size: 11.5px;
    font-weight: 700;
    color: #ffffff;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .compare-chip .btn-remove-chip {
    cursor: pointer;
    color: #f87171;
    font-size: 12px;
  }
  .compare-chip .btn-remove-chip:hover {
    color: #ef4444;
  }

  /* Styling Tabel Komparasi */
  .table-komparasi th {
    vertical-align: middle !important;
    text-align: center;
    font-size: 12px;
  }
  .th-region-1 {
    background: linear-gradient(135deg, #043168 0%, #0369a1 100%) !important;
    color: #ffffff !important;
  }
  .th-region-2 {
    background: linear-gradient(135deg, #065f46 0%, #059669 100%) !important;
    color: #ffffff !important;
  }
  .th-region-3 {
    background: linear-gradient(135deg, #9a3412 0%, #d97706 100%) !important;
    color: #ffffff !important;
  }
  .th-year-1 {
    background: #eff6ff !important;
    color: #1e3a8a !important;
    font-weight: 700;
  }
  .th-year-2 {
    background: #ecfdf5 !important;
    color: #064e3b !important;
    font-weight: 700;
  }
  .th-year-3 {
    background: #fffbeb !important;
    color: #78350f !important;
    font-weight: 700;
  }
  .val-cell-comp-1 {
    background: #f8fafc;
    font-family: 'Consolas', monospace;
    font-weight: 700;
    text-align: center;
    font-size: 12.5px;
    color: #0284c7;
  }
  .val-cell-comp-2 {
    background: #f8fafc;
    font-family: 'Consolas', monospace;
    font-weight: 700;
    text-align: center;
    font-size: 12.5px;
    color: #059669;
  }
  .val-cell-comp-3 {
    background: #f8fafc;
    font-family: 'Consolas', monospace;
    font-weight: 700;
    text-align: center;
    font-size: 12.5px;
    color: #d97706;
  }
  .badge-selisih-pos {
    background: #dcfce7;
    color: #15803d;
    border: 1px solid #86efac;
    padding: 3px 8px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 11px;
    display: inline-block;
  }
  .badge-selisih-neg {
    background: #fee2e2;
    color: #b91c1c;
    border: 1px solid #fca5a5;
    padding: 3px 8px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 11px;
    display: inline-block;
  }
  .badge-selisih-zero {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #cbd5e1;
    padding: 3px 8px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 11px;
    display: inline-block;
  }
</style>

<?php if (!$hasActiveDaerah): ?>
  <!-- =========================================================================
       HALAMAN PERTAMA: KATALOG DAFTAR DAERAH
       ========================================================================= -->
  <div class="row" style="margin-top: 22px;">
    <div class="col-12">
      <div class="olah-header-card">
        <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 16px;">
          <div class="d-flex align-items-center" style="gap: 16px;">
            <div style="width: 52px; height: 52px; border-radius: 14px; background: linear-gradient(135deg, rgba(4, 49, 104, 0.1) 0%, rgba(180, 8, 20, 0.1) 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
              <i class="fa-solid fa-map-location-dot" style="color: var(--ide-navy); font-size: 24px;"></i>
            </div>
            <div>
              <div class="d-flex align-items-center" style="gap: 10px;">
                <h4 class="font-weight-bold text-dark mb-0" style="font-size: 18px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                  Katalog Olah Data Daerah
                </h4>
                <span class="badge badge-primary px-2 py-1" style="background: var(--ide-navy); font-size: 11px; font-weight: 600; border-radius: 6px;">
                  <?= count($DaerahList) ?> Daerah
                </span>
              </div>
              <p class="text-muted mb-0 mt-1" style="font-size: 12.5px;">
                Pilih salah satu daerah di bawah untuk membuka data, memilih kategori, sub-kategori, dan mengolah tabel indikator.
              </p>
            </div>
          </div>

          <div class="d-flex align-items-center flex-wrap" style="gap: 10px;">
           
            <button type="button" class="btn btn-primary btnBukaModalTambahDaerah" data-toggle="modal" data-target="#ModalInputDaerah" style="border-radius: 12px; font-weight: 700; font-size: 13px; padding: 10px 22px; background: var(--ide-navy); border: none; box-shadow: 0 4px 14px rgba(4, 49, 104, 0.3); display: inline-flex; align-items: center; gap: 8px;">
              <i class="fa-solid fa-plus-circle"></i> Tambah Daerah Baru
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab Pilihan Mode Halaman: Katalog Daerah vs Komparasi Antar Daerah -->
  <div class="row" style="margin-top: 14px; margin-bottom: 12px;">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 12px;">
        <div class="p-1 d-inline-flex" style="background: #e2e8f0; border-radius: 14px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);">
          <button type="button" class="btn font-weight-bold btn-tab-main-view active" id="btnTabKatalogView" style="border-radius: 11px; padding: 9px 22px; font-size: 13px; border: none;">
            <i class="fa-solid fa-city mr-1.5 text-primary"></i> Katalog Daerah (<?= count($DaerahList) ?>)
          </button>
          <button type="button" class="btn font-weight-bold btn-tab-main-view" id="btnTabKomparasiView" style="border-radius: 11px; padding: 9px 24px; font-size: 13px; border: none;">
            <i class="fa-solid fa-code-compare mr-1.5 text-success"></i> Komparasi Antar Daerah (Maks. 3)
          </button>
        </div>
      </div>
    </div>
  </div>

  <div id="sectionKatalogDaerah">
  <!-- Grid Kartu Nama Daerah -->
  <div class="row align-items-stretch">
    <?php if (!empty($DaerahList)): ?>
      <?php foreach ($DaerahList as $d): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="daerah-card" id="cardDaerah_<?= $d['Id'] ?>">
            <div class="daerah-card-header">
              <div class="d-flex align-items-center justify-content-between">
                <div class="daerah-card-icon">
                  <i class="fa-solid fa-city"></i>
                </div>
                <div class="d-flex align-items-center">
                  <span class="badge badge-light px-2 py-1" style="font-size: 11px; font-weight: 700; border-radius: 6px; color: var(--ide-navy);">
                    <?= $d['YearsCount'] ?> Kolom Tahun
                  </span>
                </div>
              </div>
              <h5 class="daerah-card-title"><?= htmlspecialchars($d['NamaDaerah']) ?></h5>
              <div style="font-size: 11.5px; opacity: 0.85;">
                Tahun Aktif: <?= htmlspecialchars($d['RentangTahun']) ?>
              </div>
            </div>
            <div class="daerah-card-body">
              <div class="mb-3">
                <p class="text-muted mb-3" style="font-size: 12.5px; line-height: 1.5; min-height: 38px;">
                  <?= !empty($d['Keterangan']) ? htmlspecialchars($d['Keterangan']) : 'Basis data olahan indikator pembangunan 5 kategori daerah.' ?>
                </p>
                <div>
                  <span class="daerah-meta-chip">
                    <i class="fa-solid fa-table-list text-primary"></i> <b><?= $d['TotalIndikator'] ?></b> Indikator
                  </span>
                  <span class="daerah-meta-chip">
                    <i class="fa-regular fa-calendar-days text-success"></i> <?= htmlspecialchars($d['RentangTahun']) ?>
                  </span>
                </div>
              </div>

              <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid #f1f5f9;">
                <a href="<?= base_url('Staf/OlahData?daerah_id='.$d['Id']) ?>" class="btn-buka-daerah">
                  <span>Buka Olah Data</span> <i class="fa-solid fa-arrow-right"></i>
                </a>

                <div class="d-flex align-items-center" style="gap: 5px;">
                  <button type="button" class="btn btn-sm btn-outline-primary btn-toggle-compare-card" 
                          data-id="<?= $d['Id'] ?>" 
                          data-nama="<?= htmlspecialchars($d['NamaDaerah'], ENT_QUOTES) ?>" 
                          title="Bandingkan daerah ini" style="border-radius: 8px; height: 34px; font-size: 11.5px; font-weight: 700; padding: 0 8px; display: inline-flex; align-items: center; gap: 4px;">
                    <i class="fa-solid fa-code-compare"></i> <span>Bandingkan</span>
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-warning btnEditDaerah" 
                          data-id="<?= $d['Id'] ?>" 
                          data-nama="<?= htmlspecialchars($d['NamaDaerah'], ENT_QUOTES) ?>" 
                          data-ket="<?= htmlspecialchars($d['Keterangan'] ?? '', ENT_QUOTES) ?>"
                          title="Edit Info Daerah" style="border-radius: 8px; width: 34px; height: 34px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-danger btnHapusDaerah" 
                          data-id="<?= $d['Id'] ?>" 
                          data-nama="<?= htmlspecialchars($d['NamaDaerah'], ENT_QUOTES) ?>" 
                          title="Hapus Daerah" style="border-radius: 8px; width: 34px; height: 34px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-5 px-3" style="border-radius: 20px;">
          <div style="width: 70px; height: 70px; border-radius: 20px; background: rgba(4, 49, 104, 0.08); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
            <i class="fa-solid fa-map-location-dot" style="font-size: 32px; color: var(--ide-navy);"></i>
          </div>
          <h5 class="font-weight-bold text-dark mb-1">Belum Ada Daerah Yang Didaftarkan</h5>
          <p class="text-muted mx-auto mb-4" style="max-width: 480px; font-size: 13px;">
            Silakan tambahkan nama daerah/wilayah pertama untuk mulai mengolah data indikator dan tahun analisis.
          </p>
          <div>
            <button type="button" class="btn btn-primary btnBukaModalTambahDaerah" data-toggle="modal" data-target="#ModalInputDaerah" style="border-radius: 12px; font-weight: 700; padding: 10px 24px; background: var(--ide-navy); border: none;">
              <i class="fa-solid fa-plus-circle mr-1"></i> Tambah Daerah Sekarang
            </button>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
  </div> <!-- /sectionKatalogDaerah -->

  <!-- =========================================================================
       TAMPILAN KOMPARASI ANTAR DAERAH (HALAMAN PENUH / DI LUAR MODAL)
       ========================================================================= -->
  <div id="sectionKomparasiDaerah" style="display: none; margin-top: 6px;">
    <!-- Card Pilih 3 Slot Daerah (Dropdown Slot) -->
    <div class="card border-0 shadow-sm mb-3" style="border-radius: 16px; background: #ffffff;">
      <div class="card-body p-4">
        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap" style="gap: 8px;">
          <span class="font-weight-bold text-dark" style="font-size: 13.5px;">
            <i class="fa-solid fa-layer-group text-primary mr-1"></i> Pilih Daerah yang Dibandingkan (Maksimal 3 Daerah):
          </span>
          <span class="text-muted font-italic" style="font-size: 12px;">Pilih slot daerah lalu klik tombol <b>Terapkan Daerah</b>.</span>
        </div>

        <div class="row">
          <!-- Slot 1 (Biru) -->
          <div class="col-md-4 mb-2 mb-md-0">
            <div class="p-3 rounded border" style="background: #f0f9ff; border-color: #bae6fd !important; border-left: 5px solid #0284c7 !important;">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold" style="font-size: 11.5px; color: #0369a1; text-transform: uppercase;">
                  <i class="fa-solid fa-location-dot mr-1"></i> Daerah 1 (Utama)
                </span>
                <span class="badge badge-primary px-2 py-0.5" style="font-size: 10.5px; background: #0284c7;">Slot 1</span>
              </div>
              <select class="form-control form-control-sm font-weight-bold select-slot-daerah" id="slotDaerah1" style="border-radius: 8px; height: 38px; font-size: 13px;">
                <option value="">-- Pilih Daerah 1 --</option>
                <?php foreach ($DaerahList as $dl): ?>
                  <option value="<?= $dl['Id'] ?>"><?= htmlspecialchars($dl['NamaDaerah']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <!-- Slot 2 (Hijau) -->
          <div class="col-md-4 mb-2 mb-md-0">
            <div class="p-3 rounded border" style="background: #f0fdf4; border-color: #bbf7d0 !important; border-left: 5px solid #10b981 !important;">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold" style="font-size: 11.5px; color: #047857; text-transform: uppercase;">
                  <i class="fa-solid fa-location-dot mr-1"></i> Daerah 2
                </span>
                <span class="badge badge-success px-2 py-0.5" style="font-size: 10.5px; background: #10b981;">Slot 2</span>
              </div>
              <select class="form-control form-control-sm font-weight-bold select-slot-daerah" id="slotDaerah2" style="border-radius: 8px; height: 38px; font-size: 13px;">
                <option value="">-- Pilih Daerah 2 --</option>
                <?php foreach ($DaerahList as $dl): ?>
                  <option value="<?= $dl['Id'] ?>"><?= htmlspecialchars($dl['NamaDaerah']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <!-- Slot 3 (Oranye) -->
          <div class="col-md-4">
            <div class="p-3 rounded border" style="background: #fffbeb; border-color: #fde68a !important; border-left: 5px solid #f59e0b !important;">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-weight-bold" style="font-size: 11.5px; color: #b45309; text-transform: uppercase;">
                  <i class="fa-solid fa-location-dot mr-1"></i> Daerah 3 (Opsional)
                </span>
                <span class="badge badge-warning text-dark px-2 py-0.5" style="font-size: 10.5px; background: #fde68a;">Slot 3</span>
              </div>
              <select class="form-control form-control-sm font-weight-bold select-slot-daerah" id="slotDaerah3" style="border-radius: 8px; height: 38px; font-size: 13px;">
                <option value="">-- Kosong / Pilih Daerah 3 --</option>
                <?php foreach ($DaerahList as $dl): ?>
                  <option value="<?= $dl['Id'] ?>"><?= htmlspecialchars($dl['NamaDaerah']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top">
          <span id="compareMetaNotice" class="text-muted" style="font-size: 12px;"></span>
          <button type="button" class="btn btn-primary" id="btnRefreshKomparasi" style="border-radius: 10px; font-weight: 700; font-size: 13px; padding: 9px 24px; background: var(--ide-navy); border: none; box-shadow: 0 4px 12px rgba(4, 49, 104, 0.2);">
            <i class="fa-solid fa-arrows-rotate mr-1.5"></i> Terapkan Daerah
          </button>
        </div>
      </div>
    </div>

    <!-- Card Filter & Toolbar Komparasi (Dropdown Filter) -->
    <div class="card border-0 shadow-sm mb-3" style="border-radius: 16px; background: #ffffff;">
      <div class="card-body p-4">
        <div class="row align-items-center">
          <div class="col-md-3 mb-2 mb-md-0">
            <label class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Filter Kategori:</label>
            <select class="form-control" id="filterKomparasiKategori" style="border-radius: 8px; height: 38px; font-size: 12.5px;">
              <option value="ALL">Semua Kategori (Pilar 1 - 5)</option>
              <option value="GEOGRAFI DAN DEMOGRAFI (KEPENDUDUKAN)">1. GEOGRAFI & DEMOGRAFI</option>
              <option value="KESEJAHTERAAN MASYARAKAT (SOSIAL)">2. KESEJAHTERAAN MASYARAKAT</option>
              <option value="INFRASTRUKTUR DAN PELAYANAN UMUM">3. INFRASTRUKTUR & PELAYANAN UMUM</option>
              <option value="EKONOMI DAN DAYA SAING DAERAH">4. EKONOMI & DAYA SAING</option>
              <option value="KAPASITAS KEUANGAN DAERAH">5. KAPASITAS KEUANGAN DAERAH</option>
            </select>
          </div>

          <div class="col-md-3 mb-2 mb-md-0">
            <label class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Filter Sub-Kategori:</label>
            <select class="form-control" id="filterKomparasiSub" style="border-radius: 8px; height: 38px; font-size: 12.5px;">
              <option value="ALL">Semua Sub-Kategori</option>
            </select>
          </div>

          <div class="col-md-3 mb-2 mb-md-0">
            <label class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Tampilan Kolom Tahun:</label>
            <select class="form-control" id="filterKomparasiTahun" style="border-radius: 8px; height: 38px; font-size: 12.5px;">
              <option value="ALL">Semua Kolom Tahun</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="font-weight-bold text-dark mb-1" style="font-size: 12px;">Cari Indikator:</label>
            <div class="input-group">
              <input type="text" class="form-control" id="searchKomparasiIndikator" placeholder="Ketik nama indikator..." style="border-radius: 8px 0 0 8px; height: 38px; font-size: 12.5px;">
              <div class="input-group-append">
                <span class="input-group-text bg-white" style="border-radius: 0 8px 8px 0;"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Box Loading Indicator -->
    <div id="loadingKomparasi" class="text-center py-5 card border-0 shadow-sm mb-3" style="border-radius: 16px; background: #ffffff; display: none;">
      <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="sr-only">Memuat data...</span>
      </div>
      <p class="font-weight-bold text-dark mt-3 mb-0" style="font-size: 14px;">Memuat Matriks Komparasi Indikator Daerah...</p>
    </div>

    <!-- Container Hasil Komparasi (Grafik & Tabel) -->
    <div id="containerKomparasiResult" style="display: none;">

      <!-- CARD 3: GRAFIK & VISUALISASI KOMPARASI (LANGSUNG DI BAWAH CARD DROPDOWN) -->
      <div class="card border-0 shadow-sm mb-4" id="cardKomparasiGrafik" style="border-radius: 16px; background: #ffffff;">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between flex-wrap pb-3 mb-3 border-bottom" style="gap: 12px;">
            <div class="d-flex align-items-center" style="gap: 10px;">
              <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(2, 132, 199, 0.1); color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                <i class="fa-solid fa-chart-line"></i>
              </div>
              <div>
                <h5 class="font-weight-bold text-dark mb-0" style="font-size: 16px;">
                  Grafik Visualisasi Tren & Benchmark Daerah
                </h5>
                <small class="text-muted" id="lblKomparasiInfoRingkasChart">Perbandingan indikator pembangunan antar daerah.</small>
              </div>
            </div>

            <!-- Kontrol Tipe Chart & Satuan -->
            <div class="d-flex align-items-center flex-wrap" style="gap: 10px;">
              <span class="badge badge-light border p-2" id="badgeSatuanChart" style="font-size: 12px; border-radius: 8px;">
                Satuan: <b class="text-primary" id="lblSatuanChart">-</b>
              </span>
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-sm btn-primary active btn-toggle-chart-type" data-type="line" id="btnTypeLine" style="border-radius: 8px 0 0 8px; font-weight: 700; padding: 6px 14px;">
                  <i class="fa-solid fa-chart-line mr-1"></i> Line (Garis)
                </button>
                <button type="button" class="btn btn-sm btn-outline-primary btn-toggle-chart-type" data-type="bar" id="btnTypeBar" style="border-radius: 0 8px 8px 0; font-weight: 700; padding: 6px 14px;">
                  <i class="fa-solid fa-chart-column mr-1"></i> Bar (Batang)
                </button>
              </div>
            </div>
          </div>

          <!-- Selector Indikator yang Dianalisis -->
          <div class="p-3 mb-3 rounded" style="background: #f8fafc; border: 1.5px solid #e2e8f0;">
            <div class="row align-items-center">
              <div class="col-12">
                <label class="font-weight-bold text-dark mb-1" style="font-size: 12px;">
                  <i class="fa-solid fa-chart-simple text-primary mr-1"></i> Pilih Indikator yang Ditampilkan dalam Grafik:
                </label>
                <select class="form-control font-weight-bold" id="selectChartIndikator" style="border-radius: 8px; font-size: 13px; height: 38px;">
                  <!-- Diisi via JS -->
                </select>
              </div>
            </div>
          </div>

          <!-- Stat Cards Perbandingan Indikator Terpilih -->
          <div class="row mb-3" id="containerStatCardsChart"></div>

          <!-- Canvas Grafik Utama Tren Tahunan -->
          <div class="card border p-4 mb-4 shadow-sm" style="border-radius: 16px; background: #ffffff; padding: 22px 24px 28px 24px;">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div>
                <h6 class="font-weight-bold text-dark mb-0" style="font-size: 15px;" id="titleMainChart">
                  Grafik Tren Waktu Antar Daerah
                </h6>
                <small class="text-muted font-italic">Pergerakan angka per tahun dari masing-masing daerah.</small>
              </div>
            </div>
            <div style="position: relative; height: 380px; width: 100%; margin-bottom: 12px;">
              <canvas id="canvasKomparasiChart"></canvas>
            </div>
          </div>

          <!-- Jarak Pemisah Antar Diagram -->
          <div style="height: 24px;"></div>

          <!-- Canvas Grafik Benchmark Sub-Kategori -->
          <div class="card border p-4 shadow-sm" style="border-radius: 16px; background: #ffffff; margin-top: 16px !important; border: 1.5px solid #e2e8f0;" id="boxMultiSubChart">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div>
                <h6 class="font-weight-bold text-dark mb-0" style="font-size: 15px;" id="titleMultiSubChart">
                  Benchmark Seluruh Indikator Sub-Kategori
                </h6>
                <small class="text-muted font-italic" id="subTitleMultiSubChart">Perbandingan indikator dalam sub-kategori aktif untuk tahun yang dipilih.</small>
              </div>
            </div>
            <div style="position: relative; height: 380px; width: 100%; margin-top: 10px;">
              <canvas id="canvasMultiSubChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- CARD 4: TABEL MATRIKS KOMPARASI INDIKATOR LENGKAP (DI BAWAH GRAFIK) -->
      <div class="card border-0 shadow-sm mb-4" id="cardKomparasiTabel" style="border-radius: 16px; background: #ffffff;">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between flex-wrap pb-3 mb-3 border-bottom" style="gap: 12px;">
            <div class="d-flex align-items-center" style="gap: 10px;">
              <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                <i class="fa-solid fa-table-cells"></i>
              </div>
              <div>
                <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                  <h5 class="font-weight-bold text-dark mb-0" style="font-size: 16px;">
                    Matriks Perbandingan Indikator Lengkap
                  </h5>
                  <span class="badge badge-light border text-muted" id="badgeTotalRowsKomparasi" style="font-size: 12px; padding: 4px 10px;">0 Baris</span>
                  <span class="badge" id="badgeTahunKomparasiAktif" style="font-size: 12px; padding: 4px 10px; background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; font-weight: 700; display: none;">Semua Tahun</span>
                </div>
                <small class="text-muted" id="lblKomparasiInfoRingkas">Data olahan indikator antar daerah berdampingan.</small>
              </div>
            </div>

            <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
              <!-- Dropdown Pilih Tahun di Sebelah Kanan Matriks -->
              <div class="d-flex align-items-center" style="background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 3px 10px; gap: 8px;">
                <label for="filterTabelTahunKomparasi" class="font-weight-bold text-dark mb-0" style="font-size: 12px; white-space: nowrap;">
                  <i class="fa-regular fa-calendar-days text-primary mr-1"></i> Pilih Tahun:
                </label>
                <select class="form-control form-control-sm border-0 font-weight-bold" id="filterTabelTahunKomparasi" style="height: 30px; font-size: 12.5px; min-width: 160px; background: transparent; cursor: pointer; color: #0f172a; padding: 0 4px;">
                  <option value="ALL">Semua Kolom Tahun</option>
                </select>
              </div>

              <button type="button" class="btn btn-sm btn-outline-secondary" id="btnExportCsvKomparasi" style="border-radius: 8px; font-weight: 600; font-size: 12px; padding: 7px 14px;">
                <i class="fa-solid fa-file-csv mr-1"></i> Ekspor CSV
              </button>
              <button type="button" class="btn btn-sm btn-outline-primary" id="btnPrintKomparasi" style="border-radius: 8px; font-weight: 600; font-size: 12px; padding: 7px 14px;">
                <i class="fa-solid fa-print mr-1"></i> Cetak
              </button>
            </div>
          </div>

          <div class="table-responsive" style="max-height: 70vh; overflow-y: auto;">
            <table class="table table-hover table-bordered table-sm mb-0 table-komparasi" id="tabelKomparasiData">
              <thead id="theadKomparasi"></thead>
              <tbody id="tbodyKomparasi"></tbody>
            </table>
          </div>
        </div>
      </div>

    </div> <!-- /containerKomparasiResult -->
  </div> <!-- /sectionKomparasiDaerah -->

<?php else: ?>
  <!-- =========================================================================
       HALAMAN KEDUA: OLAH DATA DAERAH TERBUKA (PILIH KATEGORI -> SUB KATEGORI -> TABEL)
       ========================================================================= -->
  
  <?php
  // Cek kategori aktif
  $activeKatData = null;
  if (!empty($selectedKategori) && isset($masterKategori[$selectedKategori])) {
    $activeKatData = $masterKategori[$selectedKategori];
  }

  // Tentukan sub kategori aktif
  $activeSubCode = '';
  $activeSubData = null;
  if ($activeKatData) {
    if (!empty($selectedSubKategori) && isset($activeKatData['sub'][$selectedSubKategori])) {
      $activeSubCode = $selectedSubKategori;
    } else {
      // Default-kan ke sub-kategori pertama (A)
      $keys = array_keys($activeKatData['sub']);
      $activeSubCode = $keys[0] ?? 'A';
    }
    $activeSubData = $activeKatData['sub'][$activeSubCode] ?? null;
  }

  // Kelompokkan Indikator berdasarkan Kategori dan SubKategori
  $groupedIndikator = array();
  foreach ($IndikatorList as $item) {
    $k = trim($item['Kategori'] ?? '');
    $s = trim($item['SubKategori'] ?? '');
    $groupedIndikator[$k][$s][] = $item;
  }
  ?>

  <!-- Header Card Daerah -->
  <div class="row" style="margin-top: 22px;">
    <div class="col-12">
      <div class="olah-header-card">
        <!-- Breadcrumb Navigasi -->
        <div class="olah-breadcrumb">
          <a href="<?= base_url('Staf/OlahData') ?>"><i class="fa-solid fa-arrow-left mr-1"></i> Katalog Daerah</a>
          <span>/</span>
          <span class="text-dark font-weight-bold"><?= htmlspecialchars($ActiveDaerah['NamaDaerah']) ?></span>
          <?php if ($activeKatData): ?>
            <span>/</span>
            <a href="<?= base_url('Staf/OlahData?daerah_id='.$activeId) ?>">Kategori: <?= htmlspecialchars($activeKatData['nama']) ?></a>
            <?php if ($activeSubData): ?>
              <span>/</span>
              <span class="text-primary font-weight-bold"><?= $activeSubCode ?>. <?= htmlspecialchars($activeSubData['nama']) ?></span>
            <?php endif; ?>
          <?php else: ?>
            <span>/</span>
            <span class="text-primary font-weight-bold">Pilih Kategori</span>
          <?php endif; ?>
        </div>

        <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 16px;">
          <div class="d-flex align-items-center" style="gap: 16px;">
            <div style="width: 52px; height: 52px; border-radius: 14px; background: linear-gradient(135deg, rgba(4, 49, 104, 0.1) 0%, rgba(180, 8, 20, 0.1) 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
              <i class="fa-solid fa-chart-pie" style="color: var(--ide-navy); font-size: 24px;"></i>
            </div>
            <div>
              <div class="d-flex align-items-center" style="gap: 10px;">
                <h4 class="font-weight-bold text-dark mb-0" style="font-size: 20px; font-weight: 800; letter-spacing: 0.3px;">
                  <?= htmlspecialchars($ActiveDaerah['NamaDaerah']) ?>
                </h4>
                <span class="badge badge-primary px-2 py-1" style="background: var(--ide-navy); font-size: 11px; font-weight: 600; border-radius: 6px;">
                  <?= count($IndikatorList) ?> Indikator Terdaftar
                </span>
              </div>
              <p class="text-muted mb-0 mt-1" style="font-size: 12.5px;">
                <?= !empty($ActiveDaerah['Keterangan']) ? htmlspecialchars($ActiveDaerah['Keterangan']) : 'Pengolahan indikator daerah berbasis 5 kategori & sub-kategori pembangunan.' ?>
              </p>
            </div>
          </div>

          <!-- Aksi Cepat: Inisialisasi Indikator & Tambah Tahun -->
          <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
            <button type="button" class="btn btn-sm btn-outline-info" id="btnInisialisasiStandar" data-daerah-id="<?= $activeId ?>" style="border-radius: 10px; font-weight: 700; font-size: 12px; padding: 7px 14px; display: inline-flex; align-items: center; gap: 6px;" title="Pastikan seluruh indikator template 5 kategori lengkap terdaftar di daerah ini">
              <i class="fa-solid fa-list-check"></i> Muat Indikator Standar
            </button>
            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#ModalTambahTahun" style="border-radius: 10px; font-weight: 700; font-size: 12px; padding: 7px 14px; display: inline-flex; align-items: center; gap: 6px;">
              <i class="fa-solid fa-calendar-plus"></i> Tambah Kolom Tahun
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Kolom Tahun Aktif Bar -->
  <div class="row mb-3">
    <div class="col-12">
      <div class="card border-0 shadow-sm" style="border-radius: 14px; background: #ffffff;">
        <div class="card-body p-2 px-3">
          <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 10px;">
            <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
              <span class="font-weight-bold text-dark d-inline-flex align-items-center mr-2" style="font-size: 12px;">
                <i class="fa-regular fa-calendar-days text-primary mr-1"></i> Kolom Tahun Aktif:
              </span>

              <?php if (!empty($TahunList)): ?>
                <?php foreach ($TahunList as $thn): ?>
                  <span class="tahun-pill">
                    <?= htmlspecialchars($thn) ?>
                    <i class="fa-solid fa-circle-xmark btn-del-tahun" 
                       data-daerah-id="<?= $ActiveDaerah['Id'] ?>" 
                       data-tahun="<?= htmlspecialchars($thn, ENT_QUOTES) ?>" 
                       title="Hapus kolom tahun <?= $thn ?>"></i>
                  </span>
                <?php endforeach; ?>
              <?php else: ?>
                <span class="text-muted" style="font-size: 11.5px; font-style: italic;">Belum ada tahun. Klik Tambah Kolom Tahun di kanan atas.</span>
              <?php endif; ?>
            </div>

            <div class="text-muted font-italic" style="font-size: 11.5px;">
              <i class="fa-solid fa-lightbulb text-warning mr-1"></i> Tips: Klik pada cell nilai di tabel untuk mengedit angka secara langsung.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if (!$activeKatData): ?>
    <!-- =======================================================================
         LANGKAH 1: PILIH DULU KATEGORINYA (5 KATEGORI PILIHAN UTAMA)
         ======================================================================= -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <div>
            <h5 class="font-weight-bold text-dark mb-1" style="font-size: 17px; letter-spacing: 0.3px;">
              <i class="fa-solid fa-layer-group text-primary mr-2"></i> Langkah 1: Pilih Kategori Data
            </h5>
            <p class="text-muted mb-0" style="font-size: 13px;">
              Silakan pilih salah satu dari 5 pilar kategori data pembangunan daerah di bawah untuk melihat sub-kategori dan tabel indikatornya:
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- 5 Card Grid Kategori Utama -->
    <div class="row align-items-stretch">
      <?php foreach ($masterKategori as $kKey => $kat): 
        $stat = $kategoriStats[$kat['nama']] ?? array('total' => 0, 'filled' => 0, 'subs' => array());
        $totalSub = count($kat['sub']);
      ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="category-card" onclick="window.location.href='<?= base_url('Staf/OlahData?daerah_id='.$activeId.'&kategori='.$kKey) ?>'">
            <div class="category-card-header" style="background: <?= $kat['gradient'] ?>;">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="category-badge-pill">Kategori <?= $kat['nomor'] ?></span>
                <span class="badge badge-light px-2 py-1 font-weight-bold" style="font-size: 11px; border-radius: 6px; color: #1e293b;">
                  <?= $totalSub ?> Sub Kategori
                </span>
              </div>
              <div class="category-icon-box">
                <i class="<?= $kat['icon'] ?>"></i>
              </div>
              <h5 class="category-title"><?= htmlspecialchars($kat['nama']) ?></h5>
              <div style="font-size: 12px; opacity: 0.9; line-height: 1.4;">
                <?= htmlspecialchars($kat['deskripsi']) ?>
              </div>
            </div>

            <div class="category-card-body">
              <div class="mb-3">
                <div class="font-weight-bold text-dark mb-2" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                  Sub Kategori:
                </div>
                <?php foreach ($kat['sub'] as $subK => $subV): 
                  // Hitung riil dari database (dinamis bertambah saat indikator baru diinput)
                  $countInd = 0;
                  if (!empty($groupedIndikator[$kat['nama']][$subV['nama']])) {
                    $countInd = count($groupedIndikator[$kat['nama']][$subV['nama']]);
                  } elseif (isset($stat['subs'][$subV['nama']]['total'])) {
                    $countInd = (int)$stat['subs'][$subV['nama']]['total'];
                  } else {
                    foreach ($groupedIndikator as $gK => $gSubs) {
                      if (strcasecmp(trim($gK), trim($kat['nama'])) === 0) {
                        foreach ($gSubs as $gS => $gItems) {
                          if (strcasecmp(trim($gS), trim($subV['nama'])) === 0) {
                            $countInd = count($gItems);
                            break 2;
                          }
                        }
                      }
                    }
                    if ($countInd === 0 && !empty($subV['indikator'])) {
                      $countInd = count($subV['indikator']);
                    }
                  }
                ?>
                  <div class="subkat-chip">
                    <span class="badge-code"><?= $subK ?></span>
                    <span class="flex-grow-1 text-truncate"><?= htmlspecialchars($subV['nama']) ?></span>
                    <span class="badge badge-light border text-muted" style="font-size: 10.5px;"><?= $countInd ?> Indikator</span>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="d-flex align-items-center justify-content-between pt-3" style="border-top: 1px solid #f1f5f9;">
                <div style="font-size: 12px; color: #64748b;">
                  Status: <b class="text-dark"><?= $stat['total'] ?></b> Indikator Terdaftar
                </div>
                <a href="<?= base_url('Staf/OlahData?daerah_id='.$activeId.'&kategori='.$kKey) ?>" class="btn btn-sm btn-primary" style="border-radius: 10px; font-weight: 700; font-size: 12.5px; padding: 7px 16px; background: var(--ide-navy); border: none; box-shadow: 0 4px 10px rgba(4, 49, 104, 0.2);">
                  Buka Kategori Ini <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  <?php else: ?>
    <!-- =======================================================================
         LANGKAH 2 & 3: KATEGORI TERPILIH -> PILIH SUB KATEGORI -> BARU MUNCUL TABEL
         ======================================================================= -->

    <!-- Bar Navigasi Pindah Kategori -->
    <div class="kategori-nav-wrapper">
      <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 10px;">
        <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
          <a href="<?= base_url('Staf/OlahData?daerah_id='.$activeId) ?>" class="btn btn-sm btn-light font-weight-bold" style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-size: 12px; padding: 7px 14px;" title="Lihat 5 Kartu Kategori Utama">
            <i class="fa-solid fa-arrow-left mr-1"></i> Semua Kategori
          </a>

          <?php foreach ($masterKategori as $kKey => $kat): 
            $isActive = ((string)$kKey === (string)$selectedKategori);
          ?>
            <a href="<?= base_url('Staf/OlahData?daerah_id='.$activeId.'&kategori='.$kKey) ?>" class="kategori-nav-btn <?= $isActive ? 'active' : '' ?>">
              <i class="<?= $kat['icon'] ?>"></i>
              <span><?= $kat['nomor'] ?>. <?= htmlspecialchars($kat['nama']) ?></span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Header Kategori Aktif & Pemilihan Sub Kategori -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 18px; background: #ffffff;">
      <div class="card-body p-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-3" style="border-bottom: 1px solid #f1f5f9; gap: 12px;">
          <div class="d-flex align-items-center" style="gap: 14px;">
            <div style="width: 46px; height: 46px; border-radius: 12px; background: <?= $activeKatData['gradient'] ?>; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 20px;">
              <i class="<?= $activeKatData['icon'] ?>"></i>
            </div>
            <div>
              <div class="d-flex align-items-center" style="gap: 8px;">
                <span class="badge badge-primary px-2 py-1" style="font-size: 11px; font-weight: 800; border-radius: 6px; background: var(--ide-navy);">
                  Kategori <?= $activeKatData['nomor'] ?>
                </span>
                <h4 class="font-weight-bold text-dark mb-0" style="font-size: 18px;">
                  <?= htmlspecialchars($activeKatData['nama']) ?>
                </h4>
              </div>
              <p class="text-muted mb-0 mt-1" style="font-size: 12.5px;">
                <?= htmlspecialchars($activeKatData['deskripsi']) ?>
              </p>
            </div>
          </div>
        </div>

        <!-- Langkah 2: Pilihan Sub Kategori (Tab Navigation) -->
        <div>
          <label class="font-weight-bold text-dark mb-2" style="font-size: 13px; letter-spacing: 0.3px;">
            <i class="fa-solid fa-list-ol text-primary mr-1"></i> Langkah 2: Pilih Sub Kategori:
          </label>
          <div class="subkat-nav-pills">
            <?php foreach ($activeKatData['sub'] as $subK => $subV): 
              $isSubActive = ((string)$subK === (string)$activeSubCode);
              $totalSubInd = 0;
              if (!empty($groupedIndikator[$activeKatData['nama']][$subV['nama']])) {
                $totalSubInd = count($groupedIndikator[$activeKatData['nama']][$subV['nama']]);
              } elseif (isset($kategoriStats[$activeKatData['nama']]['subs'][$subV['nama']]['total'])) {
                $totalSubInd = (int)$kategoriStats[$activeKatData['nama']]['subs'][$subV['nama']]['total'];
              } else {
                foreach ($groupedIndikator as $gK => $gSubs) {
                  if (strcasecmp(trim($gK), trim($activeKatData['nama'])) === 0) {
                    foreach ($gSubs as $gS => $gItems) {
                      if (strcasecmp(trim($gS), trim($subV['nama'])) === 0) {
                        $totalSubInd = count($gItems);
                        break 2;
                      }
                    }
                  }
                }
                if ($totalSubInd === 0 && !empty($subV['indikator'])) {
                  $totalSubInd = count($subV['indikator']);
                }
              }
            ?>
              <a href="<?= base_url('Staf/OlahData?daerah_id='.$activeId.'&kategori='.$selectedKategori.'&sub='.$subK) ?>" class="subkat-nav-item <?= $isSubActive ? 'active' : '' ?>">
                <span style="font-weight: 900;"><?= $subK ?>.</span>
                <span><?= htmlspecialchars($subV['nama']) ?></span>
                <span class="badge-count"><?= $totalSubInd ?> Indikator</span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- =======================================================================
         LANGKAH 3: BARU ADA TABEL TABEL (TABEL INDIKATOR SUB KATEGORI AKTIF)
         ======================================================================= -->
    <?php
    // Ambil baris indikator untuk sub kategori aktif ini
    $currentSubIndikators = $groupedIndikator[$activeKatData['nama']][$activeSubData['nama']] ?? array();
    if (empty($currentSubIndikators)) {
      foreach ($groupedIndikator as $gK => $gSubs) {
        if (strcasecmp(trim($gK), trim($activeKatData['nama'])) === 0) {
          foreach ($gSubs as $gS => $gItems) {
            if (strcasecmp(trim($gS), trim($activeSubData['nama'])) === 0) {
              $currentSubIndikators = $gItems;
              break 2;
            }
          }
        }
      }
    }

    // Jika di database belum ada atau beda format, kita bisa padukan dengan template indikator standar
    $displayRows = array();
    $existingMap = array();
    foreach ($currentSubIndikators as $ci) {
      $existingMap[trim(strtolower($ci['NamaIndikator']))] = $ci;
    }

    if (!empty($activeSubData['indikator'])) {
      foreach ($activeSubData['indikator'] as $stdInd) {
        $namaLower = trim(strtolower($stdInd['nama']));
        if (isset($existingMap[$namaLower])) {
          $displayRows[] = $existingMap[$namaLower];
          unset($existingMap[$namaLower]);
        } else {
          // Placeholder template jika belum tersimpan di DB
          $displayRows[] = array(
            'Id' => 0,
            'DaerahId' => $activeId,
            'NamaIndikator' => $stdInd['nama'],
            'Kategori' => $activeKatData['nama'],
            'SubKategori' => $activeSubData['nama'],
            'Gender' => 'Total',
            'Satuan' => $stdInd['satuan'] ?? '',
            'DataTahunParsed' => array(),
            'ApiUrl' => null,
            'Keterangan' => 'Indikator Standar'
          );
        }
      }
    }
    // Masukkan sisa indikator kustom tambahan di sub kategori ini
    foreach ($existingMap as $rem) {
      $displayRows[] = $rem;
    }
    ?>

    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 18px; background: #ffffff;">
          <div class="card-body p-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3 mb-3" style="gap: 12px; border-bottom: 1px solid #f1f5f9;">
              <div>
                <div class="d-flex align-items-center" style="gap: 8px;">
                  <span class="badge badge-info px-2 py-1" style="font-size: 11px; font-weight: 700; border-radius: 6px; background: #0284c7;">
                    Sub Kategori <?= $activeSubCode ?>
                  </span>
                  <h5 class="font-weight-bold text-dark mb-0" style="font-size: 17px;">
                    Tabel Indikator: <?= htmlspecialchars($activeSubData['nama']) ?>
                  </h5>
                </div>
                <div class="text-muted" style="font-size: 12px; margin-top: 4px;">
                  <?= htmlspecialchars($activeSubData['deskripsi'] ?? '') ?> | Total <b><?= count($displayRows) ?></b> indikator.
                </div>
              </div>

              <!-- Tombol Aksi Tabel -->
              <div class="d-flex flex-wrap align-items-center justify-content-end" style="gap: 10px;">
                <button type="button" class="btn btn-primary btnBukaModalTambahIndikatorManual" 
                        data-toggle="modal" data-target="#ModalInputIndikatorManual"
                        data-default-kategori="<?= htmlspecialchars($activeKatData['nama'], ENT_QUOTES) ?>"
                        data-default-sub="<?= htmlspecialchars($activeSubData['nama'], ENT_QUOTES) ?>"
                        style="border-radius: 10px; font-weight: 700; font-size: 12.5px; padding: 8px 18px; background: var(--ide-navy); border: none; box-shadow: 0 4px 14px rgba(4, 49, 104, 0.25); display: inline-flex; align-items: center; gap: 6px;">
                  <i class="fa-solid fa-plus-circle"></i> Tambah Indikator Manual
                </button>
                <button type="button" class="btn btn-info text-white btnBukaModalTambahIndikatorApi" 
                        data-toggle="modal" data-target="#ModalInputIndikatorApi"
                        data-default-kategori="<?= htmlspecialchars($activeKatData['nama'], ENT_QUOTES) ?>"
                        data-default-sub="<?= htmlspecialchars($activeSubData['nama'], ENT_QUOTES) ?>"
                        style="border-radius: 10px; font-weight: 700; font-size: 12.5px; padding: 8px 18px; background: #0284c7; border: none; box-shadow: 0 4px 14px rgba(2, 132, 199, 0.25); display: inline-flex; align-items: center; gap: 6px;">
                  <i class="fa-solid fa-cloud-arrow-down"></i> Tambah via API
                </button>
                <button type="button" class="btn btn-outline-secondary" onclick="window.print()" style="border-radius: 10px; font-weight: 600; font-size: 12.5px; padding: 8px 16px; border: 1.5px solid #cbd5e1; background: #ffffff; color: #334155; display: inline-flex; align-items: center; gap: 6px;">
                  <i class="fa-solid fa-print"></i> Cetak Tabel
                </button>
              </div>
            </div>

            <!-- Tabel Data Matrix Indikator -->
            <div class="table-responsive">
              <table id="TabelIndikatorSub" class="table table-hover table-striped w-100" style="border-radius: 12px; overflow: hidden;">
                <thead>
                  <tr style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff;">
                    <th style="width: 4%;" class="text-center align-middle">No</th>
                    <th style="width: 28%; min-width: 200px;" class="align-middle">Nama Indikator</th>
                    <th style="width: 9%; min-width: 90px;" class="text-center align-middle">Gender</th>
                    <th style="width: 9%; min-width: 80px;" class="text-center align-middle">Satuan</th>
                    <?php foreach ($TahunList as $thn): ?>
                      <th style="min-width: 95px;" class="text-center align-middle">
                        <?= htmlspecialchars($thn) ?>
                      </th>
                    <?php endforeach; ?>
                    <th style="width: 10%; min-width: 95px;" class="text-center align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  foreach ($displayRows as $ind):
                    $indId = (int)($ind['Id'] ?? 0);
                    $g = strtolower(trim($ind['Gender'] ?? 'total'));
                    $badgeGenderClass = 'badge-gender-total';
                    $genderLabel = 'Total';
                    if ($g === 'laki-laki' || $g === 'l') {
                      $badgeGenderClass = 'badge-gender-laki';
                      $genderLabel = 'Laki-laki';
                    } elseif ($g === 'perempuan' || $g === 'p') {
                      $badgeGenderClass = 'badge-gender-perempuan';
                      $genderLabel = 'Perempuan';
                    } elseif ($g === 'l+p' || $g === 'l + p') {
                      $badgeGenderClass = 'badge-gender-lp';
                      $genderLabel = 'L + P';
                    }
                    $dataThn = $ind['DataTahunParsed'] ?? array();
                  ?>
                    <tr>
                      <td class="text-center align-middle font-weight-bold text-muted"><?= $no++ ?></td>
                      <td class="align-middle">
                        <div class="d-flex align-items-center flex-wrap" style="gap: 6px;">
                          <span class="font-weight-bold text-dark" style="font-size: 13.5px;">
                            <?= htmlspecialchars($ind['NamaIndikator']) ?>
                          </span>
                          <?php if (!empty($ind['ApiUrl'])): ?>
                            <span class="badge badge-info px-2 py-1" style="font-size: 10px; border-radius: 6px; background: #0284c7; color: #ffffff;" title="Sumber API: <?= htmlspecialchars($ind['ApiUrl']) ?>">
                              <i class="fa-solid fa-cloud"></i> API
                            </span>
                          <?php endif; ?>
                        </div>
                        <?php if (!empty($ind['Keterangan'])): ?>
                          <div class="text-muted" style="font-size: 11px; margin-top: 2px;">
                            <?= htmlspecialchars($ind['Keterangan']) ?>
                          </div>
                        <?php endif; ?>
                      </td>
                      <td class="text-center align-middle">
                        <span class="badge-gender <?= $badgeGenderClass ?>">
                          <?= $genderLabel ?>
                        </span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="satuan-badge">
                          <?= htmlspecialchars($ind['Satuan'] ?: '-') ?>
                        </span>
                      </td>
                      <?php foreach ($TahunList as $thn): 
                        $val = isset($dataThn[(string)$thn]) ? (string)$dataThn[(string)$thn] : '';
                      ?>
                        <td class="text-center align-middle val-cell <?= ($indId > 0) ? 'val-cell-editable' : '' ?>"
                            data-indikator-id="<?= $indId ?>"
                            data-indikator-nama="<?= htmlspecialchars($ind['NamaIndikator'], ENT_QUOTES) ?>"
                            data-kategori="<?= htmlspecialchars($activeKatData['nama'], ENT_QUOTES) ?>"
                            data-subkategori="<?= htmlspecialchars($activeSubData['nama'], ENT_QUOTES) ?>"
                            data-satuan="<?= htmlspecialchars($ind['Satuan'] ?? '', ENT_QUOTES) ?>"
                            data-tahun="<?= htmlspecialchars($thn) ?>"
                            data-val="<?= htmlspecialchars($val) ?>"
                            title="Klik untuk mengubah nilai">
                          <?php if ($val !== ''): ?>
                            <span class="val-text"><?= htmlspecialchars($val) ?></span>
                          <?php else: ?>
                            <span class="val-empty">-</span>
                          <?php endif; ?>
                        </td>
                      <?php endforeach; ?>
                      <td class="text-center align-middle">
                        <div class="d-inline-flex align-items-center justify-content-center" style="gap: 5px;">
                          <?php if ($indId > 0): ?>
                            <?php if (!empty($ind['ApiUrl'])): ?>
                              <button type="button" class="btn btn-sm btn-info text-white btn-action-table btnSyncIndikator" 
                                      data-id="<?= $indId ?>"
                                      data-nama="<?= htmlspecialchars($ind['NamaIndikator'], ENT_QUOTES) ?>"
                                      title="Sinkronkan / Tarik Ulang dari API">
                                <i class="fa-solid fa-arrows-rotate"></i>
                              </button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-sm btn-warning text-white btn-action-table btnEditIndikator" 
                                    data-id="<?= $indId ?>"
                                    data-daerah-id="<?= $ind['DaerahId'] ?>"
                                    data-nama="<?= htmlspecialchars($ind['NamaIndikator'], ENT_QUOTES) ?>"
                                    data-api="<?= htmlspecialchars($ind['ApiUrl'] ?? '', ENT_QUOTES) ?>"
                                    data-kategori="<?= htmlspecialchars($ind['Kategori'] ?? '', ENT_QUOTES) ?>"
                                    data-subkategori="<?= htmlspecialchars($ind['SubKategori'] ?? '', ENT_QUOTES) ?>"
                                    data-gender="<?= htmlspecialchars($ind['Gender'] ?? 'Total', ENT_QUOTES) ?>"
                                    data-satuan="<?= htmlspecialchars($ind['Satuan'] ?? '', ENT_QUOTES) ?>"
                                    data-ket="<?= htmlspecialchars($ind['Keterangan'] ?? '', ENT_QUOTES) ?>"
                                    data-tahun='<?= json_encode($dataThn, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                    title="Edit Indikator">
                              <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger btn-action-table btnHapusIndikator" 
                                    data-id="<?= $indId ?>"
                                    data-nama="<?= htmlspecialchars($ind['NamaIndikator'], ENT_QUOTES) ?>"
                                    title="Hapus Indikator">
                              <i class="fa-solid fa-trash-can"></i>
                            </button>
                          <?php else: ?>
                            <!-- Jika belum disimpan di DB, tombol simpan otomatis -->
                            <button type="button" class="btn btn-sm btn-success btn-action-table btnQuickSaveRow" 
                                    data-daerah-id="<?= $activeId ?>"
                                    data-nama="<?= htmlspecialchars($ind['NamaIndikator'], ENT_QUOTES) ?>"
                                    data-kategori="<?= htmlspecialchars($activeKatData['nama'], ENT_QUOTES) ?>"
                                    data-subkategori="<?= htmlspecialchars($activeSubData['nama'], ENT_QUOTES) ?>"
                                    data-satuan="<?= htmlspecialchars($ind['Satuan'] ?? '', ENT_QUOTES) ?>"
                                    title="Aktifkan & Simpan Indikator Standar Ini">
                              <i class="fa-solid fa-plus"></i>
                            </button>
                          <?php endif; ?>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

<?php endif; ?>

<!-- Tutup Kontainer Halaman Utama dari Header.php -->
  </div>
</div>
</div>
</div>

<!-- =========================================================================
     MODAL-MODAL INTERAKTIF
     ========================================================================= -->

<!-- 1. Modal Tambah Daerah Baru -->
<div class="modal fade" id="ModalInputDaerah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
      <div class="modal-header" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff;">
        <h5 class="modal-title font-weight-bold" style="font-size: 16px;">
          <i class="fa-solid fa-map-location-dot mr-2"></i> Tambah Daerah Baru
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
        <form id="FormInputDaerah" onsubmit="return false;">
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Nama Daerah / Wilayah <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="NamaDaerah" id="inNamaDaerah" placeholder="Contoh: Kabupaten Banyuwangi, Kota Malang, dll." required style="border-radius: 10px;">
          </div>
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Kolom Tahun Awal (Opsional)</label>
            <input type="text" class="form-control" name="TahunList" id="inTahunList" placeholder="Contoh: 2020, 2021, 2022, 2023, 2024" style="border-radius: 10px;">
            <small class="text-muted" style="font-size: 11px;">Pisahkan dengan koma. Kosongkan untuk menggunakan 5 tahun terakhir otomatis.</small>
          </div>
          <div class="form-group mb-0">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Keterangan / Catatan</label>
            <textarea class="form-control" name="Keterangan" id="inKeteranganDaerah" rows="2" placeholder="Catatan profil daerah..." style="border-radius: 10px;"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer bg-light" style="border-top: 1px solid #e2e8f0;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: 600;">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSimpanDaerah" style="border-radius: 10px; font-weight: 700; background: var(--ide-navy); border: none;">
          <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Daerah
        </button>
      </div>
    </div>
  </div>
</div>

<!-- 2. Modal Edit Daerah -->
<div class="modal fade" id="ModalEditDaerah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
      <div class="modal-header" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff;">
        <h5 class="modal-title font-weight-bold" style="font-size: 16px;">
          <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Data Daerah
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
        <form id="FormEditDaerah" onsubmit="return false;">
          <input type="hidden" name="Id" id="editDaerahId">
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Nama Daerah / Wilayah <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="NamaDaerah" id="editNamaDaerah" required style="border-radius: 10px;">
          </div>
          <div class="form-group mb-0">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Keterangan / Catatan</label>
            <textarea class="form-control" name="Keterangan" id="editKetDaerah" rows="2" style="border-radius: 10px;"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer bg-light" style="border-top: 1px solid #e2e8f0;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: 600;">Batal</button>
        <button type="button" class="btn btn-primary" id="btnUpdateDaerah" style="border-radius: 10px; font-weight: 700; background: var(--ide-navy); border: none;">
          <i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Daerah
        </button>
      </div>
    </div>
  </div>
</div>

<!-- 3. Modal Tambah Tahun Baru -->
<div class="modal fade" id="ModalTambahTahun" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
      <div class="modal-header" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff;">
        <h5 class="modal-title font-weight-bold" style="font-size: 15px;">
          <i class="fa-solid fa-calendar-plus mr-2"></i> Tambah Kolom Tahun
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-3">
        <form id="FormTambahTahun" onsubmit="return false;">
          <input type="hidden" name="DaerahId" value="<?= $activeId ?>">
          <div class="form-group mb-0">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Masukkan Tahun (4 Digit) <span class="text-danger">*</span></label>
            <input type="number" class="form-control text-center font-weight-bold" name="Tahun" id="inTahunBaru" placeholder="2025" min="1900" max="2100" required style="border-radius: 10px; font-size: 16px;">
            <small class="text-muted" style="font-size: 11px;">Kolom tahun baru akan otomatis ditambahkan ke seluruh tabel indikator.</small>
          </div>
        </form>
      </div>
      <div class="modal-footer bg-light p-2" style="border-top: 1px solid #e2e8f0;">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
        <button type="button" class="btn btn-sm btn-success" id="btnSimpanTahun" style="border-radius: 8px; font-weight: 700;">
          <i class="fa-solid fa-plus mr-1"></i> Tambahkan
        </button>
      </div>
    </div>
  </div>
</div>

<!-- 4A. Modal Input Indikator Manual -->
<div class="modal fade" id="ModalInputIndikatorManual" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
      <div class="modal-header" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff;">
        <h5 class="modal-title font-weight-bold" style="font-size: 16px;">
          <i class="fa-solid fa-pen-to-square mr-2"></i> Tambah Indikator Manual
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4" style="max-height: 80vh; overflow-y: auto;">
        <form id="FormInputIndikatorManual" onsubmit="return false;">
          <input type="hidden" name="DaerahId" value="<?= $activeId ?>">
          <input type="hidden" name="Kategori" id="inManualKategoriIndikator">
          <input type="hidden" name="SubKategori" id="inManualSubKategoriIndikator">

          <!-- Info Lokasi Sub-Kategori Indikator di Atas Sendiri -->
          <div class="card p-3 mb-3 border-0" style="border-radius: 12px; background: #f8fafc; border: 1.5px solid #e2e8f0 !important;">
            <div style="font-size: 11px; text-transform: uppercase; font-weight: 800; color: #64748b; letter-spacing: 0.5px;">Lokasi Sub-Kategori Indikator:</div>
            <div class="font-weight-bold text-dark mt-1" style="font-size: 15px;" id="displayManualSubKategori">-</div>
            <div class="text-muted" style="font-size: 12px;" id="displayManualKategori">-</div>
          </div>

          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Nama Indikator <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="NamaIndikator" id="inManualNamaIndikator" placeholder="Nama indikator..." required style="border-radius: 10px;">
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12px;">Gender / Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-control" name="Gender" id="inManualGender" style="border-radius: 10px; font-weight: 600;">
                  <option value="Total" selected>Total (Semua)</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                  <option value="L+P">L + P (Laki-laki & Perempuan)</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12px;">Satuan Indikator</label>
                <input type="text" class="form-control" name="Satuan" id="inManualSatuan" placeholder="Contoh: %, Jiwa, km², Ha, Tahun, Poin" style="border-radius: 10px;">
              </div>
            </div>
          </div>

          <!-- Bagian Input Nilai Manual Per Kolom Tahun -->
          <div class="card p-3 mb-3 bg-light border-0" style="border-radius: 12px; border: 1px solid #e2e8f0 !important;">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <label class="font-weight-bold text-dark mb-0" style="font-size: 12.5px;">
                <i class="fa-solid fa-input-numeric text-primary mr-1"></i> Nilai Indikator Per Kolom Tahun:
              </label>
              <small class="text-muted font-italic">Kosongkan jika belum ada data untuk tahun tertentu.</small>
            </div>

            <div class="row" id="containerInputsTahunManualDirect">
              <?php if (!empty($TahunList)): ?>
                <?php foreach ($TahunList as $thn): ?>
                  <div class="col-sm-6 col-md-4 mb-2">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text font-weight-bold bg-white" style="border-radius: 8px 0 0 8px; width: 65px; justify-content: center;"><?= htmlspecialchars($thn) ?></span>
                      </div>
                      <input type="text" class="form-control font-weight-bold text-center" name="NilaiTahun[<?= htmlspecialchars($thn) ?>]" placeholder="Nilai" style="border-radius: 0 8px 8px 0;">
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="col-12 text-muted text-center py-2" style="font-size: 12px;">
                  Belum ada kolom tahun terdaftar di daerah ini.
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="form-group mb-0">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Keterangan / Catatan Metodologi</label>
            <textarea class="form-control" name="Keterangan" id="inManualKeteranganIndikator" rows="2" placeholder="Catatan sumber data atau metodologi..." style="border-radius: 10px;"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer bg-light" style="border-top: 1px solid #e2e8f0;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: 600;">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSimpanIndikatorManual" style="border-radius: 10px; font-weight: 700; background: var(--ide-navy); border: none;">
          <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Indikator
        </button>
      </div>
    </div>
  </div>
</div>

<!-- 4B. Modal Input Indikator via API / JSON -->
<div class="modal fade" id="ModalInputIndikatorApi" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
      <div class="modal-header" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color: #ffffff;">
        <h5 class="modal-title font-weight-bold" style="font-size: 16px;">
          <i class="fa-solid fa-cloud-arrow-down mr-2"></i> Tambah Indikator via API / JSON
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4" style="max-height: 80vh; overflow-y: auto;">
        <form id="FormInputIndikatorApi" onsubmit="return false;">
          <input type="hidden" name="DaerahId" value="<?= $activeId ?>">
          <input type="hidden" name="Kategori" id="inApiKategoriIndikator">
          <input type="hidden" name="SubKategori" id="inApiSubKategoriIndikator">

          <!-- Info Lokasi Sub-Kategori Indikator di Atas Sendiri -->
          <div class="card p-3 mb-3 border-0" style="border-radius: 12px; background: #f8fafc; border: 1.5px solid #e2e8f0 !important;">
            <div style="font-size: 11px; text-transform: uppercase; font-weight: 800; color: #64748b; letter-spacing: 0.5px;">Lokasi Sub-Kategori Indikator:</div>
            <div class="font-weight-bold text-dark mt-1" style="font-size: 15px;" id="displayApiSubKategori">-</div>
            <div class="text-muted" style="font-size: 12px;" id="displayApiKategori">-</div>
          </div>

          <!-- Sumber API / JSON -->
          <div class="card p-3 mb-3 border-0" style="border-radius: 14px; background: #f0fdf4; border: 1.5px solid #86efac !important;">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <label class="font-weight-bold text-dark mb-0" style="font-size: 13px;">
                <i class="fa-solid fa-cloud-arrow-down text-success mr-1"></i> Sumber Data API / JSON:
              </label>
              <span class="badge badge-success px-2 py-1" style="font-size: 10.5px; border-radius: 6px;">Otomatisasi Data</span>
            </div>
            <p class="text-muted mb-2" style="font-size: 12px; line-height: 1.4;">
              Masukkan URL REST API endpoint JSON atau paste respon JSON. Sistem akan mengekstrak otomatis nama indikator, tahun, dan nilai.
            </p>
            <div class="input-group">
              <input type="text" class="form-control" name="ApiUrl" id="inApiUrlDirect" placeholder="https://api.domain.com/data/indikator.json atau paste kode JSON" style="border-radius: 10px 0 0 10px; font-size: 12.5px;">
              <div class="input-group-append">
                <button type="button" class="btn btn-success font-weight-bold px-3" id="btnTarikApiDirect" style="border-radius: 0 10px 10px 0; font-size: 12.5px; background: #16a34a; border-color: #16a34a;">
                  <i class="fa-solid fa-bolt mr-1"></i> Tarik Data
                </button>
              </div>
            </div>

            <!-- Box Pratinjau Deteksi API -->
            <div id="boxApiPreviewDirect" class="mt-3 p-3 bg-white rounded shadow-sm" style="display: none; border-radius: 10px !important; border: 1px solid #bbf7d0;">
              <div class="d-flex align-items-center justify-content-between mb-2 pb-2" style="border-bottom: 1px solid #f1f5f9;">
                <span class="font-weight-bold text-success" style="font-size: 12.5px;">
                  <i class="fa-solid fa-circle-check mr-1"></i> Data Berhasil Terbaca dari API / JSON!
                </span>
                <span class="badge badge-success px-2 py-1" id="badgeApiCountDirect" style="font-size: 11px;">0 Tahun Terdeteksi</span>
              </div>
              <div id="apiMultiSelectWrapper" class="mt-2" style="display: none;"></div>
              <div id="apiParsedYearsContainerDirect" class="d-flex flex-wrap" style="gap: 6px; max-height: 120px; overflow-y: auto;"></div>
              <div id="apiMetaInfoDirect" class="mt-2 text-muted" style="font-size: 11.5px;"></div>
            </div>
          </div>

          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Nama Indikator <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="NamaIndikator" id="inApiNamaIndikator" placeholder="Nama indikator..." required style="border-radius: 10px;">
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12px;">Gender / Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-control" name="Gender" id="inApiGender" style="border-radius: 10px; font-weight: 600;">
                  <option value="Total" selected>Total (Semua)</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                  <option value="L+P">L + P (Laki-laki & Perempuan)</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12px;">Satuan Indikator</label>
                <input type="text" class="form-control" name="Satuan" id="inApiSatuan" placeholder="Satuan" style="border-radius: 10px;">
              </div>
            </div>
          </div>

          <!-- Nilai Tahunan Otomatis dari API -->
          <div class="card p-3 mb-3 bg-light border-0" style="border-radius: 12px; border: 1px solid #e2e8f0 !important;">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <label class="font-weight-bold text-dark mb-0" style="font-size: 12.5px;">
                <i class="fa-solid fa-table-cells text-primary mr-1"></i> Nilai Hasil Tarik API Per Kolom Tahun:
              </label>
              <small class="text-muted font-italic">Nilai dapat disesuaikan sebelum disimpan.</small>
            </div>

            <div class="row" id="containerInputsTahunApi">
              <?php if (!empty($TahunList)): ?>
                <?php foreach ($TahunList as $thn): ?>
                  <div class="col-sm-6 col-md-4 mb-2 item-input-tahun-api" data-tahun="<?= htmlspecialchars($thn) ?>">
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text font-weight-bold bg-white" style="border-radius: 8px 0 0 8px; width: 65px; justify-content: center;"><?= htmlspecialchars($thn) ?></span>
                      </div>
                      <input type="text" class="form-control font-weight-bold text-center input-val-tahun-api" data-tahun="<?= htmlspecialchars($thn) ?>" name="NilaiTahun[<?= htmlspecialchars($thn) ?>]" placeholder="Nilai" style="border-radius: 0 8px 8px 0;">
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="col-12 text-muted text-center py-2" id="placeholderEmptyTahunApi" style="font-size: 12px;">
                  Klik "Tarik Data" di atas untuk memuat kolom tahun dan nilai secara otomatis dari API.
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="form-group mb-0">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Keterangan / Catatan Metodologi</label>
            <textarea class="form-control" name="Keterangan" id="inApiKeteranganIndikator" rows="2" placeholder="Catatan tambahan..." style="border-radius: 10px;"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer bg-light" style="border-top: 1px solid #e2e8f0;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: 600;">Batal</button>
        <button type="button" class="btn btn-info text-white" id="btnSimpanIndikatorApi" style="border-radius: 10px; font-weight: 700; background: #0284c7; border: none;">
          <i class="fa-solid fa-cloud-arrow-down mr-1"></i> Simpan Indikator via API
        </button>
      </div>
    </div>
  </div>
</div>

<!-- 5. Modal Edit Indikator & Nilai Tahunan -->
<div class="modal fade" id="ModalEditIndikator" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
      <div class="modal-header" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff;">
        <h5 class="modal-title font-weight-bold" style="font-size: 16px;">
          <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Data Indikator
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4" style="max-height: 80vh; overflow-y: auto;">
        <form id="FormEditIndikator" onsubmit="return false;">
          <input type="hidden" name="Id" id="editIndikatorId">
          <input type="hidden" name="Kategori" id="editKategoriIndikator">
          <input type="hidden" name="SubKategori" id="editSubKategoriIndikator">

          <!-- Info Lokasi Sub-Kategori Indikator di Atas Sendiri -->
          <div class="card p-3 mb-3 border-0" style="border-radius: 12px; background: #f8fafc; border: 1.5px solid #e2e8f0 !important;">
            <div style="font-size: 11px; text-transform: uppercase; font-weight: 800; color: #64748b; letter-spacing: 0.5px;">Lokasi Sub-Kategori Indikator:</div>
            <div class="font-weight-bold text-dark mt-1" style="font-size: 15px;" id="displayEditSubKategori">-</div>
            <div class="text-muted" style="font-size: 12px;" id="displayEditKategori">-</div>
          </div>

          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Nama Indikator <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="NamaIndikator" id="editNamaIndikator" required style="border-radius: 10px;">
          </div>

          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">URL API / Endpoint JSON (Opsional)</label>
            <input type="text" class="form-control" name="ApiUrl" id="editApiUrl" placeholder="https://..." style="border-radius: 10px; font-size: 12.5px;">
            <small class="text-muted" style="font-size: 11px;">Jika diisi, indikator ini dapat disinkronkan sewaktu-waktu langsung dari API sumber.</small>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Gender / Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-control" name="Gender" id="editGender" style="border-radius: 10px; font-weight: 600;">
                  <option value="Total">Total (Semua)</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                  <option value="L+P">L + P (Laki-laki & Perempuan)</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Satuan Indikator</label>
                <input type="text" class="form-control" name="Satuan" id="editSatuan" style="border-radius: 10px;">
              </div>
            </div>
          </div>

          <!-- Nilai Tahunan Dinamis untuk Edit -->
          <div class="card p-3 mb-3 bg-light border-0" style="border-radius: 12px;">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <label class="font-weight-bold text-dark mb-0" style="font-size: 13px;">
                <i class="fa-solid fa-input-numeric text-primary mr-1"></i> Nilai Indikator Per Tahun:
              </label>
              <small class="text-muted font-italic">Format angka desimal atau teks.</small>
            </div>

            <div class="row" id="containerEditNilaiTahun">
              <?php foreach ($TahunList as $thn): ?>
                <div class="col-sm-6 col-md-4 mb-2">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text font-weight-bold bg-white" style="border-radius: 8px 0 0 8px; width: 65px; justify-content: center;"><?= htmlspecialchars($thn) ?></span>
                    </div>
                    <input type="text" class="form-control font-weight-bold text-center input-edit-tahun" data-tahun="<?= htmlspecialchars($thn) ?>" name="NilaiTahun[<?= htmlspecialchars($thn) ?>]" placeholder="Nilai" style="border-radius: 0 8px 8px 0;">
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="form-group mb-0">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Keterangan / Catatan</label>
            <textarea class="form-control" name="Keterangan" id="editKeteranganIndikator" rows="2" style="border-radius: 10px;"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer bg-light" style="border-top: 1px solid #e2e8f0;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: 600;">Batal</button>
        <button type="button" class="btn btn-primary" id="btnUpdateIndikator" style="border-radius: 10px; font-weight: 700; background: var(--ide-navy); border: none;">
          <i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Indikator
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Scripts Eksternal Pendukung Bootstrap & DataTables & Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
<script src="<?=base_url("assets/datatables/jquery.dataTables.js")?>"></script>
<script src="<?=base_url("assets/datatables-bs4/js/dataTables.bootstrap4.js")?>"></script>
<script src="<?=base_url("build/js/custom.min.js")?>"></script>

<script>
  $(document).ready(function() {
    var BaseURL = '<?= base_url() ?>';

    // Inisialisasi DataTable untuk Tabel Indikator Sub Kategori
    if ($('#TabelIndikatorSub').length && $.fn.DataTable) {
      $('#TabelIndikatorSub').DataTable({
        "language": {
          "lengthMenu": "Tampilkan _MENU_ data",
          "zeroRecords": "Tidak ada data indikator ditemukan",
          "info": "Menampilkan _START_ s/d _END_ dari _TOTAL_ indikator",
          "infoEmpty": "Menampilkan 0 indikator",
          "infoFiltered": "(difilter dari _MAX_ total)",
          "search": "Cari Indikator:",
          "paginate": {
            "first": "Awal",
            "last": "Akhir",
            "next": "Lanjut",
            "previous": "Sebelum"
          }
        },
        "pageLength": 25,
        "order": [[0, "asc"]]
      });
    }

    // =========================================================================
    // HANDLERS TRIGGER PEMBUKA & PENUTUP MODAL
    // =========================================================================
    $(document).on('click', '[data-target="#ModalInputDaerah"], .btnBukaModalTambahDaerah', function(e) {
      e.preventDefault();
      $('#ModalInputDaerah').modal('show');
    });

    $(document).on('click', '[data-target="#ModalTambahTahun"]', function(e) {
      e.preventDefault();
      $('#ModalTambahTahun').modal('show');
    });

    $(document).on('click', '.btnBukaModalTambahIndikatorManual', function(e) {
      e.preventDefault();
      var defaultKat = $(this).data('default-kategori') || '';
      var defaultSub = $(this).data('default-sub') || '';
      $('#inManualKategoriIndikator').val(defaultKat);
      $('#inManualSubKategoriIndikator').val(defaultSub);
      $('#displayManualKategori').text(defaultKat || '-');
      $('#displayManualSubKategori').text(defaultSub || '-');
      $('#ModalInputIndikatorManual').modal('show');
    });

    $(document).on('click', '.btnBukaModalTambahIndikatorApi', function(e) {
      e.preventDefault();
      var defaultKat = $(this).data('default-kategori') || '';
      var defaultSub = $(this).data('default-sub') || '';
      $('#inApiKategoriIndikator').val(defaultKat);
      $('#inApiSubKategoriIndikator').val(defaultSub);
      $('#displayApiKategori').text(defaultKat || '-');
      $('#displayApiSubKategori').text(defaultSub || '-');
      $('#ModalInputIndikatorApi').modal('show');
    });

    $(document).on('click', '[data-dismiss="modal"]', function(e) {
      e.preventDefault();
      $(this).closest('.modal').modal('hide');
    });

    // Enter key shortcuts
    $('#inNamaDaerah').on('keypress', function(e) {
      if (e.which === 13) { $('#btnSimpanDaerah').click(); }
    });
    $('#editNamaDaerah').on('keypress', function(e) {
      if (e.which === 13) { $('#btnUpdateDaerah').click(); }
    });
    $('#inTahunBaru').on('keypress', function(e) {
      if (e.which === 13) { $('#btnSimpanTahun').click(); }
    });

    // =========================================================================
    // 1. TAMBAH DAERAH BARU
    // =========================================================================
    $('#btnSimpanDaerah').on('click', function() {
      var nama = $('#inNamaDaerah').val().trim();
      if (!nama) {
        alert('Nama Daerah wajib diisi!');
        $('#inNamaDaerah').focus();
        return;
      }

      var btn = $(this);
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan...');

      $.ajax({
        url: BaseURL + 'Staf/InputDaerah',
        type: 'POST',
        data: $('#FormInputDaerah').serialize(),
        dataType: 'json',
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Daerah');
          if (resp.status === 'success') {
            $('#ModalInputDaerah').modal('hide');
            window.location.href = BaseURL + 'Staf/OlahData?daerah_id=' + resp.id;
          } else {
            alert(resp.message || 'Gagal menambahkan daerah!');
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Daerah');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // =========================================================================
    // 2. EDIT DAERAH
    // =========================================================================
    $(document).on('click', '.btnEditDaerah', function(e) {
      e.preventDefault();
      $('#editDaerahId').val($(this).data('id'));
      $('#editNamaDaerah').val($(this).data('nama'));
      $('#editKetDaerah').val($(this).data('ket'));
      $('#ModalEditDaerah').modal('show');
    });

    $('#btnUpdateDaerah').on('click', function() {
      var nama = $('#editNamaDaerah').val().trim();
      if (!nama) {
        alert('Nama Daerah wajib diisi!');
        $('#editNamaDaerah').focus();
        return;
      }

      var btn = $(this);
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan...');

      $.ajax({
        url: BaseURL + 'Staf/EditDaerah',
        type: 'POST',
        data: $('#FormEditDaerah').serialize(),
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Daerah');
          if (resp === '1') {
            $('#ModalEditDaerah').modal('hide');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Daerah');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // =========================================================================
    // 3. HAPUS DAERAH
    // =========================================================================
    $(document).on('click', '.btnHapusDaerah', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      if (confirm('Yakin ingin menghapus daerah "' + nama + '" beserta SELURUH data indikator di dalamnya?')) {
        $.post(BaseURL + 'Staf/HapusDaerah', { Id: id }, function(resp) {
          if (resp === '1') {
            window.location.href = BaseURL + 'Staf/OlahData';
          } else {
            alert(resp);
          }
        });
      }
    });

    // =========================================================================
    // 4. INISIALISASI / MUAT INDIKATOR STANDAR TEMPLATE
    // =========================================================================
    $('#btnInisialisasiStandar').on('click', function() {
      var daerahId = $(this).data('daerah-id');
      if (!daerahId) return;

      var btn = $(this);
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memuat Indikator...');

      $.ajax({
        url: BaseURL + 'Staf/InisialisasiIndikatorStandar',
        type: 'POST',
        data: { DaerahId: daerahId },
        dataType: 'json',
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-list-check mr-1"></i> Muat Indikator Standar');
          if (resp.status === 'success') {
            alert(resp.message);
            location.reload();
          } else {
            alert(resp.message || 'Gagal memuat indikator standar.');
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-list-check mr-1"></i> Muat Indikator Standar');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // =========================================================================
    // 5. TAMBAH & HAPUS KOLOM TAHUN
    // =========================================================================
    $('#btnSimpanTahun').on('click', function() {
      var thn = $('#inTahunBaru').val().trim();
      if (!thn || thn.length !== 4) {
        alert('Masukkan 4 digit tahun (contoh: 2025)!');
        $('#inTahunBaru').focus();
        return;
      }

      var btn = $(this);
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menambahkan...');

      $.ajax({
        url: BaseURL + 'Staf/TambahTahun',
        type: 'POST',
        data: $('#FormTambahTahun').serialize(),
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-plus mr-1"></i> Tambahkan');
          if (resp === '1') {
            $('#ModalTambahTahun').modal('hide');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-plus mr-1"></i> Tambahkan');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    $(document).on('click', '.btn-del-tahun', function(e) {
      e.preventDefault();
      e.stopPropagation();
      var daerahId = $(this).data('daerah-id');
      var tahun = $(this).data('tahun');

      if (confirm('Hapus kolom tahun ' + tahun + ' dari tampilan daerah ini?')) {
        $.post(BaseURL + 'Staf/HapusTahun', { DaerahId: daerahId, Tahun: tahun }, function(resp) {
          if (resp === '1') {
            location.reload();
          } else {
            alert(resp);
          }
        });
      }
    });

    // =========================================================================
    // 6. INLINE QUICK EDIT NILAI CELL DI TABEL
    // =========================================================================
    $(document).on('click', '.val-cell-editable', function() {
      var cell = $(this);
      if (cell.find('input.inline-edit-input').length) return; // sedang diedit

      var indId = cell.data('indikator-id');
      var tahun = cell.data('tahun');
      var currentVal = cell.data('val') || '';

      var input = $('<input type="text" class="inline-edit-input" value="' + currentVal + '" />');
      cell.html(input);
      input.focus().select();

      function saveInlineVal() {
        var newVal = input.val().trim();
        if (newVal === currentVal) {
          // Tidak berubah
          if (newVal !== '') {
            cell.html('<span class="val-text">' + newVal + '</span>');
          } else {
            cell.html('<span class="val-empty">-</span>');
          }
          return;
        }

        cell.html('<i class="fa-solid fa-spinner fa-spin text-primary"></i>');

        $.ajax({
          url: BaseURL + 'Staf/UpdateNilaiCell',
          type: 'POST',
          data: {
            IndikatorId: indId,
            Tahun: tahun,
            Nilai: newVal
          },
          success: function(resp) {
            cell.data('val', newVal);
            if (newVal !== '') {
              cell.html('<span class="val-text">' + newVal + '</span>');
            } else {
              cell.html('<span class="val-empty">-</span>');
            }
            cell.addClass('cell-saved-flash');
            setTimeout(function() { cell.removeClass('cell-saved-flash'); }, 1200);
          },
          error: function() {
            alert('Gagal menyimpan nilai sel.');
            if (currentVal !== '') {
              cell.html('<span class="val-text">' + currentVal + '</span>');
            } else {
              cell.html('<span class="val-empty">-</span>');
            }
          }
        });
      }

      input.on('blur', function() {
        saveInlineVal();
      });

      input.on('keydown', function(e) {
        if (e.which === 13) { // Enter
          e.preventDefault();
          $(this).blur();
        } else if (e.which === 27) { // Esc
          e.preventDefault();
          if (currentVal !== '') {
            cell.html('<span class="val-text">' + currentVal + '</span>');
          } else {
            cell.html('<span class="val-empty">-</span>');
          }
        }
      });
    });

    // Quick Save Row Indikator jika belum ada ID di database
    $(document).on('click', '.btnQuickSaveRow', function(e) {
      e.preventDefault();
      var btn = $(this);
      var daerahId = btn.data('daerah-id');
      var nama = btn.data('nama');
      var kat = btn.data('kategori');
      var sub = btn.data('subkategori');
      var satuan = btn.data('satuan');

      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');

      $.ajax({
        url: BaseURL + 'Staf/InputIndikator',
        type: 'POST',
        data: {
          DaerahId: daerahId,
          NamaIndikator: nama,
          Kategori: kat,
          SubKategori: sub,
          Satuan: satuan,
          Gender: 'Total'
        },
        success: function(resp) {
          if (resp === '1') {
            location.reload();
          } else {
            alert(resp);
            btn.prop('disabled', false).html('<i class="fa-solid fa-plus"></i>');
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-plus"></i>');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // =========================================================================
    // 7. SIMPAN INDIKATOR MANUAL & API
    // =========================================================================
    $('#btnSimpanIndikatorManual').on('click', function() {
      var nama = $('#inManualNamaIndikator').val().trim();
      if (!nama) {
        alert('Nama Indikator wajib diisi!');
        $('#inManualNamaIndikator').focus();
        return;
      }

      var btn = $(this);
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan...');

      $.ajax({
        url: BaseURL + 'Staf/InputIndikator',
        type: 'POST',
        data: $('#FormInputIndikatorManual').serialize(),
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Indikator');
          if (resp === '1') {
            $('#ModalInputIndikatorManual').modal('hide');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Indikator');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    $('#btnSimpanIndikatorApi').on('click', function() {
      var nama = $('#inApiNamaIndikator').val().trim();
      if (!nama) {
        alert('Nama Indikator wajib diisi!');
        $('#inApiNamaIndikator').focus();
        return;
      }

      var btn = $(this);
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan...');

      $.ajax({
        url: BaseURL + 'Staf/InputIndikator',
        type: 'POST',
        data: $('#FormInputIndikatorApi').serialize(),
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-down mr-1"></i> Simpan Indikator via API');
          if (resp === '1') {
            $('#ModalInputIndikatorApi').modal('hide');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-cloud-arrow-down mr-1"></i> Simpan Indikator via API');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // =========================================================================
    // 8. TARIK API PREVIEW
    // =========================================================================
    var _apiIndicatorsList = [];

    $('#btnTarikApiDirect').on('click', function() {
      var source = $('#inApiUrlDirect').val().trim();
      if (!source) {
        alert('Silakan masukkan link URL API atau paste kode JSON terlebih dahulu!');
        $('#inApiUrlDirect').focus();
        return;
      }

      var btn = $(this);
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menarik Data...');

      $.ajax({
        url: BaseURL + 'Staf/PreviewApiIndikator',
        type: 'POST',
        data: { ApiSource: source },
        dataType: 'json',
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-bolt mr-1"></i> Tarik Data');
          if (resp.status === 'success' && resp.indicators && resp.indicators.length > 0) {
            $('#boxApiPreviewDirect').slideDown();
            _apiIndicatorsList = resp.indicators;

            var indData = resp.indicators[0];
            $('#inApiNamaIndikator').val(indData.NamaIndikator || '');
            if (indData.Kategori) $('#inApiKategoriIndikator').val(indData.Kategori);
            if (indData.Gender) $('#inApiGender').val(indData.Gender);
            if (indData.Satuan) $('#inApiSatuan').val(indData.Satuan);

            var countYears = 0;
            var chipsHtml = '';
            $('#containerInputsTahunApi').empty();

            $.each(indData.DataTahun || {}, function(thn, val) {
              countYears++;
              chipsHtml += '<span class="badge badge-light border p-2" style="font-size: 11.5px; border-radius: 8px;">' +
                           '<b class="text-primary">' + thn + ':</b> ' + val + '</span>';

              var inputItem = 
                '<div class="col-sm-6 col-md-4 mb-2 item-input-tahun-api" data-tahun="' + thn + '">' +
                  '<div class="input-group input-group-sm">' +
                    '<div class="input-group-prepend">' +
                      '<span class="input-group-text font-weight-bold bg-white" style="border-radius: 8px 0 0 8px; width: 65px; justify-content: center;">' + thn + '</span>' +
                    '</div>' +
                    '<input type="text" class="form-control font-weight-bold text-center input-val-tahun-api" name="NilaiTahun[' + thn + ']" value="' + val + '" placeholder="Nilai" style="border-radius: 0 8px 8px 0;">' +
                  '</div>' +
                '</div>';
              $('#containerInputsTahunApi').append(inputItem);
            });

            $('#apiParsedYearsContainerDirect').html(chipsHtml);
            $('#badgeApiCountDirect').text(countYears + ' Tahun Terdeteksi');

          } else {
            $('#boxApiPreviewDirect').hide();
            alert(resp.message || 'Gagal membaca data dari API JSON!');
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-bolt mr-1"></i> Tarik Data');
          alert('Terjadi kesalahan koneksi ke server saat menarik API!');
        }
      });
    });

    // =========================================================================
    // 9. EDIT INDIKATOR
    // =========================================================================
    $(document).on('click', '.btnEditIndikator', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var api = $(this).data('api') || '';
      var kategori = $(this).data('kategori');
      var subkategori = $(this).data('subkategori') || '';
      var gender = $(this).data('gender');
      var satuan = $(this).data('satuan');
      var ket = $(this).data('ket');
      var dataThn = $(this).data('tahun') || {};

      $('#editIndikatorId').val(id);
      $('#editNamaIndikator').val(nama);
      $('#editApiUrl').val(api);
      $('#editKategoriIndikator').val(kategori);
      $('#editSubKategoriIndikator').val(subkategori);
      $('#displayEditKategori').text(kategori || '-');
      $('#displayEditSubKategori').text(subkategori || '-');
      $('#editGender').val(gender);
      $('#editSatuan').val(satuan);
      $('#editKeteranganIndikator').val(ket);

      $('.input-edit-tahun').each(function() {
        var thn = $(this).data('tahun');
        var val = (dataThn && dataThn[thn] !== undefined) ? dataThn[thn] : '';
        $(this).val(val);
      });

      $('#ModalEditIndikator').modal('show');
    });

    $('#btnUpdateIndikator').on('click', function() {
      var nama = $('#editNamaIndikator').val().trim();
      if (!nama) {
        alert('Nama Indikator wajib diisi!');
        $('#editNamaIndikator').focus();
        return;
      }

      var btn = $(this);
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memperbarui...');

      $.ajax({
        url: BaseURL + 'Staf/EditIndikator',
        type: 'POST',
        data: $('#FormEditIndikator').serialize(),
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Indikator');
          if (resp === '1') {
            $('#ModalEditIndikator').modal('hide');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Indikator');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // =========================================================================
    // 10. HAPUS INDIKATOR & SINKRONKAN
    // =========================================================================
    $(document).on('click', '.btnHapusIndikator', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      if (confirm('Yakin ingin menghapus indikator: "' + nama + '"?')) {
        $.post(BaseURL + 'Staf/HapusIndikator', { Id: id }, function(resp) {
          if (resp === '1') {
            location.reload();
          } else {
            alert(resp);
          }
        });
      }
    });

    $(document).on('click', '.btnSyncIndikator', function(e) {
      e.preventDefault();
      var btn = $(this);
      var id = btn.data('id');
      var originalHtml = btn.html();
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');

      $.ajax({
        url: BaseURL + 'Staf/SinkronkanIndikator',
        type: 'POST',
        data: { Id: id },
        dataType: 'json',
        success: function(resp) {
          btn.prop('disabled', false).html(originalHtml);
          if (resp.status === 'success') {
            alert(resp.message || 'Data indikator berhasil disinkronkan dengan API!');
            location.reload();
          } else {
            alert(resp.message || 'Gagal menyinkronkan data!');
          }
        },
        error: function() {
          btn.prop('disabled', false).html(originalHtml);
          alert('Terjadi kesalahan server saat menyinkronkan data!');
        }
      });
    });

    // =========================================================================
    // 11. FITUR KOMPARASI DAERAH (HALAMAN PENUH / TAB LUAR)
    // =========================================================================
    var _komparasiData = null;

    function switchToKomparasiTab() {
      sessionStorage.setItem('cvide_active_view_tab', 'komparasi');
      try {
        if (window.history && window.history.replaceState) {
          window.history.replaceState(null, null, '#komparasi');
        }
      } catch(e) {}

      $('#btnTabKatalogView').removeClass('active');
      $('#btnTabKomparasiView').addClass('active');
      $('#sectionKatalogDaerah').hide();
      $('#sectionKomparasiDaerah').fadeIn(200);

      // Pulihkan slot daerah dari sessionStorage jika ada
      var s1 = sessionStorage.getItem('komparasi_slot1');
      var s2 = sessionStorage.getItem('komparasi_slot2');
      var s3 = sessionStorage.getItem('komparasi_slot3');
      if (s1 && $('#slotDaerah1 option[value="' + s1 + '"]').length) {
        $('#slotDaerah1').val(s1);
        if (s2 && $('#slotDaerah2 option[value="' + s2 + '"]').length) $('#slotDaerah2').val(s2);
        if (s3 && $('#slotDaerah3 option[value="' + s3 + '"]').length) $('#slotDaerah3').val(s3);
      } else if (!$('#slotDaerah1').val()) {
        var opts = [];
        $('#slotDaerah1 option').each(function() {
          if ($(this).val()) opts.push($(this).val());
        });
        if (opts.length > 0) $('#slotDaerah1').val(opts[0]);
        if (opts.length > 1) $('#slotDaerah2').val(opts[1]);
      }

      if (!_komparasiData) {
        loadKomparasiData();
      } else {
        if (_chartInstance) _chartInstance.resize();
        if (_chartInstanceSub) _chartInstanceSub.resize();
      }
    }

    function switchToKatalogTab() {
      sessionStorage.setItem('cvide_active_view_tab', 'katalog');
      try {
        if (window.history && window.history.replaceState) {
          var cleanUrl = window.location.pathname + window.location.search;
          window.history.replaceState(null, null, cleanUrl);
        }
      } catch(e) {}

      $('#btnTabKomparasiView').removeClass('active');
      $('#btnTabKatalogView').addClass('active');
      $('#sectionKomparasiDaerah').hide();
      $('#sectionKatalogDaerah').fadeIn(200);
    }

    $(document).on('click', '#btnTabKatalogView, #btnKembaliKeKatalog', function(e) {
      e.preventDefault();
      switchToKatalogTab();
    });

    $(document).on('click', '#btnTabKomparasiView, #btnBukaBandingkanTop', function(e) {
      e.preventDefault();
      switchToKomparasiTab();
    });

    // Simpan slot daerah setiap kali pilihan diganti
    $(document).on('change', '.select-slot-daerah', function() {
      sessionStorage.setItem('komparasi_slot1', $('#slotDaerah1').val() || '');
      sessionStorage.setItem('komparasi_slot2', $('#slotDaerah2').val() || '');
      sessionStorage.setItem('komparasi_slot3', $('#slotDaerah3').val() || '');
    });

    // Tombol Bandingkan pada kartu daerah -> Beralih ke tab komparasi untuk daerah ini
    $(document).on('click', '.btn-toggle-compare-card', function(e) {
      e.preventDefault();
      var did = parseInt($(this).data('id'), 10);

      $('#slotDaerah1').val(did);

      // Cari daerah kedua yang berbeda dari slot 1 untuk otomatis dipasangkan
      var secondVal = '';
      $('#slotDaerah2 option').each(function() {
        var val = $(this).val();
        if (val && parseInt(val, 10) !== did) {
          secondVal = val;
          return false; // break loop
        }
      });
      $('#slotDaerah2').val(secondVal);
      $('#slotDaerah3').val('');

      sessionStorage.setItem('komparasi_slot1', did);
      sessionStorage.setItem('komparasi_slot2', secondVal);
      sessionStorage.setItem('komparasi_slot3', '');

      switchToKomparasiTab();
      loadKomparasiData();
      if ($('#sectionKomparasiDaerah').length) {
        $('html, body').animate({ scrollTop: $('#sectionKomparasiDaerah').offset().top - 70 }, 300);
      }
    });

    // Deteksi URL parameter, hash, atau sessionStorage untuk membuka tab komparasi langsung
    var _urlParams = new URLSearchParams(window.location.search);
    var _savedTab = sessionStorage.getItem('cvide_active_view_tab');
    if (_urlParams.get('tab') === 'komparasi' || window.location.hash === '#komparasi' || _savedTab === 'komparasi') {
      switchToKomparasiTab();
    }

    // Tombol Terapkan Daerah
    $('#btnRefreshKomparasi').on('click', function() {
      var s1 = $('#slotDaerah1').val();
      var s2 = $('#slotDaerah2').val();
      var s3 = $('#slotDaerah3').val();

      var newIds = [];
      [s1, s2, s3].forEach(function(id) {
        var intId = parseInt(id, 10);
        if (intId && newIds.indexOf(intId) === -1) {
          newIds.push(intId);
        }
      });

      if (newIds.length === 0) {
        alert('Silakan pilih minimal 1 daerah di slot komparasi!');
        return;
      }

      loadKomparasiData();
    });

    function loadKomparasiData() {
      var s1 = $('#slotDaerah1').val();
      var s2 = $('#slotDaerah2').val();
      var s3 = $('#slotDaerah3').val();

      var ids = [];
      [s1, s2, s3].forEach(function(id) {
        var intId = parseInt(id, 10);
        if (intId && ids.indexOf(intId) === -1) {
          ids.push(intId);
        }
      });

      if (ids.length === 0) {
        $('#theadKomparasi').empty();
        $('#tbodyKomparasi').html('<tr><td colspan="10" class="text-center py-4 text-muted">Belum ada daerah yang dipilih.</td></tr>');
        return;
      }

      $('#loadingKomparasi').show();
      $('#containerKomparasiResult').hide();

      $.ajax({
        url: BaseURL + 'Staf/GetKomparasiData',
        type: 'POST',
        data: { daerah_ids: ids },
        dataType: 'json',
        success: function(resp) {
          $('#loadingKomparasi').hide();
          $('#containerKomparasiResult').show();

          if (resp.status !== 'success') {
            alert(resp.message || 'Gagal memuat komparasi daerah!');
            return;
          }

          _komparasiData = resp;

          var names = [];
          resp.regions.forEach(function(r) { names.push(r.NamaDaerah); });
          $('#lblKomparasiInfoRingkas').html('<i class="fa-solid fa-code-compare text-primary mr-1"></i> ' + names.join(' <span class="text-muted font-weight-normal">vs</span> '));

          var thnHtml = '<option value="ALL">Semua Kolom Tahun</option>';
          if (resp.all_years && resp.all_years.length > 0) {
            resp.all_years.forEach(function(y) {
              thnHtml += '<option value="' + y + '">Tahun ' + y + '</option>';
            });
          }

          var prevChartThn = $('#filterKomparasiTahun').val();
          var prevTabelThn = $('#filterTabelTahunKomparasi').val();

          $('#filterKomparasiTahun').html(thnHtml);
          $('#filterTabelTahunKomparasi').html(thnHtml);

          // Tahun untuk Diagram (Tampilan Kolom Tahun di atas): default "Semua Kolom Tahun"
          if (prevChartThn && (prevChartThn === 'ALL' || resp.all_years.indexOf(prevChartThn) !== -1)) {
            $('#filterKomparasiTahun').val(prevChartThn);
          } else {
            $('#filterKomparasiTahun').val('ALL');
          }

          // Tahun untuk Matriks Perbandingan Indikator Lengkap: default "Semua Kolom Tahun"
          if (prevTabelThn && (prevTabelThn === 'ALL' || resp.all_years.indexOf(prevTabelThn) !== -1)) {
            $('#filterTabelTahunKomparasi').val(prevTabelThn);
          } else {
            $('#filterTabelTahunKomparasi').val('ALL');
          }

          updateSubKategoriFilter();
          updateChartIndikatorOptions();
          renderKomparasiTable();
          renderKomparasiCharts();
        },
        error: function() {
          $('#loadingKomparasi').hide();
          $('#containerKomparasiResult').show();
          alert('Terjadi kesalahan koneksi server saat memuat data komparasi!');
        }
      });
    }

    function updateSubKategoriFilter() {
      var katVal = $('#filterKomparasiKategori').val();
      var subSelect = $('#filterKomparasiSub');
      var prevSub = subSelect.val();
      subSelect.empty().append('<option value="ALL">Semua Sub-Kategori</option>');

      if (!_komparasiData || !_komparasiData.master_kategori) return;

      var subList = [];
      $.each(_komparasiData.master_kategori, function(kKey, kat) {
        if (katVal === 'ALL' || kat.nama === katVal) {
          $.each(kat.sub || {}, function(sKey, sub) {
            if (subList.indexOf(sub.nama) === -1) {
              subList.push(sub.nama);
            }
          });
        }
      });

      subList.forEach(function(s) {
        subSelect.append('<option value="' + s + '">' + s + '</option>');
      });

      if (prevSub && subList.indexOf(prevSub) !== -1) {
        subSelect.val(prevSub);
      }
    }

    // Filter events
    $('#filterKomparasiKategori').on('change', function() {
      updateSubKategoriFilter();
      updateChartIndikatorOptions();
      renderKomparasiTable();
      renderKomparasiCharts();
    });
    $('#filterKomparasiSub').on('change', function() {
      updateChartIndikatorOptions();
      renderKomparasiTable();
      renderKomparasiCharts();
    });

    // Filter Tahun untuk Diagram (Tampilan Kolom Tahun di atas) -> HANYA memperbarui diagram
    $('#filterKomparasiTahun').on('change', function() {
      renderKomparasiCharts();
    });

    // Filter Tahun untuk Matriks Perbandingan Indikator Lengkap (dropdown di kanan tabel) -> HANYA memperbarui tabel
    $(document).on('change', '#filterTabelTahunKomparasi', function() {
      renderKomparasiTable();
    });

    $('#searchKomparasiIndikator').on('input', function() {
      renderKomparasiTable();
    });

    function renderKomparasiTable() {
      if (!_komparasiData || !_komparasiData.rows || !_komparasiData.regions) return;

      var regions = _komparasiData.regions;
      var allYears = _komparasiData.all_years || [];
      var rows = _komparasiData.rows;
      var selectedKat = $('#filterKomparasiKategori').val();
      var selectedSub = $('#filterKomparasiSub').val();
      var selectedThn = $('#filterTabelTahunKomparasi').val() || 'ALL';
      var searchWord = $('#searchKomparasiIndikator').val().trim().toLowerCase();

      var filteredRows = rows.filter(function(r) {
        if (selectedKat !== 'ALL' && r.Kategori !== selectedKat) return false;
        if (selectedSub !== 'ALL' && r.SubKategori !== selectedSub) return false;
        if (searchWord && r.NamaIndikator.toLowerCase().indexOf(searchWord) === -1) return false;
        return true;
      });

      $('#badgeTotalRowsKomparasi').text(filteredRows.length + ' Indikator');
      if (selectedThn !== 'ALL') {
        $('#badgeTahunKomparasiAktif').text('Tahun ' + selectedThn).show();
      } else {
        $('#badgeTahunKomparasiAktif').text('Semua Tahun').show();
      }

      var isSingleYear = (selectedThn !== 'ALL');
      var theadHtml = '';

      if (isSingleYear) {
        theadHtml += '<tr style="background: #0f172a; color: #ffffff;">';
        theadHtml += '<th style="width: 40px;">No</th>';
        theadHtml += '<th style="width: 200px;">Kategori & Sub-Kategori</th>';
        theadHtml += '<th style="min-width: 220px;">Nama Indikator</th>';
        theadHtml += '<th style="width: 80px;">Satuan</th>';

        regions.forEach(function(r, idx) {
          var cls = (idx === 0) ? 'th-region-1' : ((idx === 1) ? 'th-region-2' : 'th-region-3');
          theadHtml += '<th class="' + cls + '" style="min-width: 140px;">' + r.NamaDaerah + ' (' + selectedThn + ')</th>';
        });

        if (regions.length === 2) {
          theadHtml += '<th style="background: #334155; color: #ffffff; width: 130px;">Selisih (' + regions[0].NamaDaerah.replace('Kabupaten ', 'Kab. ').replace('Kota ', 'Kota ') + ' - ' + regions[1].NamaDaerah.replace('Kabupaten ', 'Kab. ').replace('Kota ', 'Kota ') + ')</th>';
        }
        theadHtml += '</tr>';
      } else {
        theadHtml += '<tr>';
        theadHtml += '<th rowspan="2" style="width: 40px; background: #0f172a; color: #ffffff;">No</th>';
        theadHtml += '<th rowspan="2" style="width: 180px; background: #0f172a; color: #ffffff;">Kategori</th>';
        theadHtml += '<th rowspan="2" style="width: 180px; background: #0f172a; color: #ffffff;">Sub-Kategori</th>';
        theadHtml += '<th rowspan="2" style="min-width: 220px; background: #0f172a; color: #ffffff;">Nama Indikator</th>';
        theadHtml += '<th rowspan="2" style="width: 80px; background: #0f172a; color: #ffffff;">Satuan</th>';

        regions.forEach(function(r, idx) {
          var colSpan = allYears.length || 1;
          var cls = (idx === 0) ? 'th-region-1' : ((idx === 1) ? 'th-region-2' : 'th-region-3');
          theadHtml += '<th colspan="' + colSpan + '" class="' + cls + '">' + r.NamaDaerah + '</th>';
        });
        theadHtml += '</tr>';

        theadHtml += '<tr>';
        regions.forEach(function(r, idx) {
          var cls = (idx === 0) ? 'th-year-1' : ((idx === 1) ? 'th-year-2' : 'th-year-3');
          if (allYears.length > 0) {
            allYears.forEach(function(y) {
              theadHtml += '<th class="' + cls + '" style="min-width: 75px;">' + y + '</th>';
            });
          } else {
            theadHtml += '<th class="' + cls + '">-</th>';
          }
        });
        theadHtml += '</tr>';
      }

      $('#theadKomparasi').html(theadHtml);

      if (filteredRows.length === 0) {
        var colCount = isSingleYear ? (4 + regions.length + (regions.length === 2 ? 1 : 0)) : (5 + (regions.length * (allYears.length || 1)));
        $('#tbodyKomparasi').html('<tr><td colspan="' + colCount + '" class="text-center py-5 text-muted"><i class="fa-solid fa-filter mr-1"></i> Tidak ada indikator yang sesuai dengan filter pencarian.</td></tr>');
        return;
      }

      var tbodyHtml = '';
      filteredRows.forEach(function(row, rIdx) {
        tbodyHtml += '<tr>';
        tbodyHtml += '<td class="text-center font-weight-bold text-muted" style="font-size: 11px;">' + (rIdx + 1) + '</td>';

        if (isSingleYear) {
          tbodyHtml += '<td style="font-size: 11.5px;">' +
                       '<span class="font-weight-bold text-dark">' + (row.SubKategori || '-') + '</span><br>' +
                       '<small class="text-muted">' + (row.Kategori || '-') + '</small>' +
                       '</td>';
        } else {
          tbodyHtml += '<td style="font-size: 11px;" class="text-muted">' + (row.Kategori || '-') + '</td>';
          tbodyHtml += '<td style="font-size: 11.5px;" class="font-weight-bold text-dark">' + (row.SubKategori || '-') + '</td>';
        }

        tbodyHtml += '<td class="font-weight-bold text-dark" style="font-size: 12.5px;">' + 
                     escapeHtml(row.NamaIndikator) + 
                     ' <button type="button" class="btn btn-xs btn-outline-info btn-lihat-chart-row py-0 px-2 ml-1" data-nama="' + escapeHtml(row.NamaIndikator) + '" style="font-size: 10px; border-radius: 6px; font-weight: 700;" title="Buka grafik tren untuk indikator ini"><i class="fa-solid fa-chart-line"></i> Grafik</button>' +
                     '</td>';
        tbodyHtml += '<td class="text-center" style="font-size: 11px;"><span class="satuan-badge">' + (row.Satuan || '-') + '</span></td>';

        if (isSingleYear) {
          var valList = [];
          regions.forEach(function(r, idx) {
            var cls = (idx === 0) ? 'val-cell-comp-1' : ((idx === 1) ? 'val-cell-comp-2' : 'val-cell-comp-3');
            var v = (row.Values && row.Values[r.Id] && row.Values[r.Id][selectedThn] !== undefined) ? row.Values[r.Id][selectedThn] : '';
            valList.push(v);
            tbodyHtml += '<td class="' + cls + '">' + (v !== '' ? v : '<span class="text-muted font-italic">-</span>') + '</td>';
          });

          if (regions.length === 2) {
            var v1 = valList[0];
            var v2 = valList[1];
            var deltaHtml = '<span class="text-muted">-</span>';
            var n1 = parseFloat(String(v1).replace(',', '.'));
            var n2 = parseFloat(String(v2).replace(',', '.'));

            if (!isNaN(n1) && !isNaN(n2)) {
              var diff = n1 - n2;
              var diffFormatted = (Math.round(diff * 100) / 100).toFixed(2);
              if (diff > 0) {
                deltaHtml = '<span class="badge-selisih-pos">+' + diffFormatted + '</span>';
              } else if (diff < 0) {
                deltaHtml = '<span class="badge-selisih-neg">' + diffFormatted + '</span>';
              } else {
                deltaHtml = '<span class="badge-selisih-zero">0.00 (Sama)</span>';
              }
            }
            tbodyHtml += '<td class="text-center">' + deltaHtml + '</td>';
          }
        } else {
          regions.forEach(function(r, idx) {
            var cls = (idx === 0) ? 'val-cell-comp-1' : ((idx === 1) ? 'val-cell-comp-2' : 'val-cell-comp-3');
            if (allYears.length > 0) {
              allYears.forEach(function(y) {
                var v = (row.Values && row.Values[r.Id] && row.Values[r.Id][y] !== undefined) ? row.Values[r.Id][y] : '';
                tbodyHtml += '<td class="' + cls + '">' + (v !== '' ? v : '<span class="text-muted">-</span>') + '</td>';
              });
            } else {
              tbodyHtml += '<td class="' + cls + '">-</td>';
            }
          });
        }

        tbodyHtml += '</tr>';
      });

      $('#tbodyKomparasi').html(tbodyHtml);

      // Perbarui opsi dropdown indikator di tampilan grafik
      updateChartIndikatorOptions();
    }

    // =========================================================================
    // VISUALISASI GRAFIK / CHART.JS LOGIC
    // =========================================================================
    var _chartInstanceTrend = null;
    var _chartInstanceSub = null;
    var _currentChartType = 'line';

    function escapeHtml(text) {
      if (!text) return '';
      return String(text)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    }

    // Tab switcher Tabel vs Grafik
    $(document).on('click', '.btn-tab-komparasi-mode', function() {
      var mode = $(this).data('mode');
      $('.btn-tab-komparasi-mode').removeClass('active');
      $(this).addClass('active');

      if (mode === 'grafik') {
        $('#paneKomparasiTabel').hide();
        $('#paneKomparasiGrafik').show();
        updateChartIndikatorOptions();
        renderKomparasiCharts();
      } else {
        $('#paneKomparasiGrafik').hide();
        $('#paneKomparasiTabel').show();
      }
    });

    // Toggle tipe chart Line vs Bar
    $(document).on('click', '.btn-toggle-chart-type', function() {
      var type = $(this).data('type');
      _currentChartType = type;
      $('.btn-toggle-chart-type').removeClass('btn-primary active').addClass('btn-outline-primary');
      $(this).removeClass('btn-outline-primary').addClass('btn-primary active');
      renderKomparasiCharts();
    });

    // Klik tombol grafik di baris tabel langsung loncat ke visualisasi indikator tersebut
    $(document).on('click', '.btn-lihat-chart-row', function(e) {
      e.preventDefault();
      var namaInd = $(this).data('nama');
      if (namaInd) {
        $('#selectChartIndikator').val(namaInd);
        renderKomparasiCharts();
        if ($('#cardKomparasiGrafik').length) {
          $('html, body').animate({ scrollTop: $('#cardKomparasiGrafik').offset().top - 80 }, 300);
        }
      }
    });

    $('#selectChartIndikator').on('change', function() {
      renderKomparasiCharts();
    });

    function updateChartIndikatorOptions(selectedNama) {
      if (!_komparasiData || !_komparasiData.rows) return;
      var sel = $('#selectChartIndikator');
      var curVal = selectedNama || sel.val();
      sel.empty();

      var selectedKat = $('#filterKomparasiKategori').val();
      var selectedSub = $('#filterKomparasiSub').val();

      var availableRows = _komparasiData.rows.filter(function(r) {
        if (selectedKat !== 'ALL' && r.Kategori !== selectedKat) return false;
        if (selectedSub !== 'ALL' && r.SubKategori !== selectedSub) return false;
        return true;
      });

      if (availableRows.length === 0) availableRows = _komparasiData.rows;

      availableRows.forEach(function(r) {
        var opt = $('<option></option>').attr('value', r.NamaIndikator).text(r.NamaIndikator + ' (' + (r.SubKategori || '-') + ')');
        sel.append(opt);
      });

      if (curVal && sel.find('option[value="' + curVal + '"]').length) {
        sel.val(curVal);
      } else if (availableRows.length > 0) {
        sel.val(availableRows[0].NamaIndikator);
      }
    }

    function renderKomparasiCharts() {
      if (typeof Chart === 'undefined') {
        console.warn('Chart.js belum siap.');
        return;
      }
      if (!_komparasiData || !_komparasiData.rows || !_komparasiData.regions) return;

      var targetName = $('#selectChartIndikator').val();
      var targetRow = null;
      for (var i = 0; i < _komparasiData.rows.length; i++) {
        if (_komparasiData.rows[i].NamaIndikator === targetName) {
          targetRow = _komparasiData.rows[i];
          break;
        }
      }
      if (!targetRow && _komparasiData.rows.length > 0) {
        targetRow = _komparasiData.rows[0];
      }
      if (!targetRow) return;

      $('#lblSatuanChart').text(targetRow.Satuan || '-');
      $('#titleMainChart').html('<i class="fa-solid fa-chart-line text-primary mr-1"></i> Tren Komparasi: ' + targetRow.NamaIndikator + (targetRow.Satuan ? ' (' + targetRow.Satuan + ')' : ''));

      var regions = _komparasiData.regions;
      var allYears = _komparasiData.all_years || [];

      var colorSchemes = [
        { border: '#0284c7', bg: 'rgba(2, 132, 199, 0.25)', badge: 'background: #0284c7; color: #fff;' },
        { border: '#10b981', bg: 'rgba(16, 185, 129, 0.25)', badge: 'background: #10b981; color: #fff;' },
        { border: '#f59e0b', bg: 'rgba(245, 158, 11, 0.25)', badge: 'background: #f59e0b; color: #fff;' }
      ];

      // 1. Stat Cards
      var statCardsHtml = '';
      var chartYearVal = $('#filterKomparasiTahun').val();
      var activeChartYear = (chartYearVal && chartYearVal !== 'ALL') ? chartYearVal : (allYears.length > 0 ? allYears[allYears.length - 1] : null);

      regions.forEach(function(r, idx) {
        var c = colorSchemes[idx % colorSchemes.length];
        var valLatest = (activeChartYear && targetRow.Values && targetRow.Values[r.Id] && targetRow.Values[r.Id][activeChartYear] !== undefined) ? targetRow.Values[r.Id][activeChartYear] : '-';

        statCardsHtml += 
          '<div class="col-md-' + (12 / regions.length) + ' mb-2">' +
            '<div class="p-3 rounded shadow-sm border" style="background: #ffffff; border-top: 4px solid ' + c.border + ' !important;">' +
              '<div class="d-flex align-items-center justify-content-between mb-1">' +
                '<span class="badge px-2 py-1 font-weight-bold" style="' + c.badge + '; font-size: 11px; border-radius: 6px;">' + r.NamaDaerah + '</span>' +
                '<small class="text-muted font-weight-bold">Tahun ' + (activeChartYear || '-') + '</small>' +
              '</div>' +
              '<div class="d-flex align-items-baseline justify-content-between mt-2">' +
                '<div style="font-size: 22px; font-weight: 800; color: #1e293b;">' + (valLatest !== '-' ? valLatest : '<span class="text-muted font-italic">-</span>') + '</div>' +
                '<div class="text-muted" style="font-size: 12px; font-weight: 600;">' + (targetRow.Satuan || '') + '</div>' +
              '</div>' +
            '</div>' +
          '</div>';
      });

      $('#containerStatCardsChart').html(statCardsHtml);

      var focusBadge = (chartYearVal && chartYearVal !== 'ALL') ? ' <span class="badge badge-info ml-2 px-2 py-1" style="font-size: 11px; background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; font-weight: 700;">Tahun ' + chartYearVal + '</span>' : '';
      $('#titleMainChart').html('<i class="fa-solid fa-chart-line text-primary mr-1"></i> Tren Komparasi: ' + targetRow.NamaIndikator + (targetRow.Satuan ? ' (' + targetRow.Satuan + ')' : '') + focusBadge);

      // 2. Render Main Trend Chart (canvasKomparasiChart)
      var datasetsTrend = [];
      regions.forEach(function(r, idx) {
        var c = colorSchemes[idx % colorSchemes.length];
        var dataPoints = [];
        var pointRadii = [];
        var pointHoverRadii = [];

        allYears.forEach(function(y) {
          var raw = (targetRow.Values && targetRow.Values[r.Id] && targetRow.Values[r.Id][y] !== undefined) ? targetRow.Values[r.Id][y] : null;
          if (raw !== null && raw !== '') {
            var parsed = parseFloat(String(raw).replace(',', '.'));
            dataPoints.push(!isNaN(parsed) ? parsed : null);
          } else {
            dataPoints.push(null);
          }

          if (chartYearVal && chartYearVal !== 'ALL' && String(y) === String(chartYearVal)) {
            pointRadii.push(9);
            pointHoverRadii.push(12);
          } else {
            pointRadii.push(5);
            pointHoverRadii.push(8);
          }
        });

        datasetsTrend.push({
          label: r.NamaDaerah,
          data: dataPoints,
          borderColor: c.border,
          backgroundColor: c.bg,
          borderWidth: 3,
          tension: 0,
          fill: (_currentChartType === 'line' ? false : true),
          pointRadius: pointRadii,
          pointHoverRadius: pointHoverRadii,
          spanGaps: true
        });
      });

      if (_chartInstanceTrend) {
        _chartInstanceTrend.destroy();
        _chartInstanceTrend = null;
      }

      var allNums = [];
      datasetsTrend.forEach(function(ds) {
        ds.data.forEach(function(val) {
          if (val !== null && !isNaN(val)) allNums.push(val);
        });
      });

      var minVal = allNums.length > 0 ? Math.min.apply(null, allNums) : 0;
      var maxVal = allNums.length > 0 ? Math.max.apply(null, allNums) : 100;

      var yMin = 0;
      var yMax = undefined;
      var stepSize = undefined;
      var isTruncatedZero = false;

      if (minVal > 15) {
        var span = maxVal - minVal;
        stepSize = span <= 15 ? 5 : 10;
        var roundedFloor = Math.floor(minVal / stepSize) * stepSize;
        yMin = roundedFloor - stepSize;
        yMax = Math.ceil((maxVal + 2) / stepSize) * stepSize;
        isTruncatedZero = true;
      } else {
        yMin = 0;
      }

      var ctxTrend = document.getElementById('canvasKomparasiChart');
      if (ctxTrend) {
        _chartInstanceTrend = new Chart(ctxTrend.getContext('2d'), {
          type: _currentChartType,
          data: {
            labels: allYears,
            datasets: datasetsTrend
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
              legend: {
                position: 'top',
                labels: { font: { weight: 'bold', size: 12 }, padding: 15 }
              },
              tooltip: {
                backgroundColor: 'rgba(15, 23, 42, 0.9)',
                padding: 12,
                titleFont: { size: 13, weight: 'bold' },
                bodyFont: { size: 12 },
                callbacks: {
                  label: function(context) {
                    var val = context.parsed.y !== null ? context.parsed.y : '-';
                    return ' ' + context.dataset.label + ': ' + val + (targetRow.Satuan ? ' ' + targetRow.Satuan : '');
                  }
                }
              }
            },
            scales: {
              y: {
                min: yMin,
                max: yMax,
                grid: { color: '#f1f5f9' },
                ticks: {
                  stepSize: stepSize,
                  font: { weight: '600' },
                  callback: function(value) {
                    if (isTruncatedZero && value === yMin) {
                      return '0';
                    }
                    return value;
                  }
                }
              },
              x: {
                grid: { display: false },
                ticks: { font: { weight: '700' } }
              }
            }
          }
        });
      }

      // 3. Render Benchmark Multi-Indikator Sub-Kategori (canvasMultiSubChart)
      var subName = targetRow.SubKategori || '';
      var subRows = _komparasiData.rows.filter(function(r) {
        return r.SubKategori === subName;
      });

      if (subRows.length > 0) {
        $('#boxMultiSubChart').show();
        var selectedThn = $('#filterKomparasiTahun').val();
        var fallbackLatest = (allYears.length > 0) ? allYears[allYears.length - 1] : null;
        var compYear = (selectedThn && selectedThn !== 'ALL') ? selectedThn : (fallbackLatest || '2023');

        $('#titleMultiSubChart').html('<i class="fa-solid fa-chart-column text-success mr-1"></i> Benchmark Sub-Kategori: ' + subName);
        $('#subTitleMultiSubChart').html('Perbandingan seluruh indikator dalam sub-kategori <b>' + subName + '</b> untuk Tahun <b>' + compYear + '</b>:');

        // Saring indikator agar yang memiliki nilai pada tahun compYear tampil proporsional
        var activeSubRows = subRows.filter(function(sr) {
          var hasAny = false;
          regions.forEach(function(r) {
            if (sr.Values && sr.Values[r.Id] && sr.Values[r.Id][compYear] !== undefined && sr.Values[r.Id][compYear] !== '') {
              hasAny = true;
            }
          });
          return hasAny;
        });

        var displaySubRows = (activeSubRows.length > 0) ? activeSubRows : subRows;

        var subLabels = [];
        var subFullNames = [];
        displaySubRows.forEach(function(sr) {
          var shortName = sr.NamaIndikator.length > 26 ? (sr.NamaIndikator.substring(0, 24) + '...') : sr.NamaIndikator;
          subLabels.push(shortName);
          subFullNames.push(sr.NamaIndikator + (sr.Satuan ? ' (' + sr.Satuan + ')' : ''));
        });

        var datasetsSub = [];
        regions.forEach(function(r, idx) {
          var c = colorSchemes[idx % colorSchemes.length];
          var points = [];
          displaySubRows.forEach(function(sr) {
            var raw = (sr.Values && sr.Values[r.Id] && sr.Values[r.Id][compYear] !== undefined) ? sr.Values[r.Id][compYear] : null;
            if (raw !== null && raw !== '') {
              var parsed = parseFloat(String(raw).replace(',', '.'));
              points.push(!isNaN(parsed) ? parsed : null);
            } else {
              points.push(null);
            }
          });

          datasetsSub.push({
            label: r.NamaDaerah,
            data: points,
            backgroundColor: c.border,
            borderRadius: 6
          });
        });

        if (_chartInstanceSub) {
          _chartInstanceSub.destroy();
          _chartInstanceSub = null;
        }

        var ctxSub = document.getElementById('canvasMultiSubChart');
        if (ctxSub) {
          _chartInstanceSub = new Chart(ctxSub.getContext('2d'), {
            type: 'bar',
            data: {
              labels: subLabels,
              datasets: datasetsSub
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              interaction: { mode: 'index', intersect: false },
              plugins: {
                legend: {
                  position: 'top',
                  labels: { font: { weight: 'bold', size: 12 }, padding: 15 }
                },
                tooltip: {
                  backgroundColor: 'rgba(15, 23, 42, 0.9)',
                  padding: 12,
                  callbacks: {
                    title: function(items) {
                      var idx = items[0].dataIndex;
                      return subFullNames[idx] || items[0].label;
                    }
                  }
                }
              },
              scales: {
                y: {
                  beginAtZero: true,
                  grid: { color: '#f1f5f9' },
                  ticks: { font: { weight: '600' } }
                },
                x: {
                  grid: { display: false },
                  ticks: { font: { size: 11, weight: '600' } }
                }
              }
            }
          });
        }
      } else {
        $('#boxMultiSubChart').hide();
      }
    }

    // Export CSV Komparasi
    $('#btnExportCsvKomparasi').on('click', function() {
      var table = document.getElementById('tabelKomparasiData');
      if (!table) return;

      var csv = [];
      for (var i = 0; i < table.rows.length; i++) {
        var row = [];
        var cols = table.rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
          var cleanText = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, ' ').replace(/"/g, '""').trim();
          row.push('"' + cleanText + '"');
        }
        csv.push(row.join(','));
      }

      var csvString = '\uFEFF' + csv.join('\n');
      var blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
      var link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.setAttribute('download', 'komparasi_indikator_daerah.csv');
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    });

    // Print Komparasi
    $('#btnPrintKomparasi').on('click', function() {
      window.print();
    });

  });
</script>
</body>
</html>
