<?php

$USER_TABLE = 'users';
$BATTLE_TABLE = 'battles';
$PDO = getPDO();

//Connect database
function getPDO() {
    $host = 'localhost:3306';
    $db   = 'sea_battle';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

//Check password is correct or not
function checkPassword($username,$password) {
    global $PDO, $USER_TABLE;
    $password=trim($password);
    if($password=="") return false;
    $username = $PDO->quote($username);
    $row = $PDO->query("SELECT * FROM $USER_TABLE WHERE username = $username")->fetch();
    if ( $row && password_verify($password,$row['password']) )
        return $row;
    return false;
}

//register
function register($username,$password){
    global $PDO, $USER_TABLE;
    $username = $PDO->quote($username);
    $password = $PDO->quote($password);
    $PDO->exec("INSERT INTO $USER_TABLE (username,password,role) VALUES($username,$password,'user')");
}
//add a tourist
function addTourist($username){
    global $PDO, $USER_TABLE;
    $username = $PDO->quote($username);
    $PDO->exec("INSERT INTO $USER_TABLE (username,role) VALUES($username,'tourist')");
    $row = $PDO->query("SELECT * FROM $USER_TABLE WHERE username = $username")->fetch();
    return $row['userid'];
}
//Have this username?
function checkThisUsername($username){
    global $PDO, $USER_TABLE;
    $username = $PDO->quote($username);
    $row = $PDO->query("SELECT count(*) AS num FROM $USER_TABLE WHERE username = $username")->fetch();
    if($row['num']==0) return true;
    return false;
}


//chech when sign up
function checkSignUp($username,$password1,$password2){
    $username=trim($username);
    if($username==""){
        return 2;//"Username can not be empty!"
    }
    $password1=trim($password1);
    if($password1==""){
        return 3;//"Password can not be empty!"
    }
    if($password1!=$password2){
        return 4;//"Two passwords are not same!"
    }
    if(!checkThisUsername($username))
        return 5;
    //5 represent username has existed
    return 6;//"OK";
}

function printErrMsg($err){
    switch($err){
        case 1:
            return "username or password is incorrect."; 
        case 2:
            return "Username can not be empty!";
        case 3:
            return "Password can not be empty!";
        case 4:
            return "Two passwords are not same!";
        case 5:
            return "Username already exists!";
    
    }
      
}



//Get userid
function getUserId($user) {
    return $user['userid'];
}
//Get role
function getRole($user) {
    return $user['role'];
}
//Get username
function getUserName($user) {
    return $user['username'];
}

//Get win rate
function getWinRate($userId){
    global $PDO, $BATTLE_TABLE;
    $userId = $PDO->quote($userId);
    $row = $PDO->query("SELECT COUNT(*) AS winnum FROM $BATTLE_TABLE WHERE winner = $userId")->fecth();
    $whole = $PDO->query("SELECT COUNT(*) AS allnum FROM $BATTLE_TABLE WHERE user1 = $userId OR user2 = $userId")->fecth();
    return round(($row['winnum']*100/$whole['allnum']),2);
}
//Get win num
function getWinNum($userId){
    global $PDO, $BATTLE_TABLE;
    $userId = $PDO->quote($userId);
    $row = $PDO->query("SELECT COUNT(*) AS num FROM $BATTLE_TABLE WHERE winner = $userId")->fecth();
    return $row['num'];
}
//Get all num
function getAllNum($userId){
    $row = $PDO->query("SELECT COUNT(*) AS num FROM $BATTLE_TABLE WHERE user1 = $userId OR user2 = $userId")->fecth();
    return $row['num'];
}
//Get avarage time
function getAvarageTime($userId){
    $rows = $PDO->query("SELECT time FROM $BATTLE_TABLE WHERE user1 = $userId OR user2 = $userId");
    $time = 0;
    $num = 0;
    foreach($rows as $row){
        $time+=$row['time'];
        $num++;
    }
    return round($time/$num,2);
}
//Get battle record
function getBattleRecord($userId){
    $rows = $PDO->query("SELECT * FROM $BATTLE_TABLE WHERE user1 = $userId OR user2 = $userId");
    return $rows;
}

//Delete tourist from database when logout
function deleteTourist($touristId){
    global $PDO, $USER_TABLE;
    $touristId = $PDO->quote($touristId);
    $row = $PDO->query("SELECT * FROM $USER_TABLE WHERE userid = $touristId")->fetch();
    if($row && $row['role']=="tourist"){
        $PDO->execute("DELETE FROM $USER_TABLE WHERE userid = $touristId");
        return true;
    }
    return false;
}

//Return userlist
function getUserList(){
    global $PDO, $USER_TABLE;
    $rows = $PDO->query("SELECT userid,username,role FROM $USER_TABLE");
    return $rows;
}

//Make user table
function makeUserTable($rows){
    
}




//End a game, add a piece of record
function addRecord($user1,$user2,$time,$winner){
    global $PDO, $BATTLE_TABLE;
    $user1 = $PDO->quote($user1);
    $user2 = $PDO->quote($user2);
    $time = $PDO->quote($time);
    $winner = $PDO->quote($winner);
    $PDO->exec("INSERT INTO $BATTLE_TABLE (user1,user2,time,winner) VALUE($user1,$user2,$time,$winner)");
}


?>