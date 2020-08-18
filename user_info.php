<?php
    include("include/util.inc.php");
    session_start();
    checkLegal();
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    $userid = $_SESSION['userid'];
    $win_num = getWinNum($userid);
    $all_num = getAllNum($userid);
    $win_ratio = getWinRate($userid);
    $infos = getBattleRecord($userid);
    $cnt = count($infos);
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
<div id="bg-userinfo" class="container">
<div id = "basic-info">
        <p><?=$username?></p>
        <p><?=$role?></p>
        <p><?=$win_num. '/' . $all_num . ' ( '.$win_ratio. '% )'?></p>
</div>
<div id="game-detail">
       


<table>
        <tr>
        <th>player1</th><th>player2</th><th>winner</th><th>score</th><th>field size</th>
        </tr>
        <?php 
        for($i = ($current_page - 1) * $max_entry; $i  < $current_page  * $max_entry && $i < $cnt; $i++){
                $row = $infos[$i]; ?>

<tr>

<td><?= $row['username1'] ?></td><td><?= $row['username2'] ?></td><td><?= $row['winner'] ?></td><td><?= $row['score'] ?></td><td><?= $row['fieldsize'] ?></td>



</tr>

<?php } ?>
    </table>
    <a href=<?= "user_info.php?current_page=".$prev_page ?>> << </a>
    <span>page <?= $current_page ?></span>
    <a href=<?= "user_info.php?current_page=".$next_page ?>> >> </a>
</div>

        <a href="lobby.php"><img id="back" src="img/back.png" alt="back"></a>
        <a href="index.php"><img id="home" src="img/home.png" alt="home"></a>


</div>
</body>
</html>