<?php

session_start();
 
//Prüfen, ob der User eingeloggt ist

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
  //User not logged in. Redirect them back to the login.php page.

  header('Location: ../../sites/index.php');
  exit;
}

// Prüfen, ob der User blockiert ist

if(isset($_SESSION['blocked'])){
  header('Location: ../../sites/index.php');
  exit;
}
?>