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
					
		
					?>
						<table border="0">
						<caption>tutoriel n°:<?php echo $res['tutoriel_id'];?></caption>
						<tr>
							<td><label>Entete</label></td>
							<td><?php echo  $res['tutoriel_entete'];?></td>
						</tr>
						<tr>
							<td><label>Tutoriel</label></td>
							<td><?php echo $res['tutoriel_contenu'];?></td>
						</tr>
						<tr>
							<td><label>Date d'envoie</label></td>
							<td><?php echo $res['tutoriel_dateDenvoie'];?></td>
						</tr>
						<tr>
							<td><label>Service</label></td>
							
							<td><?php echo $res['service_titre'];?></td>
						</tr>
						</table>

					<form method="post" action="supprimer_tutoriel.php">
						<input type="hidden" name="id_tuto" <?php echo "value='" . $res['tutoriel_id'] . "'";?> />
						<input type="submit" value="Supprimer"/>
						<input type="button" value="Annuler" onclick="document.location.href='liste_tutoriel.php'" />
					</form>
					
					
					<?php

					
					
				}elseif(isset($_POST['id_tuto']) && $_POST['id_tuto']!==""){
					
					//supprimer l'enregsitrement dans la base
					supprimeTutoriel($_POST['id_tuto'], $base);?>
					<script type="text/javascript">
						alert("Tutoriel bien supprimé");
					</script>
					<?php
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
