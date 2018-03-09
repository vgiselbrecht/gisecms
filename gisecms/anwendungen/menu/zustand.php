<?php
include ("../../include/status.php");
include ("../../include/mysql.php");
{
// Neuer Zustand erstellen Datenbank    
if ($_REQUEST['f'] == 1)
{
 $id = $_REQUEST['id'];
 $menu = $_REQUEST['menu'];

 $sql = "SELECT ".
    "name ".
  "FROM ".
    "menu_zustande ".
  "WHERE ".
    "(name like '".$_POST["name"]."' AND template_id like '".$id."' AND menu_nr like '".$menu."')";
$result = mysql_query ($sql);
if (mysql_num_rows ($result) > 0)
{
 header ("Location: zustand.php?fehler=2&id=".$id."&menu=".$menu."");
}
else
{
    $sql = "INSERT INTO ".
    "menu_zustande (name, template_id, menu_nr) ".
  "VALUES ('".$_POST['name']."', '".
                $id."', '".
                $menu."')";
  mysql_query ($sql);
}   
}
// löschen
if ($_REQUEST['f'] == 2)
{
 $id = $_REQUEST['id'];
 $menu = $_REQUEST['menu'];
 $zu_id = $_REQUEST['zu_id'];

$wert = $_REQUEST['name'];
$loeschen = "DELETE FROM menu_zustande
WHERE name = '$wert' AND template_id = '$id' AND menu_nr = '$menu'  LIMIT 1";
$loesch = mysql_query($loeschen);

$abfrage = "SELECT * FROM menupunkte where zustand_id = '$zu_id' ";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
$loeschen = "DELETE FROM menupunkte
WHERE zustand_id = '$zu_id' LIMIT 1";
$loesch = mysql_query($loeschen);
}

if ($menu == 1)
{
$abfrage = "SELECT * FROM seiten where menu1 = '$zu_id' ";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
    $seit_id = $row->id;
     $neu = "UPDATE seiten Set
    menu1 = NULL
    WHERE id = '$seit_id'";
    $up = mysql_query($neu);   
}

}
else
{
$abfrage = "SELECT * FROM seiten where menu2 = '$zu_id' ";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
    $seit_id = $row->id;
     $neu = "UPDATE seiten Set
    menu2 = NULL
    WHERE id = '$seit_id'";
    $up = mysql_query($neu);
}    
        
}
}
}
?>
<!-- löschen abfrage -->

<script>
function decision(message, url){
if(confirm(message)) location.href = url;
}
</script>
<?php 
include("../../include/bereich/1.php");

if ($_REQUEST['fehler'] == 2)
{
 echo '<font color="FF0000">Zustandname ist schon vergeben.</font><br />';
}

// Neuer Zustand erstellen
echo '<form action="zustand.php?f=1&id='.$_REQUEST['id'].'&menu='.$_REQUEST['menu'].'" method="post">
Neuer Zustand: <input type="text" name="name" size="20" />
<input type="submit" value="Erstellen">
</form><hr /><br />

<table style="border-top: 1px solid black" cellpadding="0" cellspacing="0">';
include ("../../include/mysql.php");
{
$template_id = $_REQUEST['id'];
$menu = $_REQUEST['menu'];
$farbe = 1;
$abfrage = "SELECT * FROM menu_zustande where template_id = '$template_id' AND menu_nr = '$menu'";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
?>
 <tr>
    <td style="border-bottom: 1px solid black" width="720" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><?php echo $row->name; ?></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="menupunkte.php?id=<?php echo $row->id; ?>">Men&uuml;punkte&nbsp;|&nbsp;</a></label></td>
     <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="seiten.php?id=<?php echo $row->id; ?>&tem_id=<?php echo $template_id; ?>&menu=<?php echo $menu; ?>">Seiten&nbsp;</a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="zustand.php?id=<?php echo $template_id; ?>&menu=<?php echo $menu; ?>" onclick="decision('Sind Sie sicher das Sie <?php echo $row->name; ?> l&ouml;schen wollen?','zustand.php?f=2&name=<?php echo $row->name; ?>&id=<?php echo $template_id; ?>&menu=<?php echo $menu; ?>&zu_id=<?php echo $row->id; ?>')"><img src="../../images/loeschen.png" height="18px" border="none" title="L&ouml;schen">&nbsp;</a></label></td>
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
echo '</table><br /><hr /><a href="../menu.php">Zur&uuml;ck</a>';
}
include("../../include/bereich/2.php");
?>