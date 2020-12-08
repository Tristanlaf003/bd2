<!DOCTYPE html>
<html>
<?php
require 'header.php';
?>
<body>

<?php
require 'menu_activites.php';
?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<div class="Sections center"><h1>Inscription</h1>
<?php
$passwordincorrect = $_SESSION['creation'];
echo $passwordincorrect;
$_SESSION['creation'] = null;

?>
</div>
<div class="Sections">
	<form method="post" class="largeur" action="verification-inscription.php" onsubmit="return checkForm(this);" enctype="multipart/form-data">
		<div class="form-row">
			<div class="col">
				<label for="prenom">Votre prénom</label>
				<input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
			</div>
			<div class="col">
				<label for="nom">Votre nom</label>
				<input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
			</div>
		</div>
		<div class="form-group">
			<label for="example-date-input" class="col-2 col-form-label">Date de naissance</label>
			<input class="form-control" type="date" value="<?php date("Y-m-d") ?>" name="datenaissance" id="example-date-input" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Adresse email</label>
			<input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Email" required>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Mot de passe</label>
			<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Mot de passe" required>
            <?php
            $passwordincorrect = $_SESSION['passwordincorrect'];
            echo $passwordincorrect;
            $_SESSION['passwordincorrect'] = null;

            ?>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Réinscrire votre mot de passe</label>
			<input type="password" class="form-control" id="exampleInputPassword1" name="password2" placeholder="Mot de passe" required>
		</div>
        <!-- Default checked -->
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="defaultChecked" name="radio" value="madame" checked>
            <label class="custom-control-label" for="defaultChecked">Madame :</label>
            <img src="images/utilisateurs/signup_woman.png" alt="madame" title="Madame" width="20%">

            <input type="radio" class="custom-control-input" id="defaultUnchecked" name="radio" value="monsieur">
            <label class="custom-control-label" for="defaultUnchecked">Monsieur :</label>
            <img src="images/utilisateurs/signup_man.png" alt="monsieur" title="Monsieur" width="20%">


        </div>
        <div>
        <input type="radio" class="custom-control-input" id="photopersonnaliser" name="radio" value="personnaliser">
        <label class="custom-control-label" for="photopersonnaliser">Photo personnalisée : </label>
            <?php
            $message = $_SESSION['message'];
            echo $message;
            echo "<br>";
            $_SESSION['message'] = null;
            ?>
            Sélectionner une image à publier:
            <input type='file' onchange="readURL(this);" name="uploadphoto" id="uploadphoto" />
            <img id="blah" src="http://placehold.it/180" alt="your image" width="25%" />
        </div>
        <br>
		<button type="submit" name="soumettre" class="btn btn-primary centerbouton">S'inscrire</button>
	</form>
</div>

</body>

<?php
require 'footer.php';
?>
</html>
