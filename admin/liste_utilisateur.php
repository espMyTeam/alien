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

				$utilisateurs = selectionneUsers($base);

				echo "
				<table border='2' style='width:50%;'>
					<caption>Liste des administrateurs</caption>
					<thead>
						<tr>
							<th>Nom d'utilisateur</th>
						</tr>
					</thead>
					<tbody>
				";
				while($utilisateur=$utilisateurs->fetch()) {
					?>
						<tr>
							<td><?php echo $utilisateur['username'];?></td>
							<form method="post" action="modifier_utilisateur.php">
								<input type="hidden" name="user" value=<?php echo "" . $utilisateur['id_admin'];?> />
								<td width="30px"><input type="submit" value="Modifier" style="width:100%;" class='bct'></td>
							</form>
							<form method="post" action="supprimer_utilisateur.php">
								<input type="hidden" name="user" value=<?php echo "" . $utilisateur['id_admin'];?> />
								<td width="30px"><input type="submit" class='bct' value="Supprimer" style="width:100%;"></td>
							</form>
							
							
						</tr>
					<?php
				}
				echo "</tbody>
				</table>";
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
