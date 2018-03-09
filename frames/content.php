<?php
if (isset($_REQUEST['fehler']))
{
    echo '<b>Seite "'.$_REQUEST['fehler'].'" exestiert nicht. Zur&uuml;ck zur <a href="index.php">Startseite</a>!</b>';
}
else
{
include ("gisecms/include/mysql.php");
                {
               $sql2="SELECT * FROM seiten where name = '$name'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
                $id = $rows2['id'];
}
}
 
$inhalt = $_REQUEST['inhalt'];
if ($inhalt == 'suchen')
{
include ("suchen/suchencontent.php");  
}
else
{
include ("gisecms/include/mysql.php");
{
$lang = $_SESSION['lang'];
$abfrage = "SELECT * FROM content WHERE seite = '$id' AND lang = '$lang' ORDER BY position";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis)) 
   {
    $con_id = $row->id;
    if ($row->public != "no" OR $_SESSION['status'] == TRUE AND $_SESSION['public'] == TRUE )
    {

    // Ediitions bereich

    if ($_SESSION['status'] == TRUE AND $_SESSION['public'] == TRUE)
    {
    echo '<table style="border-top: 1px solid black" cellpadding="0" cellspacing="0"><tr>';
   echo  '<td style="border-bottom: 1px solid black"  width="720px" bgcolor="#C7C7C7"><label>'.$row->type.'</label> </td>';
    echo '<td style="border-bottom: 1px solid black" bgcolor="#C7C7C7"><a href="gisecms/seite/content.php?id='.$con_id.'" target="_blank" ><img src="gisecms/images/bearbeiten.png" height="17px" border="none" /></a></td>';
    // Artikel Veröffentlichen
          if  ($row->public == "no")
    {
        echo '<td style="border-bottom: 1px solid black" bgcolor="#C7C7C7"><a href="index.php?seite='.$name.'&ver=ja&con='.$con_id.'"><img src="gisecms/images/unpublic.png" height="17px" border="none" /></a></td> <br />';
    }
    else
    {
             echo '<td style="border-bottom: 1px solid black" bgcolor="#C7C7C7"><a href="index.php?seite='.$name.'&ver=nein&con='.$con_id.'"><img src="gisecms/images/public.png" height="17px" border="none" /></a></td> <br />';   
    }

        echo "</tr></table>";
    }
    switch ($row->type) {
    case "Texteditor":
    include ("editor/texteditor.php");
    echo '<br />';
    break;
        case "Image Gallery":
    include ("editor/gallery.php");
    echo '<br />';
    break;
    case "HTML-PHP Editor":
     include ("editor/htmleditor.php");
     echo '<br /><br />';
    break;
    }
}   
   }             
}
}
}
?>
