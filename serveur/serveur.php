#! /usr/bin/php
<?php
	require_once("../scripts/base_connexion.php");
	require_once("../scripts/requetes.php"); 
	require_once("../scripts/service.php");
	
	function updateMensualite($base){
		
		$dat = Date("d H:i:s");
		$action = selectionAction(1, $base);

		//si le delai de mise de jour
		if($dat===$action['action_date']){
			
			//recuperer tous les inscriptions
			$inscription = selectionneInscriptions($base);

			while($donnees = $inscription->fetch()) {

				//imettre le champ mensulite a 0
				modifieChampInscription("mensualite", 0, $donnees["inscription_id"], $base);
			}

		}
	}

/*
*
* description: mettre à jour les codes aleatoires de paiment
*/
	function updateCode(){
		return 0;
	}

$fait = false;

	//une boucle 
while(true){
	
	if($fait==false){
		echo Date("s");
		echo "debut";
		$clock = Date("i"); //minute

		
		if(((int) ($clock))%10==0 ){ //a chaque 10min ie xx:x0:xx

			echo "chaque 10min";

			//envoie de tutoriel
			prepareEnvoieTutoriels($base);
		}

		if(((int) ($clock))%5 == 0){ //a chaque 5min 

			echo "chaque 5 min";

			//envoie de tutoriel
			demandeConfirmeEnvoieTuto($base);
		}
			
		if(Date("H:i")==="00:00"){
			echo "update mensualité";

			//mise à jour des mensualité
			updateMensualite($base);
		}

		$fait = true;
	}
	if(Date("s")==="00"){
		$fait = false;
		sleep(1);
	}

}

?>

