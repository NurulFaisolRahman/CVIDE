<?php
$ch = curl_init('http://localhost/CVIDE/IDE/get_survei_pertanyaan/4');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res4 = curl_exec($ch);
curl_close($ch);
$d4 = json_decode($res4, true);
echo "Survey 4 questions count: " . count($d4['pertanyaan'] ?? $d4['data'] ?? []) . "\n";
echo "Survey 4 status: " . ($d4['status'] ? 'true' : 'false') . "\n";

$ch = curl_init('http://localhost/CVIDE/IDE/get_survei_pertanyaan/3');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res3 = curl_exec($ch);
curl_close($ch);
$d3 = json_decode($res3, true);
echo "Survey 3 questions count: " . count($d3['pertanyaan'] ?? $d3['data'] ?? []) . "\n";
echo "Survey 3 status: " . ($d3['status'] ? 'true' : 'false') . "\n";
