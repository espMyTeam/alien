<meta charset="utf-8"/>
<?php
/* module: script d'initialisation du traitement
*
*/

/******* modules ********/
require_once("base_connexion.php");
require_once("traitement.php");
require_once("requetes.php");
require_once("service.php");

//$_GET['num'] = "773675378";
//$_GET['text'] = "S1 SL";

if(isset($_GET['num']) and isset($_GET['text']))
{
	$message = $_GET['text'];
	$numero = $_GET['num'];

	//analyser le message recu
	analyseMessage($message, $numero, $base);
	
}

?>
