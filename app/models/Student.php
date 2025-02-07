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
}
?>