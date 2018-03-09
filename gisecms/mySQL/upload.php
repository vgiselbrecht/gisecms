<?php
session_start();

if ($_SESSION['sicherung'] != 1)
 {
 header ("Location: /index.php");
 }
include ("../include/mysql.php");
move_uploaded_file($_FILES['datei']['tmp_name'], "sicherung.sql");
$sql = explode(";\n", file_get_contents('sicherung.sql'));
foreach ($sql as $key => $val) {
    mysql_query($val);
}
unlink("sicherung.sql");
$_SESSION['upload'] = FALSE;
    header ("Location: ../index.php");
?>