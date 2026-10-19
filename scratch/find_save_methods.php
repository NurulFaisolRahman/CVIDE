<?php
$lines = file('application/controllers/IDE.php');
foreach ($lines as $i => $l) {
  if (strpos($l, 'save_survei_dinamis') !== false || strpos($l, 'save_survei_pertanyaan_batch') !== false) {
    echo ($i+1) . ': ' . trim($l) . "\n";
  }
}
