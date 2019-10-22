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
    Produkt-Bearbeitung
  </div>

<?php

include ('../../config/config.php');

include ('../../config/product_update.php');

// Datenbankverbindung herstellen
$pdo;

// Refresh für Abbrechen-Button

if (isset($_SESSION['cancel'])){
  header("Refresh:0");
}

// Wenn keine ID übermittelt, zeige alle an
$where = !empty($_POST['id_p']) ? "WHERE id_p=\"".$_POST['id_p']."\"" : "";
  $sql = "SELECT * FROM products $where";
  echo "<div class=\"ld-center\">\n";
  foreach ($pdo->query($sql) as $row) {
  echo "<div class=\"col-md\">\n";
  echo "<div class=\"card mb-3\">\n";

  echo "<form action=\"#\" method=\"POST\">";
  echo "  <h3 class=\"card-header\">".$row['p_name_0']."</h3>\n";
  echo "  <div class=\"card-body\">\n";
  echo "    <h6 class=\"card-subtitle text-muted\">ID: ".$row['id_p']."</h6>\n";
  echo "  </div>\n";
  echo "  <div class=\"card-body\">\n";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_name_0\" value=\"".$row['p_name_0']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_name_1\" value=\"".$row['p_name_1']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_origin_0\" value=\"".$row['p_origin_0']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_origin_1\" value=\"".$row['p_origin_1']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_txt_0\" value=\"".$row['p_txt_0']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_txt_1\" value=\"".$row['p_txt_1']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_price\" value=\"".$row['p_price']."\">";
  echo "    <input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_count\" value=\"".$row['p_count']."\">";

  echo "  </div>\n";
  /* echo "  <img style=\"height: 200px; width: 100%; display: block;\" src=\"data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22318%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20318%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158bd1d28ef%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158bd1d28ef%22%3E%3Crect%20width%3D%22318%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22129.359375%22%20y%3D%2297.35%22%3EImage%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E\" alt=\"Card image\">\n"; */
/*     echo "  <div class=\"card-body\">\n";
  echo "  </div>\n"; */


  echo "  <ul class=\"list-group list-group-flush\">\n";
  echo "    <li class=\"list-group-item\">Status:<br></li>\n";
  echo "  </ul>\n";
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
    <?php include ("../control/control.php");?>
  </body>
</html>

