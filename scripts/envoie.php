<?php
	$URL="http://localhost:13013/cgi-bin/sendsms?username=abdoulaye&password=kamstelecom&from=773921334&to=773675372&text=boy%20kams%20na%20kala";
	$url = urlencode($URL);
	$resultat = file_get_contents("$URL");
	//require_once("traitement.php");

	//envoieMsg("773921334","S1 DK");
?>
