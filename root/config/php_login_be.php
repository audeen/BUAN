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
    $sql = "SELECT id_a, a_name, a_pw FROM admins WHERE a_name = :username";
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
            
            //Redirect to our protected page, which we called home.php
            header('Location: ..\intern\sites\index.php');
            exit;
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            die('Incorrect username / password combination!');
        }
    }
    
}
       /*  echo "<meta http-equiv=\"refresh\" content=\"0;url=../intern/sites/index.php\">"; */
/* 
$sql = "SELECT * FROM admins";

// Fehlervariable füllen bei fehlenden Eingaben
if(empty($_POST['name'])&& empty($_POST['password'])) {
    $errorMessage = "<div class=\"alert alert-dark\" role=\"alert\">
                        Bitte einloggen!
                    </div>";
}
elseif(empty($_POST['name'])) {
    $errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                        Name fehlt!
                    </div>";
}
elseif(empty($_POST['password'])) {
    $errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                        Passwort fehlt!
                    </div>";
}
// Datenabgleich mit Datenbank
else {
    
    md5($_POST['password']);
    $_POST['password'] = md5($_POST['password']);

    do {
        if(($_POST['name'] === $row['a_name']) && ($_POST['password'] === $row['a_pw'])) {
            echo "<meta http-equiv=\"refresh\" content=\"0;url=../intern/sites/index.php\">";
            break;

        }
        elseif (($_POST['name'] !== $row['a_name']) && ($_POST['password'] !== $row['a_pw'])) {
                $errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                    Name & Passwort falsch!
                                </div>";
        }
        elseif($_POST['name'] !== $row['a_name']) {
            $errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                Name falsch!
                            </div>";  
        } 
        else($_POST['password'] !== $row['a_pw']) {
            $errorMessage = "<div class=\"alert alert-danger\" role=\"alert\">
                                Passwort falsch!
                            </div>"
        };
        }
    while ($row = mysqli_fetch_assoc($sql));


}
 */
?>