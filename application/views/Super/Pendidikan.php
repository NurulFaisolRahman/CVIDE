<style>
            /* Custom CSS untuk mempercantik tampilan */
            .filter-card {
              background: #ffffff;
              border-radius: 10px;
              box-shadow: 0 4px 6px rgba(0,0,0,0.05);
              padding: 15px 15px 5px 15px;
              margin-bottom: 25px;
            }
            .custom-card {
              border-radius: 12px;
              border: none;
              box-shadow: 0 4px 15px rgba(0,0,0,0.05);
              transition: all 0.3s ease;
              overflow: hidden;
              background-color: #fff;
            }
            .custom-card:hover {
              transform: translateY(-5px);
              box-shadow: 0 12px 25px rgba(0,0,0,0.1);
            }
            .card-visual-wrapper {
              display: flex;
              align-items: center;
              justify-content: center;
              background-color: #f8f9fc;
              border-bottom: 1px solid #edf2f9;
            }
            .card-visual-wrapper.bg-warning-light {
              background-color: #fffdf5;
            }
            .card-info {
              padding: 20px;
            }
            .card-info-title {
              font-size: 13px; 
              color: #4e73df;
              font-weight: 700;
              text-transform: uppercase;
              letter-spacing: 0.5px;
              margin-bottom: 15px;
              border-bottom: 2px solid #e3e6f0;
              padding-bottom: 10px;
            }
            /* Styling untuk label input group agar lebih clean */
            .input-group-text.custom-label {
              background-color: #f8f9fc;
              color: #4e73df;
              border-right: none;
            }
            .custom-select {
              border-left: none;
            }
            /* Custom Table Styling */
            .custom-table thead th {
              background-color: #f8f9fc;
              color: #858796;
              font-size: 11px;
              text-transform: uppercase;
              letter-spacing: 0.5px;
              border-bottom: 2px solid #e3e6f0;
              border-top: none;
            }
            .custom-table tbody td {
              font-size: 13px;
              color: #5a5c69;
              vertical-align: middle;
              border-bottom: 1px solid #e3e6f0;
            }
          </style>

          <div class="clearfix"></div>
            <div class="row">
              <div class="col-sm-12">
                
                <!-- Section Filter Data -->
                <div class="filter-card mb-4">
                  <div class="row mt-2">
                    <div class="col-lg-3 col-md-6 mb-2">
                      <div class="input-group input-group-sm shadow-sm rounded">
                        <div class="input-group-prepend">
                          <label class="input-group-text custom-label"><b>Kabupaten</b></label>
                        </div>
                        <select class="custom-select" id="Kabupaten">  
                          <?php foreach ($Kabupaten as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeKabupaten==$key['Kode']?'selected':'';?>><?=ucfirst(strtolower(substr($key['Nama'],5)))?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                      <div class="input-group input-group-sm shadow-sm rounded">
                        <div class="input-group-prepend">
                          <label class="input-group-text custom-label"><b>Kecamatan</b></label>
                        </div>
                        <select class="custom-select" id="Kecamatan">  
                          <?php foreach ($Kecamatan as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeKecamatan==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                      <div class="input-group input-group-sm shadow-sm rounded">
                        <div class="input-group-prepend">
                          <label class="input-group-text custom-label"><b>Desa</b></label>
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
                    <div class="col-lg-3 col-md-6 mb-2">
                      <div class="input-group input-group-sm shadow-sm rounded">
                        <div class="input-group-prepend">
                          <label class="input-group-text text-white bg-primary border-primary"><b>Data</b></label>
                        </div>
                        <select class="custom-select border-primary" id="JenisData">                    
                          <option value="Kabupaten" <?=$this->session->userdata('JenisData')=='Kabupaten'?'selected':'';?>>Kabupaten</option>
                          <option value="Kecamatan" <?=$this->session->userdata('JenisData')=='Kecamatan'?'selected':'';?>>Kecamatan</option>
                          <option value="Desa" <?=$this->session->userdata('JenisData')=='Desa'?'selected':'';?>>Desa</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-2 d-flex align-items-center">
                      <button class="btn btn-sm btn-primary shadow-sm mr-2" id="TampilkanData"><b><i class="fa fa-search"></i> Tampilkan</b></button>
                      <a href="<?=base_url('/Rekap/RekapTingkatPendidikan.xlsx')?>" class="btn btn-sm btn-danger shadow-sm"><b><i class="fa fa-download"></i> Unduh Rekap</b></a>
                    </div>
                  </div>
                </div>
                <!-- End Section Filter Data -->

                <!-- Area Konten Utama -->
                <div class="row">
                  <!-- Card Tabel Pendidikan -->
                  <div class="col-lg-5 mb-4">
                    <div class="card custom-card h-100">
                      <div class="card-info">
                        <div class="card-info-title"><i class="fa fa-table mr-2"></i> Proporsi Tingkat Pendidikan</div>
                        <div class="table-responsive mt-1">
                          <table class="table custom-table table-hover border-bottom-0 mb-0">
                            <thead>
                              <tr class="text-center">
                                <th class="align-middle" width="10%">No</th>
                                <th class="align-middle text-left">Pendidikan</th>
                                <th class="align-middle" width="25%">Persentase</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php $TingkatPendidikan = array('Tidak Pernah Sekolah','SD/Sederajat','SMP/Sederajat','SMA/Sederajat','Perguruan Tinggi'); 
                              foreach ($TingkatPendidikan as $key => $value) { ?>
                              <tr>
                                <td class="align-middle text-center font-weight-bold"><?=($key+1)?></td>
                                <td class="align-middle font-weight-bold"><?=$value?></td>
                                <td class="align-middle text-center font-weight-bold text-primary"><?=$Pendidikan[$key].'%'?></td>
                              </tr>
                            <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Card Visualisasi Pie Chart -->
                  <div class="col-lg-7 mb-4">
                    <div class="card custom-card h-100">
                      <div class="card-info-title mx-4 mt-4 mb-0"><i class="fa fa-pie-chart mr-2"></i> Visualisasi Ijazah Tertinggi</div>
                      <div class="card-visual-wrapper bg-warning-light h-100" style="min-height: 350px;">
                        <div id="chart_div" style="width: 100%; height: 350px;"></div>
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
          if ($("#JenisData").val() == 'Desa') {
            alert('Data Pendidikan Desa Belum Tersedia')
          } else {
            var Data =  { KodeDesa: $("#Desa").val(),
                          KodeKecamatan: $("#Kecamatan").val(),
                          JenisData: $("#JenisData").val() }
            $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
              if (Respon == '1') {
                window.location = BaseURL + "Super/Pendidikan"
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
          var data = google.visualization.arrayToDataTable([
            ['Pendidikan', 'Jumlah'],
            ['Tidak Pernah Sekolah',<?=number_format($IjazahTertinggi[0]/array_sum($IjazahTertinggi)*100,2)?>],
            ['SD/Sederajat',<?=number_format($IjazahTertinggi[1]/array_sum($IjazahTertinggi)*100,2)?>],
            ['SMP/Sederajat',<?=number_format($IjazahTertinggi[2]/array_sum($IjazahTertinggi)*100,2)?>],
            ['SMA/Sederajat',<?=number_format($IjazahTertinggi[3]/array_sum($IjazahTertinggi)*100,2)?>],
            ['Perguruan Tinggi',<?=number_format($IjazahTertinggi[4]/array_sum($IjazahTertinggi)*100,2)?>],
          ]);

          var options = {
            pieHole: 0.3,
            sliceVisibilityThreshold : 0,
            chartArea : {left:20, top:20, width: '90%', height: '85%'},
            legend: {position: 'right', textStyle: {fontSize: 12, color: '#5a5c69'}},
            backgroundColor: { fill:'transparent' }
          };

          var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
          chart.draw(data, options);
        }

        // Agar chart menjadi responsive saat ukuran layar diubah
        $(window).resize(function(){
          drawChart();
        });
      })
		</script>
  </body>
</html>