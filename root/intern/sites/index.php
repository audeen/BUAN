<!-- Include Security-File -->
<?php include ('../../config/security.php'); ?>


<html lang="de">
  <!-- html-head einbinden -->
  <?php include ('../../config/html_head.html'); ?>
  <body>

    <!-- backend-navigation einbinden -->
    <?php include ('../../config/html_nav_be.php'); ?>


    <div class="container-fluid">
        Wilkommen im Backend, bitte wählen Sie eine Funktion
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <div class="container"><?php include ("../control/control.php");?></div>
  </body>
</html>

