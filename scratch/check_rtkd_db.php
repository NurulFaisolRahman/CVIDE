<?php
$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
$stmt = $pdo->query('SELECT Id, Judul, Deskripsi, Lembaga, BannerColor, BannerImage, DaerahSurvei, Jenis, Tahun FROM survei_dinamis WHERE Id = 4 OR Judul LIKE "%RTKD%"');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);
