<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
 <head>
 <title>GiseCMS Backend</title>
<style type="text/css">
body { 
padding: 20px; 
margin: 0; 
text-align: center; } 

a { color:#000000; text-decoration:none; }
a:link {  text-decoration:none; }
a:visited { text-decoration:none; }
a:hover { color: #800000; text-decoration:none; }
a:active { text-decoration:none; }
a:focus {  text-decoration:none; }
.oben {
height: 20px;
background-color: #C9C9C9;
border: 1px solid #444;
position: relative;
z-index: 0;
width: 800px;
top: 5px;
margin: auto;
padding: 10px;
text-align: left;
font-size: medium;
}
.menu {
height: 25px ;
background-color: #FF9900;
border: 1px solid #444;
position: relative;
z-index: 0;
width: 800px;
top: 30px;
margin: 0 auto;
padding: 10px;  
text-align: left;
font-family: Verdana;
}
.content {
min-height: 500px ;
height:auto !important;  /* für moderne Browser */
height:500px;  /*für den IE */
background-color: #ECECEC;
border: 1px solid #444;
position: relative;
z-index: 0;
width: 800px;
top: 30px;
margin: 0 auto;
padding: 10px;
text-align: left;
font-family: Arial;
}
</style>

<link rel="shortcut icon" href="<?php echo $_SESSION['pfad']; ?>/include/bereich/favicon.ico" type="image/x-icon">
</head>
<body>
<div class="oben">
<div style="float: left">
<img src="<?php echo $_SESSION['pfad']; ?>/include/bereich/GiseCMS_Schrift.png" height="30px"/>
</div>
<div style="float: right">
<a href="<?php echo $_SESSION['pfad']; ?>/vorschau.php" target="_blank">Frontend Vorschau</a>
</div>
</div>
<div class="menu">
<div style="float:left">
<a href="<?php echo $_SESSION['pfad']; ?>/seite.php">Seiten</a>&nbsp;&nbsp;|&nbsp;
<a href="<?php echo $_SESSION['pfad']; ?>/template.php">Templates</a>&nbsp;&nbsp;|&nbsp;
<a href="<?php echo $_SESSION['pfad']; ?>/anwendungen.php">Anwendungen</a>&nbsp;&nbsp;|&nbsp;
<a href="<?php echo $_SESSION['pfad']; ?>/einstellungen.php">CMS Einstellungen</a>&nbsp;&nbsp;|&nbsp;
<a href="<?php echo $_SESSION['pfad']; ?>/logout.php">Logout</a>
</div>
<div style="float:right">
GiseCMS 0.4.3.3
</div>
</div>
<div class="content">



