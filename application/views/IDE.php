<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>IDE Consultant</title>
  <meta content="Professional Research & Consulting" name="description">
  <meta content="consulting, research, economic development" name="keywords">
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --apple-blue: #007AFF;
      --apple-gray: #F2F2F7;
      --apple-dark: #1D1D1F;
      --apple-text: #1D1D1F;
      --apple-secondary: rgba(61, 61, 196, 1);
      --apple-white: #FFFFFF;
      --apple-light-gray: #F5F5F7;
      --apple-border: #D2D2D7;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      line-height: 1.6;
      color: var(--apple-text);
      background: var(--apple-white);
      overflow-x: hidden;
    }

    /* Header */
    .header {
      position: fixed;
      top: 0;
      width: 100%;
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--apple-border);
      z-index: 1000;
      transition: all 0.3s ease;
    }

    .header-content {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 64px;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .logo img {
      width: 36px;
      height: 36px;
      border-radius: 8px;
    }

    .logo-text {
      font-size: 20px;
      font-weight: 600;
      color: var(--apple-text);
    }

    .nav-menu {
      display: flex;
      list-style: none;
      gap: 32px;
      margin-left: auto;
    }

    .nav-menu a {
      text-decoration: none;
      color: var(--apple-text);
      font-weight: 400;
      font-size: 15px;
      transition: color 0.3s ease;
      position: relative;
    }

    .nav-menu a:hover {
      color: #001F3F;
    }

    .nav-menu a::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 0;
      height: 2px;
      background: #001F3F;
      transition: width 0.3s ease;
    }

    .nav-menu a:hover::after {
      width: 100%;
    }

    .hero {
      height: 100vh;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      text-align: left;
      padding-left: 5%;
      overflow: hidden;
    }

    .hero-slider {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1;
    }

    .hero-slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      background-position: center;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    .hero-slide.active {
      opacity: 1;
    }

    .hero-content {
      max-width: 700px;
      padding: 0 24px;
      position: relative;
      z-index: 2;
    }

    .slider-nav {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 10px;
      z-index: 2;
    }

    .slider-dot {
      width: 10px;
      height: 10px;
      background: rgba(255, 255, 255, 0.5);
      border-radius: 50%;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .slider-dot.active {
      background: var(--apple-blue);
    }

    .slider-prev,
    .slider-next {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(0, 0, 0, 0.5);
      color: white;
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      font-size: 20px;
      cursor: pointer;
      z-index: 2;
      transition: background 0.3s ease;
    }

    .slider-prev:hover,
    .slider-next:hover {
      background: rgba(0, 0, 0, 0.7);
    }

    .slider-prev {
      left: 20px;
    }

    .slider-next {
      right: 20px;
    }

    .hero-content {
      max-width: 700px;
      padding: 0 24px;
      position: relative;
      z-index: 2;
    }

    .hero h1 {
      font-size: clamp(32px, 3.5vw, 15px);
      font-weight: 700;
      margin-bottom: 24px;
      background: linear-gradient(135deg, #001F3F 0%, var(--apple-blue) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .hero p {
      font-size: 18px;
      color: var(--apple-secondary);
      margin-bottom: 32px;
      max-width: 550px;
    }

    .cta-button {
      display: inline-block;
      padding: 12px 28px;
      background: #001F3F;
      color: white;
      text-decoration: none;
      border-radius: 24px;
      font-weight: 500;
      font-size: 15px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 122, 255, 0.3);
    }

    .cta-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 122, 255, 0.4);
    }

    /* Section Styles */
    .section {
      padding: 80px 0;
      max-width: 1200px;
      margin: 0 auto;
      padding-left: 24px;
      padding-right: 24px;
    }

    .section-title {
      text-align: center;
      margin-bottom: 48px;
    }

    .title-expert p {
        font-size: 16px;
      color: var(--apple-text);
      max-width: 1000px;
      margin: 0 auto;
      margin-bottom: 30px;
      text-align: center;
    }

    .section-title h2 {
      font-size: clamp(28px, 4vw, 36px);
      font-weight: 600;
      margin-bottom: 12px;
      color: var(--apple-text);
    }

    .section-title p {
      font-size: 16px;
      color: var(--apple-text);
      max-width: 550px;
      margin: 0 auto;
    }

    /* About Section */
    .about {
      display: cover;
      background: var(--apple-white);
    }

    .about-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 48px;
      align-items: center;
    }

    .about-text {
      font-size: 15px;
      text-align: justify;
      line-height: 1.7;
      color: var(--apple-text);
      background: #fff;
      padding: 28px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
      border: 1px solid #e0e0e0;
    }

    .about-video {
      position: relative;
      padding-bottom: 56.25%;
      height: 0;
      overflow: hidden;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .about-video iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: none;
    }

    .vision-mission {
      font-size: 16px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 32px;
      margin-top: 48px;
    }

    .vm-card {
      background: linear-gradient(135deg, #001F3F 0%, #0056b3 100%);
      padding: 32px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
      color: var(--apple-white);
    }

    .vm-card:hover {
      transform: translateY(-5px);
    }

    .vm-card h3 {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 16px;
      color: var(--apple-white);
    }

    .vm-card p {
      color: rgba(255, 255, 255, 0.9);
      font-size: 15px;
      line-height: 1.6;
    }

    /* Services Section */
    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 24px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .service-card {
      background: white;
      padding: 32px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 6px 20px rgba(0, 31, 63, 0.08);
      transition: all 0.3s ease;
      border: 1px solid rgba(0, 31, 63, 0.1);
    }

    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 31, 63, 0.12);
      border-color: rgba(0, 31, 63, 0.2);
    }

    .service-icon {
      width: 64px;
      height: 64px;
      background: linear-gradient(135deg, #001F3F 0%, #0056b3 100%);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      color: white;
    }

    .service-icon svg {
      width: 32px;
      height: 32px;
    }

    .service-card h3 {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 12px;
      color: #001F3F;
    }

    /* Portfolio Section */
    .portfolio {
      padding: 80px 0;
    }

    .portfolio-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
      margin-top: 32px;
    }

    .portfolio-item {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 6px 20px rgba(0, 31, 63, 0.1);
      transition: all 0.3s ease;
    }

    .portfolio-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 31, 63, 0.15);
    }

    .portfolio-image {
      height: 180px;
      position: relative;
      overflow: hidden;
    }

    .portfolio-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .portfolio-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(to bottom, transparent 0%, rgba(0, 31, 63, 0.7) 100%);
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .portfolio-item:hover .portfolio-overlay {
      opacity: 1;
    }

    .portfolio-item:hover .portfolio-image img {
      transform: scale(1.05);
    }

    .portfolio-content {
      padding: 20px;
      background: linear-gradient(135deg, #001F3F 0%, #0056b3 100%);
      color: white;
    }

    .portfolio-category {
      display: inline-block;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: rgba(255, 255, 255, 0.8);
      margin-bottom: 8px;
    }

    .portfolio-title {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 12px;
      color: white;
    }

    .portfolio-link {
      display: inline-block;
      padding: 8px 20px;
      background: white;
      color: #001F3F;
      text-decoration: none;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .portfolio-link:hover {
      background: rgba(255, 255, 255, 0.9);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .portfolio-filter {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 24px;
    }
    .filter-btn:hover,
.filter-btn.active {
  background: #001F3F;
  color: white;
  border-color: #001F3F;
}

.show-more-btn {
  display: block;
  margin: 24px auto 0;
  padding: 12px 28px;
  background: #001F3F;
  color: white;
  border: none;
  border-radius: 24px;
  font-size: 15px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(0, 122, 255, 0.3);
}

.show-more-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 122, 255, 0.4);
}

    .filter-btn {
      padding: 8px 20px;
      background: white;
      color: #001F3F;
      border: 1px solid rgba(0, 31, 63, 0.2);
      border-radius: 20px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .filter-btn:hover, .filter-btn.active {
      background: #001F3F;
      color: white;
      border-color: #001F3F;
    }

    /* Team Section */
    .team-section {
  margin-bottom: 48px;
}

.team-category {
  text-align: center;
  font-size: 1.3rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 24px;
  position: relative;
}

.team-category::after {
  content: '';
  display: block;
  width: 50px;
  height: 2px;
  background: #001F3F;
  margin: 8px auto 0;
}

.core-team, .support-team {
  display: grid;
  grid-template-columns: repeat(3, minmax(280px, 1fr));
  gap: 24px;
  max-width: 960px; /* 3 cards * (280px + 24px gap) = 912px + padding */
  margin: 0 auto;
  justify-content: center;
  align-items: center;
}

.team-card {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  width: 100%;
  max-width: 300px;
  background: white;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.team-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
}

.team-image {
  height: 240px;
  width: 100%;
  overflow: hidden;
  position: relative;
}

.team-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.team-card:hover .team-image img {
  transform: scale(1.05);
}

.team-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(to top, rgba(0, 31, 63, 0.7) 0%, transparent 50%);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.team-card:hover .team-overlay {
  opacity: 1;
}

.team-info {
  padding: 20px;
  text-align: center;
  background: linear-gradient(135deg, #001F3F 0%, #0056b3 100%) !important;
  color: white;
  width: 100%;
  box-sizing: border-box;
}

.team-line {
  width: 40px;
  height: 2px;
  background: white;
  margin: 10px auto;
  transition: width 0.3s ease;
}

.team-card:hover .team-line {
  width: 60px;
}

.team-name {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 6px;
  color: var(--apple-white);
}

.team-role {
  color: rgba(255, 255, 255, 0.9);
  font-size: 0.85rem;
  font-weight: 500;
}

/* Responsive Design */
@media (max-width: 992px) {
  .core-team, .support-team {
    grid-template-columns: repeat(2, minmax(280px, 1fr));
    max-width: 640px; /* 2 cards * (280px + 24px gap) = 584px + padding */
    justify-content: center;
  }
}

@media (max-width: 768px) {
  .core-team, .support-team {
    grid-template-columns: 1fr;
    max-width: 320px; /* 1 card = 280px + padding */
    justify-content: center;
  }
}

@media (max-width: 576px) {
  .core-team, .support-team {
    grid-template-columns: 1fr;
    max-width: 320px;
    justify-content: center;
  }

  .team-image {
    height: 220px;
  }
}

    /* Partners Section */
    #partners {
      padding: 60px 0;
      overflow: hidden;
    }

    .partners-container {
      max-width: 1000px;
      margin: 0 auto;
      position: relative;
      overflow: hidden;
      cursor: grab;
    }

    .partners-container.grabbing {
      cursor: grabbing;
    }

    .partners-track {
      display: flex;
      gap: 24px;
      padding: 16px 0;
      width: max-content;
      animation: scroll 30s linear infinite;
    }

    @keyframes scroll {
      0% {
        transform: translateX(0);
      }
      100% {
        transform: translateX(calc(-50% - 12px));
      }
    }

    .partner-card {
      flex: 0 0 150px;
      background: white;
      padding: 16px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      user-select: none;
    }

    .partner-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .partner-logo {
      width: 70px;
      height: 70px;
      margin: 0 auto 12px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f8f9fa;
      padding: 8px;
    }

    .partner-logo img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }

    .partner-card h3 {
      font-size: 13px;
      font-weight: 600;
      margin-top: 8px;
      color: #333;
    }

    .partners-container.paused .partners-track {
      animation-play-state: paused;
    }

    /* Contact Section */
    .ide-contact {
      background: #001F3F;
      padding: 80px 24px;
      position: relative;
      overflow: hidden;
      color: white;
    }

    .contact-container {
      max-width: 1200px;
      margin: 0 auto;
      position: relative;
      z-index: 2;
    }

    .contact-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .contact-header h2 {
      font-size: 1.8rem;
      margin-bottom: 12px;
      color: white;
    }

    .contact-header p {
      color: rgba(255, 255, 255, 0.85);
      max-width: 600px;
      margin: 0 auto;
      font-size: 15px;
    }

    .contact-content {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 32px;
      margin-top: 24px;
    }

    .contact-info {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }

    .office-info h3,
    .services h3,
    .links-column h3 {
      font-size: 1rem;
      color: white;
      margin-bottom: 12px;
      padding-bottom: 8px;
      border-bottom: 2px solid #007AFF;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .office-info p {
      color: rgba(255, 255, 255, 0.85);
      line-height: 1.7;
      margin-bottom: 12px;
      display: flex;
      align-items: flex-start;
      gap: 8px;
      font-size: 14px;
    }

    .office-info .icon {
      font-size: 1rem;
      margin-top: 0.15rem;
    }

    .services ul,
    .links-column ul {
      list-style: none;
      padding: 0;
    }

    .services li,
    .links-column li {
      color: rgba(255, 255, 255, 0.85);
      margin-bottom: 8px;
      padding-left: 1rem;
      position: relative;
      transition: all 0.3s ease;
      font-size: 14px;
    }

    .services li::before,
    .links-column li::before {
      content: "•";
      color: #007AFF;
      position: absolute;
      left: 0;
      font-weight: bold;
    }

    .services li:hover,
    .links-column li:hover {
      color: white;
      transform: translateX(5px);
    }

    .company-links {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }

    .copyright {
      text-align: center;
      margin-top: 32px;
      padding-top: 16px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: rgba(255, 255, 255, 0.6);
      font-size: 13px;
    }

    #current-year {
      font-weight: 500;
    }

    .social-links {
  margin-top: 24px;
}

