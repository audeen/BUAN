<?php


//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   php_login_be.php               //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : php-funktionen für BE-Login  //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

session_start();
include ('../config/config.php');

// Orientiert an:
// https://thisinterestsme.com/php-user-registration-form/

// Spracharrays lokal 
$lang_phploginbe = array();
$lang_phploginbe[0][0] = "Bitte einloggen!";
$lang_phploginbe[0][1] = "Account konnte nicht gefunden werden";
$lang_phploginbe[0][2] = "Nutzer blockiert";
$lang_phploginbe[0][3] = "Passwort falsch!";

$lang_phploginbe[1][0] = "Please Log in";
$lang_phploginbe[1][1] = "Account not found";
$lang_phploginbe[1][2] = "User blocked";
$lang_phploginbe[1][3] = "Wrong password!";


$errorMessage = $lang_phploginbe[$_SESSION['language']][0];  // ÜBERSETZEN

// Login gedrückt?
if(isset($_POST['login'])){
    
    //Werte übertragen
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //Nutzerdaten beziehen
    $sql = "SELECT id_a, a_name, a_pw, a_blocked FROM admins WHERE a_name = :username";
    $stmt = $pdo->prepare($sql);
    
    //Werte an Parameter binden
    $stmt->bindValue(':username', $username);
    
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user === false){
        //Nutzer konnte nicht gefunden werden
        die($lang_phploginbe[$_SESSION['language']][1]); // Übersetzen
    } 
    //Blockierung prüfen
    elseif ($user['a_blocked']!=0){
        
        die($lang_phploginbe[$_SESSION['language']][2]); // Übersetzen
        exit; 
    }
    else{
        // Nutzer gefunden, eingegebenes Passwort mit gespeichertem Hash überprüfen
        
        $validPassword = md5($passwordAttempt);
        
        //Gleiches Passwort?
        if($validPassword === $user['a_pw']){
            
            //Session-Variablen setzen
            $_SESSION['user_id'] = $user['id_a'];
            $_SESSION['logged_in'] = time();
            
            //Weiterleiten zur Backend-Startseite
            echo "<meta http-equiv=\"refresh\" content=\"0;url=../../root/intern/backend/sites/index.php\">";
            exit;
            
        } else{
            //Passwörter stimmen nicht überein
            die($lang_phploginbe[$_SESSION['language']][3]);  //Übersetzen
        }
    }
    
}
     
?>