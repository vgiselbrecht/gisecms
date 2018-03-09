<?php
session_start();
 ?>

<script type="text/javascript" src="../../frames/apps/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		    file_browser_callback: 'openKCFinder',
		mode : "textareas",
		theme : "advanced",
		convert_urls : false,
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "tinymcs/examples/css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "tinymcs/examples/lists/template_list.js",
		external_link_list_url : "tinymcs/examples/lists/link_list.js",
		external_image_list_url : "tinymcs/examples/lists/image_list.js",
		media_external_list_url : "tinymcs/examples/lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
	function openKCFinder(field_name, url, type, win) {
    tinyMCE.activeEditor.windowManager.open({
        file: '../../frames/apps/filemanager/browse.php?opener=tinymce&type=' + type,
        title: 'KCFinder',
        width: 700,
        height: 500,
        resizable: "yes",
        inline: true,
        close_previous: "no",
        popup_css: false
    }, {
        window: win,
        input: field_name
    });
    return false;
}
</script>
<?php

$file = $_REQUEST['id']; 

if ($_SESSION['status'] == true)
{
if (isset($_REQUEST["cms"]))
{
    if ($_REQUEST["cms"] == 2)
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
   
    if ($_REQUEST["cms"] == 2 )
    {
     echo '<a href="content.php?id='.$file.'">Text ver&auml;ndern:</a><hr /></html><br />';
include ("include/text.php");
    }
    
    
    }
    else
        {
?>
      <form method="post" action=content.php?id=<?php echo $file?>&cms=2>


		<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
		<div>

			<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%">
            <?php
include ("include/text.php");
                 ?>
			</textarea>
		</div>



</form>
<?php

    }
    }
    else
    {
include ("include/text.php");
    }

?>