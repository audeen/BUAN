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

include ('../../../config/config.php');
include($lang_product_show);
$pdo;
$sql = "SELECT * FROM products";

echo "<div class=\"row\">\n";
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
      echo "<div class=\"card-body\">\n";
        echo "<h6 class=\"card-subtitle text-muted\">ID: ".$row['id_p']."</h6>\n";
        echo "<h6 class=\"card-subtitle mb-2 text-muted\">Status: ".$blocked."</h6>\n";
    echo "</div>\n";

    echo "<div class=\"card-body\">";
    echo "<img class=\"img-fluid \" src=\"../../../images/products/".$row['p_img']."\" alt=\"Produktfoto " .$row['p_name']." \">\n";
    echo "</div>";

    
    echo "  <div class=\"card-body\">\n";
    echo "    <h5 class=\"card-text\">".$lang_productshow[$_SESSION['language']][2]."<br>".$row['p_desc']." </h5>\n";
    echo "  </div>\n";
    echo "  <ul class=\"list-group list-group-flush\">\n";
    echo "        <li class=\"list-group-item\">".$lang_productshow[$_SESSION['language']][3].$row['p_origin']."</li>\n";
    echo "        <li class=\"list-group-item\">".$lang_productshow[$_SESSION['language']][4]."<br>".htmlentities($row['p_price'])." &euro;</li>\n";
    echo "        <li class=\"list-group-item\">".$lang_productshow[$_SESSION['language']][5]."<br>".$row['p_amount'].$lang_productshow[$_SESSION['language']][8]."</li>\n";
    echo "  </ul>";
    echo "  <div class=\"card-body\">\n";
    echo "    <form action=\"product_edit.php\" method=\"post\">";
    echo "      <button type=\"submit\" class=\"btn btn-outline-warning\">".$lang_productshow[$_SESSION['language']][6]."</button>";
    echo "      <input type=\"hidden\" name=\"id_p\" value=\"".$row['id_p']."\">";
    echo "    </form>";
    echo "  </div>\n";
    echo "  <div class=\"card-footer text-muted\">\n";
    echo $lang_productshow[$_SESSION['language']][7].(date("d.m.Y, H:i:s",$row['p_saved']));
    echo "  </div>\n";
    echo "</div>\n";
    echo "</div>\n";
  }
echo "</div>";
?>
