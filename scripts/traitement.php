<?php
/*
* module: traitement.php
* description: ensemble de fonctions et de classes utiles pour le traitement
*
*/

/**************** modules importes ***********/
//require_once("requetes.php");

/*************************** fonctions ********************************************/




/*
* fonction: envoieMsg(Int numeroTel, String message)
* retour: 0 ou 1 
* description : envoie un message au serveur kannel en utilisant le numero qui a emis le sms
*/
function envoieMsg($msg){
	echo $msg;
}

/*
* fonction: envoieSMS(Int numeroTel, String message)
* retour: 0 ou 1 
* description : envoie un message au numero de telephone specifie
*/
function envoieSMS($num,$msg){
	/*$msg = str_replace(" ","%20",$msg);
	$URL="http://localhost:13013/cgi-bin/sendsms?username=abdoulaye&password=kamstelecom&from=773921334&to=$num&text=$msg";
	//$url = urlencode($URL);
	$resultat = file_get_contents("$URL");*/
	echo "$msg";
}


function valideNumero($num, $base)
{
	//regarder si le numero est dans la base de donnees
	$client = selectionneClientByTel($num, $base);

	if($client){
		return $client;
	}else{
		return -1;
	}
}

/*
* fonction: nouveauUID
*
*/
function newUID($id, $fillial){
	$res="";
	if($id>=0 && $id<10)
	{
		$res="0000" . $id;
	}
	elseif ($id>=10 && $id<100) {
		$res = "000" . $id;
	}
	elseif($id>=100 && $id<1000)
	{
		$res= "00" . $id;
	}
	elseif($id>=1000 && $id<10000)
	{
		$res= "0" . $id;
	}
	else{
		$res = $id;
	}
	return $res . $fillial;
}

/*
* fonction: analyseMessage(String message)
* retour: tableau de String
* decription: analyse le message
*/
function analyseMessage($msg, $num, $base){
	
	$tab = explode(" ", $msg);
	$service = $tab[0];


	switch ($service) {
		case "S1":
			serviceS1($tab, $num, $base);
			break;
		case "S2":
			serviceS2($tab, $num, $base);
			break;
		case "S3":
			serviceS3($tab, $num, $base);
			break;
		case "S4":
			serviceS4($tab, $num, $base);
			break;
		case "AD": //Alientech Administration
			ConfirmeEnvoieTuto($tab, $num, $base);
			break;
		default:
			envoieMsg("Erreur!");
			break;
	}
}

/*
*
*
*/
function codePaiement($uid){
	$an=Date("Y");
	$mois = Date("m");
	$jour = Date("d");
	
}

/*
*
*
*/
function getMois(){
	$mois = Date("m");
	$res = "";
	switch($mois){
		case "1":
			$res="Janvier";
			break;
		case "2":
			$res="Février";
			break;
		case "3":
			$res="Mars";
			break;
		case "4":
			$res="Avril";
			break;
		case "5":
			$res="Mai";
			break;
		case "6":
			$res="Juin";
			break;
		case "7":
			$res="Juillet";
			break;
		case "8":
			$res="Août";
			break;
		case "9":
			$res="Septembre";
			break;
		case "10":
			$res="Octobre";
			break;
		case "11":
			$res="Novembre";
			break;
		case "12":
			$res="Decembre";
			break;
	}
	return $res;
}

 

?>