.social-links h3 {
  font-size: 1rem;
  color: white;
  margin-bottom: 12px;
  padding-bottom: 8px;
  border-bottom: 2px solid var(--apple-blue);
  font-weight: 600;
  letter-spacing: 0.5px;
}

.social-links-container {
  display: flex;
  justify-content: center;
  gap: 16px;
  flex-wrap: wrap;
}

.social-link {
  display: inline-block;
  transition: transform 0.3s ease;
}

.social-link img {
  width: 32px;
  height: 32px;
  object-fit: contain;
  filter: brightness(100%);
  transition: filter 0.3s ease;
}

.social-link:hover {
  transform: translateY(-3px);
}

.social-link:hover img {
  filter: brightness(120%);
}

/* Responsive Design */
@media (max-width: 768px) {
  .social-links-container {
    gap: 12px;
  }

  .social-link img {
    width: 28px;
    height: 28px;
  }
}

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      z-index: 2000;
      align-items: center;
      justify-content: center;
    }

    .modal.active {
      display: flex;
    }

    .modal-content {
      background: white;
      border-radius: 16px;
      max-width: 480px;
      width: 90%;
      max-height: 90vh;
      overflow-y: auto;
      position: relative;
    }

    .modal-header {
      padding: 24px 24px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-title {
      font-size: 22px;
      font-weight: 600;
      color: var(--apple-text);
    }

    .modal-close {
      width: 28px;
      height: 28px;
      border: none;
      background: var(--apple-gray);
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      color: var(--apple-secondary);
    }

    .modal-body {
      padding: 24px;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
      color: var(--apple-text);
      font-size: 14px;
    }

    .form-input {
      width: 100%;
      padding: 12px;
      border: 1px solid var(--apple-border);
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }

    .form-input:focus {
      outline: none;
      border-color: #001F3F;
    }

    .btn-primary {
      width: 100%;
      padding: 12px;
      background: #001F3F;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn-primary:hover {
      background: #0056CC;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
      .services-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
      }

      .portfolio-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .core-team, .support-team {
        grid-template-columns: repeat(2, 1fr);
      }

      .about-content {
        grid-template-columns: 1fr;
        gap: 24px;
      }

      .vision-mission {
        grid-template-columns: 1fr;
        gap: 24px;
      }

      .contact-content {
        grid-template-columns: 1fr;
      }

      .company-links {
        margin-top: 24px;
      }
    }

    @media (max-width: 768px) {
      .nav-menu {
        display: none;
      }

      .services-grid {
        grid-template-columns: 1fr;
        max-width: 500px;
        margin: 0 auto;
      }

      .portfolio-grid {
        grid-template-columns: 1fr;
        max-width: 500px;
        margin: 0 auto;
      }

      .core-team, .support-team {
        grid-template-columns: 1fr;
        max-width: 500px;
        margin: 0 auto;
      }

      .section {
        padding: 60px 0;
      }

      .contact-info {
        grid-template-columns: 1fr;
      }

      .contact-header h2 {
        font-size: 1.6rem;
      }

      .contact-header p {
        font-size: 0.9rem;
      }

      .partners-track {
        gap: 20px;
      }

      .partner-card {
        flex: 0 0 140px;
        padding: 14px;
      }

      .partner-logo {
        width: 60px;
        height: 60px;
      }
    }

    @media (max-width: 576px) {
      .core-team, .support-team {
        grid-template-columns: 1fr;
        max-width: 320px;
      }

      .team-image {
        height: 220px;
      }

      .hero h1 {
        font-size: clamp(28px, 3vw, 32px);
      }

      .hero p {
        font-size: 16px;
      }
    }

    /* Smooth scrolling */
    html {
      scroll-behavior: smooth;
    }

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in-up {
      animation: fadeInUp 0.8s ease forwards;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: var(--apple-gray);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--apple-secondary);
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--apple-text);
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="header">
    <div class="header-content">
      <div class="logo">
        <a><img src="assets/img/logo.png" alt="LogoIDE"></a>  
        <span class="logo-text">Inti Desain Ekonomi Consultant</span>
      </div>
      <nav class="nav-menu">
        <a href="#about">About</a>
        <a href="#services">Services</a>
        <a href="#portfolio">Portfolio</a>
        <a href="#team">Team</a>
        <a href="#" onclick="openModal('signInModal')">Sign In</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-slider">
      <div class="hero-slide" style="background-image: url('assets/img/background/banner5.png');"></div>
      <div class="hero-slide" style="background-image: url('assets/img/background/banner2.png');"></div>
      <div class="hero-slide" style="background-image: url('assets/img/background/banner6.png');"></div>
    </div>
    <div class="slider-nav">
      <div class="slider-dot active"></div>
      <div class="slider-dot"></div>
    </div>
    <button class="slider-prev">❮</button>
    <button class="slider-next">❯</button>
    <div class="hero-content">
      <h1>Professional Research & Consulting</h1>
      <p>Your trusted partner for innovative economic policy research and professional consulting services</p>
      <a href="#about" class="cta-button">Selengkapnya </a>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="section about">
    <div class="section-title">
      <h2>Tentang Kami</h2>
      <p> Sebagai yang terdepan dalam layanan riset dan konsultasi profesional, kami berkomitmen penuh untuk memberikan solusi terbaik bagi klien.</p>
    </div>
    
    <div class="about-content">
      <div class="about-text">
        <p>CV Inti Desain Ekonomi (IDE) Consultant adalah perusahaan yang berkomitmen untuk menjadi mitra terpercaya dalam bidang riset dan konsultasi kebijakan ekonomi. Dengan semangat Be A Professional Researcher And Consultant, kami hadir untuk memberikan solusi yang inovatif dan berbasis data.</p>
        <p>Berlokasi di Jalan Simpang Ikan Nila II, Perum Nila Residence B6, Kecamatan Blimbing, Kota Malang, kami melayani berbagai kebutuhan penelitian dan konsultasi profesional, baik untuk sektor publik maupun swasta.</p>
        <p>Tim kami terdiri dari para profesional berpengalaman yang berdedikasi untuk menghadirkan hasil riset berkualitas tinggi serta solusi yang mendorong pembangunan ekonomi yang berkelanjutan.</p>
      </div>
      
      <div class="about-video">
        <iframe width="100%" height="100%" 
                src="https://www.youtube.com/embed/bipPIXtv7pA" 
                title="Company Video" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen></iframe>
      </div>
    </div>

    <div class="vision-mission">
      <div class="vm-card">
        <h3>Visi</h3>
        <p>Menjadi Perusahaan Yang Profesional, Berkualitas, Inovatif, Unggul, dan Berdaya Saing Dalam Research & Consulting Bidang Desain Kebijakan Ekonomi di Indonesia</p>
      </div>
      
      <div class="vm-card">
        <h3>Misi</h3>
        <p>1. Memberikan pelayanan jasa riset dan konsultasi yang professional berdasarkan metode dan analisa yang tepat serta akurat Bidang Desain Kebijakan Ekonomi di Indonesia.</p>
        <p>2. Menghasilkan Hasil Riset dan Konsultasi Yang Berkualitas dan Inovatif Bidang Desain Kebijakan Ekonomi Di Indonesia</p>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="section">
    <div class="section-title">
      <h2>Layanan Kami</h2>
      <p>Menyediakan solusi konsultasi komprehensif yang disesuaikan secara spesifik untuk memenuhi kebutuhan unik Anda.</p>
    </div>
    
    <div class="services-grid">
      <div class="service-card">
        <div class="service-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2L2 7v10l10 5 10-5V7L12 2zm0 2.8L20 9v6l-8 4-8-4V9l8-4.2z"/>
            <path d="M12 16l-5-3v-2l5 3 5-3v2l-5 3z"/>
          </svg>
        </div>
        <h3>Economic Development</h3>
      </div>
      
      <div class="service-card">
        <div class="service-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
            <path d="M7 12h2v5H7zm4-7h2v12h-2zm4 4h2v8h-2z"/>
          </svg>
        </div>
        <h3>Fiscal & Public Policy</h3>
      </div>
      
      <div class="service-card">
        <div class="service-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
          </svg>
        </div>
        <h3>Regional Planning</h3>
      </div>
      
      <div class="service-card">
        <div class="service-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
          </svg>
        </div>
        <h3>Management</h3>
      </div>
    </div>
  </section>

  <!-- Portfolio Section
  <section id="portfolio" class="section portfolio">
  <div class="section-title">
    <h2>Portofolio Kami</h2>
    <p>Jejak Langkah Kami: Sebuah galeri proyek dan pencapaian yang mencerminkan keahlian kami.</p>
  </div>
  
  <div class="portfolio-filter">
    <button class="filter-btn active" data-filter="all">All</button>
    <button class="filter-btn" data-filter="Economic Development">Economic Development</button>
    <button class="filter-btn" data-filter="Public Policy">Public Policy</button>
    <button class="filter-btn" data-filter="Regional Planning">Regional Planning</button>
    <button class="filter-btn" data-filter="Management">Management</button>
  </div>
  
  <div class="portfolio-grid">
    <div class="portfolio-item" data-category="Economic Development">
      <div class="portfolio-image">
        <img src="assets/img/portfolio/portfolio-details-2.jpg" alt="Regional Economic Analysis">
        <div class="portfolio-overlay"></div>
      </div>
      <div class="portfolio-content">
        <span class="portfolio-category">Economic Development</span>
        <h3 class="portfolio-title">Regional Economic Analysis</h3>
        <a href="#portfolio" class="portfolio-link Portofolio" data-portfolio-id="1">View Details</a>
      </div>
    </div>
    
    <div class="portfolio-item" data-category="Public Policy">
      <div class="portfolio-image">
        <img src="assets/img/portfolio/portfolio-details-3.jpg" alt="Policy Impact Assessment">
        <div class="portfolio-overlay"></div>
      </div>
      <div class="portfolio-content">
        <span class="portfolio-category">Public Policy</span>
        <h3 class="portfolio-title">Policy Impact Assessment</h3>
        <a href="#portfolio" class="portfolio-link Portofolio" data-portfolio-id="2">View Details</a>
      </div>
    </div>
    
    <div class="portfolio-item" data-category="Regional Planning">
      <div class="portfolio-image">
        <img src="assets/img/portfolio/portfolio-details-1.jpg" alt="Urban Development Strategy">
        <div class="portfolio-overlay"></div>
      </div>
      <div class="portfolio-content">
        <span class="portfolio-category">Regional Planning</span>
        <h3 class="portfolio-title">Urban Development Strategy</h3>
        <a href="#portfolio" class="portfolio-link Portofolio" data-portfolio-id="3">View Details</a>
      </div>
    </div>
    
    <div class="portfolio-item" data-category="Management">
      <div class="portfolio-image">
        <img src="assets/img/portfolio/ekonomi.jpeg" alt="Organizational Development">
        <div class="portfolio-overlay"></div>
      </div>
      <div class="portfolio-content">
        <span class="portfolio-category">Management</span>
        <h3 class="portfolio-title">Organizational Development</h3>
        <a href="#portfolio" class="portfolio-link Portofolio" data-portfolio-id="4">View Details</a>
      </div>
    </div>
    
    <div class="portfolio-item" data-category="Management">
      <div class="portfolio-image">
        <img src="assets/img/portfolio/ekonomi.jpeg" alt="Organizational Development">
        <div class="portfolio-overlay"></div>
      </div>
      <div class="portfolio-content">
        <span class="portfolio-category">Management</span>
        <h3 class="portfolio-title">Organizational Development</h3>
        <a href="#portfolio" class="portfolio-link Portofolio" data-portfolio-id="5">View Details</a>
      </div>
    </div>
    
    <div class="portfolio-item" data-category="Management">
      <div class="portfolio-image">
        <img src="assets/img/portfolio/ekonomi.jpeg" alt="Organizational Development">
        <div class="portfolio-overlay"></div>
      </div>
      <div class="portfolio-content">
        <span class="portfolio-category">Management</span>
        <h3 class="portfolio-title">Organizational Development</h3>
        <a href="#portfolio" class="portfolio-link Portofolio" data-portfolio-id="6">View Details</a>
      </div>
    </div>
    
    <div class="portfolio-item" data-category="Management">
      <div class="portfolio-image">
        <img src="assets/img/portfolio/ekonomi.jpeg" alt="Organizational Development">
        <div class="portfolio-overlay"></div>
      </div>
      <div class="portfolio-content">
        <span class="portfolio-category">Management</span>
        <h3 class="portfolio-title">Organizational Development</h3>
        <a href="#portfolio" class="portfolio-link Portofolio" data-portfolio-id="7">View Details</a>
      </div>
    </div>
    
    <div class="portfolio-item" data-category="Management">
      <div class="portfolio-image">
        <img src="assets/img/portfolio/ekonomi.jpeg" alt="Organizational Development">
        <div class="portfolio-overlay"></div>
      </div>
      <div class="portfolio-content">
        <span class="portfolio-category">Management</span>
        <h3 class="portfolio-title">Organizational Development</h3>
        <a href="#portfolio" class="portfolio-link Portofolio" data-portfolio-id="8">View Details</a>
      </div>
    </div>
  </div>
  <button class="show-more-btn" id="showMoreBtn">Show More</button>
