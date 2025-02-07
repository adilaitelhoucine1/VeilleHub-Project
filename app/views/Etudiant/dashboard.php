<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Étudiant - Veilles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- FullCalendar Dependencies -->
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.10/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/locales/fr.global.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
</head>
<body class="bg-gray-100">
    
    <?php include(__DIR__ . '/../components/sidebar.php'); ?>

   
    <div class="ml-64 p-8">
       
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Tableau de bord</h1>
                <p class="text-gray-600 capitalize">Bienvenue M. <?php echo htmlspecialchars($user_name) ?></p>
            </div>
            <div class="flex items-center space-x-4">
                <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-plus mr-2"></i>Nouvelle suggestion
                </button>
                <div class="relative">
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full"></span>
                    <img src="https://intranet.youcode.ma/storage/users/profile/thumbnail/1160-1730909393.jpg" 
                         alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200">
                </div>
            </div>
        </div>

        <!-- Cartes statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-600">Présentations</h3>
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-800 mt-2"><?php echo count($presentations) ?></p>
                <p class="text-sm text-gray-500">Programmées</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-600">Suggestions</h3>
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-lightbulb text-green-600"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-800 mt-2"><?php echo count($suggestions ?? []) ?></p>
                <p class="text-sm text-gray-500">Proposées</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-600">Prochaine présentation</h3>
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <i class="fas fa-calendar text-purple-600"></i>
                    </div>
                </div>
                <?php 
                $nextPresentation = !empty($presentations) ? reset($presentations) : null;
                if ($nextPresentation): ?>
                    <p class="text-lg font-semibold text-gray-800 mt-2"><?php echo htmlspecialchars($nextPresentation['titre']) ?></p>
                    <p class="text-sm text-gray-500"><?php echo date('d/m/Y', strtotime($nextPresentation['presentation_date'])) ?></p>
                <?php else: ?>
                    <p class="text-lg font-semibold text-gray-800 mt-2">Aucune</p>
                    <p class="text-sm text-gray-500">programmée</p>
                <?php endif; ?>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-600">État des suggestions</h3>
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <i class="fas fa-chart-pie text-yellow-600"></i>
                    </div>
                </div>
                <?php
                $approved = array_filter($suggestions ?? [], function($s) { return $s['status'] === 'approved'; });
                $pending = array_filter($suggestions ?? [], function($s) { return $s['status'] === 'pending'; });
                ?>
                <div class="flex items-center space-x-4 mt-2">
                    <div>
                        <p class="text-xl font-bold text-green-600"><?php echo count($approved) ?></p>
                        <p class="text-xs text-gray-500">Approuvées</p>
                    </div>
                    <div>
                        <p class="text-xl font-bold text-blue-600"><?php echo count($pending) ?></p>
                        <p class="text-xs text-gray-500">En attente</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendrier -->
 

        <!-- Présentations récentes -->
        <div class="bg-white rounded-xl shadow-sm mb-8">
            <div class="p-6 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Présentations récentes</h2>
                <a href="/Etudiant/presentations" class="text-blue-600 hover:text-blue-700 text-sm">
                    Voir tout <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <?php foreach (array_slice($presentations, 0, 3) as $presentation): ?>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-800"><?php echo htmlspecialchars($presentation['titre']) ?></h3>
                                <p class="text-sm text-gray-600">
                                    <?php echo date('d/m/Y - H:i', strtotime($presentation['presentation_date'])) ?>
                                </p>
                                <div class="mt-2 flex items-center">
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-users mr-1"></i>
                                        <?php echo htmlspecialchars($presentation['student_names']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek'
                },
                events: {
                    url: '/Etudiant/calendar-events',
                    failure: function(error) {
                        console.error('Error loading events:', error);
                    }
                },
                eventDidMount: function(info) {
                    // Création d'un tooltip personnalisé
                    tippy(info.el, {
                        content: `
                            <div class="p-2">
                                <strong>${info.event.title}</strong><br>
                                <span class="text-sm">${info.event.extendedProps.description}</span><br>
                                <span class="text-xs">${moment(info.event.start).format('HH:mm')}</span>
                            </div>
                        `,
                        allowHTML: true,
                        theme: 'light'
                    });
                },
                eventContent: function(arg) {
                    return {
                        html: `
                            <div class="fc-content p-1">
                                <div class="font-semibold">${arg.event.title}</div>
                                <div class="text-xs opacity-75">
                                    ${moment(arg.event.start).format('HH:mm')}
                                </div>
                            </div>
                        `
                    };
                },
                themeSystem: 'standard',
                height: 'auto',
                contentHeight: 'auto',
                firstDay: 1,
                locale: 'fr',
                buttonText: {
                    today: "Aujourd'hui",
                    month: 'Mois',
                    week: 'Semaine'
                },
                dayHeaderFormat: { weekday: 'long' },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false,
                    hour12: false
                }
            });
            
            calendar.render();
            
            // Debug
            console.log('Calendar initialized');
            
            // Vérifier si les événements sont chargés
            calendar.on('eventsSet', function(events) {
                console.log('Events loaded:', events);
            });
        });
    </script>

    <style>
        /* Styles du calendrier */
        .fc {
            background: white;
            border-radius: 0.75rem;
            padding: 1rem;
        }

        .fc-header-toolbar {
            padding: 1rem;
            margin-bottom: 1rem !important;
        }

        .fc-toolbar-title {
            color: #1F2937 !important;
            font-size: 1.25rem !important;
            font-weight: 600 !important;
        }

        .fc-button-primary {
            background-color: #3B82F6 !important;
            border: none !important;
            padding: 0.5rem 1rem !important;
            font-weight: 500 !important;
        }

        .fc-button-primary:hover {
            background-color: #2563EB !important;
        }

        .fc-button-active {
            background-color: #1D4ED8 !important;
        }

        .fc-event {
            border-radius: 6px !important;
            padding: 3px !important;
            margin: 2px !important;
            border: none !important;
            transition: transform 0.2s ease !important;
        }

        .fc-event:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }

        .fc-event .fc-content {
            padding: 2px 4px !important;
        }

        .fc-day-today {
            background-color: #EFF6FF !important;
        }
    </style>
</body>
</html>