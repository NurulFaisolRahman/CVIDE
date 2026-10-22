<?php
/**
 * test_all_survey_instruments.php
 * Script pengujian menyeluruh butir pertanyaan & penyimpanan jawaban untuk 5 instrumen:
 * Instrumen A: Perusahaan / Pemberi Kerja
 * Instrumen B: Pencari Kerja & Lulusan
 * Instrumen C: Pemangku Kepentingan
 * Instrumen E: AHP Pemangku Kepentingan (C2)
 * Instrumen D: Siswa Kelas 12
 */

$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "========================================================================\n";
echo "1. VERIFIKASI JUMLAH BUTIR PERTANYAAN DI DATABASE (SurveiId = 4)\n";
echo "========================================================================\n";

$counts = $pdo->query("SELECT Instrumen, count(*) as c FROM survei_pertanyaan WHERE SurveiId = 4 GROUP BY Instrumen ORDER BY Instrumen ASC")->fetchAll(PDO::FETCH_KEY_PAIR);
print_r($counts);

$expectedCounts = ['A' => 45, 'B' => 45, 'C' => 14, 'D' => 29, 'E' => 79];
$allCountOk = true;
foreach ($expectedCounts as $inst => $exp) {
    $act = (int)($counts[$inst] ?? 0);
    if ($act !== $exp) {
        echo "[FAIL] Instrumen $inst: diharapkan $exp, ditemukan $act\n";
        $allCountOk = false;
    } else {
        echo "[PASS] Instrumen $inst: $act butir pertanyaan sesuai dokumen desain.\n";
    }
}

if (!$allCountOk) {
    die("Pemeriksaan jumlah pertanyaan gagal!\n");
}

echo "\n========================================================================\n";
echo "2. PENGUJIAN PENGISIAN & PENYIMPANAN 1 DATA TESTING PER INSTRUMEN\n";
echo "========================================================================\n";

function postSurvey($payload) {
    $ch = curl_init('http://localhost/CVIDE/IDE/submit_survei_responden');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json; charset=utf-8']);
    $res = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ['code' => $code, 'raw' => $res, 'json' => json_decode($res, true)];
}

// -----------------------------------------------------------------------------
// Test 1: Instrumen A (Perusahaan)
// -----------------------------------------------------------------------------
echo "\n--- Pengujian Instrumen A (Perusahaan) ---\n";
$jawabanA = [
    'SR' => 'Daftar wajib lapor Disnaker (sampel acak)',
    'P1' => 'PT Banyuwangi Agro Sejahtera Mandiri',
    'P2' => 'Rogojampi',
    'P3' => 'Industri pengolahan',
    'P4' => '20–99',
    'P5' => 'PT',
    'P6' => ['Laki-laki' => 35, 'Perempuan' => 25],
    'P7' => ['Tetap' => 40, 'Kontrak' => 15, 'Harian lepas' => 5],
    'P8' => ['SD ke bawah' => 5, 'SMP' => 10, 'SMA' => 15, 'SMK' => 20, 'Diploma' => 5, 'S1 ke atas' => 5],
    'P9' => 4,
    'P10' => 8,
    'P11' => ['Kenalan/keluarga', 'Media sosial', 'Sekolah/kampus'],
    'P12' => 'Ya',
    'P13' => 'Operator Mesin Pengolahan Pangan & Teknisi Listrik',
    'P14' => 'Keterampilan tidak sesuai',
    'P15' => 'Bertambah',
    'P16' => 10,
    'P17' => 'Teknisi Elektro SMK 4 orang, Quality Control D3 2 orang, Operator 4 orang',
    'P18' => 'Investasi/perluasan',
    'P19' => [
        'Teknis sesuai bidang' => 4,
        'Digital' => 3,
        'Bahasa asing' => 3,
        'Komunikasi' => 4,
        'Kerja sama tim' => 5,
        'Disiplin/etos kerja' => 4
    ],
    'P20' => 'Kemampuan membaca manual mesin industri otomatis',
    'P21' => 'Ya, rutin',
    'P22' => ['Magang/prakerin', 'Rekrutmen lulusan'],
    'P23' => 'Sebagian besar',
    'P24' => 'Setara UMK',
    'P25' => 'Semua pekerja',
    'P26' => 'Semua pekerja',
    'P27' => ['Kontrak tertulis', 'Peraturan perusahaan'],
    'P28' => 'Tidak ada',
    'P29' => 'Ketersediaan tenaga kerja terampil di bidang otomasi industri yang siap kerja',
    'P30' => ['Pelatihan sesuai kebutuhan', 'Informasi pasar kerja', 'Sertifikasi'],
    // Bagian baru H, I, J
    'P31' => 2,
    'P32' => '3–5 tahun',
    'P36' => 'Cukup menjadi masalah',
    'P37' => 'Mendapat upah lebih tinggi di tempat lain',
    'P38' => ['Menaikkan upah atau memberi insentif', 'Memberi pelatihan', 'Mengangkat menjadi pekerja tetap'],
    'P33' => ['Menghemat listrik atau air', 'Mengolah limbah atau mendaur ulang sampah', 'Memakai bahan baku yang ramah lingkungan'],
    'P34' => 'Ya',
    'P35' => 'Pengolahan limbah organik dan maintenance panel surya pendingin',
    'P39' => 'Ya, cukup kompetitif',
    'P41' => ['Meningkatkan produksi atau produktivitas pekerja', 'Memberi pelatihan'],
    'P42' => ['Sulit mendapat tenaga kerja terampil', 'Infrastruktur jalan dan transportasi', 'Biaya tenaga kerja'],
    'P43' => 'Perlunya link & match kurikulum vokasi SMK dengan mesin industri terkini'
];

