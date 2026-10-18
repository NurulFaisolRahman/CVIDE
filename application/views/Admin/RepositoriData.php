<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  /* Enterprise Repositori Styles */
  .repo-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 24px;
    border: 1px solid var(--ide-border);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    margin-bottom: 24px;
  }

  .repo-header-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 24px;
    padding-bottom: 18px;
    border-bottom: 1px solid #f1f5f9;
  }

  .repo-title-wrap h2 {
    font-size: 22px;
    font-weight: 800;
    color: var(--ide-dark);
    margin: 0 0 6px 0;
    letter-spacing: -0.02em;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .repo-title-wrap p {
    margin: 0;
    font-size: 13.5px;
    color: #64748b;
  }

  /* API Banner */
  .api-live-banner {
    background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
    border: 1px solid #bbf7d0;
    border-radius: 16px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 22px;
  }

  .api-live-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    color: #15803d;
    padding: 6px 14px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 700;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    border: 1px solid #bbf7d0;
  }

  .live-dot-indicator {
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #16a34a;
    box-shadow: 0 0 0 0 rgba(22, 163, 74, 0.7);
    animation: livePulseAdmin 2s infinite;
  }
  @keyframes livePulseAdmin {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(22, 163, 74, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 7px rgba(22, 163, 74, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(22, 163, 74, 0); }
  }

  .api-key-code {
    font-family: monospace;
    font-size: 12px;
    background: #ffffff;
    color: var(--ide-navy);
    padding: 3px 8px;
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    font-weight: 600;
  }

  /* Metric KPI Cards */
  .repo-kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
  }
  @media (max-width: 992px) {
    .repo-kpi-grid { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 576px) {
    .repo-kpi-grid { grid-template-columns: 1fr; }
  }

  .repo-kpi-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 18px 20px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    display: flex;
    align-items: center;
    gap: 14px;
    transition: all 0.25s ease;
  }
  .repo-kpi-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 22px rgba(4, 49, 104, 0.08);
    border-color: var(--ide-navy);
  }

  .repo-kpi-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  /* Table styling */
  .repo-data-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 14px !important;
    overflow: hidden !important;
  }
  .repo-data-table thead th {
    background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%) !important;
    color: #ffffff !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    padding: 12px 14px !important;
    border: none !important;
    vertical-align: middle !important;
    white-space: nowrap;
  }
  .repo-data-table tbody td {
    padding: 12px 14px !important;
    font-size: 13px !important;
    color: #334155 !important;
    vertical-align: middle !important;
    border-bottom: 1px solid #f1f5f9 !important;
  }
  .repo-data-table tbody tr:hover {
    background-color: #f8fafc !important;
  }

  .badge-wilayah-tag {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    color: #ffffff;
    background: var(--ide-navy);
    letter-spacing: 0.3px;
  }
  .badge-wilayah-tag.bwi {
    background: #043168;
    border-left: 3px solid #f59e0b;
  }
  .badge-wilayah-tag.other {
    background: #64748b;
  }

  .target-badge-num {
    font-family: monospace;
    font-size: 12px;
    font-weight: 700;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 3px 7px;
    border-radius: 6px;
    color: #1e293b;
    display: inline-block;
  }
  .target-badge-num.final-t {
    background: #eff6ff;
    border-color: #93c5fd;
    color: var(--ide-navy);
  }

  /* AI Action Buttons */
  .btn-generate-ai-admin {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #043168 0%, #4338ca 100%);
    color: #ffffff !important;
    border: none;
    border-radius: 10px;
    padding: 7px 13px;
    font-size: 11.5px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 3px 8px rgba(4, 49, 104, 0.25);
    transition: all 0.25s ease;
    white-space: nowrap;
    text-decoration: none !important;
  }
  .btn-generate-ai-admin:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(4, 49, 104, 0.4);
    background: linear-gradient(135deg, #0a3d7c 0%, #4f46e5 100%);
  }

  .btn-view-ai-admin {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #ecfdf5;
    color: #065f46 !important;
    border: 1px solid #6ee7b7;
    border-radius: 8px;
    padding: 6px 11px;
    font-size: 11.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none !important;
    white-space: nowrap;
  }
  .btn-view-ai-admin:hover {
    background: #d1fae5;
    transform: translateY(-1px);
  }

  .ai-spinner-small {
    width: 13px; height: 13px;
    border: 2px solid #db2777;
    border-top-color: transparent;
    border-radius: 50%;
    animation: spinAdmin 0.8s linear infinite;
    display: inline-block;
  }
  @keyframes spinAdmin { to { transform: rotate(360deg); } }

  /* Modal Evaluation Styles */
  .eval-result-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 16px 20px;
    margin-bottom: 16px;
  }
  .eval-result-card.recom {
    background: #f0fdf4;
    border-color: #bbf7d0;
  }
  .eval-result-title {
    font-weight: 800;
    font-size: 14px;
    color: var(--ide-navy);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .eval-result-card.recom .eval-result-title {
    color: #14532d;
  }
  .eval-result-body {
    font-size: 13.5px;
    line-height: 1.65;
    color: #334155;
    white-space: pre-line;
  }

  /* Topic Chips & Chart Button Styles */
  .topic-chip {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 3px 10px;
    font-size: 11.5px;
    font-weight: 600;
    color: #334155;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .topic-chip:hover {
    background: #e0f2fe;
    border-color: #38bdf8;
    color: #0369a1;
    transform: translateY(-1px);
  }
  .topic-chip.active {
    background: #043168;
    border-color: #043168;
    color: #ffffff;
  }
  .btn-chart-indicator {
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    color: var(--ide-navy);
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.15s ease;
    display: inline-flex;
    align-items: center;
    text-decoration: none !important;
  }
  .btn-chart-indicator:hover {
    background: var(--ide-navy);
    color: #ffffff !important;
    border-color: var(--ide-navy);
  }
  .eval-editor-textarea {
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 13px;
    line-height: 1.65;
    color: #1e293b;
    width: 100%;
    transition: border-color 0.2s ease;
    background: #ffffff;
  }
  .eval-editor-textarea:focus {
    border-color: #3b82f6;
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
  }
</style>

<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="repo-card">
      
      <!-- Page Header -->
      <div class="repo-header-box">
        <div class="repo-title-wrap">
          <h2>
            <i class="fa-solid fa-database" style="color: var(--ide-navy);"></i>
            Repositori Data Indikator Kinerja Utama (IKU)
          </h2>
          <p>
            Data real-time indikator kinerja pemerintah daerah bersumber langsung dari database IPPD Kabupaten Banyuwangi dengan telaah analisis cerdas Asisten AI Bappeda.
          </p>
        </div>
        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
          <button class="btn btn-sm btn-primary" onclick="syncIkuApiData()" id="btnSyncAdmin">
            <i class="fa-solid fa-arrows-rotate mr-1"></i> Sinkronisasi API
          </button>
          <button class="btn-generate-ai-admin" onclick="batchGenerateAllAIAdmin()">
            <i class="fa-solid fa-pen-nib mr-1"></i> Telaah Semua Indikator
          </button>
          <button class="btn btn-sm btn-info" onclick="openKomparasiModal()" style="border-radius: 10px; font-weight: 700; color: #fff; background-color: #17a2b8; border-color: #17a2b8;">
            <i class="fa-solid fa-code-compare mr-1"></i> Komparasi Data
          </button>
        </div>
      </div>

      <!-- Live Connection Banner -->
      <div class="api-live-banner">
        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
          <div class="api-live-pill">
            <span class="live-dot-indicator"></span>
            <span>API IPPD Terhubung (Data Real Database)</span>
          </div>
          <span style="font-size: 13px; color: #334155;">
            <i class="fa-solid fa-shield-halved text-success mr-1"></i> Terautentikasi &amp; Terhubung | Wilayah: <strong>Kabupaten Banyuwangi (35.12)</strong> | Periode: <strong>2025–2029</strong>
          </span>
        </div>
        <div>
          <span class="badge badge-success" style="padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 12px;">
            <i class="fa-solid fa-check-circle mr-1"></i> Real-time Active
          </span>
        </div>
      </div>

      <!-- 4 KPI Metrics -->
      <div class="repo-kpi-grid">
        <div class="repo-kpi-card">
          <div class="repo-kpi-icon" style="background: rgba(4, 49, 104, 0.1); color: var(--ide-navy);">
            <i class="fa-solid fa-chart-pie"></i>
          </div>
          <div>
            <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Total Indikator</div>
            <div style="font-size: 20px; font-weight: 800; color: #1e293b;" id="adminKpiTotal">7 Indikator</div>
            <div style="font-size: 11px; color: #94a3b8;">Indikator Kinerja Utama</div>
          </div>
        </div>

        <div class="repo-kpi-card">
          <div class="repo-kpi-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
            <i class="fa-solid fa-landmark"></i>
          </div>
          <div>
            <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Kab. Banyuwangi</div>
            <div style="font-size: 20px; font-weight: 800; color: #1e293b;" id="adminKpiBwi">7 Indikator</div>
            <div style="font-size: 11px; color: #94a3b8;">Kode Wilayah 35.12</div>
          </div>
        </div>

        <div class="repo-kpi-card">
          <div class="repo-kpi-icon" style="background: rgba(245, 158, 11, 0.1); color: #d97706;">
            <i class="fa-solid fa-calendar-days"></i>
          </div>
          <div>
            <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Periode RPJMD</div>
            <div style="font-size: 20px; font-weight: 800; color: #1e293b;">2025–2029</div>
            <div style="font-size: 11px; color: #94a3b8;">5 Tahun Perencanaan</div>
          </div>
        </div>

        <div class="repo-kpi-card">
          <div class="repo-kpi-icon" style="background: rgba(99, 102, 241, 0.1); color: #6366f1;">
            <i class="fa-solid fa-brain"></i>
          </div>
          <div>
            <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Telaah Asisten AI</div>
            <div style="font-size: 20px; font-weight: 800; color: #1e293b;" id="adminKpiAi">0 / 7</div>
            <div style="font-size: 11px; color: #94a3b8;" id="adminKpiAiStatus">Siap telaah</div>
          </div>
        </div>
      </div>

      <!-- Filters & Search Toolbar -->
      <div style="display: flex; gap: 12px; margin-bottom: 18px; flex-wrap: wrap; align-items: center; justify-content: space-between;">
        <div style="display: flex; gap: 10px; flex: 1; min-width: 280px;">
          <input type="text" id="adminRepoSearch" class="form-control" placeholder="Cari nama indikator atau sasaran..." oninput="filterAdminIkuTable()" style="border-radius: 10px; font-size: 13px;">
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
          <select id="adminFilterProvinsi" class="form-control" onchange="loadKabupatenAdmin(); filterAdminIkuTable()" style="border-radius: 10px; font-size: 13px; width: auto; max-width: 180px;">
            <option value="">Semua Provinsi</option>
          </select>
          <select id="adminFilterWilayah" class="form-control" onchange="loadIndikatorAdmin(); filterAdminIkuTable()" style="border-radius: 10px; font-size: 13px; width: auto; max-width: 180px;">
            <option value="">Semua Kab/Kota</option>
            <option value="35.12" selected>35.12 — Banyuwangi</option>
          </select>
          <select id="adminFilterIndikator" class="form-control" onchange="filterAdminIkuTable()" style="border-radius: 10px; font-size: 13px; width: auto; max-width: 180px;">
            <option value="">Semua Indikator</option>
          </select>
          <select id="adminFilterAi" class="form-control" onchange="filterAdminIkuTable()" style="border-radius: 10px; font-size: 13px; width: auto;">
            <option value="all">Semua Status AI</option>
            <option value="evaluated">Sudah Ada Telaah</option>
            <option value="pending">Belum Ada Telaah</option>
          </select>
        </div>
      </div>

      <!-- Table Section -->
      <div class="table-responsive">
        <table class="table repo-data-table">
          <thead>
            <tr>
              <th style="width: 40px; text-align: center;">No</th>
              <th style="width: 130px;">Wilayah</th>
              <th>Indikator Kinerja Utama (IKU)</th>
              <th style="text-align: center;">Periode</th>
              <th style="text-align: center;">2025 (T1)</th>
              <th style="text-align: center;">2026 (T2)</th>
              <th style="text-align: center;">2027 (T3)</th>
              <th style="text-align: center;">2028 (T4)</th>
              <th style="text-align: center;">2029 (T5)</th>
              <th style="width: 200px; text-align: center;">Kesimpulan &amp; Evaluasi (Asisten AI)</th>
            </tr>
          </thead>
          <tbody id="adminRepoTbody">
            <tr>
              <td colspan="10" class="text-center py-4">Memuat data real dari IPPD...</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Chart Visualization Section -->
      <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #f1f5f9;">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 18px;">
          <div>
            <h4 style="margin: 0; font-weight: 800; color: var(--ide-dark); font-size: 17px;">
              <i class="fa-solid fa-chart-line mr-2" style="color: var(--ide-navy);"></i>
              Visualisasi Tren Target Kinerja 2025–2029
            </h4>
            <span style="font-size: 12.5px; color: #64748b;">Perbandingan capaian target tahunan indikator</span>
          </div>
          <div style="display: flex; gap: 10px;">
            <select id="adminChartIndicator" class="form-control" onchange="renderAdminChart()" style="border-radius: 8px; font-size: 13px; max-width: 320px;">
              <!-- diisi dinamis -->
            </select>
            <select id="adminChartType" class="form-control" onchange="renderAdminChart()" style="border-radius: 8px; font-size: 13px; width: 110px;">
              <option value="line">Line</option>
              <option value="bar">Bar</option>
            </select>
          </div>
        </div>
        <div style="position: relative; height: 320px; width: 100%;">
          <canvas id="adminIkuChart"></canvas>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Modal Telaah Asisten AI -->
<div class="modal fade" id="modalAdminEvaluasiAi" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 1150px; width: 96%; margin: 1.5rem auto;">
    <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 25px 60px rgba(4, 49, 104, 0.35);">
      
      <div class="modal-header" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff; padding: 20px 28px;">
        <div>
          <div style="display: inline-flex; align-items: center; background: rgba(255,255,255,0.15); padding: 3px 12px; border-radius: 99px; font-size: 11px; font-weight: 700; text-transform: uppercase; color: #a5f3fc; margin-bottom: 6px;">
            Peneliti Ekonomi Pembangunan — Asisten AI
          </div>
          <h5 class="modal-title" id="adminModalIndicatorName" style="color: #ffffff; font-weight: 800; font-size: 18px; margin: 0;">
            Indikator Kinerja Utama
          </h5>
          <div id="adminModalSubtitle" style="font-size: 12.5px; opacity: 0.85; margin-top: 2px;">
            Kabupaten Banyuwangi • Periode 2025–2029
          </div>
        </div>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="padding: 24px 28px; max-height: 78vh; overflow-y: auto;">
        
        <!-- Target Berkala RPJMD -->
        <div style="margin-bottom: 16px;">
          <div style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; color: #64748b; margin-bottom: 8px;">
            Target Tahunan (RPJMD 2025–2029):
          </div>
          <div id="adminModalTargetGrid" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px;">
            <!-- Mini target cards -->
          </div>
        </div>

        <!-- 1. Tampilan Grafik pada Setiap Indikator -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 16px 20px; margin-bottom: 18px; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; flex-wrap: wrap; gap: 8px;">
            <div style="font-size: 13.5px; font-weight: 800; color: var(--ide-navy);">
              Visualisasi Grafik Target Indikator (2025–2029)
            </div>
            <div style="display: flex; align-items: center; gap: 6px;">
              <span style="font-size: 11.5px; font-weight: 600; color: #64748b;">Tipe Grafik:</span>
              <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-outline-primary btn-xs active" id="btnAdminModalChartLine" onclick="switchAdminModalChartType('line')" style="padding: 3px 10px; font-size: 12px; font-weight: 600;">
                  Garis
                </button>
                <button type="button" class="btn btn-outline-primary btn-xs" id="btnAdminModalChartBar" onclick="switchAdminModalChartType('bar')" style="padding: 3px 10px; font-size: 12px; font-weight: 600;">
                  Batang
                </button>
              </div>
            </div>
          </div>
          <div style="position: relative; height: 185px; width: 100%;">
            <canvas id="adminModalIndicatorChart"></canvas>
          </div>
        </div>

        <!-- Detail Rumus / Definisi jika ada -->
        <div id="adminModalDefinisiWrap" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 12px 16px; margin-bottom: 18px; font-size: 12.5px; display: none;">
          <div style="font-weight: 700; color: var(--ide-navy); margin-bottom: 4px;">Definisi Operasional:</div>
          <div id="adminModalDefinisiText" style="line-height: 1.5; color: #334155;">-</div>
        </div>

        <!-- 2. Konfigurasi Generate AI & Input Topik Fleksibel Sesuai Keinginan User -->
        <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 14px; padding: 16px 20px; margin-bottom: 18px;">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
            <div style="font-size: 13.5px; font-weight: 800; color: var(--ide-navy);">
              Fokus &amp; Topik Evaluasi (Sesuai Keinginan Anda)
            </div>
            <span class="badge" style="background: #043168; color: #fff; font-size: 11px; font-weight: 700; padding: 5px 10px; border-radius: 6px;">
              Asisten AI Fleksibel
            </span>
          </div>
          
          <div style="font-size: 12.5px; color: #475569; margin-bottom: 10px;">
            Tentukan topik, sudut pandang, atau isu khusus yang ingin ditelaah oleh Asisten AI untuk indikator ini:
          </div>

          <div class="row g-2 mb-2">
            <div class="col-md-8 col-sm-12">
              <input type="text" id="adminModalTopicInput" class="form-control" placeholder="Ketik topik bebas (cth: Daya dorong sektor pertanian, pengentasan kemiskinan, stabilitas harga)..." style="border-radius: 8px; font-size: 13px; height: 38px;">
            </div>
            <div class="col-md-4 col-sm-12">
              <select id="adminModalToneSelect" class="form-control" style="border-radius: 8px; font-size: 13px; height: 38px;">
                <option value="komprehensif" selected>Gaya: Komprehensif</option>
                <option value="kritis">Gaya: Kritis &amp; Mitigasi Risiko</option>
                <option value="rekomendasi">Gaya: Solutif &amp; Intervensi</option>
                <option value="ringkas">Gaya: Ringkas (Eksekutif)</option>
              </select>
            </div>
          </div>

          <!-- Quick Topic Suggestion Chips (Tanpa Icon) -->
          <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center; margin-bottom: 12px;">
            <span style="font-size: 11.5px; font-weight: 700; color: #64748b;">Pilihan Cepat:</span>
            <button type="button" class="topic-chip" onclick="setAdminQuickTopic('Analisis Laju & Akselerasi Target RPJMD')">Akselerasi Target</button>
            <button type="button" class="topic-chip" onclick="setAdminQuickTopic('Mitigasi Risiko & Hambatan Lapangan')">Mitigasi Risiko</button>
            <button type="button" class="topic-chip" onclick="setAdminQuickTopic('Efisiensi Anggaran & Prioritas Belanja Daerah')">Efisiensi Belanja</button>
            <button type="button" class="topic-chip" onclick="setAdminQuickTopic('Pengentasan Kemiskinan & Daya Beli Masyarakat')">Kesejahteraan</button>
            <button type="button" class="topic-chip" onclick="setAdminQuickTopic('Dukungan Sektor Unggulan & Investasi Daerah')">Sektor Unggulan</button>
            <button type="button" class="topic-chip" onclick="setAdminQuickTopic('')">Kosongkan</button>
          </div>

          <div style="text-align: right;">
            <button type="button" class="btn btn-primary btn-sm" id="btnAdminGenerateWithTopic" onclick="executeAdminAiGenerateWithTopic()" style="border-radius: 8px; font-weight: 700; background: linear-gradient(135deg, #043168 0%, #1e40af 100%); border: none; padding: 8px 20px; font-size: 12.5px;">
              Susun / Generate Telaah AI
            </button>
          </div>
        </div>

        <!-- 3. Hasil Telaah Evaluasi & Fitur Edit Manual -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; flex-wrap: wrap; gap: 8px;">
          <div style="display: flex; align-items: center; gap: 8px;">
            <span style="font-size: 13.5px; font-weight: 800; color: #0f172a;">
              Naskah Telaah Evaluasi
            </span>
            <span id="adminEvalStatusBadge" class="badge" style="background: #10b981; color: #fff; font-size: 11px; border-radius: 6px; padding: 4px 10px;">
              Asisten AI
            </span>
            <span id="adminEvalTopicBadge" class="badge" style="background: #e0f2fe; color: #0369a1; font-size: 11px; border-radius: 6px; padding: 4px 10px; display: none;">
              Topik: -
            </span>
          </div>

          <div style="display: flex; gap: 6px;">
            <button type="button" class="btn btn-sm btn-outline-primary" id="btnToggleEditAdmin" onclick="toggleEditAdminEvaluasi()" style="border-radius: 8px; font-size: 12.5px; font-weight: 600; padding: 5px 14px;">
              Edit Manual
            </button>
          </div>
        </div>

        <!-- Mode Tampilan (Read-Only View) -->
        <div id="adminViewModeContainer">
          <div class="eval-result-card">
            <div class="eval-result-title">
              1. Telaah Trajektori Target Kinerja
            </div>
            <div class="eval-result-body" id="adminModalKesimpulanText">
              Memuat telaah target...
            </div>
          </div>

          <div class="eval-result-card recom">
            <div class="eval-result-title">
              2. Kesimpulan &amp; Evaluasi Pembangunan Daerah
            </div>
            <div class="eval-result-body" id="adminModalRekomendasiText">
              Memuat kesimpulan evaluasi...
            </div>
          </div>
        </div>

        <!-- Mode Edit Manual (Aktif Saat Klik 'Edit Manual') - LEBAR, NYAMAN, TANPA ICON -->
        <div id="adminEditModeContainer" style="display: none; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 16px; padding: 22px 24px; margin-bottom: 18px; box-shadow: 0 4px 14px rgba(0,0,0,0.04);">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; flex-wrap: wrap; gap: 8px;">
            <div>
              <div style="font-size: 14px; font-weight: 800; color: #0f172a;">
                Mode Pengeditan Manual Naskah Evaluasi
              </div>
              <div style="font-size: 12px; color: #64748b; margin-top: 2px;">
                Sesuaikan narasi evaluasi sesuai kebutuhan dan temuan faktual di lapangan.
              </div>
            </div>
            <div style="font-size: 12px; background: #fef3c7; color: #92400e; font-weight: 600; padding: 4px 10px; border-radius: 6px;">
              Format Bebas &amp; Dapat Diedit Kapan Saja
            </div>
          </div>

          <!-- Tampilan Dua Kolom Berdampingan Lebih Lebar & Mudah Digunakan -->
          <div class="row">
            <div class="col-lg-6 col-md-12 mb-3">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 16px; height: 100%; display: flex; flex-direction: column;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                  <label style="font-size: 13px; font-weight: 700; color: #043168; margin: 0;">
                    Bagian 1: Telaah Trajektori Target Kinerja
                  </label>
                  <span style="font-size: 11px; color: #64748b;">Analisis Angka</span>
                </div>
                <div style="font-size: 11.5px; color: #64748b; margin-bottom: 8px;">
                  Tinjauan pencapaian angka target berkala tahun 2025–2029:
                </div>
                <textarea id="adminEditTextarea1" class="eval-editor-textarea" style="flex: 1; min-height: 250px; font-size: 13.5px; line-height: 1.75; resize: vertical;"></textarea>
              </div>
            </div>

            <div class="col-lg-6 col-md-12 mb-3">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 16px; height: 100%; display: flex; flex-direction: column;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                  <label style="font-size: 13px; font-weight: 700; color: #166534; margin: 0;">
                    Bagian 2: Kesimpulan &amp; Rekomendasi Pembangunan
                  </label>
                  <span style="font-size: 11px; color: #64748b;">Saran Kebijakan</span>
                </div>
                <div style="font-size: 11.5px; color: #64748b; margin-bottom: 8px;">
                  Catatan evaluasi komprehensif, mitigasi risiko, dan rekomendasi intervensi:
                </div>
                <textarea id="adminEditTextarea2" class="eval-editor-textarea" style="flex: 1; min-height: 250px; font-size: 13.5px; line-height: 1.75; resize: vertical;"></textarea>
              </div>
            </div>
          </div>

          <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; padding-top: 12px; border-top: 1px solid #e2e8f0; margin-top: 4px;">
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="resetAdminToOriginalAi()" style="border-radius: 8px; font-size: 12.5px; padding: 6px 14px;">
              Kembalikan ke Asli AI
            </button>
            <div style="display: flex; gap: 8px;">
              <button type="button" class="btn btn-secondary btn-sm" onclick="cancelAdminEditMode()" style="border-radius: 8px; font-size: 12.5px; padding: 6px 14px;">
                Batal
              </button>
              <button type="button" class="btn btn-success btn-sm" onclick="saveAdminManualEdit()" style="border-radius: 8px; font-size: 12.5px; font-weight: 700; padding: 6px 18px;">
                Simpan Perubahan
              </button>
            </div>
          </div>
        </div>

        <div style="display: flex; justify-content: space-between; font-size: 11.5px; color: #94a3b8; padding-top: 6px;">
          <div>Penelaah: <strong id="adminModalModel">Peneliti Ekonomi Pembangunan (Asisten AI)</strong></div>
          <div>Waktu Telaah: <strong id="adminModalTime">-</strong></div>
        </div>

      </div>

      <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #f1f5f9; padding: 14px 28px; justify-content: space-between;">
        <div style="display: flex; gap: 8px;">
          <button type="button" class="btn btn-secondary btn-sm" onclick="salinEvaluasiAdmin()" style="border-radius: 8px; font-size: 12.5px; padding: 6px 14px;">
            Salin Teks
          </button>
          <button type="button" class="btn btn-secondary btn-sm" onclick="cetakEvaluasiAdmin()" style="border-radius: 8px; font-size: 12.5px; padding: 6px 14px;">
            Cetak Laporan
          </button>
        </div>
        <div style="display: flex; gap: 8px;">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="border-radius: 8px; font-size: 12.5px; padding: 6px 14px;">
            Tutup
          </button>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Modal Komparasi Data -->
<div class="modal fade" id="modalKomparasiData" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 1300px; width: 96%; margin: 1.5rem auto;">
    <div class="modal-content" style="border-radius: 20px; overflow: hidden; border: none; box-shadow: 0 25px 60px rgba(4, 49, 104, 0.35);">
      <div class="modal-header" style="background: linear-gradient(135deg, #043168 0%, #0a3d7c 100%); color: #ffffff; padding: 20px 28px;">
        <h5 class="modal-title" style="color: #ffffff; font-weight: 800; font-size: 18px; margin: 0;">
          <i class="fa-solid fa-code-compare mr-2"></i> Komparasi Data Indikator
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding: 24px 28px; background: #f8fafc; max-height: 80vh; overflow-y: auto;">
        <div class="row">
          <!-- Panel Kiri: Seluruh Data Banyuwangi -->
          <div class="col-md-7 mb-3">
             <div style="background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:16px; height:100%; box-shadow:0 2px 8px rgba(0,0,0,0.02);">
                <div style="font-size:14px; font-weight:800; color:var(--ide-navy); margin-bottom:12px;">Seluruh Data Banyuwangi</div>
                <div style="max-height:350px; overflow-y:auto;">
                   <table class="table table-sm repo-data-table" style="font-size:12px; margin:0;">
                     <thead>
                       <tr>
                         <th>Indikator</th>
                         <th>2025</th><th>2026</th><th>2027</th><th>2028</th><th>2029</th>
                       </tr>
                     </thead>
                     <tbody id="komparasiLeftData"></tbody>
                   </table>
                </div>
             </div>
          </div>
          <!-- Panel Kanan: Pilihan Data Indikator -->
          <div class="col-md-5 mb-3">
             <div style="background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:16px; height:100%; box-shadow:0 2px 8px rgba(0,0,0,0.02);">
                <div style="font-size:14px; font-weight:800; color:var(--ide-navy); margin-bottom:12px;">Pilihan Indikator Dikomparasi</div>
                <div style="font-size:12px; color:#64748b; margin-bottom:10px;">Pilih satu atau lebih indikator untuk dikomparasi secara khusus dengan data keseluruhan:</div>
                <div id="komparasiRightOptions" style="max-height:300px; overflow-y:auto; border:1px solid #e2e8f0; padding:10px; border-radius:8px; background:#f8fafc;">
                </div>
             </div>
          </div>
        </div>
        
        <!-- Panel Bawah: AI Komparasi -->
        <div class="row">
          <div class="col-md-12">
            <div style="background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:20px; box-shadow:0 2px 8px rgba(0,0,0,0.02);">
              <div style="font-size:14px; font-weight:800; color:var(--ide-navy); margin-bottom:8px;">
                <i class="fa-solid fa-brain mr-1" style="color:#4f46e5;"></i> Asisten AI Komparasi (Batasan: Hanya membaca data di atas)
              </div>
              <div style="font-size:12.5px; color:#475569; margin-bottom:12px;">Masukkan aspek komparasi yang ingin ditelaah oleh AI (misal: "Bandingkan tren pertumbuhan dari indikator yang saya pilih dengan rata-rata pertumbuhan indikator lainnya di sektor pendidikan"):</div>
              <textarea id="komparasiAiPrompt" class="form-control mb-3" rows="3" placeholder="Ketik instruksi/prompt untuk AI di sini..." style="border-radius:10px; font-size:13px; resize:vertical;"></textarea>
              <button class="btn btn-primary" id="btnRunAiKomparasi" onclick="runAiKomparasi()" style="border-radius:8px; font-weight:700; font-size:13px; background: linear-gradient(135deg, #043168 0%, #1e40af 100%); border:none; padding:8px 20px;">
                 Mulai Komparasi AI
              </button>
              
              <div id="komparasiAiResult" class="mt-4" style="display:none; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:12px; padding:18px;">
                 <div style="font-weight:800; color:#14532d; font-size:13.5px; margin-bottom:10px;"><i class="fa-solid fa-robot mr-1"></i> Hasil Komparasi Asisten AI</div>
                 <div id="komparasiAiContent" style="font-size:13.5px; color:#334155; line-height:1.6; white-space:pre-wrap;">
                 </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
</div>
</div>

<!-- Scripts -->
<script src="<?=base_url("vendors/jquery/dist/jquery.min.js")?>"></script>
<script src="<?=base_url("vendors/bootstrap/dist/js/bootstrap.bundle.min.js")?>"></script>
<script src="<?=base_url("build/js/custom.min.js")?>"></script>

<script>
var BaseURL = '<?=base_url()?>';
var BACKEND_PROXY_URL = BaseURL + 'IDE/get_repositori_iku';
var IPPD_API_URL = BACKEND_PROXY_URL;
var GEMINI_API_KEY = '';
var BACKEND_AI_URL = BaseURL + 'IDE/generate_gemini_evaluasi';

function loadProvinsiAdmin() {
  $.get(BaseURL + 'IDE/get_provinsi', function(res) {
    if (res.status === 'success') {
      var html = '<option value="">Semua Provinsi</option>';
      res.data.forEach(function(item) {
        html += '<option value="'+item.Kode+'">'+item.Kode+' — '+item.Nama+'</option>';
      });
      $('#adminFilterProvinsi').html(html);
    }
  });
}

function loadKabupatenAdmin() {
  var prov = $('#adminFilterProvinsi').val();
  var html = '<option value="">Semua Kab/Kota</option>';
  if (!prov) {
    $('#adminFilterWilayah').html(html);
    return;
  }
  $.get(BaseURL + 'IDE/get_kabkota?provinsi='+prov, function(res) {
    if (res.status === 'success') {
      res.data.forEach(function(item) {
        html += '<option value="'+item.Kode+'">'+item.Kode+' — '+item.Nama+'</option>';
      });
      $('#adminFilterWilayah').html(html);
    }
  });
}

function loadIndikatorAdmin() {
  var wilayah = $('#adminFilterWilayah').val() || $('#adminFilterProvinsi').val();
  $.get(BaseURL + 'IDE/get_indikator?kodewilayah='+wilayah, function(res) {
    if (res.status === 'success') {
      var html = '<option value="">Semua Indikator</option>';
      res.data.forEach(function(item) {
        if(item.indikator_tujuan) {
          html += '<option value="'+escapeHtml(item.indikator_tujuan)+'">'+escapeHtml(item.indikator_tujuan)+'</option>';
        }
      });
      $('#adminFilterIndikator').html(html);
    }
  });
}

$(document).ready(function() {
  loadProvinsiAdmin();
  loadIndikatorAdmin();
});


function loadProvinsiAdmin() {
  $.get(BaseURL + 'IDE/get_provinsi', function(res) {
    if (res.status === 'success') {
      var html = '<option value="">Semua Provinsi</option>';
      res.data.forEach(function(item) {
        html += '<option value="'+item.Kode+'">'+item.Kode+' — '+item.Nama+'</option>';
      });
      $('#adminFilterProvinsi').html(html);
    }
  });
}

function loadKabupatenAdmin() {
  var prov = $('#adminFilterProvinsi').val();
  var html = '<option value="">Semua Kab/Kota</option>';
  if (!prov) {
    $('#adminFilterWilayah').html(html);
    return;
  }
  $.get(BaseURL + 'IDE/get_kabkota?provinsi='+prov, function(res) {
    if (res.status === 'success') {
      res.data.forEach(function(item) {
        html += '<option value="'+item.Kode+'">'+item.Kode+' — '+item.Nama+'</option>';
      });
      $('#adminFilterWilayah').html(html);
    }
  });
}

function loadIndikatorAdmin() {
  var wilayah = $('#adminFilterWilayah').val() || $('#adminFilterProvinsi').val();
  $.get(BaseURL + 'IDE/get_indikator?kodewilayah='+wilayah, function(res) {
    if (res.status === 'success') {
      var html = '<option value="">Semua Indikator</option>';
      res.data.forEach(function(item) {
        if(item.indikator_tujuan) {
          html += '<option value="'+escapeHtml(item.indikator_tujuan)+'">'+escapeHtml(item.indikator_tujuan)+'</option>';
        }
      });
      $('#adminFilterIndikator').html(html);
    }
  });
}

$(document).ready(function() {
  loadProvinsiAdmin();
  loadIndikatorAdmin();
});


var adminIkuData = [
  {
    id: 191,
    kodewilayah: "35.12",
    id_tujuan: 18,
    indikator_tujuan: "Indeks Pembangunan Manusia",
    rumus: "IPM = ∛Indeks Kesehatan × Indeks Pendidikan × Indeks Standar Hidup Layak",
    definisi_operasional: "Indeks komposit yang mengukur pembangunan manusia dari tiga aspek dasar yaitu umur panjang dan hidup sehat, pengetahuan, dan standar hidup layak.",
    tahun_mulai: 2025,
    tahun_akhir: 2029,
    target_1: 71.49,
    target_2: 71.8,
    target_3: 72.1,
    target_4: 72.42,
    target_5: 72.8
  },
  {
    id: 192,
    kodewilayah: "35.12",
    id_tujuan: 19,
    indikator_tujuan: "Pertumbuhan Ekonomi",
    rumus: "Pertumbuhan Ekonomi = ((PDRBₜ - PDRBₜ₋₁) / PDRBₜ₋₁) × 100%",
    definisi_operasional: "Perkembangan Produksi Barang dan Jasa di suatu wilayah perekonomian pada tahun tertentu terhadap nilai tahun sebelumnya yang dihitung berdasarkan PDRB harga konstan.",
    tahun_mulai: 2025,
    tahun_akhir: 2029,
    target_1: 4.82,
    target_2: 4.87,
    target_3: 4.92,
    target_4: 4.97,
    target_5: 5.02
  },
  {
    id: 193,
    kodewilayah: "35.12",
    id_tujuan: 19,
    indikator_tujuan: "Ketimpangan Pendapatan (Gini Rasio)",
    rumus: "Gini Ratio (0-1)",
    definisi_operasional: "Rasio gini merupakan teknik statistik untuk mengukur derajat ketimpangan distribusi pendapatan masyarakat.",
    tahun_mulai: 2025,
    tahun_akhir: 2029,
    target_1: 0.38,
    target_2: 0.38,
    target_3: 0.37,
    target_4: 0.37,
    target_5: 0.36
  },
  {
    id: 194,
    kodewilayah: "35.12",
    id_tujuan: 19,
    indikator_tujuan: "Tingkat Kemiskinan",
    rumus: "P0 = (q/n) × 100%",
    definisi_operasional: "Persentase penduduk yang berada di bawah garis kemiskinan per kapita per bulan.",
    tahun_mulai: 2025,
    tahun_akhir: 2029,
    target_1: 10.81,
    target_2: 10.46,
    target_3: 10,
    target_4: 9.66,
    target_5: 9.08
  },
  {
    id: 195,
    kodewilayah: "35.12",
    id_tujuan: 20,
    indikator_tujuan: "Indeks Kepuasan Layanan Infrastruktur (IKLI)",
    rumus: "Rata-rata kepuasan layanan jalan, jembatan, dan irigasi",
    definisi_operasional: "Tingkat kepuasan masyarakat terhadap kondisi dan kemanfaatan infrastruktur daerah.",
    tahun_mulai: 2025,
    tahun_akhir: 2029,
    target_1: 85.03,
    target_2: 85.94,
    target_3: 86.5,
    target_4: 87.29,
    target_5: 88.89
  },
  {
    id: 196,
    kodewilayah: "35.12",
    id_tujuan: 21,
    indikator_tujuan: "Indeks Reformasi Birokrasi",
    rumus: "PMPRB KemenPAN-RB",
    definisi_operasional: "Kemajuan pelaksanaan reformasi birokrasi pada 8 area perubahan tata kelola.",
    tahun_mulai: 2025,
    tahun_akhir: 2029,
    target_1: 84.86,
    target_2: 85.11,
    target_3: 85.61,
    target_4: 86.11,
    target_5: 86.61
  },
  {
    id: 197,
    kodewilayah: "35.12",
    id_tujuan: 22,
    indikator_tujuan: "Indeks Kesalehan Sosial",
    rumus: "Komposit nilai sosial, toleransi, dan kerukunan",
    definisi_operasional: "Tingkat sikap gotong royong dan keharmonisan sosial masyarakat.",
    tahun_mulai: 2025,
    tahun_akhir: 2029,
    target_1: 82.67,
    target_2: 84.07,
    target_3: 85.47,
    target_4: 86.87,
    target_5: 88.27
  }
];

var adminChartInstance = null;
var activeModalId = null;

$(document).ready(function() {
  syncIkuApiData();
  populateAdminChartSelect();
  renderAdminChart();
  updateAdminKpiDisplay();
});

function syncIkuApiData() {
  var $btn = $('#btnSyncAdmin');
  $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Sinkronisasi...');
  
  var w = $('#adminFilterWilayah').val() || $('#adminFilterProvinsi').val() || '';
  var ind = $('#adminFilterIndikator').val() || '';
  var q = [];
  if(w) q.push('kodewilayah='+w);
  if(ind) q.push('indikator='+encodeURIComponent(ind));
  var qs = q.length ? '?'+q.join('&') : '';

  fetch(BACKEND_PROXY_URL + qs)
    .then(function(res) { return res.json(); })
    .then(function(json) {
      if (json && json.data && json.data.length > 0) {
        adminIkuData = json.data;
      }
      filterAdminIkuTable();
      populateAdminChartSelect();
      updateAdminKpiDisplay();
      $btn.prop('disabled', false).html('<i class="fa-solid fa-arrows-rotate mr-1"></i> Sinkronisasi API');
    })
    .catch(function(err) {
      fetch(IPPD_API_URL)
        .then(function(res2) { return res2.json(); })
        .then(function(json2) {
          if (json2 && json2.data && json2.data.length > 0) {
            adminIkuData = json2.data;
          }
          filterAdminIkuTable();
          populateAdminChartSelect();
          updateAdminKpiDisplay();
          $btn.prop('disabled', false).html('<i class="fa-solid fa-arrows-rotate mr-1"></i> Sinkronisasi API');
        })
        .catch(function() {
          filterAdminIkuTable();
          populateAdminChartSelect();
          updateAdminKpiDisplay();
          $btn.prop('disabled', false).html('<i class="fa-solid fa-arrows-rotate mr-1"></i> Sinkronisasi API');
        });
    });
}

function filterAdminIkuTable() {
  var search = ($('#adminRepoSearch').val() || '').toLowerCase().trim();
  var provinsi = $('#adminFilterProvinsi').val() || '';
  var wilayah = $('#adminFilterWilayah').val() || '';
  var indikator = $('#adminFilterIndikator').val() || '';
  var filterAi = $('#adminFilterAi').val() || 'all';

  var filtered = adminIkuData.filter(function(item) {
    var nameMatch = (item.indikator_tujuan || '').toLowerCase().indexOf(search) !== -1;
    if (!nameMatch) return false;
    
    if (indikator && item.indikator_tujuan !== indikator) return false;

    if (wilayah) {
      if (item.kodewilayah !== wilayah) return false;
    } else if (provinsi) {
      if (!item.kodewilayah || item.kodewilayah.indexOf(provinsi + '.') !== 0 && item.kodewilayah !== provinsi) return false;
    }

    var hasEval = !!localStorage.getItem('iku_eval_' + item.id);
    if (filterAi === 'evaluated' && !hasEval) return false;
    if (filterAi === 'pending' && hasEval) return false;

    return true;
  });

  renderAdminTableHtml(filtered);
}

function renderAdminTableHtml(data) {
  var tbody = $('#adminRepoTbody');
  if (!data || data.length === 0) {
    tbody.html('<tr><td colspan="10" class="text-center py-4 text-muted"><i class="fa-solid fa-magnifying-glass mr-2"></i>Tidak ada data yang sesuai filter</td></tr>');
    return;
  }

  var html = '';
  data.forEach(function(item, idx) {
    var isBwi = item.kodewilayah === '35.12';
    var badgeW = isBwi
      ? '<span class="badge-wilayah-tag bwi"><i class="fa-solid fa-location-dot"></i> 35.12 Banyuwangi</span>'
      : '<span class="badge-wilayah-tag other">' + item.kodewilayah + '</span>';

    var evalSaved = localStorage.getItem('iku_eval_' + item.id);
    var aiBtnHtml = '';

    if (evalSaved) {
      aiBtnHtml = '<div style="display:flex; align-items:center; justify-content:center; gap:6px;">' +
                  '<button class="btn-view-ai-admin" onclick="openAdminAiModal(' + item.id + ')"><i class="fa-solid fa-eye"></i> Lihat &amp; Edit</button>' +
                  '<button class="btn btn-default btn-xs" onclick="openAdminAiModal(' + item.id + ', \'regen\')" title="Generate dengan Topik Baru"><i class="fa-solid fa-rotate"></i></button>' +
                  '</div>';
    } else {
      aiBtnHtml = '<button class="btn-generate-ai-admin" id="adminAiBtn-' + item.id + '" onclick="openAdminAiModal(' + item.id + ', \'generate\')">' +
                  '<i class="fa-solid fa-pen-nib mr-1"></i> Telaah Asisten AI' +
                  '</button>';
    }

    html += '<tr id="adminRow-' + item.id + '">' +
            '<td style="text-align:center; font-weight:700; color:#64748b;">' + (idx + 1) + '</td>' +
            '<td>' + badgeW + '</td>' +
            '<td>' +
              '<div style="font-weight:700; color:var(--ide-navy); font-size:13.5px;">' + escapeHtml(item.indikator_tujuan) + '</div>' +
              '<div style="font-size:11.5px; color:#64748b; margin-top:3px; display:flex; align-items:center; gap:6px;">' +
                '<button class="btn-chart-indicator" onclick="openAdminAiModal(' + item.id + ', \'chart\')" title="Lihat Grafik Target Indikator ini"><i class="fa-solid fa-chart-line mr-1"></i>Grafik</button>' +
                '<a href="javascript:void(0)" onclick="selectAdminChart(' + item.id + ')" style="color:var(--ide-navy); font-weight:600;"><i class="fa-solid fa-arrow-down mr-1"></i>Visual Bawah</a>' +
              '</div>' +
            '</td>' +
            '<td style="text-align:center; font-weight:600; color:#64748b;">' + item.tahun_mulai + '–' + item.tahun_akhir + '</td>' +
            '<td style="text-align:center;"><span class="target-badge-num">' + formatTarget(item.target_1) + '</span></td>' +
            '<td style="text-align:center;"><span class="target-badge-num">' + formatTarget(item.target_2) + '</span></td>' +
            '<td style="text-align:center;"><span class="target-badge-num">' + formatTarget(item.target_3) + '</span></td>' +
            '<td style="text-align:center;"><span class="target-badge-num">' + formatTarget(item.target_4) + '</span></td>' +
            '<td style="text-align:center;"><span class="target-badge-num final-t">' + formatTarget(item.target_5) + '</span></td>' +
            '<td style="text-align:center;" id="adminAiCell-' + item.id + '">' + aiBtnHtml + '</td>' +
            '</tr>';
  });

  tbody.html(html);
}

function formatTarget(val) {
  if (val === null || val === undefined || val === '') return '-';
  if (typeof val === 'number') return String(val);
  if (typeof val === 'string') {
    var trimmed = val.trim();
    if (!isNaN(trimmed) && trimmed !== '') {
      var n = parseFloat(trimmed);
      if (!isNaN(n)) return String(n);
    }
    return trimmed;
  }
  return String(val);
}

function escapeHtml(str) {
  if (!str) return '';
  return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}

/* ==================== MODAL INDIKATOR: GRAFIK & GENERATE TOPIK ==================== */
var adminModalChartInstance = null;
var currentModalChartType = 'line';

function switchAdminModalChartType(type) {
  currentModalChartType = type;
  if (type === 'line') {
    $('#btnAdminModalChartLine').addClass('active');
    $('#btnAdminModalChartBar').removeClass('active');
  } else {
    $('#btnAdminModalChartBar').addClass('active');
    $('#btnAdminModalChartLine').removeClass('active');
  }
  var item = adminIkuData.find(function(x) { return x.id == activeModalId; });
  if (item) {
    renderAdminModalChart(item);
  }
}

function renderAdminModalChart(item) {
  var canvas = document.getElementById('adminModalIndicatorChart');
  if (!canvas) return;

  if (adminModalChartInstance) {
    adminModalChartInstance.destroy();
    adminModalChartInstance = null;
  }

  var labels = ['2025 (T1)', '2026 (T2)', '2027 (T3)', '2028 (T4)', '2029 (T5)'];
  var values = [
    parseFloat(item.target_1) || 0,
    parseFloat(item.target_2) || 0,
    parseFloat(item.target_3) || 0,
    parseFloat(item.target_4) || 0,
    parseFloat(item.target_5) || 0
  ];

  var ctx = canvas.getContext('2d');
  var gradient = ctx.createLinearGradient(0, 0, 0, 185);
  gradient.addColorStop(0, 'rgba(4, 49, 104, 0.35)');
  gradient.addColorStop(1, 'rgba(4, 49, 104, 0.0)');

  adminModalChartInstance = new Chart(ctx, {
    type: currentModalChartType,
    data: {
      labels: labels,
      datasets: [{
        label: item.indikator_tujuan + (item.satuan ? ' (' + item.satuan + ')' : ''),
        data: values,
        borderColor: '#043168',
        backgroundColor: currentModalChartType === 'line' ? gradient : 'rgba(4, 49, 104, 0.85)',
        borderWidth: 2.5,
        fill: currentModalChartType === 'line',
        tension: 0.35,
        pointBackgroundColor: '#ffffff',
        pointBorderColor: '#043168',
        pointBorderWidth: 2.5,
        pointRadius: 5,
        pointHoverRadius: 7
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: true, position: 'top' },
        tooltip: {
          callbacks: {
            label: function(context) {
              return ' Target: ' + context.parsed.y + (item.satuan ? ' ' + item.satuan : '');
            }
          }
        }
      },
      scales: {
        x: { grid: { display: false } },
        y: { grid: { color: 'rgba(226, 232, 240, 0.6)' } }
      }
    }
  });
}

function setAdminQuickTopic(topic) {
  $('#adminModalTopicInput').val(topic).focus();
}

function executeAdminAiGenerateWithTopic() {
  if (!activeModalId) return;
  var customTopic = $('#adminModalTopicInput').val().trim();
  var tone = $('#adminModalToneSelect').val() || 'komprehensif';
  generateAdminAiEvaluasi(activeModalId, customTopic, tone);
}

async function generateAdminAiEvaluasi(id, customTopic, tone) {
  var item = adminIkuData.find(function(x) { return x.id == id; });
  if (!item) return;

  activeModalId = id;
  customTopic = customTopic !== undefined ? customTopic : ($('#adminModalTopicInput').val() || '').trim();
  tone = tone || ($('#adminModalToneSelect').val() || 'komprehensif');

  // Indikator loading pada tabel dan modal
  var cell = $('#adminAiCell-' + id);
  cell.html('<span style="font-size:11.5px; font-weight:700; color:#043168;"><span class="ai-spinner-small mr-1"></span> Menelaah...</span>');

  var btnModalGen = $('#btnAdminGenerateWithTopic');
  btnModalGen.prop('disabled', true).text('Menyusun Telaah...');

  $('#adminModalKesimpulanText').html('<div style="text-align:center; padding:20px; color:#64748b;"><span class="ai-spinner-small mr-2"></span>Asisten AI sedang menyusun telaah trajektori data...</div>');
  $('#adminModalRekomendasiText').html('<div style="text-align:center; padding:20px; color:#64748b;"><span class="ai-spinner-small mr-2"></span>Menghitung implikasi dan rekomendasi kebijakan...</div>');

  var wilayahNama = item.kodewilayah === '35.12' ? 'Kabupaten Banyuwangi' : 'Wilayah ' + item.kodewilayah;
  var evalResultText = null;
  var modelUsed = 'Asisten AI';

  try {
    var res = await fetch(BACKEND_AI_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        indikator: item.indikator_tujuan,
        kodewilayah: item.kodewilayah,
        tahun_mulai: item.tahun_mulai,
        tahun_akhir: item.tahun_akhir,
        target_1: item.target_1,
        target_2: item.target_2,
        target_3: item.target_3,
        target_4: item.target_4,
        target_5: item.target_5,
        rumus: item.rumus,
        definisi_operasional: item.definisi_operasional,
        topik: customTopic,
        tone: tone
      })
    });
    var json = await res.json();
    if (json.status === 'success' && json.evaluasi) {
      evalResultText = json.evaluasi;
      modelUsed = json.model || 'Asisten AI';
    }
  } catch(e) {
    console.log('Backend AI proxy error:', e);
  }

  if (!evalResultText) {
    var topikText = customTopic ? ' dengan fokus telaah pada ' + customTopic : '';
    evalResultText = "Berdasarkan data trajektori RPJMD 2025–2029 untuk indikator " + item.indikator_tujuan + " di " + wilayahNama + topikText + ", target kinerja ditetapkan bergerak terukur dari nilai dasar " + formatTarget(item.target_1) + " pada tahun 2025 menuju " + formatTarget(item.target_5) + " pada akhir periode 2029. Perkembangan target ini mencerminkan komitmen akselerasi pembangunan daerah yang realistis dengan tren perbaikan bertahap setiap tahun anggaran.\n\nSebagai kesimpulan evaluasi, penetapan target tersebut memiliki tingkat kelayakan yang baik dengan tetap menuntut pengendalian konsisten lintas OPD pengampu" + (customTopic ? ", terutama dalam penguatan intervensi pada aspek " + customTopic : "") + ". Diperlukan harmonisasi alokasi belanja prioritas dan monitoring capaian triwulanan agar deviasi target dapat diantisipasi sejak dini demi keberlanjutan hasil pembangunan di Kabupaten Banyuwangi.";
    modelUsed = 'Asisten AI (Analisis Terpadu Bappeda)';
  }

  btnModalGen.prop('disabled', false).text('Susun / Generate Telaah AI');

  localStorage.setItem('iku_eval_' + id, JSON.stringify({
    id: item.id,
    indikator: item.indikator_tujuan,
    text: evalResultText,
    originalAiText: evalResultText,
    isManualEdited: false,
    topic: customTopic,
    tone: tone,
    model: modelUsed,
    timestamp: new Date().toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })
  }));

  filterAdminIkuTable();
  updateAdminKpiDisplay();
  openAdminAiModal(id);
}

