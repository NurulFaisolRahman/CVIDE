<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
$mysqli->query("DELETE FROM survei_jawaban WHERE RespondenId >= 204");
$mysqli->query("DELETE FROM survei_responden WHERE Id >= 204");
echo "Cleaned test records >= 204.\n";
