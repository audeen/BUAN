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


/* // Vorbelegung für den Zugriff auf den Internetserver
$host  = "localhost";
$user  = "root";
$pass  = "";
$dbase = "sievert"; */

$db = 'mysql:host=localhost;dbname=sievert;charset=utf8';
$pdo = new PDO($db, 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


include('language_config.php');
?> 