<?php
  $username = "dasha";
  $password = "Xth4PW9mZxFKqME8";
  $database = "Drinkkiarkisto";
  $socket = "/Applications/MAMP/tmp/mysql/mysql.sock";
  $address = "mysql:host=localhost;dbname=" . $database . ";unix_socket=" . $socket;

  try {
    $connection = new PDO($address, $username, $password);
  } catch (PDOException $e) {
    die("Exception: " . $e->getMessage());
  }

  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
  $myfile = '/Applications/MAMP/htdocs/loginTest/ingredients.txt'; //
  $comment = "#";
  $counter = 0;

  if (!($file = fopen($myfile, "r"))) {   // opens file
    die("Could not open file $cfile");
  }
  else { 
    //cleaning table from all the previous data
    /*
 try {
		  $query = $connection->prepare("truncate table ingredients");
		  $query->execute();
		  echo "done!";
     } catch (Exception $e) {
		  die("Exception during query execution "  . $e->getMessage());
    }  
*/    
    
    
    
    while (!feof($file)) {               
      $line = trim(fgets($file));      
      
      if ($line && !ereg("^$comment", $line)) { // exclude comments
        $pieces = explode(";", $line);  
        $id = trim($pieces[0]);     
        $value1 = trim($pieces[1]);
        $value2 = trim($pieces[2]); 
        
        $data = "Insert into ingredients(name, description) values(\"". $value1 . "\",\"". $value2. "\");";
		        
        try {
		  $query = $connection->prepare($data);
		  $query->execute();
		  echo "done!";
		} catch (Exception $e) {
		  die("Exception during query execution "  . $e->getMessage());
		}       
      }       
     }
   }  
    fclose($file);                       //close folder 
 ?>