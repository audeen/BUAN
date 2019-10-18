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

$sql = "SELECT * FROM retailer";
echo "<div class=\"card-deck \">";
  foreach ($pdo->query($sql) as $row) {
    echo "<div class=\"cardbox mt-3\">\n";
    echo "<div class=\"card\" style=\"width: 18rem;\">\n";
    echo "  <div class=\"card-body\">\n";
    echo "    <h5 class=\"card-title\">Name:<br> ".$row['r_name']."</h5>\n";
    echo "    <h6 class=\"card-subtitle mb-2 text-muted\">ID: ".$row['id_r']."</h6>\n";

    // Blockierung aus Query abfragen und Wert in String umwandeln
    if ($row['r_blocked'] ==0) {
      $blocked = "aktiv";
    }
    else{
      $blocked = "blockiert";
    }

    echo "    <h6 class=\"card-subtitle mb-2 text-muted\">Status: ".$blocked."</h6>\n";
    echo "    <p class=\"card-text\">\n";
    echo "      <ul class=\"list-group\">\n";
    echo "        <li class=\"list-group-item\">Mail: ".$row['r_mail']."</li>\n";
    echo "        <li class=\"list-group-item\">Adresse: ".$row['r_street']."</li>\n";
    echo "        <li class=\"list-group-item\">PLZ: ".$row['r_postal']."</li>\n";
    echo "        <li class=\"list-group-item\">Stadt: ".$row['r_city']."</li>\n";
    echo "       </ul>";
    echo "    </p>\n";
    echo "    <a href=\"retailer_edit.php\" class=\"card-link\">Bearbeiten</a>\n";
    echo "  </div>\n";
    echo "</div>\n";
    echo "</div>\n";
  }
echo "</div>";


?>
