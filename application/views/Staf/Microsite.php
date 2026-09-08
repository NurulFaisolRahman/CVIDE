<?php
$userLevel = (int)($this->session->userdata('level') ?? 3);
?>

<style>
  .gdrive-link-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 6px 14px;
    border-radius: 12px;
    background: #ffffff;
    border: 1.5px solid #cbd5e1;
    color: #043168;
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none !important;
    transition: all 0.25s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
  }
  .gdrive-link-btn:hover {
    background: #f0fdf4;
    border-color: #22c55e;
    color: #15803d;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.2);
  }
  .gdrive-link-btn i.fa-google-drive {
    font-size: 15px;
    color: #0f9d58;
  }
  .site-badge {
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.3px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }
  .site-badge-situbondo {
    background-color: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
  }
  .site-badge-banyuwangi {
    background-color: #fef2f2;
    color: #b91c1c;
    border: 1px solid #fecaca;
  }
  .site-badge-custom {
    background-color: #f3e8ff;
    color: #7e22ce;
    border: 1px solid #e9d5ff;
  }
  .category-badge {
    background-color: #f1f5f9;
    color: #334155;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 3px 8px;
    font-size: 12px;
    font-weight: 600;
  }

  /* DataTables alignment */
  #TabelMicrosite_wrapper > .row:first-child {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    margin-bottom: 14px !important;
    flex-wrap: wrap !important;
    gap: 10px 0 !important;
  }
  #TabelMicrosite_wrapper .dataTables_length {
    margin-bottom: 0 !important;
    display: flex !important;
    align-items: center !important;
  }
  #TabelMicrosite_wrapper .dataTables_length select {
    height: 35px !important;
    border-radius: 8px !important;
    border: 1px solid #cbd5e1 !important;
    padding: 3px 8px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #043168 !important;
    background-color: #ffffff !important;
  }
  #TabelMicrosite_wrapper .dataTables_filter {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    margin-bottom: 0 !important;
  }
  #TabelMicrosite_wrapper .dataTables_filter input {
    height: 35px !important;
    border-radius: 8px !important;
    border: 1px solid #cbd5e1 !important;
    padding: 4px 12px !important;
    font-size: 13px !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
  }
</style>

