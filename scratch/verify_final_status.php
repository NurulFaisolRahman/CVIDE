<?php
$conn = new mysqli('localhost', 'root', '', 'cvide');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "=== 1. VERIFIKASI DATA DUMMY SURVEI RTKD (SURVEI ID 4) ===\n";
$resR = $conn->query("SELECT COUNT(*) AS total FROM survei_responden WHERE SurveiId = 4");
$rowR = $resR->fetch_assoc();
echo "Total Responden Survei 4: " . $rowR['total'] . " (Harus 0)\n";

$resJ = $conn->query("SELECT COUNT(*) AS total FROM survei_jawaban WHERE PertanyaanId IN (SELECT Id FROM survei_pertanyaan WHERE SurveiId = 4)");
$rowJ = $resJ->fetch_assoc();
echo "Total Jawaban Survei 4: " . $rowJ['total'] . " (Harus 0)\n";

echo "\n=== 2. VERIFIKASI STRUKTUR TABEL SURVEI DINAMIS & PERTANYAAN ===\n";
$colTipe = $conn->query("SHOW COLUMNS FROM survei_dinamis LIKE 'TipeSurvei'")->num_rows;
$colInstList = $conn->query("SHOW COLUMNS FROM survei_dinamis LIKE 'InstrumenList'")->num_rows;
echo "Kolom TipeSurvei di survei_dinamis: " . ($colTipe ? "ADA (OK)" : "TIDAK ADA") . "\n";
echo "Kolom InstrumenList di survei_dinamis: " . ($colInstList ? "ADA (OK)" : "TIDAK ADA") . "\n";

$colSec = $conn->query("SHOW COLUMNS FROM survei_pertanyaan LIKE 'Section'")->num_rows;
$colInst = $conn->query("SHOW COLUMNS FROM survei_pertanyaan LIKE 'Instrumen'")->num_rows;
echo "Kolom Section di survei_pertanyaan: " . ($colSec ? "ADA (OK)" : "TIDAK ADA") . "\n";
echo "Kolom Instrumen di survei_pertanyaan: " . ($colInst ? "ADA (OK)" : "TIDAK ADA") . "\n";

echo "\n=== 3. DETAIL METADATA SURVEI ID 4 ===\n";
$survei4 = $conn->query("SELECT Id, Judul, TipeSurvei, InstrumenList, Status FROM survei_dinamis WHERE Id = 4")->fetch_assoc();
print_r($survei4);

echo "\n=== 4. DISTRIBUSI PERTANYAAN PER INSTRUMEN (SURVEI ID 4) ===\n";
$qDist = $conn->query("SELECT Instrumen, COUNT(*) AS count FROM survei_pertanyaan WHERE SurveiId = 4 GROUP BY Instrumen");
while($row = $qDist->fetch_assoc()) {
    echo "Instrumen " . $row['Instrumen'] . ": " . $row['count'] . " butir pertanyaan\n";
}

$conn->close();
