<?
include("/Applications/MAMP/htdocs/loginTest/session.php");


//Should never get there
if($session->logged_in){
   echo "<p>$session->username, you are already registered.";
}
else{
?>

<html>
<title>Registration page</title>
<body>
<h1>Register</h1>
<form id="registerForm" method="POST" action="userActions.php" >
<table align="left">
		<tr>
			<td>Username:</td>
			<td><input type="text" name="username" maxlength="15" value=""></td>
		</tr>

		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" maxlength="15" value=""></td>
		</tr>

		<tr>
			<td>E-mail:</td>
			<td><input type="text" name="email" maxlength="50" value=""></td>
		</tr>

		<tr>
			<td colspan="3" align="right"><input type="submit" name="registerForm" value="Join"></td>
		</tr>
	
		<tr>
			<td colspan="3" align="left"><a href="page.php">Back to Main page</a></td>
		</tr>
	</table>
</form>
</body>
</html>

<?
}
?>