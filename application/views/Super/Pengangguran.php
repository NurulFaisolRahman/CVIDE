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
                        <div id="Dewasa" style="margin-bottom: 24px;"></div>
                      </div>
                    <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Angkatan Kerja ".number_format($AngkatanKerja/($AngkatanKerja+$BukanAngkatanKerja)*100,2,",",".")."%<br>Bukan Angkatan Kerja ".number_format($BukanAngkatanKerja/($AngkatanKerja+$BukanAngkatanKerja)*100,2,",",".")."%"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="AngkatanKerja" style="margin-bottom: 24px;"></div>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Persentase Bekerja ".number_format($Bekerja/($Bekerja+$TidakBekerja)*100,2,",",".")."%<br>Persentase Tidak Bekerja ".number_format($TidakBekerja/($Bekerja+$TidakBekerja)*100,2,",",".")."%"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/TPT.jpg')?>" alt="GK" height="209" ></a>
                      </div>
                    <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Tingkat Pengangguran<br>Sebesar ".number_format($TPT,2,",",".")." %"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/TPAK.png')?>" alt="GK" width="209px"></a>
                      </div>
                    <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Tingkat Partisipasi Angkatan<br>Kerja Sebesar ".number_format($TPAK,2,",",".")." %"?></div></div>
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
          if ($("#JenisData").val() == 'Desa') {
            alert('Data Pengangguran Desa Belum Tersedia')
          } else {
            var Data =  { KodeDesa: $("#Desa").val(),
                          KodeKecamatan: $("#Kecamatan").val(),
                          JenisData: $("#JenisData").val() }
            $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
              if (Respon == '1') {
                window.location = BaseURL + "Super/Pengangguran"
              }
              else {
                alert(Respon)
              }
            })                    
          }
        })
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var dataDewasa = google.visualization.arrayToDataTable([
            ['Usia Bekerja', 'Jumlah'],
            ['Angkatan Kerja',<?=$AngkatanKerja?>],
            ['Bukan Angkatan Kerja',<?=$BukanAngkatanKerja?>],
          ]);

          var optionsDewasa = {
            pieHole: 0.4,
            sliceVisibilityThreshold : 0,
            chartArea : {left:5,top:20,width: 250, height: 250},
            legend: {position: 'none'},
            backgroundColor: { fill:'transparent' },
          };

          var chartDewasa = new google.visualization.PieChart(document.getElementById('Dewasa'));
          chartDewasa.draw(dataDewasa, optionsDewasa);
          var dataAngkatanKerja = google.visualization.arrayToDataTable([
            ['Angkatan Kerja', 'Jumlah'],
            ['Bekerja',<?=$Bekerja?>],
            ['Tidak Bekerja',<?=$TidakBekerja?>],
          ]);

          var optionsAngkatanKerja = {
            pieHole: 0.4,
            sliceVisibilityThreshold : 0,
            chartArea : {left:5,top:20,width: 250, height: 250},
            legend: {position: 'none'},
            backgroundColor: { fill:'transparent' },
          };

          var chartAngkatanKerja = new google.visualization.PieChart(document.getElementById('AngkatanKerja'));
          chartAngkatanKerja.draw(dataAngkatanKerja, optionsAngkatanKerja);
        }
      })
		</script>
  </body>
</html>