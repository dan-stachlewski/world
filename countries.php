<?php

//REQUIRE_ONCE INCLUDE CODE USED TO RETRIEVE DATABASE CONNECTION CODE
require_once('includes/connection.php');

//CHECK DATABASE CONNECTION OPEN
if (isset($db) === true) {

	//IF !TRUE REDIRECT USER TO ERROR PAGE USING REDIRECTION HEADER
}

//IF ID IN URL EXISTS if(!empty($_GET['id']))
//USE VARIABLE HANDLING FUNCTION INTVAL [ RETURNS AN INTEGER VALUE OF A VARIABLE ]
//USE INTEGER VERSION OF ID TO RETRIEVE THE ASSOCIATED DATA FROM THE country TABLE
//SELECTING TABLE country
//SELECTING CommonName, CountryCode DATA FROM TABLE
//WHERE WorldRegionID IS PASSED FROM COUNTRIES PAGE TO LOCATIONS PAGE VIA URL, COVERTED TO INTEGER FOR USE
//ASSIGN DATA TO VARIABLE $sql
//IF EMPTY ID REDIRECT USER TO INDEX PAGE
if(!empty($_GET['id'])){
	$id = intval($_GET['id']);
    $sql = "SELECT `CommonName`, `CountryCode`
            FROM `country`
            WHERE `WorldRegionID`='".$id."'";
	} else {
		header("Location: http://localhost/world/index.php");
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
	//EACH RESULT PRINTED TO SCREEN AS A DYNAMIC LINK ASSOCIATED TO DATA ON locations.php?id='[CommonName]'
	while ($row = $query->fetch(PDO::FETCH_ASSOC)){
		echo '<a href="locations.php?id='
		.$row['CountryCode']. '">'
		.$row['CommonName']. '</a><br/>';

	} //END while function



?>

		</section><!-- /END section -->


        <script src="js/main.js"></script>
    </body>
</html>