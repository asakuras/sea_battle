<?php
    include("include/util.inc.php");
    session_start();
    checkLegal();
    if(isset($_SESSION['size'])){
        setcookie('size',$_SESSION['size']);
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
<link rel="stylesheet" href="css/game_style.css" type="text/css">

</head>
<body>
<div id="bg-game-play" class="container">
<div id="game_table">
<script src="js/simpleajax.js"></script>
<script src="js/application.js"></script>
<script src = "js/field.js"></script>
<script src = "js/cell.js"></script>
<script src = "js/ship.js"></script>
<script src = "js/player.js"></script>
<script src = "js/game.js"></script>
</div>

<a href="choose_size.php"><img id="back" src="img/back.png" alt="back"></a>
<a href="index.php"><img id="home" src="img/home.png" alt="home"></a>
<img id="your_turn" src="img/your_turn.png" alt="your turn">
<img id="opponent_turn" src="img/opponent_turn.png" alt="opponent turn">
<img id="win_status" src = "img/win.png" alt = "win status">
</div>

</body>

</html>
