<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plogging Platform - Run for a Cleaner World</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'charter', 'Georgia', serif;
                background-color: #f3f6f4; /* Light grayish-green background color */
            }
            .medium-font {
                font-family: 'gt-super', Georgia, serif;
            }
            .nav-link {
                font-size: 14px;
            }
            .btn-dark {
                background-color: #1569c7;
                color: white;
                border-radius: 99px;
                font-family: 'sohne', 'Helvetica Neue', sans-serif;
                font-size: 14px;
                font-weight: 400;
            }
            .hero-section {
                background-color: white; /* Changed hero section to #f3f6f4 as well */
            }
            .footer-link {
                color: rgba(117, 117, 117, 1);
                font-size: 14px;
            }
            /* Animation for the picture */
            @keyframes floatPicture {
                0% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-15px) rotate(3deg); }
                100% { transform: translateY(0px) rotate(0deg); }
            }
            .floating-picture {
                padding: 20px;
                height: 380px;
                width: 400px;
                animation: floatPicture 8s ease-in-out infinite;
                transform-origin: bottom center;
            }
            /* Custom background class for sections */
            .bg-custom {
                background-color: white;
            }
            /* Logo styling */
            .logo-container {
                position: relative;
                display: inline-flex;
                align-items: center;
            }
            .logo-bg {
                position: absolute;
                width: 80px;  /* Increased from 40px to 50px */
                height: 80px; /* Increased from 40px to 50px */
                z-index: 0;
                right: 30px;  /* Added to position logo further left of the text */
            }
            .logo-text {
                position: relative;
                z-index: 1;
                margin-left: 35px; /* Increased from 10px to 35px to create more space from logo */
            }
        </style>
    </head>
    <body>
    
        <header class="border-b border-gray-200 bg-custom">
            <div class="max-w-7xl mx-auto px-5">
                <div class="flex justify-between items-center py-5">
                    <div class="flex items-center">
                        <div class="logo-container">
                            <img class="logo-bg" src="https://i.pinimg.com/736x/70/04/f5/7004f5b17fbc432a17d83002348e4009.jpg"alt="PlogHub Logo">
                            <h1 class="text-2xl font-bold logo-text">PlogHub</h1>
                        </div>
                    </div>
                    <nav class="flex items-center space-x-6">
                        <a href="#" class="nav-link text-gray-700">Our story</a>
                        <a href="#" class="nav-link text-gray-700">Write</a>
                        <a href="#" class="nav-link text-gray-700">Sign in</a>
                        <a href="#" class="btn-dark px-4 py-2">Get started</a>
                    </nav>
                </div>
            </div>
        </header>
        <main>
            <section class="hero-section">
                <div class="max-w-7xl mx-auto px-5 py-24">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-3/5 mb-10 md:mb-0">
                            <h2 class="medium-font text-6xl sm:text-7xl font-bold text-gray-900 mb-5 leading-tight">
                               Writing<br>stories &amp; articles
                            </h2>
                            <p class="text-xl text-gray-700 mb-8 max-w-lg">
                                A place to read, write, and deepen your understanding
                            </p>
                            <a href="#" class="inline-block px-6 py-3 rounded-full border border-black text-black font-medium hover:bg-black hover:text-white transition duration-300">
                                Start reading
                            </a>
                        </div>
                        <div class="md:w-2/5 relative">
                            <div class="absolute right-0 top-0">
                                <!-- Replacing the SVG quill with a picture -->
                                <img src="https://st2.depositphotos.com/1001378/10985/i/950/depositphotos_109859302-stock-illustration-watercolor-hand-painted-illustration-of.jpg" alt="Plogging illustration" class="floating-picture" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    
    </body>
    </html>
    </x-app-layout>
    