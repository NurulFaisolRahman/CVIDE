							<div class="row my-2">
								<div class="col-lg-auto">
									<div class="input-group input-group-sm mb-2">
										<div class="input-group-prepend">
											<span class="input-group-text bg-primary text-white"><b>Rekap</b></span>
										</div>
										<div class="input-group-prepend">
                      <span class="input-group-text bg-danger text-white"><b>From</b></span>
                    </div>
										<input type="date" class="form-control" id="From" value="<?=date('Y-m-d')?>"> 
										<div class="input-group-prepend">
                      <span class="input-group-text bg-danger text-white"><b>To</b></span>
                    </div>
                    <input type="date" class="form-control" id="To" value="<?=date('Y-m-d')?>">
									</div>
								</div>
								<div class="col-lg-auto">
									<button type="button" class="btn btn-sm btn-danger border-white mb-2" id="Rekap"><i class="fa fa-file-excel-o"></i><b> Excel</b></button>
								</div>
								<div class="col-lg-12">
									<div class="input-group input-group-sm mb-2">
										<div class="input-group-prepend">
											<span class="input-group-text bg-primary text-white"><b><?="Debit 2024 = Rp ".number_format($In,0,',','.')?></b></span>
										</div>
										<div class="input-group-prepend mx-2">
                      <span class="input-group-text bg-danger text-white"><b><?="Kredit 2024 = Rp ".number_format($Out,0,',','.')?></b></span>
										</div>
										<div class="input-group-prepend">
											<span class="input-group-text bg-warning text-white"><b><?="Saldo = Rp ".number_format($In-$Out,0,',','.')?></b></span>
                    </div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelKas" class="table table-sm table-bordered bg-light">
											<thead>
												<tr class="bg-danger text-light">
													<th scope="col" style="width: 4%;" class="text-center align-middle">No</th>
													<th scope="col" class="align-middle">Description</th>
													<th scope="col" class="align-middle">Category</th>
													<th scope="col" style="width: 7%;" class="text-center align-middle">Quantity</th>
													<th scope="col" class="text-center align-middle">Price</th>
													<th scope="col" class="text-center align-middle">Debit</th>
													<th scope="col" class="text-center align-middle">Kredit</th>
													<th scope="col" class="text-center align-middle">Date</th>
												</tr>
											</thead>
											<tbody id="RekapSurvei">
												<?php $No = 1; foreach ($Kas as $key) { $Date = explode("-",$key['Tanggal'])?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['Description']?></th>
														<th scope="row" class="align-middle"><?=$key['Category']?></th>
														<th scope="row" class="text-center align-middle"><?=$key['Quantity']?></th>
														<th scope="row" style="width: 15%;" class="text-center align-middle"><?="Rp ".number_format($key['Price'],0,',','.')?></th>
														<th scope="row" style="width: 15%;" class="text-center align-middle"><?=$key['Jenis'] == 'IN' ? "Rp ".number_format($key['Amount'],0,',','.') : '';?></th>
														<th scope="row" style="width: 15%;" class="text-center align-middle"><?=$key['Jenis'] == 'OUT' ? "Rp ".number_format($key['Amount'],0,',','.') : '';?></th>
														<th scope="row" style="width: 10%;" class="text-center align-middle"><?=$Date[2].'-'.$Date[1].'-'.$Date[0]?></th>
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
					"bInfo" : false,
					"lengthMenu": [[7, 30, 50, -1], [7, 30, 50, "All"]],
					"language": {
						"paginate": {
							'previous': '<b class="text-white"><</b>',
							'next': '<b class="text-white">></b>'
						}
					}
				})

				$("#Rekap").click(function() {
					if ($("#From").val() == "") {
						alert('Input From Belum Benar!')
					} else if ($("#To").val() == "") {
						alert('Input To Belum Benar!')
					} else {
						window.location = BaseURL + "SuperAdmin/ExcelKas/" +$("#From").val()+"/"+$("#To").val()
					}
				})
			})
		</script>
  </body>
</html>