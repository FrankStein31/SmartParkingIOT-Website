<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parking IOT - Enhanced</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e3c72;
            --secondary-color: #2a5298;
            --accent-color: #6DD5FA;
            --light-color: #ffffff;
            --text-muted-light: rgba(255, 255, 255, 0.8);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary-color); /* Fallback if hero doesn't cover all */
            color: var(--text-muted-light);
            scroll-behavior: smooth;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            color: var(--light-color);
            position: relative; /* For particles.js */
            overflow: hidden; /* To contain particles */
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .hero-content-wrapper {
            position: relative; /* To be above particles */
            z-index: 1;
            min-height: 100vh; /* Ensure content can fill the viewport */
            display: flex;
            flex-direction: column;
        }

        .navbar {
            transition: background-color 0.3s ease, padding 0.3s ease;
            position: sticky;
            top: 0;
            z-index: 1030; /* Bootstrap's standard z-index for sticky navs */
        }

        .navbar.scrolled {
            background-color: rgba(30, 60, 114, 0.9); /* Darker, slightly transparent primary color */
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .navbar-brand {
            color: var(--light-color) !important;
            font-weight: 700;
            font-size: 1.75rem;
        }

        .nav-link {
            color: var(--text-muted-light) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-link:hover, .navbar-brand:hover {
            color: var(--accent-color) !important;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px); /* For Safari */
            border-radius: 20px;
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.15);
            height: 100%; /* Make cards in a row same height */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
        }

        .feature-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            font-size: 3rem; /* Larger Font Awesome icons */
            margin-bottom: 20px;
            color: var(--accent-color);
            text-align: center;
        }
        .feature-card h4{
            color: var(--light-color);
            font-weight: 600;
            text-align: center;
            margin-bottom: 10px;
        }
        .feature-card p{
            color: var(--text-muted-light);
            text-align: center;
            font-size: 0.95rem;
        }

        .btn-main-cta, .btn-dashboard {
            background: var(--accent-color);
            border: none;
            color: var(--primary-color);
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-main-cta:hover, .btn-dashboard:hover {
            background: var(--light-color);
            color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .btn-dashboard-nav { /* Specific for navbar */
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .btn-dashboard-nav:hover {
            background: var(--accent-color);
            color: var(--primary-color);
        }


        .section-title {
            color: var(--light-color);
            font-weight: 700;
            margin-bottom: 40px;
        }
        
        .img-fluid.rounded-3 {
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        /* Scroll-triggered animations helper */
        .scroll-animate {
            opacity: 0; /* Start hidden */
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        .scroll-animate.animated { /* Class added by JS */
            opacity: 1;
        }
        /* Specific animation types - can override Animate.css defaults or use simpler ones */
        .scroll-animate.fade-in-up.animated { transform: translateY(0); }
        .scroll-animate.fade-in-up { transform: translateY(50px); }

        .scroll-animate.fade-in-left.animated { transform: translateX(0); }
        .scroll-animate.fade-in-left { transform: translateX(-50px); }

        .scroll-animate.fade-in-right.animated { transform: translateX(0); }
        .scroll-animate.fade-in-right { transform: translateX(50px); }

        .min-vh-75 { min-height: 75vh; }
        .min-vh-50 { min-height: 50vh; } /* For sections */

        /* How it Works Section */
        .how-it-works-step {
            background: rgba(255, 255, 255, 0.05);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 20px;
            border-left: 5px solid var(--accent-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .how-it-works-step:hover {
            transform: translateX(10px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .step-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-right: 15px;
            line-height: 1;
        }
        .step-content h5 {
            color: var(--light-color);
            font-weight: 600;
        }
        .step-content p {
            font-size: 0.9rem;
            color: var(--text-muted-light);
        }

        footer {
            background-color: var(--primary-color);
            color: var(--text-muted-light);
            padding: 25px 0;
            position: relative;
            z-index: 1; /* Ensure footer is above particles if they overlap */
        }

        /* Scroll to Top Button */
        #scrollToTopBtn {
            display: none;
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            border: none;
            outline: none;
            background-color: var(--accent-color);
            color: var(--primary-color);
            cursor: pointer;
            padding: 12px 15px;
            border-radius: 50%;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transition: background-color 0.3s ease, opacity 0.3s ease, transform 0.3s ease;
        }
        #scrollToTopBtn:hover {
            background-color: var(--light-color);
            transform: translateY(-5px);
        }

        /* Typed.js Cursor */
        .typed-cursor {
            color: var(--accent-color);
            font-size: 2.5rem; /* Match display-4 */
        }

            </style>
    </head>
<body>
    <div class="hero-section d-flex flex-column">
        <div id="particles-js"></div> <div class="hero-content-wrapper">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="#">SmartParking</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon" style="background-image: url(\"data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e\");"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item">
                                <a class="nav-link" href="#features">Fitur</a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#howitworks">Cara Kerja</a>
                        </li>
                            <li class="nav-item ms-lg-3">
                                <a href="/dashboard" class="btn btn-dashboard-nav">Dashboard</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>

            <main class="container flex-grow-1">
                <div class="row align-items-center min-vh-75 py-5">
                    <div class="col-lg-6 scroll-animate fade-in-left" data-animation="fade-in-left">
                        <h1 class="display-4 fw-bold mb-4"><span id="typed-headline"></span></h1>
                        <p class="lead mb-4" style="color: var(--text-muted-light);">Solusi modern untuk manajemen parkir yang efisien dan terorganisir dengan teknologi Internet of Things.</p>
                        <a href="/dashboard" class="btn btn-main-cta px-5 py-3">Buka Dashboard</a>
                    </div>
                    <div class="col-lg-6 text-center scroll-animate fade-in-right" data-animation="fade-in-right" data-delay="200">
                        <div class="display-1 mb-4" style="color: var(--accent-color);">
                            <i class="fas fa-parking" style="font-size: 200px;"></i>
                            <i class="fas fa-wifi" style="font-size: 50px; margin-left: -20px; margin-top: -80px; position: relative;"></i>
                            <div class="mt-3" style="font-size: 24px; font-weight: bold;">Smart Parking IOT</div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <section id="features" class="py-5" style="background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title scroll-animate fade-in-up" data-animation="fade-in-up">Fitur Utama</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4 mb-4 scroll-animate fade-in-up" data-animation="fade-in-up" data-delay="0">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-eye"></i></div>
                        <h4>Monitoring Real-time</h4>
                        <p>Pantau ketersediaan parkir secara real-time melalui dashboard interaktif.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 scroll-animate fade-in-up" data-animation="fade-in-up" data-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                        <h4>Analisis Data</h4>
                        <p>Analisis penggunaan parkir dan tren untuk pengambilan keputusan yang lebih baik.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 scroll-animate fade-in-up" data-animation="fade-in-up" data-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                        <h4>Keamanan Terjamin</h4>
                        <p>Sistem keamanan terintegrasi dengan monitoring 24/7.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="howitworks" class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title scroll-animate fade-in-up" data-animation="fade-in-up">Bagaimana Cara Kerjanya?</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2 text-center scroll-animate fade-in-right" data-animation="fade-in-right" data-delay="200">
                    <div class="display-1 mb-4" style="color: var(--accent-color);">
                        <i class="fas fa-parking" style="font-size: 150px;"></i>
                        <i class="fas fa-wifi" style="font-size: 50px; margin-left: -20px; margin-top: -80px; position: relative;"></i>
                        <div class="mt-3" style="font-size: 24px; font-weight: bold;">Smart Parking IOT</div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="how-it-works-step scroll-animate fade-in-left" data-animation="fade-in-left" data-delay="0">
                        <div class="d-flex align-items-start">
                            <div class="step-number">01</div>
                            <div class="step-content">
                                <h5>Deteksi Kendaraan</h5>
                                <p>Sensor infrared atau kamera pintar mendeteksi keberadaan kendaraan di setiap slot parkir.</p>
                            </div>
                        </div>
                    </div>
                    <div class="how-it-works-step scroll-animate fade-in-left" data-animation="fade-in-left" data-delay="100">
                        <div class="d-flex align-items-start">
                            <div class="step-number">02</div>
                            <div class="step-content">
                                <h5>Update Data Real-time</h5>
                                <p>Informasi ketersediaan slot dikirim ke server cloud secara instan melalui jaringan IoT.</p>
                            </div>
                        </div>
                    </div>
                    <div class="how-it-works-step scroll-animate fade-in-left" data-animation="fade-in-left" data-delay="200">
                        <div class="d-flex align-items-start">
                            <div class="step-number">03</div>
                            <div class="step-content">
                                <h5>Informasi via Dashboard</h5>
                                <p>Pengguna dapat melihat status parkir, statistik, dan melakukan manajemen melalui dashboard web.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container text-center">
            <p class="mb-0">&copy; <span id="currentYear"></span> Smart Parking IOT. All rights reserved.</p>
            <p class="small mt-1">Crafted with <i class="fas fa-heart text-danger"></i> for a Smarter Future</p>
        </div>
    </footer>

    <button id="scrollToTopBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.9.3/tsparticles.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Update Year
            document.getElementById('currentYear').textContent = new Date().getFullYear();

            // Typed.js for headline
            if (document.getElementById('typed-headline')) {
                new Typed('#typed-headline', {
                    strings: ['Sistem Parkir Pintar Berbasis IoT', 'Solusi Parkir Modern & Efisien', 'Optimalkan Lahan Parkir Anda'],
                    typeSpeed: 60,
                    backSpeed: 30,
                    backDelay: 1500,
                    startDelay: 500,
                    loop: true,
                    showCursor: true,
                    cursorChar: '|',
                });
            }

            // Navbar scroll effect
            const navbar = document.querySelector('.navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Scroll-triggered Animations with Intersection Observer
            const scrollElements = document.querySelectorAll('.scroll-animate');
            const elementInView = (el, percentageScroll = 100) => {
                const elementTop = el.getBoundingClientRect().top;
                return (
                    elementTop <= 
                    ((window.innerHeight || document.documentElement.clientHeight) * (percentageScroll/100))
                );
            };

            const displayScrollElement = (element) => {
                const animationType = element.dataset.animation || 'fade-in-up'; // Default animation
                const delay = parseInt(element.dataset.delay) || 0;

                setTimeout(() => {
                    element.classList.add('animated', 'animate__animated', `animate__${animationType}`);
                    // For custom simpler animations if not using Animate.css for everything:
                    // element.classList.add('animated', animationType); 
                }, delay);
            };
            
            const handleScrollAnimation = () => {
                scrollElements.forEach((el) => {
                    // Check if element is in view and not yet animated
                    if (elementInView(el, 80) && !el.classList.contains('animated')) { 
                        displayScrollElement(el);
                    }
                });
            }
            
            // Initial check
            handleScrollAnimation();
            window.addEventListener('scroll', handleScrollAnimation);


            // tsParticles (Particles.js)
            if (document.getElementById('particles-js')) {
                tsParticles.load("particles-js", {
                    fpsLimit: 60,
                    interactivity: {
                        events: {
                            onHover: {
                                enable: true,
                                mode: "repulse" 
                            },
                            onClick: {
                                enable: true,
                                mode: "push"
                            },
                            resize: true
                        },
                        modes: {
                            repulse: {
                                distance: 80,
                                duration: 0.4
                            },
                            push: {
                                quantity: 4
                            }
                        }
                    },
                    particles: {
                        color: {
                            value: "#ffffff"
                        },
                        links: {
                            color: "#ffffff",
                            distance: 150,
                            enable: true,
                            opacity: 0.3,
                            width: 1
                        },
                        collisions: {
                            enable: false // Keep it light
                        },
                        move: {
                            direction: "none",
                            enable: true,
                            outModes: {
                                default: "bounce"
                            },
                            random: false,
                            speed: 1.5, // Slower speed
                            straight: false
                        },
                        number: {
                            density: {
                                enable: true,
                                area: 800 
                            },
                            value: 60 // Fewer particles
                        },
                        opacity: {
                            value: 0.3 
                        },
                        shape: {
                            type: "circle"
                        },
                        size: {
                            value: { min: 1, max: 4 }
                        }
                    },
                    detectRetina: true
                });
            }

            // Scroll to Top Button
            const scrollToTopBtn = document.getElementById("scrollToTopBtn");
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
              if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollToTopBtn.style.display = "block";
                scrollToTopBtn.style.opacity = "1";
              } else {
                scrollToTopBtn.style.opacity = "0";
                // Wait for transition to finish before hiding
                setTimeout(() => { 
                    if(!(document.body.scrollTop > 100 || document.documentElement.scrollTop > 100)) {
                        scrollToTopBtn.style.display = "none";
                    }
                }, 300);
              }
            }
            scrollToTopBtn.addEventListener('click', () => {
                window.scrollTo({top: 0, behavior: 'smooth'});
            });

        });
    </script>
    </body>
</html>