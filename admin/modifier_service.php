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
					$res=selectionneServiceById($_POST['id'],$base);
		
					?>
					<form method="post" action="modifier_service.php">
						<table border="0">
						<caption>Service n°:<?php echo $res['service_id'];?></caption>
						<tr>
							<td><label>Titre:</label></td>
							<td><input type="text" name="service_titre" placeholder="titre service" <?php echo "value='" . $res['service_titre'] . "'";?> /></td>
						</tr>
						<tr>
							<td><label>Nom:</label></td>
							<td><input type="text" name="service_nom" placeholder="Nom service" <?php echo "value='" . $res['service_nom'] . "'";?> /></td>
						</tr>
						<tr>
							<td><label>Descriptio:n</label></td>
							<td><input type="textarea" name="service_description" <?php echo "value='" . $res['service_description'] . "'";?> /></td>
						</tr>
						<tr>
							<td><label>N° Tel:</label></td>
							<td><input type="number" name="service_numero" <?php echo "value='" . $res['service_numero'] . "'";?> /></td>
						</tr>
						<tr>
							<td><input type="submit" value="Enregistrer"/></td>
							<td><input type="button" value="Annuler" onclick="document.location.href='liste_service.php'" /></td>
						</tr>
						</table>
						<input type="hidden" name="service_id" <?php echo "value='" . $res['service_id'] . "'";?> />
					</form>
					<?php

					
					
				}
				elseif(isset($_POST['service_titre']) && $_POST['service_titre']!=="" 
					&& isset($_POST['service_nom']) && $_POST['service_nom']!==""
					&& isset($_POST['service_description']) && $_POST['service_description']!==""
					&& isset($_POST['service_numero']) && $_POST['service_numero']!==""
					&& isset($_POST['service_id']) && $_POST['service_id']!==""){
					//modifier l'enregsitrement dans la base
					
					$service = array(
						":service_nom" => $_POST['service_nom'],
						":service_titre" => $_POST['service_titre'],
						":service_description" => $_POST['service_description'],
						":service_numero" => $_POST['service_numero'],
						":service_id" => $_POST['service_id']
					);

					//insertion dans la base
					$res=modifieService($service,$base);

					header("location: liste_service.php");

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
