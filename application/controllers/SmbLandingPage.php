<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bappeda Kabupaten Banyuwangi — Sistem Manajemen Bersama</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* ===================================================
   RESET & ROOT
   =================================================== */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --navy:      #0a1f5c;
  --navy-md:   #0e2878;
  --blue:      #1340c4;
  --blue-mid:  #1e52d4;
  --blue-lt:   #2f6bef;
  --blue-pale: #d6e4ff;
  --blue-50:   #eef3ff;
  --cyan:      #0ea5e9;
  --gold:      #e8a020;
  --white:     #ffffff;
  --off-white: #f7f9ff;
  --gray-50:   #f0f4fb;
  --gray-100:  #e4eaf6;
  --gray-200:  #c8d4ec;
  --gray-400:  #8898bb;
  --gray-600:  #4a5980;
  --gray-800:  #1a2545;
  --text-dark: #0b1a42;
  --text-body: #2d3a5e;
  --text-mute: #6b7a9e;

  --font-display: 'Playfair Display', serif;
  --font-ui:      'Plus Jakarta Sans', sans-serif;

  --nav-h: 76px;
  --r:     12px;
  --r-lg:  20px;
  --shadow-card: 0 4px 24px rgba(10,31,92,0.1);
  --shadow-lift: 0 12px 40px rgba(10,31,92,0.18);
  --transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
html { scroll-behavior: smooth; }
body { font-family: var(--font-ui); color: var(--text-body); background: var(--white); overflow-x: hidden; }
img { display: block; max-width: 100%; }
a { text-decoration: none; color: inherit; }
button { cursor: pointer; font-family: inherit; }
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-thumb { background: var(--blue-pale); border-radius: 99px; }

/* ===================================================
   UTILITIES
   =================================================== */
.container { max-width: 1200px; margin: 0 auto; padding: 0 40px; }
.section-eyebrow {
  display: inline-flex; align-items: center; gap: 8px;
  font-size: 11.5px; font-weight: 700; letter-spacing: 0.12em;
  text-transform: uppercase; color: var(--blue-lt);
  background: var(--blue-50); border: 1px solid var(--blue-pale);
  padding: 5px 14px; border-radius: 99px; margin-bottom: 14px;
}
.section-eyebrow::before {
  content: ''; width: 6px; height: 6px;
  border-radius: 50%; background: var(--blue-lt);
}
.section-title {
  font-family: var(--font-display);
  font-size: clamp(26px, 3.5vw, 40px);
  font-weight: 800;
  color: var(--text-dark);
  line-height: 1.2;
  letter-spacing: -0.02em;
}
.section-title span { color: var(--blue-lt); }
.section-sub {
  font-size: 15px; color: var(--text-mute);
  line-height: 1.65; margin-top: 12px;
  max-width: 540px;
}

/* ===================================================
   TOPBAR TICKER
   =================================================== */
.topbar-ticker {
  background: var(--navy);
  height: 38px;
  display: flex; align-items: center;
  overflow: hidden;
  position: relative;
}
.ticker-label {
  flex-shrink: 0;
  background: var(--gold);
  color: var(--white);
  font-size: 11px; font-weight: 700; letter-spacing: 0.08em;
  text-transform: uppercase;
  padding: 0 16px; height: 100%;
  display: flex; align-items: center; gap: 6px;
  z-index: 2;
}
.ticker-label svg { width: 12px; height: 12px; }
.ticker-track {
  display: flex; align-items: center;
  white-space: nowrap;
  animation: ticker 40s linear infinite;
  padding-left: 30px;
}
.ticker-item {
  font-size: 12px; color: rgba(255,255,255,0.82);
  padding: 0 28px 0 0;
  display: inline-flex; align-items: center; gap: 10px;
}
.ticker-item::after {
  content: '◆'; font-size: 6px; color: var(--gold); opacity: 0.7;
  margin-left: 18px;
}
.ticker-item:last-child::after { display: none; }
@keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

/* ===================================================
   NAVBAR - FIXED & ALWAYS TRANSPARENT
   =================================================== */
:root {
  --nav-h: 90px;
}

.navbar {
  position: fixed;
  top: var(--ticker-h);
  left: 0;
  width: 100%;
  z-index: 1000;
  /* Background selalu transparan */
  background: transparent;
  height: var(--nav-h);
  transition: all 0.3s ease;
  pointer-events: auto;
}

/* Container navbar */
.navbar .container {
  max-width: 1300px;
  height: 100%;
}

.nav-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 30px;
  height: 100%;
}

/* ===== BRAND / LOGO KIRI ===== */
.nav-brand {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-shrink: 0;
}

.nav-logo {
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.nav-logo img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

.nav-brand-name {
  font-family: var(--font-display);
  font-size: 18px;
  font-weight: 800;
  color: white;
  line-height: 1.2;
}

.nav-brand-sub {
  font-size: 10px;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.7);
  letter-spacing: 0.03em;
}
/* Efek transparan pada logo saat navbar dalam mode transparent */
.navbar.transparent .nav-brand {
  opacity: 0.7;
  transition: opacity 0.3s ease;
}

/* Logo menjadi solid saat navbar scrolled */
.navbar.scrolled .nav-brand {
  opacity: 1;
}

/* Efek transparan pada logo image */
.navbar.transparent .nav-logo img {
  opacity: 0.7;
  transition: opacity 0.3s ease;
}

.navbar.scrolled .nav-logo img {
  opacity: 1;
}

/* Efek transparan pada teks brand */
.navbar.transparent .nav-brand-name,
.navbar.transparent .nav-brand-sub {
  opacity: 0.7;
  transition: opacity 0.3s ease;
}

.navbar.scrolled .nav-brand-name,
.navbar.scrolled .nav-brand-sub {
  opacity: 1;
}

/* ===== OVAL CENTER MENU ===== */
.nav-center {
  flex: 1;
  display: flex;
  justify-content: center;
}

.nav-links {
  display: flex;
  align-items: center;
  gap: 12px;
  list-style: none;
  margin: 0;
  padding: 8px 16px;
  /* Background menu tetap transparan dengan blur */
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(12px);
  border-radius: 80px;
  border: 1px solid rgba(255, 255, 255, 0.25);
  transition: all 0.3s ease;
}

.nav-links a {
  font-size: 14px;
  font-weight: 600;
  padding: 12px 28px;
  border-radius: 60px;
  transition: all 0.3s ease;
  text-decoration: none;
  color: rgba(255, 255, 255, 0.9);
  letter-spacing: 0.02em;
}

.nav-links a:hover {
  background: rgba(255, 255, 255, 0.25);
  color: white;
}

.nav-links a.active {
  background: rgba(255, 255, 255, 0.3);
  color: white;
}

/* ===== TOMBOL KANAN ===== */
.nav-cta {
  flex-shrink: 0;
}

.btn-login {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(8px);
  color: white;
  font-size: 14px;
  font-weight: 600;
  padding: 12px 28px;
  border-radius: 50px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  transition: all 0.3s ease;
  cursor: pointer;
  white-space: nowrap;
}

.btn-login:hover {
  background: rgba(255, 255, 255, 0.35);
  transform: translateY(-2px);
}

.btn-login svg {
  width: 15px;
  height: 15px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1100px) {
  .nav-links a {
    padding: 10px 20px;
    font-size: 13px;
  }
  .btn-login {
    padding: 10px 22px;
    font-size: 13px;
  }
}

@media (max-width: 900px) {
  .nav-links {
    gap: 6px;
    padding: 6px 12px;
  }
  .nav-links a {
    padding: 8px 16px;
    font-size: 12px;
  }
}

@media (max-width: 768px) {
  .nav-center {
    display: none;
  }
  .btn-login {
    padding: 8px 18px;
    font-size: 12px;
  }
  .nav-brand-name {
    font-size: 16px;
  }
  .nav-logo {
    width: 42px;
    height: 42px;
  }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1100px) {
  .nav-links a {
    padding: 10px 20px;
    font-size: 13px;
  }
  .btn-login {
    padding: 10px 22px;
    font-size: 13px;
  }
}

@media (max-width: 900px) {
  .nav-links {
    gap: 6px;
    padding: 6px 12px;
  }
  .nav-links a {
    padding: 8px 16px;
    font-size: 12px;
  }
}

@media (max-width: 768px) {
  .nav-center {
    display: none;
  }
  .btn-login {
    padding: 8px 18px;
    font-size: 12px;
  }
  .nav-brand-name {
    font-size: 16px;
  }
  .nav-logo {
    width: 42px;
    height: 42px;
  }
}
/* ===================================================
   HERO — FULLSCREEN SLIDESHOW
   =================================================== */
