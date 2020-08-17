<?php
//处理是否能走下一步和棋盘布局改变的轮询

    session_start();
    include("include/util.inc.php");
    checkLegal();

    $opponent = $_GET['opponent'];
    $userid = $_SESSION['userid'];


    $opponentforsql = $PDO->quote($opponent);
    $useridforsql = $PDO->quoted($userid);

    $opponentrow = $PDO->query("SELECT * FROM $STEP_TABLE WHERE userid=$opponentforsql")->fetch();
    $selfrow = $PDO->query("SELECT * FROM $STEP_TABLE WHERE userid=$useridforsql")->fetch();

    $position = 10*$opponentrow['x']+$opponentrow['y'];
    $islast = $opponentrow['islast'];
    $nextflag = $selfrow['nextflag'];

    echo json_encode([ 'position' => $position, 'islast' => $islast, 'nextflag' => $nextflag]);
?>