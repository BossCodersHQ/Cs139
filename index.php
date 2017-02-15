<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
?>
<?php
session_start();
if($_SESSION["loggedIn"]){
  header("Location: Lists.php");
}
$showSignIn = '';
$error = '';
$accept = true;
//sets the posted values into these variables, while removing whitespace before and after the text
if (isset($_POST['Register'])) {
  $showSignIn = 'myFunction2();';

  $Username = trim($_POST['Username']);
  $Password = trim($_POST['Password']);
  $PasswordRe = trim($_POST['PasswordRe']);
  $Firstname = trim($_POST['Firstname']);
  $Surname = trim($_POST['Surname']);
  $Email = trim($_POST['Email']);

//validation - these are done using regex match tests using various regex for each field
//sdv
//validate Username
  if (!preg_match("/^\w{2,20}$/",$Username)) {
    $error .= 'You must enter an alphanumeric Username between 3 and
    15 characters.<br />';
    $accept = false;
  }
//validate Password
  if (!preg_match("/^(?=.*[0-9])(?=.*[A-z])\w{5,20}$/",$Password)) {
   $error .= 'You must enter a Password containing between 5 and 20
   characters and atleast one digit and letter.<br /> '.$Password;
   $accept = false;
 }
//validate the Password with the Password re-enter
 if ($Password != $PasswordRe) {
  $error .= 'Your Passwords do not match.<br />';
  $accept = false;
}
//validate names
if (!preg_match("/^[A-z]{2,20}$/",$Firstname)) {
 $error .= 'You must enter a legitimate name.<br />';
 $accept = false;
} elseif (!preg_match("/^[A-z]{2,20}$/",$Surname)) {
 $error .=  'You must enter a legitimate Surname.<br />';
 $accept = false;
}

//validate Email
   if (!preg_match("/^[A-z0-9._%+-]+@[A-z0-9.-]+\.[A-z]{2,}$/",$Email)) {
   $error .= 'You must enter a valid Email Address <br /> ';
   $accept = false;
 }

    //hashing the Password for added security
$salt = time();

$Password = sha1($salt.$Password);
}
    //using a prepared statement to create the account

//if valid and there has been a registration posted0
if (isset($_POST['Register']) && $accept) {
  require('scripts/database.php');
  $db = new Database();
  $stmt = $db->prepare("INSERT INTO user VALUES(NULL,:Username,:Email,:Password,:Firstname,:Surname,:Salt)");

  $stmt->bindParam(':Username',$Username,SQLITE3_TEXT); 
  $stmt->BindParam(':Email',$Email,SQLITE3_TEXT);
  $stmt->bindParam(':Password',$Password,SQLITE3_TEXT);
  $stmt->bindParam(':Firstname',$Firstname,SQLITE3_TEXT);
  $stmt->bindParam(':Surname',$Surname,SQLITE3_TEXT);
  $stmt->bindParam(':Salt',$salt,SQLITE3_TEXT);

  $stmt->execute();
} else {
    $showSignIn = 'myFunction();';
}


//log in

if (isset($_POST['Login'])) {
  $lUsername = $_POST['lUsername'];
 $lPassword = $_POST['lPassword'];
require('scripts/database.php');
$db = new Database();
  $stmt = $db->prepare('SELECT userID, password, username, forename, surname, email, salt FROM user WHERE ( username = :login OR email = :login )');
 $stmt->bindParam(':login',$lUsername,SQLITE3_TEXT);
  $result = $stmt->execute();

//assignment in condition is NOT a typo ;)
  if($resultArray = $result->fetchArray(SQLITE3_ASSOC)) {
    if(sha1($resultArray["salt"].$lPassword) == $resultArray["password"]) {
      $_SESSION['UserID'] = $resultArray["userID"];      
      $_SESSION['Username'] = $resultArray["username"];
      $_SESSION['Firstname'] = $resultArray["forename"];
      $_SESSION['Surname'] = $resultArray["surname"];
      $_SESSION['Email'] = $resultArray["email"]; 
      $_SESSION['loggedIn'] = true;
      header("Location: Lists.php");
    }
  } else {
    $error .= 'That Username and Password combination does not exist.';
  }
 
} 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>cs139</title>
  <link rel="stylesheet" type="text/css" href="css/Animations.css" />
  <link rel="stylesheet" type="text/css" href="css/Todo.css?v=1.2" />  
  <script src="Jquery/jquery-3.1.1.js"></script>
  <script src="scripts/general.js"></script>
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <label>Username:</label>
      <input type="text" name="lUsername"><br><br>
      <label>Password:</label>
      <input type="Password" name="lPassword"> <br><br>
      <input type="submit" name="Login" value="Log in">
    </form>
    <br>
    <p>If you've forgotten your Password click <a style="text-decoration:underline" href="fgtPassword.php">here</a></p>
        <div class="formError"><?php echo $error ?></div>
  </div>    

  <div id="signup" class="content">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <label>Firstname: </label>
      <input type="text" name="Firstname" placeholder="forename" pattern="[A-z]{2,20}" oninvalid="setCustomValidity('Your forename must be between 2 and 20 letters')" onchange="try{setCustomValidity('')}catch(e){}" required><br><br>
      <label>Surname: </label>
      <input type="text" name="Surname" placeholder="surname" pattern = "[A-z]{2,20}" oninvalid="setCustomValidity('Your surname must be between 2 and 20 letters')" onchange="try{setCustomValidity('')}catch(e){}" required> <br><br>
      <label>Email Address: </label>
      <input type="email" name="Email" placeholder="email" pattern="[A-z0-9._%+-]+@[A-z0-9.-]+\.[A-z]{2,}" oninvalid=" setCustomValidity('You must enter a valid email')" onchange="try{setCustomValidity('')}catch(e){}" required> <br><div id="regErrorEmail" class="formError"></div><br>
      <label>Username: </label>
      <input type="text" name="Username" placeholder="username" pattern="\w{2,20}" oninvalid="setCustomValidity('Your username must be between 2 and 20 characters')" onchange="try{setCustomValidity('')}catch(e){}" required> <br><div id="regErrorUsername" class="formError"></div><br>
      <label>Password: </label>
      <input type="Password" name="Password" placeholder="Password" pattern = "(?=.*[0-9])(?=.*[A-z])\w{5,20}" oninvalid="setCustomValidity('You must enter a password with between 5 and 20 alphanumeric characters featuring atleast one digit')" onchange="try{setCustomValidity('')}catch(e){}" required> <br><br>
      <label>Re-enter Password: </label>
      <input type="Password" name="PasswordRe" placeholder="re-enter your password" oninvalid="setCustomValidity('passwords much match')" onchange="try{setCustomValidity('')}catch(e){}" required> <br><br>

      <input type="submit"  name="Register" value="Enter">
    </form>
    <div class="formError"><?php echo $error ?></div>
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
  <?php echo $showSignIn; ?>

</script>
</body>
</html>