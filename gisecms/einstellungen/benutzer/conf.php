<?php
session_start();
include ("../../include/status.php");
    include ("../../include/mysql.php");
    
    // Daten auslesen
            $id = $_REQUEST['id'];
            $sql2="SELECT * FROM login where id = '$id'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
}
// Inhalt ändern
 if ($_REQUEST['f'] == 1)
    {
     $sql = "SELECT ".
    "name ,id ".
  "FROM ".
    "login ".
  "WHERE ".
    "(name like '".$_POST["name"]."')";
$result = mysql_query ($sql);
if (mysql_num_rows ($result) > 0)
{
if ($_POST['name'] != $rows2['name'])
{
 header ("Location: conf.php?fehler=2$id=".$rows2['id']."");
 exit();
 }
}

   $login_name = $_POST['name'];
    $aendern = "UPDATE login Set
    name = '$login_name'
    WHERE id = '$id'";
    $update = mysql_query($aendern);
 header ("Location: conf.php?id=".$rows2['id']."");
 exit(); 
        
    }
 ?>
<?php include("../../include/bereich/1.php");
if ($_REQUEST['fehler'] == 2)
{
 echo '<font color="FF0000">Benutzername existiert bereits!</font><br />';
}
?>

<form action="conf.php?f=1&id=<?php echo $rows2['id'];?>" method="post">
<font size="4px">Benutzer &Auml;ndern</font><br /><br />
<table cellpadding="0" cellspacing="0" summary="Input fields">
<tr>
    <td><label for="username">Benutzername:&nbsp;</label></td>
    <td align="right"><input type="text" name="name" size="20" value="<?php echo $rows2['name']; ?>" /></td>
</tr>
</table>
<a href="passwort.php?id=<?php echo $rows2['id'];?>">Passwort &auml;ndern:</a><br />
<input type="submit" value="Speichern">
</form>

 <hr />
 <a href="../user.php">Zur&uuml;ck</a>
<?php include("../../include/bereich/2.php"); ?>
