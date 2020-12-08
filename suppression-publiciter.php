<?php
require("database.php");
$bdd = Database::connect();

if (($_SESSION['connection'] == true and date('H:i') > "00:00") or ($_SESSION['connection'] == true and date('H:i') <= "06:00")) {
	if (isset($_POST['supprimer'])) {
		$directory = $_SESSION['directory'];
		$id_supprimer = $_POST["supprimer"];
        $statement = $bdd->prepare("DELETE FROM publications WHERE publications.id = ?");
        $statement->execute(array($id_supprimer));
		Database::disconnect();
	}
}
header("Location: $directory.php");