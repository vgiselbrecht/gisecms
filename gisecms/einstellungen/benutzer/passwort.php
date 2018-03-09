<?php
session_start();
include ("../../include/status.php");
    include ("../../include/mysql.php");

switch ($_REQUEST['f']) {
 case 1:
 
   $passwort = md5($_POST['passwort']);
  $altpasswort = md5($_POST['altpasswort']);
  $id = $_REQUEST['id'];
 
   if ($_POST['altpasswort'] == NULL OR $_POST['passwort'] == NULL OR $_POST['passwort2'] == NULL)
{
    header ("Location: passwort.php?fehler=1&id=".$id."");
    exit();
}
if ($_POST['passwort'] != $_POST['passwort2'])
{
   header ("Location: passwort.php?fehler=2&id=".$id."");
   exit();
}

  // Passwort ändern



        // Ob Passowrt richtig ist

               $sql2="SELECT * FROM login where id = '$id'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
             if (isset($rows2['passwort']))
            {

                      if ($altpasswort == $rows2['passwort'])
                        {
                                 $sql = "UPDATE
                    `login`
                SET
                    `passwort` = '".$passwort ."'
                WHERE
                    `id` = ".$_SESSION["user_id"]; //es folg der mötige sql syntax
        $result = mysql_query($sql) or die('cannot change password:<br>'.mysql_error()); // mit eintragen ind die db
                        }
                        else
                        {
                        header ("Location: passwort.php?fehler=3&id=".$id."");
                        exit();
                        }
            }
            else
            {
             header ("Location: passwort.php?fehler=4&id=".$id."");
             exit();
            }
             header ("Location: conf.php?id=".$id."");
             exit();
                  }


    break;
  }    
include("../../include/bereich/1.php");
if ($_REQUEST['fehler'] == 1)
     {
         echo '<font color="FF0000">Sie m&uuml;ssen alle Felder Ausf&uuml;llen!</font><br />';
     }
 if ($_REQUEST['fehler'] == 2)
     {
         echo '<font color="FF0000">Die Passw&ouml;rter sind nicht &uuml;berein.</font><br />';
     }
 if ($_REQUEST['fehler'] == 3)
     {
         echo '<font color="FF0000">Falsches Passwort!</font><br />';
     }

    ?>
    <font size="4px">Passwort &Auml;ndern:</font><br /><br />
<form action="passwort.php?f=1&id=<?php echo $_REQUEST['id']; ?>" method="post">
<table cellpadding="0" cellspacing="0" summary="Input fields">
<tr>
    <td><label for="username">Altes Passwort:&nbsp;</label></td>
    <td align="right"><input type="password" name="altpasswort" size="20" /></td>
  </tr>
  <tr>
    <td><label for="password">Neues Passwort:</label></td>
    <td align="right"><input type="password" name="passwort" size="20" /></td>
  </tr>
    <tr>
    <td><label for="password">Neues Passwort(Wiederholen):</label></td>
    <td align="right"><input type="password" name="passwort2" size="20" /></td>
  </tr>
</table>
<input type="submit" value="Speichern">
<hr />
<a href="conf.php?id=<?php $_REQUEST['id']; ?>">Zur&uuml;ck</a>
</form>
<?php include("../../include/bereich/2.php");   ?>