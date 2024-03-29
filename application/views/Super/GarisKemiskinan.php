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
                    <a href="<?=base_url('/Rekap/RekapKemiskinan.xlsx')?>" class="btn btn-sm btn-danger border-light"><b>Unduh Rekap</b></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/GKM.png')?>" alt="GKM" width="65%"></a>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Garis Kemiskinan <br>Makanan Rp ".number_format($GKMRata2,0,",",".")?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/GKNM.png')?>" alt="GKNM" width="65%"></a>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Garis Kemiskinan <br>Non Makanan Rp ".number_format($GKNMRata2,0,",",".")?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/GK.png')?>" alt="GK" width="65%"></a>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Garis Kemiskinan <br>Rp ".number_format($GKRata2,0,",",".")?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="Miskin" style="margin-bottom: 5px;"></div>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Penduduk Miskin ".number_format($KelompokGK[1]/($KelompokGK[0]+$KelompokGK[1])*100,2,",",".")."%"?></div></div>
                    </div>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/PerKapita.png')?>" alt="P1" width="65%"></a>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Indeks Kedalaman<br>Kemiskinan (P1) = ".number_format($P1,2,",",".")?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/PerKapitaKonstan.png')?>" alt="P2" width="65%"></a>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Indeks Keparahan<br>Kemiskinan (P2) = ".number_format($P2,2,",",".")?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-primary border border-light p-0">
                        <a><img class="my-2" src="<?=base_url('assets/img/GiniRasio.png')?>" alt="GiniRasio" width="65%"></a>
                      </div>
                      <div class="card-footer bg-danger border border-light py-2"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Gini Rasio = ".$GiniRasio?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="MiskinEkstrim" style="margin-bottom: 5px;"></div>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Kemiskinan Ekstrim ".number_format($P3,2,",",".")."%"?></div></div>
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
            alert('Data Garis Kemiskinan Desa Belum Tersedia')
          } else {
            var Data =  { KodeDesa: $("#Desa").val(),
                          KodeKecamatan: $("#Kecamatan").val(),
                          JenisData: $("#JenisData").val() }
            $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
              if (Respon == '1') {
                window.location = BaseURL + "Super/GarisKemiskinan"
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
          var options = {
            pieHole: 0.2,
            sliceVisibilityThreshold : 0,
            chartArea : {left:45,top:18,width: 170, height: 170},
            legend: {position: 'none'},
            backgroundColor: { fill:'transparent' }
          };
          var data = google.visualization.arrayToDataTable([
            ['Kemiskinan', 'Jumlah'],
            ['Di Atas GK',<?=number_format($KelompokGK[0],2)?>],
            ['Di Bawah GK',<?=number_format($KelompokGK[1],2)?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('Miskin'));
          chart.draw(data, options);
          var data = google.visualization.arrayToDataTable([
            ['Kemiskinan Ekstrim', 'Jumlah'],
            ['Diatas Kemiskinan Ekstrim',<?=100-$P3?>],
            ['Dibawah Kemiskinan Ekstrim',<?=$P3?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('MiskinEkstrim'));
          chart.draw(data, options);
        }
      })
		</script>
  </body>
</html>