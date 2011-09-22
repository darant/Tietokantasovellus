
<html>
  <head>
    <title>Printing table contents</title>
  </head>
  <body>
	<?php printToTable() ?>
  </body>
</html>


<?php
function printToTable($myfile = "") {
  $myfile = '/Applications/MAMP/htdocs/loginTest/drinks.txt'; //
  $comment = "#";
  $counter = 0;

  if (!($file = fopen($myfile, "r"))) {   // opens file
    die("Could not open file $cfile");
  }
  else { 
    while (!feof($file)) {               
      $line = trim(fgets($file));      
      
      if ($line && !ereg("^$comment", $line)) { // exclude comments
        $pieces = explode(";", $line);  
        $id = trim($pieces[0]);     
        $value1 = trim($pieces[1]);
        $value2 = trim($pieces[2]);        
        $table_values[$id]= array($id, $value1,$value2);
        $counter++;
      }       
    }
    fclose($file);                       //close folder 
    if ($counter==0) {
      echo "<p>Empty table</p>";
    }
    else {                             //print
     /*
 echo "<table border=\"1\">";
      foreach ($table_values as $key=>$table_values[$key])
        echo "<tr><td>$key</td><td>$table_values[$key]['value1']</td><td>$table_values[$key]['value2']</td></tr>";
      
*/
/*       $table_values[1]['newValue'] */
      
      echo "<table border=\"1\">";
      foreach($table_values as $key1=>$val)
      {
        $sub_array = $val;
        echo "<tr>";
        foreach($sub_array as $key2=>$val)
        {   
          echo "<td>".$table_values[$key1][$key2]."</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
    }
  }
}

?>