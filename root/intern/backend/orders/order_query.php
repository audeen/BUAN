<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   order_query.php                //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : stellt order in table dar    //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////
// Sprachdatei einbinden
include($lang_product_show);

//Datenbankverbindung herstellen
$pdo;

// Sortierungsmöglichkeit im Table-Head über GET
$sort = isset($_GET['sort']) ? (($_GET['sort'] === "DESC") ? "ASC" : "DESC") : "ASC"; //by rebitz
$attribute = isset($_GET['attribute']) ? $_GET['attribute'] : "order_date";

//Monats- / Jahresauswahl
if(isset($_POST['retailer'])) {

   $retailer = "=".$_POST['retailer'];
   $year = $_POST['year'];
   $month1 = $_POST['month'];
   $month2 = $_POST['month'];
   // Ganzes Jahr gewählt? 
   if ($month1 == "all") {
      $month1 = "01";
      $month2 = "12";
   }
   // Alle Händler gewählt?
   if ($retailer == "=all") {
      $retailer = "LIKE '%'";
   }
   $sql =   "SELECT * 
            FROM products, retailer, orders 
            WHERE id_r $retailer
            AND r_id = id_r
            AND id_p = p_id
            AND
            `order_date` BETWEEN '$year-$month1-01' AND '$year-$month2-31'";
}
// Schaut ein Händler diese Seite an?
elseif (isset($_SESSION['user_id_r'])){

   $id = $_SESSION['user_id_r'];
   $sql = "SELECT * FROM products, retailer, orders WHERE $id = id_r AND r_id = id_r AND id_p = p_id ORDER BY $attribute $sort";
}

//Erstaufruf
else{
   
   $sql = "SELECT * FROM products, retailer, orders WHERE id_r = r_id AND id_p = p_id ORDER BY $attribute $sort";
}


echo "<div id=\"orders\" class=\"table-responsive table-hover\">\n";
   echo "<table class=\"table\">";
      echo "<thead>";
         echo "<tr>";
         //Sortierfunktion im Tabellenkopf
            echo "<th scope=\"col\"><a href=\"../sites/order_show.php?attribute=id_o&sort=".$sort."\">ID</a></th>";
            echo "<th scope=\"col\"><a href=\"../sites/order_show.php?attribute=order_number&sort=".$sort."\">".$lang_ordershow[$_SESSION['language']][1]."</th>";
            echo "<th scope=\"col\"><a href=\"../sites/order_show.php?attribute=r_surname&sort=".$sort."\">".$lang_ordershow[$_SESSION['language']][2]."</th>";
            echo "<th scope=\"col\"><a href=\"../sites/order_show.php?attribute=p_name&sort=".$sort."\">".$lang_ordershow[$_SESSION['language']][3]."</th>";
            echo "<th scope=\"col\"><a href=\"../sites/order_show.php?attribute=order_date&sort=".$sort."\">".$lang_ordershow[$_SESSION['language']][4]."</th>";
            echo "<th scope=\"col\"><a href=\"../sites/order_show.php?attribute=qty&sort=".$sort."\">".$lang_ordershow[$_SESSION['language']][5]."</th>";
            echo "<th scope=\"col\">".$lang_ordershow[$_SESSION['language']][6]."</th>";
         echo "</tr>";
      echo "</thead>";
      echo "<tbody";
            //Jede Bestellung des Monats ausgeben
            foreach ($pdo->query($sql) as $row) {
               echo "<tr>";
               echo "<th scope=\"row\">".$row['id_o']."</th>";
               echo "<td>".$row['order_number']."</td>";
               echo "<td>".$row['r_prename']." ".$row['r_surname']."</td>";
               echo "<td>".$row['p_name']."</td>";
               echo "<td>".$row['order_date']."</td>";           
               echo "<td>".$row['qty']." ".$lang_ordershow[$_SESSION['language']][7]."</td>";
               echo "<td>".$row['qty']*$row['p_price']." &euro;</td>";
               echo "</tr>";
            }
      echo "</tbody";
   echo "</table>";
echo "</div>";
?>
