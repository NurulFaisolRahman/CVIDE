<?php
$mysqli = new mysqli('localhost', 'root', '', 'cvide');
if ($mysqli->connect_error) {
    die("Connect Error: " . $mysqli->connect_error);
}

echo "=== SURVEI DINAMIS (ID = 4) ===\n";
$res = $mysqli->query("SELECT Id, KodeSurvei, Judul, TipeSurvei, InstrumenList, Status FROM survei_dinamis WHERE Id = 4");
print_r($res->fetch_assoc());

echo "\n=== PERTANYAAN PER INSTRUMEN (ID = 4) ===\n";
$res = $mysqli->query("SELECT Instrumen, COUNT(*) as Total FROM survei_pertanyaan WHERE SurveiId = 4 GROUP BY Instrumen ORDER BY Instrumen ASC");
while ($row = $res->fetch_assoc()) {
    echo "Instrumen {$row['Instrumen']}: {$row['Total']} pertanyaan\n";
}

echo "\n=== TOTAL RESPONDEN PER INSTRUMEN (ID = 4) ===\n";
$res = $mysqli->query("SELECT Instrumen, COUNT(*) as Total FROM survei_responden WHERE SurveiId = 4 GROUP BY Instrumen ORDER BY Instrumen ASC");
while ($row = $res->fetch_assoc()) {
    echo "Instrumen {$row['Instrumen']}: {$row['Total']} responden\n";
}

echo "\n=== CHECK COLUMNS IN survei_responden ===\n";
$res = $mysqli->query("SHOW COLUMNS FROM survei_responden");
$cols = [];
while ($row = $res->fetch_assoc()) {
    $cols[] = $row['Field'] . ' (' . $row['Type'] . ')';
}
echo implode(", ", $cols) . "\n";

echo "\n=== CHECK COLUMNS IN survei_pertanyaan ===\n";
$res = $mysqli->query("SHOW COLUMNS FROM survei_pertanyaan");
$cols = [];
while ($row = $res->fetch_assoc()) {
    $cols[] = $row['Field'] . ' (' . $row['Type'] . ')';
}
echo implode(", ", $cols) . "\n";
