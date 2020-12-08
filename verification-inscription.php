<?php
require("database.php");
$bdd = Database::connect();
$radio = $_POST['radio'];
$target_dir = "images/utilisateurs/";
$target_file = $target_dir . basename($_FILES["uploadphoto"]["name"]);
echo $target_file;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$message = '';
$_SESSION['tristan_ajout_reussi'] = false;

if (isset($_POST['soumettre'])){
	$motDePasse = $_POST['password'];
	$motDePasse2 = $_POST['password2'];

	if ($motDePasse != $motDePasse2){
		$_SESSION['passwordincorrect'] = "<p class='erreur'>Les mots de passe ne sont pas identiques</p>";
		header("Location: inscription.php");
	}
	else{
		$emailverification = $_POST['email'];
		$statement = $bdd->prepare('SELECT email FROM utilisateurs WHERE utilisateurs.email = ?');

		$statement->execute(array($emailverification));
		$emailbasedonne = $statement->fetch();
		Database::disconnect();
		if ($emailverification == $emailbasedonne['email']){
			$_SESSION['creation'] = "<p class='erreur'>Un compte a déjà été créé avec ce courriel</p>";
		}
		else if(isset($_POST['prenom']) && isset($_POST['nom']) && !empty($_POST['datenaissance']) && !empty($_POST['email']) && !empty($_POST['password']))
		{
		    if ($radio == "madame"){
		        $photo = "signup_woman.png";
            }
		    elseif ($radio == "monsieur"){
                $photo = "signup_man.png";
            }
		    elseif ($radio == "personnaliser"){
                // Check if image file is a actual image or fake image
                if (isset($_POST["soumettre"])) {
                    $check = getimagesize($_FILES["uploadphoto"]["tmp_name"]);
                    if ($check !== false) {
                        $message .= "Le ficher est une image - " . $check["mime"] . ".";
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

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $message .= "Désolé, votre fichier n'a peut être téléverser.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["uploadphoto"]["tmp_name"], $target_file)) {
                        $message .= "Le fichier " . htmlspecialchars(basename($_FILES["uploadphoto"]["name"])) . " a pu être publié.";
                        $photo .= htmlspecialchars(basename($_FILES["uploadphoto"]["name"]));
                        echo $photo;
                    } else {
                        $message .= "Désolé, il y a eu une erreur lors du téléversement.";
                    }
                }
                $_SESSION['message'] = $message;
                echo $message;
            }
            if ($uploadOk == 1) {
                $resultatHachage = password_hash($motDePasse, PASSWORD_DEFAULT);
                $prenom = htmlspecialchars($_POST['prenom']);
                $nom = htmlspecialchars($_POST['nom']);
                $dateDeNaissance = htmlspecialchars($_POST['datenaissance']);
                $email = htmlspecialchars($_POST['email']);
                $req = $bdd->prepare('INSERT INTO utilisateurs (prenom, nom, date_naissance,email ,mot_de_passe,nombre_de_jour,image,status ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
                $req->execute(array($prenom, $nom, $dateDeNaissance, $email, $resultatHachage,0, $photo,0));
                $_SESSION['creation'] = "<p class='success'>Votre compte a été créé avec succès</p>";
            }
		}

		// déconnection avec la Base de données
		Database::disconnect();
	}
}
header("Location: inscription.php");
