<div class="clearfix"></div>
          
          <!-- Tambahan sedikit custom CSS untuk efek hover & gambar agar tidak gepeng -->
          <style>
            .card-hover {
              transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .card-hover:hover {
              transform: translateY(-5px);
              box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
            }
            .img-container {
              height: 100px; /* Diperkecil dari 180px agar lebih padat */
              display: flex; 
              align-items: center; 
              justify-content: center;
              padding: 5px; /* Margin gambar dikurangi */
            }
            .img-container img {
              max-height: 100%;
              max-width: 100%;
              object-fit: contain;
            }
            .filter-panel {
              background-color: #f8f9fa;
              border-radius: 8px;
            }
          </style>

            <div class="row">
            <?php $Tahun = $this->session->userdata('TahunNTP'); ?>
              <div class="col-lg-12">
                
                <!-- Panel Filter (Padding dan Margin bawah dikurangi) -->
                <div class="filter-panel p-2 mb-2 shadow-sm border">
                  <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6 mb-1 mb-lg-0">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <label class="input-group-text bg-danger text-light border-danger"><b>Bulan</b></label>
                        </div>
                        <select class="custom-select border-danger" id="BulanNTP">                    
                          <?php $BulanNTP = array('01' => 'Januari','02' => 'Februari','03' => 'Maret','04' => 'April','05' => 'Mei','06' => 'Juni',
                                                  '07' => 'Juli','08' => 'Agustus','09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'); 
                          foreach ($BulanNTP as $key => $value) { ?>
                            <option value="<?=$key?>" <?=$this->session->userdata('BulanNTP')==$key?'selected':'';?>><?=$value?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-1 mb-lg-0">
                      <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                          <label class="input-group-text bg-danger text-light border-danger"><b>Tahun</b></label>
                        </div>
                        <select class="custom-select border-danger" id="TahunNTP">                    
                            <option value="2022" <?=$Tahun==2022?'selected':'';?>>2022</option>
                            <option value="2023" <?=$Tahun==2023?'selected':'';?>>2023</option>
                            <option value="2024" <?=$Tahun==2024?'selected':'';?>>2024</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-12 mt-1 mt-lg-0">
                      <button class="btn btn-sm btn-danger shadow-sm btn-block py-1" id="TampilkanData">
                        <i class="fa fa-search mr-1"></i> <b>Tampilkan Data</b>
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Baris Data Card (Margin mb-4 diubah menjadi mb-2) -->
                <div class="row">
                  
                  <!-- Card Tanaman Pangan -->
                  <div class="col-md-4 mb-2">
                    <div class="card h-100 shadow-sm border-0 card-hover">
                      <div class="card-body p-0">
                        <div class="img-container bg-light rounded-top">
                          <img src="<?=base_url('assets/img/Pangan.png')?>" alt="Pangan">
                        </div>
                        <h6 class="text-center font-weight-bold text-dark mt-2 mb-1">Tanaman Pangan</h6>
                      </div>
                      <div class="card-footer bg-white border-top-0 pt-1 pb-2">
                        <div class="d-flex justify-content-center mb-1">
                          <span class="badge badge-info mr-2 px-2 py-1" style="font-size: 12px;">IT: <?=number_format($ITTanamanPangan,2,",",".")?></span>
                          <span class="badge badge-warning px-2 py-1 text-white" style="font-size: 12px;">IB: <?=number_format($IBTanamanPangan,2,",",".")?></span>
                        </div>
                        <div class="alert alert-danger m-0 py-1 text-center font-weight-bold" style="font-size: 13px;">
                          NTP: <?=number_format($NTPTanamanPangan,2,",",".")?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Card Hortikultura -->
                  <div class="col-md-4 mb-2">
                    <div class="card h-100 shadow-sm border-0 card-hover">
                      <div class="card-body p-0">
                        <div class="img-container bg-light rounded-top">
                          <img src="<?=base_url('assets/img/Hortikultura.png')?>" alt="Hortikultura">
                        </div>
                        <h6 class="text-center font-weight-bold text-dark mt-2 mb-1">Hortikultura</h6>
                      </div>
                      <div class="card-footer bg-white border-top-0 pt-1 pb-2">
                        <div class="d-flex justify-content-center mb-1">
                          <span class="badge badge-info mr-2 px-2 py-1" style="font-size: 12px;">IT: <?=number_format($ITHortikultura,2,",",".")?></span>
                          <span class="badge badge-warning px-2 py-1 text-white" style="font-size: 12px;">IB: <?=number_format($IBHortikultura,2,",",".")?></span>
                        </div>
                        <div class="alert alert-danger m-0 py-1 text-center font-weight-bold" style="font-size: 13px;">
                          NTP: <?=number_format($NTPHortikultura,2,",",".")?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Card Perkebunan -->
                  <div class="col-md-4 mb-2">
                    <div class="card h-100 shadow-sm border-0 card-hover">
                      <div class="card-body p-0">
                        <div class="img-container bg-light rounded-top">
                          <img src="<?=base_url('assets/img/Perkebunan.png')?>" alt="Perkebunan">
                        </div>
                        <h6 class="text-center font-weight-bold text-dark mt-2 mb-1">Perkebunan Rakyat</h6>
                      </div>
                      <div class="card-footer bg-white border-top-0 pt-1 pb-2">
                        <div class="d-flex justify-content-center mb-1">
                          <span class="badge badge-info mr-2 px-2 py-1" style="font-size: 12px;">IT: <?=number_format($ITPerkebunan,2,",",".")?></span>
                          <span class="badge badge-warning px-2 py-1 text-white" style="font-size: 12px;">IB: <?=number_format($IBPerkebunan,2,",",".")?></span>
                        </div>
                        <div class="alert alert-danger m-0 py-1 text-center font-weight-bold" style="font-size: 13px;">
                          NTP: <?=number_format($NTPPerkebunan,2,",",".")?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Card Peternakan -->
                  <div class="col-md-4 mb-2">
                    <div class="card h-100 shadow-sm border-0 card-hover">
                      <div class="card-body p-0">
                        <div class="img-container bg-light rounded-top">
                          <img src="<?=base_url('assets/img/Peternakan.png')?>" alt="Peternakan">
                        </div>
                        <h6 class="text-center font-weight-bold text-dark mt-2 mb-1">Peternakan</h6>
                      </div>
                      <div class="card-footer bg-white border-top-0 pt-1 pb-2">
                        <div class="d-flex justify-content-center mb-1">
                          <span class="badge badge-info mr-2 px-2 py-1" style="font-size: 12px;">IT: <?=number_format($ITPeternakan,2,",",".")?></span>
                          <span class="badge badge-warning px-2 py-1 text-white" style="font-size: 12px;">IB: <?=number_format($IBPeternakan,2,",",".")?></span>
                        </div>
                        <div class="alert alert-danger m-0 py-1 text-center font-weight-bold" style="font-size: 13px;">
                          NTP: <?=number_format($NTPPeternakan,2,",",".")?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Card Perikanan -->
                  <div class="col-md-4 mb-2">
                    <div class="card h-100 shadow-sm border-0 card-hover">
                      <div class="card-body p-0">
                        <div class="img-container bg-light rounded-top">
                          <img src="<?=base_url('assets/img/Perikanan.png')?>" alt="Perikanan">
                        </div>
                        <h6 class="text-center font-weight-bold text-dark mt-2 mb-1">Perikanan</h6>
                      </div>
                      <div class="card-footer bg-white border-top-0 pt-1 pb-2">
                        <div class="d-flex justify-content-center mb-1">
                          <span class="badge badge-info mr-2 px-2 py-1" style="font-size: 12px;">IT: <?=number_format($ITPerikanan,2,",",".")?></span>
                          <span class="badge badge-warning px-2 py-1 text-white" style="font-size: 12px;">IB: <?=number_format($IBPerikanan,2,",",".")?></span>
                        </div>
                        <div class="alert alert-danger m-0 py-1 text-center font-weight-bold" style="font-size: 13px;">
                          NTP: <?=number_format($NTPPerikanan,2,",",".")?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Card Total NTP -->
                  <div class="col-md-4 mb-2">
                    <div class="card h-100 shadow border-danger card-hover">
                      <div class="card-body p-0">
                        <div class="img-container bg-light rounded-top">
                          <img src="<?=base_url('assets/img/NTP.png')?>" alt="NTP">
                        </div>
                        <h6 class="text-center font-weight-bold text-dark mt-2 mb-1">Total Nilai Tukar Petani</h6>
                      </div>
                      <div class="card-footer bg-white border-top-0 pt-1 pb-2">
                        <div class="d-flex justify-content-center mb-1">
                          <span class="badge badge-primary mr-2 px-2 py-1" style="font-size: 12px;">Total IT: <?=number_format($ITNTP,2,",",".")?></span>
                          <span class="badge badge-warning px-2 py-1 text-white" style="font-size: 12px;">Total IB: <?=number_format($IBNTP,2,",",".")?></span>
                        </div>
                        <div class="alert alert-success m-0 py-1 text-center font-weight-bold" style="font-size: 14px;">
                          NTP Gabungan: <?=number_format($NTP,2,",",".")?>
                        </div>
                      </div>
                    </div>
                  </div>

                </div> <!-- End Row Card -->
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

    <script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
   	<script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
    <script src="<?=base_url("build/js/custom.min.js")?>"></script>
		<script>
			$(document).ready(function(){
        var BaseURL = '<?=base_url()?>' 
        $("#TampilkanData").click(function() {
          // Menambahkan sedikit efek loading visual pada tombol jika diinginkan (opsional)
          var btn = $(this);
          var originalText = btn.html();
          btn.html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
          
          var Data =  { BulanNTP: $("#BulanNTP").val(), TahunNTP: $("#TahunNTP").val() }
          $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
            if (Respon == '1') {
              window.location = BaseURL + "Super/NTP"
            }
            else {
              alert(Respon)
              btn.html(originalText); // Kembalikan teks tombol jika gagal
            }
          })                   
        })
      })
		</script>
  </body>
</html>