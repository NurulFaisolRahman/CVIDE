<style>
    .card-dashboard {
      border: none;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.08);
      margin-bottom: 15px;
    }
    .card-header-custom {
      background-color: #ffffff;
      border-bottom: 1px solid #e9ecef;
      border-radius: 8px 8px 0 0 !important;
      font-weight: 600;
      color: #333;
    }
    .table-custom thead th {
      background-color: #4e73df;
      color: white;
      border: none;
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 8px;
    }
    .table-custom tbody td {
      font-size: 12px;
      vertical-align: middle;
      padding: 6px;
    }
    .highlight-row td {
      background-color: #f8f9fc !important;
      font-weight: bold;
      color: #4e73df;
    }
    .filter-label {
      font-weight: 600;
      font-size: 12px;
      color: #555;
      margin-bottom: 3px;
    }
    .chart-container {
      width: 100%;
      height: 180px; /* Ukuran diperkecil agar pas di layar */
    }
  </style>

  <div class="clearfix"></div>
  
  <div class="py-2">
    <!-- Bagian Filter Pencarian -->
    <div class="card card-dashboard">
      <div class="card-body p-2">
        <div class="row align-items-end">
          <div class="col-lg-3 col-md-6 mb-2 mb-lg-0">
            <label class="filter-label">Kabupaten</label>
            <select class="custom-select custom-select-sm" id="Kabupaten">  
              <?php foreach ($Kabupaten as $key) { ?>
                <option value="<?=$key['Kode']?>" <?=$KodeKabupaten==$key['Kode']?'selected':'';?>><?=ucfirst(strtolower(substr($key['Nama'],5)))?></option>
              <?php } ?>                  
            </select>
          </div>
          <div class="col-lg-3 col-md-6 mb-2 mb-lg-0">
            <label class="filter-label">Kecamatan</label>
            <select class="custom-select custom-select-sm" id="Kecamatan">  
              <?php foreach ($Kecamatan as $key) { ?>
                <option value="<?=$key['Kode']?>" <?=$KodeKecamatan==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
              <?php } ?>                  
            </select>
          </div>
          <div class="col-lg-2 col-md-6 mb-2 mb-lg-0">
            <label class="filter-label">Desa</label>
            <select class="custom-select custom-select-sm" id="Desa">                    
              <?php foreach ($Desa as $key) { ?>
                <option value="<?=$key['Kode']?>" <?=$KodeDesa==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
              <?php } ?>                  
            </select>
          </div>
          <div class="col-lg-2 col-md-6 mb-2 mb-lg-0">
            <label class="filter-label">Tingkat Data</label>
            <select class="custom-select custom-select-sm" id="JenisData">                    
              <option value="Kabupaten" <?=$this->session->userdata('JenisData')=='Kabupaten'?'selected':'';?>>Kabupaten</option>
              <option value="Kecamatan" <?=$this->session->userdata('JenisData')=='Kecamatan'?'selected':'';?>>Kecamatan</option>
              <option value="Desa" <?=$this->session->userdata('JenisData')=='Desa'?'selected':'';?>>Desa</option>
            </select>
          </div>
          <div class="col-lg-2 col-md-12 mt-2 mt-lg-0">
            <button class="btn btn-sm btn-primary btn-block shadow-sm font-weight-bold" id="TampilkanData">
              Tampilkan
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Bagian Tabel Indikator -->
      <div class="col-lg-5 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-header card-header-custom d-flex justify-content-between align-items-center py-2">
            <h6 class="m-0 text-primary" style="font-size: 14px;">Hasil Penilaian Indikator</h6>
            <span class="badge badge-success px-2 py-1">Responden: <?=$Responden?></span>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-sm table-hover table-striped table-custom mb-0">
                <thead class="text-center">
                  <tr>
                    <th width="5%">No</th>
                    <th width="45%" class="text-left">Indikator</th>
                    <th width="25%">Rata-Rata</th>
                    <th width="25%">Tertimbang</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $Indikator = array('Persyaratan Pelayanan','Prosedur Pelayanan','Waktu Pelayanan','Biaya / Tarif','Spesifikasi Pelayanan','Kompetensi Pelaksana','Perilaku Pelaksana','Kedisiplinan','Penanganan Pengaduan','Sarana','Penerapan Smart Kampung'); 
                  foreach ($Indikator as $key => $value) { ?>
                  <tr>
                    <td class="text-center"><?=($key+1)?></td>
                    <td><?=$value?></td>
                    <td class="text-center text-dark font-weight-bold"><?=number_format($Rata2[$key],2)?></td>
                    <td class="text-center text-primary font-weight-bold"><?=number_format($Tertimbang[$key],2)?></td>
                  </tr>
                  <?php } ?>
                  <!-- Baris Pemisah -->
                  <tr><td colspan="4" class="p-1 bg-light"></td></tr>
                  
                  <!-- Baris Nilai Akhir -->
                  <tr class="highlight-row">
                    <td></td>
                    <td class="text-right">NILAI IKM</td>
                    <td></td>
                    <td class="text-center h6 mb-0 text-primary" style="font-size: 13px;"><?=number_format($NilaiIndeks,2)?></td>
                  </tr>
                  <tr class="highlight-row">
                    <td></td>
                    <td class="text-right">MUTU PELAYANAN</td>
                    <td></td>
                    <td class="text-center h6 mb-0 text-success" style="font-size: 13px;"><?=$MutuPelayanan?></td>
                  </tr>
                  <tr class="highlight-row border-bottom">
                    <td></td>
                    <td class="text-right">KINERJA PELAYANAN</td>
                    <td></td>
                    <td class="text-center h6 mb-0 text-info" style="font-size: 13px;"><?=$KinerjaUnit?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Bagian Grafik -->
      <div class="col-lg-7">
        <div class="row">
          <!-- Grafik Gender -->
          <div class="col-md-6 mb-3">
            <div class="card card-dashboard h-100">
              <div class="card-header card-header-custom py-2">
                <h6 class="m-0 text-secondary text-center" style="font-size: 13px;">Demografi Jenis Kelamin</h6>
              </div>
              <div class="card-body p-1">
                <div id="Gender" class="chart-container"></div>
              </div>
            </div>
          </div>
          <!-- Grafik Pendidikan -->
          <div class="col-md-6 mb-3">
            <div class="card card-dashboard h-100">
              <div class="card-header card-header-custom py-2">
                <h6 class="m-0 text-secondary text-center" style="font-size: 13px;">Demografi Pendidikan</h6>
              </div>
              <div class="card-body p-1">
                <div id="Pendidikan" class="chart-container"></div>
              </div>
            </div>
          </div>
          <!-- Grafik Pekerjaan -->
          <div class="col-md-12 mb-3">
            <div class="card card-dashboard">
              <div class="card-header card-header-custom py-2">
                <h6 class="m-0 text-secondary text-center" style="font-size: 13px;">Demografi Pekerjaan</h6>
              </div>
              <div class="card-body p-1">
                <div id="Pekerjaan" style="width: 100%; height: 200px;"></div> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
      </div>
      <!-- /page content (menutup right_col dari Header.php) -->
    </div>
    <!-- /main_container -->
  </div>
  <!-- /container body -->

  <script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
  <script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
  <script src="<?=base_url("build/js/custom.min.js")?>"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    $(document).ready(function(){
      var BaseURL = '<?=base_url()?>'  
      
      // AJAX Dependent Dropdown
      $("#Kecamatan").change(function (){
        var Desa = { Kode: $("#Kecamatan").val() }
        $.post(BaseURL+"IDE/ListDesa", Desa).done(function(Respon) {
          $('#Desa').html(Respon)
        })    
      })

      // Tombol Tampilkan
      $("#TampilkanData").click(function() {
        var btn = $(this);
        var originalText = btn.html();
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
        
        var Data =  { 
          KodeDesa: $("#Desa").val(),
          KodeKecamatan: $("#Kecamatan").val(),
          JenisData: $("#JenisData").val() 
        }
        
        $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
          if (Respon == '1') {
            window.location = BaseURL + "Super/IKM"
          } else {
            alert(Respon)
            btn.html(originalText);
          }
        }).fail(function() {
          alert("Terjadi kesalahan pada server.");
          btn.html(originalText);
        });                    
      })

      // Setup Google Charts
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var globalOptions = {
          pieHole: 0.4,
          chartArea: {width: '100%', height: '80%'}, // Diperlebar areanya
          legend: {position: 'right', textStyle: {fontSize: 11}},
          pieSliceText: 'percentage',
          colors: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69']
        };

        // Chart Gender
        var DataGender = google.visualization.arrayToDataTable([
          ['Jenis Kelamin', 'Jumlah'],
          ['Laki-Laki', <?=isset($Gender[0]) ? $Gender[0] : 0?>],
          ['Perempuan', <?=isset($Gender[1]) ? $Gender[1] : 0?>]
        ]);
        var OpsiGender = $.extend({}, globalOptions, { colors: ['#4e73df', '#e83e8c'] });
        var ChartGender = new google.visualization.PieChart(document.getElementById('Gender'));
        ChartGender.draw(DataGender, OpsiGender);

        // Chart Pendidikan
        var DataPendidikan = google.visualization.arrayToDataTable([
          ['Pendidikan', 'Jumlah'],
          ['Tidak Sekolah',   <?=isset($Pendidikan[0]) ? $Pendidikan[0] : 0?>],
          ['SD',              <?=isset($Pendidikan[1]) ? $Pendidikan[1] : 0?>],
          ['SLTP Sederajat',  <?=isset($Pendidikan[2]) ? $Pendidikan[2] : 0?>],
          ['SMA Sederajat',   <?=isset($Pendidikan[3]) ? $Pendidikan[3] : 0?>],
          ['D3/D4',           <?=isset($Pendidikan[4]) ? $Pendidikan[4] : 0?>],
          ['S1',              <?=isset($Pendidikan[5]) ? $Pendidikan[5] : 0?>],
          ['S2 Ke Atas',      <?=isset($Pendidikan[6]) ? $Pendidikan[6] : 0?>],
        ]);
        var ChartPendidikan = new google.visualization.PieChart(document.getElementById('Pendidikan'));
        ChartPendidikan.draw(DataPendidikan, globalOptions);

        // Chart Pekerjaan
        var DataPekerjaan = google.visualization.arrayToDataTable([
          ['Pekerjaan', 'Jumlah'],
          ['PNS',                   <?=isset($Pekerjaan[0]) ? $Pekerjaan[0] : 0?>],
          ['TNI/POLRI',             <?=isset($Pekerjaan[1]) ? $Pekerjaan[1] : 0?>],
          ['Pegawai Swasta',        <?=isset($Pekerjaan[2]) ? $Pekerjaan[2] : 0?>],
          ['Wiraswasta',            <?=isset($Pekerjaan[3]) ? $Pekerjaan[3] : 0?>],
          ['Pelajar / Mahasiswa',   <?=isset($Pekerjaan[4]) ? $Pekerjaan[4] : 0?>],
          ['Tidak / Belum Bekerja', <?=isset($Pekerjaan[5]) ? $Pekerjaan[5] : 0?>],
          ['Lainnya',               <?=isset($Pekerjaan[6]) ? $Pekerjaan[6] : 0?>],
        ]);
        var OpsiPekerjaan = $.extend({}, globalOptions, {
           chartArea: {width: '95%', height: '80%'} 
        });
        var ChartPekerjaan = new google.visualization.PieChart(document.getElementById('Pekerjaan'));
        ChartPekerjaan.draw(DataPekerjaan, OpsiPekerjaan);
      }

      // Resize logic
      $(window).resize(function(){
        drawChart();
      });
    })
  </script>
</body>
</html>