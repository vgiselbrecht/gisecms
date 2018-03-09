<?php
session_start();

include ("include/mysql.php");
{
$sql = "SELECT ".
    "id, name, passwort ".
  "FROM ".
    "login ".
  "WHERE ".
    "(name like '".$_POST["name"]."') AND ".
    "(passwort = '".md5 ($_POST["passwort"])."')";
$result = mysql_query ($sql);
if (mysql_num_rows($result) > 0)
{
  $_SESSION['status']  = TRUE ;
  $data = mysql_fetch_array ($result);
  $_SESSION['name'] = $data["name"];
  $_SESSION["user_id"] = $data["id"];
   header ("Location: backend.php");
   }
else
{
 header ("Location: index.php?fehler=1");
}
}




?>