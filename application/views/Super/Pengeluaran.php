							<div class="row my-2">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelPengeluaran" class="table table-sm table-bordered bg-light">
											<thead>
												<tr class="bg-danger text-light">
													<th scope="col" style="width: 4%;" class="text-center align-middle">No</th>
													<th scope="col" class="align-middle">Description</th>
													<th scope="col" style="width: 7%;" class="text-center align-middle">Quantity</th>
													<th scope="col" class="text-center align-middle">Price</th>
													<th scope="col" class="text-center align-middle">Amount</th>
													<th scope="col" class="text-center align-middle">Date</th>
												</tr>
											</thead>
											<tbody id="RekapSurvei">
												<?php $No = 1; foreach ($Pengeluaran as $key) { ?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['Description']?></th>
														<th scope="row" class="text-center align-middle"><?=$key['Quantity']?></th>
														<th scope="row" style="width: 15%;" class="text-center align-middle"><?="Rp ".number_format($key['Price'],0,',','.');?></th>
														<th scope="row" style="width: 15%;" class="text-center align-middle"><?="Rp ".number_format($key['Amount'],0,',','.');?></th>
														<th scope="row" style="width: 10%;" class="text-center align-middle"><?=$key['Tanggal']?></th>
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
				$('#TabelPengeluaran').DataTable( {
					"ordering": true,
					"bInfo" : false,
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