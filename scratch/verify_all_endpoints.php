<?php
// Test API endpoints and database integrity
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
if ($mysqli->connect_error) {
  die("Connect failed: " . $mysqli->connect_error);
}

echo "=== 1. Check Questions by Instrument ===\n";
$res = $mysqli->query("SELECT Instrumen, COUNT(*) as c FROM survei_pertanyaan WHERE SurveiId = 4 GROUP BY Instrumen ORDER BY Instrumen ASC");
while ($r = $res->fetch_assoc()) {
  echo "Instrument {$r['Instrumen']}: {$r['c']} questions\n";
}

echo "\n=== 2. Check Respondents by Instrument ===\n";
$res2 = $mysqli->query("SELECT Instrumen, COUNT(*) as c FROM survei_responden WHERE SurveiId = 4 GROUP BY Instrumen ORDER BY Instrumen ASC");
while ($r = $res2->fetch_assoc()) {
  echo "Instrument {$r['Instrumen']}: {$r['c']} respondents\n";
}

echo "\n=== 3. Test submitting sample answers for Instrument A, B, C, D ===\n";
$instruments = [
  'A' => [
    'SurveiId' => 4,
    'Instrumen' => 'A',
    'Enumerator' => 'Test Enumerator A',
    'RespondenNama' => 'PT Sumber Rezeki Banyuwangi',
    'Jawaban' => [
      'SR' => 'Daftar wajib lapor Disnaker (sampel acak)',
      'P1' => 'PT Sumber Rezeki Banyuwangi',
      'P2' => 'Banyuwangi',
      'P3' => 'Industri pengolahan',
      'P4' => '20–99',
      'P5' => 'PT',
      'P6' => ['Laki-laki' => 25, 'Perempuan' => 15],
      'P12' => 'Tidak',
      'P15' => 'Tetap',
      'P19' => ['Teknis sesuai bidang' => 4, 'Digital' => 4, 'Bahasa asing' => 3, 'Komunikasi' => 4, 'Kerja sama tim' => 5, 'Disiplin/etos kerja' => 4],
      'P24' => 'Setara UMK',
      'P25' => 'Semua pekerja'
    ]
  ],
  'B' => [
    'SurveiId' => 4,
    'Instrumen' => 'B',
    'Enumerator' => 'Test Enumerator B',
    'RespondenNama' => 'Ahmad Fauzi',
    'Jawaban' => [
      'SR' => 'Daftar pencari kerja Disnaker (AK/I)',
      'SC' => ['Sedang mencari kerja atau menyiapkan usaha'],
      'L1' => '20–24',
      'L2' => 'Laki-laki',
      'L3' => 'Rogojampi',
      'L4' => 'SMK',
      'L5' => 'Teknik Komputer & Jaringan',
      'L6' => 2024,
      'L7' => 'Mencari kerja',
      'L8' => 'Ya',
      'L9' => '3–6 bulan',
      'L23' => ['Teknis' => 4, 'Digital' => 5, 'Bahasa asing' => 3, 'Komunikasi' => 4]
    ]
  ],
  'C' => [
    'SurveiId' => 4,
    'Instrumen' => 'C',
    'Enumerator' => 'Test Enumerator C',
    'RespondenNama' => 'Dinas Tenaga Kerja Transmigrasi Banyuwangi',
    'Jawaban' => [
      'S1' => 'Perencana dan pengelola program',
      'S2' => 'Dinas Tenaga Kerja Kab. Banyuwangi',
      'S3' => 'Kepala Bidang Pelatihan & Penempatan',
      'S4' => '2026-10-19',
      'S5' => 'Wawancara mendalam',
      'T1' => 'Pasar kerja menunjukkan pertumbuhan positif di sektor pariwisata dan pengolahan pangan.',
      'T2' => 'Perlu sinkronisasi vokasi SMK dengan standar industri perhotelan dan logistik.',
      'I1' => 'Penguatan sertifikasi BNSP',
      'I2' => 'Digitalisasi bursa kerja daerah',
      'I3' => 'Peningkatan perlindungan PMI'
    ]
  ],
  'D' => [
    'SurveiId' => 4,
    'Instrumen' => 'D',
    'Enumerator' => 'Test Enumerator D',
    'RespondenNama' => 'Siswa SMKN 1 Banyuwangi',
    'Jawaban' => [
      'K1' => 'SMK',
      'K2' => 'SMKN 1 Banyuwangi',
      'K3' => 'Banyuwangi',
      'K4' => 'Perhotelan & Pariwisata',
      'K5' => '17 tahun',
      'K6' => 'Perempuan',
      'K7' => 'Giri',
      'K8' => 'Bekerja',
      'K9' => 'Di Banyuwangi',
      'K12' => 'Rp2–3 juta',
      'K15' => 'Ya, sesuai jurusan',
      'K20' => ['Teknis sesuai jurusan' => 4, 'Digital' => 4, 'Bahasa asing' => 4, 'Komunikasi' => 5]
    ]
  ]
];

foreach ($instruments as $instKey => $payload) {
  $ch = curl_init('http://localhost/CVIDE/IDE/submit_jawaban_survei');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
  $response = curl_exec($ch);
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  echo "Submit Instrumen {$instKey}: HTTP {$httpCode}\n";
  echo "Response: {$response}\n\n";
}

echo "=== Verification complete! ===\n";
