<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes" name="viewport">
  <title>IDE Consultant - Professional Research & Consulting</title>
  <meta content="Professional Research & Consulting Services - CV Inti Desain Ekonomi" name="description">
  <meta content="consulting, research, economic development, banyuwangi, malang, lugx, ide consultant" name="keywords">
  
  <!-- Google Fonts: Poppins (TemplateMo Lugx Gaming signature font) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  
  <style>
    /* ==========================================================================
       LUGX GAMING DESIGN SYSTEM TEMPLATE (TemplateMo 589)
       Adapted for IDE Consultant
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
      display: none;
      position: absolute;
      top: 100%;
      left: 50%;
      transform: translateX(-50%);
      background: #ffffff;
      min-width: 320px;
      max-width: 500px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
      border-radius: 20px;
      margin-top: 15px;
      z-index: 1000;
      padding: 24px;
      border-top: 4px solid var(--lugx-red);
    }

    .dropdown:hover .dropdown-content.mega-dropdown {
      display: block;
      animation: fadeInDown 0.3s ease forwards;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translate(-50%, 10px);
      }
      to {
        opacity: 1;
        transform: translate(-50%, 0);
      }
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

    /* ==========================================================================
       HERO BANNER SECTION (Lugx Angled Red Gradient & Animated Card)
       ========================================================================== */
    .main-banner {
      background: linear-gradient(135deg, rgba(180, 8, 20, 0.95) 0%, rgba(4, 49, 104, 0.96) 50%, rgba(8, 35, 75, 0.98) 100%);
      border-bottom-right-radius: 150px;
      border-bottom-left-radius: 150px;
      padding: 180px 0 130px 0;
      position: relative;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(4, 49, 104, 0.35);
    }

    .main-banner::before {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      width: 100%;
      height: 100%;
      background: url('assets/img/background/IDE 2.0.webp') no-repeat center center/cover;
      opacity: 0.15;
      pointer-events: none;
      z-index: 0;
    }

    /* Ambient Pulsating Red Glow on Left */
    .main-banner::after {
      content: '';
      position: absolute;
      top: -25%;
      left: -10%;
      width: 550px;
      height: 550px;
      background: radial-gradient(circle, rgba(238, 98, 107, 0.5) 0%, rgba(180, 8, 20, 0.25) 45%, transparent 75%);
      filter: blur(50px);
      animation: pulseRedGlow 6s ease-in-out infinite alternate;
      pointer-events: none;
      z-index: 1;
    }

    @keyframes pulseRedGlow {
      0% { transform: scale(1) translate(0, 0); opacity: 0.7; }
      100% { transform: scale(1.15) translate(25px, 20px); opacity: 1; }
    }

    .banner-container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 0 40px;
      position: relative;
      z-index: 2;
    }

    .banner-left {
      text-align: left;
      margin-left: 0;
      max-width: 800px;
    }

    .banner-left h2 {
      font-size: 50px;
      font-weight: 800;
      color: #ffffff;
      text-transform: uppercase;
      line-height: 1.9;
      margin-bottom: 18px;
      text-shadow: 0 4px 15px rgba(0,0,0,0.3);
      text-align: left;
    }

    .banner-left p {
      color: rgba(255, 255, 255, 0.92);
      font-size: 16px;
      margin-bottom: 30px;
      max-width: 680px;
      line-height: 1.7;
      text-align: left;
    }

    /* Search Box or Quick CTA */
    .search-input {
      position: relative;
      max-width: 480px;
    }

    .search-input input {
      width: 100%;
      height: 60px;
      border-radius: 30px;
      border: none;
      padding: 0 160px 0 25px;
      font-size: 15px;
      font-weight: 500;
      outline: none;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .search-input button {
      position: absolute;
      right: 5px;
      top: 5px;
      height: 50px;
      background-color: var(--lugx-red);
      color: #ffffff;
      border: none;
      border-radius: 25px;
      padding: 0 30px;
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .search-input button:hover {
      background-color: var(--lugx-red-hover);
    }

    /* Right Hero Visual Card */
    .banner-right {
      position: relative;
    }

    .banner-image-wrapper {
      position: relative;
      border-radius: 25px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    .banner-image-wrapper img {
      width: 100%;
      height: 400px;
      object-fit: cover;
      display: block;
      transition: transform 0.5s ease;
    }

    .banner-image-wrapper:hover img {
      transform: scale(1.05);
    }

    /* Floating Price Badge overlay (Lugx signature) */
    .price-tag {
      position: absolute;
      top: 20px;
      right: 20px;
      background-color: var(--lugx-blue);
      color: #ffffff;
      font-size: 20px;
      font-weight: 700;
      padding: 8px 20px;
      border-radius: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .offer-badge {
      position: absolute;
      bottom: -20px;
      left: 20px;
      background-color: var(--lugx-red);
      color: #ffffff;
      width: 90px;
      height: 90px;
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 16px;
      line-height: 1.1;
      text-align: center;
      box-shadow: 0 8px 20px rgba(238, 98, 107, 0.5);
      border: 4px solid #ffffff;
    }

    /* ==========================================================================
       FEATURES SECTION (Lugx 4-Column Overlapping Cards)
       ========================================================================== */
    .features-section {
      margin-top: -60px;
      position: relative;
      z-index: 10;
    }

    .features-container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 0 30px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 30px;
    }

    .feature-item {
      background-color: #ffffff;
      padding: 35px 25px;
      border-radius: var(--lugx-radius);
      box-shadow: var(--lugx-shadow);
      text-align: center;
      transition: all 0.4s ease;
    }

    .feature-item:hover {
      transform: translateY(-10px);
    }

    .feature-icon {
      width: 90px;
      height: 90px;
      background-color: var(--lugx-blue);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 25px auto;
      color: #ffffff;
      font-size: 36px;
      transition: all 0.4s ease;
    }

    .feature-item:hover .feature-icon {
      background-color: var(--lugx-red);
      transform: rotateY(180deg);
    }

    .feature-item h4 {
      font-size: 18px;
      font-weight: 700;
      color: var(--lugx-dark);
      text-transform: uppercase;
      margin-bottom: 10px;
    }

    .feature-item p {
      font-size: 13px;
      color: var(--lugx-gray);
      line-height: 1.5;
    }

    /* ==========================================================================
       SECTION HEADINGS (Lugx Subtitle Tag + Big Title)
       ========================================================================== */
    .section-heading {
      text-align: center;
      margin-bottom: 60px;
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
    }

    .section-heading-flex {
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      margin-bottom: 50px;
    }

    .section-heading-flex .section-heading {
      text-align: left;
      margin-bottom: 0;
    }

    /* ==========================================================================
       TRENDING / RESEARCH & SERVICES SECTION (Lugx Cards Grid)
       ========================================================================== */
    .trending-section {
      padding: 100px 0;
      background-color: #ffffff;
    }

    .trending-container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 0 30px;
    }

    .trending-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 30px;
    }

    .trending-card {
      background-color: var(--lugx-light-gray);
      border-radius: var(--lugx-radius);
      overflow: hidden;
      transition: all 0.3s ease;
      position: relative;
    }

    .trending-card:hover {
      box-shadow: var(--lugx-shadow);
      transform: translateY(-5px);
    }

    .trending-thumb {
      position: relative;
      height: 200px;
      overflow: hidden;
    }

    .trending-thumb img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .trending-card:hover .trending-thumb img {
      transform: scale(1.1);
    }

    /* Animated Vector Icon Header for Service Cards */
    .service-icon-box {
      height: 190px;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
      transition: all 0.4s ease;
    }

    .service-icon-wrapper {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.35);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #ffffff;
      font-size: 34px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
      animation: floatServiceIcon 4s ease-in-out infinite alternate;
      z-index: 2;
      transition: transform 0.4s ease;
    }

    .trending-card:hover .service-icon-wrapper {
      transform: scale(1.15) rotate(6deg);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
    }

    @keyframes floatServiceIcon {
      0% { transform: translateY(0px) rotate(0deg); }
      100% { transform: translateY(-10px) rotate(4deg); }
    }

    /* Ambient Pulsating Glow Behind Icon */
    .service-icon-glow {
      position: absolute;
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.35) 0%, transparent 70%);
      animation: pulseIconGlow 3s ease-in-out infinite alternate;
      z-index: 1;
    }

    @keyframes pulseIconGlow {
      0% { transform: scale(0.9); opacity: 0.5; }
      100% { transform: scale(1.3); opacity: 0.9; }
    }

    /* Tailored Navy, Red & White Gradient Color Schemes for Each Service */
    .box-survei { background: linear-gradient(135deg, #043168 0%, #0a3d7c 55%, #b40814 100%); }
    .box-kebijakan { background: linear-gradient(135deg, #b40814 0%, #ee626b 45%, #043168 100%); }
    .box-teknologi { background: linear-gradient(135deg, #043168 0%, #0d4f9b 65%, #ee626b 100%); }
    .box-ekonomi { background: linear-gradient(135deg, #0a3d7c 0%, #043168 55%, #b40814 100%); }
    .box-fiskal { background: linear-gradient(135deg, #b40814 0%, #043168 70%, #0a3d7c 100%); }
    .box-regional { background: linear-gradient(135deg, #043168 0%, #0f4b93 60%, #b40814 100%); }
    .box-manajemen { background: linear-gradient(135deg, #083772 0%, #b40814 50%, #043168 100%); }

    .category-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      background-color: var(--lugx-blue);
      color: #ffffff;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      padding: 4px 15px;
      border-radius: 15px;
    }

    .trending-card-body {
      padding: 25px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .trending-info h4 {
      font-size: 17px;
      font-weight: 700;
      color: var(--lugx-dark);
      margin-bottom: 4px;
    }

    .trending-info span {
      font-size: 13px;
      color: var(--lugx-gray);
      font-weight: 500;
    }

    .shopping-btn {
      width: 45px;
      height: 45px;
      background-color: var(--lugx-red);
      color: #ffffff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .shopping-btn:hover {
      background-color: var(--lugx-blue);
      transform: scale(1.1);
    }

    /* ==========================================================================
       ABOUT & VISION MISSION SECTION (Overlapping Section Cards)
       ========================================================================== */
    .about-section {
      padding: 100px 0 140px 0;
      background-color: var(--lugx-light-gray);
      position: relative;
    }

    .about-container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 0 30px;
      position: relative;
    }

    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      align-items: center;
      margin-bottom: 70px;
    }

    .about-text p {
      color: var(--lugx-gray);
      font-size: 15px;
      line-height: 1.8;
      margin-bottom: 20px;
      text-align: justify;
    }

    .about-video {
      height: 340px;
      border-radius: var(--lugx-radius);
      overflow: hidden;
      box-shadow: var(--lugx-shadow);
    }

    /* Floating Overlapping Visi Misi Cards (Memotong Section) */
    .vm-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 35px;
      margin-bottom: -140px;
      position: relative;
      z-index: 10;
    }

    .vm-card {
      background: linear-gradient(135deg, #043168 0%, #0a3d7c 50%, #0d4f9b 100%);
      padding: 45px 35px;
      border-radius: 28px;
      box-shadow: 0 20px 45px rgba(4, 49, 104, 0.35);
      border: none;
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      position: relative;
      overflow: hidden;
    }

    .vm-card::before {
      content: '';
      position: absolute;
      top: -30%;
      right: -20%;
      width: 200px;
      height: 200px;
      background: radial-gradient(circle, rgba(238, 98, 107, 0.25) 0%, transparent 70%);
      pointer-events: none;
    }

    .vm-card:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 25px 50px rgba(4, 49, 104, 0.45);
      background: linear-gradient(135deg, #073a78 0%, #125cb6 100%);
    }

    .vm-card h3 {
      font-size: 24px;
      font-weight: 800;
      color: #ee626b;
      margin-bottom: 18px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .vm-card h3 i {
      font-size: 24px;
      color: #ffffff;
      background-color: var(--lugx-red);
      width: 52px;
      height: 52px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(180, 8, 20, 0.4);
      flex-shrink: 0;
    }

    .vm-card p {
      color: rgba(255, 255, 255, 0.92);
      font-size: 14px;
      line-height: 1.8;
      margin-bottom: 12px;
    }

    /* ==========================================================================
       SPECIAL PROMOTIONAL BANNER SECTION (Lugx Special Banner with Doodle & Glow)
       ========================================================================== */
    .cta-banner {
      background: linear-gradient(135deg, #043168 0%, #0a3d7c 65%, #b40814 100%);
      padding: 130px 0 90px 0;
      color: #ffffff;
      border-radius: 40px;
      margin: 80px 30px 40px 30px;
      text-align: center;
      box-shadow: 0 20px 45px rgba(4, 49, 104, 0.35);
      border: 1px solid rgba(255, 255, 255, 0.15);
      position: relative;
      overflow: hidden;
      transition: all 0.4s ease;
    }

    .cta-banner:hover {
      transform: translateY(-8px);
      box-shadow: 0 30px 60px rgba(4, 49, 104, 0.45), 0 0 40px rgba(238, 98, 107, 0.35);
    }

    /* Ambient Pulsating Red Glow Aura */
    .cta-banner::before {
      content: '';
      position: absolute;
      top: -30%;
      right: -10%;
      width: 450px;
      height: 450px;
      background: radial-gradient(circle, rgba(238, 98, 107, 0.45) 0%, rgba(180, 8, 20, 0.2) 50%, transparent 75%);
      filter: blur(40px);
      animation: ctaGlowPulse 6s ease-in-out infinite alternate;
      pointer-events: none;
      z-index: 1;
    }

    /* Floating Rotating Doodle Ring */
    .cta-banner::after {
      content: '';
      position: absolute;
      bottom: -15%;
      left: -5%;
      width: 320px;
      height: 320px;
      border: 2px dashed rgba(255, 255, 255, 0.18);
      border-radius: 50%;
      animation: floatDoodleRing 14s linear infinite;
      pointer-events: none;
      z-index: 1;
    }

    @keyframes ctaGlowPulse {
      0% { transform: scale(1) translate(0, 0); opacity: 0.6; }
      100% { transform: scale(1.2) translate(-20px, 15px); opacity: 0.95; }
    }

    @keyframes floatDoodleRing {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Floating Doodle Icon Accents (Pure Icons - Consultant Theme) */
    .cta-doodle {
      position: absolute;
      color: rgba(255, 255, 255, 0.18);
      pointer-events: none;
      z-index: 1;
      animation: floatDoodleIcon 5s ease-in-out infinite alternate;
      filter: drop-shadow(0 4px 10px rgba(0,0,0,0.25));
    }

    .cta-doodle.doodle-1 { top: 30px; left: 55px; font-size: 46px; animation-delay: 0s; }
    .cta-doodle.doodle-2 { bottom: 35px; left: 90px; font-size: 40px; animation-delay: 1.2s; }
    .cta-doodle.doodle-3 { top: 35px; right: 75px; font-size: 44px; animation-delay: 2.4s; }
    .cta-doodle.doodle-4 { bottom: 30px; right: 65px; font-size: 48px; animation-delay: 0.8s; }
    .cta-doodle.doodle-5 { top: 120px; left: 180px; font-size: 34px; animation-delay: 2s; }
    .cta-doodle.doodle-6 { bottom: 100px; right: 200px; font-size: 36px; animation-delay: 3.2s; }
    .cta-doodle.doodle-7 { top: 125px; right: 180px; font-size: 36px; animation-delay: 1.5s; }
    .cta-doodle.doodle-8 { bottom: 110px; left: 240px; font-size: 32px; animation-delay: 2.8s; }
    .cta-doodle.doodle-9 { top: 40px; left: 320px; font-size: 38px; animation-delay: 0.5s; }
    .cta-doodle.doodle-10 { bottom: 35px; right: 330px; font-size: 38px; animation-delay: 3.5s; }

    @keyframes floatDoodleIcon {
      0% { transform: translateY(0px) rotate(0deg) scale(1); opacity: 0.16; }
      50% { transform: translateY(-12px) rotate(8deg) scale(1.08); opacity: 0.28; }
      100% { transform: translateY(-20px) rotate(-6deg) scale(1.15); opacity: 0.38; }
    }

    .cta-banner-content {
      max-width: 800px;
      margin: 0 auto;
      padding: 0 20px;
      position: relative;
      z-index: 2;
    }

    .cta-banner h2 {
      font-size: 38px;
      font-weight: 800;
      text-transform: uppercase;
      margin-bottom: 20px;
      line-height: 1.3;
    }

    .cta-banner p {
      font-size: 16px;
      color: rgba(255, 255, 255, 0.9);
      margin-bottom: 35px;
    }

    /* ==========================================================================
       PARTNERS / MITRA SECTION (Marquee Slider)
       ========================================================================== */
    .partners-section {
      padding: 80px 0;
      background-color: #ffffff;
      overflow: hidden;
    }

    .partners-container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 0 30px;
    }

    .partners-slider-wrapper {
      position: relative;
      width: 100%;
      overflow: hidden;
      padding: 15px 0;
    }

    .partners-slider-wrapper::before,
    .partners-slider-wrapper::after {
      content: '';
      position: absolute;
      top: 0;
      width: 60px;
      height: 100%;
      z-index: 2;
      pointer-events: none;
    }

    .partners-slider-wrapper::before {
      left: 0;
      background: linear-gradient(to right, #ffffff, transparent);
    }

    .partners-slider-wrapper::after {
      right: 0;
      background: linear-gradient(to left, #ffffff, transparent);
    }

    .partners-track {
      display: flex;
      gap: 25px;
      width: max-content;
      animation: marqueeScroll 25s linear infinite;
    }

    .partners-slider-wrapper:hover .partners-track {
      animation-play-state: paused;
    }

    @keyframes marqueeScroll {
      0% {
        transform: translateX(0);
      }
      100% {
        transform: translateX(calc(-50% - 12.5px));
      }
    }

    .partner-card {
      flex: 0 0 180px;
      background: linear-gradient(135deg, #043168 0%, #0d4f9b 100%);
      border-radius: 20px;
      padding: 20px;
      text-align: center;
      transition: all 0.4s ease;
      user-select: none;
      box-shadow: 0 8px 20px rgba(4, 49, 104, 0.25);
    }

    .partner-card:hover {
      background: linear-gradient(135deg, #0b3977 0%, #125cb6 100%);
      box-shadow: 0 12px 25px rgba(4, 49, 104, 0.4);
      transform: translateY(-5px);
    }

    .partner-logo {
      width: 70px;
      height: 70px;
      margin: 0 auto 12px auto;
      border-radius: 50%;
      background: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .partner-logo img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }

    .partner-card h3 {
      font-size: 13px;
      font-weight: 700;
      color: #ffffff;
    }

    /* ==========================================================================
       FULL-WIDTH PARTNERS & PORTFOLIO STATISTICS SECTION
       ========================================================================== */
    .partners-stats-section {
      width: 100%;
      background: linear-gradient(135deg, #043168 0%, #0a3d7c 50%, #0d4f9b 100%);
      padding: 75px 0;
      color: #ffffff;
      box-shadow: 0 15px 35px rgba(4, 49, 104, 0.3);
      position: relative;
      overflow: hidden;
      margin-top: 40px;
    }

    .partners-stats-section::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -5%;
      width: 450px;
      height: 450px;
      background: radial-gradient(circle, rgba(238, 98, 107, 0.25) 0%, transparent 70%);
      pointer-events: none;
    }

    .partners-stats-container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 0 30px;
    }

    .stats-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .stats-header h3 {
      font-size: 26px;
      font-weight: 800;
      text-transform: uppercase;
      color: #ffffff;
      margin-bottom: 10px;
      letter-spacing: 0.5px;
    }

    .stats-header p {
      font-size: 15px;
      color: rgba(255, 255, 255, 0.88);
      max-width: 700px;
      margin: 0 auto;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 28px;
    }

    .stat-item {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      border-radius: 22px;
      padding: 32px 20px;
      text-align: center;
      border: 2px solid #e2e8f0;
      transition: all 0.35s ease;
    }

    .stat-item:hover {
      transform: translateY(-8px);
      background: rgba(255, 255, 255, 0.18);
      border-color: #ffffff;
      box-shadow: 0 12px 25px rgba(0,0,0,0.25);
    }

    .stat-icon {
      width: 60px;
      height: 60px;
      background-color: var(--lugx-red);
      color: #ffffff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 15px auto;
      font-size: 24px;
      box-shadow: 0 4px 12px rgba(180, 8, 20, 0.4);
    }

    .stat-number {
      font-size: 38px;
      font-weight: 800;
      color: #ffffff;
      line-height: 1.1;
      margin-bottom: 6px;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .stat-label {
      font-size: 15px;
      font-weight: 800;
      color: #ffffff;
      margin-bottom: 4px;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .stat-desc {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.8);
      line-height: 1.4;
    }

    .stats-cta {
      text-align: center;
    }

    .stats-cta .btn-stats-portfolio {
      display: inline-block;
      background-color: var(--lugx-red);
      color: #ffffff;
      font-size: 14px;
      font-weight: 700;
      text-transform: uppercase;
      padding: 14px 32px;
      border-radius: 25px;
      letter-spacing: 0.5px;
      box-shadow: 0 6px 18px rgba(180, 8, 20, 0.4);
      transition: all 0.3s ease;
    }

    .stats-cta .btn-stats-portfolio:hover {
      background-color: var(--lugx-red-hover);
      transform: translateY(-3px);
      box-shadow: 0 10px 22px rgba(180, 8, 20, 0.6);
      color: #ffffff;
    }

    @media (max-width: 992px) {
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 576px) {
      .stats-grid {
        grid-template-columns: 1fr;
      }
    }

    /* ==========================================================================
       TEAM SECTION (Lugx Styled Member Cards with Animations)
       ========================================================================== */
    .team-section {
      padding: 100px 0;
      background-color: var(--lugx-light-gray);
    }

    .team-container {
      max-width: 1320px;
      margin: 0 auto;
      padding: 0 30px;
      text-align: center;
    }

    .team-cat-heading {
      font-size: 20px;
      font-weight: 800;
      color: var(--lugx-blue);
      text-transform: uppercase;
      margin: 45px auto 25px auto;
      padding-bottom: 8px;
      border-bottom: 3px solid var(--lugx-red);
      display: inline-block;
      letter-spacing: 0.5px;
    }

    .team-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 32px;
      margin: 0 auto;
    }

    .team-card {
      flex: 0 1 270px;
      width: 100%;
      max-width: 290px;
      background: linear-gradient(135deg, #043168 0%, #0d4f9b 100%);
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(4, 49, 104, 0.25);
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      text-align: center;
      position: relative;
      border: none;
      display: flex;
      flex-direction: column;
    }

    .team-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 50%;
      height: 100%;
      background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
      transform: skewX(-25deg);
      transition: all 0.75s ease;
      z-index: 3;
      pointer-events: none;
    }

    .team-card:hover::before {
      left: 150%;
    }

    .team-card:hover {
      transform: translateY(-12px) scale(1.02);
      box-shadow: 0 20px 40px rgba(4, 49, 104, 0.45), 0 0 25px rgba(238, 98, 107, 0.3);
      background: linear-gradient(135deg, #073a78 0%, #125cb6 100%);
    }

    .team-img-wrapper {
      position: relative;
      width: 100%;
      height: 280px;
      overflow: hidden;
      background-color: #03244d;
    }

    .team-img-wrapper::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 40%;
      background: linear-gradient(to top, rgba(4, 49, 104, 0.85) 0%, transparent 100%);
      transition: opacity 0.4s ease;
      z-index: 1;
    }

    .team-img-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: top center;
      transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .team-card:hover .team-img-wrapper img {
      transform: scale(1.12) rotate(1deg);
    }

    .team-info {
      padding: 22px 18px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 10px;
      flex-grow: 1;
      position: relative;
      z-index: 2;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .team-info h4 {
      font-size: 16px;
      font-weight: 700;
      color: #ffffff;
      line-height: 1.35;
      margin: 0;
      transition: color 0.3s ease;
    }

    .team-card:hover .team-info h4 {
      color: #ee626b;
      text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .team-info p {
      font-size: 12px;
      color: #ffffff;
      font-weight: 600;
      margin: 0;
      background: rgba(255, 255, 255, 0.15);
      padding: 5px 14px;
      border-radius: 20px;
      backdrop-filter: blur(4px);
      transition: all 0.3s ease;
      letter-spacing: 0.3px;
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .team-card:hover .team-info p {
      background: var(--lugx-red);
      color: #ffffff;
      border-color: transparent;
      box-shadow: 0 4px 12px rgba(180, 8, 20, 0.4);
      transform: scale(1.05);
    }

    /* ==========================================================================
       CONTACT & FOOTER SECTION (Lugx Navy Gradient Footer)
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
      transition: all 0.3s ease;
    }

    .whatsapp-float:hover {
      transform: scale(1.1);
      box-shadow: 0 15px 30px rgba(37, 211, 102, 0.6);
      color: #ffffff;
    }

    /* ==========================================================================
       MODALS (Lugx Gaming Theme Modals)
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

    .modal-content {
      background-color: #ffffff;
      border-radius: var(--lugx-radius);
      width: 100%;
      max-width: 480px;
      box-shadow: 0 25px 50px rgba(0,0,0,0.3);
      overflow: hidden;
      transform: scale(0.9);
      transition: transform 0.3s ease;
    }

    .modal.active .modal-content {
      transform: scale(1);
    }

    .modal-header {
      background-color: var(--lugx-blue);
      color: #ffffff;
      padding: 20px 25px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .modal-title {
      font-size: 18px;
      font-weight: 700;
      text-transform: uppercase;
    }

    .modal-close {
      background: none;
      border: none;
      color: #ffffff;
      font-size: 24px;
      cursor: pointer;
      line-height: 1;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s ease;
    }

    .modal-close:hover {
      background-color: var(--lugx-red);
    }

    .modal-body {
      padding: 30px 25px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      color: var(--lugx-dark);
      margin-bottom: 8px;
    }

    .form-input {
      width: 100%;
      height: 48px;
      border-radius: 24px;
      border: 2px solid var(--lugx-border);
      padding: 0 20px;
      font-size: 14px;
      font-family: inherit;
      outline: none;
      transition: border-color 0.3s ease;
    }

    .form-input:focus {
      border-color: var(--lugx-blue);
    }

    .form-input-custom:focus {
      border-color: var(--lugx-blue);
      background-color: #ffffff;
      box-shadow: 0 0 0 4px rgba(4, 49, 104, 0.1);
    }

    /* Enlarged 2-Column Split Modal for Login */
    .modal-content-split {
      max-width: 940px !important;
      border-radius: 28px !important;
      padding: 0 !important;
      overflow: hidden !important;
      box-shadow: 0 35px 80px rgba(4, 49, 104, 0.5) !important;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .login-modal-grid {
      display: grid;
      grid-template-columns: 1.1fr 1fr;
      min-height: 520px;
    }

    /* Left Side Banner with Building Silhouette Photo Background & Animated Doodle Layer */
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

    /* Floating Doodle Icons inside Login Modal */
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
    .login-doodle.doodle-7 { top: 180px; right: 50px; font-size: 32px; animation-delay: 1.5s; }
    .login-doodle.doodle-8 { bottom: 150px; left: 30px; font-size: 28px; animation-delay: 2.8s; }

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
      font-size: 30px;
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

    .login-banner-footer span {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.8);
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    /* Right Side Form */
    .login-form-side {
      background: #ffffff;
      padding: 40px 40px 35px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      position: relative;
    }

    .login-form-header {
      margin-bottom: 26px;
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

    .login-form-body {
      margin-top: 14px;
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

    .form-group-custom {
      margin-bottom: 24px;
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

    @media (max-width: 768px) {
      .login-modal-grid {
        grid-template-columns: 1fr;
      }
      .login-banner-side {
        display: none;
      }
      .login-form-side {
        padding: 30px 20px;
      }
    }

    .btn-primary-modal {
      width: 100%;
      height: 48px;
      background-color: var(--lugx-red);
      color: #ffffff;
      border: none;
      border-radius: 24px;
      font-size: 15px;
      font-weight: 700;
      text-transform: uppercase;
      cursor: pointer;
      box-shadow: 0 5px 15px rgba(238, 98, 107, 0.4);
      transition: all 0.3s ease;
    }

    .btn-primary-modal:hover {
      background-color: var(--lugx-red-hover);
      box-shadow: 0 8px 20px rgba(238, 98, 107, 0.6);
    }

    /* Responsive Queries */
    @media (max-width: 992px) {
      .banner-container,
      .about-grid,
      .footer-grid {
        grid-template-columns: 1fr;
      }
      .features-container {
        grid-template-columns: repeat(2, 1fr);
      }
      .nav-menu {
        display: none;
      }
      .menu-toggle {
        display: flex;
      }
      .banner-left h2 {
        font-size: 36px;
      }
      .features-section {
        margin-top: 30px;
      }
    }

    @media (max-width: 576px) {
      .features-container,
      .vm-grid {
        grid-template-columns: 1fr;
      }
      .main-banner {
        border-bottom-right-radius: 60px;
        border-bottom-left-radius: 60px;
        padding-top: 140px;
      }
      .footer-area {
        border-top-left-radius: 60px;
        border-top-right-radius: 60px;
      }
    }
  </style>
</head>

<body>
  <!-- HEADER & NAVBAR -->
  <header class="header-area">
    <nav class="main-nav">
      <a href="<?= base_url() ?>" class="logo">
        <img src="<?= base_url('assets/img/LOGO IDE.webp') ?>" alt="IDE Consultant Logo">
        <div class="logo-text">Inti Desain Ekonomi <span> Consultant</span></div>
      </a>

      <!-- Desktop Navigation Menu -->
      <ul class="nav-menu">
        <li class="dropdown">
          <a href="#about" class="nav-item-link">Tentang <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
          <div class="dropdown-content mega-dropdown">
            <div class="mega-grid">
              <div class="mega-column">
                <h4 class="mega-heading">Profil Perusahaan</h4>
                <a href="#about">Sejarah & Visi Misi</a>
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
          <a href="#services" class="nav-item-link">Layanan <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
          <div class="dropdown-content mega-dropdown">
            <div class="mega-grid">
              <div class="mega-column">
                <h4 class="mega-heading">Konsultasi</h4>
                <a href="#services">Konsultasi Ekonomi</a>
                <p class="mega-desc">Pendampingan strategis berbasis data ekonomi.</p>
                <h4 class="mega-heading">Survei & Penelitian</h4>
                <a href="<?= base_url('MenuSurvei') ?>">Survei Kepuasan Masyarakat</a>
                <p class="mega-desc">Metode ilmiah dengan analisis mendalam.</p>
                <h4 class="mega-heading">MasterData</h4>
                <a href="<?= base_url('MasterData') ?>">Repositori Data</a>
              </div>
            </div>
          </div>
        </li>

        <li class="dropdown">
          <a href="#portfolio" class="nav-item-link">Portfolio <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
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
          <a href="#team" class="nav-item-link">Tim <i class="fa-solid fa-chevron-down" style="font-size: 11px;"></i></a>
          <div class="dropdown-content mega-dropdown">
            <div class="mega-grid">
              <div class="mega-column">
                <h4 class="mega-heading">Tim Riset</h4>
                <a href="#team">Profil Riset & Analis</a>
                <h4 class="mega-heading">Tim Ahli</h4>
                <a href="#team">Peneliti & Advisor</a>
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
      <a href="#about" onclick="closeMobileMenu()">Sejarah & Visi Misi</a>
      <a href="<?= base_url('legalitas') ?>">Legalitas & Sertifikasi</a>
    </div>

    <div class="dropbtn" onclick="toggleMobileDropdown(this)">Layanan <i class="fa-solid fa-chevron-down"></i></div>
    <div class="dropdown-content">
      <a href="#services" onclick="closeMobileMenu()">Konsultasi Ekonomi</a>
      <a href="<?= base_url('MenuSurvei') ?>">Survei Kepuasan</a>
      <a href="<?= base_url('MasterData') ?>">MasterData</a>
    </div>

    <div class="dropbtn" onclick="toggleMobileDropdown(this)">Portfolio <i class="fa-solid fa-chevron-down"></i></div>
    <div class="dropdown-content">
      <a href="<?= base_url('MenuPortofolio') ?>">Proyek Selesai</a>
    </div>

    <div class="dropbtn" onclick="toggleMobileDropdown(this)">Tim <i class="fa-solid fa-chevron-down"></i></div>
    <div class="dropdown-content">
      <a href="#team" onclick="closeMobileMenu()">Tim Riset & Ahli</a>
    </div>

    <div style="margin-top: 25px;" class="main-button">
      <a href="#" onclick="openModal('signInModal'); closeMobileMenu(); return false;"><i class="fa-solid fa-right-to-bracket"></i> Masuk</a>
    </div>
  </div>
  <div class="mobile-nav-overlay" id="menuOverlay" onclick="closeMobileMenu()"></div>

  <!-- HERO BANNER SECTION (Lugx Style Banner with Red Gradient Accent) -->
  <section class="main-banner">
    <div class="banner-container">
      <div class="banner-left">
        <h2>Professional Research & Consulting</h2>
        <p>Your trusted partner for innovative economic policy research, fiscal strategy, and professional consulting services.</p>
        <div class="main-button">
          <a href="#about"><i class="fa-solid fa-compass"></i> Jelajahi Layanan Kami</a>
        </div>
      </div>
    </div>
  </section>

  <!-- 4-ITEM FEATURE CARDS SECTION (Lugx Floating Feature Grid) -->
  <section class="features-section">
    <div class="features-container">
      <div class="feature-item">
        <div class="feature-icon">
          <i class="fa-solid fa-chart-line"></i>
        </div>
        <h4>Ekonomi Pembangunan</h4>
        <p>Analisis dan perancangan strategi pembangunan ekonomi daerah berkelanjutan.</p>
      </div>

      <div class="feature-item">
        <div class="feature-icon">
          <i class="fa-solid fa-landmark"></i>
        </div>
        <h4>Fiskal & Kebijakan</h4>
        <p>Pendampingan kebijakan publik dan efisiensi anggaran belanja sektor pemerintah.</p>
      </div>

      <div class="feature-item">
        <div class="feature-icon">
          <i class="fa-solid fa-map-location-dot"></i>
        </div>
        <h4>Perencanaan Regional</h4>
        <p>Penyusunan dokumen induk dan peta jalan pengembangan infrastruktur wilayah.</p>
      </div>

      <div class="feature-item">
        <div class="feature-icon">
          <i class="fa-solid fa-laptop-code"></i>
        </div>
        <h4>Layanan IT & Survey</h4>
        <p>Sistem survei kepuasan berbasis web dan pengolahan data statistik terintegrasi.</p>
      </div>
    </div>
  </section>

  <!-- TRENDING RESEARCH & SERVICES SECTION (Lugx Trending Products) -->
  <section id="services" class="trending-section">
    <div class="trending-container">
      <div class="section-heading-flex">
        <div class="section-heading">
          <span class="subtitle">Program & Layanan</span>
          <h2>Layanan Unggulan Kami</h2>
        </div>
        <div class="main-button">
          <a href="<?= base_url('MenuSurvei') ?>">Lihat Semua Survei</a>
        </div>
      </div>

      <div class="trending-grid">
        <div class="trending-card">
          <div class="trending-thumb">
            <div class="service-icon-box box-survei">
              <div class="service-icon-glow"></div>
              <div class="service-icon-wrapper">
                <i class="fa-solid fa-square-poll-vertical"></i>
              </div>
            </div>
            <span class="category-badge">Survei</span>
          </div>
          <div class="trending-card-body">
            <div class="trending-info">
              <span>Riset Publik</span>
              <h4>Survei Kepuasan SKM</h4>
            </div>
          </div>
        </div>

        <div class="trending-card">
          <div class="trending-thumb">
            <div class="service-icon-box box-kebijakan">
              <div class="service-icon-glow"></div>
              <div class="service-icon-wrapper">
                <i class="fa-solid fa-file-signature"></i>
              </div>
            </div>
            <span class="category-badge">Konsultasi</span>
          </div>
          <div class="trending-card-body">
            <div class="trending-info">
              <span>Kebijakan Publik</span>
              <h4>Desain Kebijakan Ekonomi</h4>
            </div>
          </div>
        </div>

        <div class="trending-card">
          <div class="trending-thumb">
            <div class="service-icon-box box-teknologi">
              <div class="service-icon-glow"></div>
              <div class="service-icon-wrapper">
                <i class="fa-solid fa-laptop-code"></i>
              </div>
            </div>
            <span class="category-badge">Teknologi</span>
          </div>
          <div class="trending-card-body">
            <div class="trending-info">
              <span>Solusi Digital</span>
              <h4>Pembuatan Website & Aplikasi</h4>
            </div>
          </div>
        </div>

        <div class="trending-card">
          <div class="trending-thumb">
            <div class="service-icon-box box-ekonomi">
              <div class="service-icon-glow"></div>
              <div class="service-icon-wrapper">
                <i class="fa-solid fa-chart-line"></i>
              </div>
            </div>
            <span class="category-badge">Ekonomi</span>
          </div>
          <div class="trending-card-body">
            <div class="trending-info">
              <span>Pembangunan Daerah</span>
              <h4>Ekonomi Pembangunan</h4>
            </div>
          </div>
        </div>

        <div class="trending-card">
          <div class="trending-thumb">
            <div class="service-icon-box box-fiskal">
              <div class="service-icon-glow"></div>
              <div class="service-icon-wrapper">
                <i class="fa-solid fa-landmark"></i>
              </div>
            </div>
            <span class="category-badge">Fiskal</span>
          </div>
          <div class="trending-card-body">
            <div class="trending-info">
              <span>Kebijakan Publik</span>
              <h4>Fiskal & Kebijakan Publik</h4>
            </div>
          </div>
        </div>

        <div class="trending-card">
          <div class="trending-thumb">
            <div class="service-icon-box box-regional">
              <div class="service-icon-glow"></div>
              <div class="service-icon-wrapper">
                <i class="fa-solid fa-map-location-dot"></i>
              </div>
            </div>
            <span class="category-badge">Regional</span>
          </div>
          <div class="trending-card-body">
            <div class="trending-info">
              <span>Perencanaan Wilayah</span>
              <h4>Perencanaan Regional</h4>
            </div>
          </div>
        </div>

        <div class="trending-card">
          <div class="trending-thumb">
            <div class="service-icon-box box-manajemen">
              <div class="service-icon-glow"></div>
              <div class="service-icon-wrapper">
                <i class="fa-solid fa-sitemap"></i>
              </div>
            </div>
            <span class="category-badge">Manajemen</span>
          </div>
          <div class="trending-card-body">
            <div class="trending-info">
              <span>Tata Kelola</span>
              <h4>Manajemen</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT & VISION MISSION SECTION -->
  <section id="about" class="about-section">
    <div class="about-container">
      <div class="section-heading">
        <span class="subtitle">Tentang Perusahaan</span>
        <h2>Inti Desain Ekonomi Consultant</h2>
      </div>

      <div class="about-grid">
        <div class="about-text">
          <p>CV Inti Desain Ekonomi (IDE) Consultant adalah perusahaan yang berkomitmen untuk menjadi mitra terpercaya dalam bidang riset dan konsultasi kebijakan ekonomi. Dengan semangat <strong>Be A Professional Researcher And Consultant</strong>, kami hadir untuk memberikan solusi yang inovatif dan berbasis data.</p>
          <p>Berlokasi di Jalan Simpang Ikan Nila II, Perum Nila Residence B6, Kecamatan Blimbing, Kota Malang, kami melayani berbagai kebutuhan penelitian dan konsultasi profesional, baik untuk sektor publik maupun swasta.</p>
          <p>Tim kami terdiri dari para profesional berpengalaman yang berdedikasi untuk menghadirkan hasil riset berkualitas tinggi serta solusi yang mendorong pembangunan ekonomi yang berkelanjutan.</p>
        </div>

        <div class="about-video">
          <iframe width="100%" height="100%" 
                  src="https://www.youtube.com/embed/SKajwW-IaW0"
                  title="Company Video" frameborder="0" 
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                  allowfullscreen></iframe>
        </div>
      </div>

      <div class="vm-grid">
        <div class="vm-card">
          <h3><i class="fa-solid fa-bullseye"></i> Visi Kami</h3>
          <p>Menjadi Perusahaan Yang Profesional, Berkualitas, Inovatif, Unggul, dan Berdaya Saing Dalam Research & Consulting Bidang Desain Kebijakan Ekonomi di Indonesia.</p>
        </div>

        <div class="vm-card">
          <h3><i class="fa-solid fa-rocket"></i> Misi Kami</h3>
          <p>1. Memberikan pelayanan jasa riset dan konsultasi yang professional berdasarkan metode dan analisa yang tepat serta akurat Bidang Desain Kebijakan Ekonomi di Indonesia.</p>
          <p>2. Menghasilkan Hasil Riset dan Konsultasi Yang Berkualitas dan Inovatif Bidang Desain Kebijakan Ekonomi Di Indonesia.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- SPECIAL PROMOTIONAL BANNER SECTION (Lugx CTA Banner with Consultant Theme Doodles & Glow) -->
  <div class="cta-banner">
    <!-- Floating Consultant Theme Doodle Vector Icons -->
    <i class="fa-solid fa-chart-line cta-doodle doodle-1"></i>
    <i class="fa-solid fa-briefcase cta-doodle doodle-2"></i>
    <i class="fa-solid fa-file-signature cta-doodle doodle-3"></i>
    <i class="fa-solid fa-scale-balanced cta-doodle doodle-4"></i>
    <i class="fa-solid fa-chess cta-doodle doodle-5"></i>
    <i class="fa-solid fa-handshake cta-doodle doodle-6"></i>
    <i class="fa-solid fa-magnifying-glass-chart cta-doodle doodle-7"></i>
    <i class="fa-solid fa-coins cta-doodle doodle-8"></i>
    <i class="fa-solid fa-building-columns cta-doodle doodle-9"></i>
    <i class="fa-solid fa-compass cta-doodle doodle-10"></i>

    <div class="cta-banner-content">
      <h2>SIAP BERKOLABORASI DENGAN IDE CONSULTANT ?</h2>
      <p>Hubungi tim profesional kami sekarang untuk mendiskusikan kebutuhan riset, studi kelayakan, dan penyusunan kebijakan ekonomi daerah Anda.</p>
      <div class="main-button">
        <a href="https://wa.me/6282227666283?text=Halo%20Admin%20IDE%20Consultant,%20saya%20ingin%20bertanya..." target="_blank">
          <i class="fa-brands fa-whatsapp"></i> Hubungi Kami via WhatsApp
        </a>
      </div>
    </div>
  </div>

  <!-- PARTNERS / MITRA KAMI SECTION (Marquee Auto Slider) -->
  <section class="partners-section">
    <div class="partners-container">
      <div class="section-heading">
        <span class="subtitle">Mitra & Kemitraan</span>
        <h2>Jejaring Kemitraan Kami</h2>
      </div>

      <div class="partners-slider-wrapper">
        <div class="partners-track">
          <!-- Set 1 -->
          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/jawatimur.jpg') ?>" alt="Jawa Timur">
            </div>
            <h3>Jawa Timur</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kab.ponorogo.png') ?>" alt="Kab. Ponorogo">
            </div>
            <h3>Kab. Ponorogo</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kab.mojokerto.jpg') ?>" alt="Kab. Mojokerto">
            </div>
            <h3>Kab. Mojokerto</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kotablitar.jpg') ?>" alt="Kota Blitar">
            </div>
            <h3>Kota Blitar</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kotamojokerto.jpg') ?>" alt="Kota Mojokerto">
            </div>
            <h3>Kota Mojokerto</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kab.situbondo.jpg') ?>" alt="Kab. Situbondo">
            </div>
            <h3>Kab. Situbondo</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kab.banyuwangi.jpg') ?>" alt="Kab. Banyuwangi">
            </div>
            <h3>Kab. Banyuwangi</h3>
          </div>

          <!-- Set 2 (Duplicate for Seamless Loop) -->
          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/jawatimur.jpg') ?>" alt="Jawa Timur">
            </div>
            <h3>Jawa Timur</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kab.ponorogo.png') ?>" alt="Kab. Ponorogo">
            </div>
            <h3>Kab. Ponorogo</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kab.mojokerto.jpg') ?>" alt="Kab. Mojokerto">
            </div>
            <h3>Kab. Mojokerto</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kotablitar.jpg') ?>" alt="Kota Blitar">
            </div>
            <h3>Kota Blitar</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kotamojokerto.jpg') ?>" alt="Kota Mojokerto">
            </div>
            <h3>Kota Mojokerto</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kab.situbondo.jpg') ?>" alt="Kab. Situbondo">
            </div>
            <h3>Kab. Situbondo</h3>
          </div>

          <div class="partner-card">
            <div class="partner-logo">
              <img src="<?= base_url('assets/img/partner/kab.banyuwangi.jpg') ?>" alt="Kab. Banyuwangi">
            </div>
            <h3>Kab. Banyuwangi</h3>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FULL-WIDTH STATISTICS SECTION (Data Proyek Selesai & Portofolio Kemitraan) -->
  <section class="partners-stats-section">
    <div class="partners-stats-container">
      <div class="stats-header">
        <h3>Statistik Proyek Selesai & Kemitraan</h3>
        <p>Rekam jejak kontribusi CV Inti Desain Ekonomi Consultant dalam penyusunan kebijakan publik, riset pembangunan, dan kemitraan pemerintah daerah</p>
      </div>

      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-icon">
            <i class="fa-solid fa-square-check"></i>
          </div>
          <div class="stat-number" data-target="150" data-suffix="+">0+</div>
          <div class="stat-label">Proyek Selesai</div>
          <div class="stat-desc">Dokumen riset & konsultasi yang telah berhasil dirampungkan</div>
        </div>

        <div class="stat-item">
          <div class="stat-icon">
            <i class="fa-solid fa-building-columns"></i>
          </div>
          <div class="stat-number" data-target="25" data-suffix="+">0+</div>
          <div class="stat-label">Mitra Pemda</div>
          <div class="stat-desc">Pemerintah Daerah & Institusi Kerja Sama</div>
        </div>

        <div class="stat-item">
          <div class="stat-icon">
            <i class="fa-solid fa-file-invoice"></i>
          </div>
          <div class="stat-number" data-target="80" data-suffix="+">0+</div>
          <div class="stat-label">Studi Kebijakan</div>
          <div class="stat-desc">Kajian Akademis & Dokumen Perencanaan Daerah</div>
        </div>

        <div class="stat-item">
          <div class="stat-icon">
            <i class="fa-solid fa-chart-pie"></i>
          </div>
          <div class="stat-number" data-target="99" data-suffix="%">0%</div>
          <div class="stat-label">Tingkat Kepuasan</div>
          <div class="stat-desc">Indeks Kepuasan Klien & Akurasi Rekomendasi Riset</div>
        </div>
      </div>
    </div>
  </section>

  <!-- TEAM SECTION (Lugx Styled Member Showcase) -->
  <section id="team" class="team-section">
    <div class="team-container">
      <div class="section-heading">
        <span class="subtitle">Tim Profesional</span>
        <h2>Struktur & Tim Ahli Kami</h2>
      </div>

      <!-- Core Team -->
      <h3 class="team-cat-heading">Tim Riset</h3>
      <div class="team-grid">
        <div class="team-card">
          <div class="team-img-wrapper">
            <img src="<?= base_url('assets/img/team/foto lama/Noven.webp') ?>" alt="Noventianus Reonaldi W S.E">
          </div>
          <div class="team-info">
            <h4>Noventianus Reonaldi W S.E</h4>
            <p>Coordinator & Researcher Expert</p>
          </div>
        </div>

        <div class="team-card">
          <div class="team-img-wrapper">
            <img src="<?= base_url('assets/img/team/foto lama/Shaba.webp') ?>" alt="Shaba Nada Faizza S.E">
          </div>
          <div class="team-info">
            <h4>Shaba Nada Faizza S.E</h4>
            <p>Commercial & Researcher Expert</p>
          </div>
        </div>

        <div class="team-card">
          <div class="team-img-wrapper">
            <img src="<?= base_url('assets/img/team/foto lama/Rifta.webp') ?>" alt="Rifta Amelia Pratiwi S.E">
          </div>
          <div class="team-info">
            <h4>Rifta Amelia Pratiwi S.E., M.E.</h4>
            <p>Finance & Researcher Expert</p>
          </div>
        </div>

        <div class="team-card">
          <div class="team-img-wrapper">
            <img src="<?= base_url('assets/img/team/foto lama/Dila.webp') ?>" alt="Nurotul Fadilah">
          </div>
          <div class="team-info">
            <h4>Nurotul Fadilah</h4>
            <p>Admin</p>
          </div>
        </div>

        <div class="team-card">
          <div class="team-img-wrapper">
            <img src="<?= base_url('assets/img/team/foto lama/Kaka.webp') ?>" alt="Muhammad Eka N.S">
          </div>
          <div class="team-info">
            <h4>Muhammad Eka S.Kom.</h4>
            <p>IT Specialist</p>
          </div>
        </div>

        <div class="team-card">
          <div class="team-img-wrapper">
            <img src="<?= base_url('assets/img/team/foto lama/Ifam.webp') ?>" alt="If'amunnuri Al Aghutsy">
          </div>
          <div class="team-info">
            <h4>If'amunnuri Al A S.Kom.</h4>
            <p>IT Specialist</p>
          </div>
        </div>
      </div>

      <!-- Support Team -->
      <h3 class="team-cat-heading">Tim Support</h3>
      <div class="team-grid">
        <div class="team-card">
          <div class="team-img-wrapper">
            <img src="<?= base_url('assets/img/team/foto lama/Syinta.webp') ?>" alt="Syinta Novitasari">
          </div>
          <div class="team-info">
            <h4>Syinta Novitasari S.E.</h4>
            <p>Researcher Support</p>
          </div>
        </div>

        <div class="team-card">
          <div class="team-img-wrapper">
            <img src="<?= base_url('assets/img/team/foto lama/titis.webp') ?>" alt="Titis Pramudita Wardani">
          </div>
          <div class="team-info">
            <h4>Titis Pramudita Wardani S.E.</h4>
            <p>Researcher Support</p>
          </div>
        </div>
      </div>

      <!-- Expert Advisors -->
      <h3 class="team-cat-heading">Kolaborasi Para Ahli</h3>
      <div class="team-grid">
        <div class="team-card">
          <div class="team-img-wrapper">
            <img src="<?= base_url('assets/img/team/foto lama/rizka.webp') ?>" alt="Rizka Firstiani S.E., M.E">
          </div>
          <div class="team-info">
            <h4>Rizka Firstiani S.E., M.E.</h4>
            <p>Public Budgeting Expert Advisor</p>
          </div>
        </div>

        <div class="team-card">
          <div class="team-img-wrapper">
            <img src="<?= base_url('assets/img/team/foto lama/faisol.webp') ?>" alt="Nurul Faisol Rahman S.Kom">
          </div>
          <div class="team-info">
            <h4>Nurul Faisol Rahman S.Kom.</h4>
            <p>IT Expert Advisor</p>
          </div>
        </div>

        <div class="team-card">
          <div class="team-img-wrapper">
            <img src="<?= base_url('assets/img/team/foto lama/titov.webp') ?>" alt="Titov Chuk's Mayvani S.E., M.E">
          </div>
          <div class="team-info">
            <h4>Titov Chuk's Mayvani S.E., M.E.</h4>
            <p>Regional Planning Expert Advisor</p>
          </div>
        </div>
      </div>
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
            <a href="https://www.tiktok.com/@intidesainekonomi?_t=ZS-8yox13fLDlf&_r=1" class="social-icon-btn" target="_blank" aria-label="TikTok">
              <i class="fa-brands fa-tiktok"></i>
            </a>
            <a href="https://www.instagram.com/intidesainekonomi?igsh=Zmx2bjk2NjNnNmllt" class="social-icon-btn" target="_blank" aria-label="Instagram">
              <i class="fa-brands fa-instagram"></i>
            </a>
          </div>
        </div>

        <div class="footer-col">
          <h3>Layanan Kami</h3>
          <ul class="footer-links">
            <li><a href="#services">Ekonomi Pembangunan</a></li>
            <li><a href="#services">Fiskal & Kebijakan Publik</a></li>
            <li><a href="#services">Perencanaan Regional</a></li>
            <li><a href="#services">Manajemen</a></li>
            <li><a href="#services">Pembuatan Website & Aplikasi</a></li>
            <li><a href="<?= base_url('MenuSurvei') ?>">Survei Kepuasan SKM</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h3>Tautan Cepat</h3>
          <ul class="footer-links">
            <li><a href="#about">Visi & Misi</a></li>
            <li><a href="#team">Tim Ahli</a></li>
            <li><a href="<?= base_url('MenuPortofolio') ?>">Portofolio Proyek</a></li>
            <li><a href="<?= base_url('legalitas') ?>">Legalitas Usaha</a></li>
            <li><a href="<?= base_url('MasterData') ?>">Repositori Data</a></li>
          </ul>
        </div>
      </div>

      <div class="copyright">
        <p>Copyright © <span id="current-year"></span> CV Inti Desain Ekonomi Consultant. All Rights Reserved. </p>
      </div>
    </div>
  </footer>

  <!-- Floating WhatsApp Button -->
  <a href="https://wa.me/6282227666283?text=Halo%20Admin%20IDE%20Consultant,%20saya%20ingin%20bertanya..." 
     class="whatsapp-float" 
     target="_blank" 
     rel="noopener noreferrer"
     aria-label="Chat via WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
  </a>

  <!-- PORTFOLIO DETAILS MODAL -->
  <div id="ModalPortofolio" class="modal">
    <div class="modal-content" style="max-width: 700px;">
      <div class="modal-header">
        <h3 class="modal-title" id="JudulPortofolio">Detail Portofolio</h3>
        <button class="modal-close" onclick="closeModal('ModalPortofolio')">&times;</button>
      </div>
      <div class="modal-body">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 20px; background: var(--lugx-light-gray); padding: 15px; border-radius: 15px;">
          <div>
            <label style="color: var(--lugx-blue); font-weight: 700; font-size: 12px; text-transform: uppercase;">Tanggal</label>
            <p id="TanggalPortofolio" style="margin: 3px 0 0 0; color: var(--lugx-dark); font-weight: 600; font-size: 13px;">-</p>
          </div>
          <div>
            <label style="color: var(--lugx-blue); font-weight: 700; font-size: 12px; text-transform: uppercase;">Kategori</label>
            <p id="KategoriPortofolio" style="margin: 3px 0 0 0; color: var(--lugx-dark); font-weight: 600; font-size: 13px;">-</p>
          </div>
          <div>
            <label style="color: var(--lugx-blue); font-weight: 700; font-size: 12px; text-transform: uppercase;">Klien</label>
            <p id="KlienPortofolio" style="margin: 3px 0 0 0; color: var(--lugx-dark); font-weight: 600; font-size: 13px;">-</p>
          </div>
        </div>
        <div id="NarasiPortofolio" style="color: var(--lugx-gray); line-height: 1.7; font-size: 14px;">
          Deskripsi portofolio akan muncul di sini...
        </div>
      </div>
    </div>
  </div>

  <!-- SIGN IN MODAL (Enlarged 2-Column Split Modal) -->
  <div id="signInModal" class="modal">
    <div class="modal-content modal-content-split">
      <div class="login-modal-grid">
        <!-- Left Side: Full Animated Doodle Vector Banner -->
        <div class="login-banner-side">
          <!-- Floating Vector Doodle Icons -->
          <i class="fa-solid fa-chart-line login-doodle doodle-1"></i>
          <i class="fa-solid fa-briefcase login-doodle doodle-2"></i>
          <i class="fa-solid fa-file-signature login-doodle doodle-3"></i>
          <i class="fa-solid fa-scale-balanced login-doodle doodle-4"></i>
          <i class="fa-solid fa-chess login-doodle doodle-5"></i>
          <i class="fa-solid fa-handshake login-doodle doodle-6"></i>
          <i class="fa-solid fa-magnifying-glass-chart login-doodle doodle-7"></i>
          <i class="fa-solid fa-building-columns login-doodle doodle-8"></i>

          <div class="login-banner-top" style="position: relative; z-index: 2;">
            <div class="login-brand">
              <img src="<?= base_url('assets/img/LOGO IDE.webp') ?>" alt="IDE Consultant Logo">
              <div class="login-brand-text">Inti Desain Ekonomi <span>Consultant</span></div>
            </div>
          </div>
          <div class="login-banner-center" style="position: relative; z-index: 2;">
            <span class="login-pill" id="adminGreetingPill"><i class="fa-solid fa-sun"></i> Selamat Datang, Admin IDE</span>
            <h2>Professional Research & Consulting Portal</h2>
            <p>Solusi riset & konsultasi kebijakan ekonomi berbasis data tepercaya dan terintegrasi.</p>
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

            <button class="btn-primary-modal btn-login-large" id="Masuk">
              <i class="fa-solid fa-right-to-bracket"></i> Masuk Sekarang
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JQUERY & SCRIPTS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    var BaseURL = '<?= base_url() ?>';

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

    // Set dynamic current year & greeting
    document.addEventListener('DOMContentLoaded', function() {
      var yearElem = document.getElementById('current-year');
      if (yearElem) yearElem.textContent = new Date().getFullYear();
      updateAdminGreeting();
    });

    // Modal Helpers
    function openModal(modalId) {
      var targetModal = document.getElementById(modalId);
      if (targetModal) {
        targetModal.classList.add('active');
        if (modalId === 'signInModal') updateAdminGree  ting();
      }
    }

    function closeModal(modalId) {
      var targetModal = document.getElementById(modalId);
      if (targetModal) targetModal.classList.remove('active');
    }

    window.onclick = function(event) {
      if (event.target.classList.contains('modal')) {
        event.target.classList.remove('active');
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

    // Animated Counter for Statistics Section (Scroll Triggered)
    document.addEventListener('DOMContentLoaded', function() {
      var statNumbers = document.querySelectorAll('.stat-number');
      var animated = false;

      function animateCounters() {
        statNumbers.forEach(function(counter) {
          var target = parseInt(counter.getAttribute('data-target'), 10);
          var suffix = counter.getAttribute('data-suffix') || '';
          var duration = 2000;
          var startTime = null;

          function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var easeProgress = 1 - Math.pow(1 - progress, 3);
            var currentCount = Math.floor(easeProgress * target);

            counter.textContent = currentCount + suffix;

            if (progress < 1) {
              window.requestAnimationFrame(step);
            } else {
              counter.textContent = target + suffix;
            }
          }

          window.requestAnimationFrame(step);
        });
      }

      var statsWrapper = document.querySelector('.partners-stats-section');
      if (statsWrapper && 'IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting && !animated) {
              animated = true;
              animateCounters();
            }
          });
        }, { threshold: 0.3 });

        observer.observe(statsWrapper);
      } else {
        animateCounters();
      }
    });

    // jQuery Login & Portfolio Handlers (Preserved CodeIgniter AJAX Handlers)
    jQuery(document).ready(function($) {
      "use strict"; 

      $('#Username, #Password').keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
          event.preventDefault();
          document.getElementById("Masuk").click();  
        }
      });
      
      $("#Masuk").click(function() {
        var Akun = { 
          Username: $("#Username").val(),
          Password: $("#Password").val() 
        };
        
        $.post(BaseURL + "IDE/SignIn", Akun).done(function(Respon) {
          if (Respon == '1') {
            window.location = BaseURL + "SuperAdmin";
          } else if (Respon == '2') {
            window.location = BaseURL + "Admin";
          } else if (Respon == '3') {
            window.location = BaseURL + "Staf";
          } else if (Respon == '4') {
            window.location = BaseURL + "Econk";
          } else {
            alert(Respon);
          }
        }).fail(function() {
          alert('Login failed. Please try again.');
        });                         
      });
    
      $(document).on("click", ".Portofolio", function(){
        var portfolioId = $(this).attr('Portofolio');
        
        $.post(BaseURL + "IDE/GetPortofolio/" + portfolioId).done(function(Respon) {
          try {
            var Portofolio = JSON.parse(Respon);
            $("#JudulPortofolio").html(Portofolio.Judul);
            $("#TanggalPortofolio").html(Portofolio.Tanggal);
            $("#KategoriPortofolio").html(Portofolio.Kategori);
            $("#KlienPortofolio").html(Portofolio.Klien);
            $("#NarasiPortofolio").html(Portofolio.Narasi);
            openModal('ModalPortofolio');
          } catch (e) {
            console.error('Error parsing portfolio data:', e);
            alert('Error loading portfolio data');
          }
        }).fail(function() {
          alert('Failed to load portfolio data');
        });
      });
    });
  </script>
</body>
</html>