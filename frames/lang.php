<form>
Language:
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
echo 'value=index.php?seite='.$name.'&lang='.$row->kurz.'>'.$row->name.'</option>';
}
 ?>
</SELECT>




</form>

