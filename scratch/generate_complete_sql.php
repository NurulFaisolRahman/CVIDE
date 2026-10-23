<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
if ($mysqli->connect_error) {
    die("Connect Error: " . $mysqli->connect_error);
}

// 1. Update survei_dinamis Id = 4 InstrumenList to include E
$mysqli->query("UPDATE `survei_dinamis` SET `InstrumenList` = 'A,B,C,D,E', `TipeSurvei` = 'multi', `UpdatedAt` = NOW() WHERE `Id` = 4");

$sql = "-- =====================================================================\n";
$sql .= "-- SCRIPT SQL INSERT & UPDATE LENGKAP SURVEI RTKD BANYUWANGI (5 INSTRUMEN)\n";
$sql .= "-- Memastikan seluruh tabel, kolom, master survei, dan 212 pertanyaan siap jalan\n";
$sql .= "-- Waktu Pembuatan: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- =====================================================================\n\n";

$sql .= "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n";
$sql .= "START TRANSACTION;\n";
$sql .= "SET time_zone = '+07:00';\n\n";

$sql .= "-- ---------------------------------------------------------------------\n";
$sql .= "-- 1. PASTIKAN STRUKTUR TABEL & KOLOM PENDUKUNG LENGKAP\n";
$sql .= "-- ---------------------------------------------------------------------\n\n";

$sql .= "CREATE TABLE IF NOT EXISTS `survei_dinamis` (\n";
$sql .= "  `Id` int(11) NOT NULL AUTO_INCREMENT,\n";
$sql .= "  `KodeSurvei` varchar(100) NOT NULL,\n";
$sql .= "  `Judul` varchar(255) NOT NULL,\n";
$sql .= "  `Deskripsi` text DEFAULT NULL,\n";
$sql .= "  `Lembaga` varchar(255) DEFAULT NULL,\n";
$sql .= "  `Jenis` varchar(100) NOT NULL DEFAULT 'IKM',\n";
$sql .= "  `Tahun` varchar(10) NOT NULL DEFAULT '2026',\n";
$sql .= "  `Status` varchar(20) NOT NULL DEFAULT 'Aktif',\n";
$sql .= "  `TipeSurvei` varchar(50) NOT NULL DEFAULT 'standar',\n";
$sql .= "  `InstrumenList` varchar(255) NOT NULL DEFAULT 'A,B,C,D,E',\n";
$sql .= "  `DaerahSurvei` varchar(255) DEFAULT NULL,\n";
$sql .= "  `KodeWilayah` varchar(50) DEFAULT NULL,\n";
$sql .= "  `BannerImage` varchar(255) DEFAULT NULL,\n";
$sql .= "  `BannerColor` varchar(30) DEFAULT '#043168',\n";
$sql .= "  `EstimasiWaktu` varchar(50) DEFAULT '5 - 15 Menit',\n";
$sql .= "  `CreatedBy` varchar(100) DEFAULT NULL,\n";
$sql .= "  `CreatedAt` datetime DEFAULT NULL,\n";
$sql .= "  `UpdatedAt` datetime DEFAULT NULL,\n";
$sql .= "  PRIMARY KEY (`Id`),\n";
$sql .= "  UNIQUE KEY `KodeSurvei` (`KodeSurvei`),\n";
$sql .= "  KEY `idx_kode_survei` (`KodeSurvei`)\n";
$sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;\n\n";

$sql .= "-- Penyesuaian kolom baru survei_dinamis\n";
$sql .= "ALTER TABLE `survei_dinamis` ADD COLUMN IF NOT EXISTS `TipeSurvei` VARCHAR(50) NOT NULL DEFAULT 'standar' AFTER `Status`;\n";
$sql .= "ALTER TABLE `survei_dinamis` ADD COLUMN IF NOT EXISTS `InstrumenList` VARCHAR(255) NOT NULL DEFAULT 'A,B,C,D,E' AFTER `TipeSurvei`;\n\n";

