<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_create.php            //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Produkt anlegen              //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();
?>

<!-- Include Security-File -->
<?php include ('../../config/functions/authentification.php'); ?>

<!-- html-head einbinden -->
<?php include ('../../config/navigation/html_head.php'); ?>
<body>
    <!-- backend-navigation einbinden -->
  <?php include ('../../config/navigation/html_nav_be.php'); ?>

<div class="container">

  <div class="alert alert-primary mt-3" role="alert">
    Produkt anlegen --- Übersetzung fehlt
  </div>

<?php

include ('../../config/config.php');
include ('../../config/products/product_insert.php');

// Datenbankverbindung herstellen
$pdo;

// Refresh für Abbrechen-Button

if (isset($_SESSION['cancel'])){
  echo "<meta http-equiv=\"refresh\" content=\"1;url=product_create.php\">";
}

  echo "<div class=\"ld-center\">\n";
  echo "<div class=\"card mb-3\">\n";
    echo "<form action=\"#\" method=\"POST\">";
      echo "<h5 class=\"card-header\">Neues Produkt</h5>\n";
      echo "<div class=\"card-body\">\n";
        echo "<h6 class=\"card-subtitle text-muted\">ID wird automatisch vergeben</h6>\n";
      echo "</div>\n";
      echo "<div class=\"card-body\">\n";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_name\" placeholder=\"Name deutsch\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_origin\" placeholder=\"Herkunftsland\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_desc\" placeholder=\"Beschreibungsdext\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_price\" placeholder=\"Preis/Price\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_amount\" placeholder=\"Anzahl/Count\" required>";
      echo "</div>\n";
      echo "<div class=\"card-body\">";
        echo "<label class=\"control-label\"><h5>Produtbild festlegen</h5></label>";
        echo "<input class=\"input-group\" type=\"file\" name=\"image\" accept=\"image/*\" />";
      echo "</div>";
      echo "<div class=\"card-body\">\n";
        echo "<input type=\"hidden\" name=\"p_saved\" value=\"".time()."\">";
        echo "<button type=\"submit\" class=\"btn btn-outline-success mr-2\" name=\"update\">Anlegen</button>";
        echo "<button class=\"btn btn-outline-danger\" name=\"cancel\" formnovalidate>Abbrechen</button>";
    echo "</form>";
    echo "</div>\n";
  echo "</div>\n";
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