/* ==================== MODE EDIT MANUAL ==================== */
function toggleEditAdminEvaluasi() {
  var editContainer = $('#adminEditModeContainer');
  var viewContainer = $('#adminViewModeContainer');
  var btn = $('#btnToggleEditAdmin');

  if (editContainer.is(':visible')) {
    cancelAdminEditMode();
  } else {
    var storedJson = localStorage.getItem('iku_eval_' + activeModalId);
    var evalData = storedJson ? JSON.parse(storedJson) : null;
    var fullText = evalData ? evalData.text : '';
    var paragraphs = fullText.split(/\n\s*\n/).filter(function(p) { return p.trim().length > 0; });
    var p1 = paragraphs.length > 0 ? paragraphs[0] : '';
    var p2 = paragraphs.length > 1 ? paragraphs.slice(1).join('\n\n') : '';

    $('#adminEditTextarea1').val(p1);
    $('#adminEditTextarea2').val(p2);

    viewContainer.hide();
    editContainer.slideDown(200);
    btn.text('Batal Edit').removeClass('btn-outline-primary').addClass('btn-outline-secondary');
  }
}

function cancelAdminEditMode() {
  $('#adminEditModeContainer').slideUp(150);
  $('#adminViewModeContainer').show();
  $('#btnToggleEditAdmin').text('Edit Manual').removeClass('btn-outline-secondary').addClass('btn-outline-primary');
}

