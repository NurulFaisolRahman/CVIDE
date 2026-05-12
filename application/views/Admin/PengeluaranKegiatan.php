<br>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <select class="form-control form-control-sm" id="FilterTahun" onchange="filterByTahun()" style="border: 1px solid #bbdefb;">
                <option value="">Semua Tahun</option>
                <?php foreach ($TahunPendapatan as $tahun) { ?>
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
                        <th scope="col" style="width: 25%;" class="align-middle">Nama Kegiatan</th>
                        <th scope="col" style="width: 10%;" class="align-middle">Sumber Kegiatan</th>
                        <th scope="col" style="width: 10%;" class="align-middle">Nominal Kegiatan</th>
                        <th scope="col" style="width: 8%;" class="align-middle">Mulai</th>
                        <th scope="col" style="width: 8%;" class="align-middle">Selesai</th>
                        <th scope="col" style="width: 8%;" class="text-center align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $SumberKegiatan = array('','Swakelola Tipe 1','Swakelola Tipe 2','Narasumber','Rekanan','CV IDE PL','CV IDE Tender/Seleksi'); 
                    $No = 1; foreach ($Pendapatan as $key) { 
                        $Mulai = explode("-",$key['Mulai']); 
                        $Selesai = explode("-",$key['Selesai']); ?>
                        <tr id="row_<?=$key['Id']?>" style="border-bottom: 1px solid #e3f2fd;">
                            <th scope="row" class="text-center align-middle"><?=$No++?></th>
                            <td class="align-middle"><?=$key['NamaKegiatan']?></td>
                            <td class="align-middle"><?=$SumberKegiatan[$key['SumberKegiatan']]?></td>
                            <td class="align-middle font-weight-bold" style="color: #e53935;"><?="Rp ".number_format($key['NominalKegiatan'],0,',','.')?></td>
                            <td class="align-middle"><?=$Mulai[2].'-'.$Mulai[1].'-'.$Mulai[0]?></td>
                            <td class="align-middle"><?=$Selesai[2].'-'.$Selesai[1].'-'.$Selesai[0]?></td>
                            <td class="text-center align-middle">
                                <button Biaya="<?=$key['Id']?>" class="btn btn-sm btn-info Biaya" style="background-color: #42a5f5; border-color: #fff; margin-right: 5px;">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button onclick="hapusKegiatan(<?=$key['Id']?>)" class="btn btn-sm btn-danger" style="background-color: #ef5350; border-color: #fff;">
                                    <i class="fa fa-trash"></i>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            "lengthMenu": [[7, 30, 50, 100, -1], [7, 30, 50, 100, "All"]],
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
     function hapusKegiatan(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data kegiatan yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var BaseURL = '<?=base_url()?>';
                
                $.ajax({
                    url: BaseURL + "Admin/HapusKegiatan",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                'Terhapus!',
                                response.message,
                                'success'
                            );
                            // Hapus baris dari tabel
                            $('#row_' + id).fadeOut(500, function() {
                                $(this).remove();
                                // Refresh nomor urut
                                var table = $('#TabelPendapatan').DataTable();
                                table.ajax.reload();
                                location.reload(); // Reload page untuk refresh data
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                });
            }
        });
    }

</script>
</body>
</html>