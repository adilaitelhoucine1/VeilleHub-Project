<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Formateur - Veilles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Glassmorphism effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        /* Gradient backgrounds */
        .gradient-bg {
            background: linear-gradient(120deg, #1a365d 0%, #2563eb 100%);
        }

        .hover-gradient:hover {
            background: linear-gradient(120deg, #2563eb 0%, #1e40af 100%);
        }

        /* Card hover effects */
        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #2563eb;
            border-radius: 4px;
        }

        /* Animation for icons */
        .animate-bounce-slow {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Pulse effect for notifications */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(37, 99, 235, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 min-h-screen text-white">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 glass-card">
        <div class="p-6">
            <div class="flex items-center space-x-3">
                <img src="https://www.youcode.ma/images/logo-youcode.png" alt="YouCode" class="h-10 animate-bounce-slow">
                <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-200">
                    YouCode
                </span>
            </div>
        </div>
        <nav class="mt-6">
            <div class="px-4 py-2">
                <span class="text-sm font-semibold text-blue-300">MENU PRINCIPAL</span>
            </div>
            <div class="px-4 py-4 space-y-2">
                <a href="/Formateur/dashboard" class="flex items-center px-4 py-3 rounded-lg hover-gradient transition-all duration-300">
                    <i class="fas fa-home mr-3"></i>Dashboard
                </a>
                <a href="#" class="flex items-center px-4 py-3 rounded-lg hover-gradient transition-all duration-300">
                    <i class="fas fa-calendar-alt mr-3"></i>Planning
                </a>
                <a href="#" class="flex items-center px-4 py-3 rounded-lg hover-gradient transition-all duration-300">
                    <i class="fas fa-users mr-3"></i>Apprenants
                </a>
                <a href="#" class="flex items-center px-4 py-3 rounded-lg hover-gradient transition-all duration-300">
                    <i class="fas fa-chart-bar mr-3"></i>Statistiques
                </a>
                
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold mb-2 capitalize">Bonjour 👋 M.<?php echo  $user_name ?></h1>
                <p class="text-blue-300">Voici un aperçu des veilles d'aujourd'hui</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>Nouvelle Veille
                </button>
                <div class="relative">
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full pulse"></span>
                    <img src="https://i.pravatar.cc/40" alt="Profile" class="w-10 h-10 rounded-full cursor-pointer border-2 border-blue-400">
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stat-card glass-card p-6 rounded-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-300 mb-1">Veilles ce mois</p>
                        <h3 class="text-3xl font-bold">24</h3>
                    </div>
                    <div class="bg-blue-500/20 p-4 rounded-lg">
                        <i class="fas fa-calendar text-blue-400 text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Apprenants actifs</p>
                        <h3 class="text-2xl font-bold">156</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-users text-green-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Sujets proposés</p>
                        <h3 class="text-2xl font-bold">12</h3>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-lightbulb text-yellow-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Taux participation</p>
                        <h3 class="text-2xl font-bold">89%</h3>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-chart-line text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prochaines Veilles -->
        <div class="glass-card rounded-xl mb-8 overflow-hidden">
            <div class="p-6 border-b border-blue-800">
                <h2 class="text-xl font-semibold">Prochaines Veilles</h2>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-blue-300">
                                <th class="pb-4">Apprenant</th>
                                <th class="pb-4">Sujet</th>
                                <th class="pb-4">Date</th>
                                <th class="pb-4">Status</th>
                                <th class="pb-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-blue-800/30">
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img src="https://i.pravatar.cc/40?img=1" alt="" 
                                             class="w-10 h-10 rounded-full mr-3 border-2 border-blue-400">
                                        <span>Ahmed Benali</span>
                                    </div>
                                </td>
                                <td class="py-4">GraphQL vs REST</td>
                                <td class="py-4">14 Mars, 14:00</td>
                                <td class="py-4">
                                    <span class="bg-green-500/20 text-green-400 px-4 py-1 rounded-full text-sm">
                                        Confirmé
                                    </span>
                                </td>
                                <td class="py-4">
                                    <div class="flex space-x-2">
                                        <button class="p-2 hover:bg-blue-500/20 rounded-lg transition-colors">
                                            <i class="fas fa-edit text-blue-400"></i>
                                        </button>
                                        <button class="p-2 hover:bg-red-500/20 rounded-lg transition-colors">
                                            <i class="fas fa-trash text-red-400"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Propositions de Veilles -->
        <div class="glass-card rounded-xl">
            <div class="p-6 border-b border-blue-800">
                <h2 class="text-xl font-semibold">Propositions de Veilles</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="glass-card p-4 rounded-xl hover:bg-blue-900/30 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <img src="https://i.pravatar.cc/40?img=2" alt="" 
                                     class="w-12 h-12 rounded-full border-2 border-blue-400">
                                <div>
                                    <h3 class="font-semibold text-lg">Machine Learning Basics</h3>
                                    <p class="text-blue-300">Proposé par Amina Alaoui</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="bg-green-500/20 text-green-400 px-4 py-2 rounded-lg hover:bg-green-500/30 transition-colors">
                                    Approuver
                                </button>
                                <button class="bg-red-500/20 text-red-400 px-4 py-2 rounded-lg hover:bg-red-500/30 transition-colors">
                                    Refuser
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 