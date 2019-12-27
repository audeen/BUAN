<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   html_nav_fe.php                //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Startseite-Navbar            //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

?>

<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">BUAN</a>
  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse" id="navbarColor02">
    <ul class="navbar-nav ml-auto mx-auto">
      <li>
      <?php
      //Css-Switcher
        while(list($key, $val) = each($styleSheets)){
          echo "<a type=\"button\" class=\"btn btn-secondary mr-2 \" href='styleswitcher.php?SETSTYLE=".$key."' title='".$val["title"]."'>".$val["text"]."</a>";
        }
      ?>
      </li>
      <li>
        <?php
          echo "<form action=\"index.php\" method=\"post\">";
            echo "<button type=\"submit\" class=\"btn btn-secondary mr-2 \" name=\"language\" value=\"0\">";
              echo "deutsch";
            echo "</button>";
            echo "<button type=\"submit\" class=\"btn btn-secondary mr-2 \" name=\"language\" value=\"1\">";
              echo "english";
            echo "</button>";
          echo "</form>";
        ?>
      </li>
      <li class="nav-item float-right">
        <form action="#" method="post">
          <button type="submit" name="admin_login" class="btn btn-outline-warning" href="#" value="Admin">
            Admin
          </button>
        </form>
      </li>
                <!-- Button trigger modal -->
          <li class="ml-2">
            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">
            <?php echo $lang[$_SESSION['language']][5];?>
            </button>
          </li>
    </ul>
  </div>
</nav>

