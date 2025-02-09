<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Veilles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <?php include(__DIR__ . '/../components/sidebar.php'); ?>

    <div class="ml-64 p-8">
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Statistiques</h1>
                <p class="text-gray-600">Vue d'ensemble de vos activités</p>
            </div>
        </div>

        <!-- Cartes statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-600">Total Présentations</h3>
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-800"><?php echo $statistics['total_presentations'] ?></p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-600">Suggestions</h3>
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-lightbulb text-green-600"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-800"><?php echo $statistics['total_suggestions'] ?></p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-600">Suggestions Approuvées</h3>
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <i class="fas fa-check text-purple-600"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-800"><?php echo $statistics['approved_suggestions'] ?></p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-600">Présentations Complétées</h3>
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <i class="fas fa-flag-checkered text-yellow-600"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-800"><?php echo $statistics['completed_presentations'] ?></p>
            </div>
        </div>

        <!-- Classement -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="p-6 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Classement Global</h2>
                <div class="text-sm text-gray-500">
                    <i class="fas fa-trophy text-yellow-400 mr-1"></i>
                    Top 10
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4" id="rankingList">
                    <?php foreach ($ranking as $index => $user): ?>
                        <div class="flex items-center justify-between p-4 
                            <?php echo $index === 0 ? 'bg-yellow-50' : 
                                ($index === 1 ? 'bg-gray-50' : 
                                ($index === 2 ? 'bg-orange-50' : 'bg-white')); ?> 
                            rounded-lg hover:bg-opacity-75 transition-colors">
                            <div class="flex items-center space-x-4">
                                <span class="w-8 h-8 flex items-center justify-center 
                                    <?php echo $index === 0 ? 'bg-yellow-200' : 
                                        ($index === 1 ? 'bg-gray-200' : 
                                        ($index === 2 ? 'bg-orange-200' : 'bg-blue-100')); ?> 
                                    rounded-full font-semibold">
                                    <?php echo $index + 1; ?>
                                </span>
                                <div>
                                    <span class="font-semibold text-gray-800"><?php echo htmlspecialchars($user['nom']); ?></span>
                                    <div class="text-xs text-gray-500 mt-1">
                                        <span class="mr-2">
                                            <i class="fas fa-chalkboard-teacher"></i> <?php echo $user['presentations_count']; ?> présentations
                                        </span>
                                        <span>
                                            <i class="fas fa-lightbulb"></i> <?php echo $user['suggestions_count']; ?> suggestions
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="font-bold text-gray-800"><?php echo $user['total_points']; ?> pts</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 