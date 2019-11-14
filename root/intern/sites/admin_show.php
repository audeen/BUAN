<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_show.php                 //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : HTML-Teil admin_show        //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();
?>



<!-- Include Security-File -->
<?php include ('../../config/security.php'); ?>



  <!-- html-head einbinden -->
  <?php include ('../../config/html_head.php'); ?>
  <body>
    <!-- backend-navigation einbinden -->
    <?php include ('../../config/html_nav_be.php'); ?>

    <div class="container">
      <div class="container-fluid">
        <div class="row">
          <div class="alert alert-primary mt-3 col-12" role="alert"><h2 class="text-center">Alle Admins</h2><br><br>
          </div>
        </div>
        <?php include ('../../config/admin_query.php'); ?>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <?php include ("../control/control.php");?>
  </body>
</html>
