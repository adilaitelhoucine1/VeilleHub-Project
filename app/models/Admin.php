<?php 
require_once(__DIR__.'/../config/db.php');
class Admin extends Db {

public function __construct()
{
    parent::__construct();
}

public function GetAllStudents() {
    $sql = "SELECT * FROM user where role = 'Apprenant'";
    $stmt =  $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
public function DeleteUser($user_id){
    try {
        $sqldelete = "DELETE FROM user WHERE id_user = ?";
        $stmtdelete = $this->conn->prepare($sqldelete);
        $result = $stmtdelete->execute([$user_id]);
        return $result;
    } catch(PDOException $e) {
        error_log("Erreur de suppression : " . $e->getMessage());
        return false;
    }
}
public function ChangerStatus($user_id) {
    try {
        $sqlSelect = "SELECT status FROM user WHERE id_user = ?";
        $stmtSelect = $this->conn->prepare($sqlSelect);
        $stmtSelect->execute([$user_id]);
        $currentStatus = $stmtSelect->fetchColumn();

        $sqlUpdate = "UPDATE user SET status = ? WHERE id_user = ?";
        $stmtUpdate = $this->conn->prepare($sqlUpdate);

        if ($currentStatus === 'inactif') {
            $result = $stmtUpdate->execute(['Actif', $user_id]);
        } 
        else {
            $result = $stmtUpdate->execute(['inactif', $user_id]);
        }

        return $result;

    } catch(PDOException $e) {
        error_log("Erreur de changement de statut : " . $e->getMessage());
        return false;
    }
}

public function GetAllSuggestion() {
   
        $sql = "SELECT s.id_sujet, s.titre, s.description, s.date_creation, s.status,
                        u.nom
                FROM sujet s
                JOIN user u ON s.id_student = u.id_user
                where s.status = 'Proposé'
                ORDER BY s.date_creation DESC";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
   
}

public function ApproveSuggestion($sujet_id) {
    try {
        $sql = "UPDATE sujet SET status = 'Validé' WHERE id_sujet = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$sujet_id]);
    } catch(PDOException $e) {
        error_log("Erreur lors de l'approbation de la suggestion : " . $e->getMessage());
        return false;
    }
}

public function RejectSuggestion($sujet_id) {
    try {
        $sql = "UPDATE sujet SET status = 'Rejeté' WHERE id_sujet = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$sujet_id]);
    } catch(PDOException $e) {
        error_log("Erreur lors du rejet de la suggestion : " . $e->getMessage());
        return false;
    }
}

public function GetSuggestionStats() {
    try {
        $sql = "SELECT 
                SUM(CASE WHEN status = 'En attente' THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 'Approuvé' THEN 1 ELSE 0 END) as approved,
                SUM(CASE WHEN status = 'Rejeté' THEN 1 ELSE 0 END) as rejected
                FROM sujet";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération des statistiques : " . $e->getMessage());
        return ['pending' => 0, 'approved' => 0, 'rejected' => 0];
    }
}
}

