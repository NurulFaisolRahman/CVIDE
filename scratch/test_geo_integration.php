<?php
// Test 1: Test Malang iPhone coords
$ch = curl_init('http://localhost/CVIDE/IDE/resolve_coordinates?lat=-7.933701&lng=112.640656');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res1 = curl_exec($ch);
curl_close($ch);

echo "Test 1: resolve_coordinates for iPhone Malang coords (-7.933701, 112.640656):\n";
echo $res1 . "\n\n";

// Test 2: Test Banyuwangi Rogojampi coords (-8.3089, 114.2989)
$ch = curl_init('http://localhost/CVIDE/IDE/resolve_coordinates?lat=-8.3089&lng=114.2989');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res2 = curl_exec($ch);
curl_close($ch);

echo "Test 2: resolve_coordinates for Banyuwangi Rogojampi coords (-8.3089, 114.2989):\n";
echo $res2 . "\n\n";

// Test 3: Test Banyuwangi Genteng coords (-8.3689, 114.1523)
$ch = curl_init('http://localhost/CVIDE/IDE/resolve_coordinates?lat=-8.3689&lng=114.1523');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res3 = curl_exec($ch);
curl_close($ch);

echo "Test 3: resolve_coordinates for Banyuwangi Genteng coords (-8.3689, 114.1523):\n";
echo $res3 . "\n\n";