function saveAdminManualEdit() {
  if (!activeModalId) return;
  var p1 = $('#adminEditTextarea1').val().trim();
  var p2 = $('#adminEditTextarea2').val().trim();

  if (!p1 && !p2) {
    alert('Teks evaluasi tidak boleh kosong.');
    return;
  }

  var combined = p1 + '\n\n' + p2;
  var storedJson = localStorage.getItem('iku_eval_' + activeModalId);
  var evalData = storedJson ? JSON.parse(storedJson) : {};
  var item = adminIkuData.find(function(x) { return x.id == activeModalId; });

  evalData.id = activeModalId;
  evalData.indikator = item ? item.indikator_tujuan : (evalData.indikator || 'Indikator');
  evalData.text = combined;
  if (!evalData.originalAiText) {
    evalData.originalAiText = combined;
  }
  evalData.isManualEdited = true;
  evalData.timestamp = new Date().toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });

  localStorage.setItem('iku_eval_' + activeModalId, JSON.stringify(evalData));

  // Simpan ke database melalui backend
  try {
    fetch(BaseURL + 'IDE/simpan_evaluasi_manual', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        id: activeModalId,
        indikator: evalData.indikator,
        evaluasi: combined,
        topik: evalData.topic || ''
      })
    }).catch(function() {});
  } catch (e) {}

  // Update Tampilan Modal
  $('#adminModalKesimpulanText').html(formatMarkdownAdmin(p1));
  $('#adminModalRekomendasiText').html(formatMarkdownAdmin(p2));
  $('#adminModalTime').text(evalData.timestamp);
  $('#adminEvalStatusBadge').text('Diedit Secara Manual').css('background', '#f59e0b');

  cancelAdminEditMode();
  filterAdminIkuTable();
  updateAdminKpiDisplay();

  alert('Perubahan evaluasi berhasil disimpan!');
}

