<!-- Include Security-File -->
<?php include ('../../config/security.php'); ?>

<!-- html-head einbinden -->
<?php include ('../../config/html_head.html'); ?>
<body>
    <!-- backend-navigation einbinden -->
  <?php include ('../../config/html_nav_be.php'); ?>

<div class="container">

  <div class="alert alert-danger mt-3" role="alert">
    H&auml;ndler-Bearbeitung
  </div>

<?php

include ('../../config/config.php');
include ('../../config/retailer_update.php');

// Datenbankverbindung herstellen
$pdo;

// Refresh für Abbrechen-Button

if (isset($_SESSION['cancel'])){
  header("Refresh:0");
}


// Ausgabe von Cards je Händler
$sql = "SELECT * FROM retailer";
echo "<div class=\"card-deck\">";
  foreach ($pdo->query($sql) as $row) {

    echo "<div class=\"cardbox mt-3\">\n";
    echo "<div class=\"card\">\n";
    echo "  <div class=\"card-body\">\n";

    echo "<form action=\"#\" method=\"POST\">";
    
    echo "    <h5 class=\"card-title\">".$row['r_name']."</h5>\n";
    echo "    <h6 class=\"card-subtitle mb-2 text-muted\">ID: ".$row['id_r']."</h6>\n";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_name\" value=\"".$row['r_name']."\">";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_mail\" value=\"".$row['r_mail']."\">";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_street\" value=\"".$row['r_street']."\">";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_postal\" value=\"".$row['r_postal']."\">";
    echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_city\" value=\"".$row['r_city']."\">";
    echo "    <br>";
    echo "    <p class=\"card-text\">\n";

// Radio-Button-Belegung abfragen
      if ($row['r_blocked'] == 0) {
        $blocked = "";
        $active ="checked";
      }
      else{
        $blocked = "checked";
        $active ="";
      }

    
    echo "<div class=\"alert alert-secondary\" role=\"alert\">";
    echo "Status";
    echo "</div>";
 
    echo "<div class=\"form-check mb-2\">\n";
    echo "  <input class=\"form-check-input\" type=\"radio\" name=\"r_blocked\" id=\"exampleRadios1\" value=\"0\"".$active."\n";
    echo "  <label class=\"form-check-label\" for=\"exampleRadios1\">\n";
    echo "  Aktiv\n";
    echo "  </label>\n";
    echo "</div>";

    echo "<div class=\"form-check mb-2\">\n";
    echo "  <input class=\"form-check-input\" type=\"radio\" name=\"r_blocked\" id=\"exampleRadios1\" value=\"1\"".$blocked."\n";
    echo "  <label class=\"form-check-label\" for=\"exampleRadios1\">\n";
    echo "  Blockiert\n";
    echo "  </label>\n";
    echo "</div>";

    echo "<button type=\"submit\" class=\"btn btn-outline-success mr-2\" name=\"update\">Aktualisieren</button>";
    echo "<button type=\"submit\" class=\"btn btn-outline-danger\" name=\"cancel\">Abbrechen</button>";
    echo "<input type=\"hidden\" name=\"id_r\" value=\"".$row['id_r']."\">";
    echo "</form>";
    echo "    </p>\n";
    echo "  </div>\n";
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
    <?php include ("../control/control.php");?>
  </body>
</html>

