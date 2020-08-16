<?php
//获得走的人这一步的信息
    session_start();
    include("include/util.inc.php");
    checkLegal();

    $userid = $_SESSION['userid'];
    $position = $_POST['position'];
    $x = $position / 10;
    $y = $position % 10;
    $isfinish = $_POST['isfinish'];
    $nextflag = $_POST['nextflag'];

    $useridforsql = $PDO->quote($user);
    $xforsql = $PDO->quote($x);
    $yforsql = $PDO->quote($y);
    $isfinishforsql = $PDO->quote($isfinish);
    $nextflagforsql = $PDO->quote($nextflag);



    $PDO->exec("INSERT INTO $STEP_TABLE (userid,x,y,islast) VALUES ($useridforsql,$xforsql,$yforsql,$isfinishforsql) 
    ON DUPLICATE KEY UPDATE userid=$useridforsql, x=$xforsql, y=$yforsql, islast=$isfinishforsql");

    if($isfinish == 1){
        //游戏结束
    }

?>