$sql .= "CREATE TABLE IF NOT EXISTS `survei_pertanyaan` (\n";
$sql .= "  `Id` int(11) NOT NULL AUTO_INCREMENT,\n";
$sql .= "  `SurveiId` int(11) NOT NULL,\n";
$sql .= "  `Instrumen` varchar(10) DEFAULT 'A',\n";
$sql .= "  `Pertanyaan` text NOT NULL,\n";
$sql .= "  `Deskripsi` text DEFAULT NULL,\n";
$sql .= "  `Section` varchar(150) DEFAULT NULL,\n";
$sql .= "  `Tipe` varchar(30) NOT NULL DEFAULT 'radio',\n";
$sql .= "  `OpsiPilihan` longtext DEFAULT NULL,\n";
$sql .= "  `IsRequired` tinyint(1) NOT NULL DEFAULT 1,\n";
$sql .= "  `Urutan` int(11) NOT NULL DEFAULT 1,\n";
$sql .= "  `ScaleMin` int(11) NOT NULL DEFAULT 1,\n";
$sql .= "  `ScaleMax` int(11) NOT NULL DEFAULT 5,\n";
$sql .= "  `ScaleMinLabel` varchar(100) DEFAULT 'Sangat Tidak Baik',\n";
$sql .= "  `ScaleMaxLabel` varchar(100) DEFAULT 'Sangat Baik',\n";
$sql .= "  `CreatedAt` datetime DEFAULT NULL,\n";
$sql .= "  `UpdatedAt` datetime DEFAULT NULL,\n";
$sql .= "  PRIMARY KEY (`Id`),\n";
$sql .= "  KEY `idx_survei_id` (`SurveiId`),\n";
$sql .= "  KEY `idx_urutan` (`Urutan`),\n";
$sql .= "  KEY `idx_instrumen` (`Instrumen`)\n";
$sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;\n\n";

$sql .= "-- Penyesuaian kolom baru survei_pertanyaan\n";
$sql .= "ALTER TABLE `survei_pertanyaan` ADD COLUMN IF NOT EXISTS `Instrumen` VARCHAR(10) DEFAULT 'A' AFTER `SurveiId`;\n";
$sql .= "ALTER TABLE `survei_pertanyaan` ADD COLUMN IF NOT EXISTS `Section` VARCHAR(150) NULL AFTER `Deskripsi`;\n\n";

$sql .= "CREATE TABLE IF NOT EXISTS `survei_responden` (\n";
$sql .= "  `Id` int(11) NOT NULL AUTO_INCREMENT,\n";
$sql .= "  `SurveiId` int(11) NOT NULL,\n";
$sql .= "  `Instrumen` varchar(10) DEFAULT 'A',\n";
$sql .= "  `RespondenNama` varchar(150) DEFAULT 'Masyarakat',\n";
$sql .= "  `RespondenNIK` varchar(25) DEFAULT NULL,\n";
$sql .= "  `RespondenKontak` varchar(100) DEFAULT NULL,\n";
$sql .= "  `RespondenGender` varchar(20) DEFAULT NULL,\n";
$sql .= "  `RespondenUsia` varchar(20) DEFAULT NULL,\n";
$sql .= "  `RespondenPendidikan` varchar(50) DEFAULT NULL,\n";
$sql .= "  `RespondenPekerjaan` varchar(100) DEFAULT NULL,\n";
$sql .= "  `Provinsi` varchar(100) DEFAULT NULL,\n";
$sql .= "  `Kabupaten` varchar(100) DEFAULT NULL,\n";
$sql .= "  `Kecamatan` varchar(100) DEFAULT NULL,\n";
$sql .= "  `Desa` varchar(100) DEFAULT NULL,\n";
$sql .= "  `AlamatDetail` text DEFAULT NULL,\n";
$sql .= "  `Latitude` decimal(11,8) DEFAULT NULL,\n";
$sql .= "  `Longitude` decimal(11,8) DEFAULT NULL,\n";
$sql .= "  `LokasiAccuracy` decimal(8,2) DEFAULT NULL,\n";
$sql .= "  `TotalSkor` decimal(10,2) NOT NULL DEFAULT 0.00,\n";
$sql .= "  `RataRataSkor` decimal(10,2) NOT NULL DEFAULT 0.00,\n";
$sql .= "  `MutuPelayanan` varchar(50) DEFAULT 'Baik',\n";
$sql .= "  `IpAddress` varchar(45) DEFAULT NULL,\n";
$sql .= "  `UserAgent` text DEFAULT NULL,\n";
$sql .= "  `DevicePlatform` varchar(100) DEFAULT NULL,\n";
$sql .= "  `CreatedBy` varchar(100) DEFAULT NULL,\n";
$sql .= "  `CreatedAt` datetime DEFAULT NULL,\n";
$sql .= "  PRIMARY KEY (`Id`),\n";
$sql .= "  KEY `idx_resp_survei_id` (`SurveiId`),\n";
$sql .= "  KEY `idx_resp_instrumen` (`Instrumen`),\n";
$sql .= "  KEY `idx_resp_created_at` (`CreatedAt`)\n";
$sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;\n\n";

