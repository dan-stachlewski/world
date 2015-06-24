<?php
session_start();
session_unset();
session_destroy();  //clears all session variables
//header("Location: http://localhost/world/index.php" );  //returns to login.php page
header("Refresh: 10;url=http://localhost/world/index.php");

echo "align-content: <h2>Thankyou for using the site - you will be returned to index in 10sec</h2>";
?>