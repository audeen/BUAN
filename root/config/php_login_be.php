<?php
session_start();

include ('config.php');

// https://thisinterestsme.com/php-user-registration-form/

$errorMessage = "Bitte Einloggen";
//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.
if(isset($_POST['login'])){
    
    //Retrieve the field values from our login form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //Retrieve the user account information for the given username.
    $sql = "SELECT id_a, a_name, a_pw, a_blocked FROM admins WHERE a_name = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($user);
    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        die('Incorrect username / password combination!');
    } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        
        //Compare the passwords.
        
        $validPassword = md5($passwordAttempt);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword === $user['a_pw']){
            
            //Provide the user with a login session.
            $_SESSION['user_id'] = $user['id_a'];
            $_SESSION['logged_in'] = time();

            //Set Blocked-State
            
            if ($user['a_blocked']!=0){
                $_SESSION['blocked']="BLOCKIERT"; 
            };
            
            
            //Redirect to our protected page, which we called home.php
            header('Location: ..\intern\sites\index.php');
            exit;
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            die('Incorrect username / password combination!');
        }
    }
    
}
     
?>