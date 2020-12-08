<?php
require 'header.php';

$bdd = Database::connect();
if (isset($_COOKIE[session_name()])) {
    $_SESSION['connection'] == false;
    $email = $_SESSION['email'];
    $statement = $bdd->prepare('UPDATE utilisateurs SET status = 0 WHERE utilisateurs.email = ?');
    $statement->execute(array($email));
    Database::disconnect();
	session_unset();   // détruit les variables de session car session_destroy() ne le fait pas
}
session_destroy();
header("Location: index.php");