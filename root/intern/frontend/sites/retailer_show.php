<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_show.ph               //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Händler anzeigen             //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();
include ('../../../config/config.php');

// Spracharrays lokal verwendet, um Dateien zu sparen
$lang_retailershow = array();
$lang_retailershow[0][0] = "Ihr Profil";

$lang_retailershow[1][0] = "Your Profile";

?>
<!-- Include Security-File -->
<?php include ('../../frontend/functions/authentification.php'); ?>

<!DOCTYPE html>
<html lang="de">
  <!-- html-head einbinden -->
  <?php include ('../../frontend/navigation/html_head.php'); ?>
  <body>
    <!-- backend-navigation einbinden -->
    <?php include ('../../frontend/navigation/html_nav_fe.php'); ?>

    <div class="container">
      <div class="container-fluid">
        <div class="row">
          <div class="alert alert-primary mt-3 col-12" role="alert">
            <h2 class="text-center"><?php echo $lang_retailershow[$_SESSION['language']][0]?></h2>
          </div>
        </div>
      </div>
      <?php include ('../../backend/retailer/retailer_query.php'); ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <?php include ("../../control/control.php");?>
  </body>
</html>