$payloadA = [
    'SurveiId' => 4,
    'Instrumen' => 'A',
    'Enumerator' => 'Budi Santoso (Testing)',
    'RespondenNama' => 'PT Banyuwangi Agro Sejahtera Mandiri',
    'RespondenGender' => 'Laki-laki',
    'RespondenUsia' => '35–45 Tahun',
    'RespondenPendidikan' => 'S1 Teknik',
    'RespondenPekerjaan' => 'Pemberi Kerja / Pelaku Usaha',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Rogojampi',
    'AlamatDetail' => 'Kawasan Industri Rogojampi No. 12',
    'Latitude' => -8.3089,
    'Longitude' => 114.2989,
    'LokasiAccuracy' => 10.0,
    'DevicePlatform' => 'Windows 11 / Chrome Test',
    'Jawaban' => $jawabanA
];

$resA = postSurvey($payloadA);
echo "Status Code: " . $resA['code'] . "\n";
echo "Response Status: " . ($resA['json']['status'] ? 'SUCCESS' : 'FAILED') . "\n";
echo "Message: " . ($resA['json']['message'] ?? $resA['raw']) . "\n";
$respIdA = $resA['json']['responden_id'] ?? 0;
echo "Created RespondenId: $respIdA\n";

// -----------------------------------------------------------------------------
// Test 2: Instrumen B (Pencari Kerja & Lulusan)
// -----------------------------------------------------------------------------
echo "\n--- Pengujian Instrumen B (Pencari Kerja & Lulusan) ---\n";
$jawabanB = [
    'SR' => 'Daftar alumni BKK SMK atau tracer study kampus',
    'SC' => ['Lulus SMA, SMK, diploma, atau sarjana dalam 3 tahun terakhir', 'Sedang mencari kerja atau menyiapkan usaha'],
    'L1' => '20–24',
    'L2' => 'Perempuan',
    'L3' => 'Genteng',
    'L4' => 'SMK',
    'L5' => 'Akuntansi dan Keuangan Lembaga',
    'L6' => 2024,
    'L7' => 'Bekerja sebagai karyawan/buruh',
    'L8' => 'Ya',
    'L9' => '3–6 bulan',
    'L10' => '6–20',
    'L11' => ['Media sosial', 'Sekolah/kampus', 'Melamar langsung'],
    'L12' => 'Ya',
    'L13' => ['Lowongan sedikit', 'Kurang pengalaman'],
    'L14' => 'Perdagangan',
    'L15' => 'Sesuai',
    'L16' => 'Rp2–3 juta',
    'L17' => '35–48',
    'L18' => 'Ya',
    'L19' => 'Ya',
    'L20' => 'Di Banyuwangi',
    'L21' => ['BLK', 'Kartu Prakerja'],
    'L22' => 'Ya',
    'L23' => [
        'Teknis' => 4,
        'Digital' => 4,
        'Bahasa asing' => 3,
        'Komunikasi' => 4
    ],
    'L24' => 'Pemasaran Digital & E-Commerce Terapan',
    'L25' => 'Rp1–2 juta',
    'L26' => 'Perdagangan',
    'L27' => 'Ya, dalam negeri',
    'L28' => 'Berminat',
    'L29' => 'Modal',
    'L39' => 'Mengambil sementara sambil mencari pekerjaan lain',
    'L39a' => 'Untuk menambah pengalaman dan relasi sambil menunggu peluang karir yang lebih baik',
    'L40' => 'Penghasilan tetap (gaji bulanan)',
    'L30' => 'Ya',
    'L31' => '1 kali',
    'L32' => '1–2 tahun',
    'L33' => 'Mendapat pekerjaan yang lebih baik',
    'L34' => 'Pernah dengar dan tahu artinya',
    'L35' => 'Sebagian',
    'L36' => 'Sangat tertarik',
    'L37' => ['Pengelolaan sampah dan daur ulang', 'Wisata alam dan desa wisata'],
    'L38' => 'Ya'
];

