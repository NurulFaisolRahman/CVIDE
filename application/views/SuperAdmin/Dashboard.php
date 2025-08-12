<div class="row justify-content-center mt-4">
  <div class="col-md-8">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fa fa-key mr-2"></i> Ubah Password</h5>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="Password" class="font-weight-bold">Password Baru</label>
          <div class="input-group">
            <input type="password" class="form-control" id="Password" placeholder="Masukkan password baru (minimal 8 karakter)">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary password-toggle" type="button">
                <i class="fa fa-eye"></i>
              </button>
            </div>
          </div>
          <small class="form-text text-muted">Password harus minimal 8 karakter</small>
        </div>
        
        <div class="text-right mt-4">
          <button type="button" class="btn btn-primary px-4" id="GantiPassword">
            <i class="fa fa-save mr-2"></i> Simpan Perubahan
          </button>
        </div>
      </div>
    </div>
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
						$.post(BaseURL+"Super/GantiPassword", Password).done(function(Respon) {
							if (Respon == '1') {
								alert('Password Berhasil Di Ganti!')
								window.location = BaseURL + "Super"
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