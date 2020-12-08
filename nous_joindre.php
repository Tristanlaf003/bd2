
<!DOCTYPE html>
<html>
	<?php
		require 'header.php';
	?>
	
	<body>		
			<?php
				require 'menu_activites.php';
			?>	
			
			<div class="Sections">
				<strong> Pour nous contacter :</strong> <br>
				Par telephone : Envoyer-moi un sms au 514 555 5555, ou laissez-moi un message vocale et je vous recontacterai des que possible dans un délais de 24 a 48h <br>
				Ou <br>
				Par email : email du concepteur du site <br>
				Ou <br>
				via le formulaire ci-dessous <br><br>
				
				<form action="depot_requete.php" method="post">	
				
					<table>
						<tr>
							<td> <label for="pseudo"> Nom Complet </label> :<br><br> </td> <td> <input type="text" name="Nom" placeholder="Justin Trudeau" id="Nom" /><br><br></td> <td></td>
						</tr>
						
						<tr>
							<td> <label for="pseudo"> Contact téléphone </label> :<br><br> </td> <td> <input type="text" name="Telephone" placeholder="450 555 5555" id="Telephone" /><br><br></td> <td></td>
						</tr>
						
						<tr>
							<td> <label for="pseudo"> Contact email si applicable</label> : <br><br> </td> <td> <input type="email" name="Email" placeholder="bbbbb@bbbbb.bb" id="Email" /><br><br></td> <td></td>
						</tr>
						
						<tr>
							<td> <label for="pseudo"> Sujet </label> : </td>
							<td>   
								<select name = "Sujet" id = "Sujet">
									<option value = "Gastronomie"> Gastronomie </option>
									<option value = "Activités et loisirs"> Activites et loisirs </option>
									<option value = "Ma vie estudiantine"> Ma vie estudiantine </option>
									<option value = "Actialité"> l'actualité </option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td> <label for="message"> Objet de la requête </label> : <br><br></td> <td> <textarea name="Requete" placeholder="Laisser votre requete ICI..." id="message" style="width:800px; height:100px;"> </textarea><br><br></td>
						</tr>
						
						<tr>
							<td>
								<td> <input type="submit" name="Add_Comment" value="Soumettre la requete" /> </td>
							</td>
						</tr>			
					</table>			
				 </form>		 
			</div>
	</body>	 
		 <?php
			require 'footer.php';
		 ?>
</html>