<!-- contenu de la page -->
		<?php
			session_start();
			if(isset($_SESSION['pseudo']) && isset($_SESSION['pass']))
			{
				include("template/header.php");
				include('template/header_file.php');
		?>
		<section style="height:100%;">
			<?php
				require_once("../scripts/base_connexion.php");
				require_once("../scripts/traitement.php");
				require_once("../scripts/requetes.php");

				$historiques = selectionneMensualitesClients($base);

				echo "<div>
				<table border='2' style='width:100%; height:100%;'>
					<caption>Liste des messages</caption>
					<thead>
						<tr>
							<th>UID client</th>
							<th>Service</th>
							<th>Mois</th>
							<th>Annee</th>
							<th>Date du paiement</th>
						</tr>
					</thead>
					<tbody>
				";

				while($mensualite=$historiques->fetch()) {
					?>
						<tr>
							<td><?php echo $mensualite['client_UID'];?></td>
							<td><?php echo $mensualite['service_titre'];?></td>
							<td><?php echo $mensualite['mois'];?></td>
							<td><?php echo $mensualite['annee'];?></td>
							<td><?php echo $mensualite['date_paiement'];?></td>
						</tr>
					<?php
				}
				echo "</tbody>
				</table>
				</div>";
			?>
		</section>
		
		<?php
			include('template/footer_file.php');}
			
			else
			{
				session_destroy();
				header("location: index.php");
			}
			include("template/footer.php");
		?>
