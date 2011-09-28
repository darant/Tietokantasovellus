<?php
include("/Applications/MAMP/htdocs/loginTest/session.php");
include("/Applications/MAMP/htdocs/loginTest/generate.php");
include("/Applications/MAMP/htdocs/loginTest/form.php");


//Should add search field and possibility to choose random recipe
class Page {
	
	var $content;
	
	function Page() { 
 	    $this->generateHtml();
 	}
 	    
 	function generateHtml() {  
 	     	  
 	    global $session;
 	    global $form;
 	    $title;
 	    
		ob_start (); // Buffer output
		require_once("/Applications/MAMP/htdocs/loginTest/layout.php");
		$pageContents = ob_get_contents (); // Get all the page's HTML into a string
		ob_end_clean (); // Wipe the buffer
		
		//Changing title and form on the page, depending on whether user is logged in
		if(!isset($_SESSION["username"])){
		    $title = "Main | Drinkkiarkisto";
			$logForm = $form->loginForm();
		} else {
		    $title = $session->username . " | Drinkkiarkisto";
		    $logForm = $form->logoutForm();
		}
		
	//	$content = $this->recipes_list();
	    $content = $this->identifyLink();
	    $menubar = $form->menubarForm();

		//Replacing corresponding things in html file and printing it.
		$pageContents = str_replace ("<!--TITLE-->", $title, $pageContents);
		$pageContents = str_replace ("<!--LOGIN-->", $logForm, $pageContents);
		$pageContents = str_replace("<!--MENUBAR-->", $menubar, $pageContents);
		echo str_replace ('<!--OUTPUT-->', $content, $pageContents);
	}
	
/*
	function setContent($content) {
		echo $content;
		//$this->content = $content;
		
		return "";
	}
	
	function create_page(){
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
		
	    $menubar = $this->menubar();

		//Replacing corresponding things in html file and printing it.
		$pageContents = str_replace ("<!--TITLE-->", $title, $pageContents);
		$pageContents = str_replace ("<!--LOGIN-->", $form, $pageContents);
		$pageContents = str_replace("<!--MENUBAR-->", $menubar, $pageContents);
		echo str_replace ('<!--OUTPUT-->', $this->content, $pageContents);
	}
*/
    
    /*
    *Examines url to see what category user is searching for: recipe, ingredient, menubar action..
    */
    function identifyLink() {
    	$result ="";
    	global $generator;
    	
    	if (isset($_GET['menu'])){
    		$search=$_GET['menu']; 
    		$result = $this->identifySearch($search);  		
    	}
		//User is searching for recipe
        else if (isset($_GET['recipe'])){
    		$name=$_GET['recipe']; 
    		$result = $generator->recipe($name);
        }
        //User is searching for recipe by category
        else if (isset($_GET['category'])){
    		$name=$_GET['category']; 
    		$result = $generator->category($name);
    	}
    	//User is searching for ingredient
        else if (isset($_GET['ingredient'])){
    		$name=$_GET['ingredient'];
    		$result = $generator->ingredient($name);
    	}
    	//User is searching for recipe by ingredient
    	else if (isset($_GET['recipes_containing'])){
    		$ingredient=$_GET['recipes_containing'];
    		$result = $generator->recipes_containing($ingredient);
    	}
    	//Admin is viewing all suggested recipes
    	else if (isset($_GET['viewsuggestion'])){
    		$search=$_GET['viewsuggestion']; 
    	    $result = $generator->suggestion($search);  		
    	}
    	//User clicking on menubar item
    	else if (isset($_GET['menubar'])){
    		$search=$_GET['menubar']; 
    		$result = $this->identifySearch($search);  		
    	}
    	//Admin clicking in menubar item
    	else if (isset($_GET['admin'])){
    		$search=$_GET['admin']; 
    		$result = $this->identifySearch($search);  		
    	}
    	//Admin has chosen a user to upgrade
   		else if (isset($_GET['upgrade_user'])){
    		$search=$_GET['upgrade_user']; 
    		$result = $generator->upgrade_user($search);
    	    //$generator->delete_user($search);  		
    	} 

    	//Admin is deleting user
    	else if (isset($_GET['deleteuser'])){
    		$search=$_GET['deleteuser']; 
    	    $generator->delete_user($search);  		
    	} 
    	//User is searching for random recipe
    	else if (isset($_GET['random_recipe'])) {
    		$result = $generator->get_random_recipe();
    	}

        return $result;	 
    }
    
    /**
    *Examines the url to see what exact item user is searching for: "Americano" recipe or "Profile" menubar item
    */
    function identifySearch($search) {
        global $generator;
        global $form;
        
    	switch($search){ 

			case 'name' : 
			//$result = $generator->all_recipes(); 
			$result = $generator->recipes_table(); 
    		break; 
    		
    		case 'name2';
			$result = $generator->all_recipes(); 
    		break;
    		
			case 'category' : 
    		$result = $generator->all_categories();
    		break; 
    		
    		case 'alcohol' : 
    		echo "search recipes by alcohol content"; 
    		break;
    		
    		case 'ingredient' : 
    		//echo "search recipes by ingredient"; 
    		$result = $generator->recipes_ingredients();
    		break;
    		
    		case 'i_name' : 
    		$result = $generator->all_ingredients();
    		break;
    		
    		case 'i_type' : 
    		echo "search ingredients by type"; 
    		break;
    		
    		case 'addsuggestion' :
    		$result = $form->suggestionForm();
    		break;
    		
    		case 'admin':
    		$result = $form->createAdminCenter();
    		break;
    		
    		case 'users':
    		$result = $generator->standard_users();
    		break;
    		
    		case 'recipe':
    		//$result = $this->createAdminCenter();
    		break;
    		
    		case 'suggestions':
    	    $result = $generator->list_suggestions();
    		break;
			
			//Admin is upgrading user
			case 'upgrade_user':
			$result = $generator->users_list_upgrade();
			break;
			
			default : 
    		$result = 'failed'; 
		}
		
		return $result;	
    }
    
    function set_content($content) {
    
    }
    
};

$page = new Page();
/*
 "<img src=\"images/Cuba-Libre-icon.png\" alt=\"some_text\"/>
            <a href=\"\">Profile</a>
            <img src=\"images/Sex-on-the-beach-icon.png\"/>
			<a href=\"\">Admin Center</a>";
		<img src=\"images/Banana-Daiquiri-icon.png\"/>
			<a href=\"\">New recipe</a>";
		<img src=\"images/Vodka-Martini-icon.png\"/>
			<a href=\"\">Contact</a></ul>";
*/

?>