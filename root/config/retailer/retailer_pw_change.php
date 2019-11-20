<?php


//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_pw_change.php         //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Retailer Password Change     //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 18.11.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////


include('../../config/config.php');
// Wenn $_POST save gesetzt, prüfe, ob Password und Verify-Password übereinstimmen

if (isset($_POST['save']) && ($_POST['r_pw'] == $_POST['r_pw_verify'])) {
    try {
        $pdo;
    }
    catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
    // get values form input text and number
    
    $id_r      = $_SESSION['user_id_reset_pass'];
    $r_pw      = $_POST['r_pw'];

    $passwordHash = md5($r_pw);      
    
    $query = "UPDATE `retailer` SET `r_pw`=:r_pw WHERE `id_r` =:id_r";
    
    $pdoResult = $pdo->prepare($query);
    
    $pdoExec = $pdoResult->execute(array(
        ":r_pw" => $passwordHash,
        ":id_r" => $id_r
    ));
    
    if ($pdoExec) {
        echo 'Data Updated';
        echo "<meta http-equiv=\"refresh\" content=\"1;url=retailer_show.php\">";
    } else {
        echo 'Data NOT Updated';
        echo "<meta http-equiv=\"refresh\" content=\"1;url=retailer_show.php\">";
    }
   }
// Bei Erstaufruf prüfe nichts
elseif (!isset($_POST['save'])) {
    
}
// Wenn die Passwörter nicht übereinstimmen
else {
    echo "<div class=\"alert alert-danger mt-3\" role=\"alert\">";
        /* echo $lang_adminedit[$_SESSION['language']][0]; */
        echo "Passwörter stimmen nicht überein!";
    echo "</div>";
}
?> 
