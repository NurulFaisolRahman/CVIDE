          <div class="clearfix"></div>
            <div class="row">
              <div class="col-sm-12">
                <div class="row mt-2">
                  <div class="col-lg-3">
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Kabupaten</b></label>
                      </div>
                      <select class="custom-select" id="Kabupaten">  
                        <?php foreach ($Kabupaten as $key) { ?>
                          <option value="<?=$key['Kode']?>" <?=$KodeKabupaten==$key['Kode']?'selected':'';?>><?=ucfirst(strtolower(substr($key['Nama'],5)))?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Kecamatan</b></label>
                      </div>
                      <select class="custom-select" id="Kecamatan">  
                        <?php foreach ($Kecamatan as $key) { ?>
                          <option value="<?=$key['Kode']?>" <?=$KodeKecamatan==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-danger text-light"><b>Desa</b></label>
                      </div>
                      <select class="custom-select" id="Desa">                    
                        <?php foreach ($Desa as $key) { ?>
                          <option value="<?=$key['Kode']?>" <?=$KodeDesa==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                        <?php } ?>                  
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="input-group input-group-sm mb-2">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-light"><b>Data</b></label>
                      </div>
                      <select class="custom-select" id="JenisData">                    
                        <option value="Kabupaten" <?=$this->session->userdata('JenisData')=='Kabupaten'?'selected':'';?>>Kabupaten</option>
                        <option value="Kecamatan" <?=$this->session->userdata('JenisData')=='Kecamatan'?'selected':'';?>>Kecamatan</option>
                        <option value="Desa" <?=$this->session->userdata('JenisData')=='Desa'?'selected':'';?>>Desa</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="btn btn-sm btn-primary border-light" id="TampilkanData"><b>Tampilkan</b></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="AngkatanKerja" style="margin-bottom: 24px;"></div>
                      </div>
                    <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Total Angkatan Kerja <br>".$AngkatanKerja." Responden"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/Profil.jpg')?>" alt="GK" width="81%"></a>
                      </div>
                    <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Persentase Tingkat Pengangguran <br> Sebesar ".number_format($Pengangguran,2)." %"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/Profil.jpg')?>" alt="GK" width="81%"></a>
                      </div>
                    <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Tingkat Partisipasi Angkatan <br> Kerja Sebesar ".number_format($PartisipasiAngkatanKerja,2)." %"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/Profil.jpg')?>" alt="GK" width="81%"></a>
                      </div>
                    <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Tingkat Pengangguran Terbuka <br> Kerja Sebesar ".number_format($TPT,2)." %"?></div></div>
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
          var Data =  { KodeDesa: $("#Desa").val(),
                        KodeKecamatan: $("#Kecamatan").val(),
                        JenisData: $("#JenisData").val() }
          $.post(BaseURL+"SuperAdmin/Session", Data).done(function(Respon) {
            if (Respon == '1') {
              window.location = BaseURL + "SuperAdmin/Pengangguran"
            }
            else {
              alert(Respon)
            }
          })                    
        })
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Angkatan Kerja', 'Jumlah'],
            ['Bekerja',<?=$Bekerja?>],
            ['Tidak Bekerja',<?=$TidakBekerja?>],
          ]);

          var options = {
            pieHole: 0.4,
            sliceVisibilityThreshold : 0,
            chartArea : {left:5,top:20,width: 250, height: 250},
            legend: {position: 'none'},
            backgroundColor: { fill:'transparent' },
          };

          var chart = new google.visualization.PieChart(document.getElementById('AngkatanKerja'));
          chart.draw(data, options);
        }
      })
		</script>
  </body>
</html>