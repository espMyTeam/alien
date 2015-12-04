<?php

/******* modules ********/
require_once("../scripts/base_connexion.php");
require_once("../scripts/traitement.php");
require_once("../scripts/requetes.php");

	session_start();
	if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])){

		header("location: index.php");
	}
	else{
		//session_destroy();

		if(isset($_POST['pseudo']) && isset($_POST['pass']) && $_POST['pseudo']!=="" && $_POST['pass']!==""){
			$admin = selectionneUser($_POST['pseudo'], $_POST['pass'], $base);
			if(isset($admin['username'])){
				$_SESSION['pseudo'] = $admin['username'];
				$_SESSION['pass'] = $admin['password'];
				 //echo "lo";
				$no_visible_elements=false;
				header("location: index.php");
			}else{
				session_destroy();
				header("location: index.php");
			}
		}else{
			session_destroy();
			header("location: index.php");
			
		}

	}
?>
