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
			print_r($_SESSION);
		?>
		<section>
			Bienvenue dans la plateforme Alientech.
		</section>
		
		<?php
			}
			else
			{
				session_destroy();
				include("connexion.php");
			}
			include("template/footer.php");
		?>
	</body>
</html>
