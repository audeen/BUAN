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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../../sites/index.php">BUAN</a>
  <button
    class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#navbarNavDropdown"
    aria-controls="navbarNavDropdown"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"
          >Home <span class="sr-only">(current)</span></a
        >
      </li>
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          href="#"
          id="navbarDropdown"
          role="button"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          Produkte
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Produkte anzeigen</a>
          <a class="dropdown-item" href="#">Produkte bearbeiten</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          href="#"
          id="navbarDropdown"
          role="button"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          H&auml;ndler
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="retailer_show.php"
            >H&auml;ndler anzeigen</a
          >
          <a class="dropdown-item" href="retailer_edit.php"
            >H&auml;ndler bearbeiten</a
          >
          <a class="dropdown-item" href="retailer_create.php"
            >H&auml;ndler anlegen</a
          >
        </div>
      </li>
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          href="#"
          id="navbarDropdown"
          role="button"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          Admins
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="admin_show.php">Admins anzeigen</a>
          <a class="dropdown-item" href="admin_edit.php">Admins bearbeiten</a>
        </div>
      </li>

      <li class="nav-item active">
        <form action="#">
          <a class="nav-link" href="logout.php"
            >Logout <span class="sr-only">(current)</span></a
          >
        </form>
      </li>
    </ul>
    <?php
      // SWITCHER LINK
        while(list($key, $val) = each($styleSheets)){
          echo "<button type=\"button\" class=\"btn btn-primary m-2 \"><a href='../../config/styleswitcher.php?SETSTYLE=".$key."' title='".$val["title"]."'>".$val["text"]."</a></button>";
        }
    ?> 
  </div>
</nav>
