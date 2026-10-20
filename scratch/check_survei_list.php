<?php
$c = mysqli_connect("localhost", "root", "", "cvide");
$res = mysqli_query($c, "SELECT Id, Judul, Lembaga, TipeSurvei, Status FROM survei_dinamis ORDER BY Id DESC");
while ($r = mysqli_fetch_assoc($res)) {
    $qCount = mysqli_fetch_assoc(mysqli_query($c, "SELECT count(*) as c FROM survei_pertanyaan WHERE SurveiId = " . $r['Id']))['c'];
    echo "ID: {$r['Id']} | Judul: {$r['Judul']} | Tipe: {$r['TipeSurvei']} | Status: {$r['Status']} | Pertanyaan: {$qCount}\n";
}
