<!-- Enterprise Dashboard CSS Styling -->
<style>
  /* Metric KPI Cards (Proportional & Equal Height) */
  .kpi-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 22px 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--ide-border);
    transition: all 0.3s ease;
    width: 100%;
    min-height: 110px;
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .kpi-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(4, 49, 104, 0.12);
    border-color: var(--ide-navy);
  }

  .kpi-icon-box {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
  }

  .kpi-icon-navy {
    background: rgba(4, 49, 104, 0.1);
    color: var(--ide-navy);
  }

  .kpi-icon-red {
    background: rgba(180, 8, 20, 0.1);
    color: var(--ide-red);
  }

  .kpi-icon-blue {
    background: rgba(10, 61, 124, 0.1);
    color: var(--ide-navy-light);
  }

  .kpi-icon-green {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
  }

  .kpi-label {
    font-size: 12px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
  }

  .kpi-value {
    font-size: 19px;
    font-weight: 800;
    color: var(--ide-dark);
    line-height: 1.2;
    margin: 0;
  }

  .kpi-subtext {
    font-size: 11px;
    color: #94a3b8;
    margin-top: 3px;
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
    font-size: 17px;
    font-weight: 700;
    color: var(--ide-dark);
    margin-bottom: 6px;
  }

  .shortcut-desc {
    font-size: 13px;
    color: #64748b;
    margin: 0;
    line-height: 1.5;
  }

  /* Password Card Styling */
  .password-card {
    background: #ffffff;
    border-radius: 24px;
    border: 1px solid var(--ide-border);
    box-shadow: 0 15px 35px rgba(0,0,0,0.06);
    overflow: hidden;
  }

  .password-card-header {
    background: linear-gradient(135deg, var(--ide-navy) 0%, var(--ide-navy-light) 100%);
    color: #ffffff;
    padding: 22px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .password-card-header h5 {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .password-card-body {
    padding: 35px 30px;
  }

  .form-label-enterprise {
    font-size: 13px;
    font-weight: 700;
    color: var(--ide-dark);
    text-transform: uppercase;
    letter-spacing: 0.4px;
    margin-bottom: 10px;
    display: block;
  }

  .password-input-group {
    position: relative;
    display: flex;
    align-items: center;
  }

  .password-input-icon {
    position: absolute;
    left: 18px;
    color: #94a3b8;
    font-size: 16px;
    z-index: 5;
  }

  .form-control-enterprise {
    width: 100%;
    height: 52px;
    border-radius: 26px;
    border: 2px solid var(--ide-border);
    padding: 0 50px 0 48px;
    font-size: 14px;
    font-family: inherit;
    outline: none;
    transition: all 0.3s ease;
    background-color: #f8fafc;
  }

  .form-control-enterprise:focus {
    border-color: var(--ide-navy);
    background-color: #ffffff;
    box-shadow: 0 0 0 4px rgba(4, 49, 104, 0.1);
  }

  .password-toggle-btn {
    position: absolute;
    right: 15px;
    background: none;
    border: none;
    color: #94a3b8;
    font-size: 16px;
    cursor: pointer;
    padding: 8px;
    transition: color 0.2s ease;
  }

  .password-toggle-btn:hover {
    color: var(--ide-navy);
  }

  .btn-submit-enterprise {
    background-color: var(--ide-red);
    color: #ffffff;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    padding: 13px 35px;
    border-radius: 26px;
    border: none;
    cursor: pointer;
    box-shadow: 0 10px 25px rgba(180, 8, 20, 0.35);
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  .btn-submit-enterprise:hover {
    background-color: #d10916;
    transform: translateY(-2px);
    box-shadow: 0 15px 30px rgba(180, 8, 20, 0.5);
  }
</style>

<!-- Enterprise Metric / KPI Section -->
<div class="row mb-4 align-items-stretch" style="margin-top: 15px;">
  <div class="col-xl-3 col-md-6 mb-3 d-flex">
    <div class="kpi-card">
      <div class="kpi-icon-box kpi-icon-navy">
        <i class="fa-solid fa-user-shield"></i>
      </div>
      <div>
        <div class="kpi-label">Level Akses</div>
        <div class="kpi-value">Level 2 (Admin)</div>
        <div class="kpi-subtext">Hak akses penuh modul keuangan</div>
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
        <div class="kpi-subtext">Session ID & CSRF Aktif</div>
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
    <a href="<?=base_url('Admin/PendapatanKas')?>" class="shortcut-card">
      <div class="shortcut-icon-box shortcut-icon-blue">
        <i class="fa-solid fa-wallet"></i>
      </div>
      <div>
        <div class="shortcut-title">Kas In (Pendapatan)</div>
        <div class="shortcut-desc">Kelola pemasukan kas umum perusahaan dan penerimaan dana secara real-time.</div>
      </div>
    </a>
  </div>
  <div class="col-md-4 mb-3 d-flex">
    <a href="<?=base_url('Admin/PengeluaranKegiatan')?>" class="shortcut-card">
      <div class="shortcut-icon-box shortcut-icon-red">
        <i class="fa-solid fa-receipt"></i>
      </div>
      <div>
        <div class="shortcut-title">Pengeluaran Kegiatan</div>
        <div class="shortcut-desc">Pencatatan rincian biaya proyek riset & operasional lapangan kegiatan.</div>
      </div>
    </a>
  </div>
  <div class="col-md-4 mb-3 d-flex">
    <a href="<?=base_url('Admin/JurnalTotal')?>" class="shortcut-card">
      <div class="shortcut-icon-box shortcut-icon-green">
        <i class="fa-solid fa-book-bookmark"></i>
      </div>
      <div>
        <div class="shortcut-title">Laporan Jurnal Total</div>
        <div class="shortcut-desc">Lihat rekapitulasi jurnal neraca saldo akhir kas & pengeluaran perusahaan.</div>
      </div>
    </a>
  </div>
</div>

<!-- Password Change Card Section -->
<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="password-card">
      <div class="password-card-header">
        <h5><i class="fa-solid fa-key"></i> Keamanan Akun — Ubah Kata Sandi</h5>
        <span class="badge badge-light px-3 py-2" style="border-radius: 12px; font-weight: 600;">Sesi Aktif</span>
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
        $.post(BaseURL + "Admin/GantiPassword", Password).done(function(Respon) {
          if (Respon == '1') {
            alert('Password Berhasil Di Ganti!');
            window.location = BaseURL + "Admin";
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