<?php
    session_start();
    include("../include/util.inc.php");
    checkLegal();
    $userid = $_SESSION['userid'];
    $fieldsize = $_SESSION['size'];
    
    $userid = $PDO->quote($userid);
    $fieldsizeforsql = $PDO->quote($fieldsize);
    $PDO->exec("DELETE FROM $GAME_TABLE WHERE user1=$userid");

    $PDO->exec("INSERT INTO $GAME_TABLE (user1,ismatch,firstmove,fieldsize) VALUES($userid,0,$userid,$fieldsizeforsql)");

?>