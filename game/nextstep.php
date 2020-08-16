<?php
//处理是否能走下一步和棋盘布局改变的轮询

    session_start();
    include("include/util.inc.php");
    checkLegal();

    
?>