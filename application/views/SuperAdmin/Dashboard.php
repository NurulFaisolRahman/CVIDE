<div class="left-content">
				<div class="mother-grid-inner">
					<div class="inner-block">
						<div class="blank">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-12 d-flex align-items-center">
										<div class="col-sm-6">
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
			<div class="clearfix"> </div>
		</div>
	</body>
	<script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
	<script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
	<script>
		$(document).ready(function(){
			var BaseURL = '<?=base_url()?>'  
			$('#Password').keypress(function(event){
				var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
					event.preventDefault();
					document.getElementById("GantiPassword").click();  
				}
			});
			$("#GantiPassword").click(function() {
				if ($("#Password").val() === "") {
					alert('Password Tidak Boleh Kosong')
				} else {
					var Password = { Password: $("#Password").val() }
					$.post(BaseURL+"SuperAdmin/GantiPassword", Password).done(function(Respon) {
						if (Respon == '1') {
							alert('Password Berhasil Di Ganti!')
							window.location = BaseURL + "SuperAdmin"
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