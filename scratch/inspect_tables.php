<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
if ($m->connect_error) {
    die("Connect error: " . $m->connect_error);
}

$tables = ['survei_dinamis', 'survei_pertanyaan', 'survei_responden', 'survei_jawaban'];
foreach ($tables as $t) {
    echo "=== Table: $t ===\n";
    $res = $m->query("DESCRIBE `$t`");
    if ($res) {
        while ($r = $res->fetch_assoc()) {
            echo "  {$r['Field']} | {$r['Type']} | Null: {$r['Null']} | Default: {$r['Default']}\n";
        }
    } else {
        echo "  Table does not exist!\n";
    }
}
