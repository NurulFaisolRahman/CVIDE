<?php
// Simulasikan pengisian survei oleh perangkat real iPhone di Malang
$url = 'http://localhost/CVIDE/IDE/submit_jawaban_survei';

$payload = array(
    'SurveiId' => 4,
    'Instrumen' => 'A',
    'Enumerator' => 'Petugas Surveyor',
    'RespondenNama' => 'H (Uji Coba iPhone Real)',
    'RespondenGender' => 'Laki-laki',
    'RespondenUsia' => '30 Tahun',
    'RespondenPendidikan' => 'S1 / Sarjana',
    'RespondenPekerjaan' => 'Pemberi Kerja / Pelaku Usaha',
    'Provinsi' => 'Jawa Timur',
    'Kabupaten' => 'Kota Malang',
    'Kecamatan' => 'Lowokwaru',
    'RealKecamatan' => 'Lowokwaru',
    'RealKabupaten' => 'Kota Malang',
    'Desa' => 'Tunjungsekar',
    'AlamatDetail' => 'Lokasi: Perangkat Real iPhone',
    'Latitude' => -7.933701,
    'Longitude' => 112.640656,
    'LokasiAccuracy' => 6.5,
    'DevicePlatform' => 'Apple iPhone (iOS 26.5.2) · Safari',
    'Jawaban' => array(
        '100' => '4',
        '101' => '4',
        '102' => '5',
        '103' => '5'
    )
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
    // Check detail responden
    $ch = curl_init('http://localhost/CVIDE/IDE/get_responden_detail/' . $respId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $detailRes = curl_exec($ch);
    curl_close($ch);
    echo "Detail Responden:\n" . $detailRes . "\n\n";

    // Check DB row directly
    $c = mysqli_connect("localhost", "root", "", "cvide");
    $dbRes = mysqli_query($c, "SELECT Id, RespondenNama, Kecamatan, Kabupaten, Desa, Latitude, Longitude, DevicePlatform FROM survei_responden WHERE Id = " . (int)$respId);
    $row = mysqli_fetch_assoc($dbRes);
    echo "Direct DB Record:\n";
    print_r($row);
}
