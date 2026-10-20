<?php
$files = glob("application/views/*.php");
foreach ($files as $f) {
    $lines = file($f);
    foreach ($lines as $i => $l) {
        if (stripos($l, 'RTKDEngine =') !== false || stripos($l, 'var RTKDEngine') !== false || stripos($l, 'window.RTKDEngine =') !== false) {
            echo "$f: " . ($i + 1) . " -> " . trim($l) . "\n";
        }
    }
}
$jsFiles = glob("assets/js/*.js");
foreach ($jsFiles as $f) {
    $lines = file($f);
    foreach ($lines as $i => $l) {
        if (stripos($l, 'RTKDEngine') !== false) {
            echo "$f: " . ($i + 1) . " -> " . trim($l) . "\n";
        }
    }
}
