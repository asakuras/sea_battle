<?php
    //接收棋盘信息
    session_start();
    include("include/util.inc.php");
    checkLegal();

    $userid = $_SESSION['userid'];
    $chessBoard = $_POST['chessboard'];

    $userid = $PDO->quote($userid);
    $chessBoard = $PDO->quote($chessBoard);
    $PDO->exec("INSERT INTO $CHESSBOARD_TABLE (userid,boardstring) VALUES($userid, $chessBoard)");
?>