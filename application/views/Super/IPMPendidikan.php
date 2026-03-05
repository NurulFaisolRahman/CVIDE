<div class="clearfix"></div>
            
            <style>
              /* Custom CSS untuk konsistensi dengan modul lainnya */
              .filter-card { border-radius: 8px; border-left: 4px solid #007bff; }
              .data-card { transition: all 0.3s ease; border-radius: 12px; overflow: hidden; border: none; }
              .data-card:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.15) !important; }
              .img-hover { transition: transform 0.3s ease; }
              .data-card:hover .img-hover { transform: scale(1.05); }
              .label-filter { font-size: 0.75rem; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.2rem; }
              .card-title-custom { font-size: 0.85rem; font-weight: 700; color: #333; }
              .indeks-value { font-size: 1.1rem; font-weight: 700; letter-spacing: 0.5px; display: block; }
              .sub-text { font-size: 0.75rem; color: #666; }
            </style>

            <!-- Bagian Filter Data -->
            <div class="row mb-3">
              <div class="col-sm-12">
                <div class="card shadow-sm filter-card bg-light">
                  <div class="card-body py-2">
                    <h6 class="font-weight-bold text-primary mb-2" style="font-size: 0.9rem;"><i class="fa fa-filter mr-2"></i>Filter Dimensi Pendidikan</h6>
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
                        <a href="<?=base_url('/Rekap/RekapDimensiPendidikan.xlsx')?>" class="btn btn-danger btn-sm shadow-sm px-3 rounded-pill ml-2">
                          <b>Unduh Rekap</b>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bagian Kartu Data Indikator Pendidikan -->
            <div class="row justify-content-center">
              
              <!-- Rata-rata Lama Sekolah -->
              <div class="col-lg-4 col-md-6 col-sm-12 mb-3 text-center">
                <div class="card data-card shadow-sm h-100">
                  <div class="card-body p-3 d-flex align-items-center justify-content-center" style="background-color: #f0f7ff;">
                    <a><img class="my-1 img-fluid img-hover" src="<?=base_url('assets/img/RLS.png')?>" alt="RLS" style="max-height: 140px;"></a>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="card-title-custom text-uppercase mb-2">Rata-rata Lama Sekolah</h6>
                    <div class="d-flex justify-content-around align-items-center">
                      <div class="px-2">
                        <small class="sub-text d-block">Nilai RLS</small>
                        <span class="text-primary font-weight-bold" style="font-size: 1.1rem;"><?=$IPMPendidikan['RLS']?></span>
                      </div>
                      <div class="border-left pl-5">
                        <small class="sub-text d-block">Indeks RLS</small>
                        <span class="text-dark font-weight-bold" style="font-size: 1.1rem;"><?=$IPMPendidikan['IRLS']?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Harapan Lama Sekolah -->
              <div class="col-lg-4 col-md-6 col-sm-12 mb-3 text-center">
                <div class="card data-card shadow-sm h-100">
                  <div class="card-body p-3 d-flex align-items-center justify-content-center" style="background-color: #fff4f4;">
                    <a><img class="my-1 img-fluid img-hover" src="<?=base_url('assets/img/HLS.png')?>" alt="HLS" style="max-height: 140px;"></a>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="card-title-custom text-uppercase mb-2">Harapan Lama Sekolah</h6>
                    <div class="d-flex justify-content-around align-items-center">
                      <div class="px-2">
                        <small class="sub-text d-block">Nilai HLS</small>
                        <span class="text-danger font-weight-bold" style="font-size: 1.1rem;"><?=$IPMPendidikan['HLS']?></span>
                      </div>
                      <div class="border-left pl-5">
                        <small class="sub-text d-block">Indeks HLS</small>
                        <span class="text-dark font-weight-bold" style="font-size: 1.1rem;"><?=$IPMPendidikan['IHLS']?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Indeks Pendidikan -->
              <div class="col-lg-4 col-md-6 col-sm-12 mb-3 text-center">
                <div class="card data-card shadow-sm h-100">
                  <div class="card-body p-3 d-flex align-items-center justify-content-center" style="background-color: #f0fff4;">
                    <a><img class="my-1 img-fluid img-hover" src="<?=base_url('assets/img/IndeksPendidikan.png')?>" alt="Indeks" style="max-height: 140px;"></a>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="card-title-custom text-uppercase mb-1">Total Indeks Pendidikan</h6>
                    <div class="mt-2">
                      <span class="badge badge-success px-4 py-2 shadow-sm indeks-value">
                        <?=$IPMPendidikan['IPendidikan']?>
                      </span>
                    </div>
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
            alert('Data Pendidikan Desa Belum Tersedia')
          } else {
            // Animasi loading pada tombol
            var $btn = $(this);
            var originalText = $btn.html();
            $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...');

            var Data =  { KodeDesa: $("#Desa").val(),
                          KodeKecamatan: $("#Kecamatan").val(),
                          JenisData: $("#JenisData").val() }
            $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
              if (Respon == '1') {
                window.location = BaseURL + "Super/IPMPendidikan"
              }
              else {
                alert(Respon)
                $btn.html(originalText);
              }
            }).fail(function() {
              $btn.html(originalText);
            })                    
          }
        })
      })
    </script>
  </body>
</html>