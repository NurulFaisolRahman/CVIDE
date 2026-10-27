<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
if ($mysqli->connect_error) {
    die("Connect Error: " . $mysqli->connect_error . "\n");
}

$chk = $mysqli->query("SHOW COLUMNS FROM `survei_responden` LIKE 'FotoDokumentasi'");
if ($chk && $chk->num_rows == 0) {
    $res = $mysqli->query("ALTER TABLE `survei_responden` ADD COLUMN `FotoDokumentasi` VARCHAR(255) NULL AFTER `LokasiAccuracy`");
    if ($res) {
        echo "Column FotoDokumentasi ADDED successfully!\n";
    } else {
        echo "Failed to add column: " . $mysqli->error . "\n";
    }
} else {
    echo "Column FotoDokumentasi already exists!\n";
}

// Verify columns
$res = $mysqli->query("SHOW COLUMNS FROM `survei_responden`");
$cols = [];
while ($r = $res->fetch_assoc()) {
    $cols[] = $r['Field'];
}
echo "Columns in survei_responden: " . implode(", ", $cols) . "\n";
