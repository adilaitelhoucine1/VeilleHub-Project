<?php 
require_once(__DIR__.'/../config/db.php');
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

public function sendResetPasswordLink($email) {
    try {
        $sql = "SELECT id_user FROM user WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            $sql = "UPDATE user SET reset_token = ?, reset_expiry = ? WHERE email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$token, $expiry, $email]);
            
            // Envoyer l'email (à implémenter selon votre système d'envoi d'emails)
            return true;
        }
        return false;
    } catch (PDOException $e) {
        error_log($e->getMessage());
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

}