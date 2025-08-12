							<br>
                            <div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelKas" class="table table-sm table-bordered bg-light">
											<thead>
												<tr style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
													<th scope="col" class="text-center align-middle">No</th>
													<th scope="col" class="align-middle">Deskripsi</th>
													<th scope="col" class="align-middle">Nominal Kas</th>
													<th scope="col" class="align-middle">Tanggal</th>
												</tr>
											</thead>
											<tbody>
												<?php $No = 1; foreach ($Kas as $key) { $Date = explode("-",$key['Tanggal']); ?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['Description']?></th>
														<th scope="row" class="align-middle font-weight-bold" style="color: #1565c0;"><?="Rp ".number_format($key['Amount'],0,',','.')?></th>
														<th scope="row" style="width: 10%;" class="align-middle"><?=$Date[2].'-'.$Date[1].'-'.$Date[0]?></th>
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
				$('#TabelKas').DataTable( {
					"ordering": true,
					"bInfo" : true,
					"lengthMenu": [[15, 30, 50, -1], [15, 30, 50, "All"]],
					"language": {
						"paginate": {
							'previous': '<i class="fa fa-chevron-left"></i>',
                    		'next': '<i class="fa fa-chevron-right"></i>'
						}
					}
				})
			})
		</script>
  </body>
</html>