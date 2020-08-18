
<?php
    include("match/returnwaitlist.php");
    session_start();
    checkLegal();
    if(isset($_GET['size'])){
        $_SESSION['size'] = $_GET['size'];
    }
    $role_img = $_SESSION['user_icon'];
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    $size = $_SESSION['size'];
    setcookie("size",$size);
    $rows = returnWaitList();
    $cnt = count($rows);
    $current_page=$_GET['current_page'];
    $max_entry = 5;
    $prev_page = $current_page - 1;
    $next_page = $current_page + 1;
    if($current_page == 1){
        $prev_page = $current_page;
    }
    if($current_page == ceil($cnt / $max_entry)){
            $next_page = $current_page;
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
<script src = "js/seek.js"></script>
<script src="js/simpleajax.js"></script>


</head>
<body>
<div id="bg-seek" class="container">
<div id="name_card">
    
    <img class="name_card" src="img/name_card.png" alt="name_card">
    <img id="user-info" src=<?=$role_img?> alt=<?=$role?>>
    <p id="username"><?=$username?></p>
    <p id="role"><?=$role?></p>
    <span><a href="user_info.php?current_page=1" id="view_detail">view detail</a> <a href="dosignout.php" id="sign_out">sign out</a><span>
    
</div>  
    <div id="invitation-table">
        <ul>
        <?php  for ($i = ($current_page - 1) * $max_entry; $i  < $current_page  * $max_entry && $i < $cnt; $i++){
                $row = $rows[$i]; ?>
            <li> <?= $row['info'] ?><div class="invite_link"><a userid=<?= $row['userid'] ?>>accept</a></div></li>
        <?php } ?>
          
    </ul>
    <a href=<?= "matching_player.php?size=$size&current_page=".$prev_page ?>> << </a>
    <span>page <?= $current_page ?></span>
    <a href=<?= "matching_player.php?size=$size&current_page=".$next_page ?>> >> </a>
    <a ><img id="seek_player" src="img/seek_for_friend.png"></a>
</div>
   
        <a href="lobby.php"><img id="back" src="img/back.png" alt="back"></a>
        <a href="index.php"><img id="home" src="img/home.png" alt="home"></a>


</div>
</body>
</html>