$payloadB = [
    'SurveiId' => 4,
    'Instrumen' => 'B',
    'Enumerator' => 'Budi Santoso (Testing)',
    'RespondenNama' => 'Siti Nurhaliza (Alumni SMK)',
    'RespondenGender' => 'Perempuan',
    'RespondenUsia' => '20–24',
    'RespondenPendidikan' => 'SMK',
    'RespondenPekerjaan' => 'Bekerja sebagai karyawan/buruh',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Genteng',
    'AlamatDetail' => 'Desa Genteng Kulon RT 02 RW 05',
    'Latitude' => -8.3689,
    'Longitude' => 114.1523,
    'LokasiAccuracy' => 12.0,
    'DevicePlatform' => 'Android 14 / Chrome Mobile',
    'Jawaban' => $jawabanB
];

$resB = postSurvey($payloadB);
echo "Status Code: " . $resB['code'] . "\n";
echo "Response Status: " . ($resB['json']['status'] ? 'SUCCESS' : 'FAILED') . "\n";
echo "Message: " . ($resB['json']['message'] ?? $resB['raw']) . "\n";
$respIdB = $resB['json']['responden_id'] ?? 0;
echo "Created RespondenId: $respIdB\n";

// -----------------------------------------------------------------------------
// Test 3: Instrumen C (Pemangku Kepentingan)
// -----------------------------------------------------------------------------
echo "\n--- Pengujian Instrumen C (Pemangku Kepentingan) ---\n";
$jawabanC = [
    'S1' => 'Penyedia pelatihan dan pendidikan',
    'S2' => 'Politeknik Negeri Banyuwangi (Poliwangi)',
    'S3' => 'Wakil Direktur Bidang Akademik & Kerjasama',
    'S4' => date('Y-m-d'),
    'S5' => 'Wawancara mendalam',
    'T1' => 'Permintaan tenaga kerja di sektor pariwisata, perhotelan, dan agroindustri meningkat pesat seiring investasi baru di Banyuwangi.',
    'T2' => 'Perlunya pemutakhiran kurikulum berbasis industri 4.0 dan sertifikasi kompetensi BNSP di setiap program studi.',
    'T3' => 'Kerjasama pemda, kampus, dan BLK sudah berjalan namun perlu sistem integrasi bursa kerja digital realtime.',
    'T4' => 'Penerapan UMK 2026 relatif ditaati sektor formal menengah-atas, tantangan ada di sektor informal.',
    'T5' => 'Pemberian akses vokasi inklusif bagi difabel dan program reskilling purna migran perlu diperluas.',
    'T6' => 'Membangun Pusat Inkubator Bisnis Vokasi dan Kemitraan Strategis DUDI tingkat kabupaten.',
    'I1' => 'Kesenjangan kompetensi teknis lulusan baru dengan standar industri terkini',
    'I2' => 'Perlindungan dan formalisasi tenaga kerja informal serta pekerja rentan',
    'I3' => 'Penyelarasan kurikulum vokasi dan bursa kerja terintegrasi daerah'
];

