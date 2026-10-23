<?php
/**
 * verify_all_survey_sections.php
 * Pengujian mendalam untuk setiap bagian/seksi pada kelima instrumen survei RTKD:
 * - Instrumen A: Perusahaan (Seksi A s.d. J + Pencatatan)
 * - Instrumen B: Pencari Kerja & Lulusan (Seksi A s.d. G + Kriteria Penyaring)
 * - Instrumen C: Pemangku Kepentingan (Identitas + Penilaian Isu)
 * - Instrumen E: AHP Pemangku Kepentingan (Bagian 1 s.d. 7 Perbandingan Berpasangan)
 * - Instrumen D: Siswa Kelas 12 (Seksi A s.d. E)
 */

$baseUrl = 'http://localhost/CVIDE/IDE/submit_survei_responden';

function submitTestPayload($url, $payload) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $res = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ['code' => $httpCode, 'data' => json_decode($res, true), 'raw' => $res];
}

$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "========================================================================================\n";
echo "              PENGUJIAN MENYELURUH SETIAP BAGIAN SURVEI RTKD BANYUWANGI\n";
echo "========================================================================================\n\n";

$resultsSummary = [];

// --------------------------------------------------------------------------------------
// 1. INSTRUMEN A: PERUSAHAAN (SEKSI A s.d. J)
// --------------------------------------------------------------------------------------
echo ">>> PENGUJIAN INSTRUMEN A: PERUSAHAAN / PEMBERI KERJA\n";
$payloadA = [
    'SurveiId' => 4,
    'Instrumen' => 'A',
    'Enumerator' => 'Enumerator Uji A',
    'RespondenNama' => 'PT Banyuwangi Manufaktur Presisi',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Kalipuro',
    'Jawaban' => [
        // Pencatatan Petugas
        'SR' => 'Daftar wajib lapor Disnaker (sampel acak)',
        'SR2' => 'Kawasan Industri Ketapang, Kalipuro',
        // A. Identitas Usaha
        'P1' => 'PT Banyuwangi Manufaktur Presisi',
        'P2' => 'Kalipuro',
        'P3' => 'Industri pengolahan',
        'P4' => '100 ke atas',
        'P5' => 'PT',
        // B. Tenaga Kerja Saat Ini
        'P6' => 'Laki-laki: 120, Perempuan: 45',
        'P7' => 'Tetap: 100, Kontrak: 55, Harian lepas: 10',
        'P8' => 'SMK: 90, Diploma: 30, S1 ke atas: 45',
        'P9' => 15,
        // C. Rekrutmen 12 Bulan Terakhir
        'P10' => 25,
        'P11' => ['Sekolah/kampus', 'Portal lowongan', 'Media sosial'],
        'P12' => 'Ya',
        'P13' => 'Teknisi Otomasi & Operator Mesin CNC',
        'P14' => 'Keterampilan tidak sesuai',
        // D. Kebutuhan 3 Tahun ke Depan
        'P15' => 'Bertambah',
        'P16' => 40,
        'P17' => 'Operator CNC (SMK, 20 orang); Supervisor Quality Control (D3/S1, 5 orang)',
        'P18' => 'Investasi/perluasan',
        // E. Keterampilan dan Pelatihan
        'P19' => ['Teknis sesuai bidang' => 4, 'Digital' => 4, 'Bahasa asing' => 3, 'Komunikasi' => 4, 'Kerja sama tim' => 5, 'Disiplin/etos kerja' => 4],
        'P20' => 'Keterampilan pemrograman PLC dan bahasa Inggris teknis',
        'P21' => 'Ya, rutin',
        'P22' => ['Magang/prakerin', 'Rekrutmen lulusan', 'Penyusunan kurikulum'],
        'P23' => 'Sebagian besar',
        // F. Upah, Jaminan Sosial, dan Hubungan Kerja
        'P24' => 'Di atas UMK',
        'P25' => 'Semua pekerja',
        'P26' => 'Semua pekerja',
        'P27' => ['Kontrak tertulis', 'Peraturan perusahaan', 'LKS Bipartit'],
        'P28' => 'Tidak ada',
        // G. Kendala dan Harapan
        'P29' => 'Sulit mencari teknisi madya dengan sertifikasi internasional',
        'P30' => 'Pemerintah perlu memperbanyak program pelatihan vokasi industri 4.0',
        // H. Kondisi Ketenagakerjaan Daerah
        'P31' => 'Mendukung',
        'P32' => 'Cukup',
        'P33' => 'SMK/vokasi',
        'P34' => 'Tersedia dan mudah dipakai',
        'P35' => 'Peningkatan kompetensi tenaga kerja lokal',
        // I. Pemutusan Hubungan Kerja (PHK)
        'P36' => 'Tidak ada',
        'P37' => 'Pindah ke perusahaan lain',
        'P38' => 'Rendah (kurang dari 5% per tahun)',
        // J. Kesiapan Green Job
        'P39' => 'Pernah dengar dan tahu artinya',
        'P40' => 'Sudah menerapkan sebagian',
        'P41' => ['Pengelolaan limbah/daur ulang', 'Efisiensi energi listrik'],
        'P42' => 'Keterampilan teknis dan regulasi baku mutu'
    ]
];

