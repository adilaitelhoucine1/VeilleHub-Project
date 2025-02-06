<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Présentations - Veilles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- FullCalendar Dependencies -->
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.10/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/locales/fr.global.min.js"></script>

    <style>
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* Glassmorphism et effets */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            animation: fadeIn 0.5s ease-out;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.45);
            transition: all 0.3s ease;
        }

        /* Styles du calendrier */
        .fc {
            background: rgba(17, 24, 39, 0.7);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .fc-header-toolbar {
            background: rgba(29, 78, 216, 0.15);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px !important;
        }

        .fc-toolbar-title {
            color: #60A5FA !important;
            font-size: 1.5em !important;
            font-weight: bold !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .fc-button-primary {
            background: linear-gradient(145deg, #3B82F6, #2563EB) !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3) !important;
            transition: all 0.3s ease !important;
        }

        .fc-button-primary:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4) !important;
        }

        .fc-button-active {
            background: linear-gradient(145deg, #1D4ED8, #1E40AF) !important;
        }

        .fc-daygrid-day {
            transition: all 0.3s ease !important;
        }

        .fc-daygrid-day:hover {
            background: rgba(59, 130, 246, 0.1) !important;
        }

        .fc-daygrid-day-number {
            color: #E5E7EB !important;
            font-weight: 500 !important;
            padding: 8px !important;
        }

        .fc-day-today {
            background: rgba(59, 130, 246, 0.15) !important;
        }

        .fc-event {
            background: linear-gradient(145deg, #3B82F6, #2563EB) !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3) !important;
            padding: 4px 8px !important;
            margin: 2px !important;
            border-radius: 6px !important;
            transition: all 0.3s ease !important;
        }

        .fc-event:hover {
            transform: translateY(-2px) scale(1.02) !important;
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4) !important;
        }

        .fc-event-title {
            font-weight: 600 !important;
            color: white !important;
        }

        .fc-col-header-cell {
            background: rgba(59, 130, 246, 0.15);
            padding: 12px !important;
        }

        .fc-col-header-cell-cushion {
            color: #60A5FA !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            font-size: 0.9em !important;
        }

        /* Formulaire et boutons */
        .form-input {
            background: rgba(17, 24, 39, 0.7) !important;
            border: 1px solid rgba(59, 130, 246, 0.3) !important;
            transition: all 0.3s ease !important;
        }

        .form-input:focus {
            border-color: #3B82F6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2) !important;
        }

        .submit-button {
            background: linear-gradient(145deg, #3B82F6, #2563EB) !important;
            transition: all 0.3s ease !important;
        }

        .submit-button:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4) !important;
        }

        /* Cartes des présentations */
        .presentation-card {
            animation: slideIn 0.5s ease-out;
            transition: all 0.3s ease;
        }

        .presentation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.45);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 min-h-screen text-white">
    <!-- Sidebar -->
    <nav class="fixed top-0 left-0 h-full w-64 bg-gray-900 text-white p-4 space-y-4 overflow-y-auto">
        <div class="flex items-center justify-center p-4">
            <img src="https://www.youcode.ma/images/logo-youcode.png" alt="YouCode" class="w-32">
        </div>
        
        <div class="space-y-2">
            <div class="px-4 py-2">
                <h2 class="text-xs uppercase font-semibold text-gray-400">Menu Principal</h2>
            </div>
            
            <div class="px-4 py-4 space-y-2">
                <a href="/Formateur/dashboard" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-600 transition-all duration-300">
                    <i class="fas fa-home mr-3"></i>Dashboard
                </a>
                <a href="/Formateur/calendar" class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white">
                    <i class="fas fa-calendar-alt mr-3"></i>Planning
                </a>
                <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-600 transition-all duration-300">
                    <i class="fas fa-users mr-3"></i>Apprenants
                </a>
                <a href="/Formateur/valider_Suggestion" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-600 transition-all duration-300">
                    <i class="fas fa-lightbulb mr-3"></i>Propositions
                </a>
                <a href="/Formateur/Showsubjects" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-600 transition-all duration-300">
                    <i class="fas fa-tasks mr-3"></i>Attribution Sujets
                </a>
                <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-600 transition-all duration-300">
                    <i class="fas fa-chart-bar mr-3"></i>Statistiques
                </a>
                <a href="/logout" class="flex items-center px-4 py-3 text-red-500 hover:bg-red-500/10 rounded-lg transition-all duration-300">
                    <i class="fas fa-sign-out-alt mr-3"></i>Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="ml-64 p-8 space-y-6">
        <!-- Header Section -->
        <div class="glass-card p-6 rounded-xl flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-200">
                    Calendrier des Présentations
                </h1>
                <p class="text-blue-300 mt-2">Planifiez et suivez les présentations de veille</p>
            </div>
            <div class="flex space-x-4">
                <button class="submit-button px-6 py-3 rounded-xl text-white font-semibold">
                    <i class="fas fa-plus-circle mr-2"></i>Nouvelle Présentation
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Calendar -->
            <div class="lg:col-span-2">
                <div class="glass-card p-6 rounded-xl">
                    <div id="calendar"></div>
                </div>
            </div>

            <!-- Scheduling Form -->
            <div class="glass-card p-6 rounded-xl">
                <h3 class="text-xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-200">
                    Programmer une Présentation
                </h3>
                <form action="/Formateur/schedule-presentation" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-blue-300 mb-2">Sujet</label>
                        <select name="sujet_id" required class="form-input w-full rounded-xl px-4 py-3 text-white">
                            <option value="">Sélectionner un sujet</option>
                            <?php foreach ($assignedSubjects as $subject): ?>
                                <option value="<?php echo $subject['id_sujet']; ?>">
                                    <?php echo $subject['titre'] . ' - ' . $subject['student_names']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-blue-300 mb-2">Date</label>
                        <input type="date" name="presentation_date" required 
                               class="form-input w-full rounded-xl px-4 py-3 text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-blue-300 mb-2">Heure</label>
                        <input type="time" name="presentation_time" required 
                               class="form-input w-full rounded-xl px-4 py-3 text-white">
                    </div>

                    <button type="submit" 
                            class="submit-button w-full py-3 rounded-xl text-white font-semibold">
                        <i class="fas fa-calendar-plus mr-2"></i>Programmer
                    </button>
                </form>
            </div>
        </div>

        <!-- Upcoming Presentations -->
        <div class="glass-card p-6 rounded-xl">
            <h3 class="text-xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-200">
                <i class="fas fa-clock mr-2"></i>Présentations à venir
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($presentations as $presentation): ?>
                    <div class="presentation-card glass-card p-4 rounded-xl hover-card">
                        <h4 class="font-semibold text-lg text-blue-200"><?php echo $presentation['titre']; ?></h4>
                        <p class="text-blue-300 mt-2">
                            <i class="fas fa-users mr-2"></i><?php echo $presentation['student_names']; ?>
                        </p>
                        <div class="flex items-center mt-3 text-blue-200">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span><?php echo date('d/m/Y', strtotime($presentation['presentation_date'])); ?></span>
                            <i class="fas fa-clock ml-4 mr-2"></i>
                            <span><?php echo date('H:i', strtotime($presentation['presentation_date'])); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek'
                },
                events: <?php echo json_encode(array_map(function($presentation) {
                    return [
                        'title' => $presentation['titre'],
                        'start' => $presentation['presentation_date'],
                        'description' => $presentation['student_names'],
                        'backgroundColor' => '#3B82F6',
                        'borderColor' => '#3B82F6',
                        'textColor' => 'white'
                    ];
                }, $presentations)); ?>,
                eventDidMount: function(info) {
                    info.el.title = info.event.title + '\n' + info.event.extendedProps.description;
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
        });
    </script>
</body>
</html> 