.hero {
  position: relative;
  height: calc(100vh - var(--nav-h) - 38px);
  min-height: 580px;
  overflow: hidden;
  background: var(--navy);
}
.hero-slide {
  position: absolute; inset: 0;
  opacity: 0; transition: opacity 1.2s ease;
  background-size: cover; background-position: center;
}
.hero-slide.active { opacity: 1; }
.slide-1 { 
  background-image: url('/CVIDE/assets/img/test1.jpg');
  background-size: cover;
  background-position: center;
}
.slide-2 { 
  background-image: url('/CVIDE/assets/img/test2.jpeg');
  background-size: cover;
  background-position: center;
}
.slide-3 { 
  background-image: url('/CVIDE/assets/img/test3.jpeg');
  background-size: cover;
  background-position: center;
}
.slide-4 { 
  background-image: url('/CVIDE/assets/img/test4.jpeg');
  background-size: cover;
  background-position: center;
}
.slide-decor {
  position: absolute; inset: 0; pointer-events: none;
}
.slide-decor::before {
  content: '';
  position: absolute; top: -100px; right: -100px;
  width: 600px; height: 600px;
  background: radial-gradient(circle, rgba(14,165,233,0.18) 0%, transparent 65%);
}
.slide-decor::after {
  content: '';
  position: absolute; bottom: -80px; left: 20%;
  width: 400px; height: 400px;
  background: radial-gradient(circle, rgba(47,107,239,0.2) 0%, transparent 65%);
}
.hero-grid {
  position: absolute; inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
  background-size: 60px 60px;
  pointer-events: none;
}
.hero-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(
    to bottom,
    rgba(10,31,92,0.35) 0%,
    rgba(10,31,92,0.2) 40%,
    rgba(10,31,92,0.65) 100%
  );
}
.hero-overlay-left {
  position: absolute; inset: 0;
  background: linear-gradient(
    to right,
    rgba(5,15,60,0.8) 0%,
    rgba(5,15,60,0.4) 50%,
    transparent 100%
  );
}
.hero-content {
  position: absolute; inset: 0;
  display: flex; align-items: center;
  padding: 0 0 80px;
}
.hero-content .container { width: 100%; }
.hero-tag {
  display: inline-flex; align-items: center; gap: 8px;
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.2);
  backdrop-filter: blur(8px);
  color: rgba(255,255,255,0.9);
  font-size: 11.5px; font-weight: 600; letter-spacing: 0.1em;
  text-transform: uppercase;
  padding: 6px 16px; border-radius: 99px;
  margin-bottom: 20px;
  animation: slideUp 0.8s ease both;
}
.hero-tag-dot { width: 6px; height: 6px; background: var(--gold); border-radius: 50%; animation: pulse 2s infinite; }
@keyframes pulse { 0%,100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.6; transform: scale(1.3); } }
.hero-headline {
  font-family: var(--font-display);
  font-size: clamp(32px, 5.5vw, 68px);
  font-weight: 900;
  color: var(--white);
  line-height: 1.08;
  letter-spacing: -0.03em;
  margin-bottom: 18px;
  max-width: 680px;
  animation: slideUp 0.9s 0.1s ease both;
}
.hero-headline .accent {
  color: transparent;
  background: linear-gradient(90deg, #60a5fa, #38bdf8, #7dd3fc);
  -webkit-background-clip: text;
  background-clip: text;
}
.hero-sub {
  font-size: clamp(14px, 1.5vw, 17px);
  color: rgba(255,255,255,0.72);
  line-height: 1.65;
  max-width: 520px;
  margin-bottom: 32px;
  animation: slideUp 1s 0.2s ease both;
}
.hero-actions {
  display: flex; align-items: center; gap: 14px;
  flex-wrap: wrap;
  animation: slideUp 1s 0.3s ease both;
}
.btn-hero-primary {
  display: inline-flex; align-items: center; gap: 9px;
  background: var(--white); color: var(--navy);
  font-size: 14px; font-weight: 700;
  padding: 14px 28px; border-radius: 12px;
  border: none; transition: var(--transition);
  box-shadow: 0 6px 24px rgba(0,0,0,0.25);
}
.btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
.btn-hero-primary svg { width: 16px; height: 16px; color: var(--blue-lt); }
.btn-hero-ghost {
  display: inline-flex; align-items: center; gap: 9px;
  background: rgba(255,255,255,0.1);
  border: 1.5px solid rgba(255,255,255,0.3);
  color: var(--white); font-size: 14px; font-weight: 600;
  padding: 13px 24px; border-radius: 12px;
  transition: var(--transition);
  backdrop-filter: blur(8px);
}
.btn-hero-ghost:hover { background: rgba(255,255,255,0.2); }
.btn-hero-ghost svg { width: 16px; height: 16px; }
@keyframes slideUp {
  from { opacity: 0; transform: translateY(24px); }
  to { opacity: 1; transform: translateY(0); }
}
.hero-indicators {
  position: absolute; bottom: 32px; left: 50%;
  transform: translateX(-50%);
  display: flex; gap: 8px; z-index: 10;
}
.hero-dot {
  width: 28px; height: 4px;
  background: rgba(255,255,255,0.3);
  border-radius: 2px; cursor: pointer;
  transition: var(--transition);
}
.hero-dot.active { background: var(--white); width: 44px; }
.hero-arrow {
  position: absolute; top: 50%; transform: translateY(-50%);
  z-index: 10;
  width: 46px; height: 46px;
  background: rgba(255,255,255,0.1);
  border: 1.5px solid rgba(255,255,255,0.25);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: var(--transition);
  backdrop-filter: blur(8px);
  color: white;
}
.hero-arrow:hover { background: rgba(255,255,255,0.22); }
.hero-arrow svg { width: 18px; height: 18px; }
.hero-arrow-prev { left: 30px; }
.hero-arrow-next { right: 30px; }
.hero-info-card {
  position: absolute; bottom: 50px; right: 60px;
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.2);
  backdrop-filter: blur(20px);
  border-radius: var(--r);
  padding: 16px 20px;
  animation: slideUp 1s 0.5s ease both;
  min-width: 220px;
}
.hero-info-date { font-size: 10.5px; color: rgba(255,255,255,0.55); font-weight: 500; margin-bottom: 5px; }
.hero-info-title { font-size: 13px; font-weight: 600; color: var(--white); line-height: 1.4; }
.hero-info-badge {
  display: inline-block; margin-top: 8px;
  background: var(--gold); color: var(--white);
  font-size: 10px; font-weight: 700; letter-spacing: 0.06em;
  padding: 2px 8px; border-radius: 4px; text-transform: uppercase;
}

/* ===================================================
   STATISTICS BAR
   =================================================== */
.stats-bar {
  background: var(--navy);
  padding: 0;
  position: relative; z-index: 5;
  overflow: hidden;
}
.stats-bar::before {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(90deg, rgba(14,165,233,0.08) 0%, transparent 50%, rgba(47,107,239,0.08) 100%);
  pointer-events: none;
}
.stats-grid {
  display: grid; grid-template-columns: repeat(4, 1fr);
  gap: 0;
}
.stat-item {
  padding: 28px 32px;
  border-right: 1px solid rgba(255,255,255,0.07);
  transition: var(--transition);
  position: relative; overflow: hidden;
}
.stat-item::before {
  content: '';
  position: absolute; bottom: 0; left: 0;
  width: 0; height: 3px;
  background: linear-gradient(90deg, var(--cyan), var(--blue-lt));
  transition: width 0.5s ease;
}
.stat-item:hover::before { width: 100%; }
.stat-item:last-child { border-right: none; }
.stat-item:hover { background: rgba(255,255,255,0.04); }
.stat-num {
  font-family: var(--font-display);
  font-size: 36px; font-weight: 900;
  color: var(--white);
  line-height: 1;
  margin-bottom: 5px;
  letter-spacing: -0.03em;
}
.stat-num sup { font-size: 18px; font-weight: 700; color: var(--cyan); vertical-align: top; margin-top: 4px; display: inline-block; }
.stat-label { font-size: 12px; color: rgba(255,255,255,0.5); font-weight: 500; text-transform: uppercase; letter-spacing: 0.07em; }
.stat-sub { font-size: 11px; color: rgba(255,255,255,0.3); margin-top: 2px; }

/* ===================================================
   SECTION BASE
   =================================================== */
section { padding: 80px 0; }

/* ===================================================
   LAYANAN SECTION
   =================================================== */
.layanan-section { background: var(--off-white); }
.layanan-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 18px;
  margin-top: 44px;
}
.layanan-card {
  background: var(--white);
  border-radius: var(--r-lg);
  padding: 28px 22px;
  border: 1px solid var(--gray-100);
  box-shadow: var(--shadow-card);
  transition: var(--transition);
  cursor: pointer; text-align: center;
  position: relative; overflow: hidden;
}
.layanan-card::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--blue), var(--cyan));
  transform: scaleX(0); transform-origin: left;
  transition: transform 0.35s ease;
}
.layanan-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lift); border-color: var(--blue-pale); }
.layanan-card:hover::before { transform: scaleX(1); }
.layanan-icon {
  width: 56px; height: 56px;
  border-radius: 14px;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 16px;
  transition: var(--transition);
}
.layanan-card:hover .layanan-icon { transform: scale(1.08); }
.layanan-icon svg { width: 26px; height: 26px; }
.layanan-name { font-size: 13.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 7px; }
.layanan-desc { font-size: 12px; color: var(--text-mute); line-height: 1.55; }

