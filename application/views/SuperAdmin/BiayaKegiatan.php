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
					"lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "All"]],
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