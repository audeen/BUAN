<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   order_show.php                 //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Übersichtsseite Bestellungen //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();

include('../../../config/config.php');
include($lang_order_show);

// Wenn POST-Variablen gesetzt sind, 

if(isset($_POST['year']) and ($_POST['month'])) {
  $datum = date("Y-m-t", strtotime($_POST['year']."-".$_POST['month']));
  
}  
else {
  $datum ="";
  }

//Include Security-File
include ('../../frontend/functions/authentification.php'); 
?>

<html lang="de">
  <!-- html-head einbinden -->
  <?php include ('../../frontend/navigation/html_head.php'); ?>
  <body>
    <!-- frontend-navigation einbinden -->
    <?php include ('../../frontend/navigation/html_nav_fe.php'); ?>
    
    <div class="container">
      <div class="container-fluid">
        <div class="row">
          <div class="alert alert-primary mt-3 col-12" role="alert"><h2 class="text-center"><?php echo $lang_ordershow[$_SESSION['language']][0];?></h2>
            <form action="#" method="POST">
            <?php
            
              // Query für Dropdown-Menü mit selected, falls ein Händler ausgewählt wurde
              // Nur den angemeldeten Händler zeigen

                  $id = $_SESSION['user_id_r'];
                  $sql = "SELECT * FROM retailer WHERE `id_r` = $id";
                
              echo "<select class=\"form-control mt-2\" name=\"retailer\">";
                foreach ($pdo->query($sql) as $row) {
                  echo "<option value=\"".$row['id_r']."\"".((($_POST['retailer']) == $row['id_r'])? 'selected="selected"' : "").">".$row['r_surname'].", ".$row['r_prename']."</option>";
                }
              echo "</select>";
            // Vorbelegung für Erstaufruf      
              if (!isset($_POST['month'])){
                $_POST['month'] = 'all';
              }
              if (!isset($_POST['year'])){
                $_POST['year'] = date("Y");
              }
            
            // Dropdown für Monat + Jahr
            ?>
                         
             <select class="form-control mt-2" name="month">
                <option value="all" <?php if (($_POST['month']) == "all" ) echo 'selected';?>><?php echo $lang_ordershowcalendar[$_SESSION['language']][13];?></option>
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
                
              <select>
              <select class="form-control mt-2" name="year">
                <option value="2019" <?php if (($_POST['year']) == 2019 ) echo 'selected';?>>2019</option>
                <option value="2020" <?php if (($_POST['year']) == 2020 ) echo 'selected';?>>2020</option>
                <option value="2021" <?php if (($_POST['year']) == 2021 ) echo 'selected';?>>2021</option>
              <select>
              <button type="submit" name="show" href="#" class="btn btn-success btn-lg float-right mb-2 mt-4" role="button"><?php echo $lang_ordershow[$_SESSION['language']][8]?></button>
              </form>
              <?php

                // Ist ein Händler und ein Monat gewählt, erscheint ein Button zur Abrechnung mit hidden-inputs zur Weitergabe über POST + Rechnungen in der Zukunft nicht möglich
                if(isset($_POST['year']) and ($_POST['month']) != "all" ){
                    $retailer = $_POST['retailer'];
                    $year = $_POST['year'];
                    $month1 = $_POST['month'];
                    //Rechnungsnummer in Variable schreiben für Abgleich mit Datenbank
                    
                    
                    echo "<form action=\"billing.php\" method=\"POST\">";
                      echo "<input type=\"hidden\" name=\"retailer\" value=\"".$retailer."\"></input>";
                      echo "<input type=\"hidden\" name=\"year\" value=\"".$year."\"></input>";
                      echo "<input type=\"hidden\" name=\"month\" value=\"".$month1."\"></input>";
                      echo "<button type=\"submit\" class=\"btn btn-success btn-lg float-left mb-2 mt-2\" role=\"button\">".$lang_ordershow[$_SESSION['language']][10]."</button>";
                    echo "</form>";
                }

                //Frage nach pdf auf englisch oder deutsch
                $pdf_name = $lang_ordershow[$_SESSION['language']][12].$_POST['year']."-".$_POST['month']."-".$_SESSION['user_id_r'].".pdf";
                $pdo;
                $sql = "SELECT * FROM bills WHERE `r_id` = $id AND `pdf` = '$pdf_name'";
                
                foreach ($pdo->query($sql) as $row) {
                  echo "<div class=\"text-center\">";
                    echo "<a type=\"button\" class=\"text-decoration-none btn btn-info btn-lg mb-2 mt-2\" href=\"../../pdf/".$row['pdf']."\" target=\"_blank\">".$lang_ordershow[$_SESSION['language']][11]."</a>";
                  echo "</div>";
                }
              
              ?>
            </form>  
          </div>
        </div>
      </div>
      <?php include ('../../backend/orders/order_query.php'); ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <?php include ("../../control/control.php");?>
  </body>
</html>
