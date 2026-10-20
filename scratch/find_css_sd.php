<?php
$lines = file("application/views/SurveyDashboard.php");
foreach ($lines as $i => $l) {
    if (stripos($l, 'survei_rtkd.css') !== false) {
        echo ($i + 1) . ": " . trim($l) . "\n";
    }
}
