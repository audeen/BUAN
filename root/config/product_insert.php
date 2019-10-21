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

 
include ('../../config/config.php');
 
 
//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['register'])){
    
    //Retrieve the field values from our registration form.
    $name_0 = !empty($_POST['p_name_0']) ? trim($_POST['p_name_0']) : null;
    $name_1 = !empty($_POST['p_name_1']) ? trim($_POST['p_name_1']) : null;
    $origin_0 = !empty($_POST['p_origin_0']) ? trim($_POST['p_origin_0']) : null;
    $origin_1 = !empty($_POST['p_origin_1']) ? trim($_POST['p_origin_1']) : null;
    $txt_0 = !empty($_POST['p_txt_0']) ? trim($_POST['p_txt_0']) : null;
    $txt_1 = !empty($_POST['p_txt_1']) ? trim($_POST['p_txt_1']) : null;
    $count = !empty($_POST['p_count']) ? trim($_POST['p_count']) : null;
    $price = !empty($_POST['p_price']) ? trim($_POST['p_price']) : null;
    $saved = !empty($_POST['p_saved']) ? trim($_POST['p_saved']) : null;
    
    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.
    
    //Now, we need to check if the supplied username already exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(p_name_0) AS num FROM products WHERE p_name_0 = :p_name_0";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':p_name_0', $name_0);
 
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){
        die('That product already exists!');
    } 

        //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(p_name_1) AS num FROM products WHERE p_name_1 = :p_name_1";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':p_name_1', $name_1);
 
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){
        die('That product already exists!');
    } 
    
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO products (
                            p_name_0,
                            p_name_1, 
                            p_origin_0,
                            p_origin_1,
                            p_txt_0,
                            p_txt_1,
                            p_count,
                            p_price,
                            p_saved
                        )
                        VALUES (
                                :p_name_0,
                                :p_name_1, 
                                :p_origin_0,
                                :p_origin_1,
                                :p_txt_0,
                                :p_txt_1,
                                :p_count,
                                :p_price,
                                :p_saved)";

    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':p_name_0', $name_0);
    $stmt->bindValue(':p_name_1', $name_1);
    $stmt->bindValue(':p_origin_0', $origin_0);
    $stmt->bindValue(':p_origin_1', $origin_1);
    $stmt->bindValue(':p_txt_0', $txt_0);
    $stmt->bindValue(':p_txt_1', $txt_1);
    $stmt->bindValue(':p_count', $count);
    $stmt->bindValue(':p_price', $price);
    $stmt->bindValue(':p_saved', $saved);


 
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
        echo 'Thank you for registering with our website.';
        unset($_POST['register']);
    }
    else {
        echo "cbvcbvc";

    }
    
}

?>