							<br>
							<div class="row">
								<div class="col-lg-auto">
									<button type="button" class="btn btn-primary border-white mb-2" data-toggle="modal" data-target="#ModalInput"><i class="fa fa-plus"></i><b> Input</b></button>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelPortfolio" class="table table-sm table-bordered bg-light">
											<thead>
												 <tr style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
													<th scope="col" style="width: 4%;" class="text-center align-middle">No</th>
													<th scope="col" class="align-middle">Title</th>
													<th scope="col" style="width: 15%;" class="align-middle">Category</th>
													<th scope="col" style="width: 20%;" class="align-middle">Client</th>
													<th scope="col" style="width: 15%;" class="align-middle">Date</th>
													<th scope="col" style="width: 10%;" class="text-center align-middle">Edit</th>
												</tr>
											</thead>
											<tbody id="RekapSurvei">
												<?php $No = 1; foreach ($Portfolio as $key) { ?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['Judul']?></th>
														<th scope="row" class="align-middle"><?=$key['Kategori']?></th>
														<th scope="row" class="align-middle"><?=$key['Klien']?></th>
														<th scope="row" class="align-middle"><?=$key['Tanggal']?></th>
														<th scope="row" class="text-center align-middle">
															<button Edit="<?=$key['Id']."$".$key['Judul']."$".$key['Kategori']."$".$key['Klien']."$".$key['Tanggal']."$".$key['Thumbnail']?>" class="btn btn-sm btn-warning Edit"><i class="fa fa-edit"></i></button>
															<button Hapus="<?=$key['Id']."$".$key['Thumbnail']?>" class="btn btn-sm btn-danger Hapus"><i class="fa fa-trash"></i></button>
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
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
							<div class="row">
								<div class="col-sm-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Thumbnail</b></span>
                    </div>
                    <input type="file" class="form-control" id="Thumbnail"> 
                  </div>
								</div>
								<div class="col-sm-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Date</b></span>
                    </div>
                    <input type="text" class="form-control" id="Tanggal"> 
                  </div>
								</div>
								<div class="col-sm-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Category</b></span>
                    </div>
                    <select class="custom-select" id="Kategori">
                      <option value="Economic Development">Economic Development</option>
											<option value="Fiscal & Public Policy">Fiscal & Public Policy</option>
											<option value="Regional Planning">Regional Planning</option>
											<option value="Manajemen">Manajemen</option>
                    </select>
                  </div>
								</div>
								<div class="col-sm-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Client</b></span>
                    </div>
                    <input type="text" class="form-control" id="Klien"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Title</b></span>
                    </div>
                    <input type="text" class="form-control" id="Judul"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <textarea id="Narasi"></textarea>
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
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
							<div class="row">
								<div class="col-sm-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Thumbnail</b></span>
                    </div>
                    <input type="file" class="form-control" id="EditThumbnail"> 
                  </div>
								</div>
								<div class="col-sm-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Date</b></span>
                    </div>
										<input type="hidden" class="form-control" id="Id"> 
										<input type="hidden" class="form-control" id="ThumbnailLama"> 
                    <input type="text" class="form-control" id="EditTanggal"> 
                  </div>
								</div>
								<div class="col-sm-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Category</b></span>
                    </div>
                    <select class="custom-select" id="EditKategori">
                      <option value="Economic Development">Economic Development</option>
											<option value="Fiscal & Public Policy">Fiscal & Public Policy</option>
											<option value="Regional Planning">Regional Planning</option>
											<option value="Manajemen">Manajemen</option>
                    </select>
                  </div>
								</div>
								<div class="col-sm-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Client</b></span>
                    </div>
                    <input type="text" class="form-control" id="EditKlien"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Title</b></span>
                    </div>
                    <input type="text" class="form-control" id="EditJudul"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <textarea id="EditNarasi"></textarea>
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
		<script src="<?=base_url("assets/summernote/summernote-bs4.min.js")?>"></script>
		<script>
			$(document).ready(function(){
				var BaseURL = '<?=base_url()?>'  
				$('#TabelPortfolio').DataTable( {
					"ordering": true,
					"bInfo" : false,
					"lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "All"]],
					"language": {
						"paginate": {
							'previous': '<i class="fa fa-chevron-left"></i>',
                    		'next': '<i class="fa fa-chevron-right"></i>'
						}
					}
				})

				$('#Narasi').summernote({
					height: 250
				})
				
				$("#Input").click(function() {
					var File = $('#Thumbnail')[0].files[0]
					if (File == undefined) {
						alert("Wajib Input Thumbanil jpg/png !!!")
					} else {
						var FileType = File["type"]
						var ValidImageTypes = ["image/jpg", "image/jpeg", "image/png"]
						if ($.inArray(FileType, ValidImageTypes) < 0) {
							alert("Input Thumbanil Wajib jpg/png !!!")
						} else {
							var fd = new FormData()
							fd.append('Thumbnail',$('#Thumbnail')[0].files[0])
							fd.append('Tanggal',$("#Tanggal").val())
							fd.append('Judul',$("#Judul").val())
							fd.append('Kategori',$("#Kategori").val())
							fd.append("Klien", $('#Klien').val())
							fd.append("Narasi", $('#Narasi').val())
							$.ajax({
								url: BaseURL+'Econk/Input',
								type: 'post',
								data: fd,
								contentType: false,
								processData: false,
								success: function(Respon){
									if (Respon == '1') {
										window.location = BaseURL + "Econk/Portfolio"
									}
									else {
										alert(Respon)
									}
								}
							})
						}	
					}
				})

				$(document).on("click",".Edit",function(){
					var Data = $(this).attr('Edit')
					var Pisah = Data.split("$")
					$("#Id").val(Pisah[0])
					$("#EditJudul").val(Pisah[1])
					$("#EditKategori").val(Pisah[2])
					$("#EditKlien").val(Pisah[3])
					$("#EditTanggal").val(Pisah[4])
					$("#ThumbnailLama").val(Pisah[5])
					$.post(BaseURL+"Econk/GetNarasi/"+Pisah[0]).done(function(Respon) {
						$('#EditNarasi').summernote('code',Respon);
						$("#ModalEdit").modal('show')
					})
				})

				$("#Edit").click(function() {
					var fd = new FormData()
					fd.append('Id',$("#Id").val())
					fd.append('Tanggal',$("#EditTanggal").val())
					fd.append('Judul',$("#EditJudul").val())
					fd.append('Kategori',$("#EditKategori").val())
					fd.append("Klien", $('#EditKlien').val())
					fd.append("Narasi", $('#EditNarasi').val())
					fd.append("ThumbnailLama", $('#ThumbnailLama').val())
					var File = $('#EditThumbnail')[0].files[0]
					if (File != undefined) {
						var FileType = File["type"]
						var ValidImageTypes = ["image/jpg", "image/jpeg", "image/png"]
						if ($.inArray(FileType, ValidImageTypes) < 0) {
							alert("Input Thumbanil Wajib jpg/png !!!")
							$('#EditThumbnail').val("")
							return
						} else {
							fd.append('Thumbnail',$('#EditThumbnail')[0].files[0])
						}	
					}
					$.ajax({
						url: BaseURL+'Econk/Edit',
						type: 'post',
						data: fd,
						contentType: false,
						processData: false,
						success: function(Respon){
							if (Respon == '1') {
								window.location = BaseURL + "Econk/Portfolio"
							}
							else {
								alert(Respon)
							}
						}
					})
				})

				$(document).on("click",".Hapus",function(){
					var Data = $(this).attr('Hapus').split("$")
					var Hapus = { Id: Data[0],
											  Thumbnail: Data[1] }
					var Konfirmasi = confirm("Yakin Ingin Menghapus?");
      		if (Konfirmasi == true) {
						$.post(BaseURL+"Econk/Hapus", Hapus).done(function(Respon) {
							if (Respon == '1') {
								window.location = BaseURL + "Econk/Portfolio"
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