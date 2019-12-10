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

$errorMessage = "Bitte Einloggen";  // ÜBERSETZEN

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
        die('Incorrect username / password combination!'); // Übersetzen
    } 
    //Blockierung prüfen
    elseif ($user['a_blocked']!=0){
        
        die('User Blocked'); // Übersetzen
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
            echo "<meta http-equiv=\"refresh\" content=\"0;url=../../root/intern/sites/index.php\">";
            exit;
            
        } else{
            //Passwörter stimmen nicht überein
            die('Incorrect username / password combination!');  //Übersetzen
        }
    }
    
}
     
?>