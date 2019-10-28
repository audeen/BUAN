<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_edit.php              //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : HTML-Teil retailer_edit      //
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
    H&auml;ndler-Bearbeitung
  </div>

<?php

include ('../../config/config.php');
include ('../../config/retailer_update.php');
include ('../../config/image_upload_r.php');

// Datenbankverbindung herstellen
$pdo;

// Refresh für Abbrechen-Button

if (isset($_SESSION['cancel'])){
  echo "<script type='text/javascript'>window.location='retailer_show.php'; </script>";
}
// Wenn keine ID übermittelt, zeige alle an
$where = !empty($_POST['id_r']) ? "WHERE id_r=\"".$_POST['id_r']."\"" : "";

  $sql = "SELECT * FROM retailer $where";
  echo "<div class=\"ld-center\">\n";
  foreach ($pdo->query($sql) as $row) {
  echo "<div class=\"col-md\">\n";
  echo "<div class=\"card mb-3\">\n";

  echo "<form action=\"#\" method=\"POST\" enctype=\"multipart/form-data\">";
  echo "  <h3 class=\"card-header\">".$row['r_surname'].", ".$row['r_prename']."</h3>\n";
  echo "  <div class=\"card-body\">\n";
  echo "    <h6 class=\"card-subtitle text-muted\">ID: ".$row['id_r']."</h6>\n";
  echo "  </div>\n";
  echo "  <div class=\"card-body\">\n";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_prename\" value=\"".$row['r_prename']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_surname\" value=\"".$row['r_surname']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_alias\" value=\"".$row['r_alias']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_mail\" value=\"".$row['r_mail']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_street\" value=\"".$row['r_street']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_postal\" value=\"".$row['r_postal']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_city\" value=\"".$row['r_city']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_country\" value=\"".$row['r_country']."\">";
  echo "  </div>\n";


  
  echo "    <div class=\"card-body\">";
  echo "      <label class=\"control-label\"><h5>H&auml;ndlerbild festlegen</h5></label>";
  echo "      <input class=\"input-group\" type=\"file\" name=\"image\" value=\"".$row['r_img']."\" accept=\"image/*\" />";
  echo "    </div>";
  echo "  <ul class=\"list-group list-group-flush\">\n";
  echo "    <li class=\"list-group-item\">Status:<br></li>\n";
  echo "  </ul>\n";
  echo "  <ul class=\"list-group list-group-flush\">\n";
  echo "    <li class=\"list-group-item\">";
  

        // Radio-Button-Belegung abfragen
        if ($row['r_blocked'] == 0) {
          $blocked = "";
          $active ="checked";
        }
        else{
          $blocked = "checked";
          $active ="";
        }

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

  echo "    </li>\n";
  echo "  </ul>\n";
 
  echo "  <div class=\"card-body\">\n";
  echo "<button type=\"submit\" class=\"btn btn-outline-success mr-2\" name=\"update\">Aktualisieren</button>";
  echo "<button type=\"submit\" class=\"btn btn-outline-danger\" name=\"cancel\">Abbrechen</button>";
  echo "<input type=\"hidden\" name=\"id_r\" value=\"".$row['id_r']."\">";
  echo "<input type=\"hidden\" name=\"r_saved\" value=\"".time()."\">";
  echo "</form>";
  echo "  </div>\n";
  echo "  <div class=\"card-footer text-muted\">\n";
  echo" Zuletzt bearbeitet: ".(date("d.m.Y, H:i:s",$row['r_saved']));
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
    <?php include ("../control/control.php");?>
  </body>
</html>

