<!DOCTYPE html>
<html lang="en">
  <!-- html-head einbinden -->
  <?php include ('../config/html_head.html'); ?>
  <body>

    <!-- frontend-navigation einbinden -->
    <?php include ('../config/html_nav_fe.html'); ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <div class="container"><?php include ("../control/control.php");?></div>
    
  </body>
</html>
