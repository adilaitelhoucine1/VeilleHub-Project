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

public function GetValidatedSubjects() {
   
        $sql = "SELECT s.id_sujet, s.titre, s.description, s.date_creation, s.status,
                       u.nom as proposer_name, u.id_user as proposer_id
                FROM sujet s
                JOIN user u ON s.id_student = u.id_user
                WHERE s.status = 'Validé'
                ORDER BY s.date_creation DESC";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($subjects as &$subject) {
            $sql = "SELECT u.id_user, u.nom, u.email, u.status
                    FROM user u
                    JOIN subject_assignments sa ON u.id_user = sa.student_id
                    WHERE sa.sujet_id = ?";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$subject['id_sujet']]);
            $subject['assigned_students'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $subjects;
 
}
public function assignStudentsToSubject($sujet_id, $student_ids) {

   

        $this->conn->beginTransaction();

        $sqlDelete = "DELETE FROM subject_assignments WHERE sujet_id = ?";
        $stmtDelete = $this->conn->prepare($sqlDelete);
        $stmtDelete->execute([$sujet_id]);

        $sqlInsert = "INSERT INTO subject_assignments (sujet_id, student_id, assigned_date) VALUES (?, ?, NOW())";
        $stmtInsert = $this->conn->prepare($sqlInsert);

        foreach ($student_ids as $student_id) {
            $stmtInsert->execute([$sujet_id, $student_id]);
        }

        $this->conn->commit();
        return true;


}

// public function GetValidatedSubjects() {
//     try {
//         $sql = "SELECT s.id_sujet, s.titre, s.description, s.date_creation,
//                        u.nom as proposer_name
//                 FROM sujet s
//                 JOIN user u ON s.id_student = u.id_user
//                 WHERE s.status = 'Validé'
//                 ORDER BY s.date_creation DESC";
                
//         $stmt = $this->conn->prepare($sql);
//         $stmt->execute();
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
//     } catch(PDOException $e) {
//         error_log("Erreur lors de la récupération des sujets validés : " . $e->getMessage());
//         return [];
//     }
// }

public function GetScheduledPresentations() {
    try {
        $sql = "SELECT 
                p.id_presentation,
                p.presentation_date,
                p.status,
                s.titre,
                GROUP_CONCAT(u.nom SEPARATOR ', ') as student_names
                FROM presentations p
                JOIN sujet s ON p.sujet_id = s.id_sujet
                JOIN subject_assignments sa ON s.id_sujet = sa.sujet_id
                JOIN user u ON sa.student_id = u.id_user
                GROUP BY p.id_presentation, p.presentation_date, p.status, s.titre
                ORDER BY p.presentation_date ASC";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération des présentations : " . $e->getMessage());
        return [];
    }
}

public function GetAssignedSubjectsWithoutDate() {
    try {
        $sql = "SELECT s.id_sujet, s.titre,
                GROUP_CONCAT(u.nom SEPARATOR ', ') as student_names
                FROM sujet s
                JOIN subject_assignments sa ON s.id_sujet = sa.sujet_id
                JOIN user u ON sa.student_id = u.id_user
                LEFT JOIN presentations p ON s.id_sujet = p.sujet_id
                WHERE p.id_presentation IS NULL
                AND s.status = 'Validé'
                GROUP BY s.id_sujet";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Erreur lors de la récupération des sujets : " . $e->getMessage());
        return [];
    }
}

public function SchedulePresentation($sujet_id, $presentation_datetime) {
    try {
        $sql = "INSERT INTO presentations (sujet_id, presentation_date) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$sujet_id, $presentation_datetime]);
    } catch(PDOException $e) {
        error_log("Erreur lors de la programmation de la présentation : " . $e->getMessage());
        return false;
    }
}

public function UpdatePresentationStatus($presentation_id, $status) {

        $sql = "UPDATE presentations SET status = ? WHERE id_presentation = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $presentation_id]);
  
}
}

