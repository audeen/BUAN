<?php


 
include ('../../config/config.php');
 
 
//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['register'])){
    
    //Retrieve the field values from our registration form.
    $username = !empty($_POST['r_name']) ? trim($_POST['r_name']) : null;
    $pass = !empty($_POST['r_pw']) ? trim($_POST['r_pw']) : null;
    $mail = !empty($_POST['r_mail']) ? trim($_POST['r_mail']) : null;
    $street = !empty($_POST['r_street']) ? trim($_POST['r_street']) : null;
    $postal = !empty($_POST['r_postal']) ? trim($_POST['r_postal']) : null;
    $city = !empty($_POST['r_city']) ? trim($_POST['r_city']) : null;
    
    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.
    
    //Now, we need to check if the supplied username already exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(r_name) AS num FROM retailer WHERE r_name = :r_name";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':r_name', $username);
    $stmt->bindValue(':r_pw', $pass);
    $stmt->bindValue(':r_mail', $mail);
    $stmt->bindValue(':r_street', $street);
    $stmt->bindValue(':r_postal', $postal);
    $stmt->bindValue(':r_city', $city);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){
        die('That username already exists!');
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = md5($pass);
    
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO retailer (r_name, r_pw, r_mail, r_street, r_postal, r_city) VALUES (:r_name, :r_pw, :r_mail, :r_street, :r_postal, :r_city)";
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':r_name', $username);
    $stmt->bindValue(':r_pw', $passwordHash);
    $stmt->bindValue(':r_mail', $mail);
    $stmt->bindValue(':r_street', $street);
    $stmt->bindValue(':r_postal', $postal);
    $stmt->bindValue(':r_city', $city);

 
    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
        echo 'Thank you for registering with our website.';
    }
    
}

?>