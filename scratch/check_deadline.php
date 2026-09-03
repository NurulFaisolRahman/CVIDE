<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
$res = $mysqli->query('SELECT Id, NamaProject, Deadline FROM project LIMIT 20');
while($row = $res->fetch_assoc()) {
    echo $row['Id'] . " | " . $row['NamaProject'] . " | " . $row['Deadline'] . "\n";
}
