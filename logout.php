<?php
session_start();
session_unset();
session_destroy();  //clears all session variables
header("Location: http://localhost/world/login.php" );  //returns to login.php page

?>