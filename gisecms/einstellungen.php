<?php
session_start();
include ("include/status.php");
    include ("include/mysql.php");
switch ($_REQUEST['f']) {
 case 3:
 //alt
   if ($_POST['altpasswort'] == NULL OR $_POST['passwort'] == NULL OR $_POST['passwort2'] == NULL)
{
    header ("Location: einstellungen.php?f=1&fehler=1");
}
if ($_POST['passwort'] != $_POST['passwort2'])
{
   header ("Location: einstellungen.php?f=1&fehler=2");
}   

  // Passwort ändern
  
  $passwort = md5($_POST['passwort']);
  $altpasswort = md5($_POST['altpasswort']);
  $id =   $_SESSION['user_id'];
    include ("include/mysql.php");
        {
        
        // Ob Passowrt richtig ist

               $sql2="SELECT * FROM login where id = '$id'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
             if (isset($rows2['passwort']))
            { 

                      if ($altpasswort == $rows2['passwort'])
                        {
                                 $sql = "UPDATE
                    `login`
                SET
                    `passwort` = '".$passwort ."'
                WHERE
                    `id` = ".$_SESSION["user_id"]; //es folg der mötige sql syntax
        $result = mysql_query($sql) or die('cannot change password:<br>'.mysql_error()); // mit eintragen ind die db   
                        }
                        else
                        {
                        header ("Location: einstellungen.php?f=1&fehler=3");    
                        }
            }
            else
            {
             header ("Location: einstellungen.php?f=1&fehler=4");
            }
}

                  }      
      
      
    break;
  case 4:
   if ($_POST['addresse'] == NULL OR $_POST['benutzer'] == NULL OR $_POST['datenbank'] == NULL)
{
    header ("Location: einstellungen.php?f=2&fehler=1");

}
else
{


@mysql_connect($_POST['addresse'], $_POST['benutzer'], $_POST['passwort']) OR
header ("Location: einstellungen.php?f=2&fehler=2");
mysql_select_db($_POST['datenbank']) OR
die(header ("Location: einstellungen.php?f=2&fehler=2"));


$inhalt = '<?php
    $datenbankname = "'.$_POST['datenbank'].'"; 
    $connectionid = @mysql_connect ("'.$_POST['addresse'].'", "'.$_POST['benutzer'].'", "'.$_POST['passwort'].'");
    if (@mysql_select_db ("'.$_POST['datenbank'].'", $connectionid))
     ?>';
$handle = fopen ("../gisecms/include/mysql.php", w);
fwrite ($handle, $inhalt);
fclose ($handle);


include ("include/mysql.php");
{
    header ("Location: einstellungen.php");
}


} 
case 5:
 // sicherung erstellen
include ("include/mysql.php");
{
$f = fopen("sicherung.gise", "w");
$tables = mysql_list_tables($datenbankname);
while ($cells = mysql_fetch_array($tables)) {
$table = $cells[0];
fwrite($f,"DROP TABLE `$table`;\n");
$res = mysql_query("SHOW CREATE TABLE `$table`");
if ($res) {
$create = mysql_fetch_array($res);
$create[1] .= ";";
$line = str_replace("\n", "", $create[1]);
fwrite($f, $line."\n");
$data = mysql_query("SELECT * FROM `$table`");
$num = mysql_num_fields($data);
while ($row = mysql_fetch_array($data)){
$line = "INSERT INTO `$table` VALUES(";
for ($i=1;$i<=$num;$i++) {
$line .= "'".mysql_real_escape_string($row[$i-1])."', ";
}
$line = substr($line,0,-2);
fwrite($f, $line.");\n");
}
}
}
fclose($f);
}
// Sicherung komprimieren
  //Start Output buffering
  ob_start();

  //Load the Library
  require('Sicherung/zip.lib.php');

  //Generate a new object
  $zipfile = new zipfile('Sicherung.zip');

  //Add a single file
  $zipfile->addFileAndRead('sicherung.gise');

  //Output the new zip file
  echo $zipfile->file();
  
  unlink("sicherung.gise");

 ?> 
