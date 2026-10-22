<?php
/**
 * verify_ahp_calculation.php
 * Verifikasi perhitungan matematis AHP, matriks resiprokal, bobot eigen,
 * dan Rasio Konsistensi (CR) pada data responden AHP yang tersimpan.
 */

$pdo = new PDO('mysql:host=localhost;dbname=cvide;charset=utf8mb4', 'root', '');
$res = $pdo->query("SELECT j.JawabanTeks, p.Pertanyaan FROM survei_jawaban j JOIN survei_pertanyaan p ON j.PertanyaanId = p.Id WHERE j.RespondenId = 150")->fetchAll(PDO::FETCH_ASSOC);

$answers = [];
foreach ($res as $r) {
    if (preg_match('/^\[([A-Za-z0-9_]+)\]/', $r['Pertanyaan'], $m)) {
        $answers[$m[1]] = $r['JawabanTeks'];
    }
}

$AHP_KRIT = [
  "Mendukung target pembangunan daerah",
  "Dirasakan oleh banyak warga",
  "Ikut mendorong kemajuan sektor lain",
  "Bisa ditangani pemerintah kabupaten",
  "Bisa diatasi dalam 5 tahun",
  "Sejalan dengan program bupati"
];
$RI = [0, 0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45];

function parseR($s) {
    if ($s === null || $s === '') return null;
    $t = (string)$s;
    if (strpos($t, '/') !== false) {
        $parts = explode('/', $t);
        return (float)$parts[1] > 0 ? (1.0 / (float)$parts[1]) : 1.0;
    }
    return (float)$t;
}

function buildM($a, $prefix, $n) {
    $M = array_fill(0, $n, array_fill(0, $n, 1.0));
    for ($i = 0; $i < $n; $i++) {
        for ($j = $i + 1; $j < $n; $j++) {
            $key = $prefix . ($i + 1) . ($j + 1);
            $v = parseR($a[$key] ?? null);
            if ($v === null || $v <= 0) return null;
            $M[$i][$j] = $v;
            $M[$j][$i] = 1.0 / $v;
        }
    }
    return $M;
}

function ahp($M) {
    $n = count($M);
    $w = array_fill(0, $n, 1.0 / $n);
    for ($it = 0; $it < 200; $it++) {
        $nw = [];
        for ($i = 0; $i < $n; $i++) {
            $sum = 0.0;
            for ($j = 0; $j < $n; $j++) {
                $sum += $M[$i][$j] * $w[$j];
            }
            $nw[$i] = $sum;
        }
        $totalSum = array_sum($nw);
        $nn = array_map(function($x) use ($totalSum) { return $x / $totalSum; }, $nw);
        $diff = 0.0;
        for ($i = 0; $i < $n; $i++) {
            $d = abs($nn[$i] - $w[$i]);
            if ($d > $diff) $diff = $d;
        }
        $w = $nn;
        if ($diff < 1e-12) break;
    }
    $Aw = [];
    for ($i = 0; $i < $n; $i++) {
        $sum = 0.0;
        for ($j = 0; $j < $n; $j++) $sum += $M[$i][$j] * $w[$j];
        $Aw[$i] = $sum;
    }
    $lamSum = 0.0;
    for ($i = 0; $i < $n; $i++) {
        $lamSum += $Aw[$i] / $w[$i];
    }
    $lam = $lamSum / $n;
    $CI = $n > 1 ? ($lam - $n) / ($n - 1) : 0;
    global $RI;
    $CR = isset($RI[$n]) && $RI[$n] > 0 ? ($CI / $RI[$n]) : 0;
    return ['w' => $w, 'lam' => $lam, 'CI' => $CI, 'CR' => $CR];
}

$M = buildM($answers, 'W', count($AHP_KRIT));
$resAHP = ahp($M);

echo "HASIL ANALISIS MATRIKS AHP (Responden #150 - Bappeda):\n";
echo "Lambda Max: " . round($resAHP['lam'], 4) . "\n";
echo "Consistency Index (CI): " . round($resAHP['CI'], 4) . "\n";
echo "Consistency Ratio (CR): " . round($resAHP['CR'], 4) . " (Batas konsistensi: <= 0.10)\n";
echo "Status Konsistensi: " . ($resAHP['CR'] <= 0.10 ? "SANGAT KONSISTEN & VALID (OK)" : "TIDAK KONSISTEN") . "\n";
echo "Bobot Prioritas Kriteria:\n";
foreach ($AHP_KRIT as $idx => $k) {
    echo "  " . ($idx + 1) . ". $k: " . round($resAHP['w'][$idx] * 100, 2) . "%\n";
}
