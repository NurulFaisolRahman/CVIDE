          <div class="clearfix"></div>
            <div class="row">
              <div class="col-lg-12">
                <div class="row mt-1">
                  <div class="col-lg-6 col-sm-12">
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
                          </tr>
                        </thead>
                        <tbody style="font-size: 12px;" class="bg-primary">
                          <tr class="text-light align-middle">
                            <td class="align-middle"><b>Bibit</b></td>
                            <td class="align-middle"><b><?=$IBibit[0]?></b></td>
                            <td class="align-middle"><b><?=$IBibit[1]?></b></td>
                            <td class="align-middle"><b><?=$IBibit[2]?></b></td>
                            <td class="align-middle"><b><?=$IBibit[3]?></b></td>
                            <td class="align-middle"><b><?=$IBibit[4]?></b></td>
                            <td class="align-middle"><b><?=$IBibit[5]?></b></td>
                            <td class="align-middle"><b><?=$IBibit[6]?></b></td>
                          </tr>
                          <tr class="text-light align-middle">
                            <td class="align-middle"><b>Pupuk & Obat-Obatan</b></td>
                            <td class="align-middle"><b><?=$IPupuk[0]?></b></td>
                            <td class="align-middle"><b><?=$IPupuk[1]?></b></td>
                            <td class="align-middle"><b><?=$IPupuk[2]?></b></td>
                            <td class="align-middle"><b><?=$IPupuk[3]?></b></td>
                            <td class="align-middle"><b><?=$IPupuk[4]?></b></td>
                            <td class="align-middle"><b><?=$IPupuk[5]?></b></td>
                            <td class="align-middle"><b><?=$IPupuk[6]?></b></td>
                          </tr><tr class="text-light align-middle">
                            <td class="align-middle"><b>Transportasi</b></td>
                            <td class="align-middle"><b><?=$ITransportasi[0]?></b></td>
                            <td class="align-middle"><b><?=$ITransportasi[1]?></b></td>
                            <td class="align-middle"><b><?=$ITransportasi[2]?></b></td>
                            <td class="align-middle"><b><?=$ITransportasi[3]?></b></td>
                            <td class="align-middle"><b><?=$ITransportasi[4]?></b></td>
                            <td class="align-middle"><b><?=$ITransportasi[5]?></b></td>
                            <td class="align-middle"><b><?=$ITransportasi[6]?></b></td>
                          </tr><tr class="text-light align-middle">
                            <td class="align-middle"><b>Sewa & Pengeluaran Lain</b></td>
                            <td class="align-middle"><b><?=$ISewa[0]?></b></td>
                            <td class="align-middle"><b><?=$ISewa[1]?></b></td>
                            <td class="align-middle"><b><?=$ISewa[2]?></b></td>
                            <td class="align-middle"><b><?=$ISewa[3]?></b></td>
                            <td class="align-middle"><b><?=$ISewa[4]?></b></td>
                            <td class="align-middle"><b><?=$ISewa[5]?></b></td>
                            <td class="align-middle"><b><?=$ISewa[6]?></b></td>
                          </tr>
                          </tr><tr class="text-light align-middle">
                            <td class="align-middle"><b>Barang Modal</b></td>
                            <td class="align-middle"><b><?=$IBarangModal[0]?></b></td>
                            <td class="align-middle"><b><?=$IBarangModal[1]?></b></td>
                            <td class="align-middle"><b><?=$IBarangModal[2]?></b></td>
                            <td class="align-middle"><b><?=$IBarangModal[3]?></b></td>
                            <td class="align-middle"><b><?=$IBarangModal[4]?></b></td>
                            <td class="align-middle"><b><?=$IBarangModal[5]?></b></td>
                            <td class="align-middle"><b><?=$IBarangModal[6]?></b></td>
                          </tr><tr class="text-light align-middle">
                            <td class="align-middle"><b>Upah Buruh</b></td>
                            <td class="align-middle"><b><?=$IUpahBuruh[0]?></b></td>
                            <td class="align-middle"><b><?=$IUpahBuruh[1]?></b></td>
                            <td class="align-middle"><b><?=$IUpahBuruh[2]?></b></td>
                            <td class="align-middle"><b><?=$IUpahBuruh[3]?></b></td>
                            <td class="align-middle"><b><?=$IUpahBuruh[4]?></b></td>
                            <td class="align-middle"><b><?=$IUpahBuruh[5]?></b></td>
                            <td class="align-middle"><b><?=$IUpahBuruh[6]?></b></td>
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