<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname    : config.php                   //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung :                              //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 07.10.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////


// Vorbelegung für den Zugriff auf den Internetserver
$host    = "localhost";
$user    = "root";
$pass    = "";
$dbase   = "sievert";

// Verbindung zu Server und Datenbank aufnehmen
/* $db_link = mysqli_connect($host,$user,$pass);
$con = mysqli_select_db($db_link, $dbase);
 */

$pdo = new PDO('mysql:host=localhost;dbname=sievert', 'root', '');
// Frontend Zeichensatz festlegen
header('content-type:text/html; charset=ISO-8859-1');

// Default CSS
echo "<link rel=\"stylesheet\" href=\"../css/default.css\" type=\"text/css\">";

?>