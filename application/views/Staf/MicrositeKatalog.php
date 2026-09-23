<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
  .microsite-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid var(--ide-border);
    box-shadow: 0 10px 30px rgba(4, 49, 104, 0.06);
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    display: flex;
    flex-direction: column;
    height: 100%;
  }
  .microsite-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 40px rgba(4, 49, 104, 0.12);
    border-color: #cbd5e1;
  }
  .microsite-card-header {
    position: relative;
    overflow: visible;
    width: 100%;
    z-index: 3;
  }
  .microsite-card-banner {
    height: 140px;
    width: 100%;
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, var(--ide-navy) 0%, #0a3d7c 100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .microsite-card-banner img.banner-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
  }
  .microsite-card-banner-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(4, 49, 104, 0.15) 0%, rgba(4, 49, 104, 0.85) 100%);
    pointer-events: none;
  }
  .microsite-card-logo-box {
    position: absolute;
    bottom: -28px;
    left: 20px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #ffffff;
    border: 3.5px solid #ffffff;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.16);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 4px;
    z-index: 5;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }
  .microsite-card:hover .microsite-card-logo-box {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.22);
  }
  .microsite-card-logo {
    width: 100%;
    height: 100%;
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    object-position: center;
    display: block;
  }
  .microsite-card-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 2;
    background: rgba(255, 255, 255, 0.95);
    color: var(--ide-navy);
    font-weight: 700;
    font-size: 11px;
    padding: 4px 10px;
    border-radius: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }
  .microsite-card-body {
    padding: 38px 20px 20px 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 1;
  }
  .microsite-card-title {
    font-size: 16px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    line-height: 1.3;
  }
  .microsite-card-subtitle {
    font-size: 12.5px;
    color: #64748b;
    margin-bottom: 16px;
    line-height: 1.4;
  }
  .microsite-stat-chip {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 8px 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
    font-size: 12px;
    font-weight: 600;
    color: #334155;
  }
  .microsite-actions {
    margin-top: auto;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .btn-builder {
    background: linear-gradient(135deg, var(--ide-navy) 0%, #0a3d7c 100%);
    color: #ffffff !important;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 13px;
    padding: 10px 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.25s ease;
    box-shadow: 0 4px 12px rgba(4, 49, 104, 0.25);
    text-decoration: none !important;
  }
  .btn-builder:hover {
    background: linear-gradient(135deg, #021e42 0%, var(--ide-navy) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(4, 49, 104, 0.35);
  }
  .btn-secondary-action {
    border-radius: 10px;
    font-size: 12px;
    font-weight: 600;
    padding: 6px 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
  }
</style>

<!-- Page Header Card -->
<div class="row mb-4" style="margin-top: 22px;">
  <div class="col-12">
    <div class="card border-0" style="background: #ffffff; border-radius: 20px; border: 1px solid var(--ide-border) !important; box-shadow: 0 8px 24px rgba(4, 49, 104, 0.05); padding: 20px 26px;">
      <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 16px;">
        <div class="d-flex align-items-center" style="gap: 16px;">
          <div style="width: 52px; height: 52px; border-radius: 16px; background: linear-gradient(135deg, rgba(4, 49, 104, 0.1) 0%, rgba(238, 98, 107, 0.1) 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <i class="fa-solid fa-layer-group" style="color: var(--ide-navy); font-size: 24px;"></i>
          </div>
          <div>
            <div class="d-flex align-items-center" style="gap: 10px;">
              <h4 class="font-weight-bold text-dark mb-0" style="font-size: 19px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                Katalog Manajemen Microsite
              </h4>
              <span class="badge badge-primary px-2 py-1" style="background: var(--ide-navy); font-size: 11px; font-weight: 600; border-radius: 6px;">
                <?=count($Microsites)?> Microsite Terdaftar
              </span>
            </div>
            <p class="text-muted mb-0 mt-1" style="font-size: 13px;">
              Setiap microsite berdiri sendiri dengan pengaturan foto, judul, serta struktur Bab & Sub-Bab bersarang yang terisolasi.
            </p>
          </div>
        </div>

        <div>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalInputMicrosite" style="border-radius: 12px; font-weight: 700; padding: 10px 22px; font-size: 13px; background: var(--ide-navy); border: none; box-shadow: 0 4px 14px rgba(4, 49, 104, 0.3); transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-plus-circle"></i> Buat Microsite Baru
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Grid Cards Microsite -->
<div class="row">
  <?php if (!empty($Microsites) && count($Microsites) > 0): ?>
    <?php foreach ($Microsites as $m): 
      $hasBanner = !empty($m['BannerImg']);
      $hasLogo = !empty($m['LogoImg']);
      $bannerUrl = $hasBanner ? $m['BannerImg'] : '';
      $logoUrl = $hasLogo ? $m['LogoImg'] : '';
    ?>
      <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="microsite-card">
          <!-- Header Banner & Logo -->
          <div class="microsite-card-header">
            <div class="microsite-card-banner">
              <?php if ($hasBanner): ?>
                <img class="banner-thumb" src="<?=htmlspecialchars($bannerUrl, ENT_QUOTES, 'UTF-8')?>" alt="Banner">
              <?php endif; ?>
              <div class="microsite-card-banner-overlay"></div>
              <span class="microsite-card-badge">
                <i class="fa-solid fa-link mr-1"></i> /<?=$m['Slug']?>
              </span>
            </div>
            <?php if ($hasLogo): ?>
              <div class="microsite-card-logo-box">
                <img class="microsite-card-logo" src="<?=htmlspecialchars($logoUrl, ENT_QUOTES, 'UTF-8')?>" alt="Logo">
              </div>
            <?php endif; ?>
          </div>

          <!-- Card Content -->
          <div class="microsite-card-body" <?php if (!$hasLogo): ?>style="padding-top: 18px;"<?php endif; ?>>
            <h5 class="microsite-card-title"><?=htmlspecialchars($m['Judul'])?></h5>
            <p class="microsite-card-subtitle"><?=htmlspecialchars($m['Subjudul'] ?: 'Microsite Publik')?></p>

            <!-- Stat Chip -->
            <div class="microsite-stat-chip">
              <span><i class="fa-solid fa-folder-tree text-primary mr-1"></i> <b><?=$m['TotalBab']?></b> Bab Utama</span>
              <span><i class="fa-solid fa-file-shield text-success mr-1"></i> <b><?=$m['TotalDokumen']?></b> Link Dokumen</span>
            </div>

            <!-- Action Buttons -->
            <div class="microsite-actions">
              <a href="<?=base_url('Staf/KelolaMicrosite/'.$m['Id'])?>" class="btn-builder">
                <i class="fa-solid fa-sitemap"></i> Kelola Bab & Sub-Bab
              </a>
              
              <div class="d-flex align-items-center justify-content-between pt-2" style="gap: 6px; border-top: 1px solid #f1f5f9;">
                <a href="<?=base_url('IDE/Microsite/'.$m['Slug'])?>" target="_blank" class="btn btn-sm btn-outline-info btn-secondary-action flex-fill" title="Preview Tampilan Publik">
                  <i class="fa-solid fa-arrow-up-right-from-square"></i> Preview
                </a>
                <button type="button" class="btn btn-sm btn-outline-warning btn-secondary-action btnEditProfilMicrosite flex-fill"
                        data-id="<?=$m['Id']?>"
                        data-slug="<?=htmlspecialchars($m['Slug'])?>"
                        data-judul="<?=htmlspecialchars($m['Judul'])?>"
                        data-subjudul="<?=htmlspecialchars($m['Subjudul'] ?? '')?>"
                        data-banner="<?=htmlspecialchars($m['BannerImg'] ?? '')?>"
                        data-logo="<?=htmlspecialchars($m['LogoImg'] ?? '')?>"
                        data-footer="<?=htmlspecialchars($m['FooterText'] ?? '')?>">
                  <i class="fa-solid fa-gear"></i> Pengaturan
                </button>
                <button type="button" class="btn btn-sm btn-outline-danger btn-secondary-action btnHapusMicrosite"
                        data-id="<?=$m['Id']?>"
                        data-judul="<?=htmlspecialchars($m['Judul'])?>"
                        title="Hapus Microsite">
                  <i class="fa-solid fa-trash-can"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-12 text-center py-5">
      <p class="text-muted font-weight-bold">Belum ada microsite terdaftar. Klik tombol di atas untuk membuat microsite baru.</p>
    </div>
  <?php endif; ?>
</div>

<!-- =========================================================================
     MODAL BUAT MICROSITE BARU
     ========================================================================= -->
<div class="modal fade" id="ModalInputMicrosite" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 580px;">
    <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.2); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, var(--ide-navy) 0%, #0a3d7c 100%); color: #ffffff; padding: 18px 26px; border: none;">
        <h5 class="modal-title" style="font-weight: 800; font-size: 16px; letter-spacing: 0.5px; text-transform: uppercase;">
          <i class="fa-solid fa-plus-circle mr-2"></i> Buat Microsite Baru
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formInputMicrosite" enctype="multipart/form-data">
        <div class="modal-body" style="padding: 24px;">
          <!-- Judul Microsite -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Judul Microsite <span class="text-danger">*</span></label>
            <input type="text" name="Judul" id="input_judul" class="form-control" placeholder="Contoh: IPPD SITUBONDO atau KAJIAN BANYUWANGI" required style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 14px;">
          </div>

          <!-- Slug URL -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Slug URL (Otomatis)</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" style="font-size: 12px; font-weight: 600; background: #f1f5f9;"><?=base_url('IDE/Microsite/')?></span>
              </div>
              <input type="text" name="Slug" class="form-control" placeholder="ippd-situbondo" style="border-radius: 0 10px 10px 0; border: 1.5px solid #cbd5e1; font-weight: 600;">
            </div>
            <small class="text-muted">Jika dikosongkan, slug dibuat otomatis dari Judul.</small>
          </div>

          <!-- Subjudul -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Subjudul / Deskripsi Singkat</label>
            <input type="text" name="Subjudul" class="form-control" placeholder="Contoh: Microsite Dokumen IPPD Kabupaten Situbondo" style="border-radius: 10px; border: 1.5px solid #cbd5e1; padding: 10px 14px;">
          </div>

          <!-- Foto Banner -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Foto Banner Header Utama (Unggah Berkas atau URL)</label>
            <input type="file" name="BannerFile" class="form-control-file mb-2" accept="image/*">
            <input type="url" name="BannerImg" class="form-control" placeholder="Atau tempel URL gambar banner (https://...)" style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-size: 12.5px;">
            <small class="text-muted d-block mt-1" style="font-size: 11.5px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> <b>Otomatis presisi:</b> Gambar ukuran besar/kecil otomatis disesuaikan penuh ke frame banner (Rekomendasi rasio landscape / ~1200x400 px).</small>
          </div>

          <!-- Foto Logo Badge -->
          <div class="form-group mb-0">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Foto Lambang / Badge Logo (Unggah Berkas atau URL)</label>
            <input type="file" name="LogoFile" class="form-control-file mb-2" accept="image/*">
            <input type="url" name="LogoImg" class="form-control" placeholder="Atau tempel URL gambar logo badge (https://...)" style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-size: 12.5px;">
            <small class="text-muted d-block mt-1" style="font-size: 11.5px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> <b>Otomatis presisi:</b> Logo otomatis di-scale pas di lingkaran. Gunakan PNG transparan tanpa kop surat/garis pinggir agar logo tampak besar & jelas.</small>
          </div>
        </div>
        <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 24px; gap: 10px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: 600;">Batal</button>
          <button type="submit" class="btn btn-primary" id="btnSimpanMicrosite" style="border-radius: 10px; font-weight: 700; background: var(--ide-navy); border: none; padding: 9px 24px;">
            <i class="fa-solid fa-floppy-disk mr-1"></i> Buat Microsite
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL EDIT PENGATURAN & FOTO MICROSITE
     ========================================================================= -->
<div class="modal fade" id="ModalEditMicrosite" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 580px;">
    <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.2); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff; padding: 18px 26px; border: none;">
        <h5 class="modal-title" style="font-weight: 800; font-size: 16px; letter-spacing: 0.5px; text-transform: uppercase;">
          <i class="fa-solid fa-gear mr-2"></i> Pengaturan & Foto Microsite
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formEditMicrosite" enctype="multipart/form-data">
        <input type="hidden" name="Id" id="edit_id">
        <div class="modal-body" style="padding: 24px;">
          <!-- Judul Microsite -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Judul Microsite <span class="text-danger">*</span></label>
            <input type="text" name="Judul" id="edit_judul" class="form-control" required style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 14px;">
          </div>

          <!-- Slug URL -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Slug URL <span class="text-danger">*</span></label>
            <input type="text" name="Slug" id="edit_slug" class="form-control" required style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 14px;">
          </div>

          <!-- Subjudul -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Subjudul / Deskripsi Singkat</label>
            <input type="text" name="Subjudul" id="edit_subjudul" class="form-control" style="border-radius: 10px; border: 1.5px solid #cbd5e1; padding: 10px 14px;">
          </div>

          <!-- Foto Banner -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Ganti Foto Banner Header (Unggah Berkas atau Ubah URL)</label>
            <input type="file" name="BannerFile" class="form-control-file mb-2" accept="image/*">
            <input type="text" name="BannerImg" id="edit_banner" class="form-control" placeholder="URL Gambar Banner" style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-size: 12.5px;">
            <small class="text-muted d-block mt-1" style="font-size: 11.5px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> <b>Otomatis presisi:</b> Gambar banner otomatis disesuaikan penuh (Rekomendasi rasio landscape / ~1200x400 px).</small>
          </div>

          <!-- Foto Logo Badge -->
          <div class="form-group mb-0">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Ganti Lambang / Badge Logo (Unggah Berkas atau Ubah URL)</label>
            <input type="file" name="LogoFile" class="form-control-file mb-2" accept="image/*">
            <input type="text" name="LogoImg" id="edit_logo" class="form-control" placeholder="URL Logo Badge" style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-size: 12.5px;">
            <small class="text-muted d-block mt-1" style="font-size: 11.5px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> <b>Otomatis presisi:</b> Logo otomatis di-scale pas di lingkaran. Gunakan PNG transparan tanpa kop surat/garis pinggir agar logo tampak besar & jelas.</small>
          </div>
        </div>
        <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 24px; gap: 10px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: 600;">Batal</button>
          <button type="submit" class="btn btn-warning text-white" id="btnPerbaruiMicrosite" style="border-radius: 10px; font-weight: 700; padding: 9px 24px;">
            <i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Pengaturan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL HAPUS MICROSITE
     ========================================================================= -->
<div class="modal fade" id="ModalHapusMicrosite" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 440px;">
    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.25); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, var(--ide-red) 0%, #ee626b 100%); color: #ffffff; padding: 18px 24px; border: none;">
        <h5 class="modal-title" style="font-weight: 800; font-size: 16px; letter-spacing: 0.5px; text-transform: uppercase;">
          <i class="fa-solid fa-triangle-exclamation mr-2"></i> Konfirmasi Hapus
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-4">
        <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 64px; height: 64px; background: rgba(180, 8, 20, 0.1); color: var(--ide-red);">
          <i class="fa-solid fa-trash-can" style="font-size: 28px;"></i>
        </div>
        <h5 class="font-weight-bold text-dark mb-1">Hapus Microsite Ini?</h5>
        <p class="text-muted mb-0" style="font-size: 13px;" id="textHapusMicrosite">
          Yakin ingin menghapus microsite ini beserta seluruh bab dan dokumen di dalamnya?
        </p>
      </div>
      <div class="modal-footer justify-content-center p-3" style="background-color: #f8fafc; border-top: 1px solid #f1f5f9; gap: 10px;">
        <button type="button" class="btn btn-secondary px-4 py-2" data-dismiss="modal" style="border-radius: 12px; font-weight: 600;">Batal</button>
        <button type="button" class="btn btn-danger px-4 py-2" id="btnKonfirmasiHapus" style="border-radius: 12px; font-weight: 700; background: var(--ide-red); border: none;">
          <i class="fa-solid fa-trash-can mr-1"></i> Ya, Hapus Microsite
        </button>
      </div>
    </div>
  </div>
