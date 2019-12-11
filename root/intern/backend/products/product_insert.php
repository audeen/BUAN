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

 
include ('../../../config/config.php');
 
 
//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['update'])){
    
    //Retrieve the field values from our registration form.
    $name =   !empty($_POST['p_name']) ? trim($_POST['p_name']) : null;
    $origin = !empty($_POST['p_origin']) ? trim($_POST['p_origin']) : null;
    $desc =   !empty($_POST['p_desc']) ? trim($_POST['p_desc']) : null;
    $amount = !empty($_POST['p_amount']) ? trim($_POST['p_amount']) : null;
    $price =  !empty($_POST['p_price']) ? trim($_POST['p_price']) : null;
    $saved =  !empty($_POST['p_saved']) ? trim($_POST['p_saved']) : null;
    $image =  !empty($_FILES['image']['name']) ? trim($_FILES['image']['name']) : null;
    
    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.
    
    //Now, we need to check if the supplied username already exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(p_name) AS num FROM products WHERE p_name = :p_name";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':p_name', $name);
 
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){

        die("This product already exists!<meta http-equiv=\"refresh\" content=\"1;url=product_create.php\">");
        
    } 

    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
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
    
    //Bind our variables.
    $stmt->bindValue(':p_name', $name);
    $stmt->bindValue(':p_origin', $origin);
    $stmt->bindValue(':p_desc', $desc);
    $stmt->bindValue(':p_amount', $amount);
    $stmt->bindValue(':p_price', $price);
    $stmt->bindValue(':p_saved', $saved);
    $stmt->bindValue(':p_img', $image);

    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
        echo 'Product added.';
        unset($_POST['register']);
    }
    else {
        echo "Error, data not saved.";

    }
    
}

?>