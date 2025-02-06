<?php 
require_once (__DIR__.'/../models/User.php');


class AuthController extends BaseController {
 
    private $UserModel ;
   public function __construct(){

      $this->UserModel = new User();

      
   }

   public function showRegister() {
      
    $this->render('auth/register');
   }
   public function showleLogin() {
      
    $this->render('auth/login');
   }
   
   public function handleRegister(){

      
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
         if (isset($_POST['signup'])) {
            echo "<pre>";
         //   var_dump($_POST);die();

             $full_name = $_POST['full_name'];
             $email = $_POST['email'];
             $role = $_POST['role'];
             $password = $_POST['password'];
             $hashed_password = password_hash($password, PASSWORD_DEFAULT);

             $user = [$full_name,$hashed_password,$email,$role];

             //print_r($user);;

             $lastInsertId = $this->UserModel->register($user);

             
            
                 $_SESSION['user_id'] = $lastInsertId ;
                 $_SESSION['user_role'] = $role;
                 $_SESSION['user_name'] = $full_name ;
 
                 if ($lastInsertId && $role == "Formateur") {
                     header('Location: Formateur/dashboard');
                 } else if ($lastInsertId && $role == "Apprenant") {
                     header('Location: Etudiant/dashboard');
                 }                  
                 
                 exit;
             
         }
     }
   }
   public function handleLogin() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['login_btn'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $userData = [$email, $password];
            $user = $this->UserModel->login($userData);

            if ($user) {
               

                $_SESSION['user_id'] = $user["id_user"];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_name'] = $user['nom'];
                if ($user['role'] == "Formateur") {
                    header('Location: /Formateur/dashboard');
                } else if ($user['role'] == "Apprenant") {
                    header('Location: /Etudiant/dashboard');
                }
                exit;
            }
            
            // Si échec de connexion
            header('Location: /ss');
            exit;
        }
    }
}

   public function logout() {

      
      // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
      //  var_dump($_SESSION);die();
         if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
             unset($_SESSION['user_id']);
             unset($_SESSION['user_role']);
             session_destroy();
            
             header("Location: /login");
             exit;
         }
   //   }
   }



}