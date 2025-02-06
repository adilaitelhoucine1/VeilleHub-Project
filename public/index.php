<?php
session_start();



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

// admin routers

Route::get('/admin', [AdminController::class, 'index']);
// Route::get('/admin/users', [AdminController::class, 'handleUsers']);
// Route::get('/admin/categories', [AdminController::class, 'categories']);
// Route::get('/admin/testimonials', [AdminController::class, 'testimonials']);
// Route::get('/admin/projects', [AdminController::class, 'projects']);
Route::get('/Formateur/dashboard', [AdminController::class, 'Admindashboard']);
Route::get('/formateur/delete/{id}', [AdminController::class, 'DeleteUser']);
Route::get('/Formateur/toggle-status/{id}', [AdminController::class, 'ChangerStatus']);








// end admin routes 

// Student Routes 
Route::get('/Etudiant/dashboard', [StudentController::class, 'ShowDashboard']);
Route::post('/addSuggestion', [StudentController::class, 'AddSuggestion']);
Route::get('/Etudiant/suggestions', [StudentController::class, 'ShowSuggestions']);
Route::get('/Etudiant/deleteSuggestion/{sujet_id}', [StudentController::class, 'DeleteSuggestion']);



// Dispatch the request
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);