</section> -->
  <!-- Partners Section -->
  <section id="partners" class="section">
    <div class="section-title">
      <h2>Our Partners</h2>
      <p>Jejaring Kemitraan Kami: Bersinergi untuk Mencapai Tujuan Bersama.</p>
    </div>
    
    <div class="partners-container">
      <div class="partners-track">
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/jawatimur.jpg" alt="Jawa Timur">
          </div>
          <h3>Jawa Timur</h3>
        </div>
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/kab.ponorogo.png" alt="Kab. Ponorogo">
          </div>
          <h3>Kab. Ponorogo</h3>
        </div>
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/kab.mojokerto.jpg" alt="Kab. Mojokerto">
          </div>
          <h3>Kab. Mojokerto</h3>
        </div>
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/kotablitar.jpg" alt="Partner 3">
          </div>
          <h3>Kota Blitar</h3>
        </div>
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/kotamojokerto.jpg" alt="Partner 4">
          </div>
          <h3>Kota Mojokerto</h3>
        </div>
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/kab.situbondo.jpg" alt="Partner 5">
          </div>
          <h3>Kab. Situbondo</h3>
        </div>
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/kab.banyuwangi.jpg" alt="Partner 6">
          </div>
          <h3>Kab. Banyuwangi</h3>
        </div>
        
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/jawatimur.jpg" alt="Jawa Timur">
          </div>
          <h3>Jawa Timur</h3>
        </div>
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/kab.mojokerto.jpg" alt="Kab. Mojokerto">
          </div>
          <h3>Kab. Mojokerto</h3>
        </div>
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/kotablitar.jpg" alt="Partner 3">
          </div>
          <h3>Kota Blitar</h3>
        </div>
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/kotamojokerto.jpg" alt="Partner 4">
          </div>
          <h3>Kota Mojokerto</h3>
        </div>
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/kab.situbondo.jpg" alt="Partner 5">
          </div>
          <h3>Kab. Situbondo</h3>
        </div>
        <div class="partner-card">
          <div class="partner-logo">
            <img src="assets/img/partner/kab.banyuwangi.jpg" alt="Partner 6">
          </div>
          <h3>Kab. Banyuwangi</h3>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section id="team" class="section">
    <div class="section-title">
      <h2>Our Team</h2>
      <p>Kenali Tim Profesional Kami yang Siap Memberikan Solusi Terbaik.</p>
    </div>

    <!-- Core Team -->
    <div class="team-section">
      <h3 class="team-category">Researcher Team</h3>
      <div class="team-grid core-team">
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/Noven.png" alt="Noven">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">Noventianus Reonaldi W  S.E</h3>
            <p class="team-role">Coordinator & Researcher Expert</p>
            <div class="team-line"></div>
          </div>
        </div>
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/Shaba.png" alt="Shaba">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">Shaba Nada Faizza S.E</h3>
            <p class="team-role">Commercial & Researcher Expert</p>
            <div class="team-line"></div>
          </div>
        </div>
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/Rifta.png" alt="Rifta">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">Rifta Amelia Pratiwi S.E</h3>
            <p class="team-role">Finance & Researcher Expert</p>
            <div class="team-line"></div>
          </div>
        </div>
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/Dila.png" alt="Dila">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">Nurotul Fadilah</h3>
            <p class="team-role">Admin</p>
            <div class="team-line"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Support Team -->
    <div class="team-section">
      <h3 class="team-category">Support Team</h3>
      <div class="team-grid support-team">
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/Syinta.png" alt="Syinta">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">Syinta Novitasari</h3>
            <p class="team-role">Researcher Support</p>
            <div class="team-line"></div>
          </div>
        </div>
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/Mahrus.png" alt="Mahrus">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">Mahrus Ali</h3>
            <p class="team-role">Researcher Support</p>
            <div class="team-line"></div>
          </div>
        </div>
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/titis.png" alt="titis">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">Titis Pramudita Wardani</h3>
            <p class="team-role">Researcher Support</p>
            <div class="team-line"></div>
          </div>
        </div>
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/Kaka.png   " alt="Kaka">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">Muhammad Eka Nur Sucianto</h3>
            <p class="team-role">IT Specialist</p>
            <div class="team-line"></div>
          </div>
        </div>
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/Ifam.png" alt="Ifam">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">If'amunnuri Al Aghutsy</h3>
            <p class="team-role">IT Specialist</p>
            <div class="team-line"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- External Team -->
    <div class="team-section">
      <h3 class="team-category">External Expert Collaboration</h3>
       <div class="title-expert">
      <p>CV Inti Desain Ekonomi (IDE) terus mengembangkan profesionalitas dan keahlian dengan berkolaborasi 
        bersama para ahli eksternal, baik akademisi maupun praktisi dari sektor swasta dan pemerintah, 
        sebagai mitra untuk berbagi wawasan, pengalaman,dan solusi nyata demi menghasilkan inovasi yang bermanfaat.</p>
    </div>
      <div class="team-grid core-team">
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/rizka.png" alt="Rizka">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">Rizka Firstiani S.E., M.E</h3>
            <p class="team-role">Public Budgeting Expert Advisor</p>
            <div class="team-line"></div>
          </div>
        </div>
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/faisol.png" alt="Faisol">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">Nurul Faisol Rahman S.Kom</h3>
            <p class="team-role">IT Expert Advisor</p>
            <div class="team-line"></div>
          </div>
        </div>
        <div class="team-card">
          <div class="team-image">
            <img src="assets/img/team/titov.png" alt="Titov">
            <div class="team-overlay"></div>
          </div>
          <div class="team-info">
            <h3 class="team-name">Titov Chuk’s Mayvani S.E., M.E</h3>
            <p class="team-role">Regional Planning Expert Advisor</p>
            <div class="team-line"></div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Contact Section -->
  <section id="contact" class="ide-contact">
    <div class="contact-container">
      <div class="contact-header">
        <h2>Hubungi Kami</h2>
        <p>CV Inti Desain Ekonomi (IDE) Consultant siap membantu Anda dengan solusi penelitian dan konsultasi kebijakan ekonomi profesional.</p>
      <br>
        <div class="social-links">
  <h3>Ikuti Sosial Media Kami</h3>
  <div class="social-links-container">
    <a href="https://www.tiktok.com/@intidesainekonomi?_t=ZS-8yox13fLDlf&_r=1" class="social-link" target="_blank">
      <img src="assets/img/TT.png" alt="TikTok">
    </a>
    <a href="https://www.instagram.com/intidesainekonomi?igsh=Zmx2bjk2NjNnNmllt" class="social-link" target="_blank">
      <img src="assets/img/instagram.png" alt="Instagram">
    </a>
    <!-- <a href="https://www.youtube.com/@ideconsultant" class="social-link" target="_blank">
      <img src="assets/img/youtube.png" alt="YouTube">
    </a> -->
  </div>
