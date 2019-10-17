<?php

include ('config.php');

/* $sql = "SELECT * FROM admins"; */
/* $sql = mysqli_query($db_link, $sql) OR die(mysqli_error("")); */

/* $row = mysqli_fetch_assoc($sql); */


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

?>