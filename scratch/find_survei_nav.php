<?php
$lines = file("application/views/Admin/Header.php");
foreach ($lines as $i => $l) {
    if (stripos($l, 'survei') !== false) {
        echo ($i + 1) . ": " . trim($l) . "\n";
    }
}
