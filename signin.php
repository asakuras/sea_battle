<?php
include("./include/util.inc.php");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sea Battle</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="img/logo.ico" type="images/x-ico" />
<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<div id="bg-signin" class="container">
    <div class="signin">
        <form action="dosignin.php" method="post">
            <input type="text" name="username" placeholder="username">
            <br>
            <input type="password" name="password" placeholder="password">
            <br>
            <span class="err-msg">
            <?php
            if(isset($_GET['err'])){
                print printErrMsg($_GET['err']);
            }
            ?>
            </span>
         <br>
            <input type="submit" value="Sign in">
            <input type="reset" value="Reset">
        </form>
       
        <hr>
        <span>
         Don't have a user ID? <a href="signup.php">sign up</a>
        </span>
    </div>
    <a href="index.php"><img id="back" src="img/back.png" alt="back"></a>
   
</div>
</body>
</html>
