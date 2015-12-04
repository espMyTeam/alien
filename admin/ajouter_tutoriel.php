<!-- contenu de la page -->
		<?php
			session_start();
			if(isset($_SESSION['pseudo']) && isset($_SESSION['pass']))
			{
				include("template/header.php");
				include('template/header_file.php');
		?>
		<section>
			<?php
				if(isset($_POST['tutoriel_entete']) && $_POST['tutoriel_entete']!=="" 
					&& isset($_POST['tutoriel_contenu']) && $_POST['tutoriel_contenu']!==""
					&& isset($_POST['service_titre']) && $_POST['service_titre']!==""){
					require_once("../scripts/base_connexion.php");
					require_once("../scripts/traitement.php");
					require_once("../scripts/requetes.php");

					if(!(isset($_POST['date']) && isset($_POST['heure']) && $_POST['date']!=="" && $_POST['heure']!=="")){
						$_POST['date'] = date("Y-m-d");
						$_POST['heure'] = date("H:i");
					}
					$dateDenvoie = $_POST['date'] . " " . $_POST['heure'] . ":00";
					$tuto = array(
						":tutoriel_entete" => $_POST['tutoriel_entete'],
						":tutoriel_contenu" => $_POST['tutoriel_contenu'],
						":tutoriel_dateDenvoie" => $dateDenvoie,
						":service_titre" => $_POST['service_titre'],
						":tutoriel_auteur" =>  $_SESSION['pseudo']
					);
					//insertion dans la base
					$res=newTutoriel($tuto,$base);

					if($res==-1){
						echo "<div>Impossible d'ajouter ce tutoriel!</div>";
					}elseif($res==0){
						echo "<div>le titre de e tutoriel existe deja. Veuillez changer le titre...</div>";
					}else{
						header("location: liste_tutoriel.php");
					}
				}
				else{
					?>
					<form method="post" action="ajouter_tutoriel.php">
						<table border="0" id="table_nvtuto">
						<caption>Nouveau tutoriel</caption>
						<tr>
							<td><label>Entete</label></td>
							<td><input type="text" name="tutoriel_entete" placeholder="entete tutoriel" required /></td>
						</tr>
						<tr>
							<td><label>Tutoriel</label></td>
							<td><input type="textarea" name="tutoriel_contenu" style="width:100px;height:200px;" required /></td>
						</tr>
						<tr>
							<td><label>Service</label></td>
							<td><select name="service_titre" required>
								
									<option value="S1">S1</option>
									<option value="S2">S2</option>
									<option value="S3">S3</option>
									<option value="S4">S4</option>
								
							</select></td>
						</tr>
						<tr>
							<td><label>Envoie differé</label></td>
							<td><input type="checkbox" id="envoie_differe" name="envoie_differe" onchange="envoiediffere();" /></td>
						</tr>
						
						
						</table>
						<table>
							<tr>
								<td width="100px"><input type="submit" value="Envoyer"/></td>
								<td width="100px"><input type="button" value="Annuler" onclick="document.location.href='index.php'" /></td>
							</tr>
						
						</table>
					</form>
					<script type="text/javascript">
						//gestion de l'envoie differé
						function envoiediffere(){
							var envoie = document.getElementById("envoie_differe");
							var table = document.getElementById('table_nvtuto');

							if(envoie.checked){
								var date = document.createElement('input');
								date.name = "date";
								date.type = "date";
								date.required=true;
								var heure = document.createElement('input');
								heure.type = "time";
								heure.name = "heure";
								heure.required=true;								

								//ajouter les balises pour la date et l'heure
								var trd = document.createElement('tr');
								trd.id="datetr";
							//	var trt = document.createElement('tr');
							//	trt.id="timetr";
								var tdld = document.createElement('td');
								var tdlt = document.createElement('td');
								var tdid = document.createElement('td');
								var tdit = document.createElement('td');
								var labeld = document.createElement('label');
							//	var labelt = document.createElement('label');

								table.appendChild(trd);
								trd.appendChild(tdld);
								tdld.innerHTML = "Date et heure d'envoie";
								trd.appendChild(tdid);
								tdid.appendChild(date);

							//	table.appendChild(trt);
								//trd.appendChild(tdlt);
								//tdlt.innerHTML = "Heure d'envoie";
								trd.appendChild(tdit);
								tdit.appendChild(heure);

							}
							else{
								//supprimer la date et heure
								var date = document.getElementById("datetr");
							//	var heure = document.getElementById("timetr");
								date.parentNode.removeChild(date);
							//	heure.parentNode.removeChild(heure);

							}
						}


					</script>
					<?php
				}
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
