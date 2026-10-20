<?php
$lines = file("assets/js/survei_rtkd_engine.js");
foreach ($lines as $i => $l) {
    if (strpos($l, '$') !== false) {
        echo ($i + 1) . ": " . trim($l) . "\n";
    }
}
