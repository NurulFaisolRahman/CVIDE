<div class="clearfix"></div>
            
            <style>
              /* Custom CSS untuk memperhalus tampilan, disamakan dengan APS */
              .filter-card { border-radius: 8px; border-left: 4px solid #007bff; }
              .data-card { transition: all 0.3s ease; border-radius: 12px; overflow: hidden; }
              .data-card:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.15) !important; }
              .label-filter { font-size: 0.75rem; font-weight: 600; color: #495057; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.2rem; }
              .card-title-custom { font-size: 0.8rem; letter-spacing: 0.3px; }
              
              /* Memastikan container chart menyesuaikan kartu */
              .chart-container { width: 100%; height: 180px; }
            </style>

            <!-- Bagian Filter Data -->
            <div class="row mb-2">
              <div class="col-sm-12">
                <div class="card shadow-sm border-0 filter-card bg-light">
                  <div class="card-body py-2">
                    <h6 class="font-weight-bold text-primary mb-2" style="font-size: 0.9rem;"><i class="fa fa-filter mr-2"></i>Filter Data Kondisi Rumah</h6>
                    <div class="row">
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Kabupaten</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="Kabupaten">  
                          <?php foreach ($Kabupaten as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeKabupaten==$key['Kode']?'selected':'';?>><?=ucfirst(strtolower(substr($key['Nama'],5)))?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Kecamatan</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="Kecamatan">  
                          <?php foreach ($Kecamatan as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeKecamatan==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Desa</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="Desa">                    
                          <?php foreach ($Desa as $key) { ?>
                            <option value="<?=$key['Kode']?>" <?=$KodeDesa==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                          <?php } ?>                  
                        </select>
                      </div>
                      <div class="col-lg-3 col-md-6 mb-2">
                        <label class="label-filter">Jenis Data</label>
                        <select class="custom-select custom-select-sm shadow-sm border-0" id="JenisData">                    
                          <option value="Kabupaten" <?=$this->session->userdata('JenisData')=='Kabupaten'?'selected':'';?>>Kabupaten</option>
                          <option value="Kecamatan" <?=$this->session->userdata('JenisData')=='Kecamatan'?'selected':'';?>>Kecamatan</option>
                          <option value="Desa" <?=$this->session->userdata('JenisData')=='Desa'?'selected':'';?>>Desa</option>
                        </select>
                      </div>
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div class="row mt-1">
                      <div class="col-12 text-right">
                        <button class="btn btn-primary btn-sm shadow-sm px-3 rounded-pill" id="TampilkanData">
                          <b>Tampilkan</b>
                        </button>
                        <a href="<?=base_url('/Rekap/RekapKondisiRumah.xlsx')?>" class="btn btn-danger btn-sm shadow-sm px-3 rounded-pill ml-2">
                          <b>Unduh Rekap</b>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bagian Kartu Data Visualisasi -->
            <!-- Baris Pertama -->
            <div class="row justify-content-center">
              
              <div class="col-lg-3 col-md-6 col-sm-12 mb-2 text-center">
                <div class="card data-card shadow-sm border-0 h-100">
                  <div class="card-body p-2 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                    <div id="BangunanTinggal" class="chart-container"></div>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="text-muted font-weight-bold text-uppercase mb-0 card-title-custom">Status Bangunan Tinggal</h6>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-12 mb-2 text-center">
                <div class="card data-card shadow-sm border-0 h-100">
                  <div class="card-body p-2 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                    <div id="LahanTinggal" class="chart-container"></div>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="text-muted font-weight-bold text-uppercase mb-0 card-title-custom">Status Lahan Tinggal</h6>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-12 mb-2 text-center">
                <div class="card data-card shadow-sm border-0 h-100">
                  <div class="card-body p-2 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                    <div id="JenisLantai" class="chart-container"></div>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="text-muted font-weight-bold text-uppercase mb-0 card-title-custom">Jenis Lantai</h6>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-12 mb-2 text-center">
                <div class="card data-card shadow-sm border-0 h-100">
                  <div class="card-body p-2 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                    <div id="JenisDinding" class="chart-container"></div>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="text-muted font-weight-bold text-uppercase mb-0 card-title-custom">Jenis Dinding</h6>
                  </div>
                </div>
              </div>

            </div>

            <!-- Baris Kedua -->
            <div class="row justify-content-center">
              
              <div class="col-lg-3 col-md-6 col-sm-12 mb-2 text-center">
                <div class="card data-card shadow-sm border-0 h-100">
                  <div class="card-body p-2 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                    <div id="JenisAtap" class="chart-container"></div>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="text-muted font-weight-bold text-uppercase mb-0 card-title-custom">Jenis Atap</h6>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-12 mb-2 text-center">
                <div class="card data-card shadow-sm border-0 h-100">
                  <div class="card-body p-2 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                    <div id="SumberAir" class="chart-container"></div>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="text-muted font-weight-bold text-uppercase mb-0 card-title-custom">Sumber Air</h6>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-12 mb-2 text-center">
                <div class="card data-card shadow-sm border-0 h-100">
                  <div class="card-body p-2 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                    <div id="JenisPenerangan" class="chart-container"></div>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="text-muted font-weight-bold text-uppercase mb-0 card-title-custom">Jenis Penerangan</h6>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-12 mb-2 text-center">
                <div class="card data-card shadow-sm border-0 h-100">
                  <div class="card-body p-2 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                    <div id="JenisJamban" class="chart-container"></div>
                  </div>
                  <div class="card-footer bg-white border-0 pt-2 pb-3">
                    <h6 class="text-muted font-weight-bold text-uppercase mb-0 card-title-custom">Jenis Jamban</h6>
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
            // Animasi loading tombol
            var $btn = $(this);
            var originalText = $btn.html();
            $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...');

            var Data =  { KodeDesa: $("#Desa").val(),
                          KodeKecamatan: $("#Kecamatan").val(),
                          JenisData: $("#JenisData").val() }
            $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
              if (Respon == '1') {
                window.location = BaseURL + "Super/KondisiRumah"
              }
              else {
                alert(Respon)
                $btn.html(originalText);
              }
            }).fail(function() {
              $btn.html(originalText);
            })                    
          }
        })

        // Google Charts configuration
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);

        // Menambahkan listener resize agar chart responsif saat ukuran layar berubah
        $(window).resize(function(){
            drawChart();
        });

        function drawChart() {
          // Opsi Chart yang diperbarui agar proporsional dan responsif
          var options = {
            pieHole: 0.35, // Diperbesar sedikit agar terlihat modern (Donut)
            sliceVisibilityThreshold : 0,
            chartArea : {width: '85%', height: '85%'}, // Menggunakan persentase bukan pixel statis
            legend: {position: 'none'},
            backgroundColor: { fill:'transparent' },
            tooltip: { textStyle: { fontSize: 12 } }
          };

          var BangunanTinggal = google.visualization.arrayToDataTable([
            ['Bangunan Tinggal', 'Persentase'],
            ['Milik Sendiri',<?=number_format($BangunanTinggal[0]/array_sum($BangunanTinggal)*100,2)?>],
            ['Kontrak',<?=number_format($BangunanTinggal[1]/array_sum($BangunanTinggal)*100,2)?>],
            ['Bebas Sewa',<?=number_format($BangunanTinggal[2]/array_sum($BangunanTinggal)*100,2)?>],
            ['Dinas',<?=number_format($BangunanTinggal[3]/array_sum($BangunanTinggal)*100,2)?>],
            ['Lainnya',<?=number_format($BangunanTinggal[4]/array_sum($BangunanTinggal)*100,2)?>],
          ]);
          var chart1 = new google.visualization.PieChart(document.getElementById('BangunanTinggal'));
          chart1.draw(BangunanTinggal, options);

          var LahanTinggal = google.visualization.arrayToDataTable([
            ['Lahan Tinggal', 'Persentase'],
            ['Milik Sendiri',<?=number_format($LahanTinggal[0]/array_sum($LahanTinggal)*100,2)?>],
            ['Orang Lain',<?=number_format($LahanTinggal[1]/array_sum($LahanTinggal)*100,2)?>],
            ['Tanah Negara',<?=number_format($LahanTinggal[2]/array_sum($LahanTinggal)*100,2)?>],
            ['Lainnya',<?=number_format($LahanTinggal[3]/array_sum($LahanTinggal)*100,2)?>],
          ]);
          var chart2 = new google.visualization.PieChart(document.getElementById('LahanTinggal'));
          chart2.draw(LahanTinggal, options);

          var JenisLantai = google.visualization.arrayToDataTable([
            ['Jenis Lantai', 'Persentase'],
            ['Marmer',<?=number_format($JenisLantai[0]/array_sum($JenisLantai)*100,2)?>],
            ['Keramik',<?=number_format($JenisLantai[1]/array_sum($JenisLantai)*100,2)?>],
            ['Ubin/Semen',<?=number_format($JenisLantai[2]/array_sum($JenisLantai)*100,2)?>],
            ['Kayu',<?=number_format($JenisLantai[3]/array_sum($JenisLantai)*100,2)?>],
            ['Lainnya',<?=number_format($JenisLantai[4]/array_sum($JenisLantai)*100,2)?>],
          ]);
          var chart3 = new google.visualization.PieChart(document.getElementById('JenisLantai'));
          chart3.draw(JenisLantai, options);

          var JenisDinding = google.visualization.arrayToDataTable([
            ['Jenis Dinding', 'Persentase'],
            ['Tembok',<?=number_format($JenisDinding[0]/array_sum($JenisDinding)*100,2)?>],
            ['Kayu',<?=number_format($JenisDinding[1]/array_sum($JenisDinding)*100,2)?>],
            ['Anyaman Bambu',<?=number_format($JenisDinding[2]/array_sum($JenisDinding)*100,2)?>],
            ['Lainnya',<?=number_format($JenisDinding[3]/array_sum($JenisDinding)*100,2)?>],
          ]);
          var chart4 = new google.visualization.PieChart(document.getElementById('JenisDinding'));
          chart4.draw(JenisDinding, options);

          var JenisAtap = google.visualization.arrayToDataTable([
            ['Jenis Atap', 'Persentase'],
            ['Genteng Beton',<?=number_format($JenisAtap[0]/array_sum($JenisAtap)*100,2)?>],
            ['Genteng Keramik',<?=number_format($JenisAtap[1]/array_sum($JenisAtap)*100,2)?>],
            ['Genteng Tanah Liat',<?=number_format($JenisAtap[2]/array_sum($JenisAtap)*100,2)?>],
            ['Asbes',<?=number_format($JenisAtap[3]/array_sum($JenisAtap)*100,2)?>],
            ['Lainnya',<?=number_format($JenisAtap[4]/array_sum($JenisAtap)*100,2)?>],
          ]);
          var chart5 = new google.visualization.PieChart(document.getElementById('JenisAtap'));
          chart5.draw(JenisAtap, options);

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
          var chart6 = new google.visualization.PieChart(document.getElementById('SumberAir'));
          chart6.draw(SumberAir, options);

          var JenisPenerangan = google.visualization.arrayToDataTable([
            ['Jenis Penerangan', 'Persentase'],
            ['450 Watt',<?=number_format($JenisPenerangan[0]/array_sum($JenisPenerangan)*100,2)?>],
            ['900 Watt',<?=number_format($JenisPenerangan[1]/array_sum($JenisPenerangan)*100,2)?>],
            ['1300 Watt',<?=number_format($JenisPenerangan[2]/array_sum($JenisPenerangan)*100,2)?>],
            ['>1300 Watt',<?=number_format($JenisPenerangan[3]/array_sum($JenisPenerangan)*100,2)?>],
            ['Tanpa Meteran',<?=number_format($JenisPenerangan[4]/array_sum($JenisPenerangan)*100,2)?>],
          ]);
          var chart7 = new google.visualization.PieChart(document.getElementById('JenisPenerangan'));
          chart7.draw(JenisPenerangan, options);

          var JenisJamban = google.visualization.arrayToDataTable([
            ['Jenis Jamban', 'Persentase'],
            ['Tangki',<?=number_format($JenisJamban[0]/array_sum($JenisJamban)*100,2)?>],
            ['SPAL',<?=number_format($JenisJamban[1]/array_sum($JenisJamban)*100,2)?>],
            ['Lubang Tanah',<?=number_format($JenisJamban[2]/array_sum($JenisJamban)*100,2)?>],
            ['Sungai',<?=number_format($JenisJamban[3]/array_sum($JenisJamban)*100,2)?>],
            ['Lainnya',<?=number_format($JenisJamban[4]/array_sum($JenisJamban)*100,2)?>],
          ]);
          var chart8 = new google.visualization.PieChart(document.getElementById('JenisJamban'));
          chart8.draw(JenisJamban, options);
        }
      })
		</script>
  </body>
</html>