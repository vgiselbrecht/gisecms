<?php
include ("../include/status.php");
include("../include/bereich/1.php");

// template ausgabe
include ("../include/mysql.php");
{

$abfrage = "SELECT * FROM template";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
echo '<b>'.$row->name.'</b><br />';
?><table style="border-top: 1px solid black" cellpadding="0" cellspacing="0">
    <tr>
    <td style="border-bottom: 1px solid black" width="720" bgcolor="#C7C7C7"><label >Men&uuml; 1</label></td>
    <td style="border-bottom: 1px solid black" bgcolor="#C7C7C7"><label ><a href="menu/zustand.php?menu=1&id=<?php echo $row->id; ?>">Zust&auml;nde&nbsp;|&nbsp;</a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="#C7C7C7"><label ><a href="menu/conf.php?menu=1&id=<?php echo $row->id; ?>">Aussehen&nbsp;&nbsp;</a></label></td>
    </tr>
    <tr>
<td style="border-bottom: 1px solid black" width="720" bgcolor="#a9a9a9"><label >Men&uuml; 2</label></td>
    <td style="border-bottom: 1px solid black" bgcolor="#a9a9a9"><label ><a href="menu/zustand.php?menu=2&id=<?php echo $row->id; ?>">Zust&auml;nde&nbsp;|&nbsp;</a></label></td>
    <td style="border-bottom: 1px solid black" bgcolor="#a9a9a9"><label ><a href="menu/conf.php?menu=2&id=<?php echo $row->id; ?>">Aussehen&nbsp;&nbsp;</a></label></td>
    </tr>
  </table><br />
 
<?php      
}
}
echo '<hr /><a href="../anwendungen.php">Zur&uuml;ck</a>';
include("../include/bereich/2.php");
 ?>