<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

// Helper rekursif untuk merender pilihan Parent di dropdown Modal (Hirarki bertingkat)
function renderParentOptions($nodes, $prefix = '', $excludeId = 0) {
  $html = '';
  foreach ($nodes as $node) {
    if ($node['Tipe'] !== 'grup') continue;
    if ($excludeId > 0 && $node['Id'] == $excludeId) continue;

    $indent = empty($prefix) ? '' : $prefix . '↳ ';
    $html .= '<option value="' . $node['Id'] . '">';
    $html .= $indent . htmlspecialchars($node['Judul']);
    $html .= '</option>';

    if (!empty($node['children'])) {
      $html .= renderParentOptions($node['children'], $prefix . '&nbsp;&nbsp;&nbsp;&nbsp;', $excludeId);
    }
  }
  return $html;
}

// Helper rekursif untuk merender tree item di tampilan Staf Builder
function renderBuilderTree($nodes, $level = 1) {
  if (empty($nodes)) return '';

  // Pisahkan dokumen langsung (link) dan sub-bab (grup)
  // Dokumen langsung SELALU tampil tepat di bawah bab induk sebelum daftar sub-bab
  $links = array();
  $groups = array();
  foreach ($nodes as $n) {
    if ($n['Tipe'] === 'link') {
      $links[] = $n;
    } else {
      $groups[] = $n;
    }
  }
  $sortedNodes = array_merge($links, $groups);

  $html = '<ul class="builder-tree-list level-' . $level . '">';
  foreach ($sortedNodes as $node) {
    $isGroup = ($node['Tipe'] === 'grup');
    $hasChildren = !empty($node['children']) && count($node['children']) > 0;
    
    $badgeType = '';
    if ($level === 1) {
      $badgeType = '<span class="node-badge badge-bab">Bab Utama</span>';
    } else if ($isGroup) {
      $labelSub = ($level == 2) ? 'Sub-Bab' : 'Sub-Bab (Tingkat ' . $level . ')';
      $badgeType = '<span class="node-badge badge-subbab">' . $labelSub . '</span>';
    } else {
      $badgeType = '<span class="node-badge badge-dokumen">Dokumen Google Drive</span>';
    }

    $itemTypeClass = $isGroup ? 'tree-item-group' : 'tree-item-link';
    $html .= '<li class="builder-tree-item ' . $itemTypeClass . ' item-level-' . $level . '" id="item-node-' . $node['Id'] . '" data-id="' . $node['Id'] . '">';
    $html .= '  <div class="tree-card ' . ($isGroup ? 'tree-card-group' : 'tree-card-link') . '">';
    $html .= '    <div class="tree-card-left">';
    $html .= '      <span class="tree-drag-handle" title="Klik & tahan untuk menggeser urutan"><i class="fa-solid fa-bars-staggered"></i></span>';
    $html .= '      <div>';
    $html .= '        <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">';
    $html .= '          <h6 class="tree-title mb-0">' . htmlspecialchars($node['Judul']) . '</h6>';
    $html .=            $badgeType;
    $html .= '          <span class="tree-order-badge">#' . $node['Urutan'] . '</span>';
    $html .= '        </div>';
    if (!$isGroup && !empty($node['Url'])) {
      $html .= '        <div class="tree-url-preview">';
      $html .= '          <a href="' . htmlspecialchars($node['Url']) . '" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-google-drive text-success mr-1"></i> ' . htmlspecialchars($node['Url']) . '</a>';
      $html .= '        </div>';
    } else if (!$isGroup && empty($node['Url'])) {
      $html .= '        <div class="tree-url-preview text-muted"><em>(Belum ada link URL)</em></div>';
    }
    $html .= '      </div>';
    $html .= '    </div>';

    // Action Buttons
    $html .= '    <div class="tree-card-right">';
    if ($isGroup) {
      $html .= '      <button type="button" class="btn btn-sm btn-outline-primary btnAddChildItem" data-parent-id="' . $node['Id'] . '" data-parent-title="' . htmlspecialchars($node['Judul'], ENT_QUOTES, 'UTF-8') . '" data-tipe="grup" title="Tambah Sub-Bab di dalam ' . htmlspecialchars($node['Judul']) . '">';
      $html .= '        <i class="fa-solid fa-folder-plus"></i> + Sub-Bab';
      $html .= '      </button>';
      $html .= '      <button type="button" class="btn btn-sm btn-outline-success btnAddChildItem" data-parent-id="' . $node['Id'] . '" data-parent-title="' . htmlspecialchars($node['Judul'], ENT_QUOTES, 'UTF-8') . '" data-tipe="link" title="Tambah Dokumen di dalam ' . htmlspecialchars($node['Judul']) . '">';
      $html .= '        <i class="fa-solid fa-folder-plus"></i> + Dokumen';
      $html .= '      </button>';
    }
    $html .= '      <button type="button" class="btn btn-sm btn-warning btnEditItem" data-id="' . $node['Id'] . '" data-parent-id="' . $node['ParentId'] . '" data-tipe="' . htmlspecialchars($node['Tipe']) . '" data-judul="' . htmlspecialchars($node['Judul'], ENT_QUOTES, 'UTF-8') . '" data-url="' . htmlspecialchars($node['Url'] ?? '', ENT_QUOTES, 'UTF-8') . '" data-urutan="' . $node['Urutan'] . '" title="Edit Item">';
    $html .= '        <i class="fa-solid fa-pen-to-square"></i>';
    $html .= '      </button>';
    $html .= '      <button type="button" class="btn btn-sm btn-danger btnHapusItem" data-id="' . $node['Id'] . '" data-judul="' . htmlspecialchars($node['Judul'], ENT_QUOTES, 'UTF-8') . '" data-is-group="' . ($isGroup ? '1' : '0') . '" title="Hapus Item">';
    $html .= '        <i class="fa-solid fa-trash-can"></i>';
    $html .= '      </button>';
    $html .= '    </div>';
    $html .= '  </div>';

    if ($hasChildren) {
      $html .= renderBuilderTree($node['children'], $level + 1);
    }
    $html .= '</li>';
  }
  $html .= '</ul>';
  return $html;
}
?>

