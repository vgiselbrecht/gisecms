<?php

error_reporting(0);

if ($_POST['name'] == NULL OR $_POST['passwort'] == NULL OR $_POST['passwort2'] == NULL)
{
    header ("Location: anmelden.php?fehler=1");
}
if ($_POST['passwort'] != $_POST['passwort2'])
{
   header ("Location: anmelden.php?fehler=2");  
}


$benutzer[0]["name"] = $_POST['name'];
$benutzer[0]["passwort"] =$_POST['passwort'];
$benutzer[0]["na"] = "startseite";
$benutzer[0]["info"] = "";



include ("../gisecms/include/mysql.php");
{
// Tabelle login erstellen
$sql = "CREATE TABLE login (
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(80) NOT NULL,
        passwort VARCHAR(80) NOT NULL)";

// Benutzerdaten hinzufügen
if(!mysql_query($sql))
    {
    header ("Location: anmelden.php?fehler=3");
    }
$sql = "CREATE TABLE template (
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(80) NOT NULL,
        css text NOT NULL,
        code text NOT NULL)";

// Benutzerdaten hinzufügen
if(!mysql_query($sql))
    {
    header ("Location: anmelden.php?fehler=3");
    }
    
$sql = "CREATE TABLE seiten (
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(80) NOT NULL,
        template VARCHAR(80) NOT NULL,
        menu1 VARCHAR(80) NOT NULL,
        menu2 VARCHAR(80) NOT NULL )";

// Benutzerdaten hinzufügen
if(!mysql_query($sql))
    {
    header ("Location: anmelden.php?fehler=3");
    
    } 
$sql = "CREATE TABLE content (
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        seite VARCHAR(80) NOT NULL,
        type VARCHAR(80) NOT NULL,
        position text NOT NULL,
        public VARCHAR(80) NOT NULL,
        lang VARCHAR(80) NOT NULL,
        text text NOT NULL 
        )
        ";

// Benutzerdaten hinzufügen
if(!mysql_query($sql))
    {
    header ("Location: anmelden.php?fehler=3");
    }
    
$sql = "ALTER TABLE content ENGINE = MYISAM";

// Benutzerdaten hinzufügen
if(!mysql_query($sql))
    {
    header ("Location: anmelden.php?fehler=3");
    }
    

$sql = "CREATE TABLE zusatz (
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(80) NOT NULL,
        info VARCHAR(80) NOT NULL)";

// Benutzerdaten hinzufügen
if(!mysql_query($sql))
    {
    header ("Location: anmelden.php?fehler=3");
    }       

$sql = "CREATE TABLE gallery (
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        seite VARCHAR(80) NOT NULL,
        text text NOT NULL,
        link text NOT NULL)";

// Benutzerdaten hinzufügen
if(!mysql_query($sql))
    {
    header ("Location: anmelden.php?fehler=3");
    }
    
$sql = "CREATE TABLE menu1 (
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        template_id VARCHAR(80) NOT NULL,
        menu_nr VARCHAR(80) NOT NULL,
        css text NOT NULL,
        vor text NOT NULL,
        nach text NOT NULL,
        class text NOT NULL,
        code text NOT NULL)";

// Benutzerdaten hinzufügen
if(!mysql_query($sql))
    {
    header ("Location: anmelden.php?fehler=3");
    }    
$sql = "CREATE TABLE menu_zustande (
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        template_id VARCHAR(80) NOT NULL,
        menu_nr VARCHAR(80) NOT NULL,
        name text NOT NULL)";

// Benutzerdaten hinzufügen
if(!mysql_query($sql))
    {
    header ("Location: anmelden.php?fehler=3");
    }
$sql = "CREATE TABLE menupunkte (
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        zustand_id VARCHAR(80) NOT NULL,
        name VARCHAR(80) NOT NULL,
        position VARCHAR(80) NOT NULL,
        lang VARCHAR(80) NOT NULL,
        link text NOT NULL,
        einruckung VARCHAR(80) NOT NULL)";

if(!mysql_query($sql))
    {
    header ("Location: anmelden.php?fehler=3");
    }
$sql = "CREATE TABLE lang (
        id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(80) NOT NULL,
        kurz VARCHAR(80) NOT NULL,
        standart VARCHAR(80) NOT NULL)";

// Benutzerdaten hinzufügen
if(!mysql_query($sql))
    {
    header ("Location: anmelden.php?fehler=3");
    }        
       
$sql = "SELECT ".
    "name, id, passwort".
  "FROM ".
    "login ".
  "WHERE ".
    "(name like '".$_REQUEST["name"]."')";
$result = mysql_query ($sql);


 

// Zuerst alle Datensätze löschen um keine Dopplungen zu bekommen.
// mysql_query ("DELETE FROM benutzerdaten");

// Daten eintragen
while (list ($key, $value) = each ($benutzer))
{
  // SQL-Anweisung erstellen
  $sql = "INSERT INTO ".
    "login (name, passwort) ".
  "VALUES ('".$value["name"]."', '".
                       md5 ($value["passwort"])."')";
  mysql_query ($sql);
  
   $sq = "INSERT INTO ".
    "zusatz (name, info) ".
  "VALUES ('".$value["na"]."', '".
                       $value["info"]."')";
  mysql_query ($sq); 
  
     $sql1 = "INSERT INTO ".
    "lang (name, kurz, standart) ".
  "VALUES ('Deutsch', 'de', True)";
  mysql_query ($sql1);
  
       $sql2 = "INSERT INTO ".
    "lang (name, kurz) ".
  "VALUES ('English', 'en')";
  mysql_query ($sql2);

  if (!mysql_affected_rows ($connectionid) > 0)
    {
  header ("Location: anmelden.php?fehler=3");
    }
    else
    {
    header ("Location: ../gisecms/index.php");
    }
}
   }
      
       
       
        
        
        
        

?>