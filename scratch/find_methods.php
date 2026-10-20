<?php
$content = file_get_contents('application/controllers/IDE.php');
preg_match_all('/public function\s+([A-Za-z0-9_]+)/', $content, $m);
foreach ($m[1] as $fn) {
    if (stripos($fn, 'responden') !== false || stripos($fn, 'geo') !== false || stripos($fn, 'excel') !== false || stripos($fn, 'rekap') !== false) {
        echo $fn . "\n";
    }
}
