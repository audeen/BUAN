<?php


//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_update.php               //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Update admins zum Blockieren //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////


include('../../config/config.php');
// Wenn update gesetzt, stelle Datenbankverbindung her

if (isset($_POST['update'])) {
    try {
        $pdo;
    }
    catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
    //Werte aus POST in Variablen schreiben
    
    $id_a      = $_POST['id_a'];
    $a_name    = $_POST['a_name'];
    $a_blocked = $_POST['a_blocked'];
    $a_saved   = $_POST['a_saved'];
    $a_mail    = $_POST['a_mail'];
    
    // Admins Updaten
    $query = "UPDATE `admins` SET `a_name`=:a_name,`a_blocked`=:a_blocked,`a_mail`=:a_mail, `a_saved`=:a_saved WHERE `id_a` =:id_a";
    
    $pdoResult = $pdo->prepare($query);
    
    $pdoExec = $pdoResult->execute(array(
        ":a_name" => $a_name,
        ":a_blocked" => $a_blocked,
        ":a_saved" => $a_saved,
        ":a_mail" => $a_mail,
        ":id_a" => $id_a
    ));
    

    // ÜBERSETZEN

    // Daten erfolgreich übertragen?
    if ($pdoExec) {
        echo 'Data Updated';
        echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_show.php\">";
    } else {
        echo 'ERROR Data Not Updated';
        echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_show.php\">";
    }
    
}

?> 