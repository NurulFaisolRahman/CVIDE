			<div class="left-content">
				<div class="mother-grid-inner">
					<div class="inner-block">
						<div class="blank">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-auto text-center">
										<img src="<?=base_url('assets/img/Profil.jpg')?>" alt="Foto Profil" width="200px">
									</div>
									<div class="col-sm-auto d-flex align-items-center">
										<div class="row">
											<div class="col-sm-12 mb-2">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text bg-danger text-light"><b>NIK</b></span>
													</div>
													<input type="text" class="form-control" value="<?=$this->session->userdata('NIK')?>" disabled>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text bg-danger text-light"><b>Nama</b></span>
													</div>
													<input type="text" class="form-control" value="<?=$this->session->userdata('Nama')?>" disabled>
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