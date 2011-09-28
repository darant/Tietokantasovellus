<?php
//include("/Applications/MAMP/htdocs/loginTest/session.php");

$form = new form;

class form {

	function form() {
	}
	
/**
	*This function creates html of login form for the web page. It is shown when user
	*is not logged in.
	*/
	function loginForm() {
	  $formHtml = "<form id='form1' method='post' action='userActions.php'>
						<fieldset>
						<legend>Sign-In</legend>
						<label for='username'>Username:</label>
						<input id='username' type='text' name='username' value='' />
						<label for='password'>Password:</label>
						<input id='password' type='password' name='password' value='' />
						<input id='password' type='submit' name='loginForm' value='Sign In' />
						<br><a href='resetpass.php'>Forgot Password?</a>
						</fieldset>
	   </form>";
	   return $formHtml;
	}
	
	/**
	*This function creates html of logout form for the web page. It is shown when the user is
	*logged in.
	*/
	function logoutForm(){
	    global $session;
		$loggedForm = "<form id='form1' method='post' action='userActions.php'>
						<fieldset>
						<label for='username'>Username: ". $session->username ."</label>
						<br><br><br><input id='password' type='submit' name='logoutForm' value='Log Out' />
						</fieldset>
	                   </form>";
		return $loggedForm;
    }
    
    /**
	*This function creates html of menubar for the web page. It depends on access level of the user.
	*For example, standard user can view his own profile and suggest recipes, admin can delete users, 
	*moderate suggestions of others and add own recipes.
	*/
    function menubarForm() {
   		global $session;
	
		$menubar = "<img src='images/Cuba-Libre-icon.png' alt='some_text'/>
            <a href='register.php'>Sign-Up!</a>";
		
		
		switch($session->access_lvl){ 
			
			case 1 : 
			$menubar = "<img src='images/Cuba-Libre-icon.png' alt='some_text'/>
            <a href='page.php?menubar=profile'>Profile</a>
			<img src='images/Sex-on-the-beach-icon.png'/>
			<a href='page.php?menubar=addsuggestion'>Suggest recipe</a>";
			break; 

			//This should be fixed user and user+ have same actions
			case 2 :
			$menubar = "<img src='images/Cuba-Libre-icon.png' alt='some_text'/>
            <a href='page.php?menubar=profile'>Profile</a>
			<img src='images/Sex-on-the-beach-icon.png'/>
			<a href='page.php?menubar=addsuggestion'>Suggest recipe</a>"; 
    		break;
    		
    		case 3 : 
			$menubar = "<img src='images/Cuba-Libre-icon.png' alt='some_text'/>
            <a href='page.php?menubar=profile'>Profile</a>
            <img src='images/Sex-on-the-beach-icon.png'/>
			<a href='page.php?menubar=admin'>Admin_Center</a>";
			break;	
		}
		
		return $menubar;
    }
    
    /**
	*This function creates html of the recipe suggestion form for the web page. Users access
	*it via menubar.
	*/
	function suggestionForm() {
    	$form = "<form id='suggestionForm'method='post' action='userActions.php'>
    	<h2>New recipe:</h2>

		Recipe name:<br /> <input type='text' name='recipename' '/><br /><br />
		
		Ingredient 1: <br /><input type='text' name='ing1' /><br />
		Ingredient 2: <br /><input type='text' name='ing2' /><br />
		Ingredient 3: <br /><input type='text' name='ing3' /><br />
		Ingredient 4: <br /><input type='text' name='ing4' /><br />
		Ingredient 5: <br /><input type='text' name='ing5' /><br />
		Ingredient 6: <br /><input type='text' name='ing6' /><br /><br />
		
		Category (optional): <br /><input type='text' name='category' /><br /><br />
		
		<input type='submit' name='suggestionForm' value='Submit'/>
		</form>";
    
    	return $form;
    }

	
    /**
	*This function creates html of the admin center for the web page. Admins access it through menubar.
	*/
    function createAdminCenter() {
        $center =" <a href='page.php?admin=suggestions'>View suggestions</a><br>
        <a href='page.php?admin=recipe'>Add recipe to database</a><br>
        <a href='page.php?admin=upgrade_user'>Upgrade user</a><br>
        <a href='page.php?admin=users'>Delete user</a>";
    	return $center;
    }
};    
?>