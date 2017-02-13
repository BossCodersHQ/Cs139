<?php
	require("database.php");
	$db = new Database();
	$sql = "UPDATE listItem SET completion = strftime('%s','now') WHERE  itemID = {$_POST['id']};";
	echo $sql;
	$db->exec($sql);
?>