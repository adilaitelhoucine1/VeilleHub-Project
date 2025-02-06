<?php 
require_once (__DIR__.'/../models/User.php');
require_once (__DIR__.'/../models/Admin.php');
require_once (__DIR__.'/../models/Student.php');


class StudentController extends BaseController {
    private $UserModel ;
    private $AdminModel ;
    private $StudentModel;
    public function __construct(){

        $this->UserModel = new User();
        $this->AdminModel = new Admin();
        $this->StudentModel = new Student();
  
        
     }

     public function ShowDashboard() {
      
        // if(!(isset($_SESSION['role']) == "Formateur")){
        //    header("Location: /login ");
        //    exit;
        // }
      $user_id= $_SESSION['user_id'];
      $user_name= $_SESSION['user_name'];
      //$apprenants=$this->StudentModel->GetAllStudents();
      $this->render('Etudiant/dashboard', ["user_id" => $user_id, "user_name" => $user_name]);
     }

 public function AddSuggestion() {
    if (!isset($_SESSION['user_id']) || !isset($_POST['titre']) || !isset($_POST['description'])) {
        header('Location: /Etudiant/dashboard');
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $description = $_POST['description'];
    $titre = $_POST['titre'];

    $this->StudentModel->AddSuggestion($titre, $description, $user_id);
    
    header('Location: /Etudiant/dashboard');
    exit();
}


public function ShowSuggestions() {
    if(!isset($_SESSION['user_id'])) {
        header("Location: /login");
        exit;
    }
    
    $user_id = $_SESSION['user_id'];
    $suggestions = $this->StudentModel->GetMySuggestions($user_id);
    
    $this->render('Etudiant/suggestions', [
        "suggestions" => $suggestions,
    ]);
}
public function DeleteSuggestion($sujet_id) {
    if(!isset($_SESSION['user_id'])) {
        header("Location: /login");
        exit;
    }
    
    $user_id = $_SESSION['user_id'];
    $this->StudentModel->DeleteSuggestion($sujet_id, $user_id);
    
    header('Location: /Etudiant/suggestions');
    exit();
}


}
?>