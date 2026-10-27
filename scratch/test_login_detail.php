<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
$user = $mysqli->query("SELECT Username, Password, Level FROM user LIMIT 1")->fetch_assoc();
if (!$user) {
    $user = $mysqli->query("SELECT Username, Password, Level FROM akun LIMIT 1")->fetch_assoc();
}
echo "User from DB:\n";
print_r($user);

// Login and test
$cookieFile = __DIR__ . '/cookie_test.txt';
if (file_exists($cookieFile)) unlink($cookieFile);

$ch = curl_init('http://localhost/CVIDE/IDE/Masuk');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'Username' => $user['Username'],
    'Password' => $user['Password']
]));
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$loginRes = curl_exec($ch);
curl_close($ch);

$ch = curl_init('http://localhost/CVIDE/IDE/get_responden_detail/204');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$detailRes = curl_exec($ch);
curl_close($ch);

echo "\nDetail response:\n" . $detailRes . "\n";
if (file_exists($cookieFile)) unlink($cookieFile);
