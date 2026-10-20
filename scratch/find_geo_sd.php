<?php
$lines = file('application/views/SurveyDashboard.php');
foreach ($lines as $i => $line) {
    if (stripos($line, 'get_survei_geo_data') !== false) {
        echo ($i + 1) . ": " . trim($line) . "\n";
    }
}
