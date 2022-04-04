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
                    <a href="<?=base_url('/Rekap/RekapKondisiRumah.xlsx')?>" class="btn btn-sm btn-danger border-light"><b>Unduh Rekap</b></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="BangunanTinggal" style="margin-bottom: 5px;"></div>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Status Bangunan Tinggal"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="LahanTinggal" style="margin-bottom: 5px;"></div>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Status Lahan Tinggal"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="JenisLantai" style="margin-bottom: 5px;"></div>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Jenis Lantai"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="JenisDinding" style="margin-bottom: 5px;"></div>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Jenis Dinding"?></div></div>
                    </div>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="JenisAtap" style="margin-bottom: 5px;"></div>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Jenis Atap"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="SumberAir" style="margin-bottom: 5px;"></div>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Sumber Air"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="JenisPenerangan" style="margin-bottom: 5px;"></div>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Jenis Penerangan"?></div></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 text-center">
                    <div class="card">
                      <div class="card-body bg-warning border border-light p-0">
                        <div id="JenisJamban" style="margin-bottom: 5px;"></div>
                      </div>
                      <div class="card-footer bg-danger border border-light p-0"><div class="font-weight-bold text-white" style="font-size: 15px;"><?="Jenis Jamban"?></div></div>
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
                window.location = BaseURL + "Super/KondisiRumah"
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
          var BangunanTinggal = google.visualization.arrayToDataTable([
            ['Bangunan Tinggal', 'Persentase'],
            ['Milik Sendiri',<?=number_format($BangunanTinggal[0]/array_sum($BangunanTinggal)*100,2)?>],
            ['Kontrak',<?=number_format($BangunanTinggal[1]/array_sum($BangunanTinggal)*100,2)?>],
            ['Bebas Sewa',<?=number_format($BangunanTinggal[2]/array_sum($BangunanTinggal)*100,2)?>],
            ['Dinas',<?=number_format($BangunanTinggal[3]/array_sum($BangunanTinggal)*100,2)?>],
            ['Lainnya',<?=number_format($BangunanTinggal[4]/array_sum($BangunanTinggal)*100,2)?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('BangunanTinggal'));
          chart.draw(BangunanTinggal, options);
          var LahanTinggal = google.visualization.arrayToDataTable([
            ['Lahan Tinggal', 'Persentase'],
            ['Milik Sendiri',<?=number_format($LahanTinggal[0]/array_sum($LahanTinggal)*100,2)?>],
            ['Orang Lain',<?=number_format($LahanTinggal[1]/array_sum($LahanTinggal)*100,2)?>],
            ['Tanah Negara',<?=number_format($LahanTinggal[2]/array_sum($LahanTinggal)*100,2)?>],
            ['Lainnya',<?=number_format($LahanTinggal[3]/array_sum($LahanTinggal)*100,2)?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('LahanTinggal'));
          chart.draw(LahanTinggal, options);
          var JenisLantai = google.visualization.arrayToDataTable([
            ['Jenis Lantai', 'Persentase'],
            ['Marmer',<?=number_format($JenisLantai[0]/array_sum($JenisLantai)*100,2)?>],
            ['Keramik',<?=number_format($JenisLantai[1]/array_sum($JenisLantai)*100,2)?>],
            ['Ubin/Semen',<?=number_format($JenisLantai[2]/array_sum($JenisLantai)*100,2)?>],
            ['Kayu',<?=number_format($JenisLantai[3]/array_sum($JenisLantai)*100,2)?>],
            ['Lainnya',<?=number_format($JenisLantai[4]/array_sum($JenisLantai)*100,2)?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('JenisLantai'));
          chart.draw(JenisLantai, options);
          var JenisDinding = google.visualization.arrayToDataTable([
            ['Jenis Dinding', 'Persentase'],
            ['Tembok',<?=number_format($JenisDinding[0]/array_sum($JenisDinding)*100,2)?>],
            ['Kayu',<?=number_format($JenisDinding[1]/array_sum($JenisDinding)*100,2)?>],
            ['Anyaman Bambu',<?=number_format($JenisDinding[2]/array_sum($JenisDinding)*100,2)?>],
            ['Lainnya',<?=number_format($JenisDinding[3]/array_sum($JenisDinding)*100,2)?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('JenisDinding'));
          chart.draw(JenisDinding, options);
          var JenisAtap = google.visualization.arrayToDataTable([
            ['Jenis Atap', 'Persentase'],
            ['Genteng Beton',<?=number_format($JenisAtap[0]/array_sum($JenisAtap)*100,2)?>],
            ['Genteng Keramik',<?=number_format($JenisAtap[1]/array_sum($JenisAtap)*100,2)?>],
            ['Genteng Tanah Liat',<?=number_format($JenisAtap[2]/array_sum($JenisAtap)*100,2)?>],
            ['Asbes',<?=number_format($JenisAtap[3]/array_sum($JenisAtap)*100,2)?>],
            ['Lainnya',<?=number_format($JenisAtap[4]/array_sum($JenisAtap)*100,2)?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('JenisAtap'));
          chart.draw(JenisAtap, options);
          var SumberAir = google.visualization.arrayToDataTable([
            ['Sumber Air', 'Persentase'],
            ['Air kemasan/Air isi ulang',<?=number_format($SumberAir[0]/array_sum($SumberAir)*100,2)?>],
            ['Leding meteran/Eceran',<?=number_format($SumberAir[1]/array_sum($SumberAir)*100,2)?>],
            ['Sumur Bor/Pompa',<?=number_format($SumberAir[2]/array_sum($SumberAir)*100,2)?>],
            ['Sumur Terlindung',<?=number_format($SumberAir[3]/array_sum($SumberAir)*100,2)?>],
            ['Sumur Tak Terlindung',<?=number_format($SumberAir[4]/array_sum($SumberAir)*100,2)?>],
            ['Air Sungai',<?=number_format($SumberAir[5]/array_sum($SumberAir)*100,2)?>],
            ['Lainnya',<?=number_format($SumberAir[6]/array_sum($SumberAir)*100,2)?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('SumberAir'));
          chart.draw(SumberAir, options);
          var JenisPenerangan = google.visualization.arrayToDataTable([
            ['Jenis Penerangan', 'Persentase'],
            ['450 Watt',<?=number_format($JenisPenerangan[0]/array_sum($JenisPenerangan)*100,2)?>],
            ['900 Watt',<?=number_format($JenisPenerangan[1]/array_sum($JenisPenerangan)*100,2)?>],
            ['1300 Watt',<?=number_format($JenisPenerangan[2]/array_sum($JenisPenerangan)*100,2)?>],
            ['>1300 Watt',<?=number_format($JenisPenerangan[3]/array_sum($JenisPenerangan)*100,2)?>],
            ['Tanpa Meteran',<?=number_format($JenisPenerangan[4]/array_sum($JenisPenerangan)*100,2)?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('JenisPenerangan'));
          chart.draw(JenisPenerangan, options);
          var JenisJamban = google.visualization.arrayToDataTable([
            ['Jenis Jamban', 'Persentase'],
            ['Tangki',<?=number_format($JenisJamban[0]/array_sum($JenisJamban)*100,2)?>],
            ['SPAL',<?=number_format($JenisJamban[1]/array_sum($JenisJamban)*100,2)?>],
            ['Lubang Tanah',<?=number_format($JenisJamban[2]/array_sum($JenisJamban)*100,2)?>],
            ['Sungai',<?=number_format($JenisJamban[3]/array_sum($JenisJamban)*100,2)?>],
            ['Lainnya',<?=number_format($JenisJamban[4]/array_sum($JenisJamban)*100,2)?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('JenisJamban'));
          chart.draw(JenisJamban, options);
        }
      })
		</script>
  </body>
</html>