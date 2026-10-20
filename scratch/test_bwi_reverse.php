<?php
$lat = -8.309450;
$lng = 114.298210;

$url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&zoom=14&addressdetails=1";
$opts = [
    'http' => [
        'header' => "User-Agent: CVIDE-Survey/1.0\r\n"
    ]
];
$ctx = stream_context_create($opts);
$json = @file_get_contents($url, false, $ctx);
$data = json_decode($json, true);
echo "=== Banyuwangi Coords ===\n";
print_r($data['address']);
