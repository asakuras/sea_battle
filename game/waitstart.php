<?php
//等待开始，发送指令告诉两端开始游戏
    session_start();
    include("include/util.inc.php");
    checkLegal();

    $userid = $_SESSION['userid'];
    $useridforsql = $PDO->quote($userid);

    $row = $PDO->query("SELECT * FROM $BATTLE_TABLE WHERE user1=$useridforsql OR user2=$useridforsql")->fetch();

    if($row['ismatch']){
        $firstmove=0;
        if($row['firstmove'] == $userid) $firstmove=1;
        $opponetid=0;
        if($row['user1'] == $useridforsql){
            $opponetid = $row['user2'];
        }
        else{
            $opponetid = $row['user1'];
        }
        $opponetidforsql =$PDO->quote($opponetid);
        $chessrow = $PDO->query("SELECT * FROM $CHESSBOARD_TABLE WHERE userid=$opponetidforsql");
        echo json_encode([ 'start' => 1, 'firstmove' => $firstmove, 'opponentboard' => $chessrow['boardstring'] ]);
    }
?>
