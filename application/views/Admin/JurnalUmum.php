<br>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table id="TabelKas" class="table table-sm table-striped table-hover" style="border: 1px solid #e3f2fd;">
                <thead>
                    <tr style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
                        <th scope="col" class="text-center align-middle">No</th>
                        <th scope="col" class="align-middle">Deskripsi</th>
                        <th scope="col" class="align-middle">Kategori</th>
                        <th scope="col" class="align-middle">Nominal</th>
                        <th scope="col" class="align-middle">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $No = 1; foreach ($Kas as $key) { $Date = explode("-",$key['Tanggal']); ?>
                        <tr style="border-bottom: 1px solid #e3f2fd;">
                            <th scope="row" class="text-center align-middle"><?=$No++?></th>
                            <td class="align-middle"><?=$key['Description']?></td>
                            <td class="align-middle"><?=$key['Category']?></td>
                            <td class="align-middle font-weight-bold" style="color: #e53935;"><?="Rp ".number_format($key['Amount'],0,',','.')?></td>
                            <td class="align-middle"><?=$Date[2].'-'.$Date[1].'-'.$Date[0]?></td>
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
        $('#TabelKas').DataTable({
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
    })
</script>
</body>
</html>