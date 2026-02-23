<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | IDE Consultant</title>

    <!-- Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS global website -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: var(--apple-light-gray, #F5F5F7);
            color: var(--apple-text, #1D1D1F);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-container {
            text-align: center;
            max-width: 680px;
            padding: 2.5rem 2rem;
            background: var(--apple-white, #FFFFFF);
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.1);
            margin: 1rem;
        }

        .error-illustration {
            width: 100%;
            max-width: 360px;
            margin: 0 auto 2rem;
            display: block;
            border-radius: 12px;
        }

        h1 {
            font-size: 7rem;
            font-weight: 800;
            margin: 0;
            color: var(--apple-blue, #007AFF);
            line-height: 1;
        }

        h2 {
            font-size: 2.2rem;
            margin: 1rem 0 1.2rem;
            color: var(--apple-dark, #1D1D1F);
        }

        p {
            font-size: 1.15rem;
            color: var(--apple-secondary, #3D3DC4);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-home {
            display: inline-block;
            padding: 14px 36px;
            background: var(--apple-blue, #007AFF);
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 6px 18px rgba(0, 122, 255, 0.3);
        }

        .btn-home:hover {
            background: #0056CC;
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 122, 255, 0.45);
        }

        .quick-links {
            margin-top: 2.5rem;
            font-size: 1rem;
        }

        .quick-links a {
            color: var(--apple-blue, #007AFF);
            text-decoration: none;
            margin: 0 14px;
            font-weight: 500;
        }

        .quick-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            h1 { font-size: 5.5rem; }
            h2 { font-size: 1.9rem; }
            .error-illustration { max-width: 300px; }
        }
    </style>
</head>
<body>

    <div class="error-container">
        <!-- Gambar ilustrasi (ganti dengan gambar lokal jika ada) -->
        <img 
            src="<?= base_url('assets/img/404-illustration.png') ?>" 
            alt="Ilustrasi 404 - Halaman Tidak Ditemukan" 
            class="error-illustration"
            onerror="this.src='https://via.placeholder.com/360x360?text=404+Illustration';"
        >

        <h1>404</h1>
        <h2>Halaman Tidak Ditemukan</h2>
        
        <p>Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.<br>
        Mungkin ada kesalahan ketik di URL atau konten sedang dalam proses pembaruan.</p>

        <a href="<?= base_url() ?>" class="btn-home">Kembali ke Beranda</a>

        <div class="quick-links">
            Atau jelajahi:
            <a href="<?= base_url('services') ?>">Layanan</a> •
            <a href="<?= base_url('portfolio') ?>">Portfolio</a> •
            <a href="<?= base_url('contact') ?>">Hubungi Kami</a>
        </div>
    </div>

</body>
</html>