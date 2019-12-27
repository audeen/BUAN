<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_insert.php            //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : php-skript für INSERT retailer//
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

//Anlegen gedrückt?
if (isset($_POST['update']) && ($_POST['r_pw'] == $_POST['r_pw_verify'])) {
    
    //Daten aus form beziehen
    $prename = !empty($_POST['r_prename']) ? trim($_POST['r_prename']) : null;
    $surname = !empty($_POST['r_surname']) ? trim($_POST['r_surname']) : null;
    $alias = !empty($_POST['r_alias']) ? trim($_POST['r_alias']) : null;
    $pass = !empty($_POST['r_pw']) ? trim($_POST['r_pw']) : null;
    $mail = !empty($_POST['r_mail']) ? trim($_POST['r_mail']) : null;
    $street = !empty($_POST['r_street']) ? trim($_POST['r_street']) : null;
    $postal = !empty($_POST['r_postal']) ? trim($_POST['r_postal']) : null;
    $city = !empty($_POST['r_city']) ? trim($_POST['r_city']) : null;
    $country = !empty($_POST['r_country']) ? trim($_POST['r_country']) : null;
    $saved = !empty($_POST['r_saved']) ? trim($_POST['r_saved']) : null;
    
    //Existiert der Alias bereits?
    //Rows mit gleichem Alias auslesen
    $sql = "SELECT COUNT(r_alias) AS num FROM retailer WHERE r_alias = :r_alias";
    $stmt = $pdo->prepare($sql);
    
    //Eingegebenes Alias an Attribut binden
    $stmt->bindValue(':r_alias', $alias);

    //Execute.
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Alias existiert bereits? Beenden & Fehlermeldung ausgeben
    if($row['num'] > 0){
        
        echo "<div class=\"alert alert-danger mt-3\" role=\"alert\">";
            echo $lang_retailercreate[$_SESSION['language']][17];
            echo "<meta http-equiv=\"refresh\" content=\"0;url=../../backend/sites/retailer_show.php\">";
        echo "</div>";
        die();
        

    }
    
    //Eingegebenes Passwort hashen
    $passwordHash = md5($pass);
    
    // Insert vorbereiten
    $sql = "INSERT INTO retailer (
                                r_prename,
                                r_surname,
                                r_alias,
                                r_pw,
                                r_mail, 
                                r_street, 
                                r_postal, 
                                r_city, 
                                r_country, 
                                r_saved,
                                r_img)
                                VALUES (
                                    :r_prename,
                                    :r_surname,
                                    :r_alias,
                                    :r_pw, 
                                    :r_mail, 
                                    :r_street, 
                                    :r_postal, 
                                    :r_city, 
                                    :r_country, 
                                    :r_saved,
                                    :r_img)";
    $stmt = $pdo->prepare($sql);
    
    //Variablen an Attribute binden
    
    $stmt->bindValue(':r_prename', $prename);
    $stmt->bindValue(':r_surname', $surname);
    $stmt->bindValue(':r_alias', $alias);
    $stmt->bindValue(':r_pw', $passwordHash);
    $stmt->bindValue(':r_mail', $mail);
    $stmt->bindValue(':r_street', $street);
    $stmt->bindValue(':r_postal', $postal);
    $stmt->bindValue(':r_city', $city);
    $stmt->bindValue(':r_country', $country);
    $stmt->bindValue(':r_saved', $saved);
    $stmt->bindValue(':r_img', $image);

 
    //Ausführen und Inserten
    $result = $stmt->execute();
    
    //Erfolgreich?
    if($result){
        echo "<div class=\"alert alert-success m-3\">".$lang_retailercreate[$_SESSION['language']][16]."</div>";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=../../backend/sites/retailer_show.php\">";

    }
    
}
elseif (isset($_POST['update']) && ($_POST['r_pw'] != $_POST['r_pw_verify'])) {
    echo "<div class=\"alert alert-danger mt-3\" role=\"alert\">";
        echo $lang_retailercreate[$_SESSION['language']][14];
    echo "</div>";
}

?>