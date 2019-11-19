<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_show.ph               //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : HTML-Teil retailer_show      //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();

include('../../config/config.php');
include($lang_product_show);

?>


<!-- Include Security-File -->
<?php include ('../../config/security.php'); ?>



<!DOCTYPE html>
<html lang="de">
  <!-- html-head einbinden -->
  <?php include ('../../config/html_head.php'); ?>
  <body>
    <!-- backend-navigation einbinden -->
    <?php include ('../../config/html_nav_be.php'); ?>

    <div class="container">
      <div class="container-fluid">
        <div class="row">
          <div class="alert alert-primary mt-3 col-12" role="alert"><h2 class="text-center"><?php echo $lang_productshow[$_SESSION['language']][9];?></h2>
             <a href="product_create.php" class="btn btn-success btn-link btn-lg float-right" role="button"><?php echo $lang_productshow[$_SESSION['language']][10];?></a>
          </div>
        </div>
      </div>
      <?php include ('../../config/product_query.php'); ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php include ("../control/control.php");?>
  </body>
</html>