</div>
      </div>
      
      <div class="contact-content">
        <div class="contact-info">
          <div class="office-info">
            <h3>Kantor IDE Consultant</h3>
            <p><i class="icon">📍</i> Perum Nila Residence B6<br>Kecamatan Blimbing<br>Kota Malang</p>
            <p><i class="icon">✉️</i> cvideconsultan@gmail.com</p>
          </div>
          
          <div class="services">
            <h3>Layanan Kami</h3>
            <ul>
              <li>Economic Development</li>
              <li>Fiscal & Public Policy</li>
              <li>Regional Planning</li>
              <li>Manajemen Kebijakan</li>
              <li>Penelitian Ekonomi</li>
              <li>Konsultasi Kebijakan</li>
            </ul>
          </div>
        </div>
        
        <div class="company-links">
          <div class="links-column">
            <h3>Tentang Kami</h3>
            <ul>
              <li>Visi & Misi</li>
              <li>Tim Ahli</li>
              <li>Portofolio</li>
            </ul>
          </div>
          
          <div class="links-column">
            <h3>Informasi</h3>
            <ul>
              <li>Kerjasama</li>
              <li>Lowongan</li>
              <li>Artikel</li>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="copyright">
        <p>Copyright © <span id="current-year"></span> CV Inti Desain Ekonomi Consultant. All Rights Reserved.</p>
      </div>
    </div>
  </section>

  <!-- Portfolio Modal -->
  <div id="ModalPortofolio" class="modal">
    <div class="modal-content" style="max-width: 800px;">
      <div class="modal-header">
        <h3 class="modal-title" id="JudulPortofolio">Portfolio Details</h3>
        <button class="modal-close" onclick="closeModal('ModalPortofolio')">&times;</button>
      </div>
      <div class="modal-body">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
          <div>
            <label style="color: var(--apple-blue); font-weight: 600; font-size: 14px;">Date</label>
            <p id="TanggalPortofolio" style="margin: 5px 0; color: var(--apple-text); font-size: 14px;">-</p>
          </div>
          <div>
            <label style="color: var(--apple-blue); font-weight: 600; font-size: 14px;">Category</label>
            <p id="KategoriPortofolio" style="margin: 5px 0; color: var(--apple-text); font-size: 14px;">-</p>
          </div>
          <div>
            <label style="color: var(--apple-blue); font-weight: 600; font-size: 14px;">Client</label>
            <p id="KlienPortofolio" style="margin: 5px 0; color: var(--apple-text); font-size: 14px;">-</p>
          </div>
        </div>
        <div id="NarasiPortofolio" style="color: var(--apple-secondary); line-height: 1.6; font-size: 14px;">
          Portfolio description will appear here...
        </div>
      </div>
    </div>
  </div>

  <!-- Sign In Modal -->
  <div id="signInModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Sign In</h3>
        <button class="modal-close" onclick="closeModal('signInModal')">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Username</label>
          <input type="text" class="form-input" id="Username" placeholder="Enter your username">
        </div>
        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" class="form-input" id="Password" placeholder="Enter your password">
        </div>
        <button class="btn-primary" id="Masuk">Sign In</button>
      </div>
    </div>
  </div>

  <!-- External Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script>
    // Set base URL (you may need to adjust this based on your setup)
    var BaseURL = '<?=base_url()?>'

    // Modal functions
    function openModal(modalId) {
      document.getElementById(modalId).classList.add('active');
    }

    function closeModal(modalId) {
      document.getElementById(modalId).classList.remove('active');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
      if (event.target.classList.contains('modal')) {
        event.target.classList.remove('active');
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      const slides = document.querySelectorAll('.hero-slide');
      const dots = document.querySelectorAll('.slider-dot');
      const prevButton = document.querySelector('.slider-prev');
      const nextButton = document.querySelector('.slider-next');
      let currentSlide = 0;
      let autoSlideInterval;

      function showSlide(index) {
        slides.forEach((slide, i) => {
          slide.classList.toggle('active', i === index);
          dots[i].classList.toggle('active', i === index);
        });
      }

      function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
      }

      function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
      }

      function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 5000);
      }

      function stopAutoSlide() {
        clearInterval(autoSlideInterval);
      }

      dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
          stopAutoSlide();
          currentSlide = index;
          showSlide(currentSlide);
          startAutoSlide();
        });
      });

      prevButton.addEventListener('click', () => {
        stopAutoSlide();
        prevSlide();
        startAutoSlide();
      });

      nextButton.addEventListener('click', () => {
        stopAutoSlide();
        nextSlide();
        startAutoSlide();
      });

      showSlide(currentSlide);
      startAutoSlide();
    });

    // Portfolio filter
    document.querySelectorAll('.filter-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
      });
    });

    document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('current-year').textContent = new Date().getFullYear();
});

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });

    // Header scroll effect
    window.addEventListener('scroll', function() {
      const header = document.querySelector('.header');
      if (window.scrollY > 100) {
        header.style.background = 'rgba(255, 255, 255, 0.95)';
      } else {
        header.style.background = 'rgba(255, 255, 255, 0.8)';
      }
    });

    // Intersection Observer for animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('fade-in-up');
        }
      });
    }, observerOptions);

    // Observe all cards and sections
    document.querySelectorAll('.service-card, .portfolio-item, .team-card, .vm-card').forEach(el => {
      observer.observe(el);
    });

    // jQuery ready function with login functionality
    jQuery(document).ready(function($) {
      "use strict"; 
      
        // Enter key press handlers for login form
        $('#Username').keypress(function(event){
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
            event.preventDefault();
            document.getElementById("Masuk").click();  
          }
        });
        
        $('#Password').keypress(function(event){
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
            event.preventDefault();
            document.getElementById("Masuk").click();  
          }
        });
        
        // Login handler
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
            } else if (Respon == '0') {
              window.location = BaseURL + "Econk";
            } else {
              alert(Respon);
            }
          }).fail(function() {
            alert('Login failed. Please try again.');
          });                         
        });
      
      // Portfolio click handler
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

      document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.partners-container');
        const track = document.querySelector('.partners-track');
        let isDown = false;
        let startX;
        let scrollLeft;
        let animationId;
        let isAutoScrolling = true;

        // Mouse drag functionality
        container.addEventListener('mousedown', (e) => {
          isDown = true;
          container.classList.add('grabbing', 'paused');
          startX = e.pageX - container.offsetLeft;
          scrollLeft = track.scrollLeft;
        });

        container.addEventListener('mouseleave', () => {
          if (isDown) {
            isDown = false;
            container.classList.remove('grabbing');
            startAutoScroll();
          }
        });

        container.addEventListener('mouseup', () => {
          if (isDown) {
            isDown = false;
            container.classList.remove('grabbing');
            startAutoScroll();
          }
        });

        container.addEventListener('mousemove', (e) => {
          if(!isDown) return;
          e.preventDefault();
          const x = e.pageX - container.offsetLeft;
          const walk = (x - startX) * 2; // Scroll-fastness
          track.style.transform = `translateX(${-walk}px)`;
        });

        // Touch support
        container.addEventListener('touchstart', (e) => {
          isDown = true;
          container.classList.add('grabbing', 'paused');
          startX = e.touches[0].pageX - container.offsetLeft;
          scrollLeft = track.scrollLeft;
        });

        container.addEventListener('touchend', () => {
          if (isDown) {
            isDown = false;
            container.classList.remove('grabbing');
            startAutoScroll();
          }
        });

        container.addEventListener('touchmove', (e) => {
          if(!isDown) return;
          const x = e.touches[0].pageX - container.offsetLeft;
          const walk = (x - startX) * 2;
          track.style.transform = `translateX(${-walk}px)`;
        });

        // Reset to auto-scroll after inactivity
        function startAutoScroll() {
          container.classList.remove('paused');
          // Smoothly transition back to auto-scroll
          const currentX = parseInt(track.style.transform?.replace('translateX(', '').replace('px)', '') || 0);
          const duration = 1000;
          const startTime = performance.now();
          
          function animate(time) {
            const elapsed = time - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeProgress = easeOutQuad(progress);
            const newX = currentX * (1 - easeProgress);
            track.style.transform = `translateX(${newX}px)`;
            
            if (progress < 1) {
              animationId = requestAnimationFrame(animate);
            } else {
              track.style.transform = '';
              isAutoScrolling = true;
            }
          }
          
          cancelAnimationFrame(animationId);
          animationId = requestAnimationFrame(animate);
        }

        function easeOutQuad(t) {
          return t * (2 - t);
        }

        // Infinite scroll logic
        track.addEventListener('transitionend', () => {
          if (!isAutoScrolling) return;
          const firstCard = track.querySelector('.partner-card:first-child');
          const cardWidth = firstCard.offsetWidth + 30; // width + gap
          if (parseInt(track.style.transform?.replace('translateX(', '').replace('px)', '') || 0) <= -cardWidth * 6) {
            track.style.transition = 'none';
            track.style.transform = 'translateX(0)';
            setTimeout(() => {
              track.style.transition = 'transform 30s linear infinite';
            }, 20);
          }
        });
      });
      // Portfolio filter and show more functionality
