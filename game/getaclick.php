<?php
//获得走的人这一步的信息
    session_start();
    include("../include/util.inc.php");
    checkLegal();

    $userid = $_SESSION['userid'];
    $opponent = $_POST['opponent'];
    $x = $_POST['x'];
    $y = $_POST['y'];
    $isfinish = $_POST['isfinish'];
    $nextflag = $_POST['nextflag'];

    $useridforsql = $PDO->quote($userid);
    $xforsql = $PDO->quote($x);
    $yforsql = $PDO->quote($y);
    $isfinishforsql = $PDO->quote($isfinish);
    $nextflagforsql = $PDO->quote($nextflag);

    $opponentforsql = $PDO->quote($opponent);



    //$hasrecord = $PDO->query("SELECT count(*) AS num FROM $STEP_TABLE WHERE userid=$useridforsql")->fetch();

    //if($hasrecord['num']==0){
    //    $PDO->exec("INSERT INTO $STEP_TABLE (userid,x,y,islast,nextflag) VALUES ($useridforsql,$xforsql,$yforsql,$isfinishforsql,$nextflagforsql)");
    //}
    //else if($hasrecord['num']==1){
        $PDO->exec("UPDATE $STEP_TABLE SET x=$xforsql,y=$yforsql,islast=$isfinishforsql,nextflag=$nextflagforsql WHERE userid=$useridforsql");
    //}

    

    if($isfinish == 1){
        $size = $PDO->quote($_SESSION['size']);
        //游戏结束
        //battles加一行对战信息
        $PDO->exec("INSERT INTO $BATTLE_TABLE(user1,user2,winner,filedsize) VALUES($useridforsql,$opponentforsql,$useridforsql,$size)");
        //chessboard删除两条
        $PDO->exec("DELETE FROM $CHESSBOARD_TABLE WHERE userid=$useridforsql");
        $PDO->exec("DELETE FROM $CHESSBOARD_TABLE WHERE userid=$opponentforsql");
        //games删除一条
        $PDO->exec("DELETE FROM $GAME_TABLE WHERE user1=$useridforsql OR user2=$useridforsql");
        //steps删除两条
        $PDO->exec("DELETE FROM $STEP_TABLE WHERE userid=$useridforsql");
        $PDO->exec("DELETE FROM $STEP_TABLE WHERE userid=$opponentforsql");
    }

?>