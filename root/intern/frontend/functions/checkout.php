<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   checkout.php                   //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Bestellungen in DB schreiben //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

// Config-Datei einbinden
include ('../../../config/config.php');
// Sprachdatei einbinden
include($lang_cart);
//Spracharray lokal

$lang_checkout[0][0] = "Fehler, Daten nicht gespeichert";
$lang_checkout[1][0] = "Error, Data not saved";

// Bestellen gedrückt?
if (isset($_POST['order'])) {
    foreach($_SESSION['cart'] as $key => $value){
        //Daten beziehen
        $retailer =   !empty($_SESSION['user_id_r']) ? trim($_SESSION['user_id_r']) : null;
        $product = !empty($key) ? trim($key) : null;
        $quantity = !empty($value) ? trim($value) : null;
        $o_nr = substr(time(), -5).$retailer;

        $sql = "INSERT INTO orders (
            order_number,
            r_id,
            p_id,
            order_date,
            qty
        )
        VALUES (
                :order_number,
                :r_id, 
                :p_id,
                :order_date,
                :qty
                )";

            $stmt = $pdo->prepare($sql);
    
            //Variablen an Parameter binden
            $stmt->bindValue(':order_number', $o_nr);
            $stmt->bindValue(':r_id', $retailer);
            $stmt->bindValue(':p_id', $product);
            $stmt->bindValue(':order_date', date("Y-m-d H:i:s"));
            $stmt->bindValue(':qty', $quantity);


            $result = $stmt->execute();
    }
    foreach($_SESSION['cart'] as $key => $value) {
        $sql = "UPDATE products
                 SET p_amount = p_amount - $value,
                     p_saved = \"".time()."\"
                 WHERE id_p = $key";
        
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute();
        
    }
    //Insert erfolgreich?
    if($result){

        echo "<meta http-equiv=\"refresh\" content=\"0;url=../../frontend/sites/order.php\">";
        unset($_POST['order']);
        unset($_SESSION['cart']);
    }
    else {
        echo $lang_checkout[$_SESSION['language']][0];

    }
}


// Anzeige der Waren im Warenkorb / Summenberechnung
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0;
// Produkte vorhanden?
if ($products_in_cart) {
    // Produkte im Warenkorb in ?-String-Array umwandeln, um für die SQL-Abfrage WHERE id_P IN ? zu ermöglichen
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id_p IN (' . $array_to_question_marks . ')');
    // Die IDs der Produkte sind die array-keys
    $stmt->execute(array_keys($products_in_cart));
    // Produkte fetchen und als Assoziatives Array speichern
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Preise berechnen
    foreach ($products as $product) {
        $subtotal += (int)$product['p_price'] * (int)$products_in_cart[$product['id_p']];
    }
}

?>

<div class="cart content-wrapper">
    <div class="alert alert-primary mt-3" role="alert">
        <?php echo $lang_cart[$_SESSION['language']][12];?>
    </div>
    <form action="#" method="post">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><?php echo $lang_cart[$_SESSION['language']][1];?></th>
                    <th scope="col"><?php echo $lang_cart[$_SESSION['language']][2];?></th>
                    <th scope="col"><?php echo $lang_cart[$_SESSION['language']][3];?></th>
                    <th scope="col"><?php echo $lang_cart[$_SESSION['language']][4];?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="4" style="text-align:center;"><?php echo $lang_cart[$_SESSION['language']][10];?></td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td>
                        <?php echo $product['p_name'];?>
                    </td>
                    <td class="price"><?=$product['p_price']?> &euro;</td>
                    <td class="quantity form-group mx-sm-3">
                        <?=$products_in_cart[$product['id_p']]?>
                    </td>
                    <td class="price"><?=$product['p_price'] * $products_in_cart[$product['id_p']]?> &euro;</td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                <tr class="subtotal">
                    <td></td>
                    <td></td>
                    <td><?php echo $lang_cart[$_SESSION['language']][9];?></td>
                    <td> <?=$subtotal?> &euro;</td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<?php 

$id = $_SESSION['user_id_r'];
$sql = $pdo->query("SELECT * FROM retailer WHERE `id_r` = $id")->fetch(PDO::FETCH_ASSOC);

?>

<div class="alert alert-primary mt-3" role="alert">
    <?php echo $lang_cart[$_SESSION['language']][13];?>
</div>
<div class="m">
    <p>
        <?php echo $sql['r_prename']." ".$sql['r_surname']?><br>
        <?php echo $sql['r_street'] ?><br>
        <?php echo $sql['r_postal']?><br>
        <?php echo $sql['r_city']?><br>
        <?php echo $sql['r_country']?>
    </p>
</div>
</form>
<div>
    <form action="#" method="post">
        <input type="submit" name="order" value="<?php echo $lang_cart[$_SESSION['language']][8]?>" class="btn btn-success mr-2 float-left" >
    </form>
    <a href="../sites/product_show.php" class="btn btn-danger mr-2 float-right"><?php echo $lang_cart[$_SESSION['language']][7];?></a>
</div>

