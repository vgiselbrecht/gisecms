<?php
session_start();
include ("include/status.php");

if ($_REQUEST['f'] == 1)
   {
       include ("include/mysql.php");
{
 $wert = $_REQUEST['k'];
$loeschen = "DELETE FROM seiten
WHERE name= '$wert' LIMIT 1";
$loesch = mysql_query($loeschen);

$loeschen = "DELETE FROM content
WHERE name= '$wert' LIMIT 1";
$loesch = mysql_query($loeschen);
}
   } 

if ($_REQUEST['f'] == 2)
   {
       include ("include/mysql.php");
{
$start = $_REQUEST['startseite'];
   $aendern = "UPDATE zusatz Set
    info = '$start'
    WHERE name = 'startseite'";
    $update = mysql_query($aendern);
}
   }


include("include/bereich/1.php");
if ($_REQUEST['richtig'] == 1)
{
 echo '<font color="FF0000">Seite erstellt!</font><br />';
} 
?>

<!-- löschen abfrage -->

<script>
function decision(message, url){
if(confirm(message)) location.href = url;
}
</script>

<a href="seite/neu.php">Neue Seite</a><hr /><br />
<?php
include ("include/mysql.php");
{
$abfrage = "SELECT * FROM template ORDER BY name";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
$farbe = 1;
echo '<b>Template: '.$row->name.'</b><br>';
 echo '<table style="border-top: 1px solid black" cellpadding="0" cellspacing="0">';
 $ab = "SELECT * FROM seiten ORDER BY name";
$er = mysql_query($ab);
while($ro = mysql_fetch_object($er))
{


    if ($ro->template == $row->name)
    {    
     ?>
      <tr>
    <td style="border-bottom: 1px solid black" width="1000" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="<?php echo $_SESSION['pfad']; ?>/vorschau.php?seite=<?php echo $ro->name; ?>" target="_blank"><?php echo $ro->name; ?>&nbsp;</a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="seite/conf.php?k=<?php echo $ro->id; ?>"><img src="images/bearbeiten.png" height="18px" border="none" title="Bearbeiten"></a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="seite.php?k=<?php echo $ro->name; ?>" onclick="decision('Sind Sie sicher das Sie <?php echo $ro->name; ?> l&ouml;schen wollen?','seite.php?f=1&k=<?php echo $ro->name; ?>')"><img src="images/loeschen.png" height="18px" border="none" title="L&ouml;schen">&nbsp;</a></label></td>
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
    }
}
echo '</table><br />';
}
 echo '<b>Seiten ohne Template</b><table style="border-top: 1px solid black" cellpadding="0" cellspacing="0">';
$ab = "SELECT * FROM seiten ORDER BY name";
$er = mysql_query($ab);
while($ro = mysql_fetch_object($er))
{
    if ($ro->template == NULL)
    {
     ?>
      <tr>
    <td style="border-bottom: 1px solid black" width="1000" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="<?php echo $_SESSION['pfad']; ?>/vorschau.php?seite=<?php echo $ro->name; ?>" target="_blank"><?php echo $ro->name; ?>&nbsp;</a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="seite/conf.php?k=<?php echo $ro->id; ?>"><img src="images/bearbeiten.png" height="18px" border="none" title="Bearbeiten"></a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="seite.php?k=<?php echo $ro->name; ?>" onclick="decision('Sind Sie sicher das Sie <?php echo $ro->name; ?> l&ouml;schen wollen?','seite.php?f=1&k=<?php echo $ro->name; ?>')"><img src="images/loeschen.png" height="18px" border="none" title="L&ouml;schen">&nbsp;</a></label></td>
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
    }
}
echo '</table><br />';
}

include ("include/mysql.php");
                {
               $sql2="SELECT * FROM zusatz where name = 'startseite'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
}

}
echo '<hr /><form action="seite.php?f=2" method="post">Startseite: '.$rows2['info'].'';

 echo '<br />  Neue Startseite: <select name="startseite" >';
include ("../include/mysql.php");
{
$abfrage = "SELECT * FROM seiten";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
echo '<option ';
if ($row->name == $rows2['info']) { echo "selected"; }
echo '>'.$row->name.'</option>';
}
}
?>
</select>  
<input type="submit" value="&Auml;ndern">
</form>
<hr />
<a href="backend.php">Zur&uuml;ck</a>
<?php include("include/bereich/2.php"); ?>