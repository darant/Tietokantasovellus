<?php
include("/Applications/MAMP/htdocs/loginTest/session.php");
//include("/Applications/MAMP/htdocs/loginTest/output.php");
include("/Applications/MAMP/htdocs/loginTest/form.php");
include("/Applications/MAMP/htdocs/loginTest/generate.php");
include("/Applications/MAMP/htdocs/loginTest/pageTest.php");

class Search {

	function Search() {
		if (isset($_GET['a'])){
    		$word=$_GET['a']; 
    		$result = $this->search_for($word);  		
    	}
	}
	
	function search_for($word){
		global $output;
		global $generator;
		
		//First search main tables: recipes		
		if($output->table_contains('recipes', $word) == 1) {
			$search_result = $generator->recipe($word);
		} else if ($output->table_contains('ingredients', $word) == 1){
			$search_result = $generator->ingredient($word);
		} else {
			$search_result = "Search continues";
		}
		
		$this->generateHTML($search_result);
		//header("Location: page.php");
	}
	
	function generateHtml($content) {  
 	     	  
 	    global $session; global $form;
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

	    $menubar = $form->menubarForm();
	    
	    //Replacing corresponding things in html file and printing it.
		$pageContents = str_replace ("<!--TITLE-->", $title, $pageContents);
		$pageContents = str_replace ("<!--LOGIN-->", $logForm, $pageContents);
		$pageContents = str_replace("<!--MENUBAR-->", $menubar, $pageContents);
		echo str_replace ('<!--OUTPUT-->', $content, $pageContents);
	}

};

$search = new Search();

?>