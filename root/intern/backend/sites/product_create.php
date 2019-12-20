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
include ('../../../config/config.php');
include($lang_product_create);


//Include Security-File 
include ('../../backend/functions/authentification.php');

//html-head einbinden
include ('../../backend/navigation/html_head.php');
echo "<body>";
//backend-navigation einbinden
include ('../../backend/navigation/html_nav_be.php');

?>

<div class="container">
  <div class="alert alert-primary mt-3" role="alert">
  <?php echo $lang_productcreate[$_SESSION['language']][0];?>
  </div>

<?php
include ('../../backend/products/product_insert.php');
include ('../../backend/functions/image_upload_p.php');
// Datenbankverbindung herstellen
$pdo;


  echo "<div class=\"ld-center\">\n";
  echo "<div class=\"card mb-3\">\n";
    echo "<form action=\"#\" method=\"POST\" enctype=\"multipart/form-data\">";
      echo "<h5 class=\"card-header\">".$lang_productcreate[$_SESSION['language']][1]."</h5>\n";
      echo "<div class=\"card-body\">\n";
        echo "<h6 class=\"card-subtitle text-muted\">".$lang_productcreate[$_SESSION['language']][2]."</h6>\n";
      echo "</div>\n";
      echo "<div class=\"card-body\">\n";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_name\" placeholder=\"".$lang_productcreate[$_SESSION['language']][3]."\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_origin\" placeholder=\"".$lang_productcreate[$_SESSION['language']][4]."\" required>";
        echo "<div class=\"form-group\">";
          echo "<textarea class=\"form-control\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"p_desc\" placeholder=\"".$lang_productcreate[$_SESSION['language']][5]."\"></textarea>";
        echo "</div>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" type=\"number\" name=\"p_price\" placeholder=\"".$lang_productcreate[$_SESSION['language']][6]."\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" type=\"number\" name=\"p_amount\" placeholder=\"".$lang_productcreate[$_SESSION['language']][7]."\" required>";
      echo "</div>\n";
      echo "<div class=\"card-body\">";
        echo "<label class=\"control-label\"><h5>".$lang_productcreate[$_SESSION['language']][8]."</h5></label>";
        echo "<input class=\"input-group\" type=\"file\" name=\"image\">";
      echo "</div>";
      echo "<div class=\"card-body\">\n";
        echo "<input type=\"hidden\" name=\"p_saved\" value=\"".time()."\">";
        echo "<button type=\"submit\" class=\"btn btn-outline-success mr-2\" name=\"update\">".$lang_productcreate[$_SESSION['language']][9]."</button>";
        echo "<input type=\"reset\" class=\"btn btn-outline-warning mr-2\" value=".$lang_productcreate[$_SESSION['language']][11]." formnovalidate>";
        echo "<a href=\"product_show.php\" class=\"btn btn-outline-danger\" formnovalidate>".$lang_productcreate[$_SESSION['language']][10]."</a>";
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

