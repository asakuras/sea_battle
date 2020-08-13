
<?php
    include("include/util.inc.php");
    session_start();
    checkLegal();
    if(isset($_GET['size'])){
        $_SESSION['size'] = $_GET['size'];
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
<div id="bg-seek" class="container">
    <div id="invitation-table">
        <ul>
            <li> user01 5/10 (50%) <a >accept</a></li>
            <li> user02 5/10 (50%) <a>accept</a></li>
            <li> user03 5/10 (50%) <a>accept</a></li>
            <li> user04 5/10 (50%) <a>accept</a></li>
            <li> user05 5/10 (50%) <a>accept</a></li>
    </ul>
    <a> << </a>
        <span>page 1</span>
    <a> >> </a>
    <a ><img src="img/seek_for_friend.png"></a>
</div>
   
        <a href="lobby.php"><img id="back" src="img/back.png" alt="back"></a>
        <a href="index.php"><img id="home" src="img/home.png" alt="home"></a>


</div>
</body>
</html>
