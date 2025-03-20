							<div class="row">
								<div class="col-lg-auto">
									<button type="button" class="btn btn-sm btn-primary border-white mb-2" data-toggle="modal" data-target="#ModalInput"><i class="fa fa-plus"></i><b> Input Kas</b></button>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelKas" class="table table-sm table-bordered bg-light">
											<thead>
												<tr class="bg-danger text-light">
													<th scope="col" class="text-center align-middle">No</th>
													<th scope="col" class="align-middle">Deskripsi</th>
													<th scope="col" class="align-middle">Nominal Kas</th>
													<th scope="col" class="align-middle">Tanggal</th>
													<th scope="col" class="text-center align-middle">Edit</th>
												</tr>
											</thead>
											<tbody>
												<?php $No = 1; foreach ($Kas as $key) { $Date = explode("-",$key['Tanggal']); ?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['Description']?></th>
														<th scope="row" class="align-middle"><?="Rp ".number_format($key['Amount'],0,',','.')?></th>
														<th scope="row" style="width: 10%;" class="align-middle"><?=$Date[2].'-'.$Date[1].'-'.$Date[0]?></th>
														<th scope="row" style="width: 10%;" class="text-center align-middle">
															<button Edit="<?=$key['Id']."|".$key['Description']."|".$key['Amount']."|".$key['Tanggal']?>" class="btn btn-sm btn-warning Edit"><i class="fa fa-edit"></i></button>
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
										<textarea class="form-control" id="Description" rows="2" placeholder="Deskripsi / Keterangan"></textarea>
									</div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Nominal</b></span>
                    </div>
                    <input type="text" class="form-control" id="Price" placeholder="Input Hanya Angka"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Tanggal</b></span>
                    </div>
                    <input type="date" class="form-control" id="Date" value="<?=date('Y-m-d')?>"> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><b>Tutup</b></button>
						<button type="button" class="btn btn-primary" id="Input"><b>Simpan&nbsp;<div id="LoadingInput" class="spinner-border spinner-border-sm text-white" role="status" style="display: none;"></div></b></button>
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
										<textarea class="form-control" id="EditDescription" rows="2" placeholder="Deskripsi / Keterangan"></textarea>
									</div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Nominal</b></span>
                    </div>
                    <input type="text" class="form-control" id="EditPrice" placeholder="Input Hanya Angka"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Tanggal</b></span>
                    </div>
                    <input type="date" class="form-control" id="EditDate" value="<?=date('Y-m-d')?>"> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Tutup</b></button>
            <button type="button" class="btn btn-primary" id="Edit"><b>Simpan&nbsp;<div id="LoadingEdit" class="spinner-border spinner-border-sm text-white" role="status" style="display: none;"></div></b></button>
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
					"bInfo" : true,
					"lengthMenu": [[7, 30, 50, -1], [7, 30, 50, "All"]],
					"language": {
						"paginate": {
							'previous': '<b class="text-white"><</b>',
							'next': '<b class="text-white">></b>'
						}
					}
				})
				
				$("#Input").click(function() {
					if (isNaN($("#Price").val()) || $("#Price").val() == "") {
						alert('Input Nominal Belum Benar!')
					} else {
						var Konfirmasi = confirm("Apakah Data Yang Di Input Sudah Benar?"); 
            if (Konfirmasi == true) {
              $("#Input").attr("disabled", true); 
              $("#LoadingInput").show();                             
							var Data = { Description: $("#Description").val(),
													 Amount: $("#Price").val(),
													 Tanggal: $("#Date").val()
												}
							$.post(BaseURL+"Admin/InputPendapatanKas", Data).done(function(Respon) {
								if (Respon == '1') {
									window.location = BaseURL + "Admin/PendapatanKas"
								} else {
                  alert(Respon)
                  $("#Input").attr("disabled", false); 
                  $("#LoadingInput").hide();                             
                }
							})
						}
					}
				})

				$(document).on("click",".Edit",function(){
					var Data = $(this).attr('Edit')
					var Pisah = Data.split("|");
					$("#Id").val(Pisah[0])
					$("#EditDescription").val(Pisah[1])
					$("#EditPrice").val(Pisah[2])
					$("#EditDate").val(Pisah[3])
					$('#ModalEdit').modal("show")
				})

				$("#Edit").click(function() {
					if (isNaN($("#EditPrice").val()) || $("#EditPrice").val() == "") {
						alert('Input Nominal Belum Benar!')
					} else {
						var Konfirmasi = confirm("Apakah Data Yang Di Edit Sudah Benar?"); 
            if (Konfirmasi == true) {
              $("#Edit").attr("disabled", true); 
              $("#LoadingEdit").show();                             
							var Data = { Id: $("#Id").val(),
													Description: $("#EditDescription").val(),
													Amount: $("#EditPrice").val(),
													Tanggal: $("#EditDate").val() }
							$.post(BaseURL+"Admin/EditPendapatanKas", Data).done(function(Respon) {
								if (Respon == '1') {
									window.location = BaseURL + "Admin/PendapatanKas"
								} else {
                  alert(Respon)
                  $("#Edit").attr("disabled", false); 
                  $("#LoadingEdit").hide();                             
                }
							})
						}
					}
				})

				$(document).on("click",".Hapus",function(){
					var Hapus = {Id: $(this).attr('Hapus')}
					var Konfirmasi = confirm("Yakin Ingin Menghapus?");
      		if (Konfirmasi == true) {
						$.post(BaseURL+"Admin/HapusPendapatanKas", Hapus).done(function(Respon) {
							if (Respon == '1') {
								window.location = BaseURL + "Admin/PendapatanKas"
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