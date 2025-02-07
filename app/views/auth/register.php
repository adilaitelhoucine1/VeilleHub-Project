<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - YouCode</title>
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

        .logo-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .custom-radio {
            appearance: none;
            width: 1.2rem;
            height: 1.2rem;
            border: 2px solid var(--primary);
            border-radius: 50%;
            margin-right: 0.5rem;
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .custom-radio:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .custom-radio:checked::after {
            content: '';
            position: absolute;
            width: 0.5rem;
            height: 0.5rem;
            background: white;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
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
                        <!-- <h2 class="text-3xl font-bold text-gray-800">Rejoignez YouCode</h2> -->
                        <p class="text-gray-600">Créez votre compte pour accéder à toutes nos fonctionnalités.</p>
                        <div class="space-y-4">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                                <span>Gestion des présentations</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                                <span>Suivi des projets</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                                <span>Collaboration en équipe</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Register Form -->
            <div class="w-full md:w-1/2 p-8 md:p-12 bg-white">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Inscription</h1>
                    <p class="text-gray-600">Créez votre compte pour commencer</p>
                </div>

                <form action="/register" method="post" class="space-y-6">
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="full_name" placeholder="Nom complet" required
                               class="input-style w-full pl-10 pr-4 py-3 rounded-lg text-gray-700 placeholder-gray-400">
                    </div>

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

                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="password" name="password_confirmed" placeholder="Confirmer le mot de passe" required
                               class="input-style w-full pl-10 pr-4 py-3 rounded-lg text-gray-700 placeholder-gray-400">
                    </div>

                    <div class="flex justify-center space-x-6">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="role" value="Apprenant" checked class="custom-radio">
                            <span class="text-gray-700">Apprenant</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="role" value="Formateur" class="custom-radio">
                            <span class="text-gray-700">Formateur</span>
                        </label>
                    </div>

                    <button type="submit" name="signup"
                            class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg transition duration-300 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-user-plus mr-2"></i>S'inscrire
                    </button>
                </form>

                <div class="text-center mt-6">
                    <p class="text-gray-600">Vous avez déjà un compte ?
                        <a href="/login" class="text-blue-600 hover:text-blue-700 font-medium">Connexion</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Validation en temps réel
        document.querySelectorAll('input[type="password"]').forEach(input => {
            input.addEventListener('input', function() {
                validatePasswords();
            });
        });

        function validatePasswords() {
            const password = document.querySelector('input[name="password"]');
            const confirm = document.querySelector('input[name="password_confirmed"]');
            
            if (confirm.value && password.value !== confirm.value) {
                confirm.setCustomValidity("Les mots de passe ne correspondent pas");
            } else {
                confirm.setCustomValidity('');
            }
        }
    </script>
</body>
</html>