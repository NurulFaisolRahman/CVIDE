<!-- Summary Balance Cards Section -->
<div class="row mb-4 align-items-stretch" style="margin-top: 10px;">
  <div class="col-xl-3 col-md-6 mb-3 d-flex">
    <div class="card shadow-sm border-0 w-100" style="border-radius: 20px; background: #ffffff; border: 1px solid #e2e8f0; padding: 20px;">
      <div class="d-flex align-items-center">
        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 48px; height: 48px; background: rgba(245, 158, 11, 0.12); color: #f59e0b; font-size: 20px; flex-shrink: 0;">
          <i class="fa-solid fa-piggy-bank"></i>
        </div>
        <div>
          <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Saldo Bulan Lalu</div>
          <div style="font-size: 17px; font-weight: 800; color: var(--ide-dark); margin-top: 2px;">Rp <?=number_format($SaldoLalu,0,',','.')?></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-3 d-flex">
    <div class="card shadow-sm border-0 w-100" style="border-radius: 20px; background: #ffffff; border: 1px solid #e2e8f0; padding: 20px;">
      <div class="d-flex align-items-center">
        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 48px; height: 48px; background: rgba(4, 49, 104, 0.1); color: var(--ide-navy); font-size: 20px; flex-shrink: 0;">
          <i class="fa-solid fa-arrow-trend-up"></i>
        </div>
        <div>
          <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Pemasukan (<?=date("M Y")?>)</div>
          <div style="font-size: 17px; font-weight: 800; color: var(--ide-navy); margin-top: 2px;">Rp <?=number_format($InBerjalan,0,',','.')?></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-3 d-flex">
    <div class="card shadow-sm border-0 w-100" style="border-radius: 20px; background: #ffffff; border: 1px solid #e2e8f0; padding: 20px;">
      <div class="d-flex align-items-center">
        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 48px; height: 48px; background: rgba(180, 8, 20, 0.1); color: var(--ide-red); font-size: 20px; flex-shrink: 0;">
          <i class="fa-solid fa-arrow-trend-down"></i>
        </div>
        <div>
          <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Pengeluaran (<?=date("M Y")?>)</div>
          <div style="font-size: 17px; font-weight: 800; color: var(--ide-red); margin-top: 2px;">Rp <?=number_format($OutBerjalan,0,',','.')?></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-3 d-flex">
    <div class="card shadow-sm border-0 w-100" style="border-radius: 20px; background: #ffffff; border: 1px solid #e2e8f0; padding: 20px;">
      <div class="d-flex align-items-center">
        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 48px; height: 48px; background: rgba(16, 185, 129, 0.12); color: #10b981; font-size: 20px; flex-shrink: 0;">
          <i class="fa-solid fa-scale-balanced"></i>
        </div>
        <div>
          <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Saldo Berjalan (Akhir)</div>
          <div style="font-size: 17px; font-weight: 800; color: #10b981; margin-top: 2px;">Rp <?=number_format(($InBerjalan-$OutBerjalan)+$SaldoLalu,0,',','.')?></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Filter & Export Header Bar -->
<div class="card mb-4 border-0 shadow-sm" style="border-radius: 20px; background: #ffffff; border: 1px solid #e2e8f0; padding: 20px;">
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
    <div class="d-flex align-items-center flex-wrap gap-2">
      <span class="badge badge-primary px-3 py-2 mr-2 mb-1" style="background: var(--ide-navy); font-size: 13px; border-radius: 12px;">
        <i class="fa-solid fa-filter mr-1"></i> Filter Periode
      </span>
      <div class="d-flex align-items-center mr-3 mb-1">
        <label class="mb-0 mr-2 font-weight-bold" style="font-size: 12px; color: #64748b;">DARI:</label>
        <input type="date" class="form-control form-control-sm" id="From" value="" style="border-radius: 16px; border: 2px solid #e2e8f0; padding: 5px 12px; outline: none;">
      </div>
      <div class="d-flex align-items-center mr-3 mb-1">
        <label class="mb-0 mr-2 font-weight-bold" style="font-size: 12px; color: #64748b;">HINGGA:</label>
        <input type="date" class="form-control form-control-sm" id="To" value="" style="border-radius: 16px; border: 2px solid #e2e8f0; padding: 5px 12px; outline: none;">
      </div>
      <button type="button" class="btn btn-sm btn-primary px-3 py-2 mb-1 mr-2" id="FilterBtn" style="background: var(--ide-navy); border: none; border-radius: 16px; font-weight: 700;">
        <i class="fa-solid fa-magnifying-glass mr-1"></i> Terapkan Filter
      </button>
      <button type="button" class="btn btn-sm btn-light px-3 py-2 mb-1" id="ResetFilterBtn" style="border-radius: 16px; font-weight: 600; border: 1px solid #cbd5e1;">
        <i class="fa-solid fa-rotate-left mr-1"></i> Reset
      </button>
    </div>

    <div>
      <button type="button" class="btn btn-sm btn-danger px-4 py-2" id="Rekap" style="background: var(--ide-red); border: none; border-radius: 20px; font-weight: 700; box-shadow: 0 4px 12px rgba(180, 8, 20, 0.35);">
        <i class="fa-solid fa-file-excel mr-1"></i> Ekspor Rekap Excel
      </button>
    </div>
  </div>
