							<div class="row">
								<div class="col-sm-6 d-flex align-items-center">
									<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#ModalInput"><i class="fa fa-plus"></i><b> Input</b></button>
								</div>
							</div>
							<div class="row">
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
													<th scope="col" class="text-center align-middle">Edit</th>
												</tr>
											</thead>
											<tbody id="RekapSurvei">
												<?php $No = 1; foreach ($Pengeluaran as $key) { ?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['Description']?></th>
														<th scope="row" class="text-center align-middle"><?=$key['Quantity']?></th>
														<th scope="row" style="width: 15%;" class="text-center align-middle"><?=$key['Price']?></th>
														<th scope="row" style="width: 15%;" class="text-center align-middle"><?=$key['Amount']?></th>
														<th scope="row" style="width: 10%;" class="text-center align-middle"><?=$key['Tanggal']?></th>
														<th scope="row" style="width: 10%;" class="text-center align-middle">
															<button Edit="<?=$key['Id']."|".$key['Description']."|".$key['Quantity']."|".$key['Price']."|".$key['Amount']."|".$key['Tanggal']."|".$key['Date']?>" class="btn btn-sm btn-warning Edit"><i class="fa fa-edit"></i></button>
															<button Hapus="<?=$key['Id']?>" class="btn btn-sm btn-danger Hapus"><i class="fa fa-trash"></i></button>
														</th>
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
		<div class="modal fade" id="ModalInput">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
							<div class="row">
                <div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<textarea class="form-control" id="Description" rows="2" placeholder="Description"></textarea>
									</div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Price</b></span>
                    </div>
                    <input type="text" class="form-control" id="Price"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Quantity</b></span>
                    </div>
                    <input type="text" class="form-control" id="Quantity"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Date</b></span>
                    </div>
                    <input type="date" class="form-control" id="Date" value="<?=date('Y-m-d')?>"> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Tutup</b></button>
            <button type="submit" class="btn btn-primary" id="Input"><b>Simpan</b></button>
          </div>
        </div>
      </div>
		</div>
		<div class="modal fade" id="ModalEdit">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
							<div class="row">
                <div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<input type="hidden" class="form-control" id="Id">
										<textarea class="form-control" id="EditDescription" rows="2" placeholder="Description"></textarea>
									</div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Price</b></span>
                    </div>
                    <input type="text" class="form-control" id="EditPrice"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Quantity</b></span>
                    </div>
                    <input type="text" class="form-control" id="EditQuantity"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Date</b></span>
                    </div>
                    <input type="date" class="form-control" id="EditDate"> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Tutup</b></button>
            <button type="submit" class="btn btn-primary" id="Edit"><b>Simpan</b></button>
          </div>
        </div>
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
				$("#Input").click(function() {
					if (isNaN($("#Price").val())) {
						alert('Input Price Belum Benar!')
					} else if (isNaN($("#Quantity").val())) {
						alert('Input Quantity Belum Benar!')
					} else {
						var Data = { Description: $("#Description").val(),
														 Price: $("#Price").val(),
														 Quantity: $("#Quantity").val(),
														 Amount: $("#Price").val()*$("#Quantity").val(),
														 Tanggal: $("#Date").val()}
						$.post(BaseURL+"Admin/Input", Data).done(function(Respon) {
							if (Respon == '1') {
								window.location = BaseURL + "Admin/Pengeluaran"
							} else {
								alert(Respon)
							}
						})
					}
				})

				$(document).on("click",".Edit",function(){
					var Data = $(this).attr('Edit')
					var Pisah = Data.split("|");
					$("#Id").val(Pisah[0])
					$("#EditDescription").val(Pisah[1])
					$("#EditQuantity").val(Pisah[2])
					$("#EditPrice").val(Pisah[3])
					$("#EditAmount").val(Pisah[4])
					$("#EditDate").val(Pisah[5])
					$('#ModalEdit').modal("show")
				})

				$("#Edit").click(function() {
					if (isNaN($("#EditPrice").val())) {
						alert('Input Price Belum Benar!')
					} else if (isNaN($("#EditQuantity").val())) {
						alert('Input Quantity Belum Benar!')
					} else {
						var Data = { Id: $("#Id").val(),
														 Description: $("#EditDescription").val(),
														 Price: $("#EditPrice").val(),
														 Quantity: $("#EditQuantity").val(),
														 Amount: $("#EditPrice").val()*$("#EditQuantity").val(),
														 Tanggal: $("#EditDate").val()}
						$.post(BaseURL+"Admin/Edit", Data).done(function(Respon) {
							if (Respon == '1') {
								window.location = BaseURL + "Admin/Pengeluaran"
							} else {
								alert(Respon)
							}
						})
					}
				})

				$(document).on("click",".Hapus",function(){
					var Hapus = {Id: $(this).attr('Hapus')}
					var Konfirmasi = confirm("Yakin Ingin Menghapus?");
      		if (Konfirmasi == true) {
						$.post(BaseURL+"Admin/Hapus", Hapus).done(function(Respon) {
							if (Respon == '1') {
								window.location = BaseURL + "Admin/Pengeluaran"
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