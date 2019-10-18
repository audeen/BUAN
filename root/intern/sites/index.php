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

?>


<!-- Include Security-File -->
<?php include ('../../config/security.php'); ?>



  <!-- html-head einbinden -->
  <?php include ('../../config/html_head.php'); ?>
  <body>
    
    <!-- backend-navigation einbinden -->
    <?php include ('../../config/html_nav_be.php'); ?>
  <div class="container">

  <div class="alert alert-primary mt-3" role="alert">
        Wilkommen im Backend, wählen Sie eine Funktion
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