/* ===================================================
   BERITA SECTION
   =================================================== */
.berita-section { background: var(--white); }
.berita-header {
  display: flex; align-items: flex-end; justify-content: space-between;
  margin-bottom: 36px; gap: 20px;
}
.btn-all {
  display: inline-flex; align-items: center; gap: 7px;
  border: 1.5px solid var(--blue); color: var(--blue);
  font-size: 13px; font-weight: 600;
  padding: 9px 20px; border-radius: 9px;
  background: transparent; transition: var(--transition);
  white-space: nowrap; flex-shrink: 0;
}
.btn-all:hover { background: var(--blue); color: var(--white); }
.btn-all svg { width: 13px; height: 13px; }
.berita-grid {
  display: grid;
  grid-template-columns: 1.35fr 1fr;
  gap: 22px;
}
.berita-featured {
  border-radius: var(--r-lg);
  overflow: hidden;
  background: var(--gray-800);
  position: relative;
  min-height: 420px;
  cursor: pointer;
  box-shadow: var(--shadow-card);
  transition: var(--transition);
}
.berita-featured:hover { transform: translateY(-2px); box-shadow: var(--shadow-lift); }
.berita-featured-img {
  position: absolute; inset: 0;
  background-size: cover;
  background-position: center;
  transition: transform 0.6s ease;
}
.berita-featured:hover .berita-featured-img { transform: scale(1.04); }
.berita-featured-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(10,31,92,0.95) 0%, rgba(10,31,92,0.3) 60%, transparent 100%);
}
.berita-featured-content {
  position: absolute; bottom: 0; left: 0; right: 0;
  padding: 28px;
}
.berita-cat {
  display: inline-block;
  font-size: 10px; font-weight: 700; letter-spacing: 0.1em;
  text-transform: uppercase;
  background: var(--gold); color: var(--white);
  padding: 3px 10px; border-radius: 4px; margin-bottom: 10px;
}
.berita-featured-title {
  font-family: var(--font-display);
  font-size: clamp(17px, 2vw, 22px);
  font-weight: 800; color: var(--white);
  line-height: 1.3; margin-bottom: 10px;
}
.berita-meta { font-size: 11.5px; color: rgba(255,255,255,0.6); display: flex; gap: 12px; align-items: center; }
.berita-meta-dot { width: 3px; height: 3px; border-radius: 50%; background: rgba(255,255,255,0.4); }
.berita-list { display: flex; flex-direction: column; gap: 14px; }
.berita-card {
  display: flex; gap: 14px; align-items: flex-start;
  background: var(--white);
  border: 1px solid var(--gray-100);
  border-radius: var(--r);
  padding: 14px;
  cursor: pointer; transition: var(--transition);
  box-shadow: var(--shadow-card);
}
.berita-card:hover { border-color: var(--blue-pale); transform: translateX(3px); }
.berita-thumb {
  width: 80px; height: 80px;
  border-radius: 9px; flex-shrink: 0;
  overflow: hidden;
}
.berita-thumb-img {
  width: 100%; height: 100%;
  object-fit: cover;
}
.berita-card-body { flex: 1; min-width: 0; }
.berita-card-cat {
  font-size: 10px; font-weight: 700; letter-spacing: 0.08em;
  text-transform: uppercase; color: var(--blue-lt);
  margin-bottom: 5px;
}
.berita-card-title {
  font-size: 13px; font-weight: 700; color: var(--text-dark);
  line-height: 1.4;
  display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
  overflow: hidden; margin-bottom: 7px;
}
.berita-card-meta { font-size: 11px; color: var(--text-mute); }

/* ===================================================
   PROGRAM UNGGULAN
   =================================================== */
.program-section { background: var(--off-white); }
.program-grid {
  display: grid; grid-template-columns: repeat(3, 1fr);
  gap: 18px; margin-top: 44px;
}
.program-card {
  background: var(--white);
  border-radius: var(--r-lg);
  overflow: hidden;
  border: 1px solid var(--gray-100);
  box-shadow: var(--shadow-card);
  transition: var(--transition);
  cursor: pointer;
}
.program-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lift); }
.program-visual {
  height: 180px;
  position: relative; overflow: hidden;
  background-size: cover;
  background-position: center;
}
.prog-v1 { background-image: url('assets/img/test1.jpg'); }
.prog-v2 { background-image: url('assets/img/program-data.jpg'); }
.prog-v3 { background-image: url('assets/img/program-ekonomi.jpg'); }
.program-visual-badge {
  position: absolute; top: 14px; left: 14px;
  background: rgba(255,255,255,0.15);
  border: 1px solid rgba(255,255,255,0.25);
  backdrop-filter: blur(8px);
  color: var(--white); font-size: 10px; font-weight: 700;
  padding: 4px 10px; border-radius: 99px;
  letter-spacing: 0.06em; text-transform: uppercase;
}
.program-body { padding: 20px; }
.program-title { font-size: 14.5px; font-weight: 700; color: var(--text-dark); margin-bottom: 7px; }
.program-desc { font-size: 12.5px; color: var(--text-mute); line-height: 1.6; margin-bottom: 14px; }
.program-tags { display: flex; gap: 6px; flex-wrap: wrap; }
.tag {
  font-size: 10.5px; font-weight: 600;
  background: var(--blue-50); color: var(--blue-lt);
  border: 1px solid var(--blue-pale);
  padding: 2px 9px; border-radius: 99px;
}

/* ===================================================
   PENGUMUMAN & DOKUMEN — 2 COL
   =================================================== */
.info-section { background: var(--white); }
.info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 22px; margin-top: 44px; }
.info-card {
  background: var(--white);
  border: 1px solid var(--gray-100);
  border-radius: var(--r-lg);
  overflow: hidden;
  box-shadow: var(--shadow-card);
}
.info-card-head {
  background: var(--navy);
  padding: 16px 22px;
  display: flex; align-items: center; justify-content: space-between;
}
.info-card-head-title {
  font-size: 14px; font-weight: 700; color: var(--white);
  display: flex; align-items: center; gap: 9px;
}
.info-card-head-title svg { width: 16px; height: 16px; color: var(--cyan); }
.info-card-link { font-size: 11.5px; color: rgba(255,255,255,0.6); transition: var(--transition); }
.info-card-link:hover { color: var(--white); }
.info-list { }
.info-item {
  display: flex; align-items: flex-start; gap: 12px;
  padding: 13px 20px;
  border-bottom: 1px solid var(--gray-50);
  transition: var(--transition); cursor: pointer;
}
.info-item:last-child { border-bottom: none; }
.info-item:hover { background: var(--blue-50); }
.info-item-date {
  min-width: 46px;
  background: var(--blue-50); border: 1px solid var(--blue-pale);
  border-radius: 7px; padding: 5px 6px;
  text-align: center; flex-shrink: 0;
}
.info-date-day { font-size: 16px; font-weight: 800; color: var(--blue-lt); line-height: 1; }
.info-date-mon { font-size: 9.5px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; }
.info-item-body { flex: 1; min-width: 0; }
.info-item-title { font-size: 12.5px; font-weight: 600; color: var(--text-dark); line-height: 1.45; margin-bottom: 4px; }
.info-item-sub { font-size: 11px; color: var(--text-mute); }
.info-item-badge {
  font-size: 9.5px; font-weight: 700;
  padding: 2px 7px; border-radius: 4px;
  letter-spacing: 0.05em; text-transform: uppercase;
  flex-shrink: 0; margin-top: 2px;
}
.dok-item {
  display: flex; align-items: center; gap: 12px;
  padding: 13px 20px;
  border-bottom: 1px solid var(--gray-50);
  transition: var(--transition); cursor: pointer;
}
.dok-item:last-child { border-bottom: none; }
.dok-item:hover { background: var(--blue-50); }
.dok-icon {
  width: 38px; height: 38px;
  border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.dok-icon svg { width: 18px; height: 18px; }
.dok-body { flex: 1; min-width: 0; }
.dok-title { font-size: 12.5px; font-weight: 600; color: var(--text-dark); margin-bottom: 2px; }
.dok-meta { font-size: 11px; color: var(--text-mute); }
.dok-dl {
  width: 30px; height: 30px;
  border-radius: 7px;
  background: var(--blue-50); border: 1px solid var(--blue-pale);
  display: flex; align-items: center; justify-content: center;
  color: var(--blue-lt); flex-shrink: 0; transition: var(--transition);
}
.dok-item:hover .dok-dl { background: var(--blue); color: var(--white); }
.dok-dl svg { width: 13px; height: 13px; }

/* ===================================================
   GALERI FOTO
   =================================================== */
.galeri-section { background: var(--off-white); }
.galeri-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-template-rows: 180px 180px;
  gap: 14px; margin-top: 44px;
}
.galeri-item {
  border-radius: var(--r);
  overflow: hidden;
  position: relative; cursor: pointer;
  transition: var(--transition);
}
.galeri-item:hover { transform: scale(0.98); }
.galeri-item:first-child { grid-column: span 2; grid-row: span 2; }
.galeri-img {
  width: 100%; height: 100%;
  background-size: cover; background-position: center;
  transition: transform 0.5s ease;
}
.galeri-item:hover .galeri-img { transform: scale(1.06); }
.galeri-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(10,31,92,0.7) 0%, transparent 60%);
  opacity: 0; transition: var(--transition);
}
.galeri-item:hover .galeri-overlay { opacity: 1; }
.galeri-caption {
  position: absolute; bottom: 12px; left: 12px; right: 12px;
  color: var(--white); font-size: 12px; font-weight: 600;
  opacity: 0; transform: translateY(6px); transition: var(--transition);
}
.galeri-item:hover .galeri-caption { opacity: 1; transform: none; }

