<?php
$ch = curl_init('http://localhost/CVIDE/IDE/submit_survei_responden');
$payload = array(
  'SurveiId' => 4,
  'Instrumen' => 'E',
  'Enumerator' => 'Petugas Uji CR',
  'RespondenNama' => 'Pakar Uji Inconsistent',
  'Jawaban' => array(
    'S1' => 'Dunia usaha',
    'S2' => 'Asosiasi Pengusaha',
    'S3' => 'Ketua',
    'S5' => 'FGD',
    'W12' => '9',
    'W23' => '9',
    'W13' => '1/9'
  )
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$res = curl_exec($ch);
echo "Response:\n" . $res . "\n";
