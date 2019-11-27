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
          <div class="alert alert-primary mt-3 col-12" role="alert"><h2 class="text-center"><?php echo $lang_ordershow[$_SESSION['language']][0];?></h2>
            <form id="retailers" action="#" method="POST">
            <?php
            // Query für Dropdown-Menü mit selected, falls ein Händler ausgewählt wurde
              $sql = "SELECT * FROM retailer";
              echo "<select class=\"form-control\" name=\"retailer\">";
                foreach ($pdo->query($sql) as $row) {
                  echo "<option value=\"".$row['id_r']."\"".((($_POST['retailer']) == $row['id_r'])? 'selected="selected"' : "").">".$row['r_surname'].", ".$row['r_prename']."</option>";
                }
            // Ohne Auswahl werden alle Händler angezeigt
                echo "<option value=\"all\"".((!isset($_POST['retailer']) OR (($_POST['retailer']) == "all" ))? 'selected="selected"' : "").">".$lang_ordershow[$_SESSION['language']][9]."</option>";
              echo "</select>";
            // Vorbelegung für Erstaufruf      
              if (!isset($_POST['month'])){
                $_POST['month'] = 'all';
              }
              if (!isset($_POST['year'])){
                $_POST['year'] = date("Y");
              }
            ?>
              <select class="form-control" name="month">
                <option value=1 <?php if (($_POST['month']) == 1 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][1];?></option>
                <option value=2 <?php if (($_POST['month']) == 2 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][2];?></option>
                <option value=3 <?php if (($_POST['month']) == 3 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][3];?></option>
                <option value=4 <?php if (($_POST['month']) == 4 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][4];?></option>
                <option value=5 <?php if (($_POST['month']) == 5 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][5];?></option>
                <option value=6 <?php if (($_POST['month']) == 6 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][6];?></option>
                <option value=7 <?php if (($_POST['month']) == 7 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][7];?></option>
                <option value=8 <?php if (($_POST['month']) == 8 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][8];?></option>
                <option value=9 <?php if (($_POST['month']) == 9 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][9];?></option>
                <option value=10 <?php if (($_POST['month']) == 10 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][10];?></option>
                <option value=11 <?php if (($_POST['month']) == 11 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][11];?></option>
                <option value=12 <?php if (($_POST['month']) == 12 ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][12];?></option>
                <option value="all" <?php if (($_POST['month']) == "all" ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][13];?></option>
              <select>
              <select class="form-control" name="year">
                <option value="2019" <?php if (($_POST['year']) == 2019 ) echo 'selected';?>>2019</option>
                <option value="2020" <?php if (($_POST['year']) == 2020 ) echo 'selected';?>>2020</option>
                <option value="2021" <?php if (($_POST['year']) == 2021 ) echo 'selected';?>>2021</option>
              <select>
              <?php
              // Ist ein Händler und ein Monat gewählt, erscheint ein Button zur Abrechnung
                if(isset($_POST['year']) and ($_POST['month']) != "all" and ($_POST['retailer']) != "all" ){
                  echo "<button type=\"submit\" href=\"#\" class=\"btn btn-success btn-lg float-left mt-2\" role=\"button\">".$lang_ordershow[$_SESSION['language']][10]."</button>";
                }
              ?>
              <button type="submit" href="#" class="btn btn-success btn-lg float-right mt-2" role="button"><?php echo $lang_ordershow[$_SESSION['language']][8]?></button>
            </form>
          </div>
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
