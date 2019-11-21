
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

$lang= array();

$lang[0][0] = "Bitte geben Sie ihren Alias an";
$lang[0][1] = "Passwort";
$lang[0][2] = "Einloggen";
$lang[0][3] = "Einloggen als H&auml;ndler";
$lang[0][4] = "Bitte geben Sie das Berechnungsergebnis ein!";

$lang[1][0] = "Please enter your Alias";
$lang[1][1] = "Password";
$lang[1][2] = "Log in";
$lang[1][3] = "Log in as retailer";
$lang[1][4] = "Please insert the calculation result";

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
  <div class="m-2 w-75">
    <form action="#" method="post">
    <?php
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
        echo "<input class=\"textfield mt-2 mb-2\" name=\"captcha_erg\" type=\"text\" size=\"10\" maxlength=\"10\" placeholder=\"CAPTCHA\" >";
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
       echo "<input class=\"textfield mt-2 mb-2\" name=\"captcha_erg\" type=\"text\" size=\"10\" maxlength=\"10\" placeholder=\"CAPTCHA\" required>";
    echo "</div>";
    echo "<button type=\"submit\" name=\"login_fe\"  class=\"btn btn-primary\">".$lang[$_SESSION['language']][2]."</button>\n";
    

echo "</div>\n";
    }
    
?>
</form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    

    
  </body>
</html>
