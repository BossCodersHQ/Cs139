<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
	session_start();
	$htmlResponse = "<table>";
	require('database.php');
    $db = new Database();
	$stmt = $db->prepare("SELECT list.listID,list.title,list.creation,list.completion from list JOIN userList ON userList.listID = list.listID WHERE userList.userID = :userID;");
	$stmt->bindValue(':userID',$_SESSION["UserID"]);
	$result = $stmt->execute();

	while($row = $result->fetchArray(SQLITE3_ASSOC)) {
		if(!$row["completion"]) {
			$completed = "<td class='listStatus incomplete'></td>";
			$isCompleted = "incomplete";
		}else {
			$completed = "<td class='listStatus complete'></td>";
			$isCompleted = "complete";			
		}
		$htmlResponse .= "<tr><td><div class='listTitle ".$isCompleted."'><div id=list_".$row["listID"]."><h2>".$row["title"]."</h2></div></div></td><td class='remove' id='".$row["listID"]."'>remove</div></tr>";
	}
	echo $htmlResponse."</table>";

?>