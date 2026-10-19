<?php
$lines = file('application/views/MenuSurvei.php');
foreach ($lines as $i => $l) {
  if (strpos($l, '.survey-custom-banner') !== false || strpos($l, '.survey-respondent-box') !== false) {
    echo ($i+1) . ': ' . trim($l) . "\n";
  }
}
