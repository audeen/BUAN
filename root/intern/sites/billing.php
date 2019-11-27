<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   billing.php                    //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Lohnabrechnung               //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 27.11.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

session_start();

include('../../config/config.php');
include($lang_order_show);

?>
<!-- Include Security-File -->
<?php include ('../../config/functions/authentification.php'); ?>

<!DOCTYPE html>
<html lang="de">
  <!-- html-head einbinden -->
  <?php include ('../../config/navigation/html_head.php'); ?>
  <body>
    <!-- backend-navigation einbinden -->
    <?php include ('../../config/navigation/html_nav_be.php'); ?>

    <div class="container">
      <div class="container-fluid">
        <div class="row">
         <div class="alert alert-primary mt-3 col-12" role="alert">
         <h2 class="text-center"><?php echo $lang_ordershow[$_SESSION['language']][0];?></h2>
         <h3><?php echo $name = "" ?></h3>
          </div>
    <?php
    // Sortierungsmöglichkeit im Table-Head über GET
$sort = isset($_GET['sort']) ? (($_GET['sort'] === "DESC") ? "ASC" : "DESC") : "ASC"; //by rebitz
$attribute = isset($_GET['attribute']) ? $_GET['attribute'] : "id_o";

$retailer = "=".$_POST['retailer'];
$year = $_POST['year'];
$month1 = $_POST['month'];
$month2 = $_POST['month'];
if ($month1 == "all") {
    $month1 = "01";
    $month2 = "12";
}
if ($retailer == "=all") {
    $retailer = "LIKE '%'";
}
$sql =   $pdo->prepare("SELECT * 
            FROM products, retailer, orders 
            WHERE id_r $retailer
            AND r_id = id_r
            AND id_p = p_id
            AND order_date BETWEEN '$year-$month1-01' AND '$year-$month2-31'");
$sql->execute();
$row = $sql->fetchAll();
print_r($row);
   


echo "<div id=\"orders\" class=\"table-responsive table-hover\">\n";
echo "<table class=\"table\">";
   echo "<thead>";
      echo "<tr>";
         echo "<th scope=\"col\"><a href=\"../../intern/sites/order_show.php?attribute=id_o&sort=".$sort."\">ID</a></th>";
         echo "<th scope=\"col\"><a href=\"../../intern/sites/order_show.php?attribute=p_name&sort=".$sort."\">".$lang_ordershow[$_SESSION['language']][3]."</th>";
         echo "<th scope=\"col\"><a href=\"../../intern/sites/order_show.php?attribute=order_date&sort=".$sort."\">".$lang_ordershow[$_SESSION['language']][4]."</th>";
         echo "<th scope=\"col\"><a href=\"../../intern/sites/order_show.php?attribute=qty&sort=".$sort."\">".$lang_ordershow[$_SESSION['language']][5]."</th>";
         echo "<th scope=\"col\">".$lang_ordershow[$_SESSION['language']][6]."</th>";
      echo "</tr>";
   echo "</thead>";
   echo "<tbody";
   $sql =   ("SELECT * FROM products, retailer, orders 
            WHERE id_r $retailer
            AND r_id = id_r
            AND id_p = p_id
            AND order_date BETWEEN '$year-$month1-01' AND '$year-$month2-31'");

         foreach ($pdo->query($sql) as $row) {
            echo "<tr>";
            echo "<th scope=\"row\">".$row['id_o']."</th>";
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
          </div>
        </div>
      </div>