<style>
  .builder-header-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid var(--ide-border);
    box-shadow: 0 8px 24px rgba(4, 49, 104, 0.05);
    padding: 20px 26px;
    margin-top: 22px;
  }
  .builder-tree-container {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid var(--ide-border);
    box-shadow: 0 8px 24px rgba(4, 49, 104, 0.05);
    padding: 24px;
  }
  .builder-tree-list {
    list-style: none;
    padding-left: 0;
    margin-bottom: 0;
  }
  .builder-tree-list.level-2 {
    padding-left: 32px;
    margin-top: 10px;
    border-left: 2px dashed #cbd5e1;
    margin-left: 18px;
  }
  .builder-tree-list.level-3 {
    padding-left: 32px;
    margin-top: 10px;
    border-left: 2px dashed #f59e0b;
    margin-left: 18px;
  }
  .builder-tree-list.level-4,
  .builder-tree-list.level-5 {
    padding-left: 28px;
    margin-top: 10px;
    border-left: 2px dashed #8b5cf6;
    margin-left: 16px;
  }
  .builder-tree-item {
    margin-bottom: 12px;
    position: relative;
  }

  /* Sub-Bab yang berada di dalam Bab Utama (Level 2+) digeser lebih ke kanan agar tidak sejajar dengan dokumen langsung */
  .builder-tree-item.tree-item-group.item-level-2 {
    margin-left: 45px;
    margin-top: 18px;
    position: relative;
  }
  .builder-tree-item.tree-item-group.item-level-2::before {
    content: '';
    position: absolute;
    top: 24px;
    left: -45px;
    width: 40px;
    height: 2px;
    border-top: 2px dashed #94a3b8;
  }
  .builder-tree-item.tree-item-group.item-level-3 {
    margin-left: 40px;
    margin-top: 16px;
    position: relative;
  }
  .builder-tree-item.tree-item-group.item-level-3::before {
    content: '';
    position: absolute;
    top: 24px;
    left: -40px;
    width: 35px;
    height: 2px;
    border-top: 2px dashed #94a3b8;
  }
  .builder-tree-item.tree-item-group.item-level-4 {
    margin-left: 35px;
    margin-top: 14px;
  }

  .tree-card {
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 14px;
    padding: 12px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    transition: all 0.2s ease;
  }
  .tree-card:hover {
    background: #ffffff;
    border-color: #cbd5e1;
    box-shadow: 0 4px 12px rgba(4, 49, 104, 0.06);
    transform: translateX(3px);
  }
  .tree-card-group {
    background: #f1f5f9;
    border-left: 5px solid var(--ide-navy) !important;
  }

  /* Sub-Bab bertingkat konsisten berwarna sama dengan Bab Utama */
  .item-level-2 > .tree-card-group,
  .item-level-3 > .tree-card-group,
  .item-level-4 > .tree-card-group {
    background: #f1f5f9;
    border: 1.5px solid #cbd5e1;
    border-left: 5px solid var(--ide-navy) !important;
    box-shadow: 0 2px 8px rgba(4, 49, 104, 0.05);
  }
  .item-level-2 > .tree-card-group .tree-title,
  .item-level-3 > .tree-card-group .tree-title,
  .item-level-4 > .tree-card-group .tree-title {
    color: #1e293b;
  }

  .tree-card-link {
    background: #ffffff !important;
    border: 1.5px solid #e2e8f0;
    border-left: 5px solid #10b981 !important;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
  }
  .tree-card-left {
    display: flex;
    align-items: center;
    gap: 14px;
    flex: 1;
  }
  .tree-drag-handle {
    color: #94a3b8;
    font-size: 15px;
    cursor: grab;
    padding: 6px 8px;
    border-radius: 8px;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }
  .tree-drag-handle:hover {
    background: #e2e8f0;
    color: var(--ide-navy);
  }
  .tree-drag-handle:active {
    cursor: grabbing;
  }
  .sortable-ghost {
    opacity: 0.35;
    background: #dbeafe !important;
    border: 2px dashed #0284c7 !important;
    border-radius: 14px !important;
  }
  .sortable-chosen > .tree-card {
    box-shadow: 0 14px 32px rgba(4, 49, 104, 0.18) !important;
    border-color: #0284c7 !important;
    background: #ffffff !important;
  }
  .tree-icon {
    font-size: 18px;
    color: var(--ide-navy);
  }
  .tree-title {
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
  }
  .tree-url-preview {
    font-size: 12px;
    margin-top: 3px;
  }
  .tree-url-preview a {
    color: #0369a1;
    text-decoration: none;
    word-break: break-all;
  }
  .tree-url-preview a:hover {
    text-decoration: underline;
  }
  .node-badge {
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.3px;
  }
  .badge-bab {
    background-color: #e0f2fe;
    color: #0369a1;
    border: 1px solid #bae6fd;
  }
  .badge-subbab {
    background-color: #e0f2fe;
    color: #0369a1;
    border: 1px solid #bae6fd;
  }
  .badge-dokumen {
    background-color: #dcfce7;
    color: #15803d;
    border: 1px solid #bbf7d0;
  }
  .tree-order-badge {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 2px 7px;
    font-size: 11px;
    font-weight: 700;
    color: #475569;
  }
  .tree-card-right {
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .tree-card-right .btn {
    border-radius: 8px;
    font-weight: 600;
    font-size: 11.5px;
    padding: 5px 10px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
</style>

<!-- Header Breadcrumb & Actions -->
<div class="row mb-3">
  <div class="col-12">
    <div class="builder-header-card">
      <div class="d-flex flex-wrap align-items-center justify-content-between" style="gap: 16px;">
        <div class="d-flex align-items-center" style="gap: 16px;">
          <a href="<?=base_url('Staf/Microsite')?>" class="btn btn-secondary" style="border-radius: 12px; font-weight: 600; padding: 10px 16px; background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Katalog
          </a>
          <div>
            <div class="d-flex align-items-center" style="gap: 10px;">
              <h4 class="font-weight-bold text-dark mb-0" style="font-size: 18px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                Struktur Bab & Sub-Bab: <?=htmlspecialchars($Microsite['Judul'])?>
              </h4>
              <span class="badge badge-primary px-2 py-1" style="background: var(--ide-navy); font-size: 11px; font-weight: 600; border-radius: 6px;">
                /<?=$Microsite['Slug']?>
              </span>
            </div>
            <p class="text-muted mb-0 mt-1" style="font-size: 12.5px;">
              Susun Bab Utama, Sub-Bab bertingkat, dan tautan dokumen Google Drive / Docs secara rapi dan hierarkis.
            </p>
          </div>
        </div>

        <div class="d-flex flex-wrap align-items-center" style="gap: 10px;">
          <a href="<?=base_url('IDE/Microsite/'.$Microsite['Slug'])?>" target="_blank" class="btn btn-outline-info" style="border-radius: 10px; font-weight: 600; font-size: 12.5px; padding: 8px 16px;">
            <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> Buka Tampilan Publik
          </a>
          <button type="button" class="btn btn-primary btnAddRootBab" style="border-radius: 10px; font-weight: 700; font-size: 13px; padding: 9px 20px; background: var(--ide-navy); border: none; box-shadow: 0 4px 14px rgba(4, 49, 104, 0.3);">
            <i class="fa-solid fa-folder-plus mr-1"></i> + Tambah Bab Utama
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tree Structure Container -->
<div class="row">
  <div class="col-12">
    <div class="builder-tree-container">
      <div class="d-flex align-items-center justify-content-between mb-3 pb-2" style="border-bottom: 2px solid #f1f5f9;">
        <h5 class="font-weight-bold text-dark mb-0" style="font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px;">
          <i class="fa-solid fa-sitemap mr-2 text-primary"></i> Struktur Hirarki Bab, Sub-Bab & Dokumen
        </h5>
        <span class="badge badge-light px-3 py-2" style="border: 1px solid #cbd5e1; font-weight: 600; font-size: 12px;">
          Total <?=count($AllItems)?> Item Terdaftar
        </span>
      </div>

      <?php if (!empty($Tree) && count($Tree) > 0): ?>
        <?=renderBuilderTree($Tree, 1)?>
      <?php else: ?>
        <div class="text-center py-5">
          <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 64px; height: 64px; background: rgba(4, 49, 104, 0.08); color: var(--ide-navy);">
            <i class="fa-solid fa-folder-open" style="font-size: 28px;"></i>
          </div>
          <h5 class="font-weight-bold text-dark mb-1">Belum Ada Bab yang Dibuat</h5>
          <p class="text-muted mb-3" style="font-size: 13px;">Mulai dengan membuat Bab Utama pertama untuk microsite ini.</p>
          <button type="button" class="btn btn-primary btnAddRootBab" style="border-radius: 10px; font-weight: 700; padding: 8px 20px; background: var(--ide-navy); border: none;">
            <i class="fa-solid fa-plus-circle mr-1"></i> Tambah Bab Utama Sekarang
          </button>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL TAMBAH ITEM (BAB / SUB-BAB / DOKUMEN GOOGLE DRIVE)
     ========================================================================= -->
<div class="modal fade" id="ModalInputItem" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 580px;">
    <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.2); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, var(--ide-navy) 0%, #0a3d7c 100%); color: #ffffff; padding: 18px 26px; border: none;">
        <h5 class="modal-title" id="modalInputItemTitle" style="font-weight: 800; font-size: 16px; letter-spacing: 0.5px; text-transform: uppercase;">
          <i class="fa-solid fa-plus-circle mr-2"></i> Tambah Item Baru
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formInputItem">
        <input type="hidden" name="MicrositeId" value="<?=$Microsite['Id']?>">
        <input type="hidden" name="Tipe" id="input_tipe" value="grup">
        <input type="hidden" name="ParentId" id="input_parent_id" value="0">
        <div class="modal-body" style="padding: 24px;">
          <!-- Info Posisi Induk Otomatis Sesuai Tombol yang Diklik -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;" id="label_input_parent">Posisi Induk / Parent <span class="text-danger">*</span></label>
            <div class="d-flex align-items-center p-2 px-3 rounded" style="background: #f1f5f9; border: 1.5px solid #cbd5e1; font-weight: 700; color: #1e293b; font-size: 13.5px;">
              <span id="textParentInfo">[ Bab Utama - Level Teratas (Root) ]</span>
            </div>
            <small class="text-muted" id="noteParentInfo">Otomatis ditetapkan berdasarkan tombol + yang Anda pilih.</small>
          </div>

          <!-- Judul / Nama Item -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;" id="label_input_judul">Judul / Nama <span class="text-danger">*</span></label>
            <input type="text" name="Judul" id="input_judul" class="form-control" placeholder="Contoh: BAB I: Pendahuluan atau Kertas Kerja" required style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 14px;">
          </div>

          <!-- URL Link Google Drive (Hanya untuk Dokumen / Link) -->
          <div class="form-group mb-3" id="groupInputUrl" style="display: none;">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Tautan Link Google Drive (Docs / Sheets / Folder) <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-brands fa-google-drive text-success"></i></span>
              </div>
              <input type="url" name="Url" id="input_url" class="form-control" placeholder="https://drive.google.com/... atau https://docs.google.com/..." style="border-radius: 0 10px 10px 0; border: 1.5px solid #cbd5e1; font-size: 13px;">
            </div>
            <small class="text-muted">Masukkan link sharing Google Drive / Spreadsheet / Docs.</small>
          </div>

          <!-- Nomor Urutan -->
          <!-- Nomor Urutan Otomatis -->
          <input type="hidden" name="Urutan" id="input_urutan" value="0">
          <div class="alert alert-light border d-flex align-items-center mb-0" style="border-radius: 10px; padding: 10px 14px; background: #f8fafc;">
            <i class="fa-solid fa-arrows-up-down text-primary mr-2" style="font-size: 16px;"></i>
            <small class="text-muted">Item baru otomatis ditempatkan di posisi paling akhir. Anda dapat langsung menggeser posisinya (drag & drop) di halaman builder.</small>
          </div>
        </div>
        <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 24px; gap: 10px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: 600;">Batal</button>
          <button type="submit" class="btn btn-primary" id="btnSimpanItem" style="border-radius: 10px; font-weight: 700; background: var(--ide-navy); border: none; padding: 9px 24px;">
            <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Item
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL EDIT ITEM
     ========================================================================= -->
<div class="modal fade" id="ModalEditItem" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 580px;">
    <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.2); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff; padding: 18px 26px; border: none;">
        <h5 class="modal-title" id="modalEditItemTitle" style="font-weight: 800; font-size: 16px; letter-spacing: 0.5px; text-transform: uppercase;">
          <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Item
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formEditItem">
        <input type="hidden" name="Id" id="edit_item_id">
        <input type="hidden" name="Tipe" id="edit_item_tipe" value="grup">
        <div class="modal-body" style="padding: 24px;">
          <!-- Induk / Parent Item -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Posisi Induk / Parent <span class="text-danger">*</span></label>
            <select name="ParentId" id="edit_parent_id" class="form-control" style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600;">
              <option value="0">[ Bab Utama - Level Teratas (Root) ]</option>
              <?=renderParentOptions($Tree)?>
            </select>
          </div>

          <!-- Judul / Nama Item -->
          <div class="form-group mb-3">
            <label class="font-weight-bold text-dark" style="font-size: 13px;" id="label_edit_item_judul">Judul / Nama <span class="text-danger">*</span></label>
            <input type="text" name="Judul" id="edit_item_judul" class="form-control" required style="border-radius: 10px; border: 1.5px solid #cbd5e1; font-weight: 600; padding: 10px 14px;">
          </div>

          <!-- URL Link Google Drive -->
          <div class="form-group mb-3" id="groupEditUrl">
            <label class="font-weight-bold text-dark" style="font-size: 13px;">Tautan Link Google Drive (Docs / Sheets / Folder) <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa-brands fa-google-drive text-success"></i></span>
              </div>
              <input type="url" name="Url" id="edit_item_url" class="form-control" placeholder="https://drive.google.com/... atau https://docs.google.com/..." style="border-radius: 0 10px 10px 0; border: 1.5px solid #cbd5e1; font-size: 13px;">
            </div>
            <small class="text-muted">Masukkan link sharing Google Drive / Spreadsheet / Docs.</small>
          </div>

          <!-- Nomor Urutan Otomatis -->
          <input type="hidden" name="Urutan" id="edit_item_urutan">
          <div class="alert alert-light border d-flex align-items-center mb-0" style="border-radius: 10px; padding: 10px 14px; background: #f8fafc;">
            <i class="fa-solid fa-arrows-up-down text-warning mr-2" style="font-size: 16px;"></i>
            <small class="text-muted">Nomor urutan posisi item dapat langsung digeser (drag & drop) pada tampilan tree.</small>
          </div>
        </div>
        <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 24px; gap: 10px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: 600;">Batal</button>
          <button type="submit" class="btn btn-warning text-white" id="btnPerbaruiItem" style="border-radius: 10px; font-weight: 700; padding: 9px 24px;">
            <i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Item
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- =========================================================================
     MODAL HAPUS ITEM
     ========================================================================= -->
