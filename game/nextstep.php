<?php
//处理是否能走下一步和棋盘布局改变的轮询

    session_start();
    include("../include/util.inc.php");
    checkLegal();

    $opponent = $_GET['opponent'];
    $userid = $_SESSION['userid'];


    $opponentforsql = $PDO->quote($opponent);
    $useridforsql = $PDO->quote($userid);

    $opponentrow = $PDO->query("SELECT * FROM $STEP_TABLE WHERE userid=$opponentforsql")->fetch();
    $selfrow = $PDO->query("SELECT * FROM $STEP_TABLE WHERE userid=$opponentforsql")->fetch();

    $islast = $opponentrow['islast'];
    $nextflag = $selfrow['nextflag'];

    echo json_encode([ 'x' => $opponentrow['x'], 'y' => $opponentrow['y'],'islast' => $islast, 'nextflag' => $nextflag]);
?>