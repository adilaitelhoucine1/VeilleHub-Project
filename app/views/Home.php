<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veille Pédagogique - YouCode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        :root {
            --youcode-blue: #2563eb;
            --youcode-dark-blue: #1e40af;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .gradient-text {
            background: linear-gradient(45deg, #2563eb, #3b82f6, #60a5fa);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            background-size: 200% 200%;
            animation: gradientBG 5s ease infinite;
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        .tech-background {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
                        url('https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            overflow: hidden;
        }

        .tech-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(37, 99, 235, 0.2) 0%, transparent 70%);
            animation: pulse 4s infinite;
        }

        @keyframes pulse {
            0% { opacity: 0.5; }
            50% { opacity: 1; }
            100% { opacity: 0.5; }
        }

        .glass-card {
            background: rgba(30, 58, 138, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(37, 99, 235, 0.2);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            background: rgba(30, 58, 138, 0.2);
            transform: translateY(-5px);
        }

        .hover-glow:hover {
            box-shadow: 0 0 25px rgba(37, 99, 235, 0.5);
        }

        .stats-counter {
            opacity: 0;
            transform: translateY(20px);
            animation: countUp 1s ease forwards;
        }

        @keyframes countUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-3d {
            transform-style: preserve-3d;
            transition: all 0.3s ease;
        }

        .card-3d:hover {
            transform: rotateX(10deg) rotateY(10deg);
        }

        .blue-glow {
            box-shadow: 0 0 30px rgba(37, 99, 235, 0.3);
        }

        .animated-border {
            position: relative;
            overflow: hidden;
        }

        .animated-border::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, transparent, #2563eb, transparent);
            animation: borderFlow 2s infinite;
        }

        @keyframes borderFlow {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Nouvelles animations et effets */
        .animate-typing {
            overflow: hidden;
            white-space: nowrap;
            border-right: 2px solid #2563eb;
            animation: typing 3.5s steps(40, end), blink-caret .75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: #2563eb }
        }

        .card-shine {
            position: relative;
            overflow: hidden;
        }

        .card-shine::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent,
                rgba(37, 99, 235, 0.1),
                transparent
            );
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        .particle {
            position: absolute;
            pointer-events: none;
            animation: particleFloat 15s infinite linear;
        }

        @keyframes particleFloat {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(-100vh) rotate(360deg); }
        }

        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 25%, #3b82f6 50%, #60a5fa 75%, #93c5fd 100%);
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50% }
            50% { background-position: 100% 50% }
            100% { background-position: 0% 50% }
        }

        .scale-hover {
            transition: transform 0.3s ease;
        }

        .scale-hover:hover {
            transform: scale(1.05);
        }

        .floating-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    
    <!-- Header avec effet glassmorphism -->
    <header class="fixed top-0 left-0 w-full glass-card py-4 z-50">
        <div class="container mx-auto flex justify-between items-center px-6">
            <div class="flex items-center space-x-2">
                <img src="https://www.youcode.ma/images/logo-youcode.png" alt="YouCode Logo" class="h-8 floating-element">
                <h1 class="text-2xl font-extrabold gradient-text">Veille Pédagogique</h1>
            </div>
            <nav class="space-x-4">
                <a href="/register" class="px-5 py-2 text-gray-300 font-semibold hover:text-blue-400 transition duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                </a>
                <a href="/login" class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold shadow-md hover:bg-blue-700 transition transform hover:scale-105 hover-glow">
                    <i class="fas fa-user-plus mr-2"></i>Inscription
                </a>
            </nav>
        </div>
    </header>

    <!-- Hero Section amélioré -->
    <section class="tech-background relative h-screen flex items-center justify-center text-center overflow-hidden">
        <!-- Floating Icons Background -->
        <div class="floating-icons">
            <i class="fas fa-code particle text-blue-400 text-2xl" style="left: 10%; animation-delay: 0s;"></i>
            <i class="fas fa-database particle text-blue-300 text-xl" style="left: 20%; animation-delay: 2s;"></i>
            <i class="fas fa-laptop-code particle text-blue-500 text-3xl" style="left: 30%; animation-delay: 4s;"></i>
            <i class="fas fa-brain particle text-blue-200 text-2xl" style="left: 40%; animation-delay: 6s;"></i>
            <!-- Ajoutez plus d'icônes selon besoin -->
        </div>

        <div class="max-w-4xl px-6 relative z-10" data-aos="fade-up">
            <h2 class="text-7xl font-extrabold leading-tight mb-6">
                <span class="gradient-text animate-typing">Développez vos talents</span>
            </h2>
            <p class="text-2xl text-gray-300 mb-8 opacity-0 transform translate-y-10" 
               data-aos="fade-up" 
               data-aos-delay="300">
                Rejoignez la communauté YouCode et devenez un développeur d'exception
            </p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="px-8 py-4 bg-blue-600 text-white rounded-lg font-bold shadow-lg hover:bg-blue-700 
                                  transition transform hover:scale-110 hover-glow scale-hover">
                    <i class="fas fa-rocket mr-2"></i>Commencer
                </a>
                <a href="#calendar" class="px-8 py-4 glass-card text-white rounded-lg font-bold shadow-lg 
                                        hover:bg-gray-700/50 transition transform hover:scale-110">
                    <i class="fas fa-calendar-alt mr-2"></i>Voir le planning
                </a>
            </div>
        </div>
    </section>

    <!-- Statistics Section amélioré -->
    <section class="py-16 glass-card relative overflow-hidden" data-aos="fade-up">
        <div class="card-shine"></div>
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center stats-counter">
                <div class="text-5xl font-bold gradient-text mb-2">500+</div>
                <div class="text-gray-300">Présentations réalisées</div>
            </div>
            <div class="text-center stats-counter" style="animation-delay: 0.2s">
                <div class="text-5xl font-bold gradient-text mb-2">1000+</div>
                <div class="text-gray-300">Étudiants actifs</div>
            </div>
            <div class="text-center stats-counter" style="animation-delay: 0.4s">
                <div class="text-5xl font-bold gradient-text mb-2">50+</div>
                <div class="text-gray-300">Technologies couvertes</div>
            </div>
        </div>
    </section>

    <!-- Calendar Section amélioré -->
    <section id="calendar" class="container mx-auto mt-16 px-6">
        <h3 class="text-4xl font-bold gradient-text text-center mb-12" data-aos="fade-up">
            Prochaines Veilles
        </h3>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Cartes avec nouveaux effets -->
            <div class="glass-card p-8 rounded-xl shadow-lg hover-glow card-shine scale-hover" 
                 data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-3xl floating-element">🧠</div>
                    <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-sm">Nouveau</span>
                </div>
                <h4 class="text-xl font-semibold gradient-text mb-3">Intelligence Artificielle</h4>
                <p class="text-gray-400 mb-4">Introduction aux concepts fondamentaux de l'IA et du Machine Learning</p>
                <div class="flex items-center text-gray-500">
                    <i class="far fa-calendar mr-2"></i>
                    <span>12 Février 2025</span>
                </div>
            </div>
            
            <div class="glass-card p-8 rounded-xl shadow-lg hover-glow card-shine scale-hover" 
                 data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-3xl floating-element">🚀</div>
                    <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-sm">Populaire</span>
                </div>
                <h4 class="text-xl font-semibold gradient-text mb-3">DevOps et CI/CD</h4>
                <p class="text-gray-400 mb-4">Automatisation et déploiement continu avec Docker et Jenkins</p>
                <div class="flex items-center text-gray-500">
                    <i class="far fa-calendar mr-2"></i>
                    <span>15 Février 2025</span>
                </div>
            </div>

            <div class="glass-card p-8 rounded-xl shadow-lg hover-glow card-shine scale-hover" 
                 data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-3xl floating-element">🔒</div>
                    <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-sm">Avancé</span>
                </div>
                <h4 class="text-xl font-semibold gradient-text mb-3">Cybersécurité</h4>
                <p class="text-gray-400 mb-4">Sécurisation des applications web modernes</p>
                <div class="flex items-center text-gray-500">
                    <i class="far fa-calendar mr-2"></i>
                    <span>18 Février 2025</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section amélioré -->
    <section class="py-20 mt-16 hero-gradient relative overflow-hidden" data-aos="fade-up">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/50 to-blue-800/50 animate-pulse"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h3 class="text-5xl font-bold text-white mb-8">Prêt à partager vos connaissances ?</h3>
            <p class="text-2xl text-gray-200 mb-8">Rejoignez la communauté YouCode et participez à la prochaine session de veille</p>
            <a href="#" class="px-8 py-4 bg-black text-white rounded-lg font-bold shadow-lg hover:bg-gray-900 transition transform hover:scale-105 hover-glow">
                <i class="fas fa-paper-plane mr-2"></i>Proposer un sujet
            </a>
        </div>
    </section>

    <!-- Footer amélioré -->
    <footer class="glass-card py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-2 mb-4 md:mb-0">
                    <img src="https://www.youcode.ma/images/logo-youcode.png" alt="YouCode Logo" class="h-8">
                    <span class="text-xl font-bold gradient-text">YouCode</span>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-blue-400 transition duration-300 transform hover:scale-110">
                        <i class="fab fa-github text-2xl"></i>
                    </a>
                    <a href="#" class="hover:text-blue-400 transition duration-300 transform hover:scale-110">
                        <i class="fab fa-linkedin text-2xl"></i>
                    </a>
                    <a href="#" class="hover:text-blue-400 transition duration-300 transform hover:scale-110">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                </div>
            </div>
            <div class="mt-8 text-center text-gray-400">
                <p>&copy; 2025 Veille Pédagogique - YouCode. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: false,
            mirror: true
        });

        // Animation des particules
        function createParticles() {
            const icons = document.querySelectorAll('.particle');
            icons.forEach(icon => {
                const delay = Math.random() * 15;
                const duration = 15 + Math.random() * 10;
                icon.style.animationDelay = `${delay}s`;
                icon.style.animationDuration = `${duration}s`;
            });
        }

        createParticles();
    </script>
</body>
</html>
