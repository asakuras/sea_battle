<?php

    // session_start();
    // include("../include/util.inc.php");
    // checkLegal();
    // $userid = $_SESSION['userid'];
    // $userid = $PDO->quote($userid);

    // $row = $PDO->query("SELECT gid, ismatch,user2 FROM $GAME_TABLE WHERE user1=$userid")->fetch();

    // if($row['ismatch'] == 1){
    //     echo json_encode([ 'ismatch' => 1, 'opponent' => $row['user2'], 'gid' => $row['gid'] ]);
    // }
    // else {
    //     $row = $PDO->query("SELECT gid, ismatch, user1 FROM $GAME_TABLE WHERE user2=$userid")->fetch();
    //     if($row['ismatch']){
    //         echo json_encode([ 'ismatch' => 1, 'opponent' => $row['user1'], 'gid' => $row['gid'] ]);
    //     }
    //     else {
    //         echo json_encode([]);
    //     }
    // }
    session_start();
    include("../include/util.inc.php");
    checkLegal();
    $userid = $_SESSION['userid'];
    $userid = $PDO->quote($userid);

    $row1 = $PDO->query("SELECT gid, ismatch, user2 FROM $GAME_TABLE WHERE user1=$userid")->fetch();
    $row2 = $PDO->query("SELECT gid, ismatch, user1 FROM $GAME_TABLE WHERE user2=$userid")->fetch();

    if(isset($row1['user2']) && $row1['ismatch'] == 1){
        echo json_encode([ 'ismatch' => 1, 'opponent' => $row1['user2'], 'gid' => $row1['gid'] ]);
        // echo json_encode(['abc'=>2]);
    }
    else if(isset($row2['user1']) && $row2['ismatch'] == 1){
        echo json_encode([ 'ismatch' => 1, 'opponent' => $row2['user1'], 'gid' => $row2['gid'] ]);
    }
    else{
        echo json_encode([]);
    }

?>

