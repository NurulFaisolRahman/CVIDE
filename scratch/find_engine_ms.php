<?php
$lines = file("application/views/MenuSurvei.php");
foreach ($lines as $i => $l) {
    if (stripos($l, 'survei_rtkd_engine.js') !== false) {
        echo ($i + 1) . ": " . trim($l) . "\n";
    }
}