/* ===================================================
   TAUTAN PENTING — QUICK LINKS
   =================================================== */
.quicklink-section { background: var(--white); padding: 60px 0; }
.quicklink-grid {
  display: grid; grid-template-columns: repeat(6, 1fr);
  gap: 14px; margin-top: 40px;
}
.qlink {
  background: var(--white);
  border: 1px solid var(--gray-100);
  border-radius: var(--r);
  padding: 20px 12px;
  text-align: center; cursor: pointer;
  transition: var(--transition);
  box-shadow: 0 2px 12px rgba(10,31,92,0.06);
  text-decoration: none;
}
.qlink:hover {
  border-color: var(--blue-pale);
  background: var(--blue-50);
  transform: translateY(-3px);
  box-shadow: var(--shadow-card);
}
.qlink-icon {
  width: 46px; height: 46px;
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 10px;
  transition: var(--transition);
}
.qlink:hover .qlink-icon { transform: scale(1.1); }
.qlink-icon img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}
.qlink-label { font-size: 11.5px; font-weight: 700; color: var(--text-dark); line-height: 1.35; }

/* ===================================================
   CTA BAND
   =================================================== */
.cta-section {
  background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 100%);
  padding: 70px 0; position: relative; overflow: hidden;
}
.cta-section::before {
  content: '';
  position: absolute; top: -50%; right: -10%;
  width: 500px; height: 500px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(14,165,233,0.18) 0%, transparent 65%);
  pointer-events: none;
}
.cta-inner {
  display: flex; align-items: center; justify-content: space-between; gap: 40px;
}
.cta-text .section-title { color: var(--white); }
.cta-text .section-sub { color: rgba(255,255,255,0.7); max-width: 480px; }
.cta-actions { display: flex; gap: 14px; flex-shrink: 0; flex-wrap: wrap; }
.btn-cta {
  display: inline-flex; align-items: center; gap: 9px;
  background: var(--white); color: var(--navy);
  font-size: 14px; font-weight: 700;
  padding: 14px 28px; border-radius: 12px;
  border: none; transition: var(--transition);
  box-shadow: 0 6px 24px rgba(0,0,0,0.2);
}
.btn-cta:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(0,0,0,0.25); }
.btn-cta svg { width: 15px; height: 15px; color: var(--blue-lt); }
.btn-cta-outline {
  display: inline-flex; align-items: center; gap: 9px;
  background: transparent;
  border: 2px solid rgba(255,255,255,0.35);
  color: var(--white); font-size: 14px; font-weight: 600;
  padding: 13px 26px; border-radius: 12px;
  transition: var(--transition);
}
.btn-cta-outline:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.6); }

/* ===================================================
   FOOTER
   =================================================== */
footer {
  background: var(--gray-800);
  padding: 60px 0 0;
}
.footer-grid {
  display: grid;
  grid-template-columns: 1.4fr 1fr 1fr 1fr;
  gap: 40px;
  padding-bottom: 50px;
  border-bottom: 1px solid rgba(255,255,255,0.07);
}
.footer-brand { }
.footer-logo {
  display: flex; align-items: center; gap: 12px; margin-bottom: 16px;
}
.footer-logo-box {
  width: 44px; height: 44px;
  border-radius: 10px;
  background: linear-gradient(135deg, var(--blue) 0%, var(--cyan) 100%);
  display: flex; align-items: center; justify-content: center;
}
.footer-logo-box svg { width: 22px; height: 22px; }
.footer-logo-text { }
.footer-logo-name { font-size: 14px; font-weight: 700; color: var(--white); }
.footer-logo-sub { font-size: 11px; color: rgba(255,255,255,0.4); }
.footer-desc { font-size: 12.5px; color: rgba(255,255,255,0.5); line-height: 1.65; margin-bottom: 18px; }
.footer-contact { font-size: 12px; color: rgba(255,255,255,0.5); }
.footer-contact strong { color: rgba(255,255,255,0.75); }
.footer-contact p { margin-bottom: 5px; display: flex; align-items: flex-start; gap: 7px; }
.footer-contact svg { width: 13px; height: 13px; flex-shrink: 0; margin-top: 2px; color: var(--cyan); }
.footer-col-title {
  font-size: 12.5px; font-weight: 700; color: rgba(255,255,255,0.85);
  text-transform: uppercase; letter-spacing: 0.08em;
  margin-bottom: 16px;
  padding-bottom: 10px;
  border-bottom: 1px solid rgba(255,255,255,0.07);
}
.footer-links { list-style: none; }
.footer-links li { margin-bottom: 9px; }
.footer-links a {
  font-size: 12.5px; color: rgba(255,255,255,0.5);
  display: flex; align-items: center; gap: 7px;
  transition: var(--transition);
}
.footer-links a:hover { color: var(--cyan); transform: translateX(3px); }
.footer-links a::before {
  content: '›'; color: var(--blue-lt); font-size: 14px; flex-shrink: 0;
}
.footer-bottom {
  padding: 18px 0;
  display: flex; align-items: center; justify-content: space-between;
  flex-wrap: wrap; gap: 10px;
}
.footer-bottom-left { font-size: 12px; color: rgba(255,255,255,0.35); }
.footer-bottom-right { display: flex; gap: 14px; align-items: center; }
.footer-bottom-right a { font-size: 11.5px; color: rgba(255,255,255,0.35); transition: var(--transition); }
.footer-bottom-right a:hover { color: rgba(255,255,255,0.65); }
.sosmed { display: flex; gap: 8px; margin-top: 18px; }
.sosmed-btn {
  width: 34px; height: 34px;
  border-radius: 8px;
  border: 1px solid rgba(255,255,255,0.12);
  background: rgba(255,255,255,0.06);
  display: flex; align-items: center; justify-content: center;
  color: rgba(255,255,255,0.5);
  transition: var(--transition); cursor: pointer;
}
.sosmed-btn:hover { background: var(--blue-lt); border-color: var(--blue-lt); color: var(--white); }
.sosmed-btn svg { width: 15px; height: 15px; }
.back-top {
  position: fixed; bottom: 28px; right: 28px; z-index: 900;
  width: 44px; height: 44px;
  background: var(--blue); color: var(--white);
  border-radius: 50%; border: none;
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 4px 20px rgba(19,64,196,0.4);
  cursor: pointer; transition: var(--transition);
  opacity: 0; transform: translateY(10px); pointer-events: none;
}
.back-top.show { opacity: 1; transform: none; pointer-events: all; }
.back-top:hover { background: var(--navy); transform: translateY(-2px); }
.back-top svg { width: 18px; height: 18px; }

/* ===================================================
   RESPONSIVE
   =================================================== */
@media (max-width: 1024px) {
  .layanan-grid { grid-template-columns: repeat(2, 1fr); }
  .program-grid { grid-template-columns: 1fr 1fr; }
  .quicklink-grid { grid-template-columns: repeat(3, 1fr); }
  .footer-grid { grid-template-columns: 1fr 1fr; }
  .berita-grid { grid-template-columns: 1fr; }
  .berita-featured { min-height: 320px; }
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .hero-info-card { display: none; }
}
@media (max-width: 768px) {
  .container { padding: 0 20px; }
  section { padding: 56px 0; }
  .nav-links { display: none; }
  .galeri-grid { grid-template-columns: 1fr 1fr; grid-template-rows: unset; }
  .galeri-item:first-child { grid-column: span 2; }
  .info-grid { grid-template-columns: 1fr; }
  .cta-inner { flex-direction: column; text-align: center; }
  .cta-actions { justify-content: center; }
  .quicklink-grid { grid-template-columns: repeat(3, 1fr); }
  .footer-grid { grid-template-columns: 1fr; }
  .program-grid { grid-template-columns: 1fr; }
  .berita-list .berita-card { flex-direction: column; }
  .berita-thumb { width: 100%; height: 140px; }
}

