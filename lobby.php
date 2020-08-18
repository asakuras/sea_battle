<?php
    include("include/util.inc.php");
    session_start();
    checkLegal();
    $role = $_SESSION['role'];
    setcookie("role",$role);
    $role_img = $_SESSION['user_icon'];
    $username = $_SESSION['username'];
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
<div id="bg-lobby" class="container">
    <div id="name_card">
    
    <img class="name_card" src="img/name_card.png" alt="name_card">
    <img id="user-info" src=<?=$role_img?> alt=<?=$role?>>
    <p id="username"><?=$username?></p>
    <p id="role"><?=$role?></p>
    <span><a href="user_info.php?current_page=1" id="view_detail">view detail</a> <a href="dosignout.php" id="sign_out">sign out</a><span>
    
</div>  
    
    <a href="choose_size.php?mode=human">
    <img class="two_box_top" src="img/human_mode.png" alt="human_mode"></a>
    <br>
    <a href="choose_size.php?mode=ai"><img class="two_box_bottom" src="img/ai_mode.png" alt="ai_mode"></a>
    <a href="index.php"><img id="back" src="img/back.png" alt="back"></a>
    <a href="index.php"><img id="home" src="img/home.png" alt="home"></a>

</div>
</body>
</html>
