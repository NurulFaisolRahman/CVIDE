				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
            <div class="clearfix"></div>
							<div class="row">
								<div class="col-sm-6 d-flex align-items-center">
									<div class="row">
										<div class="col-sm-12 mb-1"> 
											<div class="input-group"> 
												<div class="input-group-prepend">
													<span class="input-group-text bg-danger text-light"><b>Kecamatan</b></span>
												</div>
												<input type="text" class="form-control" value="<?=$this->session->userdata('NamaKecamatan')?>" disabled>
											</div>
										</div>
										<div class="col-sm-12 mb-1">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text bg-danger text-light"><b>Desa/Kelurahan</b></span>
												</div>
												<input type="text" class="form-control" value="<?=$this->session->userdata('NamaDesa')?>" disabled>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text bg-danger text-light"><b>Ganti Password</b></span>
												</div>
												<input type="password" class="form-control" id="Password" placeholder="Isi Untuk Mengganti Password">
												<button type="button" class="btn btn-primary" id="GantiPassword"><b>Simpan</b></button>
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
				$("#GantiPassword").click(function() {
					if ($("#Password").val() === "") {
						alert('Password Tidak Boleh Kosong')
					} else {
						var Password = { Password: $("#Password").val() }
						$.post(BaseURL+"Desa/GantiPassword", Password).done(function(Respon) {
							if (Respon == '1') {
								alert('Password Berhasil Di Ganti!')
								window.location = BaseURL + "Desa"
							} else {
								alert(Respon)
							}
						})
					}
				})
			})
		</script>
  </body>
</html>		