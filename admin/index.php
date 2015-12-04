<!-- contenu de la page -->
		<?php
			session_start();
			if(isset($_SESSION['pseudo']) && isset($_SESSION['pass']))
			{
			include("template/header.php");
		?>
		<?php include('template/header_file.php');?>

			Bienvenue dans la plateforme Alientech.
		
		<?php include('template/footer_file.php');?>
<?php
			}
			else
			{
				session_destroy();
				include("connexion.php");
			}
include("template/footer.php");
?>
