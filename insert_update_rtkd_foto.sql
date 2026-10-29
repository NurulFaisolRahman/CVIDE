-- =====================================================================
-- SCRIPT SQL INSERT & UPDATE: FITUR UPLOAD FOTO SURVEI RTKD BANYUWANGI
-- Gunakan script ini untuk memperbarui database production di cPanel / phpMyAdmin
-- Waktu Pembuatan: 2026-10-27
-- =====================================================================

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
START TRANSACTION;
SET time_zone = '+07:00';

-- ---------------------------------------------------------------------
-- 1. PENYESUAIAN STRUKTUR TABEL & PENAMBAHAN KOLOM FOTO DOKUMENTASI
-- ---------------------------------------------------------------------

-- Pastikan tabel survei_responden memiliki kolom FotoDokumentasi
ALTER TABLE `survei_responden` 
  ADD COLUMN IF NOT EXISTS `FotoDokumentasi` VARCHAR(255) NULL DEFAULT NULL AFTER `LokasiAccuracy`;

-- Pastikan kolom pendukung geolokasi & instrumen lainnya tersedia
ALTER TABLE `survei_responden` 
  ADD COLUMN IF NOT EXISTS `Instrumen` VARCHAR(10) DEFAULT 'A' AFTER `SurveiId`,
  ADD COLUMN IF NOT EXISTS `RespondenNIK` VARCHAR(25) NULL DEFAULT NULL AFTER `RespondenNama`,
  ADD COLUMN IF NOT EXISTS `Latitude` DECIMAL(11,8) NULL DEFAULT NULL AFTER `AlamatDetail`,
  ADD COLUMN IF NOT EXISTS `Longitude` DECIMAL(11,8) NULL DEFAULT NULL AFTER `Latitude`,
  ADD COLUMN IF NOT EXISTS `LokasiAccuracy` DECIMAL(8,2) NULL DEFAULT NULL AFTER `Longitude`,
  ADD COLUMN IF NOT EXISTS `DevicePlatform` VARCHAR(100) NULL DEFAULT NULL AFTER `UserAgent`;

-- Pastikan tabel survei_pertanyaan memiliki kolom pendukung
ALTER TABLE `survei_pertanyaan` 
  ADD COLUMN IF NOT EXISTS `Instrumen` VARCHAR(10) DEFAULT 'A' AFTER `SurveiId`,
  ADD COLUMN IF NOT EXISTS `Section` VARCHAR(150) NULL AFTER `Deskripsi`;

-- Pastikan tabel survei_dinamis mendukung multi-instrumen
ALTER TABLE `survei_dinamis` 
  ADD COLUMN IF NOT EXISTS `TipeSurvei` VARCHAR(50) NOT NULL DEFAULT 'standar' AFTER `Status`,
  ADD COLUMN IF NOT EXISTS `InstrumenList` VARCHAR(255) NOT NULL DEFAULT 'A,B,C,D,E' AFTER `TipeSurvei`;

-- ---------------------------------------------------------------------
-- 2. UPDATE MASTER SURVEI DINAMIS (ID = 4: SURVEI RTKD BANYUWANGI)
-- ---------------------------------------------------------------------
REPLACE INTO `survei_dinamis` (
  `Id`, `KodeSurvei`, `Judul`, `Deskripsi`, `Lembaga`, `Jenis`, `Tahun`, 
  `Status`, `TipeSurvei`, `InstrumenList`, `DaerahSurvei`, `KodeWilayah`, 
  `BannerImage`, `BannerColor`, `EstimasiWaktu`, `CreatedBy`, `CreatedAt`, `UpdatedAt`
) VALUES (
  4, 
  'survei-ketenagakerjaan-banyuwangi-rtkd-2026', 
  'Survei Ketenagakerjaan Banyuwangi (RTKD)', 
  'Survei Primer Ketenagakerjaan Kabupaten Banyuwangi dalam rangka Penyusunan Rencana Tenaga Kerja Daerah (RTKD) 2026. Mencakup 5 Instrumen: A (Perusahaan/Pemberi Kerja), B (Pencari Kerja & Lulusan), C (Pemangku Kepentingan/Narasumber), E (AHP Perbandingan Isu Strategis), dan D (Siswa Kelas 12 Sekolah Menengah).', 
  'Dinas Tenaga Kerja, Transmigrasi dan Perindustrian Kab. Banyuwangi', 
  'Ketenagakerjaan', 
  '2026', 
  'Aktif', 
  'multi', 
  'A,B,C,D,E', 
  'Kabupaten Banyuwangi', 
  '35.10', 
  'https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=1200&q=80', 
  '#043168', 
  '15 - 25 Menit', 
  'Tim RTKD Banyuwangi', 
  '2026-10-19 14:12:27', 
  NOW()
);

-- ---------------------------------------------------------------------
-- 3. QUERY VERIFIKASI KEBERHASILAN UPDATE DATABASE
-- ---------------------------------------------------------------------
-- Cek keberadaan kolom FotoDokumentasi di survei_responden
SHOW COLUMNS FROM `survei_responden` LIKE 'FotoDokumentasi';

-- Cek master survei RTKD Id 4
SELECT `Id`, `KodeSurvei`, `Judul`, `TipeSurvei`, `InstrumenList`, `Status` 
FROM `survei_dinamis` WHERE `Id` = 4;

-- Cek jumlah pertanyaan aktif per instrumen
SELECT `Instrumen`, COUNT(*) AS `TotalPertanyaan` 
FROM `survei_pertanyaan` WHERE `SurveiId` = 4 
GROUP BY `Instrumen` ORDER BY `Instrumen`;

COMMIT;
