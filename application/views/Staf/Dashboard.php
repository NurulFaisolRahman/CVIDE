<!-- Enterprise Dashboard CSS Styling -->
<style>
  /* Metric KPI Cards (Proportional & Equal Height) */
  .kpi-card {
    background: #ffffff !important;
    border-radius: 20px !important;
    padding: 22px 20px !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
    border: 1px solid var(--ide-border) !important;
    transition: all 0.3s ease !important;
    width: 100% !important;
    min-height: 110px !important;
    display: flex !important;
    align-items: center !important;
    gap: 16px !important;
    position: relative !important;
  }

  .kpi-card:hover {
    transform: translateY(-5px) !important;
    box-shadow: 0 15px 35px rgba(4, 49, 104, 0.12) !important;
    border-color: var(--ide-navy) !important;
  }

  .kpi-icon-box {
    width: 52px !important;
    height: 52px !important;
    border-radius: 14px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 22px !important;
    flex-shrink: 0 !important;
    position: static !important;
  }

  .kpi-icon-box i {
    position: static !important;
    float: none !important;
    margin: 0 !important;
    padding: 0 !important;
    line-height: 1 !important;
  }

  .kpi-icon-navy {
    background: rgba(4, 49, 104, 0.1) !important;
    color: var(--ide-navy) !important;
  }

  .kpi-icon-red {
    background: rgba(180, 8, 20, 0.1) !important;
    color: var(--ide-red) !important;
  }

  .kpi-icon-blue {
    background: rgba(10, 61, 124, 0.1) !important;
    color: var(--ide-navy-light) !important;
  }

  .kpi-icon-green {
    background: rgba(16, 185, 129, 0.1) !important;
    color: #10b981 !important;
  }

  .kpi-label {
    font-size: 12px !important;
    font-weight: 700 !important;
    color: #64748b !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    margin-bottom: 4px !important;
  }

  .kpi-value {
    font-size: 19px !important;
    font-weight: 800 !important;
    color: var(--ide-dark) !important;
    line-height: 1.2 !important;
    margin: 0 !important;
  }

  .kpi-subtext {
    font-size: 11px !important;
    color: #94a3b8 !important;
    margin-top: 3px !important;
  }

  /* Shortcut Quick Action Cards (Equal Size & Proportional Height) */
  .shortcut-card {
    background: #ffffff !important;
    border-radius: 20px !important;
    padding: 24px !important;
    border: 1px solid var(--ide-border) !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04) !important;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: flex-start !important;
    width: 100% !important;
    min-height: 160px !important;
    color: inherit !important;
    position: relative !important;
    overflow: hidden !important;
  }

  .shortcut-card:hover {
    transform: translateY(-5px) !important;
    border-color: var(--ide-red-coral) !important;
    box-shadow: 0 18px 40px rgba(180, 8, 20, 0.12) !important;
    text-decoration: none !important;
  }

  .shortcut-icon-box {
    width: 52px !important;
    height: 52px !important;
    border-radius: 14px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 22px !important;
    margin-bottom: 16px !important;
    flex-shrink: 0 !important;
    position: static !important;
    transition: all 0.3s ease !important;
  }

  .shortcut-icon-box i {
    position: static !important;
    float: none !important;
    margin: 0 !important;
    padding: 0 !important;
    line-height: 1 !important;
    display: inline-block !important;
  }

  .shortcut-icon-blue {
    background: rgba(4, 49, 104, 0.1) !important;
    color: var(--ide-navy) !important;
  }

  .shortcut-icon-red {
    background: rgba(180, 8, 20, 0.1) !important;
    color: var(--ide-red) !important;
  }

  .shortcut-icon-green {
    background: rgba(16, 185, 129, 0.1) !important;
    color: #10b981 !important;
  }

  .shortcut-card:hover .shortcut-icon-box {
    transform: scale(1.1) !important;
  }

  .shortcut-title {
    font-size: 16px !important;
    font-weight: 700 !important;
    color: var(--ide-dark) !important;
    margin-bottom: 6px !important;
  }

  .shortcut-desc {
    font-size: 13px !important;
    color: #64748b !important;
    margin: 0 !important;
    line-height: 1.5 !important;
  }

  /* Password Card Styling */
  .password-card {
    background: #ffffff !important;
    border-radius: 24px !important;
    border: 1px solid var(--ide-border) !important;
    box-shadow: 0 15px 35px rgba(0,0,0,0.06) !important;
    overflow: hidden !important;
  }

  .password-card-header {
    background: linear-gradient(135deg, var(--ide-navy) 0%, var(--ide-navy-light) 100%) !important;
    color: #ffffff !important;
    padding: 22px 30px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
  }

  .password-card-header h5 {
    font-size: 18px !important;
    font-weight: 700 !important;
    margin: 0 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    color: #ffffff !important;
  }

  .password-card-body {
    padding: 35px 30px !important;
  }

  .form-label-enterprise {
    font-size: 13px !important;
    font-weight: 700 !important;
    color: var(--ide-dark) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.4px !important;
    margin-bottom: 10px !important;
    display: block !important;
  }

  .password-input-group {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
  }

  .password-input-icon {
    position: absolute !important;
    left: 18px !important;
    color: #94a3b8 !important;
    font-size: 16px !important;
    z-index: 5 !important;
    float: none !important;
    margin: 0 !important;
  }

  .form-control-enterprise {
    width: 100% !important;
    height: 52px !important;
    border-radius: 26px !important;
    border: 2px solid var(--ide-border) !important;
    padding: 0 50px 0 48px !important;
    font-size: 14px !important;
    font-family: inherit !important;
    outline: none !important;
    transition: all 0.3s ease !important;
    background-color: #f8fafc !important;
  }

  .form-control-enterprise:focus {
    border-color: var(--ide-navy) !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 4px rgba(4, 49, 104, 0.1) !important;
  }

  .password-toggle-btn {
    position: absolute !important;
    right: 15px !important;
    background: none !important;
    border: none !important;
    color: #94a3b8 !important;
    font-size: 16px !important;
    cursor: pointer !important;
    padding: 8px !important;
    transition: color 0.2s ease !important;
  }

  .password-toggle-btn:hover {
    color: var(--ide-navy) !important;
  }

  .btn-submit-enterprise {
    background-color: var(--ide-red) !important;
    color: #ffffff !important;
    font-size: 15px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    padding: 13px 35px !important;
    border-radius: 26px !important;
    border: none !important;
    cursor: pointer !important;
    box-shadow: 0 10px 25px rgba(180, 8, 20, 0.35) !important;
    transition: all 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 10px !important;
  }

  .btn-submit-enterprise:hover {
    background-color: #d10916 !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 15px 30px rgba(180, 8, 20, 0.5) !important;
  }
