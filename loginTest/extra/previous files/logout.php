<?php
 // session_write_close();
  unset($_SESSION["username"]);
  unset($_SESSION["password"]);
  header("location:login.php");
?>