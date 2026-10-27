<?php
// Test getting respondent details as staff/admin
$cookieFile = __DIR__ . '/test_cookie.txt';
if (file_exists($cookieFile)) unlink($cookieFile);

// Login as admin/staff first
$loginUrl = 'http://localhost/CVIDE/index.php/IDE/login';
$ch = curl_init($loginUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'Username' => 'admin',
    'Password' => 'admin'
]));
curl_exec($ch);
curl_close($ch);

// Fetch respondent 204
$ch = curl_init('http://localhost/CVIDE/index.php/IDE/get_responden_detail/204');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$res = curl_exec($ch);
curl_close($ch);

echo "Get Responden Detail:\n" . $res . "\n";
if (file_exists($cookieFile)) unlink($cookieFile);
