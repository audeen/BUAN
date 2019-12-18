<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   authentification.php           //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Login/Blocked-Abfrage        //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

 
//Prüfen, ob der User eingeloggt ist

if(!isset($_SESSION['user_id_r']) || !isset($_SESSION['logged_in'])){
  //Nicht eingeloggt? Dann weiterleiten zur Startseite
  echo "<meta http-equiv=\"refresh\" content=\"0;url=../../../sites/index.php\">";
  exit;
}

?>