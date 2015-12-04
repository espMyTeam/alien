
<?php
	
	if(isset($_POST['cl_uid'])){
		
		//faire la requete
		
		require_once("../scripts/base_connexion.php");
		require_once("../scripts/traitement.php");
		require_once("../scripts/requetes.php");

		$data=$_POST['cl_uid'];

		$clients = selectionneClients($base);
		

		if(!empty($clients)){
			
				while($client=$clients->fetch()){
					$nb--;
					?>

						<div><?php echo $client['client_UID']; ?></div>
	<?php
				}
			
		}else{
			echo "Aucun resultat";
		}

	}
	else{
		echo "Aucun resultat";
	}

?>	