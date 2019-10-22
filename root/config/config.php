<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname    : config.php                   //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : stellt DB-Verbindung her     //
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
/* $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);  */



?>