</style>

<!-- Enterprise Metric / KPI Section -->
<?php
$dashUserLevel = (int)($this->session->userdata('level') ?? 3);
$dashIsRole4 = ($dashUserLevel === 4);
?>
<div class="row mb-4 align-items-stretch" style="margin-top: 15px;">
  <div class="col-xl-3 col-md-6 mb-3 d-flex">
    <div class="kpi-card">
      <div class="kpi-icon-box kpi-icon-navy">
        <i class="fa-solid fa-user-gear"></i>
      </div>
      <div>
        <div class="kpi-label">Level Akses</div>
        <div class="kpi-value"><?=$dashIsRole4 ? 'Level 4 (Asisten)' : 'Level 3 (Staf)'?></div>
        <div class="kpi-subtext"><?=$dashIsRole4 ? 'Hak akses Tag kegiatan & Dokumen Project' : 'Hak akses modul operasional & project'?></div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-3 d-flex">
    <div class="kpi-card">
      <div class="kpi-icon-box kpi-icon-blue">
        <i class="fa-solid fa-server"></i>
      </div>
      <div>
        <div class="kpi-label">Status Sistem</div>
        <div class="kpi-value">Online</div>
        <div class="kpi-subtext">Terhubung & Tersinkronisasi</div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-3 d-flex">
    <div class="kpi-card">
      <div class="kpi-icon-box kpi-icon-green">
        <i class="fa-solid fa-shield-halved"></i>
      </div>
      <div>
        <div class="kpi-label">Keamanan Sesi</div>
        <div class="kpi-value">Terenkripsi</div>
        <div class="kpi-subtext">Session ID Aktif</div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-3 d-flex">
    <div class="kpi-card">
      <div class="kpi-icon-box kpi-icon-red">
        <i class="fa-solid fa-database"></i>
      </div>
      <div>
        <div class="kpi-label">Basis Data</div>
        <div class="kpi-value">Normal</div>
        <div class="kpi-subtext">Database IDE Consultant</div>
      </div>
    </div>
  </div>