<div class="modal fade" id="ModalHapusItem" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 440px;">
    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.25); overflow: hidden;">
      <div class="modal-header" style="background: linear-gradient(135deg, var(--ide-red) 0%, #ee626b 100%); color: #ffffff; padding: 18px 24px; border: none;">
        <h5 class="modal-title" style="font-weight: 800; font-size: 16px; letter-spacing: 0.5px; text-transform: uppercase;">
          <i class="fa-solid fa-triangle-exclamation mr-2"></i> Konfirmasi Hapus Item
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-4">
        <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 64px; height: 64px; background: rgba(180, 8, 20, 0.1); color: var(--ide-red);">
          <i class="fa-solid fa-trash-can" style="font-size: 28px;"></i>
        </div>
        <h5 class="font-weight-bold text-dark mb-1">Hapus Item Ini?</h5>
        <p class="text-muted mb-0" style="font-size: 13px;" id="textHapusItem">
          Jika item ini adalah Bab/Sub-Bab, seluruh anak sub-bab dan dokumen di dalamnya akan ikut terhapus.
        </p>
      </div>
      <div class="modal-footer justify-content-center p-3" style="background-color: #f8fafc; border-top: 1px solid #f1f5f9; gap: 10px;">
        <button type="button" class="btn btn-secondary px-4 py-2" data-dismiss="modal" style="border-radius: 12px; font-weight: 600;">Batal</button>
        <button type="button" class="btn btn-danger px-4 py-2" id="btnKonfirmasiHapusItem" style="border-radius: 12px; font-weight: 700; background: var(--ide-red); border: none;">
          <i class="fa-solid fa-trash-can mr-1"></i> Ya, Hapus Item
        </button>
      </div>
    </div>
  </div>
