<div class="left-content">
				<div class="mother-grid-inner">
					<div class="inner-block">
						<div class="blank">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-4 mb-2">
                        <p style="font-size: 12px;" class="text-justify font-weight-bold">Hasil Penghitungan Survei Evaluasi Kinerja Penyelenggaraan Pemerintahan Desa</p>
												<div class="table-responsive mt-1">
                          <table class="table table-sm table-bordered table-striped">
                            <thead class="bg-danger">
                              <tr style="font-size: 10pt;" class="text-light text-center">
                                <th class="align-middle">No</th>
                                <th class="align-middle">Indikator</th>
                                <th class="align-middle">Skor</th>
                                <th class="align-middle">Kinerja</th>
                              </tr>
                            </thead>
                            <tbody style="font-size: 12px;" class="bg-primary">
                            <?php $Indikator = array('Format Isi Per Bab LPPDes','Aspek Bidang Penyelenggaraan Pemerintahan Desa','Aspek Bidang Pelaksanaan Pembangunan Desa','Aspek Bidang Kemasyarakatan','Aspek Bidang Pemberdayaan Masyarakat'); 
                              foreach ($Indikator as $key => $value) { ?>
                              <tr class="text-light align-middle">
                                <td class="align-middle text-center font-weight-bold"><?=($key+1)?></td>
                                <td class="align-middle font-weight-bold"><?=$value?></td>
                                <td class="align-middle text-center font-weight-bold"><?=$Average[$key]?></td>
                                <td class="align-middle text-center font-weight-bold"><?=$Kinerja[$key]?></td>
                              </tr>
                            <?php } ?>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr class="text-light align-middle">
                                <td class="align-middle text-center font-weight-bold"></td>
                                <td class="align-middle font-weight-bold">Kesimpulan</td>
                                <td class="align-middle text-center font-weight-bold"><?=$Hasil?></td>
                                <td class="align-middle text-center font-weight-bold"><?=$Kinerja[5]?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Kuisioner"><i class="fa fa-book"></i> <b>Lihat Kuisioner</b></button> 
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
  <div class="modal fade" id="Kuisioner">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold">Kuisioner Evaluasi Kinerja Badan Permusyawaratan Desa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <embed src="<?=base_url('Kuisioner/KinerjaPemDes.pdf')?>" type="application/pdf" width="100%" height="400"/>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Tutup</b></button>
        </div>
      </div>
    </div>
  </div>
	<script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
  <script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
	<script>
		$(document).ready(function(){
			var BaseURL = '<?=base_url()?>'  
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