<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS `bank_data` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PJ` varchar(70) NOT NULL DEFAULT 'Staf',
  `NamaData` varchar(255) NOT NULL,
  `Kategori` varchar(100) DEFAULT NULL,
  `Tag` text DEFAULT NULL,
  `Tahun` varchar(50) DEFAULT NULL,
  `Keterangan` text DEFAULT NULL,
  `File` text DEFAULT NULL,
  `CreatedAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($mysqli->query($sql)) {
    echo "Table 'bank_data' is ready.\n";
} else {
    echo "Error creating table: " . $mysqli->error . "\n";
}
