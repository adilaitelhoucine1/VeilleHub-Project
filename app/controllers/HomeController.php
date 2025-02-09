<?php 

require_once(__DIR__ . '/../../core/Mailer.php');

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
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            
            if (!$email) {
                $_SESSION['error'] = "Format d'email invalide.";
                header('Location: /reset-password');
                exit();
            }

            if (!$this->UserModel->checkEmailExists($email)) {
                $_SESSION['error'] = "Aucun compte n'est associé à cet email.";
                header('Location: /reset-password');
                exit();
            }

            try {
                // Générer le token
                $token = bin2hex(random_bytes(32));
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
                
                // Sauvegarder le token dans la base de données
                $this->UserModel->saveResetToken($email, $token, $expiry);
                
                // Créer le lien de réinitialisation
                $resetLink = "http://" . $_SERVER['HTTP_HOST'] . "/reset-password?token=" . $token;
                
                // Utiliser la classe Mailer existante
                $mailer = new Mailer();
                $result = $mailer->sendPasswordResetEmail($email, $resetLink);
                
                if ($result === true) {
                    $_SESSION['success'] = "Un email de réinitialisation a été envoyé.";
                } else {
                    $_SESSION['error'] = "Erreur lors de l'envoi de l'email. Veuillez réessayer.";
                }
                
            } catch (Exception $e) {
                error_log("Erreur réinitialisation mot de passe : " . $e->getMessage());
                $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer.";
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
    public function notactive() {
      
        $this->render('account_inactive');
    }

    public function assignPresentation($studentInfo, $sujetInfo) {
        try {

                $presentationDetails = [
                    'titre' => $sujetInfo['titre'],
                    'description' => $sujetInfo['description']
                ];

                // Instancier le Mailer
                $mailer = new Mailer();

                // Envoyer l'email
                $emailSent = $mailer->sendPresentationAssignmentEmail(
                    $studentInfo['email'],
                    $studentInfo['nom'],
                    $presentationDetails
                );

                if (!$emailSent) {
                    error_log("Erreur lors de l'envoi de l'email de notification");
                }

                return [
                    'success' => true,
                    'message' => 'Présentation assignée avec succès'
                ];


            return [
                'success' => false,
                'message' => "Erreur lors de l'assignation de la présentation"
            ];

        } catch (Exception $e) {
            error_log("Erreur d'assignation: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Une erreur est survenue lors de l'assignation"
            ];
        }
    }
}