<?php
// Test simulation of loading survey 4 detail and RTKD engine rendering logic
$ch = curl_init('http://localhost/CVIDE/IDE/get_survei_detail/4');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
curl_close($ch);

$data = json_decode($res, true);
echo "API get_survei_detail/4 Status: " . ($data['status'] ? 'OK' : 'FAIL') . "\n";
echo "Judul Survei: " . $data['survei']['Judul'] . "\n";
echo "Tipe Survei: " . $data['survei']['TipeSurvei'] . "\n";
echo "Total Pertanyaan DB: " . count($data['pertanyaan']) . "\n";

// Verify that survei_rtkd_engine.js file exists and has correct syntax
$jsContent = file_get_contents('assets/js/survei_rtkd_engine.js');
echo "survei_rtkd_engine.js size: " . strlen($jsContent) . " bytes\n";
echo "Contains Array.isArray(q.f): " . (strpos($jsContent, 'Array.isArray(q.f)') !== false ? 'YES' : 'NO') . "\n";
echo "Contains Array.isArray(q.o): " . (strpos($jsContent, 'Array.isArray(q.o)') !== false ? 'YES' : 'NO') . "\n";
echo "Contains isSingle scale check: " . (strpos($jsContent, 'isSingle') !== false ? 'YES' : 'NO') . "\n";

// Verify MenuSurvei.php check for surveyId != 4
$viewContent = file_get_contents('application/views/MenuSurvei.php');
echo "MenuSurvei.php preserves RTKD master schema (surveyId != 4): " . (strpos($viewContent, 'surveyId != 4') !== false ? 'YES' : 'NO') . "\n";
echo "MenuSurvei.php guards mini-map for multi surveys: " . (strpos($viewContent, 'if (!isMulti)') !== false ? 'YES' : 'NO') . "\n";