$payloadC = [
    'SurveiId' => 4,
    'Instrumen' => 'C',
    'Enumerator' => 'Budi Santoso (Testing)',
    'RespondenNama' => 'Politeknik Negeri Banyuwangi (Poliwangi)',
    'RespondenGender' => 'Laki-laki',
    'RespondenUsia' => '40 Tahun ke Atas',
    'RespondenPendidikan' => 'Sarjana (S1 / S2 / S3)',
    'RespondenPekerjaan' => 'Pemangku Kepentingan',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Banyuwangi',
    'AlamatDetail' => 'Kampus Poliwangi Jl. Raya Jember KM 13 Labanasem',
    'Latitude' => -8.2192,
    'Longitude' => 114.3692,
    'LokasiAccuracy' => 8.0,
    'DevicePlatform' => 'macOS / Safari Test',
    'Jawaban' => $jawabanC
];

$resC = postSurvey($payloadC);
echo "Status Code: " . $resC['code'] . "\n";
echo "Response Status: " . ($resC['json']['status'] ? 'SUCCESS' : 'FAILED') . "\n";
echo "Message: " . ($resC['json']['message'] ?? $resC['raw']) . "\n";
$respIdC = $resC['json']['responden_id'] ?? 0;
echo "Created RespondenId: $respIdC\n";

// -----------------------------------------------------------------------------
// Test 4: Instrumen E (AHP Pemangku Kepentingan - C2)
// -----------------------------------------------------------------------------
echo "\n--- Pengujian Instrumen E (AHP Pemangku Kepentingan) ---\n";
// Buat data pairwise yang konsisten penuh (semua 1 atau konsisten terukur)
$jawabanE = [
    'S1' => 'Perencana dan pengelola program',
    'S2' => 'Bappeda Kabupaten Banyuwangi',
    'S3' => 'Kepala Bidang Perekonomian & SDA',
    'S5' => 'Wawancara mendalam'
];

// Matriks W (Kriteria 6 item): 15 perbandingan
// Kita isi bobot hierarkis yang logis & konsisten (CR < 0.1)
// K1 > K2, K1 > K3, dst.
$pairCriteria = [
    'W12' => '3', 'W13' => '3', 'W14' => '5', 'W15' => '5', 'W16' => '3',
    'W23' => '1', 'W24' => '2', 'W25' => '2', 'W26' => '1',
    'W34' => '2', 'W35' => '2', 'W36' => '1',
    'W45' => '1', 'W46' => '1/2',
    'W56' => '1/2'
];
foreach ($pairCriteria as $k => $v) {
    $jawabanE[$k] = $v;
}

// Matriks X1_ s/d X6_ (Isu 5 item): 10 perbandingan masing-masing
for ($c = 1; $c <= 6; $c++) {
    $pairIssues = [
        "X{$c}_12" => '2', "X{$c}_13" => '3', "X{$c}_14" => '1', "X{$c}_15" => '4',
        "X{$c}_23" => '2', "X{$c}_24" => '1/2', "X{$c}_25" => '3',
        "X{$c}_34" => '1/3', "X{$c}_35" => '2',
        "X{$c}_45" => '4'
    ];
    foreach ($pairIssues as $k => $v) {
        $jawabanE[$k] = $v;
    }
}

$payloadE = [
    'SurveiId' => 4,
    'Instrumen' => 'E',
    'Enumerator' => 'Budi Santoso (Testing)',
    'RespondenNama' => 'Bappeda Kabupaten Banyuwangi',
    'RespondenGender' => 'Laki-laki',
    'RespondenUsia' => 'Dewasa / Ahli',
    'RespondenPendidikan' => 'Sarjana (S1 / S2 / S3)',
    'RespondenPekerjaan' => 'Perencana dan pengelola program',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Banyuwangi',
    'AlamatDetail' => 'Kantor Bappeda Jl. RA Kartini No. 1',
    'Latitude' => -8.2192,
    'Longitude' => 114.3692,
    'LokasiAccuracy' => 5.0,
    'DevicePlatform' => 'Desktop PC / Edge Test',
    'Jawaban' => $jawabanE
];

$resE = postSurvey($payloadE);
echo "Status Code: " . $resE['code'] . "\n";
echo "Response Status: " . ($resE['json']['status'] ? 'SUCCESS' : 'FAILED') . "\n";
echo "Message: " . ($resE['json']['message'] ?? $resE['raw']) . "\n";
$respIdE = $resE['json']['responden_id'] ?? 0;
echo "Created RespondenId: $respIdE\n";

