<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - YouCode Innovation Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    
    <?php include(__DIR__ . '/../components/sidebar.php'); ?>

    <div class="ml-64 p-8">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Statistiques détaillées</h1>
                <p class="text-gray-600">Analyse de vos performances</p>
            </div>
            <a href="/Etudiant/dashboard" class="text-blue-600 hover:text-blue-700">
                <i class="fas fa-arrow-left mr-2"></i>Retour au tableau de bord
            </a>
        </div>

        <!-- Statistiques générales -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-600">Total présentations</h3>
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-800"><?php echo $stats['total_presentations'] ?></p>
                <p class="text-sm text-gray-500 mt-2">Depuis le début</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-600">Total suggestions</h3>
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-lightbulb text-green-600"></i>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-800"><?php echo $stats['total_suggestions'] ?></p>
                <p class="text-sm text-gray-500 mt-2">Proposées</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-600">Points accumulés</h3>
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <i class="fas fa-star text-purple-600"></i>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-800"><?php echo $stats['total_points'] ?></p>
                <p class="text-sm text-gray-500 mt-2">Total</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-600">Position classement</h3>
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <i class="fas fa-trophy text-yellow-600"></i>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-800"><?php echo $stats['rank'] ?></p>
                <p class="text-sm text-gray-500 mt-2">Sur <?php echo $stats['total_users'] ?> étudiants</p>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Évolution des points -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Évolution des points</h3>
                <canvas id="pointsChart"></canvas>
            </div>

            <!-- Répartition des activités -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Répartition des activités</h3>
                <canvas id="activitiesChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Graphique d'évolution des points
        const pointsCtx = document.getElementById('pointsChart').getContext('2d');
        new Chart(pointsCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($stats['points_labels']) ?>,
                datasets: [{
                    label: 'Points',
                    data: <?php echo json_encode($stats['points_data']) ?>,
                    borderColor: '#4F46E5',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Graphique de répartition des activités
        const activitiesCtx = document.getElementById('activitiesChart').getContext('2d');
        new Chart(activitiesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Présentations', 'Suggestions approuvées', 'Suggestions en attente'],
                datasets: [{
                    data: [
                        <?php echo $stats['total_presentations'] ?>,
                        <?php echo $stats['approved_suggestions'] ?>,
                        <?php echo $stats['pending_suggestions'] ?>
                    ],
                    backgroundColor: ['#4F46E5', '#10B981', '#F59E0B']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html> 