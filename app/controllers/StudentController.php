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
      $presentations = $this->StudentModel->GetCalendarEvents($user_id);
      $suggestions = $this->StudentModel->GetMySuggestions($user_id);
      $this->render('Etudiant/dashboard', [
          "user_id" => $user_id,
          "user_name" => $user_name,
          "presentations" => $presentations,
          "suggestions" => $suggestions
      ]);
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

public function UpdateSuggestion() {
    if(!isset($_SESSION['user_id']) || !isset($_POST['id_sujet']) || !isset($_POST['titre']) || !isset($_POST['description'])) {
        header('Location: /Etudiant/suggestions');
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $sujet_id = $_POST['id_sujet'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    
    $this->StudentModel->UpdateSuggestion($sujet_id, $titre, $description, $user_id);
    
    header('Location: /Etudiant/suggestions');
    exit();
}

public function ShowPresentations() {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    
    $presentation=$this->StudentModel->GetPresentations($user_id);
    $this->render('Etudiant/presentations', [
        "user_id" => $user_id,
        "user_name" => $user_name,
        "presentation" => $presentation
    ]);
}

public function GetCalendarEvents() {
    if(!isset($_SESSION['user_id'])) {
        header('Content-Type: application/json');
        echo json_encode([]);
        exit;
    }
    
    $user_id = $_SESSION['user_id'];
    $events = $this->StudentModel->GetCalendarEvents($user_id);
    
    $calendarEvents = array_map(function($event) {
        // Formatage de la description pour une meilleure lisibilité
        $description = "Présentateurs: " . $event['student_names'];
        
        return [
            'title' => $event['titre'],
            'start' => $event['presentation_date'],
            'description' => $description,
            'backgroundColor' => '#3B82F6',
            'borderColor' => '#3B82F6',
            'textColor' => 'white',
            'allDay' => false, // Pour montrer que c'est un événement avec une heure précise
            'extendedProps' => [
                'presentateurs' => $event['student_names']
            ]
        ];
    }, $events);
    
    header('Content-Type: application/json');
    echo json_encode($calendarEvents);
    exit;
}

public function ShowCalendar() {
    if(!isset($_SESSION['user_id'])) {
        header("Location: /login");
        exit;
    }
    
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $presentations = $this->StudentModel->GetCalendarEvents($user_id);
    
    $this->render('Etudiant/calendar', [
        "user_id" => $user_id,
        "user_name" => $user_name,
        "presentations" => $presentations
    ]);
}

}
?>