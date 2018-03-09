<?php
include ("../../include/status.php");
include ("../../include/mysql.php");
{

// Inhalt ändern
if ($_REQUEST['f'] == 1)
{
 if ($_REQUEST['exist'] == "nein")
    {
    // Inahlt neu machen
        $code = $_POST['code'];
        $css = $_POST['css'];
        $id = $_REQUEST['id'];
        $vor =  $_REQUEST['vor'];
        $nach =  $_REQUEST['nach'];
        $class = $_REQUEST['class'];
        $menu = $_REQUEST['menu'];

          $sql = "INSERT INTO ".
            "menu1 (template_id, menu_nr, css, code, vor, nach, class) ".
            "VALUES ('".$id."', '".
                             $menu."', '".
                                    $css."', '".
                                    $code."', '".
                                    $vor."', '".
                                    $nach."', '".
                                        $class."')";
             mysql_query ($sql);
    } 
    else
    {
    // Inahlt ändern
    $css = $_POST['css'];
    $code = $_POST['code'];
    $vor =  $_REQUEST['vor'];
    $nach =  $_REQUEST['nach'];
    $class = $_REQUEST['class'];
    $id = $_REQUEST['menu_id'];
 
      // Inahlt ändern
     $neu = "UPDATE menu1 Set
    css = '$css',code = '$code',vor = '$vor',nach = '$nach',class = '$class'
    WHERE id = '$id'";
    $up = mysql_query($neu);
    }  
}
}
include("../../include/bereich/1.php");
?>
<script language="javascript" type="text/javascript" src="../../../frames/apps/edit_area/edit_area_full.js"></script>
    <script language="javascript" type="text/javascript">
    editAreaLoader.init({
	id : "css"		// textarea id
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
	id : "code"		// textarea id
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
</script>
<script language="javascript" type="text/javascript">
    editAreaLoader.init({
	id : "vor"		// textarea id
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
</script>
<script language="javascript" type="text/javascript">
    editAreaLoader.init({
	id : "nach"		// textarea id
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
</script>
<script language="javascript" type="text/javascript">
    editAreaLoader.init({
	id : "class"		// textarea id
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
<?php 
$template_id = $_REQUEST['id'];
$menu_nr = $_REQUEST['menu'];
include ("../../include/mysql.php");
{            
// Inhalt abfragen
               $sql2="SELECT * FROM menu1 where template_id = '$template_id' AND menu_nr = '$menu_nr'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            $rows2=mysql_fetch_array($result2);
                $css = $rows2['css'];
                $code = $rows2['code'];
                $vor = $rows2['vor'];
                $nach = $rows2['nach'];
                $class = $rows2['class'];
                $exist = "ja";
                $menu_id =  $rows2['id'];
                }
                else
                {
                    $exist = "nein";
                }
}
 ?>
<form action="conf.php?f=1&id=<?php echo $template_id; ?>&menu=<?php echo $menu_nr; ?>&exist=<?php echo $exist; ?>&menu_id=<?php echo $menu_id; ?>" method="post">
CSS Code f&uuml;r Men&uuml;<br />
<textarea id="css" name="css" rows="5" cols="94">
<?php echo $css; ?>
</textarea><br />
Code der zwischen den Men&uuml;punkten sein soll<br />
<textarea id="code" name="code" rows="1" cols="94" >
<?php echo $code; ?>
</textarea><br />
Code der vor den Men&uuml;punkten sein soll<br />
<textarea id="vor" name="vor" rows="1" cols="94" >
<?php echo $vor; ?>
</textarea><br />
Code der nach den Men&uuml;punkten sein soll<br />
<textarea id="nach" name="nach" rows="1" cols="94" >
<?php echo $nach; ?>
</textarea><br />
Class die dieses Men&uuml; haben soll.<br />
<textarea id="class" name="class" rows="1" cols="94" >
<?php echo $class; ?>
</textarea><br />
<input type="submit" value="Speichern">
</form>
<hr /><a href="../menu.php">Zur&uuml;ck</a>
<?php 
include("../../include/bereich/2.php");
?>