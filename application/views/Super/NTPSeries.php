            <div class="clearfix"></div>
              <div class="row">
                <?php $Tahun = $this->session->userdata('TahunNTP'); ?>
                <div class="col-lg-12 col-sm-12">
                  <div class="row mt-1">
                    <div class="col-lg-2">
                      <div class="input-group input-group-sm mb-1">
                        <div class="input-group-prepend">
                          <label class="input-group-text bg-danger text-light"><b>NTP Tahun</b></label>
                        </div>
                        <select class="custom-select" id="TahunNTP">                    
                            <option value="2022" <?=$Tahun==2022?'selected':'';?>>2022</option>
                            <option value="2023" <?=$Tahun==2023?'selected':'';?>>2023</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="btn btn-sm btn-danger border-light" id="TampilkanData"><b>Tampilkan</b></div>
                    </div>
                  </div>
                  <?php if ($Tahun == 2023) { ?>
                    <div class="col-12">
                  <?php } if ($Tahun == 2022) { ?>
                    <div class="col-12">
                  <?php } ?>
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped">
                      <thead class="bg-danger">
                        <tr style="font-size: 10pt;" class="text-light text-center">
                          <th class="align-middle">#</th>
                          <th class="align-middle">Januari</th>
                          <th class="align-middle">Februari</th>
                          <th class="align-middle">Maret</th>
                          <th class="align-middle">April</th>
                          <th class="align-middle">Mei</th>
                          <th class="align-middle">Juni</th>
                          <th class="align-middle bg-primary">Semester 1</th>
                          <th class="align-middle">Juli</th>
                          <th class="align-middle">Agustus</th>
                          <th class="align-middle">September</th>
                          <th class="align-middle">Oktober</th>
                          <!-- <?php if ($Tahun == 2022) { ?> -->
                          <th class="align-middle">November</th>
                          <th class="align-middle">Desember</th>
                          <th class="align-middle bg-primary">Semester 2</th>
                          <th class="align-middle bg-warning">NTP</th>
                        <!-- <?php } ?> -->
                        </tr>
                      </thead>
                      <tbody style="font-size: 12px;" class="bg-primary">
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
                      <?php for ($i=0; $i < 6; $i++) { if ($Tahun == 2022) { ?>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>IT <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[5][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($IT[0][$i]+$IT[1][$i]+$IT[2][$i]+$IT[3][$i]+$IT[4][$i]+$IT[5][$i])/6,2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[6][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[7][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[8][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[9][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[10][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[11][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($IT[6][$i]+$IT[7][$i]+$IT[8][$i]+$IT[9][$i]+$IT[10][$i]+$IT[11][$i])/6,2)?></b></td>
                          <td class="align-middle bg-success text-center"><b><?=number_format(($IT[0][$i]+$IT[1][$i]+$IT[2][$i]+$IT[3][$i]+$IT[4][$i]+$IT[5][$i]+$IT[6][$i]+$IT[7][$i]+$IT[8][$i]+$IT[9][$i]+$IT[10][$i]+$IT[11][$i])/12,2)?></b></td>
                        </tr>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>IB <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[5][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($IB[0][$i]+$IB[1][$i]+$IB[2][$i]+$IB[3][$i]+$IB[4][$i]+$IB[5][$i])/6,2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[6][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[7][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[8][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[9][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[10][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[11][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($IB[6][$i]+$IB[7][$i]+$IB[8][$i]+$IB[9][$i]+$IB[10][$i]+$IB[11][$i])/6,2)?></b></td>
                          <td class="align-middle bg-success text-center"><b><?=number_format(($IB[0][$i]+$IB[1][$i]+$IB[2][$i]+$IB[3][$i]+$IB[4][$i]+$IB[5][$i]+$IB[6][$i]+$IB[7][$i]+$IB[8][$i]+$IB[9][$i]+$IB[10][$i]+$IB[11][$i])/12,2)?></b></td>
                        </tr>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>NTP <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[5][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($NTP[0][$i]+$NTP[1][$i]+$NTP[2][$i]+$NTP[3][$i]+$NTP[4][$i]+$NTP[5][$i])/6,2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[6][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[7][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[8][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[9][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[10][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[11][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($NTP[6][$i]+$NTP[7][$i]+$NTP[8][$i]+$NTP[9][$i]+$NTP[10][$i]+$NTP[11][$i])/6,2)?></b></td>
                          <td class="align-middle bg-success text-center"><b><?=number_format(($NTP[0][$i]+$NTP[1][$i]+$NTP[2][$i]+$NTP[3][$i]+$NTP[4][$i]+$NTP[5][$i]+$NTP[6][$i]+$NTP[7][$i]+$NTP[8][$i]+$NTP[9][$i]+$NTP[10][$i]+$NTP[11][$i])/12,2)?></b></td>
                        </tr>
                        <tr><td colspan="16" class="bg-warning"></td></tr>
                      <?php } else if ($Tahun == 2023) { ?>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>IT <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[5][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($IT[0][$i]+$IT[1][$i]+$IT[2][$i]+$IT[3][$i]+$IT[4][$i]+$IT[5][$i])/6,2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[6][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[7][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[8][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[9][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[10][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IT[11][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($IT[6][$i]+$IT[7][$i]+$IT[8][$i]+$IT[9][$i]+$IT[10][$i]+$IT[11][$i])/6,2)?></b></td>
                          <td class="align-middle bg-success text-center"><b><?=number_format(($IT[0][$i]+$IT[1][$i]+$IT[2][$i]+$IT[3][$i]+$IT[4][$i]+$IT[5][$i]+$IT[6][$i]+$IT[7][$i]+$IT[8][$i]+$IT[9][$i]+$IT[10][$i]+$IT[11][$i])/12,2)?></b></td>
                        </tr>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>IB <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[5][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($IB[0][$i]+$IB[1][$i]+$IB[2][$i]+$IB[3][$i]+$IB[4][$i]+$IB[5][$i])/6,2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[6][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[7][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[8][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[9][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[10][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($IB[11][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($IB[6][$i]+$IB[7][$i]+$IB[8][$i]+$IB[9][$i]+$IB[10][$i]+$IB[11][$i])/6,2)?></b></td>
                          <td class="align-middle bg-success text-center"><b><?=number_format(($IB[0][$i]+$IB[1][$i]+$IB[2][$i]+$IB[3][$i]+$IB[4][$i]+$IB[5][$i]+$IB[6][$i]+$IB[7][$i]+$IB[8][$i]+$IB[9][$i]+$IB[10][$i]+$IB[11][$i])/12,2)?></b></td>
                        </tr>
                        <tr class="text-light align-middle">
                          <td class="align-middle"><b>NTP <?=$Sektor[$i]?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[0][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[1][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[2][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[3][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[4][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[5][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($NTP[0][$i]+$NTP[1][$i]+$NTP[2][$i]+$NTP[3][$i]+$NTP[4][$i]+$NTP[5][$i])/6,2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[6][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[7][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[8][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[9][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[10][$i],2)?></b></td>
                          <td class="align-middle"><b><?=number_format($NTP[11][$i],2)?></b></td>
                          <td class="align-middle bg-danger text-center"><b><?=number_format(($NTP[6][$i]+$NTP[7][$i]+$NTP[8][$i]+$NTP[9][$i]+$NTP[10][$i]+$NTP[11][$i])/6,2)?></b></td>
                          <td class="align-middle bg-success text-center"><b><?=number_format(($NTP[0][$i]+$NTP[1][$i]+$NTP[2][$i]+$NTP[3][$i]+$NTP[4][$i]+$NTP[5][$i]+$NTP[6][$i]+$NTP[7][$i]+$NTP[8][$i]+$NTP[9][$i]+$NTP[10][$i]+$NTP[11][$i])/12,2)?></b></td>
                        </tr>
                        <tr><td colspan="16" class="bg-warning"></td></tr>
                      <?php }} ?>
                      </tbody>
                    </table>
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
    <script>
			$(document).ready(function(){
        var BaseURL = '<?=base_url()?>' 
        $("#TampilkanData").click(function() {
          var Data =  { TahunNTP: $("#TahunNTP").val() }
          $.post(BaseURL+"Super/Session", Data).done(function(Respon) {
            if (Respon == '1') {
              window.location = BaseURL + "Super/NTPSeries"
            }
            else {
              alert(Respon)
            }
          })                   
        })
      })
		</script>
  </body>
</html>