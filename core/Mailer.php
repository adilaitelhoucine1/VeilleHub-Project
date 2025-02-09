<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        try {
            // Paramètres SMTP
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.gmail.com'; // Remplace par ton SMTP
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = 'YoucodeVielle.nador@youcode.ma'; // Remplace par ton email
            $this->mail->Password   = 'htiu ewtj gxag cuxc'; // Remplace par ton mot de passe (ou utilise un App Password)
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port       = 587;
            $this->mail->setFrom('salahdaha7@gmail.com', 'VeilleHub');
        } catch (Exception $e) {
            echo "Erreur : {$this->mail->ErrorInfo}";
        }
    }

    public function sendValidationEmail($toEmail, $userName, $validationLink) {
        try {
            $this->mail->addAddress($toEmail, $userName);
            $this->mail->Subject = 'Validation de votre compte';
            
            $message = "
                <h1>Bienvenue, $userName !</h1>
                <p>Merci de vous être inscrit. Cliquez sur le lien ci-dessous pour valider votre compte :</p>
                <a href='$validationLink'>Confirmer mon email</a>
            ";
            $this->mail->isHTML(true);
            $this->mail->Body = $message;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return "Erreur lors de l'envoi : {$this->mail->ErrorInfo}";
        }       
    }

    public function sendPresentationAssignmentEmail($toEmail, $userName, $presentationDetails) {
        try {
            $this->mail->clearAddresses(); // Nettoie les adresses précédentes
            $this->mail->addAddress($toEmail, $userName);
            $this->mail->Subject = 'Nouvelle Présentation Assignée';
            
            // $date = date('d/m/Y H:i', strtotime($presentationDetails['presentation_date']));
            
            $message = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                    <h1 style='color: #2563eb; margin-bottom: 20px;'>Nouvelle Présentation Assignée</h1>
                    
                    <p>Bonjour $userName,</p>
                    
                    <p>Une nouvelle présentation vous a été assignée :</p>
                    
                    <div style='background-color: #f3f4f6; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                        <h2 style='color: #1f2937; margin-top: 0;'>{$presentationDetails['titre']}</h2>
                        <p style='color: #4b5563;'><strong>Date de présentation :</strong> 2025/02/20 </p>
                        <p style='color: #4b5563;'><strong>Description :</strong> {$presentationDetails['description']}</p>
                    </div>
                    
                    <p>Vous pouvez consulter les détails de votre présentation dans votre espace personnel.</p>
                    
                    <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;'>
                        <p style='color: #6b7280; font-size: 14px;'>
                            Cet email a été envoyé automatiquement, merci de ne pas y répondre.
                        </p>
                    </div>
                </div>
            ";
            
            $this->mail->isHTML(true);
            $this->mail->Body = $message;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Erreur d'envoi d'email: " . $e->getMessage());
            return false;
        }
    }

    public function sendPasswordResetEmail($toEmail, $resetLink) {
        try {
            $this->mail->clearAddresses(); // Nettoie les adresses précédentes
            $this->mail->addAddress($toEmail);
            $this->mail->Subject = 'Réinitialisation de votre mot de passe - YouCode Innovation Hub';
            
            $message = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                    <h1 style='color: #2563eb; margin-bottom: 20px;'>Réinitialisation de mot de passe</h1>
                    
                    <p>Vous avez demandé la réinitialisation de votre mot de passe.</p>
                    
                    <div style='background-color: #f3f4f6; padding: 20px; border-radius: 8px; margin: 20px 0;'>
                        <p>Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe :</p>
                        
                        <a href='$resetLink' 
                           style='display: inline-block; background-color: #2563eb; color: white; 
                                  padding: 12px 24px; text-decoration: none; border-radius: 6px; 
                                  margin: 20px 0;'>
                            Réinitialiser mon mot de passe
                        </a>
                        
                        <p style='margin-top: 20px;'>Ce lien expirera dans 1 heure.</p>
                    </div>
                    
                    <p>Si vous n'avez pas demandé cette réinitialisation, vous pouvez ignorer cet email.</p>
                    
                    <div style='margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;'>
                        <p style='color: #6b7280; font-size: 14px;'>
                            Cet email a été envoyé automatiquement, merci de ne pas y répondre.
                        </p>
                    </div>
                </div>
            ";
            
            $this->mail->isHTML(true);
            $this->mail->Body = $message;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Erreur d'envoi d'email de réinitialisation: " . $e->getMessage());
            return false;
        }
    }
}
?>