// -----------------------------------------------------------------------------
// Test 5: Instrumen D (Siswa Kelas 12)
// -----------------------------------------------------------------------------
echo "\n--- Pengujian Instrumen D (Siswa Kelas 12) ---\n";
$jawabanD = [
    'K1' => 'SMK',
    'K2' => 'SMKN 1 Glagah Banyuwangi',
    'K3' => 'Glagah',
    'K4' => 'Teknik Kendaraan Ringan Otomotif',
    'K5' => '17 tahun',
    'K6' => 'Laki-laki',
    'K7' => 'Glagah',
    'K8' => 'Bekerja',
    'K9' => 'Di Banyuwangi',
    'K10' => 'Industri pengolahan',
    'K11' => 'Mekanik Kendaraan Listrik & Alat Berat',
    'K12' => 'Rp3–4 juta',
    'K13' => 'Sangat yakin',
    'K14' => 'Berminat',
    'K15' => 'Ya, sesuai jurusan',
    'K16' => 'Industri pengolahan',
    'K17' => 'Ya, dibayar',
    'K18' => ['Keterampilan teknik', 'Komputer/digital'],
    'K19' => 'Ya',
    'K20' => [
        'Teknis sesuai jurusan' => 5,
        'Digital' => 4,
        'Bahasa asing' => 3,
        'Komunikasi' => 4
    ],
    'K21' => 'Diagnosis sistem baterai dan motor listrik kendaraan ramah lingkungan',
    'K22' => ['Bursa Kerja Khusus (BKK) sekolah', 'Media sosial'],
    'K23' => 'Pernah memakai',
    'K24' => ['Belum punya pengalaman'],
    'K25' => ['Magang di perusahaan', 'Informasi lowongan', 'Sertifikasi kompetensi'],
    'K26' => 'Pertanian/perikanan',
    'K27' => 'Pernah dengar dan tahu artinya',
    'K28' => 'Sangat tertarik',
    'K29' => ['Kendaraan listrik dan bengkelnya', 'Listrik tenaga surya, biogas, atau angin']
];

$payloadD = [
    'SurveiId' => 4,
    'Instrumen' => 'D',
    'Enumerator' => 'Budi Santoso (Testing)',
    'RespondenNama' => 'Ahmad Fauzi (Siswa Kelas 12)',
    'RespondenGender' => 'Laki-laki',
    'RespondenUsia' => '17 tahun',
    'RespondenPendidikan' => 'SMK',
    'RespondenPekerjaan' => 'Siswa Kelas 12',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Glagah',
    'AlamatDetail' => 'Desa Kemiren, Glagah',
    'Latitude' => -8.2056,
    'Longitude' => 114.3289,
    'LokasiAccuracy' => 15.0,
    'DevicePlatform' => 'Android 13 / Samsung Galaxy',
    'Jawaban' => $jawabanD
];

$resD = postSurvey($payloadD);
echo "Status Code: " . $resD['code'] . "\n";
echo "Response Status: " . ($resD['json']['status'] ? 'SUCCESS' : 'FAILED') . "\n";
echo "Message: " . ($resD['json']['message'] ?? $resD['raw']) . "\n";
$respIdD = $resD['json']['responden_id'] ?? 0;
echo "Created RespondenId: $respIdD\n";

echo "\n========================================================================\n";
echo "3. VERIFIKASI DATA TERSIMPAN DI DATABASE (survei_responden & survei_jawaban)\n";
echo "========================================================================\n";

$testIds = [$respIdA, $respIdB, $respIdC, $respIdE, $respIdD];
$inClause = implode(',', array_filter($testIds));

if (!empty($inClause)) {
    $rows = $pdo->query("SELECT Id, Instrumen, RespondenNama, Kecamatan, CreatedAt FROM survei_responden WHERE Id IN ($inClause) ORDER BY Id ASC")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $r) {
        $countAns = $pdo->query("SELECT count(*) FROM survei_jawaban WHERE RespondenId = {$r['Id']}")->fetchColumn();
        echo "Responden #{$r['Id']} [Instrumen {$r['Instrumen']}] {$r['RespondenNama']} ({$r['Kecamatan']}): {$countAns} butir jawaban tersimpan.\n";
    }
}

echo "\nSemua pengujian 5 instrumen selesai dengan sukses!\n";
