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
    echo "  <img style=\"height: 200px; width: 100%; display: block;\" src=\"data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22318%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20318%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_158bd1d28ef%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A16pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_158bd1d28ef%22%3E%3Crect%20width%3D%22318%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22129.359375%22%20y%3D%2297.35%22%3EImage%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E\" alt=\"Card image\">\n";
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
    echo" Zuletzt bearbeitet: ".(date("d.m.Y, G:m:s",$row['p_saved']));
    echo "  </div>\n";
    echo "</div>\n";
    echo "</div>\n";
  }
echo "</div>";
?>
