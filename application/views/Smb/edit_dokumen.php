<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        body { background: #f0f3fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .editor-container { background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; }
        .editor-toolbar { background: #f8f9fd; border-bottom: 1px solid #e2e8f0; padding: 12px 20px; }
        .document-info { background: linear-gradient(135deg, #1a2d6b 0%, #162060 100%); color: white; border-radius: 12px; padding: 20px; margin-bottom: 20px; }
        .version-badge { background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 20px; font-size: 12px; }
        .ck-editor__editable { min-height: 500px; max-height: 70vh; }
        .btn-save { background: #10b981; color: white; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 600; }
        .btn-save:hover { background: #059669; }
        .btn-cancel { background: #6b7280; color: white; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 600; }
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        .status-selesai { background: #dcfce7; color: #166534; }
        .status-review { background: #dbeafe; color: #1d4ed8; }
        .status-ongoing { background: #fed7aa; color: #9a3412; }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="<?= base_url('IDE/SmbDashboard') ?>" class="text-decoration-none text-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
            <h4 class="mb-0"><i class="fas fa-edit text-primary"></i> Edit Dokumen</h4>
        </div>
        
        <!-- Info Dokumen -->
        <div class="document-info">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="mb-2"><?= htmlspecialchars($dokumen['nama_dokumen']) ?></h5>
                    <div class="d-flex flex-wrap gap-3">
                        <span><i class="fas fa-folder"></i> Kategori: <strong><?= htmlspecialchars($dokumen['kategori']) ?></strong></span>
                        <span><i class="fas fa-user"></i> Uploader: <strong><?= htmlspecialchars($dokumen['uploaded_by']) ?></strong></span>
                        <span><i class="fas fa-calendar"></i> Upload: <strong><?= date('d/m/Y H:i', strtotime($dokumen['upload_date'])) ?></strong></span>
                        <span class="version-badge"><i class="fas fa-code-branch"></i> Versi: <?= $dokumen['version'] ?></span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <span class="status-badge status-<?= strtolower(str_replace(' ', '', $dokumen['status'])) ?>">
                        <i class="fas fa-circle" style="font-size: 8px;"></i> <?= htmlspecialchars($dokumen['status']) ?>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Form Edit -->
        <form id="editForm" method="post">
            <input type="hidden" name="id_dokumen" value="<?= $dokumen['id_dokumen'] ?>">
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Dokumen</label>
                    <input type="text" name="nama_dokumen" class="form-control" value="<?= htmlspecialchars($dokumen['nama_dokumen']) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="Surat Keputusan" <?= $dokumen['kategori'] == 'Surat Keputusan' ? 'selected' : '' ?>>Surat Keputusan</option>
                        <option value="Laporan" <?= $dokumen['kategori'] == 'Laporan' ? 'selected' : '' ?>>Laporan</option>
                        <option value="Nota Dinas" <?= $dokumen['kategori'] == 'Nota Dinas' ? 'selected' : '' ?>>Nota Dinas</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="Selesai" <?= $dokumen['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                        <option value="Review" <?= $dokumen['status'] == 'Review' ? 'selected' : '' ?>>Review</option>
                        <option value="On Going" <?= $dokumen['status'] == 'On Going' ? 'selected' : '' ?>>On Going</option>
                    </select>
                </div>
            </div>
            
            <!-- CKEditor Container -->
            <div class="editor-container">
                <div class="editor-toolbar">
                    <div class="d-flex justify-content-between align-items-center">
                        <div><i class="fas fa-pencil-alt text-primary"></i> <strong>Konten Dokumen</strong></div>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleFullscreen()">
                            <i class="fas fa-expand"></i> Fullscreen
                        </button>
                    </div>
                </div>
                <textarea name="dokumen_html" id="editor"><?= htmlspecialchars($html_content) ?></textarea>
            </div>
            
            <!-- Action Buttons -->
            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="button" class="btn-cancel" onclick="window.history.back()">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="submit" class="btn-save" id="btnSave">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
        
        <!-- Footer Info -->
        <div class="text-center text-muted mt-4 small">
            <i class="fas fa-info-circle"></i> 
            Perubahan akan menyimpan ulang file dokumen (.docx) dan generate ulang file PDF.
            Versi sebelumnya akan di-backup secara otomatis.
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let editor;
        
        // Inisialisasi CKEditor
        ClassicEditor.create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'bulletedList', 'numberedList', '|',
                    'alignment', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'highlight', '|',
                    'outdent', 'indent', '|',
                    'link', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'undo', 'redo'
                ]
            },
            fontSize: { options: [9, 11, 13, 'default', 17, 19, 21], supportAllValues: true },
            fontFamily: {
                options: ['default', 'Arial, Helvetica, sans-serif', 'Times New Roman, serif', 'Courier New, monospace']
            },
            licenseKey: 'GPL'
        }).then(newEditor => {
            editor = newEditor;
            console.log('CKEditor initialized');
        }).catch(error => {
            console.error('CKEditor error:', error);
            Swal.fire('Error', 'Gagal memuat editor: ' + error.message, 'error');
        });
        
        // Submit form dengan AJAX
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            
            const content = editor.getData();
            
            if (!content || content.trim() === '' || content === '<p>&nbsp;</p>') {
                Swal.fire('Peringatan', 'Konten dokumen tidak boleh kosong!', 'warning');
                return;
            }
            
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Sedang memproses dokumen, mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
            
            $.ajax({
                url: '<?= base_url("IDE/save_dokumen_edit") ?>',
                type: 'POST',
                data: {
                    id_dokumen: $('input[name="id_dokumen"]').val(),
                    nama_dokumen: $('input[name="nama_dokumen"]').val(),
                    kategori: $('select[name="kategori"]').val(),
                    status: $('select[name="status"]').val(),
                    dokumen_html: content
                },
                dataType: 'json',
                timeout: 60000,
                success: function(response) {
                    Swal.close();
                    if (response.status === 'success') {
                        Swal.fire('Berhasil!', response.message, 'success')
                            .then(() => {
                                if (response.redirect) {
                                    window.location.href = response.redirect;
                                } else {
                                    window.location.href = '<?= base_url("IDE/SmbDashboard") ?>';
                                }
                            });
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    let errorMsg = 'Gagal menyimpan dokumen. ';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg += xhr.responseJSON.message;
                    } else if (status === 'timeout') {
                        errorMsg += 'Proses timeout, file mungkin terlalu besar.';
                    } else {
                        errorMsg += error;
                    }
                    Swal.fire('Error!', errorMsg, 'error');
                }
            });
        });
        
        // Fullscreen toggle
        function toggleFullscreen() {
            const editorElement = document.querySelector('.ck-editor__editable');
            if (!document.fullscreenElement) {
                editorElement.requestFullscreen().catch(err => {
                    console.error('Fullscreen error:', err.message);
                });
            } else {
                document.exitFullscreen();
            }
        }
        
        // Auto-save draft setiap 30 detik
        let autoSaveTimer = setInterval(() => {
            if (editor) {
                const content = editor.getData();
                if (content && content.trim() !== '') {
                    localStorage.setItem('draft_' + <?= $dokumen['id_dokumen'] ?>, content);
                    console.log('Auto-save draft tersimpan');
                }
            }
        }, 30000);
        
        // Load draft jika ada
        const draft = localStorage.getItem('draft_' + <?= $dokumen['id_dokumen'] ?>);
        if (draft && confirm('Ada draft yang belum disimpan. Apakah ingin memuatnya?')) {
            if (editor) {
                editor.setData(draft);
                localStorage.removeItem('draft_' + <?= $dokumen['id_dokumen'] ?>);
            }
        }
        
        // Bersihkan draft saat halaman ditutup
        window.addEventListener('beforeunload', () => {
            localStorage.removeItem('draft_' + <?= $dokumen['id_dokumen'] ?>);
        });
    </script>
</body>
</html>