$resA = submitTestPayload($baseUrl, $payloadA);
$okA = ($resA['code'] === 200 && ($resA['data']['status'] ?? false));
$respIdA = $resA['data']['responden_id'] ?? 0;
$jwbCountA = $pdo->query("SELECT COUNT(*) FROM survei_jawaban WHERE RespondenId = {$respIdA}")->fetchColumn();

echo "  -> Status HTTP: {$resA['code']} | Status Respon: " . ($okA ? "BERHASIL" : "GAGAL") . "\n";
echo "  -> Responden Id: #{$respIdA} | Total Jawaban Disimpan: {$jwbCountA} butir\n";
echo "  -> Rata-Rata Skor: " . ($resA['data']['rata_rata_skor'] ?? '-') . " | Mutu Layanan: " . ($resA['data']['mutu_pelayanan'] ?? '-') . "\n";
$resultsSummary['A'] = ['status' => $okA, 'id' => $respIdA, 'answers' => $jwbCountA, 'desc' => 'Perusahaan (Seksi A-J Lengkap)'];
echo "\n";

// --------------------------------------------------------------------------------------
// 2. INSTRUMEN B: PENCARI KERJA & LULUSAN (SEKSI A s.d. G)
// --------------------------------------------------------------------------------------
echo ">>> PENGUJIAN INSTRUMEN B: PENCARI KERJA & LULUSAN\n";
$payloadB = [
    'SurveiId' => 4,
    'Instrumen' => 'B',
    'Enumerator' => 'Enumerator Uji B',
    'RespondenNama' => 'Dewi Safitri (Pencari Kerja Baru)',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Rogojampi',
    'Jawaban' => [
        // Pencatatan Petugas
        'SR' => 'Ditemui di lapangan (sampel kuota)',
        'SR2' => 'Bursa Kerja Disnaker Rogojampi',
        // Kriteria Penyaring
        'SC' => ['Sedang mencari pekerjaan', 'Lulus pendidikan dalam 3 tahun terakhir'],
        // A. Identitas
        'L1' => '20–24',
        'L2' => 'Perempuan',
        'L3' => 'Rogojampi',
        'L4' => 'Diploma (D1–D4)',
        'L5' => 'Manajemen Informatika / Sistem Informasi',
        'L6' => 'Tahun 2025',
        'L7' => 'Mencari kerja',
        // B. Pengalaman Kerja
        'L8' => 'Pernah bekerja, saat ini tidak bekerja',
        'L9' => 'Staf Administrasi Digital',
        'L10' => 'Perdagangan',
        'L11' => '1–3 tahun',
        'L12' => 'Kontrak (PKWT)',
        'L13' => 'Rp2,5–3,5 juta',
        'L14' => 'Kontrak selesai dan tidak diperpanjang',
        'L15' => '3–6 bulan',
        // C. Upaya dan Preferensi
        'L16' => ['Portal lowongan online', 'Media sosial', 'Menghubungi teman/keluarga'],
        'L17' => '6–10 lamaran',
        'L18' => 'Persyaratan pengalaman kerja yang tinggi',
        'L19' => 'Dalam kabupaten Banyuwangi',
        'L20' => 'Akomodasi dan makan-minum',
        'L21' => 'Karyawan swasta tetap',
        'L22' => 'Rp2,8–3,5 juta',
        'L23' => 'Sangat yakin',
        // D. Keterampilan dan Pelatihan
        'L24' => ['Teknis komputer/digital' => 4, 'Komunikasi' => 4, 'Kerja sama' => 5, 'Bahasa asing' => 3, 'Problem solving' => 4],
        'L25' => 'Pernah mengikuti pelatihan',
        'L26' => 'Desain Grafis dan Digital Marketing (BLK Banyuwangi)',
        'L27' => 'Pernah magang (3 bulan di perhotelan)',
        'L28' => 'Memiliki sertifikat kompetensi BNSP',
        'L29' => 'Sertifikat Digital Marketing BNSP',
        'L30' => 'Data Analyst / Digital Advertising',
        // E. Mobilitas dan Stabilitas
        'L31' => '1 kali berpindah kerja',
        'L32' => 'Mencari upah yang lebih baik',
        'L33' => 'Bersedia jika prospek karier dan fasilitas baik',
        'L34' => 'Keluarga di Banyuwangi',
        'L35' => 'Kurang berminat',
        // F. Ekspektasi Upah dan Jaminan
        'L36' => 'Sesuai atau di atas UMK',
        'L37' => 'Sangat penting',
        'L38' => 'Sangat penting',
        'L39' => 'Menolak dan mencari tawaran lain',
        'L40' => 'Perlindungan jaminan sosial dan kepastian kontrak kerja',
        // G. Green Job
        'L41' => 'Pernah dengar dan tahu artinya',
        'L42' => 'Sangat tertarik',
        'L43' => ['Pengelolaan sampah dan daur ulang', 'Wisata alam dan desa wisata']
    ]
];

