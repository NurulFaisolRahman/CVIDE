<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — IDE Consultant</title>

    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <style>
        :root {
            --bg:      #F4F4F4;
            --ink:     #0D0D0D;
            --muted:   #888;
            --accent:  #0D0D0D;
            --line:    rgba(0,0,0,0.08);
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        html, body {
            height: 100%;
            background: var(--bg);
            color: var(--ink);
            font-family: 'IBM Plex Mono', monospace;
        }

        /* ── Full-screen shell ─────────────────────────────── */
        .shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Top bar ───────────────────────────────────────── */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 48px;
            border-bottom: 1px solid var(--line);
        }
        .status-tag {
            font-size: 0.6rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--muted);
            border: 1px solid var(--line);
            padding: 5px 12px;
            border-radius: 3px;
        }

        /* ── Center stage ──────────────────────────────────── */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stage {
            text-align: center;
            padding: 40px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ── Eyebrow ───────────────────────────────────────── */
        .eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.32em;
            text-transform: uppercase;
            color: var(--ink);
            margin-bottom: 20px;
            opacity: 0;
            animation: up 0.6s 0.05s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        /* ── The giant 403 ─────────────────────────────────── */
        .num {
            font-family: 'Syne', sans-serif;
            font-size: clamp(6rem, 16vw, 13rem);
            font-weight: 800;
            line-height: 0.85;
            letter-spacing: -0.06em;
            color: var(--ink);
            position: relative;
            user-select: none;
            opacity: 0;
            animation: up 0.7s 0.12s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        .num .blue { color: #04114a; }

        /* Ghost layer — offset outline echo */
        .num::before {
            content: '403';
            position: absolute;
            inset: 0;
            color: transparent;
            -webkit-text-stroke: 2px rgba(0,0,0,0.07);
            transform: translate(6px, 8px);
            z-index: -1;
        }

        /* ── Thin rule ─────────────────────────────────────── */
        .rule {
            width: 0;
            height: 1px;
            background: var(--ink);
            opacity: 0.18;
            margin: 32px auto;
            animation: expand 0.6s 0.4s cubic-bezier(0.16,1,0.3,1) forwards;
        }
        @keyframes expand {
            to { width: 160px; }
        }

        /* ── Sub-copy ──────────────────────────────────────── */
        .sub {
            font-size: clamp(0.75rem, 2vw, 0.85rem);
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--muted);
            line-height: 1.9;
            max-width: 480px;
            opacity: 0;
            animation: up 0.6s 0.5s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        /* ── CTA ───────────────────────────────────────────── */
        .cta-wrap {
            margin-top: 44px;
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            opacity: 0;
            animation: up 0.6s 0.6s cubic-bezier(0.16,1,0.3,1) forwards;
        }

        .btn-solid {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 36px;
            background: #0A1F5C;
            color: #fff;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 4px;
            border: 1.5px solid #0A1F5C;
            transition: background 0.2s, color 0.2s, transform 0.2s;
        }
        .btn-solid:hover {
            background: #0d2870;
            transform: translateY(-2px);
        }
        .btn-solid svg { transition: transform 0.2s; }
        .btn-solid:hover svg { transform: translateX(3px); }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 36px;
            background: transparent;
            color: var(--muted);
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.65rem;
            font-weight: 400;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 4px;
            border: 1.5px solid var(--line);
            transition: border-color 0.2s, color 0.2s, transform 0.2s;
        }
        .btn-outline:hover {
            color: var(--ink);
            border-color: rgba(0,0,0,0.25);
            transform: translateY(-2px);
        }

        /* ── Bottom bar ────────────────────────────────────── */
        footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 48px;
            border-top: 1px solid var(--line);
        }
        .foot-left {
            font-size: 0.58rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--muted);
        }
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.58rem;
            letter-spacing: 0.15em;
            color: var(--muted);
        }
        .breadcrumb a { color: var(--muted); text-decoration: none; }
        .breadcrumb a:hover { color: var(--ink); }
        .breadcrumb .sep { opacity: 0.3; }
        .breadcrumb .err { color: var(--ink); }

        /* ── Keyframes ─────────────────────────────────────── */
        @keyframes up {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Responsive ────────────────────────────────────── */
        @media (max-width: 600px) {
            .topbar, footer { padding: 20px 24px; }
            .num::before { display: none; }
        }
        @media (max-width: 400px) {
            .cta-wrap { flex-direction: column; align-items: stretch; }
            .btn-solid, .btn-outline { justify-content: center; }
        }
    </style>
</head>
<body>

<div class="shell">

    <!-- Top bar -->
    <header class="topbar">
        <a href="<?= base_url() ?>"><img src="<?= base_url('assets/img/logo.png') ?>" alt="LogoIDE" style="height:60px; display:block;"></a>
        <span class="status-tag">Error 403</span>
    </header>

    <!-- Main -->
    <main>
        <div class="stage">

            <p class="eyebrow">Oops! &nbsp;·&nbsp; Access Forbidden</p>

            <div class="num" aria-label="403">4<span class="blue">0</span>3</div>

            <div class="rule"></div>

            <p class="sub">
                You do not have permission to access<br>
                this page on this server.
            </p>

            <div class="cta-wrap">
                <a href="<?= base_url() ?>" class="btn-solid">
                    Kembali ke Beranda
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 7h8M8 4l3 3-3 3"/>
                    </svg>
                </a>
                <a href="javascript:history.back()" class="btn-outline">
                    Halaman Sebelumnya
                </a>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer>
        <span class="foot-left">IDE Consultant &nbsp;&copy; <?= date('Y') ?></span>
        <nav class="breadcrumb">
            <a href="<?= base_url() ?>">Home</a>
            <span class="sep">/</span>
            <span class="err">403</span>
        </nav>
    </footer>

</div>

</body>
</html>