.footer-logo-box {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  background: transparent; /* Hapus background gradient */
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.footer-logo-box img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  display: block;
}
</style>
</head>
<body>

<!-- ===================================================
     TOPBAR TICKER
     =================================================== -->
<div class="topbar-ticker">
  <div class="ticker-label">
    <svg viewBox="0 0 14 14" fill="currentColor"><path d="M7 1a6 6 0 100 12A6 6 0 007 1zm.75 3.5v3.25l2.5 1.5-.5.87-3-1.75V4.5h1z"/></svg>
    Pengumuman
  </div>
  <div style="overflow:hidden; flex:1;">
    <div class="ticker-track">
      <span class="ticker-item">Pengumuman Rekrutmen ASN Bappeda Banyuwangi Tahun 2026</span>
      <span class="ticker-item">Rapat Koordinasi RKPD Kabupaten Banyuwangi Mei 2026</span>
      <span class="ticker-item">Musrenbang Kecamatan Banyuwangi Selatan — 15 Mei 2026</span>
      <span class="ticker-item">Publikasi RPJMD Kabupaten Banyuwangi 2026–2031 telah tersedia</span>
      <span class="ticker-item">Pembaruan Sistem SMB: Fitur Print Laporan v2.0 telah diluncurkan</span>
      <span class="ticker-item">Pengumuman Rekrutmen ASN Bappeda Banyuwangi Tahun 2026</span>
      <span class="ticker-item">Rapat Koordinasi RKPD Kabupaten Banyuwangi Mei 2026</span>
      <span class="ticker-item">Musrenbang Kecamatan Banyuwangi Selatan — 15 Mei 2026</span>
      <span class="ticker-item">Publikasi RPJMD Kabupaten Banyuwangi 2026–2031 telah tersedia</span>
      <span class="ticker-item">Pembaruan Sistem SMB: Fitur Print Laporan v2.0 telah diluncurkan</span>
    </div>
  </div>
</div>

<!-- ===================================================
     NAVBAR - FIXED & ALWAYS TRANSPARENT
     =================================================== -->
<nav class="navbar" id="navbar">
  <div class="container">
    <div class="nav-inner">
      <!-- Logo Kiri -->
      <div class="nav-brand">
        <div class="nav-logo">
          <img src="/CVIDE/assets/img/Bappeda.png" alt="Bappeda Banyuwangi">
        </div>
        <div class="nav-brand-text">
          <div class="nav-brand-name">Bappeda</div>
          <div class="nav-brand-sub">Banyuwangi</div>
        </div>
      </div>

      <!-- Menu Tengah - Bentuk Oval -->
      <div class="nav-center">
        <ul class="nav-links">
          <li><a href="#" class="active">Beranda</a></li>
          <li><a href="#about">Profil</a></li>
          <li><a href="#layanan">Layanan</a></li>
          <li><a href="#berita">Berita</a></li>
          <li><a href="#program">Program</a></li>
          <li><a href="#kontak">Kontak</a></li>
        </ul>
      </div>

      <!-- Tombol Kanan -->
      <div class="nav-cta">
        <button class="btn-login" onclick="window.location.href='SmbLoginPage'">
          <svg viewBox="0 0 16 16" fill="currentColor">
            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h4a1 1 0 010 2H5v8h3a1 1 0 010 2H4a1 1 0 01-1-1V3zm9.293 2.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-2 2a1 1 0 01-1.414-1.414L13.586 8l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>
          Masuk
        </button>
      </div>
    </div>
  </div>
</nav>
<!-- ===================================================
     HERO SLIDESHOW
     =================================================== -->
<section class="hero" id="hero">
  <div class="hero-slide slide-1 active" id="slide-0"></div>
  <div class="hero-slide slide-2" id="slide-1"></div>
  <div class="hero-slide slide-3" id="slide-2"></div>
  <div class="hero-slide slide-4" id="slide-3"></div>
  <div class="slide-decor"></div>
  <div class="hero-grid"></div>
  <div class="hero-overlay"></div>
  <div class="hero-overlay-left"></div>
  <div class="hero-content">
    <div class="container">
      
      <h1 class="hero-headline" id="hero-headline">
        Menuju Banyuwangi<br>yang <span class="accent">Cerdas & Maju</span>
      </h1>
      <div class="hero-actions">
        <button class="btn-hero-ghost" onclick="window.open('https://www.youtube.com/embed/6Ydn3v320lg?autoplay=1&si=rGZd08GSm4f7QU6f', '_blank', 'width=800,height=500')">
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="8" r="7"/><polygon points="6,5 12,8 6,11" fill="currentColor" stroke="none"/></svg>
          Profil Bappeda
        </button>
      </div>
    </div>
  </div>
  <div class="hero-arrow hero-arrow-prev" onclick="changeSlide(-1)">
    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 4l-6 6 6 6"/></svg>
  </div>
  <div class="hero-arrow hero-arrow-next" onclick="changeSlide(1)">
    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 4l6 6-6 6"/></svg>
  </div>
  <div class="hero-indicators">
    <div class="hero-dot active" onclick="goSlide(0)"></div>
    <div class="hero-dot" onclick="goSlide(1)"></div>
    <div class="hero-dot" onclick="goSlide(2)"></div>
    <div class="hero-dot" onclick="goSlide(3)"></div>
  </div>
  <div class="hero-info-card">
    <div class="hero-info-date">Banyuwangi, 5 Mei 2026</div>
    <div class="hero-info-title">Musrenbang RKPD Kabupaten Banyuwangi 2026 Resmi Dibuka</div>
    <span class="hero-info-badge">Berita Terbaru</span>
  </div>
</section>

<!-- ===================================================
     STATISTICS BAR
     =================================================== -->
<div class="stats-bar">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item">
        <div class="stat-num"><span id="cnt-users">0</span></div>
        <div class="stat-label">Total Pengguna Aktif</div>
        <div class="stat-sub">Seluruh Bidang Bappeda</div>
      </div>
      <div class="stat-item">
        <div class="stat-num"><span id="cnt-docs">0</span></div>
        <div class="stat-label">Dokumen Terkelola</div>
        <div class="stat-sub">Arsip Digital Terintegrasi</div>
      </div>
      <div class="stat-item">
        <div class="stat-num"><span id="cnt-programs">0</span></div>
        <div class="stat-label">Program Prioritas</div>
        <div class="stat-sub">Tahun Anggaran 2026</div>
      </div>
      <div class="stat-item">
        <div class="stat-num"><span id="cnt-bidang">0</span></div>
        <div class="stat-label">Bidang Terintegrasi</div>
        <div class="stat-sub">Satu Platform, Satu Data</div>
      </div>
    </div>
  </div>
</div>

<!-- ===================================================
     BERITA & INFORMASI
     =================================================== -->
<section class="berita-section" id="berita">
  <div class="container">
    <div class="berita-header">
      <div>
        <h2 class="section-title">Kabar Terkini <span>Bappeda</span></h2>
      </div>
      <button class="btn-all">
        Semua Berita
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2.5 7h9M8 3.5l3.5 3.5-3.5 3.5"/></svg>
      </button>
    </div>
    <div class="berita-grid">
      <div class="berita-featured">
        <div class="berita-featured-img" style="background-image: url('/CVIDE/assets/img/test1.jpg');"></div>
        <div class="berita-featured-overlay"></div>
        <div class="berita-featured-content">
          <span class="berita-cat">Perencanaan</span>
          <div class="berita-featured-title">Musrenbang RKPD Banyuwangi 2027 Resmi Dibuka, Fokus pada Pembangunan Inklusif dan Berkelanjutan</div>
          <div class="berita-meta">
            <span>5 Mei 2026</span>
            <span class="berita-meta-dot"></span>
            <span>Bappeda Banyuwangi</span>
            <span class="berita-meta-dot"></span>
            <span>5 mnt baca</span>
          </div>
        </div>
      </div>
      <div class="berita-list">
        <div class="berita-card">
          <div class="berita-thumb">
            <img src="/CVIDE/assets/img/test1.jpg" alt="Berita 1" class="berita-thumb-img">
          </div>
          <div class="berita-card-body">
            <div class="berita-card-cat">Pembangunan</div>
            <div class="berita-card-title">Bappeda Luncurkan Dashboard Monitoring Pembangunan Infrastruktur Desa 2026</div>
            <div class="berita-card-meta">3 Mei 2026 · 3 mnt baca</div>
          </div>
        </div>
        <div class="berita-card">
          <div class="berita-thumb">
            <img src="/CVIDE/assets/img/test1.jpg" alt="Berita 2" class="berita-thumb-img">
          </div>
          <div class="berita-card-body">
            <div class="berita-card-cat">SDM & Kepegawaian</div>
            <div class="berita-card-title">Pelatihan Penggunaan Sistem SMB untuk Seluruh ASN Bappeda Banyuwangi</div>
            <div class="berita-card-meta">30 Apr 2026 · 2 mnt baca</div>
          </div>
        </div>
        <div class="berita-card">
          <div class="berita-thumb">
            <img src="/CVIDE/assets/img/test1.jpg" alt="Berita 3" class="berita-thumb-img">
          </div>
          <div class="berita-card-body">
            <div class="berita-card-cat">Evaluasi</div>
            <div class="berita-card-title">Rapat Evaluasi Capaian RPJMD Triwulan I Tahun 2026</div>
            <div class="berita-card-meta">27 Apr 2026 · 4 mnt baca</div>
          </div>
        </div>
        <div class="berita-card">
          <div class="berita-thumb">
            <img src="/CVIDE/assets/img/test1.jpg" alt="Berita 4" class="berita-thumb-img">
          </div>
          <div class="berita-card-body">
            <div class="berita-card-cat">Digitalisasi</div>
            <div class="berita-card-title">Banyuwangi Raih Penghargaan Smart Government Award 2026</div>
            <div class="berita-card-meta">24 Apr 2026 · 3 mnt baca</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================================================
     PROGRAM UNGGULAN
     =================================================== -->
