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
    
    $id_p = $_POST['id_p'];
    $blocked = $_POST['p_blocked'];
    $name = !empty($_POST['p_name']) ? trim($_POST['p_name']) : null;
    $origin = !empty($_POST['p_origin']) ? trim($_POST['p_origin']) : null;
    $desc = !empty($_POST['p_desc']) ? trim($_POST['p_desc']) : null;
    $amount = !empty($_POST['p_amount']) ? trim($_POST['p_amount']) : null;
    $price = !empty($_POST['p_price']) ? trim($_POST['p_price']) : null;
    $saved = !empty($_POST['p_saved']) ? trim($_POST['p_saved']) : null;
    
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

    
    
    if($pdoExec)
    {
        echo 'Data Updated';
        echo "<script type='text/javascript'>window.location='product_show.php'; </script>";
    }else{
        echo 'ERROR Data Not Updated';
        echo "<script type='text/javascript'>window.location='product_show.php'; </script>";
    }

}

?>