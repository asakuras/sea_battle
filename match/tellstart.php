<?php
    session_start();
    include("include/util.inc.php");
    checkLegal();
    $userid = $_SESSION['userid'];
    $userid = $PDO->quote($userid);

    $row = $PDO->query("SELECT gid, ismatch，user2 FROM $GAME_TABLE WHERE user1=$userid")->fetch();

    if($row['ismatch'] == 1){
        echo json_encode([ 'ismatch' => 1, 'opponent' => $row['user2'], 'gid' => $row['gid'] ]);
    }

?>