document.addEventListener('DOMContentLoaded', function() {
  const filterButtons = document.querySelectorAll('.filter-btn');
  const portfolioItems = document.querySelectorAll('.portfolio-item');
  const showMoreBtn = document.getElementById('showMoreBtn');
  let isShowingAll = false;
  let currentFilter = 'all';

  // Function to update portfolio display
  function updatePortfolioDisplay() {
    let visibleCount = 0;
    portfolioItems.forEach((item, index) => {
      const itemCategory = item.getAttribute('data-category');
      const matchesFilter = currentFilter === 'all' || itemCategory === currentFilter;

      // Show item if it matches the filter and is within the visible limit
      if (matchesFilter) {
        if (isShowingAll || visibleCount < 8) {
          item.classList.add('show');
          item.style.display = 'block';
          visibleCount++;
        } else {
          item.classList.remove('show');
          item.style.display = 'none';
        }
      } else {
        item.classList.remove('show');
        item.style.display = 'none';
      }
    });

        // Show or hide the "Show More" button based on the number of filtered items
        const totalMatchingItems = Array.from(portfolioItems).filter(item => 
          currentFilter === 'all' || item.getAttribute('data-category') === currentFilter
        ).length;
        showMoreBtn.style.display = totalMatchingItems > 8 ? 'block' : 'none';
        showMoreBtn.textContent = isShowingAll ? 'Show Less' : 'Show More';
      }

      // Filter button click handler
      filterButtons.forEach(button => {
        button.addEventListener('click', function() {
          filterButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');
          currentFilter = this.getAttribute('data-filter');
          isShowingAll = false; // Reset to showing only 8 items when changing filters
          updatePortfolioDisplay();
        });
      });

      // Show More/Show Less button click handler
      showMoreBtn.addEventListener('click', function() {
        isShowingAll = !isShowingAll;
        updatePortfolioDisplay();
      });

      // Initial display
      updatePortfolioDisplay();
    });
    });
  </script>
</body>
</html>