<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   admin_query.php                //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : stellt Admins auf Cards dar  //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
//Config-Datei einbinden
include('../../../config/config.php');
//Sprachdatei einbinden
include($lang_admin_query);

// Verbindung mit der Datenbank herstellen & Admins wählen
$pdo;
$sql = "SELECT * FROM admins";

echo "<div class=\"row\">\n";
  // Darstellung von Admins auf Karten
  foreach ($pdo->query($sql) as $row) {
    echo "<div class=\"col-md-4\">\n";
      echo "<div class=\"card mb-3\">\n";
        echo "<h3 class=\"card-header\">".$row['a_name']."</h3>\n";
        echo "<div class=\"card-body\">\n";
          echo "<h5 class=\"card-title\">".$row['a_mail']."</h5>\n";
          echo "<h6 class=\"card-subtitle text-muted\">ID: ".$row['id_a']."</h6>\n";
        echo "</div>\n";

        // Blockierung aus Query abfragen und Wert in String umwandeln
        if ($row['a_blocked'] == 0) {
          $blocked = $lang_adminquery[$_SESSION['language']][0];
        }
        else{
          $blocked = $lang_adminquery[$_SESSION['language']][1];
        }

        echo "<ul class=\"list-group list-group-flush\">\n";
          echo "<li class=\"list-group-item\">Status:<br>".$blocked."</li>\n";
        echo "</ul>\n";
        echo "<div class=\"card-body\">\n";
          echo "<form action=\"admin_edit.php\" method=\"post\">";
            echo "<button type=\"submit\" class=\"btn btn-outline-warning\">".$lang_adminquery[$_SESSION['language']][2]."</button>";
          echo "<input type=\"hidden\" name=\"id_a\" value=\"".$row['id_a']."\">";
        echo "</form>";
        echo "</div>\n";
        echo "<div class=\"card-footer text-muted\">\n";
          echo $lang_adminquery[$_SESSION['language']][3].(date("d.m.Y, G:m:s",$row['a_saved']));
        echo "</div>\n";
      echo "</div>\n";
    echo "</div>\n";
  }
echo "</div>";

?>
