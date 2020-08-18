<?php
    session_start();
    include("include/util.inc.php");
    checkLegal();
    $userid = $_SESSION['userid'];
    $size = $_SESSION['size'];
    $userid = $PDO->quote($userid);
    $fieldsizeforsql = $PDO->quote($fieldsize);
    $PDO->exec("DELETE FROM $GAME_TABLE WHERE user1=$userid");
    header("Location: matching_player.php?size=$size&current_page=1");
?>