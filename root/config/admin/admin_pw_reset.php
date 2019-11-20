<?php
if (isset($_POST['pw'])){
    
//https://thisinterestsme.com/php-reset-password-form/

//Connect to MySQL database using PDO.
include('../../config/config.php');
$pdo;
//Get the name that is being searched for.
$a_mail = isset($_POST['a_mail']) ? trim($_POST['a_mail']) : '';
 
//The simple SQL query that we will be running.
$sql = "SELECT `id_a`, `a_mail` FROM `admins` WHERE `a_mail` = :a_mail";
 
//Prepare our SELECT statement.
$statement = $pdo->prepare($sql);
 
//Bind the $name variable to our :name parameter.
$statement->bindValue(':a_mail', $a_mail);
 
//Execute the SQL statement.
$statement->execute();
 
//Fetch our result as an associative array.
$userInfo = $statement->fetch(PDO::FETCH_ASSOC);
 
//If $userInfo is empty, it means that the submitted email
//address has not been found in our users table.
if(empty($userInfo)){
    echo 'That email address was not found in our system!';
    exit;
}
 
//The user's email address and id.
$userEmail = $userInfo['a_mail'];
$userId = $userInfo['id_a'];
 
//Create a secure token for this forgot password request.
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
 
//Insert the request information
//into our password_reset_request table.
 
//The SQL statement.
$insertSql = "INSERT INTO password_reset_request
              (a_id, date_requested, token)
              VALUES
              (:a_id, :date_requested, :token)";
 
//Prepare our INSERT SQL statement.
$statement = $pdo->prepare($insertSql);
 
//Execute the statement and insert the data.
$statement->execute(array(
    "a_id" => $userId,
    "date_requested" => date("Y-m-d H:i:s"),
    "token" => $token
));
 
//Get the ID of the row we just inserted.
$passwordRequestId = $pdo->lastInsertId();
 
 
//Create a link to the URL that will verify the
//forgot password request and allow the user to change their
//password.
$verifyScript = 'https://localhost/BUAN/root/config/admin/admin_pw_auth.php';
 
//The link that we will send the user via email.
$linkToSend = $verifyScript . '?uid=' . $userId . '&id=' . $passwordRequestId . '&t=' . $token;
 
}
?>