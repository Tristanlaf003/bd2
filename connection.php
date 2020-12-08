<!DOCTYPE html>
<html>
<?php
require 'header.php';
?>
<body>

	<?php
		require 'menu_activites.php';
	?>
	<div class="Sections center"><h1>Connection</h1></div>
    <div class="Sections">
        <form class="largeur" method="post" action="verification-connection.php">
            <?php
            $messageerreur = $_SESSION['connectionnonreussi'];
            echo $messageerreur;
            $_SESSION['connectionnonreussi'] = null;
            ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Adresse email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="connectionname" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mot de passe</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="connectionpassword" placeholder="Mot de passe">
            </div>
            <button type="submit" class="btn btn-primary centerbouton" name="connectionsoumettre">Connection</button>
        </form>
    </div>

</body>

<?php
require 'footer.php';
?>
</html>
