<br>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <select class="form-control form-control-sm" id="FilterTahun" onchange="filterByTahun()" style="border: 1px solid #bbdefb;">
                <option value="">Semua Tahun</option>
                <?php foreach ($TahunKas as $tahun) { ?>
                    <option value="<?=$tahun['Tahun']?>" <?= ($this->input->get('tahun') == $tahun['Tahun']) ? 'selected' : '' ?>>
                        <?=$tahun['Tahun']?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="table-responsive">
            <table id="TabelPendapatan" class="table table-sm table-striped table-hover" style="border: 1px solid #e3f2fd;">
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
                    <?php 
                    $JenisPengeluaran = array('','Honor','Perjalanan Dinas','Pajak','Survei','Operasional Kantor'); 
                    $SubPengeluaran = array(
                        array(''),
                        array('','PIC Kegiatan','TA Kegiatan','General Manager','Lainnya'),
                        array('','BBM','Tol','Penginapan','Konsumsi','Honor Peserta rapat/FGD','Honor Perjadin TA Kegiatan','Honor Perjadin PIC Kegiatan','Lainnya'),
                        array('','Pajak','Lainnya'),
                        array('','Honor Surveyor','Operasional Survei','Penginapan','Penginapan','Sewa Kendaraan','Lainnya'),
                        array('','Cetak Laporan Kegiatan','Pembelian ATK','Jasa Pengiriman Dokumen Kegiatan','Lainnya')
                    ); 
                    $NamaKegiatan = array();
                    foreach ($Kegiatan as $key) {
                        $NamaKegiatan[$key['Id']] = $key['NamaKegiatan'];
                    }
                    $No = 1; foreach ($Biaya as $key) { 
                        $Tanggal = explode("-",$key['Tanggal']);
                    ?>
                        <tr style="border-bottom: 1px solid #e3f2fd;">
                            <th scope="row" class="text-center align-middle"><?=$No++?></th>
                            <td class="align-middle"><?=$key['Deskripsi']?></td>
                            <td class="align-middle"><?=$NamaKegiatan[$key['IdKegiatan']]?></td>
                            <td class="align-middle"><?=$JenisPengeluaran[$key['JenisPengeluaran']]?></td>
                            <td class="align-middle"><?=$SubPengeluaran[$key['JenisPengeluaran']][$key['SubPengeluaran']]?></td>
                            <td class="align-middle font-weight-bold" style="color: #e53935;"><?="Rp ".number_format($key['NominalPengeluaran'],0,',','.')?></td>
                            <td class="align-middle"><?=$Tanggal[2].'-'.$Tanggal[1].'-'.$Tanggal[0]?></td>
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
        $('#TabelPendapatan').DataTable({
            "ordering": true,
            "bInfo": true,
            "lengthMenu": [[15, 30, 50, -1], [15, 30, 50, "All"]],
            "language": {
                "paginate": {
                    'previous': '<i class="fa fa-chevron-left"></i>',
                    'next': '<i class="fa fa-chevron-right"></i>'
                }
            },
            "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rt<"row"<"col-sm-6"i><"col-sm-6"p>>',
            "initComplete": function() {
                // Style search input
                $('.dataTables_filter input')
                    .addClass('form-control form-control-sm')
                    .css('width', '200px');
                
                // Style length menu
                $('.dataTables_length')
                    .css('margin-bottom', '10px');
                
                $('.dataTables_length select')
                    .addClass('form-control form-control-sm')
                    .css('width', '80px');
                
                // Style info text
                $('.dataTables_info')
                    .css('padding-top', '8px');
                
                // Style pagination
                $('.dataTables_paginate')
                    .addClass('float-right');
            }
        });
    });

    // Fungsi untuk filter berdasarkan tahun
    function filterByTahun() {
        var selectedTahun = $('#FilterTahun').val();
        var currentUrl = new URL(window.location);
        if (selectedTahun) {
            currentUrl.searchParams.set('tahun', selectedTahun);
        } else {
            currentUrl.searchParams.delete('tahun');
        }
        window.location = currentUrl.toString();
    }
</script>
</body>
</html>