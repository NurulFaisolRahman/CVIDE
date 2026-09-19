<style>
  @media (max-width: 767.98px) {
    .surveyor-profile-group {
      flex-direction: column !important;
      gap: 10px !important;
      width: 100% !important;
    }
    .surveyor-profile-group input {
      width: 100% !important;
      border-radius: 4px !important;
      height: 40px !important;
    }
    .surveyor-profile-group button {
      width: 100% !important;
      border-radius: 4px !important;
      height: 40px !important;
    }
  }
</style>
				<!-- page content -->
				<div class="right_col bg-success" role="main" style="overflow-x: hidden;"> 
					<div class="">
            <div class="clearfix"></div>
							<div class="row mt-1">
								<div class="col-sm-6 d-flex align-items-center">
									<div class="input-group surveyor-profile-group">
										<input type="password" class="form-control" id="Password" placeholder="Isi Untuk Mengganti Password">
										<button type="button" class="btn btn-primary" id="GantiPassword"><b>Simpan</b></button>
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
				$("#GantiPassword").click(function() {
					if ($("#Password").val() === "") {
						alert('Password Tidak Boleh Kosong')
					} else {
						var Password = { Password: $("#Password").val() }
						$.post(BaseURL+"Surveyor/GantiPassword", Password).done(function(Respon) {
							if (Respon == '1') {
								alert('Password Berhasil Di Ganti!')
								window.location = BaseURL + "Surveyor"
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