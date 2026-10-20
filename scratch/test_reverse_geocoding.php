<?php
$lat = -7.933701;
$lng = 112.640656;

// 1. Test Nominatim
$url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&zoom=14&addressdetails=1";
$opts = [
    'http' => [
        'header' => "User-Agent: CVIDE-Survey/1.0\r\n"
    ]
];
$ctx = stream_context_create($opts);
$json = @file_get_contents($url, false, $ctx);
$data = json_decode($json, true);

echo "=== Nominatim ===\n";
if ($data && isset($data['address'])) {
    print_r($data['address']);
} else {
    echo "Nominatim failed or timed out.\n";
}

// 2. Test BigDataCloud
$bdcUrl = "https://api.bigdatacloud.net/data/reverse-geocode-client?latitude={$lat}&longitude={$lng}&localityLanguage=id";
$bdcJson = @file_get_contents($bdcUrl);
$bdcData = json_decode($bdcJson, true);
echo "\n=== BigDataCloud ===\n";
if ($bdcData) {
    print_r($bdcData);
}
