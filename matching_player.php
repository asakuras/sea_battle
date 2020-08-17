
<?php
    include("match/returnwaitlist.php");
    session_start();
    checkLegal();
    if(isset($_GET['size'])){
        $_SESSION['size'] = $_GET['size'];
    }
    $size = $_SESSION['size'];
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
</head>
<body>
<div id="bg-seek" class="container">
    <div id="invitation-table">
        <ul>
        <?php  for ($i = ($current_page - 1) * $max_entry; $i  < $current_page  * $max_entry && $i < $cnt; $i++){
                $row = $rows[$i]; ?>
            <li> <?= $row['info'] ?><div><a userid=<?= $row['userid'] ?>>accept</a></div></li>
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
