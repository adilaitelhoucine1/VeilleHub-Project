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
        $sql = "SELECT u.nom,COUNT(p.id_presentation) as 'total_presentation' 
        FROM sujet s JOIN user u ON u.id_user=s.id_student JOIN presentations p 
        on p.sujet_id=s.id_sujet 
        ORDER by total_presentation
         LIMIT 10";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération du classement : " . $e->getMessage());
        return [];
    }
}
public function GetUserStatistics($user_id) {
    try {
        // Statistiques de base
        $stats = [
            'total_presentations' => $this->CountPresentations($user_id),
            'total_suggestions' => $this->CountSuggestions($user_id),
            'approved_suggestions' => $this->CountSuggestionsByStatus($user_id, 'approved'),
            'pending_suggestions' => $this->CountSuggestionsByStatus($user_id, 'pending'),
            'total_points' => 0,
            'rank' => $this->GetUserRank($user_id),
            'total_users' => $this->CountTotalStudents()
        ];

        // Calcul des points (10 points par présentation, 5 points par suggestion approuvée)
        $stats['total_points'] = ($stats['total_presentations'] * 10) + ($stats['approved_suggestions'] * 5);

        // Données pour le graphique d'évolution
        $stats['points_history'] = $this->GetPointsHistory($user_id);

        return $stats;
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération des statistiques : " . $e->getMessage());
        return null;
    }
}

private function CountPresentations($user_id) {
    $sql = "SELECT COUNT(*) FROM presentations p 
            JOIN subject_assignments sa ON p.sujet_id = sa.sujet_id 
            WHERE sa.student_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
}

private function CountSuggestions($user_id) {
    $sql = "SELECT COUNT(*) FROM suggestion WHERE user_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
}

private function CountSuggestionsByStatus($user_id, $status) {
    $sql = "SELECT COUNT(*) FROM suggestion WHERE user_id = ? AND status = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$user_id, $status]);
    return $stmt->fetchColumn();
}

private function GetUserRank($user_id) {
    $sql = "WITH RankedUsers AS (
                SELECT 
                    u.id_user,
                    (COUNT(DISTINCT p.id_presentation) * 10 + 
                     COUNT(DISTINCT CASE WHEN s.status = 'approved' THEN s.id_suggestion END) * 5) as points,
                    DENSE_RANK() OVER (ORDER BY 
                        (COUNT(DISTINCT p.id_presentation) * 10 + 
                         COUNT(DISTINCT CASE WHEN s.status = 'approved' THEN s.id_suggestion END) * 5) DESC
                    ) as rank
                FROM user u
                LEFT JOIN subject_assignments sa ON u.id_user = sa.student_id
                LEFT JOIN presentations p ON sa.sujet_id = p.sujet_id
                LEFT JOIN suggestion s ON u.id_user = s.user_id
                WHERE u.role = 'student'
                GROUP BY u.id_user
            )
            SELECT rank FROM RankedUsers WHERE id_user = ?";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn() ?: '-';
}

private function CountTotalStudents() {
    $sql = "SELECT COUNT(*) FROM user WHERE role = 'student'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}

private function GetPointsHistory($user_id) {
    // Cette méthode retourne l'historique des points sur les 6 derniers mois
    $sql = "SELECT 
                DATE_FORMAT(COALESCE(p.presentation_date, s.created_at), '%Y-%m') as month,
                COUNT(DISTINCT p.id_presentation) * 10 as presentation_points,
                COUNT(DISTINCT CASE WHEN s.status = 'approved' THEN s.id_suggestion END) * 5 as suggestion_points
            FROM (
                SELECT LAST_DAY(CURRENT_DATE) - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) MONTH as date
                FROM (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5) as a
                CROSS JOIN (SELECT 0 as a) as b
                CROSS JOIN (SELECT 0 as a) as c
                WHERE LAST_DAY(CURRENT_DATE) - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) MONTH > DATE_SUB(CURRENT_DATE, INTERVAL 6 MONTH)
            ) as dates
            LEFT JOIN subject_assignments sa ON sa.student_id = ?
            LEFT JOIN presentations p ON sa.sujet_id = p.sujet_id 
                AND DATE_FORMAT(p.presentation_date, '%Y-%m') = DATE_FORMAT(dates.date, '%Y-%m')
            LEFT JOIN suggestion s ON s.user_id = ?
                AND DATE_FORMAT(s.created_at, '%Y-%m') = DATE_FORMAT(dates.date, '%Y-%m')
            GROUP BY DATE_FORMAT(dates.date, '%Y-%m')
            ORDER BY month ASC";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$user_id, $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>