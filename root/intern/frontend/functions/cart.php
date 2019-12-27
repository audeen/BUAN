<?php 

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname:   cart.php                       //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : Shopping-Cart-Skript         //
//  Ersteller    : Jannik Sievert               //
//  Stand        :                              //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

//Orientiert an:
// https://codeshack.io/shopping-cart-system-php-mysql/

//Config-Datei einbinden
include ('../../../config/config.php');
//Sprachdatei einbinden
include($lang_cart);

// Produkt dem Warenkorb hinzufügen
if (isset($_POST['product'], $_POST['quantity']) && is_numeric($_POST['product']) && is_numeric($_POST['quantity'])) {
    // Post-Variablen setzen, Prüfen auf integer
    $product_id = (int)$_POST['product'];
    $quantity = (int)$_POST['quantity'];
    // Statement vorbereiten
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id_p = ?');
    $stmt->execute([$_POST['product']]);
    // Ergebnis des fetch als Assoziatives Array speichern
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Existiert das Produkt?
    if ($product && $quantity > 0)  {
        // Sessionvariablen für den Warenkorb setzen
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart']))  {
                // Wenn Produkt schon im Warenkorb, erhöhe die Menge
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Produkt noch nicht im Warenkorb, Session-Variable initialisieren
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            //Kein Produkt im Warenkorb, initialisiere das Array
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Seite neuladen, um erneute Datenübertragung zu verhindern
    echo "<meta http-equiv=\"refresh\" content=\"0;url=../sites/product_show.php\">";
    exit;
}
// Produkt entfernen
if (!isset($_POST['update']) && isset($_POST['remove']) && is_numeric($_POST['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_POST['remove']])) {
    // Session-Variable mit gewähltem Produkt deaktivieren
    unset($_SESSION['cart'][$_POST['remove']]);
}

// Update-Funktion bei Datenänderung im Warenkorb
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Durch die Produkte im Warenkorb loopen, um sie nacheinander zu aktualisieren
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Checkein, ob die ID eine Zahl und die Session-Variable gesetzt ist
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Menge aktualisieren
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Seite neuladen, um erneute Datenübertragung zu verhindern
    echo "<meta http-equiv=\"refresh\" content=\"0;url=../sites/product_show.php\">";
    exit;
}
// Warenkorb nicht leer, dann weiterleiten zu place_order, wenn der entsprechende Button gedrückt wurde
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo "<meta http-equiv=\"refresh\" content=\"1;url=place_order.php\">";
    exit;
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
<button class="btn btn-secondary btn-lg btn-block no-hover" disabled>
    <?php echo $lang_cart[$_SESSION['language']][0];?>
</button>
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
                        <button type="submit" class="btn btn-outline-danger btn-sm" content="<?php echo $lang_cart[$_SESSION['language']][5];?>">X</button>
                        <input type="hidden" name="remove" value="<?=$product['id_p']?>">
                    </td>
                    <td class="price"><?=$product['p_price']?> &euro;</td>
                    <td class="quantity form-group mx-sm-3">
                        <input type="number" name="quantity-<?=$product['id_p']?>" value="<?=$products_in_cart[$product['id_p']]?>" min="1" max="<?=$product['p_amount']?>" placeholder="Quantity" required>
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
<?php 
    //Zum Kaufabschluss deaktivieren, wenn Warenkorb leer
    if (!isset($_SESSION['cart'])) {
        $switch = "disabled";
    }
    else {
        $switch = "";
    }
?>
        <div class="buttons">
            <input type="submit" class="btn btn-warning mr-2 float-right" value="<?php echo $lang_cart[$_SESSION['language']][6];?>" name="update">
            <input type="submit" class="btn btn-success mr-2 float-left" value="<?php echo $lang_cart[$_SESSION['language']][14];?>" <?php echo $switch;?> formaction="../sites/checkout.php" >          
            </form>
        </div>
    
</div>

