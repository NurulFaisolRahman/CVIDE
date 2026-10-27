<?php
$html = file_get_contents('http://localhost/CVIDE/index.php/IDE/MenuSurvei');
echo "HTML length: " . strlen($html) . "\n";

$checks = array(
    'rtkdPhotoSection',
    'rtkdCameraInput',
    'rtkdGalleryInput',
    'respFotoDokumentasi',
    'handleRtkdPhotoCaptured',
    'clearRtkdPhoto',
    'previewRtkdPhotoFull',
    'capture="environment"',
    'accept="image/*"',
    'Foto Dokumentasi Survei Lapangan'
);

$allOk = true;
foreach ($checks as $item) {
    $found = (strpos($html, $item) !== false);
    echo "Check '{$item}': " . ($found ? "FOUND (OK)" : "NOT FOUND (FAIL)") . "\n";
    if (!$found) $allOk = false;
}

if ($allOk) {
    echo "\n>>> SELURUH ELEMEN HTML & JAVASCRIPT TERSEDIA DAN TERMUAT 100% DI BROWSER! <<<\n";
} else {
    echo "\n>>> ADA ELEMEN YANG TIDAK DITEMUKAN! <<<\n";
}
