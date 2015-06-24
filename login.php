<?php

//START A SESSION TO STORE USER LOGIN CREDENTIALS
session_start();

//DECLARING VARIABLES FOR FORM VALIDATION
$Email       = "";
$UserName    = "";
$Password    = "";

//CREATED AN ERRORS ARRAY FOR STORING ERRORS TO BE DISPLAYED TOGETHER
$errors = array();

//BASIC FORM VALIDATION
if (isset($_POST['login'])) {


	if (!empty($_POST["Email"]) && empty($_POST["Username"]) && empty($_POST["Password"])) {
		$errors["Email"] = "Password Required!";
	} else {
		$Email = test_input($_POST["Email"]);
	}

	if (!empty($_POST["UserName"]) && empty($_POST["Email"]) && empty($_POST["Password"])) {
		$errors["UserName"] = "Password Required!";
	} else {
		$UserName = test_input($_POST["UserName"]);
	}

	if (empty($_POST["UserName"]) && empty($_POST["Email"]) && empty($_POST["Password"])) {
		$errors["UserName"] = "Please enter Username or Email and you Password!";
	} else {
		$Email = test_input($_POST["Email"]);
		$UserName = test_input($_POST["UserName"]);
	}

	if (!empty($errors)) {
		echo "<div class=\"error\">";
		echo "Please fix the following errors:";
		echo "<ul>";

		foreach ($errors as $key => $error) {
			echo "<li>{$error}</li>";
		}
		echo "</ul>";
		echo "</div>";
	}

}//END ($_SERVER["REQUEST_METHOD"] == "POST")



