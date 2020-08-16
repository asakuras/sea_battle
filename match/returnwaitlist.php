<?php
    include("include/util.inc.php");

    //返回等待列表
    function returnWaitList(){
        global $PDO, $GAME_TABLE;
        $rows = $PDO->query("SELECT * FROM $GAME_TABLE WHERE ismatch=0");
        $rets = array();
        foreach($rows as $row){
            $userid=$row['user1'];
            $username=getUserNameById($userid);
            $win_num = getWinNum($userid);
            $all_num = getAllNum($userid);
            $win_ratio = getWinRate($userid);
            $info = $username.' '.$win_num. '/' . $all_num . ' ( '.$win_ratio. '% )';
            $row['info']=$info;
            $rets[]=$row;

        }
        return $rets;
    }

?>