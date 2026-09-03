							<br>
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelPendapatan" class="table table-sm table-bordered bg-light">
											<thead>
												<tr style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
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
															if (!empty($Kegiatan)) {
																foreach ($Kegiatan as $k) {
																	if (isset($k['Id'], $k['NamaKegiatan'])) {
																		$NamaKegiatan[$k['Id']] = $k['NamaKegiatan'];
																	}
																}
															}
															$No = 1; foreach ($Biaya as $key) { 
																$TanggalFormat = '-';
																if (!empty($key['Tanggal'])) {
																	$TanggalParts = explode("-", $key['Tanggal']);
																	if (count($TanggalParts) === 3) {
																		$TanggalFormat = $TanggalParts[2].'-'.$TanggalParts[1].'-'.$TanggalParts[0];
																	}
																}
																$kegiatanText = (isset($key['IdKegiatan']) && isset($NamaKegiatan[$key['IdKegiatan']])) 
																	? $NamaKegiatan[$key['IdKegiatan']] 
																	: (!empty($key['IdKegiatan']) ? 'Kegiatan (ID: '.$key['IdKegiatan'].')' : '-');
																$jenisText = (isset($key['JenisPengeluaran']) && isset($JenisPengeluaran[$key['JenisPengeluaran']])) 
																	? $JenisPengeluaran[$key['JenisPengeluaran']] 
																	: '-';
																$subText = (isset($key['JenisPengeluaran'], $key['SubPengeluaran']) && isset($SubPengeluaran[$key['JenisPengeluaran']][$key['SubPengeluaran']])) 
																	? $SubPengeluaran[$key['JenisPengeluaran']][$key['SubPengeluaran']] 
																	: '-';
															?>
													<tr>
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<th scope="row" class="align-middle"><?=$key['Deskripsi']?></th>
														<th scope="row" class="align-middle"><?=$kegiatanText?></th>
														<th scope="row" class="align-middle"><?=$jenisText?></th>
														<th scope="row" class="align-middle"><?=$subText?></th>
														<th scope="row" class="align-middle font-weight-bold" style="color: #e53935;"><?="Rp ".number_format($key['NominalPengeluaran'],0,',','.')?></th>
														<th scope="row" class="align-middle"><?=$TanggalFormat?></th>
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
							'previous': '<i class="fa fa-chevron-left"></i>',
                    		'next': '<i class="fa fa-chevron-right"></i>'
						}
					}
				})
			})
		</script>
  </body>
</html>