<?php
session_start();


if ($_SESSION['status'] == true)
{
if (isset($_REQUEST["bilder"]))
{
    if ($_REQUEST["bilder"] == 2)
    {
    // header datenbank andern

    }

    if ($_REQUEST["bilder"] == 1)
     {
     // config modus


     }


    if ($_REQUEST["bilder"] == 2 )
    {
      // body wenn datenbank verändert wird


    }
    }
    else
        {
        // start modus

    }
    }
    else
    {
     // Alle User modus

    }

?>