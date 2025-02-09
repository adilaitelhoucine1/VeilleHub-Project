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
        /* Theme principal - Light Mode */
        :root {
            --primary: #2563EB;
            --primary-light: #3B82F6;
            --primary-dark: #1D4ED8;
            --accent: #F59E0B;
            --success: #10B981;
            --danger: #EF4444;
            --background: #F8FAFC;
            --card-bg: #FFFFFF;
            --text-primary: #1F2937;
            --text-secondary: #6B7280;
            --border-color: #E5E7EB;
        }

        /* Glassmorphism effect - Light Mode */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
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
            color: #059669;
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.1);
            color: #DC2626;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* Custom scrollbar - Light Mode */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #F3F4F6;
        }

        ::-webkit-scrollbar-thumb {
            background: #94A3B8;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #64748B;
        }

        /* Card effects */
        .card-hover-effect {
            transition: all 0.3s ease;
        }

        .card-hover-effect:hover {
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }

        /* Input styles */
        .custom-input {
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            transition: all 0.2s ease;
        }

        .custom-input:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Table styles */
        .custom-table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .custom-table th {
            background: #F8FAFC;
            color: var(--text-primary);
            font-weight: 600;
        }

        .custom-table tr:hover {
            background: #F1F5F9;
        }

        /* Button styles */
        .btn {
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        /* Gradient backgrounds */
        .gradient-bg {
            background: linear-gradient(135deg, #EFF6FF 0%, #F8FAFC 100%);
        }

        /* Card header */
        .card-header {
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(to right, #F8FAFC, #F1F5F9);
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
    <div class="ml-64 p-8 bg-gray-50 min-h-screen">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Tableau de bord</h1>
            <p class="text-gray-600 mt-1">Bienvenue, <?php echo htmlspecialchars($user_name); ?></p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Apprenants -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-lg text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 mt-4 mr-4 bg-white/20 rounded-xl p-2">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-blue-100 mb-2 text-sm">Total Apprenants</p>
                    <h3 class="text-4xl font-bold">
                        <?php echo isset($statistics['totalStudents']) ? number_format($statistics['totalStudents']) : '0' ?>
                    </h3>
                    <div class="flex items-center mt-4 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>+5% ce mois</span>
                    </div>
                </div>
            </div>

            <!-- Sujets Stats -->
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 shadow-lg text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 mt-4 mr-4 bg-white/20 rounded-xl p-2">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-emerald-100 mb-2 text-sm">Sujets Validés</p>
                    <h3 class="text-4xl font-bold">
                        <?php echo isset($statistics['subjectStats']['approved']) ? number_format($statistics['subjectStats']['approved']) : '0' ?>
                    </h3>
                    <div class="mt-4 text-sm">
                        <span class="bg-white/20 px-2 py-1 rounded-lg">
                            <?php echo isset($statistics['subjectStats']['total']) ? number_format($statistics['subjectStats']['total']) : '0' ?> total
                        </span>
                    </div>
                </div>
            </div>

            <!-- Présentations -->
            <div class="bg-gradient-to-br from-violet-500 to-violet-600 rounded-2xl p-6 shadow-lg text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 mt-4 mr-4 bg-white/20 rounded-xl p-2">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-violet-100 mb-2 text-sm">Présentations Planifiées</p>
                    <h3 class="text-4xl font-bold">
                        <?php echo isset($statistics['presentations']['upcoming']) ? number_format($statistics['presentations']['upcoming']) : '0' ?>
                    </h3>
                    <div class="mt-4 text-sm">
                        <span class="bg-white/20 px-2 py-1 rounded-lg">
                            <?php echo isset($statistics['presentations']['completed']) ? number_format($statistics['presentations']['completed']) : '0' ?> complétées
                        </span>
                    </div>
                </div>
            </div>

            <!-- Taux de Participation -->
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl p-6 shadow-lg text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 mt-4 mr-4 bg-white/20 rounded-xl p-2">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-amber-100 mb-2 text-sm">Taux de Participation</p>
                    <h3 class="text-4xl font-bold">
                        <?php echo isset($statistics['participation']) ? number_format($statistics['participation'], 1) : '0' ?>%
                    </h3>
                    <div class="w-full bg-white/20 rounded-full h-2 mt-4">
                        <div class="bg-white h-2 rounded-full" style="width: <?php echo $statistics['participation'] ?? 0 ?>%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Sujets en Attente -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Sujets en Attente</h3>
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                        <?php echo isset($statistics['subjectStats']['pending']) ? number_format($statistics['subjectStats']['pending']) : '0' ?>
                    </span>
                </div>
                <div class="flex items-center text-gray-600">
                    <i class="fas fa-clock mr-2"></i>
                    <span>En cours de validation</span>
                </div>
            </div>

            <!-- Sujets Rejetés -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Sujets Rejetés</h3>
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                        <?php echo isset($statistics['subjectStats']['rejected']) ? number_format($statistics['subjectStats']['rejected']) : '0' ?>
                    </span>
                </div>
                <div class="flex items-center text-gray-600">
                    <i class="fas fa-times-circle mr-2"></i>
                    <span>Non validés</span>
                </div>
            </div>

            <!-- Moyenne Générale -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Moyenne Générale</h3>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                        <?php echo isset($statistics['averageGrade']) ? number_format($statistics['averageGrade'], 1) : '0' ?>/20
                    </span>
                </div>
                <div class="flex items-center text-gray-600">
                    <i class="fas fa-star mr-2"></i>
                    <span>Note moyenne des présentations</span>
                </div>
            </div>
        </div>

        <!-- Section Formateurs -->
        <div class="bg-white rounded-2xl shadow-lg mb-8 overflow-hidden border border-gray-100">
            <div class="relative p-8 border-b border-gray-100">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-50 to-indigo-50 opacity-50"></div>
                <div class="relative flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-purple-100 rounded-xl shadow-sm">
                            <i class="fas fa-chalkboard-teacher text-purple-600 text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Liste des Formateurs</h2>
                            <p class="text-gray-500 text-sm">Équipe pédagogique</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($apprenants as $user): ?>
                        <?php if ($user['role'] === 'Formateur'): ?>
                            <div class="group bg-white rounded-xl p-6 hover:shadow-lg transition-all duration-300 border border-gray-100 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 to-indigo-50/50 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                                
                                <div class="relative flex items-start space-x-4">
                                    <div class="relative group-hover:transform group-hover:scale-105 transition-all duration-300">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden shadow-sm border-2 border-gray-50">
                                            <img src="https://intranet.youcode.ma/storage/users/profile/thumbnail/1176-1730909420.jpg" 
                                                 alt="<?php echo htmlspecialchars($user['nom']) ?>" 
                                                 class="w-full h-full object-cover">
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-gradient-to-br from-blue-400 to-green-500
                                            <?php echo $user['status'] == 'actif' 
                                                
                                                ?> 
                                            border-2 border-white shadow-sm"></div>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h3 class="font-semibold text-gray-800 group-hover:text-purple-600 transition-colors truncate">
                                                    <?php echo htmlspecialchars($user['nom']) ?>
                                                </h3>
                                                <p class="text-gray-500 text-sm flex items-center gap-1">
                                                    <i class="far fa-envelope text-gray-400"></i>
                                                    <span class="truncate"><?php echo htmlspecialchars($user['email']) ?></span>
                                                </p>
                                            </div>
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium 
                                                <?php echo $user['status'] === 'active' 
                                                    ? 'bg-green-50 text-green-700 ring-1 ring-green-600/10' 
                                                    : 'bg-red-50 text-red-700 ring-1 ring-red-600/10' ?>">
                                                <span class="w-1 h-1 rounded-full bg-green-600
                                                    <?php echo $user['status'] === 'active' 
                                                         ?> 
                                                    mr-1.5"></span>
                                                <?php echo $user['status'] ?>
                                            </span>
                                        </div>

                                        <!-- Actions avec animation au hover -->
                                        <div class="mt-4 flex gap-2 transform translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                            <a href="/Formateur/toggle-status/<?php echo $user['id_user'] ?>" 
                                               class="flex-1 py-2 px-3 rounded-lg text-sm font-medium inline-flex items-center justify-center gap-2
                                                <?php echo $user['status'] === 'active' 
                                                    ? 'bg-red-50 text-red-600 hover:bg-red-100 ring-1 ring-red-500/10' 
                                                    : 'bg-green-50 text-green-600 hover:bg-green-100 ring-1 ring-green-500/10' ?> 
                                                transition-all duration-300"
                                               onclick="return confirm('Êtes-vous sûr de vouloir <?php echo $user['status'] === 'active' ? 'désactiver' : 'activer' ?> ce compte ?');">
                                                <i class="fas <?php echo $user['status'] === 'active' ? 'fa-user-slash' : 'fa-user-check' ?>"></i>
                                                <span><?php echo $user['status'] === 'active' ? 'Désactiver' : 'Activer' ?></span>
                                            </a>
                                            
                                            <a href="/formateur/delete/<?php echo $user['id_user'] ?>" 
                                               class="flex-1 py-2 px-3 rounded-lg text-sm font-medium inline-flex items-center justify-center gap-2 
                                               bg-red-50 text-red-600 hover:bg-red-100 ring-1 ring-red-500/10 transition-all duration-300"
                                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                                                <i class="fas fa-trash"></i>
                                                <span>Supprimer</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Liste des Apprenants -->
        <div class="bg-white rounded-2xl shadow-lg mb-8 overflow-hidden border border-gray-100">
            <!-- Header avec effet moderne -->
            <div class="relative p-8 border-b border-gray-100">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-indigo-50 opacity-50"></div>
                <div class="relative flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-blue-100 rounded-xl shadow-sm">
                            <i class="fas fa-users text-blue-600 text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">
                                Liste des Apprenants
                            </h2>
                            <p class="text-gray-500 text-sm">Gérez vos apprenants</p>
                        </div>
                    </div>
                    <div class="relative">
                        <input type="text" 
                               placeholder="Rechercher un apprenant..." 
                               class="px-4 py-2 pr-10 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-300 text-gray-600 placeholder-gray-400 shadow-sm">
                        <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Grid des apprenants -->
            <div class="p-8 bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($apprenants as $apprenant): ?>
                    <div class="group bg-white rounded-xl p-6 hover:shadow-lg transition-all duration-300 border border-gray-100 relative overflow-hidden">
                        <!-- Effet de gradient subtil au hover -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-indigo-50/50 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        
                        <div class="relative flex items-start space-x-4">
                            <!-- Photo de profil avec animation -->
                            <div class="relative group-hover:transform group-hover:scale-105 transition-all duration-300">
                                <div class="w-16 h-16 rounded-xl overflow-hidden shadow-sm border-2 border-gray-50">
                                    <img src="https://intranet.youcode.ma/storage/users/profile/thumbnail/1176-1730909420.jpg" 
                                         alt="<?php echo $apprenant['nom'] ?>" 
                                         class="w-full h-full object-cover">
                                </div>
                                <!-- Indicateur de statut amélioré -->
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full 
                                    <?php echo $apprenant['status'] === 'active' 
                                        ? 'bg-gradient-to-br from-green-400 to-green-500' 
                                        : 'bg-gradient-to-br from-red-400 to-red-500' ?> 
                                    border-2 border-white shadow-sm"></div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors truncate">
                                            <?php echo $apprenant['nom'] ?>
                                        </h3>
                                        <p class="text-gray-500 text-sm flex items-center gap-1">
                                            <i class="far fa-envelope text-gray-400"></i>
                                            <span class="truncate"><?php echo $apprenant['email'] ?></span>
                                        </p>
                                    </div>
                                    <!-- Badge de statut amélioré -->
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium 
                                        <?php echo $apprenant['status'] === 'active' 
                                            ? 'bg-green-50 text-green-700 ring-1 ring-green-600/10' 
                                            : 'bg-red-50 text-red-700 ring-1 ring-red-600/10' ?>">
                                        <span class="w-1 h-1 rounded-full bg-green-600
                                            <?php echo $apprenant['status'] 
                                                ?> 
                                            mr-1.5"></span>
                                        <?php echo $apprenant['status'] ?>
                                    </span>
                                </div>

                                <!-- Actions avec animation au hover -->
                                <div class="mt-4 flex gap-2 transform translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                    <a href="/Formateur/toggle-status/<?php echo $apprenant['id_user'] ?>" 
                                       class="flex-1 py-2 px-3 rounded-lg text-sm font-medium inline-flex items-center justify-center gap-2
                                        <?php echo $apprenant['status'] === 'active' 
                                            ? 'bg-red-50 text-red-600 hover:bg-red-100 ring-1 ring-red-500/10' 
                                            : 'bg-green-50 text-green-600 hover:bg-green-100 ring-1 ring-green-500/10' ?> 
                                        transition-all duration-300"
                                       onclick="return confirm('Êtes-vous sûr de vouloir <?php echo $apprenant['status'] === 'active' ? 'désactiver' : 'activer' ?> ce compte ?');">
                                        <i class="fas <?php echo $apprenant['status'] === 'active' ? 'fa-user-slash' : 'fa-user-check' ?>"></i>
                                        <span><?php echo $apprenant['status'] === 'active' ? 'Désactiver' : 'Activer' ?></span>
                                    </a>
                                    
                                    <a href="/formateur/delete/<?php echo $apprenant['id_user'] ?>" 
                                       class="flex-1 py-2 px-3 rounded-lg text-sm font-medium inline-flex items-center justify-center gap-2 
                                       bg-red-50 text-red-600 hover:bg-red-100 ring-1 ring-red-500/10 transition-all duration-300"
                                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                                        <i class="fas fa-trash"></i>
                                        <span>Supprimer</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
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