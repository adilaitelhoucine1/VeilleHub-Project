<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Étudiant - Veilles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    
    <?php include(__DIR__ . '/../components/sidebar.php'); ?>

   
    <div class="ml-64 p-8">
       
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Tableau de bord</h1>
                <p class="text-gray-600 capitalize  ">Bienvenue M. <?php echo $user_name ?>  sur votre espace étudiant</p>
            </div>
            <div class="flex items-center space-x-4">
                <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-plus mr-2"></i>Nouvelle suggestion
                </button>
                <div class="relative">
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full"></span>
                    <img src="https://ui-avatars.com/api/?name=John+Doe" alt="Profile" 
                         class="w-10 h-10 rounded-full border-2 border-gray-200">
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-600">Présentations</h3>
                    <i class="fas fa-presentation text-blue-500"></i>
                </div>
                <p class="text-2xl font-bold text-gray-800 mt-2">5</p>
                <p class="text-sm text-gray-500">Réalisées ce semestre</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-600">Note moyenne</h3>
                    <i class="fas fa-star text-yellow-500"></i>
                </div>
                <p class="text-2xl font-bold text-gray-800 mt-2">4.5/5</p>
                <p class="text-sm text-gray-500">Basée sur 5 évaluations</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-600">Classement</h3>
                    <i class="fas fa-trophy text-orange-500"></i>
                </div>
                <p class="text-2xl font-bold text-gray-800 mt-2">#3</p>
                <p class="text-sm text-gray-500">Sur 24 étudiants</p>
            </div>
        </div>

        <!-- Présentations -->
        <div class="bg-white rounded-xl shadow-sm mb-8">
            <div class="p-6 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Mes présentations</h2>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100">À venir</button>
                    <button class="px-4 py-2 text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100">Passées</button>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Présentations à venir -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">Introduction à React Native</h3>
                            <p class="text-sm text-gray-600">15 Mars 2024 - 14:00</p>
                            <div class="mt-2 flex items-center">
                                <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">Salle: A204</span>
                                <span class="ml-2 text-sm text-gray-500">Durée: 30min</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 text-blue-600 hover:bg-blue-50 rounded">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="px-3 py-1 text-red-600 hover:bg-red-50 rounded">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Présentations passées -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg opacity-75">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">Les bases de Git</h3>
                            <p class="text-sm text-gray-600">1 Mars 2024 - 14:00</p>
                            <div class="mt-2 flex items-center">
                                <span class="text-sm bg-green-100 text-green-800 px-2 py-1 rounded">Note: 18/20</span>
                                <span class="ml-2 text-sm text-gray-500">Commentaires: 3</span>
                            </div>
                        </div>
                        <button class="px-3 py-1 text-blue-600 hover:bg-blue-50 rounded">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <!-- <div class="fixed bottom-4 right-4">
            <div class="bg-white p-4 rounded-lg shadow-lg border-l-4 border-blue-500 max-w-md">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-semibold text-gray-800">Nouvelle notification</h4>
                        <p class="text-sm text-gray-600 mt-1">Votre présentation "React Native" a été confirmée.</p>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Suggestions et Classement -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Suggestions -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Mes suggestions</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <div>
                                <h3 class="font-semibold text-gray-800">Intelligence Artificielle</h3>
                                <p class="text-sm text-gray-600">Soumis le 10 Mars</p>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                Approuvé
                            </span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <div>
                                <h3 class="font-semibold text-gray-800">Cybersécurité</h3>
                                <p class="text-sm text-gray-600">Soumis le 5 Mars</p>
                            </div>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                En attente
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Classement -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Top 3 du classement</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="w-8 h-8 flex items-center justify-center bg-yellow-200 rounded-full mr-3">1</span>
                                <span class="font-semibold text-gray-800">Jane Doe</span>
                            </div>
                            <span class="font-bold text-gray-800">150 pts</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full mr-3">2</span>
                                <span class="font-semibold text-gray-800">John Smith</span>
                            </div>
                            <span class="font-bold text-gray-800">120 pts</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-orange-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="w-8 h-8 flex items-center justify-center bg-orange-200 rounded-full mr-3">3</span>
                                <span class="font-semibold text-gray-800">Alice Johnson</span>
                            </div>
                            <span class="font-bold text-gray-800">100 pts</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nouvelle Suggestion -->
    <div id="newSuggestionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full" style="z-index: 999;">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-xl font-semibold text-gray-800">Nouvelle suggestion de sujet</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form class="mt-4" action="/addSuggestion" method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="titre">
                            Titre du sujet
                        </label>
                        <input type="text" id="titre"  name="titre"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Ex: Intelligence Artificielle">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                            Description
                        </label>
                        <textarea id="description" rows="4" name="description"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Décrivez votre sujet..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            Soumettre
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour ouvrir le modal
        function openModal() {
            document.getElementById('newSuggestionModal').classList.remove('hidden');
        }

        // Fonction pour fermer le modal
        function closeModal() {
            document.getElementById('newSuggestionModal').classList.add('hidden');
        }

        // Ajouter l'événement click au bouton "Nouvelle suggestion"
        document.querySelector('button:contains("Nouvelle suggestion")').onclick = openModal;
    </script>
</body>
</html>