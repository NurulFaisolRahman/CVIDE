<?php
$c = curl_init('http://localhost/CVIDE/index.php/MenuSurvei');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($c);
$code = curl_getinfo($c, CURLINFO_HTTP_CODE);
curl_close($c);
echo "HTTP: " . $code . " Size: " . strlen($res) . "\n";
echo "Contains modalRtkdTab-E: " . (strpos($res, 'modalRtkdTab-E') !== false ? 'YES' : 'NO') . "\n";
echo "Contains modalRtkdSheet: " . (strpos($res, 'modalRtkdSheet') !== false ? 'YES' : 'NO') . "\n";
