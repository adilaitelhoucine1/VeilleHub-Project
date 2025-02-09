<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - YouCode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #60a5fa;
        }

        .tech-background {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .input-style {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .input-style:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            background: white;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary), var(--primary-light));
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .logo-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .gradient-text {
            background: linear-gradient(45deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="tech-background min-h-screen flex items-center justify-center p-4">
    <div class="glass-card rounded-2xl w-full max-w-4xl overflow-hidden shadow-2xl">
        <div class="md:flex">
            <!-- Left Side - Branding -->
            <div class="hidden md:block w-1/2 bg-gradient-to-br from-blue-50 to-blue-100 p-12 relative">
                <div class="relative z-10 h-full flex flex-col justify-center gap-5">
                <div class="flex items-center justify-center space-x-3">
                <img src="https://intranet.youcode.ma/src/img/logo-white.png" 
                     alt="YouCode" 
                     class="h-8 w-auto"
                     style="filter: brightness(0) invert(0);"
                >
                <span class="text-sm font-semibold text-gray-600">
                    Veille
                </span>
            </div>
                    <div class="space-y-6">
                        <!-- <h2 class="text-3xl font-bold text-gray-800">Bienvenue sur YouCode</h2> -->
                        <p class="text-gray-600">Votre plateforme de gestion des présentations et veilles technologiques.</p>
                        <div class="space-y-4">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                                <span>Gestion simplifiée des présentations</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                                <span>Suivi en temps réel</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                                <span>Collaboration efficace</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full md:w-1/2 p-8 md:p-12 bg-white">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Connexion</h1>
                    <p class="text-gray-600">Accédez à votre espace personnel</p>
                </div>

                <form action="/login" method="POST" class="space-y-6">
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="email" name="email" placeholder="Email" required
                               class="input-style w-full pl-10 pr-4 py-3 rounded-lg text-gray-700 placeholder-gray-400">
                    </div>

                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="password" name="password" placeholder="Mot de passe" required
                               class="input-style w-full pl-10 pr-4 py-3 rounded-lg text-gray-700 placeholder-gray-400">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox text-blue-600 rounded">
                            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                        <a href="/reset-password" class="text-sm text-blue-600 hover:text-blue-700">
                            Mot de passe oublié ?
                        </a>
                    </div>

                    <button type="submit" name="login_btn"
                            class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg transition duration-300 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                    </button>
                </form>

                <div class="text-center mt-6">
                    <p class="text-gray-600">Vous n'avez pas de compte ?
                        <a href="/register" class="text-blue-600 hover:text-blue-700 font-medium">Inscription</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 