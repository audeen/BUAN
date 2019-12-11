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
    
    $r_prename = !empty($_POST['r_prename']) ? trim($_POST['r_prename']) : null;
    $r_surname = !empty($_POST['r_surname']) ? trim($_POST['r_surname']) : null;
    $r_alias = !empty($_POST['r_alias']) ? trim($_POST['r_alias']) : null;
    $r_mail = !empty($_POST['r_mail']) ? trim($_POST['r_mail']) : null;
    $r_street = !empty($_POST['r_street']) ? trim($_POST['r_street']) : null;
    $r_postal = !empty($_POST['r_postal']) ? trim($_POST['r_postal']) : null;
    $r_city = !empty($_POST['r_city']) ? trim($_POST['r_city']) : null;
    $r_country = !empty($_POST['r_country']) ? trim($_POST['r_country']) : null;

    $image = $_FILES['image']['name'];
    $imgExt = strtolower(pathinfo($image,PATHINFO_EXTENSION));
    $image = rand(1000,1000000).".".$imgExt;
    
    $id_r = $_POST['id_r'];
    $r_saved = $_POST['r_saved'];
    $r_blocked = $_POST['r_blocked'];
    
    
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
    if($pdoExec)
    {
        echo 'Data Updated';
        echo "<meta http-equiv=\"refresh\" content=\"1;url=retailer_show.php\">";

    }else{
        echo 'ERROR Data Not Updated';
        echo "<meta http-equiv=\"refresh\" content=\"1;url=retailer_show.php\">";
    }

}
?>