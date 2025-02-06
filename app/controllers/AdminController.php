<?php 
// session_start();
require_once (__DIR__.'/../models/User.php');
require_once (__DIR__.'/../models/Admin.php');

class AdminController extends BaseController {
    private $UserModel ;
    private $AdminModel ;
    public function __construct(){

        $this->UserModel = new User();
        $this->AdminModel = new Admin();
  
        
     }

   public function Admindashboard() {
      
      // if(!(isset($_SESSION['role']) == "Formateur")){
      //    header("Location: /login ");
      //    exit;
      // }
    $user_id= $_SESSION['user_id'];
    $user_name= $_SESSION['user_name'];
    $apprenants=$this->AdminModel->GetAllStudents();
    $this->render('Formateur/dashboard', ["user_id" => $user_id, "user_name" => $user_name,"apprenants"=>$apprenants]);
   }
   
   public function DeleteUser($user_id){
     $this->AdminModel->DeleteUser($user_id);
     $user_id = $_SESSION['user_id'];
     $user_name = $_SESSION['user_name'];
     $apprenants = $this->AdminModel->GetAllStudents();
     $this->render("Formateur/dashboard", [
         "user_id" => $user_id,
         "user_name" => $user_name,
         "apprenants" => $apprenants
     ]);
   }
   public function ChangerStatus($user_id) {
    $result = $this->AdminModel->ChangerStatus($user_id);
    
    if ($result) {
        header('Location: /Formateur/dashboard');
        exit();
    } else {
        header('Location: /Formateur/dashboard?error=status_change_failed');
        exit();
    }

}

public function ShowSuggestion() {
    // if(!($_SESSION['role'] == 'Formateur')) {
    //     header("Location: /login");
    //     exit;
    // }

    $suggestions = $this->AdminModel->GetAllSuggestion();
    
    if($suggestions === null) {
        $suggestions = [];
    }

    $this->render("Formateur/validate_suggestions", [
        "suggestions" => $suggestions
    ]);
}

public function ApproveSuggestion($sujet_id) {
    // if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Formateur') {
    //     header("Location: /login");
    //     exit;
    // }
    
    if($this->AdminModel->ApproveSuggestion($sujet_id)) {
        header("Location: /Formateur/valider_Suggestion");
        exit();
    }
}

public function RejectSuggestion($sujet_id) {
    // if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Formateur') {
    //     header("Location: /login");
    //     exit;
    // }
    
    if($this->AdminModel->RejectSuggestion($sujet_id)) {
        header("Location: /Formateur/valider_Suggestion");
        exit();
    } 
}


public function ShowSubjects() {
    // Récupérer les sujets validés
    $suggestions = $this->AdminModel->GetValidatedSubjects();
    $students = $this->AdminModel->GetAllStudents();
   
    // Rendre la vue avec les sujets
    $this->render("Formateur/assign_subjects", [
        "suggestions" => $suggestions,
        "students" => $students,

    ]);
}




public function assign_students() {

        $sujet_id = $_POST['sujet_id'];
        $student_ids = $_POST['students'] ;
     //print_r($student_ids);
    // die();
        if (empty($student_ids) || !is_array($student_ids) || count($student_ids) < 2) {
            header('Location: /Formateur/Showsubjects');
        }else{
            $result = $this->AdminModel->assignStudentsToSubject($sujet_id, $student_ids);
    
            if ($result) {
                header('Location: /Formateur/Showsubjects');
                exit();
            }
        }


    
}






public function testimonials() {
 
    $this->renderDashboard('admin/testimonials');
   }
   public function projects() {
  
    $this->renderDashboard('admin/projects');
   }

//    public function handleUsers(){
  


    
//     // Get filter and search values from GET
//     $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all'; // Default to 'all' if no filter is selected
//     $userToSearch = isset($_GET['userToSearch']) ? $_GET['userToSearch'] : ''; // Default to empty if no search term is provided
//     // var_dump($userToSearch);die();

//     // Call showUsers with both filter and search term
//     $users = $this->UserModel->getAllUsers($filter, $userToSearch);
//     $this->renderDashboard('admin/users',["users"=> $users]);
//    }











    // function to remove user
    // function removeUser($idUser){
    //     include '../connection.php';
    //     $removeUser = $conn->prepare("DELETE FROM utilisateurs WHERE id_utilisateur=?");
    //     $removeUser->execute([$idUser]);
    // }
    
    // // check the post request to remove the user
    // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_user'])) {
    //     $idUser = $_POST['remove_user'];
    //     removeUser($idUser);
    //     // Redirect to avoid form resubmission after page reload
    //     header("Location: users.php");
    //     exit();
    // }

    // // function to block user
    // function changeStatus($idUser){
    //     include '../connection.php';

    //     // get the old status
    //     $stmt = $conn->prepare("SELECT is_active FROM utilisateurs WHERE id_utilisateur = ?");
    //     $stmt->execute([$idUser]);
    //     $currentStatus = $stmt->fetchColumn();

    //     $changeStatus = $conn->prepare("UPDATE utilisateurs SET is_active=? WHERE id_utilisateur=?");
    //     $changeStatus->execute([$currentStatus==0?1:0,$idUser]);
    // }
    // // check the post request to block the user
    // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['block_user_id'])) {
    //     $idUser = $_POST['block_user_id'];
    //     changeStatus($idUser);
    //     // Redirect to avoid form resubmission after page reload
    //     header("Location: users.php");
    //     exit();
    // }





 

public function ShowCalendar() {
    $presentations = $this->AdminModel->GetScheduledPresentations();
    $assignedSubjects = $this->AdminModel->GetAssignedSubjectsWithoutDate();
    
    $this->render('Formateur/calendar', [
        "presentations" => $presentations,
        "assignedSubjects" => $assignedSubjects
    ]);
}

public function SchedulePresentation() {
    if (!isset($_POST['sujet_id'], $_POST['presentation_date'], $_POST['presentation_time'])) {
        header('Location: /Formateur/calendar?error=missing_data');
        exit();
    }

    $sujet_id = $_POST['sujet_id'];
    $presentation_date = $_POST['presentation_date'];
    $presentation_time = $_POST['presentation_time'];
    
    // Combine date and time
    $presentation_datetime = $presentation_date . ' ' . $presentation_time;
    
    $result = $this->AdminModel->SchedulePresentation($sujet_id, $presentation_datetime);
    
    if ($result) {
        header('Location: /Formateur/calendar?success=scheduled');
    } else {
        header('Location: /Formateur/calendar?error=scheduling_failed');
    }
    exit();
}

}