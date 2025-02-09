<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe - YouCode Innovation Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-[Poppins] bg-gradient-to-b from-indigo-50 to-white min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="https://intranet.youcode.ma/src/img/logo-white.png" 
                 alt="YouCode" 
                 class="h-12 w-auto mx-auto"
                 style="filter: brightness(0);">
            <h1 class="text-2xl font-bold mt-4 text-gray-800">Réinitialisation du mot de passe</h1>
        </div>

        <!-- Card -->
        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-xl">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="mb-6 p-4 bg-green-50 text-green-600 rounded-xl">
                    <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="/reset-password" method="POST">
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Adresse email
                    </label>
                    <input type="email" 
                           id="email"
                           name="email" 
                           required
                           placeholder="Entrez votre adresse email" 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
                </div>

                <button type="submit" 
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white hover:from-indigo-600 hover:to-pink-600 transition-all">
                    Envoyer le lien de réinitialisation
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="/login" class="text-sm text-indigo-600 hover:text-indigo-700">
                    Retour à la connexion
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-sm text-gray-500">
            <p>© <?php echo date('Y'); ?> YouCode Innovation Hub. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html> 