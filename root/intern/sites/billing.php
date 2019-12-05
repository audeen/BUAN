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
include($lang_bill);



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

// Gesamtsumme Bestellungen/Monat errechnen & in Variable schreiben
$sql =   $pdo->prepare("SELECT SUM(total)
      FROM products, retailer, orders 
      WHERE id_r $retailer
      AND r_id = id_r
      AND id_p = p_id
      AND order_date BETWEEN '$year-$month1-01' AND '$year-$month2-31'");

$sql->execute();
$row = $sql->fetch();
$total = $row['SUM(total)'];

// Bonus berechnen

if ($total > 0 and $total <= 1000){
   $bonus = 500;
}
elseif ($total > 1000 and $total <= 3000){
   $bonus = 1000;
}
elseif ($total > 3000){ 
   $bonus = 1500;
}
else {
   $bonus = 0;
}




// Daten aus Datenbank holen 
$sql =   $pdo->prepare("SELECT * 
            FROM products, retailer, orders 
            WHERE id_r $retailer
            AND r_id = id_r
            AND id_p = p_id
            AND order_date BETWEEN '$year-$month1-01' AND '$year-$month2-31'");
$sql->execute();
$row = $sql->fetch();
print_r($row);

$time = strtotime($row['order_date']);
$billmonth = date('m', $time);
$pay = $bonus + $row['basic_pay'];


switch ($billmonth){
   case "1":
      $billmonth = $lang_billcalendar[$_SESSION['language']][1];
   break;
   case "2":
      $billmonth = $lang_billcalendar[$_SESSION['language']][2];
   break;
   case "3":
      $billmonth = $lang_billcalendar[$_SESSION['language']][3];
   break;
   case "4":
      $billmonth = $lang_billcalendar[$_SESSION['language']][4];
   break;
   case "5":
      $billmonth = $lang_billcalendar[$_SESSION['language']][5];
   break;
   case "6":
      $billmonth = $lang_billcalendar[$_SESSION['language']][6];
   break;
   case "7":
      $billmonth = $lang_billcalendar[$_SESSION['language']][7];
   break;
   case "8":
      $billmonth = $lang_billcalendar[$_SESSION['language']][8];
   break;
   case "9":
      $billmonth = $lang_billcalendar[$_SESSION['language']][9];
   break;
   case "10":
      $billmonth = $lang_billcalendar[$_SESSION['language']][10];
   break;
   case "11":
      $billmonth = $lang_billcalendar[$_SESSION['language']][11];
   break;
   case "12":
      $billmonth = $lang_billcalendar[$_SESSION['language']][12];
   break;

}



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
      <div class="alert alert-primary mt-3 col-12" role="alert">
         <h2 class="text-center"><?php echo $lang_billing[$_SESSION['language']][0];?></h2>
      </div>


<?php

echo "<div>";
   echo "<h4>Name: ".$row['r_prename']." ".$row['r_surname']."  </h4>";
   echo "<h4>".$lang_billing[$_SESSION['language']][1].$billmonth." ".date("Y", $time)."</h4>";
   echo "<h4>".$lang_billing[$_SESSION['language']][2].$billnumber=date("Y", $time)."/".date("m", $time)."/".$row['id_r']."</h4>";
   echo "<br>";
   echo "<br>";
   echo "<h5>".$lang_billing[$_SESSION['language']][9]."</h5>";
   echo "<p>".$row['r_prename']." ".$row['r_surname']."<br>".htmlentities($row['r_street'])."<br>".$row['r_postal']." ".$row['r_city']."<br>".$row['r_country']."</p>";
   //Tabelle mit Bestellungen des jeweiligen Monats
   echo "<h5>".$lang_billing[$_SESSION['language']][3]." ".$billmonth." ".date("Y", $time)."</h5>";
   echo "<div id=\"orders\" class=\"table-responsive table-hover\">\n";
      echo "<table class=\"table\">";
         echo "<thead>";
            echo "<tr>";
               echo "<th scope=\"col\">Position</th>";
               echo "<th scope=\"col\">".$lang_billing[$_SESSION['language']][4]."</th>";
               echo "<th scope=\"col\">".$lang_billing[$_SESSION['language']][5]."</th>";
               echo "<th scope=\"col\">".$lang_billing[$_SESSION['language']][6]."</th>";
               echo "<th scope=\"col\">".$lang_billing[$_SESSION['language']][7]."</th>";
            echo "</tr>";
         echo "</thead>";
         echo "<tbody";
         //Ausgabe Bestellungen des Monats
         $sql =   ("SELECT * FROM products, retailer, orders 
                  WHERE id_r $retailer
                  AND r_id = id_r
                  AND id_p = p_id
                  AND order_date BETWEEN '$year-$month1-01' AND '$year-$month2-31'");

         foreach ($pdo->query($sql) as $row) {
            print_r($row);
            echo "<tr>";
               echo "<th scope=\"row\">DUMMY</th>";
               echo "<td>".$row['p_name']."</td>";
               echo "<td>".$row['qty']." ".$lang_billing[$_SESSION['language']][8]."</td>";
               echo "<td>".$row['p_price']." &euro;</td>";
               echo "<td>".$row['qty']*$row['p_price']." &euro;</td>";
            echo "</tr>";
               }
         echo "</tbody>";
      echo "</table>";
      echo "<div>";
      echo "<div>";
      echo "<table class=\"table\">";
         echo "<tbody>";
            echo "<tr>";
               echo "<td>".$lang_billing[$_SESSION['language']][10]."</td>";
               echo "<td>".$total." &euro;</td>";
            echo "</tr>";
            echo "<tr>";
               echo "<td>".$lang_billing[$_SESSION['language']][11]."</td>";
               echo "<td>".$row['basic_pay']." &euro;</td>";
            echo "</tr>";
            echo "<tr>";
               echo "<td>".$lang_billing[$_SESSION['language']][12]."</td>";
               echo "<td>".$bonus." &euro;</td>";
            echo "</tr>";
            echo "<tr>";
               echo "<td>".$lang_billing[$_SESSION['language']][13]."</td>";
               echo "<td>".$pay." &euro;</td>";
            echo "</tr>";
      echo "</table>";
      echo "</div>";
      echo "</div>";
   echo "</div>";

echo "</div>";

echo "<form action = \"../../config/functions/receipt.php\" method =\"POST\" >";


                      echo "<input type=\"hidden\" name=\"retailer\" value=\"".$retailer."\"></input>";
                      echo "<input type=\"hidden\" name=\"year\" value=\"".$year."\"></input>";
                      echo "<input type=\"hidden\" name=\"month\" value=\"".$month1."\"></input>";
                      echo "<input type=\"hidden\" name=\"total\" value=\"".$total."\"></input>";
                      echo "<input type=\"hidden\" name=\"basicpay\" value=\"".$row['basic_pay']."\"></input>";
                      echo "<input type=\"hidden\" name=\"bonus\" value=\"".$bonus."\"></input>";
                      echo "<input type=\"hidden\" name=\"pay\" value=\"".$pay."\"></input>";
   echo "<input type=\"submit\" name=\"billing\" >";
echo "</form>";
   

?>

        </div>
      </div>