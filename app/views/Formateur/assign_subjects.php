<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attribution des Sujets - YouCode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Attribution des Sujets</h1>
                <p class="text-gray-600">Assignez les sujets validés aux étudiants</p>
            </div>
        </div>

        <!-- Liste des sujets validés -->
        <div class="bg-white rounded-xl shadow-sm mb-8">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Sujets Validés</h2>
            </div>
            <div class="p-6">
                <?php foreach($suggestions as $data) {?>
                <div class="bg-gray-50 p-6 rounded-xl mb-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800"><?= $data['titre'] ?></h3>
                            <p class="text-gray-600 mt-1 capitalize">Proposé par <?= $data['proposer_name'] ?></p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">
                            <?= $data['status'] ?>
                        </span>
                    </div>
                    <p class="text-gray-600 mb-6"><?= $data['description'] ?></p>
                    
                    <!-- Liste des étudiants assignés -->
                    <div class="border-t pt-4">
                        <h4 class="text-lg font-semibold mb-4 text-gray-800">Étudiants assignés</h4>
                        <div class="flex flex-wrap gap-4 mb-6">
                            <?php foreach($data['assigned_students'] as $student) { ?>
                            <div class="flex items-center bg-blue-50 px-4 py-2 rounded-lg">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <span class="text-gray-700"><?= $student['nom'] ?></span>
                            </div>
                            <?php } ?>
                        </div>

                        <!-- Formulaire d'assignation -->
                        <form action="/Formateur/assign-students" method="POST" class="bg-gray-50 rounded-lg p-4">
                            <input type="hidden" name="sujet_id" value="<?= $data['id_sujet'] ?>">
                            <div class="space-y-2 max-h-[300px] overflow-y-auto mb-4">
                                <?php foreach($students as $student) { ?>
                                <label class="flex items-center p-3 hover:bg-gray-100 rounded-lg cursor-pointer">
                                    <input type="checkbox" name="students[]" value="<?= $student['id_user'] ?>"
                                           class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300">
                                    <div class="ml-4">
                                        <p class="font-medium text-gray-700"><?= $student['nom'] ?></p>
                                        <?php if(isset($student['email'])) { ?>
                                        <p class="text-sm text-gray-500"><?= $student['email'] ?></p>
                                        <?php } ?>
                                    </div>
                                </label>
                                <?php } ?>
                            </div>
                            <div class="flex justify-end pt-4 border-t">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                                    <i class="fas fa-user-plus mr-2"></i>Assigner les étudiants
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</body>
</html> 