<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Présentations - YouCode Innovation Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        /* Custom Calendar Styles */
        .fc-theme-standard td, .fc-theme-standard th {
            border-color: #e5e7eb80;
        }
        
        .fc .fc-daygrid-day.fc-day-today {
            background: rgba(59, 130, 246, 0.1) !important;
        }
        
        .fc-button-primary {
            background-color: #3B82F6 !important;
            border-color: #3B82F6 !important;
            transition: all 0.3s ease;
        }
        
        .fc-button-primary:hover {
            background-color: #2563EB !important;
            border-color: #2563EB !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        }

        .fc-event {
            border-radius: 6px !important;
            padding: 2px 6px !important;
            transition: transform 0.2s ease;
        }

        .fc-event:hover {
            transform: translateY(-1px);
        }

        .fc-toolbar-title {
            color: #1F2937 !important;
            font-family: 'Poppins', sans-serif !important;
            font-weight: 600 !important;
        }
    </style>
</head>
<body class="font-[Poppins] bg-gradient-to-br from-blue-50 via-white to-blue-50 min-h-screen">
    <!-- Navigation -->
    <nav class="relative z-10 px-6 py-4">
        <div class="container mx-auto">
            <div class="glass-effect rounded-2xl px-6 py-3 flex justify-between items-center shadow-lg">
                <div class="flex items-center space-x-3">
                    <a href="/" class="flex items-center space-x-3 group">
                        <img src="https://intranet.youcode.ma/src/img/logo-white.png" 
                             alt="YouCode" 
                             class="h-8 w-auto transition-transform group-hover:scale-105"
                             style="filter: brightness(0);">
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 text-transparent bg-clip-text">
                            Veille
                        </span>
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="/" class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 transition-all">
                        <i class="fas fa-home"></i>
                        <span>Accueil</span>
                    </a>
                    <a href="/register" class="px-6 py-2 rounded-full bg-gradient-to-r from-blue-600 to-blue-400 
                                            text-white hover:from-blue-700 hover:to-blue-500 transition-all 
                                            shadow-lg hover:shadow-blue-500/25">
                        Inscription
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Calendar Header -->
    <div class="container mx-auto px-6 py-12">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-400">
                    Calendrier des Présentations
                </span>
            </h1>
            <p class="text-gray-600 text-lg">
                Explorez les présentations passées et à venir des projets innovants de nos étudiants
            </p>
        </div>
    </div>

    <!-- Calendar Section -->
    <div class="container mx-auto px-6 pb-16">
        <div class="glass-effect rounded-2xl shadow-xl p-8">
            <div id="calendar"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                locale: 'fr',
                events: [
                    <?php foreach($presentations as $presentation): ?>
                    {
                        title: '<?php echo addslashes($presentation['titre']); ?>',
                        start: '<?php echo $presentation['presentation_date']; ?>',
                        description: 'Par: <?php echo addslashes($presentation['student_names']); ?>',
                        backgroundColor: '#3B82F6',
                        borderColor: '#3B82F6',
                        textColor: '#ffffff',
                        className: 'hover:shadow-lg transition-shadow'
                    },
                    <?php endforeach; ?>
                ],
                eventDidMount: function(info) {
                    // Ajouter Tippy.js ou un autre système de tooltip ici
                    info.el.title = info.event.extendedProps.description;
                },
                buttonText: {
                    today: "Aujourd'hui",
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour'
                },
                dayMaxEvents: true,
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

    <!-- Footer -->
    <footer class="bg-white border-t mt-auto">
        <div class="container mx-auto px-6 py-4">
            <div class="text-center text-gray-600">
                <p class="text-sm">
                    &copy; <?php echo date('Y'); ?> YouCode Innovation Hub. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>
</body>
</html> 