<!DOCTYPE html>
<html>
	<head>
		<title>Administration AlienTech</title>
		<link rel="stylesheet" type="text/css" href="static/style/base.css">
		<?php
			include("template/meta.php");
		?>
	</head>
	<body>
		
		<!-- contenu de la page -->
		<?php
			session_start();
			if(isset($_SESSION['pseudo']) && isset($_SESSION['pass']))
			{
				include("template/header.php");

		?>
		<section style="height:100%;">
			<?php
				if(!(isset($_POST['tuto_service']) && $_POST['tuto_service'])){
					?>
					<form method="post" action="liste_tutoriel.php">
					<table>
					<tr>
						<td><label>Service:</label></td>
						<td>
							<select name="tuto_service" required>
								
							<option value="S1">S1: Niou dème</option>
							<option value="S2">S2: So Coool</option>
							<option value="S3">S3: Pro du jour</option>
							<option value="S4">S4: CpasDiable</option>
							<option value="*">Tout</option>	
							</select>
						</td>
					</tr>
					<tr>
						<td><label>Statut:</label></td>
						<td>
							<select name="tuto_status" required>
							<option value="envoye">Envoyés</option>
							<option value="attente">A envoyer</option>
							<option value="a_send_today">A envoyer aujourd'hui</option>
							<option value="tout">Tout</option>		
							</select>
						</td>
					</tr>
				</table>
				</form>
					<?php
				}else{
			?>
			
			<?php
				require_once("../scripts/base_connexion.php");
				require_once("../scripts/traitement.php");
				require_once("../scripts/requetes.php");

				$tuto_service = $_POST['tuto_service'];
				$tuto_status = $_POST['tuto_status'];

				$tutoriels = selectionneTutorielsService($tuto_service, $tuto_status, $base);

				echo "<div>
				<table border='2' style='width:100%; height:100%;'>
					<caption>Hostorique des tutoriels</caption>
					<thead>
						<tr>
							<th>Entete</th>
							<th>Contenu</th>
							<th>Service</th>
							<th>Date d'envoie</th>
							<th>Auteur</th>
						</tr>
					</thead>
					<tbody>
				";
				while($tutoriel=$tutoriels->fetch()) {
					?>
						<tr>
							<td><?php echo $tutoriel['tutoriel_entete'];?></td>
							<td><?php echo $tutoriel['tutoriel_contenu'];?></td>
							<td><?php echo $tutoriel['service_titre'];?></td>
							<td><?php echo $tutoriel['tutoriel_dateDenvoie'];?></td>
							<td><?php echo $tutoriel['tutoriel_auteur'];?></td>
							
							<form method="post" action="supprimer_tutoriel.php">
								<input type="hidden" name="id" value=<?php echo "" . $tutoriel['tutoriel_id'];?> />
								<td width="30px"><input type="submit" onclick="alert(Voulez-vous vraiment supprimer ce tutoriel);" class='bct' value="Supprimer" style="width:100%;"></td>
							</form>
							<form method="post" action="modifier_tutoriel.php">
								<input type="hidden" name="id" value=<?php echo "" . $tutoriel['tutoriel_id'];?> />
								<td width="30px"><input type="submit" class='bct' value="Modifier" style="width:100%;"></td>
							</form>
							
						</tr>
					<?php
				}
				echo "</tbody>
				</table>
				</div>";}
			?>
		</section>
		
		<?php
			}
			else
			{
				session_destroy();
				header("location: index.php");
			}
			include("template/footer.php");
		?>
	</body>
</html>
