<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
	session_start();
	require("database.php");
	$db = new Database();
	$sql = "SELECT listItem.itemID,listItem.creation,listItem.completion,listItem.itemText from listItem JOIN list ON list.listID = listItem.listID WHERE list.listID = {$_POST['id']} ORDER BY listItem.completion DESC;";

 // echo $sql;
	$sql2 = "SELECT * FROM list where List.listID = {$_POST['id']};";
    $result = $db->query($sql);
    $result2 = $db->query($sql2);

  $resultArray["list"] = $result2->fetchArray(SQLITE3_ASSOC);
   
 $i = 0;   
	while($row = $result->fetchArray(SQLITE3_ASSOC)) {
		$resultArray["listItem"][$i] = $row;
		//	echo print_r($row);
		$i++; 
	}
 // var_dump($resultArray);
   echo json_encode($resultArray,JSON_NUMERIC_CHECK);

?>