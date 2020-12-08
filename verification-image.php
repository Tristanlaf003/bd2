<?php
require("database.php");
$bdd = Database::connect();
$directory = $_SESSION['directory'];
$target_dir = "images/$directory/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$message = '';
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $message .= "Le fichier n'est pas une image";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    $message .= " Désolé, le fichier dépasse la limite permisse.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    $message .= " Désolé, seulement les JPG, JPEG, PNG et GIF peut être téléverser.";
    $uploadOk = 0;
}

$statement3 = $bdd->prepare('CALL Verification_mots_censures()');
$statement3->execute(array());
$legende2 = $_POST['legende'];
$nonpublication = false;
while ($publication = $statement3->fetch()) {
    if (strpos($legende2, $publication[0]) !== false) {
        $nonpublication = true;
    }
}
$statement3->closeCursor();
if ($nonpublication == true){
    $message .= "Votre légende contient des mots haineux.<br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $message .= "Désolé, votre fichier n'a peut être téléverser.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $message .= "Le fichier " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " a pu être publié.";
    } else {
        $message .= "Désolé, il y a eu une erreur lors du téléversement.";
    }
}

$_SESSION['message'] = $message;
if ($uploadOk == 1){
    $nomImage = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
    $legende_nettoyer = $_POST['legende'];
	$legende = strip_tags($legende_nettoyer);
    $identite = $_SESSION['identite'];
    $req = $bdd->prepare('INSERT INTO publications (utilisateur_id, photo, legende, categorie) VALUES (?, ?, ?, ?)');
    $req ->execute(array($identite, $nomImage, $legende, $directory));
    Database::disconnect();
}
header("Location: $directory.php");
