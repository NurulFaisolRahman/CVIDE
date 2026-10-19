<?php
$baseUrl = 'http://localhost/CVIDE/index.php/IDE/submit_jawaban_survei';

$testPayload = [
    'SurveiId' => 4,
    'Instrumen' => 'A',
    'Enumerator' => 'Enumerator Uji Lokasi & Device',
    'RespondenNama' => 'CV Banyuwangi Berkah Abadi',
    'Kecamatan' => 'Rogojampi',
    'Desa' => 'Gitik',
    'AlamatDetail' => 'Jl. Banyuwangi - Jember Km 14',
    'Latitude' => -8.309450,
    'Longitude' => 114.298210,
    'LokasiAccuracy' => 4.2,
    'DevicePlatform' => 'Samsung Galaxy A54 5G (Android 14) · Chrome Mobile 124',
    'Jawaban' => [
        'SR' => 'Daftar wajib lapor Disnaker (sampel acak)',
        'P1' => 'CV Banyuwangi Berkah Abadi',
        'P2' => 'Rogojampi',
        'P3' => 'Industri pengolahan',
        'P4' => '20–99',
        'P19' => ['Teknis sesuai bidang' => 4, 'Digital' => 4, 'Disiplin/etos kerja' => 5],
        'P24' => 'Setara UMK'
    ]
];

$ch = curl_init($baseUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($testPayload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'User-Agent: Mozilla/5.0 (Linux; Android 14; SM-A546E) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Mobile Safari/537.36'
]);
$resStr = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response: $resStr\n\n";

$mysqli = new mysqli('localhost', 'root', '', 'cvide');
$r = $mysqli->query("SELECT Id, Instrumen, RespondenNama, Kecamatan, Latitude, Longitude, LokasiAccuracy, DevicePlatform, UserAgent, CreatedAt FROM survei_responden WHERE Id = (SELECT MAX(Id) FROM survei_responden)")->fetch_assoc();

print_r($r);
