<?php


//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_pw_change.php            //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Admin Password Change        //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 18.11.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////


include('config.php');
// php update data in mysql database using PDO

if (isset($_POST['save'])) {
    try {
        $pdo;
    }
    catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
    // get values form input text and number
    
    $id_a      = $_SESSION ['user_id'];
    $a_pw      = $_POST['a_pw'];

    $passwordHash = md5($a_pw);      
    
    $query = "UPDATE `admins` SET `a_pw`=:a_pw WHERE `id_a` =:id_a";
    
    $pdoResult = $pdo->prepare($query);
    
    $pdoExec = $pdoResult->execute(array(
        ":a_pw" => $passwordHash,
        ":id_a" => $id_a
    ));
    
    if ($pdoExec) {
        echo 'Data Updated';
        echo "<script type='text/javascript'>window.location='admin_show.php'; </script>";
    } else {
        echo 'Der angemeldete Admin kann sein Passwort nicht &auml;ndern!';
        /* echo "<script type='text/javascript'>window.location='admin_show.php'; </script>"; */
    }
   }

?> 
