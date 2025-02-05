<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - YouCode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-text {
            background: linear-gradient(45deg, #2563eb, #3b82f6, #60a5fa);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            background-size: 200% 200%;
            animation: gradientBG 5s ease infinite;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .hover-glow:hover {
            box-shadow: 0 0 25px rgba(37, 99, 235, 0.5);
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .tech-background {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
                        url('https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .input-style {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }

        .input-style:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #2563eb;
            box-shadow: 0 0 15px rgba(37, 99, 235, 0.3);
        }
    </style>
</head>
<body class="tech-background min-h-screen flex items-center justify-center p-6">
    <div class="glass-card rounded-3xl w-full max-w-4xl overflow-hidden text-white">
        <div class="md:flex">
            <!-- Left Side - Illustration -->
            <div class="hidden md:block w-1/2 bg-gradient-to-br from-blue-600 to-blue-800 p-12 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600/50 to-blue-800/50"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold mb-6">Bienvenue sur YouCode</h2>
                    <p class="mb-8">Connectez-vous pour accéder à votre espace personnel et participer aux veilles technologiques.</p>
                    <img src="https://www.youcode.ma/images/logo-youcode.png" alt="YouCode Logo" class="w-32 mb-8">
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="fas fa-laptop-code text-blue-300 mr-3"></i>
                            <span>Accédez à vos ressources</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-users text-blue-300 mr-3"></i>
                            <span>Rejoignez la communauté</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-brain text-blue-300 mr-3"></i>
                            <span>Partagez vos connaissances</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full md:w-1/2 p-8 md:p-12">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold gradient-text mb-2">Connexion</h1>
                    <p class="text-gray-300">Accédez à votre compte</p>
                </div>

                <form action="/login" method="POST" class="space-y-6">
                    <!-- Email Input -->
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-400"></i>
                        <input type="email" name="email" placeholder="Email"
                               class="input-style w-full pl-10 pr-4 py-3 rounded-lg text-white placeholder-gray-400"
                               required>
                    </div>

                    <!-- Password Input -->
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-400"></i>
                        <input type="password" name="password" placeholder="Mot de passe"
                               class="input-style w-full pl-10 pr-4 py-3 rounded-lg text-white placeholder-gray-400"
                               required>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox text-blue-600">
                            <span class="ml-2 text-sm text-gray-300">Se souvenir de moi</span>
                        </label>
                        <a href="/forgot-password" class="text-sm text-blue-400 hover:text-blue-300">
                            Mot de passe oublié ?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name ="login_btn"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-300 transform hover:scale-105 hover-glow">
                        <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                    </button>
                </form>

                <div class="text-center mt-6">
                    <p class="text-gray-400">Vous n'avez pas de compte ?
                        <a href="/register" class="text-blue-400 hover:text-blue-300 ml-1">Inscription</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 