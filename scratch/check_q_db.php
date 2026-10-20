<?php
$c = mysqli_connect("localhost", "root", "", "cvide");
$res = mysqli_query($c, "SELECT Id, Instrumen, Pertanyaan, Section, Tipe FROM survei_pertanyaan WHERE SurveiId = 4 LIMIT 10");
while ($r = mysqli_fetch_assoc($res)) {
    print_r($r);
}
