<?php 
session_start();

error_reporting(0);

// Pfad suchen
$_SESSION['pfad'] = dirname($_SERVER['PHP_SELF']);
// Sprache suchen
include ("include/mysql.php");
 if(@mysql_query("SELECT * FROM login")) 
    {

if (!isset($_SESSION['lang']))
{
               $sql2="SELECT * FROM lang where standart = 1";
            $result2=@mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(@mysql_num_rows($result2)) {
            $rows2=@mysql_fetch_array($result2);
    $_SESSION['lang'] = $rows2['id'];
}
}
}
if ($_SESSION['status'] == true)
{
 header ("Location: backend.php");
}
 ?>
 <html>
 <head>
 <title>GiseCMS Login</title>
<style type="text/css">
body {
padding: 20px;
margin: 0;
text-align: center; }
.Content {
height: 230px;
background-color: #F8F8FA;
border: 1px solid #444;
position: relative;
width: 300px;
top: 50px;
z-index: 0;
margin: 0 auto;
padding: 10px;
text-align: left;
}



</style>
<link rel="shortcut icon" href="include/bereich/favicon.ico" type="image/x-icon"> 
 
</head>
<body>
<div class="content">
<?php
include ("include/mysql.php");
 if(@mysql_query("SELECT * FROM login")) 
{ ?>
<p align="left">GiseCMS Backend Login </p>
<?php 

 if ($_REQUEST['fehler'] == 1)
     {
         echo '<font color="FF0000">Falsche Eingabe!</font>';
     }

 ?>
 <form action="login.php" method="post">
 <table cellpadding="0" cellspacing="0" class="tl_login_table" summary="Input fields">
  <tr>
    <td><label for="username">Benutzername:&nbsp;</label></td>
    <td align="right"><input type="text" name="name" size="20" /></td>
  </tr>
  <tr>
    <td><label for="password">Passwort:</label></td>
    <td align="right"><input type="password" name="passwort" size="20" /></td>
  </tr>
</table>
<input type="submit" value="Anmelden">

                                                                           
</form><br /> 
<?php  if ($_REQUEST['fehler'] == 4)
     {
         echo '<font color="FF0000">Datenbank darf nicht ge&auml;ndert werden!</font>';
     }
     ?> <br /><?php  
}             
else
{
    echo '<p align="left">GiseCMS </p>';
    echo '<a href="../installieren/index.php">GiseCMS installieren.</a> <br />';
    echo '<a href="mySQL/index.php">Datenbank &auml;ndern oder mit Sicherung bespielen.</a> <br />';
}

?>

</div>
</body>
</html>