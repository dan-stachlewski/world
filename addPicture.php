<?php

// SET $msg VARIABLE TO EMPTY
$msg = '';

//CHECK TO SEE IF USER HAS:
//	- BEEN HERE BEFORE
//	- LOGGED IN
//IF NO - START A SESSION
//IF YES - RE-ACQUIRE USE OF SESSION VARIABLES
if (!isset($_SESSION)) {
	session_start();

	//CODE USED TO DISPLAY SESSION ARRAY CONTENTS
	//HANDY - BUT REMOVE AT RUNTIME
	print_r($_SESSION);

}//END (!isset($_SESSION))

//CHECK TO SEE IF USER HAS:
//	- LOGGED IN
//IF NO - RE-DIRECT TO INDEX
//USE VARIABLE HANDLING FUNCTION INTVAL [ RETURNS AN INTEGER VALUE OF A VARIABLE ]
if (!isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['id']) {
	header("Location: login.php" );
	exit;
} else {
	$id = intval($_GET['id']);

	//REQUIRE_ONCE INCLUDE CODE USED TO RETRIEVE DATABASE CONNECTION CODE
	require_once('includes/connection.php');

if (isset($db) === true) {
// image load local
if(isset($_FILES['image'])){
    $errors=array();
    $allowed_ext=array('jpg','jpeg','png','gif');
     $file_name=$_FILES['image']['name'];
     $file_array = explode('.',$file_name);
     $file_ext=strtolower(end($file_array));
     $file_size=$_FILES['image']['size'];
     $file_tmp=$_FILES['image']['tmp_name'];
     if(in_array($file_ext,$allowed_ext) === false){
	 $errors[]='Extention not allowed';
      }
     if($file_size> 2097152){
	 $errors[]='File size must be under 2 MB';
     }
     if(empty($errors)){
      move_uploaded_file($file_tmp,'photos/'.$id.'_'.$file_name);
//upload into server*******************************     could use header redirection to error page
     }
}






?>