<?php
$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
foreach (['survei_responden', 'survei_pertanyaan', 'survei_jawaban', 'survei_dinamis'] as $t) {
    echo "=== TABLE: $t ===\n";
    $stmt = $pdo->query("SHOW CREATE TABLE `$t`");
    echo $stmt->fetchColumn(1) . "\n\n";
}
