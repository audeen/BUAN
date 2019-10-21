<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   security.php                   //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Login/Blocked-Abfrage        //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

session_start();
 
//Prüfen, ob der User eingeloggt ist

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
  //User not logged in. Redirect them back to the login.php page.

  header('Location: ../../sites/index.php');
  exit;
}

?>