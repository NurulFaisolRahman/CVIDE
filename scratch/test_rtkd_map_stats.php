<?php
// Test verification script for RTKD map statistic cards and filters

echo "=== 1. VERIFIKASI FILE CSS survei_rtkd.css ===\n";
$css = file_get_contents('assets/css/survei_rtkd.css');
$checkCss = [
  'gis-filter-toolbar-container',
  'gis-stat-cards-wrapper',
  'gis-stat-card',
  'card-total',
  'card-inst',
  'card-gender',
  'card-mutu',
  'card-geo',
  'inst-mini-chip',
  'gender-split-bar'
];
foreach ($checkCss as $c) {
  echo "CSS .{$c}: " . (strpos($css, $c) !== false ? 'OK' : 'MISSING') . "\n";
}

echo "\n=== 2. VERIFIKASI HTML & JS SurveyDashboard.php ===\n";
$sd = file_get_contents('application/views/SurveyDashboard.php');
$checkSd = [
  'gis-filter-toolbar-container',
  'gisInstrumenFilter',
  'gisGenderFilter',
  'gisKecamatanFilter',
  'gisMutuFilter',
  'gisStatCardsWrapper',
  'statFilteredTotal',
  'statInstChipsList',
  'statGenderMaleCount',
  'statAvgScore',
  'statKecCount',
  'applyGisFilters',
  'updateGisRtkdStatCards',
  'quickFilterInstrumen',
  'quickFilterGender',
  'resetGisFilters'
];
foreach ($checkSd as $item) {
  echo "SurveyDashboard {$item}: " . (strpos($sd, $item) !== false ? 'OK' : 'MISSING') . "\n";
}

echo "\n=== 3. VERIFIKASI HTML & JS MenuSurvei.php ===\n";
$ms = file_get_contents('application/views/MenuSurvei.php');
$checkMs = [
  'geoStatCardsWrapper',
  'geoInstrumenFilter',
  'geoGenderFilter',
  'geoKecamatanFilter',
  'geoMutuFilter',
  'geoKpiTotal',
  'geoInstChipsList',
  'geoGenderMaleCount',
  'geoKpiSkor',
  'geoKpiKecamatan',
  'applyMenuSurveiGeoFilters',
  'updateMenuSurveiRtkdStatCards',
  'quickFilterMenuSurveiInst',
  'quickFilterMenuSurveiGender',
  'resetMenuSurveiFilters'
];
foreach ($checkMs as $item) {
  echo "MenuSurvei {$item}: " . (strpos($ms, $item) !== false ? 'OK' : 'MISSING') . "\n";
}

echo "\n=== 4. VERIFIKASI DATABASE DATA RESPONDEN RTKD ===\n";
$m = new mysqli('localhost', 'root', '', 'cvide');
$res = $m->query("SELECT Instrumen, RespondenGender, COUNT(*) as c FROM survei_responden WHERE SurveiId = 4 GROUP BY Instrumen, RespondenGender");
while ($r = $res->fetch_assoc()) {
  $ins = $r['Instrumen'] ?: 'A';
  $gen = $r['RespondenGender'] ?: 'Tidak Mengisi';
  echo "Instrumen {$ins} | Gender: {$gen} -> {$r['c']} responden\n";
}

echo "\nSemua pengecekan berhasil dilakukan!\n";
