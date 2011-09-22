<?php
/**
* Database - this class creates connection to database and performs queries to it.
*/      
class Database
{
   var $connection;        

  //Constructor creates new connection to mysql database
  function Database(){  
    $username = "dasha";
    $password = "Xth4PW9mZxFKqME8";
    $database = "Drinkkiarkisto";
    $socket = "/Applications/MAMP/tmp/mysql/mysql.sock";
    $address = "mysql:host=localhost;dbname=" . $database . ";unix_socket=" . $socket;
    $table = "members";

    try {
      $this->connection = new PDO($address, $username, $password);
    } catch (PDOException $e) {
      die("Exception: " . $e->getMessage());
    }

   // $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
  }

   
   /**
   * This method checks if there is a user with a certain username and password in the database.
   *Returns 0 if user is not found, else returns user level (1 to 3).
   */
  function identifyUser($username, $password){
    try {
       $query = $this->connection->prepare("SELECT * FROM users WHERE username='$username' AND password='$password'");
       $query->execute();
    } catch (Exception $e) {
       die("Exception during query execution "  . $e->getMessage());
    }
   //HERE NEED TO PREVENT SOMEHOW DASHA != dasha
    $user = $query->fetch();
   
    //Starting session if user with this name and password is found.
    if($user==null) {
		return 0;
	} else {
		return $user[1];
    }

   }  
   /**
   *  Ths method executes the given $query in the database and returns it.
   */
   function query($query){
        try {
      		$query = $this->connection->prepare($query);
      		$query->execute();
        } catch (Exception $e) {
        
        	die("Exception during query execution "  . $e->getMessage());
        }
        return $query;
   }
};

$database = new Database;

        /*
$prev;
		while($rivi = $query->fetch()) {   
		  if(strcmp($rivi["name1"], $prev["name1"]) != 0) {
		  	print "<br>";
		  	echo $rivi["name1"] . " : ".$rivi["name2"] . " ";
		  } else {
		    //print "</td>";
		  	echo $rivi["name2"] . " ";
		  }
		  $prev = $rivi;
		}
*/


?>
