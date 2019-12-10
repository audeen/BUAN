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


include('../../config/config.php');
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
    
    $pdoResult = $pdo->prepare($query);
    
    $pdoExec = $pdoResult->execute(array(
        ":a_pw" => $passwordHash,
        ":id_a" => $id_a
    ));
    
    if ($pdoExec) {
        echo 'Data Updated'; // ÜBERSETZUNG FEHLT
        echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_show.php\">";
    } else {
        echo 'Data NOT Updated';
        echo "<meta http-equiv=\"refresh\" content=\"1;url=admin_show.php\">";
    }
   }
// Bei Erstaufruf prüfe nichts
elseif (!isset($_POST['save'])) {
    
}
// Wenn die Passwörter nicht übereinstimmen
else {
    echo "<div class=\"alert alert-danger mt-3\" role=\"alert\">";
        /* echo $lang_adminedit[$_SESSION['language']][0]; */   /// ÜBERSETZUNG FEHLT
        echo "Passwörter stimmen nicht überein!";
    echo "</div>";
}
?> 
