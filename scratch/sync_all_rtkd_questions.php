<?php
/**
 * sync_all_rtkd_questions.php
 * Sinkronisasi butir pertanyaan lengkap Survei RTKD Banyuwangi (SurveiId = 4)
 * Mencakup 5 Instrumen: A, B, C, D, E
 */

$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$surveiId = 4;

// Pastikan survei_dinamis ID 4 ada
$stmt = $pdo->prepare("SELECT Id FROM survei_dinamis WHERE Id = ?");
$stmt->execute([$surveiId]);
if (!$stmt->fetch()) {
    $pdo->query("REPLACE INTO `survei_dinamis` (`Id`, `KodeSurvei`, `Judul`, `Deskripsi`, `Lembaga`, `Jenis`, `Tahun`, `Status`, `DaerahSurvei`, `BannerColor`, `BannerImage`, `EstimasiWaktu`, `CreatedBy`, `CreatedAt`, `UpdatedAt`) 
    VALUES (4, 'survei-rtkd-banyuwangi', 'Survei Ketenagakerjaan Banyuwangi (RTKD)', 'Survei Primer Ketenagakerjaan Kabupaten Banyuwangi dalam rangka Penyusunan Rencana Tenaga Kerja Daerah (RTKD) 2026. Mencakup 5 Instrumen: A (Perusahaan), B (Pencari Kerja & Lulusan), C (Pemangku Kepentingan), E (AHP Isu Strategis), dan D (Siswa Kelas 12).', 'Dinas Tenaga Kerja, Transmigrasi dan Perindustrian Kab. Banyuwangi', 'Ketenagakerjaan', '2026', 'Aktif', 'Kabupaten Banyuwangi', '#043168', 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=1200&q=80', '15 - 25 Menit', 'Admin RTKD', NOW(), NOW())");
}

// Pastikan kolom Instrumen dan Section ada
$cols = $pdo->query("SHOW COLUMNS FROM survei_pertanyaan")->fetchAll(PDO::FETCH_COLUMN);
if (!in_array('Instrumen', $cols)) {
    $pdo->query("ALTER TABLE `survei_pertanyaan` ADD COLUMN `Instrumen` VARCHAR(10) DEFAULT 'A' AFTER `SurveiId`");
}
if (!in_array('Section', $cols)) {
    $pdo->query("ALTER TABLE `survei_pertanyaan` ADD COLUMN `Section` VARCHAR(150) NULL AFTER `Deskripsi`");
}

$KEC = ["Banyuwangi","Blimbingsari","Bangorejo","Cluring","Gambiran","Genteng","Giri","Glagah","Glenmore","Kabat","Kalibaru","Kalipuro","Licin","Muncar","Pesanggaran","Purwoharjo","Rogojampi","Sempu","Siliragung","Singojuruh","Songgon","Srono","Tegaldlimo","Tegalsari","Wongsorejo"];
$SEKTOR = ["Pertanian/perikanan","Industri pengolahan","Perdagangan","Akomodasi dan makan-minum","Konstruksi","Transportasi/pergudangan","Jasa pendidikan/kesehatan","Jasa lainnya"];
$BEKERJA = ["Bekerja sebagai karyawan/buruh","Berusaha sendiri","Pekerja lepas","Membantu usaha keluarga"];
$HIJAU_DEF = "Green job atau pekerjaan hijau adalah pekerjaan yang ikut menjaga alam dan lingkungan tetap bersih dan lestari, dengan upah dan perlindungan kerja yang layak. Contohnya: mengelola bank sampah, mendaur ulang plastik, bertani organik, menangkap ikan tanpa merusak laut, memandu wisata alam, dan memasang listrik tenaga surya.";
$BIDANG_HIJAU = ["Listrik tenaga surya, biogas, atau angin","Pengelolaan sampah dan daur ulang","Pertanian organik (tanpa banyak bahan kimia)","Perikanan yang tidak merusak laut","Wisata alam dan desa wisata","Bangunan hemat listrik dan air","Kendaraan listrik dan bengkelnya","Lainnya"];
$TAHU_HIJAU = ["Pernah dengar dan tahu artinya","Pernah dengar, tapi belum tahu artinya","Belum pernah dengar"];
$MINAT_HIJAU = ["Sangat tertarik","Tertarik","Kurang tertarik","Tidak tertarik"];

$AHP_KRIT = [
  "Mendukung target pembangunan daerah",
  "Dirasakan oleh banyak warga",
  "Ikut mendorong kemajuan sektor lain",
  "Bisa ditangani pemerintah kabupaten",
  "Bisa diatasi dalam 5 tahun",
  "Sejalan dengan program bupati"
];
$AHP_ISU = [
  "Banyak pekerja tanpa kontrak dan perlindungan",
  "Keterampilan pencari kerja belum sesuai kebutuhan",
  "Hasil kerja petani dan nelayan masih rendah",
  "Anak muda dan lulusan sulit mendapat kerja",
  "Pekerja migran dan kelompok rentan kurang terlindungi"
];

function makePairQs($prefix, $items) {
    $qs = [];
    for ($i = 0; $i < count($items); $i++) {
        for ($j = $i + 1; $j < count($items); $j++) {
            $qs[] = [
                'c' => $prefix . ($i + 1) . ($j + 1),
                'type' => 'pair',
                'l' => $items[$i] . ' vs ' . $items[$j],
                'note' => 'Skala Saaty 9-1-9 perbandingan kepentingan',
                'req' => 1
            ];
        }
    }
    return $qs;
}

$SCHEMA = [
    'A' => [
        [
            't' => 'Pencatatan petugas',
            'qs' => [
                ['c' => 'SR', 'l' => 'Sumber responden', 'type' => 'one', 'o' => ["Daftar wajib lapor Disnaker (sampel acak)", "Ditemui di lapangan (sampel kuota)"], 'req' => 1],
                ['c' => 'SR2', 'l' => 'Nama lokasi pengambilan', 'note' => 'misalnya nama pasar atau kawasan usaha', 'type' => 'text']
            ]
        ],
        [
            't' => 'A. Identitas usaha',
            'qs' => [
                ['c' => 'P1', 'l' => 'Nama usaha', 'note' => 'opsional', 'type' => 'text'],
                ['c' => 'P2', 'l' => 'Kecamatan lokasi usaha', 'type' => 'kec', 'req' => 1],
                ['c' => 'P3', 'l' => 'Sektor utama usaha', 'type' => 'one', 'o' => $SEKTOR, 'req' => 1],
                ['c' => 'P4', 'l' => 'Jumlah seluruh pekerja', 'type' => 'one', 'o' => ["1–4", "5–19", "20–99", "100 ke atas"], 'req' => 1],
                ['c' => 'P5', 'l' => 'Bentuk usaha', 'type' => 'one', 'o' => ["Perorangan tidak berbadan hukum", "CV/firma", "PT", "Koperasi", "BUMN/BUMD"]]
            ]
        ],
        [
            't' => 'B. Tenaga kerja saat ini',
            'qs' => [
                ['c' => 'P6', 'l' => 'Jumlah pekerja menurut jenis kelamin', 'type' => 'grid', 'f' => ["Laki-laki", "Perempuan"]],
                ['c' => 'P7', 'l' => 'Jumlah pekerja menurut status', 'type' => 'grid', 'f' => ["Tetap", "Kontrak", "Harian lepas"]],
                ['c' => 'P8', 'l' => 'Jumlah pekerja menurut pendidikan', 'type' => 'grid', 'f' => ["SD ke bawah", "SMP", "SMA", "SMK", "Diploma", "S1 ke atas"]],
                ['c' => 'P9', 'l' => 'Jumlah pekerja yang berasal dari luar Banyuwangi', 'type' => 'num']
            ]
        ],
        [
            't' => 'C. Rekrutmen 12 bulan terakhir',
            'qs' => [
                ['c' => 'P10', 'l' => 'Jumlah pekerja baru yang direkrut', 'type' => 'num'],
                ['c' => 'P11', 'l' => 'Saluran rekrutmen yang dipakai', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Kenalan/keluarga", "Media sosial", "Disnaker/bursa kerja", "Sekolah/kampus", "Portal lowongan", "Agen penyalur"]],
                ['c' => 'P12', 'l' => 'Adakah lowongan yang sulit diisi?', 'type' => 'one', 'o' => ["Ya", "Tidak"]],
                ['c' => 'P13', 'l' => 'Jabatan yang sulit diisi', 'type' => 'text'],
                ['c' => 'P14', 'l' => 'Alasan utama sulit diisi', 'type' => 'one', 'o' => ["Pelamar kurang", "Keterampilan tidak sesuai", "Pengalaman kurang", "Upah yang diharapkan terlalu tinggi", "Lokasi jauh", "Lainnya"]]
            ]
        ],
        [
            't' => 'D. Kebutuhan tenaga kerja tiga tahun ke depan',
            'qs' => [
                ['c' => 'P15', 'l' => 'Rencana jumlah pekerja', 'type' => 'one', 'o' => ["Bertambah", "Tetap", "Berkurang"]],
                ['c' => 'P16', 'l' => 'Perkiraan tambahan pekerja', 'type' => 'num'],
                ['c' => 'P17', 'l' => 'Jabatan dan pendidikan yang paling dibutuhkan', 'note' => 'jabatan, pendidikan minimal, jumlah', 'type' => 'area'],
                ['c' => 'P18', 'l' => 'Faktor yang paling memengaruhi rencana tersebut', 'type' => 'one', 'o' => ["Permintaan pasar", "Investasi/perluasan", "Otomasi/digitalisasi", "Biaya tenaga kerja", "Lainnya"]]
            ]
        ],
        [
            't' => 'E. Keterampilan dan pelatihan',
            'qs' => [
                ['c' => 'P19', 'l' => 'Penilaian keterampilan lulusan lokal', 'type' => 'scale', 'f' => ["Teknis sesuai bidang", "Digital", "Bahasa asing", "Komunikasi", "Kerja sama tim", "Disiplin/etos kerja"]],
                ['c' => 'P20', 'l' => 'Keterampilan yang paling kurang dari pelamar', 'type' => 'text'],
                ['c' => 'P21', 'l' => 'Apakah usaha memberi pelatihan kepada pekerja?', 'type' => 'one', 'o' => ["Ya, rutin", "Kadang-kadang", "Tidak"]],
                ['c' => 'P22', 'l' => 'Kerja sama dengan SMK, BLK, atau kampus', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Magang/prakerin", "Rekrutmen lulusan", "Penyusunan kurikulum", "Belum ada"]],
                ['c' => 'P23', 'l' => 'Pekerja yang memiliki sertifikat kompetensi (BNSP)', 'type' => 'one', 'o' => ["Sebagian besar", "Sebagian kecil", "Tidak ada", "Tidak tahu"]]
            ]
        ],
        [
            't' => 'F. Upah, jaminan sosial, dan hubungan kerja',
            'qs' => [
                ['c' => 'P24', 'l' => 'Upah pekerja pemula dibandingkan UMK', 'type' => 'one', 'o' => ["Di bawah UMK", "Setara UMK", "Di atas UMK"]],
                ['c' => 'P25', 'l' => 'Kepesertaan BPJS Ketenagakerjaan', 'type' => 'one', 'o' => ["Semua pekerja", "Sebagian", "Tidak ada"]],
                ['c' => 'P26', 'l' => 'Kepesertaan BPJS Kesehatan dari pemberi kerja', 'type' => 'one', 'o' => ["Semua pekerja", "Sebagian", "Tidak ada"]],
                ['c' => 'P27', 'l' => 'Dokumen hubungan kerja yang dimiliki', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Kontrak tertulis", "Peraturan perusahaan", "PKB", "LKS Bipartit", "Belum ada"]],
                ['c' => 'P28', 'l' => 'Kecelakaan kerja dalam 12 bulan terakhir', 'type' => 'one', 'o' => ["Tidak ada", "1–2 kejadian", "3 atau lebih"]]
            ]
        ],
        [
            't' => 'G. Kendala dan harapan',
            'qs' => [
                ['c' => 'P29', 'l' => 'Kendala utama terkait tenaga kerja', 'type' => 'area'],
                ['c' => 'P30', 'l' => 'Dukungan yang diharapkan dari pemerintah daerah', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Pelatihan sesuai kebutuhan", "Informasi pasar kerja", "Insentif perekrutan", "Sertifikasi", "Lainnya"]]
            ]
        ],
        [
            't' => 'H. Perputaran pekerja (labour turnover)',
            'qs' => [
                ['c' => 'P31', 'l' => 'Jumlah pekerja yang keluar atau berhenti dalam 12 bulan terakhir', 'type' => 'num'],
                ['c' => 'P32', 'l' => 'Rata-rata lama pekerja bertahan di perusahaan', 'type' => 'one', 'o' => ["Kurang dari 1 tahun", "1–3 tahun", "3–5 tahun", "Lebih dari 5 tahun"]],
                ['c' => 'P36', 'l' => 'Apakah pekerja yang sering keluar-masuk menjadi masalah bagi perusahaan?', 'type' => 'one', 'o' => ["Ya, masalah besar", "Cukup menjadi masalah", "Tidak menjadi masalah"]],
                ['c' => 'P37', 'l' => 'Alasan paling sering pekerja mengundurkan diri', 'type' => 'one', 'o' => ["Mendapat upah lebih tinggi di tempat lain", "Kontrak habis", "Upah dirasa terlalu rendah", "Kondisi atau beban kerja tidak cocok", "Bekerja ke luar daerah atau luar negeri", "Membuka usaha sendiri", "Alasan keluarga atau pindah tempat tinggal", "Melanjutkan sekolah", "Lainnya"]],
                ['c' => 'P38', 'l' => 'Cara perusahaan mengatasi pekerja yang sering keluar', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Menaikkan upah atau memberi insentif", "Memberi jenjang karier atau kenaikan jabatan", "Memberi pelatihan", "Mengangkat menjadi pekerja tetap", "Memperbaiki kondisi dan suasana kerja", "Memberi tunjangan atau fasilitas tambahan", "Mengikat dengan kontrak atau ikatan dinas", "Belum ada upaya khusus", "Lainnya"]]
            ]
        ],
        [
            't' => 'I. Kegiatan ramah lingkungan (green job)',
            'qs' => [
                ['c' => 'P33', 'l' => 'Kegiatan ramah lingkungan apa yang sudah dilakukan perusahaan?', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Menghemat listrik atau air", "Mengolah limbah atau mendaur ulang sampah", "Memakai listrik tenaga surya atau energi bersih lainnya", "Memakai bahan baku yang ramah lingkungan", "Punya sertifikat ramah lingkungan", "Belum ada"]],
                ['c' => 'P34', 'l' => 'Dalam 3 tahun ke depan, apakah perusahaan berencana menambah pekerja yang punya keterampilan green job?', 'type' => 'one', 'o' => ["Ya", "Mungkin", "Tidak"]],
                ['c' => 'P35', 'l' => 'Keterampilan green job apa yang paling dibutuhkan?', 'note' => 'misalnya mengolah limbah, mendaur ulang, atau merawat panel surya', 'type' => 'text']
            ]
        ],
        [
            't' => 'J. Upah minimum dan iklim usaha',
            'qs' => [
                ['c' => 'P39', 'l' => 'Menurut Bapak/Ibu, apakah UMK Banyuwangi saat ini (Rp2.989.145 per bulan pada 2026) cukup kompetitif?', 'note' => 'kompetitif: tidak memberatkan usaha dan cukup menarik bagi pekerja', 'type' => 'one', 'o' => ["Ya, cukup kompetitif", "Kurang kompetitif", "Tidak kompetitif", "Tidak tahu"]],
                ['c' => 'P40', 'l' => 'Jika kurang atau tidak kompetitif, apa pengaruhnya bagi perusahaan?', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Biaya produksi naik", "Keuntungan turun", "Sulit menambah pekerja baru", "Pekerja terampil memilih bekerja di daerah lain", "Pekerja lebih sering keluar", "Harga produk kalah bersaing", "Menunda perluasan usaha", "Lainnya"]],
                ['c' => 'P41', 'l' => 'Jika UMK naik, langkah apa yang paling mungkin dilakukan perusahaan?', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Meningkatkan produksi atau produktivitas pekerja", "Menaikkan harga jual", "Mengurangi jumlah pekerja", "Mengganti sebagian pekerja dengan mesin atau alat produksi", "Mengurangi jam kerja atau lembur", "Menunda penerimaan pekerja baru", "Menambah pekerja kontrak, harian, atau alih daya", "Mengurangi tunjangan atau fasilitas lain", "Tidak ada perubahan", "Lainnya"]],
                ['c' => 'P42', 'l' => 'Permasalahan di Kabupaten Banyuwangi yang paling memengaruhi kinerja atau hasil produksi perusahaan', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Sulit mendapat tenaga kerja terampil", "Biaya tenaga kerja", "Infrastruktur jalan dan transportasi", "Pasokan listrik atau air", "Perizinan usaha", "Akses permodalan", "Permintaan pasar lemah", "Harga atau pasokan bahan baku", "Persaingan usaha", "Musim dan cuaca", "Lainnya"]],
                ['c' => 'P43', 'l' => 'Jelaskan permasalahan yang paling berat dan usulan penyelesaiannya', 'type' => 'area']
            ]
        ]
    ],
    'B' => [
        [
            't' => 'Pencatatan petugas dan penyaringan',
            'qs' => [
                ['c' => 'SR', 'l' => 'Sumber responden', 'type' => 'one', 'o' => ["Daftar pencari kerja Disnaker (AK/I)", "Daftar alumni BKK SMK atau tracer study kampus", "Lapangan: cafe, rumah makan, atau toko", "Lapangan: pasar, terminal, atau tempat umum", "Lapangan: kunjungan rumah tangga di desa", "Bursa kerja atau job fair", "Lainnya"], 'req' => 1],
                ['c' => 'SR2', 'l' => 'Nama lokasi pengambilan', 'note' => 'misalnya nama cafe, pasar, atau desa', 'type' => 'text'],
                ['c' => 'SC', 'l' => 'Penyaring: responden berusia 15 tahun ke atas dan…', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Bekerja paling sedikit 1 jam dalam seminggu terakhir", "Sedang mencari kerja atau menyiapkan usaha", "Lulus SMA, SMK, diploma, atau sarjana dalam 3 tahun terakhir", "Tidak satu pun"], 'req' => 1]
            ]
        ],
        [
            't' => 'A. Profil responden',
            'qs' => [
                ['c' => 'L1', 'l' => 'Umur', 'type' => 'one', 'o' => ["15–19", "20–24", "25–29", "30–39", "40 ke atas"], 'req' => 1],
                ['c' => 'L2', 'l' => 'Jenis kelamin', 'type' => 'one', 'o' => ["Laki-laki", "Perempuan"], 'req' => 1],
                ['c' => 'L3', 'l' => 'Kecamatan tempat tinggal', 'type' => 'kec', 'req' => 1],
                ['c' => 'L4', 'l' => 'Pendidikan terakhir', 'type' => 'one', 'o' => ["SD/SMP", "SMA", "SMK", "Diploma", "S1 ke atas"], 'req' => 1],
                ['c' => 'L5', 'l' => 'Jurusan/bidang studi', 'type' => 'text'],
                ['c' => 'L6', 'l' => 'Tahun lulus', 'type' => 'num']
            ]
        ],
        [
            't' => 'B. Status kegiatan saat ini',
            'qs' => [
                ['c' => 'L7', 'l' => 'Kegiatan utama saat ini', 'type' => 'one', 'o' => array_merge($BEKERJA, ["Mencari kerja", "Melanjutkan sekolah/kuliah", "Mengurus rumah tangga"]), 'req' => 1],
                ['c' => 'L8', 'l' => 'Apakah sedang mencari pekerjaan (baru atau tambahan)?', 'type' => 'one', 'o' => ["Ya", "Tidak"]]
            ]
        ],
        [
            't' => 'C. Pengalaman mencari kerja',
            'qs' => [
                ['c' => 'L9', 'l' => 'Lama mencari kerja', 'note' => 'sejak lulus atau sejak mulai mencari', 'type' => 'one', 'o' => ["Kurang dari 3 bulan", "3–6 bulan", "6–12 bulan", "Lebih dari 12 bulan"]],
                ['c' => 'L10', 'l' => 'Jumlah lamaran yang dikirim', 'type' => 'one', 'o' => ["0", "1–5", "6–20", "Lebih dari 20"]],
                ['c' => 'L11', 'l' => 'Cara mencari kerja', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Kenalan/keluarga", "Media sosial", "Portal lowongan", "Disnaker/bursa kerja", "Sekolah/kampus", "Melamar langsung"]],
                ['c' => 'L12', 'l' => 'Terdaftar sebagai pencari kerja di Disnaker (kartu AK/I)?', 'type' => 'one', 'o' => ["Ya", "Tidak", "Tidak tahu caranya"]],
                ['c' => 'L13', 'l' => 'Kendala utama mendapat pekerjaan', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Lowongan sedikit", "Keterampilan belum sesuai", "Kurang pengalaman", "Upah rendah", "Lokasi jauh", "Syarat umur/penampilan", "Lainnya"]]
            ]
        ],
        [
            't' => 'D. Pekerjaan saat ini',
            'qs' => [
                ['c' => 'L14', 'l' => 'Sektor pekerjaan', 'type' => 'one', 'o' => $SEKTOR],
                ['c' => 'L15', 'l' => 'Kesesuaian pekerjaan dengan pendidikan', 'type' => 'one', 'o' => ["Sesuai", "Kurang sesuai", "Tidak sesuai"]],
                ['c' => 'L16', 'l' => 'Pendapatan bersih per bulan', 'type' => 'one', 'o' => ["Kurang dari Rp1 juta", "Rp1–2 juta", "Rp2–3 juta", "Rp3–5 juta", "Lebih dari Rp5 juta"]],
                ['c' => 'L17', 'l' => 'Jam kerja per minggu', 'type' => 'one', 'o' => ["Kurang dari 15", "15–34", "35–48", "Lebih dari 48"]],
                ['c' => 'L18', 'l' => 'Memiliki kontrak kerja tertulis', 'type' => 'one', 'o' => ["Ya", "Tidak", "Tidak berlaku (usaha sendiri)"]],
                ['c' => 'L19', 'l' => 'Terdaftar BPJS Ketenagakerjaan', 'type' => 'one', 'o' => ["Ya", "Tidak", "Tidak tahu"]],
                ['c' => 'L20', 'l' => 'Lokasi kerja', 'type' => 'one', 'o' => ["Di Banyuwangi", "Di luar Banyuwangi", "Di luar negeri"]]
            ]
        ],
        [
            't' => 'E. Keterampilan dan pelatihan',
            'qs' => [
                ['c' => 'L21', 'l' => 'Pelatihan yang pernah diikuti', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["BLK", "Kartu Prakerja", "Lembaga kursus swasta", "Pelatihan dari perusahaan", "Belum pernah"]],
                ['c' => 'L22', 'l' => 'Memiliki sertifikat kompetensi (BNSP)', 'type' => 'one', 'o' => ["Ya", "Tidak"]],
                ['c' => 'L23', 'l' => 'Penilaian diri atas keterampilan', 'type' => 'scale', 'f' => ["Teknis", "Digital", "Bahasa asing", "Komunikasi"]],
                ['c' => 'L24', 'l' => 'Pelatihan yang paling diinginkan', 'type' => 'text']
            ]
        ],
        [
            't' => 'F. Harapan dan rencana',
            'qs' => [
                ['c' => 'L25', 'l' => 'Rata-rata pengeluaran pribadi per bulan', 'note' => 'makan, transportasi, pulsa', 'type' => 'one', 'o' => ["Kurang dari Rp1 juta", "Rp1–2 juta", "Rp2–3 juta", "Rp3–5 juta", "Lebih dari Rp5 juta"]],
                ['c' => 'L26', 'l' => 'Sektor yang paling diminati', 'type' => 'one', 'o' => array_merge($SEKTOR, ["Pemerintahan/ASN"])],
                ['c' => 'L27', 'l' => 'Kesediaan bekerja di luar Banyuwangi', 'type' => 'one', 'o' => ["Ya, dalam negeri", "Ya, termasuk luar negeri", "Tidak"]],
                ['c' => 'L28', 'l' => 'Minat membuka usaha sendiri', 'type' => 'one', 'o' => ["Sudah berusaha", "Berminat", "Tidak berminat"]],
                ['c' => 'L29', 'l' => 'Kendala utama memulai usaha', 'type' => 'one', 'o' => ["Modal", "Keterampilan", "Pasar", "Perizinan", "Lainnya"]],
                ['c' => 'L39', 'l' => 'Jika ditawari pekerjaan dengan upah di bawah UMK (Rp2.989.145 per bulan pada 2026), apa yang akan Anda lakukan?', 'type' => 'one', 'o' => ["Tetap mengambil", "Mengambil sementara sambil mencari pekerjaan lain", "Tergantung jenis pekerjaannya", "Tidak mengambil"]],
                ['c' => 'L39a', 'l' => 'Alasannya', 'type' => 'area', 'req' => 1],
                ['c' => 'L40', 'l' => 'Lebih suka bekerja dengan penghasilan tetap atau lepas (freelance)?', 'type' => 'one', 'o' => ["Penghasilan tetap (gaji bulanan)", "Lepas/freelance (dibayar per pekerjaan)", "Pekerjaan tetap ditambah pekerjaan sampingan", "Tidak ada pilihan khusus"]]
            ]
        ],
        [
            't' => 'G. Riwayat perpindahan kerja',
            'qs' => [
                ['c' => 'L30', 'l' => 'Apakah pernah bekerja, termasuk pekerjaan saat ini?', 'type' => 'one', 'o' => ["Ya", "Belum pernah bekerja"]],
                ['c' => 'L31', 'l' => 'Berapa kali berpindah tempat kerja dalam 5 tahun terakhir', 'type' => 'one', 'o' => ["Belum pernah pindah", "1 kali", "2–3 kali", "4 kali atau lebih"]],
                ['c' => 'L32', 'l' => 'Waktu paling lama bekerja di satu tempat kerja', 'type' => 'one', 'o' => ["Kurang dari 6 bulan", "6–12 bulan", "1–2 tahun", "2–5 tahun", "Lebih dari 5 tahun"]],
                ['c' => 'L33', 'l' => 'Alasan utama mengundurkan diri, berhenti, atau pindah dari pekerjaan sebelumnya', 'type' => 'one', 'o' => ["Masih bekerja di tempat kerja pertama", "Kontrak habis", "Upah rendah", "Mendapat pekerjaan yang lebih baik", "PHK atau usaha tutup", "Kondisi kerja tidak nyaman", "Alasan keluarga atau pindah tempat tinggal", "Melanjutkan sekolah", "Lainnya"]],
                ['c' => 'L33a', 'l' => 'Sebutkan alasan lainnya', 'type' => 'area', 'req' => 1]
            ]
        ],
        [
            't' => 'H. Green job (pekerjaan ramah lingkungan)',
            'qs' => [
                ['c' => 'L34', 'l' => 'Sebelum membaca penjelasan di atas, apakah Anda pernah mendengar istilah green job atau pekerjaan hijau?', 'type' => 'one', 'o' => $TAHU_HIJAU],
                ['c' => 'L35', 'l' => 'Apakah pekerjaan Anda sekarang atau yang terakhir ikut menjaga lingkungan?', 'type' => 'one', 'o' => ["Ya", "Sebagian", "Tidak", "Tidak tahu"]],
                ['c' => 'L36', 'l' => 'Apakah Anda tertarik bekerja di bidang green job?', 'type' => 'one', 'o' => $MINAT_HIJAU],
                ['c' => 'L37', 'l' => 'Bidang green job apa yang paling Anda minati?', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => $BIDANG_HIJAU],
                ['c' => 'L38', 'l' => 'Apakah Anda pernah ikut pelatihan tentang green job?', 'note' => 'misalnya daur ulang, pertanian organik', 'type' => 'one', 'o' => ["Ya", "Tidak"]]
            ]
        ]
    ],
    'C' => [
        [
            't' => 'Identitas narasumber',
            'qs' => [
                ['c' => 'S1', 'l' => 'Kelompok narasumber', 'type' => 'one', 'o' => ["Perencana dan pengelola program", "Penyedia pelatihan dan pendidikan", "Dunia usaha", "Pekerja/serikat pekerja", "Penempatan dan migrasi kerja"], 'req' => 1],
                ['c' => 'S2', 'l' => 'Nama lembaga', 'type' => 'text', 'req' => 1],
                ['c' => 'S3', 'l' => 'Jabatan narasumber', 'type' => 'text'],
                ['c' => 'S4', 'l' => 'Tanggal wawancara', 'type' => 'date'],
                ['c' => 'S5', 'l' => 'Bentuk kegiatan', 'type' => 'one', 'o' => ["Wawancara mendalam", "FGD"]]
            ]
        ],
        [
            't' => 'Pokok jawaban per tema',
            'qs' => [
                ['c' => 'T1', 'l' => 'Kondisi pasar kerja', 'note' => 'perubahan terbesar, sektor tumbuh/menurun', 'type' => 'area'],
                ['c' => 'T2', 'l' => 'Kesesuaian keterampilan', 'note' => 'jabatan sulit diisi, keselarasan kurikulum', 'type' => 'area'],
                ['c' => 'T3', 'l' => 'Program dan layanan ketenagakerjaan', 'note' => 'program berjalan, hambatan, koordinasi', 'type' => 'area'],
                ['c' => 'T4', 'l' => 'Pengupahan dan hubungan industrial', 'note' => 'kepatuhan UMK dan jaminan sosial', 'type' => 'area'],
                ['c' => 'T5', 'l' => 'Pekerja rentan dan informal', 'note' => 'pekerja informal, perempuan, disabilitas, migran', 'type' => 'area'],
                ['c' => 'T6', 'l' => 'Usulan kebijakan dan program prioritas', 'type' => 'area']
            ]
        ],
        [
            't' => 'Tiga isu terpenting menurut narasumber',
            'qs' => [
                ['c' => 'I1', 'l' => 'Isu pertama', 'type' => 'text'],
                ['c' => 'I2', 'l' => 'Isu kedua', 'type' => 'text'],
                ['c' => 'I3', 'l' => 'Isu ketiga', 'type' => 'text']
            ]
        ]
    ],
    'D' => [
        [
            't' => 'A. Profil responden',
            'qs' => [
                ['c' => 'K1', 'l' => 'Jenis sekolah', 'type' => 'one', 'o' => ["SMA", "SMK", "MA"], 'req' => 1],
                ['c' => 'K2', 'l' => 'Nama sekolah', 'type' => 'text', 'req' => 1],
                ['c' => 'K3', 'l' => 'Kecamatan lokasi sekolah', 'type' => 'kec', 'req' => 1],
                ['c' => 'K4', 'l' => 'Jurusan atau kompetensi keahlian', 'type' => 'text'],
                ['c' => 'K5', 'l' => 'Umur', 'type' => 'one', 'o' => ["16 tahun atau kurang", "17 tahun", "18 tahun", "19 tahun atau lebih"], 'req' => 1],
                ['c' => 'K6', 'l' => 'Jenis kelamin', 'type' => 'one', 'o' => ["Laki-laki", "Perempuan"], 'req' => 1],
                ['c' => 'K7', 'l' => 'Kecamatan tempat tinggal', 'type' => 'kec']
            ]
        ],
        [
            't' => 'B. Rencana setelah lulus',
            'qs' => [
                ['c' => 'K8', 'l' => 'Rencana utama setelah lulus', 'type' => 'one', 'o' => ["Bekerja", "Kuliah", "Kuliah sambil bekerja", "Berwirausaha", "Kursus/pelatihan dulu", "Bekerja di luar negeri", "Belum tahu"], 'req' => 1],
                ['c' => 'K9', 'l' => 'Jika bekerja, lokasi kerja yang diinginkan', 'type' => 'one', 'o' => ["Di Banyuwangi", "Di luar Banyuwangi, masih di Jawa Timur", "Di luar Jawa Timur", "Di luar negeri"]],
                ['c' => 'K10', 'l' => 'Sektor pekerjaan yang paling diminati', 'type' => 'one', 'o' => array_merge($SEKTOR, ["Pemerintahan/ASN"])],
                ['c' => 'K11', 'l' => 'Pekerjaan atau jabatan yang dicita-citakan', 'type' => 'text'],
                ['c' => 'K12', 'l' => 'Upah minimal per bulan yang bersedia diterima pada pekerjaan pertama', 'type' => 'one', 'o' => ["Kurang dari Rp2 juta", "Rp2–3 juta", "Rp3–4 juta", "Lebih dari Rp4 juta"]],
                ['c' => 'K13', 'l' => 'Keyakinan mendapat pekerjaan dalam 6 bulan setelah lulus', 'type' => 'one', 'o' => ["Sangat yakin", "Yakin", "Ragu-ragu", "Tidak yakin"]],
                ['c' => 'K14', 'l' => 'Minat bekerja sebagai pekerja migran di luar negeri', 'type' => 'one', 'o' => ["Berminat", "Mungkin", "Tidak berminat"]]
            ]
        ],
        [
            't' => 'C. Pengalaman dan keterampilan',
            'qs' => [
                ['c' => 'K15', 'l' => 'Pengalaman praktik kerja lapangan (PKL/prakerin) atau magang', 'type' => 'one', 'o' => ["Ya, sesuai jurusan", "Ya, tidak sesuai jurusan", "Belum pernah"]],
                ['c' => 'K16', 'l' => 'Sektor tempat PKL atau magang', 'type' => 'one', 'o' => array_merge($SEKTOR, ["Pemerintahan/ASN"])],
                ['c' => 'K17', 'l' => 'Pengalaman bekerja paruh waktu atau membantu usaha keluarga', 'type' => 'one', 'o' => ["Ya, dibayar", "Ya, tidak dibayar", "Tidak pernah"]],
                ['c' => 'K18', 'l' => 'Kursus atau pelatihan di luar sekolah', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Komputer/digital", "Bahasa asing", "Keterampilan teknik", "Tata boga/tata busana/kecantikan", "Belum pernah"]],
                ['c' => 'K19', 'l' => 'Memiliki sertifikat kompetensi (BNSP/LSP)', 'type' => 'one', 'o' => ["Ya", "Sedang proses", "Tidak"]],
                ['c' => 'K20', 'l' => 'Penilaian diri atas keterampilan', 'type' => 'scale', 'f' => ["Teknis sesuai jurusan", "Digital", "Bahasa asing", "Komunikasi"]],
                ['c' => 'K21', 'l' => 'Keterampilan yang paling ingin dipelajari', 'type' => 'text']
            ]
        ],
        [
            't' => 'D. Informasi dan dukungan',
            'qs' => [
                ['c' => 'K22', 'l' => 'Sumber informasi lowongan kerja yang diketahui', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Media sosial", "Bursa Kerja Khusus (BKK) sekolah", "Guru BK", "Keluarga/kenalan", "Portal lowongan", "Disnaker/bursa kerja", "Belum tahu"]],
                ['c' => 'K23', 'l' => 'Pengetahuan tentang layanan Disnaker (kartu AK/I, bursa kerja, pelatihan)', 'type' => 'one', 'o' => ["Pernah memakai", "Pernah dengar, belum memakai", "Belum pernah dengar"]],
                ['c' => 'K24', 'l' => 'Hambatan yang paling dikhawatirkan untuk mendapat pekerjaan', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Lowongan sedikit", "Keterampilan belum cukup", "Belum punya pengalaman", "Biaya kuliah/pelatihan", "Upah rendah", "Syarat umur/penampilan", "Lainnya"]],
                ['c' => 'K25', 'l' => 'Dukungan yang paling dibutuhkan dari sekolah atau pemerintah daerah', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => ["Informasi lowongan", "Pelatihan keterampilan", "Magang di perusahaan", "Beasiswa", "Modal usaha", "Bimbingan karier"]],
                ['c' => 'K26', 'l' => 'Lapangan usaha pekerjaan utama orang tua atau wali', 'type' => 'one', 'o' => array_merge($SEKTOR, ["Pemerintahan/ASN", "Tidak bekerja"])]
            ]
        ],
        [
            't' => 'E. Green job (pekerjaan ramah lingkungan)',
            'qs' => [
                ['c' => 'K27', 'l' => 'Sebelum membaca penjelasan di atas, apakah kamu pernah mendengar istilah green job atau pekerjaan hijau?', 'type' => 'one', 'o' => $TAHU_HIJAU],
                ['c' => 'K28', 'l' => 'Apakah kamu tertarik bekerja di bidang green job setelah lulus?', 'type' => 'one', 'o' => $MINAT_HIJAU],
                ['c' => 'K29', 'l' => 'Bidang green job apa yang paling kamu minati?', 'note' => 'boleh lebih dari satu', 'type' => 'many', 'o' => $BIDANG_HIJAU]
            ]
        ]
    ],
    'E' => [
        [
            't' => 'Identitas narasumber',
            'qs' => [
                ['c' => 'S1', 'l' => 'Kelompok narasumber', 'type' => 'one', 'o' => ["Perencana dan pengelola program", "Penyedia pelatihan dan pendidikan", "Dunia usaha", "Pekerja/serikat pekerja", "Penempatan dan migrasi kerja"], 'req' => 1],
                ['c' => 'S2', 'l' => 'Nama lembaga', 'type' => 'text', 'req' => 1],
                ['c' => 'S3', 'l' => 'Jabatan narasumber', 'type' => 'text'],
                ['c' => 'S5', 'l' => 'Bentuk kegiatan', 'type' => 'one', 'o' => ["Wawancara mendalam", "FGD"]]
            ]
        ],
        [
            't' => 'Bagian 1. Pertimbangan mana yang lebih penting?',
            'qs' => makePairQs("W", $AHP_KRIT)
        ]
    ]
];

// Tambahkan matriks pairwise isu per kriteria pada E
foreach ($AHP_KRIT as $ix => $k) {
    $SCHEMA['E'][] = [
        't' => 'Bagian ' . ($ix + 2) . '. Dilihat dari: ' . $k,
        'qs' => makePairQs('X' . ($ix + 1) . '_', $AHP_ISU)
    ];
}

// Bersihkan data lama SurveiId = 4
$pdo->beginTransaction();
$pdo->exec("DELETE FROM `survei_pertanyaan` WHERE `SurveiId` = {$surveiId}");

$insertStmt = $pdo->prepare("INSERT INTO `survei_pertanyaan` 
    (`SurveiId`, `Instrumen`, `Pertanyaan`, `Deskripsi`, `Section`, `Tipe`, `OpsiPilihan`, `IsRequired`, `Urutan`, `ScaleMin`, `ScaleMax`, `ScaleMinLabel`, `ScaleMaxLabel`, `CreatedAt`, `UpdatedAt`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");

$totalInserted = 0;
$countsByInst = [];

foreach ($SCHEMA as $inst => $blocks) {
    $urutan = 1;
    $countsByInst[$inst] = 0;
    foreach ($blocks as $b) {
        $secTitle = $b['t'];
        foreach ($b['qs'] as $q) {
            $code = $q['c'];
            $fullTitle = '[' . $code . '] ' . $q['l'];
            $note = $q['note'] ?? '';
            $qType = $q['type'];
            
            // Map type ke tipe DB
            $dbType = 'text';
            $opsiJson = null;
            $scaleMin = 1;
            $scaleMax = 5;
            $scaleMinLabel = 'Sangat Kurang';
            $scaleMaxLabel = 'Sangat Baik';

            if ($qType === 'one') {
                $dbType = 'radio';
                $opsiArr = array_map(function($o, $idx) { return ['label' => $o, 'nilai' => ($idx + 1)]; }, $q['o'], array_keys($q['o']));
                $opsiJson = json_encode($opsiArr);
            } elseif ($qType === 'many') {
                $dbType = 'checkbox';
                $opsiArr = array_map(function($o, $idx) { return ['label' => $o, 'nilai' => 1]; }, $q['o'], array_keys($q['o']));
                $opsiJson = json_encode($opsiArr);
            } elseif ($qType === 'scale') {
                $dbType = 'scale';
                $scaleFields = $q['f'] ?? [$q['l']];
                $opsiArr = array_map(function($f) { return ['label' => $f, 'nilai' => 1]; }, $scaleFields);
                $opsiJson = json_encode($opsiArr);
            } elseif ($qType === 'grid') {
                $dbType = 'grid';
                $gridFields = $q['f'] ?? [];
                $opsiArr = array_map(function($f) { return ['label' => $f, 'nilai' => 1]; }, $gridFields);
                $opsiJson = json_encode($opsiArr);
            } elseif ($qType === 'pair') {
                $dbType = 'pair';
                $opsiJson = json_encode([
                    ['label' => '9', 'nilai' => 9],
                    ['label' => '8', 'nilai' => 8],
                    ['label' => '7', 'nilai' => 7],
                    ['label' => '6', 'nilai' => 6],
                    ['label' => '5', 'nilai' => 5],
                    ['label' => '4', 'nilai' => 4],
                    ['label' => '3', 'nilai' => 3],
                    ['label' => '2', 'nilai' => 2],
                    ['label' => '1', 'nilai' => 1],
                    ['label' => '1/2', 'nilai' => 0.5],
                    ['label' => '1/3', 'nilai' => 0.3333],
                    ['label' => '1/4', 'nilai' => 0.25],
                    ['label' => '1/5', 'nilai' => 0.2],
                    ['label' => '1/6', 'nilai' => 0.1667],
                    ['label' => '1/7', 'nilai' => 0.1429],
                    ['label' => '1/8', 'nilai' => 0.125],
                    ['label' => '1/9', 'nilai' => 0.1111]
                ]);
            } elseif ($qType === 'num') {
                $dbType = 'number';
            } elseif ($qType === 'area') {
                $dbType = 'textarea';
            } elseif ($qType === 'date') {
                $dbType = 'date';
            } elseif ($qType === 'kec') {
                $dbType = 'dropdown';
                $opsiArr = array_map(function($k) { return ['label' => $k, 'nilai' => $k]; }, $KEC);
                $opsiJson = json_encode($opsiArr);
            }

            $req = !empty($q['req']) ? 1 : 0;

            $insertStmt->execute([
                $surveiId,
                $inst,
                $fullTitle,
                $note,
                $secTitle,
                $dbType,
                $opsiJson,
                $req,
                $urutan++,
                $scaleMin,
                $scaleMax,
                $scaleMinLabel,
                $scaleMaxLabel
            ]);

            $totalInserted++;
            $countsByInst[$inst]++;
        }
    }
}

$pdo->commit();

echo "BERHASIL SINKRONISASI PERTANYAAN RTKD BANYUWANGI:\n";
echo "Total butir pertanyaan masuk ke DB: $totalInserted\n";
foreach ($countsByInst as $inst => $c) {
    echo "  - Instrumen $inst: $c butir pertanyaan\n";
}
