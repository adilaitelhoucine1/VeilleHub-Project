<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once ('../core/BaseController.php');
require_once '../core/Router.php';
require_once '../core/Route.php';
require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/controllers/StudentController.php';
require_once '../app/config/db.php';




$router = new Router();
Route::setRouter($router);



// Define routes
// auth routes 
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'handleRegister']);
Route::get('/login', [AuthController::class, 'showleLogin']);
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/reset-password', [HomeController::class, 'resetPassword']);
Route::post('/reset-password', [HomeController::class, 'resetPassword']);
Route::get('/account_inactive', [HomeController::class, 'notactive']);

// admin routers

Route::get('/admin', [AdminController::class, 'index']);
// Route::get('/admin/users', [AdminController::class, 'handleUsers']);
// Route::get('/admin/categories', [AdminController::class, 'categories']);
// Route::get('/admin/testimonials', [AdminController::class, 'testimonials']);
// Route::get('/admin/projects', [AdminController::class, 'projects']);
Route::get('/Formateur/dashboard', [AdminController::class, 'Admindashboard']);
Route::get('/formateur/delete/{id}', [AdminController::class, 'DeleteUser']);
Route::get('/Formateur/toggle-status/{id}', [AdminController::class, 'ChangerStatus']);
Route::get('/Formateur/valider_Suggestion', [AdminController::class, 'ShowSuggestion']);
Route::get('/Formateur/approve-suggestion/{id}', [AdminController::class, 'ApproveSuggestion']);
Route::get('/Formateur/reject-suggestion/{id}', [AdminController::class, 'RejectSuggestion']);
Route::post('/Formateur/assign-students', [AdminController::class, 'assign_students']);

Route::get('/Formateur/Showsubjects', [AdminController::class, 'ShowSubjects']);

Route::get('/Formateur/calendar', [AdminController::class, 'ShowCalendar']);
Route::post('/Formateur/schedule-presentation', [AdminController::class, 'SchedulePresentation']);

Route::get('/Formateur/update-status/{id}/{status}', [AdminController::class, 'UpdatePresentationStatus']);

Route::get('/calendar', [HomeController::class, 'showCalendar']);




// end admin routes 

// Student Routes 
Route::get('/Etudiant/dashboard', [StudentController::class, 'ShowDashboard']);
Route::post('/addSuggestion', [StudentController::class, 'AddSuggestion']);
Route::get('/Etudiant/suggestions', [StudentController::class, 'ShowSuggestions']);
Route::get('/Etudiant/deleteSuggestion/{sujet_id}', [StudentController::class, 'DeleteSuggestion']);
Route::post('/Etudiant/updateSuggestion', [StudentController::class, 'UpdateSuggestion']);
Route::get('/Etudiant/presentations', [StudentController::class, 'ShowPresentations']);
Route::get('/Etudiant/calendar-events', [StudentController::class, 'GetCalendarEvents']);

Route::get('/Etudiant/calendar', [StudentController::class, 'ShowCalendar']);
Route::get('/Etudiant/ranking', [StudentController::class, 'GetRanking']);



// Test SMTP (à retirer après les tests)
Route::get('/test-email', function() {
    $user = new User();
    if ($user->testEmail()) {
        echo "Email de test envoyé avec succès. Vérifiez les logs pour plus de détails.";
    } else {
        echo "Échec de l'envoi de l'email. Vérifiez les logs pour plus de détails.";
    }
    exit;
});

// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



