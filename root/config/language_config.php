<?php

//////////////////////////////////////////////////
//  BUAN-Projekt                                //
//  Dateiname    : config.php                   //
//  Fachbereich Medien FH-Kiel - 5. Semester    //
//  Beschreibung : konfiguriert language-switch //
//  Ersteller    : Jannik Sievert               //
//  Stand        : 14.11.2019                   //
//  Version      : 1.0                          //
//////////////////////////////////////////////////

//Erstaufruf

if(!isset($_SESSION['language'])) {
   //Standard
   $_SESSION['language'] = 0;
}
else {
   $_SESSION['language'] = $_SESSION['language'];
}
//Änderung
if(isset($_POST['language'])){
   $_SESSION['language'] = $_POST['language'];
}

$lang_index_be = '../../../language/index_be.php';
$lang_nav_be = '../../../language/nav_be.php';
$lang_nav_fe = '../../../language/nav_fe.php';
$lang_admin_edit = '../../../language/admin_edit.php';
$lang_admin_query = '../../../language/admin_query.php';
$lang_retailer_query = '../../../language/retailer_query.php';
$lang_retailer_edit = '../../../language/retailer_edit.php';
$lang_product_show = '../../../language/product_show.php';
$lang_order_show = '../../../language/order_show.php';
$lang_bill = '../../../language/billing.php';
$lang_receipt = '../../../language/receipt.php';
$lang_product_create = '../../../language/product_create.php';
$lang_product_edit = '../../../language/product_edit.php';
$lang_retailer_create = '../../../language/retailer_create.php';
$lang_admin_create = '../../../language/admin_create.php';
$lang_cart = '../../../language/cart.php';
?>