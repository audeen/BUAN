<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_insert.php            //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : php-skript für UPDATE retailer//
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

include ('config.php');
// php update data in mysql database using PDO

if(isset($_POST['update']))
{
    try {
        $pdo;
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
    // get values form input text and number
    
    $id_r = $_POST['id_r'];
    $r_name = $_POST['r_name'];
    $r_blocked = $_POST['r_blocked'];
    $r_mail = $_POST['r_mail'];
    $r_street = $_POST['r_street'];
    $r_postal = $_POST['r_postal'];
    $r_city = $_POST['r_city'];
    $r_country = $_POST['r_country'];
    
    $query =    "UPDATE `retailer` 
                SET 
                `r_name`=:r_name,
                `r_blocked`=:r_blocked,
                `r_mail`=:r_mail,
                `r_street`=:r_street,
                `r_postal`=:r_postal,
                `r_city`=:r_city,
                `r_country`=:r_country
                WHERE 
                `id_r` =:id_r";
    
    $pdoResult = $pdo->prepare($query);
    
    $pdoExec = $pdoResult->execute(array(":r_name"=>$r_name,":r_mail"=>$r_mail,":r_street"=>$r_street,":r_postal"=>$r_postal,":r_city"=>$r_city,":r_blocked"=>$r_blocked,":r_country"=>$r_country,":id_r"=>$id_r,));
   /*  $pdoExec = $pdoResult->execute(array(":a_name"=>$a_name,":a_blocked"=>$a_blocked,":id_a"=>$id_a)); */
    
    
    if($pdoExec)
    {
        echo 'Data Updated';
        header("Refresh:1");
    }else{
        echo 'ERROR Data Not Updated';
        header("Refresh:1");
    }

}

?>