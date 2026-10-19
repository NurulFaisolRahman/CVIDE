/**
 * survei_rtkd_engine.js
 * Engine Form Survei Ketenagakerjaan Banyuwangi (RTKD) 2026
 * Mendukung 4 Instrumen Dinamis:
 *   A - Perusahaan / Pemberi Kerja
 *   B - Pencari Kerja & Lulusan
 *   C - Pemangku Kepentingan
 *   D - Siswa Kelas 12
 */

(function(window, $) {
  'use strict';

  var KEC = ["Banyuwangi","Blimbingsari","Bangorejo","Cluring","Gambiran","Genteng","Giri","Glagah","Glenmore","Kabat","Kalibaru","Kalipuro","Licin","Muncar","Pesanggaran","Purwoharjo","Rogojampi","Sempu","Siliragung","Singojuruh","Songgon","Srono","Tegaldlimo","Tegalsari","Wongsorejo"];
  var SEKTOR = ["Pertanian/perikanan","Industri pengolahan","Perdagangan","Akomodasi dan makan-minum","Konstruksi","Transportasi/pergudangan","Jasa pendidikan/kesehatan","Jasa lainnya"];
  var BEKERJA = ["Bekerja sebagai karyawan/buruh","Berusaha sendiri","Pekerja lepas","Membantu usaha keluarga"];
  var SCALE_NOTE = "1 = sangat kurang · 5 = sangat baik";
  var IDENTITAS = new Set(["P1","P2","P3","P4","P5","L1","L2","L3","L4","L5","L6","K1","K2","K3","K4","K5","K6","K7"]);

  function hasWhy(q) {
    return ["one","many","scale"].includes(q.type) && !IDENTITAS.has(q.c) && /^[PLK]\d/.test(q.c);
  }

  function esc(s) {
    return String(s != null ? s : '').replace(/[&<>"]/g, function(c) {
      return {"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;"}[c];
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
            {c:"SR",l:"Sumber responden",type:"one",o:["Daftar wajib lapor Disnaker (sampel acak)","Ditemui di lapangan (sampel kuota)"],req:1},
            {c:"SR2",l:"Nama lokasi pengambilan",note:"misalnya nama pasar atau kawasan usaha",type:"text",show:function(a){return a.SR==="Ditemui di lapangan (sampel kuota)";}}
          ]
        },
        {
          t: "A. Identitas usaha",
          qs: [
            {c:"P1",l:"Nama usaha",note:"opsional",type:"text"},
            {c:"P2",l:"Kecamatan lokasi usaha",type:"kec",req:1},
            {c:"P3",l:"Sektor utama usaha",type:"one",o:SEKTOR,req:1},
            {c:"P4",l:"Jumlah seluruh pekerja",type:"one",o:["1–4","5–19","20–99","100 ke atas"],req:1},
            {c:"P5",l:"Bentuk usaha",type:"one",o:["Perorangan tidak berbadan hukum","CV/firma","PT","Koperasi","BUMN/BUMD"]}
          ]
        },
        {
          t: "B. Tenaga kerja saat ini",
          qs: [
            {c:"P6",l:"Jumlah pekerja menurut jenis kelamin",type:"grid",f:["Laki-laki","Perempuan"]},
            {c:"P7",l:"Jumlah pekerja menurut status",type:"grid",f:["Tetap","Kontrak","Harian lepas"]},
            {c:"P8",l:"Jumlah pekerja menurut pendidikan",type:"grid",f:["SD ke bawah","SMP","SMA","SMK","Diploma","S1 ke atas"]},
            {c:"P9",l:"Jumlah pekerja yang berasal dari luar Banyuwangi",type:"num"}
          ]
        },
        {
          t: "C. Rekrutmen 12 bulan terakhir",
          qs: [
            {c:"P10",l:"Jumlah pekerja baru yang direkrut",type:"num"},
            {c:"P11",l:"Saluran rekrutmen yang dipakai",note:"boleh lebih dari satu",type:"many",o:["Kenalan/keluarga","Media sosial","Disnaker/bursa kerja","Sekolah/kampus","Portal lowongan","Agen penyalur"]},
            {c:"P12",l:"Adakah lowongan yang sulit diisi?",type:"one",o:["Ya","Tidak"]},
            {c:"P13",l:"Jabatan yang sulit diisi",type:"text",show:function(a){return a.P12==="Ya";}},
            {c:"P14",l:"Alasan utama sulit diisi",type:"one",o:["Pelamar kurang","Keterampilan tidak sesuai","Pengalaman kurang","Upah yang diharapkan terlalu tinggi","Lokasi jauh","Lainnya"],show:function(a){return a.P12==="Ya";}}
          ]
        },
        {
          t: "D. Kebutuhan tenaga kerja tiga tahun ke depan",
          qs: [
            {c:"P15",l:"Rencana jumlah pekerja",type:"one",o:["Bertambah","Tetap","Berkurang"]},
            {c:"P16",l:"Perkiraan tambahan pekerja",type:"num",show:function(a){return a.P15==="Bertambah";}},
            {c:"P17",l:"Jabatan dan pendidikan yang paling dibutuhkan",note:"jabatan, pendidikan minimal, jumlah",type:"area"},
            {c:"P18",l:"Faktor yang paling memengaruhi rencana tersebut",type:"one",o:["Permintaan pasar","Investasi/perluasan","Otomasi/digitalisasi","Biaya tenaga kerja","Lainnya"]}
          ]
        },
        {
          t: "E. Keterampilan dan pelatihan",
          qs: [
            {c:"P19",l:"Penilaian keterampilan lulusan lokal",type:"scale",f:["Teknis sesuai bidang","Digital","Bahasa asing","Komunikasi","Kerja sama tim","Disiplin/etos kerja"]},
            {c:"P20",l:"Keterampilan yang paling kurang dari pelamar",type:"text"},
            {c:"P21",l:"Apakah usaha memberi pelatihan kepada pekerja?",type:"one",o:["Ya, rutin","Kadang-kadang","Tidak"]},
            {c:"P22",l:"Kerja sama dengan SMK, BLK, atau kampus",note:"boleh lebih dari satu",type:"many",o:["Magang/prakerin","Rekrutmen lulusan","Penyusunan kurikulum","Belum ada"]},
            {c:"P23",l:"Pekerja yang memiliki sertifikat kompetensi (BNSP)",type:"one",o:["Sebagian besar","Sebagian kecil","Tidak ada","Tidak tahu"]}
          ]
        },
        {
          t: "F. Upah, jaminan sosial, dan hubungan kerja",
          qs: [
            {c:"P24",l:"Upah pekerja pemula dibandingkan UMK",type:"one",o:["Di bawah UMK","Setara UMK","Di atas UMK"]},
            {c:"P25",l:"Kepesertaan BPJS Ketenagakerjaan",type:"one",o:["Semua pekerja","Sebagian","Tidak ada"]},
            {c:"P26",l:"Kepesertaan BPJS Kesehatan dari pemberi kerja",type:"one",o:["Semua pekerja","Sebagian","Tidak ada"]},
            {c:"P27",l:"Dokumen hubungan kerja yang dimiliki",note:"boleh lebih dari satu",type:"many",o:["Kontrak tertulis","Peraturan perusahaan","PKB","LKS Bipartit","Belum ada"]},
            {c:"P28",l:"Kecelakaan kerja dalam 12 bulan terakhir",type:"one",o:["Tidak ada","1–2 kejadian","3 atau lebih"]}
          ]
        },
        {
          t: "G. Kendala dan harapan",
          qs: [
            {c:"P29",l:"Kendala utama terkait tenaga kerja",type:"area"},
            {c:"P30",l:"Dukungan yang diharapkan dari pemerintah daerah",note:"boleh lebih dari satu",type:"many",o:["Pelatihan sesuai kebutuhan","Informasi pasar kerja","Insentif perekrutan","Sertifikasi","Lainnya"]}
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
            {c:"SR",l:"Sumber responden",type:"one",o:["Daftar pencari kerja Disnaker (AK/I)","Daftar alumni BKK SMK atau tracer study kampus","Lapangan: cafe, rumah makan, atau toko","Lapangan: pasar, terminal, atau tempat umum","Lapangan: kunjungan rumah tangga di desa","Bursa kerja atau job fair","Lainnya"],req:1},
            {c:"SR2",l:"Nama lokasi pengambilan",note:"misalnya nama cafe, pasar, atau desa",type:"text",show:function(a){return !!a.SR && (a.SR.indexOf("Lapangan") === 0 || a.SR === "Bursa kerja atau job fair" || a.SR === "Lainnya");}},
            {c:"SC",l:"Penyaring: responden berusia 15 tahun ke atas dan…",note:"boleh lebih dari satu",type:"many",o:["Bekerja paling sedikit 1 jam dalam seminggu terakhir","Sedang mencari kerja atau menyiapkan usaha","Lulus SMA, SMK, diploma, atau sarjana dalam 3 tahun terakhir","Tidak satu pun"],req:1}
          ]
        },
        {
          t: "A. Profil responden",
          qs: [
            {c:"L1",l:"Umur",type:"one",o:["15–19","20–24","25–29","30–39","40 ke atas"],req:1},
            {c:"L2",l:"Jenis kelamin",type:"one",o:["Laki-laki","Perempuan"],req:1},
            {c:"L3",l:"Kecamatan tempat tinggal",type:"kec",req:1},
            {c:"L4",l:"Pendidikan terakhir",type:"one",o:["SD/SMP","SMA","SMK","Diploma","S1 ke atas"],req:1},
            {c:"L5",l:"Jurusan/bidang studi",type:"text"},
            {c:"L6",l:"Tahun lulus",type:"num"}
          ]
        },
        {
          t: "B. Status kegiatan saat ini",
          qs: [
            {c:"L7",l:"Kegiatan utama saat ini",type:"one",o:[].concat(BEKERJA, ["Mencari kerja","Melanjutkan sekolah/kuliah","Mengurus rumah tangga"]),req:1},
            {c:"L8",l:"Apakah sedang mencari pekerjaan (baru atau tambahan)?",type:"one",o:["Ya","Tidak"]}
          ]
        },
        {
          t: "C. Pengalaman mencari kerja",
          qs: [
            {c:"L9",l:"Lama mencari kerja",note:"sejak lulus atau sejak mulai mencari",type:"one",o:["Kurang dari 3 bulan","3–6 bulan","6–12 bulan","Lebih dari 12 bulan"]},
            {c:"L10",l:"Jumlah lamaran yang dikirim",type:"one",o:["0","1–5","6–20","Lebih dari 20"]},
            {c:"L11",l:"Cara mencari kerja",note:"boleh lebih dari satu",type:"many",o:["Kenalan/keluarga","Media sosial","Portal lowongan","Disnaker/bursa kerja","Sekolah/kampus","Melamar langsung"]},
            {c:"L12",l:"Terdaftar sebagai pencari kerja di Disnaker (kartu AK/I)?",type:"one",o:["Ya","Tidak","Tidak tahu caranya"]},
            {c:"L13",l:"Kendala utama mendapat pekerjaan",note:"boleh lebih dari satu",type:"many",o:["Lowongan sedikit","Keterampilan belum sesuai","Kurang pengalaman","Upah rendah","Lokasi jauh","Syarat umur/penampilan","Lainnya"]}
          ]
        },
        {
          t: "D. Pekerjaan saat ini",
          hint: "Diisi hanya oleh responden yang bekerja atau berusaha (L7).",
          qs: [
            {c:"L14",l:"Sektor pekerjaan",type:"one",o:SEKTOR,show:function(a){return BEKERJA.indexOf(a.L7)!==-1;}},
            {c:"L15",l:"Kesesuaian pekerjaan dengan pendidikan",type:"one",o:["Sesuai","Kurang sesuai","Tidak sesuai"],show:function(a){return BEKERJA.indexOf(a.L7)!==-1;}},
            {c:"L16",l:"Pendapatan bersih per bulan",type:"one",o:["Kurang dari Rp1 juta","Rp1–2 juta","Rp2–3 juta","Rp3–5 juta","Lebih dari Rp5 juta"],show:function(a){return BEKERJA.indexOf(a.L7)!==-1;}},
            {c:"L17",l:"Jam kerja per minggu",type:"one",o:["Kurang dari 15","15–34","35–48","Lebih dari 48"],show:function(a){return BEKERJA.indexOf(a.L7)!==-1;}},
            {c:"L18",l:"Memiliki kontrak kerja tertulis",type:"one",o:["Ya","Tidak","Tidak berlaku (usaha sendiri)"],show:function(a){return BEKERJA.indexOf(a.L7)!==-1;}},
            {c:"L19",l:"Terdaftar BPJS Ketenagakerjaan",type:"one",o:["Ya","Tidak","Tidak tahu"],show:function(a){return BEKERJA.indexOf(a.L7)!==-1;}},
            {c:"L20",l:"Lokasi kerja",type:"one",o:["Di Banyuwangi","Di luar Banyuwangi","Di luar negeri"],show:function(a){return BEKERJA.indexOf(a.L7)!==-1;}}
          ]
        },
        {
          t: "E. Keterampilan dan pelatihan",
          qs: [
            {c:"L21",l:"Pelatihan yang pernah diikuti",note:"boleh lebih dari satu",type:"many",o:["BLK","Kartu Prakerja","Lembaga kursus swasta","Pelatihan dari perusahaan","Belum pernah"]},
            {c:"L22",l:"Memiliki sertifikat kompetensi (BNSP)",type:"one",o:["Ya","Tidak"]},
            {c:"L23",l:"Penilaian diri atas keterampilan",type:"scale",f:["Teknis","Digital","Bahasa asing","Komunikasi"]},
            {c:"L24",l:"Pelatihan yang paling diinginkan",type:"text"}
          ]
        },
        {
          t: "F. Harapan dan rencana",
          qs: [
            {c:"L25",l:"Rata-rata pengeluaran pribadi per bulan",note:"makan, transportasi, pulsa, dan kebutuhan lain",type:"one",o:["Kurang dari Rp1 juta","Rp1–2 juta","Rp2–3 juta","Rp3–5 juta","Lebih dari Rp5 juta"]},
            {c:"L26",l:"Sektor yang paling diminati",type:"one",o:[].concat(SEKTOR, ["Pemerintahan/ASN"])},
            {c:"L27",l:"Kesediaan bekerja di luar Banyuwangi",type:"one",o:["Ya, dalam negeri","Ya, termasuk luar negeri","Tidak"]},
            {c:"L28",l:"Minat membuka usaha sendiri",type:"one",o:["Sudah berusaha","Berminat","Tidak berminat"]},
            {c:"L29",l:"Kendala utama memulai usaha",type:"one",o:["Modal","Keterampilan","Pasar","Perizinan","Lainnya"]}
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
            {c:"S1",l:"Kelompok narasumber",type:"one",o:["Perencana dan pengelola program","Penyedia pelatihan dan pendidikan","Dunia usaha","Pekerja/serikat pekerja","Penempatan dan migrasi kerja"],req:1},
            {c:"S2",l:"Nama lembaga",type:"text",req:1},
            {c:"S3",l:"Jabatan narasumber",type:"text"},
            {c:"S4",l:"Tanggal wawancara",type:"date"},
            {c:"S5",l:"Bentuk kegiatan",type:"one",o:["Wawancara mendalam","FGD"]}
          ]
        },
        {
          t: "Pokok jawaban per tema",
          hint: "Isi tema yang relevan dengan peran narasumber saja.",
          qs: [
            {c:"T1",l:"Kondisi pasar kerja",note:"perubahan terbesar, sektor tumbuh/menurun, dampak investasi dan pariwisata",type:"area"},
            {c:"T2",l:"Kesesuaian keterampilan",note:"jabatan sulit diisi, keselarasan kurikulum SMK/kampus/BLK",type:"area"},
            {c:"T3",l:"Program dan layanan ketenagakerjaan",note:"program yang berjalan, hambatan, koordinasi, sistem informasi pasar kerja",type:"area"},
            {c:"T4",l:"Pengupahan dan hubungan industrial",note:"kepatuhan UMK dan jaminan sosial, perselisihan yang sering muncul",type:"area"},
            {c:"T5",l:"Pekerja rentan dan informal",note:"pekerja informal, perempuan, penyandang disabilitas, pekerja migran",type:"area"},
            {c:"T6",l:"Usulan kebijakan dan program prioritas",type:"area"}
          ]
        },
        {
          t: "Tiga isu terpenting menurut narasumber",
          qs: [
            {c:"I1",l:"Isu pertama",type:"text"},
            {c:"I2",l:"Isu kedua",type:"text"},
            {c:"I3",l:"Isu ketiga",type:"text"}
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
            {c:"K1",l:"Jenis sekolah",type:"one",o:["SMA","SMK","MA"],req:1},
            {c:"K2",l:"Nama sekolah",type:"text",req:1},
            {c:"K3",l:"Kecamatan lokasi sekolah",type:"kec",req:1},
            {c:"K4",l:"Jurusan atau kompetensi keahlian",type:"text"},
            {c:"K5",l:"Umur",type:"one",o:["16 tahun atau kurang","17 tahun","18 tahun","19 tahun atau lebih"],req:1},
            {c:"K6",l:"Jenis kelamin",type:"one",o:["Laki-laki","Perempuan"],req:1},
            {c:"K7",l:"Kecamatan tempat tinggal",type:"kec"}
          ]
        },
        {
          t: "B. Rencana setelah lulus",
          qs: [
            {c:"K8",l:"Rencana utama setelah lulus",type:"one",o:["Bekerja","Kuliah","Kuliah sambil bekerja","Berwirausaha","Kursus/pelatihan dulu","Bekerja di luar negeri","Belum tahu"],req:1},
            {c:"K9",l:"Jika bekerja, lokasi kerja yang diinginkan",type:"one",o:["Di Banyuwangi","Di luar Banyuwangi, masih di Jawa Timur","Di luar Jawa Timur","Di luar negeri"]},
            {c:"K10",l:"Sektor pekerjaan yang paling diminati",type:"one",o:[].concat(SEKTOR, ["Pemerintahan/ASN"])},
            {c:"K11",l:"Pekerjaan atau jabatan yang dicita-citakan",type:"text"},
            {c:"K12",l:"Upah minimal per bulan yang bersedia diterima pada pekerjaan pertama",type:"one",o:["Kurang dari Rp2 juta","Rp2–3 juta","Rp3–4 juta","Lebih dari Rp4 juta"]},
            {c:"K13",l:"Keyakinan mendapat pekerjaan dalam 6 bulan setelah lulus",type:"one",o:["Sangat yakin","Yakin","Ragu-ragu","Tidak yakin"]},
            {c:"K14",l:"Minat bekerja sebagai pekerja migran di luar negeri",type:"one",o:["Berminat","Mungkin","Tidak berminat"]}
          ]
        },
        {
          t: "C. Pengalaman dan keterampilan",
          qs: [
            {c:"K15",l:"Pengalaman praktik kerja lapangan (PKL/prakerin) atau magang",type:"one",o:["Ya, sesuai jurusan","Ya, tidak sesuai jurusan","Belum pernah"]},
            {c:"K16",l:"Sektor tempat PKL atau magang",type:"one",o:[].concat(SEKTOR, ["Pemerintahan/ASN"]),show:function(a){return a.K15 && a.K15 !== "Belum pernah";}},
            {c:"K17",l:"Pengalaman bekerja paruh waktu atau membantu usaha keluarga",type:"one",o:["Ya, dibayar","Ya, tidak dibayar","Tidak pernah"]},
            {c:"K18",l:"Kursus atau pelatihan di luar sekolah",note:"boleh lebih dari satu",type:"many",o:["Komputer/digital","Bahasa asing","Keterampilan teknik","Tata boga/tata busana/kecantikan","Belum pernah"]},
            {c:"K19",l:"Memiliki sertifikat kompetensi (BNSP/LSP)",type:"one",o:["Ya","Sedang proses","Tidak"]},
            {c:"K20",l:"Penilaian diri atas keterampilan",type:"scale",f:["Teknis sesuai jurusan","Digital","Bahasa asing","Komunikasi"]},
            {c:"K21",l:"Keterampilan yang paling ingin dipelajari",type:"text"}
          ]
        },
        {
          t: "D. Informasi dan dukungan",
          qs: [
            {c:"K22",l:"Sumber informasi lowongan kerja yang diketahui",note:"boleh lebih dari satu",type:"many",o:["Media sosial","Bursa Kerja Khusus (BKK) sekolah","Guru BK","Keluarga/kenalan","Portal lowongan","Disnaker/bursa kerja","Belum tahu"]},
            {c:"K23",l:"Pengetahuan tentang layanan Disnaker (kartu AK/I, bursa kerja, pelatihan)",type:"one",o:["Pernah memakai","Pernah dengar, belum memakai","Belum pernah dengar"]},
            {c:"K24",l:"Hambatan yang paling dikhawatirkan untuk mendapat pekerjaan",note:"boleh lebih dari satu",type:"many",o:["Lowongan sedikit","Keterampilan belum cukup","Belum punya pengalaman","Biaya kuliah/pelatihan","Upah rendah","Syarat umur/penampilan","Lainnya"]},
            {c:"K25",l:"Dukungan yang paling dibutuhkan dari sekolah atau pemerintah daerah",note:"boleh lebih dari satu",type:"many",o:["Informasi lowongan","Pelatihan keterampilan","Magang di perusahaan","Beasiswa","Modal usaha","Bimbingan karier"]},
            {c:"K26",l:"Lapangan usaha pekerjaan utama orang tua atau wali",type:"one",o:[].concat(SEKTOR, ["Pemerintahan/ASN","Tidak bekerja"])}
          ]
        }
      ]
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
                 '<input type="' + t + '" id="' + optId + '" name="' + rawId + (t==="checkbox"?"[]":"") + '" value="' + esc(o) + '">' +
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
    }

    var whyHtml = hasWhy(q)
      ? '<label class="rtkd-why" for="' + id + '__why">Alasan <span>(opsional)</span><textarea id="' + id + '__why" name="' + rawId + '_alasan" class="rtkd-textarea" rows="2" placeholder="Tuliskan ulasan atau alasan pilihan Anda jika ada"></textarea></label>'
      : '';

    return '<div class="rtkd-q" id="wrap-' + id + '">' +
             '<div class="rtkd-q-header">' +
               '<span class="rtkd-code">' + esc(q.c) + '</span>' +
               '<div class="rtkd-ql">' + esc(q.l) + req + (q.note ? '<small>' + esc(q.note) + '</small>' : '') + '</div>' +
             '</div>' +
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
    currentTab: 'A',

    /**
     * Membangun skema instrumen dinamis dari database untuk survei masa depan
     * Mendukung survei multi-instrumen apa pun di masa mendatang
     */
    loadSchemaFromDb: function(questionsList, instrumentNames) {
      if (!Array.isArray(questionsList) || questionsList.length === 0) return;
      var defaultNames = {
        A: "Perusahaan / Pemberi Kerja",
        B: "Pencari Kerja & Lulusan",
        C: "Pemangku Kepentingan",
        D: "Siswa Kelas 12"
      };
      if (instrumentNames) {
        Object.assign(defaultNames, instrumentNames);
      }

      var grouped = {};
      questionsList.forEach(function(q) {
        var ins = (q.Instrumen || 'A').toUpperCase();
        if (!grouped[ins]) {
          grouped[ins] = {
            name: defaultNames[ins] || ("Instrumen " + ins),
            label: defaultNames[ins] || ("Instrumen " + ins),
            blocks: []
          };
        }

        var secTitle = q.Section || "Pertanyaan Survei";
        var blk = grouped[ins].blocks.find(function(b) { return b.t === secTitle; });
        if (!blk) {
          blk = { t: secTitle, qs: [] };
          grouped[ins].blocks.push(blk);
        }

        var code = (q.Pertanyaan || '').match(/^\[([A-Za-z0-9_]+)\]/);
        var qCode = code ? code[1] : (q.c || ('Q' + q.Id));
        var cleanTitle = (q.Pertanyaan || '').replace(/^\[[A-Za-z0-9_]+\]\s*/, '');

        var qObj = {
          c: qCode,
          l: cleanTitle,
          note: q.Deskripsi || '',
          type: q.Tipe === 'radio' ? 'one' : (q.Tipe === 'checkbox' ? 'many' : (q.Tipe === 'scale' ? 'scale' : (q.Tipe === 'textarea' ? 'area' : (q.Tipe === 'number' ? 'num' : 'text')))),
          req: (q.IsRequired == 1 || q.IsRequired === '1') ? 1 : 0
        };

        if (q.OpsiPilihanList && q.OpsiPilihanList.length) {
          qObj.o = q.OpsiPilihanList.map(function(o) { return typeof o === 'object' ? (o.label || o.nilai) : o; });
        } else if (q.OpsiPilihan) {
          try {
            var parsed = typeof q.OpsiPilihan === 'string' ? JSON.parse(q.OpsiPilihan) : q.OpsiPilihan;
            qObj.o = parsed.map(function(o) { return typeof o === 'object' ? (o.label || o.nilai) : o; });
          } catch(e) {}
        }

        blk.qs.push(qObj);
      });

      // Update SCHEMA
      Object.keys(grouped).forEach(function(ins) {
        SCHEMA[ins] = grouped[ins];
      });
    },

    render: function(sheetId, instrumentKey, prefix) {
      prefix = prefix || '';
      var s = SCHEMA[instrumentKey] || SCHEMA['A'];
      this.currentTab = instrumentKey;

      var sheetElem = document.getElementById(sheetId);
      if (!sheetElem) return;

      var html = s.blocks.map(function(b) {
        return '<div class="rtkd-blk">' +
                 '<h2><i class="fa-solid fa-layer-group" style="font-size: 14px; margin-right: 8px;"></i> ' + esc(b.t) + '</h2>' +
                 (b.hint ? '<p class="hint">' + esc(b.hint) + '</p>' : '') +
                 b.qs.map(function(q) { return qHTML(q, prefix); }).join("") +
               '</div>';
      }).join("");

      sheetElem.innerHTML = html;

      // Update consent text
      var consentText = instrumentKey === "C"
        ? "Narasumber sudah menerima penjelasan tujuan wawancara dan menyetujui pencatatan pokok jawaban untuk penyusunan laporan."
        : instrumentKey === "D"
        ? "Sekolah sudah memberi izin, siswa sudah menerima penjelasan tujuan survei dan bersedia mengisi, serta mengetahui bahwa jawaban tidak memuat nama dan hanya disajikan secara agregat."
        : "Responden sudah menerima penjelasan tujuan survei, menyetujui pengisian, dan mengetahui bahwa jawaban hanya disajikan secara agregat.";

      var consentSpan = document.getElementById(prefix + 'consentText') || document.getElementById('rtkdConsentText') || document.getElementById('modalConsentText');
      if (consentSpan) consentSpan.textContent = consentText;

      this.applyShow(sheetId, instrumentKey, prefix);
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
        } else if (q.type === "one") {
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
    }
  };

})(window, jQuery);