<!-- Enterprise Page Header Card -->
<div class="row mb-3" style="margin-top: 22px;">
  <div class="col-12">
    <div class="card border-0" style="background: #ffffff; border-radius: 20px; border: 1px solid var(--ide-border) !important; box-shadow: 0 8px 24px rgba(4, 49, 104, 0.05); padding: 18px 24px;">
      <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 16px;">
        <div class="d-flex align-items-center" style="gap: 16px;">
          <div style="width: 50px; height: 50px; border-radius: 14px; background: linear-gradient(135deg, rgba(4, 49, 104, 0.1) 0%, rgba(238, 98, 107, 0.1) 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <i class="fa-solid fa-globe" style="color: var(--ide-navy); font-size: 24px;"></i>
          </div>
          <div>
            <div class="d-flex align-items-center" style="gap: 10px;">
              <h4 class="font-weight-bold text-dark mb-0" style="font-size: 18px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                Manajemen Microsite & Dokumen Publik
              </h4>
              <span class="badge badge-primary px-2 py-1" style="background: var(--ide-navy); font-size: 11px; font-weight: 600; border-radius: 6px;">Live Editor</span>
            </div>
            <p class="text-muted mb-0 mt-1" style="font-size: 12.5px;">
              Kelola tombol dokumen, link Google Drive/Docs, dan accordion untuk microsite IPPD Situbondo, Banyuwangi, dll. secara dinamis.
            </p>
          </div>
        </div>

        <!-- Quick Action Buttons -->
        <div class="d-flex flex-wrap align-items-center" style="gap: 10px;">
          <a href="<?=base_url('IDE/IPPDSitubondo')?>" target="_blank" class="btn btn-outline-primary" style="border-radius: 10px; font-weight: 600; font-size: 12.5px; padding: 8px 16px; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat IPPD Situbondo
          </a>
          <a href="<?=base_url('IDE/IPPDBanyuwangi')?>" target="_blank" class="btn btn-outline-danger" style="border-radius: 10px; font-weight: 600; font-size: 12.5px; padding: 8px 16px; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat IPPD Banyuwangi
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card shadow-sm border-0" style="border-radius: 16px;">
      <div class="card-body p-3">
        <!-- Top Toolbar: Add Button & Filter Microsite -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-3" style="gap: 12px;">
          <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalInputMicrosite" style="border-radius: 10px; font-weight: 700; padding: 9px 20px; font-size: 13px; background: var(--ide-navy); border: none; box-shadow: 0 4px 14px rgba(4, 49, 104, 0.3); transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px;">
              <i class="fa-solid fa-plus"></i> Tambah Link Dokumen Baru
            </button>
          </div>

          <!-- Filter Microsite Dropdown -->
          <div class="d-flex align-items-center" style="gap: 8px;">
            <label class="mb-0 font-weight-bold text-dark" style="font-size: 13px;">Filter Microsite:</label>
            <select class="form-control" id="filterMicrosite" style="height: 38px; border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; font-size: 13px; min-width: 180px;" onchange="location = this.value;">
              <option value="<?=base_url('Staf/Microsite')?>" <?=empty($SelectedSite)?'selected':''?>>Semua Microsite</option>
              <?php foreach ($MicrositeList as $m): ?>
                <option value="<?=base_url('Staf/Microsite?site='.$m['Microsite'])?>" <?=(!empty($SelectedSite) && $SelectedSite == $m['Microsite'])?'selected':''?>>
                  <?=strtoupper(str_replace('-', ' ', $m['Microsite']))?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="table-responsive">
          <table id="TabelMicrosite" class="table table-hover table-striped w-100" style="border-radius: 12px; overflow: hidden;">
            <thead>
              <tr style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff;">
                <th style="width: 5%;" class="text-center align-middle">No</th>
                <th style="width: 18%;" class="align-middle">Microsite</th>
                <th style="width: 18%;" class="align-middle">Kategori / Accordion</th>
                <th style="width: 25%;" class="align-middle">Nama Dokumen / Tombol</th>
                <th style="width: 16%;" class="align-middle">Tautan URL</th>
                <th style="width: 8%;" class="text-center align-middle">Urutan</th>
                <th style="width: 10%;" class="text-center align-middle">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $No = 1;
              foreach ($Links as $row):
                $badgeClass = 'site-badge-custom';
                if ($row['Microsite'] === 'ippd-situbondo') $badgeClass = 'site-badge-situbondo';
                else if ($row['Microsite'] === 'ippd-banyuwangi') $badgeClass = 'site-badge-banyuwangi';
              ?>
                <tr>
                  <td class="text-center align-middle font-weight-bold"><?=$No++?></td>
                  <td class="align-middle">
                    <span class="site-badge <?=$badgeClass?>">
                      <i class="fa-solid fa-map-pin"></i> <?=strtoupper(str_replace('-', ' ', $row['Microsite']))?>
                    </span>
                  </td>
                  <td class="align-middle">
                    <span class="category-badge">
                      <i class="fa-solid fa-folder-open text-warning mr-1"></i> <?=htmlspecialchars($row['Kategori'])?>
                    </span>
                  </td>
                  <td class="align-middle font-weight-bold text-dark" style="font-size: 13.5px;">
                    <i class="fa-regular fa-file-lines text-primary mr-1"></i> <?=htmlspecialchars($row['NamaDokumen'])?>
                  </td>
                  <td class="align-middle">
                    <?php if (!empty($row['Url'])): ?>
                      <a href="<?=htmlspecialchars($row['Url'])?>" target="_blank" rel="noopener noreferrer" class="gdrive-link-btn" title="Buka Link">
                        <i class="fa-brands fa-google-drive"></i>
                        <span>Buka Tautan</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-muted" style="font-size: 10px; margin-left: 2px;"></i>
                      </a>
                    <?php else: ?>
                      <span class="badge badge-secondary" style="font-size: 11px; background: #e2e8f0; color: #64748b;">Belum Ada Link</span>
                    <?php endif; ?>
                  </td>
                  <td class="text-center align-middle">
                    <span class="badge badge-pill badge-light" style="font-size: 12px; font-weight: 700; border: 1px solid #cbd5e1; padding: 4px 10px;">
                      #<?=$row['Urutan']?>
                    </span>
                  </td>
                  <td class="text-center align-middle">
                    <div class="d-inline-flex align-items-center" style="gap: 6px;">
                      <button type="button" class="btn btn-sm btn-warning btnEditMicrosite" 
                              data-id="<?=$row['Id']?>"
                              data-microsite="<?=htmlspecialchars($row['Microsite'])?>"
                              data-kategori="<?=htmlspecialchars($row['Kategori'])?>"
                              data-namadokumen="<?=htmlspecialchars($row['NamaDokumen'])?>"
                              data-url="<?=htmlspecialchars($row['Url'] ?? '')?>"
                              data-urutan="<?=$row['Urutan']?>"
                              title="Edit Dokumen">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-danger btnHapusMicrosite" 
                              data-id="<?=$row['Id']?>"
                              data-namadokumen="<?=htmlspecialchars($row['NamaDokumen'])?>"
                              title="Hapus Dokumen">
                        <i class="fa-solid fa-trash-can"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL TAMBAH LINK MICROSITE
     ========================================================================= -->
