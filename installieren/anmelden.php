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
Anmeldedaten f&uuml;r GiseCMS.<br /><br />

<?php 

if ($_REQUEST['fehler'] == 1)
     {
         echo '<font color="FF0000">Sie m&uuml;ssen alle Felder Ausf&uuml;llen!</font>';
     }
 if ($_REQUEST['fehler'] == 2)
     {
         echo '<font color="FF0000">Die Passw&ouml;rter sind nicht &uuml;berein.</font>';
     }

      if ($_REQUEST['fehler'] == 3)
     {
         echo '<font color="FF0000">Fehler beim erstellen.</font>';
     }
 ?>



<form action="anmelden2.php" method="post">
 <table cellpadding="0" cellspacing="0" class="tl_login_table" summary="Input fields">
  <tr>
    <td><label for="username">Login Name:&nbsp;</label></td>
    <td align="right"><input type="text" name="name" size="20" /></td>
  </tr>
  <tr>
    <td><label for="username">Passwort: </label></td>
    <td align="right"><input type="password" name="passwort" size="20" /></td>
  </tr>
    <tr>
    <td><label for="username">Passwort Wiederholen:&nbsp;</label></td>
    <td align="right"><input type="password" name="passwort2" size="20" /></td>
  </tr>
</table>
<input type="submit" value="Weiter"> 

<!--  
Login Name: <input type="text" name="name" size="20" /><br />
Passwort: <input type="password" name="passwort" size="20" /><br />
Passwort Wiederholen: <input type="password" name="passwort2" size="20" /><br />
-->
</form> 
</div>
</body>
</html>                     