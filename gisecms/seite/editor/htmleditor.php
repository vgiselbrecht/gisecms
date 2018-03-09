<?php
session_start();

?>
<script language="javascript" type="text/javascript" src="../../frames/apps/edit_area/edit_area_full.js"></script>
    <script language="javascript" type="text/javascript">
    editAreaLoader.init({
	id : "textarea_1"		// textarea id
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
$file = $_REQUEST['id']; 

if ($_SESSION['status'] == true)
{
if (isset($_REQUEST["text"]))
{
    if ($_REQUEST["text"] == 2)
    {
      $inhalt = $_POST["elm1"];
include ("../include/mysql.php");
    {
     $aendern = "UPDATE content Set
    text = '$inhalt'
    WHERE id = '$file'";
    $update = mysql_query($aendern);

    }
    }
  
    if ($_REQUEST["text"] == 2 )
    {
     echo '<a href="content.php?id='.$file.'">Text ver&auml;ndern:</a><hr /><br />';
include ("include/textphp.php");
echo '<br />';
    }
    
    
    }
    else
        { 
     ?>
      <form method="post" action=content.php?id=<?php echo $file?>&text=2>


		<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
		<div>

			<textarea id="textarea_1" name="elm1" rows="15" cols="80" style="width: 80%">
            <?php
include ("include/text.php");
                 ?>
			</textarea>
		</div>


   <input type="submit" value="Speichern">
</form>
<?php
    }
    }
    else
    {
    include ("include/textphp.php");
    }

?>