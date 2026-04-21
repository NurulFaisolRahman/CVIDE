<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>SMB Bappeda | Enterprise Suite</title>
    
    <!-- Bootstrap 5 + Icons + Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background: #0a0f1c;
        }

        /* === Background Animasi 3D + Particle === */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: radial-gradient(circle at 20% 30%, #0b1120, #03060e);
        }

        /* Gradient Orbs beranimasi */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: floatOrb 18s infinite alternate ease-in-out;
        }

        .orb-1 {
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, #2a6df4, #0a3b9e);
            top: -20%;
            left: -20%;
            animation-duration: 22s;
        }

        .orb-2 {
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, #00c6fb, #005bea);
            bottom: -25%;
            right: -15%;
            opacity: 0.4;
            animation-duration: 25s;
            animation-delay: -5s;
        }

        .orb-3 {
            width: 40vw;
            height: 40vw;
            background: radial-gradient(circle, #4f46e5, #7c3aed);
            top: 40%;
            left: 60%;
            opacity: 0.3;
            animation-duration: 28s;
            animation-delay: -2s;
        }

        @keyframes floatOrb {
            0% {
                transform: translate(0, 0) scale(1);
            }
            100% {
                transform: translate(5%, 8%) scale(1.1);
            }
        }

        /* Particle canvas */
        #particleCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        /* Glassmorphism + efek modern */
        .login-card {
            background: rgba(15, 25, 45, 0.75);
            backdrop-filter: blur(12px);
            border-radius: 32px;
            border: 1px solid rgba(66, 153, 225, 0.3);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.05) inset;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 460px;
            margin: 20px;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 32px 55px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(66, 153, 225, 0.4) inset;
        }

        /* Header dengan garis modern */
        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .brand-icon {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            width: 65px;
            height: 65px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
            box-shadow: 0 12px 20px -8px rgba(37, 99, 235, 0.4);
        }
        .brand-icon i {
            font-size: 32px;
            color: white;
        }
        h3 {
            font-weight: 700;
            background: linear-gradient(135deg, #ffffff, #b9d0ff);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.3px;
            font-size: 1.8rem;
        }
        .subtitle {
            color: #a0b8e0;
            font-weight: 500;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        /* Form styling premium */
        .form-floating-modern {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-floating-modern input {
            width: 100%;
            background: rgba(10, 20, 35, 0.6);
            border: 1px solid rgba(72, 120, 200, 0.5);
            border-radius: 18px;
            padding: 14px 18px;
            font-size: 0.95rem;
            color: #f0f4ff;
            transition: all 0.2s ease;
            outline: none;
        }
        .form-floating-modern label {
            position: absolute;
            left: 18px;
            top: 14px;
            color: #8aa3cc;
            pointer-events: none;
            transition: 0.2s ease all;
            font-weight: 500;
            background: transparent;
        }
        .form-floating-modern input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            background: rgba(10, 20, 35, 0.8);
        }
        .form-floating-modern input:focus + label,
        .form-floating-modern input:not(:placeholder-shown) + label {
            transform: translateY(-22px) scale(0.85);
            background: rgba(15, 25, 45, 0.9);
            padding: 0 8px;
            left: 12px;
            color: #60a5fa;
        }
        input::placeholder {
            color: transparent;
        }

        /* Tombol modern */
        .btn-enterprise {
            background: linear-gradient(95deg, #2563eb, #1e3a8a);
            border: none;
            padding: 12px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            color: white;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }
        .btn-enterprise:hover {
            background: linear-gradient(95deg, #3b82f6, #1e40af);
            transform: scale(1.02);
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.5);
        }
        .btn-enterprise:active {
            transform: scale(0.98);
        }

        /* Loading spinner custom */
        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 1050;
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .spinner-box {
            background: rgba(20,30,50,0.9);
            padding: 25px 35px;
            border-radius: 28px;
            backdrop-filter: blur(8px);
            border: 1px solid #3b82f680;
            text-align: center;
        }
        .modern-spinner {
            width: 48px;
            height: 48px;
            border: 4px solid rgba(59,130,246,0.2);
            border-top: 4px solid #3b82f6;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto 12px;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        /* alert custom */
        .alert-modern {
            background: rgba(220, 38, 38, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(239, 68, 68, 0.5);
            color: #ffb4b4;
            border-radius: 24px;
            font-size: 0.85rem;
            padding: 12px 20px;
        }

        /* Footer */
        .footer-note {
            font-size: 0.7rem;
            color: #6c86a8;
            text-align: center;
            margin-top: 2rem;
            border-top: 1px solid rgba(72, 120, 200, 0.2);
            padding-top: 1rem;
        }
        .footer-note i {
            font-size: 0.65rem;
        }

        @media (max-width: 500px) {
            .login-card { margin: 15px; padding: 1.8rem !important; }
        }
    </style>
</head>
<body>

<div class="animated-bg"></div>
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>
<div class="orb orb-3"></div>
<canvas id="particleCanvas"></canvas>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-card p-4 p-md-5" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
        <div class="brand-header">
            <div class="brand-icon animate__animated animate__fadeInDown">
                <i class="fas fa-building-columns"></i>
            </div>
            <h3 class="animate__animated animate__fadeInUp">SMB Bappeda</h3>
            <p class="subtitle animate__animated animate__fadeInUp animate__delay-1s">
                <i class="fas fa-shield-alt"></i> Enterprise Management Suite
            </p>
        </div>

        <form id="formLogin" method="POST">
            <div class="form-floating-modern">
                <input type="text" name="username" id="username" placeholder=" " required autofocus>
                <label for="username"><i class="fas fa-user-circle me-2"></i>Username / NIK</label>
            </div>
            <div class="form-floating-modern">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberCheck" style="background-color: transparent; border-color: #5f7fbf;">
                    <label class="form-check-label text-white-50 small" for="rememberCheck">
                        Ingat perangkat ini
                    </label>
                </div>
                <a href="#" class="text-primary small text-decoration-none">Lupa password?</a>
            </div>

            <button type="submit" class="btn btn-enterprise w-100" id="loginBtn">
                <i class="fas fa-arrow-right-to-bracket me-2"></i> Secure Login
            </button>
        </form>

        <div id="message" class="mt-4 text-center"></div>
        
        <div class="footer-note">
            <i class="fas fa-fingerprint"></i> Sistem terenkripsi &nbsp;|&nbsp; 
            <i class="fas fa-database"></i> Bappeda v.3.0 &nbsp;|&nbsp;
            <i class="fas fa-clock"></i> Real-time authentication
        </div>
    </div>
</div>

<!-- Spinner global -->
<div id="loadingOverlay" class="spinner-overlay">
    <div class="spinner-box">
        <div class="modern-spinner"></div>
        <div style="color:white; font-weight:500;">Memverifikasi kredensial...</div>
        <div style="color:#94a3b8; font-size:12px; margin-top:8px;">Secure gateway</div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, mirror: false });
    
    // === PARTICLE BACKGROUND SISTEM (Modern & Dinamis) ===
    const canvas = document.getElementById('particleCanvas');
    const ctx = canvas.getContext('2d');
    let particles = [];
    let particleCount = 90;
    
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    
    class Particle {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 2.5 + 0.8;
            this.speedX = (Math.random() - 0.5) * 0.5;
            this.speedY = (Math.random() - 0.5) * 0.3;
            this.opacity = Math.random() * 0.5 + 0.2;
            this.color = `rgba(80, 150, 255, ${this.opacity})`;
        }
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            if (this.x < 0) this.x = canvas.width;
            if (this.x > canvas.width) this.x = 0;
            if (this.y < 0) this.y = canvas.height;
            if (this.y > canvas.height) this.y = 0;
        }
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fillStyle = this.color;
            ctx.fill();
        }
    }
    
    function initParticles() {
        particles = [];
        for (let i = 0; i < particleCount; i++) {
            particles.push(new Particle());
        }
    }
    
    function animateParticles() {
        if (!ctx) return;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (let p of particles) {
            p.update();
            p.draw();
        }
        // tambahkan koneksi antar particle (efek jaringan)
        ctx.beginPath();
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                if (distance < 100) {
                    ctx.strokeStyle = `rgba(60, 130, 240, ${0.12 * (1 - distance / 100)})`;
                    ctx.lineWidth = 0.6;
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }
        requestAnimationFrame(animateParticles);
    }
    
    window.addEventListener('resize', () => {
        resizeCanvas();
        initParticles();
    });
    resizeCanvas();
    initParticles();
    animateParticles();
    
    // Floating label interaksi plus efek tambahan
    $('.form-floating-modern input').on('focus', function(){
        $(this).parent().find('label').css('color', '#93c5fd');
    }).on('blur', function(){
        if(!$(this).val()){
            $(this).parent().find('label').css('color', '#8aa3cc');
        } else {
            $(this).parent().find('label').css('color', '#60a5fa');
        }
    });
    
    // === AJAX LOGIN DENGAN ANIMASI LOADING & VALIDASI ENTERPRISE ===
    $('#formLogin').submit(function(e){
        e.preventDefault();
        
        const username = $('input[name="username"]').val().trim();
        const password = $('input[name="password"]').val();
        
        if(username === '' || password === ''){
            $('#message').html('<div class="alert alert-modern"><i class="fas fa-exclamation-triangle me-2"></i>Username/NIK dan password wajib diisi.</div>');
            return;
        }
        
        // Tampilkan loading overlay
        $('#loadingOverlay').fadeIn(200);
        $('#loginBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Authenticating...');
        
        // Simulasi koneksi profesional, gunakan endpoint asli dari server (sesuai konteks)
        // URL endpoint original dari kode sebelumnya: <?= base_url('IDE/SmbLogin') ?> akan diparse oleh PHP jika dijalankan di server.
        // Pada environment statis, agar tetap bekerja untuk demo (tampilan), kita akan meniru respon sukses/gagal untuk menunjukkan keindahan.
        // TAPI agar kompatibel dengan sistem asli, kita tetap mengarah ke endpoint tersebut. Jika tidak ditemukan, fallback simulasi untuk preview.
        // Untuk keperluan enterprise, kita gunakan endpoint asli.
        let requestUrl = '<?= base_url('IDE/SmbLogin') ?>';
        // Jika base_url tidak terdefinisi (misal file static), kita fallback ke handler simulasi untuk presentasi profesional.
        // Namun untuk keperluan real deployment, endpoint tetap dipanggil.
        // Karena dalam template ini kita ingin menjaga agar tetap bisa melihat tampilan dan animasi, kita buat kondisi: jika endpoint tidak reachable, demo mode.
        // Tapi karena code asli menggunakan base_url, kita biarkan namun tambahkan fallback jika error koneksi.
        
        $.ajax({
            url: requestUrl,
            type: 'POST',
            data: $(this).serialize(),
            timeout: 8000,
            success: function(response){
                $('#loadingOverlay').fadeOut(300);
                $('#loginBtn').prop('disabled', false).html('<i class="fas fa-arrow-right-to-bracket me-2"></i> Secure Login');
                if(response == '1'){
                    // Redirect ke dashboard
                    window.location.href = '<?= base_url('IDE/SmbDashboard') ?>';
                } else {
                    $('#message').html('<div class="alert alert-modern animate__animated animate__shakeX"><i class="fas fa-ban me-2"></i>'+response+'</div>');
                    // efek shake pada card
                    $('.login-card').addClass('animate__animated animate__shake').one('animationend', function(){
                        $(this).removeClass('animate__animated animate__shake');
                    });
                }
            },
            error: function(xhr, status, error){
                $('#loadingOverlay').fadeOut(300);
                $('#loginBtn').prop('disabled', false).html('<i class="fas fa-arrow-right-to-bracket me-2"></i> Secure Login');
                // Menampilkan pesan error yang lebih elegan
                let errorMsg = 'Tidak dapat terhubung ke server autentikasi. Periksa jaringan atau hubungi administrator.';
                if(status === 'timeout') errorMsg = 'Timeout koneksi. Server sibuk, coba lagi.';
                $('#message').html('<div class="alert alert-modern"><i class="fas fa-plug me-2"></i>'+errorMsg+'</div>');
                console.error('Login AJAX error:', status, error);
            }
        });
    });
    
    // Efek glass tambahan untuk floating label, validasi real-time styling
    $('input').on('input', function(){
        if($(this).val() !== ''){
            $(this).css('border-color', '#3b82f6');
        } else {
            $(this).css('border-color', 'rgba(72, 120, 200, 0.5)');
        }
    });
    
    // Demo Micro interaksi: jika user klik remember atau focus
    $('#rememberCheck').change(function(){
        if($(this).is(':checked')){
            // efek kecil notifikasi modern (bisa disimpan local storage, optional)
            console.log('Preferensi remember device disimpan');
        }
    });
    
    // Menampilkan tooltip modern (bootstrap tidak otomatis, optional)
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    // Hapus placeholder styling error jika ada class, reset alert ketika mengetik ulang
    $('input').on('focus', function(){
        $('#message').empty();
    });
</script>

<!-- Catatan: Untuk fungsi backend asli, file ini mempertahankan endpoint PHP CI3 (base_url).
     Jika dijalankan pada server dengan framework CodeIgniter, endpoint akan bekerja persis seperti aslinya.
     Tampilan ditingkatkan secara signifikan tanpa mengubah logika bisnis autentikasi. -->
</body>
</html>