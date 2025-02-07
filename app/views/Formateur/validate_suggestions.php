<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des Suggestions - YouCode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Theme principal */
        :root {
            --primary: #2563EB;
            --primary-light: #60A5FA;
            --primary-dark: #1E40AF;
            --success: #10B981;
            --danger: #EF4444;
        }

        /* Cards */
        .stat-card {
            background: white;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: all 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Buttons */
        .btn-action {
            transition: all 0.2s;
        }

        .btn-action:hover {
            transform: translateY(-1px);
        }

        .btn-approve {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .btn-approve:hover {
            background: rgba(16, 185, 129, 0.2);
        }

        .btn-reject {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .btn-reject:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Suggestion cards */
        .suggestion-card {
            transition: all 0.2s;
        }

        .suggestion-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
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
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Validation des Suggestions</h1>
                <p class="text-gray-600">Gérez les suggestions de veilles proposées par les apprenants</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full"></span>
                    <img src="https://ui-avatars.com/api/?background=3B82F6&color=fff" alt="Profile" 
                         class="w-10 h-10 rounded-full border-2 border-gray-200">
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 mb-1">En attente</p>
                        <h3 class="text-3xl font-bold text-blue-600">12</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i class="fas fa-clock text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 mb-1">Suggestions approuvées</p>
                        <h3 class="text-3xl font-bold text-green-600">45</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 mb-1">Suggestions rejetées</p>
                        <h3 class="text-3xl font-bold text-red-600">8</h3>
                    </div>
                    <div class="bg-red-100 p-3 rounded-lg">
                        <i class="fas fa-times text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des suggestions -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Suggestions en attente</h2>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    <?php foreach($suggestions as $suggest) {?>
                    <div class="bg-gray-50 p-6 rounded-xl hover:bg-gray-100 transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <i class="fas fa-lightbulb text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800"><?= $suggest['titre'] ?></h3>
                                    <p class="text-gray-600">Proposé par : <?= $suggest['nom'] ?></p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="/Formateur/approve-suggestion/<?= $suggest['id_sujet'] ?>" 
                                   class="bg-green-100 text-green-600 px-4 py-2 rounded-lg hover:bg-green-200 transition-colors">
                                    <i class="fas fa-check mr-2"></i>Approuver
                                </a>
                                <a href="/Formateur/reject-suggestion/<?= $suggest['id_sujet'] ?>" 
                                   class="bg-red-100 text-red-600 px-4 py-2 rounded-lg hover:bg-red-200 transition-colors">
                                    <i class="fas fa-times mr-2"></i>Rejeter
                                </a>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-gray-600"><?= $suggest['description'] ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 