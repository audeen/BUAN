<?php


//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_update.php               //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Update admins zum Blockieren //
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
    
    $id_a = $_POST['id_a'];
    $a_name = $_POST['a_name'];
    $a_blocked = $_POST['a_blocked'];
    $a_saved = $_POST['a_saved'];
    $a_mail = $_POST['a_mail'];
    
    $query = "UPDATE `admins` SET `a_name`=:a_name,`a_blocked`=:a_blocked,`a_mail`=:a_mail, `a_saved`=:a_saved WHERE `id_a` =:id_a";
    
    $pdoResult = $pdo->prepare($query);
    
    $pdoExec = $pdoResult->execute(array(":a_name"=>$a_name,":a_blocked"=>$a_blocked,":a_saved"=>$a_saved,":a_mail"=>$a_mail, ":id_a"=>$id_a));
    
    if($pdoExec)
    {
        echo 'Data Updated';
        header("Refresh:0");
    }else{
        echo 'ERROR Data Not Updated';
        header("Refresh:0");
    }

}

?>