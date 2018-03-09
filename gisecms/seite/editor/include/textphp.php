
<?php 
include ("../include/mysql.php");
                {
               $sql2="SELECT * FROM content where id = '$file'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
            }
            }
$code  = $rows2['text'];
$handle = fopen ("editor/include/code.php", w);
fwrite ($handle, $code);
fclose ($handle);

include ("editor/include/code.php");
 ?>