<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Findit - Reuniting People with Their Lost Items</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --primary-color: #3f51b5;
            --secondary-color: #06a3c3;
            --accent-color: #ff6b6b;
        }
        
        body {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            overflow-x: hidden;
        }
        
        /* Navbar */
        .navbar {
            background: rgba(0, 0, 0, 0.7) !important;
            backdrop-filter: blur(10px);
            padding: 15px 30px;
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            background: rgba(0, 0, 0, 0.9) !important;
            padding: 10px 30px;
        }
        
        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
            color: white !important;
        }
        
        .navbar-brand span {
            color: var(--secondary-color);
        }
        
        .nav-link {
            font-weight: 500;
            margin: 0 10px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary-color);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .nav-link.login {
            color: #6A5ACD;
        }
        
        .nav-link.signup {
            color: #FF6347;
        }
        
        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 80px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            z-index: 2;
            position: relative;
        }
        
        .app-name {
            font-size: 5rem;
            font-weight: 800;
            background: linear-gradient(to right, white, var(--secondary-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1rem;
            line-height: 1;
        }
        
        .app-name span {
            color: var(--secondary-color);
        }
        
        .tagline {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .description {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 3rem;
            line-height: 1.6;
        }
        
        .btn-hero {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            margin: 0 10px;
            transition: all 0.3s ease;
            border: 2px solid white;
        }
        
        .btn-login {
            background: white;
            color: var(--primary-color);
        }
        
        .btn-login:hover {
            background: transparent;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        .btn-signup {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }
        
        .btn-signup:hover {
            background: transparent;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        /* Device Mockups */
        .device-mockups {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
        }
        
        .phone-mockup {
            position: absolute;
            width: 250px;
            right: 10%;
            top: 50%;
            transform: translateY(-50%);
            animation: float 6s ease-in-out infinite;
        }
        
        .laptop-mockup {
            position: absolute;
            width: 600px;
            left: 10%;
            top: 50%;
            transform: translateY(-40%);
            animation: float 8s ease-in-out infinite;
            animation-delay: 1s;
        }
        
        .mockup-screen {
            position: absolute;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }
        
        .phone-screen {
            width: 86%;
            height: 77%;
            top: 6.5%;
            left: 7%;
            background: #f8f9fa;
        }
        
        .laptop-screen {
            width: 83%;
            height: 77%;
            top: 6.5%;
            left: 8.5%;
            background: #f8f9fa;
        }
        
        .screen-content {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Animations */
        @keyframes float {
            0%, 100% {
                transform: translateY(-50%) translateX(0);
            }
            50% {
                transform: translateY(-50%) translateX(10px);
            }
        }
        
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
        
        .animate-fade-in-up {
            animation: fadeInUp 1s ease forwards;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .phone-mockup {
                right: 5%;
                width: 200px;
            }
            
            .laptop-mockup {
                left: 5%;
                width: 500px;
            }
        }
        
        @media (max-width: 992px) {
            .device-mockups {
                opacity: 0.3;
            }
            
            .app-name {
                font-size: 4rem;
            }
        }
        
        @media (max-width: 768px) {
            .app-name {
                font-size: 3rem;
            }
            
            .tagline {
                font-size: 1.2rem;
            }
            
            .description {
                font-size: 1rem;
            }
            
            .btn-hero {
                padding: 10px 20px;
                margin-bottom: 10px;
            }
            
            .navbar {
                padding: 10px 15px;
            }
            
            .navbar-brand {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 576px) {
            .hero-section {
                padding-top: 60px;
            }
            
            .app-name {
                font-size: 2.5rem;
            }
            
            .button-group {
                flex-direction: column;
            }
            
            .btn-hero {
                width: 80%;
                margin: 5px auto;
            }
            
            .device-mockups {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                Find<span>It</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  
                    <li class="nav-item">
                        <a class="nav-link login" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link signup" href="{{ route('register') }}">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Device Mockups -->
        <div class="device-mockups">
            <!-- Phone Mockup -->
            <div class="phone-mockup animate__animated animate__fadeInRight animate__delay-1s">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/android/android-original.svg" style="position: absolute; width: 100%; height: 100%; opacity: 0.1;" alt="Phone outline">
                <div class="mockup-screen phone-screen">
                    <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="screen-content" alt="Phone screen">
                </div>
            </div>
            
            <!-- Laptop Mockup -->
            <div class="laptop-mockup animate__animated animate__fadeInLeft animate__delay-1s">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/apple/apple-original.svg" style="position: absolute; width: 100%; height: 100%; opacity: 0.1;" alt="Laptop outline">
                <div class="mockup-screen laptop-screen">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" class="screen-content" alt="Laptop screen">
                </div>
            </div>
        </div>
        
        <!-- Hero Content -->
        <div class="container hero-content text-center">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="app-name animate__animated animate__fadeInDown">Find<span>It</span></h1>
                    <p class="tagline animate__animated animate__fadeIn animate__delay-1s">Helping you reunite with your lost items</p>
                    <p class="description animate__animated animate__fadeIn animate__delay-1-5s">
                        More than just a repository for the forgotten, mending the fractured narratives
                        caused by accidental separation. We don't simply collect objects; we curate potential reunions,
                        holding echoes of past moments until they can resonate with their rightful owners once more.
                    </p>
                    
                    <div class="button-group d-flex justify-content-center animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="{{ route('login') }}" class="btn btn-hero btn-login me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-hero btn-signup">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Animate elements on scroll
        document.addEventListener('DOMContentLoaded', function() {
            // GSAP animations for devices
            gsap.from(".phone-mockup", {
                duration: 1.5,
                x: 100,
                opacity: 0,
                delay: 0.5,
                ease: "power3.out"
            });
            
            gsap.from(".laptop-mockup", {
                duration: 1.5,
                x: -100,
                opacity: 0,
                delay: 0.8,
                ease: "power3.out"
            });
            
            // Floating animation for devices
            function floatAnimation(element, duration, yDistance) {
                gsap.to(element, {
                    duration: duration,
                    y: yDistance,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut"
                });
            }
            
            floatAnimation(".phone-mockup", 6, 20);
            floatAnimation(".laptop-mockup", 8, 15);
        });
    </script>
</body>
</html>