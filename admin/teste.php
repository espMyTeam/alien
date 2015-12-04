<?php
	require_once("../scripts/base_connexion.php");
		require_once("../scripts/traitement.php");
		require_once("../scripts/requetes.php");
			print_r($_POST);
				$data=["*","tout","2"];

				$tutoriels = selectionneTutorielsService($base, $data);
		while($tutoriel=$tutoriels->fetch()){
			print_r($tutoriel);
		}
?>
