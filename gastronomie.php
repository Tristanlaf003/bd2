<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<?php
require 'header.php';
$bdd = Database::connect();
$url = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
$nomPage = str_replace(".php","",$url);
?>

<body>
<?php
require 'menu_activites.php';
$time = date_default_timezone_set('America/Montreal');
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
<div class="Sections">
    Que pensez-vous de mon alimentations ? Voici en photo ce que j'ai mangé aucours de cette année : <br>
</div>
<?php
$haineux = $_SESSION['haineux'];
if ($haineux != "") {
    echo "<div class='Sections'>";
    echo $haineux;
    echo "</div>";
}
$_SESSION['haineux'] = null;
?>
<?php
if ($_SESSION['connection'] == true){
    ?>
    <div class="Sections">
        <form action="verification-image.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        $message = $_SESSION['message'];
                        echo $message;
                        $_SESSION['message'] = null;
                        ?>
                        Sélectionner une image à publier:
                        <input type='file' onchange="readURL(this);" name="fileToUpload" id="fileToUpload" />
                        <img id="blah" src="http://placehold.it/180" alt="your image" />
                        <?php $_SESSION['directory'] = $nomPage; ?>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Légende</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="legende" rows="3"></textarea>
                            <br>
                            <input type="submit" value="Publié" name="submit" class="bouton-right">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
}
$statement2 = $bdd->prepare('SELECT count(*) FROM publications WHERE categorie = ?');
$statement2->execute(array($nomPage));
$publication2 = $statement2->fetch();

$statement = $bdd->prepare('SELECT publications.id, utilisateur_id, email, photo, legende, date_publication, image FROM publications 
                                         INNER JOIN utilisateurs ON publications.utilisateur_id = utilisateurs.id
                                         WHERE publications.categorie = ?');
$statement->execute(array($nomPage));
echo "<div id=\"login\">";
$nbPhoto = round($publication2["count(*)"] / 2);
$compteur = $nbPhoto;
while ($publication = $statement->fetch()) {
    if ($compteur == $nbPhoto){
        echo "<div class='element2'>";
        $compteur = 0;
    }
    $id = $publication['id'];
    $utilisateurs_id = $_SESSION['identite'];
    $values = $id."+".$utilisateurs_id;
    $photo = $publication['photo'];
    $legende = $publication['legende'];
    $date_publication = $publication['date_publication'];
    $email = $publication['email'];
    $image = $publication['image'];
    echo "<img class='img-thumbnail' width='100%' src='images/$nomPage/$photo' />";
    echo "<p class='commentaire_post'>$legende</p>";
    echo "<p class='commentaire_post'>$date_publication</p>";
    echo "<p class='commentaire_post'><img src='images/utilisateurs/$image' width='30' class='img-circle'> $email</p>";
    $statement3 = $bdd->prepare('SELECT email, commentaire, date_commentaire, image FROM commentaires
                                             INNER JOIN utilisateurs ON utilisateurs.id = commentaires.utilisateur_id
                                             WHERE publication_id = ? ORDER BY commentaires.id DESC;');
    $statement3->execute(array($id));
    $commentaires = $statement3->fetch();
    $image_commentaire = $commentaires['image'];
    echo "<form method='post' action='verification-commentaire.php'>
              <div class=\"form-group\">";
    if ($statement3->fetch() >= 0){
        if ($commentaires['commentaire'] != "") {
            echo "<label for=\"exampleFormControlTextarea1\">Commentaire : </label>";
            echo "<div class='blanc'><p><img src='images/utilisateurs/$image_commentaire' width='30' class='img-circle'> " . $commentaires['date_commentaire'] . ' ' . $commentaires['email'] . "</p>";
            echo "<p>" . $commentaires['commentaire'] . "</p></div>";
        }
    }
    if ($_SESSION['connection'] == true && (date('H:i') <= '00:00') | (date('H:i') >= '06:00')) {
        echo "<textarea class=\"form-control\" id=\"exampleFormControlTextarea1\" rows=\"1\" name='commentaire'></textarea><br>
              <button type=\"submit\" class=\"btn btn-primary mb-2\" value='$values' name='soumettre'>Soumettre</button>";
    }
    echo "</div>";
    echo "</form>";
    if ($_SESSION['email'] == $publication['email']){
        echo "<form action='suppression-publiciter.php' class='margin-down' method='post'>";
        echo "<button type=\"submit\" class=\"btn btn-danger margin-down\" value='$id' name='supprimer'>Supprimé publication</button>";
        echo "</form>";
    }
    $compteur +=1;
    if ($compteur == $nbPhoto ){
        echo "</div>";
    }

}
echo "</div>";
echo "</div>";
echo "</div>";
Database::disconnect();

?>

</body>
<?php
require 'footer.php';
?>
</html>