function resetAdminToOriginalAi() {
  if (!activeModalId) return;
  var storedJson = localStorage.getItem('iku_eval_' + activeModalId);
  var evalData = storedJson ? JSON.parse(storedJson) : null;
  if (!evalData || !evalData.originalAiText) {
    alert('Naskah asli AI tidak ditemukan.');
    return;
  }

  if (!confirm('Kembalikan naskah evaluasi ke teks asli hasil generate Asisten AI? Perubahan manual Anda akan ditimpa.')) {
    return;
  }

  evalData.text = evalData.originalAiText;
  evalData.isManualEdited = false;
  evalData.timestamp = new Date().toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });
  localStorage.setItem('iku_eval_' + activeModalId, JSON.stringify(evalData));

  var paragraphs = evalData.text.split(/\n\s*\n/).filter(function(p) { return p.trim().length > 0; });
  var p1 = paragraphs.length > 0 ? paragraphs[0] : evalData.text;
  var p2 = paragraphs.length > 1 ? paragraphs.slice(1).join('\n\n') : '';

  $('#adminModalKesimpulanText').html(formatMarkdownAdmin(p1));
  $('#adminModalRekomendasiText').html(formatMarkdownAdmin(p2));
  $('#adminModalTime').text(evalData.timestamp);
  $('#adminEvalStatusBadge').text('Asisten AI').css('background', '#10b981');

  cancelAdminEditMode();
  filterAdminIkuTable();
  alert('Naskah berhasil dikembalikan ke hasil asli Asisten AI.');
}

