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
              height: 160px; /* Dikurangi agar card tidak terlalu tinggi */
              display: flex;
              align-items: center;
              justify-content: center;
              background-color: #f8f9fc; /* Warna abu-abu kebiruan sangat muda */
              border-bottom: 1px solid #edf2f9;
            }
            .card-visual-wrapper.bg-warning-light {
              background-color: #fffdf5; /* Warna kuning sangat muda untuk chart */
            }
            .card-visual-wrapper img {
              max-height: 130px; /* Diperbesar dari 100px */
              width: auto;
              transition: transform 0.3s ease;
            }
            .custom-card:hover .card-visual-wrapper img {
              transform: scale(1.08);
            }
            .card-info {
              padding: 12px 10px; /* Padding dikurangi agar hemat ruang */
              text-align: center;
            }
            .card-info-title {
              font-size: 11px; /* Diperkecil dari 13px */
              color: #858796;
              font-weight: 700;
              text-transform: uppercase;
              letter-spacing: 0.5px;
              margin-bottom: 4px; /* Margin dikurangi dari 8px */
              line-height: 1.3;
            }
            .card-info-value {
              font-size: 16px; /* Diperkecil dari 20px */
              color: #e74a3b; /* Warna merah untuk menonjolkan angka */
              font-weight: 800;
              margin-bottom: 0;
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
            .chart-container {
              width: 100%;
              display: flex;
              justify-content: center;
            }
          </style>

          <div class="clearfix"></div>
            <div class="row">
              <div class="col-sm-12">
                
                <!-- Section Filter Data -->
                <div class="filter-card">
                  <div class="row">
                    <div class="col-lg-3 col-md-6">
                      <div class="input-group input-group-sm mb-2 shadow-sm rounded">
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
                    <div class="col-lg-3 col-md-6">
                      <div class="input-group input-group-sm mb-2 shadow-sm rounded">
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
                    <div class="col-lg-3 col-md-6">
                      <div class="input-group input-group-sm mb-2 shadow-sm rounded">
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
                    <div class="col-lg-3 col-md-6">
                      <div class="input-group input-group-sm mb-2 shadow-sm rounded">
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
                      <a href="<?=base_url('/Rekap/RekapKemiskinan.xlsx')?>" class="btn btn-sm btn-danger shadow-sm"><b><i class="fa fa-download"></i> Unduh Rekap</b></a>
                    </div>
                  </div>
                </div>
                <!-- End Section Filter Data -->

                <!-- Baris Card Pertama -->
                <div class="row">
                  <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="card custom-card h-100">
                      <div class="card-visual-wrapper">
                        <img src="<?=base_url('assets/img/GKM.png')?>" alt="GKM">
                      </div>
                      <div class="card-info">
                        <div class="card-info-title">Garis Kemiskinan Makanan</div>
                        <div class="card-info-value">Rp <?=number_format($GKMRata2,0,",",".")?></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="card custom-card h-100">
                      <div class="card-visual-wrapper">
                        <img src="<?=base_url('assets/img/GKNM.png')?>" alt="GKNM">
                      </div>
                      <div class="card-info">
                        <div class="card-info-title">Garis Kemiskinan Non Makanan</div>
                        <div class="card-info-value">Rp <?=number_format($GKNMRata2,0,",",".")?></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="card custom-card h-100">
                      <div class="card-visual-wrapper">
                        <img src="<?=base_url('assets/img/GK.png')?>" alt="GK">
                      </div>
                      <div class="card-info">
                        <div class="card-info-title">Total Garis Kemiskinan</div>
                        <div class="card-info-value">Rp <?=number_format($GKRata2,0,",",".")?></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="card custom-card h-100">
                      <div class="card-visual-wrapper bg-warning-light">
                        <div class="chart-container" id="Miskin"></div>
                      </div>
                      <div class="card-info">
                        <div class="card-info-title">Penduduk Miskin</div>
                        <div class="card-info-value"><?=number_format($KelompokGK[1]/($KelompokGK[0]+$KelompokGK[1])*100,2,",",".")?>%</div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Baris Card Kedua -->
                <div class="row mt-2">
                  <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="card custom-card h-100">
                      <div class="card-visual-wrapper">
                        <img src="<?=base_url('assets/img/PerKapita.png')?>" alt="P1">
                      </div>
                      <div class="card-info">
                        <div class="card-info-title">Indeks Kedalaman Kemiskinan (P1)</div>
                        <div class="card-info-value"><?=number_format($P1,2,",",".")?></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="card custom-card h-100">
                      <div class="card-visual-wrapper">
                        <img src="<?=base_url('assets/img/PerKapitaKonstan.png')?>" alt="P2">
                      </div>
                      <div class="card-info">
                        <div class="card-info-title">Indeks Keparahan Kemiskinan (P2)</div>
                        <div class="card-info-value"><?=number_format($P2,2,",",".")?></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="card custom-card h-100">
                      <div class="card-visual-wrapper">
                        <img src="<?=base_url('assets/img/GiniRasio.png')?>" alt="GiniRasio">
                      </div>
                      <div class="card-info">
                        <div class="card-info-title">Gini Rasio</div>
                        <div class="card-info-value"><?=$GiniRasio?></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                    <div class="card custom-card h-100">
                      <div class="card-visual-wrapper bg-warning-light">
                        <div class="chart-container" id="MiskinEkstrim"></div>
                      </div>
                      <div class="card-info">
                        <div class="card-info-title">Kemiskinan Ekstrim</div>
                        <div class="card-info-value"><?=number_format($P3,2,",",".")?>%</div>
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
            chartArea : {left:65,top:35,width: 130, height: 130},
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