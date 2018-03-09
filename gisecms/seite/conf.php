<?php
session_start();
include ("../include/status.php");

include ("../include/mysql.php");
{
            $name = $_REQUEST['k'];
            $sql2="SELECT * FROM seiten where id = '$name'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
            $nameaus = $rows2['name'];
        }
    }
    
if ($_REQUEST['f'] == 1)
{

$benutzer[0]["name"] = $_POST['name'];
$benutzer[0]["template"] =$_POST['template'];

include ("../include/mysql.php");
{

$sql = "SELECT ".
    "name, id, template ".
  "FROM ".
    "seiten ".
  "WHERE ".
    "(name like '".$_POST["name"]." AND ')";
$result = mysql_query ($sql);

if (mysql_num_rows ($result) > 0 AND $_POST['name'] != $nameaus)
{
  header ("Location: conf.php?fehler=2&k=".$_REQUEST['k']."");
}
else
{

$alt = $_REQUEST['k'];
$neu = $_POST['name'];
$tem = $_POST['template']; 
$wert = $_REQUEST['k'];

  // Content umbennen
    $update = mysql_query("UPDATE content Set name = '$neu' WHERE name = '$nameaus'");  
    
// umbenennen
     $neu = "UPDATE seiten Set
    name = '$neu',template = '$tem',menu1 = NULL,menu2 = NULL 
    WHERE name = '$nameaus'";
    $up = mysql_query($neu);
    if (!mysql_affected_rows ($connectionid) > 0)
    {
 header ("Location: conf.php?fehler=1&k=".$_REQUEST['k']."");
    }
   else
   {
   
   header ("Location: conf.php?richtig=2&k=".$name."");
   }
   

}
}
}
if ($_REQUEST['f'] == 2)
{
include ("../include/mysql.php");
{
 $type = $_POST['type'];
 $ort = $_POST['ort'];

 if ($ort == "dem Anfang")
    {
     $position = 1;   
    }
    else
    {
        $position = $ort + 1;
    }
    
    
// postion der anderen ändern
$name = $_REQUEST['k'];
$lang = $_SESSION['lang'];
$abfrage = "SELECT * FROM content WHERE seite = '$name' AND lang = '$lang'";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
   $mid = $row->id;
   if ($row->position >= $position )
       {
       $pos = $row->position + 1;
    $neu = "UPDATE content Set
    position = $pos
    WHERE id = '$mid'";
    $up = mysql_query($neu);
       }
   }    
    
    
      
//  neu entragen
    $sql = "INSERT INTO ".
    "content (seite, type, position, lang) ".
  "VALUES ('".$_REQUEST['k']."', '".
                $type."', '".
                $position."', '".
                $_SESSION['lang']."')";
        mysql_query ($sql);


   
}   
}
if ($_REQUEST['f'] == 3)
{
include ("../include/mysql.php");
{
// punkt hinauf
    $pos = $_REQUEST['pos'];
    $posi = $_REQUEST['pos'] - 1;
    $pid = $_REQUEST['id'];
    $lang = $_SESSION['lang'];


    $neu = "UPDATE content Set
    position = $pos
    WHERE position = '$posi' AND seite = '$name' AND lang = $lang";
    $up = mysql_query($neu);

    $neu = "UPDATE content Set
    position = $posi
    WHERE id = '$pid'";
    $up = mysql_query($neu);
       
}    
}
if ($_REQUEST['f'] == 4)
{
include ("../include/mysql.php");
{
// punkt hinunter
    $pos = $_REQUEST['pos'];
    $posi = $_REQUEST['pos'] + 1;
    $pid = $_REQUEST['id'];
    $lang = $_SESSION['lang'];

    $neu = "UPDATE content Set
    position = $pos
    WHERE position = '$posi' AND seite = '$name' AND lang = $lang";
    $up = mysql_query($neu);

    $neu = "UPDATE content Set
    position = $posi
    WHERE id = '$pid'";
    $up = mysql_query($neu);

}
}
if ($_REQUEST['f'] == 5)
{
include ("../include/mysql.php");
{    
    $lang = $_SESSION['lang'];
    $id = $_REQUEST['id'];
    $loeschen = "DELETE FROM content
    WHERE id = '$id' LIMIT 1";
    $loesch = mysql_query($loeschen);

    $pos = $_REQUEST['pos'];

    $abfrage = "SELECT * FROM content WHERE seite = '$name'";
    $ergebnis = mysql_query($abfrage);
    while($row = mysql_fetch_object($ergebnis))
   {
   $mid = $row->id;
   if ($row->position > $pos)
       {
       $posi = $row->position - 1;
    $neu = "UPDATE content Set
    position = $posi
    WHERE id = '$mid' AND lang = '$lang'";
    $up = mysql_query($neu);
       }
   }   
}       
}
if ($_REQUEST['f'] == 6)
{
include ("../include/mysql.php");
{
// Veröffentlichen
            $name = $_REQUEST['content'];
            $sql2="SELECT * FROM content where id = '$name'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
            $public = $rows2['public'];
        if ($public == NULL)
            {
                 $neu = "UPDATE content Set
                public = 'no'
                WHERE id = '$name'";
                 $up = mysql_query($neu);   
            }
        else
            {
                $neu = "UPDATE content Set
                public = NULL
                WHERE id = '$name'";
                 $up = mysql_query($neu);    
            }
        }    
    
    
    
}    
}
if ($_REQUEST['f'] == 7)
{
$_SESSION['lang'] = $_GET['lang_id'];
}


