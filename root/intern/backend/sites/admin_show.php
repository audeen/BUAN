<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_show.php                 //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Übersichtsseite aller Admins //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();

// Spracharrays lokal verwendet, um Dateien zu sparen
$lang_adminshow = array();
$lang_adminshow[0][0] = "Alle Admins";
$lang_adminshow[0][1] = "Admin hinzuf&uuml;gen";

$lang_adminshow[1][0] = "All Admins";
$lang_adminshow[1][1] = "Add Admin";

?>
<!-- Sicherheitesabfrage einbinden -->
<?php include ('../../backend/functions/authentification.php'); ?>
  <!-- html-head einbinden -->
  <?php include ('../../backend/navigation/html_head.php'); ?>
  <body>
    <!-- backend-navigation einbinden -->
    <?php include ('../../backend/navigation/html_nav_be.php'); ?>

    <div class="container">
      <div class="container-fluid">
        <div class="row">
          <div class="alert alert-primary mt-3 col-12" role="alert">
            <h2 class="text-center">
              <?php echo $lang_adminshow[$_SESSION['language']][0]?>
            </h2>
            <a href="admin_create.php" class="btn btn-success btn-link btn-lg float-right" role="button"><?php echo $lang_adminshow[$_SESSION['language']][1]?></a>
          </div>
        </div>
        <?php include ('../../backend/admin/admin_query.php'); ?>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <?php /* include ("../../control/control.php") */;?>
  </body>
</html>
