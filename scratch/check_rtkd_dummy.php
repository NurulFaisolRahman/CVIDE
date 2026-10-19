<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
$r = $m->query("SELECT COUNT(*) as c FROM survei_responden WHERE SurveiId = 4")->fetch_assoc();
echo "Survei 4 respondents: " . $r['c'] . "\n";

$j = $m->query("SELECT COUNT(*) as c FROM survei_jawaban WHERE RespondenId IN (SELECT Id FROM survei_responden WHERE SurveiId = 4)")->fetch_assoc();
echo "Survei 4 answers: " . $j['c'] . "\n";

$s = $m->query("SELECT Id, Judul, TotalResponden, RataRataSkor FROM survei_dinamis WHERE Id = 4")->fetch_assoc();
print_r($s);
