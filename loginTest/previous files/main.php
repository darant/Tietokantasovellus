
<?php
include("/Applications/MAMP/htdocs/loginTest/session.php");

class MainPage {
	function MainPage() {
		ob_start (); // Buffer output
		require_once("/Applications/MAMP/htdocs/loginTest/layout.php");
		$pageContents = ob_get_contents (); // Get all the page's HTML into a string
		ob_end_clean (); // Wipe the buffer
		
		$title = 'Main | Drinkkiarkisto'; //Set title of the page
		// Replace <!--TITLE--> with $pageTitle variable contents, and print the HTML
		$form = $this->loginForm();
		
		$pageContents = str_replace ("<!--TITLE-->", $title, $pageContents);
		echo str_replace ("<!--LOGIN-->", $form, $pageContents);
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
};

$main = new MainPage();

?>


