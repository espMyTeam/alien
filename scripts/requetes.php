<?php
/*
* module: requete
* description: interrogation de la $base de donnees
*/



/*
* 
*
*/

function newClient($num, $base)
{
	$req = "INSERT INTO client(client_numTel, client_dateInsc) VALUES(:client_numTel, :client_dateInsc)";
	$res=1;
	$dat = Date("Y-m-d H-i-s");

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":client_numTel" => $num,
				":client_dateInsc" => $dat
			));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
		$res=-1;
	}


	if($res==1)
	{	
		return $base->lastInsertId();
	}
	else
	{
		return -1;
	}
}

/*
* fonction: insereClient
*/


function insereClient($tab, $base){
	$req = "INSERT INTO client(client_UID,client_numTel,client_dateInsc,client_paiement,
		client_mensualite,client_extCouv,client__UFR,client_adrMac,client_histoMensualite) 
VALUES(:client_UID,:client_numTel,:client_dateInsc,:client_paiement,:client_mensualite,
	:client_extCouv,:client__UFR,:client_adrMac,:client_histoMensualite)";
	$res=1;
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute($tab);
	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
		$res=-1;
	}


	if($res===1)
	{	
		return $base->lastInsertId();
	}
	else
	{
		return -1;
	}
	
}

/*
* fonction: selectionne
*
*/
function selectionneClient($uid, $base){
	$req = "SELECT * FROM client WHERE client_UID=:uid";
	$res=[];
	
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":uid" => $uid
			));
		$res=$envoie->fetch();

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}

	return $res;
}

/*
* fonction: selectionne le client avec le numero de telephone
*
*/
function selectionneClientByTel($num, $base){
	$req = "SELECT * FROM client WHERE client_numTel=:num";
	$res=[];
	
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":num" => $num
			));
		$res=$envoie->fetch();
	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}

	return $res;
}
/*
* fonction: selectionne inscrits à un service ou non
*
*/
function selectionneClientsAs($has_service, $base){
	$req = "SELECT * FROM client WHERE has_service=:has_service";
	$res=[];
	
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":has_service" => $has_service
			));
		$res=$envoie->fetch();
	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}

	return $res;
}

/*
*
* description:  selectionne tous les clients
*/
function selectionneClients($base, $mois=""){
	if($mois===""){
		$req = "SELECT * FROM client";
		$res=[];
	
		try
		{
			$envoie=$base->prepare($req);
			$envoie->execute(array());
			//$res=$envoie->fetch();
			$res = $envoie;

		}catch(Exception $e){
			//echo "erreur : " . $e->getMessage();
		}

		return $res;
	}
	else{
		$req = "SELECT * FROM client WHERE client_dateInsc=:client_dateInsc";
		$res=[];
	
		try
		{
			$envoie=$base->prepare($req);
			$envoie->execute(array(
				":client_dateInsc" => 2
			));
			//$res=$envoie->fetch();
			$res = $envoie;

		}catch(Exception $e){
			//echo "erreur : " . $e->getMessage();

		}

		return $res;
	}
	
}

/*
*
* description: selectionne tous les clients inscrits dans un service de ALIENTECH
*/
function selectionneClientsInscrits($base){
	$req = "SELECT client.client_UID,client_numTel,service_titre,date_insc,mensualite,code_paiement FROM client, inscription WHERE client.client_UID=inscription.client_UID";
	$res=[];
	
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":uid" => $uid
			));
	//	$res=$envoie->fetch();
		$res = $envoie;
	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}

	return $res;
}

/*
*
* description: selectionne tous les clients inscrits au service specifié de ALIENTECH
*/
function selectionneClientsService($service,$base){
	$req = "SELECT client.client_UID,client_numTel,date_insc,mensualite,code_paiement FROM client, inscription WHERE client.client_UID=inscription.client_UID 
	AND service_titre=:service_titre";
	$res=[];
	
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			":service_titre" => $service
		));
		//$res=$envoie->fetch();
		$res = $envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}

	return $res;
}




/*
* fonction: modifie
* parametres: int array tab 
*/
function modifieClient($valeur, $base){

	$req = "UPDATE client SET client_UID=:client_UID,client_numTel=:client_numTel,
	client_dateInsc=:client_dateInsc,client_extCouv=:client_extCouv,
	client_UFR=:client_UFR,client_adrMac=:client_adrMac WHERE client_id=:client_id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute($valeur);

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}

function modifieChampClient($champ, $valeur, $id, $base)
{
	$req = "UPDATE client SET $champ=:champ WHERE client_id=:client_id";
	//echo $req;

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			"champ" => $valeur,
			"client_id" => $id
		));
	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}


