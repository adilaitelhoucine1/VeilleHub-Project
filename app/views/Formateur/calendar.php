<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Présentations - YouCode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- FullCalendar Dependencies -->
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.10/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/locales/fr.global.min.js"></script>

    <style>
        /* Theme principal */
        :root {
            --primary: #2563EB;
            --primary-light: #60A5FA;
            --primary-dark: #1E40AF;
            --accent: #F59E0B;
            --success: #10B981;
            --danger: #EF4444;
        }

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

        /* Styles du calendrier */
        .fc {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .fc-header-toolbar {
            background: #f8fafc;
            padding: 1rem !important;
            margin: 0 !important;
        }

        .fc-toolbar-title {
            color: #1e293b !important;
            font-weight: 600 !important;
        }

        .fc-button-primary {
            background: var(--primary) !important;
            border: none !important;
            padding: 0.5rem 1rem !important;
            font-weight: 500 !important;
            transition: all 0.2s !important;
        }

        .fc-button-primary:hover {
            background: var(--primary-dark) !important;
            transform: translateY(-1px);
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
            background: #f1f5f9 !important;
        }

        .fc-event {
            background: var(--primary) !important;
            border: none !important;
            padding: 2px 4px !important;
            font-size: 0.875rem !important;
        }

        .fc-event:hover {
            background: var(--primary-dark) !important;
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

        /* Formulaire */
        .form-input {
            background: white !important;
            border: 1px solid #e2e8f0 !important;
            color: #1e293b !important;
        }

        .form-input:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1) !important;
        }

        /* Cards */
        .glass-card {
            background: white;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.45);
            transition: all 0.3s ease;
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
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Calendrier des Présentations</h1>
                <p class="text-gray-600">Planifiez et suivez les présentations de veille</p>
            </div>
         
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Calendar -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm">
                    <div id="calendar"></div>
                </div>
            </div>

            <!-- Scheduling Form -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
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
                        <div class="flex justify-between items-start">
                            <h4 class="font-semibold text-lg text-blue-800"><?php echo $presentation['titre']; ?></h4>
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                <?php echo match($presentation['status'] ?? 'pending') {
                                    'pending' => 'bg-yellow-100 text-yellow-600',
                                    'completed' => 'bg-green-100 text-green-600',
                                    'cancelled' => 'bg-red-100 text-red-600',
                                    default => 'bg-gray-100 text-gray-600'
                                } ?>">
                                <?php echo match($presentation['status'] ?? 'pending') {
                                    'pending' => 'En attente',
                                    'completed' => 'Terminée',
                                    'cancelled' => 'Annulée',
                                    default => 'En attente'
                                }; ?>
                            </span>
                        </div>

                        <p class="text-blue-600 mt-2">
                            <i class="fas fa-users mr-2"></i><?php echo $presentation['student_names']; ?>
                        </p>
                        <div class="flex items-center mt-3 text-blue-500">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span><?php echo date('d/m/Y', strtotime($presentation['presentation_date'])); ?></span>
                            <i class="fas fa-clock ml-4 mr-2"></i>
                            <span><?php echo date('H:i', strtotime($presentation['presentation_date'])); ?></span>
                        </div>

                        <!-- Boutons de statut -->
                        <div class="mt-4 flex gap-2">
                            <a href="/Formateur/update-status/<?php echo $presentation['id_presentation']; ?>/pending" 
                               class="px-3 py-1 rounded-lg text-xs font-medium transition-colors
                               <?php echo ($presentation['status'] ?? 'pending') === 'pending' 
                                   ? 'bg-yellow-200 text-yellow-700 cursor-default'
                                   : 'bg-yellow-100 text-yellow-600 hover:bg-yellow-200'; ?>">
                                <i class="fas fa-clock mr-1"></i>En attente
                            </a>
                            
                            <a href="/Formateur/update-status/<?php echo $presentation['id_presentation']; ?>/completed" 
                               class="px-3 py-1 rounded-lg text-xs font-medium transition-colors
                               <?php echo ($presentation['status'] ?? 'pending') === 'completed'
                                   ? 'bg-green-200 text-green-700 cursor-default'
                                   : 'bg-green-100 text-green-600 hover:bg-green-200'; ?>">
                                <i class="fas fa-check mr-1"></i>Terminée
                            </a>
                            
                            <a href="/Formateur/update-status/<?php echo $presentation['id_presentation']; ?>/cancelled" 
                               class="px-3 py-1 rounded-lg text-xs font-medium transition-colors
                               <?php echo ($presentation['status'] ?? 'pending') === 'cancelled'
                                   ? 'bg-red-200 text-red-700 cursor-default'
                                   : 'bg-red-100 text-red-600 hover:bg-red-200'; ?>">
                                <i class="fas fa-times mr-1"></i>Annulée
                            </a>
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