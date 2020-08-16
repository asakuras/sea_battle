<?php
    session_start();
    include("include/util.inc.php");
    checkLegal();
    $userid = $_SESSION['userid'];
    $userid=$PDO->qoute($userid);

    $PDO->exec("DELETE FROM $GAME_TABLE WHERE user1=$userid");

    $PDO->exec("INSERT INTO $GAME_TABLE (user1,ismatch,firstmove) VALUES($userid,0,$userid)");

?>