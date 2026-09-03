<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$mysqli->query("DROP TABLE IF EXISTS `bank_data`");

$sql = "CREATE TABLE `bank_data` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `PJ` varchar(70) NOT NULL DEFAULT 'Staf',
  `NamaDokumen` varchar(255) NOT NULL,
  `LinkGDrive` text DEFAULT NULL,
  `CreatedAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($mysqli->query($sql)) {
    echo "Table 'bank_data' reconstructed successfully with NamaDokumen and LinkGDrive.\n";
} else {
    echo "Error: " . $mysqli->error . "\n";
}
