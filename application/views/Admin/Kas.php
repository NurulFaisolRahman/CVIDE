							<div class="row">
								<div class="col-lg-auto">
									<button type="button" class="btn btn-sm btn-primary border-white mb-2" data-toggle="modal" data-target="#ModalInput"><i class="fa fa-plus"></i><b> Input</b></button>
								</div>
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
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelKas" class="table table-sm table-bordered bg-light">
											<thead>
												<tr class="bg-danger text-light">
													<th scope="col" style="width: 4%;" class="text-center align-middle">No</th>
													<th scope="col" class="align-middle">Description</th>
													<th scope="col" style="width: 7%;" class="text-center align-middle">Quantity</th>
													<th scope="col" class="text-center align-middle">Price</th>
													<th scope="col" class="text-center align-middle">Debit</th>
													<th scope="col" class="text-center align-middle">Kredit</th>
													<th scope="col" class="text-center align-middle">Date</th>
													<th scope="col" class="text-center align-middle">Edit</th>
												</tr>
											</thead>
											<tbody>
												<?php $No = 1; foreach ($Kas as $key) { $Date = explode("-",$key['Tanggal'])?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['Description']?></th>
														<th scope="row" class="text-center align-middle"><?=$key['Quantity']?></th>
														<th scope="row" style="width: 15%;" class="text-center align-middle"><?="Rp ".number_format($key['Price'],0,',','.')?></th>
														<th scope="row" style="width: 15%;" class="text-center align-middle"><?=$key['Jenis'] == 'IN' ? "Rp ".number_format($key['Amount'],0,',','.') : '';?></th>
														<th scope="row" style="width: 15%;" class="text-center align-middle"><?=$key['Jenis'] == 'OUT' ? "Rp ".number_format($key['Amount'],0,',','.') : '';?></th>
														<th scope="row" style="width: 10%;" class="text-center align-middle"><?=$Date[2].'-'.$Date[1].'-'.$Date[0]?></th>
														<th scope="row" style="width: 10%;" class="text-center align-middle">
															<button Edit="<?=$key['Id']."|".$key['Description']."|".$key['Quantity']."|".$key['Price']."|".$key['Amount']."|".$key['Tanggal']."|".$key['Jenis']?>" class="btn btn-sm btn-warning Edit"><i class="fa fa-edit"></i></button>
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
								<div class="col-sm-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Quantity</b></span>
                    </div>
                    <input type="text" class="form-control" id="Quantity"> 
                  </div>
								</div>
								<div class="col-sm-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
											&nbsp;<div class="input-group-text bg-danger text-white font-weight-bold">
												<input type="radio" name="Jenis" value="OUT" checked>&nbsp;OUT
											</div>
											&nbsp;<div class="input-group-text bg-danger text-white font-weight-bold">
												<input type="radio" name="Jenis" value="IN">&nbsp;IN
											</div>
										</div>
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
											<span class="input-group-text bg-primary text-white"><b>Jenis</b></span>
												&nbsp;<div class="input-group-text bg-danger text-white font-weight-bold">
													<input type="radio" name="EditJenis" id="OUT" value="OUT" checked>&nbsp;OUT
												</div>
												&nbsp;<div class="input-group-text bg-danger text-white font-weight-bold">
													<input type="radio" name="EditJenis" id="IN" value="IN">&nbsp;IN
												</div>
										</div>
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
                      <span class="input-group-text bg-primary text-white"><b>Price</b></span>
                    </div>
                    <input type="text" class="form-control" id="EditPrice"> 
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
						window.location = BaseURL + "Admin/ExcelKas/" +$("#From").val()+"/"+$("#To").val()
					}
				})
				
				$("#Input").click(function() {
					if (isNaN($("#Price").val())) {
						alert('Input Price Belum Benar!')
					} else if (isNaN($("#Quantity").val())) {
						alert('Input Quantity Belum Benar!')
					} else {
						var Data = { Description: $("#Description").val(),
												 Jenis: $("input[name='Jenis']:checked").val(),
												 Price: $("#Price").val(),
												 Quantity: $("#Quantity").val(),
												 Amount: $("#Price").val()*$("#Quantity").val(),
												 Tanggal: $("#Date").val()
											 }
						$.post(BaseURL+"Admin/Input", Data).done(function(Respon) {
							if (Respon == '1') {
								window.location = BaseURL + "Admin/Kas"
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
					Pisah[6] == 'IN' ? $("#IN").prop("checked", true) : $("#OUT").prop("checked", true); 
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
														 Jenis: $("input[name='EditJenis']:checked").val(),
														 Price: $("#EditPrice").val(),
														 Quantity: $("#EditQuantity").val(),
														 Amount: $("#EditPrice").val()*$("#EditQuantity").val(),
														 Tanggal: $("#EditDate").val()}
						$.post(BaseURL+"Admin/Edit", Data).done(function(Respon) {
							if (Respon == '1') {
								window.location = BaseURL + "Admin/Kas"
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
								window.location = BaseURL + "Admin/Kas"
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