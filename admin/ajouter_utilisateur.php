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
				if(isset($_POST['username']) && isset($_POST['password']) && $_POST['username']!=="" && $_POST['password']!==""){
					require_once("../scripts/base_connexion.php");
					require_once("../scripts/traitement.php");
					require_once("../scripts/requetes.php");

					//insertion dans la base
					$res=newUser($_POST['username'],$_POST['password'],$base);

					if($res==-1){
						echo "<div>Impossible d'ajouter cet utilisateur!</div>";
					}elseif($res==0){
						echo "<div>Cet utilisateur existe déjà...</div>";
					}else{
						echo "<div>Opération d'ajout de l'utilisateur réussie:<br/>
							<label>Nom d'utilisateur</label> " . $_POST['username'] . "<br/>
							<label>Mot de passe</label>" . $_POST['password'] . "<br/>
						</div>";
					}
				}
				else{
					?>
					<form method="post" action="ajouter_utilisateur.php">
						<table>
						<tr>
							<td><label>Nom d'utilisateur</label></td>
							<td><input type="text" name="username" autocomplete="off" placeholder="username" required/></td>
						</tr>
						<tr>
							<td><label>Mot de passe</label></td>
							<td><input type="password" name="password" required/></td>
						</tr>
						<tr>
							<td><input type="submit" value="Ajouter"/></td>
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