</div>

<!-- Quick Action Shortcuts Hub -->
<h4 class="font-weight-bold text-dark mb-3" style="font-size: 18px; text-transform: uppercase; letter-spacing: 0.5px;">
  <i class="fa-solid fa-rocket mr-2" style="color: var(--ide-red);"></i> Pintasan Modul Utama
</h4>
<div class="row mb-5 align-items-stretch">
  <div class="col-md-4 mb-3 d-flex">
    <a href="<?=base_url('Staf/Project')?>" class="shortcut-card">
      <div class="shortcut-icon-box shortcut-icon-blue">
        <i class="fa-solid fa-diagram-project"></i>
      </div>
      <div>
        <div class="shortcut-title">Manajemen Project</div>
        <div class="shortcut-desc">Kelola berkas kegiatan, timeline project, kategori, tag/label, dan dokumen multi-format.</div>
      </div>
    </a>
  </div>
  <div class="col-md-4 mb-3 d-flex">
    <a href="<?=base_url('Staf/BankData')?>" class="shortcut-card">
      <div class="shortcut-icon-box" style="background: rgba(4, 49, 104, 0.1); color: var(--ide-navy);">
        <i class="fa-solid fa-database"></i>
      </div>
      <div>
        <div class="shortcut-title">Bank Data</div>
        <div class="shortcut-desc">Kumpulan dokumen master, template, regulasi, dataset acuan, dan berkas arsip pendukung.</div>
      </div>
    </a>
  </div>
  <div class="col-md-4 mb-3 d-flex">
    <a href="#cardUbahPassword" class="shortcut-card">
      <div class="shortcut-icon-box shortcut-icon-red">
        <i class="fa-solid fa-key"></i>
      </div>
      <div>
        <div class="shortcut-title">Ubah Password</div>
        <div class="shortcut-desc">Perbarui kata sandi akun Staf Anda secara berkala demi menjaga keamanan akses sistem.</div>
      </div>
    </a>
  </div>
</div>

<!-- Password Change Card Section -->
<div class="row justify-content-center" id="cardUbahPassword">
  <div class="col-lg-8">
    <div class="password-card">
      <div class="password-card-header">
        <h5><i class="fa-solid fa-key"></i> Keamanan Akun — Ubah Kata Sandi</h5>
        <span class="badge badge-light px-3 py-2" style="border-radius: 12px; font-weight: 600;">Sesi Staf Aktif</span>
      </div>
      <div class="password-card-body">
        <div class="form-group mb-4">
          <label for="Password" class="form-label-enterprise">Kata Sandi Baru / New Password</label>
          <div class="password-input-group">
            <i class="fa-solid fa-lock password-input-icon"></i>
            <input type="password" class="form-control-enterprise" id="Password" placeholder="Masukkan kata sandi baru (minimal 8 karakter)">
            <button class="password-toggle-btn password-toggle" type="button" title="Lihat Password">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
          <small class="form-text text-muted mt-2 ml-2">
            <i class="fa-solid fa-circle-info mr-1"></i> Disarankan kombinasi huruf kapital, angka, dan karakter unik.
          </small>
        </div>

        <div class="text-right">
          <button type="button" class="btn-submit-enterprise" id="GantiPassword">
            <i class="fa-solid fa-floppy-disk"></i> Simpan Kata Sandi Baru
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
<script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
<script src="<?=base_url("build/js/custom.min.js")?>"></script>
<script>
  $(document).ready(function(){
    var BaseURL = '<?=base_url()?>';

    // Toggle visibility password
    $('.password-toggle').click(function() {
      var passwordField = $('#Password');
      var icon = $(this).find('i');
      
      if (passwordField.attr('type') === 'password') {
        passwordField.attr('type', 'text');
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        passwordField.attr('type', 'password');
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });
    
    // Submit Ganti Password via AJAX
    $("#GantiPassword").click(function() {
      if ($("#Password").val() === "") {
        alert('Password Tidak Boleh Kosong');
      } else {
        var Password = { Password: $("#Password").val() };
        $.post(BaseURL + "Staf/GantiPassword", Password).done(function(Respon) {
          if (Respon == '1') {
            alert('Password Berhasil Di Ganti!');
            window.location = BaseURL + "Staf";
          } else {
            alert(Respon);
          }
        });
      }
    });
  });
</script>
</body>
</html>