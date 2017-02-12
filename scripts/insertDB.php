<?php 
    ini_set("display_errors", 1);
error_reporting(E_ALL);
	session_start();
	$insertName = $_POST['name'];
	require('database.php');
    $db = new Database();
	$stmt = $db->prepare("INSERT INTO list VALUES(NULL,:name,strftime('%s','now'),NULL);");
	$stmt->bindValue(':name',$insertName, SQLITE3_TEXT);
	$result = $stmt->execute();
	$listID = $db->lastInsertRowID();
	$db->exec("INSERT INTO userList VALUES(".$_SESSION["UserID"].",".$listID.",1)");
?> 
