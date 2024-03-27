							<div class="row mt-1">
								<div class="col-lg-auto col-sm-12">
									<button type="button" class="btn btn-sm btn-primary border-white mb-2" data-toggle="modal" data-target="#ModalInput"><i class="fa fa-plus"></i><b> INPUT PROJECT</b></button>
								</div>
								<div class="col-lg-auto col-sm-12">
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<label class="input-group-text bg-warning text-white"><b>PIC PROJECT</b></label>
										</div>
										<select class="custom-select custom-select-sm" id="PIC">                    
												<option value="Rizka">Rizka</option>
												<option value="Rifta">Rifta</option>
												<option value="Noven">Noven</option>
												<option value="Linda">Linda</option>
										</select>
										<div class="input-group-prepend">
											<label class="input-group-text bg-primary text-white" id="Lihat"><b>LIHAT</b></label>
										</div>
									</div>
								</div>
								<div class="col-lg-auto col-sm-12">
									<button type="button" class="btn btn-sm btn-danger border-white mb-2" id="Unduh"><i class="fa fa-file-excel-o"></i><b> MATRIKULASI</b></button>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table class="table table-sm table-bordered bg-light">
											<thead>
												<tr class="bg-danger text-light">
													<th scope="col" class="text-center align-middle">No</th>
													<th scope="col" class="align-middle">Nama Project</th>
													<th scope="col" class="align-middle">PIC Project</th>
													<th scope="col" class="align-middle">Bulan Project</th>
													<th scope="col" class="align-middle">Yang Harus Dibayarkan</th>
													<th scope="col" class="align-middle">Yang Telah Dibayarkan</th>
													<th scope="col" class="align-middle">Keterangan</th>
													<th scope="col" class="text-center align-middle">Edit Data</th>
												</tr>
											</thead>
											<tbody>
												<?php $No = 1; foreach ($Matrikulasi as $key) { 
													$PIC = explode(" ",$key['PIC']); 
													$Nilai = explode(" ",$key['Nilai']);
													$Bayar = explode(" ",$key['Bayar']);
													$Beban = explode(" ",$key['Beban']); 
													$I = count($PIC);
												?>
													<tr>
														<td rowspan="<?=$I?>" class="text-center align-middle"><?=$No++?></td>
														<td rowspan="<?=$I?>" class="align-middle"><?=$key['Nama']?></td>
														<td class="align-middle"><?=$PIC[0]?></td>
														<td rowspan="<?=$I?>" class="align-middle"><?=$key['Bulan']?></td>
														<td class="align-middle"><?=number_format($Nilai[0],0,',','.')?></td>
														<td class="align-middle"><?=number_format($Bayar[0],0,',','.')?></td>
														<td rowspan="<?=$I?>" class="align-middle"><?=$key['Keterangan']?></td>
														<td rowspan="<?=$I?>" style="widtd: 10%;" class="text-center align-middle">
															<button Edit="<?=$key['Id']."|".$key['Nama']."|".$key['PIC']."|".$key['Bulan']."|".$key['Nilai']."|".$key['Bayar']."|".$key['Keterangan']."|".$key['Beban']?>" class="btn btn-sm btn-warning Edit"><i class="fa fa-edit"></i></button>
															<!-- <button Hapus="<?=$key['Id']?>" class="btn btn-sm btn-danger Hapus"><i class="fa fa-trash"></i></button> -->
														</td>
													</tr>
												<?php for ($i=1; $i < $I; $i++) { ?>
													<tr>
														<td class="align-middle"><?=$PIC[$i]?></td>
														<td class="align-middle"><?=number_format($Nilai[$i],0,',','.')?></td>
														<td class="align-middle"><?=number_format($Bayar[$i],0,',','.')?></td>
													</tr>
												<?php }} ?>  
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
                    <input type="text" class="form-control" id="Nama"> 
                  </div>
								</div>
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<div class="input-group-prepend">
											<label class="input-group-text bg-primary text-white"><b>PIC Project</b></label>
										</div>
										<?php $PIC = array('Rizka','Rifta','Noven','Linda'); ?>
										<?php for ($j=0; $j < count($PIC); $j++) { ?>
											<div class="form-check ml-2 mt-1">
												<input class="form-check-input" type="checkbox" value="<?=$PIC[$j]?>" name="PIC" id="<?=$PIC[$j]?>">
												<label class="form-check-label" for="<?=$PIC[$j]?>"><b><?=$PIC[$j]?></b></label>
											</div>
										<?php } ?>
									</div>
								</div> 
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Bulan Project</b></span>
                    </div>
                    <input type="text" class="form-control" id="Bulan"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Harus Dibayarkan</b></span>
                    </div>
                    <input type="text" class="form-control" id="Nilai"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Telah Dibayarkan</b></span>
                    </div>
                    <input type="text" class="form-control" id="Bayar"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Dibayarkan Bulan</b></span>
                    </div>
                    <input type="text" class="form-control" id="Keterangan"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Beban Project</b></span>
                    </div>
                    <input type="text" class="form-control" id="Beban"> 
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
                    <input type="hidden" class="form-control" id="Id"> 
                    <input type="text" class="form-control" id="_Nama"> 
                  </div>
								</div>
								<div class="col-sm-12">
									<div class="input-group input-group-sm mb-1">
										<div class="input-group-prepend">
											<label class="input-group-text bg-primary text-white"><b>PIC Project</b></label>
										</div>
										<?php $PIC = array('Rizka','Rifta','Noven','Linda'); ?>
										<?php for ($j=0; $j < count($PIC); $j++) { ?>
											<div class="form-check ml-2 mt-1">
												<input class="form-check-input" type="checkbox" value="<?=$PIC[$j]?>" name="_PIC" id="_<?=$PIC[$j]?>">
												<label class="form-check-label" for="_<?=$PIC[$j]?>"><b><?=$PIC[$j]?></b></label>
											</div>
										<?php } ?>
									</div>
								</div> 
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Bulan Project</b></span>
                    </div>
                    <input type="text" class="form-control" id="_Bulan"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Harus Dibayarkan</b></span>
                    </div>
                    <input type="text" class="form-control" id="_Nilai"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Telah Dibayarkan</b></span>
                    </div>
                    <input type="text" class="form-control" id="_Bayar"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Dibayarkan Bulan</b></span>
                    </div>
                    <input type="text" class="form-control" id="_Keterangan"> 
                  </div>
								</div>
								<div class="col-sm-12">
                  <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white"><b>Beban Project</b></span>
                    </div>
                    <input type="text" class="form-control" id="_Beban"> 
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
		<div class="modal fade" id="ModalPIC">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-light">
          <div class="modal-body bg-success">
            <div class="container">
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelPIC" class="table tab-bordered text-white">
											
										</div>
									</div>
								</div>
              </div>
            </div>
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

				$("#Unduh").click(function() {
					window.location = BaseURL + "IDE/ExcelMatrikulasi/"
				}) 

				$("#Lihat").click(function() {
					$.post(BaseURL+"IDE/LihatMatrikulasi", {PIC : $("#PIC").val()}).done(function(Respon) {
							$('#TabelPIC').html(Respon)
							$('#ModalPIC').modal("show")
						})
				})
				
				$("#Input").click(function() {
					if ($("#Nama").val() == '') {
						alert('Input Nama Project Kosong!')
					} else if (!$("#Rizka").is(':checked') && !$("#Rifta").is(':checked') && !$("#Noven").is(':checked') && !$("#Linda").is(':checked')) {
          	alert('Belum Input PIC!')
        	} else if ($("#Bulan").val() == '') {
						alert('Belum Input Bulan Project!')
					} else if ($("#Nilai").val() == '') {
						alert('Belum Input Jumlah Yang Harus Dibayarkan!')
					} else if ($("#Bayar").val() == '') {
						alert('Belum Input Jumlah Yang Telah Dibayarkan!')
					} else if ($("#Keterangan").val() == '') {
						alert('Belum Input Dibayarkan Bulan!')
					} else if ($("#Beban").val() == '') {
						alert('Belum Input Beban Project!')
					} else {
						var A = []
            $.each($("input[name='PIC']:checked"), function(){
              A.push($(this).val())
            })
            var PIC = A.join(" ");
						var Data = { Nama: $("#Nama").val(),
												 PIC: PIC,
												 Bulan: $("#Bulan").val(),
												 Nilai: $("#Nilai").val(),
												 Bayar: $("#Bayar").val(),
												 Keterangan: $("#Keterangan").val(),
												 Beban: $("#Beban").val()
												}
						$.post(BaseURL+"Admin/InputMatrikulasi", Data).done(function(Respon) {
							if (Respon == '1') {
								window.location = BaseURL + "Admin/Matrikulasi"
							} else {
								alert(Respon)
							}
						})
					}
				})

				$(document).on("click",".Edit",function(){
					var Data = $(this).attr('Edit')
					var Pisah = Data.split("|");
					var PIC = Pisah[2].split(" ");
					$("#Id").val(Pisah[0])
					$("#_Nama").val(Pisah[1])
					for (let i = 0; i < PIC.length; i++) {
						$("#_"+PIC[i]).attr('checked', true);
					}
					$("#_Bulan").val(Pisah[3])
					$("#_Nilai").val(Pisah[4])
					$("#_Bayar").val(Pisah[5])
					$("#_Keterangan").val(Pisah[6])
					$("#_Beban").val(Pisah[7])
					$('#ModalEdit').modal("show")
				})

				$("#Edit").click(function() {
					if ($("#_Nama").val() == '') {
						alert('Input Nama Project Kosong!')
					} else if (!$("#_Rizka").is(':checked') && !$("#_Rifta").is(':checked') && !$("#_Noven").is(':checked') && !$("#_Linda").is(':checked')) {
          	alert('Belum Input PIC!')
        	} else if ($("#_Bulan").val() == '') {
						alert('Belum Input Bulan Project!')
					} else if ($("#_Nilai").val() == '') {
						alert('Belum Input Jumlah Yang Harus Dibayarkan!')
					} else if ($("#_Bayar").val() == '') {
						alert('Belum Input Jumlah Yang Telah Dibayarkan!')
					} else if ($("#_Keterangan").val() == '') {
						alert('Belum Input Dibayarkan Bulan!')
					} else if ($("#_Beban").val() == '') {
						alert('Belum Input Beban Project!')
					} else {
						var A = []
            $.each($("input[name='_PIC']:checked"), function(){
              A.push($(this).val())
            })
            var PIC = A.join(" ");
						var Data = { Id: $("#Id").val(),
												 Nama: $("#_Nama").val(),
												 PIC: PIC,
												 Bulan: $("#_Bulan").val(),
												 Nilai: $("#_Nilai").val(),
												 Bayar: $("#_Bayar").val(),
												 Keterangan: $("#_Keterangan").val(),
												 Beban: $("#_Beban").val()
												}
						$.post(BaseURL+"Admin/EditMatrikulasi", Data).done(function(Respon) {
							if (Respon == '1') {
								window.location = BaseURL + "Admin/Matrikulasi"
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