<div class="modal fade" id="ModalInputMicrosite" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.2); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, var(--ide-navy) 0%, #0a3d7c 100%); color: #ffffff; padding: 18px 24px; border: none;">
        <h5 class="modal-title" style="font-weight: 800; font-size: 16px; letter-spacing: 0.5px; text-transform: uppercase;">
          <i class="fa-solid fa-plus-circle mr-2"></i> Tambah Link Dokumen Microsite
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formInputMicrosite">
        <div class="modal-body" style="padding: 24px;">
          <!-- Pilih Microsite -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Pilih / Ketik Slug Microsite <span class="text-danger">*</span></label>
            <input type="text" list="micrositeDatalist" name="Microsite" class="form-control" placeholder="Contoh: ippd-situbondo atau ippd-banyuwangi" value="<?=!empty($SelectedSite) ? $SelectedSite : 'ippd-situbondo'?>" required style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 14px;">
            <datalist id="micrositeDatalist">
              <option value="ippd-situbondo">IPPD Situbondo</option>
              <option value="ippd-banyuwangi">IPPD Banyuwangi</option>
              <?php foreach ($MicrositeList as $m): ?>
                <option value="<?=$m['Microsite']?>"><?=$m['Microsite']?></option>
              <?php endforeach; ?>
            </datalist>
            <small class="text-muted">Gunakan huruf kecil tanpa spasi (contoh: <code>ippd-situbondo</code>).</small>
          </div>

          <!-- Kategori / Accordion -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Kategori / Nama Menu Accordion <span class="text-danger">*</span></label>
            <input type="text" list="kategoriDatalist" name="Kategori" class="form-control" placeholder="Contoh: Laporan, Upload Dokumen, Justifikasi Penilaian" required style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 14px;">
            <datalist id="kategoriDatalist">
              <option value="Laporan">
              <option value="Upload Dokumen">
              <option value="Justifikasi Penilaian">
              <?php foreach ($KategoriList as $k): ?>
                <option value="<?=$k['Kategori']?>">
              <?php endforeach; ?>
            </datalist>
          </div>

          <!-- Nama Dokumen / Button Label -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Nama Dokumen / Teks Tombol <span class="text-danger">*</span></label>
            <input type="text" name="NamaDokumen" class="form-control" placeholder="Contoh: BAB I, Kertas Kerja, P RENJA 2025" required style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 14px;">
          </div>

          <!-- URL Link -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Tautan Link (Google Drive / Docs / Spreadsheet / Web)</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-brands fa-google-drive text-success"></i></span>
              </div>
              <input type="url" name="Url" class="form-control" placeholder="https://docs.google.com/... atau https://drive.google.com/..." style="border-radius: 0 10px 10px 0; border: 1.5px solid #cbd5e1; font-size: 13px;">
            </div>
            <small class="text-muted">Bisa dikosongkan terlebih dahulu jika dokumen belum diunggah.</small>
          </div>

          <!-- Urutan Tampil -->
          <div class="form-group mb-0">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Nomor Urutan Tampil (Di dalam Accordion)</label>
            <input type="number" name="Urutan" class="form-control" value="1" min="1" style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; width: 120px;">
          </div>
        </div>
        <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 24px; display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: 600; padding: 8px 18px;">Batal</button>
          <button type="submit" class="btn btn-primary" id="btnSimpanInput" style="border-radius: 10px; font-weight: 700; padding: 8px 22px; background: var(--ide-navy); border: none;">
            <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Data
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL EDIT LINK MICROSITE
     ========================================================================= -->
