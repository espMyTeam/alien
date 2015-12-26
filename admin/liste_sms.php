	
		
		<!-- contenu de la page -->
		<?php
			session_start();
			if(isset($_SESSION['pseudo']) && isset($_SESSION['pass']))
			{
				include("template/header.php");

		?>
		
			<?php
				require_once("../scripts/base_connexion.php");
				require_once("../scripts/traitement.php");
				require_once("../scripts/requetes.php");
				include("template/header_file.php");
				$smss = selectionneSMSs($base);

				?>
				<section> 
				<div>
				<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
								
					<caption>Liste des messages</caption>
					<thead>
						<tr>
							<th>Expediteur</th>
							<th>Destinataire</th>
<!--
							<th>Objet</th>
-->
<!--
							<th>Message</th>
-->
							<th>Date du sms</th>
						</tr>
					</thead>
					<tbody>
				<?php
				while($sms=$smss->fetch()) {
					?>
						<tr>
							<td><?php echo $sms['expediteur'];?></td>
							<td><?php echo $sms['destinataire'];?></td>
<!--
							<td><?php// echo $sms['objet'];?></td>
-->
<!--
							<td><?php //echo $sms['contenu'];?></td>
-->
							<td><?php echo $sms['date_sms'];?></td>
							
							<form method="post" action="supprimer_sms.php">
								<input type="hidden" name="id" value=<?php echo "" . $sms['id'];?> />
								<td width="30px"><input type="submit" onclick="alert(Voulez-vous vraiment supprimer ce sms);" class='bct' value="Supprimer" style="width:100%;"></td>
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
			include("template/footer_file.php");
			include("template/footer.php");
		?>
	
	
