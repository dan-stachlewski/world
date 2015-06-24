<?php

/**************************************************
 * SESSIONS:
 **************************************************
 * VALIDATE REQUEST TO LOGIN TO SITE
 * CHECK IF SESSION HAS STARTED ON THE PAGE
 * IF NOT - START A SESSION AND CREATE $_SESSION GLOBAL VAR
 *
 */

if (!isset($_SESSION)) {
	session_start();
}

//CREATING 2 ELEMENTS IN THE $_SESSION VAR AND ASSIGN THEN VALUES FROM THE SUBMITTED FORM

$_SESSION['FirstName'] = $_POST['user'];
$_SESSION['Password'] = $_POST['password'];

?>

<!-- HTML5 DOCUMENT START -->
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Sessions | World in Pictures">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sessions</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
        <h1>Sessions:</h1>

		<section>
			<p><a href="login.php">Login</a></p>
			<p><a href="public_register.php">Public Register</a></p>
			<p><a href="photographer_register.php">Photographer Register</a></p>

			<p><?php echo 'Your Username is ' $_SESSION['FirstName']; ?></p>
			<p><?php echo 'Your Password is ' $_SESSION['Password']; ?></p>

		<form method="" action=""></form>



		</section>

		<section><!-- This section displays world region data from the world_pic database -->

<?php


?>

		</section><!-- /END section -->

        <script src="js/main.js"></script>
    </body>
</html>
<!-- HTML5 DOCUMENT END -->