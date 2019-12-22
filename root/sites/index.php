
<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   index.php                      //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Startseite                   //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
session_start();
include('../config/config.php');
include($lang_index);

// CAPTCHA-Funktion aus Semester IV
function anzeige()
{
// zwei zufällige Zahlen ermitteln -------
$_SESSION['wert1'] = rand(0,100);
$_SESSION['wert2'] = rand(0,100);
// Berechnung des Ergebnisses ------------
$_SESSION['ergebnis'] = $_SESSION['wert1']
+ $_SESSION['wert2'];
}
//Erstaufruf
if (!isset($_POST['captcha_erg'])){
  anzeige();
}



if (isset($_POST['retailer_login'])) {
  unset($_POST['admin_login']);
  unset($_POST['retailer_login']);
}
?>



  <!-- html-head einbinden -->
  <?php include ('html_head.php'); ?>
<body>

  <!-- frontend-navigation einbinden -->
  <?php include ('html_nav.php'); ?>
  <?php include ('../intern/backend/functions/php_login_be.php'); ?>
  <?php include ('../intern/frontend/functions/php_login_fe.php'); ?>
<div class="container">
  <div class="mt-2">
    <form action="#" method="post">
    <?php
    if (!isset($_POST['r_mail'])){

      if (isset($_POST['admin_login'])){
        unset($_POST['retailer_login']);
        echo "<div class=\"form-group \">\n";
          echo "<label >Admin-Alias</label>\n";
          echo "<input type=\"text\" name=\"username\"class=\"form-control\" aria-describedby=\"emailHelp\" placeholder=\"".$lang[$_SESSION['language']][0]."\" autofocus>\n";
        echo "</div>\n";
        echo "<div class=\"form-group \">\n";
          echo "<label>".$lang[$_SESSION['language']][1]."</label>\n";
          echo "<input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"".$lang[$_SESSION['language']][1]."\">\n";
        echo "</div>\n";
        echo "<div class=\"captcha\">";
        echo "<div class=\"captcha_field\">";
          echo "<p>".$lang[$_SESSION['language']][4]."</p>";
          echo "<div class=\"equation\" >".$_SESSION['wert1']." + ".$_SESSION['wert2']." = </div>";
          echo "<input class=\"text mt-2 mb-2\" name=\"captcha_erg\" type=\"text\" size=\"10\" maxlength=\"10\" placeholder=\"CAPTCHA\" >";
        echo "</div>";
        echo "<button type=\"submit\" name=\"login_be\" class=\"btn btn-primary\">".$lang[$_SESSION['language']][2]."</button>\n";
        echo "<button type=\"submit\" name=\"retailer_login\" class=\"btn btn-primary float-right\">".$lang[$_SESSION['language']][3]."</button>\n";
      
    echo "</div>\n";
          }
      else {
        echo "<div class=\"form-group \">\n";
        echo "<label >Alias</label>\n";
        echo "<input type=\"text\" name=\"username\"class=\"form-control\" aria-describedby=\"emailHelp\" placeholder=\"".$lang[$_SESSION['language']][0]."\"autofocus required>\n";
      echo "</div>\n";
      echo "<div class=\"form-group \">\n";
        echo "<label>".$lang[$_SESSION['language']][1]."</label>\n";
        echo "<input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"".$lang[$_SESSION['language']][1]."\" required>\n";
      echo "</div>\n";
      echo "<div class=\"captcha\">";
      echo "<div class=\"captcha_field\">";
        echo "<p>".$lang[$_SESSION['language']][4]."</p>";
        echo "<div class=\"equation\" >".$_SESSION['wert1']." + ".$_SESSION['wert2']." = </div>";
        echo "<input class=\"text mt-2 mb-2\" name=\"captcha_erg\" type=\"text\" size=\"10\" maxlength=\"10\" placeholder=\"CAPTCHA\" required>";
      echo "</div>";
      echo "<button type=\"submit\" name=\"login_fe\"  class=\"btn btn-primary\">".$lang[$_SESSION['language']][2]."</button>\n";
      

  echo "</div>\n";
      }}
    
    elseif (isset($_POST['r_mail'])) {

      include("retailer_pw_reset.php");
      $linkToSend = urlencode($linkToSend);
      echo "<div class=\"m-4\">";
        echo "<a class=\"btn btn-success m-2\" href=\"mailto:".$_POST['r_mail']."?subject=".$lang[$_SESSION['language']][7]."&body=".$linkToSend."\">".$lang[$_SESSION['language']][10]."</a>";
        echo "<a class=\"btn btn-danger m-2\" href=\"index.php\">".$lang[$_SESSION['language']][11]."</a>";
      echo "</div>";
      unset($_POST['r_mail']);
  };
  
    
?>
</form>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><?php echo $lang[$_SESSION['language']][2];?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="#" method="post">
                  <div class="modal-body">
                    <input type="text" name="r_mail" placeholder="E-Mail">
                    <br>
                    <br>
                    <p>
                      <?php echo $lang[$_SESSION['language']][8];?>
                    </p>
                    <?php 
                      if (isset($_POST['r_mail'])) {

                        include("retailer_pw_reset.php");
                        $button = "<a class=\"btn btn-outline-success\" href=\"mailto:".$_POST['r_mail']."?subject=".$lang_retaileredit[$_SESSION['language']][6]."&body=".$linkToSend."\">".$lang_retaileredit[$_SESSION['language']][7]."</a>";
                        
                        unset($_POST['r_mail']);
                    };
                    ?>
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang[$_SESSION['language']][9];?></button>
                  <button type="submit" class="btn btn-warning"><?php echo $lang[$_SESSION['language']][7];?></button>
                </div>
                </form>
              </div>
            </div>
          </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    

    
  </body>
</html>
