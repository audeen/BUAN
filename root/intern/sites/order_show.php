<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   order_show.php                 //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : HTML-Teil order_show         //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();

include('../../config/config.php');
include($lang_order_show);

?>


<!-- Include Security-File -->
<?php include ('../../config/functions/authentification.php'); ?>



<!DOCTYPE html>
<html lang="de">
  <!-- html-head einbinden -->
  <?php include ('../../config/navigation/html_head.php'); ?>
  <body>
    <!-- backend-navigation einbinden -->
    <?php include ('../../config/navigation/html_nav_be.php'); ?>

    <div class="container">
      <div class="container-fluid">
        <div class="row">
          <div class="alert alert-primary mt-3 col-12" role="alert"><h2 class="text-center"><?php echo $lang_ordershow[$_SESSION['language']][0];?></h2></div>
        </div>
      </div>
      <?php include ('../../config/orders/order_query.php'); ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php include ("../control/control.php");?>
  </body>
</html>
