<?php 

//INCLUDES Code that CONNECTS TO DATABASE and creates $db CONNECTION OBJECT
require_once('includes/db-connect.php');
if (isset($db) === true) {

	//Could USE HEADER to REDIRECT to ERROR PAGE
	//CHECKING URL PARAMETER has been PASSED to $_GET GLOBAL ARRAY VAR
	if (isset($_GET['id'])) {
		//ASSIGNS CONTENTS of ARRAY to the VARIABLE
		$id = $_GET['id'];
	} else {
		header("Location: index.php");
		//NO URL PARAMETER PASSED RETURNT to index.php page
		exit;
	}

		//PREPARE THE SQL Query to SELECT CountryCode
		$sqlLocation = 'SELECT LocationName, LocationID
					   FROM location
					   WHERE location.CountryCode = :CountryCode';

		//PREPARE METHOD DOES NOT ACTUALLY EXECUTE Query but CHECK QUery for PROLEMS
		$queryLocation = $db->prepare($sqlLocation);

		//BINDING INPUT INTO PARAMETER IN "WHERE" STATEMENT 
		$queryLocation->bindvalue(':CountryCode', $id, PDO::PARAM_STR
			);

		//PDO METHOD EXECUTES Query STATEMENT that has been PREPEARED 
		$queryLocation->execute();

		//STORES HOW MANY ROWS have been FOUND
		$numRowsLocation = $queryLocation->rowCount();

		//fetchAll() will RETURN ALL of teh ARRAY STORING the OUTPUT from the SQL Query
		$locations = $queryLocation->fetch(PDO::FETCH_ASSOC);

		print_r($numRowsLocation);
}

?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Locations | World in Pictures">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Countries in Pictures</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
        <h1>Welcome to Locations in Pictures</h1>

		<section>
			
			<?php 

			if ($numRowsLocation > 0) {
				echo '<b><a href="photographers.php?id=706">Melbourne</a></b>';
			} else {
				echo 'No records found!';
			}


			?>


		</section>
		<?php 




		?>


        <script src="js/main.js"></script>
    </body>
</html>