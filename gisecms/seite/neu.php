<?php
session_start();
include ("../include/status.php");

if ($_REQUEST['f'] == 1)
{
    $benutzer[0]["name"] = $_POST['name'];
$benutzer[0]["template"] =$_POST['template'];
$benutzer[0]["text"] = "text";
$benutzer[0]["type"] = "Texteditor";

include ("../include/mysql.php");
{

$sql = "SELECT ".
    "name, id, template ".
  "FROM ".
    "seiten ".
  "WHERE ".
    "(name like '".$_POST["name"]."')";
$result = mysql_query ($sql);
if (mysql_num_rows ($result) > 0)
{
 header ("Location: neu.php?fehler=2");
}
else
{


// Zuerst alle Datensätze löschen um keine Dopplungen zu bekommen.
// mysql_query ("DELETE FROM benutzerdaten");

// Daten eintragen
while (list ($key, $value) = each ($benutzer))
{
  // SQL-Anweisung erstellen
  $sql = "INSERT INTO ".
    "seiten (name, template) ".
  "VALUES ('".$value["name"]."', '".
                $value["template"]."')";
  mysql_query ($sql);


  if (!mysql_affected_rows ($connectionid) > 0)
    {
  header ("Location: neu.php?fehler=1");
    }
    else
    {
      header ("Location: ../seite.php?richtig=1"); 
    }


}

}

}
 }
include("../include/bereich/1.php"); 
if ($_REQUEST['fehler'] == 1)
{
 echo '<font color="FF0000">Fehler beim erstellen.</font>';
}
if ($_REQUEST['fehler'] == 2)
{
 echo '<font color="FF0000">Seitenname ist schon vergeben.</font><br />';
}

?>
<font size="4px">Seite erstellen</font><br /><br />
<form action="neu.php?f=1" method="post">
Name der Seite: <input type="text" name="name" size="20" /><br />
Template:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="template">
<?php
include ("../include/mysql.php");
{

$abfrage = "SELECT * FROM template";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
echo '<option>'.$row->name.'</option>';
}
}
?>
</select> <br />

<input type="submit" value="Erstellen">
</form>
<hr />
<a href="../seite.php">Zur&uuml;ck</a>
<?php include("../include/bereich/2.php"); ?>