<br>
<div class="row">
    <div class="col-lg-auto">
        <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#ModalInput" style="background: linear-gradient(135deg, #1e88e5, #0d47a1); border: 1px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
            <i class="fa fa-plus mr-1"></i><b> Input Kegiatan</b>
        </button>
    </div>
</div>
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
                        <th scope="col" style="width: 4%;" class="text-center align-middle">Edit</th>
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
                            <td class="align-middle font-weight-bold" style="color: #1565c0;"><?="Rp ".number_format($key['NominalKegiatan'],0,',','.')?></td>
                            <td class="align-middle"><?=$Mulai[2].'-'.$Mulai[1].'-'.$Mulai[0]?></td>
                            <td class="align-middle"><?=$Selesai[2].'-'.$Selesai[1].'-'.$Selesai[0]?></td>
                            <td class="text-center align-middle">
                                <button Edit="<?=$key['Id']."|".$key['NamaKegiatan']."|".$key['SumberKegiatan']."|".$key['NominalKegiatan']."|".$key['Mulai']."|".$key['Selesai']."|".$key['DeskripsiKegiatan']?>" class="btn btn-sm btn-info Edit" style="background-color: #42a5f5; border-color: #fff;">
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

<!-- Input Modal -->
<div class="modal fade" id="ModalInput">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #2196F3;">
            <div class="modal-header" style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
                <h5 class="modal-title"><i class="fa fa-plus mr-2"></i>Input Kegiatan Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Nama Kegiatan</label>
                                <input type="text" class="form-control form-control-sm" id="NamaKegiatan" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Sumber Kegiatan</label>
                                <select class="form-control form-control-sm" id="SumberKegiatan" style="border: 1px solid #bbdefb;">  
                                    <?php for ($i=1; $i < count($SumberKegiatan); $i++) { ?>
                                        <option value="<?=$i?>"><?=$SumberKegiatan[$i]?></option>
                                    <?php } ?>                  
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Nominal Kegiatan</label>
                                <input type="text" class="form-control form-control-sm" id="NominalKegiatan" placeholder="Input Hanya Angka" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Tanggal Mulai</label>
                                <input type="date" class="form-control form-control-sm" id="Mulai" value="<?=date('Y-m-d')?>" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Tanggal Selesai</label>
                                <input type="date" class="form-control form-control-sm" id="Selesai" value="<?=date('Y-m-d')?>" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Deskripsi Kegiatan</label>
                                <textarea class="form-control form-control-sm" id="DeskripsiKegiatan" rows="4" placeholder="Deskripsi serta durasi tanggal pengerjaan kegiatan" style="border: 1px solid #bbdefb;"></textarea>
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #2196F3;">
            <div class="modal-header" style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
                <h5 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit Data Kegiatan</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Nama Kegiatan</label>
                                <input type="hidden" class="form-control form-control-sm" id="Id">
                                <input type="text" class="form-control form-control-sm" id="_NamaKegiatan" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Sumber Kegiatan</label>
                                <select class="form-control form-control-sm" id="_SumberKegiatan" style="border: 1px solid #bbdefb;">  
                                    <?php for ($i=1; $i < count($SumberKegiatan); $i++) { ?>
                                        <option value="<?=$i?>"><?=$SumberKegiatan[$i]?></option>
                                    <?php } ?>                  
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Nominal Kegiatan</label>
                                <input type="text" class="form-control form-control-sm" id="_NominalKegiatan" placeholder="Input Hanya Angka" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Tanggal Mulai</label>
                                <input type="date" class="form-control form-control-sm" id="_Mulai" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Tanggal Selesai</label>
                                <input type="date" class="form-control form-control-sm" id="_Selesai" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Deskripsi Kegiatan</label>
                                <textarea class="form-control form-control-sm" id="_DeskripsiKegiatan" rows="4" placeholder="Deskripsi serta durasi tanggal pengerjaan kegiatan" style="border: 1px solid #bbdefb;"></textarea>
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
        
        $("#Input").click(function() {
            if ($("#NamaKegiatan").val() == "") {
                alert('Input Nama Kegiatan Belum Benar!')
            } else if (isNaN($("#NominalKegiatan").val()) || $("#NominalKegiatan").val() == "") {
                alert('Input Nominal Kegiatan Belum Benar!')
            } else {
                var Konfirmasi = confirm("Apakah Data Yang Di Input Sudah Benar?"); 
                if (Konfirmasi == true) {
                    $("#Input").attr("disabled", true); 
                    $("#LoadingInput").show();                             
                    var Data = { 
                        NamaKegiatan: $("#NamaKegiatan").val(),
                        SumberKegiatan: $("#SumberKegiatan").val(),
                        NominalKegiatan: $("#NominalKegiatan").val(),
                        Mulai: $("#Mulai").val(),
                        Selesai: $("#Selesai").val(),
                        DeskripsiKegiatan: $("#DeskripsiKegiatan").val()
                    }
                    $.post(BaseURL+"Admin/InputPendapatanKegiatan", Data).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL + "Admin/PendapatanKegiatan"
                        } else {
                            alert(Respon)
                            $("#Input").attr("disabled", false); 
                            $("#LoadingInput").hide();                             
                        }
                    })
                } 
            }
        })

        $(document).on("click",".Biaya",function(){
            var Data = { Kegiatan: $(this).attr('Biaya') }
            $.post(BaseURL+"Admin/SesiBiaya", Data).done(function(Respon) {
                if (Respon == '1') {
                    window.location = BaseURL + "Admin/Pengeluaran"
                }
            })
        })

        $(document).on("click",".Edit",function(){
            var Data = $(this).attr('Edit')
            var Pisah = Data.split("|");
            $("#Id").val(Pisah[0])
            $("#_NamaKegiatan").val(Pisah[1])
            $("#_SumberKegiatan").val(Pisah[2])
            $("#_NominalKegiatan").val(Pisah[3])
            $("#_Mulai").val(Pisah[4])
            $("#_Selesai").val(Pisah[5])
            $("#_DeskripsiKegiatan").val(Pisah[6])
            $('#ModalEdit').modal("show")
        })

        $("#Edit").click(function() {
            if ($("#_NamaKegiatan").val() == "") {
                alert('Input Nama Kegiatan Belum Benar!')
            } else if (isNaN($("#_NominalKegiatan").val()) || $("#_NominalKegiatan").val() == "") {
                alert('Input Nominal Kegiatan Belum Benar!')
            } else {
                var Konfirmasi = confirm("Apakah Data Yang Di Edit Sudah Benar?"); 
                if (Konfirmasi == true) {
                    $("#Edit").attr("disabled", true); 
                    $("#LoadingEdit").show();                             
                    var Data = { 
                        Id: $("#Id").val(),
                        NamaKegiatan: $("#_NamaKegiatan").val(),
                        SumberKegiatan: $("#_SumberKegiatan").val(),
                        NominalKegiatan: $("#_NominalKegiatan").val(),
                        Mulai: $("#_Mulai").val(),
                        Selesai: $("#_Selesai").val(),
                        DeskripsiKegiatan: $("#_DeskripsiKegiatan").val()
                    }
                    $.post(BaseURL+"Admin/EditPendapatanKegiatan", Data).done(function(Respon) {
                        if (Respon == '1') {
                            window.location = BaseURL + "Admin/PendapatanKegiatan"
                        } else {
                            alert(Respon)
                            $("#Edit").attr("disabled", false); 
                            $("#LoadingEdit").hide();                             
                        }
                    })
                } 
            }
        })
    })
</script>
</body>
</html>