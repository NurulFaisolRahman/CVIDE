<div class="left-content">
				<div class="mother-grid-inner">
					<div class="inner-block">
						<div class="blank">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-12">
                    <div class="row">
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
                      <div class="col-sm-4 mb-2">
                        <p style="font-size: 12px;" class="text-center font-weight-bold">Jumlah Responden <?=$Responden?></p>
												<div class="table-responsive mt-1">
                          <table class="table table-sm table-bordered table-striped">
                            <thead class="bg-danger">
                              <tr style="font-size: 10pt;" class="text-light text-center">
                                <th class="align-middle">No</th>
                                <th class="align-middle">Pendidikan</th>
                                <th class="align-middle">%</th>
                              </tr>
                            </thead>
                            <tbody style="font-size: 12px;" class="bg-primary">
                            <?php $TingkatPendidikan = array('Tidak Pernah Sekolah','SD/Sederajat','SMP/Sederajat','SMA/Sederajat','Diploma','S1','S2','S3'); 
                              foreach ($TingkatPendidikan as $key => $value) { ?>
                              <tr class="text-light align-middle">
                                <td class="align-middle text-center font-weight-bold"><?=($key+1)?></td>
                                <td class="align-middle font-weight-bold"><?=$value?></td>
                                <td class="align-middle text-center font-weight-bold"><?=$Pendidikan[$key].'%'?></td>
                              </tr>
                            <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-sm-8 align-self-center">
                        <div class="row">
                          <div class="col-sm-12">
                            <div id="chart_div" style="width: 400px; height: 400px;"></div>
                          </div>
                        </div>
                      </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
  </body>
	<script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
  <script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
            window.location = BaseURL + "SuperAdmin/Pendidikan"
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
          ['Tidak Pernah Sekolah',<?=$JenisPendidikan[0]?>],
          ['SD/Sederajat',<?=$JenisPendidikan[1]?>],
          ['SMP/Sederajat',<?=$JenisPendidikan[2]?>],
          ['SMA/Sederajat',<?=$JenisPendidikan[3]?>],
          ['Diploma',<?=$JenisPendidikan[4]?>],
          ['S1',<?=$JenisPendidikan[5]?>],
          ['S2',<?=$JenisPendidikan[6]?>],
          ['S3',<?=$JenisPendidikan[7]?>]
        ]);

        var options = {
          pieHole: 0.4,
          sliceVisibilityThreshold : 0,
          chartArea : {left:15,top:30},
          legend: {position: 'none'},
          backgroundColor: { fill:'transparent' }
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
		})
		var toggle = true;			
		$(".sidebar-icon").click(function() {                
			if (toggle){
				$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
				$("#menu span").css({"position":"absolute"});
			}
			else{
				$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
				setTimeout(function() {
					$("#menu span").css({"position":"relative"});
				}, 400);
			}
			toggle = !toggle;
		});
	</script>
</html>