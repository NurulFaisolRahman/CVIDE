<?php
$payload = [
    'SurveiId' => 4,
    'Instrumen' => 'B',
    'Enumerator' => 'Petugas RTKD',
    'RespondenNama' => 'Rina Salsabila',
    'Kecamatan' => 'Genteng',
    'Jawaban' => ['SC' => ['Lulusan SMK'], 'L1' => '20–24', 'L2' => 'Perempuan', 'L3' => 'Genteng', 'L4' => 'SMK', 'L7' => 'Pencari kerja']
];
$ch = curl_init('http://localhost/CVIDE/index.php/IDE/submit_jawaban_survei');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 17_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4.1 Mobile/15E148 Safari/604.1'
]);
$res = curl_exec($ch);
curl_close($ch);
echo "Response: $res\n";

$m = new mysqli('localhost', 'root', '', 'cvide');
$r = $m->query('SELECT Id, RespondenNama, DevicePlatform, Latitude, Longitude FROM survei_responden ORDER BY Id DESC LIMIT 1')->fetch_assoc();
print_r($r);
