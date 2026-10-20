<?php
$lines = file("assets/js/survei_rtkd_engine.js");
echo "Total lines in survei_rtkd_engine.js: " . count($lines) . "\n";
foreach ($lines as $i => $l) {
    if (preg_match('/^\s*([ABCD]):\s*\{/', $l, $m)) {
        echo "Found Instrument " . $m[1] . " at line " . ($i + 1) . "\n";
    }
}
