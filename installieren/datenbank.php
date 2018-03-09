<?php 

error_reporting(0);

if ($_POST['addresse'] == NULL OR $_POST['benutzer'] == NULL OR $_POST['datenbank'] == NULL)
{
    header ("Location: index.php?fehler=1");

}
else
{

//@mysql_connect($_POST['addresse'], $_POST['benutzer'], $_POST['passwort']) OR
//header ("Location: index.php?fehler=2");  
//mysql_select_db($_POST['datenbank']) OR
//die(header ("Location: index.php?fehler=2"));  

$con = @mysql_connect($_POST['addresse'],$_POST['benutzer'],$_POST['passwort']);
if (!$con)
  {
  die(header ("Location: index.php?fehler=2"));
  }
    if (!mysql_select_db($_POST['datenbank'],$con))
    {
    mysql_query("CREATE DATABASE ".$_POST['datenbank']."",$con);
    }
  
mysql_close($con);


$inhalt = '<?php
    $datenbankname = "'.$_POST['datenbank'].'"; 
    $connectionid = @mysql_connect ("'.$_POST['addresse'].'", "'.$_POST['benutzer'].'", "'.$_POST['passwort'].'"); 
    if (@mysql_select_db ("'.$_POST['datenbank'].'", $connectionid))
     ?>';
$handle = fopen ("../gisecms/include/mysql.php", w);
fwrite ($handle, $inhalt);
fclose ($handle);


include ("../gisecms/include/mysql.php");
{
    header ("Location: anmelden.php");  
}


}
 ?>