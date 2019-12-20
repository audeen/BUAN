<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_edit.php              //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Retailer bearbeiten          //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();
include('../../../config/config.php');
include($lang_retailer_edit);
?>


<!-- Include Security-File -->
<?php include ('../../backend/functions/authentification.php'); ?>

<!-- html-head einbinden -->
<?php include ('../../backend/navigation/html_head.php'); ?>
<body>
    <!-- backend-navigation einbinden -->
  <?php include ('../../backend/navigation/html_nav_be.php'); ?>

<div class="container">

  <div class="alert alert-warning mt-3" role="alert">
    <?php echo $lang_retaileredit[$_SESSION['language']][0]; ?>
  </div>

<?php


include ('../../backend/retailer/retailer_update.php');
include ('../../backend/functions/image_upload_r.php');
include ('../../backend/retailer/retailer_pw_reset.php');

// Datenbankverbindung herstellen
$pdo;

// Refresh für Abbrechen-Button

if (isset($_SESSION['cancel'])){
  echo "<meta http-equiv=\"refresh\" content=\"0;url=retailer_show.php\">";
}

// Wenn keine ID übermittelt, gehe auf Übersicht
if (empty($_POST['id_r'])) {
  echo "<meta http-equiv=\"refresh\" content=\"0;url=retailer_show.php\">";
}
  $sql = "SELECT * FROM retailer WHERE id_r=\"".$_POST['id_r']."\"";
  echo "<div class=\"ld-center\">\n";
  foreach ($pdo->query($sql) as $row) {
  echo "<div class=\"col-md\">\n";
    echo "<div class=\"card mb-3\">\n";
      echo "<form action=\"#\" method=\"POST\" enctype=\"multipart/form-data\">";
        echo "<h3 class=\"card-header\">".$row['r_surname'].", ".$row['r_prename']."</h3>\n";
        echo "<div class=\"card-body\">\n";
          echo "<h6 class=\"card-subtitle text-muted\">ID: ".$row['id_r']."</h6>\n";
        echo "</div>\n";
        echo "<div class=\"card-body\">\n";
          echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_prename\" value=\"".$row['r_prename']."\">";
          echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_surname\" value=\"".$row['r_surname']."\">";
          echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_alias\" value=\"".$row['r_alias']."\">";
          echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" type=\"email\" name=\"r_mail\" value=\"".$row['r_mail']."\">";
          echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_street\" value=\"".$row['r_street']."\">";
          echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" type=\"number\" name=\"r_postal\" value=\"".$row['r_postal']."\">";
          echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_city\" value=\"".$row['r_city']."\">";
          echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_country\" value=\"".$row['r_country']."\">";
        echo "</div>\n";        
        echo "<div class=\"card-body\">";
          echo "<label class=\"control-label\"><h5>".$lang_retaileredit[$_SESSION['language']][8]."</h5></label>";
          echo "<input class=\"input-group\" type=\"file\" name=\"image\" value=\"".$row['r_img']."\" accept=\"image/*\" />";
        echo "</div>";

        // Radio-Button-Belegung abfragen
        if ($row['r_blocked'] == 0) {
          $blocked = "";
          $active ="checked";
        }
        else{
          $blocked = "checked";
          $active ="";
        }
        echo "<ul class=\"list-group list-group-flush\">\n";
          echo "<li class=\"list-group-item\">";  
          echo "<div class=\"form-check mb-2\">\n";
            echo "<h5>Status:</h5>";
            echo "<input class=\"form-check-input\" type=\"radio\" name=\"r_blocked\" id=\"exampleRadios1\" value=\"0\"".$active."\n";
            echo "<label class=\"form-check-label\" for=\"exampleRadios1\">\n";
              echo $lang_retaileredit[$_SESSION['language']][1];
            echo "</label>\n";
          echo "</div>";
        echo "<div class=\"form-check mb-2\">\n";
          echo "<input class=\"form-check-input\" type=\"radio\" name=\"r_blocked\" id=\"exampleRadios1\" value=\"1\"".$blocked."\n";
          echo "<label class=\"form-check-label\" for=\"exampleRadios1\">\n";
          echo $lang_retaileredit[$_SESSION['language']][2];
          echo "</label>\n";
          echo "</div>";
          echo "</li>\n";
        echo "</ul>\n";

        echo "<ul class=\"list-group list-group-flush\">\n";
        echo "<li class=\"list-group-item\">";
            echo "<button type=\"submit\" class=\"btn btn-primary mb-2 mt-2\" name=\"pw\">".$lang_retaileredit[$_SESSION['language']][6]."</button>";

          // Ist der Vorgang gestartet, schalte Button für E-Mail-Versand frei
          if (isset($_POST['pw'])) {
            $linkToSend = urlencode($linkToSend);
            echo "<br>";
            echo "<a class=\"btn btn-outline-success\" href=\"mailto:".$_POST['r_mail']."?subject=".$lang_retaileredit[$_SESSION['language']][6]."&body=".$linkToSend."\">".$lang_retaileredit[$_SESSION['language']][7]."</a>";
          }
        echo "</li>\n";
        echo "</ul>\n";
      
        echo "<div class=\"card-body\">\n";
          echo "<button type=\"submit\" class=\"btn btn-outline-success mr-2\" name=\"update\">".$lang_retaileredit[$_SESSION['language']][3]."</button>";
          echo "<input type=\"reset\" class=\"btn btn-outline-warning mr-2\" value=".$lang_retaileredit[$_SESSION['language']][9]." formnovalidate>";
          echo "<a href=\"retailer_show.php\" class=\"btn btn-outline-danger\" formnovalidate>".$lang_retaileredit[$_SESSION['language']][4]."</a>";
          echo "<input type=\"hidden\" name=\"id_r\" value=\"".$row['id_r']."\">";
          echo "<input type=\"hidden\" name=\"r_saved\" value=\"".time()."\">";
        echo "</div>\n";
      echo "</form>";
        echo "<div class=\"card-footer text-muted\">\n";
        echo $lang_retaileredit[$_SESSION['language']][5].(date("d.m.Y, H:i:s",$row['r_saved']));
        echo "</div>\n";
      echo "</form>";
    echo "</div>\n";
  echo "</div>\n";
}
echo "</div>";

?>

</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <?php /* include ("../../control/control.php") */;?>
  </body>
</html>