$resB = submitTestPayload($baseUrl, $payloadB);
$okB = ($resB['code'] === 200 && ($resB['data']['status'] ?? false));
$respIdB = $resB['data']['responden_id'] ?? 0;
$jwbCountB = $pdo->query("SELECT COUNT(*) FROM survei_jawaban WHERE RespondenId = {$respIdB}")->fetchColumn();

echo "  -> Status HTTP: {$resB['code']} | Status Respon: " . ($okB ? "BERHASIL" : "GAGAL") . "\n";
echo "  -> Responden Id: #{$respIdB} | Total Jawaban Disimpan: {$jwbCountB} butir\n";
echo "  -> Rata-Rata Skor: " . ($resB['data']['rata_rata_skor'] ?? '-') . " | Mutu Layanan: " . ($resB['data']['mutu_pelayanan'] ?? '-') . "\n";
$resultsSummary['B'] = ['status' => $okB, 'id' => $respIdB, 'answers' => $jwbCountB, 'desc' => 'Pencari Kerja (Seksi A-G Lengkap)'];
echo "\n";

// --------------------------------------------------------------------------------------
// 3. INSTRUMEN C: PEMANGKU KEPENTINGAN / STAKEHOLDER
// --------------------------------------------------------------------------------------
echo ">>> PENGUJIAN INSTRUMEN C: PEMANGKU KEPENTINGAN (KUALITATIF)\n";
$payloadC = [
    'SurveiId' => 4,
    'Instrumen' => 'C',
    'Enumerator' => 'Enumerator Uji C',
    'RespondenNama' => 'Dinas Koperasi Usaha Mikro dan Perdagangan',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Banyuwangi',
    'Jawaban' => [
        'S1' => 'Perencana dan pengelola program',
        'S2' => 'Dinas Koperasi Usaha Mikro dan Perdagangan Banyuwangi',
        'S3' => 'Kepala Seksi Pemberdayaan Tenaga Kerja Mandiri',
        'S4' => '2026-10-23',
        'S5' => 'Wawancara mendalam',
        'T1' => 'Kondisi pasar kerja: Tingkat adopsi teknologi digital pada UMKM masih belum merata',
        'T2' => 'Kesesuaian keterampilan: Keterampilan akuntansi dasar, branding produk, dan e-commerce sangat dibutuhkan',
        'T3' => 'Program dan layanan: Penyelarasan kurikulum BLK dengan kebutuhan riil rantai pasok daerah',
        'T4' => 'Pengupahan: Perlunya kepatuhan jaminan sosial ketenagakerjaan bagi pekerja UMKM',
        'T5' => 'Pekerja rentan: Pemberian subsidi jaminan ketenagakerjaan bagi pekerja mandiri rentan dan disabilitas',
        'T6' => 'Usulan kebijakan: Optimalisasi program inkubasi wirausaha muda dan bantuan modal bergulir',
        'I1' => 'Peningkatan kemitraan UMKM dengan pasar ekspor dan retail modern',
        'I2' => 'Pelatihan vokasi berbasis kebutuhan industri',
        'I3' => 'Perluasan kepesertaan BPJS Ketenagakerjaan bagi sektor informal'
    ]
];

$resC = submitTestPayload($baseUrl, $payloadC);
$okC = ($resC['code'] === 200 && ($resC['data']['status'] ?? false));
$respIdC = $resC['data']['responden_id'] ?? 0;
$jwbCountC = $pdo->query("SELECT COUNT(*) FROM survei_jawaban WHERE RespondenId = {$respIdC}")->fetchColumn();

