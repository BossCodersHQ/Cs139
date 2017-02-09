<?php 
	include("scripts/loadlists.php");
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
    <li class="menubar"><a href="Friends.html">Friends</a></li>
    </div>
</ul>

<br>
<div id ="left" class="bar">
<div class="lists">
  <div class="listbutton" id="addList"><h2>Add new List</h2></div>
  <input type="text" id="addListName" style="display:none; width:80%;">
</div>
</div>
<div id ="middle" class="bar" style="background-color:white;color:black">ssdgdsgdsg
</div>
<div id ="right" class="bar" style="background-color:green;color:black">ssdgdsgdsgsd
</div>

</body>
</html>