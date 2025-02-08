<?php 

class HomeController extends BaseController {
    private $UserModel;

    public function __construct() {
        $this->UserModel = new User();
    }

    public function index() {
        // Récupérer les présentations à venir (publiques)
        $presentations = $this->UserModel->getUpcomingPresentations();
        $this->render('home', ['presentations' => $presentations]);
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $result = $this->UserModel->sendResetPasswordLink($email);
            
            if ($result) {
                $_SESSION['success'] = "Un email de réinitialisation a été envoyé.";
            } else {
                $_SESSION['error'] = "Email non trouvé.";
            }
            header('Location: /reset-password');
            exit();
        }
        $this->render('auth/reset-password');
    }

    public function showCalendar() {
        $presentations = $this->UserModel->getAllPresentations();
        $this->render('calendar', ['presentations' => $presentations]);
    }
}