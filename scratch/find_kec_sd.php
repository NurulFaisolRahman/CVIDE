<?php
$lines = file('application/views/SurveyDashboard.php');
foreach ($lines as $i => $line) {
    if (stripos($line, 'kecamatan') !== false) {
        echo ($i + 1) . ": " . trim($line) . "\n";
    }
}
