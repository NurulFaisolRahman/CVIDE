				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
								<div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-3"> 
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
                    <div class="col-sm-3">
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
                    <div class="col-sm-6 mb-2">
                      <div class="table-responsive mt-1">
                        <table class="table table-sm table-bordered table-striped">
                          <thead class="bg-danger">
                            <tr style="font-size: 10pt;" class="text-light text-center align-middle">
                              <th class="">Usia Ibu</th>
                              <th>Anak Lahir</th>
                              <th>Anak Mati</th>
                              <th>Anak Bertahan</th>
                              <th>Jumlah Ibu</th>
                              <th>ALH</th>
                              <th>AMH</th>
                            </tr>
                          </thead>
                          <tbody style="font-size: 12px;" class="bg-primary">
                          <?php $TingkatPendidikan = array('15 - 19','20 - 24','25 - 29','30 - 34','35 - 39','40 - 44','45 - 49'); 
                            foreach ($TingkatPendidikan as $key => $value) { ?>
                            <tr class="text-light align-middle text-center">
                              <td><?=$value?></td>
                              <td><?=$ALHAMH[$key][0]?></td>
                              <td><?=$ALHAMH[$key][1]?></td>
                              <td><?=$ALHAMH[$key][2]?></td>
                              <td><?=$ALHAMH[$key][3]?></td>
                              <td><?=$ALHAMH[$key][4]?></td>
                              <td><?=$ALHAMH[$key][5]?></td>
                            </tr>
                          <?php } ?>
                          </tbody>
                        </table>
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
    <script src="<?=base_url("build/js/custom.min.js")?>"></script>
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
              window.location = BaseURL + "SuperAdmin/IPMKesehatan"
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