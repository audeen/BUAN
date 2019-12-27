<?php 


//Jegliche Passwort-ändern-Skripte sind orientiert an:
//https://thisinterestsme.com/php-reset-password-form/
session_start();
include ('../../../config/config.php');
$pdo;

//User-ID aus GET-Variable holen
$userId = isset($_GET['uid']) ? trim($_GET['uid']) : '';
//Token aus GET-Variable holen
$token = isset($_GET['t']) ? trim($_GET['t']) : '';
//Request-ID aus GET-Variable holen
$passwordRequestId = isset($_GET['id']) ? trim($_GET['id']) : '';

//Prüfe, ob GET-Variablen zu Request in Datenbank passt
 
$sql = "
      SELECT id_pr, r_id, date_requested 
      FROM password_reset_request
      WHERE 
        r_id = :r_id AND 
        token = :token AND 
        id_pr = :id_pr
";

$statement = $pdo->prepare($sql);

$statement->execute(array(
    "r_id" => $userId,
    "id_pr" => $passwordRequestId,
    "token" => $token
));

$requestInfo = $statement->fetch(PDO::FETCH_ASSOC);

//Wenn requestInfo leer ist, ist es keine gültige Anfrage (Manipulationsversuch über GET)

if(empty($requestInfo)){
    echo 'Invalid request!';
    exit;
}

else {

//Die Anfrage ist gültig, der Nutzer bekommt eine ID zugewiesen, die abgefragt werden kann
$_SESSION['user_id_reset_pass'] = $userId;

echo "<meta http-equiv=\"refresh\" content=\"0;url=../../backend/sites/retailer_pw_create.php\">";

exit;
}

?>