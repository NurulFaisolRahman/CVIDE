<?php
/**
 * Test script for RTKD Survey Photo Documentation Submission
 */
$baseUrl = 'http://localhost/CVIDE/index.php/IDE/';

// 1. Create a dummy test image in Base64 (100x80 px JPEG with GD)
$im = imagecreatetruecolor(120, 80);
$bg = imagecolorallocate($im, 4, 49, 104); // Navy
$text_color = imagecolorallocate($im, 255, 255, 255);
imagefilledrectangle($im, 0, 0, 120, 80, $bg);
imagestring($im, 3, 10, 30, 'TEST RTKD', $text_color);

ob_start();
imagejpeg($im, null, 80);
$jpegBytes = ob_get_clean();
imagedestroy($im);

$base64Photo = 'data:image/jpeg;base64,' . base64_encode($jpegBytes);
echo "1. Dummy photo created, base64 length: " . strlen($base64Photo) . " characters.\n";

// 2. Prepare payload for Instrument A
$payload = array(
    'SurveiId' => 4,
    'Instrumen' => 'A',
    'Enumerator' => 'Surveiyor Uji Coba Kamera',
    'RespondenNama' => 'PT Testing Kamera Banyuwangi',
    'RespondenNIK' => '3510000000000099',
    'RespondenKontak' => '081234567890',
    'RespondenGender' => 'Laki-laki',
    'RespondenUsia' => '30 - 50 Tahun',
    'RespondenPendidikan' => 'Sarjana (S1)',
    'RespondenPekerjaan' => 'Pemberi Kerja',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Rogojampi',
    'Latitude' => -8.3089,
    'Longitude' => 114.2989,
    'LokasiAccuracy' => 10.0,
    'DevicePlatform' => 'Mobile Phone Camera Tester',
    'FotoDokumentasi' => $base64Photo,
    'Jawaban' => array(
        'P1' => 'PT Testing Kamera Banyuwangi',
        'P2' => 'Rogojampi',
        'P3' => 'Industri Pengolahan',
        'P4' => '10-50 orang',
        'P5' => '5-10 tahun'
    )
);

echo "2. Sending POST payload to " . $baseUrl . "submit_jawaban_survei ...\n";
$ch = curl_init($baseUrl . 'submit_jawaban_survei');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
$responseRaw = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status Code: " . $httpCode . "\n";
echo "Response: " . $responseRaw . "\n";

$res = json_decode($responseRaw, true);
if (!$res || empty($res['status'])) {
    die("FAILED: Response status is false!\n");
}

$respId = (int)$res['responden_id'];
echo "\n3. Success! Responden ID: " . $respId . "\n";
echo "Foto Dokumentasi URL: " . ($res['foto_dokumentasi'] ?? 'NONE') . "\n";

// 4. Verify in MySQL database
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
$row = $mysqli->query("SELECT Id, RespondenNama, FotoDokumentasi, CreatedAt FROM survei_responden WHERE Id = " . $respId)->fetch_assoc();

echo "\n4. Verifikasi Database MySQL:\n";
print_r($row);

if (!empty($row['FotoDokumentasi'])) {
    $fullPath = __DIR__ . '/../' . $row['FotoDokumentasi'];
    if (file_exists($fullPath)) {
        echo "FILE EXISTS ON DISK: " . $fullPath . " (" . filesize($fullPath) . " bytes)\n";
        echo "VERIFIKASI SUKSES!\n";
    } else {
        echo "ERROR: File not found at " . $fullPath . "\n";
    }
} else {
    echo "ERROR: FotoDokumentasi is empty in database!\n";
}
