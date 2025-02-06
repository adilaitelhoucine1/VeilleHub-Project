<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mes Présentations - YouCode</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body class="bg-gray-100">
    
        <?php include(__DIR__ . '/../components/sidebar.php'); ?>
        

        <div class="ml-64 p-8">
        
       
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Mes Présentations</h1>
                <p class="text-gray-600">Gérez vos présentations de veille</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-plus mr-2"></i>Planifier une présentation
                </button>
            </div>
        </div>


        <div class="bg-white p-6 rounded-xl shadow-sm mb-6">
            <div class="flex space-x-4">
                <button class="px-4 py-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100">Toutes</button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">À venir</button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg">Passées</button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 space-y-6">
                <?php foreach($presentation as $data): ?>
                    <div class="bg-white p-4 rounded-lg shadow mb-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-bold text-lg"><?= $data['titre'] ?></h3>
                                <p class="text-gray-600 mt-2"><?= $data['description'] ?></p>
                                <div class="flex items-center mt-3 text-sm text-blue-600">
                                    <i class="fas fa-users mr-2"></i>
                                    <span>Membres: <?= str_replace(',', ', ', $data['membres']) ?></span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-full transition-colors" 
                                        >
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="p-2 text-green-600 hover:bg-green-50 rounded-full transition-colors" 
                                        >
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html> 