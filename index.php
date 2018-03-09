<?php 
session_start();

error_reporting(0);

// Kontrolle der Datenbank
include ("gisecms/include/mysql.php");
if(!@mysql_query("SELECT * FROM login"))
{
 header ("Location: gisecms/index.php");
}
// Schauen ob Sprache mitkommt
if (isset($_REQUEST['lang']))
{   
$kurz = $_REQUEST['lang'];
    $sql2="SELECT * FROM lang where kurz = '$kurz'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
    $_SESSION['lang'] = $rows2['id'];
}
}
// Bowser Sprache herausfinde



// Stndart Frontensprache herausfinde
if (!isset($_SESSION['lang']))
{
$long_lang = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
list($kurz) = split('[,.-]', $long_lang);

               $sql2="SELECT * FROM lang where kurz = '$kurz'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
    $_SESSION['lang'] = $rows2['id'];
}
else
{
               $sql2="SELECT * FROM lang where standart = 1";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
    $_SESSION['lang'] = $rows2['id'];
    
}
}
}




if (isset($_REQUEST['seite']))
 {
  $name = $_REQUEST['seite'];
  switch ($name) {
    case 'cms':
     header ("Location: gisecms/index.php");
     break;
     case 'install':
    header ("Location: installieren/index.php");
    break;
   }
 }
 else
 {
include ("gisecms/include/mysql.php");
                {
               $sql2="SELECT * FROM zusatz where name = 'Startseite'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
}

} 
  $name = $rows2['info'];
         
 }

  include ("gisecms/include/mysql.php");
{
$sql = "SELECT ".
    "id, name, template ".
  "FROM ".
    "seiten ".
  "WHERE ".
    "(name like '".$name."')";
$result = mysql_query ($sql);
if (mysql_num_rows($result) > 0)
{
  $data = mysql_fetch_array ($result);
  $template = $data["template"];
  $id = $data["id"];
   }
   else
   {
   if ($name != "cms" AND $name != "install")
    {
       header ("Location: index.php?fehler=".$name."");
      // echo 'Seite kann nicht gefunden werden!<br /><a href="/index.php">Zur Startseite</a>';
     } 
   }
   
    
}

  


$sql = "SELECT ".
    "id, name, css, code ".
  "FROM ".
    "template ".
  "WHERE ".
    "(name like '".$template."')";
$result = mysql_query ($sql);
if (mysql_num_rows($result) > 0)
{
  $data = mysql_fetch_array ($result);
    $css = $data["css"];
  $code = $data["code"];
  $tem_id = $data["id"];
   }

  
      
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
 <!-- GiseCMS by Valentin Giselbrecht www.gisecms.tk -->

<html>
<head>


<meta http-equiv="expires" content="<?php echo $name; ?>">
<title><?php echo $name; ?></title>
<?php echo $css; ?>


</head>
<?php 
if ($_SESSION['status'] == True) {
// größe verändern
if ($_REQUEST['leiste'] == 'auf')
{
    $_SESSION['leiste'] = FALSE;
}
if ($_REQUEST['leiste'] == 'zu')
{
    $_SESSION['leiste'] = TRUE;
}

// Unveröffentliche Beiträge auswahl 
if ($_REQUEST['public'] == 'nein')
{
$_SESSION['public'] = FALSE;    
}
if ($_REQUEST['public'] == 'ja')
{
$_SESSION['public'] = TRUE;
}

// Artikel Veröffentlichen
$id_con = $_REQUEST['con'];
if ($_REQUEST['ver'] == 'nein')
{
        $neu = "UPDATE content Set
        public = 'no'
        WHERE id = '$id_con'";
        $up = mysql_query($neu);    
}
if ($_REQUEST['ver'] == 'ja')
{
        $neu = "UPDATE content Set
        public = Null
        WHERE id = '$id_con'";
        $up = mysql_query($neu);
}
}

if ($_SESSION['status'] == True) { ?>
<body scroll="no">
<?php 
if ($_SESSION['leiste'] == FALSE) {
 ?>
<div id="menu" style="
position:absolute; 
background-color:#FFFFAA; 
color:#000000; 
width:*; height:25px; 
z-index: 9999;
right:20px; 
left:20px;
border: 1px solid #444; 
text-align: center;
text-decoration:none;
a-color:red;
 ">
       
    <div style="float: right;">
    <a href="index.php?seite=<?php echo $name; ?>&leiste=zu"><img src="gisecms/images/minimize.png" title="Verkleinern" border="none"/></a>
    </div>
    
    <div style="float:right; ">
     <?php  if ($_SESSION['public'] == TRUE) {?>
    <input  type="button" value="Edition Ausschalten" onclick="window.location.replace('index.php?seite=<?php echo $name; ?>&public=nein')" /></a> 
    <?php } else { ?>
        <input  type="button" value="Edition Einschalten" onclick="window.location.replace('index.php?seite=<?php echo $name; ?>&public=ja')" /></a>
        <?php } ?>  
    <input  type="button" value="Aktualisieren" onclick="window.location.replace('index.php?seite=<?php echo $name; ?>')" /></a>
    
    
    <SELECT ONCHANGE="window.open(this.options[this.selectedIndex].value,'_blank')">
    <option >Auswahl</option>
    <option value="gisecms/index.php" >Backend</option>
    <option value="gisecms/seite/conf.php?k=<?php echo $id; ?>" >Seite &auml;ndern</option>
    <option value="gisecms/template/andern.php?nam=<?php echo $template; ?>" >Template &auml;ndern</option>
    <option value="gisecms/logout.php" >Logout</option>
</SELECT>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>

</div>
<?php 
}
else
{
?>
<div id="menu" style="padding:none; margin:none; position:absolute; color:#000000;  height:25px; z-index: 9999; margin-left:95%; border: 1px solid #444; right:20px; " >
<a href="index.php?seite=<?php echo $name; ?>&leiste=auf"><img src="gisecms/images/minimize.png" title="Vergr&ouml;&szlig;ern" border="none" /></a>
</div>
<?php     
}
 ?>
<div style="height:100%; width:100%; overflow-y:auto; ">
<?php
}
else
{
?>
<body>

<?php    
}


$handle = fopen ("gisecms/template/text.php", w);
fwrite ($handle, $code);
fclose ($handle);

// Sprachen in Template Sprachen Kürzel abfrage
$lang_id = $_SESSION['lang'];
$sql2="SELECT * FROM lang where id = '$lang_id'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
    $lang = $rows2['kurz'];
 }
include ("gisecms/template/text.php");

 ?>
 <?php if ($_SESSION['status'] == True) { ?>
 </div>
 <?php } ?>
</body>
</html>