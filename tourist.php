<?php
    include("include/util.inc.php");

    session_start();
    $num = rand(10000,30000);
    $username = "tourist".$num;
    

    while(!checkThisUsername($username)){
        $num = rand(10000,30000);
        $username = "tourist".$num;
    }


    $_SESSION['role'] = "tourist";
    $_SESSION['username'] = $username;
    $_SESSION[ "user_icon" ] = "img/tourist_icon.png";
    

    $userid = addTourist($username);
    setcookie('userid',$userid );

    header("Location: lobby.php");
    die();

?>