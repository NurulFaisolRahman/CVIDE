      <div class="left-content">
				<div class="mother-grid-inner">
					<div class="inner-block">
						<div class="blank">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-4 mb-2">
                        <p style="font-size: 12px;" class="text-justify font-weight-bold">Hasil Penghitungan Indeks Kepuasan Masyarakat Terhadap Pelayanan Desa <?=$NamaDesa?>. Jumlah Responden <?=$Responden?></p>
												<div class="table-responsive mt-1">
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
                                <td class="align-middle text-center font-weight-bold"><?=$Rata2[$key]?></td>
                                <td class="align-middle text-center font-weight-bold"><?=$Tertimbang[$key]?></td>
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
                                <td class="align-middle text-center font-weight-bold"><?=$NilaiIndeks?></td>
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
                          <div class="col-sm-5">
                            <div class="input-group input-group-sm mb-2">
                              <div class="input-group-prepend">
                                <label class="input-group-text bg-danger text-light"><b>Desa/Kelurahan</b></label>
                              </div>
                              <select class="custom-select" id="Desa">                    
                                <?php foreach ($Desa as $key) { ?>
                                  <option value="<?=$key['Kode']?>" <?=$KodeDesa==$key['Kode']?'selected':'';?>><?=$key['Nama']?></option>
                                <?php } ?>                  
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="btn btn-sm btn-primary" id="ViewData"><b>View Data</b></div>
                          </div>
                        </div>
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
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</body>
	<script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
	<script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
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
      $("#ViewData").click(function() {
        var Akun =  { KodeDesa: $("#Desa").val(),
                      KodeKecamatan: $("#Kecamatan").val(),
                      NamaDesa: $("#Desa option:selected").text() }
        $.post(BaseURL+"SuperAdmin/Session", Akun).done(function(Respon) {
          if (Respon == '1') {
            window.location = BaseURL + "SuperAdmin/IKM"
          }
          else {
            alert(Respon)
          }
        })                    
      })
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
		var toggle = true;			
		$(".sidebar-icon").click(function() {                
			if (toggle){
				$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
				$("#menu span").css({"position":"absolute"});
			}
			else{
				$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
				setTimeout(function() {
					$("#menu span").css({"position":"relative"});
				}, 400);
			}
			toggle = !toggle;
		});
	</script>
</html>