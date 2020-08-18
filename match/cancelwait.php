<?php
    session_start();
    include("../include/util.inc.php");
    checkLegal();
    $userid = $_SESSION['userid'];

    $userid = $PDO->quote($userid);
    $fieldsizeforsql = $PDO->quote($fieldsize);
    $PDO->exec("DELETE FROM $GAME_TABLE WHERE user1=$userid");
?>