				<!-- page content -->
				<div class="right_col bg-success" role="main" style="overflow-x: hidden;">
					<!-- <div class=""> -->
            <div class="clearfix"></div>
							<div class="row">
								<div class="col-sm-12">
                  <div class="row my-2">
                    <div class="col-sm-3"> 
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
                    <div class="col-sm-3">
                      <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                          <label class="input-group-text bg-danger text-light"><b>Desa/Kelurahan</b></label>
                        </div>
                        <select class="custom-select" id="Desa">                    
                          <?php foreach ($Desa as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeDesa==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="btn btn-sm btn-primary" id="ViewData"><b>View Data</b></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-sm-12 text-center">
                      <div class="card">
                        <div class="card-body bg-primary border border-light p-0">
                          <a><img class="my-2" src="<?=base_url('assets/img/GKM.png')?>" alt="GKM" width="81%"></a>
                        </div>
                        <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Garis Kemiskinan <br>Makanan Rp ".number_format($GKMDesa,2,",",".")?></div></div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-12 text-center">
                      <div class="card">
                        <div class="card-body bg-primary border border-light p-0">
                          <a><img class="my-2" src="<?=base_url('assets/img/GKNM.png')?>" alt="GKNM" width="81%"></a>
                        </div>
                        <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Garis Kemiskinan <br>Non Makanan Rp ".number_format($GKNMDesa,2,",",".")?></div></div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-12 text-center">
                      <div class="card">
                        <div class="card-body bg-primary border border-light p-0">
                          <a><img class="my-2" src="<?=base_url('assets/img/GK.png')?>" alt="GK" width="81%"></a>
                        </div>
                        <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Garis Kemiskinan <br>Rp ".number_format($GKDesa,2,",",".")?></div></div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-12 text-center">
                      <div class="card">
                        <div class="card-body bg-warning border border-light p-0">
                          <div id="chart_div" style="margin-bottom: 24px;"></div>
                        </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?=$KelompokGK[0]+$KelompokGK[1]." Penduduk<br>Dari ".$JumlahKK." Keluarga"?></div></div>
                      </div>
                    </div>
                  </div>
                </div>
							</div>
            </div>
          <!-- </div> -->
        </div>
        <!-- /page content -->
        
        <!-- footer content -->
        <!-- <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer> -->
        <!-- /footer content -->
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
        $("#ViewData").click(function() {
          var Akun =  { KodeDesa: $("#Desa").val(),
                        KodeKecamatan: $("#Kecamatan").val(),
                        NamaDesa: $("#Desa option:selected").text() }
          $.post(BaseURL+"SuperAdmin/Session", Akun).done(function(Respon) {
            if (Respon == '1') {
              window.location = BaseURL + "SuperAdmin/GarisKemiskinan"
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
            ['Pendidikan', 'Jumlah'],
            ['Di Atas GK',<?=$KelompokGK[0]?>],
            ['Di Bawah GK',<?=$KelompokGK[1]?>],
          ]);

          var options = {
            pieHole: 0.4,
            sliceVisibilityThreshold : 0,
            chartArea : {left:5,top:20,width: 250, height: 250},
            legend: {position: 'none'},
            backgroundColor: { fill:'transparent' }
          };

          var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
          chart.draw(data, options);
        }
      })
		</script>
  </body>
</html>