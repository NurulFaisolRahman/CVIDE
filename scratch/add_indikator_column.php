<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$check = $mysqli->query("SHOW COLUMNS FROM bank_data LIKE 'Indikator'");
if ($check->num_rows == 0) {
    $sql = "ALTER TABLE bank_data ADD COLUMN Indikator VARCHAR(255) NULL AFTER LinkGDrive";
    if ($mysqli->query($sql)) {
        echo "Successfully added column 'Indikator' to bank_data table.\n";
    } else {
        echo "Error: " . $mysqli->error . "\n";
    }
} else {
    echo "Column 'Indikator' already exists in bank_data table.\n";
}
