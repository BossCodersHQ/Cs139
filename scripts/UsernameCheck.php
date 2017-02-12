<?php
//VARIABLES
/*
         $newuser STRING - used to store the posted username that has been entered by the client
         $error STRING - holds the text that will be outputted to the username as an error message

*/
require('database.php');

$db = new Database();
$newuser = $_POST['newuser'];

$stmt = $db->prepare("select * FROM user WHERE ( username = :newuser OR email = :newuser )");
$stmt->bindParam(':newuser',$newuser);
$result = $stmt->execute();

//checks if there is atleast one result with the username chosen in the database and outputs an error

if ($result->fetchArray())  {
	echo 0;
	$error.= "this username is taken";
} else {
	echo 1;
} 
?>