<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$check = $mysqli->query("SHOW COLUMNS FROM project LIKE 'Tag'");
if ($check->num_rows == 0) {
    $sql = "ALTER TABLE project ADD COLUMN Tag TEXT NULL AFTER Kategori";
    if ($mysqli->query($sql)) {
        echo "Successfully added column 'Tag' to project table.\n";
    } else {
        echo "Error adding column: " . $mysqli->error . "\n";
    }
} else {
    echo "Column 'Tag' already exists in project table.\n";
}
