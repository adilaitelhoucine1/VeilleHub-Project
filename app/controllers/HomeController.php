<?php 

class HomeController extends BaseController {

   public function index() {
      // Check if the user is logged in
      if(isset($_SESSION['user_loged_in_id'])){
         header("Location: /admin/dashboard");
         exit;
      }
      // Render the homepage for visitors
      $this->render('home');
   }

}