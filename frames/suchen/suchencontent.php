	<form action="index.php?inhalt=suchen&seite=<?php echo $name; ?>" method="post">
		<p><label for="suchbegriff">Weiter suchen:</label>
		<input type="text" name="q" id="suchbegriff" value="<?php echo $_REQUEST['q']; ?>" size="13" title=" Suchbegriff hier eingeben " onblur="if(this.value=='')this.value='Suchbegriff';" onfocus="if(this.value=='Suchbegriff')this.value='';" />
		<input type="submit" value="Los !" />
		</p>
	</form>
<?php
include ("gisecms/include/mysql.php");
{
$q = $_REQUEST['q']; 
$sql2="SELECT * FROM content WHERE MATCH (text) AGAINST ('$q' IN BOOLEAN MODE)";
$result2=mysql_query($sql2) 
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
echo "<br />Ergebnisse:<br />";
while($rows2=mysql_fetch_object($result2)){
  $seite = $rows2->seite;
               $sql2="SELECT * FROM seiten where id = '$seite'";
            $result3=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result3)) {
            $rows3=mysql_fetch_array($result3);
        }
    echo '- <a href="index.php?seite=';
    echo $rows3['name'];
    echo '">';
    echo $rows3['name'];
    echo '</a><br />';
   } 
    
}
else
{
    echo "<br />Keine &Uuml;bereinstimmung gefunden!";
}


}
?>