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
   
  $myfile = '/Applications/MAMP/htdocs/loginTest/recipes_ingredients.txt'; //
  $comment = "#";
  $counter = 0;

  if (!($file = fopen($myfile, "r"))) {   // opens file
    die("Could not open file $cfile");
  }
  else { 
  /*

    try {
		  $query = $connection->prepare("truncate table ingredients");
		  $query->execute();
		  echo "done!";
     } catch (Exception $e) {
		  die("Exception during query execution "  . $e->getMessage());
    } 
*/  
    
    $i=0;
    while (!feof($file)) {               
      $line = trim(fgets($file));      
      
      if ($line && !ereg("^$comment", $line)) { // exclude comments
        $pieces = explode(";", $line);  
       // $id = trim($pieces[0]);     
        $value1 = trim($pieces[0]);
        $value2 = trim($pieces[1]);
        $value3 = trim($pieces[2]); 
        $data = "Insert into recipes_ingredients(recipe_id, ingredient_id, amount_id) values(\"". $value1 . "\",\"". $value2. "\",\"". $value3. "\");";
		        
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