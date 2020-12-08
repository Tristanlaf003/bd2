
<?php
	require 'database.php';
	echo'<head>';
	echo'	<link rel="stylesheet" href="vero.css" />';
	echo'	<meta name="viewport" content="width=device-width, initial-scale=1">';
	echo'	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
	echo'	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>';
	echo'	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>';
	echo'	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>';	 
	echo'	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> </link>';
	echo'	<title> CégepVicto Connection </title>';
	echo'	<section id = "title">'; 
	echo'			<div class = "element4"> CégepVicto Connection </div>';
					if ($_SESSION['connection'] == true){
						$prenom = $_SESSION['connectionreussi'];
						$photo = $_SESSION['photoIdentite'];
						echo "<div class = 'element4'><a href='deconnection.php'>$prenom</a></div>";

                        echo "<div class='element5'><img src='images/utilisateurs/$photo' width='30' class='img-circle'></div>";
					}
					else{
						echo'<div class = "element4"><a href="connection.php" > Se connecter </a> </div>';
						echo'<div class = "element4"><a href="inscription.php" > Je suis nouveau </a> </div>';
					}
	echo'	</section>';
	echo'</head>';

?>