<?php
$pageTitle = "Dashboard Formateur";
$currentPage = 'dashboard';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Formateur - YouCode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Theme principal */
        :root {
            --primary: #2563EB;
            --primary-light: #60A5FA;
            --primary-dark: #1E40AF;
            --accent: #F59E0B;
            --success: #10B981;
            --danger: #EF4444;
        }

        /* Glassmorphism effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(37, 99, 235, 0.1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        /* Hover effects */
        .hover-card {
            transition: all 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(37, 99, 235, 0.08);
            border-color: rgba(37, 99, 235, 0.2);
        }

        /* Menu hover */
        .menu-item {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(37, 99, 235, 0.08);
            border-left-color: var(--primary);
            color: var(--primary);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
            filter: brightness(110%);
        }

        /* Status badges */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 3px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg">
        <div class="p-6">
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
        </div>
        <?php include __DIR__ . '/../components/Formateur_AsideBar.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8 animate-fade-in">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Bonjour 👋 M.<?php echo $user_name ?></h1>
                <p class="text-gray-600">Voici un aperçu des veilles d'aujourd'hui</p>
            </div>
            <div class="flex items-center space-x-4">
               
                <div class="relative">
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full"></span>
                    <img src="https://intranet.youcode.ma/storage/users/profile/thumbnail/1154-1730909733.jpg" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200">
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stat-card glass-card p-6 rounded-xl hover:bg-blue-900/30 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-300 mb-1">Veilles ce mois</p>
                        <h3 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-200">24</h3>
                    </div>
                    <div class="bg-blue-500/20 p-4 rounded-lg animate-bounce-slow">
                        <i class="fas fa-calendar text-blue-400 text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card glass-card p-6 rounded-xl hover:bg-blue-900/30 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-300 mb-1">Apprenants actifs</p>
                        <h3 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-200">156</h3>
                    </div>
                    <div class="bg-green-500/20 p-4 rounded-lg">
                        <i class="fas fa-users text-green-400 text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card glass-card p-6 rounded-xl hover:bg-blue-900/30 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-300 mb-1">Sujets proposés</p>
                        <h3 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-blue-200">12</h3>
                    </div>
                    <div class="bg-yellow-500/20 p-4 rounded-lg">
                        <i class="fas fa-lightbulb text-yellow-400 text-2xl"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card glass-card p-6 rounded-xl hover:bg-blue-900/30 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-300 mb-1">Taux participation</p>
                        <h3 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-blue-200">89%</h3>
                    </div>
                    <div class="bg-purple-500/20 p-4 rounded-lg">
                        <i class="fas fa-chart-line text-purple-400 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des Apprenants -->
        <div class="glass-card rounded-xl mb-8 overflow-hidden hover:bg-blue-900/10 transition-all duration-300">
           
            <div class="relative p-8 border-b border-blue-800/30">
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&auto=format&fit=crop')] bg-cover bg-center opacity-10"></div>
                <div class="relative flex justify-between items-center">
                    <h2 class="text-2xl font-semibold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-200">
                        Liste des Apprenants
                    </h2>
                    <div class="bg-blue-500/10 p-3 rounded-lg">
                        <i class="fas fa-users text-blue-400 text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($apprenants as $apprenant): ?>
                    <div class="glass-card p-4 rounded-xl flex items-start space-x-4">
                        <img src="https://intranet.youcode.ma/storage/users/profile/thumbnail/1176-1730909420.jpg" 
                             alt="<?php echo $apprenant['nom'] ?>" 
                             class="w-16 h-16 rounded-full border-2 <?php echo $apprenant['status'] === 'active' ? 'border-green-400' : 'border-red-400' ?>">
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-lg"><?php echo $apprenant['nom'] ?></h3>
                                    <p class="text-blue-300 text-sm"><?php echo $apprenant['email'] ?></p>
                                </div>
                                <!-- Status Badge -->
                                <span class="status-badge status-active">
                                    <?php echo $apprenant['status'] ?>
                                </span>
                            </div>
                            <div class="mt-3 flex gap-2">
                                <!-- Bouton Activer/Désactiver -->
                                <a href="/Formateur/toggle-status/<?php echo $apprenant['id_user'] ?>" 
                                   class="p-2 <?php echo $apprenant['status'] === 'active' ? 'hover:bg-red-500/20' : 'hover:bg-green-500/20' ?> rounded-lg transition-colors"
                                   onclick="return confirm('Êtes-vous sûr de vouloir <?php echo $apprenant['status'] === 'active' ? 'désactiver' : 'activer' ?> ce compte ?');">
                                    <i class="fas <?php echo $apprenant['status'] === 'active' ? 'fa-user-slash text-red-400' : 'fa-user-check text-green-400' ?>"></i>
                                </a>
                                <!-- Bouton Supprimer -->
                                <a href="/formateur/delete/<?php echo $apprenant['id_user'] ?>" 
                                   class="p-2 hover:bg-red-500/20 rounded-lg transition-colors"
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ? Cette action est irréversible.');">
                                    <i class="fas fa-trash text-red-400"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination -->
                <div class="mt-6 flex justify-center">
                    <div class="flex space-x-2">
                        <a href="?page=<?php echo $currentPage - 1 ?>" 
                           class="px-4 py-2 rounded-lg glass-card hover:bg-blue-900/30 transition-colors <?php echo $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            <i class="fas fa-chevron-left mr-2"></i>Précédent
                        </a>
                        <a href="?page=<?php echo $currentPage + 1 ?>" 
                           class="px-4 py-2 rounded-lg glass-card hover:bg-blue-900/30 transition-colors <?php echo $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Suivant<i class="fas fa-chevron-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple JavaScript for interactivity
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                if(button.textContent.includes('Approuver')) {
                    alert('Sujet approuvé !');
                } else if(button.textContent.includes('Rejeter')) {
                    alert('Sujet rejeté !');
                }
            });
        });

        function toggleUserStatus(userId, currentStatus) {
            const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
            const message = currentStatus === 'active' ? 'désactiver' : 'activer';
            
            if (confirm(`Êtes-vous sûr de vouloir ${message} ce compte ?`)) {
                fetch('/formateur/toggle-user-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        userId: userId,
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert('Une erreur est survenue. Veuillez réessayer.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Une erreur est survenue. Veuillez réessayer.');
                });
            }
        }

        function deleteUser(userId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce compte ? Cette action est irréversible.')) {
                fetch('/formateur/delete-user', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        userId: userId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert('Une erreur est survenue. Veuillez réessayer.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Une erreur est survenue. Veuillez réessayer.');
                });
            }
        }
    </script>
</body>
</html> 