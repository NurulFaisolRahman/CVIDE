<?php

function resolveLocationFromCoordinates($lat, $lng, $fallbackKec = 'Banyuwangi', $fallbackKab = 'Kabupaten Banyuwangi') {
    if (empty($lat) || empty($lng)) {
        return ['kecamatan' => $fallbackKec, 'kabupaten' => $fallbackKab];
    }

    $lat = (float)$lat;
    $lng = (float)$lng;

    // 1. Data Centroid 25 Kecamatan di Kabupaten Banyuwangi
    $banyuwangiCentroids = [
        'Banyuwangi'   => [-8.2192, 114.3692],
        'Blimbingsari' => [-8.3150, 114.3410],
        'Bangorejo'    => [-8.4891, 114.1878],
        'Cluring'      => [-8.4412, 114.2389],
        'Gambiran'     => [-8.4023, 114.1489],
        'Genteng'      => [-8.3689, 114.1523],
        'Giri'         => [-8.1923, 114.3512],
        'Glagah'       => [-8.2056, 114.3289],
        'Glenmore'     => [-8.3089, 114.0489],
        'Kabat'        => [-8.2789, 114.3312],
        'Kalibaru'     => [-8.2912, 113.9856],
        'Kalipuro'     => [-8.1389, 114.3723],
        'Licin'        => [-8.2089, 114.2689],
        'Muncar'       => [-8.4356, 114.3389],
        'Pesanggaran'  => [-8.5689, 114.0789],
        'Purwoharjo'   => [-8.5023, 114.2312],
        'Rogojampi'    => [-8.3089, 114.2989],
        'Sempu'        => [-8.3389, 114.1812],
        'Siliragung'   => [-8.5412, 114.1389],
        'Singojuruh'   => [-8.3189, 114.2389],
        'Songgon'      => [-8.2389, 114.2089],
        'Srono'        => [-8.3989, 114.2689],
        'Tegaldlimo'   => [-8.5389, 114.3989],
        'Tegalsari'    => [-8.4389, 114.1189],
        'Wongsorejo'   => [-7.9889, 114.4089]
    ];

    // Cek apakah koordinat berada di dalam lingkup Banyuwangi (Lat: -8.8 s/d -7.8, Lng: 113.8 s/d 114.6)
    if ($lat >= -8.85 && $lat <= -7.80 && $lng >= 113.80 && $lng <= 114.65) {
        $minDist = 999999;
        $closestKec = 'Banyuwangi';
        foreach ($banyuwangiCentroids as $kName => $coords) {
            $dist = sqrt(pow($lat - $coords[0], 2) + pow($lng - $coords[1], 2));
            if ($dist < $minDist) {
                $minDist = $dist;
                $closestKec = $kName;
            }
        }
        return ['kecamatan' => $closestKec, 'kabupaten' => 'Kabupaten Banyuwangi'];
    }

    // 2. Jika koordinat di luar Banyuwangi (misal di Malang, Surabaya, dll):
    // Cek wilayah Malang Raya (Lat: -8.2 s/d -7.8, Lng: 112.4 s/d 112.8)
    if ($lat >= -8.15 && $lat <= -7.85 && $lng >= 112.50 && $lng <= 112.75) {
        $malangCentroids = [
            'Blimbing'      => [-7.9390, 112.6450],
            'Lowokwaru'     => [-7.9337, 112.6180],
            'Klojen'        => [-7.9780, 112.6310],
            'Sukun'         => [-7.9950, 112.6150],
            'Kedungkandang' => [-7.9980, 112.6650]
        ];
        $minDist = 999999;
        $closestKec = 'Blimbing';
        foreach ($malangCentroids as $kName => $coords) {
            $dist = sqrt(pow($lat - $coords[0], 2) + pow($lng - $coords[1], 2));
            if ($dist < $minDist) {
                $minDist = $dist;
                $closestKec = $kName;
            }
        }
        return ['kecamatan' => $closestKec, 'kabupaten' => 'Kota Malang'];
    }

    // 3. Fallback Online Reverse Geocoding dengan Timeout Ringan (1.5 detik)
    $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&zoom=14&addressdetails=1";
    $ctx = stream_context_create([
        'http' => [
            'header' => "User-Agent: CVIDE-Surveyor/2.0\r\n",
            'timeout' => 2
        ]
    ]);

    $res = @file_get_contents($url, false, $ctx);
    if ($res) {
        $data = json_decode($res, true);
        if (!empty($data['address'])) {
            $addr = $data['address'];
            $kec = $addr['district'] ?? ($addr['town'] ?? ($addr['suburb'] ?? ($addr['city_district'] ?? '')));
            $kab = $addr['city'] ?? ($addr['county'] ?? ($addr['municipality'] ?? ''));
            if ($kec) {
                // Bersihkan kata 'Kecamatan' jika ada
                $cleanKec = trim(str_ireplace('Kecamatan', '', $kec));
                return [
                    'kecamatan' => $cleanKec ?: $fallbackKec,
                    'kabupaten' => $kab ?: $fallbackKab
                ];
            }
        }
    }

    return ['kecamatan' => $fallbackKec, 'kabupaten' => $fallbackKab];
}

// Test koordinat di screenshot pengguna: -7.933701, 112.640656
echo "Test Koordinat Screenshot User (-7.933701, 112.640656):\n";
print_r(resolveLocationFromCoordinates(-7.933701, 112.640656));

// Test koordinat Rogojampi Banyuwangi: -8.309450, 114.298210
echo "\nTest Koordinat Rogojampi (-8.309450, 114.298210):\n";
print_r(resolveLocationFromCoordinates(-8.309450, 114.298210));

// Test koordinat Genteng Banyuwangi: -8.3689, 114.1523
echo "\nTest Koordinat Genteng (-8.3689, 114.1523):\n";
print_r(resolveLocationFromCoordinates(-8.3689, 114.1523));