$sql .= "-- Penyesuaian kolom baru survei_responden\n";
$sql .= "ALTER TABLE `survei_responden` ADD COLUMN IF NOT EXISTS `Instrumen` VARCHAR(10) DEFAULT 'A' AFTER `SurveiId`;\n";
$sql .= "ALTER TABLE `survei_responden` ADD COLUMN IF NOT EXISTS `RespondenNIK` VARCHAR(25) NULL DEFAULT NULL AFTER `RespondenNama`;\n";
$sql .= "ALTER TABLE `survei_responden` ADD COLUMN IF NOT EXISTS `Latitude` DECIMAL(11,8) NULL DEFAULT NULL AFTER `AlamatDetail`;\n";
$sql .= "ALTER TABLE `survei_responden` ADD COLUMN IF NOT EXISTS `Longitude` DECIMAL(11,8) NULL DEFAULT NULL AFTER `Latitude`;\n";
$sql .= "ALTER TABLE `survei_responden` ADD COLUMN IF NOT EXISTS `LokasiAccuracy` DECIMAL(8,2) NULL DEFAULT NULL AFTER `Longitude`;\n";
$sql .= "ALTER TABLE `survei_responden` ADD COLUMN IF NOT EXISTS `DevicePlatform` VARCHAR(100) NULL DEFAULT NULL AFTER `UserAgent`;\n\n";

$sql .= "CREATE TABLE IF NOT EXISTS `survei_jawaban` (\n";
$sql .= "  `Id` int(11) NOT NULL AUTO_INCREMENT,\n";
$sql .= "  `RespondenId` int(11) NOT NULL,\n";
$sql .= "  `PertanyaanId` int(11) NOT NULL,\n";
$sql .= "  `JawabanTeks` text DEFAULT NULL,\n";
$sql .= "  `NilaiAngka` decimal(10,2) NOT NULL DEFAULT 0.00,\n";
$sql .= "  `CreatedAt` datetime DEFAULT NULL,\n";
$sql .= "  PRIMARY KEY (`Id`),\n";
$sql .= "  KEY `idx_jwb_responden_id` (`RespondenId`),\n";
$sql .= "  KEY `idx_jwb_pertanyaan_id` (`PertanyaanId`)\n";
$sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;\n\n";

$sql .= "-- ---------------------------------------------------------------------\n";
$sql .= "-- 2. DATA UTAMA SURVEI RTKD BANYUWANGI (survei_dinamis Id = 4)\n";
$sql .= "-- ---------------------------------------------------------------------\n\n";

$sql .= "REPLACE INTO `survei_dinamis` (`Id`, `KodeSurvei`, `Judul`, `Deskripsi`, `Lembaga`, `Jenis`, `Tahun`, `Status`, `TipeSurvei`, `InstrumenList`, `DaerahSurvei`, `KodeWilayah`, `BannerImage`, `BannerColor`, `EstimasiWaktu`, `CreatedBy`, `CreatedAt`, `UpdatedAt`)\n";
$sql .= "VALUES (4, 'survei-ketenagakerjaan-banyuwangi-rtkd-2026', 'Survei Ketenagakerjaan Banyuwangi (RTKD)', 'Survei Primer Ketenagakerjaan Kabupaten Banyuwangi dalam rangka Penyusunan Rencana Tenaga Kerja Daerah (RTKD) 2026. Mencakup 5 Instrumen: A (Perusahaan/Pemberi Kerja), B (Pencari Kerja & Lulusan), C (Pemangku Kepentingan/Narasumber), E (AHP Perbandingan Isu Strategis), dan D (Siswa Kelas 12 Sekolah Menengah).', 'Dinas Tenaga Kerja, Transmigrasi dan Perindustrian Kab. Banyuwangi', 'Ketenagakerjaan', '2026', 'Aktif', 'multi', 'A,B,C,D,E', 'Kabupaten Banyuwangi', '35.10', 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=1200&q=80', '#043168', '15 - 25 Menit', 'Tim RTKD Banyuwangi', '2026-10-19 14:12:27', NOW());\n\n";

