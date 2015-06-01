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

		//PREPARE THE SQL Query to SELECT WorldRegionID
		$sqlCountry = 'SELECT CountryCode, CommonName
					   FROM country
					   WHERE country.WorldRegionID = :WorldRegionID';

		//PREPARE METHOD DOES NOT ACTUALLY EXECUTE Query but CHECK QUery for PROLEMS
		$queryCountry = $db->prepare($sqlCountry);

		//BINDING INPUT INTO PARAMETER IN "WHERE" STATEMENT 
		$queryCountry->bindvalue(':WorldRegionID', $id, PDO::PARAM_STR
			);

		//PDO METHOD EXECUTES Query STATEMENT that has been PREPEARED 
		$queryCountry->execute();

		//STORES HOW MANY ROWS have been FOUND
		$numRowsCountry = $queryCountry->rowCount();

		//fetchAll() will RETURN ALL of the ARRAY STORING the OUTPUT from the SQL Query
		$countries = $queryCountry->fetch(PDO::FETCH_ASSOC);

		print_r($countries);
}

?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Countries | World in Pictures">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Countries in Pictures</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
        <h1>Welcome to Countries in Pictures</h1>

		<section>
			
			<?php 

			if ($numRowsCountry > 0) {
				echo '<b><a href="locations.php?id=3">Melbourne</a></b>';
			} else {
				echo 'No records found!';
			}


			?>



        <script src="js/main.js"></script>
    </body>
</html>