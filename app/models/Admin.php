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

}