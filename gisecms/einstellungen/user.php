<?php 
session_start();
include ("../include/status.php");
    include ("../include/mysql.php");
    
 // löschen
 if ($_REQUEST['f'] == 1)
   {
$login_id = $_REQUEST['id'];  
$loeschen = "DELETE FROM login
WHERE id= '$login_id' LIMIT 1";
$loesch = mysql_query($loeschen);

   }   
 ?> 
<?php include("../include/bereich/1.php");
?>
<script>
function decision(message, url){
if(confirm(message)) location.href = url;
}
</script>
 <a href="benutzer/neu.php?neu=1">Benutzer hinzuf&uuml;gen</a>
<hr />
<?php 
$farbe = 1; 
 echo '<table style="border-top: 1px solid black" cellpadding="0" cellspacing="0">';
  $ab = "SELECT * FROM login ORDER BY name";
$er = mysql_query($ab);
while($ro = mysql_fetch_object($er))
{


    if ($ro->template == $row->name)
    {
     ?>
      <tr>
    <td style="border-bottom: 1px solid black" width="1000" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><?php echo $ro->name; ?>&nbsp;</a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="benutzer/conf.php?id=<?php echo $ro->id; ?>"><img src="../images/bearbeiten.png" height="18px" border="none" title="Bearbeiten"></a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="user.php" onclick="decision('Sind Sie sicher das Sie den Benutzer <?php echo $ro->name; ?> l&ouml;schen wollen?','user.php?f=1&id=<?php echo $ro->id; ?>')"><img src="../images/loeschen.png" height="18px" border="none" title="L&ouml;schen">&nbsp;</a></label></td>
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
 <hr />
 <a href="../einstellungen.php">Zur&uuml;ck</a>
<?php include("../include/bereich/2.php"); ?>