<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouCode Innovation Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .gradient-border {
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(to right, #818CF8, #EC4899) border-box;
            border: 2px solid transparent;
        }
    </style>
</head>
<body class="font-[Poppins] bg-gradient-to-b from-indigo-50 to-white text-gray-800">
    <!-- Hero Section -->
    <div class="relative min-h-screen">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div id="particles-js"></div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-10 px-6 py-4">
            <div class="container mx-auto">
                <div class="glass-effect rounded-2xl px-6 py-3 flex justify-between items-center shadow-lg">
                    <div class="flex items-center space-x-8">
                        <!-- Logo -->
                        <div class="flex items-center space-x-3">
                            <img src="https://intranet.youcode.ma/src/img/logo-white.png" 
                                 alt="YouCode" 
                                 class="h-8 w-auto"
                                 style="filter: brightness(0);"
                            >
                            <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 text-transparent bg-clip-text">
                                Veille
                            </span>
                        </div>
                        
                        <!-- Navigation Links -->
                        <div class="hidden md:flex items-center space-x-6">
                            <a href="/" class="text-gray-700 hover:text-blue-600 transition-colors">
                                Accueil
                            </a>
                            <a href="/calendar" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors">
                                <i class="far fa-calendar-alt"></i>
                                <span>Calendrier</span>
                            </a>
                        </div>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex gap-4">
                        <a href="/login" class="px-6 py-2 rounded-full border-2 border-blue-500/20 hover:border-blue-500 
                                             text-gray-700 hover:text-blue-600 transition-all hover:shadow-lg">
                            Connexion
                        </a>
                        <a href="/register" class="px-6 py-2 rounded-full bg-gradient-to-r from-blue-600 to-blue-400 
                                                text-white hover:from-blue-700 hover:to-blue-500 transition-all 
                                                shadow-lg hover:shadow-blue-500/25">
                            Inscription
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Content -->
        <div class="relative z-10 container mx-auto px-6 pt-20 pb-32">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-8 animate-float">
                    <img src="https://intranet.youcode.ma/src/img/logo-white.png" 
                         alt="YouCode" 
                         class="h-20 w-auto mx-auto"
                         style="filter: brightness(0);"
                    >
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-8">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-pink-500">
                        Innovation Hub
                    </span>
                </h1>
                <p class="text-xl text-gray-600 mb-12">
                    Plateforme de présentation de projets innovants pour les étudiants de YouCode
                </p>
                <div class="flex justify-center gap-6">
                    <a href="/register" class="px-8 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white hover:from-indigo-600 hover:to-pink-600 transition-all transform hover:scale-105 duration-300 shadow-lg hover:shadow-pink-500/25">
                        Commencer maintenant
                    </a>
                    <a href="#calendar" class="px-8 py-3 rounded-xl gradient-border hover:shadow-lg transition-all transform hover:scale-105 duration-300 text-gray-700 hover:text-gray-900">
                        Voir le calendrier
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Presentations Section -->
    <section id="calendar" class="py-20 bg-white relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 bg-gradient-to-b from-blue-50/50 to-transparent"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZGVmcz48cGF0dGVybiBpZD0iZ3JpZCIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBwYXR0ZXJuVW5pdHM9InVzZXJTcGFjZU9uVXNlIj48cGF0aCBkPSJNIDQwIDAgTCAwIDAgMCA0MCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjM0I4MkY2IiBzdHJva2Utd2lkdGg9IjAuMiIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNncmlkKSIvPjwvc3ZnPg==')] opacity-10"></div>

        <div class="container mx-auto px-6 relative">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400">
                        Présentations à venir
                    </span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto mb-8">
                    Découvrez les prochaines présentations de projets innovants par nos étudiants
                </p>
                
                <!-- Calendar Navigation Button -->
                <a href="/calendar" class="inline-flex items-center px-6 py-3 bg-blue-50 text-blue-600 
                                        rounded-xl hover:bg-blue-100 transition-all group mb-12">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <span class="font-medium">Voir le calendrier complet</span>
                    <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($presentations as $presentation): ?>
                    <div class="group">
                        <div class="bg-white p-6 rounded-2xl transition-all duration-300 
                                    shadow-[0_0_0_1px_rgba(59,130,246,0.1)] 
                                    hover:shadow-[0_0_0_1px_rgba(59,130,246,0.2),0_8px_20px_-4px_rgba(59,130,246,0.1)]
                                    relative overflow-hidden">
                            <!-- Decorative elements -->
                            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-500/10 to-transparent rounded-bl-full"></div>
                            
                            <div class="flex justify-between items-start mb-6 relative">
                                <div class="flex-1">
                                    <div class="flex items-center mb-3">
                                        <div class="w-2 h-2 rounded-full bg-blue-500 mr-2"></div>
                                        <span class="text-blue-500 text-sm font-medium">
                                            <?php echo date('H:i', strtotime($presentation['presentation_date'])); ?>
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-semibold mb-2 text-gray-800 group-hover:text-blue-600 transition-colors">
                                        <?php echo htmlspecialchars($presentation['titre']); ?>
                                    </h3>
                                    <div class="flex items-center text-gray-600 text-sm">
                                        <i class="fas fa-users mr-2 text-blue-400"></i>
                                        <p><?php echo htmlspecialchars($presentation['student_names']); ?></p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end">
                                    <span class="px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-sm font-medium
                                               group-hover:bg-blue-100 transition-colors">
                                        <?php echo date('d M', strtotime($presentation['presentation_date'])); ?>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Bottom action -->
                            <div class="pt-4 mt-4 border-t border-gray-100">
                                <a href="#" class="flex items-center justify-center text-blue-500 hover:text-blue-600 transition-colors">
                                    <span class="text-sm font-medium">Voir les détails</span>
                                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Bottom CTA -->
            <div class="mt-16 text-center">
                <a href="/register" class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-xl
                                        hover:bg-blue-600 transition-all transform hover:scale-105 duration-300
                                        shadow-lg hover:shadow-blue-500/25">
                    <span class="font-medium">Rejoignez la communauté</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Registration Section -->
    <section class="py-20 bg-indigo-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold mb-16 text-center">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-pink-500">
                    Rejoignez la communauté
                </span>
            </h2>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Student Card -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-indigo-200 transition-all">
                        <i class="fas fa-user-graduate text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Étudiant</h3>
                    <p class="text-gray-600 mb-8">
                        Partagez vos projets innovants et développez vos compétences en présentation
                    </p>
                    <a href="/register?role=student" class="block w-full py-3 text-center rounded-xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white hover:from-indigo-600 hover:to-pink-600 transition-all">
                        Inscription Étudiant
                    </a>
                </div>

                <!-- Teacher Card -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 bg-pink-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-pink-200 transition-all">
                        <i class="fas fa-chalkboard-teacher text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Formateur</h3>
                    <p class="text-gray-600 mb-8">
                        Encadrez les projets et évaluez les présentations des étudiants
                    </p>
                    <a href="/register?role=teacher" class="block w-full py-3 text-center rounded-xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white hover:from-indigo-600 hover:to-pink-600 transition-all">
                        Inscription Formateur
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Password Reset Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <h2 class="text-2xl font-semibold mb-6 text-center text-gray-800">Mot de passe oublié ?</h2>
                
                <!-- Ajout des messages d'erreur/succès -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-xl">
                        <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="mb-4 p-4 bg-green-50 text-green-600 rounded-xl">
                        <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </div>
                <?php endif; ?>
                
                <form action="/reset-password" method="POST">
                    <div class="mb-6">
                        <input type="email" name="email" placeholder="Votre adresse email" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 outline-none">
                    </div>
                    <button type="submit" 
                            class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white hover:from-indigo-600 hover:to-pink-600 transition-all">
                        Réinitialiser le mot de passe
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        particlesJS('particles-js', {
            particles: {
                number: { value: 100 },
                color: { value: '#818CF8' },
                shape: { type: 'circle' },
                opacity: { 
                    value: 0.3,
                    random: true
                },
                size: { 
                    value: 3,
                    random: true
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#818CF8',
                    opacity: 0.2,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: "none",
                    random: true,
                    straight: false,
                    out_mode: "out",
                    bounce: false,
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: true,
                        mode: "repulse"
                    },
                    onclick: {
                        enable: true,
                        mode: "push"
                    },
                    resize: true
                }
            }
        });
    </script>
</body>
</html>