function openAdminAiModal(id, mode) {
  var item = adminIkuData.find(function(x) { return x.id == id; });
  if (!item) return;

  activeModalId = id;
  cancelAdminEditMode();

  var storedJson = localStorage.getItem('iku_eval_' + id);
  var evalData = storedJson ? JSON.parse(storedJson) : null;

  $('#adminModalIndicatorName').text(item.indikator_tujuan);
  var wilayahNama = item.kodewilayah === '35.12' ? 'Kabupaten Banyuwangi' : 'Wilayah ' + item.kodewilayah;
  $('#adminModalSubtitle').text(wilayahNama + ' • Periode RPJMD ' + item.tahun_mulai + '–' + item.tahun_akhir);

  var gridHtml = '<div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:8px; padding:6px; text-align:center;"><div style="font-size:10.5px; font-weight:700; color:#64748b;">2025</div><div style="font-weight:800; font-family:monospace; color:var(--ide-navy); font-size:13.5px;">' + formatTarget(item.target_1) + '</div></div>' +
                 '<div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:8px; padding:6px; text-align:center;"><div style="font-size:10.5px; font-weight:700; color:#64748b;">2026</div><div style="font-weight:800; font-family:monospace; color:var(--ide-navy); font-size:13.5px;">' + formatTarget(item.target_2) + '</div></div>' +
                 '<div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:8px; padding:6px; text-align:center;"><div style="font-size:10.5px; font-weight:700; color:#64748b;">2027</div><div style="font-weight:800; font-family:monospace; color:var(--ide-navy); font-size:13.5px;">' + formatTarget(item.target_3) + '</div></div>' +
                 '<div style="background:#ffffff; border:1px solid #e2e8f0; border-radius:8px; padding:6px; text-align:center;"><div style="font-size:10.5px; font-weight:700; color:#64748b;">2028</div><div style="font-weight:800; font-family:monospace; color:var(--ide-navy); font-size:13.5px;">' + formatTarget(item.target_4) + '</div></div>' +
                 '<div style="background:#eff6ff; border:1px solid #93c5fd; border-radius:8px; padding:6px; text-align:center;"><div style="font-size:10.5px; font-weight:700; color:var(--ide-navy);">2029</div><div style="font-weight:800; font-family:monospace; color:var(--ide-navy); font-size:13.5px;">' + formatTarget(item.target_5) + '</div></div>';
  $('#adminModalTargetGrid').html(gridHtml);

  // Render Grafik Indikator khusus di Modal
  setTimeout(function() {
    renderAdminModalChart(item);
  }, 150);

  if (item.definisi_operasional || item.rumus) {
    $('#adminModalDefinisiWrap').show();
    var def = (item.definisi_operasional ? item.definisi_operasional : '') +
              (item.rumus ? '<div style="margin-top:4px; font-family:monospace; color:var(--ide-navy);"><strong>Rumus:</strong> ' + item.rumus + '</div>' : '');
    $('#adminModalDefinisiText').html(def);
  } else {
    $('#adminModalDefinisiWrap').hide();
  }

  // Isi Topik yang tersimpan jika ada
  if (evalData && evalData.topic) {
    $('#adminModalTopicInput').val(evalData.topic);
    $('#adminEvalTopicBadge').text('Topik: ' + evalData.topic).show();
  } else {
    $('#adminModalTopicInput').val('');
    $('#adminEvalTopicBadge').hide();
  }

  if (evalData && evalData.tone) {
    $('#adminModalToneSelect').val(evalData.tone);
  } else {
    $('#adminModalToneSelect').val('komprehensif');
  }

  // Update Status Badge (AI vs Manual Edit)
  if (evalData && evalData.isManualEdited) {
    $('#adminEvalStatusBadge').text('Diedit Secara Manual').css('background', '#f59e0b');
  } else {
    $('#adminEvalStatusBadge').text('Asisten AI').css('background', '#10b981');
  }

  var fullText = evalData ? evalData.text : 'Telaah evaluasi belum dibuat. Silakan pilih topik di atas lalu klik tombol "Susun / Generate Telaah AI" untuk memulai.';
  var paragraphs = fullText.split(/\n\s*\n/).filter(function(p) { return p.trim().length > 0; });
  var p1 = paragraphs.length > 0 ? paragraphs[0] : fullText;
  var p2 = paragraphs.length > 1 ? paragraphs.slice(1).join('\n\n') : (evalData ? 'Monitoring konsisten dan pengendalian berkala antar-OPD penanggung jawab diperlukan untuk memastikan ketercapaian target RPJMD.' : 'Rekomendasi langkah teknis dan intervensi program akan dimuat di bagian ini.');

  $('#adminModalKesimpulanText').html(formatMarkdownAdmin(p1));
  $('#adminModalRekomendasiText').html(formatMarkdownAdmin(p2));
  $('#adminModalModel').text(evalData ? evalData.model : 'Asisten AI');
  $('#adminModalTime').text(evalData ? evalData.timestamp : '-');

  $('#modalAdminEvaluasiAi').modal('show');

  if (mode === 'regen' || mode === 'generate') {
    setTimeout(function() {
      $('#adminModalTopicInput').focus();
    }, 400);
  }
}

