<?php 

//include the code that connects to the database and creates a $db connection object
require_once('includes/db-connect.php');

if (isset($db) === true) {

	//prepare SQL query to SELECT WorldRegion
	$sqlWorldRegion = 'SELECT WorldRegionID, WorldRegionName
					   FROM worldregion';

	//PREPARE MEHOD does not EXECUTE Query but checks Query for PROBLEMS
	$queryWorldRegion = $db->prepare($sqlWorldRegion);
	
	//PDO METHOD Executes the Query Stmnt that has been PREPARED - STORES OUTPUT in array
	$queryWorldRegion->execute();

	//PDO METHOD Stors HOW MANY rows have been RETURENED
	$numRowsWorldRegion = $queryWorldRegion->rowCount();

	//FETCH ALL METHOD will RETURN ALL of the array STORED in the OUTPUT from the SQL Query
	$worldRegions = $queryWorldRegion->fetch(PDO::FETCH_ASSOC);

	print_r($worldRegions);

}


?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="World in Pictures">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
        <h1>Welcome to World in Pictures</h1>

		<section><!-- This section displays world region data from the world_pic database -->
			
			<?php 

			if ($numRowsWorldRegion > 0) {
				echo '<b><a href="locations.php?id=3">Australia</a></b><br/>';
			} else {
				echo 'No records found!';
			}


			?>

		</section><!-- /END section -->


        <script src="js/main.js"></script>
    </body>
</html>