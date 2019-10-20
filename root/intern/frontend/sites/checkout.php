<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   index.php                      //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Startseite frontend           //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();
include('../../../config/config.php');
include($lang_index_be);

?>

<!-- Include Security-File -->
<?php include ('../../../intern/frontend/functions/authentification.php'); ?>

  <!-- html-head einbinden -->
  <?php include ('../../../intern/frontend/navigation/html_head.php'); ?>
  <body>
    
    <!-- frontend-navigation einbinden -->
    <?php include ('../../../intern/frontend/navigation/html_nav_fe.php'); ?>
  <div class="container">


  <?php include ('../../../intern/frontend/functions/checkout.php'); ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
<!--     <div class="container"><?php /* include ("../control/control.php"); */?></div> -->
  </body>
</html>

