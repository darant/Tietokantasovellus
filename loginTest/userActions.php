<?php
include("/Applications/MAMP/htdocs/loginTest/session.php");
include("/Applications/MAMP/htdocs/loginTest/output.php");
/**
* Action
*/
class Action
{
   //Constructor 
   function Action(){
      global $session;
      global $output;
      
      //User is trying to log in
      if(isset($_POST['loginForm'])){
         $this->login();
      }
      //User is trying to log out
      else if(isset($_POST['logoutForm'])){
         $this->logout();
      }
      //User is trying to register
      else if(isset($_POST['registerForm'])){
         $this->register();
      }
      else if(isset($_POST['suggestionForm'])) { 
        $output->addSuggestion($_POST['recipename'], $_POST['ing1'],$_POST['ing2'],$_POST['ing3'],$_POST['ing4'],$_POST['ing5'],$_POST				['ing6'],$_POST['category']);
        header("Location: page.php");
      }
      //Shouldn't reach this loop
      else{
          header("Location: page.php");
      }
   }

   function login(){
      global $session;
    //  global $page;
      $logged_in = $session->login($_POST['username'], $_POST['password']);
      header('Location: page.php');
    //echo "hello world";
   }
   
   function logout(){
      global $session;
      //global $page;
      $logged_in = $session->logout();
      header('Location: page.php');
   }
   
   //Leaving out Email for now, should fix later
   function register() {
      global $session;    
      $registered = $session->register($_POST['username'], $_POST['password']);
      
      //header('Location: page.php');
    }   
};

$action = new Action;   
?>