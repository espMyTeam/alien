<div>
	<form>
		<input type="text" id="cl_uid" name="cl_uid" placeholder="UID du client" autocomplete="off" required />
		
	</form>
	<div id="resultat"> Patienter...
	</div>
</div> 
<script type="text/javascript">
var texte = document.getElementById("cl_uid");
var resultat = document.getElementById("resultat");
var resultats = document.createElement("div");
var klk_resultats = document.createElement("div");
var valeur_precedent = "", requete_precedent = "";

//au chargement du document, faire la requete ajax
document.body.onload=actualise_moteur;

var xhr= new XMLHttpRequest();

//interaction avec l'utilisateur
texte.onkeyup=function(e){
	e = e || window.event; // compatibilite

	//si le contenu du champs de recheche change
	//((e.keyCode>=48 && e.keyCode<=57)|| (e.keyCode>=65 && e.keyCode<=90))
	
	if(texte.value!=valeur_precedent && ((e.keyCode>=48 && e.keyCode<=57)|| (e.keyCode>=65 && e.keyCode<=90) || e.keyCode==8)){
		valeur_precedent=texte.value;
		affiche_resultat();
	}else{

	}
}

//actualiser le moteur de recherche
function actualise_moteur(){
	
 		var data="cl_uid="+texte.value;
 		resultat.innerHTML="";
		requete(data);
 }



function requete(data){
	//recuperer tous les enregistrements dont l'uid commence par le premier element
	
		xhr.onreadystatechange=function(){
			if(xhr.readyState==4 && xhr.status==200){
				resultats.innerHTML=xhr.responseText;
			}
		}
		xhr.open("POST", "ajax_moteur_client.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send(data);
}

function affiche_resultat(){

	if(resultats.childElementCount>=1){

		var tab=resultats.children;
		var count=1;
		resultat.innerHTML="";
		for(var i=tab.length-1; i>=0 && count<=10; i--){
			
			if(tab[i].nodeName=="DIV" && tab[i].innerHTML.search(texte.value)==0 && texte.value>""){
				var temp=document.createElement("div");
				temp.innerHTML=tab[i].innerHTML;

				resultat.appendChild(temp);
				count++;
			}
		};
		if(count==1){
			resultat.innerHTML="Aucun client ne correspond à votre recherche";
		}

	}else{
		resultat.innerHTML=resultats.innerHTML;
	}
}

</script>