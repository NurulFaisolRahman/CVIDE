							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelPendapatan" class="table table-sm table-bordered bg-light">
											<thead>
												<tr class="bg-danger text-light">
													<th scope="col" style="width: 3%;" class="text-center align-middle">No</th>
													<th scope="col" style="width: 25%;" class="align-middle">Nama Kegiatan</th>
													<th scope="col" style="width: 10%;" class="align-middle">Sumber Kegiatan</th>
													<th scope="col" style="width: 10%;" class="align-middle">Nominal Kegiatan</th>
													<th scope="col" style="width: 8%;" class="align-middle">Mulai</th>
													<th scope="col" style="width: 8%;" class="align-middle">Selesai</th>
												</tr>
											</thead>
											<tbody>
												<?php $SumberKegiatan = array('','Swakelola Tipe 1','Swakelola Tipe 2','Narasumber','Rekanan','CV IDE PL','CV IDE Tender/Seleksi'); 
															$No = 1; foreach ($Pendapatan as $key) { $Mulai = explode("-",$key['Mulai']); $Selesai = explode("-",$key['Selesai']); ?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['NamaKegiatan']?></th>
														<th scope="row" class="align-middle"><?=$SumberKegiatan[$key['SumberKegiatan']]?></th>
														<th scope="row" class="align-middle"><?="Rp ".number_format($key['NominalKegiatan'],0,',','.')?></th>
														<th scope="row" class="align-middle"><?=$Mulai[2].'-'.$Mulai[1].'-'.$Mulai[0]?></th>
														<th scope="row" class="align-middle"><?=$Selesai[2].'-'.$Selesai[1].'-'.$Selesai[0]?></th>
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
        <!-- /page content -->
      </div>
		</div>
    <script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
   	<script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
		<script src="<?=base_url("build/js/custom.min.js")?>"></script>
		<script src="<?=base_url("assets/datatables/jquery.dataTables.js")?>"></script>
		<script src="<?=base_url("assets/datatables-bs4/js/dataTables.bootstrap4.js")?>"></script>
		<script>
			$(document).ready(function(){
				var BaseURL = '<?=base_url()?>'  
				$('#TabelPendapatan').DataTable( {
					"ordering": true,
					"bInfo" : true,
					"lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "All"]],
					"language": {
						"paginate": {
							'previous': '<b class="text-white"><</b>',
							'next': '<b class="text-white">></b>'
						}
					}
				})
			})
		</script>
  </body>
</html>