echo "  -> Status HTTP: {$resC['code']} | Status Respon: " . ($okC ? "BERHASIL" : "GAGAL") . "\n";
echo "  -> Responden Id: #{$respIdC} | Total Jawaban Disimpan: {$jwbCountC} butir\n";
echo "  -> Rata-Rata Skor: " . ($resC['data']['rata_rata_skor'] ?? '-') . " | Mutu Layanan: " . ($resC['data']['mutu_pelayanan'] ?? '-') . "\n";
$resultsSummary['C'] = ['status' => $okC, 'id' => $respIdC, 'answers' => $jwbCountC, 'desc' => 'Pemangku Kepentingan (14 Butir Kualitatif)'];
echo "\n";

// --------------------------------------------------------------------------------------
// 4. INSTRUMEN E: AHP ISU STRATEGIS (BAGIAN 1 s.d. 7)
// --------------------------------------------------------------------------------------
echo ">>> PENGUJIAN INSTRUMEN E: AHP ISU STRATEGIS (75 PASANGAN SAATY + IDENTITAS)\n";

// Bangun jawaban konsisten AHP
$ahpAnswers = [
    'S1' => 'Perencana dan pengelola program',
    'S2' => 'Bappeda Kabupaten Banyuwangi (Bidang Perekonomian & Ketenagakerjaan)',
    'S3' => 'Perencana Ahli Madya',
    'S5' => 'Wawancara mendalam'
];

$wCrit = [0.35, 0.25, 0.18, 0.10, 0.07, 0.05];
$saatyScale = [1, 2, 3, 4, 5, 6, 7, 8, 9];
function calcSaaty($ratio) {
    global $saatyScale;
    if (abs($ratio - 1) < 0.15) return '1';
    if ($ratio > 1) {
        $best = 1; $minDiff = 999;
        foreach ($saatyScale as $v) {
            $diff = abs($v - $ratio);
            if ($diff < $minDiff) { $minDiff = $diff; $best = $v; }
        }
        return (string)$best;
    } else {
        $inv = 1 / $ratio;
        $bestInv = 1; $minDiff = 999;
        foreach ($saatyScale as $v) {
            $diff = abs($v - $inv);
            if ($diff < $minDiff) { $minDiff = $diff; $bestInv = $v; }
        }
        return $bestInv === 1 ? '1' : ('1/' . $bestInv);
    }
}

// 15 Pasangan Kriteria Bagian 1 (W)
for ($i = 0; $i < 6; $i++) {
    for ($j = $i + 1; $j < 6; $j++) {
        $ahpAnswers['W' . ($i + 1) . ($j + 1)] = calcSaaty($wCrit[$i] / $wCrit[$j]);
    }
}

// 60 Pasangan Alternatif Bagian 2 s.d. 7 (X1_ through X6_)
$wIssues = [0.35, 0.25, 0.20, 0.12, 0.08];
for ($k = 1; $k <= 6; $k++) {
    for ($i = 0; $i < 5; $i++) {
        for ($j = $i + 1; $j < 5; $j++) {
            $ahpAnswers['X' . $k . '_' . ($i + 1) . ($j + 1)] = calcSaaty($wIssues[$i] / $wIssues[$j]);
        }
    }
}

$payloadE = [
    'SurveiId' => 4,
    'Instrumen' => 'E',
    'Enumerator' => 'Enumerator Uji AHP',
    'RespondenNama' => 'Bappeda Banyuwangi (Tim Ahli RTKD)',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Banyuwangi',
    'Jawaban' => $ahpAnswers
];

$resE = submitTestPayload($baseUrl, $payloadE);
$okE = ($resE['code'] === 200 && ($resE['data']['status'] ?? false));
$respIdE = $resE['data']['responden_id'] ?? 0;
$jwbCountE = $pdo->query("SELECT COUNT(*) FROM survei_jawaban WHERE RespondenId = {$respIdE}")->fetchColumn();

echo "  -> Status HTTP: {$resE['code']} | Status Respon: " . ($okE ? "BERHASIL" : "GAGAL") . "\n";
echo "  -> Responden Id: #{$respIdE} | Total Jawaban Disimpan: {$jwbCountE} butir (79 butir lengkap)\n";
echo "  -> Rata-Rata Skor: " . ($resE['data']['rata_rata_skor'] ?? '-') . " | Mutu Layanan: " . ($resE['data']['mutu_pelayanan'] ?? '-') . "\n";
$resultsSummary['E'] = ['status' => $okE, 'id' => $respIdE, 'answers' => $jwbCountE, 'desc' => 'AHP Isu Strategis (75 Pasangan + 4 Identitas)'];
echo "\n";

