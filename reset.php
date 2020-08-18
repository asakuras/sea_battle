<?php
    session_start();
    include("include/util.inc.php");
    checkLegal();

    $userid = $_SESSION['userid'];
    $useridforsql = $PDO->quote($userid);

    $PDO->exec("DELETE FROM $CHESSBOARD_TABLE WHERE userid=$useridforsql");

    $PDO->exec("DELETE FROM $GAME_TABLE WHERE user1=$useridforsql OR user2=$useridforsql");

    $PDO->exec("DELETE FROM $STEP_TABLE WHERE userid=$useridforsql");
?>