<div class="modal fade" id="ModalEditMicrosite" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.2); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff; padding: 18px 24px; border: none;">
        <h5 class="modal-title" style="font-weight: 800; font-size: 16px; letter-spacing: 0.5px; text-transform: uppercase;">
          <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Dokumen Microsite
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formEditMicrosite">
        <input type="hidden" name="Id" id="edit_id">
        <div class="modal-body" style="padding: 24px;">
          <!-- Pilih Microsite -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Slug Microsite <span class="text-danger">*</span></label>
            <input type="text" list="micrositeDatalist" name="Microsite" id="edit_microsite" class="form-control" required style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 14px;">
          </div>

          <!-- Kategori / Accordion -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Kategori / Nama Menu Accordion <span class="text-danger">*</span></label>
            <input type="text" list="kategoriDatalist" name="Kategori" id="edit_kategori" class="form-control" required style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 14px;">
          </div>

          <!-- Nama Dokumen / Button Label -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Nama Dokumen / Teks Tombol <span class="text-danger">*</span></label>
            <input type="text" name="NamaDokumen" id="edit_namadokumen" class="form-control" required style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 14px;">
          </div>

          <!-- URL Link -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Tautan Link (Google Drive / Docs / Spreadsheet / Web)</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-brands fa-google-drive text-success"></i></span>
              </div>
              <input type="url" name="Url" id="edit_url" class="form-control" placeholder="https://docs.google.com/..." style="border-radius: 0 10px 10px 0; border: 1.5px solid #cbd5e1; font-size: 13px;">
            </div>
          </div>

          <!-- Urutan Tampil -->
          <div class="form-group mb-0">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Nomor Urutan Tampil</label>
            <input type="number" name="Urutan" id="edit_urutan" class="form-control" min="1" style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; width: 120px;">
          </div>
        </div>
        <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 24px; display: flex; justify-content: flex-end; gap: 10px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: 600; padding: 8px 18px;">Batal</button>
          <button type="submit" class="btn btn-warning" id="btnSimpanEdit" style="border-radius: 10px; font-weight: 700; padding: 8px 22px; color: #ffffff;">
            <i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Data
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL KONFIRMASI HAPUS
     ========================================================================= -->
<div class="modal fade" id="ModalHapusMicrosite" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 440px;">
    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.25); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, var(--ide-red) 0%, #ee626b 100%); color: #ffffff; padding: 18px 24px; border: none;">
        <h5 class="modal-title" style="font-weight: 800; font-size: 16px; letter-spacing: 0.5px; text-transform: uppercase;">
          <i class="fa-solid fa-triangle-exclamation mr-2"></i> Konfirmasi Hapus
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-4">
        <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 64px; height: 64px; background: rgba(180, 8, 20, 0.1); color: var(--ide-red);">
          <i class="fa-solid fa-trash-can" style="font-size: 28px;"></i>
        </div>
        <h5 class="font-weight-bold text-dark mb-1">Hapus Dokumen Ini?</h5>
        <p class="text-muted mb-0" style="font-size: 13px;" id="textHapusMicrosite">
          Dokumen ini akan dihapus permanen dari microsite.
        </p>
      </div>
      <div class="modal-footer justify-content-center p-3" style="background-color: #f8fafc; border-top: 1px solid #f1f5f9; gap: 10px;">
        <button type="button" class="btn btn-secondary px-4 py-2" data-dismiss="modal" style="border-radius: 12px; font-weight: 600;">Batal</button>
        <button type="button" class="btn btn-danger px-4 py-2" id="btnKonfirmasiHapus" style="border-radius: 12px; font-weight: 700; background: var(--ide-red); border: none;">
          <i class="fa-solid fa-trash-can mr-1"></i> Ya, Hapus
        </button>
      </div>
    </div>
  </div>
