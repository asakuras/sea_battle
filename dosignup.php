<?php
    include("./include/util.inc.php");
    session_start();
    checkLegal();
$username=$_POST['username'];
$password1=$_POST['password1'];
$password2=$_POST['password2'];

$checkMsg = checkSignUp($username,$password1,$password2);

if($checkMsg!=6){
    header("Location: signup.php?err=$checkMsg");
    die();
}
else{
    register($username,password_hash($password1,PASSWORD_DEFAULT));
}

header("Location: signup_success.php");




?>