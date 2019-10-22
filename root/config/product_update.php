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
    $p_name_0 = $_POST['p_name_0'];
    $p_name_1 = $_POST['p_name_1'];
    $p_origin_0 = $_POST['p_origin_0'];
    $p_origin_1 = $_POST['p_origin_1'];
    $p_txt_0 = $_POST['p_txt_0'];
    $p_txt_1 = $_POST['p_txt_1'];
    $p_count = $_POST['p_count'];
    $p_price = $_POST['p_price'];
    $p_blocked = $_POST['p_blocked'];
    $p_saved = $_POST['p_saved'];
    
    $query =    "UPDATE `products` 
                SET 
                `p_name_0`=:p_name_0,
                `p_name_1`=:p_name_1,
                `p_origin_0`=:p_origin_0,
                `p_origin_1`=:p_origin_1,
                `p_txt_0`=:p_txt_0,
                `p_txt_1`=:p_txt_1,
                `p_count`=:p_count,
                `p_price`=:p_price,
                `p_blocked`=:p_blocked,
                `p_saved`=:p_saved

                WHERE 
                `id_p` =:id_p";
    
    $pdoResult = $pdo->prepare($query);
    
    $pdoExec = $pdoResult->execute(array(
                ":p_name_0"=>$p_name_0,
                ":p_name_1"=>$p_name_1,
                ":p_origin_0"=>$p_origin_0,
                ":p_origin_1"=>$p_origin_1,
                ":p_txt_0"=>$p_txt_0,
                ":p_txt_1"=>$p_txt_1,
                ":p_count"=>$p_count,
                ":p_price"=>$p_price,
                ":p_blocked"=>$p_blocked,
                ":p_saved"=>$p_saved,
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