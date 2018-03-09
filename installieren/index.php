<?php error_reporting(0); ?>
 <html>
 <head>
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
width: 350px;
top: 50px;
z-index: 0;
margin: 0 auto;
padding: 10px;
text-align: left;
}



</style>


</head>
<body>
<div class="content">
MySQL Einstellungen<br /><br />
 <?php 
 if ($_REQUEST['fehler'] == 1)
     {
         echo '<font color="FF0000">Sie m&uuml;ssen alle Felder Ausf&uuml;llen!</font>';
     }
 if ($_REQUEST['fehler'] == 2)
     {
         echo '<font color="FF0000">Datenbank ist nicht erreichbar!</font>';
     }
  ?>
 
<form action="datenbank.php" method="post">
 <table cellpadding="0" cellspacing="0" class="tl_login_table" summary="Input fields">
  <tr>
    <td><label for="username">Addresse:&nbsp;</label></td>
    <td align="right"><input type="text" name="addresse" size="20" /></td>
    <td><label for="username">(z.B.: localhost) </label></td>
  </tr>
  <tr>
    <td><label for="username">Benutzer: </label></td>
    <td align="right"><input type="text" name="benutzer" size="20" /></td>
    <td><label for="username">(bei xampp root) </label></td>
  </tr>
    <tr>
    <td><label for="username">Passwort: </label></td>
    <td align="right"><input type="password" name="passwort" size="20" /></td>
    <td><label for="username">(darf leer bleiben) </label></td>
  </tr>
    <tr>
    <td><label for="username">Datenbank:&nbsp;</label></td>
    <td align="right"><input type="text" name="datenbank" size="20" /></td>
    <td><label for="username"> </label></td>
  </tr>
</table>
<input type="submit" value="Weiter"> 
</form>
</div>
</body>
</html>                             