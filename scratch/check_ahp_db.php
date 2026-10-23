<?php
$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
$stmt = $pdo->query("SELECT Id, Pertanyaan, Tipe, Instrumen FROM survei_pertanyaan WHERE SurveiId = 4 AND Instrumen = 'E' LIMIT 10");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $r['Id'] . ' | ' . $r['Instrumen'] . ' | ' . $r['Tipe'] . ' | ' . $r['Pertanyaan'] . "\n";
}
