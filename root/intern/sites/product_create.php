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
    Produkt anlegen
  </div>

<?php

include ('../../config/config.php');
include ('../../config/product_insert.php');

// Datenbankverbindung herstellen
$pdo;

// Refresh für Abbrechen-Button

if (isset($_SESSION['cancel'])){
  header("Refresh:0");
}

  echo "  <div class=\"ld-center\">\n";
  echo "    <div class=\"card mb-3\">\n";
    echo "    <form action=\"#\" method=\"POST\">";
    echo "    <h5 class=\"card-header\">Neues Produkt</h5>\n";
    echo "    <div class=\"card-body\">\n";
    echo "      <h6 class=\"card-subtitle text-muted\">ID wird automatisch vergeben</h6>\n";
    echo "    </div>\n";
    echo "    <div class=\"card-body\">\n";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_name_0\" placeholder=\"Name deutsch\">";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_name_1\" placeholder=\"Name english\">";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_origin_0\" placeholder=\"Herkunftsland\">";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_origin_1\" placeholder=\"Country of Origin\">";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_txt_0\" placeholder=\"Beschreibungsdext\">";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_txt_1\" placeholder=\"Description\">";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_price\" placeholder=\"Preis/Price\">";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_count\" placeholder=\"Anzahl/Count\">";
    echo "    </div>\n";
    echo "    <div class=\"card-body\">\n";
    echo "      <input type=\"hidden\" name=\"p_saved\" value=\"".time()."\">";
    echo "      <button type=\"submit\" class=\"btn btn-outline-success mr-2\" name=\"register\">Anlegen</button>";
    echo "      <button type=\"submit\" class=\"btn btn-outline-danger\" name=\"cancel\">Abbrechen</button>";

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

