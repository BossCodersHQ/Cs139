<?php

   require('database.php');
   $db = new Database();
   $id=$_POST['id'];
   $db = new Database();
   echo $db->exec("DELETE FROM list WHERE listID = ${id};DELETE FROM userList WHERE listID = ${id};");
    ?>