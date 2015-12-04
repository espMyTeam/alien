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

				if(isset($_GET['client']) && $_GET['client']!==""){

					//selectionner le client
					$res=selectionneClient($_GET['client'],$base);
		
					?>
					
						<table>
						<caption>Client n°: <?php echo $res['client_id'];?> </caption>
						<tr>
							<td><label>UID</label></td>
							<td><?php echo $res['client_UID'];?></td>
						</tr>
						<tr>
							<td><label>N° telephone</label></td>
							<td><?php echo $res['client_numTel'];?></td>
						</tr>
						<tr>
							<td><label>Date inscription</label></td>
							<td><?php echo $res['client_dateInsc'];?></td>
						<tr>
							<td><label>Extesion Couverture</label></td>
							<td><?php echo $res['client_extCouv'];?></td>
						</tr>
						<tr>
							<td><label>UFR</label></td>
							<td><?php echo $res['client_UFR'];?></td>
						</tr>
						<tr>
							<td><label>adresse MAC</label></td>
							<td><?php echo $res['client_adrMac'];?></td>
						</tr>

						</table>
					<form method="post" action="supprimer_client.php">
						<input type="hidden" name="client_id" <?php echo "value='" . $res['client_id'] . "'";?> />
						<input type="submit" value="Supprimer"/>
						<input type="button" value="Annuler" onclick="document.location.href='liste_client.php'" />
					</form>
						
					<?php

					
					
				}
				elseif(isset($_POST['client_id']) && $_POST['client_id']!==""){
					
					//supprimer l'enregsitrement dans la base
					supprimeClient($_POST['client_id'], $base);
					header("location: liste_client.php");;

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
