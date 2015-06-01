<?php 

//This is where I set up the database connection to world_pic database

$config = array (
				'host'     => 'localhost',
				'dbname'   => 'world_pic',
				'user'     => 'root',
				'password' => 'password'
				);

//connect to MySQL using:
// - PDO:
// - try {} catch() {}

try {
	$db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'], $config['user'], $config['pwd']);
} catch(PDOException $e) {
	echo 'Cannot connect to database';
}





