<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   logout.php                     //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Logout_page mit redirect     //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

?>


<?php
    session_start();
    unset($_SESSION);
    session_destroy();
    session_write_close();
    header('Location: ../../sites/index.php');
    die;
?>