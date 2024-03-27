							<div class="row mt-1">
								<div class="col-lg-auto col-sm-12">
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<label class="input-group-text bg-warning text-white"><b>PIC Project</b></label>
										</div>
										<select class="custom-select custom-select-sm" id="PIC">                    
												<option value="Rizka">Rizka</option>
												<option value="Rifta">Rifta</option>
												<option value="Noven">Noven</option>
												<option value="Linda">Linda</option>
										</select>
										<div class="input-group-prepend">
											<label class="input-group-text bg-primary text-white" id="Lihat"><b>Lihat</b></label>
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
			})
		</script>
  </body>
</html>