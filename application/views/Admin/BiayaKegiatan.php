<br>
<div class="row">
    <div class="col-lg-auto">
        <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#ModalInput" 
                style="background: linear-gradient(135deg, #1e88e5, #0d47a1); border: 1px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
            <i class="fa fa-plus mr-1"></i><b> Input Pengeluaran</b>
        </button>
    </div>
</div>
<br>

<?php 
// Hitung persentase pengeluaran untuk cek warning
$persentase = $NominalKegiatan > 0 ? ($Biaya / $NominalKegiatan) * 100 : 0;
$warningAktif = $persentase > 50;
?>

<!-- Summary Panel Ringkas & Menarik -->
<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #e3f2fd, #bbdefb);">
            <div class="card-body py-3">
                <div class="row align-items-center text-center text-md-left">
                    <!-- Judul Kegiatan -->
                    <div class="col-md-3 mb-3 mb-md-0">
                        <h5 class="mb-1 text-primary font-weight-bold">
                            <i class="fa fa-folder-open mr-2"></i><?=$NamaKegiatan?>
                        </h5>
                    </div>

                    <!-- Total Nominal Lengkap (Sebelum Pengurangan) -->
                    <div class="col-md-3 mb-3 mb-md-0">
                        <div class="p-3 rounded-lg shadow-sm" style="background: rgba(76, 175, 80, 0.1);">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                <div class="rounded-circle p-3 mr-3" style="background: #4caf50; color: white; width: 50px; height: 50px;">
                                    <i class="fa fa-arrow-up fa-lg"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-success font-weight-bold small text-uppercase">Nominal Awal</p>
                                    <h5 class="mb-0 text-success font-weight-bold">
                                        <?="Rp ".number_format($NominalKegiatan,0,',','.')?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pengeluaran (dengan warna warning jika >50%) -->
                    <div class="col-md-3 mb-3 mb-md-0">
                        <div class="p-3 rounded-lg shadow-sm" style="<?php echo $warningAktif ? 'background: rgba(244, 67, 54, 0.2);' : 'background: rgba(244, 67, 54, 0.1);'; ?>">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                <div class="rounded-circle p-3 mr-3" style="background: #f44336; color: white; width: 50px; height: 50px;">
                                    <i class="fa fa-arrow-down fa-lg"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-danger font-weight-bold small text-uppercase">Total Pengeluaran</p>
                                    <h5 class="mb-0 text-danger font-weight-bold">
                                        <?="Rp ".number_format($Biaya,0,',','.')?>
                                    </h5>
                                    <?php if ($warningAktif): ?>
                                    <small class="text-white font-weight-bold d-block" style="font-size: 0.75em; color: red !important;">
                                        <i class="fa fa-exclamation-triangle" style="color: red;"></i> <?= round($persentase, 2) ?>% (Melebihi 50%)
                                    </small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Saldo Tersisa -->
                    <div class="col-md-3 mb-3 mb-md-0">
                        <div class="p-3 rounded-lg shadow-sm <?php echo $warningAktif ? 'border: 1px solid #ffc107;' : ''; ?>" style="background: rgba(33, 150, 243, 0.1);">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                <div class="rounded-circle p-3 mr-3 text-center " style="background: #2196F3; color: white; width: 50px; height: 50px;">
                                    <i class="fa fa-usd fa-lg"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-primary font-weight-bold small text-uppercase">Saldo Tersisa</p>
                                    <h5 class="mb-0 text-primary font-weight-bold">
                                        <?="Rp ".number_format($Saldo,0,',','.')?>
                                    </h5>
                                    <?php if ($warningAktif): ?>
                                    <small class="text-white font-weight-bold d-block" style="font-size: 0.75em; color: #2196F3 !important;">
                                        <i class="fa fa-exclamation-triangle" style="color: #2196F3;"></i> Perhatikan penggunaan dana!
                                    </small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Daftar Pengeluaran -->
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table id="TabelPendapatan" class="table table-sm table-striped table-hover" style="border: 1px solid #e3f2fd;">
                <thead>
                    <tr style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
                        <th scope="col" style="width: 4%;" class="text-center align-middle">No</th>
                        <th scope="col" style="width: 25%;" class="align-middle">Deskripsi Pengeluaran</th>
                        <th scope="col" style="width: 15%;" class="align-middle">Jenis Pengeluaran</th>
                        <th scope="col" style="width: 18%;" class="align-middle">Sub Pengeluaran</th>
                        <th scope="col" style="width: 12%;" class="align-middle text-right">Nominal</th>
                        <th scope="col" style="width: 10%;" class="align-middle text-center">Tanggal</th>
                        <th scope="col" style="width: 16%;" class="text-center align-middle">Aksi</th>
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
                        array('','Honor Surveyor','Operasional Survei','Penginapan','Sewa Kendaraan','Lainnya'),
                        array('','Cetak Laporan Kegiatan','Pembelian ATK','Jasa Pengiriman Dokumen Kegiatan','Lainnya')
                    ); 
                    $No = 1; 
                    foreach ($Pengeluaran as $key) { 
                        $Tanggal = explode("-",$key['Tanggal']);
                    ?>
                    <tr style="border-bottom: 1px solid #e3f2fd;">
                        <th scope="row" class="text-center align-middle"><?=$No++?></th>
                        <td class="align-middle"><?=$key['Deskripsi']?></td>
                        <td class="align-middle"><?=$JenisPengeluaran[$key['JenisPengeluaran']]?></td>
                        <td class="align-middle"><?=$SubPengeluaran[$key['JenisPengeluaran']][$key['SubPengeluaran']]?></td>
                        <td class="align-middle text-right font-weight-bold" style="color: #c62828;"><?="Rp ".number_format($key['NominalPengeluaran'],0,',','.')?></td>
                        <td class="align-middle text-center"><?=$Tanggal[2].'-'.$Tanggal[1].'-'.$Tanggal[0]?></td>
                        <td class="text-center align-middle">
                            <button Edit="<?=$key['Id']."|".$key['JenisPengeluaran']."|".$key['SubPengeluaran']."|".$key['NominalPengeluaran']."|".$key['Tanggal']."|".$key['Deskripsi']?>" 
                                    class="btn btn-sm btn-info Edit mr-1" 
                                    style="background-color: #42a5f5; border-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button Hapus="<?=$key['Id']?>" 
                                    class="btn btn-sm btn-danger Hapus" 
                                    style="background-color: #e53935; border-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">
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

<!-- Modal Input Pengeluaran -->
<div class="modal fade" id="ModalInput">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #2196F3; border-radius: 8px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
                <h5 class="modal-title"><i class="fa fa-plus mr-2"></i>Input Pengeluaran Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="IdKegiatan" value="<?=$this->session->userdata('Kegiatan')?>">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Jenis Pengeluaran</label>
                                <select class="form-control form-control-sm" id="JenisPengeluaran" style="border: 1px solid #bbdefb;">
                                    <?php for ($i=1; $i < count($JenisPengeluaran); $i++) { ?>
                                        <option value="<?=$i?>"><?=$JenisPengeluaran[$i]?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Sub Pengeluaran</label>
                                <select class="form-control form-control-sm" id="SubPengeluaran" style="border: 1px solid #bbdefb;">
                                    <option value="1">PIC Kegiatan</option>
                                    <option value="2">TA Kegiatan</option>
                                    <option value="3">General Manager</option>
                                    <option value="4">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Nominal Pengeluaran</label>
                                <input type="text" class="form-control form-control-sm" id="NominalPengeluaran" placeholder="Input Hanya Angka" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Tanggal Pengeluaran</label>
                                <input type="date" class="form-control form-control-sm" id="Tanggal" value="<?=date('Y-m-d')?>" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Deskripsi Pengeluaran</label>
                                <textarea class="form-control form-control-sm" id="Deskripsi" rows="4" placeholder="Jelaskan detail pengeluaran ini..." style="border: 1px solid #bbdefb;"></textarea>
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

<!-- Modal Edit Pengeluaran -->
<div class="modal fade" id="ModalEdit">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #2196F3; border-radius: 8px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #2196F3, #0D47A1); color: white;">
                <h5 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit Pengeluaran</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="Id">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Jenis Pengeluaran</label>
                                <select class="form-control form-control-sm" id="_JenisPengeluaran" style="border: 1px solid #bbdefb;">
                                    <?php for ($i=1; $i < count($JenisPengeluaran); $i++) { ?>
                                        <option value="<?=$i?>"><?=$JenisPengeluaran[$i]?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Sub Pengeluaran</label>
                                <select class="form-control form-control-sm" id="_SubPengeluaran" style="border: 1px solid #bbdefb;"></select>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Nominal Pengeluaran</label>
                                <input type="text" class="form-control form-control-sm" id="_NominalPengeluaran" placeholder="Input Hanya Angka" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Tanggal Pengeluaran</label>
                                <input type="date" class="form-control form-control-sm" id="_Tanggal" style="border: 1px solid #bbdefb;">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-primary font-weight-bold">Deskripsi Pengeluaran</label>
                                <textarea class="form-control form-control-sm" id="_Deskripsi" rows="4" placeholder="Jelaskan detail pengeluaran ini..." style="border: 1px solid #bbdefb;"></textarea>
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
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function(){
    var BaseURL = '<?=base_url()?>';

    $('#TabelPendapatan').DataTable({
        "ordering": true,
        "bInfo": true,
        "lengthMenu": [[10, 30, 50, -1], [10, 30, 50, "All"]],
        "language": {
            "paginate": {
                'previous': '<i class="fa fa-chevron-left"></i>',
                'next': '<i class="fa fa-chevron-right"></i>'
            }
        },
        "initComplete": function() {
            $('.dataTables_filter input').addClass('form-control form-control-sm').css('width', '200px');
            $('.dataTables_length select').addClass('form-control form-control-sm').css('width', '80px');
            $('.dataTables_info').css('padding-top', '8px');
            $('.dataTables_paginate').addClass('float-right');
        }
    });

    $("#JenisPengeluaran").change(function(){
        var Sub = $(this).val();
        var List = '';
        if (Sub == 1) List = '<option value="1">PIC Kegiatan</option><option value="2">TA Kegiatan</option><option value="3">General Manager</option><option value="4">Lainnya</option>';
        else if (Sub == 2) List = '<option value="1">BBM</option><option value="2">Tol</option><option value="3">Penginapan</option><option value="4">Konsumsi</option><option value="5">Honor Peserta rapat/FGD</option><option value="6">Honor Perjadin TA Kegiatan</option><option value="7">Honor Perjadin PIC Kegiatan</option><option value="8">Lainnya</option>';
        else if (Sub == 3) List = '<option value="1">Pajak</option><option value="2">Lainnya</option>';
        else if (Sub == 4) List = '<option value="1">Honor Surveyor</option><option value="2">Operasional Survei</option><option value="3">Penginapan</option><option value="4">Sewa Kendaraan</option><option value="5">Lainnya</option>';
        else if (Sub == 5) List = '<option value="1">Cetak Laporan Kegiatan</option><option value="2">Pembelian ATK</option><option value="3">Jasa Pengiriman Dokumen Kegiatan</option><option value="4">Lainnya</option>';
        $('#SubPengeluaran').html(List);
    });

    $("#_JenisPengeluaran").change(function(){
        var Sub = $(this).val();
        var List = '';
        if (Sub == 1) List = '<option value="1">PIC Kegiatan</option><option value="2">TA Kegiatan</option><option value="3">General Manager</option><option value="4">Lainnya</option>';
        else if (Sub == 2) List = '<option value="1">BBM</option><option value="2">Tol</option><option value="3">Penginapan</option><option value="4">Konsumsi</option><option value="5">Honor Peserta rapat/FGD</option><option value="6">Honor Perjadin TA Kegiatan</option><option value="7">Honor Perjadin PIC Kegiatan</option><option value="8">Lainnya</option>';
        else if (Sub == 3) List = '<option value="1">Pajak</option><option value="2">Lainnya</option>';
        else if (Sub == 4) List = '<option value="1">Honor Surveyor</option><option value="2">Operasional Survei</option><option value="3">Penginapan</option><option value="4">Sewa Kendaraan</option><option value="5">Lainnya</option>';
        else if (Sub == 5) List = '<option value="1">Cetak Laporan Kegiatan</option><option value="2">Pembelian ATK</option><option value="3">Jasa Pengiriman Dokumen Kegiatan</option><option value="4">Lainnya</option>';
        $('#_SubPengeluaran').html(List);
    });

    $("#Input").click(function() {
        if (isNaN($("#NominalPengeluaran").val()) || $("#NominalPengeluaran").val() == "") {
            alert('Input Nominal Pengeluaran Belum Benar!');
        } else {
            var Konfirmasi = confirm("Apakah Data Yang Di Input Sudah Benar?"); 
            if (Konfirmasi == true) {
                $("#Input").attr("disabled", true); 
                $("#LoadingInput").show();                             
                var Data = {
                    IdKegiatan: $("#IdKegiatan").val(),
                    JenisPengeluaran: $("#JenisPengeluaran").val(),
                    SubPengeluaran: $("#SubPengeluaran").val(),
                    NominalPengeluaran: $("#NominalPengeluaran").val(),
                    Tanggal: $("#Tanggal").val(),
                    Deskripsi: $("#Deskripsi").val()
                }
                $.post(BaseURL+"Admin/InputBiayaKegiatan", Data).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL + "Admin/BiayaKegiatan";
                    } else {
                        alert(Respon);
                        $("#Input").attr("disabled", false); 
                        $("#LoadingInput").hide();                             
                    }
                });
            } 
        }
    });

    $(document).on("click",".Edit",function(){
        var Data = $(this).attr('Edit');
        var Pisah = Data.split("|");
        $("#Id").val(Pisah[0]);
        $("#_JenisPengeluaran").val(Pisah[1]).trigger('change');
        setTimeout(function() {
            $("#_SubPengeluaran").val(Pisah[2]);
        }, 100);
        $("#_NominalPengeluaran").val(Pisah[3]);
        $("#_Tanggal").val(Pisah[4]);
        $("#_Deskripsi").val(Pisah[5]);
        $('#ModalEdit').modal("show");
    });

    $("#Edit").click(function() {
        if (isNaN($("#_NominalPengeluaran").val()) || $("#_NominalPengeluaran").val() == "") {
            alert('Edit Nominal Pengeluaran Belum Benar!');
        } else {
            var Konfirmasi = confirm("Apakah Data Yang Di Edit Sudah Benar?"); 
            if (Konfirmasi == true) {
                $("#Edit").attr("disabled", true); 
                $("#LoadingEdit").show();                             
                var Data = {
                    Id: $("#Id").val(),
                    JenisPengeluaran: $("#_JenisPengeluaran").val(),
                    SubPengeluaran: $("#_SubPengeluaran").val(),
                    NominalPengeluaran: $("#_NominalPengeluaran").val(),
                    Tanggal: $("#_Tanggal").val(),
                    Deskripsi: $("#_Deskripsi").val()
                }
                $.post(BaseURL+"Admin/EditBiayaKegiatan", Data).done(function(Respon) {
                    if (Respon == '1') {
                        window.location = BaseURL + "Admin/BiayaKegiatan";
                    } else {
                        alert(Respon);
                        $("#Edit").attr("disabled", false); 
                        $("#LoadingEdit").hide();                             
                    }
                });
            } 
        }
    });

    $(document).on("click",".Hapus",function(){
        var Id = $(this).attr('Hapus');
        var Konfirmasi = confirm("Yakin ingin menghapus data pengeluaran ini?");
        if (Konfirmasi == true) {
            $.post(BaseURL+"Admin/HapusBiayaKegiatan", {Id: Id}).done(function(Respon) {
                if (Respon == '1') {
                    window.location = BaseURL + "Admin/BiayaKegiatan";
                } else {
                    alert(Respon);
                }
            });
        }
    });

    // SweetAlert untuk peringatan penggunaan dana >50%
    <?php if ($warningAktif): ?>
    Swal.fire({
        icon: 'warning',
        title: 'Peringatan Penggunaan Dana!',
        text: 'Total pengeluaran telah melebihi 50% dari Nominal Awal (<?= round($persentase, 2) ?>%). Silakan pertimbangkan efisiensi anggaran.',
        footer: '<small>Monitor penggunaan dana dengan hati-hati.</small>',
        confirmButtonColor: '#ffc107',
        confirmButtonText: 'Mengerti',
        timer: 8000,  // Auto-dismiss setelah 8 detik
        timerProgressBar: true
    });
    <?php endif; ?>
});
</script>
</body>
</html>