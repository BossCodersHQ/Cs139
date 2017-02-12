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
<link rel="stylesheet" type="text/css" href="css/Todo.css" />
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
    <li class="menubar"><a href="index.html">Home</a></li>
    <li class="menubar" style="background-color: rgba(20, 20, 20, 0.8);"><a href="">Lists</a></li>
    <li class="menubar"><a href="scripts/logout.php">Logout <?php echo $_SESSION['Firstname'] ?></a></li>
    </div>
</ul>

<br>
<div id ="left" class="bar">
<div class="lists">
  <div class="listbutton" id="addList"><h2>Add new List</h2></div>
  <input type="text" id="addListName" style="display:none; width:80%;">
  <div id="listOfLists"></div>
</div>
</div>
<div id ="middle" class="bar" style="background-color:rgba(60, 60, 60, 0.6);color:black">ssdgdsgdsg
</div>


</body>
</html>