<?php

//START A SESSION TO STORE USER LOGIN CREDENTIALS
session_start();

echo "<pre>";
echo "SESSION ";
print_r($_SESSION);
echo "</pre>";

//REQUIRE_ONCE INCLUDE CODE USED TO RETRIEVE DATABASE CONNECTION CODE
require_once('includes/connection.php');

//CHECK DATABASE CONNECTION OPEN
if (isset($db) === true) {

	//SELECTING TABLE worldregion
	//SELECTING ALL(*) DATA FROM TABLE
	//ORDER DATA BY WorldRegionName
	//ASSIGN DATA TO VARIABLE $sql
	$sql = 'SELECT *
			FROM worldregion
			ORDER BY  WorldRegionName';

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

		<section>
			<p><a href="http://localhost/world/login.php">Login</a></p>
			<p><a href="http://localhost/world/logoutFrom_Index.php">Logout</a></p>
			<p><a href="http://localhost/world/public_register.php">Public Register</a></p>
			<p><a href="http://localhost/world/photographer_register.php">Photographer Register</a></p>
		</section>

		<section><!-- This section displays world region data from the world_pic database -->

<?php

	//USING DATABASE CONNECTION
	//QUERYING DATABASE
	//SELECTING ALL DATA FROM ABOVE INSTRUCTIONS
	//ASSIGNING QUERY TO VARIABLE $query
	$query = $db->query($sql);

	//USING WHILE LOOP TO PRINT RESULTS OF QUERY
	//DATA RETRIEVED USING PDO:: FETCH_ASSOC - [ RETURNS ARRAY INDEXED BY COL NAME AS RETURNED IN RESULTS SET ]
	//EACH RESULT PRINTED TO SCREEN AS A DYNAMIC LINK ASSOCIATED TO DATA ON countries.php?id='[WorldRegionID&Name]'
	while ($row = $query->fetch(PDO::FETCH_ASSOC)){
		echo '<a href="countries.php?id='
		.$row['WorldRegionID']. '">'
		.$row['WorldRegionName']. '</a><br/>';

	} //END while function

} //END isset($db) function

?>

		</section><!-- /END section -->

        <script src="js/main.js"></script>
    </body>
</html>
<!-- HTML5 DOCUMENT END -->