						<br>
							<div class="row">
								<div class="col-lg-auto">
									<div class="input-group input-group-sm mb-2">
										<div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white" style="border: none;"><b>Rekap</b></span>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white" style="border: none;"><b>From</b></span>
                            </div>
                            <input type="date" class="form-control form-control-sm" id="From" value="<?=date('Y-m-d')?>" style="border: 1px solid #bbdefb;"> 
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white" style="border: none;"><b>To</b></span>
                            </div>
                            <input type="date" class="form-control form-control-sm" id="To" value="<?=date('Y-m-d')?>" style="border: 1px solid #bbdefb;">  
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <button type="button" class="btn btn-sm btn-danger mb-2" id="Rekap" style="background: linear-gradient(135deg, #2196F3, #0D47A1); border: 1px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                            <i class="fa fa-file-excel-o mr-1"></i><b> Excel</b>
                        </button>
								</div>
								 <div class="col-12">
                        <div class="d-flex flex-wrap">
                            <div class="mr-2 mb-1 p-1 rounded" style="background: linear-gradient(135deg, #ffb74d, #fb8c00);">
                                <span class="text-white"><b><?="Saldo Bulan Lalu = Rp ".number_format($SaldoLalu,0,',','.')?></b></span>
                            </div>
                            <div class="mr-2 mb-1 p-1 rounded" style="background: linear-gradient(135deg, #2196F3, #0D47A1);">
                                <span class="text-white"><b><?="Pemasukan ".date("F Y")." = Rp ".number_format($InBerjalan,0,',','.')?></b></span>
                            </div>
                            <div class="mr-2 mb-1 p-1 rounded" style="background: linear-gradient(135deg, #e53935, #b71c1c);">
                                <span class="text-white"><b><?="Pengeluaran ".date("F Y")." = Rp ".number_format($OutBerjalan,0,',','.')?></b></span>
                            </div>
                            <div class="mb-1 p-1 rounded" style="background: linear-gradient(135deg, #ffb74d, #fb8c00);">
                                <span class="text-white"><b><?="Saldo Berjalan = Rp ".number_format(($InBerjalan-$OutBerjalan)+$SaldoLalu,0,',','.')?></b></span>
                            </div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="TabelKas" class="table table-sm table-bordered bg-light">
											<thead>
												 <tr style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
													<th scope="col" class="text-center align-middle">No</th>
													<th scope="col" class="align-middle">Deskripsi</th>
													<th scope="col" class="align-middle">Nominal</th>
													<th scope="col" class="align-middle">Debit</th>
													<th scope="col" class="align-middle">Kredit</th>
													<th scope="col" class="text-center align-middle">Tanggal</th>
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
															$No = 1; foreach ($Kas as $key) { $Date = explode("-",$key['Tanggal']); ?>
													 <tr style="border-bottom: 1px solid #e3f2fd;">
														<th scope="row" class="text-center align-middle"><?=$No++?></th>
														<td class="align-middle"><?=isset($key['Description']) ? $key['Description'] : $key['Deskripsi']; ?></td>
														<td class="align-middle font-weight-bold" style="color: #1565c0;"><?=isset($key['Amount']) ? "Rp ".number_format($key['Amount'],0,',','.') : "Rp ".number_format($key['NominalPengeluaran'],0,',','.'); ?></td>
														<td class="align-middle font-weight-bold" style="color: #2e7d32;"><?=isset($key['Jenis']) ? $key['Jenis'] == 'IN' ? "Rp ".number_format($key['Amount'],0,',','.') : '' : ''; ?></td>
														<td class="align-middle font-weight-bold" style="color: #c62828;"><?=isset($key['Jenis']) ? $key['Jenis'] == 'OUT' ? "Rp ".number_format($key['Amount'],0,',','.') : '' : "Rp ".number_format($key['NominalPengeluaran'],0,',','.'); ?></td>
														<td class="text-center align-middle"><?=$Date[2].'-'.$Date[1].'-'.$Date[0]?></td>
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
				$('#TabelKas').DataTable( {
					"ordering": true,
					"bInfo" : true,
					"lengthMenu": [[7, 30, 50, -1], [7, 30, 50, "All"]],
					"language": {
						"paginate": {
							'previous': '<i class="fa fa-chevron-left"></i>',
                    		'next': '<i class="fa fa-chevron-right"></i>'
						}
					}
				})

				$("#Rekap").click(function() {
					if ($("#From").val() == "") {
						alert('Input From Belum Benar!')
					} else if ($("#To").val() == "") {
						alert('Input To Belum Benar!')
					} else {
						window.location = BaseURL + "Admin/ExcelKas/" +$("#From").val()+"/"+$("#To").val()
					}
				})
			})
		</script>
  </body>
</html>