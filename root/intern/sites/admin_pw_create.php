<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_edit.php                 //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : HTML-Teil admin_edit         //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();
include ('../../config/config.php');

// Spracharrays lokal verwendet, um Dateien zu sparen
$lang_apwcreate = array();
$lang_apwcreate[0][0] = "Passwort &auml;ndern";
$lang_apwcreate[0][1] = "Neues Passwort";
$lang_apwcreate[0][2] = "Passwort best&auml;tigen";
$lang_apwcreate[0][3] = "Speichern";

$lang_apwcreate[1][0] = "Change Password";
$lang_apwcreate[1][1] = "New Password";
$lang_apwcreate[1][2] = "Verify";
$lang_apwcreate[1][3] = "Save";


?>


<!-- Include Security-File -->
  <?php include ('../../config/security.php'); ?>
<!-- html-head einbinden -->
  <?php include ('../../config/html_head.php'); ?>
  
<body>
    <!-- backend-navigation einbinden -->
  <?php include ('../../config/html_nav_be.php'); ?>

<div class="container">

<?php

include ('../../config/config.php');
include ('../../config/admin_pw_change.php');



// Datenbankverbindung herstellen
$pdo;

?>
<form action="#" method="POST">
<div class="col-md-6 offset-md-3">
   <span class="anchor" id="formChangePassword"></span>
   <hr class="mb-5">

   <!-- form card change password -->
   <div class="card card-outline-secondary">
      <div class="card-header">
            <h3 class="mb-0"><?php echo $lang_apwcreate[$_SESSION['language']][0]?></h3>
      </div>
      <div class="card-body">
            <form class="form" role="form" autocomplete="off">
               <div class="form-group">
                  <label for="inputPasswordNew"><?php echo $lang_apwcreate[$_SESSION['language']][1]?></label>
                  <input type="password" name="a_pw" class="form-control" id="inputPasswordNew">
               </div>
               <div class="form-group">
                  <label for="inputPasswordNewVerify"><?php echo $lang_apwcreate[$_SESSION['language']][2]?></label>
                  <input type="password" name="a_pw_verify" class="form-control" id="inputPasswordNewVerify">
               </div>
               <div class="form-group">
                  <button type="submit" name="save" class="btn btn-success btn-lg float-right"><?php echo $lang_apwcreate[$_SESSION['language']][3]?></button>
               </div>
            </form>
      </div>
   </div>
   </form>
                    <!-- /form card change password -->

