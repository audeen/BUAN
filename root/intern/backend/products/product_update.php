<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   product_update.php             //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : php-skript für UPDATE product//
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

// Update gesetzut?
if(isset($_POST['update']))
{
    try {
        $pdo;
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
    // Daten aus Form beziehen
    
    $id_p = $_POST['id_p'];
    $blocked = $_POST['p_blocked'];
    $name = !empty($_POST['p_name']) ? trim($_POST['p_name']) : null;
    $origin = !empty($_POST['p_origin']) ? trim($_POST['p_origin']) : null;
    $desc = !empty($_POST['p_desc']) ? trim($_POST['p_desc']) : null;
    $amount = !empty($_POST['p_amount']) ? trim($_POST['p_amount']) : null;
    $price = !empty($_POST['p_price']) ? trim($_POST['p_price']) : null;
    $saved = !empty($_POST['p_saved']) ? trim($_POST['p_saved']) : null;

    // Bilddaten beziehen und Erweiterung auslesen, Zufällige Zahl als Namen festlegen, um Dopplungen zu vermeiden
    $image = $_FILES['image']['name'];
    $imgExt = strtolower(pathinfo($image,PATHINFO_EXTENSION));
    $image = rand(1000,1000000).".".$imgExt;
    
    // Den Attributen die eingegebenen Werte zuweisen
    $query =    "UPDATE `products` 
                SET 
                `p_name`=:p_name,
                `p_origin`=:p_origin,
                `p_desc`=:p_desc,
                `p_amount`=:p_amount,
                `p_price`=:p_price,
                `p_blocked`=:p_blocked,
                `p_saved`=:p_saved

                WHERE 
                `id_p` =:id_p";
    
    $pdoResult = $pdo->prepare($query);
    
    // Update
    $pdoExec = $pdoResult->execute(array(
                ":p_name"=>$name,
                ":p_origin"=>$origin,
                ":p_desc"=>$desc,
                ":p_amount"=>$amount,
                ":p_price"=>$price,
                ":p_blocked"=>$blocked,
                ":p_saved"=>$saved,
                ":id_p"=>$id_p
            ));

    
    // Abfrage, ob Datenänderung erfolgreich war
    if($pdoExec)
    {
        echo "<div class=\"alert alert-success m-3\">".$lang_productedit[$_SESSION['language']][8]."</div>";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=product_show.php\">";
    }else{
        echo "<div class=\"alert alert-danger m-3\">".$lang_productedit[$_SESSION['language']][9]."</div>";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=product_show.php\">";
    }

}

?>