function getIndexDernierClient($base){
	return $base->lastInsertId();
}

/*
*
* description: supprime un client
*/
function supprimeClient($id, $base){
	$req = "DELETE FROM client WHERE client_id=:id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			"id" => $id
		));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}





/************ requetes services ************/
/*
* fonction: un nouveau service
*
*/
function newService($tab, $base){
	$req = "INSERT INTO service(service_titre,service_nom,service_description,service_numero) 
VALUES(:service_titre,:service_nom,:service_description,:service_numero)";
	$res=1;
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute($tab);
	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
		$res=-1;
	}


	if($res===1)
	{	
		return $base->lastInsertId();
	}
	else
	{
		return -1;
	}
}
/*
* fonction: selectionne un service
*
*/
function selectionneServiceById($id, $base){
	$req = "SELECT * FROM service WHERE service_id=:id";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":id" => $id
			));
		$res=$envoie->fetch();

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}
/*
* fonction: selectionne
*
*/
function selectionneService($titre, $base){
	$req = "SELECT * FROM service WHERE service_titre=:titre";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":titre" => $titre
			));
		$res=$envoie->fetch();

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}
/*
* fonction: selectionne
*
*/
function selectionneServices($base){
	$req = "SELECT * FROM service";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array());
		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}
function modifieChampService($champ, $valeur, $id, $base)
{
	$req = "UPDATE service SET $champ=:champ WHERE service_titre=:service_titre";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			"champ" => $valeur,
			"service_titre" => $id
		));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}

/*
* fonction: modifie
* parametres: int array tab 
*/
function modifieService($valeur, $base){
	$req = "UPDATE service SET service_titre=:service_titre,service_numero=:service_numero,
	service_description=:service_description,service_nom=:service_nom WHERE service_id=:service_id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute($valeur);

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}
/*
*
* description: supprime un service
*/
function supprimeService($id, $base){
	$req = "DELETE FROM service WHERE service_id=:id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			"id" => $id
		));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}





/***************** les inscriptions ************/
function newInscription($tab, $base){
	$req = "INSERT INTO inscription(client_UID,service_titre,date_insc,mensualite) 
VALUES(:client_UID,:service_titre,:date_insc,:mensualite)";
	$res=1;
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute($tab);
	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
		$res=-1;
	}


	if($res===1)
	{	
		return $base->lastInsertId();
	}
	else
	{
		return -1;
	}
}

/*
* fonction: selectionne les clients inscrits à un service
*
*/
function selectionneInscription($uid, $service, $base){
	$req = "SELECT * FROM inscription WHERE service_titre=:titre AND client_UID=:uid";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":titre" => $service,
				":uid" => $uid
			));

		$res=$envoie->fetch();

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
* fonction: selectionne les clients inscrits à un service et ont payé leurs mensualités
*
*/
function selectionneInscriptionsEnOrdre($service, $mensualite, $base){
	$req = "SELECT * FROM inscription WHERE service_titre=:titre AND mensualite=:mensualite";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":titre" => $service,
				":mensualite" => $mensualite
			));

		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
* 
* description: selectionne tous les enregistrements de mensualite à 1
*/

function selectionneInscriptions($base){
	$req = "SELECT * FROM inscription WHERE mensualite=:mensualite";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				"mensualite" => 1
			));

		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}


function modifieChampInscription($champ, $valeur, $id, $base)
{
	$req = "UPDATE inscription SET $champ=:champ WHERE inscription_id=:id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			"champ" => $valeur,
			"id" => $id
		));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}











/***************** les journaux sms ************/
function newSMS($tab, $base){
	$req = "INSERT INTO journal_sms(objet,expediteur,destinataire,contenu,date_sms) 
VALUES(:objet,:expediteur,:destinataire,:contenu,:date_sms)";
	$res=1;
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute($tab);
	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
		$res=-1;
	}


	if($res===1)
	{	
		return $base->lastInsertId();
	}
	else
	{
		return -1;
	}
}

function selectionneSMS($id, $base){
	$req = "SELECT * FROM journal_sms WHERE id=:id";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":id" => $id
			));

		$res=$envoie->fetch();

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
*
* description: selectionner tous les sms
*/
function selectionneSMSs($base){
	$req = "SELECT * FROM journal_sms";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array());

		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
*
* description: selectionner tous les sms recu
*/
function selectionneSMSrecus($base){
	$req = "SELECT * FROM journal_sms WHERE destinataire=:destinataire";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				"destinataire" => "serveur"
			));

		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
*
* description: selectionner tous les sms envoyes
*/
function selectionneSMSenvoyes($base){
	$req = "SELECT * FROM journal_sms WHERE expediteur=:expediteur";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				"expediteur" => "serveur"
			));

		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
