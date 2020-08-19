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
<div id="bg-signup" class="container">
    <div class="signin">
        <form action="dosignup.php" method="post">
            <input type="text" name="username" placeholder="username">
            <br>
            <input type="password" name="password1" placeholder="password">
            <br>
            <input type="password" name="password2" placeholder="repeat password">
            <br>
            <span class="err-msg">
            <?php
            if(isset($_GET['err'])){
                print printErrMsg($_GET['err']);
            }
            ?>
            </span>
            <br>
            <input type="submit" value="Sign up">
            <input type="reset" value="Reset">
        </form>

    </div>
    <a href="index.php"><img id="back" src="img/back.png" alt="back"></a>
</div>
</body>
</html>
