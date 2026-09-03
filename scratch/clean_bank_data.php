<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
$mysqli->query("TRUNCATE TABLE bank_data");
echo "bank_data table cleaned.\n";
