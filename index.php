<?php 

//include the code that connects to the database and creates a $db connection object
require_once('includes/db-connect.php');


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

			if ($numRowsCountry > 0) {
				echo '<b><a href="Locations.php?id=AU>"Australia</a></b><br/>';
			} else {
				echo 'No records found!';
			}


			?>

		</section><!-- /END section -->


        <script src="js/main.js"></script>
    </body>
</html>