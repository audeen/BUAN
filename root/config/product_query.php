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

include ('config.php');
$pdo;
$sql = "SELECT * FROM products";

echo "<div class=\"row\">\n";
  foreach ($pdo->query($sql) as $row) {

        // Blockierung aus Query abfragen und Wert in String umwandeln
        if ($row['p_blocked'] == 0) {
          $blocked = "aktiv";
        }
        else{
          $blocked = "blockiert";
        }


    echo "<div class=\"col-md-4\">\n";
    echo "<div class=\"card mb-3\">\n";
    echo "  <h3 class=\"card-header\">".$row['p_name']."</h3>\n";
    echo "  <div class=\"card-body\">\n";
    echo "    <h6 class=\"card-subtitle text-muted\">ID: ".$row['id_p']."</h6>\n";
    echo "    <h6 class=\"card-subtitle mb-2 text-muted\">Status: ".$blocked."</h6>\n";
    echo "  </div>\n";

    echo "<div class=\"card-body\">";
    echo "<img class=\"img-fluid \" src=\"../../images/products/".$row['p_img']."\" alt=\"Produktfoto " .$row['p_name']." \">\n";
    echo "</div>";

    
    echo "  <div class=\"card-body\">\n";
    echo "    <h5 class=\"card-text\">Beschreibung: <br>".$row['p_desc']." </h5>\n";
    echo "  </div>\n";
    echo "  <ul class=\"list-group list-group-flush\">\n";
    echo "        <li class=\"list-group-item\">Herkunft: ".$row['p_origin']."</li>\n";
    echo "        <li class=\"list-group-item\">Preis:<br> ".$row['p_price']."</li>\n";
    echo "        <li class=\"list-group-item\">Anzahl verf&uuml;gbar:<br> ".$row['p_amount']."</li>\n";
    echo "  </ul>";
    echo "  <div class=\"card-body\">\n";
    echo "    <form action=\"product_edit.php\" method=\"post\">";
    echo "      <button type=\"submit\" class=\"btn btn-outline-success\">Bearbeiten</button>";
    echo "      <input type=\"hidden\" name=\"id_p\" value=\"".$row['id_p']."\">";
    echo "    </form>";
    echo "  </div>\n";
    echo "  <div class=\"card-footer text-muted\">\n";
    echo" Zuletzt bearbeitet: ".(date("d.m.Y, H:i:s",$row['p_saved']));
    echo "  </div>\n";
    echo "</div>\n";
    echo "</div>\n";
  }
echo "</div>";
?>
