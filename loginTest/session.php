<?php

include("/Applications/MAMP/htdocs/loginTest/database.php");

/**
* Session - this class handles
*/
class Session
{
  var $username;         
  var $password;
  var $access_lvl; // 1 for basic user, 2 for an user with extra rights, 3 for page owner 
  var $logged_in;    
  
   
  function Session(){
    $this->startSession();
  }

  function startSession(){
    global $database; 
    session_start(); 
    $this->logged_in = $this->checkLogin();
   }

	   
	/**
	* This method checks if user is already logged. Returns 1 if user is logged, 0 otherwise.
	*/
   function checkLogin(){
      //connection to database
      global $database;  
      
      //User is already logged in
      if(isset($_SESSION['username'])){
          //Username or password aren't valid => unset session variables, logout
          $user = $database->identifyUser($_SESSION['username'], md5($_SESSION['password']));
          
          if($user == 0){            
             unset($_SESSION['username']);
             unset($_SESSION['password']);
             return 0;
          }
         
          //Information is valid, log in user.
          $this->username = $_SESSION['username'];
          $this->password = $_SESSION['password'];
          $this->access_lvl = $user;
          return 1;
      }
      // User is not logged in
      else {  
         return 0;    
      }

  }
  
  
   /**
    * login - Gets called when the user wants to log in the website.
    */
   function login($username, $password){
      //Connection to database
      global $database;  
      
      /* Checks that username is in database and password is correct */
      $username = stripslashes($username);
      $result = $database->identifyUser($username, md5($password));
      
      //Username or password aren't correct
      if($result == 0){ 
         return false;
      }
    
      //Username and password correct, set session variables 
      $this->username  = $_SESSION['username'] = $username;
      $this->password  = $_SESSION['password'] = $password;

      // Login completed 
      return true;
   }
   
   /**
    * logout - Gets called when the user wants to be logged out of the
    * website. 
    */
   function logout(){
      //Connection to database
      global $database;

      // Unset session variables 
      unset($_SESSION['username']);
      unset($_SESSION['password']);
      
      $this->access_lvl = 0;
      $this->logged_in = false;
   }
   
   function getUsr() {
       return $this->username;
   }
};  

$session = new Session;

?>
