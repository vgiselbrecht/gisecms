<?php
session_start();
include ("include/status.php");
if ($_REQUEST['f'] == 1)
{
include ("include/mysql.php");
{
 $wert = $_REQUEST['nam'];
$loeschen = "DELETE FROM template
WHERE name= '$wert' LIMIT 1";
$loesch = mysql_query($loeschen);

   $aendern = "UPDATE seiten Set
    template = NULL
    WHERE template = '$wert'";
    $update = mysql_query($aendern);
}
}


include("include/bereich/1.php"); 

if ($_REQUEST['richtig'] == 1)
{
 echo '<font color="FF0000">Template gespeichert!</font><br />';
}
if ($_REQUEST['richtig'] == 2)
{
 echo '<font color="FF0000">Template ge&auml;ndert!</font><br />';
}
?>
<!-- löschen abfrage -->

<script>
function decision(message, url){
if(confirm(message)) location.href = url;
}
</script>
<a href="template/neues.php">Neues Template</a><hr /><br />
<b>Templates:</b><br /><br />
<table style="border-top: 1px solid black" cellpadding="0" cellspacing="0" >
<?php  
include ("include/mysql.php");
{
$farbe = 1;
$abfrage = "SELECT * FROM template ORDER BY name";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
     ?>
      <tr>
    <td style="border-bottom: 1px solid black" width="1000" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><?php echo $row->name; ?>&nbsp;</label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="template/andern.php?nam=<?php echo $row->name; ?>"><img src="images/bearbeiten.png" height="18px" border="none" title="Bearbeiten"></a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="template.php?nam=<?php echo $row->name; ?>"  onclick="decision('Sind Sie sicher das Sie <?php echo $row->name; ?> l&ouml;schen wollen?','template.php?f=1&nam=<?php echo $row->name; ?>')"><img src="images/loeschen.png" height="18px" border="none" title="L&ouml;schen">&nbsp;</a></label></td>
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
?>
</table>
<br /><hr />
<a href="backend.php">Zur&uuml;ck</a>
<?php include("include/bereich/2.php"); ?>