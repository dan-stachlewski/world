<?php

//IF THERE IS NO ID DEFINED IN THE URL
//REDIRECT TO INDEX [ ./ means return to index.php in the current directory (worldinpics) ]
//IF ID IN URL EXISTS if(!empty($_GET['id']))
//USE VARIABLE HANDLING FUNCTION INTVAL [ RETURNS AN INTEGER VALUE OF A VARIABLE ]
if(empty($_GET['id'])){
	header("Location: ./index.php");
} else {
	$id = intval($_GET['id']);

//IF POST BUTTON HAS BEEN PRESSED
if (isset($_POST['insert'])) {

		// initialize flag
		//Each time the desired object is summoned, the flag is tested
		//If it is ready, it is returned
		//If not, it is initialized on the spot
		$OK = false;
		include('includes/connection.php');

	if (isset($db) === true) {
		//IF !TRUE REDIRECT USER TO ERROR PAGE USING REDIRECTION HEADER
	}//END (isset($db) === true)


		//USE INTEGER VERSION OF ID TO ADD THE ASSOCIATED DATA ENTERD BY USER INTO public_comment TABLE
		//SELECTING TABLE public_comment
		//INSERTING Comment, CommentBy, PictureID DATA FROM USER FORM VIA THE NAMED PARAMETERS
		$sql =
			"INSERT INTO public_comment (Comment, CommentBy, PictureID)
			 VALUES(:comment, :commentBy, :pictureID)";

		//PREPARE THE STMT FOR INSERTION
		$stmt = $db->prepare($sql);

		//BIND VALUES FROM THE FORM TEXT FIELDS TO THE DEFINED PARAMETERS IN THE $sql STMT
		//DONT FORGET TO USE:
		// PDO::PARAM_STR - WHICH REPRESENTS SQL CHAR/VARCHAR OR STRING DATA TYPE
		// PDO::PARAM_INT - WHICH REPRESENTS SQL INTEGER DATA TYPE
		$stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
		$stmt->bindParam(':commentBy', $_POST['username-author'], PDO::PARAM_STR);
		$stmt->bindParam(':pictureID', $_POST['PictureID']);

		//EXECUTE THE STMNT AND RETRIEVE THE NUMBER OF ROWS AFFECTED
		$stmt->execute();
		$OK = $stmt->rowCount();

		//REDIRECT IF SUCCESSFUL OR DISPLAY AN ERROR IF NOT
		if ($OK) {
			header('Location: ./picture.php?id='.$id);
			exit;
		} else {
			$error = $stmt->errorInfo();
				if (isset($error[2])) {
				$errorMsg = $error[2];
				}//END (isset($error[2]))
			}// END ELSE

	}//END (isset($_POST['insert']))
			if (isset($errorMsg)) {
			echo "<p>Error: $errorMsg</p>";
		}//END (isset($errorMsg))
}//(empty($_GET['id']))

 ?>

 <!-- HTML5 DOCUMENT START -->
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
        <h1>Welcome to World in Pictures</h1>

		<section><!-- This section displays world region data from the world_pic database -->

		<h1>Please give us your opinion or thoughts about the photogrpah that you are looking at.</h1>

		<form id="add-comment" method="POST" action="">

			<p>
				<label for="comment">Comment: *</label>
				<input id="comment" name="comment" type="text">
			</p>

			<p>
				<label for="username-author">Username/Author: *</label>
				<input id="username-author" name="username-author" type="text">
			</p>

			<p>
				<label for="PictureID">Picture ID:</label>
				<!-- WE DONT WANT THE ID TO BE EDITABLE BY THE USER - USE THE readonly ATTRIBUTE (BOOLEAN ATTRIBUTE - WHEN PRESENT OR TRUE IT SPECIFIES THE INPUT FIELD IS 'READONLY') FOR TEXTBOX -->
				<input id="PictureID" name="PictureID" type="text" value="<?php echo $id; ?>" readonly>
			</p>

			<p>
				<input id="insert" name="insert" type="submit" value="Insert Comment">
			</p>

		</form>


		</section><!-- /END section -->


        <script src="js/main.js"></script>
    </body>
</html>