<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   product_insert.php             //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : php-skript für INSERT product//
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
//Config-Datei einbinden
include ('../../../config/config.php');
 
 
//Update gesetzt?
if(isset($_POST['update'])){
    
    //Daten aus form beziehen
    $name =   !empty($_POST['p_name']) ? trim($_POST['p_name']) : null;
    $origin = !empty($_POST['p_origin']) ? trim($_POST['p_origin']) : null;
    $desc =   !empty($_POST['p_desc']) ? trim($_POST['p_desc']) : null;
    $amount = !empty($_POST['p_amount']) ? trim($_POST['p_amount']) : null;
    $price =  !empty($_POST['p_price']) ? trim($_POST['p_price']) : null;
    $saved =  !empty($_POST['p_saved']) ? trim($_POST['p_saved']) : null;
    
    //Bilddaten auslesen und in Variablen schreiben
    $image = $_FILES['image']['name'];
    $imgExt = strtolower(pathinfo($image,PATHINFO_EXTENSION));
    $image = rand(1000,1000000).".".$imgExt;
    
    //Zähle Rows mit identischem Namen
    
    $sql = "SELECT COUNT(p_name) AS num FROM products WHERE p_name = :p_name";
    $stmt = $pdo->prepare($sql);
    
    //Wert an Parameter binden
    $stmt->bindValue(':p_name', $name);
 
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //Name bereits vergeben, beende Skript
    if($row['num'] > 0){

        echo "<div class=\"alert alert-danger mt-3\" role=\"alert\">";
            echo $lang_productcreate[$_SESSION['language']][13];
            echo "<meta http-equiv=\"refresh\" content=\"1;url=../../backend/sites/product_show.php\">";
        echo "</div>";
        die();
        
    } 

    // Daten in Datenbank schreiben
    $sql = "INSERT INTO products (
                            p_name,
                            p_origin,
                            p_desc,
                            p_amount,
                            p_price,
                            p_saved,
                            p_img
                        )
                        VALUES (
                                :p_name,
                                :p_origin, 
                                :p_desc,
                                :p_amount,
                                :p_price,
                                :p_saved,
                                :p_img
                                )";

    $stmt = $pdo->prepare($sql);
    
    //Variablen an Parameter binden
    $stmt->bindValue(':p_name', $name);
    $stmt->bindValue(':p_origin', $origin);
    $stmt->bindValue(':p_desc', $desc);
    $stmt->bindValue(':p_amount', $amount);
    $stmt->bindValue(':p_price', $price);
    $stmt->bindValue(':p_saved', $saved);
    $stmt->bindValue(':p_img', $image);

    //Insert
    $result = $stmt->execute();
    
    //Insert erfolgreich?
    if($result){
        echo "<div class=\"alert alert-success m-3\">".$lang_productcreate[$_SESSION['language']][12]."</div>";
        echo "<meta http-equiv=\"refresh\" content=\"1;url=../../backend/sites/product_show.php\">";
        unset($_POST['register']);
    }
    else {
        echo "Error, data not saved.";

    }
    
}

?>