function regenAdminModalAi() {
  if (activeModalId) {
    $('#modalAdminEvaluasiAi').modal('hide');
    generateAdminAiEvaluasi(activeModalId);
  }
}

function salinEvaluasiAdmin() {
  var name = $('#adminModalIndicatorName').text();
  var storedJson = localStorage.getItem('iku_eval_' + activeModalId);
  var evalData = storedJson ? JSON.parse(storedJson) : null;
  var fullText = evalData ? evalData.text : ($('#adminModalKesimpulanText').text() + '\n\n' + $('#adminModalRekomendasiText').text());
  
  var text = "=== TELAAH IKU BAPPEDA BANYUWANGI ===\nIndikator: " + name + "\n\n" + fullText + "\n\n(Sistem CVIDE Bappeda Banyuwangi)";
  navigator.clipboard.writeText(text).then(function() {
    alert('Naskah telaah berhasil disalin ke clipboard!');
  });
}

function cetakEvaluasiAdmin() {
  var name = $('#adminModalIndicatorName').text();
  var sub = $('#adminModalSubtitle').text();
  var k = $('#adminModalKesimpulanText').html();
  var r = $('#adminModalRekomendasiText').html();
  var t = $('#adminModalTargetGrid').html();
  var storedJson = localStorage.getItem('iku_eval_' + activeModalId);
  var evalData = storedJson ? JSON.parse(storedJson) : null;
  var statusKeterangan = evalData && evalData.isManualEdited ? 'Disesuaikan/Diedit secara manual oleh staf' : 'Disusun otomatis oleh Asisten AI Bappeda';

  var printWin = window.open('', '_blank', 'width=800,height=700');
  printWin.document.write('<!DOCTYPE html><html><head><title>Evaluasi IKU - ' + name + '</title><style>body{font-family:sans-serif; padding:30px; line-height:1.6; color:#1e293b;} h2{margin:0; color:#043168;} .grid{display:flex; gap:10px; margin:15px 0;} .box{border:1px solid #cbd5e1; border-radius:8px; padding:15px; margin-bottom:15px; background:#f8fafc;} .title{font-weight:bold; color:#043168; margin-bottom:6px;}</style></head><body>' +
    '<h2>PEMERINTAH KABUPATEN BANYUWANGI</h2><h3>BAPPEDA - REPOSITORI IKU</h3>' +
    '<div><strong>Indikator:</strong> ' + name + '</div><div><strong>Wilayah & Periode:</strong> ' + sub + '</div>' +
    '<div class="grid">' + t + '</div>' +
    '<div class="box"><div class="title">1. TRAJEKTORI TARGET KINERJA</div><div>' + k + '</div></div>' +
    '<div class="box"><div class="title">2. KESIMPULAN & EVALUASI PEMBANGUNAN DAERAH</div><div>' + r + '</div></div>' +
    '<div style="text-align:right; font-size:12px; color:#94a3b8;">' + statusKeterangan + ' | Dicetak: ' + new Date().toLocaleString('id-ID') + '</div>' +
    '</body></html>');
  printWin.document.close();
  printWin.focus();
  setTimeout(function() { printWin.print(); }, 400);
}

