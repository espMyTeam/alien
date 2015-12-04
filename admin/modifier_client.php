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
				include('template/header_file.php');

				if(isset($_GET['client']) && $_GET['client']!==""){

					//selectionner le client
					$res=selectionneClient($_GET['client'],$base);
					
					if($res==[]){
						//detruire la variable client
					}
					else{
		
					?>
					<form method="post" action="modifier_client.php" rel='form'>
						<table class="table bootstrap-datatable datatable responsive">
						<tr>
							<td><label>UID</label></td>
							<td><input type="text" name="client_UID" <?php echo "value='" . $res['client_UID'] . "'";?> class="form-control"/></td>
						</tr>
						<tr>
							<td><label>N° telephone</label></td>
							<td><input type="text" name="client_numTel" <?php echo "value='" . $res['client_numTel'] . "'";?> class="form-control"/></td>
						</tr>
						<tr>
							<td><label>Date inscription</label></td>
							<td><input type="text" class="form-control" name="client_dateInsc" <?php echo "value='" . $res['client_dateInsc'] . "'";?> required></td>
						</tr>
						<tr>
							<td><label>Extesion Couverture</label></td>
							<td><input type="text" name="client_extCouv" <?php echo "value='" . $res['client_extCouv'] . "'";?> class="form-control"/></td>
						</tr>
						<tr>
							<td><label>UFR</label></td>
							<td><input type="text" name="client_UFR" <?php echo "value='" . $res['client_UFR'] . "'";?> class="form-control"/></td>
						</tr>
						<tr>
							<td><label>adresse MAC</label></td>
							<td><input type="text" name="client_adrMac" <?php echo "value='" . $res['client_adrMac'] . "'";?> class="form-control"/></td>
						</tr>
						<tr>
							<td class="center" colspan=2><center><button type="submit" class="btn btn-info">Sauvegarder</button>
							<button type="button" class="btn btn-default" onclick="document.location.href='liste_client.php'" >Annuler</button></center></td>
						</tr>

						</table>
						<input type="hidden" name="client_id" <?php echo "value='" . $res['client_id'] . "'";?> />
					</form>
					<?php
					} //fin else
					
					
				}
				elseif(isset($_POST['client_id']) && $_POST['client_id']!=="" && 
					isset($_POST['client_UID']) && $_POST['client_UID']!=="" && 
					isset($_POST['client_UFR']) &&  
					isset($_POST['client_numTel']) && $_POST['client_numTel']!=="" && 
					isset($_POST['client_dateInsc']) && $_POST['client_dateInsc']!=="" && 
					isset($_POST['client_adrMac']) &&  
					isset($_POST['client_extCouv'])){
					//modifier l'enregsitrement dans la base
					
					$client= array(
						':client_UFR' => $_POST['client_UFR'],
						':client_dateInsc' => $_POST['client_dateInsc'],
						':client_adrMac' => $_POST['client_adrMac'],
						':client_UID' => $_POST['client_UID'],
						':client_numTel' => $_POST['client_numTel'],
						':client_extCouv' => $_POST['client_extCouv'],
						':client_id' => $_POST['client_id']
					);
					
					

					$res = modifieClient($client, $base);
					header("location: liste_client.php");

				}
				else{
					
					//header("location: index.php");
					//saisie de l'UID du client
					?>
					<form method="get" action="modifier_client.php">
						<table>
							<tr>
								<td><input type="text" name="client" placeholder="UID du client" class="form-control"></td>
								<td><button type="submit" class="btn btn-info"> <i class="glyphicon glyphicon-search icon-white"></i></button></td></tr>
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
				header("location: index.php");
			}
			include('template/footer_file.php');
			include("template/footer.php");
		?>
