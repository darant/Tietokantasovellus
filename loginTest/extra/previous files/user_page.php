<?php
include("/Applications/MAMP/htdocs/loginTest/session.php");
include("/Applications/MAMP/htdocs/loginTest/generate.php");

$usr = new UserPage();


class UserPage {

    function UserPage() {
        global $session;
       // global $generator;
		//echo $session->access_lvl;
		
		//Moving to main page if session username isn't set
		if(!isset($_SESSION["username"])){
			header("location:main.php");
		}
		
		ob_start (); 
		require_once("/Applications/MAMP/htdocs/loginTest/layout.php");
		$pageContents = ob_get_contents ();
		ob_end_clean (); 
				
		//Creating title and a box with a name of user
		$title = "Logged in as " . $session->username . " | Drinkkiarkisto";	
		$form = $this->logoutForm();
		$text = $this->recipes_list();
		
		
		//echo $outp;
		
		//Replacing corresponding variables in class layout.php and printing the HTML of page
		$pageContents = str_replace ('<!--TITLE-->', $title, $pageContents);
		$pageContents = str_replace ('<!--LOGIN-->', $form, $pageContents);
		echo str_replace ('<!--OUTPUT-->', $text, $pageContents);
    }
    
    /**
    * This function returns HTML for box with information about user (replaces login form
    * when user logs in).
    */
    function topMenu() {
        global $session;
        return "<div id=\"navmenu\">                  
  <ul>
					<a href=\"<?php echo get_settings('home'); ?>\">My Account</a>
					<a href=\"wordpress/recipes/\">My Recipes</a>
					<a href=\"wordpress/travel/\">Suggest Recipe</a>
					<a href=\"http://www.wordpress.org\">Contact</a></ul>	
				</div>";

    
   	}
   	
    function logoutForm(){
	    global $session;
		$loggedForm = "<form id=\"form1\" method=\"post\" action=\"userActions.php\">
						<fieldset>
						<label for=\"username\">Username: ". $session->username ."</label>
						<br><br><br><input id=\"password\" type=\"submit\" name=\"logoutForm\" value=\"Log Out\" />
						</fieldset>
	                   </form>";
		return $loggedForm;
    }
    
    function recipes_list() {
    	global $session;
    	global $generator;
    	$html = $generator->recipes_html();
      	return $html;
    }
};




//Some old stuff
/*
$username = "dasha";
$password = "Xth4PW9mZxFKqME8";
$database = "login";
$socket = "/Applications/MAMP/tmp/mysql/mysql.sock";
$address = "mysql:host=localhost;dbname=" . $database . ";unix_socket=" . $socket;
/*
$recipe = "recipesT";
$ingredient = "IngredientT";
$join="joinT";
*/

/*
try {
  $connection = new PDO($address, $username, $password);
} catch (PDOException $e) {
  die("Exception: " . $e->getMessage());
}
*/

/*
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
  $query = $connection->prepare("SELECT recipesT.name as name1, IngredientT.name as name2 FROM recipesT, joinT, IngredientT where recipesT.id=joinT.recipe_id and IngredientT.id=joinT.ingredient_id GROUP BY name1, name2");
  $query->execute();
} catch (Exception $e) {
  die("Exception during query execution "  . $e->getMessage());
}
*/







/*
echo "All recipes";
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


/*
print "<table>";
print "<td>All recipes</td>";
$prev;
while($rivi = $query->fetch()) {
  print "<tr>";   
  if(strcmp($rivi["name1"], $prev["name1"]) != 0) {
  	//print "</td>";
  	//print "<td></td>";
  	print "<td>" . $rivi["name1"] . " : ".$rivi["name2"] . "<td>";
  } else {
    //print "</td>";
  	print "<td>". $rivi["name2"]. "</td>";
  }
  print "</tr>";
  $prev = $rivi;
}
print "</table>";
*/
?>
