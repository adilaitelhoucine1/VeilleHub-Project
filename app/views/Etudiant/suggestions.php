<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestions - Veilles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <?php include(__DIR__ . '/../components/sidebar.php'); ?>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Mes Suggestions</h1>
                <p class="text-gray-600">Gérez vos propositions de sujets de veille</p>
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
                    <h3 class="text-gray-600">Total Suggestions</h3>
                    <i class="fas fa-lightbulb text-blue-500"></i>
                </div>
                <p class="text-2xl font-bold text-gray-800 mt-2">12</p>
                <p class="text-sm text-gray-500">Proposées ce semestre</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-600">Suggestions Approuvées</h3>
                    <i class="fas fa-check text-green-500"></i>
                </div>
                <p class="text-2xl font-bold text-gray-800 mt-2">8</p>
                <p class="text-sm text-gray-500">Sur 12 suggestions</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-600">En Attente</h3>
                    <i class="fas fa-clock text-yellow-500"></i>
                </div>
                <p class="text-2xl font-bold text-gray-800 mt-2">3</p>
                <p class="text-sm text-gray-500">À valider</p>
            </div>
        </div>

        <!-- Liste des suggestions -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Toutes mes suggestions</h2>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100">Toutes</button>
                    <button class="px-4 py-2 text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100">En attente</button>
                    <button class="px-4 py-2 text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100">Approuvées</button>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    <?php if(empty($suggestions)): ?>
                        <div class="text-center py-8">
                            <p class="text-gray-500">Aucune suggestion pour le moment</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($suggestions as $suggest): ?> 
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="p-6">
                                    <div class="flex flex-col sm:flex-row justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-4">
                                                <h3 class="text-xl font-bold text-gray-800">
                                                    <?= $suggest['titre'] ?>
                                                </h3>
                                                <span class="text-sm text-gray-500 flex items-center">
                                                    <i class="far fa-clock mr-2"></i>
                                                    <?= $suggest['date_creation'] ?>
                                                </span>
                                            </div>
                                            
                                            <p class="text-gray-600 mb-4 leading-relaxed">
                                                <?= $suggest['description'] ?>
                                            </p>
                                            
                                            <div class="flex flex-wrap items-center justify-between gap-4">
                                                <div class="flex items-center gap-4">
                                                    <span class="px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 flex items-center">
                                                        <i class="fas fa-clock mr-2"></i>
                                                        <?= $suggest['status'] ?>
                                                    </span>
                                                </div>
                                                
                                                <div class="flex items-center gap-3">
                                                    <button onclick="openEditModal('<?= $suggest['id_sujet'] ?>', '<?= $suggest['titre'] ?>', '<?= $suggest['description'] ?>')" 
                                                            class="flex items-center px-3 py-1.5 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                                        <i class="fas fa-edit mr-2"></i>
                                                        Modifier
                                                    </button>
                                                    <a href="/Etudiant/deleteSuggestion/<?= $suggest['id_sujet'] ?>" 
                                                       class="flex items-center px-3 py-1.5 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                                                        <i class="fas fa-trash-alt mr-2"></i>
                                                        Supprimer
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nouvelle Suggestion -->
    <div id="newSuggestionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center pb-3">
                        <h3 class="text-xl font-semibold text-gray-800">Nouvelle suggestion de sujet</h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500 transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form class="mt-4" action="/addSuggestion" method="POST">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="titre">
                                    Titre du sujet
                                </label>
                                <input type="text" id="titre" name="titre" required
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                    Description
                                </label>
                                <textarea id="description" name="description" rows="4" required
                                    class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>
                            <div class="flex flex-col sm:flex-row justify-end gap-3">
                                <button type="button" onclick="closeModal()"
                                    class="w-full sm:w-auto px-4 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                                    Annuler
                                </button>
                                <button type="submit"
                                    class="w-full sm:w-auto px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                                    Soumettre
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de modification -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center pb-3">
                        <h3 class="text-xl font-semibold text-gray-800">Modifier la suggestion</h3>
                        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form action="/Etudiant/updateSuggestion" method="POST">
                        <input type="hidden" id="editId" name="id_sujet">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="editTitre">Titre</label>
                                <input type="text" id="editTitre" name="titre" required class="shadow-sm border rounded w-full py-2 px-3 text-gray-700">
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="editDescription">Description</label>
                                <textarea id="editDescription" name="description" rows="4" required class="shadow-sm border rounded w-full py-2 px-3 text-gray-700"></textarea>
                            </div>
                            <div class="flex justify-end gap-3">
                                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300">Annuler</button>
                                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('newSuggestionModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('newSuggestionModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openEditModal(id, titre, description) {
            document.getElementById('editId').value = id;
            document.getElementById('editTitre').value = titre;
            document.getElementById('editDescription').value = description;
            document.getElementById('editModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function confirmDelete(id) {
            if(confirm('Êtes-vous sûr de vouloir supprimer cette suggestion ?')) {
                window.location.href = `/deleteSuggestion/${id}`;
            }
        }
    </script>
</body>
</html> 