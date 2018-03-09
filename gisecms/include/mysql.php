<?php
    $datenbankname = "gisecms"; 
    $connectionid = @mysql_connect ("localhost", "root", ""); 
    if (@mysql_select_db ("gisecms", $connectionid))
     ?>