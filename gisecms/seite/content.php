<?php
session_start();
include ("../include/status.php");
$id = $_REQUEST['id'];

include ("../include/mysql.php");
{
$sql2="SELECT * FROM content where id = '$id'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
            $type = $rows2['type'];
            $seite = $rows2['seite'];
        }
}
include("../include/bereich/1.php");


switch ($type) {
case "Texteditor":
include ("editor/texteditor.php");
break;
case "HTML-PHP Editor":
include ("editor/htmleditor.php");
break;
case "Image Gallery":
include ("editor/gallery.php");
break;
}



echo '<br /><hr /><a href="conf.php?k='.$seite.'">Zur&uuml;ck</a>';
include("../include/bereich/2.php");
?>