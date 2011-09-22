<table width="250" align="left" bgcolor="#CCCCCC" border="0" cellpadding="0" cellspacing="1">
<tr>
<form name="loginform" method="get" action="check_login.php">
<td>
<table width="100%" bgcolor="#FFFFFF" border="0" cellpadding="2" cellspacing="1">
<tr>
<td align="left" colspan="10"><b>Website login</b></td>
</tr>
<tr>
<td align="right"> Username:  </td>
<td><input name="username" type="text"></td>
</tr>
<tr>
<td align="right">Password:  </td>
<td><input name="password" type="text"></td>
</tr>
<tr>
<td></td>
<td align="right"><input type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

<? 
session_start();
session_destroy();
?>
