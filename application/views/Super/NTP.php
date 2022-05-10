          <div class="clearfix"></div>
            <div class="row">
              <div class="col-lg-12">
                <div class="row mt-1">
                    <div class="col-lg-3">
                      <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                          <label class="input-group-text bg-danger text-light"><b>Data Bulan</b></label>
                        </div>
                        <select class="custom-select" id="BulanNTP">                    
                          <?php $BulanNTP = array('01' => 'Januari','02' => 'Februari','03' => 'Maret','04' => 'April','05' => 'Mei','06' => 'Juni',
                                                  '07' => 'Juli','08' => 'Agustus','09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'); 
                          foreach ($BulanNTP as $key => $value) { ?>
                            <option value="<?=$key?>" <?=$this->session->userdata('BulanNTP')==$key?'selected':'';?>><?=$value?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="btn btn-sm btn-danger border-light" id="TampilkanData"><b>Tampilkan</b></div>
                    </div>
                  </div>
                <div class="row mt-1">
                  <div class="col-lg-3 mb-1 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/Pangan.png')?>" alt="Pangan" height="200" ></a>
                      </div>
                    <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="NTP Tanaman Pangan  ".number_format($NTPTanamanPangan,2,",",".")?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 mb-1 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/Hortikultura.png')?>" alt="Hortikultura" height="200" ></a>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="NTP Hortikultura ".number_format($NTPHortikultura,2,",",".")?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 mb-1 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/Perkebunan.png')?>" alt="Perkebunan" height="200" ></a>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="NTP Perkebunan ".number_format($NTPPerkebunan,2,",",".")?></div></div>
                    </div>
                  </div>
                </div>
                <div class="row mt-1">
                  <div class="col-lg-3 mb-1 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/Peternakan.png')?>" alt="Peternakan" height="200" ></a>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="NTP Peternakan ".number_format($NTPPeternakan,2,",",".")?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 mb-1 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/Perikanan.png')?>" alt="Perikanan" height="200" ></a>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="NTP Perikanan ".number_format($NTPPerikanan,2,",",".")?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 mb-1 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/NTP.png')?>" alt="NTP" height="200" ></a>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Nilai Tukar Petani ".number_format($NTP,2,",",".")?></div></div>
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
        $("#TampilkanData").click(function() {
          var Data =  { BulanNTP: $("#BulanNTP").val() }
          $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
            if (Respon == '1') {
              window.location = BaseURL + "Super/NTP"
            }
            else {
              alert(Respon)
            }
          })                   
        })
      })
		</script>
  </body>
</html>