<section class="program-section" id="program">
  <div class="container">
    <div style="display:flex; align-items:flex-end; justify-content:space-between; gap:20px; margin-bottom:44px;">
      <div>
        <h2 class="section-title">Program Unggulan <span>2026</span></h2>
        <p class="section-sub">Prioritas pembangunan Kabupaten Banyuwangi yang dikelola dan dimonitor melalui platform SMB Bappeda.</p>
      </div>
      <button class="btn-all">Semua Program <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2.5 7h9M8 3.5l3.5 3.5-3.5 3.5"/></svg></button>
    </div>
    <div class="program-grid">
      <!-- Program 1 -->
      <div class="program-card">
        <div class="program-visual" style="background-image: url('/CVIDE/assets/img/test1.jpg'); background-size: cover; background-position: center;">
          <div class="program-visual-badge">Prioritas 1</div>
        </div>
        <div class="program-body">
          <div class="program-title">Pengembangan Infrastruktur Digital Daerah</div>
          <div class="program-desc">Membangun ekosistem digital yang menghubungkan seluruh OPD dan masyarakat Banyuwangi secara terintegrasi.</div>
          <div class="program-tags"><span class="tag">Smart City</span><span class="tag">Infrastruktur</span><span class="tag">2026</span></div>
        </div>
      </div>

      <!-- Program 2 -->
      <div class="program-card">
        <div class="program-visual" style="background-image: url('/CVIDE/assets/img/test1.jpg'); background-size: cover; background-position: center;">
          <div class="program-visual-badge">Prioritas 2</div>
        </div>
        <div class="program-body">
          <div class="program-title">Penguatan Perencanaan Berbasis Data</div>
          <div class="program-desc">Implementasi Satu Data Banyuwangi untuk mendukung pengambilan keputusan berbasis bukti yang akurat dan tepat sasaran.</div>
          <div class="program-tags"><span class="tag">Satu Data</span><span class="tag">Analitik</span><span class="tag">Riset</span></div>
        </div>
      </div>

      <!-- Program 3 -->
      <div class="program-card">
        <div class="program-visual" style="background-image: url('/CVIDE/assets/img/test1.jpg'); background-size: cover; background-position: center;">
          <div class="program-visual-badge">Prioritas 3</div>
        </div>
        <div class="program-body">
          <div class="program-title">Pemberdayaan Ekonomi Lokal & UMKM</div>
          <div class="program-desc">Mendorong pertumbuhan ekonomi inklusif melalui digitalisasi UMKM, pengembangan pariwisata, dan pertanian berbasis teknologi.</div>
          <div class="program-tags"><span class="tag">UMKM</span><span class="tag">Pariwisata</span><span class="tag">Ekonomi</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================================================
     PENGUMUMAN & DOKUMEN
     =================================================== -->
<section class="info-section" id="dokumen">
  <div class="container">
    <div style="text-align:center; max-width:560px; margin:0 auto 0;">
      <h2 class="section-title">Pengumuman & <span>Unduhan</span></h2>
    </div>
    <div class="info-grid">
      <div class="info-card">
        <div class="info-card-head">
          <div class="info-card-head-title">
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M10 2a8 8 0 100 16A8 8 0 0010 2zm1 11H9V9h2v4zm0-6H9V5h2v2z"/></svg>
            Pengumuman
          </div>
          <a href="#" class="info-card-link">Semua →</a>
        </div>
        <div class="info-list">
          <div class="info-item">
            <div class="info-item-date"><div class="info-date-day">15</div><div class="info-date-mon">Mei</div></div>
            <div class="info-item-body">
              <div class="info-item-title">Musrenbang Kecamatan Banyuwangi Selatan Tahun 2026</div>
              <div class="info-item-sub">Aula Kecamatan Banyuwangi Selatan · 09.00 WIB</div>
            </div>
            <div class="info-item-badge" style="background:#eff4ff;color:#1340c4;">Event</div>
          </div>
          <div class="info-item">
            <div class="info-item-date"><div class="info-date-day">10</div><div class="info-date-mon">Mei</div></div>
            <div class="info-item-body">
              <div class="info-item-title">Rekrutmen Tenaga Ahli Perencanaan Pembangunan 2026</div>
              <div class="info-item-sub">Batas pendaftaran 10 Mei 2026</div>
            </div>
            <div class="info-item-badge" style="background:#dcfce7;color:#15803d;">Rekrutmen</div>
          </div>
          <div class="info-item">
            <div class="info-item-date"><div class="info-date-day">08</div><div class="info-date-mon">Mei</div></div>
            <div class="info-item-body">
              <div class="info-item-title">Rapat Koordinasi Evaluasi Program Prioritas Triwulan I</div>
              <div class="info-item-sub">Ruang Rapat Utama Bappeda · 08.30 WIB</div>
            </div>
            <div class="info-item-badge" style="background:#fef3c7;color:#92400e;">Rapat</div>
          </div>
          <div class="info-item">
            <div class="info-item-date"><div class="info-date-day">05</div><div class="info-date-mon">Mei</div></div>
            <div class="info-item-body">
              <div class="info-item-title">Peluncuran Sistem SMB Versi 2.0 — Pembaruan Fitur Utama</div>
              <div class="info-item-sub">Informasi pembaruan sistem manajemen bersama</div>
            </div>
            <div class="info-item-badge" style="background:#f3e8ff;color:#7e22ce;">Sistem</div>
          </div>
          <div class="info-item">
            <div class="info-item-date"><div class="info-date-day">01</div><div class="info-date-mon">Mei</div></div>
            <div class="info-item-body">
              <div class="info-item-title">Publikasi RPJMD Kabupaten Banyuwangi 2026–2031</div>
              <div class="info-item-sub">Dokumen resmi telah tersedia untuk diunduh</div>
            </div>
            <div class="info-item-badge" style="background:#eff4ff;color:#1340c4;">Dokumen</div>
          </div>
        </div>
      </div>
      <div class="info-card">
        <div class="info-card-head">
          <div class="info-card-head-title">
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
            Dokumen Publik
          </div>
          <a href="#" class="info-card-link">Semua →</a>
        </div>
        <div>
          <div class="dok-item">
            <div class="dok-icon" style="background:#eff4ff;"><svg viewBox="0 0 20 20" fill="#1340c4"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg></div>
            <div class="dok-body">
              <div class="dok-title">RPJMD Kab. Banyuwangi 2026–2031</div>
              <div class="dok-meta">PDF · 8.4 MB · Diunggah 1 Mei 2026</div>
            </div>
            <div class="dok-dl"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1v9M4 7l3 3 3-3M2 12h10"/></svg></div>
          </div>
          <div class="dok-item">
            <div class="dok-icon" style="background:#eff4ff;"><svg viewBox="0 0 20 20" fill="#1340c4"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg></div>
            <div class="dok-body">
              <div class="dok-title">RKPD Tahun 2026 Final</div>
              <div class="dok-meta">PDF · 5.2 MB · Diunggah 15 Apr 2026</div>
            </div>
            <div class="dok-dl"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1v9M4 7l3 3 3-3M2 12h10"/></svg></div>
          </div>
          <div class="dok-item">
            <div class="dok-icon" style="background:#eff4ff;"><svg viewBox="0 0 20 20" fill="#1340c4"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg></div>
            <div class="dok-body">
              <div class="dok-title">Laporan Kinerja Bappeda 2025</div>
              <div class="dok-meta">PDF · 3.8 MB · Diunggah 10 Apr 2026</div>
            </div>
            <div class="dok-dl"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1v9M4 7l3 3 3-3M2 12h10"/></svg></div>
          </div>
          <div class="dok-item">
            <div class="dok-icon" style="background:#eff4ff;"><svg viewBox="0 0 20 20" fill="#1340c4"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg></div>
            <div class="dok-body">
              <div class="dok-title">Renstra Bappeda 2025–2030</div>
              <div class="dok-meta">PDF · 6.1 MB · Diunggah 5 Mar 2026</div>
            </div>
            <div class="dok-dl"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1v9M4 7l3 3 3-3M2 12h10"/></svg></div>
          </div>
          <div class="dok-item">
            <div class="dok-icon" style="background:#eff4ff;"><svg viewBox="0 0 20 20" fill="#1340c4"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg></div>
            <div class="dok-body">
              <div class="dok-title">Profil Daerah Kabupaten Banyuwangi 2025</div>
              <div class="dok-meta">PDF · 12.3 MB · Diunggah 20 Feb 2026</div>
            </div>
            <div class="dok-dl"><svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 1v9M4 7l3 3 3-3M2 12h10"/></svg></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================================================
     GALERI FOTO
     =================================================== -->
