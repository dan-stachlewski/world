<?php

//REQUIRE_ONCE INCLUDE CODE USED TO RETRIEVE DATABASE CONNECTION CODE
require_once('includes/connection.php');

//CHECK DATABASE CONNECTION OPEN
if (isset($db) === true) {

	//IF !TRUE REDIRECT USER TO ERROR PAGE USING REDIRECTION HEADER
}

//IF ID IN URL EXISTS if(!empty($_GET['id']))
//USE VARIABLE HANDLING FUNCTION INTVAL [ RETURNS AN INTEGER VALUE OF A VARIABLE ]
//USE INTEGER VERSION OF ID TO RETRIEVE THE ASSOCIATED DATA FROM THE location TABLE
//SELECTING TABLE location
//SELECTING LocationName, LocationID DATA FROM TABLE
//WHERE CountryCode IS PASSED FROM TO COUNTRIES PAGE TO LOCATIONS PAGE VIA URL, COVERTED TO INTEGER FOR USE
//ASSIGN DATA TO VARIABLE $sql
//IF EMPTY ID REDIRECT USER TO INDEX PAGE
if(!empty($_GET['id'])){
	$id = ($_GET['id']); //REMOVE INTVAL HERE OTHERWISE AU CONVERTED TO INTEGER
    $sql = "SELECT `LocationName`, `LocationID`
            FROM `location`
            WHERE `CountryCode`='".$id."'";
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
	//EACH RESULT PRINTED TO SCREEN AS A DYNAMIC LINK ASSOCIATED TO DATA ON pictures.php?id='[LocationName]'
	while ($row = $query->fetch(PDO::FETCH_ASSOC)){
		echo '<a href="pictures.php?id='
		.$row['LocationID']. '">'
		.$row['LocationName']. '</a><br/>';

	} //END while function



?>

		</section><!-- /END section -->


        <script src="js/main.js"></script>
    </body>
</html>