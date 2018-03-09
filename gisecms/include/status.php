<?php
error_reporting(0);
    header('P3P: CP="CAO PSA OUR"');
session_start();
if ($_SESSION['status'] != true)
{
 header ("Location: ".$_SESSION['pfad']."/index.php");
}



?>