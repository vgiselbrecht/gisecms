<?php
include ("../../include/status.php");


// Neuer Eintrag
include ("../../include/mysql.php");
{
if ($_REQUEST['f'] == 1)
{
$lang = $_SESSION['lang'];
$zustand = $_REQUEST['id'];

 $anname = $_REQUEST['ort'];
    
     $sql2="SELECT * FROM menupunkte where name = '$anname' AND zustand_id = '$zustand'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
         if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
      $position = $rows2['position'] + 1;     
    $ein = 0;
    $link = $_POST['link'];
    $sql = "INSERT INTO ".
    "menupunkte (name, zustand_id, position, lang, einruckung, link) ".
  "VALUES ('".$_POST['name']."', '".
                $zustand."', '".
                $position."', '".
                $lang."', '".
                $ein."', '".
                $link."')";
  mysql_query ($sql);
 }
 else
 {
  $ein = 0;
  $position = 1;
    $link = $_POST['link'];
    $sql = "INSERT INTO ".
    "menupunkte (name, zustand_id, position, lang, einruckung, link) ".
  "VALUES ('".$_POST['name']."', '".
                $zustand."', '".
                $position."', '".
                $lang."', '".
                $ein."', '".
                $link."')";
        mysql_query ($sql);       
 }
 
// position ändern
  $momname = $_POST['name'];
$abfrage = "SELECT * FROM menupunkte WHERE zustand_id = '$zustand'";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
   $mid = $row->id;
   if ($row->position >= $position AND $row->name != $momname)
       {
       $pos = $row->position + 1;
    $neu = "UPDATE menupunkte Set
    position = $pos 
    WHERE id = '$mid' AND lang = '$lang'";
    $up = mysql_query($neu);
       }   
   } 
    

}
// löschen
if ($_REQUEST['f'] == 2)
{
    $lang = $_SESSION['lang'];
    $id = $_REQUEST['punkt_id'];
    $loeschen = "DELETE FROM menupunkte
    WHERE id = '$id' LIMIT 1";
    $loesch = mysql_query($loeschen);
    
    $zustand = $_REQUEST['id']; 
    $pos = $_REQUEST['pos'];
    
    $abfrage = "SELECT * FROM menupunkte WHERE zustand_id = '$zustand'";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
   $mid = $row->id;
   if ($row->position > $pos)
       {
       $posi = $row->position - 1;
    $neu = "UPDATE menupunkte Set
    position = $posi
    WHERE id = '$mid' AND lang = '$lang'";
    $up = mysql_query($neu);
       }
   }
}

if ($_REQUEST['f'] == 3)
{
// punkt hinauf
    $zustand = $_REQUEST['id'];
    $pos = $_REQUEST['pos'];
    $posi = $_REQUEST['pos'] - 1;
    $name = $_REQUEST['name'];
    $pid = $_REQUEST['punkt_id'];
    $lang = $_SESSION['lang'];
    
    $neu = "UPDATE menupunkte Set
    position = $pos
    WHERE position = '$posi' AND zustand_id = '$zustand' AND lang = '$lang'";
    $up = mysql_query($neu);
    
    $neu = "UPDATE menupunkte Set
    position = $posi
    WHERE id = '$pid' AND lang = '$lang'";
    $up = mysql_query($neu);    



}

if ($_REQUEST['f'] == 4)
{
    // punkt hinunter
    $zustand = $_REQUEST['id'];
    $pos = $_REQUEST['pos'];
    $posi = $_REQUEST['pos'] + 1;
    $name = $_REQUEST['name'];
    $pid = $_REQUEST['punkt_id'];
    $lang = $_SESSION['lang'];

    // anderer punkt ändern
    $neu = "UPDATE menupunkte Set
    position = $pos
    WHERE position = '$posi' AND zustand_id = '$zustand' AND lang = '$lang'";
    $up = mysql_query($neu);

    // gewählte punkt ändern
       $neu = "UPDATE menupunkte Set
    position = $posi
    WHERE id = '$pid' AND lang = '$lang'";
    $up = mysql_query($neu);
    

}
if ($_REQUEST['f'] == 5)
{
  $name = $_POST['name'];
  $link = $_POST['link'];
  $menupunkt = $_REQUEST['menupunkt'];
  
    $neu = "UPDATE menupunkte Set
    name = '$name',link = '$link'
    WHERE id = '$menupunkt'";
    $up = mysql_query($neu);   
}
if ($_REQUEST['f'] == 6)
{
    $_SESSION['lang'] = $_REQUEST['lang_id'];
}
}


