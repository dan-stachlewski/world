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


