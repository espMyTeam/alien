<!-- contenu de la page -->
		<?php
			session_start();
			if(isset($_SESSION['pseudo']) && isset($_SESSION['pass']))
			{
				include("template/header.php");
				include('template/header_file.php');
		?>
		<section style="height:100%;">
			<form>
				<table>
					<tr>
						<td><label>Service:</label></td>
						<td>
							<select name="tuto_service" id="tuto_service" onchange="affiche();" required>	
							<option value="S1">S1: Niou dème</option>
							<option value="S2">S2: So Coool</option>
							<option value="S3">S3: Pro du jour</option>
							<option value="S4">S4: CpasDiable</option>
							<option value="*">Tout</option>	
							</select>
						</td>
					</tr>
					<tr>
						<td><label>Statut:</label></td>
						<td>
							<select name="tuto_statut" id="tuto_statut" onchange ="affiche();" required>
							<option value="succes">Envoyés</option>
							<option value="attente">A envoyer</option>
							<option value="echec">Non ennvoyes</option>
							<option value="tout">Tout</option>		
							</select>
						</td>
					</tr>
					<tr>
						<td><label>Entre:</label></td>
						<td>
							<input type="date" onchange="affiche();" name="tuto_dated" id="tuto_dated" value=<?php echo date("Y-m-d");?> required/>
						</td>
						<td>
							<input type="date" onchange="affiche();" name="tuto_datef" id="tuto_datef" value=<?php echo date("Y-m-d");?> required/>
						</td>
					</tr>
				</table>
			</form>

			<!-- affichage de la table -->
			<div id="liste_div">Patienter un peu...</div>

			<script type="text/javascript">
		//recuperer les element
		var service = document.getElementById("tuto_service");
		var statut = document.getElementById("tuto_statut");
		var dated = document.getElementById("tuto_dated");
		var datef = document.getElementById("tuto_datef");
		var div = document.getElementById("liste_div");

		var xhr=new XMLHttpRequest();
		


	function affiche(){

		var vservice=service.options[service.selectedIndex].value;
		var vstatut=statut.options[statut.selectedIndex].value;
		var vdated=dated.value, vdatef=datef.value;

		xhr.onreadystatechange=actualise;
		xhr.open("POST", "ajax_liste_tutoriel.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		var data="service="+vservice+"&statut="+vstatut+"&dated="+vdated+"&datef="+vdatef;

		xhr.send(data);
		
	}

	function actualise(){
		if(this.readyState==4 && this.status==200){
			div.innerHTML=this.responseText;
		}
	}

	</script>

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
