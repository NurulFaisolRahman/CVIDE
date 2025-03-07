<div class="row">
								<div class="col-lg-12 d-flex justify-content-center">
									<div class="card" style="width: 50%;">
										<input type="hidden" class="form-control" id="IdKegiatan" value="<?=$this->session->userdata('Kegiatan')?>">
										<div class="card-body p-1">
											<div class="table-responsive px-2">
												<table class="table table-sm table-bordered bg-light font-weight-bold mb-0">
													<thead>
														<tr class="text-primary">
															<td>Kegiatan</td>
															<td class="text-wrap"><?=$NamaKegiatan?></td>
														</tr>
														<!-- <tr>
															<td>Total</td>
															<td><?="Rp ".number_format($NominalKegiatan,0,',','.')?></td>
														</tr>
														<tr>
															<td>Charge</td>
															<td><?="Rp ".number_format($Charge,0,',','.')?></td>
														</tr>
														<tr>
															<td>Saving</td>
															<td><?="Rp ".number_format($Saving,0,',','.')?></td>
														</tr>
														<tr>
															<td>Umum</td>
															<td><?="Rp ".number_format($Umum,0,',','.')?></td>
														</tr> -->
														<tr class="text-danger">
															<td>Pengeluaran</td>
															<td><?="Rp ".number_format($Biaya,0,',','.')?></td>
														</tr>
														<tr class="text-primary">
															<td>Saldo</td>
															<td><?="Rp ".number_format($Saldo,0,',','.')?></td>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-auto">
									<button type="button" class="btn btn-sm btn-primary border-white mb-2" data-toggle="modal" data-target="#ModalInput"><i class="fa fa-plus"></i><b> Input Pengeluaran</b></button>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelPendapatan" class="table table-sm table-bordered bg-light">
											<thead>
												<tr class="bg-danger text-light">
													<th scope="col" style="width: 3%;" class="text-center align-middle">No</th>
													<th scope="col" style="width: 20%;" class="align-middle">Deskripsi Pengeluaran</th>
													<th scope="col" style="width: 10%;" class="align-middle">Jenis Pengeluaran</th>
													<th scope="col" style="width: 15%;" class="align-middle">Sub Pengeluaran</th>
													<th scope="col" style="width: 10%;" class="align-middle">Nominal</th>
													<th scope="col" style="width: 10%;" class="align-middle">Tanggal</th>
													<th scope="col" style="width: 7%;" class="text-center align-middle">Edit</th>
												</tr>
											</thead>
											<tbody>
												<?php $JenisPengeluaran = array('','Honor','Perjalanan Dinas','Pajak','Survei','Operasional Kantor'); 
															$SubPengeluaran = array(array(''),
																											array('','PIC Kegiatan','TA Kegiatan','General Manager','Lainnya'),
																											array('','BBM','Tol','Penginapan','Konsumsi','Honor Peserta rapat/FGD','Honor Perjadin TA Kegiatan','Honor Perjadin PIC Kegiatan','Lainnya'),
																											array('','Pajak','Lainnya'),
																											array('','Honor Surveyor','Operasional Survei','Penginapan','Penginapan','Sewa Kendaraan','Lainnya'),
																											array('','Cetak Laporan Kegiatan','Pembelian ATK','Jasa Pengiriman Dokumen Kegiatan','Lainnya')); 
															$No = 1; foreach ($Pengeluaran as $key) { $Tanggal = explode("-",$key['Tanggal']);?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['Deskripsi']?></th>
														<th scope="row" class="align-middle"><?=$JenisPengeluaran[$key['JenisPengeluaran']]?></th>
														<th scope="row" class="align-middle"><?=$SubPengeluaran[$key['JenisPengeluaran']][$key['SubPengeluaran']]?></th>
														<th scope="row" class="align-middle"><?="Rp ".number_format($key['NominalPengeluaran'],0,',','.')?></th>
														<th scope="row" class="align-middle"><?=$Tanggal[2].'-'.$Tanggal[1].'-'.$Tanggal[0]?></th>
														<th scope="row" class="text-center align-middle">
															<button Edit="<?=$key['Id']."|".$key['JenisPengeluaran']."|".$key['SubPengeluaran']."|".$key['NominalPengeluaran']."|".$key['Tanggal']."|".$key['Deskripsi']?>" class="btn btn-sm btn-warning Edit"><i class="fa fa-edit"></i></button> 
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
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Jenis Pengeluaran</b></span>
										</div> 
										<select class="custom-select" id="JenisPengeluaran">  
											<?php  
												for ($i=1; $i < count($JenisPengeluaran); $i++) { ?>
												<option value="<?=$i?>"><?=$JenisPengeluaran[$i]?></option>
											<?php } ?>                  
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Sub Pengeluaran</b></span>
                    </div>
										<select class="custom-select" id="SubPengeluaran">   
											<option value="1">PIC Kegiatan</option>
											<option value="2">TA Kegiatan</option>
											<option value="3">GM Kegiatan</option>              
										</select>
									</div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Nominal Pengeluaran</b></span>
                    </div>
                    <input type="text" class="form-control" id="NominalPengeluaran" placeholder="Input Hanya Angka"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Tanggal Pengeluaran</b></span>
                    </div>
                    <input type="date" class="form-control" id="Tanggal" value="<?=date('Y-m-d')?>"> 
                  </div>
								</div>
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<textarea class="form-control" id="Deskripsi" rows="4" placeholder="Deskripsi"></textarea>
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
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-warning">
          <div class="modal-body">
            <div class="container">
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Jenis Pengeluaran</b></span>
										</div> 
										<input type="hidden" class="form-control" id="Id">
										<select class="custom-select" id="_JenisPengeluaran">  
											<?php  
												for ($i=1; $i < count($JenisPengeluaran); $i++) { ?>
												<option value="<?=$i?>"><?=$JenisPengeluaran[$i]?></option>
											<?php } ?>                  
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Sub Pengeluaran</b></span>
                    </div>
										<select class="custom-select" id="_SubPengeluaran">              
										</select>
									</div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Nominal Pengeluaran</b></span>
                    </div>
                    <input type="text" class="form-control" id="_NominalPengeluaran" placeholder="Input Hanya Angka"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Tanggal Pengeluaran</b></span>
                    </div>
                    <input type="date" class="form-control" id="_Tanggal"> 
                  </div>
								</div>
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<textarea class="form-control" id="_Deskripsi" rows="4" placeholder="Deskripsi"></textarea>
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

				$("#JenisPengeluaran").change(function (){
					var Sub = $("#JenisPengeluaran").val() 
					var List = ''
					if (Sub == 1) {
						List += '<option value="1">PIC Kegiatan</option><option value="2">TA Kegiatan</option><option value="3">GM Kegiatan</option><option value="4">Lainnya</option>'
						$('#SubPengeluaran').html(List)	
					} else if (Sub == 2) {
						List += '<option value="1">BBM</option><option value="2">TOL</option><option value="3">Penginapan</option><option value="4">Konsumsi</option><option value="5">Honor Peserta rapat/FGD</option><option value="6">Honor Perjadin TA Kegiatan</option><option value="7">Honor Perjadin PIC Kegiatan</option><option value="8">Lainnya</option>'
						$('#SubPengeluaran').html(List)	
					} else if (Sub == 3) {
						List += '<option value="1">Pajak</option><option value="2">Lainnya</option>'
						$('#SubPengeluaran').html(List)	
 					} else if (Sub == 4) {
						List += '<option value="1">Honor Surveyor</option><option value="2">Operasional Survei</option><option value="3">Penginapan</option><option value="4">Sewa Kendaraan</option><option value="5">Lainnya</option>'
						$('#SubPengeluaran').html(List)	
					} else if (Sub == 5) {
						List += '<option value="1">Cetak Laporan Kegiatan</option><option value="2">Pembelian ATK</option><option value="3">Jasa Kirim Dokumen Kegiatan</option><option value="4">Lainnya</option>'
						$('#SubPengeluaran').html(List)	
					}
				})

				$("#_JenisPengeluaran").change(function (){
					var Sub = $("#_JenisPengeluaran").val() 
					var List = ''
					if (Sub == 1) {
						List += '<option value="1">PIC Kegiatan</option><option value="2">TA Kegiatan</option><option value="3">GM Kegiatan</option><option value="4">Lainnya</option>'
						$('#_SubPengeluaran').html(List)	
					} else if (Sub == 2) {
						List += '<option value="1">BBM</option><option value="2">TOL</option><option value="3">Penginapan</option><option value="4">Konsumsi</option><option value="5">Honor Peserta rapat/FGD</option><option value="6">Honor Perjadin TA Kegiatan</option><option value="7">Honor Perjadin PIC Kegiatan</option><option value="8">Lainnya</option>'
						$('#_SubPengeluaran').html(List)	
					} else if (Sub == 3) {
						List += '<option value="1">Pajak</option><option value="2">Lainnya</option>'
						$('#_SubPengeluaran').html(List)	
 					} else if (Sub == 4) {
						List += '<option value="1">Honor Surveyor</option><option value="2">Operasional Survei</option><option value="3">Penginapan</option><option value="4">Sewa Kendaraan</option><option value="5">Lainnya</option>'
						$('#_SubPengeluaran').html(List)	
					} else if (Sub == 5) {
						List += '<option value="1">Cetak Laporan Kegiatan</option><option value="2">Pembelian ATK</option><option value="3">Jasa Kirim Dokumen Kegiatan</option><option value="4">Lainnya</option>'
						$('#_SubPengeluaran').html(List)	
					}
				})
				
				$("#Input").click(function() {
					if (isNaN($("#NominalPengeluaran").val()) || $("#NominalPengeluaran").val() == "") {
						alert('Input Nominal Pengeluaran Belum Benar!')
					} else {
						var Konfirmasi = confirm("Apakah Data Yang Di Input Sudah Benar?"); 
            if (Konfirmasi == true) {
              $("#Input").attr("disabled", true); 
              $("#LoadingInput").show();                             
							var Data = { IdKegiatan: $("#IdKegiatan").val(),
													 JenisPengeluaran: $("#JenisPengeluaran").val(),
													 SubPengeluaran: $("#SubPengeluaran").val(),
													 NominalPengeluaran: $("#NominalPengeluaran").val(),
													 Tanggal: $("#Tanggal").val(),
													 Deskripsi: $("#Deskripsi").val()
												}
							$.post(BaseURL+"Admin/InputPengeluaran", Data).done(function(Respon) {
								if (Respon == '1') {
									window.location = BaseURL + "Admin/Pengeluaran"
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
					$("#_JenisPengeluaran").val(Pisah[1])
					var Sub = $("#_JenisPengeluaran").val() 
					var List = ''
					if (Sub == 1) {
						List += '<option value="1">PIC Kegiatan</option><option value="2">TA Kegiatan</option><option value="3">GM Kegiatan</option><option value="4">Lainnya</option>'
						$('#_SubPengeluaran').html(List)	
					} else if (Sub == 2) {
						List += '<option value="1">BBM</option><option value="2">TOL</option><option value="3">Penginapan</option><option value="4">Konsumsi</option><option value="5">Honor Peserta rapat/FGD</option><option value="6">Honor Perjadin TA Kegiatan</option><option value="7">Honor Perjadin PIC Kegiatan</option><option value="8">Lainnya</option>'
						$('#_SubPengeluaran').html(List)	
					} else if (Sub == 3) {
						List += '<option value="1">Pajak</option><option value="2">Lainnya</option>'
						$('#_SubPengeluaran').html(List)	
 					} else if (Sub == 4) {
						List += '<option value="1">Honor Surveyor</option><option value="2">Operasional Survei</option><option value="3">Penginapan</option><option value="4">Sewa Kendaraan</option><option value="5">Lainnya</option>'
						$('#_SubPengeluaran').html(List)	
					} else if (Sub == 5) {
						List += '<option value="1">Cetak Laporan Kegiatan</option><option value="2">Pembelian ATK</option><option value="3">Jasa Kirim Dokumen Kegiatan</option><option value="4">Lainnya</option>'
						$('#_SubPengeluaran').html(List)	
					}
					$("#_SubPengeluaran").val(Pisah[2])
					$("#_NominalPengeluaran").val(Pisah[3])
					$("#_Tanggal").val(Pisah[4])
					$("#_Deskripsi").val(Pisah[5])
					$('#ModalEdit').modal("show")
				})

				$("#Edit").click(function() {
					if (isNaN($("#_NominalPengeluaran").val()) || $("#_NominalPengeluaran").val() == "") {
						alert('Edit Nominal Pengeluaran Belum Benar!')
					} else {
						var Konfirmasi = confirm("Apakah Data Yang Di Edit Sudah Benar?"); 
            if (Konfirmasi == true) {
              $("#Edit").attr("disabled", true); 
              $("#LoadingEdit").show();                             
							var Data = { Id: $("#Id").val(),
													 JenisPengeluaran: $("#_JenisPengeluaran").val(),
													 SubPengeluaran: $("#_SubPengeluaran").val(),
													 NominalPengeluaran: $("#_NominalPengeluaran").val(),
													 Tanggal: $("#_Tanggal").val(),
													 Deskripsi: $("#_Deskripsi").val()
												}
							$.post(BaseURL+"Admin/EditPengeluaran", Data).done(function(Respon) {
								if (Respon == '1') {
									window.location = BaseURL + "Admin/Pengeluaran"
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
					var Konfirmasi = confirm("Data Yang Ingin Dihapus Sudah Benar?");
      		if (Konfirmasi == true) {
						$.post(BaseURL+"Admin/HapusPengeluaran", Hapus).done(function(Respon) {
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