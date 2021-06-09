							<div class="row">
								<div class="col-lg-auto">
									<button type="button" class="btn btn-primary border-white mb-2" data-toggle="modal" data-target="#ModalInput"><i class="fa fa-plus"></i><b> Input</b></button>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelProject" class="table table-sm table-bordered bg-light">
											<thead>
												<tr class="bg-danger text-light">
													<th scope="col" style="width: 4%;" class="text-center align-middle">No</th>
													<th scope="col" class="align-middle">Nama Project</th>
													<th scope="col" class="text-center align-middle">Deadline Project</th>
													<th scope="col" class="text-center align-middle">Catatan</th>
													<th scope="col" class="text-center align-middle">Edit</th>
												</tr>
											</thead>
											<tbody id="RekapSurvei">
												<?php $No = 1; foreach ($Project as $key) { $Deadline = explode("|",$key['Deadline']); $From = explode("-",$Deadline[0]); $To = explode("-",$Deadline[1]); $PisahPJ = explode("|",$key['PJ']); $Pj = ""; for ($i=0; $i < count($PisahPJ); $i++) { $Pj .= (ucfirst($PisahPJ[$i]).' '); } ?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['NamaProject']?></th>
														<th scope="row" class="text-center align-middle"><?=$From[2].'-'.$From[1].'-'.$From[0].' => '.$To[2].'-'.$To[1].'-'.$To[0]?></th>
														<th scope="row" class="text-center align-middle"><?=$key['Catatan']?></th>
														<th scope="row" class="text-center align-middle">
															<button Edit="<?=$key['Id']."$".$key['NamaProject']."$".$key['Deadline']."$".$key['Catatan']."$".$key['File']?>" class="btn btn-sm btn-warning Edit"><i class="fa fa-edit"></i></button>
															<button Hapus="<?=$key['Id']."$".$key['File']?>" class="btn btn-sm btn-danger Hapus"><i class="fa fa-trash"></i></button>
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
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
							<div class="row">
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Nama Project</b></span>
                    </div>
                    <input type="text" class="form-control" id="NamaProject"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Deadline</b></span>
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
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<span class="input-group-text bg-primary text-white"><b>Catatan</b></span>
										<textarea class="form-control" id="Catatan" rows="2"></textarea>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<div class="input-group-prepend">
											<span class="input-group-text bg-primary text-white"><b>File</b></span>
										</div>
										<input class="form-control" type="file" id="File">
									</div>
								</div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
						<button type="submit" class="btn btn-primary" id="Input"><b>Simpan</b></button>
						<div id="LoadingInput" class="spinner-border text-success" role="status" style="display: none;"></div>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Tutup</b></button>
          </div>
        </div>
      </div>
		</div>
		<div class="modal fade" id="ModalEdit">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
						<div class="row">
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Nama Project</b></span>
                    </div>
                    <input type="text" class="form-control" id="EditNamaProject"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Deadline</b></span>
										</div>
										<div class="input-group-prepend">
                      <span class="input-group-text bg-danger text-white"><b>From</b></span>
                    </div>
										<input type="date" class="form-control" id="EditFrom" value="<?=date('Y-m-d')?>"> 
										<div class="input-group-prepend">
                      <span class="input-group-text bg-danger text-white"><b>To</b></span>
                    </div>
                    <input type="date" class="form-control" id="EditTo" value="<?=date('Y-m-d')?>"> 
                  </div>
								</div>
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<span class="input-group-text bg-primary text-white"><b>Catatan</b></span>
										<textarea class="form-control" id="EditCatatan" rows="2"></textarea>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<div class="input-group-prepend">
											<span class="input-group-text bg-primary text-white"><b>File</b></span>
										</div>
										<input class="form-control" type="file" id="EditFile">
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
				$('#TabelProject').DataTable( {
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
					var fd = new FormData()
					fd.append("File",$('#File')[0].files[0])
					fd.append('NamaProject',$("#NamaProject").val())
					fd.append('Deadline',$("#From").val()+'|'+$("#To").val())
					fd.append('Catatan',$("#Catatan").val())
					$.ajax({
						url: BaseURL+'Staf/Input',
						type: 'post',
						data: fd,
						contentType: false,
						processData: false,
						beforeSend: function(){
							$("#LoadingInput").show();
						},
						success: function(Respon){
							if (Respon == '1') {
								window.location = BaseURL + "Staf/Project"
							}
							else {
								alert(Respon)
								$("#LoadingInput").hide();
							}
						}
					})
				})

				$(document).on("click",".Edit",function(){
					var Data = $(this).attr('Edit')
					var Pisah = Data.split("$")
					var Deadline = Pisah[2].split("|")
					var Pj = Pisah[3].split("|")
					$("#Id").val(Pisah[0])
					$("#EditNamaProject").val(Pisah[1])
					$("#EditFrom").val(Deadline[0])
					$("#EditTo").val(Deadline[1])
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
						$.post(BaseURL+"Staf/Edit", Data).done(function(Respon) {
							if (Respon == '1') {
								window.location = BaseURL + "Staf/Project"
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
						$.post(BaseURL+"Staf/Hapus", Hapus).done(function(Respon) {
							if (Respon == '1') {
								window.location = BaseURL + "Staf/Project"
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