<?php
$file = $argv[1] ?? '';
$term = $argv[2] ?? '';
if (!file_exists($file)) die("File not found: $file\n");
$lines = file($file);
foreach ($lines as $n => $l) {
    if (stripos($l, $term) !== false) {
        echo ($n + 1) . ': ' . trim($l) . "\n";
    }
}
