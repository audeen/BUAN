<?php
//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_pw_reset.php          //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Retailer Password Reset      //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 18.11.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

//Jegliche Passwort-ändern-Skripte sind orientiert an:
//https://thisinterestsme.com/php-reset-password-form/

//Spracharray lokal
$lang_pw[0][0] = "Die eingegebene Mail-Adresse konnte nicht gefunden werden!";
$lang_pw[0][1] = "That email address could not be found!";

//Config-Datei einbinden
include ('../../../config/config.php');

if (isset($_POST['pw'])){
    
//Datenbankverbindung herstellen
$pdo;

//Eingegebene Mailadresse holen
$r_mail = isset($_POST['r_mail']) ? trim($_POST['r_mail']) : '';
 
//Datenbankabfrage
$sql = "SELECT `id_r`, `r_mail` FROM `retailer` WHERE `r_mail` = :r_mail";
 
//Vorbereiten
$statement = $pdo->prepare($sql);
 
//Variablen an Parameter binden
$statement->bindValue(':r_mail', $r_mail);
 
//Ausführen
$statement->execute();
 
//Ergebnis als assoziatives Array speichern
$userInfo = $statement->fetch(PDO::FETCH_ASSOC);
 
//Wenn $userinfo leer ist, dann gibt es die Mailadresse nicht
if(empty($userInfo)){
    echo $lang_pw[$_SESSION['language']][0];
    exit;
}
 
//User-Informationen in Variablen schreiben
$userEmail = $userInfo['r_mail'];
$userId = $userInfo['id_r'];
 
//Token für Authentifizierung erstellen 
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
 
//Request-Informationen in Datenbank schreiben
 
//Das SQL-Statement
$insertSql = "INSERT INTO password_reset_request
              (r_id, date_requested, token)
              VALUES
              (:r_id, :date_requested, :token)";
 
//Insert vorbereiten
$statement = $pdo->prepare($insertSql);
 
//Ausführen und inserten
$statement->execute(array(
    "r_id" => $userId,
    "date_requested" => date("Y-m-d H:i:s"),
    "token" => $token
));
 
//Informationen der letzen eingetragenen ID beziehen
$passwordRequestId = $pdo->lastInsertId();
 
 
//Link erstellen, mit dem der Nutzer das Passwort zurücksetzen kann

$verifyScript = 'https://localhost/BUAN/root/intern/backend/retailer/retailer_pw_auth.php';
 
//Link mit GET-Informationen
$linkToSend = $verifyScript . '?uid=' . $userId . '&id=' . $passwordRequestId . '&t=' . $token;
 
}
?>