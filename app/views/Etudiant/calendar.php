<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Présentations - Veilles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.10/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/locales/fr.global.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>
<body class="bg-gray-100">
    <?php include __DIR__ . '/../components/sidebar.php'; ?>

    <div class="ml-64 p-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Calendrier des Présentations</h1>
            <p class="text-gray-600">Visualisez toutes vos présentations programmées</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Calendrier -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div id="calendar"></div>
                </div>
            </div>

            <!-- Liste des présentations -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-4">Prochaines présentations</h2>
                <div class="space-y-4">
                    <?php foreach ($presentations as $presentation): ?>
                        <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <h3 class="font-semibold text-gray-800"><?php echo htmlspecialchars($presentation['titre']); ?></h3>
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <?php echo date('d/m/Y', strtotime($presentation['presentation_date'])); ?>
                            </p>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-clock mr-2"></i>
                                <?php echo date('H:i', strtotime($presentation['presentation_date'])); ?>
                            </p>
                            <p class="text-sm text-gray-600 mt-2">
                                <i class="fas fa-users mr-2"></i>
                                <?php echo htmlspecialchars($presentation['student_names']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
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
                    right: 'dayGridMonth,dayGridWeek,timeGridDay'
                },
                events: '/Etudiant/calendar-events',
                eventDidMount: function(info) {
                    tippy(info.el, {
                        content: `
                            <div class="p-3 bg-white rounded shadow-lg">
                                <div class="font-bold text-gray-800 mb-1">${info.event.title}</div>
                                <div class="text-sm text-gray-600">
                                    <i class="fas fa-users mr-1"></i> 
                                    ${info.event.extendedProps.presentateurs}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-clock mr-1"></i>
                                    ${moment(info.event.start).format('HH:mm')}
                                </div>
                            </div>
                        `,
                        allowHTML: true,
                        theme: 'light',
                        placement: 'top',
                        arrow: true,
                        interactive: true
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
                locale: 'fr',
                firstDay: 1,
                buttonText: {
                    today: "Aujourd'hui",
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour'
                },
                slotMinTime: '08:00:00',
                slotMaxTime: '20:00:00',
                allDaySlot: false,
                displayEventTime: true,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                }
            });
            calendar.render();
        });
    </script>

    <style>
        .fc {
            background: white;
            border-radius: 0.75rem;
        }
        
        .fc-header-toolbar {
            padding: 1.25rem 1.5rem;
            margin-bottom: 0 !important;
        }
        
        .fc-view {
            padding: 0 1.25rem 1.25rem;
        }
        
        .fc-day-today {
            background-color: #EFF6FF !important;
        }
        
        .fc-event {
            border-radius: 6px !important;
            padding: 3px !important;
            margin: 2px !important;
            border: none !important;
            transition: all 0.2s ease !important;
            cursor: pointer !important;
        }
        
        .fc-event:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        }
        
        .fc-button-primary {
            background-color: #3B82F6 !important;
            border: none !important;
            padding: 0.5rem 1rem !important;
        }
        
        .fc-button-primary:hover {
            background-color: #2563EB !important;
        }
        
        .fc-button-primary:disabled {
            background-color: #93C5FD !important;
        }
        
        .tippy-box {
            background-color: white !important;
            color: black !important;
            border: 1px solid #E5E7EB !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        }
        
        .tippy-arrow {
            color: white !important;
        }
    </style>
</body>
</html> 