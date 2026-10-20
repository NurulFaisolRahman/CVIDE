<?php
$m = new mysqli('localhost', 'root', '', 'cvide');
$res = $m->query('SELECT Id, SurveiId, RespondenNama, Kecamatan, Kabupaten, Latitude, Longitude, DevicePlatform, MutuPelayanan, RataRataSkor FROM survei_responden ORDER BY Id DESC LIMIT 10');
while ($r = $res->fetch_assoc()) {
    echo "ID: {$r['Id']} | Nama: {$r['RespondenNama']} | Skor: {$r['RataRataSkor']} ({$r['MutuPelayanan']})\n";
    echo "   Wilayah: Kec. {$r['Kecamatan']}, {$r['Kabupaten']}\n";
    echo "   Coords: {$r['Latitude']}, {$r['Longitude']}\n";
    echo "   Device: {$r['DevicePlatform']}\n\n";
}
