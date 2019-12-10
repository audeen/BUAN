<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_pw_change.php            //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Admin Passwort zurücksetzen  //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 18.11.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

//Orientiert an:
//https://thisinterestsme.com/php-reset-password-form/


if (isset($_POST['pw'])){

include('../../config/config.php');
//Datenbankverbindung herstellen
$pdo;
// Mail-Adresse aus Eingabe beziehen
$a_mail = isset($_POST['a_mail']) ? trim($_POST['a_mail']) : '';
 
//Datenbankabfrage
$sql = "SELECT `id_a`, `a_mail` FROM `admins` WHERE `a_mail` = :a_mail";
 
$statement = $pdo->prepare($sql);
 
//Eingabe an Parameter binden
$statement->bindValue(':a_mail', $a_mail);
 
$statement->execute();

// Rückgabe fetchen
$userInfo = $statement->fetch(PDO::FETCH_ASSOC);
 
// Wenn $userinfo leer ist, gibt es keinen übereinstimmenden Admin, breche Verbindung ab
if(empty($userInfo)){
    echo 'That Admin was not found in our system!'; // ÜBERSETZUNG FEHLT
    exit;
}
 
//Nutzerdaten in Variablen schreiben
$userEmail = $userInfo['a_mail'];
$userId = $userInfo['id_a'];
 
//Sicherheitstoken erstellen
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
 
//Reset-Request in Datenbank schreiben
$sql = "INSERT INTO password_reset_request
              (a_id, date_requested, token)
              VALUES
              (:a_id, :date_requested, :token)";
 

$statement = $pdo->prepare($sql);
 
// Ausführen und in Datenbakn schreiben
$statement->execute(array(
    "a_id" => $userId,
    "date_requested" => date("Y-m-d H:i:s"),
    "token" => $token
));
 
// Letzte ID, die geschrieben wurde, in Variable schreiben
$passwordRequestId = $pdo->lastInsertId();
 
//Erstellen des Links zum Überprüfen der Anfrage und Weiterleitung an Password-Create-Seite  
$verifyScript = 'https://localhost/BUAN/root/config/admin/admin_pw_auth.php';
 
$linkToSend = $verifyScript . '?uid=' . $userId . '&id=' . $passwordRequestId . '&t=' . $token;
 
}
?>