<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
foreach ([135, 136, 137, 138] as $rid) {
  $r = $m->query("SELECT r.Id, r.Instrumen, r.RespondenNama, r.Kecamatan, r.MutuPelayanan, COUNT(j.Id) as jml_jawaban FROM survei_responden r LEFT JOIN survei_jawaban j ON r.Id = j.RespondenId WHERE r.Id = $rid GROUP BY r.Id")->fetch_assoc();
  echo "Responden #{$r['Id']} [Instrumen {$r['Instrumen']}]: {$r['RespondenNama']} ({$r['Kecamatan']}) - {$r['jml_jawaban']} answers stored, Mutu: {$r['MutuPelayanan']}\n";
  
  $jwb = $m->query("SELECT j.PertanyaanId, p.Pertanyaan, j.JawabanTeks, j.NilaiAngka FROM survei_jawaban j JOIN survei_pertanyaan p ON j.PertanyaanId = p.Id WHERE j.RespondenId = $rid LIMIT 3");
  while ($row = $jwb->fetch_assoc()) {
    echo "  - {$row['Pertanyaan']}: {$row['JawabanTeks']} (Skor: {$row['NilaiAngka']})\n";
  }
  echo "\n";
}
