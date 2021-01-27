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
                      <h4 class="font-weight-bold text-danger"><?="PerKapita = ".number_format($PerKapita,2)?></h4>
                      <h4 class="font-weight-bold text-danger"><?="PerKapita Konstan = ".number_format($PerKapitaKonstan,2)?></h4>
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
              window.location = BaseURL + "SuperAdmin/IPMPengeluaran"
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