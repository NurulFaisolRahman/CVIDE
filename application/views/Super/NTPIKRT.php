          <div class="clearfix"></div>
            <div class="row">
            <?php $Tahun = $this->session->userdata('TahunNTP'); ?>
              <div class="col-lg-12">
                <div class="row mt-1">
                  <div class="col-lg-2">
                    <div class="input-group input-group-sm mb-1">
                      <div class="input-group-prepend">
                        <label class="input-group-text bg-primary text-light"><b>NTP Tahun</b></label>
                      </div>
                      <select class="custom-select" id="TahunNTP">                    
                          <option value="2022" <?=$Tahun==2022?'selected':'';?>>2022</option>
                          <option value="2023" <?=$Tahun==2023?'selected':'';?>>2023</option>
                          <option value="2024" <?=$Tahun==2024?'selected':'';?>>2024</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="btn btn-sm btn-primary border-light" id="TampilkanData"><b>Tampilkan</b></div>
                  </div>
                  <div class="col-lg-12 col-sm-12">
                    <div class="table-responsive">
                      <table class="table table-sm table-bordered table-striped">
                        <thead class="bg-danger">
                          <tr style="font-size: 10pt;" class="text-light text-center">
                            <th class="align-middle">Indeks Kelompok</th>
                            <th class="align-middle">Januari</th>
                            <th class="align-middle">Februari</th>
                            <th class="align-middle">Maret</th>
                            <th class="align-middle">April</th>
                            <th class="align-middle">Mei</th>
                            <th class="align-middle">Juni</th>
                            <th class="align-middle">Juli</th>
                            <th class="align-middle">Agustus</th>
                            <th class="align-middle">September</th>
                            <th class="align-middle">Oktober</th>
                            <th class="align-middle">November</th>
                            <th class="align-middle">Desember</th>
                          </tr>
                        </thead>
                        <tbody style="font-size: 12px;">
                          <tr class="text-dark align-middle">
                            <td class="align-middle"><b>Bahan Makanan</b></td>
                            <?php for ($i=0; $i < $Total; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($IBahanMakanan[$i],2)?></b></td>
                            <?php } ?>
                          </tr>
                          <tr class="text-dark align-middle">
                            <td class="align-middle"><b>Makanan, Minuman, Rokok & Tembakau</b></td>
                            <?php for ($i=0; $i < $Total; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($IMakananJadi[$i],2)?></b></td>
                            <?php } ?>
                          </tr>
                          <tr class="text-dark align-middle">
                            <td class="align-middle"><b>Perumahan</b></td>
                            <?php for ($i=0; $i < $Total; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($IPerumahan[$i],2)?></b></td>
                            <?php } ?>
                          </tr>
                          <tr class="text-dark align-middle">
                            <td class="align-middle"><b>Sandang</b></td>
                            <?php for ($i=0; $i < $Total; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($ISandang[$i],2)?></b></td>
                            <?php } ?>
                          </tr>
                          <tr class="text-dark align-middle">
                            <td class="align-middle"><b>Kesehatan</b></td>
                            <?php for ($i=0; $i < $Total; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($IKesehatan[$i],2)?></b></td>
                            <?php } ?>
                          </tr>
                          <tr class="text-dark align-middle">
                            <td class="align-middle"><b>Pendidikan, Rekreasi & Olahraga</b></td>
                            <?php for ($i=0; $i < $Total; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($IPendidikan[$i],2)?></b></td>
                            <?php } ?>
                          </tr><tr class="text-dark align-middle">
                            <td class="align-middle"><b>Transportasi & Komunikasi</b></td>
                            <?php for ($i=0; $i < $Total; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($ITransportasi[$i],2)?></b></td>
                            <?php } ?>
                          </tr>
                          </tr><tr class="text-dark align-middle">
                            <td class="align-middle"><b>IKRT</b></td>
                            <?php for ($i=0; $i < $Total; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($IKRT[$i],2)?></b></td>
                            <?php } ?>
                          </tr>
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
              window.location = BaseURL + "Super/NTPIKRT"
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