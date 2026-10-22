/**
 * survei_rtkd_engine.js
 * Engine Form Survei Ketenagakerjaan Banyuwangi (RTKD) 2026
 * Mendukung 5 Instrumen Dinamis Lengkap:
 *   A - Perusahaan / Pemberi Kerja (Termasuk Green Job, Labour Turnover, Iklim UMK)
 *   B - Pencari Kerja & Lulusan (Termasuk Riwayat Kerja, Green Job, Minat UMK)
 *   C - Pemangku Kepentingan (Wawancara Mendalam / FGD Isu Strategis)
 *   C2 / E - AHP Pemangku Kepentingan (Analytic Hierarchy Process Matriks Perbandingan Berpasangan)
 *   D - Siswa Kelas 12 (Profil, Rencana Lulus, Keterampilan, Green Job)
 */

(function(window, $) {
  'use strict';

  var KEC = ["Banyuwangi","Blimbingsari","Bangorejo","Cluring","Gambiran","Genteng","Giri","Glagah","Glenmore","Kabat","Kalibaru","Kalipuro","Licin","Muncar","Pesanggaran","Purwoharjo","Rogojampi","Sempu","Siliragung","Singojuruh","Songgon","Srono","Tegaldlimo","Tegalsari","Wongsorejo"];
  var SEKTOR = ["Pertanian/perikanan","Industri pengolahan","Perdagangan","Akomodasi dan makan-minum","Konstruksi","Transportasi/pergudangan","Jasa pendidikan/kesehatan","Jasa lainnya"];
  var BEKERJA = ["Bekerja sebagai karyawan/buruh","Berusaha sendiri","Pekerja lepas","Membantu usaha keluarga"];
  var SCALE_NOTE = "1 = sangat kurang · 5 = sangat baik";
  var IDENTITAS = new Set(["P1","P2","P3","P4","P5","L1","L2","L3","L4","L5","L6","K1","K2","K3","K4","K5","K6","K7","S1","S2","S3","S4","S5"]);
  var NOWHY = new Set(["L30","L33","L39"]);

  var HIJAU_DEF = "Green job atau pekerjaan hijau adalah pekerjaan yang ikut menjaga alam dan lingkungan tetap bersih dan lestari, dengan upah dan perlindungan kerja yang layak. Contohnya: mengelola bank sampah, mendaur ulang plastik, bertani organik, menangkap ikan tanpa merusak laut, memandu wisata alam, dan memasang listrik tenaga surya.";
  var BIDANG_HIJAU = ["Listrik tenaga surya, biogas, atau angin","Pengelolaan sampah dan daur ulang","Pertanian organik (tanpa banyak bahan kimia)","Perikanan yang tidak merusak laut","Wisata alam dan desa wisata","Bangunan hemat listrik dan air","Kendaraan listrik dan bengkelnya","Lainnya"];
  var TAHU_HIJAU = ["Pernah dengar dan tahu artinya","Pernah dengar, tapi belum tahu artinya","Belum pernah dengar"];
  var MINAT_HIJAU = ["Sangat tertarik","Tertarik","Kurang tertarik","Tidak tertarik"];
  var TERTARIK = function(v) { return v === "Sangat tertarik" || v === "Tertarik"; };

  /* ---------- AHP Pemangku Kepentingan Constants & Helpers ---------- */
  var AHP_KRIT = [
    "Mendukung target pembangunan daerah",
    "Dirasakan oleh banyak warga",
    "Ikut mendorong kemajuan sektor lain",
    "Bisa ditangani pemerintah kabupaten",
    "Bisa diatasi dalam 5 tahun",
    "Sejalan dengan program bupati"
  ];
  var AHP_ISU = [
    "Banyak pekerja tanpa kontrak dan perlindungan",
    "Keterampilan pencari kerja belum sesuai kebutuhan",
    "Hasil kerja petani dan nelayan masih rendah",
    "Anak muda dan lulusan sulit mendapat kerja",
    "Pekerja migran dan kelompok rentan kurang terlindungi"
  ];
  var SAATY = "Cara mengisi: klik angka yang lebih dekat ke hal yang menurut Anda lebih penting. Angka 1 di tengah berarti sama penting. Makin besar angkanya, makin penting: 3 = sedikit lebih penting, 5 = lebih penting, 7 = jauh lebih penting, 9 = sangat jauh lebih penting. Angka 2, 4, 6, 8 boleh dipakai jika ragu di antara dua pilihan.";
  var RI = [0, 0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45];

  function pairQs(prefix, items) {
    var qs = [];
    for (var i = 0; i < items.length; i++) {
      for (var j = i + 1; j < items.length; j++) {
        qs.push({
          c: prefix + (i + 1) + (j + 1),
          type: "pair",
          left: items[i],
          right: items[j],
          req: 1
        });
      }
    }
    return qs;
  }

  function fmt(x, d) {
    return Number(x).toFixed(d).replace(".", ",");
  }

  function parseR(s) {
    if (s == null || s === "") return null;
    var t = String(s);
    return t.indexOf("/") !== -1 ? (1 / Number(t.split("/")[1])) : Number(t);
  }

  function buildM(a, prefix, n) {
    var M = [];
    for (var r = 0; r < n; r++) {
      M[r] = [];
      for (var c = 0; c < n; c++) M[r][c] = 1;
    }
    for (var i = 0; i < n; i++) {
      for (var j = i + 1; j < n; j++) {
        var v = parseR(a[prefix + (i + 1) + (j + 1)]);
        if (v == null || !isFinite(v) || v <= 0) return null;
        M[i][j] = v;
        M[j][i] = 1 / v;
      }
    }
    return M;
  }

  function ahp(M) {
    var n = M.length;
    var w = Array(n).fill(1 / n);
    for (var it = 0; it < 200; it++) {
      var nw = M.map(function(row) {
        return row.reduce(function(s, x, j) { return s + x * w[j]; }, 0);
      });
      var sum = nw.reduce(function(s, x) { return s + x; }, 0);
      var nn = nw.map(function(x) { return x / sum; });
      var d = Math.max.apply(null, nn.map(function(x, i) { return Math.abs(x - w[i]); }));
      w = nn;
      if (d < 1e-12) break;
    }
    var Aw = M.map(function(row) {
      return row.reduce(function(s, x, j) { return s + x * w[j]; }, 0);
    });
    var lam = Aw.reduce(function(s, x, i) { return s + x / w[i]; }, 0) / n;
    var CI = n > 1 ? (lam - n) / (n - 1) : 0;
    var CR = RI[n] ? CI / RI[n] : 0;
    return { w: w, lam: lam, CI: CI, CR: CR };
  }

  function aggAHP(list, b) {
    var n = b.matrix.n;
    var M = [];
    for (var r = 0; r < n; r++) {
      M[r] = [];
      for (var c = 0; c < n; c++) M[r][c] = 1;
    }
    for (var i = 0; i < n; i++) {
      for (var j = i + 1; j < n; j++) {
        var key = b.matrix.prefix + (i + 1) + (j + 1);
        var vals = list.map(function(e) {
          return parseR((e.answers || {})[key]);
        }).filter(function(v) { return v > 0 && isFinite(v); });

        var g = vals.length ? Math.exp(vals.reduce(function(s, v) { return s + Math.log(v); }, 0) / vals.length) : 1;
        M[i][j] = g;
        M[j][i] = 1 / g;
      }
    }
    return ahp(M);
  }

  function hasWhy(q) {
    return ["one", "many", "scale"].indexOf(q.type) !== -1 && !IDENTITAS.has(q.c) && !NOWHY.has(q.c) && /^[PLK]\d/.test(q.c);
  }

  function esc(s) {
    return String(s != null ? s : '').replace(/[&<>"]/g, function(c) {
      return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;" }[c];
    });
  }

  var SCHEMA = {
    A: {
      name: "Perusahaan/pemberi kerja",
      label: "Perusahaan / Pemberi Kerja",
      blocks: [
        {
          t: "Pencatatan petugas",
          hint: "Diisi oleh enumerator sebelum wawancara.",
          qs: [
            { c: "SR", l: "Sumber responden", type: "one", o: ["Daftar wajib lapor Disnaker (sampel acak)", "Ditemui di lapangan (sampel kuota)"], req: 1 },
            { c: "SR2", l: "Nama lokasi pengambilan", note: "misalnya nama pasar atau kawasan usaha", type: "text", show: function(a) { return a.SR === "Ditemui di lapangan (sampel kuota)"; } }
          ]
        },
        {
          t: "A. Identitas usaha",
          qs: [
            { c: "P1", l: "Nama usaha", note: "opsional", type: "text" },
            { c: "P2", l: "Kecamatan lokasi usaha", type: "kec", req: 1 },
            { c: "P3", l: "Sektor utama usaha", type: "one", o: SEKTOR, req: 1 },
            { c: "P4", l: "Jumlah seluruh pekerja", type: "one", o: ["1–4", "5–19", "20–99", "100 ke atas"], req: 1 },
            { c: "P5", l: "Bentuk usaha", type: "one", o: ["Perorangan tidak berbadan hukum", "CV/firma", "PT", "Koperasi", "BUMN/BUMD"] }
          ]
        },
        {
          t: "B. Tenaga kerja saat ini",
          qs: [
            { c: "P6", l: "Jumlah pekerja menurut jenis kelamin", type: "grid", f: ["Laki-laki", "Perempuan"] },
            { c: "P7", l: "Jumlah pekerja menurut status", type: "grid", f: ["Tetap", "Kontrak", "Harian lepas"] },
            { c: "P8", l: "Jumlah pekerja menurut pendidikan", type: "grid", f: ["SD ke bawah", "SMP", "SMA", "SMK", "Diploma", "S1 ke atas"] },
            { c: "P9", l: "Jumlah pekerja yang berasal dari luar Banyuwangi", type: "num" }
          ]
        },
        {
          t: "C. Rekrutmen 12 bulan terakhir",
          qs: [
            { c: "P10", l: "Jumlah pekerja baru yang direkrut", type: "num" },
            { c: "P11", l: "Saluran rekrutmen yang dipakai", note: "boleh lebih dari satu", type: "many", o: ["Kenalan/keluarga", "Media sosial", "Disnaker/bursa kerja", "Sekolah/kampus", "Portal lowongan", "Agen penyalur"] },
            { c: "P12", l: "Adakah lowongan yang sulit diisi?", type: "one", o: ["Ya", "Tidak"] },
            { c: "P13", l: "Jabatan yang sulit diisi", type: "text", show: function(a) { return a.P12 === "Ya"; } },
            { c: "P14", l: "Alasan utama sulit diisi", type: "one", o: ["Pelamar kurang", "Keterampilan tidak sesuai", "Pengalaman kurang", "Upah yang diharapkan terlalu tinggi", "Lokasi jauh", "Lainnya"], show: function(a) { return a.P12 === "Ya"; } }
          ]
        },
        {
          t: "D. Kebutuhan tenaga kerja tiga tahun ke depan",
          qs: [
            { c: "P15", l: "Rencana jumlah pekerja", type: "one", o: ["Bertambah", "Tetap", "Berkurang"] },
            { c: "P16", l: "Perkiraan tambahan pekerja", type: "num", show: function(a) { return a.P15 === "Bertambah"; } },
            { c: "P17", l: "Jabatan dan pendidikan yang paling dibutuhkan", note: "jabatan, pendidikan minimal, jumlah", type: "area" },
            { c: "P18", l: "Faktor yang paling memengaruhi rencana tersebut", type: "one", o: ["Permintaan pasar", "Investasi/perluasan", "Otomasi/digitalisasi", "Biaya tenaga kerja", "Lainnya"] }
          ]
        },
        {
          t: "E. Keterampilan dan pelatihan",
          qs: [
            { c: "P19", l: "Penilaian keterampilan lulusan lokal", type: "scale", f: ["Teknis sesuai bidang", "Digital", "Bahasa asing", "Komunikasi", "Kerja sama tim", "Disiplin/etos kerja"] },
            { c: "P20", l: "Keterampilan yang paling kurang dari pelamar", type: "text" },
            { c: "P21", l: "Apakah usaha memberi pelatihan kepada pekerja?", type: "one", o: ["Ya, rutin", "Kadang-kadang", "Tidak"] },
            { c: "P22", l: "Kerja sama dengan SMK, BLK, atau kampus", note: "boleh lebih dari satu", type: "many", o: ["Magang/prakerin", "Rekrutmen lulusan", "Penyusunan kurikulum", "Belum ada"] },
            { c: "P23", l: "Pekerja yang memiliki sertifikat kompetensi (BNSP)", type: "one", o: ["Sebagian besar", "Sebagian kecil", "Tidak ada", "Tidak tahu"] }
          ]
        },
        {
          t: "F. Upah, jaminan sosial, dan hubungan kerja",
          qs: [
            { c: "P24", l: "Upah pekerja pemula dibandingkan UMK", type: "one", o: ["Di bawah UMK", "Setara UMK", "Di atas UMK"] },
            { c: "P25", l: "Kepesertaan BPJS Ketenagakerjaan", type: "one", o: ["Semua pekerja", "Sebagian", "Tidak ada"] },
            { c: "P26", l: "Kepesertaan BPJS Kesehatan dari pemberi kerja", type: "one", o: ["Semua pekerja", "Sebagian", "Tidak ada"] },
            { c: "P27", l: "Dokumen hubungan kerja yang dimiliki", note: "boleh lebih dari satu", type: "many", o: ["Kontrak tertulis", "Peraturan perusahaan", "PKB", "LKS Bipartit", "Belum ada"] },
            { c: "P28", l: "Kecelakaan kerja dalam 12 bulan terakhir", type: "one", o: ["Tidak ada", "1–2 kejadian", "3 atau lebih"] }
          ]
        },
        {
          t: "G. Kendala dan harapan",
          qs: [
            { c: "P29", l: "Kendala utama terkait tenaga kerja", type: "area" },
            { c: "P30", l: "Dukungan yang diharapkan dari pemerintah daerah", note: "boleh lebih dari satu", type: "many", o: ["Pelatihan sesuai kebutuhan", "Informasi pasar kerja", "Insentif perekrutan", "Sertifikasi", "Lainnya"] }
          ]
        },
        {
          t: "H. Perputaran pekerja (labour turnover)",
          qs: [
            { c: "P31", l: "Jumlah pekerja yang keluar atau berhenti dalam 12 bulan terakhir", type: "num" },
            { c: "P32", l: "Rata-rata lama pekerja bertahan di perusahaan", type: "one", o: ["Kurang dari 1 tahun", "1–3 tahun", "3–5 tahun", "Lebih dari 5 tahun"] },
            { c: "P36", l: "Apakah pekerja yang sering keluar-masuk menjadi masalah bagi perusahaan?", type: "one", o: ["Ya, masalah besar", "Cukup menjadi masalah", "Tidak menjadi masalah"] },
            { c: "P37", l: "Alasan paling sering pekerja mengundurkan diri", type: "one", o: ["Mendapat upah lebih tinggi di tempat lain", "Kontrak habis", "Upah dirasa terlalu rendah", "Kondisi atau beban kerja tidak cocok", "Bekerja ke luar daerah atau luar negeri", "Membuka usaha sendiri", "Alasan keluarga atau pindah tempat tinggal", "Melanjutkan sekolah", "Lainnya"] },
            { c: "P38", l: "Cara perusahaan mengatasi pekerja yang sering keluar", note: "boleh lebih dari satu", type: "many", o: ["Menaikkan upah atau memberi insentif", "Memberi jenjang karier atau kenaikan jabatan", "Memberi pelatihan", "Mengangkat menjadi pekerja tetap", "Memperbaiki kondisi dan suasana kerja", "Memberi tunjangan atau fasilitas tambahan", "Mengikat dengan kontrak atau ikatan dinas", "Belum ada upaya khusus", "Lainnya"] }
          ]
        },
        {
          t: "I. Kegiatan ramah lingkungan (green job)",
          def: HIJAU_DEF,
          qs: [
            { c: "P33", l: "Kegiatan ramah lingkungan apa yang sudah dilakukan perusahaan?", note: "boleh lebih dari satu", type: "many", o: ["Menghemat listrik atau air", "Mengolah limbah atau mendaur ulang sampah", "Memakai listrik tenaga surya atau energi bersih lainnya", "Memakai bahan baku yang ramah lingkungan", "Punya sertifikat ramah lingkungan", "Belum ada"] },
            { c: "P34", l: "Dalam 3 tahun ke depan, apakah perusahaan berencana menambah pekerja yang punya keterampilan green job?", type: "one", o: ["Ya", "Mungkin", "Tidak"] },
            { c: "P35", l: "Keterampilan green job apa yang paling dibutuhkan?", note: "misalnya mengolah limbah, mendaur ulang, atau merawat panel surya", type: "text", show: function(a) { return a.P34 === "Ya" || a.P34 === "Mungkin"; } }
          ]
        },
        {
          t: "J. Upah minimum dan iklim usaha",
          qs: [
            { c: "P39", l: "Menurut Bapak/Ibu, apakah UMK Banyuwangi saat ini (Rp2.989.145 per bulan pada 2026) cukup kompetitif?", note: "kompetitif: tidak memberatkan usaha dan cukup menarik bagi pekerja dibandingkan daerah lain", type: "one", o: ["Ya, cukup kompetitif", "Kurang kompetitif", "Tidak kompetitif", "Tidak tahu"] },
            { c: "P40", l: "Jika kurang atau tidak kompetitif, apa pengaruhnya bagi perusahaan?", note: "boleh lebih dari satu", type: "many", o: ["Biaya produksi naik", "Keuntungan turun", "Sulit menambah pekerja baru", "Pekerja terampil memilih bekerja di daerah lain", "Pekerja lebih sering keluar", "Harga produk kalah bersaing", "Menunda perluasan usaha", "Lainnya"], show: function(a) { return a.P39 === "Kurang kompetitif" || a.P39 === "Tidak kompetitif"; } },
            { c: "P41", l: "Jika UMK naik, langkah apa yang paling mungkin dilakukan perusahaan?", note: "boleh lebih dari satu", type: "many", o: ["Meningkatkan produksi atau produktivitas pekerja", "Menaikkan harga jual", "Mengurangi jumlah pekerja", "Mengganti sebagian pekerja dengan mesin atau alat produksi", "Mengurangi jam kerja atau lembur", "Menunda penerimaan pekerja baru", "Menambah pekerja kontrak, harian, atau alih daya", "Mengurangi tunjangan atau fasilitas lain", "Tidak ada perubahan", "Lainnya"] },
            { c: "P42", l: "Permasalahan di Kabupaten Banyuwangi yang paling memengaruhi kinerja atau hasil produksi perusahaan", note: "boleh lebih dari satu", type: "many", o: ["Sulit mendapat tenaga kerja terampil", "Biaya tenaga kerja", "Infrastruktur jalan dan transportasi", "Pasokan listrik atau air", "Perizinan usaha", "Akses permodalan", "Permintaan pasar lemah", "Harga atau pasokan bahan baku", "Persaingan usaha", "Musim dan cuaca", "Lainnya"] },
            { c: "P43", l: "Jelaskan permasalahan yang paling berat dan usulan penyelesaiannya", type: "area" }
          ]
        }
      ]
    },
    B: {
      name: "Pencari kerja dan lulusan",
      label: "Pencari Kerja & Lulusan",
      blocks: [
        {
          t: "Pencatatan petugas dan penyaringan",
          hint: "Diisi oleh enumerator sebelum wawancara. Jika responden tidak memenuhi satu pun kriteria penyaring (SC), hentikan wawancara.",
          qs: [
            { c: "SR", l: "Sumber responden", type: "one", o: ["Daftar pencari kerja Disnaker (AK/I)", "Daftar alumni BKK SMK atau tracer study kampus", "Lapangan: cafe, rumah makan, atau toko", "Lapangan: pasar, terminal, atau tempat umum", "Lapangan: kunjungan rumah tangga di desa", "Bursa kerja atau job fair", "Lainnya"], req: 1 },
            { c: "SR2", l: "Nama lokasi pengambilan", note: "misalnya nama cafe, pasar, atau desa", type: "text", show: function(a) { return !!a.SR && (a.SR.indexOf("Lapangan") === 0 || a.SR === "Bursa kerja atau job fair" || a.SR === "Lainnya"); } },
            { c: "SC", l: "Penyaring: responden berusia 15 tahun ke atas dan…", note: "boleh lebih dari satu", type: "many", o: ["Bekerja paling sedikit 1 jam dalam seminggu terakhir", "Sedang mencari kerja atau menyiapkan usaha", "Lulus SMA, SMK, diploma, atau sarjana dalam 3 tahun terakhir", "Tidak satu pun"], req: 1 }
          ]
        },
        {
          t: "A. Profil responden",
          qs: [
            { c: "L1", l: "Umur", type: "one", o: ["15–19", "20–24", "25–29", "30–39", "40 ke atas"], req: 1 },
            { c: "L2", l: "Jenis kelamin", type: "one", o: ["Laki-laki", "Perempuan"], req: 1 },
            { c: "L3", l: "Kecamatan tempat tinggal", type: "kec", req: 1 },
            { c: "L4", l: "Pendidikan terakhir", type: "one", o: ["SD/SMP", "SMA", "SMK", "Diploma", "S1 ke atas"], req: 1 },
            { c: "L5", l: "Jurusan/bidang studi", type: "text" },
            { c: "L6", l: "Tahun lulus", type: "num" }
          ]
        },
        {
          t: "B. Status kegiatan saat ini",
          qs: [
            { c: "L7", l: "Kegiatan utama saat ini", type: "one", o: [].concat(BEKERJA, ["Mencari kerja", "Melanjutkan sekolah/kuliah", "Mengurus rumah tangga"]), req: 1 },
            { c: "L8", l: "Apakah sedang mencari pekerjaan (baru atau tambahan)?", type: "one", o: ["Ya", "Tidak"] }
          ]
        },
        {
          t: "C. Pengalaman mencari kerja",
          qs: [
            { c: "L9", l: "Lama mencari kerja", note: "sejak lulus atau sejak mulai mencari", type: "one", o: ["Kurang dari 3 bulan", "3–6 bulan", "6–12 bulan", "Lebih dari 12 bulan"] },
            { c: "L10", l: "Jumlah lamaran yang dikirim", type: "one", o: ["0", "1–5", "6–20", "Lebih dari 20"] },
            { c: "L11", l: "Cara mencari kerja", note: "boleh lebih dari satu", type: "many", o: ["Kenalan/keluarga", "Media sosial", "Portal lowongan", "Disnaker/bursa kerja", "Sekolah/kampus", "Melamar langsung"] },
            { c: "L12", l: "Terdaftar sebagai pencari kerja di Disnaker (kartu AK/I)?", type: "one", o: ["Ya", "Tidak", "Tidak tahu caranya"] },
            { c: "L13", l: "Kendala utama mendapat pekerjaan", note: "boleh lebih dari satu", type: "many", o: ["Lowongan sedikit", "Keterampilan belum sesuai", "Kurang pengalaman", "Upah rendah", "Lokasi jauh", "Syarat umur/penampilan", "Lainnya"] }
          ]
        },
        {
          t: "D. Pekerjaan saat ini",
          hint: "Diisi hanya oleh responden yang bekerja atau berusaha (L7).",
          qs: [
            { c: "L14", l: "Sektor pekerjaan", type: "one", o: SEKTOR, show: function(a) { return BEKERJA.indexOf(a.L7) !== -1; } },
            { c: "L15", l: "Kesesuaian pekerjaan dengan pendidikan", type: "one", o: ["Sesuai", "Kurang sesuai", "Tidak sesuai"], show: function(a) { return BEKERJA.indexOf(a.L7) !== -1; } },
            { c: "L16", l: "Pendapatan bersih per bulan", type: "one", o: ["Kurang dari Rp1 juta", "Rp1–2 juta", "Rp2–3 juta", "Rp3–5 juta", "Lebih dari Rp5 juta"], show: function(a) { return BEKERJA.indexOf(a.L7) !== -1; } },
            { c: "L17", l: "Jam kerja per minggu", type: "one", o: ["Kurang dari 15", "15–34", "35–48", "Lebih dari 48"], show: function(a) { return BEKERJA.indexOf(a.L7) !== -1; } },
            { c: "L18", l: "Memiliki kontrak kerja tertulis", type: "one", o: ["Ya", "Tidak", "Tidak berlaku (usaha sendiri)"], show: function(a) { return BEKERJA.indexOf(a.L7) !== -1; } },
            { c: "L19", l: "Terdaftar BPJS Ketenagakerjaan", type: "one", o: ["Ya", "Tidak", "Tidak tahu"], show: function(a) { return BEKERJA.indexOf(a.L7) !== -1; } },
            { c: "L20", l: "Lokasi kerja", type: "one", o: ["Di Banyuwangi", "Di luar Banyuwangi", "Di luar negeri"], show: function(a) { return BEKERJA.indexOf(a.L7) !== -1; } }
          ]
        },
        {
          t: "E. Keterampilan dan pelatihan",
          qs: [
            { c: "L21", l: "Pelatihan yang pernah diikuti", note: "boleh lebih dari satu", type: "many", o: ["BLK", "Kartu Prakerja", "Lembaga kursus swasta", "Pelatihan dari perusahaan", "Belum pernah"] },
            { c: "L22", l: "Memiliki sertifikat kompetensi (BNSP)", type: "one", o: ["Ya", "Tidak"] },
            { c: "L23", l: "Penilaian diri atas keterampilan", type: "scale", f: ["Teknis", "Digital", "Bahasa asing", "Komunikasi"] },
            { c: "L24", l: "Pelatihan yang paling diinginkan", type: "text" }
          ]
        },
        {
          t: "F. Harapan dan rencana",
          qs: [
            { c: "L25", l: "Rata-rata pengeluaran pribadi per bulan", note: "makan, transportasi, pulsa, dan kebutuhan lain", type: "one", o: ["Kurang dari Rp1 juta", "Rp1–2 juta", "Rp2–3 juta", "Rp3–5 juta", "Lebih dari Rp5 juta"] },
            { c: "L26", l: "Sektor yang paling diminati", type: "one", o: [].concat(SEKTOR, ["Pemerintahan/ASN"]) },
            { c: "L27", l: "Kesediaan bekerja di luar Banyuwangi", type: "one", o: ["Ya, dalam negeri", "Ya, termasuk luar negeri", "Tidak"] },
            { c: "L28", l: "Minat membuka usaha sendiri", type: "one", o: ["Sudah berusaha", "Berminat", "Tidak berminat"] },
            { c: "L29", l: "Kendala utama memulai usaha", type: "one", o: ["Modal", "Keterampilan", "Pasar", "Perizinan", "Lainnya"] },
            { c: "L39", l: "Jika ditawari pekerjaan dengan upah di bawah UMK (Rp2.989.145 per bulan pada 2026), apa yang akan Anda lakukan?", type: "one", o: ["Tetap mengambil", "Mengambil sementara sambil mencari pekerjaan lain", "Tergantung jenis pekerjaannya", "Tidak mengambil"] },
            { c: "L39a", l: "Alasannya", type: "area", req: 1, show: function(a) { return !!a.L39; } },
            { c: "L40", l: "Lebih suka bekerja dengan penghasilan tetap atau lepas (freelance)?", type: "one", o: ["Penghasilan tetap (gaji bulanan)", "Lepas/freelance (dibayar per pekerjaan)", "Pekerjaan tetap ditambah pekerjaan sampingan", "Tidak ada pilihan khusus"] }
          ]
        },
        {
          t: "G. Riwayat perpindahan kerja",
          qs: [
            { c: "L30", l: "Apakah pernah bekerja, termasuk pekerjaan saat ini?", type: "one", o: ["Ya", "Belum pernah bekerja"] },
            { c: "L31", l: "Berapa kali berpindah tempat kerja dalam 5 tahun terakhir", type: "one", o: ["Belum pernah pindah", "1 kali", "2–3 kali", "4 kali atau lebih"], show: function(a) { return a.L30 === "Ya"; } },
            { c: "L32", l: "Waktu paling lama bekerja di satu tempat kerja", type: "one", o: ["Kurang dari 6 bulan", "6–12 bulan", "1–2 tahun", "2–5 tahun", "Lebih dari 5 tahun"], show: function(a) { return a.L30 === "Ya"; } },
            { c: "L33", l: "Alasan utama mengundurkan diri, berhenti, atau pindah dari pekerjaan sebelumnya", type: "one", o: ["Masih bekerja di tempat kerja pertama", "Kontrak habis", "Upah rendah", "Mendapat pekerjaan yang lebih baik", "PHK atau usaha tutup", "Kondisi kerja tidak nyaman", "Alasan keluarga atau pindah tempat tinggal", "Melanjutkan sekolah", "Lainnya"], show: function(a) { return a.L30 === "Ya"; } },
            { c: "L33a", l: "Sebutkan alasan lainnya", type: "area", req: 1, show: function(a) { return a.L30 === "Ya" && a.L33 === "Lainnya"; } }
          ]
        },
        {
          t: "H. Green job (pekerjaan ramah lingkungan)",
          def: HIJAU_DEF,
          qs: [
            { c: "L34", l: "Sebelum membaca penjelasan di atas, apakah Anda pernah mendengar istilah green job atau pekerjaan hijau?", type: "one", o: TAHU_HIJAU },
            { c: "L35", l: "Apakah pekerjaan Anda sekarang atau yang terakhir ikut menjaga lingkungan?", type: "one", o: ["Ya", "Sebagian", "Tidak", "Tidak tahu"], show: function(a) { return a.L30 === "Ya"; } },
            { c: "L36", l: "Apakah Anda tertarik bekerja di bidang green job?", type: "one", o: MINAT_HIJAU },
            { c: "L37", l: "Bidang green job apa yang paling Anda minati?", note: "boleh lebih dari satu", type: "many", o: BIDANG_HIJAU, show: function(a) { return TERTARIK(a.L36); } },
            { c: "L38", l: "Apakah Anda pernah ikut pelatihan tentang green job?", note: "misalnya daur ulang, pertanian organik, atau pemasangan panel surya", type: "one", o: ["Ya", "Tidak"] }
          ]
        }
      ]
    },
    C: {
      name: "Pemangku kepentingan",
      label: "Pemangku Kepentingan",
      blocks: [
        {
          t: "Identitas narasumber",
          hint: "Catatan wawancara mendalam atau FGD. Tulis pokok jawaban, bukan transkrip lengkap.",
          qs: [
            { c: "S1", l: "Kelompok narasumber", type: "one", o: ["Perencana dan pengelola program", "Penyedia pelatihan dan pendidikan", "Dunia usaha", "Pekerja/serikat pekerja", "Penempatan dan migrasi kerja"], req: 1 },
            { c: "S2", l: "Nama lembaga", type: "text", req: 1 },
            { c: "S3", l: "Jabatan narasumber", type: "text" },
            { c: "S4", l: "Tanggal wawancara", type: "date" },
            { c: "S5", l: "Bentuk kegiatan", type: "one", o: ["Wawancara mendalam", "FGD"] }
          ]
        },
        {
          t: "Pokok jawaban per tema",
          hint: "Isi tema yang relevan dengan peran narasumber saja.",
          qs: [
            { c: "T1", l: "Kondisi pasar kerja", note: "perubahan terbesar, sektor tumbuh/menurun, dampak investasi dan pariwisata", type: "area" },
            { c: "T2", l: "Kesesuaian keterampilan", note: "jabatan sulit diisi, keselarasan kurikulum SMK/kampus/BLK", type: "area" },
            { c: "T3", l: "Program dan layanan ketenagakerjaan", note: "program yang berjalan, hambatan, koordinasi, sistem informasi pasar kerja", type: "area" },
            { c: "T4", l: "Pengupahan dan hubungan industrial", note: "kepatuhan UMK dan jaminan sosial, perselisihan yang sering muncul", type: "area" },
            { c: "T5", l: "Pekerja rentan dan informal", note: "pekerja informal, perempuan, penyandang disabilitas, pekerja migran", type: "area" },
            { c: "T6", l: "Usulan kebijakan dan program prioritas", type: "area" }
          ]
        },
        {
          t: "Tiga isu terpenting menurut narasumber",
          qs: [
            { c: "I1", l: "Isu pertama", type: "text" },
            { c: "I2", l: "Isu kedua", type: "text" },
            { c: "I3", l: "Isu ketiga", type: "text" }
          ]
        }
      ]
    },
    D: {
      name: "Siswa kelas 12",
      label: "Siswa Kelas 12",
      blocks: [
        {
          t: "A. Profil responden",
          hint: "Diisi sendiri oleh siswa kelas 12 SMA, SMK, atau MA. Jangan menulis nama siswa.",
          qs: [
            { c: "K1", l: "Jenis sekolah", type: "one", o: ["SMA", "SMK", "MA"], req: 1 },
            { c: "K2", l: "Nama sekolah", type: "text", req: 1 },
            { c: "K3", l: "Kecamatan lokasi sekolah", type: "kec", req: 1 },
            { c: "K4", l: "Jurusan atau kompetensi keahlian", type: "text" },
            { c: "K5", l: "Umur", type: "one", o: ["16 tahun atau kurang", "17 tahun", "18 tahun", "19 tahun atau lebih"], req: 1 },
            { c: "K6", l: "Jenis kelamin", type: "one", o: ["Laki-laki", "Perempuan"], req: 1 },
            { c: "K7", l: "Kecamatan tempat tinggal", type: "kec" }
          ]
        },
        {
          t: "B. Rencana setelah lulus",
          qs: [
            { c: "K8", l: "Rencana utama setelah lulus", type: "one", o: ["Bekerja", "Kuliah", "Kuliah sambil bekerja", "Berwirausaha", "Kursus/pelatihan dulu", "Bekerja di luar negeri", "Belum tahu"], req: 1 },
            { c: "K9", l: "Jika bekerja, lokasi kerja yang diinginkan", type: "one", o: ["Di Banyuwangi", "Di luar Banyuwangi, masih di Jawa Timur", "Di luar Jawa Timur", "Di luar negeri"] },
            { c: "K10", l: "Sektor pekerjaan yang paling diminati", type: "one", o: [].concat(SEKTOR, ["Pemerintahan/ASN"]) },
            { c: "K11", l: "Pekerjaan atau jabatan yang dicita-citakan", type: "text" },
            { c: "K12", l: "Upah minimal per bulan yang bersedia diterima pada pekerjaan pertama", type: "one", o: ["Kurang dari Rp2 juta", "Rp2–3 juta", "Rp3–4 juta", "Lebih dari Rp4 juta"] },
            { c: "K13", l: "Keyakinan mendapat pekerjaan dalam 6 bulan setelah lulus", type: "one", o: ["Sangat yakin", "Yakin", "Ragu-ragu", "Tidak yakin"] },
            { c: "K14", l: "Minat bekerja sebagai pekerja migran di luar negeri", type: "one", o: ["Berminat", "Mungkin", "Tidak berminat"] }
          ]
        },
        {
          t: "C. Pengalaman dan keterampilan",
          qs: [
            { c: "K15", l: "Pengalaman praktik kerja lapangan (PKL/prakerin) atau magang", type: "one", o: ["Ya, sesuai jurusan", "Ya, tidak sesuai jurusan", "Belum pernah"] },
            { c: "K16", l: "Sektor tempat PKL atau magang", type: "one", o: [].concat(SEKTOR, ["Pemerintahan/ASN"]), show: function(a) { return a.K15 && a.K15 !== "Belum pernah"; } },
            { c: "K17", l: "Pengalaman bekerja paruh waktu atau membantu usaha keluarga", type: "one", o: ["Ya, dibayar", "Ya, tidak dibayar", "Tidak pernah"] },
            { c: "K18", l: "Kursus atau pelatihan di luar sekolah", note: "boleh lebih dari satu", type: "many", o: ["Komputer/digital", "Bahasa asing", "Keterampilan teknik", "Tata boga/tata busana/kecantikan", "Belum pernah"] },
            { c: "K19", l: "Memiliki sertifikat kompetensi (BNSP/LSP)", type: "one", o: ["Ya", "Sedang proses", "Tidak"] },
            { c: "K20", l: "Penilaian diri atas keterampilan", type: "scale", f: ["Teknis sesuai jurusan", "Digital", "Bahasa asing", "Komunikasi"] },
            { c: "K21", l: "Keterampilan yang paling ingin dipelajari", type: "text" }
          ]
        },
        {
          t: "D. Informasi dan dukungan",
          qs: [
            { c: "K22", l: "Sumber informasi lowongan kerja yang diketahui", note: "boleh lebih dari satu", type: "many", o: ["Media sosial", "Bursa Kerja Khusus (BKK) sekolah", "Guru BK", "Keluarga/kenalan", "Portal lowongan", "Disnaker/bursa kerja", "Belum tahu"] },
            { c: "K23", l: "Pengetahuan tentang layanan Disnaker (kartu AK/I, bursa kerja, pelatihan)", type: "one", o: ["Pernah memakai", "Pernah dengar, belum memakai", "Belum pernah dengar"] },
            { c: "K24", l: "Hambatan yang paling dikhawatirkan untuk mendapat pekerjaan", note: "boleh lebih dari satu", type: "many", o: ["Lowongan sedikit", "Keterampilan belum cukup", "Belum punya pengalaman", "Biaya kuliah/pelatihan", "Upah rendah", "Syarat umur/penampilan", "Lainnya"] },
            { c: "K25", l: "Dukungan yang paling dibutuhkan dari sekolah atau pemerintah daerah", note: "boleh lebih dari satu", type: "many", o: ["Informasi lowongan", "Pelatihan keterampilan", "Magang di perusahaan", "Beasiswa", "Modal usaha", "Bimbingan karier"] },
            { c: "K26", l: "Lapangan usaha pekerjaan utama orang tua atau wali", type: "one", o: [].concat(SEKTOR, ["Pemerintahan/ASN", "Tidak bekerja"]) }
          ]
        },
        {
          t: "E. Green job (pekerjaan ramah lingkungan)",
          def: HIJAU_DEF,
          qs: [
            { c: "K27", l: "Sebelum membaca penjelasan di atas, apakah kamu pernah mendengar istilah green job atau pekerjaan hijau?", type: "one", o: TAHU_HIJAU },
            { c: "K28", l: "Apakah kamu tertarik bekerja di bidang green job setelah lulus?", type: "one", o: MINAT_HIJAU },
            { c: "K29", l: "Bidang green job apa yang paling kamu minati?", note: "boleh lebih dari satu", type: "many", o: BIDANG_HIJAU, show: function(a) { return TERTARIK(a.K28); } }
          ]
        }
      ]
    },
    E: {
      name: "AHP pemangku kepentingan",
      label: "AHP Pemangku Kepentingan (C2)",
      blocks: [
        {
          t: "Identitas narasumber",
          hint: "Kuesioner ini meminta pendapat Bapak/Ibu tentang masalah ketenagakerjaan mana yang perlu ditangani lebih dulu di Banyuwangi. Bapak/Ibu cukup membandingkan dua hal setiap kali. Tidak ada jawaban benar atau salah. Perkiraan waktu 25–35 menit, didampingi petugas.",
          qs: [
            { c: "S1", l: "Kelompok narasumber", type: "one", o: ["Perencana dan pengelola program", "Penyedia pelatihan dan pendidikan", "Dunia usaha", "Pekerja/serikat pekerja", "Penempatan dan migrasi kerja"], req: 1 },
            { c: "S2", l: "Nama lembaga", type: "text", req: 1 },
            { c: "S3", l: "Jabatan narasumber", type: "text" },
            { c: "S5", l: "Bentuk kegiatan", type: "one", o: ["Wawancara mendalam", "FGD"] }
          ]
        },
        {
          t: "Bagian 1. Pertimbangan mana yang lebih penting?",
          hint: "Saat memilih masalah ketenagakerjaan yang harus ditangani lebih dulu, pertimbangan mana yang menurut Bapak/Ibu lebih penting? " + SAATY,
          matrix: { n: AHP_KRIT.length, prefix: "W", items: AHP_KRIT },
          qs: pairQs("W", AHP_KRIT)
        }
      ].concat(
        AHP_KRIT.map(function(k, ix) {
          return {
            t: "Bagian " + (ix + 2) + ". Dilihat dari: " + k,
            hint: 'Jika hanya dilihat dari sisi "' + k.toLowerCase() + '", masalah mana yang lebih penting untuk ditangani lebih dulu? ' + SAATY,
            matrix: { n: AHP_ISU.length, prefix: "X" + (ix + 1) + "_", items: AHP_ISU },
            qs: pairQs("X" + (ix + 1) + "_", AHP_ISU)
          };
        })
      )
    }
  };

  function qHTML(q, prefix) {
    prefix = prefix || '';
    var id = prefix + q.c;
    var rawId = q.c;
    var req = q.req ? '<span class="req" aria-hidden="true" style="color:#ef4444; margin-left:3px; font-weight:800;">*</span>' : '';
    var body = '';

    if (q.type === "text") {
      body = '<input type="text" id="' + id + '" name="' + rawId + '" class="rtkd-input" placeholder="Tuliskan jawaban Anda">';
    } else if (q.type === "area") {
      body = '<textarea id="' + id + '" name="' + rawId + '" class="rtkd-textarea" rows="3" placeholder="Tuliskan uraian Anda secara rinci"></textarea>';
    } else if (q.type === "num") {
      body = '<input type="number" min="0" inputmode="numeric" id="' + id + '" name="' + rawId + '" class="rtkd-input" style="max-width:200px" placeholder="0">';
    } else if (q.type === "date") {
      body = '<input type="date" id="' + id + '" name="' + rawId + '" class="rtkd-input" style="max-width:220px">';
    } else if (q.type === "kec") {
      var kecOpts = KEC.map(function(k) { return '<option value="' + k + '">' + k + '</option>'; }).join("");
      body = '<select id="' + id + '" name="' + rawId + '" class="rtkd-select"><option value="">-- Pilih Kecamatan di Banyuwangi --</option>' + kecOpts + '</select>';
    } else if (q.type === "one" || q.type === "many") {
      var t = q.type === "one" ? "radio" : "checkbox";
      var options = Array.isArray(q.o) ? q.o : [];
      var optsHtml = options.map(function(o, i) {
        var optId = id + '_' + i;
        return '<label class="rtkd-opt" for="' + optId + '">' +
                 '<input type="' + t + '" id="' + optId + '" name="' + rawId + (t === "checkbox" ? "[]" : "") + '" value="' + esc(o) + '">' +
                 '<span>' + esc(o) + '</span>' +
               '</label>';
      }).join("");
      body = '<div class="rtkd-opts" role="' + (t === "radio" ? "radiogroup" : "group") + '">' + optsHtml + '</div>';
    } else if (q.type === "grid") {
      var fields = Array.isArray(q.f) ? q.f : (Array.isArray(q.o) ? q.o : []);
      var gridHtml = fields.map(function(f, i) {
        var fieldId = id + '_' + i;
        return '<label class="rtkd-grid-field" for="' + fieldId + '">' +
                 '<span class="rtkd-grid-lbl">' + esc(f) + '</span>' +
                 '<input type="number" min="0" inputmode="numeric" id="' + fieldId + '" name="' + rawId + '[' + esc(f) + ']" data-field="' + esc(f) + '" class="rtkd-input" placeholder="0">' +
               '</label>';
      }).join("");
      body = '<div class="rtkd-grid">' + gridHtml + '</div>';
    } else if (q.type === "scale") {
      var scaleFields = Array.isArray(q.f) && q.f.length > 0 ? q.f : [q.l || 'Skala Penilaian'];
      var isSingle = (scaleFields.length === 1 && scaleFields[0] === (q.l || 'Skala Penilaian'));
      var scaleRows = scaleFields.map(function(f, i) {
        var ptsHtml = [1, 2, 3, 4, 5].map(function(n) {
          var ptId = id + '_' + i + '_' + n;
          return '<label for="' + ptId + '" class="rtkd-pt-lbl">' +
                   '<input type="radio" id="' + ptId + '" name="' + rawId + (isSingle ? '' : '[' + esc(f) + ']') + '" value="' + n + '" data-field="' + esc(f) + '" data-q="' + rawId + '">' +
                   n +
                 '</label>';
        }).join("");
        return '<div class="rtkd-scale-row">' +
                 (isSingle ? '' : '<span class="rtkd-scale-title">' + esc(f) + '</span>') +
                 '<div class="rtkd-scale-pts" role="radiogroup" aria-label="' + esc(f) + '">' + ptsHtml + '</div>' +
               '</div>';
      }).join("");
      body = '<div class="rtkd-scale"><div class="rtkd-scale-key">' + SCALE_NOTE + '</div>' + scaleRows + '</div>';
    } else if (q.type === "pair") {
      var ptsList = [9, 8, 7, 6, 5, 4, 3, 2, 1, 2, 3, 4, 5, 6, 7, 8, 9];
      var pairOptsHtml = ptsList.map(function(v, k) {
        var val = k < 8 ? String(v) : k === 8 ? "1" : "1/" + v;
        var side = k < 8 ? "l" : k === 8 ? "m" : "r";
        var tip = k < 8 ? (q.left + ' ' + v + ' kali lebih penting') : k === 8 ? 'Sama penting' : (q.right + ' ' + v + ' kali lebih penting');
        var optId = id + '_' + k;
        return '<label class="rtkd-pair-pt ' + side + '" for="' + optId + '" title="' + esc(tip) + '">' +
                 '<input type="radio" id="' + optId + '" name="' + rawId + '" value="' + val + '">' +
                 '<span>' + v + '</span>' +
               '</label>';
      }).join("");

      body = '<div class="rtkd-pair">' +
               '<div class="rtkd-pair-l">' + esc(q.left) + '</div>' +
               '<div class="rtkd-pair-pts" role="radiogroup" aria-label="' + esc(q.left) + ' dibandingkan dengan ' + esc(q.right) + '">' +
                 pairOptsHtml +
               '</div>' +
               '<div class="rtkd-pair-r">' + esc(q.right) + '</div>' +
             '</div>';
    }

    var whyHtml = hasWhy(q)
      ? '<label class="rtkd-why" for="' + id + '__why">Alasan <span>(opsional)</span><textarea id="' + id + '__why" name="' + rawId + '_alasan" class="rtkd-textarea" rows="2" placeholder="Tuliskan ulasan atau alasan pilihan Anda jika ada"></textarea></label>'
      : '';

    var head = q.type === "pair" ? "" : (
      '<div class="rtkd-q-header">' +
        '<span class="rtkd-code">' + esc(q.c) + '</span>' +
        '<div class="rtkd-ql">' + esc(q.l) + req + (q.note ? '<small>' + esc(q.note) + '</small>' : '') + '</div>' +
      '</div>'
    );

    return '<div class="rtkd-q' + (q.type === 'pair' ? ' rtkd-q-pair' : '') + '" id="wrap-' + id + '">' +
             head +
             '<div class="rtkd-qbody">' +
               body +
               whyHtml +
             '</div>' +
           '</div>';
  }

  // Engine instance manager
  window.RTKDEngine = {
    SCHEMA: SCHEMA,
    KEC: KEC,
    SEKTOR: SEKTOR,
    BEKERJA: BEKERJA,
    AHP_KRIT: AHP_KRIT,
    AHP_ISU: AHP_ISU,
    buildM: buildM,
    ahp: ahp,
    aggAHP: aggAHP,
    parseR: parseR,
    fmt: fmt,
    currentTab: 'A',

    render: function(sheetId, instrumentKey, prefix) {
      prefix = prefix || '';
      var s = SCHEMA[instrumentKey] || SCHEMA['A'];
      this.currentTab = instrumentKey;

      var sheetElem = document.getElementById(sheetId);
      if (!sheetElem) return;

      var html = s.blocks.map(function(b) {
        var defHtml = b.def ? '<div class="rtkd-defbox"><strong><i class="fa-solid fa-leaf" style="color:#10b981; margin-right:6px;"></i> Apa itu green job?</strong> ' + esc(b.def) + '</div>' : '';
        var pairLegend = b.matrix ? '<div class="rtkd-pair-legend" aria-hidden="true"><div class="rtkd-lg-inner"><span>&larr; Kiri Lebih Penting</span><span>Sama Penting</span><span>Kanan Lebih Penting &rarr;</span></div></div>' : '';
        var crBoxHtml = b.matrix ? '<div class="rtkd-crbox" id="' + prefix + 'cr-' + b.matrix.prefix + '" aria-live="polite"></div>' : '';

        return '<div class="rtkd-blk">' +
                 '<h2><i class="fa-solid fa-layer-group" style="font-size: 14px; margin-right: 8px;"></i> ' + esc(b.t) + '</h2>' +
                 (b.hint ? '<p class="hint">' + esc(b.hint) + '</p>' : '') +
                 defHtml +
                 pairLegend +
                 b.qs.map(function(q) { return qHTML(q, prefix); }).join("") +
                 crBoxHtml +
               '</div>';
      }).join("");

      sheetElem.innerHTML = html;

      // Update consent text
      var consentText = (instrumentKey === "C" || instrumentKey === "E")
        ? "Narasumber sudah menerima penjelasan tujuan wawancara dan menyetujui pencatatan pokok jawaban untuk penyusunan RTKD."
        : instrumentKey === "D"
        ? "Sekolah sudah memberi izin, siswa sudah menerima penjelasan tujuan survei dan bersedia mengisi, serta mengetahui bahwa jawaban tidak memuat nama dan hanya disajikan secara agregat."
        : "Responden sudah menerima penjelasan tujuan survei, menyetujui pengisian, dan mengetahui bahwa jawaban hanya disajikan secara agregat.";

      var consentSpan = document.getElementById(prefix + 'consentText') || document.getElementById('dashConsentText') || document.getElementById('rtkdConsentText') || document.getElementById('modalConsentText');
      if (consentSpan) consentSpan.textContent = consentText;

      this.applyShow(sheetId, instrumentKey, prefix);
      if (instrumentKey === "E") {
        this.updateCR(sheetId, instrumentKey, prefix);
      }
    },

    allQs: function(instrumentKey) {
      var s = SCHEMA[instrumentKey] || SCHEMA['A'];
      var list = [];
      s.blocks.forEach(function(b) {
        b.qs.forEach(function(q) {
          list.push(q);
        });
      });
      return list;
    },

    collect: function(formOrContainerId, instrumentKey, prefix) {
      prefix = prefix || '';
      var formElem = document.getElementById(formOrContainerId);
      if (!formElem) return {};

      var qs = this.allQs(instrumentKey);
      var answers = {};

      qs.forEach(function(q) {
        var rawId = q.c;
        var fullId = prefix + rawId;

        if (["text", "area", "num", "date", "kec"].indexOf(q.type) !== -1) {
          var el = formElem.querySelector("#" + fullId);
          if (el) {
            var val = el.value.trim();
            if (val !== "") answers[rawId] = (q.type === "num" ? Number(val) : val);
          }
        } else if (q.type === "one" || q.type === "pair") {
          var elRadio = formElem.querySelector('input[name="' + rawId + '"]:checked');
          if (elRadio) answers[rawId] = elRadio.value;
        } else if (q.type === "many") {
          var checkedBoxes = formElem.querySelectorAll('input[name="' + rawId + '[]"]:checked');
          if (!checkedBoxes.length) checkedBoxes = formElem.querySelectorAll('input[name="' + rawId + '"]:checked');
          var vals = [];
          checkedBoxes.forEach(function(cb) { vals.push(cb.value); });
          if (vals.length) answers[rawId] = vals;
        } else if (q.type === "grid") {
          var gridInputs = formElem.querySelectorAll('input[name^="' + rawId + '"]');
          var gridObj = {};
          gridInputs.forEach(function(inp) {
            if (inp.value !== "") {
              var fName = inp.getAttribute('data-field') || inp.name.replace(/.*\[(.*)\]/, '$1');
              gridObj[fName] = Number(inp.value);
            }
          });
          if (Object.keys(gridObj).length) answers[rawId] = gridObj;
        } else if (q.type === "scale") {
          var scaleInputs = formElem.querySelectorAll('input[data-q="' + rawId + '"]:checked');
          var scaleObj = {};
          scaleInputs.forEach(function(inp) {
            var fName = inp.getAttribute('data-field');
            scaleObj[fName] = Number(inp.value);
          });
          if (Object.keys(scaleObj).length) answers[rawId] = scaleObj;
        }

        // Reason field
        if (hasWhy(q)) {
          var whyEl = formElem.querySelector("#" + fullId + "__why");
          if (whyEl) {
            var wVal = whyEl.value.trim();
            if (wVal) answers[rawId + "_alasan"] = wVal;
          }
        }
      });

      return answers;
    },

    fill: function(formOrContainerId, instrumentKey, a, prefix) {
      prefix = prefix || '';
      var formElem = document.getElementById(formOrContainerId);
      if (!formElem || !a) return;

      var qs = this.allQs(instrumentKey);
      qs.forEach(function(q) {
        var rawId = q.c;
        var fullId = prefix + rawId;
        var v = a[rawId];

        if (hasWhy(q) && a[rawId + "_alasan"] != null) {
          var whyEl = formElem.querySelector("#" + fullId + "__why");
          if (whyEl) whyEl.value = a[rawId + "_alasan"];
        }

        if (v == null) return;

        if (["text", "area", "num", "date", "kec"].indexOf(q.type) !== -1) {
          var el = formElem.querySelector("#" + fullId);
          if (el) el.value = v;
        } else if (q.type === "one" || q.type === "pair") {
          var radios = formElem.querySelectorAll('input[name="' + rawId + '"]');
          radios.forEach(function(e) { e.checked = (e.value === String(v)); });
        } else if (q.type === "many" && Array.isArray(v)) {
          var checks = formElem.querySelectorAll('input[name="' + rawId + '[]"], input[name="' + rawId + '"]');
          checks.forEach(function(e) { e.checked = (v.indexOf(e.value) !== -1); });
        } else if (q.type === "grid" && typeof v === "object") {
          var gridInps = formElem.querySelectorAll('input[name^="' + rawId + '"]');
          gridInps.forEach(function(e) {
            var f = e.getAttribute('data-field');
            if (v[f] != null) e.value = v[f];
          });
        } else if (q.type === "scale" && typeof v === "object") {
          var scaleInps = formElem.querySelectorAll('input[data-q="' + rawId + '"]');
          scaleInps.forEach(function(e) {
            var f = e.getAttribute('data-field');
            e.checked = (v[f] === Number(e.value));
          });
        }
      });

      this.applyShow(formOrContainerId, instrumentKey, prefix);
    },

    applyShow: function(sheetId, instrumentKey, prefix) {
      prefix = prefix || '';
      var formElem = document.getElementById(sheetId) ? document.getElementById(sheetId).closest('form') || document.getElementById(sheetId) : null;
      if (!formElem) return;

      var a = this.collect(formElem.id || sheetId, instrumentKey, prefix);
      var qs = this.allQs(instrumentKey);

      qs.forEach(function(q) {
        if (q.show) {
          var wrap = document.getElementById('wrap-' + prefix + q.c);
          if (wrap) {
            var isVisible = q.show(a);
            if (isVisible) {
              wrap.classList.remove('hide-q');
            } else {
              wrap.classList.add('hide-q');
            }
          }
        }
      });
    },

    updateCR: function(sheetId, instrumentKey, prefix) {
      prefix = prefix || '';
      var s = SCHEMA[instrumentKey];
      if (!s) return [];

      var formElem = document.getElementById(sheetId) ? document.getElementById(sheetId).closest('form') || document.getElementById(sheetId) : null;
      if (!formElem) return [];

      var a = this.collect(formElem.id || sheetId, instrumentKey, prefix);
      var bad = [];

      s.blocks.forEach(function(b) {
        if (!b.matrix) return;
        var el = document.getElementById(prefix + "cr-" + b.matrix.prefix);
        if (!el) return;

        var M = buildM(a, b.matrix.prefix, b.matrix.n);
        if (!M) {
          var done = b.qs.filter(function(q) { return a[q.c] != null; }).length;
          el.className = "rtkd-crbox";
          el.innerHTML = '<i class="fa-solid fa-circle-info" style="color:#0284c7; margin-right:6px;"></i> Sudah dijawab ' + done + ' dari ' + b.qs.length + ' pasangan. Pemeriksaan kecocokan jawaban muncul otomatis setelah semua pasangan di bagian ini dijawab.';
          return;
        }

        var r = ahp(M);
        var ok = (r.CR <= 0.1);
        if (!ok) bad.push(b.t.split(".")[0]);

        var urut = b.matrix.items.map(function(x, i) {
          return [x, r.w[i]];
        }).sort(function(p, q) {
          return q[1] - p[1];
        }).map(function(p, i) {
          return (i + 1) + '. ' + p[0] + ' (' + fmt(p[1] * 100, 0) + '%)';
        }).join(" &nbsp;&bull;&nbsp; ");

        el.className = "rtkd-crbox " + (ok ? "ok" : "bad");
        el.innerHTML = ok
          ? '<i class="fa-solid fa-circle-check" style="color:#059669; margin-right:6px;"></i> <strong>Jawaban di bagian ini sudah konsisten</strong> (CR ' + fmt(r.CR, 2) + '). <br><small>Urutan prioritas: ' + urut + '</small>'
          : '<i class="fa-solid fa-triangle-exclamation" style="color:#dc2626; margin-right:6px;"></i> <strong>Jawaban di bagian ini masih ada yang bertentangan</strong> (CR ' + fmt(r.CR, 2) + ', batas konsistensi 0,10). Coba cek kembali perbandingan. <br><small>Urutan sementara: ' + urut + '</small>';
      });

      return bad;
    }
  };

})(window, typeof jQuery !== 'undefined' ? jQuery : (typeof window.$ !== 'undefined' ? window.$ : null));
