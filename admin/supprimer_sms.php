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
					$sms=selectionneSMS($_POST['id'],$base);
		
					?>
					<div>
						Voulez vous vraiment supprimer ce sms?<br/>
						<table>
							<tr>
								<td><?php echo $sms['expediteur'];?></td>
								<td><?php echo $sms['destinataire'];?></td>
								<td><?php echo $sms['objet'];?></td>
								<td><?php echo $sms['contenu'];?></td>
								<td><?php echo $sms['date_sms'];?></td>
							</tr>
						</table>
					</div>
					<br/>
					<form method="post" action="supprimer_sms.php">
						<input type="hidden" name="id_sms" <?php echo "value='" . $sms['id'] . "'";?> />
						<input type="submit" value="Supprimer"/>
						<input type="button" value="Annuler" onclick="document.location.href='liste_sms.php'" />
					</form>
					
					
					<?php

					
					
				}elseif(isset($_POST['id_sms']) && $_POST['id_sms']!==""){
					
					//supprimer l'enregsitrement dans la base
					supprimeSMS($_POST['id_sms'], $base);
					
					header("location: liste_sms.php");

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