//THIS CODE CHECKS TO SEE IF THE LOGIN BUTTON HAD BEEN PRESSES
//AND WHAT VALUES HAVE BEEN ENTERED TO VALIDATE THE USER
//IF THE CORRECT DATA IS ENTERED AND COMPARED WITH THE DATABASE = TRUE USER IS LOGGED IN
//I HAVE GIVEN USER THE CHOICE OF USING USERNAME OR EMAIL ADDRESS AS LOGIN
if (isset($_POST['login']) && (isset($_POST['Email']) || isset($_POST['UserName']))  && isset($_POST['Password']) && empty($errors)) {

	//REQUIRE_ONCE INCLUDE CODE USED TO RETRIEVE DATABASE CONNECTION CODE
	require_once('includes/connection.php');

	//CHECK DATABASE CONNECTION OPEN
	if (isset($db) === true) {
	//IF !TRUE REDIRECT USER TO ERROR PAGE USING REDIRECTION HEADER

	//IF ID IN URL EXISTS if(!empty($_GET['id']))
	//USE VARIABLE HANDLING FUNCTION INTVAL [ RETURNS AN INTEGER VALUE OF A VARIABLE ]
	//USE INTEGER VERSION OF ID TO RETRIEVE THE ASSOCIATED DATA FROM THE country TABLE
	//SELECTING TABLE country
	//SELECTING CommonName, CountryCode DATA FROM TABLE
	//WHERE WorldRegionID IS PASSED FROM COUNTRIES PAGE TO LOCATIONS PAGE VIA URL, COVERTED TO INTEGER FOR USE
	//ASSIGN DATA TO VARIABLE $sql
	//IF EMPTY ID REDIRECT USER TO INDEX PAGE
	$query =
	'SELECT ID, UserName, Email, Password
	 FROM photographer
	 WHERE UserName = :UserName
	 AND Email = :Email
	 AND Password = :Password';

	$username = trim($_POST['UserName']) ;
	$email =  trim($_POST['Email']) ;  // remove the space
	$password = trim($_POST['Password']);
	$stmt = $db->prepare($query);           //prepare method does not actually execute query
	$stmt->bindParam(':UserName', $username, PDO::PARAM_STR);  //binding user input to parameter/variable search
	$stmt->bindParam(':Email', $email, PDO::PARAM_STR);  //binding user input to parameter/variable search
	$stmt->bindParam(':Password', $password, PDO::PARAM_STR);  //binding user input to parameter/variable search
	$stmt->bindColumn('ID', $id); //binding column results to variables
	$stmt->bindColumn('UserName', $username);
	$stmt->bindColumn('Email', $email);
	$stmt->bindColumn('Password', $password);
	$stmt->execute();             // PDO method executes query statement when it has been prepared

	//ASSIGN SANITISED VARIABLES TO SESSION
	$_SESSION['UserName'] = $username;
	$_SESSION['Email'] = $email;
	$_SESSION['Password'] = $password;

	//Show all row that chosen----------------
	$row= $stmt->fetchAll(PDO::FETCH_ASSOC);

	//-----------------------------------------
	$numRows = $stmt->rowCount();
		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";

	//USE VALIDATION TO REMOVE EVERYTHING AFTER THE @ SO IT LOOKS LIKE THEIR NAME IS BEING PRINTED WHEN THEY SAY WELCOME BACK
	//OR TRY AND USE A QUERY WHERE PHP LOOKS UP THE MATCHING USERNAME FOR THE EMAIL ADDRESS AND PRINTS UP THE USERNAME OR FIRSTNAME
	if (!empty($email)) {
		echo "<p>welcome back! ".$email. "</p>";
		echo "<p>Where would you like to go:</p>";
		echo "<ul>";
		echo "<li><a href='http://localhost/world/logout.php'>Logout</a></li>";
		echo "<li><a href='http://localhost/world/index.php'>Home</a></li>";
		echo "<li><a href='http://localhost/world/pictures.php'>Pictures</a></li>";
		echo "<li><a href='http://localhost/world/Searchphotographer.php'>Photographers</a></li>";
		echo "</ul>";
	} else if (!empty($username)) {
		echo "<p>welcome back! ".$username. "</p>";
		echo "<p>Where would you like to go:</p>";
		echo "<ul>";
		echo "<li><a href='http://localhost/world/logout.php'>Logout</a></li>";
		echo "<li><a href='http://localhost/world/index.php'>Home</a></li>";
		echo "<li><a href='http://localhost/world/pictures.php'>Pictures</a></li>";
		echo "<li><a href='http://localhost/world/Searchphotographer.php'>Photographers</a></li>";
		echo "</ul>";
	} else {
		echo "<p>Where would you like to go:</p>";
		echo "<ul>";
		echo "<li><a href='http://localhost/world/logout.php'>Logout</a></li>";
		echo "<li><a href='http://localhost/world/index.php'>Home</a></li>";
		echo "<li><a href='http://localhost/world/pictures.php'>Pictures</a></li>";
		echo "<li><a href='http://localhost/world/Searchphotographer.php'>Photographers</a></li>";
		echo "</ul>";
	}

	if (empty($row)=== false){
		if (!isset($_SESSION)) {
			//apply settings to allow the use of global session variables
			session_start();
		}//END (!isset($_SESSION))

			//naming elements in the global array $_SESSION and assigning the contents of variables
			$_SESSION['UserName'] = $username;
			$_SESSION['Email'] = $email;
			$_SESSION['Password'] = $password;

		//redirecting to photographer.php page
		header("Location: http://localhost/world/photographer.php" );
		//echo '<pre>' .print_r($row). '</pre>';    code used during testing
	} else {
		$msg = 'Error please try again';
	}

	}//END (isset($db) === true)

}//END (isset($_POST['login']) && (isset($_POST['Email']) || isset($_POST['UserName']))  && isset($_POST['Password']))

//FUNCTION USED TO SANITIZE THE DATA BEFORE IT IS INSERTED INTO THE DATABASE
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>

<!-- HTML5 Login Form DOCUMENT START -->
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Login | World in Pictures">
		<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login</title>

		<link rel="stylesheet" href="css/style.css">
		<link rel="author" href="humans.txt">
	</head>
<body>
<h1>Enter your details to Login to Worldinpics</h1>

<section><!-- This section displays world region data from the world_pic database -->

<h1>Please log in below to update your details, add photos or make comments on the photographs.</h1>

<form id="login" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<p>
<label for="email">Email:</label>
<input id="email" name="Email" type="email" value="<?php if (isset($_POST['Email'])) echo $Email; ?>">
</p>

<p>
	or
</p>

<p>
<label for="username">Username:</label>
<input id="username" name="UserName" type="text" value="<?php if (isset($_POST['UserName'])) echo $UserName; ?>">
</p>

<p>
<label for="password">Password:</label>
<input id="password" name="Password" type="password" value="<?php if (isset($_POST['Password'])) echo $Password; ?>">
</p>

<p>
<input id="login" name="login" type="submit" value="Login">
</p>

</form>


</section><!-- /END section -->

<p><a href="http://localhost/world/index.php">Home</a></p>
<script src="js/main.js"></script>
</body>
</html>