<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
if ($m->connect_error) {
    die("DB error: " . $m->connect_error);
}

$sql = "";
$sql .= "-- =====================================================================\n";
$sql .= "-- SCRIPT SQL INSERT & UPDATE KEBUTUHAN DATABASE SURVEI RTKD BANYUWANGI\n";
$sql .= "-- Untuk Server Production / cPanel phpMyAdmin\n";
$sql .= "-- =====================================================================\n\n";

$sql .= "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n";
$sql .= "START TRANSACTION;\n";
$sql .= "SET time_zone = '+07:00';\n\n";

$sql .= "-- ---------------------------------------------------------------------\n";
$sql .= "-- 1. PASTIKAN STRUKTUR TABEL & KOLOM BARU SUDAH SESUAI\n";
$sql .= "-- ---------------------------------------------------------------------\n\n";

// DDL survei_dinamis
$res = $m->query("SHOW CREATE TABLE `survei_dinamis`");
if ($res && $r = $res->fetch_row()) {
    $createSql = preg_replace('/CREATE TABLE/', 'CREATE TABLE IF NOT EXISTS', $r[1]);
    $sql .= "-- Tabel survei_dinamis\n" . $createSql . ";\n\n";
}

// DDL survei_pertanyaan
$res = $m->query("SHOW CREATE TABLE `survei_pertanyaan`");
if ($res && $r = $res->fetch_row()) {
    $createSql = preg_replace('/CREATE TABLE/', 'CREATE TABLE IF NOT EXISTS', $r[1]);
    $sql .= "-- Tabel survei_pertanyaan\n" . $createSql . ";\n\n";
}

// Alter survei_pertanyaan in case table already existed on old version
$sql .= "-- Penyesuaian kolom baru pada survei_pertanyaan (jika tabel lama sudah ada)\n";
$sql .= "ALTER TABLE `survei_pertanyaan` ADD COLUMN IF NOT EXISTS `Instrumen` VARCHAR(10) DEFAULT 'A' AFTER `SurveiId`;\n";
$sql .= "ALTER TABLE `survei_pertanyaan` ADD COLUMN IF NOT EXISTS `Section` VARCHAR(150) NULL AFTER `Deskripsi`;\n\n";

// DDL survei_responden
$res = $m->query("SHOW CREATE TABLE `survei_responden`");
if ($res && $r = $res->fetch_row()) {
    $createSql = preg_replace('/CREATE TABLE/', 'CREATE TABLE IF NOT EXISTS', $r[1]);
    $sql .= "-- Tabel survei_responden\n" . $createSql . ";\n\n";
}

// Alter survei_responden in case table already existed on old version
$sql .= "-- Penyesuaian kolom baru pada survei_responden (jika tabel lama sudah ada)\n";
$sql .= "ALTER TABLE `survei_responden` ADD COLUMN IF NOT EXISTS `Instrumen` VARCHAR(10) DEFAULT 'A' AFTER `SurveiId`;\n";
$sql .= "ALTER TABLE `survei_responden` ADD COLUMN IF NOT EXISTS `LokasiAccuracy` DECIMAL(8,2) NULL AFTER `Longitude`;\n";
$sql .= "ALTER TABLE `survei_responden` ADD COLUMN IF NOT EXISTS `DevicePlatform` VARCHAR(100) NULL AFTER `UserAgent`;\n\n";

// DDL survei_jawaban
$res = $m->query("SHOW CREATE TABLE `survei_jawaban`");
if ($res && $r = $res->fetch_row()) {
    $createSql = preg_replace('/CREATE TABLE/', 'CREATE TABLE IF NOT EXISTS', $r[1]);
    $sql .= "-- Tabel survei_jawaban\n" . $createSql . ";\n\n";
}

$sql .= "-- ---------------------------------------------------------------------\n";
$sql .= "-- 2. DATA UTAMA SURVEI RTKD BANYUWANGI (survei_dinamis Id = 4)\n";
$sql .= "-- ---------------------------------------------------------------------\n\n";

$res = $m->query("SELECT * FROM survei_dinamis WHERE Id = 4");
if ($row = $res->fetch_assoc()) {
    $keys = array_keys($row);
    $escapedVals = array_map(function($val) use ($m) {
        if ($val === null) return 'NULL';
        return "'" . $m->real_escape_string($val) . "'";
    }, array_values($row));
    $sql .= "REPLACE INTO `survei_dinamis` (`" . implode("`, `", $keys) . "`)\nVALUES (" . implode(", ", $escapedVals) . ");\n\n";
}

$sql .= "-- ---------------------------------------------------------------------\n";
$sql .= "-- 3. DAFTAR PERTANYAAN SURVEI RTKD (Instrumen A, B, C, D)\n";
$sql .= "-- ---------------------------------------------------------------------\n\n";

$sql .= "DELETE FROM `survei_pertanyaan` WHERE `SurveiId` = 4;\n\n";

$res = $m->query("SELECT * FROM survei_pertanyaan WHERE SurveiId = 4 ORDER BY Instrumen ASC, Urutan ASC");
$count = 0;
while ($row = $res->fetch_assoc()) {
    $count++;
    $keys = array_keys($row);
    $escapedVals = array_map(function($val) use ($m) {
        if ($val === null) return 'NULL';
        return "'" . $m->real_escape_string($val) . "'";
    }, array_values($row));
    $sql .= "INSERT INTO `survei_pertanyaan` (`" . implode("`, `", $keys) . "`) VALUES (" . implode(", ", $escapedVals) . ");\n";
}

$sql .= "\nCOMMIT;\n";
$sql .= "-- =====================================================================\n";
$sql .= "-- SELESAI: Berhasil meng-generate $count butir pertanyaan survei RTKD!\n";
$sql .= "-- =====================================================================\n";

$targetFile = dirname(__DIR__) . '/database_update_rtkd.sql';
file_put_contents($targetFile, $sql);
echo "SQL file created at root: $targetFile\n";
echo "Total questions exported: $count\n";
echo "File size: " . filesize($targetFile) . " bytes\n";
