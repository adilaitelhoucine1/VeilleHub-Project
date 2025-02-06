<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attribution des Sujets - YouCode</title>
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
                    <i class="fas fa-lightbulb mr-3"></i>Propositions
                </a>
                <a href="/Formateur/Showsubjects" class="flex items-center px-4 py-3 rounded-lg hover-gradient transition-all duration-300">
                    <i class="fas fa-tasks mr-3"></i>Attribution Sujets
                    <!-- <span class="ml-auto bg-blue-500 text-xs px-2 py-1 rounded-full">Nouveau</span> -->
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
                    Attribution des Sujets
                </h1>
                <p class="text-blue-300">Assignez les sujets validés aux étudiants</p>
            </div>
        </div>

        <!-- Liste des sujets validés -->
        <div class="glass-card rounded-xl mb-8">
            <div class="p-6 border-b border-blue-800/30">
                <h2 class="text-2xl font-semibold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-200">
                    Sujets Validés
                </h2>
            </div>
            <div class="p-6">
                <?php foreach($suggestions as $data) {?>
                <div class="glass-card p-6 rounded-xl mb-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-white"><?= $data['titre'] ?></h3>
                            <p class="text-blue-300 mt-1 capitalize">Proposé par <?= $data['proposer_name'] ?></p>
                        </div>
                        <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-sm">
                            <?= $data['status'] ?>
                        </span>
                    </div>
                    <p class="text-gray-300 mb-6"><?= $data['description'] ?></p>
                    
                    <div class="border-t border-blue-800/30 pt-4">
                        <h4 class="text-lg font-semibold mb-4">Attribution aux Étudiants</h4>
                        
                        <div class="flex flex-wrap gap-4 mb-6">
                            <?php foreach($data['assigned_students'] as $student) { ?>
                            <div class="flex items-center bg-blue-900/30 px-4 py-2 rounded-lg hover:bg-blue-800/40 transition-colors">
                                <div class="w-8 h-8 rounded-full bg-blue-500/20 flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-300"></i>
                                </div>
                                <span class="font-medium"><?= $student['nom'] ?></span>
                                <button class="ml-3 text-red-400 hover:text-red-300 transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <?php } ?>
                        </div>
                        
                        <div class="bg-blue-900/30 border border-blue-700 rounded-lg overflow-hidden">
                            <div class="sticky top-0 bg-blue-900/50 p-4 backdrop-blur-sm border-b border-blue-700">
                                <h3 class="text-lg font-semibold text-blue-200">
                                    <i class="fas fa-users mr-2"></i>
                                    Liste des Étudiants Disponibles
                                </h3>
                            </div>
                            
                            <form action="/Formateur/assign-students" method="POST" class="p-4">
                                <input type="hidden" name="sujet_id" value="<?= $data['id_sujet'] ?>">
                                
                                <div class="space-y-2 max-h-[300px] overflow-y-auto mb-4">
                                    <?php foreach($students as $student) { ?>
                                    <label class="flex items-center p-3 hover:bg-blue-800/40 rounded-lg cursor-pointer transition-all duration-200 border border-transparent hover:border-blue-500/30 group">
                                        <input type="checkbox" 
                                               name="students[]" 
                                               value="<?= $student['id_user'] ?>"
                                               class="form-checkbox h-5 w-5 text-blue-500 rounded-md border-blue-400 focus:ring-blue-500 focus:ring-offset-0">
                                        
                                        <div class="ml-4 flex-1">
                                            <p class="font-medium text-white"><?= $student['nom'] ?></p>
                                            <?php if(isset($student['email'])) { ?>
                                            <p class="text-xs text-blue-300"><?= $student['email'] ?></p>
                                            <?php } ?>
                                        </div>
                                        
                                        <span class="text-blue-300">
                                            <i class="fas fa-check opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                        </span>
                                    </label>
                                    <?php } ?>
                                </div>

                                <div class="flex justify-end pt-4 border-t border-blue-700">
                                    <button type="submit" 
                                            class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-lg transition-colors flex items-center space-x-2">
                                        <i class="fas fa-user-plus"></i>
                                        <span>Assigner les étudiants</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>


</body>
</html> 