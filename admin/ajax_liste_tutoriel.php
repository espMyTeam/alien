
<?php
	
	if(isset($_POST['service']) && isset($_POST['statut']) && isset($_POST['dated']) && isset($_POST['datef'])){
		
		//faire la requete
		
		require_once("../scripts/base_connexion.php");
		require_once("../scripts/traitement.php");
		require_once("../scripts/requetes.php");

		$data=[$_POST['service'], $_POST['statut'], $_POST['dated'], $_POST['datef']];


		$tutoriels = selectionneTutorielsService($base, $data);
		if(!empty($tutoriels)){

		echo "<div>
				<table border='2' style='width:100%; height:100%;'>
					<caption>Historique des tutoriels</caption>
					<thead>
						<tr>
							<th>Entete</th>
							<th>Contenu</th>
							<th>Service</th>
							<th>Date d'envoie</th>
						</tr>
					</thead>
					<tbody>
			";
				while($tutoriel=$tutoriels->fetch()) {
					?>
						<tr>
							<td><?php echo $tutoriel['tutoriel_entete']; ?></td>
							<td><?php echo $tutoriel['tutoriel_contenu']; ?></td>
							<td><?php echo $tutoriel['service_titre']; ?></td>
							<td><?php echo $tutoriel['tutoriel_dateDenvoie']; ?></td>
							
							<form method='post' action='supprimer_tutoriel.php'>
								<input type='hidden' name='id' value=<?php echo '' . $tutoriel['tutoriel_id'];?> />
								<td width='30px'><input type='submit' class='bct' value='Supprimer' style='width:100%;'></td>
							</form>
							<form method='post' action='modifier_tutoriel.php'>
								<input type='hidden' name='id' value=<?php echo '' . $tutoriel['tutoriel_id'];?> />
								<td width='30px'><input type='submit' class='bct' value='Modifier' style='width:100%;'></td>
							</form>
							
						</tr>
	<?php
				}
echo "</tbody></table></div>";
		}else{
			echo "Aucun resultat";
		}

	}
	else{
		echo "Aucun resultat";
	}

?>	