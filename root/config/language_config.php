<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname    : config.php                   //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : konfiguriert language-switch //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 14.11.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

//Erstaufruf

if(!isset($_SESSION['language'])) {
   //Standard
   $_SESSION['language'] = 0;
}
else {
   $_SESSION['language'] = $_SESSION['language'];
}
//Änderung
if(isset($_POST['language'])){
   $_SESSION['language'] = $_POST['language'];
}

$lang_index_be = '../../language/index_be.php';
$lang_nav_be = '../../language/nav_be.php';
?>