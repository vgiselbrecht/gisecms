<?php
ob_start() ;

session_start() ;

$_SESSION['status'] = Null;
header ("Location: ../index.php");
?>
