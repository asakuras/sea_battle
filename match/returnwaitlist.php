<?php
    session_start();
    include("include/util.inc.php");
    checkLegal();

    $rows = $PDO->query("SELECT * FROM $GAME_TABLE WHERE ismatch=0");

?>