<?php
	require_once("../scripts/base_connexion.php");
					require_once("../scripts/traitement.php");
					require_once("../scripts/requetes.php");
	require_once("../scripts/service.php");
							
	/*$res = selectionneTutoriel(2, $base);
	print_r($res);

	modifieChampTutoriel("tutoriel_confirm1", 0, 2, $base);

	$res = selectionneTutoriel(2, $base);
	print_r($res);*/

	demandeConfirmeEnvoieTuto($base);
?>
