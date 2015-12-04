
<?php
echo "bienvenue chez kams<br>";
if(isset($_POST['text']) and isset($_POST['num']))
{
	//envoyer la reponse
	//exec
	
	echo $_POST['text'] . " numero : " . $_POST['num'];
	echo "<br>" . $_POST['time'];
}
?>
