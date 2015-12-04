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
						<table border="0">
						<caption>Service n°:<?php echo $res['service_id'];?></caption>
						<tr>
							<td><label>Titre:</label></td>
							<td><?php echo  $res['service_titre'];?></td>
						</tr>
						<tr>
							<td><label>Nom:</label></td>
							<td><?php echo $res['service_nom'];?></td>
						</tr>
						<tr>
							<td><label>Description:</label></td>
							<td><?php echo $res['service_description'];?></td>
						</tr>
						<tr>
							<td><label>N° Tel:</label></td>
							<td><?php echo $res['service_numero'];?></td>
						</tr>
						</table>

					<form method="post" action="supprimer_service.php">
						<input type="hidden" name="id_service" <?php echo "value='" . $res['service_id'] . "'";?> />
						<input type="submit" value="Supprimer"/>
						<input type="button" value="Annuler" onclick="document.location.href='liste_service.php'" />
					</form>
					
					
					<?php

					
					
				}elseif(isset($_POST['id_service']) && $_POST['id_service']!==""){
					
					//supprimer l'enregsitrement dans la base
					supprimeService($_POST['id_service'], $base);?>

					<?php
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
