<?php
$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
$res = $pdo->query("SELECT Id, Instrumen, Pertanyaan FROM survei_pertanyaan WHERE SurveiId = 4")->fetchAll(PDO::FETCH_ASSOC);

$matched = 0;
$unmatched = [];
foreach ($res as $r) {
    if (preg_match('/^\[([A-Za-z0-9_]+)\]/', $r['Pertanyaan'], $m)) {
        $matched++;
    } else {
        $unmatched[] = $r;
    }
}
echo "Total questions: " . count($res) . "\n";
echo "Matched regex: " . $matched . "\n";
echo "Unmatched: " . count($unmatched) . "\n";
print_r($unmatched);
