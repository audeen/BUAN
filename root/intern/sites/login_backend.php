<?php



//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:  login_backend.php               //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Login-Seite fuer Backend     //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 07.10.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

session_start();
include ("../../config/config.php");
$sql = "SELECT * FROM admins";
$sql = mysqli_query($db_link, $sql) OR die(mysqli_error(""));

$row = mysqli_fetch_assoc($sql);


// Fehlervariable füllen bei fehlenden Eingaben
if(empty($_POST['name'])&& empty($_POST['password'])) {
    $errorMessage = "Keine Eingaben!";
}
elseif(empty($_POST['name'])) {
    $errorMessage = "Name fehlt!";
}
elseif(empty($_POST['password'])) {
    $errorMessage = "Passwort fehlt!";
}
// Datenabgleich mit Datenbank
else {
    
    md5($_POST['password']);
    $_POST['password'] = md5($_POST['password']);

    do {
        if(($_POST['name'] === $row['a_name']) && ($_POST['password'] === $row['a_pw'])) {
            echo "<meta http-equiv=\"refresh\" content=\"0;url=dashboard.php\">";
            break;

        }
        elseif (($_POST['name'] !== $row['a_name']) && ($_POST['password'] !== $row['a_pw'])) {
            $errorMessage = "Name & Passwort falsch!";
        }
        elseif($_POST['name'] !== $row['a_name']) {
            $errorMessage = "Falscher Nutzer!";  
        } 
        else($_POST['password'] !== $row['a_pw']) {
            $errorMessage = "Falsches Passwort!"
        };
        }
    while ($row = mysqli_fetch_assoc($sql));


}

echo "<!doctype html>";
echo "<html>";
echo "<head>";
echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">";
echo "<title>Login</title>";   
echo "</head>";
include ("../control/control.php");
echo "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\">";
echo "<body>";
 

if(isset($errorMessage)) {
    echo $errorMessage;
}

 
echo "<form action=\"#\" method=\"POST\">";
echo "Name:<br>";
echo "<input type=\"text\" size=\"40\" maxlength=\"250\" name=\"name\"><br><br>";

echo print_r($row);
br(1);
 
echo "Passwort:<br>";
echo "<input type=\"password\" size=\"40\"  maxlength=\"250\" name=\"password\"><br>";
 
echo "<input type=\"submit\" value=\"Abschicken\">";
echo "</form>";

echo "<script src=\"https://code.jquery.com/jquery-3.2.1.slim.min.js\" integrity=\"sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN\" crossorigin=\"anonymous\"></script>";
echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js\" integrity=\"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q\" crossorigin=\"anonymous\"></script>";
echo "<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\" integrity=\"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl\" crossorigin=\"anonymous\"></script>";

echo "</body>";
echo "</html>";

?>