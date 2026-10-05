-- =========================================================================
-- STRUKTUR DATABASE MODUL OLAH DATA (CVIDE)
-- Database: `cvide`
-- Tabel: `olah_data_daerah` & `olah_data_indikator`
-- =========================================================================

SET FOREIGN_KEY_CHECKS = 0;

-- -------------------------------------------------------------------------
-- 1. TABEL DAERAH: `olah_data_daerah`
-- Menyimpan profil daerah/kabupaten/kota serta daftar kolom tahun yang aktif
-- -------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `olah_data_daerah` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `NamaDaerah` VARCHAR(255) NOT NULL COMMENT 'Nama Kabupaten/Kota, contoh: Kabupaten Banyuwangi',
  `Keterangan` TEXT NULL COMMENT 'Catatan ringkas profil daerah',
  `TahunList` TEXT NULL COMMENT 'Array JSON tahun aktif, contoh: ["2020","2021","2022","2023","2024"]',
  `CreatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------------------
-- 2. TABEL INDIKATOR: `olah_data_indikator`
-- Menyimpan indikator data berdasarkan Kategori, Sub-Kategori, Gender, Satuan,
-- serta nilai data tahunan dinamis dalam format JSON object.
-- -------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `olah_data_indikator` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `DaerahId` INT(11) NOT NULL COMMENT 'Relasi ke Id di olah_data_daerah',
  `NamaIndikator` VARCHAR(255) NOT NULL COMMENT 'Nama indikator data',
  `Kategori` VARCHAR(100) NULL COMMENT 'Kategori Utama (Pilar 1 s.d 5)',
  `SubKategori` VARCHAR(255) NULL COMMENT 'Sub-Kategori, contoh: Kesehatan, Demografi, dll',
  `Gender` VARCHAR(50) NULL DEFAULT 'Total' COMMENT 'Pilihan: Total, Laki-laki, Perempuan, L+P',
  `Satuan` VARCHAR(100) NULL COMMENT 'Satuan nilai, contoh: %, Jiwa, km², Ha, Rp',
  `DataTahun` TEXT NULL COMMENT 'JSON key-value nilai tahun, contoh: {"2020":"12.5","2021":"13.2"}',
  `ApiUrl` VARCHAR(1000) NULL COMMENT 'Endpoint URL REST API / JSON untuk sinkronisasi otomatis',
  `TipeSumber` ENUM('manual','api') NOT NULL DEFAULT 'manual' COMMENT 'Metode input: manual atau api',
  `Keterangan` TEXT NULL COMMENT 'Catatan metodologi / sumber data',
  `Urutan` INT(11) NOT NULL DEFAULT 1 COMMENT 'Urutan display indikator',
  `CreatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `idx_daerah_id` (`DaerahId`),
  KEY `idx_kategori` (`Kategori`),
  KEY `idx_subkategori` (`SubKategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------------------
-- 3. QUERY ALTER TABLE (Gunakan jika tabel Anda sudah ada sebelumnya)
-- -------------------------------------------------------------------------
-- ALTER TABLE `olah_data_indikator` ADD COLUMN IF NOT EXISTS `Kategori` VARCHAR(100) NULL AFTER `NamaIndikator`;
-- ALTER TABLE `olah_data_indikator` ADD COLUMN IF NOT EXISTS `SubKategori` VARCHAR(255) NULL AFTER `Kategori`;
-- ALTER TABLE `olah_data_indikator` ADD COLUMN IF NOT EXISTS `ApiUrl` VARCHAR(1000) NULL AFTER `DataTahun`;
-- ALTER TABLE `olah_data_indikator` ADD COLUMN IF NOT EXISTS `TipeSumber` ENUM('manual','api') NOT NULL DEFAULT 'manual' AFTER `ApiUrl`;

SET FOREIGN_KEY_CHECKS = 1;
