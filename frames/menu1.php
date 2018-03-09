<?php
   $zahl = 1;
     $lang = $_SESSION['lang']; 
    $sql2="SELECT * FROM seiten where name = '$name'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
         if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
       $zustand =  $rows2['menu1'];

 }
    $sql2="SELECT * FROM menu1 where template_id = '$tem_id' AND menu_nr = '1'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
         if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
       $code =  $rows2['code']; 
       $css =  $rows2['css'];
       $vor =  $rows2['vor'];
       $nach = $rows2['nach'];
       $class =  $rows2['class'];
} 
$abfrage = "SELECT * FROM menupunkte WHERE zustand_id = '$zustand' AND lang = '$lang' ORDER BY position";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
if ($zahl == 1)
    {
     echo $vor;
        $zahl = 2;
    }
    else
    {
         echo $code;
    }
    echo '<a href="'.$row->link.'" style="'.$css.'" class="'.$class.'">';
    echo $row->name;
    echo "</a>";

}
if ($zahl == 2)
{
 echo $nach;   
}

$zahl = NULL;
$code = NULL;
$css = NULL;
$vor = NULL;
$nach = NULL;
$class = NULL;
?>