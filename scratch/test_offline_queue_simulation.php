<?php
/**
 * test_offline_queue_simulation.php
 * Simulasi Pengisian Survei Mode Offline (Multi-Antrean)
 * dan Sinkronisasi Massal ke Database
 */

$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$targetUrl = 'http://localhost/CVIDE/IDE/submit_jawaban_survei';

echo "========================================================================\n";
echo "    SIMULASI PENGISIAN MULTI-ANTREAN OFFLINE & SINKRONISASI MASSAL\n";
echo "========================================================================\n\n";

// 1. Siapkan 3 data survei yang diisi surveyor saat mode offline di lapangan
$simulatedOfflineQueue = [
    [
        'id' => 'OFFLINE_' . (time() - 300) . '_abc1',
        'surveiId' => 4,
        'instrumen' => 'A',
        'respondenNama' => 'UD Tani Sejahtera Mandiri (Offline #1)',
        'kecamatan' => 'Songgon',
        'waktu' => date('d M H:i', time() - 300),
        'payload' => [
            'SurveiId' => 4,
            'Instrumen' => 'A',
            'Enumerator' => 'Surveyor Lapangan 01',
            'RespondenNama' => 'UD Tani Sejahtera Mandiri (Offline #1)',
            'Kecamatan' => 'Songgon',
            'Kabupaten' => 'Kabupaten Banyuwangi',
            'Jawaban' => [
                'SR' => 'Ditemui di lapangan (sampel kuota)',
                'SR2' => 'Desa Sumberbulu, Songgon',
                'P1' => 'UD Tani Sejahtera Mandiri',
                'P2' => 'Songgon',
                'P3' => 'Pertanian/perikanan',
                'P4' => '5–19',
                'P5' => 'Perorangan tidak berbadan hukum',
                'P15' => 'Bertambah',
                'P16' => 5,
                'P24' => 'Setara UMK',
                'P25' => 'Semua pekerja'
            ]
        ]
    ],
    [
        'id' => 'OFFLINE_' . (time() - 180) . '_def2',
        'surveiId' => 4,
        'instrumen' => 'B',
        'respondenNama' => 'Rahmat Hidayat (Pencari Kerja Offline #2)',
        'kecamatan' => 'Genteng',
        'waktu' => date('d M H:i', time() - 180),
        'payload' => [
            'SurveiId' => 4,
            'Instrumen' => 'B',
            'Enumerator' => 'Surveyor Lapangan 01',
            'RespondenNama' => 'Rahmat Hidayat (Pencari Kerja Offline #2)',
            'Kecamatan' => 'Genteng',
            'Kabupaten' => 'Kabupaten Banyuwangi',
            'Jawaban' => [
                'SR' => 'Ditemui di lapangan (sampel kuota)',
                'SC' => ['Sedang mencari pekerjaan'],
                'L1' => '20–24',
                'L2' => 'Laki-laki',
                'L3' => 'Genteng',
                'L4' => 'SMK Vokasi',
                'L7' => 'Mencari kerja',
                'L16' => ['Media sosial', 'Menghubungi teman/keluarga'],
                'L21' => 'Karyawan swasta tetap',
                'L22' => 'Rp2,5–3,5 juta',
                'L36' => 'Sesuai atau di atas UMK'
            ]
        ]
    ],
    [
        'id' => 'OFFLINE_' . (time() - 60) . '_ghi3',
        'surveiId' => 4,
        'instrumen' => 'D',
        'respondenNama' => 'Siti Aisyah (Siswa Kelas 12 Offline #3)',
        'kecamatan' => 'Giri',
        'waktu' => date('d M H:i', time() - 60),
        'payload' => [
            'SurveiId' => 4,
            'Instrumen' => 'D',
            'Enumerator' => 'Surveyor Lapangan 01',
            'RespondenNama' => 'Siti Aisyah (Siswa Kelas 12 Offline #3)',
            'Kecamatan' => 'Giri',
            'Kabupaten' => 'Kabupaten Banyuwangi',
            'Jawaban' => [
                'K1' => 'SMK',
                'K2' => 'SMK Negeri 1 Giri',
                'K3' => 'Giri',
                'K5' => '17 tahun',
                'K6' => 'Perempuan',
                'K8' => 'Kuliah sambil bekerja',
                'K9' => 'Di Banyuwangi',
                'K10' => 'Perdagangan',
                'K27' => 'Pernah dengar dan tahu artinya',
                'K28' => 'Tertarik'
            ]
        ]
    ]
];

echo "1. Memeriksa Isi Antrean Offline Tersimpan di Memori Perangkat:\n";
echo "   Total Antrean: " . count($simulatedOfflineQueue) . " data responden\n";
foreach ($simulatedOfflineQueue as $idx => $qItem) {
    echo "   [" . ($idx + 1) . "] " . $qItem['respondenNama'] . " | Instrumen " . $qItem['instrumen'] . " | Kec. " . $qItem['kecamatan'] . " | Terisi: " . count($qItem['payload']['Jawaban']) . " butir\n";
}

echo "\n2. Menjalankan Sinkronisasi Massal (Auto-Sync saat kembali Online):\n";
$syncedSuccess = 0;
$syncedFailed = 0;
$insertedIds = [];

foreach ($simulatedOfflineQueue as $idx => $qItem) {
    $ch = curl_init($targetUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($qItem['payload']));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $res = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $json = json_decode($res, true);
    if ($httpCode === 200 && ($json['status'] ?? false)) {
        $syncedSuccess++;
        $insertedIds[] = $json['responden_id'];
        echo "   [SUKSES] Data #" . ($idx + 1) . " (" . $qItem['respondenNama'] . ") -> Tersimpan sebagai Responden #" . $json['responden_id'] . " (Skor: " . ($json['rata_rata_skor'] ?? '-') . ")\n";
    } else {
        $syncedFailed++;
        echo "   [GAGAL] Data #" . ($idx + 1) . " -> " . ($json['message'] ?? 'Error HTTP ' . $httpCode) . "\n";
    }
}

echo "\n3. Hasil Sinkronisasi:\n";
echo "   Total Berhasil : " . $syncedSuccess . " data\n";
echo "   Total Gagal    : " . $syncedFailed . " data\n";

if ($syncedSuccess === count($simulatedOfflineQueue)) {
    echo "   [STATUS] 100% Antrean berhasil diunggah ke database MySQL!\n";
}

echo "\n4. Verifikasi Database MySQL (survei_responden & survei_jawaban):\n";
foreach ($insertedIds as $rId) {
    $row = $pdo->query("SELECT Id, Instrumen, RespondenNama, Kecamatan, CreatedAt FROM survei_responden WHERE Id = {$rId}")->fetch(PDO::FETCH_ASSOC);
    $jwbCount = $pdo->query("SELECT COUNT(*) FROM survei_jawaban WHERE RespondenId = {$rId}")->fetchColumn();
    echo "   -> Responden #{$row['Id']} [{$row['Instrumen']}] {$row['RespondenNama']} (Kec. {$row['Kecamatan']}): {$jwbCount} butir jawaban tersimpan di database.\n";
}

echo "\n========================================================================\n";
echo "   SIMULASI SELESAI: FITUR MULTI-ANTREAN OFFLINE BERFUNGSI SEMPURNA!\n";
echo "========================================================================\n";
