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
				if(isset($_POST['user']) && $_POST['user']!==""){

					//selectionner l'utilisateur
					$res=selectionneUserById($_POST['user'],$base);
		
					?>
					<form method="post" action="modifier_utilisateur.php">
						<table>
						<tr>
							<td><label>Nom d'utilisateur</label></td>
							<td><input type="text" name="username" <?php echo "value='" . $res['username'] . "'";?> /></td>
						</tr>
						<tr>
							<td><label>Mot de passe</label></td>
							<td><input type="password" name="password" <?php echo "value='" . $res['password'] . "'";?> /></td>
						</tr>
						<tr>
							<td><input type="submit" value="Modifier"/></td>
						</tr>
						</table>
						<input type="hidden" name="id_admin" <?php echo "value='" . $res['id_admin'] . "'";?> />
					</form>
					<?php

					
					
				}elseif(isset($_POST['id_admin']) && isset($_POST['username']) && isset($_POST['password']) && $_POST['username']!=="" && $_POST['password']!=="" && $_POST['id_admin']!==""){
					//modifier l'enregsitrement dans la base
					
					$utilisateur = array(
						':username' => $_POST['username'],
						':password' => $_POST['password'],
						':id_admin' => $_POST['id_admin']
					);
					

					$res = modifieUser($utilisateur, $base);
					header("location: liste_utilisateur.php");

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
