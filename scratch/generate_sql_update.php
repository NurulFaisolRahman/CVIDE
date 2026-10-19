<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
if ($m->connect_error) {
    die("DB error: " . $m->connect_error);
}

$sqlOutput = "-- ========================================================\n";
$sqlOutput .= "-- UPDATE DATABASE UNTUK CPANEL (SURVEI RTKD ID 4)\n";
$sqlOutput .= "-- Silakan copy-paste script ini ke tab SQL phpMyAdmin di cPanel\n";
$sqlOutput .= "-- ========================================================\n\n";

// 1. Tambah kolom Instrumen dan Section di tabel survei_pertanyaan jika belum ada
$sqlOutput .= "-- 1. Penambahan Kolom Instrumen & Section\n";
$sqlOutput .= "ALTER TABLE `survei_pertanyaan` ADD COLUMN IF NOT EXISTS `Instrumen` VARCHAR(10) DEFAULT 'A' AFTER `SurveiId`;\n";
$sqlOutput .= "ALTER TABLE `survei_pertanyaan` ADD COLUMN IF NOT EXISTS `Section` VARCHAR(150) NULL AFTER `Deskripsi`;\n\n";

// 2. Insert or replace survei_dinamis ID = 4
$sqlOutput .= "-- 2. Data Survei RTKD Banyuwangi di survei_dinamis\n";
$res = $m->query("SELECT * FROM survei_dinamis WHERE Id = 4");
if ($row = $res->fetch_assoc()) {
    $keys = array_keys($row);
    $escapedVals = array_map(function($val) use ($m) {
        if ($val === null) return 'NULL';
        return "'" . $m->real_escape_string($val) . "'";
    }, array_values($row));
    $sqlOutput .= "REPLACE INTO `survei_dinamis` (`" . implode("`, `", $keys) . "`) VALUES (" . implode(", ", $escapedVals) . ");\n\n";
}

// 3. Insert or replace semua pertanyaan survei_pertanyaan untuk SurveiId = 4
$sqlOutput .= "-- 3. Butir Pertanyaan Multi-Instrumen Survei RTKD (SurveiId = 4)\n";
$sqlOutput .= "DELETE FROM `survei_pertanyaan` WHERE `SurveiId` = 4;\n";

$res = $m->query("SELECT * FROM survei_pertanyaan WHERE SurveiId = 4 ORDER BY Id ASC");
while ($row = $res->fetch_assoc()) {
    $keys = array_keys($row);
    $escapedVals = array_map(function($val) use ($m) {
        if ($val === null) return 'NULL';
        return "'" . $m->real_escape_string($val) . "'";
    }, array_values($row));
    $sqlOutput .= "INSERT INTO `survei_pertanyaan` (`" . implode("`, `", $keys) . "`) VALUES (" . implode(", ", $escapedVals) . ");\n";
}

$targetFile = __DIR__ . '/update_database_rtkd.sql';
file_put_contents($targetFile, $sqlOutput);
echo "SQL generated successfully: $targetFile\n";
echo "File size: " . filesize($targetFile) . " bytes\n";
