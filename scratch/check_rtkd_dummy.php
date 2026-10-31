<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
$s = $m->query("SELECT * FROM survei_dinamis WHERE Id = 4")->fetch_assoc();
print_r($s);

$res = $m->query("SELECT Instrumen, RespondenGender, COUNT(*) as c FROM survei_responden WHERE SurveiId = 4 GROUP BY Instrumen, RespondenGender");
while ($row = $res->fetch_assoc()) {
    print_r($row);
}
