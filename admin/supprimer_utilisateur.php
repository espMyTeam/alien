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
					<div>
						Voulez vous vraiment supprimer l'utilisateur?<br/>
						<span><?php echo $res['id_admin']?></span>
						<span><?php echo $res['username']?></span>
						<span><?php echo $res['password']?></span>
					</div>
					<br/>
					<form method="post" action="supprimer_utilisateur.php">
						<input type="hidden" name="id_admin" <?php echo "value='" . $res['id_admin'] . "'";?> />
						<input type="submit" value="Supprimer"/>
					</form>
					<input type="submit" value="Annuler" onclick="document.location.href='liste_utilisateur.php'" />
					
					<?php

					
					
				}elseif(isset($_POST['id_admin']) && $_POST['id_admin']!==""){
					
					print_r($_POST);
					//supprimer l'enregsitrement dans la base
					supprimeUser($_POST['id_admin'], $base);
					
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
