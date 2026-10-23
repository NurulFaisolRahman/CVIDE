<?php
$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
$res = $pdo->query("SELECT IsRequired, count(*) as c FROM survei_pertanyaan WHERE SurveiId = 4 AND Instrumen = 'E' GROUP BY IsRequired")->fetchAll(PDO::FETCH_ASSOC);
print_r($res);
