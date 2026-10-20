<?php
$c = mysqli_connect("localhost", "root", "", "cvide");
$res = mysqli_query($c, "SELECT Id, SurveiId, RespondenNama, Kecamatan, Kabupaten, Latitude, Longitude, DevicePlatform, CreatedAt FROM survei_responden WHERE RespondenNama LIKE '%H%' OR Latitude LIKE '%-7.933%'");
while ($r = mysqli_fetch_assoc($res)) {
    print_r($r);
}
