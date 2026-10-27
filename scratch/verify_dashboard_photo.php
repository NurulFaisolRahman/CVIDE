<?php
$html = file_get_contents('http://localhost/CVIDE/index.php/IDE/MenuSurvei');
$dashboardView = file_get_contents(__DIR__ . '/../application/views/SurveyDashboard.php');

$checks = array(
    'Foto Lapangan',
    'previewDashboardPhoto',
    'Foto Dokumentasi Survei Lapangan',
    'modalRincianJawaban'
);

$allOk = true;
foreach ($checks as $item) {
    $found = (strpos($dashboardView, $item) !== false);
    echo "SurveyDashboard check '{$item}': " . ($found ? "FOUND (OK)" : "NOT FOUND (FAIL)") . "\n";
    if (!$found) $allOk = false;
}

if ($allOk) {
    echo "\n>>> SURVEY DASHBOARD TERVERIFIKASI 100% OK! <<<\n";
} else {
    echo "\n>>> ADA ELEMEN DASHBOARD YANG GAGAL! <<<\n";
}