function formatMarkdownAdmin(text) {
  if (!text) return '';
  var res = escapeHtml(text);
  res = res.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
  res = res.replace(/\*(.*?)\*/g, '<em>$1</em>');
  res = res.replace(/^[•\-\*]\s+(.*)$/gm, '<li style="margin-left:18px;">$1</li>');
  res = res.replace(/^(\d+)\.\s+(.*)$/gm, '<div style="margin-bottom:5px;"><strong>$1.</strong> $2</div>');
  res = res.replace(/\n\n/g, '<br><br>');
  return res;
}

async function batchGenerateAllAIAdmin() {
  var pending = adminIkuData.filter(function(item) {
    return !localStorage.getItem('iku_eval_' + item.id);
  });
  if (pending.length === 0) {
    alert('Semua indikator sudah memiliki telaah evaluasi AI!');
    return;
  }
  if (!confirm('Terdapat ' + pending.length + ' indikator yang belum dievaluasi. Susun telaah semua sekarang dengan Asisten AI?')) {
    return;
  }
  for (var i = 0; i < pending.length; i++) {
    await generateAdminAiEvaluasi(pending[i].id);
    await new Promise(function(r) { setTimeout(r, 600); });
  }
}

function updateAdminKpiDisplay() {
  var total = adminIkuData.length;
  var bwi = adminIkuData.filter(function(x) { return x.kodewilayah === '35.12'; }).length;
  var evalCount = 0;
  adminIkuData.forEach(function(x) {
    if (localStorage.getItem('iku_eval_' + x.id)) evalCount++;
  });

  $('#adminKpiTotal').text(total + ' Indikator');
  $('#adminKpiBwi').text(bwi + ' Indikator');
  $('#adminKpiAi').text(evalCount + ' / ' + total);
  $('#adminKpiAiStatus').text(evalCount === total ? 'Seluruhnya selesai' : (total - evalCount) + ' belum dievaluasi');
}

