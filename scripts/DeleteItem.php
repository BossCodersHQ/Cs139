<?php
	require("database.php");
	$db = new Database();
	$db->exec("DELETE from listItem WHERE  itemID = {$_POST['id']};");
?>