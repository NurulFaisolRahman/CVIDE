<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
if ($m->connect_error) die($m->connect_error);

// Add TipeSurvei if not exists
$check1 = $m->query("SHOW COLUMNS FROM survei_dinamis LIKE 'TipeSurvei'");
if ($check1->num_rows === 0) {
  $m->query("ALTER TABLE survei_dinamis ADD COLUMN TipeSurvei VARCHAR(50) NOT NULL DEFAULT 'standar' AFTER Status");
  echo "Added column TipeSurvei\n";
} else {
  echo "Column TipeSurvei already exists\n";
}

// Add InstrumenList if not exists
$check2 = $m->query("SHOW COLUMNS FROM survei_dinamis LIKE 'InstrumenList'");
if ($check2->num_rows === 0) {
  $m->query("ALTER TABLE survei_dinamis ADD COLUMN InstrumenList VARCHAR(255) NOT NULL DEFAULT 'A' AFTER TipeSurvei");
  echo "Added column InstrumenList\n";
} else {
  echo "Column InstrumenList already exists\n";
}

// Update survey 4 to be multi-instrument
$m->query("UPDATE survei_dinamis SET TipeSurvei = 'multi', InstrumenList = 'A,B,C,D' WHERE Id = 4");
echo "Updated survey 4 to TipeSurvei = 'multi', InstrumenList = 'A,B,C,D'\n";

// Verify
$res = $m->query("SELECT Id, Judul, TipeSurvei, InstrumenList FROM survei_dinamis WHERE Id = 4")->fetch_assoc();
print_r($res);
