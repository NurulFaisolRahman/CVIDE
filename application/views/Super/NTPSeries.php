<div class="clearfix"></div>
  
  <style>
    /* Styling tambahan agar tampilan lebih rapi dan modern */
    .filter-panel {
      background-color: #f8f9fa;
      border-radius: 8px;
    }
    .table-custom-wrapper {
      border-radius: 8px;
      overflow: hidden; /* Agar lengkungan border-radius terlihat di tabel */
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    /* Mengurangi ukuran font agar tabel tidak scroll horizontal */
    .table th {
      font-size: 11px; /* Font header lebih kecil */
      letter-spacing: 0.2px;
      white-space: nowrap;
      padding: 0.4rem 0.2rem !important; /* Padding dikurangi */
    }
    .table td {
      font-size: 10px; /* Font isi tabel lebih kecil */
      white-space: nowrap;
      padding: 0.3rem 0.2rem !important; /* Padding dikurangi */
    }
    /* Mengubah warna header agar lebih elegan */
    .thead-custom {
      background-color: #2c3e50; /* Warna biru gelap / navy */
      color: white;
    }
    .thead-custom th.bg-primary {
      background-color: #0d6efd !important;
    }
    .thead-custom th.bg-warning {
      background-color: #ffc107 !important;
      color: #000;
    }
    /* Warna pastel khusus untuk cell */
    .cell-it { color: #0056b3; font-weight: 600; } /* Biru untuk IT */
    .cell-ib { color: #d39e00; font-weight: 600; } /* Kuning/Emas untuk IB */
    .cell-ntp { color: #c82333; font-weight: 700; } /* Merah tegas untuk NTP */
    
    .bg-light-blue { background-color: #e9ecef !important; }
  </style>

  <div class="row">
    <?php $Tahun = $this->session->userdata('TahunNTP'); ?>
    <div class="col-lg-12">
      
      <!-- Panel Filter Modern -->
      <div class="filter-panel p-2 mb-3 border">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-5 mb-1 mb-md-0">
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <label class="input-group-text bg-primary text-light border-primary" style="font-size: 12px;"><b>Tahun NTP</b></label>
              </div>
              <select class="custom-select border-primary" id="TahunNTP" style="font-size: 12px;">                    
                  <option value="2022" <?=$Tahun==2022?'selected':'';?>>2022</option>
                  <option value="2023" <?=$Tahun==2023?'selected':'';?>>2023</option>
                  <option value="2024" <?=$Tahun==2024?'selected':'';?>>2024</option>
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-md-3">
            <button class="btn btn-sm btn-primary shadow-sm btn-block py-1" id="TampilkanData" style="font-size: 12px;">
              <i class="fa fa-search mr-1"></i> <b>Tampilkan</b>
            </button>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Merapikan tag DIV pembuka agar konsisten untuk semua tahun -->
        <div class="col-lg-12">
          
          <!-- Wrapper Tabel dengan Shadow -->
          <div class="card border-0 table-custom-wrapper mb-4">
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                  <thead class="thead-custom text-center align-middle">
                    <tr>
                      <th class="align-middle" style="width: 8%;">Sektor</th>
                      <th class="align-middle">Jan</th>
                      <th class="align-middle">Feb</th>
                      <th class="align-middle">Mar</th>
                      <th class="align-middle">Apr</th>
                      <th class="align-middle">Mei</th>
                      <th class="align-middle">Jun</th>
                      <th class="align-middle bg-primary text-white">Sem 1</th>                          
                      <th class="align-middle">Jul</th>
                      <th class="align-middle">Agt</th>
                      <th class="align-middle">Sep</th>
                      <th class="align-middle">Okt</th>
                      <th class="align-middle">Nov</th>
                      <th class="align-middle">Des</th>
                      <th class="align-middle bg-primary text-white">Sem 2</th>
                      <th class="align-middle bg-warning text-dark">NTP</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $Sektor = array('Tanaman Pangan','Hortikultura','Perkebunan','Peternakan','Perikanan','5 Sektor'); 
                    $TP = array(array(114.07,111.23,109.33,108.22,113.41,115.09,118.00,124.09,127.03,127.08,131.79,132.10),
                                array(111.67,111.85,112.28,112.33,112.13,112.15,112.18,112.29,112.34,112.32,112.36,112.40),
                                array(102.14,99.45,97.38,96.34,101.14,102.62,105.19,110.50,113.07,113.14,117.30,117.53));  
                    $PK = array(array(128.38,127.03,126.71,130.60,129.67,128.44,134.43,138.29,140.28,141.57,140.22,140.99),
                                array(116.31,116.31,117.73,117.81,117.90,118.05,118.11,121.11,122.45,122.53,122.01,122.98),
                                array(110.38,109.22,107.63,110.86,109.98,108.80,113.82,114.18,114.56,115.54,114.92,114.65));
                    $NT = array(array(110.70,110.85,111.86,114.83,125.17,123.82,127.02,119.33,120.24,119.65,120.19,120.26),
                                array(107.88,107.97,108.11,108.28,108.47,108.49,108.85,108.93,109.00,109.00,109.00,109.11),
                                array(102.62,102.67,103.47,106.05,115.40,114.13,116.70,109.54,110.31,109.77,110.26,110.22));
                    if ($Tahun == 2022) { 
                      for ($i=0; $i < 12; $i++) { 
                        $IT[$i][0] = $TP[0][$i];$IB[$i][0] = $TP[1][$i];$NTP[$i][0] = $TP[2][$i];
                        $IT[$i][4] = $PK[0][$i];$IB[$i][4] = $PK[1][$i];$NTP[$i][4] = $PK[2][$i];
                        $IT[$i][5] = $NT[0][$i];$IB[$i][5] = $NT[1][$i];$NTP[$i][5] = $NT[2][$i];
                      }
                    }
                  ?>
                  
                  <?php for ($i=0; $i < 6; $i++) { if ($Tahun == 2022 || $Tahun == 2023 || $Tahun == 2024) { ?>
                    <!-- Baris IT (Warna Biru) -->
                    <tr class="align-middle">
                      <td class="align-middle bg-light text-dark font-weight-bold" style="font-size: 10px;">IT <?=$Sektor[$i]?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[0][$i],2)?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[1][$i],2)?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[2][$i],2)?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[3][$i],2)?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[4][$i],2)?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[5][$i],2)?></td>
                      <td class="align-middle table-primary text-center font-weight-bold" style="color: #004085;"><?=number_format(($IT[0][$i]+$IT[1][$i]+$IT[2][$i]+$IT[3][$i]+$IT[4][$i]+$IT[5][$i])/6,2)?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[6][$i],2)?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[7][$i],2)?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[8][$i],2)?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[9][$i],2)?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[10][$i],2)?></td>
                      <td class="align-middle text-center cell-it"><?=number_format($IT[11][$i],2)?></td>
                      <td class="align-middle table-primary text-center font-weight-bold" style="color: #004085;"><?=number_format(($IT[6][$i]+$IT[7][$i]+$IT[8][$i]+$IT[9][$i]+$IT[10][$i]+$IT[11][$i])/6,2)?></td>
                      <td class="align-middle bg-light-blue text-center font-weight-bold" style="color: #004085;"><?=number_format(($IT[0][$i]+$IT[1][$i]+$IT[2][$i]+$IT[3][$i]+$IT[4][$i]+$IT[5][$i]+$IT[6][$i]+$IT[7][$i]+$IT[8][$i]+$IT[9][$i]+$IT[10][$i]+$IT[11][$i])/12,2)?></td>
                    </tr>
                    
                    <!-- Baris IB (Warna Kuning/Emas) -->
                    <tr class="align-middle">
                      <td class="align-middle bg-light text-dark font-weight-bold" style="font-size: 10px;">IB <?=$Sektor[$i]?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[0][$i],2)?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[1][$i],2)?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[2][$i],2)?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[3][$i],2)?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[4][$i],2)?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[5][$i],2)?></td>
                      <td class="align-middle table-warning text-center font-weight-bold" style="color: #856404;"><?=number_format(($IB[0][$i]+$IB[1][$i]+$IB[2][$i]+$IB[3][$i]+$IB[4][$i]+$IB[5][$i])/6,2)?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[6][$i],2)?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[7][$i],2)?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[8][$i],2)?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[9][$i],2)?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[10][$i],2)?></td>
                      <td class="align-middle text-center cell-ib"><?=number_format($IB[11][$i],2)?></td>
                      <td class="align-middle table-warning text-center font-weight-bold" style="color: #856404;"><?=number_format(($IB[6][$i]+$IB[7][$i]+$IB[8][$i]+$IB[9][$i]+$IB[10][$i]+$IB[11][$i])/6,2)?></td>
                      <td class="align-middle bg-light-blue text-center font-weight-bold" style="color: #856404;"><?=number_format(($IB[0][$i]+$IB[1][$i]+$IB[2][$i]+$IB[3][$i]+$IB[4][$i]+$IB[5][$i]+$IB[6][$i]+$IB[7][$i]+$IB[8][$i]+$IB[9][$i]+$IB[10][$i]+$IB[11][$i])/12,2)?></td>
                    </tr>
                    
                    <!-- Baris NTP (Warna Merah) -->
                    <tr class="align-middle">
                      <td class="align-middle bg-light text-dark font-weight-bold" style="font-size: 10px;">NTP <?=$Sektor[$i]?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[0][$i],2)?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[1][$i],2)?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[2][$i],2)?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[3][$i],2)?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[4][$i],2)?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[5][$i],2)?></td>
                      <td class="align-middle table-danger text-center font-weight-bold" style="color: #721c24;"><?=number_format(($NTP[0][$i]+$NTP[1][$i]+$NTP[2][$i]+$NTP[3][$i]+$NTP[4][$i]+$NTP[5][$i])/6,2)?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[6][$i],2)?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[7][$i],2)?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[8][$i],2)?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[9][$i],2)?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[10][$i],2)?></td>
                      <td class="align-middle text-center cell-ntp"><?=number_format($NTP[11][$i],2)?></td>
                      <td class="align-middle table-danger text-center font-weight-bold" style="color: #721c24;"><?=number_format(($NTP[6][$i]+$NTP[7][$i]+$NTP[8][$i]+$NTP[9][$i]+$NTP[10][$i]+$NTP[11][$i])/6,2)?></td>
                      <td class="align-middle table-success text-center font-weight-bold" style="color: #155724;"><?=number_format(($NTP[0][$i]+$NTP[1][$i]+$NTP[2][$i]+$NTP[3][$i]+$NTP[4][$i]+$NTP[5][$i]+$NTP[6][$i]+$NTP[7][$i]+$NTP[8][$i]+$NTP[9][$i]+$NTP[10][$i]+$NTP[11][$i])/12,2)?></td>
                    </tr>
                    
                    <!-- Garis Pemisah (Warna lebih halus) -->
                    <tr><td colspan="16" class="bg-dark py-0" style="height: 3px;"></td></tr> 
                  <?php }} ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

  <script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
  <script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
  <script src="<?=base_url("build/js/custom.min.js")?>"></script>
  <script>
    $(document).ready(function(){
      var BaseURL = '<?=base_url()?>' 
      $("#TampilkanData").click(function() {
        // Menambahkan sedikit efek loading visual pada tombol (opsional UX)
        var btn = $(this);
        var originalText = btn.html();
        btn.html('<i class="fa fa-spinner fa-spin mr-1"></i> Memproses...');
        
        var Data =  { TahunNTP: $("#TahunNTP").val() }
        $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
          if (Respon == '1') {
            window.location = BaseURL + "Super/NTPSeries"
          }
          else {
            alert(Respon)
            btn.html(originalText); // Kembalikan tombol ke semula jika gagal
          }
        })                   
      })
    })
  </script>
</body>
</html>