<?php
$cookieFile = __DIR__ . '/cookie.txt';
if (file_exists($cookieFile)) unlink($cookieFile);

// 1. Login
$ch = curl_init('http://localhost/CVIDE/IDE/Login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'Username' => 'admin',
    'Password' => 'admin' // or whatever admin password is
]));
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$res = curl_exec($ch);
curl_close($ch);

// 2. Fetch MenuSurvei
$ch = curl_init('http://localhost/CVIDE/IDE/MenuSurvei');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$html = curl_exec($ch);
curl_close($ch);

if (strpos($html, 'SurveyDashboard') !== false || strpos($html, 'dashQuestionsContainer') !== false) {
    echo "SurveyDashboard view loaded successfully!\n";
} else {
    echo "SurveyDashboard not loaded. Let's check admin credentials in DB.\n";
}
