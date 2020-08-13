<?php
    include("include/util.inc.php");
    session_start();
    checkLegal();
    if($_SESSION[ "role" ] == 'tourist'){
        deleteTourist($_SESSION['userid']);
    }
    session_destroy();
    session_regenerate_id(true);
    session_start();
    header("Location: index.php");
?>