$name = $_REQUEST['k'];
?>
<?php include("../include/bereich/1.php"); ?>

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


<!-- Sprache Wählen -->
<FORM>
<font size="4px">Einstellungen &auml;ndern:</font>
<font style="float: right;">Sprache:
<SELECT ONCHANGE="location = this.options[this.selectedIndex].value;">
<?php 
$abfrage = "SELECT * FROM lang";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
echo '<option ';
if ($row->id == $_SESSION['lang']) 
{ 
echo "selected "; 
}
echo 'value=conf.php?k='.$name.'&lang_id='.$row->id.'&f=7>'.$row->kurz.'</option>';
}
 ?>
</SELECT>
</font><br />
</FORM>


<?php 

if ($_REQUEST['fehler'] == 1)
{
 echo '<font color="FF0000">Fehler beim erstellen.</font>';
}
if ($_REQUEST['fehler'] == 2)
{
 echo '<font color="FF0000">Seiten-Name ist schon vergeben.</font><br />';
}
if ($_REQUEST['richtig'] == 2)
{
 echo '<font color="FF0000">Einstellungen ge&auml;ndert!</font><br />';
}


// id suchen
include ("../include/mysql.php");
                {
               $sql2="SELECT * FROM seiten where id = '$name'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
                $id = $rows2['id'];
                $template = $rows2['template'];       
}
}


 ?>
<form action="conf.php?f=1&k=<?php echo $name; ?>" method="post">
Name: <input type="text" name="name" value="<?php echo $nameaus; ?>" size="20" />
Template: <select name="template">
<?php
include ("../include/mysql.php");
{

$abfrage = "SELECT * FROM template";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
echo '<option';
if ($row->name == $template) { echo " selected"; }
echo'>'.$row->name.'</option>';
}
}
?>
</select>

<input type="submit" value="&Auml;ndern">
</form>
<hr />
<?php  
if ($_REQUEST['richtig'] == 1)
{
 echo '<font color="FF0000">Type ge&auml;ndert!</font><br />';
}


?>
<form action="conf.php?f=2&k=<?php echo $name; ?>" method="post">
<select name="type">
<option>Texteditor</option>
<option>HTML-PHP Editor</option>
<option>Image Gallery</option>
</select>
&nbsp;nach&nbsp;<select name="ort">
<option>dem Anfang</option>
<?php
include ("../include/mysql.php");
{
$lang = $_SESSION['lang'];
$abfrage = "SELECT * FROM content WHERE seite = '$name' AND lang = '$lang' ORDER BY position";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
echo '<option>'.$row->position.'</option>';
}
}
?>
</select>
<input type="submit" value="Erstellen">
</form>
<hr />

<table style="border-top: 1px solid black" cellpadding="0" cellspacing="0">
<?php
$farbe = 1;
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
?>
    <tr>
    <td style="border-bottom: 1px solid black"  width="720px" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label><?php echo $row->type; ?></label> </td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="content.php?id=<?php echo $row->id; ?>"><img src="../images/bearbeiten.png" height="18px" border="none" title="Bearbeiten"></a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="conf.php?f=3&k=<?php echo $name; ?>&pos=<?php echo $row->position; ?>&id=<?php echo $row->id; ?>"><img src="../images/hinauf.png" height="18px" border="none" title="Hinauf"></a></label></td>
     <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="conf.php?f=4&k=<?php echo $name; ?>&pos=<?php echo $row->position; ?>&id=<?php echo $row->id; ?>"><img src="../images/hinunter.png" height="18px" border="none" title="Hinunter"></a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="conf.php?f=6&k=<?php echo $name; ?>&content=<?php echo $row->id; ?>"><img src="../images/<?php if ($row->public == "no") { echo "un";} ?>public.png" height="18px" border="none" title="Ver&ouml;ffentlichen"></a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="<?php if ($farbe == 1){ echo "#C7C7C7";} else { echo "#a9a9a9"; }?>"><label ><a href="conf.php?k=<?php echo $name; ?>" onclick="decision('Sind Sie sicher das Sie <?php echo $row->type; ?> l&ouml;schen wollen?','conf.php?f=5&k=<?php echo $name; ?>&id=<?php echo $row->id; ?>&pos=<?php echo $row->position; ?>')"><img src="../images/loeschen.png" height="18px" border="none" title="L&ouml;schen">&nbsp;</a></label></td>
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

<br /><hr />
<a href="../seite.php">Zur&uuml;ck</a>
<?php include("../include/bereich/2.php"); ?>