</div>

        </div>
      </div>
    </div>

<!-- Toast Notifikasi Real-time Reorder -->
<div id="treeToast" style="display: none; position: fixed; bottom: 30px; right: 30px; z-index: 99999; background: #043168; color: #ffffff; padding: 12px 24px; border-radius: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.25); font-weight: 600; font-size: 13.5px; align-items: center; gap: 10px;">
  <i class="fa-solid fa-circle-check text-success" id="treeToastIcon" style="font-size: 16px;"></i>
  <span id="treeToastText">Urutan berhasil disimpan!</span>
</div>

<script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
<script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
<script src="<?=base_url("build/js/custom.min.js")?>"></script>
<!-- SortableJS untuk Drag and Drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<script>
  $(document).ready(function() {
    var BaseURL = '<?=base_url()?>';
    var micrositeId = <?=(int)$Microsite['Id']?>;

    // Fungsi Notifikasi Toast Sederhana
    function showToast(msg, type) {
      var toast = $('#treeToast');
      var icon = $('#treeToastIcon');
      var text = $('#treeToastText');
      
      text.text(msg);
      if (type === 'success') {
        icon.attr('class', 'fa-solid fa-circle-check text-success mr-2');
        toast.css('background', '#043168');
      } else if (type === 'info') {
        icon.attr('class', 'fa-solid fa-spinner fa-spin text-info mr-2');
        toast.css('background', '#0f172a');
      } else {
        icon.attr('class', 'fa-solid fa-circle-exclamation text-danger mr-2');
        toast.css('background', '#7f1d1d');
      }
      
      toast.stop(true, true).fadeIn(200);
      if (type !== 'info') {
        setTimeout(function() {
          toast.fadeOut(400);
        }, 2200);
      }
    }

    // Inisialisasi Drag & Drop untuk setiap tingkat list
    function initTreeSortable() {
      $('.builder-tree-list').each(function() {
        var listEl = this;
        new Sortable(listEl, {
          handle: '.tree-drag-handle',
          animation: 200,
          ghostClass: 'sortable-ghost',
          chosenClass: 'sortable-chosen',
          onEnd: function(evt) {
            var orderedIds = [];
            $(listEl).children('.builder-tree-item').each(function(idx) {
              var itemId = $(this).data('id');
              if (itemId) {
                orderedIds.push(itemId);
                // Update badge urutan visual seketika
                $(this).find('> .tree-card .tree-order-badge').first().text('#' + (idx + 1));
              }
            });

            if (orderedIds.length > 0) {
              showToast('Menyimpan urutan baru...', 'info');
              $.ajax({
                url: BaseURL + 'Staf/ReorderMicrositeItems',
                type: 'POST',
                data: {
                  MicrositeId: micrositeId,
                  Items: orderedIds
                },
                dataType: 'json',
                success: function(res) {
                  if (res && res.status === 'success') {
                    showToast('Urutan berhasil diperbarui!', 'success');
                  } else {
                    showToast('Gagal menyimpan urutan', 'error');
                  }
                },
                error: function() {
                  showToast('Terjadi kesalahan koneksi server', 'error');
                }
              });
            }
          }
        });
      });
    }

    initTreeSortable();

    // Tombol + Tambah Bab Utama
    $(document).on('click', '.btnAddRootBab', function(e) {
      e.preventDefault();
      $('#modalInputItemTitle').html('<i class="fa-solid fa-folder-plus mr-2"></i> Tambah Bab Utama Baru');
      $('#input_tipe').val('grup');
      $('#input_parent_id').val('0');
      $('#textParentInfo').html('[ Bab Utama - Level Teratas (Root) ]');
      $('#noteParentInfo').html('Item ini akan menjadi Bab Utama di tingkat paling luar.');
      $('#label_input_judul').html('Nama Bab Utama <span class="text-danger">*</span>');
      $('#input_judul').attr('placeholder', 'Contoh: BAB I: Pendahuluan');
      $('#groupInputUrl').hide();
      $('#input_judul').val('');
      $('#input_url').val('');
      $('#input_urutan').val('0');
      $('#ModalInputItem').modal('show');
    });

    // Tombol + Tambah Sub-Bab / Dokumen Google Drive pada Parent tertentu
    $(document).on('click', '.btnAddChildItem', function(e) {
      e.preventDefault();
      var parentId = $(this).data('parent-id');
      var parentTitle = $(this).data('parent-title');
      var tipe = $(this).data('tipe');

      if (tipe === 'grup') {
        $('#modalInputItemTitle').html('<i class="fa-solid fa-folder-plus mr-2"></i> Tambah Sub-Bab Baru');
        $('#input_tipe').val('grup');
        $('#label_input_judul').html('Nama Sub-Bab <span class="text-danger">*</span>');
        $('#input_judul').attr('placeholder', 'Contoh: Sub-Bab 1.1: Dasar Hukum');
        $('#groupInputUrl').hide();
        $('#textParentInfo').html('↳ Di dalam Sub-Bab: ' + $('<div>').text(parentTitle).html());
        $('#noteParentInfo').html('Sub-Bab baru ini otomatis diletakkan di dalam "' + $('<div>').text(parentTitle).html() + '".');
      } else {
        $('#modalInputItemTitle').html('<i class="fa-brands fa-google-drive mr-2"></i> Tambah Dokumen Google Drive');
        $('#input_tipe').val('link');
        $('#label_input_judul').html('Nama Dokumen <span class="text-danger">*</span>');
        $('#input_judul').attr('placeholder', 'Contoh: Kertas Kerja Evaluasi / Laporan Akhir');
        $('#groupInputUrl').show();
        $('#textParentInfo').html('↳ Di dalam: ' + $('<div>').text(parentTitle).html());
        $('#noteParentInfo').html('Dokumen Google Drive ini otomatis diletakkan di dalam "' + $('<div>').text(parentTitle).html() + '".');
      }

      $('#input_parent_id').val(parentId);
      $('#input_judul').val('');
      $('#input_url').val('');
      $('#input_urutan').val('0');
      $('#ModalInputItem').modal('show');
    });

    // Submit Input Item
    $('#formInputItem').on('submit', function(e) {
      e.preventDefault();
      var btn = $('#btnSimpanItem');
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan...');

      $.ajax({
        url: BaseURL + 'Staf/InputMicrositeItem',
        type: 'POST',
        data: $(this).serialize(),
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Item');
          if (resp === '1') {
            $('#ModalInputItem').modal('hide');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Item');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // Tombol Edit Item
    $(document).on('click', '.btnEditItem', function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      var parentId = $(this).data('parent-id');
      var tipe = $(this).data('tipe');
      var judul = $(this).data('judul');
      var url = $(this).data('url');
      var urutan = $(this).data('urutan');

      $('#edit_item_id').val(id);
      $('#edit_parent_id').val(parentId);
      $('#edit_item_tipe').val(tipe);
      $('#edit_item_judul').val(judul);
      $('#edit_item_url').val(url);
      $('#edit_item_urutan').val(urutan);

      if (tipe === 'link') {
        $('#modalEditItemTitle').html('<i class="fa-brands fa-google-drive mr-2"></i> Edit Dokumen Google Drive');
        $('#label_edit_item_judul').html('Nama Dokumen <span class="text-danger">*</span>');
        $('#groupEditUrl').show();
      } else {
        $('#modalEditItemTitle').html('<i class="fa-solid fa-pen-to-square mr-2"></i> Edit Bab / Sub-Bab');
        $('#label_edit_item_judul').html('Nama Bab / Sub-Bab <span class="text-danger">*</span>');
        $('#groupEditUrl').hide();
      }

      $('#ModalEditItem').modal('show');
    });

    // Submit Edit Item
    $('#formEditItem').on('submit', function(e) {
      e.preventDefault();
      var btn = $('#btnPerbaruiItem');
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memperbarui...');

      $.ajax({
        url: BaseURL + 'Staf/EditMicrositeItem',
        type: 'POST',
        data: $(this).serialize(),
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Item');
          if (resp === '1') {
            $('#ModalEditItem').modal('hide');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk mr-1"></i> Perbarui Item');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });

    // Tombol Hapus Item
    var targetHapusItemId = null;
    $(document).on('click', '.btnHapusItem', function(e) {
      e.preventDefault();
      targetHapusItemId = $(this).data('id');
      var judul = $(this).data('judul');
      var isGroup = $(this).data('is-group');

      if (isGroup == '1') {
        $('#textHapusItem').html('Yakin ingin menghapus <b>"' + judul + '"</b>? Seluruh sub-bab dan dokumen di dalamnya akan ikut terhapus permanen.');
      } else {
        $('#textHapusItem').html('Yakin ingin menghapus dokumen <b>"' + judul + '"</b>?');
      }
      $('#ModalHapusItem').modal('show');
    });

    $('#btnKonfirmasiHapusItem').on('click', function() {
      if (!targetHapusItemId) return;
      var btn = $(this);
      btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menghapus...');

      $.ajax({
        url: BaseURL + 'Staf/HapusMicrositeItem',
        type: 'POST',
        data: { Id: targetHapusItemId },
        success: function(resp) {
          btn.prop('disabled', false).html('<i class="fa-solid fa-trash-can mr-1"></i> Ya, Hapus Item');
          if (resp === '1') {
            $('#ModalHapusItem').modal('hide');
            location.reload();
          } else {
            alert(resp);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="fa-solid fa-trash-can mr-1"></i> Ya, Hapus Item');
          alert('Terjadi kesalahan koneksi server!');
        }
      });
    });
  });
</script>
</body>
</html>
