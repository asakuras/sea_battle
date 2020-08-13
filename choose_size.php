<?php
    include("include/util.inc.php");
    session_start();
    checkLegal();
$role = $_SESSION['role'];
if(isset($_GET['mode'])){
$_SESSION['mode'] = $_GET['mode'];
}
$mode = $_SESSION['mode'];
$link=array('game.php?size=10','game.php?size=7');
if($mode == "human"){
$link = array('matching_player.php?size=10','matching_player.php?size=7');
}
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
<div id="bg-choosesize" class="container">
        <a href=<?=$link[0]?>><img class="two_box_top" src="img/10x10.png" alt="10x10"></a>
        <br>
        <a href=<?=$link[1]?>><img class="two_box_bottom" src="img/7x7.png" alt="7x7"></a>
        <a href="lobby.php"><img id="back" src="img/back.png" alt="back"></a>
        <a href="index.php"><img id="home" src="img/home.png" alt="home"></a>


</div>
</body>
</html>