</div>

<!-- Table Container -->
<div class="row">
  <div class="col-sm-12">
    <div class="table-responsive">
      <table id="TabelKas" class="table table-hover align-middle">
        <thead>
          <tr>
            <th scope="col" class="text-center align-middle" style="width: 50px;">No</th>
            <th scope="col" class="align-middle">Deskripsi Jurnal / Transaksi</th>
            <th scope="col" class="align-middle">Nominal</th>
            <th scope="col" class="align-middle">Debit (Pemasukan)</th>
            <th scope="col" class="align-middle">Kredit (Pengeluaran)</th>
            <th scope="col" class="text-center align-middle" style="width: 130px;">Tanggal</th>
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
          $No = 1; foreach ($Kas as $key) { 
            $Date = explode("-",$key['Tanggal']); 
          ?>
            <tr>
              <td class="text-center align-middle font-weight-bold"><?=$No++?></td>
              <td class="align-middle font-weight-bold" style="color: var(--ide-dark);">
                <?=isset($key['Description']) ? $key['Description'] : $key['Deskripsi']; ?>
              </td>
              <td class="align-middle font-weight-bold" style="color: var(--ide-navy);">
                <?=isset($key['Amount']) ? "Rp ".number_format($key['Amount'],0,',','.') : "Rp ".number_format($key['NominalPengeluaran'],0,',','.'); ?>
              </td>
              <td class="align-middle font-weight-bold" style="color: #10b981;">
                <?=isset($key['Jenis']) ? ($key['Jenis'] == 'IN' ? "Rp ".number_format($key['Amount'],0,',','.') : '-') : '-'; ?>
              </td>
              <td class="align-middle font-weight-bold" style="color: var(--ide-red);">
                <?=isset($key['Jenis']) ? ($key['Jenis'] == 'OUT' ? "Rp ".number_format($key['Amount'],0,',','.') : '-') : "Rp ".number_format($key['NominalPengeluaran'],0,',','.'); ?>
              </td>
              <td class="text-center align-middle">
                <span class="badge badge-light px-3 py-2" style="border-radius: 12px; border: 1px solid #e2e8f0; color: #475569; font-weight: 600;">
                  <?=$Date[2].'/'.$Date[1].'/'.$Date[0]?>
                </span>
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
    var BaseURL = '<?=base_url()?>';

    // Custom DataTables Date Range Search Filter
    $.fn.dataTable.ext.search.push(
      function(settings, data, dataIndex) {
        var fromVal = $('#From').val();
        var toVal = $('#To').val();
        
        if (!fromVal && !toVal) return true;
        
        var rowDateStr = data[5] || '';
        rowDateStr = $('<div>' + rowDateStr + '</div>').text().trim();
        
        if (!rowDateStr) return true;
        
        var dateParts = rowDateStr.split('/');
        var rowDate;
        if (dateParts.length === 3) {
          rowDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
        } else {
          rowDate = new Date(rowDateStr);
        }
        
        var fromDate = fromVal ? new Date(fromVal) : null;
        var toDate = toVal ? new Date(toVal) : null;
        if (toDate) toDate.setHours(23, 59, 59, 999);
        
        if (fromDate && rowDate < fromDate) return false;
        if (toDate && rowDate > toDate) return false;
        
        return true;
      }
    );

    var table = $('#TabelKas').DataTable({
      "ordering": true,
      "bInfo": true,
      "lengthMenu": [[15, 30, 50, 100, -1], [15, 30, 50, 100, "All"]],
      "language": {
        "paginate": {
          'previous': '<i class="fa fa-chevron-left"></i>',
          'next': '<i class="fa fa-chevron-right"></i>'
        }
      }
    });

    $('#FilterBtn').click(function() {
      table.draw();
    });

    $('#ResetFilterBtn').click(function() {
      $('#From').val('');
      $('#To').val('');
      table.draw();
    });

    $("#Rekap").click(function() {
      if ($("#From").val() == "") {
        alert('Input From Belum Benar!');
      } else if ($("#To").val() == "") {
        alert('Input To Belum Benar!');
      } else {
        window.location = BaseURL + "Admin/ExcelKas/" + $("#From").val() + "/" + $("#To").val();
      }
    });
  });
</script>
</body>
</html>