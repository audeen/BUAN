<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   html_nav_be.php                //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Backend-Navbar               //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
// Config-Datei einbinden
include('../../../config/config.php');
// Sprach-Datei einbinden
include($lang_nav_fe);
?>

<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
  <a class="navbar-brand" href="../../backend/sites/index.php">BUAN</a>
  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse" id="navbarColor02">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="product_show.php"><?php echo $lang_navfe[$_SESSION['language']][1]?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="retailer_show.php"><?php echo $lang_navfe[$_SESSION['language']][2]?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_show.php"><?php echo $lang_navfe[$_SESSION['language']][3]?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="order_show.php"><?php echo $lang_navfe[$_SESSION['language']][4]?></a>
      </li>
      <li>
      <?php
      //Css-Switcher
        while(list($key, $val) = each($styleSheets)){
          echo "<a type=\"button\" class=\"btn btn-primary mr-2 \" href='../functions/styleswitcher.php?SETSTYLE=".$key."' title='".$val["title"]."'>".$val["text"]."</a>";
        }
      ?>
      </li>
      <li>
        <?php
          echo "<form action=\"index.php\" method=\"post\">";
            echo "<button type=\"submit\" class=\"btn btn-primary mr-2 \" name=\"language\" value=\"0\">";
              echo "deutsch";
            echo "</button>";
            echo "<button type=\"submit\" class=\"btn btn-primary mr-2 \" name=\"language\" value=\"1\">";
              echo "english";
            echo "</button>";
          echo "</form>";
        ?>
      </li>
      <li class="nav-item active">
        <form action="#">
          <a class="nav-link" href="logout.php"
            >Logout <span class="sr-only">(current)</span></a>
        </form>
      </li>
    </ul>
  </div>
</nav>