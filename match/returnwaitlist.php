<?php
    include("include/util.inc.php");

    //返回等待列表
    function returnWaitList(){
        global $PDO, $BATTLE_TABLE;
        $rows = $PDO->query("SELECT * FROM $GAME_TABLE WHERE ismatch=0");
        $rets = array();
        foreach($rows as $row){
            $row['username1']=getUserNameById($row['user1']);
            $row['username2']=getUserNameById($row['user2']);
            $rets[]=$row;

        }
        return $rets;
    }

?>