<?php     
  break;
  case 8:
  // Sicherung Upload und SQL verändern
  include ("include/mysql.php");
    move_uploaded_file($_FILES['datei']['tmp_name'], "sicherung.sql");
    $sql = explode(";\n", file_get_contents('sicherung.sql'));
        foreach ($sql as $key => $val) {
    mysql_query($val);
}
    unlink("sicherung.sql");
    $_SESSION['status'] = FALSE;
    header ("Location: index.php");
  break;
  
  
  case 10:
   // Sprachen ändern
   // Schauen ob Kürzel bereits exestiert
   if ($_GET['kurz'] != $_POST['kurz'])
    {
     $sql = "SELECT ".
    "kurz ".
  "FROM ".
    "lang ".
  "WHERE ".
    "(kurz like '".$_POST["kurz"]."')";
$result = mysql_query ($sql);
}
if (@mysql_num_rows ($result) > 0)
{
 header ("Location: einstellungen.php?f=9&fehler=1");
}
else
 {
// Ändenr
$lang_name = $_POST['name'];
$kurz = $_POST['kurz'];
$lang_id = $_REQUEST['id'];

    $neu = "UPDATE lang Set
    name = '$lang_name', kurz = '$kurz'
    WHERE id = '$lang_id' ";
    $up = mysql_query($neu);
     header ("Location: einstellungen.php?f=9");
}
  break;
  
  case 11:
  $lang_id = $_REQUEST['id'];
  // Standartsprache ändern
$neu = "UPDATE lang Set
    standart = FALSE
    WHERE standart = 1 ";
    $up = mysql_query($neu);

$neu = "UPDATE lang Set
    standart = 1
    WHERE id = '$lang_id' ";
    $up = mysql_query($neu);
     header ("Location: einstellungen.php?f=9");
  break;
  case 12:
  // Neue Sprache hinzufügen
  // Schauen ob Kürzel bereits exestiert
   $sql = "SELECT ".
    "kurz ".
  "FROM ".
    "lang ".
  "WHERE ".
    "(kurz like '".$_POST["kurz"]."')";
$result = mysql_query ($sql);
if (mysql_num_rows ($result) > 0)
{
 header ("Location: einstellungen.php?f=9&fehler=1");
}
else
{
  $sql = "INSERT INTO ".
    "lang (name, kurz) ".
  "VALUES ('".$_POST['name']."', '".
                $_POST['kurz']."')";
  mysql_query ($sql);
   header ("Location: einstellungen.php?f=9");
   }
  break;
  
  case 13:
  $lang_id = $_REQUEST['id'];
  // Sprache entfernen
  $loeschen = "DELETE FROM lang
WHERE id = '$lang_id' LIMIT 1";
$loesch = mysql_query($loeschen);
   header ("Location: einstellungen.php?f=9");
  break;
}   
    
    
    

 ?>

<?php include("include/bereich/1.php"); ?>
CMS Einstellungen:<br /><br />

