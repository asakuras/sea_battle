<?php
    session_start();
    include("include/util.inc.php");
    checkLegal();
    $userid = $_SESSION['userid'];
    //choose which userid to play
    $chooseid = $_POST['chooseid'];

    $user1 = $PDO->qoute($chooseid);
    $user2 = $PDO->qoute($userid);

    $row = $PDO->query("SELECT ismatch FROM $GAME_TABLE WHERE user1=$user1")->fetch();
    if($row['ismatch'] == 0){
        $PDO->exec("UPDATE $GAME_TABLE SET user2=$user2, ismatch=1 WHERE user1=$user1");
        $row = $PDO->query("SELECT gid FROM $GAME_TABLE WHERE user1=$user1")->fetch();

        echo json_encode([ 'ismatch' => 1, 'opponent' => $chooseid, 'gid' => $row['gid'] ]);
    }
    else{
        echo json_encode([ 'ismatch' => 0, 'opponent' => null, 'gid' => null ]);
    }
    

?>