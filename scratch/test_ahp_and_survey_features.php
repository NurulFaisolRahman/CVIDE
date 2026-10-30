<?php
define('BASEPATH', 'TRUE');
require_once __DIR__ . '/../application/config/database.php';

$conn = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "========================================================================================\n";
echo "   PENGUJIAN FITUR AHP, SIMPAN OFFLINE, DAN SELURUH INSTRUMEN SURVEI RTKD 2026         \n";
echo "========================================================================================\n\n";

function assertTest($desc, $cond, $extra = '') {
    echo "  " . ($cond ? "[PASS]" : "[FAIL]") . " " . str_pad($desc, 60, '.') . " " . ($cond ? "OK" : "FAILED") . "\n";
    if (!empty($extra)) echo "         -> " . $extra . "\n";
    if (!$cond) {
        echo "\n!!! TEST GAGAL: " . $desc . " !!!\n";
    }
}

// 1. Uji algoritma JS AHP & updateCR melalui Node.js / CLI
echo "1. VERIFIKASI ENGINE AHP TANPA PERHITUNGAN BERTENTANGAN:\n";

$engineJs = file_get_contents(__DIR__ . '/../assets/js/survei_rtkd_engine.js');
assertTest("JS Engine: Tidak ada lagi pesan 'masih ada yang bertentangan'", strpos($engineJs, 'masih ada yang bertentangan') === false);
assertTest("JS Engine: Kotak indikator selalu 'rtkd-crbox ok' saat selesai", strpos($engineJs, 'el.className = "rtkd-crbox ok"') !== false);
assertTest("JS Engine: Logarithmic Least Squares (wGeom) terintegrasi", strpos($engineJs, 'wGeom') !== false);

// Jalankan simulasi AHP di Node.js untuk matriks tidak konsisten (CR 0.19 seperti screenshot user)
$nodeScript = <<< 'JS'
var fs = require('fs');
var code = fs.readFileSync('c:/xampp/htdocs/CVIDE/assets/js/survei_rtkd_engine.js', 'utf8');

// Mock DOM & window
global.window = {};
global.document = {
  getElementById: function(id) {
    return {
      className: '',
      innerHTML: '',
      closest: function() { return null; }
    };
  }
};
eval(code);

var RTKD = global.window.RTKDEngine;
// Simulasikan perbandingan berpasangan Kriteria 6 elemen dengan skor acak (yang di screenshot menghasilkan CR 0.19)
var M = [
  [1, 1, 1/2, 5, 4, 5],
  [1, 1, 1/3, 6, 3, 6],
  [2, 3, 1, 7, 6, 7],
  [1/5, 1/6, 1/7, 1, 1, 1],
  [1/4, 1/3, 1/6, 1, 1, 1/3],
  [1/5, 1/6, 1/7, 1, 3, 1]
];

var res = RTKD.ahp(M);
var sumW = res.w.reduce(function(a, b) { return a + b; }, 0);
var allPositive = res.w.every(function(x) { return x > 0 && isFinite(x); });

console.log(JSON.stringify({
  sumW: sumW,
  allPositive: allPositive,
  wCount: res.w.length,
  w: res.w
}));
JS;

file_put_contents(__DIR__ . '/scratch_node_ahp_test.js', $nodeScript);
$nodeOutput = shell_exec('node ' . escapeshellarg(__DIR__ . '/scratch_node_ahp_test.js'));
@unlink(__DIR__ . '/scratch_node_ahp_test.js');

$ahpResult = json_decode(trim($nodeOutput), true);
assertTest("AHP Bobot Prioritas: Jumlah total bobot = 1.0 (100%)", abs($ahpResult['sumW'] - 1.0) < 0.001, "Total: " . round($ahpResult['sumW'], 4));
assertTest("AHP Bobot Prioritas: Seluruh bobot positif & valid (skor bebas)", $ahpResult['allPositive'] === true, "Jumlah elemen: " . $ahpResult['wCount']);

// 2. Verifikasi offline manager & draft
echo "\n2. VERIFIKASI FITUR SIMPAN OFFLINE & AUTO-DRAFT AHP:\n";
$offlineJs = file_get_contents(__DIR__ . '/../assets/js/survei_offline_manager.js');
assertTest("Offline Manager: Dukungan form modal & dashboard pada auto-draft", strpos($offlineJs, 'dashRespondentForm') !== false);
assertTest("Offline Manager: Pemulihan draft AHP dengan nilai Saaty pecahan (1/3, 1/5)", strpos($offlineJs, 'filter(function() { return this.value === String(val); })') !== false);
assertTest("Offline Manager: Auto update urutan prioritas setelah draft dipulihkan", strpos($offlineJs, "window.RTKDEngine.updateCR") !== false);

$menuSurveiPhp = file_get_contents(__DIR__ . '/../application/views/MenuSurvei.php');
assertTest("MenuSurvei: Tidak ada blokir AHP konsistensi", strpos($menuSurveiPhp, '!window.ahpAckCr') === false);
assertTest("MenuSurvei: Opsi 'Tetap Simpan ke Antrean Offline' saat ada butir belum terisi", strpos($menuSurveiPhp, 'bypassValidationForOffline') !== false);

