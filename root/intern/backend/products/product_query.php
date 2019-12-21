<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   product_query.php              //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : stellt products auf cards dar//
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
//Config-Datei einbinden
include ('../../../config/config.php');

//Sprachdatei einbinden
include($lang_product_show);
//Datenbankverbindung herstellen
$pdo;
//Alle Produkte wählen
$sql = "SELECT * FROM products";

echo "<div class=\"row\">\n";
  // Für jedes Produkt bestimmte Attribute darstellen
  foreach ($pdo->query($sql) as $row) {

        // Blockierung aus Query abfragen und Wert in String umwandeln
        if ($row['p_blocked'] == 0) {
          $blocked = $lang_productshow[$_SESSION['language']][0];
        }
        else{
          $blocked = $lang_productshow[$_SESSION['language']][1];
        }


    echo "<div class=\"col-md-4\">\n";
      echo "<div class=\"card mb-3\">\n";
        echo "<h3 class=\"card-header\">".$row['p_name']."</h3>\n";
        //Nur für Admins anzeigen
        if (isset($_SESSION['user_id_a'])){
          echo "<div class=\"card-body\">\n";
            echo "<p class=\"card-subtitle text-muted\">ID: ".$row['id_p']."</p>\n";
            echo "<p class=\"card-subtitle mb-2 text-muted\">Status: ".$blocked."</p>\n";
        echo "</div>\n";
        }
        echo "<div class=\"card-body\">";
          echo "<img class=\"img-fluid \" src=\"../../../images/products/".$row['p_img']."\" alt=\"Produktfoto " .$row['p_name']." \">\n";
        echo "</div>";
        echo "<div class=\"card-body\">\n";
          echo "<h5 class=\"card-text\">".$lang_productshow[$_SESSION['language']][2]."<br>".$row['p_desc']." </h5>\n";
        echo "</div>\n";
        echo "<ul class=\"list-group list-group-flush\">\n";
          echo "<li class=\"list-group-item\">".$lang_productshow[$_SESSION['language']][3].$row['p_origin']."</li>\n";
          echo "<li class=\"list-group-item\">".$lang_productshow[$_SESSION['language']][4]."<br>".htmlentities($row['p_price'])." &euro;</li>\n";
          echo "<li class=\"list-group-item\">".$lang_productshow[$_SESSION['language']][5]."<br>".$row['p_amount'].$lang_productshow[$_SESSION['language']][8]."</li>\n";
          //Nur für Händler anzeigen
          if (isset($_SESSION['user_id_r'])){
            // Wenn Artikel auf Lager
            if ($row['p_amount'] > 0 && $row['p_blocked'] == 0){
          
            echo "<form action=\"#\" method=\"post\">";
            echo "<li class=\"list-group-item\">";
              echo "<input type=\"number\" name=\"quantity\" value=\"1\" min=\"1\" max=".$row['p_amount']." placeholder\"=Quantity\" required>";
              echo "<input type=\"hidden\" name=\"product\" value=".$row['id_p'].">";
            echo "</li>";
            echo "<li class=\"list-group-item\">";
              echo "<input type=\"submit\" class=\"btn btn-success\"value=\"".$lang_productshow[$_SESSION['language']][11]."\">";
            echo "</li>";
            echo "</form>";
          }
          // Ausverkauft?
          elseif ($row['p_blocked'] == 1){
            echo "<div class=\"btn btn-danger\">";
            echo $lang_productshow[$_SESSION['language']][13];
          echo "</div>";
          }
          else {
            echo "<div class=\"btn btn-danger\">";
              echo $lang_productshow[$_SESSION['language']][12];
            echo "</div>";
          };
        }
        echo "</ul>";
        //Nur für Admins anzeigen
        if (isset($_SESSION['user_id_a'])){
          echo "<div class=\"card-body\">\n";
            echo "<form action=\"product_edit.php\" method=\"post\">";
              echo "<button type=\"submit\" class=\"btn btn-outline-warning\">".$lang_productshow[$_SESSION['language']][6]."</button>";
              echo "<input type=\"hidden\" name=\"id_p\" value=\"".$row['id_p']."\">";
            echo "</form>";
          echo "</div>\n";
        }
        echo "<div class=\"card-footer text-muted\">\n";
          echo $lang_productshow[$_SESSION['language']][7].(date("d.m.Y, H:i:s",$row['p_saved']));
        echo "</div>\n";
      echo "</div>\n";
    echo "</div>\n";
  }
echo "</div>";
?>
