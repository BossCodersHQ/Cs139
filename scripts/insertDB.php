<?php 
	$insertName = $_POST['name'];
	require('database.php');
    $db = new Database();
	$stmt = $db->prepare("INSERT INTO list VALUES(NULL,:name,strftime('%s','now'),NULL);");
	$stmt->bindValue(':name',$insertName, SQLITE3_TEXT);
	$result = $stmt->execute();
?> 
