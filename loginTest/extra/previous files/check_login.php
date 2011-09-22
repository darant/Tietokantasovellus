<?php
//Setting connection settings
$username = "dasha";
$password = "Xth4PW9mZxFKqME8";
$database = "login";
$socket = "/Applications/MAMP/tmp/mysql/mysql.sock";
$address = "mysql:host=localhost;dbname=" . $database . ";unix_socket=" . $socket;
$table = "members";

//Username and password are sent from login.php form 
$myusername=$_POST['username']; 
$mypassword=$_POST['password'];

//Password encryption
$mypassword = md5($mypassword);

try {
  $connection = new PDO($address, $username, $password);
} catch (PDOException $e) {
  die("Exception: " . $e->getMessage());
}

$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
  $query = $connection->prepare("SELECT * FROM $table WHERE username='$myusername' AND password='$mypassword'");
  $query->execute();
} catch (Exception $e) {
  die("Exception during query execution "  . $e->getMessage());
}

$user = $query->fetch();

//Starting session if user with this name and password is found.
if($user==null) {
  header("location:login.php");
} else {
	session_start(); 
	$_SESSION['username'] =$myusername; 
	$_SESSION['password'] =$mypassword; 
 /*
 session_register('myusername');
  session_register('mypassword');
*/
  header("location:login_success.php");
}

?>