*
* description: supprime un sms du journal
*/
function supprimeSMS($id, $base){
	$req = "DELETE FROM journal_sms WHERE id=:id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			"id" => $id
		));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}







/***************** historique mensualite ************/
function newMensualite($tab, $base){
	$req = "INSERT INTO historique_paiement(inscription_id,mois,annee,date_paiement) 
VALUES(:inscription_id,:mois,:annee,:date_paiement)";

	$res=1;
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute($tab);
	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
		$res=-1;
	}


	if($res===1)
	{	
		return $base->lastInsertId();
	}
	else
	{
		return -1;
	}
}

/*
*
* description: selectionne tous les enregistrements dans historique_paiement
*/
function selectionneMensualites($base){
	$req = "SELECT * FROM historique_paiement";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":id" => $id
			));

		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
*
* description: selectionne tous les enregistrements dans historique_paiement avec le details des clients
*/
function selectionneMensualitesClients($base){
	$req = "SELECT id,mois,annee,date_paiement,client_UID,service_titre FROM historique_paiement,inscription WHERE historique_paiement.inscription_id=inscription.inscription_id";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":id" => $id
			));

		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
*
* description: selectionne une mensualite
*/
function selectionneMensualite($id, $base){
	$req = "SELECT * FROM historique_paiement WHERE id=:id";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":id" => $id
			));

		$res=$envoie->fetch();

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

function modifieChampMensualite($champ, $valeur, $id, $base)
{
	$req = "UPDATE historique_paiement SET $champ=:champ WHERE id=:id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			"champ" => $valeur,
			"id" => $id
		));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}
/*
*
* description: supprime une historique de paiment
*/
function supprimeMensualite($id, $base){
	$req = "DELETE FROM historique_paiement WHERE id=:id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			"id" => $id
		));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}










/**************** utilisateur **************/
/*
*
*/
function newUser($username, $password, $base){
	$req = "INSERT INTO admin(username, password) VALUES(:username,:password)";

	$res=1;
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			":username" => $username,
			":password" => $password
		));
	}catch(Exception $e){
	//	echo "erreur : " . $e->getMessage();
		$res=-1;
	}


	if($res===1)
	{	
		return $base->lastInsertId();
	}
	else
	{
		return -1;
	}
}

/*
*
*
*/
function selectionneUserById($id, $base){

	$req = "SELECT * FROM admin WHERE id_admin=:id";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":id" => $id
			));

		$res=$envoie->fetch();

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
*
*
*/
function selectionneUser($username, $password, $base){

	$req = "SELECT * FROM admin WHERE username=:username AND password=:password";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":username" => $username,
				":password" => $password
			));

		$res=$envoie->fetch();

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
*
* description: selectionner tous les utilisateurs
*/
function selectionneUsers($base){

	$req = "SELECT * FROM admin";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array());

		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}
/*
* fonction: modifie un enregsitrement dans la table admin
* parametres: tableau des valeurs 
*/
function modifieUser($valeur, $base){
	$req = "UPDATE admin SET username=:username, password=:password WHERE id_admin=:id_admin";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute($valeur);
	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
	return $envoie;
}

function modifieChampUser($champ, $valeur, $id, $base)
{
	$req = "UPDATE admin SET $champ=:champ WHERE id=:id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			"champ" => $valeur,
			"id" => $id
		));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}
/*
*
*
*/
function supprimeUser($id, $base){
	$req = "DELETE FROM admin WHERE id_admin=:id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			"id" => $id
		));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}










/***************************************** tutoriels *********************************/
/*
*
* description: ajout d'un nouveau tutoriel
*/
function newTutoriel($tuto, $base){
	$req = "INSERT INTO tutoriel(tutoriel_entete,tutoriel_contenu,service_titre,tutoriel_dateDenvoie,tutoriel_auteur) 
	VALUES(:tutoriel_entete,:tutoriel_contenu,:service_titre,:tutoriel_dateDenvoie,:tutoriel_auteur)";
	print_r($tuto);
	$res=1;
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute($tuto);
	}catch(Exception $e){
	//	echo "erreur : " . $e->getMessage();
		$res=-1;
	}


	if($res===1)
	{	
		return $base->lastInsertId();
	}
	else
	{
		return -1;
	}
}

/*
* selectionne un tutoriel à partir du numéro
*
*/
function selectionneTutoriel($id, $base){

	$req = "SELECT * FROM tutoriel WHERE tutoriel_id=:id";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":id" => $id
			));

		$res=$envoie->fetch();

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
* description: selectionner tous les tutoriels entre deux dates
*/
function selectionneTutoriels($base, $dated, $datef){

	$req = "SELECT * FROM tutoriel WHERE tutoriel_dateDenvoie>=:dated AND tutoriel_dateDenvoie<=:datef";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			":dated" => $dated,
			":datef" => $datef
			));

		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}


