<?php
include ('config.php');

$pdo;

$sql = "SELECT * FROM admins";
echo "<div class=\"card-deck \">";
  foreach ($pdo->query($sql) as $row) {
    echo "<div class=\"cardbox mt-3\">\n";
    echo "<div class=\"card\" style=\"width: 18rem;\">\n";
    echo "  <div class=\"card-body\">\n";
    echo "    <h5 class=\"card-title\">Name: ".$row['a_name']."</h5>\n";
    echo "    <h6 class=\"card-subtitle mb-2 text-muted\">ID: ".$row['id_a']."</h6>\n";

    // Blockierung aus Query abfragen und Wert in String umwandeln
    if ($row['a_blocked'] == 0) {
      $blocked = "aktiv";
    }
    else{
      $blocked = "blockiert";
    }

    echo "    <h6 class=\"card-subtitle mb-2 text-muted\">Status: ".$blocked."</h6>\n";
    echo "    <p class=\"card-text\">\n";
    echo "\n";
    echo "    </p>\n";
    echo "    <a href=\"admin_edit.php\" class=\"card-link\">Bearbeiten</a>\n";
    echo "  </div>\n";
    echo "</div>\n";
    echo "</div>\n";
  }
echo "</div>";


?>
