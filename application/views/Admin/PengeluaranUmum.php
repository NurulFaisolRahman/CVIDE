<br>
<div class="row">
    <div class="col-lg-auto">
        <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#ModalInput" style="background: linear-gradient(135deg, #1e88e5, #0d47a1); border: 1px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
            <i class="fa fa-plus mr-1"></i><b> Input Pengeluaran</b>
        </button>
    </div>
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
</div>
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
                        <th scope="col" class="text-center align-middle">Edit</th>
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
                            <td class="text-center align-middle">
                                <button Edit="<?=$key['Id']."|".$key['Description']."|".$key['Category']."|".$key['Amount']."|".$key['Tanggal']?>" class="btn btn-sm btn-info Edit" style="background-color: #42a5f5; border-color: #fff;">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button Hapus="<?=$key['Id']?>" class="btn btn-sm btn-danger Hapus" style="background-color: #e53935; border-color: #fff;">
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

<!-- Input Modal -->
<div class="modal fade" id="ModalInput">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #2196F3;">
            <div class="modal-header" style="background: linear-gradient(500deg, #2196F3, #0D47A1); color: white;">
                <h5 class="modal-title"><i class="fa fa-plus mr-2"></i>Input Pengeluaran Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Deskripsi</label>
                                <textarea class="form-control form-control-sm" id="Description" rows="2" placeholder="Deskripsi / Keterangan" style="border: 1px solid #bbdefb;"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Kategori</label>
                                <select class="form-control form-control-sm" id="Category" style="border: 1px solid #bbdefb;">  
                                    <?php 
                                        $Category = array('Makanan','Prive','Operasional Kantor','Transportasi','Tagihan','Honorarium','Lainnya'); 
                                        for ($i=0; $i < count($Category); $i++) { ?>
                                        <option value="<?=$Category[$i]?>"><?=$Category[$i]?></option>
                                    <?php } ?>                  
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Nominal</label>
                                <input type="text" class="form-control form-control-sm" id="Price" placeholder="Input Hanya Angka" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Tanggal</label>
                                <input type="date" class="form-control form-control-sm" id="Date" value="<?=date('Y-m-d')?>" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color: #e3f2fd;">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="background-color: #e53935; border-color: #fff;">
                    <b>Tutup</b>
                </button>
                <button type="button" class="btn btn-sm btn-primary" id="Input" style="background: linear-gradient(135deg, #2196F3, #0D47A1); border-color: #fff;">
                    <b>Simpan&nbsp;<div id="LoadingInput" class="spinner-border spinner-border-sm text-white" role="status" style="display: none;"></div></b>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="ModalEdit">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #2196F3;">
            <div class="modal-header" style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
                <h5 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit Data Pengeluaran</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Deskripsi</label>
                                <input type="hidden" class="form-control form-control-sm" id="Id">
                                <textarea class="form-control form-control-sm" id="EditDescription" rows="2" placeholder="Deskripsi / Keterangan" style="border: 1px solid #bbdefb;"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Kategori</label>
                                <select class="form-control form-control-sm" id="EditCategory" style="border: 1px solid #bbdefb;">  
                                    <?php 
                                        $Category = array('Makanan','Operasional Kantor','Transportasi','Tagihan','Honorarium','Lainnya'); 
                                        for ($i=0; $i < count($Category); $i++) { ?>
                                        <option value="<?=$Category[$i]?>"><?=$Category[$i]?></option>
                                    <?php } ?>                  
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Nominal</label>
                                <input type="text" class="form-control form-control-sm" id="EditPrice" placeholder="Input Hanya Angka" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Tanggal</label>
                                <input type="date" class="form-control form-control-sm" id="EditDate" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color: #e3f2fd;">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="background-color: #e53935; border-color: #fff;">
                    <b>Tutup</b>
                </button>
                <button type="button" class="btn btn-sm btn-primary" id="Edit" style="background: linear-gradient(135deg, #2196F3, #0D47A1); border-color: #fff;">
                    <b>Simpan&nbsp;<div id="LoadingEdit" class="spinner-border spinner-border-sm text-white" role="status" style="display: none;"></div></b>
                </button>
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
        $('#TabelKas').DataTable({
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
        
        $("#Input").click(function() {
            if (isNaN($("#Price").val()) || $("#Price").val() == "") {
                alert('Input Nominal Belum Benar!')
            } else {
                var Konfirmasi = confirm("Apakah Data Yang Di Input Sudah Benar?"); 
                if (Konfirmasi == true) {
                    $("#Input").attr("disabled", true); 
                    $("#LoadingInput").show();                             
                    var Data = { 
                        Category: $("#Category").val(),
                        Description: $("#Description").val(),
                        Amount: $("#Price").val(),
                        Tanggal: $("#Date").val()
                    }
                    $.post(BaseURL+"Admin/InputPengeluaranUmum", Data).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL + "Admin/PengeluaranUmum"
                        } else {
                            alert(Respon)
                            $("#Input").attr("disabled", false); 
                            $("#LoadingInput").hide();                             
                        }
                    })
                }
            }
        })

        $(document).on("click",".Edit",function(){
            var Data = $(this).attr('Edit')
            var Pisah = Data.split("|");
            $("#Id").val(Pisah[0])
            $("#EditDescription").val(Pisah[1])
            $("#EditCategory").val(Pisah[2])
            $("#EditPrice").val(Pisah[3])
            $("#EditDate").val(Pisah[4])
            $('#ModalEdit').modal("show")
        })

        $("#Edit").click(function() {
            if (isNaN($("#EditPrice").val()) || $("#EditPrice").val() == "") {
                alert('Input Price Belum Benar!')
            } else {
                var Konfirmasi = confirm("Apakah Data Yang Di Edit Sudah Benar?"); 
                if (Konfirmasi == true) {
                    $("#Edit").attr("disabled", true); 
                    $("#LoadingEdit").show();                             
                    var Data = { 
                        Id: $("#Id").val(),
                        Category: $("#EditCategory").val(),
                        Description: $("#EditDescription").val(),
                        Amount: $("#EditPrice").val(),
                        Tanggal: $("#EditDate").val() 
                    }
                    $.post(BaseURL+"Admin/EditPengeluaranUmum", Data).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL + "Admin/PengeluaranUmum"
                        } else {
                            alert(Respon)
                            $("#Edit").attr("disabled", false); 
                            $("#LoadingEdit").hide();                             
                        }
                    })
                }
            }
        })

        $(document).on("click",".Hapus",function(){
            var Hapus = {Id: $(this).attr('Hapus')}
            var Konfirmasi = confirm("Yakin Ingin Menghapus?");
            if (Konfirmasi == true) {
                $.post(BaseURL+"Admin/HapusPengeluaranUmum", Hapus).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL + "Admin/PengeluaranUmum"
                    } else {
                        alert(Respon)
                    }
                })
            }
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
</script>
</body>
</html>