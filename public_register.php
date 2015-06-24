<?php
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

//DECLARING VARIABLES FOR FORM VALIDATION
$FirstName   = "";
$LastName    = "";
$Email       = "";
$UserName    = "";
$Password    = "";

//DECLARING VARIABLES FOR FORM VALIDATION ERRORS
$EmailErr    = "";
$UserNameErr = "";
$PasswordErr = "";

//CREATED AN ERRORS ARRAY FOR STORING ERRORS TO BE DISPLAYED TOGETHER
$errors = array();

//BASIC FORM VALIDATION
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	//SET TO SAVE DATA FOR STICKY FIELDS INCASE USER INPUTS DATA - EVEN THOUGH FIELDS NOT REQUIRED
	if (!empty($_POST["FirstName"])) {
		$FirstName = test_input($_POST["FirstName"]);
	}

	//SET TO SAVE DATA FOR STICKY FIELDS INCASE USER INPUTS DATA - EVEN THOUGH FIELDS NOT REQUIRED
	if (!empty($_POST["LastName"])) {
		$LastName = test_input($_POST["LastName"]);
	}


	//CHECK TO SEE IF THE EMAIL INPUT BOX IS EMPTY
	if (empty($_POST["Email"])) {
	//ERROR MSG ADVISING INPUT FIELD IS REQUIRED
		$errors['Email'] = "Email is required";
	} else {
	//PASS ON VALUES TO BE STORED IN THE DATABASE
		$Email = test_input($_POST["Email"]);
	}

	//CHECK TO SEE IF THE USERNAME INPUT BOX IS EMPTY
	//IN FUTURE CHECK TO SEE IF USERNAME ALREADY EXISTS
	if (empty($_POST["UserName"])) {
	//ERROR MSG ADVISING INPUT FIELD IS REQUIRED
		$errors['UserName'] = "UserName is required";
	} else {
	//PASS ON VALUES TO BE STORED IN THE DATABASE
		$UserName = test_input($_POST["UserName"]);
	}

	//CHECK TO SEE IF THE PASSWORD INPUT BOX IS EMPTY
	//IN FUTURE HAVE 2 PASSWORD INPUTS TO CONIFM THEY MATCH
	if (empty($_POST["Password"])) {
	//ERROR MSG ADVISING INPUT FIELD IS REQUIRED
		$errors['Password'] = "Password is required";
	} else {
	//PASS ON VALUES TO BE STORED IN THE DATABASE
		$Password = test_input($_POST["Password"]);
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


if (isset($_POST['public-registration']) && empty($errors)) {
	//INITIATE VARIABLE (PRE-SET FOR LATER USE)
	$OK = false;

	//REQUIRE_ONCE INCLUDE CODE USED TO RETRIEVE DATABASE CONNECTION CODE
	include('includes/connection.php');

	//IF DATABASE IS CONNECTED
	if (isset($db) === true) {
	}//END (isset($db) === true)

	//UPDATE THE public_users TABLE WITH THE DATA ENTERED INTO THE FORM
	$sql =
	"INSERT INTO public_users (FirstName, LastName, Email, UserName, Password)
	VALUES(:FirstName, :LastName, :Email, :UserName, :Password)";

	//PREPARE THE STMT FOR INSERTION
	$stmt = $db->prepare($sql);

	//BIND VALUES FROM THE FORM TEXT FIELDS TO THE DEFINED PARAMETERS IN THE $sql STMT
	//DONT FORGET TO USE:
	// PDO::PARAM_STR - WHICH REPRESENTS SQL CHAR/VARCHAR OR STRING DATA TYPE
	// PDO::PARAM_INT - WHICH REPRESENTS SQL INTEGER DATA TYPE
	$stmt->bindParam(':FirstName', $_POST['FirstName'], PDO::PARAM_STR);
	$stmt->bindParam(':LastName', $_POST['LastName'], PDO::PARAM_STR);
	$stmt->bindParam(':Email', $_POST['Email'], PDO::PARAM_STR);
	$stmt->bindParam(':UserName', $_POST['UserName'], PDO::PARAM_STR);
	$stmt->bindParam(':Password', $_POST['Password'], PDO::PARAM_STR);

	//EXECUTE THE STMNT AND RETRIEVE THE NUMBER OF ROWS AFFECTED
	$stmt->execute();
	//IF ROW COUNT HAS CHANGED i.e; INCREASED THEN RE-ROUTE TO ANOTHER PAGE
	//OTHERWISE ADVISE OF SYSTEM ERROR!
	$OK = $stmt->rowCount();

	//REDIRECT IF USER REGISTRATION SUCCESSFUL - & B/C THERE IS NO ID PASSED IN URL WHEN SEND TO header('Location: picture.php?id='.$id); THE USER IS REDIRECTED TO index.php
	//OR DISPLAY A SYSTEM ERROR IF NOT
	if ($OK) {
		header('Location: picture.php?id='.$id);
		exit;
	} else {
		$error = $stmt->errorInfo();
			if (isset($error[2])) {
			$errorMsg = $error[2];
			}//END (isset($error[2]))
		}// END ELSE



}//END (isset($_POST['public-registration']))

//FUNCTION USED TO SANITIZE THE DATA BEFORE IT IS INSERTED INTO THE DATABASE
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

 ?>

<!-- HTML5 public_users Registration Form DOCUMENT START -->
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Regions | World in Pictures">
		<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Home</title>

		<link rel="stylesheet" href="css/style.css">
		<link rel="author" href="humans.txt">
	</head>
<body>
<h1>Welcome to Member Registration Screen</h1>

<section><!-- This section displays world region data from the world_pic database -->

<h1>If you want to become a member of this World in Pictures Website, please Register your details below:</h1>

<form id="public-registration" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<p>
<label for="firstname">First Name: </label>
<input id="firstname" name="FirstName" type="text" value="<?php if (isset($_POST['FirstName'])) echo $FirstName; ?>">
</p>

<p>
<label for="lastname">Last Name: </label>
<input id="lastname" name="LastName" type="text" value="<?php if (isset($_POST['LastName'])) echo $LastName; ?>">
</p>

<p>
<label for="email">Email:</label>
<input id="email" name="Email" type="email" value="<?php if (isset($_POST['Email'])) echo $Email; ?>"><span class="error" style='color: red;'>* <?php echo $EmailErr;?></span>
</p>

<p>
<label for="username">Username:</label>
<input id="username" name="UserName" type="text" value="<?php if (isset($_POST['UserName'])) echo $UserName; ?>"><span class="error" style='color: red;'>* <?php echo $UserNameErr;?></span>
</p>

<p>
<label for="password">Password:</label>
<input id="password" name="Password" type="password" value="<?php if (isset($_POST['Password'])) echo $Password; ?>"><span class="error" style='color: red;'>* <?php echo $PasswordErr;?></span>
</p>

<p>
<input id="public-registration" name="public-registration" type="submit" value="Register">
</p>

</form>


</section><!-- /END section -->


<script src="js/main.js"></script>
</body>
</html>