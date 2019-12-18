<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_update.php            //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : php-skript für UPDATE retailer//
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
// Wenn update gesetzt, stelle Datenbankverbindung her

if(isset($_POST['update']))
{
    try {
        $pdo;
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
    // Editiert ein User sein Profil, wird bei der Übergabe r_blocked 0 gesetzt
    if (isset($_SESSION['user_id_r'])){
        $r_blocked = 0;
    }
    else {
        $r_blocked = $_POST['r_blocked'];
    }

    //Werte aus Form in Variablen schreiben
    $r_prename = !empty($_POST['r_prename']) ? trim($_POST['r_prename']) : null;
    $r_surname = !empty($_POST['r_surname']) ? trim($_POST['r_surname']) : null;
    $r_alias = !empty($_POST['r_alias']) ? trim($_POST['r_alias']) : null;
    $r_mail = !empty($_POST['r_mail']) ? trim($_POST['r_mail']) : null;
    $r_street = !empty($_POST['r_street']) ? trim($_POST['r_street']) : null;
    $r_postal = !empty($_POST['r_postal']) ? trim($_POST['r_postal']) : null;
    $r_city = !empty($_POST['r_city']) ? trim($_POST['r_city']) : null;
    $r_country = !empty($_POST['r_country']) ? trim($_POST['r_country']) : null;

    // Bilddaten beziehen und Erweiterung auslesen, Zufällige Zahl als Namen festlegen, um Dopplungen zu vermeiden
    $image = $_FILES['image']['name'];
    $imgExt = strtolower(pathinfo($image,PATHINFO_EXTENSION));
    $image = rand(1000,1000000).".".$imgExt;
    
    //Werte aus Post in Variablen schreiben, um weitergabe zu ermöglichen

    $id_r = $_POST['id_r'];
    $r_saved = $_POST['r_saved'];
    
    
    // Den Attributen die eingegebenen Werte zuweisen
    $query =    "UPDATE `retailer` 
                SET 
                `r_prename`=:r_prename,
                `r_surname`=:r_surname,
                `r_alias`=:r_alias,
                `r_blocked`=:r_blocked,
                `r_mail`=:r_mail,
                `r_street`=:r_street,
                `r_postal`=:r_postal,
                `r_city`=:r_city,
                `r_country`=:r_country,
                `r_saved`=:r_saved
                WHERE 
                `id_r` =:id_r";
    
    $pdoResult = $pdo->prepare($query);
    
    //Update
    $pdoExec = $pdoResult->execute(array(
                                        ":r_surname"=>$r_surname,
                                        ":r_prename"=>$r_prename,
                                        ":r_alias"=>$r_alias,
                                        ":r_mail"=>$r_mail,
                                        ":r_street"=>$r_street,
                                        ":r_postal"=>$r_postal,
                                        ":r_city"=>$r_city,
                                        ":r_blocked"=>$r_blocked,
                                        ":r_country"=>$r_country,
                                        ":r_saved"=>$r_saved,
                                        ":id_r"=>$id_r,));
                                        
    // Abfrage, ob Datenänderung erfolgreich war                                    
    if($pdoExec)
    {
        echo "<div class=\"alert alert-success m-3\">".$lang_retaileredit[$_SESSION['language']][10]."</div>";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=retailer_show.php\">";

    }else{
        echo "<div class=\"alert alert-danger m-3\">".$lang_retaileredit[$_SESSION['language']][11]."</div>";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=retailer_show.php\">";
    }

}
?>