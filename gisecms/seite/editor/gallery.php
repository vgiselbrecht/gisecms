<?php
session_start();
$id = $_REQUEST['id'];

if ($_REQUEST['bilder'] == 1)
{
?>
 
<style type="text/css">

#kcfinder_div {
    display: none;
    position: absolute;
    width: 670px;
    height: 400px;
    background: #e0dfde;
    border: 2px solid #3687e2;
    border-radius: 6px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    padding: 1px;
}

</style>
 
<script type="text/javascript">

function openKCFinder(field) {
    var div = document.getElementById('kcfinder_div');
    if (div.style.display == "block") {
        div.style.display = 'none';
        div.innerHTML = '';
        return;
    }
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            field.value = url;
            div.style.display = 'none';
            div.innerHTML = '';
        }
    };
    div.innerHTML = '<iframe name="kcfinder_iframe" src="../../frames/apps/filemanager/browse.php?type=image&dir=image/public" ' +
        'frameborder="0" width="100%" height="100%" marginwidth="0" marginheight="0" scrolling="no" />';
    div.style.display = 'block';
}
    </script> 
<?php
}
else
{
?>

<script type="text/javascript">function openKCFinder(field) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            field.value = url;
        }
    };
    window.open('../../frames/apps/filemanager/browse.php?type=image&dir=image/public', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}</script>
<?php
}
?>

 





<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>                                                                                                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script>
		!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
	</script>
	<script type="text/javascript" src="../../frames/apps/gallery/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="../../frames/apps/gallery/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="../../frames/apps/gallery/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
		});
	</script>
<?php 
if (isset($_REQUEST["bilder"]))
{
   if ($_REQUEST["bilder"] == 1)
    {
     echo "Neues Bild";
     echo '<form action="content.php?bilder=2&id='.$id.'&andern=2" method="post">';
    echo 'Link: <input type="text" name="link" readonly="readonly" onclick="openKCFinder(this)" style="width:300px"/><br /><div id="kcfinder_div"></div>';
    echo 'Text: <input type="text" name="text" style="width:300px""/><br />';  
    echo '<input type="submit" value="Erstellen" name="button"></form>';    
        
    }
    if ($_REQUEST["bilder"] == 2 AND $_REQUEST["andern"] == 1)
            // header datenbank andern
    {
    if(isset($_REQUEST['loschen']))
    {
    $id2 = $_REQUEST['bild_id'];
    $loeschen = "DELETE FROM gallery
    WHERE id= '$id2' LIMIT 1";
    $loesch = mysql_query($loeschen);   
    }
    else
    {
    $link = $_POST['link'];
    $text = $_POST['text'];
    $id2 = $_REQUEST['bild_id'];
        include ("../include/mysql.php");
        {
         $aendern = "UPDATE gallery Set
        text = '$text',link = '$link'
        WHERE id = '$id2'";
        $update = mysql_query($aendern);
        
         }

    }
    }
    if ($_REQUEST["bilder"] == 2 AND $_REQUEST["andern"] == 2)
    {


    $benutzer[0]["link"] = $_POST['link'];
    $benutzer[0]["text"] = $_POST['text'];
    $benutzer[0]["seite"] = $id;
    
    while (list ($key, $value) = each ($benutzer))
        {
          $sql = "INSERT INTO ".
        "gallery (seite, link, text) ".
        "VALUES ('".$value["seite"]."', '".
                    $value["link"]."', '".
                       $value["text"]."')";
  mysql_query ($sql);
    }
        
    }

    if ($_REQUEST["bilder"] == 2 )
    {
      // body wenn datenbank verändert wird
               include ("../include/mysql.php");
     {
     echo '<a href="content.php?id='.$id.'&bilder=1">Neues Bild:</a><hr /><br />';
       $sql2="SELECT * FROM gallery where seite = '$id'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            while($rows2=mysql_fetch_array($result2))
             {
            echo '<a rel="example_group" href="'.$rows2['link'].'" title="'.$rows2['text'].'"><img alt="" src="'.$rows2['link'].'" height="100px" border="none" style="margin: 1px;"/></a>';
            echo '<form action="content.php?bild_id='.$rows2['id'].'&bilder=2&id='.$id.'&andern=1" method="post">';
            echo 'Link: <input type="text" name="link" value="'.$rows2['link'].'" readonly="readonly" onclick="openKCFinder(this)" style="width:300px"/><br />';
            echo 'Text: <input type="text" name="text" value="'.$rows2['text'].'" style="width:300px"/><br />';
            echo '<input type="submit" value="&Auml;ndern" name="button"><input type="submit" value="L&ouml;schen" name="loschen"></form><br />';
             }
            
    }
    }


    }
    }
    else
        {
      // body wenn datenbank verändert wird
               include ("../include/mysql.php");
     {
     echo '<a href="content.php?id='.$id.'&bilder=1">Neues Bild:</a><hr /><br />';
       $sql2="SELECT * FROM gallery where seite = '$id'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            while($rows2=mysql_fetch_array($result2))
             {
            echo '<a rel="example_group" href="'.$rows2['link'].'" title="'.$rows2['text'].'"><img alt="" src="'.$rows2['link'].'" height="100px" border="none" style="margin: 1px;"/></a>';
            echo '<form action="content.php?bild_id='.$rows2['id'].'&bilder=2&id='.$id.'&andern=1" method="post">';
            echo 'Link: <input type="text" name="link" value="'.$rows2['link'].'" readonly="readonly" onclick="openKCFinder(this)" style="width:300px"/><br />';
            echo 'Text: <input type="text" name="text" value="'.$rows2['text'].'" style="width:300px"/><br />';
            echo '<input type="submit" value="&Auml;ndern" name="button"><input type="submit" value="L&ouml;schen" name="loschen"></form><br />';
             }

    }
    }


    }
?>