<?php


//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_pw_change.php            //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Admin Password Change        //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 18.11.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

//Jegliche Passwort-ändern-Skripte sind orientiert an:
//https://thisinterestsme.com/php-reset-password-form/


//Spracharray lokal
$lang_data = array();
$lang_data[0][0] = "Passwort erfolgreich zur&uuml;ckgesetzt";
$lang_data[0][1] = "Passwort nicht zur&uuml;ckgesetzt";
$lang_data[0][2] = "Passw&ouml;rter stimmen nicht &uuml;berein ";

$lang_data[1][0] = "Password has been reset";
$lang_data[1][1] = "Password has not been reset";
$lang_data[0][2] = "Passwords do not match";



// Wenn $_POST save gesetzt, prüfe, ob Password und Verify-Password übereinstimmen

if (isset($_POST['save']) && ($_POST['a_pw'] == $_POST['a_pw_verify'])) {
    try {
        $pdo;
    }
    catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
    // Werte aus Feldern holen
    
    $id_a      = $_SESSION['user_id_reset_pass'];
    $a_pw      = $_POST['a_pw'];

    // Passworteingabe hashen
    $passwordHash = md5($a_pw);  
    
    // Datenbank aktualisieren
    $query = "UPDATE `admins` SET `a_pw`=:a_pw WHERE `id_a` =:id_a";
    //vorbereiten
    $pdoResult = $pdo->prepare($query);
    //Eingeabewerte in Array übergeben
    $pdoExec = $pdoResult->execute(array(
        ":a_pw" => $passwordHash,
        ":id_a" => $id_a
    ));
    //Erfolgreich?
    if ($pdoExec) {
        echo "<div class=\"alert alert-danger mt-3\" role=\"alert\">";
            echo $lang_data[$_SESSION['language']][0]; 
        echo "</div>";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_show.php\">";
    } else {
        echo "<div class=\"alert alert-danger mt-3\" role=\"alert\">";
            echo $lang_data[$_SESSION['language']][1];
        echo "</div>";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_show.php\">";
    }
   }
// Bei Erstaufruf prüfe nichts
elseif (!isset($_POST['save'])) {
    
}
// Wenn die Passwörter nicht übereinstimmen
else {
    echo "<div class=\"alert alert-danger mt-3\" role=\"alert\">";
        echo $lang_data[$_SESSION['language']][2];
    echo "</div>";
}
?> 
