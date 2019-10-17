

<!-- html-head einbinden -->
  <?php include ('../../config/html_head.html'); ?>
<body>
    <!-- backend-navigation einbinden -->
  <?php include ('../../config/html_nav_be.html'); ?>

<div class="container">

  <div class="alert alert-danger mt-3" role="alert">
    Admin-Bearbeitung
  </div>

<?php

include ('../../config/config.php');

// Datenbankverbindung herstellen
$pdo;


// Ausgabe von Cards je admin
$sql = "SELECT * FROM admins";
echo "<div class=\"card-deck\">";
  foreach ($pdo->query($sql) as $row) {

    echo "<div class=\"cardbox mt-3\">\n";
    echo "<div class=\"card\">\n";
    echo "  <div class=\"card-body\">\n";

    echo "<form action=\"../../config/admin_update.php\" method=\"POST\">";
    
    echo "    <h5 class=\"card-title\">".$row['a_name']."</h5>\n";
    echo "    <input class=\"form-control\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"a_name\" value=\"".$row['a_name']."\">";
    echo "    <br>";
    echo "    <h6 class=\"card-subtitle mb-2 text-muted\">".$row['id_a']."</h6>\n";
    echo "    <p class=\"card-text\">\n";
    echo "\n";
    echo "    </p>\n";

// Radio-Button-Belegung abfragen
    if ($row['a_blocked'] !=0) {
      $blocked_0 ="checked";
      $blocked_1 ="";
    }
    else{
      $blocked_1 ="checked";
      $blocked_0 ="";
    }
    
    echo "<div class=\"form-check\">\n";
    echo "  <input class=\"form-check-input\" type=\"radio\" name=\"a_blocked\" id=\"exampleRadios1\" value=\"1\"".$blocked_1."\n";
    echo "  <label class=\"form-check-label\" for=\"exampleRadios1\">\n";
    echo "    JA\n";
    echo "  </label>\n";
    echo "</div>";

    echo "<div class=\"form-check\">\n";
    echo "  <input class=\"form-check-input\" type=\"radio\" name=\"a_blocked\" id=\"exampleRadios1\" value=\"0\"".$blocked_0."\n";
    echo "  <label class=\"form-check-label\" for=\"exampleRadios1\">\n";
    echo "    Nein\n";
    echo "  </label>\n";
    echo "</div>";

    echo "<input type=\"submit\" name=\"update\" value=\"update\">";
    echo "<input type=\"hidden\" name=\"id_a\" value=\"".$row['id_a']."\">";
    echo "</form>";
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

