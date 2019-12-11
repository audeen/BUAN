<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   retailer_query.php             //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : stellt retailer auf cards dar//
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////


include($lang_retailer_query);

$pdo;

$sql = "SELECT * FROM retailer";

echo "<div class=\"row\">\n";
  foreach ($pdo->query($sql) as $row) {

        // Blockierung aus Query abfragen und Wert in String umwandeln
        if ($row['r_blocked'] == 0) {
          $blocked = $lang_retailerquery[$_SESSION['language']][0];
        }
        else{
          $blocked = $lang_retailerquery[$_SESSION['language']][01];
        }


    echo "<div class=\"col-md-4\">\n";
    echo "<div class=\"card mb-3\">\n";
    echo "  <h3 class=\"card-header\">".$row['r_surname'].", ".$row['r_prename']."</h3>\n";
    echo "  <div class=\"card-body\">\n";
    echo "    <h5 class=\"card-title\">".$row['r_mail']."</h5>\n";
    echo "    <h6 class=\"card-subtitle text-muted\">ID: ".$row['id_r']."</h6>\n";
    echo "    <h6 class=\"card-subtitle text-muted\">Alias: ".$row['r_alias']."</h6>\n";
    echo "    <h6 class=\"card-subtitle mb-2 text-muted\">Status: ".$blocked."</h6>\n";
    echo "  </div>\n";
   
    
    echo "<div class=\"card-body\">";
    echo "<img class=\"img-fluid\" src=\"../../../images/retailer/".$row['r_img']."\" alt=\"H&auml;ndlerfoto " .$row['r_surname']." \">\n";
    echo "</div>";
    
  

    echo "<ul class=\"list-group list-group-flush\">\n";
      echo "<li class=\"list-group-item\">";  
        echo "<ul class=\"list-group list-group-flush\">\n";
          echo "<li class=\"list-group-item\">".$lang_retailerquery[$_SESSION['language']][2].htmlentities($row['r_street'])."</li>\n";
          echo "<li class=\"list-group-item\">".$lang_retailerquery[$_SESSION['language']][3].$row['r_postal']."</li>\n";
          echo "<li class=\"list-group-item\">".$lang_retailerquery[$_SESSION['language']][4].$row['r_city']."</li>\n";
          echo "<li class=\"list-group-item\">".$lang_retailerquery[$_SESSION['language']][5].$row['r_country']."</li>\n";
        echo "</ul>";
      echo "</li>\n";
    echo "</ul>\n";
    echo "<div class=\"card-body\">\n";
      echo "<form action=\"retailer_edit.php\" method=\"post\">";
        echo "<button type=\"submit\" class=\"btn btn-outline-warning\">".$lang_retailerquery[$_SESSION['language']][6]."</button>";
        echo "<input type=\"hidden\" name=\"id_r\" value=\"".$row['id_r']."\">";
      echo "</form>";
    echo "</div>\n";
    echo "<div class=\"card-footer text-muted\">\n";
      echo $lang_retailerquery[$_SESSION['language']][7].(date("d.m.Y, H:i:s",$row['r_saved']));
    echo "</div>\n";
    echo "</div>\n";
    echo "</div>\n";
  }
  
echo "</div>";
?>
