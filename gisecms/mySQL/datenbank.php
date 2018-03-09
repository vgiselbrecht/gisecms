<?php 
session_start();
if ($_POST['addresse'] == NULL OR $_POST['benutzer'] == NULL OR $_POST['datenbank'] == NULL)
{
    header ("Location: index.php?fehler=1");

}
else
{


@mysql_connect($_POST['addresse'], $_POST['benutzer'], $_POST['passwort']) OR
header ("Location: index.php?fehler=2");
mysql_select_db($_POST['datenbank']) OR
die(header ("Location: index.php?fehler=2")); 


$inhalt = '<?php 
    $datenbankname = "'.$_POST['datenbank'].'"; 
    $connectionid = @mysql_connect ("'.$_POST['addresse'].'", "'.$_POST['benutzer'].'", "'.$_POST['passwort'].'"); 
    if (@mysql_select_db ("'.$_POST['datenbank'].'", $connectionid))
     ?>';
$handle = fopen ("../include/mysql.php", w);
fwrite ($handle, $inhalt);
fclose ($handle);

if ($_POST['upload'] == 'on')
{
 $_SESSION['sicherung'] = true;
  header ("Location: datei.php");  
}
else
{
    header ("Location: ../index.php");
}




}
 ?>