<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_create.php            //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Admins erstellen             //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();
include('../../../config/config.php');
include($lang_admin_create);



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
    <?php echo $lang_admincreate[$_SESSION['language']][0]; ?>
  </div>

<?php

include ('../../backend/admin/admin_insert.php');


// Datenbankverbindung herstellen
$pdo;

// Refresh für Abbrechen-Button

  echo "<div class=\"ld-center\">\n";
  echo "<div class=\"card mb-3\">\n";
    echo "<form action=\"#\" method=\"POST\">";
      echo "<h5 class=\"card-header\">".$lang_admincreate[$_SESSION['language']][1]."</h5>\n";
/*       echo "<div class=\"card-body\">\n";
        echo "<h6 class=\"card-subtitle text-muted\">".$lang_admincreate[$_SESSION['language']][2]."</h6>\n";
      echo "</div>\n"; */
      echo "<div class=\"card-body\">\n";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"a_name\" placeholder=\"".$lang_admincreate[$_SESSION['language']][2]."\" required>";
        echo "<input type=\"password\"class=\"form-control mb-2\" minlength=\"6\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"a_pw\" placeholder=\"".$lang_admincreate[$_SESSION['language']][3]."\" required>";
        echo "<input type=\"password\"class=\"form-control mb-2\" minlength=\"6\" id=\"exampleFormControlTextarea1\" rows=\"3\" name=\"a_pw_verify\" placeholder=\"".$lang_admincreate[$_SESSION['language']][4]."\" required>";
        echo "<input class=\"form-control mb-2\" id=\"exampleFormControlTextarea1\" rows=\"3\" type=\"email\" name=\"a_mail\" placeholder=\"E-Mail\" required>";
      echo "</div>\n";
      echo "<div class=\"card-body\">\n";
        echo "<input type=\"hidden\" name=\"a_saved\" value=\"".time()."\">";
        echo "<button type=\"submit\" class=\"btn btn-outline-success mr-2\" name=\"update\">".$lang_admincreate[$_SESSION['language']][5]."</button>";
        echo "<input type=\"reset\" class=\"btn btn-outline-warning mr-2\" value=".$lang_admincreate[$_SESSION['language']][6]." formnovalidate>";
        echo "<a href=\"admin_show.php\" class=\"btn btn-outline-danger\"  formnovalidate>".$lang_admincreate[$_SESSION['language']][7]."</a>";
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
    <?php include ("../../control/control.php");?>
  </body>
</html>

