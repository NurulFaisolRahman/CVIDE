<?php
$lat = -7.933701;
$lng = 112.640656;
$url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&zoom=14&addressdetails=1";
$ctx = stream_context_create(array(
    'http' => array(
        'header' => "User-Agent: CVIDE-Surveyor/2.0\r\n",
        'timeout' => 3
    )
));
$res = @file_get_contents($url, false, $ctx);
echo "Response:\n";
print_r(json_decode($res, true));
