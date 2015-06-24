	<?php 

	//PREPARE MEHOD does not EXECUTE Query but checks Query for PROBLEMS
	$queryWorldRegion = $db->prepare($sql);
	
	//PDO METHOD Executes the Query Stmnt that has been PREPARED - STORES OUTPUT in array
	$queryWorldRegion->execute();

	//PDO METHOD Stors HOW MANY rows have been RETURENED
	$numRowsWorldRegion = $queryWorldRegion->rowCount();

	//FETCH ALL METHOD will RETURN ALL of the array STORED in the OUTPUT from the SQL Query
	$worldRegions = $queryWorldRegion->fetch(PDO::FETCH_ASSOC);

	print_r($query);




		//CHECK TO SEE IF THE EMAIL INPUT BOX IS EMPTY
	if (empty($_POST["Email"])) {
	//ERROR MSG ADVISING INPUT FIELD IS REQUIRED
		$errors['Email'] = "Email is required";
	} else {
	//PASS ON VALUES TO BE STORED IN THE DATABASE
		$Email = test_input($_POST["Email"]);
	}





	//CHECK TO SEE IF THE USERNAME INPUT BOX IS EMPTY
	//IN FUTURE CHECK TO SEE IF USERNAME ALREADY EXISTS
	if (empty($_POST["UserName"])) {
	//ERROR MSG ADVISING INPUT FIELD IS REQUIRED
		$errors['UserName'] = "UserName is required";
	} else {
	//PASS ON VALUES TO BE STORED IN THE DATABASE
		$UserName = test_input($_POST["UserName"]);
	}

	//CHECK TO SEE IF THE PASSWORD INPUT BOX IS EMPTY
	//IN FUTURE HAVE 2 PASSWORD INPUTS TO CONIFM THEY MATCH
	if (empty($_POST["Password"])) {
	//ERROR MSG ADVISING INPUT FIELD IS REQUIRED
		$errors['Password'] = "Password is required";
	} else {
	//PASS ON VALUES TO BE STORED IN THE DATABASE
		$Password = test_input($_POST["Password"]);
	}


