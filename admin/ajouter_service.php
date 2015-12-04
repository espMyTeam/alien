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
				if(isset($_POST['service_titre']) && $_POST['service_titre']!=="" 
					&& isset($_POST['service_nom']) && $_POST['service_nom']!==""
					&& isset($_POST['service_description']) && $_POST['service_description']!==""
					&& isset($_POST['service_numero']) && $_POST['service_numero']!==""
					){
					require_once("../scripts/base_connexion.php");
					require_once("../scripts/traitement.php");
					require_once("../scripts/requetes.php");

					
					$service = array(
						":service_numero" => $_POST['service_numero'],
						":service_titre" => $_POST['service_titre'],
						":service_description" => $_POST['service_description'],
						":service_nom" => $_POST['service_nom']
					);
					//insertion dans la base
					$res=newService($service,$base);

					if($res==-1){
						echo "<div>Impossible d'ajouter ce service!</div>";
					}elseif($res==0){
						echo "<div>le titre de ce service existe deja. Veuillez changer le titre...</div>";
					}else{
						header("location: liste_service.php");
					}
				}
				else{
					?>
					<form method="post" action="ajouter_service.php">
						<table border="0">
						<caption>Nouveau Service</caption>
						<tr>
							<td><label>Titre:</label></td>
							<td><input type="text" name="service_titre" placeholder="Titre" /></td>
						</tr>
						<tr>
							<td><label>Nom:</label></td>
							<td><input type="text" name="service_nom" placeholder="Nom"/></td>
						</tr>
						<tr>
							<td><label>Description:</label></td>
							<td><input type="textarea" name="service_description" placeholder="Description"/></td>
						</tr>
						<tr>
							<td><label>N° Telephone:</label></td>
							<td><input type="number" name="service_numero" placeholder="Numéro de service"/></td>
						</tr>
						<tr>
							<td><input type="submit" value="Ajouter"/></td>
							<td><input type="button" value="Annuler" onclick="document.location.href='index.php'" /></td>
						</tr>
						</table>
					</form>
					<?php
				}
			?>
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
