<?php
$c = mysqli_connect("localhost", "root", "", "cvide");
$res = mysqli_query($c, "SELECT Id, RespondenNama, Kecamatan, Kabupaten, Latitude, Longitude, DevicePlatform, CreatedAt FROM survei_responden ORDER BY Id DESC LIMIT 5");
while ($r = mysqli_fetch_assoc($res)) {
    print_r($r);
}
