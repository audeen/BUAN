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
            <h3 class="mb-0">Change Password</h3>
      </div>
      <div class="card-body">
            <form class="form" role="form" autocomplete="off">
               <div class="form-group">
                  <label for="inputPasswordNew">New Password</label>
                  <input type="password" name="a_pw" class="form-control" id="inputPasswordNew">
                  <span class="form-text small text-muted">
                           The password must be 8-20 characters, and must <em>not</em> contain spaces.
                        </span>
               </div>
               <div class="form-group">
                  <label for="inputPasswordNewVerify">Verify</label>
                  <input type="password" class="form-control" id="inputPasswordNewVerify">
                  <span class="form-text small text-muted">
                           To confirm, type the new password again.
                        </span>
               </div>
               <div class="form-group">
                  <button type="submit" name="save" class="btn btn-success btn-lg float-right">Save</button>
               </div>
            </form>
      </div>
   </div>
   </form>
                    <!-- /form card change password -->