$sql .= "-- ---------------------------------------------------------------------\n";
$sql .= "-- 3. DAFTAR PERTANYAAN LENGKAP (212 BUTIR PERTANYAAN INSTRUMEN A, B, C, D, E)\n";
$sql .= "-- ---------------------------------------------------------------------\n\n";

$sql .= "DELETE FROM `survei_pertanyaan` WHERE `SurveiId` = 4;\n\n";

$res = $mysqli->query("SELECT * FROM survei_pertanyaan WHERE SurveiId = 4 ORDER BY Instrumen ASC, Urutan ASC");
$rows = [];
while ($row = $res->fetch_assoc()) {
    $rows[] = $row;
}

foreach ($rows as $r) {
    $pId = (int)$r['Id'];
    $sId = (int)$r['SurveiId'];
    $inst = $mysqli->real_escape_string($r['Instrumen']);
    $pert = $mysqli->real_escape_string($r['Pertanyaan']);
    $desk = $r['Deskripsi'] !== null ? "'" . $mysqli->real_escape_string($r['Deskripsi']) . "'" : "NULL";
    $sect = $r['Section'] !== null ? "'" . $mysqli->real_escape_string($r['Section']) . "'" : "NULL";
    $tipe = $mysqli->real_escape_string($r['Tipe']);
    $opsi = $r['OpsiPilihan'] !== null ? "'" . $mysqli->real_escape_string($r['OpsiPilihan']) . "'" : "NULL";
    $isReq = (int)$r['IsRequired'];
    $urut = (int)$r['Urutan'];
    $sMin = (int)$r['ScaleMin'];
    $sMax = (int)$r['ScaleMax'];
    $sMinL = $mysqli->real_escape_string($r['ScaleMinLabel'] ?? 'Sangat Tidak Baik');
    $sMaxL = $mysqli->real_escape_string($r['ScaleMaxLabel'] ?? 'Sangat Baik');
    $created = $r['CreatedAt'] ?: date('Y-m-d H:i:s');
    $updated = $r['UpdatedAt'] ?: date('Y-m-d H:i:s');

    $sql .= "INSERT INTO `survei_pertanyaan` (`Id`, `SurveiId`, `Instrumen`, `Pertanyaan`, `Deskripsi`, `Section`, `Tipe`, `OpsiPilihan`, `IsRequired`, `Urutan`, `ScaleMin`, `ScaleMax`, `ScaleMinLabel`, `ScaleMaxLabel`, `CreatedAt`, `UpdatedAt`) VALUES ({$pId}, {$sId}, '{$inst}', '{$pert}', {$desk}, {$sect}, '{$tipe}', {$opsi}, {$isReq}, {$urut}, {$sMin}, {$sMax}, '{$sMinL}', '{$sMaxL}', '{$created}', '{$updated}');\n";
}

$sql .= "\n-- ---------------------------------------------------------------------\n";
$sql .= "-- 4. QUERY PEMERIKSAAN KESEHATAN SISTEM DATABASE\n";
$sql .= "-- ---------------------------------------------------------------------\n\n";
$sql .= "-- Periksa Status Survei Dinamis\n";
$sql .= "SELECT `Id`, `KodeSurvei`, `Judul`, `TipeSurvei`, `InstrumenList`, `Status` FROM `survei_dinamis` WHERE `Id` = 4;\n\n";
$sql .= "-- Periksa Jumlah Pertanyaan per Instrumen (Total harus 212 butir)\n";
$sql .= "SELECT `Instrumen`, COUNT(*) AS `JumlahPertanyaan` FROM `survei_pertanyaan` WHERE `SurveiId` = 4 GROUP BY `Instrumen` ORDER BY `Instrumen`;\n\n";
$sql .= "-- Periksa Jumlah Responden Masuk per Instrumen\n";
$sql .= "SELECT `Instrumen`, COUNT(*) AS `JumlahResponden`, ROUND(AVG(`TotalSkor`), 2) AS `RataSkor` FROM `survei_responden` WHERE `SurveiId` = 4 GROUP BY `Instrumen` ORDER BY `Instrumen`;\n\n";

$sql .= "COMMIT;\n";

file_put_contents('database_update_rtkd.sql', $sql);
echo "Berhasil menghasilkan database_update_rtkd.sql (" . strlen($sql) . " bytes) dengan " . count($rows) . " pertanyaan.\n";
