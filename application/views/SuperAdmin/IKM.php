          <div class="clearfix"></div>
            <div class="row">
              <div class="col-lg-12">
                <div class="row mt-2">
                  <div class="col-lg-4 mb-2">
                    <p style="font-size: 15px;" class="my-0 text-justify text-white font-weight-bold">Jumlah Responden Sebanyak <?=$Responden?> Orang</p>
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
                  <div class="col-lg-8 align-self-center">
                    <div class="row">
                      <div class="col-lg-4">
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
                      <div class="col-lg-4">
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
                      <div class="col-lg-4">
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
                      <div class="col-lg-4">
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
                      <div class="col-lg-4">
                        <div class="btn btn-sm btn-primary border-light" id="TampilkanData"><b>Tampilkan</b></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div id="Gender"></div>
                      </div>
                      <div class="col-lg-4">
                        <div id="Pendidikan"></div>
                      </div>
                      <div class="col-lg-4">
                        <div id="Pekerjaan"></div> 
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
    <script src="<?=base_url("build/js/custom.min.js")?>"></script>
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
        $("#TampilkanData").click(function() {
          var Data =  { KodeDesa: $("#Desa").val(),
                        KodeKecamatan: $("#Kecamatan").val(),
                        JenisData: $("#JenisData").val() }
          $.post(BaseURL+"SuperAdmin/Session", Data).done(function(Respon) {
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
		</script>
  </body>
</html>