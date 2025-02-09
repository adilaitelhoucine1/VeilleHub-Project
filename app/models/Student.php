<?php
require_once(__DIR__.'/../config/db.php');
class Student extends Db {

public function __construct()
{
    parent::__construct();
}
public function AddSuggestion($titre,$description,$user_id){

    $query = "INSERT INTO sujet (description,titre,id_student ) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([$description,$titre,$user_id]);
 }
public function GetMySuggestions($user_id){

    $sql = "SELECT * FROM sujet WHERE id_student = ?";
    $stmt =  $this->conn->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }
 public function DeleteSuggestion($sujet_id, $user_id) {
    $sql = "DELETE FROM sujet WHERE id_sujet = ? AND id_student = ?";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$sujet_id, $user_id]);
}
public function UpdateSuggestion($sujet_id, $titre, $description, $user_id) {
    $sql = "UPDATE sujet SET titre = ?, description = ? WHERE id_sujet = ? AND id_student = ?";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$titre, $description, $sujet_id, $user_id]);
}
public function GetPresentations($user_id) {
   
        $sql = "SELECT DISTINCT s.titre, s.description, 
                GROUP_CONCAT(u.nom) as membres
                FROM subject_assignments sa
                JOIN sujet s ON sa.sujet_id = s.id_sujet
                JOIN user u ON sa.student_id = u.id_user
                WHERE sa.sujet_id IN (
                    SELECT sujet_id 
                    FROM subject_assignments 
                    WHERE student_id = ?
                )
                GROUP BY s.id_sujet";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        

}
public function GetCalendarEvents($user_id) {
    try {
        $sql = "SELECT s.titre, p.presentation_date, 
                GROUP_CONCAT(u.nom SEPARATOR ', ') as student_names
                FROM presentations p
                JOIN sujet s ON p.sujet_id = s.id_sujet
                JOIN subject_assignments sa ON s.id_sujet = sa.sujet_id
                JOIN user u ON sa.student_id = u.id_user
                WHERE sa.sujet_id IN (
                    SELECT sujet_id 
                    FROM subject_assignments 
                    WHERE student_id = ?
                )
                GROUP BY p.id_presentation";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Debug
        error_log('Calendar Events Query Results: ' . print_r($results, true));
        
        return $results;
    } catch (PDOException $e) {
        error_log('Database Error: ' . $e->getMessage());
        return [];
    }
}
public function GetRanking() {
    try {
        $sql = "SELECT u.nom , 
        COUNT(p.id_presentation) as 
        'total_presentation' FROM user 
        u JOIN  sujet s ON s.id_student =u.id_user 
         JOIN presentations p ON p.sujet_id = s.id_sujet where u.role =Apprenant' 
          GROUP BY u.nom ORDER by total_presentationLIMIT 10";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($results)) {
            return [];
        }
        
        // Calculer les points totaux et ajouter l'URL complète de l'image
        foreach ($results as &$result) {
            $result['presentations_count'] = (int)$result['presentations_count'];
            $result['suggestions_count'] = (int)$result['suggestions_count'];
            $result['total_points'] = ($result['presentations_count'] * 10);
            
            // Construire l'URL complète de l'image
            if ($result['image'] === 'default-avatar.png') {
                $result['image'] = '/public/assets/images/default-avatar.png'; // Chemin vers l'image par défaut
            } else {
                $result['image'] = '/public/uploads/profiles/' . $result['image']; // Chemin vers les images uploadées
            }
        }
        
        return $results;
        
    } catch (PDOException $e) {
        error_log('Database Error in GetRanking: ' . $e->getMessage());
        return [];
    }
}
public function GetUserStatistics($user_id) {
    try {
        $sql = "SELECT 
                (SELECT COUNT(*) FROM presentations p 
                 JOIN subject_assignments sa ON p.sujet_id = sa.sujet_id 
                 WHERE sa.student_id = ?) as total_presentations,
                
                (SELECT COUNT(*) FROM sujet 
                 WHERE id_student = ?) as total_suggestions,
                
                (SELECT COUNT(*) FROM sujet 
                 WHERE id_student = ? AND status = 'approved') as approved_suggestions,
                
                (SELECT COUNT(*) FROM presentations p 
                 JOIN subject_assignments sa ON p.sujet_id = sa.sujet_id 
                 WHERE sa.student_id = ? AND p.status = 'completed') as completed_presentations,
                
                (SELECT COUNT(*) FROM presentations p 
                 JOIN subject_assignments sa ON p.sujet_id = sa.sujet_id 
                 WHERE sa.student_id = ? AND p.presentation_date > CURRENT_DATE()) as upcoming_presentations";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $user_id, $user_id, $user_id, $user_id]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Calculer le score total
        $result['total_score'] = ($result['completed_presentations'] * 10) + 
                                ($result['approved_suggestions'] * 5);
        
        return $result;
        
    } catch (PDOException $e) {
        error_log('Database Error in GetUserStatistics: ' . $e->getMessage());
        return [
            'total_presentations' => 0,
            'total_suggestions' => 0,
            'approved_suggestions' => 0,
            'completed_presentations' => 0,
            'upcoming_presentations' => 0,
            'total_score' => 0
        ];
    }
}
}
?>