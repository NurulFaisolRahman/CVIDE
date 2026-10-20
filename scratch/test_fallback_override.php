<?php
// Test fallback override: form sends fallback 'Banyuwangi', but coordinates are real iPhone Malang
$url = 'http://localhost/CVIDE/IDE/submit_jawaban_survei';

$payload = array(
    'SurveiId' => 4,
    'Instrumen' => 'A',
    'Enumerator' => 'Petugas Surveyor',
    'RespondenNama' => 'H (Test Fallback Banyuwangi with Real GPS)',
    'RespondenGender' => 'Laki-laki',
    'RespondenUsia' => '30',
    'RespondenPekerjaan' => 'Pemberi Kerja',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Kecamatan' => 'Banyuwangi', // Fallback value sent by form
    'Latitude' => -7.933701,
    'Longitude' => 112.640656,
    'LokasiAccuracy' => 6.5,
    'DevicePlatform' => 'Apple iPhone (iOS 26.5.2) · Safari',
    'Jawaban' => array('100' => '4')
);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$res = curl_exec($ch);
curl_close($ch);

echo "Submit Result:\n" . $res . "\n\n";

$submitted = json_decode($res, true);
$respId = $submitted['responden_id'] ?? 0;

if ($respId > 0) {
    $c = mysqli_connect("localhost", "root", "", "cvide");
    $dbRes = mysqli_query($c, "SELECT Id, RespondenNama, Kecamatan, Kabupaten, Desa, Latitude, Longitude, DevicePlatform FROM survei_responden WHERE Id = " . (int)$respId);
    $row = mysqli_fetch_assoc($dbRes);
    echo "Direct DB Record after auto-resolution override:\n";
    print_r($row);
}