/*
* description: selectionner tous les tutoriels sivant le service
*/
function selectionneTutorielsService($base, $data){
	$service = $data[0];
	$statut = $data[1];
	$dated = $data[2];
	$datef = $data[3];

	if($service==="*" && $statut==="tout"){
		return selectionneTutoriels($base, $dated, $datef);
	}
	elseif($service==="*" && $statut!=="tout"){
		return selectionneTutorielsChamps($base,"statut",$statut, $dated, $datef);
	}
	elseif($service!=="*" && $statut==="tout"){
		return selectionneTutorielsChamps($base,"service_titre",$service, $dated, $datef);
		
	}
	elseif($service!=="*" && $statut!=="tout"){
		return selectionneTutorielsToSend($base,$service,$statut, $dated, $datef);
	}
	
}

/*
* selectionne les tutoriels suivant le champs entre les dates dated et datef
*/
function selectionneTutorielsChamps($base, $champs, $valeur, $dated="", $datef=""){
	if($dated==="") $dated=Date("Y-m-d H:i:s");
	if($datef==="") $datef=Date("Y-m-d H:i:s");
	$res=[];

	$req = "SELECT * FROM tutoriel WHERE $champs=:$champs AND tutoriel_dateDenvoie>=:dated AND tutoriel_dateDenvoie<=:datef";

	
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":$champs" => $valeur,
				":dated" => $dated,
				":datef" => $datef
			));
		
		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}


/*
* description: selectionner tous les tutoriels à envoyer
*/
function selectionneTutorielsToSend($base, $service, $statut, $dated, $datef){

	$req = "SELECT * FROM tutoriel WHERE service_titre=:service_titre AND statut=:statut AND tutoriel_dateDenvoie>=:dated AND tutoriel_dateDenvoie<=:datef";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			":statut" => $statut,
			":service_titre" => $service,
			":dated" => $dated,
			":datef" => $datef
		));

		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}
/*
*
* description: selectionner tous les tutoriels à envoyer à la date specifié
*/
function selectionneTutorielsToSendH($dateHeure,$base){

	$req = "SELECT client_UID,inscription.service_titre,mensualite,tutoriel_entete,tutoriel_contenu,tutoriel_dateDenvoie FROM inscription,tutoriel WHERE est_anvoye=:statut AND tutoriel_dateDenvoie=:dateHeure AND inscription.service_titre=:tutoriel.service_titre";
	$res=[];
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			":status" => 0,
			":dateHeure" => $dateHeure
		));

		$res=$envoie;

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
		return $res;
}

/*
* fonction: modifie un enregsitrement dans la table tutoriel
* parametres: tableau des valeurs 
*/
function modifieTutoriel($valeur, $base){
	$req = "UPDATE tutoriel SET tutoriel_entete=:tutoriel_entete, tutoriel_contenu=:tutoriel_contenu,
	tutoriel_auteur=:tutoriel_auteur,tutoriel_dateDenvoie=:tutoriel_dateDenvoie, service_titre=:service_titre WHERE tutoriel_id=:tutoriel_id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute($valeur);

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}

	return $envoie;
}


/*
* description: modifie un champ d'un tutoriel
*/
function modifieChampTutoriel($champ, $valeur, $id, $base)
{
	$req = "UPDATE tutoriel SET $champ=:champ WHERE tutoriel_id=:id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			":champ" => $valeur,
			":id" => $id
		));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}


/*
* description: supprime un tutoriel
*/
function supprimeTutoriel($id, $base){
	$req = "DELETE FROM tutoriel WHERE tutoriel_id=:id";

	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
			"id" => $id
		));

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}
}




/*********************************** actions automatiques ***********************/
function newAction($base){
	try{
		$req = "SELECT * FROM action_automatique";
		$res=$base->prepare($req);
		$res = $res->fetch();
	}catch(Exception $e){

	}
}

/*
* selectionne une action
*/

function selectionAction($id, $base){
	$req = "SELECT * FROM action_automatique WHERE action_id=:id";
	$res=[];
	
	try
	{
		$envoie=$base->prepare($req);
		$envoie->execute(array(
				":id" => $id
			));
		
		$res=$envoie->fetch();

	}catch(Exception $e){
		//echo "erreur : " . $e->getMessage();
	}

	return $res;
}

function modifieAction($id){
	return 0;
}
function supprimeAction($id){
	return 0;
}

?>

