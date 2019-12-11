<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   html_nav_fe.php                //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Frontend-Navbar              //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

?>



<?php include ('../intern/backend/functions/php_login_be.php'); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">BUAN</a>
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
        <a class="nav-link" href="#"
          >Home <span class="sr-only">(current)</span></a
        >
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          href="#"
          id="navbarDropdownMenuLink"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          Login Backend
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <div class="dropdown-item">
            <form action="#" method="post">
              Name<br />
              <input type="text" id="username" name="username" />
              Passwort<br />
              <input type="password" id="password" name="password" />
              <input type="submit" name="login" />
            </form>
          </div>
        </div>
      </li>
      <li class="nav-item"></li>
      <li class="nav-item active">
        <a class="nav-link" href="#"
          >Logout <span class="sr-only">(current)</span></a
        >
      </li>
    </ul>
    <?php
      // SWITCHER LINK
        while(list($key, $val) = each($styleSheets)){
          echo "<button type=\"button\" class=\"btn btn-primary m-2 \"><a href='../backend/functions/styleswitcher.php?SETSTYLE=".$key."' title='".$val["title"]."'>".$val["text"]."</a></button>";
        }
    ?> 

  </div>
</nav>
