
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des Suggestions - YouCode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        .hover-gradient:hover {
            background: linear-gradient(to right, rgba(37, 99, 235, 0.1), rgba(37, 99, 235, 0.05));
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 min-h-screen text-white">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 glass-card border-r border-blue-800/30">
        <div class="p-6">
            <div class="flex items-center space-x-3">
                <img src="https://www.youcode.ma/images/logo-youcode.png" alt="YouCode" class="h-10">
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
                <a href="/Formateur/valider_Suggestion" class="flex items-center px-4 py-3 rounded-lg hover-gradient transition-all duration-300">
                    <i class="fas fa-chart-bar mr-3"></i>Propositions
                </a>
                <a href="#" class="flex items-center px-4 py-3 rounded-lg hover-gradient transition-all duration-300">
                    <i class="fas fa-chart-bar mr-3"></i>Statistiques
                </a>
                <a href="/logout" class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg">
                    <i class="fas fa-sign-out-alt mr-3"></i>Déconnexion
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 glass-card p-6 rounded-xl">
            <div>
                <h1 class="text-4xl font-bold mb-2 bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-200">
                    Validation des Suggestions
                </h1>
                <p class="text-blue-300">Gérez les suggestions de veilles proposées par les apprenants</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full pulse"></span>
                    <img src="https://i.pravatar.cc/40" alt="Profile" class="w-12 h-12 rounded-full cursor-pointer border-2 border-blue-400">
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="glass-card p-6 rounded-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-300 mb-1">Suggestions en attente</p>
                        <h3 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-blue-200">
                            12
                        </h3>
                    </div>
                    <div class="bg-yellow-500/20 p-4 rounded-lg">
                        <i class="fas fa-clock text-yellow-400 text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="glass-card p-6 rounded-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-300 mb-1">Suggestions approuvées</p>
                        <h3 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-200">
                            45
                        </h3>
                    </div>
                    <div class="bg-green-500/20 p-4 rounded-lg">
                        <i class="fas fa-check text-green-400 text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="glass-card p-6 rounded-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-300 mb-1">Suggestions rejetées</p>
                        <h3 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-blue-200">
                            8
                        </h3>
                    </div>
                    <div class="bg-red-500/20 p-4 rounded-lg">
                        <i class="fas fa-times text-red-400 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des suggestions -->
        <div class="glass-card rounded-xl">
            <div class="p-6 border-b border-blue-800/30">
                <h2 class="text-2xl font-semibold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-200">
                    Suggestions en attente de validation
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    <?php foreach($suggestions as $suggest) {?>
                    <div class="glass-card p-6 rounded-xl hover:bg-blue-900/30 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <img src="https://i.pravatar.cc/40" class="w-12 h-12 rounded-full border-2 border-blue-400">
                                <div>
                                    <h3 class="font-semibold text-lg"><?= $suggest['titre'] ?></h3>
                                    <p class="text-blue-300">Proposé par : <?= $suggest['nom'] ?></p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                            <a href="/Formateur/approve-suggestion/<?= $suggest['id_sujet'] ?>" 
                            class="bg-green-500/20 text-green-400 px-4 py-2 rounded-lg hover:bg-green-500/30 transition-colors">
                                <i class="fas fa-check mr-2"></i>Approuver
                            </a>

                            <a href="/Formateur/reject-suggestion/<?= $suggest['id_sujet'] ?>" 
                            class="bg-red-500/20 text-red-400 px-4 py-2 rounded-lg hover:bg-red-500/30 transition-colors">
                                <i class="fas fa-times mr-2"></i>Rejeter
                            </a>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-gray-300"><?=  $suggest['description'] ?></p>
                        </div>
                    </div>
                    <?php  } ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function approveSuggestion(id) {
            if(confirm('Voulez-vous approuver cette suggestion ?')) {
                window.location.href = `/Formateur/approve-suggestion/${id}`;
            }
        }

        function rejectSuggestion(id) {
            if(confirm('Voulez-vous rejeter cette suggestion ?')) {
                window.location.href = `/Formateur/reject-suggestion/${id}`;
            }
        }
    </script>
</body>
</html> 