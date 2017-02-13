<?php
	session_start();
	require('database.php');
    $db = new Database();
	$stmt = $db->prepare("INSERT INTO listItem VALUES(NULL,:id,strftime('%s','now'),NULL,:label,:itemText);");
	echo $_POST['itemText'];
    $stmt->bindValue(':id',$_POST['id'], SQLITE3_TEXT);
	$stmt->bindValue(':label',$_POST['label'], SQLITE3_TEXT);
	$stmt->bindValue(':itemText',$_POST['itemText'],SQLITE3_TEXT);
	$result = $stmt->execute();
?>