</div>

        </div>
      </div>
    </div>

<script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
<script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
<script src="<?=base_url("build/js/custom.min.js")?>"></script>
<script>
  $(document).ready(function() {
    var BaseURL = '<?=base_url()?>';

    // Buka Modal Tambah Microsite
    $(document).on('click', '[data-target="#ModalInputMicrosite"], .btnTambahMicrosite', function(e) {
      e.preventDefault();
      $('#formInputMicrosite')[0].reset();
      $('#ModalInputMicrosite').modal('show');
    });

    // Form Input Microsite
    $('#formInputMicrosite').on('submit', function(e) {
      e.preventDefault();
      var btn = $('#btnSimpanMicrosite');
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan...');

      var formData = new FormData(this);

      $.ajax({
        url: BaseURL + 'Staf/InputMicrosite',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Buat Microsite');
          if (resp === '1') {
            $('#ModalInputMicrosite').modal('hide');
            alert('Microsite baru berhasil dibuat!');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Buat Microsite');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // Form Edit Profil Microsite
    $(document).on('click', '.btnEditProfilMicrosite', function(e) {
      e.preventDefault();
      $('#edit_id').val($(this).data('id'));
      $('#edit_slug').val($(this).data('slug'));
      $('#edit_judul').val($(this).data('judul'));
      $('#edit_subjudul').val($(this).data('subjudul'));
      $('#edit_banner').val($(this).data('banner'));
      $('#edit_logo').val($(this).data('logo'));

      $('#ModalEditMicrosite').modal('show');
    });

    $('#formEditMicrosite').on('submit', function(e) {
      e.preventDefault();
      var btn = $('#btnPerbaruiMicrosite');
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memperbarui...');

      var formData = new FormData(this);

      $.ajax({
        url: BaseURL + 'Staf/EditMicrosite',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Pengaturan');
          if (resp === '1') {
            $('#ModalEditMicrosite').modal('hide');
            alert('Pengaturan microsite berhasil diperbarui!');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Pengaturan');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // Hapus Microsite
    var hapusMicrositeId = null;
    $(document).on('click', '.btnHapusMicrosite', function(e) {
      e.preventDefault();
      hapusMicrositeId = $(this).data('id');
      var judul = $(this).data('judul');
      $('#textHapusMicrosite').html('Yakin ingin menghapus microsite <b>"' + judul + '"</b> beserta seluruh bab dan dokumen di dalamnya?');
      $('#ModalHapusMicrosite').modal('show');
    });

    $('#btnKonfirmasiHapus').on('click', function() {
      if (!hapusMicrositeId) return;
      var btn = $(this);
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menghapus...');

      $.ajax({
        url: BaseURL + 'Staf/HapusMicrosite',
        type: 'POST',
        data: { Id: hapusMicrositeId },
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-trash-can mr-1"></i> Ya, Hapus Microsite');
          if (resp === '1') {
            $('#ModalHapusMicrosite').modal('hide');
            alert('Microsite berhasil dihapus!');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-trash-can mr-1"></i> Ya, Hapus Microsite');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });
  });
</script>
</body>
</html>
