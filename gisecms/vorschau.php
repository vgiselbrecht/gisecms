<?php
include ("include/status.php");

if (isset($_REQUEST['seite']))
{
   header ("Location: ../index.php?seite=".$_REQUEST['seite']."");  
}
else
{
  header ("Location: ../index.php");   
}



?>