<?php 
switch($_REQUEST['f']) {

case 1:
// alt
    if ($_REQUEST['fehler'] == 1)
     {
         echo '<font color="FF0000">Sie m&uuml;ssen alle Felder Ausf&uuml;llen!</font>';
     }
 if ($_REQUEST['fehler'] == 2)
     {
         echo '<font color="FF0000">Die Passw&ouml;rter sind nicht &uuml;berein.</font>';
     }
 if ($_REQUEST['fehler'] == 3)
     {
         echo '<font color="FF0000">Falsches Passwort!</font>';
     }
    
    ?>
<form action="einstellungen.php?f=3" method="post">
Altes Passwort: <input type="password" name="altpasswort" size="20" /><br />
Neues Passwort: <input type="password" name="passwort" size="20" /><br />
Neues Passwort(Wiederholen): <input type="password" name="passwort2" size="20" /><br />
<input type="submit" value="Speichern">
 <br /><br /><a href="einstellungen.php">Zur&uuml;ck</a>
</form>
    <?php 
      break; 
case 2:

 if ($_REQUEST['fehler'] == 1)
     {
         echo '<font color="FF0000">Sie m&uuml;ssen alle Felder Ausf&uuml;llen!</font>';
     }
 if ($_REQUEST['fehler'] == 2)
     {
         echo '<font color="FF0000">Datenbank ist nicht erreichbar!</font>';
     }
    ?>
     <form action="einstellungen.php?f=4" method="post">
Addresse: <input type="text" name="addresse" size="20" />(z.B.: localhost)<br />
Benutzer: <input type="text" name="benutzer" size="20" />(Bei xampp root)<br />
Passwort: <input type="password" name="passwort" size="20" /> (Darf leer bleiben)<br />
Datenbank: <input type="text" name="datenbank" size="20" />(Muss exestieren)<br />
<input type="submit" value="Weiter">
 <br /><br /><a href="einstellungen.php">Zur&uuml;ck</a>
</form>
    <?php     
        break;
        case 7:
        // Upload daten eingeben
        ?>
        
        <form action="einstellungen.php?f=8" method="post" enctype="multipart/form-data">
<tr>Hier geben Sie die Sicherungs Datei ein, welche Sie verwenden wollen(Optional, nur gise Datei nich zip)<br /></tr>
<input name="datei" type="file" size="50"><br />
<input type="submit" value="Hochladen">
 <br /><br /><a href="einstellungen.php">Zur&uuml;ck</a>
     <?php    
        break;
    
    case 9:
   // Sprache ändern
   if ($_REQUEST["fehler"] == 1)
    {
        echo '<font color="FF0000">K&uuml;rzel exestiert bereits!</font>';
    }
   ?>
   <script>
function decision(message, url){
if(confirm(message)) location.href = url;
}
   </script>
    <style type="text/css">
      form
      {
        margin:0;
        padding:0;
        display:inline;
      }
    </style>
    <hr />
<form action="einstellungen.php?f=12" method="post">
Name: <input type="text" name="name" size="20" />
&nbsp;K&uuml;rzel:&nbsp; <input type="text" name="kurz" size="1" />
<input type="submit" value="Hinzuf&uuml;gen">
</form>
<hr />
<table style="border-top: 1px solid black" cellpadding="0" cellspacing="0">
<?php
    include ("include/mysql.php");
$farbe = 1;
$abfrage = "SELECT * FROM lang ";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
?>
    <tr>
    <td style="border-bottom: 1px solid black"  width="1000px" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><form action="einstellungen.php?f=10&id=<?php echo $row->id; ?>&kurz=<?php echo $row->kurz; ?>" method="post">Name: <input type="text" name="name" size="20" value="<?php echo $row->name; ?>" />&nbsp;K&uuml;rzel:&nbsp; <input type="text" name="kurz" size="1" value="<?php echo $row->kurz; ?>" /> <input type="submit" value="&Auml;ndern">             </form>  </td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><?php if ($row->standart == 1){ echo "Standardsprache";  } else {?> <a href="einstellungen.php?f=11&id=<?php echo $row->id; ?>">Zur&nbsp;Standardsprache&nbsp;machen&nbsp;</a> <?php  } ?></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="einstellungen.php?f=9" onclick="decision('Sind Sie sicher das Sie <?php echo $row->name; ?> l&ouml;schen wollen?','einstellungen.php?f=13&id=<?php echo $row->id; ?>')"><img src="images/loeschen.png" height="18px" border="none" title="L&ouml;schen">&nbsp;</a></label></td>
    </tr>
<?php
if ($farbe == 2)
         {
             $farbe = 1;
         }
         else
         {
             $farbe = 2;
         }
} ?>
 </table>
  <hr />
 <a href="einstellungen.php">Zur&uuml;ck</a>
   <?php  
    break;
default:
  

?>
 - <a href="einstellungen/user.php">Benutzer verwalten:</a> <br />
 - <a href="einstellungen.php?f=9">Sprachen Ausw&auml;hlen:</a> <br />
  - <a href="einstellungen.php?f=5">Datenbank Sichern:</a> <br />
    - <a href="einstellungen.php?f=7">Sicherung hochladen:</a> <br />
 - <a href="einstellungen.php?f=2">mySQL einstellungen &auml;ndern:</a><br /><br />
 <hr />
 <a href="backend.php">Zur&uuml;ck</a>
<?php 
  
}

 ?>
<br />
<?php include("include/bereich/2.php"); 
?>
