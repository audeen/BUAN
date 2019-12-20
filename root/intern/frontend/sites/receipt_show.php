<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_show.php              //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Rechnungsübersicht für PDF   //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();

include('../../../config/config.php');
include($lang_product_show);

?>


<!-- Include Security-File -->
<?php include('../../frontend/functions/authentification.php'); ?>

<!DOCTYPE html>
<html lang="de">
  <!-- html-head einbinden -->
  <?php include ('../../frontend/navigation/html_head.php'); ?>
  <body>
    <!-- frontend-navigation einbinden -->
    <?php include ('../../frontend/navigation/html_nav_fe.php'); ?>

    <div class="container">
      <div class="container-fluid">
        <div class="row">

        </div>
      </div>
      <?php include ('../../backend/functions/receipt.php'); ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <?php /* include ("../../control/control.php") */;?>
  </body>
</html>
