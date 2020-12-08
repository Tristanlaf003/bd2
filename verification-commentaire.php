<?php
require("database.php");
$bdd = Database::connect();
$directory = $_SESSION['directory'];
$nonpublication = false;
$_SESSION['haineux'] = null;
$commentaire_nettoyer = $_POST['commentaire'];
$commentaire = strip_tags($commentaire_nettoyer);
$values = $_POST['soumettre'];
$valuessplit = explode("+", $values);
$message = "";
if (($_SESSION['connection'] == true and date('H:i') > "00:00") or ($_SESSION['connection'] == true and date('H:i') <= "06:00")) {
    if (isset($_POST['soumettre'])) {
        if ($commentaire != '') {
            $statement = $bdd->prepare('CALL Verification_mots_censures()');
            $statement->execute(array());
            while ($publication = $statement->fetch()) {
                if (strpos($commentaire, $publication[0]) !== false) {
                    $nonpublication = true;
                }
            }
            $statement->closeCursor();
            if ($nonpublication == false){
                $req = $bdd->prepare('INSERT INTO commentaires (publication_id, utilisateur_id, commentaire) VALUES (?, ?, ?)');
                $req->execute(array($valuessplit[0], $valuessplit[1], $commentaire));
                Database::disconnect();
            }
            if ($nonpublication == true){
                $message .= "Votre commentaire contient des mots haineux";
            }
        } else {
            $message .= "Veuillez mettre un commentaire.";
        }
    }
}
$_SESSION['haineux'] = $message;
header("Location: $directory.php");