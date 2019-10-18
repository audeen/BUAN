<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_edit.php                 //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : HTML-Teil admin_edit         //
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

  <div class="alert alert-danger mt-3" role="alert">
    Admin-Bearbeitung
  </div>

<?php

include ('../../config/config.php');
include ('../../config/admin_update.php');

// Datenbankverbindung herstellen
$pdo;

// Refresh für Abbrechen-Button

if (isset($_SESSION['cancel'])){
  header("Refresh:0");
}

// Ausgabe von Cards je admin
$sql = "SELECT * FROM admins";
echo "<div class=\"card-deck\">";
  foreach ($pdo->query($sql) as $row) {

    echo "<div class=\"cardbox mt-3\">\n";
    echo "<div class=\"card\">\n";
    echo "  <div class=\"card-body\">\n";

    echo "<form action=\"#\" method=\"POST\">";
    
    echo "    <h5 class=\"card-title\">".$row['a_name']."</h5>\n";
    echo "    <input class=\"form-control\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"a_name\" value=\"".$row['a_name']."\">";
    echo "    <br>";
    echo "    <h6 class=\"card-subtitle mb-2 text-muted\">".$row['id_a']."</h6>\n";
    echo "    <p class=\"card-text\">\n";
    echo "\n";
    echo "    </p>\n";

// Radio-Button-Belegung abfragen
if ($row['a_blocked'] == 0) {
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
    echo "  <input class=\"form-check-input\" type=\"radio\" name=\"a_blocked\" id=\"exampleRadios1\" value=\"0\"".$active."\n";
    echo "  <label class=\"form-check-label\" for=\"exampleRadios1\">\n";
    echo "  Aktiv\n";
    echo "  </label>\n";
    echo "</div>";

    echo "<div class=\"form-check mb-2\">\n";
    echo "  <input class=\"form-check-input\" type=\"radio\" name=\"a_blocked\" id=\"exampleRadios1\" value=\"1\"".$blocked."\n";
    echo "  <label class=\"form-check-label\" for=\"exampleRadios1\">\n";
    echo "  Blockiert\n";
    echo "  </label>\n";
    echo "</div>";

    echo "<button type=\"submit\" class=\"btn btn-outline-success mr-2\" name=\"update\">Aktualisieren</button>";
    echo "<button type=\"submit\" class=\"btn btn-outline-danger\" name=\"cancel\">Abbrechen</button>";
    echo "<input type=\"hidden\" name=\"id_a\" value=\"".$row['id_a']."\">";
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

