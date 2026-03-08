<div class="clearfix"></div>
            
            <style>
              /* Custom CSS untuk memperhalus tampilan */
              .filter-card { border-radius: 8px; border-left: 4px solid #007bff; }
              .data-card { transition: all 0.3s ease; border-radius: 12px; overflow: hidden; }
              .data-card:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.15) !important; }
              .img-hover { transition: transform 0.3s ease; }
              .data-card:hover .img-hover { transform: scale(1.05); }
              .label-filter { font-size: 0.75rem; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.2rem; }
              .aps-value { font-size: 1.15rem; font-weight: 700; letter-spacing: 0.5px; }
              .card-title-custom { font-size: 0.8rem; }
              .sub-text { font-size: 0.7rem; }
            </style>

            <!-- Bagian Filter Data -->
            <div class="row mb-3">
              <div class="col-sm-12">
                <div class="card shadow-sm border-0 filter-card bg-light">
                  <div class="card-body py-2">
                    <h6 class="font-weight-bold text-primary mb-2" style="font-size: 0.9rem;"><i class="fa fa-filter mr-2"></i>Filter Data Partisipasi Sekolah</h6>
                    <div class="row">
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Kabupaten</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="Kabupaten">  
                          <?php foreach ($Kabupaten as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeKabupaten==$key['Kode']?'selected':'';?>><?=ucfirst(strtolower(substr($key['Nama'],5)))?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Kecamatan</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="Kecamatan">  
                          <?php foreach ($Kecamatan as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeKecamatan==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Desa</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="Desa">                    
                          <?php foreach ($Desa as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeDesa==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Jenis Data</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="JenisData">                    
                          <option value="Kabupaten" <?=$this->session->userdata('JenisData')=='Kabupaten'?'selected':'';?>>Kabupaten</option>
                          <option value="Kecamatan" <?=$this->session->userdata('JenisData')=='Kecamatan'?'selected':'';?>>Kecamatan</option>
                          <option value="Desa" <?=$this->session->userdata('JenisData')=='Desa'?'selected':'';?>>Desa</option>
                        </select>
                      </div>
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div class="row mt-1">
                      <div class="col-12 text-right">
                        <button class="btn btn-primary btn-sm shadow-sm px-3 rounded-pill" id="TampilkanData">
                          <b>Tampilkan</b>
                        </button>
                        <a href="<?=base_url('/Rekap/RekapAngkaPartisipasiSekolah.xlsx')?>" class="btn btn-danger btn-sm shadow-sm px-3 rounded-pill ml-2">
                          <b>Unduh Rekap</b>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bagian Kartu Data APS -->
            <div class="row justify-content-center">
              <!-- Kartu SD -->
              <div class="col-lg-4 col-md-6 col-sm-12 mb-3 text-center">
                <div class="card data-card shadow-sm border-0 h-100">
                  <div class="card-body p-2 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                    <a><img class="my-1 img-fluid img-hover" src="<?=base_url('assets/img/SD.png')?>" alt="SD" style="max-height: 120px;"></a>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="text-muted font-weight-bold text-uppercase mb-1 card-title-custom">Usia 7 - 12 Tahun</h6>
                    <div class="mb-2 sub-text">Angka Partisipasi Sekolah</div>
                    <span class="badge badge-primary px-3 py-1 aps-value shadow-sm">
                      <?=number_format($APS[0],2,",",".")?>%
                    </span>
                  </div>
                </div>
              </div>

              <!-- Kartu SMP -->
              <div class="col-lg-4 col-md-6 col-sm-12 mb-3 text-center">
                <div class="card data-card shadow-sm border-0 h-100">
                  <div class="card-body p-2 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                    <a><img class="my-1 img-fluid img-hover" src="<?=base_url('assets/img/SMP.png')?>" alt="SMP" style="max-height: 120px;"></a>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="text-muted font-weight-bold text-uppercase mb-1 card-title-custom">Usia 13 - 15 Tahun</h6>
                    <div class="mb-2 sub-text">Angka Partisipasi Sekolah</div>
                    <span class="badge badge-success px-3 py-1 aps-value shadow-sm">
                      <?=number_format($APS[1],2,",",".")?>%
                    </span>
                  </div>
                </div>
              </div>

              <!-- Kartu SMA -->
              <div class="col-lg-4 col-md-6 col-sm-12 mb-3 text-center">
                <div class="card data-card shadow-sm border-0 h-100">
                  <div class="card-body p-2 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                    <a><img class="my-1 img-fluid img-hover" src="<?=base_url('assets/img/SMA.png')?>" alt="SMA" style="max-height: 120px;"></a>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="text-muted font-weight-bold text-uppercase mb-1 card-title-custom">Usia 16 - 18 Tahun</h6>
                    <div class="mb-2 sub-text">Angka Partisipasi Sekolah</div>
                    <span class="badge badge-info px-3 py-1 aps-value shadow-sm">
                      <?=number_format($APS[2],2,",",".")?>%
                    </span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

    <script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
    <script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="<?=base_url("build/js/custom.min.js")?>"></script>
    <script>
      $(document).ready(function(){
        var BaseURL = '<?=base_url()?>' 
        
        $("#Kecamatan").change(function (){
          var Desa = { Kode: $("#Kecamatan").val() }
          $.post(BaseURL+"IDE/ListDesa", Desa).done(function(Respon) { 
            $('#Desa').html(Respon)
          })    
        })

        $("#TampilkanData").click(function() {
          if ($("#JenisData").val() == 'Desa') {
            alert('Data Pengangguran Desa Belum Tersedia')
          } else {
            // Animasi loading pada tombol bisa ditambahkan disini
            var $btn = $(this);
            var originalText = $btn.html();
            $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...');

            var Data =  { KodeDesa: $("#Desa").val(),
                          KodeKecamatan: $("#Kecamatan").val(),
                          JenisData: $("#JenisData").val() }
            $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
              if (Respon == '1') {
                window.location = BaseURL + "Super/APS"
              }
              else {
                alert(Respon)
                $btn.html(originalText); // Kembalikan teks tombol jika gagal
              }
            }).fail(function() {
              $btn.html(originalText); // Kembalikan teks tombol jika error request
            })                    
          }
        })
      })
    </script>
  </body>
</html>