<?php
$files = glob("application/controllers/*.php");
foreach ($files as $f) {
    $lines = file($f);
    foreach ($lines as $i => $l) {
        if (stripos($l, 'SurveyDashboard') !== false) {
            echo "$f: " . ($i + 1) . " -> " . trim($l) . "\n";
        }
    }
}
