<?php
	session_start();
	require('database.php');
    $db = new Database();
	$stmt = $db->prepare("SELECT list.listID,list.title,list.creation,list.completion from list JOIN userList ON userList.listID = list.listID WHERE userList.userID = 1;");
	//$stmt->bindValue(':name',$insertName, SQLITE3_TEXT);
	$result = $stmt->execute();
?>