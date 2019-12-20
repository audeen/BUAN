<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_create.php            //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Retailer ERstellen           //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();
include('../../../config/config.php');
include($lang_retailer_create);
?>


<!-- Include Security-File -->
<?php include ('../../backend/functions/authentification.php'); ?>

<!-- html-head einbinden -->
<?php include ('../../backend/navigation/html_head.php'); ?>
<body>
    <!-- backend-navigation einbinden -->
  <?php include ('../../backend/navigation/html_nav_be.php'); ?>


<div class="container">

  <div class="alert alert-primary mt-3" role="alert">
    <?php echo $lang_retailercreate[$_SESSION['language']][0]; ?>
  </div>

<?php

include ('../../backend/retailer/retailer_insert.php');
include ('../../backend/functions/image_upload_r.php');

// Datenbankverbindung herstellen
$pdo;

// Refresh für Abbrechen-Button

if (isset($_SESSION['cancel'])){
  echo "<meta http-equiv=\"refresh\" content=\"0;url=product_create.php\">";
}

  echo "<div class=\"ld-center\">\n";
  echo "<div class=\"card mb-3\">\n";
    echo "<form action=\"#\" method=\"POST\" enctype=\"multipart/form-data\">";
      echo "<h5 class=\"card-header\">".$lang_retailercreate[$_SESSION['language']][1]."</h5>\n";
      echo "<div class=\"card-body\">\n";
        echo "<h6 class=\"card-subtitle text-muted\">".$lang_retailercreate[$_SESSION['language']][2]."</h6>\n";
      echo "</div>\n";
      echo "<div class=\"card-body\">\n";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_prename\" placeholder=\"".$lang_retailercreate[$_SESSION['language']][3]."\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_surname\" placeholder=\"".$lang_retailercreate[$_SESSION['language']][4]."\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_alias\" placeholder=\"Alias\" required>";
        echo "<input type=\"password\"class=\"form-control mb-2\" minlength=\"6\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_pw\" placeholder=\"".$lang_retailercreate[$_SESSION['language']][5]."\" required>";
        echo "<input type=\"password\"class=\"form-control mb-2\" minlength=\"6\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_pw_verify\" placeholder=\"".$lang_retailercreate[$_SESSION['language']][13]."\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" type=\"email\" name=\"r_mail\" placeholder=\"E-Mail\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_street\" placeholder=\"".$lang_retailercreate[$_SESSION['language']][6]."\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" type=\"number\" name=\"r_postal\" placeholder=\"".$lang_retailercreate[$_SESSION['language']][7]."\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_city\" placeholder=\"".$lang_retailercreate[$_SESSION['language']][8]."\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"r_country\" placeholder=\"".$lang_retailercreate[$_SESSION['language']][9]."\" required>";
      echo "</div>\n";
      echo "<div class=\"card-body\">";
        echo "<label class=\"control-label\"><h5>".$lang_retailercreate[$_SESSION['language']][10]."</h5></label>";
        echo "<input class=\"input-group\" type=\"file\" name=\"image\" accept=\"image/*\" />";
      echo "</div>";
      echo "<div class=\"card-body\">\n";
        echo "<input type=\"hidden\" name=\"r_saved\" value=\"".time()."\">";
        echo "<button type=\"submit\" class=\"btn btn-outline-success mr-2\" name=\"update\">".$lang_retailercreate[$_SESSION['language']][11]."</button>";
        echo "<input type=\"reset\" class=\"btn btn-outline-warning mr-2\" value=".$lang_retailercreate[$_SESSION['language']][15]." formnovalidate>";
        echo "<a href=\"retailer_show.php\" class=\"btn btn-outline-danger\"  formnovalidate>".$lang_retailercreate[$_SESSION['language']][12]."</a>";
      echo "</form>";
    echo "</div>\n";
    echo "</div>\n";
    echo "</div>\n";
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

