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
session_start();
?>


<?php
    unset($_SESSION);
    session_destroy();
    session_write_close();
    echo "<meta http-equiv=\"refresh\" content=\"0;url=../../intern/backend/sites/index.php\">";
    die;
?>