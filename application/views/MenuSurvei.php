<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes" name="viewport">
  <title><?= $title ?? 'Menu Survei IKM | IDE Consultant' ?></title>
  <meta content="Layanan survei indeks kepuasan masyarakat (IKM) profesional oleh CV Inti Desain Ekonomi Consultant" name="description">
  <meta content="survei, ikm, kepuasan masyarakat, pelayanan publik, riset kebijakan, ide consultant" name="keywords">
  
  <!-- Google Fonts: Poppins (Lugx signature font) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    /* ==========================================================================
       LUGX GAMING DESIGN SYSTEM TEMPLATE (Adapted for IDE Consultant)
       Page: Menu Survei IKM
       ========================================================================== */
    :root {
      --lugx-blue: #043168ff;
      --lugx-blue-dark: #0b3977ff;
      --lugx-red: #b40814ff;
      --lugx-red-hover: #b00a15ff;
      --lugx-dark: #1e1e1e;
      --lugx-dark-card: #27292a;
      --lugx-gray: #7a7a7a;
      --lugx-light-gray: #f7f7f7;
      --lugx-border: #e7e7e7;
      --lugx-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);
      --lugx-radius: 25px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
      line-height: 1.6;
      color: #1e1e1e;
      background: #ffffff;
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
      transition: all 0.3s ease;
    }

    /* ==========================================================================
       HEADER & NAVIGATION (Lugx Curved Top Bar & Sticky Nav)
       ========================================================================== */
    .header-area {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      background-color: var(--lugx-blue);
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
      border-bottom-left-radius: 30px;
      border-bottom-right-radius: 30px;
      transition: all 0.3s ease-in-out;
    }

    .main-nav {
      max-width: 100%;
      margin: 0 auto;
      padding: 15px 45px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 90px;
    }

    .logo {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      height: 40px;
    }

    .logo img {
      height: 40px;
      width: auto;
      max-height: 40px;
      object-fit: contain;
      box-shadow: none;
      border: none;
      padding: 0;
      display: block;
      transition: transform 0.3s ease;
    }

    .logo img:hover {
      transform: scale(1.04);
    }

    .logo-text {
      font-size: 20px;
      font-weight: 800;
      color: #ffffff;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      line-height: 1;
      display: inline-flex;
      align-items: center;
      margin: 0;
      transform: translateY(3px);
    }

    .logo-text span {
      color: var(--lugx-red);
      margin-left: 4px;
    }

    /* Navigation Links */
    .nav-menu {
      display: flex;
      align-items: center;
      list-style: none;
      gap: 30px;
      margin-left: auto;
    }

    .nav-menu li {
      position: relative;
    }

    .nav-menu a.nav-item-link {
      color: #ffffff;
      font-size: 15px;
      font-weight: 500;
      padding: 10px 15px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .nav-menu a.nav-item-link:hover,
    .nav-menu a.nav-item-link.active {
      background-color: rgba(255, 255, 255, 0.15);
      color: #ffffff;
    }

    /* Red Action Button for Sign In (Lugx Signature) */
    .main-button a {
      display: inline-block;
      background-color: var(--lugx-red);
      color: #ffffff !important;
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      padding: 12px 30px !important;
      border-radius: 25px;
      letter-spacing: 0.5px;
      box-shadow: 0px 5px 15px rgba(238, 98, 107, 0.4);
      transition: all 0.3s ease;
    }

    .main-button a:hover {
      background-color: var(--lugx-red-hover) !important;
      transform: translateY(-2px);
      box-shadow: 0px 8px 20px rgba(238, 98, 107, 0.6);
    }

    /* Mega Dropdown */
    .dropdown {
      position: relative;
    }

    .dropdown-content.mega-dropdown {
      position: absolute;
      top: 100%;
      left: 50%;
      transform: translateX(-50%) translateY(8px);
      background: #ffffff;
      min-width: 340px;
      max-width: 500px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.18);
      border-radius: 20px;
      margin-top: 12px;
      z-index: 1000;
      padding: 24px;
      border-top: 4px solid var(--lugx-red);
      
      visibility: hidden;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s ease;
      transition-delay: 0.15s;
    }

    .dropdown-content.mega-dropdown::before {
      content: '';
      position: absolute;
      top: -18px;
      left: 0;
      width: 100%;
      height: 18px;
      background: transparent;
    }

    .dropdown:hover .dropdown-content.mega-dropdown,
    .dropdown-content.mega-dropdown:hover {
      visibility: visible;
      opacity: 1;
      pointer-events: auto;
      transform: translateX(-50%) translateY(0);
      transition-delay: 0s;
    }

    .mega-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 16px;
    }

    .mega-heading {
      font-size: 16px;
      font-weight: 700;
      color: var(--lugx-blue);
      margin-bottom: 8px;
      border-bottom: 2px solid var(--lugx-light-gray);
      padding-bottom: 6px;
    }

    .mega-column a {
      display: block;
      color: var(--lugx-dark);
      font-weight: 600;
      font-size: 14px;
      padding: 6px 0;
      transition: color 0.2s ease;
    }

    .mega-column a:hover {
      color: var(--lugx-red);
      padding-left: 5px;
    }

    .mega-desc {
      font-size: 12px;
      color: var(--lugx-gray);
      margin-bottom: 12px;
      line-height: 1.4;
    }

    /* Mobile Toggle */
    .menu-toggle {
      display: none;
      width: 44px;
      height: 44px;
      border: none;
      background: rgba(255, 255, 255, 0.2);
      color: #ffffff;
      font-size: 22px;
      cursor: pointer;
      border-radius: 50%;
      align-items: center;
      justify-content: center;
    }

    /* Mobile Nav Overlay */
    .mobile-nav-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.6);
      backdrop-filter: blur(4px);
      z-index: 1001;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .mobile-nav-overlay.active {
      display: block;
      opacity: 1;
    }

    .mobile-nav {
      position: fixed;
      top: 0;
      right: -100%;
      width: 85%;
      max-width: 360px;
      height: 100vh;
      background: #ffffff;
      z-index: 1002;
      padding: 80px 24px 30px;
      overflow-y: auto;
      transition: right 0.3s ease;
      box-shadow: -5px 0 25px rgba(0,0,0,0.2);
    }

    .mobile-nav.active {
      right: 0;
    }

    .mobile-nav .dropbtn {
      width: 100%;
      text-align: left;
      background: none;
      border: none;
      font-size: 16px;
      font-weight: 600;
      color: var(--lugx-dark);
      padding: 12px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      border-bottom: 1px solid var(--lugx-border);
    }

    .mobile-nav .dropdown-content {
      display: none;
      background: var(--lugx-light-gray);
      border-radius: 12px;
      padding: 16px;
      margin-top: 8px;
    }

    .mobile-nav .dropdown-content.show-dropdown {
      display: block;
    }

    .mobile-nav .dropdown-content a {
      display: block;
      color: var(--lugx-dark);
      font-weight: 600;
      font-size: 14px;
      padding: 8px 0;
    }

    .mobile-nav .dropdown-content a:hover {
      color: var(--lugx-red);
      padding-left: 5px;
    }

    /* ==========================================================================
       SUBPAGE HERO BANNER (Lugx Curved Red-Navy Gradient & Animated Doodles)
       ========================================================================== */
    .subpage-banner {
      background: linear-gradient(135deg, rgba(180, 8, 20, 0.95) 0%, rgba(4, 49, 104, 0.96) 50%, rgba(8, 35, 75, 0.98) 100%);
      border-bottom-right-radius: 150px;
      border-bottom-left-radius: 150px;
      padding: 175px 0 115px 0;
      position: relative;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(4, 49, 104, 0.35);
      text-align: center;
    }

    .subpage-banner::before {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      width: 100%;
      height: 100%;
      background: url('<?= base_url("assets/img/background/IDE 2.0.webp") ?>') no-repeat center center/cover;
      opacity: 0.14;
      pointer-events: none;
      z-index: 0;
    }

    .subpage-banner::after {
      content: '';
      position: absolute;
      top: -20%;
      left: -10%;
      width: 550px;
      height: 550px;
      background: radial-gradient(circle, rgba(238, 98, 107, 0.45) 0%, rgba(180, 8, 20, 0.25) 45%, transparent 75%);
      filter: blur(50px);
      animation: pulseRedGlow 6s ease-in-out infinite alternate;
      pointer-events: none;
      z-index: 1;
    }

    @keyframes pulseRedGlow {
      0% { transform: scale(1) translate(0, 0); opacity: 0.7; }
      100% { transform: scale(1.15) translate(25px, 20px); opacity: 1; }
    }

    .cta-doodle {
      position: absolute;
      color: rgba(255, 255, 255, 0.16);
      pointer-events: none;
      z-index: 1;
      animation: floatDoodleIcon 5s ease-in-out infinite alternate;
      filter: drop-shadow(0 4px 10px rgba(0,0,0,0.25));
    }

    .cta-doodle.doodle-1 { top: 50px; left: 60px; font-size: 44px; animation-delay: 0s; }
    .cta-doodle.doodle-2 { bottom: 40px; left: 100px; font-size: 38px; animation-delay: 1.2s; }
    .cta-doodle.doodle-3 { top: 60px; right: 80px; font-size: 42px; animation-delay: 2.4s; }
    .cta-doodle.doodle-4 { bottom: 45px; right: 90px; font-size: 46px; animation-delay: 0.8s; }
    .cta-doodle.doodle-5 { top: 140px; left: 200px; font-size: 32px; animation-delay: 2s; }
    .cta-doodle.doodle-6 { top: 150px; right: 210px; font-size: 34px; animation-delay: 1.5s; }

    @keyframes floatDoodleIcon {
      0% { transform: translateY(0px) rotate(0deg) scale(1); opacity: 0.15; }
      50% { transform: translateY(-12px) rotate(8deg) scale(1.08); opacity: 0.28; }
      100% { transform: translateY(-20px) rotate(-6deg) scale(1.15); opacity: 0.38; }
    }

    .banner-container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 30px;
      position: relative;
      z-index: 2;
    }

    .subpage-banner h1 {
      font-size: 46px;
      font-weight: 800;
      color: #ffffff;
      text-transform: uppercase;
      line-height: 1.25;
      margin-bottom: 16px;
      text-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }

    .subpage-banner h1 span {
      color: #ff6b75;
      text-shadow: 0 0 25px rgba(255, 107, 117, 0.6);
    }

    .subpage-banner p.lead-text {
      color: rgba(255, 255, 255, 0.92);
      font-size: 16px;
      max-width: 760px;
      margin: 0 auto 40px;
      line-height: 1.7;
    }

    /* Stats strip */
    .hero-stats-strip {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
      max-width: 860px;
      margin: 0 auto;
    }

    .hero-stat-box {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.25);
      border-radius: 20px;
      padding: 18px 14px;
      transition: all 0.3s ease;
    }

    .hero-stat-box:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-4px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .hero-stat-val {
      font-size: 24px;
      font-weight: 800;
      color: #ffffff;
      display: block;
      line-height: 1.1;
      margin-bottom: 4px;
    }

    .hero-stat-lbl {
      font-size: 11px;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.85);
      font-weight: 600;
    }

    /* ==========================================================================
       SECTION HEADINGS (Lugx Subtitle Tag + Big Title)
       ========================================================================== */
    .section-heading {
      text-align: center;
      margin-bottom: 45px;
    }

    .section-heading .subtitle {
      color: var(--lugx-red);
      font-size: 15px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      display: block;
      margin-bottom: 10px;
    }

    .section-heading h2 {
      font-size: 36px;
      font-weight: 800;
      color: var(--lugx-dark);
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .section-heading p {
      color: var(--lugx-gray);
      font-size: 15px;
      max-width: 680px;
      margin: 12px auto 0;
      line-height: 1.6;
    }

    /* ==========================================================================
       SURVEY CONTENT & FILTER SECTION
       ========================================================================== */
    .survey-content {
      padding: 90px 0 60px 0;
      background-color: #ffffff;
    }

    .survey-content-inner {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 30px;
    }

    /* Modern Filter Card */
    .filter-section-lugx {
      background: var(--lugx-light-gray);
      border-radius: var(--lugx-radius);
      border: 1px solid #e2e8f0;
      padding: 30px;
      margin-bottom: 45px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }

    .filter-section-lugx h4 {
      font-size: 15px;
      font-weight: 800;
      color: var(--lugx-blue);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 18px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .filter-grid-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .filter-group-lugx {
      display: flex;
      flex-direction: column;
    }

    .filter-group-lugx label {
      font-size: 12px;
      font-weight: 700;
      color: var(--lugx-dark);
      text-transform: uppercase;
      letter-spacing: 0.4px;
      margin-bottom: 8px;
    }

    .filter-select-custom {
      width: 100%;
      height: 48px;
      border-radius: 24px;
      border: 2px solid #cbd5e1;
      padding: 0 20px;
      font-size: 13.5px;
      font-weight: 600;
      color: var(--lugx-dark);
      font-family: inherit;
      background-color: #ffffff;
      outline: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .filter-select-custom:focus {
      border-color: var(--lugx-blue);
      box-shadow: 0 0 0 3px rgba(4, 49, 104, 0.15);
    }

    /* Survey Grid & Cards */
    .survey-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
      gap: 30px;
    }

    .survey-card {
      background-color: #ffffff;
      border-radius: var(--lugx-radius);
      border: 1px solid #e2e8f0;
      box-shadow: 0 10px 30px rgba(4, 49, 104, 0.08);
      padding: 34px 28px;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow: hidden;
      transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .survey-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -120%;
      width: 60%;
      height: 100%;
      background: linear-gradient(to right, transparent, rgba(4, 49, 104, 0.05), transparent);
      transform: skewX(-25deg);
      transition: all 0.75s ease;
      z-index: 1;
      pointer-events: none;
    }

    .survey-card:hover::before {
      left: 160%;
    }

    .survey-card:hover {
      transform: translateY(-8px);
      border-color: var(--lugx-red);
      box-shadow: 0 20px 45px rgba(4, 49, 104, 0.16);
    }

    .card-header-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
      position: relative;
      z-index: 2;
    }

    .card-icon {
      width: 52px;
      height: 52px;
      border-radius: 16px;
      background: linear-gradient(135deg, var(--lugx-blue) 0%, #0d4f9b 100%);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      box-shadow: 0 6px 16px rgba(4, 49, 104, 0.25);
      transition: all 0.35s ease;
    }

    .card-icon svg {
      width: 24px;
      height: 24px;
      color: #ffffff;
      stroke-width: 2;
    }

    .survey-card:hover .card-icon {
      background: var(--lugx-red);
      transform: scale(1.08) rotate(4deg);
      box-shadow: 0 8px 20px rgba(180, 8, 20, 0.35);
    }

    .card-status {
      font-size: 11px;
      font-weight: 800;
      padding: 6px 14px;
      border-radius: 20px;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .status-active {
      background-color: rgba(16, 185, 129, 0.1);
      color: #059669;
      border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-inactive {
      background-color: rgba(220, 38, 38, 0.08);
      color: #dc2626;
      border: 1px solid rgba(220, 38, 38, 0.2);
    }

    .card-title {
      font-size: 18px;
      font-weight: 800;
      color: var(--lugx-dark);
      margin-bottom: 20px;
      line-height: 1.4;
      text-transform: uppercase;
      transition: color 0.3s ease;
      position: relative;
      z-index: 2;
    }

    .survey-card:hover .card-title {
      color: var(--lugx-red);
    }

    .card-meta {
      background: var(--lugx-light-gray);
      border: 1px solid #edf2f7;
      border-radius: 18px;
      padding: 16px 20px;
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 24px;
      position: relative;
      z-index: 2;
    }

    .meta-row {
      display: grid;
      grid-template-columns: 120px 14px 1fr;
      align-items: baseline;
    }

    .meta-label {
      font-size: 11px;
      font-weight: 700;
      color: var(--lugx-blue);
      text-transform: uppercase;
      letter-spacing: 0.4px;
    }

    .meta-colon {
      color: #94a3b8;
      font-weight: 700;
      text-align: center;
    }

    .meta-value {
      font-size: 12.5px;
      font-weight: 600;
      color: var(--lugx-dark);
      word-break: break-word;
    }

    .card-actions {
      display: flex;
      gap: 12px;
      margin-top: auto;
      position: relative;
      z-index: 2;
    }

    .btn-action-fill {
      flex: 1;
      height: 46px;
      border-radius: 23px;
      background-color: var(--lugx-red);
      color: #ffffff;
      font-size: 13px;
      font-weight: 700;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(180, 8, 20, 0.35);
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    .btn-action-fill:hover {
      background-color: var(--lugx-red-hover);
      transform: translateY(-2px);
      box-shadow: 0 8px 18px rgba(180, 8, 20, 0.5);
    }

    .btn-action-demo {
      flex: 1;
      height: 46px;
      border-radius: 23px;
      background: #ffffff;
      color: var(--lugx-blue);
      border: 2px solid var(--lugx-blue);
      font-size: 13px;
      font-weight: 700;
      text-transform: uppercase;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    .btn-action-demo:hover {
      background: var(--lugx-blue);
      color: #ffffff;
      transform: translateY(-2px);
    }

    /* Login Status Badge Fixed on Top */
    .login-status-badge {
      position: fixed;
      top: 105px;
      right: 30px;
      z-index: 999;
      background: linear-gradient(135deg, #043168 0%, #0d4f9b 100%);
      color: #ffffff;
      padding: 8px 20px;
      border-radius: 30px;
      font-size: 13px;
      font-weight: 600;
      box-shadow: 0 8px 24px rgba(4, 49, 104, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.2);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .level-badge {
      background: var(--lugx-red);
      color: #ffffff;
      padding: 3px 10px;
      border-radius: 12px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
    }

    .logout-link {
      color: rgba(255, 255, 255, 0.85);
      margin-left: 6px;
      transition: color 0.2s ease;
      font-size: 14px;
    }

    .logout-link:hover {
      color: #ff6b75;
    }

    /* Login Prompt Modal */
    .login-prompt-modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.7);
      backdrop-filter: blur(6px);
      z-index: 2001;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-prompt-modal.active {
      display: flex;
    }

    .login-prompt-content {
      background: #ffffff;
      border-radius: 28px;
      width: 100%;
      max-width: 420px;
      padding: 40px 32px;
      text-align: center;
      box-shadow: 0 25px 60px rgba(0,0,0,0.35);
      border: 1px solid #e2e8f0;
      animation: popIn 0.3s ease;
    }

    @keyframes popIn {
      0% { transform: scale(0.9); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }

    .prompt-icon-wrap {
      width: 65px;
      height: 65px;
      border-radius: 50%;
      background: rgba(180, 8, 20, 0.1);
      color: var(--lugx-red);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      margin: 0 auto 20px auto;
    }

    .login-prompt-content h3 {
      font-size: 22px;
      font-weight: 800;
      color: var(--lugx-dark);
      margin-bottom: 10px;
      text-transform: uppercase;
    }

    .login-prompt-content p {
      color: var(--lugx-gray);
      font-size: 14px;
      line-height: 1.6;
      margin-bottom: 28px;
    }

    .login-prompt-actions {
      display: flex;
      gap: 12px;
      justify-content: center;
    }

    .login-prompt-btn {
      flex: 1;
      height: 48px;
      border-radius: 24px;
      font-size: 13.5px;
      font-weight: 700;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .login-prompt-btn.primary {
      background-color: var(--lugx-red);
      color: #ffffff;
      box-shadow: 0 6px 16px rgba(180, 8, 20, 0.35);
    }

    .login-prompt-btn.primary:hover {
      background-color: var(--lugx-red-hover);
      transform: translateY(-2px);
    }

    .login-prompt-btn.secondary {
      background: var(--lugx-light-gray);
      color: var(--lugx-dark);
      border: 1px solid #cbd5e1;
    }

    .login-prompt-btn.secondary:hover {
      background: #e2e8f0;
      transform: translateY(-2px);
    }

    /* ==========================================================================
       FOOTER & CONTACT SECTION (Lugx Navy Gradient Footer)
       ========================================================================== */
    .footer-area {
      background: linear-gradient(135deg, #043168 0%, #0a3d7c 50%, #082852 100%);
      color: #ffffff;
      padding: 90px 0 30px 0;
      border-top-left-radius: 120px;
      border-top-right-radius: 120px;
      position: relative;
      box-shadow: 0 -10px 30px rgba(4, 49, 104, 0.3);
    }

    .footer-container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 0 30px;
    }

    .footer-grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr;
      gap: 50px;
      margin-bottom: 60px;
    }

    .footer-about h3,
    .footer-col h3 {
      font-size: 20px;
      font-weight: 700;
      color: #ffffff;
      text-transform: uppercase;
      margin-bottom: 25px;
      position: relative;
    }

    .footer-about h3::after,
    .footer-col h3::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 40px;
      height: 3px;
      background-color: var(--lugx-red);
    }

    .footer-about p {
      color: #ffffff;
      font-size: 14px;
      line-height: 1.8;
      margin-bottom: 20px;
      opacity: 0.95;
    }

    .social-icons {
      display: flex;
      gap: 12px;
    }

    .social-icon-btn {
      width: 40px;
      height: 40px;
      background-color: rgba(255,255,255,0.15);
      color: #ffffff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .social-icon-btn:hover {
      background-color: var(--lugx-red);
      transform: translateY(-3px);
      color: #ffffff;
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 12px;
    }

    .footer-links a {
      color: #ffffff;
      font-size: 14px;
      opacity: 0.95;
      transition: all 0.3s ease;
    }

    .footer-links a:hover {
      color: #ff6b75;
      opacity: 1;
      padding-left: 5px;
    }

    .copyright {
      border-top: 1px solid rgba(255,255,255,0.2);
      padding-top: 30px;
      text-align: center;
      font-size: 14px;
      color: #ffffff;
      opacity: 0.9;
    }

    /* Floating WhatsApp Button */
    .whatsapp-float {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 60px;
      height: 60px;
      background-color: #25d366;
      color: #ffffff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 32px;
      box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
      z-index: 999;
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      text-decoration: none;
    }

    .whatsapp-float:hover {
      transform: scale(1.1) translateY(-4px);
      box-shadow: 0 15px 30px rgba(37, 211, 102, 0.6);
      color: #ffffff;
      background-color: #128c7e;
    }

    /* ==========================================================================
       SIGN IN MODAL (Lugx 2-Column Split Modal)
       ========================================================================== */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(5px);
      z-index: 2000;
      align-items: center;
      justify-content: center;
      padding: 20px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .modal.active {
      display: flex;
      opacity: 1;
    }

    .modal-content-split {
      background-color: #ffffff;
      max-width: 940px !important;
      width: 100%;
      border-radius: 28px !important;
      padding: 0 !important;
      overflow: hidden !important;
      box-shadow: 0 35px 80px rgba(4, 49, 104, 0.5) !important;
      border: 1px solid rgba(255, 255, 255, 0.2);
      transform: scale(0.9);
      transition: transform 0.3s ease;
    }

    .modal.active .modal-content-split {
      transform: scale(1);
    }

    .login-modal-grid {
      display: grid;
      grid-template-columns: 1.1fr 1fr;
      min-height: 520px;
    }

    .login-banner-side {
      background: linear-gradient(135deg, rgba(4, 49, 104, 0.90) 0%, rgba(10, 61, 124, 0.85) 60%, rgba(180, 8, 20, 0.82) 100%), url('<?= base_url("assets/img/background/IDE 2.0.webp") ?>') right center / cover no-repeat;
      padding: 45px 35px;
      color: #ffffff;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
      overflow: hidden;
    }

    .login-banner-side::before {
      content: '';
      position: absolute;
      top: -30%;
      right: -20%;
      width: 350px;
      height: 350px;
      background: radial-gradient(circle, rgba(238, 98, 107, 0.45) 0%, transparent 70%);
      filter: blur(35px);
      pointer-events: none;
    }

    .login-doodle {
      position: absolute;
      color: rgba(255, 255, 255, 0.18);
      pointer-events: none;
      z-index: 1;
      animation: floatLoginDoodle 5s ease-in-out infinite alternate;
      filter: drop-shadow(0 4px 10px rgba(0,0,0,0.25));
    }

    .login-doodle.doodle-1 { top: 25px; left: 35px; font-size: 38px; animation-delay: 0s; }
    .login-doodle.doodle-2 { bottom: 30px; left: 45px; font-size: 34px; animation-delay: 1.2s; }
    .login-doodle.doodle-3 { top: 30px; right: 40px; font-size: 36px; animation-delay: 2.4s; }
    .login-doodle.doodle-4 { bottom: 25px; right: 35px; font-size: 40px; animation-delay: 0.8s; }
    .login-doodle.doodle-5 { top: 120px; left: 160px; font-size: 28px; animation-delay: 2s; }
    .login-doodle.doodle-6 { bottom: 90px; right: 150px; font-size: 30px; animation-delay: 3.2s; }

    @keyframes floatLoginDoodle {
      0% { transform: translateY(0px) rotate(0deg) scale(1); opacity: 0.15; }
      50% { transform: translateY(-10px) rotate(8deg) scale(1.08); opacity: 0.28; }
      100% { transform: translateY(-18px) rotate(-6deg) scale(1.15); opacity: 0.38; }
    }

    .login-brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .login-brand img {
      height: 42px;
      width: auto;
      object-fit: contain;
    }

    .login-brand-text {
      font-size: 16px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #ffffff;
      line-height: 1;
      display: inline-flex;
      align-items: center;
      transform: translateY(3px);
    }

    .login-brand-text span {
      color: var(--lugx-red);
      margin-left: 4px;
    }

    .login-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.25);
      color: #ffffff;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      padding: 5px 14px;
      border-radius: 15px;
      margin-bottom: 18px;
    }

    .login-banner-center h2 {
      font-size: 28px;
      font-weight: 800;
      color: #ffffff;
      line-height: 1.3;
      margin-bottom: 14px;
      text-transform: uppercase;
    }

    .login-banner-center p {
      font-size: 14px;
      color: rgba(255, 255, 255, 0.88);
      line-height: 1.7;
      margin: 0;
    }

    .login-form-side {
      background: #ffffff;
      padding: 40px 40px 35px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      position: relative;
    }

    .modal-close-dark {
      position: absolute;
      top: 20px;
      right: 20px;
      background: #f1f5f9;
      border: none;
      color: var(--lugx-dark);
      font-size: 22px;
      cursor: pointer;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
      line-height: 1;
      z-index: 10;
    }

    .modal-close-dark:hover {
      background-color: var(--lugx-red);
      color: #ffffff;
    }

    .login-form-header {
      margin-bottom: 24px;
      padding-right: 35px;
    }

    .login-form-header h3 {
      font-size: 24px;
      font-weight: 800;
      color: var(--lugx-dark);
      margin-bottom: 6px;
      text-transform: uppercase;
    }

    .login-subtext {
      font-size: 13px;
      color: var(--lugx-gray);
      margin: 0;
    }

    .form-group-custom {
      margin-bottom: 22px;
    }

    .form-label-custom {
      display: block;
      font-size: 13px;
      font-weight: 700;
      color: var(--lugx-dark);
      margin-bottom: 8px;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .input-icon-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-icon {
      position: absolute;
      left: 18px;
      color: #94a3b8;
      font-size: 15px;
      transition: color 0.3s ease;
    }

    .form-input-custom {
      width: 100%;
      height: 50px;
      border-radius: 25px;
      border: 2px solid #e2e8f0;
      padding: 0 20px 0 48px;
      font-size: 14px;
      font-family: inherit;
      outline: none;
      transition: all 0.3s ease;
      background-color: #f8fafc;
    }

    .form-input-custom:focus {
      border-color: var(--lugx-blue);
      background-color: #ffffff;
      box-shadow: 0 0 0 4px rgba(4, 49, 104, 0.1);
    }

    .input-icon-wrapper:focus-within .input-icon {
      color: var(--lugx-blue);
    }

    .btn-login-large {
      width: 100%;
      height: 52px;
      border-radius: 26px;
      background-color: var(--lugx-red);
      color: #ffffff;
      font-size: 15px;
      font-weight: 700;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      box-shadow: 0 10px 25px rgba(180, 8, 20, 0.35);
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-top: 10px;
    }

    .btn-login-large:hover {
      background-color: var(--lugx-red-hover);
      transform: translateY(-2px);
      box-shadow: 0 15px 30px rgba(180, 8, 20, 0.5);
    }

    /* ==========================================================================
       RESPONSIVE BREAKPOINTS
       ========================================================================== */
    @media (max-width: 992px) {
      .filter-grid-row {
        grid-template-columns: 1fr;
      }
      .footer-grid {
        grid-template-columns: 1fr;
        gap: 40px;
      }
      .subpage-banner h1 {
        font-size: 36px;
      }
      .hero-stats-strip {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .main-nav {
        padding: 15px 25px;
      }
      .nav-menu {
        display: none;
      }
      .menu-toggle {
        display: flex;
      }
      .survey-grid {
        grid-template-columns: 1fr;
      }
      .hero-stats-strip {
        grid-template-columns: 1fr 1fr;
      }
      .subpage-banner {
        border-bottom-right-radius: 80px;
        border-bottom-left-radius: 80px;
        padding: 140px 0 90px 0;
      }
      .subpage-banner h1 {
        font-size: 28px;
      }
      .login-modal-grid {
        grid-template-columns: 1fr;
      }
      .login-banner-side {
        display: none;
      }
      .login-form-side {
        padding: 30px 20px;
      }
      .footer-area {
        border-top-left-radius: 60px;
        border-top-right-radius: 60px;
      }
      .login-status-badge {
        top: 90px;
        right: 15px;
        left: 15px;
        justify-content: center;
      }
      .whatsapp-float {
        width: 50px;
        height: 50px;
        bottom: 20px;
        right: 20px;
        font-size: 26px;
      }
    }
  </style>
</head>

<body>
<?php
// Session user check
$isLoggedIn = isset($isLoggedIn) ? $isLoggedIn : false;
$userLevel = isset($userLevel) ? $userLevel : 0;
$userName = isset($userName) ? $userName : 'User';
?>

<!-- Login Status Badge (Active Session) -->
<?php if ($isLoggedIn): ?>
<div class="login-status-badge">
    <i class="fa-solid fa-circle-user" style="font-size: 16px;"></i> 
    <span><?= $userName ?></span>
    <span class="level-badge">
        <?php 
            if($userLevel == 1) echo 'Superadmin';
            elseif($userLevel == 2) echo 'Admin';
            elseif($userLevel == 3) echo 'Staf';
            elseif($userLevel == 4) echo 'Surveiyor';
            else echo 'Pengunjung';
        ?>
    </span>
    <a href="#" onclick="logout(); return false;" class="logout-link" title="Logout">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
    </a>
</div>
<?php endif; ?>

  <!-- HEADER & NAVIGATION -->
  <header class="header-area">
    <nav class="main-nav">
      <a href="<?= base_url() ?>" class="logo">
        <img src="<?= base_url('assets/img/LOGO IDE.webp') ?>" alt="IDE Consultant Logo">
        <div class="logo-text">Inti Desain Ekonomi <span> Consultant</span></div>
      </a>

      <!-- Desktop Navigation Menu -->
      <ul class="nav-menu">
        <li class="dropdown">
          <a href="<?= base_url('#about') ?>" class="nav-item-link">Tentang <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
          <div class="dropdown-content mega-dropdown">
            <div class="mega-grid">
              <div class="mega-column">
                <h4 class="mega-heading">Profil Perusahaan</h4>
                <a href="<?= base_url('#about') ?>">Sejarah & Visi Misi</a>
                <p class="mega-desc">Inti Desain Ekonomi Consultant berdiri sejak 2015 dengan fokus pada solusi ekonomi berkelanjutan.</p>
                <h4 class="mega-heading">Legal & Sertifikasi</h4>
                <a href="<?= base_url('legalitas') ?>">Sertifikasi & Izin Usaha</a>
                <p class="mega-desc">Terdaftar resmi dan bekerja sama dengan lembaga terkemuka di Indonesia.</p>
              </div>
              <div class="mega-column">
                <h4 class="mega-heading">Lokasi & Kontak</h4>
                <a href="https://www.google.com/maps/search/?api=1&query=-7.929581,112.640292" target="_blank">Kantor Malang</a>
                <p class="mega-desc">Berbasis di Malang, siap melayani seluruh Indonesia.</p>
              </div>
            </div>
          </div>
        </li>

        <li class="dropdown">
          <a href="<?= base_url('#services') ?>" class="nav-item-link active">Layanan <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
          <div class="dropdown-content mega-dropdown">
            <div class="mega-grid">
              <div class="mega-column">
                <h4 class="mega-heading">Konsultasi</h4>
                <a href="<?= base_url('#services') ?>">Konsultasi Ekonomi</a>
                <p class="mega-desc">Pendampingan strategis berbasis data ekonomi.</p>
                <h4 class="mega-heading">Survei & Penelitian</h4>
                <a href="<?= base_url('MenuSurvei') ?>" style="color: var(--lugx-red); font-weight: 700;">Survei Kepuasan Masyarakat (Aktif)</a>
                <p class="mega-desc">Metode ilmiah dengan analisis mendalam.</p>
                <h4 class="mega-heading">MasterData</h4>
                <a href="<?= base_url('MasterData') ?>">Repositori Data</a>
              </div>
            </div>
          </div>
        </li>

        <li class="dropdown">
          <a href="<?= base_url('#portfolio') ?>" class="nav-item-link">Portfolio <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
          <div class="dropdown-content mega-dropdown">
            <div class="mega-grid">
              <div class="mega-column">
                <h4 class="mega-heading">Proyek Pemerintahan</h4>
                <a href="<?= base_url('MenuPortofolio') ?>">Portofolio Proyek Selesai</a>
                <p class="mega-desc">Kerjasama dengan berbagai Pemda di Jawa Timur & luar pulau.</p>
              </div>
            </div>
          </div>
        </li>

        <li class="dropdown">
          <a href="<?= base_url('#team') ?>" class="nav-item-link">Tim <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
          <div class="dropdown-content mega-dropdown">
            <div class="mega-grid">
              <div class="mega-column">
                <h4 class="mega-heading">Tim Riset</h4>
                <a href="<?= base_url('#team') ?>">Profil Riset & Analis</a>
                <h4 class="mega-heading">Tim Ahli</h4>
                <a href="<?= base_url('#team') ?>">Peneliti & Advisor</a>
              </div>
            </div>
          </div>
        </li>

        <!-- Lugx Red Action Button -->
        <li class="main-button">
          <a href="#" onclick="openModal('signInModal'); return false;"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
        </li>
      </ul>

      <!-- Mobile Menu Toggle -->
      <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
        <i class="fas fa-bars"></i>
      </button>
    </nav>
  </header>

  <!-- Mobile Offcanvas Nav -->
  <div class="mobile-nav" id="mobileNav">
    <div class="dropbtn" onclick="toggleMobileDropdown(this)">Tentang <i class="fa-solid fa-chevron-down"></i></div>
    <div class="dropdown-content">
      <a href="<?= base_url('#about') ?>" onclick="closeMobileMenu()">Sejarah & Visi Misi</a>
      <a href="<?= base_url('legalitas') ?>">Legalitas & Sertifikasi</a>
    </div>

    <div class="dropbtn" onclick="toggleMobileDropdown(this)">Layanan <i class="fa-solid fa-chevron-down"></i></div>
    <div class="dropdown-content">
      <a href="<?= base_url('#services') ?>" onclick="closeMobileMenu()">Konsultasi Ekonomi</a>
      <a href="<?= base_url('MenuSurvei') ?>" style="color: var(--lugx-red); font-weight: 700;">Survei Kepuasan SKM</a>
      <a href="<?= base_url('MasterData') ?>">Repositori MasterData</a>
    </div>

    <div class="dropbtn" onclick="toggleMobileDropdown(this)">Portfolio <i class="fa-solid fa-chevron-down"></i></div>
    <div class="dropdown-content">
      <a href="<?= base_url('MenuPortofolio') ?>">Proyek Selesai</a>
    </div>

    <div class="dropbtn" onclick="toggleMobileDropdown(this)">Tim <i class="fa-solid fa-chevron-down"></i></div>
    <div class="dropdown-content">
      <a href="<?= base_url('#team') ?>" onclick="closeMobileMenu()">Tim Riset & Ahli</a>
    </div>

    <div style="margin-top: 25px;" class="main-button">
      <a href="#" onclick="openModal('signInModal'); closeMobileMenu(); return false;"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
    </div>
  </div>
  <div class="mobile-nav-overlay" id="menuOverlay" onclick="closeMobileMenu()"></div>

  <!-- SUBPAGE HERO BANNER -->
  <section class="subpage-banner">
    <!-- Floating Vector Doodle Accents -->
    <i class="fa-solid fa-square-poll-vertical cta-doodle doodle-1"></i>
    <i class="fa-solid fa-clipboard-check cta-doodle doodle-2"></i>
    <i class="fa-solid fa-users cta-doodle doodle-3"></i>
    <i class="fa-solid fa-chart-line cta-doodle doodle-4"></i>
    <i class="fa-solid fa-star cta-doodle doodle-5"></i>
    <i class="fa-solid fa-award cta-doodle doodle-6"></i>

    <div class="banner-container">
      <h1>Layanan Survei <span>IKM</span></h1>
      <p class="lead-text">
        Silakan berpartisipasi dalam Survei Indeks Kepuasan Masyarakat (IKM) berbasis instrumen ilmiah untuk mengevaluasi mutu pelayanan publik secara objektif, transparan, dan terukur.
      </p>

      <!-- Stats Summary Strip -->
      <div class="hero-stats-strip">
        <div class="hero-stat-box">
          <span class="hero-stat-val">KemenPAN-RB</span>
          <span class="hero-stat-lbl">Metode Baku Teruji</span>
        </div>
        <div class="hero-stat-box">
          <span class="hero-stat-val">100%</span>
          <span class="hero-stat-lbl">Objektif &amp; Terukur</span>
        </div>
        <div class="hero-stat-box">
          <span class="hero-stat-val">Analisis</span>
          <span class="hero-stat-lbl">Berbasis Data Ilmiah</span>
        </div>
        <div class="hero-stat-box">
          <span class="hero-stat-val">Rekomendasi</span>
          <span class="hero-stat-lbl">Kebijakan Strategis</span>
        </div>
      </div>
    </div>
  </section>

  <!-- SURVEY CONTENT & FILTER -->
  <section class="survey-content">
    <div class="survey-content-inner">

      <div class="section-heading">
        <span class="subtitle">Instrumen &amp; Partisipasi Publik</span>
        <h2>Formulir Survei Aktif</h2>
        <p>Pilih dan isi kuesioner survei sesuai dengan instansi dan unit layanan publik yang Anda gunakan.</p>
      </div>

      <!-- Modern Filter Section -->
      <div class="filter-section-lugx">
        <h4><i class="fa-solid fa-filter"></i> Filter Pencarian Survei</h4>
        <div class="filter-grid-row">
          <div class="filter-group-lugx">
            <label for="jenis">Jenis Survei</label>
            <select id="jenis" class="filter-select-custom" onchange="filterSurvei()">
              <option value="">Semua Jenis Survei</option>
            </select>
          </div>
          <div class="filter-group-lugx">
            <label for="tahun">Tahun Pelaksanaan</label>
            <select id="tahun" class="filter-select-custom" onchange="filterSurvei()">
              <option value="">Semua Tahun</option>
            </select>
          </div>
          <div class="filter-group-lugx">
            <label for="status">Status Survei</label>
            <select id="status" class="filter-select-custom" onchange="filterSurvei()">
              <option value="">Semua Status</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Grid Survei -->
      <div class="survey-grid" id="surveyGrid"></div>

    </div>
  </section>

  <!-- FOOTER & CONTACT SECTION -->
  <footer id="contact" class="footer-area">
    <div class="footer-container">
      <div class="footer-grid">
        <div class="footer-about">
          <h3>Kantor IDE Consultant</h3>
          <p><i class="fa-solid fa-location-dot" style="color: var(--lugx-red); margin-right: 8px;"></i> Perum Nila Residence B6, Kecamatan Blimbing, Kota Malang</p>
          <p><i class="fa-solid fa-envelope" style="color: var(--lugx-red); margin-right: 8px;"></i> cvideconsultan@gmail.com</p>
          
          <div class="social-icons" style="margin-top: 20px;">
            <a href="https://www.tiktok.com/@intidesainekonomi" class="social-icon-btn" target="_blank" aria-label="TikTok">
              <i class="fa-brands fa-tiktok"></i>
            </a>
            <a href="https://www.instagram.com/intidesainekonomi" class="social-icon-btn" target="_blank" aria-label="Instagram">
              <i class="fa-brands fa-instagram"></i>
            </a>
          </div>
        </div>

        <div class="footer-col">
          <h3>Layanan Kami</h3>
          <ul class="footer-links">
            <li><a href="<?= base_url('#services') ?>">Ekonomi Pembangunan</a></li>
            <li><a href="<?= base_url('#services') ?>">Fiskal &amp; Kebijakan Publik</a></li>
            <li><a href="<?= base_url('#services') ?>">Perencanaan Regional</a></li>
            <li><a href="<?= base_url('#services') ?>">Manajemen</a></li>
            <li><a href="<?= base_url('#services') ?>">Pembuatan Website &amp; Aplikasi</a></li>
            <li><a href="<?= base_url('MenuSurvei') ?>">Survei Kepuasan SKM</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h3>Tautan Cepat</h3>
          <ul class="footer-links">
            <li><a href="<?= base_url('#about') ?>">Visi &amp; Misi</a></li>
            <li><a href="<?= base_url('#team') ?>">Tim Ahli</a></li>
            <li><a href="<?= base_url('MenuPortofolio') ?>">Portofolio Proyek</a></li>
            <li><a href="<?= base_url('legalitas') ?>">Legalitas Usaha</a></li>
            <li><a href="<?= base_url('MasterData') ?>">Repositori Data</a></li>
          </ul>
        </div>
      </div>

      <div class="copyright">
        <p>Copyright © <span id="current-year"></span> CV Inti Desain Ekonomi Consultant. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp Button -->
  <a href="https://wa.me/6282227666283?text=Halo%20Admin%20IDE%20Consultant,%20saya%20ingin%20bertanya%20mengenai%20survei%20dan%20layanan..." 
     class="whatsapp-float" 
     target="_blank" 
     rel="noopener noreferrer"
     aria-label="Chat via WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
  </a>

  <!-- LOGIN PROMPT MODAL (Lugx Modal Style) -->
  <div id="loginPromptModal" class="login-prompt-modal">
    <div class="login-prompt-content">
      <div class="prompt-icon-wrap">
        <i class="fa-solid fa-triangle-exclamation"></i>
      </div>
      <h3>Perlu Masuk Akun</h3>
      <p>Anda perlu masuk ke akun terlebih dahulu untuk mengisi formulir survei resmi, atau Anda dapat melihat tampilan simulasi demo.</p>
      <div class="login-prompt-actions">
        <button class="login-prompt-btn primary" onclick="handleLoginPromptLogin()">
          <i class="fa-solid fa-right-to-bracket"></i> Masuk
        </button>
        <button class="login-prompt-btn secondary" onclick="handleLoginPromptDemo()">
          <i class="fa-solid fa-eye"></i> Demo
        </button>
      </div>
    </div>
  </div>

  <!-- SIGN IN MODAL (Enlarged 2-Column Split Modal Matching IDE.php) -->
  <div id="signInModal" class="modal">
    <div class="modal-content modal-content-split">
      <div class="login-modal-grid">
        <!-- Left Side: Animated Doodle Vector Banner -->
        <div class="login-banner-side">
          <i class="fa-solid fa-chart-line login-doodle doodle-1"></i>
          <i class="fa-solid fa-briefcase login-doodle doodle-2"></i>
          <i class="fa-solid fa-file-signature login-doodle doodle-3"></i>
          <i class="fa-solid fa-scale-balanced login-doodle doodle-4"></i>
          <i class="fa-solid fa-chess login-doodle doodle-5"></i>
          <i class="fa-solid fa-building-columns login-doodle doodle-6"></i>

          <div class="login-banner-top" style="position: relative; z-index: 2;">
            <div class="login-brand">
              <img src="<?= base_url('assets/img/LOGO IDE.webp') ?>" alt="IDE Consultant Logo">
              <div class="login-brand-text">Inti Desain Ekonomi <span>Consultant</span></div>
            </div>
          </div>
          <div class="login-banner-center" style="position: relative; z-index: 2;">
            <span class="login-pill" id="adminGreetingPill"><i class="fa-solid fa-sun"></i> Selamat Datang, Admin IDE</span>
            <h2>Professional Research &amp; Consulting Portal</h2>
            <p>Solusi riset &amp; konsultasi kebijakan ekonomi berbasis data tepercaya dan terintegrasi.</p>
          </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="login-form-side">
          <button class="modal-close-dark" onclick="closeModal('signInModal')" title="Tutup">&times;</button>
          <div class="login-form-header">
            <h3>Masuk</h3>
            <p class="login-subtext">Masukkan kredensial akun Anda untuk mengakses portal.</p>
          </div>

          <div class="login-form-body">
            <div class="form-group-custom">
              <label class="form-label-custom">Username / ID Akun</label>
              <div class="input-icon-wrapper">
                <i class="fa-solid fa-user input-icon"></i>
                <input type="text" class="form-input-custom" id="Username" placeholder="Masukkan username Anda">
              </div>
            </div>

            <div class="form-group-custom">
              <label class="form-label-custom">Kata Sandi / Password</label>
              <div class="input-icon-wrapper">
                <i class="fa-solid fa-lock input-icon"></i>
                <input type="password" class="form-input-custom" id="Password" placeholder="Masukkan password Anda">
              </div>
            </div>

            <button class="btn-login-large" id="Masuk">
              <i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JQUERY, SWEETALERT2 & SCRIPTS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    var BaseURL = '<?= base_url() ?>';
    var currentSelectedSurvey = null;
    var isLoggedIn = <?= $isLoggedIn ? 'true' : 'false' ?>;
    var userLevel = <?= $userLevel ?>;

    // Dynamic Admin Time Greeting
    function updateAdminGreeting() {
      var greetingPill = document.getElementById('adminGreetingPill');
      if (!greetingPill) return;

      var hour = new Date().getHours();
      var greetingText = '';
      var iconClass = '';

      if (hour >= 4 && hour < 11) {
        greetingText = 'Selamat Pagi, Admin IDE';
        iconClass = 'fa-solid fa-sun';
      } else if (hour >= 11 && hour < 15) {
        greetingText = 'Selamat Siang, Admin IDE';
        iconClass = 'fa-solid fa-sun-plant-wilt';
      } else if (hour >= 15 && hour < 18.5) {
        greetingText = 'Selamat Sore, Admin IDE';
        iconClass = 'fa-solid fa-cloud-sun';
      } else {
        greetingText = 'Selamat Malam, Admin IDE';
        iconClass = 'fa-solid fa-moon';
      }

      greetingPill.innerHTML = '<i class="' + iconClass + '"></i> ' + greetingText;
    }

    // Modal functions
    function openModal(modalId) {
      var targetModal = document.getElementById(modalId);
      if (targetModal) {
        targetModal.classList.add('active');
        if (modalId === 'signInModal') updateAdminGreeting();
      }
    }

    function closeModal(modalId) {
      var targetModal = document.getElementById(modalId);
      if (targetModal) targetModal.classList.remove('active');
    }

    // Login Prompt Modal functions
    function openLoginPrompt() {
      var prompt = document.getElementById('loginPromptModal');
      if (prompt) prompt.classList.add('active');
    }

    function closeLoginPrompt() {
      var prompt = document.getElementById('loginPromptModal');
      if (prompt) prompt.classList.remove('active');
    }

    function handleLoginPromptLogin() {
      closeLoginPrompt();
      openModal('signInModal');
    }

    function handleLoginPromptDemo() {
      closeLoginPrompt();
      if (currentSelectedSurvey) {
        window.location.href = currentSelectedSurvey.url + '?demo=true';
      }
    }

    // Logout Function
    function logout() {
      Swal.fire({
        title: 'Konfirmasi Logout',
        text: "Apakah Anda yakin ingin keluar dari sesi ini?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#b40814',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Keluar',
        cancelButtonText: 'Batal'
      }).then(function(result) {
        if (result.isConfirmed) {
          window.location.href = BaseURL + "IDE/logout";
        }
      });
    }

    window.onclick = function(event) {
      if (event.target.classList.contains('modal')) {
        closeModal(event.target.id);
      }
      if (event.target.classList.contains('login-prompt-modal')) {
        closeLoginPrompt();
      }
    };

    // Mobile Navigation Toggle
    var menuToggle = document.getElementById('menuToggle');
    var mobileNav = document.getElementById('mobileNav');
    var menuOverlay = document.getElementById('menuOverlay');

    function openMobileMenu() {
      if (mobileNav && menuOverlay) {
        mobileNav.classList.add('active');
        menuOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    }

    function closeMobileMenu() {
      if (mobileNav && menuOverlay) {
        mobileNav.classList.remove('active');
        menuOverlay.classList.remove('active');
        document.body.style.overflow = '';
      }
    }

    if (menuToggle) {
      menuToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        if (mobileNav.classList.contains('active')) {
          closeMobileMenu();
        } else {
          openMobileMenu();
        }
      });
    }

    window.toggleMobileDropdown = function(btn) {
      var content = btn.nextElementSibling;
      if (content) {
        content.classList.toggle('show-dropdown');
      }
    };

    // Login Form AJAX Handler
    jQuery(document).ready(function($) {
      "use strict";

      $('#Username, #Password').keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
          event.preventDefault();
          $("#Masuk").click();
        }
      });

      $("#Masuk").click(function(e) {
        e.preventDefault();

        var username = $.trim($("#Username").val());
        var password = $.trim($("#Password").val());

        if (!username || !password) {
          Swal.fire('Perhatian', 'Mohon isi username dan password dengan lengkap.', 'warning');
          return;
        }

        var Akun = { 
          Username: username, 
          Password: password 
        };

        var $btn = $(this);
        var originalText = $btn.html();

        $btn.prop("disabled", true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memproses...');

        $.post(BaseURL + "IDE/SignIn", Akun).done(function(Respon) {
          var trimmedRespon = $.trim(Respon);
          if (trimmedRespon == '1') {
            window.location = BaseURL + "SuperAdmin";
          } else if (trimmedRespon == '2') {
            window.location = BaseURL + "Admin";
          } else if (trimmedRespon == '3') {
            window.location = BaseURL + "Staf";
          } else if (trimmedRespon == '4') {
            window.location.reload();
          } else if (trimmedRespon == '0') {
            window.location = BaseURL + "Econk";
          } else {
            Swal.fire('Gagal', trimmedRespon || "Username atau password salah. Silakan coba lagi.", 'error');
            $btn.prop("disabled", false).html(originalText);
          }
        }).fail(function() {
          Swal.fire('Error', 'Gagal terhubung ke server. Periksa koneksi Anda.', 'error');
          $btn.prop("disabled", false).html(originalText);
        });
      });
    });

    // Survey Data & Render Handlers
    var surveiData = [
      // { id: 1, title: "Survei IKM Kinerja Bupati & Wakil Bupati Kab. Situbondo", jenis: "IKM", tahun: "2024", status: "Tidak Aktif", lembaga: "BAPPERIDA Kab. Situbondo", url: "<?= base_url('IDE/SurveiIKMSitubondo') ?>" },
      // { id: 2, title: "Survei IKM Kinerja Bupati & Wakil Bupati Kab. Situbondo", jenis: "IKM", tahun: "2025", status: "Tidak Aktif", lembaga: "BAPPERIDA Kab. Situbondo", url: "<?= base_url('IDE/SurveiIKMSitubondo') ?>" },
      // { id: 3, title: "Survei IKM Kinerja Walikota & Wakil Walikota Kota Yogyakarta", jenis: "IKM", tahun: "2026", status: "Aktif", lembaga: "BAKESBANGPOL Kota Yogyakarta", url: "<?= base_url('IDE/SurveiIKMYogyakarta') ?>" }
    ];

    function isUserLoggedIn() {
      return isLoggedIn;
    }

    function handleSurveyClick(survey, action) {
      if (action === 'isi') {
        if (isUserLoggedIn()) {
          window.location.href = survey.url;
        } else {
          currentSelectedSurvey = survey;
          openLoginPrompt();
        }
      } else if (action === 'demo') {
        window.location.href = survey.url + '?demo=true';
      }
    }

    function renderSurvei(data) {
      var grid = document.getElementById('surveyGrid');
      if (!grid) return;
      grid.innerHTML = '';

      if (data.length === 0) {
        grid.innerHTML = '<div style="text-align:center; color: var(--lugx-gray); grid-column: 1 / -1; padding: 60px 20px; background: var(--lugx-light-gray); border-radius: var(--lugx-radius);"><i class="fa-solid fa-clipboard-question" style="font-size: 40px; margin-bottom: 12px; color: #cbd5e1; display: block;"></i><h4 style="font-size: 16px; font-weight: 700; color: var(--lugx-dark);">Belum Ada Survei</h4><p style="font-size: 14px; margin: 0;">Tidak ada survei yang sesuai dengan kriteria filter saat ini.</p></div>';
        return;
      }

      data.forEach(function(item) {
        var card = document.createElement('div');
        card.className = 'survey-card';
        var encodedItem = JSON.stringify(item).replace(/"/g, '&quot;');
        
        card.innerHTML = 
          '<div class="card-header-row">' +
            '<div class="card-icon">' +
              '<i class="fa-solid fa-square-poll-vertical"></i>' +
            '</div>' +
            '<span class="card-status ' + (item.status === 'Aktif' ? 'status-active' : 'status-inactive') + '">' +
              '<i class="fa-solid ' + (item.status === 'Aktif' ? 'fa-circle-check' : 'fa-circle-xmark') + '"></i> ' + item.status +
            '</span>' +
          '</div>' +
          '<h3 class="card-title">' + item.title + '</h3>' +
          '<div class="card-meta">' +
            '<div class="meta-row">' +
              '<span class="meta-label">Lembaga</span>' +
              '<span class="meta-colon">:</span>' +
              '<span class="meta-value">' + item.lembaga + '</span>' +
            '</div>' +
            '<div class="meta-row">' +
              '<span class="meta-label">Jenis Survei</span>' +
              '<span class="meta-colon">:</span>' +
              '<span class="meta-value">' + item.jenis + '</span>' +
            '</div>' +
            '<div class="meta-row">' +
              '<span class="meta-label">Tahun</span>' +
              '<span class="meta-colon">:</span>' +
              '<span class="meta-value">' + item.tahun + '</span>' +
            '</div>' +
          '</div>' +
          '<div class="card-actions">' +
            '<button class="btn-action-fill" onclick="handleSurveyClick(' + encodedItem + ', \'isi\')">' +
              '<i class="fa-solid fa-pen-to-square"></i> Isi Survei' +
            '</button>' +
            '<button class="btn-action-demo" onclick="handleSurveyClick(' + encodedItem + ', \'demo\')">' +
              '<i class="fa-solid fa-eye"></i> Demo' +
            '</button>' +
          '</div>';
        grid.appendChild(card);
      });
    }

    function filterSurvei() {
      var jenis = document.getElementById('jenis').value;
      var tahun = document.getElementById('tahun').value;
      var status = document.getElementById('status').value;

      var filtered = surveiData;

      if (jenis) filtered = filtered.filter(function(item) { return item.jenis === jenis; });
      if (tahun) filtered = filtered.filter(function(item) { return item.tahun === tahun; });
      if (status) filtered = filtered.filter(function(item) { return item.status === status; });

      renderSurvei(filtered);
    }

    document.addEventListener('DOMContentLoaded', function() {
      renderSurvei(surveiData);
      var yearElem = document.getElementById('current-year');
      if (yearElem) yearElem.textContent = new Date().getFullYear();
      updateAdminGreeting();
    });
  </script>
</body>
</html>