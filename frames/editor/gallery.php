<?php
session_start();
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>                                                                                                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script>
		!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
	</script>
	<script type="text/javascript" src="frames/apps/gallery/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="frames/apps/gallery/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="frames/apps/gallery/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
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


     // Alle User modus
     include ("gisecms/include/mysql.php");
     {
       $sql2="SELECT * FROM gallery where seite = '$con_id'";
            $result2=mysql_query($sql2)
            or die ("MySQL-Fehler: " . mysql_error());
            if(mysql_num_rows($result2)) {
            while($rows2=mysql_fetch_array($result2))
             {
            echo '<a rel="example_group" href="'.$rows2['link'].'" title="'.$rows2['text'].'"><img alt="" src="'.$rows2['link'].'" height="100px" border="1px" style="margin: 5px; border-color: black"/></a>';
             }
    }
    }
    
?>