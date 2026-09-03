<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
$sampleLinks = json_encode(array(
    array('judul' => 'Master Folder IKM 2026', 'url' => 'https://drive.google.com/drive/folders/sample1'),
    array('judul' => 'Spreadsheet Raw Data', 'url' => 'https://docs.google.com/spreadsheets/d/sample2')
));
$stmt = $mysqli->prepare("INSERT INTO bank_data (PJ, NamaDokumen, LinkGDrive) VALUES ('Staf', 'Master Kuesioner IKM & Instrumen Survei 2026', ?)");
$stmt->bind_param("s", $sampleLinks);
$stmt->execute();

$res = $mysqli->query("SELECT * FROM bank_data");
while($r = $res->fetch_assoc()) {
    print_r($r);
}
