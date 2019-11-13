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

?>

<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
  <a class="navbar-brand" href="../../sites/index.php">BUAN</a>
  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse justify-content-center" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product_show.php">Produkte</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="retailer_show.php">H&auml;ndler</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_show.php">Admins</a>
      </li>
      <li>
      <?php
      // SWITCHER LINK
        while(list($key, $val) = each($styleSheets)){
          echo "<button type=\"button\" class=\"btn btn-primary m-2 \"><a href='../../config/styleswitcher.php?SETSTYLE=".$key."' title='".$val["title"]."'>".$val["text"]."</a></button>";
        }
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