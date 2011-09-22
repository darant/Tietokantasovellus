<?php
include("/Applications/MAMP/htdocs/loginTest/session.php");
include("/Applications/MAMP/htdocs/loginTest/generate.php");

class Page {
/*

    var $title;
    var $content;
	
	function set($title, $content) {
		$this->title = $title;
		$this->content = $content;
	}
*/
	
	function Page() { 
 	    $this->generateHtml();
 	}
 	    
 	function generateHtml() {  
 	    
 	   
    	  
 	    global $session;
 	    $form; $title;
 	    
		ob_start (); // Buffer output
		require_once("/Applications/MAMP/htdocs/loginTest/layout.php");
		$pageContents = ob_get_contents (); // Get all the page's HTML into a string
		ob_end_clean (); // Wipe the buffer
		
		//Changing title and form on the page, depending on whether user is logged in
		if(!isset($_SESSION["username"])){
		    $title = "Main | Drinkkiarkisto";
			$form = $this->loginForm();
		} else {
		    $title = $session->username . " | Drinkkiarkisto";
		    $form = $this->logoutForm();
		}
	//	$content = $this->recipes_list();
	    $content = $this->identifyLink();
		
		//Replacing corresponding things in html file and printing it.
		$pageContents = str_replace ("<!--TITLE-->", $title, $pageContents);
		$pageContents = str_replace ("<!--LOGIN-->", $form, $pageContents);
		echo str_replace ('<!--OUTPUT-->', $content, $pageContents);
	}
	
	function loginForm() {
	  $formHtml = "<form id=\"form1\" method=\"post\" action=\"userActions.php\">
						<fieldset>
						<legend>Sign-In</legend>
						<label for=\"username\">Username:</label>
						<input id=\"username\" type=\"text\" name=\"username\" value=\"\" />
						<label for=\"password\">Password:</label>
						<input id=\"password\" type=\"password\" name=\"password\" value=\"\" />
						<input id=\"password\" type=\"submit\" name=\"loginForm\" value=\"Sign In\" />
					    <br><a href=\"register.php\">Sign-Up!</a>
						<br><a href=\"resetpass.php\">Forgot Password?</a>
						</fieldset>
	   </form>";
	   return $formHtml;
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
    
    function identifyLink() {
    	$result;
    	global $generator;
    	
    	if (isset($_GET['search'])){
    		$search=$_GET['search']; 
    		$result = $this->identifySearch($search);  		
    	}else{ 
    		$search=''; 
    	}
    	
		
    if (isset($_GET['recipe'])){
    		$name=$_GET['recipe']; 
    		$result = $generator->recipe($name);
    	}else{ 
    		$recipe=''; 
    	}
    	
    if (isset($_GET['ingredient'])){
    		$name=$_GET['ingredient'];
    		$result = $generator->ingredient($name);
    	}else{ 
    		$recipe=''; 
    	}

	    //$backButton = "<br><a href=\"page.php\">Press me</a>";

        return $result;	
       // return $backButton; 
    }
    
    function identifySearch($search) {
        global $generator;
        
    	switch($search){ 

			case 'name' : 
			$result = $generator->all_recipes(); 
    		break; 

			case 'category' : 
    		echo "search recipes by category"; 
    		break; 
    		
    		case 'alcohol' : 
    		echo "search recipes by alcohol content"; 
    		break;
    		
    		case 'ingredient' : 
    		echo "search recipes by ingredient"; 
    		break;
    		
    		case 'i_name' : 
    		$result = $generator->all_ingredients();
    		break;
    		
    		case 'i_type' : 
    		echo "search ingredients by type"; 
    		break;

			default : 
    		$result = 'failed'; 
		}
		
		return $result;	
    }
    
    function recipes_list() {
    	global $session;
    	global $generator;
    	$html = $generator->recipes_html();
      	return $html;
    }
    
    
};

$page = new Page();

?>