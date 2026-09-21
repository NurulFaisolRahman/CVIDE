<?php
$userLevel = (int)($this->session->userdata('level') ?? 3);
$hasActiveDaerah = !empty($ActiveDaerah);
$activeId = $hasActiveDaerah ? (int)$ActiveDaerah['Id'] : 0;
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

  /* Indikator Table & Detail View */
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
  .badge-kategori {
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 11.5px;
    font-weight: 600;
    background: #f0f9ff;
    color: #0369a1;
    border: 1px solid #bae6fd;
    display: inline-block;
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
  }
  .val-cell {
    font-family: 'Consolas', 'Courier New', monospace;
    font-weight: 700;
    font-size: 13px;
    color: #0f172a;
    text-align: center;
  }
  .val-empty {
    color: #cbd5e1;
    font-style: italic;
    font-size: 11.5px;
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
</style>

<?php if (!$hasActiveDaerah): ?>
  <!-- =========================================================================
       HALAMAN PERTAMA: HANYA MENAMPILKAN DAFTAR NAMA DAERAH
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
                Silakan pilih salah satu daerah di bawah untuk membuka dan mengolah data indikator, kategori, gender, serta series tahun dinamis.
              </p>
            </div>
          </div>

          <div>
            <button type="button" class="btn btn-primary btnBukaModalTambahDaerah" data-toggle="modal" data-target="#ModalInputDaerah" style="border-radius: 12px; font-weight: 700; font-size: 13px; padding: 10px 22px; background: var(--ide-navy); border: none; box-shadow: 0 4px 14px rgba(4, 49, 104, 0.3); display: inline-flex; align-items: center; gap: 8px;">
              <i class="fa-solid fa-plus-circle"></i> Tambah Daerah Baru
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Grid Kartu Nama Daerah -->
  <div class="row align-items-stretch">
    <?php if (!empty($DaerahList)): ?>
      <?php foreach ($DaerahList as $d): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="daerah-card">
            <div class="daerah-card-header">
              <div class="d-flex align-items-center justify-content-between">
                <div class="daerah-card-icon">
                  <i class="fa-solid fa-city"></i>
                </div>
                <span class="badge badge-light px-2 py-1" style="font-size: 11px; font-weight: 700; border-radius: 6px; color: var(--ide-navy);">
                  <?= $d['YearsCount'] ?> Kolom Tahun
                </span>
              </div>
              <h5 class="daerah-card-title"><?= htmlspecialchars($d['NamaDaerah']) ?></h5>
              <div style="font-size: 11.5px; opacity: 0.85;">
                Tahun Aktif: <?= htmlspecialchars($d['RentangTahun']) ?>
              </div>
            </div>
            <div class="daerah-card-body">
              <div class="mb-3">
                <p class="text-muted mb-3" style="font-size: 12.5px; line-height: 1.5; min-height: 38px;">
                  <?= !empty($d['Keterangan']) ? htmlspecialchars($d['Keterangan']) : 'Basis data olahan indikator statistik dan makro wilayah.' ?>
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

                <div class="d-flex align-items-center" style="gap: 4px;">
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

<?php else: ?>
  <!-- =========================================================================
       HALAMAN KEDUA: SAAT DAERAH DIBUKA, BARU MUNCUL ISI DATANYA
       ========================================================================= -->
  <div class="row" style="margin-top: 22px;">
    <div class="col-12">
      <div class="olah-header-card">
        <!-- Tombol Kembali ke Katalog Daerah -->
        <div class="mb-3">
          <a href="<?= base_url('Staf/OlahData') ?>" class="btn btn-sm btn-light" style="border-radius: 10px; font-weight: 700; font-size: 12.5px; padding: 6px 16px; border: 1.5px solid #cbd5e1; color: #334155; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Daerah
          </a>
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
                  Data Terbuka
                </span>
              </div>
              <p class="text-muted mb-0 mt-1" style="font-size: 12.5px;">
                <?= !empty($ActiveDaerah['Keterangan']) ? htmlspecialchars($ActiveDaerah['Keterangan']) : 'Pengolahan indikator, kategori, gender, serta kolom tahun.' ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Manajemen Kolom Tahun (Tambah & Kurang Tahun Sesuai Kebutuhan) -->
  <div class="row mb-3">
    <div class="col-12">
      <div class="card border-0 shadow-sm" style="border-radius: 16px; background: #ffffff;">
        <div class="card-body p-3">
          <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 12px;">
            <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
              <span class="font-weight-bold text-dark d-inline-flex align-items-center mr-2" style="font-size: 12.5px;">
                <i class="fa-regular fa-calendar-days text-primary mr-1"></i> Kolom Tahun Aktif (Header Judul):
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
                <span class="text-muted" style="font-size: 12px; font-style: italic;">Belum ada kolom tahun. Tambahkan tahun melalui tombol di kanan.</span>
              <?php endif; ?>
            </div>

            <!-- Tombol Tambah Tahun Baru -->
            <div class="d-flex align-items-center" style="gap: 10px;">
              <button type="button" class="btn btn-sm btn-outline-success btnBukaModalTambahTahun" data-toggle="modal" data-target="#ModalTambahTahun" style="border-radius: 10px; font-weight: 700; font-size: 12px; padding: 6px 14px; display: inline-flex; align-items: center; gap: 5px;">
                <i class="fa-solid fa-plus"></i> Tambah Tahun
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Table Matrix Indikator -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm border-0" style="border-radius: 16px; background: #ffffff;">
        <div class="card-body p-3">
          <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 pb-2" style="gap: 12px; border-bottom: 1px solid #f1f5f9;">
            <div>
              <h5 class="font-weight-bold text-dark mb-0" style="font-size: 16px;">
                <i class="fa-solid fa-table-list mr-1 text-primary"></i> Tabel Indikator: <?= htmlspecialchars($ActiveDaerah['NamaDaerah']) ?>
              </h5>
              <div class="text-muted" style="font-size: 12px; margin-top: 2px;">
                Total <?= count($IndikatorList) ?> Indikator Terdaftar | Tahun menjadi judul kolom dinamis.
              </div>
            </div>

            <!-- Tombol Aksi Tabel: Tambah Manual, Tambah via API, Cetak -->
            <div class="d-flex flex-wrap align-items-center justify-content-end" style="gap: 10px;">
              <button type="button" class="btn btn-primary btnBukaModalTambahIndikatorManual" data-toggle="modal" data-target="#ModalInputIndikatorManual" style="border-radius: 10px; font-weight: 700; font-size: 12.5px; padding: 8px 18px; background: var(--ide-navy); border: none; box-shadow: 0 4px 14px rgba(4, 49, 104, 0.25); display: inline-flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-pen-to-square"></i> Tambah Indikator Manual
              </button>
              <button type="button" class="btn btn-info text-white btnBukaModalTambahIndikatorApi" data-toggle="modal" data-target="#ModalInputIndikatorApi" style="border-radius: 10px; font-weight: 700; font-size: 12.5px; padding: 8px 18px; background: #0284c7; border: none; box-shadow: 0 4px 14px rgba(2, 132, 199, 0.25); display: inline-flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-cloud-arrow-down"></i> Tambah Indikator (API)
              </button>
              <button type="button" class="btn btn-outline-secondary" onclick="window.print()" style="border-radius: 10px; font-weight: 600; font-size: 12.5px; padding: 8px 16px; border: 1.5px solid #cbd5e1; background: #ffffff; color: #334155; display: inline-flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-print"></i> Cetak
              </button>
            </div>
          </div>
          <div class="table-responsive">
            <table id="TabelIndikator" class="table table-hover table-striped w-100" style="border-radius: 12px; overflow: hidden;">
              <thead>
                <tr style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff;">
                  <th style="width: 4%;" class="text-center align-middle">No</th>
                  <th style="width: 24%; min-width: 190px;" class="align-middle">Nama Indikator</th>
                  <th style="width: 12%; min-width: 110px;" class="text-center align-middle">Kategori</th>
                  <th style="width: 9%; min-width: 90px;" class="text-center align-middle">Gender</th>
                  <th style="width: 8%; min-width: 75px;" class="text-center align-middle">Satuan</th>
                  <?php foreach ($TahunList as $thn): ?>
                    <th style="min-width: 90px;" class="text-center align-middle">
                      <?= htmlspecialchars($thn) ?>
                    </th>
                  <?php endforeach; ?>
                  <th style="width: 9%; min-width: 85px;" class="text-center align-middle">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($IndikatorList as $ind):
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
                    <td class="text-center align-middle font-weight-bold"><?= $no++ ?></td>
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
                      <?php if (!empty($ind['Kategori'])): ?>
                        <span class="badge-kategori"><?= htmlspecialchars($ind['Kategori']) ?></span>
                      <?php else: ?>
                        <span class="text-muted" style="font-size: 11.5px;">-</span>
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
                      <td class="text-center align-middle val-cell">
                        <?php if ($val !== ''): ?>
                          <?= htmlspecialchars($val) ?>
                        <?php else: ?>
                          <span class="val-empty">-</span>
                        <?php endif; ?>
                      </td>
                    <?php endforeach; ?>
                    <td class="text-center align-middle">
                      <div class="d-inline-flex align-items-center justify-content-center" style="gap: 6px;">
                        <?php if (!empty($ind['ApiUrl'])): ?>
                          <button type="button" class="btn btn-sm btn-info text-white btn-action-table btnSyncIndikator" 
                                  data-id="<?= $ind['Id'] ?>"
                                  data-nama="<?= htmlspecialchars($ind['NamaIndikator'], ENT_QUOTES) ?>"
                                  title="Sinkronkan / Tarik Ulang dari API">
                            <i class="fa-solid fa-arrows-rotate"></i>
                          </button>
                        <?php endif; ?>
                        <button type="button" class="btn btn-sm btn-warning text-white btn-action-table btnEditIndikator" 
                                data-id="<?= $ind['Id'] ?>"
                                data-daerah-id="<?= $ind['DaerahId'] ?>"
                                data-nama="<?= htmlspecialchars($ind['NamaIndikator'], ENT_QUOTES) ?>"
                                data-api="<?= htmlspecialchars($ind['ApiUrl'] ?? '', ENT_QUOTES) ?>"
                                data-kategori="<?= htmlspecialchars($ind['Kategori'] ?? '', ENT_QUOTES) ?>"
                                data-gender="<?= htmlspecialchars($ind['Gender'] ?? 'Total', ENT_QUOTES) ?>"
                                data-satuan="<?= htmlspecialchars($ind['Satuan'] ?? '', ENT_QUOTES) ?>"
                                data-ket="<?= htmlspecialchars($ind['Keterangan'] ?? '', ENT_QUOTES) ?>"
                                data-tahun='<?= json_encode($dataThn, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                title="Edit Data Indikator">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btn-action-table btnHapusIndikator" 
                                data-id="<?= $ind['Id'] ?>"
                                data-nama="<?= htmlspecialchars($ind['NamaIndikator'], ENT_QUOTES) ?>"
                                title="Hapus Indikator">
                          <i class="fa-solid fa-trash-can"></i>
                        </button>
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

<!-- Tutup Kontainer Halaman Utama dari Header.php -->
  </div>
</div>
</div>
</div>

<!-- =========================================================================
     MODAL-MODAL INTERAKTIF (Ditempatkan di luar layout agar z-index bersih)
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
          <i class="fa-solid fa-calendar-plus mr-2"></i> Tambah Tahun
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
            <small class="text-muted" style="font-size: 11px;">Kolom tahun baru akan otomatis ditambahkan ke tabel daerah ini.</small>
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

          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Nama Indikator <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="NamaIndikator" id="inManualNamaIndikator" placeholder="Contoh: Angka Harapan Hidup, Tingkat Kemiskinan, IPM" required style="border-radius: 10px;">
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12px;">Kategori Indikator</label>
                <input type="text" class="form-control" name="Kategori" id="inManualKategoriIndikator" placeholder="Contoh: Kesehatan, Pendidikan" list="kategoriSuggestions" style="border-radius: 10px;">
              </div>
            </div>
            <div class="col-md-4">
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
            <div class="col-md-4">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12px;">Satuan Indikator</label>
                <input type="text" class="form-control" name="Satuan" id="inManualSatuan" placeholder="Contoh: %, Jiwa, Tahun, Poin" list="satuanSuggestions" style="border-radius: 10px;">
              </div>
            </div>
          </div>

          <!-- Bagian Input Nilai Manual Per Kolom Tahun -->
          <div class="card p-3 mb-3 bg-light border-0" style="border-radius: 12px; border: 1px solid #e2e8f0 !important;">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <label class="font-weight-bold text-dark mb-0" style="font-size: 12.5px;">
                <i class="fa-solid fa-input-numeric text-primary mr-1"></i> Nilai Indikator Per Kolom Tahun:
              </label>
              <small class="text-muted font-italic">Kosongkan jika belum ada angka untuk tahun tertentu.</small>
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
                  Belum ada kolom tahun terdaftar di daerah ini. Silakan tambahkan tahun melalui tombol <b>Tambah Tahun</b> di atas.
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="form-group mb-0">
            <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Keterangan / Catatan Metodologi</label>
            <textarea class="form-control" name="Keterangan" id="inManualKeteranganIndikator" rows="2" placeholder="Catatan sumber data, definisi operasional, atau rumus perhitungan..." style="border-radius: 10px;"></textarea>
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

          <!-- BAGIAN UTAMA: MASUKKAN URL API / JSON -->
          <div class="card p-3 mb-3 border-0" style="border-radius: 14px; background: #f0fdf4; border: 1.5px solid #86efac !important;">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <label class="font-weight-bold text-dark mb-0" style="font-size: 13px;">
                <i class="fa-solid fa-cloud-arrow-down text-success mr-1"></i> Sumber Data API / JSON:
              </label>
              <span class="badge badge-success px-2 py-1" style="font-size: 10.5px; border-radius: 6px;">Otomatisasi Data</span>
            </div>
            <p class="text-muted mb-2" style="font-size: 12px; line-height: 1.4;">
              Masukkan URL REST API endpoint JSON atau paste teks respon JSON. Sistem akan mengekstrak otomatis nama indikator, tahun, dan nilai.
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
            <input type="text" class="form-control" name="NamaIndikator" id="inApiNamaIndikator" placeholder="Nama indikator (otomatis terisi atau sesuaikan manual)" required style="border-radius: 10px;">
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12px;">Kategori Indikator</label>
                <input type="text" class="form-control" name="Kategori" id="inApiKategoriIndikator" placeholder="Kategori" list="kategoriSuggestions" style="border-radius: 10px;">
              </div>
            </div>
            <div class="col-md-4">
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
            <div class="col-md-4">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12px;">Satuan Indikator</label>
                <input type="text" class="form-control" name="Satuan" id="inApiSatuan" placeholder="Satuan" list="satuanSuggestions" style="border-radius: 10px;">
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
            <div class="col-md-4">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Kategori Indikator</label>
                <input type="text" class="form-control" name="Kategori" id="editKategoriIndikator" list="kategoriSuggestions" style="border-radius: 10px;">
              </div>
            </div>
            <div class="col-md-4">
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
            <div class="col-md-4">
              <div class="form-group mb-3">
                <label class="font-weight-bold text-dark" style="font-size: 12.5px;">Satuan Indikator</label>
                <input type="text" class="form-control" name="Satuan" id="editSatuan" list="satuanSuggestions" style="border-radius: 10px;">
              </div>
            </div>
          </div>

          <!-- Nilai Tahunan Dinamis untuk Edit -->
          <div class="card p-3 mb-3 bg-light border-0" style="border-radius: 12px;">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <label class="font-weight-bold text-dark mb-0" style="font-size: 13px;">
                <i class="fa-solid fa-input-numeric text-primary mr-1"></i> Nilai Indikator Per Tahun:
              </label>
              <small class="text-muted font-italic">Format angka desimal atau satuan.</small>
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



<!-- Scripts Eksternal Pendukung Bootstrap & DataTables -->
<script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
<script src="<?=base_url("assets/datatables/jquery.dataTables.js")?>"></script>
<script src="<?=base_url("assets/datatables-bs4/js/dataTables.bootstrap4.js")?>"></script>
<script src="<?=base_url("build/js/custom.min.js")?>"></script>

<script>
  $(document).ready(function() {
    var BaseURL = '<?= base_url() ?>';

    // Inisialisasi DataTable untuk Matrix Indikator jika ada
    if ($('#TabelIndikator').length && $.fn.DataTable) {
      $('#TabelIndikator').DataTable({
        "language": {
          "lengthMenu": "Tampilkan _MENU_ indikator",
          "zeroRecords": "Tidak ada data indikator ditemukan",
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ indikator",
          "infoEmpty": "Menampilkan 0 indikator",
          "infoFiltered": "(difilter dari _MAX_ total indikator)",
          "search": "Cari Indikator:",
          "paginate": {
            "first": "Awal",
            "last": "Akhir",
            "next": "Lanjut",
            "previous": "Sebelum"
          }
        },
        "pageLength": 15,
        "order": [[0, "asc"]]
      });
    }

    // =========================================================================
    // HANDLERS TRIGGER PEMBUKA & PENUTUP MODAL (100% RESPONSIF)
    // =========================================================================


    $(document).on('click', '[data-target="#ModalInputDaerah"], .btnBukaModalTambahDaerah', function(e) {
      e.preventDefault();
      $('#ModalInputDaerah').modal('show');
    });

    $(document).on('click', '[data-target="#ModalTambahTahun"], .btnBukaModalTambahTahun', function(e) {
      e.preventDefault();
      $('#ModalTambahTahun').modal('show');
    });

    $(document).on('click', '[data-target="#ModalInputIndikatorManual"], .btnBukaModalTambahIndikatorManual', function(e) {
      e.preventDefault();
      $('#ModalInputIndikatorManual').modal('show');
    });

    $(document).on('click', '[data-target="#ModalInputIndikatorApi"], .btnBukaModalTambahIndikatorApi', function(e) {
      e.preventDefault();
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
    $('#inManualNamaIndikator').on('keypress', function(e) {
      if (e.which === 13) { $('#btnSimpanIndikatorManual').click(); }
    });
    $('#inApiNamaIndikator').on('keypress', function(e) {
      if (e.which === 13) { $('#btnSimpanIndikatorApi').click(); }
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
    // 4. TAMBAH TAHUN BARU
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

    // =========================================================================
    // 5. HAPUS / KURANG TAHUN
    // =========================================================================
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
    // 6. UJI & TARIK DATA DARI API / JSON (MODAL INDIKATOR API)
    // =========================================================================
    function applyIndicatorDataToForm(indData, sourceUrl) {
      if (!indData) return;

      // 1. Nama Indikator (Otomatis terisi)
      $('#inApiNamaIndikator').val(indData.NamaIndikator || '');

      // 2. Kategori (Otomatis terisi)
      $('#inApiKategoriIndikator').val(indData.Kategori || '');

      // 3. Gender / Jenis Kelamin (Otomatis terisi & disesuaikan)
      var g = (indData.Gender || 'Total').toString().trim();
      if ($('#inApiGender option[value="' + g + '"]').length) {
        $('#inApiGender').val(g);
      } else if (g.toLowerCase().indexOf('laki') !== -1) {
        $('#inApiGender').val('Laki-laki');
      } else if (g.toLowerCase().indexOf('perempuan') !== -1 || g.toLowerCase().indexOf('wanita') !== -1) {
        $('#inApiGender').val('Perempuan');
      } else if (g.toLowerCase().indexOf('l+p') !== -1 || g.toLowerCase().indexOf('l + p') !== -1) {
        $('#inApiGender').val('L+P');
      } else {
        $('#inApiGender').val('Total');
      }

      // 4. Satuan (Otomatis terisi)
      $('#inApiSatuan').val(indData.Satuan || '');

      // 5. Keterangan (Otomatis terisi)
      var ket = indData.Keterangan || '';
      if (!ket && sourceUrl && sourceUrl.indexOf('http') === 0) {
        ket = 'Sumber data ditarik otomatis dari API: ' + sourceUrl;
      }
      $('#inApiKeteranganIndikator').val(ket);

      // 6. Nilai Kolom Tahun (Otomatis dibuatkan input & diisi nilainya)
      var dataTahun = indData.DataTahun || {};
      $('#placeholderEmptyTahunApi').hide();

      var chipsHtml = '';
      var countYears = 0;

      // Bersihkan dan render input tahun sesuai data dari API
      $('#containerInputsTahunApi').empty();

      $.each(dataTahun, function(thn, val) {
        countYears++;
        chipsHtml += '<span class="badge badge-light border p-2" style="font-size: 11.5px; border-radius: 8px;">' +
                     '<b class="text-primary">' + thn + ':</b> ' + val + '</span>';

        var inputItem = 
          '<div class="col-sm-6 col-md-4 mb-2 item-input-tahun-api" data-tahun="' + thn + '">' +
            '<div class="input-group input-group-sm">' +
              '<div class="input-group-prepend">' +
                '<span class="input-group-text font-weight-bold bg-white" style="border-radius: 8px 0 0 8px; width: 65px; justify-content: center;">' + thn + '</span>' +
              '</div>' +
              '<input type="text" class="form-control font-weight-bold text-center input-val-tahun-api is-valid" data-tahun="' + thn + '" name="NilaiTahun[' + thn + ']" value="' + val + '" placeholder="Nilai" style="border-radius: 0 8px 8px 0;">' +
            '</div>' +
          '</div>';
        $('#containerInputsTahunApi').append(inputItem);
      });

      $('#apiParsedYearsContainerDirect').html(chipsHtml);
      $('#badgeApiCountDirect').text(countYears + ' Tahun Terdeteksi & Terisi');

      var metaText = '';
      if (indData.NamaIndikator) metaText += 'Indikator: <b class="text-dark">' + indData.NamaIndikator + '</b> | ';
      if (indData.Satuan) metaText += 'Satuan: <b>' + (indData.Satuan || '-') + '</b> | ';
      if (indData.Kategori) metaText += 'Kategori: <b>' + (indData.Kategori || '-') + '</b> | ';
      metaText += '<span class="text-success font-weight-bold"><i class="fa-solid fa-circle-check"></i> Semua data otomatis terisi dari API!</span>';
      $('#apiMetaInfoDirect').html(metaText);

      // Beri animasi visual pada field agar user melihat semua data otomatis terisi
      $('#inApiNamaIndikator, #inApiKategoriIndikator, #inApiGender, #inApiSatuan, #inApiKeteranganIndikator').addClass('is-valid');
      setTimeout(function() {
        $('.is-valid').removeClass('is-valid');
      }, 2500);
    }

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

            // Jika API memiliki lebih dari 1 indikator, sediakan opsi pilihan
            if (resp.indicators.length > 1) {
              var selectOptionsHtml = 
                '<div class="alert alert-info border-0 p-2 mb-2" style="border-radius: 10px; background: #e0f2fe; color: #0369a1;">' +
                  '<label class="font-weight-bold mb-1" style="font-size: 12px;"><i class="fa-solid fa-list-check mr-1"></i> Ditemukan ' + resp.indicators.length + ' Indikator dalam API. Pilih yang ingin dimuat:</label>' +
                  '<select id="selectPilihIndikatorApi" class="form-control form-control-sm font-weight-bold" style="border-radius: 8px; border: 1.5px solid #0284c7;">';
              $.each(resp.indicators, function(idx, item) {
                selectOptionsHtml += '<option value="' + idx + '">' + (idx + 1) + '. ' + (item.NamaIndikator || 'Indikator ' + (idx + 1)) + ' (' + Object.keys(item.DataTahun || {}).length + ' Kolom Tahun)</option>';
              });
              selectOptionsHtml += '</select></div>';
              $('#apiMultiSelectWrapper').html(selectOptionsHtml).show();
            } else {
              $('#apiMultiSelectWrapper').empty().hide();
            }

            // OTOMATIS ISI SEMUA DATA DARI INDIKATOR PERTAMA
            applyIndicatorDataToForm(resp.indicators[0], source);

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

    // Event saat user memilih indikator lain jika API multi-indikator
    $(document).on('change', '#selectPilihIndikatorApi', function() {
      var idx = parseInt($(this).val());
      if (_apiIndicatorsList && _apiIndicatorsList[idx]) {
        applyIndicatorDataToForm(_apiIndicatorsList[idx], $('#inApiUrlDirect').val().trim());
      }
    });

    // Enter key pada API URL memicu tombol Tarik Data
    $('#inApiUrlDirect').on('keypress', function(e) {
      if (e.which === 13) {
        $('#btnTarikApiDirect').click();
      }
    });


    // =========================================================================
    // 7A. SIMPAN INDIKATOR MANUAL
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

    // =========================================================================
    // 7B. SIMPAN INDIKATOR VIA API / JSON
    // =========================================================================
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
    // 8. SINKRONKAN / TARIK ULANG DARI API
    // =========================================================================
    $(document).on('click', '.btnSyncIndikator', function(e) {
      e.preventDefault();
      var btn = $(this);
      var id = btn.data('id');
      var nama = btn.data('nama');

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
    // 9. EDIT INDIKATOR
    // =========================================================================
    $(document).on('click', '.btnEditIndikator', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var api = $(this).data('api') || '';
      var kategori = $(this).data('kategori');
      var gender = $(this).data('gender');
      var satuan = $(this).data('satuan');
      var ket = $(this).data('ket');
      var dataThn = $(this).data('tahun') || {};

      $('#editIndikatorId').val(id);
      $('#editNamaIndikator').val(nama);
      $('#editApiUrl').val(api);
      $('#editKategoriIndikator').val(kategori);
      $('#editGender').val(gender);
      $('#editSatuan').val(satuan);
      $('#editKeteranganIndikator').val(ket);

      // Populate input tahun di modal edit
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
    // 10. HAPUS INDIKATOR
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
  });
</script>
</body>
</html>
