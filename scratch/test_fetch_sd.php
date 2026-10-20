<?php
// Test fetching SurveyDashboard HTML with login session
$ch = curl_init('http://localhost/CVIDE/IDE/MenuSurvei');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Simulate admin session
curl_setopt($ch, CURLOPT_COOKIE, 'ci_session=dummy');
$html = curl_exec($ch);
curl_close($ch);

echo "Fetched " . strlen($html) . " bytes\n";
if (strpos($html, 'Bagian 3: Butir Pertanyaan Penilaian Kuesioner') !== false) {
    echo "Found Bagian 3: Butir Pertanyaan Penilaian Kuesioner in output!\n";
} else {
    echo "Not found in output (possibly not logged in so MenuSurvei loaded)\n";
}
