<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>cs139</title>
<link rel="stylesheet" type="text/css" href="css/Todo.css?1.1" />
<script src="Jquery/jquery-3.1.1.js"></script>
<script src="scripts/general.js"></script>
</head>
<body>

<div class="heading">
<h1>Page With To Do Lists</h1>
</div>

<br>
<ul class ="menubar">
    <div class="menubox">
    <li class="menubar"><a href="scripts/logout.php">Logout <?php echo $_SESSION['Firstname'] ?></a></li>
    </div>
</ul>

<br>
<div id ="left" class="bar">
<div class="lists">
  <div class="listbutton" id="addList"><h2>Add new List</h2></div>
  <input type="text" id="addListName" placeholder="list name (20 chars)" style="display:none; width:80%;">
  <div id="listOfLists"></div>
</div>
</div>

<div id ="middle" class="bar" style="background-color:rgba(60, 60, 60, 0.6);color:black">
<div class="itemBlock" id="listTitle">
	<div id="addListItem"><h2>Add a new List Item</h2></div>
	<div id="listItemForm">
	<label>Name</label><div class="inputHolder"><input type="text" placeholder="Item name (20 chars)"></div>
	<label>Write The todo text here:</label><div class="inputHolder"><textarea name="itemText" placeholder="Item text"cols="40" rows="5"></textarea></div>
	</div>

</div>
</div>


</body>
</html>