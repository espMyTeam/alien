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
				require_once("../scripts/base_connexion.php");
				require_once("../scripts/traitement.php");
				require_once("../scripts/requetes.php");

				$services = selectionneServices($base);

				echo "<div>
				<table border='2' style='width:100%; height:100%;'>
					<caption>Liste des Services</caption>
					<thead>
						<tr>
							<th>Label</th>
							<th>Nom</th>
							<th>Description</th>
							<th>N° Tel</th>
						</tr>
					</thead>
					<tbody>
				";
				while($service=$services->fetch()) {
					?>
						<tr>
							<td><?php echo $service['service_titre'];?></td>
							<td><?php echo $service['service_nom'];?></td>
							<td><?php echo $service['service_description'];?></td>
							<td><?php echo $service['service_numero'];?></td>
							
							
							<form method="post" action="supprimer_service.php">
								<input type="hidden" name="id" value=<?php echo "" . $service['service_id'];?> />
								<td width="30px"><input type="submit" onclick="alert(Voulez-vous vraiment supprimer ce service);" class='bct' value="Supprimer" style="width:100%;"></td>
							</form>
							<form method="post" action="modifier_service.php">
								<input type="hidden" name="id" value=<?php echo "" . $service['service_id'];?> />
								<td width="30px"><input type="submit" class='bct' value="Modifier" style="width:100%;"></td>
							</form>
							
						</tr>
					<?php
				}
				echo "</tbody>
				</table>
				</div>";
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
