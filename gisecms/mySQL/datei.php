<?php 
session_start();

if ($_SESSION['sicherung'] != 1)
 {
 header ("Location: /index.php");
 }

 ?>
<html>
 <head>
 <title>GiseCMS Login</title>
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
width: 650px;
top: 50px;
z-index: 0;
margin: 0 auto;
padding: 10px;
text-align: left;
}

</style>
<link rel="shortcut icon" href="/gisecms/include/bereich/favicon.ico" type="image/x-icon">

</head>
<body>
<div class="content">
<form action="upload.php" method="post" enctype="multipart/form-data">
<tr>Hier geben Sie die Sicherungs Datei ein, welche Sie verwenden wollen(Optional, nur gise Datei nich zip)<br /></tr>
<input name="datei" type="file" size="50"><br />
<input type="submit" value="Weiter">
</div>
</body>
</html>