<section class="galeri-section">
  <div class="container">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:0;">
      <div>
        <h2 class="section-title">Dokumentasi <span>Kegiatan</span></h2>
      </div>
      <button class="btn-all">Lihat Semua <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2.5 7h9M8 3.5l3.5 3.5-3.5 3.5"/></svg></button>
    </div>
    <div class="galeri-grid">
      <div class="galeri-item">
        <div class="galeri-img" style="background-image: url('/CVIDE/assets/img/test1.jpg');"></div>
        <div class="galeri-overlay"></div>
        <div class="galeri-caption">Gedung Bappeda Kabupaten Banyuwangi</div>
      </div>
      <div class="galeri-item">
        <div class="galeri-img" style="background-image: url('/CVIDE/assets/img/test1.jpg');"></div>
        <div class="galeri-overlay"></div>
        <div class="galeri-caption">Musrenbang RKPD 2026</div>
      </div>
      <div class="galeri-item">
        <div class="galeri-img" style="background-image: url('/CVIDE/assets/img/test1.jpg');"></div>
        <div class="galeri-overlay"></div>
        <div class="galeri-caption">Pelatihan Sistem SMB</div>
      </div>
      <div class="galeri-item">
        <div class="galeri-img" style="background-image: url('/CVIDE/assets/img/test1.jpg');"></div>
        <div class="galeri-overlay"></div>
        <div class="galeri-caption">Penghargaan Smart Government 2026</div>
      </div>
      <div class="galeri-item">
        <div class="galeri-img" style="background-image: url('/CVIDE/assets/img/test1.jpg');"></div>
        <div class="galeri-overlay"></div>
        <div class="galeri-caption">Kunjungan Kerja Pimpinan</div>
      </div>
    </div>
  </div>
</section>

<!-- ===================================================
     QUICK LINKS (SEMUA MENGGUNAKAN GAMBAR)
     =================================================== -->
<section class="quicklink-section" id="kontak">
  <div class="container">
    <div style="text-align:center; max-width:500px; margin:0 auto;">
      <h2 class="section-title">Akses <span>Cepat</span> Portal</h2>
    </div>
    <div class="quicklink-grid">
      <a href="https://satudata.banyuwangikab.go.id" class="qlink" target="_blank" rel="noopener noreferrer">
        <div class="qlink-icon" style="background:#eff4ff;">
          <img src="/CVIDE/assets/img/satudata.png" alt="Satu Data">
        </div>
        <div class="qlink-label">Satu Data</div>
      </a>
      <a href="https://elkpi.banyuwangikab.go.id" class="qlink" target="_blank" rel="noopener noreferrer">
        <div class="qlink-icon" style="background:#fff7ed;">
          <img src="assets/img/elkpi.png" alt="E-LKPI">
        </div>
        <div class="qlink-label">E-LKPI</div>
      </a>
      <a href="https://sipd.banyuwangikab.go.id" class="qlink" target="_blank" rel="noopener noreferrer">
        <div class="qlink-icon" style="background:#f0fdf4;">
          <img src="assets/img/sipd.png" alt="SIPD">
        </div>
        <div class="qlink-label">SIPD</div>
      </a>
      <a href="https://gis.banyuwangikab.go.id" class="qlink" target="_blank" rel="noopener noreferrer">
        <div class="qlink-icon" style="background:#fdf4ff;">
          <img src="assets/img/gis.png" alt="GIS Banyuwangi">
        </div>
        <div class="qlink-label">GIS Banyuwangi</div>
      </a>
      <a href="https://emonitoring.banyuwangikab.go.id" class="qlink" target="_blank" rel="noopener noreferrer">
        <div class="qlink-icon" style="background:#eff4ff;">
          <img src="assets/img/emonitoring.png" alt="E-Monitoring">
        </div>
        <div class="qlink-label">E-Monitoring</div>
      </a>
      <a href="https://portal-asn.banyuwangikab.go.id" class="qlink" target="_blank" rel="noopener noreferrer">
        <div class="qlink-icon" style="background:#fff7ed;">
          <img src="assets/img/portal-asn.png" alt="Portal ASN">
        </div>
        <div class="qlink-label">Portal ASN</div>
      </a>
    </div>
  </div>
</section>

<!-- ===================================================
     CTA SECTION
     =================================================== -->
<section class="cta-section">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-text">
        <div class="section-eyebrow" style="background:rgba(255,255,255,0.12); border-color:rgba(255,255,255,0.2); color:rgba(255,255,255,0.85);">Sistem Manajemen Bersama</div>
        <h2 class="section-title" style="color:white;">Siap Mengoptimalkan<br>Kinerja Bappeda Anda?</h2>
        <p class="section-sub" style="color:rgba(255,255,255,0.7);">Masuk ke platform SMB dan nikmati kemudahan pengelolaan dokumen, printer, dan koordinasi antar bidang dalam satu dashboard terpadu.</p>
      </div>
      <div class="cta-actions">
        <button class="btn-cta" onclick="window.location.href='smb_bappeda_dashboard.html'">
          <svg viewBox="0 0 16 16" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h4a1 1 0 010 2H5v8h3a1 1 0 010 2H4a1 1 0 01-1-1V3zm9.293 2.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-2 2a1 1 0 01-1.414-1.414L13.586 8l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
          Masuk ke Sistem SMB
        </button>
        <button class="btn-cta-outline">
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="8" cy="8" r="7"/><path d="M8 5v3.5l2.5 1.5"/></svg>
          Panduan Penggunaan
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ===================================================
     FOOTER
     =================================================== -->
          <footer id="footer">
            <div class="container">
              <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo">
                      <div class="footer-logo">
            <div class="footer-logo-box">
              <img src="/CVIDE/assets/img/Bappeda.png" alt="Bappeda Banyuwangi">
            </div>
          </div>
            <div class="footer-logo-text">
              <div class="footer-logo-name">Bappeda Banyuwangi</div>
            </div>
          </div>
        <p class="footer-desc">Badan Perencanaan Pembangunan Daerah Kabupaten Banyuwangi — mendorong perencanaan pembangunan yang cerdas, inklusif, dan berbasis data untuk kesejahteraan masyarakat Banyuwangi.</p>
        <div class="footer-contact">
          <p><svg viewBox="0 0 14 14" fill="currentColor"><path d="M7 1C4.24 1 2 3.24 2 6c0 4.25 5 8 5 8s5-3.75 5-8c0-2.76-2.24-5-5-5zm0 6.5A1.5 1.5 0 115.5 6 1.5 1.5 0 017 7.5z"/></svg><span>Jl. Adi Sucipto No.2, Banyuwangi 68416</span></p>
          <p><svg viewBox="0 0 14 14" fill="currentColor"><path d="M11.5 9.5l-2-2a1 1 0 00-1.41 0l-.7.7A5.51 5.51 0 014.3 5.11l.7-.7a1 1 0 000-1.41l-2-2A1 1 0 001.59 1L1 1.59A3 3 0 001 5.5 12.5 12.5 0 008.5 13a3 3 0 003.91 0l.59-.59a1 1 0 000-1.41z"/></svg><span>(0333) 410082</span></p>
          <p><svg viewBox="0 0 14 14" fill="currentColor"><path d="M2 3a1 1 0 011-1h8a1 1 0 011 1v1.5L7 8 2 4.5V3zm0 2.5v5.5a1 1 0 001 1h8a1 1 0 001-1V5.5L7 9 2 5.5z"/></svg><span>bappeda@banyuwangikab.go.id</span></p>
        </div>
        <div class="sosmed">
          <div class="sosmed-btn" title="Facebook">
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M18 10a8 8 0 10-9.25 7.903V12.75H6.5V10h2.25V8.125c0-2.217 1.32-3.44 3.34-3.44.967 0 1.98.173 1.98.173V7H12.96c-1.1 0-1.44.683-1.44 1.384V10H14l-.5 2.75h-2V17.9A8.002 8.002 0 0018 10z"/></svg>
          </div>
          <div class="sosmed-btn" title="Instagram">
            <svg viewBox="0 0 20 20" fill="currentColor"><rect x="2" y="2" width="16" height="16" rx="4" fill="none" stroke="currentColor" stroke-width="1.5"/><circle cx="10" cy="10" r="3" fill="none" stroke="currentColor" stroke-width="1.5"/><circle cx="14.5" cy="5.5" r="1" fill="currentColor"/></svg>
          </div>
          <div class="sosmed-btn" title="Twitter/X">
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M16.5 3h2.5L13 8.7 20 17h-4.5l-3.6-4.7L7.5 17H5l6.3-7.3L4 3h4.6l3.3 4.3L16.5 3zm-.9 12.7h1.4L8.4 4.3H6.9L15.6 15.7z"/></svg>
          </div>
          <div class="sosmed-btn" title="YouTube">
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M18 5.5S17.75 4 17 3.25c-.75-.75-1.6-.76-2-.8C12.75 2.2 10 2.2 10 2.2s-2.75 0-5 .25c-.4.04-1.25.05-2 .8S2.2 5.5 2.2 5.5 2 7.05 2 8.6v1.4c0 1.55.2 3.1.2 3.1s.25 1.5 1 2.25c.75.75 1.75.73 2.2.8C6.85 16.4 10 16.4 10 16.4s2.75 0 5-.25c.4-.07 1.25-.05 2-.8s.8-2.25.8-2.25S18 11.55 18 10V8.6c0-1.55-.2-3.1-.2-3.1zM8.2 12.2V7.2l5.4 2.5-5.4 2.5z"/></svg>
          </div>
        </div>
      </div>
      <div>
        <div class="footer-col-title">Navigasi</div>
        <ul class="footer-links">
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Profil Bappeda</a></li>
          <li><a href="#">Visi & Misi</a></li>
          <li><a href="#">Struktur Organisasi</a></li>
          <li><a href="#">Bidang & Fungsi</a></li>
          <li><a href="#">Agenda Kegiatan</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Layanan</div>
        <ul class="footer-links">
          <li><a href="#">Sistem SMB</a></li>
          <li><a href="#">Satu Data Banyuwangi</a></li>
          <li><a href="#">E-Monitoring Pembangunan</a></li>
          <li><a href="#">SIPD</a></li>
          <li><a href="#">E-LKPI</a></li>
          <li><a href="#">Pengaduan Masyarakat</a></li>
        </ul>
      </div>
      <div>
        <div class="footer-col-title">Dokumen</div>
        <ul class="footer-links">
          <li><a href="#">RPJMD 2026–2031</a></li>
          <li><a href="#">RKPD 2026</a></li>
          <li><a href="#">Renstra 2025–2030</a></li>
          <li><a href="#">LKjIP 2025</a></li>
          <li><a href="#">Profil Daerah</a></li>
          <li><a href="#">Regulasi & Perda</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="footer-bottom-left">© 2026 Bappeda Kabupaten Banyuwangi. Hak cipta dilindungi undang-undang.</div>
      <div class="footer-bottom-right">
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Syarat Layanan</a>
        <a href="#">Aksesibilitas</a>
        <a href="#">Peta Situs</a>
      </div>
    </div>
  </div>
