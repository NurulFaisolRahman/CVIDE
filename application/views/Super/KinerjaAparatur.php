          <div class="clearfix"></div>
            <div class="row">
              <div class="col-lg-12">
                <div class="row mt-2">
                  <div class="col-lg-4">
                    <div class="table-responsive">
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
                        <?php $Indikator = array('KepalaDesa','SekertarisDesa','TU','Keuangan','Perencanaan','Pemerintahan','Kesejahteraan','Pelayanan'); 
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
                            <td class="align-middle text-center font-weight-bold"><?=$Kinerja[8]?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Kuisioner"><i class="fa fa-book"></i> <b>Lihat Kuisioner</b></button> 
                  </div>
                  <div class="col-lg-8 align-self-center">
                    <div class="row">
                      <div class="col-lg-4">
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
                      <div class="col-lg-4">
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
                      <div class="col-lg-4">
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
                      <div class="col-lg-4">
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
                      <div class="col-lg-4">
                        <div class="btn btn-sm btn-primary border-light" id="TampilkanData"><b>Tampilkan</b></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div id="chart_div"></div>
                      </div>
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

    <div class="modal fade" id="Kuisioner">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold">Kuisioner Evaluasi Kinerja Aparatur Desa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <embed src="<?=base_url('Kuisioner/KinerjaAparatur.pdf')?>" type="application/pdf" width="100%" height="400"/>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Tutup</b></button>
          </div>
        </div>
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
        $("#TampilkanData").click(function() {
          var Data =  { KodeDesa: $("#Desa").val(),
                        KodeKecamatan: $("#Kecamatan").val(),
                        JenisData: $("#JenisData").val() }
          $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
            if (Respon == '1') {
              window.location = BaseURL + "Super/KinerjaAparatur"
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
            ['Skor', 'Indikator 1', 'Indikator 2', 'Indikator 3', 'Indikator 4', 'Indikator 5', 'Indikator 6', 'Indikator 7', 'Indikator 8'],
            ['',<?=$Average[0]?>, <?=$Average[1]?>,<?=$Average[2]?>,<?=$Average[3]?>,<?=$Average[4]?>,<?=$Average[5]?>,<?=$Average[6]?>,<?=$Average[7]?>] 
          ]);

          var options = {
            title : 'Grafik Evaluasi Kinerja Aparatur Desa',
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