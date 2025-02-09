<?php 
require_once(__DIR__.'/../config/db.php');
require_once(__DIR__.'/../../vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once(__DIR__.'/../../vendor/phpmailer/phpmailer/src/SMTP.php');
require_once(__DIR__.'/../../vendor/phpmailer/phpmailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class User extends Db {

public function __construct()
{
    parent::__construct();
}

public function register($user) {
   
    try {
        // Prepare and execute the insertion query
        $result = $this->conn->prepare("INSERT INTO user (nom, password, email, role) VALUES (?, ?, ?, ?)");
        $result->execute($user);
        return $this->conn->lastInsertId();
        
       
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

public function login($userData){
    
    try {
        $result = $this->conn->prepare("SELECT * FROM user WHERE email=?");
        $result->execute([$userData[0]]);
        $user = $result->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($userData[1], $user["password"])){
           

           return  $user ;
        
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

public function getUpcomingPresentations() {
    try {
        $sql = "SELECT p.presentation_date, s.titre, 
                GROUP_CONCAT(u.nom SEPARATOR ', ') as student_names
                FROM presentations p
                JOIN sujet s ON p.sujet_id = s.id_sujet
                JOIN subject_assignments sa ON s.id_sujet = sa.sujet_id
                JOIN user u ON sa.student_id = u.id_user
                WHERE p.presentation_date >= CURRENT_DATE
                GROUP BY p.id_presentation
                ORDER BY p.presentation_date ASC
                LIMIT 6";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return [];
    }
}

private const SMTP_HOST = 'smtp.gmail.com';
private const SMTP_USERNAME = 'adil.ait.2003@gmail.com';
private const SMTP_PASSWORD = 'xfww qwxp yvxm aqxm';
private const SMTP_PORT = 587;
private const SMTP_FROM_NAME = 'YouCode Innovation Hub';

private function sendEmail($to, $subject, $body) {
    try {
        error_log("=== DÉBUT ENVOI EMAIL ===");
        
        $mail = new PHPMailer(true);
        
        // Configuration de base
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        
        // Vos identifiants Gmail
        $mail->Username = 'adil.ait.2003@gmail.com';
        $mail->Password = 'rnvw aqxm xfww qwxp'; // Votre mot de passe d'application Gmail
        
        // Configuration TLS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Activer le debug
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = function($str, $level) {
            error_log("SMTP DEBUG: " . $str);
        };
        
        // Configuration de l'email
        $mail->setFrom($mail->Username, 'YouCode Innovation Hub');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        
        // Contenu
        $mail->Subject = $subject;
        $mail->Body = $body;
        
        // Tentative d'envoi
        if(!$mail->send()) {
            error_log("Erreur SMTP : " . $mail->ErrorInfo);
            return false;
        }
        
        error_log("Email envoyé avec succès");
        return true;
        
    } catch (Exception $e) {
        error_log("Exception SMTP : " . $e->getMessage());
        return false;
    }
}

public function sendResetPasswordLink($email) {
    try {
        error_log("=== DÉBUT SEND RESET PASSWORD LINK ===");
        
        // Vérifier la structure de la table
        $checkTable = $this->conn->query("SHOW COLUMNS FROM user LIKE 'reset_token'");
        if ($checkTable->rowCount() === 0) {
            error_log("Colonnes manquantes dans la table user. Tentative d'ajout...");
            $this->conn->exec("
                ALTER TABLE user 
                ADD COLUMN IF NOT EXISTS reset_token VARCHAR(64) DEFAULT NULL,
                ADD COLUMN IF NOT EXISTS reset_expiry DATETIME DEFAULT NULL
            ");
        }
        
        $sql = "SELECT id_user FROM user WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            error_log("Utilisateur trouvé pour l'email : " . $email);
            
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            // Mise à jour du token
            $sql = "UPDATE user SET reset_token = ?, reset_expiry = ? WHERE email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$token, $expiry, $email]);
            error_log("Token mis à jour dans la base de données");
            
            $resetLink = "http://" . $_SERVER['HTTP_HOST'] . "/reset-password?token=" . $token;
            
            $subject = "Réinitialisation de votre mot de passe - YouCode Innovation Hub";
            $body = "
                <h2>Réinitialisation de votre mot de passe</h2>
                <p>Vous avez demandé la réinitialisation de votre mot de passe.</p>
                <p>Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>
                <p><a href='{$resetLink}'>Réinitialiser mon mot de passe</a></p>
                <p>Ce lien expirera dans 1 heure.</p>
            ";
            
            error_log("Tentative d'envoi de l'email...");
            $result = $this->sendEmail($email, $subject, $body);
            error_log("Résultat de l'envoi : " . ($result ? "Succès" : "Échec"));
            
            error_log("=== FIN SEND RESET PASSWORD LINK ===");
            return $result;
        }
        
        error_log("Aucun utilisateur trouvé pour l'email : " . $email);
        return false;
        
    } catch (Exception $e) {
        error_log("ERREUR dans sendResetPasswordLink : " . $e->getMessage());
        error_log($e->getTraceAsString());
        return false;
    }
}

public function getAllPresentations() {
    try {
        $sql = "SELECT p.presentation_date, s.titre, 
                GROUP_CONCAT(u.nom SEPARATOR ', ') as student_names,
                p.status
                FROM presentations p
                JOIN sujet s ON p.sujet_id = s.id_sujet
                JOIN subject_assignments sa ON s.id_sujet = sa.sujet_id
                JOIN user u ON sa.student_id = u.id_user
                GROUP BY p.id_presentation
                ORDER BY p.presentation_date ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return [];
    }
}

// Méthode de test
public function testEmail() {
    try {
        error_log("=== DÉBUT TEST EMAIL ===");
        return $this->sendEmail(
            'adil.ait.2003@gmail.com',
            'Test Email YouCode',
            '<h1>Test de configuration SMTP</h1><p>Ceci est un test envoyé le ' . date('Y-m-d H:i:s') . '</p>'
        );
    } catch (Exception $e) {
        error_log("Erreur test email : " . $e->getMessage());
        return false;
    }
}

public function checkEmailExists($email) {
    try {
        $sql = "SELECT COUNT(*) FROM user WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Erreur lors de la vérification de l'email : " . $e->getMessage());
        return false;
    }
}

public function saveResetToken($email, $token, $expiry) {
    try {
        $sql = "UPDATE user SET reset_token = ?, reset_expiry = ? WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$token, $expiry, $email]);
    } catch (PDOException $e) {
        error_log("Erreur lors de la sauvegarde du token : " . $e->getMessage());
        return false;
    }
}

}