function populateAdminChartSelect() {
  var sel = $('#adminChartIndicator');
  var html = '';
  adminIkuData.forEach(function(item) {
    var label = item.kodewilayah === '35.12' ? 'Banyuwangi' : item.kodewilayah;
    html += '<option value="' + item.id + '">[' + label + '] ' + escapeHtml(item.indikator_tujuan) + '</option>';
  });
  sel.html(html);
}

function selectAdminChart(id) {
  $('#adminChartIndicator').val(id);
  renderAdminChart();
  $('html, body').animate({ scrollTop: $('#adminIkuChart').offset().top - 200 }, 500);
}

function renderAdminChart() {
  var canvas = document.getElementById('adminIkuChart');
  if (!canvas) return;

  var selectedId = $('#adminChartIndicator').val() || (adminIkuData[0] ? adminIkuData[0].id : null);
  var item = adminIkuData.find(function(x) { return x.id == selectedId; }) || adminIkuData[0];
  if (!item) return;

  var type = $('#adminChartType').val() || 'line';
  var labels = ['2025 (T1)', '2026 (T2)', '2027 (T3)', '2028 (T4)', '2029 (T5)'];
  var values = [
    parseFloat(item.target_1) || 0,
    parseFloat(item.target_2) || 0,
    parseFloat(item.target_3) || 0,
    parseFloat(item.target_4) || 0,
    parseFloat(item.target_5) || 0
  ];

  if (adminChartInstance) {
    adminChartInstance.destroy();
  }

  var ctx = canvas.getContext('2d');
  var gradient = ctx.createLinearGradient(0, 0, 0, 300);
  gradient.addColorStop(0, 'rgba(4, 49, 104, 0.35)');
  gradient.addColorStop(1, 'rgba(4, 49, 104, 0.0)');

  adminChartInstance = new Chart(ctx, {
    type: type,
    data: {
      labels: labels,
      datasets: [{
        label: item.indikator_tujuan,
        data: values,
        borderColor: '#043168',
        backgroundColor: type === 'line' ? gradient : 'rgba(4, 49, 104, 0.85)',
        borderWidth: 3,
        fill: type === 'line',
        tension: 0.35,
        pointBackgroundColor: '#ffffff',
        pointBorderColor: '#043168',
        pointBorderWidth: 2.5,
        pointRadius: 5.5
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: true, position: 'top' }
      },
      scales: {
        x: { grid: { display: false } },
        y: { grid: { color: 'rgba(226, 232, 240, 0.6)' } }
      }
    }
  });
}

function openKomparasiModal() {
  var bwiData = adminIkuData.filter(function(x) { return x.kodewilayah === '35.12'; });
  
  var htmlLeft = '';
  var htmlRight = '';
  bwiData.forEach(function(item, idx) {
    htmlLeft += '<tr>' +
      '<td style="font-weight:600; color:var(--ide-navy); max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="'+escapeHtml(item.indikator_tujuan)+'">' + escapeHtml(item.indikator_tujuan) + '</td>' +
      '<td>' + formatTarget(item.target_1) + '</td>' +
      '<td>' + formatTarget(item.target_2) + '</td>' +
      '<td>' + formatTarget(item.target_3) + '</td>' +
      '<td>' + formatTarget(item.target_4) + '</td>' +
      '<td>' + formatTarget(item.target_5) + '</td>' +
      '</tr>';
      
    htmlRight += '<div class="custom-control custom-checkbox mb-2" style="display:flex; align-items:center; gap:8px;">' +
      '<input type="checkbox" class="komparasi-check" id="komparasiCheck'+idx+'" value="'+escapeHtml(item.indikator_tujuan)+'">' +
      '<label for="komparasiCheck'+idx+'" style="font-size:13px; margin:0; cursor:pointer;">'+escapeHtml(item.indikator_tujuan)+'</label>' +
      '</div>';
  });
  
  $('#komparasiLeftData').html(htmlLeft);
  $('#komparasiRightOptions').html(htmlRight);
  $('#komparasiAiResult').hide();
  $('#komparasiAiPrompt').val('');
  
  $('#modalKomparasiData').modal('show');
}

async function runAiKomparasi() {
  var bwiData = adminIkuData.filter(function(x) { return x.kodewilayah === '35.12'; });
  var selectedIndicators = [];
  $('.komparasi-check:checked').each(function() {
    selectedIndicators.push($(this).val());
  });
  
  if (selectedIndicators.length === 0) {
    alert('Pilih minimal satu indikator di panel kanan untuk dikomparasi.');
    return;
  }
  
  var promptStr = $('#komparasiAiPrompt').val().trim();
  if (!promptStr) {
    alert('Masukkan aspek komparasi (prompt) untuk AI.');
    return;
  }
  
  $('#btnRunAiKomparasi').prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Sedang Menelaah...');
  $('#komparasiAiResult').show();
  $('#komparasiAiContent').html('<span style="color:#64748b;"><i class="fa-solid fa-spinner fa-spin mr-2"></i>AI sedang membaca tabel dan menyusun komparasi...</span>');
  
  var payload = {
    data_kiri: bwiData,
    indikator_kanan: selectedIndicators,
    prompt: promptStr
  };
  
  try {
    var res = await fetch(BaseURL + 'IDE/generate_gemini_komparasi', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    var json = await res.json();
    if (json.status === 'success') {
      $('#komparasiAiContent').html(formatMarkdownAdmin(json.komparasi));
    } else {
      $('#komparasiAiContent').html('<span style="color:red;">Gagal menelaah komparasi.</span>');
    }
  } catch (e) {
    $('#komparasiAiContent').html('<span style="color:red;">Terjadi kesalahan pada server.</span>');
  }
  
  $('#btnRunAiKomparasi').prop('disabled', false).html('Mulai Komparasi AI');
}
</script>
</body>
</html>
