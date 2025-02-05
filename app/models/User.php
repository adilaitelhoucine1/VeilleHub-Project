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


}