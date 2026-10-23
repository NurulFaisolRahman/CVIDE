<?php
$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
$row = $pdo->query('SELECT * FROM survei_dinamis WHERE Id = 4')->fetch(PDO::FETCH_ASSOC);
print_r($row);
