							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelPendapatan" class="table table-sm table-bordered bg-light">
											<thead>
												<tr class="bg-danger text-light">
													<th scope="col" style="width: 3%;" class="text-center align-middle">No</th>
													<th scope="col" style="width: 20%;" class="align-middle">Deskripsi</th>
													<th scope="col" style="width: 20%;" class="align-middle">Kegiatan</th>
													<th scope="col" style="width: 10%;" class="align-middle">Jenis</th>
													<th scope="col" style="width: 15%;" class="align-middle">Sub Jenis</th>
													<th scope="col" style="width: 10%;" class="align-middle">Nominal</th>
													<th scope="col" style="width: 10%;" class="align-middle">Tanggal</th>
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
															$NamaKegiatan = array();
															foreach ($Kegiatan as $key) {
																$NamaKegiatan[$key['Id']] = $key['NamaKegiatan'];
															}
															$No = 1; foreach ($Biaya as $key) { $Tanggal = explode("-",$key['Tanggal']);?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['Deskripsi']?></th>
														<th scope="row" class="align-middle"><?=$NamaKegiatan[$key['IdKegiatan']]?></th>
														<th scope="row" class="align-middle"><?=$JenisPengeluaran[$key['JenisPengeluaran']]?></th>
														<th scope="row" class="align-middle"><?=$SubPengeluaran[$key['JenisPengeluaran']][$key['SubPengeluaran']]?></th>
														<th scope="row" class="align-middle"><?="Rp ".number_format($key['NominalPengeluaran'],0,',','.')?></th>
														<th scope="row" class="align-middle"><?=$Tanggal[2].'-'.$Tanggal[1].'-'.$Tanggal[0]?></th>
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
					"lengthMenu": [[15, 30, 50, -1], [15, 30, 50, "All"]],
					"language": {
						"paginate": {
							'previous': '<b class="text-white"><</b>',
							'next': '<b class="text-white">></b>'
						}
					}
				})
			})
		</script>
  </body>
</html>