$dashPhp = file_get_contents(__DIR__ . '/../application/views/SurveyDashboard.php');
assertTest("Dashboard: Tidak ada blokir AHP konsistensi", strpos($dashPhp, '!window.dashAhpAckCr') === false);
assertTest("Dashboard: Pemulihan draft pada switchDashRtkdTab", strpos($dashPhp, 'SurveiOfflineManager.restoreDraft') !== false);

// 3. Uji Pengiriman Data AHP (Instrumen E) ke Backend IDE/submit_jawaban_survei
echo "\n3. VERIFIKASI PENGIRIMAN & PENYIMPANAN DATA SURVEI (ONLINE & OFFLINE):\n";

$baseUrl = 'http://localhost/CVIDE/IDE/submit_jawaban_survei';

function sendJson($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $res = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array('code' => $code, 'data' => json_decode($res, true), 'raw' => $res);
}

// Data AHP dengan skor bebas / arbitrer
$ahpPayload = array(
    'SurveiId' => 4,
    'Instrumen' => 'E',
    'Enumerator' => 'Enumerator Test Lapangan',
    'RespondenNama' => 'Bappeda Litbang Banyuwangi (Test AHP Bebas)',
    'RespondenPekerjaan' => 'Perencana dan pengelola program',
    'Kecamatan' => 'Banyuwangi',
    'Kabupaten' => 'Kabupaten Banyuwangi',
    'Provinsi' => 'Jawa Timur',
    'Latitude' => -8.2192,
    'Longitude' => 114.3692,
    'DevicePlatform' => 'Mobile Fieldwork PWA',
    'Jawaban' => array(
        'S1' => 'Perencana dan pengelola program',
        'S2' => 'Bappeda Litbang Banyuwangi',
        'S3' => 'Kepala Bidang Perencanaan',
        'S5' => 'Wawancara mendalam',
        'W12' => '1',
        'W13' => '1/3',
        'W14' => '5',
        'W15' => '3',
        'W16' => '4',
        'W23' => '1/2',
        'W24' => '6',
        'W25' => '3',
        'W26' => '5',
        'W34' => '7',
        'W35' => '5',
        'W36' => '6',
        'W45' => '1',
        'W46' => '2',
        'W56' => '1/3'
    )
);

$resE = sendJson($baseUrl, $ahpPayload);
assertTest("Submit Survei AHP dengan skor bebas ke server", $resE['code'] === 200 && !empty($resE['data']['status']), "Response ID: #" . ($resE['data']['responden_id'] ?? '-'));

// Uji Instrumen A, B, C, D
$resA = sendJson($baseUrl, array(
    'SurveiId' => 4, 'Instrumen' => 'A', 'Enumerator' => 'Test Surveyor',
    'RespondenNama' => 'PT Test Industri Maju', 'Kecamatan' => 'Genteng',
    'Jawaban' => array('P1' => 'PT Test Industri Maju', 'P2' => 'Genteng', 'P3' => 'Industri pengolahan', 'P4' => '20–99')
));
assertTest("Submit Instrumen A (Perusahaan)", $resA['code'] === 200 && !empty($resA['data']['status']));

$resB = sendJson($baseUrl, array(
    'SurveiId' => 4, 'Instrumen' => 'B', 'Enumerator' => 'Test Surveyor',
    'RespondenNama' => 'Budi Santoso', 'Kecamatan' => 'Rogojampi',
    'Jawaban' => array('SC' => array('Mencari kerja'), 'L1' => '20–24', 'L2' => 'Laki-laki', 'L3' => 'Rogojampi', 'L4' => 'SMK Vokasi')
));
assertTest("Submit Instrumen B (Pencari Kerja)", $resB['code'] === 200 && !empty($resB['data']['status']));

$resC = sendJson($baseUrl, array(
    'SurveiId' => 4, 'Instrumen' => 'C', 'Enumerator' => 'Test Surveyor',
    'RespondenNama' => 'Dinas Pendidikan Jatim', 'Kecamatan' => 'Banyuwangi',
    'Jawaban' => array('S1' => 'Penyedia pelatihan dan pendidikan', 'S2' => 'Dinas Pendidikan')
));
assertTest("Submit Instrumen C (Pemangku Kepentingan)", $resC['code'] === 200 && !empty($resC['data']['status']));

$resD = sendJson($baseUrl, array(
    'SurveiId' => 4, 'Instrumen' => 'D', 'Enumerator' => 'Test Surveyor',
    'RespondenNama' => 'Siswa SMK Negeri 1', 'Kecamatan' => 'Glagah',
    'Jawaban' => array('K1' => 'SMK Vokasi', 'K2' => 'SMKN 1 Banyuwangi', 'K3' => 'Glagah', 'K5' => '17 tahun', 'K6' => 'Laki-laki', 'K8' => 'Bekerja')
));
assertTest("Submit Instrumen D (Siswa Kelas 12)", $resD['code'] === 200 && !empty($resD['data']['status']));

echo "\n========================================================================================\n";
echo "                       HASIL PENGUJIAN KESELURUHAN SELESAI                              \n";
echo "========================================================================================\n";
