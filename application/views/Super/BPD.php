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
      height: 250px; /* Ukuran pas agar tidak terlalu tinggi */
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
      <div class="col-lg-6 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-header card-header-custom d-flex justify-content-between align-items-center py-2">
            <h6 class="m-0 text-primary" style="font-size: 14px;">Evaluasi Kinerja BPD</h6>
            <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2" data-toggle="modal" data-target="#Kuisioner" style="font-size: 11px;">
              <b>Lihat Kuisioner</b>
            </button> 
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-sm table-hover table-striped table-custom mb-0">
                <thead class="text-center">
                  <tr>
                    <th width="5%">No</th>
                    <th width="55%" class="text-left">Indikator</th>
                    <th width="20%">Skor</th>
                    <th width="20%">Kinerja</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $Indikator = array('Menggali Aspirasi Masyarakat','Menampung dan Menyalurkan Aspirasi Masyarakat','Menyelenggarakan Musyawarah BPD dan Desa','Gabungan (Penyelenggaraan Pemilihan Kepala Desa)','Melaksanakan Tugas Lain (Perundang Undangan)'); 
                  foreach ($Indikator as $key => $value) { ?>
                  <tr>
                    <td class="text-center"><?=($key+1)?></td>
                    <td><?=$value?></td>
                    <td class="text-center text-dark font-weight-bold"><?=number_format($Average[$key],2)?></td>
                    <td class="text-center text-primary font-weight-bold"><?=$Kinerja[$key]?></td>
                  </tr>
                  <?php } ?>
                  <!-- Baris Pemisah -->
                  <tr><td colspan="4" class="p-1 bg-light"></td></tr>
                  
                  <!-- Baris Kesimpulan -->
                  <tr class="highlight-row border-bottom">
                    <td></td>
                    <td class="text-right">KESIMPULAN</td>
                    <td class="text-center h6 mb-0 text-primary" style="font-size: 13px;"><?=number_format($Hasil,2)?></td>
                    <td class="text-center h6 mb-0 text-success" style="font-size: 13px;"><?=$Kinerja[5]?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Bagian Grafik -->
      <div class="col-lg-6 mb-3">
        <div class="card card-dashboard h-100">
          <div class="card-header card-header-custom py-2">
            <h6 class="m-0 text-secondary text-center" style="font-size: 13px;">Grafik Skor Indikator</h6>
          </div>
          <div class="card-body p-2 d-flex align-items-center justify-content-center">
            <div id="chart_div" class="chart-container"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Kuisioner -->
  <div class="modal fade" id="Kuisioner">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" style="font-size: 16px;">Kuisioner Evaluasi Kinerja Badan Permusyawaratan Desa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-1">
          <embed src="<?=base_url('Kuisioner/BPD.pdf')?>" type="application/pdf" width="100%" height="450px"/>
        </div>
        <div class="modal-footer justify-content-end py-2">
          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
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
            window.location = BaseURL + "Super/BPD"
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
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Mengubah format data agar menjadi Bar Chart berwarna
        var data = google.visualization.arrayToDataTable([
          ['Indikator', 'Skor', { role: 'style' }],
          ['Ind. 1', <?=isset($Average[0]) ? $Average[0] : 0?>, '#4e73df'], // Biru
          ['Ind. 2', <?=isset($Average[1]) ? $Average[1] : 0?>, '#1cc88a'], // Hijau
          ['Ind. 3', <?=isset($Average[2]) ? $Average[2] : 0?>, '#36b9cc'], // Cyan
          ['Ind. 4', <?=isset($Average[3]) ? $Average[3] : 0?>, '#f6c23e'], // Kuning
          ['Ind. 5', <?=isset($Average[4]) ? $Average[4] : 0?>, '#e74a3b']  // Merah
        ]);

        var options = {
          chartArea: {width: '90%', height: '80%'},
          legend: {position: 'none'},
          vAxis: {
            title: 'Skor', 
            titleTextStyle: {fontSize: 11, italic: false},
            textStyle: {fontSize: 10},
            minValue: 0
          },
          hAxis: {
            textStyle: {fontSize: 11, bold: true}
          },
          animation: {
            startup: true,
            duration: 1000,
            easing: 'out'
          }
        };

        // Menggunakan ColumnChart agar lebih bersih ketimbang ComboChart
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      // Memastikan chart responsif saat jendela di-resize
      $(window).resize(function(){
        drawVisualization();
      });
    })
  </script>
</body>
</html>