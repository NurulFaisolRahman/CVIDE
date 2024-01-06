							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelProject" class="table table-sm table-bordered bg-light">
											<thead>
												<tr class="bg-danger text-light">
													<th scope="col" style="width: 4%;" class="text-center align-middle">No</th>
													<th scope="col" class="align-middle">PJ Project</th>
													<th scope="col" class="align-middle">Nama Project</th>
													<th scope="col" style="width: 15%;" class="text-center align-middle">Deadline Project</th>
													<th scope="col" style="width: 35%;" class="align-middle">Catatan</th>
													<th scope="col" style="width: 12%;" class="text-center align-middle">File</th>
												</tr>
											</thead>
											<tbody id="RekapSurvei">
												<?php $No = 1; foreach ($Project as $key) { $Deadline = explode("|",$key['Deadline']); $From = explode("-",$Deadline[0]); $To = explode("-",$Deadline[1]); $PisahPJ = explode("|",$key['PJ']); $Pj = ""; for ($i=0; $i < count($PisahPJ); $i++) { $Pj .= (ucfirst($PisahPJ[$i]).' '); } ?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['PJ']?></th>
														<th scope="row" class="align-middle"><?=$key['NamaProject']?></th>
														<th scope="row" class="text-center align-middle"><?=$From[2].'-'.$From[1].'-'.$From[0].' => '.$To[2].'-'.$To[1].'-'.$To[0]?></th>
														<th scope="row" class="align-middle"><?=$key['Catatan']?></th>
														<th scope="row" class="text-center align-middle">
															<?php if (!empty($key['File'])) { ?>
																<button LihatProject="<?=base_url('Project/'.$key['File'])?>" class="btn btn-sm btn-danger LihatProject"><i class="fa fa-file-pdf"></i></button>
															<?php } ?>
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
		<div class="modal fade" id="ModalProject">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-body">
            <embed id="PathProject" src="" type="application/pdf" width="100%" height="520"/>
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
					"lengthMenu": [[7, 30, 50, -1], [7, 30, 50, "All"]],
					"language": {
						"paginate": {
							'previous': '<b class="text-white"><</b>',
							'next': '<b class="text-white">></b>'
						}
					}
				})

				$(document).on("click",".LihatProject",function(){
					var Path = $(this).attr('LihatProject')
          $('#PathProject').attr('src',Path)		
          $('#ModalProject').modal("show")
				})
			})
		</script>
  </body>
</html>