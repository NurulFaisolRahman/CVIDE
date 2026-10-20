<?php
$c = mysqli_connect("localhost", "root", "", "cvide");
$res = mysqli_query($c, "SELECT Id, RespondenNama, Kecamatan, Kabupaten, Latitude, Longitude FROM survei_responden WHERE Latitude IS NOT NULL AND Latitude != 0");
while ($r = mysqli_fetch_assoc($res)) {
    echo "ID: {$r['Id']} | Name: {$r['RespondenNama']} | Kec: {$r['Kecamatan']} | Lat: {$r['Latitude']}, Lng: {$r['Longitude']}\n";
}
