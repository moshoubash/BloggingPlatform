<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medium - Human stories & ideas</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- You may need to compile assets with Laravel Mix -->
    <style>
        body {
            font-family: 'Charter', 'Georgia', serif;
            margin: 0;
            padding: 0;
            color: #292929;
        }

        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Header styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
            color: #000;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .nav-link {
            text-decoration: none;
            color: #292929;
            font-size: 15px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 99px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #000;
            color: #fff;
            border: none;
        }

        .btn-secondary {
            background-color: transparent;
            color: #000;
            border: none;
        }

        /* Hero section */
        .hero {
            display: flex;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            width: 60%;
            z-index: 2;
        }

        .hero-title {
            font-size: 106px;
            line-height: 0.9;
            margin: 0 0 20px 0;
            font-weight: 400;
            letter-spacing: -0.05em;
        }

        .hero-subtitle {
            font-size: 24px;
            line-height: 1.4;
            margin: 24px 0 40px 0;
            font-weight: 400;
        }

        .start-reading-btn {
            padding: 8px 48px;
            font-size: 20px;
            border-radius: 99px;
            background-color: #000;
            color: #fff;
            text-decoration: none;
            display: inline-block;
        }

        .hero-image {
            position: absolute;
            right: 0;
            top: 0;
            width: 50%;
            height: 100%;
            z-index: 1;
        }

        /* Footer styles */
        .footer {
            padding: 24px 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 80px;
        }

        .footer-links {
            display: flex;
            gap: 24px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .footer-link {
            color: #757575;
            text-decoration: none;
            font-size: 14px;
        }

        /* Green flower and design elements */
        .design-elements {
            position: absolute;
            right: 0;
            top: 0;
            width: 40%;
            height: 100%;
            z-index: 1;
        }

        .green-flower {
            position: absolute;
            top: 100px;
            right: 200px;
            width: 200px;
            height: 200px;
            background-color: #1a8917;
            border-radius: 50%;
            transform: rotate(45deg);
        }

        .geometric-shapes {
            position: absolute;
            bottom: 50px;
            right: 100px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 64px;
            }
            
            .hero-content {
                width: 100%;
            }
            
            .design-elements {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="{{ route('home') }}" class="logo">Medium</a>
            
            <nav class="nav">
                <a href="#" class="nav-link">Our story</a>
                <a href="#" class="nav-link">Membership</a>
                <a href="#" class="nav-link">Write</a>
                <a href="#" class="nav-link">Sign in</a>
                <button class="btn btn-primary">Get started</button>
            </nav>
        </header>

        <main>
            <section class="hero">
                <div class="hero-content">
                    <h1 class="hero-title">Human stories & ideas</h1>
                    <p class="hero-subtitle">A place to read, write, and deepen your understanding</p>
                    <a href="#" class="start-reading-btn">Start reading</a>
                </div>
                
                <div class="design-elements">
                    <!-- SVG for the flower and geometric shapes -->
                    <svg viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                        <!-- Green flower -->
                        <g transform="translate(300, 200)">
                            <circle cx="0" cy="0" r="60" fill="#1a8917" />
                            <circle cx="0" cy="-80" r="40" fill="#1a8917" />
                            <circle cx="70" cy="-30" r="40" fill="#1a8917" />
                            <circle cx="40" cy="60" r="40" fill="#1a8917" />
                            <circle cx="-40" cy="60" r="40" fill="#1a8917" />
                            <circle cx="-70" cy="-30" r="40" fill="#1a8917" />
                            <circle cx="0" cy="0" r="20" fill="white" />
                        </g>
                        
                        <!-- Geometric shapes -->
                        <g transform="translate(450, 400)">
                            <path d="M0,0 L100,0 L50,100 Z" fill="none" stroke="#000" stroke-width="1" />
                            <line x1="0" y1="0" x2="100" y2="100" stroke="#000" stroke-width="1" stroke-dasharray="5,5" />
                            <line x1="100" y1="0" x2="0" y2="100" stroke="#000" stroke-width="1" stroke-dasharray="5,5" />
                        </g>
                    </svg>
                </div>
            </section>
        </main>

        <footer class="footer">
            <div class="footer-links">
                <a href="#" class="footer-link">Help</a>
                <a href="#" class="footer-link">Status</a>
                <a href="#" class="footer-link">About</a>
                <a href="#" class="footer-link">Careers</a>
                <a href="#" class="footer-link">Press</a>
                <a href="#" class="footer-link">Blog</a>
                <a href="#" class="footer-link">Privacy</a>
                <a href="#" class="footer-link">Rules</a>
                <a href="#" class="footer-link">Terms</a>
                <a href="#" class="footer-link">Text to speech</a>
            </div>
        </footer>
    </div>

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>
</html>