<?php
//等待开始，发送指令告诉两端开始游戏
    session_start();
    include("include/util.inc.php");
    checkLegal();

    $userid = $_GET['userid'];
    $userid = $PDO->quote($userid);

    $row = $PDO->query("SELECT * FROM $BATTLE_TABLE WHERE user1=$userid OR user2=$userid")->fetch();

    if($row['']){
        echo json_encode([]);
    }
?>
