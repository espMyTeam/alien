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
				if(isset($_POST['client_UID']) && $_POST['client_UID']!=="" && 
					isset($_POST['client_UFR']) &&  
					isset($_POST['client_numTel']) && $_POST['client_numTel']!=="" &&  
					isset($_POST['client_adrMac']) &&  
					isset($_POST['client_extCouv'])
					){
					require_once("../scripts/base_connexion.php");
					require_once("../scripts/traitement.php");
					require_once("../scripts/requetes.php");

					//creer un client
					$cl = newClient($_POST['client_numTel'], $base);

					//
					
					$client = array(
						":client_UID" => $_POST['client_UID'],
						":client_UFR" => $_POST['client_UFR'],
						":client_numTel" => $_POST['client_numTel'],
						":client_extCouv" => $_POST['client_extCouv'],
						":client_adrMac" => $_POST['client_adrMac'],
						":client_dateInsc" => Date("Y-m-d H-i-s"),
						":client_id" => $cl

					);
					//insertion dans la base
					$res=modifieClient($client,$base);

					
					if($res==-1){
						echo "<div>Impossible d'ajouter ce client!</div>";
					}elseif($res==0){
						echo "<div>le titre de ce client existe deja. ...</div>";
					}else{
						header("location: liste_client.php");
					}
				}
				else{
					?>
					<form method="post" action="ajouter_client.php">
						<table>
						<tr>
							<td><label>UID</label></td>
							<td><input type="text" name="client_UID"/></td>
						</tr>
						<tr>
							<td><label>N° telephone</label></td>
							<td><input type="number" name="client_numTel"/></td>
						</tr>
						<tr>
							<td><label>Extesion Couverture</label></td>
							<td><input type="text" name="client_extCouv"/></td>
						</tr>
						<tr>
							<td><label>UFR</label></td>
							<td><input type="text" name="client_UFR"/></td>
						</tr>
						<tr>
							<td><label>adresse MAC</label></td>
							<td><input type="text" name="client_adrMac"/></td>
						</tr>
						<tr>
							<td><input type="submit" value="Ajouter"/></td>
							<td><input type="button" value="Annuler" onclick="document.location.href='index.php'" /></td>
						</tr>

						</table>
						
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