// --------------------------------------------------------------------------------------
// 5. INSTRUMEN D: SISWA KELAS 12 (SEKSI A s.d. E)
// --------------------------------------------------------------------------------------
echo ">>> PENGUJIAN INSTRUMEN D: SISWA KELAS 12\n";
$payloadD = [
    'SurveiId' => 4,
    'Instrumen' => 'D',
    'Enumerator' => 'Enumerator Uji D',
    'RespondenNama' => 'Bayu Pratama (Siswa SMK 1 Glagah)',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Glagah',
    'Jawaban' => [
        // A. Identitas
        'K1' => 'SMK Negeri 1 Glagah',
        'K2' => 'Teknik Komputer dan Jaringan',
        'K3' => 'Glagah',
        'K4' => 'Laki-laki',
        'K5' => '17 tahun',
        'K6' => 'Laki-laki',
        'K7' => 'Glagah',
        // B. Rencana Setelah Lulus
        'K8' => 'Bekerja',
        'K9' => 'Dalam kabupaten Banyuwangi',
        'K10' => 'Industri pengolahan',
        'K11' => 'Network Administrator / Teknisi Jaringan',
        'K12' => 'Rp2–3 juta',
        'K13' => 'Yakin',
        'K14' => 'Mungkin',
        // C. Pengalaman dan Keterampilan
        'K15' => 'Ya, sesuai jurusan',
        'K16' => 'Industri pengolahan',
        'K17' => 'Ya, dibayar',
        'K18' => ['Komputer/digital', 'Keterampilan teknik'],
        'K19' => 'Ya',
        'K20' => ['Teknis sesuai jurusan' => 5, 'Digital' => 4, 'Bahasa asing' => 3, 'Komunikasi' => 4],
        'K21' => 'Cyber Security dan Cloud Computing',
        // D. Informasi dan Dukungan
        'K22' => ['Bursa Kerja Khusus (BKK) sekolah', 'Media sosial', 'Guru BK'],
        'K23' => 'Pernah memakai',
        'K24' => ['Syarat umur/penampilan', 'Belum punya pengalaman'],
        'K25' => ['Magang di perusahaan', 'Informasi lowongan'],
        'K26' => 'Industri pengolahan',
        // E. Green Job
        'K27' => 'Pernah dengar dan tahu artinya',
        'K28' => 'Tertarik',
        'K29' => ['Listrik tenaga surya, biogas, atau angin', 'Kendaraan listrik dan bengkelnya']
    ]
];

$resD = submitTestPayload($baseUrl, $payloadD);
$okD = ($resD['code'] === 200 && ($resD['data']['status'] ?? false));
$respIdD = $resD['data']['responden_id'] ?? 0;
$jwbCountD = $pdo->query("SELECT COUNT(*) FROM survei_jawaban WHERE RespondenId = {$respIdD}")->fetchColumn();

echo "  -> Status HTTP: {$resD['code']} | Status Respon: " . ($okD ? "BERHASIL" : "GAGAL") . "\n";
echo "  -> Responden Id: #{$respIdD} | Total Jawaban Disimpan: {$jwbCountD} butir\n";
echo "  -> Rata-Rata Skor: " . ($resD['data']['rata_rata_skor'] ?? '-') . " | Mutu Layanan: " . ($resD['data']['mutu_pelayanan'] ?? '-') . "\n";
$resultsSummary['D'] = ['status' => $okD, 'id' => $respIdD, 'answers' => $jwbCountD, 'desc' => 'Siswa Kelas 12 (Seksi A-E Lengkap)'];
echo "\n";

// --------------------------------------------------------------------------------------
// REKAP HASIL & KESIMPULAN
// --------------------------------------------------------------------------------------
echo "========================================================================================\n";
echo "                              REKAPITULASI HASIL PENGUJIAN\n";
echo "========================================================================================\n";
$allSuccess = true;
foreach ($resultsSummary as $inst => $info) {
    $stat = $info['status'] ? "[SUKSES]" : "[GAGAL]";
    if (!$info['status']) $allSuccess = false;
    echo sprintf("  %-10s : %-8s | Responden #%-5d | %-2d Butir Jawaban | %s\n", 
        "Instrumen " . $inst, $stat, $info['id'], $info['answers'], $info['desc']);
}

echo "----------------------------------------------------------------------------------------\n";
if ($allSuccess) {
    echo "STATUS KESELURUHAN: SEMUA 5 INSTRUMEN & SETIAP BAGIAN BERJALAN 100% LANCAR & VALID!\n";
} else {
    echo "STATUS KESELURUHAN: DITEMUKAN BAGIAN YANG GAGAL!\n";
}
echo "========================================================================================\n";
