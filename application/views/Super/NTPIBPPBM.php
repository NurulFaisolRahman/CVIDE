          <div class="clearfix"></div>
            <div class="row">
              <div class="col-lg-12">
                <div class="row mt-1">
                  <div class="col-lg-8 col-sm-12">
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
                          </tr>
                        </thead>
                        <tbody style="font-size: 12px;" class="bg-primary">
                          <tr class="text-light align-middle">
                            <td class="align-middle"><b>Bibit</b></td>
                            <?php for ($i=0; $i < 9; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($IBibit[$i],2)?></b></td>
                            <?php } ?>
                          </tr>
                          <tr class="text-light align-middle">
                            <td class="align-middle"><b>Pupuk & Obat-Obatan</b></td>
                            <?php for ($i=0; $i < 9; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($IPupuk[$i],2)?></b></td>
                            <?php } ?>
                          </tr><tr class="text-light align-middle">
                            <td class="align-middle"><b>Transportasi</b></td>
                            <?php for ($i=0; $i < 9; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($ITransportasi[$i],2)?></b></td>
                            <?php } ?>
                          </tr><tr class="text-light align-middle">
                            <td class="align-middle"><b>Sewa & Pengeluaran Lain</b></td>
                            <?php for ($i=0; $i < 9; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($ISewa[$i],2)?></b></td>
                            <?php } ?>
                          </tr>
                          </tr><tr class="text-light align-middle">
                            <td class="align-middle"><b>Barang Modal</b></td>
                            <?php for ($i=0; $i < 9; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($IBarangModal[$i],2)?></b></td>
                            <?php } ?>
                          </tr><tr class="text-light align-middle">
                            <td class="align-middle"><b>Upah Buruh</b></td>
                            <?php for ($i=0; $i < 9; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($IUpahBuruh[$i],2)?></b></td>
                            <?php } ?>
                          </tr>
                          </tr><tr class="text-light align-middle">
                            <td class="align-middle"><b>IBPPBM</b></td>
                            <?php for ($i=0; $i < 9; $i++) { ?>
                              <td class="align-middle"><b><?=number_format($IIBPPBM[$i],2)?></b></td>
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
          window.location = BaseURL + "Super/NTPFluktuasi/" + $("#Sektor").val()                 
        })
      })
		</script>
  </body>
</html>