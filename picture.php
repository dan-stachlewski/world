<?php

//REQUIRE_ONCE INCLUDE CODE USED TO RETRIEVE DATABASE CONNECTION CODE
require_once('includes/connection.php');

//CHECK DATABASE CONNECTION OPEN
if (isset($db) === true) {

	//IF !TRUE REDIRECT USER TO ERROR PAGE USING REDIRECTION HEADER
}

//IF ID IN URL EXISTS if(!empty($_GET['id']))
//USE VARIABLE HANDLING FUNCTION INTVAL [ RETURNS AN INTEGER VALUE OF A VARIABLE ]
//USE INTEGER VERSION OF ID TO RETRIEVE THE ASSOCIATED DATA FROM THE picture TABLE
//SELECTING TABLE picture
//SELECTING PictureID, PhotoName, Comment DATA FROM TABLE
//WHERE PictureID IS PASSED FROM PICTURES PAGE TO PICTURE PAGE VIA URL, COVERTED TO INTEGER FOR USE
//ASSIGN DATA TO VARIABLE $sql
//IF EMPTY ID REDIRECT USER TO INDEX PAGE
if(!empty($_GET['id'])){
	$id = intval($_GET['id']);

	//DATA COLLECTION FOR PICTURE DISPLAY
    $sql =
    	"SELECT `PictureID`, `PhotoName`, `Comment`
         FROM `picture`
         WHERE `PictureID`='".$id."'";

	//DATA COLLECTION FOR COMMENT DISPLAY
    $sqlPubComm =
    	"SELECT `Comment`, `CommentBy`
    	 FROM `public_comment`
    	 WHERE `PictureID` ='".$id."'";

	//DATA COLLECTION FOR PHOTOGRAPHER DISPLAY
    $sqlPhotographer =
    	// "SELECT `FirstName`, `LastName`
    	//  FROM `photographer`, `picture`
    	//  WHERE `Picture.ID` = `photographer.ID`
    	//  AND `PictureID` ='".$id."'";

    	 "SELECT `FirstName`, `LastName`
    	 FROM photographer
    	 JOIN picture ON (picture.ID = photographer.ID)
    	 WHERE `PictureID` ='".$id."'"; //IAN I ADDED THE ID INSTEAD OF THE NUMBER 1 AND IT WORKS DINAMICALLY NOW CHEERS!
	} else {
		header("Location: http://localhost/worldinpic/index.php");
	exit();
}


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

<?php

	//USING DATABASE CONNECTION
	//QUERYING DATABASE
	//SELECTING ALL DATA FROM ABOVE INSTRUCTIONS
	//ASSIGNING QUERY TO VARIABLE $query
	$query = $db->query($sql);

	//USING WHILE LOOP TO PRINT RESULTS OF QUERY
	//DATA RETRIEVED USING PDO:: FETCH_ASSOC - [ RETURNS ARRAY INDEXED BY COL NAME AS RETURNED IN RESULTS SET ]
	while ($row = $query->fetch(PDO::FETCH_ASSOC)){

?>

<!--

CREATE HTML5 TABLE TO DISPLAY
	- PHOTOGRAPH NAME
	- PHOTOGRAPH
	- DETAILS PROVIDED BY PHOTOGRAPHERS
	- COMMENTS
	- LINK TO - ADD NEW COMMENTS
-->

<table border="1" position="center">
	<tr>
		<th>
			<h3>
				Photograph Name: <?php echo $row['PhotoName']; ?>
			</h3>
		</th>
	</tr>
	<tr>
		<img src="photos/<?php echo $row['PhotoName']; ?>">
	</tr>
	<tr>
		<td>

<?php

	$query = $db->query($sqlPhotographer);

	while ($row = $query->fetch(PDO::FETCH_ASSOC)){

 ?>

			<em>Details provided by phototgrapher</em>
			<?php echo $row['FirstName'].' ' .$row['LastName'];  } ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $row['Comment']; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo '<a href="addComment_GET.php?id=' .$id. '">Add Comments</a>' ?>

		</td>
	</tr>

<?php
}
/****************************************
  requires query to identify related comments in the public_comment table and a loop to diplay all comments about this picture
********************************************/
	$query = $db->query($sqlPubComm);
	while ($row = $query->fetch(PDO::FETCH_ASSOC)){

	echo '<tr><td>'.$row['CommentBy'].'<br/>';
	echo $row['Comment'].'<br/></td></tr>';
} //END while function

?>

</table>

		</section><!-- /END section -->


        <script src="js/main.js"></script>
    </body>
</html>