</footer>

<button class="back-top" id="back-top" onclick="window.scrollTo({top:0,behavior:'smooth'})">
  <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
</button>

<script>
/* HERO SLIDESHOW */
const slideContent = [
  { headline: 'Menuju Banyuwangi<br>yang <span class="accent">Cerdas & Maju</span>', sub: 'Sistem Manajemen Bersama (SMB) Bappeda Banyuwangi — platform terintegrasi untuk pengelolaan arsip dokumen, printer, dan koordinasi antar bidang.' },
  { headline: 'Perencanaan Berbasis<br><span class="accent">Data & Inovasi</span>', sub: 'Mendorong perencanaan pembangunan yang cerdas, transparan, dan partisipatif untuk kesejahteraan seluruh masyarakat Kabupaten Banyuwangi.' },
  { headline: 'Satu Platform<br><span class="accent">Satu Tujuan</span>', sub: 'Integrasikan seluruh bidang Bappeda dalam satu sistem manajemen yang efisien, aman, dan mudah digunakan oleh setiap ASN.' },
  { headline: 'Smart Government<br><span class="accent">Banyuwangi 2026</span>', sub: 'Mewujudkan tata kelola pemerintahan yang baik melalui digitalisasi layanan dan pengelolaan arsip dokumen yang profesional.' },
];
let currentSlide = 0;
let slideTimer;

function updateSlideContent(idx) {
  const h = document.getElementById('hero-headline');
  const s = document.getElementById('hero-sub');
  if (!s) {
    const newSub = document.createElement('div');
    newSub.id = 'hero-sub';
    newSub.className = 'hero-sub';
    h.parentNode.insertBefore(newSub, h.nextSibling);
  }
  const subEl = document.getElementById('hero-sub') || (() => { const el = document.createElement('div'); el.id = 'hero-sub'; el.className = 'hero-sub'; h.parentNode.insertBefore(el, h.nextSibling); return el; })();
  h.style.opacity = '0'; h.style.transform = 'translateY(10px)';
  subEl.style.opacity = '0';
  setTimeout(() => {
    h.innerHTML = slideContent[idx].headline;
    subEl.textContent = slideContent[idx].sub;
    h.style.transition = 'all 0.6s ease';
    subEl.style.transition = 'all 0.6s 0.1s ease';
    h.style.opacity = '1'; h.style.transform = 'none';
    subEl.style.opacity = '1';
  }, 300);
}

function goSlide(idx) {
  document.querySelectorAll('.hero-slide').forEach((s, i) => {
    s.classList.toggle('active', i === idx);
  });
  document.querySelectorAll('.hero-dot').forEach((d, i) => {
    d.classList.toggle('active', i === idx);
  });
  updateSlideContent(idx);
  currentSlide = idx;
}

function changeSlide(dir) {
  const total = document.querySelectorAll('.hero-slide').length;
  const next = (currentSlide + dir + total) % total;
  goSlide(next);
  resetTimer();
}

function resetTimer() {
  clearInterval(slideTimer);
  slideTimer = setInterval(() => changeSlide(1), 5500);
}

slideTimer = setInterval(() => changeSlide(1), 5500);

/* NAVBAR SCROLL */
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 60);
  document.getElementById('back-top').classList.toggle('show', window.scrollY > 400);
});

/* COUNTER ANIMATION */
function animateCounter(el, target, suffix) {
  let start = 0;
  const duration = 2200;
  const step = 16;
  const increment = target / (duration / step);
  const timer = setInterval(() => {
    start = Math.min(start + increment, target);
    el.textContent = Math.floor(start).toLocaleString('id') + (suffix || '');
    if (start >= target) clearInterval(timer);
  }, step);
}

const counters = [
  { id: 'cnt-users', target: 60, suffix: '' },
  { id: 'cnt-docs', target: 2190, suffix: '' },
  { id: 'cnt-programs', target: 48, suffix: '' },
  { id: 'cnt-bidang', target: 4, suffix: '' },
];

const statsBar = document.querySelector('.stats-bar');
let counted = false;
const io = new IntersectionObserver(entries => {
  if (entries[0].isIntersecting && !counted) {
    counted = true;
    counters.forEach(c => {
      const el = document.getElementById(c.id);
      if (el) animateCounter(el, c.target, c.suffix);
    });
  }
}, { threshold: 0.3 });
io.observe(statsBar);

/* SMOOTH NAV */
document.querySelectorAll('.nav-links a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    e.preventDefault();
    const target = document.querySelector(a.getAttribute('href'));
    if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });
});

/* ACTIVE NAV ON SCROLL */
const sections = document.querySelectorAll('section[id]');
window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(s => {
    if (window.scrollY >= s.offsetTop - 120) current = s.id;
  });
  document.querySelectorAll('.nav-links a').forEach(a => {
    a.classList.toggle('active', a.getAttribute('href') === '#' + current || (current === '' && a.getAttribute('href') === '#'));
  });
});

/* OPTIONAL: Active menu saat scroll (tanpa mengubah transparansi navbar) */
window.addEventListener('scroll', function() {
  const sections = document.querySelectorAll('section');
  const navLinks = document.querySelectorAll('.nav-links a');
  
  let current = '';
  sections.forEach(section => {
    const sectionTop = section.offsetTop - 150;
    if (window.scrollY >= sectionTop) {
      current = section.getAttribute('id');
    }
  });

  navLinks.forEach(link => {
    link.classList.remove('active');
    if (link.getAttribute('href') === '#' + current) {
      link.classList.add('active');
    }
  });
});
</script>
</body>
</html>