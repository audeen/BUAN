<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   index.php                      //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Startseite Backend           //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();
include('../../config/config.php');
include($lang_index_be);

?>

<!-- Include Security-File -->
<?php include ('../../config/functions/authentification.php'); ?>



  <!-- html-head einbinden -->
  <?php include ('../../config/navigation/html_head.php'); ?>
  <body>
    
    <!-- backend-navigation einbinden -->
    <?php include ('../../config/navigation/html_nav_be.php'); ?>
  <div class="container">

  <div class="alert alert-primary mt-3" role="alert">
    <?php echo $lang[$_SESSION['language']][0]?>
  </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
<!--     <div class="container"><?php /* include ("../control/control.php"); */?></div> -->
  </body>
</html>