</div>

<script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
<script src="<?=base_url("assets/datatables-bs4/js/dataTables.bootstrap4.js")?>"></script>
<script>
  $(document).ready(function() {
    // Inisialisasi DataTable
    var table = $('#TabelMicrosite').DataTable({
      "pageLength": 10,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
      "language": {
        "lengthMenu": "Tampilkan _MENU_ data",
        "zeroRecords": "Tidak ada data link microsite ditemukan",
        "info": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
        "infoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
        "infoFiltered": "(difilter dari _MAX_ total data)",
        "search": "Cari Dokumen:",
        "paginate": {
          "first": '<i class="fa-solid fa-angles-left"></i>',
          "last": '<i class="fa-solid fa-angles-right"></i>',
          "next": '<i class="fa-solid fa-chevron-right"></i>',
          "previous": '<i class="fa-solid fa-chevron-left"></i>'
        }
      },
      "order": [[1, "asc"], [2, "asc"], [5, "asc"]]
    });

    // Form Tambah Link Microsite
    $('#formInputMicrosite').on('submit', function(e) {
      e.preventDefault();
      var btn = $('#btnSimpanInput');
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan...');

      $.ajax({
        url: '<?=base_url("Staf/InputMicrosite")?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Data');
          if (resp === '1') {
            $('#ModalInputMicrosite').modal('hide');
            alert('Link dokumen microsite berhasil disimpan!');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Data');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // Tombol Edit Link Microsite
    $(document).on('click', '.btnEditMicrosite', function() {
      var id = $(this).data('id');
      var microsite = $(this).data('microsite');
      var kategori = $(this).data('kategori');
      var namaDokumen = $(this).data('namadokumen');
      var url = $(this).data('url');
      var urutan = $(this).data('urutan');

      $('#edit_id').val(id);
      $('#edit_microsite').val(microsite);
      $('#edit_kategori').val(kategori);
      $('#edit_namadokumen').val(namaDokumen);
      $('#edit_url').val(url);
      $('#edit_urutan').val(urutan);

      $('#ModalEditMicrosite').modal('show');
    });

    // Form Edit Link Microsite
    $('#formEditMicrosite').on('submit', function(e) {
      e.preventDefault();
      var btn = $('#btnSimpanEdit');
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memperbarui...');

      $.ajax({
        url: '<?=base_url("Staf/EditMicrosite")?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Data');
          if (resp === '1') {
            $('#ModalEditMicrosite').modal('hide');
            alert('Dokumen microsite berhasil diperbarui!');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Data');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // Tombol Hapus Link Microsite
    var hapusId = null;
    $(document).on('click', '.btnHapusMicrosite', function() {
      hapusId = $(this).data('id');
      var namaDokumen = $(this).data('namadokumen');
      $('#textHapusMicrosite').html('Yakin ingin menghapus dokumen <b>"' + namaDokumen + '"</b>?');
      $('#ModalHapusMicrosite').modal('show');
    });

    $('#btnKonfirmasiHapus').on('click', function() {
      if (!hapusId) return;
      var btn = $(this);
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menghapus...');

      $.ajax({
        url: '<?=base_url("Staf/HapusMicrosite")?>',
        type: 'POST',
        data: { Id: hapusId },
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-trash-can mr-1"></i> Ya, Hapus');
          if (resp === '1') {
            $('#ModalHapusMicrosite').modal('hide');
            alert('Dokumen berhasil dihapus!');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-trash-can mr-1"></i> Ya, Hapus');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });
  });
</script>
