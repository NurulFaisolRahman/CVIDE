<?php
$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
$stmt = $pdo->query("SELECT Id, Pertanyaan, Tipe, Urutan FROM survei_pertanyaan WHERE SurveiId = 4 AND Instrumen = 'C' ORDER BY Urutan ASC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Id'] . ' | ' . $row['Urutan'] . ' | ' . $row['Pertanyaan'] . ' | ' . $row['Tipe'] . "\n";
}
