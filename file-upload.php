<?php



?>


<!-- HTML5 DOCUMENT START -->
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Photo Upload | World in Pictures">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Photo Upload</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
        <h1>Welcome to World in Pictures Photo Upload Page:</h1>
        <h2>Add you new photos to the website below:</h2>

		<section>
		<!--
			<p><a href="http://localhost/world/login.php">Login</a></p>
			<p><a href="http://localhost/world/logoutFrom_Index.php">Logout</a></p>
			<p><a href="http://localhost/world/public_register.php">Public Register</a></p>
			<p><a href="http://localhost/world/photographer_register.php">Photographer Register</a></p>
		-->
		</section>

		<section><!-- This section displays world region data from the world_pic database -->
		<form action="" method="POST" enctype="multipart/form-data">

			<p>Search for Photo before inserting details:</p>

			<p>
				<label for="image">Image</label>
				<input id="image" name="image" type="file">
			</p>

			<p>
				<input id="file-upload" name="file-upload" type="submit" value="Upload File">
			</p>

		</form>


		</section><!-- /END section -->

        <script src="js/main.js"></script>
    </body>
</html>
<!-- HTML5 DOCUMENT END -->