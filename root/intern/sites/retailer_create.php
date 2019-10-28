<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_create.php            //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : HTML-Teil retailer_create    //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

?>


<!-- Include Security-File -->
<?php include ('../../config/security.php'); ?>

<!-- html-head einbinden -->
<?php include ('../../config/html_head.php'); ?>
<body>
    <!-- backend-navigation einbinden -->
  <?php include ('../../config/html_nav_be.php'); ?>


<div class="container">

  <div class="alert alert-primary mt-3" role="alert">
    H&auml;ndler anlegen
  </div>

<?php

include ('../../config/config.php');
include ('../../config/retailer_insert.php');

// Datenbankverbindung herstellen
$pdo;

// Refresh für Abbrechen-Button

if (isset($_SESSION['cancel'])){
  echo "<script type='text/javascript'>window.location='product_create.php'; </script>";
}

  echo "  <div class=\"ld-center\">\n";
  echo "    <div class=\"card mb-3\">\n";
    echo "    <form action=\"#\" method=\"POST\">";
    echo "    <h5 class=\"card-header\">Neuer H&auml;ndler</h5>\n";
    echo "    <div class=\"card-body\">\n";
    echo "      <h6 class=\"card-subtitle text-muted\">ID wird automatisch vergeben</h6>\n";
    echo "    </div>\n";
    echo "    <div class=\"card-body\">\n";
    echo "      <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_prename\" placeholder=\"Prename\" required>";
    echo "      <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_surname\" placeholder=\"Surname\" required>";
    echo "      <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_alias\" placeholder=\"Alias\" required>";
    echo "      <input type=\"password\"class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_pw\" placeholder=\"Password\" required>";
    echo "      <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_mail\" placeholder=\"E-Mail\" required>";
    echo "      <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_street\" placeholder=\"Stra&szlig;e, Nummer\" required>";
    echo "      <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_postal\" placeholder=\"PLZ\" required>";
    echo "      <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_city\" placeholder=\"Stadt\" required>";
    echo "      <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_country\" placeholder=\"Land\" required>";
    echo "    </div>\n";
    echo "    <div class=\"card-body\">\n";
    echo "      <input type=\"hidden\" name=\"r_saved\" value=\"".time()."\">";
    echo "      <button type=\"submit\" class=\"btn btn-outline-success mr-2\" name=\"register\">Anlegen</button>";
    echo "      <button class=\"btn btn-outline-danger\" name=\"cancel\" formnovalidate>Abbrechen</button>";

    echo "    </form>";
    echo "    </div>\n";

    echo "  </div>\n";
    echo "</div>\n";


?>

</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php include ("../control/control.php");?>
  </body>
</html>

