				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-4">
                      <p style="font-size: 12px;" class="text-justify font-weight-bold">Hasil Penghitungan Indeks Kepuasan Masyarakat Terhadap Pelayanan Desa <?=$this->session->userdata('NamaDesa')?>. Jumlah Responden <?=$Responden?></p>
                      <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                          <thead class="bg-danger">
                            <tr style="font-size: 10pt;" class="text-light text-center">
                              <th class="align-middle">No</th>
                              <th class="align-middle">Indikator</th>
                              <th class="align-middle">Rata-Rata</th>
                              <th class="align-middle">Rata-Rata<br>Tertimbang</th>
                            </tr>
                          </thead>
                          <tbody style="font-size: 12px;" class="bg-primary">
                          <?php $Indikator = array('Persyaratan Pelayanan','Prosedur Pelayanan','Waktu Pelayanan','Biaya / Tarif','Spesifikasi Pelayanan','Kompetensi Pelaksana','Perilaku Pelaksana','Kedisiplinan','Penanganan Pengaduan','Sarana','Penerapan Smart Kampung'); 
                            foreach ($Indikator as $key => $value) { ?>
                            <tr class="text-light align-middle">
                              <td class="align-middle text-center font-weight-bold"><?=($key+1)?></td>
                              <td class="align-middle font-weight-bold"><?=$value?></td>
                              <td class="align-middle text-center font-weight-bold"><?=number_format($Rata2[$key],2)?></td>
                              <td class="align-middle text-center font-weight-bold"><?=number_format($Tertimbang[$key],2)?></td>
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
                              <td class="align-middle font-weight-bold">Nilai IKM</td>
                              <td class="align-middle text-center font-weight-bold"></td>
                              <td class="align-middle text-center font-weight-bold"><?=number_format($NilaiIndeks,2)?></td>
                            </tr>
                            <tr class="text-light align-middle">
                              <td class="align-middle text-center font-weight-bold"></td>
                              <td class="align-middle font-weight-bold">Mutu Pelayanan</td>
                              <td class="align-middle text-center font-weight-bold"></td>
                              <td class="align-middle text-center font-weight-bold"><?=$MutuPelayanan?></td>
                            </tr>
                            <tr class="text-light align-middle">
                              <td class="align-middle text-center font-weight-bold"></td>
                              <td class="align-middle font-weight-bold">Kinerja Pelayanan</td>
                              <td class="align-middle text-center font-weight-bold"></td>
                              <td class="align-middle text-center font-weight-bold"><?=$KinerjaUnit?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-sm-8 align-self-center">
                      <div class="row">
                        <div class="col-sm-4">
                          <div id="Gender"></div>
                        </div>
                        <div class="col-sm-4">
                          <div id="Pendidikan"></div>
                        </div>
                        <div class="col-sm-4">
                          <div id="Pekerjaan"></div> 
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> 
        </div>
        <!-- /page content -->
        
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
    <script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script src="<?=base_url("build/js/custom.min.js")?>"></script>
		<script>
			$(document).ready(function(){
        var BaseURL = '<?=base_url()?>'  
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var DataGender = google.visualization.arrayToDataTable([
            ['Jenis Kelamin', 'Jumlah'],
            ['Laki-Laki',     <?=$Gender[0]?>],
            ['Perempuan',     <?=$Gender[1]?>]
          ]);

          var OpsiGender = {
            title: 'Jenis Kelamin',
            titleTextStyle : {fontSize: 12,bold: true},
            legend: {position: 'none'}
          };
          var ChartGender = new google.visualization.PieChart(document.getElementById('Gender'));
          ChartGender.draw(DataGender, OpsiGender);
          var DataPendidikan = google.visualization.arrayToDataTable([
            ['Pendidikan', 'Jumlah'],
            ['Tidak Sekolah',     <?=$Pendidikan[0]?>],
            ['SD',     <?=$Pendidikan[1]?>],
            ['SLTP Sederajat',     <?=$Pendidikan[2]?>],
            ['SMA Sederajat',     <?=$Pendidikan[3]?>],
            ['D3/D4',     <?=$Pendidikan[4]?>],
            ['S1',     <?=$Pendidikan[5]?>],
            ['S2 Ke Atas',     <?=$Pendidikan[6]?>],
          ]);

          var OpsiPendidikan = {
            title: 'Pendidikan',
            titleTextStyle : {fontSize: 12,bold: true},
            legend: {position: 'none'}
          };
          var ChartPendidikan = new google.visualization.PieChart(document.getElementById('Pendidikan'));
          ChartPendidikan.draw(DataPendidikan, OpsiPendidikan);
          var DataPekerjaan = google.visualization.arrayToDataTable([
            ['Pekerjaan', 'Jumlah'],
            ['PNS',     <?=$Pekerjaan[0]?>],
            ['TNI/POLRI',     <?=$Pekerjaan[1]?>],
            ['Pegawai Swasta',     <?=$Pekerjaan[2]?>],
            ['Wiraswasta',     <?=$Pekerjaan[3]?>],
            ['Pelajar / Mahasiswa',     <?=$Pekerjaan[4]?>],
            ['Tidak / Belum Bekerja',     <?=$Pekerjaan[5]?>],
            ['Lainnya',     <?=$Pekerjaan[6]?>],
          ]);

          var OpsiPekerjaan = {
            title: 'Pekerjaan',
            titleTextStyle : {fontSize: 12,bold: true},
            legend: {position: 'none'}
          };
          var ChartPekerjaan = new google.visualization.PieChart(document.getElementById('Pekerjaan'));
          ChartPekerjaan.draw(DataPekerjaan, OpsiPekerjaan);
        }
      })
		</script>
  </body>
</html>