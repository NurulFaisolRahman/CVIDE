      	<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
								<div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-4 mb-2">
                      <p style="font-size: 12px;" class="my-0 text-justify font-weight-bold">Hasil Penghitungan Survei Evaluasi Kinerja Penyelenggaraan Pemerintahan Desa</p>
                      <div class="table-responsive mt-1">
                        <table class="table table-sm table-bordered table-striped">
                          <thead class="bg-danger">
                            <tr style="font-size: 10pt;" class="text-light text-center">
                              <th class="align-middle">No</th>
                              <th class="align-middle">Indikator</th>
                              <th class="align-middle">Skor</th>
                              <th class="align-middle">Kinerja</th>
                            </tr>
                          </thead>
                          <tbody style="font-size: 12px;" class="bg-primary">
                          <?php $Indikator = array('Format Isi Per Bab LPPDes','Aspek Bidang Penyelenggaraan Pemerintahan Desa','Aspek Bidang Pelaksanaan Pembangunan Desa','Aspek Bidang Kemasyarakatan','Aspek Bidang Pemberdayaan Masyarakat'); 
                            foreach ($Indikator as $key => $value) { ?>
                            <tr class="text-light align-middle">
                              <td class="align-middle text-center font-weight-bold"><?=($key+1)?></td>
                              <td class="align-middle font-weight-bold"><?=$value?></td>
                              <td class="align-middle text-center font-weight-bold"><?=number_format($Average[$key],2)?></td>
                              <td class="align-middle text-center font-weight-bold"><?=$Kinerja[$key]?></td>
                            </tr>
                          <?php } ?>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr class="text-light align-middle">
                              <td class="align-middle text-center font-weight-bold"></td>
                              <td class="align-middle font-weight-bold">Kesimpulan</td>
                              <td class="align-middle text-center font-weight-bold"><?=number_format($Hasil,2)?></td>
                              <td class="align-middle text-center font-weight-bold"><?=$Kinerja[5]?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Kuisioner"><i class="fa fa-book"></i> <b>Lihat Kuisioner</b></button> 
                    </div>
                    <div class="col-sm-8 align-self-center">
                      <div class="row">
                        <div class="col-sm-4"> 
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
                        <div class="col-sm-5">
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
                        <div class="col-sm-12">
                          <div id="chart_div"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
							</div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <div class="modal fade" id="Kuisioner">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Kuisioner Evaluasi Kinerja Badan Permusyawaratan Desa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <embed src="<?=base_url('Kuisioner/KinerjaPemDes.pdf')?>" type="application/pdf" width="100%" height="400"/>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Tutup</b></button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
   	<script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
    <script src="<?=base_url("build/js/custom.min.js")?>"></script>
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
              window.location = BaseURL + "SuperAdmin/KinerjaPemDes"
            }
            else {
              alert(Respon)
            }
          })                    
        })
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
          // Some raw data (not necessarily accurate)
          var data = google.visualization.arrayToDataTable([
            ['Skor', 'Indikator 1', 'Indikator 2', 'Indikator 3', 'Indikator 4', 'Indikator 5'],
            ['',<?=$Average[0]?>, <?=$Average[1]?>,<?=$Average[2]?>,<?=$Average[3]?>,<?=$Average[4]?>] 
          ]);

          var options = {
            title : 'Grafik Evaluasi Kinerja Penyelenggaraan Pemerintahan Desa',
            legend: {position: 'none'},
            vAxis: {title: 'Skor'},
            hAxis: {title: 'Indikator'},
            seriesType: 'bars',
            series: {5: {type: 'line'}}
          };

          var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
          chart.draw(data, options);
        }
      })
		</script>
  </body>
</html>