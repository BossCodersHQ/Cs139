<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>cs139</title>
<link rel="stylesheet" type="text/css" href="css/Todo.css" />
<link rel="stylesheet" type="text/css" href="css/Animations.css" />
<script src="Jquery/jquery-3.1.1.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("body").css("display", "none");
 
    $("a.transition").click(function(event){
        event.preventDefault();
        linkLocation = this.href;
        $("body").fadeOut(1000, redirectPage);      
    });
         
    function redirectPage() {
        window.location = linkLocation;
    }
});
</script>


</head>
<body>


<a href="./index.php"><img alt="logo" id="logo" src="img/Logo2.png"/></a>
<br>

<div class="heading">
<h1>--ToDo list--</h1>
</div>

<br><br>
<p class="button" onclick="myFunction()">Sign in</p>
<p class="button" onclick="myFunction2()">Sign up</p>

<div id="signin" class="content" >
<form action="Lists.php">
    <label>Username:</label>
    <input type="text"><br><br>
    <label>Password:</label>
    <input type="password" name="user_password"> <br><br>
    <input type="submit" value="Log in">
</form>
<br>
<p>If you've forgotten your password click <a style="text-decoration:underline" href="fgtpassword.php">here</a></p>
</div>    

<div id="signup" class="content">
<form action="index.php">
<label>Gender: </label>
<select name=‘Gender’>
    <option value=‘Male’>Male</option>
    <option value=’Female’>Female</option>
    <option value=‘Other’>Other</option>
</select><br><br>

<label>Firstname: </label>
<input type="text" name="Firstname"><br><br>
<label>Surname: </label>
<input type="text" name="Surname"> <br><br>
<label>Email Address: </label>
<input type="text" name="Email"> <br><br>
<label>Username: </label>
<input type="text" name="Username"> <br><br>
<label>Password: </label>
<input type="password" name="Password"> <br><br>
<label>Re-enter password: </label>
<input type="password" name="Password"> <br><br>

<input type="submit" value="Enter">
</form>
</div>
    
<div class="footer"></div>

<script>
function myFunction() {
   var x = document.getElementById("signin");
   var y = document.getElementById("signup");
   if (x.style.display == "block"){ 
      x.style.display = "none";
   }else {
      y.style.display = "none";
      x.style.display = "block";
   }
}

function myFunction2() {
   var x = document.getElementById("signin");
   var y = document.getElementById("signup");
   if (y.style.display == "block"){
      y.style.display = "none";
   }else{
      x.style.display = "none";
      y.style.display = "block";
   }
}


</script>


<script type="text/javascript">
    $(document).ready(function() {
        $("body").css("display", "none");
    });
</script>


</body>
</html>