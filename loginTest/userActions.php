<?php
include("/Applications/MAMP/htdocs/loginTest/session.php");
//include("/Applications/MAMP/htdocs/loginTest/page.php");
/**
* Action
*/
class Action
{
   //Constructor 
   function Action(){
      global $session;
      
      //User is trying to log in
      if(isset($_POST['loginForm'])){
         $this->login();
      }
      //User is trying to log out
      else if(isset($_POST['logoutForm'])){
         $this->logout();
      }
      //Shouldn't reach this loop
      else{
          header("Location: page.php");
      }
   }

   function login(){
      global $session;
      global $page;
      $logged_in = $session->login($_POST['username'], $_POST['password']);
      header('Location: page.php');
    //echo "hello world";
   }
   
   function logout(){
      global $session;
      global $page;
      $logged_in = $session->logout();
      header('Location: page.php');
   }
};

$action = new Action;   

   /*
   if($logged_in){
		//header('Location: user_page.php');
		header('Location: page.php');
      }
      else{
        header('Location: page.php');
    //    header("Location: main.php");
      }
*/
?>