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
                    <!-- <a href="<?=base_url('/Rekap/RekapKondisiRumah.xlsx')?>" class="btn btn-sm btn-danger border-light"><b>Unduh Rekap</b></a> -->
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
          var BangunanTinggal = google.visualization.arrayToDataTable([
            ['Bangunan Tinggal', 'Persentase'],
            ['Milik Sendiri',<?=$BangunanTinggal[0]?>],
            ['Kontrak',<?=$BangunanTinggal[1]?>],
            ['Bebas Sewa',<?=$BangunanTinggal[2]?>],
            ['Dinas',<?=$BangunanTinggal[3]?>],
            ['Lainnya',<?=$BangunanTinggal[4]?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('BangunanTinggal'));
          chart.draw(BangunanTinggal, options);
          var LahanTinggal = google.visualization.arrayToDataTable([
            ['Lahan Tinggal', 'Persentase'],
            ['Milik Sendiri',<?=$LahanTinggal[0]?>],
            ['Orang Lain',<?=$LahanTinggal[1]?>],
            ['Tanah Negara',<?=$LahanTinggal[2]?>],
            ['Lainnya',<?=$LahanTinggal[3]?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('LahanTinggal'));
          chart.draw(LahanTinggal, options);
          var JenisLantai = google.visualization.arrayToDataTable([
            ['Jenis Lantai', 'Persentase'],
            ['Marmer',<?=$JenisLantai[0]?>],
            ['Keramik',<?=$JenisLantai[1]?>],
            ['Ubin/Semen',<?=$JenisLantai[2]?>],
            ['Kayu',<?=$JenisLantai[3]?>],
            ['Lainnya',<?=$JenisLantai[4]?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('JenisLantai'));
          chart.draw(JenisLantai, options);
          var JenisDinding = google.visualization.arrayToDataTable([
            ['Jenis Dinding', 'Persentase'],
            ['Tembok',<?=$JenisDinding[0]?>],
            ['Kayu',<?=$JenisDinding[1]?>],
            ['Anyaman Bambu',<?=$JenisDinding[2]?>],
            ['Lainnya',<?=$JenisDinding[3]?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('JenisDinding'));
          chart.draw(JenisDinding, options);
          var JenisAtap = google.visualization.arrayToDataTable([
            ['Jenis Atap', 'Persentase'],
            ['Genteng Beton',<?=$JenisAtap[0]?>],
            ['Genteng Keramik',<?=$JenisAtap[1]?>],
            ['Genteng Tanah Liat',<?=$JenisAtap[2]?>],
            ['Asbes',<?=$JenisAtap[3]?>],
            ['Lainnya',<?=$JenisAtap[4]?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('JenisAtap'));
          chart.draw(JenisAtap, options);
          var SumberAir = google.visualization.arrayToDataTable([
            ['Sumber Air', 'Persentase'],
            ['Air kemasan/Air isi ulang',<?=$SumberAir[0]?>],
            ['Leding meteran/Eceran',<?=$SumberAir[1]?>],
            ['Sumur Bor/Pompa',<?=$SumberAir[2]?>],
            ['Sumur Terlindung',<?=$SumberAir[3]?>],
            ['Sumur Tak Terlindung',<?=$SumberAir[4]?>],
            ['Air Sungai',<?=$SumberAir[5]?>],
            ['Lainnya',<?=$SumberAir[6]?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('SumberAir'));
          chart.draw(SumberAir, options);
          var JenisPenerangan = google.visualization.arrayToDataTable([
            ['Jenis Penerangan', 'Persentase'],
            ['Listrik PLN',<?=$JenisPenerangan[0]?>],
            ['Listrik Non PLN',<?=$JenisPenerangan[1]?>],
            ['Lainnya',<?=$JenisPenerangan[2]?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('JenisPenerangan'));
          chart.draw(JenisPenerangan, options);
          var JenisJamban = google.visualization.arrayToDataTable([
            ['Jenis Jamban', 'Persentase'],
            ['Tangki',<?=$JenisJamban[0]?>],
            ['SPAL',<?=$JenisJamban[1]?>],
            ['Lubang Tanah',<?=$JenisJamban[2]?>],
            ['Sungai',<?=$JenisJamban[3]?>],
            ['Lainnya',<?=$JenisJamban[4]?>],
          ]);
          var chart = new google.visualization.PieChart(document.getElementById('JenisJamban'));
          chart.draw(JenisJamban, options);
        }
      })
		</script>
  </body>
</html>