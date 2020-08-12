<?php
    session_start();
    include("include/util.inc.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

	$user = checkPassword($username,$password);
	if ( $user ){
		$_SESSION[ "userid" ] = getUserId($user);
        $_SESSION[ "username" ] = getUserName($user);
        $role = $_SESSION[ "role" ] = getRole($user);
		$_SESSION[ "user_icon" ] = "img/user_icon.png";

		
        header("Location: lobby.php");
	}
	else{
		header("Location: signin.php?err=1");
	}
?>