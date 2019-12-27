<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_insert.php               //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : php-skript für INSERT admin  //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

//Anlegen gedrückt?
if (isset($_POST['update']) && ($_POST['a_pw'] == $_POST['a_pw_verify'])) {
    
    //Daten aus form beziehen
    $name = !empty($_POST['a_name']) ? trim($_POST['a_name']) : null;
    $mail = !empty($_POST['a_mail']) ? trim($_POST['a_mail']) : null;
    $pass = !empty($_POST['a_pw']) ? trim($_POST['a_pw']) : null;
    $saved = !empty($_POST['a_saved']) ? trim($_POST['a_saved']) : null;

    //Existiert der name bereits?
    
    //Rows mit gleichem name auslesen
    $sql = "SELECT COUNT(a_name) AS num FROM admins WHERE a_name = :a_name";
    $stmt = $pdo->prepare($sql);
    
    //Eingegebenes name an Attribut binden
    $stmt->bindValue(':a_name', $name);

    //Ausführen
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Nutzername existiert bereits? Beenden & Fehlermeldung ausgeben
    if($row['num'] > 0){
        
        echo "<div class=\"alert alert-danger mt-3\" role=\"alert\">";
            echo $lang_admincreate[$_SESSION['language']][8];
            echo "<meta http-equiv=\"refresh\" content=\"1;url=../../backend/sites/admin_show.php\">";
        echo "</div>";
        die();
        

    }
    
    //Eingegebenes Passwort hashen
    $passwordHash = md5($pass);
    
    // Insert vorbereiten
    $sql = "INSERT INTO admins (
                                a_name,
                                a_pw,
                                a_mail,  
                                a_saved)
                                VALUES (
                                    :a_name,
                                    :a_pw,
                                    :a_mail,  
                                    :a_saved
                                    )";
    $stmt = $pdo->prepare($sql);
    
    //Variablen an Attribute binden
    
    $stmt->bindValue(':a_name', $name);
    $stmt->bindValue(':a_mail', $mail);
    $stmt->bindValue(':a_pw', $passwordHash);
    $stmt->bindValue(':a_saved', $saved);

    //Ausführen und Inserten
    $result = $stmt->execute();
    
    //Erfolgreich?
    if($result){
        echo "<div class=\"alert alert-success m-3\">".$lang_admincreate[$_SESSION['language']][9]."</div>";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=../../backend/sites/admin_show.php\">";
    }
    
}
// Password-Verifikation fehlgeschlagen?
elseif (isset($_POST['update']) && ($_POST['a_pw'] != $_POST['a_pw_verify'])) {
    echo "<div class=\"alert alert-danger mt-3\" role=\"alert\">";
        echo $lang_admincreate[$_SESSION['language']][10];
    echo "</div>";
    echo "<meta http-equiv=\"refresh\" content=\"1;url=../../backend/sites/admin_show.php\">";
}

?>