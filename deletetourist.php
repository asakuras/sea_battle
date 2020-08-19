<?php
include("./include/util.inc.php");
$PDO->exec("DELETE FROM $USER_TABLE WHERE role='tourist' ");
?>