<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
$res = $mysqli->query('DESCRIBE project');
while($row = $res->fetch_assoc()) {
    echo $row['Field'] . " | " . $row['Type'] . " | " . $row['Null'] . "\n";
}
