<?php
 include ("../../include/status.php");
 
  $id = $_REQUEST['id'];
 $tem_id = $_REQUEST['tem_id'];
 $menu = $_REQUEST['menu'];

    
include ("../../include/mysql.php");
{

 if (isset($_POST['seite']))
    {
      $seit = $_POST['seite'];  
    }
    else
    {
        $seit = $_REQUEST['seit'];
    }
        // Seite id herausfinden
        $sql2="SELECT * FROM seiten where name = '$seit'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
         if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
       $seit_id =  $rows2['id'];
 }

if ($_REQUEST['f'] == 1)
   {
 
 // menu zustand ändern
 if ($menu == 1)
    { 
    $neu = "UPDATE seiten Set
    menu1 = $id
    WHERE id = '$seit_id'";
    $up = mysql_query($neu);
    }
    else
    {
    $neu = "UPDATE seiten Set
    menu2 = $id
    WHERE id = '$seit_id'";
    $up = mysql_query($neu);   
    }
   }
   if ($_REQUEST['f'] == 2)
        {
         if ($menu == 1)
    {
    $neu = "UPDATE seiten Set
    menu1 = NULL
    WHERE id = '$seit_id'";
    $up = mysql_query($neu);
    }
    else
    {
    $neu = "UPDATE seiten Set
    menu2 = NULL
    WHERE id = '$seit_id'";
    $up = mysql_query($neu);
    }
        } 
   }
 include("../../include/bereich/1.php");
 ?>
 <script>
function decision(message, url){
if(confirm(message)) location.href = url;
}
</script>
<?php 
 include ("../../include/mysql.php");
 {

 
 // Template name herausfinden
    $sql2="SELECT * FROM template where id = '$tem_id'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
         if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
       $tem_name =  $rows2['name'];
 }
 
} 
 ?>
 
 <form action="seiten.php?f=1&id=<?php echo $id; ?>&tem_id=<?php echo $tem_id; ?>&menu=<?php echo $menu; ?>" method="post">
Seite Hinzuf&uuml;gen
<select name="seite">
<?php
include ("../../include/mysql.php");
{

$abfrage = "SELECT * FROM seiten WHERE template = '$tem_name'";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
if ($menu == 1)
{
 $menu_nr = $row->menu1;   
}
else
{
  $menu_nr = $row->menu2;      
}

if ($menu_nr == NULL)
{
echo '<option>'.$row->name.'</option>';
}
}
}
?>
</select>
<input type="submit" value="Hinzuf&uuml;gen">
</form><hr /><br />
<table style="border-top: 1px solid black" cellpadding="0" cellspacing="0">
<?php
$farbe = 1;
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
if ($menu == 1)
{
 $menu_nr = $row->menu1;
}
else
{
  $menu_nr = $row->menu2;
}

if ($menu_nr == $id)
    {
?>
<tr>
    <td style="border-bottom: 1px solid black" width="1000" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><?php echo $row->name; ?></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="seiten.php?f=2&id=<?php echo $id; ?>&tem_id=<?php echo $tem_id; ?>&menu=<?php echo $menu; ?>&seit=<?php echo $row->name; ?>" ><img src="../../images/loeschen.png" height="18px" border="none" title="Entfernen">&nbsp;</a></label></td>
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
echo '</table><br /><hr /><a href="zustand.php?id='.$tem_id.'&menu='.$menu.'">Zur&uuml;ck</a> ';
include("../../include/bereich/2.php");
?>