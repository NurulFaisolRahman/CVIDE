							<div class="row">
								<div class="col-lg-auto">
									<button type="button" class="btn btn-sm btn-primary border-white mb-2" data-toggle="modal" data-target="#ModalInput"><i class="fa fa-plus"></i><b> Input Kegiatan</b></button>
								</div>
							</div>
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
													<th scope="col" style="width: 4%;" class="text-center align-middle">Edit</th>
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
														<th scope="row" class="text-center align-middle">
															<button Edit="<?=$key['Id']."|".$key['NamaKegiatan']."|".$key['SumberKegiatan']."|".$key['NominalKegiatan']."|".$key['Mulai']."|".$key['Selesai']."|".$key['DeskripsiKegiatan']?>" class="btn btn-sm btn-warning Edit"><i class="fa fa-edit"></i></button> 
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
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Nama Kegiatan</b></span>
                    </div>
                    <input type="text" class="form-control" id="NamaKegiatan"> 
                  </div>
								</div>
								<div class="col-sm-12 col-xl-6">
									<div class="input-group input-group-sm mb-1">
										<div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Sumber Kegiatan</b></span>
                    </div>
										<select class="custom-select" id="SumberKegiatan">  
											<?php  
												for ($i=1; $i < count($SumberKegiatan); $i++) { ?>
												<option value="<?=$i?>"><?=$SumberKegiatan[$i]?></option>
											<?php } ?>                  
										</select>
									</div>
								</div>
								<div class="col-sm-12 col-xl-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Nominal Kegiatan</b></span>
                    </div>
                    <input type="text" class="form-control" id="NominalKegiatan" placeholder="Input Hanya Angka"> 
                  </div>
								</div>
								<div class="col-sm-12 col-xl-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Tanggal Mulai</b></span>
                    </div>
                    <input type="date" class="form-control" id="Mulai" value="<?=date('Y-m-d')?>"> 
                  </div>
								</div>
								<div class="col-sm-12 col-xl-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Tanggal Selesai</b></span>
                    </div>
                    <input type="date" class="form-control" id="Selesai" value="<?=date('Y-m-d')?>"> 
                  </div>
                </div>
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<textarea class="form-control" id="DeskripsiKegiatan" rows="4" placeholder="Deskripsi serta durasi tanggal pengerjaan kegiatan"></textarea>
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
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
							<div class="row">
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Nama Kegiatan</b></span>
                    </div>
										<input type="text" class="form-control" id="_NamaKegiatan">
										<input type="hidden" class="form-control" id="Id"> 
                  </div>
								</div>
								<div class="col-sm-12 col-xl-6">
									<div class="input-group input-group-sm mb-1">
										<div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Sumber Kegiatan</b></span>
                    </div>
										<select class="custom-select" id="_SumberKegiatan">  
											<?php  
												for ($i=1; $i < count($SumberKegiatan); $i++) { ?>
												<option value="<?=$i?>"><?=$SumberKegiatan[$i]?></option>
											<?php } ?>                  
										</select>
									</div>
								</div>
								<div class="col-sm-12 col-xl-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Nominal Kegiatan</b></span>
                    </div>
                    <input type="text" class="form-control" id="_NominalKegiatan" placeholder="Input Hanya Angka"> 
                  </div>
								</div>
								<div class="col-sm-12 col-xl-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Tanggal Mulai</b></span>
                    </div>
                    <input type="date" class="form-control" id="_Mulai"> 
                  </div>
								</div>
								<div class="col-sm-12 col-xl-6">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Tanggal Selesai</b></span>
                    </div>
                    <input type="date" class="form-control" id="_Selesai"> 
                  </div>
                </div>
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<textarea class="form-control" id="_DeskripsiKegiatan" rows="4" placeholder="Deskripsi serta durasi tanggal pengerjaan kegiatan"></textarea>
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
				
				$("#Input").click(function() {
					if ($("#NamaKegiatan").val() == "") {
						alert('Input Nama Kegiatan Belum Benar!')
					} else if (isNaN($("#NominalKegiatan").val()) || $("#NominalKegiatan").val() == "") {
						alert('Input Nominal Kegiatan Belum Benar!')
					} else {
						var Konfirmasi = confirm("Apakah Data Yang Di Input Sudah Benar?"); 
            if (Konfirmasi == true) {
              $("#Input").attr("disabled", true); 
              $("#LoadingInput").show();                             
							var Data = { NamaKegiatan: $("#NamaKegiatan").val(),
													SumberKegiatan: $("#SumberKegiatan").val(),
													NominalKegiatan: $("#NominalKegiatan").val(),
													Mulai: $("#Mulai").val(),
													Selesai: $("#Selesai").val(),
													DeskripsiKegiatan: $("#DeskripsiKegiatan").val()
												}
							$.post(BaseURL+"Admin/InputPendapatanKegiatan", Data).done(function(Respon) {
								if (Respon == '1') {
									window.location = BaseURL + "Admin/PendapatanKegiatan"
								} else {
                  alert(Respon)
                  $("#Input").attr("disabled", false); 
                  $("#LoadingInput").hide();                             
                }
							})
						} 
					}
				})

				$(document).on("click",".Biaya",function(){
					var Data = { Kegiatan: $(this).attr('Biaya') }
					$.post(BaseURL+"Admin/SesiBiaya", Data).done(function(Respon) {
						if (Respon == '1') {
							window.location = BaseURL + "Admin/Pengeluaran"
						}
					})
				})

				$(document).on("click",".Edit",function(){
					var Data = $(this).attr('Edit')
					var Pisah = Data.split("|");
					$("#Id").val(Pisah[0])
					$("#_NamaKegiatan").val(Pisah[1])
					$("#_SumberKegiatan").val(Pisah[2])
					$("#_NominalKegiatan").val(Pisah[3])
					$("#_Mulai").val(Pisah[4])
					$("#_Selesai").val(Pisah[5])
					$("#_DeskripsiKegiatan").val(Pisah[6])
					$('#ModalEdit').modal("show")
				})

				$("#Edit").click(function() {
					if ($("#_NamaKegiatan").val() == "") {
						alert('Input Nama Kegiatan Belum Benar!')
					} else if (isNaN($("#_NominalKegiatan").val()) || $("#_NominalKegiatan").val() == "") {
						alert('Input Nominal Kegiatan Belum Benar!')
					} else {
						var Konfirmasi = confirm("Apakah Data Yang Di Edit Sudah Benar?"); 
            if (Konfirmasi == true) {
              $("#Input").attr("disabled", true); 
              $("#LoadingEdit").show();                             
							var Data = { Id: $("#Id").val(),
													 NamaKegiatan: $("#_NamaKegiatan").val(),
													 SumberKegiatan: $("#_SumberKegiatan").val(),
													 NominalKegiatan: $("#_NominalKegiatan").val(),
													 Mulai: $("#_Mulai").val(),
													 Selesai: $("#_Selesai").val(),
													 DeskripsiKegiatan: $("#_DeskripsiKegiatan").val()
												}
							$.post(BaseURL+"Admin/EditPendapatanKegiatan", Data).done(function(Respon) {
								if (Respon == '1') {
									window.location = BaseURL + "Admin/PendapatanKegiatan"
								} else {
                  alert(Respon)
                  $("#Edit").attr("disabled", false); 
                  $("#LoadingEdit").hide();                             
                }
							})
						} 
					}
				})
			})
		</script>
  </body>
</html>