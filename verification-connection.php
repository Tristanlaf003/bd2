<?php
require("database.php");
$bdd = Database::connect();

if (isset($_POST['connectionsoumettre'])){
	$email = $_POST['connectionname'];
	$password = $_POST['connectionpassword'];
	$statement = $bdd->prepare('SELECT id, prenom ,mot_de_passe,image FROM utilisateurs WHERE utilisateurs.email = ?');
	$statement->execute(array($email));
	$emailconnection = $statement->fetch();

	if (password_verify($password, $emailconnection['mot_de_passe'])){
	    $_SESSION['identite'] = $emailconnection['id'];
	    $_SESSION['photoIdentite'] = $emailconnection['image'];
	    $_SESSION['email'] = $email;
		$prenom = $emailconnection['prenom'];
		$_SESSION['connection'] = true;
		$_SESSION['connectionreussi'] = "<p>Bienvenue $prenom</p>";
        $statement = $bdd->prepare('UPDATE utilisateurs SET status = 1 WHERE utilisateurs.email = ?');
        $statement->execute(array($email));
        Database::disconnect();
		header("Location: index.php");
	}
	else{
		$_SESSION['connectionnonreussi'] = "<p class='erreur'>L'adresse courriel ou le mot de passe sont invalides</p>";
		header("Location: connection.php");
	}

}