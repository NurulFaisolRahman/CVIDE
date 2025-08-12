<br>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table id="TabelPendapatan" class="table table-sm table-striped table-hover" style="border: 1px solid #e3f2fd;">
                <thead>
                    <tr style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
                        <th scope="col" style="width: 3%;" class="text-center align-middle">No</th>
                        <th scope="col" style="width: 25%;" class="align-middle">Nama Kegiatan</th>
                        <th scope="col" style="width: 10%;" class="align-middle">Sumber Kegiatan</th>
                        <th scope="col" style="width: 10%;" class="align-middle">Nominal Kegiatan</th>
                        <th scope="col" style="width: 8%;" class="align-middle">Mulai</th>
                        <th scope="col" style="width: 8%;" class="align-middle">Selesai</th>
                        <th scope="col" style="width: 4%;" class="text-center align-middle">Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $SumberKegiatan = array('','Swakelola Tipe 1','Swakelola Tipe 2','Narasumber','Rekanan','CV IDE PL','CV IDE Tender/Seleksi'); 
                    $No = 1; foreach ($Pendapatan as $key) { 
                        $Mulai = explode("-",$key['Mulai']); 
                        $Selesai = explode("-",$key['Selesai']); ?>
                        <tr style="border-bottom: 1px solid #e3f2fd;">
                            <th scope="row" class="text-center align-middle"><?=$No++?></th>
                            <td class="align-middle"><?=$key['NamaKegiatan']?></td>
                            <td class="align-middle"><?=$SumberKegiatan[$key['SumberKegiatan']]?></td>
                            <td class="align-middle font-weight-bold" style="color: #e53935;"><?="Rp ".number_format($key['NominalKegiatan'],0,',','.')?></td>
                            <td class="align-middle"><?=$Mulai[2].'-'.$Mulai[1].'-'.$Mulai[0]?></td>
                            <td class="align-middle"><?=$Selesai[2].'-'.$Selesai[1].'-'.$Selesai[0]?></td>
                            <td class="text-center align-middle">
                                <button Biaya="<?=$key['Id']?>" class="btn btn-sm btn-info Biaya" style="background-color: #42a5f5; border-color: #fff;">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
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
            "lengthMenu": [[7, 30, 50, -1], [7, 30, 50, "All"]],
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

        $(document).on("click",".Biaya",function(){
            var Data = { Kegiatan: $(this).attr('Biaya') }
            $.post(BaseURL+"Admin/SesiBiaya", Data).done(function(Respon) {
                if (Respon == '1') {
                    window.location = BaseURL + "Admin/BiayaKegiatan"
                }
            })
        })
    })
</script>
</body>
</html>