<?php
    session_start();
    include("include/util.inc.php");
    checkLegal();

    $userid = $_SESSION['userid'];
    $useridforsql = $PDO->quote($userid);
    $opponent = $_COOKIE['opponent'];
    $opponentforsql = $PDO->quote($opponent);
    //chessboard删除两条
    $PDO->exec("DELETE FROM $CHESSBOARD_TABLE WHERE userid=$useridforsql");
    $PDO->exec("DELETE FROM $CHESSBOARD_TABLE WHERE userid=$opponentforsql");
    //games删除一条
    $PDO->exec("DELETE FROM $GAME_TABLE WHERE user1=$useridforsql OR user2=$useridforsql");
    //steps删除两条
    $PDO->exec("DELETE FROM $STEP_TABLE WHERE userid=$useridforsql");
    $PDO->exec("DELETE FROM $STEP_TABLE WHERE userid=$opponentforsql");
?>