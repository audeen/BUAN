<?php 

session_start();
include ('config.php');
$pdo;

//The user's id, which should be present in the GET variable "uid"
$userId = isset($_GET['uid']) ? trim($_GET['uid']) : '';
//The token for the request, which should be present in the GET variable "t"
$token = isset($_GET['t']) ? trim($_GET['t']) : '';
//The id for the request, which should be present in the GET variable "id"
$passwordRequestId = isset($_GET['id']) ? trim($_GET['id']) : '';

$_SESSION['id_a'] = $userId;
 
//Now, we need to query our password_reset_request table and
//make sure that the GET variables we received belong to
//a valid forgot password request.
 
$sql = "
      SELECT id_pr, a_id, date_requested 
      FROM password_reset_request
      WHERE 
        a_id = :a_id AND 
        token = :token AND 
        id_pr = :id_pr
";


//Prepare our statement.
$statement = $pdo->prepare($sql);
 
//Execute the statement using the variables we received.
$statement->execute(array(
    "a_id" => $userId,
    "id_pr" => $passwordRequestId,
    "token" => $token
));
 
//Fetch our result as an associative array.
$requestInfo = $statement->fetch(PDO::FETCH_ASSOC);
 
//If $requestInfo is empty, it means that this
//is not a valid forgot password request. i.e. Somebody could be
//changing GET values and trying to hack our
//forgot password system.

if(empty($requestInfo)){
   print_r($requestInfo);
    echo 'Invalid request!';
    exit;
}

else {

//The request is valid, so give them a session variable
//that gives them access to the reset password form.
$_SESSION['user_id_reset_pass'] = $userId;
 
//Redirect them to your reset password form.
echo "<script type='text/javascript'>window.location='../intern/sites/admin_pw_create.php'; </script>";
echo "<form action =\"#\" method=\"POST\">";
echo    "<input type=\"hidden\" name=\"user_id\" value=\"".$user_id."\">";
echo "</form>";
exit;
}

?>