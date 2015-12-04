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
		<section>
			<?php
				require_once("../scripts/base_connexion.php");
				require_once("../scripts/traitement.php");
				require_once("../scripts/requetes.php");
				if(isset($_POST['id']) && $_POST['id']!==""){

					//selectionner l'utilisateur
					$res=selectionneTutoriel($_POST['id'],$base);
					$date = explode(" ", $res["tutoriel_dateDenvoie"]);
					$heure = explode(":", $date[1]);
					$heure = "$heure[0]:$heure[1]";
		
					?>
					<form method="post" action="modifier_tutoriel.php">
						<table border="0">
						<caption>tutoriel n°:<?php echo $res['tutoriel_id'];?></caption>
						<tr>
							<td><label>Entete</label></td>
							<td><input type="text" name="tutoriel_entete" placeholder="entete tutoriel" <?php echo "value='" . $res['tutoriel_entete'] . "'";?> /></td>
						</tr>
						<tr>
							<td><label>Tutoriel</label></td>
							<td><input type="textarea" name="tutoriel_contenu" style="width:100px;height:200px;" <?php echo "value='" . $res['tutoriel_contenu'] . "'";?> /></td>
						</tr>
						<tr>
							<td><label>Date d'envoie</label></td>
							<td><input type="date" name="date" <?php echo "value='" . $date[0] . "'";?> /></td>
						</tr>
						<tr>
							<td><label>Heure d'envoie</label></td>
							<td><input type="time" name="heure" <?php echo "value='" . $heure . "'";?> /></td>
						</tr>
						<tr>
							<td><label>Service</label></td>
							
							<td><input type="text" name="service_titre" <?php echo "value='" . $res['service_titre'] . "'";?> /></td>
						</tr>
						<tr>
							<td><input type="submit" value="Enregistrer"/></td>
							<td><input type="button" value="Annuler" onclick="document.location.href='liste_tutoriel.php'" /></td>
						</tr>
						</table>
						<input type="hidden" name="tutoriel_id" <?php echo "value='" . $res['tutoriel_id'] . "'";?> />
					</form>
					<?php

					
					
				}
				elseif(isset($_POST['tutoriel_entete']) && $_POST['tutoriel_entete']!=="" 
					&& isset($_POST['tutoriel_contenu']) && $_POST['tutoriel_contenu']!==""
					&& isset($_POST['date']) && $_POST['date']!==""
					&& isset($_POST['heure']) && $_POST['heure']!==""
					&& isset($_POST['service_titre']) && $_POST['service_titre']!==""
					&& isset($_POST['tutoriel_id']) && $_POST['tutoriel_id']!==""){
					//modifier l'enregsitrement dans la base
					
					$dateDenvoie = $_POST['date'] . " " . $_POST['heure'] . ":00";
					$tuto = array(
						":tutoriel_entete" => $_POST['tutoriel_entete'],
						":tutoriel_contenu" => $_POST['tutoriel_contenu'],
						":tutoriel_dateDenvoie" => $dateDenvoie,
						":service_titre" => $_POST['service_titre'],
						":tutoriel_auteur" =>  $_SESSION['pseudo'],
						":tutoriel_id" => $_POST['tutoriel_id']
					);
					

					$res = modifieTutoriel($tuto, $base);
					header("location: liste_tutoriel.php");

				}
				else{
					
					header("location: index.php");
				}
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
