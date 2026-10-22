<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
$res = $m->query('SELECT Instrumen, count(*) as c FROM survei_pertanyaan WHERE SurveiId = 4 GROUP BY Instrumen');
while ($r = $res->fetch_assoc()) {
    echo $r['Instrumen'] . ': ' . $r['c'] . PHP_EOL;
}
