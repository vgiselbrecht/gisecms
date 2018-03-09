<?php
session_start();
include ("../include/status.php");
if ($_REQUEST['f'] == 1)
{

$benutzer[0]["name"] = $_POST['name'];
$benutzer[0]["css"] =$_POST['css'];
$benutzer[0]["code"] =$_POST['code'];
$temname = $_POST['name'];

$name = $_POST['name'];
$css = $_POST['css'];
$code = $_POST['code'];
$temname = $_POST['name'];

include ("../include/mysql.php");
{

$sql = "SELECT ".
    "name, id, css, code ".
  "FROM ".
    "template ".
  "WHERE ".
    "(name like '".$_POST["name"]."')";
$result = mysql_query ($sql);
if (mysql_num_rows ($result) > 0 AND $_POST['name'] != $_REQUEST['na'])
{
  header ("Location: andern.php?fehler=2&nam=".$_REQUEST['na']."");
}
else
{

//löschen
$wert = $_REQUEST['na'];

// umbenennen
     $neu = "UPDATE template Set
    name = '$name',css = '$css',code = '$code'
    WHERE name = '$wert'";
    $up = mysql_query($neu);
   header ("Location: ../template.php?richtig=2");


}
}
}
else
{

include ("../include/mysql.php");
{
$nam = $_REQUEST['nam'];
$abfrage = "SELECT * FROM template where name = '$nam'";
$ergebnis = mysql_query($abfrage);
$row = mysql_fetch_object($ergebnis);
$name = $row->name;
$code = $row->code;
$css = $row->css;
}
}
?>
<script language="javascript" type="text/javascript" src="../../frames/apps/edit_area/edit_area_full.js"></script>
    <script language="javascript" type="text/javascript">
    editAreaLoader.init({
	id : "textarea_1"		// textarea id
			,start_highlight: true
			,allow_toggle: false
			,language: "de"
			,syntax: "css"
			,toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
			,syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
			//,is_multi_files: true
			,EA_load_callback: "editAreaLoaded"
			,show_line_colors: true

});
</script>
<script language="javascript" type="text/javascript">
    editAreaLoader.init({
	id : "textarea_2"		// textarea id
			,start_highlight: true
			,allow_toggle: false
			,language: "de"
			,syntax: "html"
			,toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
			,syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
			//,is_multi_files: true
			,EA_load_callback: "editAreaLoaded"
			,show_line_colors: true

});
</script>
<?php include("../include/bereich/1.php"); ?>
<?php 



if ($_REQUEST['fehler'] == 1)
{
 echo '<font color="FF0000">Fehler beim erstellen.</font>';
}
if ($_REQUEST['fehler'] == 2)
{
 echo '<font color="FF0000">Template-Name ist schon vergeben.</font><br />';
}
?>

<font size="4px">Template &auml;ndern</font><br /><br />
<form action="andern.php?f=1&na=<?php echo $name; ?>" method="post">
Name des Templates: <input type="text" name="name" value="<?php echo $name; ?>" size="20" /><br />

Zus&auml;tzliche Head informationen( z.B. f&uuml;r CSS, kein ' verwenden) <br />
<textarea id="textarea_1" name="css" rows="15" cols="94" >
<?php echo $css; ?>
</textarea><br />
Body (ohne body deklarierung, kein ' verwenden) <br />
<textarea id="textarea_2" name="code" rows="30" cols="94">
<?php echo $code; ?>
</textarea><br />
<input type="submit" value="Speichern">
</form>
<hr />
<a href="../template.php">Zur&uuml;ck</a>
<?php include("../include/bereich/2.php"); ?>