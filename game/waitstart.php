<?php
//等待开始，发送指令告诉两端开始游戏
    session_start();
    include("../include/util.inc.php");
    checkLegal();

    $userid = $_SESSION['userid'];
    $useridforsql = $PDO->quote($userid);

    $row = $PDO->query("SELECT * FROM $GAME_TABLE WHERE user1=$useridforsql OR user2=$useridforsql")->fetch();

    if($row['ismatch']){
        $firstmove=0;
        if($row['firstmove'] == $userid) $firstmove=1;
        $opponetid=0;
        if($row['user1'] == $userid){
            $opponetid = $row['user2'];
        }
        else{
            $opponetid = $row['user1'];
        }
        $opponetidforsql =$PDO->quote($opponetid);
        $firstmoveforsql = $PDO->quote($firstmove);
        
        $chessrow = $PDO->query("SELECT count(*) AS num FROM $CHESSBOARD_TABLE WHERE userid=$opponetidforsql")->fetch();
        if($chessrow['num']==1){
            $chessrow = $PDO->query("SELECT * FROM $CHESSBOARD_TABLE WHERE userid=$opponetidforsql")->fetch();
            
            $PDO->exec("INSERT INTO $STEP_TABLE (userid,nextflag) VALUES ($useridforsql,$firstmoveforsql)");

            echo json_encode([ 'start' => 1, 'firstmove' => $firstmove, 'opponentboard' => $chessrow['boardstring'] ]);
        }
        else{
            echo json_encode([]);
        }

        
    }
?>
