			<div class="left-content">
				<div class="mother-grid-inner">
					<div class="inner-block">
						<div class="blank">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-6 d-flex align-items-center">
										<div class="row">
											<div class="col-sm-12 mb-2">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text bg-danger text-light"><b>Kecamatan</b></span>
													</div>
													<input type="text" class="form-control" value="<?=$this->session->userdata('NamaKecamatan')?>" disabled>
												</div>
											</div>
											<div class="col-sm-12 mb-2">
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
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</body>
	<script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
	<script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
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