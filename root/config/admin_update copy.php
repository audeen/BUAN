<?php

include ('config.php');
$pdo;


$statement = $pdo->prepare("UPDATE admins SET a_name = :a_name_neu, a_blocked = :a_blocked_neu WHERE id = :id");
$statement->execute(array('id' => 'id_a', 'a_name_neu' => 'a_name', 'a_blocked_neu' => 'a_blocked'));

?>