<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_edit.php              //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Produkt bearbeiten           //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();
?>


<!-- Include Security-File -->
<?php include ('../../backend/functions/authentification.php'); ?>

<!-- html-head einbinden -->
<?php include ('../../backend/navigation/html_head.php'); ?>
<body>
    <!-- backend-navigation einbinden -->
  <?php include ('../../backend/navigation/html_nav_be.php'); ?>

<div class="container">

  <div class="alert alert-danger mt-3" role="alert">
    Produkt-Bearbeitung
  </div>

<?php

include ('../../../config/config.php');

include ('../../backend/products/product_update.php');

include ('../../backend/functions/image_upload_p.php');
// Datenbankverbindung herstellen
$pdo;

// Refresh für Abbrechen-Button

if (isset($_SESSION['cancel'])){
  echo "<meta http-equiv=\"refresh\" content=\"0;url=product_show.php\">";
}

// Wenn keine ID übermittelt, gehe auf Übersicht
if (empty($_POST['id_p'])) {
  echo "<meta http-equiv=\"refresh\" content=\"0;url=product_show.php\">";
}
  $sql = "SELECT * FROM products WHERE id_p=\"".$_POST['id_p']."\"";
  echo "<div class=\"ld-center\">\n";
  foreach ($pdo->query($sql) as $row) {
  echo "<div class=\"col-md\">\n";
  echo "<div class=\"card mb-3\">\n";

  echo "<form action=\"#\" method=\"POST\" enctype=\"multipart/form-data\">";
  echo "  <h3 class=\"card-header\">".$row['p_name']."</h3>\n";
  echo "  <div class=\"card-body\">\n";
  echo "    <h6 class=\"card-subtitle text-muted\">ID: ".$row['id_p']."</h6>\n";
  echo "  </div>\n";
  echo "  <div class=\"card-body\">\n";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_name\" value=\"".$row['p_name']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_origin\" value=\"".$row['p_origin']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_desc\" value=\"".$row['p_desc']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_price\" value=\"".$row['p_price']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_amount\" value=\"".$row['p_amount']."\">";

  echo "  </div>\n";

  echo "<div class=\"card-body\">";
  echo "<label class=\"control-label\"><h5>Produktbild festlegen</h5></label></td>";
  echo "<td><input class=\"input-group\" type=\"file\" name=\"image\" accept=\"image/*\" />";
  
  echo "</div>";
  echo "  <ul class=\"list-group list-group-flush\">\n";
  echo "    <li class=\"list-group-item\">";
  

        // Radio-Button-Belegung abfragen
        if ($row['p_blocked'] == 0) {
          $blocked = "";
          $active ="checked";
        }
        else{
          $blocked = "checked";
          $active ="";
        }

  echo "<div class=\"form-check mb-2\">\n";
  echo "    <h5>Status:<br></h5>\n";
  echo "  <input class=\"form-check-input\" type=\"radio\" name=\"p_blocked\" id=\"exampleRadios1\" value=\"0\"".$active."\n";
  echo "  <label class=\"form-check-label\" for=\"exampleRadios1\">\n";
  echo "  Aktiv\n";
  echo "  </label>\n";
  echo "</div>";
  echo "<div class=\"form-check mb-2\">\n";
  echo "  <input class=\"form-check-input\" type=\"radio\" name=\"p_blocked\" id=\"exampleRadios1\" value=\"1\"".$blocked."\n";
  echo "  <label class=\"form-check-label\" for=\"exampleRadios1\">\n";
  echo "  Blockiert\n";
  echo "  </label>\n";
  echo "</div>";

  echo "    </li>\n";
  echo "  </ul>\n";
 
  echo "  <div class=\"card-body\">\n";
  echo "<button type=\"submit\" class=\"btn btn-outline-success mr-2\" name=\"update\">Aktualisieren</button>";
  echo "<button type=\"submit\" class=\"btn btn-outline-danger\" name=\"cancel\">Abbrechen</button>";
  echo "<input type=\"hidden\" name=\"id_p\" value=\"".$row['id_p']."\">";
  echo "<input type=\"hidden\" name=\"p_saved\" value=\"".time()."\">";
  echo "</form>";
  echo "  </div>\n";
  echo "  <div class=\"card-footer text-muted\">\n";
  echo" Zuletzt bearbeitet: ".(date("d.m.Y, H:i:s",$row['p_saved']));
  echo "  </div>\n";
  echo "</form>";
  echo "</div>\n";
  echo "</div>\n";
}
echo "</div>";

?>

</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php include ("../../control/control.php");?>
  </body>
</html>

