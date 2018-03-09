<?php
session_start();
include ("../../include/status.php");
    include ("../../include/mysql.php");

switch ($_REQUEST['f']) {
 case 1:    
$sql = "SELECT ".
    "name ,id ".
  "FROM ".
    "login ".
  "WHERE ".
    "(name like '".$_POST["name"]."')";
$result = mysql_query ($sql);
if (mysql_num_rows ($result) > 0)
{
 header ("Location: neu.php?fehler=2");
}
else
{

 if($_POST['passwort'] != $_POST['passwort2'])
    {
      header ("Location: neu.php?fehler=3");
      exit();   
    }

  // SQL-Anweisung erstellen
  $sql = "INSERT INTO ".
    "login (name, passwort) ".
  "VALUES ('".$_POST["name"]."', '".
                md5($_POST["passwort"])."')";
  mysql_query ($sql);

  // id herausfinden
  $login_name = $_POST['name'];
    $sql2="SELECT * FROM login where name = '$login_name'";
    $result2=mysql_query($sql2)
    or die ("MySQL-Fehler: " . mysql_error());
    if(mysql_num_rows($result2)) {
    $rows2=mysql_fetch_array($result2);
}


  if (!mysql_affected_rows ($connectionid) > 0)
    {
  header ("Location: neu.php?fehler=1");
    }
    else
    {
      header ("Location: conf.php?id=".$rows2['id']."");    
    }


}
 

break;
}
    
    
    
 include("../../include/bereich/1.php");
if ($_REQUEST['fehler'] == 2)
{
 echo '<font color="FF0000">Benutzername existiert bereits!</font><br />';
}
if ($_REQUEST['fehler'] == 1)
{
 echo '<font color="FF0000">Fehler beim Speichern!</font><br />';
}
if ($_REQUEST['fehler'] == 3)
{
 echo '<font color="FF0000">Passwort stimmt nicht &uuml;berein!</font><br />';
}
$id = $_REQUEST['id'];
     $sql2="SELECT * FROM login where id = '$id'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
}
 ?>
<font size="4px">Neuer Benutzer</font><br /><br />
<form action="neu.php?f=1&id=<?php echo $_REQUEST['id']; ?>" method="post">
<table cellpadding="0" cellspacing="0" summary="Input fields">
<tr>
    <td><label for="username">Benutzername:&nbsp;</label></td>
    <td align="right"><input type="text" name="name" size="20" /></td>
  </tr>
  <tr>
    <td><label for="password">Passwort:</label></td>
    <td align="right"><input type="password" name="passwort" size="20" /></td>
  </tr>
    <tr>
    <td><label for="password">Passwort Wiederholen:</label></td>
    <td align="right"><input type="password" name="passwort2" size="20" /></td>
  </tr>
</table>
<input type="submit" value="Speichern">
</form>
 
 
  <hr />
 <a href="../user.php">Zur&uuml;ck</a>
 <?php 
include("../../include/bereich/2.php"); ?>