include("../../include/bereich/1.php");
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
<?php 
$id = $_REQUEST['id'];
if ($_REQUEST['fehler'] == 2)
{
 echo '<font color="FF0000">Men&uuml;punkt ist schon vergeben.</font><br />';
}
?>
<form action="menupunkte.php?f=1&id=<?php echo $_REQUEST['id']; ?>" method="post">
Men&uuml;punkt: <input type="text" name="name" size="20" />
&nbsp;Link:&nbsp; <input type="text" name="link" size="20" />
&nbsp;nach&nbsp;<select name="ort">
<option>dem Anfang</option>
<?php  
include ("../../include/mysql.php");
{
$lang = $_SESSION['lang'];
$abfrage = "SELECT * FROM menupunkte WHERE zustand_id = '$id' AND lang = '$lang' ORDER BY position";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
echo '<option>'.$row->name.'</option>';
}
}
?>
</select>
<input type="submit" value="Erstellen">

<font style="float: right;">Sprache:
<SELECT ONCHANGE="location = this.options[this.selectedIndex].value;">
<?php
$abfrag = "SELECT * FROM lang";
$ergebni = mysql_query($abfrag);
while($row = mysql_fetch_object($ergebni))
{
echo '<option ';
if ($row->id == $_SESSION['lang'])
{
echo "selected ";
}
echo 'value=menupunkte.php?id='.$id.'&lang_id='.$row->id.'&f=6>'.$row->kurz.'</option>';
}
 ?>
</SELECT>
</font>


</form><hr /><br />
<table style="border-top: 1px solid black" cellpadding="0" cellspacing="0">
<?php
$farbe = 1;
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
?>
    <tr>
    <td style="border-bottom: 1px solid black"  width="720px" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><form action="menupunkte.php?f=5&id=<?php echo $id; ?>&menupunkt=<?php echo $row->id; ?>" method="post">Name: <input type="text" name="name" size="20" value="<?php echo $row->name; ?>" />Link: <input type="text" name="link" size="40" value="<?php echo $row->link; ?>" /> <input type="submit" value="&Auml;ndern">             </form>  </td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="menupunkte.php?f=3&id=<?php echo $id; ?>&pos=<?php echo $row->position; ?>&name=<?php echo $row->name; ?>&punkt_id=<?php echo $row->id; ?>"><img src="../../images/hinauf.png" height="18px" border="none" title="Hinauf"></a></label></td>
     <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="menupunkte.php?f=4&id=<?php echo $id; ?>&pos=<?php echo $row->position; ?>&name=<?php echo $row->name; ?>&punkt_id=<?php echo $row->id; ?>"><img src="../../images/hinunter.png" height="18px" border="none" title="Hinunter"></a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="menupunkte.php?id=<?php echo $id; ?>" onclick="decision('Sind Sie sicher das Sie <?php echo $row->name; ?> l&ouml;schen wollen?','menupunkte.php?f=2&id=<?php echo $id; ?>&punkt_id=<?php echo $row->id; ?>&pos=<?php echo $row->position; ?>')"><img src="../../images/loeschen.png" height="18px" border="none" title="L&ouml;schen">&nbsp;</a></label></td>    
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
<?php
        $sql2="SELECT * FROM menu_zustande where id = '$id'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
         if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
       $tem_id =  $rows2['template_id'];
       $menu =  $rows2['menu_nr'];
}
echo '</table><br /><hr /><a href="zustand.php?id='.$tem_id.'&menu='.$menu.'">Zur&uuml;ck</a> ';

include("../../include/bereich/2.php");
?>