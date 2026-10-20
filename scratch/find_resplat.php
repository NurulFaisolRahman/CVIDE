<?php
$lines = file('application/views/MenuSurvei.php');
foreach ($lines as $i => $line) {
    if (stripos($line, 'respLatitude') !== false) {
        echo ($i + 1) . ": " . trim($line) . "\n";
    }
}
